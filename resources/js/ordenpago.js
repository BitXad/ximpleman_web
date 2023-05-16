$(document).on("ready",inicio);
function inicio(){
    buscarorden(1);
}

function buscarorden(num){
    if (num==1) {
        var control    = "orden_pago/pendientes";
    }

    else if (num==2) {
        var control    = "orden_pago/pagadas_hoy";
    }
    else if (num==3) {
        var control    = "orden_pago/pagadas_antes";
    }else if (num==4) {
        var control    = "orden_pago/mostrar_anuladas";
    }

    buscar(control);
}
function buscar(control){
    
 var decimales    = document.getElementById('decimales').value;
 var base_url    = document.getElementById('base_url').value;
 var filtro    = document.getElementById('filtro').value;
 var controlador = base_url+control;

 $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
 
           
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                   
                    var total = Number(0);
                    var pagados = Number(0);
                    
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                   
                   
                    html = "";
                   
                   
                    for (var i = 0; i < n ; i++){
                        
                        total += Number(registros[i]["orden_monto"]);
                        pagados += Number(registros[i]["orden_cancelado"]);
                        html += "<tr >";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["orden_destinatario"]+"</b></font><br>"+registros[i]["orden_motivo"]+"</td>";
                        html += "<td><img src='"+base_url+"('resources/images/usuarios/thumb_"+registros["usuario_imagen1"]+")' class='img-circle' width='40' height='40'>";
                        html += "<br><sub>"+registros[i]["usuario_nombre1"]+"</sub></td>";
                        html += "<td align='right'><font size='3'><b>"+Number(registros[i]["orden_monto"]).toFixed(decimales)+"</b></font>"; 
                        if (registros[i]["orden_fechapagar"]!=null) { 
                        html += "<br>"+moment(registros[i]["orden_fechapagar"]).format('DD/MM/YYYY')+"";
                        }
                        html += "</td>";
                        if (registros[i]["usuario_id2"]!=0) {
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'><img src='"+base_url+"('resources/images/usuarios/thumb_"+registros["usuario_imagen2"]+")' class='img-circle' width='40' height='40'>";
                        html += "<br><sub>"+registros[i]["usuario_nombre2"]+"</sub></td>";
                        }else{
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'></td>";    
                        }
                        html += "<td align='right' style='background-color: #"+registros[i]["estado_color"]+"'><font size='3'><b>"+Number(registros[i]["orden_cancelado"]).toFixed(decimales)+"</b></font>";
                        if (registros[i]["orden_fechapago"]!=null) { 
                        html += "<br>"+moment(registros[i]["orden_fechapago"]).format('DD/MM/YYYY')+"";
                        }
                        html += "</td><td style='background-color: #"+registros[i]["estado_color"]+"'>";
                        
                       // html += "<td><a href='"+base_url+"egreso/pdf/"+registros[i]["egreso_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></a>";
                        //html += "<a href='"+base_url+"egreso/boucher/"+registros[i]["egreso_id"]+"' title='BOUCHER' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></a>";
                        //html += "<a href='"+base_url+"egreso/edit/"+registros[i]["egreso_id"]+"'  class='btn btn-primary btn-xs'><span class='fa fa-pencil'></a>";
                       if (registros[i]["estado_id"]==8) {
                            //registros[i]["estado_nombre"]
                        html += "<span class='btn btn-facebook btn-xs'>"+registros[i]["estado_descripcion"]+"</span><br><a class='btn btn-success no-print' data-toggle='modal' data-target='#modalpagar"+registros[i]["orden_id"]+"' title=''><span class='fa fa-money'></span> Pagar</a>";
                        html += "<a class='btn btn-danger no-print' data-toggle='modal' data-target='#modalanular"+registros[i]["orden_id"]+"' title='Anular orden de pago'><span class='fa fa-trash'></span> Anular</a>";
                        html += "<!------------------------ INICIO modal para COBRAR ------------------->";
                        html += "<div class='modal fade' id='modalpagar"+registros[i]["orden_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center'><h3 class='modal-title' id='exampleModalLongTitle'>Pagar Orden: 00"+registros[i]["orden_id"];
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button></h3>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        
                        html += "<div class='row clearfix'><div class='col-md-3'>";                        
                        html += "<label for='orden_monto' class='control-label'>Monto Bs</label>";                        
                        html += "<div class='form-group'>";                        
                        html += "<input type='text' name='orden_monto' value='"+Number(registros[i]["orden_monto"]).toFixed(decimales)+"' class='form-control' id='orden_monto' readonly/>";                        
                        html += "</div></div><div class='col-md-3'>";                        
                        html += "<label for='orden_cancelado' class='control-label'>Pagar Bs</label><div class='form-group'>";                        
                        html += "<input type='number' min='"+registros[i]["orden_monto"]+"' step='any' name='orden_cancelado"+registros[i]["orden_id"]+"' value='"+Number(registros[i]["orden_monto"]).toFixed(decimales)+"' class='form-control' id='orden_cancelado"+registros[i]['orden_id']+"' required/>";                        
                        html += "</div></div><div class='col-md-3'>";                        
                        html += "<label for='orden_cobradopor' class='control-label'>Cobrado por:</label><div class='form-group'>";                        
                        html += "<input type='text' name='orden_cobradapor"+registros[i]["orden_id"]+"' value='' class='form-control' id='orden_cobradapor"+registros[i]["orden_id"]+"'  onKeyUp='this.value = this.value.toUpperCase();' required/>";                        
                        html += "</div></div><div class='col-md-3'><label for='orden_ci' class='control-label'>C.I.</label><div class='form-group'>";                        
                        html += "<input type='text' name='orden_ci"+registros[i]["orden_id"]+"' value='' class='form-control' id='orden_ci"+registros[i]["orden_id"]+"' />";                        
                        html += "</div></div></div>";                        
                            
                        
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button type='button' onclick='pagar("+registros[i]["orden_id"]+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </button>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para COBRAR ------------------->";
                        html += "<!------------------------ INICIO modal para confirmar anulacion ------------------->";
                        html += "<div class='modal fade' id='modalanular"+registros[i]["orden_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>";
                        html += "<div class='modal-dialog' role='document'>";
                        //html += "<br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center'><h3 class='modal-title' id='exampleModalLongTitle'>Anular Orden: 00"+registros[i]["orden_id"];
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button></h3>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<div style='font-size: 14pt'>";
                        html += "¿Esta seguro de anular este pedido?";
                        html += "</div>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer' style='text-align: center'>";
                        html += "<button type='button' onclick='anular("+registros[i]["orden_id"]+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </button>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar anulacion ------------------->";
                        html += "</td>";
                        }else{
                            if(registros[i]["orden_cobradapor"]!= null && registros[i]["orden_cobradapor"]!= ""){
                                html += ""+registros[i]["orden_cobradapor"]+"<br>"+registros[i]["orden_ci"]+"<br>";
                            }
                        html += "<span class='btn btn-facebook btn-xs'>"+registros[i]["estado_descripcion"]+"</span>";
                        if(registros[i]["estado_id"]!=27) {
                            html += "<a href='"+base_url+"orden_pago/imprimir/"+registros[i]["orden_id"]+"' target='_blank' class='btn btn-success btn-xs' title='Reimprimir comprobante de pago'><span class='fa fa-print'></span></a>";
                        }
                        
                        html += "</td>";
                        }
                        html += "</tr>";
                    } 
                        html += "<tr>";
                        html += "<th></th>";
                        html += "<th></th>";
                        html += "<th></th>";
                        html += "<th>"+Number(total).toFixed(decimales)+"</th>";
                        html += "<th></th>";
                        html += "<th>"+Number(pagados).toFixed(decimales)+"</th>";
                        html += "<th></th></tr>";
                        
                   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

function pagar(orden){

 var base_url    = document.getElementById('base_url').value;
 var cancelado    = document.getElementById('orden_cancelado'+orden).value;
 var cobrado    = document.getElementById('orden_cobradapor'+orden).value;
 var cicobra    = document.getElementById('orden_ci'+orden).value;
 var controlador = base_url+"orden_pago/pagar_orden/"+orden;

 $.ajax({url: controlador,
           type:"POST",
           data:{cancelado:cancelado,cobrado:cobrado,cicobra:cicobra},
          
           success:function(resul){
               window.open(base_url+"orden_pago/imprimir/"+orden, '_blank');
                   buscarorden(1); 

                 },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}
/* anular orden de epago */
function anular(orden_id){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"orden_pago/anular_orden/";
    
    $("#modalanular"+orden_id).modal('hide');
    /*var base_url    = document.getElementById('base_url').value;
    var cancelado    = document.getElementById('orden_cancelado'+orden).value;
    var cobrado    = document.getElementById('orden_cobradapor'+orden).value;
    var cicobra    = document.getElementById('orden_ci'+orden).value;
    */
    $.ajax({url: controlador,
            type:"POST",
            data:{orden_id:orden_id},
            success:function(resul){
                alert("Orden de pago anulado con exito!");
                buscarorden(1);
            },
            error:function(resul){
                // alert("Algo salio mal...!!!");
                html = "";
                $("#tablaresultados").html(html);
            }
        });   

}
