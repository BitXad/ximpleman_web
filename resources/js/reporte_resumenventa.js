$(document).on("ready",inicio);
function inicio(){
    //resumen_ventascaja();
}


function resumen_ventascaja(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"reportes/resumen_ventascaja";
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var fecha_reporte    = document.getElementById('fecha_reporte').value;
    var tipo     = document.getElementById('tipo_transaccion').value;
    var usuario_id = document.getElementById('usuario_id').value;
    var esventa_preventa = document.getElementById('esventa_preventa').value;
    document.getElementById('loader').style.display = 'block';
    if (tipo==0) {
      eltipo = "";
    }else{
      eltipo = " and vs.tipotrans_id = "+tipo+" ";
      $("#tipotrans").html("<font size='2'>Tipo Trans.: <b>"+$('#tipo_transaccion option:selected').text()+"</b></font><br>");
    }
    if(esventa_preventa ==1){
        if (usuario_id==0) {
            elusuario = " and vs.usuario_id > 0 ";
        }else{
            elusuario = " and vs.usuario_id = "+usuario_id+" ";
            $("#esteusuario").html("<font size='2'>Usuario: <b>"+$('#usuario_id option:selected').text()+"</b></font><br>");
        }
        $("#ventaprev").html("<font size='2'>Venta/Preventa: <b>"+$('#esventa_preventa option:selected').text()+"</b></font>");
    }else{
        if (usuario_id==0) {
            elusuario = " and vs.usuarioprev_id > 0 ";
        }else{
            elusuario = " and vs.usuarioprev_id = "+usuario_id+" ";
            $("#esteusuario").html("<font size='2'>Usuario: <b>"+$('#usuario_id option:selected').text()+"</b></font><br>");
        }
        $("#ventaprev").html("<font size='2'>Venta/Preventa: <b>"+$('#esventa_preventa option:selected').text()+"</b></font>");
    }
	//var filtro = " date(venta_fecha) >= '"+desde+"'  and  date(venta_fecha) <='"+hasta+"' "+eltipo+" "+elcliente+" "+elproducto+" "+elprove+" ";
	var filtro = " date(venta_fecha) >= '"+fecha_reporte+"'  and  date(venta_fecha) <='"+fecha_reporte+"' "+eltipo+" "+elusuario+" ";

  //simplemente(filtro);
     
    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro, fecha_reporte:fecha_reporte, usuario_id:usuario_id},
            success:function(report){
                var registros =  JSON.parse(report);
                
                //alert(registros);
                if (registros != null){
                    let reporte   = registros['reporte'];
                    let n = reporte.length;
                    let caja = registros['caja'];
                    let punto_venta   = registros['punto_venta'];
                    let resumen   = registros['resumen'];
                    let total_ventas   = registros['total_ventas'];
                    let validas   = registros['validas'];
                    let mal_emitidas   = registros['mal_emitidas'];
                    let anuladas   = registros['anuladas'];
                    
                    html = "";
                    let total = 0;
                    let cantidades = 0;
                    let descuentos = 0;
                    let costos = 0;
                    let utilidades = 0;
                    for (var i = 0; i < n ; i++){
                        total      += Number(reporte[i]["total_venta"]);
                        cantidades += Number(reporte[i]["total_cantidad"]);
                        descuentos += Number(reporte[i]["total_descuento"]);
                        costos     += Number(reporte[i]["total_costo"]);
                        utilidades += Number(reporte[i]["total_utilidad"]);
                        html += "<tr>";
                        html += "<td align='center'> "+Number(reporte[i]["total_cantidad"]).toFixed(2)+" </td>";  
                        html += "<td> "+reporte[i]["producto_nombre"]+" </td>";                                          
                        html += "<td align='right'> "+numberFormat(Number(reporte[i]["total_punitario"]).toFixed(2))+" </td>"; 
                        html += "<td align='right'><b>"+numberFormat(Number(reporte[i]["total_venta"]).toFixed(2))+"</b></td>";
                        /*if(tipousuario_id == 1){
                            html += "<td align='right'> "+numberFormat(Number(reporte[i]["total_utilidad"]).toFixed(2))+" </td>";
                        }*/
                        html += "</tr>";
                    }
                    
                    //desde1 = "Desde: <b>"+moment(desde).format('DD/MM/YYYY')+"</b>";
                    //hasta1 = "Hasta: <b>"+moment(hasta).format('DD/MM/YYYY')+"</b>";
                    $("#reporte_resumenventa").html(html);
                    $("#eltotal").html(numberFormat(Number(total).toFixed(2)));
                    let apertura_decaja = 0;
                    let caja_diferencia = 0;
                    let nombre_cajera = "";
                    //let c = caja.length;
                    if(caja != null){
                    //if(typeof caja["caja_apertura"] != undefined){
                        $("#lacaja").html(numberFormat(Number(caja["caja_apertura"]).toFixed(2)));
                        apertura_decaja = caja["caja_apertura"];
                        caja_diferencia = caja["caja_diferencia"];
                        nombre_cajera = caja["usuario_nombre"];
                    }else{
                        $("#lacaja").html("0.00");
                    }
                    
                    let efectivo_caja = Number(Number(total)+Number(apertura_decaja));
                    $("#elefectivoencaja").html(numberFormat(efectivo_caja.toFixed(2)));
                    
                    $("#ladiferencia").html(numberFormat(Number(caja_diferencia).toFixed(2)));
                    
                    if(resumen != null){
                        $("#elrango").html(resumen[0]["desde"]+" - "+resumen[0]["hasta"]);
                    }else{
                        $("#elrango").html(" - ");
                    }
                    $("#lacantidad").html(total_ventas[0]["total_ventas"]);
                    $("#lasventasvalidas").html(validas[0]["ventas_validas"]);
                    $("#lasventasmalemitidas").html(mal_emitidas[0]["mal_emitidas"]);
                    $("#lasventasanuladas").html(anuladas[0]["anuladas"]);
                    $("#lacajera").html(nombre_cajera);
                    $("#lafechainicio").html(caja["caja_fechaapertura"]+" "+caja["caja_horaapertura"]);
                    $("#lafechafin").html(caja["caja_fechacierre"]+" "+caja["caja_horacierre"]);
                    
                    
                    //$("#desde").html(desde1);
                    //$("#hasta").html(hasta1);
                    document.getElementById('loader').style.display = 'none';
                }
                
        },
        error:function(result){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#reporte_resumenventa").html(html);
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

function generarexcel_vagrupado(){
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var respuesta = document.getElementById('resproducto').value;
    if(respuesta == "" || respuesta == null){
        alert("Primero debe realizar una búsqueda");
    }else{
        var nombre_moneda = document.getElementById('nombre_moneda').value;
        var lamoneda_id = document.getElementById('lamoneda_id').value;
        var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
        var registros =  JSON.parse(respuesta);
        var showLabel = true;
        var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
        var tam = registros.length;
        var otramoneda_nombre = "";
        var total_otram = Number(0);
                html = "";
                //if (opcion==1){
                  /* **************INICIO Generar Excel JavaScript************** */
                    var CSV = 'sep=,' + '\r\n\n';
                    //This condition will generate the Label/Header
                    if (showLabel) {
                        var row = "";

                        //This loop will extract the label from 1st index of on array
                        

                            //Now convert each value to string and comma-seprated
                            row += 'Nro.' + ',';
                            row += 'PRODUCTO' + ',';
                            row += 'TIPO VENTA' + ',';
                            row += 'UNIDAD' + ',';
                            row += 'CANTIDAD' + ',';
                            row += 'PRECIO UNITARIO(' +nombre_moneda+ '),';
                            row += 'DESCUENTO(' +nombre_moneda+ '),';
                            row += 'PRECIO TOTAL(' +nombre_moneda+ '),';
                            row += 'PRECIO TOTAL(';
                            if(lamoneda_id == 1){
                                otramoneda_nombre = lamoneda[1]['moneda_descripcion'];
                            }else{
                                otramoneda_nombre = lamoneda[0]['moneda_descripcion'];
                            }
                            row += otramoneda_nombre+ '),';
                            if(tipousuario_id == 1){
                                row += 'COSTO TOTAL(' +nombre_moneda+ '),';
                                row += 'UTILIDAD(' +nombre_moneda+ '),';
                                row += '%' + ',';
                            }
                            
                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < tam; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        var utilidad = Number(registros[i]["total_utilidad"]);
                        //utilidades += Number(utilidad);
                            row += (i+1)+',';
                            row += '"' +registros[i]["producto_nombre"]+ '",';
                            row += '"' +registros[i]["tipotrans_nombre"]+ '",';
                            row += '"' +registros[i]["producto_unidad"]+ '",';
                            row += '"' +Number(registros[i]["total_cantidad"]).toFixed(2)+ '",';
                            row += '"' +numberFormat(Number(registros[i]["total_punitario"]).toFixed(2))+ '",';
                            row += '"' +numberFormat(Number(registros[i]["total_descuento"]).toFixed(2))+ '",';
                            row += '"' +numberFormat(Number(registros[i]["total_venta"]).toFixed(2))+ '",';
                            if(lamoneda_id == 1){
                                total_otram = Number(registros[i]["total_venta"])/Number(registros[i]["tipo_cambio"])
                                //total_otramoneda += total_otram;
                            }else{
                                total_otram = Number(registros[i]["total_venta"])*Number(registros[i]["tipo_cambio"])
                                //total_otramoneda += total_otram;
                            }
                            row += '"' +numberFormat(Number(total_otram).toFixed(2))+ '",';
                            if(tipousuario_id == 1){
                                row += '"' +numberFormat(Number(registros[i]["total_costo"]).toFixed(2))+ '",';
                                row += '"' +numberFormat(Number(registros[i]["total_utilidad"]).toFixed(2))+ '",';
                                row += '"' +Number(Number(registros[i]["total_utilidad"])/Number(registros[i]["total_venta"])).toFixed(2)+ '",';
                            }
                            
                        row.slice(0, row.length - 1);

                        //add a line break after each row
                        CSV += row + '\r\n';
                    }
                    
                    if (CSV == '') {
                        alert("Invalid data");
                        return;
                    }
                    
                    //Generate a file name
                    var fileName = "Ventacategoria_";
                    //this will remove the blank-spaces from the title and replace it with an underscore
                    fileName += reportitle.replace(/ /g,"_");   

                    //Initialize file format you want csv or xls
                    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

                    // Now the little tricky part.
                    // you can use either>> window.open(uri);
                    // but this will not work in some browsers
                    // or you will not get the correct file extension    

                    //this trick will generate a temp <a /> tag
                    var link = document.createElement("a");    
                    link.href = uri;

                    //set the visibility hidden so it will not effect on your web-layout
                    link.style = "visibility:hidden";
                    link.download = fileName + ".csv";

                    //this part will append the anchor tag and remove it after automatic click
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    /* **************F I N  Generar Excel JavaScript************** */
                   
                   
                   
                   
                   //document.getElementById('loader').style.display = 'none';
            //}
         //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        //}  
        }
}