<?php
class Eventos_significativos_model extends CI_Model{
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
            from cod_eventos_significativos"
        )->result_array();
    }
    /*
     * Obtener todos los codigos de sincronizacion
     */
    function get_all_fecha($fecha){
        
        $sql = "select c.* from cufd c where date(c.cufd_fecharegistro) = '".$fecha."'";
        //echo $sql;
        return $this->db->query($sql)->result_array();
    }
    
    function delete_codigo($codigo_id){
        return $this->db->delete('eventos_significativos',array('sincronizacion_id'=>$codigo_id));
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
            FROM cod_doc_identidad cdi"
        )->result_array();
    }

    /**
     * Consultar
     */
    function consultar($sql){
        
        return $this->db->query($sql)->result_array();
    }

    /**
     * Ejecutar
     */
    function ejecutar($sql){
        
        return $this->db->query($sql);
    }

}
