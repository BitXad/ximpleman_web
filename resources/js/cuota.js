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
                        html += "<input type='text' name='detalle' value='PAGO DE CUOTA No. "+registros["cuota_numcuota"]+"/credito "+registros["credito_id"]+" ' class='form-control' id='detalle' />";
                        html += "</div>";
                    	//alert(registros["cuota_id"]);
                       $("#detallec"+registros["cuota_id"]+"").html(html);
                       document.getElementById('clinit'+cuota).style.display = 'block';
                       
                       
                       
          }  
        },
        error:function(respuesta){
          
       
   }
    });
}

function enviar_formulario(cuota_id){
  var base_url    = document.getElementById('base_url').value;
   document.getElementById("finpagar"+cuota_id).submit();
   facturarcuota(cuota_id);
}




function facturarcuota(cuota_id){
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/generar_factura/';
   
   var factura = document.getElementById('factura').value;
   var detalle_factura = document.getElementById('detalle').value;
  if(factura!=null && detalle!=null){
   
   var venta_id = document.getElementById('ventita').value;
   var fecha_venta = document.getElementById('cuota_fecha').value;
   var detalle_precio = document.getElementById('cuota_cancelado'+cuota_id).value;
   var nit = document.getElementById('cuota_nit'+cuota_id).value;
   var razon_social = document.getElementById('cuota_razon'+cuota_id).value;
   //var cuota_numcuota = document.getElementById('cuota_numcuota').value;
  // var credito_id = document.getElementById('credito_id').value;
  // var cuota_numercibo = document.getElementById('cuota_numercibo').value;
   //var venta_id = cuota_id;
   var detalle_cantidad = 1;
   var detalle_unidad= 'CUOTA';
   var factura_efectivo  = detalle_precio;
   var llave_foranea  = 'cuota_id';
   var llave_valor = cuota_id;
   var factura_cambio = 0;
   var factura_cambio = 0;
   var tipotrans_id = 1;
   $.ajax({url: controlador,
           type:"POST",
           data:{nit:nit,razon_social:razon_social,fecha_venta:fecha_venta,detalle_cantidad:detalle_cantidad,detalle_precio:detalle_precio,
             detalle_unidad:detalle_unidad,detalle_factura:detalle_factura,factura_efectivo:factura_efectivo,
             factura_cambio:factura_cambio,tipotrans_id:tipotrans_id,llave_foranea:llave_foranea,llave_valor:llave_valor},
           success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
            
        },
        error:function(respuesta){
          
       
   }
    });
  }
   
   
}