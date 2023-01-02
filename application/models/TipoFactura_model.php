<?php
class TipoFactura_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function get_all_tipoFactura(){
        return $this->db->query(
            "SELECT * 
            from tipo_factura"
            )->result_array();
    }

    function add_tipoFactura($params){
        $this->db->insert('tipo_factura',$params);
        return $this->db->insert_id();
    }

    function update_tipoFactura($tipofac_id,$params){
        $this->db->where('tipofac_id',$tipofac_id);
        return $this->db->update('tipo_factura',$params);
    }

    function truncate_table(){
        $this->db->query("TRUNCATE tipo_factura");
    }
}
