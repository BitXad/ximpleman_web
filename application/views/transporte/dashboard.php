<!-- DASHBOARD TRANSPORTE - PANTALLA INDEPENDIENTE -->
<script src="<?php echo base_url('resources/js/Chart.min.js'); ?>"></script>
<style>
.tx-dash{padding:0 15px;margin-bottom:10px}.tx-kpis{display:grid;grid-template-columns:repeat(5,1fr);gap:8px}.tx-kpi{background:#fff;border-top:3px solid #3c8dbc;box-shadow:0 1px 3px rgba(0,0,0,.12);padding:10px 12px}.tx-kpi b{font-size:21px;display:block}.tx-kpi small{font-weight:bold;color:#667}.tx-grid{display:grid;grid-template-columns:1.35fr 1fr;gap:10px;margin-top:10px}.tx-card{background:#fff;border:1px solid #ddd;border-radius:3px;padding:10px}.tx-card h4{margin:0 0 8px;font-weight:bold}.tx-chart{height:210px}.tx-alerts .alert{padding:7px 10px;margin-bottom:6px}.tx-rank{margin:0;padding-left:22px}.tx-rank li{padding:4px 0;border-bottom:1px solid #eee}.tx-dash-toggle{margin-bottom:7px}.tx-shortcuts{background:#fff;border:1px solid #ddd;border-radius:3px;padding:10px;margin-bottom:10px}.tx-shortcuts-title{font-size:12px;font-weight:bold;color:#667;text-transform:uppercase;margin:0 0 8px}.tx-shortcuts-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:8px}.tx-shortcut{display:flex;align-items:center;min-height:58px;padding:8px 10px;border:1px solid #d9e1e8;border-radius:4px;background:#f9fbfc;color:#34495e;text-decoration:none!important;transition:all .15s ease}.tx-shortcut:hover{background:#eef6fb;border-color:#3c8dbc;color:#23527c;box-shadow:0 1px 4px rgba(0,0,0,.10)}.tx-shortcut i{font-size:22px;width:32px;text-align:center;margin-right:8px;color:#3c8dbc}.tx-shortcut span{font-size:12px;font-weight:bold;line-height:15px}.tx-shortcut.tx-op i{color:#00a65a}.tx-shortcut.tx-report i{color:#f39c12}
@media(max-width:1100px){.tx-shortcuts-grid{grid-template-columns:repeat(3,1fr)}}@media(max-width:900px){.tx-kpis{grid-template-columns:repeat(2,1fr)}.tx-grid{grid-template-columns:1fr}.tx-shortcuts-grid{grid-template-columns:repeat(2,1fr)}}@media(max-width:520px){.tx-kpis{grid-template-columns:1fr}.tx-shortcuts-grid{grid-template-columns:1fr}}
</style>
<div class="tx-dash">
 <div class="clearfix tx-dash-toggle"><h3 class="pull-left" style="margin:5px 0"><i class="fa fa-dashboard"></i> Dashboard de Transporte</h3><button class="btn btn-default btn-sm pull-right" data-toggle="collapse" data-target="#txDashboard"><i class="fa fa-chevron-up"></i> Mostrar/Ocultar</button></div>
 <div id="txDashboard" class="collapse in">
  <div class="tx-shortcuts no-print">
   <div class="tx-shortcuts-title"><i class="fa fa-th-large"></i> Accesos rápidos</div>
   <div class="tx-shortcuts-grid">
    <a class="tx-shortcut tx-op" href="<?php echo site_url('transporte'); ?>"><i class="fa fa-ticket"></i><span>Venta de pasajes</span></a>
    <a class="tx-shortcut tx-op" href="<?php echo site_url('viaje'); ?>"><i class="fa fa-bus"></i><span>Viajes</span></a>
    <a class="tx-shortcut tx-op" href="<?php echo site_url('viaje/abordaje'); ?>"><i class="fa fa-check-square-o"></i><span>Control de abordaje</span></a>
    <a class="tx-shortcut tx-op" href="<?php echo site_url('equipaje'); ?>"><i class="fa fa-suitcase"></i><span>Equipaje</span></a>
    <a class="tx-shortcut" href="<?php echo site_url('vehiculo'); ?>"><i class="fa fa-bus"></i><span>Vehículos</span></a>
    <a class="tx-shortcut" href="<?php echo site_url('conductor'); ?>"><i class="fa fa-id-card"></i><span>Conductores</span></a>
    <a class="tx-shortcut" href="<?php echo site_url('ayudante'); ?>"><i class="fa fa-users"></i><span>Ayudantes</span></a>
    <a class="tx-shortcut" href="<?php echo site_url('ruta'); ?>"><i class="fa fa-road"></i><span>Rutas</span></a>
    <a class="tx-shortcut" href="<?php echo site_url('parada'); ?>"><i class="fa fa-map-marker"></i><span>Paradas</span></a>
    <a class="tx-shortcut tx-report" href="<?php echo site_url('reporte_transporte/ventas_fecha'); ?>"><i class="fa fa-bar-chart"></i><span>Reportes</span></a>
   </div>
  </div>
  <div class="tx-kpis">
   <div class="tx-kpi"><small>VENTAS HOY</small><b>Bs <?php echo number_format($dashboard_indicadores['ventas'],2,',','.');?></b></div>
   <div class="tx-kpi"><small>PASAJES HOY</small><b><?php echo (int)$dashboard_indicadores['pasajeros'];?></b></div>
   <div class="tx-kpi"><small>VIAJES HOY</small><b><?php echo (int)$dashboard_indicadores['viajes'];?></b></div>
   <div class="tx-kpi"><small>OCUPACIÓN PROMEDIO</small><b><?php echo number_format($dashboard_indicadores['ocupacion'],1,',','.');?>%</b></div>
   <div class="tx-kpi"><small>RESERVAS ACTIVAS</small><b><?php echo (int)$dashboard_indicadores['reservas'];?></b></div>
  </div>
  <div class="tx-grid">
   <div class="tx-card"><h4><i class="fa fa-clock-o"></i> Próximas salidas</h4><div class="table-responsive"><table class="table table-condensed table-striped"><thead><tr><th>Hora</th><th>Ruta</th><th>Bus</th><th>Vendidos</th><th>Libres</th><th>Estado</th></tr></thead><tbody><?php foreach($dashboard_salidas as $x):$lib=max(0,(int)$x['capacidad']-(int)$x['vendidos']);?><tr><td><b><?php echo html_escape(substr($x['viaje_horasalida'],0,5));?></b></td><td><?php echo html_escape($x['ruta']);?></td><td><?php echo html_escape($x['bus']);?></td><td><?php echo (int)$x['vendidos'];?></td><td><?php echo $lib;?></td><td><?php echo html_escape($x['estado']);?></td></tr><?php endforeach;?></tbody></table></div></div>
   <div class="tx-card tx-alerts"><h4><i class="fa fa-bell"></i> Alertas operativas</h4><?php if(empty($dashboard_alertas)):?><div class="alert alert-success"><i class="fa fa-check"></i> Sin alertas operativas detectadas.</div><?php else:foreach($dashboard_alertas as $a):?><div class="alert alert-<?php echo $a['tipo'];?>"><i class="fa fa-<?php echo $a['icono'];?>"></i> <?php echo html_escape($a['texto']);?></div><?php endforeach;endif;?></div>
  </div>
  <div class="tx-grid">
   <div class="tx-card"><h4>Ocupación por viaje - hoy</h4><div class="tx-chart"><canvas id="txChartOcupacion"></canvas></div></div>
   <div class="tx-card"><h4>Destinos principales - últimos 30 días</h4><ol class="tx-rank"><?php foreach($dashboard_destinos as $d):?><li><b><?php echo html_escape($d['destino']);?></b> <span class="pull-right"><?php echo (int)$d['pasajeros'];?> pasajeros / Bs <?php echo number_format($d['importe'],2,',','.');?></span></li><?php endforeach;?></ol></div>
  </div>
  <div class="tx-card" style="margin-top:10px"><h4>Ventas <select id="txVentasPeriodo" class="form-control input-sm pull-right" style="width:120px"><option value="7">7 días</option><option value="30">30 días</option></select></h4><div class="tx-chart"><canvas id="txChartVentas"></canvas></div></div>
 </div>
</div>
<script>
(function(){
 var occ=<?php echo json_encode($dashboard_ocupacion);?>, v7=<?php echo json_encode($dashboard_ventas_7);?>, v30=<?php echo json_encode($dashboard_ventas_30);?>;
 function dibujar(){
  if(typeof Chart==='undefined')return;
  var ol=[],od=[];for(var i=0;i<occ.length;i++){ol.push(occ[i].hora+' '+occ[i].ruta);od.push(parseFloat(occ[i].capacidad)>0?Math.round(parseFloat(occ[i].vendidos)*1000/parseFloat(occ[i].capacidad))/10:0);}
  new Chart(document.getElementById('txChartOcupacion').getContext('2d')).Bar({labels:ol,datasets:[{label:'Ocupación %',fillColor:'rgba(60,141,188,.55)',strokeColor:'rgba(60,141,188,1)',data:od}]},{responsive:true,maintainAspectRatio:false,scaleBeginAtZero:true,scaleOverride:true,scaleSteps:5,scaleStepWidth:20,scaleStartValue:0});
  window.txVentasChart=null;
  function ventas(arr){var l=[],d=[];for(var j=0;j<arr.length;j++){l.push(arr[j].fecha.substr(5));d.push(parseFloat(arr[j].total));}var c=document.getElementById('txChartVentas').getContext('2d');if(window.txVentasChart)window.txVentasChart.destroy();window.txVentasChart=new Chart(c).Line({labels:l,datasets:[{label:'Ventas Bs',fillColor:'rgba(0,166,90,.15)',strokeColor:'rgba(0,166,90,1)',pointColor:'rgba(0,166,90,1)',data:d}]},{responsive:true,maintainAspectRatio:false,scaleBeginAtZero:true});}
  ventas(v7);$('#txVentasPeriodo').off('change.tx').on('change.tx',function(){ventas(this.value==='30'?v30:v7);});
 }
 if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',dibujar);else dibujar();
})();
</script>
