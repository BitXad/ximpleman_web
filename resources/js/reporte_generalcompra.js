function reporte_generalcompra(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'reportes/reporte_buscarreportecompra';
    var lamoneda_id   = document.getElementById('lamoneda_id').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var filtrar = 4; // COMPRA
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;

    // Reutilizamos el mismo select (vendedor_id) como USUARIO que registró la compra
    var usuario_id = document.getElementById('vendedor_id').value;

    var tipotrans_id = document.getElementById('tipotrans_id').value;
    var forma_id = document.getElementById('forma_id').value;
    var comprobante = document.getElementById('comprobante').value; // lo usaremos como documento_respaldo_id
    var proveedor_id = document.getElementById('proveedor_id').value;
    var producto_id = document.getElementById('producto_id').value;

    // filtros opcionales por producto (si existen en tu tabla producto)
    var preferencia_id = document.getElementById('preferencia_id').value;
    var clasificador_id = document.getElementById('clasificador_id').value;
    var categoria_id = document.getElementById('categoria_id').value;
    var subcategoria_id = document.getElementById('subcategoria_id').value;

    let decimales = document.getElementById('decimales').value;
    document.getElementById('loader').style.display = 'block';

    $.ajax({
        url: controlador,
        type:"POST",
        data:{
            filtrar:filtrar,
            fecha_desde:fecha_desde,
            fecha_hasta:fecha_hasta,
            usuario_id:usuario_id,
            tipotrans_id:tipotrans_id,
            forma_id:forma_id,
            comprobante:comprobante,
            proveedor_id:proveedor_id,
            producto_id:producto_id,
            preferencia_id:preferencia_id,
            clasificador_id:clasificador_id,
            categoria_id:categoria_id,
            subcategoria_id:subcategoria_id
        },
        success:function(respuesta){
            var registros = JSON.parse(respuesta);
            const myregistros = JSON.stringify(registros);
            $("#resproducto").val(myregistros);

            if (registros != null){
                var cantidades = Number(0);
                var total = Number(0);
                var total_otramoneda = Number(0);
                var total_otram = Number(0);
                var descuentos = Number(0);

                var n = registros.length;
                html = "";
                let compra_caja = "";

                for (var i = 0; i < n ; i++){
                    // Totales
                    total += Number(registros[i]["detallecomp_total"]);
                    cantidades += Number(registros[i]["detallecomp_cantidad"]);
                    descuentos += Number(registros[i]["detallecomp_descuento"]) * Number(registros[i]["detallecomp_cantidad"]);

                    html += "<tr>";
                    html += "<td align='center' style='width:5px;'>"+(i+1)+"</td>";

                    compra_caja = "";
                    
                    if(registros[i]["compra_caja"]==1){
                        compra_caja = "DINERO DE CAJA"; }
                    else{ 

                        if(registros[i]["compra_caja"]==2){
                            compra_caja = "ORDEN DE PAGO"; }
                        else{ compra_caja = ""; }
                    }
                    
                    html += "<td> "+(registros[i]["producto_nombre"] || "");
                    //alert(registros[i]["compra_caja"]);
                    if(registros[i]["compra_caja"]>0){
                        html += "<br><small><b>"+compra_caja+"</b></small>";
                    }
                    html += "</td>";
                    
                    
                    html += "<td> "+(registros[i]["detallecomp_codigo"] || "")+"</td>";

                    html += "<td align='center' style='width:110px;'>";
                    html += moment(registros[i]["compra_fecha"]).format('DD/MM/YYYY')+"-"+(registros[i]["compra_hora"] || "");
                    html += "</td>";

                    html += "<td align='center'>"+(registros[i]["compra_id"] || "")+"</td>";

                    html += "<td align='center'>"+(registros[i]["compra_numdoc"] || "")+"</td>";

                    html += "<td align='center' style='line-height:10px;'>";
                    html += (registros[i]["tipotrans_nombre"] || "");
                    html += "<br><small style='font-family: Arial Narrow;'>"+(registros[i]["forma_nombre"] || "")+"</small>";
                    html += "</td>";

                    html += "<td align='center'> "+(registros[i]["detallecomp_unidad"] || registros[i]["producto_unidad"] || "")+" </td>";

                    // cantidad
                    html += "<td align='center'> ";
                    let partes = registros[i]["detallecomp_cantidad"];
                    let partes1 = partes.toString();
                    let partes2 = partes1.split('.');
                    if (partes2[1] == 0) {
                        lacantidad = partes2[0];
                    }else{
                        lacantidad = numberFormat(Number(registros[i]["detallecomp_cantidad"]).toFixed(decimales))
                    }
                    html += lacantidad;
                    html += " </td>";

                    // costo unitario
                    html += "<td align='right'> "+numberFormat(Number(registros[i]["detallecomp_costo"]).toFixed(decimales))+" </td>";

                    // descuento total de la línea
                    html += "<td align='right'> "+numberFormat(Number(Number(registros[i]["detallecomp_descuento"])*Number(registros[i]["detallecomp_cantidad"])).toFixed(decimales))+" </td>";

                    // total linea
                    html += "<td align='right'><b>"+numberFormat(Number(registros[i]["detallecomp_total"]).toFixed(decimales))+"</b></td>";

                    // otra moneda
                    html += "<td class='text-right'> ";
                    var tc = Number(registros[i]["detallecomp_tc"] || registros[i]["detallecomp_tipocambio"] || 1);
                    if(tc == 0){ tc = 1; }
                    if(lamoneda_id == 1){
                        total_otram = Number(registros[i]["detallecomp_total"])/tc;
                        total_otramoneda += total_otram;
                    }else{
                        total_otram = Number(registros[i]["detallecomp_total"])*tc;
                        total_otramoneda += total_otram;
                    }
                    html += numberFormat(Number(total_otram).toFixed(decimales));
                    html += "</td>";

                    // proveedor
                    html += "<td align='center'>"+(registros[i]["proveedor_nombre"] || "")+"</td>";
                    html += "<td align='center'>"+registros[i]["proveedor_codigo"]+"</td>";

                    // usuario
                    html += "<td align='center'>"+(registros[i]["usuario_nombre"] || "")+"</td>";

                    // acciones (opcional)
                    html += "<td class='no-print'>";
                    html += "<a href='"+base_url+"compra/edit/"+registros[i]['compra_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Ver/Modificar Compra'><span class='fa fa-edit'></span></a>";
                    html += "<a href='"+base_url+"compra/notaingreso/"+registros[i]['compra_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir Compra'><span class='fa fa-print'></span></a>";
                    html += "</td>";

                    html += "</tr>";
                }

                // fila totales
                html += "<tr>";
                html += "<th></th><th></th><th></th><th></th><th></th><th></th>";
                html += "<th style='text-align:right'>TOTAL</th>";
                html += "<th>"+numberFormat(Number(cantidades).toFixed(decimales))+"</th>";
                html += "<th></th>";
                html += "<th style='text-align:right'>"+numberFormat(Number(descuentos).toFixed(decimales))+"</th>";
                html += "<th style='text-align:right'>"+numberFormat(Number(total).toFixed(decimales))+"</th>";
                html += "<th style='text-align:right'>"+numberFormat(Number(total_otramoneda).toFixed(decimales))+"</th>";
                html += "<th></th><th></th><th></th>";
                html += "<th class='no-print'></th>";
                html += "</tr>";

                desde1 = "Desde: <b>"+moment(fecha_desde).format('DD/MM/YYYY')+"</b>";
                hasta1 = "Hasta: <b>"+moment(fecha_hasta).format('DD/MM/YYYY')+"</b>";
                $("#resultado_reporte").html(html);
                $("#desde").html(desde1);
                $("#hasta").html(hasta1);
                document.getElementById('loader').style.display = 'none';
                $('#modalbuscarproveedor').modal('hide');
                $('#modalbuscarproveedor').on('hidden.bs.modal', function () {
                    $('#tablareproveedor').html('');
                });
            }else{
                document.getElementById('loader').style.display = 'none';
            }
        },
        error:function(){
            document.getElementById('loader').style.display = 'none';
            $("#resultado_reporte").html("");
        }
    });
}

// ======= Proveedores =======
function buscarproveedor(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablareproveedor();
    }
}

function tablareproveedor(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'reportes/buscarproveedor';
    var parametro = document.getElementById('buscar_elproveedor').value;
    document.getElementById('loader_bcliente').style.display = 'block';

    $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success:function(respuesta){
            var registros = JSON.parse(respuesta);
            var n = registros.length;
            html = "";
            for (var i = 0; i < n; i++){
                html += "<tr onclick='repoproveedor("+JSON.stringify(registros[i])+")' style='cursor:pointer;'>";
                html += "<td>"+(i+1)+"</td>";
                html += "<td>"+(registros[i]["proveedor_codigo"] || "")+"</td>";
                html += "<td>"+(registros[i]["proveedor_nombre"] || "")+"</td>";
                html += "<td>"+(registros[i]["proveedor_nit"] || "")+"</td>";
                html += "</tr>";
            }
            $("#tablareproveedor").html(html);
            document.getElementById('loader_bcliente').style.display = 'none';
        },
        error:function(){
            document.getElementById('loader_bcliente').style.display = 'none';
            $("#tablareproveedor").html("");
        }
    });
}

function repoproveedor(registro){
    $("#proveedor_id").val(registro.proveedor_id);
    $("#proveedor_nombre").val(registro.proveedor_nombre);
    $('#modalbuscarproveedor').modal('hide');
}

function proveedortodos(){
    $("#proveedor_id").val(0);
    $("#proveedor_nombre").val("TODOS");
}

// ======= Productos (se reutiliza la búsqueda existente compra/buscarcompra) =======
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
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var n = registros.length;
                    html = "";
                    for (var i = 0; i < n ; i++){
                        html += "<tr onclick='repoproducto("+JSON.stringify(registros[i])+")' style='cursor:pointer;'>";
                        html += "<td align='center'>"+(i+1)+"</td>";
                        html += "<td>"+(registros[i]["producto_codigo"] || "")+"</td>";
                        html += "<td>"+(registros[i]["producto_nombre"] || "")+"</td>";
                        html += "</tr>";
                    }
                    $("#tablareproducto").html(html);
                    document.getElementById('loader_bproducto').style.display = 'none';
                }else{
                    document.getElementById('loader_bproducto').style.display = 'none';
                }
            },
            error:function(){
                document.getElementById('loader_bproducto').style.display = 'none';
                $("#tablareproducto").html("");
            }
    });
}
function repoproducto(registro){
    $("#producto_id").val(registro.producto_id);
    $("#producto_nombre").val(registro.producto_nombre);
    $('#modalbuscarproducto').modal('hide');
}
function productotodos(){
    $("#producto_id").val(0);
    $("#producto_nombre").val("TODOS");
}

// ======= Excel (CSV) =======
function generarexcel_reportecompra(){
    var resproducto = document.getElementById('resproducto').value;
    if(resproducto == ""){
        alert("Primero debe realizar una búsqueda");
        return;
    }

    var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    let decimales = JSON.parse(document.getElementById('decimales').value);

    var registros = JSON.parse(resproducto);
    var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
    var tam = registros.length;

    var cantidades = Number(0);
    var total = Number(0);
    var total_otramoneda = Number(0);
    var descuentos = Number(0);
    var otramoneda_nombre = "";

    var CSV = 'sep=,' + '\r\n\n';

    // Encabezado
    var row = "";
    row += 'Nro.,';
    row += 'PRODUCTO,';
    row += 'COMPRA,';
    row += 'CODIGO,';
    row += 'FECHA COMPRA,';
    row += 'HORA COMPRA,';
    row += 'NUM. COMPRA,';
    row += 'NUM. DOC.,';
    row += 'TIPO COMPRA,';
    row += 'FORMA PAGO,';
    row += 'UNIDAD,';
    row += 'CANT.,';
    row += 'COSTO UNIT.(' +nombre_moneda+ '),';
    row += 'DESCUENTO(' +nombre_moneda+ '),';
    row += 'TOTAL(' +nombre_moneda+ '),';
    row += 'TOTAL(';
    if(lamoneda_id == 1){
        otramoneda_nombre = lamoneda[1]['moneda_descripcion'];
    }else{
        otramoneda_nombre = lamoneda[0]['moneda_descripcion'];
    }
    row += otramoneda_nombre+ '),';
    row += 'PROVEEDOR,';
    row += 'CODIGO PROVEEDOR,';
    row += 'USUARIO,';
    row = row.slice(0, -1);
    CSV += row + '\r\n';

    // filas
    let compra_caja = "";
    for (var i = 0; i < tam; i++) {
        
        total += Number(registros[i]["detallecomp_total"]);
        cantidades += Number(registros[i]["detallecomp_cantidad"]);
        descuentos += Number(registros[i]["detallecomp_descuento"])*Number(registros[i]["detallecomp_cantidad"]);

        var row = "";
        row += (i+1)+',';
        row += '"' +(registros[i]["producto_nombre"] || "")+ '",';
        
        compra_caja = "";
        if(registros[i]["compra_caja"]==1){
            compra_caja = "DINERO DE CAJA"; }
        else{ 
            
            if(registros[i]["compra_caja"]==2){
                compra_caja = "ORDEN DE PAGO"; }
            else{ compra_caja = ""; }
        }
         
        row += '"' +compra_caja+ '",';
        row += '"' +(registros[i]["detallecomp_codigo"] || "")+ '",';
        row += '"' +moment(registros[i]["compra_fecha"]).format('DD/MM/YYYY')+ '",';
        row += '"' +(registros[i]["compra_hora"] || "")+ '",';
        row += '"' +(registros[i]["compra_id"] || "")+ '",';
        row += '"' +(registros[i]["compra_numdoc"] || "")+ '",';
        row += '"' +(registros[i]["tipotrans_nombre"] || "")+ '",';
        row += '"' +(registros[i]["forma_nombre"] || "")+ '",';
        row += '"' +(registros[i]["detallecomp_unidad"] || registros[i]["producto_unidad"] || "")+ '",';
        row += '"' +numberFormat(Number(registros[i]["detallecomp_cantidad"]).toFixed(decimales))+ '",';
        row += '"' +numberFormat(Number(registros[i]["detallecomp_costo"]).toFixed(decimales))+ '",';
        row += '"' +numberFormat(Number(Number(registros[i]["detallecomp_descuento"])*Number(registros[i]["detallecomp_cantidad"])).toFixed(decimales))+ '",';
        row += '"' +numberFormat(Number(registros[i]["detallecomp_total"]).toFixed(decimales))+ '",';

        var tc = Number(registros[i]["detallecomp_tc"] || registros[i]["detallecomp_tipocambio"] || 1);
        if(tc == 0){ tc = 1; }
        var total_otram = 0;
        if(lamoneda_id == 1){
            total_otram = Number(registros[i]["detallecomp_total"])/tc;
        }else{
            total_otram = Number(registros[i]["detallecomp_total"])*tc;
        }
        total_otramoneda += total_otram;
        row += '"' +numberFormat(Number(total_otram).toFixed(decimales))+ '",';

        row += '"' +(registros[i]["proveedor_nombre"] || "")+ '",';
        row += '"' +(registros[i]["proveedor_codigo"] || "")+ '",';
        row += '"' +(registros[i]["usuario_nombre"] || "")+ '",';

        CSV += row + '\r\n';
    }

    // totales
    CSV += '\r\n';
    var row = "";
    row += '"",';
    row += '"",';
    row += '"",';
    row += '"",';
    row += '"",';
    row += '"",';
    row += '"",';
    row += '"",';
    row += '"TOTAL",';
    row += '"'+numberFormat(Number(cantidades).toFixed(decimales))+'",';
    row += '"",';
    row += '"'+numberFormat(Number(descuentos).toFixed(decimales))+'",';
    row += '"'+numberFormat(Number(total).toFixed(decimales))+'",';
    row += '"'+numberFormat(Number(total_otramoneda).toFixed(decimales))+'",';
    row += '"",';
    row += '"",';
    row += '"",';
    CSV += row + '\r\n';

    var fileName = "Reporte_Compras_" + reportitle.replace(/ /g,"_");
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    var link = document.createElement("a");
    link.href = uri;
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function numberFormat(numero){
    // Formato estándar con separador de miles
    numero = (numero || 0).toString();
    numero = numero.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return numero;
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