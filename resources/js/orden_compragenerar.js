/*$(document).on("ready",inicio);
function inicio(){
    tablaresultadosproducto(1);
}*/

function generar_ordencompra(){
    var base_url = document.getElementById('base_url').value;
    var compra_id = document.getElementById('compra_id').value;
    var controlador = base_url+"orden_compra/generar_ordencompradirecta";
    var html = "";
    //alert(producto_id);
    document.getElementById('loader').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{compra_id:compra_id},
            success:function(resultado){
                var reg = JSON.parse(resultado);
                if(reg>0){
                    alert("Orden de compra generado con éxito!.")
                    dir_url = base_url+"orden_compra/nota_orden/"+reg;
                    location.href =dir_url;
                    document.getElementById('loader').style.display = 'none';
                }
               document.getElementById('loader').style.display = 'none';
           },error:function(respuesta){
           // alert("Algo salio mal...!!!");
           document.getElementById('loader').style.display = 'none';
           html = "";
           $("#tabla_historial").html(html);
           document.getElementById('loader').style.display = 'none';
        },
    });
    
}

    
    
    
    
    
    

































/*
 * Funcion que buscara productos en la tabla productos
 */
function buscarproducto(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
        tablaresultadosproducto(2);
    }
}

function imprimir_producto(){
    var estafh = new Date();
    $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
    $("#cabeceraprint").css("display", "");
    window.print();
    $("#cabeceraprint").css("display", "none");
}

/*aumenta un cero a un digito; es para las horas*/
function aumentar_cero(num){
    if (num < 10) {
        num = "0" + num;
    }
    return num;
}
/* recibe Date y devuelve en formato dd/mm/YYYY hh:mm:ss ampm */
function formatofecha_hora_ampm(string){
    var mifh = new Date(string);
    var info = "";
    var am_pm = mifh.getHours() >= 12 ? "p.m." : "a.m.";
    var hours = mifh.getHours() > 12 ? mifh.getHours() - 12 : mifh.getHours();
    if(string != null){
       info = aumentar_cero(mifh.getDate())+"/"+aumentar_cero((mifh.getMonth()+1))+"/"+mifh.getFullYear()+" "+aumentar_cero(hours)+":"+aumentar_cero(mifh.getMinutes())+":"+aumentar_cero(mifh.getSeconds())+" "+am_pm;
   }
    return info;
}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
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


function actualizar_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_inventario/";
    
    document.getElementById('oculto').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El inventario se actualizo exitosamente...! ');
            //redirect('inventario/index');
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            //tabla_inventario();
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
    });   
      
}