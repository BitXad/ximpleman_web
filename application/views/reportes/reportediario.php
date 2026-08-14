<script src="<?php echo base_url('resources/js/reporte_movimiento.js'); ?>" type="text/javascript"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<script type="text/javascript">
    function imprimirdetalle(){
        var f = new Date();
        $('#fechaimpresion').html(moment(f).format("DD/MM/YYYY HH:mm:ss"));
        window.print();
    }
</script>

<?php 
    $padding = "style='padding:0; '"; 
    $logo = base_url("resources/images/empresas/").$empresa[0]['empresa_imagen'];
    $logo_thumb = base_url("resources/images/empresa/")."thumb_".$empresa[0]['empresa_imagen'];

    $tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
    $ancho = "18";  //$parametro["parametro_anchofactura"];
    $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
    
    $fecha_desde = date('Y-m-d');
    $hora_desde = '00:00';
    $fecha_hasta = date('Y-m-d');
    $hora_hasta = '23:59';
?>

<style type="text/css">
    @media print {
        #fondoprint {
            background-color: #aaaaaa !important;
            -webkit-print-color-adjust: exact; /*economy | exact*/
            color-adjust: exact;
        }
    }
    table th{ font-size: 10px !important; padding: 0; }
    table td{ font-size: 9px !important; padding: 0; }

    #parafirmas{
        display: flex;
        max-width: 100%;
        font-family: "Arial", Arial Narrow;
        text-align: center;
    }
    #firmaizquierda{ width: 50%; }
    #firmaderecha{ width: 50%; }
</style>

<input type="hidden" value="<?php echo $tipousuario_id; ?>" id="tipousuario_id" name="tipousuario_id" />
<input type="hidden" value="<?php echo $parametro['moneda_descripcion']; ?>" id="nombre_moneda" name="nombre_moneda" />

<table class="table table-responsive">
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>"></td>
<td style="width: <?php echo $ancho;?>cm; padding: 0;">

<div class="box-header no-print">
    <div class="text-center">
        <h3 class="box-title"><b>REPORTE GENERAL DE MOVIMIENTO DIARIO</b><br>(Ingresos y Egresos)</h3><br><br>
    </div>

    <div class="container">  
        <div class="box-tools" style="font-family: Arial;">
            <div class=" col-md-11">

                <div class="col-md-2">
                    Usuario:
                    <?php if($tipousuario_id == 1 || $tienepermiso == 1){ ?>
                    <select  class="btn btn-primary btn-sm form-control" id="buscarusuario_id" required>
                        <option value="0"> TODOS </option>
                        <?php foreach($all_usuario as $usuario){?>
                        <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                        <?php } ?>
                    </select>
                    <?php }else{ ?>
                    <select  class="btn btn-primary btn-sm form-control" id="buscarusuario_id" required>
                        <?php
                        $ischequed = "";
                        foreach($all_usuario as $usuario){
                            if($usuario_id == $usuario['usuario_id']){
                                $ischequed = "selected";
                        ?>
                        <option <?php echo $ischequed; ?> value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                        <?php }    
                            } ?>
                    </select>
                    <?php } ?>
                </div>

                <div class="col-md-2">
                    Fecha: 
                    <input type="date" value="<?php echo $fecha_desde; ?>" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
                </div>
                <div class="col-md-2">
                    Hora:
                    <input type="time" value="<?php echo $hora_desde; ?>" class="btn btn-primary btn-sm form-control" id="hora_desde" name="hora_desde" required="true">
                </div>
                <div class="col-md-2">
                    Fecha: 
                    <input type="date" value="<?php echo $fecha_hasta; ?>" class="btn btn-primary btn-sm form-control datepicker" id="fecha_hasta" name="fecha_hasta" required="true">
                </div>
                <div class="col-md-2">
                    Hora: 
                    <input type="time" value="<?php echo $hora_hasta; ?>" class="btn btn-primary btn-sm form-control datepicker" id="hora_hasta" name="hora_hasta" required="true">
                </div>

                <div class="col-md-2">
                    <br>
                    <button class="btn btn-sm btn-warning btn-sm btn-block"  type="submit" onclick="buscar_por_fecha()" style="height: 34px;" id="boton_buscar">
                        <span class="fa fa-search"></span> Buscar
                    </button>
                    <br>
                </div>

                <div class="col-md-3">
                    <br>
                    <a id="imprimirestedetalle" class="btn btn-sq-lg btn-success" onclick="imprimirdetalle()">
                        <span class="fa fa-print"></span> Imprimir
                    </a>

                    <!-- NUEVO: Botón Exportar a Excel -->
                    <button id="btnExportExcel" class="btn btn-sq-lg btn-primary" type="button" onclick="exportarExcel()">
                        <span class="fa fa-file-excel-o"></span> Exportar a Excel
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>

<div class="row">
    <div class="col-md-12">
        <div>
            <!-- ********************************INICIO Cabecera******************************* -->
            <div class="row micontenedorep table-responsive" id="cabeceraprint">
                <table style="width: <?php echo $ancho; ?>cm; font-family: Arial;" class="table table-responsive">
                    <tr>
                        <td width="300" style="line-height: 10px;">
                            <center>                        
                                <img src="<?php echo $logo; ?>" width="80" height="60"><br>
                                <font size="1" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                                <?php if(isset($empresa[0]['empresa_slogan'])){ ?>
                                    <font size="0.5" face="Arial"><b><?php echo $empresa[0]['empresa_slogan']; ?></b></font><br>
                                <?php } ?>
                                <font size="0.5" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                                <font size="0.5" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                            </center>           
                        </td>
                        <td width="400" style="line-height: 14px;">
                            <center>
                                <font size="3" face="arial"><b>REPORTE DE MOVIMIENTO DIARIO</b></font> <br>
                                <label id="fechaimpresion"></label><br>
                                <label id="tituloimpresion"></label>
                            </center>
                        </td>
                        <td width="300" style="text-align: center;">
                            -----------------------------<br>
                            <span style="font-size: 10px; font-family: Arial" id="fecha1impresion"></span>
                            <span style="font-size: 10px; font-family: Arial" id="fecha2impresion"></span><br>
                            -----------------------------
                        </td>
                    </tr>
                </table>       
            </div>

            <div class="box-body" id="cabizquierdafechas">
                <span style="font-size: 10px; font-family: Arial" id="elusuario"></span><br>
            </div>

            <div class="table table-responsive">
                <!-- IMPORTANTE: esta tabla es la que se exportará a Excel -->
                <table class='table table-striped table-condensed table-responsive' id='mitabladetimpresion' style='width:<?php echo $ancho; ?>cm;'>
                    <tr style='background-color: #aaaaaa;' class='fondoprint'>
                        <th id='fondoprint' class='fondoprint' style='width: 2%'  class='text-center'>N°</th>
                        <th id='fondoprint' style='width: 20%' class='text-center'>FECHA</th>
                        <th id='fondoprint' style='width: 8%'  class='text-center'>REC.</th>
                        <th id='fondoprint' style='width: 8%'  class='text-center'>FACT.</th>
                        <th id='fondoprint' style='width: 48%' class='text-center'>
                            DETALLE 
                            <input type='button' value='[-]' onclick='mostrar_detalle();' id='boton_detalle' class='btn btn-xs' style="padding:0;"/>
                        </th>
                        <th id='fondoprint' style='width: 10%' class='text-center'>BANCO</th>
                        <th id='fondoprint' style='width: 10%' class='text-center'>INGRESO</th>
                        <th id='fondoprint' style='width: 10%' class='text-center'>EGRESO</th>
                        <th id='fondoprint' style='width: 10%' class='text-center'>TRANS.</th>
                        <th id='fondoprint' style='width: 10%' class='text-center'>EGRS.</th>
                        <th id='fondoprint' style='width: 10%' class='text-center'>UTILD</th>
                    </tr>
                    <tbody id='tablatotalresultados'></tbody>

                    <tr>
                        <td style="text-align: center;" colspan="3">
                            <br><br>
                            ________________________<br>ENTREGADO POR
                        </td> 
                        <td style="text-align: center;" colspan="2">
                            <br><br>
                            ________________________<br>REVISADO POR
                        </td>
                        <td style="text-align: right;" colspan="5">
                            <p class="subtitulo">EFECTIVO EN CAJA <?php echo $parametro['moneda_descripcion']; ?> :.......................</p>
                            <p class="subtitulo">UTILIDAD BRUTA <?php echo $parametro['moneda_descripcion']; ?> :.......................</p>
                            <p class="subtitulo">GASTOS OPERAT. <?php echo $parametro['moneda_descripcion']; ?> :.......................</p>
                            <p class="subtitulo">UTILIDAD NETA <?php echo $parametro['moneda_descripcion']; ?> :.......................</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div> <!-- /wrap -->
    </div>
</div>

</td>
</tr>
</table>

<input type="text" id="saldo_caja" hidden>

<script type="text/javascript">
    $(document).ready(function(){
        var resdebito   = $('#parasum2').val();
        var rescredito  = $('#parasum3').val();
        var resbancaria = $('#parasum4').val();
        var rescheque   = $('#parasum5').val();
        $('#sumtotalventas').val(resdebito+rescredito+resbancaria+rescheque);
    });
</script>

<!-- ====================== NUEVO: SheetJS para exportar la tabla a Excel ===================== -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script type="text/javascript">
    function exportarExcel(){
        try{
            var tabla = document.getElementById('mitabladetimpresion');
            if(!tabla){
                alert('No se encontró la tabla del reporte.');
                return;
            }

            // Crear el libro y la hoja desde la tabla actual renderizada
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.table_to_sheet(tabla, { raw: true });

            // Opcional: ajustar el ancho de columnas (simple heurística)
            // Puedes comentar esta parte si no la necesitas
            var rango = XLSX.utils.decode_range(ws['!ref']);
            var widths = [];
            for (var C = rango.s.c; C <= rango.e.c; ++C) {
                widths.push({wch: 18});
            }
            ws['!cols'] = widths;

            XLSX.utils.book_append_sheet(wb, ws, 'Movimiento');

            // Construir nombre de archivo con rango fecha/hora
            var fd = ($('#fecha_desde').val() || '').replaceAll('-', '');
            var hd = ($('#hora_desde').val() || '').replaceAll(':', '');
            var fh = ($('#fecha_hasta').val() || '').replaceAll('-', '');
            var hh = ($('#hora_hasta').val() || '').replaceAll(':', '');
            var nombre = 'Movimiento_' + (fd||'') + (hd?('_'+hd):'') + '_a_' + (fh||'') + (hh?('_'+hh):'') + '.xlsx';

            XLSX.writeFile(wb, nombre || 'Movimiento.xlsx');
        }catch(err){
            console.error(err);
            alert('No se pudo exportar a Excel.');
        }
    }
</script>
