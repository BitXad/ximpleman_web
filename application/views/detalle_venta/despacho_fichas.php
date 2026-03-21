<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <link href="<?php echo base_url('resources/css/vistadetalleventa.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/css/mifuente.css'); ?>" rel="stylesheet">
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>">
        <script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
        <!--<link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>-->
        <link rel="shortcut icon" href="<?php echo site_url('resources/images/icono.png');?>" />
        <script src="<?php echo base_url('resources/js/despacho_fichas.js'); ?>"></script>
        
        <input type="text" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales"  hidden>
        <?php $decimales = $parametro['parametro_decimales']; ?>
    </head>
    <?php
    if($fondomonitor == "" || $fondomonitor == null){
        $fondomonitor = "fondo_despacho.jpg";
    }
    if($logomonitor == "" || $logomonitor == null){
        $logomonitor = "default.png";
    }
    ?>
<body style="width: 98%; background-image: url('<?php echo base_url("resources/images/monitor/{$fondomonitor}?v=2"); ?>');">
    
    <!--<body style="background-image: url('assets/img/fondo.jpg?v=2');">-->
    
<div class="box-header">
    <center>
        <!--<h3 class="box-title">PEDIDO</h3>-->        
        <?php $logo = "logo.png"; //$empresa[0]["empresa_imagen"]; ?>
        <?php $imagen = "imagen1.png"; ?>
        
<style>
    .imagen-animada {
        animation: girar 6s infinite linear, 
                   aparecer 3s infinite ease-in-out,
                   saltar 2s infinite ease-in-out;
       /* box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.4);*/
       filter: drop-shadow(4px 4px 6px rgba(0,0,0,0.6));
        border-radius: 10px;
    }

    /* Rotación */
    @keyframes girar {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Fade in / out */
    @keyframes aparecer {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 1; }
    }

    /* Movimiento de un lado a otro */
    @keyframes saltar {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(20px); }
    }
</style>

<style>
    .imagen-animada2 {
        animation: rebote 2s infinite ease-in-out,
                   pulso 3s infinite ease-in-out,
                   giro3d 6s infinite linear,
                   sombra-dinamica 3s infinite ease-in-out;
        border-radius: 12px;
    }

    /* Rebote vertical */
    @keyframes rebote {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* Pulso */
    @keyframes pulso {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Giro 3D */
    @keyframes giro3d {
        0% { transform: rotateY(0deg); }
        100% { transform: rotateY(360deg); }
    }

    /* Sombra que cambia */
    @keyframes sombra-dinamica {
        0%, 100% { box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3); }
        50% { box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.6); }
    }
</style>

<style>
    
    .imagen-sombra-png {
        filter: drop-shadow(4px 4px 6px rgba(0,0,0,0.6));
    }

</style>



<div class="row">
    <div class="col-md-12">
<img class="imagen-sombra-png" src="<?php echo base_url("resources/images/monitor/{$logo}?v=2"); ?>"  width="160" height="120" >
    </div> 
</div>       
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
        
    </center>
</div>
    
<div class="row">
    <div class="col-md-12">
        
        <div class="col-md-5">
            <div class="box">
                <div class="box-body table-responsive" style="">
                    <center style="line-height: 105px; box-shadow: 5px 16px 20px rgba(0.5, 0.4, 0.4, 0.4); " >
                        <span style="font-size: 80px; color: white; font-weight: bolder; padding: 0;                                 text-shadow:
                                    -2px -2px 4px black,   /* sombra arriba izquierda */
                                    2px -2px 4px black,    /* sombra arriba derecha */
                                    -2px 2px 4px black,    /* sombra abajo izquierda */
                                    2px 2px 4px black; ">
                            PEDIDO 
                        </span>
                        <br>
                            <span style="
                                font-size: 180px; 
                                color: white; 
                                font-weight: bolder;  
                                padding: 0;
                                text-shadow:
                                    -2px -2px 4px black,   /* sombra arriba izquierda */
                                    2px -2px 4px black,    /* sombra arriba derecha */
                                    -2px 2px 4px black,    /* sombra abajo izquierda */
                                    2px 2px 4px black;     /* sombra abajo derecha */
                            " id="numero_pedido">
                                00
                            </span>
                        <br>
                        <span style="font-size: 40px; color: white; font-weight: bolder; padding: 0;                                text-shadow:
                                    -2px -2px 4px black,   /* sombra arriba izquierda */
                                    2px -2px 4px black,    /* sombra arriba derecha */
                                    -2px 2px 4px black,    /* sombra abajo izquierda */
                                    2px 2px 4px black; ">
                            EN DESPACHO
                        </span>
                        
                            
                    </center>
                    <!--<img class="imagen-animada"  src="<?php echo base_url("resources/images/monitor/{$imagen}?v=2"); ?>" width="600" height="300">-->
                    
                </div>
            </div>
            
        </div>

        
<?php 
    $carrusel = 0;
    if ($carrusel==1){ ?>        
        <div class="col-md-7">
            <div class="box">
            <br>
                <div class="box-body table-responsive">
                    <table class='table table-condensed'>
                        <tr>    
                            <td style="padding: 0; border-top: 0px; border-bottom: 0px">        
                                <center>
                                <h4 style="color: white;"><font size="4"><b> <?php echo "- OFERTAS -"; ?></b></font></h4>
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                  <!-- Indicators -->
                                  <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                  </ol>

                                  <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <?php
                                        $band = true;
                                        foreach($productos as $producto){
                                            if($band == true){
                                        ?>
                                                <div class="item active">
                                                    <?php
                                                    $producto_imagen = $producto['producto_foto'];
                                                    if($producto['producto_foto'] == "null" || $producto['producto_foto'] == "")
                                                    {
                                                        $producto_imagen = "producto.jpg";
                                                    }
                                                    ?>
                                                    <img src="<?php echo base_url("resources/images/productos/".$producto_imagen); ?>" width="250" height="187" style="display: flex">
                                                    <div class="carousel-inner" style="padding: 0">
                                                        <h3 style="color: #FF6501;"><font size="6"><b><?php echo "Bs. ".number_format($producto['producto_precio'],$decimales,".",",") ?></b></font></h3>
                                                        <p  style="color: #FF6501;"><font size="6"><b><?php echo $producto['producto_nombre']; ?></b></font></p>
                                                    </div>
                                                </div>
                                        <?php
                                                $band = false;
                                            }else{
                                            ?>
                                                <div class="item">
   
                                                    <?php
                                                    $producto_imagen = $producto['producto_foto'];
                                                    if($producto['producto_foto'] == "null" || $producto['producto_foto'] == "")
                                                    {
                                                        $producto_imagen = "producto.jpg";
                                                    }
                                                    
                                                    $imagen_path = base_url("resources/images/productos/".$producto_imagen);
                                                    
                                                    if (file_exists($imagen_path)) {
                                                    
                                                    ?>
                                                    
                                                        <img src="<?php echo base_url("resources/images/productos/".$producto_imagen); ?>" width="250" height="187">
                                                    <?php } ?>
                                                        
                                                    <div class="carousel-inner">
                                                        <h3 style="color: #FF6501;"><font size="6"><b><?php echo "Bs. ".number_format($producto['producto_precio'],$decimales,".",",") ?></b></font></h3>
                                                        <p  style="color: #FF6501;"><font size="6"><b><?php echo $producto['producto_nombre']; ?></b></font></p>
                                                    </div>
                                                    <!--</div>-->
                                                </div>
                                            <?php
                                            }
                                        }
                                        ?>
                                        
                                  <!-- Left and right controls -->
                                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                                </div>
                                </center>
                            </td>
                        </tr>
                        
                        <tr>
                            
                            <td style="border-top: 0px; border-bottom: 0px">
                                
                            </td>
                        </tr>
                    </table>
                    
                </div>
            </div>
            
        </div>
    <?php }else{
            
            $mostrarvideo = 1; //1 mostrar ** 0 no mostrar
            $mostrarimagen = 0;  //1 mostrar ** 0 no mostrar
        
        ?>   
        
        <div class="col-md-7">
            <div class="box">
            <br>
                <div class="box-body table-responsive">
                    <table class='table table-condensed'>
                        
                        <tr>    
                            <?php if($mostrarvideo==1){ ?>
                            <td style="padding: 0; border-top: 0px; border-bottom: 0px; ">        
<!--                                <center>
                                    <?php 
                                        $anchovideo = "600px";
                                        $altovideo = "337px";
                                    ?>
                                    
                                    <iframe width="<?= $anchovideo; ?>" height="<?= $altovideo; ?>"  style="box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.4);"
                                    src="https://www.youtube.com/embed/jG5FaIGgOtI" 
                                    title="YouTube video player" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                    </iframe>

                                    
                                </center>-->
<center>
<?php 
    $anchovideo = "600px";
    $altovideo = "337px";
?>
<iframe 
    width="<?= $anchovideo; ?>" 
    height="<?= $altovideo; ?>" 
    style="box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.4);"                                
    src="https://www.youtube.com/embed/jG5FaIGgOtI?autoplay=1&mute=1&playsinline=1&enablejsapi=1"
    title="YouTube video player"
    frameborder="0"
    allow="autoplay; encrypted-media; picture-in-picture"
    allowfullscreen>
</iframe>
</center>                        
                                
                            </td>
                            <?php } ?>

                            <?php if($mostrarimagen==1){ ?>
                            <td style="padding: 0; border-top: 0px; border-bottom: 0px; ">        
                                <center>
                                <td style="padding: 0; border-top: 0px; border-bottom: 0px">        
                                <center>
                                <h4 style="color: white;"><font size="4"><b> <?php echo "- OFERTAS -"; ?></b></font></h4>
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                  <!-- Indicators -->
                                  <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                  </ol>

                                  <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <?php
                                        $band = true;
                                        foreach($productos as $producto){
                                            if($band == true){
                                        ?>
                                                <div class="item active">
                                                    <?php
                                                    $producto_imagen = $producto['producto_foto'];
                                                    if($producto['producto_foto'] == "null" || $producto['producto_foto'] == "")
                                                    {
                                                        $producto_imagen = "producto.jpg";
                                                    }
                                                    ?>
                                                    <img src="<?php echo base_url("resources/images/productos/".$producto_imagen); ?>" width="250" height="187" style="display: flex">
                                                    <div class="carousel-inner" style="padding: 0">
                                                        <h3 style="color: #ffffff;"><font size="3"><b><?php echo "Bs. ".number_format($producto['producto_precio'],$decimales,".",",") ?></b></font></h3>
                                                        <p  style="color: #ffffff;"><font size="3"><b><?php echo $producto['producto_nombre']; ?></b></font></p>
                                                    </div>
                                                </div>
                                        <?php
                                                $band = false;
                                            }else{
                                            ?>
                                                <div class="item">
   
                                                    <?php
                                                    $producto_imagen = $producto['producto_foto'];
                                                    if($producto['producto_foto'] == "null" || $producto['producto_foto'] == "")
                                                    {
                                                        $producto_imagen = "producto.jpg";
                                                    }
                                                    
                                                    $imagen_path = base_url("resources/images/productos/".$producto_imagen);
                                                    
                                                    if (file_exists($imagen_path)) {
                                                    
                                                    ?>
                                                    
                                                        <img src="<?php echo base_url("resources/images/productos/".$producto_imagen); ?>" width="250" height="187">
                                                    <?php } ?>
                                                        
                                                    <div class="carousel-inner">
                                                        <h3 style="color: #ffffff;"><font size="3"><b><?php echo "Bs. ".number_format($producto['producto_precio'],$decimales,".",",") ?></b></font></h3>
                                                        <p  style="color: #ffffff;"><font size="3"><b><?php echo $producto['producto_nombre']; ?></b></font></p>
                                                    </div>
                                                    <!--</div>-->
                                                </div>
                                            <?php
                                            }
                                        }
                                        ?>
                                        
                                  <!-- Left and right controls -->
                                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                                </div>
                                </center>
                            </td>
                                </center>
                            </td>
                            <?php } ?>
                            
                            
                        </tr>
                        
                        
                        <tr>
<td style="border-top: 0px; border-bottom: 0px;">
    <div id="ordenes_terminadas">
        <table style="border: 2px solid black; border-collapse: collapse; background-color: #f71752; color: white; font-size: 50px; table-layout: fixed; width: 100%;">
            <tr id='mifila'>
<!--                <td style="border: 2px solid black; padding: 5px; width: 100px; text-align: center;">45</td>
                <td style="border: 2px solid black; padding: 5px; width: 100px; text-align: center;">345</td>
                <td style="border: 2px solid black; padding: 5px; width: 100px; text-align: center;">456</td>
                <td style="border: 2px solid black; padding: 5px; width: 100px; text-align: center;">463</td>
                <td style="border: 2px solid black; padding: 5px; width: 100px; text-align: center;">45</td>-->
            </tr>
        </table>
    </div>
</td>
                            </td>
                        </tr>
                    </table>
                    
                </div>
            </div>
            
        </div>
        
        
    <?php } ?>   
        
    </div>
</div>
    
</body>
<style>
        footer {
            position: fixed;      /* Fija el footer en pantalla */
            bottom: 0;            /* Lo coloca en la parte inferior */
            left: 0;              /* Alinea al borde izquierdo */
            width: 100%;          /* Ocupa todo el ancho */
            background-color: #000; /* Fondo negro (puedes cambiarlo) */
            color: white;         /* Texto blanco */
            text-align: center;   /* Centra el texto */
            padding: 5px 0;       /* Espaciado vertical */
            font-family: Arial, sans-serif;
            z-index: 1000;        /* Asegura que quede sobre otros elementos */
        }
        marquee {
            font-size: 14px;
        }
    </style>
    <footer style="color: white;">
        <marquee>Desarrollado por <b>PASSWORD</b> Ingenieria Hardware & Software. Contactos: <b>4511518</b> - <b>77417605</b></marquee>
    </footer>
<!--    <footer style="color: white;">
        <marquee>Bienvenidos a <b>POLLITO Z&Aacute;RATE...</b> Siente el sabor...<b>***</b> Gracias por su preferencia...!</marquee>
    </footer>-->
</html>
