<script src="<?php echo base_url('resources/js/factura_compra.js'); ?>" type="text/javascript"></script>
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
<style type="text/css">
    /*input[type="number"] {
        width: 75px;
    }*/

</style>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="elresultado">

<div class="col-md-12 no-print">
    <div class="box-header">
        <font size='4' face='Arial'><b>Libro de Compras</b></font>
        <br><font size='2' face='Arial' id="pillados"></font>
        <div class="box-tools">
            <a href="<?php echo site_url('factura_compra/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 no-print">
            <label for="filtrar" class="control-label">&nbsp;</label>
            <!--------------------- parametro de buscador --------------------->
            <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input name="filtrar" id="filtrar" type="text" class="form-control" placeholder="Ingrese Nit, Factura, Cod. Control.." onkeypress="buscarcompra(event)" autocomplete="off">
            </div>
            <!--------------------- fin parametro de buscador --------------------->
        </div>
        <div class="col-md-2">
            <label for="fecha_desde" class="control-label">Desde:</label>
            <div class="form-group">
                 <input type="date"class="btn btn-warning btn-xs form-control"  id="fecha_desde" name="fecha_desde" value="<?php echo date("Y-m-d");?>">

            </div>
        </div>
        <div class="col-md-2">
            <label for="fecha_hasta" class="control-label">Hasta:</label>
            <div class="form-group">
                <input type="date" class="btn btn-warning btn-xs form-control"  id="fecha_hasta" name="fecha_hasta" value="<?php echo date("Y-m-d");?>">
            </div>
        </div>
        <div class="col-md-2">
           <label for="desde" class="control-label">&nbsp;</label>
           <div class="form-group">
               <button  type="submit" class="btn btn-danger btn-xs form-control" onclick="mostrar_facturas()"><span class="fa fa-binoculars"> </span> Ver</button>
            </div>
        </div>
        <div class="col-md-2">
           <label for="generar_excel" class="control-label">&nbsp;</label>
           <div class="form-group">
                <button onclick="generarexcel()" type="button" class="btn btn-facebook btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>
                <!--<button  type="submit" class="btn btn-facebook btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>-->
            </div>
        </div>
    </div>
 </div>
<div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>  
<div class="box-body table-responsive" id="tabla_factura" ></div>
