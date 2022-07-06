<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
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

<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<div class="box-header" style="padding-left: 0px">
    <font size='4' face='Arial'><b>Puntos de Venta</b></font>
    <!--<br><font size='2' face='Arial'>Registros Encontrados: <span id="encontrados">0</span></font>-->
    <!--<div class="box-tools no-print">
        <a href="<?php //echo site_url('token/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Token</a> 
    </div>-->
</div>

<div class="box-header">
    <!--<h3 class="box-title">Dosificación</h3>-->
    <!--<button class="btn btn-info btn-xs" onclick="verificarComunicacion()"><fa class="fa fa-chain"></fa> Verificar Conexión</button>-->
    <!--<a class="btn btn-danger btn-xs" onclick="registroFirmaRevocada()"><fa class="fa fa-chain-broken"></fa> Firma Rebocada</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="cierre_OperacionesSistema()"><fa class="fa fa-briefcase"></fa> Cierre de Operaciones</a>-->
    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventa()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="consulta_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Puntos de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="cierre_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Cierre Punto de Venta</a>
    <!--<a class="btn btn-warning btn-xs" onclick="consulta_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Evento Significativo</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="registro_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Registro de Evento Significativo</a>-->
    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventacomisionista()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta Comisionista</a>
    
</div>
<!--
<div class="row no-print">
    <div class="col-md-5">
        <div class="input-group">
            <span class="input-group-addon"> Buscar </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el token, fecha, estado..." onkeypress="buscar_token(event)" autocomplete="off">
            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultadostoken(2)" title="Buscar"><span class="fa fa-search"></span></div>
            <div style="border-color: #d58512; background: #e08e0b !important; color: white" class="btn btn-warning input-group-addon" onclick="tablaresultadostoken(3)" title="Mostrar todos los tokens"><span class="fa fa-globe"></span></div>
        </div>
    </div>
     <div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php //echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
</div>
<!--
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
                    <thead>
                        <tr role="row">
                            <th >#</th>
                            <th>Token Delegado</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados"></tbody>
                </table>
            </div>             
        </div>
    </div>
</div>
-->

