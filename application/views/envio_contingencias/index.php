<script src="<?php echo base_url('resources/js/envio_contingencias.js'); ?>" type="text/javascript"></script>
<!----------------------------- script buscador --------------------------------------->
<script type="text/javascript">
    /*window.onload = function() {
        buscar_ventas()
  //funciones a ejecutar
    };*/
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
    $(document).ready(function(){
        $("#precio_unitario").change(function(){
            var cantidad = $("#cantidad_id").val();
            var precio = $("#precio_unitario").val();
            var res = 0;
            res = cantidad * precio;
            $('#precio_subtotal').val(res);
        });
  });
  
</script>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->    
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="hidden" name="all_usuario" id="all_usuario" value='<?php echo json_encode($usuario); ?>' />
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro['moneda_descripcion']; ?>" name="parametro_moneda_descripcion"  hidden>
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro['moneda_id']; ?>" name="parametro_moneda_id"  hidden>
<input type="text" id="moneda_descripcion" value="<?php echo $moneda['moneda_descripcion']; ?>" hidden>
<input type="text" id="moneda_tc" value="<?php echo $moneda['moneda_tc']; ?>" hidden>

<div class="box-header no-print">
<h3 class="box-title">Envio de Contingencias</h3>
            	<div class="box-tools">
                    <?php if($rolusuario[23-1]['rolusuario_asignado'] == 1){ ?>
                    <select  class="btn btn-facebook btn-sm " id="usuario_id" onchange="tabla_ventas()">
                                <option value="0">-- TODOS --</option>
                            <?php foreach($usuario as $us){?>
                                <option value="<?php echo $us['usuario_id']; ?>"><?php echo $us['usuario_nombre']; ?></option>
                            <?php } ?>
                        </select>
                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalpaquetes" title="Solicitudd ede recepcion de paquete" target="_BLANK"><span class="fa fa-chain-broken"></span> Solicitud servicio recepción</a>
                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalvalidacion" title="Validacion dee paquetes" target="_BLANK"><span class="fa fa-chain-broken"></span> Validación ded paquetes</a>
                    <?php } ?>
                </div>
</div>
<!---------------------------------- panel oculto para busqueda--------------------------------------------------------->
<!--<form method="post">-->
<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='display:none;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>
        
        <div class="col-md-2">
            Tipo:             
            <select  class="btn btn-warning btn-sm form-control" id="estado_id" required="true">
                <?php foreach($estado as $es){?>
                    <option value="<?php echo $es['estado_id']; ?>"><?php echo $es['estado_descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-md-2">
            Usuario:             
            <select  class="btn btn-warning btn-sm form-control" id="usuario_id">
                    <option value="0">-- TODOS --</option>
                <?php foreach($usuario as $us){?>
                    <option value="<?php echo $us['usuario_id']; ?>"><?php echo $us['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <br>
        <div class="col-md-3">

            <button class="btn btn-sm btn-facebook btn-sm btn-block"   onclick="ventas_por_fecha()">
                <h4>
                <span class="fa fa-search"></span>   Buscar
                </h4>
            </button>
            
            <br>
        </div>
        
    </center>    
    <br>    
</div>
<!--</form>-->
<!------------------------------------------------------------------------------------------->

  

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
            <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" onkeypress="validar(event,10)" class="form-control" placeholder="Ingrese usuario, cliente, fecha">
            </div>
        <!--------------------- fin parametro de buscador --------------------->
            
<!--------------------- inicio loader ------------------------->
<div class="row" id='oculto' style='display:block;'>
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
            
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Totales</th>						
                        <th>Trans.</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th><label><input type="checkbox" id="select_all" onclick="seleccionar_todo(this)" checked="">Seleccionar Todo</label></th>

                    </tr>

                    <tbody class="buscar" id="tabla_ventas">

                    </tbody>
                </table>
<!--                <div class="pull-right">
                    
                    
                </div>                -->
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- EMISION DE PAQUETES ----------------------------------->
<!------------------------------------------------------------------------------->

<div class="modal fade" id="modalpaquetes" tabindex="-1" role="dialog" aria-labelledby="modalpaquetes" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">SOLICITUD SERVICIO RECEPCION PAQUETE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="row" id='loader2'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    <label for="codigo_evento" class="control-label"><span class="text-danger">*</span>Código Evento</label>
<!--                    <div class="form-group">
                        <input type="text" name="codigo_evento" class="form-control" id="codigo_evento" />
                    </div>
                    -->
                    <select name="codigo_evento" class="form-control" id="codigo_evento" >
                        <?php 
                            foreach($eventos as $evento){ ?>
                                <option value="<?php echo $evento['registroeventos_codigo']; ?>">    
                                    <?php echo $evento['registroeventos_codigo']." [".$evento['registroeventos_puntodeventa']."] ".$evento['registroeventos_detalle']." ".$evento['registroeventos_inicio']; ?>
                                </option>
                        <?php    } ?>
                            
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Nombre Archivo</label>
                    <div class="form-group">
                        <input type="text" name="nombre_archivo" value="compra_venta00.tar.gz" class="form-control" id="nombre_archivo" />
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="emision_paquetes()"><fa class="fa fa-floppy-o"></fa> Recepcion de Paquetes</button>
                <button type="button" class="btn btn-danger" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="modalvalidacion" tabindex="-1" role="dialog" aria-labelledby="modalvalidacion" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">SOLICITUD SERVICIO VALIDACION RECEPCION PAQUETE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader3' style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                
                <div class="col-md-12">
                    <label for="codigo_recepcion" class="control-label"><span class="text-danger">*</span>Codigo Recepción</label>
                    <div class="form-group">
                        <input type="text" name="codigo_recepcion" class="form-control" id="codigo_recepcion" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-facebook" onclick="emisionpaquetes_vacio()"><fa class="fa fa-floppy-o"></fa> Validación de Paquetes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!------------------------ INICIO modal para envio de facturas a correos ------------------->
<div class="modal fade" id="modal_enviofactura" tabindex="-1" role="dialog" aria-labelledby="modal_enviofacturalabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">ENVIAR FACTURA POR CORREO</span>
            </div>
            <div class="modal-body">
                
              <div class="col-md-12">
                    <label for="elcorreo" class="control-label"><span class="text-danger">*</span>Correo</label>
                    <div class="form-group">
                        <input type="email" name="elcorreo" class="form-control" id="elcorreo" />
                        <input type="hidden" name="lafactura" class="form-control" id="lafactura" /> 
                        <input type="hidden" name="laventa" class="form-control" id="laventa" /> 
                    </div>
                </div>  
                
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="enviarfactura_porcorreo()"><span class="fa fa-envelope"></span> Enviar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para envio de facturas a correos ------------------->