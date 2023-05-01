function reporte_general(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'reportes/reporte_buscarreporte';
    var lamoneda_id   = document.getElementById('lamoneda_id').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var filtrar = document.getElementById('filtrar').value;
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var vendedor_id = document.getElementById('vendedor_id').value;
    var prevendedor_id = document.getElementById('prevendedor_id').value;
    var tipotrans_id = document.getElementById('tipotrans_id').value;
    var forma_id = document.getElementById('forma_id').value;
    var comprobante = document.getElementById('comprobante').value;
    var zona_id = document.getElementById('zona_id').value;
    //var espedido = document.getElementById('espedido').value;
    var ventapreventa = document.getElementById('ventapreventa').value;
    var cliente_id = document.getElementById('cliente_id').value;
    var producto_id = document.getElementById('producto_id').value;
    var usuario_id = document.getElementById('usuario_id').value; // para servicios
    var preferencia_id = document.getElementById('preferencia_id').value;
    var clasificador_id = document.getElementById('clasificador_id').value;
    var categoria_id = document.getElementById('categoria_id').value;
    var subcategoria_id = document.getElementById('subcategoria_id').value;
    let decimales = document.getElementById('decimales').value;
    document.getElementById('loader').style.display = 'block';
    $.ajax({url: controlador,
            type:"POST",
            data:{filtrar:filtrar, fecha_desde:fecha_desde, fecha_hasta:fecha_hasta, vendedor_id:vendedor_id,
                  prevendedor_id:prevendedor_id, tipotrans_id:tipotrans_id, forma_id:forma_id,
                  comprobante:comprobante, zona_id:zona_id, ventapreventa:ventapreventa,
                  cliente_id:cliente_id, producto_id:producto_id, usuario_id:usuario_id,
                  preferencia_id:preferencia_id, clasificador_id:clasificador_id, categoria_id:categoria_id,
                  subcategoria_id:subcategoria_id},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                const myregistros = JSON.stringify(registros);
                $("#resproducto").val(myregistros);
                if (registros != null){
                    var cantidades = Number(0);
                    var total = Number(0);
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                    var cuotas = Number(0);
                    var costos = Number(0);
                    var utilidades = Number(0);
                    var descuentos = Number(0);
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                    for (var i = 0; i < n ; i++){
                        total += Number(registros[i]["detalleven_total"]);
                        cantidades += Number(registros[i]["detalleven_cantidad"]);
                        if(filtrar == 1 || filtrar == 2){
                            cuotas += Number(registros[i]["credito_cuotainicial"]);
                        }
                        descuentos += Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"]);
                        costos += Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"]);
                        var utilidad = Number(Number(registros[i]["detalleven_total"])-(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])));
                        utilidades += Number(utilidad);
                        html += "<tr>";
                        html += "<td align='center' style='width:5px;'>"+(i+1)+"</td>";
                        html += "<td> "+registros[i]["producto_nombre"]+" </td>";                                            
                        html += "<td align='center' style='width:110px;'>";
                        if(filtrar == 1){
                            html += moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["venta_hora"];
                        }else if(filtrar == 2){
                            html += moment(registros[i]["detalleserv_fechaentregado"]).format('DD/MM/YYYY')+"-"+registros[i]["detalleserv_horaentregado"];
                        }else if(filtrar == 3){
                            html += moment(registros[i]["produccion_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["produccion_hora"];
                        }
                        html += "</td>";
                        html += "<td align='center'>";
                        if(filtrar == 1){
                            html += registros[i]["venta_id"];
                        }else if(filtrar == 2){
                            html += registros[i]["servicio_id"];
                        }else if(filtrar == 3){
                            html += registros[i]["produccion_id"];
                        }
                        html += "</td>";  
                        if(filtrar == 1 || filtrar == 2){
                            html += "<td align='center'>";
                            html += Number(registros[i]["factura_numero"]) // NUMERO FACTURA
                            html += "</td>";
                        }
                        if(filtrar == 1 || filtrar == 2){
                            html += "<td align='center'>";
                            html += registros[i]["tipotrans_nombre"];
                            html += "</td>";
                        }
                        if(filtrar == 1 || filtrar == 2){
                            html += "<td align='right'>";
                            html += numberFormat(Number(registros[i]["credito_cuotainicial"]).toFixed(decimales)); // CUOTA INICIAL
                            html += "</td>";
                        }
                        html += "<td align='center'> "+registros[i]["producto_unidad"]+" </td>";                                          
                        html += "<td align='center'> ";
                        let partes = registros[i]["detalleven_cantidad"];
                        let partes1 = partes.toString();
                        let partes2 = partes1.split('.');
                        if (partes2[1] == 0) { 
                            lacantidad = partes2[0]; 
                        }else{ 
                            lacantidad = numberFormat(Number(registros[i]["detalleven_cantidad"]).toFixed(decimales))
                            //lacantidad = number_format($d['detalleven_cantidad'],2,'.',','); 
                        }
                        html += lacantidad;
                        html += " </td>"; 
                        html += "<td align='right'> "+numberFormat(Number(registros[i]["detalleven_precio"]).toFixed(decimales))+" </td>"; 
                        html += "<td align='right'> "+numberFormat(Number(Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"])).toFixed(decimales))+" </td>";
                        html += "<td align='right'><b>"+numberFormat(Number(registros[i]["detalleven_total"]).toFixed(decimales))+"</b></td>";
                        html += "<td class='text-right'> ";
                        if(lamoneda_id == 1){
                            total_otram = Number(registros[i]["detalleven_total"])/Number(registros[i]["detalleven_tc"])
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = Number(registros[i]["detalleven_total"])*Number(registros[i]["detalleven_tc"])
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                        if(tipousuario_id == 1){
                            html += "<td align='right'> "+numberFormat(Number(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])).toFixed(decimales))+" </td>";
                            html += "<td align='right'> "+numberFormat(Number(utilidad).toFixed(decimales))+" </td>"; 
                        }
                        if(filtrar == 1 || filtrar == 2){
                            html += "<td align='center'>";
                            html += registros[i]["cliente_nombre"];
                            html += "</td>"; 
                        }
                        html += "<td align='center'>"+registros[i]["usuario_nombre"]+"</td>"; 
                        html += "<td class='no-print'>";
                        if(filtrar == 1){ //para ventas
                            html += "<a href='"+base_url+"venta/modificar_venta/"+registros[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modifica el detalle/cliente de la venta'><span class='fa fa-edit'></span></a>";
                            html += "<a href='"+base_url+"factura/imprimir_recibo/"+registros[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-print'></span></a>";
                        }else if(filtrar == 2){ //para servicios
                            html += "<a href='"+base_url+"detalle_serv/modificareldetalle/"+registros[i]['servicio_id']+"/"+registros[i]['detalleserv_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modifica el detalle de un servicio'><span class='fa fa-edit'></span></a>";
                            if(registros[i]['factura_id'] >0 ){
                                html += "<a href='"+base_url+"factura/imprimir_factura_id/"+registros[i]['factura_id']+"/0"+"' class='btn btn-warning btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-list-alt'></span></a>";
                            }else{
                               html += "<a href='"+base_url+"servicio/imprimir_notaentrega/"+registros[i]['servicio_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de entrega'><span class='fa fa-print'></span></a>";
                            }
                        }else if(filtrar == 3){ //para produccion
                            html += "<a href='"+base_url+"produccion/imprimir_nota/"+registros[i]['produccion_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de producción'><span class='fa fa-print'></span></a>";
                        }
                        html += "</td>";
                        html += "</tr>";
                    }
                        html += "<tr>";
                        html += "<th></th>";
                        html += "<th></th>";
                        html += "<th></th>";
                        html += "<th></th>";
                        if(filtrar == 1 || filtrar == 2){
                            html += "<th></th>";
                            html += "<th></th>";
                        }
                        if(filtrar == 1 || filtrar == 2){
                            html += "<th style='text-align:right'>";
                            numberFormat(Number(cuotas).toFixed(decimales))
                            html += "</th>";
                        }
                        html += "<th></th>";
                        html += "<th>"+numberFormat(Number(cantidades).toFixed(decimales))+"</th>";
                        html += "<th></th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(descuentos).toFixed(decimales))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(total).toFixed(decimales))+"</th>";
                        html += "<th style='text-align:right'>"+numberFormat(Number(total_otramoneda).toFixed(decimales))+"</th>";
                        if(tipousuario_id == 1){
                            html += "<th style='text-align:right'>"+numberFormat(Number(costos).toFixed(decimales))+"</th>";
                            html += "<th style='text-align:right'>"+numberFormat(Number(utilidades).toFixed(decimales))+"</th>";
                        }
                        if(filtrar == 1 || filtrar == 2){
                            html += "<th></th>";
                        }
                        html += "<th></th>";
                        html += "<th></th>";
                        html += "</tr>";
                   desde1 = "Desde: <b>"+moment(fecha_desde).format('DD/MM/YYYY')+"</b>";
                   hasta1 = "Hasta: <b>"+moment(fecha_hasta).format('DD/MM/YYYY')+"</b>";
                   $("#resultado_reporte").html(html);
                   $("#desde").html(desde1);
                   $("#hasta").html(hasta1);
                   document.getElementById('loader').style.display = 'none';
                    $('#modalbuscarcliente').modal('hide');
                    $('#modalbuscarcliente').on('hidden.bs.modal', function () {
                    $('#tablarecliente').html('');
                    });
            }else{
                    document.getElementById('loader_bcliente').style.display = 'none';
                }
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablarecliente").html(html);
            }
    });
}

function buscarcliente(e) {
    tecla = (document.all) ? e.keyCode : e.which;  
    if (tecla==13){ 
        tablarecliente();
    }
}

function tablarecliente(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/buscarcliente';
    var parametro = document.getElementById('buscar_elcliente').value;
    document.getElementById('loader_bcliente').style.display = 'block';
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                $("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>N</th>";
                    //html += "<th>ID</th>";
                    html += "<th>Cliente</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablarecliente'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<div class='col-md-12'>";
                        html += "<b>"+registros[i]["cliente_nombre"]+"</b>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<button type='button' onclick='repocliente("+JSON.stringify(registros[i]["cliente_nombre"])+", "+registros[i]["cliente_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-search'></i></button>";
                        html += "</td>";
                        html += "</tr>";
                   }
                       html += "</tbody>"
                   $("#tablarecliente").html(html);
                   document.getElementById('loader_bcliente').style.display = 'none';
                }else{
                    document.getElementById('loader_bcliente').style.display = 'none';
                }
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablarecliente").html(html);
            }
    });
}

function repocliente(cliente_nombre, cliente_id){
    $("#cliente_id").val(cliente_id);
    $("#cliente_nombre").val(cliente_nombre);
    $("#buscar_elcliente").val("");
    $("#tablarecliente").html("");
    $('#modalbuscarcliente').modal('hide');
}

function clientetodos(){
    $("#cliente_id").val(0);
    $("#cliente_nombre").val("TODOS");
}

function mostrar_masfventa(){
    $('#masdeventas').css('display','block');
    $("#boton_menosfventa").css("display", "block");
    $("#boton_masfventa").css("display", "none");
}

function mostrar_menosfventa(){
    $('#masdeventas').css('display','none');
    $("#boton_masfventa").css("display", "block");
    $("#boton_menosfventa").css("display", "none");
}

function buscarproducto(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
        tablareproducto();    
    }
}

function tablareproducto(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'compra/buscarcompra';
    var parametro = document.getElementById('buscar_elproducto').value
    document.getElementById('loader_bproducto').style.display = 'block';
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                $("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){   
                    /*var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;*/
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>N</th>";
                    //html += "<th>ID</th>";
                    html += "<th>Producto</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<div class='col-md-12'>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<button type='button' onclick='repoproducto("+JSON.stringify(registros[i]["producto_nombre"])+", "+registros[i]["producto_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-search'></i></button>";
                        //html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                        html += "</tbody>"
                   $("#tablareproducto").html(html);
                    document.getElementById('loader_bproducto').style.display = 'none';
                }else{
                    document.getElementById('loader_bproducto').style.display = 'none';
                }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
    });
}
function repoproducto(producto_nombre, producto_id){
    $("#producto_id").val(producto_id);
    $("#producto_nombre").val(producto_nombre);
    $("#buscar_elproducto").val("");
    $("#tablareproducto").html("");
    $('#modalbuscarproducto').modal('hide');
}

function productotodos(){
    $("#producto_id").val(0);
    $("#producto_nombre").val("TODOS");
}

/* funcion que recupera las subcategorias de una categoria de producto */
function mostrar_subcategoriaproducto(categoria_id){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    controlador = base_url+'producto/obtener_subcategoria/';
    $.ajax({url: controlador,
           type:"POST",
           data:{categoria_id:categoria_id},
           success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    html = "";
                    html += "<select class='btn btn-primary btn-sm form-control' name='subcategoria_id' id='subcategoria_id' required>";
                    html += "<option value='0'>TODOS</option>";
                    for (var i = 0; i < n ; i++){
                        html += "<option value='"+registros[i]["subcategoria_id"]+"'>";
                        html += registros[i]["subcategoria_nombre"];
                        html += "</option>";
                    }
                    html += "</select>";
                    //$("#subcategoria_id").append(html);
                    $("#subcategoria_id").replaceWith(html);
                    /*html1 ="";
                    html1 +="<a data-toggle='modal' data-target='#modalsubcategoria' class='btn btn-warning' title='Registrar Nueva Sub Categoria'>";
                    html1 +="<i class='fa fa-plus-circle'></i></a>";
                    $("#parasubcat").replaceWith(html1);*/
            }
        },
        error:function(respuesta){
           html = "";
           $("#producto_nombreenvase").html(html);
        }
    });   
}

function tipode_reporte(){
    var tipo_reporte  = document.getElementById('filtrar').value;
    var nombre_moneda = document.getElementById('nombre_moneda').value;
    if(tipo_reporte == 1){ //para ventas
        $('#serv_vendedor').css('display','block');
        $('#serv_prevendedor').css('display','block');
        $('#serv_zona').css('display','block');
        $('#serv_ventapreventa').css('display','block');
        $('#serv_cliente').css('display','block');
        $('#titulo_tres').css('display','table-cell');
        $('#titulo_cuatro').css('display','table-cell');
        $('#titulo_cinco').css('display','table-cell');
        $('#titulo_seis').css('display','table-cell');
        $('#serv_usuario').css('display','none');
        $('#titulo_uno').html('FECHA<br>VENTA');
        $('#titulo_dos').html('NUM.<br>VENTA');
        $('#titulo_tres').html('NUM.<br>DOC.');
        $('#titulo_cuatro').html('TIPO<br>VENTA');
        $('#titulo_cinco').html('CUOTA<br>INIC.('+nombre_moneda+')');
        $('#titulo_seis').html('CLIENTE');
        $('#titulo_siete').html('CAJERO');
        $('#prod_tipotrans').css('display','block');
        $('#prod_forma').css('display','block');
        $('#prod_comprobante').css('display','block');
        $("#resultado_reporte").html("");
        //$('#serv_preferencia').css('display','block');
        //$('#serv_clasificador').css('display','block');
        //$('#serv_categoria').css('display','block');
        //$('#serv_subcategoria').css('display','block');
        //$('#serv_responsable').css('display','none');
        //$('#serv_recepcionadopor').css('display','none');
    }else if(tipo_reporte == 2){ //para servicios
        $('#serv_vendedor').css('display','none');
        $('#serv_prevendedor').css('display','none');
        $('#serv_zona').css('display','none');
        $('#serv_ventapreventa').css('display','none');
        $('#serv_cliente').css('display','block');
        $('#serv_usuario').css('display','block');
        $('#prod_tipotrans').css('display','block');
        $('#prod_forma').css('display','block');
        $('#prod_comprobante').css('display','block');
        $('#titulo_tres').css('display','table-cell');
        $('#titulo_cuatro').css('display','table-cell');
        $('#titulo_cinco').css('display','table-cell');
        $('#titulo_seis').css('display','table-cell');
        $('#titulo_uno').html('FECHA<br>SERVICIO');
        $('#titulo_dos').html('NUM.<br>SERV.');
        $('#titulo_tres').html('NUM.<br>DOC.');
        $('#titulo_cuatro').html('TIPO<br>SERV.');
        $('#titulo_cinco').html('CUOTA<br>INIC.('+nombre_moneda+')');
        $('#titulo_seis').html('CLIENTE');
        $('#titulo_siete').html('DESPACHADO<br>POR');
        $("#resultado_reporte").html("");
    }else if(tipo_reporte == 3){ //para produccion
        $('#serv_vendedor').css('display','none');
        $('#serv_prevendedor').css('display','none');
        $('#prod_tipotrans').css('display','none');
        $('#prod_forma').css('display','none');
        $('#prod_comprobante').css('display','none');
        $('#serv_zona').css('display','none');
        $('#serv_ventapreventa').css('display','none');
        $('#serv_cliente').css('display','none');
        $('#serv_usuario').css('display','block');
        $('#titulo_uno').html('FECHA<br>PROD.');
        $('#titulo_dos').html('NUM.<br>PROD.');
        /*$('#titulo_tres').html('-');
        $('#titulo_cuatro').html('-');
        $('#titulo_cinco').html('-');
        $('#titulo_seis').html('-');*/
        $('#titulo_tres').css('display','none');
        $('#titulo_cuatro').css('display','none');
        $('#titulo_cinco').css('display','none');
        $('#titulo_seis').css('display','none');
        $('#titulo_siete').html('PRODUCIDO<br>POR');
        $("#resultado_reporte").html("");
    }
}
/* exporta a excel del reporte general */
function generarexcel_reportegrl(){
    var resproducto = document.getElementById('resproducto').value;
    if(resproducto == ""){
        alert("Primero debe realizar una búsqueda");
    }else{
        var filtrar = document.getElementById('filtrar').value;
        var tipousuario_id = document.getElementById('tipousuario_id').value;
        var nombre_moneda = document.getElementById('nombre_moneda').value;
        var lamoneda_id = document.getElementById('lamoneda_id').value;
        var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
        let decimales = JSON.parse(document.getElementById('decimales').value);
        var registros = JSON.parse(resproducto);
        var showLabel = true;
        var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
        var tam = registros.length;
        var otramoneda_nombre = "";
        
        var cantidades = Number(0);
        var total = Number(0);
        var total_otramoneda = Number(0);
        var total_otram = Number(0);
        var cuotas = Number(0);
        var costos = Number(0);
        var utilidades = Number(0);
        var descuentos = Number(0);
        html = "";
        var CSV = 'sep=,' + '\r\n\n';
        //This condition will generate the Label/Header
        if(filtrar == 1){
            if (showLabel) {
                var row = "";
                row += 'Nro.' + ',';
                row += 'PRODUCTO' + ',';
                row += 'FECHA VENTA' + ',';
                row += 'NUM. VENTA' + ',';
                row += 'NUM. DOC.' + ',';
                row += 'TIPO VENTA' + ',';
                row += 'CUOTA INIC.(' +nombre_moneda+ '),';
                row += 'UNIDAD' + ',';
                row += 'CANT.' + ',';
                row += 'PRECIO UNIT.(' +nombre_moneda+ '),';
                row += 'DESCUENTO(' +nombre_moneda+ '),';
                row += 'PRECIO TOTAL(' +nombre_moneda+ '),';
                row += 'PRECIO TOTAL(';
                if(lamoneda_id == 1){
                    otramoneda_nombre = lamoneda[1]['moneda_descripcion'];
                }else{
                    otramoneda_nombre = lamoneda[0]['moneda_descripcion'];
                }
                row += otramoneda_nombre+ '),';
                if(tipousuario_id == 1){
                    row += 'COSTO(' +nombre_moneda+ '),';
                    row += 'UTILIDAD(' +nombre_moneda+ '),';
                }
                row += 'CLIENTE' + ',';
                row += 'CAJERO' + ',';
                row = row.slice(0, -1);
                //append Label row with line break
                CSV += row + '\r\n';
            }
            //1st loop is to extract each row
            for (var i = 0; i < tam; i++) {
                total += Number(registros[i]["detalleven_total"]);
                cantidades += Number(registros[i]["detalleven_cantidad"]);
                cuotas += Number(registros[i]["credito_cuotainicial"]);
                descuentos += Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"]);
                costos += Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"]);
                var utilidad = Number(Number(registros[i]["detalleven_total"])-(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])));
                utilidades += Number(utilidad);
                var row = "";
                row += (i+1)+',';
                row += '"' +registros[i]["producto_nombre"]+ '",';
                row += '"' +moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["venta_hora"]+ '",';
                row += '"' +registros[i]["venta_id"]+ '",';
                row += '"' +Number(registros[i]["factura_id"])+ '",';
                row += '"' +registros[i]["tipotrans_nombre"]+ '",';
                row += '"' +numberFormat(Number(registros[i]["credito_cuotainicial"]).toFixed(decimales))+ '",';
                row += '"' +registros[i]["producto_unidad"]+ '",';
                row += '"' +registros[i]["detalleven_cantidad"]+ '",';
                row += '"' +numberFormat(Number(registros[i]["detalleven_precio"]).toFixed(decimales))+ '",';
                row += '"' +numberFormat(Number(Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"])).toFixed(decimales))+ '",';
                row += '"' +numberFormat(Number(registros[i]["detalleven_total"]).toFixed(decimales))+ '",';
                if(lamoneda_id == 1){
                    total_otram = Number(registros[i]["detalleven_total"])/Number(registros[i]["detalleven_tc"])
                    total_otramoneda += total_otram;
                }else{
                    total_otram = Number(registros[i]["detalleven_total"])*Number(registros[i]["detalleven_tc"])
                    total_otramoneda += total_otram;
                }
                row += '"' +numberFormat(Number(total_otram).toFixed(decimales))+ '",';
                if(tipousuario_id == 1){
                    row += '"' +numberFormat(Number(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])).toFixed(decimales))+ '",';
                    row += '"' +numberFormat(Number(utilidad).toFixed(decimales))+ '",';
                }
                row += '"' +registros[i]["cliente_nombre"]+ '",';
                row += '"' +registros[i]["usuario_nombre"]+ '",';
                row.slice(0, row.length - 1);
                //add a line break after each row
                CSV += row + '\r\n';
            }
            row = '\r\n';
            row += '\r\n';
            row += '"",';
            row += '"",';
            row += '"",';   
            row += '"",';   
            row += '"",';   
            row += '"",';
            row += '"'+numberFormat(Number(cuotas).toFixed(decimales))+'",';
            row += '"",';
            row += '"'+numberFormat(Number(cantidades).toFixed(decimales))+'",';
            row += '"",';
            row += '"'+numberFormat(Number(descuentos).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(total).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(total_otramoneda).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(costos).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(utilidades).toFixed(decimales))+'",';
            row += '"",';
            row += '"",';
            row += '"",';
            row += '\r\n';
            CSV += row + '\r\n';
        }else if(filtrar == 2){
            if (showLabel) {
                var row = "";
                row += 'Nro.' + ',';
                row += 'PRODUCTO' + ',';
                row += 'FECHA SERVICIO' + ',';
                row += 'NUM. SERV.' + ',';
                row += 'NUM. DOC.' + ',';
                row += 'TIPO SERV.' + ',';
                row += 'CUOTA INIC.(' +nombre_moneda+ '),';
                row += 'UNIDAD' + ',';
                row += 'CANT.' + ',';
                row += 'PRECIO UNIT.(' +nombre_moneda+ '),';
                row += 'DESCUENTO(' +nombre_moneda+ '),';
                row += 'PRECIO TOTAL(' +nombre_moneda+ '),';
                row += 'PRECIO TOTAL(';
                if(lamoneda_id == 1){
                    otramoneda_nombre = lamoneda[1]['moneda_descripcion'];
                }else{
                    otramoneda_nombre = lamoneda[0]['moneda_descripcion'];
                }
                row += otramoneda_nombre+ '),';
                if(tipousuario_id == 1){
                    row += 'COSTO(' +nombre_moneda+ '),';
                    row += 'UTILIDAD(' +nombre_moneda+ '),';
                }
                row += 'CLIENTE' + ',';
                row += 'DESPACHADO POR' + ',';
                row = row.slice(0, -1);
                //append Label row with line break
                CSV += row + '\r\n';
            }
            //1st loop is to extract each row
            for (var i = 0; i < tam; i++) {
                total += Number(registros[i]["detalleven_total"]);
                cantidades += Number(registros[i]["detalleven_cantidad"]);
                cuotas += Number(registros[i]["credito_cuotainicial"]);
                descuentos += Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"]);
                costos += Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"]);
                var utilidad = Number(Number(registros[i]["detalleven_total"])-(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])));
                utilidades += Number(utilidad);
                var row = "";
                row += (i+1)+',';
                row += '"' +registros[i]["producto_nombre"]+ '",';
                row += '"' +moment(registros[i]["detalleserv_fechaentregado"]).format('DD/MM/YYYY')+"-"+registros[i]["detalleserv_horaentregado"]+ '",';
                row += '"' +registros[i]["servicio_id"]+ '",';
                row += '"' +Number(registros[i]["factura_id"])+ '",';
                row += '"' +registros[i]["tipotrans_nombre"]+ '",';
                row += '"' +numberFormat(Number(registros[i]["credito_cuotainicial"]).toFixed(decimales))+ '",';
                row += '"' +registros[i]["producto_unidad"]+ '",';
                row += '"' +registros[i]["detalleven_cantidad"]+ '",';
                row += '"' +numberFormat(Number(registros[i]["detalleven_precio"]).toFixed(decimales))+ '",';
                row += '"' +numberFormat(Number(Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"])).toFixed(decimales))+ '",';
                row += '"' +numberFormat(Number(registros[i]["detalleven_total"]).toFixed(decimales))+ '",';
                if(lamoneda_id == 1){
                    total_otram = Number(registros[i]["detalleven_total"])/Number(registros[i]["detalleven_tc"])
                    total_otramoneda += total_otram;
                }else{
                    total_otram = Number(registros[i]["detalleven_total"])*Number(registros[i]["detalleven_tc"])
                    total_otramoneda += total_otram;
                }
                row += '"' +numberFormat(Number(total_otram).toFixed(decimales))+ '",';
                if(tipousuario_id == 1){
                    row += '"' +numberFormat(Number(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])).toFixed(decimales))+ '",';
                    row += '"' +numberFormat(Number(utilidad).toFixed(decimales))+ '",';
                }
                row += '"' +registros[i]["cliente_nombre"]+ '",';
                row += '"' +registros[i]["usuario_nombre"]+ '",';
                row.slice(0, row.length - 1);
                //add a line break after each row
                CSV += row + '\r\n';
            }
            row = '\r\n';
            row += '\r\n';
            row += '"",';
            row += '"",';
            row += '"",';   
            row += '"",';   
            row += '"",';   
            row += '"",';
            row += '"'+numberFormat(Number(cuotas).toFixed(decimales))+'",';
            row += '"",';
            row += '"'+numberFormat(Number(cantidades).toFixed(decimales))+'",';
            row += '"",';
            row += '"'+numberFormat(Number(descuentos).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(total).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(total_otramoneda).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(costos).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(utilidades).toFixed(decimales))+'",';
            row += '"",';
            row += '"",';
            row += '"",';
            row += '\r\n';
            CSV += row + '\r\n';
        }else if(filtrar == 3){
            if (showLabel) {
                var row = "";
                row += 'Nro.' + ',';
                row += 'PRODUCTO' + ',';
                row += 'FECHA PROD.' + ',';
                row += 'NUM. PROD.' + ',';
                row += 'UNIDAD' + ',';
                row += 'CANT.' + ',';
                row += 'PRECIO UNIT.(' +nombre_moneda+ '),';
                row += 'DESCUENTO(' +nombre_moneda+ '),';
                row += 'PRECIO TOTAL(' +nombre_moneda+ '),';
                row += 'PRECIO TOTAL(';
                if(lamoneda_id == 1){
                    otramoneda_nombre = lamoneda[1]['moneda_descripcion'];
                }else{
                    otramoneda_nombre = lamoneda[0]['moneda_descripcion'];
                }
                row += otramoneda_nombre+ '),';
                if(tipousuario_id == 1){
                    row += 'COSTO(' +nombre_moneda+ '),';
                    row += 'UTILIDAD(' +nombre_moneda+ '),';
                }
                row += 'PRODUCIDO POR' + ',';
                row = row.slice(0, -1);
                //append Label row with line break
                CSV += row + '\r\n';
            }
            //1st loop is to extract each row
            for (var i = 0; i < tam; i++) {
                total += Number(registros[i]["detalleven_total"]);
                cantidades += Number(registros[i]["detalleven_cantidad"]);
                //cuotas += Number(registros[i]["credito_cuotainicial"]);
                descuentos += Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"]);
                costos += Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"]);
                var utilidad = Number(Number(registros[i]["detalleven_total"])-(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])));
                utilidades += Number(utilidad);
                var row = "";
                row += (i+1)+',';
                row += '"' +registros[i]["producto_nombre"]+ '",';
                row += '"' +moment(registros[i]["produccion_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["produccion_hora"]+ '",';
                row += '"' +registros[i]["produccion_id"]+ '",';
                //row += '"' +Number(registros[i]["factura_id"])+ '",';
                //row += '"' +registros[i]["tipotrans_nombre"]+ '",';
                //row += '"' +numberFormat(Number(registros[i]["credito_cuotainicial"]).toFixed(decimales))+ '",';
                row += '"' +registros[i]["producto_unidad"]+ '",';
                row += '"' +registros[i]["detalleven_cantidad"]+ '",';
                row += '"' +numberFormat(Number(registros[i]["detalleven_precio"]).toFixed(decimales))+ '",';
                row += '"' +numberFormat(Number(Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"])).toFixed(decimales))+ '",';
                row += '"' +numberFormat(Number(registros[i]["detalleven_total"]).toFixed(decimales))+ '",';
                if(lamoneda_id == 1){
                    total_otram = Number(registros[i]["detalleven_total"])/Number(registros[i]["detalleven_tc"])
                    total_otramoneda += total_otram;
                }else{
                    total_otram = Number(registros[i]["detalleven_total"])*Number(registros[i]["detalleven_tc"])
                    total_otramoneda += total_otram;
                }
                row += '"' +numberFormat(Number(total_otram).toFixed(decimales))+ '",';
                if(tipousuario_id == 1){
                    row += '"' +numberFormat(Number(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])).toFixed(decimales))+ '",';
                    row += '"' +numberFormat(Number(utilidad).toFixed(decimales))+ '",';
                }
                //row += '"' +registros[i]["cliente_nombre"]+ '",';
                row += '"' +registros[i]["usuario_nombre"]+ '",';
                row.slice(0, row.length - 1);
                //add a line break after each row
                CSV += row + '\r\n';
            }
            row = '\r\n';
            row += '\r\n';
            row += '"",';
            row += '"",';
            row += '"",';   
            row += '"",';   
            //row += '"",';   
            //row += '"",';
            //row += '"'+numberFormat(Number(cuotas).toFixed(decimales))+'",';
            row += '"",';
            row += '"'+numberFormat(Number(cantidades).toFixed(decimales))+'",';
            row += '"",';
            row += '"'+numberFormat(Number(descuentos).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(total).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(total_otramoneda).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(costos).toFixed(decimales))+'",';
            row += '"'+numberFormat(Number(utilidades).toFixed(decimales))+'",';
            row += '"",';
            //row += '"",';
            row += '"",';
            row += '\r\n';
            CSV += row + '\r\n';
        }
        if (CSV == '') {
            alert("Invalid data");
            return;
        }

        //Generate a file name
        var fileName = "Reporte_";
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
    }
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
