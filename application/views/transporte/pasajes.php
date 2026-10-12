<section class="content-header">
  <h1><i class="fa fa-ticket"></i> Buscador de Pasajes <small>Reimpresión y gestión histórica</small></h1>
</section>
<section class="content">
<div class="box box-primary">
 <div class="box-header with-border"><h3 class="box-title">Filtros</h3><div class="box-tools"><a href="<?php echo site_url('transporte'); ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Transporte</a></div></div>
 <form method="get" action="<?php echo site_url('transporte/pasajes'); ?>">
 <div class="box-body"><div class="row">
 <?php $F=function($k)use($filtros){return htmlspecialchars(isset($filtros[$k])?$filtros[$k]:'',ENT_QUOTES,'UTF-8');}; ?>
 <div class="col-md-2"><label>Nº pasaje</label><input name="numero" class="form-control" value="<?php echo $F('numero'); ?>"></div>
 <div class="col-md-2"><label>CI / Documento</label><input name="ci" class="form-control" value="<?php echo $F('ci'); ?>"></div>
 <div class="col-md-2"><label>Nombre</label><input name="nombre" class="form-control" value="<?php echo $F('nombre'); ?>"></div>
 <div class="col-md-2"><label>Teléfono</label><input name="telefono" class="form-control" value="<?php echo $F('telefono'); ?>"></div>
 <div class="col-md-2"><label>Desde</label><input type="date" name="desde" class="form-control" value="<?php echo $F('desde'); ?>"></div>
 <div class="col-md-2"><label>Hasta</label><input type="date" name="hasta" class="form-control" value="<?php echo $F('hasta'); ?>"></div>
 </div><div class="row" style="margin-top:10px">
 <div class="col-md-3"><label>Viaje / Ruta</label><input name="viaje" class="form-control" placeholder="ID viaje o nombre de ruta" value="<?php echo $F('viaje'); ?>"></div>
 <div class="col-md-2"><label>Asiento</label><input name="asiento" class="form-control" value="<?php echo $F('asiento'); ?>"></div>
 <div class="col-md-7" style="padding-top:25px"><button class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button> <a class="btn btn-default" href="<?php echo site_url('transporte/pasajes'); ?>"><i class="fa fa-eraser"></i> Limpiar</a></div>
 </div></div></form>
</div>
<div class="box box-solid">
 <div class="box-header with-border"><h3 class="box-title"><?php echo number_format((int)$total,0,',','.'); ?> resultado(s)</h3></div>
 <div class="box-body table-responsive">
 <table class="table table-bordered table-striped table-hover"><thead><tr><th>Pasaje</th><th>Fecha / Viaje</th><th>Ruta</th><th>Pasajero</th><th>CI</th><th>Teléfono</th><th>Asiento</th><th class="text-right">Importe</th><th>Estado</th><th style="min-width:255px">Acciones</th></tr></thead><tbody>
 <?php if(empty($pasajes)){ ?><tr><td colspan="10" class="text-center text-muted">No se encontraron pasajes con los filtros seleccionados.</td></tr><?php } ?>
 <?php foreach($pasajes as $p){ $id=(int)$p['pasaje_id']; $estado=strtoupper(trim((string)$p['estado_descripcion'])); $activo=in_array((int)$p['estado_id'],array(52,54),true); ?>
 <tr>
  <td><b><?php echo htmlspecialchars($p['pasaje_numero']?:$id); ?></b><br><small>#<?php echo $id; ?></small></td>
  <td><?php echo htmlspecialchars($p['viaje_fechasalida']); ?><br><small><?php echo htmlspecialchars(substr((string)$p['viaje_horasalida'],0,5)); ?> · Viaje #<?php echo (int)$p['viaje_id']; ?></small></td>
  <td><?php echo htmlspecialchars($p['ruta_nombre']?:'-'); ?></td>
  <td><?php echo htmlspecialchars($p['pasaje_nombre']?:'-'); ?></td>
  <td><?php echo htmlspecialchars($p['pasaje_documento']?:'-'); ?></td>
  <td><?php echo htmlspecialchars($p['pasaje_telefono']?:'-'); ?></td>
  <td class="text-center"><b><?php echo htmlspecialchars($p['asiento_numero']?:'-'); ?></b></td>
  <td class="text-right"><?php echo number_format((float)$p['pasaje_precio'],2,'.',','); ?></td>
  <td><span class="label <?php echo $activo?'label-success':'label-default'; ?>"><?php echo htmlspecialchars($estado?:('ESTADO '.$p['estado_id'])); ?></span></td>
  <td>
   <button class="btn btn-info btn-xs" onclick="verPasaje(<?php echo $id; ?>)"><i class="fa fa-eye"></i> Ver</button>
   <a class="btn btn-default btn-xs" target="_blank" href="<?php echo site_url('viaje/imprimir_pasaje_individual/'.$id); ?>"><i class="fa fa-print"></i> Imprimir</a>
   <?php if(!empty($p['pasaje_qr_token'])){ ?>
   <a class="btn btn-primary btn-xs" target="_blank" href="<?php echo site_url('pasaje_publico/pdf/'.rawurlencode($p['pasaje_qr_token'])); ?>"><i class="fa fa-file-pdf-o"></i> PDF</a>
   <?php } ?>
   <button class="btn btn-success btn-xs" onclick='enviarPasajeWhatsApp(<?php echo json_encode($p,JSON_HEX_APOS|JSON_HEX_QUOT); ?>)'><i class="fa fa-whatsapp"></i> WhatsApp</button>
   <?php if($activo){ ?><button class="btn btn-warning btn-xs" onclick="abrirReprogramacion(<?php echo $id; ?>)"><i class="fa fa-calendar"></i> Reprogramar</button><?php } ?>
  </td>
 </tr><?php } ?>
 </tbody></table>
 </div>
 <?php if($paginas>1){ $qs=$_GET; unset($qs['pagina']); ?><div class="box-footer text-center"><ul class="pagination pagination-sm" style="margin:0">
 <?php for($i=max(1,$pagina-3);$i<=min($paginas,$pagina+3);$i++){ $qs['pagina']=$i; ?><li class="<?php echo $i==$pagina?'active':''; ?>"><a href="?<?php echo http_build_query($qs); ?>"><?php echo $i; ?></a></li><?php } ?>
 </ul></div><?php } ?>
</div>
</section>

<div class="modal fade" id="modalDetalle"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button class="close" data-dismiss="modal">&times;</button><h4><i class="fa fa-ticket"></i> Detalle del pasaje</h4></div><div class="modal-body" id="detallePasaje">Cargando...</div></div></div></div>
<div class="modal fade" id="modalReprogramar"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button class="close" data-dismiss="modal">&times;</button><h4><i class="fa fa-calendar"></i> Reprogramar pasaje</h4></div><div class="modal-body">
<input type="hidden" id="rp_origen"><div id="rp_info" class="alert alert-info"></div>
<div class="form-group"><label>Viaje destino</label><select id="rp_viaje" class="form-control" onchange="cargarAsientos()"></select></div>
<div class="form-group"><label>Asiento destino</label><select id="rp_destino" class="form-control"></select></div>
<div class="form-group"><label>Penalidad Bs</label><input id="rp_penalidad" type="number" min="0" step="0.01" value="0" class="form-control"></div>
<div class="form-group"><label>Tratamiento del ajuste</label><select id="rp_tipo" class="form-control"><option value="COBRAR">Cobrar diferencia</option><option value="SALDO">Saldo pendiente</option><option value="DEVOLUCION">Devolución</option><option value="SALDO_FAVOR">Saldo a favor</option><option value="SIN_AJUSTE">Sin ajuste</option></select></div>
<div class="form-group"><label>Motivo</label><textarea id="rp_motivo" class="form-control" rows="2"></textarea></div>
<div id="rp_error" class="text-danger"></div></div><div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancelar</button><button class="btn btn-warning" onclick="confirmarReprogramacion()"><i class="fa fa-check"></i> Reprogramar</button></div></div></div></div>
<script>
function esc(s){return $('<div>').text(s==null?'':s).html();}
function verPasaje(id){$('#detallePasaje').html('Cargando...');$('#modalDetalle').modal('show');$.getJSON('<?php echo site_url('transporte/pasaje_detalle/'); ?>'+id,function(r){if(!r.ok){$('#detallePasaje').html('<div class="alert alert-danger">'+esc(r.mensaje)+'</div>');return;}var p=r.pasaje;$('#detallePasaje').html('<table class="table table-bordered"><tr><th>Pasaje</th><td>'+esc(p.pasaje_numero||p.pasaje_id)+'</td></tr><tr><th>Pasajero</th><td>'+esc(p.pasaje_nombre)+'</td></tr><tr><th>CI</th><td>'+esc(p.pasaje_documento)+'</td></tr><tr><th>Teléfono</th><td>'+esc(p.pasaje_telefono)+'</td></tr><tr><th>Ruta</th><td>'+esc(p.ruta_nombre)+'</td></tr><tr><th>Salida</th><td>'+esc(p.viaje_fechasalida)+' '+esc(p.viaje_horasalida)+'</td></tr><tr><th>Asiento</th><td>'+esc(p.asiento_numero)+'</td></tr><tr><th>Importe</th><td>Bs '+Number(p.pasaje_precio||0).toFixed(2)+'</td></tr><tr><th>Estado</th><td>'+esc(p.estado_descripcion||p.estado_id)+'</td></tr></table>');});}
function normalizarTelefono(t){t=(t||'').replace(/\D/g,'');if(t.length===8)t='591'+t;return t;}
function enviarPasajeWhatsApp(p){
 var tel=normalizarTelefono(p.pasaje_telefono||'');
 if(!tel)tel=normalizarTelefono(prompt('Número de WhatsApp del pasajero:','')||'');
 if(!tel)return;

 function abrirWhatsApp(token){
   var url='<?php echo site_url('pasaje_publico/ver/'); ?>'+encodeURIComponent(token);
   var salida=(p.viaje_fechasalida||'')+' '+String(p.viaje_horasalida||'').substr(0,5);
   var msg='Su pasaje '+(p.ruta_nombre||'')+' ha sido confirmado.\nSalida: '+salida+'\nAsiento: '+(p.asiento_numero||'-')+'.\nPasajero: '+(p.pasaje_nombre||'')+'\nPasaje: '+(p.pasaje_numero||p.pasaje_id)+'\n\nVer / descargar pasaje: '+url;
   window.open('https://wa.me/'+tel+'?text='+encodeURIComponent(msg),'_blank');
 }

 if(p.pasaje_qr_token){
   abrirWhatsApp(p.pasaje_qr_token);
   return;
 }

 // Si es un pasaje antiguo/sin QR, generar el token en ese momento.
 $.getJSON('<?php echo site_url('transporte/asegurar_token_pasaje_json/'); ?>'+p.pasaje_id,function(r){
   if(!r || !r.ok || !r.token){
     alert((r && r.mensaje)?r.mensaje:'No se pudo generar el token QR del pasaje.');
     return;
   }
   p.pasaje_qr_token=r.token;
   abrirWhatsApp(r.token);
 }).fail(function(){
   alert('No se pudo generar el token QR del pasaje.');
 });
}
function abrirReprogramacion(id){$('#rp_origen').val(id);$('#rp_error').text('');$('#rp_viaje').html('<option>Cargando...</option>');$('#rp_destino').empty();$('#modalReprogramar').modal('show');$.post('<?php echo site_url('viaje/buscar_viajes_reprogramacion'); ?>',{pasaje_id:id},function(r){if(typeof r==='string')try{r=JSON.parse(r)}catch(e){}if(!r.ok){$('#rp_error').text(r.mensaje||'No se pudo cargar la reprogramación.');return;}var a=r.actual||{};$('#rp_info').html('<b>'+esc(a.pasaje_nombre)+'</b> · '+esc(a.ruta_nombre)+' · asiento '+esc(a.asiento_numero)+' · '+esc(a.viaje_fechasalida)+' '+esc(a.viaje_horasalida));var h='<option value="">Seleccione...</option>';(r.viajes||[]).forEach(function(v){h+='<option value="'+v.viaje_id+'">'+esc(v.viaje_fechasalida)+' '+esc((v.viaje_horasalida||'').substr(0,5))+' · '+esc(v.ruta_nombre)+' · libres '+v.asientos_libres+'</option>';});$('#rp_viaje').html(h);if(!(r.viajes||[]).length)$('#rp_error').text('No existen viajes futuros habilitados con asientos libres para esta ruta.');},'json');}
function cargarAsientos(){var v=$('#rp_viaje').val();$('#rp_destino').html('<option>Cargando...</option>');if(!v)return;$.post('<?php echo site_url('viaje/asientos_reprogramacion'); ?>',{viaje_id:v},function(r){var h='<option value="">Seleccione...</option>';if(r.ok)(r.asientos||[]).forEach(function(a){h+='<option value="'+a.pasaje_id+'">Asiento '+esc(a.asiento_numero)+' · Bs '+Number(a.pasaje_precio||0).toFixed(2)+'</option>';});$('#rp_destino').html(h);if(!r.ok)$('#rp_error').text(r.mensaje||'No se pudieron cargar asientos.');},'json');}
function confirmarReprogramacion(){var data={pasaje_origen:$('#rp_origen').val(),pasaje_destino:$('#rp_destino').val(),penalidad:$('#rp_penalidad').val()||0,tipo_ajuste:$('#rp_tipo').val(),mantiene_forma_pago:1,forma_id_ajuste:0,motivo:$('#rp_motivo').val()};if(!data.pasaje_destino||!data.motivo.trim()){alert('Seleccione asiento destino e introduzca el motivo.');return;}if(!confirm('¿Confirma la reprogramación del pasaje?'))return;$.post('<?php echo site_url('viaje/reprogramar_pasaje'); ?>',data,function(r){if(r.ok){alert(r.mensaje);location.reload();}else alert(r.mensaje||'No fue posible reprogramar.');},'json');}
</script>
