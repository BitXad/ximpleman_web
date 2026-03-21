<!-- jQuery -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<!-- Estilos estándar -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<!-- Cabecera -->
<div class="box-header">
    <font size='4' face='Arial'><b>Caja</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($caja); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('caja/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Caja
        </a>
    </div>
</div>

<!-- Filtros -->
<div class="row no-print">
    <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Cajero, código, observación...">
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon">Desde</span>
            <input id="fecha_desde" type="text" class="form-control" placeholder="dd/mm/yyyy">
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon">Hasta</span>
            <input id="fecha_hasta" type="text" class="form-control" placeholder="dd/mm/yyyy">
        </div>
    </div>
    <div class="col-md-2">
        <button id="limpiar_fechas" class="btn btn-default btn-block">Limpiar Fechas</button>
    </div>
</div>

<br>

<!-- Tabla -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
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
                            <th rowspan="2">OBSERVACIÓN</th>
                            <th rowspan="2">FECHA<br>CIERRE</th>
                            <th rowspan="2">MND.</th>
                            <th colspan="12" class="text-center">CORTES</th>
                            <th rowspan="2">Estado</th>
                            <th rowspan="2" class="no-print"></th>
                        </tr>
                        <tr>
                            <th>200</th><th>100</th><th>50</th><th>20</th><th>10</th><th>5</th><th>2</th><th>1</th>
                            <th>0.50</th><th>0.20</th><th>0.10</th><th>0.05</th>
                        </tr>
                    </thead>

                    <tbody class="buscar">
                        <?php $i = 0; foreach($caja as $c){ 
                            // dd/mm/yyyy
                            $fechaApertura = ($c['caja_fechaapertura']) ? date("d/m/Y", strtotime($c['caja_fechaapertura'])) : "";
                            $fechaCierre   = ($c['caja_fechacierre'])   ? date("d/m/Y", strtotime($c['caja_fechacierre']))   : "";
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td class="nowrap"><?php echo $c['usuario_nombre']; ?></td>
                            <td class="nowrap"><?php echo "00".$c['caja_id']; ?></td>
                            <td><?php echo $fechaApertura." ".$c['caja_horaapertura']; ?></td>

                            <td style="text-align:right"><?php echo number_format(is_numeric($c['caja_apertura'])?$c['caja_apertura']:0, 2, '.', ','); ?></td>
                            <td style="text-align:right"><?php echo number_format(is_numeric($c['caja_transacciones'])?$c['caja_transacciones']:0, 2, '.', ','); ?></td>
                            <td style="text-align:right;background:#00FF00;font-weight:bold;">
                                <?php echo number_format(($c['caja_transacciones'] + $c['caja_apertura']), 2, '.', ','); ?>
                            </td>
                            <td style="text-align:right;background:#00FF00;font-weight:bold;">
                                <?php echo number_format(is_numeric($c['caja_cierre'])?$c['caja_cierre']:0, 2, '.', ','); ?>
                            </td>
                            <td style="text-align:right;background:#FFFF00;font-weight:bold;">
                                <?php echo number_format(is_numeric($c['caja_diferencia'])?$c['caja_diferencia']:0, 2, '.', ','); ?>
                            </td>

                            <td>
                                <?php echo ($c['caja_diferencia']>0) ? "SOBRANTE" : (($c['caja_diferencia']==0) ? "" : "FALTANTE"); ?>
                            </td>

                            <td><?php echo $fechaCierre." ".$c["caja_horacierre"]; ?></td>
                            <td><?php echo $c['moneda_descripcion']; ?></td>

                            <td style="background:#F2B33F"><?php echo $c['caja_corte200']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte100']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte50']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte20']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte10']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte5']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte2']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte1']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte050']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte020']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte010']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte005']; ?></td>

                            <td><?php echo $c['estado_descripcion']; ?></td>

                            <td class="no-print">
                                <a href="<?php echo site_url('caja/edit/'.$c['caja_id']); ?>" class="btn btn-info btn-xs" title="Modificar caja">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                <a href="<?php echo site_url('caja/cierre_cajadmin/'.$c['caja_id']); ?>" class="btn btn-facebook btn-xs" title="Cierre de caja">
                                    <span class="fa fa-suitcase"></span>
                                </a>
                                <a href="<?php echo site_url('caja/reporte_caja/'.$c['caja_id']); ?>" class="btn btn-success btn-xs" target="_blank" title="Reporte cierre de caja">
                                    <span class="fa fa-print"></span>
                                </a>
                                <a href="<?php echo site_url('reportes/reportecajadmin'); ?>" class="btn btn-soundcloud btn-xs" title="Resumen de Ventas">
                                    <span class="fa fa-file-archive-o"></span>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

<!-- DataTables + Buttons -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<!-- Filtros + DataTable -->
<script type="text/javascript">
$(document).ready(function () {
    // Índice de columna de FECHA CIERRE (0-based). Según el thead es la columna 10.
    var FECHA_CIERRE_COL = 10;

    // Utilidades de fecha dd/mm/yyyy -> Date (sin zonas)
    function parseDMY(s) {
        // s esperado "dd/mm/yyyy"
        var parts = s.split('/');
        if (parts.length !== 3) return null;
        var d = parseInt(parts[0], 10), m = parseInt(parts[1], 10) - 1, y = parseInt(parts[2], 10);
        if (isNaN(d) || isNaN(m) || isNaN(y)) return null;
        return new Date(y, m, d); // 00:00 local
    }

    // DataTable con exportación (exporta SOLO lo filtrado por defecto con modifier.search='applied')
    var tabla = $('#mitabla').DataTable({
        dom: 'Blfrtip',
        buttons: [
            { extend: 'copy',  text: '<i class="fas fa-copy"></i>',  exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'excel', text: '<i class="fas fa-file-excel"></i>', exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'csv',   text: '<i class="fas fa-file-csv"></i>',   exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'print', text: '<i class="fas fa-print"></i>',      exportOptions: { columns: ':visible', modifier: { search: 'applied' } } }
        ],
        pageLength: 50,
        language: {
            processing:   "Tratamiento en curso...",
            search:       "Buscar ",
            lengthMenu:   "Mostrar _MENU_ elementos ",
            info:         "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
            infoEmpty:    "Visualización del elemento 0 a 0 de 0 elementos",
            infoFiltered: "(filtro de _MAX_ elementos en total)",
            loadingRecords:"Cargando...",
            zeroRecords:  "No hay elementos para mostrar",
            emptyTable:   "No hay datos disponibles en la tabla.",
            paginate: { first:"primero", previous:"Anterior", next:"Próximo", last:"Último" },
            aria: { sortAscending: ": activar para ordenar la columna en orden ascendente",
                    sortDescending: ": activar para ordenar la columna en orden descendente" }
        }
    });

    // Buscador de texto (usa API de DataTables para que export respete el filtro)
    $('#filtrar').on('keyup', function () {
        tabla.search(this.value).draw();
    });

    // Filtro por rango dd/mm/yyyy sobre FECHA CIERRE (usa search plug-in para que export respete el filtro)
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        if (settings.nTable !== document.getElementById('mitabla')) { return true; }

        var desdeStr = $('#fecha_desde').val().trim();
        var hastaStr = $('#fecha_hasta').val().trim();

        // Texto en la columna de fecha cierre: "dd/mm/yyyy hh:mm"
        var celda = data[FECHA_CIERRE_COL] || '';
        var soloFecha = celda.split(' ')[0]; // toma "dd/mm/yyyy"
        var fechaRow = parseDMY(soloFecha);

        if (!fechaRow) return true; // si no se pudo parsear, no filtrar esa fila

        var desde = desdeStr ? parseDMY(desdeStr) : null;
        var hasta = hastaStr ? parseDMY(hastaStr) : null;

        if (desde && fechaRow < desde) return false;
        if (hasta) {
            // incluir hasta el final del día
            var hastaEnd = new Date(hasta.getFullYear(), hasta.getMonth(), hasta.getDate(), 23, 59, 59, 999);
            if (fechaRow > hastaEnd) return false;
        }
        return true;
    });

    function aplicarRango() {
        tabla.draw();
    }

    $('#fecha_desde, #fecha_hasta').on('change keyup blur', aplicarRango);

    $('#limpiar_fechas').on('click', function(){
        $('#fecha_desde').val('');
        $('#fecha_hasta').val('');
        tabla.draw();
    });
});
</script>

<!-- Impresión -->
<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .no-print { display: none !important; }
</style>
