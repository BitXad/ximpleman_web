<script src="<?php echo base_url('resources/js/orden_compra.js'); ?>" type="text/javascript"></script>
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
    /*td img{
        width: 50px;
        height: 50px;
        margin-right: 5px; 
    }*/
    #contieneimg{
        width: 50px;
        height: 50px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masgrande{
        font-size: 12px;
    }
</style>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<input type="text" value='<?php echo json_encode($empresa); ?>' id="datos_empresa" hidden>

<!--<div class="row micontenedorep" style="display: none" id="cabeceraprint" >
    <table class="table" style="width: 100%; padding: 0;" >
        <tr>
            <td style="width: 25%; padding: 0; line-height:10px; text-align: center" >
                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
            </td>
            <td style="width: 35%; padding: 0" > 
                <center>
                    <br><br>
                    <font size="3" face="arial"><b><span id="titcatalogo"></span>PRODUCTOS</b></font> <br>
                    <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>
                </center>
            </td>
            <td style="width: 20%; padding: 0" >
                <center></center>
            </td>
        </tr>
    </table>
</div>-->
<!--<br>-->
<div class="box-header" style="padding-left: 0px">
    <font size='4' face='Arial'><b>Ordenes de Compra</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <span id="encontrados">0</span></font>
</div>
<div class="row no-print">
    <div class="col-md-5">
        <div class="input-group">
            <span class="input-group-addon"> Buscar </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el num. compra, proveedor.." onkeypress="buscar_ordencompra(event)" autocomplete="off">
            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultadosordencompra(2)" title="Buscar"><span class="fa fa-search"></span></div>
            <div style="border-color: #d58512; background: #e08e0b !important; color: white" class="btn btn-warning input-group-addon" onclick="tablaresultadosordencompra(3)" title="Mostrar todas las ordenes de pedido"><span class="fa fa-globe"></span></div>
        </div>
    </div>
    <!--<div class="col-md-3">
        <div class="box-tools">
            <select name="proveedor_id" class="btn-primary btn-sm btn-block" id="proveedor_id" onchange="tablaresultadosproducto(2)">
                <option value="" disabled selected >-- BUSCAR POR PROVEEDOR --</option>
                <option value="0"> Todos Los Proveedorres </option>
                <?php 
                foreach($all_proveedor as $proveedor)
                {
                    echo '<option value="'.$proveedor['proveedor_id'].'">'.$proveedor['proveedor_nombre'].'</option>';
                } 
                ?>
            </select>
        </div>
        <div class="box-tools">
            <select name="usuario_id" class="btn-primary btn-sm btn-block" id="usuario_id" onchange="tablaresultadosproducto(2)">
                <option value="" disabled selected >-- BUSCAR POR RESPONSABLE --</option>
                <option value="0"> Todos Los Responsables </option>
                <?php 
                foreach($all_usuario as $usuario)
                {
                    echo '<option value="'.$usuario['usuario_id'].'">'.$usuario['usuario_nombre'].'</option>';
                } 
                ?>
            </select>
        </div>
        <div class="box-tools">
            <select name="estado_id" class="btn-primary btn-sm btn-block" id="estado_id" onchange="tablaresultadosproducto(2)">
                <option value="" disabled selected >-- BUSCAR POR ESTADOS --</option>
                <option value="0">Todos Los Estados</option>
                <?php 
                foreach($all_estado as $estado)
                {
                    echo '<option value="'.$estado['estado_id'].'">'.$estado['estado_descripcion'].'</option>';
                } 
                ?>
            </select>
        </div>
    </div>-->
    <div class="col-md-4 text-right">
        <div class="box-tools" style="display: flex">
            <a style=" margin-right: 1px; margin-top: 1px" href="<?php echo site_url('orden_compra/nueva_ordencompra'); ?>" class="btn btn-success btn-foursquarexs" title="Añadir nueva orden de compra"><span class="fa fa-cart-plus"></span><small> Nueva Orden de Compra</small></a>
            <!--<a style="width: 75px; margin-right: 1px; margin-top: 1px" onclick="modalcatalogo()" class="btn btn-info btn-foursquarexs" title="Catalogo de Productos" ><font size="5"><span class="fa fa-search"></span></font><br><small>Catálogo</small></a>
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('producto/existenciaminima'); ?>" target="_blank" class="btn btn-soundcloud btn-foursquarexs" title="Productos con existencia mínima" ><font size="5"><span class="fa fa-eye"></span></font><br><small>Exist. Min.</small></a>
            <!--<a style="width: 75px; margin-right: 1px; margin-top: 1px" data-toggle="modal" data-target="#modalprecio" class="btn btn-soundcloud btn-foursquarexs" title="Codigo de Barras" ><font size="5"><span class="fa fa-barcode"></span></font><br><small>Cod. Barras</small></a>-->
        </div>
    </div>
    
    
    <!--<div class="col-md-4">
        <div class="box-tools" style="display: flex">
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('producto/add'); ?>" class="btn btn-success btn-foursquarexs" title="Registrar nuevo Producto"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Registrar</small></a>
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" onclick="modalcatalogo()" class="btn btn-info btn-foursquarexs" title="Catalogo de Productos" ><font size="5"><span class="fa fa-search"></span></font><br><small>Catálogo</small></a>
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('producto/existenciaminima'); ?>" target="_blank" class="btn btn-soundcloud btn-foursquarexs" title="Productos con existencia mínima" ><font size="5"><span class="fa fa-eye"></span></font><br><small>Exist. Min.</small></a>
            <?php
            /*if($rol[106-1]['rolusuario_asignado'] == 1){ ?>
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" onclick="imprimir_producto()" class="btn btn-primary btn-foursquarexs"><font size="5" title="Imprimir Producto"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
            <?php
            }*/ ?>
        <?php
            /*if($rol[106-1]['rolusuario_asignado'] == 1){ ?>
            <table>
                <tr>
                    <td>
                        <label style="font: normal; font-size: 10px; margin: 0px">
                            <input class="btn" type="checkbox" name="listaprecios" id="listaprecios" title="Lista de Precios" onclick="modalprecio()" >
                            Precios
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label style="font: normal; font-size: 10px; margin: 0px">
                            <input class="btn" type="checkbox" name="listcodigobarras" id="listcodigobarras" title="Lista de Codigos de Barras" onclick="listacodbarras()" >
                            Cod. Barras
                        </label>
                    </td>
                </tr>
            </table>
            <?php }*/ ?>
        </div>
    </div>-->
    <!---------------- FIN BOTONES --------->
    <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
     <div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
    <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
</div>
    

<div class="row">
    <div class="col-md-12">
        
        <div class="box">
                 
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
               <!--<table role="table">-->
                    <thead>
                        <tr role="row">
                            <th >#</th>
                            <th>Responsable</th>
                            <th>Orden No.</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Proveedor</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados"></tbody>
                </table>
            </div>             
        </div>
    </div>
</div>
<?php
/*if($a == 1)
echo '<script type="text/javascript">
    alert("El Producto no puede ser ELIMINADO, \n porque tienen transacciones realizadas");
</script>';
*/
?>

<!------------------------ INICIO modal para confirmar ejecutar orden compra ------------------->
<div class="modal fade" id="modal_ejecutarordencompra" tabindex="-1" role="dialog" aria-labelledby="modal_ejecutarordencompralabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">EJECUTAR ORDEN DE COMPRA</span><br>
                <span class="text-bold">No. <span id="laordencompra_id"></span></span>
            </div>
            <div class="modal-body">
                <span>
                    Esta seguro de ejecutar esta orden de compra?
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="ejecutarordencompra()"><span class="fa fa-check"></span> Ejecutar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar ejecutar orden compra ------------------->
<!------------------------ INICIO modal para confirmar anunlar orden compra ------------------->
<div class="modal fade" id="modal_anularordencompra" tabindex="-1" role="dialog" aria-labelledby="modal_anularordencompralabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">ANULAR ORDEN DE COMPRA</span><br>
                <span class="text-bold">No. <span id="anularordencompra_id"></span></span>
            </div>
            <div class="modal-body">
                <span>
                    Esta seguro de anular esta orden de compra?
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="anularordencompra()"><span class="fa fa-minus-circle"></span> Anular</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anular orden compra ------------------->
