<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<link href="<?php echo base_url('resources/css/vistadetalleventa.css'); ?>" rel="stylesheet">
<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    </head>
<body>
<div class="box-header">
    <h3 class="box-title">PEDIDO</h3>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <!--<table class='table table-striped table-condensed' id='mitablaventas'>-->
                    <!--<tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Precio Total</th>
                    </tr>-->
                    <!--<tbody class='buscar2'>-->
                        <?php
                        //$i = 1;
                        $cont = 0;
                        $subtotal = 0;
                        $descuento = 0;
                        $descgral = 0;
                        $totalfinal = 0;
                        
                        $cant_total = 0;
                        $total_detalle = 0;
                       // foreach($ventas as $v){
                            
                            //$categoria = '';
                            /*$cant_total = $cant_total + $v["detalleven_cantidad"];
                            $total_detalle = $total_detalle + $v["detalleven_total"];*/
                            /*$color = "";
                            if ($cont%2 == 0){
                                $color = "style='background-color: GoldenRod'";
                            }*/
                        ?>
                    <tr>
                        <td width='100%' <?php //echo $color; ?>>
                            <?php
                            foreach($ventas as $v){
                            
                            //$categoria = '';
                            $cant_total = $cant_total + $v["detalleven_cantidad"];
                            $total_detalle = $total_detalle + $v["detalleven_total"];
                            /*$color = "";
                            if ($cont%2 == 0){
                                $color = "style='background-color: GoldenRod'";
                            }*/
                        ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="<?php echo site_url('/resources/images/productos/'.$v['producto_foto']); ?>" class="img img-circle" width="250" height="187"/>
                                    <!--<img src="images/' . $item['image'] . '" alt="...">-->
                                    <div class="price"><?php echo number_format($v['detalleven_precio'], 2, '.', '')?>' $</div>
                                    <div class="caption">
                                        <h4><?php echo $v['producto_nombre']; ?></h4>
                                        <p><?php echo $v['detalleven_preferencia']; ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            <!--<div class='btn-group'>-->
                               <!-- <div style="font-size: 10pt; padding-top: 1px; padding-bottom: 1px; display: inline;"><?php echo $v["detalleven_cantidad"]; ?>
                                    <img src="<?php /*echo site_url('/resources/images/productos/'.$v['producto_foto']); ?>" class="img img-circle" width="250" height="187"/>
                                    <?php //echo $v["producto_nombre"]; ?>
                                    <?php
                                    /*if($v['detalleven_preferencia']!=null){
                                        echo "<br>"."Preferencia: ".$v['detalleven_preferencia'];
                                    }*/
                                   /* echo number_format($v["detalleven_precio"], 2, '.', ' ');
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    echo number_format($v["detalleven_total"], 2, '.', ' '); */
                                    ?>
                                </div> -->
                            <!--</div>-->
                            <?php $cont++; } ?>
                        </td>
                        <!--<td align='right' <?php //echo $color; ?>>
                            <img src="<?php /*echo site_url('/resources/images/productos/'.$v['producto_foto']); ?>" class="img img-circle" width="250" height="187"/>
                            <font size='2.9' ><label style="font-size: 10pt; width: 120pt !important; height: 120pt !important;" class='btn btn-success btn-md'><?php echo $v["detalleven_cantidad"]; ?><?php echo number_format($v["detalleven_precio"], 2, '.', ' '); ?></label></font></td>
                        <td align='right' <?php //echo $color; ?>><font size='3' ><b><?php echo number_format($v["detalleven_total"], 2, '.', ' ');*/ ?></b></font></td>
                        -->
                    </tr>
                   <?php //$cont++; } ?>
                 
                    </tbody>
                    <tr>
                        <th></th>
                        <th><font size='3'><?php echo $cant_total; ?></font></th>
                        <th><font size='3'><?php echo number_format($total_detalle, 2, '.', ' '); ?></font></th>
                    </tr>
               </table>

               </div>
        </div>
    </div>
</div>
  </body>
</html>