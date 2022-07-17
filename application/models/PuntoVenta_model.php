<?php
    class PuntoVenta_model extends CI_model{
        function __construct(){
            parent::__construct();
        }

        function get_all_puntoVenta(){
            return $this->db->query(
                "SELECT p.*
                from punto_venta p
                order by p.puntoventa_codigo"
                )->result_array();
        }

        function get_all_puntoVenta_cuis_cudf(){
            return $this->db->query(
                "SELECT pv.*,cu.cufd_codigo ,ci.cuis_codigo
                from punto_venta pv
                left join (
                    select c2.cufd_codigo,c2.cufd_puntodeventa,c2.cufd_id
                    from cufd c2,(
                        select max(c.cufd_id) as cufd_id
                        from cufd c 
                        group by c.cufd_puntodeventa
                    ) as c3
                    where c2.cufd_id = c3.cufd_id
                ) cu on cu.cufd_puntodeventa = pv.puntoventa_codigo  
                left join cuis ci on ci.tipopuntoventa_codigo = pv.puntoventa_codigo
                where ci.cuis_transaccion like 'true'"
                )->result_array();
        }

        function add_puntoVenta($params){
            $this->db->insert('punto_venta',$params);
            return $this->db->insert_id();
        }

        function update_puntoVenta($msjserv_id,$params){
            $this->db->where('puntoventa_id',$msjserv_id);
            return $this->db->update('punto_venta',$params);
        }

        function truncate_table(){
            $this->db->query("TRUNCATE punto_venta");
        }

        function get_cuis_puntoventa($punto_venta){
            return $this->db->query(
                "SELECT c.cuis_codigo 
                from cuis c
                where c.tipopuntoventa_codigo = $punto_venta
                and c.cuis_fechavigencia >= now()"
                )->row_array();
        }
    }  
?>