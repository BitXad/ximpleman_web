<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    function mostrar(a) {
        obj = document.getElementById('oculto'+a);
        obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
        //objm = document.getElementById('map');
        if(obj.style.visibility == 'hidden'){
            $('#map').css({ 'width':'0px', 'height':'0px' });
            $('#mosmapa').text("Obtener ubicación de la empresa");
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
              	<h3 class="box-title">Añadir Empresa</h3>
            </div>
            <?php echo form_open_multipart('empresa/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="empresa_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="empresa_nombre" value="<?php echo $this->input->post('empresa_nombre'); ?>" class="form-control" id="empresa_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
							<span class="text-danger"><?php echo form_error('empresa_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_eslogan" class="control-label">Eslogan</label>
						<div class="form-group">
							<input type="text" name="empresa_eslogan" value="<?php echo $this->input->post('empresa_eslogan'); ?>" class="form-control" id="empresa_eslogan" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="empresa_direccion" value="<?php echo $this->input->post('empresa_direccion'); ?>" class="form-control" id="empresa_direccion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="empresa_telefono" class="control-label">Teléfono (Máximo 20 Caracteres)</label>
						<div class="form-group">
                                                    <input type="text" maxlength="25" name="empresa_telefono" value="<?php echo $this->input->post('empresa_telefono'); ?>" class="form-control" id="empresa_telefono" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="empresa_imagen" class="control-label">Imagen (recomendado 4:3)</label>
						<div class="form-group">
                                                    <input type="file" name="empresa_imagen" value="<?php echo $this->input->post('empresa_imagen'); ?>" class="form-control" id="empresa_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="empresa_zona" class="control-label">Zona</label>
						<div class="form-group">
							<input type="text" name="empresa_zona" value="<?php echo $this->input->post('empresa_zona'); ?>" class="form-control" id="empresa_zona" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="empresa_ubicacion" class="control-label">Ubicación</label>
						<div class="form-group">
							<input type="text" name="empresa_ubicacion" value="<?php echo $this->input->post('empresa_ubicacion'); ?>" class="form-control" id="empresa_ubicacion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
                            <div class="col-md-4">
                                <label for="empresa_departamento" class="control-label">Departamento</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_departamento" value="<?php echo $this->input->post('empresa_departamento'); ?>" class="form-control" id="empresa_departamento" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="empresa_propietario" class="control-label">Propietario</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_propietario" value="<?php echo $this->input->post('empresa_propietario'); ?>" class="form-control" id="empresa_propietario" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="empresa_profesion" class="control-label">Profesión</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_profesion" value="<?php echo $this->input->post('empresa_profesion'); ?>" class="form-control" id="empresa_profesion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="empresa_cargo" class="control-label">Cargo</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_cargo" value="<?php echo $this->input->post('empresa_cargo'); ?>" class="form-control" id="empresa_cargo" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="empresa_codigo" class="control-label">Código</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_codigo" value="<?php echo $this->input->post('empresa_codigo'); ?>" class="form-control" id="empresa_codigo" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="empresa_email" class="control-label">Correo Electronico</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_email" value="<?php echo $this->input->post('empresa_email'); ?>" class="form-control" id="empresa_email" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                </div>
                            </div>
                            <div class="col-md-6">
                        <label  class="control-label"><a href="#" class="btn btn-success btn-sm " id="mosmapa" onclick="mostrar('1'); return false">Obtener ubicación de la empresa</a></label>
                        <!-- ***********************aqui empieza el mapa para capturar coordenadas *********************** -->
                        <div id="oculto1" style="visibility:hidden">
                        <div id="map"></div>
                        <script type="text/javascript">
                            var marker;          //variable del marcador
                            var coords_lat = {};    //coordenadas obtenidas con la geolocalización
                            var coords_lng = {};    //coordenadas obtenidas con la geolocalización


                            //Funcion principal
                            initMap = function () 
                            {
                                //usamos la API para geolocalizar el usuario
                                    navigator.geolocation.getCurrentPosition(
                                      function (position){
                                        coords_lat =  {
                                          lat: position.coords.latitude,
                                        };
                                        coords_lng =  {
                                          lng: position.coords.longitude,
                                        };
                                        setMapa(coords_lat, coords_lng);  //pasamos las coordenadas al metodo para crear el mapa

                                      },function(error){console.log(error);});
                            }

                            function setMapa (coords_lat, coords_lng)
                            {
                                    document.getElementById("empresa_latitud").value = coords_lat.lat;
                                    document.getElementById("empresa_longitud").value = coords_lng.lng;
                                  //Se crea una nueva instancia del objeto mapa
                                  var map = new google.maps.Map(document.getElementById('map'),
                                  {
                                    zoom: 13,
                                    center:new google.maps.LatLng(coords_lat.lat,coords_lng.lng),

                                  });

                                  //Creamos el marcador en el mapa con sus propiedades
                                  //para nuestro obetivo tenemos que poner el atributo draggable en true
                                  //position pondremos las mismas coordenas que obtuvimos en la geolocalización
                                  marker = new google.maps.Marker({
                                    map: map,
                                    draggable: true,
                                    animation: google.maps.Animation.DROP,
                                    position: new google.maps.LatLng(coords_lat.lat,coords_lng.lng),

                                  });
                                  //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
                                  //cuando el usuario a soltado el marcador
                                  //marker.addListener('click', toggleBounce);

                                  marker.addListener( 'dragend', function (event)
                                  {
                                    //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                                    document.getElementById("empresa_latitud").value = this.getPosition().lat();
                                    document.getElementById("empresa_longitud").value = this.getPosition().lng();
                                  });
                            }
                            initMap();
                        </script>                                            
                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $parametro['parametro_apikey']?>&callback=initMap"></script>                                            
                        </div>
                        <!-- ***********************aqui termina el mapa para capturar coordenadas *********************** -->
                    </div>
                    <div class="col-md-2">
                            <label for="empresa_latitud" class="control-label">Latitud</label>
                            <div class="form-group">
                                <input type="number" step="any" name="empresa_latitud" value="<?php echo $this->input->post('empresa_latitud'); ?>" class="form-control" id="empresa_latitud" />
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="empresa_longitud" class="control-label">Longitud</label>
                            <div class="form-group">
                                <input type="number" step="any" name="empresa_longitud" value="<?php echo $this->input->post('empresa_longitud'); ?>" class="form-control" id="empresa_longitud" />
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