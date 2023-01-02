<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">EDITAR INGRESO</div>
            <div class="panel-body">
                <?php echo form_open('ingreso/edit/'.$ingreso['ingreso_id']); ?>
                <div class="box-body">
                    <div class="row clearfix">					
                        <div class="col-md-4">
                            <label for="ingreso_nombre" class="control-label">Recibi de</label>
                            <div class="form-group">
                                <input type="text" name="ingreso_nombre" value="<?php echo ($this->input->post('ingreso_nombre') ? $this->input->post('ingreso_nombre') : $ingreso['ingreso_nombre']); ?>" class="form-control" id="ingreso_nombre" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus required/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ingreso_monto" class="control-label">La suma de</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="ingreso_monto" value="<?php echo ($this->input->post('ingreso_monto') ? $this->input->post('ingreso_monto') : $ingreso['ingreso_monto']); ?>" class="form-control" id="ingreso_monto" required/>
                                <small id="mjs_ingreso_monto" style="color: red; display:none;">El monto debe ser mayor a 0</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ingreso_moneda" class="control-label">Moneda</label>
                            <div class="form-group">
                                <select name="ingreso_moneda" class="form-control" required>
                                    <!--<option value="Bs">- Bs -</option>-->
                                    <?php
                                    foreach($all_moneda as $moneda)
                                    {
                                      $selected = ($moneda['moneda_codigoclasificador'] == $ingreso['ingreso_moneda']) ? ' selected="selected"' : "";
                                      echo '<option value="'.$moneda['moneda_codigoclasificador'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="ingreso_categoria" class="control-label">Por concepto de</label>
                            <div class="form-group">
                                <select name="ingreso_categoria" class="form-control" >
                                    <option value="">- CATEGORIA INGRESO -</option>
                                    <?php 
                                    foreach($all_categoria_ingreso as $categoria_ingreso)
                                    {
                                      $selected = ($categoria_ingreso['categoria_cating'] == $ingreso['ingreso_categoria']) ? ' selected="selected"' : "";
                                      echo '<option value="'.$categoria_ingreso['categoria_cating'].'" '.$selected.'>'.$categoria_ingreso['categoria_cating'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="ingreso_concepto" class="control-label">Detalle</label>
                            <div class="form-group">
                                <input type="text" name="ingreso_concepto" value="<?php echo ($this->input->post('ingreso_concepto') ? $this->input->post('ingreso_concepto') : $ingreso['ingreso_concepto']); ?>" class="form-control" id="ingreso_concepto" required />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ingreso_numero" class="control-label">Numero de Ingreso</label>
                            <div class="form-group">
                                <input type="text" readonly="readonly" name="ingreso_numero" value="<?php echo ($this->input->post('ingreso_numero') ? $this->input->post('ingreso_numero') : $ingreso['ingreso_numero']); ?>" class="form-control" id="ingreso_numero" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"  required />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="forma_pago" class="control-label">Forma de pago</label>
                            <div class="form-group">
                                <select id="select_forma_pago" name="forma_pago" class="form-control" onchange="mostrar()" required>
                                    <?php 
                                    foreach($all_forma_pago as $forma)
                                    {
                                        $selected = ($forma['forma_id'] == $ingreso['forma_id']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$forma['forma_id'].'" '.$selected.'>'.$forma['forma_nombre'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" id="ingreso_glosa" style="<?php if($ingreso['forma_id'] == 1){ echo 'display: none;';} ?>">
                            <label for="ingreso_glosa" class="control-label">Glosa</label>
                            <div class="form-group">
                                <input type="text" id="input_glosa" name="ingreso_glosa" value="<?php echo ($this->input->post('ingreso_glosa') ? $this->input->post('ingreso_glosa') : $ingreso['ingreso_glosa']) ?>" class="form-control" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
                            </div>
                        </div>
                        <div class="col-md-4" id="ingreso_banco" style="<?php if($ingreso['forma_id'] == 1){ echo 'display: none;';} ?>">
                        <!--<div class="col-md-4" id="ingreso_banco" style="display:none">-->
                            <label for="banco_id" class="control-label">Banco</label>
                            <div class="form-group">
                                <select id="banco_id" name="banco_id" class="form-control" >
                                    <?php 
                                    foreach($all_banco as $banco)
                                    {
                                      $selected = ($banco['banco_id'] == $ingreso['banco_id']) ? ' selected="selected"' : "";

                                      echo '<option value="'.$banco['banco_id'].'" '.$selected.'>'.$banco['banco_nombre']." (".$banco['banco_numcuenta'].')</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Guardar
                            </button>
                            <a href="javascript:history.back()">
                                <button type="button" class="btn btn-danger">
                                    <i class="fa fa-times"></i> Cancelar
                                </button>
                            </a>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function mostrar(){
        var forma = document.getElementById('select_forma_pago').value;
        
        if(forma != 1){
            document.getElementById('ingreso_glosa').style.display = 'block';
            document.getElementById('ingreso_banco').style.display = 'block';
        }else{
            document.getElementById('ingreso_glosa').style.display = 'none';
            document.getElementById('ingreso_banco').style.display = 'none';
            //document.getElementById('input_glosa').value = "";
        }
    }

    $(document).ready(() => {
        $("#ingreso_monto").on("keyup", () => {
            if ($("#ingreso_monto").val() <= 0)  
                $("#mjs_ingreso_monto").css("display", "block");
            else 
                $("#mjs_ingreso_monto").css("display", "none");        
        });
    });
</script>