$(document).on("ready",inicio);
function inicio(){
    var estado_id = document.getElementById('estado_id').value;
    var caja_id   = document.getElementById('caja_id').value;
    if(estado_id == 30){
        modal_cajaabierta();
    }else{
        modal_cajapendiente();
    }
}

function modal_cajapendiente(){
    /*$("#mensaje_nombre").html("");
    $("#ordendia_nombre").val("");
    $("#ordendia_asistencia").prop('checked', false);
    $('#modalnuevaorden').on('shown.bs.modal', function (e) {
       $('#ordendia_nombre').focus();
    });*/
    $("#modalmensaje").modal('show');
}

function modal_cajaabierta(){
    /*$("#mensaje_nombre").html("");
    $("#ordendia_nombre").val("");
    $("#ordendia_asistencia").prop('checked', false);
    $('#modalnuevaorden').on('shown.bs.modal', function (e) {
       $('#ordendia_nombre').focus();
    });*/
    $("#myModal").modal('show');
}
