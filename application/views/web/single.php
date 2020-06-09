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
<meta name="keywords" content="Ximpleman, ventas online, supermecado, micromercado, 
tiendas, ventas, facturacion, contabilidad, distribucion" />
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
</script>



<link href="<?php echo $raiz;?>css/flag-icon.min.css" rel="stylesheet"> 
<link href="<?php echo $raiz;?>css/bootstrap-select.min.css" rel="stylesheet"> 



<!-- Add jQuery library -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery-1.10.2.min.js'); ?>"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.mousewheel.pack.js?v=3.1.3'); ?>"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox.pack.js?v=2.1.5'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox-buttons.css?v=1.0.5'); ?>" />
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-buttons.js?v=1.0.5'); ?>"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox-thumbs.css?v=1.0.7'); ?>" />
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-thumbs.js?v=1.0.7'); ?>"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-media.js?v=1.0.6'); ?>"></script>
        
        
    
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'Primer Imagen'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
    <style type="text/css">
/*        img{
            height: 50px;
            width: 50px
        }*/
        
		/*.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}*/

                /*
		.box-body {
			max-width: 700px;
			margin: 0 auto;
		}*/
	</style>
         
        
<script src="//norfipc.com/js/jquery.cookie.js"></script>
<script src="//norfipc.com/js/cookiecompliance.js"></script>

<link href="<?php echo $raiz;?>css/flag-icon.min.css" rel="stylesheet"> 
<link href="<?php echo $raiz;?>css/bootstrap-select.min.css" rel="stylesheet"> 
<link rel="shortcut icon" href="<?php echo site_url('resources/images/icono.png');?>" />
<!-- start-smoth-scrolling -->
</head>
	
<body>

    
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
                                                            <li><a href="<?php echo base_url("website/cerrarsesion/").$idioma_id; ?>" >Finalizar Sesion</a></li>
                                                            
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
                <li class="active">Producto</li>
            </ol>
        </div>
    </div>
<!-- //breadcrumbs -->


    <div class="products">
        <div class="container">
            <div class="agileinfo_single">
                
                
                <div class="col-md-4">
                    
                    <div class="col-md-12 agileinfo_single_left">
                        <?php if ($producto[0]['producto_foto']==''){ ?>
                            <img id="example" src="<?php echo base_url('resources/images/productos/producto.jpg')?>" alt=" " class="img-responsive">
                        <?php } else { ?>
                        <img id="example" src="<?php echo base_url('resources/images/productos/'.$producto[0]['producto_foto'].'')?>" alt=" " class="img-responsive">
                    <?php } ?>

                    </div>
                    
                <!-------------------- galeria de productos ----------------------->
                
                <?php if (sizeof($all_imagen_producto)>0){ ?>
                    <div class="clearfix"></div>
<!--                <div class="row">-->
                    <div class="col-md-12  agileinfo_single_left">

                        <div class="box">

                            <div class="box-body">
                                <center>
                                    
                                    
                                <p>
                                    <?php
                                        $colum = 5;
                                        $cont = 1;
                                        //$cont = 1;
                                        /*$anchoimg = "width='70'";
                                        $altoimg = "heigth='60'"; */
                                        foreach($all_imagen_producto as $imagen)
                                        {
                                            if(($cont % $colum) == 0){
                                               // echo "<div id ='otrafila'>";
                                            }
                                            $mimagen = "thumb_".$imagen['imagenprod_archivo'];

                                            //echo "<div id='colum5'>";
                                            echo "<a class='fancybox' href='".site_url('/resources/images/productos/'.$imagen['imagenprod_archivo'])."' data-fancybox-group='gallery' title='".$imagen['imagenprod_titulo']."'>";
                                            echo "<img src='".site_url('/resources/images/productos/'.$mimagen)."' alt='' /></a>";
                                            //echo "</div>";
                                            if(($cont % $colum) == 0){
                                                echo "<br>";
                                            }
                                        ?>
                                        <?php $cont++; } ?>
                                </p>

                                </center>
                            </div>
                            <div class="pull-right">

                            </div>
                            
                        </div>
                    </div>

                <!--</div>-->
                <?php } ?>
                <!-------------------- // galeria de productos ----------------------->
                </div>
                
                <div class="col-md-8 agileinfo_single_right">
                <h2><?php echo $producto[0]['producto_nombre']; ?></h2>
                    
                    <div class="rating1">
                        <span class="starRating">
                            <input id="rating5" type="radio" name="rating" value="5">
                            <label for="rating5">5</label>
                            <input id="rating4" type="radio" name="rating" value="4">
                            <label for="rating4">4</label>
                            <input id="rating3" type="radio" name="rating" value="3" checked="">
                            <label for="rating3">3</label>
                            <input id="rating2" type="radio" name="rating" value="2">
                            <label for="rating2">2</label>
                            <input id="rating1" type="radio" name="rating" value="1">
                            <label for="rating1">1</label>
                        </span>
                    </div>
                
                    
                    
                    <div class="w3agile_description"  style="padding: 0;margin: 0px;">
                        <h4 class="m-sing" ><b>DESCRIPCIÓN</b></h4>                        
                        <p style="padding: 0;margin: 0px; text-align: justify; line-height: 13px;"><?php echo $producto[0]['producto_caracteristicas']; ?></p>
                        <hr style="padding: 0;margin: 0px;">
                        
                        <p style="padding: 0;margin: 0px;"><b>Categoria :</b> <?php echo $producto[0]['categoria_nombre']; ?></p>
                        
                        <p style="padding: 0;margin: 0px;"><b>Marca :</b> <?php echo $producto[0]['producto_marca']; ?></p>
                        
                        <p style="padding: 0;margin: 0px;"><b>Industria :</b> <?php echo $producto[0]['producto_industria']; ?></p>
                    </div>
                
                    <div class="snipcart-item block">
                        <div class="snipcart-thumb agileinfo_single_right_snipcart">
                            <h3 class="m-sing" ><b>Bs <?php echo number_format($producto[0]['producto_precio'],2,'.',','); ?></b> </h3>
                        </div>
                        <div class="snipcart-details agileinfo_single_right_details">
<!--                            <form action="#" method="post">
                                <fieldset>
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="business" value=" ">
                                    <input type="hidden" name="item_name" value="pulao basmati rice">
                                    <input type="hidden" name="amount" value="21.00">
                                    <input type="hidden" name="discount_amount" value="1.00">
                                    <input type="hidden" name="currency_code" value="USD">
                                    <input type="hidden" name="return" value=" ">
                                    <input type="hidden" name="cancel_return" value=" ">
                                    
                                    <input type="submit" name="submit" value="Add to cart" class="button">
                                </fieldset>
                            </form>-->
                            <form action="#" method="post">
                                <fieldset>
                                    <input type="hidden" name="cmd" value="_cart" />
                                    <input type="hidden" name="add" id="cantidad<?php echo $producto[0]['producto_id'];?>" value="1" />
                                    <input type="hidden" name="business" value=" " />
                                    <input type="hidden" name="item_name" value="<?php echo $producto[0]['producto_nombre'];?>" />
                                    <input type="hidden" name="amount" id="producto_precio<?php echo $producto[0]['producto_id'];?>" value="<?php echo $producto[0]['producto_precio'];?>" />
                                    <input type="hidden" name="discount_amount" id="descuento<?php echo $producto[0]['producto_id'];?>" value="<?php echo ($producto[0]['producto_precio']); ?>" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="return" value=" " />
                                    <input type="hidden" name="cancel_return" value=" " />
                                    <!--<input type="button" name="submit" value="Añadir al pedido" class="button" onclick="insertar(<?php echo $producto[0]['producto_id'];?>)"/>-->
<!--                                    <a href="<?php echo base_url("website/micarrito/".$idioma_id); ?>" type="button" name="submit" class="btn btn-info btn-sm" onclick="insertar(<?php echo $producto[0]['producto_id'];?>)">
                                            <fa class='fa fa-cart-plus'></fa> Mi Carrito
                                    </a>-->
                                    <button type="button" name="submit" class="btn btn-info btn-sm" onclick="insertar(<?php echo $producto[0]['producto_id'];?>)"><fa class='fa fa-cart-plus'></fa> AÑADIR AL PEDIDO</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                    

                    
                
                    <div class="checkout-right-basket">
                                    <a href="<?php echo base_url(); ?>"><span class="fa fa-cart-arrow-down" aria-hidden="true"></span> Continuar Comprando</a>
                    </div>
                
                    <div class="clearfix"> </div>

            </div>
        </div>
    </div>


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


            
            
            
<!-- new -->
    <div class="newproducts-w3agile">
        <div class="container">
            <h3>NUESTRAS OFERTAS</h3>
            
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
    </div>
<!-- //new -->




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
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
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
                                <b><fa class="fa fa-user"></fa> Usuario: </b><input type="text" class="form-control" value="" id="cliente_login" name="cliente_login" required="true">
                           </div>
                           <div class="col-md-6">
                               <b><fa class="fa fa-lock"></fa> Contraseña: </b><input type="text" class="form-control" value="" id="cliente_clave" name="cliente_clave" required="true">
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
                                   <button class="btn btn-success" type="button" onclick="sesion()" style="width: 100px;"><fa class="fa fa-inbox"></fa> Ingresar</button>                
                               </center>
                           </div>
                        </div>

                    </div>        
        
        
                    <div style="display:none" id="registrarcli">
                     <div class="col-md-6">
                        NOMBRE:  <input type="text" class="form-control" value="" id="cliente_nombre" name="cliente_nombre" required="true">
                    </div>
                    <div class="col-md-6">
                        C.I.: <input type="text" class="form-control" value="" id="cliente_ci" name="cliente_ci" required="true">        
                    </div>
                    <div class="col-md-6">
                        NIT: <input type="text" class="form-control" value="" id="cliente_nit" name="cliente_nit" required="true">
                    </div>
                    <div class="col-md-6">
                        RAZON SOCIAL: <input type="text" class="form-control" value="" id="cliente_razon" name="cliente_razon" required="true">
                    </div>
                    <div class="col-md-6">
                        TELF: <input type="text" class="form-control" value="" id="cliente_telefono" name="cliente_telefono" required="true">
                    </div>
                    <div class="col-md-6">
                        DIRECCION: <input type="text" class="form-control" value="" id="cliente_direccion" name="cliente_direccion" required="true">
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <br>
                    <button class="btn btn-success" type="button" onclick="registrarcliente()">Registrarse</button>
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