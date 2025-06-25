<!DOCTYPE html>
<html>
  <head>
    <title>Negocios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      #map{
        width: 100%; 
        height: 600px;
      }
    </style>
  </head>
  <body>
      <div class="container">
          <h4><b>ZONA: <?php if(isset($zona["zona_nombre"])){ echo $zona["zona_nombre"]; }else{ echo "TODAS"; } ?>, CLIENTES: <?php echo sizeof($all_cliente); ?></b>
          <a href="javascript:location.reload()" class="btn btn-danger btn-sm"><span class="fa fa-map-marker"></span> Actualizar visitas</a>
          </h4>
          <div class="col col-md-12 table-responsive">
              <table class="table">
              <tr> 
                      <td> 
                       
                        <div id="map"></div> <!-- mapa --> 
                         
                        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                        
                        <div id="map" style="height: 500px;"></div>

                        <script>
                            // Coordenada inicial del mapa
                            var coordenadas = [-17.4038, -66.1635];

                            // Puntos a ser marcados en el mapa
                            var puntos = [];
                            var link2 = '<?php echo base_url().'pedido/pedidoabierto/'; ?>';
                            var punto;
                            var contenido = '';

                            <?php $i = 0;
                            foreach($all_cliente as $p){ ?>
                                punto = ['<?php echo $p['cliente_nombre']."(".$p['cliente_codigo'].")"; ?>',
                                         '<?php echo $p['cliente_latitud']; ?>',
                                         '<?php echo $p['cliente_longitud']; ?>',
                                         '<?php echo $p['cliente_direccion']; ?>',
                                         '<?php echo $p['cliente_id']; ?>',
                                         '<?php echo $p['cliente_visitado']; ?>'];
                                puntos['<?php echo $i; ?>'] = punto;
                            <?php $i++; } ?>

                            // Función para posicionar los marcadores en el mapa
                            function setMarkers(map, puntos) {
                                for (var i = 0; i < puntos.length; i++) {
                                    var place = puntos[i];
                                    var cliente_visitado = place[5];

                                    // Definir ícono según el estado "visitado"
                                    var iconUrl = '';
                                    if (cliente_visitado == 1) {
                                        iconUrl = '<?php echo base_url().'resources/images/red.png'; ?>';
                                    } else if (cliente_visitado == 2) {
                                        iconUrl = '<?php echo base_url().'resources/images/gray.png'; ?>';
                                    } else {
                                        iconUrl = '<?php echo base_url().'resources/images/blue.png'; ?>';
                                    }

                                    // Crear el ícono personalizado
                                    var customIcon = L.icon({
                                        iconUrl: iconUrl,
                                        iconSize: [25, 41],
                                        iconAnchor: [12, 41],
                                        popupAnchor: [0, -41]
                                    });

                                    // Crear el marcador
                                    var marker = L.marker([place[1], place[2]], { icon: customIcon }).addTo(map);

                                    // Contenido del popup según el estado "visitado"
                                    if (cliente_visitado == 1 || cliente_visitado == 2) {
                                        contenido = '<div id="content" style="width: auto; height: auto;"><h5>' + place[0] + '</h5>' + place[3] + '</div>';
                                    } else {
                                        contenido = '<div id="content" style="width: auto; height: auto;">' +
                                                    '<a href="' + link2 + place[4] + '" target="_blank"><h5>Pedidos: ' + place[0] + '</h5></a>' +
                                                    place[3] + '</div>';
                                    }

                                    // Asignar el popup
                                    marker.bindPopup(contenido);
                                }
                            }

                            // Función para inicializar el mapa
                            function initialize() {
                                // Inicializar el mapa
                                var map = L.map('map').setView(coordenadas, 14);

                                // Capa base de OpenStreetMap
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                }).addTo(map);

                                // Llamar a la función que escribe los marcadores
                                setMarkers(map, puntos);
                            }

                            // Inicializar el mapa al cargar la página
                            initialize();
                        </script>



     
                    </td> 
                <!-- <td style="padding: 0"> 
                        <table > 
                      <?php foreach($all_cliente as $cliente){ ?> 
                          <tr style="padding: 0"> 
                           
                              <td style="padding: 0"><font style="font-family: Arial narrow; font-size: 8px;"> 
                                  <?php 
                                      $nombrecliente = substr($cliente["cliente_nombre"], 10);  
                                      echo $nombrecliente; 
                                  ?> 
                                  </font></td> 
                               
                              <td style="padding: 0"> 
                                              <?php if ($cliente["cliente_visitado"]==1){ ?>  
                                  <img src="<?php echo base_url("resources/images/red.png"); ?>" width="15px" height="15x">                                                                  
                                              <?php }else{ ?>  
                                                      <img src="<?php echo base_url("resources/images/blue.png"); ?>" width="15px" height="15x">  
                                              <?php } ?> 
                              </td> 
                           
                          </tr> 
                      <?php } ?> 
                        </table> 
                    </td> --> 
                  </tr> 
              </table> 
     
        </div> 
           
    </div> 
    <center> 
        <a href="<?php echo base_url("pedido"); ?>" class="btn btn-danger btn-xs"><fa class="fa fa-times"> </fa> Cerrar</a    > 
    </center> 
  </body> 
  
  
</html>
