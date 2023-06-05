<script src="<?php echo base_url('resources/js/reporte_usuariodia.js'); ?>" type="text/javascript"></script>

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="text" value="" id="parametro" hidden>
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="mostrarmoneda" id="mostrarmoneda" value="<?php echo $parametro['parametro_mostrarmoneda']; ?>" />
<input type="hidden" name="decimales" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" />
<!--<input type="hidden" name="select_tipo" id="select_tipo" value='line' />-->

<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='display:block;'>
    <br>
    <!--<center>
        <div class="col-md-2">
            Mes: 
            <?php 
                /*$mes_actual = date("m");
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
            <?php }*/ ?>
        </select>
    </div>-->
    <div class="col-md-2">
        Desde:
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="btn btn-warning btn-sm form-control" value="<?php echo date("Y-m-d"); ?>">
    </div>
    <div class="col-md-2">
        Hasta:
        <input type="date" name="fecha_fin" id="fecha_fin" class="btn btn-warning btn-sm form-control" value="<?php echo date("Y-m-d"); ?>">
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
    <div class="col-md-2 hidden">
        Reporte:
        <select class="btn btn-warning btn-sm form-control" id="lautilidad" name="lautilidad">
            <option value="1">CON UTILIDAD</option>
            <option value="2" selected>SIN UTILIDAD</option>
        </select>
    </div>
    <div class="col-md-2">
        &nbsp; 
        <button class="btn btn-success  form-control" onclick="buscar_ventas()"><fa class="fa fa-binoculars"></fa> Buscar</button>
    </div>
    <div class="col-md-2">
        &nbsp; 
        <a class="btn btn-facebook  form-control" onclick="imprimir()"><fa class="fa fa-print"></fa> Imprimir</a>
    </div>
</div>
<div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
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
                        <th style="padding:0;">Ventas (<?php echo $parametro['moneda_descripcion']; ?>)</th>
                        <th style="padding:0; display: none" id="mostrar_columna1">Ventas (<?php
                            if($parametro["moneda_id"] == 1){
                                echo $lamoneda[1]['moneda_descripcion'];
                            }else{
                                echo $lamoneda[0]['moneda_descripcion'];
                            }
                        ?>)
                        </th>
                        <th style="padding:0; display: none" id="mostrar_columna">Utilidades (<?php echo $parametro['moneda_descripcion']; ?>)</th>
                        <th style="padding:0;">Zona</th>
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