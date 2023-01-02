<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="egreso" id="egreso" value="<?= $egreso['egreso_id']; ?>" />

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>EDITAR EGRESO</h4>
            </div>
            <div class="panel-body">
                <!-- <?php echo form_open('egreso/edit/'.$egreso['egreso_id']); ?> -->
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="egreso_nombre" class="control-label"><span style="color: red">*</span>Entregue a</label>
                                    <div class="form-group">
                                        <input type="text" name="egreso_nombre" value="<?php echo ($this->input->post('egreso_nombre') ? $this->input->post('egreso_nombre') : $egreso['egreso_nombre']); ?>" class="form-control" id="egreso_nombre" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"  required/>
                                        <span id="mensaje_nombre"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="egreso_moneda" class="control-label">Moneda</label>
                                    <div class="form-group">
                                        <select name="egreso_moneda" id="egreso_moneda" class="form-control" required>
                                            <?php
                                            foreach($all_moneda as $moneda){
                                                $selected = ($moneda['moneda_id'] == $egreso['egreso_monreg']) ? ' selected="selected"' : "";
                                                echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="egreso_monto" class="control-label"><span style="color: red">*</span>La suma de</label>
                                    <div class="form-group">
                                        <input type="number" step="any" min="0" name="egreso_monto" value="<?php echo ($this->input->post('egreso_monto') ? $this->input->post('egreso_monto') : $egreso['egreso_monto']); ?>" class="form-control" id="egreso_monto" required disabled/>
                                    </div>
                                    <span id="mensaje_monto"></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="forma_pago" class="control-label">Forma de pago</label>
                                    <div class="form-group">
                                        <select id="select_forma_pago" name="forma_pago" class="form-control" onchange="mostrar()" required>
                                            <?php 
                                            foreach($all_forma_pago as $forma)
                                            {
                                                $selected = ($forma['forma_id'] == $egreso['forma_id']) ? ' selected="selected"' : "";
                                                echo '<option value="'.$forma['forma_id'].'" '.$selected.'>'.$forma['forma_nombre'].'</option>';
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="egreso_numero" class="control-label">Numero de egreso</label>
                                    <div class="form-group">
                                        <input type="text" readonly="readonly" name="egreso_numero" value="<?php echo ($this->input->post('egreso_numero') ? $this->input->post('egreso_numero') : $egreso['egreso_numero']); ?>" class="form-control" id="egreso_numero" required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="egreso_especificacion" class="control-label">Especificación</label>
                                    <div class="form-group">
                                        <input type="text" name="egreso_especificacion" value="<?=($egreso['egreso_especificacion'] == '' ? "{$egreso['egreso_categoria']}({$egreso['egreso_monto']})": $egreso['egreso_especificacion']); ?>" class="form-control" id="egreso_especificacion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="egreso_concepto" class="control-label">Detalle</label>
                                    <div class="form-group">
                                        <input type="text" name="egreso_concepto" value="<?php echo ($this->input->post('egreso_concepto') ? $this->input->post('egreso_concepto') : $egreso['egreso_concepto']); ?>" class="form-control" id="egreso_concepto" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
                                    </div>
                                </div>
                                <div class="col-md-8" id="input_egreso_glosa" style="<?php if($egreso['forma_id'] == 1){ echo 'display: none;';} ?>">
                                    <label for="egreso_glosa" class="control-label">Glosa</label>
                                    <div class="form-group">
                                        <input type="text" id="egreso_glosa" name="egreso_glosa" value="<?php echo ($this->input->post('egreso_glosa') ? $this->input->post('egreso_glosa') : $egreso['egreso_glosa']) ?>" class="form-control" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
                                    </div>
                                </div>
                                <div class="col-md-4" id="egreso_banco" style="<?php if($egreso['forma_id'] == 1){ echo 'display: none;';} ?>">
                                    <label for="banco_id" class="control-label">Banco</label>
                                    <div class="form-group">
                                        <select id="banco_id" name="banco_id" class="form-control" >
                                            <?php 
                                            foreach($all_banco as $banco)
                                            {
                                              $selected = ($banco['banco_id'] == $egreso['banco_id']) ? ' selected="selected"' : "";

                                              echo '<option value="'.$banco['banco_id'].'" '.$selected.'>'.$banco['banco_nombre'].'</option>';
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php  if ($tipousuario_id==1) { ?>
                                <div class="col-md-3">
                                    <label for="egreso_fecha" class="control-label">Fecha</label>
                                    <div class="form-group">
                                        <input type="datetime" name="egreso_fecha" value="<?php echo ($this->input->post('egreso_fecha') ? $this->input->post('egreso_fecha') : $egreso['egreso_fecha']); ?>" class="form-control" id="egreso_fecha" required />
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="usuario_id" class="control-label">Usuario</label>
                                    <div class="form-group">
                                        <select name="usuario_id" id="usuario_id" class="form-control" required >
                                            <option value="">Selecciona un Usuario</option>
                                            <?php 
                                            foreach($all_usuario as $usuario)
                                            {
                                              $selected = ($usuario['usuario_id'] == $egreso['usuario_id']) ? ' selected="selected"' : "";
                                              echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success" onclick="add_egreso(<?= $egreso['egreso_id'] ?>)">
                                        <i class="fa fa-check"></i> Guardar
                                    </button>
                                    <a href="javascript:history.back()">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-times"></i> Cancelar
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col md-12">
                                    <label for="egreso_categoria" class="control-label">Por concepto de</label>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#add_concepto">Agregar Concepto</button>

                                        <div class="modal fade" id="add_concepto" tabindex="-1" role="dialog" aria-labelledby="add_conceptoLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="add_conceptoLabel">Agregar Concepto</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="egreso_categoria" class="control-label">Por concepto de</label>
                                                            <select class="form-control" id="egreso_categoria">
                                                                <option value="CATEGORIA EGRESO">- CATEGORIA EGRESO -</option>
                                                                <?php 
                                                                foreach($all_categoria_egreso as $categoria_egreso)
                                                                {
                                                                $selected = ($categoria_egreso['categoria_categr'] == $this->input->post('egreso_categoria')) ? ' selected="selected"' : "";
                                                                echo '<option value="'.$categoria_egreso['categoria_categr'].'" '.$selected.'>'.$categoria_egreso['categoria_categr'].'</option>';
                                                                } 
                                                                ?>
                                                            </select>
                                                            <span id="mensaje_egreso"></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="egreso_suma">Suma</label>
                                                            <input type="number" id="egreso_suma" name="egreso_suma" class="form-control" min="0" required placeholder="0">
                                                            <span id="mensaje_suma"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-success" onclick="guardar_concepto()">Agregar Concepto</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <select name="egreso_categoria" class="form-control">
                                            <option value="">- CATEGORIA EGRESO -</option>
                                            <?php 
                                            /*foreach($all_categoria_egreso as $categoria_egreso)
                                            {
                                                $selected = ($categoria_egreso['categoria_categr'] == $this->input->post('egreso_categoria')) ? ' selected="selected"' : "";
                                                echo '<option value="'.$categoria_egreso['categoria_categr'].'" '.$selected.'>'.$categoria_egreso['categoria_categr'].'</option>';
                                            }*/
                                            ?>
                                        </select> -->
                                    </div>
                                </div>
                            </div>
                            <table class="table table-condensed table-striped" id="mitabla" style="font-size: 12px; padding: 0" role="table">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>#</th>
                                        <th>CONCEPTO</th>
                                        <th>SUMA</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="buscar" id="tabla_egresos"></tbody>
                            </table>
                        </div>
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
            document.getElementById('input_egreso_glosa').style.display = 'block';
            document.getElementById('egreso_banco').style.display = 'block';
        }else{
            document.getElementById('input_egreso_glosa').style.display = 'none';
            document.getElementById('egreso_banco').style.display = 'none';
        }
    }
</script>
<script type="text/javascript" src="<?= base_url('resources/js/detalle_egreso.js') ?>"></script>