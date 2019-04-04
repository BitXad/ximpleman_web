<?php

Class Login extends CI_Controller
{

    public function __construct()    {
        parent::__construct();
    }

    public function index() {
    	 $licencia="SELECT DATEDIFF(licencia_fechalimite, CURDATE()) as dias FROM licencia WHERE licencia_id = 1";
                $lice = $this->db->query($licencia)->row_array();

                if ($lice['dias']<=10) {
        $data['diaslic'] = $lice;
        $this->load->view('login/singin',$data);
    	} else{
    		$data['diaslic'] = 5000;
    	$this->load->view('login/singin',$data);	
    	}
    }
}

