$(document).on("ready",inicio);

function inicio(){
    
        detalleordeni();
       
       filtro = " and date(orden_fecha) = date(now())";
    fechaorden(filtro);
}

function detalleordeni(){
     var controlador = "";
     
     var base_url = document.getElementById('base_url').value;
     var usuario_id = document.getElementById('usuario_id').value;
     controlador = base_url+'orden_trabajo/detalle_orden_trabajo/';
     
      $.ajax({url: controlador,
           type:"POST",
           data:{usuario_id:usuario_id},
           success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    var total_detalle = Number(0);
                    var total_preciodetalle = Number(0);
                    
                    var subtotal = Number(0);
                    var subpreciototal = Number(0);
                    var rango = Number(1);
                    var cantis = Number(0);
                    html = "";
                    
                    
                    for (var i = 0; i < n ; i++){
                        
                     
                        subtotal += Number(registros[i]["detalleorden_total"]);
                        subpreciototal += Number(registros[i]["detalleorden_preciototal"]);
                        total_detalle = Number(subtotal);
                        total_preciodetalle = Number(subpreciototal);

                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>"+rango+"-"+Number(Number(cantis)+Number(registros[i]["detalleorden_cantidad"]))+"</td>";
                       
                        html += "<td><b>"+registros[i]["producto_nombre"]+"</b><br>";
                        html += "Obs.: <b>"+registros[i]["tipoorden_nombre"]+"</b></td>"; 
                        //html += "<form action='"+base_url+"orden_trabajo/updatedetalleorden/"+usuario_id+"/"+registros[i]["producto_id"]+"'  method='POST' class='form'>";
                        //html += "<input id='detalleorden_caracteristica"+registros[i]["producto_id"]+"'  name='detalleorden_caracteristica' type='text' class='form-control' value='"+registros[i]["detalleorden_caracteristica"]+"' placeholder='caracteristica'> </td>";
                        html += "<td> <input id='usuario_id'  name='usuario_id' type='hidden' class='form-control' value='"+usuario_id+"'>";
                        //html += "<input id='detalleorden_descripcion'  name='descripcion' type='hidden' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";
                        
                        html += "<input id='detalleorden_cantidad"+registros[i]["detalleorden_id"]+"' name='cantidad' type='text' size='3' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detalleorden_id"]+","+usuario_id+")' value='"+registros[i]["detalleorden_cantidad"]+"' ></td> ";
                        html += "<td><input id='detalleorden_precio"+registros[i]["detalleorden_id"]+"'  name='cantidad' size='3' type='text' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detalleorden_id"]+","+usuario_id+")' value='"+registros[i]["detalleorden_precio"]+"' ></td>";
                        html += "<td><input id='ancho"+registros[i]["detalleorden_id"]+"'  name='cantidad' size='3' type='text' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detalleorden_id"]+","+usuario_id+")' value='"+registros[i]["detalleorden_ancho"]+"' ></td>";
                        html += "<td><input id='largo"+registros[i]["detalleorden_id"]+"'  name='cantidad' size='3' type='text' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detalleorden_id"]+","+usuario_id+")' value='"+registros[i]["detalleorden_largo"]+"' ></td>";
                        html += "<td><center><font size='3'> <b>"+Number(registros[i]["detalleorden_total"]).toFixed(2)+"</b></font>";
                        html += "</center></td>";
                        html += "<td><center><span class='badge badge-success'><font size='3'> <b>"+Number(registros[i]["detalleorden_preciototal"]).toFixed(2)+"</b></font> <br></span>";
                        html += "</center></td>";
                        html += "<td><button type='button' onclick='actualizarDetalle("+registros[i]["detalleorden_id"]+","+usuario_id+")' class='btn btn-success btn-xs'><i class='fa fa-random'></i></button>";
                        html += "<button type='button' onclick='quitardetallec("+registros[i]["detalleorden_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></button></td>";
                        rango = Number(Number(rango)+Number(registros[i]["detalleorden_cantidad"]));
                        cantis = Number(Number(cantis)+Number(registros[i]["detalleorden_cantidad"]));
                      
                        //html += "";
                       }
                       html += "<tr>";
                      // html += "<td><input id='total'  name='total' type='text' class='form-control' value='"+total_detalle+"'></td>";
                       html += "<th'></th>";
                       
                       html += "<th></th>";
                       html += "<th></th>";
                       html += "<th><font size='3'>TOTAL</th>";
                       html += "<th></th>";
                       html += "<th></th>";
                       html += "<th></th>";
                       html += "<th><font size='3'></th>";
                       html += "<th><font size='3'><b>"+Number(total_detalle).toFixed(2)+" M2</th>";
                       html += "<th><font size='3'><b>"+Number(total_preciodetalle).toFixed(2)+" Bs.</th>";
                       html += "</tr>";
                        //$('#orden_trabajo_total').value(total_detalle.toFixed(2));
                       $("#detalleordeniza").html(html);
                       $("#total").val(total_preciodetalle);
                       totality(total_detalle);
                       
          }  
        },
        error:function(respuesta){
          
       
   }
    });

}
function totality(total_detalle){
  var totalfinal = Number(total_detalle);
  $("#orden_trabajo_total").val(totalfinal.toFixed(2));
}


function actualizadetalle(e,detalle_id,usuario_id) {

  tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){ 
             
            actualizarDetalle(detalle_id,usuario_id);            

        }
}

function detalleordena(usuario_id,producto_id){
       
        var controlador = "";
   
        var cantidad = document.getElementById('cantidad'+producto_id).value; 
        var ancho = document.getElementById('ancho'+producto_id).value;
        var largo = document.getElementById('largo'+producto_id).value;
        var producto_precio = document.getElementById('producto_precio'+producto_id).value;
        var total = document.getElementById('total'+producto_id).value;
        var producto_factor = document.getElementById('select_factor'+producto_id).value;
        var tipo_orden = document.getElementById('selec_tipo'+producto_id).value;

    var base_url = document.getElementById('base_url').value;
    
    controlador = base_url+'orden_trabajo/insertarproducto/';
   
    
    $.ajax({url: controlador,
           type:"POST",
           data:{usuario_id:usuario_id, producto_id:producto_id, cantidad:cantidad, ancho:ancho, largo:largo, producto_precio:producto_precio, total:total, producto_factor:producto_factor, tipo_orden:tipo_orden},
           success:function(respuesta){     
               //alert (producto_factor);
               detalleordeni();                      
            
        }
        
    });
}





function actualizarDetalle(detalleorden_id,usuario_id){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'orden_trabajo/updatedetalleorden/';
    var precio = document.getElementById('detalleorden_precio'+detalleorden_id).value;
    var cantidad = document.getElementById('detalleorden_cantidad'+detalleorden_id).value;
    var ancho = document.getElementById('ancho'+detalleorden_id).value;
    var largo = document.getElementById('largo'+detalleorden_id).value;

   
 $.ajax({url: controlador,
            type:"POST",
            data:{detalleorden_id:detalleorden_id,precio:precio,cantidad:cantidad,ancho:ancho,largo:largo,usuario_id:usuario_id},
            success:function(respuesta){
                detalleordeni();
            }        
    });

} 



function quitardetallec(detalleorden_id){


    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'orden_trabajo/quitar/'+detalleorden_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                detalleordeni();
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

           var nit = document.getElementById('nit').value;
           if (nit=='' || nit==0){
                buscar_clientes();        
              }else{
                 document.getElementById('telefono').focus();   
              }
        } 

        if (opcion==4){   //si la tecla proviene del 

            tablaresultados(1);           

        } 

        if (opcion==5){   //si la tecla proviene del telefono

            document.getElementById('orden_numero').focus();           

        } 
        if (opcion==6){   //si la tecla proviene del numero de orden

            document.getElementById('cotizar').focus();        

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

   var controlador = base_url+'orden_trabajo/buscarcliente';

 
 
    $.ajax({url:controlador,

            type:"POST",

            data:{nit:nit},

            success:function(respuesta){

                

                var registros = eval(respuesta);

                

                if (registros[0]!=null){

                    

                    $("#razon_social").val(registros[0]["cliente_razon"]);
                    $("#telefono").val(registros[0]["cliente_telefono"]);

                    //document.getElementById('telefono').focus();

                    $("#cliente_id").val(registros[0]["cliente_id"]);
                    document.getElementById('orden_numero').focus();
                    

                }

                else

                {

                   

                    document.getElementById('razon_social').focus();

                    $("#razon_social").val("");
                    $("#razon_social").val("");

                    $("#cliente_id").val(0);

    

                }



            },

            error:function(respuesta){			

                $("#razon_social").val('NOMBRE');
                $("#nit").val(Date.now());

                document.getElementById('razon_social').select();

                

                $("#cliente_id").val(0);

            }                

    }); 



}

function buscar_clientes()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/buscar_clientes";
    var parametro = document.getElementById('razon_social').value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["cliente_id"]+"' label='"+resultado[i]["cliente_nombre"];
                    if (resultado[i]["cliente_nombrenegocio"]!=null)
                    {    html += " ("+resultado[i]["cliente_nombrenegocio"]+")"; }
                    html += "'>"+resultado[i]["cliente_razon"]+"</option>";
                }    
                $("#listaclientes").html(html);

            },
            error: function(respuesta){
            }
        });
}

function seleccionar_cliente(){
    var cliente_id = document.getElementById('razon_social').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"orden_trabajo/seleccionar_cliente/"+cliente_id;
    //alert(controlador);
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
//                alert(resultado[0]["cliente_nit"]);
                
                if (tam>=1){
                    $("#cliente_id").val(resultado[0]["cliente_id"]);
                    $("#nit").val(resultado[0]["cliente_nit"]);
                    $("#razon_social").val(resultado[0]["cliente_razon"]);
                    $("#telefono").val(resultado[0]["cliente_telefono"]);
                    $("#cliente_nombre").val(resultado[0]["cliente_nombre"]);
                    $("#cliente_codigo").val(resultado[0]["cliente_codigo"]);  
                    document.getElementById('orden_numero').focus();
                }
       

            },
            error: function(respuesta){
            }
        });    
    
}

function seleccionar(opcion) {
    
        if (opcion==1){             
            document.getElementById('nit').select();
        }
        
        if (opcion==2){
            document.getElementById('razon_social').select();
        }
        
     
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

    

    var base_url = document.getElementById('base_url').value;
    var usuario_id = document.getElementById('usuario_id').value;
    var tipo_orden = JSON.parse(document.getElementById('tipo_orden').value);
    
    

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

                       // "echo form_open('orden_trabajo/insertarproducto/')"; 

                      

                        html += "<td>"+(i+1)+"</td>";

                        html += "<td>";

                        //html += "<form action='"+base_url+"orden_trabajo/insertarproducto/'  method='POST' class='form'>";

                        html += "<div clas='row'>";                                            

                        html += "<div class='col-md-12'>";



                        html += "<b>"+registros[i]["producto_nombre"]+"</b><br>";
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
                        
                        html += "   </select>";
                        html += "   <select class='btn btn-warning btn-xs' style='font-size:10px; face=arial narrow;' id='selec_tipo"+registros[i]["producto_id"]+"' >";
                        var w = tipo_orden.length;
                       
                        for (var x=0; x<w; x++) {
                          
                        html += "       <option value='"+tipo_orden[x]["tipoorden_id"]+"'>"+tipo_orden[x]["tipoorden_nombre"]+"</option>";
  
                        }

                       
                        html += "   </select><br>";

                        html += "<div class='col-md-2'  >";

                        html += "Precio <input class='input-sm' id='producto_precio"+registros[i]["producto_id"]+"'  name='producto_precio' type='number' class='form-control' value='"+registros[i]["producto_precio"]+"' ></div>";

                        html += "<div class='col-md-2'  >";

                        html += "Ancho(mm) <input class='input-sm' id='ancho"+registros[i]["producto_id"]+"'  name='ancho' min='0' type='number' onkeyup='totalar("+registros[i]["producto_id"]+")' class='form-control' value='' step='any' > </div>";

                        html += "<div class='col-md-2'  >";

                        html += "Largo(mm) <input class='input-sm' id='largo"+registros[i]["producto_id"]+"'  name='largo' min='0' type='number' onkeyup='totalar("+registros[i]["producto_id"]+")' class='form-control' value='' step='any'  ></div>";

                        html += "<div class='col-md-2'  >";

                        html += "Total(M2) <input class='input-sm' id='total"+registros[i]["producto_id"]+"' name='total' type='text' readonly='readonly' class='form-control'  value=''  > </div>";
                        html += "<div class='col-md-2'  >";

                        html += "Cant. <input class='input-sm'  id='cantidad"+registros[i]["producto_id"]+"' name='cantidad' type='number' class='form-control'  value='1'> </div>";

                        html += "<div class='col-md-2'  >";

                        html += "Anadir";



                        html += "<button type='button' onclick='detalleordena("+usuario_id+","+registros[i]["producto_id"]+")'  class='btn btn-success'><i class='fa fa-cart-arrow-down'></i></button>";

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

function totalar(producto_id)
{
  var ancho = Number(document.getElementById('ancho'+producto_id).value);
  var largo = Number(document.getElementById('largo'+producto_id).value);
  $("#total"+producto_id).val(Number(ancho*largo/1000000).toFixed(2));
}

function saldar()
{
  var cuenta = Number(document.getElementById('cuenta').value);
  var total = Number(document.getElementById('total').value);
  var numero = Number(document.getElementById('orden_numero').value);
  var cliente_nombre = document.getElementById('razon_social').value;
  var cliente_nit = document.getElementById('nit').value;
  var cliente_telefono = document.getElementById('telefono').value;
  $("#cliente_nombre").val(cliente_nombre);
  $("#cliente_nit").val(cliente_nit);
  $("#cliente_telefono").val(cliente_telefono);
  $("#numero").val(numero);
  $("#saldo").val(Number(total-cuenta).toFixed(2));
}



function busqueda_ot()
{
    var base_url    = document.getElementById('base_url').value;
    var opcion      = document.getElementById('select_fecha').value;
 
    if (opcion == 1)
    {
        filtro = " and date(orden_fecha) = date(now())";
        mostrar_ocultar_buscador("ocultar");
        $("#busquedaavanzada").html('Del Dia');
               
    }//compras de hoy
    
    if (opcion == 2)
    {
       
        filtro = " and date(orden_fecha) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
        $("#busquedaavanzada").html('De Ayer');
    }//compras de ayer
    
    if (opcion == 3) 
    {
    
        filtro = " and date(orden_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)";//compras de la semana
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

    fechaorden(filtro);
}


function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function buscar_porcliente(e)
{
   tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){

    
  var cliente    = document.getElementById('orden_cli').value; 
  var parametro = " and cli.cliente_nombre like '%"+cliente+"%' ";
  fechaorden(parametro);
    }

}


function fechaorden(parametro){
  var base_url    = document.getElementById('base_url').value;
  var controlador = base_url+"orden_trabajo/buscar_ot";
   

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
          
           success:function(resul){     
              
                            
                
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    
                    var cont = 0;
                    var total = Number(0);
                    var total_acuenta = Number(0);
                    var total_saldo = Number(0);
                    
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    $("#pillados").html("Registros Encontrados: "+n+" ");
                   
                    html = "";
                 
                    
                    for (var i = 0; i < n ; i++){

                        total += Number(registros[i]["orden_total"]);
                        total_acuenta += Number(registros[i]["orden_acuenta"]);
                        total_saldo += Number(registros[i]["orden_saldo"]);
                        
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>"+registros[i]["cliente_nombre"]+"</td>";  
                        html += "<td align='center'><b>"+registros[i]["orden_numero"]+"</b></td>";  
                        html += "<td align='center'>"+moment(registros[i]["orden_fecha"]).format('DD/MM/YYYY')+"<br>"+registros[i]["orden_hora"]+"</td>";
                        html += "<td align='center'>"+moment(registros[i]["orden_fechaentrega"]).format('DD/MM/YYYY')+"</td>";
                        html += "<td align='right'>"+Number(registros[i]["orden_total"]).toFixed(2)+"</td>";
                        html += "<td align='right'>"+Number(registros[i]["orden_acuenta"]).toFixed(2)+"</td>";
                        html += "<td align='right'>"+Number(registros[i]["orden_saldo"]).toFixed(2)+"</td>";
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td>";
                        if (registros[i]["venta_id"]>0) {
                        html += "<td><a href='"+base_url+"seguimiento/seguimiento/"+registros[i]["orden_id"]+"/"+registros[i]["venta_id"]+"' target='_blank' title='Proceso OT' class='btn btn-warning btn-xs'><span class='fa fa-spinner'></span> ";  
                        html += "OT: "+registros[i]['orden_id']+" Cod.: "+registros[i]['venta_id']+"</a></td>";
                        }
                        html += "<td class='no-print'>";
                        
                        html += " <a href='"+base_url+"orden_trabajo/editar/"+registros[i]["orden_id"]+"' target='_blank' title='Editar OT' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a>";
                        html += " <a href='"+base_url+"orden_trabajo/ordendoc/"+registros[i]["orden_id"]+"' target='_blank' title='Imp. OT' class='btn btn-facebook btn-xs'><span class='fa fa-print'></span></a>";
                        html += " <a href='"+base_url+"orden_trabajo/ordenrecibo/"+registros[i]["orden_id"]+"' target='_blank' title='Nota OT' class='btn btn-success btn-xs'><span class='fa fa-print'></span></a>";
                        
                        html += " <a href='#' data-toggle='modal'  data-target='#modalanular"+registros[i]["orden_id"]+"' title='Anular OT' class='btn btn-xs btn-danger' style=''><i class='fa fa-ban'></i></a>";
                        html += "                       <!------------------------ modal para eliminar el producto ------------------->";
                        html += " <div class='modal fade' id='modalanular"+registros[i]['orden_id']+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+registros[i]['orden_id']+"'>";
                        html += " <div class='modal-dialog' role='document'>";
                        html += "  <br><br>";
                        html += " <div class='modal-content'>";
                        html += " <div class='modal-header'>";
                        html += " <h1 class='modal-title' id='myModalLabel'>ADVERTENCIA</h1>";
                        html += " </div>";
                        html += " <div class='modal-body'>";
                        html += " <div class='panel panel-primary'>";
                        html += " ";
                        html += " <center>";
                        html += " <!------------------------------------------------------------------->";
                        html += " <h1 style='font-size: 80px'> <b> <em class='fa fa-trash'></em></b></h1> ";
                        html += " <h4>";
                        html += " ";
                        html += " ¿Desea anular la OT? <b> <br>";
                        html += " Orden de  Trabajo: "+registros[i]['orden_id']+"<br>";
    //                    
                        html += " </h4>";
                        html += "     <!------------------------------------------------------------------->";
                        html += " ";
                        html += "   </center>";
                        html += "   </div>";
                        html += "   </div>";
                        html += "    <div class='modal-footer aligncenter'>";
                        html += "   <center>";                                        
                        html += "  <a href='"+base_url+"orden_trabajo/anular/"+registros[i]['orden_id']+"' class='btn btn-danger  btn-sm'><em class='fa fa-pencil'></em> Si </a>";

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
                       html += "<tr>";
                       html += "<th colspan='2'>TOTAL</th>";
                       html += "<th></th>";
                       html += "<th></th>";
                       html += "<th></th>";
                       html += "<th align='right'>"+Number(total).toFixed(2)+"</th>";
                       html += "<th align='right'>"+Number(total_acuenta).toFixed(2)+"</th>";
                       html += "<th align='right'>"+Number(total_saldo).toFixed(2)+"</th>";
                       html += "<th></th>";
                       html += "<th></th>";
                       html += "<th></th>";
                       html += "</tr>";
                            
                   
                   $("#fechadeorden").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadeorden").html(html);
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
   
   
         filtro = " and date(orden_fecha) >= '"+fecha_desde+"'  and  date(orden_fecha) <='"+fecha_hasta+"' ";
         $("#busquedaavanzada").html(fecha1+" "+fecha2);
    
    fechaorden(filtro);
}
