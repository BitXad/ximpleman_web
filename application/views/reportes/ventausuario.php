<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/reporte_vusuario.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="empresa_nombre" id="empresa_nombre" value="<?php echo $empresa[0]['empresa_nombre']; ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" />
<input type="hidden" name="resproducto" id="resproducto" />
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="cuerpo">
    <div class="columna_derecha">
        <center> 
            <img src="<?php echo base_url('resources/images/empresas/'.$empresa[0]["empresa_imagen"].''); ?>"  style="width:80px;height:80px">
        </center>
    </div>
    <div class="columna_izquierda">
       <center>  <font size="4"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
            <?php echo $empresa[0]['empresa_zona']; ?><br>
            <?php echo $empresa[0]['empresa_direccion']; ?><br>
            <?php echo $empresa[0]['empresa_telefono']; ?>
         </center>
    </div>
    <div class="columna_central">
        <center>
            <h3 class="box-title"><u>VENTAS POR USUARIO</u></h3>
            <?php echo date('d/m/Y H:i:s'); ?><br>
            <b>VENTAS REALIZADAS</b>
        </center>
    </div>
</div>
<div class="row no-print" >
    <div class="col-md-3">
        <label>Desde:</label>
        <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
    </div> 
    <div class="col-md-3">
        <label>Hasta:</label>
        <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
    </div>
    <div class="col-md-1">
        <label>&nbsp;</label>
        <a class="btn btn-facebook btn-sm form-control" title="Buscar ventas por usuario" onclick="mostrar_grafica()"><i class="fa fa-search"> Buscar</i></a>
    </div>
    <div class="col-md-1">
            <label for="imprimir" class="control-label"> &nbsp; </label>
           <div class="form-group">
               <button onclick="imprimir()" type="button" class="btn btn-success btn-xs form-control" ><span class="fa fa-print"> </span> Imprimir</button>
            </div>
        </div>
        <div class="col-md-2">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
               <button onclick="generarexcel_vusuario()" type="button" class="btn btn-danger btn-xs form-control" title="Buscar venta por usuarios" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>
            </div>
        </div>
</div>
<?php if($tipousuario_id == 1){ $tamanio = "class='col-md-6'"; } else{ $tamanio = "class='col-md-12'"; } ?>
<div <?php echo $tamanio; ?>>
    <div class="row" id="graficapastel" style="display: none">
        <br/>
        <br/>
        <div class="box box-primary">
            <div class="box-header"></div>
            <div class="box-body div_grafica_pie" id="div_grafica_pie"></div>
            <div class="box-footer"></div>
        </div>
    </div>
</div>
<?php if($tipousuario_id == 1){ ?>
<div class="col-md-6">
    <div class="row" id="graficapastelu" style="display: none">
        <br/>
        <br/>
        <div class="box box-primary">
            <div class="box-header"></div>
            <div class="box-body div_grafica_pieu" id="div_grafica_pieu"></div>
            <div class="box-footer"></div>
        </div>
    </div>
</div>
<?php } ?>
<div class="row" >
    <span id="desde"></span>
    <span id="hasta"></span>
    <span id="lacategoria"></span>
    <!--<div id="labusqueda"></div>-->
    <!--<span id="tipotrans"></span>-->
    <!--<span id="esteusuario"></span>-->
    <!--<span id="ventaprev"></span>-->
</div>
<div class="row no-print" id='loader'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
    </center>
</div>
<div class="box" style="padding: 0;">
    <div class="box-body table-responsive" >
        <table class="table table-striped table-condensed" id="mitabla" >
            <tr>
                <th>Nro.</th>
                <th>USUARIO</th>
                <th>VENTAS</th>
                <?php if($tipousuario_id == 1){ ?>
                <th>COSTO</th>
                <th>UTILIDAD</th>
                <?php } ?>
            </tr>
            <tbody class="buscar" id="reportefechadeventa"></tbody>
        </table>
    </div>
</div>
<center>
    <ul style="margin-bottom: -5px;margin-top: 35px;" >--------------------------------</ul>
    <ul style="margin-bottom: -5px;">RESPONSABLE</ul><ul>FIRMA - SELLO</ul>
</center>

