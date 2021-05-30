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
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<!--<h3 class="box-title">Formula</h3>-->
<div class="box-header">
<!--                <h3 class="box-title">Usuarios</h3>-->
            	<div class="box-tools">
                    <a href="<?php echo site_url('formula/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
        
            <font size='4' face='Arial'><b>Formulas</b></font>
            <br><font size='2' face='Arial' id="encontrados">Registros Encontrados:<?php echo sizeof($formula);  ?></font> 
        
</div>

<div class="col-md-12">
    
    <div class="col-md-12">

    <!---- ----------------- parametro de buscador ------------------- -->
          <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, login, email">
          </div>
    <!-- ------------------- fin parametro de buscador ------------------- -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        
            <div class="box">
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Formula</th>
						<th>Unidad</th>
						<th>Cantidad</th>
						<th>Costo<br>unidad</th>
						<th>Precio<br>unidad</th>
						<th></th>
                    </tr>
                    <?php foreach($formula as $f){ ?>
                    <tr>
						<td><?php echo $f['formula_id']; ?></td>
						<td><?php echo $f['formula_nombre']; ?></td>
						<td><?php echo $f['formula_unidad']; ?></td>
						<td><?php echo $f['formula_cantidad']; ?></td>
						<td><?php echo $f['formula_costounidad']; ?></td>
						<td><?php echo $f['formular_preciounidad']; ?></td>
						<td>
                            <a href="<?php echo site_url('formula/edit/'.$f['formula_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('formula/remove/'.$f['formula_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
