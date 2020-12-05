function ventacliente(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){               
        tablarecliente();
    }
}

function tablarecliente()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/buscarcliente';
    var parametro = document.getElementById('cliente_id').value;
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
                    html += "<th>ID</th>";
                    html += "<th>Cliente</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablarecliente'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<div clas='row'>";
                        html += "<b>"+registros[i]["cliente_id"]+"</b>";
                        html += "<input id='cliente_id'  name='cliente_id' type='hidden' class='form-control' value='"+registros[i]["cliente_id"]+"'>";
                        html += "</td>";
                        html += "</div>";   
                        html += "<div class='col-md-12'>";
                        html += "<td>";
                        html += "<b>"+registros[i]["cliente_nombre"]+"</b>";
                        html += "<td>";
                        html += "<button type='button' onclick='repocliente("+registros[i]["cliente_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-search'></i></button>";
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                   html += "</tbody>"
                   $("#tablarecliente").html(html);
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablarecliente").html(html);
        }
    });  
}

function repocliente(cliente){
    $("#cliente").val(cliente);
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/nomcliente/"+cliente;
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(report){
            var registros =  JSON.parse(report);
            html = "";
            html += "<font size='2'>Cliente: <b>"+registros["cliente_nombre"]+"</b></font>";
            $("#labusqueda").html(html);
            /*$("#producto").val('');
            $("#proveedor").val('');*/
            document.getElementById('tablas').style.display = 'none';
            reporte1();
        }
    });
}

function reporte1()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/busca_simple";
    var desde    = document.getElementById('fecha_desde').value;
    var hasta    = document.getElementById('fecha_hasta').value;
    var cliente  = document.getElementById('cliente').value;
    var tipo     = document.getElementById('tipo_transaccion').value;
    if (tipo==0) {
      eltipo = "";
    }else{
      eltipo = " and vs.tipotrans_id = "+tipo+" ";
      $("#tipotrans").html("<br><font size='2'>Tipo Trans.: <b>"+$('#tipo_transaccion option:selected').text()+"</b></font><br>");
    }
    if (cliente=="") {
        elcliente = "";
    } else {
        elcliente = "and vs.cliente_id="+cliente+" "; 
    }
	var filtro = " date(vs.venta_fecha) >= '"+desde+"'  and  date(vs.venta_fecha) <='"+hasta+"' "+eltipo+" "+elcliente+" ";

    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro},
            success:function(report){
                $("#enco").val("- 0 -");
                var registros =  JSON.parse(report);
                if (registros != null){    
                    var totales = Number(0);
                    var n = registros.length; //tamaño del arreglo de la consulta   
                    html = "";
                    for (var i = 0; i < n ; i++){
                        totales += Number(registros[i]["venta_total"]);
                        html += "<tr>";
                        html += "<td align='center'> "+(i+1)+" </td>";     
                        html += "<td> "+registros[i]["cliente_nombre"]+" </td>";     
                        html += "<td align='center'> "+registros[i]["venta_id"]+" </td>";     
                        html += "<td align='right'> "+Number(registros[i]["venta_total"]).toFixed(2)+" </td>";     
                        html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";     
                        html += "<td align='center'> "+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+" </td>";
                        html += "<td class='no-print'><a href='"+base_url+"venta/modificar_venta/"+registros[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modifica el detalle/cliente de la venta'><span class='fa fa-edit'></span></a> <a href='"+base_url+"factura/imprimir_recibo/"+registros[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-print'></span></a> </td>";
                        html += "</tr>";
                    }
                    html += "<tr>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "<th style='text-align:right'>"+numberFormat(Number(totales).toFixed(2))+"</th>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "<th></th>";
                    html += "</tr>";
                    desde1 = "Desde: <b>"+moment(desde).format('DD/MM/YYYY')+"</b>";
                    hasta1 = "Hasta: <b>"+moment(hasta).format('DD/MM/YYYY')+"</b>";
                   
                    $("#desde").html(desde1);
                    $("#hasta").html(hasta1);
                    $("#simple").html(html);
                    document.getElementById('loader').style.display = 'none';
                    $('#modalbuscarcliente').modal('hide');
                    $('#modalbuscarcliente').on('hidden.bs.modal', function () {
                        $('#tablarecliente').html('');
                    });
            }
        },
        error:function(result){
           //alert("Algo salio mal...!!!");
           html = "";
           $("#simple").html(html);
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