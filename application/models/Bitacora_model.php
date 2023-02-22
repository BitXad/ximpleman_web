<?php

class Bitacora_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get bitacora by bitacora_id
     */
    function get_bitacora($bitacora_id)
    {
        $bitacora = $this->db->query("
            SELECT
                b.*, u.usuario_nombre
            FROM
                `bitacora` b
            LEFT JOIN usuario u on b.usuario_id = u.usuario_id
            WHERE
                `bitacora_id` = ?
        ",array($bitacora_id))->row_array();
        return $bitacora;
    }
    
    /*
     * Get all bitacora
     */
    function get_all_bitacora()
    {
        $bitacora = $this->db->query("
            SELECT
                b.*, u.usuario_nombre
            FROM
                `bitacora` b
            LEFT JOIN usuario u on b.usuario_id = u.usuario_id
            WHERE
                1 = 1
            ORDER BY b.`bitacora_id` DESC
        ")->result_array();

        return $bitacora;
    }
        
    /*
     * function to add new bitacora
     */
    function add_bitacora($params)
    {
        $this->db->insert('bitacora',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update bitacora
     */
    function update_bitacora($bitacora_id,$params)
    {
        $this->db->where('bitacora_id',$bitacora_id);
        return $this->db->update('bitacora',$params);
    }
    
    /*
     * function to delete bitacora
     */
    function delete_bitacora($bitacora_id)
    {
        return $this->db->delete('bitacora',array('bitacora_id'=>$bitacora_id));
    }
}
