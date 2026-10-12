<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Ximpleman carga Dompdf mediante el autoload propio de application/libraries/vendor.
require_once(APPPATH.'libraries/vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pasaje_publico extends CI_Controller
{
    private function obtener($token)
    {
        $token = trim((string)$token);
        if ($token === '' || strlen($token) > 64) return NULL;

        return $this->db->query("
            SELECT p.pasaje_id,p.pasaje_numero,p.pasaje_nombre,p.pasaje_documento,
                   p.pasaje_qr_token,p.estado_id,p.pasaje_controlabordaje,
                   a.asiento_numero,v.viaje_id,v.viaje_fechasalida,v.viaje_horasalida,
                   r.ruta_nombre,e.estado_descripcion
            FROM pasaje p
            INNER JOIN viaje v ON v.viaje_id=p.viaje_id
            LEFT JOIN ruta r ON r.ruta_id=v.ruta_id
            LEFT JOIN asientos a ON a.asiento_id=p.asiento_id
            LEFT JOIN estado e ON e.estado_id=p.estado_id
            WHERE BINARY p.pasaje_qr_token=?
            LIMIT 1
        ", array($token))->row_array();
    }

    private function obtener_qr($pasaje)
    {
        if (empty($pasaje['pasaje_id']) || empty($pasaje['pasaje_qr_token'])) return '';

        $this->load->library('ciqrcode');
        $dir = FCPATH.'resources/images/abordaje_qr/';

        if (!is_dir($dir)) @mkdir($dir,0755,true);
        if (!is_dir($dir) || !is_writable($dir)) return '';

        $archivo = 'pasaje_'.(int)$pasaje['pasaje_id'].'_'.substr(sha1($pasaje['pasaje_qr_token']),0,12).'.png';
        $ruta = $dir.$archivo;

        if (!is_file($ruta) || filesize($ruta) == 0) {
            $this->ciqrcode->generate(array(
                'data' => $pasaje['pasaje_qr_token'],
                'level' => 'H',
                'size' => 6,
                'savename' => $ruta
            ));
        }
        return is_file($ruta) ? $ruta : '';
    }

    private function qr_base64($pasaje)
    {
        $qr = $this->obtener_qr($pasaje);
        return ($qr !== '' && is_file($qr))
            ? 'data:image/png;base64,'.base64_encode(file_get_contents($qr))
            : '';
    }

    public function ver($token='')
    {
        $token = rawurldecode($token);
        $pasaje = $this->obtener($token);
        if (!$pasaje) { show_404(); return; }

        $this->load->view('pasaje/publico', array(
            'pasaje' => $pasaje,
            'token' => $token,
            'qr_base64' => $this->qr_base64($pasaje)
        ));
    }

    public function pdf($token='')
    {
        $token = rawurldecode($token);
        $p = $this->obtener($token);
        if (!$p) { show_404(); return; }

        $qr = $this->qr_base64($p);
        $h = function($v){ return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8'); };
        $numero = !empty($p['pasaje_numero']) ? $p['pasaje_numero'] : $p['pasaje_id'];
        $estado = !empty($p['estado_descripcion']) ? $p['estado_descripcion'] : $p['estado_id'];

        $html='<html><head><meta charset="UTF-8"><style>
        body{font-family:Arial,sans-serif;font-size:12px;color:#222}
        .ticket{border:1px solid #555;padding:18px}
        .titulo{font-size:20px;font-weight:bold;color:#16863b;margin-bottom:15px}
        .fila{padding:7px 0;border-bottom:1px solid #ddd}
        .qr{text-align:center;margin-top:20px}.qr img{width:170px;height:170px}
        .codigo{font-size:9px;font-weight:bold;margin-top:6px;word-wrap:break-word}
        .leyenda{font-size:9px;color:#666;margin-top:4px}
        </style></head><body><div class="ticket">
        <div class="titulo">PASAJE CONFIRMADO</div>
        <div class="fila"><b>Pasaje:</b> '.$h($numero).'</div>
        <div class="fila"><b>Pasajero:</b> '.$h($p['pasaje_nombre']).'</div>
        <div class="fila"><b>Ruta:</b> '.$h($p['ruta_nombre']).'</div>
        <div class="fila"><b>Salida:</b> '.$h($p['viaje_fechasalida']).' '.$h(substr((string)$p['viaje_horasalida'],0,5)).'</div>
        <div class="fila"><b>Asiento:</b> '.$h($p['asiento_numero']).'</div>
        <div class="fila"><b>Estado:</b> '.$h($estado).'</div>';

        if ($qr !== '') {
            $html.='<div class="qr"><img src="'.$qr.'">
            <div class="codigo">CÓD. ABORDAJE: '.$h($p['pasaje_qr_token']).'</div>
            <div class="leyenda">Presente este código QR al momento de abordar</div></div>';
        }

        $html.='</div></body></html>';

        $options = new Options();
        $options->set('isRemoteEnabled', false);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html,'UTF-8');
        $dompdf->setPaper('A5','portrait');
        $dompdf->render();
        $dompdf->stream(
            'pasaje_'.preg_replace('/[^A-Za-z0-9_-]/','_', (string)$numero).'.pdf',
            array('Attachment'=>false)
        );
    }
}
