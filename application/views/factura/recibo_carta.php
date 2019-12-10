    
<!--<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>-->
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

<style type="text/css">

p {
    font-family: Arial;
    font-size: 7pt;
    line-height: 120%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 10px;
}

div {
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
margin-left: 10px;
margin: 0px;
}


table{
width : 7cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;
border-spacing : 0 0;
border-collapse : collapse;
font-family: Arial;
font-size: 8pt;  

td {
border:hidden;
}
}

td#comentario {
vertical-align : bottom;
border-spacing : 0;
}
div#content {
background : #ddd;
font-size : 8px;
margin : 0 0 0 0;
padding : 0 5px 0 5px;
border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"];
      $margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];;
?>

<div class="<?php echo $margen_izquierdo; ?>" style="padding: 0; max-width:5cm;">
    
</div>
 
<div class="col-xs-10" style="padding: 0;">

<table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height: 9px;" >
                
            <center>
                    <font size="2" face="Arial black"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <?php if (sizeof($empresa[0]['empresa_eslogan'])>0){ ?>
                    <small>
                            <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                                    
                    </small> 
                    <?php } ?>

                    


                    <font size="1" face="Arial narrow">
                    <small>
                        
                        <?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <?php echo $empresa[0]['empresa_telefono']; ?><br>
                        <?php echo $empresa[0]['empresa_ubicacion']; ?>
                    </small>                                
                    </font>                


            </center>
            
        </td>
                   
        <td style="width: 6cm; padding: 0; " > 
            <center>
            
                    <?php if($venta[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         else {  $titulo1 = "NOTA"; $subtitulo = "ORIGINAL"; }?>

                <font size="3" face="arial"><b>NOTA DE ENTREGA</b></font> <br>
                <font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>
                <font size="1" face="arial"><b><?php echo $venta[0]['venta_fecha']." ".$venta[0]['venta_hora']; ?></b></font> <br>
            </center>
        </td>
        <td style="width: 6cm; padding: 0; line-height: 9px;" >
                _______________________________________________                
                   
                <br><br> 
                <small>
                    
                <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                    <b>CODIGO: </b><?php echo $venta[0]['cliente_codigo']." / NIT: ".$venta[0]['cliente_nit']; ?> <br>
                    <b>SEÑOR(ES): </b><?php echo $venta[0]['cliente_razon'].""; ?><br>
                    <b>DIRECCIÓN: </b><?php echo $venta[0]['cliente_direccion'].""; ?><br>
                    <b>ZONA: </b><?php echo $venta[0]['zona_nombre'].""; ?>
                <br>
                </small>
                _______________________________________________
        </td>
    </tr>
     
</table>

       <table class="table table-striped table-condensed"  style="width: <?php echo $ancho;?>cm;" >
           <tr  style="border-top-style: solid; border-bottom-style: solid; border-color: black;">
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>CANT</b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>DESCRIPCIÓN</b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>P.UNIT</b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>TOTAL</b></td>               
           </tr>
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
                <td align="center" style="padding: 0"><?php echo $d['detalleven_cantidad']; ?></td>
                <td style="padding: 0"><font style="size:5px; font-family: arial narrow;"> (<?php echo $d['detalleven_codigo']; ?>) <?php echo $d['producto_nombre'];?>
                        <?php
                        $preferencia = $d['detalleven_preferencia'];
                        $caracteristicas = $d['detalleven_caracteristicas'];
                        
                        if ($preferencia !="null" && $preferencia!='-')
                            echo  " /".$preferencia;
                        
                        if ($caracteristicas!="null" && $caracteristicas!='-')
                            echo  "<br>".$caracteristicas;
                        
                        ?>

                </td>
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_precio']+$d['detalleven_descuento'],2,'.',','); ?></td>
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_subtotal'],2,'.',','); ?></td>
           </tr>
           <?php } ?>
       </table>
    
<table class="table" style="max-width: <?php echo $ancho;?>cm;">
    <tr style="border-top-style: solid; background-color: #aaa; border-color: black; ">
        
        <td align="left" style="background-color: #aaa !important; -webkit-print-color-adjust: exact; line-height: 10px;">
                            
                USUARIO: <b><?php echo $venta[0]['usuario_nombre']; ?></b><br>
                COD.: <b><?php echo $venta[0]['venta_id']; ?></b><br>
                TRANS.: <b><?php echo $venta[0]['tipotrans_nombre']; ?></b><br>
                CUOTA INIC. Bs: <b><?php echo number_format($venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>
                SALDO Bs: <b><?php echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>                
        </td>
        <td align="right" style="background-color: #aaa !important; -webkit-print-color-adjust: exact;">

                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  

        </td>
        <td align="right"  style="padding: 0;  line-height: 10px; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
            
                
            <font size="1">
                <b><?php echo "SUB TOTAL Bs ".number_format($venta[0]['venta_subtotal'],2,'.',','); ?></b><br>
            </font>
            

            <font size="1">
                <?php echo "TOTAL DESCUENTO Bs ".number_format($venta[0]['venta_descuento'],2,'.',','); ?><br>
            </font>
            <font size="2">
            <b>
                <?php echo "TOTAL FINAL Bs: ".number_format($venta[0]['venta_total'] ,2,'.',','); ?><br>
            </b>
            </font>
            <font size="1" face="arial narrow">
                <?php echo "SON: ".num_to_letras($total_final,' Bolivianos'); ?><br>            
            </font>
            <font size="1">
                <?php echo "EFECTIVO Bs ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                <?php echo "CAMBIO Bs ".number_format($venta[0]['venta_cambio'],2,'.',','); ?>
            </font>
            
            
        </td>          
    </tr>
<!--
    <tr >
        <td colspan="3">

         </td>
    </tr>    -->
    
</table>

<table class="table" style="width: <?php echo $ancho;?>cm;">
        <tr>
            <td  style="padding: 0">
                <center>
                    __________________________<br>
                            ENTREGE CONFORME
                </center>  
            </td>
            <td style="padding: 0">
            </td>
            <td  style="padding: 0">
                <center>
                    __________________________<br>
                            RECIBI CONFORME
                </center>  
            </td>
        </tr>
    </table>

</div>