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
                    
                        <div class="col-md-2">
                            <label class="control-label">Cliente:</label>
                            <div class="input-group">
                                <input type="hidden" id="cliente_id_filtro" value="0">
                                <input type="text" id="cliente_nombre_filtro" class="form-control input-sm" value="TODOS" readonly>
                                <span class="input-group-btn"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_cliente_factura"><i class="fa fa-search"></i></button></span>
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
      Anulación/Reversión en Masa
    </button>
</div>

<!-- Modal -->

<?php echo form_open('factura/anulacion_masiva'); ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>ANULACION/REVERSION EN MASA</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
            <div class="col-md-12">
                    <div class="form-group">
                        <b>ADVERTENCIA:</b> Se ANULARAN/REVERTIRAN de forma definitiva las facturas generadas por el punto de venta en uso, en la fecha seleccionada.
                    </div>
            </div>

            <div class="col-md-4">
                <label for="operacion" class="control-label">Operación</label>
                <div class="form-group">
                    <select name="operacion" id="operacion" class="form-control" onchange="mensaje_alerta()">
                        <option value="1">ANULAR FACTURAS</option>
                        <option value="2">REVERTIR ANULACION </option>
                        
                    </select>
                </div>
            </div>          
          
            <div class="col-md-4">
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
          
            <div class="col-md-4">
                    <label for="factura_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="date" name="factura_fecha" value="<?php echo date("Y-m-d"); ?>" class="form-control" id="factura_fecha" />
                    </div>
            </div>
          

          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Iniciar Proceso</button>
      </div>
    </div>
  </div>
</div>

<?php echo form_close(); ?>


<!------------------------ INICIO REVERTIR ANULACION ------------------->
<div class="modal fade" id="modalrevertir_factura" tabindex="-1" role="dialog" aria-labelledby="modalanularforzadolabel" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center" style="background: #f05b32">
                <b style="color: white;">REVERTIR ANULACION</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="factura_numeroforz" class="control-label">ADVERTENCIA: Esta a punto de anular la factura en impuestos!.</label>
                </div>
                <div class="col-md-12 text-center" id="loaderforz" style="display:none;">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" />
                </div>
                  <input type="hidden" name="facturafoorz_id2" value="00" class="form-control" id="facturaforz_id2" readonly="true" />
                  <input type="hidden" name="ventaforz_id2" value="00" class="form-control" id="ventaforz_id2" readonly="true" />

                <div class="col-md-4">
                    <label for="facturaforz_numero" class="control-label">Factura Nº</label>
                    <div class="form-group">
                        <input type="input" name="facturaforz_numero2" value="00" class="form-control" id="facturaforz_numero2" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturaforz_monto" class="control-label">Monto</label>
                    <div class="form-group">
                        <input type="input" name="facturaforz_monto2" value="0.00" class="form-control" id="facturaforz_monto2" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturaforz_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="input" name="facturaforz_fecha2" value="0.00" class="form-control" id="facturaforz_fecha2" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="facturaforz_cliente" class="control-label">Cliente</label>
                    <div class="form-group">
                        <input type="input" name="facturaforz_cliente2" value="-" class="form-control" id="facturaforz_cliente2" readonly="true"  />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="facturaforz_correo" class="control-label">Correo Electrónico</label>
                    <div class="form-group">
                        <span class="text-red" id="mensaje_correo"></span>
                        <input type="email" name="facturaforz_correo2" class="form-control" id="facturaforz_correo2" />
                    </div>
                </div>

                  <div class="col-md-12">
                    <label for="facturaforz_estado2" class="control-label">ESTADO</label>
                    <div class="form-group">
                        <span class="text-red" id="mensaje_correo"></span>
                        <input type="email" name="facturaforz_estado2" class="form-control" id="facturaforz_estado2" />
                    </div>
                </div>


<!--                <div class="col-md-12">
                    <label for="motivoforz_anulacion2" class="control-label">Motivo Anulación2</label>
                    <div class="form-group">

                        <select id="motivoforz_anulacion" class="form-control">

                            <?php  foreach ($motivos as $motivo) {?>

                                <option value="<?= $motivo['cma_id']; ?>"><?= $motivo['cma_descripcion']; ?></option>

                            <?php }  ?>

                        </select>

                    </div>
                </div>-->
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="validar_correo2()"><fa class="fa fa-recycle"></fa> Revertir Anulación</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="revertir_falsonegativo()"><fa class="fa fa-undo"></fa> Revertir Falso Negativo</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrarforz"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  REVERTIR ANULACION ------------------->
<div class="modal fade" id="modal_cliente_factura" tabindex="-1" role="dialog">
 <div class="modal-dialog modal-lg"><div class="modal-content">
  <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><i class="fa fa-users"></i> Seleccionar cliente</h4></div>
  <div class="modal-body">
   <div class="input-group"><input type="text" id="buscar_cliente_factura" class="form-control" placeholder="Buscar por nombre, CI, NIT o negocio" autocomplete="off"><span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="buscar_clientes_factura()"><i class="fa fa-search"></i> Buscar</button></span></div><br>
   <button type="button" class="btn btn-default btn-sm" onclick="seleccionar_cliente_factura(0,'TODOS')"><i class="fa fa-users"></i> TODOS LOS CLIENTES</button><br><br>
   <div class="table-responsive"><table class="table table-striped table-condensed"><thead><tr><th>Cliente</th><th>CI</th><th>NIT</th><th>Negocio</th><th></th></tr></thead><tbody id="resultado_clientes_factura"></tbody></table></div>
  </div>
 </div></div>
</div>

<style>
/* Presentación exclusiva de filtros /factura */
#panel_filtros_factura_mejorado{background:#fff;border:1px solid #dfe5ec;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.06);margin-bottom:18px;padding:18px 18px 12px}
#panel_filtros_factura_mejorado:before{content:"FILTROS DEL LIBRO DE VENTAS";display:block;font-size:12px;font-weight:700;letter-spacing:.4px;color:#52606d;margin-bottom:13px;padding-bottom:9px;border-bottom:1px solid #edf0f3}
#panel_filtros_factura_mejorado .col-md-2{margin-bottom:10px}
#panel_filtros_factura_mejorado label{font-size:12px;font-weight:700;color:#3f4d5a;margin-bottom:6px}
#panel_filtros_factura_mejorado .form-control{height:36px;border:1px solid #ccd5df;border-radius:5px;background:#fff;box-shadow:none;font-size:12px}
#panel_filtros_factura_mejorado .form-control:focus{border-color:#3c8dbc;box-shadow:0 0 0 2px rgba(60,141,188,.10)}
#panel_filtros_factura_mejorado #cliente_nombre_filtro{font-weight:600;background:#f8fafc;color:#34495e}
#panel_filtros_factura_mejorado .input-group-btn .btn{height:36px;border-radius:0 5px 5px 0}
#panel_filtros_factura_mejorado .btn{font-weight:600;border-radius:5px;height:36px}
#panel_filtros_factura_mejorado .btn-ver-factura{min-width:115px;background:#3c8dbc;border-color:#367fa9;color:#fff}
#panel_filtros_factura_mejorado .btn-ver-factura:hover{background:#367fa9;color:#fff}
#panel_filtros_factura_mejorado .btn-exportar-factura{background:#3f5f9f;border-color:#36558f;color:#fff}
#modal_cliente_factura .modal-content{border-radius:8px;overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,.18)}
#modal_cliente_factura .modal-header{background:#f7f9fb;border-bottom:1px solid #e3e8ee}
#modal_cliente_factura .modal-title{font-weight:700;color:#34495e}
#modal_cliente_factura .table thead th{background:#34495e;color:#fff;border-color:#34495e;font-size:12px}
#modal_cliente_factura .table tbody tr:hover{background:#f3f8fc}
@media(max-width:991px){#panel_filtros_factura_mejorado .col-md-2{width:50%;float:left}}
@media(max-width:600px){#panel_filtros_factura_mejorado .col-md-2{width:100%;float:none}#panel_filtros_factura_mejorado{padding:14px 12px}}
</style>
<script>
$(function(){
 var $desde=$('input[type="date"]').first(), $row=$desde.closest('.row');
 if($row.length && !$('#panel_filtros_factura_mejorado').length) $row.wrap('<div id="panel_filtros_factura_mejorado"></div>');
 var $p=$('#panel_filtros_factura_mejorado');
 $p.find('button').each(function(){var t=$.trim($(this).text()).toLowerCase();if(t==='ver'||t.indexOf(' ver')>=0)$(this).addClass('btn-ver-factura').html('<i class="fa fa-search"></i> Consultar');if(t.indexOf('excel')>=0||t.indexOf('export')>=0)$(this).addClass('btn-exportar-factura');});
});
</script>

<style>
/* Reorden visual. No altera IDs, valores ni eventos. */
#panel_filtros_factura_mejorado .row{display:flex;flex-wrap:wrap;align-items:flex-end}
#panel_filtros_factura_mejorado .filtro-desde{order:10}
#panel_filtros_factura_mejorado .filtro-hasta{order:20}
#panel_filtros_factura_mejorado .filtro-cliente{order:30;min-width:250px}
#panel_filtros_factura_mejorado .filtro-formato{order:40}
#panel_filtros_factura_mejorado .filtro-tipo{order:50}
#panel_filtros_factura_mejorado .filtro-consultar{order:60}
#panel_filtros_factura_mejorado .filtro-exportar{order:70}
#panel_filtros_factura_mejorado .filtro-consultar .btn,#panel_filtros_factura_mejorado .filtro-exportar .btn{width:100%;margin-bottom:0}
@media(min-width:992px){#panel_filtros_factura_mejorado .filtro-cliente{width:25%}#panel_filtros_factura_mejorado .filtro-consultar{width:12.5%}#panel_filtros_factura_mejorado .filtro-exportar{width:16.66666667%}}
@media(max-width:991px){#panel_filtros_factura_mejorado .row{display:block}#panel_filtros_factura_mejorado .filtro-cliente{min-width:0}}
</style>
<script>
$(function(){
 var $p=$('#panel_filtros_factura_mejorado'); if(!$p.length)return;
 $p.find('.col-md-2').each(function(){
   var $c=$(this), label=$.trim($c.find('label').first().text()).toLowerCase(), txt=$.trim($c.text()).toLowerCase();
   if(label.indexOf('desde')===0)$c.addClass('filtro-desde');
   else if(label.indexOf('hasta')===0)$c.addClass('filtro-hasta');
   else if(label.indexOf('cliente')===0)$c.addClass('filtro-cliente');
   else if(label.indexOf('formato')===0)$c.addClass('filtro-formato');
   else if(label.indexOf('tipo')===0)$c.addClass('filtro-tipo');
   else if(label.indexOf('buscar')===0||txt.indexOf('consultar')>=0||txt.indexOf('ver')>=0)$c.addClass('filtro-consultar');
   else if(label.indexOf('export')===0||txt.indexOf('exportar')>=0)$c.addClass('filtro-exportar');
 });
});
</script>
<div class="modal fade" id="modal_acciones_facturas" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-files-o"></i> Acciones sobre facturas filtradas
                </h4>
            </div>

            <div class="modal-body">
                <p>
                    Se procesarán <b id="cantidad_facturas_lote">0</b> facturas exactamente
                    en el orden del resultado filtrado.
                </p>

                <button type="button" class="btn btn-primary btn-block" onclick="accion_facturas_lote('imprimir')">
                    <i class="fa fa-print"></i> Imprimir todas consecutivamente
                </button>

                <button type="button" class="btn btn-success btn-block" onclick="accion_facturas_lote('zip')">
                    <i class="fa fa-file-archive-o"></i> Descargar PDFs individuales en ZIP
                </button>

                <button type="button" class="btn btn-danger btn-block" onclick="accion_facturas_lote('pdf')">
                    <i class="fa fa-file-pdf-o"></i> Descargar todas en un solo PDF
                </button>

                <hr>
                <small class="text-muted">
                    Las acciones utilizan el mismo filtro actual: fechas, tipo y cliente.
                </small>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var $p = $('#panel_filtros_factura_mejorado');

        if (!$p.length) {
            $p = $('input[type="date"]').first().closest('.row');
        }

        if ($p.length && !$('#btn_acciones_facturas').length) {
            var b = '<div class="col-md-2 filtro-acciones" style="margin-bottom:10px">' +
                    '<label>Facturas filtradas:</label>' +
                    '<button id="btn_acciones_facturas" type="button" class="btn btn-warning" ' +
                    'onclick="abrir_acciones_facturas()">' +
                    '<i class="fa fa-cogs"></i> Acciones masivas' +
                    '</button>' +
                    '</div>';

            if ($p.find('.row').length) {
                $p.find('.row').first().append(b);
            } else {
                $p.append(b);
            }
        }
    });
</script>