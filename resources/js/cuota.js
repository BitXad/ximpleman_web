function facturar(cuota){
	 
     var base_url = document.getElementById('base_url').value;
     var controlador = base_url+'cuotum/detallecuota/';

     $.ajax({url: controlador,
           type:"POST",
           data:{cuota:cuota},
           success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                 		html = "";

                        html += "<label for='detalle' class='control-label'>Detalle</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='text' name='detalle' value='pago de cuota No. "+registros["cuota_id"]+"/credito "+registros["credito_id"]+" ' class='form-control' id='detalle' />";
                        html += "</div>";
                    	//alert(registros["cuota_id"]);
                       $("#detallec"+registros["cuota_id"]+"").html(html);
                     
                       
          }  
        },
        error:function(respuesta){
          
       
   }
    });
}