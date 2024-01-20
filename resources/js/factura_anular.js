function anular_factura_electronica()
{
    var factura_id = document.getElementById("factura_id").value; 
    var venta_id = document.getElementById("venta_id").value; 
    var factura_numero = document.getElementById("factura_numero").value; 
    var factura_razon = document.getElementById("factura_cliente").value; 
    var factura_total = document.getElementById("factura_monto").value; 
    var factura_fecha = document.getElementById("factura_fecha").value;
    var motivo_id = document.getElementById("motivo_anulacion").value;
    let factura_correo = document.getElementById("factura_correo").value;

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/anular_factura/'+factura_id+"/"+venta_id;
    

        var txt;
        var r = confirm("Esta a punto de anular una factura.\n"+"Factura Nº: "+factura_numero+"\n"+
                                  "Monto Bs: "+factura_total+"\n"+
                                  "Cliente: "+factura_razon+"\n"+
                                  "Fecha: "+moment(factura_fecha).format("DD/MM/YYYY HH:mm:ss")+ "\n Esta operación es irreversible, ¿Desea Continuar?");
        if (r == true) {
            let borrar_venta = 0;
            var re = confirm("Tambien quiere anular la venta asociada a la factura?\n"+"Venta Nº: "+venta_id+"\n"+
                                  "Esta operación es irreversible, ¿Desea Continuar?");
            if (re == true) {
                borrar_venta = 1;
            }
            document.getElementById('loader2').style.display = 'block';
            $.ajax({url:controlador,
                    type:"POST",
                    data:{motivo_id: motivo_id, factura_correo:factura_correo, borrar_venta:borrar_venta},
                    success:function(result){
                        res = JSON.parse(result);
                        alert(JSON.stringify(res));
                        
                        document.getElementById('loader2').style.display = 'none';
                        $('#boton_cerrar').click();
                        //window.location.reload();
                        location.reload();
                    },
            });
            
            document.getElementById('loader2').style.display = 'none';
        }else{
            document.getElementById('loader2').style.display = 'none';
        }

}

/* carga las facturas no enviadas, mal emitidas */
function cargar_modal_anular_malemitida(factura_id, venta_id, factura_numero, factura_razon, factura_total, factura_fecha)
{

    $("#facturamal_id").val(factura_id);
    $("#ventamal_id").val(venta_id);
    $("#facturamal_numero").val(factura_numero);
    $("#facturamal_monto").val(factura_total);
    $("#facturamal_fecha").val(moment(factura_fecha).format("DD/MM/YYYY"));
    $("#facturamal_cliente").val(factura_razon)
}

function anular_factura_electronica_malemitida()
{
    var factura_id = document.getElementById("facturamal_id").value; 
    var venta_id = document.getElementById("ventamal_id").value; 
    var factura_numero = document.getElementById("facturamal_numero").value; 
    var factura_razon = document.getElementById("facturamal_cliente").value; 
    var factura_total = document.getElementById("facturamal_monto").value; 
    var factura_fecha = document.getElementById("facturamal_fecha").value;
    //var motivo_id = document.getElementById("motivo_anulacion").value;
    //let factura_correo = document.getElementById("factura_correo").value;

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/anular_factura_malemitida/'+factura_id+"/"+venta_id;
    
        var r = confirm("Esta a punto de anular una factura.\n"+"Factura Nº: "+factura_numero+"\n"+
                                  "Monto Bs: "+factura_total+"\n"+
                                  "Cliente: "+factura_razon+"\n"+
                                  "Fecha: "+moment(factura_fecha).format("DD/MM/YYYY")+ "\n Esta operación es irreversible, ¿Desea Continuar?");
        if(r == true){
            document.getElementById('loadermal').style.display = 'block';
            $.ajax({url:controlador,
                    type:"POST",
                    data:{},
                    success:function(result){
                        res = JSON.parse(result);
                        //mostrar_facturas();
                        alert("Anulacion exitosa!.");
                        
                        document.getElementById('loadermal').style.display = 'none';
                        location.reload();
                        $('#boton_cerrarmal').click();
                    },
            });
            document.getElementById('loadermal').style.display = 'none';
        }else{
            document.getElementById('loadermal').style.display = 'none';
        }

}
