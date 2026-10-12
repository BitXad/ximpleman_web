<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Reserva_cron extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->database(); $this->load->model('Venta_model'); }
    public function liberar_vencidas(){
        if(!$this->input->is_cli_request()){ show_404(); return; }
        $n=$this->Venta_model->liberar_reservas_vencidas(0,'VENCIMIENTO AUTOMATICO - CRON');
        echo "Reservas liberadas: ".$n.PHP_EOL;
    }
}
