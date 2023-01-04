<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
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
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>C&oacute;digos de Unidad Medida</b></font>
    <div class="box-tools no-print">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
        </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CODIGO</th>
                            <th>DESCRIPCION</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php 
                        $i=1;
                        foreach ($datos as $sincronizacion) {?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $sincronizacion['unidad_codigo'] ?></td>
                                <td><span id="la_unidad<?php echo $sincronizacion['unidad_codigo']; ?>"><?= $sincronizacion['unidad_nombre'] ?></span></td>
                                <td><button class="btn btn-info btn-xs" onclick="cargar_datosunidad(<?= $sincronizacion['unidad_codigo'] ?>)"><fa class="fa fa-bomb"> </fa> Homologar</button></td>
                            </tr>
                        <?php
                            $i++; 
                        }
                    ?>
                    </tbody>
                </table>                                
            </div>
            <a href="<?= site_url('sincronizacion/') ?>" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<div class="modal fade" id="modalunidad" tabindex="-1" role="dialog" aria-labelledby="modalunidad" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center" style="background: #3399cc">
                <b style="color: white;">HOMOLOGACIÓN DE PRODUCTOS</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    La unidad de medida: <span class="text-bold" id="nombre_unidad"></span> a la categoria:<br>
                    <!--<label for="categoria_id" class="control-label"><span class="text-danger">*</span>Categorías</label>-->
                    <input type="hidden" name="unidad_codigo" id="unidad_codigo" />
                    <br>
                    <select name="categoria_id" class="form-control" id="categoria_id">
                        <option value="0">- APLICAR A TODAS LAS CATEGORIAS -</option>
                        <?php 
                            foreach($categorias as $categoria){ ?>
                                <option value="<?php echo $categoria['categoria_id']; ?>">    
                                    <?php echo $categoria['categoria_nombre']; ?>
                                </option>
                        <?php    } ?>
                    </select>
                    <br>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="homologar_categoriaunidad()"><fa class="fa fa-floppy-o"></fa> Actualizar Codigo</button>
                <button type="button" class="btn btn-danger" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>