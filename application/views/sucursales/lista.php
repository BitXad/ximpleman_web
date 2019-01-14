
<link href="<?php echo base_url('resources/css/formValidation.css')?>" rel="stylesheet">
<script src="<?php echo base_url('resources/js/formValidation.js');?>"></script>
<script src="<?php echo base_url('resources/js/formValidationBootstrap.js');?>"></script>

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
                                <input type="url" class="form-control input-md" name="url" id="url" placeholder="http://example.com" value="<?php echo set_value('url'); ?>" >
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
                                <input type="text" class="form-control input-md" name="nombre" id="nombre" placeholder="nombre sucursal" value="<?php echo set_value('nombre'); ?>">
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
                                <input type="text" class="form-control input-md" name="token" id="token" placeholder="Token" value="<?php echo set_value('token'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-2 jlkdfj1">
                            <p class="help-block"><?php echo form_error('token'); ?></p>
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
                            <small ><?php echo $row->sucursal_nombre?></small>
                        </td>
                        <td data-title="URL">
                            <small ><?php echo $row->sucursal_url?></small>
                        </td>
                        <td data-title="Token"><?php echo $row->sucursal_token?></td>

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

<div class="box-header">
    <h2 class="box-title">Sucursales - Reporte</h2>
    <div class="box-tools">

        <div class="input-group col-xs-4 pull-right">
            <input type="text"  id="buscar"  class="form-control">
            <span class="input-group-btn">
	            <button type="button" class="btn btn-info btn-flat"><span class="fa fa-search"></span></button>
	        </span>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
/*            print "<pre>";
            print_r( $sucs);
            print "</pre>"*/;
        ?>
        <div class="xs tabls">
            <div id="no-more-tables">
                <div class="ajax-load text-center" style="display:none">
                    <p><img src="<?php echo base_url('resources/images/loader.gif')?>" /> Cargando...</p>
                </div>
                <div id='paginacion'></div>
                <table class="col-md-12 table-bordered table-striped table-condensed cf" id="table_reporte">
                    <thead class="cf">
                    <tr>
                        <th>###</th>
                        <th>ID</th>
                        <th>codigo producto</th>
                        <?php
                            foreach ($sucursales as $row){
                                echo '<th>'.$row->sucursal_nombre.'</th>';
                            }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <div id='pagination'></div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#buscar').on("input", function() {
            //var dInput = this.value;
            loadPagination(0);
        });

        $('#pagination').on('click','a',function(e){
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            loadPagination(pageno);
        });

        $('#paginacion').on('click','a',function(e){
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            loadPagination(pageno);
        });

        loadPagination(1);

        function loadPagination(pagno){
            //console.log('pagno:'+pagno);
            var codi = $('#buscar').val();
            if(codi==''){
                codi='_null_';
            }
/*            var parametros = {
                'codi': codi
            };*/
            $.ajax({
                //data:  parametros,
                url: '<?php echo site_url()?>sucursal/load/'+codi+'/'+pagno,
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
                for (i = 0; i < cuantos.length; i++) {
                    var cc = cuantos[i].split(':');
                    tds += '<td>'+cc[1]+'</td>';
                }

                //var link = result[index].nombre;
                sno+=1;

                var tr = "<tr>";

                tr += "<td data-title='Nro'>"+ sno +"</td>";
                tr += "<td data-title='ID'>"+ id+"</td>";
                tr += "<td data-title='Codigo'>"+ codigo +"</td>";
                tr += tds;
                tr += "</tr>";

                $('#table_reporte tbody').append(tr);

            }
        }


    });


</script>
