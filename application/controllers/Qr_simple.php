<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** Cobro QR para la pantalla venta/ventas. */
class Qr_simple extends CI_Controller
{
    private function response($body, $status = 200)
    {
        $this->output->set_status_header($status)->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($body));
    }

    private function user()
    {
        $session = $this->session->userdata('logged_in');
        return is_array($session) && !empty($session['usuario_id']) ? (int) $session['usuario_id'] : 0;
    }

    private function table_ready()
    {
        if (!$this->db->table_exists('atc_qr_cobro')) {
            throw new RuntimeException('Instale primero el archivo SQL de QR Simple.');
        }
    }

    private function check_payment($row)
    {
        $this->load->library('Atc_qr_simple');
        $reply = $this->atc_qr_simple->verify($row['referencia_atc']);
        if (empty($reply['success']) || empty($reply['data']) || !is_array($reply['data'])) {
            throw new RuntimeException('No se pudo confirmar el estado del QR.');
        }
        $data = $reply['data'];
        if ((string) ($data['numeroReferencia'] ?? '') !== (string) $row['referencia_atc']
            || (string) ($data['numeroReferenciaOriginante'] ?? '') !== (string) $row['referencia_origen']
            || (string) ($data['moneda'] ?? '') !== 'BOB'
            || !isset($data['importe']) || round(((float) $data['importe']) * 100) !== round(((float) $row['monto']) * 100)) {
            throw new RuntimeException('La referencia o el monto confirmado no coinciden con el QR generado.');
        }
        $status = strtoupper((string) ($data['estado'] ?? ''));
        if (!in_array($status, array('PENDIENTE', 'PAGADO', 'CANCELADO', 'EXPIRADO', 'ERROR'), true)) {
            throw new RuntimeException('ATC devolvió un estado QR desconocido.');
        }
        $this->db->where('cobro_id', $row['cobro_id'])
            ->where_not_in('estado', array('FINALIZADO', 'FINALIZANDO'))
            ->update('atc_qr_cobro', array('estado' => $status,
                'confirmado_en' => $status === 'PAGADO' ? date('Y-m-d H:i:s') : $row['confirmado_en']));
        return $status;
    }

    public function generar()
    {
        $user = $this->user();
        if (!$user || strtoupper($this->input->method()) !== 'POST') {
            return $this->response(array('error' => 'Acceso no autorizado.'), 403);
        }
        try {
            $this->table_ready();
            $raw = trim((string) $this->input->post('monto'));
            if (!preg_match('/^\d{1,10}(?:\.\d{1,2})?$/', $raw) || (float) $raw <= 0) {
                throw new RuntimeException('El importe del QR debe ser mayor a cero y tener dos decimales como máximo.');
            }
            $amount = number_format((float) $raw, 2, '.', '');
            $webhookUrl = trim((string) getenv('ATC_QR_WEBHOOK_URL'));
            if ($webhookUrl === '') {
                $webhookUrl = site_url('qr_simple/webhook');
            }
            if (!filter_var($webhookUrl, FILTER_VALIDATE_URL) ||
                strtolower(parse_url($webhookUrl, PHP_URL_SCHEME)) !== 'https') {
                throw new RuntimeException('Configure ATC_QR_WEBHOOK_URL con una URL pública HTTPS para el webhook.');
            }
            // Evita cobrar de nuevo si ya existe un QR pendiente/pagado del cajero.
            $active = $this->db->where('usuario_id', $user)->where_in('estado', array('PENDIENTE', 'PAGADO'))
                ->order_by('cobro_id', 'DESC')->limit(1)->get('atc_qr_cobro')->row_array();
            if ($active) {
                $previous = $this->check_payment($active);
                if (in_array($previous, array('PENDIENTE', 'PAGADO'), true)) {
                    return $this->response(array('error' => 'Hay un cobro QR ' . $previous .
                        ' sin cerrar (referencia ' . $active['referencia_atc'] .
                        '). Verifique ese pago antes de crear otro.'), 409);
                }
            }
            $reference = 'X' . date('ymdHis') . strtoupper(bin2hex(random_bytes(5)));
            $this->load->library('Atc_qr_simple');
            $reply = $this->atc_qr_simple->generate($amount, $reference, $webhookUrl);
            $data = isset($reply['data']) ? $reply['data'] : array();
            if (empty($reply['success']) || empty($data['numeroReferencia']) || empty($data['qr'])
                || !isset($data['monto']) || round($data['monto'] * 100) !== round($amount * 100)
                || (string) ($data['numeroReferenciaOriginante'] ?? '') !== $reference) {
                throw new RuntimeException('ATC no devolvió un QR válido. Consulte antes de reintentar.');
            }
            $this->db->insert('atc_qr_cobro', array('usuario_id' => $user,
                'referencia_origen' => $reference, 'referencia_atc' => $data['numeroReferencia'],
                'monto' => $amount, 'moneda' => 'BOB', 'estado' => 'PENDIENTE',
                'creado_en' => date('Y-m-d H:i:s'), 'expira_en' => !empty($data['fechaExpiracion'])
                    ? str_replace('T', ' ', substr($data['fechaExpiracion'], 0, 19)) : date('Y-m-d H:i:s', time() + 300)));
            if ($this->db->affected_rows() !== 1) {
                throw new RuntimeException('No se pudo registrar el QR generado. Conserve la referencia y consulte ATC.');
            }
            return $this->response(array('id' => (int) $this->db->insert_id(), 'referencia' => $data['numeroReferencia'],
                'monto' => $amount, 'qr' => $data['qr']));
        } catch (Exception $e) {
            log_message('error', 'QR Simple generar: ' . $e->getMessage());
            return $this->response(array('error' => $e->getMessage()), 400);
        }
    }

    public function estado()
    {
        $user = $this->user();
        if (!$user || strtoupper($this->input->method()) !== 'POST') {
            return $this->response(array('error' => 'Acceso no autorizado.'), 403);
        }
        try {
            $this->table_ready();
            $id = (int) $this->input->post('id');
            $row = $this->db->where('cobro_id', $id)->where('usuario_id', $user)
                ->get('atc_qr_cobro')->row_array();
            if (!$row) {
                return $this->response(array('error' => 'Cobro QR no encontrado.'), 404);
            }
            $status = in_array($row['estado'], array('FINALIZADO', 'FINALIZANDO'), true)
                ? $row['estado'] : $this->check_payment($row);
            return $this->response(array('estado' => $status, 'referencia' => $row['referencia_atc'],
                'monto' => $row['monto']));
        } catch (Exception $e) {
            log_message('error', 'QR Simple estado: ' . $e->getMessage());
            return $this->response(array('error' => $e->getMessage()), 502);
        }
    }

    public function webhook()
    {
        if (strtoupper($this->input->method()) !== 'POST') {
            return $this->response(array('error' => 'Método no permitido.'), 405);
        }
        $key = (string) getenv('ATC_QR_WEBHOOK_SECRET');
        $received = (string) $this->input->get_request_header('x-api-key', true);
        if (strlen($key) < 20 || !hash_equals($key, $received)) {
            return $this->response(array('error' => 'Firma inválida.'), 403);
        }
        try {
            $this->table_ready();
            $payload = json_decode($this->input->raw_input_stream, true);
            if (!is_array($payload)) {
                throw new RuntimeException('Notificación inválida.');
            }
            $reference = (string) ($payload['numeroReferencia'] ?? ($payload['data']['numeroReferencia'] ?? ''));
            $row = $this->db->where('referencia_atc', $reference)->get('atc_qr_cobro')->row_array();
            if (!$row) {
                return $this->response(array('error' => 'Referencia desconocida.'), 404);
            }
            // La notificación no acredita pagos por sí sola: se confirma contra verify de ATC.
            if (!in_array($row['estado'], array('FINALIZADO', 'FINALIZANDO'), true)) {
                $this->check_payment($row);
            }
            return $this->response(array('codigoRespuesta' => 'SUCCESS', 'numeroReferencia' => $reference));
        } catch (Exception $e) {
            log_message('error', 'QR Simple webhook: ' . $e->getMessage());
            return $this->response(array('error' => 'No fue posible procesar la notificación.'), 502);
        }
    }
}
