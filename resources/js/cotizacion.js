$(document).on("ready",inicio);

function inicio(){

        
        detallecoti();
       

}

function detallecoti(){
     var controlador = "";
     var limite = 500;
     var base_url = document.getElementById('base_url').value;
     var cotizacion_id = document.getElementById('cotizacion_id').value;
     controlador = base_url+'cotizacion/detallecotizacion/';
     
      $.ajax({url: controlador,
           type:"POST",
           data:{cotizacion_id:cotizacion_id},
           success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    var total_detalle = Number(0);
                    var suma = Number(0);
                    var subtotal = Number(0);
                    var descuento = Number(0);
                    html = "";
                     if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["detallecot_total"]);
                        descuento += Number(registros[i]["detallecot_descuento"]);
                        subtotal += Number(registros[i]["detallecot_subtotal"]);
                        total_detalle = Number(subtotal-descuento);

                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["producto_nombre"]+"</b><br>";
                        html += "Marca: <b>"+registros[i]["producto_marca"]+"</b><br>";
                        html += "Industria: <b>"+registros[i]["producto_industria"]+"</b><br>"; 
                        //html += "<form action='"+base_url+"cotizacion/updateDetallecot/"+cotizacion_id+"/"+registros[i]["producto_id"]+"'  method='POST' class='form'>";
                        html += "<input id='detallecot_caracteristica"+registros[i]["producto_id"]+"'  name='detallecot_caracteristica' type='text' class='form-control' value='"+registros[i]["detallecot_caracteristica"]+"' placeholder='caracteristica'> </td>";
                        html += "<td> <input id='cotizacion_id'  name='cotizacion_id' type='hidden' class='form-control' value='"+cotizacion_id+"'>";
                        html += "<input id='detallecot_descripcion'  name='descripcion' type='hidden' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";
                        html += " <input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "<input id='detallecot_precio"+registros[i]["producto_id"]+"' name='producto_precio' type='text' size='3' class='form-control'  value='"+registros[i]["detallecot_precio"]+"' ></td> ";
                        html += "<td><input id='detallecot_cantidad"+registros[i]["producto_id"]+"'  name='cantidad' size='3' type='text' class='form-control' value='"+registros[i]["detallecot_cantidad"]+"' >";
                        html += "<input id='detallecot_id'  name='detallecot_id' type='hidden' class='form-control' value='"+registros[i]["detallecot_id"]+"'></td>";
                        html += "<td><input id='detallecot_descuento"+registros[i]["producto_id"]+"' name='descuento' size='3' type='text' class='form-control' value='"+registros[i]["detallecot_descuento"]+"' ></td>";
                        html += "<td><center><span class='badge badge-success'><font size='4'> <b>"+registros[i]["detallecot_total"]+"</b></font> <br></span>";
                        html += "</center></td>";
                        html += "<td><button type='button' onclick='actualizarDetalle("+registros[i]["detallecot_id"]+","+registros[i]["producto_id"]+","+cotizacion_id+")' class='btn btn-success btn-sm'><i class='fa fa-random'></i></button>";
                        html += "<button type='button' onclick='quitardetallec("+registros[i]["detallecot_id"]+")' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button></td>";

                      
                        //html += "";
                       }
                       html += "<tr>";
                      // html += "<td><input id='total'  name='total' type='text' class='form-control' value='"+total_detalle+"'></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td><font size='3'>TOTAL</td>";
                       html += "<td><font size='3'><b>"+descuento+"</td>";
                       html += "<td><font size='3'><b>"+total_detalle+"</td>";
                       html += "</tr>";
                        //$('#cotizacion_total').value(total_detalle.toFixed(2));
                       $("#detallecotiza").html(html);
                       totality(total_detalle);
                       
          }  
        },
        error:function(respuesta){
          
       
   }
    });

}
function totality(total_detalle){
  var totalfinal = Number(total_detalle);
  $("#cotizacion_total").val(totalfinal.toFixed(2));
}

function detallecota(cotizacion_id,producto_id){
       
        var controlador = "";
   
        var cantidad = document.getElementById('cantidad'+producto_id).value; 
        var descuento = document.getElementById('descuento'+producto_id).value;
        var producto_costo = document.getElementById('producto_costo'+producto_id).value;
        var producto_precio = document.getElementById('producto_precio'+producto_id).value;
        var descripcion = document.getElementById('descripcion'+producto_id).value;
        var producto_factor = document.getElementById('select_factor'+producto_id).value;

    var base_url = document.getElementById('base_url').value;
    
    controlador = base_url+'cotizacion/insertarproducto/';
   
    
    $.ajax({url: controlador,
           type:"POST",
           data:{cotizacion_id:cotizacion_id, producto_id:producto_id, cantidad:cantidad, descuento:descuento, descripcion:descripcion, producto_precio:producto_precio, producto_factor:producto_factor},
           success:function(respuesta){     
               alert (producto_factor);
               detallecoti();                      
            
        }
        
    });
}





function actualizarDetalle(detallecot_id,producto_id,cotizacion_id){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'cotizacion/updateDetallecot/';
    var caracteristica = document.getElementById('detallecot_caracteristica'+producto_id).value;
    var precio = document.getElementById('detallecot_precio'+producto_id).value;
    var cantidad = document.getElementById('detallecot_cantidad'+producto_id).value;
    var descuento = document.getElementById('detallecot_descuento'+producto_id).value;

   
 $.ajax({url: controlador,
            type:"POST",
            data:{detallecot_id:detallecot_id,caracteristica:caracteristica,precio:precio,cantidad:cantidad,descuento:descuento,producto_id:producto_id,cotizacion_id:cotizacion_id},
            success:function(respuesta){
                detallecoti();
            }        
    });

} 



function quitardetallec(detallecot_id){


    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'cotizacion/quitar/'+detallecot_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                detallecoti();
            }        
    });

}   

//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer

function cotivalidar(e,opcion) {

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

    var cotizacion_id = document.getElementById('cotizacion_id').value;

    var limite = 10;

    var base_url = document.getElementById('base_url').value;

    

    if (opcion == 1){

        controlador = base_url+'venta/buscarcotizar/';

        parametro = document.getElementById('cotizar').value        

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

                      var descripcion =  registros[i]["producto_nombre"]+registros[i]["producto_marca"]+registros[i]["producto_industrias"];

                        html += "<tr>";

                       // "echo form_open('cotizacion/insertarproducto/')"; 

                      

                        html += "<td>"+(i+1)+"</td>";

                        html += "<td>";

                        //html += "<form action='"+base_url+"cotizacion/insertarproducto/'  method='POST' class='form'>";

                        html += "<div clas='row'>";                                            

                        html += "<div class='container' hidden>";

                        html += "<input id='cotizacion_id'  name='cotizacion_id' type='text' class='form-control' value='"+cotizacion_id+"'>";

                        html += "<input id='producto_id'  name='producto_id' type='text' class='form-control' value='"+registros[i]["producto_id"]+"'>";

                        html += "<input id='descripcion"+registros[i]["producto_id"]+"'  name='descripcion' type='text' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";

                        html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+registros[i]["producto_costo"]+"'>";

                        html += "</div>";

                            

                        html += "<div class='col-md-12'>";



                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
                        html += "   <select class='btn btn-facebook btn-xs' style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo(this,"+registros[i]["producto_id"]+")'>";
                        html += "       <option value='1' id='"+registros[i]["producto_precio"]+"' >";
                        precio_unidad = registros[i]["producto_precio"];
                        html += "           "+registros[i]["producto_unidad"]+" Bs : "+precio_unidad.fixed(2)+"";
                        html += "       </option>";
                        
                        if(registros[i]["producto_factor"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                            html += "       <option value='"+registros[i]["producto_factor"]+"' id='"+registros[i]["producto_preciofactor"]+"' >";
                            html += "           "+registros[i]["producto_unidadfactor"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                            html += "       </option>";
                        }
                            if(registros[i]["producto_factor1"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor1"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor1"]) * parseFloat(registros[i]["producto_factor1"]);

                            html += "       <option value='"+registros[i]["producto_factor1"]+"' id='"+registros[i]["producto_preciofactor1"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor1"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                            html += "       </option>";
                        }

                            if(registros[i]["producto_factor2"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor2"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor2"]) * parseFloat(registros[i]["producto_factor2"]);

                            html += "       <option value='"+registros[i]["producto_factor2"]+"' id='"+registros[i]["producto_preciofactor2"]+"' >";
                            html += "           "+registros[i]["producto_unidadfactor2"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                            html += "       </option>";
                        }

                        if(registros[i]["producto_factor3"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor3"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor3"]) * parseFloat(registros[i]["producto_factor3"]);

                            html += "       <option value='"+registros[i]["producto_factor3"]+"' id='"+registros[i]["producto_preciofactor3"]+"' >";
                            html += "           "+registros[i]["producto_unidadfactor3"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                            html += "       </option>";
                        }

                        if(registros[i]["producto_factor4"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor4"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor4"]) * parseFloat(registros[i]["producto_factor4"]);

                            html += "       <option value='"+registros[i]["producto_factor4"]+"' id='"+registros[i]["producto_preciofactor4"]+"' >";
                            html += "           "+registros[i]["producto_unidadfactor4"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                            html += "       </option>";
                        }
                        
                        
                        
                        html += "   </select><br>";

                        html += "<div class='col-md-2'  >";

                        html += "Precio_V: <input class='input-sm' id='producto_precio"+registros[i]["producto_id"]+"'  style='background-color: lightgrey' name='producto_precio' type='number' class='form-control' value='"+registros[i]["producto_precio"]+"' ></div>";

                        html += "<div class='col-md-2'  >";

                        html += "Costo: <input class='input-sm' id='producto_costo"+registros[i]["producto_id"]+"'  style='background-color: lightgrey' name='producto_costo' type='number' class='form-control' value='"+registros[i]["producto_costo"]+"' > </div>";

                        html += "<div class='col-md-2'  >";

                        html += "Desc.: <input class='input-sm' id='descuento"+registros[i]["producto_id"]+"'  style='background-color: lightgrey' name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";

                        html += "<div class='col-md-2'  >";

                        html += "Cant.: <input class='input-sm ' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad' type='number' class='form-control' placeholder='cantidad' required value='1'> </div>";

                        html += "<div class='col-md-2'  >";

                        html += "Anadir";



                        html += "<button type='button' onclick='detallecota("+cotizacion_id+","+registros[i]["producto_id"]+")'  class='btn btn-success'><i class='fa fa-cart-arrow-down'></i></button>";

                        //html += "<a href=''  onclick='submit()' class='btn btn-danger'><span class='fa fa-cart-arrow-down'></span></a>";

                        

                        html += "</div>";

                        html += "</div>";

                        html += "</div>";

                        html += "</form>";

                        html += "</td>";

                      //  "echo form_close()";

                       

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

function mostrar_saldo(s,producto_id)
{

   //console.log(s[s.selectedIndex].value); // get value
  //alert(s[s.selectedIndex].id);// get id
  $("#producto_precio"+producto_id).val(s[s.selectedIndex].id);
}
