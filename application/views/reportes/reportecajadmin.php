<script src="<?php echo base_url('resources/js/reporte_resumenventa.js'); ?>" type="text/javascript"></script>

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

<div class="row" <?php echo ($tipousuario_id == 1)?"":""; ?>>
<!--<div class="row" > -->
    
    <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' >
        <div class="col-md-3">
            Fecha del Reporte: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_reporte" name="fecha_reporte" >
        </div> 
        <!--<div class="col-md-3">
            Hasta: <input type="date" value="<?php //echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
        </div>-->
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
        <div class="col-md-2 no-print">&nbsp;
           <div class="form-group">
                <a class="btn btn-facebook btn-sm form-control" onclick="resumen_ventascaja()" title="Buscar productos agrupados"><i class="fa fa-search"> </i> Buscar</a>
            </div>
        </div>
        <div class="col-md-2 no-print hidden">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="generarexcel_vagrupado()" class="btn btn-danger btn-sm form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</a>
            </div>
        </div>
    </div>

</div>




<div class="row no-print" id='loader'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
    </center>
</div>


<!------------------------------------------------------------------>
<!------------------------------------------------------------------>
<!------------------------------------------------------------------>
<?php $factura = [0=>0]; ?>
<?php $detalle_factura = [0=>0]; ?>

<script type="text/javascript">
    $(document).ready(function()
    {
        //window.onload = window.print();
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
    font-family: Arial;
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
font-family: Arial narrow;
font-size: 9pt; /*tamaño contenido de tabla*/
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<?php //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
?>

<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">
    
    
<table class="table" style="width: <?php echo $ancho?>" >
    <tr>
        <td style="padding: 0;" colspan="5">
                
            <center>
                               
                    
                    <!--<img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                    

                    <!--<font size="1" face="Arial"><?php //echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>
                    <?php //if($factura[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         //else {  $titulo1 = "NOTA DE VENTA"; $subtitulo = " "; }?>
                    <?php $titulo1 = "REPORTE DE CAJA";  
                            

                    ?>
                    
                <font size="3" face="arial"><b><?php echo $titulo1; ?></b></font>
                    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                        <td style="font-family: arial; font-size: 9pt; padding: 0; align:right;" colspan="1">                     
                        </td>
                        <td style="font-family: Arial; font-size: 9pt; padding: 0;" colspan="4">
                            PUNTO DE VENTA: <?php echo $punto_venta["puntoventa_nombre"]; ?>
                            <br>FECHA INICIO: 
                            <span id="lafechainicio">
                                <?php
                                if(isset($caja)){
                                    echo $caja["caja_fechaapertura"]." ".$caja["caja_horaapertura"];
                                }
                                  ?>
                            </span>
                            <br>FECHA FIN: 
                            <span id="lafechafin">
                                <?php
                                if(isset($caja)){
                                    echo $caja["caja_fechacierre"]." ".$caja["caja_horacierre"];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
            </center>
        </td>
    </tr>

           <tr  style="border-top-style: solid; border-bottom-style: solid; " >
               
                <td align="center" style="padding: 0;"><b>CANT</b></td>
                <td align="center" style="padding: 0;"><b>DESCRIPCIÓN</b></td>
                <td align="center" style="padding: 0;"><b>P.UNIT</b></td>
                <td align="center" style="padding: 0;"><b>TOTAL</b></td>
                
           </tr>
           <tbody class="buscar" id="reporte_resumenventa"></tbody>
           
           <?php 
                    /*$total = 0;
                    $cantidades = 0;
                    $descuentos = 0;
                    $costos = 0;
                    $utilidades = 0;
                    
                    foreach($reporte as $registros){
               
                        $total += $registros["total_venta"];
                        $cantidades += $registros["total_cantidad"];
                        $descuentos += $registros["total_descuento"];
                        $costos += $registros["total_costo"];
                        $utilidades += $registros["total_utilidad"]; ?>

                        <td align='center'><?php echo $registros["total_cantidad"] ?></td>
                        <td><?php echo $registros["producto_nombre"] ?> </td>
                        <td align='right'><?php  echo number_format($registros["total_punitario"],2,".",","); ?> </td>
                        <td align='right'><b><?php echo number_format($registros["total_venta"],2,".",","); ?> </b></td>
                        <?php
                        if($tipousuario_id == 1){?>
                            <td align='right'> <?php number_format($registros["total_utilidad"],2,".",","); ?> </td>
                        <?php } ?>
                        
                        </tr>
            <?php }*/ ?>
           
    <tr style="border-top-style: solid; border-top-width: 2px;">
        
            
        <td align="right" style="padding: 0; font-family: Arial; font-size: 10pt;" colspan="4">
            
            <b>VENTAS AL CONTADO Bs.: <span id="eltotal"></span> <?php //echo number_format($total,2,".",","); ?></b>
            <br><b>EFECTIVO INICIAL Bs: <span id="lacaja"></span>
                <?php
                /*if(isset($caja)){
                    echo $caja["caja_apertura"];
                }else{
                    echo "0.00";
                }*/
                ?>
                </b>
            <br>INGRESOS Bs: <?php echo "0.00"; ?>
            <br>EGRESOS Bs:<?php echo "0.00"; ?>            
        </td>          
    </tr>
    <tr style="border-top-style: solid; border-top-width: 2px;">
        <td nowrap style="padding: 0; font-family: Arial; font-size: 10pt;" colspan="4">
            <?php
            /*$apertura_decaja = 0;
            if(isset($caja)){
                $apertura_decaja = $caja["caja_apertura"];
            }
            $efectivo_caja = $total + $apertura_decaja;*/ ?> 
            <b>EFECTIVO EN CAJA Bs: <span id="elefectivoencaja"></span><?php //echo number_format($efectivo_caja,2,".",","); ?> </b>
            <?php
            /*$caja_diferencia = 0;
            if(isset($caja)){
                $caja_diferencia = $caja["caja_diferencia"];
            }*/
            ?>
            <br><b>DIFERENCIA Bs: <span id="ladiferencia"></span>  <?php //echo number_format($caja_diferencia,2,".",","); ?> </b>
        </td>           
    </tr>
     <tr style="border-top-style: solid; border-top-width: 2px;">
        <td style="padding: 0;" colspan="4">
            RANGO NUMERACION VENTAS: <span id="elrango"></span> <?php //echo $resumen[0]["desde"]." - ".$resumen[0]["hasta"]; ?>
            <br>CANTIDAD TOTAL VENTAS: <span id="lacantidad"></span> <?php //echo $total_ventas[0]["total_ventas"]; ?>
            <br>VENTAS VALIDAS: <span id="lasventasvalidas"></span> <?php //echo $validas[0]["ventas_validas"]; ?>
            <br>VENTAS MAL EMITIDAS: <span id="lasventasmalemitidas"></span> <?php //echo $mal_emitidas[0]["mal_emitidas"]; ?>
            <br>VENTAS ANULADAS: <span id="lasventasanuladas"></span> <?php //echo $anuladas[0]["anuladas"]; ?>
        </td>
    </tr>    

    <tr   style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 10pt; padding: 0;">
        <td colspan="5" style="padding: 0; text-align: center;">
            <small>Declaro veracidad de la información de este documento.</small>
            <br><br><br><br><br>
            <b><span id="lacajera"></span> <?php //if(isset($caja)){ echo $caja["usuario_nombre"];} ?><br>CAJERO(A)</b>
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
        <!--<a href="<?php //echo base_url("admin/dashb"); ?>" class="btn btn-info btn-sm" data-toggle="modal" ><i class="fa fa-calculator"> </i> Cerra caja</a>-->        
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="window.close();"><i class="fa fa-times"> </i> Cerrar</button>        
    </center>
</div>    
    