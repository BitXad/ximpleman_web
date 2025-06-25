<!DOCTYPE html>
<html>
    <head>
        <title>Negocios</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="<?php echo base_url('resources/js/mapaentrega.js'); ?>" type="text/javascript"></script>
        <style>
            #map{
                width: 800px; 
                height: 600px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
            <h4><b>Entregas : <?php echo sizeof($all_pedido); ?></b>
            <a href="<?php echo site_url('pedido'); ?>" class="btn btn-danger btn-sm"><span class="fa fa-list"></span> <?php echo $pedido_titulo; ?></a>
            <a href="javascript:location.reload()" class="btn btn-warning btn-sm" ><span class="fa fa-recycle"></span> Actualizar</a>
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

                                // Variable para globos de información (popup en Leaflet)
                                var infowindow = true;

                                // Puntos a ser marcados en el mapa
                                var puntos = [];
                                var link2 = '<?php echo base_url().'pedido/pedidoabierto/'; ?>';
                                var punto;

                                <?php $i = 0;
                                foreach($all_pedido as $p){ ?>
                                    punto = ['<?php echo $p['cliente_nombre']."(".$p['cliente_codigo'].")"; ?>',
                                             '<?php echo $p['cliente_latitud']; ?>',
                                             '<?php echo $p['cliente_longitud']; ?>',
                                             '<?php echo $p['cliente_direccion']; ?>',
                                             '<?php echo $p['pedido_id']; ?>',
                                             '<?php echo $p['entrega_id']; ?>',
                                             '<?php echo (empty($p['venta_id']))?"0":$p['venta_id']; ?>'];
                                    puntos['<?php echo $i; ?>'] = punto;
                                <?php $i++; } ?>

                                // Función para posicionar los marcadores en el mapa
                                function setMarkers(map, puntos) {
                                    for (var i = 0; i < puntos.length; i++) {
                                        var place = puntos[i];

                                        var iconUrl = '';
                                        if (place[5] == 2) {
                                            iconUrl = '<?php echo base_url().'resources/images/red.png'; ?>';
                                        } else {
                                            iconUrl = '<?php echo base_url().'resources/images/blue.png'; ?>';
                                        }

                                        // Crear el ícono personalizado
                                        var customIcon = L.icon({
                                            iconUrl: iconUrl,
                                            iconSize: [25, 41], // tamaño del ícono
                                            iconAnchor: [12, 41], // punto del ícono que corresponde a la ubicación del marcador
                                            popupAnchor: [0, -41] // punto desde el cual se abre el popup
                                        });

                                        // Crear el marcador
                                        var marker = L.marker([place[1], place[2]], { icon: customIcon }).addTo(map);

                                        // Contenido del popup
                                        var contenido = '';
                                        if (place[5] == 2) {
                                            contenido = '<div id="content" style="width: auto; height: auto;"><h5>' + place[0] + '</h5>' + place[3] + '</div>';
                                        } else {
                                            contenido = '<div id="content" style="width: auto; height: auto;">' +
                                                        '<a onclick="entregarpedido(' + place[6] + ')" style="cursor: pointer"><h5>Pedidos: ' + place[0] + '</h5></a>' +
                                                        place[3] + '</div>';
                                        }

                                        // Asociar el popup al marcador
                                        marker.bindPopup(contenido);
                                    }
                                }

                                // Inicializar el mapa
                                function initialize() {
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
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
