<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
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
        font-family: Arial narrow;
        font-size: 7pt;
        td{
            border:hidden;
        }
    }
    td#comentario {
        vertical-align : bottom;
        border-spacing : 0;
    }
    div#content {
        background : #ddd;
        font-size : 7px;
        margin : 0 0 0 0;
        padding : 0 5px 0 5px;
        border-left : 1px solid #aaa;
        border-right : 1px solid #aaa;
        border-bottom : 1px solid #aaa;
    }
</style>
<!-------------------------------------------------------->
<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>
<table class="table" >
    <tr>
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" ></td>
        <td style="padding: 0;">
            <table class="table" style="width: <?php echo $ancho; ?>;" >
                <tr>
                    <td style="padding:0;">        
                        <center>
                            <!--<img src="<?php echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                            <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                            <!--<font size="2" face="Arial"><b><?php /*echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                            <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                            <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];*/?><br>-->
                            <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                            <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                            <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>

                            <br>
                        <font size="3" face="arial"><b>ORDEN DE SERVICIO</b></font> <br>
                        <font size="1" face="arial"><b>Nº 00<?php echo $servicio['servicio_id']; ?></b></font> <br>
                        <br> 
                        <?php $fecha = new DateTime($servicio['servicio_fecharecepcion']); 
                                $fecha_d_m_a = $fecha->format('d/m/Y');
                          ?>    
                            <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                            <?php
                            $elcliente= "";
                            $elcodigo = "";
                            if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0))
                            {
                                $elcliente = "NO DEFINIDO";
                            } else{
                                $elcliente = $cliente['cliente_nombre'];
                                $elcodigo  = $cliente['cliente_codigo']." Nit:".$cliente['cliente_nit'];
                            }
                            ?>
                            <b>CODIGO: </b><?php echo $elcodigo; ?> <br>
                            <b>SEÑOR(ES): </b><?php echo $elcliente; ?>
                        <br>
                    </center>                      
                </td>
            </tr>

        </table>
        <table class="table table-striped table-condensed"  style="width: <?php echo $ancho; ?>;" >
            <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                <td align="center"><b>#</b></td>
                <td align="center"><b>DETALLE</b></td>
                <td align="center"><b></b></td>
                <td align="center"><b></b></td>               
            </tr>
            <?php
            $i = 1;
            $total = 0; $acuenta = 0;
            $saldo = 0; $cont = 0;
            foreach($detalle_serv as $d){
                $total = $total + $d['detalleserv_total'];
                $acuenta = $acuenta + $d['detalleserv_acuenta'];
                $saldo = $saldo + $d['detalleserv_saldo'];
                $cont = $cont+1; ?>
            <tr>
                <td align="center" style="padding: 0;"><?php echo $i ?></td>
                <td style="padding: 0; width: 70%"><?php
                    $tipotrabajo = "";
                    if($d['cattrab_descripcion']){
                        $tipotrabajo = " (".substr($d['cattrab_descripcion'], 0, 3).")";
                    }
                    $laglosa = "";
                    if($d['detalleserv_glosa']){
                        $laglosa = "; ".$d['detalleserv_glosa'];
                    }
                      echo $d['detalleserv_descripcion'].$laglosa.$tipotrabajo." (".$d['detalleserv_codigo'].")";
                      echo "<div><span style='font-weight: bold'>Fecha Aprox. Entrega:</span>".date("d/m/Y", strtotime($d['detalleserv_fechaentrega']));
                      echo " - ".$d['detalleserv_horaentrega']."</div>";
                      echo "<div><span class='text-bold'>Responsable Técnico: </span>".$d["respusuario_nombre"]."</div>"
                     ?>
                </td>
                <td align="right" style="padding: 0; width: 25%" colspan="2"><?php 
                    echo "Tot.: ".number_format($d['detalleserv_total'],'2','.',',')."<br>";
                    echo "A.C.: ".number_format($d['detalleserv_acuenta'],'2','.',',')."<br>";
                    echo "SAL.: ".number_format($d['detalleserv_saldo'],'2','.',',') ?>
                </td>

            </tr>
            <?php $i++; } ?>
<!--       </table>
<table class="table" style="max-width: 7cm;">-->
    <tr style="border-top-style: solid; border-top-width: 2px; border-top-style: solid; border-top-width: 2px;" colspan="4" align="right">
        
        <td colspan="4" style="padding: 0;"  >
            
            <font size="1">
                <b><?php echo "TOTAL FINAL Bs ".number_format($servicio['servicio_total'],2,'.',','); ?></b><br>
            </font>
            

            <font size="1">
                <?php echo "A CUENTA Bs ".number_format($servicio['servicio_acuenta'],2,'.',','); ?><br>
            </font>
            <font size="2">
            <b>
                <?php echo "SALDO Bs: ".number_format($servicio['servicio_saldo'],2,'.',','); ?><br>
            </b>
            </font>
            <!--<font size="1" face="arial narrow">
                <?php //echo "SON: ".num_to_letras($servicio['servicio_total'],' Bolivianos'); ?><br>            
            </font>-->
            <!--<font size="1">
                <?php /*echo "EFECTIVO Bs ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                <?php echo "CAMBIO Bs ".number_format($venta[0]['venta_cambio'],2,'.',',');*/ ?>            
            </font>-->
            
            <?php /*if($venta[0]['tipotrans_id']==2){ ?>
            <font size="1">
                <br>CUOTA INIC. Bs: <b><?php echo number_format($venta[0]['credito_cuotainicial'],2,'.',','); ?></b>
                <br>SALDO Bs: <b><?php echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>
            </font>
            <?php }*/ ?>
            
        </td>          
    </tr>
    <?php if($parametro[0]['parametro_segservicio'] == 1){ ?>
        <tr style="text-align: center !important">
            <td style="width: 100%" colspan="4">
                <div style="text-align: center !important;"><img style="vertical-align: top;" src="<?php echo $codigoqr; ?>" width="100px" height="100px"></div>
                <div style="font-size: 9px; text-align: center"><span class="text-bold">Usuario:</span> <?php echo $servicio['servicio_id']; ?> &nbsp; <span class="text-bold">Clave:</span> <?php echo $cliente['cliente_id']; ?></div>
            </td>
        </tr>
        <?php } ?>
    <tr>
        <td colspan="4" style="padding:0;">
               USUARIO: <b><?php echo $usuario['usuario_nombre']; ?></b><br>
               <span class="lahora"><?php echo date("d/m/Y - H:i:s"); ?></span>
               <!--COD.: <b><?php /*echo $venta[0]['venta_id']; ?></b><br>
               TRANS.: <b><?php echo $venta[0]['tipotrans_nombre'];*/ ?></b>-->
            <center>
            <font size="2">
                   
            </font>
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
            </center>
         </td>
    </tr>    
    
</table>
  
</td>
</tr>
</table>
