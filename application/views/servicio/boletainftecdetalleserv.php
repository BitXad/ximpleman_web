<style type="text/css">
    #alinear{ text-align: right; }
    /*#horizontal{ white-space: nowrap;}*/
</style>
<script type="text/javascript">
    $(document).ready(function()
    {
        var f = new Date();
        var dia = f.getDate();
        if(dia <10){
            dia = "0"+f.getDate();
        }
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        var fecha = dia + " de " + meses[f.getMonth()] + " de " + f.getFullYear()
        $(fechaliteral).text(fecha);
        window.onload = window.print();
        
    });
</script>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitablaservicioimpresion-mcarta.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="row micontenidoInforme">
    <div id="cabizquierda" style="width: 40%;">

        <?php

        echo $empresa[0]['empresa_nombre']."<br>";

        echo $empresa[0]['empresa_direccion']."<br>";

        echo $empresa[0]['empresa_telefono'];

        ?>

    </div>

    <div id="cabcentro" style="width: 20%;">
            <!--<div id="titulo">
                ORDEN DE SERVICIO N°: <?php //echo $servicio['servicio_id']; ?><br>
                <span class="lahora"><?php //echo date("d/m/Y - H:i:s"); ?></span>
            </div>-->

    </div>

    <div id="cabderecha" style="width: 40%;">

            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

    </div>
</div>
<div class="row micontenedorlineas" style="margin-right: 0px; margin-left: 0px;">
    <hr />
    <hr style="margin-top: 4px;" />
</div>
<div class="row micontenidoInforme" style="float: right; margin-top: 1cm;" id="nombrecliente">
    <div style=" text-align: right; ">
    COCHABAMBA,&nbsp;<span id="fechaliteral"></span><br>
    <span id="itno">I.T.No: <?php echo $servicio['servicio_id']."/".$servicio['cliente_id']; ?></span>
    </div>
</div>
<br>
<div class="row micontenidoInforme" id="nombrecliente">
    <div style="text-align: left;">
        Se&ntilde;or(es):<br>
        <span><?php if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0))
              {
                 echo "NO DEFINIDO";
              } else{
                  echo $cliente['cliente_nombre'];
              }
        ?></span><br>
        Presente.-
    </div>
</div>
<div class="row micontenidoInforme" style="margin-top: 0px;">
    <div style="text-align: center; width: 100%; font-weight: bolder; font-size: 24px; font-family: 'arial',arial; ">
        Ref.: INFORME TÉCNICO
    </div>
</div>
<div class="row micontenidoInforme" style="margin-top: 4px;">
    <div style="text-align: justify">
    Saludos,<br><br>
    De mi mayor consideración, y petición del interesado le hacemos llegar el detalle del trabajo
    realizado e información adicional adjunta, en relación al servicio prestado por personal de nuestra empresa,
    al igual que el detalle de costos y materiales empleados descritos a continuación:
    </div>
</div>
        

<?php
    $i = 1;
    $total = 0;
    $acuenta = 0;
    $saldo = 0;
    foreach($detalle_serv as $d){
        $total = $total + $d['detalleserv_total'];
        $acuenta = $acuenta + $d['detalleserv_acuenta'];
        $saldo = $saldo + $d['detalleserv_saldo'];
?>
<div style="margin-left: 5.5cm; margin-right: 2cm;">
    <div class="negrita micontenedorlineas" style="width: 100%;">DETALLE/FECHA ING.:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm;">
        <?php echo $d['detalleserv_descripcion'] ?>
    </div><br>
    <div class="negrita micontenedorlineas" style="width: 100%;">DIAGNOSTICO:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm;">
        <?php echo $d['detalleserv_diagnostico'] ?>
    </div><br>
    <div class="negrita micontenedorlineas" style="width: 100%;">SOLUCIÓN:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm;">
        <?php echo $d['detalleserv_solucion'] ?>
        <?php if(!empty($d['detalleserv_glosa'])){
                echo "<br>".$d['detalleserv_glosa'];
            }
        ?>


    </div><br>
    <div class="negrita micontenedorlineas" style="width: 100%;">RESPONSABLE TÉCNICO:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm;">
        <?php echo $d['responsable_nombres']." ".$d['responsable_apellidos']; ?>
    </div><br>
    <div class="negrita micontenedorlineas" style="width: 100%;">COSTO PARCIAL:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm;">
        <?php echo "Bs. ".number_format($d['detalleserv_total'], 2); ?>
    </div>
</div><br>

<?php $i++; } ?>
<br>
<div style="margin-left: 5.5cm; margin-right: 2cm;">
    <div class="negrita micontenedorlineas" style="width: 100%;">COSTO TOTAL:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm;">
        <b><?php echo "Bs. ".number_format($total, 2); ?></b>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        LITERAL: <?php echo num_to_letras($total); ?>
    </div>
</div>
<div class="row micontenidoInforme" style="margin-top: 4px;">
    <div style="text-align: justify">
        <br>
        Para veracidad de la misma firmamos al pie del documento tanto los responsables
        como el personal encargado de la supervisi[on y control de calidad de nuestra Empresa.
        <br><br>
        Sin más que decir me despido,<br><br>
        Atentamente,
    </div>
</div>
<div class="row micontenidoInforme">
    <div id="cabizquierda" style="width: 40%;">
        PASSWORD S.R.L.<br>
        DPTO. TECNICO
    </div>
    <div id="cabcentro" style="width: 20%;">
        
    </div>
    <div id="cabderecha" style="width: 40%;">
        VoBo
    </div>
</div>
<div class="row micontenidoInforme">
    <div id="cabizquierda" style="width: 100%; text-align: left; font-size: 8pt;">
        CCA: Sis.Inf.Password | <?php echo Date('d/m/Y h:i:s a'); ?>
    </div>
</div>
