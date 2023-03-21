$(document).on("ready",inicio);
function inicio(){
    var cliente_id = document.getElementById('cliente_id').value;
        //alert(cliente_id);
        if (cliente_id==0){
            $("#boton_bsucar_clie").click();
        }
        
//        alert("holaxxx");
        tablaresultados(1);
        tablaproductos(); 
        
        

//        document.getElementById('nit').focus();
//        document.getElementById('nit').select();
}

function calculardesc(){

   var venta_subtotal = document.getElementById('venta_subtotal').value;
   var venta_descuento = document.getElementById('venta_descuento').value;      
   var subtotal = Number(venta_subtotal) - Number(venta_descuento);

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
                
            }else{                
             buscarcliente();
            }               
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
        
    
        
        if (opcion==8){   //si la tecla proviene del buscador de pedido abierto
           buscar_clientes_pedido();
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
                $("#telefono").val(''); //si la tecla proviene del input razon social

                $("#cliente_codigo").val(codigo);
                document.getElementById('telefono').focus();               
           }
        }  
        if (opcion==10){   //si la tecla proviene del buscador del reporte de  ventas
           ventas_por_parametro();
           
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
                }

            },
            error:function(respuesta){			
                $("#razon_social").val('SIN NOMBRE');
                document.getElementById('telefono').focus();
                
                $("#cliente_id").val(0);
            }                
    }); 

}

function borrar_tabla(){
    var html = "";
    $("#tablaresultados").html(html);
    
}

//muestra la tabla de productos del detalle de la venta
function tablaproductos()
{   
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById('base_url').value;
    var categ = JSON.parse(document.getElementById('categoria_producto').value);
    var controlador = base_url+'venta/detalleventa';
    var parametro_diasvenc = document.getElementById('parametro_diasvenc').value;
    var venta_descuento = Number(document.getElementById('venta_descuento').value);
    var tipousuario_id = Number(document.getElementById('tipousuario_id').value);
    var clasificador = "";
    var preferencia = "";
    var caracteristicas = "";
    var parametro_moneda_id = document.getElementById('parametro_moneda_id').value; //1 bolivianos - 2 moneda extrangera
    var parametro_moneda_descripcion = document.getElementById('parametro_moneda_descripcion').value; //1 bolivianos - 2 moneda extrangera
    var moneda_extrangera = document.getElementById('moneda_descripcion').value; //1 bolivianos - 2 moneda extrangera
    var total_final_equivalente = 0; //1 bolivianos - 2 moneda extrangera
    var modificar_precioventa   = document.getElementById('modificar_precioventa').value;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{datos:1},
           success:function(respuesta){     
               
                var registros = JSON.parse(respuesta);
                var sololect = "";
                if (registros != null){

                       var subtotal = 0;
                       var descuento = 0;
                       var descgral = 0;
                       var totalfinal = 0;
                        html = "";
                        html += "<table class='table table-striped table-condensed' id='mitablaventas'>";
                        html += "                    <tr>";
                        html += "                            <th style='padding:0'>#</th>";
                        html += "                            <th style='padding:0'>Descripción<br>";
//                        html += "<input type='checkbox' id='check_agrupar' class='btn btn-success btn-xs'  value='1'> Agrupar";
                        html += " </th>";
                        
                        if(esMobil()){
                            html += "                            <th style='padding:0'>Precio<br>Cant. Desc.</th>";                            
                        }else{
                            html += "                            <th style='padding:0'>Cant.</th>";                    
                            html += "                            <th style='padding:0'>Precio <br>"+parametro_moneda_descripcion+"</th>";
                            html += "                            <th style='padding:0'>Desc <br>"+parametro_moneda_descripcion+"</th>";
                            html += "                            <th style='padding:0'>Precio<br>Total "+parametro_moneda_descripcion+"</th>";
                        } 
                        html += "                            <th style='padding:0'><button onclick='quitartodo()' class='btn btn-danger btn-xs' title='Vaciar el detalle de la venta'><span class='fa fa-trash'></span><b></b></button></th>";
                        html += "                    </tr>";                
                        html += "                    <tbody class='buscar2'>";

                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var categoria = '';
                    var total_equivalente = 0;
                    var total_descuentoparcial = 0;
                    var x = registros.length; //tamaño del arreglo de la consulta
                      
                    for (var i = 0; i < x ; i++){

                        //alert(registros[i]["categoria_id"]-1);
                        categoria = "";
                        
                           cont = cont+1;
                           cant_total+= parseFloat(registros[i]["detalleven_cantidad"]);
                           total_detalle+= parseFloat(registros[i]["detalleven_total"]);
                        let descuento_parcial = registros[i]["detalleven_descuentoparcial"];
                       if(descuento_parcial == null || descuento_parcial == "" ){
                           descuento_parcial = 0;
                       }
                       total_descuentoparcial += parseFloat(descuento_parcial * registros[i]["detalleven_cantidad"]);

                            if(modificar_precioventa == 0){
                                sololect = "readonly";
                            }else{ sololect = ""; }
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
                        html += "<td "+color+"><b><font size='"+fuente+"'>"+registros[i]["producto_nombre"];
                        html += " <button id='boton_composicion"+registros[i]["detalleven_id"]+"' class='btn btn-xs' style='padding:0;' onclick='mostrar_composicion("+registros[i]["detalleven_id"]+")'>[+]</button>";
                        
                       html += " <div id='tabla_composicion"+registros[i]["detalleven_id"]+"' style='padding:0;'> </div>";
//                       html += " <table style='padding:0;'> </table>";
                        clasificador = "";
                        if (registros[i]["clasificador_nombre"]!=null && registros[i]["clasificador_nombre"]!="")
                            clasificador = registros[i]["clasificador_nombre"]+" | ";

                        preferencia = "";
                        if (registros[i]["preferencia_descripcion"]!=null && registros[i]["preferencia_descripcion"]!="")
                            preferencia = registros[i]["preferencia_descripcion"]+" | ";
                        
                        html += "</font></b>";
                        html += " <small>"+registros[i]["detalleven_unidadfactor"]+" * "+clasificador+categoria+preferencia+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_codigobarra"]+"</small>";

                    //************************ INICIO CARACTERISTICAS ***************************

                    html += "  <button class='btn btn-primary btn-xs' title='Registrar/modificar preferencias y características' type='button' data-toggle='collapse' data-target='#caracteristicas"+registros[i]["detalleven_id"]+"' aria-expanded='false' aria-controls='caracteristicas"+registros[i]["detalleven_id"]+"'><i class='fa fa-edit'></i></button>";

                    html += "  <a href='#' data-toggle='modal' onclick='iniciar_preferencia("+registros[i]["detalleven_id"]+")' data-target='#modalpreferencia' class='btn btn-xs btn-success' style=''><i class='fa fa-tasks'></i></a>";

                    // Clasificador
                    html += "  <button class='btn btn-facebook btn-xs' title='Clasificador de productos' type='button' data-toggle='modal' data-target='#modalclasificador' aria-expanded='false' aria-controls='modalclasificador' onclick='mostrar_clasificador("+registros[i]["producto_id"]+","+registros[i]["detalleven_id"]+")'><i class='fa fa-list'></i></button>";


                    html += "<div class='row'>";
                    html += "  <div class='col'>";
                    html += "    <div class='collapse multi-collapse' id='caracteristicas"+registros[i]["detalleven_id"]+"'>";
                    html += "      <div class='card card-body'>";

                    html += "        <div class='row clearfix'> ";
                    html += "           <div class='col-md-3' style='padding:1;'>";

                    if (tipousuario_id == 1){
                        html += "               <label for='producto_costo' class='control-label  text-uppercase'>Precio Costo</label>";
                        html += "               <div class='form-group'>"
                        html += "               <input type='text' name='detalleven_preferencia' value='"+registros[i]['detalleven_costo']+"' class='btn btn-xs btn-default form-control' style='text-align:left;' id='detalleven_costo"+registros[i]["detalleven_id"]+"' />";
                        html += "               </div>";
                    }

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

                    //************ Inicio detalle composicion de productos



                    //************ Fin Inicio detalle composicion de productos

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

                            html += "<td style='padding: 0;' bgcolor='gray'><b>"+registros[i]["detalleven_nombreenvase"]+": "+registros[i]["detalleven_precioenvase"]+" "+registros[i]["moneda_descripcion"]+"</b></td>";
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

                       moneda_cambio = document.getElementById("moneda_descripcion").value;
                       
                       if (parametro_moneda_id==1){ //Si es bolivianos
                           
                                total_final_equivalente += registros[i]["detalleven_total"]/registros[i]["detalleven_tc"];                                
                                total_equivalente =   moneda_cambio+" "+parseFloat(registros[i]["detalleven_total"]/registros[i]["detalleven_tc"]).toFixed(decimales);                           
                       
                       }else{ // Si no se multiplica
                           
                                total_final_equivalente += registros[i]["detalleven_total"]*registros[i]["detalleven_tc"];
                                total_equivalente =   "Bs "+parseFloat(registros[i]["detalleven_total"]*registros[i]["detalleven_tc"]).toFixed(decimales);                                                      
                       }
                       
                       
                       html += "                       </td>";

                    if (esMobil()){    
                        
                        html += " <td align='center'"+color+"> ";
                     
                        html += "                    <div class='btn-group'>      ";                           
                        html += "			<button onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";                       
                        //html += "                              		<span class='btn btn-default  btn-xs'> "+registros[i]["detalleven_cantidad"]+"</span>";
                        
                        html += "                       <input size='1' name='cantidad' class='btn btn-default btn-xs' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+Number(registros[i]["detalleven_cantidad"]).toFixed(decimales)+"'   onKeyUp ='cambiarcantidadjs(event,"+JSON.stringify(registros[i])+")' >";
                        //onkeypress ='seleccionar_cantidad(cantidad"+registros[i]["detalleven_id"]+")'
                        html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";
                       
                        html += "                       <button onclick='ingresorapidojs(1,"+JSON.stringify(registros[i])+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></a></button>";
                        html += "                    </div>";
                        
                        html += "<input "+sololect+" size='5' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'>";
                        html += "<input size='5' name='descuento' id='descuento"+registros[i]["detalleven_id"]+"' value='"+parseFloat(descuento_parcial).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'>";
                        html += "<br><font size='3' ><b>"+parseFloat(registros[i]["detalleven_total"]).toFixed(decimales)+"</b></font><br>"+total_equivalente;
                        html += "</td>";
                        html += "			<td "+color+">";
                        html += "<div style='border-color: #008d4c; background: #008D4C !important; color: white' class='btn btn-success btn-xs' onclick='actualizar_losprecios("+registros[i]["detalleven_id"]+")' title='Actualizar precios'><span class='fa fa-save' aria-hidden='true'></span></div>";
                        html += "                            <button onclick='quitarproducto("+registros[i]["detalleven_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a></button> ";
                        html += "                        </td>";                        
                    }
                    else{
                        
                        html += " <td align='center' width='120' "+color+"> ";
                     
                        html += "                    <div class='btn-group'>      ";                           
                        html += "			<button onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";                       
                        //html += "                              		<span class='btn btn-default  btn-xs'> "+registros[i]["detalleven_cantidad"]+"</span>";
                        
                        html += "                       <input size='1' name='cantidad' class='btn btn-default btn-xs' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+Number(registros[i]["detalleven_cantidad"]).toFixed(decimales)+"'   onKeyUp ='cambiarcantidadjs(event,"+JSON.stringify(registros[i])+")' >";
                        //onkeypress ='seleccionar_cantidad(cantidad"+registros[i]["detalleven_id"]+")'
                        html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "                       <button onclick='ingresorapidojs(1,"+JSON.stringify(registros[i])+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></a></button>";
                        html += "                    </div>";

                    

                        html += "</td>";
                        html += "<td align='right' "+color+"><input "+sololect+" size='5' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'></td>";
                        html += "<td align='right' "+color+"><input size='5' name='descuento' id='descuento"+registros[i]["detalleven_id"]+"' value='"+parseFloat(descuento_parcial).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'></td>";
                        
                        
                        html += "                       <td align='right' "+color+"><font size='3' ><b>"+parseFloat(registros[i]["detalleven_total"]).toFixed(decimales)+"</b></font><br>"+total_equivalente;
                        html += "</td>";

                        html += "			<td "+color+">";
                        html += "<div style='border-color: #008d4c; background: #008D4C !important; color: white' class='btn btn-success btn-xs' onclick='actualizar_losprecios("+registros[i]["detalleven_id"]+")' title='Actualizar precios'><span class='fa fa-save' aria-hidden='true'></span></div>";
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
                        html += "                            <th colspan=2 style='padding:0' align='right'><font size='1'> Producto(s): "+cant_total.toFixed(decimales)+"</font><br><font size='3'>Total "+parametro_moneda_descripcion+": "+total_detalle.toFixed(decimales)+"</font><br>";
                        
                       if (parametro_moneda_id == 1){
                           html +=  moneda_extrangera+" "+ formato_numerico(total_final_equivalente.toFixed(decimales))+"</th>";
                       }else{
                           html +=  "Bs "+formato_numerico(total_final_equivalente.toFixed(decimales))+"</th>";
                       }
                       
                        html += "</th> ";                                       
                        html += "                            <th style='padding:0'></th> ";                                       
                   }
                   else{                       
                        html += "                            <th style='padding:0'></th>";
                        html += "                            <th style='padding:0'></th>";
                        html += "                            <th style='padding:0'><font size='3'>"+cant_total.toFixed(decimales)+"</font></th>";
                        html += "                            <th style='padding:0'></th>";
                        html += "                            <th style='padding:0'><font size='3'>"+total_descuentoparcial.toFixed(decimales)+"</font></th>";
                        html += "                            <th style='padding:0'></th>"; 
                                                
                        html += "                            <th style='padding:0' align='right'><font size='3'>"+parametro_moneda_descripcion+" "+formato_numerico(total_detalle.toFixed(decimales))+"</font><br>";
                        
                       if (parametro_moneda_id == 1){
                           html +=  moneda_extrangera+" "+ formato_numerico(total_final_equivalente.toFixed(decimales))+"</th>";
                       }else{
                           html +=  "Bs "+formato_numerico(total_final_equivalente.toFixed(decimales))+"</th>";
                       }
                        
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
    var decimales = document.getElementById('decimales').value;
    $("#venta_total").val(subtotal.toFixed(decimales));
    $("#venta_descuento").val(descuento.toFixed(decimales));
    $("#venta_subtotal").val(subtotal.toFixed(decimales));
    $("#venta_efectivo").val(subtotal.toFixed(decimales));
    
    var venta_totalfinal = parseFloat(totalfinal - descuento);
    $("#venta_totalfinal").val(venta_totalfinal.toFixed(decimales));
    
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
   
   var cantidad_total = parseFloat(cantidad_en_detalle(producto_id)) + cantidad; 
   
   if(cantidad_total <= existencia){
   
        $.ajax({url: controlador,
               type:"POST",
               data:{cantidad:cantidad, producto_id:producto_id, existencia:existencia},
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
    var controlador = base_url+"pedido/eliminaritem/"+producto_id;

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
    var controlador = base_url+"pedido/eliminartodo/";
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


/*function actualizarprecios(e,detalleven_id)
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
}*/

function actualizarprecios(e,detalleven_id)
{
    var precio = document.getElementById('precio'+detalleven_id).value;
    var descuentoparcial = 0; //document.getElementById('descuento'+detalleven_id).value;
    
    //alert(descuentoparcial);
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
    
        if (Number(descuentoparcial) < Number(precio)){
        
               actualizar_losprecios(detalleven_id);
               
        }else{
            
            alert("ADVERTENCIA: Descuento no permitido..!!");
            $('#descuento'+detalleven_id).val(0);
            actualizar_losprecios(detalleven_id);
            
        }
        
        
        /*var base_url =  document.getElementById('base_url').value;
        var precio = document.getElementById('precio'+detalleven_id).value;
        var cantidad = document.getElementById('cantidad'+detalleven_id).value; 
        var descuentoparcial = document.getElementById('descuento'+detalleven_id).value; 
        var controlador =  base_url+"venta/actualizarprecio";
        $.ajax({url: controlador,
                type:"POST",
                data:{precio:precio, cantidad:cantidad,detalleven_id:detalleven_id, descuentoparcial:descuentoparcial},
                success:function(respuesta){
                    tablaproductos();
                   // tabladetalle();

                }        
        });*/
    }
}

function actualizar_losprecios(detalleven_id)
{
    /*tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){*/
    
    var rol_modificardetalle =  document.getElementById('rol_modificardetalle').value;
    if(rol_modificardetalle == 1){
    var base_url =  document.getElementById('base_url').value;
    var precio = document.getElementById('precio'+detalleven_id).value;
    var descuentoparcial = document.getElementById('descuento'+detalleven_id).value; 
    var cantidad = document.getElementById('cantidad'+detalleven_id).value; 
    var controlador =  base_url+"venta/actualizarprecio";
        
    if (Number(descuentoparcial) < Number(precio)){
        
        $.ajax({url: controlador,
                type:"POST",
                data:{precio:precio, cantidad:cantidad,detalleven_id:detalleven_id, descuentoparcial:descuentoparcial},
                success:function(respuesta){
                    tablaproductos();
                   // tabladetalle();

                }        
        });
        
    }else{
        alert("ADVERTENCIA: Descuento no permitido..!!");
        $('#descuento'+detalleven_id).val(0);
        actualizar_losprecios(detalleven_id);
    }
    }else{
        alert("Usted no tiene permisos para modificar los detallles; consulte con su administrador.");
    }
        
    //}
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

//function ingresorapidojs(cantidad,producto)
//{       
//    var factor = document.getElementById("select_factor"+producto.producto_id).value; //cantidad del factor seleccionado
//    var indice = document.getElementById("select_factor"+producto.producto_id).selectedIndex; //cantidad del factor seleccionado
//    cantidad = cantidad * factor;
//    var precio = 0;  
//    
//    //if (Number(factor)>1){
//    if (indice>0){
//    
//        if (factor == producto.producto_factor)
//            precio = producto.producto_preciofactor;    
//    
//        if (factor == producto.producto_factor1)
//            precio = producto.producto_preciofactor1;    
//    
//        if (factor == producto.producto_factor2)
//            precio = producto.producto_preciofactor2;    
//    
//        if (factor == producto.producto_factor3)
//            precio = producto.producto_preciofactor3;    
//    
//        if (factor == producto.producto_factor4)
//            precio = producto.producto_preciofactor4;    
//    }
//    else 
//    {    precio = producto.producto_precio;}
//
//    
//    var base_url = document.getElementById('base_url').value;   
//    var controlador = base_url+"venta/ingresar_detalle";
//    var usuario_id = document.getElementById('usuario_id').value;
//    var existencia =  producto.existencia;    
//    var producto_id =  producto.producto_id;    
//    var datos1 = "";
//    var descuento = 0;
//    var cantidad_total = parseFloat(cantidad_en_detalle(producto.producto_id)) + cantidad; 
//    var check_agrupar = document.getElementById('check_agrupar').checked;
//    
//    if (check_agrupar){
//        agrupado = 1;
//    }
//    else{
//        agrupado = 0;
//    }
//        
//
//    if (cantidad_total <= producto.existencia){
//
//        datos1 +="0,1,"+producto.producto_id+",'"+producto.producto_codigo+"',"+cantidad+",'"+producto.producto_unidad+"',"+producto.producto_costo+","+precio+","+precio+"*"+cantidad+",";
//        datos1 += descuento+","+precio+"*"+cantidad+",'"+producto.producto_caracteristicas+"',"+"'-'"+",0,1,"+usuario_id+","+producto.existencia+",";
//        datos1 += "'"+producto.producto_nombre+"','"+producto.producto_unidad+"','"+producto.producto_marca+"',";
//        datos1 += producto.categoria_id+",'"+producto.producto_codigobarra+"',";
//        
//        datos1 += producto.producto_envase+",'"+producto.producto_nombreenvase+"',"+producto.producto_costoenvase+","+producto.producto_precioenvase+",";
//        datos1 += cantidad+",0,"+cantidad+",0,0";        
//        //alert(datos1);
//
//        $.ajax({url: controlador,
//            type:"POST",
//            data:{datos1:datos1, existencia:existencia,producto_id:producto_id,cantidad:cantidad, descuento:descuento, agrupado:agrupado},
//            success:function(respuesta){
//                tablaproductos();
//
//            }
//        });
//    
//    }
//    else { alert('ADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+producto.existencia);}
//    
//}

//function ingresorapidojs(cantidad,producto)
//{       
//    var factor = document.getElementById("select_factor"+producto.producto_id).value; //cantidad del factor seleccionado
//    var indice = document.getElementById("select_factor"+producto.producto_id).selectedIndex; //cantidad del factor seleccionado
//    cantidad = cantidad * factor;
//    var precio = 0;  
//    
//    //incremetado de manera temporal para lidiar con el error hasta buscar otra solucion
//    var preferencia_id = 0;
//    var clasificador_id = 0;
//    var preferencias = "";
//    var unidadfactor = "";
//    
//    //if (Number(factor)>1){
//    if (indice>0){
//    
//        if (factor == producto.producto_factor)
//            precio = producto.producto_preciofactor;    
//    
//        if (factor == producto.producto_factor1)
//            precio = producto.producto_preciofactor1;    
//    
//        if (factor == producto.producto_factor2)
//            precio = producto.producto_preciofactor2;    
//    
//        if (factor == producto.producto_factor3)
//            precio = producto.producto_preciofactor3;    
//    
//        if (factor == producto.producto_factor4)
//            precio = producto.producto_preciofactor4;    
//    }
//    else 
//    {    precio = producto.producto_precio;}
//
//    
//    var base_url = document.getElementById('base_url').value;   
//    var controlador = base_url+"venta/ingresar_detalle";
//    var usuario_id = document.getElementById('usuario_id').value;
//    var existencia =  producto.existencia;    
//    var producto_id =  producto.producto_id;    
//    var datos1 = "";
//    var descuento = 0;
//    var cantidad_total = parseFloat(cantidad_en_detalle(producto.producto_id)) + cantidad; 
//    var check_agrupar = document.getElementById('check_agrupar').checked;
//    var parametro_diasvenc = document.getElementById('parametro_diasvenc').value;
//        
//    if (check_agrupar){
//        agrupado = 1;
//    }
//    else{
//        agrupado = 0;
//    }
//        
//
//    if (cantidad_total <= producto.existencia){
//
//        datos1 +="0,1,"+producto.producto_id+",'"+producto.producto_codigo+"',"+cantidad+",'"+producto.producto_unidad+"',"+producto.producto_costo+","+precio+","+precio+"*"+cantidad+",";
//        datos1 += descuento+","+precio+"*"+cantidad+",'"+producto.producto_caracteristicas+"','"+preferencias+"',0,1,"+usuario_id+","+producto.existencia+",";
//        datos1 += "'"+producto.producto_nombre+"','"+producto.producto_unidad+"','"+producto.producto_marca+"',";
//        datos1 += producto.categoria_id+",'"+producto.producto_codigobarra+"',";        
//        datos1 += producto.producto_envase+",'"+producto.producto_nombreenvase+"',"+producto.producto_costoenvase+","+producto.producto_precioenvase+",";
//        datos1 += cantidad+",0,"+cantidad+",0,0, DATE_ADD(CURDATE(), interval "+parametro_diasvenc+" day),'"+unidadfactor+"',"+preferencia_id+","+clasificador_id;
//
////        datos1 +="0,1,"+producto.producto_id+",'"+producto.producto_codigo+"',"+cantidad+",'"+producto.producto_unidad+"',"+producto.producto_costo+","+precio+","+precio+"*"+cantidad+",";
////        datos1 += descuento+","+precio+"*"+cantidad+",'"+producto.producto_caracteristicas+"',"+"'-'"+",0,1,"+usuario_id+","+producto.existencia+",";
////        datos1 += "'"+producto.producto_nombre+"','"+producto.producto_unidad+"','"+producto.producto_marca+"',";
////        datos1 += producto.categoria_id+",'"+producto.producto_codigobarra+"',";        
////        datos1 += producto.producto_envase+",'"+producto.producto_nombreenvase+"',"+producto.producto_costoenvase+","+producto.producto_precioenvase+",";
////        datos1 += cantidad+",0,"+cantidad+",0,0, DATE_ADD(CURDATE(), interval "+parametro_diasvenc+" day),"+preferencia_id+","+clasificador_id;
//       // alert(datos1);
//
//        $.ajax({url: controlador,
//            type:"POST",
//            data:{datos1:datos1, existencia:existencia,producto_id:producto_id,cantidad:cantidad, descuento:descuento, agrupado:agrupado},
//            success:function(respuesta){
//                tablaproductos();
//
//            }
//        });
//    
//    }
//    else { alert('ADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+producto.existencia);}
//    
//}


function ingresorapidojs(cantidad,producto)
{       
    //alert(producto.producto_nombre);
    var factor_nombre = ""; //cantidad del factor seleccionado
    var indice = 0; //cantidad del factor seleccionado
    var detalleven_id = 0; //cantidad del factor seleccionado
    var tipo_cambio =  document.getElementById("moneda_tc").value;
    var parametro_moneda_id = document.getElementById('parametro_moneda_id').value; //1 bolivianos - 2 moneda extrangera
    
    try {
        factor_nombre = document.getElementById("select_factor"+producto.producto_id).value; //cantidad del factor seleccionado

    } catch (error) {
        //console.error(error);
        factor_nombre = ""; //cantidad del factor seleccionado
        
    }
    
    try {
        indice = document.getElementById("select_factor"+producto.producto_id).selectedIndex; //cantidad del factor seleccionado

    } catch (error) {
        //console.error(error);
        indice = 0; //cantidad del factor seleccionado        
    }

    try{
        detalleven_id = producto.detalleven_id;
    }catch (error) {
        detalleven_id = 0;
        
    }


    var factor = 0;    
    var precio = 0;
    var numerofactor = 0;
    var unidadfactor = "";
    
    var inputcaract = document.getElementById("inputcaract").value;
    
    if (inputcaract.length>0){
        preferencias = inputcaract;
        $("#inputcaract").val("");
    }
    else{
        preferencias = producto.producto_caracteristicas;
    }
    
    if (Number(indice)>0){
    
        if (factor_nombre == "producto_factor"){
            precio = producto.producto_preciofactor;
            factor = producto.producto_factor;
            numerofactor = "";
        }    
    
    
        if (factor_nombre == "producto_factor1"){
            precio = producto.producto_preciofactor1;
            factor = producto.producto_factor1;
            numerofactor = "1";
        }    
    
        if (factor_nombre == "producto_factor2"){
            precio = producto.producto_preciofactor2;
            factor = producto.producto_factor2;
            numerofactor = "2";
        }    
    
        if (factor_nombre == "producto_factor3"){
            precio = producto.producto_preciofactor3;
            factor = producto.producto_factor3;
            numerofactor = "3";
        }    
    
        if (factor_nombre == "producto_factor4"){
            precio = producto.producto_preciofactor4;
            factor = producto.producto_factor4;
            numerofactor = "4";
        }    
    }
    else 
    {   factor = 1; 
        precio = producto.producto_precio;
        numerofactor = "0";
    }

    var cantidad = cantidad * factor;
    
    
    if (numerofactor=="0")
    {    unidadfactor = "-"; }
    else
    {    unidadfactor = producto["producto_unidadfactor"+numerofactor];  }
        
    //alert(unidadfactor);
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
    var preferencia_id = document.getElementById('preferencia_id').value;
    
    var clasificador_id = "";
    
    try {
        clasificador_id = document.getElementById('select_clasificador'+producto_id).value;

    } catch (error) {
        //console.error(error);
        clasificador_id = 0; //cantidad del factor seleccionado
        
    }
    
    var preferencias = "";
    try {
        preferencias = document.getElementById('input_detalleven_preferencia'+producto_id).value;

    } catch (error) {
        //console.error(error);
        preferencias = ""; //preferencias
        
    }
    
    
        
    // alert(clasificador_id);   
        
    if (check_agrupar){
        agrupado = 1;
    }
    else{
        agrupado = 0;
    }
        

    if (cantidad_total <= producto.existencia){
        
//        precio = precio * producto.moneda_tc;
        var costo = producto.producto_costo;
        
        if (parametro_moneda_id == producto.moneda_id){ // Si la moneda del sistema es igual al del producto
                precio = precio * 1;
                
        }else{
        
            if (parametro_moneda_id == 1){
                    precio = precio * tipo_cambio;                
                    costo = costo * tipo_cambio;                
            }else{
                    precio = precio / tipo_cambio;                
                    costo = costo / tipo_cambio;                
            }
        
        }
            
        var descuentoparcial = 0;
        
        datos1 +="0,1,"+producto.producto_id+",'"+producto.producto_codigo+"',"+cantidad+",'"+producto.producto_unidad+"',"+costo+","+precio+","+precio+"*"+cantidad+",";
        datos1 += descuento+","+descuentoparcial+","+precio+"*"+cantidad+",'"+producto.producto_caracteristicas+"','"+preferencias+"',0,1,"+usuario_id+","+producto.existencia+",";
        datos1 += "'"+producto.producto_nombre+"','"+producto.producto_unidad+"','"+producto.producto_marca+"',";
        datos1 += producto.categoria_id+",'"+producto.producto_codigobarra+"',";        
        datos1 += producto.producto_envase+",'"+producto.producto_nombreenvase+"',"+producto.producto_costoenvase+","+producto.producto_precioenvase+",";
        datos1 += cantidad+",0,"+cantidad+",0,0, DATE_ADD(CURDATE(), interval "+parametro_diasvenc+" day),'"+unidadfactor+"',"+preferencia_id+","+clasificador_id+","+tipo_cambio;
        /*datos1 +="0,1,"+producto.producto_id+",'"+producto.producto_codigo+"',"+cantidad+",'"+producto.producto_unidad+"',"+costo+","+precio+","+precio+"*"+cantidad+",";
        datos1 += descuento+","+precio+"*"+cantidad+",'"+producto.producto_caracteristicas+"','"+preferencias+"',0,1,"+usuario_id+","+producto.existencia+",";
        datos1 += "'"+producto.producto_nombre+"','"+producto.producto_unidad+"','"+producto.producto_marca+"',";
        datos1 += producto.categoria_id+",'"+producto.producto_codigobarra+"',";        
        datos1 += producto.producto_envase+",'"+producto.producto_nombreenvase+"',"+producto.producto_costoenvase+","+producto.producto_precioenvase+",";
        datos1 += cantidad+",0,"+cantidad+",0,0, DATE_ADD(CURDATE(), interval "+parametro_diasvenc+" day),'"+unidadfactor+"',"+preferencia_id+","+clasificador_id+","+tipo_cambio;
        */
        //alert(datos1);

        $.ajax({url: controlador,
            type:"POST",
            data:{datos1:datos1, existencia:existencia,producto_id:producto_id,cantidad:cantidad, descuento:descuento, descuentoparcial:descuentoparcial, agrupado:agrupado, detalleven_id:detalleven_id},
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
                    "  where producto_id = "+producto_id+" and usuario_id = "+usuario_id;
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

function mostrar_saldo(existencia, producto_id)
{

    var factor_seleccionado = parseInt(document.getElementById('select_factor'+producto_id).value);
    //alert(existencia+" "+producto_id+" "+factor);
    var unidad =document.getElementById('input_unidad'+producto_id).value;
    var unidadfactor = document.getElementById('input_unidadfactor'+producto_id).value;
    var entero = 0;
    var saldo = 0;

    
    
    if (factor_seleccionado == 1)
    {
          
        //$("#input_existencia"+producto_id).val(existencia+" "+unidad); //establece la cantidad requerida en el modal
        exist = "<center><font size='3'><b>"+existencia+"</b></font><br>"+unidad+"</center>";
        $("#input_existencia"+producto_id).html(exist); //establece la cantidad requerida en el modal

    }
    else
    {
                        
        var entero = parseInt(existencia / factor_seleccionado);
        var saldo = parseInt(existencia) - parseInt(entero*factor_seleccionado);
        
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


function registrar_cantidad(e,producto_id){
    tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){
       $("#boton_cantidad"+producto_id).click();
    }
    
}

function tablaresultados(opcion)
{   
    var decimales = document.getElementById('decimales').value;
    var controlador = "";
    var parametro = "";
    var limite = 50;
    var precio_unidad = 0;
    var precio_factor = 0;
    var precio_factorcant = 0;
    var existencia = 0;
    var base_url = document.getElementById('base_url').value;    
    var cantidad = 0;
  //  var usuario_id = document.getElementById('usuario_id').value;

    var modo_visualizacion = document.getElementById('parametro_modoventas').value; // modo de visualizacion 1 = modo texto , 2 = modo grafico
    var ancho_boton = document.getElementById('parametro_anchoboton').value; //base 115
    var alto_boton = document.getElementById('parametro_altoboton').value;
    var color_boton = document.getElementById('parametro_colorboton').value;
    var ancho_imagen = document.getElementById('parametro_anchoimagen').value;;//document.getElementById('parametro_anchoimagen').value;
    var alto_imagen = document.getElementById('parametro_altoimagen').value;; //document.getElementById('parametro_altoimagen').value;
    var forma_imagen = document.getElementById('parametro_formaimagen').value;; //document.getElementById('parametro_altoimagen').value;
    var datosboton = document.getElementById('parametro_datosboton').value; //document.getElementById('parametro_altoimagen').value;
    
    var rol_precioventa = document.getElementById('rol_precioventa').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor = document.getElementById('rol_factor').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor1 = document.getElementById('rol_factor1').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor2 = document.getElementById('rol_factor2').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor3 = document.getElementById('rol_factor3').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor4 = document.getElementById('rol_factor4').value; //document.getElementById('parametro_altoimagen').value;
    var lista_preferencias = JSON.parse(document.getElementById('preferencias').value);

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
    
    if (opcion == 3){
        controlador = base_url+'venta/buscarsubcategorias/';
        parametro = document.getElementById('subcategoria_prod').value;        
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
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var productonombre = "";
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    
                    if(! esMobil()) { //si no es dispositivo mobil
                        html += "                <table class='table  table-condensed table-striped' id='mitabla'>";
                    }else{
                        html += "                <table class='table  table-condensed table-striped' style='max-width: 3cm;' id='mitabla' >";
                    }
                    
                   html += "                <tr style='background-color: black; '>";
                   html += "                <th style='padding:0; background: black;'>#</th> ";
                   html += "                <th style='padding:0; background: black;'>PRODUCTOS</th>";
                   
                    if(! esMobil()) { //si no es dispositivo mobil
                        mensajeboton = "";
                        html += "                <th style='padding:0; background: black;'>Precio</th>";
                        html += "                <th style='padding:0; background: black;'> </th>";
                    }
                    else{
                        mensajeboton = " Añadir"; //mensaje para el boton del carrito
                    }
                    
                   html += "                </tr>";
                   html += "                <tbody class='buscar' >";
         
                    sql = ""; 
                    comilla = "'";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){ 
                        
                        var mimagen = "";
                        if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"].length>2){
                            mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+registros[i]["producto_foto"]+"' class='img img-circle' width='30' height='30' />";
                            mimagen += "</a>";
                            //mimagen = nomfoto.split(".").join("_thumb.");77
                        }else{
                            mimagen = "<img src='"+base_url+"resources/images/productos/thumb_image.png' class='img img-circle' width='30' height='30' />";
                        }
                                             
                        
                        
                        
                        html += "<input type='text' value='"+registros[i]["existencia"]+"' id='existencia"+registros[i]["producto_id"]+"' hidden>";
                        html += "<tr style='border-bottom-style: solid; border-color: #000; border-width: 2px;'>";
                        
                        html += "<td onclick='borrar_tabla()' style='padding:0; background-color:silver;'>"+(i+1)+"</td>";
                        
                        productonombre = registros[i]["producto_nombre"];
                        if (productonombre.length > 42){
                            productonombre = productonombre.substr(0,39)+"..";
                        }
                        
                        html += "<td style='padding:0; max-width:700px;'><font size='"+tamanio+"' face='Arial Narrow'><b>"+productonombre+"</b></font>";
                        
                        
                        
//                        html += mimagen;
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+" | "+registros[i]["producto_codigobarra"];
                        html += "<input type='text' id='input_unidad"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidad"]+"' hidden>";
                        html += "<input type='text' id='input_unidadfactor"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidadfactor"]+"' hidden>";
                        
                        if (esMobil()){
                            
                            html += "<table>"; //tabla movil extra
                            html += "<tr style='padding:0;'>"; //tabla movil extra
                            html += "<td style='padding:0;'>"; //tabla movil extra
                            
                        }
                        
                       if(! esMobil()){
                        html += "</td>";
                        
                        html += "<td style='padding:0;'>"; // style='space-white:nowarp'
                        }
                        
                        
                        
                        html += "<center> ";                        
                        
                                            html += "   <select class='btn btn-facebook' style='font-size:12px; font-family: Arial; padding:0; background: black;' id='select_factor"+registros[i]["producto_id"]+"' name='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+JSON.stringify(registros[i])+")' >";
                        
                        if (rol_precioventa==1){
                            
                            html += "       <option value='precio_normal'>";
                            precio_unidad = registros[i]["producto_precio"];
                            html += "           "+registros[i]["producto_unidad"]+" "+registros[i]["moneda_descripcion"]+": "+Number(precio_unidad).toFixed(decimales)+"";
                            html += "       </option>";
                        
                        }
                        
                        if (rol_factor==1){
                            if(registros[i]["producto_factor"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                                html += "       <option value='producto_factor'>";
                                html += "           "+registros[i]["producto_unidadfactor"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+" / "+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        
                        if (rol_factor1==1){
                            if(registros[i]["producto_factor1"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor1"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor1"]) * parseFloat(registros[i]["producto_factor1"]);

                                html += "       <option value='producto_factor1'>";
                                html += "           "+registros[i]["producto_unidadfactor1"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+" / "+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                            
                        if (rol_factor2==1){
                            if(registros[i]["producto_factor2"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor2"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor2"]) * parseFloat(registros[i]["producto_factor2"]);

                                html += "       <option value='producto_factor2'>";
                                html += "           "+registros[i]["producto_unidadfactor2"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+" / "+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        if (rol_factor3==1){                        
                            if(registros[i]["producto_factor3"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor3"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor3"]) * parseFloat(registros[i]["producto_factor3"]);

                                html += "       <option value='producto_factor3'>";
                                html += "           "+registros[i]["producto_unidadfactor3"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+" / "+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        if (rol_factor4==1){                        
                            if(registros[i]["producto_factor4"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor4"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor4"]) * parseFloat(registros[i]["producto_factor4"]);

                                html += "       <option value='producto_factor4'>";
                                html += "           "+registros[i]["producto_unidadfactor4"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+" / "+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        
                        html += "   </select>";
                        
                        if (esMobil()){
                            html += "</td>"; //tabla movil extra
                            html += "<td style='padding:0; width:2cm; line-height:10px;'>"; //tabla movil extra                            
                        }
                        
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
                        
                        html += "<td style='padding:0;'>";
                        }
                        
                        html += "<div style='line-height:12px;' id='input_existencia"+registros[i]["producto_id"]+"'> <center><font size='3'><b>"+existencia+"</b></font><br>"+registros[i]["producto_unidad"]+"</center></div>";
                    
                       if(esMobil()){
                            html += "</td>"; //tabla movil extra
                            html += "<td style='padding:0;'>"; //tabla movil extra                            
                        }     
                        
                        if (parseFloat(registros[i]["existencia"])>0){
                             html += "<button type='button' class='btn btn-warning btn-sm btn-block' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='Añadir al detalle' onclick='focus_cantidad("+registros[i]["producto_id"]+")'><em class='fa fa-cart-arrow-down'></em>"+mensajeboton+"</button>";                             
                        }
                        
                        //html += "<button class='btn btn-success'><i class='fa fa-picture-o'></i></button>";

                        
                        html += "<!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->";
                        html += "<div class='modal fade' id='mostrarimagen"+i+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<font size='"+tamanio+"'><b>"+registros[i]["producto_nombre"]+"</b></font>";
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
//                        html += "<br>";
                        html += "<div class='modal-content'>";
                        html += "  <div class='modal-header' style='background:silver;'>";
                        html += "       <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "  <font face='Arial' size='2'><b> <fa class='fa fa-cart-plus' > </fa> AÑADIR AL PEDIDO </b></font>";
                        html += "  </div>";
                        html += "  <div class='modal-body' >";
                        
                        html += "  <!----------------------------------------------------------------->";
//                        html += "       <div class='col-md-3'>";
//                        html += "           <img  src='"+base_url+"/"+registros[i]["producto_foto"]+" width='50' heigth='50'>";  
//                        html += "       </div>";
//                        html += "       <div class='col-md-9'>";
                    
                        if (esMobil()) tamanio = 1;
                        else tamanio = 3;
                    
                        html += "        <font face='Arial' size='"+tamanio+"'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];

                        html += "       <table class='table-condensed'>"; // style='space-white: nowrap;'
                        html += "           <tr style='padding:0;'>";
                        html += "               <td style='padding:0;'>";
                      
//                       html += "               <b>"+registros[i]["producto_nombre"]+"</b>";
//                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                     
                        html += "               <b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' min='0' step='1' max='"+registros[i]["existencia"]+"' onkeyup='registrar_cantidad(event,"+registros[i]["producto_id"]+")'></b>";
                        html += "               </td>";
                        
                        html += "               <td rowspan='2'>";
//                        html += "           <img  src='"+base_url+"/"+registros[i]["producto_foto"]+" width='50' heigth='50'>";  
                        html += mimagen;  
                        
                        html += "               </td>";                        
                        html += "          </tr>";
                        html += "          <tr>";
                        
                        html += "          <td>";
                        
                        html += "  <center'>";
                        
                        html += "    <input type='text' id='producto_id' name='producto_id' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>";

                        html += "     <button data-toggle='modal' id='boton_cantidad"+registros[i]["producto_id"]+"' data-dismiss='modal' onclick='ingresardetallejs("+registros[i]["producto_id"]+","+JSON.stringify(registros[i])+")' class='btn btn-success btn-foursquarexs' onkeyup='registrar_cantidad(event,"+registros[i]["producto_id"]+")'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></button>";

                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' class='btn btn-danger btn-foursquarexs'><font size='5'><span class='fa fa-search'></span></font><br><small>Cancelar</small></a>";
                        html += "  </center>";
                        
                        html += "          </td>";
                        html += "          </tr>";
                        
                        html += "       </table>";
                        
//                        html += "       </div>";
                        html += "       <!------------------------------------------------------------------->";
                        html += "  </div>";
                        
                        html += "  <div class='modal-footer'>";
    
                        html += "  </div>";                        
                        html += "</div>";
                        
                        html += "  </div>";
                        html += "</div>";

                        html += "<!---------------------- fin modal cantidad ---------------------------------> ";
                        
                        

                        if(esMobil()){
                         
                        html += "</td>"; //tabla movil extra                        
                        html += "<td style='padding: 0;'>"; //tabla movil extra                        
                        html += mimagen; //tabla movil extra                        
                        
                        html += "</td>"; //tabla movil extra                        
                        html += "</tr>"; //tabla movil extra
                        html += "</table>"; //tabla movil extra
                        
                     }
                        

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
                        html += "               ";
                      
                      
                        html += "               <font size='1'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "               <br><b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0' step='1' max='"+Number(registros[i]["existencia"]).toFixed(decimales)+"'></b>";
                        

                        // ******************** inicio select   
                        html += "<br><select class='btn btn-facebook' style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+registros[i]["existencia"]+","+registros[i]["producto_id"]+")'>";
                        html += "       <option value='1'>";
                        precio_unidad = registros[i]["producto_precio"];
                        html += "           "+registros[i]["producto_unidad"]+" Bs : "+precio_unidad.fixed(decimales)+"";
                        html += "       </option>";
                        
                        if(registros[i]["producto_factor"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                            html += "       <option value='"+registros[i]["producto_factor"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor"]+" Bs: "+precio_factor.toFixed(decimales)+" / "+precio_factorcant.toFixed(decimales);
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
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+Number(registros[i]["producto_precio"]).toFixed(decimales)+"' hidden>";

                        html += "     <button data-toggle='modal' id='boton_cantidad"+registros[i]["producto_id"]+"' data-dismiss='modal' onclick='ingresardetallejs("+registros[i]["producto_id"]+","+JSON.stringify(registros[i])+")' class='btn btn-success btn-foursquarexs' ><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></button>";
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
            
            document.getElementById('buscador1').style.display = 'none';
            document.getElementById('categoria').style.display = 'none';
                       
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
    
    if(opcion==2){
        
        //Busca la subcategoria y la redibuja en el select
        var controlador = base_url+'website/obtener_subcategoria/'+parametro;
        $.ajax({url: controlador,
            type:"POST",
            data:{categoria_id:parametro},
            success:function(respuesta){
                                                        
                 html = "";
                 subcat = JSON.parse(respuesta);
                 cant = subcat.length;
                 
                html += "<option value='0' selected>- SUB CATEGORIA -</option>"                     
                 for(i=0;i<cant;i++){
                     html += "<option value='"+subcat[i]["subcategoria_id"]+"'>"+subcat[i]["subcategoria_nombre"]+"</option>"                     
                 }
                 
               $("#subcategoria_prod").html(html);
                    
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "<option value='0' selected>-SUB CATEGORIA-</option>";
               $("#subcategoria_prod").html(html);
            },
            complete: function (jqXHR, textStatus) {
               
                //tabla_inventario();
            }
        
        });
    }
    
 //   $("#encontrados").focus(); //Quita el foco del buscador para que desparezca el teclado android
} 

function eliminardetalleventa()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/eliminardetalle/";
    borrar_datos_cliente();
    //alert("aquiiiiii");
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

function registrarcliente()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/registrarcliente';
    var cliente_id = document.getElementById('cliente_id').value;
    var cdi_codigoclasificador = document.getElementById('cdi_codigoclasificador').value;
    
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
    /* se repite.. pero no borrar o dara error*/
    let tipo_doc_identidad = cdi_codigoclasificador;
    var cliente_email = document.getElementById('email').value;
    var cliente_complementoci = document.getElementById('cliente_complementoci').value;
    var cliente_excepcion = (document.getElementById('codigoexcepcion').value == 1)?1:0;
    
    var zona = document.getElementById('zona_id').value;
    if (zona=='null' || zona=='' || zona==0) {
        zona_id=0;
    }else{
        zona_id=zona;
    }
    
   
   //alert(cliente_id);
   
    if (cliente_id > 0 || nit==0){ //si el cliente existe debe actualizar sus datos 
        
        // alert(cliente_id+" * "+nit);
        var controlador = base_url+'venta/modificarcliente';
        
        $.ajax({url: controlador,
                    type:"POST",
                    /*data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_nombre:cliente_nombre, cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento,
                        cliente_celular:cliente_celular,zona_id:zona_id, cdi_codigoclasificador:cdi_codigoclasificador},
                    */
                    data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id,
                        tipo_doc_identidad:tipo_doc_identidad, cliente_email:cliente_email,cliente_complementoci:cliente_complementoci,
                        cliente_excepcion: cliente_excepcion
                    },
                    success:function(respuesta){ 
                        var datos = JSON.parse(respuesta);
                        cliente_id = datos[0]["cliente_id"];
                        
                        //console.log(datos);
                        
                        if(cliente_id>0){
                            registrarpedido(cliente_id);                            
                        }
                        else{
                            registrarpedido(respuesta);                            
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
            /*data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_nombre:cliente_nombre, cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular},
                    */
                   data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_nombre:cliente_nombre, cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id,
                        tipo_doc_identidad:tipo_doc_identidad, cliente_email:cliente_email,cliente_complementoci:cliente_complementoci,cliente_excepcion:cliente_excepcion},
            success:function(respuesta){  
            
                var registro = JSON.parse(respuesta);
                
                cliente_id = registro[0]["cliente_id"];
                registrarpedido(cliente_id);
                
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
    
    
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getYear();
        var hh = hoy.getHours();
        var nn = hoy.getMinutes();
        var ss = hoy.getSeconds();
        
        dd = addZero(dd);
        mm = addZero(mm);
 
       // return dd+'/'+mm+'/'+yyyy;
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

function registrarpedido(cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/registrarpedido";    
    
    var forma_id = document.getElementById('forma_pago').value; 
    var tipotrans_id = document.getElementById('tipo_transaccion').value; 
    
    var usuario_id = document.getElementById('usuario_id').value; //usuario a quien va dirigido el pedido
    var estado_id = 11;// estado: PENDIENTE, tipo 5
    //ya esta el cliente id
    var tipo_trans = document.getElementById('tipo_transaccion').value; //

    var hora = new Date();    
    var pedido_hora = hora.getHours()+":"+hora.getMinutes()+":"+hora.getSeconds();
    
    var pedido_fecha = fecha();//retorna la fecha actual  //"date(now())";
    var pedido_fecha2 = "'"+pedido_fecha+" "+pedido_hora+"'" ;//retorna la fecha actual  //"date(now())";
    
    var pedido_subtotal = document.getElementById('venta_subtotal').value; //     
    var pedido_descuento = document.getElementById('venta_descuento').value; //
    var pedido_total = document.getElementById('venta_totalfinal').value; // 
    var pedido_glosa = "'"+document.getElementById('venta_glosa').value+"'"; //
    var pedido_fechaentrega = "'"+document.getElementById('pedido_fechaentrega').value+"'"; //
    var pedido_horaentrega = "'"+document.getElementById('pedido_horaentrega').value+"'"; //
    var pedido_latitud = document.getElementById('pedido_latitud').value; //
    var pedido_longitud = document.getElementById('pedido_longitud').value  ; //
    var regusuario_id = document.getElementById('regusuario_id').value; //usuario quien genera el pedido

    
    var pedido_id = document.getElementById('pedido_id').value; 
    var nit = document.getElementById('nit').value;
    var razon = document.getElementById('razon_social').value;
    
    
    
    var moneda_id = 1; 
    
    
    var venta_efectivo = document.getElementById('venta_efectivo').value; 
    var venta_cambio = document.getElementById('venta_cambio').value; 
    var venta_comision = document.getElementById('venta_comision').value; 
    var venta_tipocambio = document.getElementById('venta_tipocambio').value; 
    var detalleserv_id = document.getElementById('detalleserv_id').value;
    var cuotas = document.getElementById('cuotas').value;   
    var cuota_inicial = document.getElementById('cuota_inicial').value;
    var credito_interes = document.getElementById('credito_interes').value;
    var facturado = 0;
    var tiposerv_id = document.getElementById('tiposerv_id').value;
    var venta_numeromesa = document.getElementById('venta_numeromesa').value;
    var parametro_modulorestaurante = document.getElementById('parametro_modulorestaurante').value;
    
      
    var venta_numeroventa = 0;
    var venta_tipodoc = 0;
    var entrega_id = 1;

    if (parametro_modulorestaurante==1){
        venta_numeroventa = numero_venta();
    }
    

    document.getElementById('boton_finalizar').style.display = 'none'; //mostrar el bloque del loader
   
    if( facturado == 1){     
        venta_tipodoc = 1;}
    else{
        venta_tipodoc = 0;}
 
    var cad = usuario_id+","+estado_id+","+cliente_id+","+tipotrans_id+","+pedido_fecha2+","+
            pedido_subtotal+","+pedido_descuento+","+pedido_total+","+pedido_glosa+","+
            pedido_fechaentrega+","+pedido_horaentrega+","+pedido_latitud+","+
            pedido_longitud+","+regusuario_id;
    /* Inicio para reservas*/
    let esreserva         = $('#esreserva').is(':checked');
    let ingreso_monto     = document.getElementById('ingreso_monto').value;
    let ingreso_moneda    = document.getElementById('ingreso_moneda').value;
    let select_forma_pago = document.getElementById('select_forma_pago').value;
    let ingreso_glosa     = document.getElementById('ingreso_laglosa').value;
    let banco_id          = document.getElementById('banco_id').value;
    /* F i n  para reservas*/
        $.ajax({
            url: controlador,
            type:"POST",
            data:{cad:cad, tipo_trans:tipo_trans, cuotas:cuotas, cuota_inicial:cuota_inicial, 
                pedido_total:pedido_total, credito_interes:credito_interes, pedido_id:pedido_id,
                facturado:facturado,pedido_fecha:pedido_fecha, razon:razon, nit:nit, pedido_descuento:pedido_descuento,
                pedido_hora:pedido_hora,cliente_id:cliente_id, esreserva:esreserva, ingreso_monto:ingreso_monto,
                ingreso_moneda:ingreso_moneda, select_forma_pago:select_forma_pago, ingreso_glosa:ingreso_glosa,
                banco_id:banco_id},
            success:function(respuesta){ 
                eliminardetalleventa();
                
                var mensaje;
                var opcion = confirm("¿Desea realizar un nuevo pedido?");
                
                if (opcion == true) {
                    window.open(base_url+"pedido/pedidoabierto/0","_self");
               
                } else {
                    eliminardetalleventa();
                    window.opener.location.reload();
                    window.close();                        
                }
                
//                alert('Pedido registrado con éxito..!!');
                
                
            },
            error: function(respuesta){
                alert("Revise los datos de la venta por favor...!");   
            }
        });          

    
}

function finalizarpedido()
{
    var monto = document.getElementById('venta_totalfinal').value;
//    var base_url = document.getElementById('base_url').value;   
    var cliente_id = document.getElementById('cliente_id').value;
    
    //alert(cliente_id);
    if (cliente_id > 0){

        if (monto>0)
        {
           document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
           document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader   
           registrarcliente();
        }
        else
        {
            var txt;
            var r = confirm("El pedido no tiene ningun detalle o los precios estan en Bs 0.00. \n ¿Desea Continuar?");
            if (r == true) {
                document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
                document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader   

                registrarcliente();
            } 

        }    
    }
    else{
        alert("ERROR: Debe seleccionar un cliente..!!");
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
    

    filtro = " and v.venta_fecha >= '"+fecha_desde+"'  and  v.venta_fecha <='"+fecha_hasta+
            "' and v.estado_id = "+estado_id;
    
    if (usuario_id > 0){
        filtro += " and v.usuario_id = "+usuario_id;
    } 
    
   // alert(filtro)
    tabla_ventas(filtro);


    
}

function ventas_por_parametro()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/mostrar_ventas_parametro";
    var parametro = document.getElementById('filtrar').value;
//    var estado_id = document.getElementById('estado_id').value;
//    var usuario_id = document.getElementById('usuario_id').value;
//    
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
                
                $("#parametro").val(filtro); // se enviar el parametro a un text para usarlo desde otro metodo despues
                
            
                html = "";

                    var cont = 0;
                    var total_final = 0;
                    
                    
                for (var i=0; i< v.length; i++){    

                    cont = cont + 1; 
                    total_final += parseFloat(v[i]['venta_total']);

                    html += "                       <tr>";
                    html += "                       <td>"+cont+"</td>";
                    
                    html += "                       <td style='max-width: 5cm'><font size='3'><b> "+v[i]['cliente_nombre']+"</b></font><sub>  ["+v[i]['cliente_id']+"]</sub>";
                    html += "                           <br>Razón Soc.: "+v[i]['cliente_razon'];
                    html += "                           <br>NIT: "+v[i]['cliente_nit'];
                    html += "                           <br>Telefono(s): "+v[i]['cliente_telefono'];
                    html += "                           <br>Nota: "+v[i]['venta_glosa'];
                    html += "                       </td>";

                    html += "                       <td style='withe-space:nowrap' align='right' >";
                    html += "                           Sub Total "+v[i]['moneda_descripcion']+': '+v[i]['venta_subtotal']+"<br>";
                    html += "                           Desc. "+v[i]['moneda_descripcion']+': '+v[i]['venta_descuento']+"<br>";
                    html += "                           <!--<span class='btn btn-facebook'>-->";
                    html += "                           <font size='3' face='Arial narrow'> <b>Total "+v[i]['moneda_descripcion']+': '+v[i]['venta_total']+"</b></font><br>";
                    html += "                           <!--</span>-->";
                    html += "                               Efectivo "+v[i]['moneda_descripcion']+": "+v[i]['venta_efectivo']+"<br>";
                    html += "                               Cambio "+v[i]['moneda_descripcion']+": "+v[i]['venta_cambio'];
                    html += "                       </td>";

                    html += "                       <td align='center'><font size='3'><b> 00"+v[i]['venta_id']+"</b></font>";
                    html += "                           <br><img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='50' height='50'>";
                    html += "                           <br>"+v[i]['usuario_nombre'];
                    html += "                        </td>   ";
                    
                    html += "                       <td align='center'  bgcolor='"+v[i]['estado_color']+"'>"+v[i]['forma_nombre'];
                    html += "                           <br> "+v[i]['tipotrans_nombre'];
                    html += "                           <br><br><span class='btn btn-facebook btn-xs' ><b>"+v[i]['estado_descripcion']+"</b></span> ";
                    html += "                       </td>";

                    html += "                       <td><center>"+formato_fecha(v[i]['venta_fecha']);
                    html += "                           <br> "+v[i]['venta_hora'];
                    html += "                           <br><input type='button' class='btn btn-warning btn-xs' id='boton"+v[i]['venta_id']+"' value='--' style='display:block'>";
                    
                    html += "                       </center>";
                    html += "                       </td>";

//                    html += "                       <td align='center'>";
//                    html += "                           <img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='50' height='50'>";
//                    html += "                           <br>"+v[i]['usuario_nombre'];
//                    html += "                       </td>";

                    html += "                       <td class='no-print'>";
                    html += "                           <a href='"+base_url+"venta/edit/"+v[i]['venta_id']+"' class='btn btn-info btn-xs no-print' target='_blank' title='Modifica los datos generales de la venta'><span class='fa fa-pencil'></span></a>";
                    html += "                           <a href='"+base_url+"venta/modificar_venta/"+v[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modifica el detalle/cliente de la venta'><span class='fa fa-edit'></span></a>";
//                    html += "                           <a href='"+base_url+"venta/nota_venta/"+v[i]['venta_id']+"' class='btn btn-success btn-xs'><span class='fa fa-print'></span></a> ";
                    html += "                           <a href='"+base_url+"factura/imprimir_recibo/"+v[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-print'></span></a> ";
                    
                    if (parametro_modulorestaurante==1){
                    html += "                           <a href='"+base_url+"factura/comanda_boucher/"+v[i]['venta_id']+"' class='btn btn-primary btn-xs' target='_blank' title='Imprimir comanda'><span class='fa fa-list'></span></a> ";
                }
                    if (v[i]['venta_tipodoc']==1)
                        html += "                                   <a href='"+base_url+"factura/imprimir_factura/"+v[i]['venta_id']+"' target='_blank' class='btn btn-warning btn-xs' title='Ver/anular factura'><span class='fa fa-list-alt'></span></a> ";
                    html += "                           <!--<a href='<?php echo site_url('venta/eliminar_venta/'.$v[i]['venta_id']); ?>' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>-->";
                    html += "                           <br><br><button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+v[i]['venta_id']+"'  title='Anular venta'><em class='fa fa-ban'></em></button>";
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
                    html += "                        <th><font size='3'> Bs: "+total_final.toFixed(decimales)+"</font></th>	";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                  
                    html += "                    </tr> ";
            $("#tabla_ventas").html(html);
            document.getElementById('oculto').style.display = 'none'; //mostrar el bloque del loader
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

function formato_numerico(numero){
            nStr = Number(numero).toFixed(decimales);
        nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
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
    
//    var modulo_restaurante = document.getElementById("parametro_modulorestaurante").value;
    $("#nit").val(0);
    $("#razon_social").val("SIN NOMBRE");
    $("#cliente_id").val("0");
    $("#cliente_nombre").val("SIN NOMBRE");
    $("#cliente_ci").val("0");
    $("#cliente_nombrenegocio").val("-");
    $("#cliente_codigo").val("0");
    
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
    

    
    
//    document.getElementById("forma_pago").selectedIndex = 0
    document.getElementById("tipo_transaccion").selectedIndex = 0
   
    
    
    $("#filtrar").focus();
    
    
    
//    var facturado = document.getElementById('facturado').checked;      

    //Imprimir la factura
    
    
//    if (facturado == 1){
//        var boton = document.getElementById("imprimir");
//        boton.click();                    
//    }
    
    //Si esta actuvo el modulo para restaurante
//    if (modulo_restaurante == 1){
//        boton = document.getElementById("imprimir_comanda");
//        boton.click();                    
//    } 
    
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



function buscar_clientes_pedido()
{    
    var parametro = document.getElementById('filtrar4').value;
    var pedido_id = document.getElementById('pedido_id').value;
    var tipo = document.getElementById('tipo').value;
    var base_url    = document.getElementById('base_url').value;
    
    var controlador = base_url+"cliente/buscarclientes_pedido";
    
//    alert(parametro);
    $.ajax({url:controlador,
        type:"POST",
        data:{parametro: parametro, tipo: tipo},
        success: function(response){
            var c = JSON.parse(response);

            html = "";
            for (var i = 0; i < c.length; i++){
            
                html += "<tr style='border-bottom-style: solid; border-color: black; border-width: 2px'>";
//                html += "     <form action='"+base_url+"cliente/cambiarcliente/ method='POST' class='form'>";
                html += "  ";
                html += "        <td style='padding:0;'>";
                html += "        <center>"+(i+1)+"<br>";//+"</td>";
//                html += "        <td>";
                html += "        <img src='"+base_url+"resources/images/clientes/thumb_"+c[i]["cliente_foto"]+"' class='img-circle' width='50' height='50'>";
                html += "        <br><a href='"+base_url+"cliente/modificar_cliente/"+c[i]['cliente_id']+"/"+pedido_id+"' class='btn btn-primary btn-xs'><fa class='fa fa-pencil'> </fa> Editar</a>";
                
                html += "        <center>";
                html += "        </td>";

                html += "        <td style='padding:0;'>";


                cliente_nombre = "<b>"+c[i]["cliente_nombre"]+"</b>";
                html += "            <a href='"+base_url+"pedido/pedidoabierto/"+c[i]["cliente_id"]+"' class='btn btn-warning btn-xs'>"+"<fa class='fa fa-user'></fa> "+cliente_nombre+"</a>";
//                html += "                <b> "+c[i]["cliente_nombre"]+"</b> , COD.: "+c[i]["cliente_codigo"]+" <br>";
                html += "<br>";
                html += "COD.: "+c[i]["cliente_codigo"]+", Dir.: "+c[i]["cliente_direccion"]+", Zona: ";
                if(c[i]["zona_nombre"] != null){
                    html += c[i]["zona_nombre"];
                }else{ html += "sin zona";}
                html += "<br>";
                html += "            C.I.:"+c[i]["cliente_ci"]+" | Telf.:"+c[i]["cliente_telefono"]+" <br>";
                html += "            <div class='container' hidden='TRUE'>";
                html += "                <input id='cliente_id'  name='cliente_id' type='text' class='form-control' value='<?php echo $h['cliente_id']; ?>'>";
                html += "                <input id='pedido_id'  name='pedido_id' type='text' class='form-control' value='<?php echo $pedido_id; ?>'>";
                html += "            </div>";       
                html += "            NIT:";
                html += "            <input type='text' style='width:100px; padding:0; margin:0;' id='cliente_nit' name='cliente_nit' class='btn btn-default btn-sm' placeholder='N.I.T.' required='true' value='"+c[i]["cliente_nit"]+"'>";
                html += "            <br>RAZON SOCIAL:";
                html += "            <input type='text' style='width:150px; padding:0; margin:0;' id='cliente_razon' name='cliente_razon' class='btn btn-default btn-sm' placeholder='Razón Social' required='true' value='"+c[i]["cliente_razon"]+"'>";
                html += "           ";
//                html += "            <button type='submit' class='btn btn-success btn-xs btn-block'>";
//                html += "                <i class='fa fa-check'></i> Seleccionar Cliente";
//                html += "            </button>";
                
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
    
    
    //alert(preferencia+" "+caracteristicas);
    
    $.ajax({url: controlador,
        type:"POST",
        data:{detalleven_id:detalleven_id, preferencia:preferencia, caracteristicas:caracteristicas, check:check,
            cantidadenvase:cantidadenvase, garantia:garantia, fecha_vencimiento:fecha_vencimiento},
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

        $.ajax({url: controlador,
            type:"POST",
            data:{venta_id:venta_id, cliente_id:cliente_id, venta_fecha:venta_fecha,venta_subtotal:venta_subtotal,
            venta_descuento:venta_descuento, venta_total:venta_total, venta_efectivo:venta_efectivo, venta_cambio:venta_cambio},
            success:function(respuesta){ 
                //tablaproductos();
                window.close();
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
    
   
    if (cliente_id > 0 || nit==0){ //si el cliente existe debe actualizar sus datos 
        //alert("nit:"+nit+",razon:"+razon+",telefono:"+telefono+",cliente_id:"+cliente_id+", cliente_nombre:"+cliente_nombre)
        // alert(cliente_id+" * "+nit);
        var controlador = base_url+'venta/modificarcliente';
        
        $.ajax({url: controlador,
                type:"POST",
                data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular},
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
                //registrarpedido(cliente_id);
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
    var moneda_tc = document.getElementById('moneda_tc').value;
    var venta_totalfinal = document.getElementById('venta_totalfinal').value;

    document.getElementById('botones').style.display = 'none'; //ocultar botones
    document.getElementById('loaderinventario').style.display = 'block'; //mostrar el bloque del loader 

    if (usuario_id>0){
        if (venta_totalfinal>0){
            $.ajax({
                url:controlador,
                type:"POST",
                data:{usuario_id:usuario_id, moneda_tc:moneda_tc},
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

////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////

function registrar_recorrido()
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'/pedido/registrar_recorrido';

    var tiporespuesta_id = document.getElementById('tiporespuesta_id').value;
    var pedido_id = 0;
    var cliente_id = document.getElementById('cliente_id').value;
    var usuario_id = document.getElementById('usuario_id').value;
    
    var hora = new Date();    
    var recorrido_hora = hora.getHours()+":"+hora.getMinutes()+":"+hora.getSeconds();    
    var recorrido_fecha = fecha();
    var recorrido_detalleresp = document.getElementById('recorrido_detalleresp').value;
    
    if(tiporespuesta_id>0){
    
        if(cliente_id>0){
    
            $.ajax({
                url:controlador,
                type:"POST",
                data:{tiporespuesta_id:tiporespuesta_id,pedido_id:pedido_id,cliente_id:cliente_id,
                    usuario_id:usuario_id,recorrido_fecha:recorrido_fecha,recorrido_hora:recorrido_hora,
                    recorrido_detalleresp:recorrido_detalleresp},
                success:function(respuesta){
        //            tablaproductos();
                    alert("Respuesta registrada con éxito..!")
                    window.opener.location.reload(); window.close();
                    
                },                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                error:function(respuesta){
        //            tablaproductos();
                    alert("ERROR: Revise los datos de registrados por favor..!!")
                },                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  

            });

        }
        else{
            alert("ERROR: Debe seleccionar un cliente...!");
        }
        
    }
    else{
        alert("ERROR: Debe seleccionar una respuesta...!");
    }
    
}

function focus_efectivo(){
        $('#modalfinalizar').on('shown.bs.modal', function() {
        $('#venta_efectivo').focus();
        $('#venta_efectivo').select();
    });
}

function focus_cliente(){
    
        $('#modalbuscar').on('shown.bs.modal', function() {
        $('#filtrar4').focus();
        $('#filtrar4').select();
    });
}

function focus_cantidad(producto_id){

    var campo = "cantidad"+producto_id;

    $('#myModal'+producto_id).on('shown.bs.modal', function() {
        $('#'+campo).focus();
        $('#'+campo).select();
    });
    
}

function mostrar_clasificador_boton(producto_id){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/clasificador_producto";
    var lista_preferencias = JSON.parse(document.getElementById('preferencias').value);
    var html = "";

    //para llenar el select de clasificador de productos
     $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
           success:function(respuesta){     
               r = JSON.parse(respuesta);
               var html = "";
               
                html +="<input type='hidden' value='"+detalleven_id+"' id='input_detalleven'>";
                html +="<select id='select_clasificador"+producto_id+"' class='btn btn-warning btn-xs' style='width:175px;'>";
                html +="<option value=0>NINGUNO</option>";
                for (var i=0; i<r.length; i++){
                    html +="<option value="+r[i]["clasificador_id"]+">";
                    html +=r[i]["clasificador_nombre"];
                    html +="</option>";                   
                }
                html +="</select>";               
               
               $("#div_clasificador"+producto_id).html(html);

           },
           error: function(respuesta){
               
           }
       });               
        
            html += "<button type='button' style='text-align:left;' class='btn btn-xs btn-info' id='pref0'";
            html += " name='pref0'  onclick='agregar_preferencia(0)'>";
            html += "<i class='fa fa-cube'></i> NINGUNO </button>";
            var cont = 0;
        for (var j = 0; j < lista_preferencias.length; j++ ){
            
            if (lista_preferencias[j]["producto_id"] == producto_id){
                cont++;
                //alert(producto_id+" "+lista_preferencias[j]["preferencia_id"]);
                html += "<button type='button' class='btn btn-xs btn-facebook' style='text-align:left;' id='pref"+lista_preferencias[j]["preferencia_id"]+"'";
                html += " name='"+lista_preferencias[j]["preferencia_descripcion"]+"'  onclick='agregar_preferencia("+lista_preferencias[j]["preferencia_id"]+")'>";
                html += "<img src='"+base_url+"resources/images/productos/thumb_"+lista_preferencias[j]["preferencia_foto"]+"' width='20px' height='20px'> "+lista_preferencias[j]["preferencia_descripcion"];
                html += "</button>";

            }
        }
        
        if (cont == 0) html = "";
        
        $("#botones_preferencias"+producto_id).html(html);
    
}

function registrar_clasificador(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/registrar_clasificador";
    var clasificador_id = document.getElementById('select_clasificador').value;
    var detalleven_id = document.getElementById('input_detalleven').value;


    
//    $("#input_detallecompid").val(detallecomp_id);
//    $("#input_productoid").val(producto_id);
//    
//    
    //para llenar el select de clasificador de productos
     $.ajax({url: controlador,
           type:"POST",
           data:{clasificador_id:clasificador_id, detalleven_id: detalleven_id},
           success:function(respuesta){     
                tablaproductos();
           },
           error: function(respuesta){
               
           }
       });              
    $("#cancelar_preferencia").click();
}
