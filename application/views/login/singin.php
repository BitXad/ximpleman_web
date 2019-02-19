<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>Ximpleman :: Sistema Integral de Ventas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <link href="<?php echo base_url('resources/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" media="all">
    <!-- Custom Theme files -->
    <link href="<?php echo base_url('resources/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
    <!--js-->
    <script src="<?php echo base_url('resources/js/jquery-2.1.1.min.js'); ?>"></script>
    <!--icons-css-->
    <link href="<?php echo base_url('resources/css/font-awesome.css'); ?>" rel="stylesheet">
    <!--Google Fonts-->
    <!--<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>-->
    <!--static chart-->
</head>
<body>
<div class="login-page">
    <div class="login-main">
        <p class="center-block">
            <?php
            echo "<div class='error_msg'>";
            if (isset($error_message)) { echo $error_message;}
            echo validation_errors();
            echo "</div>";
            ?>
        </p>
        <div class="login-head">
              <h2 class="text-center">Ximpleman</h2>
        </div>
        <div class="login-block">
            <!--				<form>-->
            <?php echo form_open('verificar'); ?>
            <input type="text" name="username" id="username" placeholder="Usuario"  autofocus  required="">
            <input type="password" name="password" id="password" class="lock" placeholder="Contraseña">
            <div class="forgot-top-grids">
                <div class="forgot-grid">
                    <ul>
                        <li>
                            <input type="checkbox" id="brand1" value="">
                            <label for="brand1"><span></span>Recuerdame</label>
                        </li>
                    </ul>
                </div>
                <div class="forgot">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="clearfix"> </div>
            </div>

            <input type="submit" name="Sign In" value="Ingresar">

            <h3>No estas registrado?<a href="<?php echo base_url()?>register">  Registrate Ahora</a></h3>

            <!--				</form>-->
            <h5><a href="<?php echo base_url(); ?>">Regresar</a></h5>
        </div>
    </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
    <p>© 2018 Password SRL. All Rights Reserved | Design by  <a href="http://www.passwordbolivia.com/" target="_blank">Password SRL</a> </p>
</div>
<!--COPY rights end here-->

<!--scrolling js-->
<script src="<?php echo base_url('resources/js/jquery.nicescroll.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/scripts.js'); ?>"></script>
<!--//scrolling js-->
<script src="<?php echo base_url('resources/js/bootstrap.js'); ?>"> </script>
<!-- mother grid end here-->
</body>
</html>




