<?php

class Ubicacion_producto extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Ubicacion_model');
        $this->load->model('Control_inventario_model');
        $this->load->model('Control_ubicacion_model');
        $this->load->model('Ubicacion_producto_model');
        $this->load->model('Estado_model');
        $this->load->model('Categoria_producto_model');
        // $this->load->model('Control_inventario_aux_model');
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
     * Listing of unidad
     */
    function index($controlu_id, $controli_id ,$imprimir = 0){
        if($this->acceso(136)){
            $data['controli_id'] = $controli_id;
            $data['controlu_id'] = $controlu_id;
            $data['control_ubicacion'] = $this->Control_ubicacion_model->get_control_ubicacion($controlu_id);
            $data['ubicacion'] = $this->Control_ubicacion_model->get_ubicacion($controlu_id);
            $data['ubi_productos'] = $this->Ubicacion_producto_model->get_all_producto_ubicacion($controlu_id);
            $data['all_categoria'] = $this->Categoria_producto_model->get_all_categoria_de_producto();
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['imprimir'] = $imprimir;
            $data['all_estado'] = $this->Estado_model->get_all_estado_activo_inactivo();
            $data['page_title'] = "Productos de la ubicacion";
            $data['_view'] = 'ubicacion_producto/index';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Adding a new producto ubicacion
     */
    function add(){   
        // if($this->acceso(136)){
            
        $params = array(
            'ubicacion_id' => $this->input->post('ubicacion'),
            'producto_id' => $this->input->post('producto'),
            'controlu_id' => $this->input->post('control_inventario'),
            'ubiprod_existencia' => $this->input->post('ubiprod_existencia'),
        );
        $this->Ubicacion_producto_model->add_ubicacion_producto($params);
    }  

    /*
     * Editing a unidad
     */
    function edit($ubicacion_id){   
        if($this->acceso(136)){
            // check if the tipo_servicio exists before trying to edit it
            $data['ubicacion'] = $this->Ubicacion_model->get_ubicacion($ubicacion_id);
            
            if(isset($data['ubicacion']['ubicacion_id'])){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('ubicacion_nombre','Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run()){
                    $params = array(
                        'estado_id' => $this->input->post('estado'),
                        'ubicacion_nombre' => $this->input->post('ubicacion_nombre'),
                        'ubicacion_descripcion' => $this->input->post('ubicacion_descripcion'),
                    );

                    $this->Ubicacion_model->update_ubicacion($ubicacion_id,$params);            
                    redirect('ubicacion/index');
                }else{
                    $data['estados'] = $this->Estado_model->get_all_estado_activo_inactivo  ();
                    $data['page_title'] = "Ubicacion";
                    $data['_view'] = 'ubicacion/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('La Ubiacion que estas intentando editar no existe.');
        }           
    }
    /** 
     * Revisa si existe algun producto ya registrado en otra ubicacion
    */
    function verificar_existencia(){
        $producto = $this->input->post("producto");
        $controli_id = $this->input->post("controli_id");
        $result = $this->Ubicacion_producto_model->buscar_existencia($producto, $controli_id);
        echo json_encode($result);
    }


    function delete(){
        if ($this->input->is_ajax_request()) {
            $ubi_producto = $this->input->post("ubi_producto");
            $this->Ubicacion_producto_model->delete_ubi_prod($ubi_producto);
            echo json_encode("ok");
        }else{
            show_404();
        }
    }

    function actualizar_inventario(){
        if($this->input->is_ajax_request()){
            $ubi_productos = $this->input->post("ubi_productos");
            foreach ($ubi_productos as $ubi_producto){
                $data['ubiprod'] = $this->Ubicacion_producto_model->get_ubicacion_producto($ubi_producto['ubiprod_id']);
            
                if(isset($data['ubiprod']['ubiprod_id'])){                   
                    $params = array(
                        'ubicacion_id' => $ubi_producto['ubicacion_id'],
                        'producto_id' => $ubi_producto['producto_id'],
                        // 'controlu_id' => $ubi_producto['control_inventario_id'],
                        'ubiprod_existencia' => $ubi_producto['ubiprod_existencia'],
                        'ubiprod_existenciafisico' => $ubi_producto['ubiprod_existenciafisico'],
                        'ubiprod_faltante' => $ubi_producto['ubiprod_faltante'],
                        'ubiprod_sobrante' => $ubi_producto['ubiprod_sobrante'],
                    );
                    $this->Ubicacion_producto_model->update_ubicacion_producto($ubi_producto['ubiprod_id'],$params);            
                }
            }

            // $controli = $this->Control_inventario_model->get_control_inventario($ubi_productos[0]['control_inventario_id']);
            // if(isset($controli)){
            //     $estado = 26; //cambiar a estado terminado
            //     $fecha = date('Y-m-d');
            //     $hora = date('H:i:s');
            //     $params2 = array(
            //             'estado_id' => $estado,
            //             'controli_fecha_fin' => $fecha,
            //             'controli_hora_fin' => $hora,
            //         );  
            //     $this->Control_inventario_model->update_control_inventario($controli['controli_id'], $params2);
            // }
            
            // redirect('control_inventario');
        }
    }
}
