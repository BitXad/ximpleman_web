<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculo extends CI_Controller
{
    private $sistema;
    private $parametros;
    private $session_data;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Vehiculo_model');
        $this->load->model('Tarifa_model');
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
        $this->load->library('upload');
        // $this->load->model('Tipo_vehiculo_model'); // cargar si realmente lo usas

        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));

        $this->sistema = $this->Sistema_model->get_sistema();
        $parametro = $this->Parametro_model->get_parametros();
        $this->parametros = isset($parametro[0]) ? $parametro[0] : array();

        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        } else {
            redirect('', 'refresh');
        }
    }
    private function permiso_transporte($rol_id){
        $uid=isset($this->session_data['usuario_id'])?(int)$this->session_data['usuario_id']:0;
        if($uid<=0) return false;
        $r=$this->db->query("SELECT 1 ok FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",array($uid,(int)$rol_id))->row_array();
        return !empty($r);
    }
    private function negar_permiso($mensaje){ show_error($mensaje,403,'Acceso denegado'); return false; }



    public function index()
    {
        if(!$this->permiso_transporte(222)){ $this->negar_permiso('No tiene permiso para administrar vehículos.'); return; }
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
        $data['noof_page'] = 0;
        $data['vehiculo'] = $this->Vehiculo_model->get_all_vehiculo();
        $data['_view'] = 'vehiculo/index';
        $this->load->view('layouts/main', $data);
    }

    public function add()
    {
        if(!$this->permiso_transporte(222)){ $this->negar_permiso('No tiene permiso para administrar vehículos.'); return; }
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;

        $this->_set_validation_rules();

        if ($this->form_validation->run()) {
            $params = $this->_get_post_data();

            $upload_imagen = $this->_subir_imagen_vehiculo();

            if (!$upload_imagen['success']) {
                $data['error_imagen'] = $upload_imagen['error'];
                $data['_view'] = 'vehiculo/add';
                $this->load->view('layouts/main', $data);
                return;
            }

            $params['vehiculo_imagen'] = $upload_imagen['file_name'];

            $vehiculo_id = $this->Vehiculo_model->add_vehiculo($params);

            if ($vehiculo_id) {
                $this->session->set_flashdata('alert_msg', '<div class="alert alert-success text-center">Vehículo registrado correctamente.</div>');
                redirect('vehiculo/index');
            } else {
                if (!empty($params['vehiculo_imagen'])) {
                    $this->_eliminar_imagen_vehiculo($params['vehiculo_imagen']);
                }
                $data['error_imagen'] = 'No se pudo registrar el vehículo.';
            }
        }

        $data['_view'] = 'vehiculo/add';
        $this->load->view('layouts/main', $data);
    }

    public function edit($vehiculo_id = null)
    {
        if(!$this->permiso_transporte(222)){ $this->negar_permiso('No tiene permiso para administrar vehículos.'); return; }
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
        $data['vehiculo'] = $this->Vehiculo_model->get_vehiculo($vehiculo_id);

        if (!isset($data['vehiculo']['vehiculo_id'])) {
            show_error('El vehículo que intenta editar no existe.');
        }

        $this->_set_validation_rules($vehiculo_id);

        if ($this->form_validation->run()) {
            $params = $this->_get_post_data();
            $imagen_anterior = $data['vehiculo']['vehiculo_imagen'];

            if (isset($_FILES['vehiculo_imagen_file']) && !empty($_FILES['vehiculo_imagen_file']['name'])) {
                $upload_imagen = $this->_subir_imagen_vehiculo();

                if (!$upload_imagen['success']) {
                    $data['error_imagen'] = $upload_imagen['error'];
                    $data['_view'] = 'vehiculo/edit';
                    $this->load->view('layouts/main', $data);
                    return;
                }

                $params['vehiculo_imagen'] = $upload_imagen['file_name'];
            }

            $ok = $this->Vehiculo_model->update_vehiculo($vehiculo_id, $params);

            if ($ok) {
                if (isset($params['vehiculo_imagen']) && !empty($params['vehiculo_imagen']) && !empty($imagen_anterior)) {
                    $this->_eliminar_imagen_vehiculo($imagen_anterior);
                }

                $this->session->set_flashdata('alert_msg', '<div class="alert alert-success text-center">Vehículo actualizado correctamente.</div>');
                redirect('vehiculo/index');
            } else {
                if (isset($params['vehiculo_imagen']) && !empty($params['vehiculo_imagen'])) {
                    $this->_eliminar_imagen_vehiculo($params['vehiculo_imagen']);
                }
                $data['error_imagen'] = 'No se pudo actualizar el vehículo.';
            }
        }

        $data['_view'] = 'vehiculo/edit';
        $this->load->view('layouts/main', $data);
    }
    public function remove($vehiculo_id)
    {
        if(!$this->permiso_transporte(222)){ $this->negar_permiso('No tiene permiso para administrar vehículos.'); return; }
        $vehiculo = $this->Vehiculo_model->get_vehiculo($vehiculo_id);

        if (!isset($vehiculo['vehiculo_id'])) {
            show_error('El vehículo que intenta eliminar no existe.');
        }

        $this->Vehiculo_model->delete_vehiculo($vehiculo_id);
        $this->session->set_flashdata('alert_msg', '<div class="alert alert-success text-center">Vehículo eliminado correctamente.</div>');
        redirect('vehiculo/index');
    }

    public function view_more($vehiculo_id)
    {
        if(!$this->permiso_transporte(222)){ $this->negar_permiso('No tiene permiso para administrar vehículos.'); return; }

        $vehiculo_id = (int)$vehiculo_id;
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
        $data['vehiculo'] = $this->Vehiculo_model->get_vehiculo($vehiculo_id);

        if (!isset($data['vehiculo']['vehiculo_id'])) {
            show_error('El vehículo que intenta ver no existe.');
        }

        // Datos complementarios para la ficha. Se consultan sólo si las tablas existen
        // para mantener compatibilidad con instalaciones anteriores de Ximpleman.
        $data['resumen_asientos'] = array('total'=>0, 'visibles'=>0, 'vendibles'=>0, 'pisos'=>0);
        if ($this->db->table_exists('asientos')) {
            $campos = $this->db->list_fields('asientos');
            $select = 'COUNT(*) AS total';
            if (in_array('asiento_mostrar', $campos)) $select .= ', SUM(CASE WHEN asiento_mostrar=1 THEN 1 ELSE 0 END) AS visibles';
            if (in_array('asiento_es_vendible', $campos)) $select .= ', SUM(CASE WHEN asiento_es_vendible=1 THEN 1 ELSE 0 END) AS vendibles';
            if (in_array('nivel_id', $campos)) $select .= ', COUNT(DISTINCT nivel_id) AS pisos';
            elseif (in_array('nivelvehiculo_id', $campos)) $select .= ', COUNT(DISTINCT nivelvehiculo_id) AS pisos';
            $r = $this->db->select($select, false)->where('vehiculo_id', $vehiculo_id)->get('asientos')->row_array();
            if ($r) $data['resumen_asientos'] = array_merge($data['resumen_asientos'], $r);
        }

        $data['proximos_viajes'] = array();
        if ($this->db->table_exists('viaje')) {
            $campos = $this->db->list_fields('viaje');
            if (in_array('vehiculo_id', $campos) && in_array('viaje_fecha', $campos)) {
                $this->db->where('vehiculo_id', $vehiculo_id)->where('viaje_fecha >=', date('Y-m-d'));
                $this->db->order_by('viaje_fecha', 'ASC');
                if (in_array('viaje_hora', $campos)) $this->db->order_by('viaje_hora', 'ASC');
                $data['proximos_viajes'] = $this->db->limit(5)->get('viaje')->result_array();
            }
        }

        $data['_view'] = 'vehiculo/view_more';
        $this->load->view('layouts/main', $data);
    }

    private function _set_validation_rules($vehiculo_id = null)
    {
        $placa_rule = 'trim|required|max_length[30]';
        // Si deseas validar placa única y existe la regla/is_unique según tu lógica, puedes adaptarlo.

        $this->form_validation->set_rules('vehiculo_nombrespropietario', 'Nombres propietario', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('vehiculo_apellidospropietario', 'Apellidos propietario', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('estado_id', 'Estado', 'trim|integer');
        $this->form_validation->set_rules('tipomovilidad_id', 'Tipo movilidad', 'trim|integer');
        $this->form_validation->set_rules('categoriavehiculo_id', 'Categoría vehículo', 'trim|integer');
        $this->form_validation->set_rules('vehiculo_placa', 'Placa', $placa_rule);
        $this->form_validation->set_rules('vehiculo_clase', 'Clase vehículo', 'trim|max_length[30]');
        $this->form_validation->set_rules('vehiculo_marca', 'Marca', 'trim|max_length[30]');
        $this->form_validation->set_rules('vehiculo_modelo', 'Modelo', 'trim|max_length[30]');
        $this->form_validation->set_rules('vehiculo_aniofabricacion', 'Año fabricación', 'trim|integer');
        $this->form_validation->set_rules('vehiculo_tipocombustible', 'Tipo combustible', 'trim|max_length[30]');
        $this->form_validation->set_rules('vehiculo_carroceria', 'Carrocería', 'trim|max_length[30]');
        $this->form_validation->set_rules('vehiculo_ejes', 'Nro. ejes', 'trim|integer');
        $this->form_validation->set_rules('vehiculo_color', 'Color', 'trim|max_length[250]');
        $this->form_validation->set_rules('vehiculo_numeromotor', 'Nro. motor', 'trim|max_length[30]');
        $this->form_validation->set_rules('vehiculo_cilindros', 'Nro. cilindros', 'trim|integer');
        $this->form_validation->set_rules('vehiculo_serie', 'Serie', 'trim|max_length[30]');
        $this->form_validation->set_rules('vehiculo_ruedas', 'Nro. ruedas', 'trim|integer');
        $this->form_validation->set_rules('vehiculo_pesoseco', 'Peso seco', 'trim|numeric');
        $this->form_validation->set_rules('vehiculo_pesobruto', 'Peso bruto', 'trim|numeric');
        $this->form_validation->set_rules('vehiculo_longitud', 'Longitud', 'trim|numeric');
        $this->form_validation->set_rules('vehiculo_altura', 'Altura', 'trim|numeric');
        $this->form_validation->set_rules('vehiculo_ancho', 'Ancho', 'trim|numeric');
        $this->form_validation->set_rules('vehiculo_pasajeros', 'Nro. pasajeros', 'trim|integer');
        $this->form_validation->set_rules('vehiculo_tiposervicio', 'Tipo servicio', 'trim|max_length[50]');
        $this->form_validation->set_rules('vehiculo_asientos', 'Nro. asientos', 'trim|integer');
        $this->form_validation->set_rules('vehiculo_ruat', 'RUAT', 'trim|max_length[250]');
        $this->form_validation->set_rules('vehiculo_fechatarjeta', 'Fecha tarjeta', 'trim');
        $this->form_validation->set_rules('vehiculo_tarjetacirculacion', 'Tarjeta circulación', 'trim|max_length[250]');
        $this->form_validation->set_rules('vehiculo_imagen', 'Imagen', 'trim|max_length[250]');
    }

    private function _get_post_data()
    {
        return array(
            'vehiculo_apellidospropietario' => mb_strtoupper(trim($this->input->post('vehiculo_apellidospropietario')), 'UTF-8'),
            'vehiculo_nombrespropietario' => mb_strtoupper(trim($this->input->post('vehiculo_nombrespropietario')), 'UTF-8'),
            'estado_id' => $this->input->post('estado_id') ?: 1,
            'tipomovilidad_id' => $this->input->post('tipomovilidad_id') !== '' ? (int)$this->input->post('tipomovilidad_id') : null,
            'categoriavehiculo_id' => $this->input->post('categoriavehiculo_id') !== '' ? (int)$this->input->post('categoriavehiculo_id') : null,
            'vehiculo_placa' => mb_strtoupper(trim($this->input->post('vehiculo_placa')), 'UTF-8'),
            'vehiculo_clase' => mb_strtoupper(trim($this->input->post('vehiculo_clase')), 'UTF-8'),
            'vehiculo_marca' => mb_strtoupper(trim($this->input->post('vehiculo_marca')), 'UTF-8'),
            'vehiculo_modelo' => mb_strtoupper(trim($this->input->post('vehiculo_modelo')), 'UTF-8'),
            'vehiculo_aniofabricacion' => $this->input->post('vehiculo_aniofabricacion') !== '' ? (int)$this->input->post('vehiculo_aniofabricacion') : null,
            'vehiculo_tipocombustible' => mb_strtoupper(trim($this->input->post('vehiculo_tipocombustible')), 'UTF-8'),
            'vehiculo_carroceria' => mb_strtoupper(trim($this->input->post('vehiculo_carroceria')), 'UTF-8'),
            'vehiculo_ejes' => $this->input->post('vehiculo_ejes') !== '' ? (int)$this->input->post('vehiculo_ejes') : null,
            'vehiculo_color' => mb_strtoupper(trim($this->input->post('vehiculo_color')), 'UTF-8'),
            'vehiculo_numeromotor' => trim($this->input->post('vehiculo_numeromotor')),
            'vehiculo_cilindros' => $this->input->post('vehiculo_cilindros') !== '' ? (int)$this->input->post('vehiculo_cilindros') : null,
            'vehiculo_serie' => trim($this->input->post('vehiculo_serie')),
            'vehiculo_ruedas' => $this->input->post('vehiculo_ruedas') !== '' ? (int)$this->input->post('vehiculo_ruedas') : null,
            'vehiculo_pesoseco' => $this->input->post('vehiculo_pesoseco') !== '' ? (float)$this->input->post('vehiculo_pesoseco') : null,
            'vehiculo_pesobruto' => $this->input->post('vehiculo_pesobruto') !== '' ? (float)$this->input->post('vehiculo_pesobruto') : null,
            'vehiculo_longitud' => $this->input->post('vehiculo_longitud') !== '' ? (float)$this->input->post('vehiculo_longitud') : null,
            'vehiculo_altura' => $this->input->post('vehiculo_altura') !== '' ? (float)$this->input->post('vehiculo_altura') : null,
            'vehiculo_ancho' => $this->input->post('vehiculo_ancho') !== '' ? (float)$this->input->post('vehiculo_ancho') : null,
            'vehiculo_pasajeros' => $this->input->post('vehiculo_pasajeros') !== '' ? (int)$this->input->post('vehiculo_pasajeros') : null,
            'vehiculo_tiposervicio' => mb_strtoupper(trim($this->input->post('vehiculo_tiposervicio')), 'UTF-8'),
            'vehiculo_asientos' => $this->input->post('vehiculo_asientos') !== '' ? (int)$this->input->post('vehiculo_asientos') : null,
            'vehiculo_ruat' => trim($this->input->post('vehiculo_ruat')),
            'vehiculo_fechatarjeta' => $this->input->post('vehiculo_fechatarjeta') !== '' ? $this->input->post('vehiculo_fechatarjeta') : null,
            'vehiculo_tarjetacirculacion' => trim($this->input->post('vehiculo_tarjetacirculacion')),
        );
    }

    public function search_by_clm()
    {
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
        $column_name = $this->input->post('column_name', true);
        $value_id = $this->input->post('value_id', true);

        $data['noof_page'] = 0;
        $data['vehiculo'] = $this->Vehiculo_model->get_all_vehiculo_by_cat($column_name, $value_id);
        $data['_view'] = 'vehiculo/index';
        $this->load->view('layouts/main', $data);
    }

    public function get_search_values_by_clm()
    {
        $clm_name = $this->input->post('clm_name', true);
        $value = $this->input->post('value', true);
        $id = $this->input->post('id', true);

        $params = array($clm_name => $value);
        $this->Vehiculo_model->update_vehiculo($id, $params);

        $data['noof_page'] = 0;
        $data['vehiculo'] = $this->Vehiculo_model->get_all_vehiculo();
        $this->load->view('vehiculo/index', $data);
    }

        private function _resolver_tramo($viaje_id,$origen_id,$destino_id){if(!$this->db->table_exists('ruta_parada'))return null;$v=$this->db->query("SELECT ruta_id FROM viaje WHERE viaje_id=? LIMIT 1",array((int)$viaje_id))->row_array();if(!$v)return null;$o=$this->db->query("SELECT * FROM ruta_parada WHERE rutaparada_id=? AND ruta_id=? AND estado_id=1 LIMIT 1",array((int)$origen_id,(int)$v['ruta_id']))->row_array();$d=$this->db->query("SELECT * FROM ruta_parada WHERE rutaparada_id=? AND ruta_id=? AND estado_id=1 LIMIT 1",array((int)$destino_id,(int)$v['ruta_id']))->row_array();if(!$o||!$d||(int)$o['rutaparada_orden']>=(int)$d['rutaparada_orden'])return null;return array('origen'=>$o,'destino'=>$d);}

    private function _json_disenador($d)
    {
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode($d,JSON_UNESCAPED_UNICODE));
    }

    private function _disenador_instalado()
    {
        return $this->db->field_exists('asiento_tipo_elemento','asientos')
            && $this->db->field_exists('asiento_es_vendible','asientos')
            && $this->db->field_exists('vehiculo_mapa_filas','vehiculo');
    }

    public function disenador($vehiculo_id=0)
    {
        if(!$this->_disenador_instalado()){
            show_error('Falta ejecutar database/database_actualizacion_disenador_vehiculos.sql');
        }

        $data['sistema']=$this->sistema;
        $data['parametro']=$this->parametros;

        $vehiculo_id=(int)$vehiculo_id;
        if($vehiculo_id<=0){
            $data['vehiculos']=$this->Vehiculo_model->get_all_vehiculo();
            $data['_view']='vehiculo/disenador_selector';
            $this->load->view('layouts/main',$data);
            return;
        }

        $vehiculo=$this->Vehiculo_model->get_vehiculo($vehiculo_id);
        if(!$vehiculo) show_404();

        $data['vehiculo']=$vehiculo;
        $data['_view']='vehiculo/disenador';
        $this->load->view('layouts/main',$data);
    }

    public function datos_mapa($vehiculo_id=0)
    {
        if(!$this->_disenador_instalado()){
            return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Falta ejecutar el SQL del diseñador.'));
        }

        $vehiculo_id=(int)$vehiculo_id;
        $v=$this->db->query(
            "SELECT vehiculo_id,vehiculo_mapa_filas,vehiculo_mapa_columnas,vehiculo_pisos
             FROM vehiculo WHERE vehiculo_id=? LIMIT 1",array($vehiculo_id)
        )->row_array();

        if(!$v) return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Vehículo inexistente.'));

        $e=$this->db->query(
            "SELECT asiento_id,vehiculo_id,nivel_id,asiento_numero,asiento_descripcion,
                    asiento_orden,asiento_x,asiento_y,asiento_precio,asiento_mostrar,
                    asiento_tipo_tarifa,asiento_tipo_elemento,asiento_es_vendible
             FROM asientos
             WHERE vehiculo_id=?
             ORDER BY nivel_id,asiento_y,asiento_x,asiento_orden",
             array($vehiculo_id)
        )->result_array();

        return $this->_json_disenador(array(
            'ok'=>true,
            'config'=>array(
                'filas'=>(int)$v['vehiculo_mapa_filas'],
                'columnas'=>(int)$v['vehiculo_mapa_columnas'],
                'pisos'=>(int)$v['vehiculo_pisos']
            ),
            'elementos'=>$e
        ));
    }

    public function guardar_configuracion_mapa()
    {
        if(!$this->_disenador_instalado()) return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Falta ejecutar el SQL.'));

        $id=(int)$this->input->post('vehiculo_id');
        $filas=(int)$this->input->post('filas');
        $columnas=(int)$this->input->post('columnas');
        $pisos=(int)$this->input->post('pisos');

        if($id<=0 || $filas<6 || $filas>30 || $columnas<3 || $columnas>8 || $pisos<1 || $pisos>2){
            return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Dimensiones inválidas.'));
        }

        $this->db->where('vehiculo_id',$id)->update('vehiculo',array(
            'vehiculo_mapa_filas'=>$filas,
            'vehiculo_mapa_columnas'=>$columnas,
            'vehiculo_pisos'=>$pisos
        ));

        return $this->_json_disenador(array('ok'=>true));
    }

    public function guardar_elemento_mapa()
    {
        if(!$this->_disenador_instalado()) return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Falta ejecutar el SQL.'));

        $id=(int)$this->input->post('asiento_id');
        $veh=(int)$this->input->post('vehiculo_id');
        $nivel=(int)$this->input->post('nivel_id');
        $x=(int)$this->input->post('x');
        $y=(int)$this->input->post('y');
        $tipo=strtoupper(trim((string)$this->input->post('tipo')));
        $numero=strtoupper(trim((string)$this->input->post('numero')));

        $tipos=array('ASIENTO_NORMAL','CAMA','LEITO','PASILLO','BANO','ESCALERA','CONDUCTOR','RELEVO','PUERTA','TV','ESPACIO_VACIO');
        if($veh<=0 || $nivel<1 || $nivel>2 || $x<0 || $y<0 || !in_array($tipo,$tipos,true)){
            return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Elemento inválido.'));
        }

        $vendible=in_array($tipo,array('ASIENTO_NORMAL','CAMA','LEITO'),true)?1:0;
        if($vendible && $numero===''){
            return $this->_json_disenador(array('ok'=>false,'mensaje'=>'El asiento necesita un número.'));
        }

        $celda=$this->db->query(
            "SELECT asiento_id FROM asientos
             WHERE vehiculo_id=? AND nivel_id=? AND asiento_x=? AND asiento_y=? LIMIT 1",
             array($veh,$nivel,$x,$y)
        )->row_array();

        if($id<=0 && $celda) $id=(int)$celda['asiento_id'];

        if($vendible){
            $dup=$this->db->query(
                "SELECT asiento_id FROM asientos
                 WHERE vehiculo_id=? AND asiento_numero=? AND asiento_es_vendible=1 AND asiento_id<>?
                 LIMIT 1",
                 array($veh,$numero,$id)
            )->row_array();

            if($dup){
                return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Ya existe el asiento '.$numero.' en este vehículo.'));
            }
        }

        if($id>0){
            $actual=$this->db->query(
                "SELECT * FROM asientos WHERE asiento_id=? AND vehiculo_id=? LIMIT 1",
                array($id,$veh)
            )->row_array();

            if(!$actual) return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Elemento inexistente.'));

            if((int)($actual['asiento_es_vendible']??1)===1 && !$vendible){
                $uso=$this->db->query(
                    "SELECT pasaje_id FROM pasaje WHERE asiento_id=? AND estado_id IN(51,52,54) LIMIT 1",
                    array($id)
                )->row_array();

                if($uso){
                    return $this->_json_disenador(array('ok'=>false,'mensaje'=>'El asiento tiene ventas/reservas activas.'));
                }
            }
        }

        $orden=(($nivel-1)*10000)+($y*100)+$x;

        $data=array(
            'vehiculo_id'=>$veh,
            'nivel_id'=>$nivel,
            'asiento_x'=>$x,
            'asiento_y'=>$y,
            'asiento_orden'=>$orden,
            'asiento_tipo_elemento'=>$tipo,
            'asiento_es_vendible'=>$vendible,
            'asiento_mostrar'=>($tipo==='ESPACIO_VACIO'?0:1)
        );

        if($vendible){
            $data['asiento_numero']=$numero;
            $data['asiento_descripcion']=$tipo==='ASIENTO_NORMAL'?'ASIENTO':$tipo;
            $data['asiento_tipo_tarifa']=$tipo==='ASIENTO_NORMAL'?'NORMAL':$tipo;
        }else{
            $data['asiento_numero']='';
            $data['asiento_descripcion']=str_replace('_',' ',$tipo);
            $data['asiento_precio']=0;
        }

        if($id>0){
            $this->db->where('asiento_id',$id)->update('asientos',$data);
        }else{
            $this->db->insert('asientos',$data);
            $id=(int)$this->db->insert_id();
        }

        return $this->_json_disenador(array('ok'=>true,'asiento_id'=>$id));
    }

    public function eliminar_elemento_mapa()
    {
        if(!$this->_disenador_instalado()) return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Falta ejecutar el SQL.'));

        $id=(int)$this->input->post('asiento_id');
        $a=$this->db->query(
            "SELECT asiento_id,asiento_es_vendible FROM asientos WHERE asiento_id=? LIMIT 1",
            array($id)
        )->row_array();

        if(!$a) return $this->_json_disenador(array('ok'=>false,'mensaje'=>'Elemento inexistente.'));

        if((int)$a['asiento_es_vendible']===1){
            $uso=$this->db->query(
                "SELECT pasaje_id FROM pasaje WHERE asiento_id=? AND estado_id IN(51,52,54) LIMIT 1",
                array($id)
            )->row_array();

            if($uso){
                return $this->_json_disenador(array('ok'=>false,'mensaje'=>'El asiento tiene ventas/reservas activas.'));
            }
        }

        $hist=$this->db->query(
            "SELECT pasaje_id FROM pasaje WHERE asiento_id=? LIMIT 1",array($id)
        )->row_array();

        if($hist){
            $this->db->where('asiento_id',$id)->update('asientos',array('asiento_mostrar'=>0));
        }else{
            $this->db->where('asiento_id',$id)->delete('asientos');
        }

        return $this->_json_disenador(array('ok'=>true));
    }

    public function tramos_viaje(){$this->output->set_content_type('application/json');$viaje_id=(int)$this->input->post('viaje_id');if(!$this->db->table_exists('ruta_parada')){echo json_encode(array('ok'=>false,'mensaje'=>'Falta ejecutar el SQL del punto 18.'));return;}$v=$this->db->query("SELECT ruta_id FROM viaje WHERE viaje_id=? LIMIT 1",array($viaje_id))->row_array();if(!$v){echo json_encode(array('ok'=>false,'mensaje'=>'Viaje inválido.'));return;}$r=$this->db->query("SELECT rutaparada_id,ruta_id,parada_id,rutaparada_nombre,rutaparada_orden,rutaparada_tipo FROM ruta_parada WHERE ruta_id=? AND estado_id=1 ORDER BY rutaparada_orden",array($v['ruta_id']))->result_array();echo json_encode(array('ok'=>count($r)>=2,'paradas'=>$r,'mensaje'=>count($r)>=2?'':'Configure las paradas de la ruta.'));}
public function get_asientos(){
        $this->output->set_content_type('application/json');
        $viaje_id=(int)$this->input->post('viaje_id');
        $nivel=max(1,(int)$this->input->post('nivel'));
        $tr=$this->_resolver_tramo($viaje_id,(int)$this->input->post('rutaparada_origen_id'),(int)$this->input->post('rutaparada_destino_id'));
        if(!$tr){echo json_encode(array());return;}

        $this->load->model('Venta_model');
        $this->Venta_model->liberar_reservas_vencidas($viaje_id);

        $base=$this->db->query("SELECT h.*,a.*,r.ruta_reserva_alerta_minutos
            FROM viaje v JOIN ruta r ON r.ruta_id=v.ruta_id
            JOIN vehiculo h ON h.vehiculo_id=v.vehiculo_id
            JOIN asientos a ON a.vehiculo_id=h.vehiculo_id
            WHERE v.viaje_id=? AND a.nivel_id=?
            ORDER BY a.asiento_y,a.asiento_x,a.asiento_orden",array($viaje_id,$nivel))->result_array();

        $o=(int)$tr['origen']['rutaparada_orden'];$d=(int)$tr['destino']['rutaparada_orden'];
        foreach($base as &$x){
            $tipo=strtoupper((string)($x['asiento_tipo_elemento']??'ASIENTO_NORMAL'));
            $vendible=(int)($x['asiento_es_vendible']??1)===1 && in_array($tipo,array('ASIENTO_NORMAL','CAMA','LEITO'),true);
            if(!$vendible){
                $x['estado_pasaje']=null;$x['pasaje_id']=0;$x['venta_id']=0;$x['pasaje_nombre']='';
                continue;
            }
            $ocup=$this->db->query("SELECT p.* FROM pasaje p WHERE p.viaje_id=? AND p.asiento_id=? AND p.estado_id IN(51,52,54)
                AND COALESCE(p.pasaje_tramo_origen_orden,0)<? AND COALESCE(p.pasaje_tramo_destino_orden,10000)>?
                ORDER BY FIELD(p.estado_id,54,52,51),p.pasaje_id LIMIT 1",
                array($viaje_id,$x['asiento_id'],$d,$o))->row_array();
            if($ocup){foreach($ocup as $k=>$val)$x[$k]=$val;$x['estado_pasaje']=(int)$ocup['estado_id'];}
            else{$x['estado_pasaje']=50;$x['pasaje_id']=0;$x['venta_id']=0;$x['pasaje_nombre']='';$x['pasaje_documento']='';$x['pasaje_numero']=$x['asiento_numero'];}
        }
        unset($x);
        echo json_encode($base);
    }
    public function get_config_reserva(){
        $viaje_id=(int)$this->input->post('viaje_id');
        $this->load->model('Venta_model');
        echo json_encode($this->Venta_model->configuracion_reserva_viaje($viaje_id));
    }

    public function get_asiento(){$viaje_id=(int)$this->input->post('viaje_id');$asiento_id=(int)$this->input->post('asiento_id');$tr=$this->_resolver_tramo($viaje_id,(int)$this->input->post('rutaparada_origen_id'),(int)$this->input->post('rutaparada_destino_id'));if(!$tr){echo json_encode(array());return;}$x=$this->db->query("SELECT v.*,r.*,h.*,a.* FROM viaje v JOIN ruta r ON r.ruta_id=v.ruta_id JOIN vehiculo h ON h.vehiculo_id=v.vehiculo_id JOIN asientos a ON a.vehiculo_id=h.vehiculo_id WHERE v.viaje_id=? AND a.asiento_id=? LIMIT 1",array($viaje_id,$asiento_id))->row_array();if(!$x){echo json_encode(array());return;}$x['pasaje_origen']=$tr['origen']['rutaparada_nombre'];$x['pasaje_destino']=$tr['destino']['rutaparada_nombre'];echo json_encode(array($x));}
    public function esta_disponible()
    {
        $viaje_id = (int)$this->input->post("viaje_id");
        $asiento_id = (int)$this->input->post("asiento_id");

        $sql = "SELECT *
                FROM pasaje p
                WHERE p.viaje_id = ? AND p.asiento_id = ? AND p.estado_id = 50";

        $resultado = $this->db->query($sql, array($viaje_id, $asiento_id))->result_array();
        echo json_encode($resultado);
    }

    public function seleccionar_asiento(){$this->output->set_content_type('application/json');$viaje_id=(int)$this->input->post('viaje_id');$asiento_id=(int)$this->input->post('asiento_id');$usuario_id=(int)$this->session_data['usuario_id'];$tr=$this->_resolver_tramo($viaje_id,(int)$this->input->post('rutaparada_origen_id'),(int)$this->input->post('rutaparada_destino_id'));if($viaje_id<=0||$asiento_id<=0||!$tr){echo json_encode(array('ok'=>false,'mensaje'=>'Viaje, asiento o tramo inválido.'));return;}$this->db->trans_begin();try{$v=$this->db->query("SELECT estado_id FROM viaje WHERE viaje_id=? FOR UPDATE",array($viaje_id))->row_array();if(!$v||!in_array((int)$v['estado_id'],array(61,56),true))throw new Exception('El viaje no admite ventas.');$asiento_valido=$this->db->query("SELECT a.asiento_id FROM viaje v INNER JOIN asientos a ON a.vehiculo_id=v.vehiculo_id WHERE v.viaje_id=? AND a.asiento_id=? AND IFNULL(a.asiento_es_vendible,1)=1 AND IFNULL(a.asiento_mostrar,1)=1 AND UPPER(IFNULL(a.asiento_tipo_elemento,'ASIENTO_NORMAL')) IN('ASIENTO_NORMAL','CAMA','LEITO') LIMIT 1",array($viaje_id,$asiento_id))->row_array();if(!$asiento_valido)throw new Exception('El asiento no pertenece al vehículo del viaje o no está habilitado para venta.');if($this->db->table_exists('viaje_asiento_lock')){$this->db->query("INSERT IGNORE INTO viaje_asiento_lock(viaje_id,asiento_id,lock_actualizado) VALUES(?,?,NOW())",array($viaje_id,$asiento_id));$this->db->query("SELECT viaje_id FROM viaje_asiento_lock WHERE viaje_id=? AND asiento_id=? FOR UPDATE",array($viaje_id,$asiento_id))->row_array();}$o=(int)$tr['origen']['rutaparada_orden'];$d=(int)$tr['destino']['rutaparada_orden'];$ocup=$this->db->query("SELECT * FROM pasaje WHERE viaje_id=? AND asiento_id=? AND estado_id IN(51,52,54) AND COALESCE(pasaje_tramo_origen_orden,0)<? AND COALESCE(pasaje_tramo_destino_orden,10000)>? FOR UPDATE",array($viaje_id,$asiento_id,$d,$o))->result_array();foreach($ocup as $px){$mismo=((int)$px['estado_id']===51&&(int)$px['usuario_id']===$usuario_id&&(int)$px['rutaparada_origen_id']===(int)$tr['origen']['rutaparada_id']&&(int)$px['rutaparada_destino_id']===(int)$tr['destino']['rutaparada_id']);if($mismo){$this->db->where('pasaje_id',$px['pasaje_id'])->update('pasaje',array('pasaje_bloqueado_hasta'=>date('Y-m-d H:i:s',time()+600)));$this->db->trans_commit();echo json_encode(array('ok'=>true,'pasaje_id'=>$px['pasaje_id']));return;}throw new Exception('El asiento está ocupado en todo o parte del tramo seleccionado.');}$libre=$this->db->query("SELECT * FROM pasaje WHERE viaje_id=? AND asiento_id=? AND estado_id=50 ORDER BY pasaje_id LIMIT 1 FOR UPDATE",array($viaje_id,$asiento_id))->row_array();if(!$libre){$a=$this->db->query("SELECT asiento_numero,asiento_precio FROM asientos WHERE asiento_id=? LIMIT 1",array($asiento_id))->row_array();if(!$a)throw new Exception('Asiento inexistente.');$this->db->insert('pasaje',array('asiento_id'=>$asiento_id,'viaje_id'=>$viaje_id,'pasaje_numero'=>$a['asiento_numero'],'pasaje_precio'=>(float)$a['asiento_precio'],'estado_id'=>50,'pasaje_fecha'=>date('Y-m-d'),'pasaje_hora'=>date('H:i:s'),'usuario_id'=>0));$pid=(int)$this->db->insert_id();}else{$pid=(int)$libre['pasaje_id'];}$data=array('estado_id'=>51,'pasaje_nombre'=>'SIN NOMBRE','pasaje_documento'=>'0','cdi_codigoclasificador'=>1,'usuario_id'=>$usuario_id,'pasaje_fecha'=>date('Y-m-d'),'pasaje_hora'=>date('H:i:s'),'pasaje_bloqueado_hasta'=>date('Y-m-d H:i:s',time()+300),'rutaparada_origen_id'=>$tr['origen']['rutaparada_id'],'rutaparada_destino_id'=>$tr['destino']['rutaparada_id'],'pasaje_tramo_origen_orden'=>$o,'pasaje_tramo_destino_orden'=>$d,'pasaje_origen'=>$tr['origen']['rutaparada_nombre'],'pasaje_destino'=>$tr['destino']['rutaparada_nombre']);$this->db->where('pasaje_id',$pid)->update('pasaje',$data);if($this->db->trans_status()===false)throw new Exception('No fue posible bloquear el asiento.');$this->db->trans_commit();echo json_encode(array('ok'=>true,'mensaje'=>'Asiento bloqueado para '.$data['pasaje_origen'].' → '.$data['pasaje_destino'],'pasaje_id'=>$pid));}catch(Exception $e){$this->db->trans_rollback();echo json_encode(array('ok'=>false,'mensaje'=>$e->getMessage()));}}
    public function quitar_pasaje()
    {
        $viaje_id = (int)$this->input->post("viaje_id");
        $pasaje_id = (int)$this->input->post("pasaje_id");
        $usuario_id = (int)$this->session_data['usuario_id'];

        $data = array(
            'estado_id' => 50,
            'pasaje_nombre' => '',
            'pasaje_documento' => '',
            'cdi_codigoclasificador' => 1,
            'usuario_id' => $usuario_id,
            'pasaje_fecha' => date('Y-m-d'),
            'pasaje_hora' => date('H:i:s'),
            'pasaje_tieneequipaje' => 0,
            'pasaje_detalleequipaje' => '',
            'pasaje_fechahoraequipaje' => date('Y-m-d H:i:s'),
            'pasaje_bloqueado_hasta' => null
        );

        $this->db->where('viaje_id', $viaje_id);
        $this->db->where('pasaje_id', $pasaje_id);
        $this->db->where('estado_id', 51);
        $this->db->where('usuario_id', $usuario_id);
        $ok = $this->db->update('pasaje', $data);

        echo json_encode(array('ok' => (bool)$ok));
    }

    public function cargar_tabla()
    {
        $viaje_id = (int)$this->input->post("viaje_id");
        $usuario_id = (int)$this->session_data['usuario_id'];

        $this->db->query(
            "UPDATE pasaje
             SET estado_id = CASE WHEN IFNULL(venta_id,0) > 0 THEN 52 ELSE 50 END,
                 usuario_id = CASE WHEN IFNULL(venta_id,0) > 0 THEN usuario_id ELSE 0 END,
                 pasaje_bloqueado_hasta = NULL
             WHERE viaje_id = ? AND estado_id = 51
               AND pasaje_bloqueado_hasta IS NOT NULL AND pasaje_bloqueado_hasta < NOW()",
            array($viaje_id)
        );

        $sql = "SELECT *
                FROM pasaje p
                LEFT JOIN asientos a ON a.asiento_id = p.asiento_id
                LEFT JOIN cod_doc_identidad c ON c.cdi_codigoclasificador = p.cdi_codigoclasificador
                LEFT JOIN estado e ON e.estado_id = p.estado_id
                LEFT JOIN viaje v ON v.viaje_id = p.viaje_id
                WHERE p.viaje_id = ? AND p.estado_id = 51 AND p.usuario_id = ?
                ORDER BY p.pasaje_numero";

        $resultado = $this->db->query($sql, array($viaje_id, $usuario_id))->result_array();
        echo json_encode($resultado);
    }

    public function registrar_datos_pasaje()
    {
        $this->output->set_content_type('application/json');
        $viaje_id=(int)$this->input->post("viaje_id");
        $pasaje_id=(int)$this->input->post("pasaje_id");
        $documento=trim((string)$this->input->post("documento"));
        $nombre=trim((string)$this->input->post("nombre"));
        $select_documento=(int)$this->input->post("select_documento");
        $telefono=trim((string)$this->input->post("telefono"));
        $pasaje_edad=trim((string)$this->input->post("pasaje_edad"));
        $pasaje_sexo=strtoupper(trim((string)$this->input->post("pasaje_sexo")));
        $pasaje_origen=strtoupper(trim((string)$this->input->post("pasaje_origen")));
        $pasaje_destino=strtoupper(trim((string)$this->input->post("pasaje_destino")));
        $pasaje_tieneequipaje=(int)$this->input->post("pasaje_tieneequipaje")===1?1:0;
        $pasaje_detalleequipaje=strtoupper(trim((string)$this->input->post("pasaje_detalleequipaje")));
        $tipo_tarifa_id=(int)$this->input->post("tarifatipopasajero_id");
        $cortesiamotivo_id=(int)$this->input->post("cortesiamotivo_id");
        $usuario_id=(int)$this->session_data['usuario_id'];

        if($nombre==='' || strtoupper($nombre)==='SIN NOMBRE'){ echo json_encode(array('ok'=>false,'mensaje'=>'Debe registrar el nombre del pasajero.')); return; }
        if($documento==='' || $documento==='0'){ echo json_encode(array('ok'=>false,'mensaje'=>'Debe registrar el documento del pasajero.')); return; }
        if($pasaje_tieneequipaje===1 && $pasaje_detalleequipaje===''){ echo json_encode(array('ok'=>false,'mensaje'=>'Debe detallar el equipaje.')); return; }

        $viaje_estado=$this->db->query('SELECT estado_id FROM viaje WHERE viaje_id=? LIMIT 1',array($viaje_id))->row_array();

        // Registro rápido: origen/destino no se solicitan al cajero.
        // Si las columnas del punto 17 existen, se toman automáticamente de la ruta del viaje.
        if($pasaje_origen==='' || $pasaje_destino===''){
            $ruta_pasaje=$this->db->query(
                "SELECT COALESCE(NULLIF(o.origen_nombre,''),NULLIF(r.inicio_ruta,''),'') AS origen,
                        COALESCE(NULLIF(d.destino_nombre,''),NULLIF(r.fin_ruta,''),'') AS destino
                 FROM viaje v
                 LEFT JOIN ruta r ON r.ruta_id=v.ruta_id
                 LEFT JOIN origen o ON o.origen_id=r.origen_id
                 LEFT JOIN destino d ON d.destino_id=r.destino_id
                 WHERE v.viaje_id=? LIMIT 1", array($viaje_id)
            )->row_array();
            if($ruta_pasaje){
                if($pasaje_origen==='') $pasaje_origen=trim((string)$ruta_pasaje['origen']);
                if($pasaje_destino==='') $pasaje_destino=trim((string)$ruta_pasaje['destino']);
            }
        }
        if(!$viaje_estado || !in_array((int)$viaje_estado['estado_id'],array(61,56),true)){
            echo json_encode(array('ok'=>false,'mensaje'=>'El viaje ya no admite edición de pasajeros porque cambió de estado.')); return;
        }

        // Precio resuelto nuevamente en servidor. Nunca se acepta el importe del navegador como autoridad.
        $calc=null;
        if($this->db->table_exists('tarifa_tipo_pasajero') && $tipo_tarifa_id>0){
            $calc=$this->Tarifa_model->calcular($viaje_id,$pasaje_id,$tipo_tarifa_id);
        }
        if($calc && !empty($calc['ok'])){
            $viaje_precio=(float)$calc['precio_final'];
            $tarifa_id=!empty($calc['tarifa_id'])?(int)$calc['tarifa_id']:null;
            $tarifa_base=(float)$calc['precio_base']; $tarifa_ajuste=(float)$calc['ajuste'];
        }else{
            // Respaldo legacy para instalaciones que aún no tienen una regla formal.
            $viaje_precio=round((float)$this->input->post("viaje_precio"),2);
            $tarifa_id=null; $tarifa_base=$viaje_precio; $tarifa_ajuste=0;
        }
        $es_cortesia=false; $motivo_cortesia=null;
        if($tipo_tarifa_id>0 && $this->db->table_exists('tarifa_tipo_pasajero')){
            $tp_cortesia=$this->db->query("SELECT tarifatipopasajero_codigo FROM tarifa_tipo_pasajero WHERE tarifatipopasajero_id=? LIMIT 1",array($tipo_tarifa_id))->row_array();
            $es_cortesia=($tp_cortesia && strtoupper((string)$tp_cortesia['tarifatipopasajero_codigo'])==='CORTESIA');
        }
        if($es_cortesia){
            if(!$this->db->table_exists('cortesia_motivo')){
                echo json_encode(array('ok'=>false,'mensaje'=>'Falta ejecutar la actualización SQL de cortesías.')); return;
            }
            $motivo_cortesia=$this->db->query("SELECT cortesiamotivo_id,cortesiamotivo_nombre FROM cortesia_motivo WHERE cortesiamotivo_id=? AND estado_id=1 LIMIT 1",array($cortesiamotivo_id))->row_array();
            if(!$motivo_cortesia){ echo json_encode(array('ok'=>false,'mensaje'=>'Debe seleccionar un motivo válido para la cortesía.')); return; }
            if(!$this->db->table_exists('rol_usuario')){
                echo json_encode(array('ok'=>false,'mensaje'=>'No existe la tabla rol_usuario. Ejecute la actualización SQL del punto 15.')); return;
            }
            $tipousuario_id = isset($this->session_data['tipousuario_id']) ? (int)$this->session_data['tipousuario_id'] : 0;
            if($tipousuario_id<=0){
                echo json_encode(array('ok'=>false,'mensaje'=>'No se pudo determinar el tipo de usuario de la sesión para autorizar la cortesía.')); return;
            }
            $ru=$this->db->query("SELECT rolusuario_asignado FROM rol_usuario WHERE tipousuario_id=? AND rol_id=215 LIMIT 1",
                array($tipousuario_id))->row_array();
            if(!$ru || (int)$ru['rolusuario_asignado']!==1){
                echo json_encode(array('ok'=>false,'mensaje'=>'Su usuario no tiene permiso 215 para emitir pasajes de cortesía.')); return;
            }
            $viaje_precio=0.00;
        }
        if($viaje_precio<0){ echo json_encode(array('ok'=>false,'mensaje'=>'La tarifa calculada no es válida.')); return; }

        $data=array('pasaje_nombre'=>$nombre,'pasaje_documento'=>$documento,'cdi_codigoclasificador'=>$select_documento,
          'pasaje_precio'=>$viaje_precio,'usuario_id'=>$usuario_id,'pasaje_fecha'=>date('Y-m-d'),'pasaje_hora'=>date('H:i:s'),
          'pasaje_telefono'=>$telefono,'pasaje_bloqueado_hasta'=>date('Y-m-d H:i:s',time()+600));
        if($this->db->field_exists('pasaje_edad','pasaje')){
            $data['pasaje_edad']=$pasaje_edad===''?null:(int)$pasaje_edad;
            $data['pasaje_sexo']=$pasaje_sexo===''?null:$pasaje_sexo;
            $data['pasaje_origen']=$pasaje_origen;
            $data['pasaje_destino']=$pasaje_destino;
        }
        $data['pasaje_tieneequipaje']=$pasaje_tieneequipaje;
        $data['pasaje_detalleequipaje']=$pasaje_tieneequipaje?$pasaje_detalleequipaje:'';
        $data['pasaje_fechahoraequipaje']=$pasaje_tieneequipaje?date('Y-m-d H:i:s'):null;
        if($this->db->field_exists('pasaje_es_cortesia','pasaje')){
            $data['pasaje_es_cortesia']=$es_cortesia?1:0;
            $data['cortesiamotivo_id']=$es_cortesia?(int)$motivo_cortesia['cortesiamotivo_id']:null;
            $data['pasaje_cortesia_motivo']=$es_cortesia?$motivo_cortesia['cortesiamotivo_nombre']:null;
            $data['usuario_cortesia_id']=$es_cortesia?$usuario_id:null;
            $data['pasaje_cortesia_fechahora']=$es_cortesia?date('Y-m-d H:i:s'):null;
        }
        if($this->db->field_exists('tarifa_id','pasaje')){
            $data['tarifa_id']=$tarifa_id; $data['tarifatipopasajero_id']=$tipo_tarifa_id?:null;
            $data['pasaje_tarifa_base']=$tarifa_base; $data['pasaje_tarifa_ajuste']=$tarifa_ajuste;
        }

        $this->db->where('viaje_id',$viaje_id)->where('pasaje_id',$pasaje_id)->where('estado_id',51)->where('usuario_id',$usuario_id);
        $this->db->group_start()->where('pasaje_bloqueado_hasta IS NULL',null,false)->or_where('pasaje_bloqueado_hasta >=',date('Y-m-d H:i:s'))->group_end();
        $ok=$this->db->update('pasaje',$data);
        if($ok && $this->db->affected_rows()>0 && $es_cortesia && $this->db->table_exists('pasaje_cortesia_bitacora')){
            $this->db->insert('pasaje_cortesia_bitacora',array(
              'pasaje_id'=>$pasaje_id,'viaje_id'=>$viaje_id,'cortesiamotivo_id'=>(int)$motivo_cortesia['cortesiamotivo_id'],
              'cortesia_motivo'=>$motivo_cortesia['cortesiamotivo_nombre'],'tarifa_original'=>$tarifa_base,
              'importe_cobrado'=>0,'usuario_id'=>$usuario_id,'cortesia_fechahora'=>date('Y-m-d H:i:s'),'estado_id'=>1
            ));
        }
        if($ok && $this->db->affected_rows()>0 && $calc && !empty($calc['ok']) && $this->db->table_exists('tarifa_aplicacion')){
            $this->db->insert('tarifa_aplicacion',array('pasaje_id'=>$pasaje_id,'viaje_id'=>$viaje_id,'tarifa_id'=>$tarifa_id,
              'tarifatipopasajero_id'=>$tipo_tarifa_id,'tarifa_precio_base'=>$tarifa_base,'tarifa_ajuste'=>$tarifa_ajuste,
              'tarifa_precio_final'=>$viaje_precio,'tarifa_regla'=>$calc['regla'],'usuario_id'=>$usuario_id));
        }
        echo json_encode(array('ok'=>(bool)$ok&&$this->db->affected_rows()>0,
          'mensaje'=>$this->db->affected_rows()>0?'Datos y tarifa guardados.':'El bloqueo del asiento venció o pertenece a otro cajero.',
          'precio'=>$viaje_precio,'regla'=>$calc&&!empty($calc['regla'])?$calc['regla']:'LEGACY'));
    }

    public function get_pasajes_vendidos(){$viaje_id=(int)$this->input->post('viaje_id');$tr=$this->_resolver_tramo($viaje_id,(int)$this->input->post('rutaparada_origen_id'),(int)$this->input->post('rutaparada_destino_id'));if(!$tr){echo json_encode(array());return;}$o=(int)$tr['origen']['rutaparada_orden'];$d=(int)$tr['destino']['rutaparada_orden'];$total=(int)$this->db->query("SELECT COUNT(*) c FROM asientos a JOIN viaje v ON v.vehiculo_id=a.vehiculo_id WHERE v.viaje_id=?",array($viaje_id))->row_array()['c'];$arr=array();foreach(array(54=>'VENDIDOS TRAMO',52=>'RESERVADOS TRAMO',51=>'EN PROCESO TRAMO') as $est=>$nom){$arr[$est]=(int)$this->db->query("SELECT COUNT(DISTINCT asiento_id) c FROM pasaje WHERE viaje_id=? AND estado_id=? AND COALESCE(pasaje_tramo_origen_orden,0)<? AND COALESCE(pasaje_tramo_destino_orden,10000)>?",array($viaje_id,$est,$d,$o))->row_array()['c'];}$ocup=min($total,$arr[54]+$arr[52]+$arr[51]);echo json_encode(array(array('detalle'=>'CAPACIDAD TRAMO','cantidad'=>$total,'estado_color'=>''),array('detalle'=>'VENDIDOS TRAMO','cantidad'=>$arr[54],'estado_color'=>''),array('detalle'=>'RESERVADOS TRAMO','cantidad'=>$arr[52],'estado_color'=>''),array('detalle'=>'EN PROCESO TRAMO','cantidad'=>$arr[51],'estado_color'=>''),array('detalle'=>'DISPONIBLES TRAMO','cantidad'=>max(0,$total-$ocup),'estado_color'=>'')));}
    private function _subir_imagen_vehiculo()
    {
        if (!isset($_FILES['vehiculo_imagen_file']) || empty($_FILES['vehiculo_imagen_file']['name'])) {
            return array(
                'success' => true,
                'file_name' => null,
                'error' => ''
            );
        }

        $config['upload_path']   = FCPATH . 'resources/images/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size']      = 4096;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;

        if (!is_dir($config['upload_path'])) {
            @mkdir($config['upload_path'], 0777, true);
        }

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('vehiculo_imagen_file')) {
            return array(
                'success' => false,
                'file_name' => null,
                'error' => $this->upload->display_errors('', '')
            );
        }

        $data_upload = $this->upload->data();

        return array(
            'success' => true,
            'file_name' => $data_upload['file_name'],
            'error' => ''
        );
    }

    private function _eliminar_imagen_vehiculo($file_name)
    {
        if (!empty($file_name)) {
            $ruta = FCPATH . 'resources/images/' . $file_name;
            if (file_exists($ruta) && is_file($ruta)) {
                @unlink($ruta);
            }
        }
    }

}