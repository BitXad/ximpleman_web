$(document).on("ready",inicio);
function inicio(){
    //mostrar_grafica();
}

function mostrar_grafica(){
    var nombre_moneda = document.getElementById('nombre_moneda').value;
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
            text: 'Ventas por Usuario ('+nombre_moneda+')'
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
    
    //$("#div_grafica_pie").html( $("#cargador_empresa").html() );
    var base_url    = document.getElementById('base_url').value;
    var tipousuario_id    = document.getElementById('tipousuario_id').value;
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('usuario_id').value;
    let decimales = document.getElementById('decimales').value;
    var controlador = base_url+"reportes/repventa_usuario";
    $.ajax({url: controlador,
            type:"POST",
            data:{fecha_desde:fecha_desde, fecha_hasta:fecha_hasta, usuario_id:usuario_id},
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
                    if(tipousuario_id == 1){
                        /* estas opciones son para la grafica de pastel de Utilidades */
                        var optionsu={
                         // Build the chart
                            chart: {
                                renderTo: 'div_grafica_pieu',
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: 'Utilidades por Usuario ('+nombre_moneda+')'
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
                                name: 'Utilidades',
                                colorByPoint: true,
                                data: []
                            }]
                        }
                        for(i=0;i<=totattipos-1;i++){
                            var utilidadu = Number(Number(tippos[i].totalventas)-Number(tippos[i].totalcosto)).toFixed(decimales);
                            //utilidadu = utilidadu.toString()
                            var idTP=tippos[i].usuario_id;
                            var objeto= {name: tippos[i].usuario_nombre, y:parseFloat(utilidadu) };     
                            optionsu.series[0].data.push( objeto );
                        }
                        //optionsu.title.text="aqui e podria cambiar el titulo dinamicamente";
                        chartu = new Highcharts.Chart(optionsu);
                    }
                    const myString = JSON.stringify(datos.tipos);
                    $("#resproducto").val(myString);
                    
                    var totalventas     = Number(0);
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                    var lamoneda_id   = document.getElementById('lamoneda_id').value;
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
                        html += "<td class='text-right'> "+numberFormat(Number(tippos[j].totalventas).toFixed(decimales))+" </td>";
                        html += "<td class='text-right'> ";
                        if(lamoneda_id == 1){
                            total_otram = Number(tippos[j].totalventas)/Number(tippos[j].tipo_cambio)
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = Number(tippos[j].totalventas)*Number(tippos[j].tipo_cambio)
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                        if(tipousuario_id == 1){
                            var utilidad = Number(tippos[j].totalventas)-Number(tippos[j].totalcosto);
                            totalcostos     += Number(tippos[j].totalcosto);
                            totalutilidades += Number(utilidad);
                            html += "<td class='text-right'> "+numberFormat(Number(tippos[j].totalcosto).toFixed(decimales))+" </td>";
                            html += "<td class='text-right'> "+numberFormat(Number(utilidad).toFixed(decimales))+" </td>";
                        }
                        
                       
                        html += "</tr>";
                       
                    }
                    html += "<tr>";
                        html += "<td></td>";
                        html += "<th class='text-right'>TOTAL:</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(totalventas).toFixed(decimales))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(total_otramoneda).toFixed(decimales))+"</th>";
                        if(tipousuario_id == 1){
                            html += "<th style='text-align:right'>"+numberFormat(Number(totalcostos).toFixed(decimales))+"</th>";
                            html += "<th style='text-align:right'>"+numberFormat(Number(totalutilidades).toFixed(decimales))+"</th>";
                        }
                    html += "</tr>";
                   $("#reportefechadeventa").html(html);
                   /*$("#desde").html(desde1);
                   $("#hasta").html(hasta1);*/
                }
        }
    })
}

function mostrargrafica(){
    if( $('#mosgrafica').prop('checked') ) {
        $("#graficapastel").css("display", "block");
        $("#graficapastelu").css("display", "block");
    }else{
        $("#graficapastel").css("display", "none");
        $("#graficapastelu").css("display", "none");
    }
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
                            row += 'USUARIO' + ',';
                            row += 'VENTAS(' +nombre_moneda+ '),';
                            row += 'VENTAS(';
                            if(lamoneda_id == 1){
                                otramoneda_nombre = lamoneda[1]['moneda_descripcion'];
                            }else{
                                otramoneda_nombre = lamoneda[0]['moneda_descripcion'];
                            }
                            row += otramoneda_nombre+ '),';
                            if(tipousuario_id == 1){
                                row += 'COSTO(' +nombre_moneda+ '),';
                                row += 'UTILIDAD(' +nombre_moneda+ '),';
                            }
                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < tam; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        var utilidad = Number(registros[i].totalventas)-Number(registros[i].totalcosto);
                        //utilidades += Number(utilidad);
                            row += (i+1)+',';
                            row += '"' +registros[i]["usuario_nombre"]+ '",';
                            row += '"' +numberFormat(Number(registros[i]["totalventas"]).toFixed(decimales))+ '",';
                            if(lamoneda_id == 1){
                                total_otram = Number(registros[i]["totalventas"])/Number(registros[i]["tipo_cambio"])
                                //total_otramoneda += total_otram;
                            }else{
                                total_otram = Number(registros[i]["totalventas"])*Number(registros[i]["tipo_cambio"])
                                //total_otramoneda += total_otram;
                            }
                            row += '"' +numberFormat(Number(total_otram).toFixed(decimales))+ '",';
                            if(tipousuario_id == 1){
                                row += '"' +numberFormat(Number(registros[i]["totalcosto"]).toFixed(decimales))+ '",';
                                row += '"' +numberFormat(Number(utilidad).toFixed(decimales))+ '",';
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
