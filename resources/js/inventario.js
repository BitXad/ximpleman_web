/* 
 *  Realizado por: Roberto Carlos Soto S.
 *  Fecha: 15/01/2019
 */
//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
$(document).on("ready",inicio);
function inicio(){
      //  tabla_inventario();
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

function fecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);
 
       // return dd+'/'+mm+'/'+yyyy;
        return yyyy+'-'+mm+'-'+dd;
}


function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function formato_numerico(numero){
    var decimales = 2;
        
    
        nStr = Number(numero).toFixed(decimales);
        nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
        
	
	return x1 + x2;
    
//    var partdecimal = "";
//    var numero = "";
//    var num = numer.toString();
//    var signonegativo = "";
//    var resultado = "";
//    
//    /*quitamos el signo al numero, si es que lo tubiera*/
//    if(num[0]=="-"){
//        signonegativo="-";
//        numero = num.substring(1, num.length);
//    }else{
//        numero = num;
//    }
//    /*guardamos la parte decimal*/
//    if(num.indexOf(".")>=0){
//        partdecimal = num.substring(num.indexOf("."), num.length);
//        numero = numero.substring(0,num.indexOf(".")-1);
//    }else{
//        numero = num;
//    }
//    for (var j, i = numero.length - 1, j = 0; i >= 0; i--, j++){
//        resultado = numero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;
//    }
// 
//    resultado = signonegativo+resultado+partdecimal;
//    return resultado;

    //  return  Intl.NumberFormat("en-IN").format(numero)
}


function validar(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 

        if (opcion == 1){   //Si la accecion proviene de la casilla de parametro de busqueda de inventario
            tabla_inventario();      
            
        }

        if (opcion == 2){   //Si la accecion proviene de la casilla de parametro de busqueda de inventario
            tabla_inventario_sucursal();      
            
        }
        
    } 
 
}

function tabla_inventario(){

    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById("base_url").value;
    var parametro = document.getElementById("filtrar").value;
    var controlador = base_url+"inventario/mostrar_inventario";
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    var total_otramoneda = Number(0);
    var total_otram = Number(0);
    var tipo_reporte = document.getElementById('tipo_reporte').value;;
    
    var select_almacen = document.getElementById("select_almacen").value;
    //select_almacen = select_almacenes.options[select_almacenes.selectedIndex].innerText;
    
    //select_almacen = select_almacenes.options[select_almacenes.selectedIndex].value;
    
    let parasucursal = document.getElementById('parasucursal').value;
    
//    if(parasucursal == 1){
//        alert(tipo_reporte+" * "+select_almacen);
//    }
        
    if (tipo_reporte == 1){
        
        $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro, select_almacen:select_almacen},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla'>";
                    html += "<tr>";
                    html += "	<th>#</th>";
                    html += "	<th>Imagen</th>";
                    html += "	<th>Descripción</th>";
                    html += "	<th>Código</th>";
                    html += "	<th>Costo</th>";
                    html += "	<th>Compras</th>";
                    html += "	<th>Ventas</th>";
                    html += "	<th>Pedidos</th>";
                    html += "	<th>Existencia</th>";
                    html += "	<th>Total</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    
                                total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                total_final += total;
                                existencia = parseFloat(inv[i]["existencia"]);

                    html += "             	<td>"+(i+1)+"</td>";
                    html += "             	<td><img src='"+ base_url+"resources/images/productos/thumb_"+inv[i]["producto_foto"]+"' width='50' height='50' class='img-circle'</td>";
                    html += "             	<td><font size='3'><b>"+ inv[i]["producto_nombre"]+"</b></font> <sub>";
                    
                    html += "             	<a href='"+base_url+"producto/edit2/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'>["+inv[i]["producto_id"]+"] </a></sub>";
                    html += "    <br>";
                    html += "    <small>" + inv[i]["producto_unidad"]+" | "+inv[i]["producto_marca"]+" | "+inv[i]["producto_industria"];
                    
                    html += "   <span class='badge span-alert no-print'> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'> Kardex</a> </span></small>";
                    
                    //html += "     <button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal"+inv[i]["producto_id"]+"'>Kardex</button>";
                    
                    html += "             	</td>";
                    html += "             	<td><center><font size='2'><b>"+inv[i]["producto_codigobarra"]+"</b><br> </font>";
                    html += "	"+ inv[i]["producto_codigo"]+"</center></td>";
                    html += "	<td><center>"+ Number(inv[i]["producto_costo"]).toFixed(decimales)+"</center></td>";

                    html += "             	<td><center>"+ Number(inv[i]["compras"]).toFixed(decimales)+"</center></td>";
                    html += "	<td><center>"+ Number(inv[i]["ventas"]).toFixed(decimales)+"</center></td>";
                    html += "	<td><center>"+ Number(inv[i]["pedidos"]).toFixed(decimales)+"</center></td>";
                    
                    html += "             	<td><center> <font size='3'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
                    html += "             	<td><center> <font size='2'><b>"+ total.toFixed(decimales)+"</b></font></center></td>";
                    

                    html += "</tr>";
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th></th>";
                html += "	<th></th>";
                html += "	<th>"+formato_numerico(total_final)+"</th>";

                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html);
                              
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    }
    
    
   //*********************** tipo_reporte 2 ************************************** 
    if (tipo_reporte == 2){
        
        //alert("parametro:"+parametro+"* almacen: "+select_almacen);
    $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro, select_almacen:select_almacen},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);
            
             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla' >";
                    html += "<tr>";
                    html += "	<th>#</th>";
//                    html += "	<th>Imagen</th>";
                    html += "	<th>Descripción</th>";
                    html += "	<th>Código</th>";
                    html += "	<th>Categoría</th>";                    
                    html += "	<th>Unidad</th>";
                    html += "	<th>Costo ("+nombre_moneda+")</th>";
//                    html += "	<th>Compras</th>";
//                    html += "	<th>Ventas</th>";
//                    html += "	<th>Pedidos</th>";
                    html += "	<th>Saldo</th>";
                    html += "	<th>Total ("+nombre_moneda+")</th>";
                    
                    try{
                    
                    html += "	<th>Total (";
                                            if(lamoneda_id == 1){
                                                html += lamoneda[1]['moneda_descripcion'];
                                            }else{
                                                html += lamoneda[0]['moneda_descripcion'];
                                            }
                                            
                                            
                    html += ")</th>";
                    
                    } catch (error) {
                    
                        console.error(error);
                        alert("ADVERTENCIA: No existen monedas registradas/activas...!");
                    }
                    
                    html += "	<th colspan='6'>Saldos/Presentaciones</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                    var margen = " style='padding:0; text-align: right;'";
                    var categoria = "";
                    
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    if (categoria != inv[i]["categoria_nombre"]){                        
                        html += "<tr><td colspan='14'><b>"+inv[i]["categoria_nombre"]+"<b></tr>";
                    }   

                        html += `<tr style='padding:0;${inv[i]["existencia"] <= 0 ? "background-color: #FF8989":""}'>`;

                                    total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                    total_final += total;
                                    existencia = parseFloat(inv[i]["existencia"]);                                                    
                        html += "             	<td "+margen+"><a style='margin-right: 10px;'>"+(i+1)+"</a></td>";
                        html += "             	<td  style='padding:0; text-align: left;'><font size='0.5'>"+ inv[i]["producto_nombre"]+"</font>";
                        html += "             	<td "+margen+" style='background: red'><center><font size='1'>"+inv[i]["producto_codigo"]+"</font> </center></td>";
                        html += "             	<td "+margen+"><font size='0.5'><center>"+ inv[i]["categoria_nombre"]+"</center></font> </td>";
                        html += "             	<td "+margen+"><font size='0.5'><center>"+ inv[i]["producto_unidad"]+"</center></font> </td>";

                        html += "	<td "+margen+"><b style='margin-right: 10px;'>"+ Number(inv[i]["producto_costo"]).toFixed(decimales)+"</b></td>";
                        html += "             	<td "+margen+"><font size='1'><b style='margin-right: 10px;'>"+ existencia.toFixed(decimales)+"</b></font></td>";
                        html += "             	<td "+margen+"><font size='1'><b style='margin-right: 10px;'>"+ numberFormat(total.toFixed(decimales))+"</b></font></td>";
                        html += "<td "+margen+"> <b style='margin-right: 10px;'>";
                        if(lamoneda_id == 1){
                            total_otram = total/Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = total*Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</d></td>";

                        factor = 0;
                        producto_factor = 0;
                        unidadfactor = "";

                        if (inv[i]["producto_factor"]>0){

                            producto_factor = inv[i]["producto_factor"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor"]);
                            unidadfactor =  inv[i]["producto_unidadfactor"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor"]);
                            html += "             	<td "+margen+" ><center style='line-height:80%'> <sub> "+ factor +" "+unidadfactor+" ["+Number(producto_factor).toFixed(decimales)+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+" </sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor1"]>0){

                            producto_factor = inv[i]["producto_factor1"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor1"]);
                            unidadfactor =  inv[i]["producto_unidadfactor1"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor1"]);
                            html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+Number(producto_factor).toFixed(decimales)+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor2"]>0){

                            producto_factor = inv[i]["producto_factor2"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor2"]);
                            unidadfactor =  inv[i]["producto_unidadfactor2"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor2"]);
                            html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+Number(producto_factor).toFixed(decimales)+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor3"]>0){

                            producto_factor = inv[i]["producto_factor3"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor3"]);
                            unidadfactor =  inv[i]["producto_unidadfactor3"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor3"]);
                            html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+Number(producto_factor).toFixed(decimales)+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


                        if (inv[i]["producto_factor4"]>0){

                            producto_factor = inv[i]["producto_factor4"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor4"]);
                            unidadfactor =  inv[i]["producto_unidadfactor4"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor4"]);
                            html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+Number(producto_factor).toFixed(decimales)+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


    //                    html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ existencia +"<br>"+inv[i]["producto_unidad"]+"</sub></center></td>";

                        html += "<td> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='btn btn-warning btn-xs no-print'><fa class='fa fa-list'> </fa> Kardex</a></small> </td>";
                        //html += "<td><a href='"+base_url++"'>kardex</a></td>";
                        html += "</tr>";
                   
                 
                     

                   categoria = inv[i]["categoria_nombre"];     
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
//                html += "	<th> </th>";
//                html += "	<th></th>";
//                html += "	<th></th>";
                html += "	<th>"+formato_numerico(total_final)+"</th>";
                html += "	<th>"+formato_numerico(total_otramoneda)+"</th>";
                html += "	<th></th>";
                html += "	<th></th>";
                html += "	<th></th>";
                html += "	<th></th>";
                html += "	<th></th>";
                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html);   
                             
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    }
    
    
          
    //  document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader         
    
}

function tabla_inventario_sucursal(){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById("base_url").value;
    var parametro = document.getElementById("filtrar").value;
    var controlador = base_url+"inventario/mostrar_inventario";
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
        $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla'>";
                    html += "<tr>";
                    html += "	<th>#</th>";
//                    html += "	<th>Imagen</th>";
                    html += "	<th>Descripción</th>";
//                    html += "	<th>Código</th>";
                    html += "	<th>Costo</th>";
                    html += "	<th></th>";
//                    html += "	<th>Compras</th>";
//                    html += "	<th>Ventas</th>";
//                    html += "	<th>Pedidos</th>";
//                    html += "	<th>Existencia</th>";
//                    html += "	<th>Total</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    
                                total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                total_final += total;
                                existencia = parseFloat(inv[i]["existencia"]);
                                
                    html += "             	<td>"+(i+1)+"</td>";
//                    html += "             	<td><img src='"+ base_url+"resources/images/productos/thumb_"+inv[i]["producto_foto"]+"' width='50' height='50' class='img-circle'</td>";
                    html += "             	<td><font size='1'><b>"+ inv[i]["producto_nombre"]+"</b></font> <sub>";
                    
                    html += "             	<a href='"+base_url+"producto/edit2/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'>["+inv[i]["producto_id"]+"] </a></sub>";
                    html += "    <br>";
                    html += "    <small>" + inv[i]["producto_unidad"]+" | "+inv[i]["producto_marca"]+" | "+inv[i]["producto_industria"] + " | "+inv[i]["producto_codigo"];
                    
//                    html += "   <span class='badge span-alert no-print'> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'> Kardex</a> </span></small>";
                    
                    //html += "     <button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal"+inv[i]["producto_id"]+"'>Kardex</button>";
                    
                    html += "             	</td>";
//                    html += "             	<td><center><font size='2'><b>"+inv[i]["producto_codigobarra"]+"</b><br> </font>";
//                    html += "	"+ inv[i]["producto_codigo"]+"</center></td>";
                    costounit = inv[i]["producto_costo"];
                    html += "	<td>COSTO: "+ Number(costounit).toFixed(decimales);
                    html += "	<br>SALDO: <font size='3'><b>"+ existencia.toFixed(decimales)+"</b></font>";
                    html += "	<br>TOTAL: <font size='1'><b>"+ existencia.toFixed(decimales)+"</b></font>";
                    html += "	</td>";
                    html += "	<td><button class='btn btn-info btn-sm' onclick='seleccionar_producto("+JSON.stringify(inv[i]["producto_codigobarra"])+")'><fa class='fa fa-list'></fa> <br>Seleccionar</button></td>";

//                    html += "             	<td><center>"+ inv[i]["compras"]+"</center></td>";
//                    html += "	<td><center>"+ inv[i]["ventas"]+"</center></td>";
////                    html += "	<td><center>"+ inv[i]["pedidos"]+"</center></td>";
//                    
//                    html += "             	<td><center> <font size='3'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
//                    html += "             	<td><center> <font size='1'><b>"+ total.toFixed(decimales)+"</b></font></center></td>";
                    

                    html += "</tr>";
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "	<th> </th>";
                html += "	<th> </th>";
//                html += "	<th> </th>";
//                html += "	<th> </th>";
//                html += "	<th> </th>";
//                html += "	<th> </th>";
//                html += "	<th> </th>";
                html += "	<th></th>";
                html += "	<th></th>";
                html += "	<th>"+formato_numerico(total_final)+"</th>";
                html += "	<th></th>";

                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html);
                              
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    
    
     
    
}

function seleccionar_producto(producto_codigo){
    
    $("#producto_codigo").val(producto_codigo);
    $("#boton_buscarproducto").click();
    
}


function tabla_inventario_existencia(){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById("base_url").value;
    var parametro = document.getElementById("filtrar").value;
    var controlador = base_url+"inventario/mostrar_inventario_existencia";
    var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    var decimales = document.getElementById('decimales').value;
    var total_otramoneda = Number(0);
    var total_otram = Number(0);
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    var tipo_reporte = 2;


    if (tipo_reporte == 1){
        $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla'>";
                    html += "<tr>";
                    html += "    <th>#</th>";
                    html += "    <th>Imagen</th>";
                    html += "    <th>Descripción</th>";
                    html += "    <th>Código</th>";
                    html += "    <th>Costo</th>";
                    html += "    <th>Compras</th>";
                    html += "    <th>Ventas</th>";
                    html += "    <th>Pedidos</th>";
                    html += "    <th>Existencia</th>";
                    html += "    <th>Total</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    
                                total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                total_final += total;
                                existencia = parseFloat(inv[i]["existencia"]);
                                
                    html += "                 <td>"+(i+1)+"</td>";
                    html += "                 <td><img src='"+ base_url+"resources/images/productos/thumb_"+inv[i]["producto_foto"]+"' width='50' height='50' class='img-circle'</td>";
                    html += "                 <td><font size='3'><b>"+ inv[i]["producto_nombre"]+"</b></font> <sub>";
                    
                    html += "                 <a href='"+base_url+"producto/edit2/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'>["+inv[i]["producto_id"]+"] </a></sub>";
                    html += "    <br>";
                    html += "    <small>" + inv[i]["producto_unidad"]+" | "+inv[i]["producto_marca"]+" | "+inv[i]["producto_industria"];
                    
                    html += "   <span class='badge span-alert no-print'> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'> Kardex</a> </span></small>";
                    
                    //html += "     <button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal"+inv[i]["producto_id"]+"'>Kardex</button>";
                    
                    html += "                 </td>";
                    html += "                 <td><center><font size='2'><b>"+inv[i]["producto_codigobarra"]+"</b><br> </font>";
                    html += "    "+ inv[i]["producto_codigo"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["producto_costo"]+"</center></td>";

                    html += "                 <td><center>"+ inv[i]["compras"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["ventas"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["pedidos"]+"</center></td>";
                    
                    html += "                 <td><center> <font size='3'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
                    html += "                 <td><center> <font size='2'><b>"+ total.toFixed(decimales)+"</b></font></center></td>";
                    

                    html += "</tr>";
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th>"+formato_numerico(total_final)+"</th>";

                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html); 
                               
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    }
    
    
   //*********************** tipo_reporte 2 ************************************** 
    if (tipo_reporte == 2){
        
        
    $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla' >";
                    html += "<tr>";
                    html += "    <th>#</th>";
//                    html += "    <th>Imagen</th>";
                    html += "    <th>Descripción</th>";
                    html += "    <th>Código</th>";
                    html += "    <th>Categoría</th>";                    
                    html += "    <th>Unidad</th>";
                    html += "    <th>Costo ("+nombre_moneda+")</th>";
//                    html += "    <th>Compras</th>";
//                    html += "    <th>Ventas</th>";
//                    html += "    <th>Pedidos</th>";
                    html += "    <th>Saldo</th>";
                    html += "	<th>Total ("+nombre_moneda+")</th>";
                    html += "	<th>Total (";
                                            if(lamoneda_id == 1){
                                                html += lamoneda[1]['moneda_descripcion'];
                                            }else{
                                                html += lamoneda[0]['moneda_descripcion'];
                                            }
                    html += ")</th>";
                    html += "    <th colspan='6'>Saldos/Presentaciones</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                    var margen = " style='padding:0'";
                    var categoria = "";
                    
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    if (categoria != inv[i]["categoria_nombre"]){                        
                        html += "<tr><td colspan='14'><b>"+inv[i]["categoria_nombre"]+"<b></tr>";
                    }   

                        html += "<tr "+margen+">";

                                    total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                    total_final += total;
                                    existencia = parseFloat(inv[i]["existencia"]);                                                    
                        html += "                 <td "+margen+">"+(i+1)+"</td>";
                        html += "                 <td "+margen+"><font size='0.5'>"+ inv[i]["producto_nombre"]+"</font>";
                        html += "                 <td "+margen+" style='background: red'><center><font size='1'>"+inv[i]["producto_codigo"]+"</font> </center></td>";
                        html += "                 <td "+margen+"><font size='0.5'><center>"+ inv[i]["categoria_nombre"]+"</center></font> </td>";
                        html += "                 <td "+margen+"><font size='0.5'><center>"+ inv[i]["producto_unidad"]+"</center></font> </td>";

                        html += "    <td "+margen+"><center>"+ Number(inv[i]["producto_costo"]).toFixed(decimales)+"</center></td>";
                        html += "                 <td "+margen+"><center> <font size='1'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
                        html += "                 <td "+margen+"><center> <font size='1'><b>"+ numberFormat(total.toFixed(decimales))+"</b></font></center></td>";
                        html += "<td "+margen+" class='text-center'> ";
                        if(lamoneda_id == 1){
                            total_otram = total/Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = total*Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";

                        factor = 0;
                        producto_factor = 0;
                        unidadfactor = "";

                        if (inv[i]["producto_factor"]>0){

                            producto_factor = inv[i]["producto_factor"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor"]);
                            unidadfactor =  inv[i]["producto_unidadfactor"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor"]);
                            html += "                 <td "+margen+" ><center style='line-height:80%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+" </sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor1"]>0){

                            producto_factor = inv[i]["producto_factor1"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor1"]);
                            unidadfactor =  inv[i]["producto_unidadfactor1"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor1"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor2"]>0){

                            producto_factor = inv[i]["producto_factor2"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor2"]);
                            unidadfactor =  inv[i]["producto_unidadfactor2"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor2"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor3"]>0){

                            producto_factor = inv[i]["producto_factor3"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor3"]);
                            unidadfactor =  inv[i]["producto_unidadfactor3"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor3"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


                        if (inv[i]["producto_factor4"]>0){

                            producto_factor = inv[i]["producto_factor4"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor4"]);
                            unidadfactor =  inv[i]["producto_unidadfactor4"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor4"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


    //                    html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ existencia +"<br>"+inv[i]["producto_unidad"]+"</sub></center></td>";

                        html += "<td> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='btn btn-warning btn-xs no-print'><fa class='fa fa-list'> </fa> Kardex</a></small> </td>";
                        //html += "<td><a href='"+base_url++"'>kardex</a></td>";
                        html += "</tr>";
                   
                 
                     

                   categoria = inv[i]["categoria_nombre"];     
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
//                html += "    <th> </th>";
//                html += "    <th></th>";
//                html += "    <th></th>";
                html += "    <th>"+formato_numerico(total_final)+"</th>";
                html += "    <th>"+formato_numerico(total_otramoneda)+"</th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html);
                                
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    }
    
    
          
    //  document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader         
    
}

function tabla_existencia_realizable(){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById("base_url").value;
    var parametro = document.getElementById("filtrar").value;
    var controlador = base_url+"inventario/mostrar_inventario_existencia";
    var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    var total_otramoneda = Number(0);
    var total_otram = Number(0);
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    var tipo_reporte = 2;


    if (tipo_reporte == 1){
        $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla'>";
                    html += "<tr>";
                    html += "    <th>#</th>";
                    html += "    <th>Imagen</th>";
                    html += "    <th>Descripción</th>";
                    html += "    <th>Código</th>";
                    html += "    <th>Costo</th>";
                    html += "    <th>Precio</th>";
                    html += "    <th>Precio</th>";
                    html += "    <th>Compras</th>";
                    html += "    <th>Ventas</th>";
                    html += "    <th>Pedidos</th>";
                    html += "    <th>Existencia</th>";
                    html += "    <th>Total</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    
                                total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                total_final += total;
                                existencia = parseFloat(inv[i]["existencia"]);
                                
                    html += "                 <td>"+(i+1)+"</td>";
                    html += "                 <td><img src='"+ base_url+"resources/images/productos/thumb_"+inv[i]["producto_foto"]+"' width='50' height='50' class='img-circle'</td>";
                    html += "                 <td><font size='3'><b>"+ inv[i]["producto_nombre"]+"</b></font> <sub>";
                    
                    html += "                 <a href='"+base_url+"producto/edit2/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'>["+inv[i]["producto_id"]+"] </a></sub>";
                    html += "    <br>";
                    html += "    <small>" + inv[i]["producto_unidad"]+" | "+inv[i]["producto_marca"]+" | "+inv[i]["producto_industria"];
                    
                    html += "   <span class='badge span-alert no-print'> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'> Kardex</a> </span></small>";
                    
                    //html += "     <button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal"+inv[i]["producto_id"]+"'>Kardex</button>";
                    
                    html += "                 </td>";
                    html += "                 <td><center><font size='2'><b>"+inv[i]["producto_codigobarra"]+"</b><br> </font>";
                    html += "    "+ inv[i]["producto_codigo"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["producto_costo"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["producto_precio"]+"</center></td>";

                    html += "                 <td><center>"+ inv[i]["compras"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["ventas"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["pedidos"]+"</center></td>";
                    
                    html += "                 <td><center> <font size='3'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
                    html += "                 <td><center> <font size='2'><b>"+ total.toFixed(decimales)+"</b></font></center></td>";
                    

                    html += "</tr>";
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th>"+formato_numerico(total_final)+"</th>";

                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html); 
                               
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    }
    
    
   //*********************** tipo_reporte 2 ************************************** 
    if (tipo_reporte == 2){
        
        
    $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla' >";
                    html += "<tr>";
                    html += "    <th>#</th>";
//                    html += "    <th>Imagen</th>";
                    html += "    <th>Descripción</th>";
                    html += "    <th>Código</th>";
                    html += "    <th>Categoría</th>";                    
                    html += "    <th>Unidad</th>";
                    html += "    <th>Costo ("+nombre_moneda+")</th>";
                    html += "    <th>Precio ("+nombre_moneda+")</th>";
//                    html += "    <th>Compras</th>";
//                    html += "    <th>Ventas</th>";
//                    html += "    <th>Pedidos</th>";
                    html += "    <th>Saldo</th>";
                    html += " 	<th>Total ("+nombre_moneda+")</th>";
                    html += " 	<th>Total (";
                                            if(lamoneda_id == 1){
                                                html += lamoneda[1]['moneda_descripcion'];
                                            }else{
                                                html += lamoneda[0]['moneda_descripcion'];
                                            }
                    html += ")</th>";
                    html += "    <th colspan='6'>Saldos/Presentaciones</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                    var margen = " style='padding:0'";
                    var categoria = "";
                    
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    if (categoria != inv[i]["categoria_nombre"]){                        
                        html += "<tr><td colspan='14'><b>"+inv[i]["categoria_nombre"]+"<b></tr>";
                    }   

                        html += "<tr "+margen+">";

                                    total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                    total_final += total;
                                    existencia = parseFloat(inv[i]["existencia"]);                                                    
                        html += "                 <td "+margen+">"+(i+1)+"</td>";
                        html += "                 <td "+margen+"><font size='0.5'>"+ inv[i]["producto_nombre"]+"</font>";
                        html += "                 <td "+margen+" style='background: red'><center><font size='1'>"+inv[i]["producto_codigo"]+"</font> </center></td>";
                        html += "                 <td "+margen+"><font size='0.5'><center>"+ inv[i]["categoria_nombre"]+"</center></font> </td>";
                        html += "                 <td "+margen+"><font size='0.5'><center>"+ inv[i]["producto_unidad"]+"</center></font> </td>";

                        html += "    <td "+margen+"><center>"+ Number(inv[i]["producto_costo"]).toFixed(decimales)+"</center></td>";
                        html += "    <td "+margen+"><center>"+ Number(inv[i]["producto_precio"]).toFixed(decimales)+"</center></td>";
                        html += "                 <td "+margen+"><center> <font size='1'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
                        html += "                 <td "+margen+"><center> <font size='1'><b>"+ total.toFixed(decimales)+"</b></font></center></td>";
                        html += "<td class='text-center'> ";
                        if(lamoneda_id == 1){
                            total_otram = total/Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = total*Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                        factor = 0;
                        producto_factor = 0;
                        unidadfactor = "";

                        if (inv[i]["producto_factor"]>0){

                            producto_factor = inv[i]["producto_factor"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor"]);
                            unidadfactor =  inv[i]["producto_unidadfactor"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor"]);
                            html += "                 <td "+margen+" ><center style='line-height:80%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+" </sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor1"]>0){

                            producto_factor = inv[i]["producto_factor1"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor1"]);
                            unidadfactor =  inv[i]["producto_unidadfactor1"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor1"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor2"]>0){

                            producto_factor = inv[i]["producto_factor2"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor2"]);
                            unidadfactor =  inv[i]["producto_unidadfactor2"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor2"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor3"]>0){

                            producto_factor = inv[i]["producto_factor3"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor3"]);
                            unidadfactor =  inv[i]["producto_unidadfactor3"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor3"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


                        if (inv[i]["producto_factor4"]>0){

                            producto_factor = inv[i]["producto_factor4"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor4"]);
                            unidadfactor =  inv[i]["producto_unidadfactor4"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor4"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


    //                    html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ existencia +"<br>"+inv[i]["producto_unidad"]+"</sub></center></td>";

                        html += "<td> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='btn btn-warning btn-xs no-print'><fa class='fa fa-list'> </fa> Kardex</a></small> </td>";
                        //html += "<td><a href='"+base_url++"'>kardex</a></td>";
                        html += "</tr>";
                   
                 
                     

                   categoria = inv[i]["categoria_nombre"];     
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
//                html += "    <th> </th>";
//                html += "    <th></th>";
//                html += "    <th></th>";
                html += "    <th>"+formato_numerico(total_final)+"</th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html);
                                
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    }
    
    
          
    //  document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader         
    
}

function tabla_inventario_realizable(){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById("base_url").value;
    var parametro = document.getElementById("filtrar").value;
    var controlador = base_url+"inventario/mostrar_inventario_existencia";
    var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    var total_otramoneda = Number(0);
    var total_otram = Number(0);
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    var tipo_reporte = 2;


    if (tipo_reporte == 1){
        $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla'>";
                    html += "<tr>";
                    html += "    <th>#</th>";
                    html += "    <th>Imagen</th>";
                    html += "    <th>Descripción</th>";
                    html += "    <th>Código</th>";
                    html += "    <th>Costo</th>";
                    html += "    <th>Precio</th>";
                    html += "    <th>Compras</th>";
                    html += "    <th>Ventas</th>";
                    html += "    <th>Pedidos</th>";
                    html += "    <th>Existencia</th>";
                    html += "    <th>Total</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    
                                total = inv[i]["producto_precio"]*inv[i]["existencia"]; 
                                total_final += total;
                                existencia = parseFloat(inv[i]["existencia"]);
                                
                    html += "                 <td>"+(i+1)+"</td>";
                    html += "                 <td><img src='"+ base_url+"resources/images/productos/thumb_"+inv[i]["producto_foto"]+"' width='50' height='50' class='img-circle'</td>";
                    html += "                 <td><font size='3'><b>"+ inv[i]["producto_nombre"]+"</b></font> <sub>";
                    
                    html += "                 <a href='"+base_url+"producto/edit2/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'>["+inv[i]["producto_id"]+"] </a></sub>";
                    html += "    <br>";
                    html += "    <small>" + inv[i]["producto_unidad"]+" | "+inv[i]["producto_marca"]+" | "+inv[i]["producto_industria"];
                    
                    html += "   <span class='badge span-alert no-print'> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='no-print'> Kardex</a> </span></small>";
                    
                    //html += "     <button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal"+inv[i]["producto_id"]+"'>Kardex</button>";
                    
                    html += "                 </td>";
                    html += "                 <td><center><font size='2'><b>"+inv[i]["producto_codigobarra"]+"</b><br> </font>";
                    html += "    "+ inv[i]["producto_codigo"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["producto_costo"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["producto_precio"]+"</center></td>";

                    html += "                 <td><center>"+ inv[i]["compras"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["ventas"]+"</center></td>";
                    html += "    <td><center>"+ inv[i]["pedidos"]+"</center></td>";
                    
                    html += "                 <td><center> <font size='3'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
                    html += "                 <td><center> <font size='2'><b>"+ total.toFixed(decimales)+"</b></font></center></td>";
                    

                    html += "</tr>";
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th>"+formato_numerico(total_final)+"</th>";

                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html); 
                               
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    }
    
    
   //*********************** tipo_reporte 2 ************************************** 
    if (tipo_reporte == 2){
        
        
    $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla' >";
                    html += "<tr>";
                    html += "    <th>#</th>";
//                    html += "    <th>Imagen</th>";
                    html += "    <th>Descripción</th>";
                    html += "    <th>Código</th>";
                    html += "    <th>Categoría</th>";                    
                    html += "    <th>Unidad</th>";
                    html += "    <th>Costo ("+nombre_moneda+")</th>";
                    html += "    <th>Precio ("+nombre_moneda+")</th>";
//                    html += "    <th>Compras</th>";
//                    html += "    <th>Ventas</th>";
//                    html += "    <th>Pedidos</th>";
                    html += "    <th>Saldo</th>";
                    html += "	<th>Total ("+nombre_moneda+")</th>";
                    html += "	<th>Total (";
                                            if(lamoneda_id == 1){
                                                html += lamoneda[1]['moneda_descripcion'];
                                            }else{
                                                html += lamoneda[0]['moneda_descripcion'];
                                            }
                    html += ")</th>";
                    html += "    <th colspan='6'>Saldos/Presentaciones</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
            
                    
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                    var margen = " style='padding:0'";
                    var categoria = "";
                    
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    if (categoria != inv[i]["categoria_nombre"]){
                        html += "<tr><td colspan='14'><b>"+inv[i]["categoria_nombre"]+"<b></tr>";
                    }   

                        html += "<tr "+margen+">";

                                    total = inv[i]["producto_precio"]*inv[i]["existencia"]; 
                                    total_final += total;
                                    existencia = parseFloat(inv[i]["existencia"]);                                                    
                        html += "                 <td "+margen+">"+(i+1)+"</td>";
                        html += "                 <td "+margen+"><font size='0.5'>"+ inv[i]["producto_nombre"]+"</font>";
                        html += "                 <td "+margen+" style='background: red'><center><font size='1'>"+inv[i]["producto_codigo"]+"</font> </center></td>";
                        html += "                 <td "+margen+"><font size='0.5'><center>"+ inv[i]["categoria_nombre"]+"</center></font> </td>";
                        html += "                 <td "+margen+"><font size='0.5'><center>"+ inv[i]["producto_unidad"]+"</center></font> </td>";

                        html += "    <td "+margen+"><center>"+ Number(inv[i]["producto_costo"]).toFixed(decimales)+"</center></td>";
                        html += "    <td "+margen+"><center>"+ Number(inv[i]["producto_precio"]).toFixed(decimales)+"</center></td>";
                        html += "                 <td "+margen+"><center> <font size='1'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
                        html += "                 <td "+margen+"><center> <font size='1'><b>"+ total.toFixed(decimales)+"</b></font></center></td>";
                        html += "<td "+margen+" class='text-center'> ";
                        if(lamoneda_id == 1){
                            total_otram = total/Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = total*Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                        factor = 0;
                        producto_factor = 0;
                        unidadfactor = "";

                        if (inv[i]["producto_factor"]>0){

                            producto_factor = inv[i]["producto_factor"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor"]);
                            unidadfactor =  inv[i]["producto_unidadfactor"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor"]);
                            html += "                 <td "+margen+" ><center style='line-height:80%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+" </sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor1"]>0){

                            producto_factor = inv[i]["producto_factor1"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor1"]);
                            unidadfactor =  inv[i]["producto_unidadfactor1"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor1"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor2"]>0){

                            producto_factor = inv[i]["producto_factor2"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor2"]);
                            unidadfactor =  inv[i]["producto_unidadfactor2"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor2"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }

                        if (inv[i]["producto_factor3"]>0){

                            producto_factor = inv[i]["producto_factor3"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor3"]);
                            unidadfactor =  inv[i]["producto_unidadfactor3"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor3"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


                        if (inv[i]["producto_factor4"]>0){

                            producto_factor = inv[i]["producto_factor4"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor4"]);
                            unidadfactor =  inv[i]["producto_unidadfactor4"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor4"]);
                            html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


    //                    html += "                 <td "+margen+" ><center style='line-height:70%'> <sub> "+ existencia +"<br>"+inv[i]["producto_unidad"]+"</sub></center></td>";

                        html += "<td> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='btn btn-warning btn-xs no-print'><fa class='fa fa-list'> </fa> Kardex</a></small> </td>";
                        //html += "<td><a href='"+base_url++"'>kardex</a></td>";
                        html += "</tr>";
                   
                 
                     

                   categoria = inv[i]["categoria_nombre"];     
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                html += "<tr>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
                html += "    <th> </th>";
//                html += "    <th> </th>";
//                html += "    <th></th>";
//                html += "    <th></th>";
                html += "    <th>"+formato_numerico(total_final)+"</th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "    <th></th>";
                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html);
                                
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    }
    
    
          
    //  document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader         
    
}

function actualizar_inventario(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_inventario/";
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
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
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
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

function mostrar_duplicados(){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/mostrar_duplicados/";
    var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    var total_otramoneda = Number(0);
    var total_otram = Number(0);
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
        var inv = JSON.parse(respuesta);
            var tamanio = inv.length;
            //alert(tamanio);

             html = "";            
                    html += "<table class='table table-striped table-bordered' id='mitabla'>";
                    html += "<tr>";
                    html += "	<th>#</th>";
                    html += "	<th>Imagen</th>";
                    html += "	<th>Descripción</th>";
                    html += "	<th>Código</th>";
                    html += "	<th>Costo ("+nombre_moneda+")</th>";
                    html += "	<th>Compras</th>";
                    html += "	<th>Ventas</th>";
                    html += "	<th>Pedidos</th>";
                    html += "	<th>Existencia</th>";
                    html += "	<th>Total ("+nombre_moneda+")</th>";
                    html += "	<th>Total (";
                                            if(lamoneda_id == 1){
                                                html += lamoneda[1]['moneda_descripcion'];
                                            }else{
                                                html += lamoneda[0]['moneda_descripcion'];
                                            }
                    html += ")</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                           

            if (inv != null){
                    var total = 0;
                    var total_final = 0;
                    var existencia = 0;
                
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    
                                total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                total_final += total;
                                existencia = parseFloat(inv[i]["existencia"]);
                                
                    html += "             	<td>"+(i+1)+"</td>";
                    html += "             	<td><img src='"+ base_url+"resources/images/productos/thumb_"+inv[i]["producto_foto"]+"' width='50' height='50' class='img-circle'</td>";
                    html += "             	<td><font size='3'><b>"+ inv[i]["producto_nombre"]+"</b></font> <sub>";
                    
                    html += "             	<a href='"+base_url+"producto/edit2/"+inv[i]["producto_id"]+"' target='_blank'>["+inv[i]["producto_id"]+"] </a></sub>";
                    html += "    <br>";
                    html += "    <small>" + inv[i]["producto_unidad"]+" | "+inv[i]["producto_marca"]+" | "+inv[i]["producto_industria"];
                    html += "   <span class='badge span-alert'> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank'> Kardex</a> </span></small>";
                    html += "             	</td>";
                    html += "             	<td><center><font size='2'><b>"+inv[i]["producto_codigobarra"]+"</b><br> </font>";
                    html += "	"+ inv[i]["producto_codigo"]+"</center></td>";
                    html += "	<td><center>"+ inv[i]["producto_costo"]+"</center></td>";

                    html += "             	<td><center>"+ inv[i]["compras"]+"</center></td>";
                    html += "	<td><center>"+ inv[i]["ventas"]+"</center></td>";
                    html += "	<td><center>"+ inv[i]["pedidos"]+"</center></td>";
                    
                    html += "             	<td><center> <font size='3'><b>"+ existencia.toFixed(decimales)+"</b></font></center></td>";
                    html += "             	<td><center> <font size='2'><b>"+total.toFixed(decimales)+"</b></font></center></td>";
                    html += "<td class='text-center'> ";
                        if(lamoneda_id == 1){
                            total_otram = total/Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = total*Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                    html += "</tr>";
                } // end for (i = 0 ....)
            } //end if (inv != null){                
                html += "</tbody>";
                html += "<tr>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th> </th>";
                html += "	<th></th>";
                html += "	<th></th>";
                html += "	<th>"+formato_numerico(total_final)+"</th>";
                html += "	<th>"+formato_numerico(total_otramoneda)+"</th>";
                html += "	<!--<th></th>-->";
                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html); 
                               
                
            }, // end succes: function(resultados){
            error:function(resultado){
                alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
    });   
      
}

function mostrar_kardex(producto_id){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/buscar_kardex";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    
    $.ajax({
        url:controlador,
        type: "POST",
        data:{desde:fecha_desde,hasta:fecha_hasta, producto_id:producto_id},
        success:function(result){
            var k = JSON.parse(result);
            var lamoneda_id = document.getElementById('lamoneda_id').value;
            var total_otramoneda = Number(0);
            var total_otram = Number(0);
            var html = "";
            var tam = k.length;
            var saldo = 0; 
            var total_compras = 0; 
            var total_ventas = 0;
            var ocultar = "";
            var saldox = 0;
            var cont = 1;
            for(var i=0; i<tam; i++){
            
                if( Date.parse(k[i]['fecha'])>=Date.parse(fecha_desde) && Date.parse(k[i]['fecha'])<=Date.parse(fecha_hasta)){
                    ocultar = "";
                   
                    if (cont == 1){
                        html += "<tr style='padding:0'>";
                        html += "<td style='padding:0'><center>"+formato_fecha(fecha_desde)+"</center></td>";    
                        html += "<td style='padding:0'></td>";                      
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";
                        html += "<td style='padding:0'></td>";
                        html += "<td style='padding:0'><center><b>"+Number(saldo).toFixed(decimales)+"</b></center></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'><center><b>SALDO INICIAL<b></center></td>";                    
                        html += "</tr>";
                    }
                    cont++;
                    
                }
                else{
                    ocultar = "style='display:none;'";
                }
            
                    saldo += Number(k[i]['unidad_comp']) - Number(k[i]['unidad_vend']);
                    total_compras += Number(k[i]['unidad_comp']);
                    total_ventas += Number(k[i]['unidad_vend']);
                    
                    html += "    <tr align='center' "+ocultar+">";
                    html += "            <td style='padding:0'>"+formato_fecha(k[i]['fecha'])+" - "+k[i]['hora']+"</td>";
                    html += "            <td style='padding:0'>";
                    
                    if (k[i]['num_ingreso']!=0){ 
                        html += k[i]['num_ingreso'];
                        html += "<a href='"+base_url+"compra/nota/"+k[i]['num_ingreso']+"' target='_blank' class='btn btn-xs btn-info no-print'><fa class='fa fa-print'></fa> </a>";
                    }
                    html += "</td>";
                    
                    html += "<td style='padding:0; background-color: #E9FC00 !important; -webkit-print-color-adjust: exact; text-align:right; padding-right: 10px;'><b>";
                        if (k[i]['unidad_comp']!=0) 
                            html += Number(k[i]['unidad_comp']).toFixed(decimales);
                    html += "</b></td>";
                    
                    html += "            <td style='padding:0; text-align: right; padding-right: 10px;'>";                    
                        if (k[i]['costoc_unit']!=0) html += numberFormat(Number(k[i]['costoc_unit']).toFixed(decimales));
                    html += "</td>";
                    
                    html += "            <td style='padding:0; text-align: right; padding-right: 10px;'>";
                    
                        if (k[i]['importe_ingreso']!=0) html += numberFormat(Number(k[i]['importe_ingreso']).toFixed(decimales));
                    html += "</td>";
                        
                    html += "            <td style='padding:0'>";
                        if (k[i]['num_salida']!=0){
                            html += Number(k[i]['num_salida']);
                            html += "<a href='"+base_url+"factura/imprimir_recibo/"+k[i]['num_salida']+"' target='_blank' class='btn btn-xs btn-success no-print'><fa class='fa fa-print'></fa> </a>";
                        }  
                    html += "</td>";
                        
                    html += "            <td style='padding:0; background-color: #E9FC00 !important; -webkit-print-color-adjust: exact; text-align: right; padding-right: 10px;'><b>";
                            if (k[i]['unidad_vend']!=0) html += Number(k[i]['unidad_vend']).toFixed(decimales);
                            
                    html += "</b></td>";
                            
                    html += "            <td style='padding:0; text-align: right; padding-right: 10px;'>";
                                if (k[i]['costov_unit'] != 0) html += Number(k[i]['costov_unit']).toFixed(decimales);
                    html +="</td>";
                    
                    html +="            <td style='padding:0; text-align: right; padding-right: 10px;'>";
                                if (k[i]['importe_salida'] != 0)  html += numberFormat(Number(k[i]['importe_salida']).toFixed(decimales));
                    html +="</td>";
                    
                    if (Number(saldo)>=0){
                        html +="            <td style='padding:0; text-align: right; padding-right: 10px;'><b>"+numberFormat(Number(saldo).toFixed(decimales))+"</b></td>";
                    }else{
                        html +="            <td style='padding:0; background:orange; text-align: right; padding-right: 10px;'><b>"+numberFormat(Number(saldo).toFixed(decimales))+"</b></td>";                        
                    }
                    html +="            <td style='padding:0; text-align: right; padding-right: 10px;'>";
                    
                        if(Number(saldo * k[i]['costoc_unit']).toFixed(decimales)>0){ saldox = saldo * k[i]['costoc_unit'];}
                        else {  saldox = saldo * k[i]['costov_unit']; }
                        
                    html += numberFormat(saldox.toFixed(decimales))+"</td>";
                    
                    html += "<td style='padding:0; text-align: right; padding-right: 10px;' class='text-right'> ";
                    if(lamoneda_id == 1){
                        total_otram = Number(saldox)/Number(k[i]["tipo_cambio"])
                        total_otramoneda += total_otram;
                    }else{
                        total_otram = Number(saldox)*Number(k[i]["tipo_cambio"])
                        total_otramoneda += total_otram;
                    }
                    html += numberFormat(Number(total_otram).toFixed(decimales));
                    html += "</td>";
                    html +="            <td style='padding:0'>"+k[i]['detalleobs']+"</td>";
                    html +="            ";
                    html +="        </tr>";
                
            }

                    html +="    <tr>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'><small>ENTRADAS</small><br><h5><b>"+numberFormat(total_compras.toFixed(decimales))+"</b></h5></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'><small>SALIDAS</small><br><h5><b>"+numberFormat(total_ventas.toFixed(decimales))+"</b></h5></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'><small>SALDOS</small><br><h5><b>"+numberFormat(saldo.toFixed(decimales))+"</b></h5></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="     <th style='padding:0'></th>";
                    html +="    </tr>";
                    
                    $("#tabla_kardex").html(html);
        }
    });
    
}

function mostrar_kardex_global(){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/buscar_kardex_global";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    
    $.ajax({
        url:controlador,
        type: "POST",
        data:{desde:fecha_desde,hasta:fecha_hasta, producto_id:producto_id},
        success:function(result){
            var k = JSON.parse(result);
            var lamoneda_id = document.getElementById('lamoneda_id').value;
            var total_otramoneda = Number(0);
            var total_otram = Number(0);
            var html = "";
            var tam = k.length;
            var saldo = 0; 
            var total_compras = 0; 
            var total_ventas = 0;
            var ocultar = "";
            var saldox = 0;
            var cont = 1;
            for(var i=0; i<tam; i++){
            
                if( Date.parse(k[i]['fecha'])>=Date.parse(fecha_desde) && Date.parse(k[i]['fecha'])<=Date.parse(fecha_hasta)){
                    ocultar = "";
                   
                    if (cont == 1){
                        html += "<tr style='padding:0'>";
                        html += "<td style='padding:0'><center>"+formato_fecha(fecha_desde)+"</center></td>";    
                        html += "<td style='padding:0'></td>";                      
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'></td>";
                        html += "<td style='padding:0'></td>";
                        html += "<td style='padding:0'><center><b>"+Number(saldo).toFixed(decimales)+"</b></center></td>";                    
                        html += "<td style='padding:0'></td>";                    
                        html += "<td style='padding:0'><center><b>SALDO INICIAL<b></center></td>";                    
                        html += "</tr>";
                    }
                    cont++;
                    
                }
                else{
                    ocultar = "style='display:none;'";
                }
            
                    saldo += Number(k[i]['unidad_comp']) - Number(k[i]['unidad_vend']);
                    total_compras += Number(k[i]['unidad_comp']);
                    total_ventas += Number(k[i]['unidad_vend']);
                    
                    html += "    <tr align='center' "+ocultar+">";
                    html += "            <td style='padding:0'>"+formato_fecha(k[i]['fecha'])+" - "+k[i]['hora']+"</td>";
                    html += "            <td style='padding:0'>";
                    if (k[i]['num_ingreso']!=0) 
                        html += k[i]['num_ingreso'];
                    html += "</td>";
                    
                    html += "            <td style='padding:0; background-color: #E9FC00 !important; -webkit-print-color-adjust: exact;'><b>";
                        if (k[i]['unidad_comp']!=0) 
                            html += k[i]['unidad_comp'];
                    html += "</b></td>";
                    
                    html += "            <td style='padding:0'>";                    
                        if (k[i]['costoc_unit']!=0) html += Number(k[i]['costoc_unit']).toFixed(decimales);
                    html += "</td>";
                    
                    html += "            <td style='padding:0'>";
                    
                        if (k[i]['importe_ingreso']!=0) html += Number(k[i]['importe_ingreso']).toFixed(decimales);
                    html += "</td>";
                        
                    html += "            <td style='padding:0'>";
                        if (k[i]['num_salida']!=0)  html += Number(k[i]['num_salida']).toFixed(decimales);
                    html += "</td>";
                        
                    html += "            <td style='padding:0; background-color: #E9FC00 !important; -webkit-print-color-adjust: exact;'><b>";
                            if (k[i]['unidad_vend']!=0) html += Number(k[i]['unidad_vend']).toFixed(decimales);
                            
                    html += "</b></td>";
                            
                    html += "            <td style='padding:0'>";
                                if (k[i]['costov_unit'] != 0) html += Number(k[i]['costov_unit']).toFixed(decimales);
                    html +="</td>";
                    
                    html +="            <td style='padding:0'>";
                                if (k[i]['importe_salida'] != 0)  html += Number(k[i]['importe_salida']).toFixed(decimales);
                    html +="</td>";
                    
                    if (Number(saldo)>=0){
                        html +="            <td style='padding:0'><b>"+Number(saldo).toFixed(decimales)+"</b></td>";
                    }else{
                        html +="            <td style='padding:0; background:orange;'><b>"+Number(saldo).toFixed(decimales)+"</b></td>";                        
                    }
                    html +="            <td style='padding:0'>";
                    
                        if(Number(saldo * k[i]['costoc_unit']).toFixed(decimales)>0){ saldox = saldo * k[i]['costoc_unit'];}
                        else {  saldox = saldo * k[i]['costov_unit']; }
                        
                    html += saldox.toFixed(decimales)+"</td>";
                    html += "<td style='padding:0' class='text-right'> ";
                    if(lamoneda_id == 1){
                        total_otram = Number(saldox)/Number(k[i]["tipo_cambio"])
                        total_otramoneda += total_otram;
                    }else{
                        total_otram = Number(saldox)*Number(k[i]["tipo_cambio"])
                        total_otramoneda += total_otram;
                    }
                    html += numberFormat(Number(total_otram).toFixed(decimales));
                    html += "</td>";
                    html +="            <td style='padding:0'>"+k[i]['detalleobs']+"</td>";
                    html +="            ";
                    html +="        </tr>";
                
            }

                    html +="    <tr>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'><small>ENTRADAS</small><br><h5><b>"+total_compras.toFixed(decimales)+"</b></h5></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'><small>SALIDAS</small><br><h5><b>"+total_ventas.toFixed(decimales)+"</b></h5></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'><small>SALDOS</small><br><h5><b>"+saldo.toFixed(decimales)+"</b></h5></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="    <th style='padding:0'></th>";
                    html +="     <th style='padding:0'></th>";
                    html +="    </tr>";
                    
                    $("#tabla_kardex").html(html);
        }
    });
    
}

function generarexcel(){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'inventario/generar_excel';    
    

     //parametro = document.getElementById('filtrar').value;   
     //controlador = base_url+'ingreso/buscarallingreso/';
    var showLabel = true;
    
    var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader

    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(result){
                var factura = JSON.parse(result);
                var tam = factura.length;
                var nombre_moneda = document.getElementById('nombre_moneda').value;
                var lamoneda_id = document.getElementById('lamoneda_id').value;
                var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
                var otramoneda_nombre = "";
                var total_otram = Number(0);
                html = "";
                if (tam>0){
                  /* **************INICIO Generar Excel JavaScript************** */
                    var CSV = 'sep=,' + '\r\n\n';
                    //This condition will generate the Label/Header
                    if (showLabel) {
                        var row = "";

                        //This loop will extract the label from 1st index of on array
                        

                            //Now convert each value to string and comma-seprated
                            
                            row += 'N°' + ',';
                            row += 'DESCRIPCION' + ',';
                            row += 'CODIGO' + ',';
                            row += 'CATEGORIA' + ',';
                            row += 'UNIDAD' + ',';
                            row += 'COSTO(' +nombre_moneda+ '),';
                            row += 'SALDO' + ',';
                            row += 'TOTAL(' +nombre_moneda+ '),';
                            row += 'TOTAL(';
                            if(lamoneda_id == 1){
                                otramoneda_nombre = lamoneda[1]['moneda_descripcion'];
                            }else{
                                otramoneda_nombre = lamoneda[0]['moneda_descripcion'];
                            }
                            row += otramoneda_nombre+ '),';
       
                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < tam; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        
                            row += 'i+1,';
                            row += '"' +factura[i]["producto_nombre"]+ '",';
                            row += '"' +factura[i]["producto_codigo"]+ '",';
                            row += '"' +factura[i]["categoria_nombre"]+ '",';
                            row += '"' +factura[i]["producto_unidad"]+ '",';
                            row += '"' +Number(factura[i]["producto_costo"]).toFixed(decimales)+ '",';
                            row += '"' +Number(factura[i]["existencia"]).toFixed(decimales)+ '",';
                            row += '"' +Number(factura[i]["producto_costo"]*factura[i]["existencia"]).toFixed(decimales)+ '",';
                            if(lamoneda_id == 1){
                                total_otram = Number(factura[i]["producto_costo"]*factura[i]["existencia"])/Number(lamoneda[1]["moneda_tc"]);
                                //total_otramoneda += total_otram;
                            }else{
                                total_otram = Number(factura[i]["producto_costo"]*factura[i]["existencia"])*Number(lamoneda[1]["moneda_tc"]);
                                //total_otramoneda += total_otram;
                            }
                            row += '"' +numberFormat(Number(total_otram).toFixed(decimales))+ '",';
                           

                        
                        row.slice(0, row.length - 1);

                        //add a line break after each row
                        CSV += row + '\r\n';
                    }
                    
                    if (CSV == '') {        
                        alert("Invalid data");
                        return;
                    }
                    
                    //Generate a file name
                    var fileName = "Inventario_";
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


function ver_operacionproceso(producto_id){
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/operacion_enproceso";
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
        type:"POST",
        data:{producto_id:producto_id},
        success:function(respuesta){     
            var resultado = JSON.parse(respuesta);
            var enventa  = resultado.enventa_aux; 
            var enpedido = resultado.enpedido_noconsol; 
        
            var tamventa  = enventa.length;
            var tampedido = enpedido.length;
            if (tamventa >0){
                html = "";            
                html += "<table class='table table-striped table-bordered' id='mitabla'>";
                html += "<tr>";
                html += "	<th style='padding: 0'>Usuario</th>";
                html += "	<th style='padding: 0'>Cantidad</th>";
                html += "	<th style='padding: 0'>Num. Venta</th>";
                html += "	<th style='padding: 0'>Producto</th>";
                html += "</tr>";
                html += "<tbody class='buscar'>";
                var totalventa_aux = Number(0);
                for (var i = 0; i < tamventa ; i++){
                    totalventa_aux += Number(enventa[i]["detalleven_cantidad"]);
                    
                    html += "<td style='padding: 0' class='text-center'>"+enventa[i]["usuario_nombre"]+"</td>";
                    html += "<td style='padding: 0' class='text-right'>"+Number(enventa[i]["detalleven_cantidad"]).toFixed(decimales)+"</td>";
                    html += "<td style='padding: 0' class='text-center'>"+enventa[i]["venta_id"]+"</td>";
                    html += "<td style='padding: 0'>"+enventa[i]["producto_nombre"]+"</td>";
                    html += "</tr>";
                }
                html += "</tbody>";
                html += "<tr>";
                html += "	<th style='text-align: right !important; padding: 0'>TOTAL:</th>";
                html += "	<th style='text-align: right !important;padding: 0'>"+formato_numerico(totalventa_aux)+"</th>";
                html += "	<th style='padding: 0'> </th>";
                html += "	<th style='padding: 0'> </th>";
                html += "</tr>    ";
                html += "</table>";            
                $("#tituloresventaaux").html('VENTAS EN PROCESO');
                $("#resventaaux").html(html);
            }else{
                $("#tituloresventaaux").html('NO EXISTEN VENTAS EN PROCESO');
                $("#resventaaux").html('');
            }
            
            if (tampedido >0){
                html = "";            
                html += "<table class='table table-striped table-bordered' id='mitabla'>";
                html += "<tr>";
                html += "	<th style='padding: 0'>Usuario</th>";
                html += "	<th style='padding: 0'>Cantidad</th>";
                html += "	<th style='padding: 0'>Num. Pedido</th>";
                html += "	<th style='padding: 0'>Producto</th>";
                html += "</tr>";
                html += "<tbody class='buscar'>";
                var totalpedido_nofin = Number(0);
                for (var i = 0; i < tampedido ; i++){
                    totalpedido_nofin += Number(enpedido[i]["detalleped_cantidad"]);
                    
                    html += "<td style='padding: 0' class='text-center'>"+enpedido[i]["usuario_nombre"]+"</td>";
                    html += "<td style='padding: 0' class='text-right'>"+Number(enpedido[i]["detalleped_cantidad"]).toFixed(decimales)+"</td>";
                    html += "<td style='padding: 0' class='text-center'>"+enpedido[i]["pedido_id"]+"</td>";
                    html += "<td style='padding: 0'>"+enpedido[i]["detalleped_nombre"]+"</td>";
                    html += "</tr>";
                }
                html += "</tbody>";
                html += "<tr>";
                html += "	<th style='text-align: right !important; padding: 0'>TOTAL:</th>";
                html += "	<th style='text-align: right !important; padding: 0'>"+formato_numerico(totalpedido_nofin)+"</th>";
                html += "	<th style='padding: 0'> </th>";
                html += "	<th style='padding: 0'> </th>";
                html += "</tr>    ";
                html += "</table>";            
                $("#titulores_pedido_nofin").html('PEDIDOS EN PROCESO');
                $("#res_pedido_nofin").html(html);
            }else{
                $("#titulores_pedido_nofin").html('NO EXISTEN PEDIDOS EN PROCESO');
                $("#res_pedido_nofin").html('');
            }
            }, // end succes: function(resultados){
            error:function(resultado){
                alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
    });   
      
    
}
/* imprimir */
function imprimir(){
    window.print();
}

function actualizar_inventarios(){
 
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"sucursales/cargar_inventarios/";
    
    document.getElementById('loaderindex').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){
            var registros =  JSON.parse(respuesta);
            if (registros == "no"){
                alert("El Sistema no tiene Sucursales; por favor consulte con su proveedor!.");
            }else{
                alert('El inventario se actualizo exitosamente...! ');
                //redirect('inventario/index');
                document.getElementById('loaderindex').style.display = 'none'; //ocultar el bloque del loader
                //tabla_inventario();
            }
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loaderindex').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
    });      
    
}


function actualizar_productos(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"sucursales/actualizar_productos/";
    var base_datos = document.getElementById('select_almacen').value;
    var operacion = document.getElementById('operacion').value;
    
    //alert("base de datos: "+base_datos+" operacion: "+operacion)
    
    document.getElementById('loaderindex').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
        type:"POST",
        data:{base_datos: base_datos, operacion: operacion},
        success:function(respuesta){
            
            var productos =  JSON.parse(respuesta);
            var sucproductos =  productos["sucproductos"];
            var misproductos =  productos["misproductos"];
            


            alert(JSON.stringify(productos));
            
//            if (registros == "no"){
//                
//                alert("El Sistema no tiene Sucursales; por favor consulte con su proveedor!.");
//                
//            }else{
//                
//                alert('El inventario se actualizo exitosamente...! ');
//                //redirect('inventario/index');
//                document.getElementById('loaderindex').style.display = 'none'; //ocultar el bloque del loader
//                //tabla_inventario();
//            }
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loaderindex').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
    });      
    
   
    
    
}