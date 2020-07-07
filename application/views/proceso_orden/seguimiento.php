<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/proceso_orden.js'); ?>" type="text/javascript"></script>
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


<?php if(sizeof($procesos)>0){  ?>

<div class="box-header">
    <!--<center>-->
        
        <font face="Arial" size="3"><b>ORDEN DE TRABAJO Nº 00<?php echo $orden_id; ?>  </b></font>
        <br><font face="Arial" size="2"><b>CLIENTE:</b><?php echo $procesos[0]['cliente_nombre']; ?></font>
            	<div class="box-tools">
                    
                </div>
    <!--</center>-->
</div>
<!--<div class="row">
  <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
    <div class="col-md-12">
      <select name="estado" class="btn-primary btn-sm btn-block" id="estado" onchange="buscarorden()">
                        <option value="" disabled selected >-- PROCESO --</option>
                        <?php 
                        foreach($estados as $estado)
                        {
                            echo '<option value="'.$estado['estado_id'].'">'.$estado['estado_descripcion'].'</option>';
                        } 
                        ?>
                    </select>
    </div>
</div>-->
<?php foreach ($detalle as $key) { ?>
 
<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body table-responsive table-condensed">
                <table class="table table-condensed "id="mitabla">
                    <tr>
                        <th>RECEPCION</th>
                        <th></th>
                        <th>CORTE</th>
                        <th></th>
                        <th>PULIDO</th>
                        <th></th>
                        <th>ENTRANTE</th>
                        <th></th>
                        <th>TEMPLADO</th>
                        <th></th>
                        <th>PARA<br>ENTREGA</th>
                        <TH></TH>
                        <th>ENTREGADO</th>
                        
                    </tr>
                    <tr style="font-family: Arial">
                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr style="font-family: Arial">
                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr style="font-family: Arial" align="center">

                        <?php  
                            $cont = 0;
                        foreach ($procesos as $p){ 
                            if ($key['detalleorden_id']==$p['detalleorden_id']) {
                                                        
                            if ($cont > 0){ ?>                        
                        <td  style="padding: 0;"><br><br><br><font face="Arial" size="3"><fa class="fa fa-arrow-right"></fa> </font></td>
                            <?php } $cont++;  ?>
                        <td style="padding: 0; line-height: 10px;" >
                            <!--<button class="btn btn-success btn-block" style="background-color: <?php echo "#".$p['estado_color']; ?>;">-->
                            <div class="boton">
                                
                            <button class="button button5" style="background-color: <?php echo "#".$p['estado_color']; ?>;">
                                <?php 

                                    $dt = new DateTime($p['proceso_fechaproceso']);
                                    $df = new DateTime($p['proceso_fechaterminado']);
                                    //print $dt->format('d/m/Y'); // imprime 29/03/2018
                                    //print $dt->format('H:i:s'); // imprime 15:20:40
                                ?>
                                
                                
                                <font size="1"><b><?php echo $p['estado_descripcion']; ?></b></font>
                                <?php if ($p['estado_id']==26) { ?>
                                <br><font size="1"><?php echo $df->format('d/m/Y'); ?>
                                <br><?php echo $df->format('H:i:s'); ?></font>    
                                <?php }else{ ?>
                                <br><font size="1"><?php echo $dt->format('d/m/Y'); ?>
                                <br><?php echo $dt->format('H:i:s'); ?></font>
                                <?php } ?>                            
                            </button> 
                            </div>
                        </td>                                                   

                        <?php } }  } ?>   
                        
                       
                        
                        
                            
                
                    </tr>
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
    <div class="col-md-2">
        <div class="box">
            
            <div class="box-body table-responsive table-condensed">
                <table class="table table-condensed "id="mitabla">
                    <tr style="padding: 0;">
                        <!--<th> </th>-->
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
<?php } else{ ?>
<center>    
    <h2><b>LA ORDEN DE TRABAJO NO EXISTE..!!</b></h2>
    <h3>LE RECOMENDAMOS CONSULTAR CON LA EMPRESA</h3>    
    <a href='<?php echo base_url(); ?>' class='btn btn-warning'><fa class='fa fa-close'></fa> Salir</a>
</center>
    
<?php } ?>
