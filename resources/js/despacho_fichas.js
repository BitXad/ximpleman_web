 $(document).on("ready",inicio_recepcion);
function inicio_recepcion(){
    
      
//recepcion(1); 
setInterval('actualizar()',7000);
          //aca podemos mandar fecha 
}

function actualizar()
{
    var estado = 1;
    //var ventas = document.getElementById('ventas').value;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/get_terminados"; //ver pedido terminados listos para entrega
    
    $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado},

           success:function(resul){                

               var registros =  JSON.parse(resul);

               var n = registros.length; //tamaÃ±o de
               let pedido = 0;
            if (n>0) {
                //recepcion(1);
                pedido = registros[0]["venta_numeroventa"];
                //alert(pedido);
                document.getElementById("numero_pedido").textContent = pedido;
                anunciar_mi_pedido(pedido);
            }   

              },
                error:function(resul){

                }

            });   

}


function anunciar_mi_pedido(numero) {
   

    anunciar_pedido(numero);
    
  
}


function anunciar_pedido(numero) {
     
    var base_url    = document.getElementById('base_url').value;
    var basePath = base_url+'resources/sonidos/numeros/'; // Ruta en CodeIgniter
    numero = parseInt(numero);

    // Construir secuencia de archivos
    const secuencia = ["pedido.mp3"]; // Siempre inicia con "pedido.mp3"
    
    //if (isNaN(numero) || numero < 1 || numero > 1000) {
    //    secuencia.push("numero_invalido.mp3"); 
        //console.error("Número fuera de rango (1-1000)");
        //return;
    //}

    function pad2(n) { return n < 10 ? '0' + n : String(n); }


    if (numero >= 1000) {
        
        if(numero === 1000){secuencia.push("1000.mp3"); }
        else{ secuencia.push("numero_invalido.mp3"); }
            
    } else {
        let centenas = Math.floor(numero / 100);
        let decenas = Math.floor((numero % 100) / 10);
        let unidades = numero % 10;
        let resto = numero % 100;

     // alert(centenas+" ** "+decenas+" ** "+unidades+" ** "+resto);
     // 
     $("#numeros").text(centenas+" ** "+decenas+" ** "+unidades+" ** "+resto);
     
     
        // Centenas
        if (centenas > 0) {
            
            if (numero === 100) { secuencia.push("100.mp3");
            } else            if (centenas === 1) {
                secuencia.push("100to.mp3");
            } else {
                secuencia.push((centenas * 100) + ".mp3");
            }
        }
        
        // Decenas y unidades
        if (resto > 0) {
            
            if (resto <= 20) {
                
                //if (centenas > 0 ) //secuencia.push("y.mp3");                
                
                secuencia.push((resto < 10 ? pad2(resto) : String(resto)) + ".mp3"); //del 1 al 20
                
            } else
                    if (resto < 30) {

                        //if (centenas > 0) secuencia.push("y.mp3");
                        secuencia.push("20y.mp3");
                        if (unidades > 0) secuencia.push(pad2(unidades) + ".mp3");

                    } else {

                        if (decenas > 0) { //decenas de 30 en adelante
                            
                            //if (centenas > 0) //secuencia.push("y.mp3");
                                secuencia.push((decenas * 10) + ".mp3");
                        }
                        if (unidades > 0) {

                                secuencia.push("y.mp3");
                                secuencia.push(pad2(unidades) + ".mp3");
                            
                        }
                    }
        }
    }

    // Reproducir audios secuencialmente
    let i = 0;
    function reproducir() {
        if (i >= secuencia.length) return;
        let audio = new Audio(basePath + secuencia[i]);
        
        audio.playbackRate = 1.2; // 1.0 = normal, 2.0 = doble de rápido, 0.5 = mitad de velocidad
        i++;
        audio.onended = reproducir;
        audio.play().catch(err => console.error("Error reproduciendo:", err));
        
    }
    reproducir();

}

//function probar_audio(){
//    numero_contador = document.getElementById("numero_contador").value;
//    document.getElementById('timbre').play();
//    anunciar_pedido(numero_contador);
//    
//    numero_contador = Number(numero_contador) + 1;
//    document.getElementById("numero_contador").value = numero_contador;
//    
//}

function sleep(milliseconds) {
 var start = new Date().getTime();
 for (var i = 0; i < 1e7; i++) {
  if ((new Date().getTime() - start) > milliseconds) {
   break;
  }
 }
}
//
//
//window.addEventListener("keydown", e => {
//  console.log("KEY:", e.key, "CODE:", e.code, "KEYCODE:", e.keyCode);
//});
//window.addEventListener("keydown", function(e) {
//    switch(e.code) {
//        case "F13": // G1
//            console.log("G1 = Flecha Arriba");
//            moverArriba();
//            break;
//        case "F14": // G2
//            console.log("G2 = Flecha Abajo");
//            moverAbajo();
//            break;
//        case "F15": // G3
//            console.log("G3 = Enter");
//            activarSeleccion();
//            break;
//        case "F16": // G4
//            console.log("G4 = Escape");
//            cancelarAccion();
//            break;
//        // Opcional: G5–G8
//        case "F17": console.log("G5 libre"); break;
//        case "F18": console.log("G6 libre"); break;
//        case "F19": console.log("G7 libre"); break;
//        case "F20": console.log("G8 libre"); break;
//    }
//});
//
//function moverArriba() {
//   // aquí tu lógica para moverte arriba en la tabla
//}
//function moverAbajo() {
//   // aquí tu lógica para moverte abajo en la tabla
//}
//function activarSeleccion() {
//   // simular Enter sobre la fila seleccionada
//}
//function cancelarAccion() {
//   // simular Escape o cancelar selección
//}