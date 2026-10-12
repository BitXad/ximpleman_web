<?php
class Tarifa extends CI_Controller
{
    private $sistema; private $parametros; private $session_data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Tarifa_model','Sistema_model','Parametro_model','Empresa_model'));
        $this->load->helper(array('url','form'));
        $this->sistema=$this->Sistema_model->get_sistema();
        $p=$this->Parametro_model->get_parametros(); $this->parametros=isset($p[0])?$p[0]:array();
        if($this->session->userdata('logged_in')) $this->session_data=$this->session->userdata('logged_in'); else redirect('','refresh');
    }
    private function json($d){return $this->output->set_content_type('application/json')->set_output(json_encode($d,JSON_UNESCAPED_UNICODE));}
    private function uid(){return (int)$this->session_data['usuario_id'];}

    private function estructura_ok()
    {
        $e=$this->Tarifa_model->estado_estructura();
        if(!empty($e['ok'])) return true;

        $faltan=array_merge(
            isset($e['tablas_faltantes'])?$e['tablas_faltantes']:array(),
            isset($e['columnas_faltantes'])?$e['columnas_faltantes']:array()
        );
        $this->session->set_flashdata(
            'error',
            'El módulo de Tarifas no está instalado completamente. Ejecute database/database_actualizacion_tarifas_transporte.sql. Falta: '.implode(', ',$faltan)
        );
        return false;
    }

    public function index()
    {
        $data['sistema']=$this->sistema;
        $data['parametro']=$this->parametros;
        $data['empresa']=$this->Empresa_model->get_empresa(1);
        $data['estructura_tarifa']=$this->Tarifa_model->estado_estructura();
        $data['tarifas']=$this->Tarifa_model->tarifas();
        $data['temporadas']=$this->Tarifa_model->temporadas();
        $data['tipos']=$this->Tarifa_model->tipos_pasajero();
        $data['rutas']=$this->Tarifa_model->rutas();
        $data['categorias']=$this->Tarifa_model->categorias();
        $data['_view']='tarifa/index';
        $this->load->view('layouts/main',$data);
    }

    public function guardar()
    {
        if(!$this->estructura_ok()){redirect('tarifa');return;}
        $id=(int)$this->input->post('tarifa_id');
        $d=array(
          'ruta_id'=>(int)$this->input->post('ruta_id'),
          'categoriavehiculo_id'=>((int)$this->input->post('categoriavehiculo_id')?:null),
          'tarifa_tipoasiento'=>strtoupper(trim((string)$this->input->post('tarifa_tipoasiento')))?:null,
          'tarifa_hora_desde'=>trim((string)$this->input->post('tarifa_hora_desde'))?:null,
          'tarifa_hora_hasta'=>trim((string)$this->input->post('tarifa_hora_hasta'))?:null,
          'temporada_id'=>((int)$this->input->post('temporada_id')?:null),
          'tarifa_nombre'=>trim((string)$this->input->post('tarifa_nombre')),
          'tarifa_precio'=>round((float)$this->input->post('tarifa_precio'),2),
          'tarifa_nocturna'=>$this->input->post('tarifa_nocturna')?1:0,
          'tarifa_prioridad'=>(int)$this->input->post('tarifa_prioridad'),
          'tarifa_vigencia_desde'=>trim((string)$this->input->post('tarifa_vigencia_desde'))?:null,
          'tarifa_vigencia_hasta'=>trim((string)$this->input->post('tarifa_vigencia_hasta'))?:null,
          'tarifa_observacion'=>trim((string)$this->input->post('tarifa_observacion'))?:null,
          'estado_id'=>$this->input->post('estado_id')?1:0,'usuario_id'=>$this->uid()
        );
        if($d['ruta_id']<=0 || $d['tarifa_nombre']==='' || $d['tarifa_precio']<0){$this->session->set_flashdata('error','Complete ruta, nombre y precio.');redirect('tarifa');return;}
        if($id>0){$this->db->where('tarifa_id',$id)->update('tarifa_transporte',$d);}
        else {$this->db->insert('tarifa_transporte',$d);}
        $this->session->set_flashdata('success','Tarifa guardada correctamente.'); redirect('tarifa');
    }

    public function guardar_tipo()
    {
        if(!$this->estructura_ok()){redirect('tarifa');return;}
        $id=(int)$this->input->post('tarifatipopasajero_id');
        $d=array('tarifatipopasajero_nombre'=>trim((string)$this->input->post('nombre')),
          'tarifatipopasajero_tipoajuste'=>trim((string)$this->input->post('tipoajuste')),
          'tarifatipopasajero_valor'=>round((float)$this->input->post('valor'),2),
          'tarifatipopasajero_requiereautorizacion'=>$this->input->post('requiere')?1:0,
          'estado_id'=>$this->input->post('activo')?1:0);
        if($id>0)$this->db->where('tarifatipopasajero_id',$id)->update('tarifa_tipo_pasajero',$d);
        redirect('tarifa');
    }

    public function guardar_temporada()
    {
        if(!$this->estructura_ok()){redirect('tarifa');return;}
        $id=(int)$this->input->post('temporada_id');
        $d=array('temporada_nombre'=>trim((string)$this->input->post('nombre')),
          'temporada_fecha_desde'=>trim((string)$this->input->post('desde'))?:null,
          'temporada_fecha_hasta'=>trim((string)$this->input->post('hasta'))?:null,
          'temporada_prioridad'=>(int)$this->input->post('prioridad'),'estado_id'=>$this->input->post('activo')?1:0);
        if($id>0)$this->db->where('temporada_id',$id)->update('tarifa_temporada',$d); else $this->db->insert('tarifa_temporada',$d);
        redirect('tarifa');
    }

    public function opciones_pasaje()
    {
        $estructura=$this->Tarifa_model->estado_estructura();
        if(empty($estructura['ok'])){
            return $this->json(array('ok'=>false,'opciones'=>array(),'mensaje'=>'Falta ejecutar la actualización SQL del módulo de tarifas.'));
        }
        $viaje=(int)$this->input->post('viaje_id'); $pasaje=(int)$this->input->post('pasaje_id');
        $r=array(); foreach($this->Tarifa_model->tipos_pasajero() as $tp){
            $c=$this->Tarifa_model->calcular($viaje,$pasaje,(int)$tp['tarifatipopasajero_id']);
            if($c && !empty($c['ok'])) $r[]=$c;
        }
        return $this->json(array('ok'=>count($r)>0,'opciones'=>$r,'mensaje'=>count($r)?'':'No existe tarifa aplicable.'));
    }

    public function tipos_descuento()
    {
        if(!$this->db->table_exists('tipo_descuento_pasaje')){
            return $this->json(array('ok'=>false,'tipos'=>array(),'mensaje'=>'Falta ejecutar el SQL de descuentos.'));
        }
        $tipos=$this->db->query("SELECT tipodescuento_id,tipodescuento_nombre,tipodescuento_requiereautorizacion,tipodescuento_maxporcentaje
            FROM tipo_descuento_pasaje WHERE estado_id=1 ORDER BY tipodescuento_nombre")->result_array();
        return $this->json(array('ok'=>true,'tipos'=>$tipos));
    }


    public function motivos_cortesia()
    {
        if(!$this->db->table_exists('cortesia_motivo')){
            return $this->json(array('ok'=>false,'motivos'=>array(),'mensaje'=>'Falta ejecutar el SQL de cortesías.'));
        }
        $motivos=$this->db->query("SELECT cortesiamotivo_id,cortesiamotivo_codigo,cortesiamotivo_nombre
            FROM cortesia_motivo WHERE estado_id=1 ORDER BY cortesiamotivo_id")->result_array();
        return $this->json(array('ok'=>true,'motivos'=>$motivos));
    }

}
