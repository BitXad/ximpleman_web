function elegirformula(){
    var formula_id = document.getElementById('formula_id').value;
    var laformula = JSON.parse(document.getElementById('laformula').value);
    
    var n = laformula.length;
    for (var i = 0; i < n ; i++){
        if(laformula[i]["formula_id"] == formula_id){
            $("#formula_unidad").val(laformula[i]["formula_unidad"]);
            $("#formula_cantidad").val(laformula[i]["formula_cantidad"]);
            $("#formula_costounidad").val(laformula[i]["formula_costounidad"]);
            $("#formula_preciounidad").val(laformula[i]["formula_preciounidad"]);
            break;
        }
    }
    
}

function calcularformula(){
    var base_url    = document.getElementById('base_url').value;
    var formula_id  = document.getElementById('formula_id').value;
    var formula_unidad  = document.getElementById('formula_unidad').value;
    var formula_cantidad  = document.getElementById('formula_cantidad').value;
    var formula_costounidad  = document.getElementById('formula_costounidad').value;
    var formula_preciounidad = document.getElementById('formula_preciounidad').value;
    var controlador = base_url+'produccion/buscardetalleformula';
    if(formula_id >0){
        if(formula_cantidad >0){
        var verif_existencia =[];
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{formula_id:formula_id, formula_unidad:formula_unidad, formula_cantidad:formula_cantidad,
                  formula_costounidad:formula_costounidad, formula_preciounidad:formula_preciounidad},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var formula_cantidad  = document.getElementById('formula_cantidad').value;
                    var eltotal = Number(0);
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").html("Registros Encontrados: "+n+" ");
                    html = "";
                    for (var i = 0; i < n ; i++){
                        verif_existencia.push({producto_id:registros[i]["producto_id"], cantidad:Number(registros[i]["detalleformula_cantidad"])*Number(formula_cantidad)});
                        eltotal += Number(registros[i]["detalleformula_costo"])*Number(Number(registros[i]["detalleformula_cantidad"])*Number(formula_cantidad));
                        total = Number(Number(registros[i]["detalleformula_costo"])*Number(Number(registros[i]["detalleformula_cantidad"])*Number(formula_cantidad))).toFixed(2);
                        html += "<tr>";
                        //html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<div id='horizontal'>";
                        html += "<div style='padding-left: 4px'>";
                        var tamaniofont = 3;
                        if(registros[i]["producto_nombre"].length >50){
                            tamaniofont = 1;
                        }
                        html += "<b id='masgrande'><font size='"+tamaniofont+"' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font></b><sub> ["+registros[i]["producto_id"]+"]</sub>";
                        
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td class='text-right'>";
                        html += Number(registros[i]["detalleformula_costo"]).toFixed(2);
                        html += "</td>";
                        html += "<td class='text-center'>";
                        html += Number(registros[i]["detalleformula_cantidad"])*Number(formula_cantidad);
                        html += "</td>";
                        html += "<td class='text-right'>";
                        html += total;
                        html += "</td>";
                        html += "</tr>";
                   }
                   html += "<tr>";
                   html += "<th colspan='3' style='text-align: right; font-size: 13px'>TOTAL:</th>";
                   html += "<th colspan='3' style='text-align: right; font-size: 13px'>"+Number(eltotal).toFixed(2)+"</th>";
                   html += "</tr>";
                   $("#detalle_deformula").html(html);
                   verificar_existencia(verif_existencia);
                   document.getElementById('loader').style.display = 'none';
            }else{
                $("#detalle_deformula").html("");
                alert("La Formula elegida no tiene insumos!.");
            }
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#detalle_deformula").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });
    }else{
        alert("Cantidad a Producir debe ser mayor a 0");
    }
    }else{
        alert("Por favor primero elija una Fórmula");
    }
}
/* verifica la existencia de todos los insumos en Inventario (Almacen) */
function verificar_existencia(verif_existencia){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'produccion/verificar_existencia';
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{verif_existencia:verif_existencia},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var max = registros.length;
                    var mensaje = ""
                    html = "";
                    for (var i = 0; i < max; i++) {
                        html += "<tr>";
                        html += "<td>"+registros[i]["producto_nombre"]+"</td>";
                        html += "<td class='text-right'>"+registros[i]["cantidad"]+"</td>";
                        html += "<td class='text-right'>"+registros[i]["existencia"]+"</td>";
                        html += "<td class='text-right'>"+registros[i]["falta"]+"</td>";
                        html += "</tr>";
                    }
                    $("#tablamensaje").html(html);
                    $('#modalmensaje').modal('show');
                   document.getElementById('loader').style.display = 'none';
                }else{
                    $("#paraproducir").removeClass("disabled");
                    //$("#parrafo").removeClass("rojo");
                }
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           //$("#detalle_deformula").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });
}

/* funcion que registra el producto producido */
function producir(){
    var formula_id  = document.getElementById('formula_id').value;
    if(formula_id >0){
        var formula_unidad = document.getElementById('formula_unidad').value;
        var formula_cantidad = document.getElementById('formula_cantidad').value;
        var formula_preciounidad = document.getElementById('formula_preciounidad').value;
        var formula_costounidad = document.getElementById('formula_costounidad').value;
        var base_url    = document.getElementById('base_url').value;
        var controlador = base_url+'produccion/registrar_productoproducido';
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{formula_id:formula_id, formula_unidad:formula_unidad, formula_cantidad:formula_cantidad,
                  formula_preciounidad:formula_preciounidad, formula_costounidad:formula_costounidad},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var formula_cantidad  = document.getElementById('formula_cantidad').value;
                    var eltotal = Number(0);
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").html("Registros Encontrados: "+n+" ");
                    html = "";
                    for (var i = 0; i < n ; i++){
                        eltotal += Number(registros[i]["detalleformula_costo"])*Number(Number(registros[i]["detalleformula_cantidad"])*Number(formula_cantidad));
                        total = Number(Number(registros[i]["detalleformula_costo"])*Number(Number(registros[i]["detalleformula_cantidad"])*Number(formula_cantidad))).toFixed(2);
                        html += "<tr>";
                        //html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<div id='horizontal'>";
                        html += "<div style='padding-left: 4px'>";
                        var tamaniofont = 3;
                        if(registros[i]["producto_nombre"].length >50){
                            tamaniofont = 1;
                        }
                        html += "<b id='masgrande'><font size='"+tamaniofont+"' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font></b><sub> ["+registros[i]["producto_id"]+"]</sub>";
                        
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td class='text-right'>";
                        html += Number(registros[i]["detalleformula_costo"]).toFixed(2);
                        html += "</td>";
                        html += "<td class='text-center'>";
                        html += Number(registros[i]["detalleformula_cantidad"])*Number(formula_cantidad);
                        html += "</td>";
                        html += "<td class='text-right'>";
                        html += total;
                        html += "</td>";
                        html += "</tr>";
                   }
                   html += "<tr>";
                   html += "<th colspan='3' style='text-align: right; font-size: 13px'>TOTAL:</th>";
                   html += "<th colspan='3' style='text-align: right; font-size: 13px'>"+Number(eltotal).toFixed(2)+"</th>";
                   html += "</tr>";
                   $("#detalle_deformula").html(html);
                   document.getElementById('loader').style.display = 'none';
            }
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#detalle_deformula").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });
    }else{
        alert("Por favor primero elija una Fórmula");
    }
}
