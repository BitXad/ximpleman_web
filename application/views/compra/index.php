<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
    input[type="number"] {
    width: 75px;
}

</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box-header">
                <h3 class="box-title"><?php echo $sistema["sistema_modulocompras"]; ?></h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('compra/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el codigo, fecha, glosa">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
         <div class="box">
           
        <!--DATOS DE LOS PRODUCTOS------------------------------------>    
            <div class="box-body  table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>Num.</th>
                           <!-- <th>Id</th>
                            <th>Estado</th>
                            <th>Categoria</th>
                            <th>Presentación</th>
                            <th>Moneda</th>-->
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Unidad</th>
                            <th>Marca</th>
                            <th>Industria</th>
                            <th>Costo</th>
                            <th>Precio</th>
                            <th>Foto</th>
                            <th>Comision?</th>
                            <th>Tipo Cambio</th>
                            <th>Cantidad</th>
                            <th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($all_producto as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <!--<td><?php echo $p['producto_id']; ?></td>
                        <td><?php echo $p['estado_id']; ?></td>
                        <td><?php echo $p['categoria_id']; ?></td>
                        <td><?php echo $p['presentacion_id']; ?></td>
                        <td><?php echo $p['moneda_id']; ?></td>-->
                        <td><?php echo $p['producto_codigo']; ?></td>
                        <td><?php echo $p['producto_nombre']; ?></td>
                        <td><?php echo $p['producto_unidad']; ?></td>
                        <td><?php echo $p['producto_marca']; ?></td>
                        <td><?php echo $p['producto_industria']; ?></td>
                        <td><?php echo form_open('producto/rapido'); ?>
<input type="hidden" id="producto_id" name="producto_id" value="<?php echo $p['producto_id']; ?>" >
                        <input type="number" name="producto_costo" id="producto_costo" value="<?php echo $p['producto_costo']; ?>"></td>
                        <td><input type="number" name="producto_precio" id="producto_precio" value="<?php echo $p['producto_precio']; ?>"> <input type="submit" hidden><?php echo form_close(); ?></td>
                        <td><?php echo $p['producto_foto']; ?></td>
                        <td><?php echo $p['producto_comision']; ?></td>
                        <td><?php echo $p['producto_tipocambio']; ?></td>
                        <td>
                             <!-- DATOS DE LOS PRODUCTOS QUE PASAN A DETALLE COMPRA------------------------------------> 
            <?php echo form_open('detalle_compra/add'); ?>
                                <input type="number"  id="producto_id" name="producto_id" value="<?php echo $p['producto_id']; ?>" hidden>

                                <input type="number"  id="compra_id" name="compra_id" value="<?php echo $this->input->post('compra_id'); ?>" hidden>
                                <input type="number"  id="detallecomp_cantidad" name="detallecomp_cantidad" value="<?php echo $this->input->post('detallecomp_cantidad'); ?>">
                                <input type="number"  id="detallecomp_codigo" name="detallecomp_codigo" value="<?php echo $p['producto_codigo']; ?>" hidden>
                                <input type="text"  id="detallecomp_unidad" name="detallecomp_unidad" value="<?php echo $p['producto_unidad']; ?>" hidden>
                                <input type="number"  id="detallecomp_costo" name="detallecomp_costo" value="<?php echo $p['producto_costo']; ?>" hidden>
                                <input type="number"  id="detallecomp_precio" name="detallecomp_precio" value="<?php echo $p['producto_precio']; ?>" hidden>
                                
                                <input type="number"  id="moneda_id" name="moneda_id" value="<?php echo $p['moneda_id']; ?>" hidden>

                                <input type="text"  id="detallecomp_subtotal" name="detallecomp_subtotal" value="" hidden>

                                <input type="submit" hidden>          

                            <?php echo form_close(); ?>
                            <!-- FIN DATOS DE LOS PRODUCTOS QUE PASAN A DETALLE COMPRA------------------------------------> 
                        </td>
                        <td>
                            <a href="<?php echo site_url('producto/edit/'.$p['producto_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            
                        </td>
                    </tr>
                    <?php } ?>                                            
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
 <!-- FIN DATOS DE LOS PRODUCTOS------------------------------------> 

 <!-- DATOS PARA INSERTAR A COMPRA------------------------------------> 
<div class="box"> <h3 class="box-title">Detalle <?php echo $sistema["sistema_modulocompras"]; ?></h3>
    <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-3">
                        <label for="proveedor_id" class="control-label">Proveedor(C)</label>
                        <div class="form-group">
                            <select name="proveedor_id" class="form-control">
                                <option value="">select proveedor</option>
                                <?php 
                                foreach($all_proveedor as $proveedor)
                                {
                                    $selected = ($proveedor['proveedor_id'] == $this->input->post('proveedor_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$proveedor['proveedor_id'].'" '.$selected.'>'.$proveedor['proveedor_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="proveedor_razon" class="control-label">Razon Social(P)</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_razon" value="<?php echo $this->input->post('proveedor_razon'); ?>" class="form-control" id="proveedor_razon" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="proveedor_nit" class="control-label">Nit(P)</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_nit" value="<?php echo $this->input->post('proveedor_nit'); ?>" class="form-control" id="proveedor_nit" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="proveedor_autorizacion" class="control-label">Autorización(P)</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_autorizacion" value="<?php echo $this->input->post('proveedor_autorizacion'); ?>" class="form-control" id="proveedor_autorizacion" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="compra_numdoc" class="control-label">Cod. Control</label>
                        <div class="form-group">
                            <input type="text" name="compra_numdoc" value="<?php echo $this->input->post('compra_numdoc'); ?>" class="form-control" id="compra_numdoc" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="forma_id" class="control-label">Forma Pago(C)</label>
                        <div class="form-group">
                            <select name="forma_id" class="form-control">
                                <option value="">select forma_pago</option>
                                <?php 
                                foreach($all_forma_pago as $forma_pago)
                                {
                                    $selected = ($forma_pago['forma_id'] == $this->input->post('forma_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$forma_pago['forma_id'].'" '.$selected.'>'.$forma_pago['forma_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="tipotrans_id" class="control-label">Tipo Transacción(C)</label>
                        <div class="form-group">
                            <select name="tipotrans_id" class="form-control">
                                <option value="">select tipo_transaccion</option>
                                <?php 
                                foreach($all_tipo_transaccion as $tipo_transaccion)
                                {
                                    $selected = ($tipo_transaccion['tipotrans_id'] == $this->input->post('tipotrans_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$tipo_transaccion['tipotrans_id'].'" '.$selected.'>'.$tipo_transaccion['tipotrans_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="control-label">Poliza</label>
                        <div class="form-group">
                            <input type="text" name="" value="" class="form-control" id="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="compra_numdoc" class="control-label">Num. Documento(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_numdoc" value="<?php echo $this->input->post('compra_numdoc'); ?>" class="form-control" id="compra_numdoc" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="documento_respaldo" class="control-label">Documento Respaldo(DR)</label>
                        <div class="form-group">
                            <select name="documento_respaldo" class="form-control">
                                <option value="">select documento_respaldo</option>
                                <?php 
                                foreach($all_documento_respaldo as $documento_respaldo)
                                {
                                    $selected = ($documento_respaldo['documento_respaldo_id'] == $this->input->post('documento_respaldo_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$documento_respaldo['documento_respaldo_id'].'" '.$selected.'>'.$documento_respaldo['documento_respaldo_descripcion'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>                   
                    <div class="col-md-3">
                        <label for="compra_fecha" class="control-label">Fecha(C)</label>
                        <div class="form-group">
                            <input type="date" name="compra_fecha" value="<?php echo $this->input->post('compra_fecha'); ?>" class="form-control" id="compra_fecha" />
                        </div>
                    </div>
                    
                </div>
    </div>

</div>
<!-- FIN DATOS PARA INSERTAR A COMPRA------------------------------------> 
<!-- DATOS DESPEGABLES DE CHOFER COMPRA------------------------------------> 
<div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Mas</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-plus"></i></button>
                
              </div>
            </div>
            <div class="box-body" style="display: none;">
                <div class="box"> <h3 class="box-title">Detalle Chofer</h3>
                     <div class="box-body">
                        <div class="row clearfix">
                        <div class="col-md-6">
                        <label for="compra_chofer" class="control-label">Chofer(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_chofer" value="<?php echo $this->input->post('compra_chofer'); ?>" class="form-control" id="compra_chofer" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="compra_placamovil" class="control-label">Placa movil(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_placamovil" value="<?php echo $this->input->post('compra_placamovil'); ?>" class="form-control" id="compra_placamovil" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="compra_fechallegada" class="control-label">Fecha llegada(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_fechallegada" value="<?php echo $this->input->post('compra_fechallegada'); ?>" class="has-datepicker form-control" id="compra_fechallegada" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="compra_horallegada" class="control-label">Hora llegada(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_horallegada" value="<?php echo $this->input->post('compra_horallegada'); ?>" class="form-control" id="compra_horallegada" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div><!-- /.box-body -->
            
          </div>
    <!-- FIN DATOS DESPEGABLES DE CHOFER COMPRA------------------------------------> 
    
    <!------ DATOS Y TABLA DE DETALLE COMPRA---------------------------------------->      
       <div class="box">
             
            <div class="box-body table-responsive">
                <table class="table table-stripedtable-condensed" id="mitabla">
                    <tr>
                        <!--<th>Num.</th>
                        <th>Id</th>
                        <th>Compra</th>-->
                        <th>Producto<-P</th>
                        <th>Codigo<-P</th>
                        <th>Cantidad<-P</th>
                        <th>Unidad<-P</th>
                        <th>Moneda<-P</th>
                        <th>Costo<-P<</th>
                        <th>Precio<-P</th>
                        <th>Subtotal<-P</th>
                        <th>Descuento</th>
                        <th>Descglobal</th> 
                        <th>Total</th>
                        <th>Fecha Vencimiento?/?</th>
                        <!--<th>Tipo Cambio T$</th>-->
                        <th>Quitar</th>
                    </tr>
                    <tbody>
                    <?php $cont = 0;
                           foreach($all_detalle_compra as $d){;
                                  $cont = $cont+1;?>
                    <tr>
                        <!--<td><?php echo $cont ?></td>
                        <td><?php echo $d['detallecomp_id']; ?></td>
                        <td><?php echo $d['compra_id']; ?></td>-->
                        <td><?php echo $d['producto_nombre']; ?></td>
                        <td><?php echo $d['detallecomp_codigo']; ?></td>
                        <td><?php echo $d['detallecomp_cantidad']; ?></td>
                        <td><?php echo $d['detallecomp_unidad']; ?></td>
                        <td><?php echo $d['moneda_descripcion']; ?></td>
                        <td><?php echo $d['detallecomp_costo']; ?></td>
                        <td><?php echo $d['detallecomp_precio']; ?></td>
                        <td><?php echo $d['detallecomp_subtotal']; ?></td>
                        <td><input type="number" name="detallecomp_descuento" value="<?php echo $d['detallecomp_descuento']; ?>"></td>
                        <td><?php echo $d['detallecomp_descglobal']; ?></td>
                        <td><?php echo $d['detallecomp_total']; ?></td>
                        <td><?php echo $d['detallecomp_fechavencimiento']; ?></td>
                        <!--<td><?php echo $d['detallecomp_tipocambio']; ?></td>-->
                        <td>
                            <a href="<?php echo site_url('detalle_compra/edit/'.$d['detallecomp_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('detalle_compra/remove/'.$d['detallecomp_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
    <!------  FIN DATOS Y TABLA DE DETALLE COMPRA---------------------------------------->
     <!------  RESULTADOS DE CALCULOS DE COMPRA---------------------------------------->
<div class="box"> 
    <div class="box-body">
                <div class="row clearfix">
                    <div class="col-lg-offset-4" >
                    <div class="col-md-8" >
                        <label for="compra_subtotal" class="control-label">Subtotal(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_subtotal" value="" class="form-control" id="compra_subtotal" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="compra_descuento" class="control-label">Descuento(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_descuento" value="<?php echo $this->input->post('compra_descuento'); ?>" class="form-control" id="compra_descuento" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="compra_descglobal" class="control-label">Descuento Global(C)</label>
                        <div class="form-group">
                            <input type="number" name="compra_descglobal" value="<?php echo $this->input->post('compra_descglobal'); ?>" class="form-control" id="compra_descglobal" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="compra_total" class="control-label">Total(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_total" value="<?php echo $this->input->post('compra_subtotal')+ $this->input->post('compra_descglobal'); ?>" class="form-control" id="compra_total" />
                        </div>
                    </div>
                    <!--------------cuadro----------->
                    <div class="col-lg-4 col-xs-4">
                    <div class="small-box bg-aqua">
                    <div class="inner">
                        <h2 align="center">moneda/tipcambio/total(C)</h2>
                    </div>
                </div>
                </div>
                <!------------fin cuadro-------------->
                </div>
 <!------  RESULTADOS DE CALCULOS DE COMPRA---------------------------------------->
                 </div>
                 <b>en la impresion</b><br>
                <b> (usuario_id,compra_id,compre_hora,compra_efectivo,compra_cambio,glosa)(C)</b><br>
                fataria estado_id
             </div>
</div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
                            