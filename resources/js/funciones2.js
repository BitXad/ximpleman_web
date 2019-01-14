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
function validar(e,opcion) {
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
        if (opcion==4){   //si la tecla proviene del input codigo de barras
            tablaresultados(1);           
        } 
        
    } 

    
}

//Selecciona los datos del nit
function seleccionar(opcion) {
    
        if (opcion==1){             
            document.getElementById('nit').select();
        }
        
        if (opcion==2){
            document.getElementById('razon_social').select();
        }
        
        if (opcion==3){
            document.getElementById('telefono').select();
        }

    
}
// esta funcion busca la cliente mediante su nit e inserta los datos 
// en cada input corresponiente si es que existe
// sino existe.. deja abierta la posibilidad de ingresar datos de nuevos de clientes
function buscarcliente(){

   var base_url = document.getElementById('base_url').value;
   var nit = document.getElementById('nit').value;
   var controlador = base_url+'venta/buscarcliente';
 
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            success:function(respuesta){
                
                var registros = eval(respuesta);
                
                if (registros[0]!=null){
                    
                    $("#razon_social").val(registros[0]["cliente_razon"]);
                    document.getElementById('telefono').focus();
                    $("#cliente_id").val(registros[0]["cliente_id"]);
                    
                }
                else
                {
                    //$("#razon_social").val('SIN NOMBRECILLO');
                    document.getElementById('razon_social').focus();
                    $("#razon_social").val("");
                    $("#cliente_id").val(0);
    
                }

            },
            error:function(respuesta){			
                $("#razon_social").val('SIN NOMBRE');
                document.getElementById('telefono').focus();
                
                $("#cliente_id").val(0);
            }                
    }); 

}

//muestra la tabla de productos disponibles para la venta
function tablaproductos()
{   
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
                        html += "			<td align='right'><input size='5' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(2)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'></td>";
                        html += "                       <td align='right'><font size='3' ><b>"+parseFloat(registros[i]["detalleven_total"]).toFixed(2)+"</b></font></td>";
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
                   html += "                            <th><font size='3'>"+cant_total.toFixed(2)+"</font></th>";
                   html += "                            <th></th>"; 
                   html += "                            <th><font size='3'>"+total_detalle.toFixed(2)+"</font></th>";
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
    html += "    <td align='right'>"+subtotal.toFixed(2)+"</td>";
    html += "</tr> ";
    html += "<tr>";
    html += "    <td>Descuento</td>";
    html += "    <td align='right'>"+descuento.toFixed(2)+"</td>  ";  
    html += "</tr>";
    html += "<tr>";
    html += "    <th><b>TOTAL FINAL</b></th>";
    html += "    <th align='right'><font size='5'> "+totalfinal.toFixed(2)+"</font></th>";
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
function ingresardetalle(producto_id)
{

   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/insertarProducto';
   var cantidad = document.getElementById('cantidad'+producto_id).value;
   
  //alert(producto_id);
    $.ajax({url: controlador,
           type:"POST",
           data:{cantidad:cantidad, producto_id:producto_id},
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

//Tabla resultados de la busqueda
function tablaresultados(opcion)
{   
    var controlador = "";
    var parametro = "";

    var limite = 10;
    var base_url = document.getElementById('base_url').value;
    
    if (opcion == 1){
        controlador = base_url+'venta/buscarproductos/';
        parametro = document.getElementById('filtrar').value        
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
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_codigo"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_codigobarra"]+"";
                        html += "</td>";
                        html += "<td>";
                        html += "<select>";
                        html += "<option >";
                        html += "Unidad:  "+registros[i]["producto_precio"]+"";
                        html += "</option>";
                        html += "<option>";
                        html += "Display:  "+registros[i]["producto_precio"]+"";
                        html += "</option>";
                        html += "<option>";
                        html += "Caja:  "+registros[i]["producto_precio"]+"";
                        html += "</option>";
                        html += "</select>";
                        html += "</td>";
                        html += "<td> ";
                        html += "<center>";
                        html += "<font size='3'><b>"+registros[i]["existencia"]+"</b></font>";
                        html += "</center>";
                        html += "</td>";
                        html += "<td>";


                        html += "<button type='button' class='btn btn-warning btn-xl' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='vender'><em class='fa fa-cart-arrow-down'></em></button>";

                        html += "<!---------------------- modal cantidad producto ------------------->";
                        
                        html += "<div class='modal fade' id='myModal"+registros[i]["producto_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModal"+registros[i]["producto_id"]+"'>";
                        html += "  <div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "  <div class='modal-header'>";
                        html += "  <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";

                        html += "  </div>";
                        
                        html += "  <div class='modal-body'>";
                        html += "  <!----------------------------------------------------------------->";
                        html += "   <div class='col-md-3'>";
                        html += "      <img  src='"+base_url+"/"+registros[i]["producto_foto"]+">";  
                        html += "   </div>";
                        html += "       <div class='col-md-5'>";
                        html += "       <font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "       <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "       <br><b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0'></b>";
                        html += "       </div>";
                        html += "       <!------------------------------------------------------------------->";
                        html += "  </div>";
                        
                        html += "  <div class='modal-footer aligncenter'>";
                        html += "    <input type='text' id='producto_id' name='producto_id' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>";

                        html += "     <!-- button class='btn btn-success btn-foursquarexs' type='submit'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></button-->";
                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' onclick='ingresardetalle("+registros[i]["producto_id"]+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";
                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' class='btn btn-danger btn-foursquarexs'><font size='5'><span class='fa fa-search'></span></font><br><small>Cancelar</small></a>";
                        html += "  </div>";                        
                        html += "</div>";
                        
                        html += "  </div>";
                        html += "</div>";

                        html += "<!---------------------- fin modal cantidad ---------------------------------> ";

                        html += "</td>";
                        
                        html += "</tr>";

                   }
                 
                   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

} 