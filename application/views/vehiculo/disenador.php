<?php
$vehiculo_id=(int)$vehiculo['vehiculo_id'];
$filas=max(6,(int)($vehiculo['vehiculo_mapa_filas']??15));
$columnas=max(3,(int)($vehiculo['vehiculo_mapa_columnas']??5));
$pisos=max(1,min(2,(int)($vehiculo['vehiculo_pisos']??1)));
?>
<style>
.dv-wrap{padding:12px;font-family:Arial,sans-serif}
.dv-head,.dv-card{background:#fff;border:1px solid #d8e0e6;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.dv-head{padding:12px 14px;margin-bottom:10px}
.dv-title{font-size:17px;font-weight:bold;color:#244d71}
.dv-sub{font-size:11px;color:#6d7880;margin-top:3px}
.dv-toolbar{display:grid;grid-template-columns:120px 120px 120px 1fr;gap:8px;align-items:end;margin-top:10px}
.dv-toolbar label{font-size:10px;font-weight:bold;text-transform:uppercase}
.dv-palette{display:flex;gap:6px;flex-wrap:wrap;padding:10px}
.dv-tool{width:84px;min-height:58px;border:1px solid #ccd4db;border-radius:5px;background:#f9fbfc;text-align:center;padding:6px 3px;cursor:pointer;font-size:9px}
.dv-tool i{display:block;font-size:20px;color:#315e86;margin-bottom:4px}
.dv-tool.active{background:#e9f5ff;border-color:#3c8dbc;box-shadow:0 0 0 2px rgba(60,141,188,.12)}
.dv-layout{display:grid;grid-template-columns:1fr 260px;gap:10px;margin-top:10px}
.dv-bus{background:#fff;border:1px solid #d8e0e6;border-radius:55px 55px 10px 10px;padding:16px;overflow:auto}
.dv-grid{display:grid;gap:5px;justify-content:center}
.dv-cell{width:72px;height:64px;border:1px dashed #cbd3d9;border-radius:5px;background:#f8fafb;display:flex;align-items:center;justify-content:center;text-align:center;cursor:pointer;position:relative}
.dv-cell:hover{border-color:#3c8dbc;background:#f1f8fc}
.dv-cell.occupied{border-style:solid}
.dv-cell.sellable{background:#e4f5e8;border-color:#76c58b}
.dv-cell.service{background:#eceff1;border-color:#aeb7bd}
.dv-cell.cama{background:#fff0dd;border-color:#e3a45e}
.dv-cell.leito{background:#ece8ff;border-color:#9e90d4}
.dv-cell .dv-icon{font-size:18px;display:block;margin-bottom:3px}
.dv-cell .dv-name{font-size:10px;font-weight:bold}
.dv-cell .dv-type{font-size:7px;color:#69747c}
.dv-del{position:absolute;right:2px;top:2px;width:16px;height:16px;border-radius:50%;border:0;background:#d9534f;color:#fff;font-size:9px;line-height:14px;padding:0}
.dv-side{display:flex;flex-direction:column;gap:10px}
.dv-card{padding:12px}
.dv-card h4{font-size:12px;font-weight:bold;margin:0 0 8px;color:#294e70}
.dv-note{font-size:10px;color:#69747c;line-height:15px}
.dv-count{font-size:22px;font-weight:bold;color:#1673aa}
@media(max-width:900px){.dv-layout{grid-template-columns:1fr}.dv-toolbar{grid-template-columns:1fr 1fr}.dv-side{display:grid;grid-template-columns:1fr 1fr}}
@media(max-width:600px){.dv-wrap{padding:6px}.dv-toolbar{grid-template-columns:1fr}.dv-palette{display:grid;grid-template-columns:repeat(3,1fr)}.dv-tool{width:auto}.dv-cell{width:58px;height:56px}.dv-grid{gap:3px}.dv-side{display:block}.dv-card{margin-bottom:8px}}
</style>

<div class="dv-wrap">
  <div class="dv-head">
    <div class="pull-right">
      <a href="<?php echo site_url('vehiculo/disenador'); ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Vehículos</a>
    </div>
    <div class="dv-title"><i class="fa fa-bus"></i> DISEÑADOR — <?php echo htmlspecialchars($vehiculo['vehiculo_placa'],ENT_QUOTES,'UTF-8'); ?></div>
    <div class="dv-sub">Configure visualmente la distribución del vehículo.</div>

    <div class="dv-toolbar">
      <div><label>Filas</label><input id="dv_filas" type="number" class="form-control input-sm" min="6" max="30" value="<?php echo $filas; ?>"></div>
      <div><label>Columnas</label><input id="dv_columnas" type="number" class="form-control input-sm" min="3" max="8" value="<?php echo $columnas; ?>"></div>
      <div><label>Pisos</label><select id="dv_pisos" class="form-control input-sm"><option value="1" <?php echo $pisos==1?'selected':''; ?>>1 Piso</option><option value="2" <?php echo $pisos==2?'selected':''; ?>>2 Pisos</option></select></div>
      <div>
        <button class="btn btn-primary btn-sm" onclick="guardarConfig()"><i class="fa fa-save"></i> GUARDAR TAMAÑO</button>
        <button id="dv_piso1" class="btn btn-info btn-sm" onclick="cambiarPiso(1)">PISO 1</button>
        <button id="dv_piso2" class="btn btn-default btn-sm" onclick="cambiarPiso(2)" <?php echo $pisos<2?'style="display:none"':''; ?>>PISO 2</button>
      </div>
    </div>
  </div>

  <div class="dv-card">
    <div class="dv-palette" id="dv_palette">
      <div class="dv-tool active" data-type="ASIENTO_NORMAL"><i class="fa fa-user"></i>Asiento</div>
      <div class="dv-tool" data-type="CAMA"><i class="fa fa-bed"></i>Cama</div>
      <div class="dv-tool" data-type="LEITO"><i class="fa fa-bed"></i>Leito</div>
      <div class="dv-tool" data-type="PASILLO"><i class="fa fa-arrows-v"></i>Pasillo</div>
      <div class="dv-tool" data-type="BANO"><i class="fa fa-male"></i>Baño</div>
      <div class="dv-tool" data-type="ESCALERA"><i class="fa fa-sort-amount-asc"></i>Escalera</div>
      <div class="dv-tool" data-type="CONDUCTOR"><i class="fa fa-taxi"></i>Conductor</div>
      <div class="dv-tool" data-type="RELEVO"><i class="fa fa-user"></i>Relevo</div>
      <div class="dv-tool" data-type="PUERTA"><i class="fa fa-sign-out"></i>Puerta</div>
      <div class="dv-tool" data-type="TV"><i class="fa fa-television"></i>TV</div>
      <div class="dv-tool" data-type="ESPACIO_VACIO"><i class="fa fa-square-o"></i>Vacío</div>
    </div>
  </div>

  <div class="dv-layout">
    <div class="dv-bus"><div id="dv_grid" class="dv-grid"></div></div>

    <div class="dv-side">
      <div class="dv-card">
        <h4>RESUMEN</h4>
        <div class="row text-center">
          <div class="col-xs-6"><div id="dv_vendibles" class="dv-count">0</div><div class="dv-note">VENDIBLES</div></div>
          <div class="col-xs-6"><div id="dv_elementos" class="dv-count">0</div><div class="dv-note">ELEMENTOS</div></div>
        </div>
      </div>

      <div class="dv-card">
        <h4>USO</h4>
        <div class="dv-note">Seleccione un elemento y luego una celda. Para asiento, cama o leito se solicitará el número. Los demás elementos no generan pasajes.</div>
      </div>
    </div>
  </div>
</div>

<script>
var DV_VEHICULO=<?php echo $vehiculo_id; ?>;
var DV_PISO=1;
var DV_TIPO='ASIENTO_NORMAL';
var DV_DATA=[];
var DV_ICON={
 'ASIENTO_NORMAL':'fa-user','CAMA':'fa-bed','LEITO':'fa-bed','PASILLO':'fa-arrows-v',
 'BANO':'fa-male','ESCALERA':'fa-sort-amount-asc','CONDUCTOR':'fa-taxi','RELEVO':'fa-user',
 'PUERTA':'fa-sign-out','TV':'fa-television','ESPACIO_VACIO':'fa-square-o'
};

$('#dv_palette').on('click','.dv-tool',function(){
  $('.dv-tool').removeClass('active');
  $(this).addClass('active');
  DV_TIPO=$(this).data('type');
});

function etiqueta(t){
 return {'ASIENTO_NORMAL':'ASIENTO','CAMA':'CAMA','LEITO':'LEITO','PASILLO':'PASILLO','BANO':'BAÑO','ESCALERA':'ESCALERA','CONDUCTOR':'CONDUCTOR','RELEVO':'RELEVO','PUERTA':'PUERTA','TV':'TV','ESPACIO_VACIO':'VACÍO'}[t]||t;
}
function esc(x){return $('<div>').text(x==null?'':x).html();}
function cambiarPiso(p){
  DV_PISO=p;
  $('#dv_piso1,#dv_piso2').removeClass('btn-info').addClass('btn-default');
  $('#dv_piso'+p).removeClass('btn-default').addClass('btn-info');
  renderGrid();
}
function buscar(x,y){
 return DV_DATA.find(function(e){return Number(e.nivel_id)===DV_PISO && Number(e.asiento_x)===x && Number(e.asiento_y)===y;});
}
function cargar(){
 $.getJSON('<?php echo site_url('vehiculo/datos_mapa/'.$vehiculo_id); ?>',function(r){
  if(!r.ok){alert(r.mensaje||'No se pudo cargar.');return;}
  DV_DATA=r.elementos||[];
  $('#dv_filas').val(r.config.filas);
  $('#dv_columnas').val(r.config.columnas);
  $('#dv_pisos').val(r.config.pisos);
  $('#dv_piso2').toggle(Number(r.config.pisos)>1);
  renderGrid();
 });
}
function renderGrid(){
 var filas=Math.max(6,Number($('#dv_filas').val()||15));
 var cols=Math.max(3,Number($('#dv_columnas').val()||5));
 var g=$('#dv_grid').css('grid-template-columns','repeat('+cols+',72px)').empty();
 var vend=0,elem=0;
 DV_DATA.forEach(function(e){if(Number(e.nivel_id)===DV_PISO){elem++;if(Number(e.asiento_es_vendible)===1)vend++;}});
 $('#dv_vendibles').text(vend);$('#dv_elementos').text(elem);

 for(var y=0;y<filas;y++){
  for(var x=0;x<cols;x++){
   var e=buscar(x,y);
   var c=$('<div class="dv-cell">').attr({'data-x':x,'data-y':y});
   if(e){
    var t=e.asiento_tipo_elemento||'ASIENTO_NORMAL';
    c.addClass('occupied '+(Number(e.asiento_es_vendible)===1?'sellable':'service'));
    if(t==='CAMA')c.addClass('cama');
    if(t==='LEITO')c.addClass('leito');
    c.html("<div><i class='fa "+(DV_ICON[t]||'fa-square-o')+" dv-icon'></i><div class='dv-name'>"+esc(e.asiento_numero||etiqueta(t))+"</div><div class='dv-type'>"+esc(etiqueta(t))+"</div></div><button class='dv-del'>×</button>");
    c.data('item',e);
   }else{
    c.html('<span style="color:#c7cfd6;font-size:18px">+</span>');
   }
   g.append(c);
  }
 }
}

$('#dv_grid').on('click','.dv-cell',function(ev){
 if($(ev.target).hasClass('dv-del'))return;
 var x=Number($(this).data('x')),y=Number($(this).data('y')),actual=$(this).data('item')||null;
 var tipo=DV_TIPO,vendible=['ASIENTO_NORMAL','CAMA','LEITO'].indexOf(tipo)>=0,numero='';
 if(vendible){
   numero=prompt('Número/identificador del asiento:',actual&&Number(actual.asiento_es_vendible)===1?actual.asiento_numero:'');
   if(numero===null)return;
   numero=$.trim(numero);
   if(!numero){alert('Ingrese número de asiento.');return;}
 }
 $.post('<?php echo site_url('vehiculo/guardar_elemento_mapa'); ?>',{
   asiento_id:actual?actual.asiento_id:0,vehiculo_id:DV_VEHICULO,nivel_id:DV_PISO,x:x,y:y,tipo:tipo,numero:numero
 },function(r){if(r.ok)cargar();else alert(r.mensaje||'No se pudo guardar.');},'json');
});

$('#dv_grid').on('click','.dv-del',function(ev){
 ev.stopPropagation();
 var e=$(this).closest('.dv-cell').data('item');
 if(!e||!confirm('¿Quitar este elemento?'))return;
 $.post('<?php echo site_url('vehiculo/eliminar_elemento_mapa'); ?>',{asiento_id:e.asiento_id},function(r){
   if(r.ok)cargar();else alert(r.mensaje||'No se pudo eliminar.');
 },'json');
});

function guardarConfig(){
 $.post('<?php echo site_url('vehiculo/guardar_configuracion_mapa'); ?>',{
   vehiculo_id:DV_VEHICULO,filas:$('#dv_filas').val(),columnas:$('#dv_columnas').val(),pisos:$('#dv_pisos').val()
 },function(r){
   if(r.ok){
     $('#dv_piso2').toggle(Number($('#dv_pisos').val())>1);
     if(Number($('#dv_pisos').val())<DV_PISO)cambiarPiso(1);
     renderGrid();
   }else alert(r.mensaje||'No se pudo guardar.');
 },'json');
}
cargar();
</script>
