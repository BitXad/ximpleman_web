// Global: registro de anuncios
// estructura: { [numeroPedido]: { count: 0, last: timestampMs } }
const anuncios = {};
const MAX_REPITENCIAS = 2;      // repetir 3 veces
const RESET_AFTER_MS = 2 * 60 * 1000; // si pasan 2 minutos sin actividad, permitimos anunciar de nuevo

$(document).on("ready", inicio_recepcion);

function inicio_recepcion(){
    //recepcion(1); 
    setInterval(actualizarnumero, 4000); // usar la referencia a la función en vez de string
    //aca podemos mandar fecha 
}

function actualizar()
{
    var estado = 1;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/get_terminados"; //ver pedido terminados listos para entrega

    $.ajax({
        url: controlador,
        type: "POST",
        data: {estado: estado},
        success: function(resul){
            try {
                var registros = JSON.parse(resul);
            } catch (e) {
                console.error("Respuesta no válida JSON:", e, resul);
                return;
            }

            var n = registros.length;
            if (n > 0) {
                const pedido = registros[0]["venta_numeroventa"];
                document.getElementById("numero_pedido").textContent = pedido;
                // Lógica para limitar repeticiones
                manejar_anuncio(pedido);
            }else{
                document.getElementById("numero_pedido").textContent = '--';
            }
        },
        error: function(resul){
            console.error("Error AJAX:", resul);
            document.getElementById("numero_pedido").textContent = '--';
        }
    });
}


function parar_reproduccion() {   
    
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/set_estado_temporal';    
    var estado = 0;    
            
    $.ajax({url: controlador,
           type:"POST",
           data:{estado: estado},
          
           success:function(resul){                
                
                
      }
    });   

}

function actualizarnumero()
{
    //var estado = 1;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/get_numero"; //ver pedido terminados listos para entrega

    $.ajax({
        url: controlador,
        type: "POST",
        data: {},
        success: function(resul){
            try
            {
                var resultados = JSON.parse(resul);
                
                registros = resultados['temporal'];
                terminados = resultados['terminados'];
                
                
                
            } catch (e) {
                
                console.error("Respuesta no válida JSON:", e, resul);
                return;
                
            }

            var n = registros.length;
            if (n > 0) {
                
                const pedido = registros[0]["temporal_numero"];
                const repeticiones = registros[0]["temporal_cantidad"];
                
                document.getElementById("numero_pedido").textContent = pedido;
                // Lógica para limitar repeticiones   
                
                for (let i = 0; i < repeticiones; i++) {
                    setTimeout(() => {
                        anunciar_numero(pedido);
//                        if (i === repeticiones - 1) {
//                            parar_reproduccion();
//                        }
                    }, i * 6000); // 2000 ms = 2 segundos entre cada anuncio
                }
                parar_reproduccion();
//                setTimeout(() => {
//                    parar_reproduccion();
//                    },2000)
//                
            }else{
               // document.getElementById("numero_pedido").textContent = '--';
            }
            
            html = '';
            
            if(terminados.length>=1){
                
                for (let i = 0; i < terminados.length; i++) {
                    
                    html += "<td style='border: 2px solid black; padding: 5px; width: 20px; text-align: center; font-family: Arial Black; text-shadow: 1px 1px 2px #000000; '>"+terminados[i]["venta_numeroventa"]+"<small style='font-size:10px;'><br>EN DESPACHO</small></td>";
                
                }
                
                let limite = 5;
                if(terminados.length<5){
                    
                        for (let i = 0; i < (limite - terminados.length); i++) {

                            html += "<td style='border: 2px solid black; padding: 5px; width: 20px; text-align: center;'></td>";

                        }

                }
                
                $("#mifila").html(html);
            }
        },
        error: function(resul){
            console.error("Error AJAX:", resul);
           // document.getElementById("numero_pedido").textContent = '--';
        }
    });
       
}

/**
 * Maneja el conteo y decide si anunciar el pedido.
 */
function manejar_anuncio(numero) {
    numero = String(numero);
    const ahora = Date.now();

    // Limpiar registros viejos
    for (const key in anuncios) {
        if (Object.prototype.hasOwnProperty.call(anuncios, key)) {
            if (ahora - anuncios[key].last > RESET_AFTER_MS) {
                delete anuncios[key];
            }
        }
    }

    // Si no existe el registro, crearlo
    if (!anuncios[numero]) {
        anuncios[numero] = { count: 0, last: ahora };
    }

    // Actualizar timestamp
    anuncios[numero].last = ahora;

    // Si ya anunció menos de MAX_REPITENCIAS, anunciar otra vez
    if (anuncios[numero].count < MAX_REPITENCIAS) {
        anuncios[numero].count++;
        anunciar_mi_pedido(numero);
    } else {
        // opcional: log o acción al superar límite
        console.log(`Pedido ${numero} ya anunciado ${anuncios[numero].count} veces — no se anuncia más.`);
    }

    // Opcional: si quieres ver en pantalla cuántas veces fue anunciado:
    // document.getElementById("numero_contador_anuncios").textContent = anuncios[numero].count;
}

function anunciar_mi_pedido(numero) {
    anunciar_numero(numero);
}

function anunciar_pedido(numero) {
    
    var base_url    = document.getElementById('base_url').value;
    var basePath = base_url + 'resources/sonidos/numeros/'; // Ruta en CodeIgniter
    numero = parseInt(numero);

    // Construir secuencia de archivos
    const secuencia = ["pedido.mp3"]; // Siempre inicia con "pedido.mp3"

    function pad2(n) { return n < 10 ? '0' + n : String(n); }

    if (isNaN(numero)) {
        console.error("Número inválido:", numero);
        return;
    }

    if (numero <= 500) {
       secuencia.push(numero+".mp3"); 
       
    }else{
        
    } 
    
//    else {
//        let centenas = Math.floor(numero / 100);
//        let decenas = Math.floor((numero % 100) / 10);
//        let unidades = numero % 10;
//        let resto = numero % 100;

        $("#numeros").text(numero);

//        // Centenas
//        if (centenas > 0) {
//            if (numero === 100) { secuencia.push("100.mp3"); }
//            else if (centenas === 1) { secuencia.push("100to.mp3"); }
//            else { secuencia.push((centenas * 100) + ".mp3"); }
//        }

//        // Decenas y unidades
//        if (resto > 0) {
//            if (resto <= 20) {
//                secuencia.push((resto < 10 ? pad2(resto) : String(resto)) + ".mp3");
//            } else if (resto < 30) {
//                secuencia.push("20y.mp3");
//                if (unidades > 0) secuencia.push(pad2(unidades) + ".mp3");
//            } else {
//                if (decenas > 0) secuencia.push((decenas * 10) + ".mp3");
//                if (unidades > 0) {
//                    secuencia.push("y.mp3");
//                    secuencia.push(pad2(unidades) + ".mp3");
//                }
//            }
//        }
//    }

    // Reproducir audios secuencialmente
    let i = 0;
    function reproducir() {
        if (i >= secuencia.length) return;
        let audio = new Audio(basePath + secuencia[i]);
        audio.playbackRate = 1;
        i++;
        audio.onended = reproducir;
        audio.play().catch(err => console.error("Error reproduciendo:", err));
    }
    reproducir();
}



function anunciar_numero(numero) {
     
    var base_url    = document.getElementById('base_url').value;
    var basePath = base_url+'resources/sonidos/numeros/'; // Ruta en CodeIgniter
    numero = parseInt(numero);

    // Construir secuencia de archivos
    const secuencia = ["pedido.mp3"]; // Siempre inicia con "pedido.mp3"
    
    if (numero <= 500) {
       secuencia.push(numero+".mp3"); 
       
    } 
    //if (isNaN(numero) || numero < 1 || numero > 1000) {
    //    secuencia.push("numero_invalido.mp3"); 
        //console.error("Número fuera de rango (1-1000)");
        //return;
    //}
/*
    function pad2(n) { return n < 10 ? '0' + n : String(n); }


    if (numero >= 1000) {
        
        if(numero === 1000){secuencia.push("1000.mp3"); }
        else{ secuencia.push("numero_invalido.mp3"); }
            
    } else {
        let centenas = Math.floor(numero / 100);
        let decenas = Math.floor((numero % 100) / 10);
        let unidades = numero % 10;
        let resto = numero % 100;
*/
     // alert(centenas+" ** "+decenas+" ** "+unidades+" ** "+resto);
     // 
     $("#numeros").text(numero);
     
 /*    
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
        }*/
   /// }//

    // Reproducir audios secuencialmente
    let i = 0;
    function reproducir() {
        if (i >= secuencia.length) return;
        let audio = new Audio(basePath + secuencia[i]);
        
        audio.playbackRate = 1; // 1.0 = normal, 2.0 = doble de rápido, 0.5 = mitad de velocidad
        i++;
        audio.onended = reproducir;
        audio.play().catch(err => console.error("Error reproduciendo:", err));
        
    }
    reproducir();

}