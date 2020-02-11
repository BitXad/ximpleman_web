<style type="text/css">
 .boton-ayuda{
    text-decoration: none;
    padding: 3px;
    font-weight: 600;
    font-size: 12px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }
  .boton-ayuda:hover{
    color: #1883ba;
    background-color: #ffffff;
  }
	
[data-title]:hover:after {
    opacity: 1;
    transition: all 0.1s ease 0.2s;
    visibility: visible;
}
[data-title]:after {
    content: attr(data-title);
    background-color:  #aed6f1;
    color: #111;
    font-size: 100%;
    position: absolute;
    padding: 1px 5px 2px 5px;
    bottom: -1.6em;
    left: 100%;
    white-space: nowrap;
    box-shadow: 1px 1px 3px #222222;
    opacity: 0;
    border: 1px solid #111111;
    z-index: 99999;
    visibility: hidden;
    border-radius:5px; 

}
[data-title] {
    position: relative;
}

</style>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
     $(document).ready(function () {
          $("#razon").keyup(function () {
              var value = $(this).val();
              $("#ingreso_nombre").val(value);
          });
       
      });
</script>
<script type="text/javascript">
function facturar(mensualidad){
	 
     var factu = document.getElementById('factura').checked;
                      
     if (factu==true){
      document.getElementById('clinit').style.display = 'block';
    }else{
      document.getElementById('clinit').style.display = 'none';
    }            	
                       
        
}	
</script>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>REGISTRAR INGRESO</h4>
                <?php echo form_open('ingreso/add/'); ?>
                <?php if(count($dosificacion) >0){ ?>
                <button class="btn btn-info btn-xs" type="button">
              <input type="checkbox" name="factura" id="factura"  onclick="facturar()"  />
              <label for="factura"> Generar Factura</label></button>
              <?php  }else{ echo "<span class='text-bold text-red'>Dosificación no activa</span>"; } ?>
            </div>
            <div class="panel-body">

				<div class="box-body">
          		<div class="row clearfix">
          			<div id="clinit" style="display: none">
                        <div class="col-md-3">
                        <label for="nit" class="control-label">Nit</label>
                        <input type="text" name="nit" value="" class="form-control" id="nit" />
                       
                    </div>
                    <div class="col-md-3">
                        <label for="razon" class="control-label">Razon</label>
                        <input type="text" name="razon" value="" class="form-control" id="razon" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
                       
                    </div>
                    </div>
							<div class="col-md-4">
								<label for="ingreso_nombre" class="control-label">Nombre</label>
								<div class="form-group">
									<input type="text" name="ingreso_nombre" value="<?php echo $this->input->post('ingreso_nombre'); ?>" class="form-control" id="ingreso_nombre" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus required/>
								</div>
							</div>
							
							
							
							<div class="col-md-2">
								<label for="ingreso_monto" class="control-label">Monto</label>
								<div class="form-group">
									<input type="number" step="any" min="0" name="ingreso_monto" value="<?php echo $this->input->post('ingreso_monto'); ?>" class="form-control" id="ingreso_monto" required/>
								</div>
							</div>
							<div class="col-md-2">
									<label for="ingreso_moneda" class="control-label">Moneda</label>
									<div class="form-group">
										<select name="ingreso_moneda" class="form-control" required>
											<option value="Bs">- Bs -</option>
										
										</select>
									</div>
								</div>

								<div class="col-md-4">
									<label for="ingreso_categoria" class="control-label">Categoria</label>
									<div class="form-group">
										
										<select name="ingreso_categoria" class="form-control" >
                <option value="">- CATEGORIA INGRESO -</option>
                <?php 
                foreach($all_categoria_ingreso as $categoria_ingreso)
                {
                  $selected = ($categoria_ingreso['categoria_cating'] == $this->input->post('ingreso_categoria')) ? ' selected="selected"' : "";

                  echo '<option value="'.$categoria_ingreso['categoria_cating'].'" '.$selected.'>'.$categoria_ingreso['categoria_cating'].'</option>';
                } 
                ?>
              </select>
									</div>
								</div>
							
							<div class="col-md-4">
								<label for="ingreso_concepto" class="control-label">Concepto/Detalle</label>
								<div class="form-group">
									<input type="text" name="ingreso_concepto" value="<?php echo $this->input->post('ingreso_concepto'); ?>" class="form-control" id="ingreso_concepto" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" required/>
								</div>
							</div>
						
							</div>
							
							
							<div class="col-md-4">
								
									<button type="submit" class="btn btn-success">
										<i class="fa fa-check"></i> GUARDAR
									</button>
									<a href="index"><button type="button" class="btn btn-danger">
            		<i class="fa fa-times"></i> Cancelar
            	</button></a>
						        
							</div>

						<?php echo form_close(); ?>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>