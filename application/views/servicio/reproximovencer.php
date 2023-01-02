<script type="text/javascript">
    function imprimir()
    {
        window.print(); 
    }
</script>
<style type="text/css">
 @page { 
        size: landscape;
    }
     
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      //$margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];;
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>

<table class="table" >
    <tr>
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>"></td>
        <td style="padding: 0;">
            <div style="width: <?php echo $ancho;?>">
                <div class="cuerpo">
                    <div class="columna_derecha">
                        <center> 
                        <img src="<?php echo base_url('resources/images/empresas/'.$empresa[0]["empresa_imagen"].''); ?>"  style="width:80px;height:80px">
                    </center>
                    </div>
                    <div class="columna_izquierda">
                        <center> 
                            <font size="4"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                            <?php echo $empresa[0]['empresa_zona']; ?><br>
                            <?php echo $empresa[0]['empresa_direccion']; ?><br>
                            <?php echo $empresa[0]['empresa_telefono']; ?>
                        </center>
                    </div>
                    <div class="columna_central">
                        <center>
                            <font class="box-title text-bold" style="font-size: 13pt">
                                SERVICIOS PROXIMOS A VENCER
                            </font><br>
                            <?php echo date('d/m/Y H:i:s'); ?><br>
                        </center>
                    </div>
                </div>
                <div class="text-center col-md-2 no-print">
                    <label for="expotar" class="control-label"> &nbsp; </label>
                    <div class="form-group">
                        <a onclick="imprimir()" class="btn btn-success btn-sm form-control"><i class="fa fa-print"> Imprimir</i></a>
                    </div>
                </div>
                <div class="row col-md-12 no-print" id='loader'  style='display:none;'>
                    <center>
                        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
                    </center>
                </div>
                <br>
                <br>
                <div class="col-md-12">
                    <table class="table table-striped table-condensed" id="mitabla">
                        <tr>
                            <th style="padding: 2px">#</th>
                            <th style="padding: 2px">Cliente</th>
                            <th style="padding: 2px">Codigo</th>
                            <th style="padding: 2px">Ingreso</th>
                            <th style="padding: 2px">Fecha a Entregar</th>
                            <th style="padding: 2px">Responsable</th>
                            <th style="padding: 2px">Estado</th>
                        </tr>
                        <?php
                        $i = 0;
                        //$costototal = 0;
                        foreach ($all_detservicio as $detservicio) {
                            $alerta ="#000";
                            $date_add = new DateTime(date($detservicio['detalleserv_fechaentrega']." ".$detservicio['detalleserv_horaentrega']));
                            $fecha_actual = new DateTime(date('Y-m-d H:i:s'));
                            $diff = $date_add->diff($fecha_actual);
                            
                            $time_elapsed = '';
                            
                            if ($diff->days > 0) {
                                $alerta = "#f55b18";
                            }

                            if ($diff->h >= 2) {
                                $alerta = "#f55b18";
                            }
                        ?>
                        <tr style="color: <?php echo $alerta; ?>">
                            <td style="padding: 2px" class="text-center"><?php echo $i+1; ?></td>
                            <td style="padding: 2px"><?php echo $detservicio['cliente_nombre']; ?></td>
                            <td style="padding: 2px" class="text-center"><?php echo $detservicio['servicio_id']; ?></td>
                            <td style="padding: 2px" class="text-center"><?php echo date("d/m/Y", strtotime($detservicio['servicio_fecharecepcion']))." ".$detservicio['servicio_horarecepcion']; ?></td>
                            <td style="padding: 2px" class="text-center"><?php echo date("d/m/Y", strtotime($detservicio['detalleserv_fechaentrega']))." ".$detservicio['detalleserv_horaentrega']; ?></td>
                            <td style="padding: 2px" class="text-center"><?php echo $detservicio['respnombre']; ?></td>
                            <td style="padding: 2px" class="text-center"><?php echo $detservicio['estado_descripcion']; ?></td>
                        </tr>
                        <?php
                        $i++;
                        }
                        ?>
                        <!--<tr>
                            <td style="padding: 2px; font-size: 10pt" class="text-bold text-right" colspan="2">Total:</td>
                            <td style="padding: 2px; font-size: 10pt" class="text-bold text-right"><?php echo number_format($costototal, 2, ".", ","); ?></td>
                        </tr>-->
                    </table>
                </div>
            </div>
        </td>
    </tr>
</table>