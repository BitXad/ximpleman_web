function mostrar(a) {
    obj = document.getElementById('oculto'+a);
    obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
    //objm = document.getElementById('map');
    if(obj.style.visibility == 'hidden'){
        $('#map').css({ 'width':'0px', 'height':'0px' });
        $('#mosmapa').text("Obtener Ubicación del negocio");
    }else{
        $('#map').css({ 'width':'500px', 'height':'400px' });
        $('#mosmapa').text("Cerrar mapa");
    }

}


                                                var marker;          //variable del marcador
                                                var coords_lat = {};    //coordenadas obtenidas con la geolocalización
                                                var coords_lng = {};    //coordenadas obtenidas con la geolocalización
                                                

                                                //Funcion principal
                                                initMap = function () 
                                                {
                                                    //usamos la API para geolocalizar el usuario
                                                        navigator.geolocation.getCurrentPosition(
                                                          function (position){
                                                            coords_lat =  {
                                                              lat: position.coords.latitude,
                                                            };
                                                            coords_lng =  {
                                                              lng: position.coords.longitude,
                                                            };
                                                            setMapa(coords_lat, coords_lng);  //pasamos las coordenadas al metodo para crear el mapa


                                                          },function(error){console.log(error);});
                                                }
                                                
                                                function setMapa (coords_lat, coords_lng)
                                                {   
                                                      //Se crea una nueva instancia del objeto mapa
                                                      var map = new google.maps.Map(document.getElementById('map'),
                                                      {
                                                        zoom: 13,
                                                        center:new google.maps.LatLng(coords_lat.lat,coords_lng.lng),

                                                      });

                                                      //Creamos el marcador en el mapa con sus propiedades
                                                      //para nuestro obetivo tenemos que poner el atributo draggable en true
                                                      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
                                                      marker = new google.maps.Marker({
                                                        map: map,
                                                        draggable: true,
                                                        animation: google.maps.Animation.DROP,
                                                        position: new google.maps.LatLng(coords_lat.lat,coords_lng.lng),

                                                      });
                                                      //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
                                                      //cuando el usuario a soltado el marcador
                                                      //marker.addListener('click', toggleBounce);

                                                      marker.addListener( 'dragend', function (event)
                                                      {
                                                        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                                                        document.getElementById("cliente_latitud").value = this.getPosition().lat();
                                                        document.getElementById("cliente_longitud").value = this.getPosition().lng();
                                                      });
                                                }
                                                initMap();
