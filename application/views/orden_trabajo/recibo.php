<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<style type="text/css">
  @media print {
     #mitabla th{
    padding: 4px !important;
    font-size: 14px !important;
    border: 1px solid black !important;
}
   #mitabla td{
    padding: 3px !important;
    font-size: 12px !important;
    border: 1px solid black !important;
}
}
</style>
<table class="table" style="width: 100%; padding: 0;" >
    <tr>
        <td style="width: 25%; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80px" height="60px"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 25%; padding: 0" > 
            <center>
            
                
                <font size="4" face="arial"><b>ORDEN DE TRABAJO</b></font> <br>
                <font size="5" face="arial"><b>Nº 00<?php echo $Orden_trabajo['orden_numero']; ?></b></font> <br>
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>
                <select style="text-align: center;">
                  <option></option>
                  <option>CORTE</option>
                  <option>PULIDO</option>
                  <option>ENTRANTE</option>
                  <option>TEMPLADO</option>
                  <option>DESPACHO</option>
                </select>

            </center>
        </td>
        <td style="width: 25%; padding: 0; line-height:15px;" >
                
                         
                              <font size="3" face="Arial"><b>CLIENTE: </b><?php echo $Orden_trabajo['cliente_nombre'];?><br>
                          <b>TELEFONOS: </b><?php echo $Orden_trabajo['cliente_telefono'];?><br>
                          <b>NOTA: </b><?php echo $Orden_trabajo['orden_observacion'];?><br>
                          <b>FECHA PEDIDO: </b><?php echo date('d/m/Y',strtotime($Orden_trabajo['orden_fecha'])) ; ?><br>
                          <b>FECHA ENTREGA: </b><?php echo date('d/m/Y',strtotime($Orden_trabajo['orden_fechaentrega'])) ; ?>
                          <br>
                          <b>VENDEDOR: </b><?php echo $Orden_trabajo['usuario_nombre'] ; ?>
                          </font>
                         
                            
                         
                    
        </td>
    </tr>
     
    
    
</table>       
<div class="hidden">
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
</div>
<div class="box-body table-responsive" style="padding-left: 10%">
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
                      $cantis=0;
                      $rango=1;
                      foreach($detalle_orden_trabajo as $d) {
                      $cont = $cont+1; 
                      $total += $d['detalleorden_total'] ?>
                      <tr>
                      <td align="center"><?php echo $rango ?> - <?php echo ($cantis+$d['detalleorden_cantidad']) ?></td>
                      <td align="center"><?php echo $d['detalleorden_cantidad']; ?></td>
                      <td align="center"><?php echo $d['producto_nombre']; ?></td>
                      <td align="center"><?php echo $d['detalleorden_ancho']; ?></td>
                      <td align="center"><?php echo $d['detalleorden_largo']; ?></td>
                      <td align="center"><b><?php echo number_format($d['detalleorden_total'], 2, ".", ","); ?></b></td>
                      <td align="center"><?php echo $d['tipoorden_nombre']; ?></td>
					  </tr>     
            <?php 
                      $rango = $rango+$d['detalleorden_cantidad'];
                      $cantis = $cantis+$d['detalleorden_cantidad'];
                     
                       }?>
                      <tr>
                      	<th colspan="5">TOTAL M2</th>
                      	<th ><?php echo number_format($total, 2, ".", ","); ?></th>
                      	<th colspan="2"></th>
                      </tr>  

	
</table>
</div>