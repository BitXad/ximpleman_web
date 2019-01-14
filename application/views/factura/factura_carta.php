<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<!--<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
                                            /*function imprimir()
                                            {
                                                /*$('#paraboucher').css('max-width','7cm !important');*/
                                                /* window.print(); 
                                            }*/
    });
</script>-->
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
<style type="text/css">
p {
    font-family: Arial;
    font-size: 8pt;
    line-height: 100%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 10px;
}
div {
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
margin-left: 0px;
margin: 0px;
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<!-------------------------------------------------------->

<font face="Arial" size="1">
<div class="row" >
    
<table class="table" >
    <tr>
        <td nowrap>
            <div class="container"  style="width: 7cm;" >
                
            <center>
                <p>
                
                    <img src="<?php echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>
                    <font size="2" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font><br>

                </p>    
            </center>           
            </div>
        </td>
        <td>
            <div class="container"  style="width: 6cm;">
                
            <center>
                <br>
                <font size="5" face="arial"><b>FACTURA</b></font>   
            </center>
            
            </div>
        </td>
        <td style="width: 7cm;">

           
        <div class="panel panel-primary col-md-12">
            <font size="1">
                
            
            <table>
                <tr>
                    <td>
                        <b>NIT:      </b><br>
                        <b>FACTURA No.:  </b><br>
                        <b>AUTORIZACION: </b>
                        
                    </td>
                    <td>
                        <?php echo $factura[0]['factura_nitemisor']; ?> <br>
                        <?php echo $factura[0]['factura_numero']; ?> <br>
                        <?php echo $factura[0]['factura_autorizacion'] ?>           
                    </td>
                </tr>
            </table>

            </font>
            </div>
        <center>            
            <font size="2" face="arial"><b>ORIGINAL</b></font>
            <br><font size="1" face="arial"><?php echo $factura[0]['factura_actividad']?></font>
        </center>
        </td>            
    </tr>    
</table>
<?php $fecha = new DateTime($venta[0]['venta_fecha']); 
      $fecha_d_m_a = $fecha->format('d/m/Y');
?>    
<div class="container">
    <div class="panel panel-primary col-md-12">
        
        <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>            
        <b>SEÑOR(ES): </b><?php echo $venta[0]['cliente_nombre'].""; ?>  <b>   NIT/CI: </b><?php echo $factura[0]['factura_nit']; ?> 
    </div>
</div>
</div>



<div class="box-header no-print">
                <h3 class="box-title  no-print">Detalle Venta</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group  no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el codigo, venta, precio">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
         <div class="panel panel-primary">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed table-bordered" id="mitablaz">
                    <tr>
						<th>Num.</th>
						<th>Producto</th>
						<th>Cant.</th>
						<th>Precio</th>
						<th>Subtotal</th>

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
						<td><?php echo $d['producto_nombre']; ?></td>
						<td align="center"><?php echo $d['detalleven_cantidad']; ?></td>
						<td align="right"><?php echo number_format($d['detalleven_precio'],2,'.',','); ?></td>
						<td align="right"><?php echo number_format($d['detalleven_total'],2,'.',','); ?></td>
						<td class="no-print">
                                                    <a href="<?php //echo site_url('detalle_venta/edit/'.$d['detalleven_id']); ?>" class="btn btn-info btn-xs no-print"><span class="fa fa-pencil" ></span></a> 
                                                    <a href="<?php //echo site_url('detalle_venta/remove/'.$d['detalleven_id']); ?>" class="btn btn-danger btn-xs no-print"><span class="fa fa-trash"></span></a>
                                                </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            
        </div>
    </div>
</div>


    
<table class="table">
    <tr>
        <td width="150"  rowspan="2">
            <img src="<?php echo $codigoqr; ?>" width="100" height="100">          
        </td>
        <td nowrap>
            
            <font size="2">
            
                COD. CONTROL: <b><?php echo $factura[0]['factura_codigocontrol']; ?></b><br>
                LIMITE DE EMISIÓN: <b><?php echo $factura[0]['factura_fechalimite']; ?></b><br>
                USUARIO: <b><?php echo $venta[0]['usuario_nombre']; ?></b>
            </font>
            

        </td>
        
        <td nowrap align="right">
            
            <font size="1">
                <b><?php echo "SUB TOTAL Bs ".number_format($venta[0]['venta_subtotal'],2,'.',','); ?></b><br>
            </font>
            

            <font size="1">
                <?php echo "TOTAL DESCUENTO Bs ".number_format($total_descuento,2,'.',','); ?><br>
            </font>
            <font size="3">
            <b>
                <?php echo "TOTAL FINAL Bs: ".number_format($factura[0]['factura_total'] ,2,'.',','); ?><br>
            </b>
            </font>
            <font size="2">
                <b><?php echo "LITERAL: ".num_to_letras($total_final,' Bolivianos'); ?></b><br>            
            </font>
            <font size="1">
                <?php echo "EFECTIVO Bs ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                <?php echo "CAMBIO Bs ".number_format($venta[0]['venta_cambio'],2,'.',','); ?>
            </font>
            
        </td>            
    </tr>    
    <tr >

        
        <td colspan="2">
            <center>

                <br><small>
                    <?php echo $factura[0]['factura_leyenda']; ?> <br>
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  

                </small> 
            </center>
    
        </td>            
    </tr>    
    
</table>

</div>

</font>