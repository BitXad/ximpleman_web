let det_egreso = [];
var base_url;
window.onload = (()=>{
    base_url = $('#base_url').val();
    let detalle = $('#egreso_especificacion').val();
    let egresos = convertir(detalle);
    convert_egreso(egresos);
    dibujar_tabla()
});

function get_detallesEgresos(){
    return det_egreso;
}

function cargar_concepto(egreso, suma){
    let egr = new Egreso();
    egr.set_egreso(egreso);
    egr.set_suma(suma);
    det_egreso.push(egr)
}

function guardar_concepto(){
    if(verificar_detegreso()){
        let egr = new Egreso();
        let detalle = $('#egreso_especificacion').val();
        egr.set_egreso($('#egreso_categoria').val());
        egr.set_suma($('#egreso_suma').val());
        det_egreso.push(egr)
        dibujar_tabla();
        detalle = `${detalle}${detalle === '' ? '':`,`} ${$('#egreso_categoria').val()}(${$('#egreso_suma').val()}) `
        $('#egreso_especificacion').val(detalle);
        $('#add_concepto').modal('hide')
        $('#egreso_categoria').val('CATEGORIA EGRESO')
        $('#egreso_suma').val('');
    }
}
/**
 * Verificar los campos concepto y suma
 */
function verificar_detegreso(){
    let egreso = $('#egreso_categoria').val();
    let suma = $('#egreso_suma').val();
    let mensaje;
    let respuesta = false
    if(egreso == 'CATEGORIA EGRESO'){
        $('#egreso_categoria').css('border','1px solid #DD0000');
        mensaje = 'Debe seleccionar una categoria';
        $('#mensaje_egreso').css('color', '#DD0000')
        $('#mensaje_egreso').text(mensaje)
    }else{
        if(suma < 0 || suma == ''){
            $('#egreso_suma').css('border','1px solid #DD0000');
            mensaje = 'La suma debe ser un numero positivo'
            $('#mensaje_suma').text(mensaje)
            $('#mensaje_suma').css('color','#DD0000');
        }else{
            respuesta = true;
        }
    }
    return respuesta;
}
/**
 * Dibujar la tabla de egresos
 */
function dibujar_tabla(){
    let egresos = get_detallesEgresos();
    let posicion = 0;
    let html = ``;
    let total = parseFloat(0);
    console.log(egresos);
    for(let egreso of egresos){
        if(egreso.get_egreso() != ''){
            html +=`<tr>
                        <td>${posicion+1}</td>
                        <td>${egreso.get_egreso()}</td>
                        <td>${parseFloat(egreso.get_suma()).toFixed(2)}</td>
                        <td>
                            <button class="btn btn-danger btn-xs" title="Borrar" onclick="borrar_egreso(${posicion})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>`;
            posicion += 1;
            total = parseFloat(total) + parseFloat(egreso.get_suma());
        }
    }
    html += `<tr>
                <th></th>
                <th><b>Total:</b></th>
                <th>${parseFloat(total).toFixed(2)}</th>
                <th></th>
            </tr>`
    $('#tabla_egresos').html(html);
    $('#egreso_monto').val(parseFloat(total).toFixed(2))
}
/**
 * Borrar un egreso de la lista
 */
function borrar_egreso(posicion){
    det_egreso.splice(posicion, 1);
    let concepto = $('#egreso_especificacion').val();
    let array = convertir(concepto);
    let detalle = ``;
    array.splice(posicion, 1);
    // convert_egreso(array);
    array.forEach(egreso => {
        detalle = `${detalle}${detalle === '' ? '':`,`} ${egreso}`
    });
    $('#egreso_especificacion').val(detalle)
    dibujar_tabla();
}

function add_egreso(edit){
    if(verificar_form()){
        let controlador = (edit == 0 ? `${base_url}egreso/add_egresos`:`${base_url}egreso/edit_egresos`);
        let egreso_nombre = $('#egreso_nombre').val();
        let select_forma_pago = $('#select_forma_pago').val();
        let egreso_moneda = $('#egreso_moneda').val();
        let egreso_monto = $('#egreso_monto').val();
        let egreso_especificacion = $('#egreso_especificacion').val();
        let egreso_concepto = $('#egreso_concepto').val();
        let egreso_glosa = $('#egreso_glosa').val();
        let egreso_monreg =  $('#egreso_moneda').val();
        let egreso_numero = $('#egreso_numero') .val();
        let egreso_fecha = $('#egreso_fecha') .val();
        console.log(egreso_glosa)
        let usuario_id = $('#usuario_id').val();
        let banco_id = $('#banco_id').val();
        let egreso_id = edit;
        $.ajax({
            url: controlador,
            type: 'POST',
            async: false,
            data:{
                egreso_nombre:egreso_nombre,
                select_forma_pago:select_forma_pago,
                egreso_moneda:egreso_moneda,
                egreso_monto:egreso_monto,
                egreso_concepto:egreso_concepto,
                egreso_glosa:egreso_glosa,
                egreso_numero:egreso_numero,
                egreso_fecha:egreso_fecha,
                usuario_id:usuario_id,
                egreso_id:egreso_id,
                egreso_monreg:egreso_monreg,
                egreso_especificacion:egreso_especificacion,
                banco_id:banco_id,
            },
            success: () =>{
                window.location.href = `${base_url}egreso/index`;
            },
            error:() =>{
                alert("Error: No se pudo guardar el egreso");
            }
        });
    }
}

function verificar_form(){
    let egreso_nombre = $('#egreso_nombre').val();
    let egreso_monto = $('#egreso_monto').val();
    let mensaje;
    let vacio = '';
    let det_egresos = get_detallesEgresos();
    let ress = true;
    //verificar campo nombre 
    if(egreso_nombre == vacio){
        $('#egreso_nombre').css('border','1px solid #DD0000');
        mensaje = 'Se debe indicar a quien se dio el dinero'
        $('#mensaje_nombre').text(mensaje)
        $('#mensaje_nombre').css('color','#DD0000');
        ress = false
    }
    // verificar campo monto
    if(egreso_monto <= 0 || egreso_monto == vacio){
        $('#egreso_monto').css('border','1px solid #DD0000');
        mensaje = 'Coloque un número mayor a 0'
        $('#mensaje_monto').text(mensaje)
        $('#mensaje_monto').css('color','#DD0000');
        ress = false;
    }
    // verificar conceptos de egreso
    if(det_egresos.length == 0){
        alert('Debe colocar conceptos del motivo del egreso');
        ress = false;
    }

    return ress;
}
/**
 * convierte un string a un array
 */
function convertir(str) {
    let array = []
    let bandera = true;
    let pos;
    while(bandera){
        pos = str.indexOf(',')
        if(pos < 0){
            bandera = false
            str1 =  str.slice(0,str.length)
        }else{
            str1 =  str.slice(0,pos)
        }
        array.push(str1)
        str = str.slice(pos+2,str.length)  
    }
    return array;
}

/**
 * agregar a objeto egreso 
 */
function convert_egreso(array) {
    let nombre, monto, pos;
    array.forEach(egreso => {
        nombre = egreso;
        monto = egreso;
        pos = nombre.indexOf('(');
        nombre = nombre.slice(0,pos);
        monto = monto.slice(pos+1,monto.length-1);
        
        let egr = new Egreso();
        egr.set_egreso(nombre);
        egr.set_suma(monto);
        det_egreso.push(egr)
    });
}

class Egreso{
    constructor(){
        var egreso = 0;
        var suma = 0;
    }

    get_egreso(){
        return this.egreso;
    }
    get_suma(){
        return this.suma;
    }
    set_egreso(egreso){
        this.egreso = egreso;
    }
    set_suma(suma){
        this.suma = suma;
    }
}