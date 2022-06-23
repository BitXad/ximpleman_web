$(document).on("ready",inicio);
function inicio(){
    ultimopedido();
}

/* muestra el ultimo pedido cargado en detalle_ordencompra_aux */
function ultimopedido(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"orden_compra/ultimopedido";
    var html = "";
    //$("#modalproveedor").modal("hide");
    //alert(producto_id);
    $.ajax({url:controlador,
            type:"POST",
            data:{},
            success:function(resultado){
                var registros = JSON.parse(resultado);
                var tam = registros.length;
                html = "";
                
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
                        html += "<td><input  class='input-sm form-control text-right' style='font-size:13px; width:95px;padding-left:0px; padding-right:0px;' id='detallecomp_costo"+registros[i]["detalleordencomp_id"]+"' name='producto_costo"+registros[i]["producto_id"]+"' type='text' onclick='this.select();' onkeypress='actualizadetalle(event,"+registros[i]["detalleordencomp_id"]+","+registros[i]["producto_id"]+","+registros[i]["compra_id"]+")' value='"+Number(registros[i]["detalleordencomp_costo"]).toFixed(2)+"' ></td>";
                        html += "<td>";
                        html += "<input class='input-sm form-control text-right' style='font-size:13px; width:95px; padding-left:0px; padding-right:0px;' id='detallecomp_precio"+registros[i]["detalleordencomp_id"]+"'  name='producto_precio"+registros[i]["producto_id"]+"' type='text' onclick='this.select();' onkeypress='actualizadetalle(event,"+registros[i]["detalleordencomp_id"]+","+registros[i]["producto_id"]+","+registros[i]["compra_id"]+")' value='"+Number(registros[i]["detalleordencomp_precio"]).toFixed(2)+"'></td>"; 
                        html += "<td class='text-center'>"+registros[i]["existencia"]+"</td>",
                        html += "<td style='padding-left:0px; padding-right:0px;'>";
                        html += "<input class='input-sm form-control text-right' style='font-size:13px;width:85px;' id='detallecomp_cantidad"+registros[i]["detalleordencomp_id"]+"'  name='cantidad' autocomplete='off' value='"+registros[i]["detalleordencomp_cantidad"]+"' type='text' onclick='this.select();' onkeypress='actualizadetalle(event,"+registros[i]["detalleordencomp_id"]+")' >";
                        html += "<td><center>";
                        html += "<span class='badge badge-success'>";
                        html += "<font size='2'> <b>"+Number(registros[i]["detalleordencomp_total"]).toFixed(2)+"</b></font> <br>";
                        html += "</span>";
                        
                        /*html += "<br><span class='text-bold' style='white-space: nowrap; font-size: 9px'>";
                        html += mon_secundaria+" "+Number(total_otram).toFixed(2)+"</span>";*/
                        html += "</center></td>";
                        html += "<td style='padding-left:4px; padding-right:4px;'>";
                        
                        html += "<button type='button' onclick='editadetalle("+registros[i]["detalleordencomp_id"]+")' class='btn btn-success btn-xs' title='Guardar modificaciones de este detalle'><span class='fa fa-save'></span></button>";
                        html += "<button type='button' onclick='quitardetalle("+registros[i]["detalleordencomp_id"]+")' class='btn btn-danger btn-xs' title='Eliminar este detalle'><span class='fa fa-trash'></span></button>";
                        html += "</td>";
                        html += "<tr>";
                    }
                    html += "<tr class='text-bold' style='font-size:13px;'>";
                    html += "<td class='text-right' colspan='7'>TOTAL</td>";
                    html += "<td class='text-right'>"+numberFormat(Number(total).toFixed(2))+"</td>";
                    html += "<td></td>";
                    html += "</tr>";
                }
               
                //html += "</table>";
                $("#elproveedor").html(registros[0]["proveedor_nombre"]);
                $("#proveedor_id").val(registros[0]["proveedor_id"]);
                $("#tabla_ultimopedido").html(html);
                //$('#modalultimopedido').modal({backdrop: 'static', keyboard: false})
                //$("#modalultimopedido").modal("show");
               
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_ultimopedido").html(html);
        },
    });
}

function actualizadetalle(e,detalle_id){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        editadetalle(detalle_id);
    }
}

function editadetalle(detalleordencomp_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'orden_compra/update_detalleaux/';
    var costo = document.getElementById('detallecomp_costo'+detalleordencomp_id).value;
    var precio = document.getElementById('detallecomp_precio'+detalleordencomp_id).value;
    var cantidad = document.getElementById('detallecomp_cantidad'+detalleordencomp_id).value;
    
    $.ajax({url: controlador,
            type:"POST",
            data:{detalleordencomp_id:detalleordencomp_id,costo:costo,precio:precio,
                  cantidad:cantidad},
            success:function(respuesta){
                ultimopedido();
            }        
    });
}

function quitardetalle(detalleordencomp_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'orden_compra/eliminar_detalleaux/';
    $.ajax({url: controlador,
            type:"POST",
            data:{detalleordencomp_id:detalleordencomp_id},
            success:function(respuesta){
                ultimopedido();
            }
    });
}

function modal_buscarproducto(){
    $("#buscarproducto").val("");
    $("#tablaresultados_productos").html("");
    $('#modal_buscarproducto').on('shown.bs.modal', function (e) {
        $('#buscarproducto').focus();
    });
    $("#modal_buscarproducto").modal("show");
}

function iniciar_busqueda(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        let buscarproducto = document.getElementById('buscarproducto').value;
        if(buscarproducto != null){
            tabla_productos();
        }
    }
}

function tabla_productos(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'orden_compra/buscar_producto/';
    let buscarproducto = document.getElementById('buscarproducto').value;
    $.ajax({url:controlador,
            type:"POST",
            data:{buscarproducto:buscarproducto},
            success:function(resultado){
                var registros = JSON.parse(resultado);
                var tam = registros.length;
                $("#productos_encontrados").html(tam);
                html = "";
                if(tam>0){
                    for(var i=0; i<tam;i++){
                        html += "<tr id='producto"+registros[i]["producto_id"]+"'>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td style='font-size:12px;'><b>"+registros[i]["producto_nombre"]+"</b></td>";
                        html += "<td style='font-size:10px; text-align:center;'>"+registros[i]["producto_codigo"]+"</td>";
                        html += "<td style='font-size:10px;'>";
                        html += "<input type='text' style='width: 100px !important' id='adetallecosto"+registros[i]["producto_id"]+"' name='adetallecosto"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_ultimocosto"]+"' onclick='this.select();' required >";
                        html += "</td>";
                        html += "<td style='font-size:10px;'>";
                        html += "<input type='text' style='width: 100px !important' id='adetalleprecio"+registros[i]["producto_id"]+"' name='adetalleprecio"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_precio"]+"' onclick='this.select();' required >";
                        html += "</td>";
                        html += "<td style='font-size:10px;'>";
                        html += "<input type='text' style='width: 100px !important' id='adetallecantidad"+registros[i]["producto_id"]+"' name='adetallecantidad"+registros[i]["producto_id"]+"' value='0' onclick='this.select();' onkeyup='calcular_total("+registros[i]["producto_id"]+", event)' required >";
                        html += "</td>";
                        html += "<td style='font-size:10px;'>";
                        html += "<span id='adetalletotal"+registros[i]["producto_id"]+"'>0</span>";
                        html += "</td>";
                        html += "<td style='padding-left:4px; padding-right:4px;'>";
                        html += "<button type='button' onclick='agregar_adetalle("+registros[i]["producto_id"]+")' class='btn btn-success btn-xs' title='Agregar al orden de compra'><span class='fa fa-check'> </span> Añadir</button>";
                        html += "</td>";
                        html += "<tr>";
                    }
                }
                
                $("#tablaresultados_productos").html(html);
                
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_ultimopedido").html(html);
        },
    });
}

function agregar_adetalle(producto_id){
    var costo = document.getElementById('adetallecosto'+producto_id).value;
    var precio = document.getElementById('adetalleprecio'+producto_id).value;
    var cantidad = document.getElementById('adetallecantidad'+producto_id).value;
    
    if(!((costo>=0) && (precio>=0) && (cantidad>0))){
        let mensaje = "";
        if(!(cantidad>0)){
            mensaje = "Cantidad debe ser mayor a cero";
        }
        alert("Costo, precio y Cantidad deben ser Numeros; "+mensaje+" por favor revise sus datos");
    }else{
        var base_url = document.getElementById('base_url').value;
        var proveedor_id = document.getElementById('proveedor_id').value;
        var controlador = base_url+'orden_compra/agregar_adetalle/';
        $.ajax({url:controlador,
                type:"POST",
                data:{producto_id:producto_id, proveedor_id:proveedor_id, costo:costo,
                      precio:precio, cantidad:cantidad},
                success:function(resultado){
                    var registros = JSON.parse(resultado);
                    $("#producto"+producto_id).hide();
                    ultimopedido();
               },error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tabla_ultimopedido").html(html);
            },
        });
    }
}

function calcular_total(producto_id, e){
    let costo    = $("#adetallecosto"+producto_id).val();
    let cantidad = $("#adetallecantidad"+producto_id).val();
    $("#adetalletotal"+producto_id).html(Number(Number(costo) * Number(cantidad)).toFixed(2));
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        if(cantidad>0){
            let buscarproducto = document.getElementById('buscarproducto').value;
            if(buscarproducto != null){
                agregar_adetalle(producto_id);
            }
        }
    }
}

function registrar_ordencompra(){
    var base_url = document.getElementById('base_url').value;
    //var proveedor_id = document.getElementById('proveedor_id').value;
    var controlador = base_url+'orden_compra/registrar_ordencompra/';
    $.ajax({url:controlador,
            type:"POST",
            data:{},
            success:function(resultado){
                var registros = JSON.parse(resultado);
                dir_url_nota = base_url+"orden_compra/nota_ordenp/"+registros;
                window.open(dir_url_nota, '_blank');
                dir_url = base_url+"orden_compra/";
                location.href =dir_url;
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_ultimopedido").html(html);
        },
    });
}

function cancelar_ordencompra(){
    var base_url = document.getElementById('base_url').value;

    var controlador = base_url+'orden_compra/cancelar_ordencompra/';
    $.ajax({url:controlador,
            type:"POST",
            data:{},
            success:function(resultado){
                var registros = JSON.parse(resultado);
                dir_url = base_url+"orden_compra/";
                location.href =dir_url;
                //window.open(dir_url, '_blank');
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_ultimopedido").html(html);
        },
    });
}

function modal_nuevoproducto(){
    //$("#buscarproducto").val("");
    //$("#tablaresultados_productos").html("");
    $('#modal_nuevoproducto').on('shown.bs.modal', function (e) {
        $('#producto_nombre').focus();
        $('#elproveedor_id').val($('#proveedor_id').val());
    });
    $("#modal_nuevoproducto").modal("show");
}

function cambiarcodproducto(){
    var estetime = new Date();
    var anio = estetime.getFullYear();
    anio = anio -2000;
    var mes = parseInt(estetime.getMonth())+1;
    if(mes>0&&mes<10){
        mes = "0"+mes;
    }
    var dia = parseInt(estetime.getDate());
    if(dia>0&&dia<10){
        dia = "0"+dia;
    }
    var hora = estetime.getHours();
    if(hora>0&&hora<10){
        hora = "0"+hora;
    }
    var min = estetime.getMinutes();
    if(min>0&&min<10){
        min = "0"+min;
    }
    var seg = estetime.getSeconds();
    if(seg>0&&seg<10){
        seg = "0"+seg;
    }
    $('#producto_codigobarra').val(anio+mes+dia+hora+min+seg);
    $('#producto_codigo').val(anio+mes+dia+hora+min+seg);
}
function registrarnuevacategoria(){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    var parametro = document.getElementById('nueva_categoria').value;
    controlador = base_url+'producto/aniadircategoria/';
    $('#modalcategoria').modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                    html = "";
                    html += "<option value='"+registros["categoria_id"]+"' selected >";
                    html += registros["categoria_nombre"];
                    html += "</option>";
                    $("#categoria_id").append(html);
                    mostrar_subcategoriaproducto(registros["categoria_id"]);
            }
        },
        error:function(respuesta){
           html = "";
           $("#categoria_id").html(html);
        }
        
    });   

}
/* funcion que recupera las subcategorias de una categoria de producto */
function mostrar_subcategoriaproducto(categoria_id){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    controlador = base_url+'producto/obtener_subcategoria/';
    $.ajax({url: controlador,
           type:"POST",
           data:{categoria_id:categoria_id},
           success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    html = "";
                    html += "<select name='subcategoria_id' class='form-control' id='subcategoria_id'>";
                    html += "<option value='' selected>- SUB CATEGORIA -</option>";
                    for (var i = 0; i < n ; i++){
                        html += "<option value='"+registros[i]["subcategoria_id"]+"'>";
                        html += registros[i]["subcategoria_nombre"];
                        html += "</option>";
                    }
                    html += "</select>";
                    //$("#subcategoria_id").append(html);
                    $("#subcategoria_id").replaceWith(html);
                    html1 ="";
                    html1 +="<a data-toggle='modal' data-target='#modalsubcategoria' class='btn btn-warning' title='Registrar Nueva Sub Categoria'>";
                    html1 +="<i class='fa fa-plus-circle'></i></a>";
                    $("#parasubcat").replaceWith(html1);
            }
        },
        error:function(respuesta){
           html = "";
           $("#producto_nombreenvase").html(html);
        }
    });   
}

/* registra nuevas sub-categorias */
function registrarnuevasubcategoria(){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    var categoria_id = document.getElementById('categoria_id').value;
    var parametro = document.getElementById('nueva_subcategoria').value;
    controlador = base_url+'producto/aniadirsubcategoria/';
    $('#modalsubcategoria').modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, categoria_id:categoria_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    html = "";
                    html += "<option value='"+registros["subcategoria_id"]+"' selected >";
                    html += registros["subcategoria_nombre"];
                    html += "</option>";
                    $("#subcategoria_id").append(html);
                    //mostrar_subcategoriaproducto(registros["categoria_id"]);
                    $("#nueva_subcategoria").val("");
            }
        },
        error:function(respuesta){
           html = "";
           $("#subcategoria_id").html(html);
        }
    });
}

function calcular_preciov(numero){
    let costo   = $("#producto_costo").val();
    let porcent = $("#porcentaje").val();
    $("#producto_precio").val(Number(costo*porcent)+Number(costo));
}

function calcular_preciov_porcent(numero){
    //let costo   = $("#producto_costo").val();
    let porcent = $("#porcentaje").val();
    var estecosto = $("#producto_costo").val();
    $("#producto_precio").val(Number(estecosto*porcent)+Number(estecosto));
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

