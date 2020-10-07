
/* función que verifica si una unidad esta siendo usado en un producto!.. */
function verificar_usounidad(unidad_id, nombre_unidad){
    var base_url = document.getElementById('base_url').value;
    
    var controlador = base_url+'unidad/verificar_uso/';
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
           type:"POST",
           data:{nombre_unidad:nombre_unidad},
           success:function(respuesta){    
               
            //$("#encontrados").val("- 0 -");
            var registros =  JSON.parse(respuesta);
            if (registros != null){
                var n = registros.length; //tamaño del arreglo de la consulta
                if(n>0){
                    $("#esusado"+unidad_id).html("Esta unidad esta siendo usado en algunos productos!<br>al elimar esta unidad, los productos que usen esta unida se quedaran sin unidad!....");
                }else{
                    $("#esusado"+unidad_id).html("");
                }
                //document.getElementById('loader').style.display = 'none';
            }
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#esusado"+unidad_id).html(html);
        },
        complete: function (jqXHR, textStatus) {
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });   

}
