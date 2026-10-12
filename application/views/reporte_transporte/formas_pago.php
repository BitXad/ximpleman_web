<section class="content-header"><h1><i class="fa fa-credit-card"></i> Reporte de formas de pago</h1></section><section class="content">
<div class="alert alert-info"><i class="fa fa-info-circle"></i> <b>Corrección:</b> este reporte usa directamente las ventas vigentes de <b>venta_pasaje</b> y su <b>forma_id</b>. No requiere la tabla transporte_caja_movimiento. Reservas y ventas anuladas no se suman.</div>
<div class="box box-primary no-print"><div class="box-body"><form method="get" class="form-inline">
<label>Desde</label> <input type="date" name="desde" class="form-control" value="<?php echo html_escape($filtros['desde']);?>">
<label>Hasta</label> <input type="date" name="hasta" class="form-control" value="<?php echo html_escape($filtros['hasta']);?>">
<select name="caja_id" class="form-control"><option value="0">Todas las cajas</option><?php foreach($listas['cajas'] as $c):?><option value="<?php echo $c['caja_id'];?>" <?php echo $filtros['caja_id']==$c['caja_id']?'selected':'';?>>Caja #<?php echo $c['caja_id'];?> - <?php echo html_escape($c['usuario']);?> - <?php echo html_escape($c['caja_fechaapertura']);?></option><?php endforeach;?></select>
<select name="usuario_id" class="form-control"><option value="0">Todos los usuarios</option><?php foreach($listas['usuarios'] as $u):?><option value="<?php echo $u['usuario_id'];?>" <?php echo $filtros['usuario_id']==$u['usuario_id']?'selected':'';?>><?php echo html_escape($u['usuario_nombre']);?></option><?php endforeach;?></select>
<button class="btn btn-primary"><i class="fa fa-search"></i> Generar</button></form></div></div>

<div class="box"><div class="box-header"><h3 class="box-title">Resumen por forma de pago</h3><div class="pull-right no-print">
<button onclick="window.print()" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Imprimir</button>
<a class="btn btn-success btn-sm" href="<?php echo site_url('reporte_formas_pago/csv').'?'.http_build_query($filtros);?>"><i class="fa fa-file-excel-o"></i> Excel/CSV</a></div></div>
<div class="box-body"><div class="table-responsive"><table class="table table-bordered table-striped">
<thead><tr><th>Forma de pago</th><th class="text-right">Operaciones</th><th class="text-right">Total</th></tr></thead><tbody>
<?php $to=0;$tn=0;foreach($filas as $r):$to+=(int)$r['operaciones'];$tn+=(float)$r['total'];?>
<tr><td><b><?php echo html_escape($r['forma']);?></b></td><td class="text-right"><?php echo number_format($r['operaciones'],0,',','.');?></td><td class="text-right"><b>Bs <?php echo number_format($r['total'],2,',','.');?></b></td></tr>
<?php endforeach;?></tbody><tfoot><tr class="info"><th>TOTAL</th><th class="text-right"><?php echo number_format($to,0,',','.');?></th><th class="text-right">Bs <?php echo number_format($tn,2,',','.');?></th></tr></tfoot>
</table></div></div></div>

<?php if($filtros['caja_id']>0):
$ct=$control['caja']['transacciones'];
$dif=($ct===null)?null:((float)$control['movimientos']['total']-(float)$ct); ?>
<div class="box box-warning"><div class="box-header"><h3 class="box-title">Control de caja #<?php echo $filtros['caja_id'];?></h3></div><div class="box-body">
<table class="table table-bordered">
<tr><th>Ventas de pasajes vigentes durante el turno</th><td class="text-right"><b>Bs <?php echo number_format($control['movimientos']['total'],2,',','.');?></b></td></tr>
<tr><th>caja_transacciones</th><td class="text-right">Bs <?php echo number_format((float)$ct,2,',','.');?></td></tr>
<tr><th>Diferencia</th><td class="text-right"><b>Bs <?php echo number_format((float)$dif,2,',','.');?></b></td></tr>
</table>
<p class="text-muted"><small>La caja se identifica por usuario y por el intervalo exacto apertura-cierre. caja_transacciones puede incluir ventas u operaciones de otros módulos; por eso la diferencia se presenta como control y no se interpreta automáticamente como faltante.</small></p>
</div></div><?php endif;?>
</section>
<style media="print">.no-print,.main-header,.main-sidebar,.content-header,.main-footer{display:none!important}.content-wrapper{margin-left:0!important}.content{padding:0!important}</style>
