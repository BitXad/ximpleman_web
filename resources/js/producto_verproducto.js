$(document).on("ready",inicio);
function inicio(){
    tabladetalle_producto();
}

function tabladetalle_producto(){
    var base_url      = document.getElementById('base_url').value;
    var controlador   = base_url+"producto/get_elproducto/";
    let producto_codigobarra = "7898594128926";
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_codigobarra:producto_codigobarra},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    
                    html = "";
                    html2 = "";
                        html += "<div class='text-center'>"
                        html += "<img src='"+base_url+"resources/images/productos/"+registros["producto_foto"]+"' width='400' height='300' class='img img-square'>";
                        html += "</div>"
                        html += "<div style='color:white; text-align: center'>"
                        if((registros["producto_nombre"]).length >23){
                            res = (registros["producto_nombre"]).substr(0, 21)+"...";
                        }else{
                            res = registros["producto_nombre"];
                        }
                        html += "<span style='font-weight: bold; font-size: 15pt'>"+res+"</span>";
                        html += "</div>"
                        html += "</center>";
                        
                        //html2 += "<h4 style='color: white;'><font size='8'><b> Total Bs.&nbsp;&nbsp; "+numberFormat(Number(total_detalle).toFixed(2))+"</b></font></h4>          ";
                    $("#producto_detalle").html(html);
                    //$("#estotal").html(html2);
                    
            }
                
        },
        error:function(resul){
           html = "";
           $("#verventa_detalle").html(html);
           $("#estotal").html(html);
        }
        
    });   

}

function numberFormat(numero){
    // Variable que contendra el resultado final
    var resultado = "";

    // Si el numero empieza por el valor "-" (numero negativo)
    if(numero[0]=="-")
    {
        // Cogemos el numero eliminando los posibles puntos que tenga, y sin
        // el signo negativo
        nuevoNumero=numero.replace(/\,/g,'').substring(1);
    }else{
        // Cogemos el numero eliminando los posibles puntos que tenga
        nuevoNumero=numero.replace(/\,/g,'');
    }

    // Si tiene decimales, se los quitamos al numero
    if(numero.indexOf(".")>=0)
        nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf("."));

    // Ponemos un punto cada 3 caracteres
    for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
        resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;

    // Si tiene decimales, se lo añadimos al numero una vez forateado con 
    // los separadores de miles
    if(numero.indexOf(".")>=0)
        resultado+=numero.substring(numero.indexOf("."));

    if(numero[0]=="-")
    {
        // Devolvemos el valor añadiendo al inicio el signo negativo
        return "-"+resultado;
    }else{
        return resultado;
    }
}