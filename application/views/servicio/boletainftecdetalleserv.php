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
        //window.onload = window.print();
        
    });
</script>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitablaservicioimpresion-mcarta.css'); ?>" rel="stylesheet">
<!------------------------------------------------------->
<?php
$mostrar = "";
$mostrar1 = "";
if(isset($sintitulo)){
    $mostrar = "style='display: none'";
    $mostrar1 = "display: none;";
}
?>
<div class="row micontenidoInforme" <?php echo $mostrar; ?> >
    <div id="cabizquierda" style="width: 40%; font-size: 8pt;">

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
<div class="row micontenedorlineas" style="margin-right: 0px; margin-left: 0px; <?php echo $mostrar1; ?>" >
    
    <hr style="margin-top: 2px; height: 4px !important; background-color: #000;" />
</div>
<div class="row micontenidoInforme" style="float: right; margin-top: 1cm;" id="nombrecliente">
    <div style=" text-align: right; font-size: 8pt;">
    COCHABAMBA,&nbsp;<span id="fechaliteral"></span><br>
    <span id="itno">I.T.No: <?php echo $detalle_serv['detalleserv_id']."/".$servicio['cliente_id']; ?></span>
    </div>
</div>
<br>
<div class="row micontenidoInforme" id="nombrecliente">
    <div style="text-align: left; font-size: 8pt;">
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
    <div style="text-align: center; width: 100%; font-weight: bolder; font-size: 12pt; font-family: Arial; ">
        Ref.: INFORME TÉCNICO
    </div>
</div>
<div class="row micontenidoInforme" style="margin-top: 4px;">
    <div style="text-align: justify; font-size: 8pt;">
    Saludos,<br><br>
    De mi mayor consideración, y petición del interesado le hacemos llegar el detalle del trabajo
    realizado e información adicional adjunta, en relación al servicio prestado por personal de nuestra empresa,
    al igual que el detalle de costos y materiales empleados descritos a continuación:
    </div>
</div>
        
<br>
<?php
    //$i = 1;
    /*$total = 0;
    $acuenta = 0;
    $saldo = 0;*/
    //foreach($detalle_serv as $d){
        /*$total = $total + $d['detalleserv_total'];
        $acuenta = $acuenta + $d['detalleserv_acuenta'];
        $saldo = $saldo + $d['detalleserv_saldo'];*/
?>
<div style="margin-left: 5.5cm; margin-right: 2cm; font-family: Arial !important;">
    <div class="negrita micontenedorlineas" style="width: 100%; display: flex; font-size: 7.5pt !important;">
        <div style="width: 45%">DETALLE/FECHA ING.:</div>
        <div style="width: 10%"><?php //echo "No. ".$i;?></div>
        <div style="width: 45%; text-align: center">
        <?php echo date("d/m/Y", strtotime($servicio['servicio_fecharecepcion'])); ?>
        </div>
    </div>
    <div class="micontenedorlineas" style="width: 100%;">
        <hr style="margin-left: 0px; border-top: 1px solid;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm; font-size: 7.5pt !important;">
        <?php echo $detalle_serv['detalleserv_descripcion'] ?>
    </div><!--<br>-->
    <div class="negrita micontenedorlineas" style="width: 100%; padding-top: 15px; font-size: 7.5pt !important;">DIAGNOSTICO:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm; font-size: 7.5pt !important;">
        <?php echo $detalle_serv['detalleserv_diagnostico'] ?>
    </div><!--<br>-->
    <div class="negrita micontenedorlineas" style="width: 100%; padding-top: 15px; font-size: 7.5pt !important;">SOLUCIÓN:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm; font-size: 7.5pt !important;">
        <?php echo $detalle_serv['detalleserv_solucion'] ?>
        <?php if(!empty($detalle_serv['detalleserv_glosa'])){
                echo "<br>".$detalle_serv['detalleserv_glosa'];
            }
        ?>


    </div><!--<br>-->
    <div class="negrita micontenedorlineas" style="width: 100%; font-size: 7.5pt; padding-top: 15px;">RESPONSABLE TÉCNICO:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm; font-size: 7.5pt;">
        <?php echo $detalle_serv['responsable_nombre']; ?>
    </div><!--<br>-->
    <div class="negrita micontenedorlineas" style="width: 100%; padding-top: 15px;font-size: 7.5pt !important;">COSTO TOTAL:
        <hr style="margin-left: 0px;">
    </div>
    <div class="micontenedorlineas" style="margin-left: 2cm; font-size: 8pt;">
        <?php echo "Bs. ".number_format($detalle_serv['detalleserv_total'], 2); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        LITERAL: <?php echo num_to_letras($detalle_serv['detalleserv_total']); ?>
    </div>
</div><!--<br>-->

<?php  ?>

<div class="row micontenidoInforme" style="margin-top: 4px; font-size: 8pt;">
    <div style="text-align: justify">
        <br>
        Para veracidad de la misma firmamos al pie del documento tanto los responsables
        como el personal encargado de la supervisión y control de calidad de nuestra Empresa.
        <br><br>
        Sin más que decir me despido,<br><br>
        Atentamente,
    </div>
</div>
<div class="row micontenidoInforme">
    <div id="cabizquierda" style="width: 40%; font-family: Arial; font-size: 8pt;">
        <?php echo $usuario_nombre; ?><br>
        DPTO. TECNICO
    </div>
    <div id="cabcentro" style="width: 20%;">
        
    </div>
    <div id="cabderecha" style="width: 40%; font-family: Arial; font-size: 8pt;">
        VoBo
    </div>
</div>
<div class="row micontenidoInforme">
    <div id="cabizquierda" style="width: 100%; text-align: left; font-size: 7pt;">
        CCA: Sis.Inf.Password | <?php echo Date('d/m/Y h:i:s a'); ?>
    </div>
</div>
<div class="no-print">
    <a onclick="javascript:window.close();" class="btn btn-danger">
    <i class="fa fa-times"></i>Salir
</a>
</div>