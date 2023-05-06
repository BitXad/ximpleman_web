function buscaarticulo(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
       
        if (opcion==3){  
            tablaresultados(1);    

        } 
        
    } 

    
} 

//Tabla resultados de la busqueda de particulos
function tablaresultados(opcion)
{   
    var controlador = "";
    var parametro = "";
    var programa_id = document.getElementById('programa_id').value;
   
    var base_url = document.getElementById('base_url').value;
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var gestion_inicio = document.getElementById('gestion_inicio').value;
    
    if (opcion == 1){
        controlador = base_url+'programa/buscar/';
        parametro = document.getElementById('articulobus').value 
        
    }
   
       $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro,programa_id:programa_id,fecha_desde:fecha_desde,fecha_hasta:fecha_hasta},
           success:function(respuesta){     
               
                     
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length;
                    html = "";
                 
                    
                    	html += " <table class='table table-striped' id='mitabla'>";
                       	 html += "<tr>";
                         html += "<th>#</th>";
                         html += "<th>Nombre</th>";
                         html += "<th>Unidad</th>";
                         html += "<th>Marca</th>";
                         html += "<th>Industria</th>";
                         html += " <th>Prec.</th>";
                         html += "<th>Saldo</th>";
                         html += "<th></th>";
                         
                       	 html += "</tr>";
                  
                    for (var i = 0; i < n ; i++){
                                             
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b><font size=2>"+registros[i]["articulo_nombre"]+"</font>    ("+registros[i]["articulo_codigo"]+")</b></td>";
                       	html += "<td>"+registros[i]["articulo_unidad"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_marca"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_industria"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_precio"]+"</td>";
                       	html += "<td>"+registros[i]["sumas"]+"</td>";
                        html += "<td><a href='"+base_url+"detalle_ingreso/kardex/"+programa_id+"/"+registros[i]["articulo_id"]+"/"+fecha_desde+"/"+fecha_hasta+"/"+gestion_inicio+"' type='button'  target='_blank' class='btn btn-success btn-xs'><span class='fa fa-list'></span> Ver Kardex</a></td>";
                     
                        html += "</tr>";
                        

                   }
                 		html += "</table>";
                   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(respuesta){
          
          alert('No existe kardex para un articulo de esas caracteristicas en el programa seleccionado dentro el rango de fechas.');
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

//function kardex(programa_id,articulo_id)
//{
//
//}