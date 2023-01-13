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
    function get_mis_eventos(){
        $punto_venta = $this->session_data['puntoventa_codigo'];
        return $this->db->query("SELECT * from registro_eventos where estado_id = 1 and registroeventos_puntodeventa = ".$punto_venta)->result_array();
        
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
    
    /**
     * get Codigos Nis for activity and secondary activity
     */
    function get_eventossignificativos(){
        return $this->db->query(
            "select ev.*, e.estado_color, e.estado_descripcion
             from registro_eventos ev
             left join estado e on ev.estado_id = e.estado_id
             order by registroeventos_id desc
        ")->result_array();
    }
    
    /**
     * get registro_eventos (lista) dado un registroeventos_id
     */
    function get_eventos_porid($registroevento_id){
        
        $sql = "select * from registro_eventos where registroeventos_id = ".$registroevento_id;
        return $this->db->query($sql)->result_array();
    }
    
    /**
     * get Codigos Nis for activity and secondary activity
     */
    function get_evento_vigente($punto_venta){
        
        $sql = "select if(count(*)>0, registroeventos_id, 0) as registroeventos_id
                from registro_eventos
                where estado_id = 1 and registroeventos_puntodeventa = ".$punto_venta;

        return $this->db->query($sql)->row_array();
        
    }
    
    /*
     * function to update eventos significativos( registro eventos)
     */
    function update_registroevento($registroeventos_id,$params)
    {
        $this->db->where('registroeventos_id',$registroeventos_id);
        return $this->db->update('registro_eventos',$params);
    }
    
    /**
     * get registro_eventos dado un registroeventos_id
     */
    function get_eventosignificativo($registroevento_id){
        
        $sql = "select * from registro_eventos where registroeventos_id = ".$registroevento_id;
        return $this->db->query($sql)->row_array();
    }

}
