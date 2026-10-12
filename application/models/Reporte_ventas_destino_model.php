<?php
class Reporte_ventas_destino_model extends CI_Model{
    public function usuario_tiene_rol($usuario_id,$rol_id){$r=$this->db->query("SELECT 1 ok FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",array((int)$usuario_id,(int)$rol_id))->row_array();return !empty($r);}
    public function listas(){return array('rutas'=>$this->db->query("SELECT ruta_id,ruta_nombre,inicio_ruta,fin_ruta FROM ruta ORDER BY ruta_nombre")->result_array(),'vehiculos'=>$this->db->query("SELECT vehiculo_id,vehiculo_placa,vehiculo_marca,vehiculo_modelo FROM vehiculo ORDER BY vehiculo_placa")->result_array());}
    public function ventas_por_destino($f){
        $where="v.viaje_fechasalida BETWEEN ? AND ? AND p.estado_id=54"; $par=array($f['desde'],$f['hasta']);
        if($f['ruta_id']>0){$where.=" AND v.ruta_id=?";$par[]=$f['ruta_id'];}
        if($f['vehiculo_id']>0){$where.=" AND v.vehiculo_id=?";$par[]=$f['vehiculo_id'];}
        /* El destino comercial pertenece al pasaje, no al viaje. Se usa pasaje_destino porque un mismo viaje puede vender tramos a destinos distintos.
           Si un registro histórico no tiene destino, se muestra SIN DESTINO para que el dato faltante sea visible y no se atribuya incorrectamente al destino final de la ruta.
           Ingreso por destino = suma del precio de los pasajes vendidos; así una venta con varios pasajeros/destinos no duplica venta_pasaje.venta_total. */
        $sql="SELECT CASE WHEN TRIM(COALESCE(p.pasaje_destino,''))='' THEN 'SIN DESTINO' ELSE TRIM(p.pasaje_destino) END destino,COUNT(*) pasajeros,COUNT(DISTINCT p.viaje_id) viajes,COALESCE(SUM(p.pasaje_precio),0) ingreso,CASE WHEN COUNT(*)>0 THEN COALESCE(SUM(p.pasaje_precio),0)/COUNT(*) ELSE 0 END precio_promedio FROM pasaje p INNER JOIN viaje v ON v.viaje_id=p.viaje_id WHERE $where GROUP BY CASE WHEN TRIM(COALESCE(p.pasaje_destino,''))='' THEN 'SIN DESTINO' ELSE TRIM(p.pasaje_destino) END ORDER BY pasajeros DESC,ingreso DESC,destino";
        return $this->db->query($sql,$par)->result_array();
    }
}
