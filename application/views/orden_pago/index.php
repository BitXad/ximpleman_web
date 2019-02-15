<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<div class="box-header">
                <h3 class="box-title">Ordenes de Pago</h3>
            	<div class="box-tools">
<!--                    <select class="btn btn-success btn-sm">
                        <option value="1">PENDIENTES</option>
                        <option value="2">CANCELADOS HOY</option>
                        <option value="3">TODOS</option>
                    </select>-->
                    <a href="<?php echo site_url('orden_pago/nueva_orden'); ?>" class="btn btn-facebook btn-sm">Generar Orden</a> 
                    <a href="<?php echo site_url('orden_pago/index'); ?>" class="btn btn-warning btn-sm">Pendientes</a> 
                    <a href="<?php echo site_url('orden_pago/pagadas_hoy'); ?>" class="btn btn-success btn-sm">Pagadas</a> 
                    <a href="<?php echo site_url('orden_pago/pagadas_antes'); ?>" class="btn btn-danger btn-sm">Pag. Antes</a> 
                    
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Pagar a la orden</th>
                                                <th colspan="2">Pagar Bs</th>
						
                                                <th colspan="2">Cancelado Bs</th>
						
						<th></th>
<!--						<th>Estado Id</th>
						<th>Cuota Id</th>
						<th>Compra Id</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Monto</th>
						<th>Motivo</th>
						<th>Fechapago</th>
						<th>Horapago</th>
						<th>Cobradapor</th>
						<th>Ci</th>
						<th>Actions</th>-->
                    </tr>
                    <?php 
                        $cont = 0; $total_pagar = 0; $total_cancelado = 0;
                    foreach($orden_pago as $o){ ++$cont; 
                    $total_pagar +=  $o['orden_monto'];
                    $total_cancelado +=  $o['orden_cancelado']; ?>
                    <tr style="background-color: <?php echo $o['estado_color']; ?>" bgcolor="<?php echo $o['estado_color']; ?>">
                                        <td><?php echo $cont; ?></td>
                                        <td style="background-color: <?php echo $o['estado_color']; ?>" ><font size="3"><b><?php echo $o['orden_destinatario']; ?></b></font>
                                            <br><?php echo $o['orden_motivo']; ?>
                                        </td>
                                        <td >
                                            <img src="<?php echo base_url("resources/images/usuarios/thumb_".$usuario[$o['usuario_id1']-1]['usuario_imagen']); ?>" class="img-circle" width="40" height="40">
                                            <br><sub><?php echo $usuario[$o['usuario_id1']-1]['usuario_nombre']; ?></sub>
                                        </td>
                                        <td align="right">                                            
                                            <font size="3"><b><?php echo number_format($o['orden_monto'],2,".",","); ?></b></font>
                                            <br><?php echo $o['orden_fechapagar']; ?>
                                        </td>
                                            
                                        <td bgcolor= "<?php echo $o['estado_color']; ?>" >

                                        <?php if($o['usuario_id2']!=0){ ?>                                        
                                                    <img src="<?php echo base_url("resources/images/usuarios/thumb_".$usuario[$o['usuario_id2']-1]['usuario_imagen']); ?>" class="img-circle" width="40" height="40">
                                                    <br><sub><?php echo $usuario[$o['usuario_id2']-1]['usuario_nombre']; ?></sub>
                                        <?php }?>                                        
                                        </td>
                                        
                                        
                                        <td align="right" bgcolor= "<?php echo $o['estado_color']; ?>">
                                            
                                            <font size="3"><b><?php echo number_format($o['orden_cancelado'],2,".",","); ?></b></font>
                                            <br><?php echo $o['orden_fechapago']; ?>
                                           
                                        </td>
                                        
<!--                                        <td><?php echo $o['proveedor_id']; ?></td>
                                        <td><?php echo $o['estado_id']; ?></td>
                                        <td><?php echo $o['cuota_id']; ?></td>
                                        <td><?php echo $o['compra_id']; ?></td>
                                        <td><?php echo $o['orden_fecha']; ?></td>
                                        <td><?php echo $o['orden_hora']; ?></td>
                                        <td><?php echo $o['orden_monto']; ?></td>
                                        <td></td>
                                        <td><?php echo $o['orden_fechapago']; ?></td>
                                        <td><?php echo $o['orden_horapago']; ?></td>
                                        <td><?php echo $o['orden_cobradapor']; ?></td>
                                        <td><?php echo $o['orden_ci']; ?></td>-->
                                        <td bgcolor= "<?php echo $o['estado_color']; ?>">

                            <!-- inicio modal -->
                            <?php if ($o['estado_id']==8){?>
                                <span class="btn btn-danger btn-xs"><?php echo $o['estado_descripcion']; ?></span><br>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalpagar<?php echo "00".$o['orden_id']; ?>">
                                <span class="fa fa-money"></span> Pagar
                                </button>
                            <?php }else{ echo $o['orden_cobradapor']."<br>".$o['orden_ci']; ?>
                                        <br><span class="btn btn-facebook btn-xs"><?php echo $o['estado_descripcion']; ?></span>
                            <?php } ?>
                            
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modalpagar<?php echo "00".$o['orden_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    
                                    <?php echo form_open('orden_pago/pagar_orden/'.$o['orden_id']); ?>
                                                                            
                                    <div class="modal-header">
                                      <h3 class="modal-title" id="exampleModalLongTitle">Pagar Orden: <?php echo "00".$o['orden_id']; ?></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      
                                      <div class="row clearfix">
                                            
                                            <div class="col-md-3">
						<label for="orden_monto" class="control-label">Monto Bs</label>
						<div class="form-group">
                                                    <input type="text" name="orden_monto" value="<?php echo number_format($o['orden_monto'],2,".","."); ?>" class="form-control" id="orden_monto" readonly/>
						</div>
                                            </div>
                                          
                                            <div class="col-md-3">
						<label for="orden_cancelado" class="control-label">Pagar Bs</label>
						<div class="form-group">
                                                    <input type="number" min="<?php echo $o['orden_monto']; ?>" step="any" name="orden_cancelado<?php echo $o['orden_id']; ?>" value="<?php echo $o['orden_monto']; ?>" class="form-control" id="orden_monto<?php echo $o['orden_id']; ?>" required/>
						</div>
                                            </div>
                                            <div class="col-md-3">
						<label for="orden_cobradopor" class="control-label">Cobrado por:</label>
						<div class="form-group">
                                                    <input type="text" name="orden_cobradapor<?php echo $o['orden_id']; ?>" value="" class="form-control" id="orden_cobradapor<?php echo $o['orden_id']; ?>"  onKeyUp="this.value = this.value.toUpperCase();" required/>
						</div>
                                            </div>
                                          
                                            <div class="col-md-3">
						<label for="orden_ci" class="control-label">C.I.</label>
						<div class="form-group">
							<input type="text" name="orden_ci<?php echo $o['orden_id']; ?>" value="" class="form-control" id="orden_ci<?php echo $o['orden_id']; ?>" />
						</div>
                                            </div>
                                      </div>
                                      
                                      
                                      
                                      
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Pagar</button>
                                  </div>
                                <?php echo form_close(); ?>
                                </div>
                              </div>
                            </div>                        
                        <!-- fin modal -->
                        
                            
                        </td>
                    </tr>
                    
                    
                    



                    
                    <?php } ?>
                        <tr>
                            <th> </th>
                            <th> </th>
                            <th> </th>
                            <th><?php echo number_format($total_pagar,2,".",","); ?></th>
                            <th> </th>
                            <th><?php echo number_format($total_cancelado,2,".",","); ?></th>
                            <th> </th>
<!--						<th>Estado Id</th>
                            <th>Cuota Id</th>
                            <th>Compra Id</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Monto</th>
                            <th>Motivo</th>
                            <th>Fechapago</th>
                            <th>Horapago</th>
                            <th>Cobradapor</th>
                            <th>Ci</th>
                            <th>Actions</th>-->
                        </tr>                    
                    
                </table>
                                
            </div>
        </div>
    </div>
</div>
