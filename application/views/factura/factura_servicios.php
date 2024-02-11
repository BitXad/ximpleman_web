<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
<?php $padding = "style='padding:0; '"; 
    $ancho = "18cm";
    $ancho2 = "17cm"; ?>
<div class="box" style="width: <?php echo $ancho ?>">
<!-------------------------------------------------------->
<table class="table" style="width: 100%; padding: 0;" >
    <tr>
        <td style="width: 35%; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/logo.jpg') ?>" width="80px" height="60px"><br>
                    <font size="2" face="Arial"><b><?php echo $empresa['nombre_emp']; ?></b></font><br>
                    <font size="2" face="Arial"><b><?php echo $empresa['eslogan_emp']; ?></b></font><br>
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['sucursal_emp'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa['direccion_emp']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa['telefono_emp']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa['ubicacion_emp']; ?></font>
                

            </center>                      
        </td>
                   
        <td style="width: 30%; padding: 20;line-height:15px;" > 
            <center>
            
                <br>
                <font size="5" face="arial"><b>FACTURA</b></font> <br>
                <?php if ($tipo == 0){ ?>
                        <font size="1" face="arial"><b>ORIGINAL</b></font><br>
                <?php }else{ ?>
                        <font size="1" face="arial"><b>COPIA</b></font><br>                          
                <?php } ?>   
                
                <font size="1" face="arial"><?php echo date("d/m/Y   H:i:s  ") ; ?></font>
                 <br>
                
            </center>
        </td>
        <td style="width: 35%; padding: 0;" >
            
            
            <div style="width: 100%;border: 1px solid black;padding: 10px">
            <div>
                <font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $factura[0]['nitemisor_fact']; ?></font><br>
                <font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FACTURA Nº: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;00<?php echo $factura[0]['num_fact']; ?></font><br>
                <font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AUTORIZACION: &nbsp;&nbsp;<?php echo $factura[0]['orden_fact']; ?></font>
            </div></div>
            <center style="font-size: 12px;">
                CAPTACIÓN Y DEPURACIÓN Y DISTRIBUCIÓN DE AGUA
            </center>
                
            
            
            <font size="1" face="Arial"><b>MES DE COBRANZA:</b> <?php echo $factura[0]['mes_lec']; ?>/<?php echo $factura[0]['gestion_lec']; ?></font><br>
            <div style="width: 35%;border: 1px solid black;position: absolute;line-height:15px;padding: 10px">
                
            <font  size="1" face="arial"><b>&nbspLECT.ACTUAL[<?php echo date('d/m/Y',strtotime($factura[0]['fecha_lec']));?>]:</b> <?php echo $factura[0]['actual_lec']; ?><br>
            <b>&nbspLECT.ANTERIOR[<?php echo date('d/m/Y',strtotime($factura[0]['fechaant_lec']));?>]:</b> <?php echo $factura[0]['anterior_lec']; ?><br>
            <b>&nbspCONSUMO M3:</b> <?php echo $factura[0]['consumo_lec']; ?><br>
            <b>&nbspVENCIMIENTO:</b> <?php echo date('d/m/Y',strtotime($factura[0]['fechavenc_fact']));?><br>
            </font>
            
            </div>
        </td>
    </tr>
     
    
    
</table> 
    
<hr style="border: 0.5px solid black;width: 65%;margin-bottom: 0px;margin-top: -10px" align="left" >
    
  <table style="width: 65%; font-family: Arial; font-size:10px;margin-top: 0px;">
        <tr>
            <td><b>LUGAR Y FECHA: </b>
            <?php echo $empresa['ubicacion_emp']; ?>, <?php echo date('d/m/Y',strtotime($factura[0]['fecha_fact']));?>
            </td>
        </tr>
        <tr>    
            <td><b>CÓDIGO: </b>
            <?php echo $factura[0]['codigo_asoc'];?>
            &nbsp &nbsp &nbsp<b>CATEGORÍA: </b>
            <?php echo $factura[0]['categoria_asoc'];?>
            </td>
        </tr>
        <tr>    
            <td><b>SEÑOR(ES): </b>
            <?php echo $factura[0]['razon_fact'];?>
            </td>
        </tr>
        <tr>    
            <td><b>C.I.: </b>
            <?php echo $factura[0]['nit_fact'];?>
            </td>
        </tr>
        <tr>    
            <td><b>DIRECCÍON: </b>
            <?php echo $factura[0]['direccion_asoc'];?>
            </td>
        </tr>
    </table>
  
       <br class="no-print">
    <table style="width: 100%; padding: 0; font-family: Arial; font-size:10px;"> 
   
<tr>
    <th style="text-align: center;border: 1px solid black" width="10%">CANT.</th>
    <th style="text-align: center;border: 1px solid black" >DESCRIPCIÓN</th>
    <th style="text-align: center;border: 1px solid black" width="20%">P.UNIT.</th>
    <th style="text-align: center;border: 1px solid black" width="20%">SUBTOTAL</th>
</tr>
                      <?php
                      
                      $total=0;
                      $totalexento = 0;
                      foreach($detalle_factura as $d) {
                   
                      $total += $d['total_detfact'];
                      if($d['exento_detfact'] == "SI"){
                          $totalexento += $d['total_detfact'];
                      } ?>
                      <tr>
                      <td style="border: 1px solid black" align="center"><?php echo $d['cant_detfact']; ?></td>
                      <td style="border: 1px solid black;padding-left: 3px"><?php echo $d['descip_detfact']; ?></td>
                      <td style="border: 1px solid black;padding-right: 3px" align="right"><b><?php echo number_format($d['punit_detfact'], 2, ".", ","); ?></b></td>
                      <td style="border: 1px solid black;padding-right: 3px" align="right"><b><?php echo number_format($d['total_detfact'], 2, ".", ","); ?></b></td>
                  
                      </tr>     
                      <?php  } ?>
                      

   
    </table>
<br>
    
<table style="width: 100%; padding: 0; font-family: Arial; font-size:12px;" >
    
    <tr>
        <td rowspan="4" style="width: 20%; padding: 0;">
        <center>        
            <img src="<?php echo $codigoqr; ?>"  width="100" height="100">
        </center>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>        
        <td></td>        
    </tr>
    
    <tr>
        <td colspan="1"></td>
        <td colspan="2" style="text-align: right;"><b>IMPORTE VALIDO PARA CREDITO Bs</b></td>
        <td>&nbsp; &nbsp;</td>
        <td><b><?php echo number_format($total-$totalexento, 2, ".", ","); ?></b></td>
    </tr>
    
    <tr>
        <td colspan="2">SON: <?php echo num_to_letras($total); ?></td>
        <td colspan="1" style="text-align: right; font-size: 14px;"><b>TOTAL A PAGAR Bs</b></td>
        <td>&nbsp; &nbsp;</td>
        <td style="font-size: 14px;"><b><?php echo number_format($total, 2, ".", ","); ?></b></td>
    </tr>
    
    <tr>
        <td colspan="5" style="line-height: 12px; font-size: 12px;">
            <hr style="width: 100%;border: 2px solid black;margin-top: 1px;margin-bottom: 0px" align="right">            
            CÓDIGO DE CONTROL: <?php echo $factura[0]['codcontrol_fact']; ?> <br>
            FECHA LÍMITE DE EMISIÓN: <?php echo date('d/m/Y',strtotime($factura[0]['fechaemision_fact']))?><br>
            TRANS.: <?php echo $factura[0]['id_fact']; ?> <br>
            CAJERO: <?php echo $factura[0]['nombre_usu'];  ?>
            <center style="font-size: 8px;">
                 <?php echo $factura[0]['factura_leyenda1'];  ?><br>
            </center>
            <center style="font-size: 10px;">
                 <?php echo $factura[0]['factura_leyenda2'];  ?><br>
            </center>
        
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        
    </tr>
    
</table>


<!--    <table style="width: 100%; padding: 0; font-family: Arial; font-size:12px;"> 
   
                      <tr>
                          
                        <th width="20%">&nbsp;<img src="<?php echo $codigoqr; ?>" style="position: absolute;" width="100" height="100"></th>
       
                        <th style="text-align: left;" width="45%" align="center">
                            IMPORTE PARA CREDITO FISCAL <br>
                            SON: <?php echo num_to_letras($total); ?></th>
                        <th width="20%">
                        Bs<br>    
                        TOTAL A PAGAR Bs </th>
                        <th style="text-align: right;" width="15%">
                            <?php echo number_format(($total-$totalexento), 2, ".", ","); ?><br>
                            <?php echo number_format($total, 2, ".", ","); ?></th>
                        
                      </tr>

   
    </table>-->

    
    <!--<hr style="width: 80%;border: 2px solid black;margin-top: 1px;margin-bottom: 0px" align="right">-->

<!--    <table  class="table table-striped table-condensed" style="width: 100%; font-family: Arial; font-size:10px;">
    
    
    <tr>
        <td style="width: 20%;"></td>
        <td style="width: 80%; line-height: 12px;" colspan="3"> 
            
            CÓDIGO DE CONTROL: <?php echo $factura[0]['codcontrol_fact']; ?> <br>
            FECHA LÍMITE DE EMISIÓN: <?php echo date('d/m/Y',strtotime($factura[0]['fechaemision_fact']))?><br>
            TRANS.: <?php echo $factura[0]['id_fact']; ?> <br>
            CAJERO: <?php echo $factura[0]['nombre_usu'];  ?>
            <center style="font-size: 8px;">
                 <?php echo $factura[0]['factura_leyenda1'];  ?><br>
            </center>
            <center style="font-size: 10px;">
                 <?php echo $factura[0]['factura_leyenda2'];  ?><br>
            </center>
        </td>        
    </tr>   
</table>-->
    
</div>


            