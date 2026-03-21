<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Vehículo</h3>
            </div>

            <?php echo form_open_multipart('vehiculo/edit/'.$vehiculo['vehiculo_id'], array('id' => 'form_vehiculo_edit')); ?>
            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-2">
                        <label class="control-label">ID</label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $vehiculo['vehiculo_id']; ?>" readonly />
                        </div>
                    </div>

                    <input type="hidden" name="estado_id" value="<?php echo set_value('estado_id', $vehiculo['estado_id']); ?>">

                    <div class="col-md-5">
                        <label for="vehiculo_nombrespropietario" class="control-label">Nombres propietario</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_nombrespropietario"
                                   value="<?php echo set_value('vehiculo_nombrespropietario', $vehiculo['vehiculo_nombrespropietario']); ?>"
                                   class="form-control" id="vehiculo_nombrespropietario" maxlength="100" />
                            <span class="text-danger"><?php echo form_error('vehiculo_nombrespropietario'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="vehiculo_apellidospropietario" class="control-label">Apellidos propietario</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_apellidospropietario"
                                   value="<?php echo set_value('vehiculo_apellidospropietario', $vehiculo['vehiculo_apellidospropietario']); ?>"
                                   class="form-control" id="vehiculo_apellidospropietario" maxlength="100" />
                            <span class="text-danger"><?php echo form_error('vehiculo_apellidospropietario'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="tipomovilidad_id" class="control-label">Tipo movilidad</label>
                        <div class="form-group">
                            <input type="number" name="tipomovilidad_id"
                                   value="<?php echo set_value('tipomovilidad_id', $vehiculo['tipomovilidad_id']); ?>"
                                   class="form-control" id="tipomovilidad_id" min="1" />
                            <span class="text-danger"><?php echo form_error('tipomovilidad_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="categoriavehiculo_id" class="control-label">Categoría vehículo</label>
                        <div class="form-group">
                            <input type="number" name="categoriavehiculo_id"
                                   value="<?php echo set_value('categoriavehiculo_id', $vehiculo['categoriavehiculo_id']); ?>"
                                   class="form-control" id="categoriavehiculo_id" min="1" />
                            <span class="text-danger"><?php echo form_error('categoriavehiculo_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_placa" class="control-label">Placa</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_placa"
                                   value="<?php echo set_value('vehiculo_placa', $vehiculo['vehiculo_placa']); ?>"
                                   class="form-control text-uppercase" id="vehiculo_placa" maxlength="30" />
                            <span class="text-danger"><?php echo form_error('vehiculo_placa'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_clase" class="control-label">Clase vehículo</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_clase"
                                   value="<?php echo set_value('vehiculo_clase', $vehiculo['vehiculo_clase']); ?>"
                                   class="form-control" id="vehiculo_clase" maxlength="30" />
                            <span class="text-danger"><?php echo form_error('vehiculo_clase'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_marca" class="control-label">Marca</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_marca"
                                   value="<?php echo set_value('vehiculo_marca', $vehiculo['vehiculo_marca']); ?>"
                                   class="form-control" id="vehiculo_marca" maxlength="30" />
                            <span class="text-danger"><?php echo form_error('vehiculo_marca'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_modelo" class="control-label">Modelo</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_modelo"
                                   value="<?php echo set_value('vehiculo_modelo', $vehiculo['vehiculo_modelo']); ?>"
                                   class="form-control" id="vehiculo_modelo" maxlength="30" />
                            <span class="text-danger"><?php echo form_error('vehiculo_modelo'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_tipocombustible" class="control-label">Tipo combustible</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_tipocombustible"
                                   value="<?php echo set_value('vehiculo_tipocombustible', $vehiculo['vehiculo_tipocombustible']); ?>"
                                   class="form-control" id="vehiculo_tipocombustible" maxlength="30" />
                            <span class="text-danger"><?php echo form_error('vehiculo_tipocombustible'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_carroceria" class="control-label">Carrocería</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_carroceria"
                                   value="<?php echo set_value('vehiculo_carroceria', $vehiculo['vehiculo_carroceria']); ?>"
                                   class="form-control" id="vehiculo_carroceria" maxlength="30" />
                            <span class="text-danger"><?php echo form_error('vehiculo_carroceria'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_color" class="control-label">Color</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_color"
                                   value="<?php echo set_value('vehiculo_color', $vehiculo['vehiculo_color']); ?>"
                                   class="form-control" id="vehiculo_color" maxlength="250" />
                            <span class="text-danger"><?php echo form_error('vehiculo_color'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_numeromotor" class="control-label">Nro. motor</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_numeromotor"
                                   value="<?php echo set_value('vehiculo_numeromotor', $vehiculo['vehiculo_numeromotor']); ?>"
                                   class="form-control" id="vehiculo_numeromotor" maxlength="30" />
                            <span class="text-danger"><?php echo form_error('vehiculo_numeromotor'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_serie" class="control-label">Serie</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_serie"
                                   value="<?php echo set_value('vehiculo_serie', $vehiculo['vehiculo_serie']); ?>"
                                   class="form-control" id="vehiculo_serie" maxlength="30" />
                            <span class="text-danger"><?php echo form_error('vehiculo_serie'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_tiposervicio" class="control-label">Tipo servicio</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_tiposervicio"
                                   value="<?php echo set_value('vehiculo_tiposervicio', $vehiculo['vehiculo_tiposervicio']); ?>"
                                   class="form-control" id="vehiculo_tiposervicio" maxlength="50" />
                            <span class="text-danger"><?php echo form_error('vehiculo_tiposervicio'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_aniofabricacion" class="control-label">Año fabricación</label>
                        <div class="form-group">
                            <input type="number" name="vehiculo_aniofabricacion"
                                   value="<?php echo set_value('vehiculo_aniofabricacion', $vehiculo['vehiculo_aniofabricacion']); ?>"
                                   class="form-control" id="vehiculo_aniofabricacion" min="1900" max="2100" />
                            <span class="text-danger"><?php echo form_error('vehiculo_aniofabricacion'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_ejes" class="control-label">Nro. ejes</label>
                        <div class="form-group">
                            <input type="number" name="vehiculo_ejes"
                                   value="<?php echo set_value('vehiculo_ejes', $vehiculo['vehiculo_ejes']); ?>"
                                   class="form-control" id="vehiculo_ejes" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_ejes'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_cilindros" class="control-label">Cilindros</label>
                        <div class="form-group">
                            <input type="number" name="vehiculo_cilindros"
                                   value="<?php echo set_value('vehiculo_cilindros', $vehiculo['vehiculo_cilindros']); ?>"
                                   class="form-control" id="vehiculo_cilindros" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_cilindros'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_ruedas" class="control-label">Ruedas</label>
                        <div class="form-group">
                            <input type="number" name="vehiculo_ruedas"
                                   value="<?php echo set_value('vehiculo_ruedas', $vehiculo['vehiculo_ruedas']); ?>"
                                   class="form-control" id="vehiculo_ruedas" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_ruedas'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_pasajeros" class="control-label">Pasajeros</label>
                        <div class="form-group">
                            <input type="number" name="vehiculo_pasajeros"
                                   value="<?php echo set_value('vehiculo_pasajeros', $vehiculo['vehiculo_pasajeros']); ?>"
                                   class="form-control" id="vehiculo_pasajeros" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_pasajeros'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_asientos" class="control-label">Asientos</label>
                        <div class="form-group">
                            <input type="number" name="vehiculo_asientos"
                                   value="<?php echo set_value('vehiculo_asientos', $vehiculo['vehiculo_asientos']); ?>"
                                   class="form-control" id="vehiculo_asientos" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_asientos'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_longitud" class="control-label">Longitud</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="vehiculo_longitud"
                                   value="<?php echo set_value('vehiculo_longitud', $vehiculo['vehiculo_longitud']); ?>"
                                   class="form-control" id="vehiculo_longitud" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_longitud'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_altura" class="control-label">Altura</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="vehiculo_altura"
                                   value="<?php echo set_value('vehiculo_altura', $vehiculo['vehiculo_altura']); ?>"
                                   class="form-control" id="vehiculo_altura" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_altura'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="vehiculo_ancho" class="control-label">Ancho</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="vehiculo_ancho"
                                   value="<?php echo set_value('vehiculo_ancho', $vehiculo['vehiculo_ancho']); ?>"
                                   class="form-control" id="vehiculo_ancho" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_ancho'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_pesoseco" class="control-label">Peso seco</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="vehiculo_pesoseco"
                                   value="<?php echo set_value('vehiculo_pesoseco', $vehiculo['vehiculo_pesoseco']); ?>"
                                   class="form-control" id="vehiculo_pesoseco" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_pesoseco'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vehiculo_pesobruto" class="control-label">Peso bruto</label>
                        <div class="form-group">
                            <input type="number" step="0.01" name="vehiculo_pesobruto"
                                   value="<?php echo set_value('vehiculo_pesobruto', $vehiculo['vehiculo_pesobruto']); ?>"
                                   class="form-control" id="vehiculo_pesobruto" min="0" />
                            <span class="text-danger"><?php echo form_error('vehiculo_pesobruto'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="vehiculo_ruat" class="control-label">RUAT</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_ruat"
                                   value="<?php echo set_value('vehiculo_ruat', $vehiculo['vehiculo_ruat']); ?>"
                                   class="form-control" id="vehiculo_ruat" maxlength="250" />
                            <span class="text-danger"><?php echo form_error('vehiculo_ruat'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="vehiculo_tarjetacirculacion" class="control-label">Tarjeta circulación</label>
                        <div class="form-group">
                            <input type="text" name="vehiculo_tarjetacirculacion"
                                   value="<?php echo set_value('vehiculo_tarjetacirculacion', $vehiculo['vehiculo_tarjetacirculacion']); ?>"
                                   class="form-control" id="vehiculo_tarjetacirculacion" maxlength="250" />
                            <span class="text-danger"><?php echo form_error('vehiculo_tarjetacirculacion'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="vehiculo_fechatarjeta" class="control-label">Límite tarjeta</label>
                        <div class="form-group">
                            <input type="date" name="vehiculo_fechatarjeta"
                                   value="<?php echo set_value('vehiculo_fechatarjeta', $vehiculo['vehiculo_fechatarjeta']); ?>"
                                   class="form-control" id="vehiculo_fechatarjeta" />
                            <span class="text-danger"><?php echo form_error('vehiculo_fechatarjeta'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="vehiculo_imagen_file" class="control-label">Imagen</label>
                        <div class="form-group">
                            <input type="file"
                                   name="vehiculo_imagen_file"
                                   id="vehiculo_imagen_file"
                                   class="form-control"
                                   accept="image/*" />
                            <span class="text-danger">
                                <?php echo isset($error_imagen) ? $error_imagen : ''; ?>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="control-label">Vista previa</label>
                        <div class="form-group">
                            <div style="border:1px solid #ddd; padding:10px; min-height:220px; text-align:center;">
                                <?php
                                $img_actual = !empty($vehiculo['vehiculo_imagen'])
                                    ? base_url('resources/images/'.$vehiculo['vehiculo_imagen'])
                                    : base_url('resources/images/system/no-image.png');
                                ?>
                                <img id="preview_imagen"
                                     src="<?php echo $img_actual; ?>"
                                     alt="Vista previa"
                                     style="max-width:100%; max-height:200px;" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar cambios
                </button>
                <a href="<?php echo site_url('vehiculo/index'); ?>" class="btn btn-default">Cancelar</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    const inputFile = document.getElementById('vehiculo_imagen_file');
    const preview = document.getElementById('preview_imagen');
    const imagenDefault = preview.src;

    inputFile.addEventListener('change', function (e) {
        const file = e.target.files[0];

        if (!file) {
            preview.src = imagenDefault;
            return;
        }

        if (!file.type.match('image.*')) {
            alert('Seleccione un archivo de imagen válido.');
            inputFile.value = '';
            preview.src = imagenDefault;
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            preview.src = event.target.result;
        };
        reader.readAsDataURL(file);
    });
});
</script>