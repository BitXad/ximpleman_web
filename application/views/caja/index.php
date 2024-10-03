<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<!-------------------------------------------------------->


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
                        <th rowspan="2">#</th>
                        <th rowspan="2">CAJERO(A)</th>                        
                        <th rowspan="2">COD.</th>                        
                        <th rowspan="2">FECHA<br>APERTURA</th>
                        <th rowspan="2">MONTO<br>INICIAL</th>
                        <th rowspan="2">TRANSAC.</th>
                        <th rowspan="2">TOTAL<br>ESPERADO</th>
                        <th rowspan="2">TOTAL<br>REGISTRADO</th>
                        <th rowspan="2">DIFERENCIA</th>
                        <th rowspan="2">OBSERVACION</th>
                        <th rowspan="2">FECHA<br>CIERRE</th>
                        <th rowspan="2">MND.</th>
                        <th colspan="12">CORTES</th>
                        <th rowpan="2">Estado</th>
                        <th rowspan="1">Usuario</th>

                    </tr>
                    <tr>
                        <th>200</th>
                        <th>100</th>
                        <th>50</th>
                        <th>20</th>
                        <th>10</th>
                        <th>5</th>
                        <th>2</th>
                        <th>1</th>
                        <th>0.50</th>
                        <th>0.20</th>
                        <th>0.10</th>
                        <th>0.05</th>
                        
                        <th></th>
                        <th>
                            <a href="<?php echo site_url('reportes/reportecajadmin'); ?>" class="btn btn-soundcloud btn-xs" title="Resumen de Ventas"><span class="fa fa-file-archive-o"></span></a>
                        </th>
                    </tr>
                    
                    <?php $i = 0; foreach($caja as $c){ ?>
                    <tr>
                        <!-- # -->
                        <td><?php echo (++$i); ?></td>
                        <!-- Cajero -->
                        <td class="nowrap"><?php echo $c['usuario_nombre']; ?></td>
                        <!-- Cod -->
                        <td class="nowrap"><?php echo "00".$c['caja_id']; ?></td>
                        <!-- Fecha Apertura -->
                        <td><?php echo $c['caja_fechaapertura']; echo " ".$c['caja_horaapertura']; ?></td>
                        <!-- Monto Apertura -->
                        <td style="text-align: right"><?php echo number_format(is_numeric($c['caja_apertura'])?$c['caja_apertura']:0,2,'.',','); ?></td>
                        <!-- transacciones -->
                        <td style="text-align: right"><?php echo number_format(is_numeric($c['caja_transacciones'])?$c['caja_transacciones']:0,2,'.',','); ?></td>
                        <!-- Total Esperado -->
                        <td style="text-align: right; background:#00FF00; font-weight: bold; font-size: 10pt; "><?php echo number_format($c['caja_transacciones'] + $c['caja_apertura'],2,'.',','); ?></td>
                        <!-- Diferencia -->
                        <td style="text-align: right; background:#00FF00; font-weight: bold; font-size: 10pt; "><?php echo number_format(is_numeric($c['caja_cierre'])?$c['caja_cierre']:0,2,'.',','); ?></td>
                        <td style="text-align: right; background:#ff0; font-weight: bold; font-size: 10pt; "><?php echo number_format(is_numeric($c['caja_diferencia'])?$c['caja_diferencia']:0,2,'.',','); ?></td>
                        
                        <td><?php echo ($c['caja_diferencia']>0) ? "SOBRANTE" : (($c['caja_diferencia']==0) ? " " : "FALTANTE"); ?></td>
                        <td><?php echo $c['caja_fechacierre']." ".$c["caja_horacierre"]; ?></td>
                        

                        <td><?php echo $c['moneda_descripcion']; ?></td>
                        
                        <td style="background: #F2B33F"><?php echo $c['caja_corte200']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte100']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte50']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte20']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte10']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte5']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte2']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte1']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte050']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte020']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte010']; ?></td>
                        <td style="background: #F2B33F"><?php echo $c['caja_corte005']; ?></td>
                        <td><?php echo $c['estado_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('caja/edit/'.$c['caja_id']); ?>" class="btn btn-info btn-xs" title="Modificar caja"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('caja/cierre_cajadmin/'.$c['caja_id']); ?>" class="btn btn-facebook btn-xs" title="Cierre de caja"><span class="fa fa-suitcase"></span></a> 
                            <a href="<?php echo site_url('caja/reporte_caja/'.$c['caja_id']); ?>" class="btn btn-success btn-xs" title="Reporte cierre de caja"><span class="fa fa-print"></span></a> 
                            <!--<a href="<?php //echo site_url('caja/remove/'.$c['caja_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

<!-- Scripts necesarios para DataTables y la funcionalidad de exportación -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    
    $(document).ready(function() {
        
        $('#mitabla').DataTable({
            dom: 'Blfrtip', // Añadido 'l' para el selector de longitud de página            
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i>'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i>'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>'
                }
            ],
            pageLength: 50, // Mostrar 40 registros por defecto
            language: {
                processing:     "Tratamiento en curso...",
                search:         "Buscar ",
                lengthMenu:     "Mostrar _MENU_ elementos ",
                info:           "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
                infoEmpty:      "Visualización del elemento 0 a 0 de 0 elementos",
                infoFiltered:   "(filtro de _MAX_ elementos en total)",
                loadingRecords: "Cargando...",
                zeroRecords:    "No hay elementos para mostrar",
                emptyTable:     "No hay datos disponibles en la tabla.",
                paginate: {
                    first:      "primero",
                    previous:   "Anterior",
                    next:       "Próximo",
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": activar para ordenar la columna en orden ascendente",
                    sortDescending: ": activar para ordenar la columna en orden descendente"
                }
            }
        });
    });
    
</script>

<style type="text/css" media="print">
    /* Ocultar botones y controles específicos al imprimir */
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info {
        display: none !important;
    }

    /* Ocultar otros elementos no deseados */
    .no-print {
        display: none !important;
    }
</style>

<!-- fin Scripts necesarios para DataTables y la funcionalidad de exportación -->