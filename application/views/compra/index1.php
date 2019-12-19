<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/compra.js'); ?>" type="text/javascript"></script>
   

<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $('#comprar').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
    $(document).ready(function () {
        (function ($) {
            $('#filtrar2').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar2 tr').hide();
                $('.buscar2 tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
      function imprimir()
        {
             window.print(); 
        }
</script>   

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">

<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<!-------------------------------------------------------->
<div class="row micontenedorep" style="display: none" id="cabeceraprint">
    <div id="cabizquierda">
        <?php
        echo $empresa[0]['empresa_nombre']."<br>";
        echo $empresa[0]['empresa_direccion']."<br>";
        echo $empresa[0]['empresa_telefono'];
        ?>
        </div>
        <div id="cabcentro">
            <div id="titulo">
                <u>COMPRAS</u><br><br>
                <!--<span style="font-size: 9pt">INGRESOS DIARIOS</span><br>-->
                <span class="lahora" id="fhimpresion"></span><br>
                <span style="font-size: 8pt;" id="busquedaavanzada"></span>
                <!--<span style="font-size: 8pt;">PRECIOS EXPRESADOS EN MONEDA BOLIVIANA (Bs.)</span>-->
            </div>
        </div>
        <div id="cabderecha">
            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

        </div>
        
</div>
<br>
<div class="row">
    
    <div class="col-md-6">


        <!--este es INICIO del BREADCRUMB buscador-->
        <div class="box-header">
                <font size='4' face='Arial'><b>Compras</b></font>
                <br><font size='2' face='Arial' id="pillados">Registros Encontrados: <?php echo sizeof($compra); ?></font>
        </div>
        <!--este es FIN del BREADCRUMB buscador-->
 
        <!--este es INICIO de input buscador-->
        <div class="col-md-8 no-print">
            <div class="input-group">
                      <span class="input-group-addon"> 
                        Buscar 
                      </span>           
                <input id="comprar" type="text" class="form-control" placeholder="Ingresa el nombre de proveedor" onkeypress="validacompra(event,4)" >
            </div></div>
            <div class="col-md-4 no-print">
                <?php if($rolusuario[11-1]['rolusuario_asignado'] == 1){ ?>
                <select  class="btn btn-primary btn-sm"  id="select_compra" onchange="buscar_compras()">
                    <option value="1">Compras de Hoy</option>
                    <option value="2">Compras de Ayer</option>
                    <option value="3">Compras de la semana</option>
                    <option value="5">Compras por fecha</option>
                </select>
                <?php }?>
            </div>
            
        <!--este es FIN de input buscador-->

        <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
        
        
    </div>
    
    <!---------------- BOTONES --------->
    <div class="col-md-6 no-print">
        
    <div class="box-tools">
        <center> <?php if (sizeof($comprasn)>0){ ?>
            <a href="#" data-toggle="modal" data-target="#avisar" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-cart-plus"></span></font><br><small>Comprar</small></a>
            
        <?php }else{ ?>    
            <a href="<?php echo site_url('compra/crearcompra'); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-cart-plus"></span></font><br><small>Comprar</small></a>
        <?php } ?>           
            <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="fechadecompra('and 1')" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
            <?php if($rolusuario[10-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" onclick="imprimir_compra()" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
            <?php } ?>
            <!--<a href="" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>-->            
        </center>            
    </div>
    </div>
    <!---------------- FIN BOTONES --------->
    
</div>
    
<!-------------------------------------------------------------------------------->

<div class="row">
    <div class="col-md-12">
       
   
        <!-------------------- CATEGORIAS------------------------------------->
       
            <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='font-family: Arial; display:none; padding-bottom: 10px;'>
                <br>
                <center>            
                    <div class="col-md-2">
                        Desde: <input type="date" class="btn btn-primary btn-sm form-control" style=" width: 75%; font-size: 11px;"  id="fecha_desde" value="<?php echo date('Y-m-d') ?>" name="fecha_desde" required="true">
                    </div>
                    <div class="col-md-2">
                        Hasta: <input type="date" class="btn btn-primary btn-sm form-control" style=" width: 75%; font-size: 11px;"  id="fecha_hasta" value="<?php echo date('Y-m-d') ?>" name="fecha_hasta" required="true">
                    </div>

                    <div class="col-md-4">
                        Tipo:         
                        <select  class="btn btn-primary btn-sm form-control" style=" width: 45%; font-size: 11px;"  id="tipotrans_id" required="true" name="tipo_transa">
                            <option value="0">- TODOS -</option>
                            <?php foreach($tipo_transaccion as $es){?>
                                <option value="<?php echo $es['tipotrans_id']; ?>"><?php echo $es['tipotrans_nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-sm form-control" face='Arial' onclick="buscar_por_fecha()"><span class="fa fa-search"></span> Buscar</button>
                        
                    </div>
                    <br>


                </center>    
                <br>    
            </div>

            <!-- Modal AVISO-->
<div class="modal fade" id="avisar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Tiene compras sin finalizar</h3>
      
      </div>
      <div class="modal-body">
        <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Compra</th>
                        <th>Prov.</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar2">
                        <?php $cont = 0;
                        $bandera = 0;
                        foreach($comprasn as $psn){;
                           $cont = $cont+1; ?>
                           <tr>
                            <td><?php echo $cont ?></td>
                            <td><?php echo $psn['compra_id']; ?></td>
                            <td>NO DEF.</td>
                            <td><?php echo date('d/m/Y',strtotime($psn['compra_fecha'])) ;  ?> <?php echo $psn['compra_hora']; ?></td>
                            
                            <td>
                                <a href="<?php echo site_url('compra/edit/'.$psn['compra_id'].'/'.$bandera); ?>"  class="btn btn-facebook btn-xs"><span class="fa fa-check" ></span> Continuar Esta Compra</a>
                            </td>
                    </tr>
                    <?php } ?></tbody>
                </table>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <a href="<?php echo site_url('compra/crearcompra'); ?>"  class="btn btn-success">Continuar Compra Nueva</a>
      </div>
    </div>
  </div>
</div>
        <!-- Fin Modal AVISO-->
        <div class="container" id="categoria">


        </div>
        <div class="box">

            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla">
    <tr>
      <th>#</th>
      <th>Proveedor</th>
      <th>Compra</th>
<!--                        <th>Sub <br>Total</th>
    <th>Desc.</th>-->
    <th>Total</th>
    <th>Fecha<br>Hora</th>
    <th>Estado</th>
    <th>Usuario</th>
    <th class="no-print"></th>
    </tr>
<!-- <tbody class="buscar" id="compraproveedor">-->
    <tbody class="buscar" id="fechadecompra">

       <?php $cont = 0;
       $total = 0;
       foreach($compra as $c){;
          $cont = $cont+1;



          $subto = $c['compra_totalfinal'];
          $total = $total + $subto;
          ?>
          <tr>
              <td><?php echo $cont ?></td>
              <!--<td><?php //echo $p['compra_id']; ?></td>-->
              <td><font size="3"><b><?php echo $c['proveedor_nombre']; ?></b></font><font size="1">[<?php echo $c['proveedor_id']; ?>]</font> <br>
                <?php if ($c['tipotrans_nombre']=='CREDITO')  { ?>
                <span class="btn-facebook btn-xs"><?php echo $c['tipotrans_nombre']; ?></span><br>
              <?php } else { ?>
                <span class="btn-info btn-xs"><?php echo $c['tipotrans_nombre']; ?></span><br>
              <?php }  ?>
                <?php if ($c['compra_caja']==1){  ?><span class="btn-warning btn-xs">  <?php echo "Pago con Caja"; } ?><?php if ($c['compra_caja']==2){  ?><span class="btn-warning btn-xs">  <?php echo "Orden de Pago"; } ?></span></td>
                <td><center><font size="4"><b><?php echo $c['compra_id']; ?></b></font></center></td>
                <td align="right" ><?php echo "Sub Total: ".number_format($c['compra_subtotal'],'2','.',','); ?><br>
                  <?php echo "Desc.: ".number_format($c['compra_descuento'],'2','.',','); ?><br>
                  <?php echo "Desc.Global: ".number_format($c['compra_descglobal'],'2','.',','); ?><br>  
                  <font size="3"><b><?php echo number_format($c['compra_totalfinal'],'2','.',','); ?></b></font></td>

                  <td align="center"><?php echo date('d/m/Y',strtotime($c['compra_fecha'])) ; ?><br>
                    <?php echo $c['compra_hora']; ?></td>
                    <td align="center" style='background: #<?php echo $c['estado_color']; ?>'><?php echo $c['estado_descripcion']; ?> <br> <?php if($c['compra_placamovil']==1) { ?><span class="btn-danger btn-xs">NO FINALIZADO</span> <?php } ?></td>
                    <td align="center"> <?php echo $c['usuario_nombre']; ?></td>
                    <td class="no-print">
                        <?php if($c['compra_placamovil']==1) { ?>
                         <a href="#" data-toggle="modal" data-target="#cambi<?php echo $c['compra_id']; ?>" class="btn btn-info btn-xs" title='Modificar Compra'>
                           <i class="fa fa-pencil "></i>

                       </a>

                       <div class="modal fade" id="cambi<?php echo $c['compra_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                          <div class="modal-dialog"  role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="form">   
                             <center><h4> Desea continuar con esta compra? 
                             </h4></center>
                         </div>
                         <div class="modal-footer" >       
                          <a  href="<?php echo site_url('compra/edit/'.$c['compra_id'].'/1'); ?>" class="btn btn-md btn-success" >
                            <i class="fa fa-sign-out "></i>
                            Si, continuar con la compra
                        </a> 
                        <a  href="<?php echo site_url('compra/borrarauxycopiar/'.$c['compra_id']); ?>" class="btn btn-md btn-danger" >
                            <i class="fa fa-sign-in "></i>
                            No, borrar datos y rehacer la compra
                        </a>  
                    </div> </div></div></div></div>
                <?php } else { ?>
                    <a href="<?php echo site_url('compra/borrarauxycopiar/'.$c['compra_id']); ?>" class="btn btn-info btn-xs" title='Modificar Compra'><span class="fa fa-pencil"></span></a>
                <?php } ?>
                <a href="<?php echo site_url('compra/nota/'.$c['compra_id']); ?>" target="_blank" class="btn btn-success btn-xs" title='Nota de Compra'><span class="fa fa-print"></span></a>  
                 <?php if($rolusuario[8-1]['rolusuario_asignado'] == 1 && $c['elestado']==1){ ?> 
                <a href="#" data-toggle="modal" data-target="#anularmodal<?php echo $c['compra_id'] ?>" class="btn btn-xs btn-warning" title="Anular Compra" >
                <i class="fa fa-minus-circle "></i>
            </a>
            <?php } ?>


 <!---------------------------------MODAL DE ANULAR COMPRA------------------------->

  <div class="modal fade" id="anularmodal<?php echo $c['compra_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4><b> <em class="fa fa-minus-circle"></em> Desea anular la compra No.: <?php echo $c['compra_id']; ?>? 
              </b></h4>
              </div>
              <div class="modal-body" align="center">
                <

         <h4>
               Esta compra puede tener una orden de Pago, tomar en cuenta.
           </h4>
          </div>
              <div class="modal-footer" align="right">

            <a href="<?php echo site_url('compra/anular/'.$c['compra_id']); ?>" class="btn btn-xs btn-warning"  type="submit">
                <h5>
                <span class="fa fa-check"></span>   Anular  
                </h5>
            </a>
            
            <button class="btn btn-xs btn-danger" data-dismiss="modal">
                <h5>
                <span class="fa fa-close"></span>   Cancelar  
                </h5>
            </button>
                         
        </div>

            </div>
          </div>
        </div>
        <!---------------------------------FIN MODAL DE ANULAR COMPRA------------------------->
            </td>
        </tr>

    <?php  } ?>


    <tr>
        <td></td>    
        <td></td>    
        <td align="right"><b>TOTAL</b></td> 
        <td align="right"><font size="4"><b><?php echo number_format($total,'2','.',','); ?></b></font></td>
        <td></td>    
        <td></td>
        <td></td>
    </tr>
    <?php ?></tbody>
</table>

</div>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>                    
</div>                
</div>
</div>
</div>

<!-------------------- FIN CATEGORIAS--------------------------------->





<div class="row no-print">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese la fecha, total">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <font face="arial" size="2">
            <b>
            Compras sin Proveedor asignado            
            </b>
        </font>
        
        <div class="box">

            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Id</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Total</th>
                       
                        <th>Estado</th>
                        <th> </th>
                    </tr>
                    <tbody class="buscar2">
                        <?php $cont = 0;
                        $bandera = 0;
                        foreach($comprasn as $psn){;
                           $cont = $cont+1; ?>
                           <tr>
                            <td><?php echo $cont ?></td>
                            <td><?php echo $psn['compra_id']; ?></td>
                            <td>NO DEFINIDO</td>
                            <td><?php echo date('d/m/Y',strtotime($psn['compra_fecha'])) ;  ?> <?php echo $psn['compra_hora']; ?></td>
                            <td><?php echo $psn['compra_subtotal']; ?></td>
                            <td><?php echo $psn['compra_descuento']; ?></td>  
                            <td><?php echo $psn['compra_total']; ?></td>
                            
                            <td><?php echo $psn['estado_descripcion']; ?></td>
                            <td>
                                <a href="<?php echo site_url('compra/edit/'.$psn['compra_id'].'/'.$bandera); ?>"  class="btn btn-facebook btn-xs"><span class="fa fa-check" ></span> Continuar Compra</a>
                           <!--<a href="<?php echo site_url('compra/edito/'.$psn['compra_id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-asterisk"></span></a>  
                            <a href="<?php echo site_url('compra/remove/'.$psn['compra_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?></tbody>
                </table>

            </div>
<!--            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>-->
            </div>
        </div>
    </div>
