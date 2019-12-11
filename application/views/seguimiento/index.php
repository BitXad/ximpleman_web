<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<!-- Add jQuery library -->
<script type="text/javascript" src="<?php echo base_url('resources/js/jquery-1.10.2.min.js'); ?>"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.mousewheel.pack.js?v=3.1.3'); ?>"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox.pack.js?v=2.1.5'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox-buttons.css?v=1.0.5'); ?>" />
<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-buttons.js?v=1.0.5'); ?>"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery.fancybox-thumbs.css?v=1.0.7'); ?>" />
<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-thumbs.js?v=1.0.7'); ?>"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="<?php echo base_url('resources/js/jquery.fancybox-media.js?v=1.0.6'); ?>"></script>

<style type="text/css">
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
}

.button1 {border-radius: 2px;}
.button2 {border-radius: 4px;}
.button3 {border-radius: 8px;}
.button4 {border-radius: 12px;}
.button5 {border-radius: 50%;}
</style>

<style type="text/css">
        img{
            height: 50px;
            width: 50px
        }
	</style>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitablaproceso.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->


<?php 
        $var_pendiente = "<font size='1'><fa class='fa fa-hourglass'></fa></font>" ;
        $var_procesando = "<font size='1'><fa class='fa fa-cogs'></fa></font>" ;
        $var_terminado = "<font size='1'><fa class='fa fa-check'></fa></font>";
        $color_pendiente =  "#FFB52B";
        $color_procesando =  "#2AA301";
        $color_terminado =  "#731501";
                            
//if(sizeof($servicio)>0){  ?>

<div class="row micontenedorep">
    <table class="table" style="width: 100%; padding: 0;" >
    <tr>
        <td style="width: 25%; padding: 0; line-height:10px; text-align: center" >
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
        </td>
                   
        <td style="width: 50%; padding: 0" > 
            <center>
            
                <br><br>
                <font face="Arial" size="3"><b>ORDEN Nº 00<?php echo $servicio['servicio_id']; ?>  </b></font>
        <br><font face="Arial" size="2"><b>CLIENTE: </b><?php echo $servicio['cliente_nombre']; ?></font>
                
                <!--<br><font size="1" face="arial"><b><?php //echo date("d/m/Y H:i:s"); ?></b></font> <br>-->

            </center>
        </td>
        <td style="width: 25%; padding: 0" >
                <center>
                    </center>
        </td>
    </tr>
</table>       
        
</div>

<div style="padding-left: 15px; padding-right: 15px;">
<center>
    <button class='btn btn-facebook' style="background-color:<?php echo $color_pendiente; ?>"><?php echo $var_pendiente; ?> </button> <b>Pendiente</b>
    <button class='btn btn-facebook' style="background-color:<?php echo $color_procesando; ?>"><?php echo $var_procesando; ?> </button> <b>Procesando</b>
    <button class='btn btn-facebook' style="background-color:<?php echo $color_terminado; ?>"><?php echo $var_terminado; ?> </button> <b>Terminado</b>
</center>


<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body table-responsive table-condensed">
                <table class="table table-condensed "id="mitabla">
                    <tr style="padding: 0;">
                        <th style="padding: 0;">RECEPCION</th>
                        <th style="padding: 0;"></th>
                        <th style="padding: 0;">PROCESO</th>
                        <th style="padding: 0;"></th>
                        <th style="padding: 0;">TERMINADO</th>
                        <th style="padding: 0;"></th>
                        <th style="padding: 0;">PARA<br>ENTREGA</th>
                        <th style="padding: 0;"></th>
                        <th style="padding: 0;">ENTREGADO</th>
                    </tr>
                    
                    <tr style="font-family: Arial">
                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    </tr>

                        <?php  
                            $cont = 0;
                        foreach ($detalle_servicio as $p){ ?>
                            
                            <tr style="font-family: Arial; text-align: center;">
                                <td colspan="8"><font size='2'><b><?php echo $p['detalleserv_descripcion']; ?></b></font></td>                                
                                <!--<td> <a href="<?php echo base_url("imagen_producto/catalogodet/").$p["detalleserv_id"]; ?>" class="btn btn-soundcloud btn-xs" title="Imagenes relacionadas" ><span class="fa fa-image"></span></a></td>-->                                
                            
                            </tr>
                            <tr style="font-family: Arial" align="center">
                        
                                <!---------------------- RECEPCION ------------------------------->
                                <td style="padding: 0; line-height: 10px;" >
                                    <div class="boton">
                                        
                                    <?php 
                                        if($p['estado_id']<5){ //Si el estado es pendiente
                                            $color_estado = "#FFB52B"; //naranaja
                                            $estado = $var_pendiente;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
                                        if($p['estado_id']==5){ //Si el estado es procesando
                                            $color_estado = "#2AA301"; //naranaja
                                            $estado = $var_procesando;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
                                        
                                        if($p['estado_id']>5){ //Si el estado es terminado
                                            $color_estado = "#731501"; //marron
                                            $estado = $var_terminado;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
                                    ?>

                                    <button class="button button5" style="background-color:<?php echo $color_estado; ?>">
                                        <font size="1"><b><?php echo $estado ?></b>
                                                <br><?php echo $fecha; ?>
                                                <br><?php echo $hora; ?>                                        
                                        </font>
                                        
                                    </button> 
                                    </div>
                                </td>                                         
                                <td  style="padding: 0;"><br><br><br><font face="Arial" size="3"><fa class="fa fa-arrow-right"></fa> </font></td>


                                <!---------------------- EN PROCESO ------------------------------->
                                <td style="padding: 0; line-height: 10px;" >
                                    <div class="boton">
                                    <?php 
                                        if($p['estado_id']==5){ //Si el estado es pendiente
                                            $color_estado = "#FFB52B"; //naranaja
                                            $estado = $var_pendiente;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
                                        if($p['estado_id']>5){ //Si el estado es terminado
                                            $color_estado = "#731501"; //naranaja
                                            $estado = $var_terminado;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
                                        if($p['estado_id']==28){ //Si el estado es procesando
                                            $color_estado = "#2AA301"; //verde
                                            $estado = $var_procesando;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
                                        
                                                                                   
                                    ?>

                                    <button class="button button5" style="background-color:<?php echo $color_estado; ?>">
                                        <font size="1"><b><?php echo $estado ?></b>
                                                <br><?php echo $fecha; ?>
                                                <br><?php echo $hora; ?>                                        
                                        </font>
                                        
                                    </button> 
                                        
                                    </div>
                                </td>                                                   
                                <td  style="padding: 0;"><br><br><br><font face="Arial" size="3"><fa class="fa fa-arrow-right"></fa> </font></td>

                                <?php
                                     $color_estado = "#FFB52B"; //naranaja
                                ?>

                
                                <!---------------------- TERMINADO ------------------------------->
                                <td style="padding: 0; line-height: 10px;" >
                                    <div class="boton">
                                    <?php 
                                        
                                        if($p['estado_id']<>6&&$p['estado_id']==28){ //Si el estado es pendiente
                                            $color_estado = "#FFB52B"; //naranaja
                                            $estado = $var_pendiente;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
//                                        if($p['estado_id']==7){ //Si el estado es procesando
//                                            $color_estado = "#2AA301"; //naranaja
//                                            $estado = $var_procesando;
//                                            $dt = new DateTime($p['detalleserv_fechaterminado']);
//                                            $fecha = $dt->format('d/m/Y');
//                                            $hora = $p['detalleserv_horaterminado'];
//                                        }
//                                        
                                        if($p['estado_id']>=6 && $p['estado_id']!=28){ //Si el estado es terminado
                                            $color_estado = "#731501"; //naranaja
                                            $estado = $var_terminado;
                                            $dt = new DateTime($p['detalleserv_fechaterminado']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $p['detalleserv_horaterminado'];
                                        }
//                                        if($p['estado_id']==28){ //Si el estado es terminado
//                                            $color_estado = "#FFB52B"; //naranaja
//                                            $estado = $var_pendiente;
//                                            $dt = new DateTime($p['detalleserv_fechaterminado']);
//                                            $fecha = $dt->format('d/m/Y');
//                                            $hora = $p['detalleserv_horaterminado'];
//                                        }
                                                                                   
                                    ?>

                                    <button class="button button5" style="background-color:<?php echo $color_estado; ?>">
                                        <font size="1"><b><?php echo $estado ?></b>
                                                <br><?php echo $fecha; ?>
                                                <br><?php echo $hora; ?>                                        
                                        </font>
                                        
                                    </button> 
                                    </div>
                                </td>  
                                 <td  style="padding: 0;"><br><br><br><font face="Arial" size="3"><fa class="fa fa-arrow-right"></fa> </font></td>


                                <!---------------------- PARA ENTREGA ------------------------------->
                                
                                <td style="padding: 0; line-height: 10px;" >
                                    <div class="boton">
                                        
                                    <?php 
                                        
                                        if($p['estado_id']<>6){ //Si el estado es pendiente
                                            $color_estado = "#FFB52B"; //naranaja
                                            $estado = $var_pendiente;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
                                        if($p['estado_id']==6){ //Si el estado es procesando
                                            $color_estado = "#2AA301"; //verde
                                            $estado = $var_procesando;
                                            $dt = new DateTime($p['detalleserv_fechaterminado']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $p['detalleserv_horaterminado'];
                                        }
                                        
                                        if($p['estado_id']>6&&$p['estado_id']!=28){ //Si el estado es terminado
                                            $color_estado = "#731501"; //marron
                                            $estado = $var_terminado;
                                            $dt = new DateTime($p['detalleserv_fechaterminado']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $p['detalleserv_horaterminado'];
                                        }
                                                                                   
                                    ?>

                                    <button class="button button5" style="background-color:<?php echo $color_estado; ?>">
                                        <font size="1"><b><?php echo $estado ?></b>
                                                <br><?php echo $fecha; ?>
                                                <br><?php echo $hora; ?>                                        
                                        </font>
                                        
                                    </button> 
                                    </div>
                                </td>
                                 <td  style="padding: 0;"><br><br><br><font face="Arial" size="3"><fa class="fa fa-arrow-right"></fa> </font></td>



                                  
                                    <!---------------------- ENTREGADO ------------------------------->
                                                                                      
                               
                              <td style="padding: 0; line-height: 10px;" >
                                    <div class="boton">
                                        
                                    <?php 
                                        
                                        if($p['estado_id']<>7){ //Si el estado es pendiente
                                            $color_estado = "#FFB52B"; //naranaja
                                            $estado = $var_pendiente;
                                            $dt = new DateTime($servicio['servicio_fecharecepcion']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $servicio['servicio_horarecepcion'];
                                        }
                                        if($p['estado_id']==7){ //Si el estado es procesando
                                            $color_estado = "#2AA301"; //verde
                                            $estado = $var_pendiente;
                                            $dt = new DateTime($p['detalleserv_fechaentrega']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $p['detalleserv_horaentrega'];
                                        }
                                        
                                        if($p['estado_id']>6&&$p['estado_id']!=28){ //Si el estado es terminado
                                            $color_estado = "#731501"; //marron
                                            $estado = $var_terminado;
                                            $dt = new DateTime($p['detalleserv_fechaentrega']);
                                            $fecha = $dt->format('d/m/Y');
                                            $hora = $p['detalleserv_horaentrega'];
                                        }
                                                                                   
                                    ?>

                                    <button class="button button5" style="background-color:<?php echo $color_estado; ?>">
                                        <font size="1"><b><?php echo $estado ?></b>
                                                <br><?php echo $fecha; ?>
                                                <br><?php echo $hora; ?>                                        
                                        </font>
                                        
                                    </button> 
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td colspan="5"><span class="text-bold" style="font-size: 10px">Tec. Responsable: </span><?php echo $p['respusuario_nombre'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="9">
                            
                            <!---------------------- SLIDER  ------------------------>


                            <script type="text/javascript">
                                        $(document).ready(function() {
                                                /*
                                                 *  Simple image gallery. Uses default settings
                                                 */

                                                $('.fancybox').fancybox();

                                                $("#fancybox-manual-c").click(function() {
                                                        $.fancybox.open([
                                                                {
                                                                        href : '1_b.jpg',
                                                                        title : 'Primer Imagen'
                                                                }, {
                                                                        href : '2_b.jpg',
                                                                        title : '2nd title'
                                                                }, {
                                                                        href : '3_b.jpg'
                                                                }
                                                        ], {
                                                                helpers : {
                                                                        thumbs : {
                                                                                width: 75,
                                                                                height: 50
                                                                        }
                                                                }
                                                        });
                                                });


                                        });
                                </script>
                            <style type="text/css">
                                img{
                                    height: 50px;
                                    width: 50px
                                }
                            </style>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="box">
              
                                
                                
                                <div class="box-body table-responsive">
                                    <center>
                                        
                                    <p>
                                        <?php
                                            $colum = 5;
                                            $cont = 1;

                                            foreach($imagenes as $imagen)
                                            {
                                                
                                                if ($p['detalleserv_id']==$imagen['detalleserv_id']){
                                                    
                                                    if(($cont % $colum) == 0){
                                                      // // echo "<div id ='otrafila'>";
                                                    }
                                                    $mimagen = "thumb_".$imagen['imagenprod_archivo'];

                                                    /////echo "<div id='colum5'>";
                                                    echo "<a class='fancybox' href='".site_url('/resources/images/servicios/'.$imagen['imagenprod_archivo'])."' data-fancybox-group='gallery' title='".$imagen['imagenprod_titulo']."'>";
                                                    echo " <img src='".site_url('/resources/images/servicios/'.$mimagen)."' alt='' /></a>";
                                                    /////echo "</div>";
                                                    if(($cont % $colum) == 0){
                                                        echo "<br>";
                                                    }
                                           
                                                }
                                                $cont++; 
                                             
                                            } 
                                            ?>
                                    </p>
                                    </center>
                                </div>
                                <div class="pull-right">

                                </div>
                            </div>
                        </div>
                        </div>
                            
                                
                                
                            <!---------------------- SLIDER  ------------------------>
                            </td>

                        </tr>
                        
                        <?php } ?>   
                        
                    <tr style="font-family: Arial">
                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr style="font-family: Arial">
                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    
                
                    
                </table>
                                
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-5">
    </div>
    <div class="col-md-2">        
        <a href="<?php echo base_url(''); ?>" class="btn btn-success btn-block"><fa class="fa fa-close"></fa> SALIR</a>            
        
    </div>
    <div class="col-md-5">
    </div>
    
</div>
<?php /*} else{ ?>
<center>    
    <h2><b>LA ORDEN DE TRABAJO NO EXISTE..!!</b></h2>
    <h3>LE RECOMENDAMOS CONSULTAR CON LA EMPRESA</h3>    
    <a href='<?php echo base_url(); ?>' class='btn btn-warning'><fa class='fa fa-close'></fa> Salir</a>
</center>
    
<?php }*/ ?>
</div>
