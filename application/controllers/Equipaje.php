<?php
class Equipaje extends CI_Controller
{
    private $sistema;
    private $parametros;
    private $session_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Equipaje_model','Sistema_model','Parametro_model','Empresa_model'));
        $this->load->helper(array('url','form'));
        $this->sistema=$this->Sistema_model->get_sistema();
        $p=$this->Parametro_model->get_parametros();
        $this->parametros=isset($p[0])?$p[0]:array();
        if($this->session->userdata('logged_in')) $this->session_data=$this->session->userdata('logged_in');
        else redirect('','refresh');
    }

    private function json($data){ return $this->output->set_content_type('application/json')->set_output(json_encode($data,JSON_UNESCAPED_UNICODE)); }
    private function usuario_id(){ return (int)$this->session_data['usuario_id']; }
    private function autorizado(){ return $this->Equipaje_model->usuario_tiene_rol($this->usuario_id(),212); }
    private function require_permiso_json(){ if(!$this->autorizado()){ $this->json(array('ok'=>false,'mensaje'=>'No tiene permiso para Control de Equipaje.')); return false; } return true; }

    public function index()
    {
        $data['sistema']=$this->sistema; $data['parametro']=$this->parametros;
        $data['empresa']=$this->Empresa_model->get_empresa(1);
        $data['puede_operar']=$this->autorizado();
        $data['formas_pago']=$this->Equipaje_model->formas_pago();
        $data['pasaje_inicial']=(int)$this->input->get('pasaje_id');
        $data['_view']='equipaje/index';
        $this->load->view('layouts/main',$data);
    }

    public function buscar()
    {
        if(!$this->require_permiso_json()) return;
        $tipo=trim((string)$this->input->post('tipo'));
        $valor=trim((string)$this->input->post('valor'));
        $fecha=trim((string)$this->input->post('fecha'));
        if($valor==='' && $fecha==='') return $this->json(array('ok'=>false,'mensaje'=>'Ingrese un criterio de búsqueda.'));
        $rows=$this->Equipaje_model->buscar_pasajeros($tipo,$valor,$fecha);
        return $this->json(array('ok'=>true,'resultados'=>$rows));
    }

    public function detalle_pasaje($pasaje_id)
    {
        if(!$this->require_permiso_json()) return;
        $p=$this->Equipaje_model->get_pasaje((int)$pasaje_id);
        if(!$p) return $this->json(array('ok'=>false,'mensaje'=>'Pasaje no encontrado.'));
        return $this->json(array('ok'=>true,'pasaje'=>$p,'equipajes'=>$this->Equipaje_model->get_equipajes_pasaje((int)$pasaje_id),'tarifa'=>$this->Equipaje_model->get_tarifa((int)$p['ruta_id'])));
    }

    public function registrar()
    {
        if(!$this->require_permiso_json()) return;
        $pasaje_id=(int)$this->input->post('pasaje_id');
        $tipo=strtoupper(trim((string)$this->input->post('equipaje_tipo')));
        $subtipo=strtoupper(trim((string)$this->input->post('equipaje_subtipo')));
        $cantidad=max(1,(int)$this->input->post('cantidad_piezas'));
        $peso=max(0,(float)$this->input->post('peso'));
        $descripcion=trim((string)$this->input->post('descripcion'));
        $observacion=trim((string)$this->input->post('observaciones'));
        $forma_id=(int)$this->input->post('forma_id');
        $importe_manual=max(0,(float)$this->input->post('importe_manual'));
        if(!in_array($tipo,array('INCLUIDO','EXTRA'),true)) return $this->json(array('ok'=>false,'mensaje'=>'Tipo de equipaje inválido.'));
        if($descripcion==='') return $this->json(array('ok'=>false,'mensaje'=>'Debe ingresar una descripción del equipaje.'));

        $this->db->trans_begin();
        try{
            $p=$this->db->query("SELECT p.*,v.ruta_id,v.estado_id viaje_estado FROM pasaje p INNER JOIN viaje v ON v.viaje_id=p.viaje_id WHERE p.pasaje_id=? FOR UPDATE",array($pasaje_id))->row_array();
            if(!$p) throw new Exception('El pasaje no existe.');
            if((int)$p['estado_id']!==54) throw new Exception('Solo se puede registrar equipaje para un pasaje vendido y activo.');
            if(in_array((int)$p['viaje_estado'],array(58,60,63),true)) throw new Exception('El estado actual del viaje no permite recibir equipaje.');
            if($tipo==='INCLUIDO' && $this->Equipaje_model->existe_incluido_activo($pasaje_id)) throw new Exception('Este pasajero ya tiene registrado su equipaje incluido.');
            $tarifa=$this->Equipaje_model->get_tarifa((int)$p['ruta_id']);
            $peso_incluido=(float)$tarifa['peso_incluido'];
            $exceso=max(0,$peso-$peso_incluido);
            $importe=0.0;
            if($tipo==='EXTRA'){
                if($subtipo==='EXCESO_PESO') $importe=round($exceso*(float)$tarifa['precio_kg_exceso'],2);
                elseif($subtipo==='PIEZA_ADICIONAL') $importe=round($cantidad*(float)$tarifa['precio_pieza_extra'],2);
                else $importe=round($importe_manual,2);
                if($importe<=0) throw new Exception('El equipaje extra debe tener un importe mayor a cero.');
                if($forma_id<=0) throw new Exception('Seleccione la forma de pago del equipaje extra.');
            } else { $subtipo='INCLUIDO'; $forma_id=0; $exceso=0; }
            // Mantener el mismo criterio financiero que Venta de Pasajes:
            // si el usuario tiene una caja vigente se la vincula; si no, la
            // operación no se bloquea y caja_id queda NULL. El ingreso sigue
            // identificado por usuario, forma de pago, viaje, pasaje e importe.
            $caja_id=$this->Equipaje_model->get_caja_abierta($this->usuario_id());
            $codigo=$this->Equipaje_model->nuevo_codigo((int)$p['viaje_id']);
            $token=strtoupper(substr(hash('sha256',uniqid((string)$pasaje_id,true).mt_rand()),0,24));
            $row=array(
              'pasaje_id'=>$pasaje_id,'viaje_id'=>(int)$p['viaje_id'],'venta_id'=>(int)$p['venta_id'],
              'equipaje_tipo'=>$tipo,'equipaje_subtipo'=>$subtipo,'equipaje_numeroetiqueta'=>$codigo,
              'equipaje_cantidad_piezas'=>$cantidad,'equipaje_peso'=>$peso,'equipaje_peso_incluido'=>$peso_incluido,
              'equipaje_exceso_kg'=>$exceso,'equipaje_importe'=>$importe,'forma_id'=>$forma_id?:null,'caja_id'=>$caja_id?:null,
              'equipaje_descripcion'=>$descripcion,'equipaje_observaciones'=>$observacion,'equipaje_qr_token'=>$token,
              'equipaje_estado'=>'RECIBIDO','usuario_recibe_id'=>$this->usuario_id(),'equipaje_fechahorarecepcion'=>date('Y-m-d H:i:s')
            );
            if(!$this->db->insert('pasaje_equipaje',$row)) throw new Exception('No fue posible registrar el equipaje.');
            $id=(int)$this->db->insert_id();
            $this->db->insert('pasaje_equipaje_movimiento',array('equipaje_id'=>$id,'movimiento_tipo'=>'RECEPCION','movimiento_fechahora'=>date('Y-m-d H:i:s'),'usuario_id'=>$this->usuario_id(),'movimiento_observacion'=>$observacion));
            // Compatibilidad con campos históricos del pasaje.
            $this->db->where('pasaje_id',$pasaje_id)->update('pasaje',array('pasaje_tieneequipaje'=>1,'pasaje_detalleequipaje'=>$this->Equipaje_model->resumen_equipaje_pasaje($pasaje_id,$descripcion),'pasaje_fechahoraequipaje'=>date('Y-m-d H:i:s')));
            if($this->db->trans_status()===false) throw new Exception('La base de datos rechazó la operación.');
            $this->db->trans_commit();
            return $this->json(array('ok'=>true,'mensaje'=>'Equipaje registrado correctamente.','equipaje_id'=>$id,'importe'=>$importe,'codigo'=>$codigo,'impresion'=>site_url('equipaje/imprimir/'.$id)));
        }catch(Exception $e){ $this->db->trans_rollback(); return $this->json(array('ok'=>false,'mensaje'=>$e->getMessage())); }
    }

    public function buscar_etiqueta()
    {
        if(!$this->require_permiso_json()) return;
        $codigo=trim((string)$this->input->post('codigo'));
        $e=$this->Equipaje_model->get_equipaje_por_codigo($codigo);
        if(!$e) return $this->json(array('ok'=>false,'mensaje'=>'No se encontró equipaje con ese código/QR.'));
        return $this->json(array('ok'=>true,'equipaje'=>$e));
    }

    public function entregar()
    {
        if(!$this->require_permiso_json()) return;
        $id=(int)$this->input->post('equipaje_id');
        $obs=trim((string)$this->input->post('observacion'));
        $this->db->trans_begin();
        try{
            $e=$this->db->query("SELECT * FROM pasaje_equipaje WHERE equipaje_id=? FOR UPDATE",array($id))->row_array();
            if(!$e) throw new Exception('Equipaje no encontrado.');
            if($e['equipaje_estado']==='ENTREGADO') throw new Exception('EQUIPAJE YA ENTREGADO - '.date('H:i',strtotime($e['equipaje_fechahoraentrega'])));
            if($e['equipaje_estado']!=='RECIBIDO') throw new Exception('El equipaje no está disponible para entrega.');
            $now=date('Y-m-d H:i:s');
            if(!$this->db->where('equipaje_id',$id)->update('pasaje_equipaje',array('equipaje_estado'=>'ENTREGADO','usuario_entrega_id'=>$this->usuario_id(),'equipaje_fechahoraentrega'=>$now))) throw new Exception('No fue posible registrar la entrega.');
            $this->db->insert('pasaje_equipaje_movimiento',array('equipaje_id'=>$id,'movimiento_tipo'=>'ENTREGA','movimiento_fechahora'=>$now,'usuario_id'=>$this->usuario_id(),'movimiento_observacion'=>$obs));
            if($this->db->trans_status()===false) throw new Exception('La base de datos rechazó la entrega.');
            $this->db->trans_commit();
            return $this->json(array('ok'=>true,'mensaje'=>'EQUIPAJE ENTREGADO','hora'=>date('H:i',strtotime($now))));
        }catch(Exception $e){ $this->db->trans_rollback(); return $this->json(array('ok'=>false,'mensaje'=>$e->getMessage())); }
    }

    public function imprimir($equipaje_id)
    {
        $e=$this->Equipaje_model->get_equipaje((int)$equipaje_id);
        if(!$e) show_404();
        $data['sistema']=$this->sistema; $data['parametro']=$this->parametros; $data['empresa']=$this->Empresa_model->get_empresa(1); $data['equipaje']=$e;
        $data['qr_equipaje']=$this->generar_qr($e);
        $data['_view']='equipaje/etiqueta_talon';
        $this->load->view('layouts/main',$data);
    }

    private function generar_qr($e)
    {
        $this->load->library('ciqrcode');
        $rel='resources/images/equipaje_qr/'; $dir=FCPATH.$rel;
        if(!is_dir($dir)) @mkdir($dir,0755,true);
        if(!is_dir($dir)||!is_writable($dir)) return '';
        $token=trim((string)$e['equipaje_qr_token']);
        $file='equipaje_'.(int)$e['equipaje_id'].'_'.substr(sha1($token),0,12).'.png';
        $path=$dir.$file;
        if(!is_file($path)||filesize($path)===0){
            $this->ciqrcode->generate(array('data'=>$token,'level'=>'H','size'=>5,'savename'=>$path));
        }
        return is_file($path)?base_url($rel.$file):'';
    }

    private function preparar_impresion_lote($equipajes){
        $salida=array();
        foreach($equipajes as $e){
            $e['qr_url']=$this->generar_qr($e);
            $salida[]=$e;
        }
        return $salida;
    }

    public function imprimir_venta($venta_id)
    {
        $equipajes=$this->Equipaje_model->get_equipajes_venta((int)$venta_id);
        if(empty($equipajes)) show_error('Esta venta no tiene equipaje registrado.',404);
        $data=array('sistema'=>$this->sistema,'parametro'=>$this->parametros,'empresa'=>$this->Empresa_model->get_empresa(1),'equipajes'=>$this->preparar_impresion_lote($equipajes),'_view'=>'equipaje/etiquetas_lote');
        $this->load->view('layouts/main',$data);
    }

    public function imprimir_pasaje($pasaje_id)
    {
        $equipajes=$this->Equipaje_model->get_equipajes_por_pasaje((int)$pasaje_id);
        if(empty($equipajes)) show_error('Este pasajero no tiene equipaje registrado.',404);
        $data=array('sistema'=>$this->sistema,'parametro'=>$this->parametros,'empresa'=>$this->Empresa_model->get_empresa(1),'equipajes'=>$this->preparar_impresion_lote($equipajes),'_view'=>'equipaje/etiquetas_lote');
        $this->load->view('layouts/main',$data);
    }

    public function manifiesto($viaje_id)
    {
        if(!$this->autorizado()) show_error('No autorizado',403);
        $cab=$this->Equipaje_model->get_manifiesto_cabecera((int)$viaje_id);
        if(!$cab) show_404();
        $tipo=isset($this->parametros['parametro_tipoimpresora'])?strtoupper(trim($this->parametros['parametro_tipoimpresora'])):'';
        $data=array('sistema'=>$this->sistema,'parametro'=>$this->parametros,'empresa'=>$this->Empresa_model->get_empresa(1),'cabecera'=>$cab,'equipajes'=>$this->Equipaje_model->get_manifiesto_equipaje((int)$viaje_id),'es_boucher'=>($tipo==='FACTURADORA'),'_view'=>'equipaje/manifiesto');
        $this->load->view('layouts/main',$data);
    }

    public function manifiesto_excel($viaje_id)
    {
        if(!$this->autorizado()) show_error('No autorizado',403);
        $cab=$this->Equipaje_model->get_manifiesto_cabecera((int)$viaje_id); if(!$cab) show_404();
        $eq=$this->Equipaje_model->get_manifiesto_equipaje((int)$viaje_id);
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="manifiesto_equipaje_viaje_'.(int)$viaje_id.'.xls"');
        echo "\xEF\xBB\xBF";
        $this->load->view('equipaje/manifiesto_excel',array('cabecera'=>$cab,'equipajes'=>$eq));
        exit;
    }

    public function reporte()
    {
        $data['sistema']=$this->sistema; $data['parametro']=$this->parametros;
        $desde=$this->input->get('desde')?:date('Y-m-01'); $hasta=$this->input->get('hasta')?:date('Y-m-d');
        $data['desde']=$desde; $data['hasta']=$hasta; $data['resumen']=$this->Equipaje_model->reporte_ingresos($desde,$hasta);
        $data['_view']='equipaje/reporte'; $this->load->view('layouts/main',$data);
    }
}
