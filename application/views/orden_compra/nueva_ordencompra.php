<script src="<?php echo base_url('resources/js/nueva_ordencompra.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
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
    $(document).ready(function(){
        (function ($) {
            $('#buscarproducto').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar_producto tr').hide();
                $('.buscar_producto tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
</script>
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<div class="row no-print">
    <div class="col-md-5">
        <div class="box-header" style="padding-left: 0px">
            <font size='4' face='Arial'><b>Nueva Orden de Compra</b></font>
            <!--<br><font size='2' face='Arial'><b>Proveedor: </b><span id="elproveedor"></span></font>-->
            <!--<br><font size='2' face='Arial'>Registros Encontrados: <span id="encontrados">0</span></font>--> 
        </div>
        <div class="input-group">
            <span class="input-group-addon"> Buscar </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código, código de barras, marca, industria.." autocomplete="off">
            <!--<div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultadosproducto(2)" title="Buscar"><span class="fa fa-search"></span></div>-->
            <!--<div style="border-color: #d58512; background: #e08e0b !important; color: white" class="btn btn-warning input-group-addon" onclick="tablaresultadosproducto(3)" title="Mostrar todos los productos"><span class="fa fa-globe"></span></div>-->
        </div>
    </div>
    <div class="col-md-3">
        <div class="box-tools">
            &nbsp;
            <select name="proveedor_id" class="btn-primary btn-sm btn-block" id="proveedor_id">
                <option value="0" selected >-- ELEGIR PROVEEDOR --</option>
                <?php 
                foreach($all_proveedores as $proveedor)
                {
                    echo '<option value="'.$proveedor['proveedor_id'].'">'.$proveedor['proveedor_nombre'].'</option>';
                } 
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-4 text-right">
        <div class="box-tools" style="display: flex">
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" onclick="modal_buscarproducto()" class="btn btn-success btn-foursquarexs" title="Añadir nuevo Producto"><font size="5"><span class="fa fa-cart-plus"></span></font><br><small>Añadir</small></a>
            <!--<a style="width: 75px; margin-right: 1px; margin-top: 1px" onclick="modalcatalogo()" class="btn btn-info btn-foursquarexs" title="Catalogo de Productos" ><font size="5"><span class="fa fa-search"></span></font><br><small>Catálogo</small></a>
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('producto/existenciaminima'); ?>" target="_blank" class="btn btn-soundcloud btn-foursquarexs" title="Productos con existencia mínima" ><font size="5"><span class="fa fa-eye"></span></font><br><small>Exist. Min.</small></a>
            <!--<a style="width: 75px; margin-right: 1px; margin-top: 1px" data-toggle="modal" data-target="#modalprecio" class="btn btn-soundcloud btn-foursquarexs" title="Codigo de Barras" ><font size="5"><span class="fa fa-barcode"></span></font><br><small>Cod. Barras</small></a>-->
        </div>
    </div>
    <div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
                    <thead role="rowgroup">
                        <tr role="row">
                            <th>#</th>
                            <th>PRODUCTO/ UNIDAD</th>
                            <th>CODIGO</th>
                            <th>ULTIMO<br>COSTO</th>
                            <th>PRECIO<br>VENTA</th>
                            <th>EXISTENCIA</th>
                            <th>CANTIDAD</th>
                            <th>TOTAL</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tabla_ultimopedido" role="rowgroup">                           
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <a class="btn btn-success" onclick="registrar_ordencompra()">
            <i class="fa fa-check"></i> Registrar
        </a>
        <a class="btn btn-danger" onclick="cancelar_ordencompra()">
            <i class="fa fa-times"></i> Cancelar
        </a>
    </div>
</div>

<!------------------------ INICIO modal para buscar producto ------------------->
<div class="modal fade" id="modal_buscarproducto" tabindex="-1" role="dialog" aria-labelledby="modal_buscarproductolabel">
    <div class="modal-dialog modal-lg" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Buscar Producto</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Buscar </span>           
                        <input type="text" id="buscarproducto" name="buscarproducto" class="form-control" placeholder="Ingrese el nombre, código, marca, industria.." onkeypress="iniciar_busqueda(event)" autofocus autocomplete="off">
                        <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tabla_productos()"><span class="fa fa-search"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <span class='text-bold'>Encontrados: </span><span id="productos_encontrados">0</span>
                
                <!------------------------------------------------------------------->
                <div class="box-body table-responsive">
                    <table class="table table-striped" id="mitabla">
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Codigo</th>
                            <th>P. Costo</th>
                            <th>P. Venta</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        <tbody class="buscar_producto" id="tablaresultados_productos" >
                        </tbody>
                    </table>
                </div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para buscar producto ------------------->

