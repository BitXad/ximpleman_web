<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones_servicio.js'); ?>" type="text/javascript"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar3').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar3 tr').hide();
                    $('.buscar3 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>
<style type="text/css">
    .cantidad input {
        width: 10px;
    }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title">Insumos Usados en el Detalle de Servicio (Codigo: <?php echo ''.$detalleserv_codigo.')';  ?></h3>
    <div class="box-tools">
        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalelegirinsumo" >+ Usar Insumos</a>
        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalotroinsumo" >+ Usar Insumo(N A)</a>
    </div>
</div>
<div class="row">    
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar3" type="text" class="form-control" placeholder="Ingrese descripción, código">
          </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
						<th>Descripción</th>
						<th>Código</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Obs.</th>
						<th></th>
                    </tr>
                    <tbody class="buscar3">
                    <?php $cont = 0;
                          $categoria = "";
                          foreach($insumos_usados as $c){
                              $cont = $cont+1;
                              
                              ?>
                    <tr>
                        <td><?php echo $cont; ?></td>
                        <td><font size="3"><b><?php echo $c['producto_nombre']; ?></b></font>
                                        <br><?php echo $c['detalleven_unidad']; ?> | <?php echo $c['producto_marca']; ?> | <?php echo $c['producto_industria']; ?>
                        </td>
                        <td><font size="3"><b><?php echo $c['detalleven_codigo']; ?></b></font>
                            <br><?php echo $c['producto_codigobarra']; ?>                                                
                        </td>
                        <td><?php echo $c['detalleven_cantidad']; ?>
                        </td>
                        <td><?php echo $c['detalleven_total']; ?>
                        </td>
                        <td><?php echo $c['detalleven_caracteristicas']; ?>
                        </td>
			<td>
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modaleliminar<?php echo $cont; ?>" ><span class="fa fa-trash"></span><br></a>
                            
                        </td>
            
                               <!------------------------ INICIO modal para ELIMINAR INSUMO ------------------->
                                    <div class="modal fade" id="modaleliminar<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php //echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b><span class="fa fa-trash"></span></b>
                                               ¿Esta seguro que quiere quitar este Insumo asignado?
                                            </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('categoria_insumo/eliminardetalleventa/'.$servicio_id.'/'.$detalleserv_id.'/'.$c['detalleven_id']); ?>" class="btn btn-success"><span class="fa fa-pencil"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
            <!-------------------------------------------------- FIN modal para ELIMINAR INSUMO --------------------------------------->
            
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>              
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
        <a href="<?php echo site_url('servicio/serview/'.$servicio_id); ?>" class="btn btn-danger">
                <i class="fa fa-arrow-left"></i> Atras</a>
    </div>
</div>


<script type="text/javascript">
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
</script>
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
<!--------------------------------- INICIO MODAL MOSTRAR INSUMOS SELECCIONADOS ------------------------------------>
<div class="modal fade" id="modalelegirinsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar2" type="text" class="form-control" placeholder="Ingresa el nombre, codigo del Prod...">
      </div>
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla" >
                            <tr>
                                <th>Nº</th>
                                <th>Descripción</th>
                                <th>Código</th>
                                <th>Saldo</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                            <tbody class="buscar2">
                            <?php $i=1;
                            foreach($categoria_mis_insumos as $p){ ?>
                                <tr>
                                    <?php echo form_open('categoria_insumo/usarinsumo/'.$servicio_id.'/'.$detalleserv_id);?>
                                    <td><?php echo $i++; ?></td>
                                    <td><font size="3"><b><?php echo $p['producto_nombre']; ?></b></font>
                                                    <br><?php echo $p['producto_unidad']; ?> | <?php echo $p['producto_marca']; ?> | <?php echo $p['producto_industria']; ?>
                                    </td>
                                    <td><font size="3"><b><?php echo $p['producto_codigo']; ?></b></font>
                                        <br><?php echo $p['producto_codigobarra']; echo "<br>".$p['producto_costo']; ?>
                                    </td>
                                    <td> 
                                        <center>                    
                                            <font size="3"><b><?php echo number_format($p['existencia'],2,'.',','); ?></b></font>
                                        </center>
                                    </td>
                                    <td><?php echo $p['producto_precio']; echo "(".$p['producto_unidad'].")" ?><br>Total:<br>
                                        <script>
                                            $(document).ready(function(){
                                            $('#cantidad<?php echo $p["producto_id"]; ?>').change(function(){
                                                var prec =   <?php echo $p['producto_precio']; ?>;
                                                var cant = $('#cantidad<?php echo $p['producto_id']; ?>').val();
                                                var res = prec* cant;
                                                $("#precio<?php echo $p['producto_id'] ?>").html(res);
                                          });
                                          });
    
                                        </script>
                                        <label id="precio<?php echo $p['producto_id']; ?>"><?php if($p['existencia'] == 0){ echo 0;}else{ echo $p['producto_precio'];} ?></label>
                                    </td>
                                    <td><label>Cantidad a Usar:</label>
                                        <input name="cantidad<?php echo $p['producto_id']; ?>" type="number" step="any" min="0" max="<?php echo $p['existencia']; ?>" id="cantidad<?php echo $p['producto_id']; ?>" value="<?php if($p['existencia'] == 0){ echo 0;}else{ echo 1;} ?>" style="text-align: right; width: 75px;" />
                                        <label>Caracteristicas:</label>
                                        <textarea name="caracteristicas" id="caracteristicas" class="form-control"></textarea>
                                    <br>
                                    <input type="hidden" id="producto_tipocambio"  name="producto_tipocambio" class="form-control" value="<?php echo $p['producto_tipocambio']; ?>" />
                                    <input type="hidden" id="producto_comision"  name="producto_comision" class="form-control" value="<?php echo $p['producto_comision']; ?>" />
                                    <input type="hidden" id="producto_precio"  name="producto_precio" class="form-control" value="<?php echo $p['producto_precio']; ?>" />
                                    <input type="hidden" id="producto_costo"  name="producto_costo" class="form-control" value="<?php echo $p['producto_costo']; ?>" />
                                    <input type="hidden" id="producto_unidad"  name="producto_unidad" class="form-control" value="<?php echo $p['producto_unidad']; ?>" />
                                    <input type="hidden" id="producto_codigo"  name="producto_codigo" class="form-control" value="<?php echo $p['producto_codigo']; ?>" />
                                    <input type="hidden" id="moneda_id"  name="moneda_id" class="form-control" value="<?php echo $p['moneda_id']; ?>" />
                                    <input type="hidden" id="producto_id"  name="producto_id" class="form-control" value="<?php echo $p['producto_id']; ?>" />
                                    <?php if($p['existencia'] ==0){ $disabled = "disabled"; }else{$disabled = ""; } ?>
                                    <button type="submit" class="btn btn-success btn-xs" <?php echo $disabled; ?> >
                                        <i class="fa fa-check"></i> Usar Insumo
                                    </button>
                                </td>
                                 <?php echo form_close(); ?>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
<!--------------------------------- FIN MODAL MOSTRAR INSUMOS SELECCIONADOS ------------------------------------>

<!--------------------------------- INICIO MODAL MOSTRAR INSUMOS NO SELECCIONADOS ------------------------------------>
<div class="modal fade" id="modalotroinsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Buscar</h4>
                            <!--este es INICIO de input buscador-->
                            <div class="input-group">
                                <span class="input-group-addon"> 
                                    Buscar 
                                </span>           
                                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código del Insumo" onkeypress="tablaresultadosinsumo(event, <?php echo $servicio_id; ?>, <?php echo $detalleserv_id; ?>)">
                            </div>
                            <!--este es FIN de input buscador-->
                            <div class="container" id="categoria">
                                <span class="badge btn-danger">Insumos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
                            </div>
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla" >
                            <tr>
                                <th>Nº</th>
                                <th>Descripción</th>
                                <th>Código</th>
                                <th>Saldo</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                            <tbody class="buscar" id="tablaresultados">
                                <!-- va a este lugar despues de generarse con el buscador  -->
                             <?php //echo form_open('categoria_insumo/usarinsumo/'.$servicio_id.'/'.$detalleserv_id);?>
                            </tbody>
                        </table>
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
<!--------------------------------- FIN MODAL MOSTRAR INSUMOS NO SELECCIONADOS ------------------------------------>
