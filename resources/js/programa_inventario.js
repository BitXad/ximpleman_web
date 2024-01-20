//Tabla de resultados del programa seleccionado
function tablaresultadosprogramainv(){
    
    var controlador    = "";
    var base_url       = document.getElementById('base_url').value;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var programa_id    = document.getElementById('programa_id').value;
    var gestion_inicio = document.getElementById('gestion_inicio').value;
    var gestion_id     = document.getElementById('gestion_id').value;
    var gestion_nombre     = document.getElementById('gestion_nombre').value;
    controlador        = base_url+'programa/inventariobuscar/';
    var decimales = document.getElementById('decimales').value;
    
    fecha1 = gestion_nombre+"-01-01" 
    fecha2 = gestion_nombre+"-01-02" 
                   
    document.getElementById('loader').style.display = 'block';            
        //$("#loader").style = "display:block";
        //alert('aqui empieza');
//        
        
       $.ajax({url: controlador,
           type:"POST",
           data:{fecha_hasta:fecha_hasta, programa_id:programa_id, gestion_inicio:gestion_inicio,
                 gestion_id:gestion_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta); 
               if (registros == "no"){
                   alert('No existe Inventario para este programa hasta esta fecha.');
               }else{
                    var cant_total = 0;
                    var precio_total = 0;
                    var n = registros.length;
                    var estilo =  "style='font-size:12px'";
                    
                    html2 = "";
                    html = "";
                    html += "<table style='width: 19.59cm' class='table table-striped' id='mitabla'>";
                    html += "<tr>";
                    html += "<th "+estilo+">#</th>";
                    html += "<th "+estilo+">DETALLE</th>";
                    html += "<th "+estilo+">UNIDAD</th>";
                    html += "<th "+estilo+">CODIGO</th>";
                    html += "<th "+estilo+">CANT.</th>";
                    html += " <th "+estilo+">PREC. UNIT.<br>Bs.</th>";
                    html += "<th "+estilo+">PREC. TOTAL<br>Bs.</th>";
                    html += "</tr>";
                    
                    var num = 0;
                    var saldos = 0;
                    
                    html += "<tbody class='buscar' id='tablaresultados'>";
                    var articulos = [];
                    var precios = [];
                    
                    for(var i = 0; i < n ; i++){
                        
                        saldos = Number(registros[i]["ingresos"]) - Number(registros[i]["salidas"]);
                        
                        
                        if(Number(saldos)>0){
                            html += "<tr>";
                            cant_total = Number(cant_total)+Number(Number(registros[i]["precio_unitario"]*Number(saldos)))
                            html += "<td "+estilo+">"+(num+1)+"</td>";
                            html += "<td "+estilo+">"+registros[i]["articulo_nombre"]+"<sub class='no-print'><small>["+registros[i]["articulo_id"]+"]</small></sub>  </td>";
                            html += "<td class='text-center' "+estilo+">"+registros[i]["articulo_unidad"]+"</td>";
                            html += "<td class='text-center' "+estilo+">"+registros[i]["articulo_codigo"]+"</td>";
                            
                            
                            if (Number(saldos) % 1 == 0){
                                html += "<td class='text-center' "+estilo+">"+numberFormat(Number(saldos).toFixed(decimales))+"</td>";
                                //html += "<td style='text-align: right'>"+numberFormat(registros[i]["saldo"])+"</td>";
                            }
                            else{
                                html += "<td class='text-center' "+estilo+">"+numberFormat(Number(saldos).toFixed(decimales))+"</td>";
                                //html += "<td style='text-align: right'>"+numberFormat(Number(registros[i]["saldo"]).toFixed(decimales))+"</td>";                                
                            }
                            
                            
                            html += "<td class='text-right' "+estilo+">"+numberFormat(Number(registros[i]["precio_unitario"]).toFixed(decimales))+"</td>";
                            
                            precio_total = numberFormat(Number(Number(registros[i]["precio_unitario"]*Number(saldos))).toFixed(decimales));
                            html += "<td class='text-right' "+estilo+">"+precio_total+"</td>";

                            
                            html += "<td class='no-print' style='padding: 0;'>";     
                            
                            html += "<button type='button' class='btn btn-warning btn-xs' data-toggle='modal' data-target='#modalingresos' title='Ver ingresos' onclick='buscar_ingresos("+registros[i]["programa_id"]+","+registros[i]["articulo_id"]+")'>";
                            html += "<fa class='fa fa-list-alt'></fa> </button>";
                            html += "</td>";
                            
                            html += "<td class='no-print' style='padding: 0;'>";     
                            html += "<button type='button' class='btn btn-facebook btn-xs' style='background-color: black;' title='Rectificar kardex' onclick='reajustar_kardex("+registros[i]["articulo_id"]+")'>";
                            html += "<fa class='fa fa-cubes'></fa> </button>";
                            
                            html += "</td>";

                           
//                            html += "<td><div id='verificar"+(num+1)+"'>verificar"+(num+1)+"</div></td>";
                            html += "<td class='no-print'><div id='verificar"+(num+1)+"'></div></td>";
                            html += "<td class='no-print'><div id='mensaje"+(num+1)+"'></div></td>";
                            //html += "<td><div id='verificar"+registros[i]["articulo_id"]+"'></div></td>";
                            
                            articulos.push(registros[i]["articulo_id"]);
                                precios.push(precio_total);

                            html += "</tr>";
                            num++;
                        }
                        
                    }
                    
                    convertiraliteral(Number(cant_total).toFixed(decimales));
                    obtenercodigo(programa_id);
                    html += "</tbody>";
                    html += "</table>";
                    var titulo_prog = $("#programa_id option:selected").text();
                    
                    $("#elprograma").html(titulo_prog);
                    
                   fecha1 = gestion_nombre+"-01-01" 
                   fecha2 = gestion_nombre+"-01-02" 
                   
                   //alert(fecha1+" - "+fecha_hasta);
                   
                    if (fecha1 == fecha_hasta || fecha2 == fecha_hasta){
                        
                        $("#lafecha").html("INVENTARIO INCIAL AL "+moment(fecha_hasta).format('DD/MM/YYYY'));
                    }else{                        
                        $("#lafecha").html("INVENTARIO AL "+moment(fecha_hasta).format('DD/MM/YYYY'));
                    }
                    
                    
                    $("#elmantenimiento").html($('input:radio[name=mantenimiento]:checked').val());
                    
                    $("#tablaresultados").html(html);
                    var html1 ="";
                    html1 += "<table style='width: 19.59cm; font-size: 12px' class='text-bold' id='mitabla'>";
                    html1 += "<tr>";
                    html1 += "<th style='text-align: right; font-size: 12px' class='estdline' colspan='2'> TOTAL:";
                    html1 += "</th>";
                    html1 += "<th style='text-align: right; font-size: 12px' class='estdline' colspan='5'>"+numberFormat(Number(cant_total).toFixed(decimales))+" Bs.";
                    html1 += "</th>";
                    html1 += "</tr>";
                    html1 += "<tr>";
                    html1 += "<th style='text-align: right; font-size: 12px' class='estdline' colspan='2'> LITERAL:";
                    html1 += "</th>";
                    html1 += "<th style='text-align: right; font-size: 12px' class='estdline' colspan='5'><span id='literal'></span>";
                    html1 += "</th>";
                    html1 += "</tr>";
                    html1 += "</table>";
                    
                    html1 += "<input type='hidden' id='total_inventario' value='"+cant_total.toFixed(decimales)+"' readonly/>";
                    
                    html1 += "<button type='button' class='btn btn-primary btn-xs no-print' data-toggle='modal' data-target='#modalinventario'>";
                    html1 += "<fa class='fa fa-cubes'></fa>";
                    html1 += "  Generar inventario inicial";
                    html1 += "</button>";
                    
                    $("#tablaresultados1").html(html1);
                    
                    mensaje_titulo = "Mostrar la lista de Articulos del programa seleccionado";
                    html2 +=" <a class='btn btn-success btn-sm' onclick='tablaresultadosprogramainv()' title='"+mensaje_titulo+"'>";
                    html2 +="     <i class='fa fa-check'></i> Mostrar";
                    html2 +=" </a>";
                    
                    mensaje_titulo = "Muestra la vista previa de impresión";
                    html2 +=" <a class='btn btn-facebook btn-sm' onclick='imprimir()' tittle='"+mensaje_titulo+"'>";
                    html2 +="     <i class='fa fa-print'></i> Imprimir";
                    html2 +=" </a>";

                    mensaje_titulo = "Reajusta los ingresos por Articulo con las salidas, actualizando los saldo totales";
                    html2 +=" <a class='btn btn-primary btn-sm' onclick='reajustar_inventario()' title='"+mensaje_titulo+"'>";
                    html2 +="     <i class='fa fa-list'></i> Reajustar";
                    html2 +=" </a>";

                    mensaje_titulo = "Rectifica el Kardex en función a la metología PEPS, de toda la lista de Articulos del programa seleccionado";
                    html2 +=" <a class='btn btn-facebook btn-sm' style='background-color: black;' onclick='reajustar_kardex_global()' title='"+mensaje_titulo+"'>";
                    html2 +="     <i class='fa fa-cubes'></i> Reajustar";
                    html2 +=" </a>";

                    mensaje_titulo = "Realiza una analisis para verificar la consistencia entre el SALDO del INVENTARIO y el SALDO DEL KARDEX";
                    
                    html2 +=" <a class='btn btn-info btn-sm' onclick='verificar_kardex("+JSON.stringify(articulos)+","+JSON.stringify(precios)+")' title='"+mensaje_titulo+"'>";
                    html2 +="     <i class='fa fa-eye'></i> Verificar";
                    html2 +=" </a>";
                    $("#div_botones").html(html2);
                    
                    document.getElementById('loader').style.display = 'none';
            }
                
        },
        error:function(respuesta){
          
          alert('No existe Inventario para este programa hasta esta fecha.');
           html = "";
           $("#tablaresultados").html(html);
           document.getElementById('loader').style.display = 'none';
        }
        
    });   
    

}

//Generar inventario inicial
function inventario_inicial(){
    
    var controlador    = "";
    var base_url       = document.getElementById('base_url').value;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var programa_id    = document.getElementById('programa_id').value;
    var gestion_inicio = document.getElementById('gestion_inicio').value;
    var gestion_id     = document.getElementById('gestion_id').value;
    var total_inventario     = document.getElementById('total_inventario').value;
    var gestion_descripcion    = document.getElementById('gestion_descripcion').value;
    var gestion_fecha     = document.getElementById('gestion_fecha').value;
    var html = ""
    
    controlador        = base_url+'programa/inventarioinicial/';
    
    document.getElementById("modalgenerar").style = "display:none";
    document.getElementById("modalloader").style = "display:block";

    
       $.ajax({url: controlador,
           type:"POST",
           data:{fecha_hasta:fecha_hasta, programa_id:programa_id, gestion_inicio:gestion_inicio, total_inventario:total_inventario,
                 gestion_id:gestion_id, gestion_descripcion: gestion_descripcion, gestion_fecha: gestion_fecha},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta); 
 
                
        },
//        error:function(respuesta){
//          
//          alert('No existe Inventario para este programa hasta esta fecha.');
//           html = "";
//           $("#tablaresultados").html(html);
//        }
        
    });   
    
    document.getElementById("modalloader").style = "display:none";    
    document.getElementById("modalgenerar").style = "display:block";
    
    alert("Operación finalizada correctamente...!");
    document.getElementById("boton_cerrarmodal").click();
    

}

function convertiraliteral(numero)
{
    var controlador = "";
    var base_url       = document.getElementById('base_url').value;
    controlador        = base_url+'programa/convertiraliteral/';
    
       $.ajax({url: controlador,
           type:"POST",
           data:{numero:numero},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta); 
               if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    $("#literal").html(registros);
            }
        },
        error:function(respuesta){
          
          alert('No existe movimiento para este programa.');
           html = "";
           $("#literal").html(html);
        }
        
    });
}

function obtenercodigo(programa_id)
{
    var controlador = "";
    var base_url       = document.getElementById('base_url').value;
    controlador        = base_url+'programa/obtenercodigo/';
    
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta); 
               if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    $("#elcodigo").html(registros);
            }
        },
        error:function(respuesta){
          
          alert('No el programa.');
           html = "";
           $("#elcodigo").html(html);
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
    
    
function buscar_ingresos(programa_id, articulo_id){
    
    
    var base_url       = document.getElementById('base_url').value;
    var controlador        = base_url+'programa/buscar_ingresos/';
    var gestion_id     = document.getElementById('gestion_id').value;
    
    //alert(programa_id+" "+articulo_id+" "+gestion_id);
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id, articulo_id:articulo_id, gestion_id:gestion_id},
           success:function(respuesta){
              
               var registros =  JSON.parse(respuesta); 
               
                if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    
                   html ="";
                   var enlace = "";
                    tam = registros.length;
                    //alert(tam);
                    html += "<b>"+registros[0]["articulo_nombre"]+"</b>";
                    html +="<table class='table table-striped' id='mitabla'>";
                    html +="<tr>";
                        html +="<th>#</th>";
                        html +="<th>INGRESO</th>";
                        html +="<th>FECHA</th>";
                    html +="</tr>";
                    
                    for (i=0;i<tam;i++){
                        numero = i+1;
                        
                       html +="<tr>";
                       html +="<td>"+numero+"</td>";
                       html +="<td>"+registros[i]["ingreso_numdoc"]+"</td>";
                       html +="<td>"+formato_fecha(registros[i]["ingreso_fecha_ing"])+"</td>";
                       enlace = base_url+"ingreso/pdf/"+registros[i]["ingreso_id"];
                       html +="<td><a href='"+enlace+"' class='btn btn-xs btn-success' target='_BLANK'><fa class='fa fa-print'></fa> </a></td>";
                       
                       html +="</tr>";
                        
                    } 
                    html +="</table>";
                    
                    $("#ingreso_articulos").html(html);
            }
        },
        error:function(respuesta){
          
          alert('No existe el programa.');
           html = "";
           $("#elcodigo").html(html);
        }
        
    });    
    
}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function reajustar_inventario(){
    
    
    var base_url       = document.getElementById('base_url').value;
    var controlador        = base_url+'programa/reajustar_inventario/';
    var gestion_id     = document.getElementById('gestion_id').value;
    var programa_id    = document.getElementById('programa_id').value;
    
    document.getElementById('loader').style.display = 'block';
    
    //alert(controlador);
    if (programa_id>0){
        
            var opcion = confirm("Esta operación afectará de forma permanente a la Base de Datos. ¿Desea Continuar?");
            if (opcion == true) {

                    $.ajax({url: controlador,
                        type:"POST",
                        data:{programa_id:programa_id, gestion_id:gestion_id},
                        success:function(respuesta){

                             tablaresultadosprogramainv();
                             alert('Proceso finalizado con éxito..!!');
                             document.getElementById('loader').style.display = 'none';
                         },
                         error:function(respuesta){

                         alert('No existe el programa.');

                     }

                 });    

            }
        
    }
    else{
        alert("ERROR: Debe seleccionar un Programa...!");
        document.getElementById('loader').style.display = 'none';
    }
   
    
}

//articulos -> los id de los articulos //precios -> precios de los articulos
function verificar_kardex(articulos, precios){
    
    
    document.getElementById('loader').style.display = 'block';
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_ingreso/saldo_kardex";
    var gestion_inicio = document.getElementById('gestion_inicio').value;
    var gestion_id     = document.getElementById('gestion_id').value;
    var fecha_desde    = gestion_inicio;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var programa_id    = document.getElementById('programa_id').value;    

    // Primero, registramos parametros iniciales
    var resultados = [];            
        var fin = articulos.length; 
        var articulo_antiguo = -1;
        var indice_antiguo = -1;
        var duplicado = 0;
       // alert(articulos.length+" == "+precios.length);
       // alert(precios);

        //Segundo, Recorremos los id de los articulos
        for (var i=0; i < fin; i++){
        
            var html = ""; 
            
            articulo_id = articulos[i];
            indice = i + 1;

            document.getElementById('loader').style.display = 'block';
            $.ajax({url: controlador,
                  type:"POST",
                  data:{programa_id:programa_id, gestion_id:gestion_id, articulo_id:articulo_id, fecha_desde:fecha_desde, fecha_hasta: fecha_hasta, gestion_inicio:gestion_inicio},
                  async: false,
                  success:function(respuesta){

                        var res =  JSON.parse(respuesta);
            
                        resultados.push(res);  
                        html += "<b style='font-size: 10px;'>"+res+"</b>";
                        $("#verificar"+indice).html(html);
            
                        //alert(articulo_antiguo+" != "+articulo_id);
                        
                        if (Number(articulo_antiguo) != Number(articulo_id)){
                            

                            articulo_antiguo = articulo_id;
                            
                            if (res != precios[i]){ //si el precio es diferente al del kardex                          
                                                   
                              //alert(i+"< ("+(fin-1)+") = "+ (i < (fin-1))); //ok pasa
                              
                               if(i < (fin-1)){ //si no llego al final
                                   
//                                   alert(articulo_id+" == "+(articulos[i+1]) +" = " +(Number(articulo_id) == Number(articulos[i+1]))+
//                                         "\n"+res+" == "+precios[i]+" = "+res == precios[i])
                                    //alert("CONSULTA: ");
                                    
                                   if(Number(articulos[i]) == Number(articulos[i+1])){ //verifica si el id es igual al id + 1
 
                                        let precio1 = precios[i]+"";
                                        precio1 = precio1.replace(",","");
                                        
                                        let precio2 = precios[i+1]+"";
                                        precio2 = precio2.replace(",","");
                                        
                                        let total_kardex = res+"";
                                        total_kardex = total_kardex.replace(",","");
//                                        let precio_total = Number(precios[i]) + Number(precios[i+1]);
                                      
    
                                        let precio_total = Number(precio1) + Number(precio2);
//                                        alert("Precio1: "+precio1+" * Precio2: "+precio2+" = "+precio_total);
    //                                    alert("Articulo_id:"+articulos[i]+" res: "+res+" == precio_total: "+precio_total+" => "+(Number(res) == Number(precio_total)));
                                        //alert(Number(total_kardex)+"=="+ Number(precio_total));
                                        
                                        if (Number(total_kardex) == Number(precio_total)){
                                            
                                            html2 = "<a href='"+base_url+"detalle_ingreso/kardex/"+programa_id+"/"+articulo_id+"/"+fecha_desde+"/"+fecha_hasta+"/"+gestion_inicio+"' class='btn btn-info btn-xs' target='_blank' id='boton"+indice+"'><fa class='fa fa-list'></fa> Kardex</a>";
                                            $("#mensaje"+indice).html(html2);
                                            
                                        }
                                        else{
                                            html2 = "<a href='"+base_url+"detalle_ingreso/kardex/"+programa_id+"/"+articulo_id+"/"+fecha_desde+"/"+fecha_hasta+"/"+gestion_inicio+"' class='btn btn-danger btn-xs' target='_blank' id='boton"+indice+"'><fa class='fa fa-list'></fa> Inconsistencia</a>";
                                            $("#mensaje"+indice).html(html2);
                                        }
                                   }else{
                                       
                                        html2 = "<a href='"+base_url+"detalle_ingreso/kardex/"+programa_id+"/"+articulo_id+"/"+fecha_desde+"/"+fecha_hasta+"/"+gestion_inicio+"' class='btn btn-danger btn-xs' target='_blank' id='boton"+indice+"'><fa class='fa fa-list'></fa> Inconsistencia</a>";
                                        $("#mensaje"+indice).html(html2);
                                   }
                                   
                                  
                               }else{
                              
                                    html2 = "<a href='"+base_url+"detalle_ingreso/kardex/"+programa_id+"/"+articulo_id+"/"+fecha_desde+"/"+fecha_hasta+"/"+gestion_inicio+"' class='btn btn-danger btn-xs' target='_blank' id='boton"+indice+"'><fa class='fa fa-list'></fa> Inconsistencia</a>";
                                    $("#mensaje"+indice).html(html2);
                                }
                            }
                            else{ //Si el precio es igual al del kardex
                                html2 = "<a href='"+base_url+"detalle_ingreso/kardex/"+programa_id+"/"+articulo_id+"/"+fecha_desde+"/"+fecha_hasta+"/"+gestion_inicio+"' class='btn btn-info btn-xs' target='_blank' id='boton"+indice+"'><fa class='fa fa-list'></fa> Kardex</a>";
                                $("#mensaje"+indice).html(html2);
                            }

                            if(duplicado==1){ //Esto deberia cambiar el color de fondo pero no hace nada aun -> revisar
                                //alert("#boton"+indice_antiguo);
                                                      
                                duplicado = 0;                                
                            }
                            
                        }else{
                            
                            articulo_antiguo = articulo_id;
                            indice_antiguo = indice-1;
                            duplicado = 1;
                        }
                        
                        document.getElementById('loader').style.display = 'none';
                      
                   },
                   error:function(respuesta){
                    
                    document.getElementById('loader').style.display = 'none';

                   alert('No existe el programa.');

                  }
              });   
              

        }
 
}

function reajustar_kardex(articulo_id){
    
    
    var base_url       = document.getElementById('base_url').value;
    var controlador    = base_url+'programa/reajustar_kardex/';
    var gestion_id     = document.getElementById('gestion_id').value;
    var programa_id    = document.getElementById('programa_id').value;
    
    //alert(controlador);

    //alert(controlador);
    if (programa_id>0){
        
            var opcion = confirm("Esta operación afectará de forma permanente a la Base de Datos y los registros de salida. ¿Desea Continuar?");
            if (opcion == true) {    
    
                document.getElementById('loader').style.display = 'block';
                $.ajax({url: controlador,
                    type:"POST",
                    data:{programa_id:programa_id, gestion_id:gestion_id, articulo_id: articulo_id},
                    success:function(respuesta){
                        
                        var x =  JSON.parse(respuesta);
                        
                        if (x=='error'){
                            alert('Proceso de reajuste de Kardex Finalizado: SE DETECTO UNA INCOSISTENCIA EN LAS SALIDAS, que no sigue el principio PEPS. Debe ser revisada..!!');                            
                        }else{
                            alert('Proceso de reajuste de Kardex, finalizado con exito..!!');
                        }
                        document.getElementById('loader').style.display = 'none';
                     },
                     error:function(respuesta){
                        document.getElementById('loader').style.display = 'none';
                        alert('No existe el programa.');

                 }

             });    
    
            }
        
    }
    else{
        alert("ERROR: Debe seleccionar un Programa...!");
    }
            
}

function reajustar_kardex_global(){
    
    
    var base_url       = document.getElementById('base_url').value;
    var controlador    = base_url+'programa/reajustar_kardex_global/';
    var gestion_id     = document.getElementById('gestion_id').value;
    var programa_id    = document.getElementById('programa_id').value;
    
    //alert(controlador);

    //alert(controlador);
    if (programa_id>0){
        
            document.getElementById('loader').style.display = 'block';
            var opcion = confirm("Esta operación afectará de forma permanente a la Base de Datos y los registros de salida. ¿Desea Continuar?");
            if (opcion == true) {    
    
                $.ajax({url: controlador,
                    type:"POST",
                    data:{programa_id:programa_id, gestion_id:gestion_id},
                    success:function(respuesta){
                        
                        var x =  JSON.parse(respuesta);
                        
                        if (x=='echo'){
                            alert('Proceso de reajuste de Kardex, finalizado con exito..!!');
                        }else{
                            alert(JSON.stringify(x));                            
                        }

                        document.getElementById('loader').style.display = 'none';
                     },
                     error:function(respuesta){
                        document.getElementById('loader').style.display = 'none';
                        alert('No existe el programa.');

                 }

             });    
    
            }
        
    }
    else{
        alert("ERROR: Debe seleccionar un Programa...!");
    }
    
}