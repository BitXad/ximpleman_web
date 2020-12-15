$(document).on("ready",inicio);
function inicio(){
    //mostrar_grafica();
}

function mostrar_grafica(){
    $("#graficapastel").css("display", "block");
    var options={
     // Build the chart
        chart: {
            renderTo: 'div_grafica_pie',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ventas por Usuario'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Ventas',
            colorByPoint: true,
            data: []
        }]
    }

    $("#div_grafica_pie").html( $("#cargador_empresa").html() );
    var base_url    = document.getElementById('base_url').value;
    var tipousuario_id    = document.getElementById('tipousuario_id').value;
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var controlador = base_url+"reportes/repventa_usuario";
    $.ajax({url: controlador,
            type:"POST",
            data:{fecha_desde:fecha_desde, fecha_hasta:fecha_hasta},
            success:function(respuesta){
                var datos= JSON.parse(respuesta);
                if (datos != null){
                    var tippos=datos.tipos;
                    var totattipos=datos.totaltipos;
                    var numeropublicaciones=datos.numerodepubli;
                    for(i=0;i<=totattipos-1;i++){
                        var idTP=tippos[i].usuario_id;
                        var objeto= {name: tippos[i].usuario_nombre, y:numeropublicaciones[idTP] };     
                        options.series[0].data.push( objeto );
                    }
                    //options.title.text="aqui e podria cambiar el titulo dinamicamente";
                    chart = new Highcharts.Chart(options);
                    
                    const myString = JSON.stringify(datos.tipos);
                    $("#resproducto").val(myString);
                    
                    var totalventas     = Number(0);
                    var totaldescuentos = Number(0);
                    var totalcostos     = Number(0);
                    var totalutilidades = Number(0);
                    html = "";
                    for (var j = 0; j <= totattipos-1 ; j++){
                         totalventas     += Number(tippos[j].totalventas);
                         totaldescuentos += Number(tippos[j].totaldescuento);
                        html += "<tr>";
                      
                        html += "<td align='center' style='width:5px;'>"+(j+1)+"</td>";
                        
                        
                        html += "<td> "+tippos[j].usuario_nombre+" </td>";                                            
                        html += "<td class='text-right'> "+numberFormat(Number(tippos[j].totalventas).toFixed(2))+" </td>";
                        html += "<td class='text-right'> "+numberFormat(Number(tippos[j].totaldescuento).toFixed(2))+" </td>";
                        if(tipousuario_id == 1){
                            var utilidad = Number(tippos[j].totalventas)-(Number(tippos[j].totaldescuento)+Number(tippos[j].totalcosto))
                            totalcostos     += Number(tippos[j].totalcosto);
                            totalutilidades += Number(utilidad);
                            html += "<td class='text-right'> "+numberFormat(Number(tippos[j].totalcosto).toFixed(2))+" </td>";
                            html += "<td class='text-right'> "+numberFormat(Number(utilidad).toFixed(2))+" </td>";
                        }
                        
                       
                        html += "</tr>";
                       
                   }
                   html += "<tr>";
                        html += "<td></td>";
                        html += "<th class='text-right'>TOTAL:</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(totalventas).toFixed(2))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(totaldescuentos).toFixed(2))+"</th>";
                        if(tipousuario_id == 1){
                            html += "<th style='text-align:right'>"+numberFormat(Number(totalcostos).toFixed(2))+"</th>";
                            html += "<th style='text-align:right'>"+numberFormat(Number(totalutilidades).toFixed(2))+"</th>";
                        }
                        html += "</tr>";
                   $("#reportefechadeventa").html(html);
                   /*$("#desde").html(desde1);
                   $("#hasta").html(hasta1);*/
                }
        }
    })
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

function imprimir(){
    window.print();
}

function generarexcel_vusuario(){
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
                            row += 'USUARIO' + ',';
                            row += 'VENTAS' + ',';
                            row += 'DESCUENTOS' + ',';
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
                        var utilidad = Number(registros[i].totalventas)-(Number(registros[i].totaldescuento)+Number(registros[i].totalcosto))
                        //utilidades += Number(utilidad);
                            row += (i+1)+',';
                            row += '"' +registros[i]["usuario_nombre"]+ '",';
                            row += '"' +Number(registros[i]["totalventas"]).toFixed(2)+ '",';
                            row += '"' +Number(registros[i]["totaldescuento"]).toFixed(2)+ '",';
                            if(tipousuario_id == 1){
                                row += '"' +Number(registros[i]["totalcosto"]).toFixed(2)+ '",';
                                row += '"' +Number(utilidad).toFixed(2)+ '",';
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
                    var fileName = "VentaUsuario_";
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
