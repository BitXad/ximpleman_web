<script type="text/javascript">
  /*  $(document).ready(function(){
    $("#categoria_id").change(function(){
        var nombre = $("#producto_nombre").val();
        var cad1 = nombre.substring(0,2);
        var categoria = $('#categoria_id option:selected').text();
        var cad2 = categoria.substring(0,1);
        var fecha = new Date();
        var pararand = fecha.getFullYear()+fecha.getMonth()+fecha.getDay();
        var cad3 = Math.floor((Math.random(1001,9999) * pararand));
        var cad = cad1+cad2+cad3;
        $('#producto_codigo').val(cad);
  });
  });
    */
</script>
<script type="text/javascript">
    function cambiarcodproducto(){
        var estetime = new Date();
        var anio = estetime.getFullYear();
        anio = anio -2000;
        var mes = parseInt(estetime.getMonth())+1;
        if(mes>0&&mes<10){
            mes = "0"+mes;
        }
        var hora = estetime.getHours();
        if(hora>0&&hora<10){
            hora = "0"+hora;
        }
        var min = estetime.getMinutes();
        if(min>0&&min<10){
            min = "0"+min;
        }
        var seg = estetime.getSeconds();
        if(seg>0&&seg<10){
            seg = "0"+seg;
        }
        $('#producto_codigobarra').val(anio+mes+hora+min+seg);
        $('#producto_codigo').val(anio+mes+hora+min+seg);
    }
</script>
<script>
      $(document).ready(function () {
          $("#producto_costo").keyup(function () {
              var value = $(this).val();
              $("#producto_precio").val(value/0.8);
          });
      });
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Producto</h3>&nbsp;&nbsp;
                <button type="button" class="btn btn-success btn-sm" onclick="cambiarcodproducto();" title="genera codigo de barra y codigo">
			<i class="fa fa-barcode"></i> Generar Codigos
		</button>
            </div>
            <?php echo form_open_multipart('producto/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                                        <div class="col-md-6">
						<label for="producto_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="producto_nombre" value="<?php echo $this->input->post('producto_nombre'); ?>" class="form-control" id="producto_nombre" required onKeyUp="this.value = this.value.toUpperCase();" />
							<span class="text-danger"><?php echo form_error('producto_nombre');?></span>
						</div>
					</div>
					
                                        <div class="col-md-2">
						<label for="producto_unidad" class="control-label">Unidad</label>
						<div class="form-group">
							<select name="producto_unidad" class="form-control">
								<!--<option value="">- PRESENTACION -</option>-->
								<?php 
								foreach($unidades as $u){ ?>
                                                                    
                                                                    <option value="<?php echo $u['unidad_nombre']; ?>"> <?php echo $u['unidad_nombre']; ?> </option>
                                                                   
									
                                                                <?php } ?>
							</select>
						</div>
                                        </div>
					<div class="col-md-2">
						<label for="producto_marca" class="control-label">Marca</label>
						<div class="form-group">
                                                    <input type="text" name="producto_marca" value="S/N" class="form-control" id="producto_marca" onclick="this.select();"/>
						</div>
					</div>         
					<div class="col-md-2">
						<label for="producto_industria" class="control-label">Industria</label>
						<div class="form-group">
							<input type="text" name="producto_industria" value="<?php echo "BOLIVANA"; ?>" class="form-control" id="producto_industria"  onclick="this.select();"/>
						</div>
					</div>                            

<!--					<div class="col-md-4">
						<label for="presentacion_id" class="control-label">Presentación</label>
						<div class="form-group">
							<select name="presentacion_id" class="form-control">
								<option value="">- PRESENTACION -</option>
								<?php 
								foreach($all_presentacion as $presentacion)
								{
									$selected = ($presentacion['presentacion_id'] == $this->input->post('presentacion_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$presentacion['presentacion_id'].'" '.$selected.'>'.$presentacion['presentacion_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>-->
                                        <div class="col-md-4">
						<label for="producto_codigobarra" class="control-label"><span class="text-danger">*</span>Código de barras</label>
						<div class="form-group">
							<input type="text" name="producto_codigobarra" value="<?php echo $this->input->post('producto_codigobarra'); ?>" class="form-control" id="producto_codigobarra" required  onclick="this.select();"/>
						</div>
					</div>
                                        <div class="col-md-4">
						<label for="producto_codigo" class="control-label"><span class="text-danger">*</span>Código producto</label>
						<div class="form-group">
							<input type="text" name="producto_codigo" value="<?php echo $this->input->post('producto_codigo'); ?>" class="form-control" id="producto_codigo" required  onclick="this.select();"/>
							<span class="text-danger"><?php echo form_error('producto_codigo');?></span>
						</div>
					</div>

                                        <div class="col-md-4">  
						<label for="categoria_id" class="control-label"><span class="text-danger">*</span>Categoria</label>
						<div class="form-group">
                                                    <select name="categoria_id" class="form-control" required id="categoria_id">
								<option value="">- CATEGORIA -</option>
								<?php 
								foreach($all_categoria_producto as $categoria_producto)
								{
									$selected = ($categoria_producto['categoria_id'] == $this->input->post('categoria_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$categoria_producto['categoria_id'].'" '.$selected.'>'.$categoria_producto['categoria_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>


					<div class="col-md-3">
						<label for="moneda_id" class="control-label"><span class="text-danger">*</span>Moneda</label>
						<div class="form-group">
							<select name="moneda_id" class="form-control" required>
								<!--<option value="">- MONEDA -</option>-->
								<?php 
								foreach($all_moneda as $moneda)
								{
									$selected = ($moneda['moneda_id'] == $this->input->post('moneda_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>



					

					<div class="col-md-3">
						<label for="producto_costo" class="control-label">Precio de Compra</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="producto_costo" value="<?php echo '0.00'; ?>" class="form-control" id="producto_costo"  onclick="this.select();"/>
						</div>
					</div>
					<div class="col-md-3">
						<label for="producto_precio" class="control-label">Precio de Venta</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="producto_precio" value="<?php echo '0.00'; ?>" class="form-control" id="producto_precio"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_comision" class="control-label">Comision (%)</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="producto_comision" value="<?php echo '0.00'; ?>" class="form-control" id="producto_comision"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-3" hidden>
						<label for="producto_tipocambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="producto_tipocambio" value="1" class="form-control" id="producto_tipocambio" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="producto_factor" class="control-label">Factor</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="producto_factor" value="<?php echo "0.00"; ?>" class="form-control" id="producto_factor"  onclick="this.select();"/>
						</div>
					</div>

<!--                                        <div class="col-md-3">
						<label for="producto_unidadfactor" class="control-label">Unidad Factor</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="producto_unidadfactor" value="<?php echo "0.00"; ?>" class="form-control" id="producto_unidadfactor"  onclick="this.select();"/>
						</div>
					</div>-->
                                        <div class="col-md-3">
						<label for="producto_unidadfactor" class="control-label">Unidad Factor</label>
						<div class="form-group">
							<select name="producto_unidadfactor" class="form-control">
								<option value="">- UNIDAD FACTOR -</option>
								<?php 
								foreach($unidades as $u){ ?>
                                                                    
                                                                    <option value="<?php echo $u['unidad_nombre']; ?>"> <?php echo $u['unidad_nombre']; ?> </option>
                                                                   
									
                                                                <?php } ?>
							</select>
						</div>
                                        </div>


					<div class="col-md-3">
						<label for="producto_codigofactor" class="control-label">Codigo Factor</label>
						<div class="form-group">
							<input type="text" step="any" min="0" name="producto_codigofactor" value="<?php echo $this->input->post('producto_codigofactor'); ?>" class="form-control" id="producto_codigofactor"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_preciofactor" class="control-label">Precio Unit. Factor</label>
						<div class="form-group">
							<input type="text" step="any" min="0" name="producto_preciofactor" value="<?php echo $this->input->post('producto_preciofactor'); ?>" class="form-control" id="producto_preciofactor"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_cantidadminima" class="control-label">Cant. Minima</label>
						<div class="form-group">
							<input type="text" step="any" min="0" name="producto_cantidadminima" value="<?php echo "0.00"; ?>" class="form-control" id="producto_cantidadminima"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_ultimocosto" class="control-label">Ultimo Costo</label>
						<div class="form-group">
							<input type="text" step="any" min="0" name="producto_ultimocosto" value="<?php echo "0.00"; ?>" class="form-control" id="producto_ultimocosto"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_foto" class="control-label">Foto</label>
						<div class="form-group">
                                                        <input type="file" name="producto_foto" value="<?php echo "producto.jpg"; ?>" class="btn btn-success btn-sm form-control" id="producto_foto" accept="image/png, image/jpeg, jpg, image/gif" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                    <a href="<?php echo site_url('producto/index'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i>Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>

