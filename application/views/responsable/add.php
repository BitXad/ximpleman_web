<style type="text/css">
    #mapa{
        height: 100%;
        width: 100%;
    }
</style>
<script type="text/javascript">
    function muestra_oculta(id){
    if (document.getElementById){ //se obtiene el id
    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
    el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
        if(el.style.display == 'none'){
            $('#mosmapa').text("Ubicación Domicilio");
        }else{
            $('#mapa').css({ 'width':'500px', 'height':'400px' });
        $('#mosmapa').text("Cerrar mapa");
        }
    }
    }
    window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
    muestra_oculta('mapa');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
    }
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Responsable</h3>
            </div>
            <?php echo form_open_multipart('responsable/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="responsable_nombres" class="control-label"><span class="text-danger">*</span>Nombres</label>
						<div class="form-group">
							<input type="text" name="responsable_nombres" value="<?php echo $this->input->post('responsable_nombres'); ?>" class="form-control" id="responsable_nombres" required />
							<span class="text-danger"><?php echo form_error('responsable_nombres');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable_apellidos" class="control-label"><span class="text-danger">*</span>Apellidos</label>
						<div class="form-group">
							<input type="text" name="responsable_apellidos" value="<?php echo $this->input->post('responsable_apellidos'); ?>" class="form-control" id="responsable_apellidos" required />
							<span class="text-danger"><?php echo form_error('responsable_apellidos');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable_ci" class="control-label">Ci</label>
						<div class="form-group">
							<input type="text" name="responsable_ci" value="<?php echo $this->input->post('responsable_ci'); ?>" class="form-control" id="responsable_ci" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable_cargo" class="control-label">Cargo</label>
						<div class="form-group">
							<input type="text" name="responsable_cargo" value="<?php echo $this->input->post('responsable_cargo'); ?>" class="form-control" id="responsable_cargo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable_telefono" class="control-label">Teléfono</label>
						<div class="form-group">
							<input type="text" name="responsable_telefono" value="<?php echo $this->input->post('responsable_telefono'); ?>" class="form-control" id="responsable_telefono" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="responsable_direccion" value="<?php echo $this->input->post('responsable_direccion'); ?>" class="form-control" id="responsable_direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable_imagen" class="control-label">Imagen</label>
						<div class="form-group">
                                                    <input type="file" name="responsable_imagen" value="<?php echo $this->input->post('responsable_imagen'); ?>" class="form-control" id="responsable_imagen" accept="image/png, image/jpeg, jpg, image/gif" />
						</div>
					</div>
					<div class="col-md-6">
                                            <div class="titulo_boton">
                                                <a onClick="muestra_oculta('mapa')" id="mosmapa" class="btn btn-success">Ubicación Domicilio</a>
                                            </div>
                                            <div id="mapa"></div>
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
                                                      //Se crea una nueva instancia del objeto mapa
                                                      var map = new google.maps.Map(document.getElementById('mapa'),
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
                                                        document.getElementById("responsable_latitud").value = this.getPosition().lat();
                                                        document.getElementById("responsable_longitud").value = this.getPosition().lng();
                                                      });
                                                }
                                                initMap();
                                            </script>
                                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5L7UMFw0GxFZgVXCfMLhGVK5Gn7HvG_U&callback=initMap"></script>
					</div>
					<div class="col-md-6">
						<label for="responsable_latitud" class="control-label">Latitud</label>
						<div class="form-group">
							<input type="number" step="any" name="responsable_latitud" value="<?php echo $this->input->post('responsable_latitud'); ?>" class="form-control" id="responsable_latitud" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable_longitud" class="control-label">Longitud</label>
						<div class="form-group">
							<input type="number" step="any" name="responsable_longitud" value="<?php echo $this->input->post('responsable_longitud'); ?>" class="form-control" id="responsable_longitud" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                    <a href="<?php echo site_url('responsable/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>