<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/reporte_ventacategoria_pagrupado.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
        /*$(document).ready(function () {
            (function ($) {
                $('#vender').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
        */
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
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>">
<input type="hidden" name="resproducto" id="resproducto" />
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="decimales" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" />
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
            <h3 class="box-title"><u>VENTAS DE PRODUCTOS AGRUPADOS POR CATEGORIAS</u></h3>
            <?php echo date('d/m/Y H:i:s'); ?><br>
            <b>VENTAS REALIZADAS</b>
        </center>
    </div>
</div>
<div class="row" >
    <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' >
        <div class="col-md-2">
            Desde: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
        </div> 
        <div class="col-md-2">
            Hasta: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
        </div>
        <div class="col-md-2">
            Categoria:
            <select id="categoria_id" name="categoria_id" class="btn btn-primary btn-sm form-control"  >
                <option value="0">-TODOS-</option>
                <?php
                    foreach($all_categoria as $categoria){ ?>
                        <option value="<?php echo $categoria['categoria_id']; ?>"><?php echo $categoria['categoria_nombre']; ?></option>                                                   
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2 no-print">
            &nbsp;
           <div class="form-group">
                <a class="btn btn-facebook btn-sm form-control" onclick="tabla_reportescatproducto()" title="Buscar productos agrupados"><i class="fa fa-search"> </i> Buscar</a>
            </div>
        </div>
        <div class="col-md-2 no-print">
            &nbsp;
           <div class="form-group">
                <a onclick="imprimir()" class="btn btn-success btn-sm form-control" ><i class="fa fa-print"> </i> Imprimir</a>
            </div>
        </div>
        <div class="col-md-1 no-print">
            &nbsp;
           <div class="form-group">
                <a onclick="generarexcel_vagrupado_porcategoria()" class="btn btn-danger btn-sm form-control" ><span class="fa fa-file-excel-o"> </span> Excel</a>
            </div>
        </div>
    </div>
    <span id="desde"></span>
    <span id="hasta"></span>
    <div id="labusqueda"></div>
    <span id="la_categoria"></span>
    <!--<span id="esteusuario"></span>
    <span id="ventaprev"></span>-->
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
                <th>PRODUCTO</th>
                <th>UNIDAD</th>
                <th>CANT.</th>
                <th>PRECIO<br>UNIT.(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <th>DESC(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <th>PRECIO<br>TOTAL(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                <th>PRECIO<br>TOTAL(<?php
                                        if($parametro["moneda_id"] == 1){
                                            echo $lamoneda[1]['moneda_descripcion'];
                                        }else{
                                            echo $lamoneda[0]['moneda_descripcion'];
                                        }
                                    ?>)
                </th>
                <?php if($tipousuario_id == 1){ ?>
                    <th>COSTO<br>TOTAL(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                    <th>UTILID.(<?php echo $parametro['moneda_descripcion']; ?>)</th>
                    <th>%</th>
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
    

<!-------------------- FIN CATEGORIAS--------------------------------->
                                
          
  

