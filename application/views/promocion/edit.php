<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/promocion.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<script>

</script> 
<div class="row">
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Promoción</h3>
            </div>
                <?php echo form_open('promocion/edit/'.$promocion['promocion_id']); ?>
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="producto_id" class="control-label"><span class="text-danger">*</span>Producto</label>
                            <div class="form-group">
                                <input id="vender" type="text" class="form-control" placeholder="Ingresa el nombre de producto"  onkeypress="ventaproducto(event)" value="<?php echo $promocion['producto_nombre']; ?>" readonly/>
                                <input type="hidden" name="producto_id" id="producto_id" value="<?php echo ($this->input->post('producto_id') ? $this->input->post('producto_id') : $promocion['producto_id']); ?>" class="form-control"  required />
                            </div>
                        </div><div class="col-md-6 no-print" id="tablareproducto"></div>
                        
                        <div class="col-md-6">
                                <label for="promocion_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
                                <div class="form-group">
                                        <input type="text" name="promocion_titulo" value="<?php echo ($this->input->post('promocion_titulo') ? $this->input->post('promocion_titulo') : $promocion['promocion_titulo']); ?>" class="form-control" id="promocion_titulo" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        <span class="text-danger"><?php echo form_error('promocion_titulo');?></span>
                                </div>
                        </div>
                        
                        <div class="col-md-2">
                                <label for="promocion_cantidad" class="control-label"><span class="text-danger">*</span>Cantidad</label>
                                <div class="form-group">
                                        <input type="text" name="promocion_cantidad" value="<?php echo ($this->input->post('promocion_cantidad') ? $this->input->post('promocion_cantidad') : $promocion['promocion_cantidad']); ?>" min="0" class="form-control" id="promocion_cantidad" required />
                                        <span class="text-danger"><?php echo form_error('promocion_cantidad');?></span>
                                </div>
                        </div>
                        <div class="col-md-2">
                                <label for="promocion_preciototal" class="control-label"><span class="text-danger">*</span>Precio Total</label>
                                <div class="form-group">
                                        <input type="number" name="promocion_preciototal" value="<?php echo ($this->input->post('promocion_preciototal') ? $this->input->post('promocion_preciototal') : $promocion['promocion_preciototal']); ?>" step="any" min="0" class="form-control" id="promocion_preciototal" required />
                                        <span class="text-danger"><?php echo form_error('promocion_preciototal');?></span>
                                </div>
                        </div>
                        <div class="col-md-5">
                                <label for="promocion_descripcion" class="control-label">Descripción</label>
                                <div class="form-group">
                                        <input type="text" name="promocion_descripcion" value="<?php echo ($this->input->post('promocion_descripcion') ? $this->input->post('promocion_descripcion') : $promocion['promocion_descripcion']); ?>" class="form-control" id="promocion_descripcion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                </div>
                        </div>
                        <div class="col-md-3">
                            <label for="estado_id" class="control-label">Estado</label>
                            <div class="form-group">
                                <select name="estado_id" class="form-control">
                                    <!--<option value="">select estado</option>-->
                                    <?php 
                                    foreach($all_estado as $estado)
                                    {
                                        $selected = ($estado['estado_id'] == $promocion['estado_id']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            
            
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Producto</th>
						<th>Código</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Total</th>
						<th></th>
                    </tr>
                    <?php 
                        $total = 0;
                        $num = 0;
                        foreach($detalle_promocion as $d){ 
                            
                            $total += $d['detallepromo_precio']*$d['detallepromo_cantidad'];
                        ?>
                    <tr>
                            <!--<td><?php echo $d['detallepromo_id']; ?></td>-->
                            <td><?php echo ++$num; ?></td>
                            <td><?php echo $d['producto_nombre']; ?></td>
                            <td><?php echo $d['producto_codigobarra']; ?></td>
                            <td style="text-align: center"><?php echo number_format($d['detallepromo_cantidad'],2,".",","); ?></td>
                            <td style="text-align: right"><?php echo number_format($d['detallepromo_precio'],2,".",",");; ?></td>
                            <td style="text-align: right"><?php echo number_format($d['detallepromo_precio']*$d['detallepromo_cantidad'],2,".",",");; ?></td>
                            <td>
                            <a href="<?php echo site_url('detalle_promocion/edit/'.$d['detallepromo_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> </a> 
                            <a href="<?php echo site_url('detalle_promocion/remove/'.$d['detallepromo_id']."/".$d['promocion_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> </a>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th colspan="5">TOTAL Bs</th>
                        <th><?php echo number_format($total,2,".",",");; ?></th>
                        <th></th>
                    </tr>
                </table>
                
                <input type="text" value="<?php echo $total; ?>" id="promocion_total_final" />
                                
            </div>            
            
            
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                    <a href="<?php echo site_url('promocion'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
        </div>
    </div>
</div>

<!----------------- fin modal preferencias ---------------------------------------------->
<div>
    
<button type="button" id="boton_modal_ingreso" class="btn btn-primary" data-toggle="modal" data-target="#modalingreso" >
  Launch demo modal
</button>
</div>
<!----------------- modal preferencias ---------------------------------------------->

<div class="modal fade" id="modalingreso" tabindex="-1" role="dialog" aria-labelledby="modalingreso" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>BUSCAR PRODUCTOS</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                            </center>
                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive">
                            <input type="text" id="ingresorapido_producto" value="-" class="form-control btn btn-xs btn-default" readonly>
                                        <div class="col-md-6">
                                            <label for="usuario_idx" class="control-label">Cantidad:</label>
                                            
                                            <input type="text" id="ingresorapido_producto_id" value="0.00" hidden />
                                            <input type="text" id="ingresorapido_cantidad" value="0.00" class="form-control btn btn-xs btn-warning" onkeyup="validar(event,11)" />
					</div>
                                        <div class="col-md-6" id='botones'  style='display:block;'>
						<label for="opciones" class="control-label">Opciones</label>
						<div class="form-group">
                                                        
                                                    <button class="btn btn-facebook" id="boton_ingreso_rapido" onclick="guardar_ingreso_rapido()" data-dismiss="modal" >
                                                            <span class="fa fa-floppy-o"></span> Registrar
                                                    </button>
                                                    
                                                    <button class="btn btn-danger" id="cancelar_preferencia" data-dismiss="modal" >
                                                        <span class="fa fa-close"></span>   Cancelar                                                          
                                                    </button>
						</div>
					</div>
                            
                                        <!--------------------- inicio loader ------------------------->
                                        <div class="col-md-6" id='loaderinventario'  style='display: none;'>
                                            <center>
                                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                            </center>
                                        </div> 
                                        <!--------------------- fin inicio loader ------------------------->
                            
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>