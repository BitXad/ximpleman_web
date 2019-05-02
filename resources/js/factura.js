/**
 * Comment
 */


function formato_numerico(numer){
    var partdecimal = "";
    var numero = "";
    var num = numer.toString();
    var signonegativo = "";
    var resultado = "";
    
    /*quitamos el signo al numero, si es que lo tubiera*/
    if(num[0]=="-"){
        signonegativo="-";
        numero = num.substring(1, num.length);
    }else{
        numero = num;
    }
    /*guardamos la parte decimal*/
    if(num.indexOf(".")>=0){
        partdecimal = num.substring(num.indexOf("."), num.length);
        numero = numero.substring(0,num.indexOf(".")-1);
    }else{
        numero = num;
    }
    for (var j, i = numero.length - 1, j = 0; i >= 0; i--, j++){
        resultado = numero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;
    }
 
    resultado = signonegativo+resultado+partdecimal;
    return resultado;
}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function mostrar_facturas() {
    var base_url = document.getElementById('base_url').value;
    var opcion = document.getElementById('opcion').value;
    var controlador = base_url+'factura/mostrar_facturas';    
    var desde = document.getElementById('fecha_desde').value;
    var hasta = document.getElementById('fecha_hasta').value; 
   
    $.ajax({url:controlador,
            type:"POST",
            data:{desde:desde, hasta:hasta ,opcion:opcion},
            success:function(result){
                var factura = JSON.parse(result);
                var tam = factura.length;
                var totalfinal = 0;
                
                html = "";
                if (opcion==1){
                    
                    html += "<table class='table table-striped' id='mitabla' >";
                    html += "<th>ESPEC.</th>";
                    html += "<th>N°</th>";
                    html += "<th>FECHA DE LA FACTURA</th>";
                    html += "<th>N° DE LA FACTURA</th>";
                    html += "<th>N° DE AUTORIZACION</th>";
                    html += "<th>ESTADO	NIT/CI CLIENTE</th>";
                    html += "<th>NOMBRE O RAZON SOCIAL</th>";
                    html += "<th>IMPORTE TOTAL DE LA VENTA</th>";
                    html += "<th>IMPORTE ICE</th>";
                    html += "<th>/IEHD/TASAS	EXPORTACIONES Y OPERACIONES EXENTAS</th>";	
                    html += "<th>VENTAS GRAVADAS A TASA CERO</th>";	
                    html += "<th>SUBTOTAL</th>";	
                    html += "<th>DESCUENTOS</th>"; 
                    html += "<th>BONIFICACIONES Y REBAJAS OTORGADAS</th>";	
                    html += "<th>IMPORTE BASE PARA DEBITO FISCAL</th>";	
                    html += "<th>DEBITO FISCAL</th>";	
                    html += "<th>CODIGO DE CONTROL</th>";	
                    html += "<th>TRANSACCION</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                    
                    
                    
                    for(var i = 0; i < tam; i++ ){                        
                        html += "<tr>";
                        html += "   <td>0</td>";
                        html += "   <td>1</td>";
                        html += "   <td>"+formato_fecha(factura[i]["factura_fecha"])+"</td>";
                        html += "   <td>"+factura[i]["factura_numero"]+"</td>";
                        html += "   <td>"+factura[i]["factura_autorizacion"]+"</td>";
                        html += "   <td>"+factura[i]["factura_nit"]+"</td>";
                        html += "   <td>"+factura[i]["factura_razonsocial"]+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_subtotal"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_ice"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_exento"]).toFixed(2)+"</td>";
                        html += "   <td>0</td>";
                        html += "   <td>"+Number(factura[i]["factura_subtotal"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_descuento"]).toFixed(2)+"</td>";
                        html += "   <td>0</td>";
                        html += "   <td>"+Number(factura[i]["factura_total"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_total"]*0.13).toFixed(2)+"</td>";
                        html += "   <td>"+factura[i]["factura_codigocontrol"]+"</td>";
                        html += "   <td>"+factura[i]["venta_id"]+"</td>";
                        html += "</tr>";
                        
                        totalfinal += Number(factura[i]["factura_total"]);
                        
                        
                    }
                        var debitofiscal =  totalfinal * 0.13;
                        
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th>"+formato_numerico(Number(totalfinal).toFixed(2))+"</th> ";
                        html += "<th>"+formato_numerico(Number(debitofiscal).toFixed(2))+"</th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                   html += "<tbody>";
                    html += "</table>";
                    $("#tabla_factura").html(html);
                }
            },
            error:function(result){alert("Ocurrio un error en la consulta. Revise los parametros por favor...!")},
                   
        
            
            })

    
}

function mostrar_facturas2() {
    var base_url = document.getElementById('base_url').value;
    var opcion = document.getElementById('opcion').value;
    var controlador = base_url+'factura/mostrar_facturas';    
    var desde = document.getElementById('fecha_desde').value;
    var hasta = document.getElementById('fecha_hasta').value; 
   
    $.ajax({url:controlador,
            type:"POST",
            data:{desde:desde, hasta:hasta, opcion:opcion},
            success:function(result){
                var factura = JSON.parse(result);
                var tam = factura.length;
                var totalfinal = 0;
                
                html = "";
                if (opcion==2){
                    
                    html += "<table class='table table-striped' id='mitabla' >";
                    html += "<th>ESPEC.</th>";
                    html += "<th>N°</th>";
                    html += "<th>FECHA DE LA FACTURA</th>";
                    html += "<th>N° DE LA FACTURA</th>";
                    html += "<th>N° DE AUTORIZACION</th>";
                    html += "<th>ESTADO NIT/CI CLIENTE</th>";
                    html += "<th>NOMBRE O RAZON SOCIAL</th>";
                    html += "<th>IMPORTE TOTAL DE LA VENTA</th>";
                    html += "<th>IMPORTE ICE</th>";
                    html += "<th>/IEHD/TASAS    EXPORTACIONES Y OPERACIONES EXENTAS</th>";  
                    html += "<th>VENTAS GRAVADAS A TASA CERO</th>"; 
                    html += "<th>SUBTOTAL</th>";    
                    html += "<th>DESCUENTOS</th>"; 
                    html += "<th>BONIFICACIONES Y REBAJAS OTORGADAS</th>";  
                    html += "<th>IMPORTE BASE PARA DEBITO FISCAL</th>"; 
                    html += "<th>DEBITO FISCAL</th>";   
                    html += "<th>CODIGO DE CONTROL</th>";   
                    html += "<th>TRANSACCION</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                    
                    
                    
                    for(var i = 0; i < tam; i++ ){                        
                        html += "<tr>";
                        html += "   <td>0</td>";
                        html += "   <td>"+Number(i+1)+"</td>";
                        html += "   <td>"+formato_fecha(factura[i]["factura_fecha"])+"</td>";
                        html += "   <td>"+factura[i]["factura_numero"]+"</td>";
                        html += "   <td>"+factura[i]["factura_autorizacion"]+"</td>";
                        html += "   <td>"+factura[i]["factura_nit"]+"</td>";
                        html += "   <td>"+factura[i]["factura_razonsocial"]+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_subtotal"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_ice"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_exento"]).toFixed(2)+"</td>";
                        html += "   <td>0</td>";
                        html += "   <td>"+Number(factura[i]["factura_subtotal"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_descuento"]).toFixed(2)+"</td>";
                        html += "   <td>0</td>";
                        html += "   <td>"+Number(factura[i]["factura_total"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_total"]*0.13).toFixed(2)+"</td>";
                        html += "   <td>"+factura[i]["factura_codigocontrol"]+"</td>";
                        html += "   <td>"+factura[i]["compra_id"]+"</td>";
                        html += "</tr>";
                        
                        totalfinal += Number(factura[i]["factura_total"]);
                        
                        
                    }
                        var debitofiscal =  totalfinal * 0.13;
                        
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th>"+formato_numerico(Number(totalfinal).toFixed(2))+"</th> ";
                        html += "<th>"+formato_numerico(Number(debitofiscal).toFixed(2))+"</th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                   html += "<tbody>";
                    html += "</table>";
                    $("#tabla_factura").html(html);
                }
            },
            error:function(result){alert("Ocurrio un error en la consulta. Revise los parametros por favor...!")},
                   
        
            
            })

    
}