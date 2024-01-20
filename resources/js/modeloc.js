function modal_modelocontrato(modeloc_id){
    var modelo_contrato = document.getElementById('contrato_elegido'+modeloc_id).value;
    $("#eltitulo").html("Modelo Contrato");
    $("#ver_modelocontrato").html(modelo_contrato);
    $("#modalmodelocontrato").modal("show");
}

function modal_modelocompromiso(modeloc_id){
    var modelo_compromiso = document.getElementById('compromiso_elegido'+modeloc_id).value;
    $("#eltitulo").html("Modelo Compromiso");
    $("#ver_modelocontrato").html(modelo_compromiso);
    $("#modalmodelocontrato").modal("show");
}
