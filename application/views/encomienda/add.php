<script src="<?php echo site_url('resources/js/encomienda.js'); ?>"></script>

<div class="box box-success">

    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-plus"></i> Nueva encomienda
        </h3>
    </div>

    <?php echo form_open('encomienda/add'); ?>

    <div class="box-body">

        <!-- ========================= REMITENTE / DESTINATARIO ========================= -->

        <div class="row">

            <div class="col-md-6">

                <h4 class="text-primary">Remitente</h4>

                <input
                    name="encomienda_remitentenombre"
                    class="form-control"
                    placeholder="Nombre remitente"
                    required>

                <br>

                <input
                    name="encomienda_remitenteci"
                    class="form-control"
                    placeholder="CI/NIT">

                <br>

                <input
                    name="encomienda_remitentetelefono"
                    class="form-control"
                    placeholder="Teléfono">

                <br>

                <input
                    name="encomienda_remitentedireccion"
                    class="form-control"
                    placeholder="Dirección">

            </div>

            <div class="col-md-6">

                <h4 class="text-primary">Destinatario</h4>

                <input
                    name="encomienda_destinatarionombre"
                    class="form-control"
                    placeholder="Nombre destinatario"
                    required>

                <br>

                <input
                    name="encomienda_destinatarioci"
                    class="form-control"
                    placeholder="CI">

                <br>

                <input
                    name="encomienda_destinatariotelefono"
                    class="form-control"
                    placeholder="Teléfono">

                <br>

                <input
                    name="encomienda_destinatariodireccion"
                    class="form-control"
                    placeholder="Dirección de entrega">

            </div>

        </div>

        <hr>

        <!-- ========================= ORIGEN / DESTINO ========================= -->

        <div class="row">

            <div class="col-md-3">

                <label>Origen</label>

                <select name="origen_id" class="form-control">
                    <option value="">Seleccionar</option>

                    <?php foreach ($catalogos['origen'] as $c) { ?>
                        <option value="<?php echo $c['origen_id']; ?>">
                            <?php echo $c['origen_nombre']; ?>
                        </option>
                    <?php } ?>

                </select>

            </div>

            <div class="col-md-3">

                <label>Destino</label>

                <select name="destino_id" class="form-control">
                    <option value="">Seleccionar</option>

                    <?php foreach ($catalogos['destino'] as $c) { ?>
                        <option value="<?php echo $c['destino_id']; ?>">
                            <?php echo $c['destino_nombre']; ?>
                        </option>
                    <?php } ?>

                </select>

            </div>

            <div class="col-md-3">

                <label>Ruta</label>

                <select name="ruta_id" class="form-control">
                    <option value="">Seleccionar</option>

                    <?php foreach ($catalogos['ruta'] as $c) { ?>
                        <option value="<?php echo $c['ruta_id']; ?>">
                            <?php echo $c['ruta_nombre']; ?>
                        </option>
                    <?php } ?>

                </select>

            </div>

            <div class="col-md-3">

                <label>Viaje</label>

                <select name="viaje_id" class="form-control">

                    <option value="">Sin asignar</option>

                    <?php foreach ($catalogos['viaje'] as $v) { ?>

                        <option value="<?php echo $v['viaje_id']; ?>">
                            #<?php echo $v['viaje_id']; ?>
                            <?php echo $v['ruta_nombre']; ?>
                            <?php echo $v['viaje_fechasalida']; ?>
                            <?php echo $v['viaje_horasalida']; ?>
                        </option>

                    <?php } ?>

                </select>

            </div>

        </div>

        <br>

        <!-- ========================= CONFIGURACIÓN ========================= -->

        <div class="row">

            <div class="col-md-3">

                <label>Tipo</label>

                <select name="tipoencomienda_id" class="form-control">

                    <?php foreach ($catalogos['tipo'] as $c) { ?>

                        <option value="<?php echo $c['tipoencomienda_id']; ?>">
                            <?php echo $c['tipoencomienda_nombre']; ?>
                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="col-md-3">

                <label>Servicio</label>

                <select name="servicioencomienda_id" class="form-control">

                    <?php foreach ($catalogos['servicio'] as $c) { ?>

                        <option value="<?php echo $c['servicioencomienda_id']; ?>">
                            <?php echo $c['servicioencomienda_nombre']; ?>
                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="col-md-2">

                <label>Recepción</label>

                <select name="encomienda_tiporecepcion" class="form-control">
                    <option>AGENCIA</option>
                    <option>DOMICILIO</option>
                </select>

            </div>

            <div class="col-md-2">

                <label>Entrega</label>

                <select name="encomienda_tipoentrega" class="form-control">
                    <option>AGENCIA</option>
                    <option>DOMICILIO</option>
                    <option>CONTRA ENTREGA</option>
                </select>

            </div>

            <div class="col-md-2">

                <label>Prioridad</label>

                <select name="encomienda_prioridad" class="form-control">
                    <option>NORMAL</option>
                    <option>URGENTE</option>
                    <option>EXPRESS</option>
                    <option>FRAGIL</option>
                </select>

            </div>

        </div>

        <br>

        <!-- ========================= CONTENIDO ========================= -->

        <div class="row">

            <div class="col-md-12">

                <label>Contenido / Descripción</label>

                <textarea
                    name="encomienda_contenido"
                    class="form-control"
                    required></textarea>

            </div>

        </div>

        <br>

        <!-- ========================= MEDIDAS ========================= -->

        <div class="row">

            <div class="col-md-2">
                <label>Cantidad</label>
                <input name="encomienda_cantidad" value="1" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Peso Kg</label>
                <input name="encomienda_peso" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Largo</label>
                <input id="encomienda_largo" name="encomienda_largo" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Ancho</label>
                <input id="encomienda_ancho" name="encomienda_ancho" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Alto</label>
                <input id="encomienda_alto" name="encomienda_alto" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Volumen</label>
                <input
                    id="encomienda_volumen"
                    name="encomienda_volumen"
                    class="form-control"
                    readonly>
            </div>

        </div>

        <br>

        <!-- ========================= COSTOS ========================= -->

        <div class="row">

            <div class="col-md-2">
                <label>Valor declarado</label>
                <input name="encomienda_valordeclarado" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Subtotal</label>
                <input id="encomienda_subtotal" name="encomienda_subtotal" value="0" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Descuento</label>
                <input id="encomienda_descuento" name="encomienda_descuento" value="0" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Recargo</label>
                <input id="encomienda_recargo" name="encomienda_recargo" value="0" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Seguro</label>
                <input id="encomienda_seguro" name="encomienda_seguro" value="0" class="form-control calculo-encomienda">
            </div>

            <div class="col-md-2">
                <label>Total</label>
                <input
                    id="encomienda_total"
                    name="encomienda_total"
                    class="form-control"
                    readonly>
            </div>

        </div>

        <br>

        <!-- ========================= PAGO ========================= -->

        <div class="row">

            <div class="col-md-3">

                <label>A cuenta</label>

                <input
                    id="encomienda_acuenta"
                    name="encomienda_acuenta"
                    value="0"
                    class="form-control calculo-encomienda">

            </div>

            <div class="col-md-3">

                <label>Saldo</label>

                <input
                    id="encomienda_saldo"
                    name="encomienda_saldo"
                    class="form-control"
                    readonly>

            </div>

            <div class="col-md-3">

                <label>Condición de pago</label>

                <select
                    id="encomienda_pagadoen"
                    name="encomienda_pagadoen"
                    class="form-control">

                    <option value="PAGADO">
                        PAGADO EN ORIGEN
                    </option>

                    <option value="POR PAGAR AL RECOGER">
                        POR PAGAR AL RECOGER
                    </option>

                </select>

            </div>

            <div class="col-md-3">

                <label>Forma de pago</label>

                <select name="forma_id" class="form-control">

                    <?php foreach ($catalogos['forma_pago'] as $c) { ?>

                        <option value="<?php echo $c['forma_id']; ?>">
                            <?php echo $c['forma_nombre']; ?>
                        </option>

                    <?php } ?>

                </select>

            </div>

        </div>

        <br>

        <!-- ========================= OBSERVACIÓN ========================= -->

        <div class="row">

            <div class="col-md-12">

                <label>Observación</label>

                <input
                    name="encomienda_observacion"
                    class="form-control">

            </div>

        </div>

    </div>

    <div class="box-footer text-right">

        <a href="<?php echo base_url("encomienda"); ?>" class="btn btn-danger">
            <i class="fa fa-times"></i>
            Cancelar
        </a>
        
        <button 
            class="btn btn-success">
            <i class="fa fa-save"></i>
            Guardar
        </button>

    </div>

    <?php echo form_close(); ?>

</div>