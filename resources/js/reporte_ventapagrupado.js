$(document).on("ready",inicio);
function inicio(){
    //tabla_reportesproducto();
}

function tabla_reportesproducto(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/buscarprodagrupados";
    var desde    = document.getElementById('fecha_desde').value;
    var hasta    = document.getElementById('fecha_hasta').value;
    //var cliente  = document.getElementById('cliente').value;
    var tipo     = document.getElementById('tipo_transaccion').value;
    //var producto = document.getElementById('producto').value;
    //var proveedor   = document.getElementById('proveedor').value;
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
    }
    if (producto=="") {
            elproducto = "";
    } else {
            elproducto = "and producto_id="+producto+" "; 
    }*/
    if (tipo==0) {
      eltipo = "";
    }else{
      eltipo = " and vs.tipotrans_id = "+tipo+" ";
    }
	//var filtro = " date(venta_fecha) >= '"+desde+"'  and  date(venta_fecha) <='"+hasta+"' "+eltipo+" "+elcliente+" "+elproducto+" "+elprove+" ";
	var filtro = " date(venta_fecha) >= '"+desde+"'  and  date(venta_fecha) <='"+hasta+"' "+eltipo+" ";

  //simplemente(filtro);
     
    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro},
            success:function(report){
                $("#enco").val("- 0 -");
                var registros =  JSON.parse(report);
                if (registros != null){
                    var cantidades = Number(0);
                    var total = Number(0);
                    //var cuotas = Number(0);
                    var costos = Number(0);
                    var utilidades = Number(0);
                    var descuentos = Number(0);
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                    html = "";
                    for (var i = 0; i < n ; i++){
                        total += Number(registros[i]["total_venta"]);
                        cantidades += Number(registros[i]["total_cantidad"]);
                        //cuotas += Number(registros[i]["credito_cuotainicial"]);
                        descuentos += Number(registros[i]["total_descuento"]);
                        costos += Number(registros[i]["total_costounit"]);
                        //var utilidad = Number((registros[i]["detalleven_precio"]-registros[i]["detalleven_costo"])*registros[i]["detalleven_cantidad"]);
                        utilidades += Number(registros[i]["total_utilidad"]);
                        html += "<tr>";
                        html += "<td align='center' style='width:5px;'>"+(i+1)+"</td>";
                        html += "<td> "+registros[i]["producto_nombre"]+" </td>";                                            
                        /*html += "<td align='center' style='width:110px;'> "+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"-"+registros[i]["venta_hora"]+" </td>";
                        html += "<td align='center'> "+registros[i]["venta_id"]+" </td>";  
                        html += "<td align='center'> "+Number(registros[i]["factura_id"])+" </td>";  // NUMERO FACTURA*/
                        html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";  
                        //html += "<td align='right'>"+Number(registros[i]["credito_cuotainicial"]).toFixed(2)+"</td>" ;// CUOTA INICIAL
                        html += "<td align='center'> "+registros[i]["producto_unidad"]+" </td>";                                          
                        html += "<td align='center'> "+registros[i]["total_cantidad"]+" </td>"; 
                        html += "<td align='right'> "+Number(registros[i]["total_punitario"]).toFixed(2)+" </td>"; 
                        html += "<td align='right'> "+Number(registros[i]["total_descuento"]).toFixed(2)+" </td>";
                        html += "<td align='right'><b>"+Number(registros[i]["total_venta"]).toFixed(2)+"</b></td>";
                        html += "<td align='right'> "+Number(registros[i]["total_costounit"]).toFixed(2)+" </td>";
                        html += "<td align='right'> "+Number(registros[i]["total_utilidad"]).toFixed(2)+" </td>";
                        /*
                        html += "<td  align='center'>"+registros[i]["cliente_nombre"]+"</td>"; 
                        html += "<td  align='center'>"+registros[i]["usuario_nombre"]+"</td>"; 
                        html += "<td class='no-print'><a href='"+base_url+"venta/modificar_venta/"+registros[i]['venta_id']+"' class='btn btn-facebook btn-xs no-print' target='_blank' title='Modifica el detalle/cliente de la venta'><span class='fa fa-edit'></span></a> <a href='"+base_url+"factura/imprimir_recibo/"+registros[i]['venta_id']+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de venta'><span class='fa fa-print'></span></a> </td>";
                       */
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        /*html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<th style='text-align:right'>"+Number(cuotas).toFixed(2)+"</th>";*/
                        html += "<td></td>";
                        html += "<th>"+Number(cantidades).toFixed(2)+"</td>";
                        html += "<td></td>";
                        html += "<th style='text-align:right'>"+Number(descuentos).toFixed(2)+"</th>";
                        html += "<th style='text-align:right'>"+Number(total).toFixed(2)+"</th>";
                        html += "<th style='text-align:right'>"+Number(costos).toFixed(2)+"</th>";
                        html += "<th style='text-align:right'>"+Number(utilidades).toFixed(2)+"</th>";
                        /*html += "<td></td>";
                        html += "<td></td>";*/
                        html += "</tr>";
                   desde1 = "<b>Desde: "+moment(desde).format('DD/MM/YYYY')+"</b>";
                   hasta1 = "<b>Hasta: "+moment(hasta).format('DD/MM/YYYY')+"</b>";
                   $("#reportefechadeventa").html(html);
                   $("#desde").html(desde1);
                   $("#hasta").html(hasta1);
                   document.getElementById('loader').style.display = 'none';
            }
                
        },
        error:function(result){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#reportefechadeventa").html(html);
        }
        
    });   

}
