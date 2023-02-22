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
<script type="text/javascript">
    function cerrarventana(){
        window.close();
    }
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<!-------------------------------------------------------->
<div class="box-header">
                <h3 class="box-title"><?php echo "<b>".$producto_nombre."</b>"; ?> asignados a las siguentes subcategorias:</h3>
            </div>
<div class="row">
    <div class="col-md-12">
        
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre subcategoria">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
            <div class="box">
            <div class="box-body  table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Subcategoria</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $i = 1;
                          foreach($all_productosubcategoria as $c){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $c['subcatserv_descripcion']; ?></td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
<a onclick="cerrarventana()" class="btn btn-danger">
    <i class="fa fa-times"></i> Cerrar</a>
                    