/* funcion que hace la entrega de pedidos */
function entregarpedido(venta_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'pedido/entregarpedido';
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{venta_id:venta_id},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                   location.reload();
                   window.open(base_url+"factura/imprimir_recibo/"+venta_id, '_blank');
                }
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           //$("#tablaresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });   

}
