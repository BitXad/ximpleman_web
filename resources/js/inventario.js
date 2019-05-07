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


function validar(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 

        if (opcion == 1){   //Si la accecion proviene de la casilla de parametro de busqueda de inventario
            tabla_inventario();      
            
        }
        
    } 
 
}

function tabla_inventario(){
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
                    html += "	<td><center>"+ inv[i]["producto_costo"]+"</center></td>";

                    html += "             	<td><center>"+ inv[i]["compras"]+"</center></td>";
                    html += "	<td><center>"+ inv[i]["ventas"]+"</center></td>";
                    html += "	<td><center>"+ inv[i]["pedidos"]+"</center></td>";
                    
                    html += "             	<td><center> <font size='3'><b>"+ existencia.toFixed(2)+"</b></font></center></td>";
                    html += "             	<td><center> <font size='2'><b>"+ total.toFixed(2)+"</b></font></center></td>";
                    
                    

//html+="  <!-- Inicio Modal kardex -->";
//html+="    <div class='modal fade' id='myModal"+inv[i]["producto_id"]+"' role='dialog'>";
//html+="      <div class='modal-dialog'>";
//    
//html+="      <!-- Modal content-->";
//html+="      <div class='modal-content'>";
//html+="        <div class='modal-header'>";
//html+="          <button type='button' class='close' data-dismiss='modal'>&times;</button>";
//html+="          <h4 class='modal-title'><b>Kardex de Existencia</b></h4>";
//html+="        </div>";
//html+="        <div class='modal-body'>";
//         
//html+="    <div class='panel col-md-12 ' >";
//html+="    <center>          ";  
//html+="        <div class='col-md-6'>";
//html+="            Desde: <input type='date' class='btn btn-warning btn-sm form-control' id='fecha_desde' value='"+fecha()+"' name='fecha_desde' required='true'>";
//html+="       </div>";
//html+="        <div class='col-md-6'>";
//html+="            Hasta: <input type='date' class='btn btn-warning btn-sm form-control' id='fecha_hasta' value='"+fecha()+"'  name='fecha_hasta' required='true'>";
//html+="        </div>";
//        
//html+="        <br>";
//
//html+="    </center>    ";
//html+="    <br>  ";  
//html+="    </div>";
//               
//html+="        </div>";
//html+="        <div class='modal-footer'>";
//html+="          <a href='' type='button' target='_blank' class='btn btn-default' data-dismiss='modal' onclick='mostrar_kardex("+inv[i]["producto_id"]+")' >Ver Kardex</a>";
//html+="        </div>";
//html+="      </div>";
//      
//html+="    </div>";
//html+="  </div>";
//html+="  <!-- Fin Modal kardex -->";             
                    
                    
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
                html += "	<th>"+total_final.toFixed(formato_numerico(2))+"</th>";
                html += "	<!--<th></th>-->";
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
         
          
    //  document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader         
    
}

function actualizar_inventario()
{
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

function mostrar_duplicados()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/mostrar_duplicados/";
    
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
                    
                    html += "             	<td><center> <font size='3'><b>"+ existencia.toFixed(2)+"</b></font></center></td>";
                    html += "             	<td><center> <font size='2'><b>"+total.toFixed(2)+"</b></font></center></td>";
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
                html += "	<th>"+total_final.toFixed(2)+"</th>";
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
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/buscar_kardex";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    
    
    //alert(controlador);
    
    //alert(fecha_desde+" "+fecha_hasta+" "+producto_id);
    //window.open(controlador); //Levantar el formulario de kardex
    
    $.ajax({
        url:controlador,
        type: "POST",
        data:{desde:fecha_desde,hasta:fecha_hasta, producto_id:producto_id},
        success:function(result){
            var k = JSON.parse(result);
            var html = "";
            var tam = k.length;
            var saldo = 0; 
            var total_compras = 0; 
            var total_ventas = 0;
            var ocultar = "";
            for(var i=0; i<tam; i++){
            
                if( Date.parse(k[i]['fecha'])>=Date.parse(fecha_desde) && Date.parse(k[i]['fecha'])<=Date.parse(fecha_hasta)){
                    ocultar = "";
                }
                else{
                    ocultar = "style='display:none;'";
                }
            
                    saldo += Number(k[i]['unidad_comp']) - Number(k[i]['unidad_vend']);
                    total_compras += Number(k[i]['unidad_comp']);
                    total_ventas += Number(k[i]['unidad_vend']);
                    
                    html += "    <tr align='center' ocultar>    ";
                    html += "            <td>"+k[i]['fecha']+"-"+k[i]['hora']+"</td>";
                    html += "            <td>";
                    if (k[i]['num_ingreso']!=0) 
                        html += k[i]['num_ingreso'];
                    html += "</td>";
                    
                    html += "            <td><b>";
                        if (k[i]['unidad_comp']!=0) 
                            html += k[i]['unidad_comp'];
                    html += "</b></td>";
                    
                    html += "            <td>";                    
                        if (k[i]['costoc_unit']!=0) html += k[i]['costoc_unit'];
                    html += "</td>";
                    
                    html += "            <td>";
                    
                        if (k[i]['importe_ingreso']!=0) html += k[i]['importe_ingreso'];
                    html += "</td>";
                        
                    html += "            <td>";
                        if (k[i]['num_salida']!=0)  html +=  k[i]['num_salida'];
                    html += "</td>";
                        
                    html += "            <td><b>";
                            if (k[i]['unidad_vend']!=0) html += k[i]['unidad_vend'];
                            
                    html += "</b></td>";
                            
                    html += "            <td>";
                                if (k[i]['costov_unit'] != 0) html += Number(k[i]['costov_unit']).toFixed(2);
                    html +="</td>";
                    
                    html +="            <td>";
                                if (k[i]['importe_salida'] != 0)  html += k[i]['importe_salida'];
                    html +="</td>";
                    html +="            <td><b>"+saldo+"</b></td>";
                    html +="            <td>"+ saldo * k[i]['costoc_unit']+"</td>";
                    html +="            <td></td>";
                    html +="            ";
                    html +="        </tr>";
                
            }

                    html +="    <tr>";
                    html +="    <th></th>";
                    html +="    <th></th>";
                    html +="    <th><small>ENTRADAS</small><br><h5><b>"+total_compras+"</b></h5></th>";
                    html +="    <th></th>";
                    html +="    <th></th>";
                    html +="    <th></th>";
                    html +="    <th><small>SALIDAS</small><br><h5><b>"+total_ventas+"</b></h5></th>";
                    html +="    <th></th>";
                    html +="    <th></th>";
                    html +="    <th></th>";
                    html +="    <th><small>SALDOS</small><br><h5><b>"+saldo+"</b></h5></th>";
                    html +="     <th></th>";
                    html +="    </tr>";
                    
                    $("#tabla_kardex").html(html);
        }
    });
    
}

