$(document).on("ready",inicio);
function inicio(){
        
        
        mostrar_grafica(); 
        
        
}

function cambiar_fecha_grafica(){

    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();

    cargar_grafica_barras(anio_sel,mes_sel);
    cargar_grafica_lineas(anio_sel,mes_sel);
    cargar_grafica_pie(anio_sel,mes_sel);
}


function mostrar_grafica(){

        var hoy = new Date();
        
    var anio_sel = hoy.getFullYear();
    var mes_sel = hoy.getMonth()+1;
    $("#anio_sel").val(anio_sel);
    $("#mes_sel").val(mes_sel);
    //alert(anio_sel+" - "+mes_sel);
    cargar_grafica_barras(anio_sel,mes_sel);
    cargar_grafica_lineas(anio_sel,mes_sel);
    cargar_grafica_pie(anio_sel,mes_sel);
}

function cargar_grafica_barras(anio,mes){

    var empresa = document.getElementById('empresa_nombre').value;
    

var options={
	 chart: {
            renderTo: 'div_grafica_barras',
            type: 'column'
        },
        title: {
            text: 'Compras/Ventas del Mes'
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
	
	options.series[0].data.push( Math.round(registrosdia[i]*100)/100 );
	
    options.series[1].data.push( Math.round(registrosven[i]*100)/100 );
    
    options.xAxis.categories.push(i);



	}


 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);
}
})


}



function cargar_grafica_lineas(anio,mes){
    var empresa = document.getElementById('empresa_nombre').value;
    

var options={
     chart: {
            renderTo: 'div_grafica_lineas'
           
        },
          title: {
            text: 'Ventas del Mes',
            x: -20 //center
        },
        subtitle: {
            text: empresa,
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: 'REGISTROS POR DIA'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' registros'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
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

$("#div_grafica_lineas").html( $("#cargador_empresa").html() );
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
    
    options.series[0].data.push( Math.round(registrosdia[i]*100)/100 );
    
    options.series[1].data.push( Math.round(registrosven[i]*100)/100 );
    options.xAxis.categories.push(i);


    }
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);
}

})


}




function cargar_grafica_pie(anio,mes){

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
                text: 'Ventas del mes'
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
var controlador = base_url+"reportes/torta/"+anio+"/"+mes+"";
$.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
var datos= JSON.parse(respuesta);
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
}
})




}

