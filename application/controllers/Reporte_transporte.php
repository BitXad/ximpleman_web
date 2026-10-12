<?php
class Reporte_transporte extends CI_Controller{
    private $session_data=array();
    private $sistema;

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('', 'refresh');
        $this->session_data=$this->session->userdata('logged_in');
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
        $this->load->model('Reporte_transporte_model');
        $this->sistema=$this->Sistema_model->get_sistema();
        $uid=(int)$this->session_data['usuario_id'];
        $ok=$this->db->query("SELECT 1 ok FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=220 AND ru.rolusuario_asignado=1 LIMIT 1",array($uid))->row_array();
        if(!$ok) show_error('No tiene permiso para generar reportes de Transporte.',403,'Acceso denegado');
    }

    private function filtros(){
        $desde=trim((string)$this->input->get('desde',true));
        $hasta=trim((string)$this->input->get('hasta',true));
        if(!preg_match('/^\\d{4}-\\d{2}-\\d{2}$/',$desde)) $desde=date('Y-m-d');
        if(!preg_match('/^\\d{4}-\\d{2}-\\d{2}$/',$hasta)) $hasta=date('Y-m-d');
        if($desde>$hasta){ $x=$desde; $desde=$hasta; $hasta=$x; }
        return array(
            'desde'=>$desde,'hasta'=>$hasta,
            'sucursal_id'=>(int)$this->input->get('sucursal_id',true),
            'caja_id'=>(int)$this->input->get('caja_id',true),
            'usuario_id'=>(int)$this->input->get('usuario_id',true),
            'ruta_id'=>(int)$this->input->get('ruta_id',true),
            'destino'=>trim((string)$this->input->get('destino',true)),
            'forma_id'=>(int)$this->input->get('forma_id',true)
        );
    }

    public function ventas_fecha(){
        $f=$this->filtros();
        $data['sistema']=$this->sistema;
        $p=$this->Parametro_model->get_parametros();
        $data['parametro']=isset($p[0])?$p[0]:$p;
        $data['page_title']='Reporte de ventas de pasajes por fecha';
        $data['filtros']=$f;
        $data['listas']=$this->Reporte_transporte_model->listas_filtros($f);
        $data['filas']=$this->Reporte_transporte_model->ventas_por_fecha($f);
        $data['resumen']=$this->Reporte_transporte_model->resumen($data['filas']);
        $data['_view']='reporte_transporte/ventas_fecha';
        $this->load->view('layouts/main',$data);
    }

    public function ventas_fecha_csv(){
        $f=$this->filtros();
        $filas=$this->Reporte_transporte_model->ventas_por_fecha($f);
        $nombre='ventas_pasajes_'.$f['desde'].'_'.$f['hasta'].'.csv';
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="'.$nombre.'"');
        echo "\\xEF\\xBB\\xBF";
        $o=fopen('php://output','w');
        fputcsv($o,array('Fecha','Venta','Usuario','Sucursal','Caja','Ruta','Destino','Forma pago','Pasajes','Monto','Descuento','Anulacion','Total neto'),';');
        foreach($filas as $r){
            fputcsv($o,array($r['fecha'],$r['venta_id'],$r['usuario'],$r['sucursal'],$r['caja'],$r['ruta'],$r['destino'],$r['forma_pago'],$r['pasajes'],$r['monto'],$r['descuento'],$r['anulacion'],$r['neto']),';');
        }
        fclose($o); exit;
    }
}
