<style>
    body{
        text-align: left;         
    }
    hr{
        height: 2px;
        color: black;
        margin:0% 0% 0% 0%;
    }
    h3{
        margin-bottom: 0;
        padding-bottom: 0;
        text-indent: 0;
    }
    .box1{
        width:100%;
        margin:0% 12%;
    }
    .box2{
        margin:0%;
        border-top:2px solid black;
        font-family: "Arial", Arial, Arial, arial;
        font-size: 11px;
        padding: 0px;
    }
    .box4{
        width:100%;
        margin:0% 0% 0% 0%;
        font-family: "Arial", Arial, Arial, arial;
        font-size: 11px;
        border-bottom:1px solid black;
        padding: 0px;
    }
    .box{
        overflow: hidden;
    }
    .content{
        min-height: 0;
        padding: 0;
        padding-left: 15px;
        font-family: "Arial", Arial, Arial, arial;
        font-size: 12px;
        text-align: justify;
    }
    .left{
        float: left;
        width: 50%;
    }
    .left .content{
       
    }
    .right{
        float: right;
        width: 50%;
    }
    .left1{
        float: left;
        font-family: "Arial", Arial, Arial, arial;
        font-size: 11px;
        width: 25%;
        min-height: 0;
        text-indent: 0px;
    }
    .medio1{
        float: left;
        width: 35%;
    }
    .right1{
        float: right;
        width: 40%;
    }
    table th{
         background: rgb(234, 237, 237);
        text-align: center;
    }
    table td{
        text-align: right;
        font-size: 10px;
        padding: 1px;
        margin: 1px;
        border: 1px;
    }
    #mitabla{
        /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
        font-family: "Arial", Arial, Arial, arial;
        font-size: 11px;
        border-collapse: collapse;
        width: 100%;
    }
    #mitabla td{
        border: none;
        padding-top: 0px;
        padding-bottom: 0px;
    }
    #mitabla th {
        border-top:2px solid black;
        border-bottom:2px solid black;
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        background-color: white;
        font-size: 12px;
        font-weight: bold;
    }

    #mitabla2{
        /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
        font-family: "Arial", Arial, Arial, arial;
        font-size: 11px;
        border-collapse: collapse;
        width: 100%;
    }

    #mitabla2 td{
        border: none;
        padding-top: 0px;
        padding-bottom: 0px;
    }
    #mitabla2 th{
        border: none;
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        background-color: white;
        font-size: 12px;
        font-weight: bold;
    }
 </style>
 
 <?php
    //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
    $ancho = $parametro["parametro_anchofactura"]."cm";
    $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
    $decimales = $parametro["parametro_decimales"];
?>
 <div class=" table-responsive" style="padding: 0;">
    <table class="table">
        <tr>
            <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" > </td>
            <td style="padding: 0;">
                <table class="table table-striped" style="width: <?php echo $ancho; ?>; padding: 0;">
                    <tr>
                        <td style="width: 25%; padding: 0; line-height:10px;" >
                            <center>
                                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60"><br>
                                <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                                <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                                <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                                <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?></font><br>
                                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                                <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                            </center>                      
                        </td>

                        <td style="width: 25%; padding: 0" > 
                            <center>

                                <br><br>
                                <font size="3" face="arial"><b>ORDEN DE COMPRA</b></font> <br>
                                <font size="3" face="arial"><b>Nº 00<?php echo $ordencompra[0]['ordencompra_id']; ?></b></font> <br>
                                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

                            </center>
                        </td>
                        <td style="width: 25%; padding: 0; text-align: left" >


                        <br><br><br><font size="2" face="Arial"> <b>PROVEEDOR: </b><?php echo $ordencompra[0]['proveedor_nombre'];?>
                        <!--<b>FORMA DE PAGO: </b><?php //echo $ordencompra[0]['tipotrans_nombre'];?><br>-->
                        <br><b>FECHA: </b><?php echo date('d/m/Y',strtotime($ordencompra[0]['ordencompra_fecha'])) ; ?> <?php echo $ordencompra[0]['ordencompra_hora'];?>
                        <br><b>ESTADO: </b><?php echo $ordencompra[0]['estado_descripcion'];?><br>
                        </font>
                        </td>
                    </tr>
                </table>
                <table class="table table-striped " border-bottom="1" id="mitabla" style="width: <?php echo $ancho; ?>; padding: 0;">                        
                    <tr>
                        <th>ITEM</th>
                        <th>CODIGO</th>
                        <th>CONCEPTO</th>
                        <th>UNIDAD</th>
                        <th>CANT.</th>
                        <th>UNIT.</th>
                        <!--<th>SUBTOTAL</th>
                        <th>DESC.</th>
                        <th>D.GLOB</th>-->
                        <th>TOTAL</th>
                    </tr>
                    <?php
                    $cont = 0;
                    foreach($detalle_ordencompra as $dc) {;
                    $cont = $cont+1; ?>
                    <tr>
                        <td class="text-center"><?php echo $cont;?></td>
                        <td style="text-align: center;"><?php echo $dc['detalleordencomp_codigo'];?></td>
                        <td style="text-align: left;"><?php echo $dc['producto_nombre'];?></td>                            
                        <td class="text-center"><?php echo $dc['detalleordencomp_unidad'];?></td>
                        <td><?php echo number_format($dc['detalleordencomp_cantidad'],'2','.',',');?></td>
                        <td><?php echo number_format($dc['detalleordencomp_costo'],'2','.',',');?></td>
                        <!--<td><?php /*echo number_format($dc['detalleordencomp_subtotal'],'2','.',',');?></td>
                        <td><?php echo number_format($dc['detalleordencomp_descuento'],'2','.',',');?></td>
                        <td><?php echo number_format($dc['detalleordencomp_descglobal'],'2','.',',');*/ ?></td>-->
                        <td><?php echo number_format($dc['detalleordencomp_total'],'2','.',',');?></td>
                    </tr> 
                    <?php } ?>
                    <tr style="border-top:2px solid black; margin: 0;padding: 0; font-size: 10pt">
                        <td colspan="6"><b>TOTAL FINAL  <?php echo $ordencompra[0]['moneda_descripcion'];?>: </b></td>
                        <td><b><?php echo  number_format($ordencompra[0]['ordencompra_totalfinal'],'2','.',',');?></b></td>
                    </tr>
                    <tr>
                        <td class="text-left" colspan="7">
                            <font size="1" face="arial"><b>Orden de Compra Realizada por: </b><?php echo $ordencompra[0]['usuario_nombre'];?></font>
                        </td>
                    </tr>
                </table>
             </td>
         </tr>
     </table>
 </div>
