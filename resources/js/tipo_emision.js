/*$(document).on("ready",inicio);
function inicio(){
    tablaresultadostoken(1);
}*/
/* muestra un modal para cambiar el tipo de emisiono */
function modal_cambiartipoemision(){
    $("#modal_tipoemision").modal("show");
}


function cambiar_tipoemision()
{
    var base_url = document.getElementById('base_url').value;
    let parametro_id = document.getElementById('elparametro_id').value;
    let parametro_tipoemision = document.getElementById('elparametro_tipoemision').value;
    var controlador = base_url+'parametro/cambiar_tipoemision';
    
    document.getElementById('loader_documento').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro_tipoemision:parametro_tipoemision, parametro_id:parametro_id},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                $("#modal_tipoemision").modal("hide");
                location.reload();
                //document.getElementById('loader_documento').style.display = 'none';
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
               document.getElementById('loader_documento').style.display = 'none';
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader_documento').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
}
