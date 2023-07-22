<script src="<?php echo base_url('resources/js/envio_contingencias.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/emision_paquetes.js'); ?>" type="text/javascript"></script>
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
<input type="hidden" name="cantidad_facturas" id="cantidad_facturas" value="0">

<div class="box-header no-print">
    <h3 class="box-title">Envio de Contingencias</h3>
    <div class="box-tools">
        <select class="btn btn-facebook btn-sm " id="estado_envio" onchange="tabla_ventas()">
            <option value="0">-- NO ENVIADAS/PENDIENTES --</option>
            <option value="1" selected="true"> NO ENVIADAS </option>
            <option value="2"> PENDIENTES </option>
        </select>
        <?php if($rolusuario[23-1]['rolusuario_asignado'] == 1){ ?>
            <select  class="btn btn-facebook btn-sm " id="usuario_id" onchange="tabla_ventas()">
                <option value="0">-- TODOS --</option>
                <?php foreach($usuario as $us){
                    $selected = "";
                if($us['usuario_id'] == $usuario_id){
                    $selected = "selected";
                }
                ?>
                <option value="<?php echo $us['usuario_id']; ?>" <?php echo $selected; ?>><?php echo $us['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
            <!-- <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalpaquetes" title="Solicitud de recepcion de paquete"><span class="fa fa-chain-broken"></span> Solicitud servicio recepción</a>
            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalvalidacion" title="Validacion de paquetes"><span class="fa fa-chain-broken"></span> Validación de paquetes</a>-->
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese num. venta, cliente, fecha, usuario..">
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
                        <th>
                            <label>
                                <input type="checkbox" id="select_all" onclick="seleccionar_todo(this)" checked="">Seleccionar Todo
                            </label>
                            <a class="btn btn-danger btn-xs" onclick="mostrar_modalallpaquetes()" title="Solicitud de recepcion de paquete"><span class="fa fa-chain-broken"></span></a>
                            <a class="btn btn-warning btn-xs" onclick="mostrar_modalverifpaquetes()" title="Validacion de paquetes"><span class="fa fa-chain-broken"></span></a>
                        </th>
                        <th><span id="str"></span>
                        </th>
                    </tr>
                    <tbody class="buscar" id="tabla_ventas">
                    </tbody>
                </table>
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
                <div class="col-md-8">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Nombre Archivo</label>
                    <div class="form-group">
                        <input type="text" name="nombre_archivo" value="contingencia.tar.gz" class="form-control" id="nombre_archivo" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="cant_fact" class="control-label"><span class="text-danger">*</span>Cantidad Facturas</label>
                    <div class="form-group">
                        <input type="number" name="cant_fact" value="1" class="form-control" id="cant_fact" />
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="emision_paquetesmas()"><fa class="fa fa-floppy-o"></fa> Recepcion de Paquetes</button>
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

<!------------------------ INICIO modal para envio de varias facturas en un solo paquete ------------------->
<div class="modal fade" id="modal_allpaquetes" tabindex="-1" role="dialog" aria-labelledby="modal_allpaquetes" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
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
                    <label for="codigo_eventoall" class="control-label"><span class="text-danger">*</span>Código Evento</label>
                    <!--<div class="form-group">
                        <input type="text" name="codigo_evento" class="form-control" id="codigo_evento" />
                    </div>
                    -->
                    <select name="codigo_eventoall" class="form-control" id="codigo_eventoall" >
                        <?php 
                            foreach($eventos as $evento){ ?>
                                <option value="<?php echo $evento['registroeventos_codigo']; ?>">    
                                    <?php echo $evento['registroeventos_codigo']." [".$evento['registroeventos_puntodeventa']."] ".$evento['registroeventos_detalle']." ".$evento['registroeventos_inicio']; ?>
                                </option>
                        <?php    } ?>
                            
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="nombre_archivoall" class="control-label"><span class="text-danger">*</span>Nombre Archivo</label>
                    <div class="form-group">
                        <input type="text" name="nombre_archivoall" value="compra_venta00.tar.gz" class="form-control" id="nombre_archivoall" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="cantotal_facturas" class="control-label"><span class="text-danger">*</span>Cantidad de Facturas</label>
                    <div class="form-group">
                        <input type="text" name="cantotal_facturas" value="0" class="form-control" id="cantotal_facturas" disabled="true" />
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="emision_allfpaquetes()"><fa class="fa fa-floppy-o"></fa> Recepcion de Paquetes</button>
                <button type="button" class="btn btn-danger" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>
<!------------------------ INICIO modal para envio de varias facturas en un solo paquete ------------------->

<!------------------------ INICIO modal para validar las varias facturas en un solo paquete ------------------->
<div class="modal fade" id="modal_allvalidacion" tabindex="-1" role="dialog" aria-labelledby="modal_allvalidacion" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
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
                
                <!--<div class="col-md-12">
                    <label for="codigo_recepcion" class="control-label"><span class="text-danger">*</span>Codigo Recepción</label>
                    <div class="form-group">
                        <input type="text" name="codigo_recepcion" class="form-control" id="codigo_recepcion" />
                    </div>
                </div>-->
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-facebook" onclick="validacion_paquetes()"><fa class="fa fa-floppy-o"></fa> Validación de Paquetes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N   modal para validar las varias facturas en un solo paquete ------------------->

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