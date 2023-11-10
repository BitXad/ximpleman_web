<?php
class Almacen extends CI_Controller{
    private $session_data = "";
    private $sistema;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Almacen_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    } 
    /* *****Funcion que verifica el acceso al sistema**** */
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
     * Listing of almacen
     */
    function index()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(24)){
            $data['page_title'] = "Almacenes";
            
            $data['almacen'] = $this->Almacen_model->get_almacenes();

            $data['_view'] = 'almacen/index';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Adding a new almacen
     */
    function add()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(24)){
            $data['page_title'] = "Almacen";
            $this->load->library('form_validation');
            $this->form_validation->set_rules('almacen_nombre','Almacen nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('almacen_basedatos','Almacen base de datos','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('almacen_url','Almacen url','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
                $estado_id = 1; // 1 = ACTIVO
                $params = array(
                    'estado_id' => $estado_id,
                    'almacen_nombre' => $this->input->post('almacen_nombre'),
                    'almacen_descripcion' => $this->input->post('almacen_descripcion'),
                    'almacen_basedatos' => $this->input->post('almacen_basedatos'),
                    'almacen_url' => $this->input->post('almacen_url'),
                );

                $almacen_id = $this->Almacen_model->add_almacen($params);
                redirect('almacen/index');
            }
            else
            {            
                $data['_view'] = 'almacen/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }  

    /*
     * Editing a almacen
     */
    function edit($almacen_id)
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(24)){
            $data['page_title'] = "Almacen";
            // check if the almacen exists before trying to edit it
            $data['almacen'] = $this->Almacen_model->get_almacen($almacen_id);
            if(isset($data['almacen']['almacen_id']))
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('almacen_nombre','Almacen nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                $this->form_validation->set_rules('almacen_basedatos','Almacen base de datos','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                $this->form_validation->set_rules('almacen_url','Almacen url','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run())     
                {
                    $params = array(
                        'estado_id' => $this->input->post('estado_id'),
                        'almacen_nombre' => $this->input->post('almacen_nombre'),
                        'almacen_descripcion' => $this->input->post('almacen_descripcion'),
                        'almacen_basedatos' => $this->input->post('almacen_basedatos'),
                        'almacen_url' => $this->input->post('almacen_url'),
                    );
                    $this->Almacen_model->update_almacen($almacen_id,$params);            
                    redirect('almacen/index');
                }
                else
                {
                    $this->load->model('Estado_model');
                    $tipo = 1;
                    $data['all_estado'] = $this->Estado_model->get_estado_tipo($tipo);
                    $data['_view'] = 'almacen/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The almacen you are trying to edit does not exist.');
        }
    } 

    /*
     * Deleting almacen
     */
    function remove($almacen_id)
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(24)){
        $almacen = $this->Almacen_model->get_almacen($almacen_id);
        // check if the almacen exists before trying to delete it
        if(isset($almacen['almacen_id']))
        {
            $this->Almacen_model->delete_almacen($almacen_id);
            redirect('almacen/index');
        }
        else
            show_error('The almacen you are trying to delete does not exist.');
        }
    }
    
}
