$(document).on("ready",inicio);
function inicio(){
    //var servicio_id = document.getElementById('esteservicio_id').value;
    var codigo = document.getElementById('codigo').value;
    resultadodetalleserviciokardex(codigo);
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
                        res += " <b>Prec.: </b>"+numberFormat(Number(registros[i]['detalleven_total']).toFixed(2))+"<br>";
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
function resultadodetalleserviciokardex(codigo){
    var base_url    = document.getElementById('base_url').value;
    var all_categoria_trabajo = JSON.parse(document.getElementById('all_categoria_trabajo').value);
    var all_procedencia = JSON.parse(document.getElementById('all_procedencia').value);
    var all_tiempo_uso = JSON.parse(document.getElementById('all_tiempo_uso').value);
    var all_categoria_servicio = JSON.parse(document.getElementById('all_categoria_servicio').value);
    var all_subcategoria_servicio = JSON.parse(document.getElementById('all_subcategoria_servicio').value);
    var all_responsable = JSON.parse(document.getElementById('all_responsable').value);
    var parametro = JSON.parse(document.getElementById('parametro').value);
    var controlador = base_url+"detalle_serv/get_kardexdetalle";
    $.ajax({url: controlador,
           type:"POST",
           data:{codigo:codigo},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var sumtotal = 0;
                    var sumacuenta = 0;
                    var sumsaldo = 0;
                    html = "";
                    var band = true;
                    for (var i = 0; i < n ; i++){
                        if(registros[i]['esteestado'] == 6){
                            sumtotal   = Number(sumtotal)  + Number(registros[i]['detalleserv_total']);
                            sumacuenta = Number(sumacuenta)   + Number(registros[i]['detalleserv_acuenta']);
                            sumsaldo   = Number(sumsaldo) + Number(registros[i]['detalleserv_saldo']);
                        }
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        html += "<td id='horizontal'>";
                        html += "<font size='1'>"+registros[i]["detalleserv_descripcion"]+"</font><br>";
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
                        html += "<td>";
                        if(band){
                        html += "<a class='btn btn-success btn-foursquarexs' data-toggle='modal' data-target='#modaldetalle"+i+"' ><span class='fa fa-plus-circle'></span><br><small>"+registros[i]["detalleserv_codigo"]+"</small></a>";
                        html += "<!-- ---------------------- Inicio modal para registrar Nuevo Detalle de Servicio con información ----------------- -->";
                        html += "<div style='font-size: 10pt' class='modal fade' id='modaldetalle"+i+"' tabindex='-1' role='dialog' aria-labelledby='modaldetalleLabel'>";
                        html += "<div class='modal-dialog modal-lg' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<label>Producto:"+registros[i]["detalleserv_codigo"]+" Generar Servicio</label>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<form action='"+base_url+"detalle_serv/nuevodetallek' method='post' accept-charset='utf-8'>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<div class='col-md-3    '>";
                        html += "<label for='detalleserv_reclamo' class='control-label'>¿Reclamo?</label>";
                        html += "<div class='form-group'>";
                        var checked = "";
                        if(registros[i]["detalleserv_reclamo"]=="si")
                            checked = "checked";
                        html += "<input type='checkbox' name='detalleserv_reclamo' id='detalleserv_reclamo' value='si' "+checked+" />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-3'>";
                        html += "<label for='cattrab_id' class='control-label'>Tipo de Trabajo</label>";
                        html += "<div class='form-group'>";
                        html += "<select name='cattrab_id' class='form-control' id='cattrab_id'>";
                        html += "<!-- <option value=''>- TIPO TRABAJO -</option> -->";
                        for (var t = 0; t < all_categoria_trabajo.length; t++) {
                            var selected = (all_categoria_trabajo[t]["cattrab_id"] == registros[i]["cattrab_id"]) ? ' selected="selected"' : "";
                            html += "<option value='"+all_categoria_trabajo[t]["cattrab_id"]+"' "+selected+">"+all_categoria_trabajo[t]["cattrab_descripcion"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-3'>";
                        html += "<label for='procedencia_id' class='control-label'>Procedencia</label>";
                        html += "<div class='form-group'>";
                        html += "<select name='procedencia_id' class='form-control' id='procedencia_id'>";
                        html += "<!--<option value=''>- PROCEDENCIA -</option>-->";
                        for (var t = 0; t < all_procedencia.length; t++) {
                            var selected = (all_procedencia[t]["procedencia_id"] == registros[i]["procedencia_id"]) ? ' selected="selected"' : "";
                            html += "<option value='"+all_procedencia[t]["procedencia_id"]+"' "+selected+">"+all_procedencia[t]["procedencia_descripcion"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-3'>";
                        html += "<label for='tiempouso_id' class='control-label'>Tiempo de uso</label>";
                        html += "<div class='form-group'>";
                        html += "<select name='tiempouso_id' class='form-control' id='tiempouso_id'>";
                        html += "<!--<option value=''>- TIEMPO DE USO -</option>-->";
                        for (var t = 0; t < all_tiempo_uso.length; t++) {
                            var selected = (all_tiempo_uso[t]["tiempouso_id"] == registros[i]["tiempouso_id"]) ? ' selected="selected"' : "";
                            html += "<option value='"+all_tiempo_uso[t]["tiempouso_id"]+"' "+selected+">"+all_tiempo_uso[t]["tiempouso_descripcion"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='catserv_id' class='control-label'>Categoria Producto</label>";
                        html += "<div class='form-group'>";
                        html += "<select name='catserv_id' class='form-control' onchange='fetch_select(this.value);' id='catserv_id'>";
                        html += "<!--<option value=''>- CATEGORIA -</option>-->";
                        for (var t = 0; t < all_categoria_servicio.length; t++) {
                            var selected = (all_categoria_servicio[t]["catserv_id"] == registros[i]["catserv_id"]) ? ' selected="selected"' : "";
                            html += "<option value='"+all_categoria_servicio[t]["catserv_id"]+"' "+selected+">"+all_categoria_servicio[t]["catserv_descripcion"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='subcatserv_id' class='control-label'>Marca/Modelo</label>";
                        html += "<div class='form-group' id='new_select'>";
                        html += "<select name='subcatserv_id' class='form-control' id='subcatserv_id' onchange='ponerdescripcion(this.value);'>";
                        for (var t = 0; t < all_subcategoria_servicio.length; t++) {
                            var selected = (all_subcategoria_servicio[t]["subcatserv_id"] == registros[i]["subcatserv_id"]) ? ' selected="selected"' : "";
                            html += "<option value='"+all_subcategoria_servicio[t]["subcatserv_id"]+"' "+selected+">"+all_subcategoria_servicio[t]["subcatserv_descripcion"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_descripcion' class='control-label'><span class='text-danger'>*</span>Descripción</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='text' name='detalleserv_descripcion' value='"+registros[i]["detalleserv_descripcion"]+"' class='form-control' id='detalleserv_descripcion' required onKeyUp='this.value = this.value.toUpperCase();' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<label for='detalleserv_falla' class='control-label'><span class='text-danger'>*</span>Problema/Falla Segun Cliente</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='text' name='detalleserv_falla' value='"+registros[i]["detalleserv_falla"]+"' class='form-control' id='detalleserv_falla' required onKeyUp='this.value = this.value.toUpperCase();' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<label for='detalleserv_diagnostico' class='control-label'>Diagnóstico</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='text' name='detalleserv_diagnostico' value='";
                        if(registros[i]["detalleserv_diagnostico"] == null){ 
                            html += parametro["parametro_diagnostico"]; 
                        }else{
                            html += registros[i]["detalleserv_diagnostico"]
                        }
                        html += "' class='form-control' id='detalleserv_diagnostico' onKeyUp='this.value = this.value.toUpperCase();' onclick='this.select();' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_solucion' class='control-label'>Solución</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='text' name='detalleserv_solucion' value='";
                        if(registros[i]["detalleserv_solucion"] == null){ 
                            html += parametro["parametro_solucion"]; 
                        }else{
                            html += registros[i]["detalleserv_solucion"]
                        }
                        html += "' class='form-control' id='detalleserv_solucion' onKeyUp='this.value = this.value.toUpperCase();' onclick='this.select();' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_pesoentrada' class='control-label'>Peso Entrada(Gr.)</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='number' step='any' min='0' name='detalleserv_pesoentrada' value='"+Number(registros[i]["detalleserv_pesoentrada"]).toFixed(2)+"' class='form-control' id='detalleserv_pesoentrada' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_glosa' class='control-label'>Datos Adicionales</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='text' name='detalleserv_glosa' value='"+registros[i]["detalleserv_glosa"]+"' class='form-control' id='detalleserv_glosa' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_total' class='control-label'>Total</label>";
                        html += "<div class='form-group'>";
                        html += "<input style='background-color: #ffeebc;' type='number' step='any' min='0' name='detalleserv_total' value='"+Number(registros[i]["detalleserv_total"]).toFixed(2)+"' class='form-control' id='detalleserv_total' onkeyup='functotal()' onclick='this.select();' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_acuenta' class='control-label'>A cuenta</label>";
                        html += "<div class='form-group'>";
                        html += "<input style='background-color: #ffeebc;' type='number' step='any' min='0' name='detalleserv_acuenta' value='"+Number(registros[i]["detalleserv_acuenta"]).toFixed(2)+"' class='form-control' id='detalleserv_acuenta' onkeyup='funcacuenta()' onchange='funcacuentachange()' onclick='this.select();' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_saldo' class='control-label'>Saldo</label>";
                        html += "<div class='form-group'>";
                        html += "<input style='background-color: #ffeebc;' type='number' step='any' min='0' name='detalleserv_saldo' value='"+Number(registros[i]["detalleserv_saldo"]).toFixed(2)+"' class='form-control' id='detalleserv_saldo' readonly onclick='this.select();' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_fechaentrega' class='control-label'>Fecha Entrega</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='date' name='detalleserv_fechaentrega' value='";
                        var fecha = new Date();
                        var resfecha = moment(fecha).format("YYYY-MM-DD")
                        /*fecha.setDate(fecha.getDate()+1);
                        var mes = fecha.getMonth();
                        var dia = fecha.getDate();
                        if(fecha.getMonth()<10){ mes = "0"+fecha.getMonth();}
                        if(fecha.getDate()<10){ dia = "0"+fecha.getDate();}
                        var resfecha = fecha.getFullYear()+"-"+mes+"-"+dia;*/
                        html += resfecha;
                        html += "' class='form-control' id='detalleserv_fechaentrega' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='detalleserv_horaentrega' class='control-label'>Hora Entrega</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='time' name='detalleserv_horaentrega' value='";
                        
                        var hora = fecha.getHours();
                        var minutos = fecha.getMinutes();
                        
                        if(hora<10){hora='0'+hora}
                        if(minutos<10){minutos='0'+minutos}
                        var reshora = hora+":"+minutos;
                        html += reshora;
                        html += "' class='form-control' id='detalleserv_horaentrega' />";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-4'>";
                        html += "<label for='responsable_id' class='control-label'><span class='text-danger'>*</span>Tec. Responsable</label>";
                        html += "<div class='form-group'>";
                        html += "<select name='responsable_id' class='form-control' id='responsable_id' required>";
                        html += "<!--<option value=''>- RESPONSABLE -</option>-->";
                        for (var t = 0; t < all_responsable.length; t++) {
                            var selected = (all_responsable[t]["usuario_id"] == registros[i]["responsable_id"]) ? ' selected="selected"' : "";
                            html += "<option value='"+all_responsable[t]["usuario_id"]+"' "+selected+">"+all_responsable[t]["usuario_nombre"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += "</div>";
                        html += "<input type='hidden' name='cliente_id' value='"+registros[i]["cliente_id"]+"' class='form-control' id='cliente_id' />";
                        html += "<input type='hidden' name='detalleserv_codigo' value='"+registros[i]["detalleserv_codigo"]+"' class='form-control' id='detalleserv_codigo' />";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button type='submit' class='btn btn-success'>";
                        html += "<i class='fa fa-check'></i> Guardar";
                        html += "</button>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'>";
                        html += "<i class='fa fa-times'></i> Cancelar</a>";
                        html += "</div>";
                        html += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- Fin modal para registrar Nuevo Detalle de Servicio con información ----------------- -->";
                                                       
                        }else{
                            html += registros[i]["detalleserv_codigo"];
                        }
                        html += "</td>";
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
                        
                        html += "<span style='display: none' id='insumosusadoscosto"+registros[i]['detalleserv_id']+"'></span>"
                        html += misinsumos+"<span id='insumosusados"+registros[i]['detalleserv_id']+"'></span>"+"</td>";
                        html += "<td>"+registros[i]["detalleserv_glosa"]+"</td>";
                        html += "<td id='alinear'>"+ numberFormat(Number(registros[i]["detalleserv_total"]).toFixed(2))+"</td>";
                        html += "<td id='alinear'>"+ numberFormat(Number(registros[i]["detalleserv_acuenta"]).toFixed(2))+"</td>";
                        html += "<td id='alinear'>"+ numberFormat(Number(registros[i]["detalleserv_saldo"]).toFixed(2))+"</td>";

                        html += "<tr>";
                        band = false;
                        }
                    $("#detallekardex").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#detallekardex").html(html);
        }
        
    });   

}

function restar(){
    
    var uno, dos, tres, operacion;
  
      uno = $('#detalleserv_total');
      dos = $('#detalleserv_acuenta');
      tres = $('#detalleserv_saldo');
      
      operacion = parseFloat(uno.val()) - parseFloat(dos.val());
      tres.val(operacion);
    
  }
function functotal(){
      
      var dos;
      dos = $('#detalleserv_acuenta').val();
      
      if(dos != ""){
        restar()
      }
      
  }
function funcacuenta(){
    var uno;
      uno = $('#detalleserv_total').val();
      
      if(uno != ""){
        restar()
      }
}
function funcacuentachange(){
    if($("#detalleserv_saldo").val() <0){
      alert("Saldo no debe ser negativo");
      $('#detalleserv_acuenta').css('color', 'red');
      $('#detalleserv_saldo').css('color', 'red');
      $('#detalleserv_acuenta').focus();
    }else{
      $('#detalleserv_acuenta').css('color', 'black');
      $('#detalleserv_saldo').css('color', 'black');
    }
}
function ponerdescripcion(catserv){
    //$('#catserv_id').val();
    $('#subcatserv_id').val();
    $('#detalleserv_descripcion').val($('#catserv_id option:selected').text()+' '+$('#subcatserv_id option:selected').text());
    $('#detalleserv_descripcion').focus();
}
