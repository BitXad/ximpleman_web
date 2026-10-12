<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventassimple.css'); ?>" rel="stylesheet">
<div class="row"><div class="col-md-12">
<div class="box box-primary"><div class="box-header with-border"><h3 class="box-title"><i class="fa fa-money"></i> TARIFAS DE TRANSPORTE</h3></div>
<div class="box-body">
<?php if($this->session->flashdata('success')){?><div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div><?php }?>
<?php if($this->session->flashdata('error')){?><div class="alert alert-danger"><?php echo $this->session->flashdata('error');?></div><?php }?>

<?php
$tarifa_lista = isset($estructura_tarifa) ? $estructura_tarifa : array('ok'=>false,'tablas_faltantes'=>array(),'columnas_faltantes'=>array());
$tarifa_instalada = !empty($tarifa_lista['ok']);
if(!$tarifa_instalada){
    $faltantes=array_merge(
        isset($tarifa_lista['tablas_faltantes'])?$tarifa_lista['tablas_faltantes']:array(),
        isset($tarifa_lista['columnas_faltantes'])?$tarifa_lista['columnas_faltantes']:array()
    );
?>
<div class="alert alert-danger">
    <h4 style="margin-top:0"><i class="fa fa-warning"></i> MÓDULO DE TARIFAS PENDIENTE DE ACTUALIZACIÓN</h4>
    <p>La pantalla ya puede abrirse, pero falta completar la estructura de la base de datos.</p>
    <p><b>Ejecute:</b> <code>database/database_actualizacion_tarifas_transporte.sql</code></p>
    <?php if(count($faltantes)){ ?>
        <p style="margin-bottom:0"><b>Elementos faltantes:</b> <?php echo html_escape(implode(', ',$faltantes)); ?></p>
    <?php } ?>
</div>
<?php } ?>

<div class="alert alert-info"><b>Orden de resolución:</b> ruta → categoría de vehículo → tipo de asiento → temporada/vigencia → horario → prioridad. El precio final queda congelado en <code>pasaje_precio</code> para conservar el histórico.</div>
<button class="btn btn-primary" data-toggle="modal" data-target="#mTarifa" <?php echo $tarifa_instalada?'':'disabled title="Ejecute primero el SQL de actualización"'; ?>><i class="fa fa-plus"></i> NUEVA TARIFA</button>
<button class="btn btn-default" data-toggle="modal" data-target="#mTemporada" <?php echo $tarifa_instalada?'':'disabled title="Ejecute primero el SQL de actualización"'; ?>><i class="fa fa-calendar"></i> TEMPORADAS</button>
<hr>
<div class="table-responsive"><table class="table table-bordered table-striped" id="mitabla"><thead><tr><th>RUTA</th><th>NOMBRE</th><th>CATEGORÍA</th><th>ASIENTO</th><th>HORARIO</th><th>TEMPORADA</th><th>PRECIO</th><th>PRIOR.</th><th>ESTADO</th></tr></thead><tbody>
<?php foreach($tarifas as $t){?><tr>
<td><?php echo html_escape($t['ruta_nombre']);?></td><td><b><?php echo html_escape($t['tarifa_nombre']);?></b><?php if((int)$t['tarifa_nocturna']===1){?> <span class="label label-primary">NOCTURNA</span><?php }?></td>
<td><?php echo html_escape($t['categoriavehiculo_nombre']?:'TODAS');?></td><td><?php echo html_escape($t['tarifa_tipoasiento']?:'TODOS');?></td>
<td><?php echo ($t['tarifa_hora_desde']&&$t['tarifa_hora_hasta'])?substr($t['tarifa_hora_desde'],0,5).' - '.substr($t['tarifa_hora_hasta'],0,5):'TODO EL DÍA';?></td>
<td><?php echo html_escape($t['temporada_nombre']?:'GENERAL');?></td><td class="text-right"><b>Bs <?php echo number_format($t['tarifa_precio'],2);?></b></td>
<td class="text-center"><?php echo (int)$t['tarifa_prioridad'];?></td><td><?php echo (int)$t['estado_id']===1?'<span class="label label-success">ACTIVA</span>':'<span class="label label-default">INACTIVA</span>';?></td>
</tr><?php }?></tbody></table></div>
<hr><h4><i class="fa fa-users"></i> Tipos de pasajero / beneficios</h4>
<div class="table-responsive"><table class="table table-condensed table-bordered"><thead><tr><th>TIPO</th><th>AJUSTE</th><th>VALOR</th><th>AUTORIZACIÓN</th><th>ESTADO</th></tr></thead><tbody>
<?php foreach($tipos as $tp){?><tr><td><?php echo html_escape($tp['tarifatipopasajero_nombre']);?></td><td><?php echo html_escape($tp['tarifatipopasajero_tipoajuste']);?></td><td><?php echo number_format($tp['tarifatipopasajero_valor'],2);?></td><td><?php echo $tp['tarifatipopasajero_requiereautorizacion']?'SI':'NO';?></td><td><?php echo $tp['estado_id']?'ACTIVO':'INACTIVO';?></td></tr><?php }?></tbody></table></div>
</div></div></div></div>

<div class="modal fade" id="mTarifa"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="post" action="<?php echo site_url('tarifa/guardar');?>">
<div class="modal-header bg-blue"><button class="close" data-dismiss="modal">&times;</button><h4>NUEVA TARIFA</h4></div><div class="modal-body"><div class="row">
<div class="col-md-6"><label>Ruta *</label><select name="ruta_id" class="form-control" required><option value="">-- Ruta --</option><?php foreach($rutas as $r){?><option value="<?php echo $r['ruta_id'];?>"><?php echo html_escape($r['ruta_nombre']);?></option><?php }?></select></div>
<div class="col-md-6"><label>Nombre *</label><input name="tarifa_nombre" class="form-control" placeholder="Ej. Cama nocturno temporada alta" required></div>
<div class="col-md-4"><label>Categoría vehículo</label><select name="categoriavehiculo_id" class="form-control"><option value="0">TODAS</option><?php foreach($categorias as $c){?><option value="<?php echo $c['categoriavehiculo_id'];?>"><?php echo html_escape($c['categoriavehiculo_nombre']);?></option><?php }?></select></div>
<div class="col-md-4"><label>Tipo asiento</label><select name="tarifa_tipoasiento" class="form-control"><option value="">TODOS</option><option>NORMAL</option><option>CAMA</option><option>LEITO</option><option>SEMICAMA</option></select></div>
<div class="col-md-4"><label>Temporada</label><select name="temporada_id" class="form-control"><option value="0">GENERAL</option><?php foreach($temporadas as $te){?><option value="<?php echo $te['temporada_id'];?>"><?php echo html_escape($te['temporada_nombre']);?></option><?php }?></select></div>
<div class="col-md-3"><label>Desde hora</label><input type="time" name="tarifa_hora_desde" class="form-control"></div><div class="col-md-3"><label>Hasta hora</label><input type="time" name="tarifa_hora_hasta" class="form-control"></div>
<div class="col-md-3"><label>Precio Bs *</label><input type="number" step="0.01" min="0" name="tarifa_precio" class="form-control" required></div><div class="col-md-3"><label>Prioridad</label><input type="number" name="tarifa_prioridad" value="0" class="form-control"></div>
<div class="col-md-3"><label>Vigencia desde</label><input type="date" name="tarifa_vigencia_desde" class="form-control"></div><div class="col-md-3"><label>Vigencia hasta</label><input type="date" name="tarifa_vigencia_hasta" class="form-control"></div>
<div class="col-md-3"><label style="display:block">Especial</label><label><input type="checkbox" name="tarifa_nocturna" value="1"> Tarifa nocturna</label></div><div class="col-md-3"><label style="display:block">Estado</label><label><input type="checkbox" name="estado_id" value="1" checked> Activa</label></div>
<div class="col-md-12"><label>Observación</label><input name="tarifa_observacion" class="form-control"></div>
</div></div><div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancelar</button><button class="btn btn-success"><i class="fa fa-save"></i> Guardar tarifa</button></div></form></div></div></div>

<div class="modal fade" id="mTemporada"><div class="modal-dialog"><div class="modal-content"><form method="post" action="<?php echo site_url('tarifa/guardar_temporada');?>">
<div class="modal-header"><button class="close" data-dismiss="modal">&times;</button><h4>NUEVA TEMPORADA</h4></div><div class="modal-body">
<label>Nombre</label><input name="nombre" class="form-control" required><div class="row"><div class="col-md-6"><label>Desde</label><input type="date" name="desde" class="form-control"></div><div class="col-md-6"><label>Hasta</label><input type="date" name="hasta" class="form-control"></div></div>
<label>Prioridad</label><input type="number" name="prioridad" value="10" class="form-control"><label><input type="checkbox" name="activo" value="1" checked> Activa</label>
<hr><b>Temporadas registradas</b><ul><?php foreach($temporadas as $te){?><li><?php echo html_escape($te['temporada_nombre']).' '.html_escape($te['temporada_fecha_desde']).' → '.html_escape($te['temporada_fecha_hasta']);?></li><?php }?></ul>
</div><div class="modal-footer"><button class="btn btn-success">Guardar</button></div></form></div></div></div>
