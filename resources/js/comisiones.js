
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
    var limite = 500;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
               

                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                  //  alert(filtro);
                    var totalCo = 0;
                    var totalCan = 0;
                    var totalTo = 0;

                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   var perra = registros["usuario_id"];
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
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
                     // html += "<td>"+convertDateFormat(registros[i]["compra_fecha"])+"<br>"+registros[i]['compra_hora']+"</td>" ;
                                               
            
                       
                       
                        html += "</tr>";
                       
                   }
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td style= 'font-size:12px;' ><b>TOTAL</b></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td style= 'font-size:12px;' align='right'><b> "+Number(totalCan).toFixed(2)+"</td>";
                        html += "<td style= 'font-size:12px;' align='right'><b> "+Number(totalTo).toFixed(2)+"</td>";
                        html += "<td></td>";
                        html += "<td style= 'font-size:12px;' align='right'><b>"+Number(totalCo).toFixed(2)+"</b></td> ";
                        html += "</tr>";
                   
                   $("#ventacombi").html(html);
                   $("#usuario1").html(perra);
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