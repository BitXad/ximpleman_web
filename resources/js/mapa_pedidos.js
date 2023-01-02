$(document).on("ready",inicio);
function inicio(){
    pedidos_realizados();
}
//busqueda de los pedidos realizados
function pedidos_realizados(){
    var base_url   = document.getElementById('base_url').value;
    var desde      = document.getElementById('fecha_desde').value;
    var hasta      = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('usuario_prevendedor').value;
    var controlador = base_url+'pedido/pedidos_pendientes/';
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
            type:"POST",
            data:{usuario_id:usuario_id, desde:desde, hasta:hasta},
            success:function(respuesta){
                $("#num_pedidos").html("0");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#num_pedidos").html(n);
                    html = "";
                    /* ************ Inicio para el mapa ************ */
                    var coordenadas= new google.maps.LatLng(-17.4038, -66.1635); 
                    //var infowindow = true; 
                    //puntos a ser marcados en el mapa 
                    var puntos = []; 
                    //var link1 = '<?php //echo base_url().'venta/ventas_cliente/'; ?>';
                    //var link2 = "'"+base_url+"pedido/pedidoabierto/"+"'";
                    var punto; 
                    //var contenido ='';
                    
                    for (var i = 0; i < n ; i++){
                        punto = [registros[i]["cliente_nombre"]+"("+registros[i]["cliente_codigo"]+")", registros[i]["cliente_latitud"], registros[i]["cliente_longitud"], '"'+registros[i]["cliente_direccion"]+'"', registros[i]["cliente_id"], registros[i]["cliente_visitado"],registros[i]["pedido_id"]];
                        puntos[i] = punto; 
                    }
                   //alert(puntos);
                   initialize(puntos); //inicializar el mapa 
                   document.getElementById('loader').style.display = 'none';
            }
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });   

}

//funcion para posicionar los marcadores en el mapa 
function setMarkers(map, puntos) {
    var base_url   = document.getElementById('base_url').value;
    var contenido = '';
    var link2 = base_url+"pedido/pedidoabierto/";
  //limpiamos el contenido del globo de informacion 
  var infowindow = new google.maps.InfoWindow({ 
      content: '' 
  }); 

  //recorremos cada uno de los puntos 
  for (var i = 0; i < puntos.length; i++) {
    var place = puntos[i];
    var cliente_visitado = place[5];

    /*if (place[5]==1){

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
              icon: base_url+"resources/images/red.png"
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
              icon: base_url+"resources/images/gray.png"

          }); 

    }else{*/
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
              pedido_id: place[6],
              visitado: place[5],
              //link: '<?php //echo base_url().'venta/ventas_cliente/'; ?>'+place[4], //personalizado - informacion adicional               
              icon: base_url+"resources/images/blue.png"
          });
    //}

      google.maps.event.addListener(marker, 'click', function() {
  //html de como vamos a visualizar el contenido del globo 
      /*if(this.visitado == 1){
          contenido='<div id="content" style="width: auto; height: auto;"><h5>'+this.nombre+'</h5>'+  this.info + '</div>';
      }else if(this.visitado == 2){
          contenido='<div id="content" style="width: auto; height: auto;"><h5>'+this.nombre+'</h5>'+  this.info + '</div>';
      }else{*/
          //contenido='<div id="content" style="width: auto; height: auto;">' +'<a onclick="consolidar_pedido('+this.pedido_id+')" href="'+link2+this.link+'" target="_blank"><h5>Consolidar pedido: '+this.nombre +'</h5></a>' +  this.info + '</div>'; 
          contenido='<div id="content" style="width: auto; height: auto;">' +'<a style="cursor:pointer" onclick="consolidar_pedido('+this.pedido_id+')"><h5>Consolidar pedido: '+this.nombre +'</h5></a>' +  this.info + '</div>'; 
      //}


      infowindow.setContent(contenido); //asignar el contenido al globo 
      infowindow.open(map, this); //mostrarlo 
    }); 
  } 
}

//funcion para inicializar el mapa 
function initialize(puntos) { 
  //iniciamos un nuevo mapa el div 'map' y le asignamos propiedades 
  var map = new google.maps.Map(document.getElementById('map'), { 
    center: new google.maps.LatLng(-17.4038, -66.1635), //coordenada inicial 
    zoom: 14, //nivel de zoom 
    mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa       

  });  

  //llamar a la funcion que escribe los marcadores 
  setMarkers(map, puntos); 

} 

function consolidar_pedido(pedido_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/mapapedido_a_ventas";
    $.ajax({url:controlador,
        type:"POST",
        data:{pedido_id:pedido_id},
        success: function(response){
            pedidos_realizados();
        }        
    });

}

