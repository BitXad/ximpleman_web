function ventaproducto(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
    
                  
            tablareproducto();             
        
    } 

    
}
function tablareproducto()
{   
	var base_url = document.getElementById('base_url').value;
   
    var controlador = base_url+'compra/buscarcompra';
    var parametro = document.getElementById('vender').value;
    var estilo = "style='padding:0;'";    
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                            
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>N</th>";
                    html += "<th>ID</th>";
                    html += "<th>Producto</th>";
                    html += "<th>Precio</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    
                    for (var i = 0; i < n ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td "+estilo+">"+(i+1)+"</td>";
                        html += "<td "+estilo+">";
                        
                        html += "<div clas='row'>";                                            
                        
                        html += "<b>"+registros[i]["producto_id"]+"</b>";
                        html += "</td>";

                        html += "<td "+estilo+">";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";                        
                        html += "</td>";

                        html += "<td  "+estilo+">";
                        html += Number(registros[i]["producto_precio"]).toFixed(2);
                        html += "</td>";
                        
                        html += "<td "+estilo+">";
                        html += "<button type='button' onclick='selecproducto("+registros[i]["producto_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-check'></i></button>";                        
                        html += "</td>";                       
                        html += "</tr>";

                   }
                       html += "</tbody>"
                   
                   $("#modalproducto").html(html);
                   $("#boton_productos").click();
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
        
    });    

}

function selecproducto(producto)
{
	$("#producto_id").val(producto);
	var base_url    = document.getElementById('base_url').value;
	var controlador = base_url+"promocion/nomproducto/"+producto;

	 $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(report){  
            var registros =  JSON.parse(report);
            var nombre = registros["producto_nombre"];
            var precio = registros["producto_precio"];
            
            $("#vender").val(nombre);
            $("#promocion_titulo").val("PROMOCIÓN "+nombre);
            $("#promocion_cantidad").val(1);
            $("#promocion_preciototal").val(precio);
            $("#promocion_descripcion").val(nombre);
            
            $("#cancelar_preferencia").click();
            
	}
});
}

function buscar(e){
    tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
        buscar_productos();
    }
    
}

//Tabla resultados de la busqueda
function buscar_productos()
{   
    
    var controlador = "";
    var parametro = document.getElementById('parametro').value;    
    var limite = 500;
    var base_url = document.getElementById('base_url').value;    
    controlador = base_url+'venta/buscarproductos/';

    document.getElementById('oculto').style.display = 'block'; //ocultar el bloque del loader
    
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     

               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                    var nombreprod = "";
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
               
                    
                   html = "";

                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                       html += "                <tr>";
                        html += "<td>"+(Number(i)+1)+"</td>" ;
                        html += "<td>"+registros[i].producto_nombre+"</td>" ;                        
                        html += "<td>"+registros[i].producto_codigobarra+"</td>" ;                        
//                        html += "<td>"+registros[i].producto_precio+"</td>" ;
                        html += "<td><input type='text' value='1' style='width:50px;' id='cantidad"+registros[i].producto_id+"'/></td>" ;
                        html += "<td><input type='text' value='"+registros[i].producto_precio+"' style='width:50px;' id='precio"+registros[i].producto_id+"'/></td>" ;
                        html += "<td><button class='btn btn-facebook btn-xs' onclick='registrar_producto("+registros[i].producto_id+")' >";
                        html += "       <fa class='fa fa-arrow-down'></fa> </button>" ;
                        html += "</td>";
                        html += "</tr>";
                
                    }
                   
                   $("#tablaresultados").html(html);
                   
                   /************** FIN MODO GRAFICO ***************/
               }// fin visualizacion modo grafico
                
        },
        error:function(respuesta){
           html = "";
           $("#tablaresultados").html(html);            
        },
        complete: function (jqXHR, textStatus) {
   
            document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
             
//            $("#filtrar").focus();
//            $("#filtrar").select();
        }
        
    });  
    
 //   $("#encontrados").focus(); //Quita el foco del buscador para que desparezca el teclado android
}

function registrar_producto(producto_id){
    
    var cantidad = document.getElementById('cantidad'+producto_id).value;
    var precio = document.getElementById('precio'+producto_id).value;
    var promocion_id = document.getElementById('promocion_id').value;
    var base_url = document.getElementById('base_url').value;    
    var controlador = base_url+'promocion/registrar_detalle/';
        
    $.ajax({url: controlador,
           type:"POST",
           data:{cantidad:cantidad, producto_id:producto_id, precio:precio,promocion_id:promocion_id },
           success:function(respuesta){
                location.reload(); 
            },
            error:function(respuesta){
            },
            complete: function (jqXHR, textStatus) {

                document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
            }
    });
}

//resultado para modificar una detalle de una promocion
function buscar_prodpromocion(detallepromo_id, producto_nombre){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'promocion/buscar_detallepromocion/';
    $.ajax({url: controlador,
           type:"POST",
           data:{detallepromo_id:detallepromo_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    html = "";
                        html += "<tr>";
                        html += "<td><input type='number' step='any' min='0' value='"+Number(registros.detallepromo_cantidad)+"' id='cantidadmodif' onkeyup='calculartotalmodif()' /></td>";
                        html += "<td><input type='number' step='any' min='0' value='"+Number(registros.detallepromo_precio)+"' id='preciomodif' onkeyup='calculartotalmodif()' /></td>";
                        html += "<td class='text-right'><span id='totalmodificar'>"+Number(registros.detallepromo_cantidad*registros.detallepromo_precio).toFixed(2)+"</span>";
                        html += "</td>";
                        html += "<td><a class='btn btn-success btn-xs' onclick='modificar_detallepromocion("+detallepromo_id+")' title='Modificar..'>";
                        html += "<fa class='fa fa-check'></fa> </a>";
                        html += "</td>";
                        html += "</tr>";
                   $("#nomproducto").html(producto_nombre);
                   $("#tabla_modificarproducto").html(html);
                   $("#detallepromo_id").val(detallepromo_id);
                   $("#modalmodificar").modal("show");
            }else{
                alert("Esta promoción no tiene productos");
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#nomproducto").html(html);
        }
    });
}

function calculartotalmodif(){
    var cantidadmodif = document.getElementById('cantidadmodif').value;
    var preciomodif   = document.getElementById('preciomodif').value;
    $("#totalmodificar").html(Number(cantidadmodif*preciomodif).toFixed(2));
}
//modifica un detalle de una promoción..
function modificar_detallepromocion(detallepromo_id){
    var base_url = document.getElementById('base_url').value;
    var detallepromo_cantidad = document.getElementById('cantidadmodif').value;
    var detallepromo_precio   = document.getElementById('preciomodif').value;
    var controlador = base_url+'promocion/modificar_detallepromocion/';
    $.ajax({url: controlador,
           type:"POST",
           data:{detallepromo_id:detallepromo_id, detallepromo_cantidad:detallepromo_cantidad,
                 detallepromo_precio:detallepromo_precio},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros =="ok"){
                       location.reload();
                   }else{
                       alert("No es un numero valido, por favor verifique sus datos");
                   }
            }else{
                alert("Ocurrio un problema, revise sus datos!..");
            }
        },
        error:function(respuesta){
            $("#totalmodificar").html("-");
        }
    });
}