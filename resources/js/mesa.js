function modal_mesa(mesa_id){
    
    var base_url = document.getElementById('base_url').value;    
    
    let ultimamesa_id = document.getElementById("ultimamesa_id").value;
    
    
    if(ultimamesa_id != mesa_id){
        
        
        $("#mesa"+mesa_id).val(mesa_id);
        
        
        $("#ultimamesa_id").val(mesa_id);
        $("#mesa_id").val(mesa_id);
        registrar_operacion();
        
        var boton = document.getElementById('mesa'+mesa_id);
        var imagen = document.getElementById('imagen'+mesa_id);
        imagen.src = base_url+"resources/images/mesas/ocupada"+mesa_id+".png";
        
        boton.onclick = function(){ mostrar_pedido(mesa_id); };
        //boton.addEventListener('click',mostrar_pedido(mesa_id));
        
        try{
            
            var espan = document.getElementById('span'+mesa_id);
            espan.className = "btn btn-danger btn-xs";
            
        } catch (error) {}
        
        $("#boton_productos").click();
        $("#mostrar_todo").click();
        
        $('#modalproductos').on('shown.bs.modal', function() {

            $("#filtrar").focus();
            $("#filtrar").select();

        });
        
        
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

function registrar_producto(e,producto_id){

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        
        ingresar_producto(producto_id);
        
    }
    
}

function tablaresultados(opcion)
{   
    var decimales = document.getElementById('decimales').value;
    var controlador = "";
    var parametro = "";
    var limite = 500;
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
    else{ tamanio = 2; }
    
    
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
        
    
    if (opcion == 4){
        controlador = base_url+'venta/mostrartodo/';
        parametro = 'todo';        
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
                        
                        html += "<td style='padding:0; max-width:600px;'><font size='"+tamanio+"' face='Arial'><b>"+productonombre+"</b></font>";
                        
                        
                        
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
                            precio_unidad = Number(registros[i]["producto_precio"]).toFixed(decimales);
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
                                
                                /*
                                  html += "<br>";
                                  html += "<div class='btn-group'>";

                                  html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapidojs(1,"+JSON.stringify(registros[i])+")'><b>- 1 -</b></button>";                                  
                                  html +=     "<button class='btn btn-info btn-xs' onclick='ingresorapidojs(2,"+JSON.stringify(registros[i])+")'><b>- 2 -</b></button>";
                                  html +=     "<button class='btn btn-primary btn-xs' onclick='ingresorapidojs(5,"+JSON.stringify(registros[i])+")'><b>- 5 -</b></button>";
                                  html +=     "<button class='btn btn-warning btn-xs' onclick='ingresorapidojs(10,"+JSON.stringify(registros[i])+")'><b>- 10 -</b></button> ";
                                  html += "</div>";   */
                                  
                                  html += "<br>";
                                  html += "<div class='btn-group'>";
                                  html += "<input type='number' id='producto_cant"+registros[i]["producto_id"]+"' class='btn btn-default btn-sm' style='width: 70px; font-size:12px;' value='1' onkeypress='registrar_producto(event,"+registros[i]["producto_id"]+")'>";
                                  /*
                                  html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapidojs(1,"+JSON.stringify(registros[i])+")'><b>- 1 -</b></button>";                                  
                                  html +=     "<button class='btn btn-info btn-xs' onclick='ingresorapidojs(2,"+JSON.stringify(registros[i])+")'><b>- 2 -</b></button>";
                                  html +=     "<button class='btn btn-primary btn-xs' onclick='ingresorapidojs(5,"+JSON.stringify(registros[i])+")'><b>- 5 -</b></button>";
                                  html +=     "<button class='btn btn-warning btn-xs' onclick='ingresorapidojs(10,"+JSON.stringify(registros[i])+")'><b>- 10 -</b></button> ";*/
                                  html += "</div>";   
                            }            
                        }
                      
                        //html += "<textarea name='textarea' rows='10' cols='50'>"+sql+"</textarea>"
                        
                        html += "</center>";
                        if(! esMobil()){
                       
                        html += "</td>";
                        
                        html += "<td style='padding:0;'>";
                        }
                        
                        //html += "<div style='line-height:12px;' id='input_existencia"+registros[i]["producto_id"]+"'> <center><font size='3'><b>"+existencia+"</b></font><br>"+registros[i]["producto_unidad"]+"</center></div>";
                    
                       if(esMobil()){
                            html += "</td>"; //tabla movil extra
                            html += "<td style='padding:0;'>"; //tabla movil extra                            
                        }     
                        
                        if (parseFloat(registros[i]["existencia"])>0){
//                             html += "<button type='button' class='btn btn-warning btn-sm btn-block' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='Añadir al detalle' onclick='focus_cantidad("+registros[i]["producto_id"]+")'><em class='fa fa-cart-arrow-down'></em>"+mensajeboton+"</button>";                             
                             html += "<button type='button' id='botondetalle"+registros[i]["producto_id"]+"' class='btn btn-warning btn-sm btn-block'  title='Añadir al detalle' onclick='ingresar_producto("+registros[i]["producto_id"]+")'><em class='fa fa-cart-arrow-down'></em>"+mensajeboton+"</button>";
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
                        else tamanio = 2;
                    
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
                 
                        existencia = parseFloat(registros[i]["existencia"])+" "+registros[i]["producto_unidad"]+" | Bs "+Number(registros[i]["producto_precio"]).toFixed(decimales);
                        
                        
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
                        html += "           "+registros[i]["producto_unidad"]+" Bs : "+Number(precio_unidad).toFixed(decimales)+"";
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
            
            //document.getElementById('buscador1').style.display = 'none';
           // document.getElementById('categoria').style.display = 'none';
                       
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


function verificar_usuario(){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'venta/verificar_usuario';
    let usuario_clave = document.getElementById("usuario_clave").value;


    //alert(usuario_clave);

            $.ajax({url: controlador,
                type:"POST",
                data:{usuario_clave:usuario_clave},                
                success:function(respuesta){

                    let res = JSON.parse(respuesta);                            
                    res = true; //para que de momento ya no verifique
                    if (res) {  

                        registrar_operacion();

                    }else{
                        alert("Clave no valida!!");                        
                    }
                },
                error:function(respuesta){
                    res = 0;
                }
            });     

    
}
/*
function registrar_operacion(){

    let base_url = document.getElementById('base_url').value;
    let mesa_id = document.getElementById('mesa_id').value;
    let controlador = base_url+'mesa/ocupar_mesa/';
    let estado_id = 39; //39 ocupada


    //alert(usuario_clave);

            $.ajax({url: controlador,
                type:"POST",
                data:{mesa_id:mesa_id, estado_id:estado_id},                
                success:function(respuesta){

                    let res = JSON.parse(respuesta);                            

                       //location.href = base_url+"pedido/pedidoabierto/"+mesa_id;
                        //registrar_operacion();
                        
                        
                        
                },
                error:function(respuesta){
                    res = 0;
                }
            });     

}*/

function registrar_operacion(){

    let base_url = document.getElementById('base_url').value;
    let mesa_id = document.getElementById('mesa_id').value;
    let controlador = base_url+'mesa/ocupar_mesa/';
    let estado_id = 39; //39 ocupada


    //alert(usuario_clave);

            $.ajax({url: controlador,
                type:"POST",
                data:{mesa_id:mesa_id, estado_id:estado_id},                
                success:function(respuesta){

                    let pedido_id = JSON.parse(respuesta);                            

                       //location.href = base_url+"pedido/pedidoabierto/"+mesa_id;
                        //registrar_operacion();
                       //alert(res);
                      
                        //location.reload();
                        mostrar_datos_pedido(pedido_id);
                        mostrar_detalle_pedido(pedido_id);
                },
                error:function(respuesta){
                    res = 0;
                }
            });     

}


function mostrar_datos_pedido(pedido_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/mostrar_datos_pedido/';
    
        $.ajax({url: controlador,
            type:"POST",
            data:{pedido_id:pedido_id},                
            success:function(respuesta){

                let pedido = JSON.parse(respuesta);
                let pedido_id = "";
                let html = "";
                
                if(pedido.length>0){
                    
                    pedido_id = pedido[0]["pedido_id"];
                    
                    $("#pedido_id").val(pedido[0]["pedido_id"]);
                    $("#pedido_id").val(pedido[0]["pedido_id"]);
                    
                    html += "<table class='table' style='width:100%; padding: 0; border:0px;'>"
                    
//                    html += "<tr class='btn btn-facebook'> <td colspan=2 style='text-align: center; padding:0; font-size:15px;'><b>COMANDA 00"+pedido[0]["pedido_id"]+" <fa class='fa fa-coffee'></fa> "+pedido[0]["mesa_nombre"]+"</b></td></tr>";
//                    html += "<br>";
//                    html += "<tr class='btn btn-facebook'> <td style='padding:0;'><b>COD./C.I.: </b></td><td style='padding:0;'>"+pedido[0]["cliente_nit"]+"</td></tr>";
//                    html += "<tr class='btn btn-facebook'> <td style='padding:0;'><b>CLIENTE: </b></td><td style='padding:0;'>"+pedido[0]["cliente_nombre"]+"</td></tr>";
//                    
                    
                    html += "<tr> <td colspan=2 style='text-align: center; padding:0; border-top: 0px solid #f4f4f4;'><span class='btn btn-danger' style='font-size:20px;'> <b>COMANDA 00"+pedido[0]["pedido_id"]+" <fa class='fa fa-coffee'></fa> "+pedido[0]["mesa_nombre"]+"</b></span></td></tr>";
                    html += "<tr> <td colspan=2 style='text-align: center; padding:0; border-top: 0px solid #f4f4f4;'><span class='btn btn-danger' style='font-size:12px; background: purple; border-color: black;'> <b>COD./CI.: </b>"+pedido[0]["cliente_nit"]+"</span><span class='btn btn-info' style='font-size:12px; background: purple; border-color: black;'> <b>CLIENTE:</b> "+pedido[0]["cliente_nombre"]+"</span></td></tr>";
//                    html += "<tr> <td colspan=2 style='text-align: center; padding:0; font-size:16px;'><span class='btn btn-danger'> <b>CLIENTE: "+pedido[0]["cliente_nombre"]+"</b></span></td></tr>";
//                    html += "<br>";
//                    html += "<tr> <td style='padding:0;'><b>COD./C.I.: </b></td><td style='padding:0;'>"+pedido[0]["cliente_nit"]+"</td></tr>";
//                    html += "<tr> <td style='padding:0;'><b>CLIENTE: </b></td><td style='padding:0;'>"+pedido[0]["cliente_nombre"]+"</td></tr>";
                    
                    html += "</tr>"                    
                    html += "</table>"
                    
                    
                }
                
                html += "";
                
                
                $("#datos_pedido").html(html);

            },
            error:function(respuesta){
                res = 0;
            }
        });     

    
}

function mostrar_detalle_pedido(pedido_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/mostrar_detalle_pedido/';
    let decimales = document.getElementById('decimales').value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{pedido_id:pedido_id},                
            success:function(respuesta){

                let pedido = JSON.parse(respuesta);                            
                let html = "";
                $("#detalle_pedido").html(html);
                
                let total_final = 0;
                let tamanio_letra = '12px' //Tamaño de letra botones

                html += "<button type='button' class='btn btn-facebook btn-sm' data-toggle='modal' data-target='#modalproductos' id='boton_productos' style='font-size:"+tamanio_letra+";' onclick='tablaresultados(4)'><span class='fa fa-binoculars'></span><b> Productos</b></button>";
                html += "<a href='"+base_url+"pedido/imprimir/"+pedido_id+"' target='_blank' class='btn btn-warning btn-sm' id='imprimir_comanda' title='Comanda' style='font-size:"+tamanio_letra+";'><span class='fa fa-print'></span><b> Comanda</b></a>"; 
                html += "<button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#modalcambiomesa' id='boton_cambiomesa' style='font-size:"+tamanio_letra+";'><span class='fa fa-refresh'></span> <b> Cambio de Mesa</b></button>";
                html += "<a href='"+base_url+"venta/ventas' class='btn btn-success btn-sm' id='boton_ventas' title='Ventas y facturacion' style='font-size:"+tamanio_letra+";'><span class='fa fa-cubes'></span><b> Facturar</b></a>"; 
                
                if(pedido.length<=0){ //Si ya tiene productos, no se podra dar de baja
                    
                        html += "<button type='button' class='btn btn-danger btn-sm' id='boton_eliminar' style='font-size:"+tamanio_letra+";' onclick='anular_seleccion("+pedido_id+")'><span class='fa fa-refresh'></span> <b> Anular Seleccion</b></button>";
                    
                }


                html += "<table class='table' id='mitablagris' >";
                html += "<tr>";
                    html += "<th style='padding:0;'>CANT.</th>";
                    html += "<th style='padding:0;'>DESCRIPCION</th>";
                    html += "<th style='padding:0;'>PREC</th>";
                    html += "<th style='padding:0;'>TOTAL</th>";
                    html += "<th style='padding:0;'></th>";
                html += "</tr>";


                for(let i=0; i < pedido.length; i++){
                        
                    total_final += Number(pedido[i]["detalleped_total"]);
                    html +="<tr>";
                        html +="<td style='padding:0; text-align:center;'>"+formato_cantidad(pedido[i]["detalleped_cantidad"])+"</td>";
                        html +="<td style='padding:0;'>"+pedido[i]["detalleped_nombre"]+"</td>";
                        html +="<td style='padding:0; text-align: right;'>"+Number(pedido[i]["detalleped_precio"]).toFixed(decimales)+"</td>";
                        html +="<td style='padding:0; text-align: right;'>"+Number(pedido[i]["detalleped_total"]).toFixed(decimales)+"</td>";
                        html +="<td style='padding:0;'><center>";
                        html +="<button class='btn btn-xs btn-info' onclick=activar_modificacion("+pedido[i]["detalleped_id"]+","+pedido[i]["detalleped_cantidad"]+","+pedido[i]["detalleped_precio"]+")><fa class='fa fa-pencil'></fa> </button>";
                        html +="<button class='btn btn-xs btn-danger' onclick=eliminar_item("+pedido[i]["pedido_id"]+","+pedido[i]["detalleped_id"]+")><fa class='fa fa-times'></fa> </button>";
                        html += "</center></td>";
                    html +="</tr>";
                        
                }
                
                html +="<tr>";
                html +="<th colspan=2 style='font-size:14px;'>TOTALES</th><th colspan=3 style='font-size:14px;'>"+Number(total_final).toFixed(decimales)+"</th>";
                html +="</tr>";
                
                html +="</table>";
                
                
                
                $("#detalle_pedido").html(html);
                
            },
            error:function(respuesta){
                res = 0;
                let html = "";
                $("#detalle_pedido").html(html);
            }
        });     

    
}

function formato_cantidad(cantidad){
    
    var decimales = Number(document.getElementById('decimales').value);
    
    let partes = cantidad; 
                let partes1 = partes.toString(); 
                let partes2 = partes1.split('.');
                
                if (partes2[1] == 0) {  
                    lacantidad = partes2[0];  
                }else{  
                    lacantidad = numberFormat(Number(cantidad).toFixed(decimales)) 
                    //lacantidad = number_format(d['detalleven_cantidad'],2,'.',',');  
                }
  
    return lacantidad;
}

function anular_seleccion(pedido_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/anular_seleccion/';
    
        $.ajax({url: controlador,
            type:"POST",
            data:{pedido_id:pedido_id},                
            success:function(respuesta){

                let res = JSON.parse(respuesta);                            
                
                if(res){
                    alert("La anulacion fue exitosa...!!");
                }
                
                location.reload();
                
            },
            error:function(respuesta){
                res = 0;
            }
        });     

    
}

function mostrar_pedido(mesa_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/get_pedido_asociado/';
    
    //alert("mesa_id: "+mesa_id);
    
    $("#mesa_id").val(mesa_id);
    
        $.ajax({url: controlador,
            type:"POST",
            data:{mesa_id:mesa_id},                
            success:function(respuesta){

                let pedido_id = JSON.parse(respuesta);
                
                if(pedido_id>0){

                    mostrar_datos_pedido(pedido_id);
                    mostrar_detalle_pedido(pedido_id);                    
                }else{
                    let op = confirm("ERROR INESPERADO: La Mesa "+mesa_id+" no tiene una comanda generada.  ¿Desea generar una comanda?");
                    if(op){
                        modal_mesa(mesa_id);
                    }
                }
                
            },
            error:function(respuesta){
                res = 0;
                alert("No encontro nada");
            }
        });     

    
}

function eliminar_item(pedido_id, detalleped_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/eliminar_item/';

    var mensaje;
    var opcion = confirm("ADVERTENCIA: Esta a punto de eliminar un item, esta acción es irreversible. ¿Desea continuar? ");

        if (opcion == true) {

            $.ajax({url: controlador,
                type:"POST",
                data:{detalleped_id:detalleped_id},     
                success:function(respuesta){

                    //let pedido_id = JSON.parse(respuesta);                            

                    mostrar_datos_pedido(pedido_id);
                    mostrar_detalle_pedido(pedido_id);

                },
                error:function(respuesta){
                    res = 0;
                }
            });

        }
}


function activar_modificacion(detalleped_id, detalleped_cantidad, detalleped_precio){
    
   // alert(detalleped_id+" *** "+detalleped_cantidad+" *** "+detalleped_precio);
   
   $("#detalleped_id").val(detalleped_id);
   $("#detalleped_precio").val(detalleped_precio);
   $("#detalleped_cantidad").val(detalleped_cantidad);
   $("#boton_modificar").click();

    
}

function modificar_detalle(){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/modificar_detalle/';
    let detalleped_id = document.getElementById('detalleped_id').value;
    let detalleped_cantidad = document.getElementById('detalleped_cantidad').value;
    let detalleped_precio = document.getElementById('detalleped_precio').value;
    let pedido_id = document.getElementById('pedido_id').value;
    
    
        $.ajax({url: controlador,
            type:"POST",
            data:{detalleped_id:detalleped_id, detalleped_cantidad:detalleped_cantidad, detalleped_precio:detalleped_precio, pedido_id:pedido_id},                
            success:function(respuesta){
             
                mostrar_datos_pedido(pedido_id);
                mostrar_detalle_pedido(pedido_id);
                
            },
            error:function(respuesta){
                res = 0;
            }
        });     

    
}

function ingresar_producto(producto_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/registrar_producto/';
    let cantidad = document.getElementById('producto_cant'+producto_id).value;
//    let detalleped_cantidad = document.getElementById('detalleped_cantidad').value;
//    let detalleped_precio = document.getElementById('detalleped_precio').value;
    let pedido_id = document.getElementById('pedido_id').value;
    let mesa_id = document.getElementById('mesa_id').value;
    
    //alert(producto_id+" *** "+cantidad);
    
    //alert(mesa_id+" *** "+pedido_id);
    
    
    if(mesa_id>0){
        
        if(pedido_id>0){
        
            $.ajax({url: controlador,
                type:"POST",
                data:{cantidad:cantidad, producto_id:producto_id, pedido_id:pedido_id},                
                success:function(respuesta){


                    mostrar_datos_pedido(pedido_id);
                    mostrar_detalle_pedido(pedido_id);

                },
                error:function(respuesta){
                    res = 0;
                }
            });     

        }else{
            alert("ERROR: Debe seleccionar una mesa...!!");}
        
    }else{
            alert("ERROR: Debe seleccionar una mesa...!!");
    }
    
    $('#producto_cant'+producto_id).val(1);
}

function cambiar_mesa(){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/cambiar_mesa/';
    let mesa_disponible = document.getElementById('select_mesadisponible').value;
    let pedido_id = document.getElementById('pedido_id').value;
    let mesa_id = document.getElementById('mesa_id').value;    
    
//    let detalleped_cantidad = document.getElementById('detalleped_cantidad').value;
//    let detalleped_precio = document.getElementById('detalleped_precio').value;
//    let pedido_id = document.getElementById('pedido_id').value;
    
    //alert(mesa_disponible+" *** "+pedido_id+" *** "+mesa_id);
    
    if(mesa_disponible > 0){
        
        $.ajax({url: controlador,
            type:"POST",
            data:{mesa_disponible:mesa_disponible, pedido_id:pedido_id, mesa_id:mesa_id},                
            success:function(respuesta){
             
//                    mostrar_datos_pedido(pedido_id);
//                    mostrar_detalle_pedido(pedido_id);
                location.reload();
                
            },
            error:function(respuesta){
                res = 0;
            }
        });
        
    }else{
        alert("ADVERTENCIA: Debe seleccionar una mesa...!")
    }
    

    
}