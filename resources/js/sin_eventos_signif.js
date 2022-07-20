$(document).on("ready",inicio);
function inicio(){
    tablaresultadoseventos();
}
function tablaresultadoseventos()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"eventos_significativos/buscar_eventossignificativos";
    /*let parametro = "";
    if(limite == 2){
        parametro = document.getElementById('filtrar').value;
    }else if(limite == 3){
        parametro = "";
    }*/
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                //var color =  "";
                if (registros != null){
                    //var formaimagen = document.getElementById('formaimagen').value;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").html(n);
                    html = "";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td style='padding: 2px;' class='text-center'>"+(i+1)+"</td>";
                        html += "<td style='padding: 2px;'>"+registros[i]['registroeventos_codigo']+"</td>";
                        html += "<td style='padding: 2px;'>"+registros[i]['registroeventos_detalle']+"</td>";
                        html += "<td style='padding: 2px;'>"+registros[i]['registroeventos_fecha']+"</td>";
                        html += "<td style='padding: 2px;'>"+registros[i]['registroeventos_puntodeventa']+"</td>";
                        html += "<td style='padding: 2px;'>"+registros[i]['registroeventos_inicio']+"</td>";
                        html += "<td style='padding: 2px;'>"+registros[i]['registroeventos_fin']+"</td>";
                        /*
                        html += "<td style='padding: 2px;' class='text-center'>";
                        html += moment(registros[i]["ordencompra_fecha"]).format("DD/MM/YYYY");
                        html += "</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['ordencompra_hora']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['proveedor_nombre']+"</td>";
                        html += "<td style='padding: 2px;' class='text-right'>"+registros[i]['ordencompra_totalfinal']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['estado_descripcion']+"</td>";
                        html += "<td style='padding: 2px;' class='no-print'>";
                        html += "<a href='"+base_url+"orden_compra/edit/"+registros[i]["ordencompra_id"]+"' class='btn btn-info btn-xs' title='Modificar orden compra' ><span class='fa fa-pencil'></span></a>&nbsp;";
                        html += "<a class='btn btn-success btn-xs' onclick='mostrar_reciboorden("+registros[i]['ordencompra_id']+")' title='Ver reporte orden compra'><fa class='fa fa-print'></fa></a>&nbsp;";
                        html += "<a class='btn btn-facebook btn-xs' onclick='mostrar_reciboordenp("+registros[i]['ordencompra_id']+")' title='Ver reporte orden compra para proveedor'><fa class='fa fa-print'></fa></a>&nbsp;";
                        if(registros[i]['estado_id'] == 33){
                            html += "<a class='btn btn-danger btn-xs' onclick='modal_ejecutarordencompra("+registros[i]['ordencompra_id']+")' title='Ejecutar orden compra'><fa class='fa fa-bolt'></fa></a>&nbsp;";
                            html += "<a class='btn btn-warning btn-xs' onclick='modal_anularordencompra("+registros[i]['ordencompra_id']+")' title='Anular orden compra'><fa class='fa fa-minus-circle'></fa></a>";
                        }
                        
                        html += "</td>";*/
                        html += "</tr>";
                    }
                    $("#tablaresultados").html(html);
                    document.getElementById('loader').style.display = 'none';
                }
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
}

function registrar_evento(){
        
        let base_url = $("#base_url").val();
        let controlador = `${base_url}eventos_significativos/registroEventoSignificativo`;
        let fecha_inicio =  document.getElementById('ces_fechainicio').value;
        let fecha_fin =  document.getElementById('ces_fechafin').value;
        let cufd_evento =  document.getElementById('select_cufd').value;
        let codigo_evento =  document.getElementById('select_eventos').value;
        let combo = document.getElementById('select_eventos');
        let texto_evento = combo.options[combo.selectedIndex].text;
        
        //alert(fecha_inicio+" ** "+fecha_fin+" ** "+codigo_evento+" ** "+texto_evento);
        fecha_inicio =  fecha_inicio+":"+Math.floor(10+Math.random() * 49)+"."+ Math.floor(Math.random() * 1000);
        fecha_fin =  fecha_fin+":"+Math.floor(10+Math.random() * 49)+"."+ Math.floor(Math.random() * 1000);
        document.getElementById('loader2').style.display = 'block';
        
        $.ajax({
            url: controlador,
            type:"POST",
            data:{
                fecha_inicio: fecha_inicio, fecha_fin:fecha_fin, cufd_evento:cufd_evento,
                codigo_evento:codigo_evento, texto_evento:texto_evento,
            },
            // async: false,
            success: (respuesta)=>{
                
                alert(respuesta);
                tablaresultadoseventos();
                document.getElementById('loader2').style.display = 'none';
                $("#modaleventos").modal("hide");
                
            },
            error: ()=>{
                alert("Ocurrio un error al realizar la verificación del evento, por favor intente en unos minutos")
                document.getElementById('loader').style.display = 'none';
            }
        });
        
        document.getElementById('loader2').style.display = 'none';
    }
    
    function seleccionar_cufd(){
        let base_url = $("#base_url").val();
        let controlador = `${base_url}eventos_significativos/buscar_cufd`;
        let fecha =  document.getElementById('ces_fechainicio').value;
        //document.getElementById('loader').style.display = 'block';
        fecha = fecha.substring(0,10);
       // alert(fecha);
        $.ajax({
            url: controlador,
            type:"POST",
            data:{
                fecha: fecha
            },
            // async: false,
            success: (respuesta)=>{
                let res = JSON.parse(respuesta);
                let html = "";

                for(i=0; i<res.length; i++){                    
                    html += "<option value="+res[i]["cufd_codigo"]+">"+res[i]["cufd_fecharegistro"]+" (PV: "+res[i]["cufd_puntodeventa"]+") "+res[i]["cufd_codigo"]+"</option>"               
                }
                
                $("#select_cufd").html(html);                
                document.getElementById('loader2').style.display = 'none';
            },
            error: ()=>{
                alert("Ocurrio un error al realizar la verificación del evento, por favor intente en unos minutos")
                document.getElementById('loader').style.display = 'none';
            }
        });
    }
