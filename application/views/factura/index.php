<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/factura.js'); ?>" type="text/javascript"></script>
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="text" id="base_url" value="<?php echo base_url();?>" hidden>
<input type="hidden" id="rolusuario_asignado" name="rolusuario_asignado" value="<?php echo $rolusuario_asignado;?>">
<input type="hidden" id="parametro_tiposistema" name="parametro_tiposistema" value="<?php echo $configuracion["parametro_tiposistema"];?>">

<!--<div class="box-header">
                <h3 class="box-title">Factura</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>-->
<div class="row">
    <div class="col-md-12">
                <h3 class="box-title">LIBRO DE VENTAS</h3>
        <div class="box">

            <div class="box-header">
<!--                <div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                    <button  type="submit" class="btn btn-success btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>

                </div>-->
                
                <div class="col-md-12">
                    <!--<form action="<?php //echo site_url('factura/generar_excel'); ?>" method="POST">-->
                        
                        <div class="col-md-3">
                            <label for="desde" class="control-label">Desde:</label>
                            <div class="form-group">
                                 <input type="date"class="btn btn-warning btn-xs form-control"  id="fecha_desde" name="fecha_desde" value="<?php echo date("Y-m-d");?>">

                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="hasta" class="control-label">Hasta:</label>
                            <div class="form-group">
                                <input type="date" class="btn btn-warning btn-xs form-control"  id="fecha_hasta" name="fecha_hasta" value="<?php echo date("Y-m-d");?>">
                        
                            </div>
                        </div>
                        
                        <div class="col-md-2" hidden>
                            <label for="tipo" class="control-label">Tipo:</label>
                            <div class="form-group">
                                <select name="opcion" id="opcion" class="btn btn-warning btn-xs form-control">
                                        <option value="1">VENTAS</option>
                                        
                                </select>
                            </div>
                        </div>
                        
                <!--------------------- parametro de buscador --------------------->
<!--                  <div class="input-group">
                      <span class="input-group-addon"> 
                        Buscar 
                      </span>           
                      <input id="filtrarproducto" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código del producto" onkeypress="validar(event,6)">
                  </div>-->
            <!--------------------- fin parametro de buscador --------------------->                        
                        
                        <div class="col-md-2">
                           <label for="desde" class="control-label"> Exportar: </label>
                           <div class="form-group">
              
                                <button onclick="generarexcel()" type="button" class="btn btn-facebook btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>
                                <!--<button  type="submit" class="btn btn-facebook btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>-->
      
                            </div>
                        </div>
                        
                    
                    <!--</form>-->
                        <div class="col-md-2">
                           <label for="desde" class="control-label"> Buscar: </label>
                           <div class="form-group">
              
                               <button  type="submit" class="btn btn-danger btn-xs form-control" onclick="mostrar_facturas()"><span class="fa fa-binoculars"> </span> Ver</button>
      
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-body table-responsive" id="tabla_factura" >

        <!------------ aqui va la tabla JS con las facturas ----------------------->


</div>
    




<!------------------------ INICIO modal para confirmar anulacion de factura ------------------->
<div class="modal fade" id="modalanular" tabindex="-1" role="dialog" aria-labelledby="modalanularlabel" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center" style="background: #3399cc">
                <b style="color: white;">ANULAR FACTURA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="factura_numero" class="control-label">ADVERTENCIA: Esta a punto de eliminar la factura</label>
                </div>
                <div class="col-md-12 text-center" id="loader2" style="display:none;">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" />
                </div>
                  <input type="hidden" name="factura_id" value="00" class="form-control" id="factura_id" readonly="true" />
                  <input type="hidden" name="venta_id" value="00" class="form-control" id="venta_id" readonly="true" />

                <div class="col-md-4">
                    <label for="factura_numero" class="control-label">Factura Nº</label>
                    <div class="form-group">
                        <input type="input" name="factura_numero" value="00" class="form-control" id="factura_numero" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="factura_monto" class="control-label">Monto</label>
                    <div class="form-group">
                        <input type="input" name="factura_monto" value="0.00" class="form-control" id="factura_monto" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="factura_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="input" name="factura_fecha" value="0.00" class="form-control" id="factura_fecha" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="factura_cliente" class="control-label">Cliente</label>
                    <div class="form-group">
                        <input type="input" name="factura_cliente" value="-" class="form-control" id="factura_cliente" readonly="true"  />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="factura_correo" class="control-label">Correo Electrónico</label>
                    <div class="form-group">
                        <input type="input" name="factura_correo" value="-" class="form-control" id="factura_correo" />
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="dosificacion_nitemisor" class="control-label">Motivo Anulación</label>
                    <div class="form-group">

                        <select id="motivo_anulacion" class="form-control">

                            <?php  foreach ($motivos as $motivo) {?>

                                <option value="<?= $motivo['cma_id']; ?>"><?= $motivo['cma_descripcion']; ?></option>

                            <?php } ?>

                        </select>

                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrar"><fa class="fa fa-times"></fa> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="anular_factura_electronica()"><fa class="fa fa-floppy-o"></fa> Anular Factura</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anulacion de factura ------------------->

<!------------------------ INICIO modal para confirmar anulacion de factura no enviada ------------------->
<div class="modal fade" id="modalanular_noenviada" tabindex="-1" role="dialog" aria-labelledby="modalanularlabel" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center" style="background: #edb62b">
                <b style="color: white;">ANULAR FACTURA NO ENVIADA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="factura_numero" class="control-label">ADVERTENCIA: Esta a punto de anular la factura no enviada!.</label>
                </div>
                <div class="col-md-12 text-center" id="loadermal" style="display:none;">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" />
                </div>
                  <input type="hidden" name="facturamal_id" value="00" class="form-control" id="facturamal_id" readonly="true" />
                  <input type="hidden" name="ventamal_id" value="00" class="form-control" id="ventamal_id" readonly="true" />

                <div class="col-md-4">
                    <label for="facturamal_numero" class="control-label">Factura Nº</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_numero" value="00" class="form-control" id="facturamal_numero" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturamal_monto" class="control-label">Monto</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_monto" value="0.00" class="form-control" id="facturamal_monto" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturamal_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_fecha" value="0.00" class="form-control" id="facturamal_fecha" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="facturamal_cliente" class="control-label">Cliente</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_cliente" value="-" class="form-control" id="facturamal_cliente" readonly="true"  />
                    </div>
                </div>
                <!--<div class="col-md-12">
                    <label for="facturamal_correo" class="control-label">Correo Electrónico</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_correo" value="-" class="form-control" id="facturamal_correo" />
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="dosificacion_nitemisor" class="control-label">Motivo Anulación</label>
                    <div class="form-group">

                        <select id="motivo_anulacion" class="form-control">

                            <?php /* foreach ($motivos as $motivo) {?>

                                <option value="<?= $motivo['cma_id']; ?>"><?= $motivo['cma_descripcion']; ?></option>

                            <?php } */ ?>

                        </select>

                    </div>
                </div>-->
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrarmal"><fa class="fa fa-times"></fa> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="anular_factura_electronica_malemitida()"><fa class="fa fa-floppy-o"></fa> Anular Factura</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anulacion de factura no enviada------------------->