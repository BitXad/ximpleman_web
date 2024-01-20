$(document).on("ready",inicio);
function inicio(){
    /*$('#modaldetalle').modal('show');
    var servicio_id = document.getElementById('esteservicio_id').value;
    resultadodetalleservicionew(servicio_id);*/
} 
/*
 * Funcion que buscara productos en la tabla productos
 */
function buscarconenter(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        if (opcion==1){
            buscarunidades();
        }
        if (opcion==2){
            buscarprogramas();
        }
    } 

    
}
/* buscar unidades */
function buscarunidades(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/buscar_pedidounidadparam";
    var parametro = document.getElementById('filtrar').value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                $("#encontrados").val("- 0 -");
                registros = JSON.parse(respuesta);
                n = registros.length;
                $("#encontrados").val("- "+n+" -");
                html = "";
                
                for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["unidad_nombre"]+"</b></font>";
                        html += "</td>";
                        html += "<td>";
                        //var nombre = '"'+registros[i]["unidad_nombre"]+'"';
                        html += "<button onclick='asignarunidad(" +registros[i]["unidad_id"]+")' class='btn btn-success btn-xs' >";
                        html += "<i class='fa fa-check'></i> Elegir Unidad";
                        html += "</button>";
                        html += "<input type='hidden' value='"+registros[i]["unidad_nombre"]+"' id='unidad_nombre"+registros[i]["unidad_id"]+"'>";
                        html += "</td>";
                        html += "</tr>";
                   }
                   $("#tablaresultados").html(html);

            },
            error: function(respuesta){
            }
        });
}

/* asignar unidad */
function asignarunidad(unidad_id){
    var unidad_n = $("#unidad_nombre"+unidad_id).val();
    $("#unidad_id").val(unidad_id);
    $("#unidad_nombre").val(unidad_n);
    $("#modalbuscarunidad").modal('hide');
}
/* buscar programas */
function buscarprogramas(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/buscar_pedidoprogramaparam";
    var parametro = document.getElementById('filtrarp').value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                $("#encontradosp").val("- 0 -");
                registros = JSON.parse(respuesta);
                n = registros.length;
                $("#encontradosp").val("- "+n+" -");
                html = "";
                
                for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["programa_nombre"]+"</b></font>";
                        html += "</td>";
                        html += "<td>";
                        //var nombre = '"'+registros[i]["programa_nombre"]+'"';
                        html += "<button onclick='asignarprograma(" +registros[i]["programa_id"]+")' class='btn btn-success btn-xs' >";
                        html += "<i class='fa fa-check'></i> Elegir Programa";
                        html += "</button>";
                        html += "<input type='hidden' value='"+registros[i]["programa_nombre"]+"' id='programa_nombre"+registros[i]["programa_id"]+"'>";
                        html += "</td>";
                        html += "</tr>";
                   }
                   $("#tablaresultadosp").html(html);

            },
            error: function(respuesta){
            }
        });
}

/* asignar unidad */
function asignarprograma(programa_id){
    var programa_n = $("#programa_nombre"+programa_id).val();
    $("#programa_id").val(programa_id);
    $("#programa_nombre").val(programa_n);
    $("#modalbuscarprograma").modal('hide');
}