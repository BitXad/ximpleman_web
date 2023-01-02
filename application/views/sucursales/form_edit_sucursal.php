<link href="<?php echo base_url('resources/css/formValidation.css')?>" rel="stylesheet">
<script src="<?php echo base_url('resources/js/formValidation.js');?>"></script>
<script src="<?php echo base_url('resources/js/formValidationBootstrap.js');?>"></script>
<link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap-select.min.css');?>" />
<script src="<?php echo base_url('resources/js/bootstrap-select.js');?>"></script>

<section class="content-header">

</section>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Editar Sucursal</h3>
            </div>

            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo site_url('sucursal')?>">Sucursales</a></li>
                <li class="active">Editar Sucursal</li>
            </ol>

            <?php
                $attributes = array("name" => "sucursalForm", "class"=>"form-horizontal","id"=>"sucursalForm","method"=>"post");
                echo form_open("sucursal/set", $attributes);
            ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Url</label>
                        <div class="col-md-8">
                            <div class="input-group in-grp1">
                            <span class="input-group-addon">
                                <i class="fa fa-link"></i>
                            </span>
                                <input type="url" class="form-control input-md" name="url" id="url" required placeholder="http://example.com" value="<?php echo $sucursal->sucursal_url ?>" >
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
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
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
                                    if($sucursal->id_proveedor==$prov->proveedor_id){
                                        echo '<option value="'.$valores.'" selected>'.$prov->proveedor_nombre.'</option>';
                                    } else {
                                        echo '<option value="'.$valores.'">'.$prov->proveedor_nombre.'</option>';
                                    }
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
                        <input type="hidden" name="idproveedor" id="idproveedor" value="">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" id="boton" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
                <a href="javascript:history.back()"><button type="button" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar
                    </button></a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {

        $('#error-suc').hide();
        $('#codigo-val').hide();


        var valor1 = $('#proveedor').val();
        //console.log('elegido es:'+ valor);
        var datos1 = valor1.split(':');

        $('#nombre').val( $("#proveedor option:selected").text());
        $('#token').val(datos1[1]);
        $('#idproveedor').val(datos1[0]);


        $( "#proveedor" ).change(function() {
            var valor = $('#proveedor').val();
            //console.log('elegido es:'+ valor);
            var datos = valor.split(':');

            $('#nombre').val( $("#proveedor option:selected").text());
            $('#token').val(datos[1]);
            $('#idproveedor').val(datos[0]);
        });

        $('#sucursalForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                url:{
                    validators:{
                        notEmpty: {
                            message: 'Url es un campo requerido'
                        }
                    }
                },

                token: {
                    validators: {
                        notEmpty: {
                            message: 'Token es un campo requerido'
                        }
                    }
                },

                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Nombre es un campo requerido'
                        },

                        stringLength: {
                            min: 2,
                            max: 150,
                            message: 'Nombre: al menos 1 caracter y maximo 6'
                        }
                    }
                }
            }
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
                            //console.log('callme');
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

    });

</script>