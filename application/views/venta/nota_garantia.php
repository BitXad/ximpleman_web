<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>" type="text/javascript"></script>
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
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<?php $ancho = "18cm"; ?>


<table style="width: <?php echo $ancho; ?>">
    <tr>
        <td width="40%" style="line-height: 12px;">
                     <center>                        
                        <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                        <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>
                        <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    </center>           
        </td>
        <td width="40%">
            <center>
                <font size="3" face="arial"><b>NOTAS DE GARANTIA</b></font><br>
                <font size="2" face="arial"><b>VENTA Nº: 00<?php echo $venta[0]['venta_id']; ?></b></font>
            </center>
            
        </td>
        <td width="20%">

        
        </td>            
    </tr>    
</table>

<table style="width: <?php echo $ancho; ?>">
    <tr style="padding:0;">
        <td width="15%" style="line-height: 12px; padding:0;">

        </td>
        <td width="70%" style="border-bottom: #000; border-bottom-style: solid; border-top-style: solid; padding:0; background: silver;">

            <h5 style="font-family: Arial; font-size: smaller; margin-bottom: 0; margin-top: 0;"><b>Cliente: </b><?php echo $venta[0]['cliente_nombre']; ?> <br>
            <b>Código Cliente: </b><?php echo $venta[0]['cliente_codigo']; ?> <br>
            <b>Fecha/Hora: </b><?php echo $venta[0]['venta_fecha']; ?></h5>       
            
        </td>
        <td width="15%" style="padding:0;">

        
        </td>            
    </tr>    
</table>

<br>
<table class="table table-striped table-condensed"   border="1" style="width:<?php echo $ancho; ?>" >
                    <tr>
                            <th style="width: 1cm">CANT</th>
                            <th>DESCRIPCIÓN</th>

                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          $cantidad = 0;
                          $subtotal = 0;
                          $total_descuento = 0;
                          $total_final = 0;
                          
                          foreach($detalle_venta as $d){;
                                 $cont = $cont+1;
                                 $cantidad += $d['detalleven_cantidad'];
                                 $total_descuento += $d['detalleven_descuento']; 
                                 $total_final += $d['detalleven_total']; 
                                 $subtotal += $d['detalleven_subtotal']; 
                                 
                                 ?>
                    <tr>
                        
                        <td align="center">
                             <?php echo $d["detalleven_cantidad"]; ?>
                        </td>
                        <td><?php echo $d['producto_nombre']; ?></td>
                        
<!--                        <td><?php echo $cont ?></td>
                    <td><?php //echo $d['detalleven_id']; ?></td>
                        <td><?php echo $d['venta_glosa']; ?></td>
                        <td><?php echo $d['detalleven_codigo']; ?></td>
                        <td><?php echo $d['detalleven_unidad']; ?></td>
                        <td><?php echo $d['detalleven_costo']; ?></td>
                        <td align="center"><?php echo number_format($d['detalleven_precio'],2,'.',','); ?></td>
                        <td align="right"><?php echo number_format($d['detalleven_subtotal'],2,'.',','); ?></td>
                        <td align="center"><?php echo number_format($d['detalleven_descuento'],2,'.',','); ?></td></td>
                        <td align="right"><?php echo number_format($d['detalleven_total'],2,'.',','); ?></td>-->

<!--                        <td class="no-print">
                            <a href="<?php echo site_url('venta/garantia/'.$d['detalleven_id']); ?>" class="btn btn-info btn-xs no-print" target="_BLANK"><span class="fa fa-lock" ></span> Imprimir garantia</a> 
                        </td>-->
                    </tr>
                    <?php } ?>
                    <tr>

                    </tr>                    
</table>


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

    <a  href="<?php echo site_url('venta'); ?>" class="btn btn-sq-lg btn-danger no-print" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-sign-out fa-4x"></i><br><br>
       Salir <br>
    </a>

<?php 
$opc = $parametro[0]['parametro_cerrarventanas'];
if($opc==1){ ?>

<script>
  // Función para cerrar la ventana
  function cerrarVentana() {
    window.close();
  }

  // Llamamos a la función cerrarVentana() después de 2000 milisegundos (2 segundos)
  setTimeout(cerrarVentana, 2000);
</script>

<?php } ?>