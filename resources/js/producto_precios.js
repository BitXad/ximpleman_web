
/* Carga los precios desde la tabla producto a producto_precios */
function cargar_precios() {
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url + 'producto_precios/cargar_precios';
    
    var r = confirm("ADVERTENCIA: Esta operación eliminará y reemplazará la lista actual. \n ¿Desea Continuar?");
    
    if (r == true) {
        // Mostrar el overlay de bloqueo
        document.getElementById("overlay").style.display = "block";

        $.ajax({
            url: controlador,
            type: "POST",
            data: {},
            success: function(respuesta) {
                let res = JSON.parse(respuesta);
                
                if (res) {
                    alert("Los datos fueron cargados con éxito...!");
                    location.reload();
                } else {
                    alert("ADVERTENCIA: Ocurrió un problema al cargar los datos, verifique el archivo de datos y vuelva a intentar.");
                }
            },
            error: function(respuesta) {
                alert("ADVERTENCIA: Ocurrió un problema con la solicitud.");
            },
            complete: function() {
                // Ocultar el overlay de bloqueo
                document.getElementById("overlay").style.display = "none";
            }
        });
    }
}

/* Carga los precios desde la tabla producto a producto_precios */
function calcular_razon() {
    let tc = document.getElementById('moneda_tc').value;
    let tc_nuevo = document.getElementById('moneda_tc_nuevo').value;
    
    let razon = tc_nuevo / tc ;
    
    
    $("#moneda_razon").val(razon);
    
}

function actualizar_precios(){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url + 'producto_precios/actualizar_precios';
    let operacion = document.getElementById('operacion').value;
    let afectar = document.getElementById('afectar').value;
    let redondear = document.getElementById('redondear').value;
    let tc = document.getElementById('moneda_tc').value;
    let tc_nuevo = document.getElementById('moneda_tc_nuevo').value;    
    let razon = tc_nuevo / tc ;
    var tipo_moneda = document.getElementById("span_tipo_moneda");
    
    
    alert(operacion +' *** '+afectar+' *** '+redondear)
    var r = confirm("ADVERTENCIA: Esta operación eliminará y reemplazará la lista actual. \n ¿Desea Continuar?");    
    if (r == true) {
        
        if(Number(operacion)>0){
            if(Number(afectar)>0){
                if(Number(redondear)>0){
                
                        // Mostrar el overlay de bloqueo
                        document.getElementById("overlay").style.display = "block";

                        $.ajax({
                            url: controlador,
                            type: "POST",
                            data: {operacion:operacion,afectar:afectar,redondear:redondear, razon:razon, tipo_moneda:tipo_moneda},
                            success: function(respuesta) {
                                let res = JSON.parse(respuesta);

                                if (res) {
                                    alert("Los datos fueron cargados con éxito...!");
                                    location.reload();
                                } else {
                                    alert("ADVERTENCIA: Ocurrió un problema al cargar los datos, verifique el archivo de datos y vuelva a intentar.");
                                }
                            },
                            error: function(respuesta) {
                                alert("ADVERTENCIA: Ocurrió un problema con la solicitud.");
                            },
                            complete: function() {
                                // Ocultar el overlay de bloqueo
                                document.getElementById("overlay").style.display = "none";
                            }
                        });
                
                }else{ alert("ERROR: Debe seleccionar la opcion de redondeo...!"); }            
            }else{ alert("ERROR: Debe elegir el objetivo a afectar con el nuevo precio...!"); }        
        }else{ alert("ERROR: Debe seleccionar una operacion...!"); }
    
    }
    
}


function cambiar_tipomoneda() {
    var span = document.getElementById("span_tipo_moneda");
    
    // Cambia el valor del span según una condición o de manera fija
    if (span.innerHTML === "%") {
        span.innerHTML = "Bs";  // Cambia a "$"
    } else {
        span.innerHTML = "%";  // Cambia a "%"
    }
}