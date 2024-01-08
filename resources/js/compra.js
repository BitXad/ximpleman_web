var base_url;
$(document).on("ready",inicio);
function inicio(){       
        base_url = $('#base_url').val();
        tabladetallecompra(); 
        tablatotales();
}

function now_sql() {
  const fecha = new Date();
  const year = fecha.getFullYear();
  const month = agregarCeroSiNecesario(fecha.getMonth() + 1);
  const day = agregarCeroSiNecesario(fecha.getDate());
  const hours = agregarCeroSiNecesario(fecha.getHours());
  const minutes = agregarCeroSiNecesario(fecha.getMinutes());
  const seconds = agregarCeroSiNecesario(fecha.getSeconds());

  return `'${year}-${month}-${day} ${hours}:${minutes}:${seconds}'`;
}

function agregarCeroSiNecesario(numero) {
  return numero < 10 ? `0${numero}` : numero;
}


function imprimir_compra(){
    var estafh = new Date();
    $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
    $("#cabeceraprint").css("display", "");
    window.print();
    $("#cabeceraprint").css("display", "none");
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

function borrartodo(){
    // var base_url = document.getElementById('base_url').value;
    var compra_id = document.getElementById('compra_idie').value;
    var controlador = base_url+'compra/borrartodo/';
    $.ajax({url: controlador,
           type:"POST",
           data:{compra_id:compra_id},
           success:function(respuesta){  
                tabladetallecompra(); 
                },
        
    });
}  


function pasardetalle(e,compra_id,producto_id) {

  tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){ 


            detallecompra(compra_id,producto_id);
                      
                      

        }
}

function actualizadetalle(e,detalle_id,producto_id,compra_id) {

  tecla = (document.all) ? e.keyCode : e.which;

    if (tecla==13){ 
             
            editadetalle(detalle_id,producto_id,compra_id);            

        }
}

function formato_cantidad(cantidad){
    
    var decimales = document.getElementById('decimales').value;
    let partes = cantidad; 
    let partes1 = partes.toString(); 
    let partes2 = partes1.split('.'); 
    
        if (partes2[1] == 0){ 
            
            lacantidad = partes2[0];  
            
        }else{  
            
            lacantidad = numberFormat(Number(cantidad).toFixed(decimales)) 
            //lacantidad = number_format($d['detalleven_cantidad'],2,'.',',');  
        }

    return lacantidad;
}

function tabladetallecompra(){
    
    var controlador = "";
    //var limite = 1000;
    // var base_url = document.getElementById('base_url').value;
    var compra_id = document.getElementById('compra_idie').value;
    var bandera = document.getElementById('bandera').value;
    var modificar_detalle = document.getElementById('modificar_detalle').value;
    var eliminar_detalle = document.getElementById('eliminar_detalle').value;
    var monedaparam_id = document.getElementById('monedaparam_id').value; // de prametro
    var moneda_descripcion = document.getElementById('moneda_descripcion').value; // de parametro
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    controlador = base_url+'compra/detallecompra/';
    var decimales = document.getElementById('decimales').value;

    $.ajax({url: controlador,
            type:"POST",
            data:{compra_id:compra_id},
            success:function(respuesta){     
               
                var registros =  JSON.parse(respuesta);
                
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var total_detalle = Number(0);
                    var cantidad = Number(0);
                    var subtotal = Number(0);
                    var descuento = Number(0);
                    var descglo = Number(0);
                    var descuentosum = Number(0);
                    var subtotal_otramoneda = Number(0);
                    var subtotal_otram = Number(0);
                    var subtotal_estamoneda = Number(0);
                    var subtotal_estam = Number(0);
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                    var total_estamoneda = Number(0);
                    var total_estam = Number(0);
                    var totaldescuento_estamoneda = Number(0);
                    var totaldescuento_otram = Number(0);
                    var totaldescuento_otramoneda = Number(0);
                    var mon_secundaria = "";
                    html = "";
                    if(monedaparam_id == 1){
                        mon_secundaria = lamoneda[1]["moneda_descripcion"];
                    }else{
                        mon_secundaria = lamoneda[0]["moneda_descripcion"];
                    }
                   /*if (n <= limite) x = n; 
                   else x = limite;*/
                    
                    for (var i = 0; i < n ; i++){
                        
                        eldescuento = Number(Number(registros[i]["detallecomp_descuento"])*Number(registros[i]["detallecomp_cantidad"]));
                        if(monedaparam_id == registros[i]["estamoneda_id"]){
                            
                            total_estam = Number(registros[i]["detallecomp_total"]);
                            total_estamoneda += total_estam;
                            subtotal_estam = Number(registros[i]["detallecomp_subtotal"]);
                            subtotal_estamoneda += subtotal_estam;
                            totaldescuento_estamoneda += eldescuento;
                            
                            if(registros[i]["estamoneda_id"] == 1){
                                
                                total_otram = Number(registros[i]["detallecomp_total"])/Number(registros[i]["detallecomp_tc"]);
                                total_otramoneda += total_otram;
                                subtotal_otram = Number(registros[i]["detallecomp_subtotal"])/Number(registros[i]["detallecomp_tc"]);
                                subtotal_otramoneda += subtotal_otram;
                                //totaldescuento_otram = Number(Number(eldescuento)/Number(registros[i]["detallecomp_tc"]));
                                //totaldescuento_otramoneda += Number(Number(totaldescuento_otram)*Number(registros[i]["detallecomp_tc"]));
                                totaldescuento_otramoneda += Number(Number(eldescuento)/Number(registros[i]["detallecomp_tc"]));
                                
                            }else{
                                
                                total_otram = Number(registros[i]["detallecomp_total"])*Number(registros[i]["detallecomp_tc"]);
                                total_otramoneda += total_otram;
                                subtotal_otram = Number(registros[i]["detallecomp_subtotal"])*Number(registros[i]["detallecomp_tc"]);
                                subtotal_otramoneda += subtotal_otram;
                                //totaldescuento_otram = Number(Number(eldescuento)*Number(registros[i]["detallecomp_tc"]));
                                //totaldescuento_otramoneda += Number(Number(totaldescuento_otram)/Number(registros[i]["detallecomp_tc"]));
                                totaldescuento_otramoneda += Number(Number(eldescuento)*Number(registros[i]["detallecomp_tc"]));
                                
                            }
                        }else{
                            if(registros[i]["estamoneda_id"] == 1){
                                total_estam = Number(registros[i]["detallecomp_total"])/Number(registros[i]["detallecomp_tc"]);
                                total_otram = Number(total_estam)*Number(registros[i]["detallecomp_tc"]);
                                total_estamoneda += total_estam;
                                total_otramoneda += total_otram;
                                subtotal_estam = Number(registros[i]["detallecomp_subtotal"])/Number(registros[i]["detallecomp_tc"]);
                                subtotal_otram = Number(subtotal_estam)*Number(registros[i]["detallecomp_tc"]);
                                subtotal_estamoneda += subtotal_estam;
                                subtotal_otramoneda += subtotal_otram;
                                totaldescuento_estamoneda += Number(Number(eldescuento)/Number(registros[i]["detallecomp_tc"]));
                                totaldescuento_otram = Number(Number(eldescuento)/Number(registros[i]["detallecomp_tc"]));
                                totaldescuento_otramoneda += Number(Number(totaldescuento_otram)*Number(registros[i]["detallecomp_tc"]));
                            }else{
                                total_estam = Number(registros[i]["detallecomp_total"])*Number(registros[i]["detallecomp_tc"]);
                                total_otram = Number(total_estam)/Number(registros[i]["detallecomp_tc"]);
                                total_estamoneda += total_estam;
                                total_otramoneda += total_otram;
                                subtotal_estam = Number(registros[i]["detallecomp_subtotal"])*Number(registros[i]["detallecomp_tc"]);
                                subtotal_otram = Number(subtotal_estam)/Number(registros[i]["detallecomp_tc"]);
                                subtotal_estamoneda += subtotal_estam;
                                subtotal_otramoneda += subtotal_otram;
                                totaldescuento_estamoneda += Number(Number(eldescuento)*Number(registros[i]["detallecomp_tc"]));
                                totaldescuento_otram = Number(Number(eldescuento)*Number(registros[i]["detallecomp_tc"]));
                                totaldescuento_otramoneda += Number(Number(totaldescuento_otram)/Number(registros[i]["detallecomp_tc"]));
                            }
                        }
                        //alert(totaldescuento_otram);
                        //alert(totaldescuento_estamoneda);
                        //alert(totaldescuento_otramoneda);
                        /*if(monedaparam_id == registros[i]["estamoneda_id"]){
                            total_otramoneda += Number(registros[i]["detallecomp_total"]);
                        }else{*/
                            /*if(monedaparam_id == 1){
                                total_otram = Number(registros[i]["detallecomp_total"])/Number(lamoneda[1]["moneda_tc"]);
                                total_otramoneda += total_otram;
                            }else{
                                total_otram = Number(registros[i]["detallecomp_total"])*Number(lamoneda[1]["moneda_tc"]);
                                total_otramoneda += total_otram;
                            }*/
                        //}
                        //var suma = Number(registros[i]["detallecomp_total"]);
                        descuento += Number(registros[i]["detallecomp_descuento"]);
                        descglo += Number(registros[i]["detallecomp_descglobal"]);
                        subtotal += Number(registros[i]["detallecomp_subtotal"]);
                        cantidad += Number(registros[i]["detallecomp_cantidad"]);
                        total_detalle += Number(Number(registros[i]["detallecomp_subtotal"])-(Number(registros[i]["detallecomp_descuento"])*Number(registros[i]["detallecomp_cantidad"]))); 
                        descuentosum += Number(Number(registros[i]["detallecomp_descuento"])*Number(registros[i]["detallecomp_cantidad"]));
                        
                        if (esMobil()){

                        html += "<tr>";
                      
                        //#
                        html += "<td>"+(i+1)+"</td>";
                        //Producto/Unidad
                        html += "<td colspan='2' style='font-size:9px;'><a href='"+base_url+"producto/edit/"+registros[i]["producto_id"]+"' target='_blank' class='btn btn-info btn-xs' title='Modificar Producto'><span class='fa fa-pencil'></span></a><b>"+registros[i]["producto_nombre"]+" / </b>";
                        
                        //Producto/Unidad
                        html += "<b>"+registros[i]["detallecomp_unidad"]+"</b>";                                            
                        html += "<br>"+registros[i]["detallecomp_codigo"]+"<br>";
                        if (registros[i]["detallecomp_fechavencimiento"]!='0000-00-00'&&registros[i]["detallecomp_fechavencimiento"]!=null) {
                        html += "Venc:"+moment(registros[i]["detallecomp_fechavencimiento"]).format('DD/MM/YYYY')+"</font>";
                        }
                        html += "</td><td><input id='compra_identi'  name='compra_id' type='hidden' class='form-control' value='"+compra_id+"'>";
                        html += "<input id='producto_identi'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>" ;
                        
                        html += "<input  class='input-sm' style='font-size:9px; width:100%;padding-left:0px; padding-right:0px;' id='detallecomp_precio"+registros[i]["detallecomp_id"]+"'  name='producto_precio"+registros[i]["producto_id"]+"' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")'  class='form-control'  value='"+Number(registros[i]["detallecomp_precio"]).toFixed(decimales)+"'  ></td>"; 
                        html += "<td><input  class='input-sm' style='font-size:9px; width:100%;padding-left:0px; padding-right:0px;' id='detallecomp_costo"+registros[i]["detallecomp_id"]+"'  name='producto_costo"+registros[i]["producto_id"]+"' type='text' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' class='form-control' value='"+Number(registros[i]["detallecomp_costo"]).toFixed(decimales)+"' ></td>";
                        html += "<td><input  class='input-sm' style='font-size:9px;width:100%;padding-left:0px; padding-right:0px;' id='detallecomp_cantidad"+registros[i]["detallecomp_id"]+"'  name='cantidad' type='text' autocomplete='off' value='"+registros[i]["detallecomp_cantidad"]+"' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' >";
                        html += "<input id='detallecomp_id'  name='detallecomp_id' type='hidden' class='form-control' value='"+registros[i]["detallecomp_id"]+"'>";
                       
                        html += "<td style='font-size:9px; text-align:center;'>"+Number(registros[i]["detallecomp_subtotal"]).toFixed(decimales)+"</b></td>";
                        html += "<td><input  class='input-sm' style='font-size:9px;width:100%;padding-left:0px; padding-right:0px;' id='detallecomp_descuento"+registros[i]["detallecomp_id"]+"'  name='descuento'  type='text' autocomplete='off' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' value='"+Number(registros[i]["detallecomp_descuento"]).toFixed(decimales)+"' >";
                       
                        html += "</td>";

                        html += "<td style='font-size:9px;'>"+Number(registros[i]["detallecomp_descglobal"]).toFixed(decimales)+"</td>";
                        html += "<td><center>";
                        html += "<span class='badge badge-success'>";
                        html += "<font size='1'> <b>"+Number(registros[i]["detallecomp_total"]).toFixed(decimales)+"</b></font> <br>";
                        html += "</span></center></td>";
                        ////////////////////////////formu////////////////
                        html += "<td style='padding-left:4px; padding-right:4px;'>";
                        if(modificar_detalle == 1){
                            html += "<button type='button' onclick='editadetalle("+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' class='btn btn-success btn-xs'><span class='fa fa-save'></span></button>";
                        }
                        html += "<button type='button' onclick='mostrar_modalclasificador("+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+")' class='btn btn-info btn-xs'><span class='fa fa-list'></span></button>";
                        html += "<button type='button' onclick='mostrar_caracteristicas("+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+")' class='btn btn-info btn-xs'><span class='fa fa-list'></span></button>";
                        html += "</td>";
                        ////////////////////////////////fin fotmu//////////////////////
                        //html += "<td><form action='"+base_url+"detalle_compra/quitar/"+registros[i]["detallecomp_id"]+"/"+compra_id+"'  method='POST' class='form'>";
                        //html += "<input id='bandera' class='form-control' name='bandera' type='hidden' value='"+bandera+"' />";
                        //html += "<button type='submit' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button>";
                        html += "<td style='padding-left:4px; padding-right:4px;'>";
                        if(eliminar_detalle == 1){
                            html += "<button type='button' onclick='quitardetalle("+registros[i]["detallecomp_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></button>";
                        }
                        //html += "</form></td>";
                        html += "</td>";
                        html += "<tr>";


                     }else{
                         
                        var tamanio_fuente = '10px;';
                        var ancho_input = '60px;';
                        html += "<tr>";
                      
                        //#
                        html += "<td>"+(i+1)+"</td>";
                        //Producto/Unidad
                        html += "<td style='font-size:"+tamanio_fuente+" width:300px;'><a href='"+base_url+"producto/edit/"+registros[i]["producto_id"]+"' target='_blank' class='btn btn-info btn-xs' title='Modificar Producto'><span class='fa fa-pencil'></span></a><b>"+registros[i]["producto_nombre"]+"</b>";
                        
                        html += "<br><b>UNID.:</b> "+registros[i]["detallecomp_unidad"];      
                        
                            if (registros[i]["detallecomp_numerolote"]!=""){
                            html += "* <b>LOTE.:</b> "+registros[i]["detallecomp_numerolote"]+"</td>";      
                        }
                        
                        //Codigo
                        html += "<td style='font-size:"+tamanio_fuente+" text-align:center;'>"+registros[i]["detallecomp_codigo"]+"<br><font size='1'>";
                        
                        if (registros[i]["detallecomp_fechavencimiento"]!='0000-00-00'&&registros[i]["detallecomp_fechavencimiento"]!=null) {
                            html += "<span class='btn btn-xs btn-facebook' style='padding:0px; margin:0px;'> Venc:"+moment(registros[i]["detallecomp_fechavencimiento"]).format('DD/MM/YYYY')+"</span></font>";
                        }
                        
                        //Precio
                        html += "</td><td><input id='compra_identi'  name='compra_id' type='hidden' class='form-control' value='"+compra_id+"'>";
                        html += "<input id='producto_identi'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>" ;
                        
                        html += "<input  class='input-xs' style='font-size:"+tamanio_fuente+" width:"+ancho_input+";padding-left:0px; padding-right:0px;' id='detallecomp_precio"+registros[i]["detallecomp_id"]+"'  name='producto_precio"+registros[i]["producto_id"]+"' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")'  class='form-control'  value='"+Number(registros[i]["detallecomp_precio"]).toFixed(decimales)+"'  ></td>"; 
                        //Costo
                        html += "<td><input  class='input-xm' style='font-size:"+tamanio_fuente+" width:"+ancho_input+";padding-left:0px; padding-right:0px;' id='detallecomp_costo"+registros[i]["detallecomp_id"]+"'  name='producto_costo"+registros[i]["producto_id"]+"' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' class='form-control' value='"+Number(registros[i]["detallecomp_costo"]).toFixed(decimales)+"' ></td>";
                        //Cant.
                        
                        html += "<td style='padding-left:0px; padding-right:0px;'><input  class='input-xm' style='font-size:"+tamanio_fuente+" width:"+ancho_input+"' id='detallecomp_cantidad"+registros[i]["detallecomp_id"]+"'  name='cantidad' type='text' autocomplete='off' class='form-control' value='"+formato_cantidad(registros[i]["detallecomp_cantidad"])+"' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' >";
                        html += "<input id='detallecomp_id'  name='detallecomp_id' type='hidden' class='form-control' value='"+registros[i]["detallecomp_id"]+"'>";
                       
                        //html += "<td style='font-size:13px; text-align:center;'>"+Number(registros[i]["detallecomp_subtotal"]).toFixed(decimales)+"</b></td>";
                        //Subtotal Bs
                        html += "<td style='font-size:"+tamanio_fuente+" text-align:center;'>";
                        html += Number(subtotal_estam).toFixed(decimales)+"</b>";
                        //Unit.
                        html += "<br><span style='white-space: nowrap; font-size: 9px' class='text-bold'>";
                        html += mon_secundaria+" "+Number(subtotal_otram).toFixed(decimales)+"</span></td>";
                        html += "<td><input  class='input-xs' style='font-size:"+tamanio_fuente+" width:55px;' id='detallecomp_descuento"+registros[i]["detallecomp_id"]+"'  name='descuento'  type='text' autocomplete='off' class='form-control' onkeypress='actualizadetalle(event,"+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' value='"+Number(registros[i]["detallecomp_descuento"]).toFixed(decimales)+"' >";
                       
                        
                       
                  
                        html += "</td>";

                        //Global
                        html += "<td>"+Number(registros[i]["detallecomp_descglobal"]).toFixed(decimales)+"</td>";
                        html += "<td><center>";
                        /*html += "<span class='badge badge-success'>";
                        html += "<font size='2'> <b>"+Number(registros[i]["detallecomp_total"]).toFixed(decimales)+"</b></font> <br>";
                        html += "</span>";
                        */
                        html += "<span class='badge badge-success'>";
                        html += "<font size='2'> <b>";
                        html += Number(total_estam).toFixed(decimales);
                        html += "</b></font>";
                        html += "</span>";
                        html += "<br><span class='text-bold' style='white-space: nowrap; font-size: 9px'>";
                        html += mon_secundaria+" "+Number(total_otram).toFixed(decimales)+"</span>";
                        html += "</center></td>";
                        ////////////////////////////formu////////////////
                        html += "<td style='padding-left:4px; padding-right:4px;'>";
                        if(modificar_detalle == 1){
                            html += "<button type='button' onclick='editadetalle("+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+","+compra_id+")' class='btn btn-success btn-xs'><span class='fa fa-save'></span></button>";
                        }
                        
                        html += "<button type='button' onclick='mostrar_modalclasificador("+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+")' class='btn btn-primary btn-xs'><span class='fa fa-list'></span></button>";
                        html += "<button type='button' onclick='mostrar_caracteristicas("+registros[i]["detallecomp_id"]+","+registros[i]["producto_id"]+")' class='btn btn-info btn-xs'><i class='fa fa-edit'></i></button>";
                        
                        html += "</td>";
                        ////////////////////////////////fin fotmu//////////////////////
                        //html += "<td><form action='"+base_url+"detalle_compra/quitar/"+registros[i]["detallecomp_id"]+"/"+compra_id+"'  method='POST' class='form'>";
                        //html += "<input id='bandera' class='form-control' name='bandera' type='hidden' value='"+bandera+"' />";
                        //html += "<button type='submit' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button>";
                        html += "<td style='padding-left:4px; padding-right:4px;'>";
                        if(eliminar_detalle == 1){
                            html += "<button type='button' onclick='quitardetalle("+registros[i]["detallecomp_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></button>";
                        }
                        //html += "</form></td>";
                        html += "</td>";
                        html += "<tr>";
                     }
                    }
                    
                    html += "<th style='text-align: right' colspan='6' ><font size='3' face='Arial'<b>TOTAL "+moneda_descripcion+"</b></th>";
                    html += "<th align='right'><font size='2' face='Arial'<b>";
                    html += Number(subtotal_estamoneda).toFixed(decimales)+"</b>";
                    html += "<br><span style='white-space: nowrap; font-size: 10px'>";
                    html += mon_secundaria+" "+Number(subtotal_otramoneda).toFixed(decimales)+"</span></th>";
                    html += "<th align='right'><font size='2' face='Arial'<b>"+Number(totaldescuento_estamoneda).toFixed(decimales)+"</b>";
                    html += "<br><span style='white-space: nowrap; font-size: 10px'>";
                    html += mon_secundaria+" "+Number(totaldescuento_otramoneda).toFixed(decimales)+"</span></th>";
                    html += "<th align='right'><font size='2' face='Arial'<b>"+Number(descglo).toFixed(decimales)+"</b></th>";
                    //html += "<th align='right' style='padding: 0px'><font size='2' face='Arial'<b>"+Number(total_estamoneda).toFixed(decimales)+"</b>";
                    html += "<th align='right' style='padding: 0px'><font size='2' face='Arial'<b>"+Number(subtotal_estamoneda-totaldescuento_estamoneda-descglo).toFixed(decimales)+"</b>";
                    html += "<br><span style='white-space: nowrap; font-size: 10px'>";
                    html += mon_secundaria+" "+Number(total_otramoneda).toFixed(decimales)+"</span></th>";
                    html += "<th colspan='2'></th>";
                    html += "</font></tr>";

                   $("#detallecompringa").html(html);
                   tablatotales(total_estamoneda,totaldescuento_estamoneda,subtotal_estamoneda);
                   
                }

        },
        error:function(respuesta){}
    });
}

function mostrar_modalclasificador(detallecomp_id, producto_id){    

    mostrar_clasificador(detallecomp_id, producto_id);
    $("#boton_modal_promocion").click(); 
    
}

function mostrar_caracteristicas(detallecomp_id, producto_id){
    $('#modalCaracteristicas').modal('show');
    $('#detcompra').val(detallecomp_id);
    $('#producto').val(producto_id);
    let controlador = `${base_url}detalle_compra/get_compra_serie`;
    $.ajax({
        url: controlador,
        type: 'POST',
        data: {
            detallecomp_id: detallecomp_id,
        },
        success:(result) => {
            let res = JSON.parse(result);
            $('#detallecomp_series').val(res != null ? res['detallecomp_series']:'');
        },
        error:()=>{
            alert('Error: No se pudo obtener las preferencias y caracteristicas de la compra')
        }
    })
}

function guardar_preferenciaCaracteristicas(){
    let detcompra = $('#detcompra').val();
    let producto = $('#producto').val();
    let series = $('#detallecomp_series').val();
    // let caracteristicas = $('#detallecomp_caracteristicas').val();
    let controlador = `${base_url}detalle_compra/save_preferenciaCaracteristicas`;
    $.ajax({
        url: controlador,
        type: 'POST',
        data:{
            detcompra:detcompra,
            producto:producto,
            series:series,
        },
        success:()=>{
            $('#modalCaracteristicas').modal('hide');
        },
        error:()=>{
            alert("Error: No se pudo guardar las preferencias y caracteristicas");
        }
    });
}

function mostrar_clasificador(detallecomp_id, producto_id){
    
    // var base_url = document.getElementById('base_url').value;
    var compra_id = document.getElementById('compra_id').value;
    var cantidadmax = document.getElementById('detallecomp_cantidad'+detallecomp_id).value;

    var controlador = base_url+"compra/clasificador_producto";

    $("#input_detallecompid").val(detallecomp_id);
    $("#input_productoid").val(producto_id);
    
    
    $("#input_cantidadmax").val(cantidadmax);
    
    
    //para llenar el select de clasificador de productos
     $.ajax({url: controlador,
           type:"POST",
           data:{detallecomp_id:detallecomp_id, producto_id:producto_id},
           success:function(respuesta){     
               r = JSON.parse(respuesta);
               var html = "";
               //alert(r.length);
               
                html +="<select id='select_clasificador'>";
               
               
               for (var i=0; i<r.length; i++){
                   html +="<option value="+r[i]["clasificador_id"]+">";
                    html +=r[i]["clasificador_nombre"];
                   html +="</option>";                   
               }
                html +="</select>";
               
               
               $("#div_clasificador").html(html);

           },
           error: function(respuesta){
               
           }
       });
                   
    
    controlador = base_url+"compra/clasificador_detalle";
    
    //mostrar la tabla de clasificador de productos
     $.ajax({url: controlador,
           type:"POST",
           data:{detallecomp_id:detallecomp_id, producto_id:producto_id},
           success:function(respuesta){     
               r = JSON.parse(respuesta);
               var html = "";
               var cant_total = 0;
               //alert(r.length);
                                             
               for (var i=0; i<r.length; i++){
                   html +="<tr>";
                   html +="<td>"+(i+1)+"</td>" ;
                   html +="<td>"+r[i]["clasificador_nombre"]+"</td>" ;
                   html +="<td>"+r[i]["detallecomp_costo"]+"</td>" ;
                   
                   cantidad = Number(r[i]["detalleclas_cantidad"]);
                   cant_total += cantidad;
                   
                   html +="<td>"+cantidad.toFixed(decimales)+"</td>" ;
                   total = r[i]["detalleclas_cantidad"] * r[i]["detallecomp_costo"];
                   
                   html +="<td>"+total.toFixed(decimales)+"</td>" ;
                   
                   html +="<td> <button class='btn btn-xs btn-danger' onclick='eliminar_clasificador("+r[i]["detalleclas_id"]+")'><fa class='fa fa-trash'></fa> </button></td>" ;
                   
                   html +="</td>";                   
               }
               
                   html +="<tr>";
                   //html +="<th><input type='hidden' value='"+r[0]["detallecomp_cantidad"]+"' id='input_cantidadmax'><input type='hidden' value='"+cant_total+"' id='input_cantidadtotal'></th>";
                   html +="<th></th>";
                   html +="<th></th>";
                   html +="<th></th>";
                   html +="<th>"+cant_total+"</th>";
                   html +="<th></th>";
                   html +="<th></th>";
                   
                   html +="</tr>";                   
               
             
                $("#input_cantidadtotal").val(cant_total);
      
               $("#tablaclasificador").html(html);
               
               
           },
           error: function(respuesta){
               
           }
       });
       
                
//       $("#boton_modal_promocion").click(); 
               
}

function registrar_clasificador(){
    
    // var base_url = document.getElementById('base_url').value;
    
    var cantidad = document.getElementById('input_cantidad').value;
    var cantidad_max = document.getElementById('input_cantidadmax').value;
    var cantidad_total = document.getElementById('input_cantidadtotal').value;
    var clasificador_id = document.getElementById('select_clasificador').value;
    var detallecomp_id = document.getElementById('input_detallecompid').value;
    var producto_id = document.getElementById('input_productoid').value;
    var controlador = base_url+"compra/registrar_clasificador";

    var total = Number(cantidad) + Number(cantidad_total) ;
    
    //alert(total+" - "+cantidad_max);

    if (total <= cantidad_max){
    //alert(cantidad+" * "+clasificador_id+" * "+detallecomp_id+" * "+producto_id);
    //para llenar el select de clasificador de productos    
     $.ajax({url: controlador,
           type:"POST",
           data:{detallecomp_id:detallecomp_id, cantidad:cantidad, clasificador_id:clasificador_id, producto_id:producto_id},
           success:function(respuesta){     

            res = JSON.parse(respuesta);
            
              if (res == false){
                    alert("ADVERTENCIA: El elemento ya se encuentra registrado..!");                       
              } 
              else{ 
       
                        mostrar_clasificador(detallecomp_id, producto_id);

               } 

           },
           error: function(respuesta){
               
           }
       });
       
    }
    else{
        alert("ADVERTENCIA: La cantidad que excede el limite especificado...!");
    }
    
}

function eliminar_clasificador(detalleclas_id){
    
    // var base_url = document.getElementById('base_url').value;    
    var controlador = base_url+"compra/eliminar_clasificador";
    var detallecomp_id = document.getElementById('input_detallecompid').value;
    var producto_id = document.getElementById('input_productoid').value;


    //alert(cantidad+" * "+clasificador_id+" * "+detallecomp_id+" * "+producto_id);
    //para llenar el select de clasificador de productos
     $.ajax({url: controlador,
           type:"POST",
           data:{detalleclas_id:detalleclas_id},
           success:function(respuesta){

                mostrar_clasificador(detallecomp_id, producto_id)               

           },
           error: function(respuesta){
               
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

function tablatotales(total_detalle,descuento,subtotal)
{
    var decimales = document.getElementById('decimales').value;
    var parcial = Number(subtotal-descuento);
    var globaly = Number(document.getElementById('compra_descglobal').value);
    //var totalfinal = Number(total_detalle-globaly);
    var totalfinal = Number(subtotal-globaly-descuento);
    var decimales = document.getElementById('decimales').value;
    
    $('#compra_subtotal').val(Number(subtotal).toFixed(decimales));
$('#compra_descuento').val(Number(descuento).toFixed(decimales));
   $('#compra_total').val(Number(parcial).toFixed(decimales));
    $("#compra_totalfinal").val(Number(totalfinal).toFixed(decimales));
    //$("#venta_glogal").val(globaly);
     

     html = "";
     html += "<table><tr><td>Sub Total Bs:</td><td></td>";
     html += "<td style='text-align: right;'>"+Number(subtotal).toFixed(decimales)+"</td>";
     html += "</tr><tr>";
     html += "<td>Descuento:</td><td></td>";
     html += "<td style='text-align: right;'>"+Number(descuento).toFixed(decimales)+"</td>";
     html += "</tr><tr>";
     html += "<td>Descuento Global:</td><td style='width: 30px;'></td>";
     html += "<td style='text-align: right;'>"+Number(globaly).toFixed(decimales)+"</td>";
     html += "</tr>";
     html += "<tr>";
     html += "<th><b>TOTAL FINAL:</b></th><td></td>";
     html += "<th style='text-align: right;'><font size='3'><b>"+Number(totalfinal).toFixed(decimales)+"</b></font></th>";
     html += "</tr></table>";
 


    $("#detalleco").html(html); 
}


function detallecompra(compra_id,producto_id){
    
    var controlador = "";
    if(document.getElementById("agrupar").checked==true){
        var agrupar = 1;
    }else{
        var agrupar = 0;
    }
    var cantidad = document.getElementById('cantidaddetalle'+producto_id).value; 
    var descuento = document.getElementById('descuentodetalle'+producto_id).value;
    var producto_costo = document.getElementById('producto_costodetalle'+producto_id).value;
    var producto_precio = document.getElementById('producto_preciodetalle'+producto_id).value;
    var producto_fechavenc = document.getElementById('detallecomp_fechavencimiento'+producto_id).value;
    var producto_factor = document.getElementById('select_factor'+producto_id).value;
    var moneda_id = document.getElementById('moneda_id'+producto_id).value;
    var numerolote = document.getElementById('numerolote'+producto_id).value;
    var moneda_tc = document.getElementById('moneda_tc').value;
    
    // var base_url = document.getElementById('base_url').value;
    controlador = base_url+'compra/ingresarproducto/';
    document.getElementById('producto'+producto_id).style.display = 'none';
    $.ajax({url: controlador,
            type:"POST",
            data:{compra_id:compra_id, producto_id:producto_id, cantidad:cantidad, descuento:descuento,
                  producto_costo:producto_costo, producto_precio:producto_precio, agrupar:agrupar,
                  producto_fechavenc:producto_fechavenc, producto_factor:producto_factor,
                  moneda_id:moneda_id, moneda_tc:moneda_tc, numerolote:numerolote},
            success:function(respuesta){
                tabladetallecompra();
            }
    });
    
}
 
function quitardetalle(detallecomp_id){


    // var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'compra/quitar/'+detallecomp_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tabladetallecompra();
            }        
    });

}   

function editadetalle(detallecomp_id,producto_id,compra_id){
    
    // var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'compra/updateDetalle/';
    var costo = document.getElementById('detallecomp_costo'+detallecomp_id).value;
    var precio = document.getElementById('detallecomp_precio'+detallecomp_id).value;
    var cantidad = document.getElementById('detallecomp_cantidad'+detallecomp_id).value;
    var descuento = document.getElementById('detallecomp_descuento'+detallecomp_id).value;
    
    
    $.ajax({url: controlador,
            type:"POST",
            data:{detallecomp_id:detallecomp_id,costo:costo,precio:precio,cantidad:cantidad,descuento:descuento,producto_id:producto_id,compra_id:compra_id},
            success:function(respuesta){
                //alert(detallecomp_id);
                tabladetallecompra();
            }        
    });

} 
      
function modificarproveedores(compra_id,proveedor_id){
    
    // var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'compra/modificarproveedor/';
    var nit = document.getElementById('proveedor_nit'+proveedor_id).value;
    var razon = document.getElementById('proveedor_razon'+proveedor_id).value;
    var codigo = document.getElementById('proveedor_codigo'+proveedor_id).value;
    var autorizacion = document.getElementById('proveedor_autorizacion'+proveedor_id).value;
    
    
    $.ajax({url: controlador,
            type:"POST",
            data:{proveedor_id:proveedor_id,nit:nit,razon:razon,codigo:codigo,autorizacion:autorizacion},
            success:function(respuesta){
                //alert(detallecomp_id);
                cambiarproveedores(compra_id,proveedor_id);
            }        
    });

} 

function cambiarproveedores(compra_id,proveedor_id) {
     
    // var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'proveedor/cambiarproveedor/';
    var limite = 500;
    //var nit = document.getElementById('proveedor_nit'+proveedor_id).value;
               // var razon_social = document.getElementById('proveedor_razon'+proveedor_id).value;
                //var codigo_control = document.getElementById('proveedor_codigo'+proveedor_id).value;
                //var autorzacion = document.getElementById('proveedor_autorizacion'+proveedor_id).value;
               
    $.ajax({url: controlador,
           type:"POST",
           data:{compra_id:compra_id,proveedor_id:proveedor_id},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
                var p = 0;
               
               html = "";   
               html2 = "";   

                
             
                    html = registros[p]['proveedor_nombre'];
                     $("#provedordecompra").html(html);

                    html = "<input id='prove_id' type='hidden' value='"+proveedor_id+"'>";
                     $("#prove_iden").html(html);

                    html = registros[p]['proveedor_codigo'];
                     $("#provedorcodigo").html(html);
                  
                     html = "<a  href='#' data-toggle='modal' data-target='#modalcobrar' class='btn btn-xs btn-success' ><i class='fa fa-money'></i>Finalizar compra</a>";
                     var html5 = "<a href='#' data-toggle='modal' data-target='#modalcobrar' class='btn btn-sq-lg btn-success' style='width: 120px !important; height: 120px !important;'><i class='fa fa-money fa-4x'></i><br>Finalizar<br>Compra<br></a>";
                    $("#provedorboton").html(html);
                    $("#provedorboton2").html(html5);

                    html2 += registros[p]['proveedor_autorizacion'];
                    var html3 = registros[p]['proveedor_nit'];
                    var html4 = registros[p]['proveedor_razon'];
                    $("#autori").val(html2); 
                    $("#factura_nit").val(html3); 
                    $("#factura_razonsocial").val(html4); 
                    

            } else{
                    html = "<a  onclick='myFunction()' href='#' class='btn btn-xs btn-success' ></i>Finalizar compra </a>";
                    var html5 = "<a onclick='myFunction()' class='btn btn-sq-lg btn-success' style='width: 120px !important; height: 120px !important;'><i class='fa fa-money fa-4x'></i><br>Finalizar<br>Compra<br></a>";
                        $("#provedorboton").html(html);
                        $("#provedorboton2").html(html5);
                        }
             },
            error:function(respuesta){
           html = "";
           $("#provedordecompra").html(html);
          
} 
            });   

 

}

function crearproveedor(compra_id) {
     
    // var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'proveedor/rapido/';
    var limite = 500;
    
                var proveedor_nombre = document.getElementById('proveedor_nombre1').value;

                var proveedor_nit = document.getElementById('proveedor_nit').value;
                var proveedor_razon = document.getElementById('proveedor_razon').value;
                var proveedor_codigo = document.getElementById('proveedor_codigo1').value;
                var proveedor_autorizacion = document.getElementById('proveedor_autorizacion').value;
                var proveedor_contacto = document.getElementById('proveedor_contacto').value;
                var proveedor_direccion = document.getElementById('proveedor_direccion').value;
                var proveedor_telefono = document.getElementById('proveedor_telefono').value;
                var proveedor_telefono2 = document.getElementById('proveedor_telefono2').value;
                
            $.ajax({url: controlador,
           type:"POST",
           data:{compra_id:compra_id,proveedor_nombre:proveedor_nombre,proveedor_nit:proveedor_nit,proveedor_razon:proveedor_razon,proveedor_codigo:proveedor_codigo,proveedor_autorizacion:proveedor_autorizacion,proveedor_contacto:proveedor_contacto,proveedor_direccion:proveedor_direccion,proveedor_telefono:proveedor_telefono,proveedor_telefono2:proveedor_telefono2},
           success:function(respuesta){ 
                var registros =  JSON.parse(respuesta);
                 if (registros != null){
                 var n = registros.length;
                var p = 0;
                var proveedor_id = registros[p]['proveedor_id']; 
                   html = "";   

                
             
                    html = registros[p]['proveedor_nombre'];
                     $("#provedordecompra").html(html);

                    html = "<input id='prove_id' type='hidden' value='"+proveedor_id+"'>";
                     $("#prove_iden").html(html);

                    html = registros[p]['proveedor_codigo'];
                     $("#provedorcodigo").html(html);
                  
                     html = "<a  href='#' data-toggle='modal' data-target='#modalcobrar' class='btn btn-xs btn-success' ><i class='fa fa-money'></i>Finalizar compra</a>";
                    $("#provedorboton").html(html);
                    var html5 = "<a href='#' data-toggle='modal' data-target='#modalcobrar' class='btn btn-sq-lg btn-success' style='width: 120px !important; height: 120px !important;'><i class='fa fa-money fa-4x'></i><br>Finalizar<br>Compra<br></a>";
                     $("#provedorboton2").html(html5);
                     $("#modalproveedor").modal('hide');
            } else{
                    
                    html = "<a onclick='myFunction()' href='#' class='btn btn-xs btn-success' ></i>Finalizar compra </a>";
                        $("#provedorboton").html(html);
                    var html5 = "<a onclick='myFunction()' class='btn btn-sq-lg btn-success' style='width: 120px !important; height: 120px !important;'><i class='fa fa-money fa-4x'></i><br>Finalizar<br>Compra<br></a>";

                        $("#provedorboton2").html(html5);
                        $("#mensaje").html("<br> Debe llenar el campo Nombre");

                        }
             },

              
 error:function(respuesta){
           html = "";
           $("#provedordecompra").html(html);
          
} 
            });   

 

}

function validacompra(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
   
    if (tecla==13){ 
    
        if (opcion==1){             
            buscarcliente();            
        }

        if (opcion==2){   
            $("#telefono").val(''); //si la tecla proviene del input telefono
           document.getElementById('telefono').focus();           
        } 
        if (opcion==3){   //si la tecla proviene del input codigo de barras
            buscarporcodigo();           
        } 
        if (opcion==4){   //si la tecla proviene del campo buscar compra
 
            compraproveedor(1);           
        } 
        
    } 

    
}
function compravalidar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
       
            tablaresultados(1);           
        
        
    } 

    
}
function compraproducto(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
        if (opcion==1){             
            buscarcliente();            
        }

        if (opcion==2){   
            $("#telefono").val(''); //si la tecla proviene del input telefono
           document.getElementById('telefono').focus();           
        } 
        if (opcion==3){   //si la tecla proviene del input codigo de barras
            buscarporcodigo();           
        } 
        if (opcion==4){   //si la tecla proviene del 
       
            tablareproducto(1);  
           
        } 
        
    } 

    
}

function buscar_compras()
{
    // var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";
    var opcion      = document.getElementById('select_compra').value;
 
    var nowsql = now_sql();

    if (opcion == 1)
    {
        filtro = " and date(compra_fecha) = date("+nowsql+")";
        mostrar_ocultar_buscador("ocultar");
        $("#busquedaavanzada").html('Del Dia');
               
    }//compras de hoy
    
    if (opcion == 2)
    {
       
        filtro = " and date(compra_fecha) = date_add(date("+nowsql+"), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
        $("#busquedaavanzada").html('De Ayer');
    }//compras de ayer
    
    if (opcion == 3) 
    {
    
        filtro = " and date(compra_fecha) >= date_add(date("+nowsql+"), INTERVAL -1 WEEK)";//compras de la semana
        mostrar_ocultar_buscador("ocultar");
        $("#busquedaavanzada").html('De la Semana');
            }

    
    if (opcion == 4) 
    {   filtro = " ";//todos los compras
        mostrar_ocultar_buscador("ocultar");

    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }
    
            
    if (opcion == 6) {
        //alert("llega aqui...!");
        mostrar_ocultar_buscador("ocultar");
        filtro = " and NOT EXISTS (SELECT 1 FROM detalle_compra dc WHERE dc.compra_id = c.compra_id) ";
    }

    fechadecompra(filtro);
}

    function reporte_compras(){
        // var base_url    = document.getElementById('base_url').value;
        //var controlador = base_url+"compra";
        var opcion      = document.getElementById('select_compra').value;
        if (opcion == 1)
        {
            filtro = " and date(compra_fecha) = date("+nowsql+")";
            mostrar_ocultar_buscador("ocultar");   
        }//compras de hoy
        if (opcion == 2)
        {
            filtro = " and date(compra_fecha) = date_add(date("+nowsql+"), INTERVAL -1 DAY)";
            mostrar_ocultar_buscador("ocultar");
        }//compras de ayer
        if (opcion == 3) 
        {
            filtro = " and date(compra_fecha) >= date_add(date("+nowsql+"), INTERVAL -1 WEEK)";//compras de la semana
            mostrar_ocultar_buscador("ocultar");

        }
        if (opcion == 4) 
        {   filtro = " ";//todos los compras
            mostrar_ocultar_buscador("ocultar");

        }
        if (opcion == 5) {
            mostrar_ocultar_buscador("mostrar");
            filtro = null;
        }

        reportefechadecompra(filtro);
    }

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar")
        document.getElementById('buscador_oculto').style.display = 'block';
    else
        document.getElementById('buscador_oculto').style.display = 'none';
    
}

function mostrar_radio(){
    //  var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";
    var opcionradio      = document.getElementById('tipotrans').value;
     if (opcionradio == 2) {

       document.getElementById('radio').style.display = 'none';
       document.getElementById('credin').style.display = 'block';
       document.getElementById('compra_caja0').checked = true;
       
    }
     else{
        document.getElementById('radio').style.display = 'block';
        document.getElementById('credin').style.display = 'none';}
}


function buscar_por_fecha()
{
    // var base_url    = document.getElementById('base_url').value;
    //var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
   var tipotrans_id = document.getElementById('tipotrans_id').value;

   var fecha1 = "Desde: "+moment(fecha_desde).format('DD/MM/YYYY');
   var fecha2 = "Hasta: "+moment(fecha_hasta).format('DD/MM/YYYY');
   var tipotrans = $('select[name="tipo_transa"] option:selected').text();
   var tipo = "Tipo: "+tipotrans;
   
    if (tipotrans_id==0) {
         filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+"' ";
         $("#busquedaavanzada").html(fecha1+" "+fecha2);
    } else {
    filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+
            "' and c.tipotrans_id = "+tipotrans_id;
             $("#busquedaavanzada").html(fecha1+" "+fecha2+" "+tipo);
        }
    fechadecompra(filtro);

    
}

function buscar_reporte_fecha()
{
    // var base_url    = document.getElementById('base_url').value;
    //var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var tipotrans_id = document.getElementById('tipotrans_id').value;
    
    filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+
            "' and c.tipotrans_id = "+tipotrans_id;
    reportefechadecompra(filtro);

    
}

function buscar_reporte_proveedor()
{

    // var base_url    = document.getElementById('base_url').value;
    //var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var proveedor_id = document.getElementById('proveedor_id').value;
    
   if (fecha_desde =='' && fecha_hasta ==''){

    filtro =  " and p.proveedor_nombre = '"+proveedor_id+"' ";
    reportefechadecompra(filtro);
    }else{ 
    filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+
            "' and p.proveedor_nombre = '"+proveedor_id+"' ";
    reportefechadecompra(filtro);
}
}
function buscar_reporte_producto(producto_id)
{
    // var base_url    = document.getElementById('base_url').value;
    //var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    //var producto_id = document.getElementById('producto_id').value;
    
   if (fecha_desde =='' && fecha_hasta ==''){
        filtro =  " and dc.producto_id = "+producto_id+" ";
        reportefechadecompra(filtro);
    }else{
        filtro = " and date(compra_fecha) >= '"+fecha_desde+"'  and  date(compra_fecha) <='"+fecha_hasta+
                "' and dc.producto_id = "+producto_id+" ";
        reportefechadecompra(filtro);
    }
}

//Selecciona los datos del nit

//muestra la tabla de productos disponibles para la venta
  function convertDateFormat(string) {
        var info = string.split('-').reverse().join('/');
        return info;
   }

function compraproveedor(opcion)
{   
     
    var decimales = document.getElementById('decimales').value;
    var controlador = "";
    var parametro = "";
   
    var limite = 100;
    // var base_url = document.getElementById('base_url').value;
    
    if (opcion == 1){
        controlador = base_url+'compra/buscarprove/';
        parametro = document.getElementById('comprar').value; 
       
    }
    
    if (opcion == 2){
        controlador = base_url+'venta/buscarcategorias/';
        parametro = document.getElementById('categoria_prod').value;
    }
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                            
                
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#pillados").html("Registros Encontrados: "+n+" ");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                     for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["compra_totalfinal"]);
                        var total = Number(suma+total);
                        var caja = registros[i]["compra_caja"];
                        var bandera = 1;
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["proveedor_nombre"]+"</b></font><font size='1'>["+registros[i]["proveedor_id"]+"]</font><br>";
                        if (registros[i]["tipotrans_nombre"]=='CREDITO') {
                        html += "<span class='btn-facebook btn-xs'>"+registros[i]["tipotrans_nombre"]+"</span></br>";
                        } else {
                        html += "<span class='btn-info btn-xs'>"+registros[i]["tipotrans_nombre"]+"</span></br>";
                        }
                         
                        if (caja==1) {  
                        html += "<span class='btn-warning btn-xs'>Pago con Caja</span>";  } 
                        if (caja==2) {  
                        html += "<span class='btn-warning btn-xs'>Orden de pago</span>";  }
                        if (caja==0) {  
                        html += "<span class='btn-warning btn-xs'>Ninguno</span>";  }
                        html += "</td><td align='center'><font size='3'>"+registros[i]["compra_id"]+"</b></font></td>";                                          
                        html += "<td align='right' > Subtotal:"+numberFormat(Number(registros[i]["compra_subtotal"]).toFixed(decimales))+"<br>Desc: "+Number(registros[i]["compra_descuento"]).toFixed(decimales)+"<br> DescGlobal: "+Number(registros[i]["compra_descglobal"]).toFixed(decimales)+"<br>";
                        html += "<font size='3'><b>Total:"+numberFormat(Number(registros[i]["compra_totalfinal"]).toFixed(decimales))+"</b></font></td>";
                        html += "<td  align='center'>"+convertDateFormat(registros[i]["compra_fecha"])+"<br>"+registros[i]['compra_hora']+"</td>" ;
                        
                        html += "<td  align='center' style='background: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"<br>";
                        if (Number(registros[i]["compra_placamovil"])==1) {  
                        html += "<span class='btn-danger btn-xs'>NO FINALIZADO</span>";  }  
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td><td class='no-print'>";
                        if (Number(registros[i]["compra_placamovil"])==1) {
                        //html += "<a href='#' data-toggle='modal' data-target='#cambi"+registros[i]["compra_id"]+"' class='btn btn-info btn-xs' title='Modificar Compra'><i class='fa fa-pencil '></i></a>";
                        html += "<div class='modal fade' id='cambi"+registros[i]["compra_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
                        html += "<div class='modal-dialog' style='border: 1px;' role='document'>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        html += "<div class='form'><center><H4> Desea continuar con esta compra? </H4></center></div>";
                        html += "<div class='modal-footer'>";
                        html += "<a  href='"+base_url+"compra/edit/"+registros[i]["compra_id"]+"/1'  class='btn btn-md btn-success'><i class='fa fa-sign-out '></i> Si, continuar con la compra</a>";
                        html += " <a  href='"+base_url+"compra/borrarauxycopiar/"+registros[i]["compra_id"]+"'  class='btn btn-md btn-danger' ><i class='fa fa-sign-in '></i> No, borrar datos y rehacer la compra</a>";
                        html += "</div> </div></div></div></div>";
                        } else {
                        
                        }
                        
                        html += "<a href='"+base_url+"compra/nota/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-success btn-xs' title='Nota de Compra'><span class='fa fa-print'></span></a>";
                        html += "<a href='"+base_url+"compra/notaingreso/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-facebook btn-xs' title='Nota de Ingreso/utilidades'><span class='fa fa-print'></span></a>";


                        if (Number(registros[i]["elestado"])==1) {
                            html += "<a href='"+base_url+"compra/borrarauxycopiar/"+registros[i]["compra_id"]+"'  class='btn btn-info btn-xs' title='Modificar Compra'><span class='fa fa-pencil'></span></a>";
                            html +="<button data-toggle='modal'  class='btn btn-xs btn-github' title='Ver compras perdidas' onclick='cargar_datosbackup("+registros[i]["compra_id"]+")'> <i class='fa fa-paperclip'></i> </button>";
                            html += "<a href='#' data-toggle='modal' data-target='#anularmodal"+registros[i]["compra_id"]+"' class='btn btn-xs btn-warning' title='Anular Compra' ><i class='fa fa-minus-circle'></i></a>";
                        }
                        /*****modal anula compra ***/
                        html += "  <div class='modal fade' id='anularmodal"+registros[i]["compra_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";

                        html += "          <div class='modal-dialog' role='document'>";
                        html += "            <div class='modal-content'>";
                        html += "              <div class='modal-header'>";
                        html += "              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                        html += "                    <span aria-hidden='true'>&times;</span>";
                        html += "                </button>";
                        html += "                <h4><b> <em class='fa fa-minus-circle'></em> Desea anular la compra No.: "+registros[i]["compra_id"]+"?</b></h4> ";
                        html += "              </div>";
                        html += "              <div class='modal-body' align='center'>";

                                 
                        html += "                <h4>Esta compra puede tener una orden de Pago, tomar en cuenta. </h4></div>";
                                  
                        html += "              <div class='modal-footer' align='right'>";

                        html += "            <a href='"+base_url+"compra/anular/"+registros[i]["compra_id"]+"' class='btn btn-xs btn-warning'  type='submit'>";
                        html += "                <h5><span class='fa fa-check'></span>   Anular </h5>";
                        html += "            </a> ";
                        html += "            <button class='btn btn-xs btn-danger' data-dismiss='modal'>";
                        html += "                <h5><span class='fa fa-close'></span>   Cancelar </h5>";
                        html += "            </button>                   ";
                        html += "        </div>";
                        html += "            </div>";
                        html += "          </div>";
                        html += "        </div>";

                        //fin modaaaaaaaaaaaaaaaal//
                        html += "</td>";
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td align='right'><b>TOTAL</b></td>";
                        html += "<td align='right'><font size='4'><b>"+numberFormat(Number(total).toFixed(decimales))+"</b></font></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   
                   $("#fechadecompra").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadecompra").html(html);
        }
        
    });   

} 

function fechadecompra(filtro)
{   
      
//    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra/buscarfecha";
    var limite = 500000;

    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                            
                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    
                    var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    $("#pillados").html("Registros Encontrados: "+n+" ");
                   
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["compra_totalfinal"]);
                        var total = Number(suma+total);
                        var caja = registros[i]["compra_caja"];
                        var bandera = 1;
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["proveedor_nombre"]+"</b></font><font size='1'>["+registros[i]["proveedor_id"]+"]</font><br>";
                        
                        if (registros[i]["tipotrans_nombre"]=='CREDITO') {
                        html += "<span class='btn-facebook btn-xs'>"+registros[i]["tipotrans_nombre"]+"</span></br>";
                        } else {
                        html += "<span class='btn-info btn-xs'>"+registros[i]["tipotrans_nombre"]+"</span></br>";
                        }
                        if (caja==1) {  
                        html += "<span class='btn-warning btn-xs'>Pago con Caja</span>";  } 
                        if (caja==2) {  
                        html += "<span class='btn-warning btn-xs'>Orden de pago</span>";  }
                        if (caja==0) {  
                        html += "<span class='btn-warning btn-xs'>Ninguno</span>";  }
                        html += "</td><td align='center'><font size='3'><b>"+registros[i]["compra_id"]+"</b></font></td>";                                           
                        html += "<td align='right' > Subtotal:"+numberFormat(Number(registros[i]["compra_subtotal"]).toFixed(decimales))+"<br>Desc: "+Number(registros[i]["compra_descuento"]).toFixed(decimales)+"<br> DescGlobal: "+Number(registros[i]["compra_descglobal"]).toFixed(decimales)+"<br>";
                        html += "<font size='3'><b>Total:"+numberFormat(Number(registros[i]["compra_totalfinal"]).toFixed(decimales))+"</b></font></td>";
                        html += "<td style='text-align: center'>"+registros[i]['forma_nombre']+"</td>"
                        html += "<td style='text-align: center'>"+(registros[i]['banco_nombre'] == null ? '':registros[i]['banco_nombre'])+"</td>"
                        html += "<td  align='center'>"+convertDateFormat(registros[i]["compra_fecha"])+"<br>"+registros[i]['compra_hora']+"</td>" ;
                        
                        //alert(JSON.stringify(registros[i]));
                        if (registros[i]["elestado"]!=36){
                            html += "<td  align='center' style='background: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"<br>";
                        }
                        else{
                        
                          
                                  html += "<td  align='center' style='background: #"+registros[i]["estado_color"]+"'>";
                                    html += "<button type='button' id='boton_activarcompra' class='btn btn-xs btn-warning' data-toggle='modal' data-target='#modalactivarcompra' onclick='cargar_datos_pedido("+registros[i]['compra_id']+")'>";
                                        html += "<fa class='fa fa-clock-o'> </fa>";
                                        html += registros[i]['estado_descripcion'];
                                    html += "</button><br>";
                        
                        }
                        
                        if (Number(registros[i]["compra_placamovil"])==1) {  
                        html += "<span class='btn-danger btn-xs'>NO FINALIZADO</span>";  }  
                    
                        html += "</td>";
                    
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td><td class='no-print'>";
                        if (Number(registros[i]["compra_placamovil"])==1) {
                        //html += "<a href='#' data-toggle='modal' data-target='#cambi"+registros[i]["compra_id"]+"' class='btn btn-info btn-xs' title='Modificar Compra'><i class='fa fa-pencil '></i></a>";
                        html += "<div class='modal fade' id='cambi"+registros[i]["compra_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
                        html += "<div class='modal-dialog' style='border: 1px;' role='document'>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        html += "<div class='form'><center><H4> Desea continuar con esta compra? </H4></center></div>";
                        html += "<div class='modal-footer'>";
                        html += "<a  href='"+base_url+"compra/edit/"+registros[i]["compra_id"]+"/1'  class='btn btn-md btn-success'><i class='fa fa-sign-out '></i> Si, continuar con la compra</a>";
                        html += " <a  href='"+base_url+"compra/borrarauxycopiar/"+registros[i]["compra_id"]+"'  class='btn btn-md btn-danger' ><i class='fa fa-sign-in '></i> No, borrar datos y rehacer la compra</a>";
                        html += "</div> </div></div></div></div>";
                        } else {
                        
                        }
                        html += "<a href='"+base_url+"compra/nota/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-success btn-xs' title='Nota de Compra'><span class='fa fa-print'></span></a>";
                        html += "<a href='"+base_url+"compra/notaingreso/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-facebook btn-xs' title='Nota de ingreso/utilidades'><span class='fa fa-print'></span></a>";
                        if (Number(registros[i]["elestado"])==1) {
                        html += "<a href='"+base_url+"compra/borrarauxycopiar/"+registros[i]["compra_id"]+"'  class='btn btn-info btn-xs' title='Modificar Compra'><span class='fa fa-pencil'></span></a>";

                        html +="<button data-toggle='modal'  class='btn btn-xs btn-github' title='Ver compras perdidas' onclick='cargar_datosbackup("+registros[i]["compra_id"]+")'> <i class='fa fa-paperclip'></i> </button>";

                        html += "<a href='#' data-toggle='modal' data-target='#anularmodal"+registros[i]["compra_id"]+"' class='btn btn-xs btn-warning' title='Anular Compra' ><i class='fa fa-minus-circle'></i></a>";
                        /*****modal anula compra ***/
                        }
                        html += "  <div class='modal fade' id='anularmodal"+registros[i]["compra_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";

                        html += "          <div class='modal-dialog' role='document'>";
                        html += "            <div class='modal-content'>";
                        html += "              <div class='modal-header'>";
                        html += "              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                        html += "                    <span aria-hidden='true'>&times;</span>";
                        html += "                </button>";
                        html += "                <h4><b> <em class='fa fa-minus-circle'></em> Desea anular la compra No.: "+registros[i]["compra_id"]+"?</b></h4> ";
                        html += "              </div>";
                        html += "              <div class='modal-body' align='center'>";
                                       
                                 
                        html += "               <h4> Esta compra puede tener una orden de Pago, tomar en cuenta. </4></div>";
                                  
                        html += "              <div class='modal-footer' align='right'>";

                        html += "            <a href='"+base_url+"compra/anular/"+registros[i]["compra_id"]+"' class='btn btn-xs btn-warning' >";
                        html += "              <h5><span class='fa fa-check'></span>   Anular </h5>";
                        html += "            </a> ";
                        html += "            <button class='btn btn-xs btn-danger' data-dismiss='modal'>";
                        html += "                <h5><span class='fa fa-close'></span>   Cancelar </h5>";
                        html += "            </button>                   ";
                        html += "        </div>";
                        html += "            </div>";
                        html += "          </div>";
                        html += "        </div>";

                        //fin modaaaaaaaaaaaaaaaal//
                        html += "</td>";
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td align='right'><b>TOTAL</b></td>";
                        html += "<td align='right'><font size='4'><b>"+numberFormat(Number(total).toFixed(decimales))+"</b></font></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   
                   $("#fechadecompra").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadecompra").html(html);
        }
        
    });   

} 

function cambiarFecha()
{
    // var base_url = document.getElementById('base_url').value;
    var compra_id = document.getElementById('compra_id').value;
    var fecha = document.getElementById('fechac').value;
    var hora = document.getElementById('horac').value;
    var controlador = base_url+"compra/cambiarfecha";
   
     
    $.ajax({url: controlador,
           type:"POST",
           data:{compra_id:compra_id,fecha:fecha,hora:hora},
          
           success:function(resul){
            var registros =  JSON.parse(resul);
                
                html = "";   

                    html = registros[0]['compra_fecha'];
                     $("#fechacompra").html(html);
                
       },
            error:function(resul){
           html = "mal";
           $("#fechacompra").html(html);
          
} 
            });   

 

}
//Tabla resultados de la busqueda
function tablaresultados(opcion)
{   
    var decimales = document.getElementById('decimales').value;
    var controlador = "";
    var parametro = "";
    var compra_id = document.getElementById('compra_id').value;
    var limite = 100;
    // var base_url = document.getElementById('base_url').value;
    var bandera = document.getElementById('bandera').value;
    
    if (opcion == 1){
        controlador = base_url+'compra/buscarcompra/';
        parametro = document.getElementById('comprar').value    
       
    }
    
    if (opcion == 2){
        controlador = base_url+'venta/buscarcategorias/';
        parametro = document.getElementById('categoria_prod').value;
    }
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                            
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    var anchoinput = 50; // ancho de los campos en compras
                    
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                       
                        html += "<tr id='producto"+registros[i]["producto_id"]+"' style='display:'>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        //html += "<form action='"+base_url+"compra/ingresarproducto/'  method='POST' class='form'>";
                        html += "<div clas='row'>";                                            
                        html += "<div class='container' hidden>";
                        html += "<input id='compra_id'  name='compra_id' type='text' class='form-control' value='"+compra_id+"'>";
                        html += "<input id='producto_iddetalle'  name='producto_id' type='text' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "<input id='descripcion'  name='descripcion' type='text' class='form-control' value='"+registros[i]["producto_nombre"]+","+registros[i]["producto_marca"]+","+registros[i]["producto_industria"]+"'>";
                        html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+registros[i]["producto_costo"]+"'>";
                        html += "<input id='moneda_id"+registros[i]["producto_id"]+"'  name='moneda_id"+registros[i]["producto_id"]+"' type='text' class='form-control' value='"+registros[i]["moneda_id"]+"'>";
                        //html += "<input id='producto_codigue'  name='producto_codigo' type='hidden' class='form-control' value='"+registros[i]["producto_codigo"]+"'>";
                        //html += "<input id='producto_unidade'  name='producto_unidad' type='hidden' class='form-control' value='"+registros[i]["producto_unidad"]+"'>";
                        html += "</div>";
                            
                        html += "<div class='col-md-12' style='padding-left: 0px;'>";

                        html += "<b><font size='2'>"+registros[i]["producto_nombre"]+"</font> ("+registros[i]["producto_codigo"]+")</b>";
                        html += "<br><span class='btn btn-warning btn-xs' style='font-size:10px; face=arial narrow;'>SALDO: "+Number(registros[i]["existencia"]).toFixed(decimales)+"</span>";
//                        html += " <span class='btn btn-danger btn-xs' style='font-size:10px; face=arial narrow;' title='Historial de precios de compra'><i class='fa fa-book'></i> </span>";

                       
                        html += " <span data-toggle='modal' data-target='#modalhistorial' class='btn btn-xs btn-success' onclick='mostrar_historial("+registros[i].producto_id+")' style='font-size:10px; face=arial narrow;' title='Historial de precios de compra'>";
                        html += "<i class='fa fa-book'></i>";
                        html += "</span>";
                        
                        
                        html += "   <select class='btn btn-facebook btn-xs' style='font-size:10px; face=arial narrow; padding-top:2px; padding-buttom:3px;' id='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+registros[i]["existencia"]+","+registros[i]["producto_id"]+")'>";
                        html += "       <option value='1'>";
                        precio_unidad = registros[i]["producto_precio"];
                        html += "           "+registros[i]["producto_unidad"]+" "+registros[i]["moneda_descripcion"]+": "+Number(precio_unidad).toFixed(decimales)+"";
                        html += "       </option>";
                        
                        if(registros[i]["producto_factor"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                            html += "       <option value='"+registros[i]["producto_factor"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }
                            if(registros[i]["producto_factor1"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor1"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor1"]) * parseFloat(registros[i]["producto_factor1"]);

                            html += "       <option value='"+registros[i]["producto_factor1"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor1"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }

                            if(registros[i]["producto_factor2"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor2"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor2"]) * parseFloat(registros[i]["producto_factor2"]);

                            html += "       <option value='"+registros[i]["producto_factor2"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor2"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }

                        if(registros[i]["producto_factor3"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor3"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor3"]) * parseFloat(registros[i]["producto_factor3"]);

                            html += "       <option value='"+registros[i]["producto_factor3"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor3"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }

                        if(registros[i]["producto_factor4"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor4"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor4"]) * parseFloat(registros[i]["producto_factor4"]);

                            html += "       <option value='"+registros[i]["producto_factor4"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor4"]+" "+registros[i]["moneda_descripcion"]+": "+precio_factor.toFixed(decimales)+"/"+precio_factorcant.toFixed(decimales);
                            html += "       </option>";
                        }
                        
                        
                        
                        html += "   </select>";
                        
                        html += "   <br>";
                        if (esMobil()){
                            html += "<div align='right'>";

                            html += "<div class='col-md-2' style='padding-left: 0px;'>";
                            html += "Costo "+registros[i]["moneda_descripcion"]+": <input class='input-sm' id='producto_costodetalle"+registros[i]["producto_id"]+"'  style='width: 100px; background-color: lightgrey' autocomplete='off' name='producto_costo' type='number' step='0.01' class='form-control' value='"+Number(registros[i]["producto_ultimocosto"]).toFixed(decimales)+"' > </div>";
                            html += "<div class='col-md-2' style='padding-left: 0px;' >";
                            html += "Prec.Venta "+registros[i]["moneda_descripcion"]+": <input class='input-sm' id='producto_preciodetalle"+registros[i]["producto_id"]+"'  style='width: 100px; background-color: lightgrey' autocomplete='off' name='producto_precio' type='number' step='0.01' class='form-control' value='"+Number(registros[i]["producto_precio"]).toFixed(decimales)+"' ></div>";
                            html += "<div class='col-md-2' style='padding-left: 0px;' >";
                            html += "Desc.Unit. "+registros[i]["moneda_descripcion"]+": <input class='input-sm' id='descuentodetalle"+registros[i]["producto_id"]+"'  style='width: 100px; background-color: lightgrey' autocomplete='off'  name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";
                            html += "<div class='col-md-2'style='padding-left: 0px;'  >";
                            html += "Cantidad: <input class='input-sm ' id='cantidaddetalle"+registros[i]["producto_id"]+"' style='width: 100px;' name='cantidad' type='number' autocomplete='off' class='form-control' placeholder='cantidad' required value='1'> </div>";
                            html += "<div class='col-md-2' style='padding-left: 0px;' >";
                            html += "Fecha Venc.:<input class='input-sm ' type='date' id='detallecomp_fechavencimiento"+registros[i]["producto_id"]+"' style='width: 100px;padding-left: 0px;' name='detallecomp_fechavencimiento'  class='form-control' ></div>";
                            html += "<div class='col-md-2'style='padding-left: 0px;'  >";
                            html += "Lote: <input class='input-sm ' id='numerolote"+registros[i]["producto_id"]+"' style='width: 100px;' name='numerolote' type='text' autocomplete='off' class='form-control' placeholder='numerolote' > </div>";
                            html += "</div>";
                            
                        }
                        else{
                                              
                              html += "<table style='font-size: 10pt;' id='tablares' name='tablares'>";
                              html += "<tbody class='buscar33'>"
                                html += "<tr style='font-size: 10px; border-width:0px;'>";
                                  html += "<td style='text-align: center; border-width:0px;'><b>PRECIO</b></td>";
                                  html += "<td style='text-align: center; border-width:0px;'><b>COSTO</b></td>";
                                  html += "<td style='text-align: center; border-width:0px;'><b>DESC.</b></td>";
                                  html += "<td style='text-align: center; border-width:0px;'><b>CANT.</b></td>";
                                  html += "<td style='text-align: center; border-width:0px;'><b>FECHA VENC.</b></td>";
                                  html += "<td style='text-align: center; border-width:0px;'><b>LOTE</b></td>";

                                var estiloTD = "style='border-width:0px; font-size: 8px;'";
                                html += "</tr>";
                              
                              html += "<tr>";
                                html += "<td "+estiloTD+">";
                                      html += "<input style='width:"+anchoinput+"px;' id='producto_preciodetalle"+registros[i]["producto_id"]+"'   autocomplete='off' name='producto_precio' type='number' step='0.01'  value='"+Number(registros[i]["producto_precio"]).toFixed(decimales)+"' >";
                                html += "</td>";
                                
                                html += "<td "+estiloTD+">";
                                      html += "<input style='width:"+anchoinput+"px;' id='producto_costodetalle"+registros[i]["producto_id"]+"'   autocomplete='off' name='producto_costo' type='number' step='0.01'  value='"+Number(registros[i]["producto_ultimocosto"]).toFixed(decimales)+"' >";
                                html += "</td>";
                                
                                html += "<td "+estiloTD+">";
                                      html += "<input style='width:"+anchoinput+"px;' id='descuentodetalle"+registros[i]["producto_id"]+"' min='0' autocomplete='off' name='descuento' type='number'  value='0.00' step='.01' required >";
                                html += "</td>";
                                
                                html += "<td "+estiloTD+">";
                                      html += "<input style='width:"+anchoinput+"px;' id='cantidaddetalle"+registros[i]["producto_id"]+"'  name='cantidad' type='number' autocomplete='off' onkeypress='pasardetalle(event,"+compra_id+","+registros[i]["producto_id"]+")'  placeholder='cantidad' required value='1'>";
                                html += "</td>";
                                
                                html += "<td "+estiloTD+">";
                                      html += "<input style='width:"+(anchoinput+70)+"px; font-size: 12px;' type='date' id='detallecomp_fechavencimiento"+registros[i]["producto_id"]+"'  name='detallecomp_fechavencimiento'>";
                                html += "</td>";
                                
                                html += "<td "+estiloTD+">";
                                      html += "<input style='width:"+anchoinput+"px; font-size: 12px;' id='numerolote"+registros[i]["producto_id"]+"'   autocomplete='off' name='numerolote' type='text' step='0.01'  value='' >";
                                html += "</td>";

                              html += "</tr>";
                              html += "</tbody>";
                              
                            html += "</table>";
                            html += "<br>";                       

                       }
                        
                       
                       
                       if (esMobil()){
                            html += "<div class='col-md-2' style='padding-right: 0px;' >";
                            html += "<button type='button' onclick='detallecompra("+compra_id+","+registros[i]["producto_id"]+")' class='btn btn-success btn-block'><i class='fa fa-cart-arrow-down'></i> Añadir</button>";
                            html += "</div>";
                            
                       }
                       else{
                            html += "<td style='padding :0px'>";
                            html += "<div>";
                            html += "<center>";
                            html += "<br>";
                            html += "<label  class='control-label' style='margin-bottom :0px'></label><button type='button' onclick='detallecompra("+compra_id+","+registros[i]["producto_id"]+")' class='btn btn-success'><i class='fa fa-cart-arrow-down'></i></button>";
                            html += "</center>";   
                            html += "</div>";   
                            html += "</td>";
                        }
                       //html += "<a href=''  onclick='submit()' class='btn btn-danger'><span class='fa fa-cart-arrow-down'></span></a>";
                        
                       // html += "</div>";
                        html += "</div>";
                        html += "</div>";
                       // html += "</form>";
                        html += "</td>";
                      //  "echo form_close()";
                       
                        html += "</tr>";

                   }   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

} 

//tabla de reportes de producto 
function tablareproducto(opcion)
{   
    var controlador = "";
    var parametro = "";
    
    var limite = 100;
    // var base_url = document.getElementById('base_url').value;
   
    
    if (opcion == 1){
        controlador = base_url+'compra/buscarcompra/';
        parametro = document.getElementById('comprar').value    
       
    }
    
    if (opcion == 2){
        controlador = base_url+'venta/buscarcategorias/';
        parametro = document.getElementById('categoria_prod').value;
    }
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                            
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        
                        html += "<div clas='row'>";                                            
                        
                        html += "<b>"+registros[i]["producto_id"]+"</b>";
                        html += "<input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "</td>";
                        html += "</div>";   
                        html += "<div class='col-md-12'>";
                        html += "<td>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
                        
                        html += "<td>";

                        html += "<button type='button' onclick='buscar_reporte_producto("+registros[i]["producto_id"]+")' class='btn btn-primary'><i class='fa fa-search'></i></button>";
                        
                        
                        
                        html += "</div>";
                        html += "</div>";
                      
                        html += "</td>";
                      
                       
                        html += "</tr>";

                   }
                 
                   
                   $("#tablareproducto").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
        
    });    

} 
function reportefechadecompra(filtro)
{
//    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra/buscarrepofecha";
    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro},
            success:function(report){
                $("#enco").val("- 0 -");
                var registros =  JSON.parse(report);
                if(registros != null){
                    var cant = Number(0);
                    var total = Number(0);
                    //var total_detalle = 0;
                    //var nombre_moneda = document.getElementById('nombre_moneda').value;
                    var lamoneda_id = document.getElementById('lamoneda_id').value;
                    //var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#pillados").val("- "+n+" ");
                   
                    html = "";
                    for (var i = 0; i < n ; i++){
                        cant += Number(registros[i]["detallecomp_cantidad"]);
                        var suma = Number(registros[i]["detallecomp_total"]);
                        var total = Number(suma+total);
                        //var bandera = 1;
                        html += "<tr>";
                      
                        html += "<td align='center'>"+(i+1)+"</td>";
                        
                        
                        html += "<td> "+registros[i]["producto_nombre"]+" </td>";                                            
                        html += "<td align='center'> "+registros[i]["producto_codigo"]+" </td>";
                        html += "<td align='center'> "+registros[i]["compra_id"]+" </td>";  
                         html += "<td align='center'> "+registros[i]["tipotrans_nombre"]+" </td>";  
                        html += "<td align='center'> "+registros[i]["producto_unidad"]+" </td>";                                                                                    
                        html += "<td align='center'>"+convertDateFormat(registros[i]["compra_fecha"])+" "+registros[i]['compra_hora']+"</td>" ;                                          
                        html += "<td align='right'> "+Number(registros[i]["detallecomp_cantidad"]).toFixed(decimales)+" </td>"; 
                        html += "<td align='right'> "+Number(registros[i]["detallecomp_costo"]).toFixed(decimales)+" </td>"; 
                        html += "<td align='right'><b>"+numberFormat(Number(registros[i]["detallecomp_total"]).toFixed(decimales))+"</b></td>";
                        html += "<td class='text-right'> ";
                        if(lamoneda_id == 1){
                            total_otram = Number(registros[i]["detallecomp_total"])/Number(registros[i]["detallecomp_tc"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = Number(registros[i]["detallecomp_total"])*Number(registros[i]["detallecomp_tc"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                        
                        html += "<td  align='center'>"+registros[i]["usuario_nombre"]+"</td>"; 
                       // html += "<td><a href='"+base_url+"compra/pdf/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'> </a>";
                       // html += "<form action='"+base_url+"compra/edit/"+registros[i]["compra_id"]+"/"+bandera+"/'  method='POST' class='form'>";
                       // html += "<input type='hidden' id='bandera' name='bandera' value='1'>";
                       // html += "<button class='btn btn-info btn-xs' type='submit'><span class='fa fa-pencil'> </button>";
                      //  html += "</form></td>";
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<th style='text-align: right'><b>TOTAL:</b></td>";
                        html += "<th style='text-align: right'><b>"+numberFormat(Number(cant).toFixed(decimales))+"</b></th>";
                        html += "<td></td>";
                        html += "<th style='text-align: right'><b>"+numberFormat(Number(total).toFixed(decimales))+"</b></th>";
                        html += "<th style='text-align: right'><b>"+numberFormat(Number(total_otramoneda).toFixed(decimales))+"</b></th>";
                        html += "<td></td>";
                       
                        html += "</tr>";
                   
                   $("#reportefechadecompra").html(html);
                   
            }
                
        },
        error:function(result){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#reportefechadecompra").html(html);
        }
        
    });   

} 

function select_unidad(){
               var unidad    = document.getElementById('producto_unidad').value;
               html2 = "";  
               html2 += "<label for='unidad_compra' class='control-label'>Unidad Compra</label>";
               html2 += "<div class='form-group'>";   
               html2 += "<select name='unidad_compra' class='form-control' id='unidad_compra' >";
               html2 += "<option value='1'>"+unidad+"</option>";
               html2 += "</select></div>";
                   
               $("#select_unidad").html(html2);
}

function unidad_factor(){
               var unidad    = document.getElementById('producto_unidad').value;
               var unidad_factor    = document.getElementById('producto_unidadfactor').value;
               var factor    = document.getElementById('producto_factor').value;
               var precio_factor    = document.getElementById('producto_preciofactor').value;
               if (unidad_factor=='' || factor=='' || precio_factor=='') {
                alert('Debe llenar los datos de factor');
               
               }else{
                html2 = "";  
               html2 += "<label for='unidad_compra' class='control-label'>Unidad Compra</label>";
               html2 += "<div class='form-group'>";   
               html2 += "<select name='unidad_compra' class='form-control' id='unidad_compra' >";
               html2 += "<option value='1'>"+unidad+"</option>";
               html2 += "<option value='"+factor+"'>"+unidad_factor+"</option>";
               html2 += "</select></div>";
                   
               $("#select_unidad").html(html2);
               }
               
}

function esMobil(){
    
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };    

    return isMobile.any();
    
}


function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function mostrar_historial(producto_id){
    // var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"compra/historial_compras";
    
    html = "";
    
    $.ajax({url:controlador,
           type:"POST",
           data:{producto_id,producto_id},
           success:function(resultado){
               
               var reg = JSON.parse(resultado);
               var tam = reg.length;
               
               //alert(reg.length);
                html = "";               
                html += "<table class='table' id='mitabla'>";
                html += "<tr>";
                html += "<th>#</th>";
                html += "<th>Proveedor</th>";
                html += "<th>Costo</th>";
                html += "<th>Transación</th>";
                html += "<th>Banco</th>";
                html += "<th>Fecha</th>";
                html += "</tr>";
                
               if (tam>0){
                   for(i=0;i<tam;i++){
                     
                    html += "<tr>";
                     html += "<td>"+(i+1)+"</td>";
                     html += "<td>"+reg[i].proveedor_nombre+"</td>";
                     html += "<td><b>"+Number(reg[i].detallecomp_costo).toFixed(decimales)+"</b></td>";
                     html += "<td style='text-center'>"+reg[i].forma_nombre+"</td>"
                     html += "<td style='text-center'>"+reg[i].banco_nombre+"</td>"
                     html += "<td>"+formato_fecha(reg[i].compra_fecha)+"</td>";
                    html += "</tr>";
                       
                   }
               }
                html += "</table>";
                $("#tabla_historial").html(html);
               
           },
    });
    
}

function ocultar_busqueda(){
    var html = "";
    
    $("#tablaresultados").html("");
}

function mostrar(forma_id,glosa_banco){
    
    let forma = $(`#${forma_id}`).val();
    $(`#${glosa_banco}`).css('display',forma != 1 ? 'block':'none');

}

function cargar_datos_pedido(compra_id){

    //alert(compra_id);
    $("#compra_idx").val(compra_id);
    
}

function confirmar_traspaso(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'compra/confirmar_traspaso/';
    var compra_id = document.getElementById('compra_idx').value;
    
    $.ajax({url: controlador,
            type:"POST",
            data:{compra_id:compra_id},
            success:function(respuesta){
                
                alert("Traspaso realizado con exito..!!");
                location.reload();
                //cambiarproveedores(compra_id,proveedor_id);
            }        
    });
    
} 

function actualizar_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_inventario/";
    
    document.getElementById('oculto').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El inventario se actualizó exitosamente...! ');
            //redirect('inventario/index');
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            //tabla_inventario();
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
    });   
      
}

function restablecer_backup(bitacora_codigo, compra_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"compra/restablecer_backup/";
    
    
    var r = confirm("ADVERTENCIA: Esta operación afectara de forma permanente a la compra seleccionada. \n ¿Desea Continuar?");
    
    
    if (r == true) {
    
            $.ajax({url: controlador,
                type:"POST",
                data:{bitacora_codigo:bitacora_codigo, compra_id:compra_id},
                success:function(respuesta){    

                    res = JSON.parse(respuesta);

                    alert(JSON.stringify(res));

                    cargar_datosbackup(compra_id);
                    //redirect('inventario/index');
                    //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
                    //tabla_inventario();

                },
                complete: function (jqXHR, textStatus) {
                    //document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader 
                    //tabla_inventario();
                }
            });   

    }
}

function cargar_datosbackup(compra_id){
   
    document.getElementById("micompra_id").value = compra_id;   
    //alert("llega hasta aqui");
    
    var base_url = document.getElementById('base_url').value;
    var decimales = document.getElementById('decimales').value;
    var controlador = base_url+"compra/verificar_detalle/";
    
   // document.getElementById('oculto').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
        type:"POST",
        data:{compra_id:compra_id},
        success:function(respuesta){     
            
            var resultado = JSON.parse(respuesta);
            var tam1 = resultado["detalle_compra"].length;
            var res1 = resultado["detalle_compra"];
                    
            
            //alert(resultado["detalle_compra"].length);
            
            
            var estilo =  "style='padding: 3px;'";
            var html = "";
            
            html += "<table id='mitabla'>";
            html += "<tr>";
            
                html += "<th "+estilo+">#</th>";
                html += "<th "+estilo+">PRODUCTO</th>";
                html += "<th "+estilo+">CODIGO</th>";
                html += "<th "+estilo+">CANT.</th>";
                html += "<th "+estilo+">COSTO</th>";
                html += "<th "+estilo+">TOTAL</th>";

            html += "</tr>";            
            
            for(var i = 0; i < res1.length; i++){
               
                html += "<tr>";

                    html += "<td "+estilo+">"+(i+1)+"</td>";
                    html += "<td "+estilo+">"+res1[i]["producto_nombre"]+"</td>";
                    html += "<td "+estilo+">"+res1[i]["producto_codigobarra"]+"</td>";
                    html += "<td "+estilo+">"+Number(res1[i]["detallecomp_cantidad"]).toFixed(decimales)+"</td>";
                    html += "<td "+estilo+">"+Number(res1[i]["detallecomp_costo"]).toFixed(decimales)+"</td>";
                    html += "<td "+estilo+">"+Number(res1[i]["detallecomp_total"]).toFixed(decimales)+"</td>";

                html += "</tr>";
               
            }              

            html += "</table>";
            
            $("#items_registrados").html(html);
            
            
            var res2 = resultado["detalle_compra_bitacora"];
            html = "";
            html += "<table id='mitabla'>";
            html += "<tr>";
            
                html += "<th "+estilo+">#</th>";
                html += "<th "+estilo+">FECHA</th>";
                html += "<th "+estilo+">CODIGO</th>";
                html += "<th "+estilo+">ITEMS</th>";
                html += "<th "+estilo+"></th>";
//                html += "<th "+estilo+">COSTO</th>";
//                html += "<th "+estilo+">TOTAL</th>";
//                html += "<th "+estilo+">CODIGO</th>";

            html += "</tr>";            
            
            for(var i = 0; i < res2.length; i++){
               
                html += "<tr>";

                    html += "<td "+estilo+">"+(i+1)+"</td>";
                    html += "<td "+estilo+">"+res2[i]["fecha_bitacora"]+"</td>";
                    html += "<td "+estilo+">"+res2[i]["codigo_bitacora"]+"</td>";
                    html += "<td "+estilo+">"+Number(res2[i]["items"]).toFixed(decimales)+"</td>";
                    html += "<td "+estilo+">";
                        html += "<button class='btn btn-xs btn-info' onclick='restablecer_backup("+JSON.stringify(res2[i]["codigo_bitacora"])+","+res2[i]["compra_id"]+")'><fa class='fa fa-chain'></fa>Restablecer</button>";
                    
                    html += "</td>";
                    
//                    html += "<td "+estilo+">"+Number(res2[i]["detallecomp_costo"]).toFixed(decimales)+"</td>";
//                    html += "<td "+estilo+">"+Number(res2[i]["detallecomp_total"]).toFixed(decimales)+"</td>";
//                    html += "<td "+estilo+">"+res2[i]["codigo_bitacora"]+"</td>";

                html += "</tr>";
               
            }              

            html += "</table>";
            
            $("#tabla_respaldos").html(html);
            
            
            
            
            //$("#tabla_respaldos").html(html);
            
            
            //redirect('inventario/index');
      //      document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            //tabla_inventario();
            
            
        },
        complete: function (jqXHR, textStatus) {
           // document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();

        }
    });   
    
    $("#boton_modalbackup").click();
    
    
    
}