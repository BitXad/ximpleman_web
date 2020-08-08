/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on("ready",inicio);

function inicio()
{
    grafico_ventas();
}

function grafico_barras(year, moth){
  var empresa =  "MI EMPRESA"; //document.getElementById('empresa_nombre').value;
  
  
    var options={
	 chart: {
            renderTo: 'div_grafica_barras',
            type: 'column'
        },
        title: {
            text: 'Ventas Mensuales'
        },
        subtitle: {
            text: empresa
        },
        xAxis: {
            categories: [],
             title: {
                text: 'dias del mes'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'REGISTROS AL DIA'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            color: 'red',
            name: 'Compras',
            data: []

        },{
           color: 'blue',
            name: 'Ventas',
            data: [] 
        }]
    }
    
    $("#div_grafica_barras").html( $("#cargador_empresa").html() );
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"reportes/mes/"+anio+"/"+mes+"";
    $.ajax({url: controlador,
               type:"POST",
               data:{},
               success:function(respuesta){
    var datos= JSON.parse(respuesta);
    var totaldias=datos.totaldias;
    var registrosdia=datos.registrosdia;
    var registrosven=datos.registrosven;
    var i=0;
            for(i=1;i<=totaldias;i++){
                alert("Quiii");
        options.series[0].data.push( Math.round(registrosdia[i]*100)/100 );

        options.series[1].data.push( Math.round(registrosven[i]*100)/100 );

        options.xAxis.categories.push(i);

            }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
     chart = new Highcharts.Chart(options);
    }
    })

    
}


function grafico_ventas(){
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"estadistica/ventas_mes";
    var mes = document.getElementById("select_mes").value;
    var anio = document.getElementById("select_anio").value;    
    var empresa =  document.getElementById('empresa_nombre').value;
    var tipo_grafico =  document.getElementById("select_tipo").value;
  
    var options={
	 chart: {
            renderTo: 'div_grafica_barras',
            type: tipo_grafico,
           
        },
        title: {
            text: 'Ventas mensuales'
        },
        subtitle: {
            text: empresa
        },
        xAxis: {
            categories: [],
             title: {
                text: 'Dias del mes'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ventas por dia'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            color: 'brown',
            name: 'ventas',
            data: []

        },{
           color: 'orange',
            name: 'Utilidades',
            data: [] 
        }]
    }
    
    //$("#div_grafica_barras").html( $("#cargador_empresa").html() );

    
    $.ajax({url: controlador,
               type:"POST",
               data:{mes:mes, anio:anio},
               success:function(respuesta){
                   
                    var datos = JSON.parse(respuesta);
                    var totaldias = datos.totaldias;
                    var ventas = datos.totalventas;
                    var utilidades = datos.totalutilidades;
                    var total_ventas = 0;
                    var total_utilidades = 0;
                    
                    var i = 0;
                    html = "";   
                    html2 = "";   
                      
                    for(i=1; i <= totaldias; i++){
                                //alert(Math.round(ventas[i]*100)/100);
                                
                        options.series[0].data.push( Math.round(ventas[i]*100)/100 );
                        options.series[1].data.push( Math.round(utilidades[i]*100)/100 );
                        options.xAxis.categories.push(i);
                        
                        html += "<tr style='padding:0'>";
                        html += "<td style='padding:0'>"+i+"/"+mes+"/"+anio+"</td>";
                        html += "<td style='padding:0; text-align:right;'>"+Number(ventas[i]).toFixed(2)+"</td>";
                        html += "<td style='padding:0; text-align:right;'>"+Number(utilidades[i]).toFixed(2)+"</td>";
                        html += "</tr>";
                        
                        total_ventas += Number(ventas[i]);
                        total_utilidades += Number(utilidades[i]);

                    }
                    //alert("aquiii33333333332");  
                    html += "<tr style='padding:0'>";
                    html += "   <th style='padding:0'> </th>";
                    html += "   <th style='padding:0;'>"+Number(total_ventas).toFixed(2)+"</th>";
                    html += "   <th style='padding:0;'>"+Number(total_utilidades).toFixed(2)+"</th>";
                    html += "</tr>";                 
                    
                    html2 +="<table id='mitabla'>";
                    html2 +="<tr>";
                    html2 +="   <th style='padding:0;'>Detalle</th>";
                    html2 +="   <th style='padding:0;'>Totales</th>";
                    html2 +="   <th style='padding:0;'>Promedio</th>";
                   
                    html2 +="</tr>";
                    
                    html2 +="<tr>";
                    html2 +="   <td style='padding:0; text-align:right;'><b>VENTAS Bs</b></td>";
                    html2 +="   <td style='padding:0;text-align:right;'>"+total_ventas.toFixed(2)+"</td>";
                    html2 +="   <td style='padding:0;text-align:right;'>"+Number(total_ventas/totaldias).toFixed(2)+"</td>";
                    html2 +="</tr>";
                    
                    html2 +="<tr>";
                    html2 +="   <td style='padding:0; text-align:right;'><b>UTILIDADES Bs</b></td>";
                    html2 +="   <td style='padding:0; text-align:right;'>"+total_utilidades.toFixed(2)+"</td>";  
                    html2 +="   <td style='padding:0; text-align:right;'>"+Number(total_utilidades/totaldias).toFixed(2)+"</td>";
                    html2 +="</tr>";
                    html2 +="</table>";
                    
                    
                    //options.title.text="aqui e podria cambiar el titulo dinamicamente";
                    chart = new Highcharts.Chart(options);
                    
                    $("#div_grafica_barras").html( $("#cargador_empresa").html() );
                    $("#tabla_ventas").html(html);
                    $("#tabla_estadistica").html(html2);
                }   
    });





    
}
