<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
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
    <font size='4' face='Arial'><b>C&oacute;digos de Productos y Servicios</b></font>
    <div class="box-tools no-print">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
            <!--<div style="border-color: #be2626; background: #be2626 !important; color: white" class="btn btn-danger input-group-addon" onclick="cliente_nuevo()" title="Cliente nuevo"><span class="fa fa-user-plus" aria-hidden="true" id="span_cliente_nuevo"></span> Buscar</div>-->
            <div style="border-color: #00a65a; background: #00a65a !important; color: white" class="btn btn-success input-group-addon" onclick="generarexcel()" title="Exportar lista de productos ho"><span class="fa fa-file-excel-o" aria-hidden="true" id="span_cliente_nuevo"></span> Excel</div>
        </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CODIGO ACTIVIDAD</th>
                            <th>CODIGO PRODUCTO</th>
                            <th>DESCRIPCION PRODUCTO</th>
                            <th>NANDINA</th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php 
                        $i=1;
                        foreach ($datos as $sincronizacion) {?>
                            <tr>
                                <td><?= $i ?></td>
                                <td style="text-align: center;"><?php 
                                        echo $sincronizacion['prodserv_codigoactividad'];
                                        
                                        echo $sincronizacion['prodserv_codigoactividad']." = ".$dosificacion["dosificacion_actividad"];
                                        
                                        if($sincronizacion['prodserv_codigoactividad']==$dosificacion["dosificacion_actividad"])
                                                    echo "<small style='color:red;'><br>PRINCIPAL<small>";
                                        else
                                                    echo "<small style='color:blue;'><br>SECUNDARIA<small>";
                                        
                                    ?>                                
                                </td>
                                <td style="text-align: center;"><?= $sincronizacion['prodserv_codigoproducto']; ?></td>
                                <td><?= $sincronizacion['prodserv_descripcion'] ?></td>
                                <td><?= $sincronizacion['prodserv_nandina'] ?></td>
                                <td><button class="btn btn-info btn-xs" onclick="cargar_datos(<?= $sincronizacion['prodserv_codigoactividad'] ?>,<?= $sincronizacion['prodserv_codigoproducto'] ?>)"><fa class="fa fa-bomb"> </fa> Homologar</button></td>
                            </tr>
                        <?php
                            $i++; 
                        }
                    ?>
                    </tbody>
                </table>                                
            </div>
            <a href="<?= site_url('sincronizacion/') ?>" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>


<div>
    <button type="button" id="boton_modalhomologacion" class="btn btn-primary" data-toggle="modal" data-target="#modalpaquetes" >
      ENVIO PAQUETES
    </button>
    
</div>

<div class="modal fade" id="modalpaquetes" tabindex="-1" role="dialog" aria-labelledby="modalpaquetes" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">HOMOLOGACIÓN DE PRODUCTOS</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="row" id='loader2'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    <label for="codigo_evento" class="control-label"><span class="text-danger">*</span>Código Evento</label>
<!--                    <div class="form-group">
                        <input type="text" name="codigo_evento" class="form-control" id="codigo_evento" />
                    </div>
-->                    
                    <select name="categoria_id" class="form-control" id="categoria_id">
                        <option value="00">- SELECCIONAR CATEGORIA -</option>
                        <option value="0">- APLICAR A TODAS LAS CATEGORIAS -</option>
                        <?php 
                            foreach($categorias as $categoria){ ?>
                                <option value="<?php echo $categoria['categoria_id']; ?>">    
                                    <?php echo $categoria['categoria_nombre']; ?>
                                </option>
                        <?php    } ?>
                            
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Codigo Actividad</label>
                    <div class="form-group">
                        <input type="text" name="codigo_actividad" value="00" class="form-control" id="codigo_actividad" readonly/>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Codigo Producto</label>
                    <div class="form-group">
                        <input type="text" name="codigo_producto" value="00" class="form-control" id="codigo_producto" readonly/>
                    </div>
                </div>
                
                    <div class="col-md-4">
                        <label for="producto_unidad" class="control-label">* Unidad</label>
                        <div class="form-group">
                            <select name="producto_unidad" id="producto_unidad" class="form-control">
                                <option value="">- UNIDAD -</option>
                                <?php 
                                foreach($unidades as $unidad)
                                {
                                    //$selected = ($unidad['unidad_id'] == $producto['producto_unidad']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$unidad['unidad_id'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
<!--                <div class="col-md-4">
                    <label for="cant_fact" class="control-label"><span class="text-danger">*</span>Cantidad Facturas</label>
                    <div class="form-group">
                        <input type="number" name="cant_fact" value="1" class="form-control" id="cant_fact" />
                    </div>
                </div>-->
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="homologar_categoria()"><fa class="fa fa-floppy-o"></fa> Actualizar Codigo</button>
                <button type="button" class="btn btn-danger" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>
                
<!--<button type="button" class="btn btn-success" onclick="finalizarventa_sin()"><fa class="fa fa-floppy-o"></fa> Envio de Paquetes</button>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


<script type="text/javascript">
function generarexcel() {
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + 'inventario/generar_excel_homologados';

    $.ajax({
        url: controlador,
        type: "POST",
        data: {},
        success: function(result) {
            var productos = JSON.parse(result);

            var workbook = new ExcelJS.Workbook();
            var worksheet = workbook.addWorksheet("Productos");

            // Crear 3 filas manualmente
            worksheet.getCell('A1').value = 'PRODUCTOS HOMOLOGADOS';
            worksheet.getCell('A2').value = 'LISTA COMPLETA DE PRODUCTOS';

            // Unir celdas A1:I1 y A2:I2
            worksheet.mergeCells('A1:I1');
            worksheet.mergeCells('A2:I2');

            // Estilo para A1
            worksheet.getCell('A1').alignment = { horizontal: 'center', vertical: 'middle' };
            worksheet.getCell('A1').font = { name: 'Arial', size: 14, bold: true };

            // Estilo para A2
            worksheet.getCell('A2').alignment = { horizontal: 'center', vertical: 'middle' };
            worksheet.getCell('A2').font = { name: 'Arial', size: 12, bold: true, italic: true };

            // Fila 3 vacía (solo para dejar espacio visual)
            worksheet.addRow([]);

            // Cabecera (fila 4 visible, pero es la fila 4 en Excel)
            const headers = [
                "N°", "DESCRIPCIÓN", "UNIDAD", "CÓDIGO", "CÓDIGO SIN",
                "DESCRIPCIÓN", "CÓDIGO ACTIVIDAD", "ACTIVIDAD", "TIPO"
            ];
            worksheet.addRow(headers);

            // Definir el ancho de las columnas
            worksheet.columns = [
                { width: 5 },
                { width: 30 },
                { width: 10 },
                { width: 15 },
                { width: 15 },
                { width: 30 },
                { width: 20 },
                { width: 25 },
                { width: 15 }
            ];

            // Agregar los datos (desde la fila 5)
            productos.forEach((prod, i) => {
                worksheet.addRow([
                    i + 1,
                    prod.producto_nombre,
                    prod.producto_unidad,
                    prod.producto_codigo,
                    prod.producto_codigosin,
                    prod.prodserv_descripcion,
                    prod.prodserv_codigoactividad,
                    prod.actividad_descripcion,
                    prod.actividad_tipoactividad
                ]);
            });

            // Estilos y bordes
            worksheet.eachRow({ includeEmpty: false }, function (row, rowNumber) {
                row.eachCell({ includeEmpty: true }, function (cell, colNumber) {
                    // Bordes
                    cell.border = {
                        top: { style: 'thin' },
                        left: { style: 'thin' },
                        bottom: { style: 'thin' },
                        right: { style: 'thin' },
                    };

                    // Fuente por defecto
                    cell.font = {
                        name: 'Arial',
                        size: 8,
                        bold: false
                    };
                    // Aplicar estilo general solo si NO es fila 1 ni 2 ni 4
                    if (rowNumber == 1) {
                        cell.font = {
                            name: 'Arial',
                            size: 14,
                            bold: true,
                        };
                    }
                    if (rowNumber == 2) {
                        cell.font = {
                            name: 'Arial',
                            size: 10,
                            bold: true,
                            //italic: true,
                        };
                    }
                    // Estilo especial para la fila 4 (cabecera)
                    if (rowNumber === 4) {
                        cell.font = {
                            name: 'Arial',
                            size: 9,
                            bold: true,
                            color: { argb: 'FFFFFFFF' }
                        };
                        cell.alignment = {
                            horizontal: 'center',
                            vertical: 'middle'
                        };
                        cell.fill = {
                            type: 'pattern',
                            pattern: 'solid',
                            fgColor: { argb: 'FF000000' } // fondo negro
                        };
                    }
                });
            });

            // Descargar archivo
            workbook.xlsx.writeBuffer().then(function (data) {
                var reportitle = moment(Date.now()).format("DD-MM-YYYY_H_m_s");
                var blob = new Blob([data], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                });
                saveAs(blob, "productoshomologados_" + reportitle + ".xlsx");
            });
        }
    });
}

    
</script>