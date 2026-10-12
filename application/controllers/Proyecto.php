<?php
class Proyecto extends CI_Controller {
    var $session_data;
    private $sistema;
    const ROL_PROYECTOS = 224;
    const ROL_LOTES = 225;
    const ROL_RESERVAS = 226;

    public function __construct(){
        parent::__construct();
        $this->load->model(array('Proyecto_model','Proyecto_lote_model','Producto_model','Parametro_model','Sistema_model','Categoria_producto_model','Moneda_model','Cliente_model','Inventario_model'));
        if($this->session->userdata('logged_in')) $this->session_data=$this->session->userdata('logged_in');
        else redirect('','refresh');
        $this->sistema=$this->Sistema_model->get_sistema();
        $this->load->helper(array('url','form'));
    }
    private function acceso($id){
        if(isset($this->session_data['tipousuario_id']) && (int)$this->session_data['tipousuario_id']===1) return true;
        $roles=isset($this->session_data['rol'])?$this->session_data['rol']:array();
        return isset($roles[$id-1]) && (int)$roles[$id-1]['rolusuario_asignado']===1;
    }
    private function exigir($id){ if(!$this->acceso($id)) show_error('No tiene permiso para realizar esta operación.',403,'Acceso denegado'); }
    private function base_data(){ return array('sistema'=>$this->sistema,'parametro'=>$this->Parametro_model->get_parametro(1),'rol'=>$this->session_data['rol'],'tipousuario_id'=>$this->session_data['tipousuario_id']); }
    public function index(){ $this->exigir(self::ROL_PROYECTOS); $d=$this->base_data(); $d['proyectos']=$this->Proyecto_model->get_all(); $d['_view']='proyecto/index'; $this->load->view('layouts/main',$d); }
    public function nuevo(){ $this->exigir(self::ROL_PROYECTOS); $d=$this->base_data(); $d['categorias']=$this->Categoria_producto_model->get_all_categoria_producto(); $d['monedas']=$this->Moneda_model->getalls_monedasact_asc(); $d['_view']='proyecto/nuevo'; $this->load->view('layouts/main',$d); }
    public function guardar(){
        $this->exigir(self::ROL_PROYECTOS);
        $nombre=trim($this->input->post('proyecto_nombre'));
        if($nombre===''){ $this->session->set_flashdata('mensaje_error','El nombre del proyecto es obligatorio.'); redirect('proyecto/nuevo'); return; }
        $id=$this->Proyecto_model->add(array(
            'numero_proyecto'=>trim($this->input->post('numero_proyecto')),
            'nombre_proyecto'=>$nombre,
            'proyecto_descripcion'=>trim($this->input->post('proyecto_descripcion')),
            'categoria_id'=>(int)$this->input->post('categoria_id'),
            'moneda_id'=>(int)$this->input->post('moneda_id'),
            'imagen_ancho'=>(int)$this->input->post('imagen_ancho')?:1200,
            'imagen_alto'=>(int)$this->input->post('imagen_alto')?:800,
            'estado_id'=>1,
            'usuario_id'=>(int)$this->session_data['usuario_id'],
            'fecha_registro'=>date('Y-m-d H:i:s')
        ));
        redirect('proyecto/mapa_admin/'.$id);
    }
    public function mapa_admin($id){
        $this->exigir(self::ROL_LOTES); $p=$this->Proyecto_model->get_by_id((int)$id); if(!$p) show_404();
        $d=$this->base_data(); $d['proyecto']=$p; $d['clientes']=$this->Cliente_model->get_cliente_all(); $d['_view']='proyecto/mapa_admin'; $this->load->view('layouts/main',$d);
    }
    public function subir_plano($id){
        $this->exigir(self::ROL_PROYECTOS); $p=$this->Proyecto_model->get_by_id((int)$id); if(!$p) show_404();
        $dir=FCPATH.'uploads/planos/'; if(!is_dir($dir)) @mkdir($dir,0755,true);
        $cfg=array('upload_path'=>$dir,'allowed_types'=>'jpg|jpeg|png|webp','encrypt_name'=>true,'max_size'=>15360); $this->load->library('upload',$cfg);
        if(!$this->upload->do_upload('proyecto_imagen')){ $this->session->set_flashdata('mensaje_error',$this->upload->display_errors('','')); redirect('proyecto/mapa_admin/'.$id); return; }
        $f=$this->upload->data(); $this->Proyecto_model->update($id,array('proyecto_imagen'=>$f['file_name'],'imagen_ancho'=>$f['image_width'],'imagen_alto'=>$f['image_height'])); redirect('proyecto/mapa_admin/'.$id);
    }
}
