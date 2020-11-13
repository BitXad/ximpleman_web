<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/servicio_edit.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<script>
        $(document).ready(function() {


        });
        
        function fetch_select(id_cat){

                var parametros = {
                    catserv_id:id_cat
                };
                $.ajax({
                    data:  parametros,
                    url:   '<?php echo base_url('servicio/fetch_data')?>',
                    type:  'post',
                    
                    success:  function (response) {
                       
                    var results = JSON.parse(response);
                var subcat = "";
                $.each(results, function(index, value) {
                    
                     subcat = subcat+'<option value="'+value.subcatserv_id+'">'+
                            value.subcatserv_descripcion+
                            '</option>';

                });
                    subcat = "<select name='subcatserv_id' class='form-control' id='subcatserv_id' onchange='ponerdescripcion(this.value)'>"+
                            "<option value='0'>- MARCA/MODELO -</option>"+
                            subcat+"</select>"
                    $('#subcatserv_id' ).replaceWith(''+subcat);
                }
                    
                });
                $('#detalleserv_descripcion').val($('#catserv_id option:selected').text());
                $('#detalleserv_descripcion').focus();
                }
                
</script>
<script type="text/javascript">
$(document).ready(function(){
  
  function restar(){
    
    var uno, dos, tres, operacion;
  
      uno = $('#detalleserv_total');
      dos = $('#detalleserv_acuenta');
      tres = $('#detalleserv_saldo');
      
      operacion = parseFloat(uno.val()) - parseFloat(dos.val());
      tres.val(operacion);
    
  }
  
  $("#detalleserv_total").keyup(function(){
      
      var dos;
      dos = $('#detalleserv_acuenta').val();
      
      if(dos != ""){
        restar()
      }
      
  });
  
  $("#detalleserv_acuenta").keyup(function(){
      
      var uno;
      uno = $('#detalleserv_total').val();
      
      if(uno != ""){
        restar()
      }
      
  });
  
  $("#detalleserv_acuenta").change(function(){
  if($("#detalleserv_saldo").val() <0){
      alert("Saldo no debe ser negativo");
      $('#detalleserv_acuenta').css('color', 'red');
      $('#detalleserv_saldo').css('color', 'red');
      $('#detalleserv_acuenta').focus();
  }else{
      $('#detalleserv_acuenta').css('color', 'black');
      $('#detalleserv_saldo').css('color', 'black');
  }});
  
})
</script>
<script type="text/javascript">
function mostrarAlert(){
    if($('#estado_id').val() == 4){
        alert('Si elige este estado(ANULADO); Total, A cuenta, Saldo e insumos usados se volveran en cero.');
    }
}
</script>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modificar Producto <b><?php echo $detalle_serv['detalleserv_codigo']; ?></b></h3>
            </div>
			<?php echo form_open('detalle_serv/modificardetalle/'.$servicio['servicio_id'].'/'.$detalle_serv['detalleserv_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
                                    <div class="col-md-2">
                                            <label for="detalleserv_reclamo" class="control-label">¿Es Reclamo?</label>
                                                <div class="form-group">
                                                    <?php
                                                    if($detalle_serv['detalleserv_reclamo']=="si")
                                                        $checked = "checked";
                                                    else $checked ="";
                                                    ?>
                                                    <input type="checkbox" name="detalleserv_reclamo" id="detalleserv_reclamo" value="si" <?php echo $checked; ?> />
                                                </div>
                                        </div>
					<div class="col-md-3">
                                            <label for="cattrab_id" class="control-label">Tipo de Trabajo</label>
                                                <div class="form-group">
                                                    <select name="cattrab_id" class="form-control" id="cattrab_id">
                                                                <!--<option value="">- TIPO TRABAJO -</option>-->
                                                                <?php
                                                                foreach($all_categoria_trabajo as $cat_trabajo)
                                                                {
                                                                        $selected = ($cat_trabajo['cattrab_id'] == $detalle_serv['cattrab_id']) ? ' selected="selected"' : "";

                                                                        echo '<option value="'.$cat_trabajo['cattrab_id'].'" '.$selected.'>'.$cat_trabajo['cattrab_descripcion'].'</option>';
                                                                } 
                                                                ?>
                                                        </select>
                                                </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="procedencia_id" class="control-label">Procedencia</label>
                                                <div class="form-group">
                                                    <select name="procedencia_id" class="form-control" id="procedencia_id">
                                                                <!--<option value="">- PROCEDENCIA -</option>-->
                                                                <?php
                                                                foreach($all_procedencia as $procedencia)
                                                                {
                                                                        $selected = ($procedencia['procedencia_id'] == $detalle_serv['procedencia_id']) ? ' selected="selected"' : "";

                                                                        echo '<option value="'.$procedencia['procedencia_id'].'" '.$selected.'>'.$procedencia['procedencia_descripcion'].'</option>';
                                                                } 
                                                                ?>
                                                        </select>
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tiempouso_id" class="control-label">Tiempo de uso</label>
                                                <div class="form-group">
                                                    <select name="tiempouso_id" class="form-control" id="tiempouso_id">
                                                                <!--<option value="">- TIEMPO DE USO -</option>-->
                                                                <?php
                                                                foreach($all_tiempo_uso as $tiempouso)
                                                                {
                                                                        $selected = ($tiempouso['tiempouso_id'] == $detalle_serv['tiempouso_id']) ? ' selected="selected"' : "";

                                                                        echo '<option value="'.$tiempouso['tiempouso_id'].'" '.$selected.'>'.$tiempouso['tiempouso_descripcion'].'</option>';
                                                                } 
                                                                ?>
                                                        </select>
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="catserv_id" class="control-label">Categoría Producto</label>
						<div class="form-group">
							<select name="catserv_id" class="form-control" onchange="fetch_select(this.value);" id="catserv_id">
								<!--<option value="">- CATEGORIA -</option>-->
								<?php
								foreach($all_categoria_servicio as $categoria_servicio)
								{
									$selected = ($categoria_servicio['catserv_id'] == $detalle_serv['catserv_id'] ) ? ' selected="selected"' : "";

									echo '<option value="'.$categoria_servicio['catserv_id'].'" '.$selected.'>'.$categoria_servicio['catserv_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-4">
                                            <label for="subcatserv_id" class="control-label">Marca/Modelo</label>
                                                <div class="form-group" id="new_select">
                                                    <!--<input type="search" name="subcatserv_id" list="listasubcatserv" class="form-control" id="subcatserv_id" value="<?php echo $detalle_serv['subcatserv_descripcion'] ?>" onkeydown="validar2(event,2)"  onchange="seleccionar_subcategoria()" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" onclick="this.select();" />
                                                    <datalist id="listasubcatserv">
                                                    </datalist> -->
                                                        <select name="subcatserv_id" class="form-control" id="subcatserv_id" onchange="ponerdescripcion(this.value);">
                                                            <?php
								foreach($all_subcategoria_servicio as $subcategoria_servicio)
								{
                                                                    if($subcategoria_servicio['subcatserv_id'] == $detalle_serv['subcatserv_id']){
									echo '<option value="'.$subcategoria_servicio['subcatserv_id'].'" selected="selected" >'.$subcategoria_servicio['subcatserv_descripcion'].'</option>';
                                                                    }

								}
								?>
                                                        </select>
                                                </div>
                                        </div>
					<div class="col-md-4">
						<label for="detalleserv_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
						<div class="form-group">
                                                    <input type="text" name="detalleserv_descripcion" value="<?php echo $detalle_serv['detalleserv_descripcion']; ?>" class="form-control" id="detalleserv_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_falla" class="control-label"><span class="text-danger">*</span>Problema/Falla Según Cliente</label>
						<div class="form-group">
                                                    <input type="text" name="detalleserv_falla" value="<?php echo $detalle_serv['detalleserv_falla']; ?>" class="form-control" id="detalleserv_falla" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_diagnostico" class="control-label">Diagnóstico</label>
						<div class="form-group">
                                                    <input type="text" name="detalleserv_diagnostico" value="<?php if($detalle_serv['detalleserv_diagnostico'] == null){ echo 'REVISION'; }else{ echo $detalle_serv['detalleserv_diagnostico']; } ?>" class="form-control" id="detalleserv_diagnostico" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-5">
                                            <label for="detalleserv_solucion" class="control-label">Solución</label>
                                            <div class="form-group">
                                                <input type="text" name="detalleserv_solucion" value="<?php if($detalle_serv['detalleserv_solucion'] == null){ echo 'REVISION'; }else{ echo $detalle_serv['detalleserv_solucion']; } ?>" class="form-control" id="detalleserv_solucion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                            </div>
					</div>
                                        <div class="col-md-2">
                                                <label for="detalleserv_pesoentrada" class="control-label">Peso Entrada(Gr.)</label>
                                                <div class="form-group">
                                                        <input type="number" step="any" min="0" name="detalleserv_pesoentrada" value="<?php echo number_format($detalle_serv['detalleserv_pesoentrada'],'2','.',','); ?>" class="form-control" id="detalleserv_pesoentrada" />
                                                </div>
                                        </div>
					<div class="col-md-5">
						<label for="detalleserv_glosa" class="control-label">Datos Adicionales</label>
						<div class="form-group">
							<input type="text" name="detalleserv_glosa" value="<?php echo $detalle_serv['detalleserv_glosa']; ?>" class="form-control" id="detalleserv_glosa" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="detalleserv_total" class="control-label">Total</label>
						<div class="form-group">
							<input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_total" value="<?php echo $detalle_serv['detalleserv_total']; //number_format($detalle_serv['detalleserv_total'],'2','.',','); ?>" class="form-control" id="detalleserv_total" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="detalleserv_acuenta" class="control-label">A cuenta</label>
						<div class="form-group">
							<input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_acuenta" value="<?php echo $detalle_serv['detalleserv_acuenta']; //number_format($detalle_serv['detalleserv_acuenta'],'2','.',','); ?>" class="form-control" id="detalleserv_acuenta" />
						</div>
                                                <style type="text/css">
                                                </style>
					</div>
					<div class="col-md-4">
						<label for="detalleserv_saldo" class="control-label">Saldo</label>
						<div class="form-group">
                                                    <input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_saldo" value="<?php echo $detalle_serv['detalleserv_saldo']; //number_format($detalle_serv['detalleserv_saldo'],'2','.',','); ?>" class="form-control" id="detalleserv_saldo" readonly />
						</div>
					</div>
					<div class="col-md-3">
						<label for="detalleserv_fechaentrega" class="control-label">Fecha Entrega</label>
						<div class="form-group">
							<input type="date" name="detalleserv_fechaentrega" value="<?php echo $detalle_serv['detalleserv_fechaentrega']; ?>" class="form-control" id="detalleserv_fechaentrega" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="detalleserv_horaentrega" class="control-label">Hora Entrega</label>
						<div class="form-group">
                                                    <input type="time" name="detalleserv_horaentrega" value="<?php echo $detalle_serv['detalleserv_horaentrega']; ?>" class="form-control" id="detalleserv_horaentrega" />
						</div>
					</div>
                                        <div class="col-md-3">
						<label for="responsable_id" class="control-label"><span class="text-danger">*</span>Responsable</label>
						<div class="form-group">
                                                    <select name="responsable_id" class="form-control" required>
								<option value="">- RESPONSABLE -</option>
								<?php 
								foreach($all_responsable as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $detalle_serv['responsable_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-3">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
                                                        <select name="estado_id" class="form-control" id="estado_id" onchange="mostrarAlert();">
								<!--<option value="">- ESTADO -</option>-->
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $detalle_serv['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                            <!--<input type="hidden" name="estado_id" value="5" class="form-control" id="estado_id" />-->
                            <!--<input type="hidden" name="usuario_id" value="<?php //echo $usuario_id ?>" class="form-control" id="usuario_id" />-->
                            <input type="hidden" name="servicio_id" value="<?php echo $servicio['servicio_id'] ?>" class="form-control" id="servicio_id" />
                            <input type="hidden" name="detalleserv_codigo" value="<?php echo $detalle_serv['detalleserv_codigo'] ?>" class="form-control" id="detalleserv_codigo" />
		
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Guardar
		</button>
                <a href="<?php echo site_url('servicio/serviciocreado/'.$servicio['servicio_id']); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>