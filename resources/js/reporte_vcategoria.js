$(document).on("ready",inicio);
function inicio(){
    //mostrar_grafica();
}

function mostrar_grafica(){
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
            text: 'Venta por Categorias'
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
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var controlador = base_url+"reportes/repventa_categoria";
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
                        var idTP=tippos[i].categoria_id;
                        var objeto= {name: tippos[i].categoria_nombre, y:numeropublicaciones[idTP] };     
                        options.series[0].data.push( objeto );
                    }
                    //options.title.text="aqui e podria cambiar el titulo dinamicamente";
                    chart = new Highcharts.Chart(options);

                    /*$("#div_grafica_pie").on("click", function(evt) {

                        //mostrar_repventacategoria();
                    });*/
                }
        }
    })
}

function venta_porcategoria(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/buscarrepo";
    var desde    = document.getElementById('fecha_desde').value;
    var hasta    = document.getElementById('fecha_hasta').value;
    var categoria_id = $("#categoria_id option:selected").val();
    var nom_cat = $("#categoria_id option:selected").text();
    /*var tipo     = document.getElementById('tipo_transaccion').value;
    var usuario_id = document.getElementById('usuario_id').value;
    var esventa_preventa = document.getElementById('esventa_preventa').value;*/
    document.getElementById('loader').style.display = 'block';
    
    if (categoria_id==0) {
            lacategoria = "";
    } else {
            lacategoria = "and categoria_id="+categoria_id+" "; 
    }
    /*if (tipo==0) {
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
    }*/
	var filtro = " date(venta_fecha) >= '"+desde+"'  and  date(venta_fecha) <='"+hasta+"' "+lacategoria+" ";

  //simplemente(filtro);
     
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(report){     
              
                            
                $("#enco").val("- 0 -");
               var registros =  JSON.parse(report);
           
               if (registros != null){
                   
                    
                    var cantidades = Number(0);
                    var total = Number(0);
                    var cuotas = Number(0);
                    var costos = Number(0);
                    var utilidades = Number(0);
                    var descuentos = Number(0);
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   
                    html = "";
                 
                    for (var i = 0; i < n ; i++){
                        
                         total += Number(registros[i]["detalleven_total"]);
                         cantidades += Number(registros[i]["detalleven_cantidad"]);
                         cuotas += Number(registros[i]["credito_cuotainicial"]);
                         descuentos += Number(registros[i]["detalleven_descuento"]);
                         costos += Number(registros[i]["detalleven_costo"]);
                         var utilidad = Number((registros[i]["detalleven_precio"]-registros[i]["detalleven_costo"])*registros[i]["detalleven_cantidad"]);
                         utilidades += Number(utilidad);
                        
                        html += "<tr>";
                      
                        html += "<td align='center' style='width:5px;'>"+(i+1)+"</td>";
                        
                        
                        html += "<td> "+registros[i]["producto_nombre"]+" </td>";                                            
                        html += "<td align='center' style='width:110px;'> "+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["venta_hora"]+" </td>";
                        html += "<td align='center'> "+registros[i]["venta_id"]+" </td>";  
                        html += "<td align='center'> "+Number(registros[i]["factura_id"])+" </td>";  // NUMERO FACTURA
                        html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";  
                        html += "<td align='right'>"+Number(registros[i]["credito_cuotainicial"]).toFixed(2)+"</td>" ;// CUOTA INICIAL
                        html += "<td align='center'> "+registros[i]["producto_unidad"]+" </td>";                                          
                        html += "<td align='center'> "+registros[i]["detalleven_cantidad"]+" </td>"; 
                        html += "<td align='right'> "+Number(registros[i]["detalleven_precio"]).toFixed(2)+" </td>"; 
                        html += "<td align='right'> "+Number(registros[i]["detalleven_descuento"]).toFixed(2)+" </td>";
                        
                        html += "<td align='right'><b>"+Number(registros[i]["detalleven_total"]).toFixed(2)+"</b></td>";
                        html += "<td align='right'> "+Number(registros[i]["detalleven_costo"]).toFixed(2)+" </td>";
                        html += "<td align='right'> "+Number(utilidad).toFixed(2)+" </td>"; 
                         
                        
                        
                        html += "<td  align='center'>"+registros[i]["cliente_nombre"]+"</td>"; 
                        html += "<td  align='center'>"+registros[i]["usuario_nombre"]+"</td>"; 
                        html += "<td class='no-print'><a href='"+base_url+"venta/modificar_venta/"+registros[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modifica el detalle/cliente de la venta'><span class='fa fa-edit'></span></a> <a href='"+base_url+"factura/imprimir_recibo/"+registros[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-print'></span></a> </td>";
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(cuotas).toFixed(2))+"</th>";
                        html += "<td></td>";
                        html += "<th>"+numberFormat(Number(cantidades).toFixed(2))+"</td>";
                        html += "<td></td>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(descuentos).toFixed(2))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(total).toFixed(2))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(costos).toFixed(2))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(utilidades).toFixed(2))+"</th>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   desde1 = "Desde: <b>"+moment(desde).format('DD/MM/YYYY')+"</b>";
                   hasta1 = "Hasta: <b>"+moment(hasta).format('DD/MM/YYYY')+"</b>";
                   estacat = "<br>Categoria: <b>"+nom_cat+"</b>";
                   $("#reportefechadeventa").html(html);
                   $("#desde").html(desde1);
                   $("#hasta").html(hasta1);
                   $("#lacategoria").html(estacat);
                   document.getElementById('loader').style.display = 'none';
                   /*$('#modalbuscarproducto').modal('hide');
                    $('#modalbuscarproducto').on('hidden.bs.modal', function () {
                    $('#tablareproducto').html('');
                    });*/
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
