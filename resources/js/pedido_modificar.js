$(document).on("ready",inicio);
function inicio(){
    tabla_pedido_abierto();
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function tabla_pedido_abierto()
{   // alert("entraaa..!!");
    var pedido_id = document.getElementById('pedido_id').value;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/detalle_pedido";
    var decimales = 2;
    

    
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
                    html += "                                             <font size='5' face='Arial narrow'> <b>"+Number(d[i]['detalleped_total']).toFixed(decimales)+"</b></font>";
                    html += "                              		</span>";
                    html += "                                             <button class='btn btn-danger btn-sm' onclick='quitarproducto_pedido("+d[i]['detalleped_id']+")'  title='Quitar producto'><span class='fa fa-trash' ></span></button>";
                    html += "                              	</center>";
                                        
                    html += "                              </td>  ";                            

                    html += "                              <td><b>"+d[i]['detalleped_nombre']+"</b><br>";
                    html += "                              		<b>Unidad: </b>"+Number(d[i]['detalleped_unidad']).toFixed(0);
                    html += "                              		<b>Código: </b>"+Number(d[i]['detalleped_codigo']).toFixed(0);
                    html += "                              		<b>Obs.: </b>"+d[i]['detalleped_preferencia']+"<br>";
                    html += "                              		<span class='badge btn-facebook btn-sm'> <b>Precio: </b>"+Number(d[i]['detalleped_precio']).toFixed(decimales)+"</span><br>     ";                              
                    html += "                              	<!--------------------------------------------------------------->";

                    html += "                              	<br>";
                    html += "                              	<div class='btn-group'>      ";                           

                    html += "                              		<button class='btn btn-success btn-sm' onclick='reducir_pedido(1,"+d[i]['detalleped_id']+")' title='Disminuir producto'><span class='fa fa-minus' ></span></button>";
                    html += "                              		<span class='btn btn-default  btn-sm'> "+Number(d[i]['detalleped_cantidad']).toFixed(decimales)+"</span>";
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
    var modificar_precioventa   = document.getElementById('modificar_precioventa').value;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                                     
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
               var pedido = JSON.parse(document.getElementById('lista_pedido').value);
               
               if (registros != null){
                   
                   var sololect = "";
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
                        if(modificar_precioventa == 0){
                            sololect = "readonly";
                        }else{ sololect = ""; }
                        html += "<br>"+registros[i]["producto_unidad"]+" Bs: "+"<input type='text' "+sololect+" value='"+registros[i]["producto_precio"]+"' size='7' id='precio"+registros[i]['producto_id']+"'>";
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