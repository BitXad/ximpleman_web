<?php
class Encomienda_model extends CI_Model
{
    function __construct(){ parent::__construct(); }

    function get_all_encomiendas($limit=500){
        $this->db->select('e.*, o.origen_nombre, d.destino_nombre, r.ruta_nombre, v.viaje_fechasalida, v.viaje_horasalida, ee.encomiendaestado_nombre, ee.encomiendaestado_color, fp.forma_nombre, u.usuario_nombre');
        $this->db->from('encomienda e');
        $this->db->join('origen o','o.origen_id=e.origen_id','left');
        $this->db->join('destino d','d.destino_id=e.destino_id','left');
        $this->db->join('ruta r','r.ruta_id=e.ruta_id','left');
        $this->db->join('viaje v','v.viaje_id=e.viaje_id','left');
        $this->db->join('encomienda_estado ee','ee.encomiendaestado_id=e.encomiendaestado_id','left');
        $this->db->join('forma_pago fp','fp.forma_id=e.forma_id','left');
        $this->db->join('usuario u','u.usuario_id=e.usuario_id','left');
        $this->db->order_by('e.encomienda_id','DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    function get_encomienda_full($id){
        $this->db->select('e.*, o.origen_nombre, d.destino_nombre, r.ruta_nombre, ee.encomiendaestado_nombre, ee.encomiendaestado_color, fp.forma_nombre, u.usuario_nombre, v.viaje_fechasalida, v.viaje_horasalida, ve.vehiculo_placa, c.conductor_nombres, c.conductor_apellidos');
        $this->db->from('encomienda e');
        $this->db->join('origen o','o.origen_id=e.origen_id','left');
        $this->db->join('destino d','d.destino_id=e.destino_id','left');
        $this->db->join('ruta r','r.ruta_id=e.ruta_id','left');
        $this->db->join('encomienda_estado ee','ee.encomiendaestado_id=e.encomiendaestado_id','left');
        $this->db->join('forma_pago fp','fp.forma_id=e.forma_id','left');
        $this->db->join('usuario u','u.usuario_id=e.usuario_id','left');
        $this->db->join('viaje v','v.viaje_id=e.viaje_id','left');
        $this->db->join('vehiculo ve','ve.vehiculo_id=e.vehiculo_id','left');
        $this->db->join('conductor c','c.conductor_id=e.conductor_id','left');
        $this->db->where('e.encomienda_id',$id);
        return $this->db->get()->row_array();
    }

    function get_encomienda($id){ return $this->db->get_where('encomienda',array('encomienda_id'=>$id))->row_array(); }
    function get_by_guia($guia){ return $this->db->get_where('encomienda',array('encomienda_guia'=>$guia))->row_array(); }

    function generar_guia(){
        $prefijo='ENC'.date('Ymd');
        $this->db->like('encomienda_guia',$prefijo,'after');
        $this->db->from('encomienda');
        return $prefijo.str_pad($this->db->count_all_results()+1,5,'0',STR_PAD_LEFT);
    }

    function guardar_encomienda($params){
        $this->db->trans_start();
        $this->db->insert('encomienda',$params);
        $id=$this->db->insert_id();
        $this->add_movimiento(array('encomienda_id'=>$id,'usuario_id'=>$params['usuario_id'],'estado_id'=>$params['encomiendaestado_id'],'movimientoencomienda_accion'=>'Registro/recepcion de encomienda','movimientoencomienda_observacion'=>isset($params['encomienda_pagadoen'])?$params['encomienda_pagadoen']:(isset($params['encomienda_observacion'])?$params['encomienda_observacion']:'')));
        $this->db->trans_complete();
        return $id;
    }

    function update_encomienda($id,$params){ $this->db->where('encomienda_id',$id); return $this->db->update('encomienda',$params); }

    function add_movimiento($params){
        /*
         * IMPORTANTE:
         * La tabla real es encomienda_movimiento y sus campos usan el prefijo
         * movimientoencomienda_. Por eso normalizamos aqui cualquier nombre
         * antiguo que haya quedado en controlador/modelo.
         */
        $data = array(
            'encomienda_id' => isset($params['encomienda_id']) ? $params['encomienda_id'] : null,
            'usuario_id' => isset($params['usuario_id']) ? $params['usuario_id'] : null,
            'origen_id' => isset($params['origen_id']) ? $params['origen_id'] : null,
            'destino_id' => isset($params['destino_id']) ? $params['destino_id'] : null,
            'viaje_id' => isset($params['viaje_id']) ? $params['viaje_id'] : null,
            'vehiculo_id' => isset($params['vehiculo_id']) ? $params['vehiculo_id'] : null,
            'estado_id' => isset($params['estado_id']) ? $params['estado_id'] : (isset($params['encomiendaestado_id']) ? $params['encomiendaestado_id'] : null),
            'movimientoencomienda_fecha' => isset($params['movimientoencomienda_fecha']) ? $params['movimientoencomienda_fecha'] : date('Y-m-d'),
            'movimientoencomienda_hora' => isset($params['movimientoencomienda_hora']) ? $params['movimientoencomienda_hora'] : date('H:i:s'),
            'movimientoencomienda_fechahora' => isset($params['movimientoencomienda_fechahora']) ? $params['movimientoencomienda_fechahora'] : date('Y-m-d H:i:s'),
            'movimientoencomienda_accion' => isset($params['movimientoencomienda_accion']) ? $params['movimientoencomienda_accion'] : (isset($params['movimiento_descripcion']) ? $params['movimiento_descripcion'] : ''),
            'movimientoencomienda_observacion' => isset($params['movimientoencomienda_observacion']) ? $params['movimientoencomienda_observacion'] : (isset($params['movimiento_observacion']) ? $params['movimiento_observacion'] : ''),
            'movimientoencomienda_latitud' => isset($params['movimientoencomienda_latitud']) ? $params['movimientoencomienda_latitud'] : null,
            'movimientoencomienda_longitud' => isset($params['movimientoencomienda_longitud']) ? $params['movimientoencomienda_longitud'] : null
        );
        $this->db->insert('encomienda_movimiento',$data);
        return $this->db->insert_id();
    }

    function get_movimientos($id){
        $this->db->select('m.*, ee.encomiendaestado_nombre, u.usuario_nombre');
        $this->db->from('encomienda_movimiento m');
        $this->db->join('encomienda_estado ee','ee.encomiendaestado_id=m.estado_id','left');
        $this->db->join('usuario u','u.usuario_id=m.usuario_id','left');
        $this->db->where('m.encomienda_id',$id);
        $this->db->order_by('m.movimientoencomienda_id','ASC');
        return $this->db->get()->result_array();
    }

    function asignar_viaje($encomienda_id,$viaje_id,$usuario_id){
        $viaje=$this->db->get_where('viaje',array('viaje_id'=>$viaje_id))->row_array();
        $params=array('viaje_id'=>$viaje_id,'encomiendaestado_id'=>2);
        if($viaje){ $params['ruta_id']=$viaje['ruta_id']; $params['vehiculo_id']=$viaje['vehiculo_id']; $params['conductor_id']=$viaje['conductor_id']; }
        $this->update_encomienda($encomienda_id,$params);
        $this->add_movimiento(array('encomienda_id'=>$encomienda_id,'usuario_id'=>$usuario_id,'encomiendaestado_id'=>2,'viaje_id'=>$viaje_id,'movimientoencomienda_accion'=>'Asignado a viaje'));
        return true;
    }

    function cambiar_estado($id,$estado_id,$usuario_id,$obs=''){
        $this->update_encomienda($id,array('encomiendaestado_id'=>$estado_id));
        $this->add_movimiento(array('encomienda_id'=>$id,'usuario_id'=>$usuario_id,'encomiendaestado_id'=>$estado_id,'movimientoencomienda_accion'=>'Cambio de estado','movimientoencomienda_observacion'=>$obs));
    }

    function entregar($id,$params,$usuario_id){
        $this->db->trans_start();

        $entrega=array(
            'encomienda_id'=>$id,
            'usuario_id'=>$usuario_id,
            'entregaencomienda_nombre'=>isset($params['encomienda_nombre_recibe'])?$params['encomienda_nombre_recibe']:'',
            'entregaencomienda_ci'=>isset($params['encomienda_ci_recibe'])?$params['encomienda_ci_recibe']:'',
            'entregaencomienda_telefono'=>isset($params['encomienda_telefono_recibe'])?$params['encomienda_telefono_recibe']:'',
            'entregaencomienda_relacion'=>isset($params['encomienda_parentesco_recibe'])?$params['encomienda_parentesco_recibe']:'',
            'entregaencomienda_firma'=>isset($params['encomienda_firma'])?$params['encomienda_firma']:'',
            'entregaencomienda_latitud'=>isset($params['encomienda_latitud_entrega'])?$params['encomienda_latitud_entrega']:'',
            'entregaencomienda_longitud'=>isset($params['encomienda_longitud_entrega'])?$params['encomienda_longitud_entrega']:'',
            'entregaencomienda_fecha'=>date('Y-m-d'),
            'entregaencomienda_hora'=>date('H:i:s'),
            'entregaencomienda_observacion'=>isset($params['entregaencomienda_observacion'])?$params['entregaencomienda_observacion']:''
        );
        $this->db->insert('entrega_encomienda',$entrega);

        $this->update_encomienda($id,array(
            'encomiendaestado_id'=>7,
            'encomienda_fechaentrega'=>date('Y-m-d H:i:s'),
            'encomienda_latitud_entrega'=>$entrega['entregaencomienda_latitud'],
            'encomienda_longitud_entrega'=>$entrega['entregaencomienda_longitud']
        ));

        $this->add_movimiento(array(
            'encomienda_id'=>$id,
            'usuario_id'=>$usuario_id,
            'encomiendaestado_id'=>7,
            'movimientoencomienda_accion'=>'Entrega confirmada',
            'movimientoencomienda_observacion'=>'Recibe: '.$entrega['entregaencomienda_nombre'].' - CI: '.$entrega['entregaencomienda_ci'],
            'movimientoencomienda_latitud'=>$entrega['entregaencomienda_latitud'],
            'movimientoencomienda_longitud'=>$entrega['entregaencomienda_longitud']
        ));

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function get_encomiendas_viaje($viaje_id){
        $this->db->select('e.*, ee.encomiendaestado_nombre');
        $this->db->from('encomienda e');
        $this->db->join('encomienda_estado ee','ee.encomiendaestado_id=e.encomiendaestado_id','left');
        $this->db->where('e.viaje_id',$viaje_id);
        $this->db->order_by('e.encomienda_id','ASC');
        return $this->db->get()->result_array();
    }

    function get_viajes_activos(){
        $this->db->select('v.*, r.ruta_nombre, o.origen_nombre, d.destino_nombre, ve.vehiculo_placa');
        $this->db->from('viaje v');
        $this->db->join('ruta r','r.ruta_id=v.ruta_id','left');
        $this->db->join('origen o','o.origen_id=r.origen_id','left');
        $this->db->join('destino d','d.destino_id=r.destino_id','left');
        $this->db->join('vehiculo ve','ve.vehiculo_id=v.vehiculo_id','left');
        $this->db->order_by('v.viaje_fechasalida','DESC');
        $this->db->limit(200);
        return $this->db->get()->result_array();
    }

    function catalogos(){
        return array(
            'origen'=>$this->db->get('origen')->result_array(),
            'destino'=>$this->db->get('destino')->result_array(),
            'ruta'=>$this->db->get('ruta')->result_array(),
            'viaje'=>$this->get_viajes_activos(),
            'forma_pago'=>$this->db->get_where('forma_pago',array('estado_id'=>1))->result_array(),
            'tipo'=>$this->db->get_where('tipo_encomienda',array('estado_id'=>1))->result_array(),
            'servicio'=>$this->db->get_where('servicio_encomienda',array('estado_id'=>1))->result_array(),
            'estado'=>$this->db->get_where('encomienda_estado',array('estado_id'=>1))->result_array()
        );
    }

    function resumen($desde,$hasta){
        $sql="SELECT COUNT(*) cantidad, SUM(encomienda_total) total, SUM(encomienda_saldo) saldo,
              SUM(CASE WHEN encomiendaestado_id=7 THEN 1 ELSE 0 END) entregadas,
              SUM(CASE WHEN encomiendaestado_id<>7 THEN 1 ELSE 0 END) pendientes
              FROM encomienda WHERE encomienda_fecha BETWEEN ? AND ?";
        return $this->db->query($sql,array($desde,$hasta))->row_array();
    }

    function reporte($desde,$hasta){
        $this->db->select('e.*, o.origen_nombre, d.destino_nombre, ee.encomiendaestado_nombre');
        $this->db->from('encomienda e');
        $this->db->join('origen o','o.origen_id=e.origen_id','left');
        $this->db->join('destino d','d.destino_id=e.destino_id','left');
        $this->db->join('encomienda_estado ee','ee.encomiendaestado_id=e.encomiendaestado_id','left');
        $this->db->where('e.encomienda_fecha >=',$desde);
        $this->db->where('e.encomienda_fecha <=',$hasta);
        $this->db->order_by('e.encomienda_id','DESC');
        return $this->db->get()->result_array();
    }


    function get_viaje_full($viaje_id){
        $this->db->select('v.*, r.ruta_nombre, o.origen_nombre, d.destino_nombre, ve.vehiculo_placa, ve.vehiculo_marca, ve.vehiculo_modelo, c.conductor_nombres, c.conductor_apellidos');
        $this->db->from('viaje v');
        $this->db->join('ruta r','r.ruta_id=v.ruta_id','left');
        $this->db->join('origen o','o.origen_id=r.origen_id','left');
        $this->db->join('destino d','d.destino_id=r.destino_id','left');
        $this->db->join('vehiculo ve','ve.vehiculo_id=v.vehiculo_id','left');
        $this->db->join('conductor c','c.conductor_id=v.conductor_id','left');
        $this->db->where('v.viaje_id',$viaje_id);
        return $this->db->get()->row_array();
    }

    function get_entrega($encomienda_id){
        $this->db->select('ee.*, u.usuario_nombre');
        $this->db->from('entrega_encomienda ee');
        $this->db->join('usuario u','u.usuario_id=ee.usuario_id','left');
        $this->db->where('ee.encomienda_id',$encomienda_id);
        $this->db->order_by('ee.entregaencomienda_id','DESC');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

    function registrar_pago($encomienda_id,$params){
        $this->db->trans_start();
        $params['encomienda_id']=$encomienda_id;
        $params['pagoencomienda_fecha']=date('Y-m-d');
        $params['pagoencomienda_hora']=date('H:i:s');
        $this->db->insert('pago_encomienda',$params);
        $pago_id=$this->db->insert_id();

        $e=$this->get_encomienda($encomienda_id);
        $acuenta=(float)$e['encomienda_acuenta']+(float)$params['pagoencomienda_monto'];
        $saldo=max(0,(float)$e['encomienda_total']-$acuenta);
        $this->update_encomienda($encomienda_id,array(
            'encomienda_acuenta'=>$acuenta,
            'encomienda_saldo'=>$saldo,
            'encomienda_pagado'=>($saldo<=0?1:0)
        ));
        $this->add_movimiento(array(
            'encomienda_id'=>$encomienda_id,
            'usuario_id'=>$params['usuario_id'],
            'estado_id'=>$e['encomiendaestado_id'],
            'movimientoencomienda_accion'=>'Pago de encomienda',
            'movimientoencomienda_observacion'=>'Monto Bs '.number_format($params['pagoencomienda_monto'],2,'.','')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status()===FALSE){ return 0; }
        return $pago_id;
    }

    function get_pago_full($pago_id){
        $this->db->select('p.*, e.encomienda_guia, e.encomienda_codigo, e.encomienda_total, e.encomienda_acuenta, e.encomienda_saldo, e.encomienda_pagadoen, e.encomienda_remitentenombre, e.encomienda_destinatarionombre, o.origen_nombre, d.destino_nombre, fp.forma_nombre, u.usuario_nombre');
        $this->db->from('pago_encomienda p');
        $this->db->join('encomienda e','e.encomienda_id=p.encomienda_id','left');
        $this->db->join('origen o','o.origen_id=e.origen_id','left');
        $this->db->join('destino d','d.destino_id=e.destino_id','left');
        $this->db->join('forma_pago fp','fp.forma_id=p.forma_id','left');
        $this->db->join('usuario u','u.usuario_id=p.usuario_id','left');
        $this->db->where('p.pagoencomienda_id',$pago_id);
        return $this->db->get()->row_array();
    }

}
