<script src="<?php echo base_url('resources/js/servicio_repdia.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!----------------------------- script buscador ---------------------------------------> 
<!--
<script type="text/javascript">
    function imprimirdetalle(){
        var estafh = new Date();
        $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
        window.print();
    }
</script>-->
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">
<!--<link href="<?php //echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<!-------------------------------------------------------->
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
                <u>ORDENES DE SERVICIO</u><br><br>
                <span style="font-size: 9pt">INGRESOS DIARIOS</span><br>
                <span class="lahora" id="fhimpresion"></span><br>
                <span style="font-size: 8pt;">PRECIOS EXPRESADOS EN MONEDA BOLIVIANA (Bs.)</span>
            </div>
        </div>
        <div id="cabderecha">
            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

        </div>
        
</div>
<!--
<div class="row col-md-12 no-print">
    <div class="col-md-2">
        Desde: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php //echo date('Y-m-d')?>" id="fecha_desde" name="fecha_desde" required="true">
    </div>
    <div class="col-md-2">
        Hasta: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php //echo date('Y-m-d')?>" id="fecha_hasta" name="fecha_hasta" required="true">
    </div>

    <div class="col-md-2">
        Estado:             
        <select  class="btn btn-primary btn-sm form-control" id="busestado_id" required>
            <option value="0">TODOS</option>
            <?php /* foreach($all_estado as $estado){?>
            <option value="<?php echo $estado['estado_id']; ?>"><?php echo $estado['estado_descripcion']; ?></option>
            <?php } */ ?>
        </select>
    </div> 
    <div class="col-md-2" hidden>
        Usuario:             
        <select  class="btn btn-primary btn-sm form-control" id="bususuario_id" required>
            <option value="0">TODOS</option>
            <?php /* foreach($all_usuario as $usuario){?>
            <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
        Tecnico Responsable:             
        <select  class="btn btn-primary btn-sm form-control" id="busresponsable_id" required>
            <option value="0">TODOS</option>
            <?php foreach($all_responsable as $responsable){?>
            <option value="<?php echo $responsable['responsable_id']; ?>"><?php echo $responsable['responsable_nombres']." ".$responsable['responsable_apellidos']; ?></option>
            <?php } */ ?>
        </select>
    </div>
    <div class="col-md-2">
        Cliente:     
        <input type="text" name="buscar_cliente" id="buscar_cliente" class="btn btn-primary btn-sm form-control" style="background-color: white; color: black; text-align: left; cursor: auto;" placeholder="Ingrese Cliente, codigo, ci.." />
    </div>
</div> -->
<!--
<div class="row col-md-12 no-print">
    <div class="col-md-2">
        <br>
        <a class="btn btn-sq-lg btn-primary btn-block" onclick="reportedetservicio();" ><span class="fa fa-search"></span>&nbsp;buscar</a>
    </div>
    <div class="col-md-2">
        <br>
        <a id="imprimirestedetalle" class="btn btn-sq-lg btn-success btn-block" target="_blank" onclick="imprimirdetalle()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
    </div>
</div> -->
<!--<div class="parametrosbusqueda" id="detalledebusqueda">-->
<div class="parametrosbusqueda">
    <span class="negrita">TECNICO: </span>-<br>
    <?php echo "<span class='negrita'>DESDE: </span>".date('d/m/Y')."<span class='negrita'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HASTA: </span>".date('d/m/Y'); ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a style="width: 10%;" id="imprimirestedetalle" class="btn btn-xs btn-success no-print" target="_blank" onclick="imprimirdetalle()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
    
</div>
<div class="row col-md-12" >
       
        
        
        <!--<div class="box">-->
            
            <!--<div class="box-body table-responsive">-->
                <table class="table table-striped table-condensed" id="mitablaimpresion">
                    <tr>
						<th>#</th>
                                                <th>Cliente</th>
                                                <th>Serv.</th>
                                                <th>Recepción</th>
                                                <th>Terminado</th>
                                                <th>Entrega</th>
						<th>Costo</th>
						<th>Ins.</th>
						<th>A C.</th>
						<th>Saldo</th>
						<th>Util.</th>
						<th>Estado</th>
						<th>Tipo</th>
						<th>Detalle</th>
						<th>Resp.</th>
                    </tr>
                    <tbody id="tablaresultados">
                    <?php /* $i =1; $cont = 0;
                          $total = 0;
                          $acuenta = 0;
                          $saldo = 0;
                          foreach($servicio as $s){
                              $cont = $cont+1;
                              $total += $s['detalleserv_total'];
                              $acuenta += $s['detalleserv_acuenta'];
                              $saldo += $s['detalleserv_saldo'];
                    ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $s['cliente_nombre']; ?></td>
                        <td><?php echo $s['servicio_id']; ?></td>
                        <td class='alinearcentro'><?php
                            echo date('d/m/Y', strtotime($s['servicio_fecharecepcion']));
                            echo " ".$s['servicio_horarecepcion'];
                            ?>
                        </td>
                        <td class='alinearcentro'><?php
                            if($s['detalleserv_fechaterminado'] <> null){
                                echo date('d/m/Y', strtotime($s['detalleserv_fechaterminado']));
                                echo " ".$s['detalleserv_horaterminado'];
                            }
                            ?>
                        </td>
                         <td class='alinearcentro'><?php
                            if($s['detalleserv_fechaentregado'] <> null){
                                echo date('d/m/Y', strtotime($s['detalleserv_fechaentregado']));
                                echo " ".$s['detalleserv_horaentregado'];
                            }
                            ?>
                        </td>
                        <td class='alinearder'><?php echo number_format($s['servicio_total'],2); ?></td>
                        <td class='alinearder'><?php echo number_format($s['servicio_acuenta'],2); ?></td>
                        <td class='alinearder'><?php echo number_format($s['servicio_saldo'],2); ?></td>
                        <td class='alinearder'><?php //echo number_format($s['servicio_saldo'],2); ?></td>
                        <td class='alinearcentro' style="background-color: #<?php echo $s['estado_color']; ?>"><?php echo $s['estado_descripcion']; ?></td>
                        <td class='alinearcentro'><?php echo $s['tiposerv_descripcion']; ?></td>
                        <td><?php echo $s['detalleserv_descripcion']; ?></td>
                        <td><?php echo $s['responsable_nombres']." ".$s['responsable_apellidos']; ?></td>
                        
                    </tr>
                    <?php $i++; } */ ?>
                    </tbody>
                 <!--   <tr>
                        <td class='alinearder negrita tamanio10pt' colspan="6">Total</td>
                        <td class='alinearder negrita tamanio10pt'><span id="eltotal"><?php //echo number_format($total,2); ?></span></td>
                        <td class='alinearder negrita tamanio10pt'><span id="elacuenta"><?php //echo number_format($acuenta,2); ?></span></td>
                        <td class='alinearder negrita tamanio10pt'><span id="elsaldo"><?php //echo number_format($saldo,2); ?></span></td>
                    </tr>-->
                </table>
                                
            <!--</div>-->
        <!--</div>-->
        <br><br>
        <div class=" micontenedorfirmas">
            <div class="cabsoloizqderechafirmas"></div>
            <div class="cabsoloderechafirmas">
                <div>__________________________</div>
                <div>Responsable</div>
                <div>Firma - Sello</div>
            </div>
        </div>
    </div>
<div class="no-print">
    <a onclick="javascript:window.close();" class="btn btn-danger">
    <i class="fa fa-times"></i>Salir
</a>
</div>