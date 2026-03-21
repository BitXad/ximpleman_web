<div class="box-header with-border">
    <h3 class="box-title">Modificar Viaje</h3>
</div>
<?php $decimales = $parametro["parametro_decimales"]; ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <?php echo form_open('viaje/edit/'.$viaje['viaje_id']); ?>

            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-2">
                        <label class="control-label">ID</label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $viaje['viaje_id']; ?>" readonly />
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="vehiculo_id" class="control-label">Vehículo</label>
                        <div class="form-group">
                            <select name="vehiculo_id" class="form-control" id="vehiculo_id">
                                <option value="">- SELECCIONAR VEHÍCULO -</option>
                                <?php foreach($all_vehiculo as $vehiculo){ ?>
                                    <option value="<?php echo $vehiculo['vehiculo_id']; ?>"
                                        <?php echo set_select('vehiculo_id', $vehiculo['vehiculo_id'], ($vehiculo['vehiculo_id'] == $viaje['vehiculo_id'])); ?>>
                                        <?php echo $vehiculo['vehiculo_placa']." | ".$vehiculo['vehiculo_modelo']." | ".$vehiculo['vehiculo_clase']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('vehiculo_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="ruta_id" class="control-label">Ruta</label>
                        <div class="form-group">
                            <select name="ruta_id" class="form-control" id="ruta_id">
                                <option value="">- SELECCIONAR RUTA -</option>
                                <?php foreach($all_ruta as $ruta){ ?>
                                    <option value="<?php echo $ruta['ruta_id']; ?>"
                                        <?php echo set_select('ruta_id', $ruta['ruta_id'], ($ruta['ruta_id'] == $viaje['ruta_id'])); ?>>
                                        <?php echo $ruta['ruta_nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('ruta_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="conductor_id" class="control-label">Conductor</label>
                        <div class="form-group">
                            <select name="conductor_id" class="form-control" id="conductor_id">
                                <option value="">- SELECCIONAR CONDUCTOR -</option>
                                <?php foreach($all_conductor as $conductor){ ?>
                                    <option value="<?php echo $conductor['conductor_id']; ?>"
                                        <?php echo set_select('conductor_id', $conductor['conductor_id'], ($conductor['conductor_id'] == $viaje['conductor_id'])); ?>>
                                        <?php echo $conductor['conductor_apellidos']." ".$conductor['conductor_nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('conductor_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="conductor_id2" class="control-label">Conductor de relevo</label>
                        <div class="form-group">
                            <select name="conductor_id2" class="form-control" id="conductor_id2">
                                <option value="">- SELECCIONAR CONDUCTOR DE RELEVO -</option>
                                <?php foreach($all_conductor as $conductor){ ?>
                                    <option value="<?php echo $conductor['conductor_id']; ?>"
                                        <?php echo set_select('conductor_id2', $conductor['conductor_id'], ($conductor['conductor_id'] == $viaje['conductor_id2'])); ?>>
                                        <?php echo $conductor['conductor_apellidos']." ".$conductor['conductor_nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('conductor_id2'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="ayudante_id" class="control-label">Ayudante</label>
                        <div class="form-group">
                            <select name="ayudante_id" class="form-control" id="ayudante_id">
                                <option value="">- SELECCIONAR AYUDANTE -</option>
                                <?php foreach($all_ayudante as $ayudante){ ?>
                                    <option value="<?php echo $ayudante['ayudante_id']; ?>"
                                        <?php echo set_select('ayudante_id', $ayudante['ayudante_id'], ($ayudante['ayudante_id'] == $viaje['ayudante_id'])); ?>>
                                        <?php echo $ayudante['ayudante_apellidos']." ".$ayudante['ayudante_nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('ayudante_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_fechasalida" class="control-label">Fecha salida</label>
                        <div class="form-group">
                            <input type="date" name="viaje_fechasalida"
                                   value="<?php echo set_value('viaje_fechasalida', $viaje['viaje_fechasalida']); ?>"
                                   class="form-control" id="viaje_fechasalida" />
                            <span class="text-danger"><?php echo form_error('viaje_fechasalida'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_horasalida" class="control-label">Hora salida</label>
                        <div class="form-group">
                            <input type="time" name="viaje_horasalida"
                                   value="<?php echo set_value('viaje_horasalida', $viaje['viaje_horasalida']); ?>"
                                   class="form-control" id="viaje_horasalida" />
                            <span class="text-danger"><?php echo form_error('viaje_horasalida'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_fechallegada" class="control-label">Fecha llegada</label>
                        <div class="form-group">
                            <input type="date" name="viaje_fechallegada"
                                   value="<?php echo set_value('viaje_fechallegada', $viaje['viaje_fechallegada']); ?>"
                                   class="form-control" id="viaje_fechallegada" />
                            <span class="text-danger"><?php echo form_error('viaje_fechallegada'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_horallegada" class="control-label">Hora llegada</label>
                        <div class="form-group">
                            <input type="time" name="viaje_horallegada"
                                   value="<?php echo set_value('viaje_horallegada', $viaje['viaje_horallegada']); ?>"
                                   class="form-control" id="viaje_horallegada" />
                            <span class="text-danger"><?php echo form_error('viaje_horallegada'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_preciopasaje" class="control-label">Precio base</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="viaje_preciopasaje"
                                   value="<?php echo set_value('viaje_preciopasaje', number_format($viaje['viaje_preciopasaje'],$decimales,".",",") ); ?>"
                                   class="form-control" id="viaje_preciopasaje" />
                            <span class="text-danger"><?php echo form_error('viaje_preciopasaje'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_precio1" class="control-label">Precio 1</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="viaje_precio1"
                                   value="<?php echo set_value('viaje_precio1', number_format($viaje['viaje_precio1'],$decimales,".",",")); ?>"
                                   class="form-control" id="viaje_precio1" />
                            <span class="text-danger"><?php echo form_error('viaje_precio1'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_precio2" class="control-label">Precio 2</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="viaje_precio2"
                                   value="<?php echo set_value('viaje_precio2', number_format($viaje['viaje_precio2'],$decimales,".",",")); ?>"
                                   class="form-control" id="viaje_precio2" />
                            <span class="text-danger"><?php echo form_error('viaje_precio2'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_precio3" class="control-label">Precio 3</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="viaje_precio3"
                                   value="<?php echo set_value('viaje_precio3', number_format($viaje['viaje_precio3'],$decimales,".",",")); ?>"
                                   class="form-control" id="viaje_precio3" />
                            <span class="text-danger"><?php echo form_error('viaje_precio3'); ?></span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar cambios
                </button>
                <a href="<?php echo site_url('viaje/index'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar
                </a>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>