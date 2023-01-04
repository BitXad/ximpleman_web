$(document).on("ready",inicio);
function inicio(){
    $('#modeloc_parte1').summernote({
        height: 350,
    });
    $('#modeloc_parte2').summernote({
        height: 350,
    });
}

function registrar_modelocontrato(){
    var base_url  = document.getElementById('base_url').value;
    var controlador = base_url+'modelo_contrato/registrar_modelocontrato';
    let nombre_contrato   = $('#nombre_contrato').val();
    let modeloc_parte1 = $('#modeloc_parte1').summernote('code');
    if(verificar()){
        $.ajax({
                url: controlador,
                type:"POST",
                data:{
                    nombre_contrato:nombre_contrato, 
                    modeloc_parte1:modeloc_parte1, 
                },
                success:function(respuesta){
                    var registros =  JSON.parse(respuesta);
                    if (registros != null){
                        window.location.href = base_url+"modelo_contrato";
                }
            },
            error:function(){
               window.location.href = base_url+"modelo_contrato";
            }
        });
    }else{
        let mensaje = `Este campo es obligatorio`; 
        $('#nombre_contrato').focus();
        $('#nombre_contrato').css('border','1px solid #FF2828');
        $('#mensaje_nombre_contrato').html(mensaje);
    }
}

function verificar(){
    return $('#nombre_contrato').val() == '' ? false:true;
}

/* mostrar el campo modelo compromiso */
function mostrar_compromiso(){
    var beca_id = document.getElementById('beca_id').value;
    if(beca_id == "5"){ //5 = beca deporte
        $("#elmodelo").css("display", "block");
    }else{
        $("#elmodelo").css("display", "none");
    }
}
