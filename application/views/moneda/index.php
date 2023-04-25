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

        <?php $decimales = $parametro['parametro_decimales']; ?>
        <input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales"  hidden>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Moneda</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($moneda); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('moneda/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Moneda</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción, tipo c.">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <!--<th>Id</th>-->
                            <th>Descripción</th>
                            <th>T. C.</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $cont = 0;
                            foreach($monedas as $m){;
                                    $cont = $cont+1; ?>
                        <tr>
                            <td><?php echo $cont ?></td>
                            <!--<td><?php //echo $m['moneda_id']; ?></td>-->
                            <td><?php echo $m['moneda_descripcion']; ?></td>
                            <td><?php echo number_format($m['moneda_tc'],$decimales,".",","); ?></td>
                            <td style="background-color: #<?php echo $m['estado_color'];?>"><?php echo $m['estado_descripcion']; ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('moneda/edit/'.$m['moneda_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                                <!--<a href="<?php echo site_url('moneda/remove/'.$m['moneda_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
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
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mitabla').DataTable({
            language: {
                processing:     "Tratamiento en curso...",
                search:         "Buscar ",
                lengthMenu:     "Mostrar _MENU_ elementos ",
                info:           "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
                infoEmpty:      "Visualización del elemento 0 a 0 de 0 elementos",
                infoFiltered:   "(filtro de _MAX_ elementos en total)",
                infoPostFix:    "",
                loadingRecords: "Cargando...",
                zeroRecords:    "No hay elementos para mostrar",
                emptyTable:     "No hay datos disponibles en la tabla.",
                paginate: {
                    first:      "primero",
                    previous:   "Anterior",
                    next:       "Próximo",
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": activar para ordenar la columna en orden ascendente",
                    sortDescending: ": activar para ordenar la columna en orden descendente"
                }
            }
        });
    } );
</script>
