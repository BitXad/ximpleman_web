<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation'));
        $this->load->database();
        $this->load->model('pedidos_model');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            if($session_data['tipousuario_id']==1) {
            //if (in_array("REALIZAR VENTAS", $session_data['permisos'])) {

                $data['page_title'] = 'Admin >> Plan de Pedidos';
                $data['pedidos'] = $this->pedidos_model->get_pedidos();
                $data['proveedores'] = $this->pedidos_model->get_proveedores();
                $data['usuario_imagen'] = $session_data['usuario_imagen'];

/*                $data['main'] = $this->load->view('admin/pedidos/pedidos',$data, true);
                $this->load->view('template/main',$data);*/

                $data['_view'] = 'admin/pedidos/pedidos';
                $this->load->view('layouts/main',$data);
            }
            else{
                $this->session->set_flashdata('msg',
                    '<div class="alert alert-success text-center fade in" style="margin-top:18px;">
                                        <a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>
                                        Usted <strong>NO</strong> esta autorizado para ver esta pagina 
                                    </div>');
                redirect('admin/dashb');
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
        if ($tipousuario_idol == 5) {
            $rol = 'TECNICO';
        }
        return $rol;
    }

    public function create()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if ($session_data['tipousuario_id'] == 1) {
                $this->load->model('usuario_model');
                $this->form_validation->set_rules('proveedores', 'Proveedores', 'required');
                $this->form_validation->set_rules('monto', 'Monto Total', 'trim|required');//OJO
                $this->form_validation->set_rules('fecha', 'Fecha', 'required');//OJO

                if ($this->form_validation->run() == FALSE) {   //validacion falla

                    $data = array(
                        'usuario_login' => $session_data['usuario_login'],
                        'usuario_id' => $session_data['usuario_id'],
                        'usuario_nombre' => $session_data['usuario_nombre'],
                        'rol' => $this->getRol($session_data['tipousuario_id']),
                        'tipousuario_id' => $session_data['tipousuario_id'],
                        'usuario_imagen' => $session_data['usuario_imagen'],
                        'usuario_email' => $session_data['usuario_email'],
                        'page_title' => 'Admin >> Plan de Pedidos',
                        'thumb'=> $session_data['thumb']
                    );
                    $data['pedidos'] = $this->pedidos_model->get_pedidos();
                    $data['proveedores'] = $this->pedidos_model->get_proveedores();


                    $data['usuario_imagen'] = $session_data['usuario_imagen'];

/*                    $data['main'] = $this->load->view('admin/pedidos/pedidos',$data1, true);
                    $this->load->view('template/main',$data);*/

                    $data['_view'] = 'admin/pedidos/pedidos';
                    $this->load->view('layouts/main',$data);


                }
                else {
//ini
                    $idu = $session_data['usuario_id'];

                    $data = array(
                        'proveedor_id' => $this->input->post('proveedores'),
                        'pedidos_montototal' => $this->input->post('monto'),
                        'pedidos_fecha' => $this->input->post('fecha'),
                        'pedidos_resumen' => $this->input->post('resumen'),
                        'pedidos_estado' => 'activo',
                        'pedidos_fecharegistro' => Date('Y-m-d H:i:s')
                    );

                    if ($this->pedidos_model->insert_pedido($data, $idu)>0) {

                            $this->session->set_flashdata('msg',
                                '<div class="alert alert-success text-center fade in" style="margin-top:18px;">
                                        <a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>
                                        Plan de Pedido creado con <strong>Exito!</strong>
                                    </div>');
                            redirect('admin/pedidos');

                    } else {
                        // error
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Error.  Intente mas tarde!!!</div>');
                        redirect('admin/pedidos');
                    }
                }
            } else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function info($year)
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
                    'page_title' => 'Admin >> Plan de Pedidos',
                    'thumb'=> $session_data['thumb']
                );

                $data['pedidos'] = $this->pedidos_model->get_pedidos_year($year);


                $data['usuario_imagen'] = $session_data['usuario_imagen'];
                $data['year'] = $year;

/*                $data['main'] = $this->load->view('admin/pedidos/pedidos_year',$data1, true);
                $this->load->view('template/main',$data);*/

                $data['_view'] = 'admin/pedidos/pedidos_year';
                $this->load->view('layouts/main',$data);

            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function fecha()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {
                $var = $this->input->post('fech');
                $trs = $this->pedidos_model->get_pedidos_fecha($var);
                //$trs = $this->load->view('admin/pedidos/pedidos_trs',$data1,true);
                echo json_encode($trs) ;
            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function todos()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {

                $trs = $this->pedidos_model->get_pedidos();

                echo json_encode($trs) ;
            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function editar($pedidosid)
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
                    'page_title' => 'Admin >> Pedidos - Editar',
                    'thumb'=> $session_data['thumb']
                );

                $data['pedido'] = $this->pedidos_model->get_pedido($pedidosid);
                $data['proveedores'] = $this->pedidos_model->get_proveedores();
                $data['usuario_imagen'] = $session_data['usuario_imagen'];


/*                $data['main'] = $this->load->view('admin/pedidos/form_edit_pedido',$data1, true);
                $this->load->view('template/main',$data);*/

                $data['_view'] = 'admin/pedidos/form_edit_pedido';
                $this->load->view('layouts/main',$data);


            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('inicio', 'refresh');
        }
    }

    public function set()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {

                $this->form_validation->set_rules('monto', 'Monto Total', 'trim|required');
                $this->form_validation->set_rules('fecha', 'Fecha', 'required|callback_fechavalida');
                $this->form_validation->set_message('fechavalida', 'No es posible editar pedidos de hoy y mañana');
                $pedidosid = $this->input->post('pddsid');

                if ($this->form_validation->run() == FALSE) {   //validacion falla

                    //$pedidosid = $this->input->post('pddsid');

                    $data = array(
                        'usuario_login' => $session_data['usuario_login'],
                        'usuario_id' => $session_data['usuario_id'],
                        'usuario_nombre' => $session_data['usuario_nombre'],
                        'rol' => $this->getRol($session_data['tipousuario_id']),
                        'tipousuario_id' => $session_data['tipousuario_id'],
                        'usuario_imagen' => $session_data['usuario_imagen'],
                        'usuario_email' => $session_data['usuario_email'],
                        'page_title' => 'Admin >> Pedidos - Editar',
                        'thumb'=> $session_data['thumb']
                    );

                    $data['pedido'] = $this->pedidos_model->get_pedido($pedidosid);
                    $data['proveedores'] = $this->pedidos_model->get_proveedores();

                    $data['usuario_imagen'] = $session_data['usuario_imagen'];

/*                    $data['main'] = $this->load->view('admin/pedidos/form_edit_pedido',$data1, true);
                    $this->load->view('template/main',$data);*/

                    $data['_view'] = 'admin/pedidos/form_edit_pedido';
                    $this->load->view('layouts/main',$data);

                } else {

                    $data = array(
                        'proveedor_id' => $this->input->post('proveedores'),
                        'pedidos_montototal' => $this->input->post('monto'),
                        'pedidos_fecha' => $this->input->post('fecha'),
                        'pedidos_resumen' => $this->input->post('resumen')
                    );


                    $this->pedidos_model->update_pedido($data, $pedidosid );

                        $this->session->set_flashdata('msg',
                            '<div class="alert alert-success text-center fade in" style="margin-top:18px;">
                                    <a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>
                                    Pedido Actualizado con <strong>Exito!</strong>
                              </div>');
                    redirect('admin/pedidos');

                }

            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function fechavalida($fecha_field)
    {

        if($fecha_field!=''){
            $hoy = new DateTime();
            $cade_hoy =  $hoy->format('Y-m-d');

            $datetime_manana = new DateTime($cade_hoy);
            $datetime_manana->modify('+1 day');
            $tomorrow = $datetime_manana->format('Y-m-d');

/*            echo  $cade_hoy.'<br>';
            echo  $tomorrow.'<br>';*/

            if ($cade_hoy==$fecha_field) {
                return false;
            } else {
                if ($tomorrow==$fecha_field) {
                    return false;
                } else {
                    return true;
                }
            }

        } else {
            return false;
        }

    }

    public function borrar($pedidosid)
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {

            $pedido = $this->pedidos_model->get_pedido($pedidosid);

             if( $this->fechavalida($pedido->pedidos_fecha) ){
                 $this->pedidos_model->borrar_pedido($pedidosid );
                 $this->session->set_flashdata('msg',
                     '<div class="alert alert-success text-center fade in" style="margin-top:18px;">
                                <a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>
                                Pedido Borrado con <strong>Exito!</strong>
                          </div>');
                 redirect('admin/pedidos');
             } else {
                 $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Error.  No es posible borrar pedidos de hoy y mañana</div>');
                 redirect('admin/pedidos');
             }

            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function detalle($pddsid)
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {

                $pedido = $this->pedidos_model->get_pedido($pddsid);

                echo json_encode($pedido);

            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

}