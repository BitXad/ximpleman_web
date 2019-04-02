<html>
    <head>
        <script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
    </head>
    <body onload="inicio()">
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<link href="<?php echo base_url('resources/css/lineatime.css'); ?>" rel="stylesheet">
<div>
<section class="section intro">
  <div class="container">
    <h1>SEGUIMIENTO DEL SERVICIO DE
        <?php if(!is_null($servicio[0]['cliente_nombre'])){ echo ' "'.$servicio[0]['cliente_nombre'].'"'; } ?></h1>
  </div>
</section>

<section class="timeline">
        <?php
        $estado = "";
        foreach ($servicio as $s){
            $estado = 1;
            ?>
        <ol>
            <li>
                <div id="color1">
                    <time>RECEPCIONADO: <?php echo date("d/m/Y", strtotime($s['servicio_fecharecepcion']))." ".$s['servicio_horarecepcion']; ?>
                        <br>Resp. Tec.: <?php echo $s['usuario_nombre'] ?>
                    </time>
                </div>
            </li>
            <?php /*if($s['responsable_id'] != null){ ?>
            <li>
                <div class="pendiente">
                    <time>Responsable Tec.: <?php echo $s['usuario_nombre'] ?></time>
                </div>
            </li>
            <?php }*/ ?>
            <?php if($s['detalleserv_diagnostico'] != "" && $s['detalleserv_diagnostico'] != "" && $s['detalleserv_diagnostico'] != ""){ ?>
            <li>
                <div id="color2">
                    <time>PROCESO: <?php echo $s['detalleserv_diagnostico']; $estado = 2; ?></time>
                </div>
            </li>
            <?php } ?>
            <?php if($s['detalleserv_fechaterminado'] != null){ ?>
            <li>
                <div id="color3">
                    <time>FINALIZADO: <?php echo date("d/m/Y", strtotime($s['detalleserv_fechaterminado']))." ".$s['detalleserv_horaterminado']; echo " ".$s['detalleserv_solucion']; echo " ".$s['detalleserv_glosa']; $estado = 3; ?></time>
                </div>
            </li>
            <?php } ?>
            <?php if($s['detalleserv_fechaentregado'] != null){ ?>
            <li>
                <div id="color4">
                    <time>ENTREGADO: <?php echo date("d/m/Y", strtotime($s['detalleserv_fechaentregado']))." ".$s['detalleserv_horaentregado']; $estado = 4; ?></time>
                </div>
            </li>
            <?php } ?>
            <li></li>
        </ol>
    
        <?php
        }
        ?>
    <input type="hidden" name="estestado" id="estestado" value="<?php echo $estado; ?>" />
    <script type="text/javascript">
        function inicio(){
            var res = $('#estestado').val();
            if(res == 1){
                var rescss1 = { "background": '#ed632d', "timeline ol li:nth-child(odd) div::before" : 'border-color: #ed632d transparent transparent transparent' };
                $('#color1').css(rescss1)
            }else if(res == 2){
                var rescss2 = { "background": '#ed632d', "timeline ol li:nth-child(even) div::before" : "transparent transparent transparent #ed632d  !important" };
                //var rescss2 = { "background": '#ed632d', "timeline ol li:nth-child(even) div::before" : 'transparent transparent transparent #ed632d' };
                $('#color2').css(rescss2)
            }else if(res == 3){
                //$('#color3').addClass('colorabajo');
                //var rescss3 = { "background": '#ed632d', "border-color": "#ed632d transparent transparent transparent" };
                $('#color3').css({
                    "background": '#ed632d',
                    
                });
                
                /*$('#color3').addClass('colorabajo');*/
                /*$('.colorabajo').css({
                    "border-color": "#ed632d transparent transparent transparent"
                })*/
                /*
                $('.colorabajo').css({
                    "top": "100%",
                    "border-width": "8px 8px 0 0",
                    "border-color": "#ed632d transparent transparent transparent"
                })*/
                
            }else if(res == 4){
                var rescss4 = { "background": '#ed632d', "timeline ol li:nth-child(even) div::before" : "top: -8px; border-width: 8px 0 0 8px; transparent transparent transparent #ed632d" };
                $('#color4').css(rescss4)
            }
        }
    </script>
  <div class="arrows">
      <a href="<?php echo site_url(''); ?>" class="btn btn-danger"><span class="fa fa-times"></span> Salir</a>
  </div>
</section>
</div>
</body>
</html>