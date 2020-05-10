function ventaproducto(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
    
                  
            tablareproducto();             
        
    } 

    
}
function tablareproducto()
{   
	var base_url = document.getElementById('base_url').value;
   
    var controlador = base_url+'compra/buscarcompra';
    var parametro = document.getElementById('vender').value;
    var estilo = "style='padding:0;'";    
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                            
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>N</th>";
                    html += "<th>ID</th>";
                    html += "<th>Producto</th>";
                    html += "<th>Precio</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    
                    for (var i = 0; i < n ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('cotizacion/insertarproducto/')"; 
                      
                        html += "<td "+estilo+">"+(i+1)+"</td>";
                        html += "<td "+estilo+">";
                        
                        html += "<div clas='row'>";                                            
                        
                        html += "<b>"+registros[i]["producto_id"]+"</b>";
                        html += "</td>";

                        html += "<td "+estilo+">";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";                        
                        html += "</td>";

                        html += "<td  "+estilo+">";
                        html += Number(registros[i]["producto_precio"]).toFixed(2);
                        html += "</td>";
                        
                        html += "<td "+estilo+">";
                        html += "<button type='button' onclick='selecproducto("+registros[i]["producto_id"]+")' class='btn btn-primary btn-xs'><i class='fa fa-check'></i></button>";                        
                        html += "</td>";                       
                        html += "</tr>";

                   }
                       html += "</tbody>"
                   
                   $("#modalproducto").html(html);
                   $("#boton_productos").click();
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
        
    });    

}

function selecproducto(producto)
{
	$("#producto_id").val(producto);
	var base_url    = document.getElementById('base_url').value;
	var controlador = base_url+"promocion/nomproducto/"+producto;

	 $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(report){  
            var registros =  JSON.parse(report);
            var nombre = registros["producto_nombre"];
            var precio = registros["producto_precio"];
            
            $("#vender").val(nombre);
            $("#promocion_titulo").val("PROMOCIÓN "+nombre);
            $("#promocion_cantidad").val(1);
            $("#promocion_preciototal").val(precio);
            $("#promocion_descripcion").val(nombre);
            
            $("#cancelar_preferencia").click();
            
	}
});
}