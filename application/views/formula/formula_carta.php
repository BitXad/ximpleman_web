    
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

}
td {
border:hidden;
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
      $ancho = 17;//$parametro[0]["parametro_anchofactura"];
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>
<div class=" table-responsive" style="padding: 0;">
    
<table class="table">
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" > </td>
<td style="padding: 0;">
    
<table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height: 9px;" >
                
            <center>
                    <font size="2" face="Arial black"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <?php if (isset($empresa[0]['empresa_eslogan'])){ ?>
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
                   
        <td style="width: 6cm; padding: 0; line-height: 12px; " > 
            <center>
                <br>
                   

                <font size="3" face="arial"><b>FORMULA DE PRODUCCIÓN</b></font> <br>
                <font size="3" face="arial"><b>Nº 00<?php echo $formula['formula_id']; ?></b></font> <br>
                <!--<font size="1" face="arial"><b>Expresado en <?php echo $parametro[0]['moneda_descripcion']; ?><br>T.C. <?php echo number_format($moneda['moneda_tc'],2,".",","); ?></b></font> <br>-->
                <!--<font size="1" face="arial"><b><?php echo $formula['formula_fechacreacion']." ".$formula['formula_hora']; ?></b></font> <br>-->
            </center>
        </td>
        
        <td style="width: 6cm; padding: 0; line-height: 9px;" >
                _______________________________________________                
                   
                <br><br> 
                <small>
                    
                <?php $fecha = new DateTime($formula['formula_fechacreacion']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                    <!--<b>CODIGO: </b><?php echo $formula['cliente_codigo']." / NIT: ".$formula['cliente_nit']; ?> <br>-->
                    <b>FORMULA: </b><?php echo $formula['formula_nombre'].""; ?><br>
                    <b>PRODUCTO: </b><?php echo $formula['producto_nombre'].""; ?><br>
                    <b>COSTO Bs: </b><?php echo number_format($formula['formula_costounidad'],2,".",",").""; ?><br>
                    <b>PRECIO Bs: </b><?php echo number_format($formula['formula_preciounidad'],2,".",",").""; ?>
                    
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
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>UNIDAD</b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>CANTIDAD</b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>P.UNIT<br><?php echo $parametro[0]["moneda_descripcion"]; ?></b></td>
                <!--<td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>SUB.TOT<br><?php echo $parametro[0]["moneda_descripcion"]; ?></b></td>-->
                <!--<td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>DESC.<br><?php echo $parametro[0]["moneda_descripcion"]; ?></b></td>-->
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>TOTAL<br><?php echo $parametro[0]["moneda_descripcion"]; ?></b></td>               
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
                    <!-- <b>TOTAL<br> -->
                    <?php
//                        if ($parametro["moneda_id"]==1){
//                            echo $moneda["moneda_descripcion"];
//                        }else{
//                            echo "Bs";
//                        }
                    ?>
                    </b></td>               
           </tr>
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 $total_final = 0;
                 $total_final_me = 0;

                 foreach($detalle_venta as $d){;
                        $cont = $cont+1;
                        $cantidad += $d['detalleformula_cantidad'];
                        $total_descuento += 0; 
                        $total_final += $d['detalleformula_costo'];
 
            ?>
           <tr>
                <td align="center" style="padding: 0"><?php echo number_format($d['detalleformula_cantidad'],2,".",","); ?></td>
                <td style="padding: 0"><font style="font-size:10px; font-family: arial;"> <?php echo $d['producto_nombre'];?>
                        <?php
                        
//                            $preferencia = $d['detalleformula_preferencia'];
//                            $caracteristicas = $d['detalleformula_caracteristicas'];
//
//                            if ($preferencia !="null" && $preferencia!="-" && $preferencia!="")
//                                echo " /".nl2br($preferencia);
//
//                            if ($caracteristicas!="null" && $caracteristicas!='-')
//                                echo "<br>".nl2br($caracteristicas);
                        
                        ?>
                </td>
                <td align="right" style="padding: 0">
                    <center>
                        <?php echo $d["producto_unidad"] ; ?>
                    </center>
                </td>
                
                <td align="center" style="padding: 0"><?php echo number_format($d['detalleformula_cantidad'],2,'.',','); ?></td>
                <td align="center" style="padding: 0"><?php echo number_format($d['detalleformula_costo'],2,'.',','); ?></td>
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleformula_cantidad'] * $d['detalleformula_costo'],2,'.',','); ?></td>
                <!--<td align="right" style="padding: 0"><?php echo number_format($d['detalleformula_descuento']*$d['detalleformula_cantidad'],2,'.',','); ?></td>-->
                <!--<td align="right" style="padding: 0"><?php echo number_format($d['detalleformula_total'],2,'.',','); ?></td>-->
                <td align="right" style="padding: 0">
                    
                    <?php
//                        if ($parametro[0]["moneda_id"]==1){
//                            $total_final_me += $total_final / $d['detalleformula_tc'];
//                            echo number_format($d['detalleformula_total'] / $d['detalleformula_tc'],2,'.',',');
//                            
//                        }else{
//                            $total_final_me += $total_final * $d['detalleformula_tc'];
//                            echo number_format($d['detalleformula_total'] * $d['detalleformula_tc'],2,'.',',');
//                            
//                        }
                    ?>    
                    
                </td>
           <!--</tr>-->
           <?php } ?>
       </table>
    
    <table class="table" style="max-width: <?php echo $ancho;?>cm;">
    <tr style="border-top-style: solid; background-color: #aaa; border-color: black; ">
        
        <td align="left" style="background-color: #aaa !important; -webkit-print-color-adjust: exact; line-height: 10px;">
                            
<!--                USUARIO: <b><?php echo $formula['usuario_nombre']; ?></b><br>
                COD.: <b><?php echo $formula['formula_id']; ?></b><br>
                TRANS.: <b><?php echo $formula['tipotrans_nombre']; ?></b><br>
                CUOTA INIC. <?php echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php echo number_format($formula['credito_cuotainicial'],2,'.',','); ?></b><br>
                SALDO <?php echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php echo number_format($formula['formula_total']-$formula['credito_cuotainicial'],2,'.',','); ?></b><br>                -->
        </td>
        <td align="right" style="background-color: #aaa !important; -webkit-print-color-adjust: exact;">
            <center>
        
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  

        </td>
        <td align="right"  style="padding: 0;  line-height: 10px; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
            

            
            
        </td>          
    </tr>
    
    
    <tr>
        <td colspan="3">
            <b>NOTA: </b><?php // echo $formula['formula_glosa']; ?>
         </td>
    </tr>
    
    
</table>

<table class="table" style="width: <?php echo $ancho;?>cm;">
        <tr>
            <td  style="padding: 0">
                <center>
                    __________________________<br>
                            ENTREGE CONFORME
                </center>  
                <?php echo date("d/m/Y H:i:s"); ?>
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

</td>
</tr>    
</table>
</div>