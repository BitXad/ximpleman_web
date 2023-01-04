$(document).on("ready",inicio);

function inicio(){
        fechacotizacion();
}

/*aumenta un cero a un digito; es para las horas*/
function aumentar_cero(num){
    if (num < 10) {
        num = "0" + num;
    }
    return num;
}
/*aumenta un cero a un digito; es para las horas*/
function mes_literal(mes){
    var nombre = "";
    if(mes == 1){
        nombre = "Enero";
    }else if(mes == 2){
        nombre = "Febrero";
    }else if(mes == 3){
        nombre = "Marzo";
    }else if(mes == 4){
        nombre = "Abril";
    }else if(mes == 5){
        nombre = "Mayo";
    }else if(mes == 6){
        nombre = "Junio";
    }else if(mes == 7){
        nombre = "Julio";
    }else if(mes == 8){
        nombre = "Agosto";
    }else if(mes == 9){
        nombre = "Septiembre";
    }else if(mes == 10){
        nombre = "Octubre";
    }else if(mes == 11){
        nombre = "Noviembre";
    }else if(mes == 12){
        nombre = "Diciembre";
    }
    return nombre;
}
function fechacotizacion(){
    var fecha = document.getElementById('fecha_cotizacion').value;
    var fcot = new Date(fecha+"T12:00:00-06:00");
    var info = "";
    if(fecha != null){
       info = "Cochabamba, "+aumentar_cero(fcot.getDate())+" de "+mes_literal((fcot.getMonth()+1))+" de "+fcot.getFullYear();
   }
    $("#fechacotizacion").html(info);
}
