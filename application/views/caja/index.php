<!-- jQuery -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<!-- Estilos estándar -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<?php
function obtenerTransaccionesRegistradas($texto = '')
{
    $resultado = array(
        'qr'             => '',
        'tarjeta'        => '',
        'transferencia'  => '',
        'billetera'      => ''
    );

    if (!$texto) {
        return $resultado;
    }

    $lineas = preg_split('/\r\n|\r|\n/', trim($texto));

    foreach ($lineas as $linea) {
        $linea = trim($linea);
        if ($linea === '') {
            continue;
        }

        if (preg_match('/^TRANSACCIONES\s+QR\s*:\s*([0-9.,-]+)$/i', $linea, $m)) {
            $resultado['qr'] = $m[1];
        } elseif (preg_match('/^TARJETAS\s+DE\s+DEBITO\/CREDITO\s*:\s*([0-9.,-]+)$/i', $linea, $m)) {
            $resultado['tarjeta'] = $m[1];
        } elseif (
            preg_match('/^TRASNFERENCIAS\s+BANCARIAS\s*:\s*([0-9.,-]+)$/i', $linea, $m) ||
            preg_match('/^TRANSFERENCIAS\s+BANCARIAS\s*:\s*([0-9.,-]+)$/i', $linea, $m)
        ) {
            $resultado['transferencia'] = $m[1];
        } elseif (
            preg_match('/^BILLETERA\s+MOVIL\s*:\s*([0-9.,-]+)$/i', $linea, $m) ||
            preg_match('/^BILLETERA\s+MÓVIL\s*:\s*([0-9.,-]+)$/i', $linea, $m)
        ) {
            $resultado['billetera'] = $m[1];
        }
    }

    return $resultado;
}
?>

<!-- Cabecera -->
<div class="box-header">
    <font size='4' face='Arial'><b>Caja</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($caja); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('caja/add'); ?>" class="btn btn-success btn-sm">
            <span class='fa fa-pencil-square-o'></span> Registrar Caja
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

                            <th rowspan="2">TIPO<br>DIF.</th>
                            <th rowspan="2">EFECTIVO</th>
                            <th rowspan="2">CRÉDITO</th>
                            <th rowspan="2">TRANS.<br>REALIZADAS</th>
                            <th rowspan="2">TRANS.<br>REGISTRADAS</th>

                            <!-- columnas solo para exportación -->
                            <th rowspan="2" class="export-only">QR</th>
                            <th rowspan="2" class="export-only">TARJETA</th>
                            <th rowspan="2" class="export-only">TRANSFER.</th>
                            <th rowspan="2" class="export-only">BILLETERA</th>

                            <th rowspan="2">OBSERVACIONES</th>
                            <th rowspan="2">FECHA<br>CIERRE</th>
                            <th rowspan="2">MND.</th>

                            <th colspan="14" class="text-center">CORTES</th>

                            <th rowspan="2">Estado</th>
                            <th rowspan="2" class="no-print no-export"></th>
                        </tr>
                        <tr>
                            <th>1000</th>
                            <th>500</th>
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
                        </tr>
                    </thead>

                    <tbody class="buscar">
                        <?php $i = 0; foreach($caja as $c){

                            $fechaApertura = ($c['caja_fechaapertura']) ? date("d/m/Y", strtotime($c['caja_fechaapertura'])) : "";
                            $fechaCierre   = ($c['caja_fechacierre']) ? date("d/m/Y", strtotime($c['caja_fechacierre'])) : "";

                            $apertura = is_numeric($c['caja_apertura']) ? (float)$c['caja_apertura'] : 0;
                            $transac  = is_numeric($c['caja_transacciones']) ? (float)$c['caja_transacciones'] : 0;
                            $cierre   = is_numeric($c['caja_cierre']) ? (float)$c['caja_cierre'] : 0;
                            $diff     = is_numeric($c['caja_diferencia']) ? (float)$c['caja_diferencia'] : 0;

                            $tipoDiff = ($diff > 0) ? "SOBRANTE" : (($diff < 0) ? "FALTANTE" : "");

                            $efectivo = is_numeric($c['caja_efectivo']) ? (float)$c['caja_efectivo'] : 0;
                            $credito  = is_numeric($c['caja_credito']) ? (float)$c['caja_credito'] : 0;

                            $transReal = isset($c['caja_transrealizadas']) ? (string)$c['caja_transrealizadas'] : "";
                            $transReg  = isset($c['caja_transregistradas']) ? (string)$c['caja_transregistradas'] : "";
                            $obsReal   = isset($c['caja_observaciones']) ? (string)$c['caja_observaciones'] : "";

                            $detalleTransReg = obtenerTransaccionesRegistradas($transReg);
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td class="nowrap"><?php echo $c['usuario_nombre']; ?></td>
                            <td class="nowrap"><?php echo "00".$c['caja_id']; ?></td>
                            <td><?php echo $fechaApertura." ".$c['caja_horaapertura']; ?></td>

                            <td style="text-align:right"><?php echo number_format($apertura, 2, '.', ','); ?></td>
                            <td style="text-align:right"><?php echo number_format($transac, 2, '.', ','); ?></td>

                            <td style="text-align:right;background:#00FF00;font-weight:bold;">
                                <?php echo number_format(($transac + $apertura), 2, '.', ','); ?>
                            </td>

                            <td style="text-align:right;background:#00FF00;font-weight:bold;">
                                <?php echo number_format($cierre, 2, '.', ','); ?>
                            </td>

                            <td style="text-align:right;background:#FFFF00;font-weight:bold;">
                                <?php echo number_format($diff, 2, '.', ','); ?>
                            </td>

                            <td><?php echo $tipoDiff; ?></td>
                            <td style="text-align:right"><?php echo number_format($efectivo, 2, '.', ','); ?></td>
                            <td style="text-align:right"><?php echo number_format($credito, 2, '.', ','); ?></td>

                            <td class="nowrap" style="max-width:220px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"
                                title="<?php echo htmlspecialchars($transReal, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($transReal, ENT_QUOTES, 'UTF-8'); ?>
                            </td>

                            <td class="nowrap" style="max-width:220px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"
                                title="<?php echo htmlspecialchars($transReg, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo nl2br(htmlspecialchars($transReg, ENT_QUOTES, 'UTF-8')); ?>
                            </td>

                            <!-- columnas ocultas en pantalla, visibles en exportación -->
                            <td class="export-only"><?php echo $detalleTransReg['qr']; ?></td>
                            <td class="export-only"><?php echo $detalleTransReg['tarjeta']; ?></td>
                            <td class="export-only"><?php echo $detalleTransReg['transferencia']; ?></td>
                            <td class="export-only"><?php echo $detalleTransReg['billetera']; ?></td>

                            <td class="nowrap" style="max-width:220px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"
                                title="<?php echo htmlspecialchars($obsReal, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($obsReal, ENT_QUOTES, 'UTF-8'); ?>
                            </td>

                            <td><?php echo $fechaCierre." ".$c["caja_horacierre"]; ?></td>
                            <td><?php echo $c['moneda_descripcion']; ?></td>

                            <td style="background:#F2B33F"><?php echo $c['caja_corte1000']; ?></td>
                            <td style="background:#F2B33F"><?php echo $c['caja_corte500']; ?></td>
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

                            <td class="no-print no-export">
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
            </div>
        </div>
    </div>
</div>



<!-- DataTables + Buttons -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {

    // 0 # 
    // 1 cajero
    // 2 cod
    // 3 fecha apertura
    // 4 monto inicial
    // 5 transac
    // 6 total esperado
    // 7 total registrado
    // 8 diferencia
    // 9 tipo dif
    // 10 efectivo
    // 11 credito
    // 12 trans realizadas
    // 13 trans registradas
    // 14 qr
    // 15 tarjeta
    // 16 transferencia
    // 17 billetera
    // 18 observaciones
    // 19 fecha cierre
    // 20 mnd
    // 21..34 cortes
    // 35 estado
    // 36 acciones

    var FECHA_CIERRE_COL = 19;

    function parseDMY(s) {
        var parts = s.split('/');
        if (parts.length !== 3) return null;
        var d = parseInt(parts[0], 10),
            m = parseInt(parts[1], 10) - 1,
            y = parseInt(parts[2], 10);

        if (isNaN(d) || isNaN(m) || isNaN(y)) return null;
        return new Date(y, m, d);
    }

    var tabla = $('#mitabla').DataTable({
        dom: 'Blfrtip',
        columnDefs: [
            {
                targets: [14, 15, 16, 17],
                visible: false,
                searchable: false
            }
        ],
        buttons: [
            {
                extend: 'copy',
                text: 'Copiar',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35],
                    modifier: { search: 'applied' }
                }
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35],
                    modifier: { search: 'applied' },
                    format: {
                        body: function (data, row, column, node) {
                            if (typeof data === 'string') {
                                data = data.replace(/<br\s*\/?>/gi, '\n');
                                data = data.replace(/<\/?[^>]+(>|$)/g, '');
                            }
                            return data;
                        }
                    }
                },
                customizeData: function (data) {
                    // Separar FECHA APERTURA (columna índice 3 del export)
                    // Antes: [ ..., "18/03/2026 08:30:00", ... ]
                    // Después: [ ..., "18/03/2026", "08:30:00", ... ]

                    // Cambiar encabezado
                    data.header.splice(4, 0, 'HORA APERTURA');
                    data.header[3] = 'FECHA APERTURA';

                    // Cambiar filas
                    for (var i = 0; i < data.body.length; i++) {
                        var valor = data.body[i][3] ? data.body[i][3].toString().trim() : '';
                        var partes = valor.split(' ');

                        var fecha = partes.length > 0 ? partes[0] : '';
                        var hora = partes.length > 1 ? partes.slice(1).join(' ') : '';

                        data.body[i][3] = fecha;
                        data.body[i].splice(4, 0, hora);
                    }
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35],
                    modifier: { search: 'applied' }
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: ':visible:not(.no-export)',
                    modifier: { search: 'applied' }
                }
            }
        ],
        pageLength: 50,
        language: {
            processing:    "Tratamiento en curso...",
            search:        "Buscar ",
            lengthMenu:    "Mostrar _MENU_ elementos ",
            info:          "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
            infoEmpty:     "Visualización del elemento 0 a 0 de 0 elementos",
            infoFiltered:  "(filtro de _MAX_ elementos en total)",
            loadingRecords:"Cargando...",
            zeroRecords:   "No hay elementos para mostrar",
            emptyTable:    "No hay datos disponibles en la tabla.",
            paginate: {
                first:    "primero",
                previous: "Anterior",
                next:     "Próximo",
                last:     "Último"
            },
            aria: {
                sortAscending:  ": activar para ordenar la columna en orden ascendente",
                sortDescending: ": activar para ordenar la columna en orden descendente"
            }
        }
    });

    $('#filtrar').on('keyup', function () {
        tabla.search(this.value).draw();
    });

    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        if (settings.nTable !== document.getElementById('mitabla')) return true;

        var desdeStr = $('#fecha_desde').val().trim();
        var hastaStr = $('#fecha_hasta').val().trim();

        var celda = data[FECHA_CIERRE_COL] || '';
        var soloFecha = celda.split(' ')[0];
        var fechaRow = parseDMY(soloFecha);

        if (!fechaRow) return true;

        var desde = desdeStr ? parseDMY(desdeStr) : null;
        var hasta = hastaStr ? parseDMY(hastaStr) : null;

        if (desde && fechaRow < desde) return false;

        if (hasta) {
            var hastaEnd = new Date(
                hasta.getFullYear(),
                hasta.getMonth(),
                hasta.getDate(),
                23, 59, 59, 999
            );
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