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
    
    $.ajax({
        url: controlador,
        type: "POST",
        data: {usuario_id:usuario_id, desde:desde, hasta:hasta},
        success: function(respuesta){
            $("#num_pedidos").html("0");
            var registros =  JSON.parse(respuesta);
            if (registros != null){
                var n = registros.length;
                $("#num_pedidos").html(n);
                var puntos = [];

                for (var i = 0; i < n ; i++){
                    var punto = [
                        registros[i]["cliente_nombre"]+"("+registros[i]["cliente_codigo"]+")",
                        registros[i]["cliente_latitud"],
                        registros[i]["cliente_longitud"],
                        registros[i]["cliente_direccion"],
                        registros[i]["cliente_id"],
                        registros[i]["cliente_visitado"],
                        registros[i]["pedido_id"]
                    ];
                    puntos[i] = punto;
                }
                
                initialize(puntos); // Inicializar el mapa
            }
            document.getElementById('loader').style.display = 'none';
        },
        error: function(respuesta){
            html = "";
            $("#tablaresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none';
        }
    });   
}

var map;  // Variable global para que no se cree nuevo mapa en cada llamada
var markersLayer;  // Para limpiar marcadores previos

//funcion para inicializar el mapa 
function initialize(puntos) {
    var base_url = document.getElementById('base_url').value;

    // Si el mapa no está creado, lo creamos
    if (!map) {
        map = L.map('map').setView([-17.4038, -66.1635], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
    }

    // Si ya había una capa de marcadores, la quitamos
    if (markersLayer) {
        markersLayer.clearLayers();
    } else {
        markersLayer = L.layerGroup().addTo(map);
    }

    var link2 = base_url + "pedido/pedidoabierto/";

    // Recorremos los puntos y los agregamos al mapa
    for (var i = 0; i < puntos.length; i++) {
        var place = puntos[i];
        var cliente_visitado = place[5];

        // Definir ícono según visitado
        var iconUrl = base_url + "resources/images/blue.png";
        if (cliente_visitado == 1) {
            iconUrl = base_url + "resources/images/red.png";
        } else if (cliente_visitado == 2) {
            iconUrl = base_url + "resources/images/gray.png";
        }

        var customIcon = L.icon({
            iconUrl: iconUrl,
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [0, -41]
        });

        // Crear el marcador
        var marker = L.marker([place[1], place[2]], { icon: customIcon }).addTo(markersLayer);

        // Contenido del popup
        var contenido = '<div id="content" style="width: auto; height: auto;">' +
                        '<a style="cursor:pointer" onclick="consolidar_pedido('+place[6]+')">' +
                        '<h5>Consolidar pedido: '+place[0]+'</h5></a>' +
                        place[3] + '</div>';

        marker.bindPopup(contenido);
    }
}

function consolidar_pedido(pedido_id){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/mapapedido_a_ventas";

    $.ajax({
        url: controlador,
        type: "POST",
        data: {pedido_id: pedido_id},
        success: function(response){
            pedidos_realizados();
        }
    });
}