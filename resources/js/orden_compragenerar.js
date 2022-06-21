/*$(document).on("ready",inicio);
function inicio(){
    tablaresultadosproducto(1);
}*/

function generar_ordencompra(){
    var base_url = document.getElementById('base_url').value;
    var compra_id = document.getElementById('compra_id').value;
    var controlador = base_url+"orden_compra/generar_ordencompradirecta";
    var html = "";
    //alert(producto_id);
    document.getElementById('loader').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{compra_id:compra_id},
            success:function(resultado){
                var reg = JSON.parse(resultado);
                if(reg>0){
                    alert("Orden de compra generado con éxito!.")
                    dir_url = base_url+"orden_compra/nota_orden/"+reg;
                    location.href =dir_url;
                    document.getElementById('loader').style.display = 'none';
                }
               document.getElementById('loader').style.display = 'none';
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           document.getElementById('loader').style.display = 'none';
           html = "";
           $("#tabla_historial").html(html);
           document.getElementById('loader').style.display = 'none';
        },
    });
}

function crear_ordencompra(){
    var base_url = document.getElementById('base_url').value;
    var compra_id = document.getElementById('compra_id').value;
    var controlador = base_url+"orden_compra/crear_ordencompra";
    var html = "";
    document.getElementById('loader').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{compra_id:compra_id},
            success:function(resultado){
                var reg = JSON.parse(resultado);
                if(reg != null){
                    //alert("Orden de compra generado con éxito!.")
                    dir_url = base_url+"orden_compra/ultimo_pedido";
                    location.href =dir_url;
                    document.getElementById('loader').style.display = 'none';
                }
               document.getElementById('loader').style.display = 'none';
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           document.getElementById('loader').style.display = 'none';
           html = "";
           $("#tabla_historial").html(html);
           document.getElementById('loader').style.display = 'none';
        },
    });
}