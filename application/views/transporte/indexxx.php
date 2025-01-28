<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de Boletos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .seat-map {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 5px;
        }
        .seat {
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .seat.taken {
            background-color: #dc3545;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">VENTAS DE BOLETOS</h2>
        
        <div class="row">
            <!-- Mapa de Asientos -->
            <div class="col-md-4">
                <center>
                    
                    <h3><b>SELECCION DE ASIENTOS</b></h3><br>
                    <div class="seat-map">
                        <!-- Asientos generados dinámicamente -->
                        <?php for ($i = 1; $i <= 50; $i++): ?>
                            <div class="seat" onclick="selectSeat(<?php echo $i; ?>)"><?php echo $i; ?></div>
                        <?php endfor; ?>
                    </div>
                    
                </center>
            </div>
            
            
            
            <!-- Formulario de Venta -->
            <div class="col-md-8">
                <h5>Detalle de Bus Huacho - Lima</h5>
                <div class="card">
                    <div class="card-header">Venta de Boletos</div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Tipo Documento:</label>
                                <select class="form-select">
                                    <option>DNI</option>
                                    <option>Pasaporte</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">N° Documento:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombres:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Apellidos:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Destino:</label>
                                <select class="form-select">
                                    <option>Seleccione</option>
                                    <option>Huacho</option>
                                    <option>Lima</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Precio:</label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Estado:</label>
                                <select class="form-select">
                                    <option>Seleccione</option>
                                    <option>Reservado</option>
                                    <option>Pagado</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Pagar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function selectSeat(seatNumber) {
            alert('Asiento seleccionado: ' + seatNumber);
        }
    </script>
</body>
</html>
