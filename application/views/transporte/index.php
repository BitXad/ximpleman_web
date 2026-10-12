


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa de Asientos</title>
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">-->

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->

 <!--Styles for datatables--> 

 <!--JQuery include--> 

 <!--Javascrips for datatables--> 


 <link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"> 
 <script src="<?php echo base_url('resources/js/transporte.js'); ?>" type="text/javascript"></script>
<script src="<?php // echo base_url('resources/js/funciones.js'); ?>" type="text/javascript"></script>
<script src="<?php // echo base_url('resources/js/emision_paquetes.js'); ?>" type="text/javascript"></script>
<script src="<?php // echo base_url('resources/js/funciones_ventaifactura.js'); ?>" type="text/javascript"></script>
 
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden><!-- comment -->
  <style>
    .seat-btn {
      width: 50px;
      height: 50px;
      border-radius: 5px;
      font-size: 14px;
      font-weight: bold;
      margin: 3px;
    }
    .available {
      background-color: #28a745;
      color: white;
    }
    .occupied {
      background-color: #dc3545;
      color: white;
      cursor: not-allowed;
    }
    .reserved {
      background-color: #ffc107;
      color: white;
    }
    .driver {
      background-color: #007bff;
      color: white;
      cursor: not-allowed;
    }
    .assistant {
      background-color: #6c757d;
      color: white;
      cursor: not-allowed;
    }
    .door {
      text-align: center;
      font-size: 12px;
      font-weight: bold;
      color: #000;
      border: 2px dashed #000;
      padding: 5px;
    }
  </style>
  
  <script>
  // Función que agrega el evento "click" para seleccionar el contenido del input
  function agregarSeleccion(inputId) {
    var input = document.getElementById(inputId);
    if (input) {
      input.addEventListener('click', function() {
        this.select();
      });
    }
  }

  // Cuando el DOM esté completamente cargado, se asocian los eventos a los inputs
  document.addEventListener('DOMContentLoaded', function() {
    agregarSeleccion('documento');
    agregarSeleccion('nombre');
    agregarSeleccion('telefono');
  });
</script>
  

<style id="css-cabecera-transporte-compacta">
/* Cabecera compacta sin desperdicio de espacio */
#cabecera_transporte_compacta{
    margin-bottom:8px;
}
#cabecera_transporte_compacta .panel{
    margin-bottom:0;
}
.tx-head-grid{
    display:grid;
    grid-template-columns: 185px minmax(360px,1.7fr) minmax(170px,.8fr) minmax(170px,.8fr) auto;
    gap:8px 10px;
    align-items:end;
}
.tx-head-grid .tx-field label{
    font-size:11px;
    font-weight:bold;
    margin-bottom:4px;
    display:block;
}
.tx-head-grid .form-control{
    height:34px;
}
.tx-head-actions{
    display:flex;
    gap:5px;
    align-items:end;
    flex-wrap:wrap;
}
.tx-head-actions .btn{
    min-width:38px;
}
.tx-route-inline{
    grid-column:3 / 5;
    font-size:10px;
    color:#1672b5;
    line-height:16px;
    margin-top:-2px;
}
.tx-summary-box{
    border:1px solid #3c8dbc;
    border-radius:4px;
    background:#fff;
    padding:6px 8px;
    min-width:190px;
}
.tx-summary-table{
    width:100%;
    margin:0;
    font-size:9px;
}
.tx-summary-table td{
    border:0!important;
    padding:2px 3px!important;
    vertical-align:middle!important;
}
.tx-summary-color{
    width:11px;
    height:11px;
    display:inline-block;
    border-radius:2px;
    border:1px solid rgba(0,0,0,.18);
}
.tx-c-disponible{background:#28a745;}
.tx-c-proceso{background:#f1c40f;}
.tx-c-reservado{background:#f39c12;}
.tx-c-vendido{background:#dd4b39;}
.tx-c-cortesia{background:#3c8dbc;}
.tx-c-bloqueado{background:#95a5a6;}
.tx-c-abordado{background:#7652b5;}

@media(max-width:1100px){
    .tx-head-grid{
        grid-template-columns: 180px 1.5fr 1fr 1fr;
    }
    .tx-head-actions{
        grid-column:1 / -1;
    }
}
@media(max-width:767px){
    .tx-head-grid{
        grid-template-columns:1fr 1fr;
    }
    .tx-route-inline{
        grid-column:1 / -1;
    }
    .tx-head-actions{
        grid-column:1 / -1;
    }
}
@media(max-width:520px){
    .tx-head-grid{
        grid-template-columns:1fr;
    }
    .tx-route-inline,
    .tx-head-actions{
        grid-column:1;
    }
    .tx-head-actions .btn{
        flex:1 1 calc(50% - 5px);
    }
}
</style>


<style id="tx-p19-operativo-css">
#cabecera_transporte_compacta{width:100%;max-width:none;padding:0 15px}
#cabecera_transporte_compacta .panel{margin-bottom:8px}
.tx-head-grid{
  display:grid;
  grid-template-columns:minmax(135px,.75fr) minmax(300px,1.9fr) minmax(150px,1fr) minmax(150px,1fr);
  gap:7px 9px; align-items:end;
}
.tx-field{min-width:0}
.tx-field label{display:block;margin:0 0 3px;font-size:10px;line-height:12px;white-space:nowrap}
.tx-field .form-control{height:34px;padding:5px 8px;font-size:12px}
.tx-crew-row{
  grid-column:1 / 5; display:grid;
  grid-template-columns:minmax(220px,1fr) minmax(220px,1fr) auto minmax(220px,.95fr);
  gap:8px;align-items:stretch;margin-top:1px
}
.tx-crew-card{
  min-width:0;border:1px solid #d4dce3;background:#f8fafb;border-radius:4px;
  padding:5px 8px;display:flex;align-items:center;gap:7px;min-height:39px
}
.tx-crew-card i{font-size:17px;color:#3c668c;min-width:18px;text-align:center}
.tx-crew-label{font-size:8px;color:#65727d;line-height:9px;font-weight:bold}
.tx-crew-name{font-size:11px;font-weight:bold;color:#233746;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.tx-crew-license{font-size:8px;color:#65727d;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.tx-head-actions{display:flex;gap:4px;align-items:stretch}
.tx-head-actions .btn{min-width:37px;height:39px;padding:7px 9px}
.tx-route-inline{font-size:9px;color:#2469a0;font-weight:bold;text-align:center;padding-top:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.tx-summary-box{border:1px solid #3c8dbc;border-radius:4px;background:#fff;padding:5px 8px;min-height:86px}
@media(max-width:1200px){
  .tx-head-grid{grid-template-columns:140px minmax(260px,1.5fr) 1fr 1fr}
  .tx-crew-row{grid-template-columns:1fr 1fr auto;grid-column:1/5}
  .tx-crew-row .tx-route-inline{grid-column:1/4}
}
@media(max-width:767px){
 #cabecera_transporte_compacta{padding:0 6px}
 .tx-head-grid{grid-template-columns:1fr 1fr}
 .tx-head-grid>.tx-field:nth-child(2){grid-column:1/3}
 .tx-crew-row{grid-column:1/3;grid-template-columns:1fr 1fr}
 .tx-head-actions{grid-column:1/3}
 .tx-head-actions .btn{flex:1}
 .tx-route-inline{grid-column:1/3}
}
@media(max-width:520px){
 .tx-head-grid{grid-template-columns:1fr}
 .tx-head-grid>.tx-field:nth-child(2){grid-column:1}
 .tx-crew-row{grid-column:1;grid-template-columns:1fr}
 .tx-head-actions,.tx-route-inline{grid-column:1}
}
</style>

<input type="text" id="parametro_tiposistema" value="<?php echo $parametro['parametro_tiposistema']; ?>" name="parametro_tiposistema"  hidden>
<input type="text" id="parametro_tipoemision" value="<?php echo $parametro['parametro_tipoemision']; ?>" name="parametro_tipoemision"  hidden>
<input type="text" id="nit" value="0" name="nit"  hidden>
<input type="text" id="parametro_decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="parametro_decimales"  hidden>
<input type="hidden" name="usuario_id" id="usuario_id" value='<?php echo $usuario_id; ?>' />



<input type="hidden" name="cliente_id" value="0" class="form-control" id="cliente_id" >

<div class="container" id="cabecera_transporte_compacta">
  <div class="row" style="margin:0;">
    <div class="col-md-10" style="padding-left:0;padding-right:6px;">
      <div class="panel panel-primary" style="padding:7px 9px;">
        <div class="tx-head-grid">
          <div class="tx-field">
            <label><i class="fa fa-calendar"></i> FECHA</label>
            <input type="date" class="form-control" value="<?php echo date("Y-m-d"); ?>" onchange="buscar_viajes()" id="calendario_viaje"/>
          </div>

          <div class="tx-field">
            <label><i class="fa fa-bus"></i> VIAJES PROGRAMADOS</label>
            <select class="form-control" onchange="cargar_datosviaje();" id="select_viaje">
              <option selected value="0">- SELECCIONAR VIAJE -</option>
              <?php foreach($viajes as $viaje){ ?>
                <option value="<?php echo $viaje["viaje_id"]; ?>">
                  <?php echo "[".$viaje["vehiculo_placa"]."] ".$viaje["ruta_nombre"]." => ".$viaje["viaje_fechasalida"]." - ".$viaje["viaje_horasalida"]." [".(isset($viaje["viaje_estado_descripcion"])?$viaje["viaje_estado_descripcion"]:"HABILITADO")."] (COD.: 00".$viaje["viaje_id"].")" ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="tx-field" id="tramo_selector_box" style="display:none;">
            <label><i class="fa fa-map-marker"></i> ORIGEN</label>
            <select class="form-control" id="tramo_origen_id" onchange="cambiar_tramo_venta()"></select>
          </div>

          <div class="tx-field" id="tramo_selector_box2" style="display:none;">
            <label><i class="fa fa-flag-checkered"></i> DESTINO</label>
            <select class="form-control" id="tramo_destino_id" onchange="cambiar_tramo_venta()"></select>
          </div>

          <div class="tx-crew-row">
            <div class="tx-crew-card" title="Conductor principal asignado al viaje">
              <i class="fa fa-user"></i>
              <div style="min-width:0">
                <div class="tx-crew-label">CONDUCTOR</div>
                <div class="tx-crew-name" id="tx_conductor_nombre">SIN ASIGNAR</div>
                <div class="tx-crew-license" id="tx_conductor_licencia"></div>
              </div>
            </div>

            <div class="tx-crew-card" title="Conductor de relevo asignado al viaje">
              <i class="fa fa-users"></i>
              <div style="min-width:0">
                <div class="tx-crew-label">RELEVO</div>
                <div class="tx-crew-name" id="tx_relevo_nombre">SIN ASIGNAR</div>
                <div class="tx-crew-license" id="tx_relevo_licencia"></div>
              </div>
            </div>

            <div class="tx-head-actions">
              <button type="button" class="btn btn-success" onclick="imprimir_ultimo_pasaje()" title="Imprimir último pasaje"><i class="fa fa-print"></i></button>
              <a href="<?php echo base_url("viaje"); ?>" class="btn btn-warning" target="_blank" title="Administrar viajes"><i class="fa fa-cubes"></i></a>
              <button type="button" onclick="abrir_reportes_viaje()" class="btn btn-facebook" title="Reportes del viaje"><i class="fa fa-file-text-o"></i> <span class="hidden-xs">REPORTES</span></button>
            </div>

            <div id="tramo_seleccion_info" class="tx-route-inline"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-2" style="padding-left:0;padding-right:0;">
      <div class="tx-summary-box"><div id="tabla_resumen"></div></div>
    </div>
  </div>
</div>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>-->    
          
          
<!--<button class="btn btn-info btn-xs" onclick="cargar_vehiculo()"> <fa class="fa fa-bus"></fa> cargar asientos</button>-->
          
  <!--<div class="container my-4">-->
    <!--<h2 class="text-center">Venta de Boletos</h2>-->
<div class="row">
 <!--<div class="container" >-->   
    <div class="col-md-12">
    
      <!-- Mapa de Asientos -->
    <div class="col-md-6">
        <sub>MAPA DE ASIENTOS <button class="btn btn-xs btn-info" title="Actualizar asientos" onclick="cargar_datosviaje()"><fa class="fa fa-refresh"></fa></button></sub>
        <div class="box" style="border-color: black;">          
            <div class="box-body table-condensed">
                <div class="table-responsive">
        
          <!---------------------- INICIO FLOTA / PUNTO 19 ---------------------------------->
          <style id="tx-p19-map-css">
          .tx-p19-bus{background:#fff;border:1px solid #d8e0e6;border-radius:50px 50px 10px 10px;padding:12px;overflow:auto;max-width:100%;margin:auto}
          .tx-p19-maphead{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:8px}
          .tx-p19-floor{width:130px;height:30px;padding:3px 6px;font-size:11px}
          #tabla_asientos{display:grid;gap:5px;justify-content:center;align-items:center;min-height:100px}
          .tx-p19-cell{width:72px;height:64px;border:1px dashed transparent;border-radius:5px;display:flex;align-items:center;justify-content:center;text-align:center}
          .tx-p19-seat,.tx-p19-service{width:68px;height:60px;border:1px solid #cbd3d9;border-radius:5px;padding:3px 2px;font-size:9px;line-height:10px;display:flex;flex-direction:column;align-items:center;justify-content:center}
          .tx-p19-seat img{width:31px;height:31px;object-fit:contain;margin-bottom:1px}
          .tx-p19-seat b{font-size:10px}.tx-p19-seat small{font-size:7px}
          .tx-p19-service{background:#eceff1;color:#59636a;font-weight:bold}
          .tx-p19-service i{font-size:20px;margin-bottom:4px}
          .tx-p19-empty{width:68px;height:60px}
          @media(max-width:600px){.tx-p19-bus{padding:8px 4px}.tx-p19-cell{width:58px;height:57px}.tx-p19-seat,.tx-p19-service{width:56px;height:54px}.tx-p19-seat img{width:27px;height:27px}#tabla_asientos{gap:3px}}
          </style>
          <div class="tx-p19-maphead">
            <strong style="font-size:10px"><i class="fa fa-bus"></i> DISTRIBUCIÓN DEL VEHÍCULO</strong>
            <select class="form-control tx-p19-floor" id="nivel" onchange="cargar_datosviaje()">
              <option value="1">PISO 1</option>
              <option value="2">PISO 2</option>
            </select>
          </div>
          <div class="tx-p19-bus"><div id="tabla_asientos"></div></div>
          <!---------------------- FIN FLOTA / PUNTO 19 ---------------------------------->


            </div>
        </div>
    </div>
</div>
      
      
      
<div class="col-md-6">
          

        <!------------------------->
        <!------------------------->
        <!------------------------->
        <sub>VENTA DE PASAJES</sub>
        <div class="box" style="border-color: black;">
           
            
            <div class="box-body table-condensed table-responsive">
                <div id="tabladetalle" class="table-responsive">
                        <table class="table table-bordered table-responsive" id="mitabla">
                                        <thead class="table-dark">
                                            <tr>
                                                <!--<th>#</th>-->
                                                <th>PASAJERO</th>
                                                <th>DOC.ID.</th>
                                                <th>ASIENTO</th>
                                                <th>TRAMO</th>
                                                <th>PASAJE</th>
                                                <th>PRECIO<br>Bs</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody id="tabla_reservas">
                                            
                                        </tbody>

                                       
                        </table>
                    <div id="consolidacion_reserva_alerta" class="alert alert-warning" style="display:none; margin:8px 0; padding:8px 10px;">
                        <div class="row">
                            <div class="col-md-8">
                                <strong><i class="fa fa-link"></i> RESERVA EN CONSOLIDACIÓN</strong><br>
                                <small id="consolidacion_reserva_texto">Los pasajes reservados están cargados para completar la operación.</small>
                            </div>
                            <div class="col-md-4 text-right">
                                <button type="button" class="btn btn-danger btn-sm" onclick="cancelar_consolidacion_reserva()">
                                    <i class="fa fa-times"></i> Cancelar operación
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="consolidar_venta_id" value="0">
                    <div id="div_boton">
                        
                    </div>
                    
                </div>        
            </div>        
        </div>        
        
        <img src="<?php echo base_url("resources/images/transporte/bus.jpg") ?>" width="90%" height="90%">

      </div>
      
      
<!--<div class="col-md-6">
          
        ---------------------
        <sub>VENTAS REALIZADAS</sub>
        <div class="box" style="border-color: black;">
           
            
            <div class="box-body table-condensed table-responsive">
                <div id="tabladetalle" class="table-responsive">
                        <table class="table table-bordered table-responsive" id="mitabla">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>CLIENTE</th>
                                                <th>TOTALES</th>
                                                <th>TRANS</th>
                                                <th>TIPO</th>
                                                <th>FECHA<br>Bs</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody id="tabla_ventas">
                                            
                                        </tbody>

                                       
                        </table>
                    <div id="div_boton">
                        
                    </div>
                    
                </div>        
            </div>        
        </div>        
        

      </div>-->
      
 </div>     
 <!--</div>-->     
 </div>     
      
  
  



<!-- Button trigger modal -->
<div hidden>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_ventapasajes" id="boton_datos">
  modal pasaje
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_ventapasajes" tabindex="-1" role="dialog" aria-labelledby="modal_ventapasajes" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">DATOS DEL PASAJERO</h5>
        <div id="pasajero_lote_progreso" style="display:none;font-size:11px;margin-top:4px;">
          <span class="label label-warning">VENTA MÚLTIPLE</span>
          <span id="pasajero_lote_texto"></span>
        </div>
        
      </div>
    <div class="modal-body">
          

        <div class="row">
            
                <div class="col-md-4" hidden>
                  <label for="boleto" class="form-label">Pasaje:</label>
                  <input type="text" class="form-control" id="pasaje_id" value="" disabled>
                </div>
            
                <div class="col-md-4">
                  <label for="boleto" class="form-label">Pasaje:</label>
                  <input type="text" class="form-control" id="viaje_pasaje" value="" disabled>
                </div>
                  
                <div class="col-md-4">
                  <label for="boleto" class="form-label">Asiento:</label>
                  <input type="text" class="form-control" id="viaje_asiento" value="" disabled>
                </div>
                  
                <div class="col-md-4">
                  <label for="boleto" class="form-label">Precio:</label>
                  <!--<input type="text" class="form-control" id="viaje_nombre" value="0.00" >-->
                  <select  type="text" class="form-control" id="viaje_precio" value="0.00" >
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                  </select>
                <div class="col-md-12" id="cortesia_motivo_box" style="display:none;margin-top:8px;">
                  <div class="alert alert-warning" style="margin-bottom:8px;padding:8px;">
                    <label for="cortesiamotivo_id" style="display:block;margin-bottom:5px;">
                      <i class="fa fa-gift"></i> PASAJE DE CORTESÍA - MOTIVO *
                    </label>
                    <select id="cortesiamotivo_id" class="form-control">
                      <option value="0">-- SELECCIONE MOTIVO --</option>
                    </select>
                    <small style="display:block;margin-top:4px;">
                      La cortesía ocupa asiento, pero no genera ingreso normal.
                    </small>
                  </div>
                </div>

                      
                </div>
                  
                <div class="col-md-6">
                  <label for="documento" class="form-label">Tipo de Documento:</label>
                  <select id="select_documento" class="form-control">
                  
                      <?php foreach($docs_identidad as $di){ ?> 
                      
                             <option value="<?= $di['cdi_codigoclasificador'] ?>" <?php echo ($di['cdi_codigoclasificador'] ==1 )?"selected":""; ?> > <?= $di['cdi_descripcion'] ?></option>
                              
                      <?php } ?> 
                  
                  </select>
                </div>
                  
                <div class="col-md-6">
                  <label for="documento" class="form-label">Documento:</label>
                  <input type="text" class="form-control" id="documento" value="" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off">
                </div>
                  
       
                  <div class="col-md-8">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off">
                  </div>
 
                  <div class="col-md-4">
                    <label for="telefono" class="form-label">Teléfono(s):</label>
                    <input type="text" class="form-control" id="telefono" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off">
                  </div>

                  <div class="col-md-12" style="margin-top:8px;">
                    <label><input type="checkbox" id="pasaje_tieneequipaje_modal" onchange="$('#pasaje_equipaje_detalle_box').toggle(this.checked);"> <b><i class="fa fa-briefcase"></i> Lleva equipaje incluido</b></label>
                  </div>
                  <div class="col-md-12" id="pasaje_equipaje_detalle_box" style="display:none;">
                    <label class="form-label">Detalle de equipaje:</label>
                    <input type="text" maxlength="250" class="form-control" id="pasaje_detalleequipaje_modal" placeholder="Ej.: 1 maleta 20 kg + 1 bolso de mano" onKeyUp="this.value=this.value.toUpperCase();">
                  </div>
 
      </div>
    </div>
        
        <center>
            <div class="modal-footer">

              <button type="button" id="btn_registrar_pasaje" class="btn btn-success btn-block" onclick="registrar_datos_pasaje(); return false;"><i class="fa fa-save"></i> GUARDAR PASAJERO</button>
              <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Cerrar</button>
            </div>            
        </center>
            
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<div hidden>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_finalizar" id="boton_finalizar">
  modal finalizar
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_finalizar" tabindex="-1" role="dialog" aria-labelledby="modal_finalizar">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">FINALIZAR VENTA / DATOS DE FACTURACIÓN</h5>
        
      </div>
    <div class="modal-body">
        <div class="row">

            <div class="col-md-12">
              <div class="panel panel-info" style="margin-bottom:10px;">
                <div class="panel-heading" style="padding:6px 10px;">
                  <b><i class="fa fa-users"></i> PASAJEROS DE ESTA VENTA</b>
                  <span class="pull-right"><small>Personas que ocupan asiento</small></span>
                </div>
                <div class="panel-body" style="padding:7px 10px;">
                  <div id="resumen_pasajeros_facturacion" style="font-size:11px;">Sin pasajeros cargados.</div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="alert alert-warning" style="padding:7px 10px;margin-bottom:8px;">
                <b><i class="fa fa-file-text-o"></i> CLIENTE / RAZÓN SOCIAL DE FACTURA</b><br>
                <button type="button" class="btn btn-default btn-xs pull-right" onclick="usar_primer_pasajero_facturacion()" style="margin-top:-18px;">
                  <i class="fa fa-copy"></i> Usar primer pasajero
                </button>
              </div>
            </div>
  

                        <div class="col-md-4">
                          <label for="documento" class="form-label">TIPO DOC. FACTURA:</label>
                          <select id="doc_identidad" class="form-control">                  
                              <?php foreach($docs_identidad as $di){ ?> 

                                     <option value="<?= $di['cdi_codigoclasificador'] ?>" <?php echo ($di['cdi_codigoclasificador'] ==1 )?"selected":""; ?> > <?= $di['cdi_descripcion'] ?></option>

                              <?php } ?>                   
                          </select>
                        </div>

                        <div class="col-md-5">
                          <label for="documento" class="form-label">NIT / DOCUMENTO FACTURA</label>
                            <div class="input-group">
                            <input class="form-control" type="text" id="generar_nit" onKeyUp="this.value = this.value.toUpperCase();" value="0" onkeypress="validar_laentrada(event,1)" ><!-- comment -->
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon"  title="Buscar por número de documento" onclick="buscarcliente()"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente" ></span></div>
                            </div>
                        </div>
                 

                        <div class="col-md-3">
                            <label for="complemento" class="form-label">COMPLE.:</label>
                            <input class="form-control" type="text" id="complemento_ci" onKeyUp="this.value = this.value.toUpperCase();"><!-- comment -->
                        </div>

                        <div class="col-md-6">
                          <label for="razon_social" class="form-label">CLIENTE / RAZÓN SOCIAL</label>
                          <input class="form-control" type="text" id="generar_razon" onKeyUp="this.value = this.value.toUpperCase();" value="SIN NOMBRE"><!-- comment -->
                        </div>
            
                        <div class="col-md-6">                            
                            <label for="razon_social" class="form-label">CORREO DE FACTURACIÓN:</label>
                            <input type="email" name="elemail"  style="font-size:10pt;"  class="form-control btn btn-xs btn-warning" id="elemail" onclick="this.select()" onkeypress="validar(event,13)"/>
                        </div>

                        <div class="col-md-12" id='loader_generarfactura' style='display: none;'>
                            <center>
                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                            </center>
                        </div>
                        <div hidden>                
                            <input type="checkbox" class="form-check-input" name="codigoexcepcion" id="codigoexcepcion"><label class="btn btn-default btn-xs" for="codigoexcepcion">Código Excepción</label>
                        </div>            

                        <div class="col-md-5">
                          <label for="documento" class="form-label">OPERACION:</label>
                          <select id="select_operacion" class="form-control" onchange="mostrar_acuenta()">                  
                                     <option value="1">VENTA</option>                              
                                     <option value="2">RESERVA</option>                              
                          </select>
                        </div>

                        <div class="col-md-4">
                          <label for="documento" class="form-label">FORMA DE PAGO:</label>
                            <select id="forma_pago" name="forma_pago" class="form-control" onchange="mostrar_formapago(), mostrar('forma_pago','glosa_banco')"  style="width: 120px;" >
                                <?php
                                    foreach($forma_pago as $forma){ ?>
                                        <option value="<?php echo $forma['forma_id']; ?>"><?php echo $forma['forma_nombre']; ?></option>                                                   
                                <?php } ?>

                             </select>
                        </div>


                        <div class="col-md-3">
                            <label for="complemento" class="form-label">MAS INF..</label><br>
                            <input type="checkbox"  id="facturado" value="1" name="facturado">
                        </div>
            
                        <div class="col-md-12"><br></div>

                        <div class="col-md-12" id="datos_reserva" style="background-color: #ffc107;" hidden>
  
                                <div class="col-md-4">
                                    <label for="complemento" class="form-label">A CUENTA</label>                    
                                    <input class="form-control" type="number" id="acuenta" value="0.00" onKeyUp="this.value = this.value.toUpperCase();" 
                                           ><!-- comment -->
                                </div>
                                <div class="col-md-4">
                                    <label for="complemento" class="form-label">FECHA LIMITE</label>                    
                                    <input class="form-control" type="date" id="fechareserva" value="<?php echo date("Y-m-d"); ?>" onKeyUp="this.value = this.value.toUpperCase();"  ><!-- comment -->
                                </div>
                                <div class="col-md-4">
                                    <label for="complemento" class="form-label">HORA LIMITE</label>                    
                                    <input class="form-control" type="time" id="horareserva" 
                                           value="<?php echo (new DateTime())->modify('+2 hours')->format('H:i'); ?>" 
                                           onKeyUp="this.value = this.value.toUpperCase();">
                                    <small id="reserva_config_info" class="text-muted"></small>
                                </div>
                            <div class="col-md-12"><br></div>
                    
                        </div>


            
<!--                <div class="col-md-6">
                  <label for="documento" class="form-label">Tipo de Documento:</label>
                  <select id="select_documento" class="form-control">                  
                      <?php foreach($docs_identidad as $di){ ?> 
                      
                             <option value="<?= $di['cdi_codigoclasificador'] ?>" <?php echo ($di['cdi_codigoclasificador'] ==1 )?"selected":""; ?> > <?= $di['cdi_descripcion'] ?></option>
                              
                      <?php } ?>                   
                  </select>
                </div>-->
                <div class="row" id='loader_documento' style='display:none;'>
                    <center>
                        <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
                    </center>
                </div> 
        </div>
        
        
        <!-- Formas de Pago -->
<!--        <div class="row mb-3">
          <div class="col">
            <label class="fw-bold">FORMA DE PAGO</label>
            <select class="form-select" id="formaPago">
              <option value="Efectivo">Efectivo</option>
              <option value="Tarjeta">Tarjeta</option>
              <option value="Transferencia">Transferencia</option>
            </select>
          </div>
          <div class="col">
            <label class="fw-bold">TIPO TRANS</label>
            <select class="form-select" id="tipoTrans">
              <option value="Contado">Contado</option>
              <option value="Crédito">Crédito</option>
            </select>
          </div>
            
        </div>-->

        <!-- Tabla de Pagos -->
        <table class="table">
          <tbody>
            <tr>
              <td><strong>Total Bs</strong></td>
              <td class="text-left" style="width: 5cm; text-align: left;"><input type="text" class="form-control bg-black text-white text-end fw-bold" id="total_bs" value="66.00" readonly></td>
            </tr>
            <tr>
              <td>Descuento Bs</td>
              <td class="text-end" style="width: 5cm;">
                <div class="input-group">
                  <input type="number" class="form-control text-end" id="descuento_bs" value="0.00" readonly>
                  <span class="input-group-btn"><button type="button" class="btn btn-warning" onclick="abrir_descuento_pasaje()"><i class="fa fa-percent"></i></button></span>
                </div>
                <small id="descuento_resumen" class="text-muted">Sin descuento</small>
              </td>
            </tr>
<!--            <tr>
              <td>Total ICE</td>
              <td class="text-end"><input type="text" class="form-control text-end" id="totalICE" value="0.00" readonly></td>
            </tr>-->
            <tr>
              <td><strong>Total Final Bs</strong></td>
              <td class="text-end" style="width: 5cm;"><input type="text" class="form-control text-end fw-bold" id="total_final_bs" value="66.00" readonly></td>
            </tr>
<!--            <tr>
              <td>Tarjeta/Gift/Otros</td>
              <td class="text-end"><input type="number" class="form-control bg-warning text-end" id="tarjetaBs" value="0"></td>
            </tr>-->
            <tr>
              <td>Efectivo Bs</td>
              <td class="text-end" style="width: 5cm;"><input type="number" siza="3" class="form-control bg-warning text-end fw-bold" id="efectivo_bs" value="66.00" onkeyup="calcular()"></td>
            </tr>
            <tr>
              <td><strong>Cambio Bs</strong></td>
              <td class="text-end" style="width: 5cm;"><input type="text" class="form-control bg-black text-white text-end fw-bold" id="cambio_bs" value="0.00" readonly></td>
            </tr>
            
            
            
<!--            <tr>
                <td colspan="2">
                    <p>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <fa class="fa fa-list-ol"></fa>
                    </button>
                  </p>
                  <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        
                         <table class="table">
                            <tbody>
                              <tr>
                                  <td>
                                    <div class="row">

                                            <div class="col-md-5">
                                              <label for="documento" class="form-label">TIPO DOC:</label>
                                              <select id="select_documento" class="form-control">                  
                                                  <?php foreach($docs_identidad as $di){ ?> 

                                                         <option value="<?= $di['cdi_codigoclasificador'] ?>" <?php echo ($di['cdi_codigoclasificador'] ==1 )?"selected":""; ?> > <?= $di['cdi_descripcion'] ?></option>

                                                  <?php } ?>                   
                                              </select>
                                            </div>

                                            <div class="col-md-5">
                                              <label for="documento" class="form-label">DOCUMENTO</label>
                                              <input class="form-control" type="text" id="numero_documento" onKeyUp="this.value = this.value.toUpperCase();"> comment 
                                            </div>
                                        
                                            <div class="col-md-2">
                                              <label for="complemento" class="form-label">COMPLE.</label>
                                              <input class="form-control" type="text" id="complemento_ci" onKeyUp="this.value = this.value.toUpperCase();"> comment 
                                            </div>
                                        
                                            <div class="col-md-12">
                                              <label for="razon_social" class="form-label">RAZON SOCIAL</label>
                                              <input class="form-control" type="text" id="razon_social" onKeyUp="this.value = this.value.toUpperCase();"> comment 
                                            </div>
                                    </div>
                                        
                                </div>
                                      
                                      
                                  </td>
                              </tr>
                            </tbody>
                         </table>
                        
                    </div>
                  </div>
                    
                </td>
                  
            </tr>-->
          </tbody>
        </table>
        

      </div>
        
        <div class="col-md-12">
          <label for="glosa" class="form-label">NOTA</label>
          <input class="form-control" type="text" id="glosa" onKeyUp="this.value = this.value.toUpperCase();"><!-- comment -->
        </div>
        
        <div class="modal-footer">

          <button type="button" class="btn btn-success btn-block" data-dismiss="modal" onclick="finalizar_venta_pasaje()"><fa class="fa fa-money"></fa> Registrar</button>
          <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>
        
    </div>
  </div>
</div>



<!-- Bootstrap 5 JS -->


<!-- Función para finalizar la venta -->

<div class="modal fade" id="modal_descuento_pasaje">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header bg-yellow"><button type="button" class="close" data-dismiss="modal">&times;</button><h4><i class="fa fa-percent"></i> APLICAR DESCUENTO</h4></div>
    <div class="modal-body">
      <div class="alert alert-info" style="padding:8px">La tarifa original no se modifica. El descuento queda registrado por separado para auditoría.</div>
      <div class="row">
        <div class="col-md-4"><label>Precio original</label><input id="desc_precio_original" class="form-control" readonly></div>
        <div class="col-md-4"><label>Descuento Bs *</label><input id="desc_importe" type="number" min="0" step="0.01" class="form-control"></div>
        <div class="col-md-4"><label>Precio final</label><input id="desc_precio_final" class="form-control" readonly></div>
      </div>
      <div style="margin-top:8px"><label>Tipo de descuento *</label><select id="desc_tipo" class="form-control"><option value="0">-- CARGANDO --</option></select></div>
      <div style="margin-top:8px"><label>Motivo *</label><textarea id="desc_motivo" class="form-control" rows="3" maxlength="250" placeholder="Motivo obligatorio del descuento"></textarea></div>
      <div id="desc_aviso_auth" class="alert alert-warning" style="display:none;margin-top:8px"><i class="fa fa-lock"></i> Este tipo requiere autorización. Se validará el permiso del usuario de sesión.</div>
    </div>
    <div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancelar</button><button class="btn btn-danger" onclick="quitar_descuento_pasaje()"><i class="fa fa-times"></i> Quitar</button><button class="btn btn-success" onclick="aplicar_descuento_pasaje()"><i class="fa fa-check"></i> Aplicar descuento</button></div>
  </div></div>
</div>

<script>
  function finalizarVenta() {
    let total = parseFloat(document.getElementById("totalFinalBs").value);
    let efectivo = parseFloat(document.getElementById("efectivoBs").value);
    let tarjeta = parseFloat(document.getElementById("tarjetaBs").value);
    
    let totalPagado = efectivo + tarjeta;
    let cambio = totalPagado - total;

    document.getElementById("cambioBs").value = cambio.toFixed(2);

    if (totalPagado >= total) {
      alert("✅ Venta finalizada correctamente.");
      let modal = bootstrap.Modal.getInstance(document.getElementById("modalPago"));
      modal.hide(); // Cerrar modal después de finalizar venta
    } else {
      alert("❌ El pago no es suficiente.");
    }
  }
</script>



<!------------------------------------------------------------->
<!------------------------------------------------------------->



<!-- Button trigger modal -->
<div hidden>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_datosvehiculo" id="boton_datosvehiculo">
  Caracteristcas
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_datosvehiculo" tabindex="-1" role="dialog" aria-labelledby="modal_datosvehiculo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">DATOS VEHICULO</h5>
        
      </div>
    <div class="modal-body">
          

        <div class="row">
                
            <div class="card">
                   <div class="card-header bg-primary text-white">
                       <h4 class="mb-0">Datos del vehiculo</h4>
                   </div>
                   <div class="card-body">
                       <div class="row">
                           <div class="col-md-12">
                               <label class="fw-bold">Imagen:</label>
                               <p><?php //echo $vehiculo["vehiculo_apellidospropietario"]." ".$vehiculo["vehiculo_nombrespropietario"]; ?> </p>

                               <img src="<?php echo base_url("resources/images/transporte/".$vehiculo["vehiculo_imagen"]); ?>" width="400" height="250"> <!-- comment -->

                           </div>
                       </div>

                       <div class="row">
                           <div class="col-md-6">
                               <label class="fw-bold">Propietario:</label>
                               <p><?php echo $vehiculo["vehiculo_apellidospropietario"]." ".$vehiculo["vehiculo_nombrespropietario"]; ?> </p>
                           </div>
                           <div class="col-md-6">
                               <label class="fw-bold">Placa:</label>
                               <p><?php echo $vehiculo["vehiculo_placa"]; ?></p>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                               <label class="fw-bold">Marca:</label>
                               <p><?php echo $vehiculo["vehiculo_marca"]; ?></p>
                           </div>
                           <div class="col-md-6">
                               <label class="fw-bold">Modelo:</label>
                               <p><?php echo $vehiculo["vehiculo_modelo"]; ?></p>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                               <label class="fw-bold">Clase:</label>
                               <p><?php echo $vehiculo["vehiculo_clase"]; ?></p>
                           </div>
                           <div class="col-md-6">
                               <label class="fw-bold">Año de Fabricación:</label>
                               <p><?php echo $vehiculo["vehiculo_aniofabricacion"]; ?></p>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                               <label class="fw-bold">Color:</label>
                               <p><?php echo $vehiculo["vehiculo_color"]; ?></p>
                           </div>

                           <div class="col-md-6">
                               <label class="fw-bold">Combustible:</label>
                               <p><?php echo $vehiculo["vehiculo_tipocombustible"]; ?></p>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                               <label class="fw-bold">Número de Motor:</label>
                               <p><?php echo $vehiculo["vehiculo_numeromotor"]; ?></p>
                           </div>
                           <div class="col-md-6">
                               <label class="fw-bold">Serie:</label>
                               <p><?php echo $vehiculo["vehiculo_serie"]; ?></p>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                               <label class="fw-bold">Capacidad de Pasajeros:</label>
                               <p><?php echo $vehiculo["vehiculo_pasajeros"]; ?></p>
                           </div>
                           <div class="col-md-6">
                               <label class="fw-bold">Tipo de Servicio:</label>
                               <p><?php echo $vehiculo["vehiculo_tiposervicio"]; ?></p>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                               <label class="fw-bold">Fecha Tarjeta de Circulación:</label>
                               <p><?php echo $vehiculo["vehiculo_fechatarjeta"]; ?></p>
                           </div>
                           <div class="col-md-6">
                               <label class="fw-bold">Tarjeta de Circulación:</label>
                               <p><?php echo $vehiculo["vehiculo_tarjetacirculacion"]; ?></p>
                           </div>
                       </div>
                   </div>
               </div>
            
        </div>

                  
                <div class="mt-3" hidden>
                  <label for="estado" class="form-label">Estado:</label>
                  <select id="estado" class="form-select">
                    <option value="">Seleccione</option>
                    <option value="disponible">Disponible</option>
                    <option value="reservado">Reservado</option>
                    <option value="ocupado">Ocupado</option>
                  </select>
                </div>
                <!--<a href="http://localhost/ximpleman_web/venta/ventas" type="button" class="btn btn-success w-100 mt-3">Pagar</a>-->
              <!--</form>-->
            <!--</div>-->
          <!--</div>-->
        <!--</div>-->
      </div>
    </div>
        
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="mensaje()">Registrar</button>
        </div>
        
    </div>
  </div>

        <input type="hidden" value="0" id="venta_id">
        <input type="hidden" value="0" id="pasaje_id2">
<!-- Button trigger modal -->
<div hidden>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalopciones" id="boton_modalopciones">
  Modal opciones
</button>
</div>

<!-- Modal -->
<!-- Modal centralizado de reportes del viaje -->
<div class="modal fade" id="modal_reportes_viaje" tabindex="-1" role="dialog" aria-labelledby="titulo_reportes_viaje" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titulo_reportes_viaje"><i class="fa fa-file-text-o"></i> REPORTES DEL VIAJE</h4>
      </div>
      <div class="modal-body">
        <p class="text-muted" id="reportes_viaje_info">Seleccione el reporte que desea generar.</p>
        <div class="row">
          <div class="col-md-12"><button type="button" class="btn btn-primary btn-block" onclick="abrir_reporte_viaje('asientos')"><i class="fa fa-bus"></i> Reporte de Asientos del Bus</button><br></div>
          <div class="col-md-12"><button type="button" class="btn btn-info btn-block" onclick="abrir_reporte_viaje('pasajeros')"><i class="fa fa-users"></i> Manifiesto de Pasajeros</button><br></div>
          <div class="col-md-12"><button type="button" class="btn btn-warning btn-block" onclick="abrir_reporte_viaje('equipaje')"><i class="fa fa-suitcase"></i> Manifiesto de Equipaje</button><br></div>
          <div class="col-md-12"><button type="button" class="btn btn-success btn-block" onclick="abrir_reporte_viaje('abordaje')"><i class="fa fa-check-square-o"></i> Control / Estado de Abordaje</button></div>
        </div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button></div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalopciones" tabindex="-1" role="dialog" aria-labelledby="modalopciones" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">OPCIONES</h5>
        
        
      </div>
       

        
      <div class="modal-body">
          <div class="row">
                <div class="col-md-12">
                    <center>
                        
                        <span id="transaccion">TRANSACCION Nº 4212</span>
                        <br><span  id="asiento">ASIENTO: A5</span>
                        <br><span  id="pasajero">PASAJERO: JUAN PEREZ</span>
                        <br>
                    </center>
                </div>
              
                <!-- Documentos / comprobantes -->
                <div class="col-md-6">
                    <button class="btn btn-warning btn-block form-control" onclick="reimprimir_pasaje()"><fa class="fa fa-print"></fa> Reimprimir Comprobante</button>
                    <br>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success btn-block form-control" onclick="reimprimir_pasajes_qr()"><fa class="fa fa-qrcode"></fa> Pasajes / QR</button>
                    <br>
                </div>

                <!-- Cambios de la operación -->
                <div class="col-md-6">
                    <button class="btn btn-info btn-block form-control" onclick="cargar_asiento()" data-dismiss="modal"><fa class="fa fa-recycle"></fa> Cambiar Asiento</button>
                    <br>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block form-control" style="background-color:#605ca8;" onclick="abrir_reprogramacion()"><fa class="fa fa-calendar-plus-o"></fa> Reprogramar Viaje</button>
                    <br>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block form-control" onclick="verificar_reserva()"><fa class="fa fa-calendar"></fa> Ampliar Reserva</button>
                    <br>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block form-control" style="background-color:#979797;" onclick="consolidar_reserva()"><fa class="fa fa-cart-arrow-down"></fa> Consolidar Reserva</button>
                    <br>
                </div>

                <!-- Equipaje -->
                <div class="col-md-6">
                    <button type="button" class="btn btn-success btn-block form-control" onclick="equipaje_extra()"><fa class="fa fa-suitcase"></fa> Control de Equipaje</button>
                    <br>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block form-control" style="background-color:#833ab4;" onclick="equipaje_extra()"><fa class="fa fa-briefcase"></fa> Registrar Equipaje</button>
                    <br>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-warning btn-block form-control" onclick="reimprimir_equipaje_venta()"><fa class="fa fa-tags"></fa> Reimprimir Equipaje</button>
                    <br>
                </div>

                <!-- Facturación -->
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block form-control" style="background-color:#000;" onclick="emitir_factura()"><fa class="fa fa-list-alt"></fa> Emitir Factura</button>
                    <br>
                </div>

                <!-- Acción destructiva: aislada al final -->
                <div class="col-md-6 col-md-offset-6">
                    <button class="btn btn-danger btn-block form-control" onclick="abrir_anulacion_operacion()"><fa class="fa fa-trash"></fa> Anular Operación</button>
                    <br>
                </div>

          </div>
      </div>
      <div class="modal-footer">
          <center>
              
            <br>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerraropciones"><fa class="fa fa-times"></fa> Cerrar</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
              
          </center>
      </div>
    </div>
  </div>
</div>




<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->


<style>
/* Controles técnicos de los modales: nunca deben mostrarse en pantalla */
.transporte-trigger-modal { display: none !important; visibility: hidden !important; width: 0 !important; height: 0 !important; overflow: hidden !important; }
</style>
<!-- Trigger técnico oculto: la reserva se verifica desde el menú del asiento -->
<div class="transporte-trigger-modal" style="display:none !important;">
<button type="button" class="btn btn-primary" onclick="verificar_reserva()">Verificar Reserva</button>
</div>

<!-- Button trigger modal -->
<div class="transporte-trigger-modal" style="display:none !important;">
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaleliminar">
  Modal Anular
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="modaleliminar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">ANULAR OPERACION</h5>
        
      </div>
       
      <div class="modal-body">
          <div class="row">
              <br>
              <center>
                  <h4><b>ANULAR OPERACION <span>321 </span></b></h4>
                  
                  <input type="hidden" id="anular_venta_id" value="0" />
              </center>


          </div>
      </div>
      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa>  Cerrar</button>
        <button type="button" class="btn btn-primary"><fa class="fa fa-floppy-o"></fa> Aceptar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modal_anular_pasaje_auditado" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger" style="color:white"><button type="button" class="close" data-dismiss="modal">&times;</button><h4>ANULAR OPERACIÓN</h4></div><div class="modal-body"><div class="alert alert-danger"><b>La venta no será eliminada.</b> Quedará registrada para auditoría.</div><div class="alert alert-info" style="padding:8px 12px"><i class="fa fa-user"></i> La anulación será registrada con el usuario de la sesión actual. Se requiere el permiso <b>ANULAR VENTA DE PASAJES</b>.</div><div class="well well-sm" style="margin-bottom:10px"><b id="anular_operacion_referencia">OPERACIÓN</b></div><input type="hidden" id="anular_venta_id_auditada"><input type="hidden" id="anular_pasaje_id_auditado"><label>Motivo de anulación *</label><textarea id="anular_motivo" class="form-control" rows="3" placeholder="Indique el motivo de la anulación"></textarea></div><div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancelar</button><button class="btn btn-danger" onclick="anular_operacion()"><i class="fa fa-trash"></i> Confirmar anulación</button></div></div></div></div>
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Trigger técnico oculto -->
<div class="transporte-trigger-modal" style="display:none !important;">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalampliarreserva" id="boton_ampliarreserva">
  Modal Ampliar Reserva
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalampliarreserva" tabindex="-1" role="dialog" aria-labelledby="modalampliarreserva" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">AMPLIAR RESERVA</h5>
        
      </div>
       
      <div class="modal-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default" style="margin-bottom:15px; border-color:#d9e2ea;">
                        <div class="panel-heading" style="padding:8px 12px; background:#f5f8fa;">
                            <strong><i class="fa fa-ticket"></i> DATOS DE LA RESERVA</strong>
                        </div>
                        <div class="panel-body" style="padding:10px 12px;">
                            <div class="row" style="margin-bottom:7px;">
                                <div class="col-xs-6 col-sm-3">
                                    <small class="text-muted">TRANSACCIÓN</small><br>
                                    <strong id="transaccion1">-</strong>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <small class="text-muted">CÓD. RESERVA</small><br>
                                    <strong id="codigoreserva1">-</strong>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <small class="text-muted">PASAJE Nº</small><br>
                                    <strong id="pasaje1">-</strong>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <small class="text-muted">ASIENTO</small><br>
                                    <strong id="asiento1">-</strong>
                                </div>
                            </div>
                            <hr style="margin:8px 0;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <small class="text-muted">PASAJERO</small><br>
                                    <strong id="pasajero1">-</strong>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <small class="text-muted">DOCUMENTO</small><br>
                                    <strong id="documento_reserva1">-</strong>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <small class="text-muted">TELÉFONO</small><br>
                                    <strong id="telefono_reserva1">-</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-bottom:8px;">
                    <strong><i class="fa fa-clock-o"></i> NUEVO LÍMITE DE LA RESERVA</strong>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold"><i class="fa fa-calendar"></i> Fecha Límite:</label>
                    <input type="date" class="form-control" id="fecha_limite" min="<?php echo date("Y-m-d"); ?>">
                </div>

                <div class="col-md-6">
                    <label class="fw-bold"><i class="fa fa-clock-o"></i> Hora Límite:</label>                    
                    <input type="time" class="form-control" id="hora_limite">
                </div>
                <div class="col-md-12" style="margin-top:12px;">
                    <label><i class="fa fa-comment"></i> Motivo de la extensión:</label>
                    <textarea class="form-control" id="motivo_extension_reserva" rows="2" placeholder="Motivo obligatorio"></textarea>
                </div>
                <div class="col-md-6" style="margin-top:10px;">
                    <label><i class="fa fa-user-secret"></i> Usuario autorizador:</label>
                    <input type="text" class="form-control" id="autoriza_login_reserva" autocomplete="off">
                </div>
                <div class="col-md-6" style="margin-top:10px;">
                    <label><i class="fa fa-key"></i> Clave autorizador:</label>
                    <input type="password" class="form-control" id="autoriza_clave_reserva" autocomplete="new-password">
                </div>
                <div class="col-md-12" style="margin-top:8px;">
                    <small class="text-muted"><i class="fa fa-lock"></i> La extensión queda registrada con usuario solicitante, autorizador, motivo y límites anterior/nuevo.</small>
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa>  Cancelar</button>
        <button type="button" class="btn btn-success" onclick="ampliar_reserva()"><fa class="fa fa-floppy-o"></fa> Cambiar</button>
      </div>
    </div>
  </div>
</div>


<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Button trigger modal -->
<div class="transporte-trigger-modal" style="display:none !important;">
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcambiarasiento">
  Modal Cambia Asiento
</button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalcambiarasiento" tabindex="-1" role="dialog" aria-labelledby="tituloModalCambiarAsiento" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:650px;">
    <div class="modal-content transporte-modal-cambio">
      <div class="modal-header bg-primary" style="border-radius:5px 5px 0 0; color:#fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff;opacity:.9;">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="tituloModalCambiarAsiento">
          <i class="fa fa-exchange"></i> CAMBIAR ASIENTO
        </h4>
      </div>

      <div class="modal-body" style="padding:18px 20px 10px;">
        <div class="alert alert-info" style="margin-bottom:15px;padding:10px 12px;">
          <i class="fa fa-user"></i>
          <strong id="cambio_pasajero">PASAJERO</strong>
          <span id="cambio_documento" class="pull-right"></span>
          <div class="clearfix"></div>
        </div>

        <div class="row">
          <div class="col-sm-5">
            <div class="panel panel-default" style="margin-bottom:12px;">
              <div class="panel-heading" style="padding:8px 10px;">
                <strong><i class="fa fa-map-marker"></i> ASIENTO ACTUAL</strong>
              </div>
              <div class="panel-body text-center" style="padding:14px 10px;">
                <div id="cambio_asiento_actual" style="font-size:25px;font-weight:bold;line-height:1.1;">--</div>
                <div id="cambio_detalle_actual" class="text-muted" style="margin-top:6px;font-size:12px;"></div>
                <input type="hidden" id="asiento_origen" value="">
              </div>
            </div>
          </div>

          <div class="col-sm-2 text-center hidden-xs" style="padding-top:38px;">
            <i class="fa fa-long-arrow-right fa-2x text-primary"></i>
          </div>

          <div class="col-sm-5">
            <div class="panel panel-primary" style="margin-bottom:12px;">
              <div class="panel-heading" style="padding:8px 10px;">
                <strong><i class="fa fa-bus"></i> NUEVO ASIENTO</strong>
              </div>
              <div class="panel-body" style="padding:12px 10px;">
                <label for="select_asientoslibres" style="font-size:12px;">Seleccione un asiento libre:</label>
                <select class="form-control" id="select_asientoslibres">
                  <option value="0">-- ASIENTOS LIBRES --</option>
                </select>
                <div id="cambio_nuevo_detalle" class="text-primary text-center" style="font-weight:bold;margin-top:9px;min-height:17px;"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row" style="margin-top:5px;">
          <div class="col-sm-7">
            <label for="motivo_cambio_asiento"><i class="fa fa-comment"></i> Motivo del cambio:</label>
            <textarea class="form-control" id="motivo_cambio_asiento" rows="2" maxlength="250" placeholder="Motivo obligatorio"></textarea>
          </div>
          <div class="col-sm-5">
            <div class="panel panel-default" style="margin-bottom:8px;">
              <div class="panel-heading" style="padding:6px 10px;"><strong>DIFERENCIA DE PRECIO</strong></div>
              <div class="panel-body text-center" style="padding:8px 10px;">
                <strong id="cambio_diferencia_precio" style="font-size:18px;">Bs 0.00</strong><br>
                <small id="cambio_precio_referencia" class="text-muted">Seleccione el nuevo asiento</small>
              </div>
            </div>
          </div>
        </div>

        <div id="cambio_asiento_aviso" class="alert alert-warning" style="padding:9px 12px;margin:3px 0 8px;">
          <i class="fa fa-info-circle"></i>
          El pasajero conservará su venta/reserva. La diferencia se registra para auditoría; el precio ya cobrado no se modifica automáticamente.
        </div>
      </div>

      <div class="modal-footer" style="padding:12px 20px;">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          <i class="fa fa-times"></i> Cancelar
        </button>
        <button type="button" class="btn btn-success" id="btn_confirmar_cambio_asiento" onclick="cambiar_asiento()" disabled>
          <i class="fa fa-check"></i> Confirmar cambio
        </button>
      </div>
    </div>
  </div>
</div>

<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modalequipaje" tabindex="-1" role="dialog" aria-labelledby="modalequipaje" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">REGISTRAR EQUIPAJE INCLUIDO / GRATUITO</h5>
        
      </div>
       
<!--        <input type="text" id="asiento_idcambio">
        <input type="text" id="pasaje_idcambio">-->
        
      <div class="modal-body">
          <div class="row">

                <div class="col-md-12">
                    <label class="fw-bold"><fa class="fa fa-paperclip"></fa> Descripción del equipaje incluido:</label>
                    <input class="form-control" id="detalle_equipaje" value="" placeholder="EJ.: MALETA NEGRA" onKeyUp="this.value = this.value.toUpperCase();">
                    <small class="text-muted">Este registro corresponde al equipaje incluido en el pasaje y no genera cobro.</small>
                    
               </div>
<!--
                <div class="col-md-6">
                    <label class="fw-bold"><fa class="fa fa-chain"></fa> Cambiar a:</label>
                    <select class="form-control" id="select_asientoslibres">
                        <option>ASIENTO 5X, PASAJE 25</option>
                    </select>
                    
               </div>-->

              

          </div>
      </div>
      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa>  Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_guardar_equipaje_rapido" onclick="registrar_equipaje()"><fa class="fa fa-floppy-o"></fa> Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- --------------- INICIO modal Advertencia ---------------------------------->
    
<!-- --------------- INICIO modal Advertencia ---------------------------------->
<!-- --------------- INICIO modal Advertencia ---------------------------------->
<div id="modal_mensajeadvertencia" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #CC660E">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"><fa class="fa fa-frown-o"></fa><b> ADVERTENCIA</b></h2>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
            <label for="monto_caja" class="control-label">
                <h2 class="modal-title">
                    <fa class="btn btn-default fa fa-exclamation-triangle fa-2x"> </fa><b><span id="mensajeadvertencia"></span></b>
                </h2>
            </label>
        </div>  
          
        <div class="col-md-4">
            <!--<button class="btn btn-default btn-block" onclick="codigo_excepcion()"><fa class="fa fa-arrow-right"></fa> Continuar</button>-->
            <button class="btn btn-success btn-block" data-dismiss="modal" onclick="excepcion_nit()" id="boton_advertencia" style="line-height: 10px;"><fa class="fa fa-save"></fa> <b>FORZAR FACTURA</b><br><small>CON COD. DE EXCEPCIÓN</small></button>
            <button class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelar_excepcion_nit()"  style="line-height: 10px;"><fa class="fa fa-times"></fa> <b>CORREGIR NIT</b><br><small>CAMBIAR TIPO DOC.</small></button>
            <button class="btn btn-info btn-block" data-dismiss="modal" onclick="seleccionar_ci()"  style="line-height: 10px;"><fa class="fa fa-recycle"></fa> <b>EL DOC. ES C.I.</b><br><small>CAMBIAR A C.I.</small></button>
        </div>  
      
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- --------------- F I N  modal Advertencia ---------------------------------->
<!-- --------------- F I N  modal Advertencia ---------------------------------->



<!-- ************************************************************************************* -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modalconsolidarreserva" tabindex="-1" role="dialog" aria-labelledby="modalconsolidarreserva" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">CONSOLIDAR RESERVA</h5>
        
      </div>
       
<!--        <input type="text" id="asiento_idcambio">
        <input type="text" id="pasaje_idcambio">-->
        
        
      <div class="modal-body">
          <div class="row">

                <div class="col-md-6">
                    <label class="fw-bold"><fa class="fa fa-chain"></fa> COD. RESERVA:</label>
                    <input class="form-control" id="consolidar_asiento_origen" value="ASIENTO 6X, PASAJE 15">
                    
               </div>

                <div class="col-md-6">
                    <label class="fw-bold"><fa class="fa fa-chain"></fa> Cambiar a:</label>
                    <select class="form-control" id="consolidar_estado_reserva">
                        <option>VENDIDO</option>
                    </select>
                    
               </div>

              

          </div>
      </div>
      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa>  Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="cambiar_asiento()"  data-dismiss="modal"><fa class="fa fa-floppy-o"></fa> Aceptar</button>
      </div>
    </div>
  </div>
</div>


<!-- ************************************************************************************* -->


<!-- Modal de impresión posterior a la venta -->
<div class="modal fade" id="modal_impresion_postventa" tabindex="-1" role="dialog" aria-labelledby="tituloImpresionPostventa" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:560px;">
    <div class="modal-content">
      <div class="modal-header bg-primary" style="color:#fff;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:.9;">&times;</button>
        <h4 class="modal-title" id="tituloImpresionPostventa"><i class="fa fa-print"></i> IMPRESIÓN DE LA VENTA</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="postventa_impresion_venta_id" value="0">
        <div class="alert alert-success text-center" style="margin-bottom:15px;">
          <strong>VENTA REGISTRADA CORRECTAMENTE</strong><br>
          <span id="postventa_impresion_numero">VENTA Nº 0</span>
        </div>
        <p class="text-center">Seleccione el documento que desea imprimir:</p>
        <div class="row">
          <div class="col-sm-6">
            <button type="button" class="btn btn-primary btn-block" style="min-height:78px;" onclick="imprimir_comprobante_venta()">
              <i class="fa fa-file-text-o fa-2x"></i><br>
              <strong>COMPROBANTE DE VENTA</strong><br>
              <small>Resumen compacto de la operación</small>
            </button>
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-success btn-block" style="min-height:78px;" onclick="imprimir_pasajes_qr()">
              <i class="fa fa-qrcode fa-2x"></i><br>
              <strong>PASAJES / QR</strong><br>
              <small>Un pasaje individual por viajero</small>
            </button>
          </div>
        </div>
        <div class="alert alert-info" style="margin-top:15px;margin-bottom:0;padding:8px 12px;">
          <i class="fa fa-info-circle"></i> El comprobante no imprime QR. Cada pasaje de abordaje lleva su QR individual y código de respaldo.
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal formal de reprogramación / cambio de viaje -->
<div class="modal fade" id="modalreprogramacion" tabindex="-1" role="dialog" aria-labelledby="tituloReprogramacion" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:760px;">
    <div class="modal-content">
      <div class="modal-header bg-primary" style="color:#fff;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:.9;">&times;</button>
        <h4 class="modal-title" id="tituloReprogramacion"><i class="fa fa-calendar"></i> REPROGRAMAR PASAJE / CAMBIO DE VIAJE</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-info" style="padding:9px 12px;">
          <strong id="reprog_pasajero">PASAJERO</strong><br>
          <span id="reprog_viaje_actual">Viaje actual</span> · <span id="reprog_asiento_actual">Asiento</span> · <strong id="reprog_precio_pagado">Bs 0.00</strong>
        </div>
        <div class="row">
          <div class="col-md-8">
            <label>Nuevo viaje:</label>
            <select id="reprog_viaje_destino" class="form-control"><option value="0">-- SELECCIONE VIAJE --</option></select>
          </div>
          <div class="col-md-4">
            <label>Nuevo asiento:</label>
            <select id="reprog_asiento_destino" class="form-control" disabled><option value="0">-- ASIENTO --</option></select>
          </div>
          <div class="col-md-3" style="margin-top:10px;"><label>Precio pagado:</label><input id="reprog_precio_original" class="form-control" readonly></div>
          <div class="col-md-3" style="margin-top:10px;"><label>Nuevo precio:</label><input id="reprog_precio_nuevo" class="form-control" readonly></div>
          <div class="col-md-3" style="margin-top:10px;"><label>Penalidad Bs:</label><input id="reprog_penalidad" type="number" min="0" step="0.01" value="0.00" class="form-control"></div>
          <div class="col-md-3" style="margin-top:10px;"><label>Ajuste total:</label><input id="reprog_ajuste_total" class="form-control" readonly value="0.00"></div>
          <div class="col-md-6" style="margin-top:10px;">
            <label>Tratamiento de diferencia:</label>
            <select id="reprog_tipo_ajuste" class="form-control"><option value="SIN_AJUSTE">SIN AJUSTE</option></select>
          </div>
          <div class="col-md-6" style="margin-top:10px;">
            <label>Forma de pago del ajuste:</label>
            <select id="reprog_forma_pago" class="form-control"></select>
            <label style="margin-top:5px;font-weight:normal;"><input type="checkbox" id="reprog_mantener_forma" checked> Mantener forma de pago original (<span id="reprog_forma_original">-</span>)</label>
          </div>
          <div class="col-md-12" style="margin-top:10px;">
            <label>Motivo:</label><textarea id="reprog_motivo" class="form-control" rows="2" placeholder="Motivo obligatorio de la reprogramación"></textarea>
          </div>
        </div>
        <div class="alert alert-warning" style="margin-top:12px;margin-bottom:0;padding:8px 10px;">
          <i class="fa fa-history"></i> El viaje y pago originales se conservarán en el historial. La venta original no se elimina ni se modifica económicamente.
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="button" class="btn btn-success" id="btn_reprogramar_pasaje" onclick="confirmar_reprogramacion()" disabled><i class="fa fa-check"></i> Confirmar reprogramación</button>
      </div>
    </div>
  </div>
</div>
