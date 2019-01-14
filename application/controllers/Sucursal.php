<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation'));
        $this->load->database();
        $this->load->model('sucursal_model');
        $this->load->library('pagination');
    }

    public function indexXx()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {

                $sucursales = $this->sucursal_model->get_sucursales();
                $data1['sucursales'] = $sucursales;

                $data = array(
                    'usuario_login' => $session_data['usuario_login'],
                    'usuario_id' => $session_data['usuario_id'],
                    'usuario_nombre' => $session_data['usuario_nombre'],
                    'rol' => $this->getRol($session_data['tipousuario_id']),
                    'tipousuario_id' => $session_data['tipousuario_id'],
                    'usuario_imagen' => $session_data['usuario_imagen'],
                    'usuario_email' => $session_data['usuario_email'],
                    'page_title' => 'Admin >> Sucursales',
                    'thumb'=> $session_data['thumb']
                );

                $data1['usuario_imagen'] = $session_data['usuario_imagen'];

                $rows = array();

/*	            print "<pre>";
	            print_r($rows);
	            print "</pre>";*/

                foreach ($sucursales as $sucursal){

                    $info_sucursal = $this->items($sucursal->sucursal_url);
                    //echo $info_sucursal;
                    foreach ($info_sucursal as $row2){
                        $rows2 = array(
                            'codigo' => $row2->producto_codigo,
                            'cuantos' => $row2->existencia,
                            'url' => $sucursal->sucursal_url,
                            'sucursal' => $sucursal->sucursal_nombre,
                            'id' => $row2->producto_id
                        );
                        array_push($rows, $rows2);
                    }
                }

                $items = array();

                foreach ($rows as $fila){

                    if( count($items)>0 ) {
                        //echo 'sucursales:'.$fila['sucursal'].'<br>';

                        $res = $this->find( $fila['codigo'],$items);
                        if( $res!=false ){
                            $mejor = array();
                            //if (array_key_exists('sucursales', $fila)) {
                                $mejor = array(
                                    'sucursales'=> $res['sucursales'].','.$fila['sucursal'].':'.$fila['cuantos']
                                );
//                            $indexCompleted = array_search('sucursales', $fila);
   //                         unset($fila[$indexCompleted]);
                            foreach ($items as $key => $item){
                                if($item['codigo']==$fila['codigo']){
                                    unset($items[$key]);
                                    break;
                                }
                            }

                            $nuevo1 = array(
                                'codigo' => $fila['codigo']
                            );

                            $nuevo1 = $nuevo1 + $mejor;
                            array_push($items, $nuevo1);
                            //array_replace($items,$aux);

                        } else {
                            $nuevo = array(
                                'codigo' => $fila['codigo'],
                                'sucursales' => $fila['sucursal'].':'.$fila['cuantos'],
                                'id' => $fila['id']
                            );
                            array_push($items, $nuevo);
                        }

                    } else {
                        $nuevo = array(
                            'codigo' => $fila['codigo'],
                            'sucursales'=> $fila['sucursal'].':'.$fila['cuantos'],
                            'id' => $fila['id']
                        );
                        array_push($items, $nuevo);
                    }
                }

/*                print "<pre>";
                print_r( $items);
                print "</pre>";*/


                $data1['sucs'] = $items;
                $data['main'] = $this->load->view('sucursales/lista',$data1, true);
                $this->load->view('template/main',$data);


            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }

    }

    public function find($codigo, $items)
    {
        foreach ($items as $item){
            if($codigo==$item['codigo'] ){
                return $item;
            }
        }
        return false;
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

    public function create()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if ($session_data['tipousuario_id'] == 1) {

                $this->form_validation->set_rules('url', 'Url', 'trim|required');
                $this->form_validation->set_rules('token', 'Token', 'trim|required');
                $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');


                if ($this->form_validation->run() == FALSE) {   //validacion falla

                    $data1['sucursales'] = $this->sucursal_model->get_sucursales();

                    $data = array(
                        'usuario_login' => $session_data['usuario_login'],
                        'usuario_id' => $session_data['usuario_id'],
                        'usuario_nombre' => $session_data['usuario_nombre'],
                        'rol' => $this->getRol($session_data['tipousuario_id']),
                        'tipousuario_id' => $session_data['tipousuario_id'],
                        'usuario_imagen' => $session_data['usuario_imagen'],
                        'usuario_email' => $session_data['usuario_email'],
                        'page_title' => 'Admin >> Sucursales',
                        'thumb'=> $session_data['thumb']
                    );

                    $data1['usuario_imagen'] = $session_data['usuario_imagen'];

                    $data['main'] = $this->load->view('sucursales/lista',$data1, true);

                    $this->load->view('template/main',$data);

                }
                else {
//ini

                    $data = array(
                        'sucursal_url' => $this->input->post('url'),
                        'sucursal_token' => $this->input->post('token'),
                        'sucursal_nombre' => $this->input->post('nombre')
                    );

                    $this->sucursal_model->insert_sucursal($data);

                    $this->session->set_flashdata('msg',
                        '<div class="alert alert-success text-center fade in" style="margin-top:18px;">
                                <a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>
                                Sucursal registrada con <strong>Exito!</strong>
                            </div>');
                    redirect('sucursal');

                }
            } else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function editar($idsuc)
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if ($session_data['tipousuario_id'] == 1) {

                $data1['sucursal'] = $this->sucursal_model->get_sucursal($idsuc);

                $data = array(
                    'usuario_login' => $session_data['usuario_login'],
                    'usuario_id' => $session_data['usuario_id'],
                    'usuario_nombre' => $session_data['usuario_nombre'],
                    'rol' => $this->getRol($session_data['tipousuario_id']),
                    'tipousuario_id' => $session_data['tipousuario_id'],
                    'usuario_imagen' => $session_data['usuario_imagen'],
                    'usuario_email' => $session_data['usuario_email'],
                    'page_title' => 'Admin >> Editar Sucursal',
                    'thumb'=> $session_data['thumb']
                );

                $data1['usuario_imagen'] = $session_data['usuario_imagen'];

                $data['main'] = $this->load->view('sucursales/form_edit_sucursal',$data1, true);

                $this->load->view('template/main',$data);


            } else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function set()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if ($session_data['tipousuario_id'] == 1) {

                $this->input->post('login');
                $this->form_validation->set_rules('url', 'Url', 'trim|required');
                $this->form_validation->set_rules('token', 'token', 'trim|required');
                $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

                if ($this->form_validation->run() == FALSE) {   //validacion falla

                    $data1['sucursal'] = $this->sucursal_model->get_sucursal($this->input->post('idsuc'));

                    $data = array(
                        'usuario_login' => $session_data['usuario_login'],
                        'usuario_id' => $session_data['usuario_id'],
                        'usuario_nombre' => $session_data['usuario_nombre'],
                        'rol' => $this->getRol($session_data['tipousuario_id']),
                        'tipousuario_id' => $session_data['tipousuario_id'],
                        'usuario_imagen' => $session_data['usuario_imagen'],
                        'usuario_email' => $session_data['usuario_email'],
                        'page_title' => 'Admin >> Editar Sucursal',
                        'thumb'=> $session_data['thumb']
                    );

                    $data1['usuario_imagen'] = $session_data['usuario_imagen'];

                    $data['main'] = $this->load->view('sucursales/form_edit_sucursal',$data1, true);

                    $this->load->view('template/main',$data);

                }
                else {

                    $data = array(
                        'sucursal_url' => $this->input->post('url'),
                        'sucursal_token' => $this->input->post('token'),
                        'sucursal_nombre' => $this->input->post('nombre')
                    );

                    $this->sucursal_model->update_sucursal($data,$this->input->post('idsuc'));

                    $this->session->set_flashdata('msg',
                        '<div class="alert alert-success text-center fade in" style="margin-top:18px;">
                                <a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>
                                Sucursal actualizada con <strong>Exito!</strong>
                            </div>');
                    redirect('sucursal');

                }
            } else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    public function infox()
    {
        /*        if ($this->session->userdata('logged_in')) {
                    $session_data = $this->session->userdata('logged_in');
                    if($session_data['tipousuario_id']==1) {
                    $this->load->model('Pedido_model');
                        ;*/


        /*               $data = array(
                           'usuario_login' => $session_data['usuario_login'],
                           'usuario_id' => $session_data['usuario_id'],
                           'usuario_nombre' => $session_data['usuario_nombre'],
                           'rol' => $this->getRol($session_data['tipousuario_id']),
                           'tipousuario_id' => $session_data['tipousuario_id'],
                           'usuario_imagen' => $session_data['usuario_imagen'],
                           'usuario_email' => $session_data['usuario_email'],
                           'page_title' => 'Admin >> Sucursales',
                           'thumb'=> $session_data['thumb']
                       );*/
        $this->load->model('inventario_model');

        $res = $this->inventario_model->get_inventario(); //lista de inventario de existentes

        //$data1['usuario_imagen'] = $session_data['usuario_imagen'];
        //$data['main'] = $this->load->view('sucursales/info', $data1, true);
        //$this->load->view('template/main',$data);

        /*                print "<pre>";
                        print_r($res);
                        print "</pre>";*/
        //echo json_encode($res);
        return $res;

        /*            }
                    else{
                        redirect('alerta');
                    }
                } else {
                    redirect('', 'refresh');
                }*/
    }

    public function info($limit, $start, $codi)
    {
            $res = $this->sucursal_model->get_inventario($limit,$start,$codi); //lista de inventario de existentes
/*            echo 'limit:'.$limit.'<br>';
            echo 'start:'.$start.'<br>';*/

            /*                print "<pre>";
                            print_r($res);
                            print "</pre>";*/
            echo json_encode($res);
        //}
    }

    public function items($codi,$id, $limit,$start){

        $sucursal = $this->sucursal_model->get_sucursal($id);
        // set HTTP header
        $headers = array('Content-Type: application/json',);

// the url of the API you are contacting to 'consume'
        $url = $sucursal->sucursal_url.'/sucursal/info/'.$limit.'/'.$start.'/'.$codi;

// Open connection
        $ch = curl_init();

// Set the url, number of GET vars, GET data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute request
        $result = curl_exec($ch);

// Close connection
        curl_close($ch);

// get the result and parse to JSON
/*        if(isset($result)){ return $result ; }
        else { return FALSE ; }*/
        //echo $result;
        return $result;

/*        print "<pre>";
        print_r($result);
        print "</pre>";*/

    }//

    public function convertir($pros,$url)
    {

        $cont =1;
        foreach ($pros as $row){
            $rows1 = array(
                'nro' => $cont++,
                'codigo' => $row->producto_codigo,
                'cuantos' => $row->existencia,
                'sucursal' => $url
            );
            array_push($rows1, $rows1);
        }

        return $rows1;
    }

    public function buscar_agregar_sucursal($codigo,$sucursal,$cuantos,$items)
    {

        print "<pre>";
        print_r( $items);
        print "</pre>";
/*        foreach ($items as $item){
            if($codigo==$item['codigo']){

                $si = array(
                    $sucursal => $cuantos
                );
                array_push($item,$si);
                return $item;
            }
        }*/
    }

    public function fetch()
    {
        /*        if ($this->session->userdata('logged_in')) {
                    $session_data = $this->session->userdata('logged_in');
                    if($session_data['tipousuario_id']==1) {
                    $this->load->model('Pedido_model');
                        ;*/

        //$data1['usuario_imagen'] = $session_data['usuario_imagen'];

        $rows = array();

        /*	            print "<pre>";
                        print_r($rows);
                        print "</pre>";*/
        $sucursales = $this->sucursal_model->get_sucursales();
        foreach ($sucursales as $sucursal){

            $info_sucursal = $this->items(
                $sucursal->sucursal_url,
                $this->input->post('limit'),
                $this->input->post('start')
            );

            foreach ($info_sucursal as $row2){
                $rows2 = array(
                    'codigo' => $row2->producto_codigo,
                    'cuantos' => $row2->existencia,
                    'url' => $sucursal->sucursal_url,
                    'sucursal' => $sucursal->sucursal_nombre,
                    'id' => $row2->producto_id
                );
                array_push($rows, $rows2);
            }
        }

/*        print "<pre>";
        print_r($rows);
        print "</pre>";*/

        $items = array();

        foreach ($rows as $fila){

            if( count($items)>0 ) {
                //echo 'sucursales:'.$fila['sucursal'].'<br>';

                $res = $this->find( $fila['codigo'],$items);
                if( $res!=false ){
                    $mejor = array();
                    //if (array_key_exists('sucursales', $fila)) {
                    $mejor = array(
                        'sucursales'=> $res['sucursales'].','.$fila['sucursal'].':'.$fila['cuantos']
                    );
//                            $indexCompleted = array_search('sucursales', $fila);
                    //                         unset($fila[$indexCompleted]);
                    foreach ($items as $key => $item){
                        if($item['codigo']==$fila['codigo']){
                            unset($items[$key]);
                            break;
                        }
                    }

                    $nuevo1 = array(
                        'codigo' => $fila['codigo'],
                        'id' => $fila['id']
                    );

                    $nuevo1 = $nuevo1 + $mejor;
                    array_push($items, $nuevo1);
                    //array_replace($items,$aux);

                } else {
                    $nuevo = array(
                        'codigo' => $fila['codigo'],
                        'sucursales' => $fila['sucursal'].':'.$fila['cuantos'],
                        'id' => $fila['id']
                    );
                    array_push($items, $nuevo);
                }

            } else {
                $nuevo = array(
                    'codigo' => $fila['codigo'],
                    'sucursales'=> $fila['sucursal'].':'.$fila['cuantos'],
                    'id' => $fila['id']
                );
                array_push($items, $nuevo);
            }
        }

        $output = '';

/*      print "<pre>";
        print_r($items);
        print "</pre>";*/
        //$cont = $this->input->post('conta');

        if( count($items)>0 )
        {
            foreach($items as $rowx) {
                $lista =  explode(',', $rowx['sucursales']);
                $tdsss = '';
                foreach ($lista as $col) {
                    $tds = explode(':', $col);
                    $tdsss.= '<td data-title="Cantidad">'.$tds[1].'</td>';
                }

                $output .= '
                    <tr class="warning">
                        <td data-title="Nro">'.($this->input->post('conta')+1).'</td>
                        <td data-title="Codigo">'.$rowx["id"].'</td>
                        <td data-title="Codigo">'.$rowx["codigo"].'</td>'.
                        $tdsss.'
                    </tr>                    
                    ';

            }
        }
        echo $output;


        //echo json_encode($res);

        /*            }
                    else{
                        redirect('alerta');
                    }
                } else {
                    redirect('', 'refresh');
                }*/
    }

    public function load(){
        //$rowno = $this->input->post('pagno');
        //$codi  = '';

        $codi =  $this->uri->segment(3);
        $rowno =  $this->uri->segment(4);

//        echo 'codi:'.$codi;
//        echo ',rowno:'.$rowno;

        if($codi==''){
            $codi = '_null_';
        }

        $rowperpage = 10;

        if($rowno != 0){
            $rowno = ($rowno-1) * $rowperpage;
        }

        $allcount = $this->sucursal_model->get_total_inventario($codi);

        $rows = array();

        $sucursales = $this->sucursal_model->get_sucursales();
        foreach ($sucursales as $sucursal){

            $info_sucursal =
                $this->items($codi,$sucursal->sucursal_id, $rowperpage, $rowno);
            //var_dump($info_sucursal);
            $info_sucursal = json_decode($info_sucursal);

            foreach ($info_sucursal as $row2){
                $rows2 = array(
                    'codigo' => $row2->producto_codigo,
                    'cuantos' => $row2->existencia,
                    'url' => $sucursal->sucursal_url,
                    'sucursal' => $sucursal->sucursal_nombre,
                    'id' => $row2->producto_id
                );
                array_push($rows, $rows2);
            }
        }


        $items = array();

        foreach ($rows as $fila){

            if( count($items)>0 ) {
                //echo 'sucursales:'.$fila['sucursal'].'<br>';

                $res = $this->find( $fila['codigo'],$items);
                if( $res!=false ){
                    $mejor = array();
                    //if (array_key_exists('sucursales', $fila)) {
                    $mejor = array(
                        'sucursales'=> $res['sucursales'].','.$fila['sucursal'].':'.$fila['cuantos']
                    );
//                            $indexCompleted = array_search('sucursales', $fila);
                    //                         unset($fila[$indexCompleted]);
                    foreach ($items as $key => $item){
                        if($item['codigo']==$fila['codigo']){
                            unset($items[$key]);
                            break;
                        }
                    }

                    $nuevo1 = array(
                        'codigo' => $fila['codigo'],
                        'id' => $fila['id'],
                        'numero' => $rowno
                    );

                    $nuevo1 = $nuevo1 + $mejor;
                    array_push($items, $nuevo1);
                    //array_replace($items,$aux);

                } else {
                    $nuevo = array(
                        'codigo' => $fila['codigo'],
                        'sucursales' => $fila['sucursal'].':'.$fila['cuantos'],
                        'id' => $fila['id'],
                        'numero' => $rowno
                    );
                    array_push($items, $nuevo);
                }

            } else {
                $nuevo = array(
                    'codigo' => $fila['codigo'],
                    'sucursales'=> $fila['sucursal'].':'.$fila['cuantos'],
                    'id' => $fila['id'],
                    'numero' => $rowno
                );
                array_push($items, $nuevo);
            }
        }

        //print "<pre>";
        //print_r($rows);
        //print "</pre>";


        $config['base_url'] = base_url().'sucursal/load/'.$codi.'/'.$rowno;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';


        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['result'] = $items;
        $data['row'] = $rowno;


        echo json_encode($data);
    }


    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {

                $sucursales = $this->sucursal_model->get_sucursales();
                $data['sucursales'] = $sucursales;

                $data['page_title'] = 'Admin >> Mi Cuenta';

                $data['_view'] = 'sucursales/lista';
                $this->load->view('layouts/main',$data);

            }
        }

    }

    public function infoxxxxx()
    {
        /*        if ($this->session->userdata('logged_in')) {
                    $session_data = $this->session->userdata('logged_in');
                    if($session_data['tipousuario_id']==1) {
                    $this->load->model('Pedido_model');
                        ;*/


        /*               $data = array(
                           'usuario_login' => $session_data['usuario_login'],
                           'usuario_id' => $session_data['usuario_id'],
                           'usuario_nombre' => $session_data['usuario_nombre'],
                           'rol' => $this->getRol($session_data['tipousuario_id']),
                           'tipousuario_id' => $session_data['tipousuario_id'],
                           'usuario_imagen' => $session_data['usuario_imagen'],
                           'usuario_email' => $session_data['usuario_email'],
                           'page_title' => 'Admin >> Sucursales',
                           'thumb'=> $session_data['thumb']
                       );*/
        //$this->load->model('inventario_model');

        $res = $this->sucursal_model->get_inventario(100,15); //lista de inventario de existentes

        //$data1['usuario_imagen'] = $session_data['usuario_imagen'];
        //$data['main'] = $this->load->view('sucursales/info', $data1, true);
        //$this->load->view('template/main',$data);

        /*                print "<pre>";
                        print_r($res);
                        print "</pre>";*/
        echo json_encode($res);
        //return $res;

        /*            }
                    else{
                        redirect('alerta');
                    }
                } else {
                    redirect('', 'refresh');
                }*/
    }

}