$(document).on("ready",inicio);
function inicio(){
        tablaresultados(1);
        tablaproductos();
        
//	$("#buscar").keyup(function(){
//		buscar = $("#buscar").val();
//		mostrarDatos(buscar);
//	});
//	$("#btnbuscar").click(function(){
//		mostrarDatos("");
//	});
//	$("#btnnit").click(function(){
//		buscarcliente();
//	});
//
//    $("#btnactualizar").click(actualizar);
//	
//        $("form").submit(function (event){
//
//		event.preventDefault();
//
//		$.ajax({
//			url:$("form").attr("action"),
//			type:$("form").attr("method"),
//			data:$("form").serialize(),
//			success:function(respuesta){
//				//alert(respuesta);
//			}
//		});
//	});
//        
//	$("body").on("click","#listaEmpleados a",function(event){
//		event.preventDefault();
//		idsele = $(this).attr("href");
//		nombressele = $(this).parent().parent().children("td:eq(1)").text();
//		apellidossele = $(this).parent().parent().children("td:eq(2)").text();
//		dnisele = $(this).parent().parent().children("td:eq(3)").text();
//		telefonosele = $(this).parent().parent().children("td:eq(4)").text();
//		emailsele = $(this).parent().parent().children("td:eq(5)").text();
//
//		$("#idsele").val(idsele);
//		$("#nombressele").val(nombressele);
//		$("#apellidossele").val(apellidossele);
//		$("#dnisele").val(dnisele);
//		$("#telefonosele").val(telefonosele);
//		$("#emailsele").val(emailsele);
//	});
//
//
//	$("body").on("click","#listaPedido button",function(event){
//		mostrar("");
//	});
        
}

function calcularDesc(){

   var venta_subtotal = document.getElementById('venta_subtotal').value;
   var venta_descuento = document.getElementById('venta_descuento').value;      
   var subtotal = Number(venta_subtotal) - Number(venta_descuento);

   $("#venta_totalfinal").val(subtotal);
   $("#venta_efectivo").val(subtotal);
   
}

function calcularCambio(){
   var venta_efectivo = document.getElementById('venta_efectivo').value;
   var venta_totalfinal = document.getElementById('venta_totalfinal').value;
   
   var venta_cambio = Number(venta_efectivo) - Number(venta_totalfinal);
   $("#venta_cambio").val(venta_cambio.toFisxed(2));
    
}

//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function entravalidar(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
        if (opcion==1){             
            buscarcliente();            
        }

        if (opcion==2){   
            $("#telefono").val(''); //si la tecla proviene del input telefono
           document.getElementById('telefono').focus();           
        } 
        if (opcion==3){   //si la tecla proviene del input codigo de barras
            buscarporcodigo();           
        } 
        if (opcion==4){   //si la tecla proviene del 
            tablaresultados1(1);           
        } 
        
    } 

    
}

function salivalidar(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
        if (opcion==1){             
            buscarcliente();            
        }

        if (opcion==2){   
            $("#telefono").val(''); //si la tecla proviene del input telefono
           document.getElementById('telefono').focus();           
        } 
        if (opcion==3){   //si la tecla proviene del input codigo de barras
            buscarporcodigo();           
        } 
        if (opcion==4){   //si la tecla proviene del 
            tablaresultados2(1);           
        } 
        
    } 

    
}



//muestra la tabla de productos disponibles para la venta
function tablaproductos()
{   
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/detalleventa';
    
    $.ajax({url: controlador,
           type:"POST",
           data:{datos:1},
           success:function(respuesta){     
               
               var registros = JSON.parse(respuesta);
                
               if (registros != null){

                       var subtotal = 0;
                       var descuento = 0;
                       var descgral = 0;
                       var totalfinal = 0;
                        html = "";
                        html += "<table class='table table-striped table-condensed' id='mitablaventas'>";
                        html += "                    <tr>";
                        html += "                            <th>Nº</th>";
                        html += "                            <th>Descripción</th>";                            
                        html += "                            <th>Código</th>";
                        html += "                            <th>Cant</th>";
                        html += "                            <th>Precio</th>";
//                        html += "                            <th>Sub <br> Total</th>";
//                        html += "                            <th>Moneda</th>";
//                        html += "                            <th>Foto</th>";
                        html += "                            <th>Precio<br>Total</th>";
                        html += "                            <th> </th>";
                        html += "                    </tr>";                
                        html += "                    <tbody class='buscar2'>";

                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var x = registros.length; //tamaño del arreglo de la consulta
                      
                    for (var i = 0; i < x ; i++){


                           cont = cont+1;
                           cant_total+= parseFloat(registros[i]["detalleven_cantidad"]);
                           total_detalle+= parseFloat(registros[i]["detalleven_total"]);
                                 
                        html += "                    <tr>";
                        html += "			<td>"+cont+"</td>";
                        html += "                       <td><b><font size=2>"+registros[i]["producto_nombre"]+"</font></b>";
                        html += "                           <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"];
                        html += "                       </td>";
                        html += "                       <td align='center'>";
                        html += "                           <b><font size=2>"+registros[i]["producto_codigo"]+"</font></b><br>";
                        html += "                           "+registros[i]["producto_codigobarra"];
                        html += "                       </td>";
                        html += "			<td align='center'> <button onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";
                        html += "        <input size='5' name='cantidad' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+registros[i]["detalleven_cantidad"]+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'>";
                        html += "        <button onclick='incrementar(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></a></button></td>";
                        html += "			<td align='right'><input size='5' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'></td>";
                        html += "                       <td align='right'><font size='3' ><b>"+parseFloat(registros[i]["detalleven_total"]).toFixed(decimales)+"</b></font></td>";
//                        html += "			<td>"+registros[i]["producto_foto"]+"</td>";
//                        html += "			<td>"+registros[i]["detalleven_comision"]+"</td>";
//                        html += "			<td>"+registros[i]["detalleven_tipocambio"]+"</td>";
                        html += "			<td>";
//                        html += "                            <a href='"+base_url+"producto/edit"+registros[i]["producto_id"]+"' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a> ";
//                        html += "                            <a href='"+base_url+"venta/eliminaritem/"+registros[i]["detalleven_id"]+"' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a>";
//                        html += "                            <a href='"+base_url+"producto/edit"+registros[i]["producto_id"]+"' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a> ";
                        html += "                            <button onclick='quitarproducto("+registros[i]["detalleven_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a></button> ";
                        html += "                        </td>";
                        html += "                    </tr>";  
                   }
                 
                   html += "                    </tbody>";
                   html += "                    <tr>";
                   html += "                            <th><button onclick='quitartodo()' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a> Quitar Todo</button> </th>";
                   html += "                            <th></th>";
                   html += "                            <th></th>";
                   html += "                            <th><font size='3'>"+cant_total.toFixed(decimales)+"</font></th>";
                   html += "                            <th></th>"; 
                   html += "                            <th><font size='3'>"+total_detalle.toFixed(decimales)+"</font></th>";
                   html += "                            <th></th> ";                                       
                   html += "                    </tr>   ";                 
                   html += "                </table>";
                   
                   $("#tablaproductos").html(html);                 
                   tabladetalle(total_detalle,0,total_detalle);
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
        }
        
    });
}

//muestra la tabla detalle de venta auxiliar
function tabladetalle(subtotal,descuento,totalfinal)
{
    var decimales = document.getElementById('decimales').value;
    
    $("#venta_subtotal").val(subtotal);
    $("#venta_descuento").val(descuento);
    $("#venta_totalfinal").val(totalfinal - descuento);
    
    html = "";
    html += "<div class='box'>";
    html += "        <div class='box-body table-responsive table-condensed'>";
    html += "            <table class='table table-striped table-condensed' id='miotratabla'>";
    html += "<tr>";
    html += "    <th> Descripción</th>";
    html += "    <th> Total </th> "; 
    html += "</tr>";
    html += "<tr>";
    html += "    <td>Sub Total Bs</td>";
    html += "    <td align='right'>"+subtotal.toFixed(decimales)+"</td>";
    html += "</tr> ";
    html += "<tr>";
    html += "    <td>Descuento</td>";
    html += "    <td align='right'>"+descuento.toFixed(decimales)+"</td>  ";  
    html += "</tr>";
    html += "<tr>";
    html += "    <th><b>TOTAL FINAL</b></th>";
    html += "    <th align='right'><font size='5'> "+totalfinal.toFixed(decimales)+"</font></th>";
    html += "</tr>";
    html += "           </table>";
    html += "   </div>";
    html += "   </div>";


    $("#detallecuenta").html(html); 
}

//esta funcion busca un producto en el inventario mediante su codigo de barras
// y la ingresa a la tabla detalle de venta
function buscarporcodigo()
{
   var decimales = document.getElementById('decimales').value;    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/buscarcodigo';
   var codigo = document.getElementById('codigo').value;
   //alert(codigo);
    $.ajax({url: controlador,
           type:"POST",
           data:{codigo:codigo},
           success:function(respuesta){     
               tablaproductos();
               $("#codigo").select();
           },
           error:function(respuesta){
               alert('ERROR: no existe el producto con el codigo seleccionado o no tiene existencia en inventario...!!');
               tablaproductos();
               $("#codigo").select();
           }
      
           });
    
}

//se encarga de ingresar una cantidad determinada de productos al detalle de la venta en base de id de producto
// la cantidad debe estar registrada en el modal asignada para esta operacion
function ingresarcoti(producto_id)
{
   var decimales = document.getElementById('decimales').value;
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'cotizacion/insertarproducto';

   var cantidad = document.getElementById('cantidad').value;
   var precio = document.getElementById('producto_precio').value;
   var descripcion = document.getElementById('descripcion').value;
   var descuento = document.getElementById('descuento').value;
   var cotizacion_id = document.getElementById('cotizacion_id').value;
    alert (cotizacion_id);

    $.ajax({url: controlador,
           type:"POST",
           data:{cantidad:cantidad, producto_id:producto_id, producto_precio:producto_precio, descripcion:descripcion, descuento:descuento, cotizacion_id:cotizacion_id},
           success:function(respuesta){
               tablaproductos();
               
           },
           error:function(respuesta){
               alert('ERROR: no existe el producto con el codigo seleccionado o no tiene existencia en inventario...!!');
               tablaproductos();
               $("#codigo").select();
           }
       
    });    
}

//esta funcion elimina un item de la tabla detalle de venta
function quitarproducto(producto_id)
{
    //alert(producto_id);
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminaritem/"+producto_id;
   // alert(controlador);
    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tablaproductos();
            }
        
    });
}
//esta funcion elimina un item de la tabla detalle de venta
function quitartodo()
{
    //alert(producto_id);
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminartodo/";
   // alert(controlador);
    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tablaproductos();
            }
        
    });
}

//esta funcion incrementar una cantidad determinada de productos
function incrementar(cantidad,detalleven_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/incrementar/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleven_id:detalleven_id},
            success:function(respuesta){
                tablaproductos();
                tabladetalle();                
            }
        
    });
}

//esta funcion incrementar una cantidad determinada de productos
function reducir(cantidad,detalleven_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/reducir/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleven_id:detalleven_id},
            success:function(respuesta){
                tablaproductos();
                tabladetalle();                
            }
        
    });
}

////funcion para actualizar el precio y cantidad de 
////la tabla de venta
function actualizarprecios(e,detalleven_id)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
    
        var base_url =  document.getElementById('base_url').value;
        var precio = document.getElementById('precio'+detalleven_id).value;
        var cantidad = document.getElementById('cantidad'+detalleven_id).value; 
        var controlador =  base_url+"venta/actualizarprecio";
       // alert("cantidad:"+cantidad+" precio:"+precio);
        $.ajax({url: controlador,
                type:"POST",
                data:{precio:precio, cantidad:cantidad,detalleven_id:detalleven_id},
                success:function(respuesta){
                    tablaproductos();
                    tabladetalle();

                }        
        });
    }
}

//Tabla resultados de la busqueda entrada
function tablaresultados1(opcion)
{   
    var decimales = document.getElementById('decimales').value;
    var controlador = "";
    var parametro = "";

    var cambio_producto_id = document.getElementById('cambio_producto_id').value;
    var limite = 10;
    var base_url = document.getElementById('base_url').value;
    
    if (opcion == 1){
        controlador = base_url+'cambio_producto/entradas/';
        parametro = document.getElementById('entrada').value        
    }
    
    if (opcion == 2){
        controlador = base_url+'venta/buscarcategorias/';
        parametro = document.getElementById('categoria_prod').value;
    }
    

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
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<form action='"+base_url+"cambio_producto/devolverproducto/'  method='POST' class='form'>";
                        html += "<div clas='row'>";                                            
                        html += "<div class='container' hidden>";
                        html += "<input id='cambio_producto_id'  name='cambio_producto_id' type='text' class='form-control' value='"+cambio_producto_id+"'>";
                        html += "<input id='producto_id'  name='producto_id' type='text' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                       // html += "<input id='descripcion'  name='descripcion' type='text' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";
                        html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+Number(registros[i]["producto_costo"]).toFixed(decimales)+"'>";
                        html += "</div>";
                            
                        html += "<div class='col-md-12'>";

                        html += "<b>"+registros[i]["producto_nombre"]+"</b><br>";
                        html += "<div class='col-md-2'  >";
                        html += "Precio_V: <input class='input-sm' id='producto_precio'  style='background-color: lightgrey' name='producto_precio' type='number' class='form-control' value='"+Number(registros[i]["producto_precio"]).toFixed(decimales)+"' ></div>";
                        html += "<div class='col-md-2'  >";
                        html += "Costo: <input class='input-sm' id='producto_costo'  style='background-color: lightgrey' name='producto_costo' type='number' class='form-control' value='"+Number(registros[i]["producto_costo"]).toFixed(decimales)+"' > </div>";
                        html += "<div class='col-md-2'  >";
                        html += "Desc.: <input class='input-sm' id='descuento'  style='background-color: lightgrey' name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";
                        html += "<div class='col-md-2'  >";
                        html += "Cant.: <input class='input-sm ' id='cantidad' name='cantidad' type='number' class='form-control' placeholder='cantidad' required value='1'> </div>";
                        html += "<div class='col-md-2'  >";
                        html += "Anadir";

                        html += "<button type='submit' class='btn btn-success'><i class='fa fa-cart-arrow-down'></i></button>";
                        //html += "<a href=''  onclick='submit()' class='btn btn-danger'><span class='fa fa-cart-arrow-down'></span></a>";
                        
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</form>";
                        html += "</td>";
                      //  "echo form_close()";
                       
                        html += "</tr>";

                   }
                 
                   
                   $("#tablaresultados1").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

} 
//Tabla resultados de la busqueda salida
function tablaresultados2(opcion)
{   
    var decimales = document.getElementById('decimales').value;
    var controlador = "";
    var parametro = "";
    var cambio_producto_id = document.getElementById('cambio_producto_id').value;
    var limite = 10;
    var base_url = document.getElementById('base_url').value;
    
    if (opcion == 1){
        controlador = base_url+'cambio_producto/salidas/';
        parametro = document.getElementById('salida').value        
    }
    
    if (opcion == 2){
        controlador = base_url+'venta/buscarcategorias/';
        parametro = document.getElementById('categoria_prod').value;
    }
    

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
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<form action='"+base_url+"cambio_producto/entregarproducto/'  method='POST' class='form'>";
                        html += "<div clas='row'>";                                            
                        html += "<div class='container' hidden>";
                        html += "<input id='cambio_producto_id'  name='cambio_producto_id' type='text' class='form-control' value='"+cambio_producto_id+"'>";
                        html += "<input id='producto_id'  name='producto_id' type='text' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        //html += "<input id='descripcion'  name='descripcion' type='text' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";
                        html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+Number(registros[i]["producto_costo"]).toFixed(decimales)+"'>";
                        html += "</div>";
                            
                        html += "<div class='col-md-12'>";

                        html += "<b>"+registros[i]["producto_nombre"]+"</b><br>";
                        html += "<div class='col-md-2'  >";
                        html += "Precio_V: <input class='input-sm' id='producto_precio'  style='background-color: lightgrey' name='producto_precio' type='number' class='form-control' value='"+Number(registros[i]["producto_precio"]).toFixed(decimales)+"' ></div>";
                        html += "<div class='col-md-2'  >";
                        html += "Costo: <input class='input-sm' id='producto_costo'  style='background-color: lightgrey' name='producto_costo' type='number' class='form-control' value='"+Number(registros[i]["producto_costo"]).toFixed(decimales)+"' > </div>";
                        html += "<div class='col-md-2'  >";
                        html += "Desc.: <input class='input-sm' id='descuento'  style='background-color: lightgrey' name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";
                        html += "<div class='col-md-2'  >";
                        html += "Cant.: <input class='input-sm ' id='cantidad' name='cantidad' type='number' class='form-control' placeholder='cantidad' required value='1'> </div>";
                        html += "<div class='col-md-2'  >";
                        html += "Anadir";

                        html += "<button type='submit' class='btn btn-success'><i class='fa fa-cart-arrow-down'></i></button>";
                        //html += "<a href=''  onclick='submit()' class='btn btn-danger'><span class='fa fa-cart-arrow-down'></span></a>";
                        
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</form>";
                        html += "</td>";
                      //  "echo form_close()";
                       
                        html += "</tr>";

                   }
                 
                   
                   $("#tablaresultados2").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

} 