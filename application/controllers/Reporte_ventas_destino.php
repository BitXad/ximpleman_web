<?php
class Reporte_ventas_destino extends CI_Controller{
    private $session_data=array();
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('', 'refresh');
        $this->session_data=$this->session->userdata('logged_in');
        $this->load->model('Reporte_ventas_destino_model');
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
        if(!$this->Reporte_ventas_destino_model->usuario_tiene_rol((int)$this->session_data['usuario_id'],220)) show_error('No tiene permiso para generar reportes de Transporte.',403,'Acceso denegado');
    }
    private function filtros(){
        $desde=trim((string)$this->input->get('desde',true)); $hasta=trim((string)$this->input->get('hasta',true));
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$desde)) $desde=date('Y-m-01');
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$hasta)) $hasta=date('Y-m-d');
        if($desde>$hasta){$x=$desde;$desde=$hasta;$hasta=$x;}
        return array('desde'=>$desde,'hasta'=>$hasta,'ruta_id'=>(int)$this->input->get('ruta_id',true),'vehiculo_id'=>(int)$this->input->get('vehiculo_id',true));
    }
    public function index(){
        $f=$this->filtros(); $p=$this->Parametro_model->get_parametros();
        $data['sistema']=$this->Sistema_model->get_sistema(); $data['parametro']=isset($p[0])?$p[0]:$p;
        $data['filtros']=$f; $data['listas']=$this->Reporte_ventas_destino_model->listas(); $data['filas']=$this->Reporte_ventas_destino_model->ventas_por_destino($f);
        $data['page_title']='Ventas por destino'; $data['_view']='reporte_transporte/ventas_destino'; $this->load->view('layouts/main',$data);
    }
    public function csv(){
        $f=$this->filtros(); $filas=$this->Reporte_ventas_destino_model->ventas_por_destino($f);
        header('Content-Type: text/csv; charset=UTF-8'); header('Content-Disposition: attachment; filename="ventas_por_destino_'.$f['desde'].'_'.$f['hasta'].'.csv"'); echo "\xEF\xBB\xBF"; $o=fopen('php://output','w');
        fputcsv($o,array('Destino','Pasajeros vendidos','Viajes','Ingreso pasajes','Precio promedio'),';');
        foreach($filas as $r) fputcsv($o,array($r['destino'],$r['pasajeros'],$r['viajes'],number_format($r['ingreso'],2,'.',''),number_format($r['precio_promedio'],2,'.','')),';'); fclose($o); exit;
    }
}
