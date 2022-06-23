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
    
    document.getElementById('div_guardar').style.display = 'none'; 
    
 }
 
 function verificar_caja(){
     
    $("#boton_buscar").click();
    
    var caja_apertura = Number(document.getElementById('caja_apertura').value);
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
    if(saldo_caja > caja_cierre) $("#caja_estado").val("FALTANTE Bs "+(saldo_caja-caja_cierre));
    if(saldo_caja < caja_cierre)  $("#caja_estado").val("INCONSISTENCIA");
    
   // alert(saldo_caja+" - "+caja_cierre);

    $('#caja_diferencia').val(Number(caja_cierre - saldo_caja).toFixed(2));

    //$("#div_guardar").style = "display:block;"
     document.getElementById('div_guardar').style.display = 'block'; 
    
    $.ajax({url: controlador,
               type:"POST",
               data:{bitacoracaja_montoreg:bitacoracaja_montoreg, bitacoracaja_montocaja:bitacoracaja_montocaja, bitacoracaja_tipo:bitacoracaja_tipo, bitacoracaja_evento:bitacoracaja_evento},

               success:function(result){


             
                },
            error:function(result){
                alert("Algo salio mal, verifique por favor...!!!");
               
            }

        });    
    
    
 }