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
    
    $('#myModal').on('shown.bs.modal', function() {
        $('#monto_caja').focus();
        $('#monto_caja').select();
    });
}

function almacenar_cufd(datos,punto_venta=0){
    
    var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'dosificacion/almacenarcufd';   
    
    var codigo = datos.codigo;
    let codigoControl = datos.codigoControl;
    let direccion = datos.direccion;
    var fechavigencia = datos.fechaVigencia;
    var transaccion = datos.transaccion;    

//    alert(codigo+" * "+codigoControl+" * "+direccion+" * "+fechaVigencia+" * "+transaccion);
    //alert("ña ña ña ña ña ña ña ña ña ñaaaaa, batman..!!")
    
            $.ajax({url:controlador,
                    type:"POST",
                    data:{codigo:codigo, 
                        codigoControl:codigoControl, 
                        direccion:direccion,
                        fechavigencia:fechavigencia, 
                        transaccion:transaccion,
                        punto_venta:punto_venta
                    },
                    success:function(respuesta){

                        alert("C.U.F.D generado y almacenado correctamente...!");
                        document.getElementById('loader_revocado').style.display = 'none';
                        dibujar_tabla_puntos_venta();
                       
                    },
                    error:function(respuesta){
                        alert("Algo salio mal; por favor verificar sus datos!.");
                    }                
            }); 
    
}

function solicitudCufd(punto_venta=0){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cufd';
//    var opcion = confirm("Esta a punto de generar el C.U.F.D. para el PUNTO DE VENTA "+punto_venta+", el cual reemplazará el existente...! \n ¿Desea Continuar?");
    
//    if (opcion == true) {
        //alert("gegegegenerando cufd: "+punto_venta);
        //document.getElementById('loader_revocado').style.display = 'block';  
        
        $.ajax({url:controlador,
                type:"POST",
                data:{punto_venta:punto_venta},
                success:function(respuesta){
                    var datos = JSON.parse(respuesta);
                    //var datos =  JSON.parse(registros);
                let registros = datos['respuesta'];
                let lafalla = datos['falla']
                    
                    /*console.log(registros);
                    console.log(registros.RespuestaVerificarNit.mensajesList.codigo);
                    console.log(registros.RespuestaVerificarNit.mensajesList.descripcion);
                    console.log(registros.RespuestaVerificarNit.transaccion);*/
                    //let elcodigo = registros.RespuestaVerificarNit.mensajesList.codigo;
                    if(lafalla != ""){
                        alert(JSON.stringify(registros)+"\n"+JSON.stringify(lafalla));
                       // document.getElementById('loader_revocado').style.display = 'none';
                    }else{
                    let codigo = registros.RespuestaCufd.codigo;
                    let codigoControl = registros.RespuestaCufd.codigoControl;
                    let direccion = registros.RespuestaCufd.direccion;
                    let fechaVigencia = registros.RespuestaCufd.fechaVigencia;
                    let transaccion = registros.RespuestaCufd.transaccion;

                    //alert(registros);
                    if(transaccion == true){
                       // $("#modal_mensajeadvertencia").modal("show");
                        almacenar_cufd((registros['RespuestaCufd']),punto_venta);
                    }
                    else{
                        alert(JSON.stringify(registros));
                    }
                    // document.getElementById('loader_cufd').style.display = 'none';
                    //alert("hola");
                    /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema

                    }*/
                    }

                },
                error:function(respuesta){
                    let datos = JSON.parse(respuesta);
                    let registros = datos['respuesta'];
                    let lafalla = datos['falla']
                   alert(JSON.stringify(registros)+"\n"+JSON.stringify(lafalla));
                }
        }); 
//    }
}

function abrir_lacaja()
{
    var base_url   = document.getElementById('base_url').value; 
    var monto_caja = document.getElementById('monto_caja').value; 
    var caja_id    = document.getElementById('caja_id').value; 
    var controlador = base_url+"caja/abrir_lacaja";
    var punto_venta = document.getElementById('punto_venta').value;
    //alert(punto_venta);
    
    $.ajax({url:controlador,
        type:"POST",
        data:{monto_caja:monto_caja, caja_id:caja_id},
        success: function(response){
            var registros =  JSON.parse(response);
            if(registros == "no"){
                $("#elmensaje").html("El campo MONTO, no puede estar vacio..!");
            }else{
                $("#myModal").modal('hide');
                window.location.href = base_url+"venta/ventas";
                solicitudCufd(punto_venta);
            }
        },
        error:function (response){
            alert("ocurrio un error ");
        }
    });
}

function formato_numerico(numero){
            nStr = Number(numero).toFixed(2);
        nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
}

 function calcular_caja(){
 
    
    var caja_apertura = Number(document.getElementById('caja_apertura').value);
    var caja_corte1000 = Number(document.getElementById('caja_corte1000').value);
    var caja_corte500 = Number(document.getElementById('caja_corte500').value);
    var caja_corte200 = Number(document.getElementById('caja_corte200').value);
    var caja_corte100 = Number(document.getElementById('caja_corte100').value);
    var caja_corte50 = Number(document.getElementById('caja_corte50').value);
    var caja_corte20 = Number(document.getElementById('caja_corte20').value);
    var caja_corte10 = Number(document.getElementById('caja_corte10').value);
    var caja_corte5 = Number(document.getElementById('caja_corte5').value);
    var caja_corte2 = Number(document.getElementById('caja_corte2').value);
    var caja_corte1 = Number(document.getElementById('caja_corte1').value);
    var caja_corte050 = Number(document.getElementById('caja_corte050').value);
    var caja_corte020 = Number(document.getElementById('caja_corte020').value);
    var caja_corte010 = Number(document.getElementById('caja_corte010').value);
    var caja_corte005 = Number(document.getElementById('caja_corte005').value);
    var total_transacciones = Number(document.getElementById('saldo_caja').value);
    
    var total = 0;
    total =  (caja_corte1000*1000) + (caja_corte500*500) + (caja_corte200*200) + (caja_corte100*100) + 
             (caja_corte50*50) + (caja_corte20*20) + (caja_corte10*10) + (caja_corte5*5) + (caja_corte2*2) + 
             (caja_corte1*1) + (caja_corte050*0.50) + (caja_corte020*0.20) + (caja_corte010*0.10) + (caja_corte005*0.05);
    
    
    $('#span_corte200').text(formato_numerico(Number(caja_corte200*200).toFixed(2)));
    $('#span_corte100').text(formato_numerico(Number(caja_corte100*100).toFixed(2)));
    $('#span_corte50').text(formato_numerico(Number(caja_corte50*50).toFixed(2)));
    $('#span_corte20').text(formato_numerico(Number(caja_corte20*20).toFixed(2)));
    $('#span_corte10').text(formato_numerico(Number(caja_corte10*10).toFixed(2)));
    $('#span_corte5').text(formato_numerico(Number(caja_corte5*5).toFixed(2)));
    $('#span_corte2').text(formato_numerico(Number(caja_corte2*2).toFixed(2)));
    $('#span_corte1').text(formato_numerico(Number(caja_corte1*1).toFixed(2)));
    $('#span_corte050').text(formato_numerico(Number(caja_corte050*0.50).toFixed(2)));
    $('#span_corte020').text(formato_numerico(Number(caja_corte020*0.20).toFixed(2)));
    $('#span_corte010').text(formato_numerico(Number(caja_corte010*0.10).toFixed(2)));
    $('#span_corte005').text(formato_numerico(Number(caja_corte005*0.05).toFixed(2)));
    
    $('#caja_cierre').val(Number(total).toFixed(2));
    $('#caja_diferencia').val(Number(total - caja_apertura - total_transacciones).toFixed(2));
    //alert(total);
    
    
    
 }
 
 function verificar_caja(){
     
    $("#boton_buscar").click();
    
    var caja_apertura = 0; //Number(document.getElementById('caja_apertura').value); porque ya lo hace desde el reporte de movimiento
    var total_transacciones = Number(document.getElementById('saldo_caja').value);
    var saldo_caja = caja_apertura + total_transacciones;
    
    var caja_cierre = Number(document.getElementById('caja_cierre').value);    
    var bitacoracaja_montoreg = saldo_caja;
    var bitacoracaja_montocaja = caja_cierre;
    var bitacoracaja_tipo = 1; //registros de caja

    var billete200 = document.getElementById('caja_corte200').value;
    var billete100 = document.getElementById('caja_corte100').value;
    var billete50 = document.getElementById('caja_corte50').value;
    var billete20 = document.getElementById('caja_corte20').value;
    var billete10 = document.getElementById('caja_corte10').value;
    var moneda5 = document.getElementById('caja_corte5').value;
    var moneda2 = document.getElementById('caja_corte2').value;
    var moneda1 = document.getElementById('caja_corte1').value;
    var moneda050 = document.getElementById('caja_corte050').value;
    var moneda020 = document.getElementById('caja_corte020').value;
    var moneda010 = document.getElementById('caja_corte010').value;
    var moneda005 = document.getElementById('caja_corte005').value;

    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"caja/registrar_bitacora";
    
    var bitacoracaja_evento = "VERIFICACION EFECTIVO: "+
            "| BILLETE 200 X "+billete200+
            "| BILLETE 100 X "+billete100+
            "| BILLETE 50 X "+billete50+
            "| BILLETE 20 X "+billete20+
            "| BILLETE 10 X "+billete10+
            "| MODENA 5 X "+moneda5+
            "| MODENA 2 X "+moneda2+
            "| MODENA 1 X "+moneda1+
            "| MODENA 0.50 X "+moneda050+
            "| MODENA 0.20 X "+moneda020+
            "| MODENA 0.10 X "+moneda010+
            "| MODENA 0.05 X "+moneda005;
            
    
    
    $("#buscar_por_fecha").click();
    
    if(saldo_caja == caja_cierre) $("#caja_estado").val("IGUALADA");
    if(saldo_caja > caja_cierre) $("#caja_estado").val("FALTANTE Bs "+(Number(saldo_caja-caja_cierre).toFixed(2)));
    if(saldo_caja < caja_cierre)  $("#caja_estado").val("INCONSISTENCIA");
    
   // alert(saldo_caja+" - "+caja_cierre);

    $('#caja_diferencia').val(Number(caja_cierre - saldo_caja).toFixed(2));

    $.ajax({url: controlador,
               type:"POST",
               data:{bitacoracaja_montoreg:bitacoracaja_montoreg, bitacoracaja_montocaja:bitacoracaja_montocaja, bitacoracaja_tipo:bitacoracaja_tipo, bitacoracaja_evento:bitacoracaja_evento},

               success:function(result){


             
                },
            error:function(result){
                alert("Algo salio mal, verifique por favor...!!!");
               
            }

        });    
    
    
    document.getElementById('div_botones').style.display = 'block'; 
 }