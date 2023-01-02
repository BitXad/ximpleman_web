<!-- <link href="<?= site_url("resources/css/summernote.min.css")?>" rel="stylesheet"> -->
<!-- <script src="<?= site_url("resources/js/summernote.min.js")?>"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- <link href="<?= site_url("resources/css/summernote-lite.min.css")?>" rel="stylesheet">
<script src="<?= site_url("resources/js/summernote-lite.min.js")?>"></script>
<script src="<?php echo base_url('resources/js/summernote.js'); ?>" type="text/javascript"></script>

<link href="<?php echo site_url('resources/css/summernote.css'); ?>" rel="stylesheet"> -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="<?php echo site_url('resources/js/modeloc_add.js'); ?>" type="text/javascript"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Modelo Contrato</h3>
            </div>
            <?php //echo form_open('modelo_contrato/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-10">
                        <label for="nombre_contrato" class="control-label"><span style="color: red;">*</span>Nombre del contrato</label>
                        <div class="form-group">
                            <input type="text" id="nombre_contrato" name="nombre_contrato" class="form-control" required placeholder="Nombre del contrato" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus>
                            <span id="mensaje_nombre_contrato" style="color: red; font-size: 10pt;"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#cliente_nombre#</span><span> => Nombre del cliente</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#cliente_ci#</span><span> => C.I. del cliente</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#cliente2_nombre#</span><span> => Nombre del segundo cliente</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#cliente2_ci#</span><span> => C.I. del segundo cliente</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#zona_lote#</span><span> => Zona del lote</span>
                    </div>
					<div class="col-md-4">
						<span class="text-red">#manzano_lote#</span><span> => Manzano del lote</span>
					</div>
                    <div class="col-md-4">
                        <span class="text-red">#numero_lote#</span><span> => N° del lote</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#superficie_lote#</span><span> => Superficie en metros cuadrados</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#colindancia_norte#</span><span> => Colindancia norte</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#colindancia_sur#</span><span> => Colindancia sur</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#colindancia_este#</span><span> => Colindancia este</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#colindancia_oeste#</span><span> => Colindancia oeste</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#precio_total#</span><span> => Precio de venta</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#cuota_inicial#</span><span> => Primera cuota</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#cuota_saldo#</span><span> => Saldo de la cuenta</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#numero_cuotas#</span><span> => Número de cuotas</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#cuota_mes#</span><span> => Monto a pagar por mes</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#fecha_venta#</span><span> => Fecha en que se realiza la venta</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#cuota_dia#</span><span> => Día de cancelación de cuota</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#nombre_usuario#</span><span> => Nombre de usuario</span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-red">#carnet_usuario#</span><span> => C.I. del usuario</span>
                    </div>
                    <!-- <div class="col-md-4">
                        <span class="text-red">##</span><span> => Día de cancelación de cuota</span>
                    </div> -->
                    <div class="col-md-12">
                        <label for="modeloc_parte1" class="control-label">Modelo Contrato</label>
                        <div class="form-group">
                            <div id="modeloc_parte1"></div>
                            <span class="text-danger"><?php echo form_error('modeloc_parte1');?></span>
                        </div>
                    </div>
                    <!-- <div class="col-md-12" id="elmodelo" style="display: none">
                        <label for="modeloc_parte2" class="control-label">Modelo Compromiso</label>
                        <div class="form-group">
                            <div id="modeloc_parte2"></div>
                            <span class="text-danger"><?php echo form_error('modeloc_parte2');?></span>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="box-footer">
                <a onclick="registrar_modelocontrato()" class="btn btn-success"><i class="fa fa-check"></i> Guardar</a>
                <a href="<?php echo site_url('modelo_contrato'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar
                </a>
            </div>
            <?php //echo form_close(); ?>
      	</div>
    </div>
</div>