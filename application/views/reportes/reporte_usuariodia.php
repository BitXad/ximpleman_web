<script src="<?php echo base_url('resources/js/reporte_usuariodia.js'); ?>" type="text/javascript"></script>
<!--<script type="text/javascript">
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
</script>-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!--
<input type="text" id="parametro_modoventas" value="<?php /*echo $parametro[0]['parametro_modoventas']; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro[0]['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro[0]['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro[0]['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro[0]['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro[0]['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro[0]['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro[0]['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>

<input type="text" id="rol_precioventa" value="<?php echo $rolusuario[160-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor" value="<?php echo $rolusuario[161-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor1" value="<?php echo $rolusuario[162-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor2" value="<?php echo $rolusuario[163-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor3" value="<?php echo $rolusuario[164-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor4" value="<?php echo $rolusuario[165-1]['rolusuario_asignado'];*/ ?>" hidden>
-->
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="text" value="" id="parametro" hidden>
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="select_tipo" id="select_tipo" value='line' />

<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='display:block;'>
    <br>
    <center>
        <div class="col-md-2">
            Mes: 
            <?php 
                $mes_actual = date("m");
                $anio_actual = date("Y");
            ?>
            <select  class="btn btn-warning btn-sm form-control" id="select_mes">
                <?php
                    $mes = array(1 => "ENERO",2 => "FEBRERO", 3 => "MARZO",4 => "ABRIL",5 => "MAYO",6 => "JUNIO",
                                   7 => "JULIO", 8 => "AGOSTO", 9 => "SEPTIEMBRE", 10 => "OCTUBRE", 11 => "NOVIEMBRE", 12 => "DICIEMBRE");
                    for($i = 1;$i<=12;$i++){ ?>
                        <option value="<?php echo $i; ?>" <?php if ($i == $mes_actual){ echo "selected";} ?> ><?php echo $mes[$i]; ?></option>
                <?php } ?>
            </select>
        </div>
    </center>
    <div class="col-md-2">
        Año: 
        <select  class="btn btn-warning btn-sm form-control" id="select_anio">
            <?php
                for($i = 2015;$i<=2060;$i++){ ?>
            <option value="<?php echo $i; ?>" <?php if ($i == $anio_actual){ echo "selected";} ?>> <?php echo $i; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
        Usuario:
        <select class="btn btn-warning btn-sm form-control" id="usuario_id" name="usuario_id">
            <?php 
            foreach($all_usuario as $usuario)
            {
                //$selected = ($usuario['usuario_id'] == $usuario['usuario_id']) ? ' selected="selected"' : "";
                echo '<option value="'.$usuario['usuario_id'].'">'.$usuario['usuario_nombre'].'</option>';
            } 
            ?>
        </select>
    </div>
    <div class="col-md-2">
        Zona:
        <select class="btn btn-warning btn-sm form-control" id="zona_id" name="zona_id">
            <option value="0">-- TODAS --</option>
            <?php 
            foreach($all_zona as $zona)
            {
                //$selected = ($usuario['usuario_id'] == $usuario['usuario_id']) ? ' selected="selected"' : "";
                echo '<option value="'.$zona['zona_id'].'">'.$zona['zona_nombre'].'</option>';
            } 
            ?>
        </select>
    </div>
    <!--<div class="col-md-2">
        Tipo Gráfico: 
        <select  class="btn btn-warning btn-sm form-control" id="select_tipo">
            <option value="bar" selected> BARRAS</option>
            <option value="column" selected> COLUMNAS</option>
            <option value="area" selected> AREAS</option>
            <option value="line" selected> LINEAS</option>
        </select>
    </div>-->
    <div class="col-md-2">
        Buscar: 
        <button class="btn btn-success  form-control" onclick="grafico_ventas()"><fa class="fa fa-binoculars"></fa> Buscar</button>
    </div>
</div>
<!------------------------------------------------------------------------------------------->

<div class="panel panel-primary col-md-12">
    <div class="row">
        <div class="col-md-12">
            <!--------------------- inicio loader ------------------------->
            <div class="row" id='oculto' style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                </center>
            </div>
            <div class="row" id='oculto2' style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                </center>
            </div> 
            <!--------------------- fin inicio loader ------------------------->
        </div>
    </div>
    <div class="box">
        <div class="col-md-3">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th style="padding:0;">Fecha</th>
                        <th style="padding:0;">Ventas (<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                        <th style="padding:0;">Ventas (<?php
                            if($parametro[0]["moneda_id"] == 1){
                                echo $lamoneda[1]['moneda_descripcion'];
                            }else{
                                echo $lamoneda[0]['moneda_descripcion'];
                            }
                        ?>)
                        </th>
                        <th style="padding:0;">Utilidades (<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>						
                    </tr>
                    <tbody class="buscar" id="tabla_ventas"></tbody>
                </table>
            </div>
        </div>
        <div class="col-md-9">            
            <div class="box-body" id="div_grafica_barras"></div>
            <div id="tabla_estadistica"></div>
        </div>
    </div>
</div>