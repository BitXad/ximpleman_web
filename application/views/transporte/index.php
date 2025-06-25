<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa de Asientos</title>
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">-->
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

 <!--Styles for datatables--> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
 <!--JQuery include--> 
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
 <!--Javascrips for datatables--> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
 <link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"> 
 <script src="<?php echo base_url('resources/js/transporte.js'); ?>" type="text/javascript"></script>
 
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
  
  
</head>
<body>
<input type="hidden" name="cliente_id" value="0" class="form-control" id="cliente_id" >
<div class="container">
        <div class="panel panel-primary col-md-12">
            <!--<h6 class="fw-bold">DATOS DEL CLIENTE</h6>-->
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    
                    
                    <label class="form-label"> <fa class="fa fa-bus"></fa> VIAJES PROGRAMADOS</label>
                
                    
                    <select class="form-control" onchange="cargar_datosviaje();" id="select_viaje">
                        
                        <option selected value="0">- SELECCIONAR VIAJE -</option>
                        <?php foreach($viajes as $viaje){ ?>
                            <option value="<?php echo $viaje["viaje_id"];  ?>"><?php echo $viaje["ruta_nombre"]." => ".$viaje["viaje_fechasalida"]." - ".$viaje["viaje_horasalida"]." (COD.: 00".$viaje["viaje_id"].")" ?></option>
                        <?php } ?>
                        
                        
                    </select>
                    
                    <br>
                    <br>
                </div>
                <div class="col-md-3">
                    <label class="form-label">OPERACIONES</label> <br>
                    <a href="<?php base_url("venta/ultimo_pasaje"); ?>" class="btn btn-success" target="_blank"><fa class="fa fa-print"> </fa> </a>
                    <a href="http://localhost/ximpleman_web/viaje" class="btn btn-warning"  target="_blank"><fa class="fa fa-cubes"> </fa> </a>
                    <a href="http://localhost/ximpleman_web/viaje/reporte_manifiesto" class="btn btn-facebook"  target="_blank"><fa class="fa fa-list-ol"> </fa> </a>
                </div>
                <div class="col-md-3">
                    <div id="tabla_resumen">
                        
                    </div>
                <div class="col-md-3">
        </div>
    </div>
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
        <sub>MAPA DE ASIENTOS</sub>
        <div class="box" style="border-color: black;">          
            <div class="box-body table-condensed">
                <div class="table-responsive">
        
          <!---------------------- INICIO FLOTA ---------------------------------->
          <?php 
            $filas = 10;
            $columnas = 5;
            ?>

        <!--<div class="container" >-->
            <center>

            <table class="border" style="border-color: black; background-color: lightgray; ">
                <tbody id="tabla_asientos" style="display: none;">
                <tr>
                    <!--<td colspan="<?php echo $columnas; ?>">-->
                    <td>
                        <button class="btn btn-info" style="font-size: 9px;">
                            <img src="<?php echo base_url("resources/images/transporte/conductor.png"); ?>" width="30px;" height="30px;">
                            <br>conduc.
                        </button>
                    </td>
                    <td></td>
                    <td></td>

                    <td><button class="btn btn-default" style="font-size: 9px;">
                            <img src="<?php echo base_url("resources/images/transporte/libre.png"); ?>" width="30px;" height="30px;">
                        <br>Relevo
                        </button>
                    </td>

                    <td><button class="btn btn-default" style="font-size: 9px;">
                            <img src="<?php echo base_url("resources/images/transporte/libre.png"); ?>" width="30px;" height="30px;">
                        <br>Ayudante
                        </button>
                    </td>
                </tr>
                    
                <?php for ($i = 0; $i < $filas; $i++): ?>
                    <tr>
                        <?php for ($j = 0; $j < $columnas; $j++): ?>
                            <?php if ($j == 2): ?>
                                <td style="width: 1cm;"></td>
                            <?php else: ?>
                                <td>
        <!--                            <button class="seat-btn available">

                                        <?php // echo ($i + 1) . ($j + 1); ?>

                                    </button>-->
                                    <div id="<?php echo "boton".($j).($i); ?>">
                                           <?php // echo "boton" . ($j) . ($i); ?> 
                                    </div>


                                </td>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>

                </tbody>
            </table>

            </center>
        <!--</div>-->

          
          
          
          <!---------------------- FIN FLOTA ---------------------------------->

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
                                                <th>PASAJE</th>
                                                <th>PRECIO<br>Bs</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody id="tabla_reservas">
                                            
                                        </tbody>

                                       
                        </table>
                    <div id="div_boton">
                        
                    </div>
                    
                </div>        
            </div>        
        </div>        
        

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
      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
</body>


<!-- Button trigger modal -->
<div hidden>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_ventapasajes" id="boton_datos">
  modal pasaje
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_ventapasajes" tabindex="-1" role="dialog" aria-labelledby="modal_ventapasajes" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">VENTA DE PASAJES</h5>
        
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
 
      </div>
    </div>
        
        <div class="modal-footer">

          <button type="button" class="btn btn-success btn-block" data-dismiss="modal" onclick="registrar_datos_pasaje()">Registrar</button>
          <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Cerrar</button>
        </div>
        
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
<div class="modal fade" id="modal_finalizar" tabindex="-1" role="dialog" aria-labelledby="modal_finalizar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">FINALIZAR VENTA</h5>
        
      </div>
    <div class="modal-body">
        <div class="row">
  

                        <div class="col-md-4">
                          <label for="documento" class="form-label">TIPO DOC:</label>
                          <select id="select_documento" class="form-control">                  
                              <?php foreach($docs_identidad as $di){ ?> 

                                     <option value="<?= $di['cdi_codigoclasificador'] ?>" <?php echo ($di['cdi_codigoclasificador'] ==1 )?"selected":""; ?> > <?= $di['cdi_descripcion'] ?></option>

                              <?php } ?>                   
                          </select>
                        </div>

                        <div class="col-md-5">
                          <label for="documento" class="form-label">DOCUMENTO</label>
                            <div class="input-group">
                            <input class="form-control" type="text" id="numero_documento" onKeyUp="this.value = this.value.toUpperCase();" value="0"><!-- comment -->
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon"  title="Buscar por número de documento" onclick="buscarcliente()"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente" ></span></div>
                            </div>
                        </div>
                 

                        <div class="col-md-3">
                            <label for="complemento" class="form-label">COMPLE.:</label>
                            <input class="form-control" type="text" id="complemento_ci" onKeyUp="this.value = this.value.toUpperCase();"><!-- comment -->
                        </div>

                        <div class="col-md-12">
                          <label for="razon_social" class="form-label">RAZON SOCIAL</label>
                          <input class="form-control" type="text" id="razon_social" onKeyUp="this.value = this.value.toUpperCase();" value="SIN NOMBRE"><!-- comment -->
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
              <td class="text-end" style="width: 5cm;"><input type="number" class="form-control text-end" id="descuento_bs" value="0.00" onkeyup="calcular()"></td>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Función para finalizar la venta -->
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


<!-- Button trigger modal -->
<div hidden>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalopciones" id="boton_modalopciones">
  Modal opciones
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalopciones" tabindex="-1" role="dialog" aria-labelledby="modaopciones" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">OPCIONES</h5>
        
        <input type="hidden" value="0" id="venta_id">
        <input type="hidden" value="0" id="pasaje_id2">
        
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
              
                <div class="col-md-6">
                    <button class="btn btn-sm btn-warning btn-block form-control" onclick="reimprimir_pasaje()"> <fa class="fa fa-print"></fa> Reimprimir Pasaje</button>     
                    <br>
                </div>
              
             
                <div class="col-md-6">
                    <button class="btn btn-sm btn-info btn-block form-control"> <fa class="fa fa-recycle"></fa> Cambiar Asiento</button>              
                    <br>
                </div>
              
                <div class="col-md-6">
                    <button class="btn btn-sm btn-primary btn-block form-control" onclick="verificar_reserva()"> <fa class="fa fa-calendar"></fa> Ampliar Reserva</button>              
                    <br>
                </div>
              
                <div class="col-md-6">
                    <button class="btn btn-sm btn-danger btn-block form-control" onclick="anular_operacion()" data-dismiss="modal"> <fa class="fa fa-trash"></fa> Anular Operación</button>              
                    <br>
                </div>
              
                <div class="col-md-6">
                    <button class="btn btn-sm btn-success btn-block form-control"> <fa class="fa fa-cubes"></fa> Equipaje Adicional</button>              
                    <br>
                </div>
              
                <div class="col-md-6">
                    <button class="btn btn-sm btn-primary btn-block form-control" style="background-color: #000;" onclick="emitir_factura()"> <fa class="fa fa-list-alt"></fa> Emitir Factura</button>              
                    <br>
                </div>

          </div>
      </div>
      <div class="modal-footer">
          <br>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerraropciones"><fa class="fa fa-times"></fa> Cerrar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>




<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->


<!-- Button trigger modal -->
<div hidden>
    
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


<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Button trigger modal -->
<div hidden>
    
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
                    <center>
                        
                        <span id="transaccion1">TRANSACCION Nº: 4212</span>
                        <br><span id="codigoreserva1">COD. RESERVA: 42YUN12</span>
                        <br><span  id="asiento1">ASIENTO: A5</span>
                        <br><span  id="pasajero1">PASAJERO: JUAN PEREZ</span>
                        <br>
                    </center>
                </div>                
                
                
                <div class="col-md-6">
                    <label class="fw-bold"><i class="fa fa-calendar"></i> Fecha Límite:</label>
                    <input type="date" class="form-control" id="fecha_limite" min="<?php echo date("y-m-d"); ?>">
                </div>

                <div class="col-md-6">
                    <label class="fw-bold"><i class="fa fa-clock-o"></i> Hora Límite:</label>                    
                    <input type="time" class="form-control" id="hora_limite">
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa>  Cancelar</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="ampliar_reserva()"><fa class="fa fa-floppy-o"></fa> Cambiar</button>
      </div>
    </div>
  </div>
</div>


<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Button trigger modal -->
<div>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcambiarasiento">
  Modal Cambia Asiento
</button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalcambiarasiento" tabindex="-1" role="dialog" aria-labelledby="modaleliminar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">CAMBIAR ASIENTO</h5>
        
      </div>
       
      <div class="modal-body">
          <div class="row">

                <div class="col-md-6">
                    <label class="fw-bold"><fa class="fa fa-chain"></fa> Asiento:</label>
                    <input class="form-control" id="asiento_origen" value="ASIENTO 6X, PASAJE 15">
                    
               </div>

                <div class="col-md-6">
                    <label class="fw-bold"><fa class="fa fa-chain"></fa> Cambiar a:</label>
                    <select class="form-control">
                        <option>ASIENTO 5X, PASAJE 25</option>
                    </select>
                    
               </div>

              

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