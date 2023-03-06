<!-- --------------------------- script buscador ------------------------------------- -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('resources/js/objetivo.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script>
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

<style type="text/css">
    #contieneimg{
        width: 100px;
        height: 100px;
        text-align: center;
    }
</style>

<input type="text" id="parametro_decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="parametro_decimales"  hidden>

<!-- --------------------------- fin script buscador ------------------------------------- -->
<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>

<div class="box-header">
    
            	<div class="box-tools">
                    <a href="<?php echo site_url('objetivo/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
        
            <font size='4' face='Arial'><b>Objetivos</b></font>

        
</div>


<div class="row">
    
    <!--<p style="margin-left: 20px;" class="text-danger">      <?php //echo $mensaje; ?></p>-->
    <div class="col-md-12">
        <!---- ----------------- parametro de buscador ------------------- -->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, login, email">
        </div>
        <div class=row>
            <div class="col-md-2">
                <input type="date" value="<?= date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha" name="fecha" >
            </div>
            <div class="col-md-1">
                <a class="btn btn-facebook btn-sm form-control" title="Ver objetivos por fecha" onclick="tabla_objetivos()"><i class="fa fa-search"> </i> Buscar</a>
            </div>
        </div>
            <!-- ------------------- fin parametro de buscador ------------------- -->
        <div class="box">
            <?php if($this->session->flashdata('msg')): ?>
                <p><?php echo $this->session->flashdata('msg'); ?></p>
            <?php endif; ?>
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2">#</th>
                            <th class="text-center" rowspan="2">Imagen</th>
                            <th rowspan="2">Nombre/Usuario</th>
                            <th colspan="4" rowspan="1">Ventas</th>
                            <th colspan="2" rowspan="1">Pedidos</th>
                            <th colspan="1" rowspan="2">Estado</th>
                            <th colspan="1" rowspan="2"></th>
                        </tr>
                        <tr>
                            <th class="text-center">Minimo</th>
                            <th class="text-center">Aceptable</th>
                            <th class="text-center">Diario</th>
                            <th class="text-center">Mensual</th>
                            <th class="text-center">Diario</th>
                            <th class="text-center">Mensual</th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tabla_objetivos">
                            
                    </tbody> 
                </table>

            </div>
            <div class="pull-right">    
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>

<?php
if(isset($mensaje)){
    if($mensaje == "a"){
?>
<script type="text/javascript">
    alert("Contraseña modificada con exito");
</script>
<?php
$mensaje = "";
    }elseif($mensaje == "b"){
?>
<script type="text/javascript">
    alert("Las contraseñas no coinciden");
</script>
<?php
$mensaje = "";
    }
}
?>