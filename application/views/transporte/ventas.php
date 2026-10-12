<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-bus"></i> Ventas de Pasajes / Facturación</h3>
      <div class="box-tools">
        <button class="btn btn-warning btn-sm" onclick="p27_generar_cufd()" title="Generar / actualizar CUFD del punto de venta"><i class="fa fa-download"></i> CUFD</button>
        <a href="<?= base_url('transporte') ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Transporte</a>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-2"><label>Desde</label><input type="date" id="p27_desde" class="form-control" value="<?= date('Y-m-d') ?>"></div>
        <div class="col-md-2"><label>Hasta</label><input type="date" id="p27_hasta" class="form-control" value="<?= date('Y-m-d') ?>"></div>
        <div class="col-md-2"><label>Viaje Nº</label><input type="number" id="p27_viaje" class="form-control" min="0" placeholder="Todos"></div>
        <div class="col-md-2"><label>Estado fiscal</label><select id="p27_estado" class="form-control"><option value="">Todos</option><option value="sin_factura">Sin factura</option><option value="no_enviada">No enviada / rechazada</option><option value="enviada">Enviada</option><option value="anulada">Anulada</option></select></div>
        <div class="col-md-4"><label>Buscar</label><div class="input-group"><input id="p27_q" class="form-control" placeholder="Venta, CI/NIT, cliente, pasaje o factura"><span class="input-group-btn"><button class="btn btn-primary" onclick="p27_buscar(1)"><i class="fa fa-search"></i> Buscar</button></span></div></div>
      </div><br>
      <div class="table-responsive"><table class="table table-condensed table-bordered table-striped">
        <thead><tr><th>Venta</th><th>Fecha</th><th>Viaje</th><th>Cliente / documento</th><th class="text-center">Pasajes</th><th class="text-right">Total</th><th>Factura</th><th>Estado</th><th>Acciones</th></tr></thead>
        <tbody id="p27_lista"><tr><td colspan="9" class="text-center">Cargando...</td></tr></tbody>
      </table></div>
      <div class="row"><div class="col-md-6" id="p27_resumen"></div><div class="col-md-6 text-right" id="p27_paginas"></div></div>
    </div>
  </div>
</div>

<div class="modal fade" id="p27_modal_factura" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content">
 <div class="modal-header bg-primary"><button class="close" data-dismiss="modal">&times;</button><h4>EMITIR FACTURA - PASAJES</h4></div>
 <div class="modal-body">
  <input type="hidden" id="p27_fact_venta_id" value="0">
  <div class="row">
   <div class="col-md-6"><label>DOC. IDENTIDAD</label><select id="p27_fact_tipo_doc" class="form-control" onchange="p27_tipo_doc()"><?php foreach($docs_identidad as $di){ ?><option value="<?= $di['cdi_codigoclasificador'] ?>"><?= $di['cdi_descripcion'] ?></option><?php } ?></select></div>
   <div class="col-md-6"><label>NÚMERO DE DOC.</label><input id="p27_fact_documento" class="form-control"></div>
   <div class="col-md-4" id="p27_box_complemento"><label>COMPLEMENTO</label><input id="p27_fact_complemento" class="form-control" maxlength="20" onkeyup="this.value=this.value.toUpperCase()"></div>
   <div class="col-md-8"><label>RAZÓN SOCIAL</label><input id="p27_fact_razon" class="form-control" onkeyup="this.value=this.value.toUpperCase()"></div>
   <div class="col-md-8"><label>CORREO</label><input id="p27_fact_email" type="email" class="form-control"></div>
   <div class="col-md-4"><label>CÓDIGO CLIENTE</label><input id="p27_fact_codigo" class="form-control" readonly placeholder="Se asignará"></div>
  </div><hr style="margin:10px 0">
  <div id="p27_alerta_integridad"></div>
  <b>DETALLE</b><div class="table-responsive"><table class="table table-condensed"><thead><tr><th>Pasaje</th><th>Asiento</th><th>Descripción</th><th class="text-right">Importe</th></tr></thead><tbody id="p27_fact_detalle"></tbody></table></div>
  <div class="text-right"><b>TOTAL VENTA Bs <span id="p27_fact_total">0.00</span></b></div>
 </div>
 <div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancelar</button><button id="p27_btn_generar" class="btn btn-success" onclick="p27_generar_factura()"><i class="fa fa-save"></i> Generar Factura</button></div>
</div></div></div>

<div class="modal fade" id="p27_modal_rechazo" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content">
 <div class="modal-header bg-red"><button class="close" data-dismiss="modal">&times;</button><h4><i class="fa fa-exclamation-triangle"></i> DETALLE SIAT / RECHAZO</h4></div>
 <div class="modal-body"><div id="p27_rechazo_estado"></div><pre id="p27_rechazo_mensaje" style="white-space:pre-wrap;max-height:330px;overflow:auto"></pre></div>
 <div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
</div></div></div>

<div class="modal fade" id="p27_modal_whatsapp" tabindex="-1" role="dialog"><div class="modal-dialog modal-sm"><div class="modal-content">
 <div class="modal-header bg-green"><button class="close" data-dismiss="modal">&times;</button><h4><i class="fa fa-whatsapp"></i> Enviar factura</h4></div>
 <div class="modal-body"><input type="hidden" id="p27_wp_factura"><label>Número de celular (WhatsApp)</label><input id="p27_wp_celular" class="form-control" placeholder="Ej. 70712345"><small>Se abrirá WhatsApp Web con el enlace al PDF.</small></div>
 <div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancelar</button><button class="btn btn-success" onclick="p27_enviar_whatsapp()"><i class="fa fa-whatsapp"></i> Enviar</button></div>
</div></div></div>

<div class="modal fade" id="p27_modal_anular" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content">
 <div class="modal-header bg-red"><button class="close" data-dismiss="modal">&times;</button><h4><i class="fa fa-ban"></i> ANULAR FACTURA ELECTRÓNICA</h4></div>
 <div class="modal-body">
  <input type="hidden" id="p27_anular_factura_id"><input type="hidden" id="p27_anular_venta_id"><input type="hidden" id="p27_anular_numero">
  <div class="alert alert-warning"><b>Importante:</b> esta acción anula únicamente la factura ante SIAT. La venta de pasajes, los asientos y la caja no se anulan.</div>
  <label>Motivo de anulación</label>
  <select id="p27_anular_motivo" class="form-control"><?php foreach(($motivos_anulacion ?? array()) as $m){ ?><option value="<?= (int)$m['cma_id'] ?>"><?= html_escape($m['cma_descripcion']) ?></option><?php } ?></select>
  <br><div class="checkbox"><label><input type="checkbox" id="p27_anular_escorreo" value="1"> Enviar notificación de anulación por correo</label></div><input id="p27_anular_correo" type="email" class="form-control" placeholder="correo@cliente.com">
 </div>
 <div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancelar</button><button id="p27_btn_anular" class="btn btn-danger" onclick="p27_confirmar_anulacion()"><i class="fa fa-ban"></i> Anular factura</button></div>
</div></div></div>

<div class="modal fade" id="p27_modal_revertir" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content">
 <div class="modal-header bg-yellow"><button class="close" data-dismiss="modal">&times;</button><h4><i class="fa fa-undo"></i> REVERTIR ANULACIÓN DE FACTURA</h4></div>
 <div class="modal-body">
  <input type="hidden" id="p27_revertir_factura_id"><input type="hidden" id="p27_revertir_venta_id"><input type="hidden" id="p27_revertir_numero">
  <div class="alert alert-info">La reversión se procesará ante SIAT. Si se confirma, la factura volverá a su estado fiscal anterior.</div>
  <div class="checkbox"><label><input type="checkbox" id="p27_revertir_escorreo" value="1"> Enviar notificación de reversión por correo</label></div>
  <input id="p27_revertir_correo" type="email" class="form-control" placeholder="correo@cliente.com">
 </div>
 <div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancelar</button><button id="p27_btn_revertir" class="btn btn-warning" onclick="p27_confirmar_reversion()"><i class="fa fa-undo"></i> Revertir anulación</button></div>
</div></div></div>

<script>
var p27_pagina=1;
$(function(){ p27_buscar(1); $('#p27_q').on('keypress',function(e){if(e.which===13)p27_buscar(1);}); });
function p27_esc(v){return $('<div>').text(v==null?'':v).html();}
function p27_buscar(p){
 p27_pagina=p||1;
 $('#p27_lista').html('<tr><td colspan="9" class="text-center"><i class="fa fa-spinner fa-spin"></i> Cargando...</td></tr>');
 $.post('<?= base_url('venta/buscar_operaciones_facturacion_pasaje') ?>',{pagina:p27_pagina,desde:$('#p27_desde').val(),hasta:$('#p27_hasta').val(),viaje_id:$('#p27_viaje').val(),estado:$('#p27_estado').val(),q:$('#p27_q').val()},function(r){
  if(!r||!r.ok){$('#p27_lista').html('<tr><td colspan="9">No fue posible consultar.</td></tr>');return;}
  var h='';
  $.each(r.operaciones||[],function(_,x){
   var fid=parseInt(x.factura_id||0), desc=String(x.factura_codigodescripcion||'').toUpperCase();
   var anulada=fid&&parseInt(x.factura_estado_id||0)===3;
   var enviada=fid&&!anulada&&(parseInt(x.factura_enviada||0)===1||parseInt(x.factura_codigoestado||0)===908||desc==='VALIDADA');
   var rechazada=fid&&!anulada&&!enviada&&(desc!==''||String(x.factura_mensajeslist||'')!=='');
   var est=!fid?'SIN FACTURA':(anulada?'ANULADA':(enviada?'VALIDADA':(desc||'NO ENVIADA')));
   var badge=!fid?'label-default':(anulada?'label-warning':(enviada?'label-success':'label-danger'));
   h+='<tr id="p27_row_'+x.venta_id+'"><td><b>#'+x.venta_id+'</b></td><td>'+p27_esc(x.venta_fecha)+' '+p27_esc(x.venta_hora)+'</td><td>#'+p27_esc(x.viaje_id)+'</td><td><b>'+p27_esc(x.facturacion_razon_social||'SIN NOMBRE')+'</b><br><small>'+p27_esc(x.facturacion_documento||'')+(x.cliente_codigo?' · Cod. '+p27_esc(x.cliente_codigo):'')+'</small></td><td class="text-center">'+x.pasajes+'</td><td class="text-right">'+Number(x.venta_total||0).toFixed(2)+'</td><td>'+(fid?'#'+p27_esc(x.factura_numero):'-')+'</td><td><span class="label '+badge+'">'+p27_esc(est)+'</span><div id="p27_proc_'+x.venta_id+'"></div></td><td>';
   if(!fid){h+='<button class="btn btn-xs btn-success" onclick="p27_abrir_factura('+x.venta_id+')"><i class="fa fa-file-text-o"></i> Facturar</button> ';}
   else if(anulada){
    h+='<button class="btn btn-xs btn-default" title="Imprimir factura" onclick="window.open(\'<?= base_url('factura/imprimir_factura_id/') ?>'+fid+'/1\',\'_blank\')"><i class="fa fa-print"></i> Imprimir</button> ';
    h+='<button class="btn btn-xs btn-danger" title="Ver PDF histórico" onclick="window.open(\'<?= base_url('venta/ver_pdf_factura_pasaje/') ?>'+fid+'\',\'_blank\')"><i class="fa fa-file-pdf-o"></i></button> ';
    h+='<button class="btn btn-xs btn-primary" title="Ver XML histórico" onclick="window.open(\'<?= base_url('venta/ver_xml_factura_pasaje/') ?>'+fid+'\',\'_blank\')"><i class="fa fa-code"></i></button> ';
    h+='<button class="btn btn-xs btn-warning" title="Revertir anulación fiscal" onclick="p27_revertir('+x.venta_id+','+fid+',\''+String(x.factura_numero||'').replace(/'/g,'')+'\',\''+p27_js(x.facturacion_email||'')+'\')"><i class="fa fa-undo"></i> Revertir</button> ';
   }else if(enviada){
    h+='<button class="btn btn-xs btn-default" title="Imprimir factura" onclick="window.open(\'<?= base_url('factura/imprimir_factura_id/') ?>'+fid+'/1\',\'_blank\')"><i class="fa fa-print"></i> Imprimir</button> ';
    h+='<button class="btn btn-xs btn-danger" title="Ver PDF" onclick="window.open(\'<?= base_url('venta/ver_pdf_factura_pasaje/') ?>'+fid+'\',\'_blank\')"><i class="fa fa-file-pdf-o"></i></button> ';
    h+='<button class="btn btn-xs btn-primary" title="Ver XML" onclick="window.open(\'<?= base_url('venta/ver_xml_factura_pasaje/') ?>'+fid+'\',\'_blank\')"><i class="fa fa-code"></i></button> ';
    h+='<button class="btn btn-xs btn-success" title="Enviar PDF por WhatsApp" onclick="p27_whatsapp('+fid+',\''+String(x.cliente_celular||'').replace(/'/g,'')+'\')"><i class="fa fa-whatsapp"></i></button> ';
    h+='<button class="btn btn-xs btn-warning" title="Anular factura ante SIAT" onclick="p27_anular('+x.venta_id+','+fid+',\''+String(x.factura_numero||'').replace(/'/g,'')+'\',\''+p27_js(x.facturacion_email||'')+'\')"><i class="fa fa-ban"></i> Anular</button> ';
   }else{
    h+='<button class="btn btn-xs btn-warning" title="Ver motivo de rechazo registrado en factura_mensajeslist" onclick="p27_ver_rechazo('+fid+')"><i class="fa fa-exclamation-triangle"></i> Motivo</button> ';
    h+='<button class="btn btn-xs btn-primary" title="Ver XML generado" onclick="window.open(\'<?= base_url('venta/ver_xml_factura_pasaje/') ?>'+fid+'\',\'_blank\')"><i class="fa fa-code"></i></button> ';
    h+='<button class="btn btn-xs btn-danger" onclick="p27_quitar('+x.venta_id+','+fid+',\''+String(x.factura_numero||'').replace(/'/g,'')+'\')"><i class="fa fa-times"></i> Quitar</button> ';
   }
   h+='<button class="btn btn-xs btn-default" title="Pasaje" onclick="window.open(\'<?= base_url('viaje/imprimir_pasaje/') ?>'+x.venta_id+'\',\'_blank\')"><i class="fa fa-ticket"></i></button></td></tr>';
  });
  $('#p27_lista').html(h||'<tr><td colspan="9" class="text-center">Sin resultados.</td></tr>'); $('#p27_resumen').text(r.total+' operación(es)'); var pg=''; for(var i=Math.max(1,r.pagina-2);i<=Math.min(r.paginas,r.pagina+2);i++)pg+='<button class="btn btn-xs '+(i==r.pagina?'btn-primary':'btn-default')+'" onclick="p27_buscar('+i+')">'+i+'</button> '; $('#p27_paginas').html(pg);
 },'json').fail(function(){$('#p27_lista').html('<tr><td colspan="9" class="text-danger">Error de comunicación.</td></tr>');});
}
function p27_js(v){return String(v==null?'':v).replace(/\\/g,'\\\\').replace(/'/g,"\\'").replace(/\r?\n/g,'\\n');}
function p27_tipo_doc(){var ci=parseInt($('#p27_fact_tipo_doc').val()||0)===1; $('#p27_box_complemento').toggle(ci); if(!ci)$('#p27_fact_complemento').val('');}
function p27_abrir_factura(id){$.getJSON('<?= base_url('venta/datos_facturacion_pasaje/') ?>'+id,function(r){if(!r||!r.ok){alert(r&&r.mensaje?r.mensaje:'No se pudo recuperar la venta.');return;} if(r.factura&&Number(r.factura.factura_id)>0){alert('La venta todavía tiene una factura asociada.');return;} var v=r.venta||{}, h='', suma=0; $.each(r.pasajes||[],function(_,p){suma+=Number(p.pasaje_precio||0);h+='<tr><td>'+p27_esc(p.pasaje_numero||p.pasaje_id)+'</td><td>'+p27_esc(p.asiento_numero||'')+'</td><td>'+p27_esc(p.pasaje_origen||'')+' → '+p27_esc(p.pasaje_destino||'')+'</td><td class="text-right">'+Number(p.pasaje_precio||0).toFixed(2)+'</td></tr>';}); $('#p27_fact_venta_id').val(id); $('#p27_fact_tipo_doc').val(v.facturacion_tipo_documento||v.cdi_codigoclasificador||1); $('#p27_fact_documento').val(v.facturacion_documento||v.cliente_nit||v.cliente_ci||''); $('#p27_fact_complemento').val(v.facturacion_complemento||v.cliente_complementoci||''); $('#p27_fact_razon').val(v.facturacion_razon_social||v.cliente_razon||v.cliente_nombre||''); $('#p27_fact_email').val(v.facturacion_email||v.cliente_email||''); $('#p27_fact_codigo').val(v.cliente_codigo||''); $('#p27_fact_detalle').html(h); $('#p27_fact_total').text(Number(v.venta_total||0).toFixed(2)); var cnt=(r.integridad||{}).cantidad||0; $('#p27_alerta_integridad').html(cnt>0?'':'<div class="alert alert-danger">La venta no tiene pasajes activos. No puede facturarse.</div>'); $('#p27_btn_generar').prop('disabled',cnt<=0); p27_tipo_doc(); $('#p27_modal_factura').modal('show');});}
function p27_generar_factura(){
 var id=parseInt($('#p27_fact_venta_id').val()||0), tipo=parseInt($('#p27_fact_tipo_doc').val()||0), doc=$.trim($('#p27_fact_documento').val()), razon=$.trim($('#p27_fact_razon').val()), comp=tipo===1?$.trim($('#p27_fact_complemento').val()):'';
 if(!doc||!razon){alert('Documento y razón social son obligatorios.');return;}
 var b=$('#p27_btn_generar').prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> Procesando factura...');
 $('#p27_proc_'+id).html('<small class="text-info"><i class="fa fa-spinner fa-spin"></i> Procesando envío al SIAT...</small>');
 $.post('<?= base_url('venta/guardar_cliente_facturacion_pasaje') ?>',{venta_id:id,tipoDocumento:tipo,documento:doc,razon:razon,email:$('#p27_fact_email').val(),complemento:comp},function(g){
  if(!g||!g.ok){alert(g&&g.mensaje?g.mensaje:'No fue posible guardar el cliente.');p27_fin_proceso(b,id);return;}
  $('#p27_fact_codigo').val(g.cliente_codigo||'');
  $.ajax({url:'<?= base_url('venta/factura_pasaje') ?>',type:'POST',dataType:'json',data:{venta_id:id,numeroDocumento:doc,razon:razon,monto_factura:Number($('#p27_fact_total').text()||0),tipoDocumento:tipo,complemento:comp,cliente_email:$('#p27_fact_email').val()},success:function(r){
   if(r&&r.ok===false){alert(r.mensaje||'No fue posible generar la factura.');return;}
   $('#p27_modal_factura').modal('hide'); p27_buscar(p27_pagina);
  },error:function(){alert('Error al procesar la factura. La venta y los asientos permanecen registrados. Consulte el estado fiscal antes de reintentar.');},complete:function(){p27_fin_proceso(b,id);}});
 },'json').fail(function(){alert('Error al guardar los datos fiscales.');p27_fin_proceso(b,id);});
}
function p27_fin_proceso(b,id){b.prop('disabled',false).html('<i class="fa fa-save"></i> Generar Factura');$('#p27_proc_'+id).empty();}
function p27_ver_rechazo(fid){
 $('#p27_rechazo_estado').html('<p><i class="fa fa-spinner fa-spin"></i> Consultando factura...</p>');
 $('#p27_rechazo_mensaje').text('');
 $('#p27_modal_rechazo').modal('show');
 $.getJSON('<?= base_url('venta/detalle_siat_factura_pasaje/') ?>'+fid,function(r){
   if(!r||!r.ok){$('#p27_rechazo_estado').html('<p class="text-danger">'+p27_esc(r&&r.mensaje?r.mensaje:'No se pudo consultar la factura.')+'</p>');return;}
   var f=r.factura||{};
   var estado=f.factura_codigodescripcion||'NO ENVIADA';
   var cab='<p><b>Factura:</b> #'+p27_esc(f.factura_numero||f.factura_id)+' &nbsp; <b>Estado:</b> '+p27_esc(estado);
   if(f.factura_codigorecepcion)cab+=' &nbsp; <b>Recepción:</b> '+p27_esc(f.factura_codigorecepcion);
   cab+='</p><p><b>Motivo registrado en factura.factura_mensajeslist:</b></p>';
   $('#p27_rechazo_estado').html(cab);
   $('#p27_rechazo_mensaje').text(f.factura_mensajeslist||'SIAT no dejó un motivo registrado en factura_mensajeslist.');
 }).fail(function(){
   $('#p27_rechazo_estado').html('<p class="text-danger">Error al consultar factura_mensajeslist.</p>');
 });
}
function p27_generar_cufd(){
 var pv=<?= (int)$puntoventa_codigo ?>;
 if(!pv && pv!==0){alert('No se pudo determinar el punto de venta.');return;}
 if(!confirm('¿Generar/actualizar el CUFD para el punto de venta '+pv+'?\n\nEl nuevo CUFD reemplazará al vigente para este punto de venta.'))return;
 var btn=$('button[onclick="p27_generar_cufd()"]');
 var original=btn.html(); btn.prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> Generando CUFD...');
 $.ajax({
   url:'<?= base_url('dosificacion/cufd') ?>',type:'POST',dataType:'json',data:{punto_venta:pv},
   success:function(datos){
     var falla=datos?datos.falla:null, registros=datos?datos.respuesta:null;
     if(falla!=='' && falla!==null && typeof falla!=='undefined'){
       alert('No se pudo generar el C.U.F.D.\n\n'+p27_respuesta_siat(falla)); return;
     }
     if(!registros || !registros.RespuestaCufd){alert('SIAT devolvió una respuesta CUFD inválida.\n'+p27_respuesta_siat(datos));return;}
     var c=registros.RespuestaCufd;
     if(c.transaccion!==true){alert('SIAT rechazó la solicitud de CUFD.\n'+p27_respuesta_siat(c.mensajesList||c));return;}
     $.ajax({
       url:'<?= base_url('dosificacion/almacenarcufd') ?>',type:'POST',dataType:'json',
       data:{codigo:c.codigo,codigoControl:c.codigoControl,direccion:c.direccion,fechavigencia:c.fechaVigencia,transaccion:c.transaccion,punto_venta:pv},
       success:function(){alert('C.U.F.D. generado y almacenado correctamente.\nVigencia: '+(c.fechaVigencia||''));},
       error:function(x){alert('El SIAT generó el CUFD, pero Ximpleman no pudo almacenarlo.\n'+(x.responseText||''));}
     });
   },
   error:function(x){alert('Error al solicitar el CUFD al servidor/SIAT.\n'+(x.responseText||''));},
   complete:function(){btn.prop('disabled',false).html(original);}
 });
}
function p27_whatsapp(fid,cel){$('#p27_wp_factura').val(fid);$('#p27_wp_celular').val(cel||'');$('#p27_modal_whatsapp').modal('show');}
function p27_enviar_whatsapp(){
 var fid=$('#p27_wp_factura').val(), cel=$.trim($('#p27_wp_celular').val()); if(cel.length<5){alert('Ingrese un número válido.');return;}
 $.post('<?= base_url('venta/enviar_factura_wp_pasaje') ?>',{factura_id:fid,cliente_celular:cel},function(r){if(!r||!r.ok){alert(r&&r.mensaje?r.mensaje:'No fue posible preparar WhatsApp.');return;}$('#p27_modal_whatsapp').modal('hide');window.open(r.url,'_blank');},'json');
}
function p27_anular(venta,factura,num,correo){
 $('#p27_anular_venta_id').val(venta);$('#p27_anular_factura_id').val(factura);$('#p27_anular_numero').val(num);$('#p27_anular_correo').val(correo||'');$('#p27_anular_escorreo').prop('checked',!!$.trim(correo||''));$('#p27_modal_anular').modal('show');
}
function p27_confirmar_anulacion(){
 var venta=parseInt($('#p27_anular_venta_id').val()||0), fid=parseInt($('#p27_anular_factura_id').val()||0), num=$('#p27_anular_numero').val();
 if(!confirm('¿Confirma ANULAR ante SIAT la factura Nº '+num+'?\n\nLa venta de pasajes y los asientos permanecerán intactos.'))return;
 var b=$('#p27_btn_anular').prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> Anulando...');
 $.ajax({url:'<?= base_url('factura/anular_factura/') ?>'+fid+'/'+num,type:'POST',dataType:'json',data:{motivo_id:$('#p27_anular_motivo').val(),factura_correo:$('#p27_anular_escorreo').is(':checked')?$.trim($('#p27_anular_correo').val()):'',borrar_venta:0},success:function(r){
   if(r&&r.transaccion===true){$('#p27_modal_anular').modal('hide');alert('Factura anulada correctamente ante SIAT. La venta de pasajes permanece vigente.');p27_buscar(p27_pagina);}
   else{alert('SIAT no confirmó la anulación.\n'+p27_respuesta_siat(r));}
 },error:function(x){alert('No fue posible completar la anulación fiscal. Revise la conexión/SIAT antes de reintentar.');},complete:function(){b.prop('disabled',false).html('<i class="fa fa-ban"></i> Anular factura');}});
}
function p27_revertir(venta,fid,num,correo){
 $('#p27_revertir_venta_id').val(venta);$('#p27_revertir_factura_id').val(fid);$('#p27_revertir_numero').val(num);$('#p27_revertir_correo').val(correo||'');$('#p27_revertir_escorreo').prop('checked',!!$.trim(correo||''));$('#p27_modal_revertir').modal('show');
}
function p27_confirmar_reversion(){
 var venta=parseInt($('#p27_revertir_venta_id').val()||0), fid=parseInt($('#p27_revertir_factura_id').val()||0), num=$('#p27_revertir_numero').val(), enviar=$('#p27_revertir_escorreo').is(':checked'), correo=$.trim($('#p27_revertir_correo').val());
 if(enviar&&!correo){alert('Ingrese el correo al que se enviará la notificación.');return;}
 if(!confirm('¿Confirma REVERTIR la anulación de la factura Nº '+num+' ante SIAT?'))return;
 var b=$('#p27_btn_revertir').prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> Revirtiendo...');
 $.ajax({url:'<?= base_url('factura/revertir_anulacion') ?>',type:'POST',dataType:'json',data:{factura_id:fid,venta_id:venta,motivo_id:0,escorreo:enviar?1:0,factura_correo:enviar?correo:''},success:function(r){
   if(r&&r.transaccion===true){$('#p27_modal_revertir').modal('hide');alert('Anulación revertida correctamente.'+(enviar?' Se solicitó el envío de la notificación por correo.':''));p27_buscar(p27_pagina);}
   else{alert('SIAT no confirmó la reversión.\n'+p27_respuesta_siat(r));}
 },error:function(){alert('No fue posible completar la reversión. Revise la conexión/SIAT.');},complete:function(){b.prop('disabled',false).html('<i class="fa fa-undo"></i> Revertir anulación');}});
}
function p27_respuesta_siat(r){try{return JSON.stringify(r&&r.mensajesList?r.mensajesList:r,null,2);}catch(e){return String(r||'Sin detalle');}}
function p27_quitar(venta,factura,num){if(!confirm('¿Quitar la factura Nº '+num+' NO ENVIADA/RECHAZADA?'))return; $.post('<?= base_url('venta/quitar_factura_pasaje_noenviada') ?>',{venta_id:venta,factura_id:factura},function(r){if(!r||!r.ok){alert(r&&r.mensaje?r.mensaje:'No fue posible quitarla.');return;} p27_buscar(p27_pagina); p27_abrir_factura(venta);},'json');}
</script>
