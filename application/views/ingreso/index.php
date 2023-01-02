<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/ingresos.js'); ?>" type="text/javascript"></script>
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
         function imprimir()
        {
           $("#cabeceraprint").css("display", "");
             window.print(); 
        }
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="row micontenedorep" style="display: none" id="cabeceraprint">
    <table class="table" style="width: 100%; padding: 0;" >
        <tr>
            <td style="width: 25%; padding: 0; line-height:10px;" >
                <center>
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php //echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php //echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php //echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php //echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                </center>
            </td>
            <td style="width: 35%; padding: 0" > 
                <center>
                    <br><br>
                    <font size="3" face="arial"><b>INGRESOS</b></font> <br>
                    <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>
                </center>
            </td>
            <td style="width: 20%; padding: 0" >
                <center></center>
            </td>
        </tr>
    </table>
</div>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
 <div class="col-md-8 no-print">
    <div class="box-header">
        <font size='4' face='Arial'><b>Ingresos</b></font>
        <br><font size='2' face='Arial' id="pillados"></font>
    </div>
    <div class="row">
        <div class="col-md-6 no-print">
            <!--------------------- parametro de buscador --------------------->
            <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción" onkeypress="buscaringreso(event)" autocomplete="off">
            </div>
            <!--------------------- fin parametro de buscador --------------------->
        </div>
        <div class="col-md-3 no-print">
            <div  class="box-tools" >
                <select  class="btn btn-primary btn-sm form-control" id="select_compra" onchange="buscar_ingresos()">
                    <option value="0">Elija Fechas</option>
                    <option value="1">Ingresos de Hoy</option>
                    <option value="2">Ingresos de Ayer</option>
                    <option value="3">Ingresos de la semana</option>                                                                                            
                    <option value="5">Ingresos por Fecha</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select name="categoria_id" id="categoria_id" class="btn btn-primary btn-sm form-control" onchange="buscar_ingresos()" >
                    <option value="0">- Todas -</option>
                    <?php 
                    foreach($all_categoria_ingreso as $categoria_ingreso)
                    {
                      $selected = ($categoria_ingreso['categoria_cating'] == $this->input->post('ingreso_categoria')) ? ' selected="selected"' : "";

                      echo '<option value="'.$categoria_ingreso['categoria_cating'].'" '.$selected.'>'.$categoria_ingreso['categoria_cating'].'</option>';
                    } 
                    ?>
                </select>
            </div>
        </div>
    </div>
 </div>
<div class="col-md-4 no-print">
    <div class="box-tools">
        <center>    
            <a href="<?php echo site_url('ingreso/add'); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-money"></span></font><br><small>Registrar Ingreso</small></a>
            <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="fechadeingreso(null)" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
            <a href="#" onclick="imprimir()" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
        </center>            
    </div>
</div>
<div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>
<div class="panel panel-primary col-md-12" id='buscador_oculto' style='display:none;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" value="<?php echo date("Y-m-d")?>" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" value="<?php echo date("Y-m-d")?>" required="true">
        </div>
        <div class="col-md-3">
            <?php if($rol[57-1]['rolusuario_asignado'] == 1){ ?>
            <button class="btn btn-sm btn-primary btn-sm btn-block"  onclick="buscar_por_fechas()">
                <h4>
                <span class="fa fa-search"></span>   Buscar Ingresos  
                </h4>
            </button>
            <?php } ?>
            <br>
        </div>
    </center>
    <br>    
</div>
<div class="col-md-12">         
    <div class="box">
        <div class="box-body table-responsive">
            <table class="table table-striped table-condensed" id="mitabla">     
                <tr>
                   <th>#</th>
                    <th>NOMBRE</th>
                    <th># RECIBO</th>
                    <th>FECHA</th>
                    <th>CONCEPTO</th>
                    <th>MONTO</th>
                    <th>MONEDA</th>
                    <th>FORMA DE PAGO</th>
                    <th>BANCO</th>
                    <th>USUARIO</th>
                    <th class="no-print"></th>

                </tr>
                <tbody class="buscar" id="fechadeingreso">
            </table>
        </div>
        <div class="pull-right">
            <?php echo $this->pagination->create_links(); ?>                    
        </div>                
    </div>
</div>