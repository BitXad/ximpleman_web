<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/reporte_ventapagrupado.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
//        $(document).ready(function () {
//            (function ($) {
//                $('#vender').keyup(function () {
//                    var rex = new RegExp($(this).val(), 'i');
//                    $('.buscar tr').hide();
//                    $('.buscar tr').filter(function () {
//                        return rex.test($(this).text());
//                    }).show();
//                })
//            }(jQuery));
//        });

</script>   

<style type="text/css">
/* @page { 
        size: landscape;
    }*/
     
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>">
<input type="hidden" name="resproducto" id="resproducto" />
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="decimales" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" />

<?php 

    $fuente = "Arial"; 
    $tamanio_letra = "12px"; //Texto en general
    $tamanio_letra2 = "11px"; //Reporte de transacciones
    $tamanio_letra3 = "9px"; //Reporte de transacciones

?>

<!--<div class="row" <?php echo ($tipousuario_id == 1)?"hidden":""; ?>>-->
<!--<div class="row" >
    
    <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' >
        <div class="col-md-3">
            Desde: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
        </div> 
        <div class="col-md-3">
            Hasta: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
        </div>
        <div class="col-md-2">
            Tipo Trans.:
            <select id="tipo_transaccion" name="tipo_transaccion" class="btn btn-primary btn-sm form-control"  >
                <option value="0">-TODOS-</option>
                <?php
                    foreach($all_tipo_transaccion as $tipo){ ?>
                        <option value="<?php echo $tipo['tipotrans_id']; ?>"><?php echo $tipo['tipotrans_nombre']; ?></option>                                                   
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            Usuario:
            <select id="usuario_id" name="usuario_id" class="btn btn-primary btn-sm form-control"  >
                <option value="0">-TODOS-</option>
                <?php
                    foreach($all_usuario as $usuario){ ?>
                        <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>                                                   
                <?php } ?>
             </select>
        </div>
        <div class="col-md-2">
            Venta/Preventa:
            <select id="esventa_preventa" name="esventa_preventa" class="btn btn-primary btn-sm form-control"  >
                
                <option value="1"> VENTA </option>
                <option value="2"> PREVENTA </option>
             </select>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a class="btn btn-facebook btn-sm form-control" onclick="tabla_reporteagrupado()" title="Buscar productos agrupados"><i class="fa fa-search"> </i> Buscar</a>
            </div>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="imprimir()" class="btn btn-success btn-sm form-control" ><i class="fa fa-print"> </i> Imprimir</a>
            </div>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="generarexcel_vagrupado()" class="btn btn-danger btn-sm form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</a>
            </div>
        </div>
    </div>

</div>-->




<div class="row no-print" id='loader'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
    </center>
</div>


<!------------------------------------------------------------------>
<!------------------------------------------------------------------>
<!------------------------------------------------------------------>
<?php $factura = [0=>0]; ?>
<?php $detalle_factura = [0=>0]; 
    $decimales = 2;
?>

<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
<!----------------------------- script buscador --------------------------------------->

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
    font-family: <?= $fuente  ?>;
    font-size: 10pt;
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
width : 10cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;
border-spacing : 0 0;
border-collapse : collapse;
font-family: <?= $fuente  ?>;
font-size: <?= $tamanio_letra3  ?>;; /*tamaño contenido de tabla*/
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
font-size : <?= $tamanio_letra3  ?>;
margin : 0 0 0 0;
padding : 0 0px 0 0px;
/*border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;*/
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<?php //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
?>

<div class="container no-print">  
    <div class="box-tools" style="font-family: <?= $fuente  ?>;" <?php echo ($tipousuario_id == 1)?"":"hidden"; ?>>
                <div class=" col-md-11">
                    <!-- panel panel-primary -->
                    <!--<div class="panel panel-primary col-md-8" id='buscador_oculto' > style='display:none; padding-top: 10px;'> -->
                    <div class="col-md-2">
                        Usuario:
                        <?php if($tipousuario_id == 1){ ?>
                        <select  class="btn btn-primary btn-sm form-control" id="buscarusuario_id" required>
                            <option value="0"> TODOS </option>
                            <?php foreach($all_usuario as $usuario){?>
                            <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                            <?php } ?>
                        </select>
                        <?php }else{ ?>
                        <select  class="btn btn-primary btn-sm form-control" id="buscarusuario_id" required>
                            <?php
                            $ischequed = "";
                            foreach($all_usuario as $usuario){
                                if($usuario_id == $usuario['usuario_id']){
                                    $ischequed = "selected";
                            ?>
                            <option <?php echo $ischequed; ?> value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                            <?php }    
                                } ?>
                        </select>
                        <?php } ?>
                    </div>
                        <div class="col-md-2">
                            Desde: <input type="date" value="<?php echo date('Y-m-d')?>" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
                        </div>
                        <div class="col-md-2">
                            Hasta: <input type="date" value="<?php echo date('Y-m-d')?>" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true">
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-sm btn-warning btn-sm btn-block"  type="submit" onclick="buscar_por_fecha()" style="height: 34px;" id="boton_buscar">
                                <span class="fa fa-search"></span> Buscar
                          </button>
                            <br>
                        </div>
<!--                        <div class="col-md-2">
                            <br>
                            <span class="badge btn-primary" style="height: 34px; padding-top: 5px;">Ing. Egr. encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="resingegr" type="text" value="0" readonly="true"> </span></span>
                        </div>-->
                        <div class="col-md-3">
                            <br>
                            <a id="imprimirestedetalle" class="btn btn-sq-lg btn-success" onclick="imprimirdetalle()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
                        </div>
                </div>

        </div>

    </div>




<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">
    
    
<table class="table" style="width: <?php echo $ancho?>" >
    <tr>
<!--        <td style="padding: 0; width: 0cm">-->
        <td style="padding: 0;" colspan="5">
                
            <center style="line-height: 10px">
                               
                    
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="2" face="<?= $fuente  ?>"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="<?= $fuente  ?>"><?php echo $empresa[0]['empresa_eslogan']; ?></font><br>

                    <!--<font size="1" face="<?= $fuente  ?>"><?php //echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="<?= $fuente  ?>"><small><?php echo $empresa[0]['empresa_direccion']; ?></small><br>
                    <font size="1" face="<?= $fuente  ?>"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="<?= $fuente  ?>"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br><br><font size="3" face="arial"><b>REPORTE DE CAJA</b></font>
            </center>        
                
                   
                <!-- style="border-top: dashed 1px #000; border-bottom: dashed 1px #000;" -->
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <!--<table style="width:<?php echo $ancho?>" >-->
                    <tr >
                        <td style="font-family: arial; font-size: 8pt; padding: 0; align:right; border-top: dashed 1px #000; border-bottom: dashed 1px #000;" colspan="1"></td>
                        <td style="font-family: <?= $fuente  ?>; font-size: 8pt; padding: 0; border-top: dashed 1px #000; border-bottom: dashed 1px #000; line-height: 12px;" colspan="4">
                            <br>
                            <b>PUNTO DE VENTA:</b> <?php echo $punto_venta["puntoventa_nombre"]; ?><br>
                            <b>CAJERO:</b> <?php echo $usuario["usuario_nombre"]; ?>
                            <br><b>FECHA INICIO:</b> 
                                <?php
                                if(isset($caja)){
                                    echo $caja["caja_fechaapertura"]." ".$caja["caja_horaapertura"];
                                }else{echo "SIN APERTURA DE CAJA"; }
                                  ?>
                            <br><b>FECHA FIN:</b> 
                                <?php
                                if(isset($caja)){
                                    
                                
                                    if($caja["caja_fechacierre"]!=null){                                    
                                        echo $caja["caja_fechacierre"]." ".$caja["caja_horacierre"];
                                    }else{
                                        echo "CAJA NO CERRADA";
                                    }
                                    
                                }else{
                                    echo date("d/m/Y H:m:s");
                                }
                                ?>
                            <br>
                            <br>
                        </td>
                    </tr>
                <!--</table>-->
            </center>
        </td>
    </tr>

    
<!--    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
        <td colspan="4" style="padding: 0;  font-size: 9pt;">
            
                <?php $fecha = new DateTime($factura[0]['factura_fechaventa']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a." ".$factura[0]['factura_hora']; ?> <br>
                    <b>NIT/CI: </b><?php echo $factura[0]['factura_nit']; ?> <br>
                    <b>SEÑOR(ES): </b><?php echo $factura[0]['factura_razonsocial'].""; ?>            
        </td>
    </tr>-->
     
<!--</table>border-top: dashed 1px #000;

       <table class="table table-striped table-condensed"  style="width: 7cm;" >-->
           <tr>
               
                <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000;"><b>CANT</b></td>
                <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000;"><b>DESCRIPCIÓN
                    <input type='button' value='[-]' onclick='mostrar_detalle();' id='boton_detalle' class='btn btn-xs btn-danger no-print' style="padding:0;"/>
                    </b></td>
                <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000;"><b>P.UNIT</b></td>
                <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000;"><b>TOTAL</b></td>
                
           </tr>
           <!--<tbody class="buscar" id="reportefechadeventa"></tbody>-->
             
           <input type="hidden" value="<?php echo sizeof($reporte); ?>" id="filas_detalle"/>
           <?php 
                    $total = 0;
                    $cantidades = 0;
                    $descuentos = 0;
                    $costos = 0;
                    $utilidades = 0;
                    $contador=1;
                    
                    foreach($reporte as $registros){
               
                        $total += $registros["total_venta"];
                        $cantidades += $registros["total_cantidad"];
                        $descuentos += $registros["total_descuento"];
                        $costos += $registros["total_costo"];
                        $utilidades += $registros["total_utilidad"]; 
                        
                        $partes = explode(".",$registros["total_cantidad"]);  
                            if ($partes[1] == 0) {  
                                $lacantidad = $partes[0];  
                            }else{  
                                $lacantidad = number_format($registros["total_cantidad"],$decimales,'.',',');  
                            }  
                            //echo $lacantidad; 
                        
                        ?>

                        <tr  style="display:none;"; id="ocultar_fila<?php echo $contador++; ?>">
                            
                                <td align='center' style="padding: 0;"><?php echo $lacantidad; ?></td>
                                <td style="padding: 0;"><?php echo $registros["producto_nombre"] ?> </td>
                                <td align='right' style="padding: 0; padding-right: 3px;"><?php  echo number_format($registros["total_punitario"],2,".",","); ?> </td>
                                <td align='right' style="padding: 0;"><b><?php echo number_format($registros["total_venta"],2,".",","); ?> </b></td>
                                <?php
                                if($tipousuario_id == 1){?>
                                    <td align='right' style="padding: 0;"> <?php number_format($registros["total_utilidad"],2,".",","); ?> </td>
                            
                        </tr>
                        <?php } ?>
                        
       
            <?php } ?> 
         
    <tr>
        
            
        <td align="right" style="padding: 0; font-family: <?= $fuente  ?>; font-size: 8pt; border-top: solid 1px #000; border-bottom: solid 1px #000;" colspan="4">
            
            <b>TOTAL TRANSACC. POR VENTAS Bs.: <?php echo number_format($total,2,".",","); ?></b>
            TOTAL DESCUENTOS POR VENTAS Bs.: <?php echo number_format($descuentos_globales[0]["descuentos"],2,".",","); ?>
<!--            <br><b>EFECTIVO INICIAL Bs: 
                <?php
                if(isset($caja)){
                    echo $caja["caja_apertura"];
                }else{
                    echo "0.00";
                }
                ?>
                </b>
            <br>INGRESOS Bs: <?php echo "0.00"; ?>
            <br>EGRESOS Bs:<?php echo "0.00"; ?>            -->
        </td>          
    </tr>
    <tr>
        <td colspan="4" style="font-size: 14px; padding:0px;"><center><b>RESUMEN</b></center></td>
    </tr>
    <tr>
        <td colspan="4" style="font-size: 12px; padding:0px;"><center><b>- INGRESOS -</b></center></td>
    </tr>
    <?php  
            //$tamanio_letra2 = "10px";
            $total_ingresos = 0;
            $total_egresos = 0;
            $total_ingresos_efectivo = 0;
            $total_egresos_efectivo = 0;
            $ban = 0;
            foreach($transacciones as $t){
                    $total_ingresos += $t["ingresos"];
                    $total_egresos += $t["egresos"];
                    
                    if($t["forma"]=="EFECTIVO"&&($t["transaccion"]=="CONTADO" ||$t["transaccion"]=="CREDITO")){
                        $total_ingresos_efectivo += $t["ingresos"];
                        $total_egresos_efectivo += $t["egresos"];
                    }
                    
                
                    
                    if($t["egresos"]>0&&$ban==0){ $ban = 1;
                ?>
                       <td colspan="4" style="font-size: 12px; padding:0px;"><center><b>- EGRESOS -</b></center></td>
                    <?php } ?>
                <tr>
                    <?php $detalle = "<b>".substr($t["operacion"],0,17)."." ."</b><br><small style='font-family:<?= $fuente  ?> Narrow; font-size:10px;'>".$t["transaccion"]." ".$t["forma"]; ?>
                <td colspan="2" style="padding: 3px; border-top: dashed 1px #000; line-height: 10px; font-size: <?= $tamanio_letra2 ?>"><?php echo ($t["egresos"]>0)?"(-){$detalle}":$detalle."</small>"; ?></td>
                
                <td style="padding: 3px; border-top: dashed 1px #000; text-align: right; font-size: <?= $tamanio_letra2 ?>"><?php echo ($t["ingresos"]>0)?number_format($t["ingresos"],$decimales,".",","):""; ?></td>
                
                <td style="padding: 3px; border-top: dashed 1px #000; text-align: right; font-size: <?= $tamanio_letra2 ?>"><?php echo ($t["egresos"]>0)?number_format($t["egresos"],$decimales,".",","):""; ?></td>
    
                </tr>
    
    <?php }
            //$tamanio_letra = "11px";
    ?> 
    
    <tr>
        <td colspan="2" style="font-size: <?= $tamanio_letra ?>; padding:0px; border-top: solid 2px #000;"><b>TOTAL INGRESOS Bs</b></td>
        <td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-top: solid 2px #000;"><b><?php echo number_format($total_ingresos,$decimales,".",","); ?></b></td>
        <td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-top: solid 2px #000;"></td>
    </tr>
    
    <tr>
        <!--<td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-bottom: solid 1px #000;"></td>-->
        <td colspan="2" style="font-size: <?= $tamanio_letra ?>; padding:0px; border-bottom: solid 1px #000;"><b>TOTAL EGRESOS Bs</b></td>
        <td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-bottom: solid 1px #000;"></td>
        <td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-bottom: solid 1px #000;"><b><?php echo number_format($total_egresos,$decimales,".",","); ?></b></td>
    </tr>
    
    <tr>
        <td colspan="2" style="font-size: <?= $tamanio_letra ?>; padding:0px; border-top: solid 1px #000;"><b>INGRESOS EFECTIVO Bs</b></td>
        <td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-top: solid 1px #000;"><b><?php echo number_format($total_ingresos_efectivo,$decimales,".",","); ?></b></td>
        <td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-top: solid 1px #000;"></td>
    </tr>
    
    <tr>
        <!--<td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-bottom: solid 2px #000;"></td>-->
        <td colspan="3" style="font-size: <?= $tamanio_letra ?>; padding:0px; border-bottom: solid 2px #000;"><b>EGRESOS EFECTIVO Bs</b></td>
<!--        <td style="font-size: 12px; padding:0px; border-bottom: solid 1px #000;"></td>-->
        <td style="font-size: <?= $tamanio_letra ?>; padding:0px; border-bottom: solid 2px #000;"><b><?php echo number_format($total_egresos_efectivo,$decimales,".",","); ?></b></td>
    </tr>
    

    
    <tr>
        
        <td nowrap style="padding: 0; font-family: <?= $fuente  ?>; font-size: 12px; border-top: solid 2px #000; border-bottom: solid 2px #000; text-align: right;" colspan="4">
            <?php
            $apertura_decaja = 0;
            if(isset($caja)){
                $apertura_decaja = $caja["caja_apertura"];
            }
            
            
            $efectivo_caja = $total_ingresos_efectivo - $total_egresos_efectivo; ?> 
            <b>EFECTIVO EN CAJA Bs: <?php echo number_format($efectivo_caja,2,".",","); ?> </b>
            
        </td>
    </tr>
    
    
    <!-- comment -->
        <?php if(isset($caja)){ ?>
    
        <?php $array = array('200', '100', '50','20','10','5','2','1','0.50','0.20','0.10','0.05'); 
          $cantidad = count($array);
          $totaldinero = 0; ?>

        <tr>
            <td></td>
            <td colspan="2" style="text-align: right;">
        <?php
            for ($i = 0; $i<$cantidad; $i++){
                $money = $array[$i];
                $totaldinero += $caja["caja_corte".str_replace ( ".", '', $money)] * $money;  
        ?>

<!--            <td align="left" style="padding: 0;" colspan="2"><?php echo $money." ".substr($moneda['moneda_descripcion'],0,3)." X ".$caja["caja_corte".str_replace ( ".", '', $money)]; ?></td>
            <td align="right" style="padding: 0;"><?php echo number_format($caja["caja_corte".str_replace ( ".", '', $money)] * $money,2,'.',','); ?></td>
            <td align="right" style="padding: 0;"> </td>-->
            
                <?php
                
                    if ($caja["caja_corte".str_replace ( ".", '', $money)]>0){ 
                       echo $money." ".substr($moneda['moneda_descripcion'],0,3)." X ".$caja["caja_corte".str_replace ( ".", '', $money)]; ?> =  <?php echo number_format($caja["caja_corte".str_replace ( ".", '', $money)] * $money,2,'.',',')."<br>"; 
                    
                } ?>

    <?php } ?>
            </td>
            <td></td>

        </tr>


        <tr>
            <!--<td align="center" style="padding: 0; border-top: solid 2px #000;" colspan="2"><b>TOTAL</b></td>-->
            <!--<td style="padding: 0;"><font style="size:5px; font-family: arial narrow;"><?php echo $moneda['moneda_descripcion']." ".$money; ?></td>-->
            <td colspan="4" align="right" style="padding: 0; font-family: <?= $fuente  ?>; font-size: 12px; border-top: solid 2px #000; border-bottom: solid 2px #000; "><b><?php echo "EFECTIVO REGISTRADO Bs: ".number_format($totaldinero,2,'.',','); ?></b></td>
            <!--<td align="right" style="padding: 0; border-top: solid 2px #000;"> </td>-->
        </tr>

<!--        <tr style="border-top-style: solid; border-top-width: 2px; border-top-style: solid; border-top-width: 2px;" align="right">

        <td colspan="5" style="padding: 0;"  >


        </td>          
        </tr>-->

        <?php } ?>
    <!-- comment -->
    
     <tr>
        <td style="padding: 0; border-top: solid 2px #000; border-bottom: solid 2px #000; font-size: <?= $tamanio_letra2 ?>" colspan="4">
        
        <center style="font-size: 12px; font-weight: bold;">- REPORTE DE TRANSACCIONES -</center>
        
        RANGO NUMERACION VENTAS: <?php echo $resumen[0]["desde"]." - ".$resumen[0]["hasta"]; ?>
        <br>CANTIDAD TOTAL VENTAS: <?php echo $total_ventas[0]["total_ventas"]; ?>
        <br>VENTAS VALIDAS: <?php echo $validas[0]["ventas_validas"]; ?>
        <br>VENTAS MAL EMITIDAS: <?php echo $mal_emitidas[0]["mal_emitidas"]; ?>
        <br>VENTAS ANULADAS: <?php echo $anuladas[0]["anuladas"]; ?>
            
        </td>
       

    </tr>    
    
    <tr>
        <td colspan="4" style="padding: 0; font-family: <?= $fuente  ?>; font-size: 14px; border-top: solid 2px #000; border-bottom: solid 2px #000; text-align: right;">
            
            
            
            
            <?php
            $caja_diferencia = 0;
            if(isset($caja)){
                $caja_diferencia = $caja["caja_diferencia"];?>
            
                <!--<br><b>EFECTIVO REGISTRADO Bs: <?php echo number_format($caja["caja_cierre"],2,".",","); ?> </b>-->
                
                
            <?php
            }
            ?>
           <b>DIFERENCIA Bs: <?php echo number_format($caja_diferencia,2,".",","); ?> </b>
        </td>           
    </tr>
    
    
    
    

    <tr   style="border-top-style: dashed 1px #000; border-top-width: 2px; border-bottom-style: dashed 1px #000; border-bottom-width: 2px; font-size: 10pt; padding: 0;">
        <td colspan="5" style="padding: 0; text-align: center; line-height: 12px;">
            <small>Declaro veracidad de la información de este documento.</small>
            <br><br><br><br><br>
            <?php if(isset($caja)){ echo $caja["usuario_nombre"];} ?><br>CAJERO(A)
        </td>

<!--        <td style="padding: 0;  line-height: 12px;" colspan="4">
               USUARIO: <b></b> / TRANS: 

         </td>-->
    </tr>    
    
</table>

</td>    
</tr>    
</table>



<div class="col-md-12 no-print">
    <center>
        <button type="button" class="btn btn-facebook btn-sm" data-toggle="modal" onclick="$(document).ready(function(){window.onload = window.print();});"><i class="fa fa-print"> </i> Imprimir</button>        
        <a href="<?php echo base_url("admin/dashb"); ?>" class="btn btn-info btn-sm" data-toggle="modal" ><i class="fa fa-calculator"> </i> Cerra caja</a>        
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="window.close();"><i class="fa fa-times"> </i> Cerrar</button>        
    </center>
</div>    
    