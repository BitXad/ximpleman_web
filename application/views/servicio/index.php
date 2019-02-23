<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_servicio.js'); ?>" type="text/javascript"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="tipoimpresora" id="tipoimpresora" value="<?php echo $all_parametro[0]['parametro_tipoimpresora']; ?>" />

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
<script type="text/javascript">
    function muestra_oculta(id){
    if (document.getElementById){ //se obtiene el id
    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
    el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
        if(el.style.display == 'none'){
            $('#resbusdetalle').hide();
        }else{
            $('#resbusdetalle').show();
        }
    }
    }
    window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
    muestra_oculta('mapa');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
    //muestra_oculta('resbusdetalle');
    }
   
</script>
<script type="text/javascript">
    function imprimirdetalle(){
        //$('#tituloimpresion').html('hola');
        window.print();
    }
</script>

<style type="text/css">
    #alinear{ text-align: right; }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitabladetalleimpresion.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->


<!-------------------------------------------------------->

<div class="row">
    
    <div class="col-md-6">


        <!--este es INICIO del BREADCRUMB buscador-->
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <!--<li><a href="<?php //echo site_url('cliente')?>">Clientes</a></li>-->
                <li class="active"><b>Servicios: </b></li>
                <input style="border-width: 0; background-color: #DEDEDE" id="encontrados" type="text"  size="5" value="0" readonly="true">
            </ol>
        </div>
        <!--este es FIN del BREADCRUMB buscador-->
        <div class="col-md-8">
        <!--este es INICIO de input buscador-->
        <div class="input-group">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese cliente, código, estado serv.." onkeypress="validar2(event,3)">
            <!--<input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, codigo, ci, nit" onkeypress="buscarcliente(event)" autocomplete="off" >-->
        </div>
        
        <!--este es FIN de input buscador-->
        
        <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
        
        </div>
        <div class="col-md-4">
            <div  class="box-tools" >
        <select  class="btn btn-primary btn-sm" id="select_servicio" onchange="buscar_servicioporfechas()">
            <!--<option value="">- ELEGIR -</option>-->
            <option value="6">Servicios Pendientes</option>
            <option value="1">Servicios de Hoy</option>
            <option value="2">Servicios de Ayer</option>
            <option value="3">Servicios de la semana</option>
            <option value="4">Todos los Servicios</option>
            <option value="5">Servicios por fecha</option>
        </select>
  </div>
        </div>
        
    </div>
    
    <!---------------- BOTONES --------->
    <div class="col-md-6 no-print">
        
            <div class="box-tools text-center">
                <a class="btn btn-success btn-foursquarexs" href="<?php echo site_url('servicio/crearservicio'); ?>" title="Registrar nuevo servicio" ><font size="5"><span class="fa fa-wrench"></span></font><br><small>Reg. Servicio</small></a>
                <a class="btn btn-info btn-foursquarexs" onclick="fechadeservicio('')" title="Todos los Servicios" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></a>
                <a class="btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#modalbuscar" title="buscar por codigo" ><font size="5"><span class="fa fa-search"></span></font><br><small>Codigo Servicio</small></a>
                <a class="btn btn-success btn-foursquarexs" onClick="muestra_oculta('mapa')" id="mosmapa" title="Busqueda de detalles de Servicio"><font size="5"><span class="fa fa-search-plus"></span></font><br><small>Detalle Servicio</small></a>
                <a class="btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#modalbuscarkardexcli" title="buscar kardex de un Cliente" ><font size="5"><span class="fa fa-search"></span></font><br><small>Kardex Cliente</small></a>
                <a href="<?php echo base_url('pedido'); ?>" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>           
    </div>
    </div>
    <!---------------- FIN BOTONES --------->
    
</div>
    
<!-------------------------------------------------------------------------------->

































<div class="box-header no-print">
    <!--<h3 class="box-title"><b>Servicios</b></h3><br>-->
    <div class="container">  
        <div class="box-tools">
            <!--
            <a class="btn btn-success btn-foursquarexs" href="<?php //echo site_url('servicio/crearservicio'); ?>" title="Registrar nuevo servicio" ><font size="5"><span class="fa fa-plus-circle"></span></font><br><small>Nuevo Servicio</small></a>
            <a class="btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#modalbuscar" title="buscar por codigo" ><font size="5"><span class="fa fa-search"></span></font><br><small>Codigo Servicio</small></a>
            <a class="btn btn-success btn-foursquarexs" onClick="muestra_oculta('mapa')" id="mosmapa" title="Busqueda de detalles de Servicio"><font size="5"><span class="fa fa-search-plus"></span></font><br><small>Detalle Servicio</small></a>
            <a class="btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#modalbuscarkardexcli" title="buscar kardex de un Cliente" ><font size="5"><span class="fa fa-search"></span></font><br><small>Kardex Cliente</small></a>
                <!--</div>-->
            <div id="mapa">
                <div class="panel panel-primary col-md-11">
                    <!--<div class="panel panel-primary col-md-8" id='buscador_oculto' > style='display:none; padding-top: 10px;'> -->
                        <div class="col-md-2">
                            Buscar por Fechas:
                            <select  class="btn btn-primary btn-sm form-control" id="select_detservicio" onchange="buscar_detservicioporfechas()">
                                <option value="">- ELEGIR -</option>
                                <option value="1">Det. Serv. de Hoy</option>
                                <option value="2">Det. Serv. de Ayer</option>
                                <option value="3">Det. Serv. de la semana</option>
                                <option value="4">Todos los Det. de Serv.</option>
                                <!--<option value="5">Det. de Serv. por fecha</option>-->
                            </select>
                        </div>
                        <div class="col-md-2">
                            Desde: <input type="date" class="btn btn-primary btn-sm form-control" id="fechadet_desde" name="fechadet_desde" required="true">
                        </div>
                        <div class="col-md-2">
                            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" id="fechadet_hasta" name="fechadet_hasta" required="true">
                        </div>

                        <div class="col-md-2">
                            Estado:             
                            <select  class="btn btn-primary btn-sm form-control" id="buscarestadodet_id" required>
                                <option value="0">TODOS</option>
                                <?php foreach($all_estado as $estado){?>
                                <option value="<?php echo $estado['estado_id']; ?>"><?php echo $estado['estado_descripcion']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            Categoria Servicio:
                            <select name="catserv_id" class="btn btn-primary btn-sm form-control" id="catserv_id">
                            <option value="-1">- TODOS -</option>
                            <option value="0">- SIN CAT. SERV. -</option>
                            <?php
                            foreach($all_categoria_servicio as $catserv)
                            {
                                if($catserv['catserv_id'] <>0){
                                    echo '<option value="'.$catserv['catserv_id'].'">'.$catserv['catserv_descripcion'].'</option>';
                                }
                            } 
                            ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                                Sub Categoria Servicio:
                                <input type="text" name="buscarsubcat" id="buscarsubcat" class="btn btn-primary btn-sm form-control" style="background-color: white; color: black; text-align: left; cursor: auto;" placeholder="Ingrese Sub Categoria" />
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-sm btn-primary btn-sm btn-block"  type="submit" onclick="buscar_detallepor_fecha()" style="height: 34px;">
                                <span class="fa fa-search"></span>Buscar Detalle Serv.
                          </button>
                            <br>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <span class="badge btn-primary" style="height: 34px; padding-top: 5px;">Detalle Serv. encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="resdetserv" type="text" value="0" readonly="true"> </span></span>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <br>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <a id="imprimirestedetalle" class="btn btn-sq-lg btn-success" onclick="imprimirdetalle()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
                        </div>

                </div>
                </div>
            <!--</div>-->
            
        </div>

        
    </div>
</div>
<div class="row" id="resbusdetalle">
    <div class="col-md-12">
        <div class="box">
            <!-- *********************aqui se muestra el resultado************************** -->
            <div class="box-body table-responsive" id="contenedortitulo">
                <div id="cabizquierda">
                <?php
                echo $all_empresa[0]['empresa_nombre']."<br>";
                echo $all_empresa[0]['empresa_direccion']."<br>";
                echo $all_empresa[0]['empresa_telefono'];
                ?>
                </div>
                <div id="cabcentro">
                    ORDENES DE DETALLES DE SERVICIO<br>
                    <label id="tituloimpresion"></label>
                </div>
                <div id="cabderecha">
                    <?php
                    $mimagen = "thumb_".$all_empresa[0]['empresa_imagen'];
                    echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
                    ?>
                </div>
                
            </div>
            <div class="box-body table-responsive" id="cabizquierdafechas">
                    <label id="tituloimpresion">fecha de</label>
                </div>
            <div class="box-body table-responsive" id="resbusquedadetalleserv">

            </div>
        </div>
    </div>
</div>
<!-- *******************************INICIO Buscador por fechas************************************ -->
<div class="no-print">
<!--<div class="col-md-6">
    <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Ingrese cliente, código, estado serv.." onkeypress="validar2(event,3)">
    </div>
</div> -->
<!--<div class="container" id="categoria">
                <span class="badge btn-primary">Servicios encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="encontrados" type="text" value="0" readonly="true"> </span></span>
</div>-->
      <!-------------------- CATEGORIAS------------------------------------->
<!--<div class="col-md-6">
    <div  class="box-tools" >
        <select  class="btn btn-primary btn-sm" id="select_servicio" onchange="buscar_servicioporfechas()">
            <!--<option value="">- ELEGIR -</option>-->
    <!--        <option value="6">Servicios Pendientes</option>
            <option value="1">Servicios de Hoy</option>
            <option value="2">Servicios de Ayer</option>
            <option value="3">Servicios de la semana</option>
            <option value="4">Todos los Servicios</option>
            <option value="5">Servicios por fecha</option>
        </select>
  </div>
</div> -->
      <!--<div class="container">-->
<!--<form method="post" onclick="buscar_por_fecha()">-->
    <div class="panel panel-primary col-md-12" id='buscador_oculto' style='display:none; text-align: center; padding-top: 10px;'>
        
        <center>            
            <div class="col-md-2">
                Desde: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_desde" name="fecha_desde" required="true">
            </div>
            <div class="col-md-2">
                Hasta: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_hasta" name="fecha_hasta" required="true">
            </div>

            <div class="col-md-2">
                Estado:             
                <select  class="btn btn-primary btn-sm form-control" id="buscarestado_id" required>
                    <option value="0">TODOS</option>
                    <?php foreach($all_estado as $estado){?>
                    <option value="<?php echo $estado['estado_id']; ?>"><?php echo $estado['estado_descripcion']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <div class="col-md-3">

    <!--            <a href="<?php //echo site_url('pedido/crearpedido'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Nuevo pedido</a>-->
                <button class="btn btn-sm btn-primary btn-sm btn-block"  type="submit" onclick="buscar_por_fecha()" style="height: 34px;">
                    <!--<h4>-->
                    <span class="fa fa-search"></span>Buscar Servicios
                    <!--</h4>-->
              </button>
                <br>
            </div>

        </center>    
        <br>    
    </div>
<!--</form>-->
<!--</div>-->
<!--<div class="container" id="categoria">
    
                <span class="badge btn-primary">Servicios encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontradosfecha" type="text" value="0" readonly="true"> </span></span>

</div>-->
</div>
<!-- *******************************F I N  Buscador por fechas************************************ -->
<div class="row no-print">
    <div class="col-md-12">
       
        
        
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
                                                <th>Cliente</th>
                                                <th>Codigo</th>
                                                <th>Fechas</th>
						<th>Estado</th>
						<th>Tipo Servicio</th>
						
						<th>Reg. por </th>
						
						<th>Tot.</th>
						<th>A. C.</th>
						<th>Saldo</th>
						<th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php 
                    /*$i =1; $cont = 0;
                          foreach($servicio as $s){ $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td>
                            <?php if($s['cliente_nombre'] <> ""){
                                      echo $s['cliente_nombre'];
                                  }else{
                                      echo "NO DEFINIDO";
                                  } ?>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo site_url('servicio/serviciocreado/'.$s['servicio_id']); ?>" class="btn btn-info btn-sm" title="Ver, Modificar Servicio Creado">
                                <?php echo $s['servicio_id']; ?></a></td>
                        <td><?php $fechamos = "";
                                if($s['servicio_fechafinalizacion'] <> null) $fechamos = date('d/m/Y', strtotime($s['servicio_fechafinalizacion']));
                                echo "<font size='1'><b>Recep.: </b>".date('d/m/Y', strtotime($s['servicio_fecharecepcion'])).'|'.$s['servicio_horarecepcion']."<br>";
                                echo "<b>Salida: </b>".$fechamos.'|'.$s['servicio_horafinalizacion']."</font>";
                        ?></td>
                        <td style="background-color: #<?php echo $s['estado_color']; ?>"><?php echo $s['estado_descripcion']; ?></td>
                        <td><?php //Tipo de Servicio 1 esta definido como "Servicio Normal"
                            echo $s['tiposerv_descripcion']."<br>";
                            if($s['tiposerv_id'] <> 1){
                                echo "<font size='1'><b>Dir.: </b>".$s['servicio_direccion']."</font>";
                            }
                         ?></td>

                        <td><?php echo $s['usuario_nombre']; ?></td>

                        <td id='alinear'><?php echo number_format($s['servicio_total']); ?></td>
                        <td id='alinear'><?php echo number_format($s['servicio_acuenta']); ?></td>
                        <td id='alinear'><?php echo number_format($s['servicio_saldo']); ?></td>
                        <td>
                                                    
                                  <!------------------------ INICIO modal para confirmar Anulacion ------------------->
                                    <div class="modal fade" id="modalanulado<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3>
                                               ¿Desea Anular el Servicio <b> <?php echo $s['servicio_id']; ?></b>?
                                           </h3>
                                           Al ANULAR este servicio, se anularan todos sus detalles(incluidos Total, A cuenta y Saldo seran CERO).
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                              <!--<a href="<?php //echo site_url('servicio/anularserv/'.$s['servicio_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>-->
                                              <a onclick="anulartodoelservicio(<?php echo $s['servicio_id']; ?>, <?php echo $i; ?>)" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar Anulacion ------------------->
                        <!------------------------ INICIO modal para confirmar Eliminación ------------------->
                                    <div class="modal fade" id="modaleliminar<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modaleliminarLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3>
                                               ¿Desea Eliminar el Servicio <b> <?php echo $s['servicio_id']; ?></b>?
                                           </h3>
                                           Al ELIMINAR este servicio, se perdera toda la informacion del servicio.
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <!--<a href="<?php //echo site_url('servicio/remove/'.$s['servicio_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>-->
                                                      <a onclick="eliminartodoelservicio(<?php echo $s['servicio_id']; ?>, <?php echo $i; ?>)" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar Eliminación ------------------->
                        
                        <a href="<?php echo site_url('servicio/serview/'.$s['servicio_id']); ?>" class="btn btn-info btn-xs" title="ver, modificar detalle"><span class="fa fa-pencil"></span></a> 
                        <a data-toggle="modal" data-target="#modalanulado<?php echo $i; ?>" class="btn btn-warning btn-xs" title="anular servicio"><span class="fa fa-minus-circle"></span></a>
                        <a data-toggle="modal" data-target="#modaleliminar<?php echo $i; ?>" class="btn btn-danger btn-xs" title="eliminar servicio"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php $i++; } */ ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($a)){ ?>
        <script type="text/javascript">
        alert('No Existe ese servicio')
</script> 
<?php
    }
    ?>

<!-- ---------------------- Inicio modal para Buscar un servicio por su codigo (servicio_id) ----------------- -->
                                    <div class="modal fade" id="modalbuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <label>Buscar servicio por Codigo:</label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                            <?php
                                            echo form_open('servicio/buscarporcod');
                                            ?>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           
                                           <div class="col-md-6">
						<label for="servicio_id" class="control-label"><span class="text-danger">*</span>Codigo</label>
						<div class="form-group">
							<input type="text" name="servicio_id" class="form-control" id="cliente_nombre" required />
						</div>
					  </div>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                              <button type="submit" class="btn btn-warning">
                                                    <i class="fa fa-search"></i> Buscar
                                              </button>
<!--                                              <a href="<?php // echo site_url('cliente/add_new'); ?>" type="submit" class="btn btn-success">
                                                <i class="fa fa-check"></i> Guardar
                                              </a>-->
                                              <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <i class="fa fa-times"></i> Cancelar</a>
                                          </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>
<!-- ---------------------- Fin modal para Buscar un servicio por su codigo (servicio_id) ----------------- -->

<!-- ---------------------- Inicio modal para Buscar Kardex de un cliente ----------------- -->
<div class="modal fade" id="modalbuscarkardexcli" tabindex="-1" role="dialog" aria-labelledby="modalbuscarkardexcli">
  <div class="modal-dialog" role="document">
        <br><br>
    <div class="modal-content">
      <div class="modal-header">
          <label>Buscar Cliente:</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      </div>
        <?php
        echo form_open('detalle_serv/buscarcliente');
        ?>
      <div class="modal-body">
       <!------------------------------------------------------------------->

       <div class="col-md-6">
            <label for="buscarcliente" class="control-label"><span class="text-danger">*</span>Nombre Cliente</label>
            <div class="form-group">
                    <input type="text" name="buscarcliente" class="form-control" id="buscarcliente" required />
            </div>
      </div>
       <!------------------------------------------------------------------->
      </div>
      <div class="modal-footer aligncenter">
          <button type="submit" class="btn btn-warning">
                <i class="fa fa-search"></i> Buscar
          </button>
<!--                                              <a href="<?php // echo site_url('cliente/add_new'); ?>" type="submit" class="btn btn-success">
            <i class="fa fa-check"></i> Guardar
          </a>-->
          <a href="#" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times"></i> Cancelar</a>
      </div>
        <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- ---------------------- Fin modal para Buscar Kardex de un Cliente ----------------- -->