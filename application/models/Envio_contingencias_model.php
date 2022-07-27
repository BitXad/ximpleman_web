<?php

class Envio_contingencias_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_ventas_enlinea($condicion)
    {    

        $sql = "select v.*, b.banco_nombre,f.factura_tokendelegado, f.factura_ambiente, 
                f.factura_cuis, f.factura_cufd, f.factura_modalidad, f.factura_codsistema, 
                f.factura_puntoventa, f.factura_sectoreconomico, f.factura_ruta, 
                f.factura_tamanio, f.factura_cuf, f.factura_fechahora, f.cdi_codigoclasificador, 
                f.docsec_codigoclasificador, f.factura_codigoestado, f.factura_codigorecepcion, 
                f.factura_transaccion, f.factura_mensajeslist, f.factura_codigocliente, 
                f.factura_codigodescripcion, f.factura_enviada,f.factura_id,
                f.factura_excepcion, f.factura_tipoemision,
                e.recpaquete_id, e.recpaquete_codigodescripcion, 
                e.recpaquete_codigoestado, e.recpaquete_codigorecepcion, 
                e.recpaquete_transaccion, e.recpaquete_mensajeslist, 
                e.recpaquete_fechahora, e.codigo_evento
                
                from consventastotales v
                left join banco b on b.banco_id = v.banco_id
                left join factura f on f.venta_id = v.venta_id
                left join recepcion_paquetes e on e.factura_id = f.factura_id
                where 1 = 1 
                ".$condicion."
                order by v.venta_id desc";
        
        $ventas = $this->db->query($sql)->result_array();

        return $ventas;
    }
    
}
