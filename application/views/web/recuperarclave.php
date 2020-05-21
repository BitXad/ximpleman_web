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

<link href="<?php echo $raiz;?>css/flag-icon.min.css" rel="stylesheet"> 
<link href="<?php echo $raiz;?>css/bootstrap-select.min.css" rel="stylesheet"> 
<link rel="shortcut icon" href="<?php echo site_url('resources/images/icono.png');?>" />
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
                                            
                                            
<!--                                        
                                        <li class="active">
                                            <select class="ac">
                                                
                                        <?php 
                                            foreach($categorias as $cat){?>                    
                                                <option value="<?php echo $cat['categoria_id']; ?>"><?php echo $cat['categoria_nombre']; ?></option>
                                        <?php } ?>      
                                            
                                            </select>        
                                        </li>-->
                                        
<!--                                        
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias<b class="caret"></b></a>
                                            <ul class="dropdown-menu multi-column columns-3">
                                                <div class="row">
                                                    <div class="multi-gd-img">
                                                        <ul class="multi-column-dropdown">
                                                            <h6>Todas</h6>
                                                            <?php 
                                                                foreach($categorias as $cat){?>                    
                                                                    <li><a href="" onclick="buscar_por_categoria(<?php echo $cat['categoria_id']; ?>);"><?php echo $cat['categoria_nombre']; ?></a></li>
                                                                    <li style="padding: 0; margin: 3px;"><button style="background: none; border: transparent; padding:0;" onclick="buscar_por_categoria(<?php echo $cat['categoria_id']; ?>);"><?php echo $cat['categoria_nombre']; ?></button></li>
                                                            <?php } ?>      
                                                        </ul>
                                                    </div>	

                                                </div>
                                        </ul>
                                    </li>                                        
-->
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
                                                            <li><a href="" >Mi perfil</a></li>
                                                            <li><a href="" >Mi carrito</a></li>
                                                            <li><a href="" >Mis Compras</a></li>
                                                            <li><a href="" >Finalizar Sesion</a></li>
                                                            
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
				<li class="active">Recuperar Clave</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->

<!-- register -->
	<div class="register">
		<div class="container">
			<div class="login-form-grids">
                            <div style="background-color: #000000;">
                                <img src="<?php echo base_url("resources/web/images/logo.png") ?>" width="30%" height="30%">
                            </div>
                            <br>
                            <h5><b>Ayuda de contraseña</b></h5>
                                <p style="text-align: justify;">
                                    Introduzca la dirección de correo electrónico o el número de teléfono móvil asociados con su cuenta de Ximpleman, para la empresa <?php echo $pagina_web[0]['empresa_nombre']; ?>.
                                </p>
				<form action="#" method="post">
					<input type="text" placeholder="Correo electrónico" required=" " >
					<!--<input type="text" placeholder="Last Name..." required=" " >-->
                                        <input type="submit" value="Enviar" onclick="enviar_datos()">
				</form>
<!--				<div class="register-check-box">
					<div class="check">
						<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>Subscribe to Newsletter</label>
					</div>
				</div>
				<h6>Login information</h6>
                                <form action="#" method="post">
					<input type="email" placeholder="Email Address" required=" " >
					<input type="password" placeholder="Password" required=" " >
					<input type="password" placeholder="Password Confirmation" required=" " >
					<div class="register-check-box">
						<div class="check">
							<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>I accept the terms and conditions</label>
						</div>
					</div>
				</form>-->
			</div>
			<div class="register-home">
                            <a href="<?php echo base_url(); ?>"><fa class="fa fa-home"></fa> regresar</a>
			</div>
		</div>
	</div>
<!-- //register -->



 



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