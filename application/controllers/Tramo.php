<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tramo extends CI_Controller
{
    private $sistema;
    private $parametros;
    private $session_data;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url','form'));

        // El layout principal de Ximpleman requiere estas variables.
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
        $this->load->model('Empresa_model');

        $this->sistema = $this->Sistema_model->get_sistema();

        $p = $this->Parametro_model->get_parametros();
        $this->parametros = isset($p[0]) ? $p[0] : array();

        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        } else {
            redirect('', 'refresh');
        }
    }

    private function json($x)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($x, JSON_UNESCAPED_UNICODE));
    }

    public function index()
    {
        // IMPORTANTE: layouts/main.php usa $sistema y $parametro.
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
        $data['empresa'] = $this->Empresa_model->get_empresa(1);

        $data['rutas'] = $this->db->query(
            "SELECT r.ruta_id,
                    r.ruta_nombre,
                    COALESCE(o.origen_nombre,r.inicio_ruta) AS origen_nombre,
                    COALESCE(d.destino_nombre,r.fin_ruta) AS destino_nombre
             FROM ruta r
             LEFT JOIN origen o ON o.origen_id=r.origen_id
             LEFT JOIN destino d ON d.destino_id=r.destino_id
             ORDER BY r.ruta_nombre"
        )->result_array();

        $data['paradas'] = $this->db->query(
            "SELECT parada_id,parada_nombre
             FROM parada
             WHERE IFNULL(estado_id,1)=1
             ORDER BY parada_nombre"
        )->result_array();

        $data['_view'] = 'tramo/index';
        $this->load->view('layouts/main', $data);
    }

    public function lista()
    {
        $ruta_id = (int)$this->input->post('ruta_id');

        if (!$this->db->table_exists('ruta_parada')) {
            return $this->json(array(
                'ok'=>false,
                'mensaje'=>'Falta ejecutar el SQL del punto 18.'
            ));
        }

        return $this->json(array(
            'ok'=>true,
            'paradas'=>$this->db->query(
                "SELECT rp.*,p.parada_nombre
                 FROM ruta_parada rp
                 LEFT JOIN parada p ON p.parada_id=rp.parada_id
                 WHERE rp.ruta_id=? AND rp.estado_id=1
                 ORDER BY rp.rutaparada_orden",
                array($ruta_id)
            )->result_array()
        ));
    }

    public function guardar()
    {
        $ruta_id=(int)$this->input->post('ruta_id');
        $parada_id=(int)$this->input->post('parada_id');
        $orden=(int)$this->input->post('orden');

        if($ruta_id<=0 || $parada_id<=0 || $orden<=0 || $orden>=10000){
            return $this->json(array('ok'=>false,'mensaje'=>'Datos inválidos.'));
        }

        if(!$this->db->table_exists('ruta_parada')){
            return $this->json(array(
                'ok'=>false,
                'mensaje'=>'Falta ejecutar database/database_actualizacion_paradas_tramos_punto18.sql.'
            ));
        }

        $p=$this->db->query(
            "SELECT parada_nombre FROM parada WHERE parada_id=? LIMIT 1",
            array($parada_id)
        )->row_array();

        if(!$p){
            return $this->json(array('ok'=>false,'mensaje'=>'Parada inexistente.'));
        }

        $exist=$this->db->query(
            "SELECT rutaparada_id
             FROM ruta_parada
             WHERE ruta_id=? AND parada_id=?
             LIMIT 1",
            array($ruta_id,$parada_id)
        )->row_array();

        $choque=$this->db->query(
            "SELECT rutaparada_id
             FROM ruta_parada
             WHERE ruta_id=? AND rutaparada_orden=? AND estado_id=1
             LIMIT 1",
            array($ruta_id,$orden)
        )->row_array();

        if($choque && (!$exist || (int)$choque['rutaparada_id']!==(int)$exist['rutaparada_id'])){
            return $this->json(array(
                'ok'=>false,
                'mensaje'=>'Ese orden ya está ocupado.'
            ));
        }

        $data=array(
            'ruta_id'=>$ruta_id,
            'parada_id'=>$parada_id,
            'rutaparada_nombre'=>$p['parada_nombre'],
            'rutaparada_orden'=>$orden,
            'rutaparada_tipo'=>'PARADA',
            'estado_id'=>1
        );

        if($exist){
            $this->db
                ->where('rutaparada_id',$exist['rutaparada_id'])
                ->update('ruta_parada',$data);
        }else{
            $this->db->insert('ruta_parada',$data);
        }

        return $this->json(array(
            'ok'=>true,
            'mensaje'=>'Parada guardada.'
        ));
    }

    public function eliminar()
    {
        $id=(int)$this->input->post('rutaparada_id');

        if(!$this->db->table_exists('ruta_parada')){
            return $this->json(array(
                'ok'=>false,
                'mensaje'=>'Falta ejecutar el SQL del punto 18.'
            ));
        }

        $rp=$this->db->query(
            "SELECT * FROM ruta_parada WHERE rutaparada_id=? LIMIT 1",
            array($id)
        )->row_array();

        if(!$rp || $rp['rutaparada_tipo']!=='PARADA'){
            return $this->json(array(
                'ok'=>false,
                'mensaje'=>'Solo se eliminan paradas intermedias.'
            ));
        }

        $this->db
            ->where('rutaparada_id',$id)
            ->update('ruta_parada',array('estado_id'=>0));

        return $this->json(array('ok'=>true));
    }
}
