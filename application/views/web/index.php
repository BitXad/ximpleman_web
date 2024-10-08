<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    <?php $nombre_sistema =  $sistema['sistema_nombre']." ".$sistema['sistema_version']; ?>
<head>
<title><?php echo $nombre_sistema; ?></title>
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
        $('#map').css({ 'width':'100%', 'height':'400px' });
   
    obj = document.getElementById('oculto'+a);
    //obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
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
<script src="//norfipc.com/js/jquery.cookie.js"></script>
<script src="//norfipc.com/js/cookiecompliance.js"></script>

<link href="<?php echo $raiz;?>css/flag-icon.min.css" rel="stylesheet"> 
<link href="<?php echo $raiz;?>css/bootstrap-select.min.css" rel="stylesheet"> 
<link rel="shortcut icon" href="<?php echo site_url('resources/images/icono.png');?>" />
<input type="hidden" value="4" id="imagenes_fila" />
<!-- start-smoth-scrolling -->
</head>
    
<body onload="buscar_por_categoria(<?php echo $parametro[0]['parametro_mostrarcategoria']; ?>)">
<div id="fb-root"></div>
<script src="<?= $raiz;?>js/facebookLogin.js"></script>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v8.0&appId=711005146491995&autoLogAppEvents=1" nonce="zwap7FDk"></script>
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
                        <li><a href="" data-toggle="modal" data-target="#seguimientoOT">Ordenes</a></li>
                        <li><a href="" data-toggle="modal" data-target="#seguimientoservicio">servicio</a></li>
                        
                        <?php foreach($menu_cabecera as $cabecera) { ?>
                        <li><a href="<?php echo base_url().$cabecera['menu_enlace']; ?>"><?php echo $cabecera['menu_nombre']; ?></a></li>
                        <?php } ?>
<!--                        
                        <li><select class="selectpicker" data-width="fit">
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
                            <button class="w3view-cart" type="button" class="btn btn-primary" onclick="javascript:$.fn.CookieCompliance.disconsent(),cerrarsesion(),FB.logout()"><i class="fa fa-sign-out" aria-hidden="true" title="Cerrar Sesión"></i></button>
                        <?php }  ?>

                    </form>

                </div>

                   
                    
                    
                <div class="clearfix"> </div>
<!------------------ FIN MENU CABECERA  ----------------------------------->                    
            </div>
    </div>
<!------------------ FIN PRIMERA SECCION ----------------------------------->


<!------------------ SEGUNDA SECCION 
    <div class="logo_products">
        <div class="container">
        <div class="w3ls_logo_products_left1">
                <ul class="phone_email">
                    <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo 'PEDIDOS: '.$pagina_web[0]['pagina_telefono']; ?></li>
                    
                </ul>
            </div>
            <div class="w3ls_logo_products_left">
                <h1><a href="<?php echo base_url();?>"><?php echo $pagina_web[0]['empresa_nombre']; ?></a></h1>
            </div>
        </div>
    </div>

 FIN SEGUNDA SECCION -------------------------------------->

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
                                                            <li><a href="<?php echo base_url("website/miperfil/").$idioma_id; ?>" >Mi perfil</a></li>
                                                            <li><a href="<?php echo base_url("website/micarrito/").$idioma_id; ?>" >Mi carrito</a></li>
                                                            <li><a href="<?php echo base_url("website/miscompras/").$idioma_id; ?>" >Mis Compras</a></li>
                                                            <li><a href="<?php echo base_url("/") ?>" onclick="javascript:$.fn.CookieCompliance.disconsent(),cerrarsesion(),FB.logout()" >Finalizar Sesion</a></li>
                                                            
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




    <!-- main-slider -->
                                        
        <ul id="demo1">
                    <?php 
                        
                    foreach($slider as $s){
                    ?>
            <li>
                            <img src="<?php echo $raiz.'images/sliders/'.$s['slide_imagen'];?>" alt="" />
                            <!--Slider Description example-->
                            <div class="slide-desc" style="line-height: 10pt;">
                                <h3 style="padding: 0; margin-bottom: 0;"><?php echo $s['slide_leyenda1']; ?></h3> 
                                <h4 style="color:white; padding: 0; margin-top: 0;"><b><?php echo $s['slide_leyenda2']; ?></b></h4>
                                
                                <!--<h5><badge class="btn btn-warning btn-xs"><b><?php echo $s['slide_leyenda2']; ?></b></badge></h5>-->
                            </div>
            </li>
                    <?php } ?>

        </ul>
    
    <!-- //main-slider -->
    
    
    
    <!-- //top-header and slider -->
    <!-- top-brands -->
<!---------------------- carrusel ------------------------------------>

  
<!--            <div class="container">
                <div class="col-md-12">
                
			<div class="contanier">
                                    <center>
                                
				<h3 class="w3_agile_header">COMPRAR NUNCA FUE TAN FACIL</h3>
				<h3 class="page-header icon-subheading">Glyphicons</h3>
				<div class="bs-glyphicons"> <ul class="bs-glyphicons-list"> 
                                        <li> 
                                            <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> 
                                            <span class="glyphicon-class">glyphicon glyphicon-asterisk</span> 
                                        </li> 
                                        <li> 
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
                                            <span class="glyphicon-class">glyphicon glyphicon-plus</span> 
                                        </li> 
                                        <li> 
                                            <span class="glyphicon glyphicon-euro" aria-hidden="true"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-euro</span> 
                                        </li> 
                                        <li> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 
                                            <span class="glyphicon-class">glyphicon glyphicon-minus</span> 
                                        </li> 
                                        <li> 
                                            <span class="glyphicon glyphicon-eur" aria-hidden="true"></span> 
                                            <span class="glyphicon-class">glyphicon glyphicon-eur</span> 
                                        </li> 
                                        <li> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 
                                            <span class="glyphicon-class">glyphicon glyphicon-minus</span> 
                                        </li> 

                                </div>
                                    </center>
                    </div>
            </div>  
        </div>-->


<!----------------------- fin carrusel----------------------------------->  


<!------------------------- INICIO FRANJA -------------------------------------->
 
 <div class="w3agile-ftr-top"  style="background-color: #333333; color:white;">
		<div class="ftr-toprow" class="container">
                    <center  >
                        <div style="background-color: #000000;" >
                        <h4 style="margin:0;"><b>COMPRAR NUNCA FUE MÁS FACIL</b></h4>
                            
                        </div>
                        
                    </center>
			<div class="ftr-toprow">
				<div class="col-md-4 ftr-top-grids" >
                                    <center>
					<div class="ftr-top-left">
                                                <h1 style="margin-top: 0px;margin-bottom: 0px;">
                                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>                                                    
                                                </h1>
					</div> 
					<div class="ftr-top-right">
                                                <h4 style="margin:0;">PASO 1</h4>
						<p>Añade productos al carrito</p>
					</div> 
					<div class="clearfix"> </div>
                                    </center>
				</div>
                            
				<div class="col-md-4 ftr-top-grids">
                                    <center>
					<div class="ftr-top-left">
                                                <h1 style="margin-top: 0px;margin-bottom: 0px;">
						<i class="fa fa-list-ul" aria-hidden="true"></i>
                                                </h1>
					</div> 
					<div class="ftr-top-right">
						<h4 style="margin:0;">PASO 2</h4>
						<p>Registra tus datos</p>
					</div> 
					<div class="clearfix"> </div>
                                    </center>
				</div>
                            
				<div class="col-md-4 ftr-top-grids">
                                    <center>
					<div class="ftr-top-left">
                                                <h1 style="margin-top: 0px;margin-bottom: 0px;">
						<i class="fa fa-truck" aria-hidden="true"></i>
                                                </h1>
					</div> 
					<div class="ftr-top-right">
                                            <h4 style="margin:0;">PASO 3</h4>
                                            <p>Recibe tu pedido</p>
					</div>
					<div class="clearfix"> </div>
                                    </center>
				</div>
                            
				<div class="clearfix"> </div>
			</div>
		</div>
     <br>
	</div>
 <!--------------------------- FIN FRANJA------------------------------------>    
 
<!------------------------- INICIO BUSCADOR-------------------------------------->
 
 <div class="w3agile-ftr-top"  style="background-color: #333333; color:white;">
		<div class="ftr-toprow" class="container">
                    
			<div class="ftr-toprow">

                                    <center>
                                        
                                <div class="container">


                                        <div class="col-md-4">

                                            <div class="input-group input-group-sm">
                                            <input type="text" onkeypress="buscarpro(event)" name="parabuscar" id="parabuscar" class="form-control" placeholder="Buscar un producto..." required autocomplete="off" >
                                            <span class="input-group-btn">
                                            <button class="btn btn-warning" onclick="buscar_producto()" type="button" id="boton_buscar_prod">
                                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 
                                            </button>
                                            </span>
                                            </div>

                                        </div>


                                        <div class="col-md-4">

                                            <div class="input-group input-group-sm">

                                                <select onchange="buscar_por_categoria(this.value)" name="select_categoria" id="select_categoria" class="form-control" autocomplete="off" >
                                                    <option value="0" selected> TODOS </option>
                                                
                                                    <?php 
                                                        foreach($categorias as $cat){?>    
                                                            <option value="<?php echo $cat['categoria_id']; ?>"><?php echo $cat['categoria_nombre']; ?></option>
                                                    
                                                    <?php } ?>  
                                                </select>
                                                
                                            <span class="input-group-btn">
                                            <button class="btn btn-warning" onclick="buscar_producto()" type="button"><span class="glyphicon glyphicon-list" aria-hidden="true">
                                            </span> </button>
                                            </span>
                                            </div>

                                        </div>


                                        <div class="col-md-4">

                                            <div class="input-group input-group-sm">

                                                <select onchange="buscar_por_subcategoria(this.value)" name="select_subcategoria" id="select_subcategoria" class="form-control" autocomplete="off" >
                                                    <option value="0" selected> TODOS </option>
                                                </select>
                                            <span class="input-group-btn">
                                            <button class="btn btn-warning" onclick="buscar_producto()" type="button"><span class="glyphicon glyphicon-list" aria-hidden="true">
                                            </span> </button>
                                            </span>
                                            </div>

                                        </div>

                                        </div>      
                                        
                                        
                                    </center>
    
			</div>
		</div>
     <br>
    </div>
 <!--------------------------- FIN BUSCADOR------------------------------------>       
        
        
        

    
    <div class="top-brands" style="padding-top: 20px;padding-bottom: 20px;">
        <!------------------------ BUSCADOR --------------------------->         
                <h2 class="w3_agile_vimeo">NUESTROS PRODUCTOS</h2>

            
            <div class="row" id='loader'  style='display:none; text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
                       
        <div class="container">
        
        
        <div class="w3l_search">
            <center>
                
                
            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
            <?php if(!isset($_COOKIE["cliente_id"])) {
                    $cliente_ide = 0;
                } else {
                    $cliente_ide = $_COOKIE["cliente_id"];
                }
            ?>
            <input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente_ide; ?>" />
            <input type="hidden" name="idioma_id" id="idioma_id" value="<?php echo $idioma_id; ?>" />
            <input type="hidden" name="myip" id="myip" value="" />
            <input type="hidden" name="seip" id="seip" value="" />
            <input type="hidden" name="miip" id="miip" value="" />
            <!--<form te="#" method="post">-->
            

            <!--</form>-->
            </center>
        </div>
<!------------------------ BUSCADOR --------------------------->                    
            
            <br><br>
            <div id="tablaresultados"></div>
            
    </div>
        
        
        
        <div class="container">
        <!--<h2><?php echo $seccion1[0]['seccion_titulo']; ?></h2>
        
                <?php if (sizeof($seccion1[0]['seccion_descripcion'])>0) { ?>
                    <h3><?php echo $seccion1[0]['seccion_descripcion']; ?></h3>
                <?php } ?>
        
                    <?php if (sizeof($seccion1[0]['seccion_descripcion'])>0) { ?>
        <h5><?php echo $seccion1[0]['seccion_texto']; ?></h5>
                <?php } ?>-->
                
<!------------------------------------- SEGUNDA SECCION -------------------------------------->
            
            <div class="col-md-12">
                <h2 class="w3_agile_vimeo">NUESTRAS OFERTAS</h2>
                <div class="clearfix"> </div>
            </div>  
            <br>

        


                <div class="grid_3 grid_5">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#expeditions" id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true"><?php echo $seccion2[0]['seccion_titulo']; ?></a></li>
                        <li role="presentation"><a href="#tours" role="tab" id="tours-tab" data-toggle="tab" aria-controls="tours"><?php echo $seccion3[0]['seccion_titulo']; ?></a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content" style="padding: 20px;">
                        <div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
                            <div class="agile-tp">
                                <h5 style="margin: 0px;"><?php echo $seccion1[0]['seccion_descripcion']; ?></h5>
                                <p class="w3l-ad"><?php echo $seccion1[0]['seccion_texto']; ?></p>
                            </div>
                            
                            <div class="agile_top_brands_grids">
                                <?php foreach($ofertasemanal as $os) { ?>
                                                            
                                <div class="col-md-4 top_brand_left">
                                        <div class="hover14 column">
                                            <div class="agile_top_brand_left_grid">
                                                <div class="agile_top_brand_left_grid_pos">
                                                        <img src="<?php echo $raiz;?>images/offer.png" alt=" " class="img-responsive" />
                                                </div>
                                                <div class="agile_top_brand_left_grid1" style="line-height: 10px;">
                                                    <figure>
                                                        <div class="snipcart-item block" >
                                                            <div class="snipcart-thumb">
                                                                <a href="<?php echo base_url("website/single/".$idioma_id."/".$os['producto_id']); ?>">
                                                                    <img title=" " alt=" " src="<?php echo base_url()."resources/images/productos/".$os['producto_foto']; ?>" width="100" height="100"/>
                                                                </a>     
                                                                    <p style="margin-top: 5px;margin-bottom: 5px;"><?php echo $os['producto_nombre'];?></p>
                                                                    <div class="stars" style="margin-bottom: 0px;">
                                                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                                    </div>
                                                                    <h4 style="margin-bottom: 5px; margin-top: 5px;"><?php echo "Bs ".number_format($os['promocion_preciototal'], 2, '.',',');?><span><?php echo number_format($os['producto_precio'], 2, '.', ','); ?></span></h4>
                                                            </div>
                                                            <div class="snipcart-details top_brand_home_details">
                                                                <form action="#" method="post">
                                                                    <fieldset>
                                                                       <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" id="cantidad<?php echo $os['producto_id'];?>" value="1" />
                                                                    <input type="hidden" name="business" value=" " />
                                                                    <input type="hidden" name="item_name" value="<?php echo $os['producto_nombre'];?>" />
                                                                    <input type="hidden" name="amount" id="producto_precio<?php echo $os['producto_id'];?>" value="<?php echo $os['producto_precio'];?>" />
                                                                    <input type="hidden" name="discount_amount" id="descuento<?php echo $os['producto_id'];?>" value="<?php echo ($os['producto_precio']-$os['promocion_preciototal']); ?>" />
                                                                    <input type="hidden" name="currency_code" value="USD" />
                                                                    <input type="hidden" name="return" value=" " />
                                                                    <input type="hidden" name="cancel_return" value=" " />
                                                                    
                                                                    <!--<input type="button" name="submit" value="Añadir al pedido" class="button" onclick="insertar(<?php echo $os['producto_id'];?>)"/>-->
                                                                    <button type="button" name="submit" class="btn btn-info btn-sm" onclick="insertar(<?php echo $os['producto_id'];?>)"><fa class='fa fa-cart-plus'></fa> AÑADIR AL PEDIDO</button>
                                                                     
                                                                    </fieldset>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                                            
                                                            <?php } ?>

                                                                <!-------------- Bloque de codigo 2 ---------------->
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                                            
                        <div role="tabpanel" class="tab-pane fade" id="tours" aria-labelledby="tours-tab">
                            <div class="agile-tp">
                                <h5><?php echo $seccion3[0]['seccion_titulo']; ?></h5>
                                <p class="w3l-ad"><?php echo $seccion3[0]['seccion_texto']; ?></p>
                            </div>
                            <div class="agile_top_brands_grids">
                                                            <?php foreach($ofertasdia as $od) { ?>
                                <div class="col-md-4 top_brand_left">
                                    <div class="hover14 column">
                                        <div class="agile_top_brand_left_grid">
                                            <div class="agile_top_brand_left_grid_pos">
                                                <img src="<?php echo $raiz;?>images/offer.png" alt=" " class="img-responsive" />
                                            </div>
                                            <div class="agile_top_brand_left_grid1">
                                                <figure>
                                                    <div class="snipcart-item block" >
                                                        <div class="snipcart-thumb">
                                                            <a href="<?php echo base_url("website/single/".$idioma_id."/".$od['producto_id']); ?>">
                                                                <img title=" " alt=" " src="<?php echo $raiz."/images/".$od['producto_foto'];?>" />
                                                            </a>
                                                            <p><?php echo $od['producto_nombre'];?></p>
                                                            <div class="stars">
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                            </div>
                                                            <h4><?php echo number_format($os['producto_precio'], 2, '.',',');?><span><?php echo number_format($os['producto_precio']*1.20, 2, '.', ','); ?></span></h4>
                                                        </div>
                                                        <div class="snipcart-details top_brand_home_details">
                                                            <form action="#" method="post">
                                                                <fieldset>
                                                                    <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" id="cantidad<?php echo $od['producto_id'];?>" value="1" />
                                                                    <input type="hidden" name="business" value=" " />
                                                                    <input type="hidden" name="item_name" value="<?php echo $od['producto_nombre'];?>" />
                                                                    <input type="hidden" name="amount" id="producto_precio<?php echo $od['producto_id'];?>" value="<?php echo $od['producto_precio'];?>" />
                                                                    <input type="hidden" name="discount_amount" id="descuento<?php echo $od['producto_id'];?>" value="<?php echo ($os['producto_precio']-$os['promocion_preciototal']); ?>" />
                                                                    <input type="hidden" name="currency_code" value="USD" />
                                                                    <input type="hidden" name="return" value=" " />
                                                                    <input type="hidden" name="cancel_return" value=" " />
                                                                    <input type="button" name="submit" value="Añadir al pedido" class="button" onclick="insertar(<?php echo $od['producto_id'];?>)"/>
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                                <?php } ?>
<!----------------------------- bloque de codigo 3 --------------------->
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- //top-brands -->
 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            $i = 0;
            $band = true;
            foreach($slider2 as $s2){
                if($band == true){ ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
            <?php $band = false;
                }else{ ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>"></li>
            <?php }
            $i++;
            } ?>
        </ol>
          <center>
        <div class="carousel-inner" role="listbox">
            <?php
            $i = 0;
            $band1 = true;
            foreach($slider2 as $s2){
                if($band1 == true){ ?>
                    <div class="item active">
                        <a href="#"> <img class="<?php echo $s2['slide_titulo'].$i; ?>" src="<?php echo $raiz."images/sliders/".$s2['slide_imagen']; ?>" alt="<?php echo $s2['slide_titulo'];?>"></a>
                    </div>
            <?php $band1 = false;
                }else{ ?>
                    <div class="item">
                        <a href="#"> <img class="<?php echo $s2['slide_titulo'].$i; ?>" src="<?php echo $raiz."images/sliders/".$s2['slide_imagen']; ?>" alt="<?php echo $s2['slide_titulo'];?>"></a>
                    </div>
            <?php }
            $i++;
            } ?>
      </div>
          </center>
    
    </div>
 <!-- /.carousel -->   
    
<!--banner-bottom--><!--
                <div class="ban-bottom-w3l">
                    <div class="container">
                    <div class="col-md-6 ban-bottom3">
                            <div class="ban-top">
                                <img src="<?php echo $raiz;?>images/p2.jpg" class="img-responsive" alt=""/>
                                
                            </div>
                            <div class="ban-img">
                                <div class=" ban-bottom1">
                                    <div class="ban-top">
                                        <img src="<?php echo $raiz;?>images/p3.jpg" class="img-responsive" alt=""/>
                                        
                                    </div>
                                </div>
                                <div class="ban-bottom2">
                                    <div class="ban-top">
                                        <img src="<?php echo $raiz;?>images/p4.jpg" class="img-responsive" alt=""/>
                                        
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6 ban-bottom">
                            <div class="ban-top">
                                <img src="<?php echo $raiz;?>images/111.jpg" class="img-responsive" alt=""/>
                                
                                
                            </div>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>
                </div>-->
<!--banner-bottom-->
<!--brands-->
<!--    <div class="brands">
        <div class="container">
        <h3>CATEGORIA PRODUCTOS</h3>
            <div class="brands-agile">-->
                
<!--                <?php foreach ($categorias as $cat) { 
                    
                    if (strlen($cat["categoria_nombre"])<13){ ?>
                
                        <div class="col-md-3 w3layouts-brand">
                          <div class="brands-w3l">
                              <p><a onclick="buscar_por_categoria(<?php echo $cat["categoria_id"]; ?>)" >
                                  <small>
                                        <fa class="fa fa-cart-arrow-down" ></fa>
                                         <?php echo $cat["categoria_nombre"]; ?>                                      
                                  </small>
                                  </a></p><br>
                          </div>
                      </div>
                
                <?php } else { ?>
                
                    <div class="col-md-3 w3layouts-brand">
                       <div class="brands-w3l">
                           <p><a onclick="buscar_por_categoria(<?php echo $cat["categoria_id"]; ?>)" >
                                  <small>
                               <?php echo $cat["categoria_nombre"]; ?>
                                  </small>
                               </a></p><br>
                       </div>
                   </div>
                
                <?php } } ?>
                -->
                
                
<!--                
            </div>
             <div class="row" id='loader1'  style='display:none; text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
            <center><a><h2 id="la_categoria"></h2></a></center>
                <div class="clearfix"></div>
            <div id="tablacategorias"></div>
        </div>
    </div>  -->



<!--//brands-->


	<!-- about-team -->
	<div class="about-team" style="background-color: #fe9126;"> 
            <div class="container">
                <h3 class="w3_agile_header">COMUNICATE CON NOSOTROS</h3>
                <div class="team-agileitsinfo">
                    <?php
                     foreach ($all_redsocial as $redsocial) {
                    ?>
                    <div class="col-md-3 about-team-grids" style="background-color: #fe9126">
                        <img src="<?php echo base_url("resources/web/images/redsocial/".$redsocial["redsocial_imagen"]) ?>" alt="" class="img img-circle"/>
                        <div class="team-w3lstext"></div>
                        <div class="social-icons caption" style="font-size: 30px;"> 
                            <ul>
                                <li><a href="<?php echo $redsocial["redsocial_direccion"]; ?>" class="fa <?php echo $redsocial["redsocial_icono"]; ?>"> </a> <?php echo $redsocial["redsocial_nombre"]; ?></li>
                            </ul>
                            <div class="clearfix"> </div>  
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="clearfix"> </div>
                </div>
            </div>
	</div>
	<!-- //about-team -->


<!-- contact -->
    <div class="about">
        <div class="w3_agileits_contact_grids">
            <div class="col-md-6 w3_agileits_contact_grid_left">
                <div class="agile_map">
                    <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.3905851087434!2d-34.90500565012194!3d-8.061582082752993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18d90992e4ab%3A0x8e83c4afabe39a3a!2sSport+Club+Do+Recife!5e0!3m2!1sen!2sin!4v1478684415917" style="border:0"></iframe>-->
                        <?php 
                            $latitud = $pagina_web[0]['empresa_latitud'];
                            $longitud = $pagina_web[0]['empresa_longitud'];
                        ?>
                    
                    <div id="mimapa">
                        
                            <input type="hidden" value="<?php echo $latitud; ?>" id="empresa_latitud"/>
                            <input type="hidden" value="<?php echo $longitud; ?>" id="empresa_longitud"/>
                            
                        <div id="map" style="width:100%; height:550px; "></div>
                        <script type="text/javascript">
                            var marker;          //variable del marcador
                            var coords_lat = {};    //coordenadas obtenidas con la geolocalización
                            var coords_lng = {};    //coordenadas obtenidas con la geolocalización


                            //Funcion principal
                            initMap = function () 
                            {
                                //usamos la API para geolocalizar el usuario

                                //milat = document.getElementById('cliente_latitud').value;
                                milat = $('#empresa_latitud').val();
                                //milng = document.getElementById('cliente_longitud').value;
                                milng = $('#empresa_longitud').val();

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
                                    zoom: 19,
                                    center:new google.maps.LatLng(coords_lat.lat,coords_lng.lng),

                                  });

                                  //Creamos el marcador en el mapa con sus propiedades
                                  //para nuestro obetivo tenemos que poner el atributo draggable en true
                                  //position pondremos las mismas coordenas que obtuvimos en la geolocalización
                                  marker = new google.maps.Marker({
                                    map: map,
                                    draggable: false,
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
                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $parametro[0]['parametro_apikey'];?>&callback=initMap"></script>
                        </div>                    

                
                </div>
                        
                <div class="agileits_w3layouts_map_pos">
                    <div class="agileits_w3layouts_map_pos1" style="padding: 5px;">
                        <h3 style="margin-top: 10px;">Contactos</h3>
                        
                        <p><?php echo $pagina_web[0]['empresa_direccion']; ?>, <?php echo $pagina_web[0]['empresa_departamento']; ?>.</p>
                        
                        <ul class="wthree_contact_info_address">
                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo $pagina_web[0]['empresa_email']; ?>"><?php echo $pagina_web[0]['empresa_email']; ?></a></li>
                            <li><i class="fa fa-phone" aria-hidden="true" style="padding-right: 0px;"></i> <?php echo $pagina_web[0]['empresa_telefono']; ?></li>
                        </ul>
                        <div class="w3_agile_social_icons w3_agile_social_icons_contact">
                            <ul>
                                <li><a href="#" class="icon icon-cube agile_facebook"></a></li>
                                <li><a href="#" class="icon icon-cube agile_rss"></a></li>
                                <li><a href="#" class="icon icon-cube agile_t"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 w3_agileits_contact_grid_right">
                <h2 class="w3_agile_header">Dejanos<span> un Mensaje</span></h2>

                <?php echo form_open('website/email'); ?>
                    <span class="input input--ichiro">
                        <input class="input__field input__field--ichiro" type="text" id="input-25" name="nomemail" placeholder=" " required="" />
                        <label class="input__label input__label--ichiro" for="input-25">
                            <span class="input__label-content input__label-content--ichiro">Tu Nombre</span>
                        </label>
                    </span>
                    <span class="input input--ichiro">
                        <input class="input__field input__field--ichiro" type="email" id="input-26" name="froemail" placeholder=" " required="" />

                        <label class="input__label input__label--ichiro" for="input-26">
                            <span class="input__label-content input__label-content--ichiro">Tu Email</span>
                        </label>
                    </span>
                    <input class="form-control" type="hidden" id="empresa_email" name="empresa_email" value="<?php echo $pagina_web[0]['empresa_email']; ?>" />
                    <textarea placeholder="Escribe Tu Mensaje..." required="" id="mensaje12" name="mensaje12"></textarea>
                    <input type="submit" value="Enviar">
                <?php echo form_close(); ?>
            </div>
            
            <div class="clearfix"> </div>
        </div>
    </div>
<!-- contact -->


<!-- Modal: modalCart -->
<div class="modal fade" id="modalCart" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header" style="padding:3px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cart-arrow-down"></i> Mi Carrito</h4>
      </div>
      <!--Body-->
      <div class="modal-body" style="overflow-x: auto;">
        
        <div class="col-md-12"></div>
        <table class="table table-hover" style="font-size: 12px;">
          <thead>
            <tr style="color: white; background: #333333; padding: 0;">
              <!--<th>#</th>-->
              <th style="padding:0;"></th>
              <th style="padding:0; text-align: center;">Producto</th>
              <th style="padding:0; text-align: center;">Precio</th>
              <th style="padding:0; text-align: center;">Cant.</th>
              <!--<th style="padding:0;">Desc.</th>-->
              <th style="padding:0; text-align: center;">Total Bs.</th>

            </tr>
          </thead>
          <tbody id="carritos">
          </tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
          
          <center>
            <button class="btn btn-primary" data-dismiss="modal" style="width: 140px;"><i class="fa fa-cart-arrow-down"></i> Continuar</button>
            <button class="btn btn-success" data-dismiss="modal" onclick="realizarcompra()"  style="width: 140px;"><i class="fa fa-money"></i> Finalizar Compra</button>              
          </center>
          
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalCart -->

<!-- Modal: finalizar -->
<div class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cart-arrow-down"></i> Finalizar Compra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="col-md-12"></div>
        <table class="table table-hover">
         <div class="col-md-6">
            <b>Método de pago:</b>             
            <select class="form-control" name="metodo_pago" id="metodo_pago" required>
                <option value="1">Pago en Entrega</option>
                <option value="3">Transferencia</option>
            </select>
        </div>
        <div class="col-md-6">
            <b>Forma de envio:</b>             
            <select class="form-control" name="metodo_envio" id="metodo_envio" required>
                <option value="1">A Domicilio</option>
                <option value="2">Sucursal</option>
            </select>
        </div>
        <div class="col-md-6">
            <b>NIT:</b> <input type="text" class="form-control" value="" id="venta_nit" name="venta_nit" required="true">
        </div>
        <div class="col-md-6">
            <b>Razón Social:</b> <input type="text" class="form-control" value="" id="venta_razon" name="venta_razon" required="true">
        </div>
        <div class="col-md-6">
            <b>Celular:</b> <input type="text" class="form-control" value="" id="venta_celular" name="venta_celular" required="true">
        </div>
        <div class="col-md-6">
            <b>Teléfono:</b> <input type="text" class="form-control" value="" id="venta_telefono" name="venta_telefono" required="true">
        </div>
        <div class="col-md-6">
            <b>Dirección:</b> <input type="text" class="form-control" value="" id="venta_direccion" name="venta_direccion" required="true"> <input type="hidden" class="form-control" value="" id="venta_subtotal" name="venta_subtotal" required="true">
            <input type="hidden" class="form-control" value="" id="venta_descuento" name="venta_descuento" required="true">
            <input type="hidden" class="form-control" value="" id="venta_total" name="venta_total" required="true">
        </div>
        
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <div></div>
        <button class="btn btn-primary" type="button" onclick="venta_online()"><i class="fa fa-money"></i> Finalizar Compra</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal: finalizar -->

<!-- Modal: registro -->
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header" style="background-color: #000000;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <!--<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Cliente</h4>-->
          <img src="<?php echo base_url("resources/web/images/logo.png") ?>" width="30%" height="30%">
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="col-md-12"></div>
        <table class="table table-hover">
            <tr>
                <td>    
                    <div class="col-md-12" style="padding:0; border-bottom: silver;" >
                        <div class="btn-group" role="group" aria-label="login">
                            <button class="btn btn-primary"  style="width: 120px;" onclick="inisesion()" id="boton_sesion"><fa class="fa fa-key"></fa> Iniciar Sesion</button>
                            <button class="btn btn-default" style="width: 120px;" onclick="registrarcli()" id="boton_registro"><fa class="fa fa-user-plus"></fa> Registrate</button>
                            <!-- Boton "continuar con facebook" -->
                            <div onlogin="checkLoginState()" class="fb-login-button" data-size="medium" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div>
                            <!-- Boton "continuar con facebook" -->
                        </div>
                    </div>
                </td>    
            </tr>
            <tr>
                <td>    
            
        <!--         <div class="col-md-2">

                 </div>   -->
        <!--         <div class="col-md-5"  style="padding:0;">
                    <button class="btn btn-primary" style="width: 100%" onclick="inisesion()" type="button" >Iniciar Sesion</button>
                 </div>  -->

                    <div style="display:block;" id="inisesion" >
                            <br>

                        <div>

                            <div class="col-md-6">
                                <b><fa class="fa fa-user"></fa> Usuario: </b><input type="text" class="form-control" value="" id="cliente_login" name="cliente_login" required="true" onkeyup="saltar_input(event,1)">
                           </div>
                           <div class="col-md-6">
                               <b><fa class="fa fa-lock"></fa> Contraseña: </b><input type="password" class="form-control" value="" id="cliente_clave" name="cliente_clave" required="true" onkeyup="saltar_input(event,2)">
                               <a href="<?php echo base_url("website/recuperarclave/".$idioma_id); ?>" >¿Olvidaste tu contraseña?</a>
                           </div>

                           <div class="col-md-12" style="text-align: justify; line-height: 12px; font-family: Arial;">
                               <p >
                                   <small>
                                    Al identificarte aceptas nuestras Condiciones de uso y venta. Consulta nuestro Aviso de privacidad y nuestras Aviso de Cookies y Aviso sobre publicidad basada en los intereses del usuario.                                       
                                   </small>
                               </p>
                                   
                               <center>
                                   <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 100px;"><fa class="fa fa-times"></fa> Cerrar</button>                
                                   <button class="btn btn-success" type="button" onclick="sesion()" style="width: 100px;" id="boton_login"><fa class="fa fa-inbox"></fa> Ingresar</button>                
                               </center>
                           </div>
                        </div>

                    </div>        
        
        
                    <div style="display:none" id="registrarcli">
                        
                     <div class="col-md-6">
                         <b><fa class="fa fa-list-ul"></fa> Nombre (*): <small style="color:red;"><span id="mensaje_lognombre"> </span></small></b><input type="text" class="form-control" value="" id="cliente_nombre" name="cliente_nombre" required="true" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end); enfocar(event,1)">
                    </div>
                        
                        
                     <div class="col-md-6">
                         <b><fa class="fa fa-mobile-phone"></fa> Celular (*): <small style="color:red;"><span id="mensaje_logcelular"> </span></small></b><input type="number" class="form-control" value="" id="cliente_celular" name="cliente_celular" required="true" onkeyup="enfocar(event,2)">
                    </div>
                        
                    <div class="col-md-6">
                        <b><fa class="fa fa-map-marker"></fa> Dirección (*): <small style="color:red;"><span id="mensaje_logdireccion"> </span></small></b><input type="text" class="form-control" value="" id="cliente_direccion" name="cliente_direccion" required="true" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end); enfocar(event,3)">
                    </div>                       
                        
                        
                    <div class="col-md-6">
                        <b><fa class="fa fa-user"></fa> Usuario/Email (*): <small style="color:red;"><span id="mensaje_logemail"> </span></small></b><input type="text" class="form-control" value="" id="cliente_email" name="cliente_email" required="true" onkeyup="enfocar(event,4);">
                    </div>                       
                        
                    <div class="col-md-6">
                        <b><fa class="fa fa-key"></fa> Contraseña (*): <small style="color:red;"><span id="mensaje_logclave"> </span></small></b><input type="password" class="form-control" value="" id="cliente_clavereg" name="cliente_clavereg" required="true" onkeyup="enfocar(event,5);" autocomplete="off">
                    </div>
                        
                        
                    <div class="col-md-6">
                        <b><fa class="fa fa-key"></fa> Repetir contraseña (*): <small style="color:red;"><span id="mensaje_logrepetir"> </span></small></b><input type="password" class="form-control" value="" id="cliente_repeticion" name="cliente_repeticion" required="true" onkeyup="enfocar(event,6);" autocomplete="off">
                        
                    </div>
                        
                    <div class="col-md-12" style="color:red;">
                        
                        <small><span id="mensaje_log"> </span></small>
                    
                    </div>
                        
                        
                    <div class="col-md-6" hidden="true">
                        C.I.: <input type="text" class="form-control" value="0" id="cliente_ci" name="cliente_ci" required="true">        
                    </div>
                        
                    <div class="col-md-6" hidden="true">
                        NIT: <input type="text" class="form-control" value="0" id="cliente_nit" name="cliente_nit" required="true">
                    </div>
                        
                    <div class="col-md-6" hidden="true">
                        RAZON SOCIAL: <input type="text" class="form-control" value="SIN NOMBRE" id="cliente_razon" name="cliente_razon" required="true">
                    </div>
                        
                    <div class="col-md-6" hidden="true">
                        TELF: <input type="text" class="form-control" value="0" id="cliente_telefono" name="cliente_telefono" required="true">
                    </div>
                        
                    <div class="col-md-6">
                    </div>
                    
                    <div class="col-md-12">
                        <center>
                            <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 120px;"><fa class="fa fa-times"></fa> Cerrar</button>   
                            <button class="btn btn-success" type="button" onclick="registrarcliente()"  style="width: 120px;" id="boton_registrar_datos"><fa class="fa fa-floppy-o"></fa> Registrarse</button>                            
                        </center>                            
                    </div>
                        
                    </div>
        
        
                    
        
        
                </td>
            </tr>
        
        </table>
        
      </div>
     
    </div>
  </div>
</div>
<!-- Modal: registro -->






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
<?php $raiz = base_url('resources/web/'); ?>
<script src="<?php echo $raiz.'js/skdslider.min.js'; ?>"> </script>
<link href="<?php echo $raiz.'css/skdslider.css'; ?>" rel="stylesheet">
<script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
                        
            jQuery('#responsive').change(function(){
              $('#responsive_wrapper').width(jQuery(this).val());
            });
            
        });
</script> 
<!-- //main slider-banner --> 

<!-- facebook login -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<!-- facebook login -->
    </body>
</html>