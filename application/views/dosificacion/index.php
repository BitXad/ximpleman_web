<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<div class="box-header">
    <h3 class="box-title">Dosificación</h3>
    <button class="btn btn-info btn-xs" onclick="verificarComunicacion()"><fa class="fa fa-chain"></fa> Verificar Conexión</button>
    <!--<a class="btn btn-danger btn-xs" onclick="registroFirmaRevocada()"><fa class="fa fa-chain-broken"></fa> Firma Rebocada</a>-->
    <a class="btn btn-warning btn-xs" onclick="cierre_OperacionesSistema()"><fa class="fa fa-briefcase"></fa> Cierre de Operaciones</a>
    <!--<a class="btn btn-warning btn-xs" onclick="cierre_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Cierre Punto de Venta</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="consulta_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Evento Significativo</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="consulta_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Puntos de Venta</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="registro_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Registro de Evento Significativo</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventa()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventacomisionista()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta Comisionista</a>-->
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
<?php $estilo = "style='background: #1883ba; font-weight: bold; color: white; font-size: 9pt; text-align:right;'"; ?>
<div class="row">
    <div class="box">
        <div class="col-md-12 linea table-responsive">
            <table class="table table-striped table-responsive table-condensed" style="font-family: Arial;">
                <tr>
                    <td <?= $estilo; ?> >Empresa:</td>
                    <td><?php echo $dosificacion['empresa_nombre']; ?></td>

                    <td <?= $estilo; ?> >Fecha Limite:</td>
                    <td> <?php
                            if($dosificacion['dosificacion_fechalimite']){
                                echo date("d/m/Y",strtotime($dosificacion['dosificacion_fechalimite']));
                            }?>
                    </td>

                    <td <?= $estilo; ?> >Nit Emisor:</td>
                    <td><?php echo $dosificacion['dosificacion_nitemisor']; ?></td>
                    
                    <td <?= $estilo; ?> >Autorización:</td>
                    <td><?php echo $dosificacion['dosificacion_autorizacion']; ?></td>

                    <td <?= $estilo; ?> >Sfc:</td>
                    <td> <?php echo $dosificacion['dosificacion_sfc']; ?>
                    </td>
                    
                </tr>                
                <tr>

                    <td <?= $estilo; ?> >Llave:</td>
                    <td colspan="1"> <?php echo substr($dosificacion['dosificacion_llave'],0,20)."..."; ?></td>

                    <td <?= $estilo; ?> >Num. Factura:</td>
                    <td><?php echo $dosificacion['dosificacion_numfact']; ?></td>
                   
                    <td <?= $estilo; ?> >Sucursal:</td>
                    <td><?php echo $dosificacion['dosificacion_sucursal']; ?></td>
                    
                    <td <?= $estilo; ?> >Num Trans Mes:</td>
                    <td><?php echo $dosificacion['dosificacion_numerotransmes']; ?></td>
                    
                    <td <?= $estilo; ?> >Mes Actual:</td>
                    <td><?php echo $dosificacion['dosificacion_mesactual']; ?></td>
                </tr>
                
                <tr>

                    <td <?= $estilo; ?>>Actividad Princ.:</td>
                    <td colspan="3"><?php echo $dosificacion['dosificacion_actividad']; ?></td>
                    
                    <td <?= $estilo; ?> >Actividad Secundaria:</td>
                    <td colspan="5"><?php echo $dosificacion['dosificasion_actividadsec']; ?></td>
                    
                </tr>
                
                <tr>

                    <td <?= $estilo; ?> >Sfc:</td>
                    <td> <?php echo $dosificacion['dosificacion_sfc']; ?>
                    </td>
                    
                    <td <?= $estilo; ?> >Leyenda 1:</td>
                    <td colspan="3"><?php echo substr($dosificacion['dosificacion_leyenda1'],0,30)."..."; ?>

                    <td <?= $estilo; ?> >Leyenda 2:</td>
                    <td colspan="3"><?php echo substr($dosificacion['dosificacion_leyenda2'],0,30)."..."; ?></td>
                    
                </tr>
                
                <tr>
                    <td <?= $estilo; ?> >Leyenda 3:</td>
                    <td><?php echo substr($dosificacion['dosificacion_leyenda3'],0,30)."..."; ?></td>

                    <td <?= $estilo; ?> >Leyenda 4:</td>
                    <td colspan="3"> <?php echo $dosificacion['dosificacion_leyenda4']; ?>
                    </td>

                    <td <?= $estilo; ?> >Leyenda 5:</td>
                    <td colspan="3"><?php echo substr($dosificacion['dosificacion_leyenda5'],0,30)."..."; ?></td>
                </tr>
                
                
                <tr>
                    <td <?= $estilo; ?> >Ambiente:</td>
                    <td> <?php echo ($dosificacion['dosificacion_ambiente'] == 1)?'1-PRODUCCION':'2-PRUEBAS'; ?>
                    </td>

                    <td <?= $estilo; ?> >Documento Sector:</td>
                    <td> <?php echo $dosificacion['docsec_descripcion']; ?>
                    </td>

                    <td <?= $estilo; ?> >Documento Ajuste:</td>
                    <td><?php echo $dosificacion['tipofac_descripcion']; ?></td>

                    <td <?= $estilo; ?> >Modalidad</td>
                    <td> 
                        <?php echo ($dosificacion['dosificacion_modalidad']==1)?"1-ELECTRONICA EN LINEA":"2-COMPUTARIZADA EN LINEA"; ?>
                    </td>

                    <td <?= $estilo; ?> >Punto Venta</td>
                    <td>
                        <?php echo $dosificacion['dosificacion_puntoventa']; ?>                        
                    </td>
                </tr>                                
                
                <tr>

                    <td <?= $estilo; ?> >Cod. Sistema</td>
                    <td>                         
                         <?php echo substr($dosificacion['dosificacion_codsistema'],0,10)."..."; ?>
                    </td>
                    
                    <td <?= $estilo; ?> >Token Delegado:</td>
                    <td colspan="7" ><?php echo substr($dosificacion['dosificacion_tokendelegado'],0,70)."...."; ?></td>


                </tr>
                
                <tr>
                    <td <?= $estilo; ?> >CUIS:<br></td>
                    <td>
                        <label class="control-label"><small>Codigo Unico de Inicio de Sistema:</small></label>
                        <button class="btn btn-info btn-xs" onclick="solicitudCuis()"><fa class="fa fa-download"></fa> Solicitar CUIS</button>
                        <div class="row" id='loader_cuis' style='display:none; text-align: center'>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                        </div>
                        <?php echo $dosificacion['dosificacion_cuis']; ?>
                    </td>
                    <td <?= $estilo; ?>>(CUFD):</td>
                    <td   colspan="8">
                        <label class="control-label"><small>Codigo Unico de Facturacion Diaria:</small></label><br>
                            <a href="<?php echo base_url("punto_venta"); ?>" class="btn btn-info btn-xs" onclick="solicitudCufd()"><fa class="fa fa-download"></fa> Solicitar CUFD</a>
                            <div class="row" id='loader_cufd' style='display:none; text-align: center'>
                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                            </div>
                    </td>
                </tr>
                
                <tr>

                    <td <?= $estilo; ?> >CUIS Masivo:</td>
                    <td colspan="4"> 
                        
                        <label class="control-label"><small>Codigo Unico de Inicio de Sistema Masivo:</small></label><br>
                        <button class="btn btn-info btn-xs" onclick="solicitudCuisMasivo()"><fa class="fa fa-download"></fa> Solicitar CUIS Masivo</button>
                        <div class="row" id='loader_cuism' style='display:none; text-align: center'>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                        </div>
                        <?php echo $dosificacion['dosificacion_cuismasivo']; ?>
                    </td>

                    <td <?= $estilo; ?> >CUFD Masivo:</td>
                    <td  colspan="4">
                        <label class="control-label"><small>Codigo Unico de Facturación Diaria Masivo:</small></label><br>
                        <button class="btn btn-info btn-xs" onclick="solicitudCufdMasivo()"><fa class="fa fa-download"></fa> Solicitar CUFD Masivo</button>
                        <div class="row" id='loader_cufdm'  style='display:none; text-align: center'>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                        </div>
                        <?php echo $dosificacion['dosificacion_cufdmasivo']; ?>
                    </td>
                </tr>
                
                <tr>
                    <td <?= $estilo; ?> >Sector Económico:</td>
                    <td>
                        <?php echo $dosificacion['dosificacion_sectoreconomico']; ?>
                    </td>

                    <td <?= $estilo; ?> >CAFC:</td>
                    <td>    <?php echo $dosificacion['dosificacion_cafc']; ?>                      
                    </td>                    

                    <td <?= $estilo; ?> >Correo Electrónico:</td>
                    <td>
                       <?php echo $dosificacion['dosificacion_email']; ?> 
                    </td>
                    
                    <td <?= $estilo; ?> >Estado:</td>
                    <td>
                       <?php echo $dosificacion['estado_descripcion']; ?>
                    </td>
                </tr>
                
                <tr>
                    <td <?= $estilo; ?> >Sincronizacion:</td>
                    <td colspan="3">
                        <?php echo $dosificacion['dosificacion_sincronizacion']; ?>
                    </td>

                    <td <?= $estilo; ?> >Recepción Compras:</td>
                    <td colspan="4">    <?php echo $dosificacion['dosificacion_recepcioncompras']; ?>                      
                    </td>                    
                </tr>
                
                <tr>
                    <td <?= $estilo; ?> >Operaciones:</td>
                    <td colspan="3">
                        <?php echo $dosificacion['dosificacion_operaciones']; ?>
                    </td>

                    <td <?= $estilo; ?> >Obtención Codigos:</td>
                    <td colspan="4">    <?php echo $dosificacion['dosificacion_obtencioncodigos']; ?>                      
                    </td>                    
                </tr>
                
                <tr>
                    <td <?= $estilo; ?> >Nota de Conciliacion/Credito-Debito:</td>
                    <td colspan="3">
                        <?php echo $dosificacion['dosificacion_notacredito']; ?>
                    </td>

                    <td <?= $estilo; ?> >Facturas Compra/venta:</td>
                    <td colspan="4">    <?php echo $dosificacion['dosificacion_factura']; ?>                      
                    </td>                    
                </tr>
                
                <tr>
                    <td <?= $estilo; ?> >Facturas Servicios Básicos:</td>
                    <td colspan="3">
                        <?php echo $dosificacion['dosificacion_facturaservicios']; ?>
                    </td>

                    <td <?= $estilo; ?> >Facturas Computarizadas glp/prev/hosp-clin/hot/educ:</td>
                    <td colspan="4">    <?php echo $dosificacion['dosificacion_facturaglp']; ?>                      
                    </td>                    
                </tr>
                <tr>
                    <td <?= $estilo; ?> >Facturas Electronicas glp/prev/hosp-clin/hot/educ:</td>
                    <td colspan="3">
                        <?php echo $dosificacion['dosificacion_glpelectronica']; ?>
                    </td>
                    <td <?= $estilo; ?> >Facturas Telecomunicaciones:</td>
                    <td colspan="4">    <?php echo $dosificacion['dosificacion_telecomunicaciones']; ?>                      
                    </td>
                </tr>
                <tr>
                    <td <?= $estilo; ?> >Facturas Entidades Financieras:</td>
                    <td colspan="3">
                        <?php echo $dosificacion['dosificacion_entidadesfinancieras']; ?>
                    </td>

                    <!--<td <?php /*echo $estilo; ?> >Facturas dosificacion_facturaglp:</td>
                    <td colspan="4">    <?php echo $dosificacion['dosificacion_facturaglp'];*/ ?>                      
                    </td>-->
                </tr>

                <tr>
                    <td <?= $estilo; ?> >Ruta QR:</td>
                    <td colspan="3">
                        <?php echo $dosificacion['dosificacion_ruta']; ?>
                    </td>

                    <td <?= $estilo; ?> >Certificado contenedor P12:</td>
                    <td colspan="4">    <?php echo $dosificacion['dosificacion_contenedorp12']; ?>
                            <?php
                                if ($dosificacion['dosificacion_contenedorp12']!=null){ ?>
                                     
                                    <button class="btn btn-danger btn-xs" onclick="generar_llaves()"><fa class="fa fa-key"> </fa> Generar Llaves</button>
                        
                                <?php
                                }
                            ?>                        
                    </td>
                    
                </tr>

                <tr>
                    <td <?= $estilo; ?> >Clave contenedor:</td>
                    <td colspan="3">    **********                      
                    </td>
                    
                    <td <?= $estilo; ?> >Sincronización:</td>
                    <td colspan="3">
                        <a href="<?php echo base_url("sincronizacion"); ?>" class="btn btn-xs btn-info" target="_blank"> Sincronizar datos</a>
                    </td>
<!--
                    <td <?= $estilo; ?> >Facturas dosificacion_facturaglp:</td>
                    <td colspan="4">    <?php echo $dosificacion['dosificacion_facturaglp']; ?>                      
                    </td>                    -->
                </tr>

                
            </table>
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


<!--------------------- Metodo para extraer los certificados y almacenar en .CRT .PEM ------------>
<?php
/***
    $base_url = explode('/', base_url());
    
    $p12File = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/certificados/'.$dosificacion["dosificacion_contenedorp12"];
    $p12Passphrase = $dosificacion['dosificacion_clavep12'];
    $outputPath = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/certificados/';
   

    // Cargar el archivo .p12
    $pkcs12 = file_get_contents($p12File);

    // Extraer la clave privada y el certificado
    if (openssl_pkcs12_read($pkcs12, $certs, $p12Passphrase)) {

        // Obtener el certificado
        $certData = openssl_x509_read($certs['cert']);
        $publicKey = openssl_pkey_get_public($certData);
        // Obtener la clave privada
        $privateKey = $certs['pkey'];

        // Obtener el certificado en formato .crt CORRE OK
        //$certificateCrt = openssl_x509_export($certs['cert'], $certificateCrt);
        $certificateCrt = $certs['cert'];
        file_put_contents($outputPath . 'certificado.crt', $certificateCrt);


        // Obtener la clave pública en formato .pem
        $publicKeyPem = $certs['cert'];

        $publicKey = openssl_pkey_get_public($certData);

        //$publicKeyPem = openssl_pkey_get_details($certData);
        // Obtener los detalles de la clave pública
        $publicKeyDetails = openssl_pkey_get_details($publicKey);
        file_put_contents($outputPath . 'publickey.pem', $publicKeyDetails['key']);

        // Obtener la clave privada en formato .pem
        $privateKeyPem = '';
        openssl_pkey_export($certs['pkey'], $privateKeyPem);
        file_put_contents($outputPath . 'privatekey.pem', $privateKey);

        // Extraer la clave pública del certificado
        $publicKey = openssl_pkey_get_public($certData); // REVISAR

        // Obtener los detalles de la clave pública
        $publicKeyDetails = openssl_pkey_get_details($publicKey);

        
            // Mostrar la clave pública y privada
            echo "</br>";
            echo "</br>Clave pública RSA:";
            echo "</br>".$publicKeyDetails['key'] . "\n";

            echo "</br>";
            echo "</br>Clave privada RSA:\n";
            echo "</br>".$privateKeyPem. "\n";

            echo "</br>";
            echo "</br>Certificado RSA:\n";
            echo "</br>".$certs['cert']. "\n";
        

    }
    
***/
?>