<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<link href="<?php echo base_url('resources/css/vistadetalleventa.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mifuente.css'); ?>" rel="stylesheet">
<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    </head>
<body>
    
<div class="box-header">
    <center>
        <!--<h3 class="box-title">PEDIDO</h3>-->        
        <img src="<?php echo base_url("resources/images/logomrwings.png"); ?>" width="260" height="130">
    </center>
</div>
    
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <div class="box">



                <div class="box-body table-responsive">
                    <table class='table table-condensed '>
                            
                        <?php
                        $cant_total = 0;
                        $total_detalle = 0;
                                echo sizeof($ventas);
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
                                    <h4><img src="<?php echo base_url("resources/images/productos/".$v["producto_foto"]); ?>" width="50" height="70" class="img img-circle" ></h4>
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
                            <?php  } ?>
                        <td style="padding: 0" colspan="3">                      
                                <h4 style="color: white;"><font size="8"><b> Total Bs</b></font></h4>
                            </td>
                            <td style="padding: 0" align="right">                    
                                <h4 style="color: white;"><font size="8"><b> <?php echo number_format($total_detalle,2,".",","); ?></b></font></h4>
                            </td>

                    </table>

                </div>
            </div>
            
        </div>
        <div class="col-md-8">
            <div class="box">
        <br>



                <div class="box-body table-responsive">
                    <table class='table table-condensed '>
                            
                        
                        <tr>    
                                
                            <td style="padding: 0">        
                                <center>
                                                         
                                <h4 style="color: white;"><font size="4"><b> <?php echo "El slider aqui"; ?></b></font></h4>
                            
                                
                                </center>
                            </td>
                            

                        </tr>
                        <tr>
                            <td>
                                
                            </td>
                        </tr>
                            
                    </table>

                </div>
            </div>
            
        </div>
        
        
        
    </div>
</div>
    
    
<div class="row">
    <div class="col-md-12">
        <center>
        <h4 style="color: white;"><font size="6" face="eurostyle"><b> <?php echo "Cliente: JUAN PEREZ MENDEZ"; ?></b></font></h4>
        <h4 style="color: white;"><font size="6"><b> <?php echo "Razón: 141359034"; ?></b></font></h4>            
        </center>            
    </div>        
</div>
    
  </body>
</html>