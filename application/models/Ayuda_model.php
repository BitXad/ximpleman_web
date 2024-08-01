<?php

class Ayuda_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get almacen by almacen_id
     */
    function get_almacen($almacen_id)
    {
        $almacen = $this->db->query("
            SELECT
                *
            FROM
                `almacenes`
            WHERE
                `almacen_id` = ?
        ",array($almacen_id))->row_array();

        return $almacen;
    }
    
    /*
     * Get all almacen count
     */
    function get_all_almacen_count()
    {
        $almacen = $this->db->query("
            SELECT
                count(*) as count
            FROM
                `almacenes`
        ")->row_array();
        return $almacen['count'];
    }
        
    /*
     * Get all almacen
     */
    function get_all_almacen()
    {
        $almacen = $this->db->query("
            SELECT
                a.*, e.estado_color, e.estado_descripcion
            FROM
                `almacenes` a
            left join estado e on a.estado_id = e.estado_id
            WHERE
                a.estado_id <>0

            ORDER BY `almacen_nombre`

        ")->result_array();
        return $almacen;
    }
        
    /*
     * Get all almacen
     */
    function get_almacenes()
    {
        $almacen = $this->db->query("
            SELECT
                a.*, e.estado_color, e.estado_descripcion
            FROM
                `almacenes` a
            left join estado e on a.estado_id = e.estado_id

            ORDER BY `almacen_nombre`

        ")->result_array();
        return $almacen;
    }
        
//
//    // Obtener todos los registros
//    public function get_ayuda($id = FALSE) {
//        if ($id === FALSE) {
//            $query = $this->db->get('ayuda');
//            return $query->result_array();
//        }
//
//        $query = $this->db->get_where('ayuda', array('ayuda_id' => $id));
//        return $query->row_array();
//    }

    // Insertar un nuevo registro
    public function set_ayuda($data) {
        return $this->db->insert('ayuda', $data);
    }

    // Actualizar un registro existente
    public function update_ayuda($id, $data) {
        $this->db->where('ayuda_id', $id);
        return $this->db->update('ayuda', $data);
    }

    // Eliminar un registro
    public function delete_ayuda($id) {
        return $this->db->delete('ayuda', array('ayuda_id' => $id));
    }
    
    
    
    
    function get_ultimos_videos()
    {
        $sql = "select * from ayuda order by ayuda_id limit 4";
        $resultado = $this->db->query($sql)->result_array();
        return $resultado;
    }
    
    function get_videos()
    {
        $sql = "select * from ayuda";
        $resultado = $this->db->query($sql)->result_array();
        return $resultado;
    }
    
    function get_ayuda($parametro, $origen)
    {
        if($origen==1)
            $sql = "select * from ayuda
                    where ayuda_titulo like '%{$parametro}%' or ayuda_subtitulo like '%{$parametro}%' or ayuda_texto like '%{$parametro}%'";
            
        
        $resultado = $this->db->query($sql)->result_array();
        return $resultado;
    }
            
    
    
}
