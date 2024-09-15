function actualizar_cantidad(cantidad, detallecons_id)
{
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'pensionados/actualizar_cantidad';
    //let decimales = 2;

        
        $.ajax({url: controlador,
                type:"POST",
                data:{cantidad:cantidad, detallecons_id:detallecons_id},
                success:function(respuesta){

                    var registros =  JSON.parse(respuesta);
                    reg = registros[0];
                   // alert(reg["detallecons_cantidad"]);
                    $("#cantidad"+detallecons_id).val(Number(reg["detallecons_cantidad"]).toFixed(2));
                    $("#precio"+detallecons_id).val(Number(reg["detallecons_precio"]).toFixed(2));
                    $("#total"+detallecons_id).val(Number(reg["detallecons_total"]).toFixed(2));

                },
                error:function(respuesta){
                   // alert("Algo salio mal...!!!");
                   html = "";
                   $("#tablaresultados").html(html);
                },
                complete: function (jqXHR, textStatus) {
//                    document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                    //tabla_inventario();
                }
        });

}

function reducir(detallecons_id){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'pensionados/generar_orden';
    let cantidad = document.getElementById('cantidad'+detallecons_id).value;
    
    if (cantidad > 1){
        
        actualizar_cantidad(-1, detallecons_id);
        
    }
}

function incrementar(detallecons_id){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'pensionados/generar_orden';
    let cantidad = document.getElementById('cantidad'+detallecons_id).value;
    let disponible = document.getElementById('saldoanterior'+detallecons_id).value; //document.getElementById('disponible'+detallecons_id).value;
    
    if (Number(cantidad) < Number(disponible)){
        cantidad = Number(cantidad) + 1;
        actualizar_cantidad(1, detallecons_id);
        
    }
}

function habilitar_preferencias(detallecons_id){
    
    $("#preferencias"+detallecons_id)
        .css("background-color", "#e7e7e7") // Cambia el color de fondo a gris
        .prop("readonly", false); // Bloquea el input con readonly

}

function guardar_preferencias(detallecons_id){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'pensionados/guardar_preferencias';
    let preferencias = document.getElementById('preferencias'+detallecons_id).value;
    
    
        $.ajax({url: controlador,
                type:"POST",
                data:{preferencias:preferencias, detallecons_id:detallecons_id },
                success:function(respuesta){

                    var registros =  JSON.parse(respuesta);
                    reg = registros[0];

                    $("#preferencias"+detallecons_id).val(reg["detallecons_preferencia"])                    
                    .css("background-color", "gray") // Cambia el color de fondo a gris
                    .prop("readonly", true); // Bloquea el input con readonly

                },
                error:function(respuesta){
                   // alert("Algo salio mal...!!!");
                   html = "";
                   $("#tablaresultados").html(html);
                },
                complete: function (jqXHR, textStatus) {
//                    document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                    //tabla_inventario();
                }
        });
}

function generar_orden(pensionado_id)
{
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'pensionados/generar_orden';
    let decimales = 2;
    
    let answer = window.confirm("¿Esta a punto de generar un pedido. Desea continuar?");
    let html = "";


    if (answer) {
        
//        document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
        
        $.ajax({url: controlador,
                type:"POST",
                data:{pensionado_id:pensionado_id},
                success:function(respuesta){
                    var registros =  JSON.parse(respuesta);
                    let consumo =  registros["consumo"];
                    let detalle =  registros["detalle_consumo"];
                    //alert(JSON.stringify(registros));
                    //alert(JSON.stringify(consumo));
                    html += "<table class='table table-striped table-condensed' id='mitabla'>";
                    html += "<tr>";
                    html += "<td colspan='1' style='font-size: 14px;'><fa class='fa fa-user'></fa></td>";
                    html += "<td colspan='5' style='font-size: 14px;'><b>PENSIONADO: </b>"+consumo[0]["cliente_nombre"]+"</td>";
                    html += "</tr>";

                    html += "<tr>";
                    html += "<td colspan='2'></td>";                    
                    html += "<td colspan='2'><b>CODIGO: </b>"+consumo[0]["cliente_codigo"]+"</td>";                    
                    html += "<td colspan='2'><b>REG.: </b>"+consumo[0]["consumo_id"]+"</td>";                    
                    html += "</tr>";
                    
                    
                    html += "<tr>";
                    html += "		<th style='padding: 0; text-align: center;'>#</th>";
                    html += "		<th style='padding: 0; text-align: center;'>ITEM</th>";
                    html += "		<th style='padding: 0; text-align: center;'>CANT</th>";
                    html += "		<th style='padding: 0; text-align: center;'>PRECIO</th>";
                    html += "		<th style='padding: 0; text-align: center;'>TOTAL</th>";
                    html += "		<th style='padding: 0; text-align: center;'>SALDO</th>";
                    html += "</tr>";

                    for(let i=0; i<detalle.length; i++){
                        
                        html += "<tr id='fila"+detalle[i]["detallecons_id"]+"'>";
                        html += "<td style='text-align: right; width: 10px; overflow-wrap: break-word;'>"+(i+1)+"</td>";
                        html += "<td  style='width: 250px; overflow-wrap: break-word;'>"+detalle[i]["producto_nombre"];
                        html += "<button class='btn btn-xs btn-danger' onclick='eliminar_detalle("+detalle[i]["detallecons_id"]+")' title='Eliminar un item del detalle'><fa class='fa fa-times'></fa></button>";
                        
                            html += "<br><div class='btn-group'>      ";   
                            html += "<button style='border-color: lightgray;' onclick='habilitar_preferencias("+detalle[i]["detallecons_id"]+")' class='btn btn-default btn-xs'><span class='fa fa-pencil'></span></button>";
                            html += "<input style='border-color: lightgray;' class='btn btn-default btn-xs' style='width: 200px;' id='preferencias"+detalle[i]["detallecons_id"]+"' value='"+detalle[i]["detallecons_preferencia"]+"'>";
                            html += "<button style='border-color: lightgray;' onclick='guardar_preferencias("+detalle[i]["detallecons_id"]+")' class='btn btn--default btn-xs'><span class='fa fa-floppy-o'></span></button>";
                            html += "</div>";
                        
                        html += "</td>";
                        
                        
                        
                        
                        html += "<td style='text-align: right; width: 130px; overflow-wrap: break-word;'>";
                        
                            html += "<div class='btn-group'>      ";   
                            html += "<button onclick='reducir("+detalle[i]["detallecons_id"]+")' class='btn btn-facebook btn-sm'><span class='fa fa-minus'></span></a></button>";
//                            html += "<span class='btn btn-default  btn-sm'> "+Number(detalle[i]["detallecons_cantidad"]).toFixed(decimales)+"</span>";
                            html += "<input class='btn btn-default btn-sm' size='2' id='cantidad"+detalle[i]["detallecons_id"]+"' value='"+Number(detalle[i]["detallecons_cantidad"]).toFixed(decimales) +"'>";
                            html += "<button onclick='incrementar("+detalle[i]["detallecons_id"]+")' class='btn btn-facebook btn-sm'><span class='fa fa-plus'></span></button>";
                            html += "</div>";
                            
                        html += "</td>";
                        html += "<td style='text-align: right;'><input class='btn btn-default btn-sm' size='2' id='precio"+detalle[i]["detallecons_id"]+"' value='"+Number(detalle[i]["detallecons_precio"]).toFixed(decimales)+"' readonly/></td>";
                        html += "<td style='text-align: right;'><input class='btn btn-default btn-sm' style='background-color: black; color: white;' size='2' id='total"+detalle[i]["detallecons_id"]+"' value='"+Number(detalle[i]["detallecons_total"]).toFixed(decimales)+"' readonly/></td>";
                        html += "<td style='text-align: right; background-color: #dd4b39; color:white;'><input type='hidden' class='btn btn-default btn-sm' size='2' id='saldoanterior"+detalle[i]["detallecons_id"]+"' value='"+Number(detalle[i]["detallecons_saldoanterior"]).toFixed(decimales)+"' readonly/> "+Number(detalle[i]["detallecons_saldoanterior"]).toFixed(decimales)+" </td>";
                        html += "</tr>";
                    }
                    html += "</table>";   
                    
                    $("#tabla_modal").html(html);
                    let consumo_id = consumo[0]["consumo_id"];
                    
                    $("#consumo_id").val(consumo_id);
                    $("#pensionado_id").val(pensionado_id);
                    
                    $("#boton_pensionado").click();

                },
                error:function(respuesta){
                   // alert("Algo salio mal...!!!");
                   html = "";
                   $("#tablaresultados").html(html);
                },
                complete: function (jqXHR, textStatus) {
//                    document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                    //tabla_inventario();
                }
        });
    
    }
}

function eliminar_detalle(detallecons_id){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'pensionados/eliminar_detalle';

    let answer = window.confirm("Esta a punto de eliminar el item. ¿Desea continuar?");

    if (answer) {
        
    
        $.ajax({url: controlador,
                type:"POST",
                data:{detallecons_id:detallecons_id},
                success:function(respuesta){
                    
                    let res = JSON.parse(respuesta);                   
                    //window.open(base_url+"pensionados/comanda_boucher/"+consumo_id, '_blank');
                   document.getElementById("fila"+detallecons_id).style.visibility = "hidden"; 
                    
                },
                error:function(respuesta){
                   // alert("Algo salio mal...!!!");
                   html = "";
                   $("#tablaresultados").html(html);
                },
                complete: function (jqXHR, textStatus) {
//                    document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                    //tabla_inventario();
                }
        });
        
    }
}

function anular_consumo(consumo_id){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'pensionados/anular_consumo';

    let answer = window.confirm("Esta a punto de anular este proceso. ¿Desea continuar?");

    if (answer) {
        
    
        $.ajax({url: controlador,
                type:"POST",
                data:{consumo_id:consumo_id},
                success:function(respuesta){
                    
                    let res = JSON.parse(respuesta);                    
                   location.reload();
                    
                },
                error:function(respuesta){
                   // alert("Algo salio mal...!!!");
                   html = "";
                   $("#tablaresultados").html(html);
                },
                complete: function (jqXHR, textStatus) {
//                    document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                    //tabla_inventario();
                }
        });
        
    }
}

function finalizar_registro(){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'pensionados/finalizar_registro';
    let tiposerv_id = document.getElementById('tiposerv_id').value;
    let consumo_id = document.getElementById('consumo_id').value;
    let consumo_numeromesa = document.getElementById('consumo_numeromesa').value;    
    let pensionado_id = document.getElementById('pensionado_id').value;    
    
        $.ajax({url: controlador,
                type:"POST",
                data:{tiposerv_id:tiposerv_id, consumo_numeromesa:consumo_numeromesa, consumo_id:consumo_id, pensionado_id:pensionado_id },
                success:function(respuesta){
                    
                    let res = JSON.parse(respuesta);
                    location.reload();
                    window.open(base_url+"pensionados/comanda_boucher/"+consumo_id, '_blank');
                    
                    
                },
                error:function(respuesta){
                   // alert("Algo salio mal...!!!");
                   html = "";
                   $("#tablaresultados").html(html);
                },
                complete: function (jqXHR, textStatus) {
//                    document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                    //tabla_inventario();
                }
        });
}