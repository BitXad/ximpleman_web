<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html style="background-color: black;">
<head>
    <title><?php echo $sistema["sistema_nombre"]." ".$sistema["sistema_version"]; ?></title>
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
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
   <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    
    <link rel="shortcut icon" href="<?php echo site_url('resources/images/icono.png');?>" />
</head>  
<body>

    <?php if($diaslic < 0){ ?>
<div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                  
                  <span class="info-box-text"><font size="4"><b>LA LICENCIA ESTA EXPIRADA </b></font></span>
                
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    No podra ingresar al Sistema.  Consulte con el Proveedor
                  </span>
                </div><!-- /.info-box-content -->
              </div>
<?php } else if($diaslic == 5000){ ?>
  <?php }  else { ?>  
    <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                               
                  <span class="info-box-text"><font size="4">LA LICENCIA VENCERA EN: <font size="5"><b><?php echo $diaslic; ?></b></font> DIAS</font></span>
                
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    No podra ingresar al Sistema.
                  </span>
                </div><!-- /.info-box-content -->
              </div>  
<?php } ?>
   
    <div class="login-page" style="background-image: url(<?php echo base_url("resources/images/fondo.jpg"); ?>); background-repeat: no-repeat;background-size: cover; ">
        <div class="login-main">
        <p class="center-block">
            <?php
 
          echo   $this->session->flashdata('msg');
            ?>
        </p>
        <div class="login-head">
          <!--<h2 class="text-center"><?php echo $empresa[0]["empresa_nombre"] ?></h2>-->
          <center>
              <font size="5" face="Arial black"><b><?php echo $empresa[0]["empresa_nombre"] ?></b></font><br>              
                <img src="<?php echo base_url('resources/images/empresas/'.$empresa[0]["empresa_imagen"].''); ?>"  style="width:100px;height:50px">
                <br><font size="4" face="Arial black"><b><?php echo $sistema["sistema_nombre"]." ".$sistema["sistema_version"]; ?></b></font>
          </center>
        </div>
        <div class="login-block">
            <!--                <form>-->
              <?php if($diaslic < 0){ ?>
                <br><div class="info-box bg-red"><br>
            <center><span class="info-box-text"><font size="4"><b>LA LICENCIA ESTA EXPIRADA </b></font></span></center><br>
            <center><span class="progress-description">
                    No podra ingresar al Sistema.  Consulte con el Proveedor
                  </span></center><br></div>
             <?php }else { ?>
              <?php echo form_open('verificar'); ?>
            <input type="text" name="username" id="username" placeholder="Usuario" autocomplete="off" autofocus  required=""  ?>  
            <input type="password" name="password" id="password" class="lock" placeholder="Contraseña"  >
            <input type="submit" name="Sign In" value="Ingresar">
            <?php echo form_close(); ?>
        <?php } ?>
            <!--<div class="forgot-top-grids">
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
            </div>-->

            
            <!--<h3>No estas registrado?<a href="#">  Registrate Ahora</a></h3>-->

            <!--                </form>-->
            <h5><a href="<?php echo base_url(); ?>">Regresar</a></h5>
        </div>
    </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<!--<div class="copyrights">
    <p>All Rights Reserved © <?php $fecha = date('Y'); echo $fecha; ?> Password SRL | Design by  <a href="http://www.passwordbolivia.com/" target="_blank">Password SRL</a> </p>
</div>-->
<!--COPY rights end here-->

<div class="footer" style="background-color: #000">
    
        <div class="container"> <br> </div>
    
        <div class="container">
            <div class="w3_footer_grids">
                <div class="col-md-3 w3_footer_grid">
                    <center>
                        <a href="<?php echo base_url("website/ximpleman"); ?>" target="_BLANK" >
                            <img src="<?php echo base_url("resources/web/images/logo.png"); ?>" width="50%" height="50%">
                        </a>
                    </center>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <center>
                        <a href="faq.html">Política de privacidad</a>
                    
                    </center>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <center>
                        <a href="groceries.html">Un producto de</a>
                    </center>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <center>
                        <a href="<?php echo base_url("website/password"); ?>" target="_BLANK" >
                        <img src="<?php echo base_url("resources/web/images/logo_password.png"); ?>" width="50%" height="50%">
                        </a>
                    </center>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        
        <div class="container"> <br> </div>
    </div>  