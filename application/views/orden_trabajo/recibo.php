<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">

<center><h1>ORDEN DE TRABAJO</h1></center>

<table>
	<tr>
	<th colspan="5"></th>	
	<th>OT.:</th>	
	<th></th>
	<th><?php echo $Orden_trabajo["orden_numero"] ?></th>	
	</tr>
	<tr>
	<th>CLIENTE:</th>	
	<th style="width: 2%"></th>	
	<th><?php echo $Orden_trabajo["cliente_nombre"] ?></th>	
	<th style="width: 20%"></th><th style="width: 20%">
	<th></th><th colspan="2" rowspan="4"><img src="<?php echo base_url('resources/images/empresas/'.$empresa[0]["empresa_imagen"].''); ?>"  style="width:65px;height:65px"></th>
	</tr>
	<tr>
	<th>TELEFONOS:</th>	
	<th></th>	
	<th><?php echo $Orden_trabajo["cliente_telefono"] ?></th>
	</tr>
	<tr>
	<th>NOTA:</th>	
	<th></th>	
	<th><?php echo $Orden_trabajo["orden_observacion"] ?></th>
	</tr>
	<tr>
	<th>FECHA PEDIDO:</th>	
	<th></th>
	<th><?php echo date("d/m/Y", strtotime($Orden_trabajo["orden_fecha"])) ?></th>	
	<th></th><th></th>
	</tr>
	<tr>
	<th>FECHA ENTREGA:</th>	
	<th></th>	
	<th><?php echo date("d/m/Y", strtotime($Orden_trabajo["orden_fechaentrega"])) ?></th><th></th><th></th>
	<th>VENDEDOR:</th><th style="width: 2%"></th>
	<th><?php echo $Orden_trabajo["usuario_nombre"] ?></th>	
	</tr>
</table>

<div class="box-body table-responsive">
<table class="table table-striped table-condensed" id="mitabla">
<tr>
	<th colspan="3">DETALLE DE PEDIDO</th>
	<th colspan="2">MEDIDAS</th>
	<th rowspan="2">TOTAL M2</th>
	<th rowspan="2">OBSERVACIONES</th>
</tr>
<tr>
	<th>C</th>
	<th>CANT</th>
	<th>PRODUCTO</th>
	<th>ANCHO</th>
	<th>LARGO</th>
</tr>
					  <?php
                      $i=1;
                      $cont = 0;
                      $total=0;
                      foreach($detalle_orden_trabajo as $d) {
                      $cont = $cont+1; 
                      $total += $d['detalleorden_total'] ?>
                      <tr>
                      <td align="center"><?php echo $cont ?></td>
                      <td align="center"><?php echo $d['detalleorden_cantidad']; ?></td>
                      <td><?php echo $d['producto_nombre']; ?></td>
                      <td align="center"><?php echo $d['detalleorden_ancho']; ?></td>
                      <td align="center"><?php echo $d['detalleorden_largo']; ?></td>
                      <td align="center"><?php echo $d['detalleorden_total']; ?></td>
                      <td><?php echo $d['detalleorden_observacion']; ?></td>
					  </tr>
                      <?php }?>
                      <tr>
                      	<th colspan="5">TOTAL M2</th>
                      	<th ><?php echo $total; ?></th>
                      	<th colspan="2"></th>
                      </tr>  

	
</table>
</div>