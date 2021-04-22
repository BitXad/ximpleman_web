
  function pasar(de, a) {
    elemento  = document.getElementById(de);
    elemento2 = document.getElementById(a);

    for (i = 0; opt = elemento.options[i]; i++) {
      if (opt.selected) {
        valor = opt.value; // almacena el valor seleccionado
        texto = elemento.options[i].text; // almacena el texto sleccionado
        if (elemento.options.length == 1) {
          elemento.options[i].text  = "-";
          elemento.options[i].value = "-";
        } else {
          elemento.focus();
          elemento.options[i] = null;
        }

        if(elemento2.options[0].value == '-') { // condición si el elemento inicial esta solo (borrar todo)
          elemento2.options[0] = null;
        }

        if(valor != '-') {
          opc = new Option(texto, valor);
          // opc.selected = true;
          eval(elemento2.options[elemento2.options.length] = opc);
        }
      }

      if (elemento.options.length <= 0) {
        opc = new Option("-", "");
        eval(elemento.options[0] = opc);
      }
    }

    seleccionar(a);
  }

  function seleccionar(obj) {
    elem = document.getElementById(obj).options;
    for(i = 0; i < elem.length; i++) {
      elem[i].selected = true;
    }
  }

function buscar_fecha_ven()
{
   
    var base_url    = document.getElementById('base_url').value;
    
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('usuario_id').value;
   // alert(usuario_id[0]['value']);
   // alert(usuario_id[1]['value']);
   // alert(usuario_id[2]['value']);
    
        filtro = " and date(venta_fecha) >= '"+fecha_desde+"'  and  date(venta_fecha) <='"+fecha_hasta+
            "' and v.usuario_id = "+usuario_id;
      
    
    
    ventacombi(filtro);
    
}

function ventacombi(filtro)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/buscarporvendedores";
    //var limite = 500;
    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro},
            success:function(resul){
                $("#pillados").val("- 0 -");
                var registros =  JSON.parse(resul);
                if (registros != null){
                    //var nombre_moneda = document.getElementById('nombre_moneda').value;
                    var lamoneda_id = document.getElementById('lamoneda_id').value;
                    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                  //  alert(filtro);
                    var totalCo = 0;
                    var totalCan = 0;
                    var totalTo = 0;

                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   var usuario_id = registros["usuario_id"];
                    html = "";
                   
                    for (var i = 0; i < n ; i++){
                        var comision = Number(registros[i]["totales"])*Number(registros[i]["producto_comision"])/100;
                        var totalCo = Number(comision+totalCo);
                        var canti = Number(registros[i]["cantidades"]);
                        var totalCan = Number(canti+totalCan);
                        var total = Number(registros[i]["totales"]);
                        var totalTo = Number(total+totalTo);
                        
                        //var cantidad = registros[i]["detalleven_cantidad"] + suma;
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td> <b>"+registros[i]["producto_nombre"]+"</b>  <br>";
                        html += "<td align='center'> <b>"+registros[i]["producto_unidad"]+"</b>  <br>";
                        
                       // html += "<td align='right' >"+Number(registros[i]["detalleven_precio"]).toFixed(2)+"<br></td>";                                          
                        html += "<td align='right' >"+Number(total/canti).toFixed(2)+"<br></td>";                                          
                        html += "<td align='right' >"+Number(registros[i]["cantidades"]).toFixed(2)+"<br></td>";
                        html += "<td align='right'> <b>"+Number(registros[i]["totales"]).toFixed(2)+"</b> </td>";
                        html += "<td align='right'> <b>"+Number(registros[i]["producto_comision"]).toFixed(2)+"</b> </td>";
                        html += "<td align='right'> <b>"+Number(comision).toFixed(2)+"</b> </td>";
                        html += "<td class='text-right'> ";
                        if(lamoneda_id == 1){
                            total_otram = Number(comision)/Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = Number(comision)*Number(lamoneda[1]["moneda_tc"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(2));
                        html += "</td>";
                     // html += "<td>"+convertDateFormat(registros[i]["compra_fecha"])+"<br>"+registros[i]['compra_hora']+"</td>" ;
                                               
            
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td style= 'font-size:12px;' ><b>TOTAL</b></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td style= 'font-size:12px;' align='right'><b> "+numberFormat(Number(totalCan).toFixed(2))+"</td>";
                        html += "<td style= 'font-size:12px;' align='right'><b> "+numberFormat(Number(totalTo).toFixed(2))+"</td>";
                        html += "<td></td>";
                        html += "<td style= 'font-size:12px;' align='right'><b>"+numberFormat(Number(totalCo).toFixed(2))+"</b></td> ";
                        html += "<td style= 'font-size:12px;' align='right'><b>"+numberFormat(Number(total_otramoneda).toFixed(2))+"</b></td> ";
                        html += "</tr>";
                   
                   $("#ventacombi").html(html);
                   $("#usuario1").html(usuario_id);
                   document.getElementById('loader').style.display = 'none';
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#ventacombi").html(html);
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