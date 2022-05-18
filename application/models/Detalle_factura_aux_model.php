<?php

class Detalle_factura_aux_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /* elimina los detalles que hubiesen en detalle_factura_aux */
    function delete_detalleventa_factura_aux($venta_id)
    {
        return $this->db->delete('detalle_factura_aux',array('venta_id'=>$venta_id));
    }
    /* elimina un detalle de detalle_factura_aux */
    function delete_detalle_factura_aux($detallefact_id)
    {
        return $this->db->delete('detalle_factura_aux',array('detallefact_id'=>$detallefact_id));
    }
    /*
     * Funcion que adiciona el detalle de una venta
     */
    function add_detalleventa_factura_aux($params)
    {
        $this->db->insert('detalle_factura_aux',$params);
        return $this->db->insert_id();
    }
    /*
     * Obtiene todo el detalle de una venta que esta en detalle factura aux
     */
    function getall_detalle_factura_aux($venta_id)
    {
        $detalle_factura_aux = $this->db->query("
            SELECT
                d.*
            FROM
                detalle_factura_aux d
            WHERE
                d.venta_id = $venta_id
        ")->result_array();

        return $detalle_factura_aux;
    }
    /*
     * Obtiene todo el detalle de una venta que esta en detalle_factura_aux
     * con su nit y razon social
     */
    function get_detallefacturaaux_nit($venta_id)
    {
        $detalle_factura_aux = $this->db->query("
            SELECT
                d.*, v.cliente_nit, v.cliente_razon, v.venta_total, v.cdi_codigoclasificador
            FROM
                detalle_factura_aux d, consventastotales v
            WHERE
                d.venta_id = $venta_id
                and d.venta_id = v.venta_id
        ")->result_array();

        return $detalle_factura_aux;
    }
    /*
     * Funcion que adiciona el detalle de detalle_factura_aux a detalle_factura
     */
    function add_detalle_factura_aux($params)
    {
        $this->db->insert('detalle_factura',$params);
        return $this->db->insert_id();
    }
    
}