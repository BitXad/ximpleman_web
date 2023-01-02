$(document).on("ready",inicio);
function inicio(){
    cargar_catalogo();
}

/* funcion encargada de llenar con informacion el catalogo!! */
function cargar_catalogo(){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"clasificador/cargar_catalogo";
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({
        url: controlador,
        type:"POST",
        data:{},
        success: function(resultado){
            
            var inv = JSON.parse(resultado);
            if (inv != null){
                alert("Catalogo cargado");
                tabla_clasificadorinventario();
            }
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax 
}

function tabla_clasificadorinventario(){
    var base_url = document.getElementById("base_url").value;
    var parametro = document.getElementById("filtrar").value;
    var controlador = base_url+"clasificador/mostrar_clasificadorinventario";
    var elclasificador = JSON.parse(document.getElementById('elclasificador').value);
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
      
    $.ajax({
        url: controlador,
        type:"POST",
        data:{parametro:parametro},
        success: function(resultado){
        
            var datos = JSON.parse(resultado);
            var inv = datos.resultado;
            var elmaximo = datos.elmaximo;
            
            var tamanio = inv.length;
            //var taman1 = elclasificador.length;
            //alert(tamanio);
            maximo = elmaximo["maximo"];
            html = "";
            html += "<table class='table table-striped table-bordered' id='mitabla' >";
                html += "<tr>";
                html += "	<th>#</th>";
                html += "	<th>Descripción</th>";
                //var cabecera = [];
            for (var k = 0; k < maximo ; k++){
                //cabecera.push(elclasificador[k]["clasificador_nombre"]);
                html += "	<th>"+elclasificador[k]["clasificador_nombre"]+"</th>";
            }
                html += "	<th>Total</th>";
                html += "</tr>";
                html += "<tbody class='buscar'>";
                           
            if (inv != null){
                    var total = 0;
                    var total_final = 0;
                    //var existencia = 0;
                    var margen = " style='padding:0'";
                    //var categoria = "";
                    
                for (var i = 0; i < tamanio ; i++){
                   
                    //alert('dentra aqui: '+i+"/"+tamanio);
                    /*if (categoria != inv[i]["categoria_nombre"]){                        
                        html += "<tr><td colspan='13'><b>"+inv[i]["categoria_nombre"]+"<b></tr>";
                    }*/   

                        html += "<tr "+margen+">";

                                    //total = inv[i]["c"+(i+1)]; 
                                    //total_final += total;
                                    /*existencia = parseFloat(inv[i]["existencia"]);
                                    */
                        html += "             	<td "+margen+">"+(i+1)+"</td>";
                        html += "<td"+margen+">";
                        var mimagen = "";
                        if(inv[i]["catalogo_foto"] != null && inv[i]["catalogo_foto"] !=""){
                            //mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+inv[i]["catalogo_foto"]+"' width='60' height='60' />";
                            //mimagen += "</a>";
                        }else{
                            mimagen = "<img src='"+base_url+"resources/images/productos/thumb_image.png' width='60' height='60' />";
                        }
                        html += "<div style='display:flex'>"+mimagen;
                        html += "<div style='padding-left:2px'><font size='0.5'>"+inv[i]["catalogo_nombre"];
                        html += "<br>"+inv[i]["catalogo_codigo"]+"</font></div>";
                        html += "</div>";
                        html += "</td>";
                        var totalparcial = 0;
                        var tot = 0;
                        for (var k = 0; k < maximo ; k++){
                            if(inv[i]["c"+(k+1)] != null && inv[i]["c"+(k+1)] !=""){
                                tot = inv[i]["c"+(k+1)];
                                totalparcial+= Number(tot);
                            }else{
                                tot = 0;
                            }
                            html += "	<td class='text-right'>"+tot+"</td>";
                        }
                        html += "             	<td "+margen+" class='text-right'><font size='1'><b>"+ totalparcial+"</b></font></td>";
                        
                        html += "</tr>";
                   
                 
                     

                   //categoria = inv[i]["categoria_nombre"];     
                } // end for (i = 0 ....)
            } //end if (inv != null){
                
                html += "</tbody>";
                
                html += "</table>";            
                $("#tabla_inventario").html(html);   
                             
                
            }, // end succes: function(resultados){
            error:function(resultado){
                //alert('ocurrio un error..!!');
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //muestra el bloque del loader 
            }
            
         }); // close ajax 
}

function validar_busclasificador(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
        if (opcion == 1){   //Si la accecion proviene de la casilla de parametro de busqueda de inventario
            tabla_clasificadorinventario();
        }
    } 
 
}

function formato_numerico(numero){
    nStr = Number(numero).toFixed(2);
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }

    return x1 + x2;
}
