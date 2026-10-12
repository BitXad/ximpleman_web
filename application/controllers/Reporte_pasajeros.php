<?php
class Reporte_pasajeros extends CI_Controller{
    private $session_data=array();

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('','refresh');
        $this->session_data=$this->session->userdata('logged_in');
        $this->load->model('Reporte_pasajeros_model');
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
        if(!$this->Reporte_pasajeros_model->usuario_tiene_rol((int)$this->session_data['usuario_id'],220))
            show_error('No tiene permiso para generar reportes de Transporte.',403,'Acceso denegado');
    }

    private function filtros(){
        $d=trim((string)$this->input->get('desde',true));
        $h=trim((string)$this->input->get('hasta',true));
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$d)) $d=date('Y-m-01',strtotime('-11 months'));
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$h)) $h=date('Y-m-d');
        if($d>$h){$x=$d;$d=$h;$h=$x;}
        return array(
            'desde'=>$d,'hasta'=>$h,
            'ci'=>trim((string)$this->input->get('ci',true)),
            'nombre'=>trim((string)$this->input->get('nombre',true)),
            'telefono'=>trim((string)$this->input->get('telefono',true))
        );
    }

    public function index(){
        $f=$this->filtros();
        $p=$this->Parametro_model->get_parametros();
        $data['sistema']=$this->Sistema_model->get_sistema();
        $data['parametro']=isset($p[0])?$p[0]:$p;
        $data['filtros']=$f;
        $data['resumen']=$this->Reporte_pasajeros_model->resumen($f);
        $data['page_title']='Reporte de pasajeros';
        $data['_view']='reporte_transporte/pasajeros';
        $this->load->view('layouts/main',$data);
    }

    public function historial($clave){
        $f=$this->filtros();
        $rows=$this->Reporte_pasajeros_model->historial(urldecode($clave),$f);
        $this->output->set_content_type('application/json')->set_output(json_encode($rows));
    }

    public function csv(){
        $f=$this->filtros(); $rs=$this->Reporte_pasajeros_model->resumen($f);
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="pasajeros_'.$f['desde'].'_'.$f['hasta'].'.csv"');
        echo "\xEF\xBB\xBF"; $x=fopen('php://output','w');
        fputcsv($x,array('CI','Pasajero','Telefono','Viajes','Rutas','Frecuencia mensual','Gasto acumulado','Ultimo viaje','Ultimas fechas'),';');
        foreach($rs as $r) fputcsv($x,array($r['documento'],$r['pasajero'],$r['telefono'],$r['viajes'],$r['rutas'],$r['frecuencia'],number_format($r['gasto'],2,'.',''),$r['ultimo_viaje'],$r['ultimas_fechas']),';');
        fclose($x); exit;
    }
}
