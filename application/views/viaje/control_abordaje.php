<?php
$dv=!empty($datos_viaje[0])?$datos_viaje[0]:array();
$vid=isset($dv['viaje_id'])?(int)$dv['viaje_id']:0;
$ruta=isset($dv['ruta_nombre'])?$dv['ruta_nombre']:'';
$fecha=isset($dv['viaje_fechasalida'])?$dv['viaje_fechasalida']:'';
$hora=isset($dv['viaje_horasalida'])?$dv['viaje_horasalida']:'';
$res=isset($resumen_abordaje)?$resumen_abordaje:array();
$terminal=isset($terminal_usuario['terminal'])?$terminal_usuario['terminal']:'TERMINAL';
?>
<style>
.ab-wrap{font-family:Arial,sans-serif}.ab-hero{background:#1f4e79;color:#fff;padding:15px 18px;border-radius:5px;margin-bottom:14px}.ab-hero h3{margin:0 0 5px}.ab-stat{border:1px solid #ddd;border-radius:5px;padding:10px;text-align:center;background:#fff}.ab-stat b{display:block;font-size:22px}.ab-search{background:#f7f7f7;border:1px solid #ddd;padding:14px;border-radius:5px;margin:14px 0}.ab-result{border:2px solid #ddd;border-radius:6px;padding:13px;margin:10px 0;background:#fff}.ab-ok{border-color:#00a65a;background:#effcf5}.ab-dup{border-color:#dd4b39;background:#fff2f0}.ab-name{font-size:20px;font-weight:bold}.ab-seat{font-size:18px;font-weight:bold}.scanner-input{font-size:18px;height:44px}.ab-message{padding:18px;border-radius:6px;text-align:center;font-size:18px;font-weight:bold;display:none;margin:12px 0}.ab-message.ok{display:block;background:#00a65a;color:#fff}.ab-message.bad{display:block;background:#dd4b39;color:#fff}
</style>
<div class="ab-wrap">
<div class="ab-hero"><h3><i class="fa fa-qrcode"></i> CONTROL DE ABORDAJE</h3><div><b><?php echo htmlspecialchars($ruta,ENT_QUOTES,'UTF-8'); ?></b> &nbsp; <?php echo htmlspecialchars($fecha.' '.$hora,ENT_QUOTES,'UTF-8'); ?> &nbsp; VIAJE Nº <?php echo $vid; ?></div></div>
<?php if(empty($puede_registrar_abordaje)){ ?><div class="alert alert-warning"><i class="fa fa-lock"></i> El viaje no está en <b>EMBARQUE</b>. El módulo queda disponible solo para consulta.</div><?php } ?>
<div class="row">
 <div class="col-sm-3"><div class="ab-stat">Vendidos<b id="ab_vendidos"><?php echo (int)($res['vendidos']??0); ?></b></div></div>
 <div class="col-sm-3"><div class="ab-stat">A bordo<b id="ab_abordaron"><?php echo (int)($res['abordaron']??0); ?></b></div></div>
 <div class="col-sm-3"><div class="ab-stat">Pendientes<b id="ab_pendientes"><?php echo (int)($res['pendientes']??0); ?></b></div></div>
 <div class="col-sm-3"><div class="ab-stat">No presentes<b id="ab_no_presentes"><?php echo (int)($res['no_presentes']??0); ?></b></div></div>
</div>
<div class="ab-search">
 <div class="row">
  <div class="col-sm-3"><label>Buscar por</label><select id="ab_tipo" class="form-control"><option value="QR">QR / CÓDIGO ABORDAJE</option><option value="PASAJE">NÚMERO DE PASAJE</option><option value="CI">C.I.</option><option value="APELLIDO">APELLIDO / NOMBRE</option><option value="ASIENTO">ASIENTO</option></select></div>
  <div class="col-sm-6"><label>Escanee o escriba</label><input id="ab_criterio" class="form-control scanner-input" autocomplete="off" placeholder="Escanee el QR o escriba el dato"></div>
  <div class="col-sm-3"><label>Terminal / puerta</label><input id="ab_terminal" class="form-control" value="<?php echo htmlspecialchars($terminal,ENT_QUOTES,'UTF-8'); ?>"><button class="btn btn-primary btn-block" style="margin-top:7px" onclick="buscarAbordaje()"><i class="fa fa-search"></i> BUSCAR</button></div>
 </div>
 <small class="text-muted"><i class="fa fa-info-circle"></i> Los lectores QR USB/Bluetooth funcionan como teclado: enfoque el campo y escanee. Al presionar Enter se realiza la búsqueda.</small>
</div>
<div id="ab_mensaje" class="ab-message"></div><div id="ab_resultados"></div>
<div class="text-right">
    <a href="<?php echo site_url('viaje'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver a viajes</a>
    <button type="button" class="btn btn-danger" onclick="window.close();"><i class="fa fa-times"></i> Cerrar</button>
</div>
</div>
<script>
(function(){var c=document.getElementById('ab_criterio'); if(c){c.focus();c.addEventListener('keydown',function(e){if(e.key==='Enter'){e.preventDefault();buscarAbordaje();}});} })();
function h(x){return $('<div>').text(x==null?'':x).html();}
function actualizarResumen(r){if(!r)return; $('#ab_vendidos').text(r.vendidos||0);$('#ab_abordaron').text(r.abordaron||0);$('#ab_pendientes').text(r.pendientes||0);$('#ab_no_presentes').text(r.no_presentes||0);}
function msg(txt,ok){var x=$('#ab_mensaje');x.removeClass('ok bad').addClass(ok?'ok':'bad').html(txt).show();setTimeout(function(){x.fadeOut();},5000);}
function buscarAbordaje(){var criterio=$.trim($('#ab_criterio').val());if(!criterio){msg('Ingrese o escanee un dato.',false);return;} $('#ab_resultados').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');$.post('<?php echo site_url('viaje/buscar_control_abordaje'); ?>',{viaje_id:<?php echo $vid; ?>,tipo:$('#ab_tipo').val(),criterio:criterio},function(r){if(!r||!r.ok){msg(r&&r.mensaje?r.mensaje:'No se pudo realizar la búsqueda.',false);$('#ab_resultados').empty();return;} actualizarResumen(r.resumen);renderResultados(r.resultados||[],r.puede_registrar);},'json').fail(function(){msg('Error de comunicación con el servidor.',false);});}
function renderResultados(rows,puede){if(!rows.length){$('#ab_resultados').html('<div class="alert alert-warning"><i class="fa fa-search"></i> No se encontró un pasajero vendido que coincida con la búsqueda.</div>');return;}var z='';rows.forEach(function(x){var ya=!!x.abordaje_id;z+='<div class="ab-result '+(ya?'ab-dup':'ab-ok')+'"><div class="row"><div class="col-sm-8"><div style="font-size:18px;color:#00a65a;font-weight:bold"><i class="fa fa-check-circle"></i> PASAJE VÁLIDO</div><div class="ab-name">'+h(x.pasaje_nombre||'SIN NOMBRE')+'</div><div class="ab-seat">ASIENTO '+h(x.asiento_numero)+' &nbsp; · &nbsp; PASAJE '+h(x.pasaje_numero||x.pasaje_id)+'</div><div><b>'+h(x.ruta_nombre)+'</b></div><div><b>FECHA:</b> '+h(x.viaje_fechasalida||'-')+' &nbsp; <b>HORA:</b> '+h((x.viaje_horasalida||'').substr(0,5))+'</div><div>CI: '+h(x.pasaje_documento||'-')+' &nbsp; Tel: '+h(x.pasaje_telefono||'-')+'</div>'+(ya?'<div class="text-danger"><b>PASAJERO YA REGISTRADO – '+h((x.abordaje_hora||'').substr(0,5))+'</b> · '+h(x.abordaje_terminal||'')+'</div>':'')+'</div><div class="col-sm-4 text-right">';if(!ya&&puede){z+='<button class="btn btn-success btn-lg btn-block" onclick="confirmarAbordaje('+parseInt(x.pasaje_id,10)+')"><i class="fa fa-check-circle"></i> ABORDAR</button><button class="btn btn-default btn-sm btn-block" onclick="noPresente('+parseInt(x.pasaje_id,10)+')">NO PRESENTE</button>';}else if(ya){z+='<span class="label label-danger" style="font-size:14px">YA ABORDÓ</span>';}z+='</div></div></div>';});$('#ab_resultados').html(z);}
function confirmarAbordaje(id){$.post('<?php echo site_url('viaje/confirmar_abordaje'); ?>',{pasaje_id:id,viaje_id:<?php echo $vid; ?>,terminal:$('#ab_terminal').val()},function(r){if(r.ok){msg('<i class="fa fa-check-circle"></i> ✓ ABORDADO<br><span style="font-size:24px">'+h(r.pasajero)+'</span><br>ASIENTO '+h(r.asiento)+'<br>'+h(r.ruta),true);actualizarResumen(r.resumen);$('#ab_criterio').val('').focus();$('#ab_resultados').empty();}else{msg(r.mensaje||'No se pudo registrar.',false);buscarAbordaje();}},'json').fail(function(){msg('Error de comunicación.',false);});}
function noPresente(id){if(!confirm('¿Marcar pasajero como NO PRESENTE?'))return;$.post('<?php echo site_url('viaje/marcar_no_presente_abordaje'); ?>',{pasaje_id:id,viaje_id:<?php echo $vid; ?>},function(r){if(r.ok){actualizarResumen(r.resumen);buscarAbordaje();}else msg(r.mensaje||'No se pudo actualizar.',false);},'json');}
</script>
