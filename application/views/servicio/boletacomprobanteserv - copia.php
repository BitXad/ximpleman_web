<style type="text/css">
@page{
    margin-top: 0mm;
    margin-left: 0mm;
    margin-right: 0mm;
}
body {
    font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
}
    #derechatabla {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}
#izquierdatabla {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 9px;
}    

</style>
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
 <div class="col-md-12">
    <div class="row">
    <div style="width: 100%;overflow-x:hidden;overflow-y:auto;">
        <div style="float:left; width:22%; padding-right: 15px">
            <div style="font-family: 'Arial', Arial, Arial, arial; font-size: 9pt; text-align: center;"> 
                <div>
                    <b>SERVICIO TÉCNICO<br>Nro.: <?php echo "00".$servicio['servicio_id']; ?></b>
                </div>
            </div>
            <hr style="border-color: black; margin-top: 0px; margin-bottom: 3px">
            <div style="text-align: center; font-size: 7pt;">
                <b><?php echo $cliente['cliente_nombre'];?></b>
                <b><?php echo $cliente['cliente_telefono']." ".$cliente['cliente_celular'];?></b>
            </div>
            <div style=" font-size: 7pt; line-height: 12px">
            <?php
            $cant = 0;
            $separador = "|";
            $descripcion = "";
            $falla_segcliente = "";
            $diagnostico = "";
            $solucion = "";
            $fentrega_aprox = "";
            $responsable = "";
            $tamcad = count($detalle_serv)."";
            foreach ($detalle_serv as $detalle){
                if($cant == $tamcad || $cant == 0){
                    $separador = "";
                } else {
                    $separador = "<span style='font-size: 8px'><b> | </b></span>";
                }
                $descripcion = $detalle['detalleserv_descripcion'].$separador.$descripcion;
                $falla_segcliente = $detalle['detalleserv_falla'].$separador.$falla_segcliente;
                $diagnostico = $detalle['detalleserv_diagnostico'].$separador.$diagnostico;
                $solucion = $detalle['detalleserv_solucion'].$separador.$solucion;
                $fentrega_aprox = date("d/m/Y", strtotime($detalle['detalleserv_fechaentrega']))."-".$detalle['detalleserv_horaentrega'].$separador.$fentrega_aprox;
                $responsable = $detalle['respusuario_nombre'].$separador.$responsable
            ?>
            <?php
             $cant++; }
            ?>
            <b>CANT.: </b><?php echo $cant; ?>&nbsp;&nbsp;
            <b>DESCRIPCIÓN: </b><?php echo $descripcion; ?><br>
            <b><u>FALLA:</u> </b><?php echo $falla_segcliente; ?><br>
            <b><u>DIAGNOSTICO:</u> </b><?php echo $diagnostico; ?><br>
            <b><u>SOLUCION:</u> </b><?php echo $solucion; ?><br>
            <b>FECHA ENTREGA APROX.: </b><?php echo $fentrega_aprox; ?><br>
            <b>RESPONSABLE TÉCNICO: </b><?php echo $responsable; ?><br>
        </div>
        <hr style="border-color: black; margin-top: 0px; margin-bottom: 1px">
                    <table id="derechatabla" style="font-weight: bold; font-size: 7pt">
                        <tr>
                            <td style="text-align: right;">TOTAL:</td>
                            <td style="text-align: right;"> <?php echo number_format($servicio['servicio_total'],2); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">A CUENTA:</td>
                            <td style="text-align: right;"><?php echo number_format($servicio['servicio_acuenta'], 2); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">SALDO:</td>
                            <td style="text-align: right;"><?php echo number_format($servicio['servicio_saldo'], 2); ?></td>
                        </tr>         
                    </table>
        <div style="font-size: 7pt">
            TIPO SERV.:<?php echo $tipo_servicio['tiposerv_descripcion']; ?><br>
            <?php echo date("d/m/Y h:i:s a"); ?>
        </div>
        </div>
        <div style="float:right; width:78%; padding-left: 8px">
            <div class="cuerpo" style="display: flex; width: 100%">
                <div style="padding-left: 9px; width: 35%">
                   <div style="font-family: 'Arial', Arial, Arial, arial; font-size: 10px; text-align: center;"> 
                       <font size="1"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                    <?php echo $empresa[0]['empresa_zona']; ?><br>
                    <?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <?php echo $empresa[0]['empresa_telefono']; ?>
                    </div>
                </div>
                <div style="text-align: center; width: 40%">
                    <h4 class="box-title" style="margin-top: 0px; margin-bottom: 0px;">
                        <b>ORDEN DE SERVICIO TÉCNICO<br>Nro.:  <?php echo "00".$servicio['servicio_id']; ?></b></h4>
                    <!--<font size="2"><b>Nro.:  <?php //echo "00".$servicio['servicio_id']; ?></b></font>-->
                    <span><?php echo date("d/m/Y h:i:s a"); ?></span><br>
                    <b>ESTADO: <?php echo $servicio['estado_descripcion']; ?></b>
                </div>
                <div style=" width: 25%; text-align: right">
                    <div style="padding-top: 53px; width: 100%"><b>TIPO SERV.: </b><?php echo $tipo_servicio['tiposerv_descripcion']; ?></div>
                </div>
            </div>
            <hr style="border-color: black; margin: 0px;">
            <div style=" display: flex;">
                <div  style="width: 70%; margin-left: 60px;">
                    <b>FECHA: </b><?php echo date("d/m/Y", strtotime($servicio['servicio_fecharecepcion']))."&nbsp; - &nbsp;".$servicio['servicio_horarecepcion'];;?><br>
                    <b>CODIGO: </b><?php echo $cliente['cliente_codigo'];?><br>
                    <b>CLIENTE: </b><?php echo $cliente['cliente_nombre'];?>
                </div>
                <div style="width: 30%; display: flex-end">
                    <table id="derechatabla" style="font-weight: bold;">
                        <tr>
                            <td style="text-align: right;">TOTAL:</td>
                            <td style="text-align: right;"> <?php echo number_format($servicio['servicio_total'],2); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">A CUENTA:</td>
                            <td style="text-align: right;"><?php echo number_format($servicio['servicio_acuenta'], 2); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">SALDO:</td>
                            <td style="text-align: right;"><?php echo number_format($servicio['servicio_saldo'], 2); ?></td>
                        </tr>         
                    </table>
                </div>
            </div>
            <hr style="border-color: black; margin-top: 2px; margin-bottom: 2px">
            <div style="float: right">
                
            </div><br>
            <hr style="border-color: black; margin-top: 2px; margin-bottom: 2px">
            <div>
            <?php
            $cant = 0;
            $separador = "|";
            $descripcion = "";
            $falla_segcliente = "";
            $diagnostico = "";
            $solucion = "";
            $fentrega_aprox = "";
            $responsable = "";
            $tamcad = count($detalle_serv)."";
            foreach ($detalle_serv as $detalle){
                if($cant == $tamcad || $cant == 0){
                    $separador = "";
                } else {
                    $separador = "<span style='font-size: 12px'><b> | </b></span>";
                }
                $descripcion = $detalle['detalleserv_descripcion'].$separador.$descripcion;
                $falla_segcliente = $detalle['detalleserv_falla'].$separador.$falla_segcliente;
                $diagnostico = $detalle['detalleserv_diagnostico'].$separador.$diagnostico;
                $solucion = $detalle['detalleserv_solucion'].$separador.$solucion;
                $fentrega_aprox = date("d/m/Y", strtotime($detalle['detalleserv_fechaentrega']))."-".$detalle['detalleserv_horaentrega'].$separador.$fentrega_aprox;
                $responsable = $detalle['respusuario_nombre'].$separador.$responsable
            ?>
            <?php
             $cant++; }
            ?>
            <b>CANT.: </b><?php echo $cant; ?><br>
            <b>DESCRIPCIÓN: </b><?php echo $descripcion; ?><br>
            <b>FALLA SEGUN CLIENTE: </b><?php echo $falla_segcliente; ?><br>
            <b>DIAGNOSTICO: </b><?php echo $diagnostico; ?><br>
            <b>SOLUCION: </b><?php echo $solucion; ?><br>
            <b>FECHA ENTREGA APROX.: </b><?php echo $fentrega_aprox; ?><br>
            <b>RESPONSABLE TÉCNICO: </b><?php echo $responsable; ?><br>
        </div>
            <span><img src="<?php echo $codigoqr; ?>" width="100" height="100" style="margin-left: 400px; margin-top: -115px"></span>
        <hr style="border-color: black; margin: 1px">
        <div style="width: 100%; background-color: #e5e3e3; font-size: 5pt;">
            <?php echo $dosificacion5['dosificacion_leyenda5']; ?>
        </div><br>
        <div style="width: 100%;">
            <div class="columna_izquierda" style="text-align: center">
                <?php echo $usuario; ?><br>
                DPTO. TECNICO
            </div>
            <div class="columna_central">
            </div>
            <div class="columna_derecha" style="text-align: center">
                CLIENTE<br>
                <?php echo $cliente['cliente_nombre']; ?>
            </div>
        </div>
        <div style="display: flex; font-size: 8pt; width: 100%">
            <div style="width: 30%">
            </div>
            <div style="width: 30%">
                <?php echo $dosificacion3['dosificacion_leyenda3']; ?>
            </div>
            <div style="width: 45%">
                CCA: SIS.INF.<?php echo $empresa[0]['empresa_nombre']; ?> | <?php echo date("d/m/Y - h:i:s a"); ?>
            </div>
        </div>
        
        
        
        
        
        
        
        </div>
    </div>
    
    </div>
</div>


    
      
  
    
