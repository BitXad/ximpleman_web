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
                            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $parametros[0]['parametro_apikey']; ?>"></script>
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
                                   
                                  foreach($all_pedido as $p){ ?> 
                                     
                                      //punto = ['<?php /*echo $p['cliente_nombre']."(".$p['cliente_codigo'].")"; ?>','<?php echo $p['cliente_latitud']; ?>','<?php echo $p['cliente_longitud']; ?>','<?php echo $p['cliente_direccion']; ?>','<?php echo $p['cliente_id']; ?>','<?php echo $p['cliente_visitado']; ?>']; 
                                      //puntos['<?php echo $i;*/ ?>'] = punto;
                                      punto = ['<?php echo $p['cliente_nombre']."(".$p['cliente_codigo'].")"; ?>','<?php echo $p['cliente_latitud']; ?>','<?php echo $p['cliente_longitud']; ?>','<?php echo $p['cliente_direccion']; ?>','<?php echo $p['pedido_id']; ?>','<?php echo $p['entrega_id']; ?>','<?php echo $p['venta_id']; ?>'];
                                      puntos['<?php echo $i; ?>'] = punto;
                                      //alert(puntos[i]); 
                                  <?php $i++; } ?>
                            //funcion para posicionar los marcadores en el mapa 
                            function setMarkers(map, puntos) {     
                              //limpiamos el contenido del globo de informacion 
                              var infowindow = new google.maps.InfoWindow({ 
                                  content: '' 
                              }); 
                       
                              //recorremos cada uno de los puntos 
                              for (var i = 0; i < puntos.length; i++) {
                                var place = puntos[i];
                                //var entrega_id = place[5];
                                //var venta_id = place[6];
 
                                if (place[5]==2){
                                     
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
                                          entrega_id: place[5],
                                          venta_id: place[6],
                                          icon: '<?php echo base_url().'resources/images/red.png';?>' 
 
                                      }); 
 
                                } /*else if (place[5]==2){
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
                                          icon: '<?php //echo base_url().'resources/images/gray.png';?>' 
 
                                      }); 
                                      
                                }*/ else {
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
                                          entrega_id: place[5],
                                          venta_id: place[6],
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
                                  if(this.entrega_id == 2){
                                      contenido='<div id="content" style="width: auto; height: auto;"><h5>'+this.nombre+'</h5>'+  this.info + '</div>';
                                  }else /*if(this.entrega_id == 2){
                                      contenido='<div id="content" style="width: auto; height: auto;"><h5>'+this.nombre+'</h5>'+  this.info + '</div>';
                                  }else*/{
                                      //contenido='<div id="content" style="width: auto; height: auto;">' +'<a href="'+link2+this.link+'" target="_blank"><h5>Pedidos: '+this.nombre +'</h5></a>' +  this.info + '</div>'; 
                                      contenido='<div id="content" style="width: auto; height: auto;">' +'<a onclick="entregarpedido('+this.venta_id+')" style="cursor: pointer"><h5>Pedidos: '+this.nombre +'</h5></a>' +  this.info + '</div>'; 
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
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
