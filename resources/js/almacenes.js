
function verificar_conexion(base_datos)
{
    var base_url   = document.getElementById('base_url').value; 
    var controlador = base_url+"Sucursales/verificar_conexion";
    
    var base = base_datos; 
    
    $.ajax({url:controlador,
        type:"POST",
        data:{base:base },
        success: function(response){
           // alert("Dondeeee");
            var registros =  JSON.parse(response);
    
            if (registros.length>0)
                alert("La conexión a la base de datos: "+base_datos+" \n\n ****** SATISFACTORIA *****");
            
        },
        error:function (response){
            alert("FALLO al intentar conectar a la base de datos: "+base_datos);
        }
    });
    
}