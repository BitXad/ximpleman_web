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
                <h3 class="box-title">Cuota</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('cuotum/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el credito, num. cuota, fecha limite">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                                                <th>Num.</th>
                                                
                        <th>Credito</th>
                       
                        <th>Num. Cuota</th>
                        <th>Capital</th>
                        <th>Interes</th>
                        <th>Mora Dias</th>
                        <th>Multa</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Fecha Limite</th>
                        <th>Cancelado</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Num.recibo</th>
                        <th>Saldo</th>
                        <th>Glosa</th>
                        <th>Operaciones</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($cuota as $c){;
                                 $cont = $cont+1;?>
                    <tr>
                        <td><?php echo $cont ?></td>
                                                <td><?php echo $c['credito_id']; ?></td>
                        
                        <td><?php echo $c['cuota_numcuota']; ?></td>
                        <td><?php echo $c['cuota_capital']; ?></td>
                        <td><?php echo $c['cuota_interes']; ?></td>
                        <td><?php echo $c['cuota_moradias']; ?></td>
                        <td><?php echo $c['cuota_multa']; ?></td>
                        <td><?php echo $c['cuota_subtotal']; ?></td>
                        <td><?php echo $c['cuota_descuento']; ?></td>
                        <td><?php echo $c['cuota_total']; ?></td>
                        <td><?php echo $c['cuota_fechalimite']; ?></td>
                        <td><?php echo $c['cuota_cancelado']; ?></td>
                        <td><?php echo $c['cuota_fecha']; ?></td>
                        <td><?php echo $c['cuota_hora']; ?></td>
                        <td><?php echo $c['cuota_numercibo']; ?></td>
                        <td><?php echo $c['cuota_saldo']; ?></td>
                        <td><?php echo $c['cuota_glosa']; ?></td>
                        <td>
                            <a href="<?php echo site_url('cuotum/edit/'.$c['cuota_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('cuotum/remove/'.$c['cuota_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>               
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
            </div>
        </div>
    </div>
</div>
