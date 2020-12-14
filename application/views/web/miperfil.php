<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title><?php echo $pagina_web[0]['pagina_nombre']; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ximpleman, Sistema de facturación, Sistema de ventas, facturacíon, Password SRL, Password Ingenieria Hardware & Software" />
<meta property="og:image" content="<?php echo site_url('resources/images/icono.png');?>" >
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<?php $raiz = base_url('resources/web/'); ?>

<link href="<?php echo $raiz;?>css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo $raiz;?>css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="<?php echo $raiz;?>css/font-awesome.css" rel="stylesheet"> 

<!-- //font-awesome icons -->
<!-- js -->
<script src="<?php echo $raiz;?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('resources/js/web_producto.js'); ?>"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo $raiz;?>js/move-top.js"></script>
<script type="text/javascript" src="<?php echo $raiz;?>js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){     
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            
        });
    });
    
    
function mostrar() {
       // $('#map').css({ 'width':'100%', 'height':'400px' });
   
//    obj = document.getElementById('oculto'+a);
//    //obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
//    //objm = document.getElementById('map');
//    if(obj.style.visibility == 'hidden'){
//        $('#map').css({ 'width':'0px', 'height':'0px' });
//        $('#mosmapa').text("Modificar Ubicación del negocio");
//    }else{
//        $('#map').css({ 'width':'100%', 'height':'400px' });
//        $('#mosmapa').text("Cerrar mapa");
//    }

}
    
    
</script>
<script src="//norfipc.com/js/jquery.cookie.js"></script>
<script src="//norfipc.com/js/cookiecompliance.js"></script>

<script type="text/javascript">
function mostrar(a) {
    obj = document.getElementById('oculto'+a);
    obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
    //objm = document.getElementById('map');
    if(obj.style.visibility == 'hidden'){
        $('#map').css({ 'width':'0px', 'height':'0px' });
        $('#mosmapa').text("Mi ubicación");
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



<link href="<?php echo $raiz;?>css/flag-icon.min.css" rel="stylesheet"> 
<link href="<?php echo $raiz;?>css/bootstrap-select.min.css" rel="stylesheet"> 
<link rel="shortcut icon" href="<?php echo site_url('resources/images/icono.png');?>" />
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!-- start-smoth-scrolling -->
</head>
    
<body onload="buscar_por_categoria(<?php echo $parametro[0]["parametro_mostrarcategoria"]; ?>)">
<!-- header -->
<!------------------ PRIMERA SECCION -------------------------------------->
    <div class="agileits_header">
            <div class="container" style="margin-bottom: -10px; ">
                <div class="w3l_offers">                        
                        <b> <?php if (strlen($pagina_web[0]['empresa_nombre'])>28) { ?> 
                            <a href="<?php echo base_url();?>" style="color: white;  -webkit-text-stroke: 0px darkorange;font-size: 15px"><?php echo $pagina_web[0]['empresa_nombre']; } else { ?>
                            <a href="<?php echo base_url();?>" style="color: white;  -webkit-text-stroke: 0px darkorange;font-size: 20px"><?php echo $pagina_web[0]['empresa_nombre']; } ?> </a></b>
                </div>
<!------------------ MENU CABECERA  ----------------------------------->                    
                <div class="agile-login">
                    <ul>
                        <li><a href="" data-toggle="modal" data-target="#seguimientoOT">Clientes</a></li>
                        <li><a href="" data-toggle="modal" data-target="#seguimientoservicio">servicio</a></li>
                        <?php foreach($menu_cabecera as $cabecera) { ?>
                        <li><a href="<?php echo base_url().$cabecera['menu_enlace']; ?>"><?php echo $cabecera['menu_nombre']; ?></a></li>
                        <?php } ?>
                        <!--<li><select class="selectpicker" data-width="fit">
                    <option data-content='<span class="flag-icon flag-icon-us"></span> English'><span class="flag-icon flag-icon-us"></span>English</option>
                    <option  data-content='<span class="flag-icon flag-icon-mx"></span> Español'>Español</option>
                    </select></li>-->
                    </ul>

                </div>
                    <!-- --------------- INICIO Modal para ver el avance de servicios --------------- -->
                    <div class="modal fade" id="seguimientoservicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                            <br><br>
                            <div class="modal-content text-left">
                          <div class="modal-header">
                              <label>Seguimiento:</label> Soporte Técnico
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                          </div>
                            <?php
                            echo form_open('seguimiento/index');
                            ?>
                          <div class="modal-body">
                           <!-- --------------------------------------------------------------- -->
                           <div class="row">
                                <div class="col-md-6">
                                    <label for="usuario" class="control-label"><span class="text-danger">*</span>Usuario</label>
                                    <div class="form-group">
                                        <input type="text" name="usuario" id="usuario" class="form-control" required  autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="contrasen" class="control-label"><span class="text-danger">*</span>Contrase&ntilde;a</label>
                                    <div class="form-group">
                                        <input type="password" name="contrasen" id="contrasen" class="form-control" required autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                           <!------------------------------------------------------------------->
                          </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-binoculars"></i> Seguimiento
                                    </button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>
                    <!-- --------------- F I N Modal para ver el avance de servicios --------------- -->
                     <!-- --------------- INICIO Modal para ver el avance de OT --------------- -->
                    <div class="modal fade" id="seguimientoOT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                            <br><br>
                            <div class="modal-content text-left">
                          <div class="modal-header">
                              <label>Seguimiento:</label> Ordenes de trabajo
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                          </div>
                           
                          <div class="modal-body">
                           <!-- --------------------------------------------------------------- -->
                           <div class="row">
                            <div class="col-md-6">
                                <label for="orden" class="control-label">Orden</label>
                                <div class="form-group">
                                    <input type="text" name="orden" id="orden" class="form-control" required  autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="transaccion" class="control-label">Código</label>
                                <div class="form-group">
                                    <input type="text" name="transaccion" id="transaccion" class="form-control" required autocomplete="off" />
                                </div>
                            </div>
                            </div>
                            
                           <!------------------------------------------------------------------->
                          </div>
                          <div class="modal-footer">
                            <button type="button" onclick="buscarseguimiento()" class="btn btn-success">
                                    <i class="fa fa-check "></i> Consultar
                            </button>
                          </div>
                            
                        </div>
                      </div>
                    </div>
                    <!-- --------------- F I N Modal para ver el avance de OT --------------- -->
                    
                <div class="product_list_header">  
                    <form action="#" method="post" class="last"> 
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="display" value="1">
                        <button class="w3view-cart" type="button" class="btn btn-primary" onclick="tablacarrito()"><i class="fa fa-cart-arrow-down" aria-hidden="true" title="Mi Carrito"></i></button>
                        
                        <?php if(isset($_COOKIE["cliente_id"])) { ?>
                                <button class="w3view-cart" type="button" class="btn btn-primary" onclick="javascript:$.fn.CookieCompliance.disconsent(),cerrarsesion()"><i class="fa fa-sign-out" aria-hidden="true" title="Cerrar Sesion"></i></button>
                        <?php }  ?>

                    </form>

                </div>

                   
                    
                    
                <div class="clearfix"> </div>
<!------------------ FIN MENU CABECERA  ----------------------------------->                    
            </div>
    </div>
<!------------------ FIN PRIMERA SECCION ----------------------------------->


<!------------------ SEGUNDA SECCION ------------------------>
    <div class="logo_products" style="padding:0;">
        <div class="container">
        <div class="w3ls_logo_products_left1">
                <ul class="phone_email">
                    <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo 'PEDIDOS: '.$pagina_web[0]['pagina_telefono']; ?></li>
                    
                </ul>
            </div>
            <div class="w3ls_logo_products_left">
                <h1><a href="<?php echo base_url();?>"><?php echo $pagina_web[0]['empresa_nombre']; ?></a></h1>
            </div>
            
            <div class="clearfix"> </div>
        </div>
    </div>

<!---------------------------------- FIN SEGUNDA SECCION -------------------------------------->







<!-- //header -->
<!-- navigation -->
    <div class="navigation-agileits">
        <div class="container">
            <nav class="navbar navbar-default">
                            
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header nav_2">
                                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div> 
                            
                            <!--------------------- MENU PRINCIPAL ---------------------------------------->                            
                            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                                    <ul class="nav navbar-nav">
                                        
                                        <?php foreach($menu_principal as $principal) { ?>                                                                                
                                            <li class="active"><a href="<?php echo base_url(); ?>" class="act"><?php echo $principal['menu_nombre']; ?></a></li>
                                        <?php } ?>                                        
                                            
                                            

                                        

                                        <!------- Bloque de codigo 1 ------------>
                                        
                        <?php if(isset($_COOKIE["cliente_id"])) { 
                            
                                        $nombre_cliente = ucwords(strtolower($_COOKIE["cliente_nombre"])); 
                                        
                                        if(strlen($nombre_cliente)>15){
                                                $nombre_cliente = substr($nombre_cliente, 0, 12)."..";
                                        }
                        ?>
                                    
                                        <!------- Inicio menu usuario ------------>                                        
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><fa class="fa fa-user"></fa><small> <?php echo $nombre_cliente; ?></small></a>
                                            <ul class="dropdown-menu multi-column columns-3">
                                                <div class="row">
                                                    <div class="multi-gd-img">
                                                        <ul class="multi-column-dropdown">
                                                            <!--<h6>Todas</h6>-->
                                                            <li><a href="<?php echo base_url("website/miperfil/").$idioma_id; ?>" >Mi perfil</a></li>
                                                            <li><a href="<?php echo base_url("website/micarrito/").$idioma_id; ?>" >Mi carrito</a></li>
                                                            <li><a href="<?php echo base_url("website/miscompras/").$idioma_id; ?>" >Mis Compras</a></li>
                                                            <li><a href="<?php echo base_url("/")?>" onclick="javascript:$.fn.CookieCompliance.disconsent(),cerrarsesion(),FB.logout()" >Finalizar Sesion</a></li>
                                                            
                                                        </ul>
                                                    </div>	

                                                </div>
                                        </ul>
                                    </li>                                         
                                    <!------- Fin menu usuario ------------>                                                                            
                        <?php } else{ ?>                                    

                                        <!------- Inicio iniciar sesion ------------>                                        
                                        <li class="dropdown">
                                            <a href="#modalCliente" data-target="#modalCliente"  class="dropdown-toggle" data-toggle="modal">Iniciar Sesión</a>
                                        </li>                                         
                                        <!------- Fin iniciar sesion ----------
                                                                       
                        <?php }  ?>                                    
                                    
                                        
                                    </ul>
                                <ul>
                                
                                </ul>
                                
                                </div>
                                <!--------------------- FIN MENU PRINCIPAL ---------------------------------------->                            
                            </nav>
            </div>
        </div>
        
<!-- //navigation -->
    


<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Inicio</a></li>
				<li class="active">Mi Perfil</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->

<!------------------------------------ contenido -------------------->





<div class="row">
    
    
    <div class="col-md-2"></div>
    
    <div class="col-md-8">
      	<div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                <img src="<?php echo base_url("resources/images/clientes/".$cliente['cliente_foto']); ?>" width="50" height="50" class="img img-circle">    
                    Mi Perfil
                </h3>

                
            </div>
            <?php echo form_open_multipart('website/modificarperfil/'.$cliente['cliente_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="cliente_nombre" class="control-label"><fa class="fa fa-user"></fa> Nombre <span class="text-blue">(*)</span></label>
                            <div class="form-group">
                                    <input type="text" name="cliente_nombre" value="<?php echo ($this->input->post('cliente_nombre') ? $this->input->post('cliente_nombre') : $cliente['cliente_nombre']); ?>" class="form-control" id="cliente_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                    <span class="text-danger"><?php echo form_error('cliente_nombre');?></span>
                            </div>
                    </div>
                                        
                    <div class="col-md-6">
                            <label for="cliente_direccion" class="control-label"><fa class="fa fa-calendar-o"></fa> Dirección <span class="text-blue">(*)</span></label>
                            <div class="form-group">
                                <input type="text" name="cliente_direccion" value="<?php echo ($this->input->post('cliente_direccion') ? $this->input->post('cliente_direccion') : $cliente['cliente_direccion']); ?>" class="form-control" id="cliente_direccion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" required/>
                            </div>
                    </div>

                    <div class="col-md-4">
                        <label for="cliente_celular" class="control-label"><fa class="fa fa-mobile"></fa> Celular <span class="text-blue">(*)</span></label>
                            <div class="form-group">
                                <input type="text" name="cliente_celular" value="<?php echo ($this->input->post('cliente_celular') ? $this->input->post('cliente_celular') : $cliente['cliente_celular']); ?>" class="form-control" id="cliente_celular" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" required />
                            </div>
                    </div>

                    <div class="col-md-4">
                            <label for="cliente_telefono" class="control-label"><fa class="fa fa-phone"></fa> Teléfono Fijo</label>
                            <div class="form-group">
                                    <input type="text" name="cliente_telefono" value="<?php echo ($this->input->post('cliente_telefono') ? $this->input->post('cliente_telefono') : $cliente['cliente_telefono']); ?>" class="form-control" id="cliente_telefono" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                    </div>
                    <div class="col-md-4">
                            <label for="cliente_foto" class="control-label"><fa class="fa fa-picture-o"></fa> Foto</label>
                            <div class="form-group">
                                <input type="file" name="cliente_foto" value="<?php echo ($this->input->post('cliente_foto') ? $this->input->post('cliente_foto') : $cliente['cliente_foto']); ?>" class="btn btn-success btn-sm form-control" id="cliente_foto" accept="image/png, image/jpeg, jpg, image/gif" />
                                <input type="hidden" name="cliente_foto1" value="<?php echo ($this->input->post('cliente_foto') ? $this->input->post('cliente_foto') : $cliente['cliente_foto']); ?>" class="form-control" id="cliente_foto1" />
                            </div>
                    </div>


                    <div class="col-md-4">
                            <label for="cliente_nombrenegocio" class="control-label"><fa class="fa fa-building"></fa> Nombre Negocio</label>
                            <div class="form-group">
                                <input type="text" name="cliente_nombrenegocio" value="<?php echo ($this->input->post('cliente_nombrenegocio') ? $this->input->post('cliente_nombrenegocio') : $cliente['cliente_nombrenegocio']); ?>" class="form-control" id="cliente_nombrenegocio" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                <span class="text-danger"><?php echo form_error('cliente_nombrenegocio');?></span>
                            </div>
                    </div>

                    <div class="col-md-4">
                            <label for="cliente_nit" class="control-label"><fa class="fa fa-folder"></fa> Nit</label>
                            <div class="form-group">
                                <input type="number" min="0" onchange="verificarnumero(this.value)" name="cliente_nit" value="<?php echo ($this->input->post('cliente_nit') ? $this->input->post('cliente_nit') : $cliente['cliente_nit']); ?>" class="form-control" id="cliente_nit" />
                            </div>
                    </div>
                    <div class="col-md-4">
                            <label for="cliente_razon" class="control-label"><fa class="fa fa-codepen"></fa> Razón Social</label>
                            <div class="form-group">
                                <input type="text" name="cliente_razon" value="<?php echo ($this->input->post('cliente_razon') ? $this->input->post('cliente_razon') : $cliente['cliente_razon']); ?>" class="form-control" id="cliente_razon" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                    </div>

                    <div class="col-md-12">
                        <label  class="control-label"><a href="#" class="btn btn-success btn-sm " id="mosmapa" onclick="mostrar('1'); return false"><fa class="fa fa-map"></fa> Mi ubicación</a></label>
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
                                    zoom: 17,
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
                    <div class="col-md-3">
                            <label for="cliente_latitud" class="control-label">Latitud</label>
                            <div class="form-group">
                                <input type="number" step="any" name="cliente_latitud" value="<?php echo ($this->input->post('cliente_latitud') ? $this->input->post('cliente_latitud') : $cliente['cliente_latitud']); ?>" class="form-control" id="cliente_latitud" readonly="true"/>
                            </div>
                    </div>
                    <div class="col-md-3" >
                            <label for="cliente_longitud" class="control-label">Longitud</label>
                            <div class="form-group">
                                <input type="number" step="any" name="cliente_longitud" value="<?php echo ($this->input->post('cliente_longitud') ? $this->input->post('cliente_longitud') : $cliente['cliente_longitud']); ?>" class="form-control" id="cliente_longitud"  readonly="true" />
                            </div>
                    </div>

                    <div class="col-md-3" hidden="true">
                                <input type="number" step="any" name="idioma_id" value="<?php echo $idioma_id; ?>" class="form-control" id="idioma_id"  readonly="true" />
                    </div>
                    


                </div>
            </div>
            <div class="row">
                <br>
            </div>
            <div class="box-footer">
                <center>
                    <a href="<?php echo site_url('cliente/index'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Salir</a>
                    <button type="submit" class="btn btn-success">
                            <i class="fa fa-floppy-o"></i> Guardar
                    </button>
                    
                </center>
            </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
    
    
    <div class="col-md-2"></div>
</div>
<br>






<!------------------------------------ fin contenido -------------------->

<!----------------- fin modal mensaje ---------------------------------------------->
<div hidden="true">
    
<button type="button" id="boton_modal_mensaje" class="btn btn-primary" data-toggle="modal" data-target="#modalmensaje" >
  Modal mensaje
</button>
</div>
<!----------------- modal preferencias ---------------------------------------------->

<div class="modal fade" id="modalmensaje" tabindex="-1" role="dialog" aria-labelledby="modalmensaje" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>ADVERTENCIA</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                            </center>
                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive">

                            <div class="col-md-3" id="imagen_advertencia">
                                <center>
                                    <img src="<?php echo base_url("resources/web/images/advertencia.png"); ?>" width="50px;" height="50px;" >                                    
                                </center>
                            </div>

                            <div class="col-md-9">
                                <center>
                                    
                                    <div class="form-group" id="mensaje_advertencia">
                                        <b> La operacion es invalida...!</b>
                                        <br> Revise los parámetros por favor...!!                                            
                                    </div>

                                </center>
                            </div>

                            
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
                    
                    <div class="modal-footer" >
                        <center>
                            <button class="btn btn-danger" id="cancelar_preferencia" data-dismiss="modal" >
                                    <span class="fa fa-close"></span>  Aceptar
                            </button>                                                    
                        </center>
                    </div>
                    
		</div>
	</div>
</div>


<!----------------- fin modal preferencias ---------------------------------------------->






<!-- //footer -->
<div class="footer">
        <div class="container">
            <div class="w3_footer_grids">
                <div class="col-md-3 w3_footer_grid">
                    <center>
<!--                    <h3>CONTACTOS</h3>
                    
                    <ul class="address">
                        <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><?php echo $pagina_web[0]['empresa_direccion']; ?>, <?php echo $pagina_web[0]['empresa_departamento']; ?>.</li>
                        <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:<?php echo $pagina_web[0]['empresa_email']; ?>"><?php echo $pagina_web[0]['empresa_email']; ?></a></li>
                        <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i><?php echo $pagina_web[0]['empresa_telefono']; ?></li>
                    </ul>-->
                        <a href="<?php echo base_url("website/ximpleman"); ?>" target="_BLANK" >
                            <img src="<?php echo base_url("resources/web/images/logo.png"); ?>" width="50%" height="50%">
                        </a>
                    </center>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <center>
<!--                    <h3>INFORMACIÓN</h3>
                    <ul class="info"> 
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">About Us</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="contact.html">Contact Us</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="short-codes.html">Short Codes</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="faq.html">FAQ's</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products.html">Special Products</a></li>
                    </ul>-->
                    <ul class="info"> <br>
                        <li><i class="fa" aria-hidden="true"></i><a href="faq.html">Política de privacidad</a></li>
                    
                    </ul>
                    </center>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <center>
<!--                    <h3>CATEGORIAS</h3>
                    <ul class="info"> 
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="groceries.html">Groceries</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="household.html">Household</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="personalcare.html">Personal Care</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="packagedfoods.html">Packaged Foods</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="beverages.html">Beverages</a></li>
                    </ul>-->
                    <ul class="info"> 
                        <br>
                        <li><i class="fa" aria-hidden="true"></i><a href="groceries.html">Un producto de </a></li>
                    </ul>
                    </center>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <center>
                        
                        
<!--                    <h3>MENU</h3>
                    <ul class="info"> 
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products.html">Store</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="checkout.html">My Cart</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="login.html">Login</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="registered.html">Create Account</a></li>
                    </ul>-->

                        <a href="<?php echo base_url("website/password"); ?>" target="_BLANK" >
                        <img src="<?php echo base_url("resources/web/images/logo_password.png"); ?>" width="50%" height="50%">
                        </a>
                    </center>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        
<!--        <div class="footer-copy">
            
            <div class="container">
                <p>© <?php echo date('Y'); ?> Ximpleman, All rights reserved | <a href="http://www.passwordbolivia.com/">Password Ingeniería Hardware & Software </a></p>
            </div>
        </div>-->
        
    </div>  

    <div class="footer-botm">
            <div class="container">
                <div class="w3layouts-foot">
                    <ul>
                        <li><a href="https://www.facebook.com/sisximpleman/" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.twitter.com/sisximpleman/" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <!--<li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>-->
                        <li><a href="https://www.vimeo.com/sisximpleman/" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="payment-w3ls">  
                    <img src="<?php echo $raiz;?>images/card.png" alt=" " class="img-responsive">
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
<!-- //footer -->   
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $raiz;?>js/bootstrap.min.js"></script>
<!-- top-header and slider -->
<!-- here stars scrolling icon -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
                var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
                };
            */
                                
            $().UItoTop({ easingType: 'easeOutQuart' });
                                
            });
    </script>
<!-- //here ends scrolling icon -->
<script src="<?php echo $raiz;?>js/minicart.min.js"></script>
<script>
    // Mini Cart
    paypal.minicart.render({
        action: '#'
    });

    if (~window.location.search.indexOf('reset=true')) {
        paypal.minicart.reset();
    }
</script>
<!-- main slider-banner -->
<script src="<?php echo $raiz;?>js/skdslider.min.js"></script>
<link href="<?php echo $raiz;?>css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
                        
            jQuery('#responsive').change(function(){
              $('#responsive_wrapper').width(jQuery(this).val());
            });
            
        });
</script> 
<!-- //main slider-banner --> 
</body>
</html>