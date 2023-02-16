datos = "";
$(document).on("ready",inicio);
function inicio(){
       //alert('holaaaa');
        //tabla_pedido_abierto();
        //tabla_pedidos(); 
        buscar_pedidos();
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function tabla_pedidos(filtro)
{
    var base_url        = document.getElementById('base_url').value;
    var esrol           = document.getElementById('esrol').value;
    var esrolconsolidar = document.getElementById('esrolconsolidar').value;
    let pedido_titulo   = document.getElementById('pedido_titulo').value;
    var controlador = base_url+"pedido/mostrar_pedidos";
    $("#respedido").val("");
    //var forma_pago =  document.getElementById('forma_pago').value;
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url:controlador,
        type:"POST",
        data:{filtro:filtro},
        success: function(response){
            //var usuarios = JSON.parse(document.getElementById('usuarios').value);
            var cont =  0;
            var cantidad_pedidos = 0;
            var total_pedido = 0;
            var p = JSON.parse(response);
            const myString = JSON.stringify(p);
            $("#respedido").val(myString);
            var tipo = JSON.parse(document.getElementById('tipo_transaccion').value);
//            var tipo_venta = JSON.parse(document.getElementById('tipo_venta').value);
            var espresentacion="";
            var padding = "3px";
            var fecha_pedido = "";
            var hora_p;edido = "";
            set_mapa(p);
            var labelboton = "";
            if(pedido_titulo == "Pedidos"){
                labelboton = "Pedido";
            }else if(pedido_titulo == "Preventas"){
                labelboton = "Preventa";
            }else{
                labelboton = "Reserva";
            }
            
                html = "";

            total_pedido = 0;   
            
            opciones = "";           
            
            for(var i = 0; i<tipo.length; i++){
                opciones += "<option value='"+tipo[i].tipotrans_id+"'>"+tipo[i].tipotrans_nombre+"</option>";
            }
            
            var nombreusuario = "";
            for(var i = 0; i<p.length; i++){
                

                tipotrans = p[i]["tipotrans_nombre"];
                nombreusuario = p[i]["usuario_nombre"];
                
                if (nombreusuario.length>12){
                    nombreusuario = nombreusuario.substr(0,10)+'..';
                }
                cont += 1;//    html += "             $cont = $cont+1;  ";
                total_pedido += parseFloat(p[i]["pedido_total"]); // html += "             $total_pedido+=$p['pedido_total']; ";
                
                html += "<tr> ";
                html += "    <td>"+cont+"</td> ";

                html += "    <td  bgcolor='"+p[i]["estado_color"]+"' style='line-height: 9px; padding:0; padding:"+padding+";'><font size='3'><b>"+p[i]["cliente_nombre"]+"</b></font> <sub>["+p[i]["cliente_id"]+"]</sub> ";
                
//                if (isNaN(p[i]["cliente_latitud"]) || isNaN(["cliente_longitud"])){  
                

                if ((p[i]["cliente_latitud"]==0 && p[i]["cliente_longitud"]==0) || (p[i]["cliente_latitud"]==null && p[i]["cliente_longitud"]==null) || (p[i]["cliente_latitud"]== "" && p[i]["cliente_longitud"]=="")){ 
                    imagen = "noubicacion.png";
                    html += " <a href='#' title='CLIENTE SIN UBICACIÓN REGISTRADA'><img src='"+base_url+"resources/images/"+imagen+"' width='25' height='25'></a>";
                }
                else{
                    imagen = "blue.png";
                    html += " <a href='https://www.google.com/maps/dir/"+p[i]['cliente_latitud']+","+p[i]['cliente_longitud']+"' target='_blank' title='lat:"+p[i]['cliente_latitud']+",long:"+p[i]['cliente_longitud']+"'><img src='"+base_url+"resources/images/"+imagen+"' width='25' height='25'></a>";
                
                }
                    
                    
                    
                
                html += "<br>";
                html += "    "+p[i]["cliente_nombrenegocio"];
                html += "<br>  ";
                
                fecha_pedido = p[i]["pedido_fecha"];
                fecha_pedido = fecha_pedido.substr(0,10);
                
                hora_pedido = p[i]["pedido_fecha"];
                hora_pedido = hora_pedido.substr(11,8);
                
                html += "    "+ formato_fecha(fecha_pedido)+" - "+hora_pedido+"";
                if(p[i]["ingreso_monto"] >0){
                    html += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Reserva: </b>"+p[i]["ingreso_monto"]+" "+p[i]["ingreso_moneda"];
                }
                
                html += "     ";
                html += "    </td> ";
                
                html += "    <td align='center' bgcolor='"+p[i]["estado_color"]+"'  style='line-height: 10px; padding:"+padding+";'> ";
//                html += "        <a href='"+base_url+'pedido/pedidoabierto/'+p[i]["pedido_id"]+"'> ";
                html += "        <font size='3' color='white'><b>"+'00'+p[i]["pedido_id"]+"</b></font> <br> ";
                html += "        <font size='1' color='white'>"+p[i]["estado_descripcion"]+"</font> ";
                html += "        "+'<br><b>'+tipotrans+" </b> ";                
                html += "         ";
//                html += "        </a> ";
                html += "    </td> ";


                html += "    <td align='right' bgcolor='"+p[i]["estado_color"]+"' style='line-height: 10px; padding:"+padding+";'> ";
                html += "        "+'Sub Total: '+parseFloat(p[i]["pedido_subtotal"]).toFixed(2)+"<br>  ";
                html += "        "+'Desc.: '+parseFloat(p[i]["pedido_descuento"]).toFixed(2)+"<br>   ";
                html += "        <font size='3'><b>"+parseFloat(p[i]["pedido_total"]).toFixed(2)+"</b></font> ";
                html += "    </td> ";

                html += "    <td bgcolor='"+p[i]["estado_color"]+"' style='line-height: 10px; padding:"+padding+";'> ";
                html += "        <center> ";        
                html += "        <font size='1'> ";        
                html += "        "+formato_fecha(p[i]["pedido_fechaentrega"])+'<br>'+p[i]["pedido_horaentrega"];
                
                html += "        <br> <small>"+nombreusuario+"</small>"
                html += "        </font> ";
                html += "        </center>  ";
                html += "    </td> ";

                html += "    <td  style='line-height: 10px;  padding:"+padding+";'> ";
                   

                    if (p[i]["estado_id"]>=10 && p[i]["estado_id"]<=14){
                        
                        if (p[i]["estado_id"]==13){
                            html += "        <a href='"+base_url+'pedido/imprimir/'+p[i]["pedido_id"]+"' class='btn btn-warning btn-sm' title='Imprimir comprobante de "+labelboton+"'><span class='fa fa-print'></span></a> ";
                        }
                        else{
                        html += "        <a href='"+base_url+'pedido/imprimir/'+p[i]["pedido_id"]+"' target='_blank' class='btn btn-warning btn-sm' title='Imprimir comprobante de "+labelboton+"'><span class='fa fa-print'></span></a> ";
                        if(esrol == 1){
                            html += "        <a href='"+base_url+'pedido/modificarpedido/'+p[i]["pedido_id"]+"' class='btn btn-success btn-sm' title='Modificar datos de "+labelboton+"'><span class='fa fa-cubes'></span></a> ";
                            html += "<a onclick='modificar_lahora("+p[i]['pedido_id']+", "+JSON.stringify(p[i]['pedido_fecha'])+")' class='btn btn-facebook btn-sm' title='Modificar fecha de pedido'>";
                            html += "<fa class='fa fa-calendar'></fa>";
                            html += "</a>";
                        }
                 // ****************************** anular pedido ***************************************
                        html += "      <button type='button' class='btn btn-danger btn-sm'  title='Anular "+labelboton+"' data-toggle='modal' data-target='#modalanular"+p[i]["pedido_id"]+"'> ";
                        html += "           <span class='fa fa-trash'></span> ";
                        html += "      </button>  ";
  
                
                      //  htmt += "<!----------------------------------------  Modal -------------------------------------------------> ";
                
                        html += "<div class='modal fade' id='modalanular"+p[i]["pedido_id"]+"' tabindex='-1' role='dialog' aria-labelledby='modalanular' aria-hidden='true'> ";
                        html += "  <div class='modal-dialog' role='document'> ";
                        html += "    <div class='modal-content'> ";

                        html += "      <div class='modal-header' style='background-color: #CDCDCD'> ";
                        html += "          <center> ";

                        html += "          <h3 class='modal-title' id='exampleModalLabel'><b><span class='fa fa-money'></span>  Anular pedido <span class='fa fa-save'></span></b></h3> ";
                        html += "        <button type='button' class='close' data-dismiss='modal' aria-label='Close'> ";
                        html += "          <span aria-hidden='true'>&times;</span> ";
                        html += "        </button>  ";

                        html += "          </center> ";
                        html += "      </div> ";

                        html += "      <div class='modal-body'> ";
                        html += "          <center> ";
                        html += "              <font size='3'><b>El pedido seleccionado será anulado..!!</b></font><br>   ";
                        html += "              <font size='3'>¿Desea continuar?</font><br>   ";

                        html += "          </center> ";
                        html += "      </div> ";
                        html += "      <div class='modal-footer'> ";
                        html += "        <button type='button' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar</button> ";
                        html += "        <button  class='btn btn-primary' data-dismiss='modal'  onclick='anular_pedido("+p[i]["pedido_id"]+")'><span class='fa fa-money'></span> Anular</button> ";
                        html += "      </div> ";
                        html += "    </div> ";
                        html += "  </div> ";
                        html += "</div> ";
                        
                // ****************************** fin anular pedido ***************************************
                 // ****************************** consolidar pedido a ventas ***************************************
                        if(esrolconsolidar == 1){
                        html += "   <button type='button' class='btn btn-facebook btn-sm' data-toggle='modal'  title='Consolidar "+labelboton+" a ventas' data-target='#modalconsolidar"+p[i]["pedido_id"]+"'> ";
                        html += "           <span class='fa fa-cart-plus'></span>  ";
                        html += "      </button>  ";
                        }
                
                      //  htmt += "<!----------------------------------------  Modal -------------------------------------------------> ";
                
                        html += "<div class='modal fade' id='modalconsolidar"+p[i]["pedido_id"]+"' tabindex='-1' role='dialog' aria-labelledby='modalconsolidar' aria-hidden='true'> ";
                        html += "  <div class='modal-dialog' role='document'> ";
                        html += "    <div class='modal-content'> ";

                        html += "      <div class='modal-header' style='background-color: #CDCDCD'> ";
                        html += "          <center> ";

                        html += "          <h3 class='modal-title' id='exampleModalLabel'><b><span class='fa fa-cart-plus'></span>  Enviar pedido a ventas<span class='fa fa-cart-plus'></span></b></h3> ";
                        html += "        <button type='button' class='close' data-dismiss='modal' aria-label='Close'> ";
                        html += "          <span aria-hidden='true'>&times;</span> ";
                        html += "        </button>  ";

                        html += "          </center> ";
                        html += "      </div> ";

                        html += "      <div class='modal-body'> ";
                        html += "          <center> ";
                        html += "              <font size='2'><b>Se enviara este pedido como operación de venta</b></font><br>   ";
                        
                        html += "              <br>   ";
                        
                        html += "              <select id='tipo_venta"+p[i]["pedido_id"]+"' class='btn btn-default'>   ";
                        html += opciones;
                        html += "              </select>   ";
                        html += "              <br>   ";
                        html += "              <br>   ";
                        
                        html += "              <font size='3'><b>¿Desea continuar?</b></font><br>   ";

                        html += "          </center> ";
                        html += "      </div> ";
                        html += "      <div class='modal-footer' style='text-align: center'> ";
                        
                        html += "        <button type='button' class='btn btn-success' onclick='consolidar_pedido("+p[i]["pedido_id"]+","+p[i]["pedido_total"]+")' data-dismiss='modal'><span class='fa fa-cart-plus'></span> Vender</button> ";
                        html += "        <button type='button' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar</button> ";
                        
                        html += "      </div> ";
                        html += "    </div> ";
                        html += "  </div> ";
                        html += "</div> ";
    
                    //    htmt += "<!---------------------------------------- Fin Modal -------------------------------------------------> ";
                 // ****************************** fin consolidar pedido a ventas ***************************************
                        }               
                    }
                        
                html += "    </td> ";
                
                html += "</tr> ";

                }
                html += "<tr> ";
                html += "    <th style='padding: 0;'> </th> ";
                html += "    <th style='padding: 0;'> </th> ";

                html += "         ";
                html += "    <th style='padding: 0; line-height: 13px;'> ";
                html += "        <center>  ";
                html += "        "+pedido_titulo.toUpperCase()+"<br> ";
                html += "        <font size='3'><b>"+cont+"</b></font> ";
                html += "        </center> ";
                html += "   </th> ";

                html += "   <th style='padding: 0; line-height: 13px;'> ";
                html += "        <center> ";
                html += "            TOTAL Bs<br> ";
                
                html += "        <font size='3'><b>"+total_pedido.toFixed(2)+"</b></font> ";
//                html += "        <font size='3'><b>"+formato_numerico(parseFloat(total_pedido).toFixed(2))+"</b></font> ";
                html += "        </center> ";
                html += "   </th> ";
                html += "     ";
                html += "    <th style='padding: 0;'></th> ";
                html += "    <th style='padding: 0;'> </th> ";
                html += "</tr>      ";
         
              //  console.log(html);
            $("#tabla_pedidos").html(html);
            document.getElementById('loader').style.display = 'none';
        }
    });
 //document.getElementById('loader').style.display = "none";
}


function tabla_pedido_abierto()
{   // alert("entraaa..!!");
    var pedido_id = document.getElementById('pedido_id').value;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/detalle_pedido";
    

    
    $.ajax({url:controlador,
        type:"POST",
        data:{pedido_id: pedido_id},
        success: function(response){
             // alert("aquiiii....");

            var d = JSON.parse(response);
            set_mapa(d);
                html = "";


                html += "<div class='col-md-12'>";
//                html += "<!--------------------- parametro de buscador --------------------->";
//                html += "		  <div class='input-group'> <span class='input-group-addon'>Buscar</span>";
//                html += "               <input id='filtrar' type='text' class='form-control' placeholder='Ingrese el pedido, producto, precio'> ";
//                html += "		  </div>";
//                html += "             ";  
//                html += "	<!--------------------- fin parametro de buscador --------------------->";


                html += "	<div class='box'>";
                html += "		";
                html += "		<div class='box-body table-responsive'>";
                html += "               <table class='table table-striped table-condensed' id='mitablaventas'>";
                html += "               	<tr>";
                html += "               		<th>#</th>";
                html += "               		<th>producto</th>";
                html += "               		<th>Detalle</th>";
                html += "               	</tr>";
                html += "               	<tbody >";
                
                var cont = 0;
                var subtotal = 0;
                var descuento = 0;
                var totalfinal = 0;
                var imagen = "";
                for (var i = 0; i < d.length; i++){
                                       
                    cont = cont + 1;
                    subtotal   += parseFloat(d[i]['detalleped_subtotal']);
                    descuento  += parseFloat(d[i]['detalleped_descuento']);
                    totalfinal += parseFloat(d[i]['detalleped_total']);
                    //alert("probando "+cont);
                    html += "               	<tr>";
                    html += "               		";
                    html += "                              <td>"+cont+"</td>  ";

                    imagen = base_url+"resources/images/productos/thumb_"+d[i]['detalleped_foto'];
                    //alert(imagen);
                    html += "                              <td>   ";
                    html += "                              	<center>";
                    html += "                              		<img src='"+imagen+"' width='70' height='70' class='img-circle'><br>";
                    html += "                              		<span class='badge btn-warning'>";
                    html += "                                             <font size='5' face='Arial narrow'> <b>"+d[i]['detalleped_total']+"</b></font>";
                    html += "                              		</span>";
                    html += "                                             <button class='btn btn-danger btn-sm' onclick='quitarproducto_pedido("+d[i]['detalleped_id']+")'  title='Quitar producto'><span class='fa fa-trash' ></span></button>";
                    html += "                              	</center>";
                                        
                    html += "                              </td>  ";                            

                    html += "                              <td><b>"+d[i]['detalleped_nombre']+"</b><br>";
                    html += "                              		<b>Unidad: </b>"+d[i]['detalleped_unidad'];
                    html += "                              		<b>Código: </b>"+d[i]['detalleped_codigo'];
                    html += "                              		<b>Obs.: </b>"+d[i]['detalleped_preferencia']+"<br>";
                    html += "                              		<span class='badge btn-facebook btn-sm'> <b>Precio: </b>"+d[i]['detalleped_precio']+"</span><br>     ";                              
                    html += "                              	<!--------------------------------------------------------------->";

                    html += "                              	<br>";
                    html += "                              	<div class='btn-group'>      ";                           

                    html += "                              		<button class='btn btn-success btn-sm' onclick='reducir_pedido(1,"+d[i]['detalleped_id']+")' title='Disminuir producto'><span class='fa fa-minus' ></span></button>";
                    html += "                              		<span class='btn btn-default  btn-sm'> "+d[i]['detalleped_cantidad']+"</span>";
                    html += "                              		<button class='btn btn-success btn-sm' onclick='incrementar_pedido(1,"+d[i]['detalleped_id']+")' title='Incrementar producto'><span class='fa fa-plus' ></span></button>  ";                  
                    html += "                              	  ";
                    html += "                              	</div>";
                    html += "                              		";
                    html += "                              </td>";
                    html += "                                  ";           	   
                    html += "               	</tr>";
                }
                    
                    html += "               </tbody>";
                    html += "               </table>";
                    html += "               ";
                    html += "		</div>";
                    html += "	</div>";
                    html += "</div>";
                    //window.location.href = window.location.href + "?subtotal=" + subtotal + "&descuento=" + descuento+"&totalfinal="+totalfinal;
            $("#tabla_pedidoabierto").html(html);
            
            html = "";
            html += "<div class='col-md-12'>";
            html += "	<div class='box'>";


            html += "<div class='box-body table-responsive table-condensed'>";
            html += "    <table class='table table-striped table-condensed' id='miotratabla'>";
            html += "<tr>";
            html += "	<th> Descripción</th>";
            html += "	<th> Total </th>";       
            html += "</tr>";
            html += "";
            html += "<tr>";
            html += "	<td>Sub Total Bs</td>";
            html += "	<td>"+subtotal+"</td>";    
            html += "</tr>";
            html += "";
            html += "<tr>";
            html += "	<td>Descuento</td>";
            html += "	<td>"+descuento+"</td>";    
            html += "</tr>";
            html += "";
            html += "<tr>";
            html += "	<th><b>TOTAL FINAL</b></th>";
            html += "	<th><font size='5'> "+totalfinal+"</font></th>";
            html += "</tr>";


            html += "    </table>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            
//            html += "<input type='text' value = '"+subtotal+"' id = 'subtotal1'>";
            
            
           $("#total_pedido").val(totalfinal);
           $("#total_descuento").val(descuento);
           $("#pedido_subtotal").val(subtotal);
           $("#pedido_descuento").val(descuento);
           $("#pedido_totalfinal").val(subtotal);
           $("#efectivo").val(0.00);
           $("#cambio").val(0.00);
           
           $("#totalfinal").val(totalfinal);
           $("#lista_pedido").val(response);
        
            $("#detalle_cuenta_pedido").html(html);
                        
            
            
        },        
    });
}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function consolidar_pedido(pedido_id,pedido_total)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/pedido_a_ventas";
    var tipotrans_id =   document.getElementById('tipo_venta'+pedido_id).value;
   
    $.ajax({url:controlador,
        type:"POST",
        data:{pedido_id:pedido_id, tipotrans_id:tipotrans_id,pedido_total:pedido_total},
        success: function(response){
            buscar_pedidos();
            //tabla_pedidos(null);
            //alert("llega hasta aqui...!");
            //console.log(response);
        }        
    });

}

function actualizar_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_inventario/";
    
//    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El pedido fue anulado correctamente...! ');
            //redirect('inventario/index');
//            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            //tabla_inventario();
        },
        complete: function (jqXHR, textStatus) {
//            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
    });   
    
}

function anular_pedido(pedido_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/anular_pedido";

   // alert(pedido_id);
    $.ajax({url:controlador,
        type:"POST",
        data:{pedido_id:pedido_id},
        success: function(response){
            tabla_pedidos(null);
            actualizar_inventario();
            //alert("llega hasta aqui...!");
            //console.log(response);
        }
        
        
    });

}

function tablaresultadospedido(opcion)
{   
    var controlador = "";
    var parametro = "";
    var limite = 5;
    var base_url = document.getElementById('base_url').value;
    
    if (opcion == 1){
        controlador = base_url+'venta/buscarproductos/';
        parametro = document.getElementById('filtrarproducto').value;  
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
               var pedido = JSON.parse(document.getElementById('lista_pedido').value);
               
               if (registros != null){
                   
                   
                   var cont = 0;
                   var cant_total = 0;
                   var total_detalle = 0;
                   var n = registros.length; //tamaño del arreglo de la consulta
                   $("#encontrados").val("- "+n+" -");
                   html = "";
                   
                   if (n <= limite) x = n; 
                   else x = limite;
                   
                   y = pedido.length;
                    for (var i = 0; i < x ; i++){
                        no_existe = 0;                        
                        for(var j = 0; j < y; j++ ){
                           
                           if(pedido[j]["producto_id"]==registros[i]["producto_id"]){
                               no_existe++;
                           }
                        }
                        
                       if(no_existe==0){
                           
                        html += "<tr id='producto"+registros[i]["producto_id"]+"' style='display:'>";
                        html += "   <td >"+(i+1)+"</td>";
                        
                        html += "   <td align='center'>";
                        html += "   <img src='"+base_url+'resources/images/productos/thumb_'+registros[i]["producto_foto"]+"' class='img-circle' width='50' height='50'>";
                        html += "    ";
                        html += "";
                        html += "<br>"+registros[i]["producto_unidad"]+" Bs: "+"<input type='text' value='"+registros[i]["producto_precio"]+"' size='7'  id='precio"+registros[i]['producto_id']+"'>";
                        html
//                        html += "<br><select class='btn btn-facebook btn-xs'>";
//                        html += "<option value='"+registros[i]["producto_precio"]+"' >"+registros[i]["producto_unidad"]+" Bs: "+registros[i]["producto_precio"]+"</option>";
//                        html += "</select>";
                        html += "<br> <span class='btn btn-danger btn-xs'><font size='3' face='Arial'><b>Saldo: "+parseFloat(registros[i]['existencia']).toFixed(2)+"</b></font></span>";
                        html += "    </td>";   
                        
                        html += "   <td>  ";
                        html += "   <font size='2' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font><br>";

                        html += registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += " | <b>"+registros[i]["producto_codigo"]+"</b> <br>";                        
                        html += " ";
                        html += "<span class='btn btn-facebook btn-xs'>Desc.:<input size='4' class='input-xs' id='descuento"+registros[i]["producto_id"]+"' style='background-color: lightgrey; color: black;' name='descuento' type='text' class='form-control' value='0.00' required='true'></span>"

                           //html += "<span class='btn btn-facebook btn-xs'>Cant.:<input size='4' class='input-xs' id='cantidad"+registros[i]["producto_id"]+"' style='background-color: white; color: black;' name='cantidad' type='text' class='form-control' placeholder='cantidad' required='true' value='1'></span>"
                        html += "<span class='btn btn-facebook btn-xs'>Cant.:";
                        html += "<input type='number'  style='width: 70px;' class='input-xs btn-default' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad' placeholder='cantidad' required='true' value='1' min='1' max='"+registros[i]["existencia"]+"'></span>"
                        
// size='4' class='input-xs' id='cantidad"+registros[i]["producto_id"]+"' style='background-color: white; color: black;' name='cantidad' type='text' class='form-control' placeholder='cantidad' required='true' value='1'></span>"
                        
                        html += "<br> <input class='input' size='35' id='preferencia"+registros[i]["producto_id"]+"' name='preferencia' type='text' placeholder='preferencia'><br>";
                        if(registros[i]["existencia"]>0){
                           html += "<br> <button type='submit' class='btn btn-block btn-success' style='width:200px'  onclick='agregar_producto("+registros[i]["producto_id"]+")'><i class='fa fa-cart-arrow-down'></i> Añadir</button>";
                       }
                        html += " </b> ";
                        html += "</td>";

                        html += "</tr>";
                        
                       }
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

function buscar_pedidos()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido";
    var opcion      = document.getElementById('select_pedidos').value;
    var usuario_id  = document.getElementById('usuario_id').value;
    var fecha = new Date();
    var fech_actual = fecha.getFullYear()+"-"+(fecha.getMonth()+1)+"-"+fecha.getDate(); 
    document.getElementById('loader').style.display = "block";
    
    var por_usuario = "";
    
    if (usuario_id>0){
        por_usuario = " and p.usuario_id = "+usuario_id+" ";
    }
       
    if (opcion == 1) //pedidos de hoy
    {
        filtro = " and date(pedido_fecha) = date(now())"+por_usuario;
        mostrar_ocultar_buscador("ocultar");        
        
    }//pedidos de hoy
    
    if (opcion == 2)
    {
        filtro = " and date(pedido_fecha) = date_add(date(now()), INTERVAL -1 DAY)"+por_usuario;
        mostrar_ocultar_buscador("ocultar");
    }//pedidos de ayer
    
    if (opcion == 3) 
    {
        filtro = " and date(pedido_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)"+por_usuario;//pedidos de la semana
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 4) 
    {
        if (usuario_id>0){
            filtro = " and u.usuario_id = "+usuario_id+" ";//todos los pedidos            
        }
        else {
            filtro = "";
        }
        
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    if (opcion == 6) //entregas
    {
        filtro = " and pedido_fechaentrega = date(now())"+por_usuario;
        mostrar_ocultar_buscador("ocultar");
    }//entregas para hoy

    if (opcion == 7)
    {
        filtro = " and pedido_fechaentrega = date_add(date(now()), INTERVAL -1 DAY)"+por_usuario;
        mostrar_ocultar_buscador("ocultar");
    }//pedidos de ayer
    
    if (opcion == 8) 
    {
        filtro = " and pedido_fechaentrega >= date_add(date(now()), INTERVAL -1 WEEK)"+por_usuario;//pedidos de la semana
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 9) //todos los pedidos
    {   filtro = " and u.usuario_id = "+usuario_id+" ";//todos los pedidos
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 10) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    tabla_pedidos(filtro);
    
    
}

function formato_numerico(numer){
    var partdecimal = "";
    var numero = "";
    var num = numer.toString();
    var signonegativo = "";
    var resultado = "";
    
    /*quitamos el signo al numero, si es que lo tubiera*/
    if(num[0]=="-"){
        signonegativo="-";
        numero = num.substring(1, num.length);
    }else{
        numero = num;
    }
    /*guardamos la parte decimal*/
    if(num.indexOf(".")>=0){
        partdecimal = num.substring(num.indexOf("."), num.length);
        numero = numero.substring(0,num.indexOf(".")-1);
    }else{
        numero = num;
    }
    for (var j, i = numero.length - 1, j = 0; i >= 0; i--, j++){
        resultado = numero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;
    }
 
    resultado = signonegativo+resultado+partdecimal;
    return resultado;
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

//esta funcion elimina un item de la tabla detalle de venta
function quitarproducto_pedido(detalleped_id)
{

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/eliminaritemx/"+detalleped_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
               
            }        
    });
    tabla_pedido_abierto();
}

//esta funcion incrementar una cantidad determinada de productos
function incrementar_pedido(cantidad,detalleped_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/incrementar/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleped_id:detalleped_id},
            success:function(respuesta){
//                tablaproductos();
//                tabladetalle(); 
            tabla_pedido_abierto();
           
            }
        
    });
}

//esta funcion incrementar una cantidad determinada de productos
function reducir_pedido(cantidad,detalleped_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/reducir/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad, detalleped_id:detalleped_id},
            success:function(respuesta){
//                tablaproductos();
//                tabladetalle();          
            tabla_pedido_abierto();
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


function agregar_producto(producto_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador =  base_url+"pedido/ingresarproducto";
    var pedido_id   = document.getElementById('pedido_id').value;
    
    var cantidad    = document.getElementById('cantidad'+producto_id).value;
    var descuento   = document.getElementById('descuento'+producto_id).value;
    var preferencia = document.getElementById('preferencia'+producto_id).value;
    var precio = document.getElementById('precio'+producto_id).value;
    

        document.getElementById('producto'+producto_id).style.display = 'none';
    
    
$.ajax({url:controlador,
        type:"POST",
        data:{pedido_id:pedido_id, cantidad:cantidad, descuento:descuento, preferencia:preferencia, producto_id:producto_id, precio:precio},
        success: function(response){    
            tabla_pedido_abierto();
        }
    });
    
    
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
        
        if (opcion==8){   //si la tecla proviene del buscador de pedido abierto
           buscar_clientes();
        }        
    } 
 
}

function buscar_clientes()
{    
    var parametro = document.getElementById('filtrar2').value;
    var pedido_id = document.getElementById('pedido_id').value;
    var tipo = document.getElementById('tipo').value;
    var base_url    = document.getElementById('base_url').value;
    
    var controlador = base_url+"cliente/buscarclientes_pedido";
    
    $.ajax({url:controlador,
        type:"POST",
        data:{parametro: parametro, tipo: tipo},
        success: function(response){
            var c = JSON.parse(response);

            html = "";
            for (var i = 0; i < c.length; i++){

            
                html += "<tr>";
//                html += "     <form action='"+base_url+"cliente/cambiarcliente/ method='POST' class='form'>";
                html += "  ";
                html += "        <td>"+(i+1)+"</td>";
                html += "        <td>";
                html += "        <img src='"+base_url+"resources/images/clientes/thumb_"+c[i]["cliente_foto"]+"' class='img-circle' width='50' height='50'>";
                html += "        <br><a href='"+base_url+"cliente/modificar_cliente/"+c[i]['cliente_id']+"/"+pedido_id+"' class='btn btn-primary btn-xs'><fa class='fa fa-pencil'> </fa> modificar </a>";
                
                html += "        </td>";

                html += "        <td>";


                html += "                <b> "+c[i]["cliente_nombre"]+"</b> , COD.: "+c[i]["cliente_codigo"]+" <br>";
                html += "               "+c[i]["cliente_direccion"];
                html += "            C.I.:"+c[i]["cliente_ci"]+" | Telf.:"+c[i]["cliente_telefono"]+" <br>";
                html += "            <div class='container' hidden='TRUE'>";
                html += "                <input id='cliente_id'  name='cliente_id' type='text' class='form-control' value='<?php echo $h['cliente_id']; ?>'>";
                html += "                <input id='pedido_id'  name='pedido_id' type='text' class='form-control' value='<?php echo $pedido_id; ?>'>";
                html += "            </div>";       
                html += "            NIT:";
                html += "            <input type='text' id='cliente_nit' name='cliente_nit' class='form-control' placeholder='N.I.T.' required='true' value='"+c[i]["cliente_nit"]+"'>";
                html += "            RAZON SOCIAL:";
                html += "            <input type='text' id='cliente_razon' name='cliente_razon' class='form-control' placeholder='Razón Social' required='true' value='"+c[i]["cliente_razon"]+"'>";
                html += "           ";
//                html += "            <button type='submit' class='btn btn-success btn-xs btn-block'>";
//                html += "                <i class='fa fa-check'></i> Seleccionar Cliente";
//                html += "            </button>";
                html += "            <a href='"+base_url+"cliente/cambiarcliente/"+c[i]["cliente_id"]+"/"+pedido_id+"' class='btn btn-success btn-xs btn-block'> Seleccionar Cliente</a>";
                
                html += "            ";
                html += "        </td>";
                html += "    ";
//                html += "     </form>";
                html += "";
                html += "</tr>       ";     

            }

        
            $("#clientes_pedido").html(html);
                        
            
            
        },        
    });
}

function buscar_por_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var estado_id = document.getElementById('estado_id').value;
    var usuario_id = document.getElementById('usuario_id').value;
    
    var opcion      = document.getElementById('select_pedidos').value;
    var esteusuario_id = " and p.usuario_id = "+usuario_id;
    if(usuario_id == 0){
        esteusuario_id = "";
    }
    if (opcion >= 6)
    {    
        filtro = " and pedido_fechaentrega >= '"+fecha_desde+"'  and pedido_fechaentrega <='"+fecha_hasta+
        "' and p.estado_id = "+estado_id+esteusuario_id;
        tabla_pedidos(filtro);

    
    }
    else
    {
        filtro = " and date(pedido_fecha) >= '"+fecha_desde+"'  and  date(pedido_fecha) <='"+fecha_hasta+
        "' and p.estado_id = "+estado_id+esteusuario_id
        tabla_pedidos(filtro);
    }

}

function cambiar_usuario(){
    /*var usuario_id = document.getElementById('select_usuarios').value;
    $('#usuario_id').val(usuario_id);*/
    buscar_pedidos();
}

function set_mapa(datos){
    this.datos = datos;
}

function get_mapa(){
    return this.datos;
}

function mapa_seg(){
    var usuario_id = document.getElementById('select_usuarios').value;  
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var select_pedidos = document.getElementById('select_pedidos').value;

    var base_url    = document.getElementById('base_url').value;
    var url= base_url+"pedido/mapa_seg_entregas/"+usuario_id+"/"+fecha_desde+"/"+fecha_hasta+"/"+select_pedidos;

    document.getElementById("mapa_seg_entregas").href = url;
}

function buscar_clienteszona(){
    var base_url      = document.getElementById('base_url').value;
    var zona_id = document.getElementById('zona_busqueda').value;
    if(zona_id == null || zona_id == ""){
        alert("Debe elegir una zona");
    }else{
        window.open(base_url+"pedido/mapa_depedidos/"+zona_id, '_blank');
    }
}

function consolidar_allpedido()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/pedido_a_ventas";
    var respuesta   = document.getElementById('respedido').value;
    var registros   =  JSON.parse(respuesta);
    var tipotrans_id = 1; // 1-->CONTADO //document.getElementById('tipo_venta'+pedido_id).value;
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    for (var i = 0; i < registros.length; i++){
        if(registros[i]['estado_id'] == 11){
            $.ajax({url:controlador,
                type:"POST",
                data:{pedido_id:registros[i]['pedido_id'], tipotrans_id:tipotrans_id,pedido_total:registros[i]['pedido_total']},
                success: function(response){
                    //var res = JSON.parse(response);
                    /*if (res != null){
                        if(res == "ok"){
                            alert("Pedidos consolidados con exito!.");
                        }
                    }*/
                }
            });
        }
    }
    buscar_pedidos();
    document.getElementById('loader').style.display = 'none';
}

function modificar_lahora(venta_id, lafecha){
    $('#num_pedido').html(venta_id);
    $('#numpedido_id').val(venta_id);
    let esfecha = moment(lafecha).format("YYYY-MM-DD");
    let eshora  = moment(lafecha).format("HH:mm:ss");
    $('#modif_fechapedido').val(esfecha);
    $('#modif_horapedido').val(eshora);
    $('#modalmodificarhorapedido').modal('show');
}

function guardar_fechahorapedido(){
    var base_url = document.getElementById('base_url').value;
    var elpedido_id = $('#numpedido_id').val();
    var pedido_fecha = $('#modif_fechapedido').val();
    var pedido_hora = $('#modif_horapedido').val();
    var controlador = base_url+"pedido/modificar_fechapedido";
    $.ajax({url: controlador,
        type:"POST",
        data:{pedido_id:elpedido_id, pedido_fecha:pedido_fecha, pedido_hora:pedido_hora},
        success:function(report){
            var registros =  JSON.parse(report);
            location.reload();
        }
    });
}
