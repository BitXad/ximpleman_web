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
    function estefocus(){
        $('#modalbuscarkardexcli').on('shown.bs.modal', function() {
        $('#buscarcliente').focus();
    });
    }
    function codigoservfocus(){
        $('#modalbuscar').on('shown.bs.modal', function() {
        $('#servicio_id').focus();
    });
    }
    function kardexdetallefocus(){
        $('#modalbuscardetalle').on('shown.bs.modal', function() {
        $('#codigo').focus();
    });
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
<div class="row">
    <div class="col-md-6 no-print">
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
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese cliente, código, estado serv.." onkeypress="validar2(event,3)" autofocus autocomplete="off">
        </div>
        </div>
        <div class="col-md-4">
            <div  class="box-tools" >
                <select  class="btn btn-primary btn-sm" id="select_servicio" onchange="buscar_servicioporfechas()">
                    <!--<option value="">- ELEGIR -</option>-->
                    <option value="6">Servicios Pendientes</option>
                    <option value="1">Servicios de Hoy</option>
                    <option value="2">Servicios de Ayer</option>
                    <option value="3">Servicios de la semana</option>
                    <!--<option value="4">Todos los Servicios</option>-->
                    <option value="5">Servicios por fecha</option>
                </select>
            </div>
        </div>
    </div>
    <!---------------- BOTONES --------->
    <div class="col-md-6 no-print">
        <div class="box-tools text-center">
            <a class="btn btn-success btn-foursquarexs" href="<?php echo site_url('servicio/crearservicio'); ?>" title="Registrar nuevo servicio" ><font size="5"><span class="fa fa-wrench"></span></font><br><small>Reg. Servicio</small></a>
            <?php
            if($rol[72-1]['rolusuario_asignado'] == 1){ ?>
            <a class="btn btn-info btn-foursquarexs" onclick="fechadeservicio('')" title="Todos los Servicios" ><font size="5"><span class="fa fa-eye"></span></font><br><small>Ver Todos</small></a>
            <?php } ?>
            <a class="btn btn-primary btn-foursquarexs" data-toggle="modal" data-target="#modalbuscar" title="buscar por codigo" onclick="codigoservfocus()" ><font size="5"><span class="fa fa-search"></span></font><br><small>Codigo Servicio</small></a>
            <a class="btn btn-soundcloud btn-foursquarexs" data-toggle="modal" data-target="#modalbuscardetalle" title="Busqueda de detalles de Servicio" onclick="kardexdetallefocus()"><font size="5"><span class="fa fa-binoculars"></span></font><br><small>Kardex Detalle</small></a>
            <a class="btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#modalbuscarkardexcli" title="buscar kardex de un Cliente" onclick="estefocus()" ><font size="5"><span class="fa fa-address-card-o"></span></font><br><small>Kardex Cliente</small></a>
            <a href="<?php echo base_url('servicio/repserviciodiario'); ?>" class="btn btn-danger btn-foursquarexs" target="_blank" title="Movimiento economico diario"><font size="5"><span class="fa fa-print"></span></font><br><small>Reporte Diario</small></a>           
        </div>
    </div>
    <!---------------- FIN BOTONES --------->
</div>
<!-- *******************************INICIO Buscador por fechas************************************ -->
<div class="no-print">
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
                <button class="btn btn-sm btn-soundcloud btn-sm btn-block"  type="submit" onclick="buscar_por_fecha()" style="height: 34px;">
                    <span class="fa fa-search"></span>Buscar Servicios
              </button>
                <br>
            </div>

        </center>    
        <br>    
    </div>
</div>
<div id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
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
                        <th>Código</th>
                        <th>Fechas</th>
                        <th>Detalle</th>
                        <th>Estado</th>
                        <th>Tipo Serv.</th>

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
if(isset($a) && $a == 1){ ?>
    <script type="text/javascript">
    alert('No Existe ese servicio');
    </script> 
<?php
}elseif(isset($a) && $a == "no"){ ?>
    <script type="text/javascript">
    alert('No se encontro el detalle de servicio');
    </script> 
<?php
} ?>

<!-- ---------------------- Inicio modal para Buscar un servicio por su codigo (servicio_id) ----------------- -->
                                    <div class="modal fade" id="modalbuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <label>Buscar servicio por Código:</label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                            <?php
                                            echo form_open('servicio/buscarporcod');
                                            ?>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           
                                           <div class="col-md-6">
						<label for="servicio_id" class="control-label"><span class="text-danger">*</span>Código</label>
						<div class="form-group">
                                                    <input type="number" min="0" name="servicio_id" class="form-control" id="servicio_id" required />
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
                <input type="text" name="buscarcliente" class="form-control text-uppercase" id="buscarcliente" required />
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
<!-- ---------------------- Inicio modal para buscar el historial de un detalle de servicio ----------------- -->
<div class="modal fade" id="modalbuscardetalle" tabindex="-1" role="dialog" aria-labelledby="modalbuscardetalleLabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
          <div class="modal-header">
              <label>buscar Kardex:</label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
          </div>
            <?php
            echo form_open('detalle_serv/buscardetalleservk');
            ?>
          <div class="modal-body">
           <!------------------------------------------------------------------->

           <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="codigo" class="form-control" id="codigo" required placeholder="Codigo del Producto" autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                </div>
          </div>
          <div class="col-md-6">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-search"></i> Buscar
              </button>
        </div>
           <!------------------------------------------------------------------->
          </div>
          <div class="modal-footer aligncenter"></div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- ---------------------- Fin modal para buscar el historial de un detalle de servico ----------------- -->