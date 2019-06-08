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
    <h3 class="box-title">Destino Producto</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('destino_producto/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
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
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                    $i = 0;
                    foreach($destino_producto as $d){
                    ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $d['destino_nombre']; ?></td>
                        <td>
                            <a href="<?php echo site_url('destino_producto/edit/'.$d['destino_id']); ?>" class="btn btn-info btn-xs" title="Editar Destino Trabajo"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php // echo site_url('destino_producto/remove/'.$d['destino_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>-->
                        </td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
