$(document).on("ready",inicio);
function inicio(){
     var ingreso_id = document.getElementById('ingreso_idie').value;    
        
        tabladetalleingreso();

        //tablatotales();
        
}

function hacerdisa()
{

 document.getElementById('botox').disabled=true;
 
}

function tabladetalleingreso(){
    
    var controlador = "";
    var limite = 500;
    var base_url = document.getElementById('base_url').value;
    var ingreso_id = document.getElementById('ingreso_idie').value;
    var decimales = document.getElementById('decimales').value;     
     controlador = base_url+'ingreso/detalleingreso/';

     $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id},
           success:function(respuesta){     
               
                                     
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    var total_detalle = Number(0);
                    var suma = Number(0);
                    
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        total_detalle += Number(registros[i]["detalleing_total"]);
                        //descuento += Number(registros[i]["detalleing_descuento"]);
                        //subtotal += Number(registros[i]["detalleing_subtotal"]);
                        //total_detalle = Number(total_detalle+suma); 
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td style='font-size:10px; width:200px;'><b>"+registros[i]["articulo_nombre"]+" /</b>";
                        
                        html += "<b> Cod: "+registros[i]["articulo_codigo"]+"</td>";                                            
                        html += "<td>"+registros[i]["factura_numero"]+"</td>";
                        html += "<td style='width:200px;'><input id='ingreso_identi'  name='ingreso_id' type='hidden' class='form-control' value='"+ingreso_id+"'>";
                        html += "<input id='articulo_identi'  name='articulo_id' type='hidden' class='form-control' value='"+registros[i]["articulo_id"]+"'>" ;
                        
                        html += "<input  class='input-sm' style='font-size:13px; width:100%;' id='detalleing_precio"+registros[i]["articulo_id"]+"'  name='articulo_precio"+registros[i]["articulo_id"]+"' type='text'  class='form-control' onkeypress='return pulsar(event)' value='"+Number(registros[i]["detalleing_precio"]).toFixed(decimales)+"'  ></td>"; 
                        
                        html += "<td style='width:150px;'><input  class='input-sm' style='font-size:13px;width:100%;' id='detalleing_cantidad"+registros[i]["articulo_id"]+"'  name='cantidad' type='text' autocomplete='off' class='form-control' value='"+registros[i]["detalleing_cantidad"]+"' onkeypress='return pulsar(event)'>";
                        html += "<input id='detalleing_id'  name='detalleing_id' type='hidden' class='form-control' value='"+registros[i]["detalleing_id"]+"'></td>";
                       
                        html += "<td style='width:150px;'><center>";
                        //html += "<span class='badge badge-success'>";
                        html += "<font size='2'> <b>"+Number(registros[i]["detalleing_total"]).toFixed(decimales)+"</b></font> <br>";
                        //html += "</span>"
                        html += "</center></td>";
                        
                        html += "<td style='padding-left:4px; padding-right:4px;'><button type='button' title='MODIFICAR' onclick='editadetalle("+registros[i]["detalleing_id"]+","+registros[i]["articulo_id"]+","+ingreso_id+")' class='btn btn-success btn-sm'><span class='fa fa-save'></span></button>";

                        
                        html += "<td style='padding-left:4px; padding-right:4px;'><button type='button' title='ELIMINAR' onclick='quitardetalle("+registros[i]["detalleing_id"]+")' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button>";
                        html += "</td>";
                    }
                    
                    html += "<tr>";
                    html += "  <th></ht>";
                    html += "  <th></ht>";
                    html += "  <th></ht>";
                    html += "  <th></ht>";
                    html += "  <th></ht>";
                    html += "  <th>"+Number(total_detalle).toFixed(decimales)+"</ht>";
                    html += "</tr>";
                    
                   $("#tabladetalleingreso").html(html);
                  tablatotales(total_detalle);
                   
                }

        },
        error:function(respuesta){
          
        }
        
    });
}


function buscaarticulo(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
       
        if (opcion==3){  
            tablaresultados(1);    

        } 
        
    } 

    
} 
//Tabla resultados de la busqueda de particulos
function tablaresultados(opcion)
{   
    var controlador = "";
    var parametro = "";
    var ingreso_id = document.getElementById('ingreso_id').value;
    var limite = 200;
    var base_url = document.getElementById('base_url').value;
    var decimales = document.getElementById('decimales').value;
    //var bandera = document.getElementById('bandera').value;
    
    if (opcion == 1){
        controlador = base_url+'ingreso/buscaringreso/';
        parametro = document.getElementById('articulobus').value 
        
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
                       // "echo form_open('ingreso/insertararticulo/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        //html += "<form action='"+base_url+"ingreso/ingresararticulo/'  method='POST' class='form'>";
                        html += "<div clas='row'>";                                            
                        html += "<div class='container' hidden>";
                       // html += "<input id='ingreso_id1'  name='ingreso_id' type='text' class='form-control' value='"+ingreso_id+"'>";
                       //html += "<input id='articulo_iddetalle'  name='articulo_id' type='text' class='form-control' value='"+registros[i]["articulo_id"]+"'>";
                        //html += "<input id='descripcion'  name='descripcion' type='text' class='form-control' value='"+registros[i]["articulo_nombre"]+","+registros[i]["articulo_marca"]+","+registros[i]["articulo_industria"]+"'>";
                        //html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+registros[i]["articulo_costo"]+"'>";
                        //html += "<input id='articulo_codigue'  name='articulo_codigo' type='hidden' class='form-control' value='"+registros[i]["articulo_codigo"]+"'>";
                        //html += "<input id='articulo_unidade'  name='articulo_unidad' type='hidden' class='form-control' value='"+registros[i]["articulo_unidad"]+"'>";
                        html += "</div>";
                            
                        html += "<div class='col-md-12' style='padding-left: 0px;'>";

                        html += "<b><font size=2>"+registros[i]["articulo_nombre"]+"</font>  <b>"+registros[i]["articulo_unidad"]+"</b>  ("+registros[i]["articulo_codigo"]+")</b>  <span class='btn btn-facebook btn-xs'>"+Number(registros[i]["articulo_saldo"]).toFixed(decimales)+"</span><br>";
                        html += "<div class='col-md-4' style='padding-left: 0px;' >";
                        //html += "Precio: <input class='input-sm' id='articulo_preciodetalle"+registros[i]["articulo_id"]+"'  style='width: 80px;  autocomplete='off' name='articulo_precio' type='number' step='0.01' class='form-control' value='"+registros[i]["articulo_precio"]+"' ></div>";
                       // html += "<div class='col-md-2' style='padding-left: 0px;'>";
                       // html += "Costo: <input class='input-sm' id='articulo_costodetalle"+registros[i]["articulo_id"]+"'  style='width: 80px; background-color: lightgrey' autocomplete='off' name='articulo_costo' type='number' step='0.01' class='form-control' value='"+registros[i]["articulo_ultimocosto"]+"' > </div>";
                        //html += "<div class='col-md-2' style='padding-left: 0px;' >";
                        //html += "Desc.: <input class='input-sm' id='descuentodetalle"+registros[i]["articulo_id"]+"'  style='width: 60px; background-color: lightgrey' autocomplete='off' name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";
                       
                        html += "Cantidad: <input class='input-sm ' id='cantidaddetalle"+registros[i]["articulo_id"]+"' style='width: 80px;' name='cantidad' type='number' autocomplete='off' class='form-control' placeholder='cantidad' required value='1'> </div>";
                        html += "<div class='col-md-4'style='padding-left: 0px;'  >";
                        html += "Precio Total: <input class='input-sm' id='articulo_preciodetalle"+registros[i]["articulo_id"]+"'  style='width: 80px;  autocomplete='off' name='articulo_precio' type='number' step='0.01' class='form-control' value='' ></div>";

                        //html += "<div class='col-md-2' style='padding-left: 0px;' >";
                       // html += "F.Venc.:<input class='input-sm ' type='date' id='detalleing_fechavencimiento"+registros[i]["articulo_id"]+"' style='width: 110px;padding-left: 0px;' name='detalleing_fechavencimiento'  class='form-control' ></div>";
                        html += "<div class='col-md-2'>";
                        html += "Ingresar:";

                        html += "<button type='button' onclick='detalleingreso("+ingreso_id+","+registros[i]["articulo_id"]+")' class='btn btn-success'><i class='fa fa-cart-plus'></i></button>";
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
          
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

function detalleingreso(ingreso_id,articulo_id){
       
        var controlador = "";
        var cantidad = document.getElementById('cantidaddetalle'+articulo_id).value; 
        var articulo_precio = document.getElementById('articulo_preciodetalle'+articulo_id).value;
        var facturation = document.getElementById('facturation').value;

    var limite = 500;
    var base_url = document.getElementById('base_url').value;
    controlador = base_url+'ingreso/ingresararticulo/';
   if (facturation==0) {
    alert("Debe seleccionar una Factura");
    document.getElementById("facturation").focus();
   }else{
    
    $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id, articulo_id:articulo_id, cantidad:cantidad, articulo_precio:articulo_precio,facturation:facturation},
           success:function(respuesta){     
               
               tabladetalleingreso();                      
            
        }
        
    });
} 
}
function editadetalle(detalleing_id,articulo_id,ingreso_id){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/updateDetalle/';
    var precio = document.getElementById('detalleing_precio'+articulo_id).value;
    var cantidad = document.getElementById('detalleing_cantidad'+articulo_id).value;    
    
    $.ajax({url: controlador,
            type:"POST",
            data:{detalleing_id:detalleing_id,precio:precio,cantidad:cantidad,articulo_id:articulo_id,ingreso_id:ingreso_id},
            success:function(respuesta){
                tabladetalleingreso();
            }        
    });

} 
function quitardetalle(detalleing_id){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/quitar/'+detalleing_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tabladetalleingreso();
            }        
    });

}

function quitarprograma(pedido_id){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/quitarpedido/';
     var ingreso_id = document.getElementById('ingreso_id').value;
    $.ajax({url: controlador,
            type:"POST",
            data:{ingreso_id:ingreso_id,pedido_id:pedido_id},
            success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
  
               
               html = "";   
                  for (var i = 0; i < n ; i++){

                    html += "<tr>";
                    html += "<td>"+registros[i]["pedido_numero"]+"</td>";
                    html += "<td>"+registros[i]["unidad_nombre"]+"</td>";
                    html += "<td>"+registros[i]["programa_nombre"]+"</td>";
                    html += "<td><a class='btn btn-danger btn-xs' onclick='quitarprograma("+registros[i]["pedido_id"]+")'><span class='fa fa-trash'></span></a></td>";
                    html += "</tr>";
                   }
                    $("#pedidosdeingreso").html(html);
            
                        }
             },
            error:function(respuesta){
           html = "";
           $("#pedidosdeingreso").html(html);
          
} 
            });   

 
}

function quitarfactura(factura_id){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/quitarfactura/';
    var ingreso_id = document.getElementById('ingreso_id').value;
    
    $.ajax({url: controlador,
            type:"POST",
            data:{ingreso_id:ingreso_id,factura_id:factura_id},
            success:function(respuesta){
             
               dibujar_facturas(ingreso_id,factura_id);
             
             },
            error:function(respuesta){
           alert('error');
          
} 
            });   

 
}
function tablatotales(total_detalle)
{

    var decimales = document.getElementById('decimales').value;
     var totalfinal = Number(total_detalle).toFixed(decimales);
    
    $("#ingreso_totalfinal").val(Number(totalfinal).toFixed(decimales));
   
     html = "";
     html += "<table><tr>";
     html += "<th><b>TOTAL FINAL Bs.:</b></th><td width='30px'></td>";
     html += "<th style='text-align: right;'><font size='3'><b>"+Number(totalfinal).toFixed(decimales)+"</b></font></th>";
     html += "</tr></table>";
 
    $("#detalleco").html(html);
    
    $("#ingreso_total").val(totalfinal); 
}

function seleccionar(opcion) {
    
        if (opcion==1){             
        var proveedor=document.getElementById('proveedor_id').value;
        var ingreso_id = document.getElementById('ingreso_id').value;
           
            cambiarproveedores(ingreso_id,proveedor);
        }
}

function cambiarproveedores(ingreso_id,proveedor_id) {
     
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/cambiarproveedor/';
    var limite = 500;
    
               
    $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id,proveedor_id:proveedor_id},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
                var p = 0;
               
               html = "";   

                    nom = registros[p]['proveedor_nombre'];
                     $("#proveedor_nombre").val(nom);
                      prov = registros[p]['proveedor_nombre'];
                     $("#proveedor_id").val(prov);
                    cod = registros[p]['proveedor_codigo'];
                     $("#proveedor_codigo").val(cod);
                    con = registros[p]['proveedor_contacto'];
                     $("#proveedor_contacto").val(con);
                    dir = registros[p]['proveedor_direccion'];
                     $("#proveedor_direccion").val(dir);
                    tel = registros[p]['proveedor_telefono'];
                     $("#proveedor_telefono").val(tel);
                    tel2 = registros[p]['proveedor_telefono2'];
                     $("#proveedor_telefono2").val(tel2);
                    nom = registros[p]['proveedor_email'];
                     $("#proveedor_email").val(nom);
                    nit = registros[p]['proveedor_nit'];
                     $("#proveedor_nit").val(nit);
                    pro = registros[p]['proveedor_razon'];
                     $("#proveedor_razon").val(pro);
                    aut = registros[p]['proveedor_autorizacion'];
                     $("#proveedor_autorizacion").val(aut);
                                 
                        }
             },
            error:function(respuesta){
           html = "";
           $("#proveedor_nombre").html(html);
          
} 
            });   

 

}

function cambiarpedidos(ingreso_id,pedido_id) {
     
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/cambiarpedido/';
    var limite = 500;
    
             
    $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id,pedido_id:pedido_id},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
                var p = 0;
               
               html = "";   

                    html = registros[p]['unidad_nombre'];
                    $("#unidadpedido").html(html);
                    html = registros[p]['programa_nombre'];
                    $("#programapedido").html(html);
            
                        }
             },
            error:function(respuesta){
           html = "";
           $("#unidadpedido").html(html);
          
} 
            });   

 
}

function finalizaringreso(ingreso_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/finalizaringreso/'+ingreso_id;   
    var pedidosigue = document.getElementById('pedidosigue').value;
    var programa_id = document.getElementById('programa_id').value;
    var proveedor_id = document.getElementById('proveedor_id2').value;
    var ingreso_numdoc = document.getElementById('ingreso_numdoc').value;
    var ingreso_fecha_ing = document.getElementById('ingreso_fecha_ing').value;
    var ingreso_total = document.getElementById('ingreso_total').value;
    var factura_importe = document.getElementById('factura_importe').value;
    var proveedor_nombre = document.getElementById('proveedor_nombre').value;
    var proveedor_codigo = document.getElementById('proveedor_codigo').value;
    var proveedor_contacto = document.getElementById('proveedor_contacto').value;
    var proveedor_telefono = document.getElementById('proveedor_telefono').value;
    var proveedor_telefono2 = document.getElementById('proveedor_telefono2').value;
    var proveedor_direccion = document.getElementById('proveedor_direccion').value;
    var proveedor_email = document.getElementById('proveedor_email').value;
    var proveedor_nit = document.getElementById('proveedor_nit').value;
    var proveedor_razon = document.getElementById('proveedor_razon').value;
    var proveedor_autorizacion = document.getElementById('proveedor_autorizacion').value;
    var factura_numero = document.getElementById('factura_numero').value;
    var factura_fecha = document.getElementById('factura_fecha').value;
    var factura_poliza = document.getElementById('factura_poliza').value;
    var factura_ice = document.getElementById('factura_ice').value;
    var factura_exento = document.getElementById('factura_exento').value;
    var factura_neto = document.getElementById('factura_neto').value;
    var factura_creditofiscal = document.getElementById('factura_creditofiscal').value;
    var factura_codigocontrol = document.getElementById('factura_codigocontrol').value;
    var factura_total = document.getElementById('totalfacturas').value;
    var responsable_id = document.getElementById('responsable_id').value;
    var decimales = document.getElementById('decimales').value;
        
   if(ingreso_numdoc === ''){
 alert("El campo No. Ingreso esta vacío");
document.getElementById("ingreso_numdoc").focus();
document.getElementById('botox').disabled=false;

}
else if(programa_id === ''){
 alert("Debe seleccionar un programa");
document.getElementById("programa_id").focus();
document.getElementById('botox').disabled=false;

}
else if(responsable_id === ''){
 alert("Debe seleecionar a favor de quien sera el pago");
document.getElementById("responsable_id").focus();
document.getElementById('botox').disabled=false;

  }
else if(Number(ingreso_total).toFixed(decimales) !== Number(factura_total).toFixed(decimales)){
 alert("Los totales no coinciden");
 document.getElementById('botox').disabled=false;

 }else{

     $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id,proveedor_id:proveedor_id,ingreso_numdoc:ingreso_numdoc,
            ingreso_fecha_ing:ingreso_fecha_ing,ingreso_total:ingreso_total,factura_importe:factura_importe,proveedor_nombre:proveedor_nombre,
            proveedor_codigo:proveedor_codigo,proveedor_contacto:proveedor_contacto,proveedor_telefono:proveedor_telefono,
            proveedor_telefono2:proveedor_telefono2,proveedor_direccion:proveedor_direccion,proveedor_email:proveedor_email,
            proveedor_nit:proveedor_nit,proveedor_razon:proveedor_razon,proveedor_autorizacion:proveedor_autorizacion,
            factura_fecha:factura_fecha,factura_poliza:factura_poliza,factura_ice:factura_ice,factura_exento:factura_exento,factura_numero:factura_numero,
            factura_neto:factura_neto,factura_creditofiscal:factura_creditofiscal,factura_codigocontrol:factura_codigocontrol,responsable_id:responsable_id,programa_id:programa_id},
           success:function(respuesta){ 
             //seria anular toda la variables y el if dejasolo location y window
             var existe = JSON.parse(respuesta);
           if (existe=="existe") {
              alert("No puede ingresar este numero ya existe");
              document.getElementById('botox').disabled=false;
          document.getElementById("ingreso_numdoc").focus();
        } else{
           location.href = base_url+'ingreso/index/';
             window.open(base_url+'ingreso/pdf/'+ingreso_id,'_blank');
             } },
            
            });  
           
}
}

function actualizarzaringreso(ingreso_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/actualizarzaringreso/'+ingreso_id;
    var pedidosigue = document.getElementById('pedidosigue').value;
    var programa_id = document.getElementById('programa_id').value;
    var proveedor_id = document.getElementById('proveedor_id2').value;
    var ingreso_numdoc = document.getElementById('ingreso_numdoc').value;
    var ingreso_fecha_ing = document.getElementById('ingreso_fecha_ing').value;
    var ingreso_total = document.getElementById('ingreso_total').value;
    var factura_importe = document.getElementById('factura_importe').value;
    var proveedor_nombre = document.getElementById('proveedor_nombre').value;
    var proveedor_codigo = document.getElementById('proveedor_codigo').value;
    var proveedor_contacto = document.getElementById('proveedor_contacto').value;
    var proveedor_telefono = document.getElementById('proveedor_telefono').value;
    var proveedor_telefono2 = document.getElementById('proveedor_telefono2').value;
    var proveedor_direccion = document.getElementById('proveedor_direccion').value;
    var proveedor_email = document.getElementById('proveedor_email').value;
    var proveedor_nit = document.getElementById('proveedor_nit').value;
    var proveedor_razon = document.getElementById('proveedor_razon').value;
    var proveedor_autorizacion = document.getElementById('proveedor_autorizacion').value;
    var factura_numero = document.getElementById('factura_numero').value;
    var factura_fecha = document.getElementById('factura_fecha').value;
    var factura_poliza = document.getElementById('factura_poliza').value;
    var factura_ice = document.getElementById('factura_ice').value;
    var factura_exento = document.getElementById('factura_exento').value;
    var factura_neto = document.getElementById('factura_neto').value;
    var factura_creditofiscal = document.getElementById('factura_creditofiscal').value;
    var factura_codigocontrol = document.getElementById('factura_codigocontrol').value;
    var factura_total = document.getElementById('totalfacturas').value;
    var responsable_id = document.getElementById('responsable_id').value;
    var decimales = document.getElementById('decimales').value;
    
    if(ingreso_numdoc === ''){
        alert("El campo No. Ingreso esta vacío");
       document.getElementById("ingreso_numdoc").focus();
       document.getElementById('botox').disabled=false;

    }else if(programa_id === ''){
        alert("Debe seleccionar un programa");
       document.getElementById("programa_id").focus();
       document.getElementById('botox').disabled=false;

    }else if(responsable_id === ''){
        alert("Debe seleecionar a favor de quien sera el pago");
       document.getElementById("responsable_id").focus();
       document.getElementById('botox').disabled=false;

    }else if(Number(ingreso_total).toFixed(decimales) !== Number(factura_total).toFixed(decimales)){
        alert("Los totales no coinciden");
        document.getElementById('botox').disabled=false;
    
    }else{


     $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id,proveedor_id:proveedor_id,ingreso_numdoc:ingreso_numdoc,
            ingreso_fecha_ing:ingreso_fecha_ing,ingreso_total:ingreso_total,factura_importe:factura_importe,proveedor_nombre:proveedor_nombre,
            proveedor_codigo:proveedor_codigo,proveedor_contacto:proveedor_contacto,proveedor_telefono:proveedor_telefono,
            proveedor_telefono2:proveedor_telefono2,proveedor_direccion:proveedor_direccion,proveedor_email:proveedor_email,
            proveedor_nit:proveedor_nit,proveedor_razon:proveedor_razon,proveedor_autorizacion:proveedor_autorizacion,
            factura_fecha:factura_fecha,factura_poliza:factura_poliza,factura_ice:factura_ice,factura_exento:factura_exento,factura_numero:factura_numero,
            factura_neto:factura_neto,factura_creditofiscal:factura_creditofiscal,factura_codigocontrol:factura_codigocontrol,responsable_id:responsable_id,programa_id:programa_id},
           success:function(respuesta){
           var existe = JSON.parse(respuesta);
           if (existe=="existe") {
              alert("No puede ingresar este numero ya existe");
              document.getElementById('botox').disabled=false;
          document.getElementById("ingreso_numdoc").focus();
        } else{
            location.href = base_url+'ingreso/index/';
             window.open(base_url+'ingreso/pdf/'+ingreso_id,'_blank');
            } },
            
            });  
           
    }
}
   
function tabladepedido(){
    var ingreso_id = document.getElementById('ingreso_id').value;
    var unidad_id =  document.getElementById('unidad_id').value;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/pedidosunidad/';
    var limite = 500;
    
             
    $.ajax({url: controlador,
           type:"POST",
           data:{unidad_id:unidad_id},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
            
                  html = "";   
                    for (var i = 0; i < n ; i++){
                 

                
                   html += "<tr>";                                                           
                   html += "<td>"+registros[i]["pedido_numero"]+"</td>"; 
                   html += "<td> <b>"+registros[i]["unidad_nombre"]+"</b></td>";                                       
                   html += "<td> <b>"+registros[i]["programa_nombre"]+"</b></td>";                                       
                   html += "<td><button  class='btn btn-success btn-xs' onclick='ingresoapedido("+ingreso_id+","+registros[i]["pedido_id"]+"), pedidotu(1)' data-dismiss='modal'><i class='fa fa-check'></i> Añadir </button> </td>";                                       
                   html += "</tr>";   
                        }
                         $("#tabladepedido").html(html);
                      }
             },
            error:function(respuesta){
           html = "";
           $("#tabladepedido").html(html);
          
} 
            });   

}

function ingresoapedido(ingreso_id,pedido_id) {
     
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/ingresoapedido/';
    var limite = 500;
    
             
    $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id,pedido_id:pedido_id},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
  
               
               html = "";   
                  for (var i = 0; i < n ; i++){

                    html += "<tr>";
                    html += "<td>"+registros[i]["pedido_numero"]+"</td>";
                    html += "<td>"+registros[i]["unidad_nombre"]+"</td>";
                    html += "<td>"+registros[i]["programa_nombre"]+"</td>";
                    html += "<td><a class='btn btn-danger btn-xs' onclick='quitarprograma("+registros[i]["pedido_id"]+")'><span class='fa fa-trash'></span></a></td>";
                    html += "</tr>";
                   }
                    $("#pedidosdeingreso").html(html);
            
                        }
             },
            error:function(respuesta){
           html = "";
           $("#pedidosdeingreso").html(html);
          
} 
            });   

 
}

function crearfactura(ingreso_id) {
     
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/crearfactura/';
    var limite = 500;
    var proveedor_id = document.getElementById('proveedor_id2').value;
    var ingreso_numdoc = document.getElementById('ingreso_numdoc').value;
    var ingreso_fecha_ing = document.getElementById('ingreso_fecha_ing').value;
    var factura_importe = document.getElementById('factura_importe').value;
    var proveedor_nombre = document.getElementById('proveedor_nombre').value;
    var proveedor_codigo = document.getElementById('proveedor_codigo').value;
    var proveedor_contacto = document.getElementById('proveedor_contacto').value;
    var proveedor_telefono = document.getElementById('proveedor_telefono').value;
    var proveedor_telefono2 = document.getElementById('proveedor_telefono2').value;
    var proveedor_direccion = document.getElementById('proveedor_direccion').value;
    var proveedor_email = document.getElementById('proveedor_email').value;
    var proveedor_nit = document.getElementById('proveedor_nit').value;
    var proveedor_razon = document.getElementById('proveedor_razon').value;
    var proveedor_autorizacion = document.getElementById('proveedor_autorizacion').value;
    var factura_numero = document.getElementById('factura_numero').value;
    var factura_fecha = document.getElementById('factura_fecha').value;
    var factura_poliza = document.getElementById('factura_poliza').value;
    var factura_ice = document.getElementById('factura_ice').value;
    var factura_exento = document.getElementById('factura_exento').value;
    var factura_neto = document.getElementById('factura_neto').value;
    var factura_creditofiscal = document.getElementById('factura_creditofiscal').value;
    var factura_codigocontrol = document.getElementById('factura_codigocontrol').value;
    var nuevopro  = document.getElementById('nuevopro').checked; 
    var nuevop = 0;
    if (nuevopro==true) {
      nuevop = 1;
    } else {
      nuevop = 0;
    }
        
    $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id,proveedor_id:proveedor_id,ingreso_numdoc:ingreso_numdoc,
            ingreso_fecha_ing:ingreso_fecha_ing,factura_importe:factura_importe,proveedor_nombre:proveedor_nombre,
            proveedor_codigo:proveedor_codigo,proveedor_contacto:proveedor_contacto,proveedor_telefono:proveedor_telefono,
            proveedor_telefono2:proveedor_telefono2,proveedor_direccion:proveedor_direccion,proveedor_email:proveedor_email,
            proveedor_nit:proveedor_nit,proveedor_razon:proveedor_razon,proveedor_autorizacion:proveedor_autorizacion,
            factura_fecha:factura_fecha,factura_poliza:factura_poliza,factura_ice:factura_ice,factura_exento:factura_exento,factura_numero:factura_numero,
            factura_neto:factura_neto,factura_creditofiscal:factura_creditofiscal,factura_codigocontrol:factura_codigocontrol,nuevop:nuevop},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
  
               
               html = "";   
               html2 = "";  
               html2 +="<select name='facturation' class='form-control' id='facturation'>";
               html2 +="<option value='0'>- FACTURA -</option>"; 
               suma = Number(0); 
                  for (var i = 0; i < n ; i++){
                    suma += Number(registros[i]["factura_importe"]);
                    html += "<tr>";
                    html += "<td>"+registros[i]["factura_numero"]+"</td>";
                    html += "<td>"+registros[i]["factura_nit"]+"</td>";
                    html += "<td>"+registros[i]["factura_razon"]+"</td>";
                    html += "<td>"+registros[i]["factura_importe"]+"</td>";
                    html += "<td><a class='btn btn-danger btn-xs' onclick='quitarfactura("+registros[i]["factura_id"]+")'><span class='fa fa-trash'></span></a></td>";
                    html += "</tr>";
                   

                    
                    html2 +="<option value='"+registros[i]["factura_numero"]+"'>"+registros[i]["factura_numero"]+"</option>";
                    
                   }
                    html += "<tr>";
                    html += "          <td><b>TOTAL:</b></td>";
                    html += "          <td></td>";
                    html += "          <td></td>";
                    html += "          <td>"+suma+"</td>";
                    html += "        </tr>";
                    html2 += "</select>";
                    $("#facturasdeingreso").html(html);
                    $("#misele").html(html2);
                    $("#totalfacturas").val(suma);
                   
                        }
             },
            error:function(respuesta){
           html = "";
           $("#facturasdeingreso").html(html);
          
} 
            });   

 
}

function buscarpedidos(e)
{
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablapedido();
    }
}

function tablapedido(){
    var ingreso_id = document.getElementById('ingreso_id').value;
    var filtro =  document.getElementById('filtrar').value;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/pedidosfiltro/';
    
             
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
            
                  html = "";   
                    for (var i = 0; i < n ; i++){
                 

                
                   html += "<tr>";                                                           
                   html += "<td>"+registros[i]["pedido_numero"]+"</td>"; 
                   html += "<td> <b>"+registros[i]["unidad_nombre"]+"</b></td>";                                       
                   html += "<td> <b>"+registros[i]["programa_nombre"]+"</b></td>";                                       
                   html += "<td><button  class='btn btn-success btn-xs' onclick='ingresoapedido("+ingreso_id+","+registros[i]["pedido_id"]+"), pedidotu(1)' data-dismiss='modal'><i class='fa fa-check'></i> Añadir </button> </td>";                                       
                   html += "</tr>";   
                        }
                         $("#tabladepedido").html(html);
                      }
             },
            error:function(respuesta){
           html = "";
           $("#tabladepedido").html(html);
          
} 
            });   

}

function meteresponsable()
{
   var base_url    = document.getElementById('base_url').value;
   var responsable_nombre    = document.getElementById('responsable_nom').value;
   var controlador = base_url+'ingreso/responsables/';
   if (responsable_nombre==''){
    alert("El nombre es obligatorio, no se registro Responsable");
    document.getElementById("responsable_nom").focus();
   }else{


    $.ajax({url: controlador,
           type:"POST",
           data:{responsable_nombre:responsable_nombre},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);

               if (registros=="existe") {
              alert("Este responsable ya existe, no se registro Responsable");
          document.getElementById("responsable_nom").focus();
        } else{
              
                var n = registros.length;
            
                  html2 = "";  
                  html2 +="<select name='responsable_id' class='form-control' id='responsable_id'>";
                  html2 +="<option value='0'>- RESPONSABLE -</option>"; 
                    for (var i = 0; i < n ; i++){
                 
                       html2 +="<option value='"+registros[i]["responsable_id"]+"'>"+registros[i]["responsable_nombre"]+"</option>";
                        }
                          html2 += "</select>";
                          $("#elsele").html(html2);
                      }
             },
            error:function(respuesta){
           html = "";
           $("#elsele").html(html);
          
} 
            });   

}
}

function articulonew(){

   var base_url    = document.getElementById('base_url').value;
   var controlador = base_url+'articulo/nuevo/';
   //var ingreso_id = document.getElementById('ingreso_id').value;
   var categoria_id = document.getElementById('categoria_id').value;
   var articulo_nombre = document.getElementById('articulo_nombre').value;
   var articulo_marca = document.getElementById('articulo_marca').value;
   var articulo_saldo = document.getElementById('articulo_saldo').value;
   var articulo_precio = document.getElementById('articulo_precio').value;
   var articulo_unidad = document.getElementById('articulo_unidad').value;
    var decimales = document.getElementById('decimales').value;
       
    $.ajax({url: controlador,
           type:"POST",
           data:{categoria_id:categoria_id,articulo_nombre:articulo_nombre,articulo_marca:articulo_marca,
             articulo_precio:articulo_precio,articulo_saldo:articulo_saldo,articulo_unidad:articulo_unidad},
           success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if(registros=="existe"){
                    alert("Este Articulo ya se encuentra registrado, por favor revise sus datos");
                }else if(registros == "falta"){
                    alert("Los campos: Nombre, Categoria y Unidad son obligatorios");
                }else{
                    alert("Articulo Ingresado correctamente");
                    $('#exampleModal').modal('hide');
                    document.getElementById("artiForm").reset();
                }
             },
            error:function(respuesta){
          alert("Llene todos los campos");
          
} 
            });   



}

function dibujar_facturas(ingreso_id,factura_id)
{
   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/get_lasfacturas/';
    
             
    $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id,factura_id:factura_id},
           success:function(respuesta){ 
                var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
  
               
               html = "";   
               html2 = "";  
               html2 +="<select name='facturation' class='form-control' id='facturation'>";
               html2 +="<option value='0'>- FACTURA -</option>"; 
               suma = Number(0); 
                  for (var i = 0; i < n ; i++){
                    suma += Number(registros[i]["factura_importe"]);
                    html += "<tr>";
                    html += "<td>"+registros[i]["factura_numero"]+"</td>";
                    html += "<td>"+registros[i]["factura_nit"]+"</td>";
                    html += "<td>"+registros[i]["factura_razon"]+"</td>";
                    html += "<td>"+registros[i]["factura_importe"]+"</td>";
                    html += "<td><a class='btn btn-danger btn-xs' onclick='quitarfactura("+registros[i]["factura_id"]+")'><span class='fa fa-trash'></span></a></td>";
                    html += "</tr>";
                   

                    
                    html2 +="<option value='"+registros[i]["factura_numero"]+"'>"+registros[i]["factura_numero"]+"</option>";
                    
                   }
                    html += "<tr>";
                    html += "          <td><b>TOTAL:</b></td>";
                    html += "          <td></td>";
                    html += "          <td></td>";
                    html += "          <td>"+suma+"</td>";
                    html += "        </tr>";
                    html2 += "</select>";
                    $("#facturasdeingreso").html(html);
                    $("#misele").html(html2);
                    $("#totalfacturas").val(suma);
                   
                        }
             },
            error:function(respuesta){
           html = "";
           $("#facturasdeingreso").html(html);
          
} 
            });   

}