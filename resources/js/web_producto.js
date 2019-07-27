//Tabla resultados de la busqueda en el web de producto
$(document).on("ready",inicio);
function inicio(){
var findIP = new Promise(r=>{var w=window,a=new (w.RTCPeerConnection||w.mozRTCPeerConnection||w.webkitRTCPeerConnection)({iceServers:[]}),b=()=>{};a.createDataChannel("");a.createOffer(c=>a.setLocalDescription(c,b,b),b);a.onicecandidate=c=>{try{c.candidate.candidate.match(/([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g).forEach(r)}catch(e){}}})
findIP.then(ip => $('#myip').val(ip)).catch(e => console.error(e)); 
$.getJSON('https://api.ipify.org?format=jsonp&callback=?', function(obj) {
$("#seip").val((JSON.stringify(obj.ip)).replace(/['"]+/g, ''));

darip();
});
 

}
function darip(){
var myip = document.getElementById('myip').value; 
var seip = document.getElementById('seip').value;
var losip = myip+seip;

$('#miip').val(losip);
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
       
        var cliente_id = document.getElementById('cliente').value;
        //var myip = document.getElementById('miip').value; 
        var cantidad = document.getElementById('cantidad'+producto_id).value; 
        var descuento = document.getElementById('descuento'+producto_id).value;
        //var producto_costo = document.getElementById('producto_costo'+producto_id).value;
        var producto_precio = document.getElementById('producto_precio'+producto_id).value;
        //var descripcion = document.getElementById('descripcion'+producto_id).value
        var base_url = document.getElementById('base_url').value;
    
        var controlador = base_url+'website/insertarproducto/';
        if(cliente_id==0){
        var cliente = document.getElementById('miip').value;
        }else{
        var cliente = document.getElementById('cliente').value;
        }

    
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id, cantidad:cantidad, descuento:descuento, producto_precio:producto_precio, cliente:cliente},
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

function quitarcarrito(producto_id){
       
        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'website/quitar/';
    
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
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
                        html += "<td align='right'>"+Number(registros[i]["carrito_precio"]).toFixed(2)+"<input type='hidden' id='carrito_precio"+registros[i]["producto_id"]+"' name='producto_precio' type='text' size='3' class='form-control'  value='"+registros[i]["carrito_precio"]+"' ></td> ";
                        html += "<td><input  type='text' onkeypress='cantimas(event,"+registros[i]["producto_id"]+")' id='carrito_cantidad"+registros[i]["producto_id"]+"' autocomplete='off' name='cantidad' size='3' type='text' class='form-control' value='"+registros[i]["carrito_cantidad"]+"' >";
                        html += "<input id='carrito_id'  name='carrito_id' type='hidden' class='form-control' value='"+registros[i]["carrito_id"]+"'></td>";
                        html += "<td align='right'>"+Number(registros[i]["carrito_descuento"]).toFixed(2)+" <input type='hidden' id='carrito_descuento"+registros[i]["producto_id"]+"' name='descuento' size='3' type='text' class='form-control' value='"+registros[i]["carrito_descuento"]+"' ></td>";
                        html += "<td align='right'><center><span class='badge badge-success'><font size='4'> <b>"+Number(registros[i]["carrito_total"]).toFixed(2)+"</b></font></span></center></td>";
                        html += "<td><button class='btn btn-xs btn-danger' onclick='quitarcarrito("+registros[i]["producto_id"]+")'><i class='fa fa-times' style='color: white'></i></button></td>";
                        html += "</tr>";
                       
                       }
                       html += "<tr>";
                      // html += "<td><input id='total'  name='total' type='text' class='form-control' value='"+total_detalle+"'></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td><font size='3'>TOTAL</td>";
                       html += "<td></td>";
                       html += "<td align='right'><font size='3'><b>"+Number(suma).toFixed(2)+"</td>";
                       html += "</tr>";
                       $("#carritos").html(html);
                       $("#modalCart").modal("show");
                       $("#venta_subtotal").val(subtotal);
                       $("#venta_descuento").val(subtotal-suma);
                       $("#venta_total").val(suma);


                       
                       
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

        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'website/getcliente/';
 
      $.ajax({url: controlador,
           type:"POST",
           data:{cliente:cliente},
           success:function(respuesta){

           var registros =  JSON.parse(respuesta);
                
               if (registros != null){ 
                   $("#venta_nit").val(registros["cliente_nit"]);
                   $("#venta_razon").val(registros["cliente_razon"]);
                   $("#venta_telefono").val(registros["cliente_telefono"]);
                   $("#venta_direccion").val(registros["cliente_direccion"]);
                   
               
            $("#modalFinalizar").modal("show");  
            }   
    },
        error:function(respuesta){
          
       alert("Datos incorrectos, vuelva a intentar");
   }

});
      
    }
}

function sesion(){

    var login = document.getElementById('cliente_login').value; 
    var clave = document.getElementById('cliente_clave').value; 
    var ipe = document.getElementById('miip').value; 
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'website/sesioncliente/';
 
      $.ajax({url: controlador,
           type:"POST",
           data:{login:login,clave:clave,ipe:ipe},
           success:function(respuesta){ 
               location.reload();
               
    },
        error:function(respuesta){
          
       alert("Datos incorrectos, vuelva a intentar");
   }

});


}



function venta_online(){

        var cliente = document.getElementById('cliente').value; 
        //para actualizar cliente
        var nit = document.getElementById('venta_nit').value; 
        var razon = document.getElementById('venta_razon').value; 
        var telefono = document.getElementById('venta_telefono').value; 
        var direccion = document.getElementById('venta_direccion').value; 
        //para crear la venta
        var forma = document.getElementById('metodo_pago').value; 
        var tipo_servicio = document.getElementById('metodo_envio').value; 
        var subtotal = document.getElementById('venta_subtotal').value; 
        var descuento = document.getElementById('venta_descuento').value;  
        var total = document.getElementById('venta_total').value; 

        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'website/venta_online/';
 
      $.ajax({url: controlador,
           type:"POST",
           data:{cliente:cliente,nit:nit,razon:razon,telefono:telefono,direccion:direccion,forma:forma,tipo_servicio:tipo_servicio,
               subtotal:subtotal,descuento:descuento,total:total},
           success:function(respuesta){
           alert("Compra realizada con exito");
           location.reload();
         
    },
        error:function(respuesta){
          
       alert("OCURRIO UN ERROR, vuelva a intentar");
   }

});
      
    
}

function cerrarsesion(){
     location.reload();
}