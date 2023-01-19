<?php
if (!defined('BASEPATH'))
   exit('No direct script access allowed');

//class Error404 extends CI_Controller { 
//   public function index(){
//      echo 'Error 404. Usted está intentando acceder a una página que no existe.'
//   }
//}

class Error404 extends CI_Controller { 
    
    private $sistema;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pagina_web_model');
        $this->load->model('Producto_model');
        $this->load->model('Categoria_producto_model');
        $this->load->helper('cookie');
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    }            

    function index()
    {
        
        $data['sistema'] = $this->sistema;
        $idioma_id = 1; //1 - español
        $producto_id = 1;
        
        $data['idioma_id'] = $idioma_id;
//        $data['producto_id'] = $idioma_id;
        
        $data['pagina_web'] = $this->Pagina_web_model->get_pagina($idioma_id);
        $data['menu_cabecera'] = $this->Pagina_web_model->get_menu_cabecera($idioma_id);
        $data['menu_principal'] = $this->Pagina_web_model->get_menu_principal($idioma_id);
        $data['menu_item'] = $this->Pagina_web_model->get_menu_item($idioma_id);
        $data['slider'] = $this->Pagina_web_model->get_slider(1,$idioma_id); //tipo 1
        $data['seccion1'] = $this->Pagina_web_model->get_seccion(1,$idioma_id); //seccion 1
        $data['seccion2'] = $this->Pagina_web_model->get_seccion(2,$idioma_id); //seccion 2
        $data['seccion3'] = $this->Pagina_web_model->get_seccion(3,$idioma_id); //seccion 3        
        $data['ofertasemanal'] = $this->Pagina_web_model->get_oferta_semanal(); //seccion 3
        $data['ofertasdia'] = $this->Pagina_web_model->get_oferta_dia(); //seccion 3
        $data['slider2'] = $this->Pagina_web_model->get_slider(2,$idioma_id); //tipo 2

//        $data['producto'] = $this->Pagina_web_model->get_producto($producto_id);
        
        $data['_view'] = 'pagina_web/index';
//        $this->load->view('layouts/main',$data);        
        
        $data['_view'] = 'website';
//        $this->load->view('layouts/login',$data);
        $this->load->view('layouts/404',$data);
    }

}