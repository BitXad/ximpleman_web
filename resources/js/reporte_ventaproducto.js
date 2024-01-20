function ventaproducto(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
        tablareproducto();    
    }
}

function tablareproducto()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'compra/buscarcompra';
    var parametro = document.getElementById('vender').value
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
                        html += "<input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "<div class='col-md-12'>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<button type='button' onclick='repoproducto("+registros[i]["producto_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-search'></i></button>";
                        //html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                        html += "</tbody>"
                   $("#tablareproducto").html(html);
                    //document.getElementById('tablas').style.display = 'block';
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
    });
}

function repoproducto(producto){
    $("#producto").val(producto);
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/nomproducto/"+producto;
    $.ajax({url: controlador,
            type:"POST",
            data:{},
           success:function(report){  
            var registros =  JSON.parse(report);
            html = "";
            html += "<font size='2'>Producto: <b>"+registros["producto_nombre"]+"</b></font>";  
            $("#labusqueda").html(html);
            /*$("#cliente").val('');
            $("#proveedor").val('');*/
            document.getElementById('tablas').style.display = 'none';
            reportesproducto();
	}
    });
}

function reportesproducto(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/buscarrepo";
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var lamoneda_id   = document.getElementById('lamoneda_id').value;
    var desde    = document.getElementById('fecha_desde').value;
    var hasta    = document.getElementById('fecha_hasta').value;
    var producto  = document.getElementById('producto').value;
    var tipo     = document.getElementById('tipo_transaccion').value;
    var usuario_id = document.getElementById('usuario_id').value;
    var esventa_preventa = document.getElementById('esventa_preventa').value;
    document.getElementById('loader').style.display = 'block';
    /*if (proveedor=="") {
      elprove = "";
    } else {
      elprove = "and producto_marca like '%"+proveedor+"%' "; 
    }
    if (cliente=="") {
            elcliente = "";
    } else {
            elcliente = "and vs.cliente_id="+cliente+" "; 
    }*/
    if (producto=="") {
            elproducto = "";
    } else {
            elproducto = "and producto_id="+producto+" "; 
    }
    if (tipo==0) {
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
    }
	var filtro = " date(venta_fecha) >= '"+desde+"'  and  date(venta_fecha) <='"+hasta+"' "+eltipo+" "+elproducto+" "+elusuario+" ";

  //simplemente(filtro);
     
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(report){                      
                $("#enco").val("- 0 -");
                var registros =  JSON.parse(report);
                
                const myString = JSON.stringify(registros);
                $("#resproducto").val(myString);
                
                if (registros != null){    
                    var cantidades = Number(0);
                    var total = Number(0);
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
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
                         descuentos += Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"]);
                         costos += Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"]);
                         var utilidad = Number(Number(registros[i]["detalleven_total"])-(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])));
                         utilidades += Number(utilidad);
                        
                        html += "<tr>";
                      
                        html += "<td align='center' style='width:5px;'>"+(i+1)+"</td>";
                        html += "<td> "+registros[i]["producto_nombre"]+" </td>";                                            
                        html += "<td align='center' style='width:110px;'> "+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["venta_hora"]+" </td>";
                        html += "<td align='center'> "+registros[i]["venta_id"]+" </td>";  
                        html += "<td align='center'> "+Number(registros[i]["factura_id"])+" </td>";  // NUMERO FACTURA
                        html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";  
                        html += "<td align='right'>"+numberFormat(Number(registros[i]["credito_cuotainicial"]).toFixed(2))+"</td>" ;// CUOTA INICIAL
                        html += "<td align='center'> "+registros[i]["producto_unidad"]+" </td>";                                          
                        html += "<td align='center'> "+registros[i]["detalleven_cantidad"]+" </td>"; 
                        html += "<td align='right'> "+numberFormat(Number(registros[i]["detalleven_precio"]).toFixed(2))+" </td>"; 
                        html += "<td align='right'> "+numberFormat(Number(Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"])).toFixed(2))+" </td>";
                        html += "<td align='right'><b>"+numberFormat(Number(registros[i]["detalleven_total"]).toFixed(2))+"</b></td>";
                        html += "<td class='text-right'> ";
                        if(lamoneda_id == 1){
                            total_otram = Number(registros[i]["detalleven_total"])/Number(registros[i]["detalleven_tc"])
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = Number(registros[i]["detalleven_total"])*Number(registros[i]["detalleven_tc"])
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(2));
                        html += "</td>";
                        if(tipousuario_id == 1){
                            html += "<td align='right'> "+numberFormat(Number(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])).toFixed(2))+" </td>";
                            html += "<td align='right'> "+numberFormat(Number(utilidad).toFixed(2))+" </td>"; 
                        }
                        
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
                        html += "<th style='text-align:right'>"+numberFormat(Number(total_otramoneda).toFixed(2))+"</th>";
                        if(tipousuario_id == 1){
                            html += "<th style='text-align:right'>"+numberFormat(Number(costos).toFixed(2))+"</th>";
                            html += "<th style='text-align:right'>"+numberFormat(Number(utilidades).toFixed(2))+"</th>";
                        }
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   desde1 = "Desde: <b>"+moment(desde).format('DD/MM/YYYY')+"</b>";
                   hasta1 = "Hasta: <b>"+moment(hasta).format('DD/MM/YYYY')+"</b>";
                   $("#reportefechadeventa").html(html);
                   $("#desde").html(desde1);
                   $("#hasta").html(hasta1);
                   document.getElementById('loader').style.display = 'none';
                   $('#modalbuscarproducto').modal('hide');
                    $('#modalbuscarproducto').on('hidden.bs.modal', function () {
                    $('#tablareproducto').html('');
                    });
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

function generarexcel_vproducto(){
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var respuesta = document.getElementById('resproducto').value;
    if(respuesta == "" || respuesta == null){
        alert("Primero debe realizar una búsqueda");
    }else{
        var registros =  JSON.parse(respuesta);
        var showLabel = true;
        var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
        var tam = registros.length;
        var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
        var nombre_moneda = document.getElementById('nombre_moneda').value;
        var lamoneda_id = document.getElementById('lamoneda_id').value;
        var otramoneda_nombre = "";
        var total_otram = Number(0);
        html = "";
                //if (opcion==1){
                  /* **************INICIO Generar Excel JavaScript************** */
                    var CSV = 'sep=,' + '\r\n\n';
                    //This condition will generate the Label/Header
                    if (showLabel) {
                        var row = "";

                        //This loop will extract the label from 1st index of on array
                        

                            //Now convert each value to string and comma-seprated
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
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        var utilidad = Number(Number(registros[i]["detalleven_total"])-(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])));
                        //utilidades += Number(utilidad);
                            row += (i+1)+',';
                            row += '"' +registros[i]["producto_nombre"]+ '",';
                            row += '"' +moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["venta_hora"]+ '",';
                            row += '"' +registros[i]["venta_id"]+ '",';
                            row += '"' +Number(registros[i]["factura_id"])+ '",';
                            row += '"' +registros[i]["tipotrans_nombre"]+ '",';
                            row += '"' +numberFormat(Number(registros[i]["credito_cuotainicial"]).toFixed(2))+ '",';
                            row += '"' +registros[i]["producto_unidad"]+ '",';
                            row += '"' +registros[i]["detalleven_cantidad"]+ '",';
                            row += '"' +numberFormat(Number(registros[i]["detalleven_precio"]).toFixed(2))+ '",';
                            row += '"' +numberFormat(Number(Number(registros[i]["detalleven_descuento"])*Number(registros[i]["detalleven_cantidad"])).toFixed(2))+ '",';
                            row += '"' +numberFormat(Number(registros[i]["detalleven_total"]).toFixed(2))+ '",';
                            if(lamoneda_id == 1){
                                total_otram = Number(registros[i]["detalleven_total"])/Number(registros[i]["detalleven_tc"])
                                //total_otramoneda += total_otram;
                            }else{
                                total_otram = Number(registros[i]["detalleven_total"])*Number(registros[i]["detalleven_tc"])
                                //total_otramoneda += total_otram;
                            }
                            row += '"' +numberFormat(Number(total_otram).toFixed(2))+ '",';
                            if(tipousuario_id == 1){
                                row += '"' +numberFormat(Number(Number(registros[i]["detalleven_costo"])*Number(registros[i]["detalleven_cantidad"])).toFixed(2))+ '",';
                                row += '"' +numberFormat(Number(utilidad).toFixed(2))+ '",';
                            }
                            row += '"' +registros[i]["cliente_nombre"]+ '",';
                            row += '"' +registros[i]["usuario_nombre"]+ '",';
                            
                        row.slice(0, row.length - 1);

                        //add a line break after each row
                        CSV += row + '\r\n';
                    }
                    
                    if (CSV == '') {
                        alert("Invalid data");
                        return;
                    }
                    
                    //Generate a file name
                    var fileName = "Ventacategoria_";
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
                   
                   
                   
                   
                   //document.getElementById('loader').style.display = 'none';
            //}
         //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        //}  
        }
}