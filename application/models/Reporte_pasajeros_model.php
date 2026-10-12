<?php
class Reporte_pasajeros_model extends CI_Model{
    public function usuario_tiene_rol($u,$r){
        return !empty($this->db->query("SELECT 1 x FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",array((int)$u,(int)$r))->row_array());
    }

    private function identidad(){
        /* CI es la clave preferida; si no existe, usa nombre+telefono para no mezclar homónimos tan fácilmente. */
        return "CASE WHEN TRIM(COALESCE(p.pasaje_documento,''))<>'' THEN CONCAT('CI:',TRIM(p.pasaje_documento)) ELSE CONCAT('NT:',UPPER(TRIM(COALESCE(p.pasaje_nombre,''))),'|',TRIM(COALESCE(p.pasaje_telefono,''))) END";
    }

    private function where($f,&$p){
        $w="p.estado_id=54 AND p.pasaje_fecha BETWEEN ? AND ?";
        $p=array($f['desde'],$f['hasta']);
        if($f['ci']!==''){$w.=" AND p.pasaje_documento LIKE ?";$p[]='%'.$f['ci'].'%';}
        if($f['nombre']!==''){$w.=" AND p.pasaje_nombre LIKE ?";$p[]='%'.$f['nombre'].'%';}
        if($f['telefono']!==''){$w.=" AND p.pasaje_telefono LIKE ?";$p[]='%'.$f['telefono'].'%';}
        return $w;
    }

    public function resumen($f){
        $p=array(); $w=$this->where($f,$p); $id=$this->identidad();
        $sql="SELECT $id clave,
              MAX(NULLIF(TRIM(p.pasaje_documento),'')) documento,
              MAX(p.pasaje_nombre) pasajero,
              MAX(NULLIF(TRIM(p.pasaje_telefono),'')) telefono,
              COUNT(DISTINCT p.viaje_id) viajes,
              COUNT(DISTINCT v.ruta_id) rutas,
              COALESCE(SUM(CASE WHEN COALESCE(p.pasaje_es_cortesia,0)=0 THEN p.pasaje_precio ELSE 0 END),0) gasto,
              MAX(p.pasaje_fecha) ultimo_viaje,
              ROUND(COUNT(DISTINCT p.viaje_id)/GREATEST(1,TIMESTAMPDIFF(MONTH,MIN(p.pasaje_fecha),MAX(p.pasaje_fecha))+1),2) frecuencia,
              GROUP_CONCAT(DISTINCT DATE_FORMAT(p.pasaje_fecha,'%d/%m/%Y') ORDER BY p.pasaje_fecha DESC SEPARATOR ', ') ultimas_fechas
              FROM pasaje p
              LEFT JOIN viaje v ON v.viaje_id=p.viaje_id
              WHERE $w
              GROUP BY $id
              ORDER BY ultimo_viaje DESC,pasajero";
        $rows=$this->db->query($sql,$p)->result_array();
        foreach($rows as &$r){
            $fs=explode(', ',$r['ultimas_fechas']);
            $r['ultimas_fechas']=implode(', ',array_slice($fs,0,5));
        }
        return $rows;
    }

    public function historial($clave,$f){
        $p=array($clave,$f['desde'],$f['hasta']); $id=$this->identidad();
        $sql="SELECT p.pasaje_fecha fecha,p.pasaje_hora hora,p.pasaje_numero ticket,
              COALESCE(r.ruta_nombre,CONCAT_WS(' - ',r.inicio_ruta,r.fin_ruta)) ruta,
              p.pasaje_origen origen,p.pasaje_destino destino,
              CASE WHEN COALESCE(p.pasaje_es_cortesia,0)=1 THEN 0 ELSE COALESCE(p.pasaje_precio,0) END importe,
              COALESCE(p.pasaje_es_cortesia,0) cortesia
              FROM pasaje p LEFT JOIN viaje v ON v.viaje_id=p.viaje_id LEFT JOIN ruta r ON r.ruta_id=v.ruta_id
              WHERE $id=? AND p.estado_id=54 AND p.pasaje_fecha BETWEEN ? AND ?
              ORDER BY p.pasaje_fecha DESC,p.pasaje_hora DESC";
        return $this->db->query($sql,$p)->result_array();
    }
}
