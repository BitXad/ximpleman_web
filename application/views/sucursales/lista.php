-<?php

/*    print "<pre>";
    print_r($proveedores);
    print "</pre>";*/

?>
<link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap-select.min.css');?>" />
<script src="<?php echo base_url('resources/js/bootstrap-select.js');?>"></script>

<style type="text/css">
    #grupoForm .selectContainer .form-control-feedback {
        /* Adjust feedback icon position */
        right: -15px;
    }
    .dropdown-menu > .active > a,
    .dropdown-menu > .active > a:focus,
    .dropdown-menu > .active > a:hover {
        color: #f9fdfb;
    }

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

    /*nuevo*/

</style>

<div class="box-header">
    <h3 class="box-title">Sucursales</h3>
    <div class="box-tools">
        <a href="" role="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevoModal"
           style="margin:0 0 1em;">
            NUEVA SUCURSAL
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
                $attributes = array("name" => "sucursalForm", "class"=>"form-horizontal","id"=>"sucursalForm","method"=>"post");
                echo form_open("sucursal/create", $attributes);
                ?>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Url</label>
                        <div class="col-md-8">
                            <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-link"></i>
                                </span>
                                <input type="url" class="form-control input-md" name="url" id="url" required placeholder="http://example.com" value="<?php echo set_value('url'); ?>" >
                            </div>
                        </div>
                        <div class="col-sm-2 jlkdfj1">
                            <p class="help-block"><?php echo form_error('url'); ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Ingrese Codigo de la Sucursal(Codigo de Empresa del sistema)</label>
                        <div class="col-md-8">
                            <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="text" class="form-control input-md" name="codigo" id="codigo" required placeholder="codigo" autocomplete="off" value="<?php echo set_value('codigo'); ?>" >
                            </div>
                            <p id="user-result"></p>
                        </div>
                        <p id="codigo-val"><img src="<?php echo base_url('resources/images/loader.gif')?>" /></p>
                        <p class="help-block"><?php echo form_error('codigo'); ?></p>

                        <div class="clearfix"> </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label" for="proveedor">Cuenta Proveedor</label>
                        <div class="col-xs-8 selectContainer">
                            <select class="form-control selectpicker show-tick" data-live-search="true"  name="proveedor" id="proveedor" data-width="100%" data-style="btn-primary">
                                <option value=""></option>
                                <?php
                                foreach ($proveedores as $prov) {
                                    $valores =  $prov->proveedor_id.':'.$prov->proveedor_codigo;
                                    echo '<option value="'.$valores.'">'.$prov->proveedor_nombre.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2 jlkdfj1">
                            <p class="help-block"><?php echo form_error('proveedor'); ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Nombre</label>
                        <div class="col-md-8">
                            <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                                <input type="text" class="form-control input-md" name="nombre" readonly id="nombre" placeholder="nombre sucursal" value="<?php echo set_value('nombre'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-2 jlkdfj1">
                            <p class="help-block"><?php echo form_error('nombre'); ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Codigo Proveedor</label>
                        <div class="col-md-8">
                            <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input type="text" class="form-control input-md" name="token" readonly id="token" placeholder="Codigo" value="<?php echo set_value('token'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-2 jlkdfj1">
                            <p class="help-block"><?php echo form_error('token'); ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-4">
                            <input type="hidden" name="idproveedor" id="idproveedor" value="">
                            <button type="submit"  id="boton" class="btn btn-primary btn-lgs" >Crear</button>
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
                        <th>sucursal</th>
                        <th>url</th>
                        <th>token</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody id="mis_pedis" >
                    <?php
                    $cont =1;

                    foreach ($sucursales as $row){
                        $tr = '<tr class="warning">';
                        echo $tr;

                        ?>
                        <td data-title="Nro"><?php echo $cont++?></td>
                        <td data-title="Sucursal">
                            <small ><?php echo $row->proveedor_nombre?></small>
                        </td>
                        <td data-title="URL">
                            <small ><?php echo $row->sucursal_url?></small>
                        </td>
                        <td data-title="Token"><?php echo $row->proveedor_codigo?></td>

                        <td data-title="Opciones">
                            <a href="<?php echo site_url('sucursal/editar/'.$row->sucursal_id)?>"  class="btn btn-info btn-xs" title="Editar">
                                <span class="fa fa-edit"></span>
                            </a>
                            <a onclick="return confirm('¿Borrar Sucursal?')" class="btn btn-danger btn-xs" href="<?php echo site_url('sucursal/borrar/'.$row->sucursal_id)?>" title="¿Borrar Sucursal?">
                                <span class="fa fa-trash-o"></span>
                            </a>
                        </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>

            </div>
        </div>
        <hr>
    </div>
</div>

<br>

<div class="row">

    <div class="col-xs-12">
        <h3 class="box-title">Sucursal - Reporte</h3>
        <div class="box">
            <div class="box-header">
                <div class="box-tools">
                    <form id="busca-form">
                        <div class="input-group input-group-sm" >
                            <input type="text"  id="buscar"  required class="form-control pull-right" autocomplete="off" placeholder="codigo de barras">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" value="barra"><span class="fa fa-search"> x Barras</span></button>
                                <button type="button" class="btn btn-primary btn-flat" value="codi"><span class="fa fa-search"> x Codigo</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <div class="ajax-load text-center" style="display:none">
                    <p><img src="<?php echo base_url('resources/images/loader.gif')?>" /> Cargando...</p>
                </div>
                <div id='paginacion'></div>
                <table class="table table-bordered table-hover"  id="table_reporte">
                    <thead>
                        <tr>
                            <th>####</th>
                            <th>Codigo Producto</th>
                            <?php
                            foreach ($sucursales as $row){
                                echo '<th scope="col" colspan="2">'.$row->proveedor_nombre.' <br> Cuantos | Costo '.'</th>';
                            }
                            ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id='pagination'></div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>


<div class="modal fade" id="pasoModal" tabindex="-1" role="dialog" aria-labelledby="pasoModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>Codigo Producto: <strong id="codi"></strong></li>
                    <li>Sucursal Origen: <strong id="suc"></strong></li>
                    <li>Cuantos: <strong id="unids"></strong></li>
                    <li>Costo: <strong id="costo"></strong></li>
                    <li>idProveedor: <strong id="idprove"></strong></li>
                </ul>
                <form name="pasoForm" class="form-horizontal" id="pasoForm" method="post" accept-charset="utf-8">
                    <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="unidades">Unidades a Transferir</label>
                        <div class="col-md-8">
                            <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-cart-plus"></i>
                                </span>
                                <input type="number" class="form-control input-md"
                                       required name="unidades" id="unidades" min="1" step="1" max="5" pattern="\d+" value="" >
                            </div>
                        </div>
                        <div class="col-sm-2 jlkdfj1"></div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label" for="sucursal">Sucursal Destino</label>
                        <div class="col-xs-8 selectContainer">
                            <select class="form-control" required name="sucursal" id="sucursal" width="100%" >
                                <option value=""></option>
                                <?php
                                    foreach ($sucursales as $row){
                                        echo '<option id="opt'.$row->sucursal_id.'" value="'.$row->sucursal_id.'">'.$row->proveedor_nombre.'</option>';
                                    }
                                ?>
                            </select>
                            <span id="error-suc" style="color: red">Debe elegir una sucursal diferente a la de origen</span>
                        </div>
                        <div class="col-sm-2 jlkdfj1"></div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="total">Total (bs)</label>
                        <div class="col-md-8">
                            <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                                <input type="number"  class="form-control input-md" name="total" readonly id="total" >
                            </div>
                        </div>
                        <div class="col-sm-2 jlkdfj1">
                            <p class="help-block"><?php echo form_error('nombre'); ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                        <div class="form-group">
                            id_proveedor:<input type="text" id="id_proveedor" value="">
                            sucursal_id:<input type="text" id="sucursal_id" value="">
                        </div>

                    <div class="form-group">
                        <div class="col-md-4">
                            <button type="submit" id="enviar-traspaso" class="btn btn-primary btn-lgs" >Enviar</button>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#error-suc').hide();
        $('#codigo-val').hide();

        $( "#proveedor" ).change(function() {
            var valor = $('#proveedor').val();
            //console.log('elegido es:'+ valor);
            var datos = valor.split(':');

            $('#nombre').val( $("#proveedor option:selected").text());
            $('#token').val(datos[1]);
            $('#idproveedor').val(datos[0]);
        });


        var TIPO = 0;
        /*        $('#buscar').on("input", function() {
                    loadPagination(0);
                });*/
        $("#busca-form button").click(function(ev){
            ev.preventDefault();
            if($(this).attr("value")=="barra"){
                var codi = $('#buscar').val();
                if(codi!=''){
                    TIPO = 0;
                    loadPagination(0,0);
                }
            }
            if($(this).attr("value")=="codi"){
                var codi = $('#buscar').val();
                if(codi!=''){
                    TIPO = 1;
                    loadPagination(0,1);
                }
            }

        });

        $( "#busca-form" ).submit(function( event ) {
            event.preventDefault();
        });


        $('#pagination').on('click','a',function(e){
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            loadPagination(pageno,TIPO);
        });

        $('#paginacion').on('click','a',function(e){
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            loadPagination(pageno,TIPO);
        });

        //loadPagination(0,TIPO);

        function loadPagination(pagno,tipo){
            console.log('pagno:'+pagno+' ,tipo:'+tipo);
            var codi = $('#buscar').val();
            if(codi==''){
                codi='_null_';
            }
            /*            var parametros = {
                            'codi': codi
                        };*/
            $.ajax({
                //data:  parametros,
                url: '<?php echo site_url()?>sucursal/load/'+codi+'/'+tipo+'/'+pagno,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    //$("#buscando").html('<img src="<?php echo base_url('resources/images/loader.gif')?>" />');
                    $('.ajax-load').show();
                },
                success: function(response){
                    $('#paginacion').html(response.pagination);
                    $('#pagination').html(response.pagination);
                    //console.log(response.result);
                    createTable(response.result,response.row);
                    $('.ajax-load').hide();
                }
            });
        }

        function createTable(result,sno){

            sno = Number(sno);

            $('#table_reporte tbody').empty();

            for(index in result){

                var id = result[index].id;

                var codigo = result[index].codigo;

                var sucursales = result[index].sucursales;
                //Local:3,America:4,Colon:6

               // console.log(sucursales);

                var cuantos = sucursales.split(',');

                var tds = '';
                var i;
                var total = 0;
                for (i = 0; i < cuantos.length; i++) {
                    var cc = cuantos[i].split(':');
                    tds += '<td>'+cc[1]+'</td>' +
                        '<td>' +
                        '<h4><span class="label label-primary">'+cc[2]+'</span></h4>' +
                        ' / <button onclick="go('+cc[4]+','+cc[1]+','+cc[2]+','+codigo+','+cc[3]+',\''+cc[0]+'\')" type="button" class="btn btn-info btn-xs">Transferir</button>'+
                        '</td>';
                    total += parseInt(cc[1]);
                }

                //var link = result[index].nombre;
                sno+=1;

                var tr = "<tr>";

                tr += "<td data-title='Nro'>"+ sno +"</td>";
                tr += "<td data-title='Codigo'><span class=\"label label-success\">"+ codigo +"</span></td>";
                tr += tds;
                tr += "<td data-title='Total'>"+ total +"</td>";
                tr += "</tr>";

                $('#table_reporte tbody').append(tr);

            }
        }

    });

    function go(idprove,cuantos,costo,codigo,idsuc,suc) {
        //console.log('codigo: '+codigo+' ,idsuc: '+idsuc+' ,suc: '+suc);
        $('#codi').html(codigo);
        $('#suc').html(suc);
        $('#sucursal_id').val(idsuc);
        $('#unids').html(cuantos);
        $('#costo').html(costo);
        $('#idprove').html(idprove);
        //proveedor_id
        //$('#opt'+idsuc).remove();

        $('#pasoModal').modal('show');
    }

    $("#unidades").on("change paste keyup", function() {
        var unidades =  Math.round($(this).val());
        var unids = $('#unids').html();
        var costo = $('#costo').html();
/*        console.log('unidades: '+unidades);
        console.log('unids: '+unids);*/

        if( parseInt(unidades)<= parseInt(unids) ){
            //console.log('pasa');
            var total = parseFloat(unidades * costo);
            $('#total').val( total );
        } else{
            $('#unidades').val( unids  );
            $('#total').val( parseFloat(unids * costo) );
        }

    });


    $( "#sucursal" ).change(function() {
        var sucusal_id = $('#sucursal').val();
        if(sucusal_id== $('#sucursal_id').val()){
            $('#error-suc').show();
            $('#enviar-traspaso').attr('disabled','true');
        } else {
            $('#error-suc').hide();
            $('#enviar-traspaso').removeAttr('disabled');
        }

    });


    $( "#pasoForm" ).submit(function( event ) {
        event.preventDefault();
        var cliente_nombre = $('#cliente_nombre').val();
        var cliente_codigo = $('#cliente_codigo').val();
        var cliente_ci = $('#cliente_ci').val();
        var cliente_nit = $('#cliente_nit').val();
        var cliente_telefono = $('#cliente_telefono').val();

        var parametros = {
            'cliente_nombre': cliente_nombre,
            'cliente_codigo': cliente_codigo,
            'cliente_ci': cliente_ci,
            'cliente_nit': cliente_nit,
            'cliente_telefono': cliente_telefono,
            'servicio_id': servicio_id
        };

        $.ajax({
            data:  parametros,
            url:   '<?php echo base_url('cliente/create')?>',
            type:  'post',
//                    dataType: "json",
            beforeSend: function () {

            },
            success:  function (response) {
                if(response==1){
                    $('#nombre-cliente').html(cliente_nombre);
                    $('#telefono-cliente').html(cliente_telefono);
                    $('#codigo-cliente').html(cliente_codigo);
                    $('#myModal').modal('hide');
                } else {
                    console.log('error');
                }

            }
        });


    });


    var x_timer;
    $("#codigo").keyup(function (e){
        clearTimeout(x_timer);
        var codigo = $(this).val();
        //if(  isNaN(user_numero) ){
        x_timer = setTimeout(function(){
            check_codigo_ajax(codigo);
        }, 1000);
        //}
    });

    function check_codigo_ajax(codigo){
        var link = $('#url').val();
        var parametros = {
            'codigo':codigo,
            'link': "'"+link+"'"
        };

        $.ajax({
            data:  parametros,
            url:   '<?php echo base_url('sucursal/codigo_correcto')?>',
            type:  'post',
            beforeSend: function () {
                $("#codigo-val").show();
            },
            success:  function (response) {
                console.log(response);
                $("#codigo-val").hide('');
                if(response!=-1){
                    if(response=='1'){
                        console.log('callme');
                        $("#user-result").html('<small style="color: #f0120a;" class="help-block"><i class="fa fa-close"></i> El codigo: '+codigo+' es INVALIDO</small>');
                        $("#sucursalForm").attr('class', 'form-group has-feedback has-error');
                        $("#boton").attr( "disabled","disabled" );
                    }
                    if(response=='0'){
                        $('#codigo-val').hide();
                        $("#user-result").html('<i class="fa fa-check" style="color: #00CC00;"></i>');
                        $("#sucursalForm").attr('class', 'form-group');
                        $("#boton").removeAttr("disabled");
                    }
                }

            }
        });
    }



</script>
