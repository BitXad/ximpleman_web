$(document).on("ready",inicio);
function inicio(){
    reportedetservicio();
}
/*aumenta un cero a un digito; es para las horas*/
function aumentar_cero(num){
    if (num < 10) {
        num = "0" + num;
    }
    return num;
}
/* recibe Date y devuelve en formato dd/mm/YYYY hh:mm:ss ampm */
function formatofecha_hora_ampm(string){
    var mifh = new Date(string);
    var info = "";
    var am_pm = mifh.getHours() >= 12 ? "p.m." : "a.m.";
    var hours = mifh.getHours() > 12 ? mifh.getHours() - 12 : mifh.getHours();
    if(string != null){
       info = aumentar_cero(mifh.getDate())+"/"+aumentar_cero((mifh.getMonth()+1))+"/"+mifh.getFullYear()+" "+aumentar_cero(hours)+":"+aumentar_cero(mifh.getMinutes())+":"+aumentar_cero(mifh.getSeconds())+" "+am_pm;
   }
    return info;
}

function convertDateFormat(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function reportedetservicio(){
    var base_url       = document.getElementById('base_url').value;
    var controlador    = base_url+"servicio/buscarrepservicioall";
    var fecha_desde    = document.getElementById('fecha_desde').value;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var estado_id      = document.getElementById('busestado_id').value;
    var usuario_id     = document.getElementById('bususuario_id').value;
    var responsable_id = document.getElementById('busresponsable_id').value;
    var buscar_clie    = document.getElementById('buscar_cliente').value;
    //var lasfechas     = " date(s.servicio_fecharecepcion) >= '"+fecha_desde+"'  and  date(s.servicio_fecharecepcion) <='"+fecha_hasta+"' ";
    var lasfechas      = "";
    var lasfechasfin = "";
    var esteestado_id = "";
    if(estado_id == 0){
        lasfechas     = " date(s.servicio_fecharecepcion) >= '"+fecha_desde+"'  and  date(s.servicio_fecharecepcion) <='"+fecha_hasta+"' ";
        lasfechasfin = "or (date(s.servicio_fechafinalizacion) >= '"+fecha_desde+"' and date(s.servicio_fechafinalizacion) <= '"+fecha_hasta+"') ";
        lasfechasfin = lasfechasfin+" or (date(ds.detalleserv_fechaproceso) >= '"+fecha_desde+"' and date(ds.detalleserv_fechaproceso) <= '"+fecha_hasta+"') "
        lasfechasfin = lasfechasfin+" or (date(ds.detalleserv_fechaterminado) >= '"+fecha_desde+"' and date(ds.detalleserv_fechaterminado) <= '"+fecha_hasta+"') "
    }else{
        esteestado_id = "and ds.estado_id = "+estado_id+" ";
    }
    if(estado_id == 28){
         lasfechas = " date(ds.detalleserv_fechaproceso) >= '"+fecha_desde+"'  and  date(ds.detalleserv_fechaproceso) <='"+fecha_hasta+"' ";
    }
    if(estado_id == 16){
         lasfechas = " date(s.servicio_fecharecepcion) >= '"+fecha_desde+"'  and  date(s.servicio_fecharecepcion) <='"+fecha_hasta+"' ";
    }
    if(estado_id == 7){
         lasfechas = " date(ds.detalleserv_fechaentregado) >= '"+fecha_desde+"'  and  date(ds.detalleserv_fechaentregado) <='"+fecha_hasta+"' ";
    }
    if(estado_id == 6){
         lasfechas = " date(ds.detalleserv_fechaterminado) >= '"+fecha_desde+"'  and  date(ds.detalleserv_fechaterminado) <='"+fecha_hasta+"' ";
    }
    if(estado_id == 5){
         lasfechas = " date(s.servicio_fecharecepcion) >= '"+fecha_desde+"'  and  date(s.servicio_fecharecepcion) <='"+fecha_hasta+"' ";
    }
    if(estado_id == 4){
         lasfechas = " date(s.servicio_fecharecepcion) >= '"+fecha_desde+"'  and  date(s.servicio_fecharecepcion) <='"+fecha_hasta+"' ";
    }
    var esteusuario_id= "";
    if( usuario_id !=0){
        esteusuario_id = "and ds.usuario_id = "+usuario_id+" ";
    }
    var esteresponsable_id= "";
    if( responsable_id !=0){
        esteresponsable_id = "and ds.responsable_id = "+responsable_id+" ";
    }
    var estebuscar_cliente = "";
    var buscar_cliente = buscar_clie.trim();
    if(buscar_cliente != ""){
        estebuscar_cliente = "and (c.cliente_nombre like '%"+buscar_cliente+"%' or "+
                             "c.cliente_codigo like '%"+buscar_cliente+"%' or "+
                             "c.cliente_ci like '%"+buscar_cliente+"%') "
    }
    //alert(estebuscar_cliente);
    var filtro = lasfechas+lasfechasfin+esteestado_id+esteusuario_id+esteresponsable_id+estebuscar_cliente;
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                $("#resdetserv").val("- 0 -");
                /*$("#esdesde").html(fecha_desde);
                $("#eshasta").html(fecha_hasta);*/
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   if(registros.length === 0){
                       alert("No hay resultados de la busqueda.");
                   }
                    var fecha1 = "<b>DESDE: </b>"+convertDateFormat(fecha_desde);
                    var fecha2 = "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HASTA: </b>"+convertDateFormat(fecha_hasta);
                    var estado = $('#busestado_id option:selected').text(); 
                    if(estado_id !=0){
                        estado = estado+"S";
                    }
                    $('#esteestado').html(estado);
                    
                    var tecnico = "<b>TÉCNICO: </b>"+$('#busresponsable_id option:selected').text();
                    if(buscar_cliente !=0){
                        buscar_cliente = "<br><b>CLIENTE: </b>"+buscar_cliente;
                    }
                    $('#detalledebusqueda').html(tecnico+"<br>"+fecha1+fecha2+buscar_cliente);
                    
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#resdetserv").val("- "+n+" -");
                   
                    html = "";
                    
                    var totaltotal    = 0;
                    var totalinsumo   = 0;
                    var totalacuenta  = 0;
                    var totalsaldo    = 0;
                    var totalutilidad = 0;

                    for (var i = 0; i < n ; i++){
                        totaltotal    = Number(totaltotal)  + Number(registros[i]['detalleserv_total']);
                        totalinsumo   = Number(totalinsumo)  + Number(registros[i]['total_insumo']) +Number(registros[i]['detalleserv_precioexterno']);
                        totalacuenta  = Number(totalacuenta)   + Number(registros[i]['detalleserv_acuenta']);
                        totalsaldo    = Number(totalsaldo) + Number(registros[i]['detalleserv_saldo']);
                        totalutilidad = Number(totalutilidad) + (Number(registros[i]['detalleserv_total'])-(Number(registros[i]['total_insumo'])+Number(registros[i]['detalleserv_precioexterno'])));
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        html += "<td id='horizontal'>";
                        html += registros[i]["cliente_nombre"];
                        html += "</td>";
                        html += "<td class='text-center'>"+registros[i]["servicio_id"]+"</td>";
                        html += "<td class='text-center maspeque'>"+convertDateFormat(registros[i]["servicio_fecharecepcion"])+" "+registros[i]["servicio_horarecepcion"]+"</td>";
                        var fechater = "";
                        if(registros[i]['detalleserv_fechaterminado'] !=null){
                            fechater = convertDateFormat(registros[i]["detalleserv_fechaterminado"])+" "+registros[i]["detalleserv_horaterminado"]
                        }
                        html += "<td class='text-center maspeque'>"+fechater+"</td>";
                        var fechaentreg = "";
                        if(registros[i]['detalleserv_fechaentregado'] !=null){
                            fechaentreg = convertDateFormat(registros[i]["detalleserv_fechaentregado"])+" "+registros[i]["detalleserv_horaentregado"]
                        }
                        html += "<td class='text-center maspeque'>"+fechaentreg+"</td>";
                        html += "<td class='text-right'>"+numberFormat(Number(registros[i]["detalleserv_total"]).toFixed(2))+"</td>";
                        html += "<td class='text-right'>"+numberFormat(Number(Number(registros[i]["total_insumo"])+ Number(registros[i]['detalleserv_precioexterno'])).toFixed(2))+"</td>";
                        html += "<td class='text-right'>"+numberFormat(Number(registros[i]["detalleserv_acuenta"]).toFixed(2))+"</td>";
                        html += "<td class='text-right'>"+numberFormat(Number(registros[i]["detalleserv_saldo"]).toFixed(2))+"</td>";
                        var resutilidad = Number(registros[i]["detalleserv_total"])-(Number(Number(registros[i]["total_insumo"])+Number(registros[i]['detalleserv_precioexterno'])));
                        html += "<td class='text-right'>"+numberFormat(Number(resutilidad).toFixed(2))+"</td>";
                        //html += "<td class='text-right'></td>";
                        html += "<td  class='text-center' style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td class='text-center'>"+registros[i]["tiposerv_descripcion"]+"</td>";
                        html += "<td class='conmenospacio'>";
                        if(registros[i]["detalleserv_descripcion"] !='' && registros[i]["detalleserv_descripcion"] != null){
                            var longdesc = registros[i]["detalleserv_descripcion"].length;
                            if(longdesc <= 20){
                                html += registros[i]["detalleserv_descripcion"];
                            }else{
                                html += registros[i]["detalleserv_descripcion"].substring(0, 20);
                            }
                        }
                        html += "</td>";
                        html += "<td class='maspeque'>"+registros[i]["respusuario_nombre"]+"</td>";
                        
                        html += "</tr>";
                       
                   }
                 
                    $('#eltotal').html(numberFormat(Number(totaltotal).toFixed(2)));
                    $('#elinsumo').html(numberFormat(Number(totalinsumo).toFixed(2)));
                    $('#elacuenta').html(numberFormat(Number(totalacuenta).toFixed(2)));
                    $('#elsaldo').html(numberFormat(Number(totalsaldo).toFixed(2)));
                    $('#lautilidad').html(numberFormat(Number(totalutilidad).toFixed(2)));
                    //$("#tablaresultados").html(htmlc+html+htmls+"</table>");
                    $("#tablaresultados").html(html);
                   
            }
            
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#resbusquedadetalleserv").html(html);
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
