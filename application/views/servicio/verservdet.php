<?php $usuario_id = 2; ?>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<style type="text/css">
/*    #tamtex{ font-size: 0.1em; }*/
    #recepcion{ background-color: #FFFF33; font-size: small; }
    #entrega{ background-color: #00FF33; font-size: small; }
    #terminado{ background-color: #5C6BC0; font-size: small; }
    #entregado{ background-color: #31b0d5; font-size: small; }
    #alinear{ text-align: right; }
    #numeracion{ text-align: right; }
    #horizontal{ white-space: nowrap; }
    #masgrande{ font-size: 20px; }
    #estilo_div{
  background:#F0F5F0;
  border:solid 10px #F0F5F0;
  border-radius:15px; 
  /*box-shadow: 8px 8px 10px 0px #818181;*/
/*  height:100px;
  width:250px;*/
}
</style>
<!----------------------------- script buscador --------------------------------------->
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $("#cobro_detalle").change(function(){
                if($("#cobro_detalle").val() <= $("#este_saldo").val()){
                    $('#cobro_detalle').css('color', 'black');
                }else{
                    $('#cobro_detalle').css('color', 'red');
                    $('#cobro_detalle').focus();
                    alert("El monto a Cobrar no debe exceder los "+ $("#este_saldo").val());
                }
            });
        }(jQuery));
    
    });
    
</script>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box-header with-border">
    <h3 class="box-title"><b>Detalle del Servicio N°: <?php echo $servicio['servicio_id'] ?></b></h3>
    <div class="container">
        <div class="panel panel-primary col-md-5">
            <h5>
                <b>Cliente: </b><?php if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0)){ echo "NO DEFINIDO";} else{ echo $cliente['cliente_nombre']; } ?><br>
                <b>Codigo Cliente: </b><?php if(is_null($cliente['cliente_codigo'])){ echo "NO DEFINIDO";} else{ echo $cliente['cliente_codigo']; } ?><br>
                <b>Fecha/Hora: </b><?php if(is_null($servicio['servicio_fecharecepcion'])){ echo "NO DEFINIDO";} else{ echo date('d/m/Y', strtotime($servicio['servicio_fecharecepcion'])); echo '|'.$servicio['servicio_horarecepcion']; } ?><br>
                <b>Registrado por: </b><?php if(is_null($usuario['usuario_id'])){ echo "NO DEFINIDO";} else{ echo $usuario['usuario_nombre']; } ?><br>
                <b>Tipo Servicio: </b><?php if(is_null($servicio['tiposerv_id'])){ echo "NO DEFINIDO";} else{ echo $tipo_servicio['tiposerv_descripcion'];
                                            if($servicio['tiposerv_id'] == 2){
                                              echo "<br><b>Dirección: </b>".$servicio['servicio_direccion'];
                                            } } ?>
            </h5>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
            <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese detalle, codigo..">
            </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>N°</th>
                        <th>Detalle</th>
                        <th>Codigo</th>
                        <th>Categoria/<br>Subcategoria</th>
                        <th>Tipo<br>Trabajo</th>
                        <th>Finalizado</th>
                        <th>Entregado</th>
                        <th>Estado</th>
                        <th>Informe</th>
                        <th>Peso<br>(Gr.)</th>
                        <th>Insumo</th>
                        <th>Datos<br>Adicionales</th>
                        <th>Total</th>
                        <th>Acuenta</th>
                        <th>Saldo</th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                         $i = 1;
                         $sumTotal = 0; $sumAcuenta = 0;
                         $sumSaldo = 0; $cont = 0;
                         foreach($detalle_serv as $d){
                             if($d['esteestado'] == 6){
                             $sumTotal = $sumTotal + $d['detalleserv_total'];
                             $sumAcuenta = $sumAcuenta + $d['detalleserv_acuenta'];
                             $sumSaldo = $sumSaldo + $d['detalleserv_saldo'];
                         }
                             $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?>


                        </td>
                        <td id="horizontal"><?php 
                              echo '<font size="1">'.$d['detalleserv_descripcion'].'</font><br>';
                              if($d['procedencia_id']<>0){echo '<font size="1"><b>Proc.: </b>'.$d['procedencia_descripcion'].'</font><br>';}
                              if($d['tiempouso_id']<>0){echo '<font size="1"><b>T. uso.: </b>'.$d['tiempouso_descripcion'].'</font><br>';}
                              if($d['detalleserv_reclamo'] == "si"){$res = "Si";}else{$res = "No"; }
                              echo '<font size="1"><b>¿Recl.?: </b>'.$res.'</font><br>';
                              echo '<font size="1"><b>Tec.R.: </b>'.$d['responsable_nombres']." ".$d['responsable_apellidos'].'</font><br>';
                              echo '<font size="1"><b>Reg.: </b>'.$d['usuario_nombre'].'</font><br>';
                              echo '<font size="1"><b>Entrega: </b>'; echo date('d/m/Y', strtotime($d['detalleserv_fechaentrega'])) ; echo ' <b>Hrs.: </b>'.$d['detalleserv_horaentrega'].'</font>';
                            ?>
                        </td>
                        <td><?php echo $d['detalleserv_codigo']; ?></td>
                        <td><?php if($d['catserv_id']<>0){echo $d['catserv_descripcion'].'/';} if($d['subcatserv_id']<>0){ echo $d['subcatserv_descripcion'];} ?></td>
                        <td><?php if($d['cattrab_id']<>0){echo $d['cattrab_descripcion'];} ?></td>
                        <td><?php if(isset($d['detalleserv_fechaterminado'])){ echo date('d/m/Y', strtotime($d['detalleserv_fechaterminado'])).' <br>'.date('H:i:s', strtotime($d['detalleserv_horaterminado']));}  ?></td>
                        <td><?php if(isset($d['detalleserv_fechaentregado'])){ echo date('d/m/Y', strtotime($d['detalleserv_fechaentregado'])).' <br>'.date('H:i:s', strtotime($d['detalleserv_horaentregado']));}  ?></td>
                        <td style="background-color: #<?php echo $d['estado_color']; ?>"><?php echo $d['estado_descripcion']; ?></td>
                        <td id="horizontal"><?php echo '<font size="1"><b>Falla: </b>'.$d['detalleserv_falla'].'<br><b>Diagnostico: </b>'.$d['detalleserv_diagnostico'].'<br><b>Solucion: </b>'.$d['detalleserv_solucion'].'</font>'; ?></td>
                        <td><?php echo '<font size="1"><b>Entrada: </b>'.$d['detalleserv_pesoentrada'].'</font><br>';
                                  echo '<font size="1"><b>Salida: </b>'.$d['detalleserv_pesosalida'].'</font>'; ?></td>
                        <td><?php echo $d['detalleserv_insumo']; ?></td>
                        <td><?php echo $d['detalleserv_glosa']; ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_total'],'2','.',',') ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_acuenta'],'2','.',',') ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></td>
                                              
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-body table-responsive table-condensed">
                <table class="table table-striped table-condensed" >
                    <tbody>
                        <tr>
                            <th>Descripción</th>
                            <th>Totales</th>
                        </tr>
                        <tr>
                            <td>Total Final</td>
                            <td><?php echo number_format($servicio['servicio_total'],'2','.',','); ?></td>
                        </tr>
                        <tr>
                            <td>A cuenta</td>
                            <td><?php echo number_format($servicio['servicio_acuenta'],'2','.',','); ?></td>
                        </tr>
                        <tr>
                            <th id="masgrande">Saldo</th>
                            <th id="masgrande"><?php echo number_format($servicio['servicio_saldo'],'2','.',','); ?></th>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    <div style="float: right">
    <center>
        <a href="<?php echo site_url('detalle_serv/kardexserviciocliente/'.$servicio['cliente_id']); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>
    </center>
</div>
   
</div>
<style type="text/css">
    cobrototal{ font-size: 25px;
        
    }
</style>
