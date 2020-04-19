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
<meta name="keywords" content="Super Market Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
    <!-- header -->
<!------------------ PRIMERA SECCION -------------------------------------->
    <div class="agileits_header">
            <div class="container">
                <div class="w3l_offers">                        
                        <p><?php echo $pagina_web[0]['pagina_informacion']; ?><a href="products.html"> Compre Ahora</a></p>
                </div>
<!------------------ MENU CABECERA  ----------------------------------->                    
                <div class="agile-login">
                    <ul>
                        <li><a href="" data-toggle="modal" data-target="#seguimientoservicio">servicio</a></li>
                        <?php foreach($menu_cabecera as $cabecera) { ?>
                        <li><a href="<?php echo base_url().$cabecera['menu_enlace']; ?>"><?php echo $cabecera['menu_nombre']; ?></a></li>
                        <?php } ?>

                    </ul>
                </div>
                    <!-- --------------- INICIO Modal para ver el avance de servicios --------------- -->
                    <div class="modal fade" id="seguimientoservicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                            <br><br>
                            <div class="modal-content text-left">
                          <div class="modal-header">
                              <label>Ingresar Codigo de Servicio</label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                          </div>
                            <?php
                            echo form_open('seguimiento/index');
                            ?>
                          <div class="modal-body">
                           <!-- --------------------------------------------------------------- -->
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="codigo" id="codigo" class="form-control" required placeholder="Codigo del Servicio" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-binoculars"></i> Seguimiento
                                </button>
                            </div>
                           <!------------------------------------------------------------------->
                          </div>
                          <div class="modal-footer"></div>
                            <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>
                    <!-- --------------- F I N Modal para ver el avance de servicios --------------- -->
                <div class="product_list_header">  
                    <form action="#" method="post" class="last"> 
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="display" value="1">
                        <button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
                        
                    </form>                                       
                </div>

                    <select class="selectpicker" data-width="fit">
                    <option data-content='<span class="flag-icon flag-icon-us"></span> English'><span class="flag-icon flag-icon-us"></span>English</option>
                    <option  data-content='<span class="flag-icon flag-icon-mx"></span> Español'>Español</option>
                    </select>
                    
                    
                <div class="clearfix"> </div>
<!------------------ FIN MENU CABECERA  ----------------------------------->                    
            </div>
    </div>
<!------------------ FIN PRIMERA SECCION ----------------------------------->


<!------------------ SEGUNDA SECCION -------------------------------------->
    <div class="logo_products" style="padding: 0;">
        <div class="container">
        <div class="w3ls_logo_products_left1" style="padding: 0;">
                <ul class="phone_email">
                    <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo 'PEDIDOS: '.$pagina_web[0]['pagina_telefono']; ?></li>
                    
                </ul>
            </div>
            <div class="w3ls_logo_products_left" style="padding: 0;">
                <h1 style="margin: 0;"><a href="<?php echo base_url();?>"><?php echo $pagina_web[0]['empresa_nombre']; ?></a></h1>
            </div>
            
            <div class="clearfix"> </div>
        </div>
    </div>
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
                <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Inicio</a></li>
                <li class="active">Error 404</li>
            </ol>
        </div>
    </div>
<!-- //breadcrumbs -->
<div class="products" style="padding: 0;">
        <div class="container">
            <div class="agileinfo_single">
                <center style="line-height: 10px;">
                    <h1 style="font-size: 100px;"><fa class="fa fa-frown-o"></fa></h1>
                    
                    <font face="Arial black" size="20">
                        <b>
                            ERROR 404
                        </b>                        
                    </font>
                    
                    <h2>
                        <b>
                            NO ENCONTRAMOS LO QUE BUSCAS
                        
                        </b>
                    </h2>
                    
                </center>
                <center>
                    <h5>
                         No hemos podido encontrar el sitio que buscas,
                        <br>es posible que el la entrada haya sido eliminada, o que la URL no exista.
                    </h5>
                    <a href="<?php echo base_url('admin/dashb'); ?>" class="btn btn-info"> <fa class="fa fa-home"></fa> Regresar</a>
                </center>
                <br>
            </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    <!--</div>-->
<!-- new -->
<!--    <div class="newproducts-w3agile">
        <div class="container">
            <h3>New offers</h3>
                <div class="agile_top_brands_grids">
                    <div class="col-md-3 top_brand_left-1">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid_pos">
                                    <img src="images/offer.png" alt=" " class="img-responsive">
                                </div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <a href="products.html"><img title=" " alt=" " src="images/14.png"></a>     
                                                <p>Fried-gram</p>
                                                <div class="stars">
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                </div>
                                                    <h4>$35.99 <span>$55.00</span></h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                                <form action="#" method="post">
                                                    <fieldset>
                                                        <input type="hidden" name="cmd" value="_cart">
                                                        <input type="hidden" name="add" value="1">
                                                        <input type="hidden" name="business" value=" ">
                                                        <input type="hidden" name="item_name" value="Fortune Sunflower Oil">
                                                        <input type="hidden" name="amount" value="35.99">
                                                        <input type="hidden" name="discount_amount" value="1.00">
                                                        <input type="hidden" name="currency_code" value="USD">
                                                        <input type="hidden" name="return" value=" ">
                                                        <input type="hidden" name="cancel_return" value=" ">
                                                        <input type="submit" name="submit" value="Add to cart" class="button">
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 top_brand_left-1">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid_pos">
                                    <img src="images/offer.png" alt=" " class="img-responsive">
                                </div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <a href="products.html"><img title=" " alt=" " src="images/15.png"></a>     
                                                <p>Navaratan-dal</p>
                                                <div class="stars">
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                </div>
                                                    <h4>$30.99 <span>$45.00</span></h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                                <form action="#" method="post">
                                                    <fieldset>
                                                        <input type="hidden" name="cmd" value="_cart">
                                                            <input type="hidden" name="add" value="1">
                                                            <input type="hidden" name="business" value=" ">
                                                            <input type="hidden" name="item_name" value="basmati rise">
                                                            <input type="hidden" name="amount" value="30.99">
                                                            <input type="hidden" name="discount_amount" value="1.00">
                                                            <input type="hidden" name="currency_code" value="USD">
                                                            <input type="hidden" name="return" value=" ">
                                                            <input type="hidden" name="cancel_return" value=" ">
                                                            <input type="submit" name="submit" value="Add to cart" class="button">
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 top_brand_left-1">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid_pos">
                                    <img src="images/offer.png" alt=" " class="img-responsive">
                                </div>
                                <div class="agile_top_brand_left_grid_pos">
                                    <img src="images/offer.png" alt=" " class="img-responsive">
                                </div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <a href="products.html"><img src="images/16.png" alt=" " class="img-responsive"></a>
                                                <p>White-peasmatar</p>
                                                <div class="stars">
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                </div>
                                                    <h4>$80.99 <span>$105.00</span></h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                                <form action="#" method="post">
                                                    <fieldset>
                                                        <input type="hidden" name="cmd" value="_cart">
                                                        <input type="hidden" name="add" value="1">
                                                        <input type="hidden" name="business" value=" ">
                                                        <input type="hidden" name="item_name" value="Pepsi soft drink">
                                                        <input type="hidden" name="amount" value="80.00">
                                                        <input type="hidden" name="discount_amount" value="1.00">
                                                        <input type="hidden" name="currency_code" value="USD">
                                                        <input type="hidden" name="return" value=" ">
                                                        <input type="hidden" name="cancel_return" value=" ">
                                                        <input type="submit" name="submit" value="Add to cart" class="button">
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 top_brand_left-1">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid_pos">
                                    <img src="images/offer.png" alt=" " class="img-responsive">
                                </div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <a href="products.html"><img title=" " alt=" " src="images/17.png"></a>     
                                                <p>Channa-dal</p>
                                                <div class="stars">
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                </div>
                                                    <h4>$35.99 <span>$55.00</span></h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                                <form action="#" method="post">
                                                    <fieldset>
                                                        <input type="hidden" name="cmd" value="_cart">
                                                        <input type="hidden" name="add" value="1">
                                                        <input type="hidden" name="business" value=" ">
                                                        <input type="hidden" name="item_name" value="Fortune Sunflower Oil">
                                                        <input type="hidden" name="amount" value="35.99">
                                                        <input type="hidden" name="discount_amount" value="1.00">
                                                        <input type="hidden" name="currency_code" value="USD">
                                                        <input type="hidden" name="return" value=" ">
                                                        <input type="hidden" name="cancel_return" value=" ">
                                                        <input type="submit" name="submit" value="Add to cart" class="button">
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="clearfix"> </div>
                </div>
        </div>
    </div>-->
<!-- //new -->
<!-- //footer -->
<div class="footer">
        <div class="container">
            <div class="w3_footer_grids">
                <div class="col-md-3 w3_footer_grid">
                    <h3>Contact</h3>
                    
                    <ul class="address">
                        <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>1234k Avenue, 4th block, <span>New York City.</span></li>
                        <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
                        <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 567</li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Information</h3>
                    <ul class="info"> 
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">About Us</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="contact.html">Contact Us</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="short-codes.html">Short Codes</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="faq.html">FAQ's</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products.html">Special Products</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Category</h3>
                    <ul class="info"> 
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="groceries.html">Groceries</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="household.html">Household</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="personalcare.html">Personal Care</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="packagedfoods.html">Packaged Foods</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="beverages.html">Beverages</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Profile</h3>
                    <ul class="info"> 
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products.html">Store</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="checkout.html">My Cart</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="login.html">Login</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="registered.html">Create Account</a></li>
                    </ul>
                    
                    
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        
        <div class="footer-copy">
            
            <div class="container">
                    <p>© <?php echo date('Y'); ?> Ximpleman, All rights reserved | <a href="http://www.passwordbolivia.com/">Password Ingeniería Hardware & Software </a></p>
            </div>
        </div>
        
    </div>  
    <div class="footer-botm">
            <div class="container">
                <div class="w3layouts-foot">
                    <ul>
                        <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="payment-w3ls">  
                    <img src="<?php echo base_url('resources/web/images/card.png') ?>" alt=" " class="img-responsive">
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
<!-- //footer -->   
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
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
<script src="js/minicart.min.js"></script>
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
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
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