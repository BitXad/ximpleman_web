<!----------------------------- script buscador --------------------------------------->
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
    <font size='4' face='Arial'><b>Tipo Cliente</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($tipo_cliente); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('tipo_cliente/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Tipo Cliente</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <!--<th>Id</th>-->
                        <th>Descripción</th>
                        <th>Porc.<br>Desc.</th>
                        <th>Monto<br>Desc.</th>
                        <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($tipo_cliente as $t){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $t['tipocliente_descripcion']; ?></td>
                        <td><?php echo $t['tipocliente_porcdesc']; ?></td>
                        <td><?php echo $t['tipocliente_montodesc']; ?></td>
                        <td class="no-print">
                            <a href="<?php echo site_url('tipo_cliente/edit/'.$t['tipocliente_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php //echo site_url('tipo_cliente/remove/'.$t['tipocliente_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
    </div>
</div>
