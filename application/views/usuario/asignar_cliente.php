<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title"><?php echo $usuario['usuario_nombre'] ?></h3>
            </div>
            <script src='<?php echo base_url() ?>resources/js/jquery-2.1.1.min.js'></script>
            <script>
                $('document').ready(function(){
                $("#marcarTodo").change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
                });
              });
            </script>
			<?php echo form_open('usuario/asignar_cliente/'.$usuario['usuario_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
                                        <div class="col-md-6">
						<div class="form-group">
                                                    <label><input type="checkbox" id="marcarTodo" > Seleccionar Todos</label><br><br>
                                                    <div class="habilitados">
                                                    <?php
								foreach($all_cliente as $cliente)
								{
									echo '<label><input type="checkbox" name="cbox[]" id="cbox" value="'.$cliente['cliente_id'].'">&nbsp'.$cliente['cliente_nombre'].':&nbsp'.$cliente['cliente_nombrenegocio'].'</label><br>';
								} 
                                                    ?>
                                                        <input type="hidden" name="band" value="true">
                                                    </div>
						</div>
				        </div>
			        </div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Asignar Clientes Seleccionados
		</button>
                            <a href="<?php echo site_url('usuario/prevendedores'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Atras</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>