<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<div class="box-header">
    <h3 class="box-title">Dosificación</h3>
    <button class="btn btn-info btn-xs" onclick="verificarComunicacion()"><fa class="fa fa-chain"></fa> Verificar Conexión</button>
    <a class="btn btn-danger btn-xs" onclick="registroFirmaRevocada()"><fa class="fa fa-chain-broken"></fa> Firma Rebocada</a>
    <a class="btn btn-warning btn-xs" onclick="cierre_OperacionesSistema()"><fa class="fa fa-briefcase"></fa> Cierre de Operaciones</a>
    <a class="btn btn-warning btn-xs" onclick="cierre_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Cierre Punto de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="consulta_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Evento Significativo</a>
    <a class="btn btn-warning btn-xs" onclick="consulta_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Puntos de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="registro_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Registro de Evento Significativo</a>
    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventa()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventacomisionista()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta Comisionista</a>
    <!--<a class="btn btn-warning btn-xs" onclick="verificar_comunicacion_op()"><fa class="fa fa-cart-arrow-down"></fa> Verificar Comunicación de Operaciones</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="verificar_comunicacionNCD()"><fa class="fa fa-cart-arrow-down"></fa> Verificar Comunicación Doc de Ajuste NCD</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="recepcion_documentoAjuste()"><fa class="fa fa-cart-arrow-down"></fa>Recepción Documento de Ajuste</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="verificacion_EstadoDocumentoAjuste()"><fa class="fa fa-cart-arrow-down"></fa>Verificar Estado Documento de Ajuste</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="anulacion_DocumentoAjuste()"><fa class="fa fa-cart-arrow-down"></fa> Anulación Documento de Ajuste</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="anulacion_compra()"><fa class="fa fa-cart-arrow-down"></fa> Anulación Registro de Compra</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="confirmacion_Compras()"><fa class="fa fa-cart-arrow-down"></fa> Confirmación de Compras</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="consulta_Compras()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Compras a Confirmar</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="recepcion_paqueteCompras()"><fa class="fa fa-cart-arrow-down"></fa> Recepción Paquete Compras</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="validacion_recepcionPaqueteCompras()"><fa class="fa fa-cart-arrow-down"></fa> Validación Recepción Paquete Compras</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="verificar_comunicacionRecCompras()"><fa class="fa fa-cart-arrow-down"></fa> Verificar Comunicación Rec. Compras</a>-->
    <div class="row" id='loader_revocado'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
    <div class="box-tools">
        <?php
        if($newdosif == 0){
        ?>
            <a href="<?php echo site_url('dosificacion/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
        <?php } ?>
        <?php
        if($newdosif == 1){
        ?>
            <a href="<?php echo site_url('dosificacion/edit/'.$dosificacion['dosificacion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span>Editar</a> 
        <?php } ?>
    </div>
</div>
<style type="text/css">
    .linea:hover {
        background-color: #dddddd;
    }
</style>
<div class="row">
    <div class="box">
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Empresa</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['empresa_nombre']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Fecha Limite</label>
            </div>
            <div class="col-md-3">
                <?php
                if($dosificacion['dosificacion_fechalimite']){
                    echo date("d/m/Y",strtotime($dosificacion['dosificacion_fechalimite']));
                }?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Nit Emisor</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificacion_nitemisor']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Autorización</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_autorizacion']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Llave</label>
            </div>
            <div class="col-md-3" style="word-break: break-word;">
                <?php echo $dosificacion['dosificacion_llave']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Num. Factura</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificacion_numfact']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Sucursal</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_sucursal']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Sfc</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_sfc']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Actividad</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['actividad_descripcion']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Leyenda 1</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_leyenda1']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Leyenda 2</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_leyenda2']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Leyenda 3</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificacion_leyenda3']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Leyenda 4</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_leyenda4']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Leyenda 5</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_leyenda5']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Actividad Secundaria</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificasion_actividadsec']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Documento Sector</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['docsec_descripcion']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Documento Ajuste</label>
            </div>
            <div class="col-md-7">
                <?php echo $dosificacion['tipofac_descripcion']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Token Delegado</label>
            </div>
            <div class="col-md-11" style="word-break: break-word;">
                <?php echo $dosificacion['dosificacion_tokendelegado']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Ambiente</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_ambiente']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Codigo Unico de Inicio de Sistema (CUIS)</label>
                <button class="btn btn-info btn-xs" onclick="solicitudCuis()"><fa class="fa fa-download"></fa> Solicitar CUIS</button>
                <div class="row" id='loader_cuis' style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_cuis']; ?>
            </div>
           <div class="col-md-1">
                <label class="control-label">Codigo Unico de Facturación Diaria (CUFD) </label>
                <button class="btn btn-info btn-xs" onclick="solicitudCufd()"><fa class="fa fa-download"></fa> Solicitar CUFD</button>
                <div class="row" id='loader_cufd' style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
            </div>
            <div class="col-md-2" style="word-break: break-word;">
                <?php echo $dosificacion['dosificacion_cufd']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Codigo Unico de Inicio de Sistema Masivo (CUIS Masivo)</label>
                <button class="btn btn-info btn-xs" onclick="solicitudCuisMasivo()"><fa class="fa fa-download"></fa> Solicitar CUIS Masivo</button>
                <div class="row" id='loader_cuism' style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_cuismasivo']; ?>
            </div>
           <div class="col-md-1">
                <label class="control-label">Codigo Unico de Facturación Diaria Masivo (CUFD Masivo) </label>
                <button class="btn btn-info btn-xs" onclick="solicitudCufdMasivo()"><fa class="fa fa-download"></fa> Solicitar CUFD Masivo</button>
                <div class="row" id='loader_cufdm'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificacion_cufdmasivo']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Modalidad</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_modalidad']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">Cod. Sistema</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_codsistema']; ?>
            </div>
           <div class="col-md-1">
                <label class="control-label">Punto Venta</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['dosificacion_puntoventa']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Sector Económico</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_sectoreconomico']; ?>
            </div>
        </div>
        <div class="col-md-12 linea">
            <div class="col-md-1">
                <label class="control-label">CAFC</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_cafc']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Correo Electrónico</label>
            </div>
            <div class="col-md-3">
                <?php echo $dosificacion['dosificacion_email']; ?>
            </div>
            <div class="col-md-1">
                <label class="control-label">Estado</label>
            </div>
            <div class="col-md-2">
                <?php echo $dosificacion['estado_descripcion']; ?>
            </div>
        </div>
    </div>

</div>
<!--------------------- Inicio modal registrar firma revocada  ------------>
<div id="modalrevocarfirma" class="modal fade" role="dialog">
    <div class="modal-dialog" style="font-family: Arial">
        <div class="modal-content">
            <div class="modal-header" style="background: #CC660E">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title"><fa class="fa fa-exclamation-triangle"></fa><b> ADVERTENCIA</b></h2>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="monto_caja" class="control-label">
                        <p class="text-justify"> Esta a punto de inhabilitar el CUIS y el CUFD vigente,
                            de manera automática no pudiendo realizar la emisión de Facturas Digitales a partir de ese momento,
                            hasta que se tenga firma valida habilitada!<br>
                            ¿Desea Continuar?
                        </p>
                    </label>
                </div>
                <div class="col-md-12">
                    <label for="certificado" class="control-label">Certificado</label>
                    <div class="form-group">
                        <input type="text" name="certificado" value="" class="form-control" id="certificado" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                        <span class="text-danger"><?php echo form_error('usuario_nombre');?></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="fecha_revocacion" class="control-label">Fecha Revocación</label>
                    <div class="form-group">
                        <input type="date" name="fecha_revocacion" value="<?php echo date("Y-m-d") ?>" class="form-control" id="fecha_revocacion" required />
                        <span class="text-danger"><?php echo form_error('fecha_revocacion');?></span>
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="razonrevocacion" class="control-label">Razon de Revocación</label>
                    <div class="form-group">
                        <input type="text" name="razonrevocacion" value="" class="form-control" id="razonrevocacion" required />
                        <span class="text-danger"><?php echo form_error('razonrevocacion');?></span>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer" style="text-align: center">
                <div class="col-md-4">
                    <button class="btn btn-warning btn-block" data-dismiss="modal" onclick="registroFirmaRevocada()"><fa class="fa fa-chain-broken"></fa> Rebocar Firmas</button>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
                </div>
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            </div>
        </div>
    </div>
</div>
<!--------------------- Fin modal registrar firma revocada  ------------>

<!--------------------- Inicio modal registrar nuevo punto de venta  ------------>
<div class="modal fade" id="modalregistrarpventa" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="text-align: center !important">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span style="font-size: 16px"><b> REGISTRAR NUEVO PUNTO DE VENTA</b></span>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <span class="text-danger" id="mensaje"></span>
                    <label for="codigoTipoPuntoVenta" class="control-label">Tipo Punto de Venta</label>
                    <div class="form-group">
                        <select name="codigoTipoPuntoVenta" class="form-control" id="codigoTipoPuntoVenta">
                            <?php 
                            foreach($all_tipopuntoventa as $tipopuntoventa){ ?>
                                <option value="<?php echo $tipopuntoventa['tipopuntoventa_codigo']; ?>"> <?php echo $tipopuntoventa['tipopuntoventa_descripcion']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="nombrePuntoVenta" class="control-label">Nombre de Punto de Venta</label>
                    <div class="form-group">
                        <input type="text" name="nombrePuntoVenta" class="form-control" id="nombrePuntoVenta" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="descripcion" class="control-label">Descripción</label>
                    <div class="form-group">
                         <input type="text" name="descripcion" class="form-control" id="descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <!--<div class="col-md-4 text-center">-->
                    <button class="btn btn-success" onclick="registroPuntoVenta()"><fa class="fa fa-check"></fa> Registrar</button>
                <!--</div>-->
                <!--<div class="col-md-4 text-center">-->
                    <button class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<!--------------------- Fin modal registrar nuevo punto de venta  ------------>
<!--------------------- Inicio modal registrar nuevo punto de venta comisionista ------------>
<div class="modal fade" id="modalregistrarpventacomisionista" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="text-align: center !important">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span style="font-size: 16px"><b> REGISTRAR NUEVO PUNTO DE VENTA COMISIONISTA</b></span>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <span class="text-danger" id="mensajecomisionista"></span>
                </div>
                <div class="col-md-6">
                    <label for="nitComisionista" class="control-label">Nit Comisionista</label>
                    <div class="form-group">
                        <input type="number" name="nitComisionista" class="form-control" id="nitComisionista" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="numeroContrato" class="control-label">Número del Contrato</label>
                    <div class="form-group">
                        <input type="number" name="numeroContrato" class="form-control" id="numeroContrato" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="nombrePuntoVentac" class="control-label">Nombre de Punto de Venta</label>
                    <div class="form-group">
                        <input type="text" name="nombrePuntoVentac" class="form-control" id="nombrePuntoVentac" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="fechaInicio" class="control-label">Inicio Contrato</label>
                    <div class="form-group">
                        <input type="date" name="fechaInicio" class="form-control" value="<?php echo date("Y-m-d") ?>" id="fechaInicio" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="fechaFin" class="control-label">Fin Contrato</label>
                    <div class="form-group">
                        <input type="date" name="fechaFin" class="form-control" value="<?php echo date("Y-m-d") ?>" id="fechaFin" required />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="descripcionc" class="control-label">Descripción</label>
                    <div class="form-group">
                         <input type="text" name="descripcionc" class="form-control" id="descripcionc" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <button class="btn btn-success" onclick="registro_PuntoVentaComisionista()"><fa class="fa fa-check"></fa> Registrar</button>
                <button class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!--------------------- Fin modal registrar nuevo punto de venta comisionista ------------>