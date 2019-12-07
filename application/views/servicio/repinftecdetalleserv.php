<script src="<?php echo base_url('resources/js/servicio_repinfdetalleserv.js'); ?>" type="text/javascript"></script>
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

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabladetalleimpresion.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header no-print">
    <h3 class="box-title"><b>Informe Técnico de Detalles de Servicios</b></h3><br>
</div>
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
            <?php foreach($all_estado as $estado){?>
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
        <a class="btn btn-sq-lg btn-warning btn-block" onclick="reportedetservicio();" ><span class="fa fa-search"></span>&nbsp;buscar</a>
    </div>

</div>

 <div class="row col-md-12">
       
        
        
        <!--<div class="box">-->
            
            <!--<div class="box-body table-responsive">-->
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
                                                <th>Cliente</th>
                                                <th>Num.<br>Serv.</th>
                                                <th>Fecha/Hora<br>Recepción</th>
						<th>Costo</th>
						<th>A Cta.</th>
						<th>Saldo</th>
						<th>Estado</th>
						<th>Tipo<br>Servicio</th>
						
						<th>Detalle</th>
						
						<th>Tec.<br>Resp.</th>
                                                <th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php $i =1; $cont = 0;
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
                        
                        <td class='alinearder'><?php echo number_format($s['servicio_total'],2); ?></td>
                        <td class='alinearder'><?php echo number_format($s['servicio_acuenta'],2); ?></td>
                        <td class='alinearder'><?php echo number_format($s['servicio_saldo'],2); ?></td>
                        <td class='alinearcentro' style="background-color: #<?php echo $s['estado_color']; ?>"><?php echo $s['estado_descripcion']; ?></td>
                        <td class='alinearcentro'><?php echo $s['tiposerv_descripcion']; ?></td>
                        <td><?php echo $s['detalleserv_descripcion']; ?></td>
                        <td><?php echo $s['respusuario_nombre']; ?></td>
                        <td>
                            <form action="<?php echo site_url('servicio/boletainftecdetalleserv/'.$s['detalleserv_id']); ?>" method="post" target="_blank">
                            <button class="btn btn-success btn-xs" type="submit"><span class="fa fa-print"></span></button>
                            <input type="checkbox" name="contitulo<?php echo $s['detalleserv_id']; ?>" title="Imprimir sin encabezado">
                            </form>
                        </td>
                        
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                    <!--<tr>
                        <td class='alinearder negrita tamanio10pt' colspan="6">Total</td>
                        <td class='alinearder negrita tamanio10pt'><span id="eltotal"><?php //echo number_format($total,2); ?></span></td>
                        <td class='alinearder negrita tamanio10pt'><span id="elacuenta"><?php //echo number_format($acuenta,2); ?></span></td>
                        <td class='alinearder negrita tamanio10pt'><span id="elsaldo"><?php //echo number_format($saldo,2); ?></span></td>
                    </tr> -->
                </table>
                                
            <!--</div>-->
        <!--</div>-->
    </div>
<div class="no-print">
<a href="<?php echo site_url('reportes/servicioreportes'); ?>" class="btn btn-danger">
    <i class="fa fa-times"></i> Cerrar
</a>
</div>