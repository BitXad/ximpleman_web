<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
         function imprimir()
        {
           $("#cabeceraprint").css("display", "");
             window.print(); 
        }
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="row micontenedorep" style="display: none" id="cabeceraprint">
    <table class="table" style="width: 100%; padding: 0;" >
        <tr>
            <td style="width: 25%; padding: 0; line-height:10px;" >
                <center>
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php //echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php //echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php //echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php //echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                </center>
            </td>
            <td style="width: 35%; padding: 0" > 
                <center>
                    <br><br>
                    <font size="3" face="arial"><b>INGRESOS</b></font> <br>
                    <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>
                </center>
            </td>
            <td style="width: 20%; padding: 0" >
                <center></center>
            </td>
        </tr>
    </table>
</div>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
 <div class="col-md-8 no-print">
    <div class="box-header">
        <font size='4' face='Arial'><b>Operaciones</b></font>
        <br><font size='2' face='Arial' id="pillados"></font>
    </div>

 </div>
<!--<div class="col-md-4 no-print">
    <div class="box-tools">
        <center>    
            <a href="<?php echo site_url('ingreso/add'); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-money"></span></font><br><small>Registrar Ingreso</small></a>
            <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="fechadeingreso(null)" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
            <a href="#" onclick="imprimir()" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
        </center>            
    </div>
</div>-->
<div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>
<div class="panel panel-primary col-md-12" id='buscador_oculto' style='display:none;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" value="<?php echo date("Y-m-d")?>" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" value="<?php echo date("Y-m-d")?>" required="true">
        </div>
        <div class="col-md-3">
            <?php if($rol[57-1]['rolusuario_asignado'] == 1){ ?>
            <button class="btn btn-sm btn-primary btn-sm btn-block"  onclick="buscar_por_fechas()">
                <h4>
                <span class="fa fa-search"></span>   Buscar Ingresos  
                </h4>
            </button>
            <?php } ?>
            <br>
        </div>
    </center>
    <br>    
</div>
<div class="col-md-12">         
    <div class="box">
        <div class="box-body table-responsive">
            <table class="table table-striped table-condensed" id="mitabla">     
                <tr>
                   <th>#</th>
                   <th style="width: 160px;">OPERACION</th>
                    <th>DESCRIPCION</th>
                </tr>
                <?php $i = 1; ?>
                
                <tr><td><?php echo $i++;  ?></td>
                    <td><button class="btn btn-xs btn-facebook" style="width: 150px; height: 50px; font-size: 14px;"  data-toggle="modal" data-target="#modallogs" onclick="lista_logs()"><fa class="fa fa-list-ul"></fa><br>Eliminar logs</button> </td> 
                    <td><br>Elimina archivos de aplication/log</td> 
                </tr>
                
                <tr><td><?php echo $i++;  ?></td>
                    <td><button class="btn btn-xs btn-danger" style="width: 150px; height: 50px; font-size: 14px;" onclick="eliminar_cisession()"><fa class="fa fa-users"></fa><br>Eliminar ci_session</button> </td> 
                    <td><br>Elimina datos de la tabla de sesiones</td> 
                </tr>
                
                <tr><td><?php echo $i++;  ?></td>
                    <!--<td><a href="" class="btn btn-xs btn-primary" style="width: 150px; height: 50px; font-size: 14px;" onclick="eliminar_xml()"><fa class="fa fa-file-zip-o"></fa><br>Eliminar Facturas</a> </td>--> 
                    <td><button type="button" class="btn btn-primary" style="width: 150px; height: 50px; font-size: 14px;" data-toggle="modal" data-target="#modalbackups" onclick="lista_backups()"><fa class="fa fa-file-zip-o"></fa><br>Eliminar Facturas</button></td>                     
                    <td><br>Elimina archivos de facturas en resources/xml (.zip/.tar/.tar.gz/.xml)</td> 
                </tr>
                
                <tr><td><?php echo $i++;  ?></td>
                    <td><a href="" class="btn btn-xs btn-success" style="width: 150px; height: 50px; font-size: 14px;" onclick="ultimo_costo()"><fa class="fa fa-calculator"></fa><br>Actualizar costos</a> </td> 
                    <td><br>Cambiar el costo de los productos por el ultimo costo registrado.</td> 
                </tr>
                
                <tr><td><?php echo $i++;  ?></td>
                    <td><button class="btn btn-xs btn-info" style="width: 150px; height: 50px; font-size: 14px;" data-toggle="modal" data-target="#modallicencia"> <fa class="fa fa-calendar"></fa><br>Licencias</button> </td> 
                    <td><br>Actualizar la fecha de licencia del sistema <br><?php echo "<color style='color: red'> VIGENCIA LICENCIA: ".date("d/m/Y", strtotime($licencia[0]["licencia_fechalimite"])) . " <b>" . $licencia[0]["vigencia"]."</b></color>"; ?></td> 
                </tr>
                
                <tr><td><?php echo $i++;  ?></td>
                    <td><button type="button" class="btn btn-warning" style="width: 150px; height: 50px; font-size: 14px;" data-toggle="modal" data-target="#modaleliminar" onclick="lista_tablas()"><fa class="fa fa-list-alt"></fa><br>Eliminar Tablas</button> </td> 
                    <td><br>Elimina tablas seleccionadas de la base de datos</td> 
                </tr>
                <!--<tbody class="buscar" id="fechadeingreso">-->
            </table>
        </div>
        <div class="pull-right">
            <?php echo $this->pagination->create_links(); ?>                    
        </div>                
    </div>
</div>


<script type="text/javascript"><!-- comment -->
function eliminar_cisession(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/eliminar_cisession";
    var txt;
    var r = confirm("Se eliminaran los datos de la tabla ci_session. Desea continuar?");
    if (r == true) {
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){         
                alert("Operacion completada..!. Tendrá que volver a ingresar al sistema...!");
                location.href = base_url+"login/";
                
            },
            error: function(respuesta){         
            }        
        });

    }
    
    
}

function eliminar_logs(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/eliminar_logs";
    var directorio_logs = document.getElementById('direccion_base').value;
    
    var txt;
    var r = confirm("Se eliminaran los datos del directorio application/logs. Desea continuar?");
    if (r == true) {
    
        $.ajax({url: controlador,
            type:"POST",
            data:{directorio_logs:directorio_logs},
            success:function(respuesta){         
                alert("Operacion completada con éxito..!. ");
                //location.href = base_url+"login/";
                lista_logs();
            },
            error: function(respuesta){         
            }        
        });

    }
    
    
}

function eliminar_xml(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/eliminar_xml";
    var txt;
    var r = confirm("Se eliminaran todas las facturas del carpeta XML (.pdf/.tar/.tar.gz/.zip). Desea continuar?");
    if (r == true) {
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){         
                alert("Operacion completada con éxito..!. ");
                //location.href = base_url+"login/";
                
            },
            error: function(respuesta){         
            }        
        });

    }
    
    
}

function ultimo_costo(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/ultimo_costo";
    var txt;
    var r = confirm("Esta operacion afectara de forma permanente a la base de datos. Desea continuar?");
    if (r == true) {
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){         
                alert("Operacion completada con éxito..!. ");
                //location.href = base_url+"login/";
                
            },
            error: function(respuesta){         
            }        
        });
    }    
}

function actualizar_licencia(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/actualizar_licencia";
    var licencia_fechalimite = document.getElementById("licencia_fechalimite").value;
    
    //alert(licencia_fechalimite);
    var txt;
    var r = confirm("Esta operacion afectara de forma permanente a la base de datos. Desea continuar?");
    
    if (r == true) {
    
        $.ajax({url: controlador,
            type:"POST",
            data:{licencia_fechalimite:licencia_fechalimite},
            success:function(respuesta){
                
                alert("Licencia actualizada con éxito..!. ");
                location.reload();
                
            },
            error: function(respuesta){         
            }        
        });
    }    
}

function eliminar_datos(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/eliminar_datos";
    
    var txt;
    var r = confirm("Eliminar los datos de las tablas seleccionas. Esta operacion es Irreversible, desea continuar?");
    
    if (r == true) {
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                
                alert("Las tablas de datos fueron elliminadas con éxito...!");
                location.reload();
                 
                
            },
            error: function(respuesta){         
            }        
        });
    }    
}

function seleccionar_tabla(tabla_id){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/seleccionar_tabla";
    
    
    //alert(licencia_fechalimite);
    var txt;
    //var r = confirm("Esta a punto de cambiar el estado de la tabla. Desea continuar?");
    
        $.ajax({url: controlador,
            type:"POST",
            data:{tabla_id:tabla_id},
            success:function(respuesta){
                
                //alert("Licencia actualizada con éxito..!. ");
                lista_tablas();
                
            },
            error: function(respuesta){         
            }        
        });
     
}

function cargar_directorios(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/cargar_directorios";
    
    // Obtener el select
    const select = document.getElementById('nombre_sistema');

    // Limpiar opciones actuales
    select.innerHTML = '';
    
    //alert(licencia_fechalimite);
    var txt;
    //var r = confirm("Esta a punto de cambiar el estado de la tabla. Desea continuar?");
    
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){

                try {
                    let datos = JSON.parse(respuesta);
                        
                       for(let i=0; i<datos.length; i++){
                            const opcion = document.createElement("option");
                            opcion.value = datos[i];         // puedes modificar esto si necesitas otro valor
                            opcion.textContent = datos[i];
                            select.appendChild(opcion);
                       }

                } catch (error) {
                    console.error("Error al procesar la respuesta:", error);
                }
                
            },
            error: function(respuesta){         
            }        
        });     
}

//Carga los logs del sistema
function cargar_contenido(){

    var base_url = document.getElementById('base_url').value;
    var directorio_principal = document.getElementById('directorio_principal').value;
    
    var nombre_sistema = document.getElementById('nombre_sistema').value;

    document.getElementById('direccion_base').value = directorio_principal+"/"+nombre_sistema+"/application/logs/";
    
    //Listar el contenido
    lista_logs();
    
        
}

function lista_tablas(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/lista_tablas";   
    let html = "";

        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                
                let datos = JSON.parse(respuesta);
                let estado = "";
                
                if (datos.length>0){
                    
                    //alert(datos.length);
                    html = "";
                    for(var i = 0; i<datos.length; i=i+2 ){
                        
                        html += "<tr>";

                            if (datos[i]!=null){
                                
                                if(datos[i]["tabla_seleccion"]==0) estilo = "style='background-color:lightgray;'";
                                else estilo = " ";
                                    
                                html += "<td "+estilo+">"+(i+1)+"</td>";
                                html += "<td "+estilo+">"+datos[i]["tabla_nombre"]+"</td>";
                                
                                if(datos[i]["tabla_seleccion"]==1) estado = 'checked';                                
                                else estado = '';
                                    
                                html += "<td "+estilo+"><center><input type='checkbox' id='myCheck"+datos[i]["tabla_id"]+"' onclick='seleccionar_tabla("+datos[i]["tabla_id"]+")' "+estado+"></center></td>";
                                
                            }


                            if (datos[i+1]!=null){
                                
                                if(datos[i+1]["tabla_seleccion"]==0) estilo = "style='background-color:lightgray;'";
                                else estilo = " ";
                                    
                                
                                if(datos[i+1]["tabla_seleccion"]==1) estado = 'checked';                                
                                else estado = '';
                                
                                
                                html += "<td "+estilo+">"+(i+2)+"</td>";
                                html += "<td "+estilo+">"+datos[i+1]["tabla_nombre"]+"</td>";
                                html += "<td "+estilo+"><center><input type='checkbox' id='myCheck"+datos[i+1]["tabla_id"]+"' onclick='seleccionar_tabla("+datos[i+1]["tabla_id"]+")' "+estado+"></center></td>";
                            }
                        html += "<tr>";
                        
                    }
                    
                    
                }
                $("#listatablas").html(html);

                
            },
            error: function(respuesta){         
            }        
        });
       
}

function lista_logs() {

    var base_url = document.getElementById('base_url').value;
    var directorio_logs = document.getElementById('direccion_base').value;
    var controlador = base_url + "operaciones/lista_logs";   
    let html = "";

    $.ajax({
        url: controlador,
        type: "POST",
        data: {directorio_logs:directorio_logs},
        success: function(respuesta) {
            try {
                let datos = JSON.parse(respuesta);
                
                // Verificamos si datos es un objeto con una clave principal
                if (typeof datos === "object" && !Array.isArray(datos)) {
                    let keys = Object.keys(datos);
                    if (keys.length > 0) {
                        datos = datos[keys[0]]; // Extraemos el array dentro del objeto
                    }
                }

                if (Array.isArray(datos) && datos.length > 0) {
                    html = "";
                    for (var i = 0; i < datos.length; i++) {
                        html += "<tr>";
                        html += "<td>" + (i + 1) + "</td>";
                        html += "<td>" + datos[i] + "</td>";
                        html += "</tr>";
                    }
                } else {
                    html = "<tr><td colspan='2'>No hay logs disponibles</td></tr>";
                }

                $("#listalogs").html(html);
            } catch (error) {
                console.error("Error al procesar la respuesta:", error);
            }
        },
        error: function() {
            console.error("Error en la petición AJAX");
        }
    });
}

function lista_backups() {

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + "operaciones/lista_backups";   
    let html = "";

    $.ajax({
        url: controlador,
        type: "POST",
        data: {},
        success: function(respuesta) {
            try {
                let datos = JSON.parse(respuesta);
                
                // Verificamos si datos es un objeto con una clave principal
                if (typeof datos === "object" && !Array.isArray(datos)) {
                    let keys = Object.keys(datos);
                    if (keys.length > 0) {
                        datos = datos[keys[0]]; // Extraemos el array dentro del objeto
                    }
                }
                
                if (Array.isArray(datos) && datos.length > 0) {
                    html = "";
                    for (var i = 0; i < datos.length; i++) {
                        
                        html += "<tr>";
                        html += "<td>" + (i + 1) + "</td>";
                        html += "<td>" + datos[i] + "</td>";
                        html += "<td><a href='"+datos[i]+"' class='btn btn-info btn-xs' target='_blank'><fa class='fa fa-download'></fa> Descargar</a> </td>";
                        html += "<td><button onclick='eliminar_archivo("+JSON.stringify(datos[i])+")' class='btn btn-danger btn-xs' target='_blank'><fa class='fa fa-trash'></fa> Eliminar</button> </td>";
                        html += "</tr>";
                    }
                } else {
                    html = "<tr><td colspan='2'>No hay backups disponibles</td></tr>";
                }

                $("#listabackups").html(html);
                
            } catch (error) {
                console.error("Error al procesar la respuesta:", error);
            }
        },
        error: function() {
            console.error("Error en la petición AJAX");
        }
    });
}

function generar_backups() {


    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/comprimir";
    
    
    //alert(licencia_fechalimite);
    var txt;
    var r = confirm("Esta a punto de generar una copia de respaldo del directori de facturas. Desea continuar?");
    
    if(r==true){
        
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                
                alert("Se generó la copia de respaldo con éxito...!");
                
            },
            error: function(respuesta){         
            }        
        });
     
    }
}

function eliminar_archivo(archivo) {


    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"operaciones/eliminar_archivo";
    
    
    //alert(licencia_fechalimite);
    var txt;
    var r = confirm("Esta a punto de un archivo que contiene copias de resplado de facturas. ¿Desea continuar?");
    
    if(r==true){
        
        $.ajax({url: controlador,
            type:"POST",
            data:{archivo:archivo},
            success:function(respuesta){
                respuesta = JSON.parse(respuesta);
                if(respuesta){
                    alert("Archivo eliminado correctamente...!");
                }else{                    
                    alert("Error al eliminar el archivo...!");
                }
                    
                lista_backups();
                
            },
            error: function(respuesta){         
                    alert("Error al eliminar el archivo...!");
            }        
        });
     
    }
}

</script>
    


<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Button trigger modal -->
<div hidden>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modallicencia">
      Actualizar licencia
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modallicencia" tabindex="-1" role="dialog" aria-labelledby="modallicencia" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">ACTUALIZAR LICENCIA</h5>
        
      </div>
       
      <div class="modal-body">
          <div class="row">

                <div class="col-md-4">
                    <label for="licencia_fechaactivacion" class="control-label">Fecha Activación</label>
                    <div class="form-group">
                        <input type="date" readonly="readonly" name="licencia_fechaactivacion" value="<?php echo $licencia[0]["licencia_fechaactivacion"]; ?>" class="form-control" id="licencia_fechaactivacion" required />
                    </div>
                </div>
              
                <div class="col-md-4">
                    <label for="licencia_fechalimite" class="control-label">Fecha Vigencia</label>
                    <div class="form-group">
                        <input type="date"  name="licencia_fechalimite" value="<?php echo $licencia[0]["licencia_fechalimite"]; ?>" class="form-control" id="licencia_fechalimite" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"  required />
                    </div>
                </div>  
              
                <div class="col-md-4">
                    <label for="licencia_llave" class="control-label">Llave</label>
                    <div class="form-group">
                        <input type="text" readonly="readonly" name="licencia_llave" value="<?php echo $licencia[0]["licencia_llave"]; ?>" class="form-control" id="licencia_llave" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"  required />
                    </div>
                </div>  
              

          </div>
      </div>
      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
        <button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="actualizar_licencia()"><fa class="fa fa-floppy-o" ></fa> Actualizar Licencia</button>
      </div>
    </div>
  </div>
</div>



<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Button trigger modal -->
<div hidden>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaleliminar" onclick="lista_tablas()">
      Eliminar tablas
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="modallicencia" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">ELIMINAR TABLAS</h5>
        
      </div>
       
      <div class="modal-body">
          <div class="row">
                <div class="col-md-12">
                    <b>SELECCIONAR LAS TABLAS QUE SERAN VACIADAS</b>
                    <table class="table-condensed table-responsive"  id="mitabla">
                        <tr>
                            <th>#</th>
                            <th>TABLA</th>
                            <th></th>                            
                            <th>#</th>
                            <th>TABLA</th>
                            <th></th>                            
                        </tr>
                        <tbody id="listatablas">

                        </tbody>
                    </table>
                    
                </div>
              

          </div>
      </div>
      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"  onclick="eliminar_datos()"><fa class="fa fa-trash-o" ></fa> Eliminar Datos</button>
      </div>
    </div>
  </div>
</div>



<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Button trigger modal -->
<div hidden>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modallogs" onclick="lista_logs()">
      Eliminar Logs
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modallogs" tabindex="-1" role="dialog" aria-labelledby="modallogs" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">ELIMINAR LOGS DEL SISTEMA</h5>
        
      </div>
       
      <div class="modal-body">
          
          <div class="row">

                <div class="col-md-6">
                    <label for="nombre_sistema" class="control-label">Nombre Sistema: <button class="btn btn-success btn-xs" onclick="cargar_directorios()"><fa class="fa fa-folder"></fa>  Cargar Directorios</button></label>
                        <div class="form-group">
                          
                            
                            <select name="nombre_sistema" class="form-control" id="nombre_sistema" onchange="cargar_contenido();">
                                
                                <option value="0">- NO HAY SISTEMAS DETECTADOS -</option>
                                
                            </select>
                            
                        </div>
                           
                </div>
              
                <div class="col-md-6">
                        <label for="direccion_base" class="control-label">Base URL:</label>
                        <div class="form-group">
                            <?php 
                            $ruta_logs = APPPATH . 'logs/'; // Ruta de la carpeta logs
                            $directorio_principal = dirname(VIEWPATH, 3); // Ruta de la carpeta logs
                            ?>
                                <input type="text" name="direccion_base" value="<?php echo $ruta_logs; ?>" class="form-control" id="direccion_base" />
                                <input type="hidden" name="directorio_principal" value="<?php echo $directorio_principal; ?>" class="form-control" id="directorio_principal" />
                        </div>
                </div>
              
                <div class="col-md-12">
                    <b>ARCHIVOS QUE SERAN ELIMINADOS</b>
                    <table class="table-condensed table-responsive"  id="mitabla">
                        <tr>
                            <th>#</th>
                            <th>Archivo</th>
                        </tr>
                        <tbody id="listalogs">

                        </tbody>
                    </table>                    
                </div>

          </div>
    </div>

      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="eliminar_logs()"><fa class="fa fa-trash-o" ></fa> Eliminar Datos</button>
      </div>
        
    </div>
    </div>
</div>

<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- ************************************************************************************* -->
<!-- Button trigger modal -->
<div hidden>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalbackups" onclick="lista_backups()">
      Mostrar Backups
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalbackups" tabindex="-1" role="dialog" aria-labelledby="modallogs" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">LISTA BACKUPS DE FACTURAS</h5>
      </div>
       
      <div class="modal-body">
          <div class="row">
                <div class="col-md-12">
                    <b>COPIAS DE SEGURIDAD</b>
                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalbackups" onclick="generar_backups()"><fa class="fa fa-file-zip-o"></fa> Generar Backup</button>
                    
                    <table class="table-condensed table-responsive"  id="mitabla">
                        <tr>
                            <th>#</th>
                            <th>Archivo</th>
                            <th></th>
                        </tr>
                        <tbody id="listabackups">

                        </tbody>
                    </table>
                    
                </div>             

          </div>
      </div>
      <div class="modal-footer">
          <br>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
        <button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="eliminar_xml()"><fa class="fa fa-trash-o" ></fa> Eliminar Facturas XML</button>
      </div>
    </div>
  </div>
</div>
