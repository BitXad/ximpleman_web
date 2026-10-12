<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** Conexión de cobros QR Simple. Configuración por variables de entorno del servidor. */
class Atc_qr_simple
{
    private function settings()
    {
        $base = trim((string) getenv('ATC_QR_BASE_URL'));
        $client = trim((string) getenv('ATC_QR_CLIENT_ID'));
        $basic = trim((string) getenv('ATC_QR_BASIC_TOKEN'));
        $secret = trim((string) getenv('ATC_QR_CLIENT_SECRET'));
        if ($basic === '' && $secret !== '' && $client !== '') {
            $basic = base64_encode($client . ':' . $secret);
        }
        if ($base === '' || $client === '' || $basic === '' || !filter_var($base, FILTER_VALIDATE_URL)
            || strtolower(parse_url($base, PHP_URL_SCHEME)) !== 'https') {
            throw new RuntimeException('Configure ATC_QR_BASE_URL (HTTPS), ATC_QR_CLIENT_ID y ATC_QR_BASIC_TOKEN.');
        }
        return array(rtrim($base, '/'), $client, $basic);
    }

    private function call($url, $headers, $body = null)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true, CURLOPT_CONNECTTIMEOUT => 8, CURLOPT_TIMEOUT => 20,
            CURLOPT_HTTPHEADER => $headers, CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ));
        if ($body !== null) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        $raw = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        $data = json_decode((string) $raw, true);
        if ($raw === false || $status < 200 || $status >= 300 || !is_array($data)) {
            log_message('error', 'ATC QR HTTP ' . $status . ': ' . $error);
            throw new RuntimeException('No se pudo consultar el servicio QR de ATC.');
        }
        return $data;
    }

    private function access()
    {
        list($base, $client, $basic) = $this->settings();
        $tokenUrl = trim((string) getenv('ATC_QR_TOKEN_URL'));
        if ($tokenUrl === '') {
            $tokenUrl = $base . '/oauth-client-credentials/access-token?grant_type=client_credentials';
        }
        if (strpos($tokenUrl, $base . '/') !== 0) {
            throw new RuntimeException('La URL de autenticación debe pertenecer a ATC_QR_BASE_URL.');
        }
        $reply = $this->call($tokenUrl, array('Authorization: Basic ' . $basic,
            'Content-Type: application/x-www-form-urlencoded'), '');
        if (empty($reply['access_token'])) {
            throw new RuntimeException('ATC no entregó un token de acceso.');
        }
        return array($base, $client, $reply['access_token']);
    }

    private function api($path, $body = null)
    {
        list($base, $client, $token) = $this->access();
        // ATC muestra access_token en sus ejemplos; aceptar Bearer mediante configuración.
        $authHeader = getenv('ATC_QR_BEARER') === '1'
            ? 'Authorization: Bearer ' . $token : 'access_token: ' . $token;
        return $this->call($base . '/qr/simple/v2/' . $path,
            array($authHeader, 'client_id: ' . $client, 'Content-Type: application/json'),
            $body === null ? null : json_encode($body));
    }

    public function generate($amount, $reference, $webhookUrl)
    {
        $establishment = (int) getenv('ATC_QR_ESTABLISHMENT_ID');
        $name = trim((string) getenv('ATC_QR_ESTABLISHMENT_NAME'));
        $webhookSecret = trim((string) getenv('ATC_QR_WEBHOOK_SECRET'));
        if ($establishment < 1 || $name === '' || strlen($webhookSecret) < 20) {
            throw new RuntimeException('Configure establecimiento y clave del webhook QR.');
        }
        return $this->api('generate', array(
            'glosa' => 'Venta Ximpleman ' . $reference,
            'moneda' => 'BOB', 'monto' => (float) $amount,
            'numeroReferencia' => $reference, 'vigencia' => 300,
            'idEstablecimiento' => $establishment,
            'nombreEstablecimiento' => $name,
            'webhook' => array('url' => $webhookUrl, 'key' => 'x-api-key', 'value' => $webhookSecret),
        ));
    }

    public function verify($reference)
    {
        if (!preg_match('/^[a-zA-Z0-9-]{1,80}$/', $reference)) {
            throw new RuntimeException('Referencia QR inválida.');
        }
        return $this->api('verify/' . rawurlencode($reference));
    }
}
