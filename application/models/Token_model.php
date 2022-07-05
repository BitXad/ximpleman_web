<?php

class Token_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * function to add new token
     */
    function add_token($params)
    {
        $this->db->insert('token',$params);
        return $this->db->insert_id();
    }
    /*
     * Get ingreso by ingreso_id
     */
    function get_token($token_id)
    {
        return $this->db->get_where('token',array('token_id'=>$token_id))->row_array();
    }
    
    function update_token($token_id,$params)
    {
        $this->db->where('token_id',$token_id);
        return $this->db->update('token',$params);
    }
    /* muestra todos los tokens */
    function get_alltokens($parametro)
    {
        $el_parametro = "";
        if($parametro != ""){
            $el_parametro = "and (t.token_id = '".$parametro."' or t.token_delegado like '%".$parametro."%'
                             or t.token_fechadesde like '%".$parametro."%' or t.token_fechahasta like '%".$parametro."%')";
        }
        $sql = "SELECT
                    t.*, e.estado_color, e.estado_descripcion
                FROM
                    token t
                LEFT JOIN estado e on t.estado_id = e.estado_id
                where
                    1= 1
                    ".$el_parametro."
                ORDER By t.token_id desc";
        $token = $this->db->query($sql)->result_array();
        return $token;

    }
    function get_tokenactivo()
    {
        $token = $this->db->query("
                SELECT
                    t.*
                FROM
                    token t
                WHERE
                    t.estado_id = 1
                ORDER By t.token_id desc limit 1
         ")->result_array();

        return $token;
    }
    function update_tokendelegdosif($dosificacion_id,$params)
    {
        $this->db->where('dosificacion_id',$dosificacion_id);
        return $this->db->update('dosificacion',$params);
    }
}
