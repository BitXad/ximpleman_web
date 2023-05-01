<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/funciones.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/emision_paquetes.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones_ventaifactura.js'); ?>" type="text/javascript"></script>
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
<input type="text" id="parametro_modoventas" value="<?php echo $parametro['parametro_modoventas']; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="parametro_decimales"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>
<input type="text" id="parametro_datosboton" value="<?php echo $parametro['parametro_datosboton']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro['moneda_id']; ?>" name="parametro_moneda_id"  hidden>
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro['moneda_descripcion']; ?>" name="parametro_moneda_descripcion"  hidden>
<input type="text" id="parametro_tiposistema" value="<?php echo $parametro['parametro_tiposistema']; ?>" name="parametro_tiposistema"  hidden>
<input type="text" id="parametro_tipoemision" value="<?php echo $parametro['parametro_tipoemision']; ?>" name="parametro_tipoemision"  hidden>

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
<input type="text" id="docsec_codigoclasificador" value="<?php echo $dosificacion['docsec_codigoclasificador']; ?>" name="docsec_codigoclasificador"  hidden>
<input type="text" id="dosificacion_documentosector" value="<?php echo $dosificacion['dosificacion_documentosector']; ?>" name="dosificacion_documentosector"  hidden>


<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="hidden" name="all_usuario" id="all_usuario" value='<?php echo json_encode($usuario); ?>' />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value='<?php echo $tipousuario_id; ?>' />
<input type="text" value="" id="parametro" hidden>

<input type="text" id="moneda_tc" value="<?php echo $moneda['moneda_tc']; ?>" hidden>
<input type="text" id="moneda_descripcion" value="<?php echo $moneda['moneda_descripcion']; ?>" hidden>

<input type="text" id="parametro_factura" value="<?php echo $parametro['parametro_factura']; ?>" name="parametro_factura"  hidden>

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
                    <?php if($rolusuario[186-1]['rolusuario_asignado'] == 1){    ?>
                    <a class="btn btn-success btn-sm" onclick="imprimirtodo()" title="Imprime todas la ventas" style="background-color: #761c19"><span class="fa fa-print"></span> Imprimir</a>
                    <a href="<?php echo base_url("eventos_significativos"); ?>" class="btn btn-success btn-sm" title="Registro de eventos significativos" style="background-color: #8BC34A" target="_BLANK"><span class="fa fa-print"></span> Eventos Significativos</a>
                    <?php } ?>
                    <?php if($parametro['parametro_tiposistema']!= 1){    ?>
                    <a href="<?php echo base_url("envio_contingencias"); ?>" class="btn btn-danger btn-sm" title="Enviar Facturas por Contingencia" target="_BLANK"><span class="fa fa-compress"></span> Facturas no enviadas</a>
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
                                <!--<div class="">-->
                                    <div class="col-md-6">
                                        <b>DOC. IDENTIDAD:</b>
                                        <select name="doc_identidad" id="doc_identidad" class="form-control btn btn-xs btn-warning" style="text-align: left;" onchange="selecciono_eldocumento()">
                                            <!--<option value="">--DOC. IDENTIDAD--</option>-->
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
                                            <input type="text" name="generar_nit" id="generar_nit" value="0" class="form-control btn btn-xs btn-warning" style="text-align: left;" onkeypress="validar_laentrada(event,1)" onclick="seleccionar_uncampo(1)">
                                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="validar_laentrada(13,1)" title="Buscar por número de documento"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>RAZON SOCIAL:</b>
                                        <div class="input-group">
                                            <input type="text" name="generar_razon" id="generar_razon" value="SIN NOMBRE" class="form-control btn btn-xs btn-warning" style="text-align: left;" onkeypress="validar_laentrada(event,9)" onchange="seleccionar_alcliente()" onclick="seleccionar_uncampo(2)">
                                            <datalist id="listaclientes"></datalist>
                                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="validar_laentrada(13,9)" title="Buscar por Razon social"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente"></span></div>
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
                                    
                                <!--</div>-->
                            </div>

                            
                    </div>
                    <div class="modal-body" style="padding-top: 0px; font-family: Arial;">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive" style="font-family: Arial;">
                            
                            <b>DETALLE:</b>
                            <?php
                            if($parametro["parametro_tiposistema"] == 1){
                            ?>
                            <a onclick="mostrarocultarcampos()" class="btn btn-xs btn-info" title="Añadir item al detalle"><span class="fa fa-edit"></span> Añadir Item</a>
                            <?php
                            }
                            ?>
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
                    <button class="btn btn-md btn-primary btn-block" target="_blanck" onclick="ir_contrato(<?= $mc['modcontrato_id'] ?>)"><?= $mc['modcontrato_nombre'] ?></button><br>
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
        // window.location.href = `${base_url}modelo_contrato/generar_contrato/${venta}/${contrato}`;
        window.open(`${base_url}modelo_contrato/generar_contrato/${venta}/${contrato}`, '_blank');
    }
</script>
<!------------------------ FIN modal para Modificar fecha de una venta ------------------->


<!------------------------------------------------------------------------------->
<!----------------------- EMISION DE PAQUETES ----------------------------------->
<!------------------------------------------------------------------------------->

<div class="modal fade" id="modalpaquetes" tabindex="-1" role="dialog" aria-labelledby="modalpaquetes" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">SOLICITUD SERVICIO RECEPCION PAQUETE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="row" id='loader2'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    <label for="codigo_evento" class="control-label"><span class="text-danger">*</span>Código Evento</label>
<!--                    <div class="form-group">
                        <input type="text" name="codigo_evento" class="form-control" id="codigo_evento" />
                    </div>
                    -->
                    <select name="codigo_evento" class="form-control" id="codigo_evento" >
                        <?php 
                            foreach($eventos as $evento){ ?>
                                <option value="<?php echo $evento['registroeventos_codigo']; ?>">    
                                    <?php echo $evento['registroeventos_codigo']." [".$evento['registroeventos_puntodeventa']."] ".$evento['registroeventos_detalle']." ".$evento['registroeventos_inicio']; ?>
                                </option>
                        <?php    } ?>
                            
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Nombre Archivo</label>
                    <div class="form-group">
                        <input type="text" name="nombre_archivo" value="compra_venta00.tar.gz" class="form-control" id="nombre_archivo" />
                        <input type="hidden" name="lafactura_id" value="" class="form-control" id="lafactura_id" />
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="emision_paquetes()"><fa class="fa fa-floppy-o"></fa> Enviar Paquete(s)</button>
                <button type="button" class="btn btn-danger" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="modalvalidacion" tabindex="-1" role="dialog" aria-labelledby="modalvalidacion" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">SOLICITUD SERVICIO VALIDACION RECEPCION PAQUETE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader3' style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                
                <div class="col-md-12">
                    <label for="codigo_recepcion" class="control-label"><span class="text-danger">*</span>Codigo Recepción</label>
                    <div class="form-group">
                        
                        <input type="text" name="factura_id" class="form-control" id="factura_id" />
                        <input type="text" name="codigo_recepcion" class="form-control" id="codigo_recepcion" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-facebook" onclick="emisionpaquetes_vacio()"><fa class="fa fa-floppy-o"></fa> Validación de Paquetes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!------------------------ INICIO modal para envio de facturas a correos ------------------->
<div class="modal fade" id="modal_enviofactura" tabindex="-1" role="dialog" aria-labelledby="modal_enviofacturalabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">ENVIAR FACTURA POR CORREO</span>
            </div>
            <div class="modal-body">
                
              <div class="col-md-12">
                    <label for="elcorreo" class="control-label"><span class="text-danger">*</span>Correo</label>
                    <div class="form-group">
                        <input type="email" name="elcorreo" class="form-control" id="elcorreo" />
                        <input type="hidden" name="lafactura" class="form-control" id="lafactura" /> 
                        <input type="hidden" name="laventa" class="form-control" id="laventa" /> 
                    </div>
                </div>  
                
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="enviarfactura_porcorreo()"><span class="fa fa-envelope"></span> Enviar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para envio de facturas a correos ------------------->

<!-- --------------- INICIO modal Advertencia ---------------------------------->
<div id="modal_mensajeadvertencia" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #CC660E">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"><fa class="fa fa-frown-o"></fa><b> ADVERTENCIA</b></h2>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
            <label for="mensajeadvertencia" class="control-label">
                <h2 class="modal-title">
                    <fa class="btn btn-default fa fa-exclamation-triangle fa-2x"> </fa><b><span id="mensajeadvertencia"></span></b>
                </h2>
            </label>
        </div>  
          
        <div class="col-md-4">
            <!--<button class="btn btn-default btn-block" onclick="codigo_excepcion()"><fa class="fa fa-arrow-right"></fa> Continuar</button>-->
            <button class="btn btn-default btn-block" data-dismiss="modal" onclick="excepcion_nit()" id="boton_advertencia"><fa class="fa fa-save"></fa> Aceptar</button>
            <button class="btn btn-default btn-block" data-dismiss="modal" onclick="cancelar_excepcion_nit()"><fa class="fa fa-times"></fa> Cancelar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- --------------- F I N  modal Advertencia ---------------------------------->
