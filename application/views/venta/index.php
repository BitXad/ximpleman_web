<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function() {
        buscar_ventas()
  //funciones a ejecutar
    };
    
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
    $(document).ready(function(){
        $("#precio_unitario").change(function(){
            var cantidad = $("#cantidad_id").val();
            var precio = $("#precio_unitario").val();
            var res = 0;
            res = cantidad * precio;
            $('#precio_subtotal').val(res);
        });
  });
  
</script>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->    
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<input type="hidden" id="resventa" name="resventa">
<input type="text" id="parametro_modoventas" value="<?php echo $parametro[0]['parametro_modoventas']; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro[0]['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro[0]['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro[0]['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro[0]['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro[0]['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro[0]['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro[0]['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>
<input type="text" id="parametro_datosboton" value="<?php echo $parametro[0]['parametro_datosboton']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" name="parametro_moneda_id"  hidden>
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" name="parametro_moneda_descripcion"  hidden>

<input type="text" id="rol_precioventa" value="<?php echo $rolusuario[160-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor" value="<?php echo $rolusuario[161-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor1" value="<?php echo $rolusuario[162-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor2" value="<?php echo $rolusuario[163-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor3" value="<?php echo $rolusuario[164-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor4" value="<?php echo $rolusuario[165-1]['rolusuario_asignado']; ?>" hidden>
<input type="hidden" id="certif_garantia" value="<?php echo $rolusuario[184-1]['rolusuario_asignado']; ?>" name="certif_garantia">
<input type="hidden" id="dosificado" value="<?php echo $dosificado; ?>" name="dosificado">
<input type="hidden" id="generar_factura" value="<?php echo $rolusuario[187-1]['rolusuario_asignado']; ?>" name="generar_factura">
<input type="hidden" id="modif_fhora" value="<?php echo $rolusuario[188-1]['rolusuario_asignado']; ?>" name="modif_fhora">
<input type="text" id="moneda_tc" value="<?php echo $moneda['moneda_tc']; ?>" hidden>
<input type="text" id="moneda_descripcion" value="<?php echo $moneda['moneda_descripcion']; ?>" hidden>

<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="hidden" name="all_usuario" id="all_usuario" value='<?php echo json_encode($usuario); ?>' />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value='<?php echo $tipousuario_id; ?>' />
<input type="text" value="" id="parametro" hidden>

<input type="text" id="moneda_tc" value="<?php echo $moneda['moneda_tc']; ?>" hidden>
<input type="text" id="moneda_descripcion" value="<?php echo $moneda['moneda_descripcion']; ?>" hidden>


<div class="box-header no-print">
<h3 class="box-title">Ventas</h3>
            	<div class="box-tools">                    
                    <?php if($rolusuario[23-1]['rolusuario_asignado'] == 1){ ?>
                    <select  class="btn btn-facebook btn-sm" id="select_ventas" onchange="buscar_ventas()">
<!--                        <option value="1">-- SELECCIONE UNA OPCION --</option>-->
                        <option value="1">Ventas de Hoy</option>
                        <option value="2">Ventas de Ayer</option>
                        <option value="3">Ventas de la semana</option>
                        <option value="4">Todos las ventas</option>
                        <option value="5">Ventas por fecha</option>
                    </select>
                    <?php } ?>
                    <button class="btn btn-warning btn-sm" onclick="verificar_ventas()"><span class="fa fa-binoculars"></span> Verificar </button>
                    <a href="<?php echo site_url('venta/ventas'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Ventas</a>
                    <?php if($rolusuario[186-1]['rolusuario_asignado'] == 1){ ?>
                    <a class="btn btn-success btn-sm" onclick="imprimirtodo()" title="Imprime todas la ventas" style="background-color: #761c19"><span class="fa fa-print"></span> Imprimir</a>
                    <?php } ?>
                </div>
</div>
<!---------------------------------- panel oculto para busqueda--------------------------------------------------------->
<!--<form method="post">-->
<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='display:none;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>
        
        <div class="col-md-2">
            Tipo:             
            <select  class="btn btn-warning btn-sm form-control" id="estado_id" required="true">
                <?php foreach($estado as $es){?>
                    <option value="<?php echo $es['estado_id']; ?>"><?php echo $es['estado_descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-md-2">
            Usuario:             
            <select  class="btn btn-warning btn-sm form-control" id="usuario_id">
                    <option value="0">-- TODOS --</option>
                <?php foreach($usuario as $us){?>
                    <option value="<?php echo $us['usuario_id']; ?>"><?php echo $us['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <br>
        <div class="col-md-3">

            <button class="btn btn-sm btn-facebook btn-sm btn-block"   onclick="ventas_por_fecha()">
                <h4>
                <span class="fa fa-search"></span>   Buscar
                </h4>
            </button>
            
            <br>
        </div>
        
    </center>    
    <br>    
</div>
<!--</form>-->
<!------------------------------------------------------------------------------------------->

  

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
            <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" onkeypress="validar(event,10)" class="form-control" placeholder="Ingrese usuario, cliente, fecha">
            </div>
        <!--------------------- fin parametro de buscador --------------------->
            
<!--------------------- inicio loader ------------------------->
<div class="row" id='oculto' style='display:block;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
    </center>
</div> 

<div class="row" id='oculto2' style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
    </center>
</div> 
<!--------------------- fin inicio loader ------------------------->
            
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Cliente</th>
						<th>Totales</th>						
						<th>Trans.</th>
						<th>Tipo</th>
						<th>Fecha</th>
						<th></th>

                    </tr>

                    <tbody class="buscar" id="tabla_ventas">

                    </tbody>
                </table>
<!--                <div class="pull-right">
                    
                    
                </div>                -->
            </div>
        </div>
    </div>
</div>


<!----------------- modal Detalle ---------------------------------------------->

<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>Asignar Detalle</b></h4>
                                <b>ADVERTENCIA: El Detalle actual, remplazara algun invenario asignado previamente.</b>                                
                            </center>

                                
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        

                    
                        
                        <div class="box-body table-responsive">
                                        <div class="col-md-6">
						<label for="usuario_idx" class="control-label">Prevendedor</label>
						<div class="form-group">
							<select name="usuario_idx" id="usuario_idx" class="form-control">
								<option value="0">- ASIGNAR PREVENDEDOR -</option>
								<?php 
								foreach($usuario as $usuario_prev)
								{
									$selected = ($usuario_prev['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario_prev['usuario_id'].'" '.$selected.'>'.$usuario_prev['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-6" id='botones'  style='display:block;'>
						<label for="opciones" class="control-label">Opciones</label>
						<div class="form-group">
                                                        
                                                    <button class="btn btn-facebook" id="boton_asignar" onclick="asignar_Detalle()"> <span class="fa fa-truck"></span> Asignar</button>
                                                    
                                                    <button class="btn btn-danger" id="cerrar_modalasignar" data-dismiss="modal">
                                                        
                                                        <span class="fa fa-close"></span>   Cancelar  
                                                        
                                                    </button>
						</div>
					</div>
                            
                                        <!--------------------- inicio loader ------------------------->
                                        <div class="col-md-6" id='loaderDetalle'  style='display:none;'>
                                            <center>
                                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                            </center>
                                        </div> 
                                        <!--------------------- fin inicio loader ------------------------->
                            
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>


<!----------------- fin modal Detalle ---------------------------------------------->




<div hidden>
    
<button type="button" id="boton_modal_factura" class="btn btn-primary" data-toggle="modal" data-target="#modalfactura" >
    modal factura
</button>
</div>
<!----------------- modal factura ---------------------------------------------->

<div class="modal fade" id="modalfactura" tabindex="-1" role="dialog" aria-labelledby="modalfactura">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>EMITIR FACTURA</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                  
                            </center>
                        
                            
                            <div class="row">
                                <div class="col">
                                    <div class="col-md-4">
                                    <b>NIT:</b><input type="text" id="generar_nit" value="0" class="form-control btn btn-xs btn-warning" style="text-align: left;">

                                    </div>
                                    <div class="col-md-8">
                                    <b>RAZON SOCIAL:</b><input type="text" id="generar_razon" value="SIN NOMBRE" class="form-control btn btn-xs btn-warning" style="text-align: left;">

                                    </div>
                                </div>
                            </div>

                            
                    </div>
                    <div class="modal-body" style="padding-top: 0px; font-family: Arial;">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive" style="font-family: Arial;">
                            
                            <b>DETALLE:</b><a onclick="mostrarocultarcampos()" class="btn btn-xs btn-info" title="Añadir item al detalle"><span class="fa fa-edit"></span> Añadir Item</a>
                            
                            <div id="mostrarocultar" style="padding-left: 0px; visibility:hidden; width: 0px; height: 0px;  ">
                                <div class="col-md-2" style="padding-left: 0px; padding-right: 0px">
                                    <label for="cantidad_id" class="control-label">CANT.</label>
                                    <div class="form-group">
                                        <input type="number" step="any" min="0" name="cantidad_id" class="form-control" id="cantidad_id" style="padding-left: 1px" />
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-left: 0px; padding-right: 0px">
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
                                    <label for="precio_subtotal" class="control-label">TOTAL</label>
                                    <div class="form-group">
                                        <input type="text" readonly name="precio_subtotal" class="form-control" id="precio_subtotal" style="padding-left: 1px" />
                                    </div>
                                </div>
                                <div class="col-md-2" style="padding-left: 0px; padding-right: 0px">
                                    <label for="boton_aniadir" class="control-label">&nbsp;</label>
                                    <div class="form-group" style="padding-top: 6px">
                                        <span id="botonaniadir"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" id="generar_detalle" name="generar_detalle"></div>
                            <!--<input type="text" id="generar_detalle" value="-" class="form-control btn btn-xs btn-default" style="text-align: left;">-->
       
                            <div class="col-md-4">
                                <label for="usuario_idx" class="control-label">TOTAL Bs</label>

                                <input type="text" id="generar_venta_id" value="0.00" hidden >
                                <input type="text" id="generar_monto" value="0.00" class="form-control btn btn-xs btn-default" style="text-align: right; font-weight: bold; font-size: 15pt;">
                            </div>
                                
                            <div class="col-md-4" id='botones'  style='display:block;'>
                                    <!--<label for="opciones" class="control-label"></label>-->
                                    <div class="form-group">
                                        <span id="registrar_factura"></span>                                        
                                    </div>
                            </div>
                                
                            <div class="col-md-4" id='botones'  style='display:block;'>
                                    <!--<label for="opciones" class="control-label"></label>-->
                                    <div class="form-group">
                                        
                                        <button class="btn btn-danger btn-block" id="cancelar_preferencia" data-dismiss="modal" >
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

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>
<!----------------- fin modal factura ---------------------------------------------->

<!------------------------ INICIO modal para Modificar fecha de una venta ------------------->
<div class="modal fade" id="modalmodificarhora" tabindex="-1" role="dialog" aria-labelledby="modalmodificarhoralabel" style="font-family: Arial">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold" style="font-size: 13pt">MODIFICAR FECHA DE LA VENTA</span><br>
                <span style="font-size: 11pt">Venta Num.: <span class="text-bold" id="num_venta"></span></span>
                <input type="hidden" name="nunmventa_id" class="form-control" id="nunmventa_id" />
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <div class="col-md-6">
                    <label for="modif_fecha" class="control-label">Modificar Fecha</label>
                    <div class="form-group">
                        <input type="date" name="modif_fecha" class="form-control" id="modif_fecha" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="modif_hora" class="control-label">Modificar hora</label>
                    <div class="form-group">
                        <input type="time" name="modif_hora" class="form-control" id="modif_hora" />
                    </div>
                </div>
                <!------------------------------------------------------------------->
                <div class="col-md-12 no-print" id="tablarecliente"></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <a class="btn btn-success" data-dismiss="modal" onclick="guardar_fechahora()"><span class="fa fa-check"></span> Guardar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>

<!------------------------ INICIO modal para Modificar fecha de una venta ------------------->



<div class="modal fade" id="modal_contratos" tabindex="-1" role="dialog" aria-labelledby="modal_contratos" style="font-family: Arial">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold" style="font-size: 13pt">CONTRATOS</span><br>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <?php foreach ($modelos_c as $mc){?>
                    <input type="hidden" id="modcontrato_id_contrato<?= $mc['modcontrato_id'] ?>" value="<?= $mc['modcontrato_id'] ?>">
                    <button class="btn btn-md btn-primary" target="_blanck" onclick="ir_contrato(<?= $mc['modcontrato_id'] ?>)"><?= $mc['modcontrato_nombre'] ?></button><br>
                <?php }?>
                <input type="hidden" id="venta_id_contrato">
                <br>
            </div>
        </div>
    </div>
</div>

<script>
    function ir_contrato(contrato_id){
        let contrato = $(`#modcontrato_id_contrato${contrato_id}`).val()
        let venta = $('#venta_id_contrato').val()
        let base_url = $('#base_url').val()
        window.location.href = `${base_url}modelo_contrato/generar_contrato/${venta}/${contrato}`;
    }
</script>
<!------------------------ FIN modal para Modificar fecha de una venta ------------------->
