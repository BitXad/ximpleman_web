<?php
class Reporte_formas_pago_model extends CI_Model{
    public function usuario_tiene_rol($u,$r){
        return !empty($this->db->query(
            "SELECT 1 x FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id
             WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",
            array((int)$u,(int)$r)
        )->row_array());
    }

    public function listas(){
        return array(
            'cajas'=>$this->db->query(
                "SELECT c.caja_id,c.usuario_id,c.caja_fechaapertura,c.caja_horaapertura,
                        c.caja_fechacierre,c.caja_horacierre,
                        COALESCE(NULLIF(u.usuario_nombre,''),u.usuario_login,CONCAT('ID ',c.usuario_id)) usuario
                 FROM caja c LEFT JOIN usuario u ON u.usuario_id=c.usuario_id
                 ORDER BY c.caja_id DESC"
            )->result_array(),
            'usuarios'=>$this->db->query(
                "SELECT usuario_id,usuario_nombre,usuario_login FROM usuario ORDER BY usuario_nombre"
            )->result_array()
        );
    }

    private function venta_where($f,&$p){
        /*
         * FUENTE REAL INSTALADA: venta_pasaje.
         * No depende de transporte_caja_movimiento.
         * estado_id=1 = venta vigente; reservas y ventas anuladas no se suman.
         */
        $w="vp.estado_id=1 AND vp.venta_fecha BETWEEN ? AND ?";
        $p=array($f['desde'],$f['hasta']);

        if($f['usuario_id']>0){
            $w.=" AND vp.usuario_id=?";
            $p[]=$f['usuario_id'];
        }

        if($f['caja_id']>0){
            $c=$this->get_caja($f['caja_id']);
            if($c){
                $fin_fecha=!empty($c['caja_fechacierre'])?$c['caja_fechacierre']:date('Y-m-d');
                $fin_hora=!empty($c['caja_horacierre'])?$c['caja_horacierre']:date('H:i:s');
                $w.=" AND vp.usuario_id=? AND CONCAT(vp.venta_fecha,' ',vp.venta_hora) BETWEEN ? AND ?";
                $p[]=(int)$c['usuario_id'];
                $p[]=$c['caja_fechaapertura'].' '.$c['caja_horaapertura'];
                $p[]=$fin_fecha.' '.$fin_hora;
            }
        }
        return $w;
    }

    private function get_caja($id){
        return $this->db->query(
            "SELECT * FROM caja WHERE caja_id=? LIMIT 1",array((int)$id)
        )->row_array();
    }

    public function resumen($f){
        $p=array(); $w=$this->venta_where($f,$p);
        $sql="SELECT vp.forma_id,
                     COALESCE(NULLIF(fp.forma_nombre,''),CONCAT('FORMA ',vp.forma_id)) forma,
                     COUNT(*) operaciones,
                     SUM(COALESCE(vp.venta_total,0)) ventas,
                     0 reversos,
                     SUM(COALESCE(vp.venta_total,0)) total
              FROM venta_pasaje vp
              LEFT JOIN forma_pago fp ON fp.forma_id=vp.forma_id
              WHERE $w
              GROUP BY vp.forma_id,fp.forma_nombre
              ORDER BY total DESC,forma";
        return $this->db->query($sql,$p)->result_array();
    }

    public function control($f){
        $p=array(); $w=$this->venta_where($f,$p);
        $mov=$this->db->query(
            "SELECT COUNT(*) operaciones,COALESCE(SUM(vp.venta_total),0) total
             FROM venta_pasaje vp WHERE $w",$p
        )->row_array();

        $caja=array('transacciones'=>null,'efectivo'=>null,'cierre'=>null,'apertura'=>null);
        if($f['caja_id']>0){
            $c=$this->get_caja($f['caja_id']);
            if($c){
                $caja=array(
                    'transacciones'=>$c['caja_transacciones'],
                    'efectivo'=>$c['caja_efectivo'],
                    'cierre'=>$c['caja_cierre'],
                    'apertura'=>$c['caja_apertura']
                );
            }
        }
        return array('movimientos'=>$mov,'caja'=>$caja);
    }
}
