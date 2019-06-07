
<script type="text/javascript">
    function cambiarcodproducto(){
        var estetime = new Date();
        var anio = estetime.getFullYear();
        anio = anio -2000;
        var mes = parseInt(estetime.getMonth())+1;
        if(mes>0&&mes<10){
            mes = "0"+mes;
        }
        var dia = parseInt(estetime.getDate());
        if(dia>0&&dia<10){
            dia = "0"+dia;
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
        $('#producto_codigobarra').val(anio+mes+dia+hora+min+seg);
        $('#producto_codigo').val(anio+mes+dia+hora+min+seg);
    }

     function loader() {
     	$("form").submit(function() {
   document.getElementById('loader').style.display = 'block'; //ocultar el bloque del loader 
});
        }
</script>
<script>
      function verificar_precio(){
              var venta = $("#producto_precio").val();
              var costo = $("#producto_costo").val();
              if(costo >= venta){
                  alert("El Precio de Compra es mayor o igual a Precio de Venta");
              }
      };
      function loader() {
     	$("form").submit(function() {
   document.getElementById('loader').style.display = 'block'; //ocultar el bloque del loader 
});
        }
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Producto</h3>&nbsp;&nbsp;
                <button type="button" class="btn btn-success btn-sm" onclick="cambiarcodproducto();" title="Volver a generar Código y Código de barras">
			<i class="fa fa-edit"></i> Generar Código
		</button>
            </div>
            <div class="row" id='loader'  style='display:none; text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
            <?php echo form_open_multipart('producto/edit/'.$producto['producto_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
						<label for="producto_nombre" class="control-label"><span class="text-danger">*</span>Producto</label>
						<div class="form-group">
							<input type="text" name="producto_nombre" value="<?php echo ($this->input->post('producto_nombre') ? $this->input->post('producto_nombre') : $producto['producto_nombre']); ?>" class="form-control" id="producto_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
							<span class="text-danger"><?php echo form_error('producto_nombre');?></span>
						</div>
					</div>
                                    
                                    <div class="col-md-2">
                                        <label for="producto_unidad" class="control-label">Unidad</label>
                                        <div class="form-group">
                                            <select name="producto_unidad" class="form-control">
                                                <option value="">- UNIDAD -</option>
                                                <?php 
                                                foreach($unidades as $unidad)
                                                {
                                                    $selected = ($unidad['unidad_nombre'] == $producto['producto_unidad']) ? ' selected="selected"' : "";

                                                    echo '<option value="'.$unidad['unidad_nombre'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
					<div class="col-md-2">
						<label for="producto_marca" class="control-label">Marca</label>
						<div class="form-group">
							<input type="text" name="producto_marca" value="<?php echo ($this->input->post('producto_marca') ? $this->input->post('producto_marca') : $producto['producto_marca']); ?>" class="form-control" id="producto_marca" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="producto_industria" class="control-label">Industria</label>
						<div class="form-group">
							<input type="text" name="producto_industria" value="<?php echo ($this->input->post('producto_industria') ? $this->input->post('producto_industria') : $producto['producto_industria']); ?>" class="form-control" id="producto_industria" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
                                    
                                        <div class="col-md-4">
						<label for="producto_codigobarra" class="control-label"><span class="text-danger">*</span>Código de barras</label>
						<div class="form-group">
                                                    <input type="text" name="producto_codigobarra" value="<?php echo ($this->input->post('producto_codigobarra') ? $this->input->post('producto_codigobarra') : $producto['producto_codigobarra']); ?>" class="form-control" id="producto_codigobarra" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" required />
						</div>
					</div>                                    
					<div class="col-md-4">
						<label for="producto_codigo" class="control-label"><span class="text-danger">*</span>Código Producto</label>
						<div class="form-group">
							<input type="text" name="producto_codigo" value="<?php echo ($this->input->post('producto_codigo') ? $this->input->post('producto_codigo') : $producto['producto_codigo']); ?>" class="form-control" id="producto_codigo" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
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
									$selected = ($categoria_producto['categoria_id'] == $producto['categoria_id']) ? ' selected="selected"' : "";

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
								<option value="">- MONEDA -</option>
								<?php 
								foreach($all_moneda as $moneda)
								{
									$selected = ($moneda['moneda_id'] == $producto['moneda_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					
					<div class="col-md-3">
						<label for="producto_costo" class="control-label">Precio de Compra</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="producto_costo" value="<?php echo ($this->input->post('producto_costo') ? $this->input->post('producto_costo') : $producto['producto_costo']); ?>" class="form-control" id="producto_costo" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="producto_precio" class="control-label">Precio de Venta</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="producto_precio" value="<?php echo ($this->input->post('producto_precio') ? $this->input->post('producto_precio') : $producto['producto_precio']); ?>" class="form-control" id="producto_precio" onchange="verificar_precio();" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_comision" class="control-label">Comisión (%)</label>
						<div class="form-group">
							<input type="number" step="any" min="0" max="100" name="producto_comision" value="<?php echo ($this->input->post('producto_comision') ? $this->input->post('producto_comision') : $producto['producto_comision']); ?>" class="form-control" id="producto_comision"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_factor" class="control-label">Factor</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="producto_factor" value="<?php echo ($this->input->post('producto_factor') ? $this->input->post('producto_factor') : $producto['producto_factor']); ?>" class="form-control" id="producto_factor"  onclick="this.select();"/>
						</div>
					</div>

                                        <div class="col-md-3">
						<label for="producto_unidadfactor" class="control-label">Unidad Factor</label>
						<div class="form-group">
							<select name="producto_unidadfactor" class="form-control">
								<option value="">- UNIDAD -</option>
								<?php 
								foreach($unidades as $unidad)
								{
									$selected = ($unidad['unidad_nombre'] == $producto['producto_unidadfactor']) ? ' selected="selected"' : "";

									echo '<option value="'.$unidad['unidad_nombre'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>


					<div class="col-md-3">
						<label for="producto_codigofactor" class="control-label">Codigo Factor</label>
						<div class="form-group">
							<input type="text" step="any" min="0" name="producto_codigofactor" value="<?php echo ($this->input->post('producto_codigofactor') ? $this->input->post('producto_codigofactor') : $producto['producto_codigofactor']); ?>" class="form-control" id="producto_codigofactor"  onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_preciofactor" class="control-label">Precio Unit. Factor</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="producto_preciofactor" value="<?php echo ($this->input->post('producto_preciofactor') ? $this->input->post('producto_preciofactor') : $producto['producto_preciofactor']); ?>" class="form-control" id="producto_preciofactor"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-2">
						<label for="producto_cantidadminima" class="control-label">Cant. Minima</label>
						<div class="form-group">
							<input type="text" step="any" min="0" name="producto_cantidadminima" value="<?php echo ($this->input->post('producto_cantidadminima') ? $this->input->post('producto_cantidadminima') : $producto['producto_cantidadminima']); ?>" class="form-control" id="producto_cantidadminima"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-2">
						<label for="producto_ultimocosto" class="control-label">Ultimo Costo</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="producto_ultimocosto" value="<?php echo ($this->input->post('producto_ultimocosto') ? $this->input->post('producto_ultimocosto') : $producto['producto_ultimocosto']); ?>" class="form-control" id="producto_ultimocosto"  onclick="this.select();"/>
						</div>
					</div>

					<div class="col-md-3">
						<label for="producto_foto" class="control-label">Foto</label>
						<div class="form-group">
                                                    <input type="file" name="producto_foto" value="<?php echo ($this->input->post('producto_foto') ? $this->input->post('producto_foto') : $producto['producto_foto']); ?>" class="btn btn-success btn-sm form-control" id="producto_foto" accept="image/png, image/jpeg, jpg, image/gif" />
                                                    <input type="hidden" name="producto_foto1" value="<?php echo ($this->input->post('producto_foto') ? $this->input->post('producto_foto') : $producto['producto_foto']); ?>" class="form-control" id="producto_foto1" />
						</div>
					</div>

<!--					<div class="col-md-6">
						<label for="producto_tipocambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="producto_tipocambio" value="<?php echo ($this->input->post('producto_tipocambio') ? $this->input->post('producto_tipocambio') : $producto['producto_tipocambio']); ?>" class="form-control" id="producto_tipocambio" />
						</div>
					</div>-->

                    <div class="col-md-5">
                        <label for="producto_caracteristicas" class="control-label">Características</label>
                        <div class="form-group">
                            <textarea rows="1" type="texarea" name="producto_caracteristicas" value="" class="form-control" id="producto_caracteristicas" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" ><?php echo ($this->input->post('producto_caracteristicas') ? $this->input->post('producto_caracteristicas') : $producto['producto_caracteristicas']); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="producto_envase" class="control-label">Envase Retornable</label>
                        <div class="form-group">
                            <select name="producto_envase" id="producto_envase" class="form-control">
                                <?php
                                $select1 = "";
                                $select2 = "";
                                if($producto['producto_envase'] == 0){ $select1 = "selected"; }
                                if($producto['producto_envase'] == 1){ $select2 = "selected"; }
                                ?>
                                <option value="0" <?php echo $select1; ?> >Sin Envase Retornable</option>
                                <option value="1" <?php echo $select2; ?> >Con Envase Retornable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="producto_nombreenvase" class="control-label">Nombre de Envase</label>
                        <div class="form-group">
                            <select name="producto_nombreenvase" class="form-control" id="producto_nombreenvase" >
                                <option value="">- SELECCIONE ENVASE -</option>
                                <?php 
                                foreach($unidades as $unidad)
                                {
                                    $selected = ($unidad['unidad_nombre'] == $producto['producto_nombreenvase']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$unidad['unidad_nombre'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="producto_costoenvase" class="control-label">Costo de Envase</label>
                        <div class="form-group">
                            <input type="number" step="any" min="0" name="producto_costoenvase" value="<?php echo ($this->input->post('producto_costoenvase')) ? $this->input->post('producto_costoenvase') : $producto['producto_costoenvase']; ?>" class="form-control" id="producto_costoenvase"  onclick="this.select();"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="producto_precioenvase" class="control-label">Precio de Envase</label>
                        <div class="form-group">
                            <input type="number" step="any" min="0" name="producto_precioenvase" value="<?php echo ($this->input->post('producto_precioenvase')) ? $this->input->post('producto_precioenvase') : $producto['producto_precioenvase']; ?>" class="form-control" id="producto_precioenvase"  onclick="this.select();"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="estado_id" class="control-label">Estado</label>
                        <div class="form-group">
                            <!--<select class="selectpicker" data-show-subtext="true" data-live-search="true">-->
                                <!--<select name="estado_id" class=" form-control selectpicker" data-show-subtext="true" data-live-search="true">-->
                            <select name="estado_id" class=" form-control" id="estado_id">
                                <option value="">-- ESTADO --</option>
                                <?php 
                                foreach($all_estado as $estado)
                                {
                                    $selected = ($estado['estado_id'] == $producto['estado_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success" onclick="loader()">
                    <i class="fa fa-check"></i> Guardar
                </button>
                <a href="<?php echo site_url('producto/index'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
                <?php echo form_close(); ?>
        </div>
    </div>
</div>