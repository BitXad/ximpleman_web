<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/almacenes.js'); ?>" type="text/javascript"></script>

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
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"/>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Ayuda</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: </font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('ayuda/actualizarvideos'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Actualizar Videos</a>
    </div>
</div>
<div class="row">    
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre, descripción.." onkeypress="buscador(event,1)">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive" id="misvideos">    
                
                <?php foreach($ayudas as $ayuda){
                    
                    if($ayuda["ayuda_tipo"]=="video"){?>

                            <div class="col-md-2">

                              <video width="160" height="120" controls>
                                <source src="<?php echo $ayuda["ayuda_enlace"]; ?>" type="<?php echo $ayuda["ayuda_formato"]; ?>">
                                <source src="movie.ogg" type="video/ogg">
                                    <?php echo $ayuda["ayuda_mensaje"]; ?>
                              </video>

                              <br><b><?php echo $ayuda["ayuda_titulo"]; ?></b>
                              <br><small><?php echo $ayuda["ayuda_subtitulo"]; ?></small>                          
                              <?php echo "<br>".$ayuda["ayuda_texto"]; ?>
                            </div>                
                <?php } 
                    if($ayuda["ayuda_tipo"]=="youtube"){?>

                            <div class="col-md-2">
                                <?php
                                // Extraer el ID del video de YouTube a partir de la URL
                                $youtube_url = $ayuda["ayuda_enlace"];
                                parse_str(parse_url($youtube_url, PHP_URL_QUERY), $url_params);
                                $video_id = isset($url_params['v']) ? $url_params['v'] : '';

                                // URL de incrustación de YouTube
                                $embed_url = 'https://www.youtube.com/embed/' . $video_id;
                                ?>

                                <!-- Reproductor de YouTube -->
                                <iframe width="160" height="120" src="<?php echo $embed_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                <br><b><?php echo $ayuda["ayuda_titulo"]; ?></b>
                                <br><small><?php echo $ayuda["ayuda_subtitulo"]; ?></small>                          
                                <?php echo "<br>".$ayuda["ayuda_texto"]; ?>
                            </div>               
                <?php } ?>
                
                
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>

<script>
    
    function buscador(evento,origen){
        
        let tecla = (document.all)? evento.keyCode : evento.which;
        let base_url = document.getElementById('base_url').value;
        let controlador = base_url+'ayuda/buscador';
        let parametro = '';
        
        
        if(tecla==13){
            
            if (origen==1){
                parametro = document.getElementById("filtrar").value;
            }
            if (origen==2){
                parametro = document.getElementById("selector").value;
            }
            
            $.ajax({url: controlador,
                    type:"POST",
                    data:{parametro:parametro, origen:origen},
                    success:function(respuesta){
               
                        let registros = eval(respuesta);
                        let tam = registros.length;
                        let html = "";
                        
                        if(tam>0){
                            
                            for(let i=0; i<tam; i++){

                                if(registros[i]['ayuda_tipo']=="video"){
                                    
                                    html += "<div class='col-md-2'>";
                                    html += "<video width='160' height='120' controls>";
                                    html += "<source src='"+registros[i]['ayuda_enlace']+"' type='"+registros[i]['ayuda_formato']+"'>";
                                    html += "<source src='movie.ogg' type='video/ogg'>";
                                    html +=  registros[i]['ayuda_mensaje'];
                                    html += "</video>";
                                    
                                    if(registros[i]['ayuda_titulo']!=null) html += "<br><b>"+registros[i]['ayuda_titulo']+"</b>";                                    
                                    if(registros[i]['ayuda_subtitulo']!=null) html += "<br><small>"+registros[i]['ayuda_subtitulo']+"</small>";                                    
                                    if(registros[i]['ayuda_texto']!=null) html += "<br>"+registros[i]['ayuda_texto'];
                                    
                                    html += "</div>";
                                }
                                
                                if(registros[i]['ayuda_tipo']=="youtube"){
                                    
                                    html += "<div class='col-md-2'>";
                                    // Extraer el ID del video de YouTube a partir de la URL 

                                    // Suponiendo que youtube_url es una cadena de URL de YouTube
                                    const youtube_url = registros[i]['ayuda_enlace'];

                                    // Crear un objeto URL para analizar la URL
                                    const url = new URL(youtube_url);

                                    // Obtener los parámetros de consulta
                                    const urlParams = new URLSearchParams(url.search);

                                    // Obtener el ID del video
                                    const video_id = urlParams.get('v') || ''; // Devuelve una cadena vacía si 'v' no está presente

                                    // URL de incrustación de YouTube 
                                    let embed_url = 'https://www.youtube.com/embed/'+video_id; 

                                    //<!-- Reproductor de YouTube --> 
                                    html += "<iframe width='160' height='120' src='"+embed_url+"' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                                    
                                    if(registros[i]['ayuda_titulo']!=null) html += "<br><b>"+registros[i]['ayuda_titulo']+"</b>";                                    
                                    if(registros[i]['ayuda_subtitulo']!=null) html += "<br><small>"+registros[i]['ayuda_subtitulo']+"</small>";                                    
                                    if(registros[i]['ayuda_texto']!=null) html += "<br>"+registros[i]['ayuda_texto'];

                                    html += "</div>";                                    
                                    
                                }
                        
                            }
                                
                            $("#misvideos").html(html);
                            
                        }
   
                    },
                    error:function(respuesta){

                               res = 0;
                    }
                 });     
            
        }
        
    }
    
</script>
