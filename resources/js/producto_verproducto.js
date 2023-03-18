$(document).ready(function(){
    $(".este_no").click(function(){
        $("#producto_codigobarra").focus();
        $("#producto_codigobarra").select();
    });
});

function validar_tecla(e) {
    var tecla = (document.all) ? e.keyCode : e.which;
    if (e==13){
        var tecla = e;
    }else{
        var tecla = (document.all) ? e.keyCode : e.which;
    }
    
    if (tecla==13){
        tabladetalle_producto();
    }
}

function tabladetalle_producto(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"producto/get_elproducto/";
    let producto_codigobarra = document.getElementById('producto_codigobarra').value;
    let simbolo_moneda = document.getElementById('simbolo_moneda').value;
    let decimales = document.getElementById('decimales').value;
    document.getElementById('loader').style.display = 'block';
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_codigobarra:producto_codigobarra},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    html = "";
                        html += "<div class='text-center'>"
                        
                        if(registros["producto_foto"] != "" && registros["producto_foto"] !=  null){
                            html += "<img src='"+base_url+"resources/images/productos/"+registros["producto_foto"]+"' width='400' height='300' class='img img-square'>";
                        }else{
                            html += "<img src='"+base_url+"resources/images/productos/producto.jpg' width='400' height='300' class='img img-square'>";
                        }
                        html += "</div>"
                        html += "<div style='color:white; text-align: center'>"
                        if((registros["producto_nombre"]).length >23){
                            res = (registros["producto_nombre"]).substr(0, 21)+"...";
                        }else{
                            res = registros["producto_nombre"];
                        }
                        html += "<span style='font-weight: bold; font-size: 15pt'>"+res+"</span>";
                        html += "<br>";
                        html += "<span style='font-weight: bold; font-size: 11pt'>";
                        let detalle = "";
                        if(registros["producto_unidad"] != ""  && registros["producto_unidad"] != null){
                            detalle += registros["producto_unidad"];
                        }
                        if(registros["producto_marca"] != ""  && registros["producto_marca"] != null){
                            detalle += "/"+registros["producto_marca"];
                        }
                        
                        if(registros['producto_industria'] != ""  && registros['producto_industria'] != null){
                            detalle += "/"+registros['producto_industria'];
                        }
                        html += detalle;
                        html += "</span>";
                        html += "</br>";
                        html += "<span style='font-weight: bold; font-size: 17pt'>"+simbolo_moneda+". "+Number(registros['producto_precio']).toFixed(decimales)+"</span>";
                        
                        html += "</div>"
                        html += "</center>";
                        
                        //html2 += "<h4 style='color: white;'><font size='8'><b> Total Bs.&nbsp;&nbsp; "+numberFormat(Number(total_detalle).toFixed(2))+"</b></font></h4>          ";
                    $("#producto_detalle").html(html);
                    $("#producto_codigobarra").focus();
                    $("#producto_codigobarra").select();
                    document.getElementById('loader').style.display = 'none';
                    
            }else{
                html = "";
                html += "<div class='text-center'><br>"
                html += "<span class='fa fa-search-minus' style='color: #cc4e58; font-size: 50pt !important'></span>";
                html += "<br>";
                html += "<span style='color: #cc4e58; font-size: 25pt !important'><br>PRODUCTO<br>NO ENCONTRADO</span>";
                //html += "<img src='"+base_url+"resources/images/productos/"+registros["producto_foto"]+"' width='400' height='300' class='img img-square'>";
                html += "</div>"
                $("#producto_detalle").html(html);
                $("#producto_codigobarra").focus();
                $("#producto_codigobarra").select();
                document.getElementById('loader').style.display = 'none';
            }
            
        },
        error:function(resul){
           html = "";
           $("#producto_detalle").html(html);
           document.getElementById('loader').style.display = 'none';
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