function ventacliente(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){               
        reporte1();
    }
}

function reporte1()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/busca_simple";
    var desde    = document.getElementById('fecha_desde').value;
    var hasta    = document.getElementById('fecha_hasta').value;
    var nombre_moneda = document.getElementById('nombre_moneda').value;
    var cliente  = document.getElementById('cliente_id').value;
    var tipo     = document.getElementById('tipo_transaccion').value;
    let decimales = document.getElementById('decimales').value;
    let usuario_id = document.getElementById('usuario_id').value;
    let tipo_emision = document.getElementById('tipo').value;
    
    //alert(tipo_emision);
    
    if (tipo==0) {
      eltipo = "";
    }else{
      eltipo = " and vs.tipotrans_id = "+tipo+" ";
      $("#tipotrans").html("<br><font size='2'>Tipo Trans.: <b>"+$('#tipo_transaccion option:selected').text()+"</b></font><br>");
    }
    if (cliente=="") {
        elcliente = "";
    } else {
        elcliente = " and (cliente_nombre like '%"+cliente+"%' or cliente_nit like '%"+cliente+"%' or cliente_razon like '%"+cliente+"%')"; 
        //elcliente = "and vs.cliente_id="+cliente+" "; 
    }
	var filtro = " date(vs.venta_fecha) >= '"+desde+"'  and  date(vs.venta_fecha) <='"+hasta+"' "+eltipo+" "+elcliente+" ";

    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro},
            success:function(report){
                $("#enco").val("- 0 -");
                var registros =  JSON.parse(report);
                
                const myString = JSON.stringify(registros);
                $("#resproducto").val(myString);
                
                if (registros != null){    
                    var totales = Number(0);
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                    var lamoneda_id   = document.getElementById('lamoneda_id').value;
                    var n = registros.length; //tamaño del arreglo de la consulta   
                    html = "";
                    for (var i = 0; i < n ; i++){
                        totales += Number(registros[i]["venta_total"]);
                        html += "<tr>";
                        html += "<td align='center'> "+(i+1)+" </td>";     
                        html += "<td> "+registros[i]["cliente_nombre"]+" </td>";     
                        html += "<td align='center'> "+registros[i]["venta_id"]+" </td>";     
                        html += "<td align='center'> "+registros[i]["factura_numero"]+" </td>";     
                        html += "<td align='right'> "+numberFormat(Number(registros[i]["venta_total"]).toFixed(decimales))+" </td>";
                        html += "<td class='text-right'> ";
                        if(lamoneda_id == 1){
                            total_otram = Number(registros[i]["venta_total"])/Number(registros[i]["tipo_cambio"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = Number(registros[i]["venta_total"])*Number(registros[i]["tipo_cambio"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                        html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";     
                        html += "<td align='center'> "+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+" </td>";
                        html += "<td align='center'> "+registros[i]["usuario_nombre"]+" </td>";     
                        html += "<td class='no-print'><a href='"+base_url+"venta/modificar_venta/"+registros[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modifica el detalle/cliente de la venta'><span class='fa fa-edit'></span></a> <a href='"+base_url+"factura/imprimir_recibo/"+registros[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-print'></span></a> </td>";
                        html += "</tr>";
                    }
                    html += "<tr>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "<th style='text-align:right'>"+numberFormat(Number(totales).toFixed(decimales))+"</th>";
                    html += "<th style='text-align:right'>"+numberFormat(Number(total_otramoneda).toFixed(decimales))+"</th>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "</tr>";
                    desde1 = "Desde: <b>"+moment(desde).format('DD/MM/YYYY')+"</b>";
                    hasta1 = "Hasta: <b>"+moment(hasta).format('DD/MM/YYYY')+"</b>";
                   
                    $("#desde").html(desde1);
                    $("#hasta").html(hasta1);
                    $("#simple").html(html);
                    document.getElementById('loader').style.display = 'none';
                    $('#modalbuscarcliente').modal('hide');
                    $('#modalbuscarcliente').on('hidden.bs.modal', function () {
                        $('#tablarecliente').html('');
                    });
            }
        },
        error:function(result){
           //alert("Algo salio mal...!!!");
           html = "";
           $("#simple").html(html);
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

function generarexcel_vclientegeneral(){
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
                            row += 'CLIENTE' + ',';
                            row += 'NUM. VENTA' + ',';
                            row += 'NUM. DOCUMENTO' + ',';
                            row += 'MONTO' + ',';
                            row += 'MONTO(';
                            if(lamoneda_id == 1){
                                otramoneda_nombre = lamoneda[1]['moneda_descripcion'];
                            }else{
                                otramoneda_nombre = lamoneda[0]['moneda_descripcion'];
                            }
                            row += otramoneda_nombre+ '),';
                            row += 'TIPO' + ',';
                            row += 'FECHA' + ',';
                            row += 'USUARIO' + ',';
                            
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
                            row += '"' +registros[i]["venta_id"]+ '",';
                            row += '"' +registros[i]["factura_numero"]+ '",';
                            //row += '"' +Number(registros[i]["factura_id"])+ '",';
                            row += '"' +numberFormat(Number(registros[i]["venta_total"]).toFixed(decimales))+ '",';
                            if(lamoneda_id == 1){
                                total_otram = Number(registros[i]["venta_total"])/Number(registros[i]["tipo_cambio"])
                                //total_otramoneda += total_otram;
                            }else{
                                total_otram = Number(registros[i]["venta_total"])*Number(registros[i]["tipo_cambio"])
                                //total_otramoneda += total_otram;
                            }
                            row += '"' +numberFormat(Number(total_otram).toFixed(decimales))+ '",';
                            row += '"' +registros[i]["tipotrans_nombre"]+ '",';
                            row += '"' +moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["venta_hora"]+ '",';
                            row += '"' +registros[i]["usuario_nombre"]+ '",';
                            
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
                    
        }
}