function buscarproducto(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
        tablaproducto();    
    }
}

function tablaproducto()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto_preferencia/buscarproducto';
    var producto_id = document.getElementById('producto_id').value
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:producto_id},
            success:function(respuesta){
                $("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    /*var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;*/
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>N</th>";
                    //html += "<th>ID</th>";
                    html += "<th>Producto</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "<div class='col-md-12'>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<button type='button' onclick='repoproducto("+registros[i]["producto_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-search'></i></button>";
                        //html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                        html += "</tbody>"
                   $("#tablareproducto").html(html);
                   $('#modalbuscarproducto').modal('show');
                    //document.getElementById('tablas').style.display = 'block';
            }else{
                
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
    });
}
