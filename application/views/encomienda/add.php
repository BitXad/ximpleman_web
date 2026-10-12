<script src="<?php echo site_url('resources/js/encomienda.js'); ?>"></script>

<style>
    /* Estilos exclusivos del formulario de encomiendas - Bootstrap 3 */
    #encomienda-formulario {
        font-family: Arial, Helvetica, sans-serif;
        color: #2f3b45;
    }
    #encomienda-formulario .box {
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,.08);
        border-top: 3px solid #00a65a;
    }
    #encomienda-formulario .box-header.principal {
        padding: 14px 18px;
        background: #fff;
        border-bottom: 1px solid #e8ecef;
    }
    #encomienda-formulario .box-title {
        font-size: 20px;
        font-weight: 700;
        color: #263238;
    }
    #encomienda-formulario .subtitulo {
        display: block;
        margin-top: 4px;
        color: #7a8791;
        font-size: 12px;
        font-weight: normal;
    }
    #encomienda-formulario .box-body {
        padding: 16px;
        background: #f5f7f9;
    }
    #encomienda-formulario .seccion {
        background: #fff;
        border: 1px solid #dfe5e9;
        border-radius: 5px;
        margin-bottom: 14px;
        overflow: hidden;
    }
    #encomienda-formulario .seccion-titulo {
        padding: 9px 12px;
        background: #eef3f6;
        border-bottom: 1px solid #dfe5e9;
        font-size: 13px;
        font-weight: bold;
        color: #34495e;
        text-transform: uppercase;
    }
    #encomienda-formulario .seccion-titulo i {
        margin-right: 6px;
        color: #008d4c;
    }
    #encomienda-formulario .seccion-cuerpo {
        padding: 12px 12px 4px;
    }
    #encomienda-formulario .panel-persona {
        border: 1px solid #e2e8ec;
        border-radius: 4px;
        padding: 12px;
        margin-bottom: 10px;
        background: #fcfdfe;
    }
    #encomienda-formulario .panel-persona h4 {
        margin: 0 0 10px;
        padding-bottom: 7px;
        border-bottom: 1px solid #e7ecef;
        font-size: 14px;
        font-weight: bold;
        color: #2c3e50;
    }
    #encomienda-formulario .panel-persona h4 i {
        margin-right: 5px;
        color: #3c8dbc;
    }
    #encomienda-formulario .form-group {
        margin-bottom: 10px;
    }
    #encomienda-formulario label {
        font-size: 12px;
        margin-bottom: 4px;
        color: #455a64;
    }
    #encomienda-formulario .form-control {
        height: 34px;
        border-radius: 3px;
        border-color: #cfd8dc;
        box-shadow: none;
        font-size: 13px;
    }
    #encomienda-formulario textarea.form-control {
        height: 68px;
        resize: vertical;
    }
    #encomienda-formulario .form-control:focus {
        border-color: #3c8dbc;
        box-shadow: 0 0 0 1px rgba(60,141,188,.12);
    }
    #encomienda-formulario .campo-total {
        background: #eaf8f1;
        border-color: #9ed8bc;
        color: #00733e;
        font-weight: bold;
        font-size: 15px;
    }
    #encomienda-formulario .campo-saldo {
        background: #fff8e5;
        border-color: #ead18a;
        color: #8a6500;
        font-weight: bold;
    }
    #encomienda-formulario .ayuda {
        color: #8a969e;
        font-size: 10px;
        margin-top: 3px;
    }
    #encomienda-formulario .box-footer {
        padding: 12px 16px;
        background: #fff;
        border-top: 1px solid #dfe5e9;
    }
    #encomienda-formulario .box-footer .btn {
        min-width: 115px;
        font-weight: bold;
    }
    #encomienda-formulario .requerido {
        color: #dd4b39;
    }

    #encomienda-formulario .estado-cliente {
        display: none;
        margin-top: 5px;
        padding: 5px 8px;
        border-radius: 3px;
        font-size: 11px;
        font-weight: bold;
    }
    #encomienda-formulario .estado-cliente.encontrado {
        display: block;
        background: #dff0d8;
        color: #3c763d;
        border: 1px solid #d6e9c6;
    }
    #encomienda-formulario .estado-cliente.nuevo {
        display: block;
        background: #fcf8e3;
        color: #8a6d3b;
        border: 1px solid #faebcc;
    }
    #encomienda-formulario .estado-cliente.buscando {
        display: block;
        background: #d9edf7;
        color: #31708f;
        border: 1px solid #bce8f1;
    }
    @media (max-width: 767px) {
        #encomienda-formulario .box-body { padding: 8px; }
        #encomienda-formulario .seccion-cuerpo { padding: 9px 9px 1px; }
        #encomienda-formulario .box-footer .btn { width: 100%; margin: 4px 0 0; }
    }
</style>

<div id="encomienda-formulario" data-buscar-cliente-url="<?php echo site_url('encomienda/buscar_cliente_ci'); ?>">
<div class="box box-success">

    <div class="box-header principal">
        <h3 class="box-title">
            <i class="fa fa-cube"></i> NUEVA ENCOMIENDA
            <span class="subtitulo">Registro de remitente, destinatario, ruta, contenido y cobro del envío</span>
        </h3>
    </div>

    <?php echo form_open('encomienda/add'); ?>

    <div class="box-body">

        <!-- REMITENTE / DESTINATARIO -->
        <div class="seccion">
            <div class="seccion-titulo"><i class="fa fa-users"></i> Datos del envío</div>
            <div class="seccion-cuerpo">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel-persona">
                            <h4><i class="fa fa-user"></i> REMITENTE</h4>
                            <input type="hidden" name="remitente_cliente_id" id="remitente_cliente_id" value="0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>CI / NIT</label>
                                        <div class="input-group">
                                            <input id="encomienda_remitenteci" name="encomienda_remitenteci" class="form-control buscar-cliente-ci" data-tipo="remitente" placeholder="Ingrese CI">
                                            <span class="input-group-btn"><button type="button" class="btn btn-info btn-buscar-cliente" data-tipo="remitente" title="Buscar cliente"><i class="fa fa-search"></i></button></span>
                                        </div>
                                        <div id="estado_cliente_remitente" class="estado-cliente"></div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Nombre completo <span class="requerido">*</span></label>
                                        <input id="encomienda_remitentenombre" name="encomienda_remitentenombre" class="form-control" placeholder="Nombre del remitente" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input id="encomienda_remitentetelefono" name="encomienda_remitentetelefono" class="form-control" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input id="encomienda_remitentedireccion" name="encomienda_remitentedireccion" class="form-control" placeholder="Dirección del remitente">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel-persona">
                            <h4><i class="fa fa-map-marker"></i> DESTINATARIO</h4>
                            <input type="hidden" name="destinatario_cliente_id" id="destinatario_cliente_id" value="0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>CI</label>
                                        <div class="input-group">
                                            <input id="encomienda_destinatarioci" name="encomienda_destinatarioci" class="form-control buscar-cliente-ci" data-tipo="destinatario" placeholder="Ingrese CI">
                                            <span class="input-group-btn"><button type="button" class="btn btn-info btn-buscar-cliente" data-tipo="destinatario" title="Buscar cliente"><i class="fa fa-search"></i></button></span>
                                        </div>
                                        <div id="estado_cliente_destinatario" class="estado-cliente"></div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Nombre completo <span class="requerido">*</span></label>
                                        <input id="encomienda_destinatarionombre" name="encomienda_destinatarionombre" class="form-control" placeholder="Nombre del destinatario" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input id="encomienda_destinatariotelefono" name="encomienda_destinatariotelefono" class="form-control" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Dirección de entrega</label>
                                        <input id="encomienda_destinatariodireccion" name="encomienda_destinatariodireccion" class="form-control" placeholder="Dirección de entrega">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RUTA / VIAJE -->
        <div class="seccion">
            <div class="seccion-titulo"><i class="fa fa-road"></i> Ruta y servicio</div>
            <div class="seccion-cuerpo">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label>Origen</label>
                            <select name="origen_id" class="form-control">
                                <option value="">Seleccionar</option>
                                <?php foreach ($catalogos['origen'] as $c) { ?>
                                    <option value="<?php echo $c['origen_id']; ?>"><?php echo $c['origen_nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label>Destino</label>
                            <select name="destino_id" class="form-control">
                                <option value="">Seleccionar</option>
                                <?php foreach ($catalogos['destino'] as $c) { ?>
                                    <option value="<?php echo $c['destino_id']; ?>"><?php echo $c['destino_nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label>Ruta</label>
                            <select name="ruta_id" class="form-control">
                                <option value="">Seleccionar</option>
                                <?php foreach ($catalogos['ruta'] as $c) { ?>
                                    <option value="<?php echo $c['ruta_id']; ?>"><?php echo $c['ruta_nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label>Viaje programado</label>
                            <select name="viaje_id" class="form-control">
                                <option value="">Sin asignar</option>
                                <?php foreach ($catalogos['viaje'] as $v) { ?>
                                    <option value="<?php echo $v['viaje_id']; ?>">
                                        #<?php echo $v['viaje_id']; ?> <?php echo $v['ruta_nombre']; ?> <?php echo $v['viaje_fechasalida']; ?> <?php echo $v['viaje_horasalida']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label>Tipo de encomienda</label>
                            <select name="tipoencomienda_id" class="form-control">
                                <?php foreach ($catalogos['tipo'] as $c) { ?>
                                    <option value="<?php echo $c['tipoencomienda_id']; ?>"><?php echo $c['tipoencomienda_nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label>Servicio</label>
                            <select name="servicioencomienda_id" class="form-control">
                                <?php foreach ($catalogos['servicio'] as $c) { ?>
                                    <option value="<?php echo $c['servicioencomienda_id']; ?>"><?php echo $c['servicioencomienda_nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="form-group">
                            <label>Recepción</label>
                            <select name="encomienda_tiporecepcion" class="form-control">
                                <option>AGENCIA</option><option>DOMICILIO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="form-group">
                            <label>Entrega</label>
                            <select name="encomienda_tipoentrega" class="form-control">
                                <option>AGENCIA</option><option>DOMICILIO</option><option>CONTRA ENTREGA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="form-group">
                            <label>Prioridad</label>
                            <select name="encomienda_prioridad" class="form-control">
                                <option>NORMAL</option><option>URGENTE</option><option>EXPRESS</option><option>FRAGIL</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENIDO / MEDIDAS -->
        <div class="seccion">
            <div class="seccion-titulo"><i class="fa fa-cubes"></i> Contenido y características</div>
            <div class="seccion-cuerpo">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Contenido / Descripción <span class="requerido">*</span></label>
                            <textarea name="encomienda_contenido" class="form-control" placeholder="Describa el contenido de la encomienda" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6"><div class="form-group"><label>Cantidad</label><input name="encomienda_cantidad" value="1" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4 col-xs-6"><div class="form-group"><label>Peso (Kg)</label><input name="encomienda_peso" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4 col-xs-6"><div class="form-group"><label>Largo</label><input id="encomienda_largo" name="encomienda_largo" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4 col-xs-6"><div class="form-group"><label>Ancho</label><input id="encomienda_ancho" name="encomienda_ancho" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4 col-xs-6"><div class="form-group"><label>Alto</label><input id="encomienda_alto" name="encomienda_alto" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4 col-xs-6"><div class="form-group"><label>Volumen</label><input id="encomienda_volumen" name="encomienda_volumen" class="form-control" readonly><div class="ayuda">Calculado automáticamente</div></div></div>
                </div>
            </div>
        </div>

        <!-- COSTOS / PAGO -->
        <div class="seccion">
            <div class="seccion-titulo"><i class="fa fa-money"></i> Costos y forma de pago</div>
            <div class="seccion-cuerpo">
                <div class="row">
                    <div class="col-md-2 col-sm-4"><div class="form-group"><label>Valor declarado</label><input name="encomienda_valordeclarado" class="form-control"></div></div>
                    <div class="col-md-2 col-sm-4"><div class="form-group"><label>Subtotal</label><input id="encomienda_subtotal" name="encomienda_subtotal" value="0" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4"><div class="form-group"><label>Descuento</label><input id="encomienda_descuento" name="encomienda_descuento" value="0" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4"><div class="form-group"><label>Recargo</label><input id="encomienda_recargo" name="encomienda_recargo" value="0" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4"><div class="form-group"><label>Seguro</label><input id="encomienda_seguro" name="encomienda_seguro" value="0" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-2 col-sm-4"><div class="form-group"><label>Total Bs</label><input id="encomienda_total" name="encomienda_total" class="form-control campo-total" readonly></div></div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6"><div class="form-group"><label>A cuenta</label><input id="encomienda_acuenta" name="encomienda_acuenta" value="0" class="form-control calculo-encomienda"></div></div>
                    <div class="col-md-3 col-sm-6"><div class="form-group"><label>Saldo Bs</label><input id="encomienda_saldo" name="encomienda_saldo" class="form-control campo-saldo" readonly></div></div>
                    <div class="col-md-3 col-sm-6"><div class="form-group"><label>Condición de pago</label><select id="encomienda_pagadoen" name="encomienda_pagadoen" class="form-control"><option value="PAGADO">PAGADO EN ORIGEN</option><option value="POR PAGAR AL RECOGER">POR PAGAR AL RECOGER</option></select></div></div>
                    <div class="col-md-3 col-sm-6"><div class="form-group"><label>Forma de pago</label><select name="forma_id" class="form-control"><?php foreach ($catalogos['forma_pago'] as $c) { ?><option value="<?php echo $c['forma_id']; ?>"><?php echo $c['forma_nombre']; ?></option><?php } ?></select></div></div>
                </div>
            </div>
        </div>

        <!-- OBSERVACIONES -->
        <div class="seccion" style="margin-bottom:0;">
            <div class="seccion-titulo"><i class="fa fa-comment-o"></i> Observaciones</div>
            <div class="seccion-cuerpo">
                <div class="form-group">
                    <label>Observación adicional</label>
                    <input name="encomienda_observacion" class="form-control" placeholder="Observaciones, indicaciones de manipulación o entrega">
                </div>
            </div>
        </div>

    </div>

    <div class="box-footer text-right">
        <a href="<?php echo base_url('encomienda'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar encomienda</button>
    </div>

    <?php echo form_close(); ?>
</div>
</div>
