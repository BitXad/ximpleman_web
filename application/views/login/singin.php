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

    <style>
        .login-block form,
        .login-form {
            width: 100%;
            margin-top: 18px;
        }

        .login-form .form-group {
            margin-bottom: 16px;
        }

        .login-form label {
            display: block;
            color: #333;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .login-form label i {
            width: 16px;
            margin-right: 4px;
            color: #337ab7;
        }

        .login-input {
            width: 100%;
            height: 48px !important;
            border: 1px solid #cfcfcf !important;
            border-radius: 6px !important;
            background: #fff !important;
            color: #333 !important;
            font-size: 16px !important;
            padding: 10px 14px !important;
            box-shadow: none !important;
            outline: none !important;
            margin: 0 !important;
        }

        .login-input:focus {
            border-color: #337ab7 !important;
            box-shadow: 0 0 8px rgba(51, 122, 183, 0.25) !important;
        }

        .login-form .input-group {
            width: 100%;
        }

        .login-form .input-group .login-input {
            border-radius: 6px 0 0 6px !important;
        }

        .btn-password {
            height: 48px;
            width: 54px;
            border-radius: 0 6px 6px 0 !important;
            border: 1px solid #cfcfcf;
            border-left: 0;
            background: #f7f7f7;
            color: #333;
            font-size: 16px;
            box-shadow: none;
            outline: none !important;
        }

        .btn-password:hover,
        .btn-password:focus {
            background: #ececec;
            color: #000;
        }

        .btn-login {
            width: 100%;
            height: 50px;
            border-radius: 6px;
            border: 0;
            background: #337ab7;
            color: #fff;
            font-size: 17px;
            font-weight: bold;
            margin-top: 8px;
            transition: all .25s;
        }

        .btn-login:hover,
        .btn-login:focus {
            background: #286090;
            color: #fff;
        }

        .btn-login i {
            margin-right: 6px;
        }
    </style>
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
<?php } else if($diaslic >10){ ?>
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
            <center style="line-height: 12px;"><br>
              <font size="5" face="Arial"><b><?php echo $empresa[0]["empresa_nombre"]; ?> </b></font><br>
                <?php // echo ($empresa[0]["empresa_nombre"]!='')? "<small>".$empresa[0]["empresa_propietario"]."</small><br>":""; ?>
              
              <font size="2" face="Arial">                  
                <?php echo ($empresa[0]["empresa_nombre"]!='')? "<small>".$empresa[0]["empresa_nombresucursal"]."</small><br>":""; ?>
              </font>
          </center>
          <center>
                <img src="<?php echo base_url('resources/images/empresas/'.$empresa[0]["empresa_imagen"].''); ?>"  style="width:100px;height:50px">
                <br><font size="4" face="Arial"><b><?php echo $sistema["sistema_nombre"]." ".$sistema["sistema_version"]; ?></b></font>
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
              <?php echo form_open('verificar', array('id' => 'formlogin')); ?>
                        <div class="login-form">
                            <div class="form-group">
                                <label for="username"><i class="fa fa-user"></i> Usuario</label>
                                <input type="text"
                                       name="username"
                                       id="username"
                                       class="form-control login-input"
                                       placeholder="Ingrese su usuario"
                                       autocomplete="off"
                                       autofocus
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="fa fa-lock"></i> Contraseña</label>
                                <div class="input-group">
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control login-input"
                                           placeholder="Ingrese su contraseña"
                                           required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-password"
                                                type="button"
                                                id="btnMostrarPassword"
                                                title="Mostrar contraseña">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <!-- nuevos campos -->
                            <input type="hidden" name="latitud" id="latitud" value="">
                            <input type="hidden" name="longitud" id="longitud" value="">
                            <input type="hidden" name="dispositivo" id="dispositivo" value="">
                            <input type="hidden" name="user_agent" id="user_agent" value="">

                            <button type="submit" name="Sign In" class="btn btn-primary btn-login">
                                <i class="fa fa-sign-in"></i> Ingresar
                            </button>
                        </div>
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


<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("formlogin");
    var password = document.getElementById("password");
    var botonPassword = document.getElementById("btnMostrarPassword");
    var latitud = document.getElementById("latitud");
    var longitud = document.getElementById("longitud");
    var dispositivo = document.getElementById("dispositivo");
    var userAgent = document.getElementById("user_agent");

    if (!form) {
        return;
    }

    if (botonPassword && password) {
        botonPassword.addEventListener("click", function () {
            var icono = botonPassword.querySelector("i");

            if (password.type === "password") {
                password.type = "text";
                botonPassword.title = "Ocultar contraseña";
                if (icono) {
                    icono.className = "fa fa-eye-slash";
                }
            } else {
                password.type = "password";
                botonPassword.title = "Mostrar contraseña";
                if (icono) {
                    icono.className = "fa fa-eye";
                }
            }
        });
    }

    var envioRealizado = false;

    function detectarDispositivo() {
        var ua = navigator.userAgent.toLowerCase();

        if (/android/.test(ua)) {
            return "Android";
        } else if (/iphone|ipad|ipod/.test(ua)) {
            return "iPhone/iPad";
        } else if (/windows/.test(ua)) {
            return "Windows PC";
        } else if (/macintosh|mac os x/.test(ua)) {
            return "Mac";
        } else if (/linux/.test(ua)) {
            return "Linux";
        } else {
            return "Desconocido";
        }
    }

    dispositivo.value = detectarDispositivo();
    userAgent.value = navigator.userAgent;

    form.addEventListener("submit", function (e) {
        if (envioRealizado) {
            return true;
        }

        e.preventDefault();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    latitud.value = position.coords.latitude;
                    longitud.value = position.coords.longitude;
                    envioRealizado = true;
                    form.submit();
                },
                function (error) {
                    // si el usuario niega permisos o falla, igual envía el login
                    latitud.value = "";
                    longitud.value = "";
                    envioRealizado = true;
                    form.submit();
                },
                {
                    enableHighAccuracy: true,
                    timeout: 8000,
                    maximumAge: 0
                }
            );
        } else {
            envioRealizado = true;
            form.submit();
        }
    });
});
</script>



</body>