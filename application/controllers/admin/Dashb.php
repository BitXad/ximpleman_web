<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashb extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation'));
        $this->load->database();
        $this->load->model('user_model');
        $this->load->model('Pedido_model');
        $this->load->model('Venta_model');
        $this->load->model('Compra_model');
        $this->load->model('Cliente_model');
        $this->load->model('Empresa_model');
        $this->load->model('Producto_model');
        $this->load->model('Servicio_model');
        $this->load->model('Pedido_diario_model');
        $this->load->model('Cliente_model');
        $this->load->model('Categoria_clientezona_model');
        $this->load->model('Objetivo_model');
        $this->load->model('Parametro_model');
        $this->load->model('Moneda_model');
        // $this->load->model('Dashb_model');

        $this->session_data = $this->session->userdata('logged_in');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1){

                $data['page_title'] = 'Principal';
                $data['empresa'] = $this->Empresa_model->get_all_empresa();
                $data['ventas'] = $this->Venta_model->get_ventas_dia();
                $data['pedidos'] = $this->Pedido_model->get_pedidos_dia();
                $data['compras'] = $this->Compra_model->get_compras_dia();
                $data['clientes'] = $this->Cliente_model->get_clientes();
                $data['productos'] = $this->Inventario_model->get_inventario_total();
                $data['servicios'] = $this->Servicio_model->get_servicios_hoy();
                $data['pedidos_diarios'] = $this->Pedido_diario_model->pedidos_diarios();
                
                $data['resumen_usuario'] = $this->Venta_model->get_resumen_usuarios();
                $data['ventas_semanales'] = $this->Venta_model->get_ventas_semanales();
                $data['parametro'] = $this->Parametro_model->get_parametros();
                $data['moneda'] = $this->Moneda_model->get_moneda(2); //Obtener moneda extragera                
                $data['usuario_imagen'] = $session_data['usuario_imagen'];
                $data['usuario'] = $session_data['usuario_id'];
                
                $data['tipousuario_id'] = $session_data['tipousuario_id'];
                $data['_view'] = 'hola';
                $this->load->view('layouts/main',$data);

            }else{
                // redirect('alerta');
                $url = "/dashb/index_user";
                header("Location: .$url");
                die();
            }
        } else {
            redirect('', 'refresh');
        }
    }
    
    // ----------------------------------------------------------
    public function index_user(){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id'] > 1){

                $data['page_title'] = 'Principal';
                $data['ventas'] = $this->Venta_model->get_ventas_dia_usuario($session_data['usuario_id']);
                $data['pedidos'] = $this->Pedido_model->get_pedidos_dia_usuario($session_data['usuario_id']);
                $data['creditos'] = $this->Venta_model->get_venta_credito($session_data['usuario_id']);
                $data['clientes'] = $this->Cliente_model->get_cliente_all_asignados($session_data['usuario_id']);//cantidad de clientes asignados a un usuario
                $data['pedidos_diarios'] = $this->Pedido_diario_model->pedidos_diarios();
                $data['objetivo'] = $this->Objetivo_model->get_objetivo($session_data['usuario_id']);
                $data['ventas_mes'] = $this->Venta_model->get_ventas_mes($session_data['usuario_id']);
                $data['entregas_dia'] = $this->Venta_model->get_venta_entrega_dia($session_data['usuario_id']);
                $data['entregas_mes'] = $this->Venta_model->get_venta_entrega_mes($session_data['usuario_id']);

                $data['resumen_usuario'] = $this->Venta_model->get_resumen_usuarios();
                $data['usuario_imagen'] = $session_data['usuario_imagen'];
                
                $fecha_desde = date("Y-m-d",strtotime(date('Y-m-d')."- 1 day"));//ayer
                $fecha_hasta = date('Y-m-d');//hoy
                $zona_id = 0;

                $data['all_cliente'] = $this->Cliente_model->get_clientes_visitados($fecha_desde,$fecha_hasta,$zona_id);
                $data['zona'] = $this->Categoria_clientezona_model->get_categoria_clientezona($zona_id);
                $data['all_pedido'] = $this->Pedido_model->get_para_entregas($session_data['usuario_id'], $fecha_desde, $fecha_hasta);
                $data['usuario'] = $session_data['usuario_id'];
                //$this->load->model('Parametro_model');
                $data['parametro'] = $this->Parametro_model->get_parametros();
                //$this->load->model('Moneda_model');
                //$data['moneda'] = $this->Moneda_model->get_moneda(2); //Obtener moneda extragera
                //$data['lamoneda'] = $this->Moneda_model->getalls_monedasact_asc();
                $data['tipousuario_id'] = $session_data['tipousuario_id'];
                $data['_view'] = 'dashboard_noad';
                $this->load->view('layouts/dashb_noad',$data);
            }else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }
    // ----------------------------------------------------------

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('', 'refresh');
    }

    public function cuenta()
    {
        $this->acceso();

        $session_data = $this->session->userdata('logged_in');

            $data = array(
                'usuario_login' => $session_data['usuario_login'],
                'usuario_id' => $session_data['usuario_id'],
                'usuario_nombre' => $session_data['usuario_nombre'],
                'rol' => $this->getRol($session_data['tipousuario_id']),
                'tipousuario_id' => $session_data['tipousuario_id'],
                'usuario_imagen' => $session_data['usuario_imagen'],
                'usuario_email' => $session_data['usuario_email'],
                'page_title' => 'Admin >> Mi Cuenta',
                'thumb'=> $session_data['thumb']
            );
            $data['empresa'] = $this->Empresa_model->get_all_empresa();
            $data['user'] = $this->user_model->get_usuario($session_data['usuario_id']);
            $data['usuario_imagen'] = $session_data['usuario_imagen'];

            //$data['main'] = $this->load->view('admin/form_cuenta',$data1, true);
            //$this->load->view('template/main',$data);

            $data['_view'] = 'admin/form_cuenta';
            $this->load->view('layouts/main',$data);

    }

    public function setu()
    {
        $this->acceso();

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[250]|callback_hay_email2');//OJO
        $this->form_validation->set_message('hay_email2', 'El email ya se registro, escriba uno diferente');
        $this->form_validation->set_rules('clave', 'Password', 'trim|required|matches[rclave]');
        $this->form_validation->set_rules('rclave', 'Repetir Password', 'trim|required');
        $this->form_validation->set_rules('login', 'Login', 'trim|required|min_length[4]|max_length[50]|callback_hay_login2');//OJO
        $this->form_validation->set_message('hay_login2', 'El login ya se registro, escriba uno diferente');

        if ($this->form_validation->run() == FALSE) {   //validacion falla

            $data = array(
                'usuario_login' => $this->session_data['usuario_login'],
                'usuario_id' => $this->session_data['usuario_id'],
                'usuario_nombre' => $this->session_data['usuario_nombre'],
                'rol' => $this->getRol($this->session_data['tipousuario_id']),
                'tipousuario_id' => $this->session_data['tipousuario_id'],
                'usuario_imagen' => $this->session_data['usuario_imagen'],
                'usuario_email' => $this->session_data['usuario_email'],
                'page_title' => 'Admin >> Mi Cuenta',
                'thumb'=> $this->session_data['thumb']
            );

            $data['user'] = $this->user_model->get_usuario($this->session_data['usuario_id']);
            $data['usuario_imagen'] = $this->session_data['usuario_imagen'];
            $data['empresa'] = $this->Empresa_model->get_all_empresa();
            
            $data['_view'] = 'admin/form_cuenta';
            $this->load->view('layouts/main',$data);

        }
        else {
//ini
            $idu = $this->session_data['usuario_id'];
            $foto = $this->input->post('foto');

            if (!empty($_FILES['chivo']['name'])){
                $this->load->library('image_lib');
                $config['upload_path'] = './resources/images/usuarios';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 450;
                $config['max_width'] = 1024;
                $config['max_height'] = 768;

                $new_name = time();
                $config['file_name'] = $new_name;
                $config['file_ext_tolower'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->do_upload('chivo');

                $img_data = $this->upload->data();
                $extension = $img_data['file_ext'];

                $confi['image_library'] = 'gd2';
                $confi['source_image'] = './resources/images/usuarios/' . $new_name . $extension;
                $confi['create_thumb'] = TRUE;
                $confi['maintain_ratio'] = TRUE;
                $confi['width'] = 40;
                $confi['height'] = 40;

                $this->image_lib->clear();
                $this->image_lib->initialize($confi);
                $this->image_lib->resize();

                $foto = $new_name . $extension;
            }


            $data = array(
                'usuario_nombre' => $this->input->post('nombre'),
                'usuario_clave' => md5($this->input->post('clave')),
                'usuario_email' => $this->input->post('email'),
                'usuario_imagen' => $foto,
                'usuario_login' => $this->input->post('login')
            );

            if (!$this->user_model->update_usuario($data, $idu)) {
                $usuario = $this->user_model->get_usuario3($idu);
                if ($usuario) {
                    $this->session->unset_userdata('logged_in');

                    $path_parts = pathinfo('./resources/images/usuarios/' . $usuario->usuario_imagen);
                    $thumb =  'thumb_'.$path_parts['filename'] .'.'. $path_parts['extension'];

                    $this->load->model('rol_model');
                    $permisos = $this->rol_model->get_permisos($usuario->tipousuario_id);

                    $descrip = array();
                    foreach ($permisos as $per){
                        array_push($descrip, $per->rol_descripcion);
                    }

                    $sess_array = array(
                        'usuario_login' => $usuario->usuario_login,
                        'usuario_id' => $usuario->usuario_id,
                        'usuario_nombre' => $usuario->usuario_nombre,
                        'estado_id' => $usuario->estado_id,
                        'tipousuario_id' => $usuario->tipousuario_id,
                        'usuario_imagen' => $usuario->usuario_imagen,
                        'usuario_email' => $usuario->usuario_email,
                        'usuario_clave' => $usuario->usuario_clave,
                        'thumb' => $thumb,
                        'rol' => $this->getRol($usuario->tipousuario_id),
                        'permisos' => $descrip,
                        'codigo' => $this->get_codigo_empresa()

                    );

                    $this->session->set_userdata('logged_in', $sess_array);
                    $this->session->set_flashdata('msg',
                        '<div class="alert alert-success text-center fade in" style="margin-top:18px;">
                                <a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>
                                Cuenta Actualizada con <strong>Exito!</strong>
                            </div>');

                    if($this->session_data['tipousuario_id']==2){
                        redirect('venta/ventas');
                    }

                    redirect('admin/dashb');
                }

            } else {
                // error
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Error.  Intente mas tarde!!!</div>');
                redirect('admin/dashb');
            }
        }

    }

    public function getRol($tipousuario_idol)
    {
        $rol = 'ADMIN';
        if ($tipousuario_idol == 1) {
            $rol = 'ADMINISTRADOR';
        }
        if ($tipousuario_idol == 2) {
            $rol = 'CAJERO';
        }
        if ($tipousuario_idol == 3) {
            $rol = 'VENDEDOR';
        }
        if ($tipousuario_idol == 4) {
            $rol = 'PREVENDEDOR';
        }
        return $rol;
    }

    public function haylogin()
    {
        $this->acceso();
        $login = $this->input->post('login');
        $uid = $this->input->post('uid');

        $res = $this->user_model->hay_login($login, $uid);
        echo $res;
    }

    public function haylogin2()
    {
        $login = $this->input->post('login');
        $uid = $this->input->post('uid');
        $res = $this->user_model->hay_login($login,$uid);

        echo $res;
    }

    public function hay_email2($email_field)
    {
        $idu = $this->input->post('userid');
        if ($this->user_model->email_repeat2($email_field, $idu)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function hay_login2($login_field)
    {
        $idu = $this->input->post('userid');
        if ($this->user_model->login_repeat2($login_field, $idu)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function haylogin1()
    {
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');

            if ($session_data['tipousuario_id'] == 1) {

                $login = $this->input->post('login');

                $res = $this->user_model->hay_login1($login);
                echo $res;

            } else {
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    private function acceso(){
        if ($this->session->userdata('logged_in')) {

            if( $this->session_data['tipousuario_id']==1 or $this->session_data['tipousuario_id']==2) {

                if($this->get_codigo_empresa()==$this->session_data['codigo']){
                    return;
                } else {
                    redirect('alerta');
                }

            } else {
                redirect('alerta');
            }
        } else {
            redirect('inicio', 'refresh');
        }
    }

    private function get_codigo_empresa()
    {
        $this->load->model('empresa_model');
        $result = $this->empresa_model->get_empresa(1);
        return  $result[0]['empresa_codigo'];
    }

}