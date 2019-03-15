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
/*
function validar2(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla == 17){
        if (opcion==2){
            buscarsubcategorias();
        }
        
    } 

    
} */

/* buscar sub-categorias */
/*
function buscarsubcategorias(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"subcategoria_servicio/buscar_subcategoriaparam";
    var parametro = document.getElementById('subcatserv_id').value;
    var catserv_id = document.getElementById('catserv_id').value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro, catserv_id:catserv_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["subcatserv_id"]+"' label='"+resultado[i]["subcatserv_descripcion"];
                 //   if (resultado[i]["subcatserv_descripcion"]!=null)
                 //   {    html += " ("+resultado[i]["subcatserv_descripcion"]+")"; }
                    html += "'>"+resultado[i]["subcatserv_descripcion"]+"</option>";
                }    
                $("#listasubcatserv").html(html);

            },
            error: function(respuesta){
            }
        });
} */
/* seleccionar sub-categoria */
/*
function seleccionar_subcategoria(){
    var subcatserv_id = document.getElementById('subcatserv_id').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"subcategoria_servicio/seleccionar_subcategoria/";
        $.ajax({url: controlador,
            type:"POST",
            data:{subcatserv_id:subcatserv_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
//                alert(resultado[0]["cliente_nit"]);
                
                if (tam>=1){
                    $("#subcatserv_id").val(resultado[0]["subcatserv_descripcion"]);
                    $("#estesubcatserv_id").val(resultado[0]["subcatserv_id"]);
                   var res = $("#detalleserv_descripcion").val();
                   $('#detalleserv_total').val(resultado[0]['subcatserv_precio']);
                    $('#detalleserv_saldo').val(resultado[0]['subcatserv_precio']);
                    $("#detalleserv_descripcion").val(res+" "+resultado[0]["subcatserv_descripcion"]);
                    $('#detalleserv_descripcion').focus();
                    $('#detalleserv_descripcion').focus();
                }
                
            },
            error: function(respuesta){
            }
        });    
    
} */