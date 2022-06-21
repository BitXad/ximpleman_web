$(document).on("ready",inicio);
function inicio(){
    tablaresultadosproducto();
}

//Tabla resultados de la busqueda en el index de producto
function tablaresultadosproducto()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'orden_compra/buscarproductosexistmin/';
    var parametro = "";
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    //var formaimagen = document.getElementById('formaimagen').value;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").html(n);
                    html = "";
                    let cont = 1;
                    let band = true;
                    for (var i = 0; i < n ; i++){
                        if(cont <= 3){
                            html += "<tr>";
                            html += "<td style='padding: 0;' class='text-center'>"+(cont)+"</td>";
                            html += "<td style='padding: 0;'>";
                            html += registros[i]['producto_nombre'];
                            html += "</td>";
                            html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['producto_codigo']+"</td>";
                            html += "<td style='padding: 2px;' class='text-center'><font size='2'><b>"+Number(registros[i]['existencia']).toFixed(2)+"</b></font></td>";
                            html += "</tr>";
                        }else if (band == true){
                            html += "<tr>";
                            html += "<td class='text-left' colspan='4'>";
                            html += ".<br>";
                            html += ".<br>";
                            html += ".<br>";
                            html += "</td>";
                            html += "</tr>";
                            band = false;
                        }
                        cont++;
                    }
                    html += "<tr>";
                    html += "<td class='text-left' colspan='4'>";
                    html += "<span class='text-bold'>Total con existencia minima: "+n+" </span>Productos" ;
                    html += "&nbsp;&nbsp;&nbsp;<a href='"+base_url+"orden_compra/existenciaminima'>Ver mas..</a>";
                    html += "</td>";
                    html += "</tr>";
                    $("#tabla_existenciaminima").html(html);
                    document.getElementById('loader').style.display = 'none';
                }
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tabla_existenciaminima").html(html);
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
}

function mostrar_historial(producto_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"orden_compra/historial_proveedores";
    var html = "";
    //alert(producto_id);
    $.ajax({url:controlador,
            type:"POST",
            data:{producto_id:producto_id},
            success:function(resultado){
                var reg = JSON.parse(resultado);
                var tam = reg.length;
                //alert(reg.length);
                html = "";               
                html += "<table class='table' id='mitabla'>";
                html += "<tr>";
                html += "<th>#</th>";
                html += "<th>Proveedor</th>";
                html += "<th></th>";
                html += "</tr>";
                if(tam>0){
                    for(var i=0; i<tam;i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>"+reg[i].proveedor_nombre+"</td>";
                        //html += "<td><b>"+Number(reg[i].detallecomp_costo).toFixed(2)+"</b></td>";
                        //html += "<td>"+formato_fecha(reg[i].compra_fecha)+"</td>";
                        html += "<td>";
                        html += "<a class='btn btn-facebook btn-xs' onclick='mostrar_ultimopedido("+producto_id+", "+reg[i].proveedor_id+")' title='Replicar el ultimo pedido del producto' ><fa class='fa fa-file-text'></fa></a> ";
                        html += " <a class='btn btn-info btn-xs' onclick='mostrar_todopedido("+reg[i].proveedor_id+")' title='Mostrar todo lo que se compra del proveedor'><fa class='fa fa-files-o'></fa></a>";
                        html += "</td>";
                        html += "</tr>";
                    }
                }
               
                html += "</table>";
                $("#tabla_historial").html(html);
                $("#modalproveedor").modal("show");
               
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_historial").html(html);
        },
    });
    
}
/* muestra el ultimo pedido realizado donde se encuentra el producto seleccionado!. */
function mostrar_ultimopedido(producto_id, proveedor_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"orden_compra/proveedor_ultimopedido";
    var html = "";
    $("#modalproveedor").modal("hide");
    //alert(producto_id);
    $.ajax({url:controlador,
            type:"POST",
            data:{producto_id:producto_id, proveedor_id:proveedor_id},
            success:function(resultado){
                var reg = JSON.parse(resultado);
                let compra_id = reg[0].compra_id;
                dir_url = base_url+"orden_compra/nota/"+compra_id;
                //dir_url = base_url+"orden_compra/ultimo_pedido";
                location.href =dir_url;
                
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