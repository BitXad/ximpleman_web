<body>
    <nav class="navbar navbar-light bg-info text-white px-4">
        <span class="navbar-brand mb-0 h1 text-white">Sistema de envío de Encomiendas</span>
        <span class="text-white">Tarea Completo</span>
    </nav>

    <div class="container mt-4">
        <h3>Nuevo paquete</h3>
        <form action="procesar_paquete.php" method="post">
            <div class="row border rounded p-3 mt-3">
                <!-- Información del remitente -->
                <div class="col-md-6">
                    <h5>Información del remitente</h5>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="remitente_nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="remitente_direccion" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">N° de celular</label>
                        <input type="text" name="remitente_celular" class="form-control">
                    </div>
                </div>

                <!-- Información del destinatario -->
                <div class="col-md-6">
                    <h5>Información del destinatario</h5>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="destinatario_nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="destinatario_direccion" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">N° de celular</label>
                        <input type="text" name="destinatario_celular" class="form-control">
                    </div>
                </div>
            </div>

            
            <div class="col-md-12">
                
 <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .sin-borde {
            border: none;
        }

        .negrita {
            font-weight: bold;
        }

        .alinear-derecha {
            text-align: right;
        }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>CANT</th>
                <th>DESCRIPCION</th>
                <th>VALOR</th>
                <th>KG</th>
                <th>PRECIO</th>
                <th>TOTAL FLETE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>CAJA DE REPUESTOS ELECTRONICOS</td>
                <td>1500 Bs</td>
                <td>3</td>
                <td>50.00</td>
                <td>150.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>PAQUETE DE DISCO DE CORTE</td>
                <td>100 Bs</td>
                <td>2</td>
                <td>35.00</td>
                <td>35.00</td>
            </tr>
            <tr>
                <td>3</td>
                <td>SOBRES</td>
                <td>1 Bs</td>
                <td>0.15</td>
                <td>10.00</td>
                <td>30.00</td>
            </tr>
            <tr>
                <td colspan="5" class="negrita">DESCUENTO Bs</td>
                <td>-</td>
            </tr>
            <tr>
                <td colspan="5" class="negrita">TOTAL Bs</td>
                <td>215.00</td>
            </tr>
        </tbody>
    </table>
                
            </div>
            
            
            
            <!-- Tipo de entrega y sucursales -->
            <div class="row border rounded p-3 mt-3">
                <div class="col-md-4">
                    <label class="form-label">Tipo</label><br>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="tipo_entrega" id="pickup" value="pickup" checked>
                        <label class="btn btn-primary" for="pickup">Pickup</label>

                        <input type="radio" class="btn-check" name="tipo_entrega" id="delivery" value="delivery">
                        <label class="btn btn-outline-primary" for="delivery">Delivery</label>
                    </div>
                    <small class="form-text text-muted">Delivery = Entregar a la dirección del destinatario, Pickup = Recoger en la sucursal más cercana</small>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Sucursal que aceptó el paquete</label>
                    <select name="sucursal_acepta" class="form-select">
                        <option selected disabled>Por favor seleccione aquí</option>
                        <option value="sucursal1">Sucursal 1</option>
                        <option value="sucursal2">Sucursal 2</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Sucursal para recoger</label>
                    <select name="sucursal_recoger" class="form-select">
                        <option selected disabled>Por favor seleccione aquí</option>
                        <option value="sucursal1">Sucursal 1</option>
                        <option value="sucursal2">Sucursal 2</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success">Guardar paquete</button>
            </div>
            
            
            
            
            
            
            
        </form>
    </div>

    <footer class="bg-light text-center text-muted mt-5 py-3">
        <small>Copyright © 2024 <a href="#">Tarea Completo</a> Todos los derechos reservados. | Versión 1.0</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>