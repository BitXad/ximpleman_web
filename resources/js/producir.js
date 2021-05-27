function elegirformula(){
    var formula_id = document.getElementById('formula_id').value;
    var laformula = JSON.parse(document.getElementById('laformula').value);
    
    var n = laformula.length;
    for (var i = 0; i < n ; i++){
        if(laformula[i]["formula_id"] == formula_id){
            $("#formula_unidad").val(laformula[i]["formula_unidad"]);
            $("#formula_cantidad").val(laformula[i]["formula_cantidad"]);
            $("#formula_costounidad").val(laformula[i]["formula_costounidad"]);
            $("#formula_preciounidad").val(laformula[i]["formular_preciounidad"]);
            break;
        }
    }
    
}

function calcularformula(){
    var base_url    = document.getElementById('base_url').value;
    var formula_id  = document.getElementById('formula_id').value;
    var controlador = base_url+'produccion/buscardetalleformula';
    if(formula_id >0){
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{formula_id:formula_id},
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

function producir(){
    var base_url    = document.getElementById('base_url').value;
    var formula_id  = document.getElementById('formula_id').value;
    var controlador = base_url+'produccion/buscardetalleformula';
    if(formula_id >0){
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{formula_id:formula_id},
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
