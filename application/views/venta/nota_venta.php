<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->


<div class="container">
    
<table>
    <tr>
        <td width="300">
                     <center>                        
                        <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                        <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>
                        <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    </center>           
        </td>
        <td width="300">
            <center>
                <font size="3" face="arial"><b>NOTA DE ENTREGA</b></font><br>
                <font size="2" face="arial"><b>N&deg;: 00<?php echo $venta[0]['venta_id']; ?></b></font>
            </center>
            
        </td>
        <td width="300">

                <h5><b>Tipo: </b><?php echo $venta[0]['tipotrans_nombre']; ?> <br>
                <b>Cred. Nº: </b><?php echo $venta[0]['cliente_codigo']; ?> <br>
                <b>Limite: </b><?php echo $venta[0]['venta_fecha']; ?></h5>       
        
        </td>            
    </tr>    
</table>
</div>

    
<div class="container">
    <div class="panel panel-primary col-md-8">
        <h5><b>Cliente: </b><?php echo $venta[0]['cliente_nombre']; ?> <br>
        <b>C&oacute;digo Cliente: </b><?php echo $venta[0]['cliente_codigo']; ?> <br>
        <b>Fecha/Hora: </b><?php echo $venta[0]['venta_fecha']; ?></h5>       
    </div>
</div>


<div class="box-header no-print">
                <h3 class="box-title  no-print">Detalle Venta</h3>
            	<!--<div class="box-tools  no-print">
                    <a href="<?php //echo site_url('detalle_venta/add'); ?>" class="btn btn-success btn-sm">+ A���adir</a> 
                </div>-->
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group  no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el codigo, venta, precio">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla"  border="1">
                    <tr>
						<th>Num.</th>
                        <!--<th>Id</th>-->
						<th>Producto</th>
						<!--<th>Venta</th>-->
						<th>Codigo</th>
						<th>Unid.</th>
						<th>Cant.</th>
						<!--<th>Costo</th>-->
						<th>Prec.</th>
						<th>Subtotal</th>
						<th>Desc.</th>
						<th>Total</th>
<!--						<th>Moneda</th>
						<th>Preferencia</th>
						<th>Comision</th>
						<th>Tipo<br>Cambio</th>
						<th>Caracteristicas</th>
						<th>Operaciones</th>-->
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          $cantidad = 0;
                          $total_descuento = 0;
                          $total_final = 0;
                          
                          foreach($detalle_venta as $d){;
                                 $cont = $cont+1;
                                 $cantidad += $d['detalleven_cantidad'];
                                 $total_descuento += $d['detalleven_descuento']; 
                                 $total_final += $d['detalleven_total']; 
                                 ?>
                    <tr>
						<td><?php echo $cont ?></td>
                        <!--<td><?php //echo $d['detalleven_id']; ?></td>-->
						<td><?php echo $d['producto_nombre']; ?></td>
						<!--<td><?php echo $d['venta_glosa']; ?></td>-->
						<td><?php echo $d['detalleven_codigo']; ?></td>
						<td><?php echo $d['detalleven_unidad']; ?></td>
						<td align="center"><?php echo $d['detalleven_cantidad']; ?></td>
						<!--<td><?php echo $d['detalleven_costo']; ?></td>-->
						<td align="right"><?php echo number_format($d['detalleven_precio'],2,'.',','); ?></td>
						<td align="right"><?php echo number_format($d['detalleven_subtotal'],2,'.',','); ?></td>
						<td align="right"><?php echo number_format($d['detalleven_descuento'],2,'.',','); ?></td>
						<td align="right"><?php echo number_format($d['detalleven_total'],2,'.',','); ?></td>
						<!--<td><?php echo $d['moneda_descripcion']; ?></td>-->
<!--						<td><?php echo $d['detalleven_preferencia']; ?></td>
						<td><?php echo $d['detalleven_comision']; ?></td>
						<td><?php echo $d['detalleven_tipocambio']; ?></td>
						<td><?php echo $d['detalleven_caracteristicas']; ?></td>-->
						<td class="no-print">
                                                    <a href="<?php //echo site_url('detalle_venta/edit/'.$d['detalleven_id']); ?>" class="btn btn-info btn-xs no-print"><span class="fa fa-pencil" ></span></a> 
                                                    <a href="<?php //echo site_url('detalle_venta/remove/'.$d['detalleven_id']); ?>" class="btn btn-danger btn-xs no-print"><span class="fa fa-trash"></span></a>
                                                </td>
                    </tr>
                    <?php } ?>
                    <tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><?php echo number_format($cantidad,2,'.',','); ?></th>
						<th></th>
						<th></th>
						<th><?php echo number_format($total_descuento,2,'.',','); ?></th>
						<th><?php echo number_format($total_final,2,'.',','); ?></th>
                    </tr>                    
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
<b>Usuario: </b><?php echo $venta[0]['cliente_nombre']; ?>

<center>
    <div class="col-md-12">
        <table>
            <tr>
                <td> <center>
                
                        <?php echo "-----------------------------------------------------"; ?><br>
                        <?php echo "RECIBI CONFORME"; ?><br>
                    
                    </center>
                </td>
                <td width="100">
                    <?php echo "     "; ?><br>
                    <?php echo "     "; ?><br>
                </td>
                <td>
                    <center>

                        <?php echo "-----------------------------------------------------"; ?><br>
                        <?php echo "ENTREGUE CONFORME"; ?><br>   

                    </center>
                </td>
            </tr>
        </table>
        
    </div>
    
</center>   

