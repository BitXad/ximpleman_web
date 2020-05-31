$(document).on("ready",inicio);
function inicio(){
        
//        alert("holaxxx");
        tablaresultados(1);
        tablaproductos(); 
        //pedidos_pendientes();
        
        document.getElementById('nit').focus();
        document.getElementById('nit').select();
}

function calculardesc(){

   var venta_subtotal = document.getElementById('venta_subtotal').value;
   var venta_descuento = document.getElementById('venta_descuento').value;      
   var tipo_descuento = document.getElementById('tipo_descuento').value;      
   var subtotal = 0;
   
   if (tipo_descuento==2)
   {   
       venta_descuento = venta_descuento * venta_subtotal /100;        
       $("#venta_descuento").val(venta_descuento);
       $("#tipo_descuento").val(1);
    }

       subtotal = Number(venta_subtotal) - Number(venta_descuento); 
    
   $("#venta_totalfinal").val(subtotal);
   $("#venta_efectivo").val(subtotal);
   
}

function calcularcambio(e){
   
   tecla = (document.all) ? e.keyCode : e.which; 
   var venta_efectivo = document.getElementById('venta_efectivo').value;
   var venta_totalfinal = document.getElementById('venta_totalfinal').value;
   
   var venta_cambio = Number(venta_efectivo) - Number(venta_totalfinal);
   //alert(venta_cambio);
   $("#venta_cambio").val(venta_cambio);
   
   if (tecla==13){ 
        $("#boton_finalizar").click();
   }
}

//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function validar(e,opcion) {
    
  tecla = (document.all) ? e.keyCode : e.which;
  
  
    if (tecla==13){ 
    
    
        if (opcion==0){   //si la pulsacion proviene del telefono
              document.getElementById('tipocliente_id').focus();
        }
        
        if (opcion==1){   //si la pulsacion proviene del nit  
            nit = document.getElementById('nit').value;            
            if (nit==''){
                var cod = generar_codigo();
                $("#nit").val(cod);
                $("#razon_social").focus();
                $("#razon_social").select();
                $("#zona_id").val(0);
                
            }else{                
             buscarcliente();
            }               
        }

        if (opcion==2){
            var codigo = document.getElementById('razon_social').value;
            
            codigo = codigo[0]+codigo[1] + Math.floor((Math.random()*100000)+50);
                    
            $("#cliente_nombre").val(document.getElementById('razon_social').value);
            $("#cliente_celular").val(''); //si la tecla proviene del input razon social
            $("#telefono").val(''); //si la tecla proviene del input razon social
            
            $("#cliente_codigo").val(codigo);
           document.getElementById('cliente_celular').focus();
        } 
        
        if (opcion==3){   //si la tecla proviene del input codigo de barras          
            buscarporcodigojs();           
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
        
        if (opcion==9){   //si la tecla proviene del buscador de pedido abierto
            
           var nit = document.getElementById('nit').value;
           if (nit=='0'){
                buscar_clientes();      
           }
           else{
            
                var codigo = document.getElementById('razon_social').value;

                codigo = codigo[0]+codigo[1] + Math.floor((Math.random()*100000)+50);

                $("#cliente_nombre").val(document.getElementById('razon_social').value);
                $("#cliente_celular").val(''); //si la tecla proviene del input razon social
                $("#telefono").val(''); //si la tecla proviene del input razon social

                $("#cliente_codigo").val(codigo);
                document.getElementById('cliente_celular').focus();               
           }
        }  
        if (opcion==10){   //si la tecla proviene del buscador del reporte de  ventas
           ventas_por_parametro();
           
        }  
        
        if (opcion==11){ //si el evento proviene del ingreso rapido
            $("#boton_ingreso_rapido").click();
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
            document.getElementById('cliente_celular').select();
        }
        
        if (opcion==4){
            document.getElementById('venta_descuento').select();
        }
        
        if (opcion==5){
            document.getElementById('venta_efectivo').select();
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
                
                
                if (registros[0]!=null){ //Si el cliente es nuevo o no existe
                    
                    $("#razon_social").val(registros[0]["cliente_razon"]);
                    document.getElementById('telefono').focus();
                    $("#telefono").val(registros[0]["cliente_telefono"]);
                    $("#cliente_nombre").val(registros[0]["cliente_nombre"]);
                    $("#cliente_ci").val(registros[0]["cliente_ci"]);
                    $("#cliente_nombrenegocio").val(registros[0]["cliente_nombrenegocio"]);
                    $("#cliente_id").val(registros[0]["cliente_id"]);
                    $("#cliente_codigo").val(registros[0]["cliente_codigo"]);
                    $("#cliente_direccion").val(registros[0]["cliente_direccion"]);
                    $("#cliente_departamento").val(registros[0]["cliente_departamento"]);
                    $("#cliente_celular").val(registros[0]["cliente_celular"]);
                    if(registros[0]["zona_id"] != null && registros[0]["zona_id"] >=0){
                        $("#zona_id").val(registros[0]["zona_id"]);
                    }else{
                        $("#zona_id").val(0);
                    }
                    
                }
                else 
                {
                    //$("#razon_social").val('SIN NOMBRECILLO');
                    document.getElementById('razon_social').focus();
                    $("#razon_social").val("");
                    $("#cliente_id").val(0);
                    $("#cliente_nombre").val("-");
                    $("#cliente_ci").val(nit);
                    $("#cliente_nombrenegocio").val("-");
                    $("#cliente_codigo").val("-");
                    
                    $("#telefono").val("");
                    $("#cliente_nombre").val("");
                    $("#cliente_direccion").val("-");
                    $("#cliente_departamento").val("-");
                    $("#cliente_celular").val("");
                    $("#zona_id").val(0);
                    
                    
                    
                }

            },
            error:function(respuesta){			
                $("#razon_social").val('SIN NOMBRE');
                document.getElementById('telefono').focus();
                
                $("#cliente_id").val(0);
            }                
    }); 

}

//muestra la tabla de productos del detalle de la venta
function tablaproductos()
{   
    var base_url = document.getElementById('base_url').value;
    var categ = JSON.parse(document.getElementById('categoria_producto').value);
    var controlador = base_url+'venta/detalleventa';
    var parametro_diasvenc = document.getElementById('parametro_diasvenc').value;
    var venta_descuento = Number(document.getElementById('venta_descuento').value);
    
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
                        html += "                            <th style='padding:0'>#</th>";
                        html += "                            <th style='padding:0'>Descripción</th>";
                        
                        if(esMobil()){
                            html += "                            <th style='padding:0'>Precio<br>Cant.</th>";                            
                        }else{
                            html += "                            <th style='padding:0'>Cant.</th>";                    
                            html += "                            <th style='padding:0'>Precio</th>";
                            html += "                            <th style='padding:0'>Precio<br>Total</th>";
                        } 
                        html += "                            <th style='padding:0'><button onclick='quitartodo()' class='btn btn-danger btn-xs' title='Vaciar el detalle de la venta'><span class='fa fa-trash'></span><b></b></button></th>";
                        html += "                    </tr>";                
                        html += "                    <tbody class='buscar2'>";

                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var categoria = '';
                    var x = registros.length; //tamaño del arreglo de la consulta
                      
                    for (var i = 0; i < x ; i++){

                        //alert(registros[i]["categoria_id"]-1);
                        categoria = "";
                        
                           cont = cont+1;
                           cant_total+= parseFloat(registros[i]["detalleven_cantidad"]);
                           total_detalle+= parseFloat(registros[i]["detalleven_total"]);
                           
                            if (i == 0){
                                color = "style='background-color: orange; padding:0; color: black;'"
                                fuente = "2";
                            }
                            else {
                                color = "style='padding:0'";
                                fuente = '1';
                            }
                            
                        html += "                    <tr>";
                        html += "			<td "+color+">"+cont+"</td>";
                        html += "                       <td "+color+"><b><font size='"+fuente+"'>"+registros[i]["producto_nombre"]+"</font></b>";
                        html += "                           <small><br>"+categoria+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_codigobarra"]+"</small>";

//************************ INICIO CARACTERISTICAS ***************************

html += "  <button class='btn btn-primary btn-xs' title='Registrar/modificar preferencias y características' type='button' data-toggle='collapse' data-target='#caracteristicas"+registros[i]["detalleven_id"]+"' aria-expanded='false' aria-controls='caracteristicas"+registros[i]["detalleven_id"]+"'><i class='fa fa-edit'></i></button>";

html += "  <a href='#' data-toggle='modal' onclick='iniciar_preferencia("+registros[i]["detalleven_id"]+")' data-target='#modalpreferencia' class='btn btn-xs btn-success' style=''><i class='fa fa-tasks'></i></a>";


html += "<div class='row'>";
html += "  <div class='col'>";
html += "    <div class='collapse multi-collapse' id='caracteristicas"+registros[i]["detalleven_id"]+"'>";
html += "      <div class='card card-body'>";

html += "        <div class='row clearfix'> ";

html += "           <div class='col-md-3' style='padding:1;'>";
html += "               <label for='producto_costo' class='control-label  text-uppercase'>Precio Costo</label>";
html += "               <div class='form-group'>"
html += "               <input type='text' name='detalleven_preferencia' value='"+registros[i]['detalleven_costo']+"' class='btn btn-xs btn-default form-control' style='text-align:left;' id='detalleven_costo"+registros[i]["detalleven_id"]+"' />";
html += "               </div>";
html += "           </div>";

html += "           <div class='col-md-9' style='padding:1px;'>";
html += "               <label for='estado_descripcion' class='control-label  text-uppercase'>Preferencias/Características</label>";
html += "               <div class='form-group'>"
html += "               <input type='text' name='detalleven_preferencia' value='"+registros[i]['detalleven_preferencia']+"' class='btn btn-xs btn-default form-control' style='text-align:left' id='detalleven_preferencia"+registros[i]["detalleven_id"]+"' />";
html += "               </div>";
html += "           </div>";
html += "           <div class='col-md-12'>";
//html += "               <label for='estado_descripcion' class='control-label'>Descripcion</label>";
html += "               <div class='form-group'>";
if (registros[i]['detalleven_caracteristicas']=='null'){ caracteristicas = "";
    html += "<textarea name='detalleven_caracteristicas' class='form-control btn-default' id='detalleven_caracteristicas"+registros[i]["detalleven_id"]+"'>"+caracteristicas;}
else
{  html += "<textarea name='detalleven_caracteristicas' class='form-control btn-default' id='detalleven_caracteristicas"+registros[i]["detalleven_id"]+"'>"+registros[i]['detalleven_caracteristicas'];}

html += "</textarea>";

if (registros[i]["detalleven_envase"] == 1){
    
    html += "<br>";
    html += "<table id='mitabla'>";
    
    html += "<tr>";
    
        html += "<th style='padding: 0;' colspan='2'> Prestar</th>";    
//        html += "<th style='padding: 0;'></th>";
        html += "<th style='padding: 0;'> Prestados </th>";
//        html += "<th style='padding: 0;'> Prestados </th>";
        html += "<th style='padding: 0;'> Garantia </th>";
    html += "</tr>";

    html += "<tr style='padding: 0;'>";
        if(registros[i]["detalleven_prestamoenvase"]==1){ valorcheck = "checked"} else{ valorcheck = "";}

        html += "<td style='padding: 0;' bgcolor='gray'><b>"+registros[i]["detalleven_nombreenvase"]+": "+registros[i]["detalleven_precioenvase"]+" Bs</b></td>";
        html += "<td style='padding: 0;'><center><input type='checkbox' id='check"+registros[i]["detalleven_id"]+"' value='1' "+valorcheck+" ></center></td>";
        html += "<td style='padding: 0;'><center><input type='text' style='width:30px' id='cantidadenvase"+registros[i]["detalleven_id"]+"' value='"+registros[i]["detalleven_cantidadenvase"]+"' ></center></td>";
//        html += "<td style='padding: 0;'><center><input type='text' style='width:40px' value='"+registros[i]["detalleven_precioenvase"]+"' ></center></td>";
        html += "<td style='padding: 0;'><center><input type='text' style='width:30px'  id='garantia"+registros[i]["detalleven_id"]+"' value='"+registros[i]["detalleven_garantiaenvase"]+"' ></center></td>";
    html += "</tr>";
    
    html += "</table>";
}

else

{
    html += "<input type='checkbox' id='check"+registros[i]["detalleven_id"]+"' value='0'  hidden>";
    html += "<input type='text' id='cantidadenvase"+registros[i]["detalleven_id"]+"' value='0'  hidden>";
    html += "<input type='text' id='garantia"+registros[i]["detalleven_id"]+"' value='0'  hidden>";
}

        if(parametro_diasvenc>0){
            html += "<div>";
            html += "<b>VENCIMIENTO:</b> <input type='date' value='"+registros[i]["detalleven_fechavenc"]+"' id='fecha_vencimiento"+registros[i]["detalleven_id"]+"'/>  ";
            html += "</div>";
        }else{
            html += "<div hidden>";
            html += "<b>VENCIMIENTO:</b> <input type='date' value='' id='fecha_vencimiento"+registros[i]["detalleven_id"]+"'/>  ";
            html += "</div>";
        }
    
html += "               <button class='btn btn-primary btn-xs' onclick='actualizar_caracteristicas("+registros[i]["detalleven_id"]+")' type='button' data-toggle='collapse' data-target='#caracteristicas"+registros[i]["detalleven_id"]+"' aria-expanded='false' aria-controls='caracteristicas"+registros[i]["detalleven_id"]+"'><i class='fa fa-save'></i> Guardar</button>";

html += "               </div>";
html += "           </div>";

html += "           </div>";
html += "      </div>";
html += "    </div>";
html += "  </div>";

//************************ FIN INICIO CARACTERISTICAS ***************************
                       
                       html += "                       </td>";

                    if (esMobil()){    
                        
                        html += " <td align='center'"+color+"> ";
                     
                        html += "                    <div class='btn-group'>      ";                           
                        html += "			<button onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";                       
                        //html += "                              		<span class='btn btn-default  btn-xs'> "+registros[i]["detalleven_cantidad"]+"</span>";
                        
                        html += "                       <input size='1' name='cantidad' class='btn btn-default btn-xs' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+registros[i]["detalleven_cantidad"]+"'   onKeyUp ='cambiarcantidadjs(event,"+JSON.stringify(registros[i])+")' >";
                        //onkeypress ='seleccionar_cantidad(cantidad"+registros[i]["detalleven_id"]+")'
                        html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "                       <button onclick='ingresorapidojs(1,"+JSON.stringify(registros[i])+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></a></button>";
                        html += "                    </div>";

                        html += "<input size='5' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(2)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'>";
                        html += "<br><font size='3' ><b>"+parseFloat(registros[i]["detalleven_total"]).toFixed(2)+"</b></font>";
                        html += "</td>";
                        html += "			<td "+color+">";
                        html += "                            <button onclick='quitarproducto("+registros[i]["detalleven_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a></button> ";
                        html += "                        </td>";                        
                    }
                    else{
                        
                        html += " <td align='center' width='120' "+color+"> ";
                     
                        html += "                    <div class='btn-group'>      ";                           
                        html += "			<button onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";                       
                        //html += "                              		<span class='btn btn-default  btn-xs'> "+registros[i]["detalleven_cantidad"]+"</span>";
                        
                        html += "                       <input size='1' name='cantidad' class='btn btn-default btn-xs' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+registros[i]["detalleven_cantidad"]+"'   onKeyUp ='cambiarcantidadjs(event,"+JSON.stringify(registros[i])+")' >";
                        //onkeypress ='seleccionar_cantidad(cantidad"+registros[i]["detalleven_id"]+")'
                        html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "                       <button onclick='ingresorapidojs(1,"+JSON.stringify(registros[i])+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></a></button>";
                        html += "                    </div>";

                    

                        html += "</td>";
                        html += "<td align='right' "+color+"><input size='5' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(2)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'></td>";
                        
                        html += "                       <td align='right' "+color+"><font size='3' ><b>"+parseFloat(registros[i]["detalleven_total"]).toFixed(2)+"</b></font></td>";

                        html += "			<td "+color+">";
                        html += "                            <button onclick='quitarproducto("+registros[i]["detalleven_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a></button> ";
                        html += "                        </td>";
                        html += "                    </tr>";  
                        
                    }                                              

                   }
                 
                   html += "                    </tbody>";
                   html += "                    <tr>";
                   
                   if (esMobil()){                       
                        html += "                            <th style='padding:0'></th>";
                        //html += "                            <th style='padding:0'></th>";
                        html += "                            <th colspan=2 style='padding:0' align='right'><font size='1'> Producto(s): "+cant_total.toFixed(2)+"</font><br><font size='3'>Total Bs.: "+total_detalle.toFixed(2)+"</font></th>";
                        html += "                            <th style='padding:0'></th> ";                                       
                   }
                   else{                       
                        html += "                            <th style='padding:0'></th>";
                        html += "                            <th style='padding:0'></th>";
                        html += "                            <th style='padding:0'><font size='3'>"+cant_total.toFixed(2)+"</font></th>";
                        html += "                            <th style='padding:0'></th>"; 
                        html += "                            <th style='padding:0'><font size='3'>"+total_detalle.toFixed(2)+"</font></th>";
                        html += "                            <th style='padding:0'></th> ";                                                          
                   }
                   html += "                    </tr>   ";                 
                   html += "                </table>";

                   $("#tablaproductos").html(html);
                   tabladetalle(total_detalle,venta_descuento,total_detalle);
            }
            
                
        },
        error:function(respuesta){

        }
        
    });
}

//muestra la tabla detalle de venta auxiliar
function tabladetalle(subtotal,descuento,totalfinal)
{
    //totalfinal = totalfinal - descuento;
//    alert(subtotal);
//    alert(descuento);
//    alert(totalfinal);
//    
    efectivo = totalfinal - descuento;
    
    $("#venta_total").val(subtotal.toFixed(2));
    $("#venta_descuento").val(descuento.toFixed(2));
    $("#venta_subtotal").val(subtotal.toFixed(2));
    $("#venta_efectivo").val(efectivo.toFixed(2));
    
    //alert(descuento);
    
    var venta_totalfinal = parseFloat(totalfinal - descuento);
    $("#venta_totalfinal").val(venta_totalfinal.toFixed(2));
    
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

//muestra la tabla detalle de venta auxiliar
function tabladetalle_espera()
{

    var base_url = document.getElementById('base_url').value; 
    var spiner = base_url+"resources/images/loader.gif"; 
            
        html = "<!-- Modal -->";
        html = "<div class='modal fade' id='myModal' role='dialog'>";
        html = "	<div class='modal-dialog'>";
        html = "";
        html = "	<!-- Modal content-->";
        html = "	<div class='modal-content'>";
        html = "	<div class='modal-body'>";
        html = "		<p>Some text in the modal.</p>";
        html = "	</div>";
        html = "	</div>";
        html = "	</div>";
        html = "</div>";
        html = "";
        html = " <!-- Modal -->";


    $("#modalespera").html(html); 
}

//esta funcion busca un producto en el inventario mediante su codigo de barras
// y la ingresa a la tabla detalle de venta
function buscarporcodigo()
{
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/buscarcodigo';
   var codigo = document.getElementById('codigo').value;
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    $.ajax({url: controlador,
           type:"POST",
           data:{codigo:codigo},
           success:function(respuesta){   
               tablaproductos(); 
               $("#codigo").select();
               
               var resultado = JSON.parse(respuesta);                

                if(resultado[0]["resultado"] == 0) alert('La cantidad excede la cantidad en inventario...!');
                if(resultado[0]["resultado"] == -1) alert('El producto no se encuentra registrado con el código especificado...!!');
                 
           },
           error:function(respuesta){
               alert('ERROR: no existe el producto con el codigo seleccionado o no tiene existencia en inventario...!!');
               
               $("#codigo").select();

           },
            complete: function (respuesta) {
               if (respuesta==null){
                    alert('El producto no se encuentra registrado o se encuentra agostado en inventario..!!!');
                }              
             document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
              $("#codigo").select();
              
            }
        });
           
        
    document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader

}

function buscarporcodigojs()
{
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/buscarcodigo';
   var codigo = document.getElementById('codigo').value;
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    $.ajax({url: controlador,
           type:"POST",
           data:{codigo:codigo},
           success:function(respuesta){
               
               res = JSON.parse(respuesta);

                    if (res.length>0){
                        
                         if (res[0].existencia > 0){
                             
                            if (res[0].producto_codigobarra == codigo) factor = 1;
                            
                            if (res[0].producto_codigofactor == codigo) factor = res[0].producto_factor;
                            
                            if (res[0].producto_codigofactor1 == codigo) factor = res[0].producto_factor1;
                            if (res[0].producto_codigofactor2 == codigo) factor = res[0].producto_factor2;
                            if (res[0].producto_codigofactor3 == codigo) factor = res[0].producto_factor3;
                            if (res[0].producto_codigofactor4 == codigo) factor = res[0].producto_factor4;
                            
                           
                            html = "<input type='text' value='"+factor+"' id='select_factor"+res[0].producto_id+"' title='select_factor"+res[0].producto_id+"'>"
                             $("#selector").html(html);
                            
                            ingresorapidojs(1,res[0]);
                         }
                         else{    
                             alert('No existe la cantidad requerida en inventario...!');
                         }
                         
                     }
                     else {alert('El producto no se encuentra registrado con el código especificado...!!'); }

           },
           error:function(respuesta){
               alert('ERROR: no existe el producto con el codigo seleccionado o no tiene existencia en inventario...!!');
               
               $("#codigo").select();

           },
            complete: function (respuesta) {
               if (respuesta==null){
                    alert('El producto no se encuentra registrado o se encuentra agostado en inventario..!!!');
                }              
             document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
              $("#codigo").select();
              
            }
        });
           
        
    document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader

}

function cantidad_en_detalle(producto_id){
    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/cantidad_en_detalle';
   var res = 0;
   
   $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
           async: false, 
           success:function(respuesta){
               
               var resultado = eval(respuesta);
               
                res = resultado[0]["cantidad"];
           },
           error:function(respuesta){
               
             res = 0;
           }
    });     
    
    return res;
}

function cantidad_en_detalle_otros(producto_id){
    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/cantidad_en_detalle_otros';
   
   var res = 0;
   
   $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
           async: false, 
           success:function(respuesta){
               
               var resultado = eval(respuesta);
               
                res = resultado[0]["cantidad"];
           },
           error:function(respuesta){
               
             res = 0;
           }
    });     
    
    return res;
}

function existencia(producto_id){
    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/existencia';
   var res = 0;
   
   $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
           async: false, 
           success:function(respuesta){
               
               var resultado = eval(respuesta);
               
                res = resultado[0]["existencia"];
           },
           error:function(respuesta){
               
             res = 0;
           }
    });     
    
    return res;
}

//se encarga de ingresar una cantidad determinada de productos al detalle de la venta en base de id de producto
// la cantidad debe estar registrada en el modal asignada para esta operacion
function ingresardetallejs(producto_id,producto)
{

   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/insertarProducto';
   var cantidad = parseFloat(document.getElementById('cantidad'+producto_id).value);
   var existencia = document.getElementById('existencia'+producto_id).value;
   
   //var cantidad_total = parseFloat(cantidad_en_detalle(producto_id)) + cantidad; 
   
   ingresorapidojs(cantidad,producto)
 
}

function ingresardetalle(producto_id)
{

   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/insertarProducto';
   var cantidad = parseFloat(document.getElementById('cantidad'+producto_id).value);
   var existencia = document.getElementById('existencia'+producto_id).value;
   var parametro_diasvenc = document.getElementById('parametro_diasvenc').value;
   
   var cantidad_total = parseFloat(cantidad_en_detalle(producto_id)) + cantidad; 
   
   if(cantidad_total <= existencia){
   
        $.ajax({url: controlador,
               type:"POST",
               data:{cantidad:cantidad, producto_id:producto_id, existencia:existencia,parametro_diasvenc:parametro_diasvenc},
               success:function(respuesta){
                   var resultado = JSON.parse(respuesta);
                  // alert(resultado[0]["resultado"]);
                   tablaproductos();

                  // alert(resultado[0]['resultado']);

               },
               error:function(respuesta){
                   alert('ERROR: no existe el producto con el codigo seleccionado o no tiene existencia en inventario...!!');
                   tablaproductos();
                   $("#codigo").select();
               }
        });

   }
   else alert("ADVERTENCIA: La cantidad excede la existencia del inventario...!!");

}


//esta funcion elimina un item de la tabla detalle de venta
function quitarproducto(producto_id)
{

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminaritem/"+producto_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tablaproductos();
            }        
    });
}

function quitartodo()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminartodo/";
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
    var producto_id = document.getElementById('productodet_'+detalleven_id).value;
    var cantidad_detalle = cantidad_en_detalle(producto_id)+1;
    var cantidad_disponible =  existencia(producto_id);
    
   if (cantidad_detalle <= cantidad_disponible){
       
        $.ajax({url: controlador,
                type:"POST",
                data:{cantidad:cantidad,detalleven_id:detalleven_id},
                success:function(respuesta){
                    
                    tablaproductos();
                    tabladetalle();
                    
                }

        });
   }
   else { alert('ADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+cantidad_disponible);}
       
    
}

//incrementa productos al detalle de la nota de venta
function incrementar_detalle(cantidad,detalleven_id,venta_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/incrementar_detalle/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleven_id:detalleven_id,venta_id:venta_id},
            success:function(respuesta){
                tablaproductos();
                tabladetalle();                
            }
        
    });
    location.reload();
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

//reduce la cantidad de productos del detalle de venta
function reducir_detalle(cantidad,detalleven_id,venta_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/reducir_detalle/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleven_id:detalleven_id,venta_id:venta_id},
            success:function(respuesta){
//                tablaproductos();
//                tabladetalle();                
            }
        
    });
   location.reload();    
}


function actualizarprecios(e,detalleven_id)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
    
        var base_url =  document.getElementById('base_url').value;
        var precio = document.getElementById('precio'+detalleven_id).value;
        var cantidad = document.getElementById('cantidad'+detalleven_id).value; 
        var controlador =  base_url+"venta/actualizarprecio";
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

function actualizar_cantidad_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_cantidad_inventario/";

    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El inventario se actualizo exitosamente...! ');
            redirect('inventario/index');
        }
    });        
}

function actualizar_producto_inventario(producto_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_producto";

    $.ajax({url: controlador,
        type:"POST",
        data:{producto_id:producto_id},
        success:function(respuesta){     
           
            //redirect('inventario/index');
        }
    });        
}


function ingresorapido(producto_id,cantidad)
{
    var factor = document.getElementById('select_factor'+producto_id).value;
    
    $("#cantidad"+producto_id).val(cantidad * factor); //establece la cantidad requerida en el modal
    ingresardetalle(producto_id); //llama a la funcion para consolidar la cantidad
    
}

function ingresorapidojs(cantidad,producto)
{       
    var factor_nombre = document.getElementById("select_factor"+producto.producto_id).value; //cantidad del factor seleccionado
    var indice = document.getElementById("select_factor"+producto.producto_id).selectedIndex; //cantidad del factor seleccionado
    var factor = 0;    
    var precio = 0;  
    
    
    if (Number(indice)>0){
    
        if (factor_nombre == "producto_factor"){
            precio = producto.producto_preciofactor;
            factor = producto.producto_factor;
        }    
    
    
        if (factor_nombre == "producto_factor1"){
            precio = producto.producto_preciofactor1;
            factor = producto.producto_factor1;
        }    
    
        if (factor_nombre == "producto_factor2"){
            precio = producto.producto_preciofactor2;
            factor = producto.producto_factor2;
        }    
    
        if (factor_nombre == "producto_factor3"){
            precio = producto.producto_preciofactor3;
            factor = producto.producto_factor3;
        }    
    
        if (factor_nombre == "producto_factor4"){
            precio = producto.producto_preciofactor4;
            factor = producto.producto_factor4;
        }    
    }
    else 
    {   factor = 1; 
        precio = producto.producto_precio;
    }

    var cantidad = cantidad * factor;
    

    //alert(producto.producto_nombre+", cantidad: "+cantidad+", factor:"+factor+", indice:"+indice+", precio: "+precio);
    
    var base_url = document.getElementById('base_url').value;   
    var controlador = base_url+"venta/ingresar_detalle";
    var usuario_id = document.getElementById('usuario_id').value;
    var existencia =  producto.existencia;    
    var producto_id =  producto.producto_id;    
    var datos1 = "";
    var descuento = 0;
    var cantidad_total = parseFloat(cantidad_en_detalle(producto.producto_id)) + cantidad; 
    var check_agrupar = document.getElementById('check_agrupar').checked;
    var parametro_diasvenc = document.getElementById('parametro_diasvenc').value;
        
    if (check_agrupar){
        agrupado = 1;
    }
    else{
        agrupado = 0;
    }
        

    if (cantidad_total <= producto.existencia){

        datos1 +="0,1,"+producto.producto_id+",'"+producto.producto_codigo+"',"+cantidad+",'"+producto.producto_unidad+"',"+producto.producto_costo+","+precio+","+precio+"*"+cantidad+",";
        datos1 += descuento+","+precio+"*"+cantidad+",'"+producto.producto_caracteristicas+"',"+"'-'"+",0,1,"+usuario_id+","+producto.existencia+",";
        datos1 += "'"+producto.producto_nombre+"','"+producto.producto_unidad+"','"+producto.producto_marca+"',";
        datos1 += producto.categoria_id+",'"+producto.producto_codigobarra+"',";        
        datos1 += producto.producto_envase+",'"+producto.producto_nombreenvase+"',"+producto.producto_costoenvase+","+producto.producto_precioenvase+",";
        datos1 += cantidad+",0,"+cantidad+",0,0, DATE_ADD(CURDATE(), interval "+parametro_diasvenc+" day)";        
        //alert(datos1);

        $.ajax({url: controlador,
            type:"POST",
            data:{datos1:datos1, existencia:existencia,producto_id:producto_id,cantidad:cantidad, descuento:descuento, agrupado:agrupado},
            success:function(respuesta){
                tablaproductos();

            }
        });
    
    }
    else { alert('ADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+producto.existencia);}
    
}

function cambiarcantidadjs(e,producto)
{   
    tecla = (document.all) ? e.keyCode : e.which;
    
    if (tecla==13)
    {
  
        var base_url = document.getElementById('base_url').value;   
        var controlador = base_url+"venta/ejecutar_consulta";
        var usuario_id = document.getElementById('usuario_id').value;
        var existencia =  parseFloat(producto.existencia);    
        var producto_id =  producto.producto_id; 
        
        var cantidad =  document.getElementById('cantidad'+producto.detalleven_id).value;
         
        var sql = ""
        
        var descuento = 0;
        var cantidad_total = parseFloat(cantidad_en_detalle_otros(producto.producto_id)) + parseFloat(cantidad); 

        if (parseFloat(cantidad_total) <= parseFloat(existencia)){

            sql = "update detalle_venta_aux set detalleven_cantidad =  "+cantidad+
                    ", detalleven_subtotal = detalleven_precio * (detalleven_cantidad)"+
                    ", detalleven_descuento = "+descuento+
                    ", detalleven_total = (detalleven_precio - "+descuento+")*(detalleven_cantidad)"+
                    "  where producto_id = "+producto_id+" and  detalleven_id = "+producto.detalleven_id ; //usuario_id = "+usuario_id;
           // alert(sql);
            
            $.ajax({url: controlador,
                type:"POST",
                data:{sql:sql},
                success:function(respuesta){
                        //var r = JSON.parse(respuesta);                        
                }
            });      

        }
        else { 
            
            alert('ADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+producto.existencia);}
        
        tablaproductos();
    }
}


//function mostrar_saldo(existencia, producto_id)
function mostrar_saldo(producto)
{

    var factor_nombre = document.getElementById("select_factor"+producto.producto_id).value; //cantidad del factor seleccionado
    var indice = document.getElementById("select_factor"+producto.producto_id).selectedIndex; //cantidad del factor seleccionado
    var factor = 0;    
    var existencia = producto.existencia;  
    var producto_id = producto.producto_id;  
    var unidad = producto.producto_unidad;
    
    if (Number(indice)>0){
    
        if (factor_nombre == "producto_factor"){
            unidadfactor = producto.producto_unidadfactor;
            factor = producto.producto_factor;
        }    
    
    
        if (factor_nombre == "producto_factor1"){
            unidadfactor = producto.producto_unidadfactor1;
            factor = producto.producto_factor;
        }    
    
        if (factor_nombre == "producto_factor2"){
            unidadfactor = producto.producto_unidadfactor2;
            factor = producto.producto_factor;
        }    
    
        if (factor_nombre == "producto_factor3"){
            unidadfactor = producto.producto_unidadfactor3;
            factor = producto.producto_factor;
        }    
    
        if (factor_nombre == "producto_factor4"){
            unidadfactor = producto.producto_unidadfactor4;
            factor = producto.producto_factor;
        }    
    }
    else 
    {
        factor = 1; 
    }



    
    if (factor_nombre == "precio_normal")
    {
          
        //$("#input_existencia"+producto_id).val(existencia+" "+unidad); //establece la cantidad requerida en el modal
        exist = "<center><font size='3'><b>"+Number(existencia).toFixed(2); +"</b></font><br>"+unidad+"</center>";
        $("#input_existencia"+producto_id).html(exist); //establece la cantidad requerida en el modal

    }
    else
    {
                        
        var entero = parseInt( existencia / factor);
        var saldo = parseInt(existencia) - parseInt(entero*factor);
        
        //$("#input_existencia"+producto_id).val(entero+" "+unidadfactor+"+"+saldo+" "+unidad); //establece la cantidad requerida en el modal
        $("#input_existencia"+producto_id).html("<center><b>"+entero+" "+unidadfactor+"+"+saldo+" "+unidad+"</center></b>"); //establece la cantidad requerida en el modal
    }
        
}


function esMobil(){
    
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };    

    return isMobile.any()
    
}

function ingreso_rapido(producto_id){
  
        var base_url = document.getElementById('base_url').value;   
        var controlador = base_url+"venta/ejecutar_consulta";
        var usuario_id = document.getElementById('usuario_id').value;
        var existencia =  parseFloat(producto.existencia);    
        var producto_id =  producto.producto_id; 
    
}

function registrar_ingreso_rapido(producto){
    
    $("#ingresorapido_producto").val(producto.producto_nombre);
    $("#filtrar").val(producto.producto_nombre);
    $("#ingresorapido_producto_id").val(producto.producto_id);
    $("#ingresorapido_cantidad").val("0.00");
    $("#boton_modal_ingreso").click();
    
    focus_ingreso_rapido();
    
}

function guardar_ingreso_rapido(){
      
    var base_url = document.getElementById('base_url').value;   
    var controlador = base_url+"compra/compra_rapida";
    var producto_id = document.getElementById("ingresorapido_producto_id").value;
    var cantidad = document.getElementById("ingresorapido_cantidad").value;
   
    $.ajax({url: controlador,
        type:"POST",
        data:{producto_id:producto_id,cantidad:cantidad },
        success:function(respuesta){     
                        
            tablaresultados(1);
            
            //tablaresultados()();
        },
        error: function(respuesta){         
        }        
    });               
    
}

function registrar_cantidad(e,producto_id){
    tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){
       $("#boton_cantidad"+producto_id).click();
    }
    
}


//Tabla resultados de la busqueda
function tablaresultados(opcion)
{   
    
    var controlador = "";
    var parametro = "";
    var limite = 500;
    var precio_unidad = 0;
    var precio_factor = 0;
    var precio_factorcant = 0;
    var existencia = 0;
    var base_url = document.getElementById('base_url').value;    
    var cantidad = 0;
    var usuario_id = document.getElementById('usuario_id').value;

    var modo_visualizacion = document.getElementById('parametro_modoventas').value; // modo de visualizacion 1 = modo texto , 2 = modo grafico
    var ancho_boton = document.getElementById('parametro_anchoboton').value; //base 115
    var alto_boton = document.getElementById('parametro_altoboton').value;
    var color_boton = document.getElementById('parametro_colorboton').value;
    var ancho_imagen = document.getElementById('parametro_anchoimagen').value;//document.getElementById('parametro_anchoimagen').value;
    var alto_imagen = document.getElementById('parametro_altoimagen').value; //document.getElementById('parametro_altoimagen').value;
    var forma_imagen = document.getElementById('parametro_formaimagen').value; //document.getElementById('parametro_altoimagen').value;
    
    var rol_precioventa = document.getElementById('rol_precioventa').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor = document.getElementById('rol_factor').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor1 = document.getElementById('rol_factor1').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor2 = document.getElementById('rol_factor2').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor3 = document.getElementById('rol_factor3').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor4 = document.getElementById('rol_factor4').value; //document.getElementById('parametro_altoimagen').value;
    

    if(esMobil()) { tamanio = 1; }
    else{ tamanio = 3; }
    
    
    if (opcion == 1){
        controlador = base_url+'venta/buscarproductos/';
        parametro = document.getElementById('filtrar').value        
    }
    
    if (opcion == 2){
        controlador = base_url+'venta/buscarcategorias/';
        parametro = document.getElementById('categoria_prod').value;
    }
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                                     
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   if (modo_visualizacion == 1){ // visualziacion tipos texto, en lista
                   
                   /************** INICIO MODO TEXTO ***************/
                    var nombreprod = "";
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    
                   html += "                <table class='table  table-condensed table-striped' id='mitabla'>";
                   html += "                <tr>";
                   html += "                <th>#</th> ";
                   html += "                <th>Descripción</th>";
                   
                    if(! esMobil()) { //si no es dispositivo mobil
                        mensajeboton = "";
                        html += "                <th>Precio</th>";
                        html += "                <th> </th>";
                    }
                    else{
                        mensajeboton = " Añadir al detalle"; //mensaje para el boton del carrito
                        
                    }
                    
                   html += "                </tr>";
                   html += "                <tbody class='buscar' >";
         
                    sql = ""; 
                    comilla = "'";
                    
                    
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        var mimagen = "";
                        if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                            mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+registros[i]["producto_foto"]+"' class='img img-circle' width='20' height='20' />";
                            mimagen += "</a>";
                            //mimagen = nomfoto.split(".").join("_thumb.");77
                        }else{
                            mimagen = "<img src='"+base_url+"resources/images/productos/thumb_image.png' class='img img-circle' width='30' height='30' />";
                        }
                        
                        html += "<input type='text' value='"+registros[i]["existencia"]+"' id='existencia"+registros[i]["producto_id"]+"' hidden>";
                        html += "<tr>";
                        html += "<td class='button btn-default' onclick='ocultar_busqueda();' style='padding:0;'>"+(i+1)+"</td>";
                        
                        nombreprod = registros[i]["producto_nombre"];
                        
                        if (nombreprod.length>35)
                            nombreprod = "<span title='"+nombreprod+"'>"+nombreprod.substr(0,34)+"...</span>";
                        
                        //html += "<td  style='padding:0'><font size='"+tamanio+"' face='Arial Narrow'><b>"+ registros[i]["producto_nombre"]+"</b></font>";
                        html += "<td  style='padding:0; line-height:10pt;'><font size='"+tamanio+"' face='Arial Narrow'><b>"+ nombreprod+"</b></font>";
                        
                        html += mimagen;   
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+" | "+registros[i]["producto_codigobarra"];
                        html += "<input type='text' id='input_unidad"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidad"]+"' hidden>";
                        html += "<input type='text' id='input_unidadfactor"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidadfactor"]+"' hidden>";
                        
                        html += "<button class='btn btn-danger btn-xs' type='text' style='padding:0;' title='Compra rápida' id='button"+registros[i]["producto_id"]+"' onclick='registrar_ingreso_rapido("+JSON.stringify(registros[i])+")'>- <fa class='fa fa-bolt'></fa> -</button>";
                        
                       if(! esMobil()){
                        html += "</td>";
                        
                        html += "<td  style='padding:0px;'>"; // style='space-white:nowarp'
                        }
                        
                        html += "<center> ";                        
//                        html += "   <select class='btn btn-facebook' style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["producto_id"]+"' name='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+registros[i]["existencia"]+","+registros[i]["producto_id"]+")'>";
                        html += "   <select class='btn btn-facebook' style='font-size:12px; font-family: Arial; padding:0; background: black;' id='select_factor"+registros[i]["producto_id"]+"' name='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+JSON.stringify(registros[i])+")'>";
                        
                        if (rol_precioventa==1){
                            
                            html += "       <option value='precio_normal'>";
                            precio_unidad = registros[i]["producto_precio"];
                            html += "           "+registros[i]["producto_unidad"]+" Bs : "+precio_unidad.fixed(2)+"";
                            html += "       </option>";
                        
                        }
                        
                        if (rol_factor==1){
                            if(registros[i]["producto_factor"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                                html += "       <option value='producto_factor'>";
                                html += "           "+registros[i]["producto_unidadfactor"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                                html += "       </option>";
                            }
                        }
                        
                        
                        if (rol_factor1==1){
                            if(registros[i]["producto_factor1"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor1"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor1"]) * parseFloat(registros[i]["producto_factor1"]);

                                html += "       <option value='producto_factor1'>";
                                html += "           "+registros[i]["producto_unidadfactor1"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                                html += "       </option>";
                            }
                        }
                            
                        if (rol_factor2==1){
                            if(registros[i]["producto_factor2"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor2"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor2"]) * parseFloat(registros[i]["producto_factor2"]);

                                html += "       <option value='producto_factor2'>";
                                html += "           "+registros[i]["producto_unidadfactor2"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                                html += "       </option>";
                            }
                        }
                        
                        if (rol_factor3==1){                        
                            if(registros[i]["producto_factor3"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor3"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor3"]) * parseFloat(registros[i]["producto_factor3"]);

                                html += "       <option value='producto_factor3'>";
                                html += "           "+registros[i]["producto_unidadfactor3"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                                html += "       </option>";
                            }
                        }
                        
                        if (rol_factor4==1){                        
                            if(registros[i]["producto_factor4"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor4"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor4"]) * parseFloat(registros[i]["producto_factor4"]);

                                html += "       <option value='producto_factor4'>";
                                html += "           "+registros[i]["producto_unidadfactor4"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                                html += "       </option>";
                            }
                        }
                        
                        
                        html += "   </select>";
                        
                        
                        //html += "<br><font size='3'><b>"+registros[i]["producto_codigobarra"]+"</b></font>";                        
                        existencia = parseFloat(registros[i]["existencia"]);
                       
//                       html += "<br><font size='3'><b><input type='text' class='btn btn-danger btn-xs' style='background-color: black' id='input_existencia"+registros[i]["producto_id"]+"' value='DISP: "+existencia+" "+registros[i]["producto_unidad"]+"' readonly='true'></b></font>";
                       
                       if(! esMobil()){
                            if (parseFloat(registros[i]["existencia"])>0){
                                
                                  html += "<br>";
                                  html += "<div class='btn-group'>";
//                                  html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",1)'><b>- 1 -</b></button>";
                                  html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapidojs(1,"+JSON.stringify(registros[i])+")'><b>- 1 -</b></button>";                                  
                                  html +=     "<button class='btn btn-info btn-xs' onclick='ingresorapidojs(2,"+JSON.stringify(registros[i])+")'><b>- 2 -</b></button>";
                                  html +=     "<button class='btn btn-primary btn-xs' onclick='ingresorapidojs(5,"+JSON.stringify(registros[i])+")'><b>- 5 -</b></button>";
                                  html +=     "<button class='btn btn-warning btn-xs' onclick='ingresorapidojs(10,"+JSON.stringify(registros[i])+")'><b>- 10 -</b></button> ";
                                  html += "</div>";   

                            }            
                        }
                      
                        //html += "<textarea name='textarea' rows='10' cols='50'>"+sql+"</textarea>"
                        
                        html += "</center>";
                        if(! esMobil()){
                       
                        html += "</td>";
                        
//                        html += "<td> ";
//                        html += "<center>";
//
//                       
//                        html += "</center>";
//                        html += "</td>";
                        
                        
                        html += "<td style='padding:0;'>";
                        }
                        
                        //html += "<div id='input_existencia"+registros[i]["producto_id"]+"'> <center><font size='3'><b>"+existencia+"</b></font><br>"+registros[i]["producto_unidad"]+"</center></div>";
                    
                        if (parseFloat(registros[i]["existencia"])>0){
                             html += "<button type='button' class='btn btn-facebook btn-xl btn-block' style='padding:0;' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='Añadir al detalle' onclick='focus_cantidad("+registros[i]["producto_id"]+")' >"+mensajeboton+ 
                                    "<center style='line-height:10px;'><font size='2'><span class='btn btn-xs btn-danger' style='padding:0;'> <b>"+formato_numerico(existencia)+"</font><br><font size='1'><sub>"+registros[i]["producto_unidad"]+"</sub></font></b></span></center>"+
                                       "<em style='font-size:20px;' class='fa fa-cart-arrow-down'></em></button>";                             
                        }
                        
                            
                        
                        //html += "<button class='btn btn-success'><i class='fa fa-picture-o'></i></button>";

                        
                        html += "<!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->";
                        html += "<div class='modal fade' id='mostrarimagen"+i+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<img style='max-height: 100%; max-width: 100%' src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' />";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";

                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->";                       
                       
                       
                       
                        html += "<!---------------------- modal cantidad producto ------------------->";
                        
                        html += "<div class='modal fade' id='myModal"+registros[i]["producto_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModal"+registros[i]["producto_id"]+"'>";
                        html += "  <div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "  <div class='modal-header'>";
                        html += "       <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "  </div>";                        
                        html += "  <div class='modal-body' >";
                        
                        html += "  <!----------------------------------------------------------------->";
//                        html += "       <div class='col-md-3'>";
//                        html += "           <img  src='"+base_url+"/"+registros[i]["producto_foto"]+" width='50' heigth='50'>";  
//                        html += "       </div>";
//                        html += "       <div class='col-md-9'>";
                    
                        html += "       <table>"; // style='space-white: nowrap;'
                        html += "           <tr>";
                       
                      
                        html += "               <td>";
                      
                     
                       html += "               <font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "               <br><b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0' step='1' max='"+registros[i]["existencia"]+"' onkeyup='registrar_cantidad(event,"+registros[i]["producto_id"]+")' ></b>";
                        
                        html += "               </td>";
                        html += "          </tr>";
                        html += "       </table>";
                        
//                        html += "       </div>";
                        html += "       <!------------------------------------------------------------------->";
                        html += "  </div>";
                        
                        html += "  <div class='modal-footer aligncenter'>";
                        html += "    <input type='text' id='producto_id' name='producto_id' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>";

                        html += "     <a href='#' data-toggle='modal' id='boton_cantidad"+registros[i]["producto_id"]+"' data-dismiss='modal' onclick='ingresardetallejs("+registros[i]["producto_id"]+","+JSON.stringify(registros[i])+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";
//                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' onclick='ingresardetalle("+registros[i]["producto_id"]+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";

                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' class='btn btn-danger btn-foursquarexs'><font size='5'><span class='fa fa-search'></span></font><br><small>Cancelar</small></a>";
                        html += "  </div>";                        
                        html += "</div>";
                        
                        html += "  </div>";
                        html += "</div>";

                        html += "<!---------------------- fin modal cantidad ---------------------------------> ";

                        html += "</td>";
                        
                        html += "</tr>";

                   }
                 
                   html += " </tbody>";
                   html += "</table>"
                   $("#tablaresultados").html(html);
                   
                   /************** FIN MODO TEXTO ***************/
               }// fin visualizacion modo texto
 
                
                if (modo_visualizacion == 2){
                
                       
                   /************** INICIO MODO GRAFICO ***************/
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
//                    html += "<div class='container'>";
//                    html += "<div class='row'>";
//                    html += "<div class='col-md-12'>";
                    html += "<center>";
         
                    sql = ""; 
                    comilla = "'";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        imagen_boton = "<img src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' class='img "+forma_imagen+"' width='"+ancho_imagen+"' height='"+alto_imagen+"' />";
                 
                        existencia = parseFloat(registros[i]["existencia"])+" "+registros[i]["producto_unidad"]+" | Bs "+registros[i]["producto_precio"];
                        
                        
                        html += "<input type='text' value='"+registros[i]["existencia"]+"' id='existencia"+registros[i]["producto_id"]+"' hidden>";

                        
                        titulo = registros[i]["producto_nombre"]+" | ";
                        titulo += registros[i]["producto_marca"]+" | "+registros[i]["producto_codigobarra"];

                        html += "<input type='text' id='input_unidad"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidad"]+"' hidden>";
                        html += "<input type='text' id='input_unidadfactor"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidadfactor"]+"' hidden>";

                        precio_cantidad = "<div class='padding:0;' id='input_existencia"+registros[i]["producto_id"]+"'> <center><font size='1'><b>"+existencia+"</b></font></center></div>";
                    
                        nombre_producto = registros[i]['producto_nombre'];
                        prod = nombre_producto.substr(0,20);
                        
                        html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='"+nombre_producto+" '>"+imagen_boton+"<br>"+"<sub>"+prod+"</sub>"+precio_cantidad+"</button>";

                        html += "<!---------------------- modal cantidad producto ------------------->";
                        
                        html += "<div class='modal fade' id='myModal"+registros[i]["producto_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModal"+registros[i]["producto_id"]+"'>";
                        html += "  <div class='modal-dialog' role='document'>";

                        html += "<div class='modal-content'>";
                        html += "  <div class='modal-header'>";
                        html += "       <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "  </div>";                        
                        html += "  <div class='modal-body'>";
                        
                        html += "  <!----------------------------------------------------------------->";                  
                        html += "       <center>";
                        html += "       <table style='space-white: nowrap;'>";
                        html += "           <tr>";
                       
                      
                        html += "               <td>";
                      
                     
                        html += "               <font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "               <br><b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0' step='1' max='"+registros[i]["existencia"]+"'></b>";
                        

                        // ******************** inicio select   
//                        html += "<br><select class='btn btn-facebook' style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+registros[i]["existencia"]+","+registros[i]["producto_id"]+")'>";
                        html += "<br><select class='btn btn-facebook' style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+JSON.stringify(registros[i])+")'>";
                        html += "       <option value='1'>";
                        precio_unidad = registros[i]["producto_precio"];
                        html += "           "+registros[i]["producto_unidad"]+" Bs : "+precio_unidad.fixed(2)+"";
                        html += "       </option>";
                        
                        if(registros[i]["producto_factor"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                            html += "       <option value='"+registros[i]["producto_factor"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor"]+" Bs: "+precio_factor.toFixed(2)+"/"+precio_factorcant.toFixed(2);
                            html += "       </option>";
                        }
                                                
                        html += "   </select>";                                                   
                        // ******************** fin  select   
                        
                        
                        html += "               </td>";
                        html += "          </tr>";
                        html += "       </table>";
                        html += "       </center>";
                        
//                        html += "       </div>";
                        html += "       <!------------------------------------------------------------------->";
                        html += "  </div>";
                        
                        html += "  <div class='modal-footer aligncenter'>";
                        html += "    <input type='text' id='producto_id' name='producto_id' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>";

                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' onclick='ingresardetallejs("+registros[i]["producto_id"]+","+JSON.stringify(registros[i])+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";
//                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' onclick='ingresardetalle("+registros[i]["producto_id"]+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";

                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' class='btn btn-danger btn-foursquarexs'><font size='5'><span class='fa fa-search'></span></font><br><small>Cancelar</small></a>";
                        html += "  </div>";                        
                        html += "</div>";
                        
                        html += "  </div>";
                        html += "</div>";

                        html += "<!---------------------- fin modal cantidad ---------------------------------> ";

                   }
                 
                   html += "</center>"

                   $("#tablaresultados").html(html);
                   
                   /************** FIN MODO GRAFICO ***************/
               }// fin visualizacion modo grafico
               
            }
            
                
        },
        error:function(respuesta){
           html = "";
           $("#tablaresultados").html(html);            
        },
        complete: function (jqXHR, textStatus) {
   
            document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
             
            $("#filtrar").focus();
            $("#filtrar").select();
        }
        
    });  
    
 //   $("#encontrados").focus(); //Quita el foco del buscador para que desparezca el teclado android
} 

function eliminardetalleventa()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminardetalle/";
    borrar_datos_cliente();
    
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){         
            tablaproductos();
        },
        error: function(respuesta){         
        }        
    });
}

function cerrar_ventas(){
    
    var answer = window.confirm("¿Desea salir sin guardar cambios?")
    if (answer) {
        //some code
        eliminardetalleventa();
        window.close();
    }
//    else {
//        //some code
//    }

}

function registrarcliente()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/registrarcliente';
    var cliente_id = document.getElementById('cliente_id').value;
    
    var nit = document.getElementById('nit').value;
    var razon = document.getElementById('razon_social').value;
    var telefono = document.getElementById('telefono').value;    
    var tipocliente_id = document.getElementById('tipocliente_id').value;
    
    var cliente_nombre = document.getElementById('cliente_nombre').value;
    var cliente_ci = document.getElementById('cliente_ci').value;
    var cliente_nombrenegocio = document.getElementById('cliente_nombrenegocio').value;    
    var cliente_codigo = document.getElementById('cliente_codigo').value;
    
    var cliente_direccion = document.getElementById('cliente_direccion').value;
    var cliente_departamento = document.getElementById('cliente_departamento').value;
    var cliente_celular = document.getElementById('cliente_celular').value;
    var zona_id = document.getElementById('zona_id').value;
    
    if (Number.isInteger(zona_id)){
        zona_id = document.getElementById('zona_id').value;
    }else{        
        zona_id = 0;
    }
    

//   alert(nit+" ** "+razon+" ** "+telefono+" ** "+cliente_id+" ** "+cliente_nombre+" ** "+tipocliente_id+" ** "+cliente_nombre+" ** "+cliente_ci+" ** "+cliente_nombrenegocio+" ** "+
//           cliente_codigo+" ** "+cliente_direccion+" ** "+cliente_departamento+" ** "+cliente_celular+" ** "+zona_id);
   
    if (cliente_id > 0 || nit==0){ //si el cliente existe debe actualizar sus datos 
        
        // alert(cliente_id+" * "+nit);
        var controlador = base_url+'venta/modificarcliente';
        
        $.ajax({url: controlador,
                    type:"POST",
                    data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_nombre:cliente_nombre, cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id},
                    
                    success:function(respuesta){ 
                        var datos = JSON.parse(respuesta);
                        cliente_id = datos[0]["cliente_id"];
                        
                        //console.log(datos);
                        
                        if(cliente_id>0){
                            registrarventa(cliente_id);                            
                        }
                        else{
                            registrarventa(respuesta);                            
                        }
                    },
                    error: function(respuesta){
                        cliente_id = 0;            
                    }
        });
        
    }
    else{ //Si el cliente es nuevo debe primero registrar al cliente
    
    
    $.ajax({url: controlador,
            type:"POST",
            data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_nombre:cliente_nombre, cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id},
            success:function(respuesta){  
            
                var registro = JSON.parse(respuesta);
                
                cliente_id = registro[0]["cliente_id"];
                registrarventa(cliente_id);
                
            },
            error: function(respuesta){
                cliente_id = 0;            
            }
        });
    }
    
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    //alert(i);
    return i;
}

function fecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);
 
       // return dd+'/'+mm+'/'+yyyy;
        return yyyy+'-'+mm+'-'+dd;
}

function generar_codigo(){
    var hoy = new Date();       
    var dd = hoy.getDate().toString();
    var mm = hoy.getMonth()+1;
    var yyyy = hoy.getYear().toString();
    var hh = hoy.getHours().toString();
    var nn = hoy.getMinutes().toString();
    var ss = hoy.getSeconds().toString();
        
        dd = addZero(dd);
        mm = addZero(mm);
        
        //alert(yyyy+"+"+mm+"+"+dd+"+"+hh+"+"+nn+"+"+ss);
        //alert(yyyy);
 
    return yyyy+mm+dd+hh+nn+ss;
}

function fecha_actual(){
    var cuotas = document.getElementById('cuotas').value;
    var modalidad = document.getElementById('modalidad').value;
    var dia_pago = document.getElementById('dia_pago').value;
    var fecha_inicio = document.getElementById('fecha_inicio').value;
    var dias = 0;
    
    if (modalidad == "MENSUAL") dias = cuotas * 30;
    
    
    var hoy = new Date();
    hoy.setDate(hoy.getDate()+10);
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1;
    var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);
        
   return dd+'/'+mm+'/'+yyyy;
        //return yyyy+'-'+mm+'-'+dd;
}

function numero_venta(){
    var base_url = document.getElementById('base_url').value;
    var controlador = document.getElementById('base_url').value+"venta/numero_ventas";
    
   $.ajax({url: controlador,
           type:"POST",
           data:{},
           async: false, 
           success:function(respuesta){
               
               var resultado = eval(respuesta);
               
                res = resultado[0]["cantidad"];
           },
           error:function(respuesta){
               
             res = 0;
           }
    });     
    
    return res;
}

function registrarventa(cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/registrarventa";    
    
    var forma_id = document.getElementById('forma_pago').value; 
    var tipotrans_id = document.getElementById('tipo_transaccion').value; 
    var usuario_id = document.getElementById('usuario_id').value; 
    var pedido_id = document.getElementById('pedido_id').value; 
    var orden_id = document.getElementById('orden_id').value; 
    var usuarioprev_id = document.getElementById('usuarioprev_id').value; 
    var nit = document.getElementById('nit').value;
    var razon = document.getElementById('razon_social').value;
    
    var moneda_id = 1; 
    var estado_id = 1; 
    
    var venta_fecha = fecha();//retorna la fecha actual  //"date(now())";
    var hora = new Date();
    
    var venta_hora = hora.getHours()+":"+hora.getMinutes()+":"+hora.getSeconds();
    
    var venta_subtotal = document.getElementById('venta_subtotal').value;     
    var venta_descuento = document.getElementById('venta_descuento').value; 
    var venta_total = document.getElementById('venta_totalfinal').value; 
    var venta_efectivo = document.getElementById('venta_efectivo').value; 
    var venta_cambio = document.getElementById('venta_cambio').value; 
    var venta_glosa = "'"+document.getElementById('venta_glosa').value+"'"; 
    var venta_comision = document.getElementById('venta_comision').value; 
    var venta_tipocambio = document.getElementById('venta_tipocambio').value; 
    var detalleserv_id = document.getElementById('detalleserv_id').value;
    var tipo_transaccion = document.getElementById('tipo_transaccion').value;
    var cuotas = document.getElementById('cuotas').value;   
    var cuota_inicial = document.getElementById('cuota_inicial').value;
    var credito_interes = document.getElementById('credito_interes').value;
    var facturado = document.getElementById('facturado').checked;
    var tiposerv_id = document.getElementById('tiposerv_id').value;
    var venta_numeromesa = document.getElementById('venta_numeromesa').value;
    var parametro_modulorestaurante = document.getElementById('parametro_modulorestaurante').value;
   
    
    var venta_numeroventa = 0;
    var venta_tipodoc = 0;
    var entrega_id = 1;
    var entregaestado_id = 1;


    if (parametro_modulorestaurante==1){
        venta_numeroventa = numero_venta();
    }
    
    document.getElementById('boton_finalizar').style.display = 'none'; //mostrar el bloque del loader
   
    if( facturado == 1){     
        venta_tipodoc = 1;}
    else{
        venta_tipodoc = 0;}
    
    
    var cad =   forma_id+","+tipotrans_id+","+usuario_id+","+cliente_id
                +","+moneda_id+","+estado_id+",'"+venta_fecha+"','"+venta_hora+"',"+venta_subtotal
                +","+venta_descuento+","+venta_total+","+venta_efectivo+","+venta_cambio+","+venta_glosa
                +","+venta_comision+","+venta_tipocambio+","+detalleserv_id+","+venta_tipodoc+","+tiposerv_id
                +","+entrega_id+",'"+venta_numeromesa+"',"+venta_numeroventa+","+usuarioprev_id+","+pedido_id+","+orden_id+","+entregaestado_id;
        
     //alert(sql); 
    if (tipo_transaccion==2){
        var cuotas = document.getElementById('cuotas').value;
        var modalidad = document.getElementById('modalidad').value;
        var dia_pago = document.getElementById('dia_pago').value;
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        
        $.ajax({url: controlador,
            type:"POST",
            data:{cad:cad, tipo_transaccion:tipo_transaccion, cuotas:cuotas, cuota_inicial:cuota_inicial, 
                venta_total:venta_total, credito_interes:credito_interes, pedido_id:pedido_id,
                facturado:facturado,venta_fecha:venta_fecha, razon:razon, nit:nit,
                cuotas:cuotas, modalidad:modalidad, dia_pago:dia_pago, fecha_inicio: fecha_inicio,
                venta_descuento:venta_descuento,usuarioprev_id:usuarioprev_id,orden_id:orden_id,
                venta_efectivo:venta_efectivo, venta_cambio:venta_cambio},
            success:function(respuesta){ 
                eliminardetalleventa();
                //if (pedido_id>0){ pedidos_pendientes(); }
            },
            error: function(respuesta){
                alert("Revise los datos de la venta por favor...!");   
            }        
        });   
    
    }
    else
    {
        $.ajax({url: controlador,
            type:"POST",
            data:{cad:cad, tipo_transaccion:tipo_transaccion, cuotas:cuotas, cuota_inicial:cuota_inicial, 
                venta_total:venta_total, credito_interes:credito_interes, pedido_id:pedido_id,
                facturado:facturado,venta_fecha:venta_fecha, razon:razon, nit:nit,
                venta_descuento:venta_descuento,orden_id:orden_id,
                venta_efectivo:venta_efectivo, venta_cambio:venta_cambio},
            success:function(respuesta){ 
                eliminardetalleventa();
                //if (pedido_id>0){ pedidos_pendientes(); }
            },
            error: function(respuesta){
                alert("Revise los datos de la venta por favor...!");   
            }
        });          
    }
        
}

function finalizarventa()
{    
    var monto = document.getElementById('venta_totalfinal').value;
    //var base_url = document.getElementById('base_url').value;
    //var controlador = base_url+'/verificardetalle/'+monto;

    
        if (monto>0)
        {
           document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
           document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader

            registrarcliente();
        }
        else
        {

            //alert('ADVERTENCIA: No tiene registrado ningun producto en el detalle...!!');

            var txt;
            var r = confirm("La venta no tiene ningun detalle o los precios estan en Bs 0.00. \n ¿Desea Continuar?");
            if (r == true) {
                document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
                document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader   

                registrarcliente();
            } 

        }
    
    
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function buscar_ventas()
{
    var base_url    = document.getElementById('base_url').value;
    //var controlador = base_url+"venta";
    var opcion      = document.getElementById('select_ventas').value;
 
    
    if (opcion == 1)
    {
        filtro = " and v.venta_fecha = date(now())";
        mostrar_ocultar_buscador("ocultar");
        
        
    }//pedidos de hoy
    
    if (opcion == 2)
    {
        filtro = " and v.venta_fecha = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }//pedidos de ayer
    
    if (opcion == 3) 
    {
        filtro = " and v.venta_fecha >= date_add(date(now()), INTERVAL -1 WEEK)";//pedidos de la semana
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 4) 
    {   filtro = " ";//todos los pedidos
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    tabla_ventas(filtro);
    //tabla_pedidos(filtro);
}

function buscar_por_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var estado_id = document.getElementById('estado_id').value;
    
    filtro = " and date(pedido_fecha) >= '"+fecha_desde+"'  and  date(pedido_fecha) <='"+fecha_hasta+
            "' and p.estado_id = "+estado_id;
    tabla_pedidos(filtro);

}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function ventas_por_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/mostrar_ventas";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var estado_id = document.getElementById('estado_id').value;
    var usuario_id = document.getElementById('usuario_id').value;
    
   // document.getElementById('oculto2').style.display = 'block'; //ocultar el bloque del loader
    
    filtro = " and v.venta_fecha >= '"+fecha_desde+"'  and  v.venta_fecha <='"+fecha_hasta+
            "' and v.estado_id = "+estado_id;
    
    if (usuario_id > 0){
        filtro += " and v.usuario_id = "+usuario_id;
    } 
    
   // alert(filtro)
    tabla_ventas(filtro);
    
}

//************* inicio  funciones  para emitir factura **************

function cargar_factura(factura){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"detalle_venta/get_detalle_insertar";
    var venta_id = factura.venta_id;
    $.ajax({url: controlador,
            type: "POST",
            data:{venta_id:venta_id}, 
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                if (registros != null){
                    $("#boton_modal_factura").click();
                    cargar_factura2(venta_id);
                    /*html = "";
                    html += "<table>";
                    html += "<tr style='border-style: solid; border-width: 2px; border-color: black; font-family: Arial;'>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>CANT</b></td>";
                    html += "<td align='center' colspan='2' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>DESCRIPCIÓN</b></td>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>P.UNIT</b></td>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>TOTAL</b></td>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";
                    html += "</tr>";
                    var cont = 0;
                    var cantidad = 0;
                    var total_descuento = 0;
                    var total_final = 0;
                    for (var i=0; i< registros.length; i++){
                        cont = cont+1;
                        cantidad += registros[i]['detallefact_cantidad'];
                        total_descuento += registros[i]['detallefact_descuento']; 
                        total_final += registros[i]['detallefact_total'];
                        html += "<tr style='border-top-style: solid;  border-color: black;  border-top-width: 1px;'>";
                        html += "<td align='center' style='padding: 0;'>";
                        html += "<font style='size:7px; font-family: arial'>";
                        html += registros[i]['detallefact_cantidad'];
                        html += "</font>";
                        html += "</td>";
                        html += "<td colspan='2' style='padding: 0; line-height: 10px;'>";
                        html += "<font style='size:7px; font-family: arial;'> ";
                        html += registros[i]['detallefact_descripcion'];
                        if(registros[i]['detallefact_preferencia'].length>0 && registros[i]['detallefact_preferencia']!='null' && registros[i]['detallefact_preferencia']!='-' ){
                            html += registros[i]['detallefact_preferencia']; }

                        if(registros[i]['detallefact_caracteristicas'].length>0 && registros[i]['detallefact_caracteristicas']!='null' && registros[i]['detallefact_caracteristicas']!='-' ) {
                            html += "<br>.nl2br("+registros[i]['detallefact_caracteristicas']+");"; }
                        html += "</font>";
                        html += "</td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_descuento"]).toFixed(2);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_subtotal"]).toFixed(2);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td>&nbsp;";
                        html += "<a onclick='quitardetalle_aux("+registros[i]["detallefact_id"]+", "+venta_id+")' class='btn btn-danger btn-xs' title='Quitar detalle'><span class='fa fa-times'></span> </a>";
                        html += "</td>";
                        html += "</tr>";
                    }
                    html += "</table>";
                           
                $("#generar_nit").val(factura.cliente_nit);
                $("#generar_razon").val(factura.cliente_razon);
                $("#generar_detalle").html(html);
                $("#generar_venta_id").val(factura.venta_id);
                $("#generar_monto").val(Number(factura.venta_total).toFixed(2));*/
                //$("#boton_modal_factura").click();
                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}

function registrar_factura(venta_id){
            
    var base_url = document.getElementById("base_url").value;
    var nit   = document.getElementById("generar_nit").value;
    var razon = document.getElementById("generar_razon").value;
    var monto_factura = document.getElementById("generar_monto").value;
    var controlador = base_url+"venta/generar_factura_detalle_aux";
    $.ajax({url: controlador,
            type: "POST",
            data:{venta_id:venta_id, nit:nit, razon:razon, monto_factura:monto_factura}, 
            success:function(respuesta){
                resultado = JSON.parse(respuesta);
                var factura_id = resultado;
                alert(factura_id);
                alert(base_url+"factura/imprimir_factura_id/"+factura_id+"/1");
                window.open(base_url+"factura/imprimir_factura_id/"+factura_id+"/1", '_blank');
                ventas_por_fecha(); //funcion para volver a mostrar la lista de ventas 
                                    /// puede ser remplazada por otra funcion que se aplique a su modulo o eliminada
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    }) 
            
}
//************* inicio  fin  para emitir factura **************


function ventas_por_parametro()
{
    var parametro = document.getElementById('filtrar').value;

    if (parametro!=''){
        
        if (Number(parametro)>0)        
            filtro = " and v.venta_id = "+parametro;
        else
            filtro = " and cliente_razon like '%"+parametro+"%' ";
        
        tabla_ventas(filtro);
    }
    else{
        alert('ADVERTENCIA: Debe ingresar el número de transacción de una venta...!');
    }
        
}

function tabla_ventas(filtro)
{   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/mostrar_ventas";
    var parametro_modulorestaurante = document.getElementById("parametro_modulorestaurante").value;
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    document.getElementById('oculto2').style.display = 'block'; //mostrar el bloque del loader
    
    $.ajax({url:controlador,
        type:"POST",
        data:{filtro:filtro},
        success: function(response){
            //alert("llega hasta aqui...!");
            //console.log(response);
            
            var cont =  0;
            var cantidad_pedidos = 0;
            var total_pedido = 0;
            var v = JSON.parse(response);
            var nombre_cliente =  "sin nombre";
                
                $("#parametro").val(filtro); // se enviar el parametro a un text para usarlo desde otro metodo despues
                
            
                html = "";

                    var cont = 0;
                    var total_final = 0;
                    var margenes = " style='padding:0'";
                    
                for (var i=0; i< v.length; i++){    

                    cont = cont + 1; 
                    total_final += parseFloat(v[i]['venta_total']);

                    html += "                       <tr>";
                    html += "                       <td "+margenes+">"+cont+"</td>";
                    
                    if (esMobil()){
                        if ((v[i]['cliente_nombre']).length>15){
                            nombre_cliente = v[i]['cliente_nombre'];
                            nombre_cliente = nombre_cliente.substring(0,15)+"...";
                        }
                        else{
                            nombre_cliente = v[i]['cliente_nombre'];
                        }
                    }
                    else{
                        nombre_cliente = v[i]['cliente_nombre'];
                    }
                        
                        
                
                    html += "                       <td style='max-width: 5cm; padding:0;'><font size='3'><b> "+nombre_cliente+"</b></font><sub>  ["+v[i]['cliente_id']+"]</sub>";
                    html += "                           <br>Razón Soc.: "+v[i]['cliente_razon'];
                    html += "                           <br>NIT: "+v[i]['cliente_nit'];
                    html += "                           <br>Telefono(s): "+v[i]['cliente_telefono'];
                    html += "                           <br>Nota: "+v[i]['venta_glosa'];
                    html += "                       </td>";

                    html += "                       <td style='withe-space:nowrap; padding:0;' align='right'>";
                    html += "                           Sub Total "+v[i]['moneda_descripcion']+': '+Number(v[i]['venta_subtotal']).toFixed(2)+"<br>";
                    html += "                           Desc. "+v[i]['moneda_descripcion']+': '+Number(v[i]['venta_descuento']).toFixed(2)+"<br>";
                    html += "                           <!--<span class='btn btn-facebook'>-->";
                    html += "                           <font size='3' face='Arial narrow'> <b>Total "+v[i]['moneda_descripcion']+': '+Number(v[i]['venta_total']).toFixed(2)+"</b></font><br>";
                    html += "                           <!--</span>-->";
                    html += "                               Efectivo "+v[i]['moneda_descripcion']+": "+Number(v[i]['venta_efectivo']).toFixed(2)+"<br>";
                    html += "                               Cambio "+v[i]['moneda_descripcion']+": "+Number(v[i]['venta_cambio']).toFixed(2);
                    html += "                       </td>";

                    html += "                       <td align='center' style='padding:0;'><font size='3'><b> 00"+v[i]['venta_id']+"</b></font>";
                    html += "                           <br><img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='35' height='35'>";
                    html += "                           <br>Vend.: "+v[i]['usuario_nombre'];
                   
                    if (v[i]['prevendedor']!=null){
                        html += "                           <br>Prev.: "+v[i]['prevendedor'];
                    }
                    
                    html += "                        </td>   ";
                    
                    html += "                       <td align='center'  style='padding:0;' bgcolor='"+v[i]['estado_color']+"'>"+v[i]['forma_nombre'];
                    html += "                           <br> "+v[i]['tipotrans_nombre'];
                    html += "                           <br><br><span class='btn btn-facebook btn-xs' ><b>"+v[i]['estado_descripcion']+"</b></span> ";
                    html += "                       </td>";

                    html += "                       <td style='padding:0;'><center>"+formato_fecha(v[i]['venta_fecha']);
                    html += "                           <br> "+v[i]['venta_hora'];
                    html += "                           <br><input type='button' class='btn btn-warning btn-xs' id='boton"+v[i]['venta_id']+"' value='--' style='display:block'>";
                    
                    html += "                       </center>";
                    html += "                       </td>";

//                    html += "                       <td align='center'>";
//                    html += "                           <img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='50' height='50'>";
//                    html += "                           <br>"+v[i]['usuario_nombre'];
//                    html += "                       </td>";

                    html += "                       <td class='no-print' style='padding:0;'>";
//                    html += "                           <a href='"+base_url+"venta/edit/"+v[i]['venta_id']+"' class='btn btn-info btn-xs no-print' target='_blank' title='Modifica los datos generales de la venta'><span class='fa fa-pencil'></span></a>";
                    html += "                           <a href='"+base_url+"venta/modificar_venta/"+v[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modificar el detalle/cliente de la venta'><span class='fa fa-edit'></span></a>";
//                    html += "                           <a href='"+base_url+"venta/nota_venta/"+v[i]['venta_id']+"' class='btn btn-success btn-xs'><span class='fa fa-print'></span></a> ";
                    html += "                           <a href='"+base_url+"factura/imprimir_recibo/"+v[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-print'></span></a> ";
                    html += "                           <a href='"+base_url+"factura/certificado_garantia/"+v[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir certificado de garantia' style='background-color: purple'> <span class='fa fa-lock'></span> </a> ";
                    
                    if (parametro_modulorestaurante==1){
                    html += "                           <a href='"+base_url+"factura/comanda_boucher/"+v[i]['venta_id']+"' class='btn btn-primary btn-xs' target='_blank' title='Imprimir comanda'><span class='fa fa-list'></span></a> ";
                }
                    if (v[i]['venta_tipodoc']==1){
                        html += " <a href='"+base_url+"factura/imprimir_factura/"+v[i]['venta_id']+"/0' target='_blank' class='btn btn-warning btn-xs' title='Ver/anular factura'><span class='fa fa-list-alt'></span></a> ";
                    }
                    else{                        
                        html += " <button class='btn btn-facebook btn-xs' style='background-color:#000;' title='Generar factura' onclick='cargar_factura("+JSON.stringify(v[i])+");'><span class='fa fa-modx'></span></button> ";
                    }
                    
                    html += "<br><br>";
                    
                    if (Number(v[i]['pedido_id'])>0){
                        html += "                                   <a href='"+base_url+"pedido/nota_pedido/"+v[i]['pedido_id']+"' target='_blank' class='btn btn-warning btn-xs' title='Ver nota de pedido'><span class='fa fa-list'></span></a> ";
                    }

                    if (Number(v[i]['orden_id'])>0){
                        html += "                                   <a href='"+base_url+"orden_trabajo/ordenrecibo/"+v[i]['orden_id']+"' target='_blank' class='btn btn-default btn-xs' title='Ver Orden de Trabajo'><span class='fa fa-list'></span></a> ";
                    }
                    
                    
                    html += "                           <!--<a href='<?php echo site_url('venta/eliminar_venta/'.$v[i]['venta_id']); ?>' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>-->";
                    html += "                           <button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+v[i]['venta_id']+"'  title='Anular venta'><em class='fa fa-ban'></em></button>";
                    html += "                       <!------------------------ modal para eliminar el producto ------------------->";
                    html += "                               <div class='modal fade' id='myModal"+v[i]['venta_id']+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+v[i]['venta_id']+"'>";
                    html += "                                 <div class='modal-dialog' role='document'>";
                    html += "                                       <br><br>";
                    html += "                                   <div class='modal-content'>";
                    html += "                                     <div class='modal-header'>";
                    html += "                                       <h1 class='modal-title' id='myModalLabel'>ADVERTENCIA</h1>";
                    html += "                                     </div>";
                    html += "                                     <div class='modal-body'>";
                    html += "                                         <div class='panel panel-primary'>";
                    html += "                                             ";
                    html += "                                         <center>";
                    html += "                                      <!------------------------------------------------------------------->";
                    html += "                                      <h1 style='font-size: 80px'> <b> <em class='fa fa-trash'></em></b></h1> ";
                    html += "                                      <h4>";
                    html += "                                          ";
                    html += "                                          ¿Desea anular la venta? <b> <br>";
                    html += "                                          Trans.: "+v[i]['venta_id']+"<br>";
                    if ((v[i]['pedido_id'])>0){
                            html += "<b class='btn btn-warning'><b> ADVERTENCIA: Se restablecera el PEDIDO Nº: "+v[i]['pedido_id']+" a PENDIENTE</b> </b>" ;
                    }
//                    html += "                                          -----------------------------<br>";
//                    html += "                                          La venta tiene una FACTURA ASOCIADA<br>";
//                    html += "                                          <input type='checkbox' name='anular_factura' value='1'> Anular factura<br>";
                    html += "                                      </h4>";
                    html += "                                      <!------------------------------------------------------------------->";
                    html += "                                             ";
                    html += "                                         </center>";
                    html += "                                         </div>";
                    html += "                                     </div>";
                    html += "                                     <div class='modal-footer aligncenter'>";
                    html += "                                         <center>";                                        
                    html += "                                           <a href='"+base_url+"venta/anular_venta/"+v[i]['venta_id']+"' class='btn btn-danger  btn-sm'><em class='fa fa-pencil'></em> Si </a>";

                    html += "                                           <a href='#' class='btn btn-success btn-sm' data-dismiss='modal'><em class='fa fa-times'></em> No </a>";
                    html += "                                         </center>";

                    html += "                                     </div>";
                    html += "                                   </div>";
                    html += "                                 </div>";
                    html += "                               </div>";

                    html += " <!------------------------ fin modal --------------------------------->   ";                       

                    html += "                           ";
//                    html += "                           <?php if ($parametro[0]['parametro_tipoimpresora']=='FACTURADORA'){ ?>";
//                    html += "                                       <?php if($v[i]['venta_tipodoc']){ $formato_boton = 'btn btn-warning btn-xs'; $mensaje_title = 'Ver factura';} ";
//                    html += "                                           else { $formato_boton = 'btn btn-facebook btn-xs';  $mensaje_title = 'Ver nota de venta'; }";
//                    html += "                                       ?>";
//                    html += "                                   ";

//                    html += "                           ";
//                    html += "                           <?php } else{ ?>";
//                    html += "                                   ";
//                    html += "                                   <a href='<?php echo site_url('factura/factura_carta/'.$v[i]['venta_id']); ?>' class='<?php echo $formato_boton; ?>' title='<?php echo $mensaje_title; ?>'><span class='fa fa-list-alt'></span></a>";
//                    html += "                           ";
//                    html += "                           <?php } ?>";
                    html += "                       </td>";
                    html += "                    </tr>";
//                    html += "                    <?php } ?>";
                }
                    html += "                   <tr>";
                    html += "                        <th></th>";
                    html += "                        <th>Totales</th>";
                    html += "                        <th><font size='3'> Bs: "+total_final.toFixed(2)+"</font></th>	";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                  
                    html += "                    </tr> ";
            $("#tabla_ventas").html(html);
            document.getElementById('oculto').style.display = 'none'; //mostrar el bloque del loader
            document.getElementById('oculto2').style.display = 'none'; //ocultar el bloque del loader
        }        
    });    
            document.getElementById('oculto').style.display = 'none'; //mostrar el bloque del loader
}

function montrar_ocultar_fila(parametro)
{
           
    if (parametro == "mostrar"){
        document.getElementById('fila_producto').style.display = 'block';}
    else{
        document.getElementById('fila_producto').style.display = 'none';}
    
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

function eliminar_producto_vendido(detalleven_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador =  base_url+"venta/eliminar_producto_vendido/"+detalleven_id;
    
    $.ajax({url:controlador,
        type:"POST",
        data:{},
        success: function(response){ 
                
                }
            });
            
    location.reload();
}

function borrar_datos_cliente()
{
    var modulo_restaurante = document.getElementById("parametro_modulorestaurante").value;
    $("#nit").val(0);
    $("#razon_social").val("SIN NOMBRE");
    $("#cliente_id").val("0");
    $("#cliente_nombre").val("SIN NOMBRE");
    $("#cliente_ci").val("0");
    $("#cliente_nombrenegocio").val("-");
    $("#cliente_codigo").val("0");
    $("#pedido_id").val("0");
    $("#usuarioprev_id").val("0");
    
    $("#cliente_direccion").val("-");
    $("#cliente_departamento").val("-");
    $("#cliente_celular").val("-");
    $("#tipocliente_id").val("1");
    $("#cliente_telefono").val("-");
    
    $("#tiposerv_id").val("1");
    $("#venta_numeromesa").val("0");
    $("#venta_glosa").val("");  
    
    $("#venta_efectivo").val("0");
    $("#venta_cambio").val("0");
    $("#zona_id").val("0");
     
    document.getElementById("forma_pago").selectedIndex = 0
    document.getElementById("tipo_transaccion").selectedIndex = 0
    document.getElementById("tipo_transaccion").selectedIndex = 0
    document.getElementById('creditooculto').style.display = 'none';
                    //document.getElementById('creditooculto').style.display = 'none';
    
    $("#filtrar").focus();
    
    var facturado = document.getElementById('facturado').checked;      

    //Imprimir la factura
    
    if (facturado == 1){
        var boton = document.getElementById("imprimir_factura");
        boton.click();                    
    }
    
    //Si esta actuvo el modulo para restaurante
    if (modulo_restaurante == 1){
        boton = document.getElementById("imprimir_comanda");
        boton.click();                    
    } 
    
    document.getElementById('boton_finalizar').style.display = 'block'; //mostrar el bloque del loader
    tablaproductos();
    
    tablaresultados(1); //redibuja la tabla de busqueda de productos      
    
    document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
    document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader
}

function verificar_ventas()
{
    var base_url = document.getElementById('base_url').value;    
    var parametro = document.getElementById('parametro').value;
    var controlador = base_url+'venta/verificar_ventas';
     
    $.ajax({url: controlador,
        type:"POST",
        data:{filtro: filtro},
        success:function(respuesta){
            
            var res = JSON.parse(respuesta);
            var max = res.length;
            var precio_anterior = 0;
            var precio_nuevo = 0;
            var duplicado = 0;
            
            for (var i = 0; i<max; i++){
                
                precio_nuevo = res[i]["venta"];
                
                if(precio_nuevo == precio_anterior)
                    duplicado = "DUPLICADO";
                else
                    duplicado = "";
                
                if (res[i]["resultado"] == 1){
                    
                    botoncito = "#boton"+res[i]["venta_id"];                    
//                    nombreboton = "boton"+res[i]["venta_id"];                    
                   //botoncito2 = "boton"+res[i]["venta_id"];
                    
                    $(botoncito).val("CONFLICTO | Items: "+res[i]["items"]+"\n"+duplicado);
//                    document.getElementById(nombreboton).style.display = 'block';                                        
                    
                }
                else{
                    
                    botoncito = "#boton"+res[i]["venta_id"];
                    
//                    document.getElementById(botoncito).style.display = 'block'; 
                    $(botoncito).val(" - OK - | Items: "+res[i]["items"]+"\n"+duplicado);
                   
                    
                }
                precio_anterior = precio_nuevo;                                
            }
          
           // document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader

        },
        complete: function (jqXHR, textStatus) {
        //    document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
        }
    });   
      
}

function costo_cero()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/costo_cero";
    var txt;
    var r = confirm("Los precios y costos serán cambiados a 0 (cero).\n Esta operación no será reversible.\n¿Desea Continuar?");
    if (r == true) {
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){         
                tablaproductos();
            },
            error: function(respuesta){         
            }        
        });

    }
}

function precio_costo()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/precio_costo";
    var txt;
    var r = confirm("Los precios de venta serán igualados al costo. \n Esta operación no será reversible.\n¿Desea Continuar?");
    if (r == true) {
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tablaproductos();
            },
            error: function(respuesta){
            }
        });
    }
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
    var controlador = base_url+"venta/seleccionar_cliente/"+cliente_id;
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
                    $("#cliente_ci").val(resultado[0]["cliente_ci"]);     
                    $("#cliente_nombrenegocio").val(resultado[0]["cliente_nombrenegocio"]);
                    $("#cliente_codigo").val(resultado[0]["cliente_codigo"]);  
                    $("#tipocliente_id").val(resultado[0]["tipocliente_id"]);  
                    $("#cliente_direccion").val(resultado[0]["cliente_direccion"]);
                    $("#cliente_departamento").val(resultado[0]["cliente_departamento"]);
                    $("#cliente_celular").val(resultado[0]["cliente_celular"]);
                    if(registros[0]["zona_id"] != null && registros[0]["zona_id"] >=0){
                        $("#zona_id").val(resultado[0]["zona_id"]);
                    }else{
                        $("#zona_id").val(0);
                    }
                    //$("#zona_id").val(resultado[0]["zona_id"]);
                    $("#codigo").select();
                }
       

            },
            error: function(respuesta){
            }
        });    
    
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
            $("#usuarioprev_id").val(usuariopedido_id);
            tablaproductos();
            datoscliente(cliente_id);
        },
        error: function(respuesta){
            tablaproductos();
            datoscliente(cliente_id);
        }
    });
   
}

function ordenaventas(orden_id,usuario_id,cliente_id)
{
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"orden_trabajo/pasaraventas/"+orden_id+"/"+cliente_id;
    var usuariopedido_id = usuario_id;
    var acuenta = document.getElementById('acuenta'+orden_id).value;
    
    //alert("usario_id"+usuario_id);
  
   
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){  
            
            $("#orden_id").val(orden_id);
            $("#pedido_id").val(0);
            $("#usuarioprev_id").val(usuariopedido_id);
            $("#cuota_inicial").val(acuenta);
            $("#tipo_transaccion").val(2); // select a credito
                        
            document.getElementById('creditooculto').style.display = 'block';
            tablaproductos();
            datoscliente(cliente_id);
        },
        error: function(respuesta){
            tablaproductos();
            datoscliente(cliente_id);
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
            $("#tipocliente_id").val(datos[0]["tipocliente_id"]);  
            $("#cliente_nombre").val(datos[0]["cliente_nombre"]);
            $("#cliente_ci").val(datos[0]["cliente_ci"]);     
            $("#cliente_nombrenegocio").val(datos[0]["cliente_nombrenegocio"]);
            $("#cliente_codigo").val(datos[0]["cliente_codigo"]);  
            $("#cliente_direccion").val(datos[0]["cliente_direccion"]);  
            $("#cliente_departamento").val(datos[0]["cliente_departamento"]);  
            $("#cliente_celular").val(datos[0]["cliente_celular"]);  
            $("#codigo").select();
        }
        
    });
   
}   

function actualizar_caracteristicas(detalleven_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/registrar_caracteristicas";
    var preferencia = document.getElementById('detalleven_preferencia'+detalleven_id).value;
    //alert(preferencia);
    var caracteristicas = document.getElementById('detalleven_caracteristicas'+detalleven_id).value;
    var costo = document.getElementById('detalleven_costo'+detalleven_id).value;
    
    var micheck = document.getElementById('check'+detalleven_id).checked;
    var cantidadenvase = document.getElementById('cantidadenvase'+detalleven_id).value;
    var garantia = document.getElementById('garantia'+detalleven_id).value;
    var fecha_vencimiento = document.getElementById('fecha_vencimiento'+detalleven_id).value;
    //alert(fecha_vencimiento);
    var check = 0;
    //alert(micheck+" "+garantia+" "+cantidadenvase);
    
    if (micheck){
        check = 1;
    }
    else{
        check = 0;        
        cantidadenvase = 0;
        garantia = 0
    }
    
    $.ajax({url: controlador,
        type:"POST",
        data:{detalleven_id:detalleven_id, preferencia:preferencia, caracteristicas:caracteristicas, check:check,
            cantidadenvase:cantidadenvase, garantia:garantia, fecha_vencimiento:fecha_vencimiento, costo:costo},
        success:function(result){
            tablaproductos();
        }
    });
   
}   

function verificador()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"factura/codigocontrol";
    
    var llave = document.getElementById('factura_llave').value;
    var autorizacion = document.getElementById('factura_autorizacion').value;
    var numero = document.getElementById('factura_numero').value;
    var nit = document.getElementById('factura_nit').value;
    var fecha = document.getElementById('factura_fecha').value;
    var monto = document.getElementById('factura_total').value;
    var bandera = 1;
    //alert(llave+" | "+autorizacion+" | "+numero+" | "+nit+" | "+fecha+" | "+monto);
        
    $.ajax({url: controlador,
        type:"POST",
        data:{llave:llave,autorizacion:autorizacion,numero:numero,nit:nit,fecha:fecha,monto:monto, bandera:bandera},
        success:function(result){
            var codigo = eval(result);
           // alert(codigo);
            $('#factura_codigocontrol').val(codigo[0]['codigocontrol']);
            
        }

    });
}

function limpiar_parametros()
{
//    var base_url = document.getElementById('base_url').value;
//    var controlador = base_url+"factura/codigocontrol";
    
    $("#factura_llave").val("");
    $("#factura_autorizacion").val("");
    $("#factura_numero").val("");
    $("#factura_nit").val("");
    $("#factura_fecha").val("");
    $("#factura_total").val("");
    $("#factura_codigocontrol").val("");
    
}

function modificar_venta(cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/modificar_detalle';
    var venta_id = document.getElementById('venta_id').value;
    var venta_fecha = document.getElementById('venta_fecha').value;
    var venta_subtotal = document.getElementById('venta_subtotal').value;
    var venta_descuento = document.getElementById('venta_descuento').value;
    var venta_total = document.getElementById('venta_total').value;
    var venta_efectivo = document.getElementById('venta_efectivo').value;
    var venta_cambio = document.getElementById('venta_cambio').value;
    var modificar_credito = document.getElementById('modificar_credito').value;
    var credito_id = document.getElementById('credito_id').value;
    
    var cuotas = document.getElementById('cuotas').value;
    var modalidad = document.getElementById('modalidad').value;
    var dia_pago = document.getElementById('dia_pago').value;
    var fecha_inicio = document.getElementById('fecha_inicio').value;
    var credito_interes = document.getElementById('credito_interes').value;
    var cuota_inicial = document.getElementById('cuota_inicial').value;
    var tipo_transaccion = document.getElementById('tipo_transaccion').value;
    var forma_pago = document.getElementById('forma_pago').value;
    var facturado = document.getElementById('facturado').value;
    

        $.ajax({url: controlador,
            type:"POST",
            data:{venta_id:venta_id, cliente_id:cliente_id, venta_fecha:venta_fecha,venta_subtotal:venta_subtotal,
            venta_descuento:venta_descuento, venta_total:venta_total, venta_efectivo:venta_efectivo, venta_cambio:venta_cambio, 
            modificar_credito:modificar_credito, credito_id: credito_id, 
            tipo_transaccion:tipo_transaccion, cuotas:cuotas, cuota_inicial:cuota_inicial, 
            venta_total:venta_total, credito_interes:credito_interes,
            facturado:facturado,venta_fecha:venta_fecha, tipo_transaccion:tipo_transaccion, forma_pago:forma_pago,
            modalidad:modalidad, dia_pago:dia_pago, fecha_inicio: fecha_inicio},
            success:function(respuesta){
                //window.opener.location.reload();
                window.close();
                //alert("Cambios Guardados...!");
            },
            error: function(respuesta){
                alert("Revise los datos de la venta por favor...!");   
            }
        });          

}


function registrarcliente_modificado()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/registrarcliente';
    var nit = document.getElementById('nit').value;
    var razon = document.getElementById('razon_social').value;
    var telefono = document.getElementById('telefono').value;
    var cliente_nombre = document.getElementById('cliente_nombre').value; 
    var cliente_id = document.getElementById('cliente_id').value;
    var tipocliente_id = document.getElementById('tipocliente_id').value;
    var cliente_ci = document.getElementById('cliente_ci').value;
    var cliente_nombrenegocio = document.getElementById('cliente_nombrenegocio').value;    
    var cliente_codigo = document.getElementById('cliente_codigo').value;    
    var cliente_direccion = document.getElementById('cliente_direccion').value;
    var cliente_departamento = document.getElementById('cliente_departamento').value;
    var cliente_celular = document.getElementById('cliente_celular').value;    
    var zona_id = document.getElementById('zona_id').value;    
    
   
    if (cliente_id > 0 || nit==0){ //si el cliente existe debe actualizar sus datos 
        //alert("nit:"+nit+",razon:"+razon+",telefono:"+telefono+",cliente_id:"+cliente_id+", cliente_nombre:"+cliente_nombre)
        // alert(cliente_id+" * "+nit);
        var controlador = base_url+'venta/modificarcliente';
        //alert("Por aqui..."+controlador);
        
        $.ajax({url: controlador,
                type:"POST",
                data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id},
                success:function(respuesta){ 
                    var datos = JSON.parse(respuesta)
                    cliente_id = datos[0]["cliente_id"];

                    if(cliente_id>0){
                        modificar_venta(cliente_id);                            
                    }
                    else{
                        modificar_venta(respuesta);                            
                    }
                },
                error: function(respuesta){
                    cliente_id = 0;            
                }
        });
        
    }
    else{ //Si el cliente es nuevo debe primero registrar al cliente
    
    $.ajax({url: controlador,
            type:"POST",
            data:{nit:nit,razon:razon,telefono:telefono},
            success:function(respuesta){  
            
                var registro = JSON.parse(respuesta);
                
                cliente_id = registro[0]["cliente_id"];
                //registrarventa(cliente_id);
                modificar_venta(cliente_id);
                
            },
            error: function(respuesta){
                cliente_id = 0;            
            }
        });
    }
    
}

function finalizarcambios()
{    
    var monto = document.getElementById('venta_totalfinal').value;

    if (monto>0)
    {
        $("#diventas1").style = "display:block";
        $("#diventas0").style = "display:none";
        
        registrarcliente_modificado();
    }
    else
    {
        var txt;
        var r = confirm("La venta no tiene ningun detalle o los precios estan en Bs 0.00. \n ¿Desea Continuar?");
        if (r == true) {
          registrarcliente_modificado();
        } 
        //document.getElementById("demo").innerHTML = txt;
    }
}

function cerrar(){
    window.close();
}

function seleccionar_cantidad(parametro)
{
    $("#"+parametro).select();
}

function actualizar_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_inventario/";
    
    document.getElementById('oculto').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El inventario se actualizo exitosamente...! ');
            //redirect('inventario/index');
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            //tabla_inventario();
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
    });   
      
}

function ocultar_busqueda(){
    var html = "";
    
    $("#tablaresultados").html("");
}

function asignar_inventario(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'/venta/asignar_inventario';
    var usuario_id = document.getElementById('usuario_idx').value;
    var venta_totalfinal = document.getElementById('venta_totalfinal').value;

    document.getElementById('botones').style.display = 'none'; //ocultar botones
    document.getElementById('loaderinventario').style.display = 'block'; //mostrar el bloque del loader 

    if (usuario_id>0){
        if (venta_totalfinal>0){
            $.ajax({
                url:controlador,
                type:"POST",
                data:{usuario_id:usuario_id},
                success:function(respuesta){
                    quitartodo();
                    $('#cerrar_modalasignar').click();
                },                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  

            });
        }
        else {  alert("ERROR: Debe tener productos en el detalle..!");  }
    }
    else
    {
        alert("Debe seleccionar un usuario.!");      
    }
    

    document.getElementById('botones').style.display = 'block'; //ocultar botones
    document.getElementById('loaderinventario').style.display = 'none'; //mostrar el bloque del loader 
    
}


function iniciar_preferencia(detalleven_id)
{
    //var detalleven_id = document.getElementById("detalleven_id").value;
    $("#detalleven_id").val(detalleven_id);
}


function agregar_preferencia(preferencia_id)
{
    
    var preferencia = document.getElementById('pref'+preferencia_id).name;
    var input = document.getElementById('inputcaract').value;
    var cadena = input+preferencia+"|";
    
    $("#inputcaract").val(cadena);
    //alert(preferencia);
    
}

function cancelar_preferencia()
{    
    $("#inputcaract").val("");
}

function guardar_preferencia()
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'/venta/guardar_preferencia';

    var preferencia = document.getElementById('inputcaract').value;
    var detalleven_id = document.getElementById('detalleven_id').value;
    
    $.ajax({
        url:controlador,
        type:"POST",
        data:{preferencia:preferencia,detalleven_id:detalleven_id},
        success:function(respuesta){
            tablaproductos();
        },                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  

    });
    
    $("#inputcaract").val("");   
    
}

function focus_efectivo(){
    
        $('#modalfinalizar').on('shown.bs.modal', function() {
        $('#venta_efectivo').focus();
        $('#venta_efectivo').select();
    });
}

function focus_ingreso_rapido(){
    
        $('#modalingreso').on('shown.bs.modal', function() {
        $('#ingresorapido_cantidad').focus();
        $('#ingresorapido_cantidad').select();
    });
}

function focus_cantidad(producto_id){
    
//    alert(producto_id);
        var campo = "cantidad"+producto_id;
    
        $('#myModal'+producto_id).on('shown.bs.modal', function() {
        $('#'+campo).focus();
        $('#'+campo).select();
    });
}

function pedidos_pendientes()
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'/pedido/mostrar_pedidos';
    var parametro = document.getElementById('filtrar3').value;
    
    if (parametro != null)
        filtro = " and c.cliente_nombre like '%"+parametro+"%' and p.estado_id = 11 ";
    else
        filtro = 0;
    
        
    $.ajax({
        url:controlador,
        type:"POST",
        data:{filtro:filtro},
        success:function(respuesta){
                var p = JSON.parse(respuesta);
                html = "";
                //alert("aqui tambien: "+p.length);
                            
                if (p.length>0){
                cont = 0;
                
                for(var i=0; i<p.length; i++){
                     cont = cont+1;
                    
                     
                        html += "<tr>";
                        html += "     <td>"+cont+"</td>";
                        html += "     ";
                        html += "     <td style='white-space: nowrap'><font size='3'><b>"+p[i]['cliente_nombre']+"</b></font>";
                        if (p[i]['cliente_nombrenegocio']!=null && p[i]['cliente_nombrenegocio']!=""){                        
                            html += "     <br>"+p[i]['cliente_nombrenegocio'];
                        }
                        html += "     <br>"+p[i]['pedido_fecha'];
                        html += "     <br><small><b>PREVENTISTA:</b> "+p[i]['usuario_nombre']+"</small>";
                        html += "     </td>";
                        html += "     <td align='center' bgcolor='"+p[i]['estado_color']+"'>";
                        //html += "         <a href='<?php echo base_url('pedido/pedidoabierto/'.$p[i]['pedido_id']); ?>'>";
                        html += "         <font size='3'><b> 00"+p[i]['pedido_id']+"</b></font> <br>";
                        html += "         <font size='1'>"+p[i]['estado_descripcion']+"</font>";
                        html += "         </a>";
                        html += "         <b>"+p[i]['pedido_fechaentrega']+"</b> <br>"+p[i]['pedido_horaentrega'];
                        html += "     </td>";
                        html += "      ";
                        html += "     ";
                        html += "     <td align='right' style='white-space: nowrap' >Sub Total: "+p[i]['pedido_subtotal']+"<br>";
                        html += "		Desc.: "+p[i]['pedido_descuento']+"<br>  ";
                        html += "	    <font size='3'><b>"+p[i]['pedido_total']+"</b></font>";
                        html += "     </td>";

                        html += "     <td>";
                        //html += "         <a href='<?php echo site_url('pedido/pedidoabierto/'.$p[i]['pedido_id']); ?>' class='btn btn-success btn-sm'><span class='fa fa-cubes' title='Ver detalle del pedido'></span></a>";
                        html += "         <button  class='btn btn-warning btn-sm' data-dismiss='modal' onclick='pasaraventas("+p[i]['pedido_id']+","+p[i]['usuarioprev_id']+","+p[i]['cliente_id']+")'><span class='fa fa-arrow-down' title='Cargar pedido a ventas'></span> </button>";
                        html += "     </td>";
                        html += " </tr>";
                    
                    }
                }
                $("#pedidos_pendientes").html(html);
                

        },                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  

    });
    
}

function ordenes_pendientes()
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'/orden_trabajo/ordenes_pendientes';
    var parametro = document.getElementById('filtrar4').value;
    
//    if (parametro != null)
//        filtro = " and c.cliente_nombre like '%"+parametro+"%' and p.estado_id = 11 ";
//    else
//        filtro = 0;
//    
    filtro = "";
        
    $.ajax({
        url:controlador,
        type:"POST",
        data:{filtro:filtro},
        success:function(respuesta){
                var p = JSON.parse(respuesta);
                html = "";
                //alert("aqui tambien: "+p.length);
                            
                //alert("elementos: "+p.length);
                
                if (p.length>0){
                cont = 0;
                
                for(var i=0; i<p.length; i++){
                     cont = cont+1;
                    
                    // alert(p[i]['usuario_id']);
                        html += "<tr>";
                        html += "     <td>"+cont+"</td>";
                        html += "     ";
                        html += "     <td style='white-space: nowrap'><font size='3'><b>"+p[i]['cliente_nombre']+"</b></font>";
                        
                        html += "     <br>"+p[i]['orden_fechaentrega'];
                        html += "     <br><small><b>VENDEDOR:</b> "+p[i]['usuario_nombre']+"</small>";
                        html += "     </td>";
                        html += "     <td align='center' bgcolor='"+p[i]['estado_color']+"'>";
                        //html += "         <a href='<?php echo base_url('pedido/pedidoabierto/'.$p[i]['pedido_id']); ?>'>";
                        html += "         <font size='3'><b> 00"+p[i]['orden_numero']+"</b></font> <br>";
                        html += "         <font size='1'>"+p[i]['estado_descripcion']+"</font><br>";
                        html += "         </a>";
                        html += "         "+p[i]['orden_fecha']+" <br>"+p[i]['orden_hora'];
                        html += "         <input type='text' id='acuenta"+p[i]['orden_id']+"' value='"+p[i]['orden_acuenta']+"' hidden>";
                        html += "     </td>";
                        html += "      ";
                        html += "     ";
                        html += "     <td align='right' style='white-space: nowrap'><font size='3'><b>Total: "+p[i]['orden_total']+"</b></font><br>";
                        html += "	 a Cuenta: "+p[i]['orden_acuenta']+"<br>  ";
                        html += "	    Saldo: "+p[i]['orden_saldo']+"";
                        html += "     </td>";

                        html += "     <td>";
                        html += "         <button  class='btn btn-warning btn-sm' data-dismiss='modal' onclick='ordenaventas("+p[i]['orden_id']+","+p[i]['usuario_id']+","+p[i]['cliente_id']+")'><span class='fa fa-arrow-down' title='Cargar OT a ventas'></span> </button>";
                        html += "     </td>";
                        html += " </tr>";
                    
                    }
                }
                $("#ordenes_pendientes").html(html);
                

        },                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  

    });
    
}
/* elimina un detalle de factura aux */
function quitardetalle_aux(detallefact_id, venta_id){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"detalle_venta/quitar_detalle_aux";
    $.ajax({url: controlador,
            type: "POST",
            data:{detallefact_id:detallefact_id}, 
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                if (registros != null){
                    cargar_factura2(venta_id);
                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}
function cargar_factura2(venta_id){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"detalle_venta/get_detalle_factura_aux";
    //$("#modalfactura").modal('hide');
    $.ajax({url: controlador,
            type: "POST",
            data:{venta_id:venta_id}, 
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                if (registros.length>0){
                    html = "";
                    html += "<table style='width:100%;'>";
                    
                    html += "<tr style='border-style: solid; border-width: 2px; border-color: black; font-family: Arial; font-size:12px; font-weight: bold;'>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b>CANT</b></td>";
                    html += "<td align='center' colspan='2' style='background-color: #000; color:white;'><b>DESCRIPCIÓN</b></td>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b>P.UNIT. </b></td>";
                    html += "<td align='center' style='background-color: #000; color:white; width:5px;'><b></b> </td>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b>TOTAL</b></td>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b></b></td>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b></b></td>";
                    html += "</tr>";
                    
                    var cont = 0;
                    var cantidad = 0;
                    var total_descuento = 0;
                    var total_final = 0;
                    for (var i=0; i< registros.length; i++){
                        cont = cont+1;
                        cantidad += registros[i]['detallefact_cantidad'];
                        total_descuento += registros[i]['detallefact_descuento']; 
                        total_final += Number(registros[i]['detallefact_total']);
                        html += "<tr style='border-top-style: solid; border-color: black;  border-top-width: 1px; font-family: Arial; font-size:10px; '>";
                        html += "<td align='center' style='padding: 0;'>";
                        html += "<font style='size:7px; font-family: arial'>";
                        html += registros[i]['detallefact_cantidad'];
                        html += "</font>";
                        html += "</td>";
                        html += "<td colspan='2' style='padding: 0; line-height: 10px;'>";
                        html += "<font style='size:7px; font-family: arial;'> ";
                        html += registros[i]['detallefact_descripcion'];
                        if(registros[i]['detallefact_preferencia'].length>0 && registros[i]['detallefact_preferencia']!='null' && registros[i]['detallefact_preferencia']!='-' ){
                            html += registros[i]['detallefact_preferencia']; }

                        if(registros[i]['detallefact_caracteristicas'].length>0 && registros[i]['detallefact_caracteristicas']!='null' && registros[i]['detallefact_caracteristicas']!='-' ) {
                            html += "<br>.nl2br("+registros[i]['detallefact_caracteristicas']+");"; }
                        html += "</font>";
                        html += "</td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_precio"]).toFixed(2);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_subtotal"]).toFixed(2);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td>&nbsp;";
                        html += "<a onclick='quitardetalle_aux("+registros[i]["detallefact_id"]+", "+venta_id+")' class='btn btn-danger btn-xs' title='Quitar detalle'><span class='fa fa-times'></span> </a>";
                        html += "</td>";
                        html += "</tr>";
                    }
                    html += "</table><br>";
                           
                    $("#generar_nit").val(registros[0]['cliente_nit']);
                    $("#generar_razon").val(registros[0]['cliente_razon']);
                    $("#generar_detalle").html(html);
                    $("#generar_venta_id").val(registros[0]['venta_id']);
                    $("#generar_monto").val(Number(total_final).toFixed(2));
                    
                    if (esMobil()){
                        $("#botonaniadir").html("<a onclick='aniadirdetalleaux("+venta_id+")' class='btn btn-sm btn-success btn-block' class='form-control'><span class='fa fa-plus'></span>  Añadir al detalle</a>");
                    }
                    else{
                        $("#botonaniadir").html("<a onclick='aniadirdetalleaux("+venta_id+")' class='btn btn-xs btn-success' class='form-control'><span class='fa fa-plus'></span></a>");
                    }
                    
                    $("#registrar_factura").html("<button class='btn btn-facebook btn-block' id='boton_asignar' onclick='registrar_factura("+venta_id+")' data-dismiss='modal' ><span class='fa fa-floppy-o'></span> Generar Factura</button>");
                    
                    /*if(click_show == 1){
                        $("#boton_modal_factura").click();
                    }else{
                        $("#boton_modal_factura").modal('show');
                    }*/
                }else{
                    $("#boton_modal_factura").click();
                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}

function mostrarocultarcampos(){
    obj = document.getElementById('mostrarocultar');
    obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
    if(obj.style.visibility == 'hidden'){
        $('#mostrarocultar').css({ 'width':'0px', 'height':'0px' });
    }else{
        $('#mostrarocultar').css({ 'width':'100%', 'height':'100%' });
    }
}

function aniadirdetalleaux(venta_id){
    var base_url = document.getElementById("base_url").value;
    var cantidad = document.getElementById("cantidad_id").value;
    var descripcion = document.getElementById("descripcion").value;
    var precio_unitario = document.getElementById("precio_unitario").value;
    
    var controlador = base_url+"detalle_venta/insert_detalle_factura_aux";
    //$("#modalfactura").modal('hide');
    $.ajax({url: controlador,
            type: "POST",
            data:{venta_id:venta_id, cantidad:cantidad, descripcion:descripcion, precio_unitario:precio_unitario}, 
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                if (registros != null){
                    $("#cantidad_id").val("");
                    $("#descripcion").val("");
                    $("#precio_unitario").val("");
                    $("#precio_subtotal").val("");
                    cargar_factura2(venta_id);
                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}

function imprimir_factura(){
    
    var base_url = document.getElementById("base_url").value;
    var tipo = document.getElementById("select_imprimir_factura").value; 
    
    if(tipo==1){ // 1 Imprimir original
        window.open(base_url+'venta/ultimaventa/1', '_blank');
    }
    
    if(tipo==2){ // 1 Imprimir copia
        window.open(base_url+'venta/ultimaventa/2', '_blank');
    }
    
    $("#select_imprimir_factura").val(0); 
    
}