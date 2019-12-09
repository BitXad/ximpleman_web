<script src="<?php echo base_url('resources/js/servicio_repfechas.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
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
<script type="text/javascript">
    function imprimirdetalle(){
        //var estafh = new Date();
        //$('#fhimpresion').html(formatofecha_hora_ampm(estafh));
        window.print();
    }
</script>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/mitablaservicioimpresion-mcarta.css'); ?>" rel="stylesheet">
<link href="<?php //echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php /*echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];*/ ?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php //echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>ORDEN DE SERVICIO</b></font><br>
                <span id="esteestado">TODOS</span><br>
                <!--<font size="3" face="arial"><b>Nº 00<?php //echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0" >
<!--                ______________________________                
                   
                                
                <div id="datos_recorrido">
                    
                </div>
                
                ______________________________-->
        </td>
    </tr>
     
    
    
</table>
<?php /* ?>
 <div class=" row micontenedorep">
    <div id="cabizquierda">
        <?php
        echo $empresa[0]['empresa_nombre']."<br>";
        echo $empresa[0]['empresa_direccion']."<br>";
        echo $empresa[0]['empresa_telefono'];
        ?>
        </div>
        <div id="cabcentro">
            <div id="titulo">
                <u>ORDEN DE SERVICIO</u><br><br>
                <span id="esteestado">TODOS</span><br>
                <span class="lahora" id="fhimpresion"></span>
            </div>
        </div>
        <div id="cabderecha">
            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

        </div>
        
</div><?php */ ?>
<div class="row col-md-12 no-print">
    <div class="col-md-2">
        Desde: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_desde" name="fecha_desde" required="true">
    </div>
    <div class="col-md-2">
        Hasta: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_hasta" name="fecha_hasta" required="true">
    </div>

    <div class="col-md-2">
        Estado:             
        <select  class="btn btn-primary btn-sm form-control" id="busestado_id" required>
            <option value="0">TODOS</option>
            <?php foreach($all_estado as $estado){ ?>
            <option value="<?php echo $estado['estado_id']; ?>"><?php echo $estado['estado_descripcion']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2" hidden>
        Usuario:             
        <select  class="btn btn-primary btn-sm form-control" id="bususuario_id" required>
            <option value="0">TODOS</option>
            <?php foreach($all_usuario as $usuario){?>
            <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
        Tecnico Responsable:             
        <select  class="btn btn-primary btn-sm form-control" id="busresponsable_id" required>
            <option value="0">TODOS</option>
            <?php foreach($all_responsable as $usuario){?>
            <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
        Cliente:     
        <input type="text" name="buscar_cliente" id="buscar_cliente" class="btn btn-primary btn-sm form-control" style="background-color: white; color: black; text-align: left; cursor: auto;" placeholder="Ingrese Cliente, codigo, ci.." />
    </div>
</div>
<div class="row col-md-12 no-print">
    <div class="col-md-2">
        <br>
        <a class="btn btn-sq-lg btn-warning btn-block" onclick="reportedetservicio();" ><span class="fa fa-search"></span>&nbsp;Buscar</a>
    </div>
    <div class="col-md-2">
        <br>
        <a id="imprimirestedetalle" class="btn btn-sq-lg btn-success btn-block" target="_blank" onclick="imprimirdetalle()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
    </div>
</div>
<span style="font-family: Arial Narrow; font-size: 8pt !important" id="detalledebusqueda">
    <span class="text-bold">T&Eacute;CNICO: </span>TODOS<br>
    <?php echo "<span class='text-bold'>DESDE: </span><span id='esdesde'>".date('d/m/Y')."</span><span class='text-bold'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HASTA: </span><span id='eshasta'>".date('d/m/Y')."</span>"; ?>
</span>
<style type="text/css">
    #mitabla {
        font-family: Arial Narrow;
        font-size: 9px;
    }
    #mitabla td{
        padding-top: 1px;
        padding-bottom: 1px;
    }
    .maspeque{
        font-size: 8px !important;
        padding-left: 1px !important;
        padding-right: 1px !important;
    }
    .conmenospacio{
        padding-left: 1px !important;
        padding-right: 1px !important;
    }
</style>
 <div class="row col-md-12">
       
        
        <div class="table-responsive">
        <!--<div class="box">-->
            
            <!--<div class="box-body table-responsive">-->
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th style="width: 4.5cm">CLIENTE</th>
                        <th>ORDEN</th>
                        <th>FECHA/HORA<br>RECEPCIÓN</th>
                        <th>FECHA/HORA<br>TERMINADO</th>
                        <th>FECHA/HORA<br>ENTREGA</th>
                        <th>COSTO</th>
                        <th>INS.</th>
                        <th>A<br>CTA.</th>
                        <th>SALDO</th>
                        <th>UTILID.</th>
                        <th>ESTADO</th>
                        <th>TIPO<br>SERVICIO</th>
                        <th style="width: 4.5cm">DETALLE</th>
                        <th>TEC.<br>RESP.</th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php /*$i =1; $cont = 0;
                          $total = 0;
                          $insumo = 0;
                          $acuenta = 0;
                          $saldo = 0;
                          $utilidad = 0;
                          foreach($servicio as $s){
                              $cont = $cont+1;
                              $precioexterno = 0;
                              if($s['detalleserv_precioexterno'] != null){
                                  if($s['detalleserv_precioexterno'] >0){
                                      $precioexterno = $s['detalleserv_precioexterno'];
                                  }
                              }
                              
                              $total += $s['detalleserv_total'];
                              $insumo += $s['total_insumo']+$precioexterno;
                              $acuenta += $s['detalleserv_acuenta'];
                              $saldo += $s['detalleserv_saldo'];
                              $utilidad += $s['detalleserv_total']- ($s['total_insumo']+$precioexterno);
                    ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $s['cliente_nombre']; ?></td>
                        <td class="text-center"><?php echo $s['servicio_id']; ?></td>
                        <td class='text-center maspeque'><?php
                            echo date('d/m/Y', strtotime($s['servicio_fecharecepcion']));
                            echo " ".$s['servicio_horarecepcion'];
                            ?>
                        </td>
                        <td class='text-center maspeque'><?php
                            if($s['detalleserv_fechaterminado'] <> null){
                                echo date('d/m/Y', strtotime($s['detalleserv_fechaterminado']));
                                echo " ".$s['detalleserv_horaterminado'];
                            }
                            ?>
                        </td>
                         <td class='text-center maspeque'><?php
                            if($s['detalleserv_fechaentregado'] <> null){
                                echo date('d/m/Y', strtotime($s['detalleserv_fechaentregado']));
                                echo " ".$s['detalleserv_horaentregado'];
                            }
                            ?>
                        </td>
                        <td class='text-right'><?php echo number_format($s['detalleserv_total'],2); ?></td>
                        <td class='text-right'><?php echo number_format($s['total_insumo']+$precioexterno,2); ?></td>
                        <td class='text-right'><?php echo number_format($s['detalleserv_acuenta'],2); ?></td>
                        <td class='text-right'><?php echo number_format($s['detalleserv_saldo'],2); ?></td>
                        <td class='text-right'><?php echo number_format(($s['detalleserv_total']-($s['total_insumo']+$precioexterno)),2); ?></td>
                        <td class='text-center' style="background-color: #<?php echo $s['estado_color']; ?>"><?php echo $s['estado_descripcion']; ?></td>
                        <td class='text-center'><?php echo $s['tiposerv_descripcion']; ?></td>
                        <td class="conmenospacio"><?php echo $s['detalleserv_descripcion']; ?></td>
                        <td class="maspeque"><?php echo $s['respusuario_nombre']; ?></td>
                        
                    </tr>
                    <?php $i++; } */ ?>
                    </tbody>
                    <tr>
                        <td class='text-right text-bold' style="font-size: 10pt;" colspan="6">Total</td>
                        <td class='text-right text-bold' style="font-size: 10pt;"><span id="eltotal"><?php //echo number_format($total,2); ?></span></td>
                        <td class='text-right text-bold' style="font-size: 10pt;"><span id="elinsumo"><?php //echo number_format($insumo,2); ?></span></td>
                        <td class='text-right text-bold' style="font-size: 10pt;"><span id="elacuenta"><?php //echo number_format($acuenta,2); ?></span></td>
                        <td class='text-right text-bold' style="font-size: 10pt;"><span id="elsaldo"><?php //echo number_format($saldo,2); ?></span></td>
                        <td class='text-right text-bold' style="font-size: 10pt;"><span id="lautilidad"><?php //echo number_format($utilidad,2); ?></span></td>
                    </tr>
                </table>
                                
            <!--</div>-->
        <!--</div>-->
        <br><br>
        <!--<div class=" micontenedorfirmas">
            <div class="cabsoloizqderechafirmas"></div>
            <div class="cabsoloderechafirmas">
                --------------------------<br>
                Responsable<br>
                Firma - Sello
            </div>
        </div>-->
        </div>
        <div class="col-md-12 text-center" style="font-family: Arial">
            <div style="line-height: 10px">__________________________</div>
            <div>Responsable</div>
            <div style="line-height: 10px">Firma - Sello</div>
        </div>
    </div>
<div class="no-print">
<a href="<?php echo site_url('reportes/servicioreportes'); ?>" class="btn btn-danger">
    <i class="fa fa-times"></i> Cerrar
</a>
</div>