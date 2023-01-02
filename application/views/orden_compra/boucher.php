<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
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


table{
width : 7cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;
border-spacing : 0 0;
border-collapse : collapse;
font-family: Arial narrow;
font-size: 7pt;
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
padding : 0 0px 0 0px;
/*border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;*/
}
</style>
<!--------------------- fin script buscador --------------------------------------->
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

<table class="table" style="width: <?php echo $ancho?>" >
    <tr>
<!--        <td style="padding: 0; width: 0cm">-->
        <td style="padding: 0;" colspan="4">
                
            <center>
                               
                    
                    <!--<img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                    
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <?php if (isset($empresa[0]['empresa_propietario'])){ ?>
                    <font size="1" face="Arial"></b>

                        <?php  echo "<b> DE: ".$empresa[0]['empresa_propietario'] ; ?>

                        </b></font><br>
                    <?php } ?>

                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>
                    <?php //if($factura[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         //else {  $titulo1 = "NOTA DE VENTA"; $subtitulo = " "; }?>
                   
                    
                <font size="3" face="arial"><b>COMPRA</b></font> <br>
                <font size="1" face="arial"><b>Nº 00<?php echo $compra[0]['compra_id']; ?></b></font> <br>
                
                   
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <table style="width:<?php echo $ancho?>" >
                    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                        <td style="font-family: arial; font-size: 8pt; padding: 0;">

                            
                            <b>TIPO TRANSACCION:  </b><br>
                            <b>FORMA DE PAGO:  </b><br>

                        </td>
                        <td style="font-family: arial; font-size: 8pt; padding: 0;">
                            <?php echo  $compra[0]['tipotrans_nombre']; ?> <br>
                            <?php echo $compra[0]['forma_nombre']; ?> 
                        </td>
                    </tr>
                </table>
                
            </center>
        </td>
    </tr>            

<tr  style="border-top-style: solid; border-top-width: 0px; border-bottom-style: solid; border-bottom-width: 2px;" >
        <td colspan="4" style="padding: 0;  font-size: 9pt;">
            
                <?php $fecha = new DateTime($compra[0]['compra_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'] ?> <?php echo implode("/", array_reverse(explode("-", $compra[0]['compra_fecha']))); ?><br>
                    <b>PROVEEDOR: </b><?php if ($compra[0]['proveedor_nombre']==''){ echo "A QUIEN CORRESPONDA"; }else{ echo $compra[0]['proveedor_nombre']; }?>            
        </td>
    </tr>
<!--                </div>-->

        <tr  style="border-top-style: solid; border-bottom-style: solid; " >
               
                <td align="center" style="padding: 0;"><b>CANT</b></td>
                <td align="center" style="padding: 0;"><b>DESCRIPCIÓN</b></td>
                <td align="center" style="padding: 0;"><b>P.UNIT</b></td>
                <td align="center" style="padding: 0;"><b>TOTAL</b></td>
                
           </tr>
           <?php $cont = 0;
                 

                 foreach($detalle_compra as $d){
                        $cont = $cont+1;
                       
                        ?>
           <tr style="font-size: 8pt;">
                <td align="center" style="padding: 0;"><?php echo $d['detallecomp_cantidad']; ?></td>
                <td style="padding: 0;"><font style="size:5px; font-family: arial narrow;" style="padding: 0;"> <b><?php echo $d['producto_nombre']; ?></b></td>
                <td align="right" style="padding: 0;"><?php echo number_format($d['detallecomp_costo'],2,'.',','); ?></td>
                <td align="right" style="padding: 0;"><?php echo number_format($d['detallecomp_total'],2,'.',','); ?></td>
           </tr>
           <?php }?>
  

<tr style="border-top-style: solid; border-top-width: 2px;">
        
            
        <td align="right" style="padding: 0;" colspan="4">
            
            <font size="1">
                <b><?php echo "SUB TOTAL Bs ".number_format($compra[0]['compra_subtotal'],2,'.',','); ?></b><br>
            </font>
            

            <font size="1">
                <?php echo "TOTAL DESCUENTO Bs ".number_format($compra[0]['compra_descuento'],2,'.',','); ?><br>
            </font>
            <font size="1">
                <?php echo "DESCUENTO GLOBAL Bs ".number_format($compra[0]['compra_descglobal'],2,'.',','); ?><br>
            </font>
            <font size="2">
            <b>
                <?php echo "TOTAL FINAL Bs: ".number_format($compra[0]['compra_totalfinal'] ,2,'.',','); ?><br>
            </b>
            </font>
            <font size="1" face="arial narrow">
                <?php echo "SON: ".num_to_letras($compra[0]['compra_totalfinal'],' Bolivianos'); ?><br>            
            </font>
            
        </td>          
    </tr>
   
<tr>
        <td nowrap style="padding: 0;" colspan="4">
            <font size="2">
            
                NOTA: <b><?php echo  $compra[0]['compra_glosa']; ?></b><br>
                
            </font>
        </td>           
    </tr>
      
    <tr >
        <td style="padding: 0;  line-height: 12px;" colspan="4">
               USUARIO: <b><?php echo $compra[0]['usuario_nombre']; ?></b> 
           
         </td>
    </tr>    
    
</table>

</td>    
</tr>    
</table>   

<table class="table" style="max-width: 7cm; margin-top: 15px;">
            <tr>
                <td> <center>
                
                        <?php echo "------------------------------------"; ?><br>
                        <?php echo "RECIBI CONFORME"; ?><br>
                    
                    </center>
                </td>
                <td width="20">
                    <?php echo "     "; ?><br>
                    <?php echo "     "; ?><br>
                </td>
                <td>
                    <center>

                        <?php echo "------------------------------------"; ?><br>
                        <?php echo "ENTREGUE CONFORME"; ?><br>   

                    </center>
                </td>
            </tr>
        </table>