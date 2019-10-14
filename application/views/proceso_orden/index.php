<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/proceso_orden.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
                <h3 class="box-title">OT EN PROCESO</h3>
            	<div class="box-tools">
                    
                </div>
</div>
<div class="row">
  <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
  <input type="hidden" name="estado" id="estado" value="">
    <div class="col-md-12">
     
                        <?php 
                        foreach($estados as $estado)
                        { ?>
                            <button class="btn btn-warning" onclick="buscarorden(<?php echo $estado['estado_id']; ?>)"><?php echo $estado['estado_descripcion']; ?></button>
                         
                        
                        <?php }  ?>
                  
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
						<th>OT</th>
						<th>Cliente</th>
            <th>Proceso</th>
						<th>Fecha Inicio</th>
            <th>Estado</th>
            <th></th>
                    </tr>
                    <tbody class="buscar" id="tablaproceso">
                  
                </table>
                                
            </div>
        </div>
    </div>
</div>
