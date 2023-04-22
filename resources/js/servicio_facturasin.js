/* Funciones para que ayude a generar factura desde el index de Servicios!. */

/* al seleccionar el documento, el cursor salta al Nit. */
function selecciono_el_documento(){
    
    $("#generar_nit").focus();
    $("#generar_nit").select();
}

//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function validar_laentradaserv(e,opcion) {
  
    var tecla = (document.all) ? e.keyCode : e.which;
    
    if (e==13){
        var tecla = e;
    }else{
        var tecla = (document.all) ? e.keyCode : e.which;
    }
    
    if (tecla==13){
        if (opcion==1){   //si la pulsacion proviene del nit  
            nit = $("#generar_nit").val();
            if (nit==''){
                    
                var cod = generar_codigoserv();
                //Si el nit es diferente de vacio

                $("#generar_nit").val(cod);
                $("#generar_razon").val("");
                $("#elemail").val("");
                $("#generar_razon").focus();
                $("#generar_razon").select();
                //$("#zona_id").val(0);                    

            }else{
                /*
                $("#razon_social").css("background-color", "#1221");
                $("#razon_social").removeAttr("readonly");
                */
                document.getElementById('codigoexcepcion').checked = false;
                buscar_a_losclientes();
            }
        }
        /*
        if (opcion==2){
            var codigo = document.getElementById('razon_social').value;
            
            codigo = codigo[0]+codigo[1] + Math.floor((Math.random()*100000)+50);
                    
            $("#cliente_nombre").val(document.getElementById('razon_social').value);
            $("#cliente_celular").val(''); //si la tecla proviene del input razon social
            $("#telefono").val(''); //si la tecla proviene del input razon social
            
            $("#cliente_codigo").val(codigo);
            document.getElementById('cliente_celular').focus();
            
        }*/
        /*
        if (opcion==3){   //si la tecla proviene del input codigo de barras          
            
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
        */
        if (opcion==9){   //si la tecla proviene del buscador de pedido abierto
            
           var nit = document.getElementById('generar_nit').value;
           if (nit=='0'){
                buscar_a_losclientes();
           }
           else{
               /*
                var codigo = document.getElementById('generar_razon').value;

                codigo = codigo[0]+codigo[1] + Math.floor((Math.random()*100000)+50);
                
                $("#cliente_nombre").val(document.getElementById('razon_social').value);
                $("#cliente_celular").val(''); //si la tecla proviene del input razon social
                $("#telefono").val(''); //si la tecla proviene del input razon social

                $("#cliente_codigo").val(codigo);
                document.getElementById('cliente_celular').focus();
                */
           }
        }
        
        /*
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
         */       
    }
    /*
    if (opcion==7){   //si la tecla proviene del buscador de pedido abierto
       //document.getElementById('filtrar').focus();
       seleccionar_tipocliente();
    }    
    */
 
}

//Selecciona un campo!..
function seleccionar_uncamposerv(opcion) {
    
        if (opcion==1){
            document.getElementById('generar_nit').select();
        }
        
        if (opcion==2){
            document.getElementById('generar_razon').select();
        }
        /*
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
        }*/
}

function generar_codigoserv(){
    var hoy = new Date();       
    var dd = hoy.getDate().toString();
    var mm = hoy.getMonth()+1;
    var yyyy = hoy.getYear().toString();
    var hh = hoy.getHours().toString();
    var nn = hoy.getMinutes().toString();
    var ss = hoy.getSeconds().toString();
    dd = addZero(dd);
    mm = addZero(mm);
    return yyyy+mm+dd+hh+nn+ss;
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

function buscar_a_losclientes(){

    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('generar_nit').value;
    var parametro_factura = document.getElementById('parametro_factura').value;
    
    if (nit==''){ //Si el campo Nit esta vacio, genera NIT/Codigo automaticamente
        var cod = generar_codigo();
        $("#generar_nit").val(cod);
        $("#generar_razon").focus();
        $("#generar_razon").select();
        //$("#zona_id").val(0);
    }
        
    //Alistamos controlador para buscar al cliente
    var controlador = base_url+'venta/buscarcliente';
    document.getElementById('loader_generarfactura').style.display = 'block';
    
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            success:function(respuesta){
                //Respuesta de la busqueda
                var registros = eval(respuesta);
                              
                //Si el cliente ya esta registrado  en el sistema carga los datos
                if (registros[0]!=null){ 
                    
                    $("#generar_razon").val(registros[0]["cliente_razon"]);
                    /*document.getElementById('telefono').focus();
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
                    */
                    $("#elemail").val(registros[0]["cliente_email"]);
                    /*$("#tipocliente_id").val(1);
                    $("#tipocliente_porcdesc").val(0);
                    $("#tipocliente_montodesc").val(0);
                    */
                    //$("#doc_identidad").val(registros[0]["cdi_codigoclasificador"]);
                    //$("#cliente_valido").val(1);
                    
                                                        
                    document.getElementById("codigoexcepcion").checked = (registros[0]["cliente_excepcion"] == 1); 
                    
                    /*if (registros[0]["tipocliente_id"] != null && registros[0]["tipocliente_id"] >=0)
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
                    
                    }*/
                    /*else //si no tiene asignado ningun tipo, le asignara el tipo 1 por defecto
                    {    $("#tipocliente_id").val(1); }
                        
                    if(registros[0]["zona_id"] != null && registros[0]["zona_id"] >=0){
                        $("#zona_id").val(registros[0]["zona_id"]);
                    }else{
                        $("#zona_id").val(0);
                    }
                    */
                    document.getElementById('loader_generarfactura').style.display = 'none';
                    
                   $("#generar_razon").focus();
                }
                else //Si el cliente es nuevo o no existe
                {
                    
                    //$("#razon_social").val('SIN NOMBRECILLO');
                    document.getElementById('generar_razon').focus();
                    $("#generar_razon").val("");
                    /*$("#cliente_id").val(0);
                    $("#cliente_nombre").val("-");
                    $("#cliente_ci").val(nit);
                    $("#cliente_nombrenegocio").val("-");
                    $("#cliente_codigo").val("-");
                    
                    $("#telefono").val("");
                    $("#cliente_nombre").val("");
                    $("#cliente_direccion").val("-");
                    $("#cliente_departamento").val("-");
                    $("#cliente_celular").val("");
                    */
                    $("#elemail").val("");
                    /*$("#zona_id").val(0);
                    $("#tipocliente_id").val(1);
                    $("#venta_descuento").val(0);
                    */
                    let tipo_sistema = document.getElementById('parametro_tiposistema').value;
                    //let dosificacion_modalidad = document.getElementById('dosificacion_modalidad').value;
                    //let parametro_tipoemision = document.getElementById('parametro_tipoemision').value;
                    
                    if(tipo_sistema != 1){ //1 =SFV /2=elec en linea 3=comp. en linea
                            //alert(dosificacion_modalidad);
                            
                        //if (dosificacion_modalidad == 1){ //modalidad 1= Elec.Enlinea 2=computarizada en linea
                        //if (parametro_tipoemision == 1){ //tipoemision 1 = En linea 2 = Fuera de linea
                        
                            let result = verificar_laconexion_enindexventas();
                            let res = result;
                            //alert(res);
                            if(res){ //Si existe conexion
                                
                                let tipo_doc_identidad = base_url = document.getElementById('doc_identidad').value;
                                
                                    if(tipo_doc_identidad == 5){

                                        if (parametro_factura != 3){ // (NO ES) 3 Sin Factura
                                                verificar_elnit();
                                    }else{
                                            document.getElementById('loader_generarfactura').style.display = 'none';
                                    }
                                    
                                }else{
                                    document.getElementById('loader_generarfactura').style.display = 'none';
                                }
                                
                            }else{
                                alert("No hay comunicación con Impuestos");
                                document.getElementById('loader_generarfactura').style.display = 'none';
                            }
                        
                        /*}else{ // Si es computarizado o electronica en linea
                                document.getElementById('loader_generarfactura').style.display = 'none';
                                $('#razon_social').focus();
                                //verificarnit();
                                //$('#razon_social').select();
                        }*/
                    }else{
                        document.getElementById('loader_generarfactura').style.display = 'none';
                        $('#razon_social').focus();
                    }                    
                }
                //document.getElementById('loader_generarfactura').style.display = 'none';
            },
            error:function(respuesta){			
                $("#razon_social").val('SIN NOMBRE');
                document.getElementById('telefono').focus();
                
                $("#cliente_id").val(0);
                document.getElementById('loader_generarfactura').style.display = 'none';   
            }                
    }); 

}

/* verifica si el nit/ci es correcto */
function verificar_laconexion_enindexventas(){
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

/* verifica si el nit/ci es correcto */
function verificar_elnit(){
    
    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('generar_nit').value;
    var controlador = base_url+'dosificacion/verificarNit';

    document.getElementById('loader_generarfactura').style.display = 'block';    
    
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
                document.getElementById('loader_generarfactura').style.display = 'none';
            },
            error:function(respuesta){
                alert("Algo salio mal; por favor verificar sus datos!.");
                document.getElementById('loader_generarfactura').style.display = 'none';
            }                
    }); 

}

function seleccionar_alcliente(){
    
    var cliente_id = document.getElementById('generar_razon').value;
    var nit = document.getElementById('generar_nit').value;
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
                    //$("#cliente_id").val(resultado[0]["cliente_id"]);
                    $("#generar_nit").val(resultado[0]["cliente_nit"]);
                    $("#generar_razon").val(resultado[0]["cliente_razon"]);
                    /*$("#telefono").val(resultado[0]["cliente_telefono"]);
                    $("#cliente_nombre").val(resultado[0]["cliente_nombre"]);
                    $("#cliente_ci").val(resultado[0]["cliente_ci"]);     
                    $("#cliente_complementoci").val(resultado[0]["cliente_complementoci"]);
                    $("#cliente_nombrenegocio").val(resultado[0]["cliente_nombrenegocio"]);
                    $("#cliente_codigo").val(resultado[0]["cliente_codigo"]);  
                    $("#tipocliente_id").val(resultado[0]["tipocliente_id"]);  
                    $("#cliente_direccion").val(resultado[0]["cliente_direccion"]);
                    $("#cliente_departamento").val(resultado[0]["cliente_departamento"]);
                    $("#cliente_celular").val(resultado[0]["cliente_celular"]);
                    */
                    $("#elemail").val(resultado[0]["cliente_email"]);
                    /*$("#tipo_doc_identidad").val(resultado[0]["cdi_codigoclasificador"]);
                    $("#tipocliente_porcdesc").val(resultado[0]["tipocliente_porcdesc"]);
                    $("#tipocliente_montodesc").val(resultado[0]["tipocliente_montodesc"]);
                    */
                    //alert(resultado[0]["cdi_codigoclasificador"]);
                    /*
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
                    */
                    /*
                    if(resultado[0]["zona_id"] != null && Number(resultado[0]["zona_id"]) >=0){
                        $("#zona_id").val(resultado[0]["zona_id"]);
                    }else{
                        $("#zona_id").val(0);
                    }
                    
                    $("#codigo").select();
                    */
                }
       

            },
            error: function(respuesta){
            }
        });    
    
}

















function cargar_lafactura(factura){
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
                    cargar_lafactura2(venta_id);
                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}

function cargar_lafactura2(venta_id){
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