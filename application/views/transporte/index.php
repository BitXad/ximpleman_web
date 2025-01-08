<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa de Asientos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <div class="container my-4">
    <h2 class="text-center">Venta de Boletos</h2>
    <div class="row">
      <!-- Mapa de Asientos -->
      <div class="col-md-6">
        <div class="text-center mb-3">
          <button class="seat-btn driver">Cond</button>
          <button class="seat-btn assistant">Ayd</button>
        </div>
        <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn available">1</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">2</button>
            </div>
            <div class="col-3">
              <button class="seat-btn reserved">3</button>
            </div>
            <div class="col-3">
              <button class="seat-btn occupied">4</button>
            </div>
          </div>
        </div>
          
        <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn occupied">4</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">5</button>
            </div>
            <div class="col-3">
              <button class="seat-btn reserved">6</button>
            </div>
            <div class="col-3">
              <button class="seat-btn occupied">7</button>
            </div>
          </div>
        </div>

          <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn available">8</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">9</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">10</button>
            </div>
            <div class="col-3">
              <button class="seat-btn occupied">11</button>
            </div>
          </div>
        </div>
          
          <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn available">12</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">13</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">14</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">15</button>
            </div>
          </div>
        </div>
          
          
          <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn available">16</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">17</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">18</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">19</button>
            </div>
          </div>
        </div>
          
          
          <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn available">20</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">21</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">22</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">23</button>
            </div>
          </div>
        </div>
          
          <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn available">24</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">25</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">26</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">27</button>
            </div>
          </div>
        </div>
          
          <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn available">28</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">29</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">30</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">31</button>
            </div>
          </div>
        </div>
          
          <div class="d-flex justify-content-center flex-wrap">
          <!-- Fila de asientos -->
          <div class="row">
            <div class="col-3">
              <button class="seat-btn available">32</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">33</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">34</button>
            </div>
            <div class="col-3">
              <button class="seat-btn available">35</button>
            </div>
          </div>
        </div>
          
          
      </div>

      <!-- Detalle del Bus -->
      <div class="col-md-6">
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
