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

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->    
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<input type="text" id="parametro_modoventas" value="<?php echo $parametro[0]['parametro_modoventas']; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro[0]['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro[0]['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro[0]['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro[0]['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro[0]['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro[0]['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro[0]['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>

<input type="text" id="rol_precioventa" value="<?php echo $rolusuario[160-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor" value="<?php echo $rolusuario[161-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor1" value="<?php echo $rolusuario[162-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor2" value="<?php echo $rolusuario[163-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor3" value="<?php echo $rolusuario[164-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor4" value="<?php echo $rolusuario[165-1]['rolusuario_asignado']; ?>" hidden>

<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="text" value="" id="parametro" hidden>




<div class="box-header no-print">
<h3 class="box-title">Ventas</h3>
            	<div class="box-tools">                    
                    <?php if($rolusuario[23-1]['rolusuario_asignado'] == 1){ ?>
                    <select  class="btn btn-facebook btn-sm" id="select_ventas" onclick="buscar_ventas()">
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

<div class="modal fade" id="modalfactura" tabindex="-1" role="dialog" aria-labelledby="modalfactura" aria-hidden="true">
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
                            
                        <br><b>NIT:</b><input type="text" id="generar_nit" value="0" class="form-control btn btn-xs btn-warning" style="text-align: left;">
                        <br><b>RAZON SOCIAL:</b><input type="text" id="generar_razon" value="SIN NOMBRE" class="form-control btn btn-xs btn-warning" style="text-align: left;">

                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive">
                            
                            <b>DETALLE:</b><input type="text" id="generar_detalle" value="-" class="form-control btn btn-xs btn-default" style="text-align: left;">
                                
                            <div class="col-md-6">
                                <label for="usuario_idx" class="control-label">TOTAL Bs</label>

                                <input type="text" id="generar_venta_id" value="0.00" hidden >
                                <input type="text" id="generar_monto" value="0.00" class="form-control btn btn-xs btn-default" style="text-align: left;">
                            </div>
                                
                            <div class="col-md-6" id='botones'  style='display:block;'>
                                    <label for="opciones" class="control-label">Opciones</label>
                                    <div class="form-group">

                                        <button class="btn btn-facebook" id="boton_asignar" onclick="registrar_factura()" data-dismiss="modal" >
                                                <span class="fa fa-floppy-o"></span> Generar Factura
                                        </button>

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

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>


<!----------------- fin modal factura ---------------------------------------------->
