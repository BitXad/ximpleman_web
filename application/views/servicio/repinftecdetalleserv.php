<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_servicio.js'); ?>" type="text/javascript"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

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
    #alinear{ text-align: right; }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitabladetalleimpresion.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header no-print">
    <h3 class="box-title"><b>Informe Técnico de Detalles de Servicios</b></h3><br>
</div>
<!-- *******************************INICIO Buscador por fechas************************************ -->
<div class="no-print">
<div class="col-md-6">
    <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Ingrese cliente, código, estado serv.." onkeypress="validar2(event,3)">
    </div>
</div>
<div class="container" id="categoria">
                <span class="badge btn-primary">Servicios encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="encontrados" type="text" value="0" readonly="true"> </span></span>
</div>
      <!-------------------- CATEGORIAS------------------------------------->
<div class="col-md-6">
    <div  class="box-tools" >
        <select  class="btn btn-primary btn-sm" id="select_servicio" onchange="buscar_servicioporfechas()">
            <!--<option value="">- ELEGIR -</option>-->
            <option value="6">Servicios Pendientes</option>
            <option value="1">Servicios de Hoy</option>
            <option value="2">Servicios de Ayer</option>
            <option value="3">Servicios de la semana</option>
            <!-- <option value="4">Todos los Servicios</option> -->
            <option value="5">Servicios por fecha</option>
        </select>
  </div>
</div>
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
<div class="container" id="categoria">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-primary">Servicios encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontradosfecha" type="text" value="0" readonly="true"> </span></span>

</div>
</div>
<!-- *******************************F I N  Buscador por fechas************************************ -->
<div class="row no-print">
    <div class="col-md-12">
       
        
        
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>N°</th>
                                                <th>Cliente</th>
                                                <th>Codigo</th>
                                                <th>Fechas</th>
						<th>Estado</th>
						<th>Tipo Servicio</th>
						
						<th>Registrado por </th>
						
						<th>Total</th>
						<th>Acuenta</th>
						<th>Saldo</th>
						<th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php $i =1; $cont = 0;
                          foreach($servicio as $s){ $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $s['cliente_nombre']; ?></td>
                        <td><?php echo $s['servicio_id']; ?></td>
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
                            <a href="<?php echo site_url('servicio/boletainftecservicio/'.$s['servicio_id']); ?>" class="btn btn-success btn-xs" target="_blank" title="Imprimir Informe Técnico"><span class="fa fa-print"></span></a> 
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
<?php
   /* if(isset($a)){ ?>
        <script type="text/javascript">
        alert('No Existe ese servicio')
</script> 
<?php
    }*/
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