<script type="text/javascript">
function mostrar(a) {
    obj = document.getElementById('oculto'+a);
    obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
    //objm = document.getElementById('map');
    if(obj.style.visibility == 'hidden'){
        $('#map').css({ 'width':'0px', 'height':'0px' });
        $('#mosmapa').text("Obtener Ubicación del negocio");
    }else{
        $('#map').css({ 'width':'500px', 'height':'400px' });
        $('#mosmapa').text("Cerrar mapa");
    }

}
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $("#cliente_nombre").change(function(){
        var nombre = $("#cliente_nombre").val();
        var cad1 = nombre.substring(0,2);
        var cad2 = nombre.substring(nombre.length-1,nombre.length);
        var fecha = new Date();
        var pararand = fecha.getFullYear()+fecha.getMonth()+fecha.getDay();
        var cad3 = Math.floor((Math.random(1001,9999) * pararand));
        var cad = cad1+cad2+cad3;
        $('#cliente_codigo').val(cad);
        $('#cliente_razon').val(nombre);
    });
    $("#cliente_ci").change(function(){
        var ci = $("#cliente_ci").val();
        $('#cliente_nit').val(ci);
    });
  });
    
</script>
<style type="text/css">
    #map{
        height: 100%;
        width: 100%;
    }
</style>

    <div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Cliente</h3>
            </div>
            <?php echo form_open('cliente/clientenuevo/'.$pedido_id); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                                        <div class="col-md-6">
						<label for="cliente_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="cliente_nombre" value="<?php echo $this->input->post('cliente_nombre'); ?>" class="form-control" id="cliente_nombre"  required onKeyUp="this.value = this.value.toUpperCase();"/>
							<span class="text-danger"><?php echo form_error('cliente_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_ci" class="control-label">CI</label>
						<div class="form-group">
							<input type="text" name="cliente_ci" value="<?php echo $this->input->post('cliente_ci'); ?>" class="form-control" id="cliente_ci" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="cliente_direccion" value="<?php echo $this->input->post('cliente_direccion'); ?>" class="form-control" id="cliente_direccion" onKeyUp="this.value = this.value.toUpperCase();"/>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="cliente_codigo" class="control-label">Código</label>
						<div class="form-group">
                                                    <input type="text" name="cliente_codigo" value="<?php echo $this->input->post('cliente_codigo'); ?>" class="form-control" id="cliente_codigo" readonly onKeyUp="this.value = this.value.toUpperCase();"/>
							<span class="text-danger"><?php echo form_error('cliente_codigo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_telefono" class="control-label">Teléfono</label>
						<div class="form-group">
							<input type="text" name="cliente_telefono" value="<?php echo $this->input->post('cliente_telefono'); ?>" class="form-control" id="cliente_telefono" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_celular" class="control-label">Celular</label>
						<div class="form-group">
							<input type="text" name="cliente_celular" value="<?php echo $this->input->post('cliente_celular'); ?>" class="form-control" id="cliente_celular" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_foto" class="control-label">Foto</label>
						<div class="form-group">
                                                    <input type="file" name="cliente_foto" value="<?php echo $this->input->post('cliente_foto'); ?>" class="form-control" id="cliente_foto" accept="image/png, image/jpeg, jpg, image/gif" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_email" class="control-label">Email</label>
						<div class="form-group">
                                                    <input type="email" name="cliente_email" value="<?php echo $this->input->post('cliente_email'); ?>" class="form-control" id="cliente_email" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_nombrenegocio" class="control-label"><span class="text-danger"></span>Nombre Negocio</label>
						<div class="form-group">
                                                    <input type="text" name="cliente_nombrenegocio" value="<?php echo $this->input->post('cliente_nombrenegocio'); ?>" class="form-control" id="cliente_nombrenegocio"  onKeyUp="this.value = this.value.toUpperCase();"/>
                                                        <span class="text-danger"><?php echo form_error('cliente_nombrenegocio');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_aniversario" class="control-label">Aniversario</label>
						<div class="form-group">
                                                    <input type="date" name="cliente_aniversario" value="<?php echo $this->input->post('cliente_aniversario'); ?>" class="form-control" id="cliente_aniversario" />
						</div>
					</div>
                                        <div class="col-md-6">
                                            <label  class="control-label"><a href="#" class="btn btn-success btn-sm " id="mosmapa" onclick="mostrar('1'); return false">Obtener Ubicación del negocio</a></label>
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
                                                        document.getElementById("cliente_latitud").value = coords_lat.lat;
                                                        document.getElementById("cliente_longitud").value = coords_lng.lng;
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
                                                        document.getElementById("cliente_latitud").value = this.getPosition().lat();
                                                        document.getElementById("cliente_longitud").value = this.getPosition().lng();
                                                      });
                                                }
                                                initMap();
                                            </script>
                                            <script async defer src="https://maps.google.com/maps/api/js?key=AIzaSyC5L7UMFw0GxFZgVXCfMLhGVK5Gn7HvG_U"></script>
                                            <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5L7UMFw0GxFZgVXCfMLhGVK5Gn7HvG_U&callback=initMap"></script>-->
                                            
                                            </div>
                                            <!-- ***********************aqui termina el mapa para capturar coordenadas *********************** -->
					</div>
					<div class="col-md-6">
						<label for="cliente_latitud" class="control-label">Latitud</label>
						<div class="form-group">
                                                    <input type="number" step="any" name="cliente_latitud" value="<?php echo $this->input->post('cliente_latitud'); ?>" class="form-control" id="cliente_latitud" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_longitud" class="control-label">Longitud</label>
						<div class="form-group">
                                                    <input type="number" step="any" name="cliente_longitud" value="<?php echo $this->input->post('cliente_longitud'); ?>" class="form-control" id="cliente_longitud" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_nit" class="control-label">Nit</label>
						<div class="form-group">
                                                    <input type="text" name="cliente_nit" value="<?php echo ($this->input->post('cliente_nit') ? $this->input->post('cliente_nit') : '0'); ?>" class="form-control" id="cliente_nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_razon" class="control-label">Razon</label>
						<div class="form-group">
							<input type="text" name="cliente_razon" value="<?php echo ($this->input->post('cliente_razon') ? $this->input->post('cliente_razon') : 'SIN NOMBRE'); ?>" class="form-control" id="cliente_razon"  onKeyUp="this.value = this.value.toUpperCase();"/>
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipocliente_id" class="control-label"><span class="text-danger">*</span>Tipo</label>
						<div class="form-group">
							<select name="tipocliente_id" class="form-control" required>
								<option value="">- TIPO CLIENTE -</option>
								<?php 
								foreach($all_tipo_cliente as $tipo_cliente)
								{
									$selected = ($tipo_cliente['tipocliente_id'] == $this->input->post('tipocliente_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$tipo_cliente['tipocliente_id'].'" '.$selected.'>'.$tipo_cliente['tipocliente_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="categoriaclie_id" class="control-label"><span class="text-danger">*</span>Categoria</label>
						<div class="form-group">
							<select name="categoriaclie_id" class="form-control" required>
								<option value="">- CATEGORIA CLIENTE -</option>
								<?php 
								foreach($all_categoria_cliente as $categoria_cliente)
								{
									$selected = ($categoria_cliente['categoriaclie_id'] == $this->input->post('categoriaclie_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$categoria_cliente['categoriaclie_id'].'" '.$selected.'>'.$categoria_cliente['categoriaclie_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="zona_id" class="control-label">Zona</label>
						<div class="form-group">
							<select name="zona_id" class="form-control">
								<option value="0">- ZONA -</option>
								<?php 
								foreach($zona as $categoria_clientezona)
								{
									$selected = ($categoria_clientezona['zona_id'] == $this->input->post('zona_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$categoria_clientezona['zona_id'].'" '.$selected.'>'.$categoria_clientezona['zona_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="usuario_id" class="control-label">Prevendedor</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="">- ASIGNAR PREVENDEDOR -</option>
								<?php 
								foreach($all_usuario_prev as $usuario_prev)
								{
									$selected = ($usuario_prev['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario_prev['usuario_id'].'" '.$selected.'>'.$usuario_prev['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                                <?php   foreach($all_estado as $estado)
                                                        {
                                                            if($estado['estado_descripcion'] == "ACTIVO"){
                                                                echo '<input type="hidden" name="estado_id" value="'.$estado['estado_id'].'" />';
                                                            }
                                                        }
                                                ?>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                <a href="<?php echo site_url('pedido/pedidoabierto/'.$pedido_id); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>