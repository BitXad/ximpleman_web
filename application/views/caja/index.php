<<<<<<< HEAD
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Caja Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('caja/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Caja Id</th>
						<th>Estado Id</th>
						<th>Moneda Id</th>
						<th>Usuario Id</th>
						<th>Caja Corte5</th>
						<th>Caja Corte2</th>
						<th>Caja Corte1</th>
						<th>Caja Corte050</th>
						<th>Caja Corte020</th>
						<th>Caja Corte010</th>
						<th>Caja Corte005</th>
						<th>Caja Efectivo</th>
						<th>Caja Credito</th>
						<th>Caja Transacciones</th>
						<th>Caja Apertura</th>
						<th>Caja Fechaapertura</th>
						<th>Caja Horaapertura</th>
						<th>Caja Cierre</th>
						<th>Caja Horacierre</th>
						<th>Caja Fechacierre</th>
						<th>Caja Diferencia</th>
						<th>Caja Corte1000</th>
						<th>Caja Corte500</th>
						<th>Caja Corte200</th>
						<th>Caja Corte100</th>
						<th>Caja Corte50</th>
						<th>Caja Corte20</th>
						<th>Caja Corte10</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($caja as $c){ ?>
                    <tr>
						<td><?php echo $c['caja_id']; ?></td>
						<td><?php echo $c['estado_id']; ?></td>
						<td><?php echo $c['moneda_id']; ?></td>
						<td><?php echo $c['usuario_id']; ?></td>
						<td><?php echo $c['caja_corte5']; ?></td>
						<td><?php echo $c['caja_corte2']; ?></td>
						<td><?php echo $c['caja_corte1']; ?></td>
						<td><?php echo $c['caja_corte050']; ?></td>
						<td><?php echo $c['caja_corte020']; ?></td>
						<td><?php echo $c['caja_corte010']; ?></td>
						<td><?php echo $c['caja_corte005']; ?></td>
						<td><?php echo $c['caja_efectivo']; ?></td>
						<td><?php echo $c['caja_credito']; ?></td>
						<td><?php echo $c['caja_transacciones']; ?></td>
						<td><?php echo $c['caja_apertura']; ?></td>
						<td><?php echo $c['caja_fechaapertura']; ?></td>
						<td><?php echo $c['caja_horaapertura']; ?></td>
						<td><?php echo $c['caja_cierre']; ?></td>
						<td><?php echo $c['caja_horacierre']; ?></td>
						<td><?php echo $c['caja_fechacierre']; ?></td>
						<td><?php echo $c['caja_diferencia']; ?></td>
						<td><?php echo $c['caja_corte1000']; ?></td>
						<td><?php echo $c['caja_corte500']; ?></td>
						<td><?php echo $c['caja_corte200']; ?></td>
						<td><?php echo $c['caja_corte100']; ?></td>
						<td><?php echo $c['caja_corte50']; ?></td>
						<td><?php echo $c['caja_corte20']; ?></td>
						<td><?php echo $c['caja_corte10']; ?></td>
						<td>
                            <a href="<?php echo site_url('caja/edit/'.$c['caja_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('caja/remove/'.$c['caja_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
=======
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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Caja</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($caja); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('caja/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Caja</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Apertura</th>
                        <th>Fecha Apertura</th>
                        <th>Cierre</th>
                        <th>Fecha Cierre</th>
                        <th>Diferencia</th>
                        <th>Cortes</th>
                        <th>Efectivo</th>
                        <th>Credito</th>
                        <th>transacciones</th>
                        <th>Moneda</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                    <?php $i = 0; foreach($caja as $c){ ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td><?php echo $c['caja_apertura']; ?></td>
                        <td><?php echo $c['caja_fechaapertura']; echo " ".$c['caja_horaapertura']; ?></td>
                        <td><?php echo $c['caja_cierre']; ?></td>
                        <td><?php echo $c['caja_fechacierre']; echo " ".$c['caja_horacierre'] ?></td>
                        <td><?php echo $c['caja_diferencia']; ?></td>
                        <td>
                            <?php
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 1000: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte1000'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 500: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte500'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 200: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte200'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 100: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte100'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 50: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte50'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 20: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte20'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 10: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte10'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 5: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte5'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 2: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte2'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 1: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte1'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 050: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte050'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 020: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte020'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 010: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte010'],0,'.',',')."</span>";
                            echo "</div>";
                            echo "<div class='col-md-3' style='padding-left: 2px; padding-right: 2px'>";
                            echo "Cortes de 005: <span class='text-bold' style='font-size: 11px'>".number_format($c['caja_corte005'],0,'.',',')."</span>";
                            echo "</div>";
                            ?>
                        </td>
                        <td><?php echo $c['caja_efectivo']; ?></td>
                        <td><?php echo $c['caja_credito']; ?></td>
                        <td><?php echo $c['caja_transacciones']; ?></td>
                        <td><?php echo $c['moneda_descripcion']; ?></td>
                        <td><?php echo $c['estado_descripcion']; ?></td>
                        <td><?php echo $c['usuario_nombre']; ?></td>
                        <td>
                            <a href="<?php echo site_url('caja/edit/'.$c['caja_id']); ?>" class="btn btn-info btn-xs" title="Modificar caja"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php //echo site_url('caja/remove/'.$c['caja_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
>>>>>>> master
