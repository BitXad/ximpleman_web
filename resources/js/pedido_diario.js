
function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function formato_numerico(numero){
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


function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function buscar_pedido_diario(opcion)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido_diario/buscar_pedidos";
    var select_fecha =   document.getElementById('select_fecha').value;
    var calendario =   document.getElementById('calendario').value;
    
    if(Number(select_fecha)<=3 || opcion==2){
    
        if (Number(select_fecha)<=3){
             document.getElementById('div_fecha').style = "display:none;";
        }
        
        $.ajax({url:controlador,
            type:"POST",
            data:{select_fecha:select_fecha,calendario:calendario,opcion:opcion},
            success: function(response){

                var r = JSON.parse(response);
                //alert(r.length);

                var cont = 0; 
                var total_dia = 0;
                var tipobar = "";   
                var html = "";
                var nombre_proveedor = '';
                var tam = r.length;

                //alert(tam);

                for (i = 0; i<tam; i++){

                    total_dia = total_dia + Number(r[i]['pedido_montototal']);
                    pedido_montototal = r[i]['pedido_montototal'];

                    cont++;
                    if(cont % 1 == 0){ tipobar = 'danger'; color='red';}
                    if(cont % 2 == 0){ tipobar = 'info';  color='light-blue';}
                    if(cont % 3 == 0){ tipobar = 'success'; color='green';}
                    if(cont % 4 == 0){ tipobar = 'warning'; color='yellow';}
                    if(cont % 5 == 0){ tipobar = 'facebook'; color='blue';}


                    html += "<tr>";
                    html += "<td>"+cont+"</td>";
                    html += "<td>";
                    html += "<small>"+formato_fecha(r[i]['pedido_fecha'])+"</small>";
                    html += "</td>";
                                nombre_proveedor = r[i]['proveedor_nombre'];
                    html += "<td style='line-height: 10px;' >";
                    html += "<b>"+nombre_proveedor+"</b>";
                    html += "<a href='"+base_url+"pedido_diario/modificar_pedido/"+r[i]['pedido_id']+"'><fa class='fa fa-edit'></fa></a>";

                    html += "<br>";
                    html += "<small>"+r[i]['pedido_resumen']+"</small>";
                    html += "</td>";
                    html += "<td style='text-align: right;'>";
                    html += "<span class='badge bg-"+color+"'>";
                    html += formato_numerico(Number(pedido_montototal).toFixed(2));
                    html += "</span>";
                    html += "</td>";
                    html += "</tr>";

                }

                    html += "<tr>";
                    html += "<td colspan='3'><b>TOTAL PEDIDOS PARA HOY Bs</b></td>";
                    html += "<td>";
                    html += "<b>"+formato_numerico(total_dia.toFixed(2))+"</b>";
                    html += "</td>";
                    html += "</tr>";            

                    $("#tabla_pedidos_diarios").html(html);

            }        
        });
    }
    else{

        //document.getElementById('div_select').style = "display:none;";
        document.getElementById('div_fecha').style = "display:block;";
    
    }
}

function buscar_pedido_index(opcion)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido_diario/buscar_pedidos";
    var select_fecha =   document.getElementById('select_fecha').value;
    var calendario =   document.getElementById('calendario').value;
    
    if(Number(select_fecha)<=3 || opcion==2){
    
        if (Number(select_fecha)<=3){
             document.getElementById('div_fecha').style = "display:none;";
        }
        
//        alert(calendario);
        $.ajax({url:controlador,
            type:"POST",
            data:{select_fecha:select_fecha,calendario:calendario,opcion:opcion},
            success: function(response){

                var r = JSON.parse(response);
                //alert(r.length);

                var cont = 0; 
                var total_dia = 0;
                var tipobar = "";   
                var html = "";
                var nombre_proveedor = '';
                var tam = r.length;

                //alert(tam);

                for (i = 0; i<tam; i++){

                    total_dia = total_dia + Number(r[i]['pedido_montototal']);
                    pedido_montototal = r[i]['pedido_montototal'];

                    cont++;
                    if(cont % 1 == 0){ tipobar = 'danger'; color='red';}
                    if(cont % 2 == 0){ tipobar = 'info';  color='light-blue';}
                    if(cont % 3 == 0){ tipobar = 'success'; color='green';}
                    if(cont % 4 == 0){ tipobar = 'warning'; color='yellow';}
                    if(cont % 5 == 0){ tipobar = 'facebook'; color='blue';}


                    html += "<tr>";
                    html += "<td>"+cont+"</td>";
                    html += "<td>";
                    html += "<small>"+formato_fecha(r[i]['pedido_fecha'])+"</small>";
                    html += "</td>";
                                nombre_proveedor = r[i]['proveedor_nombre'];
                    html += "<td style='line-height: 10px;' >";
                    html += "<b>"+nombre_proveedor+"</b>";

                    html += "<br>";
                    html += "<small>"+r[i]['pedido_resumen']+"</small>";
                    html += "</td>";
                    html += "<td style='text-align: right;'>";
                    html += "<span class='badge bg-"+color+"'>";
                    html += formato_numerico(Number(pedido_montototal).toFixed(2));
                    html += "</span>";
                    html += "<td>"+r[i]['usuario_nombre']+"</td>";
                    html += "<td>";
                    html += "<a href='"+base_url+"pedido_diario/edit/"+r[i]['pedido_id']+"' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span> </a> ";
                    html += "<a href='"+base_url+"pedido_diario/remove/"+r[i]['pedido_id']+"' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> </a>";
                    html += "</td>";
                    html += "</tr>";

                }

                    html += "<tr>";
                    html += "<th colspan='3'><b>TOTAL PEDIDOS PARA HOY Bs</b></th>";
                    html += "<th>";
                    html += "<b>"+formato_numerico(total_dia.toFixed(2))+"</b>";
                    html += "</th>";
                    html += "<th></th>";
                    html += "</tr>";            

                    $("#tabla_index").html(html);

            }        
        });
    }
    else{

        //document.getElementById('div_select').style = "display:none;";
        document.getElementById('div_fecha').style = "display:block;";
    
    }
}

function misclientes()
{    
    var base_url    = document.getElementById('base_url').value; 
    var usuario_id    = document.getElementById('select_usuarios').value; 
    var controlador = base_url+"pedido/buscar_clientes";    
    var dia_visita = document.getElementById('dia_visita').value;
    
    $.ajax({url:controlador,
        type:"POST",
        data:{usuario_id:usuario_id, dia_visita:dia_visita},
        success: function(response){
            
            var c = JSON.parse(response);
            var estilo = "style='padding:0;'"
            var nombre_negocio = "";
            var cliente_direccion = "";
            var imagen = "";
            var color = "";
         
            html = "";
            
            for (var i = 0; i < c.length; i++){
                
                color = "";
                if(c[i].pedido_id>0){
                    //alert(c[i].pedido_id);
                    color = "style='background-color:silver;'";
                }
                    
                html += "<tr "+color+">";
                html += "<td "+estilo+">"+(i+1)+"</td>";
                
                if((c[i].cliente_nombrenegocio==null)||(c[i].cliente_nombrenegocio=="-")){
                    nombre_negocio = "";
                }
                else{
                    nombre_negocio = "<br>"+c[i].cliente_nombrenegocio;
                }
                
                if((c[i].cliente_direccion==null)||(c[i].cliente_direccion=="-")){
                    cliente_direccion = "";
                }
                else{
                    cliente_direccion = c[i].cliente_direccion;
                }
                    
                html += "<td "+estilo+"><b>"+c[i].cliente_nombre+"</b>"+nombre_negocio+"</td>";
                html += "<td "+estilo+">"+cliente_direccion;
                
                if((c[i].cliente_direccion==null)||(c[i].cliente_direccion=="-")){
                    html +="";
                }
                else{
                    html += "<br><a href='https://wa.me/591"+c[i].cliente_celular+"' target='_BLANK' class='btn btn-success btn-xs'><fa class='fa fa-whatsapp'></fa></a>";
                    html += c[i].cliente_celular+" - ";
                }
                

                 
                html += c[i].cliente_telefono+"</td>";
                html += "<td "+estilo+"><center>"+c[i].cliente_ordenvisita+"</center></td>";
                html += "<td "+estilo+">";
                
                
//                if (isNaN(c[i]["cliente_latitud"]) || isNaN(["cliente_longitud"])){   
                if ((c[i]["cliente_latitud"]==0 && c[i]["cliente_longitud"]==0) || (c[i]["cliente_latitud"]==null && c[i]["cliente_longitud"]==null) || (c[i]["cliente_latitud"]== "" && c[i]["cliente_longitud"]=="")){
                    imagen = "noubicacion.png";
                    html += " <a href='#' title='CLIENTE SIN UBICACIÓN REGISTRADA'><img src='"+base_url+"resources/images/"+imagen+"' width='25' height='25'></a>";
                }
                else{
                    imagen = "blue.png";
                    html += " <a href='https://www.google.com/maps/dir/"+c[i]['cliente_latitud']+","+c[i]['cliente_longitud']+"' target='_blank' title='lat:"+c[i]['cliente_latitud']+",long:"+c[i]['cliente_longitud']+"'><img src='"+base_url+"resources/images/"+imagen+"' width='25' height='25'></a>";
                }                
                
                html += "</td>";
                html += "<td "+estilo+">";
                
                if(c[i].pedido_id>0){
                    //html += "PED. 00"+c[i].pedido_id;
                    html += "        <a href='"+base_url+'pedido/nota_pedido/'+c[i]["pedido_id"]+"' class='btn btn-warning btn-xs' title='Imprimir comprobante de pedido'><span class='fa fa-print'></span></a> ";
                }
                else{
                    html += "<a href='"+base_url+"pedido/pedidoabierto/"+c[i].cliente_id+"' target='_BLANK' class='btn btn-facebook btn-xs'><fa class='fa fa-cart-arrow-down'></fa></a>";
                }
                
                html += "</td>";
                html += "</tr>";
            }
        
            $("#tabla_clientes").html(html);
            
        },
        error:function (response){
            alert("ocurrio un error ");
        }
    });
}

function mapa_clientes()
{    
    var base_url    = document.getElementById('base_url').value; 
    var usuario_id    = document.getElementById('select_usuarios').value; 
    var dia_visita = document.getElementById('dia_visita').value;
    var controlador = base_url+"pedido/mapa_clientes/"+usuario_id+"/"+dia_visita;    
    
    // abrir un PDF en una pestaña nueva
    window.open(controlador, '_blank');
 
    // redirigir la pestaña actual a otra URL
//    window.location.href = 'http://ejemplo.com';
    
    
//    $.ajax({url:controlador,
//        type:"POST",
//        data:{usuario_id:usuario_id, dia_visita:dia_visita},
//        success: function(response){           
//            
//        },
//        error:function (response){
//            alert("ocurrio un error ");
//        }
//    });
}

function cliente_usuario()
{    
    var base_url    = document.getElementById('base_url').value; 
    var usuario_id    = document.getElementById('select_usuarios').value; 
    var controlador = base_url+"pedido/buscar_cliente_usuario";    
    
    $.ajax({url:controlador,
        type:"POST",
        data:{usuario_id:usuario_id},
        success: function(response){
            
            var c = JSON.parse(response);
            var estilo = "style='padding:0;'"
            var nombre_negocio = "";
            var cliente_direccion = "";
            var imagen = "";
         
            html = "";
            
            for (var i = 0; i < c.length; i++){
                html += "<tr>";
                html += "<td "+estilo+">"+(i+1)+"</td>";
                
                if((c[i].cliente_nombrenegocio==null)||(c[i].cliente_nombrenegocio=="-")){
                    nombre_negocio = "";
                }
                else{
                    nombre_negocio = "<br>"+c[i].cliente_nombrenegocio;
                }
                
                if((c[i].cliente_direccion==null)||(c[i].cliente_direccion=="-")){
                    cliente_direccion = "";
                }
                else{
                    cliente_direccion = c[i].cliente_direccion;
                }
                    
                html += "<td "+estilo+"><b>"+c[i].cliente_nombre+"</b>"+nombre_negocio+"</td>";
                html += "<td "+estilo+">"+cliente_direccion;
                
                if((c[i].cliente_direccion==null)||(c[i].cliente_direccion=="-")){
                    html +="";
                }
                else{
                    html += "<br><a href='https://wa.me/591"+c[i].cliente_celular+"' target='_BLANK' class='btn btn-success btn-xs'><fa class='fa fa-whatsapp'></fa></a>";
                    html += c[i].cliente_celular+" - ";
                }
                

                 
                html += c[i].cliente_telefono+"</td>";
                html += "<td "+estilo+">"+c[i].cliente_ordenvisita;
                
                
//                if (isNaN(c[i]["cliente_latitud"]) || isNaN(["cliente_longitud"])){   
                if ((c[i]["cliente_latitud"]==0 && c[i]["cliente_longitud"]==0) || (c[i]["cliente_latitud"]==null && c[i]["cliente_longitud"]==null) || (c[i]["cliente_latitud"]== "" && c[i]["cliente_longitud"]=="")){
                    imagen = "noubicacion.png";
                    html += " <a href='#' title='CLIENTE SIN UBICACIÓN REGISTRADA'><img src='"+base_url+"resources/images/"+imagen+"' width='25' height='25'></a>";
                }
                else{
                    imagen = "blue.png";
                    html += " <a href='https://www.google.com/maps/dir/"+c[i]['cliente_latitud']+","+c[i]['cliente_longitud']+"' target='_blank' title='lat:"+c[i]['cliente_latitud']+",long:"+c[i]['cliente_longitud']+"'><img src='"+base_url+"resources/images/"+imagen+"' width='25' height='25'></a>";
                }                
                
                html += "</td>";
                html += "<td "+estilo+">";
                html += "<a href='"+base_url+"cliente/edit/"+c[i].cliente_id+"' target='_BLANK' class='btn btn-facebook btn-xs'><fa class='fa fa-user'></fa></a>";
                html += "</td>";
                html += "</tr>";
            }
        
            $("#tabla_clientes").html(html);
            
        },
        error:function (response){
            alert("ocurrio un error ");
        }
    });
}
