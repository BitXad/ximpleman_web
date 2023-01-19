<?php
 
class Plan_cuentas extends CI_Controller{
    private $sistema;
    function __construct(){
        parent::__construct();
        $this->load->model([
            'Plan_cuenta_model',
        ]);
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    }
    
    function acceso($id_rol){
        
        $data['sistema'] = $this->sistema;
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
            $this->load->view('layouts/main',$data);
        }
    }

    function index(){
        
        $data['sistema'] = $this->sistema;
        // if($this->acceso(102)) {
            $data['rol'] = $this->session_data['rol'];
            $data['p_cuentas'] = $this->Plan_cuenta_model->get_cuentas();
            $data['page_title'] = "Plan de cuentas";
            $data['_view'] = 'plan_cuentas/index';
            $this->load->view('layouts/main',$data);
        // }
    }

    function get_cuenta_hijo(){
        
        $data['sistema'] = $this->sistema;
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('p_cuenta_id');
            $cuentas = $this->Plan_cuenta_model->get_cuenta_hijos($id);
            echo json_encode($cuentas);
        }
    }

    function add(){
        
        $data['sistema'] = $this->sistema;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre','Nombre de cuenta','required');
        if($this->form_validation->run()){
            $tipo = $this->input->post('tipo');
            if ($tipo != 0) {
                $pc_id = $this->input->post('cuenta_mayor');
                $cuenta = $this->Plan_cuenta_model->get_cuenta($pc_id);
                $c_mayor = $cuenta['p_cuenta_id'];
                $c_nivel = ($cuenta['p_cuenta_nivel'] + 1);
                $cuenta_id = "and pc.p_cuenta_mayor = {$cuenta['p_cuenta_id']}";
            }else{
                $c_tipo = $this->Plan_cuenta_model->ultima_cuenta_tipo();
                $tipo = $c_tipo['ultimo'];
                $c_mayor = 0;
                $c_nivel = 1;
                $cuenta_id = "";
            }
            $ultimo_num = $this->Plan_cuenta_model->get_ultimo_cnum($c_nivel , $cuenta_id);//2 1
            $c_num = $ultimo_num['ultimo'];
            $nombre = $this->input->post('nombre');
            
            $params = [
                'p_cuenta_nombre' => $nombre,
                'p_cuenta_nivel' => $c_nivel,
                'p_cuenta_tipo' => $tipo,
                'p_cuenta_mayor' => $c_mayor,
                'p_cuenta_num' => $c_num,
            ];
            $this->Plan_cuenta_model->add($params);
            redirect('plan_cuentas/index');
        }
    }

    function get_cuentas(){
        
        $data['sistema'] = $this->sistema;
        if ($this->input->is_ajax_request()){
            $p_cuenta_tipo = $this->input->post('tipo');
            $p_cuenta_nivel = $this->input->post('nivel');
            $datos = $this->Plan_cuenta_model->get_plan_cuentas($p_cuenta_tipo,$p_cuenta_nivel);
            
            echo json_encode($datos);
        }
    }
    /**
     * obtener planes de cuentas por su tipo
     */
    function get_tipo_planes(){
        
        $data['sistema'] = $this->sistema;
        if ($this->input->is_ajax_request()){
            $pc_tipo = $this->input->post('tipo');
            if ($pc_tipo != 0) {
                $planes = $this->Plan_cuenta_model->get_tipo_planes($pc_tipo);
                echo json_encode($planes);
            }
        }
    }

    function get_p_cuenta(){
        
        $data['sistema'] = $this->sistema;
        if($this->input->is_ajax_request()){
            $pc_id = $this->input->post("plan_escogido");
            $plan_cuenta = $this->Plan_cuenta_model->get_p_cuenta($pc_id);
            echo json_encode($plan_cuenta);
        }
    }

    /**
     * edit
     */
    function edit(){
        
        $data['sistema'] = $this->sistema;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('new_nombre','Nombre de cuenta','required');
        if($this->form_validation->run()){
            $c_id = $this->input->post("cuenta_mayor_edit");
            $cuenta = $this->Plan_cuenta_model->get_p_cuenta($c_id);
            if (isset($cuenta['p_cuenta_id'])) {
                $id = $cuenta['p_cuenta_id'];
                $params = [
                    'p_cuenta_nombre' => $this->input->post("new_nombre"),
                ];
                $this->Plan_cuenta_model->update_plan_cuenta($id,$params);
            }
            redirect('plan_cuentas/index');
        }
    }
    /**
     * borrar plan cuenta
     */
    function borrar_plan_cuenta(){
        
        $data['sistema'] = $this->sistema;
        $c_id = $this->input->post("cuenta_mayor_borrar");
        $this->Plan_cuenta_model->delete_plan_cuenta($c_id);
        redirect('plan_cuentas/index');
    }
}