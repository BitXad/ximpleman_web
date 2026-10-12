<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto_model extends CI_Model
{
    public function get_all()
    {
        return $this->db
            ->select("p.*, p.cod_proy AS proyecto_id, p.nombre_proyecto AS proyecto_nombre", false)
            ->from('proyecto p')
            ->order_by('p.cod_proy','desc')
            ->get()->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->select("p.*, p.cod_proy AS proyecto_id, p.nombre_proyecto AS proyecto_nombre", false)
            ->from('proyecto p')
            ->where('p.cod_proy',(int)$id)
            ->get()->row_array();
    }

    public function add($data)
    {
        $this->db->insert('proyecto',$data);
        return $this->db->insert_id();
    }

    public function update($id,$data)
    {
        $this->db->where('cod_proy',(int)$id);
        return $this->db->update('proyecto',$data);
    }
}
