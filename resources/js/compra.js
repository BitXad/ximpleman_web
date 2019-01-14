$(document).on("ready",inicio);
function inicio(){
        
        
        tabladetallecompra(); 
        tablatotales();
        
}
function tabladetallecompra(){
     var controlador = "";
     var limite = 500;
     var base_url = document.getElementById('base_url').value;
     var compra_id = document.getElementById('compra_idie').value;
     var bandera = document.getElementById('bandera').value;
     controlador = base_url+'compra/detallecompra/';

     $.ajax({url: controlador,
           type:"POST",
           data:{compra_id:compra_id},
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
                        
                        var suma = Number(registros[i]["detallecomp_total"]);
                        descuento += Number(registros[i]["detallecomp_descuento"]);
                        subtotal += Number(registros[i]["detallecomp_subtotal"]);
                        total_detalle = Number(subtotal-descuento); 
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["producto_nombre"]+" /</b><br>";
                        
                        html += "<b>"+registros[i]["detallecomp_unidad"]+"</td>";                                            
                        html += "<td style='font-size:12px; text-align:center;'>"+registros[i]["detallecomp_codigo"]+"</td>";
                        
                        html += "<td><input id='compra_identi'  name='compra_id' type='hidden' class='form-control' value='"+compra_id+"'>";
                        html += "<input id='producto_identi'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>" ;
                        
                        html += "<input style='font-size:13px; width:60px;' id='detallecomp_precio"+registros[i]["producto_id"]+"'  name='producto_precio"+registros[i]["producto_id"]+"' type='text'  class='form-control' onkeypress='return pulsar(event)' value='"+Number(registros[i]["detallecomp_precio"]).toFixed(2)+"'  ></td>"; 
                        html += "<td><input style='font-size:13px; width:60px;' id='detallecomp_costo"+registros[i]["producto_id"]+"'  name='producto_costo"+registros[i]["producto_id"]+"' type='text'  class='form-control' onkeypress='return pulsar(event)' value='"+Number(registros[i]["detallecomp_costo"]).toFixed(2)+"' ></td>";
                        html += "<td style='padding-left:0px; padding-right:0px;'><input style='font-size:13px; width:50px;' id='detallecomp_cantidad"+registros[i]["producto_id"]+"'  name='cantidad' type='text' autocomplete='off' class='form-control' value='"+registros[i]["detallecomp_cantidad"]+"' onkeypress='return pulsar(event)'>";
                        html += "<input id='detallecomp_id'  name='detallecomp_id' type='hidden' class='form-control' value='"+registros[i]["detallecomp_id"]+"'>";
                       
                        html += "<td style='font-size:13px; text-align:center;'>"+Number(registros[i]["detallecomp_subtotal"]).toFixed(2)+"</b></td>";
                        html += "<td><input style='font-size:13px; width:55px;' id='detallecomp_descuento"+registros[i]["producto_id"]+"'  name='descuento'  type='text' autocomplete='off' class='form-control' onkeypress='return pulsar(event)' value='"+Number(registros[i]["detallecomp_descuento"]).toFixed(2)+"' >";
                       
                        
                       
                  
                        html += "</td>";
                        html += "<td><center>";
                        html += "<span class='badge badge-success'>";
                        html += "<font size='2'> <b>"+Number(registros[i]["detallecomp_total"]).toFixed(2)+"</b></font> <br>";
                        html += "</span></center></td>";
                        ////////////////////////////formu////////////////
                        html += "<td style='padding-left:4px; padding-right:4px;'><button type='button' onclick='editadetalle("+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' class='btn btn-success btn-sm'><span class='fa fa-save'></span></button>";

                        ////////////////////////////////fin fotmu//////////////////////
                        //html += "<td><form action='"+base_url+"detalle_compra/quitar/"+registros[i]["detallecomp_id"]+"/"+compra_id+"'  method='POST' class='form'>";
                        //html += "<input id='bandera' class='form-control' name='bandera' type='hidden' value='"+bandera+"' />";
                        //html += "<button type='submit' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button>";
                        html += "<td style='padding-left:4px; padding-right:4px;'><button type='button' onclick='quitardetalle("+registros[i]["detallecomp_id"]+")' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button>";
                        html += "</form></td>";
                    }
                   $("#detallecompringa").html(html);
                   tablatotales(total_detalle,descuento,subtotal);
                   
                }

        },
        error:function(respuesta){
          
        }
        
    });
}

function tablatotales(total_detalle,descuento,subtotal)
{

     var parcial = Number(subtotal-descuento);
     var globaly = Number(document.getElementById('compra_descglobal').value);
     var totalfinal = Number(total_detalle-globaly);
    $('#compra_subtotal').val(subtotal.toFixed(2));
   $('#compra_descuento').val(descuento.toFixed(2));
   $('#compra_total').val(parcial.toFixed(2));
    $("#compra_totalfinal").val(totalfinal.toFixed(2));
    //$("#venta_glogal").val(globaly);
     

     html = "";
     html += "<table><tr><td>Sub Total Bs:</td><td></td>";
     html += "<td style='align-right'>"+subtotal.toFixed(2)+"</td>";
     html += "</tr><tr>";
     html += "<td>Descuento:</td><td></td>";
     html += "<td style='align-right'>"+descuento.toFixed(2)+"</td>";
     html += "</tr><tr>";
     html += "<td>Descuento Global:</td><td style='width: 30px;'></td>";
     html += "<td style='align-right'>"+globaly.toFixed(2)+"</td>";
     html += "</tr>";
     html += "<tr>";
     html += "<th><b>TOTAL FINAL:</b></th><td></td>";
     html += "<th style='align-right'><font size='3'><b>"+totalfinal.toFixed(2)+"</b></font></th>";
     html += "</tr></table>";
 


    $("#detalleco").html(html); 
}


function detallecompra(compra_id, producto_id){
       
        var controlador = "";
   
        var cantidad = document.getElementById('cantidaddetalle'+producto_id).value; 
        var descuento = document.getElementById('descuentodetalle'+producto_id).value;
        var producto_costo = document.getElementById('producto_costodetalle'+producto_id).value;
        var producto_precio = document.getElementById('producto_preciodetalle'+producto_id).value;
     

    var limite = 500;
    var base_url = document.getElementById('base_url').value;
    
    controlador = base_url+'compra/ingresarproducto/';
   
    
    $.ajax({url: controlador,
           type:"POST",
           data:{compra_id:compra_id, producto_id:producto_id, cantidad:cantidad, descuento:descuento, producto_costo:producto_costo, producto_precio:producto_precio},
           success:function(respuesta){     
               
               tabladetallecompra();                      
            
        }
        
    });
}
 
function quitardetalle(detallecomp_id){


    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'compra/quitar/'+detallecomp_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tabladetallecompra();
            }        
    });

}   

function editadetalle(detallecomp_id,producto_id,compra_id){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'compra/updateDetalle/';
    var costo = document.getElementById('detallecomp_costo'+producto_id).value;
    var precio = document.getElementById('detallecomp_precio'+producto_id).value;
    var cantidad = document.getElementById('detallecomp_cantidad'+producto_id).value;
    var descuento = document.getElementById('detallecomp_descuento'+producto_id).value;
    
    
    $.ajax({url: controlador,
            type:"POST",
            data:{detallecomp_id:detallecomp_id,costo:costo,precio:precio,cantidad:cantidad,descuento:descuento,producto_id:producto_id,compra_id:compra_id},
            success:function(respuesta){
                tabladetallecompra();
            }        
    });

} 
      

function cambiarproveedores(compra_id,proveedor_id) {
     
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'proveedor/cambiarproveedor/';
    var limite = 500;
     var nit = document.getElementById('proveedor_nit'+proveedor_id).value;
                var razon_social = document.getElementById('proveedor_razon'+proveedor_id).value;
                //var codigo_control = document.getElementById('proveedor_codigo'+proveedor_id).value;
                //var autorzacion = document.getElementById('proveedor_autorizacion'+proveedor_id).value;
               
    $.ajax({url: controlador,
           type:"POST",
           data:{compra_id:compra_id,proveedor_id:proveedor_id,nit:nit,razon_social:razon_social},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
                var p = 0;
               
               html = "";   

                
             
                    html = registros[p]['proveedor_nombre'];
                     $("#provedordecompra").html(html);

                    html = "<input id='prove_id' type='hidden' value='"+proveedor_id+"'>";
                     $("#prove_iden").html(html);

                    html = registros[p]['proveedor_codigo'];
                     $("#provedorcodigo").html(html);
                  
                     html = "<a  href='#' data-toggle='modal' data-target='#modalcobrar' class='btn btn-xs btn-success' ><i class='fa fa-money'></i>Finalizar compra</a>";
                    $("#provedorboton").html(html);
            } else{
                    html = "<a  onclick='myFunction()' href='#' class='btn bbtn-xs btn-success' ></i>Finalizar compra </a>";
                        $("#provedorboton").html(html);
                        }
             },
            error:function(respuesta){
           html = "";
           $("#provedordecompra").html(html);
          
} 
            });   

 

}

function crearproveedor(compra_id) {
     
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'proveedor/rapido/';
    var limite = 500;
    
                var proveedor_nombre = document.getElementById('proveedor_nombre1').value;

                var proveedor_nit = document.getElementById('proveedor_nit').value;
                var proveedor_razon = document.getElementById('proveedor_razon').value;
                var proveedor_codigo = document.getElementById('proveedor_codigo1').value;
                var proveedor_autorizacion = document.getElementById('proveedor_autorizacion').value;
                var proveedor_contacto = document.getElementById('proveedor_contacto').value;
                var proveedor_direccion = document.getElementById('proveedor_direccion').value;
                var proveedor_telefono = document.getElementById('proveedor_telefono').value;
                var proveedor_telefono2 = document.getElementById('proveedor_telefono2').value;
                
            $.ajax({url: controlador,
           type:"POST",
           data:{compra_id:compra_id,proveedor_nombre:proveedor_nombre,proveedor_nit:proveedor_nit,proveedor_razon:proveedor_razon,proveedor_codigo:proveedor_codigo,proveedor_autorizacion:proveedor_autorizacion,proveedor_contacto:proveedor_contacto,proveedor_direccion:proveedor_direccion,proveedor_telefono:proveedor_telefono,proveedor_telefono2:proveedor_telefono2},
           success:function(respuesta){ 
                var registros =  JSON.parse(respuesta);
                 if (registros != null){
                 var n = registros.length;
                var p = 0;
                var proveedor_id = registros[p]['proveedor_id']; 
                   html = "";   

                
             
                    html = registros[p]['proveedor_nombre'];
                     $("#provedordecompra").html(html);

                    html = "<input id='prove_id' type='hidden' value='"+proveedor_id+"'>";
                     $("#prove_iden").html(html);

                    html = registros[p]['proveedor_codigo'];
                     $("#provedorcodigo").html(html);
                  
                     html = "<a  href='#' data-toggle='modal' data-target='#modalcobrar' class='btn btn-xs btn-success' ><i class='fa fa-money'></i>Finalizar compra</a>";
                    $("#provedorboton").html(html);
            } else{
                    html = "<a  onclick='myFunction()' href='#' class='btn bbtn-xs btn-success' ></i>Finalizar compra </a>";
                        $("#provedorboton").html(html);
                        }
             },

              
 error:function(respuesta){
           html = "";
           $("#provedordecompra").html(html);
          
} 
            });   

 

}

function validacompra(e,opcion) {
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
 
            compraproveedor(1);           
        } 
        
    } 

    
}
function compravalidar(e,opcion) {
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
function compraproducto(e,opcion) {
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
       
            tablareproducto(1);  
           
        } 
        
    } 

    
}

function buscar_compras()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";
    var opcion      = document.getElementById('select_compra').value;
 
    

    if (opcion == 1)
    {
        filtro = " and date(compra_fecha) = date(now())";
        mostrar_ocultar_buscador("ocultar");

               
    }//compras de hoy
    
    if (opcion == 2)
    {
       
        filtro = " and date(compra_fecha) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }//compras de ayer
    
    if (opcion == 3) 
    {
    
        filtro = " and date(compra_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)";//compras de la semana
        mostrar_ocultar_buscador("ocultar");

            }

    
    if (opcion == 4) 
    {   filtro = " ";//todos los compras
        mostrar_ocultar_buscador("ocultar");

    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    fechadecompra(filtro);
}

   function reporte_compras()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";
    var opcion      = document.getElementById('select_compra').value;
 
    

    if (opcion == 1)
    {
        filtro = " and date(compra_fecha) = date(now())";
        mostrar_ocultar_buscador("ocultar");

               
    }//compras de hoy
    
    if (opcion == 2)
    {
       
        filtro = " and date(compra_fecha) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }//compras de ayer
    
    if (opcion == 3) 
    {
    
        filtro = " and date(compra_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)";//compras de la semana
        mostrar_ocultar_buscador("ocultar");

            }

    
    if (opcion == 4) 
    {   filtro = " ";//todos los compras
        mostrar_ocultar_buscador("ocultar");

    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    reportefechadecompra(filtro);
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function buscar_por_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
   var tipotrans_id = document.getElementById('tipotrans_id').value;
    
    filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+
            "' and c.tipotrans_id = "+tipotrans_id;
    fechadecompra(filtro);

    
}
function buscar_reporte_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var tipotrans_id = document.getElementById('tipotrans_id').value;
    
    filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+
            "' and c.tipotrans_id = "+tipotrans_id;
    reportefechadecompra(filtro);

    
}

function buscar_reporte_proveedor()
{

    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var proveedor_id = document.getElementById('proveedor_id').value;
    
   if (fecha_desde =='' && fecha_hasta ==''){

    filtro =  " and p.proveedor_nombre = '"+proveedor_id+"' "
    reportefechadecompra(filtro);
    }else{ 
    filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+
            "' and p.proveedor_nombre = '"+proveedor_id+"' "
    reportefechadecompra(filtro);
}
}
function buscar_reporte_producto(producto_id)
{

    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    //var producto_id = document.getElementById('producto_id').value;
    
   if (fecha_desde =='' && fecha_hasta ==''){

    filtro =  " and dc.producto_id = '"+producto_id+"' "
    reportefechadecompra(filtro);
    }else{ 
    filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+
            "' and dc.producto_id = '"+producto_id+"' "
    reportefechadecompra(filtro);
}
}

//Selecciona los datos del nit

//muestra la tabla de productos disponibles para la venta
  function convertDateFormat(string) {
        var info = string.split('-').reverse().join('/');
        return info;
   }

function compraproveedor(opcion)
{   
     
    var controlador = "";
    var parametro = "";
   
    var limite = 100;
    var base_url = document.getElementById('base_url').value;
    
    if (opcion == 1){
        controlador = base_url+'compra/buscarprove/';
        parametro = document.getElementById('comprar').value; 
       
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
                    var total = Number(0);
                    var total_detalle = 0;
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        var bandera = 1;
                        var suma = Number(registros[i]["compra_totalfinal"]);
                        var total = Number(suma+total);
                        var caja = registros[i]["compra_caja"];
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["proveedor_nombre"]+"</b></font> <br>";
                        
                        html += "<span class='btn-info btn-xs'>"+registros[i]["tipotrans_nombre"]+"</span><br>";                                            
            if (caja==1) {  
                        html += "<span class='btn-warning btn-xs'>hola</span>";  }                                          
                        html += "</td><td align='right' > Subtotal:"+Number(registros[i]["compra_subtotal"]).toFixed(2)+"<br>Desc: "+Number(registros[i]["compra_descuento"]).toFixed(2)+"<br> DescGlobal: "+Number(registros[i]["compra_descglobal"]).toFixed(2)+"<br>";
                        html += "<font size='3'><b>Total:"+Number(registros[i]["compra_totalfinal"]).toFixed(2)+"</b></font></td>";
                        html += "<td>"+convertDateFormat(registros[i]["compra_fecha"])+"<br>"+registros[i]['compra_hora']+"</td>" ;
                        
                        html += "<td>"+registros[i]["estado_descripcion"]+"</td>"; 
                        html += "<td><a href='"+base_url+"compra/pdf/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></span></a>";
                        html += "<form action='"+base_url+"compra/edit/"+registros[i]["compra_id"]+"/"+bandera+"/'  method='POST' class='form'>";
                        html += "<input type='hidden' id='bandera' name='bandera' value='1'>";
                        html += "<button class='btn btn-info btn-xs' type='submit'><span class='fa fa-pencil'></span></button>";
                        html += "</form></td>";
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td align='right'><b>TOTAL</b></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(total).toFixed(2)+"</b></font></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   
                   $("#fechadecompra").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadecompra").html(html);
        }
        
    });   

} 

function fechadecompra(filtro)
{   
      
   var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra/buscarfecha";
    var limite = 25;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                            
                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    
                    var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["compra_totalfinal"]);
                        var total = Number(suma+total);
                        var caja = registros[i]["compra_caja"];
                        var bandera = 1;
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["proveedor_nombre"]+"</b></font> <br>";
                        
                        html += "<span class='btn-info btn-xs'>"+registros[i]["tipotrans_nombre"]+"</span></br>"; 
                        if (caja==1) {  
                        html += "<span class='btn-warning btn-xs'>Pago con Caja</span>";  }                                             
                        html += "</td><td align='right' > Subtotal:"+Number(registros[i]["compra_subtotal"]).toFixed(2)+"<br>Desc: "+Number(registros[i]["compra_descuento"]).toFixed(2)+"<br> DescGlobal: "+Number(registros[i]["compra_descglobal"]).toFixed(2)+"<br>";
                        html += "<font size='3'><b>Total:"+Number(registros[i]["compra_totalfinal"]).toFixed(2)+"</b></font></td>";
                        html += "<td  align='center'>"+convertDateFormat(registros[i]["compra_fecha"])+"<br>"+registros[i]['compra_hora']+"</td>" ;
                        
                        html += "<td  align='center'>"+registros[i]["estado_descripcion"]+"</td>"; 
                        html += "<td><a href='"+base_url+"compra/pdf/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></span></a>";
                        html += "<form action='"+base_url+"compra/edit/"+registros[i]["compra_id"]+"/"+bandera+"/'  method='POST' class='form'>";
                        html += "<input type='hidden' id='bandera' name='bandera' value='1'>";
                        html += "<button class='btn btn-info btn-xs' type='submit'><span class='fa fa-pencil'></span></button>";
                        html += "</form></td>";
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td align='right'><b>TOTAL</b></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(total).toFixed(2)+"</b></font></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   
                   $("#fechadecompra").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadecompra").html(html);
        }
        
    });   

} 

//Tabla resultados de la busqueda
function tablaresultados(opcion)
{   
    var controlador = "";
    var parametro = "";
    var compra_id = document.getElementById('compra_id').value;
    var limite = 100;
    var base_url = document.getElementById('base_url').value;
    var bandera = document.getElementById('bandera').value;
    
    if (opcion == 1){
        controlador = base_url+'compra/buscarcompra/';
        parametro = document.getElementById('comprar').value    
       
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
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        //html += "<form action='"+base_url+"compra/ingresarproducto/'  method='POST' class='form'>";
                        html += "<div clas='row'>";                                            
                        html += "<div class='container' hidden>";
                        html += "<input id='compra_id'  name='compra_id' type='text' class='form-control' value='"+compra_id+"'>";
                        html += "<input id='producto_iddetalle'  name='producto_id' type='text' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "<input id='descripcion'  name='descripcion' type='text' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";
                        html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+registros[i]["producto_costo"]+"'>";
                        //html += "<input id='producto_codigue'  name='producto_codigo' type='hidden' class='form-control' value='"+registros[i]["producto_codigo"]+"'>";
                        //html += "<input id='producto_unidade'  name='producto_unidad' type='hidden' class='form-control' value='"+registros[i]["producto_unidad"]+"'>";
                        html += "</div>";
                            
                        html += "<div class='col-md-12'>";

                        html += "<b><font size=2>"+registros[i]["producto_nombre"]+"</font>    ("+registros[i]["producto_codigo"]+")</b><br>";
                        html += "<div class='col-md-2'  >";
                        html += "Precio_V: <input class='input-sm' id='producto_preciodetalle"+registros[i]["producto_id"]+"'  style='width: 85px; background-color: lightgrey' autocomplete='off' name='producto_precio' type='number' step='0.01' class='form-control' value='"+registros[i]["producto_precio"]+"' ></div>";
                        html += "<div class='col-md-2'  >";
                        html += "Costo: <input class='input-sm' id='producto_costodetalle"+registros[i]["producto_id"]+"'  style='width: 85px; background-color: lightgrey' autocomplete='off' name='producto_costo' type='number' step='0.01' class='form-control' value='"+registros[i]["producto_costo"]+"' > </div>";
                        html += "<div class='col-md-2'  >";
                        html += "Desc.: <input class='input-sm' id='descuentodetalle"+registros[i]["producto_id"]+"'  style='width: 65px; background-color: lightgrey' autocomplete='off' name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";
                        html += "<div class='col-md-2'  >";
                        html += "Cant.: <input class='input-sm ' id='cantidaddetalle"+registros[i]["producto_id"]+"' style='width: 65px;' name='cantidad' type='number' autocomplete='off' class='form-control' placeholder='cantidad' required value='1'> </div>";
                        //html += "<input class='input-sm ' id='bandera'  name='bandera' type='hidden' class='form-control'  required value='"+bandera+"'>"
                        html += "<div class='col-md-2'  >";
                        html += "Anadir";

                        html += "<button type='button' onclick='detallecompra("+compra_id+","+registros[i]["producto_id"]+")' class='btn btn-success'><i class='fa fa-cart-arrow-down'></i></button>";
                        //html += "<a href=''  onclick='submit()' class='btn btn-danger'><span class='fa fa-cart-arrow-down'></span></a>";
                        
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                       // html += "</form>";
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

//tabla de reportes de producto 
function tablareproducto(opcion)
{   
    var controlador = "";
    var parametro = "";
    
    var limite = 100;
    var base_url = document.getElementById('base_url').value;
   
    
    if (opcion == 1){
        controlador = base_url+'compra/buscarcompra/';
        parametro = document.getElementById('comprar').value    
       
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
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        
                        html += "<div clas='row'>";                                            
                        
                        html += "<b>"+registros[i]["producto_id"]+"</b>";
                        html += "<input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "</td>";
                        html += "</div>";   
                        html += "<div class='col-md-12'>";
                        html += "<td>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
                        
                        html += "<td>";

                        html += "<button type='button' onclick='buscar_reporte_producto("+registros[i]["producto_id"]+")' class='btn btn-primary'><i class='fa fa-search'></i></button>";
                        
                        
                        
                        html += "</div>";
                        html += "</div>";
                      
                        html += "</td>";
                      
                       
                        html += "</tr>";

                   }
                 
                   
                   $("#tablareproducto").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
        
    });   

} 
function reportefechadecompra(filtro)
{   
      
   var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra/buscarrepofecha";
    var limite = 30;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(report){     
              
                            
                $("#enco").val("- 0 -");
               var registros =  JSON.parse(report);
           
               if (registros != null){
                   
                    
                    var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                   
                    for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["detallecomp_total"]);
                        var total = Number(suma+total);
                        var bandera = 1;
                        html += "<tr>";
                      
                        html += "<td align='center'>"+(i+1)+"</td>";
                        
                        
                        html += "<td> "+registros[i]["producto_nombre"]+" </td>";                                            
                        html += "<td align='center'> "+registros[i]["producto_codigo"]+" </td>";
                        html += "<td align='center'> "+registros[i]["compra_id"]+" </td>";  
                         html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";  
                        html += "<td align='center'> "+registros[i]["producto_unidad"]+" </td>";                                                                                    
                        html += "<td>"+convertDateFormat(registros[i]["compra_fecha"])+""+registros[i]['compra_hora']+"</td>" ;                                          
                        html += "<td align='right'> "+registros[i]["detallecomp_cantidad"]+" </td>"; 
                        html += "<td align='right'> "+Number(registros[i]["producto_costo"]).toFixed(2)+" </td>"; 
                        html += "<td align='right'><b>"+Number(registros[i]["detallecomp_total"]).toFixed(2)+"</b></td>";
                        
                        
                        html += "<td  align='center'>"+registros[i]["usuario_nombre"]+"</td>"; 
                       // html += "<td><a href='"+base_url+"compra/pdf/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'> </a>";
                       // html += "<form action='"+base_url+"compra/edit/"+registros[i]["compra_id"]+"/"+bandera+"/'  method='POST' class='form'>";
                       // html += "<input type='hidden' id='bandera' name='bandera' value='1'>";
                       // html += "<button class='btn btn-info btn-xs' type='submit'><span class='fa fa-pencil'> </button>";
                      //  html += "</form></td>";
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<th align='right'><b>TOTAL:</b></td>";
                        html += "<th align='right'><b>"+Number(total).toFixed(2)+"</b></th>";
                        html += "<td></td>";
                       
                        html += "</tr>";
                   
                   $("#reportefechadecompra").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#reportefechadecompra").html(html);
        }
        
    });   

} 