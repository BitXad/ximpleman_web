<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones_cliente.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/qrcode.js'); ?>" type="text/javascript"></script>

<!-- CSS para DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<!-- Bootstrap y DataTables CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<!-- jQuery y DataTables JS -->
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<!----------------------------- script buscador --------------------------------------->
<script type="text/javascript">
    $(document).ready(function () {
        $('#mitabla').DataTable({
            dom: 'Blfrtip', // Incluye el selector de longitud de página (l)            
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
            pageLength: 40, // Mostrar 40 registros por defecto
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

        (function ($) {
            $('#filtrar').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            });
        }(jQuery));
    });
</script>

<!----------------------------- fin script buscador --------------------------------------->

<style type="text/css">
    #contieneimg {
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #contieneimg img {
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #horizontal {
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg {
        font-size: 12px;
    }
    td.details-control {
        background: url('./resources/images/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('./resources/images/details_close.png') no-repeat center center;
    }
</style>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="formaimagen" id="formaimagen" value="<?php echo $parametro['parametro_formaimagen']; ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" />
<input type="hidden" name="parametro_puntos" id="parametro_puntos" value="<?php echo $parametro['parametro_puntos']; ?>" />
<input type="hidden" name="rescliente" id="rescliente" />

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
            <u>CLIENTES</u><br><br>
            <span class="lahora" id="fhimpresion"></span><br>
            <span style="font-size: 8pt;" id="busquedacategoria"></span>
        </div>
    </div>
    <div id="cabderecha">
        <?php
        $mimagen = "thumb_".$empresa[0]['empresa_imagen'];
        echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
        ?>
    </div>
</div>

<div class="row no-print">
    <div class="col-md-8">
        <div class="box-header">
            <font size='4' face='Arial'><b>Clientes</b></font>
            <br><font size='2' face='Arial' id="encontrados"></font> 
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon">Buscar</span>           
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, codigo, ci, nit" onkeypress="buscarcliente(event)" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box-tools">
                <select name="tipo_id" class="btn-primary btn-sm btn-block" id="tipo_id" onchange="tablaresultadoscliente(2)">
                    <option value="" disabled selected >-- TIPOS --</option>
                    <option value="0"> Todos los Tipos </option>
                    <?php 
                    foreach($all_tipo_cliente as $tipocliente)
                    {
                        echo '<option value="'.$tipocliente['tipocliente_id'].'">'.$tipocliente['tipocliente_descripcion'].'</option>';
                    } 
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box-tools">
                <select name="categoriaclie_id" class="btn-primary btn-sm btn-block" id="categoriaclie_id" onchange="tablaresultadoscliente(2)">
                    <option value="" disabled selected >-- CATEGORIAS --</option>
                    <option value="0"> Todas Las Categorias </option>
                    <?php 
                    foreach($all_categoria_cliente as $categoria)
                    {
                        echo '<option value="'.$categoria['categoriaclie_id'].'">'.$categoria['categoriaclie_descripcion'].'</option>';
                    } 
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box-tools">
                <select name="zona_id" class="btn-primary btn-sm btn-block" id="zona_id" onchange="tablaresultadoscliente(2)">
                    <option value="" disabled selected >-- ZONAS --</option>
                    <option value="0"> Todas Las Zonas </option>
                    <?php 
                    foreach($all_categoria_clientezona as $zona)
                    {
                        echo '<option value="'.$zona['zona_id'].'">'.$zona['zona_nombre'].'</option>';
                    } 
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box-tools">
                <select name="estado_id" class="btn-primary btn-sm btn-block" id="estado_id" onchange="tablaresultadoscliente(2)">
                    <option value="" disabled selected >-- ESTADOS --</option>
                    <option value="0"> Todos Los Estados </option>
                    <option value="1"> Activos </option>
                    <option value="2"> Inactivos </option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <button type="button" class="btn btn-primary pull-right" onclick="reporteClientes()"><i class="fa fa-print"></i> Imprimir</button>
    </div>
</div>

<div class="row">
    <table id="mitabla" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="width: 5%"></th>
                <th style="width: 20%">Nombre</th>
                <th style="width: 20%">Código</th>
                <th style="width: 20%">CI / NIT</th>
                <th style="width: 20%">Teléfono</th>
                <th style="width: 15%">Acciones</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php
            foreach($all_clientes as $cliente) {
                echo '<tr>';
                echo '<td></td>';
                echo '<td>'.$cliente['cliente_nombre'].'</td>';
                echo '<td>'.$cliente['cliente_codigo'].'</td>';
                echo '<td>'.$cliente['cliente_ci'].'</td>';
                echo '<td>'.$cliente['cliente_telefono'].'</td>';
                echo '<td>
                        <button class="btn btn-primary btn-xs" onclick="verDetalleCliente('.$cliente['cliente_id'].')">Ver</button>
                        <button class="btn btn-warning btn-xs" onclick="editarCliente('.$cliente['cliente_id'].')">Editar</button>
                        <button class="btn btn-danger btn-xs" onclick="eliminarCliente('.$cliente['cliente_id'].')">Eliminar</button>
                      </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
