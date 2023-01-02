
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('resources/css/datepicker.min.css')?>">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('resources/css/datepicker3.min.css')?>">

<link href="<?php echo base_url('resources/css/formValidation.css')?>" rel="stylesheet">
<script src="<?php echo base_url('resources/js/formValidation.js');?>"></script>
<script src="<?php echo base_url('resources/js/formValidationBootstrap.js');?>"></script>
<script src="<?php echo site_url('resources/js/bootstrap-datepicker.min.js');?>"></script>
<link href="<?php echo site_url('resources/css/jquery.dataTables.min.css')?>" rel="stylesheet">
<script src="<?php echo site_url('resources/js/jquery.dataTables.min.js');?>"></script>

<style>
    .modal-dialog {
        width: 550px;
    }

    .modal-header {
        background-color: #337AB7;
        padding:16px 16px;
        color:#FFF;
        border-bottom:2px dashed #337AB7;
    }

   .success {
       background-color: #65dc2a !important;
       color: white;
    }


    .error {
        background-color: #dd4b39 !important;
        font-size: 14px;
        font-weight: bold;
        color: white;
    }

    .warning {
        background-color: #f4f4f4 !important;
    }

    .table tbody tr > td.info {
        background-color: #d9edf7 !important;
    }

    #table_pedidos tbody tr:hover {
        background-color: #10ebe3 !important;
    }

    .table-hover tbody tr:hover > td.error {
        background-color: #ebcccc !important;
    }

    .table-hover tbody tr:hover > td.warning {
        background-color: #faf2cc !important;
    }

    .table-hover tbody tr:hover > td.info {
        background-color: #a2c9c3 !important;
    }

</style>

<div class="box-header">
    <h3 class="box-title">Plan de Pedidos</h3>
    <div class="box-tools">
        <a href="" role="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevoModal"
           style="margin:0 0 1em;">
            NUEVO PEDIDO
        </a>
    </div>
</div>

<div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                    <?php
                        $hoy = new DateTime();
                        $cade =  $hoy->format('Y-m-d');

                        $datetime = new DateTime($cade);
                        $datetime->modify('+1 day');
                        $tomorrow = $datetime->format('Y-m-d');

                        $attributes = array("name" => "nuevoPedidoForm", "class"=>"form-horizontal","id"=>"nuevoPedidoForm","method"=>"post");
                        echo form_open("admin/pedidos/create", $attributes);
                     ?>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Proveedor</label>
                            <div class="col-md-6">
                                <div class="input-group in-grp1">
                                    <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </span>
                                    <select id="proveedores" class="form-control" name="proveedores">
                                        <option value=""></option>
                                        <?php
                                            foreach ($proveedores as $prove){
                                                echo '<option value="'.$prove->proveedor_id.'">'.$prove->proveedor_nombre.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 jlkdfj1">
                                <p class="help-block"><?php echo form_error('proveedores'); ?></p>
                            </div>
                            <div class="clearfix"> </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Monto Total</label>
                            <div class="col-md-6">
                                <div class="input-group in-grp1">
                                    <span class="input-group-addon">
                                        <i class="fa fa-money"></i>
                                    </span>
                                    <input type="text" class="form-control input-md" name="monto" id="monto" type="number"  step="0.01" min="1" placeholder="monto total" value="<?php echo set_value('monto'); ?>">
                                </div>
                            </div>
                            <div class="col-sm-2 jlkdfj1">
                                <p class="help-block"><?php echo form_error('monto'); ?></p>
                            </div>
                            <div class="clearfix"> </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Fecha</label>
                            <div class="col-md-6">
                                <div class="input-group input-append date" id="dfini">
                                    <input type="text" id="fecha" readonly class="form-control" name="fecha" value="<?php echo $tomorrow?>">
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            <div class="col-sm-2 jlkdfj1">
                                <p class="help-block"><?php echo form_error('fecha'); ?></p>
                            </div>
                            <div class="clearfix"> </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Resumen</label>
                            <div class="col-md-8">
                                <textarea class="form-control input-md" rows="11" name="resumen" id="resumen"></textarea>
                            </div>
                            <div class="col-sm-2 jlkdfj1">
                                <p class="help-block"><?php echo form_error('resumen'); ?></p>
                            </div>
                            <div class="clearfix"> </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <button type="submit"  class="btn btn-primary btn-lgs" >Crear</button>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </fieldset>
                    <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-body">
                <button type="button" class="btn btn-danger" id="hoy" style="width: 100px" >
                    Hoy
                </button>
                <button type="button" class="btn btn-success" id="manana" style="background-color: #65dc2a">
                    Mañana
                </button>
                <button type="button" class="btn btn-default" id="todos">
                    Todos
                </button>
                <form id="dateform" class="form-inline pull-right">
                    <label>Por Fecha:</label>
                    <div class="input-group input-append date" id="dfini">
                        <input type="text" id="fechax" class="form-control" readonly value="<?php echo $tomorrow?>">
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="xs tabls">
        <?php if($this->session->flashdata('msg')): ?>
            <p><?php echo $this->session->flashdata('msg'); ?></p>
        <?php endif; ?>
        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf" id="table_pedidos">
                <thead class="cf">
                <tr>
                    <th>#</th>
                    <th>Proveedor</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Resumen</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="mis_pedis" >
                <tr>
                <?php
                $cont =1;
                $hoy = new DateTime();
                $cade_hoy =  $hoy->format('Y-m-d');

                $datetime_manana = new DateTime($cade_hoy);
                $datetime_manana->modify('+1 day');
                $tomorrow = $datetime_manana->format('Y-m-d');
                $total = 0;

                foreach ($pedidos as $row){
                    $tr = '<tr class="warning">';
                    if($row->pedidos_fecha==$tomorrow){
                        $tr = '<tr class="success">';
                    }

                    if($row->pedidos_fecha==$cade_hoy){
                       $tr = '<tr class="error" >';
                    }

                    $fecha = date("d-m-Y", strtotime($row->pedidos_fecha) );

                    echo $tr;

                    ?>
                    <td data-title="Nro"><?php echo $cont++?></td>
                    <td data-title="Proveedor">
                        <small ><?php echo $row->proveedor_nombre?></small>
                    </td>
                    <td data-title="Monto"><?php echo $row->pedidos_montototal?></td>
                    <?php $total += $row->pedidos_montototal; ?>
                    <td data-title="Fecha"><?php echo $fecha?></td>
                    <td data-title="Resumen">
                        <p>
                            <?php echo substr($row->pedidos_resumen, 0, 15); ?>...
                        </p>
                    </td>

                    <td data-title="Opciones">

                        <a id="myLink" title="Detalle" class="btn btn-info btn-xs" href="#" onclick="openDetalle(<?php echo $row->pedidos_id?>);return false;">
                            <span class="fa fa-paperclip"></span>
                        </a>

                        <a href="<?php echo site_url('admin/pedidos/editar/'.$row->pedidos_id)?>"  class="btn btn-info btn-xs" title="Editar">
                            <span class="fa fa-edit"></span>
                        </a>
                        <a onclick="return confirm('¿Borrar Pedido?')" class="btn btn-danger btn-xs" href="<?php echo site_url('admin/pedidos/borrar/'.$row->pedidos_id)?>" title="¿Borrar Pedido?">
                            <span class="fa fa-trash-o"></span>
                        </a>

                    </td>
                    </tr>
                <?php }?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <?php echo $total; ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
        <hr>
        <ol class="breadcrumb">
            <li><i class="fa fa-calendar"></i>&nbsp;<a href="<?php echo site_url('admin/pedidos/info/'. (date("Y")-1) )?>"><?php echo (date("Y")-1); ?></a></li>
        </ol>
    </div>
</div>

<div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Plan de Pedidos (<span id="pfech"></span> )</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-6">
                            <strong><i class="fa fa-shopping-bag margin-r-5"></i> Proveedor:</strong>
                            <p class="text-muted" id="nproveedor"></p>
                        </div>

                        <div class="col-xs-6">
                            <strong><i class="fa fa-money margin-r-5"></i> Monto Total:</strong>
                            <p class="text-muted" id="pmonto"></p>
                        </div>
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Resumen:</strong>
                        <p id="presumen"></p>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {


/*        $('#table_pedidosxxx').dataTable( {
            "iDisplayLength": 15
        } );*/


        $('#fecha').datepicker({
            autoclose: false,
            format: 'yyyy-mm-dd',
            todayHighlight: true
        }).on('changeDate', function(e) {
                $('#nuevoPedidoForm').formValidation('revalidateField', 'fecha');
            });

        $('#fechax').datepicker({
            autoclose: false,
            format: 'yyyy-mm-dd',
            todayHighlight: true
        }).on('changeDate', function(e) {
            $('#dateform').formValidation('revalidateField', 'fechax');
            //console.log( $('#fechax').val() );
            ajax_cambiar_fecha();
        });

/*
        $( '#fechax' ).change(function() {
            console.log( $('#fechax').val() );
        });*/

        $('#nuevoPedidoForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                proveedores:{
                    validators:{
                        notEmpty: {
                            message: 'Debe elegir un Proveedor'
                        }
                    }
                },

                monto: {
                    validators: {
                        notEmpty: {
                            message: 'Monto Total es un campo requerido'
                        },
                        stringLength: {
                            min: 1,
                            max: 6,
                            message: 'Monto Total al menos 1 caracteres y maximo 6'
                        }
                    }
                },

                fecha: {
                    validators: {
                        notEmpty: {
                            message: 'Fecha es requerida'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'formato invalido'
                        }
                    }
                },

                resumen: {
                    validators: {
                        notEmpty: {
                            message: 'Resumen es un campo requerido'
                        }
                    }
                }
            }
        });

    });

    $( "#hoy" ).click(function() {
        ajax_cambiar_hoy();
    });

    $( "#manana" ).click(function() {
        ajax_cambiar_manana();
    });

    $( "#todos" ).click(function() {
        ajax_cambiar_todos();
    });


    function convertDateFormat(string){
        var info = "";
        if(string != null){
            info = string.split('-').reverse().join('/');
        }
        return info;
    }


    function ajax_cambiar_hoy(){
        var today = moment().format('YYYY-MM-DD');
        //console.log(today);
        var parametros = {
            "fech" : today
        };

        $.ajax({
            data:  parametros,
            url:   '<?php echo base_url("admin/pedidos/fecha")?>',
            type:  'post',
            beforeSend: function () {
                //$('#registrando').html('<h5 id="procesing">Procesando...</h5>');
            },
            success:  function (response) {

                var results = JSON.parse(response);
                //console.log(results);

                var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
                var day = currentDate.getDate();
                var month = currentDate.getMonth() + 1;
                var year = currentDate.getFullYear();

                if(day<10){
                    day = '0'+day;
                }

                if(month<10){
                    month = ''+month;
                }

                var nextDay =  year+ "-" + month + "-" + day;

                //console.log('mañana:'+nextDay);

                var trs = '';
                $.each(results, function(index, value) {

                    var tr = '<tr class="warning">';
                    //console.log('pedidos_fecha:'+value.pedidos_fecha+' , mañana:'+nextDay);
                    if(value.pedidos_fecha==nextDay){
                        tr = '<tr class="success">';
                    }
                    if(value.pedidos_fecha==today){
                        tr = '<tr class="error">';
                    }

                    var tds = '<td data-title="Nro">'+(index+1)+'</td>'+
                        '<td data-title="Proveedor">'+
                        '<small >'+value.proveedor_nombre+'</small>'+
                        '</td>'+
                        '<td data-title="Monto">'+value.pedidos_montototal+'</td>'+
                        '<td data-title="Fecha">'+convertDateFormat(value.pedidos_fecha)+'</td>'+
                        '<td data-title="Resumen">'+
                        '<p>'+ value.pedidos_resumen.substring(0,15)+'...</p>'+
                        '</td>'+
                        '<td data-title="Opciones">'+

                        '<a id="myLink" onclick="openDetalle('+value.pedidos_id+');return false" class="btn btn-info btn-xs" title="Detalle">'+
                        '<span class="fa fa-paperclip"></span> ' +
                        '</a>'+

                        '<a href="'+document.location.origin+"/admin/pedidos/editar/"+value.pedidos_id+'" class="btn btn-info btn-xs" title="Editar">'+
                        '<span class="fa fa-edit"></span> ' +
                        '</a>'+
                        '<a onclick="return confirm(\'¿Borrar Pedido?\')" href="'+document.location.origin+"/admin/pedidos/borrar/"+value.pedidos_id+'" class="btn btn-danger btn-xs" title="Borrar Pedido?">'+
                        '<span class="fa fa-trash-o"></span> ' +
                        '</a>'+
                        '</td>';

                    trs = trs+ (tr + tds+'</tr>');
                });//fin each

                //console.log(trs);
                $('#mis_pedis').replaceWith('<tbody id="mis_pedis" >'+trs+'</tbody>' );
            }
        });
    }

    function ajax_cambiar_manana(){
        var today = moment().format('YYYY-MM-DD');
        var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();
        var site = "<?php echo site_url('')?>";

        if(day<10){
            day = '0'+day;
        }

        if(month<10){
            month = ''+month;
        }

        var nextDay =  year+ "-" + month + "-" + day;


        //console.log(today);
        var parametros = {
            "fech" : nextDay
        };

        $.ajax({
            data:  parametros,
            url:   '<?php echo base_url("admin/pedidos/fecha")?>',
            type:  'post',
            beforeSend: function () {
                //$('#registrando').html('<h5 id="procesing">Procesando...</h5>');
            },
            success:  function (response) {

                var results = JSON.parse(response);
                //console.log(results);
                //console.log('mañana:'+nextDay);

                var trs = '';
                $.each(results, function(index, value) {

                    var tr = '<tr class="warning">';
                    //console.log('pedidos_fecha:'+value.pedidos_fecha+' , mañana:'+nextDay);
                    if(value.pedidos_fecha==nextDay){
                        tr = '<tr class="success">';
                    }
                    if(value.pedidos_fecha==today){
                        tr = '<tr class="error">';
                    }

                    var tds = '<td data-title="Nro">'+(index+1)+'</td>'+
                        '<td data-title="Proveedor">'+
                        '<small >'+value.proveedor_nombre+'</small>'+
                        '</td>'+
                        '<td data-title="Monto">'+value.pedidos_montototal+'</td>'+
                        '<td data-title="Fecha">'+convertDateFormat(value.pedidos_fecha)+'</td>'+
                        '<td data-title="Resumen">'+
                        '<p>'+ value.pedidos_resumen.substring(0,15)+'...</p>'+
                        '</td>'+
                        '<td data-title="Opciones">'+

                        '<a id="myLink" onclick="openDetalle('+value.pedidos_id+');return false" class="btn btn-info btn-xs" title="Detalle">'+
                        '<span class="fa fa-paperclip"></span> ' +
                        '</a>'+

                        '<a href="'+site+"admin/pedidos/editar/"+value.pedidos_id+'" class="btn btn-info btn-xs" title="Editar">'+
                        '<span class="fa fa-edit"></span></a>'+
                        '<a onclick="return confirm(\'¿Borrar Pedido?\')" href="'+site+"admin/pedidos/borrar/"+value.pedidos_id+'" class="btn btn-danger btn-xs" title="Borrar Pedido?">'+
                        '<span class="fa fa-trash-o"></span></a>'+
                        '</td>';

                    trs = trs+ (tr + tds+'</tr>');
                });//fin each

                //console.log(trs);
                $('#mis_pedis').replaceWith('<tbody id="mis_pedis" >'+trs+'</tbody>' );
            }
        });
    }

    function ajax_cambiar_todos(){
        var today = moment().format('YYYY-MM-DD');
        var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();

        if(day<10){
            day = '0'+day;
        }

        if(month<10){
            month = ''+month;
        }
        var nextDay =  year+ "-" + month + "-" + day;

        var site = "<?php echo site_url('')?>";

        $.ajax({
            url:   '<?php echo base_url("admin/pedidos/todos")?>',
            type:  'get',
            beforeSend: function () {
                //$('#registrando').html('<h5 id="procesing">Procesando...</h5>');
            },
            success:  function (response) {

                var results = JSON.parse(response);
                //console.log(results);
                //console.log('mañana:'+nextDay);

                var trs = '';
                $.each(results, function(index, value) {

                    var tr = '<tr class="warning">';
                    //console.log('pedidos_fecha:'+value.pedidos_fecha+' , mañana:'+nextDay);
                    if(value.pedidos_fecha==nextDay){
                        tr = '<tr class="success">';
                    }
                    if(value.pedidos_fecha==today){
                        tr = '<tr class="error">';
                    }

                    var tds = '<td data-title="Nro">'+(index+1)+'</td>'+
                        '<td data-title="Proveedor">'+
                        '<small >'+value.proveedor_nombre+'</small>'+
                        '</td>'+
                        '<td data-title="Monto">'+value.pedidos_montototal+'</td>'+
                        '<td data-title="Fecha">'+convertDateFormat(value.pedidos_fecha)+'</td>'+
                        '<td data-title="Resumen">'+
                        '<p>'+ value.pedidos_resumen.substring(0,15)+'...</p>'+
                        '</td>'+
                        '<td data-title="Opciones">'+

                        '<a id="myLink" onclick="openDetalle('+value.pedidos_id+');return false" class="btn btn-info btn-xs" title="Detalle">'+
                        '<span class="fa fa-paperclip"></span> ' +
                        '</a>'+

                        '<a href="'+site+"admin/pedidos/editar/"+value.pedidos_id+'" class="btn btn-info btn-xs" title="Editar">'+
                        '<span class="fa fa-edit"></span></a>'+
                        '<a onclick="return confirm(\'¿Borrar Pedido?\')" href="'+site+"admin/pedidos/borrar/"+value.pedidos_id+'" class="btn btn-danger btn-xs" title="Borrar Pedido?">'+
                        '<span class="fa fa-trash-o"></span></a>'+
                        '</td>';

                    trs = trs+ (tr + tds+'</tr>');
                });//fin each

                //console.log(trs);
                $('#mis_pedis').replaceWith('<tbody id="mis_pedis" >'+trs+'</tbody>' );
            }
        });
    }

    function ajax_cambiar_fecha(){
        var today = moment().format('YYYY-MM-DD');
        var site = "<?php echo site_url('')?>";
        //console.log(today);
        var parametros = {
            "fech" :  $('#fechax').val()
        };

        $.ajax({
            data:  parametros,
            url:   '<?php echo base_url("admin/pedidos/fecha")?>',
            type:  'post',
            beforeSend: function () {
                //$('#registrando').html('<h5 id="procesing">Procesando...</h5>');
            },
            success:  function (response) {

                var results = JSON.parse(response);
                //console.log(results);

                var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
                var day = currentDate.getDate();
                var month = currentDate.getMonth() + 1;
                var year = currentDate.getFullYear();

                if(day<10){
                    day = '0'+day;
                }

                if(month<10){
                    month = ''+month;
                }

                var nextDay =  year+ "-" + month + "-" + day;

                //console.log('mañana:'+nextDay);

                var trs = '';
                $.each(results, function(index, value) {

                    var tr = '<tr class="warning">';
                    //console.log('pedidos_fecha:'+value.pedidos_fecha+' , mañana:'+nextDay);
                    if(value.pedidos_fecha==nextDay){
                        tr = '<tr class="success">';
                    }
                    if(value.pedidos_fecha==today){
                        tr = '<tr class="error">';
                    }

                    var tds = '<td data-title="Nro">'+(index+1)+'</td>'+
                        '<td data-title="Proveedor">'+
                        '<small >'+value.proveedor_nombre+'</small>'+
                        '</td>'+
                        '<td data-title="Monto">'+value.pedidos_montototal+'</td>'+
                        '<td data-title="Fecha">'+convertDateFormat(value.pedidos_fecha)+'</td>'+
                        '<td data-title="Resumen">'+
                        '<p>'+ value.pedidos_resumen.substring(0,15)+'...</p>'+
                        '</td>'+
                        '<td data-title="Opciones">'+

                        '<a id="myLink" onclick="openDetalle('+value.pedidos_id+');return false" class="btn btn-info btn-xs" title="Detalle">'+
                        '<span class="fa fa-paperclip"></span> ' +
                        '</a>'+

                        '<a href="'+site+"admin/pedidos/editar/"+value.pedidos_id+'" class="btn btn-info btn-xs" title="Editar">'+
                        '<span class="fa fa-edit"></span> ' +
                        '</a>'+
                        '<a onclick="return confirm(\'¿Borrar Pedido?\')" href="'+site+"admin/pedidos/borrar/"+value.pedidos_id+'" class="btn btn-danger btn-xs" title="Borrar Pedido?">'+
                        '<span class="fa fa-trash-o"></span> ' +
                        '</a>'+
                        '</td>';

                    trs = trs+ (tr + tds+'</tr>');
                });//fin each

                //console.log(trs);
                $('#mis_pedis').replaceWith('<tbody id="mis_pedis" >'+trs+'</tbody>' );
            }
        });
    }

    function openDetalle(id){
        //console.log('ID:'+id);

        $.ajax({
            url:   '<?php echo site_url()?>admin/pedidos/detalle/'+id,
            type:  'get',
            beforeSend: function () {
                //$('#registrando').html('<h5 id="procesing">Procesando...</h5>');
            },
            success:  function (response) {
                var result = JSON.parse(response);
                //console.log(trs);
                $('#pfech').text( result.pedidos_fecha );
                $('#nproveedor').text(result.proveedor_nombre);
                $('#pmonto').text(result.pedidos_montototal);
                $('#presumen').text(result.pedidos_resumen);

                $('#detalleModal').modal('show');
            }
        });
    }

</script>

