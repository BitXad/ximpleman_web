<?php
    class Tipo_puntoventa_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_tipopuntoventa($tipopuntoventa_id){
            return $this->db->query(
                        "SELECT *
                        FROM tipo_puntoventa
                        WHERE tipopuntoventa_id = ?",
                        array($tipopuntoventa_id))->row_array();
        }

        function get_all_tipopuntoventa(){
            return $this->db->query(
                "SELECT tp.*,cu.cufd_codigo,ci.cuis_codigo
                from tipo_puntoventa tp
                left join (
                    select max(cd.cufd_fecharegistro) as ultimo_registro, cd.cufd_codigo, cd.cufd_puntodeventa
                    from cufd cd 
                ) as cu on cu.cufd_puntodeventa = tp.tipopuntoventa_codigo 
                left join (
                    select max(c.cuis_fechavigencia),c.tipopuntoventa_codigo,c.cuis_codigo
                    from cuis c
                ) as ci on ci.tipopuntoventa_codigo = tp.tipopuntoventa_codigo 
                order by tp.tipopuntoventa_codigo asc"
                )->result_array();
        }
        
        function add_tipopuntoventa($params){
            $this->db->insert('tipo_puntoventa',$params);
            return $this->db->insert_id();
        }

        function update_tipopuntoventa($tipopuntoventa_id,$params){
            $this->db->where('tipopuntoventa_id',$tipopuntoventa_id);
            return $this->db->update('tipo_puntoventa',$params);
        }
        
        function delete_tipopuntoventa_id($tipopuntoventa_id){
            return $this->db->delete('tipo_puntoventa',array('tipopuntoventa_id'=>$tipopuntoventa_id));
        }

        function truncate_table(){
            $this->db->query("TRUNCATE tipo_puntoventa");
        }
    }
?>