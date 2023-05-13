$(document).on("ready",inicio);

function inicio(){
    
    detallecoti();
    filtro = " and date(cotizacion_fecha) = date(now())";
    fechacotizacion(filtro);

}

function detallecoti(){
     var controlador = "";
     var limite = 500;
     var base_url = document.getElementById('base_url').value;
     var cotizacion_id = document.getElementById('cotizacion_id').value;
     controlador = base_url+'cotizacion/detallecotizacion/';
     var decimales = document.getElementById('decimales').value;
     
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
                        html += "<textarea  id='detallecot_caracteristica"+registros[i]["detallecot_id"]+"'  name='detallecot_caracteristica' type='text' class='form-control'  placeholder='caracteristica'>"+registros[i]["detallecot_caracteristica"]+"</textarea> </td>";
                        html += "<td> <input id='cotizacion_id'  name='cotizacion_id' type='hidden' class='form-control' value='"+cotizacion_id+"'>";
                        html += "<input id='detallecot_descripcion'  name='descripcion' type='hidden' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";
                        html += " <input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "<input id='detallecot_precio"+registros[i]["detallecot_id"]+"' name='producto_precio' type='text' size='3' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detallecot_id"]+","+registros[i]["producto_id"]+","+cotizacion_id+")'  value='"+Number(registros[i]["detallecot_precio"]).toFixed(decimales)+"' ></td> ";
                        html += "<td><input id='detallecot_cantidad"+registros[i]["detallecot_id"]+"'  name='cantidad' size='3' type='text' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detallecot_id"]+","+registros[i]["producto_id"]+","+cotizacion_id+")' value='"+registros[i]["detallecot_cantidad"]+"' >";
                        html += "<input id='detallecot_id'  name='detallecot_id' type='hidden' class='form-control' value='"+registros[i]["detallecot_id"]+"'></td>";
                        html += "<td><input id='detallecot_descuento"+registros[i]["detallecot_id"]+"' name='descuento' size='3' type='text' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detallecot_id"]+","+registros[i]["producto_id"]+","+cotizacion_id+")' value='"+Number(registros[i]["detallecot_descuento"]).toFixed(decimales)+"' ></td>";
                        html += "<td><center><font size='3'> <b>"+Number(registros[i]["detallecot_total"]).toFixed(decimales)+"</b></font> <br>";
                        html += "</center></td>";
                        html += "<td><button type='button' onclick='actualizarDetalle("+registros[i]["detallecot_id"]+","+registros[i]["producto_id"]+","+cotizacion_id+")' title='Guardar' class='btn btn-success btn-sm'><i class='fa fa-floppy-o'></i></button>";
                        html += "<button type='button' onclick='quitardetallec("+registros[i]["detallecot_id"]+")' title='Quitar' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button></td>";

                      
                        //html += "";
                       }
                       html += "<tr>";
                      // html += "<td><input id='total'  name='total' type='text' class='form-control' value='"+total_detalle+"'></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td><font size='3'>TOTAL</td>";
                       html += "<td><font size='3'><b>"+Number(descuento).toFixed(decimales)+"</td>";
                       html += "<td><font size='3'><b>"+Number(total_detalle).toFixed(decimales)+"</td>";
                       html += "<td></td>";
                       html += "</tr>";
                        //$('#cotizacion_total').value(total_detalle.toFixed(decimales));
                       $("#detallecotiza").html(html);
                       totality(total_detalle);
                       
          }  
        },
        error:function(respuesta){
          
       
   }
    });

}

function actualizadetalle(e,detalle_id,producto_id,cotizacion_id) {

  tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){ 
             
            actualizarDetalle(detalle_id,producto_id,cotizacion_id);            

        }
}

function pasardetalle(e,cotizacion_id,producto_id) {

  tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){ 
             
            detallecota(cotizacion_id,producto_id);            

        }
}

function actualizacaracteristicas(e,detalle_id,producto_id,cotizacion_id) {

  tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){


    var base_url = document.getElementById('base_url').value;
    var nuevo = document.getElementById('detallecot_caracteristica'+producto_id).value;
    
    var controlador = base_url+'cotizacion/actualizarcaracteristicas/';
   
    
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id,nuevo:nuevo},
           success:function(respuesta){     
              // alert ('bien');
               actualizarDetalle(detalle_id,producto_id,cotizacion_id);                    
            
        }
        
    });
                 

        }
}

function totality(total_detalle){
    var decimales = document.getElementById(decimales).value; 
    var totalfinal = Number(total_detalle).toFixed(decimales);
    $("#cotizacion_total").val(totalfinal.toFixed(decimales));
}

function detallecota(cotizacion_id,producto_id){
       
        var controlador = "";
   
        var cantidad = document.getElementById('cantidad'+producto_id).value; 
        var descuento = document.getElementById('descuento'+producto_id).value;
        var producto_costo = document.getElementById('producto_costo'+producto_id).value;
        var producto_precio = document.getElementById('producto_precio'+producto_id).value;
        var descripcion = document.getElementById('descripcion'+producto_id).value;
        var producto_factor = document.getElementById('select_factor'+producto_id).value;
        var caracteristicas = document.getElementById('producto_caracteristicas'+producto_id).value;

    var base_url = document.getElementById('base_url').value;
    
    controlador = base_url+'cotizacion/insertarproducto/';
   
    
    $.ajax({url: controlador,
           type:"POST",
           data:{cotizacion_id:cotizacion_id, producto_id:producto_id, cantidad:cantidad, descuento:descuento, descripcion:descripcion, producto_precio:producto_precio, producto_factor:producto_factor,caracteristicas:caracteristicas},
           success:function(respuesta){     
               //alert (producto_factor);
               detallecoti();                      
            
        }
        
    });
}

function actualizarDetalle(detallecot_id,producto_id,cotizacion_id){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'cotizacion/updateDetallecot/';
    var caracteristica = document.getElementById('detallecot_caracteristica'+detallecot_id).value;
    var precio = document.getElementById('detallecot_precio'+detallecot_id).value;
    var cantidad = document.getElementById('detallecot_cantidad'+detallecot_id).value;
    var descuento = document.getElementById('detallecot_descuento'+detallecot_id).value;

   
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




//Tabla resultados de la busqueda

function tablaresultados(opcion)
{   

    var controlador = "";

    var parametro = "";

    var cotizacion_id = document.getElementById('cotizacion_id').value;
    
    var decimales = document.getElementById('decimales').value;

    var base_url = document.getElementById('base_url').value;

    //alert(decimales);

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

                   

                    

                    for (var i = 0; i < n ; i++){

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
                            html += "<input id='producto_caracteristicas"+registros[i]["producto_id"]+"'  name='caracteristicas' type='text' class='form-control' value='"+registros[i]["producto_caracteristicas"]+"'>";

                            html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+registros[i]["producto_costo"]+"'>";

                        html += "</div>";

                            

                        html += "<div class='col-md-12'>";



                        html += "<b>"+registros[i]["producto_nombre"]+"("+registros[i]["producto_codigo"]+")</b>  <span class='btn btn-warning btn-xs' style='font-size:10px; face=arial narrow;'>"+Number(registros[i]["existencia"]).toFixed(decimales)+"</span>";
                        html += "   <select class='btn btn-facebook btn-xs' style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo(this,"+registros[i]["producto_id"]+")'>";
                        html += "       <option value='1' id='"+registros[i]["producto_precio"]+"' >";
                        precio_unidad = registros[i]["producto_precio"];
                        html += "           "+registros[i]["producto_unidad"]+" Bs : "+Number(precio_unidad).toFixed(decimales)+"";
                        html += "       </option>";
                        
                        if(registros[i]["producto_factor"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                            html += "       <option value='"+registros[i]["producto_factor"]+"' id='"+registros[i]["producto_preciofactor"]+"' >";
                            html += "           "+registros[i]["producto_unidadfactor"]+" Bs: "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }
                            if(registros[i]["producto_factor1"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor1"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor1"]) * parseFloat(registros[i]["producto_factor1"]);

                            html += "       <option value='"+registros[i]["producto_factor1"]+"' id='"+registros[i]["producto_preciofactor1"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor1"]+" Bs: "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }

                            if(registros[i]["producto_factor2"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor2"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor2"]) * parseFloat(registros[i]["producto_factor2"]);

                            html += "       <option value='"+registros[i]["producto_factor2"]+"' id='"+registros[i]["producto_preciofactor2"]+"' >";
                            html += "           "+registros[i]["producto_unidadfactor2"]+" Bs: "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }

                        if(registros[i]["producto_factor3"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor3"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor3"]) * parseFloat(registros[i]["producto_factor3"]);

                            html += "       <option value='"+registros[i]["producto_factor3"]+"' id='"+registros[i]["producto_preciofactor3"]+"' >";
                            html += "           "+registros[i]["producto_unidadfactor3"]+" Bs: "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }

                        if(registros[i]["producto_factor4"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor4"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor4"]) * parseFloat(registros[i]["producto_factor4"]);

                            html += "       <option value='"+registros[i]["producto_factor4"]+"' id='"+registros[i]["producto_preciofactor4"]+"' >";
                            html += "           "+registros[i]["producto_unidadfactor4"]+" Bs: "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }
                        
                        
                        
                        html += "   </select><br>";

//                        
//                        html += "<div class='col-md-3'  style='padding-left: 0px;' >";
//
//                        html += "Precio <input class='input-sm' id='producto_precio"+registros[i]["producto_id"]+"' style='width:70px'  name='producto_precio' type='number' class='form-control' value='"+registros[i]["producto_precio"]+"' ></div>";
//
//                        html += "<div class='col-md-3'  style='padding-left: 0px;' >";
//
//                        html += "Costo <input class='input-sm' id='producto_costo"+registros[i]["producto_id"]+"'   style='width:70px' name='producto_costo' type='number' class='form-control' value='"+registros[i]["producto_costo"]+"' readonly> </div>";
//
//                        html += "<div class='col-md-3'  style='padding-left: 0px;' >";
//
//                        html += "Desc. <input class='input-sm' id='descuento"+registros[i]["producto_id"]+"'   style='width:70px' name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";
//
//                        html += "<div class='col-md-3'  style='padding-left: 0px;' >";
//
//                        html += "Cant. <input class='input-sm ' id='cantidad"+registros[i]["producto_id"]+"' style='width:70px' name='cantidad' onkeypress='pasardetalle(event,"+cotizacion_id+","+registros[i]["producto_id"]+")' type='number' class='form-control' placeholder='cantidad' required value='1'> </div></td>";                        
//                        
   

                            let estilo_celda = "style='border-width:0px; font-size: 8px;'";
                            let anchoinput = 50;
                            html += "<center>";
                            html += "<table table style='font-size: 10pt;' id='tablares' name='tablares'>";
                            html += "<tbody class='buscar33'>";

                                    html += "<tr style='font-size: 12px; border-width: 0px; display: table-row;'>";
                                        html += "<td "+estilo_celda+"><center><b>PRECIO</b></center></td>";
                                        html += "<td "+estilo_celda+"><center><b>COSTO</b></center></td>";
                                        html += "<td "+estilo_celda+"><center><b>DESC</b></center></td>";
                                        html += "<td "+estilo_celda+"><center><b>CANT</b></center></td>";                        
                                    html += "</tr>";

                                    html += "<tr>";
                                        html += "<td "+estilo_celda+"><input  style='width:"+anchoinput+"px;' id='producto_precio"+registros[i]["producto_id"]+"' style='width:70px; font-size: 10px;'  name='producto_precio' type='number' value='"+ Number(registros[i]["producto_precio"]).toFixed(decimales)+"' ></td>";
                                        html += "<td "+estilo_celda+"><input  style='width:"+anchoinput+"px;' id='producto_costo"+registros[i]["producto_id"]+"'  style='width:70px; font-size: 10px; background-color: red;'  name='producto_costo' type='number'value='"+Number(registros[i]["producto_costo"]).toFixed(decimales)+"' readonly></td>";
                                        html += "<td "+estilo_celda+"><input  style='width:"+anchoinput+"px;' id='descuento"+registros[i]["producto_id"]+"'   style='width:70px; font-size: 10px;'  name='descuento' type='number' value='0.00' step='.01' required ></td>";
                                        html += "<td "+estilo_celda+"><input  style='width:"+anchoinput+"px;' id='cantidad"+registros[i]["producto_id"]+"' style='width:70px; font-size: 10px; background-color: yellow;'  name='cantidad' onkeypress='pasardetalle(event,"+cotizacion_id+","+registros[i]["producto_id"]+")' type='number' placeholder='cantidad' required value='1'></td>";                        
                                    html += "</tr>";

                            html += "</tbody>";
                            html += "</table></center>";
//                        
                        html += "</td>";
                        
                        
                        html += "<td><center><small style='align-text:center'>Añadir</center></small>";


                        html += "<button type='button' onclick='detallecota("+cotizacion_id+","+registros[i]["producto_id"]+")'  class='btn btn-success'><i class='fa fa-cart-arrow-down'></i></button>";

                      

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

function busqueda_cotizacion()
{
    var base_url    = document.getElementById('base_url').value;
    var opcion      = document.getElementById('select_fecha').value;
 
    if (opcion == 1)
    {
        filtro = " and date(cotizacion_fecha) = date(now())";
        mostrar_ocultar_buscador("ocultar");
        $("#busquedaavanzada").html('Del Dia');
               
    }//compras de hoy
    
    if (opcion == 2)
    {
       
        filtro = " and date(cotizacion_fecha) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
        $("#busquedaavanzada").html('De Ayer');
    }//compras de ayer
    
    if (opcion == 3) 
    {
    
        filtro = " and date(cotizacion_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)";//compras de la semana
        mostrar_ocultar_buscador("ocultar");
        $("#busquedaavanzada").html('De la Semana');
            }

    
    if (opcion == 4) 
    {   filtro = " ";//todos los compras
        mostrar_ocultar_buscador("ocultar");

    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        //filtro = null;
    }

    fechacotizacion(filtro);
}


function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}


function fechacotizacion(parametro){
  var base_url    = document.getElementById('base_url').value;
  let decimales   = document.getElementById('decimales').value;
  var controlador = base_url+"cotizacion/buscar_cotizacion";
   

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
          
           success:function(resul){     
              
                            
                
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    
                    var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    $("#pillados").html("Registros Encontrados: "+n+" ");
                   
                    html = "";
                 
                    
                    for (var i = 0; i < n ; i++){
                        
                        
                        
                        
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        if (registros[i]["cotizacion_cliente"]=='') {
                        html += "<td>A QUIEN CORRESPONDA</td>";
                        }else{
                        html += "<td>"+registros[i]["cotizacion_cliente"]+"</td>";  
                        }
                        
                        html += "<td>"+moment(registros[i]["cotizacion_fecha"]).format('DD/MM/YYYY')+"</td>";
                        html += "<td>"+registros[i]["cotizacion_validez"]+"</td>";
                        html += "<td>"+registros[i]["cotizacion_formapago"]+"</td>";
                        html += "<td>"+registros[i]["cotizacion_tiempoentrega"]+"</td>";
                        html += "<td>"+moment(registros[i]["cotizacion_fechahora"]).format('DD/MM/YYYY HH:mm:ss')+"</td>";
                        html += "<td align='right'>"+Number(registros[i]["cotizacion_total"]).toFixed(decimales)+"</td>";
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td>";
                        
                        html += "<td class='no-print'><a href='"+base_url+"cotizacion/add/"+registros[i]["cotizacion_id"]+"'  class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a>";
                        
                        html += " <a href='"+base_url+"cotizacion/cotizarecibo/"+registros[i]["cotizacion_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></span></a>";
                        html += " <a href='"+base_url+"cotizacion/recibo/"+registros[i]["cotizacion_id"]+"' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></span></a>";
                        html += "  <a href='#' data-toggle='modal'  data-target='#modalanular"+registros[i]["cotizacion_id"]+"' class='btn btn-xs btn-danger' style=''><i class='fa fa-ban'></i></a>";
                        html += "                       <!------------------------ modal para eliminar el producto ------------------->";
                        html += " <div class='modal fade' id='modalanular"+registros[i]['cotizacion_id']+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+registros[i]['orden_id']+"'>";
                        html += "   <div class='modal-dialog' role='document'>";
                        html += "  <br><br>";
                        html += "   <div class='modal-content'>";
                        html += "   <div class='modal-header'>";
                        html += "   <h1 class='modal-title' id='myModalLabel'>ADVERTENCIA</h1>";
                        html += "  </div>";
                        html += "  <div class='modal-body'>";
                        html += "  <div class='panel panel-primary'>";
                        html += "   ";
                        html += "  <center>";
                        html += "   <!------------------------------------------------------------------->";
                        html += "   <h1 style='font-size: 80px'> <b> <em class='fa fa-trash'></em></b></h1> ";
                        html += "  <h4>";
                        html += "  ";
                        html += "  ¿Desea eliminar la Cotizacion? <b> <br>";
                        html += " No.: "+registros[i]['cotizacion_id']+"<br>";
    //                    
                        html += " </h4>";
                        html += "                                      <!------------------------------------------------------------------->";
                        html += " ";
                        html += "   </center>";
                        html += "   </div>";
                        html += "   </div>";
                        html += "    <div class='modal-footer aligncenter'>";
                        html += "   <center>";                                        
                        html += "  <a href='"+base_url+"cotizacion/remove/"+registros[i]['cotizacion_id']+"' class='btn btn-danger  btn-sm'><em class='fa fa-pencil'></em> Si </a>";

                        html += "  <a href='#' class='btn btn-success btn-sm' data-dismiss='modal'><em class='fa fa-times'></em> No </a>";
                        html += "  </center>";

                        html += "   </div>";
                        html += "   </div>";
                        html += "   </div>";
                        html += "   </div>";

                        html += " <!------------------------ fin modal --------------------------------->   ";  
                        html += "</td>";
                        html += "</tr>";
                       
                   }
                        
                   
                   $("#fechadecotizacion").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadecotizacion").html(html);
        }
        
    });   

} 

function buscar_por_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
  

   var fecha1 = "Desde: "+moment(fecha_desde).format('DD/MM/YYYY');
   var fecha2 = "Hasta: "+moment(fecha_hasta).format('DD/MM/YYYY');
   
   
         filtro = " and date(cotizacion_fecha) >= '"+fecha_desde+"'  and  date(cotizacion_fecha) <='"+fecha_hasta+"' ";
         $("#busquedaavanzada").html(fecha1+" "+fecha2);
    
    fechacotizacion(filtro);
}

function buscar_porcliente(e)
{
   tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){

    
  var cliente    = document.getElementById('cotizar_cli').value; 
  var parametro = " and cotizacion_cliente like '%"+cliente+"%' ";
  fechacotizacion(parametro);
    }

}


function pasar_a_ventas(){

    var base_url = document.getElementById('base_url').value;
    var cotizacion_id = document.getElementById('cotizacion_id').value;
    var controlador = base_url+"cotizacion/pasar_a_ventas/"+cotizacion_id;
    var url = base_url+"venta/ventas";


    $.ajax({url: controlador,
            type:"POST",
            data:{cotizacion_id: cotizacion_id},
            success:function(respuesta){

                alert("Proceso realizado con exito");
                 window.open(url, '_blank');
            }

        

    });

}