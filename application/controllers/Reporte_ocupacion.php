<?php
class Reporte_ocupacion extends CI_Controller{
    private $session_data=array();
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('', 'refresh');
        $this->session_data=$this->session->userdata('logged_in');
        $this->load->model('Reporte_ocupacion_model');
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
        $uid=(int)$this->session_data['usuario_id'];
        if(!$this->Reporte_ocupacion_model->usuario_tiene_rol($uid,220)) show_error('No tiene permiso para generar reportes de Transporte.',403,'Acceso denegado');
    }
    private function filtros(){
        $desde=trim((string)$this->input->get('desde',true)); $hasta=trim((string)$this->input->get('hasta',true));
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$desde)) $desde=date('Y-m-01');
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$hasta)) $hasta=date('Y-m-d');
        if($desde>$hasta){$x=$desde;$desde=$hasta;$hasta=$x;}
        $grupo=trim((string)$this->input->get('grupo',true));
        if(!in_array($grupo,array('ruta','horario','vehiculo','dia_semana','mes'),true)) $grupo='ruta';
        return array('desde'=>$desde,'hasta'=>$hasta,'grupo'=>$grupo,'ruta_id'=>(int)$this->input->get('ruta_id',true),'vehiculo_id'=>(int)$this->input->get('vehiculo_id',true));
    }
    public function index(){
        $f=$this->filtros(); $data['sistema']=$this->Sistema_model->get_sistema(); $p=$this->Parametro_model->get_parametros(); $data['parametro']=isset($p[0])?$p[0]:$p;
        $data['filtros']=$f; $data['listas']=$this->Reporte_ocupacion_model->listas(); $data['filas']=$this->Reporte_ocupacion_model->ocupacion($f); $data['page_title']='Reporte de ocupación'; $data['_view']='reporte_transporte/ocupacion'; $this->load->view('layouts/main',$data);
    }
    public function csv(){
        $f=$this->filtros(); $filas=$this->Reporte_ocupacion_model->ocupacion($f);
        header('Content-Type: text/csv; charset=UTF-8'); header('Content-Disposition: attachment; filename="ocupacion_'.$f['desde'].'_'.$f['hasta'].'.csv"'); echo "\xEF\xBB\xBF"; $o=fopen('php://output','w');
        fputcsv($o,array('Agrupación','Viajes','Capacidad','Vendidos','Reservados','Disponibles','Ocupación %','Venta neta'),';');
        foreach($filas as $r) fputcsv($o,array($r['grupo'],$r['viajes'],$r['capacidad'],$r['vendidos'],$r['reservados'],$r['disponibles'],number_format($r['ocupacion'],2,'.',''),number_format($r['venta_neta'],2,'.','')),';'); fclose($o); exit;
    }
}
