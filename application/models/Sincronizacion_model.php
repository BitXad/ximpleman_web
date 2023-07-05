<?php
class Sincronizacion_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    /**
     * Obtener codigo de sincronizacion
     */
    function get_codigo($codigo_id){
        $codigo = $this->db->query(
            "SELECT *
            FROM sincronizacion
            WHERE c = ?
            ",array($codigo_id))->row_array();
        return $codigo;
    }
    /*
     * Obtener todos los codigos de sincronizacion
     */
    function get_all_codigos(){
        return $this->db->query(
            "SELECT * 
            from sincronizacion"
        )->result_array();
    }
    
    function delete_codigo($codigo_id){
        return $this->db->delete('sincronizacion',array('sincronizacion_id'=>$codigo_id));
    }
    /**
     * get Codigos Nis for activity and secondary activity
     */
    function getCodigosNis(){
        return $this->db->query(
            "SELECT ps.*
            from productos_servicios ps, dosificacion d 
            where (ps.prodserv_codigoactividad = d.dosificacion_actividad or ps.prodserv_codigoactividad = d.dosificasion_actividadsec)"
        )->result_array();
    }
    /**
     * Obtener todo los documentos de identidad
     */
    function getall_docs_ident(){
        return $this->db->query(
            "SELECT cdi.* 
            FROM cod_doc_identidad cdi where estado_id = 1"
        )->result_array();
    }
}
