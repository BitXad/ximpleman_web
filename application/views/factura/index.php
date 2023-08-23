<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
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
<input type="hidden" id="decimales" name="decimales" value="<?php echo $configuracion["parametro_decimales"];?>">

<!--<div class="box-header">
                <h3 class="box-title">Factura</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>-->

<table class="table" style="width: 100%; padding: 0;" >
    <tr>
        <td style="width: 20%; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 60%; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>LIBRO DE VENTAS</b></font> <br>
                <!--<font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 20%; padding: 0"> 
        </td> 

    </tr>
     
    
    
</table>

<div class="row">
    <div class="col-md-12">
<!--        <center>
            <h3 class="box-title">LIBRO DE VENTAS</h3>            
        </center>-->
        <div class="box no-print">

            <div class="box-header">
<!--                <div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                    <button  type="submit" class="btn btn-success btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>

                </div>-->
                
                <div class="col-md-12">
                    <!--<form action="<?php //echo site_url('factura/generar_excel'); ?>" method="POST">-->
                        
                        <div class="col-md-2">
                            <label for="desde" class="control-label">Desde:</label>
                            <div class="form-group">
                                 <input type="date"class="btn btn-default btn-xs form-control"  id="fecha_desde" name="fecha_desde" value="<?php echo date("Y-m-d");?>">

                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <label for="hasta" class="control-label">Hasta:</label>
                            <div class="form-group">
                                <input type="date" class="btn btn-default btn-xs form-control"  id="fecha_hasta" name="fecha_hasta" value="<?php echo date("Y-m-d");?>">
                        
                            </div>
                        </div>
                    
                        <div class="col-md-2">
                           <label for="desde" class="control-label"> Formato: </label>
                           <div class="form-group">
              
                              
                               <select type="submit" class="btn btn-default btn-xs form-control"  id="select_formato">
                                   <option value="1">R.C.V.</option>
                                   <option value="2">L.C.V.</option>
                                     
                               </select>
                               
                            </div>
                        </div>
                    
                        <div class="col-md-2">
                           <label for="desde" class="control-label"> Tipo: </label>
                           <div class="form-group">
              
                               <!--<button  type="submit" class="btn btn-info btn-xs form-control" onclick="anulacion_masiva()"><span class="fa fa-times"> </span> Anulación en Masa</button>-->
                               <select type="submit" class="btn btn-default btn-xs form-control" id="select_tipo">
                                   <option value="1">TODAS</option>
                                   <option value="2">VALIDAS</option>
                                   <option value="3">VALIDAS ANULADAS</option>
                                   <option value="4">SOLO ANULADAS</option>
                                   <option value="5">FALLAS NO ENVIDADAS</option>
                                     
                               </select>
                               
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
                    
<!--                        <div class="col-md-2">
                           <label for="desde" class="control-label"> Buscar: </label>
                           <div class="form-group">
              
                                     <button  type="submit" class="btn btn-info btn-xs form-control" onclick="anulacion_masiva()"><span class="fa fa-times"> </span> Anulación en Masa</button>
      
                            </div>
                        </div>-->
                    
                    

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
                <button type="button" class="btn btn-success" onclick="anular_factura_electronica()"><fa class="fa fa-floppy-o"></fa> Anular Factura</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrar"><fa class="fa fa-times"></fa> Cerrar</button>
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
                <button type="button" class="btn btn-success" onclick="anular_factura_electronica_malemitida()"><fa class="fa fa-floppy-o"></fa> Anular Factura</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrarmal"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anulacion de factura no enviada------------------->

<!------------------------ INICIO modal para forzar anulacion de factura en siat ------------------->
<div class="modal fade" id="modalanular_forzado" tabindex="-1" role="dialog" aria-labelledby="modalanularforzadolabel" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center" style="background: #f05b32">
                <b style="color: white;">ANULAR FACTURA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="factura_numeroforz" class="control-label">ADVERTENCIA: Esta a punto de anular la factura en impuestos!.</label>
                </div>
                <div class="col-md-12 text-center" id="loaderforz" style="display:none;">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" />
                </div>
                  <input type="hidden" name="facturafoorz_id" value="00" class="form-control" id="facturaforz_id" readonly="true" />
                  <input type="hidden" name="ventaforz_id" value="00" class="form-control" id="ventaforz_id" readonly="true" />

                <div class="col-md-4">
                    <label for="facturaforz_numero" class="control-label">Factura Nº</label>
                    <div class="form-group">
                        <input type="input" name="facturaforz_numero" value="00" class="form-control" id="facturaforz_numero" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturaforz_monto" class="control-label">Monto</label>
                    <div class="form-group">
                        <input type="input" name="facturaforz_monto" value="0.00" class="form-control" id="facturaforz_monto" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturaforz_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="input" name="facturaforz_fecha" value="0.00" class="form-control" id="facturaforz_fecha" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="facturaforz_cliente" class="control-label">Cliente</label>
                    <div class="form-group">
                        <input type="input" name="facturaforz_cliente" value="-" class="form-control" id="facturaforz_cliente" readonly="true"  />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="facturaforz_correo" class="control-label">Correo Electrónico</label>
                    <div class="form-group">
                        <span class="text-red" id="mensaje_correo"></span>
                        <input type="email" name="facturaforz_correo" class="form-control" id="facturaforz_correo" />
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="motivoforz_anulacion" class="control-label">Motivo Anulación</label>
                    <div class="form-group">

                        <select id="motivoforz_anulacion" class="form-control">

                            <?php  foreach ($motivos as $motivo) {?>

                                <option value="<?= $motivo['cma_id']; ?>"><?= $motivo['cma_descripcion']; ?></option>

                            <?php }  ?>

                        </select>

                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="validar_correo()"><fa class="fa fa-floppy-o"></fa> Anular Factura</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrarforz"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para forzar anulacion de factura en siat ------------------->

<!-- Button trigger modal -->
<div <?= ($dosificacion["dosificacion_ambiente"]==2)?"":"hidden"; ?> >
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
      Anulación en Masa
    </button>
</div>

<!-- Modal -->

<?php echo form_open('factura/anulacion_masiva'); ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>ANULACION EN MASA</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
            <div class="col-md-6">
                    <div class="form-group">
                        <b>ADVERTENCIA:</b> Se ANULARAN de forma definitiva las facturas generadas por el punto de venta en uso, en la fecha seleccionada.
                    </div>
            </div>

            <div class="col-md-6">
                <label for="docsec_codigoclasificador" class="control-label">Documento Sector</label>
                <div class="form-group">
                    <select name="docsec_codigoclasificador" id="docsec_codigoclasificador" class="form-control" onchange="mensaje_alerta()">
                        <option value="">- Documento Sector -</option>
                        <?php 
                            foreach($all_documentosector as $docsector)
                            {
                                $selected = ($docsector['docsec_codigoclasificador'] == $dosificacion['docsec_codigoclasificador']) ? ' selected="selected"' : "";
                                echo '<option value="'.$docsector['docsec_codigoclasificador'].'" '.$selected.'>'.$docsector['docsec_codigoclasificador']."-".$docsector['docsec_descripcion'].'</option>';
                            } 
                        ?>
                    </select>
                </div>
            </div>          
          
            <div class="col-md-6">
                    <label for="factura_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="date" name="factura_fecha" value="<?php //echo ($this->input->post('factura_fecha') ? $this->input->post('factura_fecha') : $factura['factura_fecha']); ?>" class="form-control" id="factura_fecha" />
                    </div>
            </div>

          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Anular las facturas</button>
      </div>
    </div>
  </div>
</div>

<?php echo form_close(); ?>