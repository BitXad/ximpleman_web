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
                         
                        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $parametros['parametro_apikey']; ?>"></script> 
                        <script>       
                            //coordada inicial del mapa 
                            var coordenadas= new google.maps.LatLng(-17.4038, -66.1635); 
                             
                            //variable para globos de informacion 
                            var infowindow = true; 
                       
                            //puntos a ser marcados en el mapa 
                            var puntos = []; 
                            //var link1 = '<?php //echo base_url().'venta/ventas_cliente/'; ?>';
                            var link2 = '<?php echo base_url().'pedido/pedidoabierto/'; ?>';
                            var punto; 
                            var contenido ='';
                             
                             
                                  <?php $i = 0; 
                                   
                                  foreach($all_cliente as $p){ ?> 
                                     
                                      punto = ['<?php echo $p['cliente_nombre']."(".$p['cliente_codigo'].")"; ?>','<?php echo $p['cliente_latitud']; ?>','<?php echo $p['cliente_longitud']; ?>','<?php echo $p['cliente_direccion']; ?>','<?php echo $p['cliente_id']; ?>','<?php echo $p['cliente_visitado']; ?>']; 
                                      puntos['<?php echo $i; ?>'] = punto; 
                                      //alert(puntos[i]); 
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
                                var cliente_visitado = place[5];
 
                                if (place[5]==1){
                                     
                                      //propiedades del marcador 
                                      var marker = new google.maps.Marker({ 
 
                                          position: new google.maps.LatLng(place[1], place[2]), //posicion 
                                          map: map, 
                                          title: place[0], 
                                          scrollwheel: false, 
                                          animation: google.maps.Animation.DROP, //animacion            
                                          nombre: place[0], //personalizado - nombre del punto 
                                          info: place[3], //personalizado - informacion adicional 
                                          link: '', //'<?php //echo base_url().'pedido/comprobante/'; ?>'personalizado - informacion adicional               
                                          visitado: place[5],
                                          icon: '<?php echo base_url().'resources/images/red.png';?>' 
 
                                      }); 
 
                                } else if (place[5]==2){
                                      //propiedades del marcador 
                                      var marker = new google.maps.Marker({ 
 
                                          position: new google.maps.LatLng(place[1], place[2]), //posicion 
                                          map: map, 
                                          title: place[0], 
                                          scrollwheel: false, 
                                          animation: google.maps.Animation.DROP, //animacion            
                                          nombre: place[0], //personalizado - nombre del punto 
                                          info: place[3], //personalizado - informacion adicional 
                                          link: '', //'<?php //echo base_url().'pedido/comprobante/'; ?>'personalizado - informacion adicional               
                                          visitado: place[5],
                                          icon: '<?php echo base_url().'resources/images/gray.png';?>' 
 
                                      }); 
                                      
                                }else{
                                    //propiedades del marcador 
                                      var marker = new google.maps.Marker({ 
 
                                          position: new google.maps.LatLng(place[1], place[2]), //posicion 
                                          map: map, 
                                          title: place[0], 
                                          scrollwheel: false, 
                                          animation: google.maps.Animation.DROP, //animacion            
                                          nombre: place[0], //personalizado - nombre del punto 
                                          info: place[3], //personalizado - informacion adicional 
                                          link: place[4],
                                          visitado: place[5],
                                          //link: '<?php //echo base_url().'venta/ventas_cliente/'; ?>'+place[4], //personalizado - informacion adicional               
                                          icon: '<?php echo base_url().'resources/images/blue.png';?>' 
 
                                      });
                                }
 
 
 
 
                                 
                                 
                                //se agrega el evento click a cada marcador, asi despliega la 
                                //informacion nada uno de los marcadores 
                                //          if (this.cliente_visitado==1){ 
                                //            google.maps.event.addListener(marker, 'click', function() { 
                                //          } 
                                //          else{ 
                                //            google.maps.event.addListener(marker2, 'click', function() {               
                                //          } 
                                  google.maps.event.addListener(marker, 'click', function() {
                              //html de como vamos a visualizar el contenido del globo 
                                  if(this.visitado == 1){
                                      contenido='<div id="content" style="width: auto; height: auto;"><h5>'+this.nombre+'</h5>'+  this.info + '</div>';
                                  }else if(this.visitado == 2){
                                      contenido='<div id="content" style="width: auto; height: auto;"><h5>'+this.nombre+'</h5>'+  this.info + '</div>';
                                  }else{
                                      contenido='<div id="content" style="width: auto; height: auto;">' +'<a href="'+link2+this.link+'" target="_blank"><h5>Pedidos: '+this.nombre +'</h5></a>' +  this.info + '</div>'; 
                                  }
                                  
                                  
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
