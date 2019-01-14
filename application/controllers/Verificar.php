<?php

class Verificar extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('login_model');
    }

    function index()
    {
        $username = $this->input->post('username');
        $clave = $this->input->post('password');

        $result = $this->login_model->login2($username,$clave );
        //var_dump($result);

        if ($result) {
            if ($result->tipousuario_id == 1 or $result->tipousuario_id == 2 or $result->tipousuario_id == 5) {
                $thumb = "";
                if($result->usuario_imagen <> null){
                    $thumb = $this->foto_thumb($result->usuario_imagen);
                }
                $sess_array = array(
                    'usuario_login' => $result->usuario_login,
                    'usuario_id' => $result->usuario_id,
                    'usuario_nombre' => $result->usuario_nombre,
                    'estado_id' => $result->estado_id,
                    'tipousuario_id' => $result->tipousuario_id,
                    'usuario_imagen' => $result->usuario_imagen,
                    'usuario_email' => $result->usuario_email,
                    'usuario_clave' => $result->usuario_clave,
                    'thumb' => $thumb

                );

                $this->session->set_userdata('logged_in', $sess_array);
                $session_data = $this->session->userdata('logged_in');

                if ($session_data['tipousuario_id'] == 1) {// admin page
                    redirect('admin/dashb');
                }elseif($session_data['tipousuario_id'] == 5) {
                    $this->load->model('Cliente_model');
                    $cliente_id = $this->Cliente_model->get_cliente_from_ci($session_data['usuario_login']);
                    redirect('detalle_serv/kardexserviciocliente/'.$cliente_id);
                }

            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">USUARIO invalido,' . $result . '</div>');
                redirect('login');
            }

        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">USER o PASSWORD invalidos,' . $result . '</div>');
            redirect('login');
        }

        // }
    }

    public function foto_thumb($foto)
    {
        $path_parts = pathinfo('./uploads/profile/' . $foto);
        return $path_parts['filename'] . '_thumb.' . $path_parts['extension'];
    }

    public function logout()
    {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);

        $this->session->set_flashdata('msg', 'Successfully Logout');
        redirect('');
    }

}

?>