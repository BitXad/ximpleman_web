
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
   // alert(usuario_id[0]['value']);
   // alert(usuario_id[1]['value']);
   // alert(usuario_id[2]['value']);
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

    ventacombi(filtro);
    
}

function ventacombi(filtro)
{   
   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/buscarporvendedores";
    var limite = 1000;
    var usuario_id = document.getElementById('usuario_id');
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
               

                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                  //  alert(filtro);
                    var totalCan = 0;
                    var totalTo = 0;
                    
                    var n = registros.length; //tama帽o del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   
                    html = "";
                    usuarios = "<b>Vendedor(es): </b>";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        
                        var canti = Number(registros[i]["cantidades"]);
                        var totalCan = Number(canti+totalCan);
                        var total = Number(registros[i]["totales"]);
                        var totalTo = Number(total+totalTo);
                        var precios = Number(registros[i]["precios"]);
                        var prom = Number(registros[i]["prom"]);
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["producto_nombre"]+"</b> <br>";
                        
                       // html += "<td align='right' >"+Number(registros[i]["detalleven_precio"]).toFixed(2)+"<br></td>";                                          
                        html += "<td align='right' >"+Number(total/canti).toFixed(2)+"<br></td>";                                          
                        html += "<td align='center' >"+Number(registros[i]["cantidades"])+"<br></td>";
                        html += "<td align='right'><b>"+Number(registros[i]["totales"]).toFixed(2)+"</b></td>";
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