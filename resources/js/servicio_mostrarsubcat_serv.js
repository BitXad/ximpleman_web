$(document).on("ready",inicio);
function inicio(){
    resultadosubcatservicio();
}

function getsubcat_serv(catserv_id){
    const promise = new Promise(function (resolve, reject) {
    //var html = "";
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'categoria_servicio/obtenersubcatserv/'+catserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var res = "";
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    for (var i = 0; i < n ; i++){
                        //alert(registros[i]['subcatserv_descripcion']);
                        res += (i+1)+".- "+registros[i]['subcatserv_descripcion']+"<br>";
                        //alert(res);
                   }
               }
               //alert(res);
               resolve(res);
        },
        error:function(error){
            reject(error);
        }
        
    });
    });
  
  return promise;
}

async function processData (catserv_id) {
  try {
    const result = await getsubcat_serv(catserv_id);
    $('#catservicio'+catserv_id).html(result);
    //console.log(result);
    return "";
  } catch (err) {
    return console.log(err.message);
  }
}

/* **************Dibuja las categorias y sus detalles de servicio *************** */
function resultadosubcatservicio(){
    
    var base_url      = document.getElementById('base_url').value;
    var controlador   = base_url+"categoria_servicio/getcatserv_detalle/";
     
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    
                    html = "";
                    for (var i = 0; i < n ; i++){
                        if(registros[i]['catserv_id'] != 0){
                            
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        html += "<td>"+registros[i]["catserv_descripcion"]+"</td>";
                        processData(registros[i]["catserv_id"]);
                        html += "<td><span id='catservicio"+registros[i]["catserv_id"]+"'></span></td>";
                        html += "<tr>";
                       //alert(registros[i]["catserv_id"]);
                        
                        }
                        
                    }
                    $("#subcatserv").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#subcatserv").html(html);
        }
        
    });   

}
