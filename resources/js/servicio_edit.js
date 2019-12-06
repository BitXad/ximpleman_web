/* Funcion que registra hora de finalizacion(REGISTRO) de servicio y manda su comprobante */
function ponerdescripcion(subcatserv_id){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"subcategoria_servicio/getprecio_subcategoriaserv";
    $.ajax({url: controlador,
           type:"POST",
           data:{subcatserv_id:subcatserv_id},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    $('#detalleserv_total').val(registros['subcatserv_precio']);
                    $('#detalleserv_saldo').val(registros['subcatserv_precio']);
         //$('#catserv_id').val();
         $('#subcatserv_id').val();
         $('#detalleserv_descripcion').val($('#catserv_id option:selected').text()+' '+$('#subcatserv_id option:selected').text());
         $('#detalleserv_descripcion').focus();
         
                }else{
                        alert("No se encontro el precio de la marca/modelo elejido");
                    }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });
}
