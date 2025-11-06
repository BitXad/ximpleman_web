<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<?php $decimales = $parametro['parametro_decimales']; ?>
<input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales" hidden>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<!----------------------------- fin script buscador --------------------------------------->

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<!-------------------------------------------------------->

<div class="row micontenedorep" style="display: none" id="cabeceraprint">
    <div id="cabizquierda">
        <?php
        echo $empresa[0]['empresa_nombre']."<br>";
        echo $empresa[0]['empresa_direccion']."<br>";
        echo $empresa[0]['empresa_telefono'];
        ?>
    </div>
    <div id="cabcentro">
        <div id="titulo">
            <u>PROVEEDORES</u><br><br>
            <span class="lahora" id="fhimpresion"></span><br>
            <span style="font-size: 8pt;" id="busquedaavanzada"></span>
        </div>
    </div>
    <div id="cabderecha">
        <?php
        $mimagen = "thumb_".$empresa[0]['empresa_imagen'];
        echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box-header">
            <font size='4' face='Arial'><b>Proveedores</b></font>
            <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($proveedor); ?></font> 
        </div>

        <div class="col-md-12">
            <!-- mantener exactamente tu buscador visual -->
            <div class="input-group">
                <span class="input-group-addon" style="background-color: lightgray;"> Buscar </span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código, serie" onkeypress="validar(event,4)">
                <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultados(1)" title="Buscar"><span class="fa fa-search" aria-hidden="true"></span></div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box-tools no-print">
            <center>            
                <a href="<?php echo site_url('proveedor/add'); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Registrar</small></a>
                <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="fechadecompra('and 1')" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
                <?php if($rol[113-1]['rolusuario_asignado'] == 1){ ?>
                <a href="#" onclick="imprimir_proveedor()" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
                <?php } ?>
            </center>            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">        
        <div class="box">            
            <div class="box-body table-responsive">
                <!-- mantengo clases originales: display y tbody class buscar -->
                <table class="table table-striped table-condensed display" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Nit<br>Razón</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>                        
                    </thead>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($proveedor as $p){;
                                 $cont = $cont+1; ?>
                        <tr>
                            <td><?php echo $cont; ?></td>
                            <td>
                                <div id="horizontal">
                                    <div>
                                        <?php if($p['proveedor_foto']){ ?>
                                            <a class="btn btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $cont; ?>" style="padding: 0px;">
                                                <?php echo '<img src="'.site_url('/resources/images/proveedores/'.$p['proveedor_foto']).'" style="width:60px;height:60px; margin-right: 5px;" />'; ?>
                                            </a>
                                        <?php } else {
                                            echo '<img src="'.site_url('/resources/images/usuarios/thumb_default.jpg').'" style="width:60px;height:60px; margin-right: 5px;" />'; 
                                        } ?>

                                        <!-- Modal imagen (igual que el tuyo) -->
                                        <div class="modal fade" id="mostrarimagen<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $cont; ?>">
                                          <div class="modal-dialog" role="document">
                                            <br><br>
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                                <font size="3"><b><?php echo $p['proveedor_nombre']; ?></b></font>
                                              </div>
                                              <div class="modal-body">
                                                <?php echo '<img style="max-height: 100%; max-width: 100%" src="'.site_url('/resources/images/proveedores/'.$p['proveedor_foto']).'" />'; ?>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>

                                    <div>
                                        <?php
                                        echo "<font size='3' face='Arial'><b>".$p['proveedor_nombre']."</b></font><sub> [".$p['proveedor_id']."]</sub><br>";
                                        echo "<b>CODIGO: </b>".$p['proveedor_codigo']."<br>";
                                        echo "<b>DIRECC.: </b>".$p['proveedor_direccion']."<br>";
                                        echo "<b>EMAIL: </b>".$p['proveedor_email'];
                                        ?>
                                    </div>
                                </div>
                            </td>

                            <td><?php echo $p['proveedor_contacto']; ?></br>
                            <b>TELEF.:</b> <?php echo $p['proveedor_telefono']."-".$p['proveedor_telefono2']; ?></td>
                            <td><?php echo $p['proveedor_nit']; ?></br>
                            <?php echo $p['proveedor_razon']; ?></td>
                            <td style="background-color: #<?php echo $p['estado_color']; ?>"><?php echo $p['estado_descripcion']; ?></td>

                            <td class="no-print">
                                <a href="<?php echo site_url('proveedor/edit/'.$p['proveedor_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>                
            </div>
        </div>

        <?php if($a =="1"){ ?>
            <a href="<?php echo site_url('proveedor'); ?>" class="btn btn-danger">
                <i class="fa fa-arrow-left"></i> Atras
            </a>
        <?php } ?>
    </div>
</div>

<!-- DataTables + Buttons (CDN) -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializo DataTable pero NO elimino tu estructura visual
        var table = $('#mitabla').DataTable({
            dom: 'Blfrtip',
            buttons: [
                { extend: 'copy', text: '<i class="fas fa-copy"></i>' },
                { extend: 'excel', text: '<i class="fas fa-file-excel"></i>' },
                { extend: 'csv', text: '<i class="fas fa-file-csv"></i>' },
                { extend: 'print', text: '<i class="fas fa-print"></i>' }
            ],
            pageLength: 50,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "todos"]],
            // mantengo ordering/autoWidth para que la tabla se vea igual que antes
            ordering: true,
            autoWidth: false,
            // lenguaje igual al ejemplo
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

        // Conservo tu filtro visual: input manual + boton de búsqueda.
        // Enlazo el input #filtrar a DataTables (para que busque cuando escribes)
        $('#filtrar').on('keyup', function(e) {
            // si quieres que ENTER redirija a buscarproveedor, conserva el comportamiento actual
            table.search(this.value).draw();
        });

        // Si tu código usaba filtro regex manual ('.buscar tr' hide/show), lo dejo comentado por si lo necesitas:
        /*
        (function ($) {
            $('#filtrar').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
        */
    });
</script>

<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info {
        display: none !important;
    }
    .no-print {
        display: none !important;
    }
</style>

<style type="text/css">
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    div.dataTables_length {
        padding-left: 2em;
    }
    div.dataTables_length,
    div.dataTables_filter {
        padding-top: 0.55em;
    }
</style>
