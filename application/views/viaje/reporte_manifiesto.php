 <!-- DataTables -->
 <link rel="stylesheet" href="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo base_url('resources/plugins/datatables.net');  ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
     <!--Styles for datatables--> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
     <!--JQuery include--> 
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
     <!--Javascrips for datatables--> 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
    
     <link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"> 

 <script>
                  $(function () {
                    $('#example1').DataTable()
                    $('#example2').DataTable({
                      'paging'      : true,
                      'lengthChange': false,
                      'searching'   : false,
                      'ordering'    : true,
                      'info'        : true,
                      'autoWidth'   : false
                    })
                  })
                  </script>
<body>
    <div class="container mt-4">
        <div class="text-center">
            <h2>Transportes La Rioja</h2>
            <!--<h5>Agencia de Viajes y Turismo</h5>-->
            <!--<p>CALLE JERUSALEN N°505 – CERCAO – AREQUIPA / RUC: 20454982470</p>-->
            <p>CONTACTOS: 77417605 RPM: 988886840 FIJO: 4511518</p>
            <h3 class="mt-4">MANIFIESTO DE PASAJEROS</h3>
        </div>
        
        <p><strong>RAZÓN SOCIAL:</strong> TRANS. LA RIOJA &nbsp;&nbsp; <strong>FECHA DE VIAJE:</strong> 12/02/2018</p>
        <p><strong>CONDUCTOR:</strong> Thomas Huayta &nbsp;&nbsp; <strong>N° LICENCIA:</strong> H30648039 &nbsp;&nbsp; <strong>N° PLACA:</strong></p>
        <p><strong>GUÍA:</strong> Walter &nbsp;&nbsp; <strong>LICENCIA:</strong> &nbsp;&nbsp; <strong>N° C.I.:</strong></p>

        <table class="table table-bordered table-striped mt-3" id="mitabla">
            <thead class="table-dark">
                <tr>
                    <th>N°</th>
                    <th>Nombre Pasajero</th>
                    <th>Pasaporte</th>
                    <th>Edad</th>
                    <th>Nacionalidad</th>
                    <th>Destino</th>
                    <th>Agencia</th>
                    <th>Observación</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>FELICITAS COLLANTES HERRERA</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>EJECUTIVO INN</td>
                    <td>TRANS. LA RIOJA</td>
                    <td>943716350</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>LUIS RISCO MONTAYA</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>EJECUTIVO INN</td>
                    <td>TRANS. LA RIOJA</td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>MARYFE RISCO COLLANTES</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>EJECUTIVO INN</td>
                    <td>TRANS. LA RIOJA</td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>CLAUDIO OVEILLE</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>HOTEL MONTECIRTO</td>
                    <td>TRANS. LA RIOJA</td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>CECILIA NOQUETE</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>CASONA TERRAZA HOTEL</td>
                    <td>TRANS. LA RIOJA</td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>DOMINIQUE PUJOL</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>CASONA TERRAZA HOTEL</td>
                    <td>TRANS. LA RIOJA</td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>SARITA ROBLES</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>COMISARIA DE YANAHUARA</td>
                    <td>TRANS. LA RIOJA</td>
                    <td>993266519 // 958802901</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>NICOL MINAYA</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>COMISARIA DE YANAHUARA</td>
                    <td>TRANS. LA RIOJA</td>
                    <td>VOUCHER</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>MARIA CHIPANA</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>COMISARIA DE YANAHUARA</td>
                    <td>TRANS. LA RIOJA</td>
                    <td>VOUCHER</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>ADOLFO LOZADA</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>COMISARIA DE YANAHUARA</td>
                    <td>TRANS. LA RIOJA</td>
                    <td>VOUCHER</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
