
/* verifica la existencia de todos los insumos en Inventario (Almacen) */
function cargar_precios(){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'producto_precios/cargar_precios';
    
    var r = confirm("ADVERTENCIA: Esta operación eliminará y reemplazara la lista actual. \n ¿Desea Continuar?");

    if (r == true) {


            $.ajax({url: controlador,
                type:"POST",
                data:{},
                success:function(respuesta){

                    let res = JSON.parse(respuesta);                            

                    if (res) {
                        
                        alert("Los datos fueron cargados con éxito...!");
                        location.reload();
                        
                    }else{
                        
                        alert("ADVERTENCIA: Ocurrio un problema al cargar los datos, verifique el arhivo de datos y vuelva a intentar;");
                        
                    }
                },
                error:function(respuesta){
                    res = 0;
                }
            });     

    }else{                   

    }   
    
}

