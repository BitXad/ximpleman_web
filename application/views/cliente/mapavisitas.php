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
          <h4><b>ZONA: <?php echo (empty($zona["zona_nombre"]))?"":$zona["zona_nombre"]; ?>, CLIENTES: <?php echo (empty($all_cliente))?0:sizeof($all_cliente); ?></b>
          <a href="javascript:location.reload()" class="btn btn-info btn-sm"><span class="fa fa-map-marker"></span> Actualizar visitas</a>
          </h4>
          <div class="col col-md-12 table-responsive">
              <table class="table">
              <tr> 
                      <td> 
                       
                        <div id="map"></div> <!-- mapa --> 
                         
                        <!-- Leaflet CSS -->
                        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                        <!-- Leaflet JS -->
                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                        
                        <script>
                            // Coordenadas iniciales del mapa
                            var coordenadas = [-17.4038, -66.1635];

                            // Puntos a ser marcados en el mapa
                            var puntos = [];
                            var link1 = '<?php echo base_url().'venta/ventas_cliente/'; ?>';
                            var link2 = '<?php echo base_url().'pedido/pedidoabierto/'; ?>';
                            var punto;

                            <?php $i = 0;
                            foreach($all_cliente as $p){ ?>
                                punto = ['<?php echo $p['cliente_nombre']; ?>','<?php echo $p['cliente_latitud']; ?>','<?php echo $p['cliente_longitud']; ?>','<?php echo $p['cliente_direccion']; ?>','<?php echo $p['cliente_id']; ?>','<?php echo $p['cliente_visitado']; ?>'];
                                puntos.push(punto);
                            <?php $i++; } ?>  

                            // Inicializar el mapa con Leaflet
                            var map = L.map('map').setView(coordenadas, 14);

                            // Añadir capa base de OSM
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            // Función para agregar los marcadores
                            function setMarkers(map, puntos) {
                                for (var i = 0; i < puntos.length; i++) {
                                    var place = puntos[i];
                                    var markerIcon = L.icon({
                                        iconUrl: (place[5] == 1) ? '<?php echo base_url().'resources/images/red.png';?>' : '<?php echo base_url().'resources/images/blue.png';?>',
                                        iconSize: [32, 32], // tamaño del icono (ajusta si necesario)
                                        iconAnchor: [16, 32], // punto de anclaje
                                        popupAnchor: [0, -32] // donde se abre el popup respecto al icono
                                    });

                                    var marker = L.marker([place[1], place[2]], { icon: markerIcon }).addTo(map);

                                    var milat = <?php echo $p['cliente_latitud'];?>;
                                    var milon = <?php echo $p['cliente_longitud'];?>;

                                    // Contenido del popup
                                    
                                    //var enlace = 'https://www.google.com/maps/dir/'+milat+','+milon;
                                    var enlace = 'https://www.google.com/maps/dir/?api=1&destination=' + milat + ',' + milon;
                                    var contenido = '<div id="content" style="width: auto; height: auto;"><h5><b><fa class="fa fa-user"> </fa> CLIENTE:</b> ' +place[0]+'<h5>'+
                                        '<a href="'+link1+place[4]+'" target="_blank"><h5><fa class="fa fa-cart-arrow-down"> </fa> Realizar venta</h5></a>' +
                                        '<a href="'+link2+place[4]+'" target="_blank"><h5><fa class="fa fa-cubes"> </fa> Realizar pedido/preventa</h5></a>' +
                                        '<a href="'+enlace+'" target="_blank"><h5><fa class="fa fa-map-marker"> </fa> Como llegar</h5></a>' +
                                        '<h5><b><fa class="fa fa-home"> </fa> DIRECCION:</b></h5> <p>'+place[3]+'</p>' +  // dirección del cliente
                                        '</div>';

                                    marker.bindPopup(contenido);
                                }
                            }

                            // Llamar a la función
                            setMarkers(map, puntos);

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
           
        <div class="container">
            <div class="row">
                
                <div class="col-md-6">
                        <img src="<?php echo base_url("resources/images/red.png"); ?>" width="15px" height="15x"><small> VENTA REALIZADA</small> 
                        <img src="<?php echo base_url("resources/images/blue.png"); ?>" width="15px" height="15x"><small> VISITA PENDIENTE</small> 
                   
                </div> 
                <div class="col-md-2">
                    <center> 
                        <a href="<?php echo base_url("cliente"); ?>" class="btn btn-danger btn-block"><fa class="fa fa-times"> </fa> Cerrar</a    > 
                    </center> 
                </div> 
                
                <div class="col-md-4">
                </div> 
                
            </div> 
        </div> 
  
</body> 
  
</html>
