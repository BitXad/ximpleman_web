function reporte_general(){
    var base_url    = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+"reportes/busqueda_venta";
    var desde    = document.getElementById('fecha_desde').value;
    var hasta    = document.getElementById('fecha_hasta').value;
    var tipo     = document.getElementById('tipo_transaccion').value;
    if (tipo==0) {
      eltipo = "";
    }else{
        eltipo = "";
      //eltipo = " and vs.tipotrans_id = "+tipo+" ";
      //$("#tipotrans").html("<br><font size='2'>Tipo Trans.: <b>"+$('#tipo_transaccion option:selected').text()+"</b></font><br>");
    }
    //var filtro = " date(vs.venta_fecha) >= '"+desde+"'  and  date(vs.venta_fecha) <='"+hasta+"' ";

    $.ajax({url: controlador,
            type:"POST",
            data:{fecha_desde:desde, fecha_hasta:hasta},
            success:function(report){
                //$("#enco").val("- 0 -");
                var registros =  JSON.parse(report);
                var estos_registros = registros;
                const myString = JSON.stringify(estos_registros);
                $("#resproducto").val(myString);
                
                if(registros != null){
                    var totalventas     = Number(0);
                    //var totaldescuentos = Number(0);
                    var totalcostos     = Number(0);
                    var totalutilidades = Number(0);
                    var n = registros.length; //tamaño del arreglo de la consulta   
                    
                    html = "";
                    for (var i=0; i<n ; i++){
                         totalventas     += Number(registros[i]["totalventas"]);
                         //totaldescuentos += Number(registros[j].totaldescuento);
                        html += "<tr>";
                        html += "<td align='center' style='width:5px;'>"+(i+1)+"</td>";
                        html += "<td> "+registros[i]["cliente_nombre"]+" </td>";                                            
                        html += "<td class='text-right'> "+numberFormat(Number(registros[i].totalventas).toFixed(2))+" </td>";
                        if(tipousuario_id == 1){
                            var utilidad = Number(registros[i].totalventas)-Number(registros[i].totalcosto);
                            totalcostos     += Number(registros[i].totalcosto);
                            totalutilidades += Number(utilidad);
                            html += "<td class='text-right'> "+numberFormat(Number(registros[i].totalcosto).toFixed(2))+" </td>";
                            html += "<td class='text-right'> "+numberFormat(Number(utilidad).toFixed(2))+" </td>";
                        }
                        html += "</tr>";
                    }
                    html += "<tr>";
                        html += "<td></td>";
                        html += "<th class='text-right'>TOTAL:</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(totalventas).toFixed(2))+"</th>";
                        if(tipousuario_id == 1){
                            html += "<th style='text-align:right'>"+numberFormat(Number(totalcostos).toFixed(2))+"</th>";
                            html += "<th style='text-align:right'>"+numberFormat(Number(totalutilidades).toFixed(2))+"</th>";
                        }
                    html += "</tr>";
                    $("#resultado_ventas").html(html);
            }
        },
        error:function(result){
           //alert("Algo salio mal...!!!");
           html = "";
           $("#resultado_ventas").html(html);
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

function generarexcel_reportegeneral(){
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var respuesta = document.getElementById('resproducto').value;
    if(respuesta == "" || respuesta == null){
        alert("Primero debe realizar una búsqueda");
    }else{
        var registros =  JSON.parse(respuesta);
        var showLabel = true;
        var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
        var tam = registros.length;
        var mensaje = "";
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
                            row += 'CLIENTE' + ',';
                            row += 'VENTA' + ',';
                            if(tipousuario_id == 1){
                                row += 'COSTO' + ',';
                                row += 'UTILIDAD' + ',';
                            }
                            
                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < tam; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        //var utilidad = Number(Number(registros[i]["detalleven_total"])-(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])));
                        //utilidades += Number(utilidad);
                            row += (i+1)+',';
                            row += '"' +registros[i]["cliente_nombre"]+ '",';
                            row += '"' +Number(registros[i]["totalventas"]).toFixed(2)+ '",';
                            if(tipousuario_id == 1){
                                row += '"' +Number(Number(registros[i]["totalcosto"])).toFixed(2)+ '",';
                                row += '"' +Number(Number(registros[i].totalventas)-Number(registros[i].totalcosto)).toFixed(2)+ '",';
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