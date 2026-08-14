<div class="box box-success">

    <div class="box-header">
        <h3 class="box-title">
            Entrega de encomienda <?php echo $encomienda['encomienda_guia']; ?>
        </h3>
    </div>

    <?php echo form_open('encomienda/entrega/'.$encomienda['encomienda_id']); ?>

    <div class="box-body">

        <?php if ((float)$encomienda['encomienda_saldo'] > 0) { ?>

            <div class="alert alert-danger">
                <b>ATENCIÓN:</b>
                Encomienda POR PAGAR AL RECOGER.
                Saldo pendiente:
                <b>Bs <?php echo number_format($encomienda['encomienda_saldo'], 2); ?></b>
            </div>

        <?php } else { ?>

            <div class="alert alert-success">
                <b>Encomienda pagada.</b>
                No existe saldo pendiente.
            </div>

        <?php } ?>

        <div class="alert alert-info">
            <b>Destinatario:</b>
            <?php echo $encomienda['encomienda_destinatarionombre']; ?>

            |

            <b>Contenido:</b>
            <?php echo $encomienda['encomienda_contenido']; ?>

            |

            <b>Saldo:</b>
            <?php echo number_format($encomienda['encomienda_saldo'], 2); ?>
        </div>

        <div class="row">

            <div class="col-md-4">
                <label>Nombre de quien recibe</label>
                <input
                    name="encomienda_nombre_recibe"
                    class="form-control"
                    required>
            </div>

            <div class="col-md-2">
                <label>CI</label>
                <input
                    name="encomienda_ci_recibe"
                    class="form-control"
                    required>
            </div>

            <div class="col-md-3">
                <label>Parentesco/Relación</label>
                <input
                    name="encomienda_parentesco_recibe"
                    class="form-control"
                    value="Titular">
            </div>

            <div class="col-md-3">
                <label>Teléfono</label>
                <input
                    name="encomienda_telefono_recibe"
                    class="form-control">
            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-md-3">
                <label>Latitud</label>
                <input
                    name="encomienda_latitud_entrega"
                    id="lat"
                    class="form-control">
            </div>

            <div class="col-md-3">
                <label>Longitud</label>
                <input
                    name="encomienda_longitud_entrega"
                    id="lng"
                    class="form-control">
            </div>

            <div class="col-md-6">
                <label>Firma digital / Observación</label>
                <input
                    name="encomienda_firma"
                    class="form-control"
                    placeholder="Firma registrada en dispositivo o texto de conformidad">
            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-md-12">
                <label>Observación de entrega</label>

                <textarea
                    name="entregaencomienda_observacion"
                    class="form-control"
                    rows="2"
                    placeholder="Estado del paquete, conformidad u observaciones"></textarea>
            </div>

        </div>

    </div>

    <div class="box-footer">
        <button class="btn btn-success">
            <i class="fa fa-check"></i>
            Confirmar entrega
        </button>
    </div>

    <?php echo form_close(); ?>

</div>