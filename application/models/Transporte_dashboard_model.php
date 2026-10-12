<?php
class Transporte_dashboard_model extends CI_Model{
    private function capacidad_sql(){
        return "COALESCE(NULLIF((SELECT COUNT(*) FROM asientos a WHERE a.vehiculo_id=v.vehiculo_id AND a.asiento_mostrar=1 AND a.asiento_es_vendible=1),0),NULLIF(ve.vehiculo_asientos,0),NULLIF(ve.vehiculo_pasajeros,0),0)";
    }
    public function indicadores_hoy(){
        $hoy=date('Y-m-d');
        $ventas=$this->db->query("SELECT COALESCE(SUM(CASE WHEN pasaje_es_cortesia=1 THEN 0 ELSE pasaje_precio END),0) total,COUNT(*) pasajeros FROM pasaje WHERE estado_id=54 AND pasaje_fecha=?",array($hoy))->row_array();
        $viajes=$this->db->query("SELECT COUNT(*) n FROM viaje WHERE viaje_fechasalida=? AND (estado_id IS NULL OR estado_id<>63)",array($hoy))->row_array();
        $reservas=$this->db->query("SELECT COUNT(*) n FROM pasaje WHERE estado_id=52")->row_array();
        $cap=$this->capacidad_sql();
        $oc=$this->db->query("SELECT COALESCE(SUM(x.vendidos)*100/NULLIF(SUM(x.capacidad),0),0) ocupacion FROM (SELECT v.viaje_id,$cap capacidad,(SELECT COUNT(*) FROM pasaje p WHERE p.viaje_id=v.viaje_id AND p.estado_id=54) vendidos FROM viaje v LEFT JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id WHERE v.viaje_fechasalida=? AND (v.estado_id IS NULL OR v.estado_id<>63)) x",array($hoy))->row_array();
        return array('ventas'=>(float)$ventas['total'],'pasajeros'=>(int)$ventas['pasajeros'],'viajes'=>(int)$viajes['n'],'ocupacion'=>(float)$oc['ocupacion'],'reservas'=>(int)$reservas['n']);
    }
    public function proximas_salidas(){
        $cap=$this->capacidad_sql();
        $sql="SELECT v.viaje_id,v.viaje_horasalida,COALESCE(r.ruta_nombre,CONCAT_WS(' - ',r.inicio_ruta,r.fin_ruta)) ruta,
        COALESCE(NULLIF(ve.vehiculo_placa,''),CONCAT('Bus #',v.vehiculo_id)) bus,
        (SELECT COUNT(*) FROM pasaje p WHERE p.viaje_id=v.viaje_id AND p.estado_id=54) vendidos,
        $cap capacidad,COALESCE(es.estado_descripcion,'') estado
        FROM viaje v LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id LEFT JOIN estado es ON es.estado_id=v.estado_id
        WHERE v.viaje_fechasalida=CURDATE() AND v.viaje_horasalida>=CURTIME() AND (v.estado_id IS NULL OR v.estado_id<>63)
        ORDER BY v.viaje_horasalida LIMIT 10";
        return $this->db->query($sql)->result_array();
    }
    public function ocupacion_viajes(){
        $cap=$this->capacidad_sql();
        $sql="SELECT v.viaje_id,TIME_FORMAT(v.viaje_horasalida,'%H:%i') hora,COALESCE(r.ruta_nombre,CONCAT_WS(' - ',r.inicio_ruta,r.fin_ruta)) ruta,
        (SELECT COUNT(*) FROM pasaje p WHERE p.viaje_id=v.viaje_id AND p.estado_id=54) vendidos,$cap capacidad
        FROM viaje v LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id
        WHERE v.viaje_fechasalida=CURDATE() AND (v.estado_id IS NULL OR v.estado_id<>63) ORDER BY v.viaje_horasalida LIMIT 12";
        return $this->db->query($sql)->result_array();
    }
    public function ventas_dias($dias=30){
        $dias=max(7,min(30,(int)$dias));
        return $this->db->query("SELECT d.fecha,COALESCE(SUM(CASE WHEN p.pasaje_es_cortesia=1 THEN 0 ELSE p.pasaje_precio END),0) total FROM (SELECT DATE_SUB(CURDATE(),INTERVAL n DAY) fecha FROM (SELECT 0 n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15 UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19 UNION ALL SELECT 20 UNION ALL SELECT 21 UNION ALL SELECT 22 UNION ALL SELECT 23 UNION ALL SELECT 24 UNION ALL SELECT 25 UNION ALL SELECT 26 UNION ALL SELECT 27 UNION ALL SELECT 28 UNION ALL SELECT 29) n WHERE n<?) d LEFT JOIN pasaje p ON p.pasaje_fecha=d.fecha AND p.estado_id=54 GROUP BY d.fecha ORDER BY d.fecha",array($dias))->result_array();
    }
    public function destinos(){
        return $this->db->query("SELECT COALESCE(NULLIF(TRIM(pasaje_destino),''),'SIN DESTINO') destino,COUNT(*) pasajeros,COALESCE(SUM(CASE WHEN pasaje_es_cortesia=1 THEN 0 ELSE pasaje_precio END),0) importe FROM pasaje WHERE estado_id=54 AND pasaje_fecha>=DATE_SUB(CURDATE(),INTERVAL 30 DAY) GROUP BY destino ORDER BY pasajeros DESC,importe DESC LIMIT 7")->result_array();
    }
    public function alertas(){
        $a=array();
        $r=$this->db->query("SELECT COUNT(*) n FROM pasaje WHERE estado_id=52 AND pasaje_fechalimiteres IS NOT NULL AND TIMESTAMP(pasaje_fechalimiteres,pasaje_horalimiteres) BETWEEN NOW() AND DATE_ADD(NOW(),INTERVAL 30 MINUTE)")->row_array();
        if($r['n']>0)$a[]=array('tipo'=>'warning','icono'=>'clock-o','texto'=>$r['n'].' reserva(s) vencen en los próximos 30 minutos');
        $r=$this->db->query("SELECT COUNT(*) n FROM viaje v WHERE v.viaje_fechasalida BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 1 DAY) AND (v.estado_id IS NULL OR v.estado_id<>63) AND NOT EXISTS(SELECT 1 FROM viaje_conductor vc WHERE vc.viaje_id=v.viaje_id AND vc.estado_id=1)")->row_array();
        if($r['n']>0)$a[]=array('tipo'=>'danger','icono'=>'user-times','texto'=>$r['n'].' viaje(s) próximo(s) sin conductor asignado');
        $r=$this->db->query("SELECT COUNT(*) n FROM viaje WHERE viaje_fechasalida BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 1 DAY) AND (estado_id IS NULL OR estado_id<>63) AND (vehiculo_id IS NULL OR vehiculo_id=0)")->row_array();
        if($r['n']>0)$a[]=array('tipo'=>'danger','icono'=>'bus','texto'=>$r['n'].' viaje(s) próximo(s) sin vehículo');
        $r=$this->db->query("SELECT COUNT(*) n FROM vehiculo WHERE UPPER(TRIM(vehiculo_estado_operativo))='MANTENIMIENTO'")->row_array();
        if($r['n']>0)$a[]=array('tipo'=>'warning','icono'=>'wrench','texto'=>$r['n'].' bus(es) actualmente en mantenimiento');
        $r=$this->db->query("SELECT COUNT(*) n FROM vehiculo WHERE (vehiculo_soat_vencimiento BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 30 DAY)) OR (vehiculo_inspeccion_vencimiento BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 30 DAY))")->row_array();
        if($r['n']>0)$a[]=array('tipo'=>'warning','icono'=>'calendar-times-o','texto'=>$r['n'].' vehículo(s) con SOAT/inspección por vencer en 30 días');
        if($this->db->field_exists('conductor_licencia_vencimiento','conductor')){
            $r=$this->db->query("SELECT COUNT(*) n FROM conductor WHERE conductor_licencia_vencimiento BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 30 DAY)")->row_array();
            if($r['n']>0)$a[]=array('tipo'=>'warning','icono'=>'id-card','texto'=>$r['n'].' licencia(s) de conductor por vencer en 30 días');
        }
        $cap=$this->capacidad_sql();
        $r=$this->db->query("SELECT COUNT(*) n FROM (SELECT v.viaje_id,(SELECT COUNT(*) FROM pasaje p WHERE p.viaje_id=v.viaje_id AND p.estado_id=54) vendidos,$cap capacidad FROM viaje v LEFT JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id WHERE v.viaje_fechasalida=CURDATE() AND v.viaje_horasalida>=CURTIME() AND (v.estado_id IS NULL OR v.estado_id<>63)) q WHERE q.capacidad>0 AND q.vendidos*100/q.capacidad<30")->row_array();
        if($r['n']>0)$a[]=array('tipo'=>'info','icono'=>'line-chart','texto'=>$r['n'].' salida(s) de hoy con ocupación inferior al 30%');
        return $a;
    }
}
