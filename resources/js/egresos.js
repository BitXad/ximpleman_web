$(document).on("ready",inicio);
function inicio(){
    filtro = " and date(egreso_fecha) = date(now())";
    fechadeegreso(filtro);
}

function buscar_egresos()
{
    //var base_url    = document.getElementById('base_url').value;
    //var controlador = base_url+"egreso";
    var opcion = document.getElementById('select_compra').value;
    /*if(opcion == 0){
        filtro = "";
        mostrar_ocultar_buscador("ocultar");
        fechadeegreso(filtro);
    }else*/ if(opcion == 1){ //todas las compras
        filtro = " and date(egreso_fecha) = date(now())";
        mostrar_ocultar_buscador("ocultar");
        fechadeegreso(filtro);
    }else if(opcion == 2){ //compras de hoy
        filtro = " and date(egreso_fecha) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
        fechadeegreso(filtro);
    }else if(opcion == 3){ //compras de ayer
        filtro = " and date(egreso_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)";//compras de la semana
        mostrar_ocultar_buscador("ocultar");
        fechadeegreso(filtro);
    }else if(opcion == 4){
        filtro = " ";//todos los compras
        mostrar_ocultar_buscador("ocultar");
        fechadeegreso(filtro);
    }else if(opcion == 5){
        mostrar_ocultar_buscador("mostrar");
    }
    
}

function buscar_por_fechas()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"egreso";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
   
    filtro = " and date(egreso_fecha) >= '"+fecha_desde+"'  and  date(egreso_fecha) <='"+fecha_hasta+"' ";
    
    fechadeegreso(filtro);
    
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}   
}

function buscaregreso(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        var filtrar = document.getElementById('filtrar').value;
        let filtro = " and(e.egreso_numero = '"+filtrar+"' or e.egreso_nombre like '%"+filtrar+"%'";
        filtro += " or e.egreso_monto like '%"+filtrar+"%' or e.egreso_concepto like '%"+filtrar+"%')";
        fechadeegreso(filtro);
    }
}

function fechadeegreso(filtro){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"egreso/buscarfecha";
    var categoria = $('#categoria_id').val();
    let categ = 0;//mandar con una consulta
    if(categoria != "0"){
        categ = 1;
    }
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
        type:"POST",
        data:{
            filtro:filtro,
            categ:categ,
            categoria:categoria,
        },
        success:function(resul){         
            $("#pillados").val("- 0 -");
            var registros = JSON.parse(resul);
            if (registros != null){
                var nombre_moneda = document.getElementById('nombre_moneda').value;
                var lamoneda_id = document.getElementById('lamoneda_id').value;
                var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
                var total_otramoneda = Number(0);
                var total_otram = Number(0);
                var cont = 0;
                var total = Number(0);
                
                var n = registros.length; //tamaño del arreglo de la consulta
                $("#pillados").html("Registros Encontrados: "+n+"");
                
                html = "";
                for (var i = 0; i < n ; i++){
                    
                    var suma = Number(registros[i]["egreso_monto"]);
                    var total = Number(suma+total);
                    
                    html += "<tr>";
                    
                    html += "<td>"+(i+1)+"</td>";
                    html += "<td><b>"+registros[i]["egreso_nombre"]+"</b><sub> ["+registros[i]["egreso_id"]+"]</sub></td>";
                    html += "<td align='center'>"+registros[i]["egreso_numero"]+"</td>"; 
                    html += "<td align='center'>"+moment(registros[i]["egreso_fecha"]).format('DD/MM/YYYY HH:mm:ss')+"</td>"; 
                    html += "<td>"+registros[i]["egreso_categoria"]+"</br>"; 
                    html += "<b>"+registros[i]["egreso_concepto"]+"</b></td>"; 
                    html += "<td align='right'>"+numberFormat(Number(registros[i]["egreso_monto"]).toFixed(2));
                    html += "<br>";
                    if(lamoneda_id == 1){
                        total_otram = Number(registros[i]["egreso_monto"])/Number(registros[i]["egreso_tc"]);
                        total_otramoneda += total_otram;
                    }else{
                        total_otram = Number(registros[i]["egreso_monto"])*Number(registros[i]["egreso_tc"]);
                        total_otramoneda += total_otram;
                    }
                    html += "<span style='font-size: 8px'>"+numberFormat(Number(total_otram).toFixed(2))+"</span>";
                    html += "</td>"; 
                    html += "<td>"+registros[i]["egreso_moneda"];
                    html += "<br>";
                    if(lamoneda_id == 1){
                        html += "<span style='font-size: 8px'>"+lamoneda[1]['moneda_descripcion']+"</span>";
                    }else{
                        html += "<span style='font-size: 8px'>"+lamoneda[0]['moneda_descripcion']+"</span>";
                    }
                    html += "</td>";
                    html += "<td>";
                    if(registros[i]["forma_id"] >0){
                        html += registros[i]["forma_nombre"];
                        if(registros[i]["forma_id"]> 1){
                            html += "<br><b>Glosa: </b>"+registros[i]["egreso_glosa"];
                        }
                    }
                    html += "</td>";
                    html += "<td>";
                    if(registros[i]["banco_id"] >0){
                        html += registros[i]["banco_nombre"];
                    }
                    html += "</td>";
                    html += "<td>"+registros[i]["usuario_nombre"]+"</td>";
//                        html += "<td class='no-print'><a href='"+base_url+"egreso/pdf/"+registros[i]["egreso_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></a>";
//                        html += "<a href='"+base_url+"egreso/boucher/"+registros[i]["egreso_id"]+"' title='BOUCHER' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></a>";
                    html += "<td class='no-print'><a href='"+base_url+"egreso/imprimir/"+registros[i]["egreso_id"]+"' title='Imprimir comprobante' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></a>";

                    html += "<a href='"+base_url+"egreso/edit/"+registros[i]["egreso_id"]+"'  class='btn btn-info btn-xs'><span class='fa fa-pencil'></a>";
                    html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='Eliminar'><span class='fa fa-trash'></span></a>";
                    html += "<!------------------------ INICIO modal para confirmar eliminaci���n ------------------->";
                    html += "<div class='modal fade' id='myModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                    html += "<div class='modal-dialog' role='document'>";
                    html += "<br><br>";
                    html += "<div class='modal-content'>";
                    html += "<div class='modal-header'>";
                    html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                    html += "</div>";
                    html += "<div class='modal-body'>";
                    html += "<!------------------------------------------------------------------->";
                    html += "<h3><b> <span class='fa fa-trash'></span></b>";
                    html += "Desea eliminar el Egreso <b># "+registros[i]["egreso_numero"]+"?</b>";
                    html += "</h3>";
                    html += "<!------------------------------------------------------------------->";
                    html += "</div>";
                    html += "<div class='modal-footer aligncenter'>";
                    html += "<a href='"+base_url+"egreso/remove/"+registros[i]["egreso_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                    html += " <a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "<!------------------------ FIN modal para confirmar eliminaci���n ------------------->";
                    html += "</td>";
                    
                    html += "</tr>";
                } 
                    html += "<tr>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "<td align='right'><b>TOTAL</b></td>";
                    html += "<td align='right'><font size='4'><b>"+numberFormat(Number(total).toFixed(2))+"</b></font>";
                    html += "<br>";
                    html += "<span style='font-size: 9px'>"+numberFormat(Number(total_otramoneda).toFixed(2))+"</span>"
                    html += "</td>";
                    html += "<td><font size='4'><b>"+nombre_moneda+"</b></font>";
                    html += "<br>";
                    if(lamoneda_id == 1){
                        html += "<span style='font-size: 9px'>"+lamoneda[1]['moneda_descripcion']+"</span>";
                    }else{
                        html += "<span style='font-size: 9px'>"+lamoneda[0]['moneda_descripcion']+"</span>";
                    }
                    html += "</td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    html += "</tr>";
                
                $("#fechadeegreso").html(html);
                document.getElementById('loader').style.display = 'none';
            }
            document.getElementById('loader').style.display = 'none';
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadeegreso").html(html);
        }
        
    });   

}
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