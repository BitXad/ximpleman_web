/* 
 *  Realizado por: Roberto Carlos Soto S.
 *  Fecha: 15/01/2019
 */
//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
$(document).on("ready",inicio);
function inicio(){
        //tabla_inventariosuc();
}

function buscar_productos(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        actualizar_inventarios();
    }
}

/* Actualiza inventario_sucursales.... de inventario_sucursal */
function actualizar_inventarios(){
 
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"sucursales/cargar_inventarios/";
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
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
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
                tabla_inventariosuc();
            }
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
    });      
    
}

/* muestra la tabla inventario sucursal de inventario_sucursal */
function tabla_inventariosuc(){
    
    var base_url = document.getElementById("base_url").value;
    var parametro = document.getElementById("filtrar").value;
    var decimales = document.getElementById("decimales").value;
    var controlador = base_url+"inventario_sucursal/mostrar_inventarios";
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    let losalmacenes = JSON.parse(document.getElementById('losalmacenes').value);
    
    var total_otramoneda = Number(0);
    var total_otram = Number(0);
    
    $.ajax({
        url: controlador,
        type:"POST",
        async: false,
        data:{parametro:parametro},
        success: function(resultado){
            var inv = JSON.parse(resultado);
            var tamanio = inv.length;
            let totalalmacen = losalmacenes.length;
            
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
            for (var j = 0; j < totalalmacen; j++) {
                html += "<th>"+losalmacenes[j]['almacen_nombre']+"</th>";
            }
            html += "	<th>Saldo<br>Total</th>";
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
            /*
            html += "	<th colspan='6'>Saldos/Presentaciones</th>";
            */
            html += "</tr>";
            html += "<tbody class='buscar'>";
            let eltotal_saldo = 0;
            let eltotal_saldobs = 0;
            
            if (inv != null){
                var total = 0;
                var total_final = 0;
                var existencia = 0;
                var margen = " style='padding:0;'";
                var categoria = "";
                    
                for (var i = 0; i < tamanio ; i++){
                    let total_saldo = 0;
                    let total_saldobs = 0;
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    if (categoria != inv[i]["categoria_nombre"]){
                        paracolspan = Number(6+totalalmacen+3);
                        html += "<tr><td colspan='"+paracolspan+"'><b>"+inv[i]["categoria_nombre"]+"<b></tr>";
                    }   

                        html += `<tr style='padding:0;'>`;

                                    total = inv[i]["producto_costo"]*inv[i]["existencia"]; 
                                    total_final += total;
                                    //existencia = parseFloat(inv[i]["existencia"]);                                                    
                        html += "             	<td "+margen+">"+(i+1)+"</td>";
                        html += "             	<td "+margen+"><font size='0.5'>"+ inv[i]["producto_nombre"]+"</font>";
                        html += "             	<td "+margen+" style='background: red'><center><font size='1'>"+inv[i]["producto_codigo"]+"</font> </center></td>";
                        html += "             	<td "+margen+"><font size='0.5'><center>"+ inv[i]["categoria_nombre"]+"</center></font> </td>";
                        html += "             	<td "+margen+"><font size='0.5'><center>"+ inv[i]["producto_unidad"]+"</center></font> </td>";
                        html += "	<td "+margen+"><center>"+ Number(inv[i]["producto_costo"]).toFixed(2)+"</center></td>";
                        if(1 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc1']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc1"] >= 0 ? "background-color: lightgray":""}'>`;
                            
                            let partes = inv[i]['suc1'];
                            let partes1 = partes.toString();
                            let partes2 = partes1.split('.');
                            if (partes2[1] == 0) { 
                                lacantidad = partes2[0]; 
                            }else{ 
                                lacantidad = Number(inv[i]['suc1']).toFixed(decimales);
                            }
                            html += lacantidad;
                        
                            html += "</td>";
                            
                            total_saldo += Number(inv[i]['suc1']);
                        }
                        if(2 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc2']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc2"] >= 0 ? "background-color: lightgray":""}'>`;
                            if(inv[i]['suc2'] != null){
                                let partes = inv[i]['suc2'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc2']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc2']);
                        }
                        if(3 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc3']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc3"] >= 0 ? "background-color: lightgray":""}'>`;
                            if(inv[i]['suc3'] != null){
                                let partes = inv[i]['suc3'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc3']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc3']);
                        }
                        if(4 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc4']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc4"] >= 0 ? "background-color: lightgray":""}'>`;
                            if(inv[i]['suc4'] != null){
                                let partes = inv[i]['suc4'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc4']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc4']);
                        }
                        if(5 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc5']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc5"] >= 0 ? "background-color: lightgray":""}'>`;
                            if(inv[i]['suc5'] != null){
                                let partes = inv[i]['suc5'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc5']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc5']);
                        }
                        if(6 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc6']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc6"] >= 0 ? "background-color: lightgray":""}'>`;
                            if(inv[i]['suc6'] != null){
                                let partes = inv[i]['suc6'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc6']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc6']);
                        }
                        if(7 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc7']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc7"] >= 0 ? "background-color: lightgray":""}'>`;
                            if(inv[i]['suc7'] != null){
                                let partes = inv[i]['suc7'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc7']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc7']);
                        }
                        if(8 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc8']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc8"] >= 0 ? "background-color: lightgray":""}'>`;
                            if(inv[i]['suc8'] != null){
                                let partes = inv[i]['suc8'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc8']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc8']);
                        }
                        if(9 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc9']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc9"] >= 0 ? "background-color: lightgray":""}'>`;
                            if(inv[i]['suc9'] != null){
                                let partes = inv[i]['suc9'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc9']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc9']);
                        }
                        if(10 <= totalalmacen){
                            //html += "<td "+margen+" class='text-right'>"+inv[i]['suc10']+"</td>";
                            html += `<td class='text-right' style='padding:0;${inv[i]["suc10"] >= 0 ?"background: lightgray":""}'>`;
                            if(inv[i]['suc10'] != null){
                                let partes = inv[i]['suc10'];
                                let partes1 = partes.toString();
                                let partes2 = partes1.split('.');
                                if (partes2[1] == 0) { 
                                    lacantidad = partes2[0]; 
                                }else{ 
                                    lacantidad = Number(inv[i]['suc10']).toFixed(decimales);
                                }
                                html += lacantidad;
                            }else{
                                html += "0";
                            }
                            html += "</td>";
                            total_saldo += Number(inv[i]['suc10']);
                        }
                        html += "<td "+margen+" class='text-right'>"+total_saldo+"</td>";
                        eltotal_saldo += Number(total_saldo);
                        total_saldobs += Number(Number(total_saldo)*Number(inv[i]['producto_costo']));
                        eltotal_saldobs += Number(total_saldobs);
                        
                        /*
                        html += "	<td "+margen+"><center>"+ Number(inv[i]["producto_costo"]).toFixed(2)+"</center></td>";
                        html += "             	<td "+margen+"><center> <font size='1'><b>"+ existencia.toFixed(2)+"</b></font></center></td>";
                        html += "             	<td "+margen+"><center> <font size='1'><b>"+ numberFormat(total.toFixed(2))+"</b></font></center></td>";
                        */
                       html += "<td "+margen+"><center> <font size='1'><b>"+ numberFormat(total_saldobs.toFixed(decimales))+"</b></font></center></td>";
                        html += "<td "+margen+" class='text-center'> ";
                        if(lamoneda_id == 1){
                            total_otram = total_saldobs/Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = total_saldobs*Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(decimales));
                        html += "</td>";
                        /*
                        factor = 0;
                        producto_factor = 0;
                        unidadfactor = "";

                        if (inv[i]["producto_factor"]>0){

                            producto_factor = inv[i]["producto_factor"];
                            factor =  Math.floor(existencia / inv[i]["producto_factor"]);
                            unidadfactor =  inv[i]["producto_unidadfactor"];
                            saldo =  Math.floor(existencia % inv[i]["producto_factor"]);
                            html += "             	<td "+margen+" ><center style='line-height:80%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
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
                            html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
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
                            html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
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
                            html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
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
                            html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ factor +" "+unidadfactor+" ["+producto_factor+"] ";
                            html += "<br> "+saldo+" "+inv[i]["producto_unidad"]+"</sub></center></td>";

                        }
                        else{

                            html += "<td "+margen+" ></td>";
                        }


    //                    html += "             	<td "+margen+" ><center style='line-height:70%'> <sub> "+ existencia +"<br>"+inv[i]["producto_unidad"]+"</sub></center></td>";

                        html += "<td> <a href='"+base_url+"inventario/kardex/"+inv[i]["producto_id"]+"' target='_blank' class='btn btn-warning btn-xs no-print'><fa class='fa fa-list'> </fa> Kardex</a></small> </td>";
                        //html += "<td><a href='"+base_url++"'>kardex</a></td>";
                        */
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
                for (var j = 0; j < totalalmacen; j++) {
                    html += "<th> </th>";
                }
                html += "	<th>"+formato_numerico(eltotal_saldo)+"</th>";
                html += "	<th>"+formato_numerico(eltotal_saldobs)+"</th>";
                html += "	<th class='text-right'>"+formato_numerico(total_otramoneda)+"</th>";
                //html += "	<th></th>";
                /*html += "	<th></th>";
                html += "	<th></th>";*/
                html += "</tr>    ";
                html += "</table>";            
                $("#tabla_inventario").html(html);   
                             
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax                 
        
    
    
          
    //  document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader         
    
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

/* imprimir */
function imprimir(){
    window.print();
}

