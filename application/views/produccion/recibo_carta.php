<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
<style type="text/css">
    p{
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
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"];
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
                                <font size="3" face="arial"><b>NOTA DE PRODUCCION</b></font> <br>
                                <font size="3" face="arial"><b>Nº 00<?php echo $produccion['produccion_numeroorden']; ?></b></font> <br>
                                <font size="1" face="arial"><b>Expresado en <?php echo $parametro[0]['moneda_descripcion']; ?><br>T.C. <?php echo $moneda['moneda_tc']; ?></b></font> <br>
                                <!--<font size="1" face="arial"><b><?php //echo $venta[0]['venta_fecha']." ".$venta[0]['venta_hora']; ?></b></font> <br>-->
                            </center>
                        </td>
                        <td style="width: 6cm; padding: 0; line-height: 9px;" >
                            _______________________________________________
                            <br><br>
                            <small>
                                <?php $fecha = new DateTime($produccion['produccion_fecha']); 
                                        $fecha_d_m_a = $fecha->format('d/m/Y');
                                  ?>    
                                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                                    <!--<b>CODIGO: </b>--><?php /*echo $venta[0]['cliente_codigo']." / NIT: ".$venta[0]['cliente_nit']; ?> <br>
                                    <b>SEÑOR(ES): </b><?php echo $venta[0]['cliente_razon'].""; ?><br>
                                    <b>DIRECCIÓN: </b><?php echo $venta[0]['cliente_direccion'].""; ?><br>
                                    <b>ZONA: </b><?php echo $venta[0]['zona_nombre'].""; ?>
                                    <?php
                                    if(($venta[0]['cliente_telefono'] != null || $venta[0]['cliente_telefono'] != "") || ($venta[0]['cliente_celular'] != null || $venta[0]['cliente_celular'] !="")){
                                    $guion = "";
                                    if($venta[0]['cliente_telefono'] >0 && $venta[0]['cliente_celular'] >0){
                                        $guion = " - ";
                                    }
                                    ?>
                                    <br><b>TELEFONOS: </b><?php echo $venta[0]['cliente_telefono'].$guion.$venta[0]['cliente_celular'].""; ?>
                                    <?php }*/ ?>
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
                        <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>P.UNIT<br><?php echo $parametro[0]["moneda_descripcion"]; ?></b></td>
                        <!--<td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>SUB.TOT<br><?php echo $parametro[0]["moneda_descripcion"]; ?></b></td>-->
                        <!--<td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>DESC.<br><?php echo $parametro[0]["moneda_descripcion"]; ?></b></td>-->
                        <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>TOTAL<br><?php echo $parametro[0]["moneda_descripcion"]; ?></b></td>               
                        <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
                            <b>TOTAL<br>
                            <?php
                                if ($parametro[0]["moneda_id"]==1){
                                    echo $moneda["moneda_descripcion"];
                                }else{
                                    echo "Bs";
                                }
                            ?>
                            </b></td>               
                    </tr>
                    <?php
                        $cont = 0;
                        $cantidad = 0;
                        $total_descuento = 0;
                        $total_final = 0;
                        $total_final_me = 0;
                        foreach($detalle_venta as $d){;
                            $cont = $cont+1;
                            $cantidad += $d['detalleven_cantidad'];
                            $total_descuento += $d['detalleven_descuento']; 
                            $total_final += $d['detalleven_total'];
                    ?>
                    <tr>
                        <td align="center" style="padding: 0"><?php echo $d['detalleven_cantidad']; ?></td>
                        <td style="padding: 0"><font style="font-size:10px; font-family: arial;"> (<?php echo $d['detalleven_codigo']; ?>) <?php echo $d['producto_nombre'];?>
                        <?php
                            $preferencia = $d['detalleven_preferencia'];
                            $caracteristicas = $d['detalleven_caracteristicas'];

                            if ($preferencia !="null" && $preferencia!="-" && $preferencia!="")
                                echo " /".nl2br($preferencia);

                            if ($caracteristicas!="null" && $caracteristicas!='-')
                                echo "<br>".nl2br($caracteristicas);
                        ?>
                        </td>
                        <td align="right" style="padding: 0">
                            <center>
                                <?php echo $d["producto_unidad"] ; ?>
                            </center>
                        </td>

                        <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_precio']+$d['detalleven_descuento'],2,'.',','); ?></td>
                        <!--<td align="right" style="padding: 0"><?php echo number_format($d['detalleven_subtotal'],2,'.',','); ?></td>-->
                        <!--<td align="right" style="padding: 0"><?php echo number_format($d['detalleven_descuento']*$d['detalleven_cantidad'],2,'.',','); ?></td>-->
                        <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_total'],2,'.',','); ?></td>
                        <td align="right" style="padding: 0">

                            <?php
                                if ($parametro[0]["moneda_id"]==1){
                                    $total_final_me += $total_final / $d['detalleven_tc'];
                                    echo number_format($d['detalleven_total'] / $d['detalleven_tc'],2,'.',',');

                                }else{
                                    $total_final_me += $total_final * $d['detalleven_tc'];
                                    echo number_format($d['detalleven_total'] * $d['detalleven_tc'],2,'.',',');

                                }
                            ?>    

                        </td>
                   </tr>
                   <?php } ?>
                </table>
                <table class="table" style="max-width: <?php echo $ancho;?>cm;">
                    <tr style="border-top-style: solid; background-color: #aaa; border-color: black; ">
                        <td align="left" style="background-color: #aaa !important; -webkit-print-color-adjust: exact; line-height: 10px;">
                USUARIO: <b><?php echo $produccion['usuario_nombre']; ?></b><br>
                COD.: <b><?php echo $produccion['produccion_id']; ?></b>
                <!--<?php
                /*if($parametro[0]['parametro_puntos'] >0){
                    echo "PUNTOS: <b>".$venta[0]['cliente_puntos']."</b>";
                }
                ?>
                <br>
                TRANS.: <b><?php echo $venta[0]['tipotrans_nombre']; ?></b><br>
                CUOTA INIC. <?php echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php echo number_format($venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>
                SALDO <?php echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],2,'.',',');*/ ?></b><br>
                -->
        </td>
        <td align="right" style="background-color: #aaa !important; -webkit-print-color-adjust: exact;">

                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  

        </td>
        <td align="right"  style="padding: 0;  line-height: 10px; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
            
                
            <?php /*if ($venta[0]['venta_descuento']>0){ ?>
            
            <font size="1">
                <b><?php echo "SUB TOTAL ".$parametro[0]["moneda_descripcion"].": ".number_format($venta[0]['venta_subtotal'],2,'.',','); ?></b><br>
            </font>
            
            <font size="1">
                <?php echo "TOTAL DESCUENTO ".$parametro[0]["moneda_descripcion"].": ".number_format($venta[0]['venta_descuento'],2,'.',','); ?>
            </font>
            
            <?php }*/ ?>
            
            <font size="2">
            <b>
                <br><?php echo "TOTAL FINAL ".$parametro[0]["moneda_descripcion"].": ".number_format($produccion['produccion_total'] ,2,'.',','); ?><br>
            </b>
            </font>
            
            <font size="1" face="arial narrow">
                <?php                    
                
                if ($parametro[0]["moneda_id"]==1){
                    $moneda_nombre = "Bolivianos";

                }else{
                    $moneda_nombre = $parametro[0]["moneda_descripcion"];
               }
                
                ?>
            
                <?php echo "SON: ".num_to_letras($total_final,$moneda_nombre); ?><br>            
            
            </font>
            
            <font size="2">
            <b>
                <!------------------ TOTAL EN OTRA MONEDA------------------------>
                    <?php 
                        $total_final_equivalente = 0;
                        $tfe = "";
                        
                            if($parametro[0]['moneda_id']==1){
                                
                                $total_final_equivalente =  $produccion['produccion_total'] / $d['detalleven_tc'];
                                $tfe = "".$moneda['moneda_descripcion'];
                                
                            }else{
                                
                                $total_final_equivalente = $produccion['produccion_total'] * $d['detalleven_tc'];
                                $tfe = "Bs ";
                            }
                        
                        echo $tfe." ".number_format($total_final_equivalente,2,'.',',');
                    ?>              
                   
                    <!------------------------------------------>
                <?php                    
                
                /*if ($parametro[0]["moneda_id"]==1){
                    echo $parametro[0]["moneda_descripcion"]." ".number_format($total_final_me,2,'.',',');

                }else{
                    echo "Bs ".number_format($total_final_me,2,'.',',');
               }*/
                
                ?>
                <br>
            </b>
            </font>
            <!--<font size="1">
                <?php //echo "EFECTIVO Bs ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                <?php //echo "CAMBIO Bs ".number_format($venta[0]['venta_cambio'],2,'.',','); ?>
            </font>-->
        </td>
    </tr>
    <?php
    /*if($venta[0]['venta_glosa'] != null || $venta[0]['venta_glosa'] != ""){
    ?>
    <tr>
        <td colspan="3">
            <b>NOTA: </b><?php echo $venta[0]['venta_glosa']; ?>
         </td>
    </tr>
    <?php }*/ ?>
    
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