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

    /**
     * Obtener todos los codigos de sincronizacion
     */
    function get_all_codigos(){
        return $this->db->query(
            "SELECT *
            FROM sincronizacion"
        )->result_array();
    }

    function delete_codigo($codigo_id){
        return $this->db->delete('sincronizacion',array('sincronizacion_id'=>$codigo_id));
    }

    /**
     * get Codigos Nis for activity and secondary activity
     */
    function getCodigosNis(){
        $sql = "SELECT ps.* FROM productos_servicios ps";
        return $this->db->query($sql)->result_array();
    }

    /**
     * Obtener todo los documentos de identidad activos
     */
    function getall_docs_ident(){
        return $this->db->query(
            "SELECT cdi.*
            FROM cod_doc_identidad cdi
            WHERE cdi.estado_id = 1"
        )->result_array();
    }

    /**
     * Obtener métodos de pago con descripción del estado.
     * Valores esperados: estado_id = 1 ACTIVO, estado_id = 2 INACTIVO.
     */
    function get_all_formas_pago(){
        $sql = "SELECT fp.*,
                       COALESCE(e.estado_descripcion,
                           CASE WHEN fp.estado_id = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END
                       ) AS estado_descripcion,
                       e.estado_color
                FROM forma_pago fp
                LEFT JOIN estado e ON e.estado_id = fp.estado_id
                ORDER BY fp.forma_codigoclasificador ASC, fp.forma_nombre ASC";
        return $this->db->query($sql)->result_array();
    }

    /**
     * Cambiar estado de un método de pago específico.
     */
    function cambiar_estado_forma_pago($forma_id, $estado_id){
        $forma_id = (int)$forma_id;
        $estado_id = (int)$estado_id;

        if($forma_id <= 0 || !in_array($estado_id, array(1, 2))){
            return false;
        }

        $this->db->where('forma_id', $forma_id);
        return $this->db->update('forma_pago', array('estado_id' => $estado_id));
    }

    /**
     * Cambiar estado de todos los métodos de pago.
     */
    function cambiar_estado_todos_forma_pago($estado_id){
        $estado_id = (int)$estado_id;

        if(!in_array($estado_id, array(1, 2))){
            return false;
        }

        return $this->db->update('forma_pago', array('estado_id' => $estado_id));
    }

    /**
     * Obtener descripción del estado.
     */
    function get_estado_forma_pago($estado_id){
        $estado_id = (int)$estado_id;
        $estado = $this->db->query(
            "SELECT estado_id, estado_descripcion, estado_color
             FROM estado
             WHERE estado_id = ?",
            array($estado_id)
        )->row_array();

        if(!$estado){
            $estado = array(
                'estado_id' => $estado_id,
                'estado_descripcion' => ($estado_id == 1 ? 'ACTIVO' : 'INACTIVO'),
                'estado_color' => null
            );
        }

        return $estado;
    }

    /**
     * Total de métodos de pago.
     */
    function contar_formas_pago(){
        return (int)$this->db->count_all('forma_pago');
    }

//    public function cambiar_estado_forma_pago($forma_id, $estado_id)
//    {
//        $this->db->where('forma_id', $forma_id);
//        return $this->db->update('forma_pago', [
//            'estado_id' => $estado_id
//        ]);
//    }
    
}
