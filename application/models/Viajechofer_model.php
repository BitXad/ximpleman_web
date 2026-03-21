<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaje_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Obtener viajes asignados al conductor logueado
     */
    function get_viajes_por_conductor($usuario_id)
    {
        $viajes = $this->db->query("
            SELECT
                v.*,
                r.ruta_nombre,
                r.ruta_descripcion,
                r.inicio_ruta,
                r.fin_ruta,
                ve.vehiculo_placa,
                ve.vehiculo_marca,
                ve.vehiculo_modelo,
                e.estado_descripcion,
                e.estado_color,
                u1.usuario_nombre as conductor_nombre,
                u2.usuario_nombre as conductor2_nombre

            FROM viaje v
            LEFT JOIN ruta r ON r.ruta_id = v.ruta_id
            LEFT JOIN vehiculo ve ON ve.vehiculo_id = v.vehiculo_id
            LEFT JOIN estado e ON e.estado_id = v.estado_id
            LEFT JOIN usuario u1 ON u1.usuario_id = v.conductor_id
            LEFT JOIN usuario u2 ON u2.usuario_id = v.conductor_id2

            WHERE
                e.estado_tipo = 13
                AND v.estado_id BETWEEN 55 AND 60
                AND (v.conductor_id = ".$this->db->escape($usuario_id)." OR v.conductor_id2 = ".$this->db->escape($usuario_id).")

            ORDER BY
                v.viaje_fechasalida DESC,
                v.viaje_horasalida DESC,
                v.viaje_id DESC
        ")->result_array();

        return $viajes;
    }

    /*
     * Obtener un solo viaje que pertenezca al conductor logueado
     */
    function get_viaje_conductor($viaje_id, $usuario_id)
    {
        $viaje = $this->db->query("
            SELECT
                v.*,
                e.estado_descripcion

            FROM viaje v
            LEFT JOIN estado e ON e.estado_id = v.estado_id

            WHERE
                v.viaje_id = ".$this->db->escape($viaje_id)."
                AND (v.conductor_id = ".$this->db->escape($usuario_id)." OR v.conductor_id2 = ".$this->db->escape($usuario_id).")
                AND v.estado_id BETWEEN 55 AND 60

            LIMIT 1
        ")->row_array();

        return $viaje;
    }

    /*
     * Devuelve el siguiente estado permitido
     */
    function get_siguiente_estado($estado_actual)
    {
        $flujo = array(
            55 => 56, // PROGRAMADO -> ABORDANDO
            56 => 57, // ABORDANDO -> PARTIDO
            57 => 58, // PARTIDO -> EN VIAJE
            58 => 59, // EN VIAJE -> LLEGADO
            59 => 60  // LLEGADO -> FINALIZADO
        );

        return isset($flujo[$estado_actual]) ? $flujo[$estado_actual] : false;
    }

    /*
     * Texto del siguiente estado
     */
    function get_texto_siguiente_estado($estado_actual)
    {
        $texto = array(
            55 => 'Pasar a ABORDANDO',
            56 => 'Pasar a PARTIDO',
            57 => 'Pasar a EN VIAJE',
            58 => 'Pasar a LLEGADO',
            59 => 'Pasar a FINALIZADO'
        );

        return isset($texto[$estado_actual]) ? $texto[$estado_actual] : '';
    }

    /*
     * Actualizar viaje
     */
    function update_viaje($viaje_id, $params)
    {
        $this->db->where('viaje_id', $viaje_id);
        return $this->db->update('viaje', $params);
    }

    /*
     * Obtener un viaje
     */
    function get_viaje($viaje_id)
    {
        return $this->db->get_where('viaje', array('viaje_id' => $viaje_id))->row_array();
    }
}