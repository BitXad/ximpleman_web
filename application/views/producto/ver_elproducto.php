<html class="este_no">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <link href="<?php echo base_url('resources/css/vistadetalleventa.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/css/mifuente.css'); ?>" rel="stylesheet">
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>">
        <script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
        <link rel="shortcut icon" href="<?php echo site_url('resources/images/icono.png');?>" />
        <script src="<?php echo base_url('resources/js/producto_verproducto.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
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
            <!--<div class="col-md-12">
                <input type="text" name="producto_codigobarra" id="producto_codigobarra" autofocus onclick="this.select();" onkeyup="validar_tecla(event)">
            </div>-->
            <center>
                <!--<h3 class="box-title">PEDIDO</h3>-->        
                <img src="<?php echo base_url("resources/images/logo/".$logomonitor); ?>" width="260" height="130" class="este_no">
                <br>
                <input type="text" name="producto_codigobarra" id="producto_codigobarra" autofocus onclick="this.select();" onkeyup="validar_tecla(event)">
                <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
                <input type="hidden" name="simbolo_moneda" id="simbolo_moneda" value="<?php echo $simbolo_moneda; ?>" />
                <input type="hidden" name="decimales" id="decimales" value="<?php echo $decimales; ?>" />
            </center>
            <div class="row" id='loader' style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                </center>
            </div> 
        </div>
        <div class="row este_no">
            <div class="col-md-12 este_no">
                <span class="este_no" id="producto_detalle"></span>
            </div>
        </div>
    </body>
    <!--<footer style="color: white">
        <marquee>Desarrollado por <b>PASSWORD SRL</b> Ingenieria Hardware & Software. Contactos: <b>4511518</b> - <b>77417605</b></marquee>
    </footer>-->
</html>