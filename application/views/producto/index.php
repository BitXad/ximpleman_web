<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_producto.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/JsBarcode.all.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php /*echo base_url('resources/plugins/datatables/dataTables.bootstrap.css'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap.min.css');*/ ?>">-->
  <!-- Ionicons -->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
  
<!-- jQuery 2.2.3 -->
<!--<script src="<?php //echo base_url('resources/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>-->
<!-- Bootstrap 3.3.6 -->

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
<input type="hidden" name="parametro_modulorestaurante" id="parametro_modulorestaurante" value="<?php echo $parametro['parametro_modulorestaurante']; ?>" />
<input type="hidden" name="formaimagen" id="formaimagen" value="<?php  echo $parametro['parametro_formaimagen']; ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php  echo $tipousuario_id; ?>" />
<input type="hidden" name="resproducto" id="resproducto" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="esesteproducto" id="esesteproducto" /> <!-- usado en el modal para numero de imgs. para codigo barra -->
<input type="hidden" name="esestecodigobarra" id="esestecodigobarra" /> <!-- usado en el modal para numero de imgs. para codigo barra -->
<input type="hidden" name="eselnombreproducto" id="eselnombreproducto" /> <!-- valor dado cuando mostramo el modal para codigo barra -->
<!--<input type="hidden" name="lapresentacion" id="lapresentacion" value='<?php /*echo json_encode($all_presentacion); ?>' />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($all_moneda); */ ?>' /> -->
<input type="hidden" name="conencabezado" id="conencabezado" value="1" />

<input type="text" value='<?php echo json_encode($empresa); ?>' id="datos_empresa" hidden>

<div class="row micontenedorep" style="display: none" id="cabeceraprint" >
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
</div>
<br>
<div class="row no-print">
    <div class="col-md-5">
        <div class="box-header" style="padding-left: 0px">
            <font size='4' face='Arial'><b>Productos</b></font>
            <br><font size='2' face='Arial' id="encontrados"></font> 
        </div>
        <div class="input-group">
            <span class="input-group-addon"> Buscar </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código, código de barras, marca, industria.." onkeypress="buscarproducto(event)" autocomplete="off">
            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultadosproducto(2)" title="Buscar"><span class="fa fa-search"></span></div>
            <div style="border-color: #d58512; background: #e08e0b !important; color: white" class="btn btn-warning input-group-addon" onclick="tablaresultadosproducto(3)" title="Mostrar todos los productos"><span class="fa fa-globe"></span></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box-tools">
            <select name="categoria_id" class="btn-primary btn-sm btn-block" id="categoria_id" onchange="mostrar_subcategoria(this.value); tablaresultadosproducto(2)">
                <option value="" disabled selected >-- BUSCAR POR CATEGORIAS --</option>
                <option value="0"> Todas Las Categorias </option>
                <?php 
                foreach($all_categoria as $categoria)
                {
                    echo '<option value="'.$categoria['categoria_id'].'">'.$categoria['categoria_nombre'].'</option>';
                } 
                ?>
            </select>
        </div>
        <div class="box-tools">
            <select name="subcategoria_id" class="btn-primary btn-sm btn-block" id="subcategoria_id">
                <option value="" disabled selected >-- BUSCAR SUB CATEGORIA --</option>
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
    </div>
    
    <div class="col-md-4">
        <div class="box-tools" style="display: flex">
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('producto/add'); ?>" class="btn btn-success btn-foursquarexs" title="Registrar nuevo Producto"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Registrar</small></a>
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" onclick="modalcatalogo()" class="btn btn-info btn-foursquarexs" title="Catalogo de Productos" ><font size="5"><span class="fa fa-search"></span></font><br><small>Catálogo</small></a>
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('producto/existenciaminima'); ?>" target="_blank" class="btn btn-soundcloud btn-foursquarexs" title="Productos con existencia mínima" ><font size="5"><span class="fa fa-eye"></span></font><br><small>Exist. Min.</small></a>
            <!--<a style="width: 75px; margin-right: 1px; margin-top: 1px" data-toggle="modal" data-target="#modalprecio" class="btn btn-soundcloud btn-foursquarexs" title="Codigo de Barras" ><font size="5"><span class="fa fa-barcode"></span></font><br><small>Cod. Barras</small></a>-->
            <?php
            if($rol[106-1]['rolusuario_asignado'] == 1){ ?>
            <a style="width: 75px; margin-right: 1px; margin-top: 1px" onclick="imprimir_producto()" class="btn btn-primary btn-foursquarexs"><font size="5" title="Imprimir Producto"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
            <?php
            } ?>
        <!--</div>-->
        <?php
            if($rol[106-1]['rolusuario_asignado'] == 1){ ?>
            <table>
                <!--<tr>
                    <td>
                        <label style="font: normal; font-size: 10px">
                            <input class="btn" type="checkbox" name="escatalogo" id="escatalogo" title="Catalogo de Productos" onclick="modalcatalogo()" >
                            Catalogo
                        </label>
                    </td>
                </tr>-->
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
            <?php } ?>
        </div>
    </div>
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
                    <thead role="rowgroup" id="cabcatalogo">
                        <!--<tr role="row">
                            <th  role="columnheader" >#</th>
                            <th  role="columnheader" >Nombre</th>
                            <th  role="columnheader" >Categoria|<br>Presentación</th>
                            <th  role="columnheader" >Envase</th>
                            <th  role="columnheader" >Código|<br>Cód. Barra</th>
                            <th  role="columnheader" >Precio</th>
                            <th  role="columnheader" >Moneda</th>
                            <th  role="columnheader" class="no-print">Estado</th>
                            <th  role="columnheader" class="no-print"></th>
                    
                    </tr>-->
                    </thead>
                    <tbody class="buscar" id="tablaresultados" role="rowgroup">
                                         
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
<?php
if($a == 1)
echo '<script type="text/javascript">
    alert("El Producto no puede ser ELIMINADO, \n porque tienen transacciones realizadas");
</script>';
?>

  <!------------------------ INICIO modal para CRUD Clasificador ------------------->
<div class="modal fade" id="modalclasificador" tabindex="-1" role="dialog" aria-labelledby="modalclasificadorlabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">CLASIFICADORES</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Seleccionar </span>
                        <select name="clasificador_id" class=" form-control" id="clasificador_id">
                            <option value="">-- CLASIFICADOR --</option>
                            <?php 
                            foreach($all_clasificador as $clasificador)
                            {
                                echo '<option value="'.$clasificador['clasificador_id'].'">'.$clasificador['clasificador_nombre'].'</option>';
                            } 
                            ?>
                        </select>
                        <input type="hidden" name="miproducto_id" value="0" id="miproducto_id" />
                        <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="agregar_clasificador()"><span class="fa fa-check">Añadir</span></div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <!------------------------------------------------------------------->
                <div class="box-body table-responsive">
                    <table class="table table-striped" id="mitabla">
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                        <tbody class="buscar" id="clasificadoresultados" >
                        </tbody>
                    </table>
                </div>
                <!------------------------------------------------------------------->
            </div>
            <!--<div class="modal-footer aligncenter">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>-->
        </div>
    </div>
</div>
<!------------------------ FIN modal para CRUD Clasificador ------------------->
<!------------------------ INICIO modal para elegir # imagenes en Catalogo ------------------->
<div class="modal fade" id="modalcatalogo" tabindex="-1" role="dialog" aria-labelledby="modalcatalogolabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">CATALOGO DE PRODUCTOS</span>
            </div>
            <div class="modal-body">
                <span>
                    <div class="col-md-2">
                        <label for="num_imagenes" class="control-label"><span class="text-danger">*</span>Columnas</label>
                        <span class="text-red" id="mensaje_numimagen"></span>
                        <div class="form-group">
                            <input type="number" min="0" max="20" name="num_imagenes" class="form-control" id="num_imagenes" required placeholder="# entre 1 y 20" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="tipo_imagen" class="control-label"><span class="text-danger">*</span>Tipo Imagen</label>
                        <!--<span class="text-red" id="mensaje_numimagen"></span>-->
                        <div class="form-group">
                            <select name="tipo_imagen" class="form-control" id="tipo_imagen">
                                <option value="circle">CIRCULAR</option>
                                <option value="rounded">RECTANGULAR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <label for="tipo_orden" class="control-label"><span class="text-danger">*</span>Orden</label>
                        <!--<span class="text-red" id="mensaje_numimagen"></span>-->
                        <div class="form-group">
                            <select name="tipo_orden" class="form-control" id="tipo_orden">
                                <option value="a">ALFABETICO</option>
                                <option value="c">CATEGORIA</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="tipo_catalog" class="control-label"><span class="text-danger">*</span>Tipo de Catálogo</label>
                        <!--<span class="text-red" id="mensaje_numimagen"></span>-->
                        <div class="form-group">
                            <select name="tipo_catalogo" class="form-control" id="tipo_catalogo">
                                <option value="1">LISTA</option>
                                <option value="2">ICONOS</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="titulo_catalog" class="control-label"><span class="text-danger"></span>Titulo</label>
                        <!--<span class="text-red" id="mensaje_numimagen"></span>-->
                        <div class="form-group">
                            <input type="text" class="form-control" name="titulo_catalogo" id="titulo_catalogo" />

                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="nombre_check" id="nombre_check" title="Mostrar el nombre del producto" >
                                        Nombre Producto
                                    </label>
                                </td>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="codigo_check" id="codigo_check" title="Mostrar el código de productos" >
                                        Código
                                    </label>
                                </td>
                                <!--<td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="unidad_check" id="unidad_check" title="Mostrar la unidad de productos" >
                                        Unidad
                                    </label>
                                </td>-->
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="marca_check" id="marca_check" title="Mostrar la marca del producto" >
                                        Marca
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="industria_check" id="industria_check" title="Mostrar la industria del producto" >
                                        Industria
                                    </label>
                                </td>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="precio_check" id="precio_check" title="Mostrar el precio unitario" >
                                        Precio Unitario
                                    </label>
                                </td>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="precio1_check" id="precio1_check" title="Mostrar el precio nivel 1" >
                                        Precio (Nivel 1)
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="precio2_check" id="precio2_check" title="Mostrar el precio nivel 2" >
                                        Precio (Nivel 2)
                                    </label>
                                </td>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="precio3_check" id="precio3_check" title="Mostrar el precio nivel 3" >
                                        Precio (Nivel 3)
                                    </label>
                                </td>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="precio4_check" id="precio4_check" title="Mostrar el precio nivel 4" >
                                        Precio (Nivel 4)
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="precio5_check" id="precio5_check" title="Mostrar el precio nivel 5" >
                                        Precio (Nivel 5)
                                    </label>
                                </td>
                                <td style="padding-right: 10px"></td>
                            </tr>
                            
                            <tr>
                                <td style="padding-right: 10px">
                                    <label style="font: normal; font-size: 10px;">
                                        <input class="btn" type="checkbox" name="precio_moneda" id="precio_moneda" title="Mostrar precio de la moneda alternativa" >
                                        Precio Moneda alternativa
                                    </label>
                                </td>
                                <td style="padding-right: 10px"></td>
                            </tr>
                        </table>
                    </div>
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <div class="col-md-12">
                    <a class="btn btn-success" onclick="verificarnumero()"><span class="fa fa-check"></span> Generar</a>
                    <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para elegir # imagenes en Catalogo ------------------->
<!------------------------ INICIO modal para elegir precio factor en PRECIOS ------------------->
<div class="modal fade" id="modalprecio" tabindex="-1" role="dialog" aria-labelledby="modalpreciolabel">
    <div class="modal-dialog modal-sm" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">PRECIOS</span>
            </div>
            <div class="modal-body">
                <span class="text-red" id="mensaje_precio"></span>
                <select name="elegir_preciofactor" class=" form-control" id="elegir_preciofactor">
                    <option value="0" selected> PRECIO NORMAL </option>
                    <option value="1"> PRECIO (NIVEL 1) </option>
                    <option value="2"> PRECIO (NIVEL 2) </option>
                    <option value="3"> PRECIO (NIVEL 3) </option>
                    <option value="4"> PRECIO (NIVEL 4) </option>
                    <option value="5"> PRECIO (NIVEL 5) </option>
                    
                </select>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="listaprecios()"><span class="fa fa-check"></span> Aceptar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para elegir precio factor en PRECIOS ------------------->
<!------------------------ INICIO modal para elegir # imagenes(codigo de barras de un producto) para su impresion! ------------------->
<div class="modal fade" id="modalcodigobarra" tabindex="-1" role="dialog" aria-labelledby="modalcodigobarralabel" style="font-family: Arial">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">CODIGO DE BARRAS DEL PRODUCTO</span><br>
                <span class="text-bold" id="elnombreproducto"></span>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="elencabezadoprint" class="control-label">
                        <input type="checkbox" name="elencabezadoprint" id="elencabezadoprint" />
                        Imprimir con encabezado</label>
                </div>
                <div class="col-md-6">
                    <label for="num_impresiones" class="control-label"><span class="text-danger">*</span>Nro. de Etiquetas</label>
                    <span class="text-red" id="mensaje_num_impresiones"></span>
                    <div class="form-group">
                        <input type="text" name="num_impresiones" class="form-control" id="num_impresiones" required value="100" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="num_imagenes" class="control-label"><span class="text-danger">*</span>Nro. Columnas por Fila</label>
                    <span class="text-red" id="mensaje_numcodigobarra"></span>
                    <div class="form-group">
                        <input type="text" name="num_imagenescodbarra" class="form-control" id="num_imagenescodbarra" required value="10" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="anchoimagen_codbarra" class="control-label"><span class="text-danger">*</span>Ancho de Imagen (cm)</label>
                    <span class="text-red" id="mensaje_anchoimagen_codbarra"></span>
                    <div class="form-group">
                        <input type="text" name="anchoimagen_codbarra" class="form-control" id="anchoimagen_codbarra" required value="3" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="altoimagen_codbarra" class="control-label"><span class="text-danger">*</span>Alto de Imagen (cm)</label>
                    <span class="text-red" id="mensaje_altoimagen_codbarra"></span>
                    <div class="form-group">
                        <input type="text" name="altoimagen_codbarra" class="form-control" id="altoimagen_codbarra" required value="1" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="verificarnumero_codbarra()"><span class="fa fa-check"></span> Generar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para elegir # imagenes(codigo de barras de un producto) para su impresion! ------------------->
