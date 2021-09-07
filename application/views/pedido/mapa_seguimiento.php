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
          <h4><b>Pedidos: <?php echo sizeof($all_pedido); ?></b>
          <a href="<?php echo site_url('pedido'); ?>" class="btn btn-danger btn-sm"><span class="fa fa-list"></span> Pedidos</a>
          </h4>
          <div class="col col-md-12 table-responsive">
              <table class="table">
                  <tr>
                      <td>
                      
    <div id="map" style="width:100%"></div> <!-- mapa -->
    
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $parametros['parametro_apikey']; ?>"></script>
    <script>      
      //coordada inicial del mapa
      var coordenadas= new google.maps.LatLng(-17.4038, -66.1635);
      
      //variable para globos de informacion
      var infowindow = true;
 
      //puntos a ser marcados en el mapa
      var puntos = [];
      
        var punto;
      
       
            <?php $i = 0;
            
            foreach($all_pedido as $p){ ?>
               
                punto = ['<?php echo $p['cliente_nombre']; ?>','<?php echo $p['cliente_latitud']; ?>','<?php echo $p['cliente_longitud']; ?>','<?php echo $p['cliente_direccion']; ?>','<?php echo $p['pedido_id']; ?>','<?= $p['entrega_id'] ?>','<?= $p['venta_id']; ?>','<?= $p['entrega_id'] ?>','<?= $p['venta_id'] ?>','<?= $p['venta_fechaentrega'] ?>', '<?= $p['venta_horaentrega'] ?>'];
                puntos['<?php echo $i; ?>'] = punto;
            <?php $i++; } ?>       
       
        
//        punto=['Prueba nueva 2',-17.4138,-66.1735,'Micromercado el Papichin'];        
//        puntos[1]=punto;
//        
//        punto=['Mas pruebas 3',-17.4125,-66.1720,'Micromercado el tribilin'];        
//        puntos[2]=punto;
//
//    
//    
//    
//        punto=['Mas pruebas 3',-17.4125,-66.1720,'Micromercado el tribilin'];        
//        puntos[2]=punto;
        
        
        
      //funcion para posicionar los marcadores en el mapa
      function setMarkers(map, puntos) {    
        //limpiamos el contenido del globo de informacion
        var infowindow = new google.maps.InfoWindow({
            content: ''
        });
 
        //recorremos cada uno de los puntos
        for (var i = 0; i < puntos.length; i++) {
            
            var place = puntos[i];
            if(place[5] == 1){
                var color_icon = '<?php echo base_url().'resources/images/blue.png'; ?>';
            }else{
                var color_icon = '<?php echo base_url().'resources/images/red.png'; ?>';
            }
            //propiedades del marcador
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(place[1], place[2]), //posicion
                map: map,
                scrollwheel: false,
                animation: google.maps.Animation.DROP, //animacion           
                nombre: place[0], //personalizado - nombre del punto
                info: place[3], //personalizado - informacion adicional
                link: '<?php echo base_url().'pedido/comprobante/'; ?>'+place[4], //personalizado - informacion adicional              
                icon: color_icon,
                estado: place[5],
                entrega_fecha: place[9],
                entrega_hora: place[10]
            });
            
            //se agrega el evento click a cada marcador, asi despliega la
            //informacion nada uno de los marcadores
            google.maps.event.addListener(marker, 'click', function() {
                //html de como vamos a visualizar el contenido del globo
                var contenido='<div id="content" style="width: auto; height: auto;">' +'<a href="'+this.link+'"><h5>'+this.nombre +'</h5></a>';
                if(this.estado == 1){
                    contenido += this.info;
                }else{
                    contenido += this.info+'<br>';
                    contenido += '<span style="font-size:8pt;"><b>Fecha de entrega:</b> '+this.entrega_fecha+'<br><b>Hora:</b> '+this.entrega_hora+'</span>';
                }
                contenido = contenido+'</div>';
                infowindow.setContent(contenido); //asignar el contenido al globo
                infowindow.open(map, this); //mostrarlo
            });
        }
    }
      
      //funcion para inicializar el mapa
      function initialize() {
        //iniciamos un nuevo mapa el div 'map' y le asignamos propiedades
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-17.4038, -66.1635), //coordenada inicial
          zoom: 14, //nivel de zoom
          mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa      
          
        }); 
        
        //llamar a la funcion que escribe los marcadores
        setMarkers(map, puntos);
 
      }
 
      initialize(); //inicializar el mapa
    </script>
    
                    </td>
                  </tr>
              </table>
    
        </div>
    </div>
  </body>
</html>
