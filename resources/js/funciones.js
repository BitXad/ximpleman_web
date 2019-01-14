$(document).on("ready",inicio);
function inicio(){
        tablaresultados(1);
        tablaproductos(); 
        tabla_pedidos(); 
        document.getElementById('nit').focus();
        document.getElementById('nit').select();
}

function calculardesc(){

   var venta_subtotal = document.getElementById('venta_subtotal').value;
   var venta_descuento = document.getElementById('venta_descuento').value;      
   var subtotal = Number(venta_subtotal) - Number(venta_descuento);

   $("#venta_totalfinal").val(subtotal);
   $("#venta_efectivo").val(subtotal);
   
}

function calcularcambio(){
   
   var venta_efectivo = document.getElementById('venta_efectivo').value;
   var venta_totalfinal = document.getElementById('venta_totalfinal').value;
   
   var venta_cambio = Number(venta_efectivo) - Number(venta_totalfinal);
   //alert(venta_cambio);
   $("#venta_cambio").val(venta_cambio);
    
}

//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function validar(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
    
        if (opcion==0){   //si la pulsacion proviene del telefono
              document.getElementById('tipocliente_id').focus();
        }
        
        if (opcion==1){   //si la pulsacion proviene del nit          
            buscarcliente();            
        }

        if (opcion==2){
            var codigo = document.getElementById('razon_social').value;
            
            codigo = codigo[0]+codigo[1] + Math.floor((Math.random()*100000)+50);
                    
            $("#cliente_nombre").val(document.getElementById('razon_social').value);
            $("#telefono").val(''); //si la tecla proviene del input razon social
            
            $("#cliente_codigo").val(codigo);
           document.getElementById('telefono').focus();
        } 
        
        if (opcion==3){   //si la tecla proviene del input codigo de barras
            buscarporcodigo();           
        } 
        
        if (opcion==4){   //si la tecla proviene del input codigo de barras
            tablaresultados(1);           
        }        
        
        if (opcion==5){   //si la tecla proviene del buscador de pedido abierto
            tablaresultadospedido(1);           
        }        
        
        if (opcion==6){   //si la tecla proviene del buscador de pedido abierto
            tablaresultadospedido(1);              
        }        
        
        if (opcion==7){   //si la tecla proviene del buscador de pedido abierto
           document.getElementById('filtrar').focus();               
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
        
        if (opcion==4){
            document.getElementById('venta_descuento').select();
        }
        
        if (opcion==5){
            document.getElementById('venta_efectivo').select();
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
                
                
                if (registros[0]!=null){ //Si el cliente es nuevo o no existe
                    
                    $("#razon_social").val(registros[0]["cliente_razon"]);
                    document.getElementById('telefono').focus();
                    $("#cliente_id").val(registros[0]["cliente_id"]);
                    $("#cliente_nombre").val(registros[0]["cliente_nombre"]);
                    $("#cliente_ci").val(registros[0]["cliente_ci"]);
                    $("#cliente_nombrenegocio").val(registros[0]["cliente_nombrenegocio"]);
                    $("#cliente_codigo").val(registros[0]["cliente_nit"]);
                    
                }
                else 
                {
                    //$("#razon_social").val('SIN NOMBRECILLO');
                    document.getElementById('razon_social').focus();
                    $("#razon_social").val("");
                    $("#cliente_id").val(0);
                    $("#cliente_nombre").val("-");
                    $("#cliente_ci").val(nit);
                    $("#cliente_nombrenegocio").val("-");
                    $("#cliente_codigo").val("-");
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
                        html += "			<td align='center' width='120'> ";
                   

                        html += "			<button onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";
                        html += "                       <input size='1' name='cantidad' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+registros[i]["detalleven_cantidad"]+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+" class='btn btn-warning')'>";
                        html += "                       <button onclick='incrementar(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></a></button>";

                        html += "                       </td>";
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
                   html += "                            <th></th>";
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


function ingresorapido(producto_id,cantidad)
{
    $("#cantidad"+producto_id).val(cantidad); //establece la cantidad requerida en el modal
    ingresardetalle(producto_id); //llama a la funcion para consolidar la cantidad
    
}

//se encarga de ingresar una cantidad determinada de productos al detalle de la venta en base de id de producto
// la cantidad debe estar registrada en el modal asignada para esta operacion
function ingresardetalle(producto_id)
{

   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/insertarProducto';
   var cantidad = document.getElementById('cantidad'+producto_id).value;
   
 
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

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminaritem/"+producto_id;

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
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminartodo/";
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

function actualizar_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_inventario/";

    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El inventario se actualizo exitosamente...! ');
            redirect('inventario/index');
        }
    });         
}

function actualizar_cantidad_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_cantidad_inventario/";

    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El inventario se actualizo exitosamente...! ');
            redirect('inventario/index');
        }
    });        
}

//Tabla resultados de la busqueda
function tablaresultados(opcion)
{   
    var controlador = "";
    var parametro = "";

    var limite = 50;
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
                        
                        html += "   <select style='font-size:12px;'>";
                        html += "       <option "+registros[i]["producto_precio"]+">";
                        html += "           "+registros[i]["producto_unidad"]+": "+registros[i]["producto_precio"]+"";
                        html += "       </option>";
                        
                        html += "       <option>";
                        html += "           Display:  "+registros[i]["producto_precio"]+"";
                        html += "       </option>";
                        html += "       <option>";
                        html += "           Caja:  "+registros[i]["producto_precio"]+"";
                        html += "       </option>";
                        
                        html += "   </select>";
                        
                        if (parseFloat(registros[i]["existencia"])>0){
                             
                             html += "<br>";
                             html += "<div class='btn-group'>";
                             html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",1)'><b> 1 </b></button>";
                             html +=     "<button class='btn btn-info btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",2)'><b> 2 </b></button>";
                             html +=     "<button class='btn btn-primary btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",5)'><b> 5 </b></button>";
                             html +=     "<button class='btn btn-warning btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",10)'><b> 10 </b></button> ";
                             html += "</div>";   
                       }
                        
                        
                        html += "</td>";
                        html += "<td> ";
                        html += "<center>";
                        html += "<font size='3'><b>"+registros[i]["existencia"]+"</b></font>";
                        html += "</center>";
                        html += "</td>";
                        html += "<td>";

                        if (parseFloat(registros[i]["existencia"])>0){
                             html += "<button type='button' class='btn btn-warning btn-xl' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='vender' ><em class='fa fa-cart-arrow-down'></em></button>";
                             
//                             html += "<div class='btn-group'>";
//                             html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",1)'><b> 1 </b></button>";
//                             html +=     "<button class='btn btn-info btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",2)'><b> 2 </b></button>";
//                             html +=     "<button class='btn btn-primary btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",5)'><b> 5 </b></button>";
//                             html +=     "<button class='btn btn-warning btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",10)'><b> 10 </b></button> ";
//                             html += "</div>";   
                       }
                        
                        html += "<!---------------------- modal cantidad producto ------------------->";
                        
                        html += "<div class='modal fade' id='myModal"+registros[i]["producto_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModal"+registros[i]["producto_id"]+"'>";
                        html += "  <div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "  <div class='modal-header'>";
                        html += "       <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "  </div>";                        
                        html += "  <div class='modal-body'>";
                        
                        html += "  <!----------------------------------------------------------------->";
//                        html += "       <div class='col-md-3'>";
//                        html += "           <img  src='"+base_url+"/"+registros[i]["producto_foto"]+" width='50' heigth='50'>";  
//                        html += "       </div>";
//                        html += "       <div class='col-md-9'>";
                        html += "       <table>";
                        html += "           <tr>";
                        html += "               <td>";
                            
                        html += "               <font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "               <br><b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0'></b>";
                        
                        html += "               </td>";
                        html += "          </tr>";
                        html += "       </table>";
                        
//                        html += "       </div>";
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
           html = "";
           $("#tablaresultados").html(html);
        }        
    });   
} 


function datoscliente(cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/datoscliente";

    $.ajax({url: controlador,
        type:"POST",
        data:{cliente_id:cliente_id},
        success:function(result){          
            var datos = JSON.parse(result);            
            //console.log(datos);            
            $("#cliente_id").val(datos[0]["cliente_id"]);
            $("#nit").val(datos[0]["cliente_nit"]);
            $("#razon_social").val(datos[0]["cliente_razon"]);
            $("#telefono").val(datos[0]["cliente_telefono"]);
        }
        
    });
   
}   

function pasaraventas(pedido_id,usuariopedido_id,cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/pasaraventas/"+pedido_id+"/"+cliente_id;
   
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){  
            
            $("#pedido_id").val(pedido_id);
            $("#usuariopedido_id").val(usuariopedido_id);
            tablaproductos();
            datoscliente(cliente_id);           
        },
        error: function(respuesta){
            tablaproductos();
            datoscliente(cliente_id);
        }
    });
   
}

function eliminardetalleventa()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminardetalle/";
   
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){         
            tablaproductos();
        },
        error: function(respuesta){         
        }        
    });
}

function registrarcliente()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/registrarcliente';
    var nit = document.getElementById('nit').value;
    var razon = document.getElementById('razon_social').value;
    var telefono = document.getElementById('telefono').value;
    var cliente_nombre = document.getElementById('cliente_nombre').value; 
    var cliente_id = document.getElementById('cliente_id').value; 
   
    if (cliente_id > 0){ //si el cliente existe debe actualizar sus datos 
        var controlador = base_url+'venta/modificarcliente';
        $.ajax({url: controlador,
                    type:"POST",
                    data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre},
                    success:function(respuesta){  

//                        var registro = JSON.parse(respuesta);
//                        cliente_id = registro[0]["cliente_id"];
                        //alert('llega hasta aqui');
                        registrarventa(cliente_id);

                    },
                    error: function(respuesta){
                        cliente_id = 0;            
                    }
        });        
    }
    else{ //Si el cliente es nuevo debe primero registrar al cliente
    
    $.ajax({url: controlador,
            type:"POST",
            data:{nit:nit,razon:razon,telefono:telefono},
            success:function(respuesta){  
            
                var registro = JSON.parse(respuesta);
                
                cliente_id = registro[0]["cliente_id"];
                registrarventa(cliente_id);
                
            },
            error: function(respuesta){
                cliente_id = 0;            
            }
        });
    }

}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

function fecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);
 
       // return dd+'/'+mm+'/'+yyyy;
        return yyyy+'-'+mm+'-'+dd;
}

function fecha_actual(){
    var cuotas = document.getElementById('cuotas').value;
    var modalidad = document.getElementById('modalidad').value;
    var dia_pago = document.getElementById('dia_pago').value;
    var fecha_inicio = document.getElementById('fecha_inicio').value;
    var dias = 0;
    
    if (modalidad == "MENSUAL") dias = cuotas * 30;
    
    
    var hoy = new Date();
    hoy.setDate(hoy.getDate()+10);
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1;
    var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);
        
   return dd+'/'+mm+'/'+yyyy;
        //return yyyy+'-'+mm+'-'+dd;
}

function registrarventa(cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/registrarventa";    
    
    var forma_id = document.getElementById('forma_pago').value; 
    var tipotrans_id = document.getElementById('tipo_transaccion').value; 
    var usuario_id = document.getElementById('usuario_id').value; 
    var pedido_id = document.getElementById('pedido_id').value; 
    var nit = document.getElementById('nit').value;
    var razon = document.getElementById('razon_social').value;
    
    var moneda_id = 1; 
    var estado_id = 1; 
    var venta_fecha = fecha();//retorna la fecha actual  //"date(now())";
    var venta_hora = "time(now())";
    var venta_subtotal = document.getElementById('venta_subtotal').value;     
    var venta_descuento = document.getElementById('venta_descuento').value; 
    var venta_total = document.getElementById('venta_totalfinal').value; 
    var venta_efectivo = document.getElementById('venta_efectivo').value; 
    var venta_cambio = document.getElementById('venta_cambio').value; 
    var venta_glosa = "'"+document.getElementById('venta_glosa').value+"'"; 
    var venta_comision = document.getElementById('venta_comision').value; 
    var venta_tipocambio = document.getElementById('venta_tipocambio').value; 
    var detalleserv_id = document.getElementById('detalleserv_id').value;
    var tipo_transaccion = document.getElementById('tipo_transaccion').value;
    var cuotas = document.getElementById('cuotas').value;   
    var cuota_inicial = document.getElementById('cuota_inicial').value;
    var credito_interes = document.getElementById('credito_interes').value;
    var facturado = document.getElementById('facturado').value;
        
    var sql =  "insert into venta(forma_id,tipotrans_id,usuario_id,cliente_id,moneda_id,"+
                "estado_id,venta_fecha,venta_hora,venta_subtotal,venta_descuento,venta_total,"+
                "venta_efectivo,venta_cambio,venta_glosa,venta_comision,venta_tipocambio,detalleserv_id) value("+
                forma_id+","+tipotrans_id+","+usuario_id+","+cliente_id
                +","+moneda_id+","+estado_id+",'"+venta_fecha+"',"+venta_hora+","+venta_subtotal
                +","+venta_descuento+","+venta_total+","+venta_efectivo+","+venta_cambio+","+venta_glosa
                +","+venta_comision+","+venta_tipocambio+","+detalleserv_id+")";
        
    if (tipo_transaccion==2){
        var cuotas = document.getElementById('cuotas').value;
        var modalidad = document.getElementById('modalidad').value;
        var dia_pago = document.getElementById('dia_pago').value;
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        
        
        $.ajax({url: controlador,
            type:"POST",
            data:{sql:sql, tipo_transaccion:tipo_transaccion, cuotas:cuotas, cuota_inicial:cuota_inicial, 
                venta_total:venta_total, credito_interes:credito_interes, pedido_id:pedido_id,
                facturado:facturado,venta_fecha:venta_fecha, razon:razon, nit:nit,
                cuotas:cuotas, modalidad:modalidad, dia_pago:dia_pago, fecha_inicio: fecha_inicio },
            success:function(respuesta){ 
                eliminardetalleventa();

            },
            error: function(respuesta){
                alert("Revise los datos de la venta por favor...!");   
            }        
        });   
    
    }
    else
    {
        $.ajax({url: controlador,
            type:"POST",
            data:{sql:sql, tipo_transaccion:tipo_transaccion, cuotas:cuotas, cuota_inicial:cuota_inicial, 
                venta_total:venta_total, credito_interes:credito_interes, pedido_id:pedido_id,
                facturado:facturado,venta_fecha:venta_fecha, razon:razon, nit:nit},
            success:function(respuesta){ 
                eliminardetalleventa();

            },
            error: function(respuesta){
                alert("Revise los datos de la venta por favor...!");   
            }
        });          
    }
        
}

function finalizarventa()
{   var monto = document.getElementById('venta_totalfinal').value;

    if (monto>0)
    {
        registrarcliente();
    }
    else
    {
        alert('ADVERTENCIA: No tiene registrado ningun producto en el detalle...!!');
    }
}

function consolidar_pedido(pedido_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/pedido_a_ventas";

   // alert(pedido_id);
    $.ajax({url:controlador,
        type:"POST",
        data:{pedido_id:pedido_id},
        success: function(response){
            tabla_pedidos(null);
            //alert("llega hasta aqui...!");
            //console.log(response);
        }        
    });

}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function buscar_pedidos()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido";
    var opcion      = document.getElementById('select_pedidos').value;
 
    
    if (opcion == 1)
    {
        filtro = " and date(pedido_fecha) = date(now())";
        mostrar_ocultar_buscador("ocultar");
        
        
    }//pedidos de hoy
    
    if (opcion == 2)
    {
        filtro = " and date(pedido_fecha) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }//pedidos de ayer
    
    if (opcion == 3) 
    {
        filtro = " and date(pedido_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)";//pedidos de la semana
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 4) 
    {   filtro = " ";//todos los pedidos
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }


    tabla_pedidos(filtro);
}

function buscar_por_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var estado_id = document.getElementById('estado_id').value;
    
    filtro = " and date(pedido_fecha) >= '"+fecha_desde+"'  and  date(pedido_fecha) <='"+fecha_hasta+
            "' and p.estado_id = "+estado_id;
    tabla_pedidos(filtro);

}

function tabla_pedidos(filtro)
{   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/mostrar_pedidos";
    
    $.ajax({url:controlador,
        type:"POST",
        data:{filtro:filtro},
        success: function(response){
            //alert("llega hasta aqui...!");
            //console.log(response);
            
            var cont =  0;
            var cantidad_pedidos = 0;
            var total_pedido = 0;
            var p = JSON.parse(response);
            
            
                html = "";

            total_pedido = 0;   
            
            for(var i = 0; i<p.length; i++){
                
                
                cont += 1;//    html += "             $cont = $cont+1;  ";
                total_pedido += parseFloat(p[i]["pedido_total"]); // html += "             $total_pedido+=$p['pedido_total']; ";
                
                html += "<tr> ";
                html += "    <td>"+cont+"</td> ";

                html += "    <td><font size='3'><b>"+p[i]["cliente_nombre"]+"</b></font> <br> ";
                html += "    "+p[i]["cliente_nombrenegocio"]+"<br>  ";
                html += "    "+p[i]["pedido_fecha"]+"<br> ";
                html += "     ";
                html += "    </td> ";
                html += "    <td align='center' bgcolor='"+p[i]["estado_color"]+"'> ";
                html += "        <a href='"+base_url+'pedido/pedidoabierto/'+p[i]["pedido_id"]+"'> ";
                html += "        <font size='3' color='white'><b>"+'00'+p[i]["pedido_id"]+"</b></font> <br> ";
                html += "        <font size='1' color='white'>"+p[i]["estado_descripcion"]+"</font> ";
                html += "         ";
                html += "        </a> ";
                html += "    </td> ";


                html += "    <td align='right' bgcolor='"+p[i]["estado_color"]+"'> ";
                html += "        "+'Sub Total: '+parseFloat(p[i]["pedido_subtotal"]).toFixed(2)+"<br>  ";
                html += "        "+'Desc.: '+parseFloat(p[i]["pedido_descuento"]).toFixed(2)+"<br>   ";
                html += "        <font size='3'><b>"+parseFloat(p[i]["pedido_total"]).toFixed(2)+"</b></font> ";
                html += "    </td> ";

                html += "    <td bgcolor='"+p[i]["estado_color"]+"'> ";
                html += "        <center> ";        
                html += "        <font size='2'> ";        
                html += "        "+'<b>'+p[i]["pedido_fechaentrega"]+'</b><br>'+p[i]["pedido_horaentrega"]+" ";
                html += "        </font> ";
                html += "        </center>  ";
                html += "    </td> ";

                html += "    <td> ";

                    if (p[i]["estado_id"]<=12){
                        
                        html += "        <a href='"+base_url+'pedido/pedidoabierto/'+p[i]["pedido_id"]+"' class='btn btn-success btn-sm'><span class='fa fa-cubes'></span></a> ";
                        html += "       <button type='button' class='btn btn-facebook btn-sm' data-toggle='modal' data-target='#modalconsolidar"+p[i]["pedido_id"]+"'> ";
                        html += "           <span class='fa fa-money'></span>     Consolidar ";
                        html += "      </button>  ";
  
                
                      //  htmt += "<!----------------------------------------  Modal -------------------------------------------------> ";
                
                        html += "<div class='modal fade' id='modalconsolidar"+p[i]["pedido_id"]+"' tabindex='-1' role='dialog' aria-labelledby='modalconsolidar' aria-hidden='true'> ";
                        html += "  <div class='modal-dialog' role='document'> ";
                        html += "    <div class='modal-content'> ";

                        html += "      <div class='modal-header' style='background-color: #CDCDCD'> ";
                        html += "          <center> ";

                        html += "          <h3 class='modal-title' id='exampleModalLabel'><b><span class='fa fa-money'></span>  Consolidar Pedido a Ventas <span class='fa fa-save'></span></b></h3> ";
                        html += "        <button type='button' class='close' data-dismiss='modal' aria-label='Close'> ";
                        html += "          <span aria-hidden='true'>&times;</span> ";
                        html += "        </button>  ";

                        html += "          </center> ";
                        html += "      </div> ";

                        html += "      <div class='modal-body'> ";
                        html += "          <center> ";
                        html += "              <font size='5'><b>Se enviara¡ este pedido como operación de venta</b></font><br>   ";
                        html += "              <font size='5'>Â¿Desea continuar?</font><br>   ";

                        html += "          </center> ";
                        html += "      </div> ";
                        html += "      <div class='modal-footer'> ";
                        html += "        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button> ";
                        html += "        <button  class='btn btn-primary' data-dismiss='modal'  onclick='consolidar_pedido("+p[i]["pedido_id"]+")'><span class='fa fa-money'></span> Consolidar</button> ";
                        html += "      </div> ";
                        html += "    </div> ";
                        html += "  </div> ";
                        html += "</div> ";
    
                    //    htmt += "<!---------------------------------------- Fin Modal -------------------------------------------------> ";
                
                    }
                        
                html += "    </td> ";
                
                html += "</tr> ";

                }
                html += "<tr> ";
                html += "    <th> </th> ";
                html += "    <th> </th> ";

                html += "         ";
                html += "    <th> ";
                html += "        <center>  ";
                html += "        PEDIDOS<br> ";
                html += "        <font size='3'><b>"+cont+"</b></font> ";
                html += "        </center> ";
                html += "   </th> ";

                html += "   <th> ";
                html += "        <center> ";
                html += "            TOTAL Bs<br> ";
                html += "        <font size='3'><b>"+parseFloat(total_pedido).toFixed(2)+"</b></font> ";
                html += "        </center> ";
                html += "   </th> ";
                html += "     ";
                html += "    <th></th> ";
                html += "    <th> </th> ";
                html += "</tr>      ";
         
              //  console.log(html);
            $("#tabla_pedidos").html(html);
        }        
    });
 
}

function agregar_producto(producto_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador =  base_url+"pedido/ingresarproducto";
    var pedido_id   = document.getElementById('pedido_id').value;
    
    var cantidad    = document.getElementById('cantidad'+producto_id).value;
    var descuento   = document.getElementById('descuento'+producto_id).value;
    var preferencia = document.getElementById('preferencia'+producto_id).value;
    
$.ajax({url:controlador,
        type:"POST",
        data:{pedido_id:pedido_id, cantidad:cantidad, descuento:descuento, preferencia:preferencia, producto_id:producto_id},
        success: function(response){    
            
        }
    });
}


//Tabla resultados de la busqueda para pedidos
function tablaresultadospedido(opcion)
{   
    var controlador = "";
    var parametro = "";
    var limite = 50;
    var base_url = document.getElementById('base_url').value;
    
    if (opcion == 1){
        controlador = base_url+'venta/buscarproductos/';
        parametro = document.getElementById('filtrarproducto').value  
  
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
                        
                        html += "<tr id='producto"+registros[i]["producto_id"]+"'>";
                        html += "   <td >"+(i+1)+"</td>";
                        html += "   <td align='center'>";
                        html += "   <img src='"+base_url+'resources/images/productos/'+registros[i]["producto_foto"]+"' class='img-circle' width='50' height='50'>";
                        html += "    ";
                            html += "<br><select class='btn btn-facebook btn-xs'>";
                            html += "<option value='"+registros[i]["producto_precio"]+"' >"+registros[i]["producto_unidad"]+" Bs: "+registros[i]["producto_precio"]+"</option>";
                            html += "</select>";
                        html += "<br> <span class='btn btn-danger btn-xs'><font size='3' face='Arial'><b>Saldo: "+parseFloat(registros[i]['existencia']).toFixed(2)+"</b></font></span>";
                        html += "    </td>";                        
                        html += "   <td>  ";
                        html += "<font size='2' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font><br>";

                        html += registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += " | <b>"+registros[i]["producto_codigo"]+"</b> <br>";                        
                        html += " ";
                        html += "<span class='btn btn-facebook btn-xs'>Desc.:<input size='4' class='input-xs' id='descuento"+registros[i]["producto_id"]+"' style='background-color: lightgrey; color: black;' name='descuento' type='text' class='form-control' value='0.00' required='true'></span>"
                        html += "<span class='btn btn-facebook btn-xs'>Cant.:<input size='4' class='input-xs' id='cantidad"+registros[i]["producto_id"]+"' style='background-color: white; color: black;' name='cantidad' type='text' class='form-control' placeholder='cantidad' required='true' value='1'></span>"
                        html += "<br> <input class='input' size='35' id='preferencia"+registros[i]["producto_id"]+"' name='preferencia' type='text' placeholder='preferencia'><br>";
                        html += "<br> <button type='submit' class='btn btn-xs btn-success' onclick='agregar_producto("+registros[i]["producto_id"]+")'><i class='fa fa-cart-arrow-down'></i> Añadir</button>";
                        html += " </b> ";
                        html += "</td>";
                        html += "</tr>";
                   }
                                    
                   $("#tablaresultadospedido").html(html);

            }
                
        },
        error:function(respuesta){
           html = "";
           $("#tablaresultadospedido").html(html);
        }        
    });   
} 

function montrar_ocultar_fila(parametro)
{
           
    if (parametro == "mostrar"){
        document.getElementById('fila_producto').style.display = 'block';}
    else{
        document.getElementById('fila_producto').style.display = 'none';}
    
}

function tabla_detalle_pedido()
{
    
    
    
}
//
//function incrementar(detalleped_id)
//{   
//    var base_url    = document.getElementById('base_url').value;
//    var controlador =  base_url+"detalle_pedido/incrementar";
//    var pedido_id   = document.getElementById('pedido_id').value; 
//    var cantidad = 1;
//    
//    $.ajax({url:controlador,
//        type:"POST",
//        data:{detalleped_id:detalleped_id, cantidad:cantidad},
//        success: function(response){
//                
//                
//        }
//        });   
//   
//}...