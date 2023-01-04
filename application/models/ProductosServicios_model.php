<?php
    class ProductosServicios_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_productosServicios(){
            return $this->db->query(
                "SELECT * 
                from productos_servicios"
            )->result_array();
        }

        function add_productoServicio($params){
            $this->db->insert('productos_servicios',$params);
            return $this->db->insert_id();
        }

        function update_productos_servicios($prodserv_id,$params){
            $this->db->where('prodserv_id',$prodserv_id);
            return $this->db->update('productos_servicios', $params);
        }

        function truncate_table(){
            $this->db->query("truncate productos_servicios");
        }
        /**
         * Obtener codigos productos servicios por las actividades deacuerdo a la dosificacion
         */
        function get_productosServicios_actividad(){
            return $this->db->query(
                "SELECT ps.*
                from productos_servicios ps, dosificacion d 
                where (ps.prodserv_codigoactividad = d.dosificacion_actividad or ps.prodserv_codigoactividad = d.dosificasion_actividadsec)"
            )->result_array();
        }
    }
?>