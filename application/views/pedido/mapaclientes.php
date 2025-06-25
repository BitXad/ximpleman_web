<!DOCTYPE html>
<html>
  <head>
    <title>Negocios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      #map{
        width: 800px; 
        height: 600px;
      }
    </style>
  </head>
  <body>
      <div class="container">
          <h4><b>Mis Cliente: <?php echo sizeof($all_pedido); ?></b>
          <a href="<?php echo site_url('pedido'); ?>" class="btn btn-danger btn-sm"><span class="fa fa-list"></span> <?php echo $pedido_titulo; ?></a>
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
                    var punto;

                    <?php $i = 0;
                    foreach($all_pedido as $p){ ?>
                        punto = ['<?php echo $p['cliente_nombre']; ?>',
                                 '<?php echo $p['cliente_latitud']; ?>',
                                 '<?php echo $p['cliente_longitud']; ?>',
                                 '<?php echo $p['cliente_direccion']; ?>',
                                 '<?php echo $p['pedido_id']; ?>'];
                        puntos['<?php echo $i; ?>'] = punto;
                    <?php $i++; } ?>

                    // Función para posicionar los marcadores en el mapa
                    function setMarkers(map, puntos) {
                        for (var i = 0; i < puntos.length; i++) {
                            var place = puntos[i];

                            // Definir ícono personalizado
                            var customIcon = L.icon({
                                iconUrl: '<?php echo base_url().'resources/images/blue.png'; ?>',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [0, -41]
                            });

                            // Crear el marcador
                            var marker = L.marker([place[1], place[2]], { icon: customIcon }).addTo(map);

                            // Contenido del popup con link al comprobante
                            var contenido = '<div id="content" style="width: auto; height: auto;">' +
                                            '<a href="<?php echo base_url().'pedido/comprobante/'; ?>' + place[4] + '" target="_blank">' +
                                            '<h5>' + place[0] + '</h5></a>' +
                                            place[3] + '</div>';

                            // Asignar el popup
                            marker.bindPopup(contenido);
                        }
                    }

                    // Función para inicializar el mapa
                    function initialize() {
                        // Inicializar el mapa
                        var map = L.map('map').setView(coordenadas, 12);

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
                  </tr>
              </table>
    
        </div>
    </div>
                              <div class="footer">
                            <center>
                                
                                <button class="btn btn-danger" id="cancelar_preferencia" onclick="window.close()" data-dismiss="modal" >
                                    <span class="fa fa-close"></span>   Cerrar
                                </button>

                            </center>
                        </div>
  </body>
</html>
