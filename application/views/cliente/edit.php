    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
     <!--Styles for datatables--> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
     <!--JQuery include--> 
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
     <!--Javascrips for datatables--> 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 

<script type="text/javascript">
function mostrar(a) {
    obj = document.getElementById('oculto'+a);
    obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
    //objm = document.getElementById('map');
    if(obj.style.visibility == 'hidden'){
        $('#map').css({ 'width':'0px', 'height':'0px' });
        $('#mosmapa').text("Modificar Ubicación del negocio");
    }else{
        $('#map').css({ 'width':'100%', 'height':'400px' });
        $('#mosmapa').text("Cerrar mapa");
    }

}
</script>
<script type="text/javascript">
    function verificarnumero(numero){
        if(numero <0){
            alert("Nit debe ser Mayor a 0");
            $("#cliente_nit").focus();
        }
        
    }
</script>
<script type="text/javascript">
function toggle(source) {
  checkboxes = document.getElementsByClassName('checkbox');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<script type="text/javascript">
    function cambiarcod(cod){
        var nombre = $("#cliente_nombre").val();
        var cad1 = nombre.substring(0,2);
        var cad2 = nombre.substring(nombre.length-1,nombre.length);
        var fecha = new Date();
        var pararand = fecha.getFullYear()+fecha.getMonth()+fecha.getDay();
        var cad3 = Math.floor((Math.random(1001,9999) * pararand));
        var cad = cad1+cad2+cad3;
        $('#cliente_codigo').val(cad);
    }
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Cliente</h3>&nbsp;&nbsp;
                <button type="button" class="btn btn-success btn-sm" onclick="cambiarcod(this);" title="Volver a generar Código Cliente">
                    <i class="fa fa-edit"></i>Codigo Cliente
		</button>
            </div>
            <?php echo form_open_multipart('cliente/edit/'.$cliente['cliente_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-5">
                            <label for="cliente_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                            <div class="form-group">
                                    <input type="text" name="cliente_nombre" value="<?php echo ($this->input->post('cliente_nombre') ? $this->input->post('cliente_nombre') : $cliente['cliente_nombre']); ?>" class="form-control" id="cliente_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                    <span class="text-danger"><?php echo form_error('cliente_nombre');?></span>
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="cliente_ci" class="control-label">CI</label>
                            <div class="form-group">
                                    <input type="text" name="cliente_ci" value="<?php echo ($this->input->post('cliente_ci') ? $this->input->post('cliente_ci') : $cliente['cliente_ci']); ?>" class="form-control" id="cliente_ci" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                    </div>
                    <div class="col-md-5">
                            <label for="cliente_direccion" class="control-label">Dirección</label>
                            <div class="form-group">
                                    <input type="text" name="cliente_direccion" value="<?php echo ($this->input->post('cliente_direccion') ? $this->input->post('cliente_direccion') : $cliente['cliente_direccion']); ?>" class="form-control" id="cliente_direccion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="cliente_codigo" class="control-label">Código</label>
                            <div class="form-group">
                                <input type="text" name="cliente_codigo" value="<?php echo ($this->input->post('cliente_codigo') ? $this->input->post('cliente_codigo') : $cliente['cliente_codigo']); ?>" class="form-control" id="cliente_codigo" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                    <span class="text-danger"><?php echo form_error('cliente_codigo');?></span>
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="cliente_telefono" class="control-label">Teléfono</label>
                            <div class="form-group">
                                    <input type="text" name="cliente_telefono" value="<?php echo ($this->input->post('cliente_telefono') ? $this->input->post('cliente_telefono') : $cliente['cliente_telefono']); ?>" class="form-control" id="cliente_telefono" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="cliente_celular" class="control-label">Celular</label>
                            <div class="form-group">
                                    <input type="text" name="cliente_celular" value="<?php echo ($this->input->post('cliente_celular') ? $this->input->post('cliente_celular') : $cliente['cliente_celular']); ?>" class="form-control" id="cliente_celular" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                    </div>
                    <div class="col-md-4">
                            <label for="cliente_foto" class="control-label">Foto</label>
                            <div class="form-group">
                                    <input type="file" name="cliente_foto" value="<?php echo ($this->input->post('cliente_foto') ? $this->input->post('cliente_foto') : $cliente['cliente_foto']); ?>" class="btn btn-success btn-sm form-control" id="cliente_foto" accept="image/png, image/jpeg, jpg, image/gif" />
                                    <input type="hidden" name="cliente_foto1" value="<?php echo ($this->input->post('cliente_foto') ? $this->input->post('cliente_foto') : $cliente['cliente_foto']); ?>" class="form-control" id="cliente_foto1" />
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="cliente_aniversario" class="control-label">Aniversario</label>
                            <div class="form-group">
                                    <input type="date" name="cliente_aniversario" value="<?php echo ($this->input->post('cliente_aniversario') ? $this->input->post('cliente_aniversario') : $cliente['cliente_aniversario']); ?>" class="form-control" id="cliente_aniversario" />
                            </div>
                    </div>
                    <div class="col-md-5">
                            <label for="cliente_email" class="control-label">Email</label>
                            <div class="form-group">
                                <input type="email" name="cliente_email" value="<?php echo ($this->input->post('cliente_email') ? $this->input->post('cliente_email') : $cliente['cliente_email']); ?>" class="form-control" id="cliente_email" />
                            </div>
                    </div>
                    <div class="col-md-2">
                        <?php
                                $bencheck =""; $coccheck =""; $chucheck ="";
                                $lapcheck =""; $orucheck =""; $pancheck ="";
                                $potcheck =""; $sancheck =""; $tarcheck ="";
                                if($cliente['cliente_departamento']     == "BENI"){ $bencheck = "selected";}
                                elseif($cliente['cliente_departamento'] == "COCHABAMBA"){ $coccheck = "selected";}
                                elseif($cliente['cliente_departamento'] == "CHUQUISACA"){ $chucheck = "selected";}
                                elseif($cliente['cliente_departamento'] == "LA PAZ"){ $lapcheck = "selected";}
                                elseif($cliente['cliente_departamento'] == "ORURO"){ $orucheck = "selected";}
                                elseif($cliente['cliente_departamento'] == "PANDO"){ $pancheck = "selected";}
                                elseif($cliente['cliente_departamento'] == "POTOSI"){ $potcheck = "selected";}
                                elseif($cliente['cliente_departamento'] == "SANTA CRUZ"){ $sancheck = "selected";}
                                elseif($cliente['cliente_departamento'] == "TARIJA"){ $tarcheck = "selected";}
                                ?>
                        <label for="cliente_departamento" class="control-label">Departamento</label>
                        <div class="form-group">
                            <select name="cliente_departamento" id="cliente_departamento" class="form-control">
                                <option value="">- DEPARTAMENTO -</option>
                                <option  <?php echo $bencheck; ?> value="BENI"> BENI </option>
                                <option <?php echo $coccheck; ?> value="COCHABAMBA"> COCHABAMBA </option>
                                <option <?php echo $chucheck; ?> value="CHUQUISACA"> CHUQUISACA </option>
                                <option <?php echo $lapcheck; ?> value="LA PAZ"> LA PAZ </option>
                                <option <?php echo $orucheck; ?> value="ORURO"> ORURO </option>
                                <option <?php echo $pancheck; ?> value="PANDO"> PANDO </option>
                                <option <?php echo $potcheck; ?> value="POTOSI"> POTOSI </option>
                                <option <?php echo $sancheck; ?> value="SANTA CRUZ"> SANTA CRUZ </option>
                                <option <?php echo $tarcheck; ?> value="TARIJA"> TARIJA </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                            <label for="cliente_nombrenegocio" class="control-label">Nombre Negocio</label>
                            <div class="form-group">
                                <input type="text" name="cliente_nombrenegocio" value="<?php echo ($this->input->post('cliente_nombrenegocio') ? $this->input->post('cliente_nombrenegocio') : $cliente['cliente_nombrenegocio']); ?>" class="form-control" id="cliente_nombrenegocio" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                    <span class="text-danger"><?php echo form_error('cliente_nombrenegocio');?></span>
                            </div>
                    </div>

                    <div class="col-md-4">
                        <label  class="control-label"><a href="#" class="btn btn-success btn-sm " id="mosmapa" onclick="mostrar('1'); return false">Modificar Ubicación del negocio</a></label>
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

                                //milat = document.getElementById('cliente_latitud').value;
                                milat = $('#cliente_latitud').val();
                                //milng = document.getElementById('cliente_longitud').value;
                                milng = $('#cliente_longitud').val();

                                    navigator.geolocation.getCurrentPosition(
                                    function (position){
                                        if(milat == 'undefined' || milat == null || milat ==""){
                                            coords_lat =  {
                                            lat: position.coords.latitude,
                                            };
                                            //milat = position.coords.latitude;
                                        }else{
                                            coords_lat =  {
                                            lat: milat,
                                            };
                                        }
                                        if(milng == 'undefined' || milng == null || milng ==""){
                                            coords_lng =  {
                                              lng: position.coords.longitude,
                                            };
                                            //lng = position.coords.longitude;
                                        }else{
                                            coords_lng =  {
                                              lng: milng,
                                            };
                                        } 
                                        /*coords_lat =  {
                                            lat: milat,
                                            };

                                        coords_lng =  {
                                              lng: milng,
                                            };*/
                                        setMapa(coords_lat, coords_lng);  //pasamos las coordenadas al metodo para crear el mapa


                                      },function(error){console.log(error);});
                            }

                            function setMapa (coords_lat, coords_lng)
                            {
                                //document.getElementById("cliente_latitud").value = coords_lat.lat;
                               // document.getElementById("cliente_longitud").value = coords_lng.lng;
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
                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $parametro[0]['parametro_apikey']?>&callback=initMap"></script>
                        </div>
                        <!-- ***********************aqui termina el mapa para capturar coordenadas *********************** -->
                    </div>
                    <div class="col-md-2">
                            <label for="cliente_latitud" class="control-label">Latitud</label>
                            <div class="form-group">
                                <input type="number" step="any" name="cliente_latitud" value="<?php echo ($this->input->post('cliente_latitud') ? $this->input->post('cliente_latitud') : $cliente['cliente_latitud']); ?>" class="form-control" id="cliente_latitud" />
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="cliente_longitud" class="control-label">Longitud</label>
                            <div class="form-group">
                                <input type="number" step="any" name="cliente_longitud" value="<?php echo ($this->input->post('cliente_longitud') ? $this->input->post('cliente_longitud') : $cliente['cliente_longitud']); ?>" class="form-control" id="cliente_longitud" />
                            </div>
                    </div>
                    <div class="col-md-2">
                        <label for="cdi_codigoclasificador" class="control-label">Tipo de documento</label>
                        <div class="form-group">
                                <select name="cdi_codigoclasificador" id="cdi_codigoclasificador" class="form-control">
                                <?php foreach($cdis as $cdi){ 
                                        $selected = $cliente['cdi_codigoclasificador'] == $cdi['cdi_codigoclasificador'] ? "selected":"";  ?>
                                        <option value="<?= $cdi['cdi_codigoclasificador'] ?>" <?= $selected ?>><?= $cdi['cdi_descripcion'] ?></option>
                                <?php } ?>
                                </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                            <label for="cliente_nit" class="control-label">Numero de Documento</label>
                            <div class="form-group">
                                    <input type="number" min="0" onchange="verificarnumero(this.value)" name="cliente_nit" value="<?php echo ($this->input->post('cliente_nit') ? $this->input->post('cliente_nit') : $cliente['cliente_nit']); ?>" class="form-control" id="cliente_nit" />
                            </div>
                    </div>
                    <div class="col-md-6">
                            <label for="cliente_razon" class="control-label">Razon</label>
                            <div class="form-group">
                                    <input type="text" name="cliente_razon" value="<?php echo ($this->input->post('cliente_razon') ? $this->input->post('cliente_razon') : $cliente['cliente_razon']); ?>" class="form-control" id="cliente_razon" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="tipocliente_id" class="control-label"><span class="text-danger">*</span>Tipo</label>
                            <div class="form-group">
                                    <select name="tipocliente_id" class="form-control" required>
                                            <option value="">- TIPO CLIENTE -</option>
                                            <?php 
                                            foreach($all_tipo_cliente as $tipo_cliente)
                                            {
                                                    $selected = ($tipo_cliente['tipocliente_id'] == $cliente['tipocliente_id']) ? ' selected="selected"' : "";

                                                    echo '<option value="'.$tipo_cliente['tipocliente_id'].'" '.$selected.'>'.$tipo_cliente['tipocliente_descripcion'].'</option>';
                                            } 
                                            ?>
                                    </select>
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="categoriaclie_id" class="control-label"><span class="text-danger">*</span>Categoria</label>
                            <div class="form-group">
                                    <select name="categoriaclie_id" class="form-control" required>
                                            <option value="">- CATEGORIA NEGOCIO -</option>
                                            <?php 
                                            foreach($all_categoria_cliente as $categoria_cliente)
                                            {
                                                    $selected = ($categoria_cliente['categoriaclie_id'] == $cliente['categoriaclie_id']) ? ' selected="selected"' : "";

                                                    echo '<option value="'.$categoria_cliente['categoriaclie_id'].'" '.$selected.'>'.$categoria_cliente['categoriaclie_descripcion'].'</option>';
                                            } 
                                            ?>
                                    </select>
                            </div>
                    </div>
                    <div class="col-md-2">
                            <label for="zona_id" class="control-label">Zona</label>
                            <div class="form-group">
                                    <select name="zona_id" class="form-control">
                                            <option value="0">- CATEGORIA CLIENTE ZONA -</option>
                                            <?php 
                                            foreach($all_categoria_clientezona as $categoria_clientezona)
                                            {
                                                    $selected = ($categoria_clientezona['zona_id'] == $cliente['zona_id']) ? ' selected="selected"' : "";

                                                    echo '<option value="'.$categoria_clientezona['zona_id'].'" '.$selected.'>'.$categoria_clientezona['zona_nombre'].'</option>';
                                            } 
                                            ?>
                                    </select>
                            </div>
                    </div>
                    <div class="col-md-3">
                            <label for="usuario_id" class="control-label">Cliente Asignado a:</label>
                            <div class="form-group">
                                    <select name="usuario_id" class="form-control">
                                            <option value="">- USUARIO -</option>
                                            <?php 
                                            foreach($all_usuario_prev as $usuario_prev)
                                            {
                                                    $selected = ($usuario_prev['usuario_id'] == $cliente['usuario_id']) ? ' selected="selected"' : "";

                                                    echo '<option value="'.$usuario_prev['usuario_id'].'" '.$selected.'>'.$usuario_prev['usuario_nombre'].'</option>';
                                            } 
                                            ?>
                                    </select>
                            </div>
                    </div>
                    <div class="col-md-5">
                        <?php
                                $luncheck =""; $marcheck =""; $miecheck ="";
                                $juecheck =""; $viecheck =""; $sabcheck =""; $domcheck =""; $conta = 0; $todos="";
                                if($cliente['lun'] == 1){ $luncheck = "checked"; $conta=$conta+1;}
                                if($cliente['mar'] == 1){ $marcheck = "checked"; $conta=$conta+1;}
                                if($cliente['mie'] == 1){ $miecheck = "checked"; $conta=$conta+1;}
                                if($cliente['jue'] == 1){ $juecheck = "checked"; $conta=$conta+1;}
                                if($cliente['vie'] == 1){ $viecheck = "checked"; $conta=$conta+1;}
                                if($cliente['sab'] == 1){ $sabcheck = "checked"; $conta=$conta+1;}
                                if($cliente['dom'] == 1){ $domcheck = "checked"; $conta=$conta+1;}
                                if($conta >6){ $todos = "checked";}
                                ?>
                        <label for="dias_visita" class="control-label">Dias de Visita</label><input type="checkbox" id="select_all" onClick="toggle(this)" <?php echo $todos; ?> /> Todos
                            <div class="form-group">

                                <label>Lunes<input class="checkbox" type="checkbox" name="lun" value="1" id="lun" <?php echo $luncheck; ?> /></label>&nbsp;&nbsp;&nbsp;
                                <label>Martes<input class="checkbox" type="checkbox" name="mar" value="1" id="mar" <?php echo $marcheck; ?> /></label>&nbsp;&nbsp;&nbsp;
                                <label>Miercoles<input class="checkbox" type="checkbox" name="mie" value="1" id="mie" <?php echo $miecheck; ?> /></label>&nbsp;&nbsp;&nbsp;
                                <label>Jueves<input class="checkbox" type="checkbox" name="jue" value="1" id="jue" <?php echo $juecheck; ?> /></label>&nbsp;&nbsp;&nbsp;
                                <label>Viernes<input class="checkbox" type="checkbox" name="vie" value="1" id="vie" <?php echo $viecheck; ?> /></label>&nbsp;&nbsp;&nbsp;
                                <label>Sábado<input class="checkbox" type="checkbox" name="sab" value="1" id="sab" <?php echo $sabcheck; ?> /></label>&nbsp;&nbsp;&nbsp;
                                <label>Domingo<input class="checkbox" type="checkbox" name="dom" value="1" id="dom" <?php echo $domcheck; ?> /></label>

                            </div>
                    </div>
                    <div class="col-md-2">
                        <label for="cliente_ordenvisita" class="control-label">Orden Visita</label>
                        <div class="form-group">
                            <input type="number" min="0" name="cliente_ordenvisita" value="<?php echo ($this->input->post('cliente_ordenvisita') ? $this->input->post('cliente_ordenvisita') : $cliente['cliente_ordenvisita']); ?>" class="form-control" id="cliente_ordenvisita" />
                        </div>
                    </div>
                    <div class="col-md-2">
                            <label for="estado_id" class="control-label">Estado</label>
                            <div class="form-group">
                                    <select name="estado_id" class="form-control">
                                            <!--<option value="">- ESTADO -</option>-->
                                            <?php 
                                            foreach($all_estado as $estado)
                                            {
                                                    $selected = ($estado['estado_id'] == $cliente['estado_id']) ? ' selected="selected"' : "";

                                                    echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                                            } 
                                            ?>
                                    </select>
                            </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Guardar
		</button>
                <a href="<?php echo site_url('cliente/index'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
</div>