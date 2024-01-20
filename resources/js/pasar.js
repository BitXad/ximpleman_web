
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

        if(elemento2.options[0].value == '-') { // condici贸n si el elemento inicial esta solo (borrar todo)
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
    var controlador = base_url+"compra";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('usuario_id');
    var tipousu = document.getElementById('tipousu').value;
   // alert(usuario_id[0]['value']);
   // alert(usuario_id[1]['value']);
   // alert(usuario_id[2]['value']);
   if (tipousu == 1) {
  for (var i=0; i<usuario_id.length; i++)
    {
      if (i==0)
      {
        filtro = " and date(venta_fecha) >= '"+fecha_desde+"'  and  date(venta_fecha) <='"+fecha_hasta+
            "' and (v.usuario_id = "+usuario_id[i]['value'];
      }
      else
      {
        filtro += "  or v.usuario_id = "+usuario_id[i]['value'];
      }
    }
    filtro +=")";
   }else{
      for (var i=0; i<usuario_id.length; i++)
    {
      if (i==0)
      {
        filtro = " and date(venta_fecha) >= '"+fecha_desde+"'  and  date(venta_fecha) <='"+fecha_hasta+
            "' and (v.usuarioprev_id = "+usuario_id[i]['value'];
      }
      else
      {
        filtro += "  or v.usuarioprev_id = "+usuario_id[i]['value'];
      }
    }
    filtro +=")";
   }
   

    ventacombi(filtro);
    
}

function ventacombi(filtro)
{   
   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/buscarporvendedores";
    var limite = 50000;
    var usuario_id = document.getElementById('usuario_id');
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
               

                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   var parametro_mostrarmoneda    = document.getElementById('parametro_mostrarmoneda').value;
                  //  alert(filtro);
                    var totalCan = 0;
                    var totalTo = 0;
                    
                    var n = registros.length; //tama帽o del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   
                    html = "";
                    usuarios = "<b>Vendedor(es): </b>";
                   if (n <= limite) x = n; 
                   else x = limite;
                    //var nombre_moneda = document.getElementById('nombre_moneda').value;
                    var lamoneda_id = document.getElementById('lamoneda_id').value;
                    //var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                    for (var i = 0; i < x ; i++){
                        
                        
                        var canti = Number(registros[i]["cantidades"]);
                        var totalCan = Number(canti+totalCan);
                        var total = Number(registros[i]["totales"]);
                        var totalTo = Number(total+totalTo);
                        var precios = Number(registros[i]["precios"]);
                        var prom = Number(registros[i]["prom"]);
                        html += "<tr class='labj'>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["producto_nombre"]+"</b> <br>";
                        
                       // html += "<td align='right' >"+Number(registros[i]["detalleven_precio"]).toFixed(2)+"<br></td>";                                          
                        html += "<td align='right' >"+Number(total/canti).toFixed(2)+"<br></td>";                                          
                        html += "<td align='right' >"+Number(registros[i]["cantidades"])+"<br></td>";
                        html += "<td align='right'><b>"+Number(registros[i]["totales"]).toFixed(2)+"</b></td>";
                        if(parametro_mostrarmoneda == 1){
                        html += "<td class='text-right'> ";
                        if(lamoneda_id == 1){
                            total_otram = Number(registros[i]["totales"])/Number(registros[i]["tipo_cambio"]);
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = Number(registros[i]["totales"])*Number(registros[i]["tipo_cambio"]);
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(2));
                        html += "</td>";
                        }
                     // html += "<td>"+convertDateFormat(registros[i]["compra_fecha"])+"<br>"+registros[i]['compra_hora']+"</td>" ;
                        //usuarios += "<b>"+registros[i]["usuario_id"]+"</b>";                       
            
                       
                       
                        html += "</tr>";
                        
                       
                   }
                         for (var i=0; i<usuario_id.length; i++)
    {
      if (i==0)
      {
        usuarios += ""+usuario_id.options[i].text+" , ";
      }
      else
      {
        usuarios += ""+usuario_id.options[i].text+" , ";
      }
    }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td style= 'font-size:12px;' ><b>TOTAL</b></td>";
                        html += "<td></td>";
                       
                        html += "<td style= 'font-size:13px;' align='right'><b> "+Number(totalCan)+"</td>";
                        html += "<td style= 'font-size:13px;' align='right'><b> "+Number(totalTo).toFixed(2)+"</td>";
                        if(parametro_mostrarmoneda == 1){
                            html += "<td style= 'font-size:13px;' align='right'><b> "+Number(total_otramoneda).toFixed(2)+"</td>";
                        }
                        html += "</tr>";

                   $("#usus").html(usuarios);
                   $("#ventacombi").html(html);
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

function asignar()
{
   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"inventario_usuario/asignar";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('usuario_id');
    var usuario = document.getElementById('inv_usu').value;
    var fecha = document.getElementById('fecha').value;
    var hora = document.getElementById('hora').value;
    var tipousu = document.getElementById('tipousu').value;
    document.getElementById('asigloader').style.display = 'block';
    document.getElementById('botoness').style.display = 'none';
   // alert(usuario_id[0]['value']);
   // alert(usuario_id[1]['value']);
   // alert(usuario_id[2]['value']);
    if (tipousu == 1) {
  for (var i=0; i<usuario_id.length; i++)
    {
      if (i==0)
      {
        filtro = " and date(venta_fecha) >= '"+fecha_desde+"'  and  date(venta_fecha) <='"+fecha_hasta+
            "' and (v.usuario_id = "+usuario_id[i]['value'];
      }
      else
      {
        filtro += "  or v.usuario_id = "+usuario_id[i]['value'];
      }
    }
    filtro +=")";
   }else{
      for (var i=0; i<usuario_id.length; i++)
    {
      if (i==0)
      {
        filtro = " and date(venta_fecha) >= '"+fecha_desde+"'  and  date(venta_fecha) <='"+fecha_hasta+
            "' and (v.usuarioprev_id = "+usuario_id[i]['value'];
      }
      else
      {
        filtro += "  or v.usuarioprev_id = "+usuario_id[i]['value'];
      }
    }
    filtro +=")";
   }

    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro,usuario:usuario,fecha:fecha,hora:hora},
           success:function(respuesta){ 
            $('#myModal').modal('hide');
            document.getElementById('asigloader').style.display = 'none';
            document.getElementById('botoness').style.display = 'block';
             
             },
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