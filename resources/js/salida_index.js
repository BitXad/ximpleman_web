$(document).on("ready",inicio);
function inicio(){
    tablaresultadossalida(1);

}

function imprimirsalida(){
    
    var estafh = new Date();
    fecha=moment(estafh).format("DD/MM/YYYY H:m:s");
    $('#fhimpresion').html(fecha);
    $("#cabeceraprint").css("display", "");
    window.print();
    $("#cabeceraprint").css("display", "none");
    
}

function buscarnumero(e) {
    
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadossalida(2);
    }
}

function tablaresultadossalida(lim){
    
    var controlador = "";
    var parametro = "";
    var base_url = document.getElementById('base_url').value;
    //var rolusuario = JSON.parse(document.getElementById('esrolusuario').value);
    var categoriaestado = "";
    
    
    if(lim == 1){
        controlador = base_url+'salida/buscar50salida/';

    }else if(lim == 2){
        var unidad_id = document.getElementById('unidad_id').value;
        var programa_id = document.getElementById('programa_id').value;
        var estado_id    = document.getElementById('estado_id').value;
        if(unidad_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and s.unidad_id = "+unidad_id+" ";
           
        }
        if(programa_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and s.programa_id = "+programa_id+" ";
          
        }
         if(estado_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and s.estado_id = "+estado_id+" ";
           
        }
        parametro = document.getElementById('filtrar').value;
        controlador = base_url+'salida/buscarporsalida/';

    }
     //parametro = document.getElementById('filtrar').value;   
     //controlador = base_url+'salida/buscarallsalida/';
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, categoria:categoriaestado},
           success:function(respuesta){
                                   
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   /*if (n <= limite) x = n; 
                   else x = limite;*/
                    
                    for (var i = 0; i < n ; i++){
                            var colorbaja = "style='background-color:"+registros[i]["estado_color"]+"'";
                        html += "<tr "+colorbaja+">";
                        
                        html += "<td>"+(i+1)+"</td>";
                        if(registros[i]["unidad_nombre"]=="" || registros[i]["unidad_nombre"]==null ){
                            html += "<td><span class='btn-danger'>SIN MOTIVO</span>";
                            html += "<sub>"+registros[i]["programa_id"]+"</sub>";
                            html += "<br>"+registros[i]["programa_nombre"]+"</td>";
                        }else{
                            html += "<td><font size='3' face='Arial'><b>"+registros[i]["unidad_nombre"]+"</font></b>";
                            html += "<sub>["+registros[i]["programa_id"]+"]</sub>";
                            html += "<br>"+registros[i]["programa_nombre"]+"</td>";
                        }
                        html += "<td style='text-align: center'><font size='3' face='Arial'><b>";
                        html += registros[i]["salida_doc"]+"</b></font><br>";
                        html += moment(registros[i]["salida_fechasal"]).format("DD/MM/YYYY");
                        html += "</td>";
                        html += "<td ><center>"+moment(registros[i]["salida_fecha"]).format("DD/MM/YYYY")+"</center></td>";
                        html += "<td ><center><font size='3' face='Arial'><b>"+registros[i]["gestion_nombre"]+"</b></font><sub>"+registros[i]["salida_id"]+"</sub></center></td>";
                        html += "<td><center><img src='"+base_url+"resources/images/usuarios/"+registros[i]["usuario_imagen"]+"' width='40' height='40' class='img-circle no-print'>";
                        html +=" <br>"+registros[i]["usuario_nombre"]+"</center></td>";
                        html += "<td class='no-print'>"+registros[i]["salida_acta"]+"</td>";
                        html += "<td class='no-print'>"+registros[i]["salida_obs"]+"</td>";
                        html += "<td style='text-align: center'> "+registros[i]["estado_descripcion"]+"<br>";
                        html += moment(registros[i]["salida_fechasal"]).format("DD/MM/YYYY");
                        html += " "+registros[i]["salida_hora"]+"</td>";
                        html += "<td class='no-print'>";
                        var nopermiso = "";
                        //if(rolusuario[30-1]['rolusuario_asignado'] ==0){
                         //   nopermiso = "disabled";
                        //}
                        if(registros[i]["estado_id"] !=5){
                            html += "<a href='"+base_url+"salida/modificar_salida/"+registros[i]["salida_id"]+"' class='btn btn-info btn-xs "+nopermiso+"' title='EDITAR'><span class='fa fa-pencil'></span></a>";
                        }
                        
                        html += "<a href='"+base_url+"salida/pdf/"+registros[i]["salida_id"]+"' class='btn btn-success btn-xs' target='_blank' title='IMPRIMIR'><span class='fa fa-print'></span></a>";
                        //html += "<a href='"+base_url+"salida/eliminar/"+registros[i]["salida_id"]+"' class='btn btn-danger btn-xs' title='ELIMINAR'><span class='fa fa-trash'></span></a>";
                        if(registros[i]["estado_id"] !=5){
                            html += "<a data-toggle='modal' data-target='#myModal"+registros[i]["salida_id"]+"'  title='ELIMINAR' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";
                        }
                        html += "<!-- ---------------------- INICIO modal para confirmar eliminación ----------------- -->";
                        html += "<div class='modal fade' id='myModal"+registros[i]["salida_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b> <span class='fa fa-trash'></span></b>";
                        html += "¿Desea eliminar el salida con No. <b> "+registros[i]["salida_doc"]+"</b>?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"salida/anular_salida/"+registros[i]["salida_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para confirmar eliminación ----------------- -->";
                        //html += "<a data-toggle='modal' data-target='#myModal"+registros[i]["pedido_id"]+"'  title='Eliminar' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";
                        //}
                        
                        
                        html += "</td>";
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

function generarexcel(lim){
    
    var controlador = "";
    var parametro = "";
    var base_url = document.getElementById('base_url').value;
    var categoriaestado = "";
    
    
    if(lim == 1){
        controlador = base_url+'salida/buscar50salida/';

    }else if(lim == 2){
        var unidad_id = document.getElementById('unidad_id').value;
        var programa_id = document.getElementById('programa_id').value;
        var estado_id    = document.getElementById('estado_id').value;
        if(unidad_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += "and s.unidad_id = u.unidad_id and u.unidad_id = "+unidad_id+" ";
           
        }
        if(programa_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += "and  s.programa_id = p.programa_id and p.programa_id = "+programa_id+" ";
          
        }
         if(estado_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and s.estado_id = "+estado_id+" ";
           
        }
        parametro = document.getElementById('filtrar').value;
        controlador = base_url+'salida/buscar_salidaexcel/';

    }
     //parametro = document.getElementById('filtrar').value;   
     //controlador = base_url+'salida/buscarallsalida/';
    var showLabel = true;
    
    var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, categoria:categoriaestado},
           success:function(respuesta){
                                   
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                  /* **************INICIO Generar Excel JavaScript************** */
                    var CSV = 'sep=,' + '\r\n\n';
                    //This condition will generate the Label/Header
                    if (showLabel) {
                        var row = "";

                        //This loop will extract the label from 1st index of on array
                        

                            //Now convert each value to string and comma-seprated
                            row += 'Programa' + ',';
                            row += 'Numero Doc.' + ',';
                            row += 'Monto Total' + ',';
                            row += 'Usuario' + ',';
                            row += 'Estado' + ',';
                            row += 'Fecha salida' + ',';

                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < registros.length; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        
                            row += '"' + registros[i]["programa_nombre"] + '",';
                            row += '"' + registros[i]["salida_numdoc"] + '",';
                            row += '"' + registros[i]["salida_total"] + '",';
                            row += '"' + registros[i]["usuario_nombre"] + '",';
                            row += '"' + registros[i]["estado_descripcion"] + '",';
                            row += '"' + registros[i]["salida_fecha_ing"] + '",';
                        

                        row.slice(0, row.length - 1);

                        //add a line break after each row
                        CSV += row + '\r\n';
                    }
                    
                    if (CSV == '') {        
                        alert("Invalid data");
                        return;
                    }
                    
                    //Generate a file name
                    var fileName = "salida_";
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

function eliminar(salida_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'salida/eliminar/';
    //alert(salida_id);
        $.ajax({url: controlador,
            type:"POST",
            data:{salida_id:salida_id},
            success:function(respuesta){
                       tablaresultadossalida(2);
             },
            error:function(respuesta){
                alert("hola");
           tablaresultadossalida(1);
                    
} 
            });   
 
}
