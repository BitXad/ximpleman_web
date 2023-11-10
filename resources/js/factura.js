
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
    var rolusuario_asignado = document.getElementById('rolusuario_asignado').value;
    var opcion = document.getElementById('opcion').value;
    var controlador = base_url+'factura/mostrar_facturas';    
    var desde = document.getElementById('fecha_desde').value;
    var hasta = document.getElementById('fecha_hasta').value; 
    var formato = document.getElementById('select_formato').value; 
    var tipo = document.getElementById('select_tipo').value; 
    
    //alert("formato: "+formato+" * Tipo: "+tipo);
    
    var parametro_tiposisistema = document.getElementById("parametro_tiposistema").value;
    
    if (formato==1){
    
            $.ajax({url:controlador,
                    type:"POST",
                    data:{desde:desde, hasta:hasta ,opcion:opcion, tipo:tipo},
                    success:function(result){
                        var factura = JSON.parse(result);
                        var tam = factura.length;

                        var mensaje = "";

                        html = "";
                        if (opcion==1){

                            html += "<table class='table table-striped' id='mitabla' nowrap >";
                            html += "<tr>";
                            html += "<th class='no-print'>OPERACIONES</th>";
                            html += "<th>Nº</th>";
                            html += "<th>ESPEC.</th>";
                            html += "<th>FECHA DE LA FACTURA</th>";
                            html += "<th>N° DE FACT.</th>";
                            html += "<th>CODIGO DE AUTORIZACION</th>";
                            html += "<th>NIT/CI CLIENTE</th>";
                            html += "<th>COMPLEMENTO</th>";
                            html += "<th>NOMBRE O RAZON SOCIAL</th>";
                            html += "<th>IMPORTE TOTAL DE LA VENTA</th>";
                            html += "<th>IMPORTE ICE</th>";
                            html += "<th>IMPORTE IEHD</th>";	
                            html += "<th>IMPORTE IPJ</th>";	
                            html += "<th>TASAS</th>";
                            html += "<th>OTROS NO SUJETOS AL IVA</th>";
                            html += "<th>IMPORT. Y OP. EXENTAS</th>";
                            html += "<th>VENTAS GRAVADAS A TASA CERO</th>";	
                            html += "<th>SUBTOTAL</th>";	
                            html += "<th>DESC. BONIF. Y REBAJAS SUJETAS AL IVA</th>"; 
                            html += "<th>IMPORTE GIFT CARD</th>";
                            html += "<th>IMPORTE BASE PARA DEBITO FISCAL</th>";	
                            html += "<th>DEBITO FISCAL</th>";	
                            html += "<th>ESTADO</th>";	
                            html += "<th>CODIGO DE CONTROL</th>";	
                            html += "<th>TIPO DE VENTA</th>";
                            html += "<th>TRANS</th>";
                            html += "</tr>";
                            html += "<tbody class='buscar'>";

                              var totalfinal = Number(0);

                            for(var i = 0; i < tam; i++ ){


                                if (factura[i]['estado_id']==3)
                                    color = "style = 'background-color:gray'";
                                else
                                    color = "";

                                html += "<tr  "+color+">";
                                html += "   <td class='no-print'><a href='"+base_url+"factura/imprimir_factura_id/"+factura[i]["factura_id"]+"/1' class='btn btn-warning btn-xs' ' target='_BLANK' title='Imprimir factura original'><i class='fa fa-list'></i> </a>";
                                html += "   <a href='"+base_url+"factura/imprimir_factura_id/"+factura[i]["factura_id"]+"/2' class='btn btn-default btn-xs' ' target='_BLANK' title='Imprimir factura copia'><i class='fa fa-list'></i> </a>";

                                if(rolusuario_asignado == 1){

                                    if (factura["estado_id"]!=3){//si la factura NO esta anulada

                                        if(factura[i]["estado_id"]==1){

                                            if (parametro_tiposisistema == 1){
                                                html += "<button class='btn btn-danger btn-xs' onclick='anular_factura("+factura[i]["factura_id"]+","+factura[i]["venta_id"]+","+factura[i]["factura_numero"]+","+'"'+factura[i]["factura_razonsocial"]+'"'+","+factura[i]["factura_total"]+","+'"'+factura[i]["factura_fecha"]+'"'+")'><i class='fa fa-trash'></i> </button>";
                                            }
                                            else{
                                                if (factura[i]["factura_codigodescripcion"]=="VALIDADA"){
                                                    html += "<button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modalanular' onclick='cargar_modal_anular("+factura[i]["factura_id"]+","+factura[i]["venta_id"]+","+factura[i]["factura_numero"]+","+'"'+factura[i]["factura_razonsocial"]+'"'+","+factura[i]["factura_total"]+","+'"'+factura[i]["factura_fecha"]+'"'+")'>";
                                                html += "<fa class='fa fa-trash'> </fa> </button>";
                                                }else{
                                                    html += "<a class='btn btn-soundcloud btn-xs' data-toggle='modal' data-target='#modalanular_noenviada' onclick='cargar_modal_anular_malemitida("+factura[i]["factura_id"]+","+factura[i]["venta_id"]+","+factura[i]["factura_numero"]+","+'"'+factura[i]["factura_razonsocial"]+'"'+","+factura[i]["factura_total"]+","+'"'+factura[i]["factura_fecha"]+'"'+")'>";
                                                    html += "<fa class='fa fa-trash'> </fa> </a>";
                                                }
                                            }
                                        }

                                    }
                                    if(factura[i]["estado_id"]==3){
                                        if (parametro_tiposisistema != 1){
                                            html += "<a class='btn btn-soundcloud btn-xs' data-toggle='modal' data-target='#modalanular_forzado' onclick='cargar_modal_anularforzado("+factura[i]["factura_id"]+","+factura[i]["venta_id"]+","+factura[i]["factura_numero"]+","+'"'+factura[i]["factura_razonsocial"]+'"'+","+(factura[i]["factura_efectivo"]-factura[i]["factura_cambio"])+","+'"'+factura[i]["factura_fecha"]+'"'+")' title='Forzar Anulación'>";
                                            html += "<fa class='fa fa-minus-circle'> </fa> </a>";
                                        }
                                    }


                                            totalfinal += Number(factura[i]["factura_subtotal"]);                
                                }
                                html += "</td>";
                                html += "   <td>"+i+"</td>";
                                html += "   <td>2</td>";
                                html += "   <td>"+formato_fecha(factura[i]["factura_fecha"])+"</td>";
                                html += "   <td><center>"+factura[i]["factura_numero"];


                                html += "<br>";

                                if (factura[i]["factura_codigodescripcion"]=="VALIDADA"){
                                    
                                    html += "<span class='btn btn-info btn-xs' style='padding:0; border:0;'><small>"+factura[i]["factura_codigodescripcion"]+"</small></span>";                        
                                
                                }else{
                                    
                                    html += "<span class='btn btn-danger btn-xs' style='padding:0; border:0;' title='"+factura[i]["factura_mensajeslist"]+"'><small>FALLA</small></span>";
                                
                                }

                                html += "</center></td>";


                                if(factura[i]["factura_cuf"]!=null){
                                    
                                    html += "   <td>"+factura[i]["factura_cuf"]+"</td>";
                                }else{
                                    
                                    html += "   <td>"+factura[i]["factura_autorizacion"]+"</td>";
                                }
                                
                                
                                let enviada = factura[i]['factura_enviada'] == 1 ? "Enviada":"No enviada";
                                html += "   <td>"+factura[i]["factura_nit"]+"</td>";
                                html += "   <td>"+factura[i]["factura_complementoci"]+"</td>";
                                html += "   <td>"+factura[i]["factura_razonsocial"]+"</td>";
                                html += "   <td>"+Number(factura[i]["factura_subtotal"]).toFixed(2)+"</td>";
                                html += "   <td>"+Number(factura[i]["factura_ice"]).toFixed(2)+"</td>";
                                html += "   <td>"+Number(factura[i]["factura_exento"]).toFixed(2)+"</td>";
                                html += "   <td>0</td>";
                                html += "   <td>0</td>";
                                html += "   <td>0</td>";
                                html += "   <td>0</td>";
                                html += "   <td>0</td>";
                                html += "   <td>"+Number(factura[i]["factura_subtotal"]).toFixed(2)+"</td>";
                                html += "   <td>"+Number(factura[i]["factura_descuento"]).toFixed(2)+"</td>";
                                html += "   <td>"+Number(factura[i]["factura_giftcard"]).toFixed(2)+"</td>";
                                html += "   <td>"+Number(factura[i]["factura_total"]).toFixed(2)+"</td>";
                                html += "   <td>"+Number(factura[i]["factura_total"]*0.13).toFixed(2)+"</td>";
                                                     
                                if(factura[i]["estado_id"]==1){
                                        html += "   <td>V</td>";
                                }
                                else{
                                        html += "   <td>A</td>";
                                }


                                html += "   <td>"+factura[i]["factura_codigocontrol"]+"</td>";
                                html += "   <td>";
                                    if (factura[i]["factura_giftcard"]>0) html += "1";
                                    else html += "0";
                                        
                                html += "   </td>";
                                
                                html += "   <td>"+factura[i]["venta_id"]+"</td>";
        //                        html += "   <td><a href='"+base_url+"factura/imprimir_factura/"+factura[i]["venta_id"]+"' class='btn btn-warning btn-xs' ' target='_BLANK'><i class='fa fa-list'></i> </a>";
                                            html += "</tr>";
                            }    
                                var debitofiscal =  totalfinal * 0.13;

                                html += "<tr";
                                html += "<th class='no-print'> </th> ";
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
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th>"+Number(totalfinal).toFixed(2)+"</th> ";
                                html += "<th>"+Number(debitofiscal).toFixed(2)+"</th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "</tr> ";
                           html += "</tbody>";
                            html += "</table>";
                            
//                            html = "<table><tr><td>aqui va las facturas en formato RCV</td></tr></table>";
                            
                            $("#tabla_factura").html(html);
                        }
                    },
                    error:function(result){alert("Ocurrio un error en la consulta. Revise los parametros por favor...!")},



                    });
    
    }//fin if(formato == 1)
    else{
        
    
            $.ajax({url:controlador,
                    type:"POST",
                    data:{desde:desde, hasta:hasta ,opcion:opcion, tipo:tipo},
                    success:function(result){
                        var factura = JSON.parse(result);
                        var tam = factura.length;

                        var mensaje = "";

                        html = "";
                        if (opcion==1){

                            html += "<table class='table table-striped' id='mitabla' nowrap >";
                            html += "<tr>";
                            html += "<th>/IEHD/TASAS	EXPORTACIONES Y OPERACIONES EXENTAS</th>";	
                            html += "<th>#</th>";
                            html += "<th>ESPEC.</th>";
                            html += "<th>N°</th>";
                            html += "<th>FECHA DE LA FACTURA</th>";
                            html += "<th>N° DE FACT.</th>";
                            html += "<th>N° DE AUTORIZACION</th>";
                            html += "<th>ESTADO</th>";
                            html += "<th>NIT/CI CLIENTE</th>";
                            html += "<th>NOMBRE O RAZON SOCIAL</th>";
                            html += "<th>IMPORTE TOTAL DE LA VENTA</th>";
                            html += "<th>IMPORTE ICE</th>";
                            html += "<th>VENTAS GRAVADAS A TASA CERO</th>";	
                            html += "<th>SUBTOTAL</th>";	
                            html += "<th>DESC.</th>"; 
                            html += "<th>BONIF. Y REBAJAS OTORGADAS</th>";	
                            html += "<th>IMPORTE BASE PARA DEBITO FISCAL</th>";	
                            html += "<th>DEBITO FISCAL</th>";	
                            html += "<th>CODIGO DE CONTROL</th>";	
                            html += "<th>TRANS</th>";
                            html += "<th class='no-print'>OPERACIONES</th>";
                            html += "</tr>";
                            html += "<tbody class='buscar'>";

                              var totalfinal = Number(0);

                            for(var i = 0; i < tam; i++ ){


                                if (factura[i]['estado_id']==3)
                                    color = "style = 'background-color:gray'";
                                else
                                    color = "";

                                html += "<tr  "+color+">";
                                html += "   <td class='no-print'><a href='"+base_url+"factura/imprimir_factura_id/"+factura[i]["factura_id"]+"/1' class='btn btn-warning btn-xs' ' target='_BLANK' title='Imprimir factura original'><i class='fa fa-list'></i> </a>";
                                html += "   <a href='"+base_url+"factura/imprimir_factura_id/"+factura[i]["factura_id"]+"/2' class='btn btn-default btn-xs' ' target='_BLANK' title='Imprimir factura copia'><i class='fa fa-list'></i> </a>";

                                if(rolusuario_asignado == 1){

                                    if (factura["estado_id"]!=3){//si la factura esta anulada

                                        if(factura[i]["estado_id"]==1){

                                            if (parametro_tiposisistema == 1){
                                                html += "<button class='btn btn-danger btn-xs' onclick='anular_factura("+factura[i]["factura_id"]+","+factura[i]["venta_id"]+","+factura[i]["factura_numero"]+","+'"'+factura[i]["factura_razonsocial"]+'"'+","+factura[i]["factura_total"]+","+'"'+factura[i]["factura_fecha"]+'"'+")'><i class='fa fa-trash'></i> </button>";
                                            }
                                            else{
                                                if (factura[i]["factura_codigodescripcion"]=="VALIDADA"){
                                                    html += "<button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modalanular' onclick='cargar_modal_anular("+factura[i]["factura_id"]+","+factura[i]["venta_id"]+","+factura[i]["factura_numero"]+","+'"'+factura[i]["factura_razonsocial"]+'"'+","+factura[i]["factura_total"]+","+'"'+factura[i]["factura_fecha"]+'"'+")'>";
                                                html += "<fa class='fa fa-trash'> </fa> </button>";
                                                }else{
                                                    html += "<a class='btn btn-soundcloud btn-xs' data-toggle='modal' data-target='#modalanular_noenviada' onclick='cargar_modal_anular_malemitida("+factura[i]["factura_id"]+","+factura[i]["venta_id"]+","+factura[i]["factura_numero"]+","+'"'+factura[i]["factura_razonsocial"]+'"'+","+factura[i]["factura_total"]+","+'"'+factura[i]["factura_fecha"]+'"'+")'>";
                                                    html += "<fa class='fa fa-trash'> </fa> </a>";
                                                }
                                            }
                                        }

                                    }


                                            totalfinal += Number(factura[i]["factura_subtotal"]);                
                                }
                                html += "</td>";
                                html += "   <td>"+i+"</td>";
                                html += "   <td>0</td>";
                                html += "   <td>1</td>";
                                html += "   <td>"+formato_fecha(factura[i]["factura_fecha"])+"</td>";
                                html += "   <td><center>"+factura[i]["factura_numero"];


                                html += "<br>";

                                if (factura[i]["factura_codigodescripcion"]=="VALIDADA"){
                                    html += "<span class='btn btn-info btn-xs' style='padding:0; border:0;'><small>"+factura[i]["factura_codigodescripcion"]+"</small></span>";                        
                                }else{
                                    html += "<span class='btn btn-danger btn-xs' style='padding:0; border:0;' title='"+factura[i]["factura_mensajeslist"]+"'><small>FALLA</small></span>";
                                }

                                html += "</center></td>";


                                html += "   <td>"+factura[i]["factura_autorizacion"]+"</td>";
                                let enviada = factura[i]['factura_enviada'] == 1 ? "Enviada":"No enviada";
                                if(factura[i]["estado_id"]==1){
                                        html += "   <td>V</td>";
                                }
                                else{
                                        html += "   <td>A</td>";
                                }

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
        //                        html += "   <td><a href='"+base_url+"factura/imprimir_factura/"+factura[i]["venta_id"]+"' class='btn btn-warning btn-xs' ' target='_BLANK'><i class='fa fa-list'></i> </a>";
                                            html += "</tr>";
                            }    
                                var debitofiscal =  totalfinal * 0.13;

                                html += "<tr";
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
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th> </th> ";
                                html += "<th>"+Number(totalfinal).toFixed(2)+"</th> ";
                                html += "<th>"+Number(debitofiscal).toFixed(2)+"</th> ";
                                html += "<th> </th> ";
                                html += "</tr> ";
                           html += "</tbody>";
                            html += "</table>";
                            $("#tabla_factura").html(html);
                        }
                    },
                    error:function(result){alert("Ocurrio un error en la consulta. Revise los parametros por favor...!")},



                    });        
        
    }
    
}

function generarexcel(){
    
    var base_url = document.getElementById('base_url').value;
    var opcion = document.getElementById('opcion').value;
    var controlador = base_url+'factura/mostrar_facturas';    
    var desde = document.getElementById('fecha_desde').value;
    var hasta = document.getElementById('fecha_hasta').value; 
    var formato = document.getElementById('select_formato').value; 

     //parametro = document.getElementById('filtrar').value;   
     //controlador = base_url+'ingreso/buscarallingreso/';
    var showLabel = true;
    
    var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader

    $.ajax({url: controlador,
           type:"POST",
           data:{desde:desde, hasta:hasta ,opcion:opcion},
           success:function(result){
                var factura = JSON.parse(result);
                var tam = factura.length;
              
                var mensaje = "";
                
                html = "";
                
                if (opcion==1){ //ventas
                    if(formato==1){ //R.C.V.

                        /* **************INICIO Generar Excel JavaScript************** */
                          var CSV = 'sep=,' + '\r\n\n';
                          //This condition will generate the Label/Header
                          if (showLabel) {
                              var row = "";

                              //This loop will extract the label from 1st index of on array


                                  //Now convert each value to string and comma-seprated
                                  row += 'N°' + ',';
                                  row += 'ESPEC.' + ',';
                                  row += 'FECHA DE LA FACTURA' + ',';
                                  row += 'N° DE FACT.' + ',';
                                  row += 'N° DE AUTORIZACION' + ',';
                                  row += 'NIT/CI CLIENTE' + ',';
                                  row += 'COMPLEMENTO' + ',';
                                  row += 'RAZON SOCIAL' + ',';
                                  row += 'IMPORTE TOTAL DE LA VENTA' + ',';
                                  row += 'IMPORTE ICE' + ',';
                                  row += 'IMPORTE IEHD' + ',';
                                  row += 'IMPORTE IPJ' + ',';
                                  row += 'TASAS' + ',';
                                  row += 'OTROS NO SUJETOS AL VIA' + ',';
                                  row += 'VENTAS GRAVADAS A TASA CERO' + ',';
                                  row += 'SUBTOTAL' + ',';
                                  row += 'DESC. BONIF. Y REBAJAS OTORGADAS' + ',';
                                  row += 'IMPORTE GIFTCARD' + ',';
                                  row += 'IMPORTE BASE PARA DEBITO FISCAL' + ',';
                                  row += 'DEBITO FISCAL' + ',';
                                  row += 'ESTADO' + ',';
                                  row += 'CODIGO DE CONTROL' + ',';
                                  row += 'TIPO DE VENTA' + ',';
                                  row += 'TRANS' + ',';

                              row = row.slice(0, -1);

                              //append Label row with line break
                              CSV += row + '\r\n';
                          }

                          //1st loop is to extract each row
                          for (var i = 0; i < tam; i++) {
                              var row = "";
                              //2nd loop will extract each column and convert it in string comma-seprated

                                  row += '0,';
                                  row += '2,';
                                  row += '"' +formato_fecha(factura[i]["factura_fecha"])+ '",';
                                  row += '"' +factura[i]["factura_numero"]+ '",';
                                  row += '"' +factura[i]["factura_cuf"]+ '",';
                                  row += '"' +factura[i]["factura_nit"]+ '",';
                                  row += '"' +factura[i]["factura_complementoci"]+ '",';
                                  row += '"' +factura[i]["factura_razonsocial"]+ '",';
                                  row += '"' +Number(factura[i]["factura_subtotal"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_ice"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_exento"]).toFixed(2)+ '",';
                                  row += '0,';
                                  row += '0,';
                                  row += '0,';
                                  row += '0,';
                                  row += '"' +Number(factura[i]["factura_total"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_descuento"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_giftcard"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_total"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_total"]*0.13).toFixed(2)+ '",';
                                  if(factura[i]["estado_id"]==1){
                                      row += 'V,';
                                  }
                                  else{
                                      row += 'A,';
                                  }
                                  row += '"' +factura[i]["factura_codigocontrol"]+ '",';                                  
                                  row += '0,';
                                  row += '"' +factura[i]["venta_id"]+ '",';



                              row.slice(0, row.length - 1);

                              //add a line break after each row
                              CSV += row + '\r\n';
                          }

                          if (CSV == '') {        
                              alert("Invalid data");
                              return;
                          }

                          //Generate a file name
                          var fileName = "Ventas_";
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
                        }
                        
                    if(formato==2){ //L.C.V.

                        /* **************INICIO Generar Excel JavaScript************** */
                          var CSV = 'sep=,' + '\r\n\n';
                          //This condition will generate the Label/Header
                          if (showLabel) {
                              var row = "";

                              //This loop will extract the label from 1st index of on array


                                  //Now convert each value to string and comma-seprated
                                  row += 'ESPEC.' + ',';
                                  row += 'N°' + ',';
                                  row += 'FECHA DE LA FACTURA' + ',';
                                  row += 'N° DE FACT.' + ',';
                                  row += 'N° DE AUTORIZACION' + ',';
                                  row += 'ESTADO' + ',';
                                  row += 'NIT/CI CLIENTE' + ',';
                                  row += 'NOMBRE O RAZON SOCIAL' + ',';
                                  row += 'IMPORTE TOTAL DE LA VENTA' + ',';
                                  row += 'IMPORTE ICE' + ',';
                                  row += '/IEHD/TASAS    EXPORTACIONES Y OPERACIONES EXENTAS' + ',';
                                  row += 'VENTAS GRAVADAS A TASA CERO' + ',';
                                  row += 'SUBTOTAL' + ',';
                                  row += 'DESC.' + ',';
                                  row += 'BONIF. Y REBAJAS OTORGADAS' + ',';
                                  row += 'IMPORTE BASE PARA DEBITO FISCAL' + ',';
                                  row += 'DEBITO FISCAL' + ',';
                                  row += 'CODIGO DE CONTROL' + ',';
                                  row += 'TRANS' + ',';

                              row = row.slice(0, -1);

                              //append Label row with line break
                              CSV += row + '\r\n';
                          }

                          //1st loop is to extract each row
                          for (var i = 0; i < tam; i++) {
                              var row = "";
                              //2nd loop will extract each column and convert it in string comma-seprated

                                  row += '0,';
                                  row += '1,';
                                  row += '"' +formato_fecha(factura[i]["factura_fecha"])+ '",';
                                  row += '"' +factura[i]["factura_numero"]+ '",';
                                  row += '"' +factura[i]["factura_cuf"]+ '",';
                                  if(factura[i]["estado_id"]==1){
                                      row += 'V,';
                                  }
                                  else{
                                      row += 'A,';
                                  }
                                  row += '"' +factura[i]["factura_nit"]+ '",';
                                  row += '"' +factura[i]["factura_razonsocial"]+ '",';
                                  row += '"' +Number(factura[i]["factura_subtotal"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_ice"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_exento"]).toFixed(2)+ '",';
                                  row += '0,';
                                  row += '"' +Number(factura[i]["factura_total"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_descuento"]).toFixed(2)+ '",';
                                  row += '0,';
                                  row += '"' +Number(factura[i]["factura_total"]).toFixed(2)+ '",';
                                  row += '"' +Number(factura[i]["factura_total"]*0.13).toFixed(2)+ '",';
                                  row += '"' +factura[i]["factura_codigocontrol"]+ '",';
                                  row += '"' +factura[i]["venta_id"]+ '",';



                              row.slice(0, row.length - 1);

                              //add a line break after each row
                              CSV += row + '\r\n';
                          }

                          if (CSV == '') {        
                              alert("Invalid data");
                              return;
                          }

                          //Generate a file name
                          var fileName = "Ventas_";
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
                      }
                    
                        
              }
             
                if (opcion==2){ //COMPRAS
                    /* **************INICIO Generar Excel JavaScript************** */
                      var CSV = 'sep=,' + '\r\n\n';
                      //This condition will generate the Label/Header
                      if (showLabel) {
                          var row = "";

                          //This loop will extract the label from 1st index of on array


                              //Now convert each value to string and comma-seprated
                              row += 'ESPEC.' + ',';
                              row += 'N°' + ',';
                              row += 'FECHA DE LA FACTURA' + ',';
                              row += 'N° DE FACT.' + ',';
                              row += 'N° DE AUTORIZACION' + ',';
                              row += 'ESTADO' + ',';
                              row += 'NIT/CI CLIENTE' + ',';
                              row += 'NOMBRE O RAZON SOCIAL' + ',';
                              row += 'IMPORTE TOTAL DE LA VENTA' + ',';
                              row += 'IMPORTE ICE' + ',';
                              row += '/IEHD/TASAS    EXPORTACIONES Y OPERACIONES EXENTAS' + ',';
                              row += 'VENTAS GRAVADAS A TASA CERO' + ',';
                              row += 'SUBTOTAL' + ',';
                              row += 'DESC.' + ',';
                              row += 'BONIF. Y REBAJAS OTORGADAS' + ',';
                              row += 'IMPORTE BASE PARA DEBITO FISCAL' + ',';
                              row += 'DEBITO FISCAL' + ',';
                              row += 'CODIGO DE CONTROL' + ',';
                              row += 'TRANS' + ',';

                          row = row.slice(0, -1);

                          //append Label row with line break
                          CSV += row + '\r\n';
                      }

                      //1st loop is to extract each row
                      for (var i = 0; i < tam; i++) {
                          var row = "";
                          //2nd loop will extract each column and convert it in string comma-seprated

                              row += '0,';
                              row += '1,';
                              row += '"' +formato_fecha(factura[i]["factura_fecha"])+ '",';
                              row += '"' +factura[i]["factura_numero"]+ '",';
                              row += '"' +factura[i]["factura_cuf"]+ '",';
                              if(factura[i]["estado_id"]==1){
                                  row += 'V,';
                              }
                              else{
                                  row += 'A,';
                              }
                              row += '"' +factura[i]["factura_nit"]+ '",';
                              row += '"' +factura[i]["factura_razonsocial"]+ '",';
                              row += '"' +Number(factura[i]["factura_subtotal"]).toFixed(2)+ '",';
                              row += '"' +Number(factura[i]["factura_ice"]).toFixed(2)+ '",';
                              row += '"' +Number(factura[i]["factura_exento"]).toFixed(2)+ '",';
                              row += '0,';
                              row += '"' +Number(factura[i]["factura_total"]).toFixed(2)+ '",';
                              row += '"' +Number(factura[i]["factura_descuento"]).toFixed(2)+ '",';
                              row += '0,';
                              row += '"' +Number(factura[i]["factura_total"]).toFixed(2)+ '",';
                              row += '"' +Number(factura[i]["factura_total"]*0.13).toFixed(2)+ '",';
                              row += '"' +factura[i]["factura_codigocontrol"]+ '",';
                              row += '"' +factura[i]["venta_id"]+ '",';



                          row.slice(0, row.length - 1);

                          //add a line break after each row
                          CSV += row + '\r\n';
                    }
                    
                    if (CSV == '') {        
                        alert("Invalid data");
                        return;
                    }
                    
                    //Generate a file name
                    var fileName = "Ventas_";
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
            }
                
            
         //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_factura").html(html);
        },
        complete: function (jqXHR, textStatus) {
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });   

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

function generarexcel2(){
    var base_url = document.getElementById('base_url').value;
    var opcion = document.getElementById('opcion').value;
    var controlador = base_url+'factura/mostrar_facturas';    
    var desde = document.getElementById('fecha_desde').value;
    var hasta = document.getElementById('fecha_hasta').value; 

     //parametro = document.getElementById('filtrar').value;   
     //controlador = base_url+'ingreso/buscarallingreso/';
    var showLabel = true;
    
    var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader

    $.ajax({url: controlador,
           type:"POST",
           data:{desde:desde, hasta:hasta ,opcion:opcion},
           success:function(result){
                var factura = JSON.parse(result);
                var tam = factura.length;
              
                var mensaje = "";
                
                html = "";
                if (opcion==2){
                  /* **************INICIO Generar Excel JavaScript************** */
                    var CSV = 'sep=,' + '\r\n\n';
                    //This condition will generate the Label/Header
                    if (showLabel) {
                        var row = "";

                        //This loop will extract the label from 1st index of on array
                        

                            //Now convert each value to string and comma-seprated
                            row += 'ESPEC.' + ',';
                            row += 'N°' + ',';
                            row += 'FECHA DE LA FACTURA' + ',';
                            row += 'N° DE FACT.' + ',';
                            row += 'N° DE AUTORIZACION' + ',';
                            row += 'NIT/CI CLIENTE' + ',';
                            row += 'NOMBRE O RAZON SOCIAL' + ',';
                            row += 'IMPORTE TOTAL DE LA VENTA' + ',';
                            row += 'IMPORTE ICE' + ',';
                            row += '/IEHD/TASAS    EXPORTACIONES Y OPERACIONES EXENTAS' + ',';
                            row += 'VENTAS GRAVADAS A TASA CERO' + ',';
                            row += 'SUBTOTAL' + ',';
                            row += 'DESC.' + ',';
                            row += 'BONIF. Y REBAJAS OTORGADAS' + ',';
                            row += 'IMPORTE BASE PARA DEBITO FISCAL' + ',';
                            row += 'DEBITO FISCAL' + ',';
                            row += 'CODIGO DE CONTROL' + ',';
                            row += 'TRANS' + ',';
       
                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < tam; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        
                            row += '0,';
                            row += '1,';
                            row += '"' +formato_fecha(factura[i]["factura_fecha"])+ '",';
                            row += '"' +factura[i]["factura_numero"]+ '",';
                            row += '"' +factura[i]["factura_autorizacion"]+ '",';
                            row += '"' +factura[i]["factura_nit"]+ '",';
                            row += '"' +factura[i]["factura_razonsocial"]+ '",';
                            row += '"' +Number(factura[i]["factura_subtotal"]).toFixed(2)+ '",';
                            row += '"' +Number(factura[i]["factura_ice"]).toFixed(2)+ '",';
                            row += '"' +Number(factura[i]["factura_exento"]).toFixed(2)+ '",';
                            row += '0,';
                            row += '"' +Number(factura[i]["factura_subtotal"]).toFixed(2)+ '",';
                            row += '"' +Number(factura[i]["factura_descuento"]).toFixed(2)+ '",';
                            row += '0,';
                            row += '"' +Number(factura[i]["factura_total"]).toFixed(2)+ '",';
                            row += '"' +Number(factura[i]["factura_total"]*0.13).toFixed(2)+ '",';
                            row += '"' +factura[i]["factura_codigocontrol"]+ '",';
                            row += '"' +factura[i]["compra_id"]+ '",';
                            

                        
                        row.slice(0, row.length - 1);

                        //add a line break after each row
                        CSV += row + '\r\n';
                    }
                    
                    if (CSV == '') {        
                        alert("Invalid data");
                        return;
                    }
                    
                    //Generate a file name
                    var fileName = "Compras_";
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
            }
         //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_factura").html(html);
        },
        complete: function (jqXHR, textStatus) {
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });   

}

function anular_factura(factura_id, venta_id, factura_numero, factura_razon, factura_total, factura_fecha)
{
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/anular_factura/'+factura_id+"/"+venta_id;    

        var txt;
        var r = confirm("Esta a punto de anular una factura.\n"+"Factura Nº: "+factura_numero+"\n"+
                                  "Monto Bs: "+factura_total+"\n"+
                                  "Cliente: "+factura_razon+"\n"+
                                  "Fecha: "+formato_fecha(factura_fecha)+ "\n Esta operación es irreversible, ¿Desea Continuar?");
        if (r == true) {
   
            $.ajax({url:controlador,
                    type:"POST",
                    data:{},
                    success:function(result){
                        mostrar_facturas();
                        alert('Factura anulada con éxito..!!')
                    },
            });
        }


}

function anular_factura_electronica()
{
    var factura_id = document.getElementById("factura_id").value; 
    var venta_id = document.getElementById("venta_id").value; 
    var factura_numero = document.getElementById("factura_numero").value; 
    var factura_razon = document.getElementById("factura_cliente").value; 
    var factura_total = document.getElementById("factura_monto").value; 
    var factura_fecha = document.getElementById("factura_fecha").value;
    var motivo_id = document.getElementById("motivo_anulacion").value;
    let factura_correo = document.getElementById("factura_correo").value;

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/anular_factura/'+factura_id+"/"+venta_id;
    

        var txt;
        var r = confirm("Esta a punto de anular una factura.\n"+"Factura Nº: "+factura_numero+"\n"+
                                  "Monto Bs: "+factura_total+"\n"+
                                  "Cliente: "+factura_razon+"\n"+
                                  "Fecha: "+formato_fecha(factura_fecha)+ "\n Esta operación es irreversible, ¿Desea Continuar?");
        if (r == true) {
            let borrar_venta = 0;
            var re = confirm("Tambien quiere anular la venta asociada a la factura?\n"+"Venta Nº: "+venta_id+"\n"+
                                  "Esta operación es irreversible, ¿Desea Continuar?");
            if (re == true) {
                borrar_venta = 1;
            }
            document.getElementById('loader2').style.display = 'block';
            $.ajax({url:controlador,
                    type:"POST",
                    data:{motivo_id: motivo_id, factura_correo:factura_correo, borrar_venta:borrar_venta},
                    success:function(result){
                        res = JSON.parse(result);
                        
                        mostrar_facturas();
                        alert(JSON.stringify(res));
                        
                        document.getElementById('loader2').style.display = 'none';
                        $('#boton_cerrar').click();
                    },
            });
            
            document.getElementById('loader2').style.display = 'none';
        }else{
            document.getElementById('loader2').style.display = 'none';
        }

}

function anular_facturas()
{
    var factura_id = document.getElementById("factura_id").value; 
    var venta_id = document.getElementById("venta_id").value; 
    var factura_numero = document.getElementById("factura_numero").value; 
    var factura_razon = document.getElementById("factura_cliente").value; 
    var factura_total = document.getElementById("factura_monto").value; 
    var factura_fecha = document.getElementById("factura_fecha").value;
    var motivo_id = document.getElementById("motivo_anulacion").value;
    let factura_correo = document.getElementById("factura_correo").value;

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/anular_factura/'+factura_id+"/"+venta_id;
    

        var txt;
        var r = confirm("Esta a punto de anular una factura.\n"+"Factura Nº: "+factura_numero+"\n"+
                                  "Monto Bs: "+factura_total+"\n"+
                                  "Cliente: "+factura_razon+"\n"+
                                  "Fecha: "+formato_fecha(factura_fecha)+ "\n Esta operación es irreversible, ¿Desea Continuar?");
        if (r == true) {
            let borrar_venta = 0;
            var re = confirm("Tambien quiere anular la venta asociada a la factura?\n"+"Venta Nº: "+venta_id+"\n"+
                                  "Esta operación es irreversible, ¿Desea Continuar?");
            if (re == true) {
                borrar_venta = 1;
            }
            document.getElementById('loader2').style.display = 'block';
            $.ajax({url:controlador,
                    type:"POST",
                    data:{motivo_id: motivo_id, factura_correo:factura_correo, borrar_venta:borrar_venta},
                    success:function(result){
                        res = JSON.parse(result);
                        
                        mostrar_facturas();
                        alert(JSON.stringify(res));
                        
                        document.getElementById('loader2').style.display = 'none';
                        $('#boton_cerrar').click();
                    },
            });
            
            document.getElementById('loader2').style.display = 'none';
        }else{
            document.getElementById('loader2').style.display = 'none';
        }

}

function cargar_modal_anular(factura_id, venta_id, factura_numero, factura_razon, factura_total, factura_fecha)
{
    $("#factura_id").val(factura_id);
    $("#venta_id").val(venta_id);
    $("#factura_numero").val(factura_numero);
    $("#factura_monto").val(factura_total);
    $("#factura_fecha").val(formato_fecha(factura_fecha));
    $("#factura_cliente").val(factura_razon);
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'factura/get_correo';
    $.ajax({url:controlador,
                    type:"POST",
                    data:{venta_id: venta_id},
                    success:function(result){
                        res = JSON.parse(result);
                        if(res != null){
                            $("#factura_correo").val(res['cliente_email']);
                        }
                    },
            });

}

/* carga las facturas no enviadas, mal emitidas */
function cargar_modal_anular_malemitida(factura_id, venta_id, factura_numero, factura_razon, factura_total, factura_fecha)
{
    var decimales = document.getElementById('decimales').value;
//    alert(decimales);
    
    $("#facturamal_id").val(factura_id);
    $("#ventamal_id").val(venta_id);
    $("#facturamal_numero").val(factura_numero);
    $("#facturamal_monto").val(Number(factura_total).toFixed(decimales));
    $("#facturamal_fecha").val(formato_fecha(factura_fecha));
    $("#facturamal_cliente").val(factura_razon);
    /*let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'factura/get_correo';
    $.ajax({url:controlador,
                    type:"POST",
                    data:{venta_id: venta_id},
                    success:function(result){
                        res = JSON.parse(result);
                        if(res != null){
                            //$("#facturamal_correo").val(res['cliente_email']);
                        }
                    },
            });*/

}


function anular_factura_electronica_malemitida()
{
    var factura_id = document.getElementById("facturamal_id").value; 
    var venta_id = document.getElementById("ventamal_id").value; 
    var factura_numero = document.getElementById("facturamal_numero").value; 
    var factura_razon = document.getElementById("facturamal_cliente").value; 
    var factura_total = document.getElementById("facturamal_monto").value; 
    var factura_fecha = document.getElementById("facturamal_fecha").value;
    //var motivo_id = document.getElementById("motivo_anulacion").value;
    //let factura_correo = document.getElementById("factura_correo").value;

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/anular_factura_malemitida/'+factura_id+"/"+venta_id;
    
        var r = confirm("Esta a punto de anular una factura.\n"+"Factura Nº: "+factura_numero+"\n"+
                                  "Monto Bs: "+factura_total+"\n"+
                                  "Cliente: "+factura_razon+"\n"+
                                  "Fecha: "+formato_fecha(factura_fecha)+ "\n Esta operación es irreversible, ¿Desea Continuar?");
        if (r == true) {
            
            document.getElementById('loadermal').style.display = 'block';
            $.ajax({url:controlador,
                    type:"POST",
                    data:{},
                    success:function(result){
                        res = JSON.parse(result);
                        mostrar_facturas();
                        alert("Anulacion exitosa!.");
                        
                        document.getElementById('loadermal').style.display = 'none';
                        $('#boton_cerrarmal').click();
                    },
            });
            
            document.getElementById('loadermal').style.display = 'none';
        }else{
            document.getElementById('loadermal').style.display = 'none';
        }

}

function cargar_modal_anularforzado(factura_id, venta_id, factura_numero, factura_razon, factura_total, factura_fecha)
{
    $("#facturaforz_id").val(factura_id);
    $("#ventaforz_id").val(venta_id);
    $("#facturaforz_numero").val(factura_numero);
    $("#facturaforz_monto").val(factura_total);
    $("#facturaforz_fecha").val(formato_fecha(factura_fecha));
    $("#facturaforz_cliente").val(factura_razon);
}
//Funcion para validar un correo
function validar_correo(){
    let factura_correo = document.getElementById("facturaforz_correo").value;
    let caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if($.trim(factura_correo) == ""){
        /* 0 para que NO mande al correo */
        forzar_anular_facturasin(0);
    }else{
        if (caract.test(factura_correo) == false){
            $('#mensaje_correo').html("Correo invalido, verique el correo");
            $('#facturaforz_correo').focus();

        }else{
            $('#mensaje_correo').html("");
            /* 1 para que mande al correo mas */
            forzar_anular_facturasin(1);
        }
    }
}

function forzar_anular_facturasin(escorreo)
{
    var factura_id = document.getElementById("facturaforz_id").value; 
    var venta_id = document.getElementById("ventaforz_id").value; 
    var factura_numero = document.getElementById("facturaforz_numero").value; 
    var factura_razon = document.getElementById("facturaforz_cliente").value; 
    var factura_total = document.getElementById("facturaforz_monto").value; 
    var factura_fecha = document.getElementById("facturaforz_fecha").value;
    var motivo_id = document.getElementById("motivoforz_anulacion").value;
    let factura_correo = document.getElementById("facturaforz_correo").value;
    factura_correo = $.trim(factura_correo);
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/anular_factura_forzadasin';
    
        var r = confirm("Esta a punto de anular una factura.\n"+"Factura Nº: "+factura_numero+"\n"+
                                  "Monto Bs: "+factura_total+"\n"+
                                  "Cliente: "+factura_razon+"\n"+
                                  "Fecha: "+formato_fecha(factura_fecha)+ "\n Esta operación es irreversible, ¿Desea Continuar?");
        if (r == true) {
            
            document.getElementById('loaderforz').style.display = 'block';
            $.ajax({url:controlador,
                    type:"POST",
                    data:{factura_id:factura_id, venta_id:venta_id, motivo_id:motivo_id,
                          factura_correo:factura_correo, escorreo:escorreo},
                    success:function(result){
                        res = JSON.parse(result);
                        mostrar_facturas();
                        alert(JSON.stringify(res));
                        
                        document.getElementById('loaderforz').style.display = 'none';
                        $('#boton_cerrarforz').click();
                    },
            });
            
            document.getElementById('loaderforz').style.display = 'none';
        }else{
            document.getElementById('loaderforz').style.display = 'none';
        }

}