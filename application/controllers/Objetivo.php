<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
class Objetivo extends CI_Controller{
    
    private $sistema;
    private $parametro;
    
    function __construct(){
        parent::__construct();
        
        $this->load->model(array('Usuario_model', 
            'Rol_usuario_model', 
            'Tipo_usuario_model', 
            'Objetivo_model', 
            'user_model',
            'Estado_model',
            'Parametro_model'
            ));
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        
        $this->configuracion = $this->Parametro_model->get_parametros();
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
        
        $parametro = $this->Parametro_model->get_parametros();
        $this->parametros = $parametro[0];
    }

    private function acceso($id_rol){
        
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
        
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
            $this->load->view('layouts/main',$data);
        }
    }
    /*
    * Index objetivo
    */
    function index($a = null){
        
            $data['sistema'] = $this->sistema;
            $data['parametro'] = $this->parametros;
        
        // if($this->acceso(30)) {
            $data['tipo_usuario_id'] = $this->session_data['tipousuario_id'];
            // $data['usuario'] = $this->Usuario_model->get_all_usuario();
            $data['objetivos']= $this->Objetivo_model->get_usuarios_objetivos();    
            $data['_view'] = 'objetivo/index';
            $this->load->view('layouts/main',$data);
        // }
    }
    /*
    * Dar objetivo a un usuario
    */
    function add(){
        
        $data['sistema'] = $this->sistema;
        // if($this->acceso()){
            $this->load->library('form_validation');
    
            $this->form_validation->set_rules('objetivo_minimo','Objetivo Minimo','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_aceptable','Objetivo Aceptable','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_diario','Objetivo Diario','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_mes','Objetivo Mes','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_pedido','Objetivo Pedido','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_pedido_mes','Objetivo Pedido Mes','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
                $params = array(
                    'usuario_id' => $this->input->post('usuario'),
                    'objetivo_minimo' => $this->input->post('objetivo_minimo'),
                    'objetivo_aceptable' => $this->input->post('objetivo_aceptable'),
                    'objetivo_diario' => $this->input->post('objetivo_diario'),
                    'objetivo_mes' => $this->input->post('objetivo_mes'),
                    'objetivo_pedido' => $this->input->post('objetivo_pedido'),
                    'objetivo_pedido_mes' => $this->input->post('objetivo_pedido_mes'),
                    'estado_id' => 1
                );
                
                $objetivo_id = $this->Objetivo_model->add_objetivo($params);
                redirect('objetivo/');
            }
            else
            {
                $data['usuarios_obejetivo'] = $this->Objetivo_model->get_usuarios_sin_objetivos();
                $data['page_title'] = "Objetivos";
                $data['_view'] = 'objetivo/add';
                $this->load->view('layouts/main',$data);
            }
        // }
    }
    /*
    * Editar los objetivos de un usuario
    */
    function edit($objetivo_id){
        
        $data['sistema'] = $this->sistema;
        $data['usuarios_objetivo'] = $this->Objetivo_model->get_objetivo_usuario($objetivo_id);

        if(isset($data['usuarios_objetivo']['objetivo_id'])){
            $this->load->library('form_validation');
    
            $this->form_validation->set_rules('objetivo_minimo','Objetivo Minimo','required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_aceptable','Objetivo Aceptable','required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_diario','Objetivo Diario','required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_mes','Objetivo Mes','required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_pedido','Objetivo Pedido','required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('objetivo_pedido_mes','Objetivo Pedido Mes','required', array('required' => 'Este Campo no debe ser vacio'));
            // $this->form_validation->set_rules('estado_id', array('required' => 'Este Campo no debe ser vacio'));
            
            if($this->form_validation->run()){
                $params = array(
                    'usuario_id' => $this->input->post('usuario_id'),
                    'objetivo_minimo' => $this->input->post('objetivo_minimo'),
                    'objetivo_aceptable' => $this->input->post('objetivo_aceptable'),
                    'objetivo_diario' => $this->input->post('objetivo_diario'),
                    'objetivo_mes' => $this->input->post('objetivo_mes'),
                    'objetivo_pedido' => $this->input->post('objetivo_pedido'),
                    'objetivo_pedido_mes' => $this->input->post('objetivo_pedido_mes'),
                    'estado_id' => $this->input->post('estado_id')
                );
                
                $this->Objetivo_model->update_objetivo($objetivo_id,$params);
                redirect('objetivo/');
            }else{
                $data['usuarios_obejetivo'] = $this->Objetivo_model->get_usuarios_sin_objetivos();
                $data['all_estado'] = $this->Estado_model->get_all_estado();
                $data['page_title'] = "Objetivos";
                $data['_view'] = 'objetivo/edit';
                $this->load->view('layouts/main',$data);
            }

        }else{
            show_error('The moneda you are trying to edit does not exist.');
        }
    }
    /*
    * Todos los Objetivos
    */
    function objgrafica($usuario_id){
        
        $data['sistema'] = $this->sistema;
        // $data['objetivo'] = $this->grafico->get_objetivos();
        $data["usuario_id"] = $usuario_id;
        $data['_view'] = 'objetivo/';
        $this->load->view('layouts/main',$data);
    }

    /*
    * Obtener el ultimo dia del mes
    */
    public function getUltimoDiaMes($elAnio,$elMes) {
        return date("d",(mktime(0,0,0,$elMes+1,1,intval($elAnio))-1));
    }
    /*
    * Objetivos de un mes
    */
    function objetivos_mes(){
        
        $data['sistema'] = $this->sistema;
        
        $dia = $this->input->post("dia");                    
        $mes = $this->input->post("mes"); 
        $anio = $this->input->post("anio");
        
        $fecha = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$dia));

        $primer_dia = 1;
        $ultimo_dia = $this->getUltimoDiaMes($anio,$mes);
        
        //$fecha_inicial = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        //$fecha_final = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            
        $fecha_inicial = $anio."-".$mes."-01";
        //$fecha_final = $anio."-".$mes."-31";
        $fecha_final = $anio."-".$mes."-".$ultimo_dia;
         // --------------------------------------------------------------------------------------------
        $sql_objetivos = "SELECT u.usuario_nombre, u.`usuario_imagen`, aux.`tipousuario_descripcion`, e.`estado_color`, e.estado_descripcion, o.*
                            FROM `objetivo` AS o
                            LEFT JOIN usuario AS u ON o.usuario_id = u.`usuario_id`
                            LEFT JOIN estado AS e ON o.`estado_id` = e.estado_id
                            LEFT JOIN (
                                SELECT u.`usuario_id`, t.tipousuario_descripcion 
                                FROM usuario AS u, tipo_usuario AS t
                                WHERE u.`tipousuario_id` = t.`tipousuario_id`
                            ) AS aux ON o.`usuario_id` = aux.usuario_id
                            WHERE o.`usuario_id` = u.usuario_id";
        //echo $sql_objetivos;
        $objetivos = $this->db->query($sql_objetivos)->result_array();
        // --------------------------------------------------------------------------------------------
        $sql_ventas_mes = "SELECT if(sum(d.detalleven_total)>0, round(sum(d.detalleven_total),2), 0) AS total_mes, u.usuario_id
                            FROM usuario AS u
                            LEFT JOIN objetivo AS o ON o.usuario_id = u.usuario_id
                            LEFT JOIN estado AS e ON u.`estado_id` = e.`estado_id`
                            LEFT JOIN tipo_usuario AS t ON t.`tipousuario_id` = u.`tipousuario_id`
                            left join detalle_venta as d on d.`usuario_id` = u.`usuario_id`
                            left join venta as v on v.`usuario_id`=o.usuario_id
                            WHERE o.usuario_id = u.usuario_id AND
                            v.venta_id = d.venta_id AND 
                            v.venta_fecha >= '".$fecha_inicial."' AND 
                            v.venta_fecha <= '".$fecha_final."' AND 
                            v.usuario_id = u.usuario_id
                            GROUP BY u.usuario_nombre 
                            order by u.usuario_nombre
                    ";
/*        $sql_ventas_mes = "SELECT if(sum(d.detalleven_total) > 0, round(sum(d.detalleven_total), 2), 0) AS total_mes, u.usuario_id
                            FROM
                              usuario u, detalle_venta d, venta v

                            WHERE
                              v.venta_id = d.venta_id AND 
                              v.venta_fecha >= '".$fecha_inicial."' AND 
                              v.venta_fecha <= '".$fecha_final."' AND 
                              v.usuario_id = u.usuario_id
                            GROUP BY
                              u.usuario_id
                            ORDER BY
                              u.usuario_nombre";
*/        
        //echo $sql_ventas_mes;
        $ventas_mes = $this->db->query($sql_ventas_mes)->result_array();
        // --------------------------------------------------------------------------------------------
        $sql_ventas_dia = "SELECT if(sum(d.detalleven_total)>0, round(sum(d.detalleven_total),2), 0) AS total_dia, u.usuario_id
                            FROM usuario AS u
                            LEFT JOIN objetivo AS o ON o.usuario_id = u.usuario_id
                            LEFT JOIN estado AS e ON u.`estado_id` = e.`estado_id`
                            LEFT JOIN tipo_usuario AS t ON t.`tipousuario_id` = u.`tipousuario_id`
                            left join detalle_venta as d on d.`usuario_id` = u.`usuario_id`
                            left join venta as v on v.`usuario_id`=o.usuario_id
                            WHERE o.usuario_id = u.usuario_id AND
                            v.venta_id = d.venta_id AND 
                            v.venta_fecha = '".$fecha."' AND 
                            v.usuario_id = u.usuario_id
                            GROUP BY u.usuario_nombre 
                            order by u.usuario_nombre
                        ";
/*        $sql_ventas_dia = "SELECT 
                            if(sum(d.detalleven_total) > 0, round(sum(d.detalleven_total), 2), 0) AS total_dia,
                            u.usuario_id
                          FROM
                            usuario u, venta v, detalle_venta d
                          WHERE
                            v.venta_fecha = '".$fecha."' and
                            v.venta_id = d.venta_id and
                            v.usuario_id = u.usuario_id
                          GROUP BY
                            u.usuario_id
                          ORDER BY
                            u.usuario_nombre";*/
        
        //echo $sql_ventas_dia;
        $ventas_dia = $this->db->query($sql_ventas_dia)->result_array();
        // // --------------------------------------------------------------------------------------------
        $sql_pedidos_mes = "SELECT if(count(p.`pedido_total`)>0, COUNT(p.`pedido_total`),0) as pedido_mes, u.usuario_id
                            FROM pedido as  p
                            LEFT JOIN venta as v on p.pedido_id = v.`pedido_id`
                            LEFT JOIN usuario as u on p.`usuario_id` = u.usuario_id
                            left join objetivo as o on p.`usuario_id` = o.`usuario_id`
                            where v.`entrega_id` = 2
                            and p.`pedido_fecha` >= '".$fecha_inicial."'
                            and p.pedido_fecha <= '".$fecha_final."'
                            and p.`regusuario_id` = o.usuario_id
                            group by u.usuario_nombre
                            ORDER by u.usuario_nombre";
        
        
/*        $sql_pedidos_mes = "SELECT 
                                if(count(p.pedido_total) > 0, COUNT(p.pedido_total), 0) AS pedido_mes, u.usuario_id

                              FROM
                                pedido p, venta v, detalle_venta d, usuario u

                              WHERE
                                v.entrega_id = 2 AND 
                                p.pedido_fecha >= '".$fecha_inicial."' AND 
                                p.pedido_fecha <= '".$fecha_final."' AND 
                                p.pedido_id = v.pedido_id and
                                d.venta_id = v.venta_id and
                                u.usuario_id = v.usuario_id

                              GROUP BY

                                u.usuario_id

                              ORDER BY

                                u.usuario_nombre";*/
        //echo $sql_pedidos_mes;
        
        $pedidos_mes = $this->db->query($sql_pedidos_mes)->result_array();
        // // --------------------------------------------------------------------------------------------
        $sql_pedidos_dia = "SELECT IF(COUNT(p.`pedido_id`)>0, COUNT(p.`pedido_id`),0) as pedido_dia, u.usuario_id
                            FROM pedido AS  p
                            LEFT JOIN venta as v on p.pedido_id = v.`pedido_id`
                            LEFT JOIN usuario AS u ON p.`usuario_id` = u.usuario_id
                            LEFT JOIN objetivo AS o ON p.`usuario_id` = o.`usuario_id`
                            WHERE  date(p.`pedido_fecha`) = '".$fecha."'
                            AND p.`regusuario_id` = o.usuario_id
                            GROUP BY u.usuario_nombre
                            ORDER BY u.usuario_nombre
                            ";
        //echo $sql_pedidos_dia;
        
        $pedidos_dia = $this->db->query($sql_pedidos_dia)->result_array();
        
        $data = array(
            "objetivos"   => $objetivos,
            "ventas_dia"  => $ventas_dia,
            "ventas_mes"  => $ventas_mes,
            "pedidos_dia" => $pedidos_dia,
            "pedidos_mes" => $pedidos_mes
        );
        echo json_encode($data);
    }
    
    function mes_usuario_objetivo($anio,$mes,$usuario_id){
        
        $data['sistema'] = $this->sistema;
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        // $fechas = "SELECT compra_fecha, round(compra_totalfinal,2) as compra_totalfinal FROM compra where compra.compra_fecha >= '".$anio."-".$mes."-01' and  compra.compra_fecha <= '".$anio."-".$mes."-31' ";
        $fechas = "SELECT date(pedido_fecha), if(count(p.pedido_total)>0,count(p.pedido_total),0) as pedido_total
                    FROM pedido as p
                    where p.pedido_fecha >= '".$anio."-".$mes."-01'
                    and p.pedido_fecha <= '".$anio."-".$mes."-31'
                    and p.regusuario_id = ".$usuario_id."
                    group by p.pedido_total";
        // $fechas = "SELECT date(pedido_fecha), round(p.pedido_total,2) as pedido_total
        //             FROM pedido as p
        //             where p.pedido_fecha >= '".$anio."-".$mes."-01' 
        //             and p.pedido_fecha <= '".$anio."-".$mes."-31'
        //             and p.regusuario_id = ".$usuario_id.";";
        $result= $this->db->query($fechas)->result_array();
        $fechasven = "SELECT v.venta_fecha, round(v.venta_total,2) as venta_total 
                        FROM venta as v 
                        where v.venta_fecha >= '".$anio."-".$mes."-01' 
                        and  v.venta_fecha <= '".$anio."-".$mes."-31'
                        and v.usuario_id = ".$usuario_id.";";
        $resultven= $this->db->query($fechasven)->result_array();
        //$result=$data['result'];
        $ct=count($result);

        for($d=1;$d<=$ultimo_dia;$d++){
            $registros[$d]=0;
            $registrosven[$d]=0;     
        }

        foreach($result as $res){
            $diasel=intval(date("d",strtotime($res['date(pedido_fecha)']) ) );
            
            $suma=$res['pedido_total'];
            
            $registros[$diasel]+=$suma;    
        }

        foreach($resultven as $resven){
            $diaselven=intval(date("d",strtotime($resven['venta_fecha']) ) );
            
            $sumave=$resven['venta_total'];
        
            $registrosven[$diaselven]+=$sumave;    
        }

        $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros, "registrosven" =>$registrosven);
        echo   json_encode($data);
        /*$anio = $this->input->post('anio');   1555891200
        $mes = $this->input->post('fecha2'); 
    */
    }   
}