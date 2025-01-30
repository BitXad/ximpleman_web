
function cargar_vehiculo(){
    
    let vehiculo_id = 1; //SOlo para efectos de prueba

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/get_asientos/';
    var html = "";

    $.ajax({url: controlador,
            type:"POST",
            data:{vehiculo_id:vehiculo_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
                for(var i=0; i<registros.length; i++){

                    if (registros != null){                  
                         html = "";
                         //if(Number(registros['asiento_x'])>=0 && Number(registros['asiento_y'])>=0){

                           // alert("aqui cosas..!");
                             html += "<button class='btn btn-default' style='font-size: 9px;' onclick='registrar_pasaje("+registros[i]["asiento_id"]+")'>";
                             html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                             html += "<br>"+registros[i]["asiento_numero"];
                             html += "</button>";
                             //alert("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]);
                             $("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
                        // }


                     }
                }
            },
            error:function(respuesta){
                
            }
    });   

}


function registrar_pasaje(asiento_id){
    //alert("fadsfdas");
    $("#button_modal").click();
    
}