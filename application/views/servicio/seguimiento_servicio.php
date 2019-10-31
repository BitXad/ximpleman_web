<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php echo base_url('resources/js/proceso_orden.js'); ?>" type="text/javascript"></script>-->
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
</script>   


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

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitablaproceso.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->


<?php if(sizeof($servicio)>0){  ?>

<div class="box-header">
    <!--<center>-->
        
        <font face="Arial" size="3"><b>ORDEN Nº 00<?php echo $servicio['servicio_id']; ?>  </b></font>
        <br><font face="Arial" size="2"><b>CLIENTE:</b><?php echo $servicio['cliente_nombre']; ?></font>
            	<div class="box-tools">
                    
                </div>
    <!--</center>-->
</div>


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
                            $var_pendiente = "<font size='3'><fa class='fa fa-hourglass'></fa></font>" ;
                            $var_procesando = "<font size='3'><fa class='fa fa-cogs'></fa></font>" ;
                            $var_terminado = "<font size='3'><fa class='fa fa-check'></fa></font>";
                            

                        foreach ($detalle_servicio as $p){ ?>
                            
                            <tr style="font-family: Arial; text-align: center;">
                                <td colspan="9"><font size='2'><b><?php echo $p['detalleserv_descripcion']; ?></b></font></td>                                
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
                                            $color_estado = "#731501"; //naranaja
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
                            <td><?php  echo substr($p['detalleserv_falla'],0,15)."...";  //if (sizeof($p['detalleserv_falla'])>=15){ echo  substr($p['detalleserv_falla'],15)."...";}else{ echo $p['detalleserv_falla'];} ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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



<!--<div class="row">
    <div class="col-md-2">
        <div class="box">
            
            <div class="box-body table-responsive table-condensed">
                <table class="table table-condensed "id="mitabla">
                    <tr style="padding: 0;">
                        <th> </th>
                        <th colspan="2" style="padding: 0;">ESTADOS</th>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    

                        <?php  
                            $cont = 0;
                        foreach ($estados as $e){?>
                        
                        <tr style="font-family: Arial" align="center">
                            <td  style="padding: 0;">
                                <button class="btn btn-success" style="background-color: <?php echo "#".$e['estado_color'];?>; border: #0016b0"></button>
                            </td>
                       
                            <td  style="padding: 0;" align="left">
                                <?php echo $e['estado_descripcion'] ?>
                            </td>
                       
                        </tr>
                    
                        <?php } ?>
                    
                </table>
                                
            </div>
        </div>
    </div>
    
</div>-->

<div class="row">
    <div class="col-md-5">
    </div>
    <div class="col-md-2">        
        <a href="<?php echo base_url(''); ?>" class="btn btn-success btn-block"><fa class="fa fa-close"></fa> SALIR</a>            
        
    </div>
    <div class="col-md-5">
    </div>
    
</div>
<?php } else{ ?>
<center>    
    <h2><b>LA ORDEN DE TRABAJO NO EXISTE..!!</b></h2>
    <h3>LE RECOMENDAMOS CONSULTAR CON LA EMPRESA</h3>    
    <a href='<?php echo base_url(); ?>' class='btn btn-warning'><fa class='fa fa-close'></fa> Salir</a>
</center>
    
<?php } ?>
