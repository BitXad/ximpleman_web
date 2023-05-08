function paramodalarticulo(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
        modalarticulo();    
    }
}

function modalarticulo(){
    $('#modalbuscararticulo').modal('show');
    $('#modalbuscararticulo').on('shown.bs.modal', function (e) {
        $('#elarticulo').focus();
    });
}

function buscar_elarticulo(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
        tabla_rearticulo();    
    }
}

function tabla_rearticulo()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'programa/buscar_articulo';
    var el_articulo = document.getElementById('elarticulo').value
    
    $.ajax({url: controlador,
            type:"POST",
            data:{el_articulo:el_articulo},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){   
                    /*var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;*/
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>N</th>";
                    //html += "<th>ID</th>";
                    html += "<th>Art&iacute;culo</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<input id='articulo_id'  name='articulo_id' type='hidden' class='form-control' value='"+registros[i]["articulo_id"]+"'>";
                        html += "<div class='col-md-12'>";
                        html += "<b>"+registros[i]["articulo_nombre"]+"</b>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<button type='button' onclick='repo_articulo("+registros[i]["articulo_id"]+", "+JSON.stringify(registros[i]["articulo_nombre"])+")' class='btn btn-primary btn-xs'><i class='fa fa-search'></i></button>";
                        //html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                        html += "</tbody>"
                   $("#tablarearticulo").html(html);
                    //document.getElementById('tablas').style.display = 'block';
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablarearticulo").html(html);
        }
    });
}
/* funcion cuando selecciona un producto */
function repo_articulo(articulo_id, articulo_nombre){
    $("#articulo_id").val(articulo_id);
    $("#articulo_nombre").val(articulo_nombre);
    /*var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/nomproducto/"+producto;
    $.ajax({url: controlador,
            type:"POST",
            data:{},
           success:function(report){  
            var registros =  JSON.parse(report);
            html = "";
            html += "<font size='2'>Producto: <b>"+registros["producto_nombre"]+"</b></font>";  
            $("#labusqueda").html(html);
            /*$("#cliente").val('');
            $("#proveedor").val('');*/
     /*       document.getElementById('tablas').style.display = 'none';
            reportesproducto();
	}
    });*/
    $('#modalbuscararticulo').modal('hide');
}
/* cerrar modal */
function cerrarmodal(){
    $("#elarticulo").val('');
    $('#modalbuscararticulo').modal('hide');
    $('#modalbuscararticulo').on('hidden.bs.modal', function () {
        $('#tablarearticulo').html('');
    });
}

//Tabla de resultados del programa  y articulo seleccionado
function tablares_progart(){
    
    var base_url       = document.getElementById('base_url').value;
    var programa_id    = document.getElementById('programa_id').value;
    var articulo_id    = document.getElementById('articulo_id').value;
    //var gestion_inicio = document.getElementById('gestion_inicio').value;
    var gestion_id     = document.getElementById('gestion_id').value;
    var controlador    = base_url+'programa/buscarprog_articulo';
    var decimales = document.getElementById('decimales').value;    
    
    
    if(programa_id == "" || programa_id <=0){
        alert("debe elegir un Programa!.");
    }else if(articulo_id == "" || articulo_id <=0){
        alert("debe elegir un Artículo!.");
    }else{
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id, articulo_id:articulo_id,
                 gestion_id:gestion_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta); 
               if (registros == "no"){
                   alert('No existe información!. para este programa y este artículo');
               }else{
                    var cant_total = 0;
                    var n = registros.length;
                    var estilo =  "style='font-size:12px'";
                    var estiloa =  "style='font-size:12px; background-color: #ff0'";
                    var estilon =  "style='font-size:12px; background-color: #ff851b'";
                    html = "";
                    html += "<table style='width: 19.59cm' class='table table-striped' id='mitabla'>";
                    html += "<tr>";
                    html += "<th "+estilo+">#</th>";
                    html += "<th "+estilo+">DETALLE</th>";
                    html += "<th "+estilo+">UNIDAD</th>";
                    html += "<th "+estilo+">CODIGO</th>";
                    html += "<th "+estilo+">CANT.</th>";
                    html += "<th "+estilo+">PREC. UNIT.<br>Bs.</th>";
                    html += "<th "+estilo+">PREC. TOTAL<br>Bs.</th>";
                    html += "<th "+estilo+">SALIDA</th>";
                    html += "<th "+estilo+">SALDO</th>";
                    html += "<th class='no-print' "+estilo+"></th>";
                    html += "</tr>";
                    var num = 0;
                    
                    html += "<tbody class='buscar' id='tablaresultados'>";
                    
                    for(var i = 0; i < n ; i++){
                        //if(registros[i]["saldos"]>0){
                        html += "<tr>";
                        cant_total = Number(cant_total)+Number(Number(registros[i]["detalleing_saldo"]));
                        html += "<td "+estilo+">"+(num+1)+"</td>";
                        html += "<td "+estilo+">"+registros[i]["articulo_nombre"]+"</td>";
                        html += "<td class='text-center' "+estilo+">"+registros[i]["articulo_unidad"]+"</td>";
                        html += "<td class='text-center' "+estilo+">"+registros[i]["articulo_codigo"]+"</td>";
                        html += "<td class='text-right' "+estiloa+">"+registros[i]["detalleing_cantidad"]+"</td>";
                        html += "<td class='text-right' "+estilo+">"+numberFormat(Number(registros[i]["articulo_precio"]).toFixed(decimales))+"</td>";
                        html += "<td class='text-right' "+estilo+">"+numberFormat(Number(registros[i]["detalleing_total"]).toFixed(decimales))+"</td>";
                        html += "<td class='text-right' "+estiloa+">"+registros[i]["detalleing_salida"]+"</td>";
                        html += "<td class='text-right' "+estilon+">"+registros[i]["detalleing_saldo"]+"</td>";

                        html += "<td class='no-print'>";                    
                        /*html += "<button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#modalingresos' title='Ver ingresos' onclick='buscar_ingresos("+registros[i]["programa_id"]+","+registros[i]["articulo_id"]+")'>";
                        html += "<fa class='fa fa-cubes'></fa> </button>";
                        */
                        html += "</td>";

                        html += "</tr>";
                        num++;
                        //}
                        
                    }
                    
                    convertiraliteral(Number(cant_total).toFixed(decimales));
                    obtenercodigo(programa_id);
                    html += "</tbody>";
                    html += "</table>";
                    var titulo_prog = $("#programa_id option:selected").text();
                    
                    $("#elprograma").html(titulo_prog);
                    
                    //$("#lafecha").html(moment(fecha_hasta).format('DD/MM/YYYY'));
                    //$("#elmantenimiento").html($('input:radio[name=mantenimiento]:checked').val());
                    
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
                    /*
                    html1 += "<input type='hidden' id='total_inventario' value='"+cant_total.toFixed(decimales)+"' readonly/>";
                    
                    html1 += "<button type='button' class='btn btn-primary btn-xs no-print' data-toggle='modal' data-target='#modalinventario'>";
                    html1 += "<fa class='fa fa-cubes'></fa>";
                    html1 += "  Generar inventario inicial";
                    html1 += "</button>";*/
                    
                    $("#tablaresultados1").html(html1);
                   
            }
                
        },
        error:function(respuesta){
          
          alert('No existe Inventario para este programa hasta esta fecha.');
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });
    }
}
/* obtiene codigo de un programa */
function obtenercodigo(programa_id){
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

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}