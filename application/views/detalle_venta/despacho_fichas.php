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



<img class="imagen-sombra-png" src="<?php echo base_url("resources/images/monitor/{$logo}?v=2"); ?>"  width="400" height="300">
        
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
        
    </center>
</div>
    
<div class="row">
    <div class="col-md-12">
        
        <div class="col-md-5">
            <div class="box">
                <div class="box-body table-responsive" style="">
                    <center style="line-height: 130px; box-shadow: 5px 16px 20px rgba(0.5, 0.4, 0.4, 0.4); " >
                        <span style="font-size: 80px; color: white; font-weight: bolder; padding: 0;">
                            PEDIDO 
                        </span>
                        <br>
                        <span style="font-size: 250px; color: white; font-weight: bolder;  padding: 0;" id="numero_pedido">
                            42
                        </span>
                        <br>
                        <span style="font-size: 40px; color: white; font-weight: bolder; padding: 0;">
                            EN DESPACHO
                        </span>
                        
                            
                    </center>
                    <img class="imagen-animada"  src="<?php echo base_url("resources/images/monitor/{$imagen}?v=2"); ?>" width="600" height="300">
                    
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
    <?php }else{ ?>   
        
        <div class="col-md-7">
            <div class="box">
            <br>
                <div class="box-body table-responsive">
                    <table class='table table-condensed'>
                        <tr>    
                            
                            <td style="padding: 0; border-top: 0px; border-bottom: 0px; ">        
                                <center>
                                    
                                    
                                    <iframe width="700px" height="550px"  style="box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.4);"
                                    src="https://www.youtube.com/embed/jG5FaIGgOtI" 
                                    title="YouTube video player" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>

                                    
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
        
        
    <?php } ?>   
        
    </div>
</div>
    
</body>

    <footer style="color: white">
        <marquee>Desarrollado por <b>PASSWORD SRL</b> Ingenieria Hardware & Software. Contactos: <b>4511518</b> - <b>77417605</b></marquee>
    </footer>
</html>
