<script src="<?php echo base_url('resources/js/producto_precios.js'); ?>"></script>
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<?php $decimales = $parametro['parametro_decimales']; ?>
<input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales" hidden>
<input type="text" id="base_url" value="<?php base_url(); ?>" name="base_url" hidden>
<!----------------------------- fin script buscador --------------------------------------->

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<!-------------------------------------------------------->

<div class="box-header">
    <font size='4' face='Arial'><b>Lista de precios</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($productos); ?></font>
    <br><font size='2' face='Arial'>Expresado en <?php echo $lamoneda['moneda_descripcion']; ?></font>
    <div class="box-tools no-print">

        <button type="button" id="boton_cambiarprecios"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_cambiarprecios" ><fa class='fa fa-money'></fa>  Ajustar Precios</button>
        <button class="btn btn-info btn-sm" onclick="cargar_precios()"><fa class='fa fa-list'></fa> Cargar lista de precios</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
<!--        <div class="input-group no-print">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción">
        </div>-->
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <!--<th>Id</th>-->
                            <th>Descripción</th>
                            <th>Costo.<br><?php echo $lamoneda['moneda_descripcion'] ?></th>
                            <th>Ultimo<br>Costo <?php echo $lamoneda['moneda_descripcion'] ?></th>
                            <th>Codigo</th>
                            <th>Precio<br><?php echo $lamoneda['moneda_descripcion'] ?></th>
                            <th>Precio<br>Factor1 <?php echo $lamoneda['moneda_descripcion'] ?></th>
                            <th>Precio<br>Factor2 <?php echo $lamoneda['moneda_descripcion'] ?></th>
                            <th>Precio<br>Factor3 <?php echo $lamoneda['moneda_descripcion'] ?></th>
                            <th>Precio<br>Factor4 <?php echo $lamoneda['moneda_descripcion'] ?></th>
                            <th>Precio<br>Factor5 <?php echo $lamoneda['moneda_descripcion'] ?></th>
                            <!--<th class="no-print"></th>-->
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $cont = 0;
                            foreach($productos as $t){;
                                $cont = $cont+1; ?>
                        <tr>
                            <td style="text-align: right;"><?php echo $cont ?></td>
                            <td><?php echo $t['producto_nombre']."<sub>[".$t['producto_id']."]</sub>"; ?></td>
                            <td><?php echo $t['producto_codigobarra']; ?></td>
                            <td style="text-align: right;"><?php echo number_format($t['producto_costo'],$decimales,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($t['producto_ultimocosto'],$decimales,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($t['producto_precio'],$decimales,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($t['producto_preciofactor'],$decimales,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($t['producto_preciofactor1'],$decimales,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($t['producto_preciofactor2'],$decimales,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($t['producto_preciofactor3'],$decimales,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($t['producto_preciofactor4'],$decimales,".",","); ?></td>
<!--                            <td class="no-print">
                                <a href="<?php echo site_url('tipo_cliente/edit/'.$t['producto_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                            </td>-->
                        </tr>
                        <?php } ?>
                    </tbody>
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



<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL CAMBIAR ----------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_cambiarprecios" class="btn btn-default" data-toggle="modal" data-target="#modal_cambiarprecios" >
      Ajustar precios
    </button>
    
</div>

<div class="modal fade" id="modal_cambiarprecios" tabindex="-1" role="dialog" aria-labelledby="modalexcel" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">ACTUALIZAR PRECIOS</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-content" style="font-family: Arial">

                <?php // echo form_open_multipart('producto_precios/cambiarprecios'); ?>
                
                    <div class="box-body">
                        
                        <div class="col-md-3">
                                <label for="moneda_tc" class="control-label">T.C. Actual</label>
                                <div class="form-group">
                                    <input type="number" id="moneda_tc" value="<?php echo number_format($moneda['moneda_tc'],2,".",","); ?>" class="form-control" id="moneda_tc" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"autocomplete="off" disabled="false"/>
                                        <span class="text-danger"><?php echo form_error('moneda_tc');?></span>
                                </div>
                        </div>
                        <div class="col-md-3">
                                <label for="moneda_tc_nuevo" class="control-label">T.C. Nuevo</label>
                                <div class="form-group">
                                        <input type="number" id="moneda_tc_nuevo" value="<?php echo number_format($moneda['moneda_tc'],2,".",","); ?>" class="form-control" id="moneda_tc_nuevo" required onkeyup="calcular_razon();" />
                                        <span class="text-danger"><?php echo form_error('moneda_tc_nuevo');?></span>
                                </div>
                        </div>
                        
                        <div class="col-md-4">
                                <label for="moneda_razon" class="control-label">Razón de Conversión </label>
                                <div class="form-group">
                                    <input type="text" name="moneda_razon" value="0.00" class="form-control" id="moneda_razon" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" disabled="true"/>
                                        <!--<span class="text-danger"><?php echo form_error('moneda_razon');?></span>-->
                                </div>
                        </div>
                        
                        <div class="col-md-4">
                                <label for="moneda_tc_nuevo" class="control-label">Operacion</label>
                                <div class="form-group">
                                    <select class="form-group form-control" id="operacion">
                                        <option value="0">- OPERACION -</option>
                                        <option value="1">ACTUALIZACION DE VALOR</option>
                                        <option value="2">MODIFICAR EL PRECIO</option>
                                        <option value="3">INCREMENTAR AL PRECIO</option>
                                    </select>
                                </div>
                        </div>
                        
                        <div class="col-md-4">
                                <label for="moneda_tc_nuevo" class="control-label">Afectar</label>
                                <div class="form-group">
                                    <select class="form-group form-control" id="afectar">
                                        <option value="0">- NINGUNO -</option>
                                        <option value="1">AL PRECIO DE VENTA</option>
                                        <option value="2">AL PRECIO VENTA Y FACTORES</option>
                                        <option value="3">SOLO FACTORES LOS FACTORES</option>                                       
                                    </select>
                                </div>
                        </div>
                        
                        <div class="col-md-4">
                                <label for="moneda_tc_nuevo" class="control-label">Redondear</label>
                                <div class="form-group">
                                    <select class="form-group form-control" id="redondear">
                                        <option value="0">- NO REDONDEAR -</option>
                                        <option value="1">CONVERTIR LOS DECIMALES EN 0.50 CTVS</option>
                                        <option value="2">REDONDEAR AL SUPERIOR</option>
                                        <option value="3">REDONDEAR AL INFERIOR</option>
                                        <option value="4">TRUNCAR (SIN DECIMALES, SOLO ENTEROS)</option>
                                    </select>
                                </div>
                        </div>
                        
                    </div>

                        <div class="modal-footer" style="text-align: center">
                            <!--<button type="button" class="btn btn-success"  onclick="verificar_producto()" id="boton_proceder"><fa class="fa fa-chain"></fa> Actualizar</button>-->
                            <button type="button" class="btn btn-danger" id="boton_cerrar_ventatemporal" data-dismiss="modal""><fa class="fa fa-times"></fa> Cerrar</button>
                            <button type="submit"  class="btn btn-success"  value="Calcular Precios" onclick="actualizar_precios()"><fa class="fa fa-file-excel-o"></fa> Actualizar Precios</button>
                        </div>
                
                <?php // echo form_close(); ?>
            
            </div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL CAMBIAR ----------------------------------->
<!------------------------------------------------------------------------------->


<!-- Overlay de bloqueo -->
<div id="overlay" style="display: none;">
    <center>

        <div class="spinner"></div>
        <p>Cargando...</p>        
        <img src="<?php echo base_url("resources/images/success.gif"); ?>" width="120px" height="100px">

</div>

<style>
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        text-align: center;
        color: white;
        font-size: 20px;
        font-family: Arial, sans-serif;
    }
    
    #overlay .spinner {
        margin-top: 20%;
        border: 8px solid #f3f3f3;
        border-radius: 50%;
        border-top: 8px solid #3498db;
        width: 60px;
        height: 60px;
        animation: spin 2s linear infinite;
        text-align: center;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>