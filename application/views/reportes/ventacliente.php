<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/reporte_ventacliente.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $('#cliente_id').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
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
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
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
            <h3 class="box-title"><u>VENTAS POR CLIENTE</u></h3>
            <?php echo date('d/m/Y H:i:s'); ?><br>
            <b>VENTAS REALIZADAS</b>
        </center>
    </div>
</div>
<div class="row" >
    <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto'>
        <div class="col-md-3">
            Desde: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
        </div> 
        <div class="col-md-3">
            Hasta: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
        </div>
        <div class="col-md-2">
            Tipo Trans.:
            <select id="tipo_transaccion" name="tipo_transaccion" class="btn btn-primary btn-sm form-control"  >
                <option value="0">-TODOS-</option>
                <?php
                    foreach($all_tipo_transaccion as $tipo){ ?>
                        <option value="<?php echo $tipo['tipotrans_id']; ?>"><?php echo $tipo['tipotrans_nombre']; ?></option>                                                   
                <?php } ?>
             </select>
        </div>
        <div class="col-md-2">
            Usuario:
            <select id="usuario_id" name="usuario_id" class="btn btn-primary btn-sm form-control"  >
                <option value="0">-TODOS-</option>
                <?php
                    foreach($all_usuario as $usuario){ ?>
                        <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>                                                   
                <?php } ?>
             </select>
        </div>
        <div class="col-md-2">
            Venta/Preventa:
            <select id="esventa_preventa" name="esventa_preventa" class="btn btn-primary btn-sm form-control"  >
                <!--<option value="0">-TODOS-</option>-->
                <option value="1"> VENTA </option>
                <option value="2"> PREVENTA </option>
             </select>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
            <div class="form-group">
                <a data-toggle="modal" data-target="#modalbuscarcliente" class="btn btn-facebook btn-sm form-control" title="Buscar cliente"><i class="fa fa-search"> Buscar</i></a>
            </div>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="imprimir()" class="btn btn-success btn-sm form-control"><i class="fa fa-print"> Imprimir</i></a>
            </div>
        </div>
        <div class="col-md-2 no-print">
            <label for="expotar" class="control-label"> &nbsp; </label>
           <div class="form-group">
                <a onclick="generarexcel_vcliente()" class="btn btn-danger btn-sm form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</a>
            </div>
        </div>
        <div id="tablas" style="visibility: block">  
            <div class="col-md-6 no-print" id="tablareproducto"></div>
            
            <!--<div class="col-md-6 no-print" id="tablareproveedor"></div>-->
            <!--<input id="producto" type="hidden" class="form-control" >-->
            <input id="cliente" type="hidden" class="form-control" > 
            <!--<input id="proveedor" type="hidden" class="form-control" >--> 
        </div>
    </div>
    <span id="desde"></span>
    <span id="hasta"></span>
    <div id="labusqueda"></div>
    <span id="tipotrans"></span>
    <span id="esteusuario"></span>
    <span id="ventaprev"></span>
</div>
<div class="row no-print" id='loader'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
    </center>
</div
<div class="box" style="padding: 0;">
    <div class="box-body table-responsive" >
        <table class="table table-striped table-condensed" id="mitabla" >
            <tr>
                <th>Nro.</th>
                <th>PRODUCTO</th>
                <th>FECHA<br>VENTA</th>
                <th>NUM.<br>VENTA</th>
                <th>NUM.<br>DOC.</th>
                <th>TIPO<br>VENTA</th>
                <th>CUOTA<br>INIC.(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <th>UNIDAD</th>
                <th>CANT.</th>
                <th>PRECIO<br>UNIT.(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <th>DESC(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <th>PRECIO<br>TOTAL(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <th>PRECIO<br>TOTAL(<?php
                                        if($parametro[0]["moneda_id"] == 1){
                                            echo $lamoneda[1]['moneda_descripcion'];
                                        }else{
                                            echo $lamoneda[0]['moneda_descripcion'];
                                        }
                                    ?>)
                </th>
                <?php if($tipousuario_id == 1){ ?>
                <th>COSTO<br>(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <th>UTILID.<br>(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                <?php } ?>
                <th>CLIENTE</th>
                <th>CAJERO</th>
                <th class="no-print"></th>
            </tr>
            <tbody class="buscar" id="reportefechadeventa"></tbody>
        </table>
    </div>
    <center>
        <ul style="margin-bottom: -5px;margin-top: 35px;" >--------------------------------</ul>
        <ul style="margin-bottom: -5px;">RESPONSABLE</ul><ul>FIRMA - SELLO</ul>
    </center>
<!-------------------- FIN CATEGORIAS--------------------------------->

<!------------------------ INICIO modal para Seleccionar a un cliente ------------------->
<div class="modal fade" id="modalbuscarcliente" tabindex="-1" role="dialog" aria-labelledby="modalbuscarclientelabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Buscar Cliente</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Buscar </span>
                        <input id="cliente_id" type="text" class="form-control" placeholder="Ingresa el nombre del cliente, nit o razon social"  onkeypress="ventacliente(event)" autofocus>
                        <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablarecliente()"><span class="fa fa-search"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <!------------------------------------------------------------------->
                <div class="col-md-12 no-print" id="tablarecliente"></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer aligncenter">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar a un cliente ------------------->

