    
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
                                            /*function imprimir()
                                            {
                                                /*$('#paraboucher').css('max-width','7cm !important');*/
                                                /* window.print(); 
                                            }*/
    });
</script>
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
    font-size: 9pt;
    line-height: 100%;   /*esta es la propiedad para el interlineado*/
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
width : 8cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;

font-family: Arial;
font-size: 8pt;  /* tamaño texto tabla */

td {

border:0px solid black;
font-size: 10px;
padding : 0 0 0 0;

}
td {
border-left:hidden;
}
}

th {

font-size: 8px;
padding : 0 0 0 0;

}



td#comentario {
vertical-align : bottom;
border-spacing : 0;
padding : 0;
}
div#content {
background : #ddd;
font-size : 9px;
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

<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>

<!-------------------------------------------------------->
<table class="table" >
<tr>
<td style="padding: 0; border: none; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0; border: none;">
    




<table class="table" style="width: <?php echo $ancho?>;">
    <tr>
        <td style="padding:0px; ">
            <br>
            <br>
            <?php

                    $opcion = $parametro[0]["parametro_mostrarnumero"]; //0 Ninguno, 1 - numeroventa, 2 - numerodetransacciones, 3 numero de factura , 4 - transaccion mensual 
                    
                        if ($opcion==1){ ?>
                            <font size="5" face="arial"><b><?php echo $venta[0]['venta_numeroventa']; ?></b></font>
                <?php } ?>
                            
                <?php   if ($opcion==2){ ?>
                            <font size="5" face="arial"><b><?php echo $venta[0]['venta_id']; ?></b></font>
                <?php   } ?>
                            
                <?php   if ($opcion==3){ ?>
                            <font size="5" face="arial"><b><?php echo $venta[0]['factura_numero']; ?></b></font>
                <?php   } ?>
                            
                <?php   if ($opcion==4){ ?>
                            <font size="5" face="arial"><b><?php echo $venta[0]['venta_numerotransmes']; ?></b></font>
                <?php   } ?>
                            
                            
        </td>
        <td style="padding: 0px">
                
            <!--<center style="padding:0px; line-height:14px;">-->

                
                <?php if($venta[0]['tiposerv_id']>0){ ?>
                <br>
                <font size="2" face="arial"><b><?php echo $venta[0]["tiposerv_descripcion"]; ?></b></font>
        
                <?php } ?>
      
                <br> 
                
                <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                <fa class="fa fa-calendar"> </fa> <?php echo $fecha_d_m_a." ".$venta[0]['venta_hora']; ?><br>
                <fa class="fa fa-user-o"> </fa> <?php echo $venta[0]['cliente_razon'].""; ?>
                <?php
                if($venta[0]['tiposerv_id'] == 12){
                    if ($venta[0]['venta_numeromesa']>0)
                        echo "Mesa: ".$venta[0]['venta_numeromesa'];
                }
                ?>
               
                <small>
                    <br><fa class="fa fa-vcard-o"> </fa> <?php echo $venta[0]['usuario_nombre']." ** ".date("d/m/y H:i:s") ; ?>
               </small>
<!--            </center>-->
            
        </td>
    </tr>
    
    
<!--    <tr style="" >
        <td colspan="2" align="left" style="padding: 0; padding: 0; border-top: dashed 1px #000; font-weight: bold; font-size: 12px;"></td>
        <td colspan="4" align="right" style="padding: 0; padding: 0; border-top: dashed 1px #000;"><b style="font-weight: bold; font-size: 12px;"> </b></td>
    </tr>-->
<!--    <tr>
        <td style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000; width: 0.8cm; font-size: 8pt;" colspan="4"><?php echo "OBS.: <b>".$venta[0]['venta_glosa']."</b>"; ?></td>
    </tr>
    -->

<!--
    <tr>
        <td  colspan="2" style="border-top:solid 1px #000;">
                <small>
                    CAJERO: <?php echo $venta[0]['usuario_nombre']." ** ".date("d/m/y H:m:s") ; ?>
               </small>
            <center>
            <font size="2">
                   
            </font>
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
            </center>
         </td>
    </tr>    
    -->
</table>
       
</td>    
</tr>    
</table>


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