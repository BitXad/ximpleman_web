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
        $this->load->model('rol_model');
        $this->load->model('Dosificacion_model');
    }

    function index()
    {
        $username = $this->input->post('username');
        $clave = $this->input->post('password');

        $result = $this->login_model->login2($username,$clave );
/*        print "<pre>";
        print_r( $result);
        print "</pre>";*/
        //var_dump($result);

        if ($result) {
            if ($result->tipousuario_id >= 1 && $result->tipousuario_id <= 10) {
                $this->load->model('Rol_usuario_model');
                $this->load->model('Tipo_usuario_model');
                $thumb = "thumb_default.jpg";
                $usuario_imagen = "default.jpg";
                if ($result->usuario_imagen <> null && $result->usuario_imagen <> "") {
                    $thumb = "thumb_".$result->usuario_imagen;
                    $usuario_imagen = $result->usuario_imagen;
                    //$thumb = $this->foto_thumb($result->usuario_imagen);
                }
                $rolusuario = $this->Rol_usuario_model->getall_rolusuario($result->tipousuario_id);
                $tipousuario_nombre = $this->Tipo_usuario_model->get_tipousuario_nombre($result->tipousuario_id);
                $this->load->model('Parametro_model');
                $parametro = $this->Parametro_model->get_parametros();
                $sess_array = array(
                    'usuario_login' => $result->usuario_login,
                    'usuario_id' => $result->usuario_id,
                    'usuario_nombre' => $result->usuario_nombre,
                    'estado_id' => $result->estado_id,
                    'tipousuario_id' => $result->tipousuario_id,
                    'tipousuario_descripcion' => $tipousuario_nombre,
                    'usuario_imagen' => $usuario_imagen,
                    'usuario_email' => $result->usuario_email,
                    'usuario_clave' => $result->usuario_clave,
                    'thumb' => $thumb,
                    'rol' => $rolusuario,
                    'puntoventa_codigo' => $result->puntoventa_codigo,
                    'codigo' => $this->get_codigo_empresa(),
                    'pedido_titulo' => $parametro[0]["parametro_pedidotitulo"]
                );
                
                $this->session->set_userdata('logged_in', $sess_array);
                $session_data = $this->session->userdata('logged_in');
                $dosif="SELECT DATEDIFF(dosificacion_fechalimite, CURDATE()) as dias FROM dosificacion WHERE dosificacion_id = 1";
                $dosificacion = $this->db->query($dosif)->row_array();
                //print "<pre>"; print_r( $session_data); print "</pre>";
                if($parametro[0]["parametro_tiposistema"] == 1){
                    if ($session_data['tipousuario_id'] == 1) {// admin page
                        if ($dosificacion['dias']<=10 && $dosificacion['dias']!=null) {
                            redirect('alerta/dosificacion'); 
                        }
                        if($parametro[0]["parametro_redireccionusuario"] != "" && $parametro[0]["parametro_redireccionusuario"] != null) {
                            redirect($parametro[0]["parametro_redireccionusuario"]);
                        }else{
                            redirect('admin/dashb');
                        }
                        
                    }elseif($session_data['tipousuario_id'] == 7){ // usuario tipo Cocina
                        if($parametro[0]["parametro_redireccionusuario"] != "" && $parametro[0]["parametro_redireccionusuario"] != null) {
                            redirect($parametro[0]["parametro_redireccionusuario"]);
                        }else{
                            redirect('detalle_venta/recepcion');
                        }
                        //redirect('reportes/ventacategoriap');
                    }else{  // En caso de otro usuario no administrador 
                        if ($dosificacion['dias']<=10 && $dosificacion['dias']!=null) { 
                            redirect('alerta/dosificacion'); 
                        } 
                       // $this->load->model('Cliente_model'); 
                        //$cliente_id = $this->Cliente_model->get_cliente_from_ci($session_data['usuario_login']); 
                        if($parametro[0]["parametro_redireccionusuario"] != "" && $parametro[0]["parametro_redireccionusuario"] != null) {
                            redirect($parametro[0]["parametro_redireccionusuario"]);
                        }else{
                            redirect('admin/dashb/index_user');
                        }
                    }
                }else{
                    $tok="SELECT DATEDIFF(token_fechahasta, CURDATE()) as dias FROM token WHERE estado_id = 1 order by token_id desc limit 1";
                    $token = $this->db->query($tok)->row_array();
                    if ($session_data['tipousuario_id'] == 1) {// admin page
                        if ($token['dias']<=10 && $token['dias']!=null) {
                            redirect('alerta/token'); 
                        }
                        if($parametro[0]["parametro_redireccionusuario"] != "" && $parametro[0]["parametro_redireccionusuario"] != null) {
                            redirect($parametro[0]["parametro_redireccionusuario"]);
                        }else{
                            redirect('admin/dashb');
                        }
                    }elseif($session_data['tipousuario_id'] == 7){ // usuario tipo Cocina
                        if($parametro[0]["parametro_redireccionusuario"] != "" && $parametro[0]["parametro_redireccionusuario"] != null) {
                            redirect($parametro[0]["parametro_redireccionusuario"]);
                        }else{
                            redirect('detalle_venta/recepcion');
                        }
                        
                    }else{  // En caso de otro usuario no administrador 
                        if ($token['dias']<=10 && $token['dias']!=null) { 
                            redirect('alerta/token'); 
                        }
                        
                        if($parametro[0]["parametro_redireccionusuario"] != "" && $parametro[0]["parametro_redireccionusuario"] != null) {
                            redirect($parametro[0]["parametro_redireccionusuario"]);
                        }else{
                            redirect('admin/dashb/index_user'); 
                        }
                        
                    }
                    
                }
                // if($session_data['tipousuario_id'] == 5) { 
                //     if ($dosificacion['dias']<=10 && $dosificacion['dias']!=null) { 
                //        redirect('alerta/dosificacion'); 
                //     } 
                //    // $this->load->model('Cliente_model'); 
                //     //$cliente_id = $this->Cliente_model->get_cliente_from_ci($session_data['usuario_login']); 
                //     redirect('servicio'); 
                // } 
 
                // if($session_data['tipousuario_id'] >= 2 and $session_data['tipousuario_id'] <= 3){ 
                //     if ($dosificacion['dias']<=10 && $dosificacion['dias']!=null) { 
                //        redirect('alerta/dosificacion'); 
                //     } 
                //     redirect('venta/ventas'); 
                // } 
 
                // if($session_data['tipousuario_id'] == 4){ 
                //     if ($dosificacion['dias']<=10 && $dosificacion['dias']!=null) { 
                //        redirect('alerta/dosificacion'); 
                //     } 
                //     redirect('pedido'); 
                // } 
 
                //  if($session_data['tipousuario_id'] == 6){ 
                //     if ($dosificacion['dias']<=10 && $dosificacion['dias']!=null) { 
                //        redirect('alerta/dosificacion'); 
                //     } 
                //     redirect('factura'); 
                // } 
 
                //  if($session_data['tipousuario_id'] == 7){ 
                //     redirect('detalle_venta/recepcion'); 
                // } 
                // if($session_data['tipousuario_id'] == 8){ 
                //     redirect('venta/ventas'); 
                // } 
 
 
            } else { 
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">TIPO DE USUARIO no es valido</div>');
                redirect('login');
            }

        }
        else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">USUARIO o CONTRASEÑA no son validos  </div>');
            redirect('login');
        }

        // }
    }

    /*public function foto_thumb($foto)
    {
        $path_parts = pathinfo('./uploads/profile/' . $foto);
        return 'thumb_'.$path_parts['filename'].'.' . $path_parts['extension'];
    }*/

    public function logout()
    {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);

        $this->session->set_flashdata('msg', 'Successfully Logout');
        redirect('');
    }

   /* public function getTipo_usuario($tipousuario_id)
    {
        $tipo_usuarios = $this->rol_model->get_tipousuarios();

        foreach ($tipo_usuarios as $row){
            if ($tipousuario_id == $row->tipousuario_id) {
                return $row->tipousuario_descripcion;
            }
        }

        if( count($tipo_usuarios)==0 )
        {
            return '----';
        }
    }*/

    public function check_user($username, $clave)
    {
        $result = $this->login_model->login2($username,$clave );

        if($result){
            echo 'success';
        } else { echo '';}
    }

    public function do_login($username, $clave, $token)
    {
        if($token=='mbUdgZWkgqyODuHFVDlsFIZOPkBzuiBI'){
            $result = $this->login_model->login2($username,$clave);
            if($result){
                if ($result->tipousuario_id == 1 or $result->tipousuario_id == 2 or $result->tipousuario_id == 3 or $result->tipousuario_id == 4 or $result->tipousuario_id == 5 or $result->tipousuario_id == 6) {
                    $this->load->model('Rol_usuario_model');
                    $this->load->model('Tipo_usuario_model');
                    $thumb = "default_thumb.jpg";
                    if ($result->usuario_imagen <> null) {
                        $thumb = "thumb_".$result->usuario_imagen;
                        //$thumb = $this->foto_thumb($result->usuario_imagen);
                    }
                    $rolusuario = $this->Rol_usuario_model->getall_rolusuario($result->tipousuario_id);
                    $tipousuario_nombre = $this->Tipo_usuario_model->get_tipousuario_nombre($result->tipousuario_id);
                    $sess_array = array(
                        'usuario_login' => $result->usuario_login,
                        'usuario_id' => $result->usuario_id,
                        'usuario_nombre' => $result->usuario_nombre,
                        'estado_id' => $result->estado_id,
                        'tipousuario_id' => $result->tipousuario_id,
                        'tipousuario_descripcion' => $tipousuario_nombre,
                        'usuario_imagen' => $result->usuario_imagen,
                        'usuario_email' => $result->usuario_email,
                        'usuario_clave' => $result->usuario_clave,
                        'puntoventa_codigo' => $result->puntoventa_codigo,
                        'thumb' => $thumb,
                        'rol' => $rolusuario,
                        'codigo' => $this->get_codigo_empresa()
                    );
                    
                    $this->session->set_userdata('logged_in', $sess_array);
                    $session_data = $this->session->userdata('logged_in');

                    if ($session_data['tipousuario_id'] == 1) { // admin page
                        redirect('admin/dashb');
                    } elseif($session_data['tipousuario_id'] == 5) {
                        $this->load->model('Cliente_model');
                        $cliente_id = $this->cliente_model->get_cliente_from_ci($session_data['usuario_login']);
                        redirect('detalle_serv/kardexserviciocliente/'.$cliente_id);
                    }

                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">USUARIO invalido,' . $result . '</div>');
                    redirect('login');
                }
            }
        }
    }



    private function get_codigo_empresa()
    {
        $this->load->model('empresa_model');
        $result = $this->empresa_model->get_empresa(1);
        return  $result[0]['empresa_codigo'];
    }


    public function activate($cliente_id, $codigo_activacion)
    {
        $this->load->model('Cliente_model');
        $cliente = $this->Cliente_model->verificar_cliente($cliente_id,$codigo_activacion);
        
        if (isset($cliente)){ //si existe el cliente en espera de activacion
            
            $ipe = $cliente_id;//$this->input->post('ipe');
            
            $this->Cliente_model->activar_cliente($cliente_id);
            
            $login = $cliente['cliente_email'];
            $clave = $cliente['cliente_clave'];

            $clienteid = $cliente['cliente_id'];
            $clientenombre = $cliente['cliente_nombre'];
            
            $update="UPDATE carrito
                      SET cliente_id = '".$clienteid."' 
                      WHERE cliente_id = '".$ipe."' ";
            $this->db->query($update);

            setcookie("cliente_id", $clienteid, time() + (3600 * 24), "/");
            setcookie("cliente_nombre", $clientenombre, time() + (3600 * 24), "/");
            
            redirect();//redireccionara a la pagina principal
        
        }
        
            redirect("error");
    }


    function sesioncliente(){
        
        $login = $this->input->post('login');
        $clave = md5($this->input->post('clave'));
        $ipe = $this->input->post('ipe');

//        $resultado = "SELECT * from cliente WHERE cliente_codigo='".$login."' AND cliente_codigo = '".$clave."' ";
        $resultado = "SELECT * from cliente WHERE cliente_email = '".$login."'".
                    " and cliente_clave = '".$clave."' ";
                    " and estado_id = 1";
        $result=$this->db->query($resultado)->row_array();
        
        if ($result){
        $clienteid = $result['cliente_id'];
        $clientenombre = $result['cliente_nombre'];
        $update="UPDATE carrito
                  SET cliente_id = '".$clienteid."' 
                  WHERE cliente_id = '".$ipe."' ";
        $this->db->query($update);

        setcookie("cliente_id", $clienteid, time() + (3600 * 24), "/");
        setcookie("cliente_nombre", $clientenombre, time() + (3600 * 24), "/");
        return true;
        
        }else{
            show_404();
        }
    }    
    
    

}

?>