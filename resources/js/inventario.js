/* 
 *  Realizado por: Roberto Carlos Soto S.
 *  Fecha: 15/01/2019
 */
//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
$(document).on("ready",inicio);
function inicio(){
      //  tabla_inventario();
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
                    html += "             	<td><center> <font size='2'><b>"+ total.toFixed(2)+"</b></font></center></td>";
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
                    html += "             	<td><center> <font size='2'><b>"+ total.toFixed(2)+"</b></font></center></td>";
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
                alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
    });   
      
}
