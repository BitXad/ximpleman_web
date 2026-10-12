<?php
$v = isset($vehiculo) ? $vehiculo : array();
function vm_val($a,$k,$d='-'){ return isset($a[$k]) && $a[$k]!=='' && $a[$k]!==null ? html_escape($a[$k]) : $d; }
function vm_num($a,$k,$dec=2){ return isset($a[$k]) && $a[$k]!=='' && $a[$k]!==null ? number_format((float)$a[$k],$dec,'.',',') : '-'; }
function vm_fecha($a,$k){ return !empty($a[$k]) && $a[$k]!='0000-00-00' ? date('d/m/Y',strtotime($a[$k])) : '-'; }
function vm_venc($a,$k){
    if(empty($a[$k]) || $a[$k]=='0000-00-00') return '<span class="text-muted">Sin registrar</span>';
    $dias=(strtotime($a[$k])-strtotime(date('Y-m-d')))/86400;
    $c=$dias<0?'danger':($dias<=30?'warning':'success');
    $txt=$dias<0?'VENCIDO':($dias<=30?'POR VENCER':'VIGENTE');
    return '<span class="label label-'.$c.'">'.$txt.'</span> &nbsp;'.date('d/m/Y',strtotime($a[$k]));
}
$eo = isset($v['vehiculo_estado_operativo']) && $v['vehiculo_estado_operativo'] ? $v['vehiculo_estado_operativo'] : 'DISPONIBLE';
$lbl=array('DISPONIBLE'=>'success','VIAJANDO'=>'primary','MANTENIMIENTO'=>'warning','INACTIVO'=>'default');
?>
<style>
.vm-head{background:#fff;border:1px solid #e3e8ee;border-radius:7px;padding:15px;margin-bottom:15px}.vm-placa{font-size:25px;font-weight:700}.vm-box .box-header{background:#f7f9fb}.vm-dato{padding:7px 0;border-bottom:1px solid #f0f2f4}.vm-dato:last-child{border-bottom:0}.vm-dato b{color:#52606d}.vm-stat{text-align:center;padding:13px 5px;border:1px solid #e3e8ee;border-radius:6px;background:#fff;margin-bottom:10px}.vm-stat strong{display:block;font-size:23px;color:#3c8dbc}.vm-img{max-width:100%;max-height:180px;border-radius:6px;border:1px solid #e3e8ee;padding:3px}
</style>
<div class="row"><div class="col-md-12">
 <div class="vm-head clearfix">
  <div class="pull-right no-print">
   <a href="<?php echo site_url('vehiculo/edit/'.$v['vehiculo_id']); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a>
   <a href="<?php echo site_url('vehiculo/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
  </div>
  <div class="vm-placa"><i class="fa fa-bus"></i> <?php echo vm_val($v,'vehiculo_placa'); ?></div>
  <span class="label label-<?php echo isset($lbl[$eo])?$lbl[$eo]:'default'; ?>"><?php echo html_escape($eo); ?></span>
  &nbsp; <?php echo vm_val($v,'vehiculo_marca'); ?> <?php echo vm_val($v,'vehiculo_modelo',''); ?>
 </div>
</div></div>

<div class="row">
 <div class="col-md-3"><div class="vm-stat"><strong><?php echo (int)$resumen_asientos['total']; ?></strong>Asientos configurados</div></div>
 <div class="col-md-3"><div class="vm-stat"><strong><?php echo (int)$resumen_asientos['vendibles']; ?></strong>Asientos vendibles</div></div>
 <div class="col-md-3"><div class="vm-stat"><strong><?php echo (int)$resumen_asientos['pisos']; ?></strong>Pisos</div></div>
 <div class="col-md-3"><div class="vm-stat"><strong><?php echo vm_num($v,'vehiculo_kilometraje',0); ?></strong>Kilómetros</div></div>
</div>

<div class="row">
 <div class="col-md-6"><div class="box box-primary vm-box"><div class="box-header"><h3 class="box-title"><i class="fa fa-id-card"></i> Identificación y propietario</h3></div><div class="box-body">
  <div class="row"><div class="col-sm-8">
   <div class="vm-dato"><b>Propietario:</b> <?php echo vm_val($v,'vehiculo_nombrespropietario','').' '.vm_val($v,'vehiculo_apellidospropietario',''); ?></div>
   <div class="vm-dato"><b>Placa:</b> <?php echo vm_val($v,'vehiculo_placa'); ?></div>
   <div class="vm-dato"><b>Marca / Modelo:</b> <?php echo vm_val($v,'vehiculo_marca'); ?> / <?php echo vm_val($v,'vehiculo_modelo'); ?></div>
   <div class="vm-dato"><b>Año:</b> <?php echo vm_val($v,'vehiculo_aniofabricacion'); ?></div>
   <div class="vm-dato"><b>Clase:</b> <?php echo vm_val($v,'vehiculo_clase'); ?></div>
   <div class="vm-dato"><b>Color:</b> <?php echo vm_val($v,'vehiculo_color'); ?></div>
   <div class="vm-dato"><b>Tipo servicio:</b> <?php echo vm_val($v,'vehiculo_tiposervicio'); ?></div>
  </div><div class="col-sm-4 text-center">
   <?php if(!empty($v['vehiculo_imagen'])){ ?><img class="vm-img" src="<?php echo base_url('resources/images/vehiculos/'.$v['vehiculo_imagen']); ?>" onerror="this.style.display='none'"><?php } else { ?><i class="fa fa-bus fa-5x text-muted"></i><?php } ?>
  </div></div>
 </div></div></div>

 <div class="col-md-6"><div class="box box-info vm-box"><div class="box-header"><h3 class="box-title"><i class="fa fa-cogs"></i> Características técnicas</h3></div><div class="box-body">
  <div class="row"><div class="col-sm-6">
   <div class="vm-dato"><b>Motor:</b> <?php echo vm_val($v,'vehiculo_numeromotor'); ?></div><div class="vm-dato"><b>Serie:</b> <?php echo vm_val($v,'vehiculo_serie'); ?></div><div class="vm-dato"><b>Combustible:</b> <?php echo vm_val($v,'vehiculo_tipocombustible'); ?></div><div class="vm-dato"><b>Cilindros:</b> <?php echo vm_val($v,'vehiculo_cilindros'); ?></div><div class="vm-dato"><b>Ejes / Ruedas:</b> <?php echo vm_val($v,'vehiculo_ejes'); ?> / <?php echo vm_val($v,'vehiculo_ruedas'); ?></div>
  </div><div class="col-sm-6">
   <div class="vm-dato"><b>Pasajeros:</b> <?php echo vm_val($v,'vehiculo_pasajeros'); ?></div><div class="vm-dato"><b>Asientos declarados:</b> <?php echo vm_val($v,'vehiculo_asientos'); ?></div><div class="vm-dato"><b>Peso seco:</b> <?php echo vm_num($v,'vehiculo_pesoseco'); ?></div><div class="vm-dato"><b>Peso bruto:</b> <?php echo vm_num($v,'vehiculo_pesobruto'); ?></div><div class="vm-dato"><b>L × A × H:</b> <?php echo vm_num($v,'vehiculo_longitud'); ?> × <?php echo vm_num($v,'vehiculo_ancho'); ?> × <?php echo vm_num($v,'vehiculo_altura'); ?></div>
  </div></div>
 </div></div></div>
</div>

<div class="row">
 <div class="col-md-6"><div class="box box-warning vm-box"><div class="box-header"><h3 class="box-title"><i class="fa fa-file-text-o"></i> Documentación</h3></div><div class="box-body">
  <div class="vm-dato"><b>RUAT:</b> <?php echo vm_val($v,'vehiculo_ruat'); ?></div><div class="vm-dato"><b>Tarjeta circulación:</b> <?php echo vm_val($v,'vehiculo_tarjetacirculacion'); ?></div><div class="vm-dato"><b>Fecha tarjeta:</b> <?php echo vm_fecha($v,'vehiculo_fechatarjeta'); ?></div><div class="vm-dato"><b>Nº autorización:</b> <?php echo vm_val($v,'vehiculo_numeroautorizacion'); ?></div><div class="vm-dato"><b>SOAT / Póliza:</b> <?php echo vm_val($v,'vehiculo_soat_numero'); ?></div><div class="vm-dato"><b>Vencimiento SOAT:</b> <?php echo vm_venc($v,'vehiculo_soat_vencimiento'); ?></div><div class="vm-dato"><b>Inspección:</b> <?php echo vm_val($v,'vehiculo_inspeccion_numero'); ?></div><div class="vm-dato"><b>Vencimiento inspección:</b> <?php echo vm_venc($v,'vehiculo_inspeccion_vencimiento'); ?></div>
 </div></div></div>
 <div class="col-md-6"><div class="box box-success vm-box"><div class="box-header"><h3 class="box-title"><i class="fa fa-calendar"></i> Próximos viajes</h3></div><div class="box-body table-responsive">
  <?php if(empty($proximos_viajes)){ ?><div class="text-muted text-center" style="padding:25px"><i class="fa fa-calendar-times-o fa-2x"></i><br>No existen próximos viajes asignados.</div><?php } else { ?>
  <table class="table table-condensed table-striped"><thead><tr><th>Viaje</th><th>Fecha</th><th>Hora</th><th>Estado</th></tr></thead><tbody><?php foreach($proximos_viajes as $x){ ?><tr><td>#<?php echo (int)$x['viaje_id']; ?></td><td><?php echo !empty($x['viaje_fecha'])?date('d/m/Y',strtotime($x['viaje_fecha'])):'-'; ?></td><td><?php echo isset($x['viaje_hora'])?html_escape(substr($x['viaje_hora'],0,5)):'-'; ?></td><td><?php echo isset($x['estado_id'])?(int)$x['estado_id']:'-'; ?></td></tr><?php } ?></tbody></table>
  <?php } ?>
 </div></div></div>
</div>
