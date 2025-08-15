 $(document).on("ready",inicio_recepcion);
function inicio_recepcion(){
    
      
       	recepcion(1); 


        
setInterval('actualizar()',15000);
          //aca podemos mandar fecha 
}
function actualizar()
{
    var estado = 1;
    var ventas = document.getElementById('ventas').value;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/actualizar";
    
    $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado},

           success:function(resul){                

               var registros =  JSON.parse(resul);

               var n = registros.length; //tamaÃ±o de

    if (n>ventas) {

    recepcion(1);

    }   

      },
        error:function(resul){

        }

    });   

}

function buscar_por_entrega()
{
   
    var entrega = document.getElementById('entrega_id').value;
    
    recepcion(entrega);
    
}

function recepcion(estado)
{   
    var decimales    = document.getElementById('decimales').value;
    var base_url    = document.getElementById('base_url').value;
    var destino    = document.getElementById('destino_id').value;
    var controlador = base_url+"detalle_venta/recepcionhoy";
    var clasificador = "";
    
    document.getElementById('oculto').style.display = 'block';
    $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado,destino:destino},
          
           success:function(resul){     
                
               var registros =  JSON.parse(resul);
               var ventas = registros.datos;
               var detalle = registros.detalle;
               
                var cantidadtotal = ventas.length; //tamaño del arreglo de la consulta
               // depuramos las ventas sin detalle con destino a cocina
               let ventaIdsDetalleSet = new Set(detalle.map(d => d.venta_id));

                // Filtrar ventas usando el Set
                let ventasDepuradas = ventas.filter(v => ventaIdsDetalleSet.has(v.venta_id));
                ventas = ventasDepuradas;
               
               // fin depuramos las ventas sin detalle con destino a cocina
               
                var n = ventas.length; //tamaño del arreglo de la consulta
                var d = detalle.length; //tamaño del arreglo de la consulta
                
                
           if(d>0){ 
            document.getElementById('timbre').play();
               if (ventas != null){

                   
                    html = "";
                    let color = "background:lightgray;";
                    
               	for (var i = 0; i < n ; i++){
                    
                        if (Number(ventas[i]["entrega_id"]) != 1){
                            color = "background:lightgray;";
                        }else{
                             color = "";
                        }
                           
                        html += "<tr style='border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;'>";
                        //#
                        html += "<td style='"+color+"'>"+(i+1)+"</td>";
                        //CLIENTE
                        html += "<td align='center'  style='line-height:8px; "+color+"' ><br><b style='font-size: 40px;'><fa class='fa fa-user'></fa> </b></br>";
                        html += "<br><b style='font-size: 14px;'>"+ventas[i]["cliente_razon"]+"</b>";
                        html += "<br><br><b style='font-size: 8px;'> ATENDIDO POR:<br><fa class='fa fa-users'></fa>"+ventas[i]["usuario_nombre"]+"</b>";                        

                        if (ventas[i]["mesa_nombre"]!=null){
                            html += "<br><br><b>Mesa:  "+ventas[i]["mesa_nombre"]+"</b>";
                    	}
                        
                        html += "<br><br>";
                        html += "</td>";
                        
                        //PEDIDO
                        html += "<td style='"+color+"'>";
                for (var e = 0; e < d; e++) {
                    
                        
                	if (ventas[i]["venta_id"]==detalle[e]["venta_id"]) {
                        
                            if (detalle[e]["clasificador_nombre"]!=null){
                                clasificador = detalle[e]["clasificador_nombre"];
                            }
                            
                            	let partes = detalle[e]["detalleven_cantidad"]; 
                                let partes1 = partes.toString(); 
                                let partes2 = partes1.split('.'); 
                                if (partes2[1] == 0) {  
                                    lacantidad = partes2[0];  
                                }else{  
                                    lacantidad = numberFormat(Number(detalle[e]["detalleven_cantidad"]).toFixed(decimales)) 
                                    //lacantidad = number_format($d['detalleven_cantidad'],2,'.',',');  
                                }

                            html += "<b style='font-size: 16px;'>"+lacantidad+" "+detalle[e]["producto_nombre"]+"</b>";
                            html += "<br>";
                            
                            if (detalle[e]["clasificador_nombre"]!=null){
                                html += "<span style='font-size:13px; padding-top:0px; padding-bottom:0px;' class='label label-warning'><b><fa class='fa fa-check-circle-o'></fa> "+clasificador+"</b></span>";
                            }
                            
                            if (detalle[e]["preferencia_descripcion"]!=null && detalle[e]["preferencia_descripcion"]!="-"){
                                html += "<span style='font-size:13px;  padding-top:0px; padding-bottom:0px;' class='label label-info'><b><fa class='fa fa-check-circle-o'></fa> "+detalle[e]["preferencia_descripcion"]+"</b></span>";
                            }
                            
                            if (detalle[e]["detalleven_unidadfactor"]!="" && detalle[e]["detalleven_unidadfactor"]!="-"){
                                html += "<span style='font-size:13px;  padding-top:0px; padding-bottom:0px;' class='label label-danger'><b><fa class='fa fa-check-circle-o'></fa> "+detalle[e]["detalleven_unidadfactor"]+"</b></span>";
                            }
                            
                            if (detalle[e]["detalleven_preferencia"]!='null' && detalle[e]["detalleven_preferencia"]!=""){
                                html += "<br><fa class='fa fa-file-text'></fa> "+detalle[e]["detalleven_preferencia"];
                            }
                            html +="<br>";
                            html +="<br>";
                            
                        }
                         
                      }
                     
                        html += "</td>";
                        
                        html += "<td align='center' style='"+color+"'><b style='font-size: 20px;'>"+ventas[i]["venta_numeroventa"]+"</b>"; 
                        html += "<br> "+ventas[i]["tiposerv_descripcion"]+"<br>"+ventas[i]["venta_hora"];
                        if(ventas[i]["entrega_id"]==1){                            
                            html += "<br><span class='btn btn-facebook btn-xs'> "+ventas[i]["entrega_nombre"]+"</span></td>";
                        }else{
                            html += "<br><span class='btn btn-danger btn-xs'> "+ventas[i]["entrega_nombre"]+"</span></td>";                            
                        }
                        
                        if (ventas[i]["entrega_id"]==1 || ventas[i]["entrega_id"]==2) {
                            //ventas[i]["entrega_nombre"]
                        html += "<td align='center' style='"+color+"'> <button class='btn btn-warning btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='DESPACHAR' onclick='pedido_terminado("+ventas[i]["venta_id"]+")'><font size='5'><span class='fa fa-cutlery'></span></font><br> DESPACHAR PEDIDO </button>";
                        
                        html += "<br><br><button class='btn btn-info btn-xs' onclick='anunciar_mi_pedido("+ventas[i]["venta_numeroventa"]+")'><font size='1'><span class='fa fa-volume-up'></span> ANUNCIAR PEDIDO</font></button>";
                        
                        html += "<!------------------------ INICIO modal para confirmar eliminan ------------------->";
                        html += "<div class='modal fade' id='myModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header' style='background:gray;'>";
                        html += "<b><span class='fa fa-cutlery'></span> DEPACHO DE PEDIDOS</b>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        
                        html += "<center>";                        
                        html += "<h3><b> <span class='fa fa-cutlery'></span></b>";
                        html += "   DESPACHA PEDIDO Nº<b> "+ventas[i]["venta_numeroventa"]+"</b><br> <fa class='fa fa-user'></fa> <b>"+ventas[i]["cliente_nombre"]+" </b>";
                        html += "<br><small>** "+ventas[i]["tiposerv_descripcion"]+" **</small>";
                        html += "</h3>";
                        
                        html += "<br><button class='btn btn-info btn-xs' onclick='anunciar_mi_pedido("+ventas[i]["venta_numeroventa"]+")'><font size='1'><span class='fa fa-volume-up'></span> ANUNCIAR PEDIDO</font></button>";
                        
                        html += "</center>";
                        
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        
                            html += "<center>";
                            html += "<button type='button' onclick='despachar("+ventas[i]["venta_id"]+")' class='btn btn-success' data-dismiss='modal' style='width:100px;'><span class='fa fa-check'></span> Si </button>";
                            html += "<button class='btn btn-danger' data-dismiss='modal' style='width:100px;'><span class='fa fa-times'></span> No </button>";
                            html += "</center>";

                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
                        html += "</td>";
                        
                        }else{
                            
                        html += "<td align='center'><a class='btn btn-success btn-xs' data-toggle='modal' data-target='#myreModal"+i+"' title='RESTABLECER'>"+ventas[i]["entrega_nombre"]+"</a>";
                        html += "<br>"+moment(ventas[i]["venta_fechaentrega"]).format('DD/MM/YYYY')+"  "+ventas[i]["venta_horaentrega"]+"</br>";
                        html += "<!------------------------ INICIO modal para confirmar eliminan ------------------->";
                        html += "<div class='modal fade' id='myreModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><b> <span class='fa fa-cutlery'></span></b>";
                        html += "    Reestablecer el Pedido <b># "+ventas[i]["venta_numeroventa"]+"</b><br> De : <b>"+ventas[i]["cliente_nombre"]+" </b>";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        
                            html += "<center>";
                            html += "<button type='button'  data-dismiss='modal' onclick='restablecer("+ventas[i]["venta_id"]+")' class='btn btn-success' style='width:100px;'><span class='fa fa-check'></span> Si</button>";
                            html += " <button class='btn btn-danger' data-dismiss='modal' style='width:100px;'><span class='fa fa-times'></span> No </button>";
                            html += "</center>";
                            
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminacin ------------------->";
                        html += "</td>";	
                        }
                        html += "</tr>";
                     	
                    
                       
                       // detalle_venta(ventas[i]["venta_id"]);
                    } 
                       
                   
                   $("#tabla_recepcion").html(html);
                   $("#ventas").val(cantidadtotal);
                   
            }
          } document.getElementById('oculto').style.display = 'none';      
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_recepcion").html(html);
        }
        
    });   

}

function despachar(venta)
{   var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/despachar/'+venta;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
             location.reload();
            //recepcion(1);
      }
    });   

}

function pedido_terminado(venta)
{   var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/pedido_terminado/'+venta;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
            //recepcion(1);
      }
    });   

}


function restablecer(venta)
{
    
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/restablecer/'+venta;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
    recepcion(1);
      $("#entrega_id").val('1');

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
        
        audio.playbackRate = 1.0; // 1.0 = normal, 2.0 = doble de rápido, 0.5 = mitad de velocidad
        i++;
        audio.onended = reproducir;
        audio.play().catch(err => console.error("Error reproduciendo:", err));
        
    }
    reproducir();

}

function probar_audio(){
    numero_contador = document.getElementById("numero_contador").value;
    document.getElementById('timbre').play();
    anunciar_pedido(numero_contador);
    
    numero_contador = Number(numero_contador) + 1;
    document.getElementById("numero_contador").value = numero_contador;
    
}


function sleep(milliseconds) {
 var start = new Date().getTime();
 for (var i = 0; i < 1e7; i++) {
  if ((new Date().getTime() - start) > milliseconds) {
   break;
  }
 }
}