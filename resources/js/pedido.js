$(document).on("ready",inicio);
function inicio(){
       
        tabla_pedidos(); 
        tabla_pedido_abierto();
       
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function tabla_pedidos(filtro)
{   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/mostrar_pedidos";
    //var forma_pago =  document.getElementById('forma_pago').value;

    
    $.ajax({url:controlador,
        type:"POST",
        data:{filtro:filtro},
        success: function(response){
            //alert("llega hasta aqui...!");
            //console.log(response);
            var usuarios = JSON.parse(document.getElementById('usuarios').value);
            var cont =  0;
            var cantidad_pedidos = 0;
            var total_pedido = 0;
            var p = JSON.parse(response);
            var tipo = JSON.parse(document.getElementById('tipo_transaccion').value);
            var espresentacion="";
            
                html = "";

            total_pedido = 0;   
            
            for(var i = 0; i<p.length; i++){
                
                if(p[i]["tipotrans_id"] == null || p[i]["tipotrans_id"] == 0 || p[i]["tipotrans_id"]-1 > tipo.length){
                    tipotrans = "No definido";
                }else{
                    tipotrans = tipo[p[i]["tipotrans_id"]-1]["tipotrans_nombre"];
                }
                
                if(p[i]["usuario_id"] == null || p[i]["usuario_id"] == 0 || p[i]["usuario_id"]-1 > usuarios.length){
                    nombreusuario = "No definido";
                }else{
                    nombreusuario = usuarios[p[i]["usuario_id"]-1]["usuario_nombre"];
                }

                
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
                html += "        "+'<br><b>'+tipotrans+" </b> ";                
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
                html += "        "+'<b>'+formato_fecha(p[i]["pedido_fechaentrega"])+'<br>'+p[i]["pedido_horaentrega"]+" </b>";
                html += "        <br> <small>"+nombreusuario+"</small>"
                html += "        </font> ";
                html += "        </center>  ";
                html += "    </td> ";

                html += "    <td> ";
                    

                    if (p[i]["estado_id"]>=11 && p[i]["estado_id"]<=14){
                        
                        if (p[i]["estado_id"]==13){
                            html += "        <a href='"+base_url+'pedido/comprobante/'+p[i]["pedido_id"]+"' class='btn btn-warning btn-sm' title='Imprimir comprobante de pedido'><span class='fa fa-print'></span></a> ";
                        }
                        else{
                            
                        html += "        <a href='"+base_url+'pedido/comprobante/'+p[i]["pedido_id"]+"' class='btn btn-warning btn-sm' title='Imprimir comprobante de pedido'><span class='fa fa-print'></span></a> ";
                        html += "        <a href='"+base_url+'pedido/pedidoabierto/'+p[i]["pedido_id"]+"' class='btn btn-success btn-sm' title='Modificar datos de pedido'><span class='fa fa-cubes'></span></a> ";

                 // ****************************** anular pedido ***************************************
                        html += "       <button type='button' class='btn btn-danger btn-sm'  title='Anular pedido' data-toggle='modal' data-target='#modalanular"+p[i]["pedido_id"]+"'> ";
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
                        html += "        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button> ";
                        html += "        <button  class='btn btn-primary' data-dismiss='modal'  onclick='anular_pedido("+p[i]["pedido_id"]+")'><span class='fa fa-money'></span> Anular</button> ";
                        html += "      </div> ";
                        html += "    </div> ";
                        html += "  </div> ";
                        html += "</div> ";
                        
                // ****************************** fin anular pedido ***************************************
                 // ****************************** consolidar pedido a ventas ***************************************
                        html += "   <button type='button' class='btn btn-facebook btn-sm' data-toggle='modal'  title='Consolida Pedido' data-target='#modalconsolidar"+p[i]["pedido_id"]+"'> ";
                        html += "           <span class='fa fa-money'></span>  ";
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
                        html += "              <font size='3'><b>Se enviara este pedido como operación de venta</b></font><br>   ";
                        html += "              <font size='3'>¿Desea continuar?</font><br>   ";

                        html += "          </center> ";
                        html += "      </div> ";
                        html += "      <div class='modal-footer'> ";
                        html += "        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button> ";
                        html += "        <button type='button' class='btn btn-primary' data-dismiss='modal'  onclick='consolidar_pedido("+p[i]["pedido_id"]+")'><span class='fa fa-money'></span> Consolidar</button> ";
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


function tabla_pedido_abierto()
{    
    var pedido_id = document.getElementById('pedido_id').value;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/detalle_pedido";
    

    
    $.ajax({url:controlador,
        type:"POST",
        data:{pedido_id: pedido_id},
        success: function(response){
             // alert("aquiiii....");

            var d = JSON.parse(response);
            
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



function consolidar_pedido(pedido_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/pedido_a_ventas";

   // alert(pedido_id);
    $.ajax({url:controlador,
        type:"POST",
        data:{pedido_id:pedido_id},
        success: function(response){
            buscar_pedidos();
            //tabla_pedidos(null);
            //alert("llega hasta aqui...!");
            //console.log(response);
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
                        html += "<br><select class='btn btn-facebook btn-xs'>";
                        html += "<option value='"+registros[i]["producto_precio"]+"' >"+registros[i]["producto_unidad"]+" Bs: "+registros[i]["producto_precio"]+"</option>";
                        html += "</select>";
                        html += "<br> <span class='btn btn-danger btn-xs'><font size='3' face='Arial'><b>Saldo: "+parseFloat(registros[i]['existencia']).toFixed(2)+"</b></font></span>";
                        html += "    </td>";   
                        
                        html += "   <td>  ";
                        html += "   <font size='2' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font><br>";

                        html += registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += " | <b>"+registros[i]["producto_codigo"]+"</b> <br>";                        
                        html += " ";
                        html += "<span class='btn btn-facebook btn-xs'>Desc.:<input size='4' class='input-xs' id='descuento"+registros[i]["producto_id"]+"' style='background-color: lightgrey; color: black;' name='descuento' type='text' class='form-control' value='0.00' required='true'></span>"
                        html += "<span class='btn btn-facebook btn-xs'>Cant.:<input size='4' class='input-xs' id='cantidad"+registros[i]["producto_id"]+"' style='background-color: white; color: black;' name='cantidad' type='text' class='form-control' placeholder='cantidad' required='true' value='1'></span>"
                        html += "<br> <input class='input' size='35' id='preferencia"+registros[i]["producto_id"]+"' name='preferencia' type='text' placeholder='preferencia'><br>";
                        html += "<br> <button type='submit' class='btn btn-block btn-success' style='width:200px'  onclick='agregar_producto("+registros[i]["producto_id"]+")'><i class='fa fa-cart-arrow-down'></i> Añadir</button>";
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
    var por_usuario   = " and p.usuario_id = "+usuario_id+" ";
 
    
    if (opcion == 1)
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
    {   filtro = " usuario_id = "+usuario_id+" ";//todos los pedidos
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 5) {

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


//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function validar(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  alert('aquiiiii');
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

//esta funcion elimina un item de la tabla detalle de venta
function quitarproducto_pedido(detalleped_id)
{

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/eliminaritem/"+detalleped_id;

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
    

        document.getElementById('producto'+producto_id).style.display = 'none';
    
    
$.ajax({url:controlador,
        type:"POST",
        data:{pedido_id:pedido_id, cantidad:cantidad, descuento:descuento, preferencia:preferencia, producto_id:producto_id},
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
    } 
 
}