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
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1){

                $data['page_title'] = 'Admin >> Inicio';
                $data['ventas'] = $this->Venta_model->get_ventas_dia();
                $data['pedidos'] = $this->Pedido_model->get_pedidos_dia();
                $data['compras'] = $this->Compra_model->get_compras_dia();
                $data['clientes'] = $this->Cliente_model->get_clientes();
                $data['resumen_usuario'] = $this->Venta_model->get_resumen_usuarios();
                $data['ventas_semanales'] = $this->Venta_model->get_ventas_semanales();
                $data['usuario_imagen'] = $session_data['usuario_imagen'];
                
                
                $data['_view'] = 'hola';
                $this->load->view('layouts/main',$data);

            }else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('', 'refresh');
    }

    public function cuenta()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {

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

                $data['user'] = $this->user_model->get_usuario($session_data['usuario_id']);
                $data['usuario_imagen'] = $session_data['usuario_imagen'];

                //$data['main'] = $this->load->view('admin/form_cuenta',$data1, true);
                //$this->load->view('template/main',$data);

                $data['_view'] = 'admin/form_cuenta';
                $this->load->view('layouts/main',$data);

            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function setu()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if ($session_data['tipousuario_id'] == 1) {

                $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_length[150]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[250]|callback_hay_email2');//OJO
                $this->form_validation->set_message('hay_email2', 'El email ya se registro, escriba uno diferente');
                $this->form_validation->set_rules('clave', 'Password', 'trim|required|matches[rclave]');
                $this->form_validation->set_rules('rclave', 'Repetir Password', 'trim|required');
                $this->form_validation->set_rules('login', 'Login', 'trim|required|min_length[4]|max_length[50]|callback_hay_login2');//OJO
                $this->form_validation->set_message('hay_login2', 'El login ya se registro, escriba uno diferente');


                if ($this->form_validation->run() == FALSE) {   //validacion falla

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

                    $data['user'] = $this->user_model->get_usuario($session_data['usuario_id']);
                    $data['usuario_imagen'] = $session_data['usuario_imagen'];

                    $data['_view'] = 'admin/form_cuenta';
                    $this->load->view('layouts/main',$data);

                }
                else {
//ini
                    $idu = $session_data['usuario_id'];
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
                            $thumb = $path_parts['filename'] . '_thumb.' . $path_parts['extension'];

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
                                'rol' => $this->getRol($usuario->tipousuario_id)

                            );

                            $this->session->set_userdata('logged_in', $sess_array);
                            $this->session->set_flashdata('msg',
                                '<div class="alert alert-success text-center fade in" style="margin-top:18px;">
                                        <a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>
                                        Cuenta Actualizada con <strong>Exito!</strong>
                                    </div>');
                            redirect('admin/dashb');
                        }

                    } else {
                        // error
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Error.  Intente mas tarde!!!</div>');
                        redirect('admin/dashb');
                    }
                }
            } else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
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
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');

            if ($session_data['tipousuario_id'] == 1) {
                $login = $this->input->post('login');
                $uid = $this->input->post('uid');

                $res = $this->user_model->hay_login($login, $uid);
                echo $res;

            } else {
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
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

}