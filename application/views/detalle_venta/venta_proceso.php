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
    </head>
<body style="width: 98%">
    
<div class="box-header">
    <center>
        <!--<h3 class="box-title">PEDIDO</h3>-->        
        <img src="<?php echo base_url("resources/images/logomrwings.png"); ?>" width="260" height="130">
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
    </center>
</div>
    
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class='table table-condensed '>
                        <tbody class="buscar" id="verventa_detalle">
                        <?php
                       /* $cant_total = 0;
                        $total_detalle = 0;
                                echo "<br>"; //sizeof($ventas);
                        foreach($ventas as $v){

                        $cant_total = $cant_total + $v["detalleven_cantidad"];
                        $total_detalle = $total_detalle + $v["detalleven_total"];

                        ?>
                        <tr>    
                                
                            <td style="padding: 0">        
                                <center>
                            
                                <font size="2"><br></font>
                                <h4 style="color: white;"><font size="6"><b> <?php echo $v["detalleven_cantidad"]; ?></b></font></h4>
                                </center>
                            </td>
                            <td style="padding: 0"> 
                                <center>
                                    <h4><img src="<?php echo base_url("resources/images/productos/".$v["producto_foto"]); ?>" width="65" height="65" class="img img-circle" ></h4>
                                </center>                                
                            </td>
                            <td style="padding: 0" align="right"> 
                                <font size="2"><br></font>
                                <h4 style="color:white"><font size="6"><b> <?php echo number_format($v["detalleven_precio"],2,".",","); ?></b></font></h4>
                            </td>
                            <td style="padding: 0" align="right"> 
                                <font size="2"><br></font>
                                <h4 style="color: white;"><font size="6"><b> <?php echo number_format($v["detalleven_total"],2,".",","); ?></b></font></h4>
                            </td>

                        </tr>
                            <?php  }*/ ?>
                       <!-- <td style="padding: 0" colspan="3">                      
                                <h4 style="color: white;"><font size="8"><b> Total Bs</b></font></h4>
                            </td>
                            <td style="padding: 0" align="right">                    
                                <h4 style="color: white;"><font size="8"><b> <?php //echo number_format($total_detalle,2,".",","); ?></b></font></h4>
                            </td>
                            -->
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
                                <h4 style="color: white;"><font size="4"><b> <?php echo "Prueba nuestras ofertas"; ?></b></font></h4>
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
                                                        <h3 style="color: #FF6501;"><font size="6"><b><?php echo "Bs. ".number_format($producto['producto_precio'],2,".",","); ?></b></font></h3>
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
                                                        <h3 style="color: #FF6501;"><font size="6"><b><?php echo "Bs. ".number_format($producto['producto_precio'],2,".",","); ?></b></font></h3>
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
            <div class="col-md-12" id="estotal" style="text-align: left">
            </div>
        </div>
    </div>
</div>
    </body>
    <footer style="color: white">
        <marquee>Desarrollado por <b>PASSWORD SRL</b> Ingenieria Hardware & Software. Contactos: <b>4511518</b> - <b>77417605</b></marquee>
    </footer>
</html>