<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Producto_precios extends CI_Controller{
    
    private $parametros;
    private $sistema;
    private $empresa;
    
    function __construct(){
        
        parent::__construct();
        $this->load->model('Producto_precios_model');
        $this->load->model('Parametro_model');
        $this->load->model('Venta_model');
        $this->load->model('Empresa_model');
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
        $data['sistema'] = $this->sistema;
        $parametro = $this->Parametro_model->get_parametros();
        $this->parametros = $parametro[0];
        $empresa = $this->Empresa_model->get_empresa(1);
        $this->empresa = $empresa[0];

        
    }
    
    private function acceso($id_rol){
        
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
     * Listing of unidad
     */
    function index()
    {
        $data['sistema'] = $this->sistema;
        
        if($this->acceso(136)){
            
            $data['parametro'] = $this->parametros;
            $data['Empresa'] = $this->empresa;
            
            $moneda_id = $this->parametros['moneda_id'];
            $sql = "select * from moneda where moneda_id <> {$moneda_id}";
            $moneda = $this->Venta_model->Consultar($sql);
            $data['moneda'] = $moneda[0];
            
            $sql = "select * from moneda where moneda_id = {$moneda_id}";
            $moneda = $this->Venta_model->Consultar($sql);
            $data['lamoneda'] = $moneda[0];
            
            $data['productos'] = $this->Producto_precios_model->get_all_productos();
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['page_title'] = "Lista de Precios";
            $data['_view'] = 'producto_precios/index';
            $this->load->view('layouts/main',$data);
            
        }
          
    }

    
    public function cargar_producto_precios()
    {
        $this->Producto_model->cargar_producto_precios();
        echo "Datos copiados de 'producto' a 'producto_precios'.";
    }    
    
    /*
     * Adding a new unidad
     */
    function add()
    {   
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('unidad_nombre','Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
        if($this->form_validation->run())     
        {
            $params = array(
				'unidad_nombre' => $this->input->post('unidad_nombre'),
            );
            
            $unidad_id = $this->Producto_precios_model->add_productos($params);
            redirect('unidad/index');
        }
        else
        {
            $data['page_title'] = "Producto_precios";
            $data['_view'] = 'unidad/add';
            $this->load->view('layouts/main',$data);
        }
        }
            
    }  

    /*
     * Editing a unidad
     */
    function edit($unidad_id)
    {   
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
        // check if the tipo_servicio exists before trying to edit it
        $data['unidad'] = $this->Producto_precios_model->get_productos($unidad_id);
        
        if(isset($data['unidad']['unidad_id']))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('unidad_nombre','Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
                $params = array(
                            'unidad_nombre' => $this->input->post('unidad_nombre'),
                );

                $this->Producto_precios_model->update_productos($unidad_id,$params);            
                redirect('unidad/index');
            }
            else
            {
                $data['page_title'] = "Producto_precios";
                $data['_view'] = 'unidad/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('La Producto_precios que estas intentando editar no existe.');
        }
           
    } 

    /*
     * Deleting unidad
     */
    function remove($unidad_id)
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            $data['unidad'] = $this->Producto_precios_model->get_productos($unidad_id);
            if(isset($data['unidad']['unidad_id'])){
                $this->Producto_precios_model->delete_productos($unidad_id);
                redirect('unidad/index');
            }else{
                show_error('La unidad que estas intentando eliminar no existe.');
            }
        }
    }
    /*
    * buscar productos
    */
    function verificar_uso()
    { 
        $data['sistema'] = $this->sistema;
        if($this->input->is_ajax_request()){
            $nombre_productos = $this->input->post('nombre_productos');
            $datos = $this->Producto_precios_model->get_productos_usada($nombre_productos);
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }
           
    }
    
    function cargar_precios()
    { 
        $data['sistema'] = $this->sistema;
        if($this->input->is_ajax_request()){
            
            $sql = "truncate producto_precios";
            $this->Venta_model->Ejecutar($sql);
            
            $sql = "INSERT INTO producto_precios 
                    (producto_id, producto_nombre, producto_codigobarra, producto_costo, producto_precio, producto_tipocambio, 
                    producto_precioactualizado, producto_preciofactor, producto_preciofactor1, producto_preciofactor2, 
                    producto_preciofactor3, producto_preciofactor4, producto_ultimocosto, 
                    producto_costoenvase, producto_precioenvase)
                    
                    SELECT p.producto_id, p.producto_nombre, p.producto_codigobarra, p.producto_costo, p.producto_precio, 
                    p.producto_tipocambio, p.producto_precio, p.producto_preciofactor, p.producto_preciofactor1, 
                    p.producto_preciofactor2, p.producto_preciofactor3, p.producto_preciofactor4, 
                    p.producto_ultimocosto, p.producto_costoenvase, p.producto_precioenvase
                    FROM producto p";
            $this->Venta_model->Ejecutar($sql);

           
            echo json_encode(true);
        }
        else
        {                 
            show_404();
        }
           
    }
    
    
    function actualizar_precios()
    { 
        $data['sistema'] = $this->sistema;
        if($this->input->is_ajax_request()){
            
            $operacion = $this->input->post("operacion");
            $afectar = $this->input->post("afectar");
            $redondear = $this->input->post("redondear");
            $razon = $this->input->post("razon");
            
            $decimales = 16;
            
            if($operacion==1){//actualizacion de valor
           
                $sql = "update producto_precios set producto_precioactualizado = round(producto_precio * {$razon},{$decimales})";
                
            }
            
            if($operacion==2){//MOdificar el precio
                
                $sql = "update producto_precios set producto_precioactualizado = round(producto_precio * {$razon},{$decimales})";
                
            }
            
            if($operacion==3){//incrementar al precio
                
                
            }
            
           
            $this->Venta_model->Ejecutar($sql);
            

            if($redondear==1){ //CONVERTIR LOS DECIMALES EN 0.50 CTVS
                $sql =  "update producto_precios set producto_precioactualizado = if((producto_precioactualizado - truncate(producto_precioactualizado,0))>0,truncate(producto_precioactualizado,0)+0.5,producto_precioactualizado)";
            }
            
            if($redondear==2){//REDONDEAR AL SUPERIOR
                $sql =  "update producto_precios set producto_precioactualizado = if((producto_precioactualizado - truncate(producto_precioactualizado,0))>0,truncate(producto_precioactualizado,0)+1,producto_precioactualizado)";
            }
            
            if($redondear==3){//REDONDEAR AL INFERIOR
                $sql =  "update producto_precios set producto_precioactualizado = if((producto_precioactualizado - truncate(producto_precioactualizado,0))>0,truncate(producto_precioactualizado,0),producto_precioactualizado)";
            }

            if($redondear==4){//TRUNCAR (SIN DECIMALES, SOLO ENTEROS)
                $sql =  "update producto_precios set producto_precioactualizado = if((producto_precioactualizado - truncate(producto_precioactualizado,0))>0,truncate(producto_precioactualizado,0)+0.5,producto_precioactualizado)";
            }
            
            $this->Venta_model->Ejecutar($sql);
            
            echo json_encode(true);
        }
        else
        {                 
            show_404();
        }
           
    }
    
}