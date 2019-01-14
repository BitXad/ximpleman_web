<?php
class Principal_model extends CI_model{
    
    function __construct() {
        parent::__construct();
    }
    
    function get_menu_principal($id_pagina){
        $sql = "select * from menu_principal p, menu m where p.id_pagina=".$id_pagina." and m.id_menup = p.id_menup";
        return $this->db->query($sql)->result_array();        
    }
    
    function get_menu_items($id_pagina){
        $sql="select i.* from menu m, item i where ".$id_pagina." and m.id_menu = i.id_menu ";
        return $this->db->query($sql)->result_array();
    }    
}

