<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Cotizacion extends CI_Controller{
    private $session_data = "";
    private $sistema;
    private $parametros;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cotizacion_model');
        $this->load->model('Compra_model');
        $this->load->model('Parametro_model');
        $this->load->helper('numeros');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
	$this->sistema = $this->Sistema_model->get_sistema();
        
        $parametro = $this->Parametro_model->get_parametros();
        $this->parametros = $parametro[0];
        
    } 
    /* *****Funcion que verifica el acceso al sistema**** */
    private function acceso($id_rol){
        
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
            $this->load->view('layouts/main',$data);
        }
    }
    /*
     * Listing of cotizacion
     */
    function index()
    {   
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        if($this->acceso(36)){
            $data['page_title'] = "Cotización";
            $data['rol'] = $this->session_data['rol'];
            //$data['cotizacion'] = $this->Cotizacion_model->get_all_cotizacion();
            $this->load->model('Empresa_model');
            $data['empresa'] = $this->Empresa_model->get_empresa(1);
            $data['_view'] = 'cotizacion/index';
            $this->load->view('layouts/main',$data);
        }
    }

    function creacotizacion()
    {
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        if($this->acceso(37)){
            $usuario_id = $this->session_data['usuario_id'];
            $cotizacion_id = $this->Cotizacion_model->crear_cotizacion($usuario_id);        
            redirect('cotizacion/add/'.$cotizacion_id);
        }
    }
    /*
     * Adding a new cotizacion
     */
    function add($cotizacion_id)
    {
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        if($this->acceso(37)){
            $data['page_title'] = "Cotización";
            $usuario_id = $this->session_data['usuario_id'];
            $data['cotizacion_id'] = $cotizacion_id; 
            $this->load->model('Detalle_cotizacion_model');
            $data['detalle_cotizacion'] = $this->Cotizacion_model->get_detalle_cotizacion($cotizacion_id);
            $this->load->model('Producto_model');
            //$data['producto'] = $this->Producto_model->get_all_productos();  
            $data['cotizacion'] = $this->Cotizacion_model->get_cotizacion($cotizacion_id);     
            $data['_view'] = 'cotizacion/add';
            $this->load->view('layouts/main',$data);
       
        }
    }

    function buscar_cotizacion()
    {
        //$data['parametro'] = $this->parametros;
        if ($this->input->is_ajax_request()) {
            $parametro = $this->input->post('parametro');
            $datos = $this->Cotizacion_model->get_fechas_cotizacion($parametro);
            if(isset($datos)){
                echo json_encode($datos);
            }else{
                echo json_encode(null);
            }
        }else{                 
            show_404();
        }          
    }

    function actualizarcaracteristicas()
    {
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
       if ($this->input->is_ajax_request()) {  
        $producto_id = $this->input->post('producto_id');
        $nuevo = $this->input->post('nuevo');

        $prod= "UPDATE
                producto
            SET
                producto_caracteristicas='".$nuevo."'
                
            WHERE
                producto_id = ".$producto_id."  ";
        $this->Cotizacion_model->ejecutar($prod);        
        
        $inv= "UPDATE
                inventario
            SET
                producto_caracteristicas='".$nuevo."'
                
            WHERE
                producto_id = ".$producto_id."  ";
        $this->Cotizacion_model->ejecutar($inv); 
        echo json_encode(true);
       }else
        {                 
                    show_404();
        }          
    }

    function cotizarecibo($cotizacion_id)
    {
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        if($this->acceso(36)){
            $data['page_title'] = "Cotización";
            $usuario_id = $this->session_data['usuario_id'];
            $data['cotizacion_id'] = $cotizacion_id;
            $this->load->model('Empresa_model');
            $data['empresa'] = $this->Empresa_model->get_empresa(1);
            $this->load->model('Detalle_cotizacion_model');
            $data['detalle_cotizacion'] = $this->Cotizacion_model->get_detalle_cotizacion($cotizacion_id);
            $data['usuario'] = $this->Cotizacion_model->get_cotizacion_usuario($usuario_id);  
            $data['cotizacion'] = $this->Cotizacion_model->get_cotizacion($cotizacion_id);     
            $data['_view'] = 'cotizacion/cotiza';
            $this->load->view('layouts/main',$data);
       
        }
    }
    function recibo($cotizacion_id)
    {
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        //$data['parametro'] = $this->Parametro_model->get_parametros();
        $num = $this->Compra_model->numero();
        $este = $num[0]['parametro_tipoimpresora'];
        
        if($this->acceso(36)){
            
            $data['page_title'] = "Cotización";
            $usuario_id = $this->session_data['usuario_id'];
            $data['cotizacion_id'] = $cotizacion_id;
            $this->load->model('Empresa_model');
            $data['empresa'] = $this->Empresa_model->get_empresa(1);
            $this->load->model('Detalle_cotizacion_model');
            $data['detalle_cotizacion'] = $this->Cotizacion_model->get_detalle_cotizacion($cotizacion_id);
            $data['usuario'] = $this->Cotizacion_model->get_cotizacion_usuario($usuario_id);  
            $data['cotizacion'] = $this->Cotizacion_model->get_cotizacion($cotizacion_id);

                if ($este == 'NORMAL') {
                    
                    $data['_view'] = 'cotizacion/recibo';
                    $this->load->view('layouts/main',$data);
                    
                }else{
                    
                    $data['_view'] = 'cotizacion/boucher';
                    $this->load->view('layouts/main',$data);

                }
     
       
        }
    }

    function detallecotizacion()
    {
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        if ($this->input->is_ajax_request()) {  
        $cotizacion_id = $this->input->post('cotizacion_id');
        $datos = $this->Cotizacion_model->get_detalle_cotizacion($cotizacion_id);
     if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }          
     
    
    }    
    function insertarproducto()
    {
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        if ($this->input->is_ajax_request()) {
        $cotizacion_id = $this->input->post('cotizacion_id');
        $descripcion = $this->input->post('descripcion');
        $producto_id = $this->input->post('producto_id');
        $cantidad = $this->input->post('cantidad'); 
        $descuento = $this->input->post('descuento'); 
        $producto_precio = $this->input->post('producto_precio');
        $descripcion = "'".$descripcion."'";
        $factor = $this->input->post('producto_factor');
        $caracteristicas = $this->input->post('caracteristicas');
        $nuevacan = $cantidad * $factor;
        //$nuevoprec = $

       $sql = "INSERT into detalle_cotizacion(
                
                producto_id,
                detallecot_caracteristica,
                detallecot_descripcion,
                detallecot_precio,
                detallecot_cantidad,
                detallecot_descuento,
                detallecot_subtotal,
                detallecot_total,
                cotizacion_id
                            
                )
                (
                SELECT
                
                producto_id,
                '".$caracteristicas."',
                ".$descripcion.",
                ".$producto_precio.",
                ".$nuevacan.",
                ".$descuento.",
                ".$nuevacan." * ".$producto_precio.",
                (".$nuevacan." * ".$producto_precio." - ".$descuento."),
                ".$cotizacion_id."
                
                from producto where producto_id = ".$producto_id."
                )";
              
        $this->Cotizacion_model->ejecutar($sql);
        $datos = $this->Cotizacion_model->get_detalle_cotizacion($cotizacion_id);
     if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }          
    }

    function updateDetallecot()
    {
        $data['parametro'] = $this->parametros;
        $data['sistema'] = $this->sistema;
        if ($this->input->is_ajax_request()) {
        $detallecot_id = $this->input->post('detallecot_id');
        
        $caracteristica = $this->input->post('caracteristica');
        $cotizacion_id = $this->input->post('cotizacion_id');
       // $descripcion = $this->input->post('descripcion');
        $producto_id = $this->input->post('producto_id');
        $cantidad = $this->input->post('cantidad'); 
        $descuento = $this->input->post('descuento'); 
        $producto_precio = $this->input->post('precio');
        
        $descripcion = "'".$descripcion."'";
        $caracteristica = "'".$caracteristica."'";
       
       $cot = "UPDATE detalle_cotizacion
                SET
                detallecot_caracteristica = ".$caracteristica.",
               
                detallecot_precio = ".$producto_precio.",
                detallecot_cantidad = ".$cantidad.",
                detallecot_descuento = ".$descuento.",
                detallecot_subtotal = ".$cantidad." * ".$producto_precio.",
                detallecot_total = (".$cantidad." * ".$producto_precio.") - ".$descuento."
                        
                WHERE  detallecot_id = ".$detallecot_id."
            ";

    
        $this->Cotizacion_model->ejecutar($cot);
        $datos = $this->Cotizacion_model->get_detalle_cotizacion($cotizacion_id);
          if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }          
    }

    function quitar($detallecot_id)
    {
        if($this->acceso(40)){
        //**************** inicio contenido ***************        
        
        $sql = "delete from detalle_cotizacion where detallecot_id = ".$detallecot_id;
        $this->Cotizacion_model->ejecutar($sql);
        
        return true;
                    
        //**************** fin contenido ***************
        }
    }
    /*
     * Editing a cotizacion
     */
    function edit($cotizacion_id)
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(38)){
            $data['page_title'] = "Cotización";
            $usuario_id = $this->session_data['usuario_id'];
            $data['cotizacion'] = $this->Cotizacion_model->get_cotizacion($cotizacion_id);

            if(isset($data['cotizacion']['cotizacion_id']))
            {
                if(isset($_POST) && count($_POST) > 0)     
                {   
                    $fechacot = $this->input->post('cotizacion_fecha');
                    $fecha = $this->Cotizacion_model->normalize_date($fechacot);

                    $params = array(
                                            'cotizacion_fecha' => $fecha,
                                            'cotizacion_validez' => $this->input->post('cotizacion_validez'),
                                            'cotizacion_formapago' => $this->input->post('cotizacion_formapago'),
                                            'cotizacion_tiempoentrega' => $this->input->post('cotizacion_tiempoentrega'),
                                            'usuario_id' => $usuario_id,
                                            'cotizacion_total' => $this->input->post('cotizacion_total'),
                        'cotizacion_glosa' => $this->input->post('cotizacion_glosa'),
                        'cotizacion_cliente' => $this->input->post('cotizacion_cliente'),
                        'cotizacion_lugarentrega' => $this->input->post('cotizacion_lugarentrega'),
                        'cotizacion_chequenombre' => $this->input->post('cotizacion_chequenombre'),
                    );



                    $this->Cotizacion_model->update_cotizacion($cotizacion_id,$params);            
                     redirect('cotizacion/add/'.$cotizacion_id);
                }
                else
                {
                    $data['_view'] = 'cotizacion/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The cotizacion you are trying to edit does not exist.');
            }
    }

    function finalizar($cotizacion_id)
    {
        $data['sistema'] = $this->sistema;
        
        if($this->acceso(36)){
            
            $data['page_title'] = "Cotización";
            $usuario_id = $this->session_data['usuario_id'];
            // check if the cotizacion exists before trying to edit it
            $data['cotizacion'] = $this->Cotizacion_model->get_cotizacion($cotizacion_id);

            if(isset($data['cotizacion']['cotizacion_id']))
            {
                if(isset($_POST) && count($_POST) > 0)     
                {   
                    $fechacot = $this->input->post('cotizacion_fecha');
                    $fecha = $this->Cotizacion_model->normalize_date($fechacot);

                    $params = array(
                        'cotizacion_fecha' => $fecha,
                        'cotizacion_validez' => $this->input->post('cotizacion_validez'),
                        'cotizacion_formapago' => $this->input->post('cotizacion_formapago'),
                        'cotizacion_tiempoentrega' => $this->input->post('cotizacion_tiempoentrega'),
                        'usuario_id' => $usuario_id,
                        'cotizacion_total' => $this->input->post('cotizacion_total'),
                         'cotizacion_glosa' => $this->input->post('cotizacion_glosa'),
                         'cotizacion_cliente' => $this->input->post('cotizacion_cliente'),
                         'cotizacion_lugarentrega' => $this->input->post('cotizacion_lugarentrega'),
                        'cotizacion_chequenombre' => $this->input->post('cotizacion_chequenombre')
                    );



                    $this->Cotizacion_model->update_cotizacion($cotizacion_id,$params);            
                    // redirect('cotizacion/index');
                    $this->recibo($cotizacion_id);
                    
                }
                else
                {
                    $data['_view'] = 'cotizacion/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The cotizacion you are trying to edit does not exist.');
        }
    }
    /*
     * Deleting cotizacion
     */
    function remove($cotizacion_id)
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(40)){
            $cotizacion = $this->Cotizacion_model->get_cotizacion($cotizacion_id);

            // check if the cotizacion exists before trying to delete it
            if(isset($cotizacion['cotizacion_id']))
            {
                $this->Cotizacion_model->delete_cotizacion($cotizacion_id);
                redirect('cotizacion/index');
            }
            else
                show_error('The cotizacion you are trying to delete does not exist.');
        }
    }
    
    function pasar_a_ventas($cotizacion_id){
        $data['sistema'] = $this->sistema;
        $usuario_id = $this->session_data['usuario_id'];   
        
        $sql = "insert into detalle_venta_aux(
                producto_id 
                ,venta_id 
                ,moneda_id 
                ,detalleven_id 
                ,detalleven_codigo 
                ,detalleven_cantidad 
                ,detalleven_unidad 
                ,detalleven_costo 
                ,detalleven_precio 
                ,detalleven_subtotal 
                ,detalleven_descuento 
                ,detalleven_total 
                ,detalleven_caracteristicas 
                ,detalleven_preferencia 
                ,detalleven_comision 
                ,detalleven_tipocambio 
                ,usuario_id 
                ,existencia 
                ,producto_nombre 
                ,producto_unidad 
                ,producto_marca 
                ,categoria_id 
                ,producto_codigobarra 
                ,detalleven_envase 
                ,detalleven_nombreenvase 
                ,detalleven_costoenvase 
                ,detalleven_precioenvase 
                ,detalleven_cantidadenvase 
                ,detalleven_garantiaenvase 
                ,detalleven_devueltoenvase  
                ,detalleven_montodevolucion 
                ,detalleven_prestamoenvase 
                ,promocion_id 
                ,clasificador_id 
                ,detalleven_unidadfactor 
                ,preferencia_id 
                ,detalleven_tc  
                )

                (

                select 
                d.producto_id 
                ,0
                ,1
                ,0	
                ,p.producto_codigo
                ,d.detallecot_cantidad 
                ,p.producto_unidad
                ,p.producto_costo
                ,d.detallecot_precio 
                ,d.detallecot_subtotal
                ,d.detallecot_descuento 
                ,d.detallecot_total 
                ,d.detallecot_caracteristica 
                ,''
                ,0
                ,1
                ,".$usuario_id."
                ,p.existencia
                ,p.producto_nombre
                ,p.producto_unidad
                ,p.producto_marca
                ,p.categoria_id
                ,p.producto_codigobarra
                ,p.producto_envase
                ,p.producto_nombreenvase
                ,p.producto_costoenvase
                ,p.producto_precioenvase
                ,p.producto_cantidadenvase
                ,0
                ,0
                ,0
                ,0
                ,0
                ,0
                ,''
                ,0
                ,p.moneda_tc

                from
                cotizacion t, detalle_cotizacion d, inventario p
                where 
                t.cotizacion_id = ".$cotizacion_id." and
                t.cotizacion_id = d.cotizacion_id and
                d.producto_id = p.producto_id 

                )";
        
           
        $this->Cotizacion_model->ejecutar("delete from detalle_venta_aux where usuario_id = ".$usuario_id);
        $this->Cotizacion_model->ejecutar($sql);
        
        //echo $sql;
        $resultado = 0;
        echo json_encode($sql);
        
    }
    
}
