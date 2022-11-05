<?php
    class PuntoVenta_model extends CI_model{
        function __construct(){
            parent::__construct();
        }

        function get_all_puntoVenta(){
            return $this->db->query(
                "SELECT p.*, tp.tipopuntoventa_descripcion, cf.cufd_fechavigencia, cu.cuis_fechavigencia
                from punto_venta p
                left join tipo_puntoventa tp on p.tipopuntoventa_codigo = tp.tipopuntoventa_codigo
                left join cufd cf on p.cufd_codigo = cf.cufd_codigo
                left join cuis cu on p.cuis_codigo = cu.cuis_codigo
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
                    and c.cuis_fechavigencia >= now()
                order by c.cuis_id desc
                ")->row_array();
        }
        /* obtiene informacion de un punto de venta*/
        function get_puntoventa($puntoventa_codigo){
            return $this->db->query(
                "SELECT pv.*
                from punto_venta pv
                where pv.puntoventa_codigo = $puntoventa_codigo
                ")->row_array();
        }
        /* obtiene informacion de un punto de venta de un usuario*/
        function get_puntoventausuario($usuario_id){
            return $this->db->query(
                "select pv.puntoventa_codigo, pv.puntoventa_nombre from punto_venta pv
                left join usuario u on pv.puntoventa_codigo = u.puntoventa_codigo
                where
                u.usuario_id = $usuario_id
            ")->row_array();
        }
    }  
