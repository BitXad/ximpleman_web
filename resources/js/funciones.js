//var decimales = 6;
    
$(document).on("ready",inicio);
function inicio(){
        
//        alert("holaxxx");
        tablaresultados(1);
        tablaproductos(); 
        //pedidos_pendientes();
        let tiposistema = document.getElementById('parametro_tiposistema').value;
        if(tiposistema != 1){
            verificar_cufd();
        }
        
        document.getElementById('nit').focus();
        document.getElementById('nit').select();
        

        
}

function calculardesc(){
    
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
    
   /*
    var porcdesc = document.getElementById('tipocliente_porcdesc').value;
    var montodesc = document.getElementById('tipocliente_montodesc').value;
    
    
    if (Number(porcdesc)>0){
        //alert("eee: "+porcdesc);
        $("#tipo_descuento").val(2);        
        $("#venta_descuento").val(porcdesc);
    }
    else if(Number(montodesc)>0){
        $("#tipo_descuento").val(1);                
        $("#venta_descuento").val(montodesc);
    }   
   */
   
   var venta_subtotal = document.getElementById('venta_subtotal').value;
   var venta_descuento = document.getElementById('venta_descuento').value;      
   var tipo_descuento = document.getElementById('tipo_descuento').value;      
   var subtotal = 0;
   
   
   if (tipo_descuento==2)
   {   
       venta_descuento = venta_descuento * venta_subtotal /100;        
       $("#venta_descuento").val(venta_descuento.toFixed(decimales));
       $("#tipo_descuento").val(1);
    }

       subtotal = Number(venta_subtotal) - Number(venta_descuento); 
    
   $("#venta_totalfinal").val(subtotal.toFixed(decimales));
   
   //Calcular cambio
   var venta_efectivo = document.getElementById('venta_efectivo').value;      
   var venta_cambio = venta_efectivo - subtotal;      
   
   $("#venta_cambio").val(formato_numerico(venta_cambio.toFixed(decimales)));
   //$("#venta_efectivo").val(subtotal);
   
}

function calcularcambio(e){
    
   var decimales = Number(document.getElementById('parametro_decimales').value);
   
   tecla = (document.all) ? e.keyCode : e.which; 
   
   var venta_efectivo = document.getElementById('venta_efectivo').value;
   var venta_totalfinal = document.getElementById('venta_totalfinal').value;
   
   var venta_cambio = Number(venta_efectivo) - Number(venta_totalfinal);
   //alert(venta_cambio);
   $("#venta_cambio").val(venta_cambio.toFixed(decimales));
   
    $("#cambioy").val(venta_cambio.toFixed(decimales));
   
   
   
   if (tecla==13){ 
        $("#boton_finalizar").click();
   }
}

//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function validar(e,opcion) {
  
    var tecla = (document.all) ? e.keyCode : e.which;
    
  if (e==13){
        
        var tecla = e;
    
  }else{
      
    var tecla = (document.all) ? e.keyCode : e.which;
    
  }
    
  
  
    if (tecla==13){
    
    
        if (opcion==0){   //si la pulsacion proviene del telefono
            document.getElementById('tipocliente_id').focus();
        }
        
        if (opcion==1){   //si la pulsacion proviene del nit  

                
                if (nit==''){
                    
                        var cod = generar_codigo();
                        //Si el nit es diferente de vacio
                        
                        $("#nit").val(cod);
                        $("#razon_social").focus();
                        $("#razon_social").select();
                        $("#zona_id").val(0);                    

                }else{      
                    
                    $("#razon_social").css("background-color", "#1221");
                    $("#razon_social").removeAttr("readonly");
                    
                    document.getElementById('codigoexcepcion').checked = false;
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
            
            //$('#busqueda_serie').prop('checked') ? buscarPorSerie():buscarporcodigojsx(); realiza la busqueda e insercion mas rapido porque reduce procedimiento, falta completar las operaciones
            $('#busqueda_serie').prop('checked') ? buscarPorSerie():buscarporcodigojs();
            
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
        
        if (opcion==12){ //Si el evento viene desde el campo celular
            $("#email").focus();
            $("#email").select()();
        }
        
//        if (opcion==13){ //Si el evento viene desde el campo email
//            $("#codigo").focus();
//            $("#codigo").select()();
//        }
                
    }
    
    if (opcion==7){   //si la tecla proviene del buscador de pedido abierto
       //document.getElementById('filtrar').focus();
       seleccionar_tipocliente();
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
        
        if (opcion==6){
            document.getElementById('venta_giftcard').select();
        }
}
// esta funcion busca la cliente mediante su nit e inserta los datos 
// en cada input corresponiente si es que existe
// sino existe.. deja abierta la posibilidad de ingresar datos de nuevos de clientes
function buscarcliente(){

    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('nit').value;
    var parametro_factura = document.getElementById('parametro_factura').value;
    var parametro_verificarconexion = document.getElementById('parametro_verificarconexion').value;
    
    if (nit==''){ //Si el campo Nit esta vacio, genera NIT/Codigo automaticamente
        var cod = generar_codigo();
        $("#nit").val(cod);
        $("#razon_social").focus();
        $("#razon_social").select();
        $("#zona_id").val(0);
    }
        
    //Alistamos controlador para buscar al cliente
    var controlador = base_url+'venta/buscarcliente';
    document.getElementById('loader_documento').style.display = 'block';
    
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            success:function(respuesta){
                //Respuesta de la busqueda
                var registros = eval(respuesta);
                
                if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema carga los datos
                    
                    $("#razon_social").val(registros[0]["cliente_razon"]);
                    document.getElementById('telefono').focus();
                    $("#telefono").val(registros[0]["cliente_telefono"]);
                    $("#cliente_nombre").val(registros[0]["cliente_nombre"]);
                    $("#cliente_ci").val(registros[0]["cliente_ci"]);
                    $("#cliente_complementoci").val(registros[0]["cliente_complementoci"]);
                    $("#cliente_nombrenegocio").val(registros[0]["cliente_nombrenegocio"]);
                    $("#cliente_id").val(registros[0]["cliente_id"]);
                    $("#cliente_codigo").val(registros[0]["cliente_codigo"]);
                    $("#cliente_direccion").val(registros[0]["cliente_direccion"]);
                    $("#cliente_departamento").val(registros[0]["cliente_departamento"]);
                    $("#cliente_celular").val(registros[0]["cliente_celular"]);
                    $("#email").val(registros[0]["cliente_email"]);
                    $("#tipocliente_id").val(1);
                    $("#tipocliente_porcdesc").val(0);
                    $("#tipocliente_montodesc").val(0);
                    $("#tipo_doc_identidad").val(registros[0]["cdi_codigoclasificador"]);
                    $("#cliente_valido").val(1);
                                                        
                    document.getElementById("codigoexcepcion").checked = (registros[0]["cliente_excepcion"] == 1); 
                    
                    if (registros[0]["tipocliente_id"] != null && registros[0]["tipocliente_id"] >=0)
                    {   //si tiene definido un tipo de cliente 
                        
                        $("#tipocliente_id").val(registros[0]["tipocliente_id"]); 
                        
                        if(registros[0]["tipocliente_montodesc"]>0){
                            
                            $("#tipo_descuento").val(1);
                            $("#venta_descuento").val(registros[0]["tipocliente_montodesc"]);                            
                            calculardesc();
                        } 
                        else{
                            if(registros[0]["tipocliente_porcdesc"]>0){                                
                                $("#tipo_descuento").val(2); 
                                $("#venta_descuento").val(registros[0]["tipocliente_porcdesc"]);
                                calculardesc();
                            }
                            else{
                                $("#tipo_descuento").val(1); 
                                $("#venta_descuento").val(0);                                
                            }
                            
                        }
                    
                        $("#razon_social").focus();
                    
                    }
                    else //si no tiene asignado ningun tipo, le asignara el tipo 1 por defecto
                    {    $("#tipocliente_id").val(1); }
                        
                    if(registros[0]["zona_id"] != null && registros[0]["zona_id"] >=0){
                        $("#zona_id").val(registros[0]["zona_id"]);
                    }else{
                        $("#zona_id").val(0);
                    }
                    
                    seleccionar_documento(registros[0]["cdi_codigoclasificador"]);
                    
                    document.getElementById('loader_documento').style.display = 'none';                    
                    
                }
                else //Si el cliente es nuevo o no existe
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
                    $("#email").val("");
                    $("#zona_id").val(0);
                    $("#tipocliente_id").val(1);
                    $("#venta_descuento").val(0);
                    let tipo_sistema = document.getElementById('parametro_tiposistema').value;
                    //let dosificacion_modalidad = document.getElementById('dosificacion_modalidad').value;
                    let parametro_tipoemision = document.getElementById('parametro_tipoemision').value;
                    
                    if(tipo_sistema != 1){ //1 =SFV /2=elec en linea 3=comp. en linea
                            //alert(dosificacion_modalidad);
                            
                        //if (dosificacion_modalidad == 1){ //modalidad 1= Elec.Enlinea 2=computarizada en linea
                        if (parametro_tipoemision == 1){ //tipoemision 1 = En linea 2 = Fuera de linea
                           // alert("pasa por aqui");
                           let result;
                           if (parametro_verificarconexion==1){ //1 si, 0 no                              
                                result = verificar_conexion_enventas();
                                
                           }else{
                                result = true;                               
                             }
                            
                            let res = result;
                            //alert(res);
                            if(res){ //Si existe conexion
                                
                                let tipo_doc_identidad = base_url = document.getElementById('tipo_doc_identidad').value;
                                
                                    if(tipo_doc_identidad == 5){

                                        if (parametro_factura != 3){ // (NO ES) 3 Sin Factura
                                                verificarnit();
                                    }else{
                                            document.getElementById('loader_documento').style.display = 'none';
                                    }
                                    
                                }else{
                                    document.getElementById('loader_documento').style.display = 'none';
                                }
                                
                            }else{
                                alert("No hay comunicación con Impuestos");
                                document.getElementById('loader_documento').style.display = 'none';
                            }
                        
                        }else{ // Si es computarizado o electronica en linea
                                document.getElementById('loader_documento').style.display = 'none';
                                $('#razon_social').focus();
                                //verificarnit();
                                //$('#razon_social').select();
                        }
                    }else{
                        document.getElementById('loader_documento').style.display = 'none';
                        $('#razon_social').focus();
                    }                    
                }
                //document.getElementById('loader_documento').style.display = 'none';
            },
            error:function(respuesta){			
                $("#razon_social").val('SIN NOMBRE');
                document.getElementById('telefono').focus();
                
                $("#cliente_id").val(0);
                document.getElementById('loader_documento').style.display = 'none';   
            }                
    }); 

}

function formato_cantidad(cantidad){
    
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
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

//muestra la tabla de productos del detalle de la venta
function tablaproductos(){
    
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
    var base_url = document.getElementById('base_url').value;
    var categ = JSON.parse(document.getElementById('categoria_producto').value);
    var controlador = base_url+'venta/detalleventa';
    var parametro_diasvenc = document.getElementById('parametro_diasvenc').value;
    var venta_descuento = Number(document.getElementById('venta_descuento').value);
    var tipousuario_id = Number(document.getElementById('tipousuario_id').value);
    var parametro_moneda_id = document.getElementById('parametro_moneda_id').value; //1 bolivianos - 2 moneda extrangera
    var parametro_moneda_descripcion = document.getElementById('parametro_moneda_descripcion').value; //1 bolivianos - 2 moneda extrangera
    var parametro_datosproducto = Number(document.getElementById('parametro_datosproducto').value);
    var parametro_cantidadsimple = Number(document.getElementById('parametro_cantidadsimple').value);
    var parametro_botonesproducto = Number(document.getElementById('parametro_botonesproducto').value);
    var parametro_mostrarmoneda = Number(document.getElementById('parametro_mostrarmoneda').value);
    var parametro_tablasencilla = Number(document.getElementById('parametro_tablasencilla').value);
    var clasificador = "";
    var preferencia = "";
    var caracteristicas = "";
    var moneda_extrangera = document.getElementById('moneda_descripcion').value; //1 bolivianos - 2 moneda extrangera
    var total_final_equivalente = 0; //1 bolivianos - 2 moneda extrangera
    let tamanio_fuente = document.getElementById('parametro_tamanioletras').value+"px";
    let tamanio_fuente2 = (Number(document.getElementById('parametro_tamanioletras').value)+3)+"px";
    
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
                       var tablacss = '';
                       
                       if (parametro_tablasencilla==1)
                            tablacss = 'mitablaventassimple';
                       else
                            tablacss = 'mitablaventas';
                           
                           
                        html = "";
                        html += "<table class='table table-striped table-condensed' id='"+tablacss+"'>";
                        html += "                    <tr>";
                        html += "                            <th style='padding:5;'> # </th>";
                        html += "                            <th style='padding:5'>DESCRIPCIÓN<br>";
//                        html += "<input type='checkbox' id='check_agrupar' class='btn btn-success btn-xs'  value='1'> Agrupar";
                        html += " </th>";
                        
                        if(esMobil()){
                            html += "                            <th style='padding:0'>PRECIO<br>CANT</th>";                            
                        }else{
                            html += "                            <th style='padding:5'>CANT.</th>";                    
                            html += "                            <th style='padding:0'>PRECIO<br>"+parametro_moneda_descripcion+"</th>";
                            html += "                            <th style='padding:0'>DESC.<br>"+parametro_moneda_descripcion+"</th>";
                            html += "                            <th style='padding:0'>PRECIO<br>TOTAL "+parametro_moneda_descripcion+"</th>";
                        } 
                        html += "                            <th style='padding:0'><button onclick='quitartodo()' class='btn btn-danger btn-sm' title='Vaciar el detalle de la venta'><span class='fa fa-trash'></span><b></b></button></th>";
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
                        
                           //alert(registros[i]["detalleven_total"]);
                           cont = cont+1;
                           cant_total += parseFloat(registros[i]["detalleven_cantidad"]);
                           total_detalle += parseFloat(registros[i]["detalleven_total"]);
                         
                           //alert(total_detalle);
                           
                           let descuento_parcial = registros[i]["detalleven_descuentoparcial"];
                           if(descuento_parcial == null || descuento_parcial == "" ){
                               descuento_parcial = 0;
                           }
                           
                           total_descuentoparcial += parseFloat(descuento_parcial * registros[i]["detalleven_cantidad"]);

                        if(parametro_tablasencilla != 1){
                            
                            if (i == 0){
                                color = "style='background-color: lightgray; padding:0; color: black;'"
                                fuente = "2";
                            }
                            else {
                                color = "style='padding:0'";
                                fuente = '1';
                            }
                            
                        }else{
                            
                                color = "style='padding:0'";
                                fuente = '1';
                        }
                        
                        
                            
                        html += "                    <tr>";
                        
/////////////////// #
                        html += "			<td "+color+"><center>"+cont+"</center></td>";
//                        html += "<td "+color+"><b><font size='"+fuente+"'>"+registros[i]["producto_nombre"];

/////////////////// Descripcion
                        html += "<td "+color+"><b style='font-size:"+tamanio_fuente+"'>"+registros[i]["producto_nombre"];
                       
                       //html += " <button id='boton_composicion"+registros[i]["detalleven_id"]+"' class='btn btn-xs' style='padding:0;' onclick='mostrar_composicion("+registros[i]["detalleven_id"]+")'>[+]</button>";
                        
                       html += " <div id='tabla_composicion"+registros[i]["detalleven_id"]+"' style='padding:0;'> </div>";
//                       html += " <table style='padding:0;'> </table>";
                        clasificador = "";
                        if (registros[i]["clasificador_nombre"]!=null && registros[i]["clasificador_nombre"]!="")
                            clasificador = registros[i]["clasificador_nombre"]+" | ";

                        preferencia = "";
                        if (registros[i]["preferencia_descripcion"]!=null && registros[i]["preferencia_descripcion"]!="")
                            preferencia = registros[i]["preferencia_descripcion"]+" | ";
                        
                        html += "</b>";
                        
                        if (parametro_datosproducto==1){
                            html += " <small>"+registros[i]["detalleven_unidadfactor"]+" * "+clasificador+categoria+preferencia+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_codigobarra"]+"</small>";
                        }
//************************ INICIO CARACTERISTICAS ***************************

        if (parametro_botonesproducto!=0){
            
            html += "  <button class='btn btn-primary btn-xs' title='Registrar/modificar preferencias y características' type='button' data-toggle='collapse' data-target='#caracteristicas"+registros[i]["detalleven_id"]+"' aria-expanded='false' aria-controls='caracteristicas"+registros[i]["detalleven_id"]+"'><i class='fa fa-edit'></i></button>";

            html += "  <a href='#' data-toggle='modal' onclick='iniciar_preferencia("+registros[i]["detalleven_id"]+")' data-target='#modalpreferencia' class='btn btn-xs btn-success' style=''><i class='fa fa-tasks'></i></a>";

            // Clasificador
            html += "  <button class='btn btn-facebook btn-xs' title='Clasificador de productos' type='button' data-toggle='modal' data-target='#modalclasificador' aria-expanded='false' aria-controls='modalclasificador' onclick='mostrar_clasificador("+registros[i]["producto_id"]+","+registros[i]["detalleven_id"]+")'><i class='fa fa-list'></i></button>";
        }


html += "<div class='row'>";
html += "  <div class='col-md-12'>";
html += "    <div class='collapse multi-collapse' id='caracteristicas"+registros[i]["detalleven_id"]+"'>";
html += "      <div class='card card-body'>";

html += "        <div class='row clearfix'> ";
html += "           <div class='col-md-3' style='padding:1;'>";

let ocultar = 'hidden';
if (tipousuario_id == 1){
    ocultar = 'text';
}

html += "               <label for='producto_costo' class='control-label  text-uppercase'>Precio Costo</label>";
    html += "               <div class='form-group'>"
    let precio_costo = Number(registros[i]['detalleven_costo']);
    html += "               <input type='"+ocultar+"' name='detalleven_preferencia' value='"+precio_costo.toFixed(decimales)+"' class='btn btn-xs btn-default form-control' style='text-align:left;' id='detalleven_costo"+registros[i]["detalleven_id"]+"' />";
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

                    let detalle_cantidad = formato_cantidad(registros[i]["detalleven_cantidad"]);
                            
                    if (esMobil()){    
                        
                        html += " <td align='center'"+color+"> ";
                     
/////////////////// Cantidad                        
                        if(parametro_cantidadsimple==0){ //0 cantidad con botones 1 -cantidad simple        
                       
                            html += "                    <div class='btn-group'>      ";   
                            html += "			<button onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";
                            html += "                              		<span class='btn btn-default  btn-xs'> "+detalle_cantidad+"</span>";

                            html += "                       <input size='1' name='cantidad' class='btn btn-default btn-xs' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+detalle_cantidad+"'   onKeyUp ='cambiarcantidadjs(event,"+registros[i]["producto_id"]+")' autocomplete='off'>";
                            //onkeypress ='seleccionar_cantidad(cantidad"+registros[i]["detalleven_id"]+")'
                            html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";

                            html += "                       <button onclick='ingresorapidojs(1,"+registros[i]["producto_id"]+",0)' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></button>";
                            html += "                    </div>";
                            
                           }else{
                               
                       
//
                            html += "                       <input size='1' name='cantidad' class='btn btn-default btn-xs' id='cantidad"+registros[i]["detalleven_id"]+"' value='ssss"+detalle_cantidad+"'   onKeyUp ='cambiarcantidadjs(event,"+registros[i]["producto_id"]+")' autocomplete='off'>";
                            //onkeypress ='seleccionar_cantidad(cantidad"+registros[i]["detalleven_id"]+")'
                            html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";
                               
                           }

/////////////////// Precio
                        html += "<input size='5' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'>";
                        
/////////////////// Desc                        
                        html += "<input size='5' name='descuento' id='descuento"+registros[i]["detalleven_id"]+"' value='"+parseFloat(descuento_parcial).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'>";
                        html += "<br><font size='3' ><b>"+parseFloat(registros[i]["detalleven_total"]).toFixed(decimales)+"</b></font><br>"+total_equivalente;
                        html += "</td>";
                        html += "			<td "+color+">";
                        html += "<div style='border-color: #008d4c; background: #008D4C !important; color: white' class='btn btn-success btn-xs' onclick='actualizar_losprecios("+registros[i]["detalleven_id"]+")' title='Actualizar precios'><span class='fa fa-save' aria-hidden='true'></span></div>";
                        html += "                            <button onclick='quitarproducto("+registros[i]["detalleven_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a></button> ";
                        html += "                        </td>";    
                        
                    }
                    else{
                        
                     
                        
                        if(parametro_cantidadsimple==0){ //0 cantidad con botones 1 -cantidad simple
                            
                            html += " <td align='center' width='100' "+color+"> ";
                            html += "                    <div class='btn-group'>      ";     
                            html += "			<button style='font-size:"+tamanio_fuente+" ' onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";                       
                        
                            html += "                       <input size='1' style='font-size:"+tamanio_fuente+" '  name='cantidad' class='btn btn-default btn-xs' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+ formato_cantidad(registros[i]["detalleven_cantidad"])+"'   onKeyUp ='cambiarcantidadjs(event,"+registros[i]["producto_id"]+")' autocomplete='off'>";
                            //onkeypress ='seleccionar_cantidad(cantidad"+registros[i]["detalleven_id"]+")'
                            html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";

                            html += "                       <button style='font-size:"+tamanio_fuente+" ' onclick='incrementar(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></button>";

                            html += "                    </div>";
                            
                        }else{
                        
                            html += " <td align='center' width='30' "+color+"> ";
                            html += "                       <input size='1' style='font-size:"+tamanio_fuente+" '  name='cantidad' class='btn btn-default btn-xs' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+ formato_cantidad(registros[i]["detalleven_cantidad"])+"'   onKeyUp ='cambiarcantidadjs(event,"+registros[i]["producto_id"]+")'  autocomplete='off'>";
                            //onkeypress ='seleccionar_cantidad(cantidad"+registros[i]["detalleven_id"]+")'
                            html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";                            
                        }
                    

                        html += "</td>";

/////////////////// Precio
                        html += "<td align='right' "+color+"><input size='5' class='btn btn-default btn-xs' style='font-size:"+tamanio_fuente+" ' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")' autocomplete='off'></td>";
                        
/////////////////// Descuento
                        html += "<td align='right' "+color+"><input size='5' class='btn btn-default btn-xs' style='font-size:"+tamanio_fuente+"' name='descuento' id='descuento"+registros[i]["detalleven_id"]+"' value='"+parseFloat(descuento_parcial).toFixed(decimales)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")' autocomplete='off'></td>";
                        
/////////////////// Precio Total

                        html += "                       <td align='right'  "+color+"><b style='font-size:"+tamanio_fuente2+"' >"+parseFloat(registros[i]["detalleven_total"]).toFixed(decimales)+"</b>";
                       
                        if (parametro_mostrarmoneda == 1)
                           html += "<br>"+total_equivalente;
                       
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
                        html += "                            <th colspan=2 style='padding:0' align='right'><font size='1'> Producto(s): "+cant_total.toFixed(decimales)+"</font><br><font size='3'>Total "+parametro_moneda_descripcion+": "+total_detalle.toFixed(decimales)+"</font></th>";
                        html += "                            <th style='padding:0'></th> ";                                       
                        html += "<input type='hidden' id='venta_descuentoparcial' value="+total_descuentoparcial.toFixed(decimales)+" />";
                   }
                   else{                       
                        html += "                            <th style='padding:0'></th>";
                        html += "                            <th style='padding:0'></th>";
                        html += "                            <th style='padding:0'><font size='3'>"+cant_total.toFixed(decimales)+"</font></th>";
                        html += "                            <th style='padding:0'></th>"; 
                        html += "                            <th style='padding:0'><font size='3'>"+total_descuentoparcial.toFixed(decimales)+"</font></th>";
//                        html += "                            <th style='padding:0'></th>"; 
                        
                        html += "<input type='hidden' id='venta_descuentoparcial' value="+total_descuentoparcial.toFixed(decimales)+" />";
                       
                        html += "                            <th style='padding-bottom:0; padding-top:0; background: black; color:white;' align='right' colspan='2'><font size='3'>"+parametro_moneda_descripcion+" "+formato_numerico(total_detalle.toFixed(decimales))+"</font><br>";
                        
                        
                        if (parametro_mostrarmoneda == 1){
                            
                            if (parametro_moneda_id == 1){
                                html +=  moneda_extrangera+" "+ formato_numerico(total_final_equivalente.toFixed(decimales))+"</th>";
                            }else{
                                html +=  "Bs "+formato_numerico(total_final_equivalente.toFixed(decimales))+"</th>";
                            }
                        }
                        
                       //html += "                            <th style='padding:0'></th> ";                                                          
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
    var decimales = Number(document.getElementById('parametro_decimales').value);
    parametro_moneda_descripcion = document.getElementById("parametro_moneda_descripcion").value;
   
    efectivo = totalfinal - descuento;
    $("#venta_total").val(subtotal.toFixed(decimales));
    $("#venta_descuento").val(descuento.toFixed(decimales));
    $("#venta_subtotal").val(subtotal.toFixed(decimales));
    $("#venta_efectivo").val(efectivo.toFixed(decimales));
    $("#venta_cambio").val("0.00");
    
    $("#totaly").val(subtotal.toFixed(decimales));
    $("#cobradoy").val("0.00");
    $("#cambioy").val(subtotal.toFixed(decimales));
    
    
    

    var venta_totalfinal = parseFloat(totalfinal - descuento);
    $("#venta_totalfinal").val(venta_totalfinal.toFixed(decimales));
    
    html = "";
    html += "<div class='box' hidden>";
    html += "        <div class='box-body table-responsive table-condensed'>";
    html += "            <table class='table table-striped table-condensed' id='miotratabla'>";
    html += "<tr>";
    html += "    <th> Descripción</th>";
    html += "    <th> Total </th> "; 
    html += "</tr>";
    html += "<tr>";
    html += "    <td>Sub Total "+parametro_moneda_descripcion+"</td>";
    html += "    <td align='right'>"+subtotal.toFixed(decimales)+"</td>";
    html += "</tr> ";
    html += "<tr>";
    html += "    <td>Descuento "+parametro_moneda_descripcion+"</td>";
    html += "    <td align='right'>"+descuento.toFixed(decimales)+"</td>  ";  
    html += "</tr>";
    html += "<tr>";
    html += "    <th><b>TOTAL FINAL "+parametro_moneda_descripcion+"</b></th>";
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

function buscarporcodigojsx()
{
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/ingresarporcodigo';
   var codigo = document.getElementById('codigo').value;
   var decimales = Number(document.getElementById('parametro_decimales').value);
   var cantidad = 1;
   //var parametro_sininventario = document.getElementById('parametro_sininventario').value;
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    var codigobalanza = 1;
    
    if(codigobalanza==1){
        
        var identificador =  codigo.substring(0,3);
        
        if(identificador==215){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad'])/1000;
                
                codigo = codigoProducto;
        }
        
        if(identificador==205){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad'])/1000;
                
                codigo = codigoProducto;
        }
        
        if(identificador==224){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad']);
                
                codigo = codigoProducto;
        }
        
        //alert("verificador: " +verificador+"\n"+"codigo producto: "+codigoProducto+"\n cantidad: "+cantidad);
    }
    
    //revisará si existe algun producto con el codigo especificado
    $.ajax({url: controlador,
        
           type:"POST",
           data:{codigo:codigo, cantidad:cantidad},
           success:function(respuesta){
               
               res = JSON.parse(respuesta);
               
               tablaproductos();

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

function buscarporcodigojs(){
    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/buscarcodigo';
   var codigo = document.getElementById('codigo').value;
   var decimales = Number(document.getElementById('parametro_decimales').value);
   //var parametro_sininventario = document.getElementById('parametro_sininventario').value;
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    var codigobalanza = 1;
    
    if(codigobalanza==1){
        
        var identificador =  codigo.substring(0,3);
        
        if(identificador==200){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad'])/10000;
                
                codigo = codigoProducto;
        }
        
        if(identificador==215){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad'])/1000;
                
                codigo = codigoProducto;
        }
        
        if(identificador==205){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad'])/1000;
                
                codigo = codigoProducto;
        }
        
        if(identificador==224){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad']);
                
                codigo = codigoProducto;
        }
        
        ///alert("verificador: " +verificador+"\n"+"codigo producto: "+codigoProducto+"\n cantidad: "+cantidad);
    }
    
    //revisará si existe algun producto con el codigo especificado
    $.ajax({url: controlador,
        
           type:"POST",
           data:{codigo:codigo, cantidad:cantidad},
           success:function(respuesta){
               
               var precio = 0;
               var factor_cantidad = 0;
               var cantidad_base = 1;
               var factor_nombre = "";
               
               res = JSON.parse(respuesta);
               
               if (identificador==200){
                   cantidad_base = cantidad;
               }
               if (identificador==215){
                   cantidad_base = cantidad;
               }
               if (identificador==205){
                   cantidad_base = cantidad;
               }
               if (identificador==204){
                   cantidad_base = cantidad;
               }
               if (identificador==224){
                   cantidad_base = cantidad;
               }

               //alert("codigo: "+codigo+" - cantidad_base: "+cantidad_base);
                //alert("tipo: "+res[0].tipo);
                
                    if (res.length>0){ //verifica si el producto existe
                        
                        // Venta sin inventario
                        
//                        let condicion = false;
//                        
//                        if (parametro_sininventario == 1){
//                            condicion = true;
//                            
//                        }else{
//                            condicion = (res[0].existencia > 0);        
//                        }
//                        
                        
                         if (res[0].existencia){ //verifica si el producto tiene existencia > 0
                             
                            //verificara si el codigo le pertenece a algun factor
                            if (res[0].producto_codigobarra == codigo){
                                factor_cantidad = cantidad_base;
                                precio = res[0].producto_precio;
                                factor_nombre = "precio_normal";
                            }
                            
                            if (res[0].producto_codigofactor == codigo){
                                factor_cantidad = res[0].producto_factor;
                                precio = res[0].producto_preciofactor;
                                factor_nombre = "producto_factor";
                            }
                            
                            if (res[0].producto_codigofactor1 == codigo){
                                factor_cantidad = res[0].producto_factor1;
                                precio = res[0].producto_preciofactor1;
                                factor_nombre = "producto_factor1";
                            }
                            
                            if (res[0].producto_codigofactor2 == codigo){
                                factor_cantidad = res[0].producto_factor2;
                                precio = res[0].producto_preciofactor2;
                                factor_nombre = "producto_factor2";
                            }
                            
                            if (res[0].producto_codigofactor3 == codigo){
                                factor_cantidad = res[0].producto_factor3;
                                precio = res[0].producto_preciofactor3;
                                factor_nombre = "producto_factor3";
                            }
                            
                            if (res[0].producto_codigofactor4 == codigo){
                                factor_cantidad = res[0].producto_factor4;
                                precio = res[0].producto_preciofactor4;
                                factor_nombre = "producto_factor4";
                            }
                            
                           
                           //alert("factor: "+factor+" * precio: "+precio+" * factor_nombre: "+factor_nombre);
                            //html = "<input type='text' value='"+factor+"' id='select_factor"+res[0].producto_id+"' title='select_factor"+res[0].producto_id+"'>"
                            
                            precio_unidad = precio; //res[0]["producto_precio"];
                            
                            html = "";
                            html += "   <select class='btn btn-facebook' style='font-size:12px; font-family: Arial; padding:0; background: black;' id='select_factor"+res[0]["producto_id"]+"' name='select_factor"+res[0]["producto_id"]+"' onchange='mostrar_saldo("+JSON.stringify(res[0])+")'>";
                            html += "       <option value='"+factor_nombre+"'>";                            
                            html += "           "+res[0]["producto_unidad"]+" "+res[0]["moneda_descripcion"]+": "+Number(precio_unidad).toFixed(decimales)+"";
                            html += "       </option>";
                            html += "       </select>";

                            $("#selector").html(html);
                            
                            // Como ya se tiene idetificado el factor se procede a ingresar el producto
                            //factor es la cantidad de items que tiene la presentacion, res[0] son todos los datos del producto
//                            ingresorapidojs(factor_cantidad, res[0]["producto_id"],factor_nombre); 
                            ingresorapidojs(factor_cantidad, res[0]["producto_id"],factor_nombre); //la cantidad siempre sera 1 porque es proveniente del codigo de barras/cod producto


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

function buscarporcodigojssss()
{
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/buscarcodigo';
   var codigo = document.getElementById('codigo').value;
   var decimales = Number(document.getElementById('parametro_decimales').value);
   //var parametro_sininventario = document.getElementById('parametro_sininventario').value;
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    var codigobalanza = 1;
    
    if(codigobalanza==1){
        
        var identificador =  codigo.substring(0,3);
        
        if(identificador==200){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad'])/10000;
                
                codigo = codigoProducto;
        }
        
        if(identificador==215){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad'])/1000;
                
                codigo = codigoProducto;
        }
        
        if(identificador==205){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad'])/1000;
                
                codigo = codigoProducto;
        }
        
        if(identificador==224){
            
                resultado = procesarCodigoBarras(codigo);
            
                var verificador = resultado['verificador'];
                var codigoProducto = resultado['codigoProducto'];
                var cantidad = Number(resultado['cantidad']);
                
                codigo = codigoProducto;
        }
        
        ///alert("verificador: " +verificador+"\n"+"codigo producto: "+codigoProducto+"\n cantidad: "+cantidad);
    }
    
    //revisará si existe algun producto con el codigo especificado
    $.ajax({url: controlador,
        
           type:"POST",
           data:{codigo:codigo, cantidad:cantidad},
           success:function(respuesta){
               
               var precio = 0;
               var factor_cantidad = 0;
               var cantidad_base = 1;
               var factor_nombre = "";
               
               res = JSON.parse(respuesta);
               
               if (identificador==200){
                   cantidad_base = cantidad;
               }
               if (identificador==215){
                   cantidad_base = cantidad;
               }
               if (identificador==205){
                   cantidad_base = cantidad;
               }
               if (identificador==204){
                   cantidad_base = cantidad;
               }
               if (identificador==224){
                   cantidad_base = cantidad;
               }

               //alert("codigo: "+codigo+" - cantidad_base: "+cantidad_base);
                //alert("tipo: "+res[0].tipo);
                
                    if (res.length>0){ //verifica si el producto existe
                        
                        // Venta sin inventario
                        
//                        let condicion = false;
//                        
//                        if (parametro_sininventario == 1){
//                            condicion = true;
//                            
//                        }else{
//                            condicion = (res[0].existencia > 0);        
//                        }
//                        
                        
                         if (res[0].existencia){ //verifica si el producto tiene existencia > 0
                             
                            //verificara si el codigo le pertenece a algun factor
                            if (res[0].producto_codigobarra == codigo){
                                factor_cantidad = cantidad_base;
                                precio = res[0].producto_precio;
                                factor_nombre = "precio_normal";
                            }
                            
                            if (res[0].producto_codigofactor == codigo){
                                factor_cantidad = res[0].producto_factor;
                                precio = res[0].producto_preciofactor;
                                factor_nombre = "producto_factor";
                            }
                            
                            if (res[0].producto_codigofactor1 == codigo){
                                factor_cantidad = res[0].producto_factor1;
                                precio = res[0].producto_preciofactor1;
                                factor_nombre = "producto_factor1";
                            }
                            
                            if (res[0].producto_codigofactor2 == codigo){
                                factor_cantidad = res[0].producto_factor2;
                                precio = res[0].producto_preciofactor2;
                                factor_nombre = "producto_factor2";
                            }
                            
                            if (res[0].producto_codigofactor3 == codigo){
                                factor_cantidad = res[0].producto_factor3;
                                precio = res[0].producto_preciofactor3;
                                factor_nombre = "producto_factor3";
                            }
                            
                            if (res[0].producto_codigofactor4 == codigo){
                                factor_cantidad = res[0].producto_factor4;
                                precio = res[0].producto_preciofactor4;
                                factor_nombre = "producto_factor4";
                            }
                            
                           
                           //alert("factor: "+factor+" * precio: "+precio+" * factor_nombre: "+factor_nombre);
                            //html = "<input type='text' value='"+factor+"' id='select_factor"+res[0].producto_id+"' title='select_factor"+res[0].producto_id+"'>"
                            
                            precio_unidad = precio; //res[0]["producto_precio"];
                            
                            html = "";
                            html += "   <select class='btn btn-facebook' style='font-size:12px; font-family: Arial; padding:0; background: black;' id='select_factor"+res[0]["producto_id"]+"' name='select_factor"+res[0]["producto_id"]+"' onchange='mostrar_saldo("+JSON.stringify(res[0])+")'>";
                            html += "       <option value='"+factor_nombre+"'>";                            
                            html += "           "+res[0]["producto_unidad"]+" "+res[0]["moneda_descripcion"]+": "+Number(precio_unidad).toFixed(decimales)+"";
                            html += "       </option>";
                            html += "       </select>";

                            $("#selector").html(html);
                            
                            // Como ya se tiene idetificado el factor se procede a ingresar el producto
                            //factor es la cantidad de items que tiene la presentacion, res[0] son todos los datos del producto
//                            ingresorapidojs(factor_cantidad, res[0]["producto_id"],factor_nombre); 
                            ingresorapidojs(factor_cantidad, res[0]["producto_id"],factor_nombre); //la cantidad siempre sera 1 porque es proveniente del codigo de barras/cod producto


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

function buscarPorSerie(){
    let base_url = $('#base_url').val();
    let controlador = `${base_url}venta/buscar_serie`;
    let serie = $('#codigo').val();

    $('#oculto').css('display','block'); //mostrar el bloque del loader
    
    $.ajax({
        url: controlador,
        type:"POST",
        cache: false,
        data:{
            serie:serie,
        },
        success:(respuesta)=>{
            let precio = 0;
            let factor_nombre = "";
            res = JSON.parse(respuesta);
            if(res[0].venta_id == null){
                if (res.length>0){
                    if (res[0].existencia > 0){                        
                        if (res[0].detallecomp_series == serie){
                            factor = 1;
                            precio = res[0].producto_precio;
                            factor_nombre = "";
                        }
                        precio_unidad = precio; //res[0]["producto_precio"];
                        html = `<select class='btn btn-facebook' style='font-size:12px; font-family: Arial; padding:0; background: black;' id='select_factor${res[0]["producto_id"]}' name='select_factor${res[0]["producto_id"]}' onchange='mostrar_saldo(${JSON.stringify(res[0])})'>"
                                    <option value='${factor_nombre}'>${res[0]["producto_unidad"]} ${res[0]["moneda_descripcion"]}:${precio_unidad.fixed(2)}</option>
                                </select>`;
                        $("#selector").html(html);
                        ingresorapidojs2(factor, res[0],serie);
                        //ingresorapidojs(factor,res[0]);
                    }else{    
                        alert('La serie ya se encuentra resgistrada o ya está vendida...!');
                    }
                }else{
                    alert('El producto no se encuentra registrado con el código especificado...!!'); 
                }
            }else{
                alert(`La serie ya se encuentra registrada en la venta N° ${res[0].venta_id}`);
            }        
        },
        error:function(respuesta){
            alert('ERROR: No existe el producto con la serie seleccionada...!!');
            $("#codigo").select();
        },
        complete: function (respuesta) {
            if (respuesta == null){
                alert('El producto no se encuentra registrado o se encuentra agotado en inventario..!!!');
            }              
            $('#oculto').css('display','none'); //ocultar el bloque del loader
            $("#codigo").select();
        }
    });
    $('#oculto').css('display','none'); //ocultar el bloque del loader
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
function ingresardetallejs(producto_id)
{
 
   //cuando viene la cantidad del modal cantidad 
   var decimales = Number(document.getElementById('parametro_decimales').value);
   var cantidad = parseFloat(document.getElementById('cantidad'+producto_id).value);
   let tipo_sistema = document.getElementById('parametro_tiposistema').checked;
   let es_facturado = document.getElementById('facturado').checked;
   
   //alert("cantidad: "+cantidad+" producto_id: cantidad"+producto_id)
   /* ********************INICIO para redondeo a dos decimales ***************
    * Por norma de impuestos; controla si es electronico o computarizado en linea y si es facturado
    * si fuese el caso la cantidad lo redondea a 2 digitos decimales */
   if(tipo_sistema != 1){
       if(es_facturado){
           
           cantidad = Number(cantidad).toFixed(decimales);
           
       }
   }
   /* ********************F I N  para redondeo a dos decimales ****************/
   ingresorapidojs(cantidad,producto_id,0);
 
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
   else alert("xxxADVERTENCIA: La cantidad excede la existencia del inventario...!!");

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
    var decimales = Number(document.getElementById('parametro_decimales').value);
    var cantidad_detalle = cantidad_en_detalle(producto_id)+1;
    cantidad_detalle = Number(cantidad_detalle).toFixed(decimales);
    
    //alert("Cantida decimales: "+decimales);
    
    var cantidad_disponible =  existencia(producto_id);
    cantidad_disponible = Number(cantidad_disponible).toFixed(decimales);
    
   if (cantidad_detalle <= cantidad_disponible){
       
        $.ajax({url: controlador,
                type:"POST",
                data:{cantidad:cantidad,detalleven_id:detalleven_id},
                success:function(respuesta){
                    
                    tablaproductos();
                    //tabladetalle();
                    //tabladetalle(subtotal,descuento,totalfinal)
                    
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
                //tabladetalle();                
            }
        
    });
    location.reload();
}

//esta funcion incrementar una cantidad determinada de productos
function reducir(cantidad,detalleven_id)
{
    

        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+"venta/reducir/";
        let descuentoparcial = document.getElementById('descuento'+detalleven_id).value;
        
        if (Number(cantidad)>0){
            
            $.ajax({url: controlador,
                type:"POST",
                data:{cantidad:cantidad,detalleven_id:detalleven_id, descuentoparcial:descuentoparcial},
                success:function(respuesta){
                    tablaproductos();
                   // tabladetalle();                
                }

            });     
        }
 
    
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
    var precio = document.getElementById('precio'+detalleven_id).value;
    var descuentoparcial = document.getElementById('descuento'+detalleven_id).value;
    
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


function ingresorapidojs2(cantidad,producto,serie = ''){       
    //alert(producto.producto_nombre);
    var factor_nombre = ""; //cantidad del factor seleccionado
    var indice = 0; //cantidad del factor seleccionado
    var detalleven_id = 0; //cantidad del factor seleccionado
    var tipo_cambio =  document.getElementById("moneda_tc").value;
    var decimales =  document.getElementById("parametro_decimales").value;
    
    try {
        
        factor_nombre = document.getElementById("select_factor"+producto.producto_id).value; //cantidad del factor seleccionado

    } catch (error) {
        //console.error(error);
        
        factor_nombre = ""; //cantidad del factor seleccionado
        
    }
    
    
    try {
        indice = document.getElementById("select_factor"+producto.producto_id).selectedIndex; //cantidad del factor seleccionado
        if (indice == 0){
            if (factor_nombre!="")
                indice = 1;
        }

    } catch (error) {
        //console.error(error);
        
        if (factor_nombre=="")
            indice = 0; //cantidad del factor seleccionado        
        else
            indice = 1;
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
    var descuentoparcial = 0;
    var descuento = 0;
    var cantidad_total = parseFloat(cantidad_en_detalle(producto.producto_id)) + cantidad; 
    var descuentoparcial = 0; 
    var check_agrupar = document.getElementById('check_agrupar').checked;
    var parametro_diasvenc = document.getElementById('parametro_diasvenc').value;
    var preferencia_id = document.getElementById('preferencia_id').value;
    var parametro_moneda_id = document.getElementById('parametro_moneda_id').value; //1 bolivianos - 2 moneda extrangera
    
    var clasificador_id = "";
    
    try {
        clasificador_id = document.getElementById('select_clasificador'+producto_id).value;

    } catch (error) {
        //console.error(error);
        clasificador_id = 0; //cantidad del factor seleccionado
        
    }
    
    // var preferencias = "";
    // try {
        //     preferencias = document.getElementById('input_detalleven_preferencia'+producto_id).value ;
        //     console.log(preferencias)
        
        // } catch (error) {
            //     console.log(serie);
            
        
    // }        
        
    // alert(clasificador_id);   
        
    if (check_agrupar){
        agrupado = 1;
    }
    else{
        agrupado = 0;
    }

    var preferencias = $(`#detalleven_preferencia${producto.detalleven_id}`).val();
    preferencias = preferencias == null ?  serie : `${preferencias} ${serie}`; //preferencias
    console.log(producto.detalleven_id);
        //alert(cantidad);
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
            
        
        datos1 +="0,1,"+producto.producto_id+",'"+producto.producto_codigo+"',"+cantidad+",'"+producto.producto_unidad+"',"+costo+","+precio+","+precio+"*"+cantidad+",";
        datos1 += descuentoparcial+","+descuento+", round("+precio+"*"+cantidad+" ,2) ,'"+producto.producto_caracteristicas+"','"+preferencias+"',0,1,"+usuario_id+","+producto.existencia+",";
        datos1 += "'"+producto.producto_nombre+"','"+producto.producto_unidad+"','"+producto.producto_marca+"',";
        datos1 += producto.categoria_id+",'"+producto.producto_codigobarra+"',";        
        datos1 += producto.producto_envase+",'"+producto.producto_nombreenvase+"',"+producto.producto_costoenvase+","+producto.producto_precioenvase+",";
        datos1 += cantidad+",0,"+cantidad+",0,0, DATE_ADD(CURDATE(), interval "+parametro_diasvenc+" day),'"+unidadfactor+"',"+preferencia_id+","+clasificador_id+","+tipo_cambio;
        //alert(datos1);

        $.ajax({url: controlador,
            type:"POST",
            data:{
                datos1:datos1, 
                existencia:existencia,
                producto_id:producto_id,
                cantidad:cantidad, 
                descuento:descuento, 
                agrupado:agrupado, 
                detalleven_id:detalleven_id,
                preferencias:preferencias,
            },
            success:function(respuesta){
                                
                tablaproductos();

            }
        });
    
    }
    else { alert('bbbADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+Number(producto.existencia).toFixed(decimales));}
    
}
//

function get_producto(producto_id){
    
        var base_url = document.getElementById("base_url").value;
        var controlador = base_url+"venta/get_producto_id";
        
        $.ajax({url: controlador,
                type:"POST",
                data:{producto_id:producto_id}, 
                async: false,
                success:function(respuesta){
                    
                    var res = JSON.parse(respuesta);
                    //alert(JSON.stringify(res));
                    producto = res;
                },
                error:function(respuesta){

                  producto = null;
                }
         }); 
    return producto;     
}

function get_producto_detalle(producto_id){
    
        var base_url = document.getElementById("base_url").value;
        var controlador = base_url+"venta/get_producto_detalle_id";
        
        $.ajax({url: controlador,
                type:"POST",
                data:{producto_id:producto_id}, 
                async: false,
                success:function(respuesta){
                    
                    var res = JSON.parse(respuesta);
                    //alert(JSON.stringify(res));
                    producto = res;
                },
                error:function(respuesta){

                  producto = null;
                }
         }); 
    return producto;     
}

function ingresorapidojs(cantidad,producto_id,nombre_factor){       
    
    var factor_nombre = (nombre_factor==0)?"":nombre_factor; //cantidad del factor seleccionado
    var indice = 0; //cantidad del factor seleccionado
    var detalleven_id = 0; //cantidad del factor seleccionado
    var tipo_cambio =  document.getElementById("moneda_tc").value;
    var parametro_moneda_id = document.getElementById('parametro_moneda_id').value; //1 bolivianos - 2 moneda extrangera
    var decimales = document.getElementById('parametro_decimales').value;
    //var parametro_sininventario = document.getElementById('parametro_sininventario').value; //1 bolivianos - 2 moneda extrangera
    
    document.getElementById('mensaje_enviado').style.display = 'none';
    document.getElementById('mensaje_no_enviado').style.display = 'none';
    
    //***** Obtenemos el producto en base a su Id *******
    
    var producto = get_producto(producto_id);
    var precio = Number(producto.producto_precio).toFixed(decimales);
    
    //*****************************************
    
    // intentamos obtener el nombre_factor y el indice por si acaso proviene del select_factor
    try {        
        
        if (factor_nombre ==""){ //Si ya tien

            factor_nombre = document.getElementById("select_factor"+producto.producto_id).value; //cantidad del factor seleccionado
            indice = document.getElementById("select_factor"+producto.producto_id).selectedIndex; //cantidad del factor seleccionado
            
        }
        
    } catch (error) {
        
        indice = 0; //cantidad del factor seleccionado        
        
    }
    

    //intentamos obtener el detalleven_id
    try{
        detalleven_id = producto.detalleven_id;
    }catch (error) {
        detalleven_id = 0;   
    }

    var factor = 0;    
    var numerofactor = 0;
    var unidadfactor = "";
    
    //Para el modulo de comida rapida
    
    var inputcaract = document.getElementById("inputcaract").value;
    
    if (inputcaract.length>0){
        preferencias = inputcaract;
        $("#inputcaract").val("");
    }
    else{
        preferencias = producto.producto_caracteristicas;
    }
    
    //******************************************
    
    //alert("indice: "+indice+" factor_nombre: "+factor_nombre);
    
    if ( Number(indice)>0){
        factor_nombre = document.getElementById("select_factor"+producto.producto_id).value; //cantidad del factor seleccionado
    }


            if (factor_nombre == "precio_normal"){
                precio = Number(producto.producto_precio).toFixed(decimales);
                factor = 1;
                unidadfactor = producto.producto_unidad;
                numerofactor = "0";
            }    

            if (factor_nombre == "producto_factor"){
                precio = Number(producto.producto_preciofactor).toFixed(decimales);
                factor = producto.producto_factor;
                unidadfactor = producto.producto_unidadfactor;
                numerofactor = "";
            }    

            if (factor_nombre == "producto_factor1"){
                precio = Number(producto.producto_preciofactor1).toFixed(decimales);
                factor = producto.producto_factor1;
                unidadfactor = producto.producto_unidadfactor1;
                numerofactor = "1";
            }    

            if (factor_nombre == "producto_factor2"){
                precio = Number(producto.producto_preciofactor2).toFixed(decimales);
                factor = producto.producto_factor2;
                unidadfactor = producto.producto_unidadfactor2;
                numerofactor = "2";
            }    

            if (factor_nombre == "producto_factor3"){
                precio = Number(producto.producto_preciofactor3).toFixed(decimales);
                factor = producto.producto_factor3;
                unidadfactor = producto.producto_unidadfactor3;
                numerofactor = "3";
            }    

            if (factor_nombre == "producto_factor4"){
                precio = Number(producto.producto_preciofactor4).toFixed(decimales);
                factor = producto.producto_factor4;
                unidadfactor = producto.producto_unidadfactor4;
                numerofactor = "4";
            }    


    var cantidad = cantidad * factor; // * factor;

    
    var base_url = document.getElementById('base_url').value;   
    var controlador = base_url+"venta/ingresar_detalle";
    var usuario_id = document.getElementById('usuario_id').value;
    var existencia =  producto.existencia;    
    var producto_id =  producto.producto_id;
    var datos1 = "";
    
    var descuentoparcial = producto.detalleven_descuentoparcial;
    var descuento = producto.detalleven_descuento;
    if(descuentoparcial == undefined){
        descuentoparcial = 0;
    }
    if(descuento == undefined){
        descuento = 0;
    }
    //alert("cantidad_en_detalle: "+cantidad_en_detalle(producto.producto_id));
    
    var cantidad_total = parseFloat(cantidad_en_detalle(producto.producto_id)) + cantidad; 
    //alert("cantidad_total: "+cantidad_total);
    
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
        
    if (check_agrupar){
        agrupado = 1;
    }
    else{
        agrupado = 0;
    }
     
//    let condicion = false;
//        //alert(cantidad_total);
//        //alert(parametro_sininventario);
//    if (parametro_sininventario == 1){
//        condicion = true;
//        producto.existencia = 100000;
//    }else{
//        condicion = (cantidad_total <= producto.existencia);        
//    }

     
    if (cantidad_total <= producto.existencia){
        
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
        
        datos1 +="0,1,"+producto.producto_id+",'"+producto.producto_codigo+"',"+cantidad+",'"+producto.producto_unidad+"',"+costo+","+precio+","+precio+"*"+cantidad+",";
        datos1 += descuento+","+descuentoparcial+","+(precio-descuentoparcial)+"*"+cantidad+",'"+producto.producto_caracteristicas+"','"+preferencias+"',0,1,"+usuario_id+","+producto.existencia+",";
        datos1 += "'"+producto.producto_nombre+"','"+producto.producto_unidad+"','"+producto.producto_marca+"',";
        datos1 += producto.categoria_id+",'"+producto.producto_codigobarra+"',";        
        datos1 += producto.producto_envase+",'"+producto.producto_nombreenvase+"',"+producto.producto_costoenvase+","+producto.producto_precioenvase+",";
        datos1 += cantidad+",0,"+cantidad+",0,0, DATE_ADD(CURDATE(), interval "+parametro_diasvenc+" day),'"+unidadfactor+"',"+preferencia_id+","+clasificador_id+","+tipo_cambio;
        //alert(datos1);

        $.ajax({url: controlador,
            type:"POST",
            data:{datos1:datos1, existencia:existencia,producto_id:producto_id,cantidad:cantidad, descuento:descuento,descuentoparcial:descuentoparcial, agrupado:agrupado, detalleven_id:detalleven_id},
            success:function(respuesta){

                tablaproductos();

            }
        });
    }
    else { alert('cccADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+Number(producto.existencia).toFixed(decimales));}
    
}

function ingresorapidojsx(cantidad,producto_id,nombre_factor){       
    
    var base_url = document.getElementById('base_url').value;   
    var controlador = base_url+"venta/ingresorapidojsx";    
    
    document.getElementById('mensaje_enviado').style.display = 'none';
    document.getElementById('mensaje_no_enviado').style.display = 'none';
    
    //*****************************************
    //alert("cantidad: "+cantidad+" * producto: "+producto_id+" * nombre_factor: "+nombre_factor);    
    
        $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,producto_id:producto_id,nombre_factor:nombre_factor},
            success:function(respuesta){

                tablaproductos();

            }
        });

    
}


function cambiarcantidadjs(e,prod_id)
{   
    var producto = get_producto_detalle(prod_id);
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
    let tecla = (document.all) ? e.keyCode : e.which;
    
    
    //alert(JSON.stringify(producto));
    if (tecla==13)
    {
        //alert("Fue enter <-|");
        var base_url = document.getElementById('base_url').value;   
        var controlador = base_url+"venta/ejecutar_cambiarcantidad";
        //var usuario_id = document.getElementById('usuario_id').value;
        var existencia =  parseFloat(producto.existencia);    
        var producto_id =  producto.producto_id; 
        //alert("cantidad: "+producto.detalleven_id);
        var cantidad =  document.getElementById('cantidad'+producto.detalleven_id).value;
        
        cantidad =  Number(cantidad).toFixed(decimales);
         
        var sql = "";
        
        var descuento = document.getElementById('descuento'+producto.detalleven_id).value;
        var cantidad_total = parseFloat(cantidad_en_detalle_otros(producto.producto_id)) + parseFloat(cantidad); 

        if (Number(cantidad)>0){
            
            
            if (parseFloat(cantidad_total) <= parseFloat(existencia)){
                
                
                sql = "update detalle_venta_aux set detalleven_cantidad =  "+cantidad+
                        ", detalleven_subtotal = detalleven_precio * (detalleven_cantidad)"+
                        ", detalleven_descuento = "+descuento+
                        ", detalleven_total = (detalleven_precio - "+descuento+")*(detalleven_cantidad)"+
                        "  where producto_id = "+producto_id+" and  detalleven_id = "+producto.detalleven_id ; //usuario_id = "+usuario_id;
                //alert("cantidad: "+cantidad);
               // alert(sql);

                $.ajax({url: controlador,
                    type:"POST",
                    data:{sql:sql},
                    success:function(respuesta){
                        //var r = JSON.parse(respuesta);
                        //alert("llego hasta aqui");
                        tablaproductos();
                    }
                }); 
                
                

            }
            else { 

                alert('ADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+producto.existencia);}
                tablaproductos();
        }
        
        
    }
}


//function mostrar_saldo(existencia, producto_id)
function mostrar_saldo(producto)
{
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
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
        exist = "<center><font size='3'><b>"+Number(existencia).toFixed(decimales); +"</b></font><br>"+unidad+"</center>";
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

function registrar_ingreso_rapido(producto_id){
    
    var producto = get_producto(producto_id);
    $("#ingresorapido_producto").val(producto.producto_nombre);
    $("#filtrar").val(producto.producto_nombre);
    $("#ingresorapido_producto_id").val(producto.producto_id);
    $("#ingresorapido_cantidad").val("0.00");
    $("#boton_modal_ingreso").click();
    
    focus_ingreso_rapido();
    
}

function modificar_precios(producto_id){
    
    var decimales = document.getElementById('parametro_decimales').value; 
    
    //$("#modificarprecios_producto").val(producto.producto_nombre);
    
    var producto = get_producto(producto_id);
    
    $("#modificarprecios_producto").val(producto.producto_nombre);
    $("#filtrar").val(producto.producto_nombre);
    $("#modificarprecios_producto_id").val(producto.producto_id);
    $("#modificarprecios_producto_costo").val(Number(producto.producto_costo).toFixed(decimales));
    $("#modificarprecios_producto_precio").val(Number(producto.producto_precio).toFixed(decimales));
    $("#boton_modal_actualizarprecio").click();
    
    focus_cambio_rapido();
    
}

function guardar_ingreso_rapido(){
      
    var base_url = document.getElementById('base_url').value;   
    var controlador = base_url+"compra/compra_rapida";
    var producto_id = document.getElementById("ingresorapido_producto_id").value;
    var cantidad = document.getElementById("ingresorapido_cantidad").value;
    var moneda_tc = document.getElementById("moneda_tc").value;
   
    $.ajax({url: controlador,
        type:"POST",
        data:{producto_id:producto_id, cantidad:cantidad, moneda_tc:moneda_tc },
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

function calcular_cantidad(producto_id){
    
    var ancho = document.getElementById("producto_ancho"+producto_id).value;
    var alto = document.getElementById("producto_alto"+producto_id).value;
    var cantidad = Number(ancho) * Number(alto);
    
    $("#cantidad"+producto_id).val(cantidad);
    
}




//Tabla resultados de la busqueda
function tablaresultados(opcion)
{   
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
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
    var parametro_modulorestaurante = document.getElementById('parametro_modulorestaurante').value; // modo de visualizacion 1 = modo texto , 2 = modo grafico
    var ancho_boton = document.getElementById('parametro_anchoboton').value; //base 115
    var alto_boton = document.getElementById('parametro_altoboton').value;
    var color_boton = document.getElementById('parametro_colorboton').value;
    var ancho_imagen = document.getElementById('parametro_anchoimagen').value;//document.getElementById('parametro_anchoimagen').value;
    var alto_imagen = document.getElementById('parametro_altoimagen').value; //document.getElementById('parametro_altoimagen').value;
    var forma_imagen = document.getElementById('parametro_formaimagen').value; //document.getElementById('parametro_altoimagen').value;
    var datosboton = document.getElementById('parametro_datosboton').value; //document.getElementById('parametro_altoimagen').value;
    var select_buscador = document.getElementById('select_buscador').value; //document.getElementById('parametro_altoimagen').value;
    
    var rol_precioventa = document.getElementById('rol_precioventa').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor = document.getElementById('rol_factor').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor1 = document.getElementById('rol_factor1').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor2 = document.getElementById('rol_factor2').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor3 = document.getElementById('rol_factor3').value; //document.getElementById('parametro_altoimagen').value;
    var rol_factor4 = document.getElementById('rol_factor4').value; //document.getElementById('parametro_altoimagen').value;
    var parametro_sininventario = document.getElementById('parametro_sininventario').value; //document.getElementById('parametro_altoimagen').value;
    
    var parametro_cantidadproductos = document.getElementById("parametro_cantidadproductos").value;
        
    let tamanio_fuente = document.getElementById('parametro_tamanioletrasboton').value+"px";
    
    
    // var lista_preferencias = JSON.parse(document.getElementById('preferencias').value);
    
    // let busqueda_serie 
    $('#busqueda_serie').prop('checked')  

    if(esMobil()) { tamanio = 1; }
    else{ tamanio = 2; }
    
    
    if (opcion == 1){
        //alert(select_buscador);
        if(select_buscador>0){
            
            if (select_buscador==1){
                controlador = base_url+'venta/buscarprincipioactivo/';
                parametro = document.getElementById('filtrar').value
            }
            if (select_buscador==2){
                controlador = base_url+'venta/buscarprincipioactivo/';
                parametro = document.getElementById('filtrar').value
            }
            if (select_buscador==3){
                controlador = base_url+'venta/buscarmarcas/';
                parametro = document.getElementById('filtrar').value;
            }
            
        }else{
            controlador = base_url+'venta/buscarproductos/';
            parametro = document.getElementById('filtrar').value
        }
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
        controlador = base_url+'venta/buscarmarcas/';
        parametro = document.getElementById('marca_producto').value;        
    }

    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    $.ajax({
        url: controlador,
        type:"POST",
        data:{
            parametro:parametro,
        },
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
                   html += "                <th>DESCRIPCIÓN</th>";
                   
                    if(! esMobil()) { //si no es dispositivo mobil
                        mensajeboton = "";
                        html += "                <th>PRECIO</th>";
                        html += "                <th> </th>";
                    }
                    else{
                        mensajeboton = " Añadir al detalle"; //mensaje para el boton del carrito
                        
                    }
                    
                   html += "                </tr>";
                   html += "                <tbody class='buscar' >";
         
                    sql = ""; 
                    comilla = "'";
                    
                   var x = 0;
                   
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                      
                    for (var i = 0; i < x ; i++){
                        
                        var mimagen = "";
                        
                        if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                            
                            mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+registros[i]["producto_foto"]+"' class='img img-circle' width='20' height='20' />";
                            mimagen += "</a>";
                            
                            
                        }else{                        
                            
                            mimagen = "<img src='"+base_url+"resources/images/productos/thumb_image.png' class='img img-circle' width='30' height='30' />";
                            
                            
                        }
                        
                        html += "<input type='text' value='"+registros[i]["existencia"]+"' id='existencia"+registros[i]["producto_id"]+"' hidden>";
                        html += "<tr>";
                        html += "<td class='button btn-default' onclick='ocultar_busqueda();' style='padding:0;'>"+(i+1)+"</td>";
                        
                        nombreprod = registros[i]["producto_nombre"];
                        
//                        if (nombreprod.length>35)
//                            nombreprod = "<span title='"+nombreprod+"'>"+nombreprod.substr(0,34)+"...</span>";
                        
                        //html += "<td  style='padding:0'><font size='"+tamanio+"' face='Arial Narrow'><b>"+ registros[i]["producto_nombre"]+"</b></font>";
                        html += "<td  style='padding:0; line-height:10pt;'><font size='"+tamanio+"' face='Arial Narrow'><b>"+ nombreprod+"</b></font>";

                        //productos no homologados
                        if( !(Number(registros[i]["producto_codigosin"])>0 && Number(registros[i]["producto_codigounidadsin"])>0 ))
                                html += " <a href='"+base_url+"producto/edit/"+registros[i]["producto_id"]+"' target='_blank' class='btn btn-warning btn-xs' style='padding:0px;' title='Este producto no ha sido homologado, por lo tanto no puede incluirla en una factura...!'> Sin homologar </a>";
//                                html += " <span class='btn btn-warning btn-xs' style='padding:0px;' title='Este producto no ha sido homologado, por lo tanto no puede incluirla en una factura...!'> Sin homologar </span>";
//                                html += " <button class='btn btn-success btn-xs'>o</button>";
                        
                        
                        
                        html += mimagen;   
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+" | "+registros[i]["producto_codigobarra"];                        
                        html += "<input type='text' id='input_unidad"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidad"]+"' hidden>";
                        html += "<input type='text' id='input_unidadfactor"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidadfactor"]+"' hidden>";  
                        html += "<button class='btn btn-info btn-xs' style='padding:0px;' title='Verificar cantidades en sucursales'  data-toggle='modal' data-target='#modalsucursales'>- <fa class='fa fa-bar-chart' onclick='seleccionar_producto("+registros[i]["producto_id"]+","+JSON.stringify(registros[i]["producto_nombre"])+", "+JSON.stringify(registros[i]["producto_codigobarra"])+")'></fa> -</button>";
                        html += "<button class='btn btn-danger btn-xs' type='text' style='padding:0;' title='Compra rápida' id='button"+registros[i]["producto_id"]+"' onclick='registrar_ingreso_rapido("+registros[i]["producto_id"]+")'>- <fa class='fa fa-bolt'></fa> -</button>";
                        html += "<button class='btn btn-facebook btn-xs' type='text' style='padding:0;' title='Registro rápido' id='button"+registros[i]["producto_id"]+"' onclick='modificar_precios("+registros[i]["producto_id"]+")'>- <fa class='fa fa-money'></fa> -</button>";
                        
                        if (parametro_modulorestaurante==2){ //si es farmacia
                            
                                html += "<br><b>PRINCIPIO ACT.:</b> ";
                                if (registros[i]["producto_principioact"]!=null)
                                    html += registros[i]["producto_principioact"];

                                html += "<br><b>ACCION TERAP.:</b> ";
                                if (registros[i]["producto_accionterap"]!=null)
                                    html += registros[i]["producto_accionterap"];
                        }

                        if(! esMobil()){
                        html += "</td>";
                        
                        html += "<td  style='padding:0px;'>"; // style='space-white:nowarp'
                        }
                        
                        html += "<center> ";                        
//                        html += "   <select class='btn btn-facebook' style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["producto_id"]+"' name='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+registros[i]["existencia"]+","+registros[i]["producto_id"]+")'>";
                        html += "   <select class='btn btn-facebook' style='font-size:12px; font-family: Arial; padding:0; background: black;' id='select_factor"+registros[i]["producto_id"]+"' name='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+registros[i]["producto_id"]+")' >";
                        
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
                                html += "           "+registros[i]["producto_unidadfactor"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        
                        if (rol_factor1==1){
                            if(registros[i]["producto_factor1"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor1"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor1"]) * parseFloat(registros[i]["producto_factor1"]);

                                html += "       <option value='producto_factor1'>";
                                html += "           "+registros[i]["producto_unidadfactor1"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                            
                        if (rol_factor2==1){
                            if(registros[i]["producto_factor2"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor2"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor2"]) * parseFloat(registros[i]["producto_factor2"]);

                                html += "       <option value='producto_factor2'>";
                                html += "           "+registros[i]["producto_unidadfactor2"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        if (rol_factor3==1){                        
                            if(registros[i]["producto_factor3"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor3"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor3"]) * parseFloat(registros[i]["producto_factor3"]);

                                html += "       <option value='producto_factor3'>";
                                html += "           "+registros[i]["producto_unidadfactor3"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        if (rol_factor4==1){                        
                            if(registros[i]["producto_factor4"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor4"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor4"]) * parseFloat(registros[i]["producto_factor4"]);

                                html += "       <option value='producto_factor4'>";
                                html += "           "+registros[i]["producto_unidadfactor4"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
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
                                  html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapidojsx(1,"+registros[i]["producto_id"]+",0)'><b>- 1 -</b></button>";                                  
                                  html +=     "<button class='btn btn-info btn-xs' onclick='ingresorapidojsx(2,"+registros[i]["producto_id"]+",0)'><b>- 2 -</b></button>";
                                  html +=     "<button class='btn btn-primary btn-xs' onclick='ingresorapidojsx(5,"+registros[i]["producto_id"]+",0)'><b>- 5 -</b></button>";
                                  html +=     "<button class='btn btn-warning btn-xs' onclick='ingresorapidojsx(10,"+registros[i]["producto_id"]+",0)'><b>- 10 -</b></button> ";
                                  html += "</div>";   

                            }            
                        }
                      
                        //html += "<textarea name='textarea' rows='10' cols='50'>"+sql+"</textarea>"
                        
                        html += "</center>";
                        if(! esMobil()){
                       
                        html += "</td>";
                        
                        
                        html += "<td style='padding:0;'>";
                        }

                        
                        if(parametro_sininventario==1){
                            
                             html += "<button type='button' class='btn btn-facebook btn-xl btn-block' style='padding:0;' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='Añadir al detalle' onclick='focus_cantidad("+registros[i]["producto_id"]+")' >"+mensajeboton+ 
                                    "<center style='line-height:10px;'><font size='1'><span class='btn btn-xs btn-danger' style='padding:0;'>- <em style='font-size:10px;' class='fa fa-battery-full'></em> -</font><br><font size='1'><sub>"+registros[i]["producto_unidad"]+"</sub></font></span></center>"+
                                       "<em style='font-size:20px;' class='fa fa-cart-arrow-down'></em></button>";                             
                        }else{
                            
                            if (parseFloat(registros[i]["existencia"])>0){
                                 html += "<button type='button' class='btn btn-facebook btn-xl btn-block' style='padding:0;' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='Añadir al detalle' onclick='focus_cantidad("+registros[i]["producto_id"]+")' >"+mensajeboton+ 
                                        "<center style='line-height:10px;'><font size='2'><span class='btn btn-xs btn-danger' style='padding:0;'> <b>"+formato_numerico(existencia)+"</font><br><font size='1'><sub>"+registros[i]["producto_unidad"]+"</sub></font></b></span></center>"+
                                           "<em style='font-size:20px;' class='fa fa-cart-arrow-down'></em></button>";                             
                            }else{

                                 html += "<center><small style='font-size:8px;'>SIN<br>EXISTENCIA</small></center>";
                            
                            }
                        }

                       
                        
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
                        html += "       <table>"; // style='space-white: nowrap;'
                        html += "       <tr style='border:0px;'>"; // style='space-white: nowrap;'
//                        html += "       <td><b>Ancho:</b><input type='text' id='producto_ancho"+registros[i]["producto_id"]+"' onkeyup='calcular_cantidad("+registros[i]["producto_id"]+")'> </td>"; // style='space-white: nowrap;'
//                        html += "       <td><b>Alto:</b><input type='text'id='producto_alto"+registros[i]["producto_id"]+"' onkeyup='calcular_cantidad("+registros[i]["producto_id"]+")'> </td>"; // style='space-white: nowrap;'
                        html += "       </tr>"; // style='space-white: nowrap;'
                        html += "           <tr>";
                       
                      
                        html += "               <td colspan='2'>";
                      
                     
                       html += "               <font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "               <br><b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0' step='1' max='"+formato_numerico(registros[i]["existencia"])+"' onkeyup='registrar_cantidad(event,"+registros[i]["producto_id"]+")' ></b>";
                        
                        html += "               </td>";
                        html += "          </tr>";
                        html += "       </table>";
                        
                        html += "       <!------------------------------------------------------------------->";
                        html += "  </div>";
                        
                        html += "  <div class='modal-footer aligncenter'>";
                        html += "    <input type='text' id='producto_id' name='producto_id' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>";
                        html += "     <button data-toggle='modal' id='boton_cantidad"+registros[i]["producto_id"]+"' data-dismiss='modal' onclick='ingresardetallejs("+registros[i]["producto_id"]+")' class='btn btn-facebook btn-foursquarexs' id='boton_cantidad_producto'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></button>";

                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' class='btn btn-danger btn-foursquarexs'><font size='5'><span class='fa fa-search'></span></font><br><small>Cancelar</small></a>";
                        html += "  </div>";                        
                        html += "</div>";
                        
                        html += "  </div>";
                        html += "</div>";

                        html += "<!---------------------- fin modal cantidad ---------------------------------> ";

                        html += "</td>";
                        
                        html += "</tr>";
                        
                      //  alert(x);

                   }
                 
                   html += " </tbody>";
                   html += "</table>"
                   $("#tablaresultados").html(html);
                   
                   /************** FIN MODO TEXTO ***************/
               }// fin visualizacion modo texto
 
                
                if (modo_visualizacion == 2){ // Modo botones
                
                       
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

                        existencia = parseFloat(registros[i]["existencia"])+" "+registros[i]["producto_unidad"]+" | "+registros[i]["moneda_descripcion"]+" "+registros[i]["producto_precio"];
                        solo_precio = registros[i]["moneda_descripcion"]+" "+Number(registros[i]["producto_precio"]).toFixed(decimales);
                        
                        html += "<input type='text' value='"+registros[i]["existencia"]+"' id='existencia"+registros[i]["producto_id"]+"' hidden>";

                        
                        titulo = registros[i]["producto_nombre"]+" | ";
                        titulo += registros[i]["producto_marca"]+" | "+registros[i]["producto_codigobarra"];

                        html += "<input type='text' id='input_unidad"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidad"]+"' hidden>";
                        html += "<input type='text' id='input_unidadfactor"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidadfactor"]+"' hidden>";

                        //precio_cantidad = "<div class='padding:0;' id='input_existencia"+registros[i]["producto_id"]+"'> <center><font size='1'><b>"+existencia+"</b></font></center></div>";
                        precio_cantidad = "<div class='padding:0;' id='input_existencia"+registros[i]["producto_id"]+"'> <center><font size='1'><b>"+existencia+"</b></font></center></div>";
                    
                        nombre_producto = registros[i]['producto_nombre'];
                        prod = nombre_producto.substr(0,20);
                        
                        existenciaprod = registros[i]['existencia'];
                        nombre_producto += " ("+Number(existenciaprod).toFixed(decimales)+" "+registros[i]['producto_unidad']+")";
                        // Este es el boton del producto
                        

                        
                            if (datosboton==1){ //nombre de producto y precio
                            
                                if (parametro_cantidadproductos != 2){ //si pasara directo a detalle){
                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='"+nombre_producto+" ' onclick='focus_cantidad("+registros[i]["producto_id"]+")'>"+imagen_boton+"<br>"+"<span style='font-size:"+tamanio_fuente+"; line-height:8px;'><sub><b>"+prod+"<br>"+solo_precio+"</b></sub></span></button>";
                                }else{                                    
//                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;'  title='"+nombre_producto+" ' onclick='ingresorapidojs(1,"+registros[i]["producto_id"]+",0)'>"+imagen_boton+"<br>"+"<span style='font-size:"+tamanio_fuente+"; line-height:8px;'><sub><b>"+prod+"</b></sub>"+precio_cantidad+"</span></button>";
                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;'  title='"+nombre_producto+" ' onclick='ingresorapidojsx(1,"+registros[i]["producto_id"]+",0)'>"+imagen_boton+"<br>"+"<span style='font-size:"+tamanio_fuente+"; line-height:8px;'><sub><b>"+prod+"<br>"+solo_precio+"</b></sub></span></button>";
                                }    

                            }                        

                            if (datosboton==2){ // Solo Nombre de producto
                                
                                if (parametro_cantidadproductos != 2){ //si pasara directo a detalle
                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='"+nombre_producto+" ' onclick='focus_cantidad("+registros[i]["producto_id"]+")'>"+imagen_boton+"<br>"+"<span style='font-size:"+tamanio_fuente+"; line-height:8px;'><sub>"+prod+"</sub></span></button>";
                                }else{
                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;' onclick='ingresorapidojsx(1,"+registros[i]["producto_id"]+",0)'  title='"+nombre_producto+" ' onclick='focus_cantidad("+registros[i]["producto_id"]+")'>"+imagen_boton+"<br>"+"<span style='font-size:"+tamanio_fuente+"; line-height:8px;'><sub>"+prod+"</sub></span></button>";                                    
                                }
                            }

                            if (datosboton==3){ //Solo precio

                                if (parametro_cantidadproductos != 2){ //si pasara directo a detalle
                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='"+nombre_producto+" ' onclick='focus_cantidad("+registros[i]["producto_id"]+")'>"+imagen_boton+"<br><span style='font-size:"+tamanio_fuente+"; line-height:8px;'>"+precio_cantidad+"</span></button>";
                                }else{
                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;' onclick='ingresorapidojsx(1,"+registros[i]["producto_id"]+",0)'  title='"+nombre_producto+" ' onclick='focus_cantidad("+registros[i]["producto_id"]+")'>"+imagen_boton+"<br><span style='font-size:"+tamanio_fuente+"; line-height:8px;'>"+precio_cantidad+"</span></button>";
                                }                            
                                
                            }

                            if (datosboton==4){

                                if (parametro_cantidadproductos != 2){ //si pasara directo a detalle
                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='"+nombre_producto+" ' onclick='focus_cantidad("+registros[i]["producto_id"]+")'><span style='font-size:"+tamanio_fuente+"; line-height:8px;'>"+imagen_boton+"</span></button>";
                                }else{
                                    html += "<button type='button' class='btn btn-sq-lg btn-"+color_boton+"' style='width: "+ancho_boton+"px !important; height: "+alto_boton+"px !important; padding:0;' onclick='ingresorapidojsx(1,"+registros[i]["producto_id"]+",0)'  title='"+nombre_producto+" ' onclick='focus_cantidad("+registros[i]["producto_id"]+")'><span style='font-size:"+tamanio_fuente+"; line-height:8px;'>"+imagen_boton+"</span></button>";
                                }                            
                            
                            }
                        
                        
                        // fin Este es el boton del producto

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
                        html += "         <tr>";
                        html += "           <td colspan='2'>";                     
                        html += "               <font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "           </td>";
                        html += "         <tr>";
                        html += "           <td>";                     
                        html += "               <b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0' step='1' max='"+registros[i]["existencia"]+"'></b>";
                                            
//                        html += "           </td>";   
//                        html += "       </tr>";   
                        // ******************** inicio select factor para modo visual / botones  

//                        html += "<tr>";   
//                        html += "<td>";   
                        html += "<br>";   
                        
                        html += "   <select class='btn btn-facebook' style='font-size:12px; font-family: Arial; padding:0; background: black;' id='select_factor"+registros[i]["producto_id"]+"' name='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+registros[i]["producto_id"]+")'>";

                        if (rol_precioventa==1){
                            
                            html += "       <option value='precio_normal'>";
                            precio_unidad = registros[i]["producto_precio"];
                            html += "           "+registros[i]["producto_unidad"]+" "+registros[i]["moneda_descripcion"]+": "+precio_unidad.fixed(2)+"";
                            html += "       </option>";
                        
                        }
                        
                        if (rol_factor==1){
                            if(registros[i]["producto_factor"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                                html += "       <option value='producto_factor'>";
                                html += "           "+registros[i]["producto_unidadfactor"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        
                        if (rol_factor1==1){
                            if(registros[i]["producto_factor1"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor1"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor1"]) * parseFloat(registros[i]["producto_factor1"]);

                                html += "       <option value='producto_factor1'>";
                                html += "           "+registros[i]["producto_unidadfactor1"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                            
                        if (rol_factor2==1){
                            if(registros[i]["producto_factor2"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor2"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor2"]) * parseFloat(registros[i]["producto_factor2"]);

                                html += "       <option value='producto_factor2'>";
                                html += "           "+registros[i]["producto_unidadfactor2"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        if (rol_factor3==1){                        
                            if(registros[i]["producto_factor3"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor3"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor3"]) * parseFloat(registros[i]["producto_factor3"]);

                                html += "       <option value='producto_factor3'>";
                                html += "           "+registros[i]["producto_unidadfactor3"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }
                        
                        if (rol_factor4==1){                        
                            if(registros[i]["producto_factor4"]>0){
                                precio_factor = parseFloat(registros[i]["producto_preciofactor4"]);
                                precio_factorcant = parseFloat(registros[i]["producto_preciofactor4"]) * parseFloat(registros[i]["producto_factor4"]);

                                html += "       <option value='producto_factor4'>";
                                html += "           "+registros[i]["producto_unidadfactor4"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                                html += "       </option>";
                            }
                        }

                        html += "</select>";
                        html += "<br>";                        
                        html += "<div id='div_clasificador"+registros[i]["producto_id"]+"'>";
                        html += "</div>";
                                     
                        html += "<input type='text' id='input_detalleven_preferencia"+registros[i]["producto_id"]+"'";
                        html += " onKeyUp='this.value = this.value.toUpperCase()' placeholder='Glosa' class='input input-default' style='width:175px'/>";
                        // ******************** fin  select   
                        
                        
                        html += "               </td>";
                        
                        html += "               <td>";                        
                        
                            
                            html += "<div class='btn-group-vertical' id='botones_preferencias"+registros[i]["producto_id"]+"'>";

                            html += "</div>";
                        
                        html += "</td>";                        
//                        html += "       </tr>";
//                        
//                        html += "<tr>";
//                        html += "<td colspan='2' id='input_detalleven_preferencia"+registros[i]["producto_id"]+"'>";

//                        html += "</td>";
                        html += "</tr>";
                           
                        html += "       </table>";
                        html += "       </center>";
                        
                        //                        html += "       </div>";
                        html += "       <!------------------------------------------------------------------->";
                        html += "  </div>";
                        
                        html += "  <div class='modal-footer aligncenter'>";
                        html += "  <center>";
                        
                        html += "    <input type='text' id='producto_id' name='producto_id' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>";

//                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' onclick='ingresardetallejs("+registros[i]["producto_id"]+","+registros[i]["producto_id"]+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";
                        html += "     <button data-toggle='modal' data-dismiss='modal' onclick='ingresardetallejs("+registros[i]["producto_id"]+")' class='btn btn-success btn-foursquarexs' id='boton_agregar"+registros[i]["producto_id"]+"'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></button>";
//                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' onclick='ingresardetalle("+registros[i]["producto_id"]+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";

//                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' class='btn btn-danger btn-foursquarexs'><font size='5'><span class='fa fa-search'></span></font><br><small>Cancelar</small></a>";
                        html += "     <button data-toggle='modal' data-dismiss='modal' class='btn btn-danger btn-foursquarexs' id='boton_salir_modal"+registros[i]["producto_id"]+"'><font size='5'><span class='fa fa-search'></span></font><br><small>Cancelar</small></button>";
                        html += "  </center>";                        

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
            alert("Ocurrio un problema al realizar la operación...!");      
        }        
    });
    
    //alert("llega");
}

function cerrar_ventas(){
    
    var answer = window.confirm("¿Desea salir sin guardar cambios?");
    if (answer) {
        window.close();
        eliminardetalleventa();
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
    let tipo_doc_identidad = document.getElementById('tipo_doc_identidad').value;
    
    var cliente_nombre = document.getElementById('cliente_nombre').value;
    var cliente_ci = document.getElementById('cliente_ci').value;
    var cliente_nombrenegocio = document.getElementById('cliente_nombrenegocio').value;    
    var cliente_codigo = document.getElementById('cliente_codigo').value;
    
    var cliente_direccion = document.getElementById('cliente_direccion').value;
    var cliente_departamento = document.getElementById('cliente_departamento').value;
    var cliente_celular = document.getElementById('cliente_celular').value;
    var cliente_email = document.getElementById('email').value;
    var cliente_complementoci = document.getElementById('cliente_complementoci').value;
//    var cliente_excepcion = (document.getElementById('codigoexcepcion').value == 1)?1:0;
    var cliente_excepcion = 0;
    
    if($('#codigoexcepcion').is(':checked'))
    {    cliente_excepcion = 1; }
    else
    {    cliente_excepcion = 0; }
        
    
    //var cliente_excepcion = $('#codigoexcepcion').is(':checked');
    
    var zona_id = document.getElementById('zona_id').value;
    //if (Number.isInteger(zona_id)){
    if (zona_id >0){
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
                        cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id,
                        tipo_doc_identidad:tipo_doc_identidad, cliente_email:cliente_email,cliente_complementoci:cliente_complementoci,
                        cliente_excepcion: cliente_excepcion
                    },
                    
                    success:function(respuesta){ 
                        var datos = JSON.parse(respuesta);
                        cliente_id = datos[0]["cliente_id"];
                        //console.log(datos);
                        
                        docsec_codigoclasificador = document.getElementById('docsec_codigoclasificador').value;
                        if(docsec_codigoclasificador == 23){
                        cantidad_facturas = document.getElementById('cantidad_facturas').value;
                            while (cantidad_facturas > 0) {
                                if(cliente_id>0){
                                    registrarventa(cliente_id);                            
                                }else{
                                    registrarventa(respuesta);                            
                                }
                                cantidad_facturas--;
                                sleep(2000);
                            }
                        }else{
                            if(cliente_id>0){
                                registrarventa(cliente_id);                            
                            }else{
                                registrarventa(respuesta);                            
                            }
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
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id,
                        tipo_doc_identidad:tipo_doc_identidad, cliente_email:cliente_email,cliente_complementoci:cliente_complementoci,cliente_excepcion:cliente_excepcion},
            success:function(respuesta){  
            
                var registro = JSON.parse(respuesta);
                
                cliente_id = registro[0]["cliente_id"];
                
                docsec_codigoclasificador = document.getElementById('docsec_codigoclasificador').value;
                if(docsec_codigoclasificador == 23){
                cantidad_facturas = document.getElementById('cantidad_facturas').value;
                    while (cantidad_facturas > 0) {
                        registrarventa(cliente_id);
                        cantidad_facturas--;
                        sleep(2000);
                    }
                    //eliminardetalleventa();
                }else{
                    registrarventa(cliente_id);
                }
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
    var controlador = base_url+"venta/numero_ventas";
    var res = 0;    
    
   $.ajax({url: controlador,
           type:"POST",
           data:{},
           async: false, 
           success:function(respuesta){
               
               var resultado = eval(respuesta);
               
               res = resultado[0]["cantidad"];
                //console.log("contador: "+res["cantidad"]);
                //alert(JSON.stringify(resultado));
                
           },
           error:function(respuesta){
              res = 0;
           }
    });     
    
    return res;
}

function actualizar_numerofactura(){

    var base_url = document.getElementById('base_url').value;
    var controlador = document.getElementById('base_url').value+"venta/actualizar_numerofactura";
    
   $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               
               var resultado = eval(respuesta);
               
                res = 1; //resultado[0]["cantidad"];
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
    var factura_complementoci = document.getElementById('cliente_complementoci').value;
    let cliente_email = document.getElementById('email').value;
    
    var moneda_id = 1; 
    var estado_id = 1; 
    
    var venta_fecha = fecha();//retorna la fecha actual  //"date(now())";
    var hora = new Date();
    
    var venta_hora = hora.getHours()+":"+hora.getMinutes()+":"+hora.getSeconds();
    
    var venta_subtotal = document.getElementById('venta_subtotal').value;     
    var venta_descuento = document.getElementById('venta_descuento').value; 
    var venta_descuentoparcial = document.getElementById('venta_descuentoparcial').value; 
    var venta_total = document.getElementById('venta_totalfinal').value; 
    var venta_efectivo = document.getElementById('venta_efectivo').value; 
    var venta_cambio = document.getElementById('venta_cambio').value; 
    var venta_glosa = document.getElementById('venta_glosa').value; 
    var venta_comision = document.getElementById('venta_comision').value; 
    var venta_tipocambio = document.getElementById('venta_tipocambio').value; 
    var detalleserv_id = document.getElementById('detalleserv_id').value;
    var tipo_transaccion = document.getElementById('tipo_transaccion').value;
    var select_almacen = document.getElementById('select_almacen').value;
    var cuotas = document.getElementById('cuotas').value;   
    var cuota_inicial = document.getElementById('cuota_inicial').value;
    var credito_interes = document.getElementById('credito_interes').value;
    var facturado = document.getElementById('facturado').checked;
    var tiposerv_id = document.getElementById('tiposerv_id').value;
    var venta_numeromesa = document.getElementById('venta_numeromesa').value;
    var parametro_modulorestaurante = document.getElementById('parametro_modulorestaurante').value;
    var parametro_imprimirticket = document.getElementById('parametro_imprimirticket').value;
    let banco_id = forma_id == 1 ? '0':$('#banco').val();
    let tipo_doc_identidad = document.getElementById('tipo_doc_identidad').value;
    
    var codigoexcepcion = document.getElementById('codigoexcepcion').checked;

    var venta_ice = document.getElementById('venta_ice').value;
    var venta_giftcard = document.getElementById('venta_giftcard').value;
    var venta_detalletransaccion = document.getElementById('venta_detalletransaccion').value;
    var dosificacion_modalidad = document.getElementById('dosificacion_modalidad').value;
    var factura_idcreditodebito = document.getElementById('factura_idcreditodebito').value;

    var registroeventos_codigo = document.getElementById('evento_contingencia').value;
    var parametro_tipoemision = document.getElementById('parametro_tipoemision').value;
    var punto_venta = document.getElementById('punto_venta').value;
    let parametro_puntos = document.getElementById('parametro_puntos').value;
    
    let datos_placa = document.getElementById('datos_placa').value;
    let datos_embase = document.getElementById('datos_embase').value;
    let datos_codigopais = document.getElementById('datos_codigopais').value;
    let datos_autorizacionsc = document.getElementById('datos_autorizacionsc').value;

    let datos_consumoperiodo = document.getElementById('datos_consumoperiodo').value;
    let datos_beneficiario1886 = document.getElementById('datos_beneficiario1886').value;
    let datos_medidor = document.getElementById('datos_medidor').value;
    let datos_mes = document.getElementById('datos_mes').value;
    let datos_anio = document.getElementById('datos_anio').value;
    //let datos_ajustesnoiva = document.getElementById('datos_ajustesnoiva').value;
    let datos_ajustesujetosiva = document.getElementById('datos_ajustesujetosiva').value;
    let datos_sujetoivasubtotal = document.getElementById('datos_sujetoivasubtotal').value;
    let datos_aseourbano = document.getElementById('datos_aseourbano').value;
    let datos_aseosubtotal = document.getElementById('datos_aseosubtotal').value;
    let datos_tasaalumbrado = document.getElementById('datos_tasaalumbrado').value;
    let datos_alumbradosubtotal = document.getElementById('datos_alumbradosubtotal').value;
    let datos_otrastasas = document.getElementById('datos_otrastasas').value;
    let datos_tasassubtotal = document.getElementById('datos_tasassubtotal').value;
    let datos_otrospagos = document.getElementById('datos_otrospagos').value;
    let datos_pagossubtotal = document.getElementById('datos_pagossubtotal').value;
    let parametro_comprobante = document.getElementById('parametro_comprobante').value;
    
    
    if (registroeventos_codigo>0){
        
        var fecha_cafc = document.getElementById('fecha_cafc').value;
        var hora_cafc = document.getElementById('hora_cafc').value;
        var numfact_cafc = document.getElementById('numfact_cafc').value;
        var codigo_cafc = document.getElementById('codigo_cafc').value;
        // si esta tiqueado para que mande todo en uno; caso contrario manda al finalizar la venta
        var mandar_enuno  = $('#mandar_enuno:checked').val();
    }else{
        var mandar_enuno  = 0;
        var fecha_cafc = "";
        var hora_cafc = "";
        var numfact_cafc = 0;
        var codigo_cafc = "";
        
    }
    
    //alert(select_almacen);
//    
//    alert("registroeventos_codigo: "+registroeventos_codigo+
//          " * fecha_cafc: "+fecha_cafc+
//          " * numfact_cafc: "+numfact_cafc+
//          " * codigo_cafc: "+codigo_cafc);
    //alert(venta_efectivo);
    //alert(venta_descuento);
    if(codigoexcepcion==true){
        codigo_excepcion = 1;
    }else{
        codigo_excepcion = 0;
    }
    
   // alert(codigo_excepcion);
    
    var venta_numeroventa = 0;
    var venta_tipodoc = 0;
    var entrega_id = 1;
    var entregaestado_id = 1;


    if (parametro_modulorestaurante==1){
        venta_numeroventa = numero_venta();
    }
    if(parametro_imprimirticket == 1){
        venta_numeroventa = numero_venta();
    }
    
    if(parametro_comprobante == 2){ 
        venta_numeroventa = numero_venta();
        //alert(venta_numeroventa);
    }
    
    document.getElementById('boton_finalizar').style.display = 'none'; //mostrar el bloque del loader
   
    if( facturado == 1){     
        venta_tipodoc = 1;}
    else{
        venta_tipodoc = 0;}
    
    
    var cad =   ""+forma_id+","+tipotrans_id+","+usuario_id+","+cliente_id
                +","+moneda_id+","+estado_id+",'"+venta_fecha+"','"+venta_hora+"',"+venta_subtotal
                +","+venta_descuentoparcial+","+venta_descuento+","+venta_total+","+venta_efectivo+","+venta_cambio+",'"+venta_glosa+"'"
                +","+venta_comision+","+venta_tipocambio+","+detalleserv_id+","+venta_tipodoc+","+tiposerv_id
                +","+entrega_id+",'"+venta_numeromesa+"',"+venta_numeroventa+","+usuarioprev_id+","+pedido_id+","+orden_id+","+entregaestado_id+","+banco_id
                +","+venta_ice+","+venta_giftcard+",'"+venta_detalletransaccion+"'";
                
    //alert(cad);
    if (tipo_transaccion==2){ //Si es al credito
        
        var cuotas = document.getElementById('cuotas').value;
        var modalidad = document.getElementById('modalidad').value;
        var dia_pago = document.getElementById('dia_pago').value;
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        let metodo_frances  = $('#metodofrances').is(':checked');
        
        $.ajax({url: controlador,
            type:"POST",
            data:{cad:cad, tipo_transaccion:tipo_transaccion, cuotas:cuotas, cuota_inicial:cuota_inicial, 
                venta_total:venta_total, credito_interes:credito_interes, pedido_id:pedido_id, forma_id:forma_id,
                facturado:facturado,venta_fecha:venta_fecha, venta_hora:venta_hora, razon:razon, nit:nit,
                modalidad:modalidad, dia_pago:dia_pago, fecha_inicio: fecha_inicio,
                venta_descuentoparcial:venta_descuentoparcial, venta_descuento:venta_descuento,usuarioprev_id:usuarioprev_id,orden_id:orden_id,
                venta_efectivo:venta_efectivo, venta_cambio:venta_cambio, metodo_frances:metodo_frances,
                tipo_doc_identidad:tipo_doc_identidad, cliente_email:cliente_email,venta_subtotal:venta_subtotal,codigo_excepcion:codigo_excepcion,
                venta_giftcard:venta_giftcard, venta_detalletransaccion:venta_detalletransaccion, venta_ice: venta_ice,
                factura_complementoci:factura_complementoci,fecha_cafc: fecha_cafc, numfact_cafc: numfact_cafc, codigo_cafc: codigo_cafc, 
                registroeventos_codigo: registroeventos_codigo, dosificacion_modalidad:dosificacion_modalidad,venta_glosa:venta_glosa,
                parametro_tipoemision:parametro_tipoemision, mandar_enuno:mandar_enuno, select_almacen:select_almacen,cliente_id:cliente_id,
                datos_placa:datos_placa, datos_embase:datos_embase, datos_codigopais:datos_codigopais, datos_autorizacionsc:datos_autorizacionsc,
                factura_idcreditodebito: factura_idcreditodebito, 
                datos_consumoperiodo:datos_consumoperiodo, datos_beneficiario1886:datos_beneficiario1886, datos_mes:datos_mes, datos_anio: datos_anio,
                datos_medidor:datos_medidor, datos_ajustesujetosiva:datos_ajustesujetosiva,datos_sujetoivasubtotal:datos_sujetoivasubtotal,
                datos_aseourbano:datos_aseourbano,datos_aseosubtotal:datos_aseosubtotal,datos_tasaalumbrado:datos_tasaalumbrado,
                datos_alumbradosubtotal:datos_alumbradosubtotal,datos_otrastasas:datos_otrastasas,datos_tasassubtotal:datos_tasassubtotal,
                datos_otrospagos:datos_otrospagos,datos_pagossubtotal:datos_pagossubtotal
            },
            success:function(respuesta){
                if(parametro_puntos >0){
                    registrarpuntos(cliente_id, venta_total);
                }
                let docsec_codigoclasificador = document.getElementById('docsec_codigoclasificador').value;
                if(docsec_codigoclasificador != 23){
                    eliminardetalleventa();
                }
                
                //eliminardetalleventa();
                if (registroeventos_codigo>0){
                    $('#evento_contingencia').prop('selectedIndex',0);
                }
                var res = JSON.parse(respuesta);                

//                alert(res.codigoDescripcion);
//                alert(res.mensajesList.codigo);
              
//                if(res.mensajesList.codigo == 953){                    
//                    alert("FACTURA NO ENVIADA: El código único de facturación diario (CUFD), NO SE ENCUENTRA VIGENTE");
//                    solicitudCufd(punto_venta);                    
//                }
//                
//                
//                if((res.mensajesList.codigo >= 1037)||(res.mensajesList.codigo == 988)||(res.mensajesList.codigo == 993)||(res.mensajesList.codigo == 988) ){                    
                let parametro_tiposistema = document.getElementById('parametro_tiposistema').value;
                
               
                var motivo = "";
                var html = "";
                var mensaje = "";
                
                
                
                if(parametro_tiposistema != 1){
                    
                    if(res.mensajesList.codigoDescripcion == "VALIDADA"){
                            //alert("FACTURA ENVIADA");    
                        //html = "<span class='btn btn-info btn-block' style='font-family: Arial; line-height: 9pt;'><b style='font-family: Arial; font-size: 18pt;'>ENVIADA</b><br>"+mensaje+"</span>";
                        
                        document.getElementById('mensaje_enviado').style.display = 'block';
                        document.getElementById('mensaje_no_enviado').style.display = 'none';
                    
                    }else{
                        
                          //alert("FACTURA NO ENVIADA");
                          //alert("FACTURA NO ENVIADA CODIGO: "+JSON.stringify(res));

                        if((res.mensajesList.codigo >= 900)&&(res.mensajesList.codigo <= 1100)){
                            
                            mensaje = "ERROR "+res.mensajesList.codigo+" * "+res.mensajesList.descripcion;
                            //alert("FACTURA NO ENVIADA: "+res.mensajesList.descripcion);

                            if(res.mensajesList.codigo == 953){                    
                                //alert("FACTURA NO ENVIADA: El código único de facturación diario (CUFD), NO SE ENCUENTRA VIGENTE");
                                solicitudCufd(punto_venta);                    
                            }else{
                                
                                mensaje = "ERROR: "+JSON.stringify(res);
                                
                            }
                            
                        }else{
                            mensaje = "ERROR: "+JSON.stringify(res);
                        }
                        
                        
                        document.getElementById('mensaje_error').innerHTML = mensaje;
                                
                        document.getElementById('mensaje_enviado').style.display = 'none';
                        document.getElementById('mensaje_no_enviado').style.display = 'block';
//                        html = "<span class='btn btn-danger btn-block' style='font-family: Arial; line-height: 9pt;'><b style='font-family: Arial; font-size: 18pt;'>NO ENVIADA</b><br>"+mensaje+"<br>Debe volver a emitir el documento...!</span>";
                        
                    }
                    
                }
                //$("#div_mensaje").html(html);
               
                
            
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
                venta_total:venta_total, credito_interes:credito_interes, pedido_id:pedido_id,forma_id:forma_id,
                facturado:facturado,venta_fecha:venta_fecha, venta_hora:venta_hora, razon:razon, nit:nit,
                venta_descuentoparcial:venta_descuentoparcial, venta_descuento:venta_descuento,orden_id:orden_id,
                venta_efectivo:venta_efectivo, venta_cambio:venta_cambio,tipo_doc_identidad:tipo_doc_identidad,
                cliente_email:cliente_email, venta_subtotal:venta_subtotal,codigo_excepcion:codigo_excepcion,
                venta_giftcard:venta_giftcard, venta_detalletransaccion:venta_detalletransaccion, venta_ice: venta_ice,
                factura_complementoci:factura_complementoci, fecha_cafc: fecha_cafc, numfact_cafc: numfact_cafc, 
                codigo_cafc: codigo_cafc, registroeventos_codigo: registroeventos_codigo, hora_cafc:hora_cafc,
                dosificacion_modalidad:dosificacion_modalidad, parametro_tipoemision:parametro_tipoemision,
                mandar_enuno:mandar_enuno, select_almacen:select_almacen, venta_glosa:venta_glosa,cliente_id:cliente_id,
                datos_placa:datos_placa, datos_embase:datos_embase, datos_codigopais:datos_codigopais, datos_autorizacionsc:datos_autorizacionsc,
                factura_idcreditodebito: factura_idcreditodebito, 
                datos_consumoperiodo:datos_consumoperiodo,  datos_mes:datos_mes, datos_anio: datos_anio,datos_beneficiario1886:datos_beneficiario1886,
                datos_medidor:datos_medidor, datos_ajustesujetosiva:datos_ajustesujetosiva,datos_sujetoivasubtotal:datos_sujetoivasubtotal,
                datos_aseourbano:datos_aseourbano,datos_aseosubtotal:datos_aseosubtotal,datos_tasaalumbrado:datos_tasaalumbrado,
                datos_alumbradosubtotal:datos_alumbradosubtotal,datos_otrastasas:datos_otrastasas,datos_tasassubtotal:datos_tasassubtotal,
                datos_otrospagos:datos_otrospagos,datos_pagossubtotal:datos_pagossubtotal
            },
            success:function(respuesta){
                if(parametro_puntos >0){
                    registrarpuntos(cliente_id, venta_total);
                }
                let docsec_codigoclasificador = document.getElementById('docsec_codigoclasificador').value;
                if(docsec_codigoclasificador != 23){
                    eliminardetalleventa();
                }
                
                //eliminardetalleventa();
                if (registroeventos_codigo>0){
                    $('#evento_contingencia').prop('selectedIndex',0);
                }
                var res = JSON.parse(respuesta);                

//                alert(res.codigoDescripcion);
//                alert(res.mensajesList.codigo);
              
//                if(res.mensajesList.codigo == 953){                    
//                    alert("FACTURA NO ENVIADA: El código único de facturación diario (CUFD), NO SE ENCUENTRA VIGENTE");
//                    solicitudCufd(punto_venta);                    
//                }
//                
//                
//                if((res.mensajesList.codigo >= 1037)||(res.mensajesList.codigo == 988)||(res.mensajesList.codigo == 993)||(res.mensajesList.codigo == 988) ){                    
                let parametro_tiposistema = document.getElementById('parametro_tiposistema').value;
                
               
                var motivo = "";
                var html = "";
                var mensaje = "";
                
                
                
                if(parametro_tiposistema != 1){
                    
                    if(res.mensajesList.codigoDescripcion == "VALIDADA"){
                            //alert("FACTURA ENVIADA");    
                        //html = "<span class='btn btn-info btn-block' style='font-family: Arial; line-height: 9pt;'><b style='font-family: Arial; font-size: 18pt;'>ENVIADA</b><br>"+mensaje+"</span>";
                        
                        document.getElementById('mensaje_enviado').style.display = 'block';
                        document.getElementById('mensaje_no_enviado').style.display = 'none';
                    
                    }else{
                        
                          //alert("FACTURA NO ENVIADA");
                          //alert("FACTURA NO ENVIADA CODIGO: "+JSON.stringify(res));

                        if((res.mensajesList.codigo >= 900)&&(res.mensajesList.codigo <= 1100)){
                            
                            mensaje = "ERROR "+res.mensajesList.codigo+" * "+res.mensajesList.descripcion;
                            //alert("FACTURA NO ENVIADA: "+res.mensajesList.descripcion);

                            if(res.mensajesList.codigo == 953){                    
                                //alert("FACTURA NO ENVIADA: El código único de facturación diario (CUFD), NO SE ENCUENTRA VIGENTE");
                                solicitudCufd(punto_venta);                    
                            }
                            
                        }else{
                            mensaje = "ERROR: "+JSON.stringify(res);
                        }
                        
                        
                        document.getElementById('mensaje_error').innerHTML = mensaje;
                                
                        document.getElementById('mensaje_enviado').style.display = 'none';
                        document.getElementById('mensaje_no_enviado').style.display = 'block';
//                        html = "<span class='btn btn-danger btn-block' style='font-family: Arial; line-height: 9pt;'><b style='font-family: Arial; font-size: 18pt;'>NO ENVIADA</b><br>"+mensaje+"<br>Debe volver a emitir el documento...!</span>";
                        
                    }
                    
                }
                //$("#div_mensaje").html(html);
               
            },
            error: function(respuesta){
                document.getElementById('mensaje_enviado').style.display = 'none';
                document.getElementById('mensaje_no_enviado').style.display = 'block';
                alert("Revise los datos de la venta por favor...!");   
            }
        });          
    }
        
} 

function finalizarventa(){
    
    var monto = document.getElementById('venta_totalfinal').value;
    var parametro_moneda_descripcion = document.getElementById('parametro_moneda_descripcion').value;
    var cliente_codigo = document.getElementById('cliente_codigo').value;
    var codigo = document.getElementById('razon_social').value;
    //var base_url = document.getElementById('base_url').value;
    //var controlador = base_url+'/verificardetalle/'+monto;
    
    calculardesc();
    var tipo_trans   = document.getElementById('tipo_transaccion').value;
    let met_frances  = $('#metodofrances').is(':checked');
    let interes_porc = document.getElementById('credito_interes').value;

    if (cliente_codigo == "-" || cliente_codigo == ""){ //Si el cliente no tiene generado el codigo
        
        codigo = codigo[0]+codigo[1] + Math.floor((Math.random()*100000)+50);
        $("#cliente_codigo").val(codigo);
        
    }
    
    
    if(tipo_trans == 2 && met_frances == true && (interes_porc <= 0 || interes_porc == "")){
        alert("El interes debe ser mayor a 0 para el metodo Frances");
    }else{
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
            var r = confirm("La venta no tiene ningun detalle o los precios estan en "+parametro_moneda_descripcion+" 0.00. \n ¿Desea Continuar?");
            if (r == true) {
                document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
                document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader   

                registrarcliente();
            }else{
                document.getElementById('divventas0').style.display = 'block'; //mostrar el vid de ventas 
                document.getElementById('divventas1').style.display = 'none'; // ocultar el div de loader
                
                $("#boton_presionado").val(0);
            } 

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
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
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
                    let cliente_id = factura.cliente_id;
                    cargar_infcliente(cliente_id);
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
                        html += Number(registros[i]["detallefact_descuento"]).toFixed(decimales);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_subtotal"]).toFixed(decimales);
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
                $("#generar_monto").val(Number(factura.venta_total).toFixed(decimales));*/
                //$("#boton_modal_factura").click();
                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}
//************* inicio  funciones  para emitir factura **************

function seleccionar_factura(factura_id){
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"venta/get_factura";
    var decimales = Number(document.getElementById('parametro_decimales').value);  

    $.ajax({url: controlador,
            type: "POST",
            data:{factura_id:factura_id}, 
            success:function(resultado){
                
                var registros =  JSON.parse(resultado);
                
                //alert(JSON.stringify(registros));
                
                if (registros != null){
                    
                    //$("#boton_modal_factura").click();
                    //cargar_factura2(venta_id);
                    //let cliente_id = factura.cliente_id;
                    //cargar_infcliente(cliente_id);
                    
                    let i = 0;
                    
                    html = "";

                    html += "                <table style='width: 100%; margin: 0;' >";

                    html += "                <tr>";

                    html += "                    <td  style='padding: 0; line-height: 9px;'>";

                    //html += "                                    <img src='<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>' width='100' height='60'><br>";

//                    html += "                                    <font size='2' face='Arial black'><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>";
//
//                    html += "                                        <small>";
//                    html += "                                            <font size='1' face='Arial narrow'><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font>";
//                    html += "                                        </small>";

//                    html += "                                <font size='1' face='Arial narrow'>";
//                    html += "                                <small style='display:inline-block;margin-top: 0px;'>";
//                    html += "                                    <b>";
//
//                    html += "                                            if(registros[i]['factura_sucursal']==0){";
//                    html += "                                                echo 'CASA MATRIZ';";
//                    html += "                                            }else{";
//                    html += "                                                echo 'SUCURSAL '+registros[i]['factura_sucursal'];";
//                    html += "                                            }";
//       
//       
//                    html += "                                    </b><br>'Nº PUNTO DE VENTA '+registros[i]['factura_puntoventa'];<br>";
//
//
//                    html += "                                            $empresa[0]['empresa_direccion'].'<br>'; ";
//         
//         
//                    html += "                                    Teléfono:$empresa[0]['empresa_telefono']; <br>";
//                    html += "                                    <?php echo $empresa[0]['empresa_ubicacion']; ?>";
//                    html += "                                </small>";                                
//                    html += "                                </font>";
//                    html += "                        </center>   ";                   
                    html += "                    </td>";
                    html += "                    <td style='padding:0;line-height: 9px;'>";
                    html += "                    </td>";
   
                    html += "                    <td style='word-wrap: break-word;  padding: 0; line-height: 10px;'>";
                    html += "                        <table style='word-wrap: break-word;  padding:0; border-bottom: #0000eb'>";
                    html += "                            <tr>";
                    html += "                                <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align: text-top;'  class='autoColor'><b>NIT: </b></td>";
                    html += "                                <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 5px;white-space: normal;'>"+registros[i]['factura_nitemisor']+"</td>";
                    html += "                            </tr>";
                    html += "                            <tr>";
                    html += "                                <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align: text-top;'  class='autoColor'><b>FACTURA Nº: </b></td>";
                    html += "                                <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 5px;white-space: normal;'>"+registros[i]['factura_numero']+"</td>";
                    html += "                            </tr>";
                    html += "                            <tr>";
                    html += "                                <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align: text-top;'  class='autoColor'><b>CÓD AUTORIZACIÓN: </b></td>";
                    html += "                                <td style='font-family: arial; font-size: 8pt; padding-left: 5px; white-space: intial; max-width: 3cm'><span class='width:100%'>"+registros[i]['factura_cuf']+"</span></td>";
                    html += "                            </tr>";
                    html += "                        </table>  ";   
                    html += "                    </td>";
                    html += "                </tr>";

                    let fecha = registros[i]['factura_fechaventa'];
                    let fecha_d_m_a = formato_fecha(fecha);
                    
                    html += "                <tr style='padding: 0;'>";
                    html += "                    <td colspan='6' style='padding: 0;'>";
                    html += "                        <center style='margin-bottom:15px'>";
                    html += "    <!--                        NOMBRE DE LA FACTURA-->";
                    html += "                            <font size='4' face='arial'><b>";
                        
                    let subtitulo_factura= "";
                    
                        if (registros[i]['docsec_codigoclasificador']>=1){
                            html += "FACTURA";
                            subtitulo_factura = "(Con Derecho a Crédito Fiscal)";
                        }
                        
                        if (registros[i]['docsec_codigoclasificador']==2){
                            html += "FACTURA DE ALQUILER";
                            subtitulo_factura = "(Con Derecho a Crédito Fiscal)";
                            
                        }
                        
                        if (registros[i]['docsec_codigoclasificador']==8){
                            html += "FACTURA TASA CERO - TRANSPORTE DE CARGA INTERNACIONAL";
                            subtitulo_factura = "(Sin Derecho a Crédito Fiscal)";
                            
                        }

                    html += "                            </b></font> <br>";

                    html += "                            <font size='1' face='arial'>"+subtitulo_factura+"</font> <br>";
                    html += "                        </center>";
                    html += "                    </td>  ";
                    html += "                </tr>";

                    html += "                <tr>";
                    html += "                    <td colspan='6'>";
                    html += "                        <div style='display: inline-block; float:left; width:65%'>";
                    html += "                            <table style='word-wrap: break-word; width: 100%; padding:0; border-bottom: #0000eb;'>";
                    html += "                                <tr>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;width:20px;'  class='autoColor'><b>Fecha:</b></td>";

                    fecha_factura = registros[i]['factura_fecha'];
                    fecha = formato_fecha(fecha_factura);
                                                            
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;'>"+fecha+" "+registros[i]['factura_hora']+"</td>";
                    html += "                                </tr>";
                    html += "                                <tr>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top; '  class='autoColor'><b>Nombre/Razón Social:</b></td>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;'>"+registros[i]['factura_razonsocial']+"</td>";
                    html += "                                </tr>";
                    
    
                    if(registros[i]['docsec_codigoclasificador'] == 12){ //Comercializacion de hidrocarburos";
                        
                    html += "                                <tr>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top; '  class='autoColor'><b>Placa/B-Sisa/Vin:</b></td>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;'>"+registros[i]['datos_placa']+"</td>";
                    html += "                                </tr>";

                    }

                    html += "                            </table>";
                    html += "                        </div>";

                    html += "                        <div style='display: inline-block; float:left; width:35%'>";
                    html += "                            <table style='word-wrap: break-word; width: 100%; padding:0; border-bottom: #0000eb;'>";
                    html += "                                <tr>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;width:20px; '  class='autoColor'><b>NIT/CI/CEX:</b></td>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;'>"+registros[i]['factura_nit']+" ";
                    
                    if (registros[i]['cliente_complementoci']!=null){
                        html += registros[i]['cliente_complementoci'];
                    }
                    
                    html += "</td>";
                    html += "                                </tr>";
                    html += "                                <tr>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;'  class='autoColor'><b>Cod. Cliente:</b></td>";
                    html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;'>"+registros[i]['factura_codigocliente']+"</td>";
                    html += "                                </tr>";

                    if(registros[i]['docsec_codigoclasificador'] == 12){ //Comercializacion de hidrocarburos";

                        html += "                                <tr>";
                        html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;'  class='autoColor'><b>Tipo Envase:</b></td>";
                        html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;'>"+registros[i]['datos_embase']+"</td>";
                        html += "                                </tr>";
                        
                    }


                   if (registros[i]['docsec_codigoclasificador']==2){
                       
                       
                        html += "                                <tr>";
                        html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;'  class='autoColor'><b>Periodo Facturado:</b></td>";
                        html += "                                    <td style='font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;'>"+registros[i]['factura_glosa']+"</td>";
                        html += "                                </tr>";

                    }
                    
                    html += "                            </table>";
                    html += "                        </div>";
                    html += "                    </td>";
                    html += "                </tr>";
                    html += "            <!--</table>-->";
                    html += "                </table>";
                    html += "                </td>";
                    html += "                </tr>";
                    
                    let mostrarice = 0; //sin ice ?>";

                    html += "                <tr>";
                    html += "                    <td>";
                    html += "                        <table class='table-condensed table-fondito'  style='width: 100%; margin: 0; '>";
                    html += "                            <tr  style=' font-family: Arial; border: 1px solid black; font-size: 8px;'>";
                    
                    if(registros[i]['docsec_codigoclasificador']==2 || registros[i]['docsec_codigoclasificador']==17 || registros[i]['docsec_codigoclasificador']==22){ 

                        html += "<td align='center' style='border: 1px solid black; '><b>CÓDIGO<br> SERVICIO</b></td>";

                    }else{

                        html += "<td align='center' style='border: 1px solid black; '><b>CÓDIGO<br> PRODUCTO</b></td>";

                    }

                    html += "                                <td align='center' style='border: 1px solid black; '><b>CANTIDAD</b></td>";
                    html += "                                <td align='center' style='border: 1px solid black; '><b>UNIDAD <br>DE MEDIDA</b></td>";
                    html += "                                <td align='center' style='border: 1px solid black; '><b>DESCRIPCIÓN</b></td>";
                    html += "                                <td align='center' style='border: 1px solid black; '><b>PRECIO<br> UNITARIO</b></td>    ";           
                    html += "                                <td align='center' style='border: 1px solid black; '><b>DESCUENTO</b></td>";
                    if (mostrarice==1){ 

                        html += "                                <td align='center' style='border: 1px solid black; '><b>ICE %</b></td>";
                        html += "                                <td align='center' style='border: 1px solid black; '><b>ICE ESP.</b></td>";

                    }
                    html += "                                <td align='center' style='border: 1px solid black; '><b>SUBTOTAL</b></td>";
                    html += "                            </tr>";
                       let cont = 0;
                       let cantidad = 0;
                       let total_descuentoparcial = 0;
                       let total_descuento = 0;
                       let total_final = 0;

                       let total_subtotal = 0;
                       let ice = 0.00;

                       if (registros[i]['estado_id']!=3){
                           
                           for (var j = 0; j< registros.length; j++ ){
                               
                                let d = registros[j];
                           
                               cont = cont+1;
                               cantidad += d['detallefact_cantidad'];
                               sub_total = d['detallefact_subtotal'];
                               total_subtotal += sub_total;
                               total_descuentoparcial += d['detallefact_descuentoparcial'] * d['detallefact_cantidad']; 
                               total_descuento += d['detallefact_descuento']; 
                               total_final += d['detallefact_total']; 

                                html += "                            <tr style='border: 1px solid black; font-size: 10px;'>";
                                html += "                                <td align='left' style='padding: 0; padding-left:3px; border: 1px solid black; '><font style='size:7px; font-family: arial'>"+d['detallefact_codigo']+"</font></td>";
                                html += "                                <td align='right' style='padding: 0; padding-right:3px; border: 1px solid black; '><font style='size:7px; font-family: arial'>"+formato_cantidad(d['detallefact_cantidad'])+"</font></td>";
                                html += "                                <td align='left' style='padding: 0; padding-left:3px; border: 1px solid black; '><font style='size:7px; font-family: arial'><center>"+d['producto_unidad']+"</center></font></td>";
                                html += "                                <td colspan='1' style='padding: 0; line-height: 10px; border: 1px solid black; '>";
                                html += "                                    <font style='size:7px; font-family: arial; padding-left:3px'> ";
                                html +=                                         d['detallefact_descripcion'];
                                
                                if(d['detallefact_preferencia']!='null' && d['detallefact_preferencia']!='-' ) {
                                            html += d['detallefact_preferencia'];
                                }
                                
                                if(d['detallefact_caracteristicas']!='null' && d['detallefact_caracteristicas']!='-' ) {
                                            html += '<br>'+d['detallefact_caracteristicas'];
                                }

                                html += "                                    </font>";
                                html += "                                </td>";

                                html += "                                <!-------------- PRECIO UNITARIO ---------->";
                                html += "                                <td align='right' style='padding: 0; padding-right: 3px; border: 1px solid black; '><font style='size:7px; font-family: arial'>"+Number(d['detallefact_precio']).toFixed(decimales)+"</font></td>";

                                html += "                                <!-------------- DESCUENTO PARCIAL ---------->";
                                html += "                                <td align='right' style='padding-right: 3px; border: 1px solid black; '>"+Number(d['detallefact_descuentoparcial']*d['detallefact_cantidad']).toFixed(decimales)+"</td>";

                                html += "                                <!-------------- ICE/ICE ESPC ---------->";
//                                html += "                                <?php if($mostrarice==1){ ?>";
//                                html += "                                    <td align='right' style='padding-right: 3px;'><?= number_format($ice,$decimales,'+',',') ?></td>";
//                                html += "                                    <td align='right' style='padding: 0; padding-right: 3px;'><font style='size:7px; font-family: arial'> <?= number_format($ice,$decimales,'+',',') ?></font></td>";
//                                html += "                                <?php } ?>";

                                html += "                                <td align='right' style='padding: 0; padding-right: 3px; border: 1px solid black; '><font style='size:7px; font-family: arial'>"+ Number(d['detallefact_subtotal'] - (d['detallefact_descuentoparcial']*d['detallefact_cantidad'])).toFixed(decimales)+"</font></td>";
                                html += "                            </tr>";
                               
                               }
                            }
                                let total_final_factura = registros[i]['factura_subtotal'];
                                let factura_total = registros[i]['factura_total'] - registros[i]['factura_giftcard'];

                                let span = 2
                                                                
                    html += "                        <!-------------- SUB TOTAL ---------->";
                    html += "                        <tr style='font-size: 10px; border: 1px solid black; '>";

                                                        if (registros[i]['docsec_codigoclasificador']==12){ 

                                                            importe_base_iva = factura_total * 0.70;

                                                        }else{

                                                            importe_base_iva = factura_total;
                                                        }

                    html += "                            <td style='padding:0; border-left: none !important;border-bottom: none !important;' colspan='4' rowspan='6'><b style='font-family: Arial; size:9px;'>SON: </b></td>";
                    html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black; ' colspan='"+span+"' align='right'>SUBTOTAL Bs</td>";
                    html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black; ' align='right'>"+Number(total_final_factura).toFixed(decimales)+"</td>";
                    html += "                        </tr>";
                    html += "                        <!-------------- DESCUENTO ---------->";
                    html += "                        <tr style='font-size: 10px;'>";
                    html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black; ' colspan=2 align='right'>(-)DESCUENTO Bs</td>";
                    html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black; ' align='right'>"+Number(registros[i]['factura_descuento']).toFixed(decimales)+"</td>";
                    html += "                        </tr>";
                    html += "                        <!-------------- DECUENTO GLOBAL ---------->";
     
                    html += "                        <!-------------- FACTURA TOTAL ---------->";
                    html += "                        <tr style='font-size: 10px;'>";
                    html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black; ' colspan=2 align='right'><b>TOTAL Bs</b></td>";
                    html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black; ' align='right'><b>"+Number(registros[i]['factura_total']).toFixed(decimales)+"</b></td>";
                    html += "                        </tr>";

                    html += "                        <!-------------- FACTURA GIFTA CARD ---------->";
                    
                    if(registros[i]['docsec_codigoclasificador']!=2 && registros[i]['docsec_codigoclasificador']!=12 && registros[i]['docsec_codigoclasificador']!=51){
                        html += "                            <tr style='font-size: 10px;'>";
                        html += "                                <td style='padding:0; padding-right: 3px; border: 1px solid black;' colspan=2 align='right'><b>MONTO GIFT CARD Bs</b></td>";
                        html += "                                <td style='padding:0; padding-right: 3px; border: 1px solid black;' align='right'><b>"+Number(registros[i]['factura_giftcard']).toFixed(decimales)+"</b></td>";
                        html += "                            </tr>";
                    }

                    html += "                        <!-------------- ICE / ICE ESPECIFICO ---------->";
                    if(mostrarice==1){ 
                        html += "                        <tr style='font-size: 10px;'>";
                        html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black;' colspan=2 align='right'>(-) TOTAL ICE ESPECÍFICO Bs</td>";
                        html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black;' align='right'>"+Number($ice).toFixed(decimales)+"</td>";
                        html += "                        </tr>";
                        html += "                        <tr>";
                        html += "                            <td style='padding:0; padding-right: 3px;' colspan=2 align='right'>(-) TOTAL ICE PORCENTUAL Bs</td>";
                        html += "                            <td style='padding:0; padding-right: 3px;' align='right'>"+Number($ice).toFixed(decimales)+"</td>";
                        html += "                        </tr>";
                    }

                    html += "                        <!-------------- MONTO A PAGAR ---------->";
                    if(registros[i]['docsec_codigoclasificador']!=2 && registros[i]['docsec_codigoclasificador']!=39 && registros[i]['docsec_codigoclasificador']!=12 && registros[i]['docsec_codigoclasificador']!=51){ 
                        html += "                        <tr style='font-size: 10px;'> ";          

                        html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black;' colspan=2 align='right'><b>MONTO A PAGAR Bs</b></td>";
                        html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black;' align='right'><b>"+Number(factura_total).toFixed(decimales)+"</b></td>";
                        html += "                        </tr>";
                    }

                    html += "                        <!-------------- IMPORTE BASE CREDITO FISCAL ---------->";
                    if (registros[i]['docsec_codigoclasificador'] != 8){
//                        html += "                            $elimporte =  'IMPORTE BASE CR&Eacute;DITO FISCAL';";
//                        html += "                            if($opc == 12){ //Comercializacion de hidrocarburos";
//                        html += "                                $elimporte =  'IMPORTE BASE C/F MONTO LEY 317';";
//                        //}


                        html += "                        <tr style='font-size: 10px;'>   ";        
                        html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black;' colspan=2 align='right'><b><?php echo $elimporte; ?></b></td>";
                        html += "                            <td style='padding:0; padding-right: 3px; border: 1px solid black;' align='right'><b><?= number_format($importe_base_iva,$dos_decimales,'+',',')?></b></td>";
                        html += "                        </tr>";
                    }
                    
                    html += "                    </table>";
                    html += "                </td>";
                    html += "            </tr>";
                    html += "            <tr style='font-size: 10px;'>";
                    html += "                <td style='padding-top: 0px; padding-bottom: 0px;'>";
                    html += "                    <div style='width: 100%; margin-top: 25px;'>";
                    html += "                        <div style='float: left;width: 78%; font-size: 10px;'>";
                    html += "                           <center style='width:100%;'>";
                                                    html += registros[i]['factura_leyenda1']+"<br>";

                                                    html += registros[i]['factura_leyenda2'];
                                                    html += "                                </font><br>";

                                                    html += registros[i]['factura_leyenda3']+"<br>   "; 

                                                    html += registros[i]['factura_leyenda4'];

                    html += "                            </center>";
//                    html += "                            USUARIO: <?php echo registros[i]['usuario_nombre'].' /TRANS: '+registros[i]['venta_id']; ?>";
                    html += "                        </div>";

                    html += "                    </div>";
                    html += "                </td>";
                    html += "            </tr>";
                    html += "        </table>";



                           
                $("#tabla_factura").html(html);
//                           
//                $("#generar_nit").val(factura.cliente_nit);
//                $("#generar_razon").val(factura.cliente_razon);
//                $("#generar_detalle").html(html);
//                $("#generar_venta_id").val(factura.venta_id);
//                $("#generar_monto").val(Number(factura.venta_total).toFixed(decimales));
//                $("#boton_modal_factura").click();
                $("#factura_idcreditodebito").val(registros[0]['factura_id']);
                $("#nit").val(registros[0]['factura_nit']);
                $("#span_buscar_cliente").click();
                
                tablaproductos();
                
                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}

function registrar_factura(venta_id){
    var base_url = document.getElementById("base_url").value;
    var numeroDocumento   = document.getElementById("generar_nit").value;
    let tipoDocumento = $('#doc_identidad').val();
    var razon = document.getElementById("generar_razon").value;
    var monto_factura = document.getElementById("generar_monto").value;
    var controlador = base_url+"venta/generar_factura_detalle_aux";
    $.ajax({url: controlador,
            type: "POST",
            data:{
                venta_id:venta_id, 
                numeroDocumento:numeroDocumento, 
                razon:razon, 
                monto_factura:monto_factura,
                tipoDocumento:tipoDocumento,
            }, 
            success:function(respuesta){      
                resultado = JSON.parse(respuesta);
                var factura_id = resultado;
                //alert(factura_id);
                //alert(base_url+"factura/imprimir_factura_id/"+factura_id+"/1");
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
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/mostrar_ventas";
    var parametro_modulorestaurante = document.getElementById('parametro_modulorestaurante').value;
    var all_usuario = JSON.parse(document.getElementById('all_usuario').value);
    var cantus         = all_usuario.length;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var certif_garantia = document.getElementById('certif_garantia').value;
    var dosificado      = document.getElementById('dosificado').value;
    var generar_factura = document.getElementById('generar_factura').value;
    var modif_fhora     = document.getElementById('modif_fhora').value;
    var signo_moneda    = document.getElementById('moneda_descripcion').value;
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    document.getElementById('oculto2').style.display = 'block'; //mostrar el bloque del loader
    var parametro_moneda_descripcion = document.getElementById('parametro_moneda_descripcion').value;
    var parametro_moneda_id = document.getElementById('parametro_moneda_id').value;
    var moneda_descripcion = document.getElementById('moneda_descripcion').value;
    var moneda_tc = document.getElementById('moneda_tc').value;
    let dosificacion_documentosector = document.getElementById('dosificacion_documentosector').value;
    
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
            const myString = JSON.stringify(v);
            $("#resventa").val(myString);
                $("#parametro").val(filtro); // se enviar el parametro a un text para usarlo desde otro metodo despues
                
            
                html = "";

                    var cont = 0;
                    var total_final = 0;
                    var margenes = " style='padding:0'";
                    
                for (var i=0; i< v.length; i++){    

                    cont = cont + 1; 
                    total_final += parseFloat(v[i]['venta_total']);

                    html += "                       <tr>";
                    html += "                       <td "+margenes+" bgcolor='"+v[i]['estado_color']+"'>"+cont+"</td>";
                    
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
                        
                        
                
                    html += "                       <td style='max-width: 5cm; padding:0;' bgcolor='"+v[i]['estado_color']+"'><font size='3'><b> "+nombre_cliente+"</b></font><sub>  ["+v[i]['cliente_id']+"]</sub>";
                    html += "                           <br>Razón Soc.: "+v[i]['cliente_razon'];
                    html += "                           <br>NIT/CI: "+v[i]['cliente_nit']+", TIPO DOC.: ";
                    if(v[i]['cdi_codigoclasificador']!=null){ html += v[i]['cdi_codigoclasificador'];} else{ html += "NO ASIGNADO"; };
                    html += "                           <br>Telefono(s): "+v[i]['cliente_telefono'];
                    html += "                           <br>Nota: "+v[i]['venta_glosa'];
                    html += "                       </td>";

                    html += "                       <td style='withe-space:nowrap; padding:0;' align='right' bgcolor='"+v[i]['estado_color']+"'>";
                    html += "                           Sub Total "+parametro_moneda_descripcion+': '+Number(v[i]['venta_subtotal']).toFixed(decimales)+"<br>";
                    html += "                           Desc. "+parametro_moneda_descripcion+': '+Number(v[i]['venta_descuento']).toFixed(decimales)+"<br>";
                    html += "                           <!--<span class='btn btn-facebook'>-->";
                    html += "                           <font size='3' face='Arial narrow'> <b>Total "+parametro_moneda_descripcion+': '+Number(v[i]['venta_total']).toFixed(decimales)+"</b></font><br>";
                    html += "                           <!--</span>-->";
                    html += "                               Efectivo "+parametro_moneda_descripcion+": "+Number(v[i]['venta_efectivo']).toFixed(decimales)+"<br>";
                    html += "                               Cambio "+parametro_moneda_descripcion+": "+Number(v[i]['venta_cambio']).toFixed(decimales);
                    html += "                       </td>";
//alert(v[i]["venta_numerotransmes"]);
                    html += "                       <td align='center' style='padding:0;' bgcolor='"+v[i]['estado_color']+"'><font size='3'><b> 00"+v[i]['venta_id']+((v[i]['venta_numeroventa']>0)?" / 00"+v[i]['venta_numeroventa']:"")+((v[i]['venta_numerotransmes']>0)?" / 00"+v[i]['venta_numerotransmes']:"")+"</b></font>";
                    html += "                           <br><img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='35' height='35'>";
                    html += "                           <br>Vend.: "+v[i]['usuario_nombre'];
                   
                    if (v[i]['prevendedor']!=null){
                        html += "                           <br>Prev.: "+v[i]['prevendedor'];
                    }
                    
                    html += "                        </td>   ";
                    
                    html += "                       <td align='center'  style='padding:0;' bgcolor='"+v[i]['estado_color']+"'>"+v[i]['forma_nombre'];
                    html += "                           <br> "+v[i]['tipotrans_nombre'];
                    html += "                           <br><span><b>"+(v[i]['banco_nombre'] == null ? '':v[i]['banco_nombre'])+"</b></span><br> ";
                    
                    
                    //INDICADOR DE TIPO DE EMISION 1 = online, 2 offline, 3 masiva
//                    if(v[i]['factura_tipoemision'] == 1){
//                        html += "<button class='btn btn-danger btn-xs' title='Emisión en linea'><small><fa class='fa fa-heart'></fa></small></button>";
//                    }
                    if(v[i]['factura_tipoemision'] == 2){
                        html += "<button class='btn btn-facebook btn-xs' style='background: gray; ' title='Emision fuera de linea'><small><fa class='fa fa-heartbeat'></fa></small></button>";
                    }
                    //----------------------------------------------------
                    //alert(v[i]['recpaquete_codigorecepcion']);
                    
                    
                    var paquete = "";                    
                    paquete = v[i]['recpaquete_codigorecepcion'];
                    
                    if(v[i]['factura_enviada'] == 1){
                        
                        html += "<span style='padding:0; font-size:14px; border:0' class='btn btn-info btn-xs' title='COD. RECEP.: "+v[i]['factura_codigorecepcion']+"'><b><small>"+v[i]['factura_numero']+" ENVIADA </small></b></span> ";
                    
                    }else{
    
                        if(v[i]['factura_enviada'] == 2){
                            html += "<span style='font-size:14px; padding:0; border:0' class='btn btn-info btn-xs' title='COD. RECEP.: "+v[i]['factura_codigorecepcion']+"'><b><small>"+v[i]['factura_numero']+" VALIDADA </small></b></span> ";
                        }else{
                        
                                if (paquete==null ){

                                      //html += "<button type='button' class='btn btn-danger btn-xs' style='padding:0;' data-toggle='modal' data-target='#modalpaquetes' title='"+v[i]['factura_mensajeslist']+"' onclick='cargar_eventos("+v[i]['factura_id']+");'>";
                                      //html += "<fa class='fa fa-chain-broken'> </fa> <small>NO ENVIADA</small> </button>";
                                      
                                        if (v[i]['venta_tipodoc']==1){
                                            
                                            html += "<button type='button' class='btn btn-danger btn-xs' style='padding:0;' data-toggle='modal' data-target='#modalpaquetes' title='"+v[i]['factura_mensajeslist']+"' onclick='cargar_eventos("+v[i]['factura_id']+");'>";
                                            html += "<fa class='fa fa-chain-broken'> </fa> <small>"+v[i]['factura_numero']+" NO ENVIADA</small> </button>";                           
                                        
                                        }
//                                        else{
//                                            if(generar_factura == 1){
//                                                if(dosificado == 1){
//                                                    if(v[i]['venta_total'] > 0){
//                                                    
//                                                    
//                                        
//                                                    }
//                                                }
//                                            }
//                                        }

                                }else{

                                      html += "<button type='button' class='btn btn-warning btn-xs' style='padding:0;' data-toggle='modal' data-target='#modalvalidacion' onclick='cargar_codigovalidacion("+JSON.stringify(paquete)+","+v[i]['factura_id']+");'>";
                                      html += "<fa class='fa fa-chain'> </fa> VALID. PENDIENTE </button>";

                                 }
                        }     
                        
                    }
                    
                    //INDICADOR DE CODIGO DE EXCEPCION 1
                    if(v[i]['factura_excepcion'] == 1){
                        html += "<button class='btn btn-default btn-circle btn-xs' title='Cod. Excepcion = 1'><small><fa class='fa fa-thumbs-up'></fa></small></button>";
                    }
                    //----------------------------------------------------
                    
                    
                    html += "                           <br><span class='btn btn-facebook btn-xs' ><b>"+v[i]['estado_descripcion']+"</b></span> ";
                    html += "                       </td>";

                    html += "                       <td style='padding:0;'  bgcolor='"+v[i]['estado_color']+"'><center>";
                    
                            html += "<table style='padding:0; border: hidden;' >";
                            html += "<tr style='padding:0;'>";
                            html += "<td style='padding:0;'>";

                            if(modif_fhora == 1){
        //                        html += "<a onclick='modificarhora("+v[i]['venta_id']+", "+JSON.stringify(v[i]['venta_fecha'])+", "+JSON.stringify(v[i]['venta_hora'])+")' class='btn btn-facebook btn-xs' title='Modificar fecha y hora'>";
        //                        html += formato_fecha(v[i]['venta_fecha']);;
        //                        html += "<br> "+v[i]['venta_hora'];
        //                        html += "</a>";
                               // html += "<br>";
                                html += "<a onclick='modificarhora("+v[i]['venta_id']+", "+JSON.stringify(v[i]['venta_fecha'])+", "+JSON.stringify(v[i]['venta_hora'])+")' class='btn btn-facebook btn-xs' title='Modificar fecha y hora'>";
                                html += "<fa class='fa fa-calendar'></fa>";
                                html += "</a>";

                            }
                            html += "</td>";

                            html += "<td style='padding:0;'>";
                            html +=                             formato_fecha(v[i]['venta_fecha']);
                            html += "                            <br>"+v[i]['venta_hora'];
                            html += "</td>";

                            html += "</tr>";
                            html += "</table>";
                    
                    html += "<input type='button' class='btn btn-warning btn-xs' id='boton"+v[i]['venta_id']+"' value='--' style='display:block'>";
                    
                    html += "                       </center>";
                    html += "                       </td>";

//                    html += "                       <td align='center'>";
//                    html += "                           <img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='50' height='50'>";
//                    html += "                           <br>"+v[i]['usuario_nombre'];
//                    html += "                       </td>";

                    html += "                       <td class='no-print' style='padding:0;' bgcolor='"+v[i]['estado_color']+"'>";
//                    html += "                           <a href='"+base_url+"venta/edit/"+v[i]['venta_id']+"' class='btn btn-info btn-xs no-print' target='_blank' title='Modifica los datos generales de la venta'><span class='fa fa-pencil'></span></a>";
                    //html += "                           <a href='"+base_url+"venta/modificar_venta/"+v[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modificar el detalle/cliente de la venta'><span class='fa fa-edit'></span></a>";
                    html += "                           <a onclick='verificarmodificar("+v[i]['venta_id']+", "+v[i]['estado_id']+")' class='btn btn-facebook btn-xs no-print' title='Modificar el detalle/cliente de la venta'><span class='fa fa-edit'></span></a>";
//                    html += "                           <a href='"+base_url+"venta/nota_venta/"+v[i]['venta_id']+"' class='btn btn-success btn-xs'><span class='fa fa-print'></span></a> ";
                    html += "                           <a href='"+base_url+"factura/imprimir_recibo/"+v[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta' id='imprimir"+v[i]['venta_id']+"'><span class='fa fa-print'></span></a> ";
                    if(certif_garantia == 1){
                        html += "                           <a href='"+base_url+"factura/certificado_garantia/"+v[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir certificado de garantia' style='background-color: purple'> <span class='fa fa-lock'></span> </a> ";
                    }
                    if(tipousuario_id == 1){
                    html += "<a class='btn btn-soundcloud btn-xs' data-toggle='modal' data-target='#modalusuario"+v[i]['venta_id']+"' title='Modificar Usuario vendedor'><span class='fa fa-user'></span></a>";
                    html += "<!------------------------ INICIO modal para cambiar usuario vendedor ------------------->";
                    html += "<div class='modal fade' id='modalusuario"+v[i]['venta_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalusuarioLabel"+v[i]['venta_id']+"' style='font-family: Arial'>";
                    html += "<div class='modal-dialog' role='document'>";
                    html += "<br><br>";
                    html += "<div class='modal-content'>";
                    html += "<div class='modal-header text-center'>";
                    html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                    html += "<span class='text-bold' style='font-size: 13pt'>MODIFICAR USUARIO DE LA VENTA</span><br>";
                    html += "<span style='font-size: 11pt'>Venta N° <b>"+v[i]["venta_id"]+"</b></span>";
                    html += "</div>";
                    html += "<div class='modal-body'>";
                    html += "<!------------------------------------------------------------------->";
                    html += "<div class='col-md-6'>";
                    html += "    <label for='esteusuario_id' class='control-label'><b>Usuario Vendedor</b></label>";
                    html += "    <div class='form-group'>";
                    html += "        <select name='esteusuario_id"+v[i]["venta_id"]+"' class='form-control' id='esteusuario_id"+v[i]["venta_id"]+"'>";
                                        var selectedus = "";
                                        for (var a = 0; a < cantus; a++) {
                                            if(all_usuario[a]["usuario_id"] == v[i]["usuario_id"]){
                                                selectedus= "selected";
                                            }else{
                                                selectedus = "";
                                            }
                                            html += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                                        }
                    html += "        </select>";
                    html += "    </div>";
                    html += "</div>";
                    html += "<!------------------------------------------------------------------->";
                    html += "</div>";
                    html += "<div class='modal-footer text-center'>";
                    html += "<div class='col-md-12 text-center'>";
                    html += "<a onclick='modificar_usuario("+v[i]["venta_id"]+")' class='btn btn-success'><span class='fa fa-check'></span> Modifcar</a>";
                    html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar</a>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "<!------------------------ FIN modal para cambiar usuario vendedor ------------------->";
                    }
                    
                    if (parametro_modulorestaurante==1){
                    html += "                           <a href='"+base_url+"factura/comanda_boucher/"+v[i]['venta_id']+"' class='btn btn-primary btn-xs' target='_blank' title='Imprimir comanda'><span class='fa fa-list'></span></a> ";
                    }
                    
                    if (v[i]['venta_tipodoc']==1){
                        html += " <a href='"+base_url+"factura/imprimir_factura/"+v[i]['venta_id']+"/0' target='_blank' class='btn btn-warning btn-xs' title='Ver/anular factura'><span class='fa fa-list-alt'></span></a> ";
                        html += " <a href='"+base_url+"venta/facturaventapdf/"+v[i]['factura_id']+"' target='_blank' class='btn btn-danger btn-xs' title='Ver factura en PDF'><span class='fa fa-file-pdf'></span></a> ";
                        html += " <a onclick='modal_enviocorreo("+v[i]['venta_id']+","+v[i]['factura_id']+","+JSON.stringify(v[i]['cliente_email'])+")' class='btn btn-warning btn-xs' style='background: #95ace8' title='Enviar factura al correo'><span class='fa fa-envelope-o'></span></a>";
                    }
                    else{
                        if(generar_factura == 1){
                            if(dosificado == 1){
                                if(v[i]['venta_total'] > 0){
                                    html += " <button class='btn btn-facebook btn-xs' style='background-color:#000;' title='Generar factura' onclick='cargar_factura("+JSON.stringify(v[i])+");'><span class='fa fa-modx'></span></button> ";
                                }
                            }
                        }
                    }
                    
                    html += "<br><br>";
                    
                    if (Number(v[i]['pedido_id'])>0){
                        html += "                                   <a href='"+base_url+"pedido/nota_pedido/"+v[i]['pedido_id']+"' target='_blank' class='btn btn-warning btn-xs' title='Ver nota de pedido'><span class='fa fa-list'></span></a> ";
                    }

                    if (Number(v[i]['orden_id'])>0){
                        html += "                                   <a href='"+base_url+"orden_trabajo/ordenrecibo/"+v[i]['orden_id']+"' target='_blank' class='btn btn-default btn-xs' title='Ver Orden de Trabajo'><span class='fa fa-list'></span></a> ";
                    }
                    
                    
                    // html += "                           <a href='"+base_url+"modelo_contrato/generar_contrato/"+v[i]['venta_id']+"' class='btn btn-primary btn-xs' target='_blank' title='Generar contrato'><i class='fa fa-file-text-o' aria-hidden='true'></i></a>";
                    html += "                           <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#modal_contratos' title='Generar contrato' onclick='dar_venta("+v[i]['venta_id']+")'><i class='fa fa-file-text-o' aria-hidden='true'></i></button>";
                    html += "                           <button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+v[i]['venta_id']+"'  title='Anular venta'><em class='fa fa-ban'></em></button>";
                    
                    let archivoxml = dosificacion_documentosector+v[i]['factura_id']+".xml";
                    html += "                           <a href='"+base_url+"resources/xml/"+archivoxml+"' download='Descargar archivo "+archivoxml+"' title='Descargar archivo "+archivoxml+"' class='btn btn-xs btn-twitter'><fa class='fa fa-code'> </fa> </a>";
                    
                    html += "                       <!------------------------ modal para eliminar el producto ------------------->";
                    html += "                               <div class='modal fade' id='myModal"+v[i]['venta_id']+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+v[i]['venta_id']+"' style='font-family: Arial'>";
                    html += "                                 <div class='modal-dialog' role='document'>";
                    html += "                                       <br><br>";
                    html += "                                   <div class='modal-content'>";
                    html += "                                     <div class='modal-header text-center'>";
                    html += "                                       <h1 class='modal-title' id='myModalLabel'>ADVERTENCIA</h1>";
                    html += "                                     </div>";
                    html += "                                     <div class='modal-body'>";
                    html += "                                         <div class='panel panel-primary'>";
                    html += "                                             ";
                    html += "                                         <center>";
                    html += "                                      <!------------------------------------------------------------------->";
                    html += "                                     <h1 style='font-size: 80px'> <b> <em class='text-red fa fa-trash'></em></b></h1> ";
                    html += "                                      <h4>";
                    html += "                                          ";
                    html += "                                          ¿Desea anular la venta? <b> <br>";
                    html += "                                          Trans.: "+v[i]['venta_id']+"<br>";
                    if ((v[i]['pedido_id'])>0){
                            html += "<b class='btn btn-warning'><b> ADVERTENCIA: Se restablecera el PEDIDO Nº: "+v[i]['pedido_id']+" a PENDIENTE</b> </b>" ;
                    }
                    if (v[i]['venta_tipodoc']==1){
                        html += "                                          <br>-----------------------------<br>";
                        //html += "                                          La venta tiene una FACTURA ASOCIADA<br>";
                        html += "              <label><b class='btn btn-warning'><input type='checkbox' name='anular_factura"+v[i]['venta_id']+"' value='1' id='anular_factura"+v[i]['venta_id']+"' checked>";
                        html += " Anular la factura asociada a esta venta? </b></label>" ;
                    }else{
                        html += "<input type='checkbox' name='anular_factura"+v[i]['venta_id']+"' value='0' id='anular_factura"+v[i]['venta_id']+"' hidden>";
                    }
                    html += "                                      </h4>";
                    html += "                                      <!------------------------------------------------------------------->";
                    html += "                                             ";
                    html += "                                         </center>";
                    html += "                                         </div>";
                    html += "                                     </div>";
                    html += "                                     <div class='modal-footer'>";
                    html += "                                         <center>";
                    html += "                                           <a class='btn btn-success btn-sm' onclick='anular_venta("+v[i]['venta_id']+", "+v[i]['factura_id']+", "+JSON.stringify(v[i]['factura_enviada'])+")'><em class='fa fa-check'></em> Si </a>";

                    html += "                                           <a href='#' class='btn btn-danger btn-sm' data-dismiss='modal'><em class='fa fa-times'></em> No </a>";
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
                    html += "                        <th><font size='3'> "+parametro_moneda_descripcion+": "+formato_numerico(total_final.toFixed(decimales))+"</font>";                    
                        
                    var total_final_extragera = 0;
                    var tfme = ""
                    
                    if (parametro_moneda_id==1){
                        total_final_extragera = total_final / moneda_tc; 
                        tfme = moneda_descripcion+" "+total_final_extragera.toFixed(decimales);
                    }else{
                        total_final_extragera = total_final * moneda_tc;
                        tfme = "Bs "+total_final_extragera.toFixed(decimales);
                    }
                    html += "<br>"+tfme;
                    html += "                        </th>	";
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

function dar_venta(venta_id){
    $('#venta_id_contrato').val(venta_id);
}

function montrar_ocultar_fila(parametro)
{
           
    if (parametro == "mostrar"){
        document.getElementById('fila_producto').style.display = 'block';}
    else{
        document.getElementById('fila_producto').style.display = 'none';}
    
}

function formato_numerico(numero){
    
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
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

function verificar_ventas()
{
    var base_url = document.getElementById('base_url').value;    
    let decimales = document.getElementById('parametro_decimales').value;
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
                
                let partes = res[i]["items"];
                let partes1 = partes.toString();
                let partes2 = partes1.split('.');
                if (partes2[1] == 0) { 
                    lacantidad = partes2[0]; 
                }else{ 
                    lacantidad = numberFormat(Number(res[i]["items"]).toFixed(decimales))
                    //lacantidad = number_format(d['detalleven_cantidad'],2,'.',','); 
                }
                if (res[i]["resultado"] == 1){
                    
                    botoncito = "#boton"+res[i]["venta_id"];                    
//                    nombreboton = "boton"+res[i]["venta_id"];                    
                   //botoncito2 = "boton"+res[i]["venta_id"];
                    
                    $(botoncito).val("CONFLICTO | Items: "+lacantidad+"\n"+duplicado);
//                    document.getElementById(nombreboton).style.display = 'block';                                        
                    
                }
                else{
                    
                    botoncito = "#boton"+res[i]["venta_id"];
                    
//                    document.getElementById(botoncito).style.display = 'block'; 
                    $(botoncito).val(" - OK - | Items: "+lacantidad+"\n"+duplicado);
                   
                    
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
    var nit = document.getElementById('nit').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/seleccionar_cliente/"+cliente_id;
    //alert(controlador);
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
                
                if (tam>=1){
                    $("#cliente_id").val(resultado[0]["cliente_id"]);
                    $("#nit").val(resultado[0]["cliente_nit"]);
                    $("#razon_social").val(resultado[0]["cliente_razon"]);
                    $("#telefono").val(resultado[0]["cliente_telefono"]);
                    $("#cliente_nombre").val(resultado[0]["cliente_nombre"]);
                    $("#cliente_ci").val(resultado[0]["cliente_ci"]);     
                    $("#cliente_complementoci").val(resultado[0]["cliente_complementoci"]);
                    $("#cliente_nombrenegocio").val(resultado[0]["cliente_nombrenegocio"]);
                    $("#cliente_codigo").val(resultado[0]["cliente_codigo"]);  
                    $("#tipocliente_id").val(resultado[0]["tipocliente_id"]);  
                    $("#cliente_direccion").val(resultado[0]["cliente_direccion"]);
                    $("#cliente_departamento").val(resultado[0]["cliente_departamento"]);
                    $("#cliente_celular").val(resultado[0]["cliente_celular"]);
                    $("#email").val(resultado[0]["cliente_email"]);
                    $("#tipo_doc_identidad").val(resultado[0]["cdi_codigoclasificador"]);
                    $("#tipocliente_porcdesc").val(resultado[0]["tipocliente_porcdesc"]);
                    $("#tipocliente_montodesc").val(resultado[0]["tipocliente_montodesc"]);

                    //alert(resultado[0]["cdi_codigoclasificador"]);
                                        
                    if (resultado[0]["tipocliente_id"] != null && resultado[0]["tipocliente_id"] >=0)
                    {   //si tiene definido un tipo de cliente 
                        
                        $("#tipocliente_id").val(resultado[0]["tipocliente_id"]); 
                        
                        if(resultado[0]["tipocliente_montodesc"]>0){
                            
                            $("#tipo_descuento").val(1);
                            $("#venta_descuento").val(resultado[0]["tipocliente_montodesc"]);                            
                            calculardesc();
                        } 
                        else{
                            
                            if(resultado[0]["tipocliente_porcdesc"]>0){                                
                                $("#tipo_descuento").val(2); 
                                $("#venta_descuento").val(resultado[0]["tipocliente_porcdesc"]);
                                calculardesc();
                            }
                            else{
                                $("#tipo_descuento").val(1); 
                                $("#venta_descuento").val(0);                                
                            }
                            
                        }
                    
                    
                    }
                    else //si no tiene asignado ningun tipo, le asignara el tipo 1 por defecto
                    {    $("#tipocliente_id").val(1); }
                    
                    
                    if(resultado[0]["zona_id"] != null && Number(resultado[0]["zona_id"]) >=0){
                        $("#zona_id").val(resultado[0]["zona_id"]);
                    }else{
                        $("#zona_id").val(0);
                    }
                    
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
            $("#tipo_doc_identidad").val(datos[0]["cdi_codigoclasificador"]);
            $("#nit").val(datos[0]["cliente_nit"]);
            $("#razon_social").val(datos[0]["cliente_razon"]);
            $("#telefono").val(datos[0]["cliente_telefono"]);
            $("#email").val(datos[0]["cliente_email"]);
            $("#tipocliente_id").val(datos[0]["tipocliente_id"]);  
            $("#cliente_nombre").val(datos[0]["cliente_nombre"]);
            $("#cliente_ci").val(datos[0]["cliente_ci"]);     
            $("#cliente_complementoci").val(datos[0]["cliente_complementoci"]);     
            $("#cliente_nombrenegocio").val(datos[0]["cliente_nombrenegocio"]);
            $("#cliente_codigo").val(datos[0]["cliente_codigo"]);  
            $("#cliente_direccion").val(datos[0]["cliente_direccion"]);  
            $("#cliente_departamento").val(datos[0]["cliente_departamento"]);  
            $("#cliente_celular").val(datos[0]["cliente_celular"]);
            $("#zona_id").val(datos[0]["zona_id"]);
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
    $("#venta_descuentoparcial").val("0");
    
}

function modificar_venta(cliente_id)
{

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/modificar_detalle";    
    
    var venta_id = document.getElementById('venta_id').value; 
    var forma_pago = document.getElementById('forma_pago').value; 
    var tipo_transaccion = document.getElementById('tipo_transaccion').value;
    var usuario_id = document.getElementById('usuario_id').value; 
    var venta_fecha = document.getElementById('venta_fecha').value; 
    var venta_subtotal = document.getElementById('venta_subtotal').value;
    var venta_descuento = document.getElementById('venta_descuento').value;
    var venta_total = document.getElementById('venta_totalfinal').value;
    var venta_efectivo = document.getElementById('venta_efectivo').value;
    var venta_cambio = document.getElementById('venta_cambio').value;
    
    let modificar_credito  = $('#modificar_credito').is(':checked');
    var credito_id = document.getElementById('credito_id').value;
    var cuotas = document.getElementById('cuotas').value;   
    var cuota_inicial = document.getElementById('cuota_inicial').value;
    var credito_interes = document.getElementById('credito_interes').value;
    var modalidad = document.getElementById('modalidad').value;
    var dia_pago = document.getElementById('dia_pago').value;
    var fecha_inicio = document.getElementById('fecha_inicio').value;
    let metodo_frances  = $('#metodofrances').is(':checked');
    let banco_id = forma_pago == 1 ? '0':$('#banco').val();
    var venta_giftcard = document.getElementById('venta_giftcard').value;
    var venta_ice = document.getElementById('venta_ice').value;
    var venta_detalletransaccion = document.getElementById('venta_detalletransaccion').value;
    var venta_glosa = "'"+document.getElementById('venta_glosa').value+"'"; 
    
    
    var hora = new Date();
    
    var venta_hora = hora.getHours()+":"+hora.getMinutes()+":"+hora.getSeconds();
    
    
    
    //var tipo_transaccion = document.getElementById('tipo_transaccion').value; 
    //var pedido_id = document.getElementById('pedido_id').value;
    //var orden_id = document.getElementById('orden_id').value; 
    //var usuarioprev_id = document.getElementById('usuarioprev_id').value;
    //var nit = document.getElementById('nit').value;
    //var razon = document.getElementById('razon_social').value; 
    //var factura_complementoci = document.getElementById('cliente_complementoci').value;
    //let cliente_email = document.getElementById('email').value;
    //var venta_descuentoparcial = document.getElementById('venta_descuentoparcial').value; 
    //var facturado = document.getElementById('facturado').checked;
    
    
    /*
    var moneda_id = 1; 
    var estado_id = 1; 
    
    var venta_comision = document.getElementById('venta_comision').value; 
    var venta_tipocambio = document.getElementById('venta_tipocambio').value; 
    var detalleserv_id = document.getElementById('detalleserv_id').value;
    
    
    
    
    var tiposerv_id = document.getElementById('tiposerv_id').value;
    var venta_numeromesa = document.getElementById('venta_numeromesa').value;
    var parametro_modulorestaurante = document.getElementById('parametro_modulorestaurante').value;
    var parametro_imprimirticket = document.getElementById('parametro_imprimirticket').value;
    
    let tipo_doc_identidad = document.getElementById('tipo_doc_identidad').value;
    
    var codigoexcepcion = document.getElementById('codigoexcepcion').checked;

    
    
    var dosificacion_modalidad = document.getElementById('dosificacion_modalidad').value;

    var registroeventos_codigo = document.getElementById('evento_contingencia').value;
    var parametro_tipoemision = document.getElementById('parametro_tipoemision').value;
    var punto_venta = document.getElementById('punto_venta').value;
    let parametro_puntos = document.getElementById('parametro_puntos').value;
    
    /*if (registroeventos_codigo>0){
        
        var fecha_cafc = document.getElementById('fecha_cafc').value;
        var hora_cafc = document.getElementById('hora_cafc').value;
        var numfact_cafc = document.getElementById('numfact_cafc').value;
        var codigo_cafc = document.getElementById('codigo_cafc').value;
        // si esta tiqueado para que mande todo en uno; caso contrario manda al finalizar la venta
        var mandar_enuno  = $('#mandar_enuno:checked').val();
    }else{
        var mandar_enuno  = 0;
        var fecha_cafc = "";
        var hora_cafc = "";
        var numfact_cafc = 0;
        var codigo_cafc = "";
        
    }*/
//    
//    alert("registroeventos_codigo: "+registroeventos_codigo+
//          " * fecha_cafc: "+fecha_cafc+
//          " * numfact_cafc: "+numfact_cafc+
//          " * codigo_cafc: "+codigo_cafc);
    //alert(venta_efectivo);
    //alert(venta_descuento);
    /*if(codigoexcepcion==true){
        codigo_excepcion = 1;
    }else{
        codigo_excepcion = 0;
    }*/
    
   // alert(codigo_excepcion);
    
    /*var venta_numeroventa = 0;
    var venta_tipodoc = 0;
    var entrega_id = 1;
    var entregaestado_id = 1;


    if (parametro_modulorestaurante==1){
        venta_numeroventa = numero_venta();
    }
    if(parametro_imprimirticket == 1){
        venta_numeroventa = numero_venta();
    }*/
    
    document.getElementById('boton_finalizar').style.display = 'none'; //mostrar el bloque del loader
   
    /*if( facturado == 1){     
        venta_tipodoc = 1;}
    else{
        venta_tipodoc = 0;}
    */
    /*facturado:facturado,*/
    
        //alert(modificar_credito);
        $.ajax({url: controlador,
            type:"POST",
            data:{venta_id:venta_id, cliente_id:cliente_id, forma_pago:forma_pago, tipo_transaccion:tipo_transaccion,
                  usuario_id:usuario_id, venta_fecha:venta_fecha, venta_subtotal:venta_subtotal,
                  venta_descuento:venta_descuento, venta_total:venta_total, venta_efectivo:venta_efectivo,
                  venta_cambio:venta_cambio, modificar_credito:modificar_credito, credito_id: credito_id, 
                  cuotas:cuotas, cuota_inicial:cuota_inicial, credito_interes:credito_interes,
                  modalidad:modalidad, dia_pago:dia_pago, fecha_inicio: fecha_inicio, metodo_frances:metodo_frances,
                  banco:banco_id, venta_giftcard:venta_giftcard, venta_ice: venta_ice,
                  venta_detalletransaccion:venta_detalletransaccion, venta_glosa:venta_glosa},
            success:function(respuesta){
                //window.opener.location.reload();
                window.close();
                //eliminardetalleventa();
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
    var cliente_complementoci = document.getElementById('cliente_complementoci').value;
    var cliente_nombrenegocio = document.getElementById('cliente_nombrenegocio').value;    
    var cliente_codigo = document.getElementById('cliente_codigo').value;    
    var cliente_direccion = document.getElementById('cliente_direccion').value;
    var cliente_departamento = document.getElementById('cliente_departamento').value;
    var cliente_celular = document.getElementById('cliente_celular').value;    
    var zona_id = document.getElementById('zona_id').value;    
    var tipo_doc_identidad = document.getElementById('tipo_doc_identidad').value;
    var cliente_email = document.getElementById('email').value;
//    var cliente_excepcion = document.getElementById("codigoexcepcion").checked;
//    var cliente_excepcion = $('#codigoexcepcion').is(':checked');
    //var cliente_excepcion = (document.getElementById('codigoexcepcion').value == 1)?1:0;
    
    var cliente_excepcion = 0;
    if($('#codigoexcepcion').is(':checked'))
    {    cliente_excepcion = 1; }
    else
    {    cliente_excepcion = 0; }
    
    
   
    if (cliente_id > 0 || nit==0){ //si el cliente existe debe actualizar sus datos 
        //alert("nit:"+nit+",razon:"+razon+",telefono:"+telefono+",cliente_id:"+cliente_id+", cliente_nombre:"+cliente_nombre)
        // alert(cliente_id+" * "+nit);
        var controlador = base_url+'venta/modificarcliente';
        //alert("Por aqui..."+controlador);
        
        $.ajax({url: controlador,
                type:"POST",
                data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo, cliente_email:cliente_email,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id,
                        tipo_doc_identidad:tipo_doc_identidad, cliente_excepcion:cliente_excepcion, cliente_complementoci:cliente_complementoci},
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
            data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre, tipocliente_id:tipocliente_id,
                        cliente_ci:cliente_ci,cliente_nombrenegocio:cliente_nombrenegocio, cliente_codigo:cliente_codigo, cliente_email:cliente_email,
                        cliente_direccion:cliente_direccion, cliente_departamento:cliente_departamento, cliente_celular:cliente_celular, zona_id:zona_id,
                        tipo_doc_identidad:tipo_doc_identidad, cliente_excepcion:cliente_excepcion, cliente_complementoci:cliente_complementoci},
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
    let tipo_trans   = document.getElementById('tipo_transaccion').value;
    let met_frances  = $('#metodofrances').is(':checked');
    let interes_porc = document.getElementById('credito_interes').value;
    
    if(tipo_trans == 2 && met_frances == true && (interes_porc <= 0 || interes_porc == "")){
        
        alert("El interes debe ser mayor a 0 para el metodo Frances");
        
    }else{
        
        var monto = document.getElementById('venta_totalfinal').value;

        if (monto>0)
        {
            $("#diventas1").style = "display:block";
            $("#diventas0").style = "display:none";

            registrarcliente_modificado();
        }
        else
        {
            // var txt;
            var r = confirm("La venta no tiene ningun detalle o los precios estan en Bs 0.00. \n ¿Desea Continuar?");
            if (r == true) {
              registrarcliente_modificado();
            } 
            //document.getElementById("demo").innerHTML = txt;
        }
        
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
            alert('El inventario se actualizó exitosamente...! ');
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

function actualizar_marcas()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_marcas/";
    
    document.getElementById('oculto').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El lista de marcas se actualizó exitosamente...! ');
            //redirect('inventario/index');
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            location.reload();
            
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
//
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
    
    var input = document.getElementById('inputcaract').value;
    //var cadena = input+preferencia+"|";
    

    $("#preferencia_id").val(preferencia_id);
    //$("#inputcaract").val(cadena);
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
    
    
    var porcdesc = document.getElementById('tipocliente_porcdesc').value;
    var montodesc = document.getElementById('tipocliente_montodesc').value;
    
    
    if (Number(porcdesc)>0){
        //alert("eee: "+porcdesc);
        $("#tipo_descuento").val(2);
        $("#venta_descuento").val(porcdesc);
        calculardesc();
    }
    else if(Number(montodesc)>0){
        $("#tipo_descuento").val(1);                
        $("#venta_descuento").val(montodesc);
        calculardesc();
    }
    let es_acredito = document.getElementById('credito_id').value;
    $('#modalfinalizar').on('shown.bs.modal', function() {
        if(es_acredito >0){
            $("#tipo_transaccion").prop("selectedIndex", 1);
            mostrar_ocultar();
            let credito = JSON.parse(document.getElementById('elcredito').value);
            $("#cuota_inicial").val(credito['credito_cuotainicial']);
            $("#credito_interes").val(credito['credito_interesproc']);
            $("#cuotas").prop("selectedIndex", (credito['credito_numpagos']-1));
            
            $("#fecha_inicio").val(credito['credito_fechalimite']);
            
        }
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

function focus_cambio_rapido(){
    
        $('#modal_actualizarprecio').on('shown.bs.modal', function() {
        $('#modificarprecios_producto_costo').focus();
        $('#modificarprecios_producto_costo').select();
    });
}


/* elimina un detalle de factura aux */
function actualizar_precio(){
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"venta/modificar_precios";
    var producto_id = document.getElementById("modificarprecios_producto_id").value;
    var producto_costo = document.getElementById("modificarprecios_producto_costo").value;
    var producto_precio = document.getElementById("modificarprecios_producto_precio").value;
    var actualizarpreciossucursales = $('#actualizarpreciossucursales').is(':checked');
    
    //alert(actualizarpreciossucursales);
    

    
    $.ajax({url: controlador,
            type: "POST",
            data:{producto_id:producto_id, producto_costo:producto_costo, producto_precio:producto_precio, actualizarpreciossucursales:actualizarpreciossucursales}, 
            success:function(resultado){
 
                tablaresultados(1);
//                var registros =  JSON.parse(resultado);
//                if (registros != null){
//                    cargar_factura2(venta_id);
//                }

            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}

function focus_cantidad(producto_id){
    
//    alert(producto_id);
        var campo = "cantidad"+producto_id;

        mostrar_clasificador_boton(producto_id);
    
        $('#myModal'+producto_id).on('shown.bs.modal', function() {
        $('#'+campo).focus();
        $('#'+campo).select();
        
        //alert(campo);
        
        try{
            $('#input_detalleven_preferencia'+producto_id).val("");
        }catch (error){
            
        }

    });
}

function pedidos_pendientes()
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'/pedido/mostrar_pedidos';
    var parametro = document.getElementById('filtrar3').value;
    var moneda_principal = document.getElementById('parametro_moneda_descripcion').value;
    
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
                        html += "         <b><br>"+formato_fecha(p[i]['pedido_fechaentrega'])+"</b> <br>"+p[i]['pedido_horaentrega'];
                        html += "     </td>";
                        html += "      ";
                        html += "     ";
                        html += "     <td align='right' style='white-space: nowrap' >Sub Total "+moneda_principal+": "+formato_numerico(p[i]['pedido_subtotal'])+"<br>";
                        html += "		Desc. "+moneda_principal+": "+formato_numerico(p[i]['pedido_descuento'])+"<br>  ";
                        html += "	    <font face='Arial narrow'  size='3'><b>"+moneda_principal+" "+formato_numerico(p[i]['pedido_total'])+"</b></font>";
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
    
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
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
                        html += Number(registros[i]["detallefact_precio"]).toFixed(decimales);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_subtotal"]).toFixed(decimales);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td>&nbsp;";
                        html += "<a onclick='quitardetalle_aux("+registros[i]["detallefact_id"]+", "+venta_id+")' class='btn btn-danger btn-xs' title='Quitar detalle'><span class='fa fa-times'></span> </a>";
                        html += "</td>";
                        html += "</tr>";
                    }
                    html += "</table><br>";
                           
                    $("#doc_identidad").val(registros[0]['cdi_codigoclasificador']);
                    $("#generar_nit").val(registros[0]['cliente_nit']);
                    $("#generar_razon").val(registros[0]['cliente_razon']);
                    $("#generar_detalle").html(html);
                    $("#generar_venta_id").val(registros[0]['venta_id']);
                    $("#generar_monto").val(Number(total_final).toFixed(decimales));
                    
                    //alert(resultado[0]["cdi_codigoclasificador"]);
                                        
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
            error:function(){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}

function cargar_infcliente(cliente_id){
    //var decimales = Number(document.getElementById('parametro_decimales').value);
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"cliente/get_infcliente";
    $.ajax({url: controlador,
            type: "POST",
            data:{cliente_id:cliente_id},
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                $("#elemail").val(registros.cliente_email);
                if(registros.cliente_excepcion == 1){
                    $("#codigoexcepcion").prop("checked", true);
                }else{
                    $("#codigoexcepcion").prop("checked", false);
                }
            },
            error:function(){
                alert("Ocurrio un problema al cargar la informacion del Cliente... Verifique los datos por favor");
            },
            
    });
    
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

function ingresar_promocion(promocion_id){
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"detalle_venta/ingresar_promocion";
    
    $.ajax({url: controlador,
            type: "POST",
            data:{promocion_id:promocion_id}, 
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                
                
//                if (registros.length>0){
//                    
//                }
            },
        });
                
           
    tablaproductos();
}
/* funcion que modifca al usuario vendedor */
function modificar_usuario(venta_id){
    var base_url = document.getElementById('base_url').value;
    var esteusuario_id = document.getElementById('esteusuario_id'+venta_id).value;
    var controlador = base_url+'venta/modificar_usuariovendedor';
    $('#modalusuario'+venta_id).modal('hide');
        $.ajax({url: controlador,
            type:"POST",
            data:{esteusuario_id:esteusuario_id, venta_id:venta_id},
            success:function(respuesta){
                resultado = JSON.parse(respuesta);
                /*if(resultado == "ok"){
                    buscar_servicioporfechas();
                    //fechadeservicio(null, 1);
                }*/
                if(resultado == "ok"){
                        $('#filtrar').val(venta_id);
                        ventas_por_parametro();
                    }
            },
            error: function(respuesta){
            }
        });
}

function imprimirtodo(){
    var base_url = document.getElementById('base_url').value;
    var resventa = document.getElementById('resventa').value;
    var registros =  JSON.parse(resventa);
    var n = registros.length; //tamaño del arreglo de la consulta
    for (var i = 0; i < n ; i++){
        window.open(base_url+'factura/imprimir_recibo/'+registros[i]["venta_id"], '_blank');
        //alert($('#imprimir'+venta_id).attr('id'));
        }
}

//
//function mostrar_modalclasificador(detallecomp_id, producto_id){    
//
//    mostrar_clasificador(detallecomp_id, producto_id);
//    $("#boton_modal_promocion").click(); 
//    
//}

function mostrar_clasificador(producto_id,detalleven_id){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/clasificador_producto";
    var html = "";

    //para llenar el select de clasificador de productos
     $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
           success:function(respuesta){     
               r = JSON.parse(respuesta);
               var html = "";
               
                html +="<input type='hidden' value='"+detalleven_id+"' id='input_detalleven'>";
                html +="<select id='select_clasificador'>";
                for (var i=0; i<r.length; i++){
                    html +="<option value="+r[i]["clasificador_id"]+">";
                    html +=r[i]["clasificador_nombre"];
                    html +="</option>";                   
                }
                html +="</select>";               
               
               $("#div_clasificador").html(html);

           },
           error: function(respuesta){
               
           }
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

function seleccionar_tipocliente(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/seleccionar_tipocliente";
    var tipocliente_id = document.getElementById('tipocliente_id').value;
    
    //para llenar el select de clasificador de productos
     $.ajax({url: controlador,
           type:"POST",
           data:{tipocliente_id:tipocliente_id},
           success:function(respuesta){     
               
               var r = JSON.parse(respuesta);
               
               if (r.length>0){
                   $("#tipocliente_porcdesc").val(r[0]["tipocliente_porcdesc"]);
                   $("#tipocliente_montodesc").val(r[0]["tipocliente_montodesc"]);
                   
               }

           },
           error: function(respuesta){
               
           }
       });              
}


function mostrar_composicion(detalleven_id){
    var html = "";
    var boton = document.getElementById('boton_composicion'+detalleven_id);
    
    //alert(boton.innerText);
    if (boton.innerText  == '[+]'){        
            boton.innerText = '[-]';


            var base_url = document.getElementById('base_url').value;
            var controlador = base_url+"venta/detalle_composicion";
            var tipocliente_id = document.getElementById('tipocliente_id').value;

            //para llenar el select de clasificador de productos
             $.ajax({url: controlador,
                   type:"POST",
                   data:{detalleven_id:detalleven_id},
                   success:function(respuesta){     

                       var r = JSON.parse(respuesta);
                       var estilo = "style='padding:0; font-family: Arial; font-weight: lighter; font-size: 10px; background: white;'";
                       
                       
                        html +="<table >";
                        html +="<tr>";
                        
//                        html +="<th "+estilo+">- # -</th>";
//                        html +="<th "+estilo+">PRODUCTO</th>";
//                        html +="<th "+estilo+">CANT</th>";
//                        html +="<th "+estilo+">P.UNIT</th>";
//                        html +="<th "+estilo+">TOTAL</th>";
//                        
                        
                        html +="<td "+estilo+"></td>";
                        html +="<td "+estilo+">- # -</td>";
                        html +="<td "+estilo+"> PRODUCTO </td>";
                        html +="<td "+estilo+"> CANT </td>";
                        html +="<td "+estilo+"> P.UNIT </td>";
                        html +="<td "+estilo+"> TOTAL </td>";
                        html +="<td "+estilo+"></td>";
                        
                        html +="</tr>";
                        
                       for (var i=0; i < r.length ; i++){
                            html +="<tr "+estilo+">";
                            html +="<td></td>";
                            html +="<td "+estilo+">";
                            html +="<button class='btn btn-danger btn-xs' style='padding:0; background: transparent; border:none;'><fa class='fa fa-trash' style='color:red;'> </fa></button>";                                    
                            html +="</td>;";
//                            html +="<td "+estilo+">"+(i+1)+" </td>";
                            html +="<td "+estilo+">";
                            html +=r[i]["producto_nombre"];
                            html += "</td>";

                           html +="<td "+estilo+">"+r[i]["detallecomp_cantidad"]+"</td>";
                            html +="<td "+estilo+">"+r[i]["detallecomp_precio"]+"</td>";
                            html +="<td "+estilo+">"+r[i]["detallecomp_precio"]*r[i]["detallecomp_cantidad"]+"</td>";
                            //botones
                            html +="<td "+estilo+">";
                            html +="<button class='btn btn-warning btn-xs' style='padding:0; background: transparent; border:none;'><fa class='fa fa-caret-square-o-down' style='color:blue;'> </fa></button>";                                    
                            html +="</td>";                                    
                            html +="</tr>";
                           
                       }
                       
                        html +="</table>";

                        $("#tabla_composicion"+detalleven_id).html(html);
                   },
                   error: function(respuesta){

                   }
               });              


    }    
    else {
        boton.innerText  = '[+]';
        html =""
        $("#tabla_composicion"+detalleven_id).html(html);
        
    }
    
}

function modificarhora(venta_id, lafecha, lahora){
    $('#num_venta').html(venta_id);
    $('#nunmventa_id').val(venta_id);
    $('#modif_fecha').val(lafecha);
    $('#modif_hora').val(lahora);
    $('#modalmodificarhora').modal('show');
    //$('#modalmodificarhora').modal('hide');
}

function guardar_fechahora(){
    var base_url = document.getElementById('base_url').value;
    var laventa_id = $('#nunmventa_id').val();
    var la_fecha = $('#modif_fecha').val();
    var la_hora  = $('#modif_hora').val();
    var controlador = base_url+"venta/modificar_fechahora";
    $.ajax({url: controlador,
        type:"POST",
        data:{venta_id:laventa_id, la_fecha:la_fecha, la_hora:la_hora},
        success:function(report){
            var registros =  JSON.parse(report);
            location.reload();
        }
    });
}

function guardar_formula()
{
//    alert("guardar formula");
    
    var monto = document.getElementById('venta_totalfinal').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'formula/registrar_formula/';
    
    var formula_nombre = document.getElementById('formula_nombre').value;
    var formula_unidad = document.getElementById('formula_unidad').value;
    var formula_cantidad = document.getElementById('formula_cantidad').value;
    //var formula_costounidad = document.getElementById('formula_costounidad').value;
    var formula_costounidad = monto;
    var formula_preciounidad = document.getElementById('formula_preciounidad').value;
    
    var producto_id = document.getElementById('lista_productos').value;
    
    
    
        
        if(formula_nombre != ""){
        if (Number(monto) > 0){
            if(Number(formula_cantidad) > 0){
                if(Number(producto_id) > 0){
                        if(Number(formula_preciounidad) > 0){
            
                                document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
                                document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader

                                 $.ajax({url: controlador,
                                 type: "POST",
                                 data:{formula_nombre:formula_nombre, formula_unidad:formula_unidad, formula_cantidad:formula_cantidad, 
                                       formula_costounidad:formula_costounidad,formula_preciounidad:formula_preciounidad, producto_id:producto_id}, 
                                 success:function(respuesta){

                                     resultado = JSON.parse(respuesta);
                                     eliminardetalleventa();
                                     
                                     //var factura_id = resultado;

                                     //alert("aquiiii");

                                   //window.open(base_url+"factura/imprimir_factura_id/"+factura_id+"/1", '_blank');
                                   //window.open(base_url+"formula", '');
                                   redirect(base_url+"formula");

                                 },
                                 error:function(resultado){
                                     alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
                                 },        

                                 });

                                document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
                                document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader

            
                        }else{ 
                                $("#formula_preciounidad").focus();
                                $("#formula_preciounidad").select();
                                alert("ERROR: Debe especificar el PRECIO del producto terminado...!!");  
                            }
                    }else{ 
                            $("#lista_productos").focus();
                            $("#lista_productos").select(); 
                            alert("ERROR: Debe seleccionar un PRODUCTO DESTINO...!!");   
                         }
                }else{ 
                        $("#formula_cantidad").focus();
                        $("#formula_cantidad").select();                    
                        alert("ERROR: Debe especificar una CANTIDAD para la producción...!!");
                 }
            }else{             
                    $("#filtrar").focus();
                    $("#filtrar").select();                    
                    alert("ERROR: La formula debe contener insumos...!!");   
                }
        }else{ 
                    alert("ERROR: Debe especificar el NOMBRE DE LA FORMULA...!!");   
//                    $("#formula_nombre").focus();
//                    $("#formula_nombre").select();
                    document.getElementById('formula_nombre').focus();
                    document.getElementById('formula_nombre').select();
             }
    
}


function buscador_productos(e)
{   
    tecla = (document.all) ? e.keyCode : e.which;
    var parametro = document.getElementById("lista_productos").value;
    
    
    if (tecla == 13)
    {
        //alert(parametro);
        
        if (parametro.length>0){
            
            var base_url = document.getElementById('base_url').value;
            
            var controlador = base_url+"venta/buscarproductos";

                    $.ajax({url: controlador,
                        type:"POST",
                        data:{parametro:parametro},
                        success:function(respuesta){
                            var r = JSON.parse(respuesta);
                            var html = "";
                            //alert(r.length);
                            for(var i=0;i<r.length; i++){
                                html += "<option value='"+r[i]["producto_id"]+"' data-producto='"+r[i]["producto_nombre"]+"'>"+r[i]["producto_nombre"]+"</option>";
                            }
                           $("#listaproductos").html(html);
                        }
                    });      
        }
        else { alert('ADVERTENCIA: ocurrio un error'); }
    }
}

function mostrame(){
    
    //var valor = document.getElementById("lista_productos").value;
    //alert(valor);

    var value = $("input[name=lista_productos]").val();
    var data = $("#listaproductos[value='"+value+"']").data('producto');
 //   alert(value+"***"+data);
    
}

function verificarmodificar(venta_id, estado_id){
    if(estado_id == 3){
        alert("No puede modificar la venta, debido a que esta venta fue anulada!");
    }else{
        var base_url    = document.getElementById('base_url').value;
        window.open(base_url+'venta/modificar_venta/'+venta_id, '_blank');
    }
}
/* registra puntos de una venta a un cliente  */
function registrarpuntos(cliente_id, venta_total){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/registrar_puntos";
    $.ajax({url: controlador,
        type:"POST",
        data:{cliente_id:cliente_id, venta_total:venta_total},
        success:function(resultado){
            
        }
    });
}

function mostrar(forma_id,venta_detalletransaccion){
    let forma = $(`#${forma_id}`).val();
    $(`#${venta_detalletransaccion}`).css('display',forma != 1 ? 'block':'none');
}

/* verifica si el nit/ci es correcto */
function verificarnit(){
    
    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('nit').value;
    var controlador = base_url+'dosificacion/verificarNit';

    document.getElementById('loader_documento').style.display = 'block';    
    
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            success:function(respuesta){
                var registros = JSON.parse(respuesta);
                /*console.log(registros);
                console.log(registros.RespuestaVerificarNit.mensajesList.codigo);
                console.log(registros.RespuestaVerificarNit.mensajesList.descripcion);
                console.log(registros.RespuestaVerificarNit.transaccion);*/
                let elcodigo = registros.RespuestaVerificarNit.mensajesList.codigo;
                $("#mensajeadvertencia").html(registros.RespuestaVerificarNit.mensajesList.descripcion);
                if(elcodigo != 986){
                    $("#modal_mensajeadvertencia").modal("show");
                        
                    $('#modal_mensajeadvertencia').on('shown.bs.modal', function() {
                    $('#boton_advertencia').focus();
                    });

                    
                }
                
                //alert("hola");
                /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema
                    
                }*/
                document.getElementById('loader_documento').style.display = 'none';
            },
            error:function(respuesta){
                alert("Algo salio mal; por favor verificar sus datos!.");
                document.getElementById('loader_documento').style.display = 'none';
            }                
    }); 

}
/* verifica si el nit/ci es correcto */
function verificar_conexion_enventas(){
    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('nit').value;
    var controlador = base_url+'dosificacion/verificar_lacomunicacion';
    let resultado = "";
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            async: false,
            success:function(respuesta){
                let registros = JSON.parse(respuesta);
                //alert(registros);
                resultado = registros;
            },
            error:function(respuesta){
                resultado = false;
                //alert("Algo salio mal; por favor verificar sus datos!.");
            }  
    });
    return resultado;
}

function cargar_eventos(factura_id){
    
    var base_url = document.getElementById('base_url').value;
    var nombre_archivo = document.getElementById('dosificacion_documentosector').value;
    var ubicacion = base_url+'resources/xml/';
    var archivo = nombre_archivo+factura_id+".tar.gz";
    
    $("#nombre_archivo").val(archivo);
    $("#lafactura_id").val(factura_id);
   
}

function cargar_codigovalidacion(codigo_recepcion,factura_id){
    
    //alert(codigo_recepcion);
    $("#codigo_recepcion").val(codigo_recepcion);
    $("#factura_id").val(factura_id);
   
}

function verificar_cufd(){
    
    var parametro_factura = document.getElementById('parametro_factura').value;
        
    if (parametro_factura!=3){
        
        var base_url = document.getElementById('base_url').value;
        var nit = document.getElementById('nit').value;
        var punto_venta = document.getElementById('punto_venta').value;
        var controlador = base_url+'venta/verificar_cufd';    
        let resultado = "";

        //alert(punto_venta+" *** "+nit);

        $.ajax({url:controlador,
                type:"POST",
                data:{nit:nit},
                async: false,
                success:function(respuesta){
                    let registros = JSON.parse(respuesta);
                    //alert(registros);
                    resultado = registros;
                    
                    if(!registros){

                        var mensaje;
                        var opcion = confirm("No existe un CUFD VIGENTE. \r\n ¿Desea registrar un nuevo CUFD?");

                        if (opcion == true) {
                            //alert("solicitanto cufd...!!"+punto_venta);
                            solicitudCufd(punto_venta);
                           // window.location.href = base_url+"punto_venta";
                        }else{
                            alert(JSON.stringify(registros));
                        }
                    }                
                },
                error:function(respuesta){
                    resultado = false;
                    //alert("Algo salio mal; por favor verificar sus datos!.");
                }  
        });

    
    }
        
}

function modal_enviocorreo(venta_id, factura_id, cliente_email){
    $("#lafactura").val(factura_id);
    $("#laventa").val(venta_id);
    $("#elcorreo").val(cliente_email);
    $("#modal_enviofactura").modal("show");
}

function enviarfactura_porcorreo(){
    
    let base_url  = document.getElementById('base_url').value;
    let elcorreo  = document.getElementById('elcorreo').value;
    let factura_id= document.getElementById('lafactura').value;
    let venta_id  = document.getElementById('laventa').value;
    var controlador = base_url+'venta/enviarfactura_porcorreo';
    
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    let res = pattern.test(elcorreo);
    if(!res){
        alert("El correo electrónico es invalido, por favor verifique sus datos!.");
    }else{
        document.getElementById('oculto').style.display = 'block'; //muestra el bloque del loader
        $.ajax({url: controlador,
                type:"POST",
                data:{venta_id:venta_id, factura_id:factura_id, elcorreo:elcorreo},
                success:function(respuesta){
                    var res = JSON.parse(respuesta);
                    if(res){
                        alert("Correo enviado satisfactoriamente");
                    }else{
                        alert("Correo invalido, por favor verifique sus datos!.");
                    }
                    $("#modal_enviofactura").modal("hide");
                    document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
                },
                error:function(respuesta){
                   // alert("Algo salio mal...!!!");
                   html = "";
                   $("#tablaresultados").html(html);
                },
                complete: function (jqXHR, textStatus) {
                    document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader 
                    //tabla_inventario();
                }
        });
    }
    
}

function cargar_contingencia(){
   //alert("cargando contingencia..!");
   
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/facturas_contingencia';
    var codigo_evento = document.getElementById("evento_contingencia").value;
   
    
    if (codigo_evento == 0){
      
        document.getElementById("div_cafc").style.display = "none";      
        document.getElementById("codigoexcepcion").checked = false;
  
    }else{
      
        document.getElementById("div_cafc").style.display = "block";
        $("#boton_finventa").click();
        document.getElementById("codigoexcepcion").checked = true;
        
        //******************************************************
            if (codigo_evento>0){
                
                $.ajax({url: controlador,
                          type:"POST",
                          data:{codigo_evento:codigo_evento},
                          success:function(respuesta){
                              
                              var registros =  JSON.parse(respuesta);
                             // $("#modal_tipoemision").modal("hide");
                                              
                              //alert(registros.length);
                              var fecha_hora = registros[0]["registroeventos_inicio"];
                              var fecha = fecha_hora[0]+fecha_hora[1]+fecha_hora[2]+fecha_hora[3]+fecha_hora[4]+
                                      fecha_hora[5]+fecha_hora[6]+fecha_hora[7]+fecha_hora[8]+fecha_hora[9];
                              //alert(fecha);
                              var hora = fecha_hora[11]+fecha_hora[12]+fecha_hora[13]+fecha_hora[14]+
                                      fecha_hora[15]+fecha_hora[16]+fecha_hora[17]+fecha_hora[18];
                             // alert(hora);
                              
                                $("#fecha_cafc").val(fecha);
                                //$("#hora_cafc").val(hora);
                                $("#numfact_cafc").val(registros[0]["facturacontingencia_numero"]);
                                $("#codigo_cafc").val(registros[0]["facturacontingencia_cafc"]);

                          },
                          error:function(respuesta){
                             // alert("Algo salio mal...!!!");
                             html = "";
                             $("#tablaresultados").html(html);
                             document.getElementById('loader_documento').style.display = 'none';
                          },
                          complete: function (jqXHR, textStatus) {
                              document.getElementById('loader_documento').style.display = 'none'; //ocultar el bloque del loader 
                              //tabla_inventario();
                          }
                  });    

            }else{
                alert("ERROR: Debe seleccionar un evento/archivo a enviar");
            }        
        
        

        //******************************************************
        
        

        
    }
    
}

function excepcion_nit(){
    
    document.getElementById("codigoexcepcion").checked = true;
    $("#razon_social").focus();
    $("#razon_social").select();
    
}

function cancelar_excepcion_nit(){
    
    document.getElementById("codigoexcepcion").checked = false;
    $("#razon_social").val("");
    $("#cliente_valido").val("0");
    $("#nit").focus();
    $("#nit").select();
    
    $("#razon_social").css("background-color", "gray");
    $("#razon_social").attr("readonly","readonly");
}

function seleccion_documento(){
    
    $("#razon_social").css("background-color", "gray");
    $("#razon_social").attr("readonly","readonly");
    
    $("#razon_social").focus("");
    $("#nit").focus();
    $("#nit").select();
}

function solicitudCufd(punto_venta=0){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cufd';
    var opcion = confirm("Esta a punto de generar el C.U.F.D. para el PUNTO DE VENTA "+punto_venta+", el cual reemplazará el existente...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        //alert("gegegegenerando cufd: "+punto_venta);
        //document.getElementById('loader_revocado').style.display = 'block';  
        
        $.ajax({url:controlador,
                type:"POST",
                data:{punto_venta:punto_venta},
                success:function(respuesta){
                    var datos = JSON.parse(respuesta);
                    //var datos =  JSON.parse(registros);
                let registros = datos['respuesta'];
                let lafalla = datos['falla']
                    
                    /*console.log(registros);
                    console.log(registros.RespuestaVerificarNit.mensajesList.codigo);
                    console.log(registros.RespuestaVerificarNit.mensajesList.descripcion);
                    console.log(registros.RespuestaVerificarNit.transaccion);*/
                    //let elcodigo = registros.RespuestaVerificarNit.mensajesList.codigo;
                    if(lafalla != ""){
                        alert(JSON.stringify(registros)+"\n"+JSON.stringify(lafalla));
                       // document.getElementById('loader_revocado').style.display = 'none';
                    }else{

                        let codigo = registros.RespuestaCufd.codigo;
                        let codigoControl = registros.RespuestaCufd.codigoControl;
                        let direccion = registros.RespuestaCufd.direccion;
                        let fechaVigencia = registros.RespuestaCufd.fechaVigencia;
                        let transaccion = registros.RespuestaCufd.transaccion;

                        //alert(registros);
                        if(transaccion == true){
                           // $("#modal_mensajeadvertencia").modal("show");
                            almacenar_cufd((registros['RespuestaCufd']),punto_venta);
                        }
                    else{
                        alert(JSON.stringify(registros));
                    }
                    // document.getElementById('loader_cufd').style.display = 'none';
                    //alert("hola");
                    /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema

                    }*/
                    }

                },
                error:function(respuesta){
                    let datos = JSON.parse(respuesta);
                    let registros = datos['respuesta'];
                    let lafalla = datos['falla']
                   alert(JSON.stringify(registros)+"\n"+JSON.stringify(lafalla));
                }
        }); 
    }
}

function almacenar_cufd(datos,punto_venta=0){
    
    var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'dosificacion/almacenarcufd';   
    
    var codigo = datos.codigo;
    let codigoControl = datos.codigoControl;
    let direccion = datos.direccion;
    var fechavigencia = datos.fechaVigencia;
    var transaccion = datos.transaccion;    

//    alert(codigo+" * "+codigoControl+" * "+direccion+" * "+fechaVigencia+" * "+transaccion);
    //alert("ña ña ña ña ña ña ña ña ña ñaaaaa, batman..!!")
    
            $.ajax({url:controlador,
                    type:"POST",
                    data:{codigo:codigo, 
                        codigoControl:codigoControl, 
                        direccion:direccion,
                        fechavigencia:fechavigencia, 
                        transaccion:transaccion,
                        punto_venta:punto_venta
                    },
                    success:function(respuesta){

                        alert("C.U.F.D generado y almacenado correctamente...!");
                        //document.getElementById('loader_revocado').style.display = 'none';
                        dibujar_tabla_puntos_venta();
                       
                    },
                    error:function(respuesta){
                        alert("Algo salio mal; por favor verificar sus datos!.");
                    }                
            }); 
    
}

function modal_cambiartipoemision(){
    $("#modal_tipoemision").modal("show");
}

/* desde ventas cuando  cambiamos el tipo de emision de la facturas (online, offline) */
function cambiar_tipoemision()
{
    var base_url = document.getElementById('base_url').value;
    var parametro_id = document.getElementById('elparametro_id').value;
    var punto_venta = document.getElementById('punto_venta').value;
    var parametro_tipoemision = document.getElementById('elparametro_tipoemision').value;
    var controlador = base_url+'parametro/cambiar_tipoemision';
    var select_eventos = document.getElementById('select_eventos').value;
    var select = document.getElementById('select_eventos'); //El <select>
        select_texto = select.options[select.selectedIndex].innerText; //El texto de la opción seleccionada
    
    /*alert(
    "parametro_id: "+parametro_id+"\n\l"+
    "punto_venta: "+punto_venta+"\n\l"+
    "parametro_tipoemision: "+parametro_tipoemision+"\n\l"+    
    "select_eventos: "+select_eventos+"\n\l"+
    "select: "+select+"\n\l"+
    "select_texto: "+select_texto);
    */
    if(parametro_tipoemision == 1){
        document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas
        document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader
        document.getElementById('loader_emision').style.display = 'block'; //muestra el bloque del loader
    }

    $.ajax({url: controlador,
            type:"POST",
            data:{parametro_tipoemision:parametro_tipoemision, parametro_id:parametro_id, select_eventos: select_eventos, select_texto: select_texto},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                $("#modal_tipoemision").modal("hide");
               
                    alert(JSON.stringify(registros));
                    location.reload();
                
//                if(parametro_tipoemision == 1){
//                    
//                    var mensaje;                    
//                    var opcion = confirm("ADVERTENCIA: Debe actualizar el CUFD, continuar?");
//                    
//                    if (opcion == true) {
//                        
//                        
//                        //solicitudCufd(punto_venta);                      
//                    }
//                  document.getElementById("ejemplo").innerHTML = mensaje;
//                }
                
                //document.getElementById('loader_documento').style.display = 'none';
                
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
               document.getElementById('loader_documento').style.display = 'none';
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader_documento').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
}


function verificar_conexion(){

    alert("navegador en linea: "+navigator.onLine);

}

/** viene de ventas, prepara el modal para mandar paquete con CAFC!. */
/*function preparar_parametros(){
    var codigo_evento = document.getElementById("codigo_evento").value;

}*/
/**  desde ventas con CAFC; prepara y envia el paquete a impuestos para su recepcion y validacion!... */
function envio_paquetes(){
    var base_url = document.getElementById('base_url').value;
    //var parametro_id = document.getElementById('elparametro_id').value;
    var controlador = base_url+'parametro/enviar_paquete';
    var codigo_evento = document.getElementById("codigo_evento").value;
    
    if (codigo_evento>0){
        document.getElementById('loader3').style.display = 'block';
        $.ajax({url: controlador,
                type:"POST",
                data:{codigo_evento:codigo_evento},
                success:function(respuesta){
                    
                    var registros =  JSON.parse(respuesta);
                    $("#modalpaquetes").modal("hide");
                    alert(JSON.stringify(registros));
                    document.getElementById('loader3').style.display = 'none';
                    location.reload();
                    
                  },
                  error:function(respuesta){
                     //alert("Algo salio mal...!!!");
                     alert(JSON.stringify(respuesta));
                     document.getElementById('loader3').style.display = 'none';
                  },
                  complete: function (jqXHR, textStatus) {
                      document.getElementById('loader3').style.display = 'none';
                  }
          });
          document.getElementById('loader3').style.display = 'none';
    }else{
        alert("ERROR: Debe seleccionar un evento/archivo a enviar");
    }
}


//function generar_cufd(){
//    alert("Generando CUFD");
//}

function ofuscar_tarjeta(){
    
    $cadena = document.getElementById("venta_detalletransaccion").value;
    $tarjeta = "";
    $tam = $cadena.length;
    
        if ($tam<16){
            
            for(var i = 0; i<$cadena.length; i++){

                if(i>=4 && i <12){
                    $tarjeta += "0";           
                }else{
                    $tarjeta += $cadena[i];            
                }

            }
        }else{
            
            for(var i = 0; i<16; i++){
                if(i>=4 && i <12){
                    $tarjeta += "0";           
                }else{
                    $tarjeta += $cadena[i];            
                }                
            }            
        }

        $("#venta_detalletransaccion").val($tarjeta);
        //alert($tarjeta);        
    
}

// verificarComunicacion -> obtenciond e codigos
function finalizarventa_sin(){
    
    
    
    var boton_presionado = document.getElementById('boton_presionado').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/verificarcomunicacion';
    var parametro_tipoemision = document.getElementById('elparametro_tipoemision').value;
    var parametro_tiposistema = document.getElementById('parametro_tiposistema').value;
    var parametro_verificarconexion = document.getElementById('parametro_verificarconexion').value;
    var cliente_valido = document.getElementById('cliente_valido').value;
    var excepcion = document.getElementById('cliente_valido').value;    
    var nit = $.trim(document.getElementById('nit').value);
    var razon_social = $.trim(document.getElementById('razon_social').value);
    var facturado = document.getElementById('facturado').checked;
    var venta_glosa = document.getElementById('venta_glosa').value;
    var forma_pago = document.getElementById('forma_pago').value;
    var venta_detalletransaccion = document.getElementById('venta_detalletransaccion').value;
    var cad = "ABC";
        cad = venta_detalletransaccion.toString();
    var tam = cad.length;
    var forma_id = document.getElementById('forma_pago').value;
    var venta_cambio = document.getElementById('venta_cambio').value;
    
    
    if (boton_presionado == 0){ //Si el boton no esta presionado
        
        $("#boton_presionado").val(1); // 1 - Boton presionado
        
        if(Number(venta_cambio)>=0){

                if(parametro_tiposistema == 1){ //facturacion computarizada SFV

                    finalizarventa();

                }else{ 

                    // facturacioon computarizada o electronica en linea
                if (nit == 0 ) cliente_valido = 0;


                if($('#codigoexcepcion').is(':checked'))
                {    cliente_excepcion = 1; }
                else
                {    cliente_excepcion = 0; }    


                //alert(parametro_tipoemision);

                if(forma_id==2 || forma_id==10 || forma_id==16 || forma_id==17 || forma_id==18 || forma_id==19 || forma_id==20 || forma_id==39 || forma_id==40 || forma_id==41 || forma_id==42 || forma_id==43 || forma_id==82 || forma_id==83 || forma_id==84 || forma_id==85 || forma_id==86 || forma_id==87 || forma_id==88 || forma_id==89 || forma_id==134 || forma_id==135 || forma_id==136 || forma_id==137 || forma_id==138 || forma_id==139 || forma_id==140 || forma_id==141 || forma_id==142 || forma_id==143 || forma_id==144 || forma_id==145 || forma_id==146 || forma_id==147 || forma_id==148 || forma_id==149 || forma_id==150 || forma_id==151 || forma_id==152 || forma_id==153 || forma_id==154 || forma_id==155 || forma_id==156 || forma_id==157 || forma_id==158 || forma_id==159 || forma_id==160 || forma_id==161 || forma_id==162 || forma_id==163 || forma_id==164 || forma_id==165 || forma_id==166 || forma_id==167 || forma_id==168 || forma_id==169 || forma_id==170 || forma_id==171 || forma_id==172 || forma_id==173 || forma_id==174 || forma_id==175 || forma_id==176 || forma_id==177 || forma_id==297){

                    var numero_tarjeta = "";       
                    numero_tarjeta =  document.getElementById('venta_detalletransaccion').value;

                    if (numero_tarjeta.length >= 16){
                        todobien = true;
                    }else{
                        $("#cancelar_venta").click();
                        todobien = false;
                        alert("ADVERTENCIA: Número de tarjeta de debito/credito invalida...!");
                        process.exit();
                    }

                }

                        if ($('#facturado').is(':checked')){

                            let docsec_codigoc = document.getElementById('docsec_codigoclasificador').value;
                            let venta_total = document.getElementById('venta_total').value;

                                if (docsec_codigoc==2){

                                   if (venta_glosa == ""){
                                       alert("ADVERTENCIA: El Campo PERIODO, no puede estar vacio...! \n Vuelva a intentar.");
                                       process.exit();   
                                   }

                                }

                                document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
                                document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader


                            let detallebolsa = 0;
                            if(docsec_codigoc == 23){
                                //devuelve la cantidad de items que exste en la parte derecha de ventas
                                detallebolsa = existen_bolsa();
                            }

                            if(docsec_codigoc == 23 && detallebolsa == 0){
                                alert("ADVERTENCIA: Para prevaloradas solo se admite un item!.");
                                location.reload();
                            }else if(docsec_codigoc == 23 && venta_total > 1000){
                                alert("ADVERTENCIA: El monto total debe ser menor o igual a mil para tipo PREVALORADAS");
                                location.reload();
                            }else{

                                if(parametro_tipoemision == 1){ // Si el tipo de emision es en linea


                                    if(navigator.onLine){ //si esta el linea
                                        let cantidad_facturas = document.getElementById('cantidad_facturas').value;

                                        if((docsec_codigoc == 23 && cantidad_facturas >0) || (docsec_codigoc != 23 && nit != 0)){ //Prevalorada
                                            cliente_valido = 1;

                                        if ((cliente_valido == 0 && cliente_excepcion == 1) || (cliente_valido == 1)){

                                            if(razon_social!=''){
                                                //alert(forma_pago+" * "+tam+" = "+ (tam == 16));

                                                if(((Number(forma_pago) == 2) && (Number(tam) == 16)) || (forma_pago!=2)){ //(forma_pago==2 && venta_detalletransaccion.lenght == 16)||(forma_pago<>2)

                                                    //alert("entra aqui: "+forma_pago+" * "+cad);
                                                    //*********************************************************************
                                                    
                                                        if(parametro_verificarconexion==1){
                                                            
                                                            //alert("Con verificar conexion");
                                                            $.ajax({url:controlador, //Verificar si existe comunicacion con impuestos
                                                                    type:"POST",
                                                                    data:{},
                                                                    success:function(respuesta){
                                                                        let registros = JSON.parse(respuesta);

                                                                        //alert(JSON.stringify(registros));
                                                                        //alert(registros.RespuestaComunicacion.transaccion);
                                                                        if(registros.RespuestaComunicacion.transaccion == true){ //Si existe comunicacion con impuestos

                                                                            //Finalizamos venta normalmente
                                                                            finalizarventa();


                                                                        }else{

                                                                            //debe registrar como fuera de linea
                                                                            alert("ADVERTENCIA: Se detecto una falla en la conexion al servicio de impuestos nacionales, se cambiara a emision fuera de linea...!");
                                                                            modal_cambiartipoemision()
                                                                            document.getElementById("elparametro_tipoemision").value = 2;
                                                                            document.getElementById("select_eventos").value = 2;
                                                                            $("#boton_tipoemision").click();

                                                                        }

                                                                    },
                                                                    error:function(respuesta){
                                                                        alert("Error: Conexión fallida. Vuelva a intentar...!");
                                                                    }
                                                                });  
                                                        }else{
                                                            //alert("Sin verificar conexion");
                                                            finalizarventa();                                                            
                                                        }
                                                            
                                                        //*********************************************************************


                                                    }//if((forma_pago==2 && venta_detalletransaccion.length==16)||(forma_pago<>2)){
                                                    else{                                    
                                                            document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
                                                            document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader
                                                            alert("ADVERTENCIA: No registro correctamente el número de tarjeta de debito/credito...!!"); 
                                                        }


                                                }//if (razon_social<>'')
                                                else{

                                                        document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
                                                        document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader
                                                        $("#boton_presionado").val(0); // 1 - Boton presionado
                                                        alert("ADVERTENCIA: Los datos del cliente NO SON VALIDOS.!");

                                                        $("nit").focus();
                                                        $("nit").select();

                                                }

                                            } //fin cliente_valido ==1
                                            else{ 
                                                    document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
                                                    document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader
                                                    alert("ADVERTENCIA: Los datos del cliente NO SON VALIDOS.!");

                                                    $("nit").focus();
                                                    $("nit").select();
                                                }
                                            }else{
                                                if (docsec_codigoc == 23){
                                                   alert("ADVERTENCIA: Cantidad de facturas debe ser mayor a 0 (CERO) para tipo PREVALORADAS");
                                               }else
                                                    alert("ADVERENCIA: El NIT es INVALIDO...!");

                                                document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
                                                document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader
                                            }
                                        }else{
                                                //se debe registrar como fuera de linea
                                                alert("ADVERTENCIA: Se detecto una falla en la conexion a internet, se cambiara a emision fuera de linea...!");
                                                modal_cambiartipoemision()
                                                document.getElementById("elparametro_tipoemision").value = 2;
                                                document.getElementById("select_eventos").value = 1;
                                                $("#boton_tipoemision").click();

                                        }

                                    }else{


                                        //alert("ADVERTENCIA: Se detecto una falla en la conexion a internet, se cambiara a emision fuera de linea...!");
                                        finalizarventa();

                                    }
                                }

                        }else{

                            finalizarventa();
                        }
                }
        }else{
            $("#boton_presionado").val(0);
            alert("ADVERTENCIA: El efectivo no puede ser menor al cambio...!");
            
            $("#cobradoy").select();
            $("#cobradoy").focus();
            
        }
    }else{
        console.log("Finalizar venta");
    }
    
}
/*
function cambiar_emision(emision)

    var base_url = document.getElementById('base_url').value;
    
    var parametro_id = document.getElementById('elparametro_id').value;
    var punto_venta = emision;//document.getElementById('punto_venta').value;
    var parametro_tipoemision = document.getElementById('elparametro_tipoemision').value;
    var controlador = base_url+'parametro/cambiar_tipoemision';
    var select_eventos = document.getElementById('select_eventos').value;
    var select = document.getElementById('select_eventos'), //El <select>
        //value = select.value, //El valor seleccionado
        select_texto = select.options[select.selectedIndex].innerText; //El texto de la opción seleccionada
    
    //alert(text);
    
    document.getElementById('loader_emision').style.display = 'block'; //muestra el bloque del loader

    $.ajax({url: controlador,
            type:"POST",
            data:{parametro_tipoemision:parametro_tipoemision, parametro_id:parametro_id, select_eventos: select_eventos, select_texto: select_texto},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                $("#modal_tipoemision").modal("hide");
               
               
                    alert(JSON.stringify(registros));
                    location.reload();
                
//                if(parametro_tipoemision == 1){
//                    
//                    var mensaje;                    
//                    var opcion = confirm("ADVERTENCIA: Debe actualizar el CUFD, continuar?");
//                    
//                    if (opcion == true) {
//                        
//                        
//                        //solicitudCufd(punto_venta);                      
//                    }
//                  document.getElementById("ejemplo").innerHTML = mensaje;
//                }
                
                //document.getElementById('loader_documento').style.display = 'none';
                
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
               document.getElementById('loader_documento').style.display = 'none';
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader_documento').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
    
}*/

function sleep(milliseconds) {
 var start = new Date().getTime();
 for (var i = 0; i < 1e7; i++) {
  if ((new Date().getTime() - start) > milliseconds) {
   break;
  }
 }
}


function simular_evento(){

    var base_url = document.getElementById('base_url').value;    
    var controlador = base_url+'venta/simular_evento';
    var parametro_id = document.getElementById('elparametro_id').value;
    
        
//    var punto_venta = emision;//document.getElementById('punto_venta').value;
//    var parametro_tipoemision = document.getElementById('elparametro_tipoemision').value;
//    var select_eventos = document.getElementById('select_eventos').value;
//    var select = document.getElementById('select_eventos'), //El <select>
//        //value = select.value, //El valor seleccionado
//    select_texto = select.options[select.selectedIndex].innerText; //El texto de la opción seleccionada
//    
//    //alert(text);
//    
//    document.getElementById('loader_emision').style.display = 'block'; //muestra el bloque del loader
//
    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                
                var registros =  JSON.parse(respuesta);
                
                //alert(JSON.stringify(registros));
                var evento = registros[0]["simulacion_evento"];
                var tipo_emision = registros[0]["simulacion_tipoemision"];
                var mensaje_evento = "";
                var mensaje_emision = "";
                
                if (tipo_emision == 1) mensaje_emision = " EN LINEA";
                else mensaje_emision = " FUERA DE LINEA";

                if (evento == 1) mensaje_evento = "ADVERTENCIA: Problema con el servicio de internet,\n el sistema pasara a modalidad "+mensaje_emision;
                if (evento == 2) mensaje_evento = "ADVERTENCIA: Inaccesibilidad con el servicios de Impuetos Nacionales,\n el sistema pasara a modalidad "+mensaje_emision;
                if (evento == 3) mensaje_evento = "ADVERTENCIA: Ingreso a zona sin internet por despliegue de punto de ventas,\n el sistema pasara a modalidad "+mensaje_emision;
                   
                //Cambiar los valores de los select
                
                $("#elparametro_tipoemision").val(tipo_emision);
                $("#select_eventos").val(evento);
              
                alert(mensaje_evento);
                $("#boton_tipoemision").click();
                
                
                
            },
    });
    
//    modal_cambiartipoemision()
    //document.getElementById('boton_tipoemision').click(); //muestra el bloque del loader
    //document.getElementById('loader_emision').style.display = 'block'; //muestra el bloque del loader
    //sleep(2000);
    //$("#modal_tipoemision").modal("hide");
    
}

/** cuando el tipo de documento sector es prevalorada(23)
 *  esta funcion verifica si hay en el auxiliar(parte derecha)
 *  mas de un item (producto)
 *  */
function existen_bolsa(){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'venta/verificaritem_endetalle';
    let res = 0;
    
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        async: false, 
        success:function(respuesta){
            let registro =  JSON.parse(respuesta);
            if(registro == "ok"){
                res = 1;
            }else{
                res = 0;
            }
        },
        error:function(respuesta){
            res = 0;
        }
    });     
    return res;
    
}

function buscar_placa(e){    
    
    let base_url = document.getElementById('base_url').value;
    let numeroplaca = document.getElementById('datos_placa').value;
    let controlador = base_url+'venta/buscar_placa';    
    var tecla = (document.all) ? e.keyCode : e.which;
    var res = 0;
    
    if (tecla==13){
    
    

            $.ajax({url: controlador,
                type:"POST",
                data:{numeroplaca:numeroplaca},
                //async: false, 
                success:function(respuesta){
                    
                    let registro =  JSON.parse(respuesta);
                    
                    if(registro.length>0){

                        $("#datos_embase").val(registro[0]["datos_embase"]);
                        $("#datos_codigopais").val(registro[0]["datos_codigopais"]);
                        $("#datos_autorizacionsc").val(registro[0]["datos_autorizacionsc"]);
                        $("#datos_placa").val(registro[0]["datos_placa"]);
                        $("#nit").val(registro[0]["cliente_nit"]);
                        validar(13,1);
                        
                        
                        
                    }else{

                        $("#datos_embase").val("");
                        $("#datos_codigopais").val("");
                        $("#datos_autorizacionsc").val("");
//                        $("#datos_placa").val("");

                        //Eliminar datos del cliente
                        $("#razon_social").val(razon_social);
                        $("#cliente_nombre").val(razon_social);
                        $("#cliente_codigo").val(nit);                            
                        $("#email").val("");
                        
                        var nit = "1234";
                        var razon_social = "SIN NOMBRE";
                        var cliente_id = "1";                        
                        
                        $("#nit").val(nit);
                        $("#cliente_id").val(cliente_id);
                        $("#cliente_ci").val(nit);
                        $("#cliente_nombrenegocio").val("-");

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
                        $("#venta_descuentoparc").val("0");
                        $("#venta_descuento").val("0");
                        $("#preferencia_id").val("0");
                        $("#cliente_complementoci").val("");
                        $("#venta_ice").val("0.00");
                        $("#venta_detalletransaccion").val("0");
                        $("#venta_giftcard").val("0.00");
                        $("#tipo_doc_identidad").val("5");
                        $("#cliente_valido").val("1");
                        document.getElementById("codigoexcepcion").checked = false;



                        $("#razon_social").css("background-color", "gray");
                        $("#razon_social").attr("readonly","readonly");                        
                        
                        
                    }
                    
                    
//                    alert(registro.length);
//                    if(registro == "ok"){
//                        res = 1;
//                    }else{
//                        res = 0;
//                    }
                    
                },
                error:function(respuesta){
                    res = 0;
                }
            });     
            return res;
            
    }
}

function anular_venta(venta_id, factura_id = null, factura_enviada=null){
    
    let base_url = document.getElementById('base_url').value;
    let tiene_factura = document.getElementById("anular_factura"+venta_id).value; 
    
    if(tiene_factura == 1){
        let anular_factura = document.getElementById("anular_factura"+venta_id).checked;
        if(anular_factura == true){
            let controlador = "";
            if(factura_enviada == 1){ // es factura valida y debe anularse desde impuestos. Esta funcion lo usa desde factura(anulacion)
                controlador = base_url+'factura/anular_factura/'+factura_id+"/"+venta_id;
                let motivo_id = 1;
                let factura_correo = "";
                let borrar_venta = 1;
                $.ajax({url:controlador,
                    type:"POST",
                    data:{motivo_id: motivo_id, factura_correo:factura_correo, borrar_venta:borrar_venta},
                    success:function(result){
                        res = JSON.parse(result);
                        alert(JSON.stringify(res));
                        location.reload();
                    },
                });
            }else{ // es factura no valida y se debe anular en local. . Esta funcion lo usa desde factura(anulacion)
                controlador = base_url+'factura/anular_factura_malemitida/'+factura_id+"/"+venta_id;
                $.ajax({url:controlador,
                    type:"POST",
                    data:{},
                    success:function(result){
                        res = JSON.parse(result);
                        alert("Anulacion exitosa!.");
                        location.reload();
                    },
                });
            }
        }else{
            location.href = base_url+"venta/anular_venta/"+venta_id;
        }
    }else{
        location.href = base_url+"venta/anular_venta/"+venta_id;
    }
}

function seleccionar_categoria(categoria_id){
//    
    //alert(categoria_id);
    $("#categoria_prod").val(categoria_id);
    tablaresultados(2);
       
}

function transcribir_glosa(e){
    tecla = (document.all) ? e.keyCode : e.which; 
    var glosay = document.getElementById("glosay").value;
    //var cobrado = document.getElementById("cobradoy").value;
   // alert(glosay+" : "+cobrado);
   
    $("#venta_glosa").val(glosay);
    
    if(tecla == 13){
        $("#cobradoy").select();
        $("#cobradoy").focus();
        
    }
    
    

}

function transcribir(){
        
    //var glosay = document.getElementById("glosay").value;
    var cobrado = document.getElementById("cobradoy").value;
   // alert(glosay+" : "+cobrado);
   
        //$("#venta_glosa").val(glosay);
        $("#venta_efectivo").val(cobrado);
       calcularcambio(event);
   
}


function seleccionar_documento(id){
    
    var boton = document.getElementById("documento"+id);
    boton.style = "color: white";
    boton.style.backgroundColor = "#f39c12"; //
    //boton.style.borderColor = "#f8f9fa"; //
   
    
    for(i = 1; i<=5; i++){
        
        if (i != id){
            try{
                let boton2 = document.getElementById("documento"+i);
                boton2.style = "color: black";
                boton2.style.backgroundColor = "#f8f9fa";    
            }catch(error){
                
            }
        }
        
    }
    
    $("#tipo_doc_identidad").val(id);
    $("#nit").select();
    $("#nit").focus();
 
}

function seleccionar_servicio(id){
    
    try{

        var boton = document.getElementById("servicio"+id);
        boton.style = "color: white";
        boton.style.backgroundColor = "#f39c12"; //
        //boton.style.borderColor = "#f8f9fa"; //


        for(i = 1; i<=5; i++){

            if (i != id){
                try{
                    let boton2 = document.getElementById("servicio"+i);
                    boton2.style = "color: black";
                    boton2.style.backgroundColor = "#f8f9fa";    
                }catch(error){

                }
            }

        }

        $("#tiposerv_id").val(id);
        $("#glosay").select();
        $("#glosay").focus();

        
    }catch (error) {
        
    }
}
//
//function seleccionar_documento(id){
//    
//    var boton = document.getElementById("documento"+id);
//    boton.style.backgroundColor = "#ffc107";
//    
//    for(i = 1; i<=5; i++){
//        
//        if (i != id){
//            try{
//                let boton2 = document.getElementById("documento"+i);
//                boton2.style.backgroundColor = "#f8f9fa";    
//            }catch(error){
//                
//            }
//        }
//        
//    }
//    
//}


function numberFormat(numero){
        // Variable que contendra el resultado final
        var resultado = "";
 
        // Si el numero empieza por el valor "-" (numero negativo)
        if(numero[0]=="-")
        {
            // Cogemos el numero eliminando los posibles puntos que tenga, y sin
            // el signo negativo
            nuevoNumero=numero.replace(/\,/g,'').substring(1);
        }else{
            // Cogemos el numero eliminando los posibles puntos que tenga
            nuevoNumero=numero.replace(/\,/g,'');
        }
 
        // Si tiene decimales, se los quitamos al numero
        if(numero.indexOf(".")>=0)
            nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf("."));
 
        // Ponemos un punto cada 3 caracteres
        for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
            resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;
 
        // Si tiene decimales, se lo añadimos al numero una vez forateado con 
        // los separadores de miles
        if(numero.indexOf(".")>=0)
            resultado+=numero.substring(numero.indexOf("."));
 
        if(numero[0]=="-")
        {
            // Devolvemos el valor añadiendo al inicio el signo negativo
            return "-"+resultado;
        }else{
            return resultado;
        }
    }
    
    
function buscar_factura(e) {
  
    var tecla = (document.all) ? e.keyCode : e.which;
    var decimales = Number(document.getElementById('parametro_decimales').value);    
       
    if (tecla == 13){
       
        let base_url = document.getElementById('base_url').value;
        let parametro_factura = document.getElementById('parametro_facturabuscar').value;
        let controlador = base_url+'venta/buscar_factura';
        let res = 0;
        //alert(parametro_factura)
        
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro_factura:parametro_factura},
            success:function(respuesta){
                
                let registro =  JSON.parse(respuesta);
                let tam =  registro.length;
                let html =  "";
                    
                for(let i=0; i<tam; i++){
                    
                     html += "<tr>";
                     html += "<td>"+(i+1)+"</td>";
                     html += "<td>"+registro[i]["factura_nit"]+"</td>";
                     html += "<td>"+registro[i]["factura_razonsocial"]+"</td>";
                     html += "<td>"+registro[i]["factura_fecha"]+"</td>";
                     html += "<td>"+registro[i]["factura_numero"]+"</td>";
                     html += "<td>"+Number(registro[i]["factura_total"]).toFixed(decimales)+"</td>";                     
                     html += "<td>"+registro[i]["factura_codigodescripcion"]+"</td>";
                     html += "<td><button class='btn btn-xs btn-info' onclick='seleccionar_factura("+registro[i]["factura_id"]+")'><fa class='fa fa-floppy-o' ></fa> Seleccionar</td>";
                     html += "</tr>";
                     html += "<tr><td colspan=8><b>CUF: </b>"+registro[i]["factura_cuf"]+"</td></tr>";
                }
                
                $("#facturas_encontradas").html(html);

                //alert( registro.length );
                
            },
            error:function(respuesta){
                res = 0;
            }
        });     
        return res;
    }
}

function procesarCodigoBarras(codigo) {
    
    // Dividir el código en sus componentes
    var verificador = codigo.substring(0,3);
    var codigoProducto = codigo.substring(0,7);
    var cantidad = codigo.substring(7,codigo.length);
    //alert("cantidad: "+cantidad);
   ///alert("verficador:"+verificador+" * codigo: "+codigoProducto+"* cantidad: "+cantidad);

    return {
        verificador: verificador,
        codigoProducto: codigoProducto,
        cantidad: cantidad
    };
    
}

function guardar_venta_temporal(){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'venta/guardar_venta_temporal';
    let nombre_venta = document.getElementById('nombre_venta').value;
    
    
    if(nombre_venta!=''&&nombre_venta.length>2){

            $.ajax({url: controlador,
                type:"POST",
                data:{nombre_venta:nombre_venta},
                async: false, 
                success:function(respuesta){

                    let registro =  JSON.parse(respuesta);

                        tablaproductos();
                        mostras_ventas_guardadas();
                        $("#nombre_venta").val("");

                },
                error:function(respuesta){
                    res = 0;
                }
            });     
        
    }else{
        alert("Debe registrar un nombre correcto..!!");
    }
    

    
}

//Dibuja los botones de las ventas guardadas
function mostras_ventas_guardadas(){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'venta/get_ventas_guardadas';


            $.ajax({url: controlador,
                type:"POST",
                data:{},
                async: false, 
                success:function(respuesta){

                    let vg =  JSON.parse(respuesta);
                    let html =  "";
                    for(var i=0; i<vg.length;i++){
             
                        html += "<button class='btn btn-warning btn-xs' onclick='cargar_venta("+JSON.stringify(vg[i]["codigo_venta"])+")' title='"+vg[i]["codigo_venta"]+" "+vg[i]["nombre_venta"]+"'><fa class='fa fa-cart-arrow-down'></fa> <br>"+Number(vg[i]["totalbs"]).toFixed(2)+"<br>"+"</button>";
                        
                    }
                    
                    $("#div_ventas_guardadas").html(html);
                    

                },
                error:function(respuesta){
                    res = 0;
                }
            });     

    
}


function cargar_venta(codigo){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'venta/mostrar_ventas_guardadas';



            var r = confirm("ADVERTENCIA: Esta operación eliminara la operacion de venta actual. \n ¿Desea Continuar?");

            if (r == true) {


                    $.ajax({url: controlador,
                        type:"POST",
                        data:{codigo:codigo},
                        async: false, 
                        success:function(respuesta){

                           var preg = confirm("ADVERTENCIA: Desea eliminar la venta guardada. \n ");
                            
                            tablaproductos();
                            mostras_ventas_guardadas();
//                            if (preg == true) {  
//                                
//                                eliminar_productos(codigo);
//                                
//                            }
                        },
                        error:function(respuesta){
                            res = 0;
                        }
                    });     
                                
            }else{                   
                
            }
            
}


function cliente_sinnombre(){
    
    $("#nit").val("1234");
    validar(13,1);
    document.getElementById('facturado').checked = false;
    $("#razon_social").val("SIN NOMBRE");
    $("#tipo_doc_identidad").val(1);
    seleccionar_documento(1);
    
}

function seleccionar_producto(producto_id, producto_nombre, producto_codigobarra){
    
    $("#miproducto_id").val(producto_id); 
    $("#miproducto_nombre").val(producto_nombre); 
    $("#miproducto_codigobarra").val(producto_codigobarra); 
    
    verificar_producto();
}

function entre_comillas(cadena) {
    return '"' + cadena + '"';
}

function verificar_producto(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/verificar_producto_cantidad';
    var sucursal_id = 0; //document.getElementById('sucursal_traspaso').value;
    var producto_id = document.getElementById('miproducto_id').value;
    var operacion = 0; //document.getElementById('operacion_traspaso').value;
    var html = "";
    
    //let confirmacion =  confirm('Esta seguro que quiere dar de alta a este Producto?');
    
    //if(confirmacion == true){
        document.getElementById('loader2').style.display = 'block'; //muestra el bloque del loader
    
        $.ajax({url:controlador,
            type:"POST",
            data:{sucursal_id:sucursal_id,producto_id:producto_id,operacion:operacion},
            success:function(result){
                
                res = JSON.parse(result);
                
                    html = "";
                    
                    html += "<table id='mitabla'>";
                    html += "<tr>";
                        html += "<th style='padding:3px;'>#</th>";
                        html += "<th style='padding:3px;'>SUCURSAL</th>";
                        html += "<th style='padding:3px;'>ID</th>";
//                        html += "<th style='padding:0px;'>PRODUCTO</th>";
                        html += "<th style='padding:3px;'>UNIDAD</th>";
                        html += "<th style='padding:3px;'>CODIGO</th>";
//                        html += "<th style='padding:0px;'>COSTO</th>";
                        html += "<th style='padding:3px;'>PRECIO</th>";
                        html += "<th style='padding:3px;'>CANT.</th>";
                        //html += "<th style='padding:3px;'></th>";
                        //html += "<th style='padding:0px;'>CANT</th>";
                    html += "</tr>";
                    
                    let cantidad_total = 0;
                for (let i = 0; i < res.length; i++) {
                    const subarreglo = res[i];

                    for (let j = 0; j < subarreglo.length; j++) {
                      const objeto = subarreglo[j];

                      //alert(objeto.producto_nombre); // Ejemplo: Imprimir el nombre del producto
                      
                        html += "<tr>"

                            html += "<td style='padding:0px;'>"+(i+1)+"</td>";
                            html += "<td style='padding:0px;'><span class='btn btn-warning btn-xs' style='padding:0;'>"+objeto.empresa_nombresucursal+"</span>"; //+"<br>"+objeto.almacen_basedatos+"</td>";
                            html += "<br><b style='font-size: 12px;'>"+objeto.producto_nombre+"</b>";
                            html += "</td>";
                            
                            html += "<td style='padding:0px; text-align: center;'>"+objeto.producto_id+"</td>"
                            html += "<td style='padding:0px; text-align: center;'>"+objeto.producto_unidad+"</td>"
                            html += "<td style='padding:0px; text-align: center;'>"+objeto.producto_codigobarra+"</td>"
//                            html += "<td style='padding:0px; text-align:right;'>"+Number(objeto.producto_costo).toFixed(2)+"</td>"
                            html += "<td style='padding:0px; text-align:right;'>"+Number(objeto.producto_precio).toFixed(2)+"</td>"
                            html += "<td style='padding:0px; text-align:right; font-size:12px;'><b>"+Number(objeto.existencia).toFixed(2)+"</b></td>"
//                            html += "<td style='padding:0px;'>";
                            //html += "<button class='btn btn-facebook btn-xs' onclick='igualar_producto("+objeto.almacen_id+","+objeto.producto_id+")'><fa class='fa fa-tasks'></fa> IGUALAR</button>";
                            
//                            html += "</td>";
                            
                            
                           // html += "<td style='padding:0px;'>"+Number(objeto.existencia).toFixed(2)+"</td>"
                           cantidad_total += Number(objeto.existencia);
                        html += "<tr>"
                      
                    }
                }
                
                    html += "<tr>";
                        html += "<th style='padding:3px;' colspan='6'>CANTIDAD TOTAL</th>";
//                        html += "<th style='padding:3px;'></th>";
//                        html += "<th style='padding:3px;'></th>";
//                        html += "<th style='padding:0px;'>PRODUCTO</th>";
//                        html += "<th style='padding:3px;'></th>";
//                        html += "<th style='padding:3px;'></th>";
//                        html += "<th style='padding:0px;'>COSTO</th>";
//                        html += "<th style='padding:3px;'></th>";
                        html += "<th style='padding:3px; font-size: 14px;'>"+cantidad_total.toFixed(2)+"</th>";
                        //html += "<th style='padding:3px;'></th>";
                        //html += "<th style='padding:0px;'>CANT</th>";
                    html += "</tr>";
                
                    html += "</table>"
                    
                $("#tabla_resultadossuc").html(html);                
                
                document.getElementById('loader2').style.display = 'none'; //ocultar el bloque del loader
            },
        });
    //}
                document.getElementById('loader2').style.display = 'none'; //ocultar el bloque del loader
}



function borrar_datos_cliente(){
    
    var modulo_restaurante = document.getElementById("parametro_modulorestaurante").value;
    var parametro_imprimirfactura = document.getElementById("parametro_imprimirfactura").value;
    var parametro_imprimircomanda = document.getElementById("parametro_imprimircomanda").value; //0 no, 1 si
    var parametro_factura = document.getElementById("parametro_factura").value; //0 no, 1 si
    let documento_sector = document.getElementById("docsec_codigoclasificador").value;
    var base_url = document.getElementById('base_url').value;
    
    var nit = "1234";
    var razon_social = "SIN NOMBRE";
    var cliente_id = "1";

    
    seleccionar_documento(1); // CI
    seleccionar_servicio(1); // CI
    
    $("#razon_social").val(razon_social);
    $("#cliente_nombre").val(razon_social);
    $("#cliente_codigo").val(nit);
    
    
    $("#email").val("");
    
    if(documento_sector == 23){ // si es prevalorada
        
        $("#razon_social").val("S/N");
        $("#cliente_nombre").val("S/N");
        $("#cliente_codigo").val("N/A");
        
    }
    
    $("#nit").val(nit);
    $("#cliente_id").val(cliente_id);
    $("#cliente_ci").val(nit);
    $("#cliente_nombrenegocio").val("-");
    
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
    $("#venta_descuentoparc").val("0");
    $("#venta_descuento").val("0");
    $("#preferencia_id").val("0");
    $("#cliente_complementoci").val("");
    $("#venta_ice").val("0.00");
    $("#venta_detalletransaccion").val("0");
    $("#venta_giftcard").val("0.00");
    $("#tipo_doc_identidad").val("1");
    $("#cliente_valido").val("1");
    $("#glosay").val("");
    
    
    document.getElementById("codigoexcepcion").checked = false;

    
    $("#razon_social").css("background-color", "gray");
    $("#razon_social").attr("readonly","readonly");   
    
//    var codigo = document.getElementById("evento_contingencia").value; //0 no, 1 si
//    var num = document.getElementById("numfact_cafc").value; //0 no, 1 si
//    
//    if (codig>0){
//        $("#numfact_cafc").val(Num(num+1))
//    }
     
    //document.getElementById("codigoexcepcion").checked = false;
    document.getElementById("forma_pago").selectedIndex = 0
    document.getElementById("tipo_transaccion").selectedIndex = 0
    document.getElementById('creditooculto').style.display = 'none';
    
    try{
        
        document.getElementById('imagenqr').style.display = 'none';
    
    }
    catch (error){}
    
            
    //document.getElementById('creditooculto').style.display = 'none';
    
    $("#filtrar").focus();
    
    var facturado = document.getElementById('facturado').checked;  
    
    //alert("holaaaaaaaaaa");
    //Si esta activo el modulo para restaurante
//    if (modulo_restaurante == 1){
//        
//        if (parametro_imprimircomanda==1){
//            boton = document.getElementById("imprimir_comanda");
//            boton.click();
//        }
//        
//    }
    
   // if(parametro_imprimirfactura!=0){

        if(parametro_imprimirfactura==1){ // Imprimir solo factura
            
            let boton = document.getElementById("imprimir_factura");
            if (facturado == 1){ boton.click(); }
            /*else{
             window.open(base_url+'/factura/abrir_caja', '_blank');
            }*/
        }
            

        if(parametro_imprimirfactura==2){ // Imprimir solo recibo
            
            let boton = document.getElementById("imprimir");
            boton.click();                    
        }

        if(parametro_imprimirfactura==3){ // Imprimir factura y recibo
            
            let boton1 = document.getElementById("imprimir_factura");
            let boton2 = document.getElementById("imprimir");
            if (facturado == 1){ boton1.click(); }
            boton2.click();
        }

        if(parametro_imprimirfactura==4){ // Imprimir factura o recibo

            let boton1 = document.getElementById("imprimir_factura");
            let boton2 = document.getElementById("imprimir");

            if (facturado == 1){ boton1.click(); }
            else { boton2.click(); }
        }

        if(parametro_imprimirfactura==5){ // Imprimir solo comanda

            boton = document.getElementById("imprimir_comanda");
            boton.click();
            
        }
        
        if(parametro_imprimirfactura==6){ // Imprimir factura y comanda
            
            let boton1 = document.getElementById("imprimir_factura");
            let boton2 = document.getElementById("imprimir_comanda");
            if (facturado == 1){ boton1.click(); }
            boton2.click();
        }
        
        if(parametro_imprimirfactura==7){ // Imprimir factura, recibo y comanda
            
            let boton1 = document.getElementById("imprimir_factura");
            let boton = document.getElementById("imprimir");            
            let boton2 = document.getElementById("imprimir_comanda");
            
            if (facturado == 1){ boton1.click(); } //Imprimir factura
            boton.click(); //Imprimir recibo
            boton2.click(); //imprimir comanda
        }
        
        if(parametro_imprimirfactura==8){ // Imprimir factura o recibo y comanda
            
            let boton1 = document.getElementById("imprimir_factura");
            let boton = document.getElementById("imprimir");            
            let boton2 = document.getElementById("imprimir_comanda");
            
            if (facturado == 1){ boton1.click(); } //Imprimir factura
            else{ boton.click(); }//Imprimir recibo
            boton2.click(); //imprimir comanda
        }

    //}


    
    document.getElementById('boton_finalizar').style.display = 'block'; //mostrar el bloque del loader
    tablaproductos();
    
    tablaresultados(1); //redibuja la tabla de busqueda de productos      
    // var parametro_factura = document.getElementById('parametro_factura').value;
    // if(parametro_factura == 2){
    //     $("#facturado").prop("checked", false);
    // }
    document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
    document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader
    
    if(parametro_factura==2){
        document.getElementById('facturado').checked = false;
    }
    if(parametro_factura==4){
        document.getElementById('facturado').checked = true;
    }    
    
    //$("#span_buscar_cliente").click();   
    $("#boton_presionado").val(0);
    

    

}