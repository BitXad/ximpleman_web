//Tabla resultados de la busqueda en el web de producto
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
                        html += "<input type='hidden' name='add' value='1'>";
                        html += "<input type='hidden' name='business' value=' '>";
                        html += "<input type='hidden' name='item_name' value='"+registros[i]["producto_nombre"]+"'>";
                        html += "<input type='hidden' name='amount' value='"+registros[i]["producto_precio"]+"'>";
                        html += "<input type='hidden' name='discount_amount' value='0.00'>";
                        html += "<input type='hidden' name='currency_code' value='USD'>";
                        html += "<input type='hidden' name='return' value=' '>";
                        html += "<input type='hidden' name='cancel_return' value=' '>";
                        html += "<input type='button' name='submit' data-toggle='modal' data-target='#modalCart' value='Añadir al pedido' class='button'>";
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
                        html += "<input type='hidden' name='add' value='1'>";
                        html += "<input type='hidden' name='business' value=' '>";
                        html += "<input type='hidden' name='item_name' value='"+registros[i]["producto_nombre"]+"'>";
                        html += "<input type='hidden' name='amount' value='"+registros[i]["producto_precio"]+"'>";
                        html += "<input type='hidden' name='discount_amount' value='0.00'>";
                        html += "<input type='hidden' name='currency_code' value='USD'>";
                        html += "<input type='hidden' name='return' value=' '>";
                        html += "<input type='hidden' name='cancel_return' value=' '>";
                        html += "<input type='button' name='submit' data-toggle='modal' data-target='#modalCart' value='Añadir al pedido' class='button'>";
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

