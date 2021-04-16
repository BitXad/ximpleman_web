

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
font-size: 7pt;  

}
td{
border:none!important;
}


td#comentario {
vertical-align : bottom;
border-spacing : 0;
}
div#content {
background : #ddd;
font-size : 7px;
margin : 0 0 0 0;
padding : 0 1px 0 1px;
border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>

<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">



<table class="table" style="max-width: <?php echo $ancho; ?>; margin-bottom: 0px;" >
    <tr>
        <td colspan="3">
                
            <center>
                               
                    <!--<img src="<?php echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>
                    
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>

                <font size="3" face="arial"><b>RECIBO DE INGRESO</b></font> <br>
                <font size="2" face="arial"><b>Nº:  00<?php echo $ingreso[0]['ingreso_id']; ?> </b></font>           
            </center>                      
        </td>           
    </tr>           
    <tr style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;">           
        <td colspan="3">           
            <center>                      
                             
                <?php $fecha = new DateTime($ingreso[0]['ingreso_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                    
                    <b>RECIBI DE: </b><?php echo $ingreso[0]['ingreso_nombre'].""; ?>

            </center>                      
     </td>
 </tr>
     

<tr >
    <td align="left" ><b>LA SUMA DE: </b></td>
    <td align="right" colspan="2"> 
        <font face="Arial" size="3">
        <b>
            <?php echo "Bs ".number_format($ingreso[0]['ingreso_monto'],2,'.',','); ?>            
        </b>
        </font>
    </td>
</tr>
           
<tr>
    <td align="left"><b>POR CONCEPTO DE: </b></td>
    <td colspan="2"><?php echo $ingreso[0]['ingreso_categoria'];?><br>
                  (<?php echo $ingreso[0]['ingreso_concepto'];?>)</td>
</tr>
               
<tr style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;">
    <td align="right" colspan="3">
        <font size="2">
            <b>
                <?php echo "TOTAL FINAL ".$ingreso[0]['ingreso_moneda'].": ".number_format($ingreso[0]['ingreso_monto'] ,2,'.',','); ?><br>
            </b>
            </font>
            <font size="1" face="arial narrow">
                <?php
                echo "SON: ";
                if($parametro[0]['moneda_id'] == 1){
                    echo num_to_letras($ingreso[0]['ingreso_monto']);
                }else{
                    echo num_to_letras($ingreso[0]['ingreso_monto'], $lamoneda[1]['moneda_descripcion']);
                }
                ?> 
                <?php //echo "SON: ".num_to_letras($ingreso[0]['ingreso_monto'],' Bolivianos'); ?>           
            </font>
           
            
    </td>          
</tr>
   
     
<tr>
    <td colspan="3">
         No. TRANSACCION:  <b> 00<?php echo $ingreso[0]['ingreso_numero']; ?> </b><br>

           USUARIO: <b><?php echo $ingreso[0]['usuario_nombre']; ?></b>
           <br>
           <br>
           <br>
     </td>
</tr>    
    
<tr style="font-family: Arial Narrow;">
                <td> <center>
                
                        <?php echo "RECIBI CONFORME"; ?><br>
                    
                    </center>
                     <?php echo date("d/m/Y H:i:s");?>
                </td>
                <td width="10">
                </td>
                <td>
                    <center>

                        <?php echo "ENTREGUE CONFORME"; ?><br>   

                    </center>
                </td>
</tr>


</table>


</td>    
</tr>    
</table>
