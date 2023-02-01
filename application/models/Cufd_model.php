<?php

class Cufd_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get cufd by cufd_id
     */
    function get_cufd($cufd_id)
    {
        $cufd = $this->db->query("
            SELECT
                *
            FROM
                `cufd`
            WHERE
                `cufd_id` = ?
        ",array($cufd_id))->row_array();

        return $cufd;
    }
    
    /*
     * Get all cufd count
     */
    function get_all_cufd_count()
    {
        $cufd = $this->db->query("
            SELECT
                count(*) as count
            FROM
                `cufd`
        ")->row_array();
        return $cufd['count'];
    }
        
    /*
     * Get all cufd
     */
    function get_all_cufd()
    {
        $cufd = $this->db->query("
            SELECT
                c.*
            FROM
                `cufd` c
            WHERE
                1 = 1

            ORDER BY c.`cufd_id` desc

        ")->result_array();
        return $cufd;
    }
        
    /*
     * function to add new cufd
     */
    function add_cufd($params)
    {
        $this->db->insert('cufd',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update cufd
     */
    function update_cufd($cufd_id,$params)
    {
        $this->db->where('cufd_id',$cufd_id);
        return $this->db->update('cufd',$params);
    }
    
    /*
     * function to delete cufd
     */
    function delete_cufd($cufd_id)
    {
        return $this->db->delete('cufd',array('cufd_id'=>$cufd_id));
    }
    
}
