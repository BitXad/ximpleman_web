<script src="<?php echo base_url('resources/js/funciones_cliente.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/qrcode.js'); ?>" type="text/javascript"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
     <!--Styles for datatables--> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
     <!--JQuery include--> 
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
     <!--Javascrips for datatables--> 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 

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
<style type="text/css">
    #contieneimg{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #contieneimg img{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    /* td div div{
        
    } */

    td.details-control {
        background: url('./resources/images/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('./resources/images/details_close.png') no-repeat center center;
    }
</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
 <link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"> 
<!-- <link rel="stylesheet" href="<?= base_url('resources/css/dataTables.bootstrap4.min.css'); ?>"> -->
<!--<link rel="stylesheet" href="<?= base_url('resources/css/dataTables.min.css'); ?>">-->


<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="formaimagen" id="formaimagen" value="<?php  echo $parametro['parametro_formaimagen']; ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php  echo $tipousuario_id; ?>" />
<input type="hidden" name="parametro_puntos" id="parametro_puntos" value="<?php  echo $parametro['parametro_puntos']; ?>" />
<input type="hidden" name="rescliente" id="rescliente" />
<!--<input type="hidden" name="lacategoria_cliente" id="lacategoria_cliente" value='<?php /*echo json_encode($all_categoria_cliente); ?>' />
<input type="hidden" name="lacategoria_clientezona" id="lacategoria_clientezona" value='<?php echo json_encode($all_categoria_clientezona);  ?>' />
<input type="hidden" name="elusuario" id="elusuario" value='<?php echo json_encode($all_usuario); */ ?>' />-->
<!-------------------------------------------------------->
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
                <!--<span style="font-size: 9pt">INGRESOS DIARIOS</span><br>-->
                <span class="lahora" id="fhimpresion"></span><br>
                <span style="font-size: 8pt;" id="busquedacategoria"></span>
                <!--<span style="font-size: 8pt;">PRECIOS EXPRESADOS EN MONEDA BOLIVIANA (Bs.)</span>-->
            </div>
        </div>
        <div id="cabderecha">
            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

        </div>
        
</div>
<br>
<div class="row no-print">
    
    <div class="col-md-8">
    
        <!--este es INICIO del BREADCRUMB buscador-->
<!--        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo site_url('cliente')?>">Clientes</a></li>
                <li class="active"><b>Clientes: </b></li>
                <input style="border-width: 0; background-color: #DEDEDE" id="encontrados" type="text"  size="5" value="0" readonly="true">
            </ol>
        </div>-->

<div class="box-header">
    <font size='4' face='Arial'><b>Clientes</b></font>
    <br><font size='2' face='Arial' id="encontrados"></font> 
</div>

        <!--este es FIN del BREADCRUMB buscador-->
         <div class="col-md-12">
            <!--este es INICIO de input buscador-->
             <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon">Buscar</span>           
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, codigo, ci, nit" onkeypress="buscarcliente(event)" autocomplete="off" >
                </div>
            </div>
        </div>
        <!--<div class="col-md-12">-->
            <!--este es FIN de input buscador-->
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
                        <option value="0"> Todos los Estados </option>
                        <?php 
                        foreach($all_estado as $estado)
                        {
                            echo '<option value="'.$estado['estado_id'].'">'.$estado['estado_descripcion'].'</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box-tools">
                    <select name="prevendedor_id" class="btn-primary btn-sm btn-block" id="prevendedor_id" onchange="tablaresultadoscliente(2)">
                        <option value="" disabled selected >-- USUARIOS --</option>
                        <option value="0"> Todos los Usuarios </option>
                        <option value="-1"> Sin Usuario Asignado </option>
                        <?php 
                        foreach($all_prevendedor as $prevendedor)
                        {
                            echo '<option value="'.$prevendedor['usuario_id'].'">'.$prevendedor['usuario_nombre'].'</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>
        <!--</div>-->
        <!-- *********** INICIO de BUSCADOR select y productos encontrados ****** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
        
        
    </div>
    
    <!---------------- BOTONES --------->
    <div class="col-md-4">
        
            <div class="box-tools text-center" style="display: flex">
                <a href="<?php echo base_url('cliente/add/'); ?>" class="btn btn-success btn-foursquarexs" title="Registrar nuevo Cliente"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Registrar</small></a>
                <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="mostrar_all_clientes()" title="Mostrar a todos los Clientes" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
                <?php
                if($rol[97-1]['rolusuario_asignado'] == 1){ ?>
                <a onclick="imprimir_cliente()" class="btn btn-info btn-foursquarexs" title="Imprimir lista de Clientes"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
                <a href="<?php echo base_url('cliente/clienteprint'); ?>" target="_blank" class="btn btn-soundcloud btn-foursquarexs" title="Imprimir lista de Clientes con detalle resumido"><font size="5"><span class="fa fa-print"></span></font><br><small>Resumen</small></a>
                <a class="btn btn-facebook btn-foursquarexs" data-toggle='modal' data-target='#modalmapa' title="Mostrar mapa de clientes"><font size="5"><span class="fa fa-map"></span></font><br><small>&nbsp;&nbsp;Mapa&nbsp;&nbsp;&nbsp;</small></a>
                <?php } ?>
                <?php
                if($rol[94-1]['rolusuario_asignado'] == 1){ ?>
                <table>
                    <tr>
                        <td style="padding-left: 1px">
                            <label style="font: normal; font-size: 10px; margin: 0px">
                                <input class="btn" type="checkbox" name="lista_gencodqr" id="lista_gencodqr" title="Generar QR" onclick="listacodqr()" >
                                QR
                            </label>
                        </td>
                    </tr>
                    <!--<tr>
                        <td>
                            <label style="font: normal; font-size: 10px; margin: 0px">
                                <input class="btn" type="checkbox" name="listcodigobarras" id="listcodigobarras" title="Lista de Codigos de Barras" onclick="listacodbarras()" >
                                Cod. Barras
                            </label>
                        </td>
                    </tr>-->
                </table>
                <?php } ?>
    </div>
    </div>
    <!---------------- FIN BOTONES --------->
    
</div>
    
<!-------------------------------------------------------------------------------->

<div class="row">
    <div class="col-md-12">
        
        <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->

        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed display" id="mitabla">
                    <thead role="rowgroup" id="cabcliente">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Negocio</th>
                            <th class="no-print">Map</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados"></tbody>  
                </table>
                <?php if($err==2){ ?>
                <script>alert("La imagen es demasiado grande ");</script>
                <?php } ?>
                <?php if($err==1){ ?>
                <script>alert("No se puede subir una imagen con ese formato ");</script>
                <?php } ?>
            </div>

        </div>
    </div>
</div>
<?php
if($a == 1)
echo '<script type="text/javascript">
    alert("El Cliente NO puede ser ELIMINADO, \n porque tiene transacciones realizadas");
</script>';
?>

<!------------------------ INICIO modal para confirmar eliminación ------------------->
<div class='modal fade' id='modalmapa' tabindex='-1' role='dialog' aria-labelledby='modalmapaLabel'>
    <div class='modal-dialog modal-sm' role='document'>
        <br><br>
        <div class='modal-content'>
                <?php echo form_open_multipart('cliente/mapavisitas/', 'taget="blank"'); ?>
            <div class='modal-header text-center'>
                <span style='font-size: 15pt' class='text-bold'>CLIENTES SIN VISITA</span>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>
            </div>
            <div class='modal-body'>
                <!------------------------------------------------------------------->
                
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Desde:&nbsp</b></span>           
                        <input type="date" value="<?php echo date('Y-m-d')?>" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
                    </div>
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Hasta:&nbsp</b></span>           
                        <input type="date" value="<?php echo date('Y-m-d')?>" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true">
                    </div>
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Zona:&nbsp&nbsp</b></span>           
                        <select name="zona_busqueda" class="btn-primary btn-sm btn-block form-control" id="zona_busqueda">
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
                    <br>
                </div>
                
                <!------------------------------------------------------------------->
            </div>
            <div class='modal-footer aligncenter'>
                <div class="col-md-6">
                    <button type="submit"  target="_blank" class='btn btn-success btn-block' id='buscar_visita' name='buscar_visita' ><span class='fa fa-search'></span> Buscar </button>
                </div>
                <div class="col-md-6">
                    <a href='#' class='btn btn-danger btn-block' data-dismiss='modal' id='cerrar_modalmapa' name='cerrar_modalmapa'><span class='fa fa-times'></span> Cerrar </a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------ FIN modal para confirmar eliminación ------------------->

<!------------------------ Inicio DATATABLE ------------------->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

<!-- <script src="<?= site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="<?= site_url('resources/js/datatables.min.js') ?>"></script>
<script src="<?= site_url('resources/js/DataTables-1.10.22/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= site_url('resources/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= site_url('resources/js/jszip.min.js') ?>"></script>
<script src="<?= site_url('resources/js/pdfmake.min.js') ?>"></script>
<script src="<?= site_url('resources/js/vfs_fonts.js') ?>"></script>
<script src="<?= site_url('resources/js/buttons.html5.min.js') ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script> -->
<!-- <script>
    function format(d){
            html ='<table class="table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                        '<tr>' +
                            '<td><b>CODIGO:</b></td>' +
                            '<td>'+d.cliente_codigo+'</td>' +
                            '<td><b>NIT:</b></td>' +
                            '<td>'+d.cliente_nit+'</td>' +
                            '<td><b>C.I.:</b></td>' +
                            '<td>'+d.cliente_ci+'</td>' +
                            '<td><b>EMAIL:</b></td>' +
                            '<td>'+d.cliente_email+'</td>' +
                            '<td><b>TELEFONO:</b></td>' +
                            '<td>'+d.cliente_telefono+"-"+d.cliente_celular+'</td>' +
                            '<td><b>ANIVERS.:</b></td>' +
                            '<td>'+d.cliente_aniversario+"-"+d.cliente_celular+'</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td><b>EMPRESA:</b></td>' +
                            '<td>'+d.cliente_nombrenegocio+'</td>' +
                            '<td><b>RAZÓN SOCIAL:</b></td>' +
                            '<td>'+d.cliente_razon+'</td>' +
                            '<td><b>CATEGORIA:</b></td>' +
                            '<td>'+d.categoriaclie_descripcion+'</td>' +
                            '<td><b>ZONA:</b></td>' +
                            '<td>'+d.zona_nombre+'</td>' +
                            '<td><b>ORDEN VISITA.:</b></td>' +
                            '<td>'+d.cliente_ordenvisita+'</td>' +
                            '<td><b>DPTO.:</b></td>' +
                            '<td>'+d.cliente_departamento+'</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td><b>VISITA:</b></td>';
                            if(d.lun == 1){ html += '<td>Lunes</td>'; }
                            if(d.mar == 1){ html += '<td>Martes</td>'; }
                            if(d.mie == 1){ html += '<td>Miercoles</td>'; }
                            if(d.jue == 1){ html += '<td>Jueves</td>'; }
                            if(d.vie == 1){ html += '<td>Viernes</td>'; }
                            if(d.sab == 1){ html += '<td>Sabado</td>'; }
                            if(d.dom == 1){ html += '<td>Domingo</td>'; }
                            
                            html+='<td><b>DIRECCION:</b></td>' +
                            '<td colspan="8">' + d.cliente_direccion+ '</td>' +
                        '</tr>' +
                    '</table>';
            return html;
        }
        $(document).ready(function() {
            var tipousuario_id = document.getElementById('tipousuario_id').value;
            var table = $('#mitabla').DataTable({
                responsive: "true",
                dom: 'Bfrtilp',
                "ajax": "./json/client.txt",
                "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    // { "data": "cliente_id" },
                    // { "data": "estado_id" },
                    // { "data": "tipocliente_id" },
                    // { "data": "categoriaclie_id" },
                    // { "data": "usuario_id" },
                    { "data": "cliente_codigo", "visible": false},
                    { "data": "cliente_foto", "render": (data, type, row)=>{ 
                        return '<img class="img-rounded" src="./resource/images/clientes/thumb_'+data+'" alt="" width="40px" height="40px" />';
                    }},
                    { "data": "cliente_nombre","render":(data)=>{ return "<h5>"+data+"</h5>" } },
                    { "data": "cliente_ci", "visible": false },
                    { "data": "cliente_direccion", "visible": false },
                    { "data": "cliente_telefono", "visible": false },
                    { "data": "cliente_celular", "visible": false },
                    { "data": "cliente_email", "visible": false },
                    { "data": "cliente_nombrenegocio", "visible": false },
                    { "data": "cliente_aniversario", "visible": false },
                    // { "data": "cliente_latitud" },
                    // { "data": "cliente_longitud" },
                    { "data": "cliente_nit" },
                    { "data": "cliente_razon" , "visible": false},
                    { "data": "cliente_departamento", "visible": false },
                    // { "data": "zona_id" },
                    // { "data": "lun" },
                    // { "data": "mar" },
                    // { "data": "mie" },
                    // { "data": "jue" },
                    // { "data": "vie" },
                    // { "data": "sab" },
                    // { "data": "dom" },
                    { "data": "cliente_ordenvisita", "visible": false },
                    // { "data": "cliente_clave" },
                    // { "data": "cliente_codactivacion" },
                    { "data": "cliente_fechaactivacion", "visible": false },
                    // { "data": "estado_color" },
                    // { "data": "estado_descripcion" },
                    { "data": null, "render": (data, type, row) =>{ return "<div style= background-color:#"+data.estado_color+" ><p class='text-center'>"+data.estado_descripcion+"</p></div>";  }},
                    { "data": "tipocliente_descripcion", "visible": false },
                    { "data": "categoriaclie_descripcion", "visible": false },
                    { "data": "usuario_nombre", "visible": false },
                    { "data": "zona_nombre", "visible": false },
                    { "data": null, "render": (data, type, row) =>{ return "<a href='https://www.google.com/maps/dir/"+data.cliente_latitud+","+data.cliente_longitud+"' target='_blank' title='Ver mapa'><img src='./resources/images/blue.png' width='30' height='30'></a>"; }},
                    { "data": null, "render": (data, type, row) =>{ 
                        html = "<div>"+
                                    "<a href='./venta/ventas_cliente/"+data.cliente_id+"' class='btn btn-success btn-xs' title='Vender'><span class='fa fa-cart-plus'></span></a>"+
                                    "<a href='./pedido/pedidoabierto/"+data.cliente_id+"' class='btn btn-facebook btn-xs' title='Generar pedido Pre-Venta'><span class='fa fa-clipboard'></span></a>"+
                                    "<a href='./cliente/edit/"+data.cliente_id+"' target='_blank' class='btn btn-info btn-xs' title='Modificar datos de Cliente'><span class='fa fa-pencil'></span></a>";
                            if (data.cliente_celular > 1000){
                        html += "<a href='https://wa.me/591"+data.cliente_celular+"' target='_BLANK' class='btn btn-success btn-xs' title='Enviar mensaje por whatsapp'><span class='fa fa-whatsapp'></span></a>";
                            }
                        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modalDelete"+data.cliente_id+"' title='Eliminar'><span class='fa fa-trash'></span></a>"+-->
                                    <!-- "---------------------- INICIO modal para confirmar eliminación -----------------"+ -->
                                    <!-- "<div class='modal fade' id='modalDelete"+data.cliente_id+"' tabindex='-1' role='dialog' >"+
                                        "<div class='modal-dialog' role='document'>"+
                                            "<br><br>"+
                                            "<div class='modal-content'>"+
                                                "<div class='modal-header'>"+
                                                    "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>"+
                                                "</div>"+
                                                "<div class='modal-body'>"+-->
                                                    <!-- "---------------------------------------------------------------"+ -->
                                                    <!-- "<h3><b> <span class='fa fa-trash'></span></b>"+
                                                        "¿Desea eliminar al Cliente <b>"+data.cliente_nombre+"</b> ?"+
                                                    "</h3>"+ -->
                                                    <!-- "---------------------------------------------------------------"+ -->
                                                <!-- "</div>"+
                                                "<div class='modal-footer aligncenter'>"+
                                                    "<a href='./cliente/remove/"+data.cliente_id+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>"+
                                                    "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>"+
                                                "</div>"+
                                            "</div>"+
                                        "</div>"+
                                    "</div>"+ -->
                                    <!-- "---------------------- FIN modal para confirmar eliminación -----------------"+ -->
                                    <!-- "---------------------- INICIO modal para MOSTRAR imagen REAL -----------------"+ -->
                                    <!-- "<div class='modal fade' id='mostrarimagen"+data.cliente_id+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+data.cliente_id+"'>"+
                                        "<div class='modal-dialog' role='document'>"+
                                            "<br><br>"+
                                            "<div class='modal-content'>"+
                                                "<div class='modal-header'>"+
                                                    "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>"+
                                                    "<font size='3'><b>"+data.cliente_nombre+"</b></font>"+
                                                "</div>"+
                                                "<div class='modal-body'>"+ -->
                                                    <!-- "---------------------------------------------------------------"+ -->
                                                    <!-- "<img style='max-height: 100%; max-width: 100%' src='./resources/images/clientes/"+data.cliente_foto+"' />"+ -->
                                                    <!-- "---------------------------------------------------------------"+ -->
                                                <!-- "</div>"+
                                            "</div>"+
                                        "</div>"+
                                    "</div>"+ -->
                                    <!-- "---------------------- FIN modal para MOSTRAR imagen REAL -----------------"; -->
                                <!-- if(tipousuario_id == 1){
                                // if(true){
                            html += "<a class='btn btn-soundcloud btn-xs' data-toggle='modal' data-target='#modalcambiar"+data.cliente_id+"' title='Cambiar contraseña'><em class='fa fa-gear'></em></a>"+ -->
                                <!-- "---------------------- INICIO modal para cambiar PASSWORD -----------------"+ -->
                                <!-- "<div class='modal fade' id='modalcambiar"+data.cliente_id+"' tabindex='-1' role='dialog' aria-labelledby='modalcambiarlabel"+data.cliente_id+"'>"+
                                    "<div class='modal-dialog' role='document'>"+
                                        "<br><br>"+
                                        "<div class='modal-content'>"+
                                            "<div class='modal-header text-center text-bold' style='font-size: 12pt'>"+
                                                "<label>CAMBIAR CONTRASEÑA</label>"+
                                                "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>"+
                                            "</div>"+
                                            "<div class='modal-body' style='font-size: 10pt'>"+ -->
                                            <!-- "---------------------------------------------------------------"+ -->
                                            <!-- "<div class='col-md-6'>"+
                                                "<label for='nuevo_pass"+data.cliente_id+"' class='control-label'>Nueva Contraseña</label>"+
                                                "<div class='form-group'>"+
                                                    "<input type='password' name='nuevo_pass"+data.cliente_id+"' class='form-control' id='nuevo_pass"+data.cliente_id+"' />"+
                                                    "<span class='text-danger' id='error_nuevopass'></span>"+
                                                "</div>"+
                                            "</div>"+
                                            "<div class='col-md-6'>"+
                                                "<label for='repita_pass"+data.cliente_id+"' class='control-label'>Repita Contraseña</label>"+
                                                "<div class='form-group'>"+
                                                    "<input type='password' name='repita_pass"+data.cliente_id+"' class='form-control' id='repita_pass"+data.cliente_id+"' />"+
                                                    "<span class='text-danger' id='error_nuevopass1'></span>"+
                                                "</div>"+
                                            "</div>"+ -->
                                            <!-- "---------------------------------------------------------------"+ -->
                                        <!-- "</div>"+
                                        "<div class='modal-footer aligncenter'>"+
                                            "<a class='btn btn-success' onclick='cambiarcontrasenia("+data.cliente_id+", "+1+")'>"+
                                                "<i class='fa fa-check'></i> Cambiar"+
                                            "</a>"+
                                            "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"+ -->
                            <!-- "---------------------- FIN modal para cambiar PASSWORD -----------------"; -->
                            <!-- }
                                // "</td>"+
                                
                                // "</tr>"+ 
                                html += "</div>";  
                                return html;
                            }}
                ],
                "order": [[1, 'asc']],
                buttons:[
                    {
                        extend: 'excelHtml5',
                        text: '<p style="font-size:18px; color: #fff"><i class="fa fa-file-excel-o" aria-hidden="true"></i></p>',
                        title: 'Clientes',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success btn-xs m-auto',
                        exportOptions: {
                            columns: [0,':visible']
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<p style="font-size:18px; color: #fff"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></p>',
                        title: 'Clientes',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger btn-xs m-auto',
                        exportOptions: {
                            columns: [0,':visible']
                        }
                    },
                    {
                        extend: 'print',
                        text: '<p style="font-size:18px; color: #fff"><i class="fa fa-print" aria-hidden="true"></i></p>',
                        title: 'Clientres',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info btn-xs m-auto',
                        exportOptions: {
                            columns: [0,':visible']
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<p style="font-size:18px;">Ver columnas</p>',
                        className: 'btn btn-warning btn-xs m-auto',
                        columnText: function(dt,idx,title){
                            return '<a class="dropdown-item pl-0" href="#" style="color:black;">'+(idx+1)+': '+title+'</a>';
                            // return 'Hola'
                        }
                    }
                ],
            });

            $('#mitabla tbody').on('click','td.details-control', function(){
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if(row.child.isShown()){
                    row.child.hide();
                    tr.removeClass('shown');
                }else{
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });
        } );
        function cambiarcontrasenia(cliente_id, limit){
            var base_url    = document.getElementById('base_url').value;
            var nuevo_pass  = document.getElementById('nuevo_pass'+cliente_id).value;
            var repita_pass = document.getElementById('repita_pass'+cliente_id).value;
            var controlador = base_url+"cliente/nuevaclave/";
            $('#modalcambiar'+cliente_id).modal('hide');
            $.ajax({url: controlador,
                type:"POST",
                data:{cliente_id:cliente_id, nuevo_pass:nuevo_pass, repita_pass:repita_pass },
                    success:function(resul){
                        var registros =  JSON.parse(resul);
                        if (registros != null){
                            if(registros == "ok"){
                                alert("Cambio de contraseña exitosa");
                                tablaresultadoscliente(limit);
                            }else{
                                alert("Las contraseñas deben ser iguales");
                                $('#modalcambiar'+cliente_id).modal('show');
                            }
                        }
                },
                error:function(resul){
                // alert("Algo salio mal...!!!");
                alert("Ocurrio un error inesperado");
                } 
            });
        } -->
<!-- </script>  -->
<!------------------------- Fin DATATABLE --------------------->
