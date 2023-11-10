
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
<!-- <script> var control_ubicaciones = <?= json_encode($control_ubicaciones); ?>; </script>    -->
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Control Inventario</b></font>    
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($control_inventarios); ?></font>
    <div class="box-tools no-print">
        
        <!-- <a href="<?php echo site_url('control_inventario/control_ubicacion'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Inventario</a>  -->
        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modal_ubicacion">Registrar Inventario</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="box-tools">
            <div class=" col-md-12"> <!-- panel panel-primary -->
                <div class="col-md-2">
                    Estado: <select class="btn btn-primary" name="select_estado" id="select_estado" onchange="set_estado()">
                        <option value="0">Todos los estados</option>
                        <?php foreach ($estados as $e){ ?>
                            <option value="<?= $e['estado_id'] ?>"><?= $e['estado_descripcion'] ?></option>
                        <?php } ?>
                    </select>
                </div>    
                <div class="col-md-2">
                    Desde: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" onchange="set_fecha_inicio()">
                </div>
                <div class="col-md-2">
                    Hasta: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" onchange="set_fecha_fin()">
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-sm btn-primary btn-sm btn-block"  type="submit" onclick="buscar_inventario()" style="height: 34px;">
                        <span class="fa fa-search"></span> Buscar
                    </button> 
                </div>
                <div class="col-md-4">
                    <br>
                </div>
            </div>
        </div>

        <div><br><br><br></div>
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> 
            <span class="input-group-addon"> Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
        </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>Inventario</th>
                            <th width="100px">Fecha</th>
                            <th width="150px">Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tabla_inventario">
     
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="modal_ubicacion" tabindex="-1" role="dialog" aria-labelledby="modal_ubicacion" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php echo form_open('control_inventario/add'); ?>
                        <div class="modal-body">                        
                            <label for="inventario_descripcion">Descripci&oacute;n del inventario</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="inventario_descripcion" name="inventario_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Generar"/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript(){}"></script>
<script src="<?= base_url('resources/js/control_ubicacion.js') ?>" type="text/javascript"></script>
