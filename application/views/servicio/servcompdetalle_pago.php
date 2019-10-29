<style type="text/css">
    #alinear{ text-align: right; }
    /*#horizontal{ white-space: nowrap;}*/
</style>
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

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/firma_dos.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                

            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>NOTA DE ENTREGA</b></font> <br>
                <font size="3" face="arial"><b>SERVICIO Nº <?php echo $servicio['servicio_id']; ?></b></font> <br>
                <!--<font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0" ><br>
            _____________________________________________
                   
                <br> 
                   
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".date('d/m/Y', strtotime($servicio['servicio_fechafinalizacion'])).'|'.$servicio['servicio_horafinalizacion']; ?> <br>
                    <b>CODIGO: </b><?php echo $cliente['cliente_codigo']." / NIT: ".$cliente['cliente_nit']; ?> <br>
                    <b>SEÑOR(ES): </b><?php echo $cliente['cliente_razon'].""; ?>
                <br>_____________________________________________
        </td>
    </tr>
     
    
    
</table>




<?php /* ?>
<div class=" row micontenedor">
    <div id="cabizquierda">

        <?php

        echo $empresa[0]['empresa_nombre']."<br>";

        echo $empresa[0]['empresa_direccion']."<br>";

        echo $empresa[0]['empresa_telefono'];

        ?>

        </div>

        <div id="cabcentro">
            <div id="titulo">
                COMPROBANTE DE PAGO<br><br>SERVICIO N°: <?php echo $servicio['servicio_id']; ?><br><br>
                <!--CODIGO DETALLE DE SERVICIO: <?php //echo $detalle_serv['detalleserv_codigo']; ?><br>-->
                <span class="lahora"><?php echo date("d/m/Y - H:i:s"); ?></span>
            </div>

        </div>

        <div id="cabderecha">

            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

        </div>
        
    </div>
<div class="row" id="nombrecliente">
    <b>Cliente: </b>
    <span><?php if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0))
          {
             echo "NO DEFINIDO";
          } else{
              echo $cliente['cliente_nombre'];
          }
          ?>
    &nbsp;&nbsp;<b>Fecha Pago:</b>
    <?php
        echo date('d/m/Y', strtotime($servicio['servicio_fechafinalizacion'])); echo ' | '.$servicio['servicio_horafinalizacion'];
    ?>
    </span>
</div>
<?php */ ?>
<!--<table class="table table-condensed"  style="width: 18cm; margin: 0;" >-->
<table class="table table-condensed" style="width: 100%" id="mitabladetimpresion">
    <tr style="font-size: 12px; border-style: solid; border-width: medium; border-color: black; border-width: 2px; background-color: lightgray">
        <td align="center"><b>COD</b></td>
        <td align="center" colspan="2"><b>DESCRIPCIÓN</b></td>
        <td align="center" ><b>TOTAL</b></td>
        <td align="center" ><b></b></td>
        <td align="center" ><b>A CUENTA</b></td>               
        <td align="center" ><b></b></td>
        <td align="center" ><b>SALDO</b></td>               
        <td align="center" ><b></b></td>
    </tr>
   <?php $cont = 0;
         //$cantidad = 0;
         $total = 0;
         $acuenta = 0;
         $saldo = 0;

        //if ($factura[0]['estado_id']<>3){ 
         foreach($detalle_serv as $d){
                $cont = $cont+1;
                //$cantidad += $d['detallefact_cantidad'];
                $total += $d['detalleserv_total']; 
                $acuenta += $d['detalleserv_acuenta']; 
                $saldo += $d['detalleserv_saldo']; 
    ?>
    <tr style="font-size: 10px; border-top-style: solid;  border-color: black;  border-top-width: 1px;">
       <td align="center" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo $d['detalleserv_codigo']; ?></font></td>
        <td colspan="2" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo $d['detalleserv_descripcion']; ?></font></td>
        <td align="right" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detalleserv_total'],2,'.',','); ?></font></td>
        <td></td>
        <td align="right" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detalleserv_acuenta'],2,'.',','); ?></font></td>
        <td></td>
        <td align="right" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detalleserv_saldo'],2,'.',','); ?></font></td>
        <td></td>
    </tr>
    <?php } //} ?>
</table>
        
<div class="row" style="max-width: 100%;">
    <div class="box-body table-responsive" style="padding: 0px;">
        <table class="table table-striped table-condensed" id="mitablaimpresion" style="font-size: 12px">

            <tbody class="buscar1">

            <tr>
                <td style="padding-top: 1px; padding-bottom: 1px; text-align: right;">Total:</td>
                <td style="padding-top: 1px; padding-bottom: 1px;" id="alinear"><?php echo number_format($servicio['servicio_total'],'2','.',',') ?></td>
            </tr>
            <tr>
                <td style="padding-top: 1px; padding-bottom: 1px; text-align: right;">A cuenta:</td>
                <td style="padding-top: 1px; padding-bottom: 1px;" id="alinear"><?php echo number_format($servicio['servicio_acuenta'],'2','.',',') ?></td>
            </tr>
            <tr style="font-size: 15px;" class="text-bold">
                <td style="padding-top: 1px; padding-bottom: 1px; text-align: right;">Saldo:</td>
                <td style="padding-top: 1px; padding-bottom: 1px;" id="alinear"><?php echo number_format($servicio['servicio_saldo'],'2','.',',') ?></td>
            </tr>
        </table>

    </div>
</div>
<div class="row micontenedorfirmas">
    <div id="cabizquierdafirmas">
        <br>
        <br>
        ------------------------------------<br>
        Recibi Conforme
    </div>
    <div id="cabderechafirmas">
        <br>
        <br>
        ------------------------------------<br>
        Entregue Conforme
    </div>
</div>
<div class="row" style="max-width: 50%; font-size: 8pt">
    <div style="padding-left: 15px">
        Usuario: <?php echo $usuario['usuario_nombre']; ?>
    </div>
</div>
<div class="row">
    <div style="font-size: 10px; text-align: center; max-width: 100%;" id="leyenda">
        <!--<center>-->
        <?php echo $all_dosificacion['dosificacion_leyenda2']; ?>
        <br>
        "ESTO NO ES UNA FACTURA"
        <!--</center>-->
        <br>
        ¡¡¡NOTA IMPORTANTE!!!
        <br>
        <br>
        <?php echo $all_dosificacion['dosificacion_leyenda3']; ?>
        <br>
        <br>
        <?php echo $all_dosificacion['dosificacion_leyenda4']; ?>
        <br>
        
    </div>
</div>




