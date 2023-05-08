$(document).on("ready",inicio);
function inicio(){
    tablaresultadosingreso(1);

}
function imprimiringreso(){
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
        tablaresultadosingreso(2);
    }
}

function tablaresultadosingreso(lim){
    var controlador = "";
    var parametro = "";
    var base_url = document.getElementById('base_url').value;
    var rolusuario = JSON.parse(document.getElementById('esrolusuario').value);
    var categoriaestado = "";
    
    var decimales = document.getElementById('decimales').value;
    
    
    if(lim == 1){
        controlador = base_url+'ingreso/buscar50ingreso/';

    }else if(lim == 2){
        var unidad_id = document.getElementById('unidad_id').value;
        var programa_id = document.getElementById('programa_id').value;
        var estado_id    = document.getElementById('estado_id').value;
        if(unidad_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += "and p.unidad_id = u.unidad_id and u.unidad_id = "+unidad_id+" ";
           
        }
        if(programa_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += "and  i.programa_id = prog.programa_id and prog.programa_id = "+programa_id+" ";
          
        }
         if(estado_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and i.estado_id = "+estado_id+" ";
           
        }
        parametro = document.getElementById('filtrar').value;
        controlador = base_url+'ingreso/buscarporingreso/';

    }
     //parametro = document.getElementById('filtrar').value;   
     //controlador = base_url+'ingreso/buscarallingreso/';
    
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
                        if(registros[i]["programa_nombre"]=="" || registros[i]["programa_nombre"]==null ){
                        html += "<td style='font-size:12px;'><span class='btn-danger'>SIN PROGRAMA</span></td>";
                        }else{
                        html += "<td style='font-size:12px;'><b>"+registros[i]["programa_nombre"]+"</b><sub>["+registros[i]["programa_id"]+"]</sub></td>";
                        }
                        html += "<td style='text-align: center'><font size='3'><b>";
                        
                        html += registros[i]["ingreso_numdoc"]+"</b></font><br>";
                        
                        if (registros[i]["ingreso_numdoc"]=='0'){
                            
                             html += "INV. INIC.";                           
                        }else{
                             html += "ID: "+registros[i]["ingreso_id"]+"</b></font><br>";                           
                        }
                        html += moment(registros[i]["ingreso_fecha_ing"]).format("DD/MM/YYYY");
                        html += "</td>";
                       
                        html += "<td style='text-align: right; font-size:12px;'>"+Number(registros[i]["ingreso_total"]).toFixed(decimales)+"</td>";
                        html += "<td style='text-align: center;'>"+registros[i]["responsable_nombre"]+"</td>";
                        html += "<td style='text-align: center'>"+registros[i]["estado_descripcion"]+"<br>";
                        html += moment(registros[i]["ingreso_fecha"]).format("DD/MM/YYYY");
                        html += " "+registros[i]["ingreso_hora"]+"</td>";
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td>";
                        html += "<td class='no-print'>";
                        var nopermiso = "";
                        if(rolusuario[30-1]['rolusuario_asignado'] ==0){
                            nopermiso = "disabled";
                        }
                        if (registros[i]["estado_id"]==1) {
                        html += "<a href='"+base_url+"ingreso/editar/"+registros[i]["ingreso_id"]+"' class='btn btn-info btn-xs "+nopermiso+"' title='EDITAR'><span class='fa fa-pencil'></span></a>";
                        html += "<a href='"+base_url+"ingreso/pdf/"+registros[i]["ingreso_id"]+"' class='btn btn-success btn-xs' target='_blank' title='IMPRIMIR'><span class='fa fa-print'></span></a>";
                        //html += "<a href='"+base_url+"ingreso/eliminar/"+registros[i]["ingreso_id"]+"' class='btn btn-danger btn-xs' title='ELIMINAR'><span class='fa fa-trash'></span></a>";
                        html += "<a data-toggle='modal' data-target='#myModal"+registros[i]["ingreso_id"]+"'  title='ELIMINAR' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";
                        html += "<!-- ---------------------- INICIO modal para confirmar eliminación ----------------- -->";
                        html += "<div class='modal fade' id='myModal"+registros[i]["ingreso_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b> <span class='fa fa-trash'></span></b>";
                        html += "¿Desea eliminar el ingreso con No. <b> "+registros[i]["ingreso_numdoc"]+"</b>?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a onclick='anular_ingreso("+registros[i]['ingreso_id']+")'  data-dismiss='modal' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para confirmar eliminación ----------------- -->";
                        //html += "<a data-toggle='modal' data-target='#myModal"+registros[i]["pedido_id"]+"'  title='Eliminar' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";
                        //}
                        }else{
                        html += "<a href='"+base_url+"ingreso/pdf/"+registros[i]["ingreso_id"]+"' class='btn btn-success btn-xs' target='_blank' title='IMPRIMIR'><span class='fa fa-print'></span></a>";
                        }
                        
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
        controlador = base_url+'ingreso/buscar50ingreso/';

    }else if(lim == 2){
        var unidad_id = document.getElementById('unidad_id').value;
        var programa_id = document.getElementById('programa_id').value;
        var estado_id    = document.getElementById('estado_id').value;
        if(unidad_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += "and p.unidad_id = u.unidad_id and u.unidad_id = "+unidad_id+" ";
           
        }
        if(programa_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += "and  i.programa_id = prog.programa_id and prog.programa_id = "+programa_id+" ";
          
        }
         if(estado_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and i.estado_id = "+estado_id+" ";
           
        }
        parametro = document.getElementById('filtrar').value;
        controlador = base_url+'ingreso/buscar_ingresoexcel/';

    }
     //parametro = document.getElementById('filtrar').value;   
     //controlador = base_url+'ingreso/buscarallingreso/';
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
                            row += 'Fecha Ingreso' + ',';

                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < registros.length; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        
                            row += '"' + registros[i]["programa_nombre"] + '",';
                            row += '"' + registros[i]["ingreso_numdoc"] + '",';
                            row += '"' + registros[i]["ingreso_total"] + '",';
                            row += '"' + registros[i]["usuario_nombre"] + '",';
                            row += '"' + registros[i]["estado_descripcion"] + '",';
                            row += '"' + registros[i]["ingreso_fecha_ing"] + '",';
                        

                        row.slice(0, row.length - 1);

                        //add a line break after each row
                        CSV += row + '\r\n';
                    }
                    
                    if (CSV == '') {        
                        alert("Invalid data");
                        return;
                    }
                    
                    //Generate a file name
                    var fileName = "Ingreso_";
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

function eliminar(ingreso_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/eliminar/';
    //alert(ingreso_id);
        $.ajax({url: controlador,
            type:"POST",
            data:{ingreso_id:ingreso_id},
            success:function(respuesta){
                       tablaresultadosingreso(2);
             },
            error:function(respuesta){
                alert("hola");
           tablaresultadosingreso(1);
                    
} 
            });   
 
}
function anular_ingreso(ingreso_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/anular_ingreso/';
    //alert(ingreso_id);
        $.ajax({url: controlador,
            type:"POST",
            data:{ingreso_id:ingreso_id},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if(registros != null){
                    if(registros == "ok"){
                        tablaresultadosingreso(2);
                    }
                }
             },
            error:function(respuesta){
                alert("hola");
           //tablaresultadosingreso(1);
                    
            } 
            });   
 
}