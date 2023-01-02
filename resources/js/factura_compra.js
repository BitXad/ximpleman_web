function buscarcompra(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if(tecla==13){
        let filtrar = document.getElementById('filtrar').value;
        if(filtrar != ""){
            mostrar_facturas();
        }
    }
}

function mostrar_facturas(){
    var base_url = document.getElementById('base_url').value;
    var filtrar = document.getElementById('filtrar').value;
    var controlador = base_url+'factura_compra/mostrar_facturascompra';    
    var desde = document.getElementById('fecha_desde').value;
    var hasta = document.getElementById('fecha_hasta').value; 
    document.getElementById('loader').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{desde:desde, hasta:hasta ,filtrar:filtrar},
            success:function(result){
                var factura = JSON.parse(result);
                var tam = factura.length;
                
                if (factura != null){
                    const myString = JSON.stringify(factura);
                    $("#elresultado").val(myString);
                }
                var totalfinal = 0;
                var mensaje = "";
                html = "";
                html += "<table class='table table-striped' id='mitabla' >";
                    html += "<th>ESPEC.</th>";
                    html += "<th>N°</th>";
                    html += "<th>FECHA DE LA FACTURA</th>";
                    html += "<th>N° DE LA FACTURA</th>";
                    html += "<th>N° DE AUTORIZACION</th>";
                    html += "<th>ESTADO NIT/CI CLIENTE</th>";
                    html += "<th>NOMBRE O RAZON SOCIAL</th>";
                    html += "<th>IMPORTE TOTAL DE LA VENTA</th>";
                    html += "<th>IMPORTE ICE</th>";
                    html += "<th>/IEHD/TASAS    EXPORTACIONES Y OPERACIONES EXENTAS</th>";  
                    html += "<th>VENTAS GRAVADAS A TASA CERO</th>"; 
                    html += "<th>SUBTOTAL</th>";    
                    html += "<th>DESCUENTOS</th>"; 
                    html += "<th>BONIFICACIONES Y REBAJAS OTORGADAS</th>";  
                    html += "<th>IMPORTE BASE PARA DEBITO FISCAL</th>"; 
                    html += "<th>DEBITO FISCAL</th>";   
                    html += "<th>CODIGO DE CONTROL</th>";   
                    html += "<th>TRANSACCION</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                    
                    
                    
                    for(var i = 0; i < tam; i++ ){
                        html += "<tr>";
                        html += "   <td>0</td>";
                        html += "   <td>"+Number(i+1)+"</td>";
                        html += "   <td>"+formato_fecha(factura[i]["factura_fecha"])+"</td>";
                        html += "   <td>"+factura[i]["factura_numero"]+"</td>";
                        html += "   <td>"+factura[i]["factura_autorizacion"]+"</td>";
                        html += "   <td>"+factura[i]["factura_nit"]+"</td>";
                        html += "   <td>"+factura[i]["factura_razonsocial"]+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_subtotal"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_ice"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_exento"]).toFixed(2)+"</td>";
                        html += "   <td>0</td>";
                        html += "   <td>"+Number(factura[i]["factura_subtotal"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_descuento"]).toFixed(2)+"</td>";
                        html += "   <td>0</td>";
                        html += "   <td>"+Number(factura[i]["factura_total"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_total"]*0.13).toFixed(2)+"</td>";
                        html += "   <td>"+factura[i]["factura_codigocontrol"]+"</td>";
                        html += "   <td>";
                        if(factura[i]["compra_id"]>0){
                            html += factura[i]["compra_id"];
                        }else{
                            html += 0;
                        }
                        html += "</td>";
                        html += "</tr>";
                        
                        totalfinal += Number(factura[i]["factura_total"]);
                    }
                        var debitofiscal =  totalfinal * 0.13;
                        
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th>"+numberFormat(Number(totalfinal).toFixed(2))+"</th> ";
                        html += "<th>"+numberFormat(Number(debitofiscal).toFixed(2))+"</th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                   html += "<tbody>";
                    html += "</table>";
                    $("#tabla_factura").html(html);
                    document.getElementById('loader').style.display = 'none';
            },
            error:function(result){alert("Ocurrio un error en la consulta. Revise los parametros por favor...!")},
            })
    document.getElementById('loader').style.display = 'none';
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
    

function generarexcel(){
    var respuesta = document.getElementById('elresultado').value;
    var factura =  JSON.parse(respuesta);
    var tam = factura.length;
    if(tam>0){
        var showLabel = true;
        var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
        
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
                            row += 'ESPEC.' + ',';
                            row += 'N°' + ',';
                            row += 'FECHA DE LA FACTURA' + ',';
                            row += 'N° DE FACT.' + ',';
                            row += 'N° DE AUTORIZACION' + ',';
                            row += 'NIT/CI CLIENTE' + ',';
                            row += 'NOMBRE O RAZON SOCIAL' + ',';
                            row += 'IMPORTE TOTAL DE LA VENTA' + ',';
                            row += 'IMPORTE ICE' + ',';
                            row += '/IEHD/TASAS    EXPORTACIONES Y OPERACIONES EXENTAS' + ',';
                            row += 'VENTAS GRAVADAS A TASA CERO' + ',';
                            row += 'SUBTOTAL' + ',';
                            row += 'DESC.' + ',';
                            row += 'BONIF. Y REBAJAS OTORGADAS' + ',';
                            row += 'IMPORTE BASE PARA DEBITO FISCAL' + ',';
                            row += 'DEBITO FISCAL' + ',';
                            row += 'CODIGO DE CONTROL' + ',';
                            row += 'TRANS' + ',';
       
                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < tam; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        
                            row += '0,';
                            row += '1,';
                            row += '"' +formato_fecha(factura[i]["factura_fecha"])+ '",';
                            row += '"' +factura[i]["factura_numero"]+ '",';
                            row += '"' +factura[i]["factura_autorizacion"]+ '",';
                            row += '"' +factura[i]["factura_nit"]+ '",';
                            row += '"' +factura[i]["factura_razonsocial"]+ '",';
                            row += '"' +Number(factura[i]["factura_subtotal"]).toFixed(2)+ '",';
                            row += '"' +Number(factura[i]["factura_ice"]).toFixed(2)+ '",';
                            row += '"' +Number(factura[i]["factura_exento"]).toFixed(2)+ '",';
                            row += '0,';
                            row += '"' +Number(factura[i]["factura_subtotal"]).toFixed(2)+ '",';
                            row += '"' +Number(factura[i]["factura_descuento"]).toFixed(2)+ '",';
                            row += '0,';
                            row += '"' +Number(factura[i]["factura_total"]).toFixed(2)+ '",';
                            row += '"' +Number(factura[i]["factura_total"]*0.13).toFixed(2)+ '",';
                            row += '"' +factura[i]["factura_codigocontrol"]+ '",';
                            if(factura[i]["compra_id"] >0){
                                row += '"' +factura[i]["compra_id"]+ '",';
                            }else{
                                row += '0,';
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
                    var fileName = "Ventas_";
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
               
   }
}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}
