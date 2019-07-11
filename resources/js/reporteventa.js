function ventaproducto(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
                  
            tablareproducto();            
      
        
    } 

    
}

function ventacliente(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
                  
            tablarecliente();            
      
        
    } 

    
}

function tablareproducto()
{   
	var base_url = document.getElementById('base_url').value;
   
    var controlador = base_url+'compra/buscarcompra';
    var parametro = document.getElementById('vender').value    
    
    
   
    

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
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    
                    for (var i = 0; i < n ; i++){
                       
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

                        html += "<button type='button' onclick='repoproducto("+registros[i]["producto_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-search'></i></button>";
                        
                        
                        
                        html += "</div>";
                        html += "</div>";
                      
                        html += "</td>";
                      
                       
                        html += "</tr>";

                   }
                       html += "</tbody>"
                   
                   $("#tablareproducto").html(html);
                    document.getElementById('tablas').style.display = 'block';
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
        
    });    

}

function tablarecliente()
{   
	var base_url = document.getElementById('base_url').value;
   
    var controlador = base_url+'detalle_venta/buscarcliente';
    var parametro = document.getElementById('cliente_id').value    
    
    
   
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                            
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                 
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>N</th>";
                    html += "<th>ID</th>";
                    html += "<th>Producto</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablarecliente'>";
                    
                    for (var i = 0; i < n ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        
                        html += "<div clas='row'>";                                            
                        
                        html += "<b>"+registros[i]["cliente_id"]+"</b>";
                        html += "<input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["cliente_id"]+"'>";
                        html += "</td>";
                        html += "</div>";   
                        html += "<div class='col-md-12'>";
                        html += "<td>";
                        html += "<b>"+registros[i]["cliente_nombre"]+"</b>";
                        
                        html += "<td>";

                        html += "<button type='button' onclick='repocliente("+registros[i]["cliente_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-search'></i></button>";
                        
                        
                        
                        html += "</div>";
                        html += "</div>";
                      
                        html += "</td>";
                      
                       
                        html += "</tr>";

                   }
                       html += "</tbody>"
                   
                   $("#tablarecliente").html(html);
                   document.getElementById('tablas').style.display = 'block';
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablarecliente").html(html);
        }
        
    });    

}  

function reportes()
{  
var base_url    = document.getElementById('base_url').value;
var controlador = base_url+"detalle_venta/buscarrepo";
var desde    = document.getElementById('fecha_desde').value;
var hasta    = document.getElementById('fecha_hasta').value;
var cliente    = document.getElementById('cliente').value;
var tipo    = document.getElementById('tipo_transaccion').value;
var producto    = document.getElementById('producto').value;
document.getElementById('loader').style.display = 'block';
if (cliente=="") {
	elcliente = "";
} else {
	elcliente = "and cliente_id="+cliente+" "; 
}
if (producto=="") {
	elproducto = "";
} else {
	elproducto = "and producto_id="+producto+" "; 
}
if (tipo==0) {
  eltipo = "";
}else{
  eltipo = " and tipotrans_id = "+tipo+" ";
} 
	var filtro = " date(venta_fecha) >= '"+desde+"'  and  date(venta_fecha) <='"+hasta+"' "+eltipo+" "+elcliente+" "+elproducto+" ";


     
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(report){     
              
                            
                $("#enco").val("- 0 -");
               var registros =  JSON.parse(report);
           
               if (registros != null){
                   
                    
                    var cantidades = Number(0);
                    var total = Number(0);
                    var cuotas = Number(0);
                    var costos = Number(0);
                    var utilidades = Number(0);
                    var descuentos = Number(0);
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   
                    html = "";
                 
                    for (var i = 0; i < n ; i++){
                        
                         total += Number(registros[i]["detalleven_total"]);
                         cantidades += Number(registros[i]["detalleven_cantidad"]);
                         cuotas += Number(registros[i]["credito_cuotainicial"]);
                         descuentos += Number(registros[i]["detalleven_descuento"]);
                         costos += Number(registros[i]["producto_costo"]);
                         var utilidad = Number((registros[i]["producto_precio"]-registros[i]["producto_costo"])*registros[i]["detalleven_cantidad"]);
                         utilidades += Number(utilidad);
                        
                        html += "<tr>";
                      
                        html += "<td align='center' style='width:5px;'>"+(i+1)+"</td>";
                        
                        
                        html += "<td> "+registros[i]["producto_nombre"]+" </td>";                                            
                        html += "<td align='center' style='width:110px;'> "+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["venta_hora"]+" </td>";
                        html += "<td align='center'> "+registros[i]["venta_id"]+" </td>";  
                        html += "<td align='center'> "+Number(registros[i]["factura_id"])+" </td>";  // NUMERO FACTURA
                        html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";  
                        html += "<td align='right'>"+Number(registros[i]["credito_cuotainicial"]).toFixed(2)+"</td>" ;// CUOTA INICIAL
                        html += "<td align='center'> "+registros[i]["producto_unidad"]+" </td>";                                          
                        html += "<td align='center'> "+registros[i]["detalleven_cantidad"]+" </td>"; 
                        html += "<td align='right'> "+Number(registros[i]["producto_precio"]).toFixed(2)+" </td>"; 
                        html += "<td align='right'> "+Number(registros[i]["detalleven_descuento"]).toFixed(2)+" </td>";
                        
                        html += "<td align='right'><b>"+Number(registros[i]["detalleven_total"]).toFixed(2)+"</b></td>";
                        html += "<td align='right'> "+Number(registros[i]["producto_costo"]).toFixed(2)+" </td>";
                        html += "<td align='right'> "+Number(utilidad).toFixed(2)+" </td>"; 
                         
                        
                        
                        html += "<td  align='center'>"+registros[i]["cliente_nombre"]+"</td>"; 
                        html += "<td  align='center'>"+registros[i]["usuario_nombre"]+"</td>"; 
                        html += "<td class='no-print'><a href='"+base_url+"venta/modificar_venta/"+registros[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modifica el detalle/cliente de la venta'><span class='fa fa-edit'></span></a> <a href='"+base_url+"factura/imprimir_recibo/"+registros[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-print'></span></a> </td>";
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<th style='text-align:right'>"+Number(cuotas).toFixed(2)+"</th>";
                        html += "<td></td>";
                        html += "<th>"+cantidades+"</td>";
                        html += "<td></td>";
                        html += "<th style='text-align:right'>"+Number(descuentos).toFixed(2)+"</th>";
                        html += "<th style='text-align:right'>"+Number(total).toFixed(2)+"</th>";
                        html += "<th style='text-align:right'>"+Number(costos).toFixed(2)+"</th>";
                        html += "<th style='text-align:right'>"+Number(utilidades).toFixed(2)+"</th>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   desde1 = "<b>Desde: "+moment(desde).format('DD/MM/YYYY')+"</b>";
                   hasta1 = "<b>Hasta: "+moment(hasta).format('DD/MM/YYYY')+"</b>";
                   $("#reportefechadeventa").html(html);
                   $("#desde").html(desde1);
                   $("#hasta").html(hasta1);
                   document.getElementById('loader').style.display = 'none';
            }
                
        },
        error:function(result){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#reportefechadeventa").html(html);
        }
        
    });   

} 

function repocliente(cliente)
{
	$("#cliente").val(cliente);
	var base_url    = document.getElementById('base_url').value;
	var controlador = base_url+"detalle_venta/nomcliente/"+cliente;

	 $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(report){  
            var registros =  JSON.parse(report);
            html = "";
            html += "<font size='2'><b>Cliente: "+registros["cliente_nombre"]+"</b></font>";  
	$("#labusqueda").html(html);
	$("#producto").val('');
	document.getElementById('tablas').style.display = 'none';
}
});
}

function repoproducto(producto)
{
	$("#producto").val(producto);
	var base_url    = document.getElementById('base_url').value;
	var controlador = base_url+"detalle_venta/nomproducto/"+producto;

	 $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(report){  
            var registros =  JSON.parse(report);
            html = "";
            html += "<font size='2'><b>Producto: "+registros["producto_nombre"]+"</b></font>";  
	$("#labusqueda").html(html);
	$("#cliente").val('');
	document.getElementById('tablas').style.display = 'none';
	}
});
}