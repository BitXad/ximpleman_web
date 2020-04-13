$(document).on("ready",inicio);
function inicio(){
    var servicio_id = document.getElementById('esteservicio_id').value;
    resultadodetalleservicioview(servicio_id);
       /* tablaresultados(1);
        tablaproductos();
        */
}
/* ****Muestra el formato de fechas ==>> d/m/Y**** */
function convertDateFormat(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}
/* ***************Muestra el formato de numeros ==>> 00,000.00 los miles los separa con comas******************** */
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
/* ******************Retorna dos dijitos para el caso de 0 y 9************************* */
function tiempodosdigitos(num){
    if(num<10){num = "0" + num;}
    return num;
}

function insumosusados(detalleserv_id){
    const promise = new Promise(function (resolve, reject) {
    //var html = "";
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'servicio/obtenerinsumosusados/'+detalleserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var res = "";
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    for (var i = 0; i < n ; i++){
                        res += "-"+registros[i]['producto_nombre']+" ("+registros[i]['producto_codigobarra']+")";
                        res += " <b>Cant.: </b>"+registros[i]['detalleven_cantidad'];
                        //res += " <b>Prec.: </b>"+numberFormat(Number(registros[i]['detalleven_total']).toFixed(2))+"<br>";
                      //alert(html);  
                   }
               }
               resolve(res);
        },
        error:function(error){
            reject(error);
        }
        
    });
    });
  
  return promise;
}

async function processData (detalleserv_id) {
  try {
    const result = await insumosusados(detalleserv_id);
    //alert(result);
    $('#insumosusados'+detalleserv_id).html(result);
    //console.log(result);
    return "";
  } catch (err) {
    return console.log(err.message);
  }
}

function insumosusadoscosto(detalleserv_id){
    const promise = new Promise(function (resolve, reject) {
    //var html = "";
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'servicio/obtenerinsumosusados/'+detalleserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var res = "";
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    for (var i = 0; i < n ; i++){
                        res += numberFormat(Number(registros[i]['detalleven_total']).toFixed(2));
                      //alert(html);  
                   }
               }
               resolve(res);
        },
        error:function(error){
            reject(error);
        }
        
    });
    });
  
  return promise;
}

async function processDatacosto (detalleserv_id) {
  try {
    const result = await insumosusadoscosto(detalleserv_id);
    //alert(result);
    
    $('#insumosusadoscosto'+detalleserv_id).html(result);
    
    //console.log(result);
    return "";
  } catch (err) {
    return console.log(err.message);
  }
}
/* **************Dibuja los detalles de servicio en SERVIEW *************** */
function resultadodetalleservicioview(servicio_id){
      
    var tipoimpresora = document.getElementById('tipoimpresora').value;
    var base_url      = document.getElementById('base_url').value;
    var reginftecnico     = document.getElementById('reginftecnico').value;
    var asignarinsumos    = document.getElementById('asignarinsumos').value;
    var anulardetalle     = document.getElementById('anulardetalle').value;
    var eliminardetalle   = document.getElementById('eliminardetalle').value;
    var cobrardetalle     = document.getElementById('cobrardetalle').value;
    var pasaracreditodeta = document.getElementById('pasaracreditodeta').value;
    var cliente_nombre    = document.getElementById('estecliente').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    
    var controlador   = base_url+"servicio/getdetalleservicio/"+servicio_id;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var sumtotal = 0;
                    var sumacuenta = 0;
                    var sumsaldo = 0;
                    html = "";
                    for (var i = 0; i < n ; i++){
                        if(registros[i]['esteestado'] == 6){
                            sumtotal   = Number(sumtotal)  + Number(registros[i]['detalleserv_total']);
                            sumacuenta = Number(sumacuenta)   + Number(registros[i]['detalleserv_acuenta']);
                            sumsaldo   = Number(sumsaldo) + Number(registros[i]['detalleserv_saldo']);
                        }
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        html += "<td id='horizontal'>";
                        html += "<span style='font-weight: bold; font-size: 12pt;'>"+registros[i]["detalleserv_descripcion"]+"</span><sub>  ["+registros[i]['detalleserv_id']+"]</sub><br>";
                        if(registros[i]["procedencia_id"] != 0){
                            html += "<font size='1'><b>Proc.: </b>"+registros[i]["procedencia_descripcion"]+"</font><br>";
                        }
                        if(registros[i]["tiempouso_id"] != 0){
                            html += "<font size='1'><b>T. uso.: </b>"+registros[i]["tiempouso_descripcion"]+"</font><br>";
                        }
                        var res = "";
                        if(registros[i]["detalleserv_reclamo"] == "si"){ res = "Si";}else{ res = "No"; }
                        html += "<font size='1'><b>¿Reclamo?: </b>"+res+"</font><br>";
                        html += "<font size='1'><b>Resp. Tec.: </b>"+registros[i]["respusuario_nombre"]+"</font><br>";
                        html += "<font size='1'><b>Recep.: </b>"+registros[i]["usuario_nombre"]+"</font><br>";
                        html += "<font size='1'><b>Entregar: </b>";
                        //var fechaentrega = "";
                        if(registros[i]["detalleserv_fechaentrega"] != null){
                            html += convertDateFormat(registros[i]["detalleserv_fechaentrega"])+" <b>Hrs.: </b>"+registros[i]["detalleserv_horaentrega"]+"</font>";
                        }
                        //html += fechaentrega;
                        html += "</td>";
                        html += "<td><span style='font-weight: bold; font-size: 10pt;'>"+registros[i]["detalleserv_codigo"]+"</span></td>";
                        html += "<td>";
                        if(registros[i]["catserv_id"] !=0){ html+= registros[i]["catserv_descripcion"]; }
                        if(registros[i]["subcatserv_id"] !=0){ html += "/"+registros[i]["subcatserv_descripcion"];}
                        html += "</td>";
                        html += "<td>";
                        if(registros[i]["cattrab_id"] !=0){ html += registros[i]["cattrab_descripcion"]; }
                        html += "</td>";
                        html += "<td>";
                        if(registros[i]["detalleserv_fechaterminado"] != null){
                            html += convertDateFormat(registros[i]["detalleserv_fechaterminado"])+" <br>"+registros[i]["detalleserv_horaterminado"];
                        }
                        html += "</td>";
                        html += "<td>";
                        if(registros[i]["detalleserv_fechaentregado"] != null){
                            html += convertDateFormat(registros[i]["detalleserv_fechaentregado"])+"<br>"+registros[i]["detalleserv_horaentregado"];
                        }
                        html += "</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td id='horizontal'><font size='1'><b>Falla: </b>"+registros[i]["detalleserv_falla"]+"<br><b>Diagnóstico: </b>"+registros[i]["detalleserv_diagnostico"]+"<br><b>Solución: </b>"+registros[i]["detalleserv_solucion"]+"</font></td>";
                        html += "<td><font size='1'><b>Entrada: </b>"+registros[i]["detalleserv_pesoentrada"]+"</font><br>";
                        var pesosalida = "";
                        if(registros[i]["detalleserv_pesosalida"] != null){
                            pesosalida = registros[i]["detalleserv_pesosalida"];
                        }
                        html += "<font size='1'><b>Salida: </b>"+pesosalida+"</font>";
                        html += "</td>";
                        html += "<td>";
                        var misinsumos = "";
                        if(registros[i]["detalleserv_insumo"] != null){
                            misinsumos = registros[i]["detalleserv_insumo"];
                        }
                        var res = "";
                        processData(registros[i]["detalleserv_id"]);
                        processDatacosto(registros[i]["detalleserv_id"]);
                        //var res1 = insumosusados(registros[i]["detalleserv_id"]).then(function () {console.log("error")});
                        //res1 = insumosusados(registros[i]["detalleserv_id"]).then(function () {});
                        //var res = insumosusados(registros[i]["detalleserv_id"]);
                        //console.log(processData(registros[i]["detalleserv_id"]));
                        //html += misinsumos+processData(registros[i]["detalleserv_id"])+"</td>";
                        //insumosusados(registros[i]['detalleserv_id']);
                        
                        html += "<span style='display: none' id='insumosusadoscosto"+registros[i]['detalleserv_id']+"'></span>"
                        html += misinsumos+"<span id='insumosusados"+registros[i]['detalleserv_id']+"'></span>"+"</td>";
                        html += "<td>"+registros[i]["detalleserv_glosa"]+"</td>";
                        html += "<td id='alinear'><span style='font-weight: bold; font-size: 10pt;'>"+ numberFormat(Number(registros[i]["detalleserv_total"]).toFixed(2))+"</span></td>";
                        html += "<td id='alinear'>"+ numberFormat(Number(registros[i]["detalleserv_acuenta"]).toFixed(2))+"</td>";
                        html += "<td id='alinear'><span style='font-weight: bold; font-size: 10pt;'>"+ numberFormat(Number(registros[i]["detalleserv_saldo"]).toFixed(2))+"</span></td>";
                        html += "<td>";
                        
                        html += "<!------------------------ INICIO modal para registrar reporte Técnico ------------------->";
                        html += "<div class='modal fade' id='modalregistrardetservtecnico"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center' style='font-size:12pt;'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "REGISTRAR SERVICIO TECNICO";
                        html += "<br>N° "+registros[i]['servicio_id'];
                        html += "</div>";
                        //html += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                        
                        html +="<table style='width: 100%'>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Descripción: </div></th>";

                        html +="<td colspan='2'>";
                        if(tipousuario_id ==1){
                            html +="<input style='width: 100%' type='text' name='detalleserv_descripcion"+registros[i]['detalleserv_id']+"' id='detalleserv_descripcion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_descripcion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            html += registros[i]['detalleserv_descripcion'];
                        }
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Falla según Cliente: </div></th>";
                        html +="<td  colspan='2'>";
                        if(tipousuario_id ==1){
                            html +="<input style='width: 100%' type='text' name='detalleserv_falla"+registros[i]['detalleserv_falla']+"' id='detalleserv_falla"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_falla']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            html += registros[i]['detalleserv_falla'];
                        }
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Diagnóstico: </div></th>";
                        html +="<td colspan='2' style='width: 70%'>";
                        html +="<input style='width: 100%' type='text' name='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' id='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_diagnostico']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Solución Aplicada: </div></th>";
                        html +="<td colspan='2'>";
                        html +="<input style='width: 100%' type='text' name='detalleserv_solucion"+registros[i]['detalleserv_id']+"' id='detalleserv_solucion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />"; 
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Buscar Insumos: </div></th>";
                        html +="<td colspan='2'>";
                        
                        html += "<input type='search' name='insumosproducto_id"+registros[i]['detalleserv_id']+"' id='insumosproducto_id"+registros[i]['detalleserv_id']+"' list='listainsumos"+registros[i]['detalleserv_id']+"' style='width: 100%' placeholder='Ingrese el nombre, código del Insumo' onkeypress='buscar_verificarenter(event, "+registros[i]['detalleserv_id']+")' onchange='seleccionar_insumo("+registros[i]['detalleserv_id']+")' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' autocomplete='off' />";
                        html += "<datalist id='listainsumos"+registros[i]['detalleserv_id']+"'>";
                        html += "</datalist>";
                        html += "<input type='hidden' name='esteproducto_id"+registros[i]['detalleserv_id']+"' id='esteproducto_id"+registros[i]['detalleserv_id']+"' />";
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 25%'><div class='text-right'>Costo por Insumo: </div></th>";
                        html +="<td style='width: 15%'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='producto_precio"+registros[i]['detalleserv_id']+"' id='producto_precio"+registros[i]['detalleserv_id']+"' />";
                        html +="</td>";
                        html +="<td style='width: 60%'>";
                        html +="<input style='width: 90%' type='text' name='nombre_insumo"+registros[i]['detalleserv_id']+"' id='nombre_insumo"+registros[i]['detalleserv_id']+"' readonly />";
                        html += "<button class='btn btn-success btn-xs' onclick='registrarinsumo_aldetalle("+registros[i]['detalleserv_id']+")' title='Usar insumo'><span class='fa fa-check'></span></button>";
                        html +="</td>";
                        html +="</tr>";
                        
                        html +="<tr>";
                        html +="<th><div class='text-right'>Insumos Usados: </div></th>";
                        html +="<td colspan='2'>";
                        processmisInsumos(registros[i]['detalleserv_id']);
                        html +="<div id='misinsumosusados"+registros[i]['detalleserv_id']+"'></div>";
                        html +="</td>";
                        html +="</tr>";
                        
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 25%'><div class='text-right'>Servicios Externos: </div></th>";
                        html +="<td style='width: 15%'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_precioexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_precioexterno"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_precioexterno']).toFixed(2)+"' />";
                        html +="</td>";
                        html +="<td style='width: 60%'>";
                        var detalleexterno= "";
                        if(registros[i]['detalleserv_detalleexterno'] != "" && registros[i]['detalleserv_detalleexterno'] != null){
                            detalleexterno = registros[i]['detalleserv_detalleexterno'];
                        }
                        html +="<input style='width: 100%' type='text' name='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' value='"+detalleexterno+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />";
                        html +="</td>";
                        html +="</tr>";
                        html +="</table>";
                        html +="<table style='width: 100%'>";
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 10%'>Total:</th>";
                        html +="<td style='width: 24%'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_total"+registros[i]['detalleserv_id']+"' id='detalleserv_total"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_total']).toFixed(2)+"'  onkeyup='restar("+registros[i]['detalleserv_id']+")' />";
                        html += "</td>";
                        html +="<th style='width: 15%'>A Cuenta:</th>";
                        html +="<td style='width: 18%'>";
                        html +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_acuenta"+registros[i]['detalleserv_id']+"' id='detalleserv_acuenta"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_acuenta']).toFixed(2)+"' />";
                        html += "</td>";
                        html +="<th style='width: 10%'>Saldo:</th>";
                        html +="<td style='width: 23%'>";
                        html +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_saldo"+registros[i]['detalleserv_id']+"' id='detalleserv_saldo"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        html += "</td>";
                        html +="</tr>";
                        html +="</table>";
                        //html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        html += "<button class='btn btn-success' onclick='registrardetalleservicio_terminado("+servicio_id+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-wrench'></span> Registrar Servicio Terminado</button>";
                        
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        html += "</div>";
                        //html += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para registrar reporte Técnico ------------------->";
                        
                        /* *************** MODAL PARA ENTREGAR SERVICIO **************** */
                        html += "<!------------------------ INICIO modal para registrar ENTREGA DE SERVICIO ------------------->";
                        html += "<div class='modal fade' id='modalregistrarentregadetserv"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center' style='font-size:12pt;'>";
                        html += "<label>ENTREGA DE : "+registros[i]["detalleserv_descripcion"]+"; Codigo: "+registros[i]["detalleserv_codigo"]+"</label>";
                        //html += "ENTREGA DE SERVICIO N° "+registros[i]['servicio_id'];
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<span id='mensajeregistrarserentregado' class='text-danger'></span>";
                        html += "<div class='text-center'><span style='font-size: 12pt'>"+cliente_nombre+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        html += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        html +="<table style='width: 100%'>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Descripción: </div></th>";

                        html +="<td colspan='2'>"+registros[i]['detalleserv_descripcion'];
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Falla según Cliente: </div></th>";
                        html +="<td  colspan='2'>"+registros[i]['detalleserv_falla'];
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Diagnóstico: </div></th>";
                        html +="<td colspan='2' style='width: 70%'>";
                        html +=registros[i]['detalleserv_diagnostico'];
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th><div class='text-right'>Solución Aplicada: </div></th>";
                        html +="<td colspan='2'>";
                        html +=registros[i]['detalleserv_solucion'];
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 25%'><div class='text-right'>Insumo(s): </div></th>";
                        html +="<td style='width: 15%'>";
                        html +="xx";
                        html +="</td>";
                        html +="<td style='width: 60%'>";
                        html +="detallexx";
                        html +="</td>";
                        /*res +="<td>";
                        res += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalasignarinsumos"+registros[i]['detalleserv_id']+"' title='Asignar Insumos'><span class='fa fa-plus'></span></a>";
                        res +="</td>";*/
                        html +="</tr>";
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 25%'><div class='text-right'>Servicios Externos: </div></th>";
                        html +="<td style='width: 15%'>";
                        if(registros[i]['detalleserv_precioexterno'] != null){
                            html +=registros[i]['detalleserv_precioexterno'];
                        }
                        html +="</td>";
                        html +="<td style='width: 60%'>";
                        if(registros[i]['detalleserv_detalleexterno'] != null){
                            html +=registros[i]['detalleserv_detalleexterno'];
                        }
                        html +="</td>";
                        html +="</tr>";
                        html +="</table>";
                        html +="<table style='width: 100%'>";
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 10%'>Total:</th>";
                        html +="<td style='width: 24%'>";
                        html +=Number(registros[i]['detalleserv_total']).toFixed(2);
                        html += "</td>";
                        html +="<th style='width: 15%'>A Cuenta:</th>";
                        html +="<td style='width: 18%'>";
                        html +=Number(registros[i]['detalleserv_acuenta']).toFixed(2);
                        html += "</td>";
                        html +="<th style='width: 10%'>Saldo:</th>";
                        html +="<td style='width: 23%'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_saldo"+registros[i]['detalleserv_id']+"' id='detalleserv_saldo"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        html += "</td>";
                        html +="</tr>";
                        html +="</table>";
                        html +="<table style='width: 100%'>";
                        html +="<tr>";
                        html +="<th style='width: 25%'><div class='text-right'>Entregado a: </div></th>";
                        html +="<td style='width: 75%'>";
                        html +="<input style='width: 100%' type='text name='detalleserv_entregadoa"+registros[i]['detalleserv_id']+"' id='detalleserv_entregadoa"+registros[i]['detalleserv_id']+"' value='"+cliente_nombre+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        html +="</td>";
                        html +="</tr>";
                        html +="</table>";
                        //html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        html += "<button class='btn btn-success' onclick='registrardetalleservicio_entregado("+servicio_id+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-wrench'></span> Registrar Entrega</button>";
                        
                        
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        html += "</div>";
                        //res += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para registrar ENTREGA DE SERVICIO ------------------->";
                        html += "<br>";
                        
                        html += "<!-- ---------------------- INICIO modal para poner en CREDITO un detalle de un Servicio ----------------- -->";
                        html += "<div class='modal fade' id='modalcreditodetalle"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<label>Se pondra en Credito el detalle: "+registros[i]["detalleserv_descripcion"]+"; Codigo: "+registros[i]["detalleserv_codigo"]+"</label>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<span id='mensajeponercredito_detalleserv"+registros[i]["detalleserv_id"]+"' class='text-danger'></span>";
                        html += "</div>";
                        //html += "echo form_open('detalle_serv/registrarcreditodetalle');";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<div class='box-body'>";
                        html += "<table class='table-striped table-condensed' id='cobrototal'>";
                        html += "<tr>";
                        html += "<td>Total Bs.</td>";
                        html += "<td id='alinear'>"+numberFormat(Number(registros[i]["detalleserv_total"]).toFixed(2))+"</td>";
                        html += "</tr>";
                        html += "<tr>";
                        html += "<td>A cuenta Bs.</td>";

                        html += "<td id='alinear'>"+numberFormat(Number(registros[i]["detalleserv_acuenta"]).toFixed(2))+"</td>";
                        html += "</tr>";
                        html += "<tr>";
                        html += "<td><b>Saldo a Cobrar Bs.</b></td>";
                        html += "<td id='alinear'><b>"+numberFormat(Number(registros[i]["detalleserv_saldo"]).toFixed(2))+"</b></td>";
                        html += "</tr>";
                        html += "</table>";
                        //html += "<input type='hidden' name='servicio_id' id='servicio_id' value='"+servicio_id+"'>";
                        //html += "<input type='hidden' name='detalleserv_id' id='detalleserv_id' value='"+registros[i]["detalleserv_id"]+"'>";
                        html += "</div>";

                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button onclick='ponerencredito("+servicio_id+", "+registros[i]['detalleserv_id']+", "+i+", "+registros[i]["detalleserv_saldo"]+" )'  class='btn btn-success' data-dismiss='modal'>";
                        html += "<i class='fa fa-money'></i> Poner en Credito";
                        html += "</button>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'>";
                        html += "<i class='fa fa-times'></i> Cancelar</a>";
                        html += "</div>";
                        //html += "<?php echo form_close(); ?>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para poner en CREDITO un detalle de un Servicio ----------------- -->";

                        html += "<!------------------------ INICIO modal para confirmar Anulacion de un detalle ------------------->";
                        html += "<div class='modal fade' id='modalanulardet"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><b><span class='fa fa-minus-circle'></span>¿</b>";
                        html += "Desea Anular este detalle de Servicio con el codigo: <b>"+registros[i]["detalleserv_codigo"]+"?</b>";
                        html += "</h3>";
                        html += "Al ANULAR este detalle de servicio, sus campos: Total, A cuenta y Saldo seran CERO.";

                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"detalle_serv/anulardetalleserv/"+servicio_id+"/"+registros[i]["detalleserv_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a onclick='anulardetalleservicio("+servicio_id+", "+registros[i]['detalleserv_id']+", "+i+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Anulacion ------------------->";

                        html += "<!------------------------ INICIO modal para confirmar Eliminación ------------------->";
                        html += "<div class='modal fade' id='modaleliminardet"+i+"' tabindex='-1' role='dialog' aria-labelledby='modaleliminarLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><b><span class='fa fa-trash'></span></b>";
                        html += "¿Desea Eliminar el detalle de servicio con el codigo: <b>"+registros[i]["detalleserv_codigo"]+"</b>?";
                        html += "</h3>";
                        html += "Al eliminar este detalle, se perdera toda la información.";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"detalle_serv/removedet/"+servicio_id+"/"+registros[i]["detalleserv_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a onclick='eliminardetalleservicio("+servicio_id+", "+registros[i]['detalleserv_id']+", "+i+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Eliminación ------------------->";
                        
                        html += "<a href='"+base_url+"detalle_serv/modificarmidetalle/"+servicio_id+"/"+registros[i]["detalleserv_id"]+"' class='btn btn-info btn-xs' title='Modificar detalle de servicio'><span class='fa fa-pencil'></span> </a>";
                        if(registros[i]["esteestado"] != 7 && registros[i]["esteestado"] != 16){
                            if(asignarinsumos == 1){
                                html += "<a class='btn btn-info btn-xs' href='"+base_url+"categoria_insumo/verinsumosasignar/"+servicio_id+"/"+registros[i]["detalleserv_id"]+"' title='Ver, asignar insumos'><span class='fa fa-file-text-o'></span><br></a>";
                            }
                        }
                        if(registros[i]["esteestado"] != 6 && registros[i]["esteestado"] != 7 && registros[i]["esteestado"] != 16){
                            if(reginftecnico == 1){
                                html += "<a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#modalregistrardetservtecnico"+registros[i]['detalleserv_id']+"' title='Registrar servicio técnico finalizado'><span class='fa fa-file-text'></span><br></a>";
                                //html += "<a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#modaldst"+i+"' title='Registrar servicio técnico'><span class='fa fa-file-text'></span><br></a>";
                            }
                            
                            if(anulardetalle == 1){
                                html += "<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#modalanulardet"+i+"' title='Anular detalle servicio'><span class='fa fa-minus-circle'></span></a>";
                            }
                            if(eliminardetalle == 1){
                                html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modaleliminardet"+i+"' title='Eliminar detalle servicio' ><span class='fa fa-trash'></span></a>";
                            }
                        }
                        if(registros[i]["esteestado"] == 6){
                            if(cobrardetalle == 1){
                                //html += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalpagardetalle"+i+"' title='cobrar detalle serv..' onclick='refrescarhora()';><span class='fa fa-money'></span><br></a>";
                                html += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalregistrarentregadetserv"+registros[i]["detalleserv_id"]+"' title='Cobrar detalle servicio'><span class='fa fa-money'></span><br></a>";
                            }
                            if(pasaracreditodeta == 1){
                                html += "<a class='btn  btn-primary btn-xs' data-toggle='modal' data-target='#modalcreditodetalle"+i+"' title='Pasar a credito este detalle' ><span class='fa fa-credit-card'></span><br></a>";
                            }
                        }
                        if(registros[i]["esteestado"] == 7){
                            var dir_url = "";
                            var titprint = "";
                            if(tipoimpresora == "FACTURADORA"){
                                dir_url = base_url+"detalle_serv/compdetalle_pago_boucher/"+registros[i]["detalleserv_id"];
                                titprint = "Boucher";
                            }else{
                                dir_url = base_url+"detalle_serv/compdetalle_pago/"+registros[i]["detalleserv_id"];
                                titprint = "Normal";
                            }
                            html += "<a href='"+dir_url+"' class='btn btn-success btn-xs'  title='Imprimir detalle servicio "+titprint+"' target='_blank' ><span class='fa fa-print'></span><br></a>";
                        }
                        
                        
                        html += "</td>";
                        
                        html += "<tr>";
                        }
                    $("#creditototal").html(numberFormat(Number(sumtotal).toFixed(2)));
                    $("#creditoacuenta").html(numberFormat(Number(sumacuenta).toFixed(2)));
                    $("#creditosaldo").html(numberFormat(Number(sumsaldo).toFixed(2)));
                    $("#cobrartotal").html(numberFormat(Number(sumtotal).toFixed(2)));
                    $("#cobraracuenta").html(numberFormat(Number(sumacuenta).toFixed(2)));
                    $("#cobrarsaldo").html(numberFormat(Number(sumsaldo).toFixed(2)));
                    $("#detalleservicio").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#detalleservicio").html(html);
        }
        
    });   

}
/* *************Anula el detalle de un SERVICIO**************** */
function anulardetalleservicio(servicio_id, detalleserv_id, nummodal){
    var nombremodal = nummodal;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"servicio/anulardetalle/"+servicio_id+"/"+detalleserv_id;
     $('#modalanulardet'+nombremodal).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    if(registros == "ok"){
                        
                        alert("Anulacion exitosa");
                        resultadodetalleservicioview(servicio_id);
                        resultadomontoservicio(servicio_id);
                    }else{
                        alert("Hubo problemas con la Anulacion");
                    }
                }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });   

}

function resultadomontoservicio(servicio_id){
      
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"servicio/getmontoservicio/"+servicio_id;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    var total   = registros["servicio_total"];
                    var acuenta = registros["servicio_acuenta"];
                    var saldo   = registros["servicio_saldo"];
                    html = "";
                    $("#totalfinal").html(numberFormat(Number(total).toFixed(2)));
                    $("#totalacuenta").html(numberFormat(Number(acuenta).toFixed(2)));
                    $("#totalsaldo").html(numberFormat(Number(saldo).toFixed(2)));
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#totalfinal").html(html);
           $("#totalacuenta").html(html);
           $("#totalsaldo").html(html);
        }
        
    });   

}

function eliminardetalleservicio(servicio_id, detalleserv_id, nummodal){
    var nombremodal = nummodal;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_serv/removedet/"+servicio_id+"/"+detalleserv_id;
    $('#modaleliminardet'+nombremodal).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                
                var registros =  JSON.parse(resul);
                if (registros != null){
                    if(registros == "ok"){
                        
                        //alert('#modaleliminar'+nombremodal);
                        alert("Eliminacion exitosa");
                        resultadodetalleservicioview(servicio_id);
                        resultadomontoservicio(servicio_id);
                        
                    }else{
                        alert("Hubo problemas con la Eliminacion");
                    }
                }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });   

}

/* ****************Registra el reporte del servicio tecnico*************** */
function registrorepserviciotecnico(servicio_id, detalleserv_id, nummodal){
    var nombremodal = "modaldst"+nummodal;
    var base_url = document.getElementById('base_url').value;
    
    var detalleserv_diagnostico = document.getElementById('detalleserv_diagnostico'+detalleserv_id).value;
    var detalleserv_solucion = document.getElementById('detalleserv_solucion'+detalleserv_id).value;
    var detalleserv_pesosalida = document.getElementById('detalleserv_pesosalida'+detalleserv_id).value;
    var detalleserv_glosa = document.getElementById('detalleserv_glosa'+detalleserv_id).value;
    
    var controlador = base_url+'detalle_serv/registrartec/'+servicio_id+'/'+detalleserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{detalleserv_diagnostico:detalleserv_diagnostico, detalleserv_solucion:detalleserv_solucion,
               detalleserv_pesosalida:detalleserv_pesosalida, detalleserv_glosa:detalleserv_glosa},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "faltadatos"){
                       $('#'+nombremodal).modal('show');
                       $('#mensajetec_detalleserv'+detalleserv_id).html("<br>Debe llenar los campos: Diagnostico y Solución");
                   }else if("ok"){
                       //$('#'+nombremodal).modal('hide');
                       resultadodetalleservicioview(servicio_id);
                       //resultadomontoservicio(servicio_id);
                       //$('#'+nombremodal).modal('hide');
                       //resetearegtecnicoinput();
                   }
               }
        }
        
    });
}
/*
function refrescarhora(){
    //$('#modalpagardetalle'+numod).reload();
    var f = new Date();
    var fecha = "";
    var hora  = "";
    var d       = f.getDate();
    var dia     = (d<10) ? "0" + d : d;
    var m       = (f.getMonth() +1);
    var mes     = (m<10) ? "0" + m : m;
    var h       = f.getHours();
    var hor     = (h<10) ? "0" + h : h;
    var min     = f.getMinutes();
    var minuto  = (min<10) ? "0" + min : min;
    var s       = f.getSeconds();
    var segundo = (s<10) ? "0" + s : s;
    //fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
    fecha = f.getFullYear()+ "-" + mes + "-" + dia;
var r = new Date();
    hora  = hor + ":"+ minuto + ":" + segundo;
    $('input[type=datetime-local]').val(fecha+"T"+hora);
}*/

/* ****************Registra el cobro de un detalle de servicio*************** */
function cobrardetalle(servicio_id, detalleserv_id, nummodal){
    //var nombremodal = "modalpagardetalle"+nummodal;
    var base_url = document.getElementById('base_url').value;
    var tipoimpresora = document.getElementById('tipoimpresora').value;
    
    var fecha_cobro = document.getElementById('fecha_cobro'+detalleserv_id).value;
    var controlador = base_url+'detalle_serv/registrarcobrodetalle/'+servicio_id+'/'+detalleserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha_cobro:fecha_cobro},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "faltadatos"){
                       $('#mensajecobrar_detalleserv'+detalleserv_id).html("<br>Fecha de cobro no debe estar vacio.");
                   }else if("ok"){
                        var dir_url = "";
                        if(tipoimpresora == "FACTURADORA"){
                            dir_url = base_url+"detalle_serv/compdetalle_pago_boucher/"+detalleserv_id;
                        }else{
                            dir_url = base_url+"detalle_serv/compdetalle_pago/"+detalleserv_id;
                        }
                        //html += "<a href='"+dir_url+"' class='btn btn-success btn-xs'  title='imprimir detalle serv..' target='_blank' ><span class='fa fa-print'></span><br></a>";
                            
                        $("#printdetalleserv").attr("href", dir_url);
                        document.getElementById('printdetalleserv').click();
                        //$("#printdetalleserv").trigger('click');
                       resultadodetalleservicioview(servicio_id);
                       resultadomontoservicio(servicio_id);
                       //$('#'+nombremodal).modal('hide');
                       //resetearegtecnicoinput();
                   }
               }
        }
        
    });
}
/* ****************Registra el cobro de un detalle de servicio*************** */
function ponerencredito(servicio_id, detalleserv_id, nummodal, saldo){
    var nombremodal = "modalcreditodetalle"+nummodal;
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_serv/registrarcreditodetalle';
    $.ajax({url: controlador,
           type:"POST",
           data:{servicio_id:servicio_id, detalleserv_id:detalleserv_id, monto:saldo},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   $('#'+nombremodal).modal('hide');
                   if(registros == "faltadatos"){
                       $('#mensajeponercredito_detalleserv'+detalleserv_id).html("<br>Ocurrio un error, por favor refresque la pagina e intente nuevamente.");
                   }else if("ok"){
                       //$('#'+nombremodal).modal('hide');
                       resultadodetalleservicioview(servicio_id);
                   }
               }
        }
        
    });
}
/* ****************Registra el cobro de todos los detalles de servicio que sean terminados*************** */
function cobrototalservicio(servicio_id){
    //var nombremodal = "modalpagar";
    
    var base_url = document.getElementById('base_url').value;
    var fecha_cobro = document.getElementById('fecha_cobro').value;
    var fecha_cobro = document.getElementById('fecha_cobro').value;
    var tipoimpresora = document.getElementById('tipoimpresora').value;
    var detalleserv_entregadoa = document.getElementById('detalleserv_entregadoa').value;
    var controlador = base_url+'detalle_serv/registrarcobrototal/'+servicio_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha_cobro:fecha_cobro, detalleserv_entregadoa:detalleserv_entregadoa},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   //$('#'+nombremodal).modal('hide');
                /*   if(registros == "faltadatos"){
                       $('#mensajeponercredito_detalleserv'+detalleserv_id).html("<br>Ocurrio un error, por favor refresque la pagina e intente nuevamente.");
                   }else*/ if("ok"){
                       //$('#'+nombremodal).modal('hide');
                       
                       /*var dir_url = "";
                        if(tipoimpresora == "FACTURADORA"){
                            dir_url = base_url+"detalle_serv/compdetalle_pago_boucher/"+detalleserv_id;
                        }else{
                            dir_url = base_url+"detalle_serv/compdetalle_pago/"+detalleserv_id;
                        }
                        window.open(dir_url, '_blank');*/
                       resultadodetalleservicioview(servicio_id);
                   }
               }
        }
        
    });
}
/* ****************Poner en credito todos los detalles de servicio que sean terminados*************** */
function creditototalservicio(servicio_id){
    //var nombremodal = "modalpagar";
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_serv/registrarcreditototal/'+servicio_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    if("ok"){
                       resultadodetalleservicioview(servicio_id);
                   }
               }
        }
        
    });
}
/* ****************Anular todos los detalles de servicio*************** */
function anulartotalservicio(servicio_id){
    //var nombremodal = "modalpagar";
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'servicio/anularserviciodet/'+servicio_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    if("ok"){
                       resultadodetalleservicioview(servicio_id);
                       resultadomontoservicio(servicio_id);
                   }
               }
        }
        
    });
}


function registrardetalleservicio_entregado(servicio_id, detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var tipo_impresora = document.getElementById('tipoimpresora').value;
    var controlador = base_url+"servicio/registrar_detalleservicioentregado";
    var detalleserv_entregadoa = document.getElementById('detalleserv_entregadoa'+detalleserv_id).value;
    var detalleserv_saldo = document.getElementById('detalleserv_saldo'+detalleserv_id).value;
    $('#modalregistrarentregadetserv'+detalleserv_id).modal('hide');
        $.ajax({url: controlador,
            type:"POST",
            data:{detalleserv_entregadoa:detalleserv_entregadoa, detalleserv_id:detalleserv_id,
                  detalleserv_saldo:detalleserv_saldo, servicio_id:servicio_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                if(resultado == "faltainf"){
                    $('#mensajeregistrarserentregado').html("<br>Los campos: Saldo y Entregado a; no debes estar vacios");
                }else if(resultado == "ok"){
                    var dir_url = "";
                    if(tipo_impresora == "FACTURADORA"){
                        dir_url = base_url+"detalle_serv/compdetalle_pago_boucher/"+detalleserv_id;
                    }else{
                        dir_url = base_url+"detalle_serv/compdetalle_pago/"+detalleserv_id;
                    }
                    window.open(dir_url, '_blank');
                    resultadodetalleservicioview(servicio_id);
                }

            },
            error: function(respuesta){
            }
        });
}

function registrardetalleservicio_terminado(servicio_id, detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+"servicio/registrar_servicioterminado";
    var detalleserv_diagnostico = document.getElementById('detalleserv_diagnostico'+detalleserv_id).value;
    var detalleserv_solucion = document.getElementById('detalleserv_solucion'+detalleserv_id).value;
    //var producto_precio = document.getElementById('producto_precio'+detalleserv_id).value;
    //var nombre_insumo = document.getElementById('nombre_insumo'+detalleserv_id).value;
    var detalleserv_precioexterno = document.getElementById('detalleserv_precioexterno'+detalleserv_id).value;
    var detalleserv_detalleexterno = document.getElementById('detalleserv_detalleexterno'+detalleserv_id).value;
    var detalleserv_total = document.getElementById('detalleserv_total'+detalleserv_id).value;
    var detalleserv_saldo = document.getElementById('detalleserv_saldo'+detalleserv_id).value;
    //var producto_id = document.getElementById('esteproducto_id'+detalleserv_id).value;
    $('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
    var esdata = "";
    if(tipousuario_id ==1){
        var detalleserv_descripcion = document.getElementById('detalleserv_descripcion'+detalleserv_id).value;
        var detalleserv_falla = document.getElementById('detalleserv_falla'+detalleserv_id).value;
        esdata = {detalleserv_descripcion:detalleserv_descripcion, detalleserv_falla:detalleserv_falla,
                  detalleserv_diagnostico:detalleserv_diagnostico, detalleserv_solucion:detalleserv_solucion,
                  detalleserv_precioexterno:detalleserv_precioexterno, detalleserv_detalleexterno:detalleserv_detalleexterno,
                  detalleserv_total:detalleserv_total, detalleserv_saldo:detalleserv_saldo,
                  detalleserv_id:detalleserv_id, servicio_id:servicio_id};
    }else{
        esdata = {detalleserv_diagnostico:detalleserv_diagnostico, detalleserv_solucion:detalleserv_solucion,
                  detalleserv_precioexterno:detalleserv_precioexterno, detalleserv_detalleexterno:detalleserv_detalleexterno,
                  detalleserv_total:detalleserv_total, detalleserv_saldo:detalleserv_saldo,
                  detalleserv_id:detalleserv_id, servicio_id:servicio_id};
    }
    $('#modalregistrardetservtecnico'+detalleserv_id).modal('hide');
        $.ajax({url: controlador,
            type:"POST",
            data:esdata,
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                if(resultado == "faltainf"){
                    $('#mensajeregistrarserterminado').html("<br>Los campos: Diagnostico, Solución y Total; no debes estar vacios");
                }else if(resultado == "ok"){
                    resultadodetalleservicioview(servicio_id);
                }

            },
            error: function(respuesta){
            }
        });
}

/* seleccionar sub-categoria */
function seleccionar_insumo(detalleserv_id){
    var producto_id = document.getElementById('insumosproducto_id'+detalleserv_id).value;
    //alert(producto_id+"AA");
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"producto/seleccionar_insumo/";
        $.ajax({url: controlador,
            type:"POST",
            data:{producto_id:producto_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
//                alert(resultado[0]["cliente_nit"]);
                
                if (resultado["producto_id"]>0){
                    $('#esteproducto_id'+detalleserv_id).val(resultado['producto_id']);
                    //$("#insumosproducto_id"+detalleserv_id).val(resultado["producto_id"]);
                    $("#nombre_insumo"+detalleserv_id).val(resultado["producto_nombre"]);
                    $("#producto_precio"+detalleserv_id).val(Number(resultado["producto_precio"]).toFixed(2));
                    /*var res = $("#detalleserv_descripcion").val();
                    $('#detalleserv_saldo').val(resultado[0]['subcatserv_precio']);
                    $("#detalleserv_descripcion").val(res+" "+resultado[0]["subcatserv_descripcion"]);
                    $('#detalleserv_descripcion').focus();*/
                    $('#insumosproducto_id'+detalleserv_id).val(resultado["producto_nombre"]);
                    $('#producto_precio'+detalleserv_id).focus();
                }
                
            },
            error: function(respuesta){
            }
        });    
}

function buscarinsumosproductos(detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"producto/buscar_insumos";
    var parametro = document.getElementById('insumosproducto_id'+detalleserv_id).value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["producto_id"]+"' label='"+resultado[i]["producto_nombre"];
                    html += "'>"+resultado[i]["producto_nombre"]+"</option>";
                }    
                $("#listainsumos"+detalleserv_id).html(html);

            },
            error: function(respuesta){
            }
        });
}

function registrarinsumo_aldetalle(detalleserv_id){
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    var producto_id = document.getElementById('esteproducto_id'+detalleserv_id).value;
    var producto_precio = document.getElementById('producto_precio'+detalleserv_id).value;
    if(producto_id >0){
        controlador = base_url+'categoria_insumo/registrareste_insumo';
        $.ajax({url: controlador,
               type:"POST",
               data:{producto_id:producto_id, detalleserv_id:detalleserv_id, producto_precio:producto_precio},
               success:function(respuesta){
                   var registros =  JSON.parse(respuesta);
                   if (registros != null){
                       processmisInsumos(detalleserv_id);
                    //showinsumosusados(servicio_id, detalleserv_id);
                }
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               //$("#insumosresultados").html(html);
            }

        });
    }

}
async function processmisInsumos(detalleserv_id) {
  try {
    const result = await mostrarinsumosdetalleserv(detalleserv_id);
    //alert(result);
    $('#misinsumosusados'+detalleserv_id).html(result);
    //console.log(result);
    return "";
  } catch (err) {
    return console.log(err.message);
  }
}

function mostrarinsumosdetalleserv(detalleserv_id){
    const promise = new Promise(function (resolve, reject) {
    var base_url = document.getElementById('base_url').value;
    //var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+'servicio/obtenerinsumosusados/'+detalleserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var res = "";
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var total = 0;
                    res +="<table style='width: 100%; font-size: 10px; font-weight: normal; padding: 0px'>";
                    res +="<tr>";
                    res +="<th style='padding: 0px'>Cant.</th>";
                    res +="<th style='padding: 0px'>Total</th>";
                    res +="<th style='padding: 0px'>Insumo</th>";
                    res +="<th style='padding: 0px'>Código</th>";
                    res +="<th style='padding: 0px'></th>";
                    res +="</tr>";
                    for (var i = 0; i < n ; i++){
                        total = Number(total)+Number(registros[i]['detalleven_total']);
                        res +="<tr>";
                        res +="<td style='padding: 0px' class='text-right'>"+registros[i]['detalleven_cantidad']+"</td>";
                        res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(registros[i]['detalleven_total']).toFixed(2))+"</td>";
                        res +="<td style='padding: 0px'>"+registros[i]['producto_nombre']+"</td>";
                        res +="<td style='padding: 0px' class='text-center'>"+registros[i]['producto_codigo']+"</td>";
                        res +="<td style='padding: 0px' class='text-center'>";
                        res += "<button class='btn btn-danger btn-xs' onclick='eliminar_insumo("+registros[i]['detalleven_id']+", "+detalleserv_id+")' title='Eliminar insumo'><span class='fa fa-trash'></span></button>";
                        res +="</td>";
                        res +="</tr>";

                   }
                   res +="<tr>";
                   res +="<td style='padding: 0px'>Total:</td>";
                   res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(total).toFixed(2))+"</td>";
                   res +="</tr>";
                   res +="</table>";
               }else{
                   res="";
               }
               resolve(res);
        },
        error:function(error){
            reject(error);
        }
        
    });
    });
  
  return promise;
}
function eliminar_insumo(detalleven_id, detalleserv_id){
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    //$('#myModal'+i).modal('hide');
    
    
    controlador = base_url+'categoria_insumo/eliminardetalleventa';
    $.ajax({url: controlador,
           type:"POST",
           data:{detalleven_id:detalleven_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   processmisInsumos(detalleserv_id);
                //showinsumosusados(servicio_id, detalleserv_id);
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           //$("#insumosresultados").html(html);
        }

    });

}
function buscar_verificarenter(e, detalleserv_id){
    tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
        buscarinsumosproductos(detalleserv_id);
    }
}
function buscar_verificarentert(e, detalleserv_id){
    tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
        buscarinsumosproductost(detalleserv_id);
    }
}

function buscarinsumosproductos(detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"producto/buscar_insumos";
    var parametro = document.getElementById('insumosproducto_id'+detalleserv_id).value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["producto_id"]+"' label='"+resultado[i]["producto_nombre"];
                    html += "'>"+resultado[i]["producto_nombre"]+"</option>";
                }    
                $("#listainsumos"+detalleserv_id).html(html);

            },
            error: function(respuesta){
            }
        });
}

function buscarinsumosproductost(detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"producto/buscar_insumos";
    var parametro = document.getElementById('insumosproducto_idt'+detalleserv_id).value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["producto_id"]+"' label='"+resultado[i]["producto_nombre"];
                    html += "'>"+resultado[i]["producto_nombre"]+"</option>";
                }    
                $("#listainsumost"+detalleserv_id).html(html);

            },
            error: function(respuesta){
            }
        });
}