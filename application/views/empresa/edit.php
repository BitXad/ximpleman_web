<script type="text/javascript">
function mostrar(a) {
    obj = document.getElementById('oculto'+a);
    obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
    //objm = document.getElementById('map');
    if(obj.style.visibility == 'hidden'){
        $('#map').css({ 'width':'0px', 'height':'0px' });
        $('#mosmapa').text("Modificar ubicación de la empresa");
    }else{
        $('#map').css({ 'width':'100%', 'height':'400px' });
        $('#mosmapa').text("Cerrar mapa");
    }

}
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Empresa</h3>
            </div>
            <?php echo form_open_multipart('empresa/edit/'.$empresas['empresa_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="empresa_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="empresa_nombre" value="<?php echo ($this->input->post('empresa_nombre') ? $this->input->post('empresa_nombre') : $empresas['empresa_nombre']); ?>" class="form-control" id="empresa_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
							<span class="text-danger"><?php echo form_error('empresa_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_eslogan" class="control-label">Eslogan</label>
						<div class="form-group">
							<input type="text" name="empresa_eslogan" value="<?php echo ($this->input->post('empresa_eslogan') ? $this->input->post('empresa_eslogan') : $empresas['empresa_eslogan']); ?>" class="form-control" id="empresa_eslogan" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="empresa_direccion" value="<?php echo ($this->input->post('empresa_direccion') ? $this->input->post('empresa_direccion') : $empresas['empresa_direccion']); ?>" class="form-control" id="empresa_direccion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="empresa_telefono" class="control-label">Teléfono (Máximo 20 Caracteres)</label>
						<div class="form-group">
                                                    <input type="text" maxlength="25" name="empresa_telefono" value="<?php echo ($this->input->post('empresa_telefono') ? $this->input->post('empresa_telefono') : $empresas['empresa_telefono']); ?>" class="form-control" id="empresa_telefono" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
                                        <div class="col-md-3">
                                            <label for="empresa_imagen" class="control-label">Imagen (recomendado 4:3)</label>
                                            <div class="form-group">
                                                <input type="file" name="empresa_imagen" class="form-control" id="empresa_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
                                                <input type="hidden" name="empresa_imagen1" value="<?php echo ($this->input->post('empresa_imagen') ? $this->input->post('empresa_imagen') : $empresas['empresa_imagen']); ?>" class="form-control" id="empresa_imagen1" />
                                            </div>
                                            
                                            
                                            <div id="preview-container">
                                                <?php if (!empty($empresas['empresa_imagen'])) : ?>
                                                    <img id="preview-img" src="<?php echo base_url('resources/images/empresas/' . $empresas['empresa_imagen']); ?>" alt="Vista previa" style="max-width: 200px; height: auto; margin-top: 10px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                                <?php else : ?>
                                                    <img id="preview-img" src="" alt="Vista previa" style="display: none; max-width: 200px; height: auto; margin-top: 10px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <script>
                                        document.getElementById('empresa_imagen').addEventListener('change', function(event) {
                                            const file = event.target.files[0];
                                            const previewImg = document.getElementById('preview-img');

                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    previewImg.src = e.target.result;
                                                    previewImg.style.display = 'block';
                                                };
                                                reader.readAsDataURL(file);
                                            } else {
                                                previewImg.src = "";
                                                previewImg.style.display = 'none';
                                            }
                                        });
                                        </script>
                                                                                <div class="col-md-4">
						<label for="empresa_zona" class="control-label">Zona</label>
						<div class="form-group">
							<input type="text" name="empresa_zona" value="<?php echo ($this->input->post('empresa_zona') ? $this->input->post('empresa_zona') : $empresas['empresa_zona']); ?>" class="form-control" id="empresa_zona" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="empresa_ubicacion" class="control-label">Ubicación/Municipio</label>
						<div class="form-group">
							<input type="text" name="empresa_ubicacion" value="<?php echo ($this->input->post('empresa_ubicacion') ? $this->input->post('empresa_ubicacion') : $empresas['empresa_ubicacion']); ?>" class="form-control" id="empresa_ubicacion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
                                    <div class="col-md-4">
                                        <label for="empresa_departamento" class="control-label">Departamento</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_departamento" value="<?php echo ($this->input->post('empresa_departamento') ? $this->input->post('empresa_departamento') : $empresas['empresa_departamento']); ?>" class="form-control" id="empresa_departamento" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="empresa_propietario" class="control-label">Propietario</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_propietario" value="<?php echo ($this->input->post('empresa_propietario') ? $this->input->post('empresa_propietario') : $empresas['empresa_propietario']); ?>" class="form-control" id="empresa_propietario" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="empresa_profesion" class="control-label">Profesión</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_profesion" value="<?php echo ($this->input->post('empresa_profesion') ? $this->input->post('empresa_profesion') : $empresas['empresa_profesion']); ?>" class="form-control" id="empresa_profesion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="empresa_cargo" class="control-label">Cargo</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_cargo" value="<?php echo ($this->input->post('empresa_cargo') ? $this->input->post('empresa_cargo') : $empresas['empresa_cargo']); ?>" class="form-control" id="empresa_cargo" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="empresa_codigo" class="control-label">Código</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_codigo" value="<?php echo ($this->input->post('empresa_codigo') ? $this->input->post('empresa_codigo') : $empresas['empresa_codigo']); ?>" class="form-control" id="empresa_codigo" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="empresa_email" class="control-label">Correo Electrónico</label>
                                        <div class="form-group">
                                            <input type="email" name="empresa_email" value="<?php echo ($this->input->post('empresa_email') ? $this->input->post('empresa_email') : $empresas['empresa_email']); ?>" class="form-control" id="empresa_email" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="empresa_nombresucursal" class="control-label">Nombre Sucursal</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_nombresucursal" value="<?php echo ($this->input->post('empresa_nombresucursal') ? $this->input->post('empresa_nombresucursal') : $empresas['empresa_nombresucursal']); ?>" class="form-control" id="empresa_nombresucursal" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                        <label  class="control-label"><a href="#" class="btn btn-success btn-sm " id="mosmapa" onclick="mostrar('1'); return false">Modificar ubicación de la empresa</a></label>
                        <!-- ***********************aqui empieza el mapa para capturar coordenadas *********************** -->
                        <div id="oculto1" style="visibility:hidden">
                        <div id="map"></div>
                                    <!-- Carga Leaflet CSS y JS -->
                                    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                                    <script>
                                        var map;                                       
                                        var marker;

                                        function initMap() {
                                            // Obtener coordenadas iniciales
                                            var lat = parseFloat(document.getElementById('empresa_latitud').value) || 0;
                                            var lng = parseFloat(document.getElementById('empresa_longitud').value) || 0;
                                             
                                            if (!lat || !lng) {
                                                // Si no hay valores, obtener ubicación actual
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(function(position) {
                                                        lat = position.coords.latitude;
                                                        lng = position.coords.longitude;
                                                        createMap(lat, lng);
                                                    }, function(error) {
                                                        console.log(error);
                                                        // Si falla, usar coordenadas por defecto
                                                        //createMap(-17.3935, -66.1570); // Ejemplo: Cochabamba, Bolivia
                                                            var lt = position.coords.latitude;
                                                            var lg = position.coords.longitude;
                                                        createMap(lt, lg); // Ejemplo: Cochabamba, Bolivia
                                                    });
                                                } else {
                                                    createMap(-17.3935, -66.1570); // Fallback
                                                }
                                            } else {
                                                createMap(lat, lng);
                                            }
                                        }

                                        function createMap(lat, lng) {
                                            map = L.map('map').setView([lat, lng], 17);

                                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                attribution: '&copy; OpenStreetMap contributors'
                                            }).addTo(map);

                                            marker = L.marker([lat, lng], { draggable: true }).addTo(map);

                                            // Actualizar lat/long al mover el marcador
                                            marker.on('dragend', function(e) {
                                                var position = marker.getLatLng();
                                                document.getElementById('empresa_latitud').value = position.lat;
                                                document.getElementById('empresa_longitud').value = position.lng;
                                            });
                                            
                                            // Ir a otra página al hacer clic en el marcador
                                            marker.on('click', function(e) {
                                                var position = marker.getLatLng();
                                                //window.location.href = 'https://www.google.com/maps/dir/'+position.lat+','+position.lng;
                                                //window.open('https://www.google.com/maps/dir/'+position.lat+','+position.lng, '_blank');
                                                window.open(
                                                        'https://www.google.com/maps/dir/?api=1&destination=' + position.lat + ',' + position.lng,
                                                        '_blank'
                                                    );
                                            });                                            
                                            
                                        }

                                        // Mostrar/ocultar mapa
                                        function mostrar(a) {
                                            obj = document.getElementById('oculto' + a);
                                            obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';

                                            if (obj.style.visibility == 'hidden') {
                                                $('#map').css({ 'width': '0px', 'height': '0px' });
                                                $('#mosmapa').text("Modificar ubicación de la empresa");
                                            } else {
                                                $('#map').css({ 'width': '100%', 'height': '400px' });
                                                $('#mosmapa').text("Cerrar mapa");

                                                // Si el mapa no se ha inicializado antes, lo inicializas
                                                if (!map) {
                                                    initMap();
                                                } else {
                                                    // Si ya existe, forzar refresco
                                                    setTimeout(function() {
                                                        map.invalidateSize();
                                                    }, 200);
                                                }
                                            }
                                        }
                                    </script>
                        </div>
                        <!-- ***********************aqui termina el mapa para capturar coordenadas *********************** -->
                    </div>
                    <div class="col-md-2">
                            <label for="empresa_latitud" class="control-label">Latitud</label>
                            <div class="form-group">
                                <input type="number" step="any" name="empresa_latitud" value="<?php echo ($this->input->post('empresa_latitud') ? $this->input->post('empresa_latitud') : $empresas['empresa_latitud']); ?>" class="form-control" id="empresa_latitud" />
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="empresa_longitud" class="control-label">Longitud</label>
                            <div class="form-group">
                                <input type="number" step="any" name="empresa_longitud" value="<?php echo ($this->input->post('empresa_longitud') ? $this->input->post('empresa_longitud') : $empresas['empresa_longitud']); ?>" class="form-control" id="empresa_longitud" />
                            </div>
                    </div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Guardar
		</button>
                            <a href="<?php echo site_url('empresa/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>