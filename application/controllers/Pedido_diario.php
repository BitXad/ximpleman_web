<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Pedido_diario extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pedido_diario_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
    } 

    /* *****Funcion que verifica el acceso al sistema**** */
    private function acceso($id_rol){
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
//            $data['_view'] = 'login/mensajeacceso';
//            $this->load->view('layouts/main',$data);
            return false;
        }
    }     
    
    /*
     * Listing of pedido_diario
     */
    function index()
    {
        
        if($this->acceso(12)){
        //**************** inicio contenido ***************   
            $data['pedido_diario'] = $this->Pedido_diario_model->get_all_pedido_diario();

            $data['_view'] = 'pedido_diario/index';
            $this->load->view('layouts/main',$data);
            
        }   
        
    }

    /*
     * Adding a new pedido_diario
     */
    function add()
    {   
                
        if($this->acceso(12)){
        //**************** inicio contenido ***************   
        $usuario_id = $this->session_data['usuario_id'];
        
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'proveedor_id' => $this->input->post('proveedor_id'),
				'pedido_montototal' => $this->input->post('pedido_montototal'),
				'pedido_fecha' => $this->input->post('pedido_fecha'),
				'pedido_estado' => $this->input->post('pedido_estado'),
				'pedido_fecharegistro' => $this->input->post('pedido_fecharegistro'),
				'pedido_resumen' => $this->input->post('pedido_resumen'),
				'usuario_id' => $usuario_id,
            );
            
            $pedido_diario_id = $this->Pedido_diario_model->add_pedido_diario($params);
            redirect('pedido_diario/index');
        }
        else
        {
			$this->load->model('Proveedor_model');
			$data['all_proveedor'] = $this->Proveedor_model->get_all_proveedor();
            
            $data['_view'] = 'pedido_diario/add';
            $this->load->view('layouts/main',$data);
        }
        
        }//fin session
    }  

    /*
     * Adding a new pedido_diario
     */
    function pedido_nuevo()
    {   
        
        if($this->acceso(12)){
        //**************** inicio contenido ***************   
        $usuario_id = $this->session_data['usuario_id'];
            
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'proveedor_id' => $this->input->post('proveedor_id'),
				'pedido_montototal' => $this->input->post('pedido_montototal'),
				'pedido_fecha' => $this->input->post('pedido_fecha'),
				'pedido_estado' => $this->input->post('pedido_estado'),
				'pedido_fecharegistro' => $this->input->post('pedido_fecharegistro'),
				'pedido_resumen' => $this->input->post('pedido_resumen'),
				'usuario_id' => $usuario_id,
            );
            
            $pedido_diario_id = $this->Pedido_diario_model->add_pedido_diario($params);
            redirect('admin/dashb');
        }
        else
        {
			$this->load->model('Proveedor_model');
			$data['all_proveedor'] = $this->Proveedor_model->get_all_proveedor();
            
            $data['_view'] = 'pedido_diario/pedido_nuevo';
            $this->load->view('layouts/main',$data);
        }

        //**************** fin inicio contenido ***************               
        }
    }  

    /*
     * Editing a pedido_diario
     */
    function edit($pedido_id)
    {   
        
        if($this->acceso(12)){
        //**************** inicio contenido ***************   
        
        
       $data['pedido_diario'] = $this->Pedido_diario_model->get_pedido_diario($pedido_id);
        
        if(isset($data['pedido_diario']['pedido_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'proveedor_id' => $this->input->post('proveedor_id'),
					'usuario_id' => $this->input->post('usuario_id'),
					'pedido_montototal' => $this->input->post('pedido_montototal'),
					'pedido_fecha' => $this->input->post('pedido_fecha'),
					'pedido_estado' => $this->input->post('pedido_estado'),
					'pedido_fecharegistro' => $this->input->post('pedido_fecharegistro'),
					'pedido_resumen' => $this->input->post('pedido_resumen'),
                );

                $this->Pedido_diario_model->update_pedido_diario($pedido_id,$params);            
                redirect('pedido_diario/index');
            }
            else
            {
				$this->load->model('Proveedor_model');
				$data['all_proveedor'] = $this->Proveedor_model->get_all_proveedor();

				$this->load->model('Usuario_model');
				$data['all_usuario'] = $this->Usuario_model->get_all_usuario();

                $data['_view'] = 'pedido_diario/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The pedido_diario you are trying to edit does not exist.');

        //**************** fin inicio contenido ***************               
        }
        
    } 
    /*
     * Editing a pedido_diario
     */
    function modificar_pedido($pedido_id)
    {   
        
        if($this->acceso(12)){
        //**************** inicio contenido ***************   
        
        
       $data['pedido_diario'] = $this->Pedido_diario_model->get_pedido_diario($pedido_id);
        
        if(isset($data['pedido_diario']['pedido_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'proveedor_id' => $this->input->post('proveedor_id'),
					'usuario_id' => $this->input->post('usuario_id'),
					'pedido_montototal' => $this->input->post('pedido_montototal'),
					'pedido_fecha' => $this->input->post('pedido_fecha'),
					'pedido_estado' => $this->input->post('pedido_estado'),
					'pedido_fecharegistro' => $this->input->post('pedido_fecharegistro'),
					'pedido_resumen' => $this->input->post('pedido_resumen'),
                );

                $this->Pedido_diario_model->update_pedido_diario($pedido_id,$params);            
                redirect('admin/dashb');
            }
            else
            {
				$this->load->model('Proveedor_model');
				$data['all_proveedor'] = $this->Proveedor_model->get_all_proveedor();

				$this->load->model('Usuario_model');
				$data['all_usuario'] = $this->Usuario_model->get_all_usuario();

                $data['_view'] = 'pedido_diario/modificar_pedido';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The pedido_diario you are trying to edit does not exist.');

        //**************** fin inicio contenido ***************               
        }
        
    } 

    /*
     * Deleting pedido_diario
     */
    function remove($pedido_id)
    {
        
        if($this->acceso(12)){
        //**************** inicio contenido ***************   
        
        $pedido_diario = $this->Pedido_diario_model->get_pedido_diario($pedido_id);

        // check if the pedido_diario exists before trying to delete it
        if(isset($pedido_diario['pedido_id']))
        {
            $this->Pedido_diario_model->delete_pedido_diario($pedido_id);
            redirect('pedido_diario/index');
        }
        else
            show_error('The pedido_diario you are trying to delete does not exist.');

        //**************** fin inicio contenido ***************               
        }        
        
    }

    /*
     * Deleting pedido_diario
     */
    function buscar_pedidos()
    {
        if($this->acceso(12)){
        //**************** inicio contenido ***************   
           
        $select_pedido = 0;
        $select_pedido = $this->input->post('select_fecha');
        $calendario = $this->input->post('calendario');
        $opcion = $this->input->post('opcion');

                
                
        if ($opcion==1){
                
            if($select_pedido == 1){
                    $sql = "select d.*, p.proveedor_nombre, u.* from pedido_diario d
                    left join proveedor p on p.proveedor_id = d.proveedor_id
                    left join usuario u on u.usuario_id = d.usuario_id
                    where pedido_fecha = date(now())
                    order by pedido_fecha asc";
            }

            if($select_pedido == 2){
                    $sql = "select d.*, p.proveedor_nombre, u.* from pedido_diario d
                    left join proveedor p on p.proveedor_id = d.proveedor_id
                    left join usuario u on u.usuario_id = d.usuario_id
                    where pedido_fecha = date( date_add(NOW(), INTERVAL +1 DAY))
                    order by pedido_fecha asc";
            }


            if($select_pedido == 3){
                    $sql = "select d.*, p.proveedor_nombre, u.* from pedido_diario d
                    left join proveedor p on p.proveedor_id = d.proveedor_id
                    left join usuario u on u.usuario_id = d.usuario_id
                    where pedido_fecha = date( date_add(NOW(), INTERVAL -1 DAY))
                    order by pedido_fecha asc";
            }
        }
        else{
            
                $sql = "select d.*, p.proveedor_nombre, u.* from pedido_diario d
                left join proveedor p on p.proveedor_id = d.proveedor_id
                left join usuario u on u.usuario_id = d.usuario_id
                where pedido_fecha = '".$calendario."'
                order by pedido_fecha asc";
        }
            
       $resultado = $this->Pedido_diario_model->consultar($sql);
        echo json_encode($resultado); 
        

        //**************** fin inicio contenido ***************               
        }
    }
    
}