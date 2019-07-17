//Tabla resultados de la busqueda en el web de producto
$(document).on("ready",inicio);
function inicio(){

var findIP = new Promise(r=>{var w=window,a=new (w.RTCPeerConnection||w.mozRTCPeerConnection||w.webkitRTCPeerConnection)({iceServers:[]}),b=()=>{};a.createDataChannel("");a.createOffer(c=>a.setLocalDescription(c,b,b),b);a.onicecandidate=c=>{try{c.candidate.candidate.match(/([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g).forEach(r)}catch(e){}}})
findIP.then(ip => $('#miip').val(ip)).catch(e => console.error(e));      
        
}


function buscar_producto()
{
    var base_url = document.getElementById('base_url').value;
    var idioma_id = document.getElementById('idioma_id').value;
    controlador = base_url+'website/webbuscar_productos/';
    parametro = document.getElementById('parabuscar').value;
    if(parametro != ""){
        document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if(registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                    for (var i = 0; i < n ; i++){
                        var mimagen = "";
                        if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                            mimagen += "<a href='website/single/"+idioma_id+"/"+registros[i]["producto_id"]+"'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+registros[i]["producto_foto"]+"' class='img img-circle' width='50' height='50' />";
                            mimagen += "</a>";
                        }else{
                            mimagen += "<a href='website/single/"+idioma_id+"/"+registros[i]["producto_id"]+"'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_image.png' class='img img-circle' width='50' height='50' />";
                            mimagen += "</a>";
                        }
                        var cadena = registros[i]["producto_nombre"];
                        var nombre = "";
                        if(cadena.length>22){
                            nombre = cadena.substr(0, 20)+"...";
                        }else{
                            nombre = registros[i]["producto_nombre"];
                        }
                            
                        html += "<div class='col-md-3 top_brand_left-1'>";
                        html += "<div class='hover14 column'>";
                        html += "<div class='agile_top_brand_left_grid'>";
                        /*html += "<div class='agile_top_brand_left_grid_pos'>";
                        html += "<img src='"+base_url+"images/offer.png"+"' alt=' ' class='img-responsive'>";
                        html += "</div>";*/
                        html += "<div class='agile_top_brand_left_grid1'>";
                        html += "<figure>";
                        html += "<div class='snipcart-item block'>";
                        html += "<div class='snipcart-thumb'>";
                        html += mimagen;
                        html += "<a href='website/single/"+idioma_id+"/"+registros[i]["producto_id"]+"'><p><b><div class='text-center' title='"+cadena+"'>"+nombre+"</div></b></p></a>";
                        /*html += "<div class='stars'>";
                        html += "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                        html += "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                        html += "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                        html += "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                        html += "<i class='fa fa-star gray-star' aria-hidden='true'></i>";
                        html += "</div>";*/
                        html += "<h4> Bs. "+Number(registros[i]["producto_precio"]).toFixed(2)+"</h4>";
                        html += "</div>";
                        html += "<div class='snipcart-details top_brand_home_details'>";
                        html += "<form action='#' method='post'>";
                        html += "<fieldset>";
                        html += "<input type='hidden' name='cmd' value='_cart'>";
                        html += "<input type='hidden' name='add' id='cantidad"+registros[i]["producto_id"]+"' value='1'>";  
                        html += "<input type='hidden' name='business' value=' '>";
                        html += "<input type='hidden' name='item_name' value='"+registros[i]["producto_nombre"]+"'>";
                        html += "<input type='hidden' name='amount' id='producto_precio"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_precio"]+"'>";
                        html += "<input type='hidden' name='costo' id='producto_costo"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_costo"]+"'>";
                        html += "<input type='hidden' name='discount_amount' id='descuento"+registros[i]["producto_id"]+"' value='0.00'>";
                        html += "<input type='hidden' name='currency_code' value='USD'>";
                        html += "<input type='hidden' name='return' value=' '>";
                        html += "<input type='hidden' name='cancel_return' value=' '>";
                        html += "<input type='button' value='Añadir al pedido' onclick='insertar("+registros[i]["producto_id"]+")'  class='button'>";

                        //html += "<input type='button' name='submit' data-toggle='modal' data-target='#modalCart' value='Añadir al pedido' class='button'>";
                        html += "</fieldset>";
                        html += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</figure>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        
                   }
                   
                   
                   $("#tablaresultados").html(html);
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

}

function buscar_categoria(categoria)
{
    var base_url = document.getElementById('base_url').value;
    var idioma_id = document.getElementById('idioma_id').value;
    var controlador = base_url+'website/webbuscar_categoria/'+categoria;
    
    if(categoria != ""){
        document.getElementById('loader1').style.display = 'block'; //muestra el bloque del loader
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if(registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                    html2 = "";
                    html2 += "<b>"+registros[0]["categoria_nombre"]+"<b>";

                    for (var i = 0; i < n ; i++){
                        var mimagen = "";
                        if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                            mimagen += "<a href='website/single/"+idioma_id+"/"+registros[i]["producto_id"]+"'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+registros[i]["producto_foto"]+"' class='img img-circle' width='50' height='50' />";
                            mimagen += "</a>";
                        }else{
                            mimagen += "<a href='website/single/"+idioma_id+"/"+registros[i]["producto_id"]+"'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_image.png' class='img img-circle' width='50' height='50' />";
                            mimagen += "</a>";
                        }
                        var cadena = registros[i]["producto_nombre"];
                        var nombre = "";
                        if(cadena.length>22){
                            nombre = cadena.substr(0, 20)+"...";
                        }else{
                            nombre = registros[i]["producto_nombre"];
                        }
                            
                        html += "<div class='col-md-3 top_brand_left-1'>";
                        html += "<div class='hover14 column'>";
                        html += "<div class='agile_top_brand_left_grid'>";
                        /*html += "<div class='agile_top_brand_left_grid_pos'>";
                        html += "<img src='"+base_url+"images/offer.png"+"' alt=' ' class='img-responsive'>";
                        html += "</div>";*/
                        html += "<div class='agile_top_brand_left_grid1'>";
                        html += "<figure>";
                        html += "<div class='snipcart-item block'>";
                        html += "<div class='snipcart-thumb'>";
                        html += mimagen;
                        html += "<a href='website/single/"+idioma_id+"/"+registros[i]["producto_id"]+"'><p><b><div class='text-center' title='"+cadena+"'>"+nombre+"</div></b></p></a>";
                        /*html += "<div class='stars'>";
                        html += "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                        html += "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                        html += "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                        html += "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                        html += "<i class='fa fa-star gray-star' aria-hidden='true'></i>";
                        html += "</div>";*/
                        html += "<h4> Bs. "+Number(registros[i]["producto_precio"]).toFixed(2)+"</h4>";
                        html += "</div>";
                        html += "<div class='snipcart-details top_brand_home_details'>";
                        html += "<form action='#' method='post'>";
                        html += "<fieldset>";
                        html += "<input type='hidden' name='cmd' value='_cart'>";
                        html += "<input type='hidden' name='add' id='cantidad"+registros[i]["producto_id"]+"' value='1'>";  
                        html += "<input type='hidden' name='business' value=' '>";
                        html += "<input type='hidden' name='item_name' value='"+registros[i]["producto_nombre"]+"'>";
                        html += "<input type='hidden' name='amount' id='producto_precio"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_precio"]+"'>";
                        html += "<input type='hidden' name='costo' id='producto_costo"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_costo"]+"'>";
                        html += "<input type='hidden' name='discount_amount' id='descuento"+registros[i]["producto_id"]+"' value='0.00'>";
                        html += "<input type='hidden' name='currency_code' value='USD'>";
                        html += "<input type='hidden' name='return' value=' '>";
                        html += "<input type='hidden' name='cancel_return' value=' '>";
                        html += "<input type='button' value='Añadir al pedido' onclick='insertar("+registros[i]["producto_id"]+")'  class='button'>";
                        html += "</fieldset>";
                        html += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</figure>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        
                   }
                   
                   $("#la_categoria").html(html2);
                   $("#tablacategorias").html(html);
                   document.getElementById('loader1').style.display = 'none';
                }
                document.getElementById('loader1').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablacategorias").html(html);
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader1').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
        
        });
    }

}

function insertar(producto_id){
       


        var myip = document.getElementById('miip').value; 
        var cantidad = document.getElementById('cantidad'+producto_id).value; 
        var descuento = document.getElementById('descuento'+producto_id).value;
        //var producto_costo = document.getElementById('producto_costo'+producto_id).value;
        var producto_precio = document.getElementById('producto_precio'+producto_id).value;
        //var descripcion = document.getElementById('descripcion'+producto_id).value
        var base_url = document.getElementById('base_url').value;
    
        var controlador = base_url+'website/insertarproducto/';
   
    
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id, cantidad:cantidad, descuento:descuento, producto_precio:producto_precio, myip:myip},
           success:function(respuesta){     
              tablacarrito(); 
         }
    });

}

function cantimas(e,producto_id){
   
   tecla = (document.all) ? e.keyCode : e.which; 
   
   if (tecla==13){ 
        cantidar(producto_id);
   }
}

function cantidar(producto_id){
       
   
        var cantidad = document.getElementById('carrito_cantidad'+producto_id).value; 
        var descuento = document.getElementById('carrito_descuento'+producto_id).value;
        //var producto_costo = document.getElementById('producto_costo'+producto_id).value;
        var producto_precio = document.getElementById('carrito_precio'+producto_id).value;
        //var descripcion = document.getElementById('descripcion'+producto_id).value
        var base_url = document.getElementById('base_url').value;
    
        var controlador = base_url+'website/cantidad/';
   
    
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id, cantidad:cantidad, descuento:descuento, producto_precio:producto_precio},
           success:function(respuesta){     
              tablacarrito(); 
         }
    });

}


function tablacarrito(){
    var cliente_id = document.getElementById('cliente').value;
    if(cliente_id==0){
        var cliente = document.getElementById('miip').value;
    }else{
        var cliente = document.getElementById('cliente').value;
    }
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'website/carrito/';
 
      $.ajax({url: controlador,
           type:"POST",
           data:{cliente:cliente},
           success:function(respuesta){ 

     var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    var total_detalle = Number(0);
                    var suma = Number(0);
                    var subtotal = Number(0);
                    var descuento = Number(0);
                    html = "";
                    
                    
                    for (var i = 0; i < n ; i++){
                        
                        suma += Number(registros[i]["carrito_total"]);
                        descuento += Number(registros[i]["carrito_descuento"]);
                        subtotal += Number(registros[i]["carrito_subtotal"]);
                        total_detalle = Number(subtotal);

                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["producto_nombre"]+"</b>";
                        html += " <input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'></td>";
                        html += "<td>"+registros[i]["carrito_precio"]+"<input type='hidden' id='carrito_precio"+registros[i]["producto_id"]+"' name='producto_precio' type='text' size='3' class='form-control'  value='"+registros[i]["carrito_precio"]+"' ></td> ";
                        html += "<td><input  type='text' onkeypress='cantimas(event,"+registros[i]["producto_id"]+")' id='carrito_cantidad"+registros[i]["producto_id"]+"' autocomplete='off' name='cantidad' size='3' type='text' class='form-control' value='"+registros[i]["carrito_cantidad"]+"' >";
                        html += "<input id='carrito_id'  name='carrito_id' type='hidden' class='form-control' value='"+registros[i]["carrito_id"]+"'></td>";
                        html += "<td>"+registros[i]["carrito_descuento"]+" <input type='hidden' id='carrito_descuento"+registros[i]["producto_id"]+"' name='descuento' size='3' type='text' class='form-control' value='"+registros[i]["carrito_descuento"]+"' ></td>";
                        html += "<td><center><span class='badge badge-success'><font size='4'> <b>"+registros[i]["carrito_total"]+"</b></font></span></center></td>";
                        html += "</tr>";
                       
                       }
                       html += "<tr>";
                      // html += "<td><input id='total'  name='total' type='text' class='form-control' value='"+total_detalle+"'></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td><font size='3'>TOTAL</td>";
                       html += "<td></td>";
                       html += "<td><font size='3'><b>"+suma+"</td>";
                       html += "</tr>";
                       $("#carritos").html(html);
                       $("#modalCart").modal("show");

                       
                       
          }  
        },
        error:function(respuesta){
          
       
   }

});
}

function realizarcompra(){

    var cliente = document.getElementById('cliente').value; 
    if (cliente==0) {
        $("#modalCliente").modal("show");  
    }else{
      $("#modalFinalizar").modal("show");   
    }
}
    