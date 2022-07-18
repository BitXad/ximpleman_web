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
            
            document.getElementById('loader2').style.display = 'block';
            $.ajax({url:controlador,
                    type:"POST",
                    data:{motivo_id: motivo_id, factura_correo:factura_correo},
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
