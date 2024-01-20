$(document).on("ready",inicio);
function inicio(){
    tablaresultadosproducto(1);
}

//Tabla resultados de la busqueda en el index de producto
function tablaresultadosproducto(limite)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'orden_compra/buscarproductosexistmin/';
    var parametro = "";
    //var controlador = "";
    /*var categoriatext = "";
    var estadotext = "";
    var categoriaestado = "";**/
    if(limite == 2){
        parametro = document.getElementById('filtrar').value;
    }
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                $("#encontrados").html("0");
                var registros =  JSON.parse(respuesta);
                var color =  "";
                if (registros != null){
                    //var formaimagen = document.getElementById('formaimagen').value;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").html(n);
                    html = "";
                    for (var i = 0; i < n ; i++){
                        if (Number(registros[i]['existencia'])>0){
                            color = "style='background-color: #60db94; '";
                        }else{                            
                            color = "style='background-color: #e37d66; '"; //ebda99a
                        }
                        html += "<tr "+color+">";
                        html += "<td style='padding: 0;' class='text-center'>"+(i+1)+"</td>";
                        html += "<td style='padding: 0;'>";
                        html += registros[i]['producto_nombre'];
                        html += "</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['producto_codigo']+"</td>";
                        html += "<td style='padding: 2px;' class='text-right'>"+Number(registros[i]['producto_ultimocosto']).toFixed(2)+"</td>";
                        html += "<td style='padding: 2px;' class='text-right'>"+Number(registros[i]['producto_precio']).toFixed(2)+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'><font size='2'><b>"+Number(registros[i]['existencia']).toFixed(2)+"</b></font></td>";
                        //html += "<td style='padding: 2px;'>"+registros[i]['moneda_descripcion']+"</td>";
                        //html += "<td style='padding: 2px;'>"+registros[i]['categoria_nombre']+"</td>";
                        html += "<td style='padding: 2px;' class='no-print'><button class='btn btn-info btn-xs' onclick='mostrar_historial("+registros[i]['producto_id']+")'><fa class='fa fa-users'></fa></button></td>";
                        html += "</tr>";
                    }
                    $("#tablaresultados").html(html);
                    document.getElementById('loader').style.display = 'none';
                }
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
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
                        //html += " <a class='btn btn-info btn-xs' onclick='mostrar_todopedido("+reg[i].proveedor_id+")' title='Mostrar todo lo que se compra del proveedor'><fa class='fa fa-files-o'></fa></a>";
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

