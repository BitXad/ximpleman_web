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
        <script src="<?php echo base_url('resources/js/verventa_proceso.js'); ?>"></script>
        
        <input type="text" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales"  hidden>
        <?php $decimales = $parametro['parametro_decimales']; ?>
    </head>
    <?php
    if($fondomonitor == "" || $fondomonitor == null){
        $fondomonitor = "fondo_vistadetalleventa.jpeg";
    }
    if($logomonitor == "" || $logomonitor == null){
        $logomonitor = "default.png";
    }
    ?>
<body style="width: 98%; background: url('<?php echo base_url("resources/images/monitor/".$fondomonitor); ?>');">
    
<div class="box-header">
    <center>
        <!--<h3 class="box-title">PEDIDO</h3>-->        
        <img src="<?php echo base_url("resources/images/logo/".$logomonitor); ?>" width="260" height="130">
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
    </center>
</div>
    
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <div class="box">
                <div class="box-body table-responsive">
                        
                    <table class='table table-condensed '>
                        <tr style='color: white; background: gray;'>
                            <th class="text-center">CANT</th>
                            <th class="text-center">PRODUCTO</th>
                            <th class="text-right">PREC.</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                        <tbody class="buscar" id="verventa_detalle">
                        
                        </tbody>
                    </table>

                </div>
            </div>
            
        </div>
        <div class="col-md-8">
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
                                  <!--<ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                  </ol>-->

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
                                                    ?>
                                                    <img src="<?php echo base_url("resources/images/productos/".$producto_imagen); ?>" width="250" height="187">
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
            <div class="col-md-12" style="color: white; font-size:24px;">
                <center>
                    <div class="col-md-12"><b>NIT: </b>141349024</div>
                    <div class="col-md-12"><b>RAZON SOC.: </b>CONSTRUNCIORA FULANITO MENDEZ SRL</div>

                </center>         

            </div>
            
            <div class="col-md-12" id="estotal" style="text-align: center">
                
            </div>
        </div>
    </div>
</div>
    </body>
    <footer style="color: white">
        <marquee>Desarrollado por <b>PASSWORD SRL</b> Ingenieria Hardware & Software. Contactos: <b>4511518</b> - <b>77417605</b></marquee>
    </footer>
</html>
<input type="text" id="input2" name="input2" value="<?= $this->session->userdata('codigo_usuario') ?>">