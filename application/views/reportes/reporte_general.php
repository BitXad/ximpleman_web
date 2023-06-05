<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/reporte_general.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $('#comprar').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
     $(document).ready(function () {
        (function ($) {
            $('#filtrar2').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar2 tr').hide();
                $('.buscar2 tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
    function imprimir()
    {
         window.print(); 
    }
</script>   

<style type="text/css">
 @page { 
        size: landscape;
    }
     
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>">
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro['moneda_id']; ?>" />
<input type="hidden" name="decimales" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="resproducto" id="resproducto" />
<div class="cuerpo" style="font-family: Arial;">
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
            <h3 class="box-title"><u>REPORTE GENERAL</u></h3>
            <?php echo date('d/m/Y H:i:s'); ?><br>
            <!--<b>VENTAS REALIZADAS</b>-->
        </center>
    </div>
</div>
<div class="row">
    <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' >
        <!--<div class="col-md-4 no-print" >                     
            Cliente:
            <input id="cliente_id" type="text" class="form-control" placeholder="Ingresa el nombre del cliente, nit o razon social"  onkeypress="ventacliente(event)">
        </div>-->
        <div class="col-md-2 no-print">
            <label for="filtrar" class="control-label"> Filtrar: </label>
            <select class="btn btn-primary btn-sm form-control" name="filtrar" id="filtrar" onchange="tipode_reporte()" required>
                <option value="1" selected>VENTA</option>
                <option value="2">SERVICIO</option>
                <option value="3">PRODUCCION</option>
            </select>
        </div>
        <div class="col-md-2 no-print">
            <label for="fecha_desde" class="control-label"> Desde: </label>
            <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
        </div> 
        <div class="col-md-2 no-print">
            <label for="fecha_hasta" class="control-label"> Hasta: </label>
            <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
        </div>
        <div class="col-md-2 no-print" id="serv_vendedor" style="display: block">
            <label for="vendedor_id" class="control-label"> Vendedor: </label>
            <select class="btn btn-primary btn-sm form-control" name="vendedor_id" id="vendedor_id" >
                <option value="0">TODOS</option>
                <?php foreach($all_usuario as $usuario){
                    $selected = ($usuario['usuario_id'] == $usuario_id) ? ' selected="selected"' : "";
                ?>
                <option value="<?php echo $usuario['usuario_id']; ?>" <?php echo $selected; ?>><?php echo $usuario['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2 no-print" id="serv_prevendedor" style="display: block">
            <label for="prevendedor_id" class="control-label"> Prevendedor: </label>
            <select class="btn btn-primary btn-sm form-control" name="prevendedor_id" id="prevendedor_id" >
                <option value="0">TODOS</option>
                <?php foreach($all_usuario as $usuario){?>
                <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2 no-print" id="serv_usuario" style="display: none">
            <label for="usuario_id" class="control-label"> Usuario: </label>
            <select class="btn btn-primary btn-sm form-control" name="usuario_id" id="usuario_id" required >
                <option value="0">TODOS</option>
                <?php foreach($all_usuario as $usuario){?>
                <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <!--<div class="col-md-2 no-print" id="serv_responsable" style="display: none">
            <label for="responsable_id" class="control-label"> Responsable: </label>
            <select class="btn btn-primary btn-sm form-control" name="responsable_id" id="responsable_id" >
                <option value="0">TODOS</option>
                <?php /*foreach($all_usuario as $usuario){
                    $selected = ($usuario['usuario_id'] == $usuario_id) ? ' selected="selected"' : "";
                ?>
                <option value="<?php echo $usuario['usuario_id']; ?>" <?php echo $selected; ?>><?php echo $usuario['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2 no-print" id="serv_recepcionadopor" style="display: none">
            <label for="recepcionadopor_id" class="control-label"> Recepcionado por: </label>
            <select class="btn btn-primary btn-sm form-control" name="recepcionadopor_id" id="recepcionadopor_id" >
                <option value="0">TODOS</option>
                <?php foreach($all_usuario as $usuario){?>
                <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                <?php }*/ ?>
            </select>
        </div>-->
        <div class="col-md-2 no-print">
            <label for="exportar" class="control-label"> &nbsp; </label>
            <div class="form-group" style="display: flex; margin-bottom: 0px">
                <a class="btn btn-facebook btn-sm form-control" onclick="reporte_general()" title="Buscar ventas"><i class="fa fa-search"> </i> Buscar</a>
                <a class="btn btn-info" onclick="mostrar_masfventa()" style="display: block" id="boton_masfventa" title="Mostrar mas Filtros"><span class="fa fa-search-plus"></span></a>
                <a class="btn btn-info" onclick="mostrar_menosfventa()" style="display: none" id="boton_menosfventa" title="Mostrar menos Filtros"><span class="fa fa-search-minus"></span></a>
            </div>
        </div>
        <span id="masdeventas" style="display: none">
            <div class="col-md-2 no-print" id="prod_tipotrans" style="display: block">
                <label for="tipotrans_id" class="control-label"> Tipo Trans: </label>
                <select class="btn btn-primary btn-sm form-control" name="tipotrans_id" id="tipotrans_id" required>
                    <option value="0">TODOS</option>
                    <?php foreach($all_tipotransaccion as $tipo){?>
                    <option value="<?php echo $tipo['tipotrans_id']; ?>"><?php echo $tipo['tipotrans_nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 no-print" id="prod_forma" style="display: block">
                <label for="forma_id" class="control-label"> Forma Pago: </label>
                <select class="btn btn-primary btn-sm form-control" name="forma_id" id="forma_id" required>
                    <option value="0">TODOS</option>
                    <?php foreach($all_formapago as $forma){?>
                    <option value="<?php echo $forma['forma_id']; ?>"><?php echo $forma['forma_nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 no-print" id="prod_comprobante" style="display: block">
                <label for="comprobante" class="control-label"> Comprobante: </label>
                <select class="btn btn-primary btn-sm form-control" name="comprobante" id="comprobante" required>
                    <option value="0">TODOS</option>
                    <option value="1">FACTURA</option>
                    <option value="2">NOTA DE VENTA</option>
                </select>
            </div>
            <div class="col-md-2 no-print" id="serv_zona" style="display: block">
                <label for="zona_id" class="control-label"> Zona: </label>
                <select class="btn btn-primary btn-sm form-control" name="zona_id" id="zona_id" required>
                    <option value="0">TODOS</option>
                    <?php foreach($all_zona as $zona){?>
                    <option value="<?php echo $zona['zona_id']; ?>"><?php echo $zona['zona_nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-1 no-print" id="serv_ventapreventa" style="display: block">
                <label for="ventapreventa" class="control-label"> Origen: </label>
                <select class="btn btn-primary btn-sm form-control" name="ventapreventa" id="ventapreventa" required>
                    <option value="0">TODOS</option>
                    <option value="1">PREVENTAS</option>
                    <option value="2">VENTAS</option>
                </select>
            </div>
            <div class="col-md-3" id="serv_cliente" style="display: block">
                <label for="cliente_nombre" class="control-label"> Cliente: </label>
                <div class="form-group" style="display: flex; margin-bottom: 0px">
                    <input type="text" name="cliente_nombre" id="cliente_nombre" class="form-control" value="TODOS" readonly >
                    <input type="hidden" name="cliente_id" id="cliente_id" value="0" >
                    <a data-toggle="modal" data-target="#modalbuscarcliente" class="btn btn-success" title="Buscar Clientes">
                    <i class="fa fa-search"></i></a>
                    <a class="btn btn-warning" onclick="clientetodos()" title="Todos los clientes"><b>T</b></a>
                </div>
            </div>
            <div class="col-md-3">  
                <label for="producto_nombre" class="control-label"> Producto: </label>
                <div class="form-group" style="display: flex; margin-bottom: 0px">
                    <input type="text" name="producto_nombre" id="producto_nombre" class="form-control" value="TODOS" readonly >
                    <input type="hidden" name="producto_id" id="producto_id" value="0" >
                    <a data-toggle="modal" data-target="#modalbuscarproducto" class="btn btn-success" title="Buscar Productos">
                    <i class="fa fa-search"></i></a>
                    <a class="btn btn-warning" onclick="productotodos()" title="Todos los productos"><b>T</b></a>
                </div>
            </div>
            <div class="col-md-2 no-print" id="serv_preferencia" style="display: block">
                <label for="preferencia_id" class="control-label"> Preferencia: </label>
                <select class="btn btn-primary btn-sm form-control" name="preferencia_id" id="preferencia_id" required>
                    <option value="0">TODOS</option>
                    <?php foreach($all_preferencia as $preferencia){?>
                    <option value="<?php echo $preferencia['preferencia_id']; ?>"><?php echo $preferencia['preferencia_descripcion']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 no-print" id="serv_clasificador" style="display: block">
                <label for="clasificador_id" class="control-label"> Clasificador: </label>
                <select class="btn btn-primary btn-sm form-control" name="clasificador_id" id="clasificador_id" required>
                    <option value="0">TODOS</option>
                    <?php foreach($all_clasificador as $clasificador){?>
                    <option value="<?php echo $clasificador['clasificador_id']; ?>"><?php echo $clasificador['clasificador_nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 no-print" id="serv_categoria" style="display: block">
                <label for="categoria_id" class="control-label"> Categoria: </label>
                <select class="btn btn-primary btn-sm form-control" name="categoria_id" id="categoria_id" onchange="mostrar_subcategoriaproducto(this.value)" required>
                    <option value="0">TODOS</option>
                    <?php foreach($all_categoria as $categoria){?>
                    <option value="<?php echo $categoria['categoria_id']; ?>"><?php echo $categoria['categoria_nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 no-print" id="serv_subcategoria" style="display: block">
                <label for="subcategoria_id" class="control-label"> Sub categoria: </label>
                <select class="btn btn-primary btn-sm form-control" name="subcategoria_id" id="subcategoria_id" required>
                    <option value="0">TODOS</option>
                </select>
            </div>
        </span>
        
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="imprimir()" class="btn btn-success btn-sm form-control"><i class="fa fa-print"> </i> Imprimir</a>
            </div>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="generarexcel_reportegrl()" class="btn btn-danger btn-sm form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</a>
            </div>
        </div>
        <div id="tablas" style="visibility: block">  
            <div class="col-md-6 no-print" id="tablareproducto_ojo" hidden></div>
            <!--<div class="col-md-6 no-print" id="tablarecliente"></div>-->
            <div class="col-md-6 no-print" id="tablareproveedor"></div>
            <input id="producto" type="hidden" class="form-control" >
            <input id="cliente" type="hidden" class="form-control" > 
            <input id="proveedor" type="hidden" class="form-control" > 
        </div>
    </div>
     <span id="desde"></span>
     <span id="hasta"></span>
   <div id="labusqueda"></div>
</div>
<div class="row no-print" id='loader'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
    </center>
</div>
<div class="box" style="padding: 0;">
    <div class="box-body table-responsive" >
        <table class="table table-striped table-condensed" id="mitabla" >
            <tr>
                <th>Nro.</th>
                <th>PRODUCTO</th>
                <th id="titulo_uno">FECHA<br>VENTA</th>
                <th id="titulo_dos">NUM.<br>VENTA</th>
                <th id="titulo_tres">NUM.<br>DOC.</th>
                <th id="titulo_cuatro">TIPO<br>VENTA</th>
                <th id="titulo_cinco">CUOTA<br>INIC.(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <th>UNIDAD</th>
                <th>CANT.</th>
                <th>PRECIO<br>UNIT.(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <th>DESC(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <th>PRECIO<br>TOTAL(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <th>PRECIO<br>TOTAL(<?php //$lamoneda[0]['moneda_descripcion']; 
                                        if($parametro["moneda_id"] == 1){
                                            echo $lamoneda[1]['moneda_descripcion'];
                                        }else{
                                            echo $lamoneda[0]['moneda_descripcion'];
                                        }
                                    ?>)
                </th>
                <?php if($tipousuario_id == 1){ ?>
                <th>COSTO<br>(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <th>UTILID.<br>(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <?php } ?>
                <th id="titulo_seis">CLIENTE</th>
                <th id="titulo_siete">CAJERO</th>
                <th class="no-print"></th>
            </tr>
            <tbody class="buscar" id="resultado_reporte"></tbody>
        </table>
    </div>
</div>
<center>
    <ul style="margin-bottom: -5px;margin-top: 35px;" >--------------------------------</ul>
    <ul style="margin-bottom: -5px;">RESPONSABLE</ul><ul>FIRMA - SELLO</ul>
</center>

<!------------------------ INICIO modal para Seleccionar a un cliente ------------------->
<div class="modal fade" id="modalbuscarcliente" tabindex="-1" role="dialog" aria-labelledby="modalbuscarclientelabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Buscar Cliente</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Buscar </span>
                        <input id="buscar_elcliente" name="buscar_elcliente" type="text" class="form-control" placeholder="Ingresa el nombre del cliente, nit o razon social"  onkeypress="buscarcliente(event)" autofocus>
                        <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablarecliente()"><span class="fa fa-search"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <div class="row no-print" id='loader_bcliente'  style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
                </center>
            </div>
                <!------------------------------------------------------------------->
                <div class="col-md-12 no-print" id="tablarecliente"></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer aligncenter">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar a un cliente ------------------->
<!------------------------ INICIO modal para Seleccionar a un producto ------------------->
<div class="modal fade" id="modalbuscarproducto" tabindex="-1" role="dialog" aria-labelledby="modalbuscarproductolabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Buscar Producto</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Buscar </span>
                        <input id="buscar_elproducto" name="buscar_elproducto" type="text" class="form-control" placeholder="Ingrese el nombre del producto o codigo"  onkeypress="buscarproducto(event)" autofocus>
                        <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablareproducto()"><span class="fa fa-search"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <div class="row no-print" id='loader_bproducto'  style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
                </center>
            </div>
                <!------------------------------------------------------------------->
                <div class="col-md-12 no-print" id="tablareproducto"></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer aligncenter">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar a un producto ------------------->