$(document).on("ready",inicio);
function inicio(){
    ultimopedido();
}

/* muestra el ultimo pedido cargado en detalle_ordencompra_aux */
function ultimopedido(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"orden_compra/ultimopedido";
    var html = "";
    $("#modalproveedor").modal("hide");
    //alert(producto_id);
    $.ajax({url:controlador,
            type:"POST",
            data:{},
            success:function(resultado){
                var registros = JSON.parse(resultado);
                var tam = registros.length;
                //alert(reg.length);
                html = "";
                html += "<table class='table' id='mitabla'>";
                html += "<tr>";
                html += "<th>#</th>";
                html += "<th>Producto/ Unidad</th>";
                html += "<th>Codigo</th>";
                html += "<th>Costo</th>";
                html += "<th>Precio Venta</th>";
                html += "<th>Exist.</th>";
                html += "<th>Cant.</th>";
                html += "<th>Total</th>";
                html += "<th></th>";
                html += "</tr>";
                if(tam>0){
                    let total = Number(0);
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
                    for(var i=0; i<tam;i++){
                        total += Number(registros[i]["detalleordencomp_total"]);
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td style='font-size:10px; width:140px;'><b>"+registros[i]["producto_nombre"]+" / </b>";
                        html += "<b>"+registros[i]["detalleordencomp_unidad"];
                        html += "</td>";
                        html += "<td style='font-size:12px; text-align:center;'>"+registros[i]["detalleordencomp_codigo"]+"<br><font size='1'>";
                        if (registros[i]["detalleordencomp_fechavencimiento"]!='0000-00-00'&&registros[i]["detalleordencomp_fechavencimiento"]!=null) {
                            html += "Venc:"+moment(registros[i]["detalleordencomp_fechavencimiento"]).format('DD/MM/YYYY')+"</font>";
                        }
                        html += "</td>";
                        html += "<td><input  class='input-sm' style='font-size:13px; width:100%;padding-left:0px; padding-right:0px;' id='detallecomp_costo"+registros[i]["detalleordencomp_id"]+"'  name='producto_costo"+registros[i]["producto_id"]+"' type='text' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detalleordencomp_id"]+","+registros[i]["producto_id"]+","+registros[i]["compra_id"]+")' class='form-control' value='"+Number(registros[i]["detalleordencomp_costo"]).toFixed(2)+"' ></td>";
                        html += "<td>";
                        //html += "<input id='producto_identi'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>" ;
                        html += "<input class='input-sm' style='font-size:13px; width:100%; padding-left:0px; padding-right:0px;' id='detallecomp_precio"+registros[i]["detalleordencomp_id"]+"'  name='producto_precio"+registros[i]["producto_id"]+"' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detalleordencomp_id"]+","+registros[i]["producto_id"]+","+registros[i]["compra_id"]+")'  class='form-control'  value='"+Number(registros[i]["detalleordencomp_precio"]).toFixed(2)+"'  ></td>"; 
                        html += "<td>"+registros[i]["existencia"]+"</td>",
                        html += "<td style='padding-left:0px; padding-right:0px;'><input  class='input-sm' style='font-size:13px;width:65px;' id='detallecomp_cantidad"+registros[i]["detalleordencomp_id"]+"'  name='cantidad' type='text' autocomplete='off' class='form-control' value='"+registros[i]["detalleordencomp_cantidad"]+"' type='text' onkeypress='actualizadetalle(event,"+registros[i]["detalleordencomp_id"]+","+registros[i]["producto_id"]+","+registros[i]["compra_id"]+")' >";
                        html += "<input id='detallecomp_id'  name='detallecomp_id' type='hidden' class='form-control' value='"+registros[i]["detalleordencomp_id"]+"'>";
                        html += "<td><center>";
                        html += "<span class='badge badge-success'>";
                        html += "<font size='2'> <b>"+Number(registros[i]["detalleordencomp_total"]).toFixed(2)+"</b></font> <br>";
                        html += "</span>";
                        
                        /*html += "<br><span class='text-bold' style='white-space: nowrap; font-size: 9px'>";
                        html += mon_secundaria+" "+Number(total_otram).toFixed(2)+"</span>";*/
                        html += "</center></td>";
                        html += "<td style='padding-left:4px; padding-right:4px;'>";
                        
                        html += "<button type='button' onclick='editadetalle("+registros[i]["detalleordencomp_id"]+","+registros[i]["producto_id"]+","+registros[i]["compra_id"]+")' class='btn btn-success btn-xs'><span class='fa fa-save'></span></button>";
                        html += "<button type='button' onclick='quitardetalle("+registros[i]["detalleordencomp_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></button>";
                        html += "</td>";
                        html += "<tr>";
                    }
                    html += "<tr class='text-bold' style='font-size:13px;'>";
                    html += "<td class='text-right' colspan='7'>TOTAL</td>";
                    html += "<td class='text-right'>"+numberFormat(Number(total).toFixed(2))+"</td>";
                    html += "<td></td>";
                    html += "</tr>";
                }
               
                html += "</table>";
                $("#tabla_ultimopedido").html(html);
                //$('#modalultimopedido').modal({backdrop: 'static', keyboard: false})
                $("#modalultimopedido").modal("show");
               
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_ultimopedido").html(html);
        },
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
    
    
    
    
    
    

































/*
 * Funcion que buscara productos en la tabla productos
 */
function buscarproducto(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
        tablaresultadosproducto(2);
    }
}

function imprimir_producto(){
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

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}






function formato_numerico(numero){
            nStr = Number(numero).toFixed(2);
        nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
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
            alert('El inventario se actualizo exitosamente...! ');
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