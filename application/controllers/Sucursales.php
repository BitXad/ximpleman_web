<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Sucursales extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Inventario_model');
        $this->load->model('Empresa_model');
        $this->load->model('Producto_model');
        $this->load->model('Sucursales_model');
        $this->load->model('Parametro_model');
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
    }
    private function acceso($id_rol){
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
            $this->load->view('layouts/main',$data);
        }
    } 

    /*
     * Listing of producto
     */
    function index()
    {

        if($this->acceso(24)){
            
            
        //**************** inicio contenido ***************
        $producto_codigo = $this->input->post('producto_codigo');
        $parametro = $this->Parametro_model->get_parametros();
        
        
        if ($producto_codigo==0){
            
            $data['rolusuario'] = $this->session_data['rol'];
            $empresa_id = 1;
            $data['page_title'] = "Inventario";
            $data['empresa'] = $this->Empresa_model->get_empresa($empresa_id);
            $data['_view'] = 'sucursales/index';
            $this->load->view('layouts/main',$data);
        }
        else{
            
            $data['rolusuario'] = $this->session_data['rol'];
            $empresa_id = 1;
            
            $data['page_title'] = "centralizador";
            $data['empresa'] = $this->Empresa_model->get_empresa($empresa_id);
            
            $sql = "select *,empresa_nombre,empresa_direccion from inventario, empresa  where producto_codigobarra = '".$producto_codigo."'";
 
            if($parametro[0]["parametro_sucursales"]<=1){
                $suc0 = $this->Sucursales_model->consulta_sucursal0($sql);    
                $suc1 = null;
                $suc2 = null;
                $suc3 = null;
                $suc4 = null;
                $suc5 = null;
            }
            

            if($parametro[0]["parametro_sucursales"]==2){
                $suc0 = $this->Sucursales_model->consulta_sucursal0($sql);    
                $suc1 = $this->Sucursales_model->consulta_sucursal1($sql);
                $suc2 = null;
                $suc3 = null;
                $suc4 = null;
                $suc5 = null;
            }
            

            if($parametro[0]["parametro_sucursales"]==3){
                $suc0 = $this->Sucursales_model->consulta_sucursal0($sql);    
                $suc1 = $this->Sucursales_model->consulta_sucursal1($sql);
                $suc2 = $this->Sucursales_model->consulta_sucursal2($sql);
                $suc3 = null;
                $suc4 = null;
                $suc5 = null;
            }

            if($parametro[0]["parametro_sucursales"]==4){
                $suc0 = $this->Sucursales_model->consulta_sucursal0($sql);    
                $suc1 = $this->Sucursales_model->consulta_sucursal1($sql);
                $suc2 = $this->Sucursales_model->consulta_sucursal2($sql);
                $suc3 = $this->Sucursales_model->consulta_sucursal3($sql);
                $suc4 = null;
                $suc5 = null;
            }
            

            if($parametro[0]["parametro_sucursales"]==5){
                $suc0 = $this->Sucursales_model->consulta_sucursal0($sql);    
                $suc1 = $this->Sucursales_model->consulta_sucursal1($sql);
                $suc2 = $this->Sucursales_model->consulta_sucursal2($sql);
                $suc3 = $this->Sucursales_model->consulta_sucursal3($sql);
                $suc4 = $this->Sucursales_model->consulta_sucursal4($sql);
                $suc5 = null;
            }

            if($parametro[0]["parametro_sucursales"]==6){
                $suc0 = $this->Sucursales_model->consulta_sucursal0($sql);    
                $suc1 = $this->Sucursales_model->consulta_sucursal1($sql);
                $suc2 = $this->Sucursales_model->consulta_sucursal2($sql);
                $suc3 = $this->Sucursales_model->consulta_sucursal3($sql);
                $suc4 = $this->Sucursales_model->consulta_sucursal4($sql);
                $suc5 = $this->Sucursales_model->consulta_sucursal5($sql);
            }
            
            $suc =  array($suc0,$suc1,$suc2,$suc3,$suc4,$suc5);
            $data['inventario'] = $suc;
            
            $data['_view'] = 'sucursales/index';
            $this->load->view('layouts/main',$data);
            
        }
	
        //**************** fin contenido ***************
        }
			
    }

    /*
     * Kadex de producto
     */
    function kardex($producto_id)
    {

        if($this->acceso(29)){
        //**************** inicio contenido ***************
		  
                
        $empresa_id = 1;
        //$producto_id = $this->input->post('producto_id');
        
        $data['page_title'] = "Kardex";
        $data['empresa'] = $this->Empresa_model->get_empresa($empresa_id);
        $data['producto'] = $this->Producto_model->get_producto($producto_id);
        $data['producto_id'] = $producto_id;
        

        $data['_view'] = 'inventario/kardex';
        $this->load->view('layouts/main',$data);
//        
        
	
        //**************** fin contenido ***************
			}
			 
        
    }
    /*
     * Kadex de producto
     */
    function buscar_kardex()
    {

        if($this->acceso(29)){
        //**************** inicio contenido ***************
		  
                
        $empresa_id = 1;
        $producto_id = $this->input->post('producto_id');
        $hasta = $this->input->post('hasta');
        $desde = $this->input->post('desde');
        
        $kardex = $this->Inventario_model->mostrar_kardex($desde, $hasta, $producto_id);
        echo json_encode($kardex);
          
        
	
        //**************** fin contenido ***************
			}
			      
        
    }

    /*
     * Elimina el contenido de la tabla inventario y lo carga nuevamente
     */
    function actualizar_inventario()
    {   

        if($this->acceso(26)){
        //**************** inicio contenido ***************
		       
        $usuario_id = 1;
        
        $this->Inventario_model->actualizar_inventario();
        redirect('inventario/index');
		
        //**************** fin contenido ***************
			}
			
    }  

    /*
     * muestra inventario por parametro
     */
    function mostrar_inventario()
    {      
       

        if($this->acceso(25)){
        //**************** inicio contenido ***************
		
            $parametro = $this->input->post("parametro");
            if ($parametro=="" || $parametro==null)
                $resultado = $this->Inventario_model->get_inventario();                
            else
                $resultado = $this->Inventario_model->get_inventario_parametro($parametro);
            
            echo json_encode($resultado);            
		
        //**************** fin contenido ***************
			}
			
    }

    function mostrar_inventario_existencia()
    {      
       

        if($this->acceso(25)){
        //**************** inicio contenido ***************
        
            $parametro = $this->input->post("parametro");
            if ($parametro=="" || $parametro==null)
                $resultado = $this->Inventario_model->get_inventario_existencia();                
            else
                $resultado = $this->Inventario_model->get_inventario_parametro_existencia($parametro);
            
            echo json_encode($resultado);            
        
        //**************** fin contenido ***************
            }
            
    }    
    
    /*
     * Adding a new producto
     */
    function actualizar_cantidad_inventario()
    {   

        if($this->acceso(26)){
        //**************** inicio contenido ***************
		       
        $usuario_id = 1;
        
        $this->Inventario_model->actualizar_cantidad_inventario();
        redirect('inventario/index');
		
        //**************** fin contenido ***************
			}
			
    }  
    
    /*
     * muestra los productos duplicados en inventario
     */
    function mostrar_duplicados()
    {
     

        if($this->acceso(28)){
        //**************** inicio contenido ***************
		        
        if($this->input->is_ajax_request()){
            
            $resultado = $this->Inventario_model->mostrar_duplicados_inventario();
            echo json_encode($resultado);      
            
        }
        else echo false;
		
        //**************** fin contenido ***************
			}

    }

    function generar_excel()
    {
            $llamadas = $this->Inventario_model->get_inventario();
            echo json_encode($llamadas); 
     
    }
    
    
}