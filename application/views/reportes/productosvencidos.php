<script src="<?php echo base_url('resources/js/reporte_productovencido.js'); ?>" type="text/javascript"></script>
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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">

<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="hidden" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales">
<!--<input type="text" value="" id="parametro" hidden>
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php /*echo $parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="mostrarmoneda" id="mostrarmoneda" value="<?php echo $parametro[0]['parametro_mostrarmoneda'];*/ ?>" />-->

<div class="cuerpo">
    <div class="columna_derecha">
        <center> 
        <img src="<?php echo base_url('resources/images/empresas/'.$empresa[0]["empresa_imagen"].''); ?>"  style="width:80px;height:80px">
    </center>
    </div>
    <div class="columna_izquierda">
        <center> 
            <font size="4"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
            <?php echo $empresa[0]['empresa_zona']; ?><br>
            <?php echo $empresa[0]['empresa_direccion']; ?><br>
            <?php echo $empresa[0]['empresa_telefono']; ?>
        </center>
    </div>
    <div class="columna_central">
        <center>
            <h3 class="box-title"><u>REPORTE DE PRODUCTOS<br>CON FECHAS DE VENCIMIENTO</u></h3>
            <?php echo date('d/m/Y H:i:s'); ?><br>
            <!--<b>VENTAS REALIZADAS</b>-->
        </center>
    </div>
</div>
<!--<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='display:block;'>-->
    
    <div class="col-md-4 no-print">
        &nbsp;
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre del producto" onkeypress="buscar_producto(event)" autocomplete="off">
        </div>
    </div>
    <div class="col-md-2 no-print">
        &nbsp;
        <a class="btn btn-info form-control" onclick="productos_fvencimiento()" title='Actualizar productos con fechas de vencimiento'><fa class="fa fa-file-text-o"></fa> Actualizar Venc.</a>
    </div>
    <div class="col-md-2 no-print">
        &nbsp;
        <select class="btn btn-facebook btn-sm form-control" id="tipo_filtro" name="tipo_filtro">
            <option value="1"> TODOS VENCIDOS </option>
            <option value="2"> TODOS VIGENTES </option>
            <option value="3"> VENCIDOS AL </option>
            <option value="4"> VIGENTES AL </option>
            <option value="5"> TODOS </option>
        </select>
    </div>
    <div class="col-md-2 no-print">
        Fecha:
        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="btn btn-warning btn-sm form-control" value="<?php echo date("Y-m-d"); ?>">
    </div>
    <div class="col-md-2 no-print">
        &nbsp;
        <a class="btn btn-success  form-control" onclick="tabla_fvencimiento()"><fa class="fa fa-binoculars"></fa> Mostrar</a>
    </div>
<!--</div>-->

<div class="row col-md-12 no-print" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
<!------------------------------------------------------------------------------------------->

<div class="panel panel-primary col-md-12">
    <div class="box">
        <!--<div class="col-md-3">-->
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th style="padding:0;">#</th>
                        <th style="padding:0;">Producto</th>
                        <th style="padding:0;">Cantidad</th>
                        <th style="padding:0;">Fecha Vencimiento</th>
                        <th style="padding:0;">Compra</th>
                        <th style="padding:0;">Proveedor</th>
                        <th style="padding:0;" class="no-print"></th>
                    </tr>
                    <tbody class="buscar" id="tabla_productos"></tbody>
                </table>
            </div>
        <!--</div>-->
    </div>
</div>