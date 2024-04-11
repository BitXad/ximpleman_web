<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/almacenes.js'); ?>" type="text/javascript"></script>

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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"/>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Almacenes</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: </font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('almacen/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Almacen</a>
    </div>
</div>
<div class="row">    
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre, descripción..">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                
                  <video width="320" height="240" controls>
                    <source src="https://www.ximplemanweb.com/videos/ventas.mp4" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                  </video>              
            </div>
        </div>
    </div>
</div>
