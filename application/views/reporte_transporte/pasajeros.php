<section class="content-header"><h1><i class="fa fa-users"></i> Reporte de pasajeros</h1></section><section class="content">
<div class="box box-primary no-print"><div class="box-body"><form method="get" class="form-inline">
<label>Desde</label> <input type="date" name="desde" class="form-control" value="<?php echo html_escape($filtros['desde']);?>">
<label>Hasta</label> <input type="date" name="hasta" class="form-control" value="<?php echo html_escape($filtros['hasta']);?>">
<input type="text" name="ci" class="form-control" placeholder="CI" value="<?php echo html_escape($filtros['ci']);?>">
<input type="text" name="nombre" class="form-control" placeholder="Nombre / apellido" value="<?php echo html_escape($filtros['nombre']);?>">
<input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="<?php echo html_escape($filtros['telefono']);?>">
<button class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button></form></div></div>
<div class="box"><div class="box-header"><h3 class="box-title">Historial consolidado de pasajeros</h3><div class="pull-right no-print">
<button onclick="window.print()" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Imprimir</button>
<a class="btn btn-success btn-sm" href="<?php echo site_url('reporte_pasajeros/csv').'?'.http_build_query($filtros);?>"><i class="fa fa-file-excel-o"></i> Excel/CSV</a></div></div>
<div class="box-body"><div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr><th>CI</th><th>Pasajero / teléfono</th><th class="text-right">Viajes</th><th class="text-right">Rutas</th><th class="text-right">Frecuencia</th><th class="text-right">Gasto acumulado</th><th>Último viaje</th><th>Últimas fechas</th><th class="no-print"></th></tr></thead><tbody>
<?php foreach($resumen as $r):?><tr><td><?php echo html_escape($r['documento']);?></td><td><b><?php echo html_escape($r['pasajero']);?></b><br><small><?php echo html_escape($r['telefono']);?></small></td><td class="text-right"><?php echo $r['viajes'];?></td><td class="text-right"><?php echo $r['rutas'];?></td><td class="text-right"><?php echo number_format($r['frecuencia'],2,',','.');?> viajes/mes</td><td class="text-right"><b>Bs <?php echo number_format($r['gasto'],2,',','.');?></b></td><td><?php echo html_escape($r['ultimo_viaje']);?></td><td><small><?php echo html_escape($r['ultimas_fechas']);?></small></td><td class="no-print"><button type="button" class="btn btn-info btn-xs ver-historial" data-clave="<?php echo html_escape(rawurlencode($r['clave']));?>"><i class="fa fa-history"></i> Historial</button></td></tr><?php endforeach;?>
</tbody></table></div><p class="text-muted"><small>Frecuencia = viajes distintos por mes activo dentro del período. El gasto excluye cortesías explícitas; una venta normal de Bs 0 no se reclasifica como cortesía.</small></p></div></div></section>
<div class="modal fade" id="modalHistorial"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Historial de viajes</h4></div><div class="modal-body"><div class="table-responsive"><table class="table table-bordered table-condensed"><thead><tr><th>Fecha</th><th>Ticket</th><th>Ruta</th><th>Origen</th><th>Destino</th><th class="text-right">Importe</th></tr></thead><tbody id="historialBody"></tbody></table></div></div></div></div></div>
<script>
$(document).on('click','.ver-historial',function(){
 var clave=$(this).data('clave'), q=<?php echo json_encode('?desde='.$filtros['desde'].'&hasta='.$filtros['hasta']);?>;
 $('#historialBody').html('<tr><td colspan="6">Cargando...</td></tr>');
 $('#modalHistorial').modal('show');
 $.getJSON('<?php echo site_url('reporte_pasajeros/historial');?>/'+clave+q,function(rs){
   var h=''; $.each(rs,function(i,r){h+='<tr><td>'+esc(r.fecha)+' '+esc(r.hora)+'</td><td>'+esc(r.ticket)+'</td><td>'+esc(r.ruta)+'</td><td>'+esc(r.origen)+'</td><td>'+esc(r.destino)+'</td><td class="text-right">Bs '+Number(r.importe).toFixed(2)+(Number(r.cortesia)===1?' <small>(cortesía)</small>':'')+'</td></tr>';});
   $('#historialBody').html(h||'<tr><td colspan="6">Sin viajes.</td></tr>');
 });
});
function esc(v){return $('<div>').text(v==null?'':v).html();}
</script>
<style media="print">.no-print,.main-header,.main-sidebar,.content-header,.main-footer{display:none!important}.content-wrapper{margin-left:0!important}.content{padding:0!important}table{font-size:9px!important}</style>
