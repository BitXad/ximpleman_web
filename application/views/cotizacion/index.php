<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/cotizacion.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#cotizar_cli').keyup(function () {
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
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<!-------------------------------------------------------->
<div class="row micontenedorep" style="display: none" id="cabeceraprint">
    <table class="table" style="width: 100%; padding: 0;" >
    <tr>
        <td style="width: 25%; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 35%; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>COTIZACIONES</b></font> <br>
                
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 20%; padding: 0" >
                <center>
                         
                             
                            
                         
                        
                    </center>
        </td>
    </tr>
     
    
    
</table>       
        
</div>
<br>
<div class="row">
  <div class="col-md-6">


        <!--este es INICIO del BREADCRUMB buscador-->
        <div class="box-header">
                <font size='4' face='Arial'><b>Cotizaciones</b></font>
                <br><font size='2' face='Arial' id="pillados">Registros Encontrados: <?php echo sizeof($cotizacion); ?></font>
        </div>
        <!--este es FIN del BREADCRUMB buscador-->
 
        <!--este es INICIO de input buscador-->
        <div class="col-md-8 no-print">
            <div class="input-group">
                      <span class="input-group-addon"> 
                        Buscar 
                      </span>           
                <input id="cotizar_cli" type="text" class="form-control" placeholder="Ingresa el nombre de cliente" onkeypress="buscar_porcliente(event)" >
            </div></div>
            <div class="col-md-4 no-print">
                
                <select  class="btn btn-primary btn-sm"  id="select_fecha" onchange="busqueda_cotizacion()">
                    <option>Ultimas Cotizaciones</option>
                    <option value="1">Cotizaciones de Hoy</option>
                    <option value="2">Cotizaciones de Ayer</option>
                    <option value="3">Cotizaciones de la semana</option>
                    <option value="5">Cotizaciones por fecha</option>
                </select>
                
            </div>
            
        <!--este es FIN de input buscador-->

        <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
      </div>
     <div class="col-md-6 no-print">
        
    <div class="box-tools">
        <center>    
            <a href="<?php echo site_url('cotizacion/creacotizacion'); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-cart-plus"></span></font><br><small>Cotizar</small></a>
            
            <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="fechacotizacion('and 1')" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
            
            <a href="#" onclick="imprimir()" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
             
        </center>            
    </div>
    </div>   
        
    </div>
     <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='font-family: Arial; display:none; padding-bottom: 10px;'>
                <br>
                <center>            
                    <div class="col-md-4">
                        Desde: <input type="date" class="btn btn-primary btn-sm form-control" style=" width: 80%;"  id="fecha_desde" name="fecha_desde" required="true">
                    </div>
                    <div class="col-md-4">
                        Hasta: <input type="date" class="btn btn-primary btn-sm form-control" style=" width: 80%; "  id="fecha_hasta" name="fecha_hasta" required="true">
                    </div>

                   
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-sm form-control" face='Arial' tyle='font-family: Arial;' onclick="buscar_por_fecha()"><span class="fa fa-search"> Buscar</span></button>
                        
                    </div>
                    <br>


                </center>    
                <br>    
            </div>
    <div class="col-md-12">
        
        <div class="box">
          
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
						<th>#</th>
                        <th>Cliente</th>
						<th>Fecha</th>
						<th>Validez</th>
						<th>Forma de Pago</th>
						<th>Tiempo de Entrega</th>
						<th>Registro<br>Fecha/Hora</th>
						<th>Total Bs.</th>
                        <th>Usuario</th>
						<th class="no-print"></th>
                    </tr>
                    <tbody class="buscar" id="fechadecotizacion">
                    <?php $cont=0;
                    $i = 1;  
                    foreach($cotizacion as $c){ 
                        $cont++
                         ?>
                    <tr>
						<td><?php echo $cont; ?></td>
                        <td><?php if ($c['cotizacion_cliente']==''){ echo "A QUIEN CORRESPONDA"; }else{ echo $c['cotizacion_cliente']; }?></td>
                        <td><?php echo date("d/m/Y", strtotime($c['cotizacion_fecha'])); ?>
                         
                        </td>
                        <td><?php echo $c['cotizacion_validez']; ?></td>
                        <td><?php echo $c['cotizacion_formapago']; ?></td>
                        <td><?php echo $c['cotizacion_tiempoentrega']; ?></td>
                        <td><?php echo date("d/m/Y H:i:s", strtotime($c['cotizacion_fechahora'])); ?></td>
                        <td align="right"><?php echo number_format($c['cotizacion_total'],'2','.',','); ?></td>
                        <td><?php echo $c['usuario_nombre']; ?></td>
                        <td class="no-print">
                            <?php if($rol[38-1]['rolusuario_asignado'] == 1){ ?>
                            <a href="<?php echo site_url('cotizacion/add/'.$c['cotizacion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <?php }
                            if($rol[39-1]['rolusuario_asignado'] == 1){ ?>
                            <a href="<?php echo site_url('cotizacion/cotizarecibo/'.$c['cotizacion_id']); ?>" target="_blank" class="btn btn-success btn-xs"><span class="fa fa-print"></span></a>
                            <a href="<?php echo site_url('cotizacion/recibo/'.$c['cotizacion_id']); ?>" target="_blank" class="btn btn-facebook btn-xs"><span class="fa fa-print"></span></a>
                            <?php }
                            if($rol[40-1]['rolusuario_asignado'] == 1){ ?>
                           <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
                            <?php }?>
                             <!------------------------ INICIO modal para confirmar eliminación ------------------->
                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b> <span class="fa fa-trash"></span></b>
                                               ¿Desea eliminar la cotizacion <b> <?php echo $c['cotizacion_id']; ?></b>?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('cotizacion/remove/'.$c['cotizacion_id']); ?>" class="btn btn-danger"><span class="fa fa-pencil"></span> Si </a>
                                                      <a href="#" class="btn btn-success" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    <?php $i++; }?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
