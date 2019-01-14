<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    $('.buscar').removeClass('hidden');
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
                <h3 class="box-title">Compras Completadas</h3>
               
            </div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el codigo, fecha, glosa">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                                          <th>N</th>
                        <th>Proveedor</th>
<!--                        <th>Sub <br>Total</th>
                        <th>Desc.</th>-->
                        <th>Total</th>
                        <th>Fecha<br>Hora</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar hidden">
                    <?php $cont = 0;
                    $bandera = 1;
                    $total = 0;
                          foreach($compra as $c){;
                          $cont = $cont+1;
                       
                          
                         
                            $subto = $c['compra_totalfinal'];
                            $total = $total + $subto;
                    ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <!--<td><?php //echo $p['compra_id']; ?></td>-->
                        <td><font size="3"><b><?php echo $c['proveedor_nombre']; ?></b></font> <br>
                        <span class="btn-info btn-xs"><?php echo $c['tipotrans_nombre']; ?></span>
                        
                                            
                        
                        <td align="right" ><?php echo "Sub Total: ".number_format($c['compra_subtotal'],'2','.',','); ?><br>
                                          <?php echo "Desc.: ".number_format($c['compra_descuento'],'2','.',','); ?><br>
                                          <?php echo "Desc.Global: ".number_format($c['compra_descglobal'],'2','.',','); ?><br>  
                                          <font size="3"><b><?php echo number_format($c['compra_totalfinal'],'2','.',','); ?></b></font></td>
                        
                        <td><?php echo date('d/m/Y',strtotime($c['compra_fecha'])) ; ?><br>
                            <?php echo $c['compra_hora']; ?></td>
                        <td><?php echo $c['estado_descripcion']; ?></td>
                        <td>
                            <!--<a href="<?php echo site_url('compra/edit/'.$c['compra_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>-->
                            <a href="<?php echo site_url('compra/pdf/'.$c['compra_id']); ?>" target="_blank" class="btn btn-success btn-xs"><span class="fa fa-print"></span></a> 
                            <form action="<?php echo base_url('compra/edit/'.$c['compra_id'].'/'.$bandera); ?>"  method="POST" class="form"> 
                            
                                
                                <input type="hidden" id="bandera" name="bandera" value="1" >
                                
                                 <button class="btn btn-info btn-xs" type="submit"><span class="fa fa-pencil"></span></button>
                            </form>
                            
                        </td>
                    </tr>
                    
                    <?php  } ?>

                    <tr>
                    <td></td>    
                    <td align="right"><b>TOTAL</b></td> 
                    <td align="right"><font size="4"><b><?php echo number_format($total,'2','.',','); ?></b></font></td>
                    <td></td>    
                    <td></td>
                    <td></td>
                    </tr>
                    <?php ?>
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
<!--                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el proveedor, fecha, total">
                  </div>-->
            <!--------------------- fin parametro de buscador --------------------->
             
<!--            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
            </div>-->
        </div>
    </div>
</div>
