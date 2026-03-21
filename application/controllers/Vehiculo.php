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

    public function index()
    {
        $data['sistema'] = $this->sistema;
        $data['noof_page'] = 0;
        $data['vehiculo'] = $this->Vehiculo_model->get_all_vehiculo();
        $data['_view'] = 'vehiculo/index';
        $this->load->view('layouts/main', $data);
    }

    public function add()
    {
        $data['sistema'] = $this->sistema;

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
        $data['sistema'] = $this->sistema;
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
        $data['sistema'] = $this->sistema;
        $data['vehiculo'] = $this->Vehiculo_model->get_vehiculo($vehiculo_id);

        if (!isset($data['vehiculo']['vehiculo_id'])) {
            show_error('El vehículo que intenta ver no existe.');
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

    public function get_asientos()
    {
        $viaje_id = (int)$this->input->post("viaje_id");
        $nivel = (int)$this->input->post("nivel");

        $sql = "SELECT 
                    h.*, a.*, p.*, p.estado_id AS estado_pasaje
                FROM viaje v
                INNER JOIN vehiculo h ON v.vehiculo_id = h.vehiculo_id
                INNER JOIN asientos a ON h.vehiculo_id = a.vehiculo_id
                LEFT JOIN pasaje p ON a.asiento_id = p.asiento_id AND p.viaje_id = v.viaje_id
                WHERE v.viaje_id = ? AND a.nivel_id = ?
                ORDER BY a.asiento_orden";

        $resultado = $this->db->query($sql, array($viaje_id, $nivel))->result_array();
        echo json_encode($resultado);
    }

    public function get_asiento()
    {
        $viaje_id = (int)$this->input->post("viaje_id");
        $asiento_id = (int)$this->input->post("asiento_id");

        $sql = "SELECT *
                FROM viaje v
                INNER JOIN ruta r ON v.ruta_id = r.ruta_id
                INNER JOIN vehiculo h ON v.vehiculo_id = h.vehiculo_id
                INNER JOIN asientos a ON v.vehiculo_id = a.vehiculo_id
                INNER JOIN pasaje p ON a.asiento_id = p.asiento_id AND p.viaje_id = v.viaje_id
                WHERE v.viaje_id = ? AND a.asiento_id = ?";

        $resultado = $this->db->query($sql, array($viaje_id, $asiento_id))->result_array();
        echo json_encode($resultado);
    }

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

    public function seleccionar_asiento()
    {
        $viaje_id = (int)$this->input->post("viaje_id");
        $asiento_id = (int)$this->input->post("asiento_id");
        $usuario_id = (int)$this->session_data['usuario_id'];

        $data = array(
            'estado_id' => 51,
            'pasaje_nombre' => 'SIN NOMBRE',
            'pasaje_documento' => '0',
            'cdi_codigoclasificador' => 1,
            'usuario_id' => $usuario_id,
            'pasaje_fecha' => date('Y-m-d'),
            'pasaje_hora' => date('H:i:s'),
        );

        $this->db->where('viaje_id', $viaje_id);
        $this->db->where('asiento_id', $asiento_id);
        $ok = $this->db->update('pasaje', $data);

        echo json_encode($ok ? true : false);
    }

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
            'pasaje_fechahoraequipaje' => date('Y-m-d H:i:s')
        );

        $this->db->where('viaje_id', $viaje_id);
        $this->db->where('pasaje_id', $pasaje_id);
        $ok = $this->db->update('pasaje', $data);

        echo json_encode($ok ? true : false);
    }

    public function cargar_tabla()
    {
        $viaje_id = (int)$this->input->post("viaje_id");
        $usuario_id = (int)$this->session_data['usuario_id'];

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
        $viaje_id = (int)$this->input->post("viaje_id");
        $pasaje_id = (int)$this->input->post("pasaje_id");
        $viaje_precio = (float)$this->input->post("viaje_precio");
        $documento = trim($this->input->post("documento"));
        $nombre = trim($this->input->post("nombre"));
        $select_documento = (int)$this->input->post("select_documento");
        $telefono = trim($this->input->post("telefono"));
        $usuario_id = (int)$this->session_data['usuario_id'];

        $data = array(
            'pasaje_nombre' => $nombre,
            'pasaje_documento' => $documento,
            'cdi_codigoclasificador' => $select_documento,
            'pasaje_precio' => $viaje_precio,
            'usuario_id' => $usuario_id,
            'pasaje_fecha' => date('Y-m-d'),
            'pasaje_hora' => date('H:i:s'),
            'pasaje_telefono' => $telefono
        );

        $this->db->where('viaje_id', $viaje_id);
        $this->db->where('pasaje_id', $pasaje_id);
        $ok = $this->db->update('pasaje', $data);

        echo json_encode($ok ? true : false);
    }

    public function get_pasajes_vendidos()
    {
        $viaje_id = (int)$this->input->post("viaje_id");
        $resultado = $this->Vehiculo_model->get_pasajes_vendidos($viaje_id);
        echo json_encode($resultado);
    }
    
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