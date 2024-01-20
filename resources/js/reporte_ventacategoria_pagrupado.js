$(document).on("ready",inicio);
function inicio(){
    //tabla_reportesproducto();
}

function tabla_reportescatproducto(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/buscarprodagrupados_porcategoria";
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var desde    = document.getElementById('fecha_desde').value;
    var hasta    = document.getElementById('fecha_hasta').value;
    var categoria_id = document.getElementById('categoria_id').value;
    let decimales = document.getElementById('decimales').value;
    //var usuario_id = document.getElementById('usuario_id').value;
    //var esventa_preventa = document.getElementById('esventa_preventa').value;
    document.getElementById('loader').style.display = 'block';
    if (categoria_id==0) {
      lacategoria_id = "";
    }else{
      lacategoria_id = " and vs.categoria_id = "+categoria_id+" ";
      $("#la_categoria").html("<font size='2'>Categoria: <b>"+$('#categoria_id option:selected').text()+"</b></font><br>");
    }

	//var filtro = " date(venta_fecha) >= '"+desde+"'  and  date(venta_fecha) <='"+hasta+"' "+eltipo+" "+elcliente+" "+elproducto+" "+elprove+" ";
	var filtro = " date(venta_fecha) >= '"+desde+"'  and  date(venta_fecha) <='"+hasta+"' "+lacategoria_id+" ";

  //simplemente(filtro);
     
    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro},
            success:function(report){
                //$("#enco").val("- 0 -");
                var registros =  JSON.parse(report);
                const myString = JSON.stringify(registros);
                $("#resproducto").val(myString);
                
                if (registros != null){
                    var cantidades = Number(0);
                    var total = Number(0);
                    var lamoneda_id = document.getElementById('lamoneda_id').value;
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                    //var cuotas = Number(0);
                    var costos = Number(0);
                    var utilidades = Number(0);
                    var descuentos = Number(0);
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                    html = "";
                    for (var i = 0; i < n ; i++){
                        total += Number(registros[i]["total_venta"]);
                        cantidades += Number(registros[i]["total_cantidad"]);
                        //cuotas += Number(registros[i]["credito_cuotainicial"]);
                        descuentos += Number(registros[i]["total_descuento"]);
                        costos += Number(registros[i]["total_costo"]);
                        utilidades += Number(registros[i]["total_utilidad"]);
                        html += "<tr>";
                        html += "<td align='center' style='width:5px;'>"+(i+1)+"</td>";
                        html += "<td> "+registros[i]["producto_nombre"]+" </td>";
                        //html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";  
                        html += "<td align='center'> "+registros[i]["producto_unidad"]+" </td>";                                          
                        html += "<td align='center'> ";
                        let partes = registros[i]["total_cantidad"];
                        let partes1 = partes.toString();
                        let partes2 = partes1.split('.');
                        if (partes2[1] == 0) { 
                            lacantidad = partes2[0]; 
                        }else{ 
                            lacantidad = numberFormat(Number(registros[i]["total_cantidad"]).toFixed(decimales))
                            //lacantidad = number_format($d['detalleven_cantidad'],2,'.',','); 
                        }
                        html += lacantidad;
                        html += "</td>"; 
                        html += "<td align='right'> "+numberFormat(Number(registros[i]["total_punitario"]).toFixed(decimales))+" </td>"; 
                        html += "<td align='right'> "+numberFormat(Number(registros[i]["total_descuento"]).toFixed(decimales))+" </td>";
                        html += "<td align='right'><b>"+numberFormat(Number(registros[i]["total_venta"]).toFixed(decimales))+"</b></td>";
                        html += "<td class='text-right'> ";
                        
                        if(lamoneda_id == 1){
                            total_otram = Number(registros[i]["total_venta"])/Number(registros[i]["tipo_cambio"])
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = Number(registros[i]["total_venta"])*Number(registros[i]["tipo_cambio"])
                            total_otramoneda += total_otram;
                        }
                        
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                        
                        if(tipousuario_id == 1){
                        
                            html += "<td align='right'> "+numberFormat(Number(registros[i]["total_costo"]).toFixed(decimales))+" </td>";
                            html += "<td align='right'> "+numberFormat(Number(registros[i]["total_utilidad"]).toFixed(decimales))+" </td>";
                            html += "<td align='right'> ";
                            
                            if(Number(registros[i]["total_venta"]) !=0){
                                html += Number(Number(registros[i]["total_utilidad"])/Number(registros[i]["total_venta"])).toFixed(decimales);
                            }else{
                                html += "0.00";
                            }
                            html += " </td>";
                        }
                        
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<th></th>";
                        //html += "<th></th>";
                        html += "<th></th>";
                        html += "<th></th>";
                        html += "<th>"+numberFormat(Number(cantidades).toFixed(decimales))+"</th>";
                        html += "<th></th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(descuentos).toFixed(decimales))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(total).toFixed(decimales))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(total_otramoneda).toFixed(decimales))+"</th>";
                        if(tipousuario_id == 1){
                            html += "<th style='text-align:right'>"+numberFormat(Number(costos).toFixed(decimales))+"</th>";
                            html += "<th style='text-align:right'>"+numberFormat(Number(utilidades).toFixed(decimales))+"</th>";
                        }
                        html += "<th></th>";
                        
                        html += "</tr>";
                   desde1 = "Desde: <b>"+moment(desde).format('DD/MM/YYYY')+"</b>";
                   hasta1 = "Hasta: <b>"+moment(hasta).format('DD/MM/YYYY')+"</b>";
                   $("#reportefechadeventa").html(html);
                   $("#desde").html(desde1);
                   $("#hasta").html(hasta1);
                   document.getElementById('loader').style.display = 'none';
            }
                
        },
        error:function(result){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#reportefechadeventa").html(html);
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

function generarexcel_vagrupado_porcategoria(){
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var respuesta = document.getElementById('resproducto').value;
    if(respuesta == "" || respuesta == null){
        alert("Primero debe realizar una búsqueda");
    }else{
        var nombre_moneda = document.getElementById('nombre_moneda').value;
        var lamoneda_id = document.getElementById('lamoneda_id').value;
        var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
        let decimales = document.getElementById('decimales').value;
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
                            //row += 'TIPO VENTA' + ',';
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
                            //row += '"' +registros[i]["tipotrans_nombre"]+ '",';
                            row += '"' +registros[i]["producto_unidad"]+ '",';
                            row += '"' +Number(registros[i]["total_cantidad"]).toFixed(decimales)+ '",';
                            row += '"' +numberFormat(Number(registros[i]["total_punitario"]).toFixed(decimales))+ '",';
                            row += '"' +numberFormat(Number(registros[i]["total_descuento"]).toFixed(decimales))+ '",';
                            row += '"' +numberFormat(Number(registros[i]["total_venta"]).toFixed(decimales))+ '",';
                            if(lamoneda_id == 1){
                                total_otram = Number(registros[i]["total_venta"])/Number(registros[i]["tipo_cambio"])
                                //total_otramoneda += total_otram;
                            }else{
                                total_otram = Number(registros[i]["total_venta"])*Number(registros[i]["tipo_cambio"])
                                //total_otramoneda += total_otram;
                            }
                            row += '"' +numberFormat(Number(total_otram).toFixed(decimales))+ '",';
                            if(tipousuario_id == 1){
                                row += '"' +numberFormat(Number(registros[i]["total_costo"]).toFixed(decimales))+ '",';
                                row += '"' +numberFormat(Number(registros[i]["total_utilidad"]).toFixed(decimales))+ '",';
                                row += '"' +Number(Number(registros[i]["total_utilidad"])/Number(registros[i]["total_venta"])).toFixed(decimales)+ '",';
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