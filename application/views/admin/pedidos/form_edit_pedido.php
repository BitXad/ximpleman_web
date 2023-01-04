
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('resources/css/datepicker.min.css')?>">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('resources/css/datepicker3.min.css')?>">

<link href="<?php echo base_url('resources/css/formValidation.css')?>" rel="stylesheet">
<script src="<?php echo base_url('resources/js/formValidation.js');?>"></script>
<script src="<?php echo base_url('resources/js/formValidationBootstrap.js');?>"></script>
<script src="<?php echo site_url('resources/js/bootstrap-datepicker.min.js');?>"></script>

<section class="content-header">
    <h1>
        Editar Pedido
        <small>Plan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?php echo site_url('admin/pedidos')?>">Pedidos</a></li>
        <li class="active">Editar Pedido</li>
    </ol>
</section>

<div class="row">

   <?php
    $hoy = new DateTime();
    $cade =  $hoy->format('Y-m-d');

    $datetime = new DateTime($cade);
    $datetime->modify('+1 day');
    $tomorrow = $datetime->format('Y-m-d');

    $attributes = array("name" => "nuevoPedidoForm", "class"=>"form-horizontal","id"=>"nuevoPedidoForm","method"=>"post");
    echo form_open("admin/pedidos/set", $attributes);
    ?>
    <div class="box-body">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label">Proveedor</label>
            <div class="col-md-4">
                <div class="input-group in-grp1">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <select id="proveedores" class="form-control" name="proveedores">
                        <?php
                        foreach ($proveedores as $prove){
                            if($prove->proveedor_id==$pedido->proveedor_id){
                                echo '<option selected value="'.$prove->proveedor_id.'">'.$prove->proveedor_nombre.'</option>';
                            } else {
                                echo '<option value="'.$prove->proveedor_id.'">'.$prove->proveedor_nombre.'</option>';
                            }
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
            <label class="col-md-4 control-label">Monto Total</label>
            <div class="col-md-4">
                <div class="input-group in-grp1">
                    <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </span>
                    <input type="text" class="form-control input-md" name="monto" id="monto" type="number"  step="0.01" min="1" placeholder="monto total" value="<?php echo $pedido->pedidos_montototal ?>">
                </div>
            </div>
            <div class="col-sm-2 jlkdfj1">
                <p class="help-block"><?php echo form_error('monto'); ?></p>
            </div>
            <div class="clearfix"> </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Fecha</label>
            <div class="col-md-4">
                <div class="input-group input-append date" id="dfini">
                    <input type="text" id="fecha" readonly class="form-control" name="fecha" value="<?php echo $pedido->pedidos_fecha?>">
                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <div class="col-sm-2 jlkdfj1">
                <p class="help-block"><?php echo form_error('fecha'); ?></p>
            </div>
            <div class="clearfix"> </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Resumen</label>
            <div class="col-md-6">
                <textarea class="form-control input-md" rows="11" name="resumen" id="resumen"><?php echo $pedido->pedidos_resumen?></textarea>
            </div>
            <div class="col-sm-2 jlkdfj1">
                <p class="help-block"><?php echo form_error('resumen'); ?></p>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="box-footer">
            <div class="col-md-4">
                <input type="hidden" name="pddsid" value="<?php echo $pedido->pedidos_id?>">
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

        $('#fecha').datepicker({
            autoclose: false,
            format: 'yyyy-mm-dd',
            todayHighlight: true
        }).on('changeDate', function(e) {
            $('#nuevoPedidoForm').formValidation('revalidateField', 'fecha');
        });


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


</script>