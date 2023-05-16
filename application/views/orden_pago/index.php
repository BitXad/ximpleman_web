<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/ordenpago.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php // echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<?php $decimales = $parametro['parametro_decimales']; ?>
<input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales"  hidden>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<div class="box-header">
                <h3 class="box-title">Ordenes de Pago</h3>
            	<div class="box-tools">
                   <select class="btn btn-success btn-sm" id="filtro">
                        <option value="1=1">TODOS</option>
                        <option value="compra_id=0 and cuota_id=0">ORDEN DE PAGO</option>
                        <option value="compra_id>0">COMPRA</option>
                        <option value="cuota_id>0">CUOTAS</option>
                    </select>
                    <a href="<?php echo site_url('orden_pago/nueva_orden'); ?>" class="btn btn-facebook btn-sm">Generar Orden</a> 
                    <?php
                    if($rol[91-1]['rolusuario_asignado'] == 1){ ?>
                    <button class="btn btn-warning btn-sm" onclick="buscarorden(1)">Pendientes</button> 
                    <?php }
                    if($rol[92-1]['rolusuario_asignado'] == 1){ ?>
                    <button class="btn btn-success btn-sm" onclick="buscarorden(2)">Pagadas</button> 
                    <button class="btn btn-facebook btn-sm" onclick="buscarorden(3)">Pag. Antes</button> 
                    <button class="btn btn-danger btn-sm" onclick="buscarorden(4)">Anuladas</button> 
                    <?php } ?>
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        
                        <th>#</th>
                        <th>Pagar a la orden</th>
                        <th colspan="2">Pagar Bs</th>						
                        <th colspan="2">Cancelado Bs</th>						
                        <th></th>

                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                   
                    </tbody>                   
                    
                </table>
                                
            </div>
        </div>
    </div>
</div>
