//Tabla de resultados del programa seleccionado
function programa_articulos(){
    
    var controlador    = "";
    var base_url       = document.getElementById('base_url').value;
    var programa_id    = document.getElementById('programa_id').value;
    var gestion_id     = document.getElementById('gestion_id').value;
    controlador        = base_url+'programa/mostrar_articulos/';
    var decimales = document.getElementById('decimales').value;
    
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id,gestion_id:gestion_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta); 
               if (registros == "no"){
                   alert('No existe Inventario para este programa hasta esta fecha.');
               }else{
                   
                    var cant_total = 0;
                    var n = registros.length;
                    var estilo =  "style='font-size:12px'";
                    html = "";
                    html += "<table style='width: 19.59cm' class='table table-striped' id='mitabla'>";
                    html += "<tr>";
                    html += "<th "+estilo+">#</th>";
                    html += "<th "+estilo+">DETALLE</th>";
                    html += "<th "+estilo+">UNIDAD</th>";
                    html += "<th "+estilo+">CODIGO</th>";
                    html += "<th "+estilo+">CANT.</th>";
                    html += " <th "+estilo+">PREC. UNIT.<br>Bs.</th>";
                    html += "</tr>";
                    var num = 0;
                    
                    html += "<tbody class='buscar' id='tablaresultados'>";
                    
                    for(var i = 0; i < n ; i++){
                        
                            html += "<tr>";                            
                            html += "<td "+estilo+">"+(num+1)+"</td>";
                            html += "<td "+estilo+">"+registros[i]["articulo_nombre"]+"<sub><small>["+registros[i]["articulo_id"]+"]</small></sub></td>";
                            html += "<td class='text-center' "+estilo+">"+registros[i]["articulo_unidad"]+"</td>";
                            html += "<td class='text-center' "+estilo+">"+registros[i]["articulo_codigo"]+"</td>";
                            html += "<td class='text-center' "+estilo+">"+numberFormat(Number(registros[i]["compras"]).toFixed(decimales))+"</td>";
                            html += "<td class='text-right' "+estilo+">"+numberFormat(Number(registros[i]["articulo_precio"]).toFixed(decimales))+"</td>";

                            html += "<td class='no-print'>";                    
//                            html += "<button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#modalingresos' title='Ver ingresos' onclick='buscar_ingresos("+registros[i]["programa_id"]+","+registros[i]["articulo_id"]+")'>";
//                            html += "<fa class='fa fa-cubes'></fa> </button>";
                            
                            html += "</td>";

                            html += "</tr>";
                            num++;
                        
                        
                    }
                    
                    $("#tablaresultados1").html(html);
                   
            }
                
        },
        error:function(respuesta){
          
          alert('No existe Inventario para este programa hasta esta fecha.');
           html = "";
           $("#tablaresultados").html(html);
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
    
    //alert(controlador);

    
    
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id, gestion_id:gestion_id},
           success:function(respuesta){
               
              alert('proceso finalizado con exito..!!');
              
            },
            error:function(respuesta){
          
            alert('No existe el programa.');

        }
        
    });    
    
}
    
function reajustar_kardex(articulo_id){
    
    
    var base_url       = document.getElementById('base_url').value;
    var controlador        = base_url+'programa/reajustar_kardex/';
    var gestion_id     = document.getElementById('gestion_id').value;
    var programa_id    = document.getElementById('programa_id').value;
    
    //alert(controlador);

    
    
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id, gestion_id:gestion_id, articulo_id: articulo_id},
           success:function(respuesta){
               
                alert('Proceso de reajuste de Kardex, finalizado con exito..!!');
              
            },
            error:function(respuesta){
          
            alert('No existe el programa.');

        }
        
    });    
    
}