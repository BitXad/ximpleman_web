$(document).on("ready",inicio);
function inicio(){
    tabla_objetivos();
}

function tabla_objetivos(){
    
    
    var decimales = Number(document.getElementById('parametro_decimales').value);
    var base_url = document.getElementById('base_url').value;
    var controlador  = base_url+"objetivo/objetivos_mes";
    var fecha = document.getElementById('fecha').value;
    
    var dia = fecha.substr(8,9);
    var mes  = fecha.substr(5,2);
    var anio  = fecha.substr(0,4);
    // console.log(fecha);
    // console.log(dia);
    // console.log(mes);
    // console.log(anio);
    
    $.ajax({url: controlador,
        type:"POST",
        data:{dia:dia, mes:mes, anio:anio},
        success:function(result){ 
            var resultado =  JSON.parse(result);
            //alert(JSON.stringify(resultado));
            console.log(resultado);
            
            if(resultado != null){
                
                console.log(resultado["objetivos"]["usuario_nombre"]);
                html= "";
                n = resultado["objetivos"].length;
                for(i = 0; i < n; i++){
                    html += "<tr>";
                        html += "<td>";
                            html += i+1;
                        html += "</td>";
                        
                        html += "<td>";
                        html += "<center>";
                            html += "<img src='./resources/images/usuarios/"+"thumb_"+resultado["objetivos"][i]['usuario_imagen']+"' width='40' height='40' class='img-circle'";
                        html += "</center>";
                        html += "</td>";
                        
                        html += "<td>";
                            html += "<font face='Arial' size='3'><b>"+resultado["objetivos"][i]["usuario_nombre"]+"</b></font><br>";
                            html += resultado["objetivos"][i]["tipousuario_descripcion"];
                        html += "</td>";
                        
                        html += "<td class='text-center' style='font-size: 9pt'>";
                            html += "<span>";
                            if(resultado["ventas_dia"]){
                                var tamanio_v_dia_min = resultado["objetivos"].length;
                                for(var j = 0; j < tamanio_v_dia_min; j++){
                                    if(resultado["ventas_dia"][j]){
                                        if(resultado["ventas_dia"][j]["usuario_id"] == resultado["objetivos"][i]["usuario_id"]){
                                            html += Number(resultado["ventas_dia"][j]["total_dia"]).toFixed(decimales)+" / ";
                                            html += Number(resultado["objetivos"][i]["objetivo_minimo"]).toFixed(decimales);
                                            j = tamanio_v_dia_min;
                                        }
                                    }else{
                                        html += "0 / ";
                                        html += Number(resultado["objetivos"][i]["objetivo_minimo"]).toFixed(decimales);
                                        j = tamanio_v_dia_min;
                                    }
                                }
                            }else{
                                html += "0 / ";
                                html += resultado["objetivos"][i]["objetivo_minimo"];
                                alert(3);
                            }
                            html += "</span>";
                        html += "</td>";
                        html += "<td class='text-center' style='font-size: 9pt'>";
                            html += "<span>";
                            if(resultado["ventas_dia"]){
                                var tamanio_v_dia_a = resultado["objetivos"].length;
                                for(var j = 0; j < tamanio_v_dia_a; j++){
                                    if(resultado["ventas_dia"][j]){
                                        if(resultado["ventas_dia"][j]["usuario_id"] == resultado["objetivos"][i]["usuario_id"]){
                                            html += Number(resultado["ventas_dia"][j]["total_dia"]).toFixed(decimales)+" / ";
                                            html += Number(resultado["objetivos"][i]["objetivo_aceptable"]).toFixed(decimales);
                                            j = tamanio_v_dia_a;
                                        }
                                    }else{
                                        html += "0 / ";
                                        html += resultado["objetivos"][i]["objetivo_aceptable"];
                                        j = tamanio_v_dia_a;
                                    }
                                }
                            }else{
                                html += "0 / ";
                                html += resultado["objetivos"][i]["objetivo_aceptable"];
                                alert(3);
                            }
                            html += "</span>";
                        html += "</td>";
                        html += "<td class='text-center' style='font-size: 9pt'>";
                            html += "<span>";
                            if(resultado["ventas_dia"]){
                                var tamanio_v_dia = resultado["objetivos"].length;
                                for(var j = 0; j < tamanio_v_dia; j++){
                                    if(resultado["ventas_dia"][j]){
                                        if(resultado["ventas_dia"][j]["usuario_id"] == resultado["objetivos"][i]["usuario_id"]){
                                            html += Number(resultado["ventas_dia"][j]["total_dia"]).toFixed(decimales)+" / ";
                                            html += Number(resultado["objetivos"][i]["objetivo_diario"]).toFixed(decimales);
                                            j = tamanio_v_dia;
                                        }
                                    }else{
                                        html += "0 / ";
                                        html += resultado["objetivos"][i]["objetivo_diario"];
                                        j = tamanio_v_dia;
                                    }
                                }
                            }else{
                                html += "0 / ";
                                html += resultado["objetivos"][i]["objetivo_diario"];
                                alert(3);
                            }
                            html += "</span>";
                        html += "</td>";
                        html += "<td class='text-center' style='font-size: 9pt'>";
                            html += "<span>";
                            if(resultado["ventas_mes"]){
                                var tamanio_v_mes = resultado["objetivos"].length;
                                for(var j = 0; j < tamanio_v_mes; j++){
                                    if(resultado["ventas_mes"][j]){
                                        if(resultado["ventas_mes"][j]["usuario_id"] == resultado["objetivos"][i]["usuario_id"]){
                                            html += Number(resultado["ventas_mes"][j]["total_mes"]).toFixed(decimales)+" / ";
                                            html += Number(resultado["objetivos"][i]["objetivo_mes"]).toFixed(decimales);
                                            j = tamanio_v_mes;
                                        }
                                    }else{
                                        html += "0 / ";
                                        html += Number(resultado["objetivos"][i]["objetivo_mes"]).toFixed(decimales);
                                        j = tamanio_v_mes;
                                    }
                                }
                            }else{
                                html += "0 / ";
                                html += Number(resultado["objetivos"][i]["objetivo_mes"]).toFixed(decimales);
                                alert(3);
                            }
                            html += "</span>";
                        html += "</td>";
                        html += "<td class='text-center' style='font-size: 9pt'>";
                            html += "<span>";
                            if(resultado["pedidos_dia"]){
                                var tamanio_p_dia = resultado["objetivos"].length;
                                for(var j = 0; j < tamanio_p_dia; j++){
                                    if(resultado["pedidos_dia"][j]){
                                        if(resultado["pedidos_dia"][j]["usuario_id"] == resultado["objetivos"][i]["usuario_id"]){
                                            html += Number(resultado["pedidos_dia"][j]["pedido_dia"]).toFixed(decimales)+" / ";
                                            html += Number(resultado["objetivos"][i]["objetivo_pedido"]).toFixed(decimales);
                                            j = tamanio_p_dia;
                                        }
                                    }else{
                                        html += "0 / ";
                                        html += Number(resultado["objetivos"][i]["objetivo_pedido"]).toFixed(decimales);
                                        j = tamanio_p_dia;
                                    }
                                }
                            }else{
                                html += "0 / ";
                                html += Number(resultado["objetivos"][i]["objetivo_pedido"]).toFixed(decimales);
                                // alert(3);
                            }
                            html += "</span>";
                        html += "</td>";
                        html += "<td class='text-center' style='font-size: 9pt'>";
                            html += "<span>";
                            if(resultado["pedidos_mes"]){
                                var tamanio_p_mes = resultado["objetivos"].length;
                                for(var j = 0; j < tamanio_p_mes; j++){
                                    if(resultado["pedidos_mes"][j]){
                                        if(resultado["pedidos_mes"][j]["usuario_id"] == resultado["objetivos"][i]["usuario_id"]){
                                            html += Number(resultado["pedidos_mes"][j]["pedido_mes"]).toFixed(decimales)+" / ";
                                            html += Number(resultado["objetivos"][i]["objetivo_pedido_mes"]).toFixed(decimales);
                                            j = tamanio_p_mes;
                                        }
                                    }else{
                                        html += "0 / ";
                                        html += Number(resultado["objetivos"][i]["objetivo_pedido_mes"]).toFixed(decimales);;
                                        j = tamanio_p_mes;
                                    }
                                }
                            }else{
                                html += "0 / ";
                                html += Number(resultado["objetivos"][i]["objetivo_pedido_mes"]).toFixed(decimales);
                                // alert(3);
                            }
                            html += "</span>";
                        html += "</td>";
                        
                        html += "<td class='text-center' style='font-size: 9pt; background: #"+resultado["objetivos"][i]["estado_color"]+"'>";
                        html += "<span>"+resultado["objetivos"][i]["estado_descripcion"]+"</span>";
                        html += "</td>";
                        
                        html += "<td class='text-center' style='font-size: 9pt'>";                            
                            html += "<a href='"+base_url+"objetivo/edit/"+resultado["objetivos"][i]["objetivo_id"]+"' class='btn btn-info btn-xs' title='Modificar datos de usuario'><span class='fa fa-pencil'></span></a>";
                            // html += "<a href='"+base_url+"objetivo/objgrafica/"+resultado["objetivos"][i]["usuario_id"]+"' class='btn btn-warning btn-xs' title='Ver Grafica mensual'><i class='fa fa-bar-chart' aria-hidden='true'></i></a>";
                            // html += "<button type='button' class='btn btn-xs btn-warning' data-toggle='modal' data-target='#grafica_usuario"+resultado["objetivos"][i]["usuario_id"]+"' onclick='cargar_grafica_barras_user("+anio+","+mes+","+resultado["objetivos"][i]["usuario_id"]+")'><i class='fa fa-bar-chart' aria-hidden='true'></i></button>";
                            html += "<button type='button' class='btn btn-xs btn-warning' data-toggle='modal' data-target='#grafica_usuario"+resultado["objetivos"][i]["usuario_id"]+"' onclick='cargar_grafica_barras_user("+anio+","+mes+","+resultado["objetivos"][i]["usuario_id"]+")'><i class='fa fa-bar-chart' aria-hidden='true'></i></button>";
                            
                            html += "<div id='grafica_usuario"+resultado["objetivos"][i]["usuario_id"]+"' class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel'>";
                                html += "<div class='modal-dialog modal-lg'>";
                                    html += "<div class='modal-content'>";
                                        html += "<div class='modal-header'>";
                                            html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                                            html += "<h4 class='modal-title'>"+resultado["objetivos"][i]["usuario_nombre"]+"</h4>";
                                        html += "</div>";
                                        html += "<div class='modal-body'>";
                                            html += "<div class='row'>";
                                                html += "<div id='grafica_usuario_objetivo"+resultado["objetivos"][i]["usuario_id"]+"'  class='col-md-8' ></div>";
                                            html += "</div>";
                                        html += "</div>";
                                    html += "</div>";
                                html += "</div>";
                            html += "</div>";
                        html += "</td>";
                    html += "</tr>";
                }

            }
            $("#tabla_objetivos").html(html);
        },
        error:function(result){
            alert("Algo salio mal...!!!");
            // html = "";
            // $("#reportefechadeventa").html(html);
        }
    });
}

function cargar_grafica_barras_user(anio,mes,user_id){ 
    var meses  = ['ENERRO', 'FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
    var empresa = document.getElementById('empresa_nombre').value;
    var aux = 'grafica_usuario_objetivo'+user_id;
    var options={ 
        chart: { 
                renderTo: aux, 
                type: 'column' 
            }, 
            title: { 
                text: 'Pedidos / Ventas del Mes' 
            }, 
            subtitle: { 
                text: empresa 
            }, 
            xAxis: { 
                categories: [], 
                title: { 
                    text: 'DIAS DEL MES '+meses[mes-1]+''
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
                name: 'Pedidos', 
                data: [] 
            },{ 
                color: 'blue', 
                name: 'Ventas', 
                data: []  
            }] 
    }
    // console.log(aux);
    // $(aux).html( $("#cargador_empresa").html() ); 
    
    // $("#grafica_usuario_objetivo").click(); 
    var base_url    = document.getElementById('base_url').value; 
    var controlador = base_url+"objetivo/mes_usuario_objetivo/"+anio+"/"+mes+"/"+user_id+""; 
    // var controlador = base_url+"reportes/mes/"+anio+"/"+mes; 
    $.ajax({url: controlador, 
        type:"POST", 
        data:{}, 
        success:function(respuesta){ 
            // console.log(user_id); 
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
                // html = "";
                // html += "Hola"+mes+" "+anio+" "+user_id+"";
                // $(aux).html( $("#cargador_empresa").html() ); 

            } 
        }); 
}
