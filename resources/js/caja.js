$(document).on("ready",inicio);
function inicio(){
    var estado_id = document.getElementById('estado_id').value;
    //var caja_id   = document.getElementById('caja_id').value;
    if(estado_id == 30){
        modal_mensajecaja();
        //modal_cajaabierta();
    }else{
        modal_cajapendiente();
    }
}

function modal_mensajecaja(){
    $("#modal_mensajecaja").modal('show');
}

function modal_cajapendiente(){
    $("#modalmensaje").modal('show');
}

function modal_cajaabierta(){
    $("#elmensaje").html("");
    $("#myModal").modal('show');
}

function abrir_lacaja()
{
    var base_url   = document.getElementById('base_url').value; 
    var monto_caja = document.getElementById('monto_caja').value; 
    var caja_id    = document.getElementById('caja_id').value; 
    var controlador = base_url+"caja/abrir_lacaja";
    $.ajax({url:controlador,
        type:"POST",
        data:{monto_caja:monto_caja, caja_id:caja_id},
        success: function(response){
            var registros =  JSON.parse(response);
            if(registros == "no"){
                $("#elmensaje").html("El monto no debe ir vacio");
            }else{
                $("#myModal").modal('hide');
            }
        },
        error:function (response){
            alert("ocurrio un error ");
        }
    });
}