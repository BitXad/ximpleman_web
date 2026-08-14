<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box box-primary">

    <div class="box-header with-border">

        <h3 class="box-title">
            <i class="fa fa-cubes"></i> Encomiendas
        </h3>

        <div class="box-tools">

            <a href="<?php echo site_url('encomienda/add'); ?>" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Nueva encomienda
            </a>

            <a href="<?php echo site_url('encomienda/recepcion_destino'); ?>" class="btn btn-info btn-sm">
                <i class="fa fa-qrcode"></i> Recepción destino
            </a>

            <a href="<?php echo site_url('encomienda/reportes'); ?>" class="btn btn-warning btn-sm">
                <i class="fa fa-bar-chart"></i> Reportes
            </a>

        </div>

    </div>

    <div class="box-body table-responsive">

        <?php echo $this->session->flashdata('alert_msg'); ?>

        <?php $i = 0; ?>

        <table class="table table-striped table-bordered" id="mitabla">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Guía</th>
                    <th>Fecha</th>
                    <th>Remitente</th>
                    <th>Destinatario</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Viaje</th>
                    <th>Total</th>
                    <th>Saldo</th>
                    <th>Pago</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                <?php if ($encomiendas) { ?>

                    <?php foreach ($encomiendas as $e) { ?>

                        <tr>

                            <td>
                                <?php echo ++$i; ?>
                            </td>

                            <td>
                                <b><?php echo $e['encomienda_guia']; ?></b>
                            </td>

                            <td>
                                <?php echo date('d/m/Y', strtotime($e['encomienda_fecha'])); ?>
                            </td>

                            <td>
                                <?php echo $e['encomienda_remitentenombre']; ?>
                            </td>

                            <td>
                                <?php echo $e['encomienda_destinatarionombre']; ?>
                                <br>
                                <small>
                                    <?php echo $e['encomienda_destinatariotelefono']; ?>
                                </small>
                            </td>

                            <td>
                                <?php echo $e['origen_nombre']; ?>
                            </td>

                            <td>
                                <?php echo $e['destino_nombre']; ?>
                            </td>

                            <td>
                                <?php echo $e['viaje_id']; ?>
                            </td>

                            <td class="text-right">
                                <?php echo number_format($e['encomienda_total'], 2); ?>
                            </td>

                            <td class="text-right">
                                <?php echo number_format($e['encomienda_saldo'], 2); ?>
                            </td>

                            <td>

                                <?php if (isset($e['encomienda_pagadoen']) && $e['encomienda_pagadoen'] == 'POR PAGAR AL RECOGER') { ?>

                                    <span class="label label-danger">
                                        POR PAGAR
                                    </span>

                                <?php } else { ?>

                                    <span class="label label-success">
                                        PAGADO
                                    </span>

                                <?php } ?>

                            </td>

                            <td>
                                <span class="label label-<?php echo $e['encomiendaestado_color']; ?>">
                                    <?php echo $e['encomiendaestado_nombre']; ?>
                                </span>
                            </td>

                            <td class="text-right">

                                <a href="<?php echo site_url('encomienda/view/'.$e['encomienda_id']); ?>"
                                   class="btn btn-xs btn-info"
                                   title="Ver">

                                    <i class="fa fa-eye"></i>

                                </a>

                                <a href="<?php echo site_url('encomienda/guia/'.$e['encomienda_id']); ?>"
                                   class="btn btn-xs btn-default"
                                   title="Imprimir guía">

                                    <i class="fa fa-print"></i>

                                </a>

                                <a href="<?php echo site_url('encomienda/entrega/'.$e['encomienda_id']); ?>"
                                   class="btn btn-xs btn-success"
                                   title="Registrar entrega">

                                    <i class="fa fa-check"></i>

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>