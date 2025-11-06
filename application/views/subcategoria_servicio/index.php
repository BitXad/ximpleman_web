<!----------------------------- JS base y helpers ------------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones_subcategoria.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<!----------------------------- Estilos ----------------------------------------------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<!----------------------------- Cabecera ----------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Sub Categoría Servicio</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($subcategoria_servicio); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('subcategoria_servicio/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Sub Categoría
        </a>
    </div>
</div>

<!----------------------------- Buscador (estándar) ----------------------------------------->
<div class="row no-print">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción, categoría, estado...">
        </div>
    </div>
</div>
<br>

<!----------------------------- Tabla principal --------------------------------------------->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th class="no-print">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablasubcatresultados">
                        <?php $cont = 0; foreach($subcategoria_servicio as $c){ if(isset($c['subcatserv_id']) && (int)$c['subcatserv_id'] !== 0){ $cont++; ?>
                        <tr>
                            <td><?php echo $cont; ?></td>
                            <td><?php echo $c['subcatserv_descripcion']; ?></td>
                            <td style="text-align:right">
                                <?php 
                                  $precio = isset($c['subcatserv_precio']) && is_numeric($c['subcatserv_precio']) ? $c['subcatserv_precio'] : 0;
                                  echo number_format($precio, 2, '.', ','); 
                                ?>
                            </td>
                            <td><?php echo isset($c['catserv_descripcion']) ? $c['catserv_descripcion'] : ''; ?></td>
                            <td style="background-color:#<?php echo $c['estado_color']; ?>">
                                <?php echo $c['estado_descripcion']; ?>
                            </td>
                            <td class="no-print">
                                <!-- Ver insumos asignados (abre modal con DataTable interno) -->
                                <a class="btn btn-success btn-xs"
                                   data-toggle="modal"
                                   data-target="#modalverinsumo<?php echo $c['subcatserv_id']; ?>"
                                   data-subcat="<?php echo $c['subcatserv_id']; ?>"
                                   data-subcat-nombre="<?php echo htmlspecialchars($c['subcatserv_descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                                   title="Ver insumos asignados de: <?php echo $c['subcatserv_descripcion']; ?>">
                                    <span class="fa fa-eye"></span>
                                </a>

                                <!-- Asignar/Quitar insumos -->
                                <a href="<?php echo site_url('categoria_insumo/insumo/'.$c['subcatserv_id']); ?>" class="btn btn-info btn-xs" title="Asignar / quitar insumos">
                                    <span class="fa fa-file-text-o"></span>
                                </a>

                                <!-- Editar -->
                                <a href="<?php echo site_url('subcategoria_servicio/edit/'.$c['subcatserv_id']); ?>" class="btn btn-primary btn-xs" title="Editar">
                                    <span class="fa fa-pencil"></span>
                                </a>

                                <!-- Eliminar (modal) -->
                                <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delModal<?php echo $c['subcatserv_id']; ?>" title="Eliminar">
                                    <span class="fa fa-trash"></span>
                                </a>

                                <!------------------------ Modal: Ver Insumos Asignados (DataTable) ------->
                                <div class="modal fade" id="modalverinsumo<?php echo $c['subcatserv_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalverinsumoLabel<?php echo $c['subcatserv_id']; ?>">
                                  <div class="modal-dialog modal-lg" role="document"><br><br>
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        <h3>Insumos Asignados a <b id="tituloSubcat<?php echo $c['subcatserv_id']; ?>"></b></h3>
                                      </div>
                                      <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-condensed" id="insumosTable<?php echo $c['subcatserv_id']; ?>">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Descripción</th>
                                                        <th>Código</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Se carga vía AJAX -->
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                      <div class="modal-footer aligncenter">
                                        <a href="#" class="btn btn-danger" data-dismiss="modal">
                                            <span class="fa fa-times"></span> Cerrar
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!------------------------ Modal: Confirmar eliminación ------------------->
                                <div class="modal fade" id="delModal<?php echo $c['subcatserv_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="delModalLabel<?php echo $c['subcatserv_id']; ?>">
                                  <div class="modal-dialog" role="document"><br><br>
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                      </div>
                                      <div class="modal-body">
                                        <h3><b><span class="fa fa-trash"></span></b>
                                            ¿Desea eliminar la subcategoría de Servicio <b><?php echo $c['subcatserv_descripcion']; ?></b>?
                                        </h3>
                                      </div>
                                      <div class="modal-footer aligncenter">
                                        <a href="<?php echo site_url('subcategoria_servicio/remove/'.$c['subcatserv_id']); ?>" class="btn btn-success">
                                            <span class="fa fa-check"></span> Si
                                        </a>
                                        <a href="#" class="btn btn-danger" data-dismiss="modal">
                                            <span class="fa fa-times"></span> No
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!----------------------------- DataTables + Buttons (JS) ----------------------------------->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<!----------------------------- Lógica estándar + Modal DT ---------------------------------->
<script>
(function(){
    var BASE_URL = document.getElementById('base_url').value;

    // DataTable principal
    var tablaPrincipal;

    $(document).ready(function () {
        // Inicializa DataTable principal (exporta sólo lo filtrado)
        tablaPrincipal = $('#mitabla').DataTable({
            dom: 'Blfrtip',
            buttons: [
                { extend: 'copy',  text: '<i class="fas fa-copy"></i>',        exportOptions: { columns: ':visible:not(.no-print)', modifier: { search: 'applied' } } },
                { extend: 'excel', text: '<i class="fas fa-file-excel"></i>',  exportOptions: { columns: ':visible:not(.no-print)', modifier: { search: 'applied' } } },
                { extend: 'csv',   text: '<i class="fas fa-file-csv"></i>',    exportOptions: { columns: ':visible:not(.no-print)', modifier: { search: 'applied' } } },
                { extend: 'print', text: '<i class="fas fa-print"></i>',       exportOptions: { columns: ':visible:not(.no-print)', modifier: { search: 'applied' } } }
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

        // Buscador externo (para que export respete el filtro)
        $('#filtrar').on('keyup', function () {
            tablaPrincipal.search(this.value).draw();
        });

        // Hook genérico: cuando se abre cualquier modal de insumos, carga y dibuja DT
        $('[id^=modalverinsumo]').on('shown.bs.modal', function (e) {
            var $btn = $(e.relatedTarget);
            var subcatId = $btn.data('subcat');
            var subcatNombre = $btn.data('subcat-nombre') || '';
            $('#tituloSubcat'+subcatId).text(subcatNombre);
            cargarInsumosDataTable(subcatId);
        });
    });

    // Carga por AJAX y construye/actualiza el DataTable del modal
    function cargarInsumosDataTable(subcatId){
        var $table = $('#insumosTable'+subcatId);
        var $tbody = $table.find('tbody');
        $tbody.html('<tr><td colspan="4">Cargando...</td></tr>');

        $.ajax({
            url: BASE_URL + 'subcategoria_servicio/buscarinsumosasignados',
            type: 'POST',
            data: { subcatserv_id: subcatId },
            success: function(resp){
                var data = [];
                try{
                    data = JSON.parse(resp || '[]');
                }catch(err){
                    $tbody.html('<tr><td colspan="4">No se pudo interpretar la respuesta.</td></tr>');
                    return;
                }

                if(!Array.isArray(data) || data.length === 0){
                    $tbody.html('<tr><td colspan="4">No hay insumos asignados.</td></tr>');
                }else{
                    // Construir filas
                    var filas = '';
                    for(var i=0;i<data.length;i++){
                        var item = data[i] || {};
                        var fila = '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td><b>'+(item.producto_nombre||'')+'</b><br>'+
                                (item.producto_unidad||'')+' | '+(item.producto_marca||'')+' | '+(item.producto_industria||'')+
                            '</td>'+
                            '<td>'+(item.producto_codigo||'')+'<br>'+(item.producto_codigobarra||'')+'</td>'+
                            '<td style="background-color:#'+(item.estado_color||'ffffff')+'">'+(item.estado_descripcion||'')+'</td>'+
                        '</tr>';
                        filas += fila;
                    }
                    $tbody.html(filas);
                }

                // (Re)inicializar DataTable del modal
                if ( $.fn.DataTable.isDataTable( $table ) ) {
                    $table.DataTable().destroy();
                }
                $table.DataTable({
                    dom: 'Blfrtip',
                    buttons: [
                        { extend: 'copy',  text: '<i class="fas fa-copy"></i>',        exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
                        { extend: 'excel', text: '<i class="fas fa-file-excel"></i>',  exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
                        { extend: 'csv',   text: '<i class="fas fa-file-csv"></i>',    exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
                        { extend: 'print', text: '<i class="fas fa-print"></i>',       exportOptions: { columns: ':visible', modifier: { search: 'applied' } } }
                    ],
                    pageLength: 10,
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
            },
            error: function(){
                $tbody.html('<tr><td colspan="4">Error de comunicación.</td></tr>');
            }
        });
    }
})();
</script>

<!----------------------------- Impresión --------------------------------------------------->
<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .no-print { display: none !important; }
</style>
