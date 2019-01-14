
<link href="<?php echo base_url('resources/css/formValidation.css')?>" rel="stylesheet">
<script src="<?php echo base_url('resources/js/formValidation.js');?>"></script>
<script src="<?php echo base_url('resources/js/formValidationBootstrap.js');?>"></script>

<section class="content-header">
    <h1>
        Editar Pedido
        <small>Plan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?php echo site_url('sucursal')?>">Sucursales</a></li>
        <li class="active">Editar Sucursal</li>
    </ol>
</section>

<div class="row">

   <?php

    $attributes = array("name" => "sucursalForm", "class"=>"form-horizontal","id"=>"sucursalForm","method"=>"post");
    echo form_open("sucursal/set", $attributes);
    ?>
    <div class="box-body">
        <fieldset>
            <div class="form-group">
                <label class="col-md-3 control-label">Url</label>
                <div class="col-md-8">
                    <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-link"></i>
                                </span>
                        <input type="url" class="form-control input-md" name="url" id="url" placeholder="http://example.com" value="<?php echo $sucursal->sucursal_url ?>" >
                    </div>
                </div>
                <div class="col-sm-2 jlkdfj1">
                    <p class="help-block"><?php echo form_error('url'); ?></p>
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
                        <input type="text" class="form-control input-md" name="nombre" id="nombre" placeholder="nombre sucursal" value="<?php echo $sucursal->sucursal_nombre ?>">
                    </div>
                </div>
                <div class="col-sm-2 jlkdfj1">
                    <p class="help-block"><?php echo form_error('nombre'); ?></p>
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Token</label>
                <div class="col-md-8">
                    <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                        <input type="text" class="form-control input-md" name="token" id="token" placeholder="Token" value="<?php echo $sucursal->sucursal_token ?>">
                    </div>
                </div>
                <div class="col-sm-2 jlkdfj1">
                    <p class="help-block"><?php echo form_error('token'); ?></p>
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <input type="hidden" name="idsuc" value="<?php echo $sucursal->sucursal_id?>">
                    <button type="submit"  class="btn btn-primary btn-lgs" >Actualizar</button>
                </div>
                <div class="clearfix"> </div>
            </div>
        </fieldset>
    </div>
    <?php echo form_close(); ?>

</div>
<script>
    $(document).ready(function() {



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

    });


</script>