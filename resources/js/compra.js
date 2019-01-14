




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
                    var n = registros.length; //tama√±o del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        var bandera = 1;
                        var suma = Number(registros[i]["compra_totalfinal"]);
                        var total = Number(suma+total);
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["proveedor_nombre"]+"</b></font> <br>";
                        
                        html += "<span class='btn-info btn-xs'>"+registros[i]["tipotrans_nombre"]+"</span></td>";                                            
                        html += "<td align='right' > Subtotal:"+Number(registros[i]["compra_subtotal"]).toFixed(2)+"<br>Desc: "+Number(registros[i]["compra_descuento"]).toFixed(2)+"<br> DescGlobal: "+Number(registros[i]["compra_descglobal"]).toFixed(2)+"<br>";
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
                   
                   $("#compraproveedor").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#compraproveedor").html(html);
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
                    var n = registros.length; //tama√±o del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["compra_totalfinal"]);
                        var total = Number(suma+total);
                        var bandera = 1;
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["proveedor_nombre"]+"</b></font> <br>";
                        
                        html += "<span class='btn-info btn-xs'>"+registros[i]["tipotrans_nombre"]+"</span></td>";                                            
                        html += "<td align='right' > Subtotal:"+Number(registros[i]["compra_subtotal"]).toFixed(2)+"<br>Desc: "+Number(registros[i]["compra_descuento"]).toFixed(2)+"<br> DescGlobal: "+Number(registros[i]["compra_descglobal"]).toFixed(2)+"<br>";
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
                    var n = registros.length; //tamaè´–o del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<form action='"+base_url+"compra/ingresarproducto/'  method='POST' class='form'>";
                        html += "<div clas='row'>";                                            
                        html += "<div class='container' hidden>";
                        html += "<input id='compra_id'  name='compra_id' type='text' class='form-control' value='"+compra_id+"'>";
                        html += "<input id='producto_id'  name='producto_id' type='text' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "<input id='descripcion'  name='descripcion' type='text' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";
                        html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+registros[i]["producto_costo"]+"'>";
                        html += "</div>";
                            
                        html += "<div class='col-md-12'>";

                        html += "<b>"+registros[i]["producto_nombre"]+"</b><br>";
                        html += "<div class='col-md-2'  >";
                        html += "Precio_V: <input class='input-sm' id='producto_precio'  style='background-color: lightgrey' name='producto_precio' type='number' step='0.01' class='form-control' value='"+registros[i]["producto_precio"]+"' ></div>";
                        html += "<div class='col-md-2'  >";
                        html += "Costo: <input class='input-sm' id='producto_costo'  style='background-color: lightgrey' name='producto_costo' type='number' step='0.01' class='form-control' value='"+registros[i]["producto_costo"]+"' > </div>";
                        html += "<div class='col-md-2'  >";
                        html += "Desc.: <input class='input-sm' id='descuento'  style='background-color: lightgrey' name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";
                        html += "<div class='col-md-2'  >";
                        html += "Cant.: <input class='input-sm ' id='cantidad' name='cantidad' type='number' class='form-control' placeholder='cantidad' required value='1'> </div>";
                        html += "<input class='input-sm ' id='bandera' name='bandera' type='hidden' class='form-control'  required value='"+bandera+"'>"
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
                    var n = registros.length; //tamaè´–o del arreglo de la consulta
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