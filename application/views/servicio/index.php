    <!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_servicio.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/servicio_facturasin.js'); ?>" type="text/javascript"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" />
<input type="hidden" name="tipoimpresora" id="tipoimpresora" value="<?php echo $all_parametro[0]['parametro_tipoimpresora']; ?>" />
<input type="hidden" name="parametro_segservicio" id="parametro_segservicio" value="<?php echo $all_parametro[0]['parametro_segservicio']; ?>" />
<input type="hidden" name="parametro_serviciofact" id="parametro_serviciofact" value="<?php echo $all_parametro[0]['parametro_serviciofact']; ?>" />
<input type="hidden" name="moneda_descripcion" id="moneda_descripcion" value="<?php echo $all_parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="all_usuario" id="all_usuario" value='<?php echo json_encode($all_usuario);  ?>' />
<input type="hidden" name="tipo_transaccion" id="tipo_transaccion" value='<?php echo json_encode($tipo_transaccion);  ?>' />
<input type="hidden" name="forma_pago" id="forma_pago" value='<?php echo json_encode($forma_pago);  ?>' />
<input type="hidden" name="permisomodificar" id="permisomodificar" value='<?php echo $rol[182-1]['rolusuario_asignado']; ?>' />
<input type="hidden" name="all_empresa" id="all_empresa" value='<?php echo json_encode($all_empresa); ?>' />
<input type="hidden" name="a" id="a" value='<?php echo $a; ?>' />
<input type="hidden" name="b" id="b" value='<?php echo $b; ?>' />
<input type="hidden" name="parametro_tiposistema" id="parametro_tiposistema" value="<?php echo $all_parametro[0]['parametro_tiposistema']; ?>" />

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
        <div class="box-header">
            <font size='4' face='Arial'><b>Servicios</b></font>
            <br><font size='2' face='Arial'>Registros Encontrados: <span id="regencontrados"></span></font>
            <?php if($b != "s") {?>
            <font style="padding-left: 20px" size="2" face="Arial" title="Ir a reporte de servicios"><a class="btn btn-facebook btn-xs" href="<?php echo site_url('reportes/servicioreportes') ?>">Reporte de Servicios</a></font>
            <font style="padding-left: 2px" size="2" face="Arial" title="Servicios pendientes y en proceso proximos a vencer"><a class="btn btn-facebook btn-xs" href="<?php echo site_url('servicio/reproximovencer') ?>">Servicios a Vencer</a></font>
            <?php }?>
        </div>
        <!--este es FIN del BREADCRUMB buscador-->
        <div class="col-md-8" style="padding-right: 0px">
            <?php if($b == "s") { $lectura ="readonly"; }else{ $lectura = ""; } ?>
        <!--este es INICIO de input buscador-->
        <div class="input-group">
            <span class="input-group-addon">Buscar</span>
            <input <?php echo $lectura; ?> id="filtrar" type="text" class="form-control" placeholder="Ingrese cliente, código, estado serv.." onkeypress="validar2(event,3)" autofocus autocomplete="off">
            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="fechadeservicio('', 1)"><span class="fa fa-search"></span></div>
        </div>
        </div>
        <?php if($b != "s") {?>
        <div class="col-md-4">
            <div  class="box-tools" >
                <select  class="btn btn-primary btn-sm form-control" name="select_servicio" id="select_servicio" onchange="buscar_servicioporfechas()">
                    <!--<option value="">- ELEGIR -</option>-->
                    <option value="6">Servicios Pendientes</option>
                    <option value="28">Servicios en Proceso</option>
                    <option value="66">Servicios Terminados</option>
                    <option value="7">Servicios Entregados</option>
                    <option value="44">Servicios Anulados</option>
                    <option value="1">Servicios de Hoy</option>
                    <option value="2">Servicios de Ayer</option>
                    <option value="3">Servicios de la semana</option>
                    <!--<option value="4">Todos los Servicios</option>-->
                    <option value="5">Servicios por fecha</option>
                </select>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php if($b != "s") {?>
    <!---------------- BOTONES --------->
    <div class="col-md-6 no-print text-center">
        <!--<div class="box-tools text-center" style="display: flex;">-->
            <!--<div class="col-md-1">-->
                <a style="width: 96px; margin-right: 1px; margin-top: 1px" class="col-md-1 btn btn-success btn-foursquarexs" href="<?php echo site_url('servicio/crearservicio'); ?>" title="Registrar un nuevo servicio" ><font size="5"><span class="fa fa-wrench"></span></font><br><small>Registrar Serv.</small></a>
            <!--</div>&nbsp;-->
            <?php
            if($rol[72-1]['rolusuario_asignado'] == 1){ ?>
            <!--<div style="width: 16.66%;">-->
            <!--<div class="col-md-1">-->
                <a style="width: 96px; margin-right: 1px; margin-top: 1px" class="col-md-1 btn btn-info btn-foursquarexs" onclick="fechadeservicio('')" title="Muestra todos los servicios" ><font size="5"><span class="fa fa-eye"></span></font><br><small>Ver Todos</small></a>
            <!--</div>&nbsp;-->
            <?php } ?>
            <!--<div class="col-sm-1" style="width: 100%;">-->
                <a style="width: 96px; margin-right: 1px; margin-top: 1px" class="col-md-1 btn btn-primary btn-foursquarexs" data-toggle="modal" data-target="#modalbuscar" title="Buscar servicios por su codigo" onclick="codigoservfocus()" ><font size="5"><span class="fa fa-search"></span></font><br><small>Buscar Serv.</small></a>
            <!--</div>&nbsp;-->
            <!--<div class="col-sm-1" style="width: 100%;">-->
                <a style="width: 96px; margin-right: 1px; margin-top: 1px" class="col-md-1 btn btn-soundcloud btn-foursquarexs" data-toggle="modal" data-target="#modalbuscardetalle" title="Buscar el historial de un determinado producto" onclick="kardexdetallefocus()"><font size="5"><span class="fa fa-binoculars"></span></font><br><small>Historial Prod.</small></a>
            <!--</div>&nbsp;-->
            <!--<div class="col-sm-1" style="width: 100%;">-->
                <a style="width: 96px; margin-right: 1px; margin-top: 1px" class="col-md-1 btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#modalbuscarkardexcli" title="Buscar el historial de un cliente" onclick="estefocus()" ><font size="5"><span class="fa fa-address-card-o"></span></font><br><small>Historial Cliente</small></a>
            <!--</div>&nbsp;-->
            <!--<div class="col-sm-1" style="width: 100%;">-->
                <a style="width: 96px;" class="col-md-1 btn btn-danger btn-foursquarexs" href="<?php echo base_url('servicio/repserviciodiario'); ?>" target="_blank" title="Muestra el movimiento economico diario"><font size="5"><span class="fa fa-print"></span></font><br><small>Reporte Diario</small></a>           
            <!--</div>-->
        <!--</div>-->
    </div>
    <!---------------- FIN BOTONES --------->
    <?php } ?>
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
                <select  class="btn btn-primary btn-sm form-control" id="buscarestado_id" name="buscarestado_id" required>
                    <option value="0">TODOS</option>
                    <?php foreach($all_estado as $estado){?>
                    <option value="<?php echo $estado['estado_id']; ?>"><?php echo $estado['estado_descripcion']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                Usuario:             
                <select  class="btn btn-primary btn-sm form-control" id="buscarusuario_id" name="buscarusuario_id" required>
                    <!--<option value="" disabled selected >-- USUARIOS --</option>-->
                    <option value="0">TODOS</option>
                    <?php foreach($all_usuario as $usuario){?>
                    <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <div class="col-md-2">
                <button class="btn btn-sm btn-soundcloud btn-sm btn-block form-control"  type="submit" onclick="buscar_por_fecha()" style="height: 34px;">
                    <span class="fa fa-search"></span> Buscar Servicios
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
                        <th>Total</th>
                        <th>A Cuenta</th>
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
if(isset($a) && $a == "n"){ ?>
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
                                              <label>Buscar Servicio por Código:</label>
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
          <label>Buscar Historial de Cliente:</label>
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
                <input type="text" name="buscarcliente" class="form-control text-uppercase" id="buscarcliente" placeholder="nombre, codigo, ci" required />
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
              <label>Buscar Historial de Producto:</label>
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
<!--<a style='width: 200px; margin-right: 1px; margin-top: 1px; background: #000; float: none' data-toggle='modal' data-target='#modalfactura' class='btn btn-facebook btn-xs' title='Generar Factura'><span class='fa fa-modx'></span> Generar factura</a>";-->
<!----------------- INICIO modal factura ---------------------------------------------->
<div class="modal fade" id="modalfactura" tabindex="-1" role="dialog" aria-labelledby="modalfactura">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <center>
                    <h4 class="modal-title" id="myModalLabel"><b>EMITIR FACTURA</b></h4>
                    <div class="row" id='loaderfactura'  style='display:none; text-align: center'>
                        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                    </div>
                </center>
                <?php
                
                if($all_parametro[0]['parametro_tiposistema'] == 1){
                ?>
                <br><b>NIT:</b><input type="text" id="generar_nit" value="0" class="form-control btn btn-xs btn-warning" style="text-align: left;">
                <br><b>RAZON SOCIAL:</b><input type="text" id="generar_razon" value="SIN NOMBRE" class="form-control btn btn-xs btn-warning" style="text-align: left;">
                <?php
                }else{
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <b>DOC. IDENTIDAD:</b>
                        <select name="doc_identidad" id="doc_identidad" class="form-control btn btn-xs btn-warning" style="text-align: left;" onchange="selecciono_el_documento()">
                            <?php
                            foreach($docs_identidad as $doc_ident){?>
                                <option value="<?=$doc_ident['cdi_codigoclasificador']?>"><?=$doc_ident['cdi_descripcion']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <b>NUMERO DE DOC.:</b>
                        <div class="input-group">
                            <input type="text" name="generar_nit" id="generar_nit" value="0" class="form-control btn btn-xs btn-warning" style="text-align: left;" onkeypress="validar_laentradaserv(event,1)" onclick="seleccionar_uncamposerv(1)" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" >
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="validar_laentradaserv(13,1)" title="Buscar por número de documento"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente"></span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>RAZON SOCIAL:</b>
                        <div class="input-group">
                            <input type="text" name="generar_razon" id="generar_razon" value="SIN NOMBRE" class="form-control btn btn-xs btn-warning" style="text-align: left;" onkeypress="validar_laentradaserv(event,9)" onchange="seleccionar_alcliente()" onclick="seleccionar_uncamposerv(2)">
                            <datalist id="listaclientes"></datalist>
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="validar_laentradaserv(13,9)" title="Buscar por Razon social"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente"></span></div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <b>CORREO ELECTRONICO:</b>
                            <input type="email" name="elemail" class="form-control btn btn-xs btn-warning" id="elemail" onclick="this.select()" onkeypress="validar(event,13)"/>
                    </div>
                    <div class="col-md-12" id='loader_generarfactura' style='display: none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                        </center>
                    </div>
                    <div hidden>                
                        <input type="checkbox" class="form-check-input" name="codigoexcepcion" id="codigoexcepcion"><label class="btn btn-default btn-xs" for="codigoexcepcion">Código Excepción</label>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="modal-body" style="padding-top: 0px">
                <div class="box-body table-responsive">
                   <!-- <b>DETALLE:</b><a onclick="mostrarocultarcampos()" class="btn btn-xs btn-info" title="Añadir detalle"><span class="fa fa-edit"></span></a>
                    <div id="mostrarocultar" style="padding-left: 0px; visibility:hidden; width: 0px; height: 0px">
                        <div class="col-md-2" style="padding-left: 0px; padding-right: 0px">
                            <label for="cantidad_id" class="control-label">CANT.</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="cantidad_id" class="form-control" id="cantidad_id" style="padding-left: 1px" />
                            </div>
                        </div>
                        <div class="col-md-5" style="padding-left: 0px; padding-right: 0px">
                            <label for="descripcion" class="control-label">DESCRIPCION</label>
                            <div class="form-group">
                                <input type="text" name="descripcion" class="form-control" id="descripcion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-left: 0px; padding-right: 0px">
                            <label for="precio_unitario" class="control-label">P. UNIT.</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="precio_unitario" class="form-control" id="precio_unitario" style="padding-left: 1px" />
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-left: 0px; padding-right: 0px">
                            <label for="precio_subtotal" class="control-label">TOT.</label>
                            <div class="form-group">
                                <input type="text" readonly name="precio_subtotal" class="form-control" id="precio_subtotal" style="padding-left: 1px" />
                            </div>
                        </div>
                        <div class="col-md-1" style="padding-left: 0px; padding-right: 0px">
                            <label for="boton_aniadir" class="control-label">&nbsp;</label>
                            <div class="form-group" style="padding-top: 6px">
                                <span id="botonaniadir"></span>
                            </div>
                        </div>
                    </div>-->
                    <div id="generar_detalle" name="generar_detalle"></div>
                    <div class="col-md-6">
                        <label for="usuario_idx" class="control-label">TOTAL Bs</label>
                        <input type="text" id="generar_venta_id" value="0.00" hidden >
                        <input type="text" id="generar_monto" value="0.00" class="form-control btn btn-xs btn-default" style="text-align: left;" readonly>
                    </div>
                    <div class="col-md-6" id='botones'  style='display:block;'>
                        <label for="opciones" class="control-label">Opciones</label>
                        <div class="form-group">
                            <span id="registrar_factura"></span>
                            <button class="btn btn-danger" id="cancelar_preferencia" data-dismiss="modal" >
                                <span class="fa fa-close"></span>   Cancelar                                                          
                            </button>
                        </div>
                    </div>
                    <!--------------------- inicio loader ------------------------->
                    <div class="col-md-6" id='loaderinventario'  style='display: none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                        </center>
                    </div> 
                    <!--------------------- fin inicio loader ------------------------->
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------- FIN modal factura ---------------------------------------------->
<!------------------------ INICIO modal para Modificar fecha de una venta ------------------->
<div class="modal fade" id="modalenviarmensaje" tabindex="-1" role="dialog" aria-labelledby="modalenviarmensajelabel" style="font-family: Arial">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold" style="font-size: 13pt"><span class="fa fa-whatsapp fa-4x"></span>ENVIAR MENSAJE AL CLIENTE</span><br>
                <span style="font-size: 11pt">del Servicio Num.: <span class="text-bold" id="num_serv"></span></span>
                <!--<input type="hidden" name="nunmventa_id" class="form-control" id="nunmventa_id" />-->
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <span id="cliente" hidden></span>
                <span id="telefono" hidden></span>
                <span id="texto" hidden></span>
                <!--<div class="col-md-6">
                    <label for="el_mensaje" class="control-label"><span class="fa fa-whatsapp"></span></label>
                    <span>Enviar mensaje al cliente</span>
                </div>-->
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <a class="btn btn-success" onclick="enviar_mensaje()"><span class="fa fa-check"></span> Enviar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Omitir</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Modificar fecha de una venta ------------------->


<!------------------------ INICIO modal para registrar PAGO A CUENTA ------------------->
<div style='white-space: normal !important;' class='modal fade' id='modalregistraracuenta' tabindex='-1' role='dialog' aria-labelledby='modalregistraracuentaLabel'>
    <div class='modal-dialog' role='document'>
        <br><br>
        <div class='modal-content'>
            <div class='modal-header text-center' style='font-size:12pt;'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>
                
                <span id="servicio_pago_cuenta" style="font-weight: 900;"></span>
                <br><span id="servicio_detalle" style='font-size: 10px; font-weight: 600'></span>
            </div>
            <!------------------------------------------------------------------->
            <div class='modal-body'>
                <div class="row">
                    <span id='mensajeregistrarserterminado' class='text-danger'></span>
                    <div class='text-center'>
                        <span id="servicio_cliente" style='font-size: 12pt; font-weight: 900;'></span>
                        <br>
                        <span id="info_cliente" style="font-weight: 600;"></span>
                    </div>
                    <div class='col-md-6'>
                        <label for='fecha_acuenta' class='control-label'>Fecha:</label>
                        <div class='form-group'>
                            <input type='datetime-local' class='form-control' name='fecha_acuenta' id='fecha_acuenta' value='' />
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <label for='monto_total' class='control-label'>Total(Bs.):</label>
                        <div class='form-group'>
                            <input type='number' step='any' min='0' class='form-control' name='monto_total' id='monto_total' value='' placeholder='0.00'/>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <label for='monto_acuenta' class='control-label'>A cuenta(Bs.):</label>
                        <div class='form-group'>
                            <input type='number' step='any' min='0' class='form-control' name='monto_acuenta' id='monto_acuenta' value='' placeholder='0.00'/>
                            <input type='hidden' class='form-control' name='servicio_id' id='acuenta_servicio_id'/>
                            <input type='hidden' class='form-control' name='detalleserv_id' id='acuenta_detalleserv_id'/>
                        </div>
                    </div>
                </div>
            </div>
        <!-- <br> -->
            <div class='modal-footer'>
                <div class='text-center' style='text-align: center !important;'>
                    <!-- <button class='btn btn-success' onclick='registrarservicio_pagoacuenta("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' title='Registrar pago a cuenta de un servicio'><span class='fa fa-wrench'></span> Registrar</button> -->
                    <button class='btn btn-success' onclick='registrarservicio_pagoacuenta()' title='Registrar pago a cuenta de un servicio'>
                        <span class='fa fa-wrench'></span> Registrar</button>
                    <a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>
                </div>
            </div>
        </div>

        <!------------------------------------------------------------------->
    </div>
    <!-- </div> -->
</div>
<!------------------------ FIN modal para registrar PAGO A CUENTA ------------------->