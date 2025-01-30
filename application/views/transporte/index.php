<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa de Asientos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
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
</head>
<body>

<div class="container mt-3">
        <div class="card p-3 shadow-sm">
            <!--<h6 class="fw-bold">DATOS DEL CLIENTE</h6>-->
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <label class="form-label"> <fa class="fa fa-bus"></fa> VIAJES PROGRAMADOS</label>
                
                    
                    <select class="form-select" onchange="cargar_datosviaje();" id="select_viaje">
                        
                        <option selected value="0">- SELECCIONAR VIAJE -</option>
                        <?php foreach($viajes as $viaje){ ?>
                            <option value="<?php echo $viaje["viaje_id"];  ?>"><?php echo $viaje["ruta_nombre"]." => ".$viaje["viaje_fechasalida"]." - ".$viaje["viaje_horasalida"] ?></option>
                        <?php } ?>
                        
                        
                    </select>
                    
                </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>    
          
          
<!--<button class="btn btn-info btn-xs" onclick="cargar_vehiculo()"> <fa class="fa fa-bus"></fa> cargar asientos</button>-->
          
  <div class="container my-4">
    <!--<h2 class="text-center">Venta de Boletos</h2>-->
    <div class="row">
      <!-- Mapa de Asientos -->
      <div class="col-md-6">
          <!---------------------- INICIO FLOTA ---------------------------------->
          <?php 
$filas = 10;
$columnas = 5;
?>
          
<div class="container" >
    <table class="border" style="border-color: black; background-color: lightgray; ">
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
        
    </table>
</div>

          
          
          
          <!---------------------- FIN FLOTA ---------------------------------->

          
      </div>
      
      
      
      <div class="col-md-6">
          

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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Button trigger modal -->
<div hidden>

    <button type="button_modal" id="button_modal" class="btn btn-primary" data-toggle="modal" data-target="#modalpasaje">
      venta pasajes
    </button>    
    
</div>
    

<!-- Modal -->
<div class="modal fade" id="modalpasaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Venta de pasaje</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>
        
      <div class="modal-body">
          
      <!-- Detalle del Bus -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-primary text-white">
            Detalle de Bus Cochabamba - La Paz
          </div>
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label for="boleto" class="form-label">BOLETO:</label>
                <input type="text" class="form-control" id="boleto" value="100 - 000017" disabled>
              </div>
              <div class="mb-3">
                <label for="documento" class="form-label">Tipo de Documento:</label>
                <select id="documento" class="form-select">
                  <option value="">Seleccione</option>
                  <option value="dni">C.I.</option>
                  <option value="pasaporte">Pasaporte</option>
                  <option value="pasaporte">Otro</option>
                </select>
              </div>
              <div class="row">
                <div class="col-6">
                  <label for="nombre" class="form-label">Nombres:</label>
                  <input type="text" class="form-control" id="nombre">
                </div>
                <div class="col-6">
                  <label for="apellido" class="form-label">Apellidos:</label>
                  <input type="text" class="form-control" id="apellido">
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-6">
                  <label for="destino" class="form-label">Destino:</label>
                  <select id="destino" class="form-select">
                    <option value="">Seleccione</option>
                    <option value="huacho">La Paz</option>
                    <option value="lima">Santa Cruz</option>
                  </select>
                </div>
                <div class="col-6">
                  <label for="precio" class="form-label">Precio:</label>
                  <input type="text" class="form-control" id="precio">
                </div>
              </div>
              <div class="mt-3">
                <label for="estado" class="form-label">Estado:</label>
                <select id="estado" class="form-select">
                  <option value="">Seleccione</option>
                  <option value="disponible">Disponible</option>
                  <option value="reservado">Reservado</option>
                  <option value="ocupado">Ocupado</option>
                </select>
              </div>
              <!--<button type="button" class="btn btn-success w-100 mt-3">Pagar</button>-->
              <a href="http://localhost/ximpleman_web/venta/ventas" type="button" class="btn btn-success w-100 mt-3">Pagar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

          
          
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>
