<?php
class Reporte_viaje extends CI_Controller{
    private $session_data=array();
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('', 'refresh');
        $this->session_data=$this->session->userdata('logged_in');
        $this->load->model('Reporte_viaje_model');
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
        $uid=(int)$this->session_data['usuario_id'];
        if(!$this->Reporte_viaje_model->usuario_tiene_rol($uid,220)) show_error('No tiene permiso para generar reportes de Transporte.',403,'Acceso denegado');
    }
    public function index(){
        $fecha=trim((string)$this->input->get('fecha',true));
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$fecha)) $fecha=date('Y-m-d');
        $viaje_id=(int)$this->input->get('viaje_id',true);
        // Datos obligatorios requeridos por layouts/main.php, igual que el reporte 34.
        $data['sistema']=$this->Sistema_model->get_sistema();
        $p=$this->Parametro_model->get_parametros();
        $data['parametro']=isset($p[0])?$p[0]:$p;
        $data['fecha']=$fecha;
        $data['viaje_id']=$viaje_id;
        $data['viajes']=$this->Reporte_viaje_model->viajes_fecha($fecha);
        $data['reporte']=$viaje_id>0?$this->Reporte_viaje_model->reporte($viaje_id):null;
        $data['page_title']='Reporte por viaje';
        $data['_view']='reporte_transporte/viaje';
        $this->load->view('layouts/main',$data);
    }
    public function csv($viaje_id){
        $r=$this->Reporte_viaje_model->reporte((int)$viaje_id);
        if(!$r) show_404();
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="reporte_viaje_'.(int)$viaje_id.'.csv"');
        echo "\xEF\xBB\xBF"; $o=fopen('php://output','w');
        fputcsv($o,array('Asiento','Pasajero','CI','Telefono','Origen','Destino','Estado','Precio','Forma pago','Usuario','Abordaje','Equipaje'),';');
        foreach($r['pasajeros'] as $x) fputcsv($o,array($x['asiento_numero'],$x['pasaje_nombre'],$x['pasaje_documento'],$x['pasaje_telefono'],$x['pasaje_origen'],$x['pasaje_destino'],$x['estado'],$x['pasaje_precio'],$x['forma_pago'],$x['usuario'],$x['abordaje'],$x['equipajes']),';');
        fclose($o); exit;
    }
}
