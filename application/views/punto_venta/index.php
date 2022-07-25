<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
<script type="text/javascript">
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

<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<div class="box-header" style="padding-left: 0px">
    <font size='4' face='Arial'><b>Puntos de Venta</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <span id="encontrados">0</span></font>
    <div class="box-tools no-print" style="display: none" id="pventa_cero">
        <a class="btn btn-success btn-sm" onclick="modal_puntoventa()" title="Registrar punto de venta 0"><fa class='fa fa-pencil-square-o'></fa> Registrar Punto de Venta</a> 
    </div>
</div>

<div class="box-header">
    <!--<h3 class="box-title">Dosificación</h3>-->
    <!--<button class="btn btn-info btn-xs" onclick="verificarComunicacion()"><fa class="fa fa-chain"></fa> Verificar Conexión</button>-->
    <!--<a class="btn btn-danger btn-xs" onclick="registroFirmaRevocada()"><fa class="fa fa-chain-broken"></fa> Firma Rebocada</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="cierre_OperacionesSistema()"><fa class="fa fa-briefcase"></fa> Cierre de Operaciones</a>-->
    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventa()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="consulta_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Puntos de Venta</a>
    <a class="btn btn-warning btn-xs" onclick="cierre_PuntoVenta()"><fa class="fa fa-cart-arrow-down"></fa> Cierre Punto de Venta</a>
    <!--<a class="btn btn-warning btn-xs" onclick="consulta_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Consulta Evento Significativo</a>-->
    <!--<a class="btn btn-warning btn-xs" onclick="registro_EventoSignificativo()"><fa class="fa fa-cart-arrow-down"></fa> Registro de Evento Significativo</a>-->
    <a class="btn btn-warning btn-xs" onclick="mostrar_modalregistrarpuntoventacomisionista()"><fa class="fa fa-cart-arrow-down"></fa> Registrar Punto de Venta Comisionista</a>
    
</div>
<div class="row no-print">    
    <div class="row col-md-12" id='loader_revocado' style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
</div>
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
<div class="modal fade" id="modal_puntoventa_cero" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="text-align: center !important">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span style="font-size: 16px"><b> REGISTRAR PUNTO DE VENTA 0</b></span>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                    <span class="text-danger" id="mensaje"></span>
                    <label for="codigoTipoPuntoVenta0" class="control-label">Tipo Punto de Venta</label>
                    <div class="form-group">
                        <select name="codigoTipoPuntoVenta0" class="form-control" id="codigoTipoPuntoVenta0">
                            <option value="0"> PUNTO DE VENTA 0 </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="text-danger" id="mensaje"></span>
                    <label for="cuis0" class="control-label">CUIS</label>
                    <div class="form-group">
                        <input type="text" name="cuis0" class="form-control" id="cuis0" required />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="nombrePuntoVenta0" class="control-label">Nombre de Punto de Venta</label>
                    <div class="form-group">
                        <input type="text" name="nombrePuntoVenta0" class="form-control" id="nombrePuntoVenta0" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="descripcion0" class="control-label">Descripción</label>
                    <div class="form-group">
                         <input type="text" name="descripcion0" class="form-control" id="descripcion0" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <!--<div class="col-md-4 text-center">-->
                    <button class="btn btn-success" onclick="registroPuntoVenta_cero()"><fa class="fa fa-check"></fa> Registrar</button>
                <!--</div>-->
                <!--<div class="col-md-4 text-center">-->
                    <button class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
                    <thead>
                        <tr role="row">
                            <th >#</th>
                            <th>C&oacute;digo</th>
                            <th>Tipo Punto de Venta</th>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
                            <th>CUIS</th>
                            <th>Fecha Vigencia<br>CUIS</th>
                            <th>CUFD</th>
                            <th>Fecha Vigencia<br>CUFD</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tabla_puntos_venta"></tbody>
                </table>
            </div>             
        </div>
    </div>
</div>
<script>
    window.onload = function(){
        dibujar_tabla_puntos_venta();
    }
</script>

<!--<script src="<?php echo base_url('resources/js/verificar_conexion.js'); ?>"></script>-->
<style type="text/css">
    .online, .offline{
      display: inline-block;
      padding: 0.5rem;
      border-radius: 5px;
      margin: 1rem;
    }

    .online{
      border: 3px solid green;
      color: green;
    }

    .offline{
      border: 3px solid red;
      color: red;
    }
</style>

<p id="status" class="online">online</p>
