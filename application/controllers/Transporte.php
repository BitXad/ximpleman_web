<?php
class Transporte extends CI_Controller{
    private $session_data = "";
    private $sistema;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Vehiculo_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    } 
    /* *****Funcion que verifica el acceso al sistema**** */
//    private function acceso($id_rol){
//        $data['sistema'] = $this->sistema;
//        $rolusuario = $this->session_data['rol'];
//        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
//            return true;
//        }else{
//            $data['_view'] = 'login/mensajeacceso';
//            $this->load->view('layouts/main',$data);
//        }
//    }
    /*
     * Listing of almacen
     */
    function index()
    {
        $data['sistema'] = $this->sistema;
            $vehiculo_id = 1;
//        if($this->acceso(24)){
            $data['page_title'] = "Transporte";
            $result = $this->Vehiculo_model->get_by_id($vehiculo_id);            
            $data['vehiculo'] = $result;
            //$data['ayudas'] = $this->Transporte_model->get_ultimos_videos();

            $data['_view'] = 'transporte/index';
            $this->load->view('layouts/main',$data);
//        }
    }
    
    function menu_principal()
    {
        $data['sistema'] = $this->sistema;
//        if($this->acceso(24)){
            $data['page_title'] = "Transporte";

            
            //$data['ayudas'] = $this->Transporte_model->get_ultimos_videos();
            
            $data['_view'] = 'transporte/menu_principal';
            $this->load->view('layouts/main',$data);
//        }
    }


    // Mostrar formulario para crear un nuevo registro
    public function create() {
        
        $data['sistema'] = $this->sistema;
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('ayuda_formato', 'Formato', 'required');
        $this->form_validation->set_rules('ayuda_enlace', 'Enlace', 'required');
        // Añadir más reglas según sea necesario
        $data['page_title'] = "Registrar nuevo video";

        if ($this->form_validation->run() === FALSE) {
            
            
            //$this->load->view('ayuda/create');
            
            $data['_view'] = 'ayuda/create';
            $this->load->view('layouts/main',$data);
            
        } else {
            $data = array(
                'ayuda_formato' => $this->input->post('ayuda_formato'),
                'ayuda_enlace' => $this->input->post('ayuda_enlace'),
                'ayuda_tipo' => $this->input->post('ayuda_tipo'),
                'ayuda_titulo' => $this->input->post('ayuda_titulo'),
                'ayuda_subtitulo' => $this->input->post('ayuda_subtitulo'),
                'ayuda_texto' => $this->input->post('ayuda_texto'),
                'ayuda_mensaje' => $this->input->post('ayuda_mensaje')
            );
            $this->Transporte_model->set_ayuda($data);
            redirect('ayuda');
            
            
            
        }
    }

    // Mostrar formulario para editar un registro
    public function edit($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('ayuda_formato', 'Formato', 'required');
        $this->form_validation->set_rules('ayuda_enlace', 'Enlace', 'required');
        // Añadir más reglas según sea necesario

        $data['ayuda'] = $this->Transporte_model->get_ayuda($id);
        if (empty($data['ayuda'])) {
            show_404();
        }

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('ayuda/edit', $data);
        } else {
            $data = array(
                'ayuda_formato' => $this->input->post('ayuda_formato'),
                'ayuda_enlace' => $this->input->post('ayuda_enlace'),
                'ayuda_tipo' => $this->input->post('ayuda_tipo'),
                'ayuda_titulo' => $this->input->post('ayuda_titulo'),
                'ayuda_subtitulo' => $this->input->post('ayuda_subtitulo'),
                'ayuda_texto' => $this->input->post('ayuda_texto'),
                'ayuda_mensaje' => $this->input->post('ayuda_mensaje')
            );
            $this->Transporte_model->update_ayuda($id, $data);
            redirect('ayuda');
        }
    }

    // Eliminar un registro
    public function delete($id) {
        $this->Transporte_model->delete_ayuda($id);
        redirect('ayuda');
    }
    
    function actualizarvideos()
    {
        
        $this->index();
    }
    
    function buscador()
    {
        
        $parametro = $this->input->post('parametro');
        $origen = $this->input->post('origen');
        
            
        $resultado = $this->Transporte_model->get_ayuda($parametro,$origen);
        
        echo json_encode($resultado);
    }
    
}