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
    var parametro_id = document.getElementById('elparametro_id').value;
    var parametro_tipoemision = document.getElementById('elparametro_tipoemision').value;
    var controlador = base_url+'parametro/cambiar_tipoemision';
    
    document.getElementById('loader_documento').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro_tipoemision:parametro_tipoemision, parametro_id:parametro_id},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                $("#modal_tipoemision").modal("hide");
                location.reload();
                
                if(parametro_tipoemision == 1){
                    
                    var mensaje;                    
                    var opcion = confirm("ADVERTENCIA: Debe actualizar el CUFD, continuar?");
                    if (opcion == true) {
                        window.location.href = base_url+"punto_venta";
                    }
                
//                       else {
//                            mensaje = "Has clickado Cancelar";
//                        }
//                        document.getElementById("ejemplo").innerHTML = mensaje;
                }
                
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
