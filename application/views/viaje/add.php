<div class="box-header with-border">
    <h3 class="box-title">Registrar Viaje</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <?php echo form_open('viaje/add'); ?>

            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-4">
                        <label for="vehiculo_id" class="control-label">Vehículo</label>
                        <div class="form-group">
                            <select name="vehiculo_id" class="form-control" id="vehiculo_id">
                                <option value="">- SELECCIONAR VEHÍCULO -</option>
                                <?php foreach($all_vehiculo as $vehiculo){ ?>
                                    <option value="<?php echo $vehiculo['vehiculo_id']; ?>"
                                        <?php echo set_select('vehiculo_id', $vehiculo['vehiculo_id']); ?>>
                                        <?php
                                            echo $vehiculo['vehiculo_placa']." | ".$vehiculo['vehiculo_modelo']." | ".$vehiculo['vehiculo_clase'];
                                        ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('vehiculo_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="ruta_id" class="control-label">Ruta</label>
                        <div class="form-group">
                            <select name="ruta_id" class="form-control" id="ruta_id">
                                <option value="">- SELECCIONAR RUTA -</option>
                                <?php foreach($all_ruta as $ruta){ ?>
                                    <option value="<?php echo $ruta['ruta_id']; ?>"
                                        <?php echo set_select('ruta_id', $ruta['ruta_id']); ?>>
                                        <?php echo $ruta['ruta_nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('ruta_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="ayudante_id" class="control-label">Ayudante</label>
                        <div class="form-group">
                            <select name="ayudante_id" class="form-control" id="ayudante_id">
                                <option value="">- SELECCIONAR AYUDANTE -</option>
                                <?php foreach($all_ayudante as $ayudante){ ?>
                                    <option value="<?php echo $ayudante['ayudante_id']; ?>"
                                        <?php echo set_select('ayudante_id', $ayudante['ayudante_id']); ?>>
                                        <?php echo $ayudante['ayudante_apellidos']." ".$ayudante['ayudante_nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('ayudante_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="box box-default">
                            <div class="box-header"><b>Tripulación / Conductores</b> <button type="button" class="btn btn-xs btn-success pull-right" id="agregar-tripulante"><i class="fa fa-plus"></i> Agregar</button></div>
                            <div class="box-body" id="tripulacion-contenedor">
                                <?php $tripulacion = array(array('conductor_id'=>'','viaje_conductor_rol'=>'PRINCIPAL','viaje_conductor_hora_inicio'=>'','viaje_conductor_hora_fin'=>'','viaje_conductor_observacion'=>'')); ?>
                                <?php foreach($tripulacion as $t){ if(empty($t['conductor_id']) && $t['viaje_conductor_rol']!='PRINCIPAL') continue; ?>
                                <div class="row tripulacion-fila" style="margin-bottom:8px">
                                    <div class="col-md-3"><select name="tripulacion_conductor_id[]" class="form-control trip-conductor"><option value="">- PERSONA -</option><?php foreach($all_conductor as $c){ ?><option value="<?php echo $c['conductor_id']; ?>" <?php echo ((string)$c['conductor_id']==(string)$t['conductor_id'])?'selected':''; ?>><?php echo $c['conductor_apellidos'].' '.$c['conductor_nombres']; ?></option><?php } ?></select></div>
                                    <div class="col-md-2"><select name="tripulacion_rol[]" class="form-control trip-rol"><?php foreach(array('PRINCIPAL'=>'Conductor principal','SEGUNDO'=>'Segundo conductor','RELEVO'=>'Relevo','AYUDANTE'=>'Ayudante') as $k=>$v){ ?><option value="<?php echo $k; ?>" <?php echo $t['viaje_conductor_rol']==$k?'selected':''; ?>><?php echo $v; ?></option><?php } ?></select></div>
                                    <div class="col-md-2"><input type="time" name="tripulacion_hora_inicio[]" class="form-control" value="<?php echo isset($t['viaje_conductor_hora_inicio'])?$t['viaje_conductor_hora_inicio']:''; ?>" title="Desde"></div>
                                    <div class="col-md-2"><input type="time" name="tripulacion_hora_fin[]" class="form-control" value="<?php echo isset($t['viaje_conductor_hora_fin'])?$t['viaje_conductor_hora_fin']:''; ?>" title="Hasta"></div>
                                    <div class="col-md-2"><input type="text" name="tripulacion_observacion[]" class="form-control" value="<?php echo isset($t['viaje_conductor_observacion'])?html_escape($t['viaje_conductor_observacion']):''; ?>" placeholder="Observación"></div>
                                    <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm quitar-tripulante"><i class="fa fa-trash"></i></button></div>
                                </div><?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" hidden>
                        <label for="usuario_id" class="control-label">Usuario</label>
                        <div class="form-group">
                            <input type="hidden" name="usuario_id" value="<?php echo $this->session->userdata('logged_in')['usuario_id']; ?>">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_fechasalida" class="control-label">Fecha partida</label>
                        <div class="form-group">
                            <input type="date" name="viaje_fechasalida"
                                   value="<?php echo set_value('viaje_fechasalida'); ?>"
                                   class="form-control" id="viaje_fechasalida" />
                            <span class="text-danger"><?php echo form_error('viaje_fechasalida'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_horasalida" class="control-label">Hora partida</label>
                        <div class="form-group">
                            <input type="time" name="viaje_horasalida"
                                   value="<?php echo set_value('viaje_horasalida'); ?>"
                                   class="form-control" id="viaje_horasalida" />
                            <span class="text-danger"><?php echo form_error('viaje_horasalida'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_fechallegada" class="control-label">Fecha llegada</label>
                        <div class="form-group">
                            <input type="date" name="viaje_fechallegada"
                                   value="<?php echo set_value('viaje_fechallegada'); ?>"
                                   class="form-control" id="viaje_fechallegada" />
                            <span class="text-danger"><?php echo form_error('viaje_fechallegada'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_horallegada" class="control-label">Hora llegada</label>
                        <div class="form-group">
                            <input type="time" name="viaje_horallegada"
                                   value="<?php echo set_value('viaje_horallegada'); ?>"
                                   class="form-control" id="viaje_horallegada" />
                            <span class="text-danger"><?php echo form_error('viaje_horallegada'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_preciopasaje" class="control-label">Precio base</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="viaje_preciopasaje"
                                   value="<?php echo set_value('viaje_preciopasaje'); ?>"
                                   class="form-control" id="viaje_preciopasaje" />
                            <span class="text-danger"><?php echo form_error('viaje_preciopasaje'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_precio1" class="control-label">Precio 1</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="viaje_precio1"
                                   value="<?php echo set_value('viaje_precio1'); ?>"
                                   class="form-control" id="viaje_precio1" />
                            <span class="text-danger"><?php echo form_error('viaje_precio1'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_precio2" class="control-label">Precio 2</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="viaje_precio2"
                                   value="<?php echo set_value('viaje_precio2'); ?>"
                                   class="form-control" id="viaje_precio2" />
                            <span class="text-danger"><?php echo form_error('viaje_precio2'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="viaje_precio3" class="control-label">Precio 3</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="viaje_precio3"
                                   value="<?php echo set_value('viaje_precio3'); ?>"
                                   class="form-control" id="viaje_precio3" />
                            <span class="text-danger"><?php echo form_error('viaje_precio3'); ?></span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-floppy-o"></i> Guardar
                </button>
                <a href="<?php echo site_url('viaje/index'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar
                </a>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
(function(){
 var c=document.getElementById('tripulacion-contenedor'), b=document.getElementById('agregar-tripulante'); if(!c||!b)return;
 b.onclick=function(){var f=c.querySelector('.tripulacion-fila'); if(!f)return; var n=f.cloneNode(true); n.querySelectorAll('input').forEach(function(x){x.value='';}); n.querySelector('.trip-conductor').value=''; n.querySelector('.trip-rol').value='RELEVO'; c.appendChild(n);};
 c.addEventListener('click',function(e){var q=e.target.closest('.quitar-tripulante'); if(!q)return; var filas=c.querySelectorAll('.tripulacion-fila'); if(filas.length>1) q.closest('.tripulacion-fila').remove();});
})();
</script>
