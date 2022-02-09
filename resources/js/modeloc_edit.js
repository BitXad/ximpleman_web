var base_url;
$(document).on("ready",inicio);

function inicio(){
    base_url  = $('#base_url').val();
    $("#elmodelo").css("display", "block");
    let elmodelo_contrato1 = $('#elmodelo_contrato1').val();
    $('#modeloc_parte1').summernote({
        height: 350,
    });
    $('#modeloc_parte1').summernote('code', elmodelo_contrato1);
}

function modificar_modelocontrato(modcontrato_id){
    let controlador = `${base_url}modelo_contrato/modificar_modelocontrato`;
    let modcontrato_contrato = $('#modeloc_parte1').summernote('code');
    let modcontrato_nombre = $('#nombre_contrato').val(); 
    let estado_id = $('#estado_id').val();
    $.ajax({url: controlador,
            type: "POST",
            data:{
                estado_id:estado_id,
                modcontrato_nombre:modcontrato_nombre,
                modcontrato_id:modcontrato_id, 
                modcontrato_contrato:modcontrato_contrato,
            },
            success:(respuesta)=>{
                var registros =  JSON.parse(respuesta);
                if (registros != null)
                    window.location.href = `${base_url}modelo_contrato`;
        },
        error:()=>{
            window.location.href = `${base_url}modelo_contrato`;
        }
    });
}