<script src="<?php echo base_url('resources/js/pensionado.js'); ?>"></script>
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
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
<?php $decimales = $parametro["parametro_decimales"]; ?>
<input type="hidden" value="0" id="consumo_id">
<input type="hidden" value="0" id="pensionado_id">
<!-------------------------------------------------------->
<div class="box-header">
                <h3>Pensionados</h3>
                
            	<div class="box-tools">
                    <button type="button" id="boton_pensionado" class="btn btn-info" data-toggle="modal" data-target="#modalpensionado" title="Mostra ventanda de registro de pensionados"><fa class="fa fa-support"></fa></button>
                        <a href='<?php echo base_url("pensionados/despachos"); ?>' class="btn btn-facebook" data-toggle="modal" title="Registro de despachos"><fa class="fa fa-indent"></fa> </a>    
           
                </div>
                
</div>


<div class="row">
    
<div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el título, cantidad, precio total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>C.I.</th>
                        <th>Fecha</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Despacho</th>
                        <th>Monto</th>
                        <th>Forma Pago</th>
                        <th>Estado</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($pensionados as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $p['cliente_nombre']; ?></td>
                        <td><?php echo $p['cliente_ci']; ?></td>
                        <?php $timestamp = strtotime($p['pensionado_fecha']); ?>
                        
                        <td><?php echo date("m/d/Y", $timestamp)." - ".$p['pensionado_hora']; ?></td>
                        <td style="text-align: center;"><?php echo $p['pensionado_id']; ?></td>
                        <td style="text-align: left;"> 
                            <table class="table table-striped table-condensed" >
                                <tr>
                                    <th style="padding: 0;">#</th>
                                    <th style="padding: 0;">ITEM</th>
                                    <th style="padding: 0;">CANT</th>
                                    <th style="padding: 0;">CONS</th>
                                    <th style="padding: 0;">SALDO</th>
                                    <!--<th style="padding: 0;"></th>-->
                                    
                                </tr>
                            <?php  $i = 1;
                                   $ban_saldo = 0;
                                   
                                foreach ($detalle as $d){
                                    
                                   if($p["pensionado_id"]==$d["pensionado_id"]){ 
                                       
                                       $saldo = $d["detallepen_cantidad"] - $d["detallepen_consumido"];
                                       
                                       if ($saldo>0){
                                           $ban_saldo ++;
                                       }
                                       
                                       ?>
                                    <tr>
                                        <td style="text-align: right;"> <?php echo $i++; ?></td>
                                        <td  style="width: 250px; overflow-wrap: break-word;"> <?php echo $d["producto_nombre"]; ?></td>
                                        <td style="text-align: right;"> <?php echo number_format($d["detallepen_cantidad"],2,".",","); ?></td>
                                        <td style="text-align: right;"> <?php echo number_format($d["detallepen_consumido"],2,".",","); ?></td>
                                        <td style="text-align: right; background-color: #dd4b39; color:white;"><b><?php echo number_format($saldo,2,".",","); ?></b></td>

                                    </tr>
                            
                                <?php } } ?>
      
                            </table>
                        </td>
                        <td  style="text-align: center; vertical-align: middle;">
                            <center>                     
                                <?php if($ban_saldo>0){ ?>
                                    <button style="text-align: center; vertical-align: middle;" class="btn btn-sm btn-info" onclick="generar_orden(<?php echo $p['pensionado_id']; ?>)"><fa class="fa fa-cart-plus" title="Generar Orden de Pedido"></fa></button>
                                <?php }else{ ?>
                                    <button style="text-align: center; vertical-align: middle;" class="btn btn-sm btn-danger"><fa class="fa" title="Generar Orden de Pedido"></fa>AGOTADO</button>
                                <?php }?>
                                    
                            </center>
                        </td>
                        
                        
                        <td style="text-align: right;"><?php echo number_format($p['pensionado_total'],2,".",","); ?></td>
                        <td><?php echo $p['tipotrans_nombre']; ?></td>
                        <td><?php echo $p['estado_descripcion']; ?></td>
<!--                        <td>-->
<!--                            <a href="<?php echo site_url('pensionados/edit/'.$p['pensionados_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('pensionados/remove/'.$p['pensionados_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        <!--</td>-->
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


<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL PENSIONADO ------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_pensionado2" class="btn btn-default" data-toggle="modal" data-target="#modalpensionado" >
      Pensionado
    </button>    
</div>

<div class="modal fade" id="modalpensionado" tabindex="-1" role="dialog" aria-labelledby="modalpensionado" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                    <b style="color: white;">REGISTRAR: CONSUMO</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-content" style="font-family: Arial">

                
                
                    <div class="box-body">
                        <div class="col-md-12">
                            <center>
                                <h4><b>REGISTRO DE CONSUMO/PENSIONADO</b></h4>
                            </center>
                            
                            <div class="col-md-6">
                            
                                <label for="glosay" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">SERVICIO</label>
                                <div class="form-group" >
                                    <select id="tiposerv_id" name="tiposerv_id" class="form-control btn btn-warning btn-xs">

                                        <?php
                                            foreach($tipo_servicio as $ts){ ?>
                                                <option value="<?php echo $ts['tiposerv_id']; ?>"><?php echo $ts['tiposerv_descripcion']; ?></option>
                                        <?php } ?>

                                     </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group" >
                            
                                        <label for="glosay" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">MESA</label>
                                        <select id="consumo_numeromesa" name="consumo_numeromesa" class="form-control btn btn-warning btn-xs">
                                                
                                                    <option value="0">- MESAS -</option>
                                            <?php 
                                            
                                                foreach($mesas as $mesa ){ ?>
                                                    <option value="<?php echo $mesa["mesa_id"]; ?>"><?php echo $mesa["mesa_nombre"]; ?></option>
                                            
                                            <?php } ?>
 
                                         </select>
                                </div>
                            </div>
                            

                        </div>
                        
                        <div class="col-md-12" id="tabla_modal">
                            
                        </div>
 
                    </div>

                        <div class="modal-footer" style="text-align: center">

                            <button type="button" class="btn btn-success btn-block" value="Finalizar Registro" onclick="finalizar_registro()"  data-dismiss="modal"><fa class="fa fa-cutlery"></fa> Registrar Pensionado</button>
                            <button type="button" class="btn btn-danger btn-block" id="boton_cerrar_ventatemporal" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
                        </div>                
            </div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL GUARDAR VENTA ------------------------------->
<!------------------------------------------------------------------------------->
