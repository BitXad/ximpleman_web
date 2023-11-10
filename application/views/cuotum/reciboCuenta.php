
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<?php $tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"]."cm";
      //$margen_izquierdo = "col-xs-".$parametro["parametro_margenfactura"];;
      $margen_izquierdo = "col-xs-".$parametro["parametro_margenfactura"];;
?>

    <table class="table table-striped" style="width: <?php echo $ancho;?>; padding: 0;;margin: 0" >
    <tr style="line-height: 12px;">
        <td style="width: 33%; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 33%; padding: 0; line-height: 16px;" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>COMPROBANTE DE PAGO</b></font> <br>
                <font size="3" face="arial"><b>Nº 00<?php echo $cuota[0]['credito_id']; ?></b></font> <br>
                <font size="1" face="arial"><?php echo date("d/m/Y H:i:s"); ?></font> 

            </center>
        </td>
        <td style="width: 33%; padding: 0; text-align: left;line-height:9px; " >
                <br><br><br><br><br>
       <?php if ($cuota[0]['venta_id']>0) { ?>
    <font face="Arial" size="1"><b>VENTA No.: </b><?php echo $cuota[0]['venta_id']; ?></font><br>
    <?php } else { ?>
    <font face="Arial" size="1"><b>SERVICIO No.: </b><?php echo $cuota[0]['servicio_id']; ?></font><br>
    <?php } ?>
    <font face="Arial" size="1"><b>CREDITO No.: </b><?php echo $cuota[0]['credito_id']; ?></font><br>
    <font face="Arial" size="1"><b>RECIBO EXT.: </b><?php echo $cuota[0]['cuota_numercibo']; ?></font><br>
    <font face="Arial" size="1"><b>ESTADO: </b><?php echo $cuota[0]['estado_descripcion']; ?></font> 
                         
         
                   
        </td>
    </tr>
     
    
    
</table> 

     <table class="table table-striped" style="width: <?php echo $ancho;?>; padding: 0;margin: 0">
        <tr >
        <td style="width: 10cm;border-top: 1px solid black;padding: 0;background-color: #aaa !important; -webkit-print-color-adjust: exact !important;"><font face="Arial" size="1" ><b>CLIENTE: </b><?php echo $cuota[0]['cliente_nombre'];?></font></td>

        <td style="border-top: 1px solid black;padding: 0;background-color: #aaa !important; -webkit-print-color-adjust: exact !important;"><font face="Arial" size="1" ><b>FECHA: </b><?php echo date('d/m/Y',strtotime($cuota[0]['cuota_fecha'])); ?></font> </td>
        </tr>    
        </table>  

<div class="box" style="width: <?php echo $ancho;?>; padding: 10px;border-top: 1px solid black;border-bottom: 1px solid black; margin-bottom: 0">
    <table style="font-size: 10px;font-family: 'Arial', Arial, Arial, arial; ">
        <tr>
            <td align="left" style="width: 4cm"> SALDO TOTAL: <?= $moneda['moneda_descripcion'] ?></td> 
            <td align="right" style="width: 4cm"><?php echo number_format($cuota[0]['cuota_saldo'],'2','.',','); ?></td>
            <td style="width: 3cm"></td>
            <td style="width: 1cm"></td>
            <td align="left" style="width: 3cm">CUOTA Nº:</td>
            <td align="right" style="width: 3cm"><?php echo $cuota[0]['cuota_numcuota']; ?> / <?php echo number_format($cuota[0]['credito_numpagos']); ?></td>
        </tr> 
        <tr>
            <td align="left"> MONTO CUOTA: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right"><?php echo number_format($cuota[0]['cuota_total'],'2','.',','); ?> </td>
            <td style="width: 3cm"></td>
            <td style="width: 1cm"></td>
            <td align="left">LIMITE DE PAGO:</td>
            <td align="right"><?php echo date('d/m/Y',strtotime($cuota[0]['cuota_fechalimite'])); ?></td>
        </tr>
        <tr>
            <td align="left"> MONTO CANCELADO: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right"><?php echo number_format($cuota[0]['cuota_cancelado'],'2','.',','); ?></td>
            <td align="right" style="width: 4cm">CANCELADO:....................</td>
            <td style="width: 1cm"></td>
            <td align="left">MORA DIAS:</td>
            <td align="right"><?php echo number_format($cuota[0]['cuota_moradias']); ?></td>
        </tr> 
        <tr>
            <td colspan="2" align="left"> SON:
                <?php
                if($moneda['moneda_descripcion'] != "Bs"){
                    echo num_to_letras($cuota[0]['cuota_cancelado'], "USD"); 
                }else{
                    echo num_to_letras($cuota[0]['cuota_cancelado']);
                }
                ?>
            </td>
            
            <td style="width: 3cm"></td>
            <td style="width: 1cm"></td>
            <td align="left">MULTA MORA: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right"><?php echo number_format($cuota[0]['cuota_multa'],'2','.',','); ?> </td>
        </tr> 
        <tr>
            <td align="left"> SALDO PARC: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right"><?php echo number_format($cuota[0]['cuota_total']-$cuota[0]['cuota_cancelado'],'2','.',','); ?> </td>
            <td style="width: 3cm"></td>
            <td style="width: 1cm"></td>
            <td align="left">OTROS: <?= $moneda['moneda_descripcion'] ?></td>   
            
        </tr>
        <tr>
            <td align="left"> SALDO DEUDOR: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right"><?php echo number_format($cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes'],'2','.',','); ?> </td>
            <td align="right" style="width: 3cm">SALDO:....................</td>
            <td style="width: 1cm"></td>
            
        </tr>
        <tr>
            <td align="left"> GLOSA.-</td>
            <td align="right"><?php echo $cuota[0]['cuota_glosa']; ?> </td>
        </tr>
        <?php
        $res = "";        
        if($detalle_venta != ""){
            foreach ($detalle_venta as $venta) {
                $res .= " ".$venta['producto_nombre']." | ";  
            ?>
            <?php
            }
            ?>
            <tr>
                <td colspan="6">
                    <?php echo "<b>".$lacategoria."</b> "; ?>
                    <?php echo $res; ?>
                </td>
            </tr>
        <?php
        }
        ?>
        </table>
        
            </div>
 
<div style="text-align: right;width: <?php echo $ancho;?>; padding: 0;">

    <font size="1" face="Arial"><?php echo date("d/m/Y   H:i:s"); ?></font>

</div>
<center>
    <div class="col-md-12" style="margin-top: 50px;width: <?php echo $ancho;?>; padding: 0">
        <table>
            <tr style="line-height: 10px;">
                <td> <center>
                
                    <?php echo "-----------------------------------------------------"; ?><br>
                    <font face="Arial" size="1"><?php echo "RECIBI CONFORME"; ?></font>
                    </center>
                </td>
                <td width="100">
                    <?php echo "     "; ?><br>
                    <?php echo "     "; ?><br>
                </td>
                <td>
                    <center>
                    <?php echo "-----------------------------------------------------"; ?><br>
                    <font face="Arial" size="1"><?php echo "ENTREGUE CONFORME"; ?></font>              
                    </center>
                </td>
            </tr>
        </table>
        
    </div>
</center>
    
