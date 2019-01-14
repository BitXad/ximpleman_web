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


        $(document).ready(function () {
            (function ($) {
                $('#filtrar4').click(function () {
                  $('.oscar4').removeClass('hidden');
                    var rex = new RegExp($(this).val(), 'i');
                    
                    $('.os1car4 tr').hide();
                    $('.oscar4 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });

  
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<!--------------------- CABCERA -------------------------->

<div class="box-header">
    <h1 class="box-title"><b>DETALLE compra COD: <?php echo "000".$compra_id; ?></b></h1>
</div>


<div class="container">
    <div class="panel panel-primary col-md-6">
        <h5><b>Proveedor: </b><?php echo $compra[0]['proveedor_nombre']; ?> <br>
        <b>Código Proveedor: </b><?php echo $compra[0]['proveedor_codigo']; ?> <br>
        <b>Fecha/Hora: </b><?php echo $compra[0]['compra_fecha']; ?></h5>
        
        
    </div>
    
    <div class="box-tools">
        <center>            
            <a a href="#" data-toggle="modal" data-target="#modalproveedor"class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Nuevo Prov</small></a>
            <a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs"><font size="5"><span class="fa fa-search"></span></font><br><small>Buscar Prov</small></a>
            <a href="#" data-toggle="modal" data-target="#modalbuscarprod" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>
            <a href="#" data-toggle="modal" data-target="#modalproducto" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-plus-circle"></span></font><br><small>Nuevo Prod.</small></a>
            <!--<a href="" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>-->            
        </center>            
    </div>
    <br>            
<!--    <div class="panel panel-primary col-md-4">
    <h5><b>Adulto(s): </b><?php echo $huesped[0]['compra_adultos']; ?></h5>
    <h5><b>Jovene(s): </b><?php echo $huesped[0]['compra_jovenes']; ?></h5>
    <h5><b>Niño(s): </b><?php echo $huesped[0]['compra_ninos']; ?></h5>
    <h5><b>Equipaje: </b><?php echo $huesped[0]['compra_equipaje']; ?></h5>
    <?php $habitacion_id = $huesped[0]['habitacion_id']; ?>
      
    </div>-->        
</div>


<!--------------------- FIN CABERECA -------------------------->


<!--<div class="box-header">
                <h3 class="box-title">compra</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('compra/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>-->
<div class="row">
    <div class="col-md-12">
    <!--------------------- parametro de buscador --------------------->
              <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el compra, producto, costo"> 
              </div>
                
        <!--------------------- fin parametro de buscador --------------------->
  
       <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>Nº</th>
                            <th>Producto</th>
                            <th>Unidad</th>
                            <th>Código</th>
                            <th>Precio</th>
                            <th>Costo</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Descuento</th>
                            <th>Total</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          $subtotal = 0;
                          $descuento = 0;
                          $totalfinal = 0;
                          
                          foreach($detalle_compra as $d){;
                                 $cont = $cont+1; 

                                 
                          $subtotal += $d['detallecomp_subtotal'];
                          $descuento += $d['detallecomp_descuento'];
                          $totalfinal += $d['detallecomp_total'];
                          
                                 
                                 
                                 ?>
                    <tr>
                        
                            <td><?php echo $cont ?></td>
                                <td><b><?php echo $d['producto_nombre']; ?></b>
                            </td>   
                            <td>
                            <b><?php echo $d['detallecomp_unidad']; ?></td>
                            <td><?php echo $d['detallecomp_codigo']; ?></td>
                             <form action="<?php echo base_url('compra/updateDetalle/'.$compra_id."/".$p['producto_id']); ?>"  method="POST" class="form">
                            <td> <input id="compra_id"  name="compra_id" type="hidden" class="form-control" value="<?php echo $compra_id; ?>">
                                  <input id="producto_id"  name="producto_id" type="hidden" class="form-control" value="<?php echo $d['producto_id']; ?>">
                                <input id="detallecomp_precio"  name="producto_precio" type="text" size="3" class="form-control" value="<?php echo $d['detallecomp_precio']; ?>"></td>  
                            <td><input id="detallecomp_costo"  name="producto_costo" type="text" size="3" class="form-control" value="<?php echo $d['detallecomp_costo']; ?>"></td>
                            <td><input id="detallecomp_cantidad"  name="cantidad" size="3" type="text" class="form-control" value="<?php echo $d['detallecomp_cantidad']; ?>">
                                <input id="detallecomp_id"  name="detallecomp_id" type="hidden" class="form-control" value="<?php echo $d['detallecomp_id']; ?>"></td>
                            <td><?php echo $d['detallecomp_subtotal']; ?></b></td>
                            <td><input id="detallecomp_descuento"  name="descuento" size="3" type="text" class="form-control" value="<?php echo number_format($d['detallecomp_descuento'], 2, ".", ","); ?>"> <button type="submit" class="hidden"></button></td>
                            
                                     </form>                            
                                <!--------------------------------------------------------------->
                                    
                                <!--<div class="btn-group">
                                <a href="<?php echo site_url('detalle_compra/edit/'.$d['detallecomp_id']); ?>" class="btn btn-info btn-sm"><span class="fa fa-minus"></span></a> 
                                <a href="<?php echo site_url('detalle_compra/edit/'.$d['detallecomp_id']); ?>" class="btn btn-info btn-sm"><span class="fa fa-plus"></span></a> 
                                
                                <a href="<?php echo site_url('detalle_compra/quitar/'.$d['detallecomp_id']."/".$compra_id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                </div>-->
                                    
                            </td>

                            
                            <td>   
                                <center>
                                    
                                    <span class="badge badge-success">
                                        <font size="4"> <b><?php echo number_format($d['detallecomp_total'],2,".",","); ?></b></font> <br>                                        
                                    </span>
                                </center>
                        
                            </td>
                            <td><div align="right"><a href="<?php echo site_url('detalle_compra/quitar/'.$d['detallecomp_id']."/".$compra_id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a></div></td>
<!--                            <td><?php echo $d['detallecomp_cantidad']; ?></td>
                            <td><?php echo $d['detallecomp_subtotal']; ?></td>
                            <td><?php echo $d['detallecomp_descuento']; ?></td>-->
<!--                            <td><?php echo $d['detallecomp_total']; ?></td>-->
                            
                        
                    </tr>
                    <?php } ?>
                </table>
                
            </div>
            <div class="pull-right">

                </div>                
        </div>
    </div>
</div> 


<div class="col-md-6">
        
        
<!----------- tabla detalle cuenta ----------------------------------->
        
        <div class="row">
            <div class="col-md-12">
                <div class="box">


        <div class="box-body table-responsive table-condensed">
            <table class="table table-striped table-condensed" id="miotratabla">
                <tr>
                        <th> Descripción</th>
                        <th> Total </th>
                        
                </tr>
                <tr>
                        <td>Sub Total Bs</td>
                        <td><?php echo number_format($subtotal,2,'.',','); ?></td>                    
                </tr>                
                <tr>
                        <td>Descuento</td>
                        <td><?php echo number_format($descuento,2,'.',',');?></td>
                    
                </tr>
                <tr>
                        <td>Descuento Global</td>
                        <td><?php echo number_format($compra_descglobal,2,'.',',');?>

                      <!--  <?php echo form_open('usuario/password'); ?>
                                <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $u['usuario_id']; ?>" >
                                <input type="hidden" id="ban" name="ban" value="0" >
                                
                                
                            <?php echo form_close(); ?>-->
                        </td>
                    
                </tr>
                
                <tr>
                        <th><b>TOTAL FINAL</b></th>
                        <th><font size="5"> <?php echo number_format($totalfinal,2,'.',',');?></font></th>

                </tr>


            </table>
        </div>
        </div>
        </div>
        </div>
        
    <!----------- fin tabla detalle cuenta ----------------------------------->
         <!-- DATOS PARA INSERTAR A COMPRA
<form action="<?php echo base_url('compra/editar/'); ?>"  method="POST" class="form">
<div class="box">
    <div class="box-body">
              
         

            DATOS DESPEGABLES DE CHOFER COMPRA 
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
               <button type="submit" class="btn btn-info" >
                <i class="fa fa-plus "></i>
               Agregar Datos<br>
            </button>
            
        </div>
  
 
                </div> ---------/.box-body
            
          </div>
    FIN DATOS DESPEGABLES DE CHOFER COMPRA             
          
</div></form>
 FIN DATOS PARA INSERTAR A COMPRA------------------------------------>   



    </div>



    <!----------------------------INSERTA LOS VALORES Q SE DIERON EN LOS CALCULOS------------------------------------->

             <center>
            
            <a href="#" data-toggle="modal" data-target="#modalcobrar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-money fa-4x"></i><br><br>
               Finalizar compra <br>
            </a>
               
                
            <a  href="<?php echo site_url('compra'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-sign-out fa-4x"></i><br><br>
               Salir <br>
            </a>    
            </center>
        </form>
        </div>



</div>    


<!--------------------------------- INICIO MODAL crear Productos ------------------------------------>
<div class="modal fade" id="modalproducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Añadir Producto</h3>
            </div>
     <form action="<?php echo base_url('producto/rapido/'); ?>"  method="POST" class="form">
        <div class="box-body">
                <div class="row clearfix">
                    
                         
                    <div class="col-md-6">
                        <label for="producto_codigo" class="control-label"><span class="text-danger">*</span>Código</label>
                        <div class="form-group">
                            <input type="text" name="producto_codigo" value="<?php echo $this->input->post('producto_codigo'); ?>" class="form-control" id="producto_codigo" />
                            <span class="text-danger"><?php echo form_error('producto_codigo');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="producto_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="producto_nombre" value="<?php echo $this->input->post('producto_nombre'); ?>" class="form-control" id="producto_nombre" />
                            <span class="text-danger"><?php echo form_error('producto_nombre');?></span>
                        </div>
                    </div>
                              <div class="col-md-6" hidden>
                    <input id="compra_id"  name="compra_id" type="text" class="form-control" value="<?php echo $compra_id; ?>">
                        </div>  
                    <div class="col-md-6">
                        <label for="producto_costo" class="control-label">Costo</label>
                        <div class="form-group">
                            <input type="text" name="producto_costo" value="<?php echo $this->input->post('producto_costo'); ?>" class="form-control" id="producto_costo" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="producto_precio" class="control-label">Precio de Venta</label>
                        <div class="form-group">
                            <input type="text" name="producto_precio" value="<?php echo $this->input->post('producto_precio'); ?>" class="form-control" id="producto_precio" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="categoria_id" class="control-label">Categoria</label>
                        <div class="form-group">
                            <select name="categoria_id" class="form-control">
                                <option value="">select categoria_producto</option>
                                <?php 
                                foreach($all_categoria_producto as $categoria_producto)
                                {
                                    $selected = ($categoria_producto['categoria_id'] == $this->input->post('categoria_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$categoria_producto['categoria_id'].'" '.$selected.'>'.$categoria_producto['categoria_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="presentacion_id" class="control-label">Presentación</label>
                        <div class="form-group">
                            <select name="presentacion_id" class="form-control">
                                <option value="1">Unidad</option>
                               <!-- <?php 
                                foreach($all_presentacion as $presentacion)
                                {
                                    $selected = ($presentacion['presentacion_id'] == $this->input->post('presentacion_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$presentacion['presentacion_id'].'" '.$selected.'>'.$presentacion['presentacion_nombre'].'</option>';
                                } 
                                ?>   -->
                            </select>
                        </div>
                    </div>
</div>
<div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Mas</h3>
              <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-plus"></i></button>
                
              </div>
                    

                    <div class="box-body" style="display: none;">
                        <div class="col-md-6">
                        <label for="producto_unidad" class="control-label">Unidad</label>
                        <div class="form-group">
                            <input type="text" name="producto_unidad" value="<?php echo $this->input->post('producto_unidad'); ?>" class="form-control" id="producto_unidad" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="producto_marca" class="control-label">Marca</label>
                        <div class="form-group">
                            <input type="text" name="producto_marca" value="<?php echo $this->input->post('producto_marca'); ?>" class="form-control" id="producto_marca" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="producto_industria" class="control-label">Industria</label>
                        <div class="form-group">
                            <input type="text" name="producto_industria" value="<?php echo $this->input->post('producto_industria'); ?>" class="form-control" id="producto_industria" />
                        </div>
                    </div>
                   
                   
                    <div class="col-md-6">
                        <label for="producto_comision" class="control-label">Comision</label>
                        <div class="form-group">
                            <input type="text" name="producto_comision" value="<?php echo $this->input->post('producto_comision'); ?>" class="form-control" id="producto_comision" />
                        </div>
                    </div>


                </div>
            </div>
           
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
          
                    </div>
                </div>
    </div>
</div></form>
</div>
     <!----------------------FIN  CREAR PRODUCTO--------------------------------------------------->
            </div>
        </div>
    </div>
</div>


<!--------------------------------- INICIO MODAL crear Proveedores ------------------------------------>
<div class="modal fade" id="modalproveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Añadir Proveedor</h3>
            </div>

           <form action="<?php echo base_url('proveedor/rapido/'); ?>"  method="POST" class="form">
            <div class="box-body">
                <div class="row clearfix">
                    
                    <div class="col-md-6">
                        <label for="proveedor_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_nombre" value="<?php echo $this->input->post('proveedor_nombre'); ?>" class="form-control" id="proveedor_nombre" required />
                            <span class="text-danger"><?php echo form_error('proveedor_nombre');?></span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <label for="proveedor_contacto" class="control-label">Contacto</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_contacto" value="<?php echo $this->input->post('proveedor_contacto'); ?>" class="form-control" id="proveedor_contacto" />
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="proveedor_telefono" class="control-label">Teléfono</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_telefono" value="<?php echo $this->input->post('proveedor_telefono'); ?>" class="form-control" id="proveedor_telefono" />
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="proveedor_nit" class="control-label">Nit</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_nit" value="<?php echo $this->input->post('proveedor_nit'); ?>" class="form-control" id="proveedor_nit" />
                        </div>
                    </div>
                </div>
           <div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Mas</h3>
              <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-plus"></i></button>
              </div>
                    <div class="box-body" style="display: none;">
                        
                    <div class="col-md-6" >
                        <label for="proveedor_razon" class="control-label">Razon</label>
                        <div class="form-group">
                            <input type="text" id="proveedor_razon" class="form-control" value="<?php echo $this->input->post('proveedor_razon'); ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <label for="proveedor_codigo" class="control-label">Código</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_codigo" value="<?php echo rand(); ?>" class="form-control" id="proveedor_autorizacion" />                            
                        </div>
                    </div>

                    <div class="col-md-6" >
                        <label for="proveedor_autorizacion" class="control-label">Autorización</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_autorizacion" value="1" class="form-control" id="proveedor_autorizacion" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="proveedor_direccion" class="control-label">Dirección</label>
                        <div class="form-group">
                            <input type="text" name="proveedor_direccion" value="<?php echo $this->input->post('proveedor_direccion'); ?>" class="form-control" id="proveedor_direccion" />
                        </div>
                    </div>

                    <div class="col-md-6" hidden>
                    <input id="compra_id"  name="compra_id" type="text" class="form-control" value="<?php echo $compra_id; ?>">
                        </div>
                    <div class="col-md-6" hidden>
                        <label for="estado_id" class="control-label">estado_id</label>
                        <div class="form-group">
                            <input type="text" name="estado_id" value="1" class="form-control" id="estado_id" />
                        </div>
                    </div>
                    </div>
                </div>
            </div></div>
            
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>           
            </form>
        </div>
    </div>
</div>
                      <!----------------------FIN  CREAR PROVEEDOR--------------------------------------------------->
            </div>
        </div>
    </div>
</div>
                            
<!--------------------------------- INICIO MODAL proveedores ------------------------------------>
<div class="modal fade" id="modalbuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar Proveedor</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar2" type="text" class="form-control" placeholder="Ingresa el nombre">
      </div>
                                
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                        <th>N</th>
                                                        <th> Nombres</th>
<!--                                                        <th>Acción</th>-->
                            </tr>
                            <tbody class="buscar2">
                            <?php $i=1;
                            foreach($all_proveedor as $h){ ?>
                            <tr>
                                 <form action="<?php echo base_url('proveedor/cambiarproveedor/'); ?>"  method="POST" class="form">
                              
                                    <td><?php echo $i++; ?></td>

                                    <td>
                                        <div class="col-md-3">
                                            <center>
                                                
                                            <?php //$imagen = base_url('resources/img/').$h['huesped_foto'];
//                                                if (is_file($imagen)){ ?>
                                            <!--<img src="<?php echo base_url('resources/img/').$h['proveedor_foto']; ?>"  class="img-responsive">-->
                                            <h1 style="color: #0073b7">
                                            <i class="fa fa-user fa-3x"></i>   
                                            </h1>
                                            <?php //} else { ?>
                                                    <!--<img src="<?php echo base_url('resources/img/foto0.jpg'); ?>"  class="img-responsive"  title="<?php echo $imagen;?>">-->
                                            <?php //} ?>
                                            
                                            </center>    
                                        </div>
                                        <div class="col-md-9">

                                            <b> <?php echo $h['proveedor_nombre']; ?></b><br>
                                         Telf.:<?php echo $h['proveedor_telefono']; ?> <br>
                                         <button type="submit" class="btn btn-success btn-xs">
                                            <i class="fa fa-check"></i> Añadir
                                        </button>

        <div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Mas</h3>
              <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-plus"></i></button>
                
              </div>
              <div class="box-body" style="display: none;">
                                        <div class="container" hidden="true" >
                                            <input id="proveedor_id"  name="proveedor_id" type="text" class="form-control" value="<?php echo $h['proveedor_id']; ?>" >
                                            <input id="compra_id"  name="compra_id" type="text" class="form-control" value="<?php echo $compra_id; ?>">
                                        </div>                                        
                                        NIT:
                                        <input type="text" id="proveedor_nit" name="proveedor_nit" class="form-control" placeholder="N.I.T."  value="<?php echo $h['proveedor_nit']; ?>">
                                        RAZON SOCIAL:
                                        <input type="text" id="proveedor_razon" name="proveedor_razon" class="form-control" placeholder="Razón Social"  value="<?php echo $h['proveedor_razon']; ?>">
                                        COD. CONTROL:
                                        <input type="text" id="proveedor_codigo" name="proveedor_codigo" class="form-control" placeholder="Codigo"  value="<?php echo $h['proveedor_codigo']; ?>">
                                        AUTORIZACION:
                                        <input type="text" id="proveedor_autorizacion" name="proveedor_autorizacion" class="form-control" placeholder="AUTORIZACION"  value="<?php echo $h['proveedor_autorizacion']; ?>">
                                        
                                        <!--</div>-->
                                        </div>
                                        </div>
                                      </div>  
                                    </td>
                                 </form>
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
<!--------------------------------- FIN MODAL proveedorS ------------------------------------>


<!----------------- modal productos---------------------------------------------->

<div class="modal fade" id="modalbuscarprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar Producto</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar3" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción">
      </div>
                                
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                        <th>N</th>
                                                        <th>Producto</th>
                            </tr>
                            <tbody class="buscar3">
                            <?php $i=1;
                            foreach($inventario as $p){ ?>
                            <tr>
                                 <form action="<?php echo base_url('compra/ingresarproducto/'.$compra_id."/".$p['producto_id']); ?>"  method="POST" class="form">
                                    <td><?php echo $i++; ?></td>

                                    <td>
                                        
                                        <div clas="row">                                            
                                            <div class="container" hidden="true">
                                                <input id="compra_id"  name="compra_id" type="text" class="form-control" value="<?php echo $compra_id; ?>">
                                                <input id="producto_id"  name="producto_id" type="text" class="form-control" value="<?php echo $p['producto_id']; ?>">
                                            
                                                <input id="detalle_costo"  name="detalle_costo" type="text" class="form-control" value="<?php echo $p['producto_costo']; ?>">
                                            </div>
                                        
                                            <div class="col-md-12">

                                                <b> <?php echo $p['producto_nombre']; ?></b><br>    
                                                <div class="col-md-2"  >
                                                Precio: <input class="input-sm" id="producto_precio"  style="background-color: lightgrey" name="producto_precio" type="text" class="form-control" value="<?php echo $p['producto_precio']; ?>" required="true"></div>
                                                <div class="col-md-2"  >
                                                Costo: <input class="input-sm" id="producto_costo"  style="background-color: lightgrey" name="producto_costo" type="text" class="form-control" value="<?php echo $p['producto_costo']; ?>" required="true"> </div>
                                                <div class="col-md-2"  >
                                                Desc.: <input class="input-sm" id="descuento"  style="background-color: lightgrey" name="descuento" type="text" class="form-control" value="0.00" required="true"></div>
                                                <div class="col-md-2"  >
                                                Cant.: <input class="input-sm " id="cantidad" name="cantidad" type="text" class="form-control" placeholder="cantidad" required="true" value="1"> </div>

                                    
                                            <div class="col-md-2">
                                                    Añadir:
                                                        <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-cart-arrow-down"></i>  Añadir </button>
                                            </div>

                                     </div>
                                    
                                </div> </td>
                                 </form>
                            
                            </tr>
                            <?php } ?>
                           
                        </table>
                        <div class="pull-right">
                            <?php echo $this->pagination->create_links(); ?>                    
                        </div>                
                    </div>



                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>

<!---------------------- fin modal productos --------------------------------------------------->

<!----------------------Modal Cobrar--------------------------------------------------->
<div class="modal fade" id="modalcobrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
         <div class="modal-header">
               <form action="<?php echo base_url('compra/finalizarcompra/'.$compra_id); ?>"  method="POST" class="form" name="descuento">              
               <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                            -->
                            <div class="container">
                                <center>
                                  
                    <div class="col-md-3">
                        <label for="forma_id" class="control-label">Forma Pago</label>
                        <div class="form-group">
                            <select name="forma_id" class="form-control" required>
                                <option value=""></option>
                                <?php 
                                foreach($all_forma_pago as $forma_pago)
                                {
                                    $selected = ($forma_pago['forma_id'] == $compra['forma_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$forma_pago['forma_id'].'" '.$selected.'>'.$forma_pago['forma_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="tipotrans_id" class="control-label">Tipo Transacción</label>
                        <div class="form-group">
                            <select name="tipotrans_id"  type="text" class="form-control" required>
                                
                                <option value="1">CONTADO</option>
                                <option value="2" id="filtrar4">CREDITO</option>
                                <option value="3">CONSIGNACION</option>
                                
                            </select>
                        </div>
                    </div>  
                                
                                <!--<div class="col-md-3">
                                    <h4 class="modal-title" id="myModalLabel"><b>CUENTA POR SERVICIOS</b></h4>
                                    <select id="tipo_pago" class="btn btn-default">
                                                                            
                                        <option value="CCONTADO">BANCO</option>
                                        <option value="CREDITO">CREDITO</option>
                                        <option value="CONSIGNACION">TARJETA DE CREDITO</option>
                                      
                                     </select>
                                </div>-->
                                    
                                </center>
                                

<!--      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción">
      </div>-->
                                
            </div>
            <div class="modal-body">

                            
 <!----------- tabla detalle cuenta ----------------------------------->
<!--        <div class="box-header">
            <h3 class="box-title">CUENTA: ESTADIA</h3>
            <div class="box-tools">
                <a href="<?php echo site_url('huesped/add'); ?>" class="btn btn-success btn-sm">Añadir</a> 
                <a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-sm"><span class="fa fa-search"></span>    Productos</a>
            </div>
        </div>        -->
                
<?php 
    //$total_estadia = 0;
    //$total_consumo = 0;
    //$total_consumo = 0;
    
?>              


                
            <div hidden="true">        
                            <input id="compra_subtotal" name="compra_subtotal" value="<?php echo $subtotal; ?>">
                            <input id="compra_descuento" name="compra_descuento" value="<?php echo $descuento; ?>">
            </div>
        <div class="row">
            <div class="col-md-12">
            <!--<form action="<?php echo base_url('hotel/checkout/'.$compra_id."/".$habitacion_id); ?>"  method="POST" class="form">-->
                <div class="box">

        <div class="box-body table-responsive table-condensed">
            <!--<form method="post" name="descuento">-->
                
            <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" >
                

                <tr>
                        <td>Compra Bs</td>
                        <td><?php echo $subtotal; ?></td>
                    
                </tr>                
                <tr>
                        <td>Descuento Bs</td>
                        <td><?php echo $descuento; ?></td>
                    
                </tr>
                <tr>                      
                        <td><b>Subtotal Bs</b></td>
                        <td>
                              <input class="btn btn-default" id="compra_total" size="2" name="compra_total" value="<?php echo $totalfinal; ?>" readonly="true">
                        </td>
                </tr>
                

                <tr>                      
                        <td>Descuento Global Bs</td>
                        <td>
                         <input class="btn btn-warning" id="compra_descglobal" name="compra_descglobal" size="2" value="" onKeyUp="calcularDesc('compra_total', 'compra_descglobal', 'compra_totalfinal','compra_efectivo','compra_cambio')">
                        </td>
                </tr>

                <tr>                      
                        <td><b>Total Final Bs</b></td>
                        <td>
                              <input class="btn btn-default" id="compra_totalfinal" size="2" name="compra_totalfinal" value="<?php echo $totalfinal; ?>" readonly="true">
                        </td>
                </tr>

                <tr>                      
                        <td>Efectivo Bs</td>
                        <td>
                            <input class="btn btn-warning" id="compra_efectivo" size="2" name="compra_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularCambio('compra_total', 'compra_descglobal', 'compra_totalfinal','compra_efectivo','compra_cambio')">
                
                        </td>
                </tr>
                
                <tr>                      
                    <td><b>Cambio Bs</b></td>
                        <td>
                            <input class="btn btn-default" id="compra_cambio" size="2" name="compra_cambio" value="<?php echo $cambio; ?>" readonly="true">
                        </td>
                </tr>
                
            </table>
              </div>

                <table class="oscar4 hidden" >
                   <tr>  
                         <td>
                            <div class="col-md-4">
                                <div class="form-group">
                        <label for="credito_cuotainicial" class="control-label">Cuota Inicial</label>
                            <input type="text" id="credito_cuotainicial" class="form-control" name="credito_cuotainicial" value="" >
                            </div>
                        </div>
                            
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="credito_numpagos" class="control-label"># Pagos</label>
                            <input type="text" id="credito_numpagos" class="form-control" name="credito_numpagos" value="1" >
                            <input type="hidden" id="credito_monto"  name="credito_monto" value="<?php echo $totalfinal; ?>" >
                            <input type="hidden" name="compra_id" value="<?php echo $compra_id; ?>">
                        </div></div>
                        
                        <div class="col-md-4">
                        <div class="form-group">    
                        <label for="credito_fechalimite" class="control-label">Fecha Limite</label>
                            <input type="text" class="has-datepicker form-control"  name="credito_fechalimite" />
                            <input type="hidden" id="credito_tipo"  name="credito_tipo" value="1" >
                        </div></div>
                        </td>
               </tr>
           </table>
             <div class="col-md-4">
                        <label for="documento_respaldo_id" class="control-label">Documento.Respaldo</label>
                        <div class="form-group">
                            <select name="documento_respaldo_id" class="form-control">
                                <option value=""></option>
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
                    <div class="col-md-4">
                        <label for="compra_numdoc" class="control-label"># Recibo/Factura</label>
                        <div class="form-group">
                            <input type="text" name="compra_numdoc" value="<?php echo $compra['compra_numdoc']; ?>" class="form-control" id="compra_numdoc" />
                        </div>
                    </div>
                     <div class="col-md-4">
                        <label for="compra_glosa" class="control-label">Glosa</label>
                        <div class="form-group">
                           <input type="text" name="compra_glosa" value="<?php echo  $compra['compra_glosa']; ?>" class="form-control" id="compra_glosa" />
                        </div>
                    </div>           
        </div>
        </div>
            <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>-->   
            <button class="btn btn-lg btn-facebook btn-sm btn-block"  type="submit">
                <h4>
                <span class="fa fa-money"></span>   Pagar  
                </h4>
            </button>
            
            <button class="btn btn-lg btn-danger btn-sm btn-block" data-dismiss="modal">
                <h4>
                <span class="fa fa-close"></span>   Cancelar  
                </h4>
            </button>
    <!--</form>-->
        </div>
        </div>
 </form>

<script>
function calcularDesc(compra_subtotalx,compra_descuentox,compra_totalfinalx,compra_efectivox,compra_cambiox){
    caja=document.forms["descuento"].elements;
    var compra_total = Number(caja[compra_subtotalx].value);
    var compra_descglobal = Number(caja[compra_descuentox].value);
    var compra_efectivo = Number(caja[compra_efectivox].value);
    var compra_cambio = Number(caja[compra_cambiox].value);
    
    compra_totalfinal = compra_total - compra_descglobal;
    compra_efectivo = compra_total - compra_descglobal;
    
    if(!isNaN(compra_totalfinal)){
            caja[compra_totalfinalx].value = compra_total - compra_descglobal; 
            caja[compra_efectivox].value = compra_totalfinal;
            caja[compra_cambiox].value = compra_efectivo - compra_totalfinal;
            
    if(caja1!="compra_totalfinal1"){calcularDesc('compra_subtotal1','compra_descuento2','compra_totalfinal2');} 
    }

}
function calcularCambio(compra_subtotalx,compra_descuentox,compra_totalfinalx,compra_efectivox,compra_cambiox){
    caja=document.forms["descuento"].elements;
    var compra_total = Number(caja[compra_subtotalx].value);
    var compra_descglobal = Number(caja[compra_descuentox].value);
    var compra_efectivo = Number(caja[compra_efectivox].value);
    var compra_cambio = Number(caja[compra_cambiox].value);
    var compra_totalfinal = Number(caja[compra_totalfinalx].value);
    
    //compra_totalfinal = compra_subtotal - compra_descuento;
    compra_cambio = compra_efectivo - compra_totalfinal;
    
    if(!isNaN(compra_cambio)){
            //caja[compra_totalfinalx].value = compra_subtotal - compra_descuento; 
            //caja[compra_efectivox].value = compra_totalfinal;
            caja[compra_cambiox].value = compra_efectivo - compra_totalfinal;
            
    if(caja1!="compra_totalfinal1"){calcularDesc('compra_subtotal1','compra_descuento2','compra_totalfinal2');} 
    }

}
</script>

    <!----------- fin tabla detalle cuenta ----------------------------------->                                                      
            </div>
        </div>
    </div>
</div>
</div>