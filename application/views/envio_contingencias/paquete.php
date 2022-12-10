<script src="<?php echo base_url('resources/js/envio_paquete.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php // echo base_url('resources/js/emision_paquetes.js'); ?>" type="text/javascript"></script>-->
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

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->    
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="hidden" name="all_usuario" id="all_usuario" value='<?php echo json_encode($usuario); ?>' />
<input type="hidden" name="cantidad_facturas" id="cantidad_facturas" value="0">

<div class="box-header no-print">
    <h3 class="box-title">Envio de Paquetes</h3>
    <div class="box-tools">
            <a class="btn btn-danger btn-xs" onclick="mostrar_modalpaquete()" title="Envio de paquete"><span class="fa fa-chain-broken"></span> Envio de Paquetes</a>
    </div>
</div>

<!------------------------ INICIO modal para envio de varias facturas en un solo paquete ------------------->
<div class="modal fade" id="modal_allpaquetes" tabindex="-1" role="dialog" aria-labelledby="modal_allpaquetes" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">ENVIO DE PAQUETE</b>
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
                        <input type="text" name="cantotal_facturas" value="0" class="form-control" id="cantotal_facturas" />
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="enviar_paquete()"><fa class="fa fa-floppy-o"></fa> Enviar paquete</button>
                <button type="button" class="btn btn-danger" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>
<!------------------------ INICIO modal para envio de varias facturas en un solo paquete ------------------->

