<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/factura.js'); ?>" type="text/javascript"></script>
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="text" id="base_url" value="<?php echo base_url();?>" hidden>
<input type="hidden" id="rolusuario_asignado" name="rolusuario_asignado" value="<?php echo $rolusuario_asignado;?>">

<!--<div class="box-header">
                <h3 class="box-title">Factura</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>-->
<div class="row">
    <div class="col-md-12">
                <h3 class="box-title">LIBRO DE VENTAS</h3>
        <div class="box">

            <div class="box-header">
<!--                <div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                    <button  type="submit" class="btn btn-success btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>

                </div>-->
                
                <div class="col-md-12">
                    <!--<form action="<?php //echo site_url('factura/generar_excel'); ?>" method="POST">-->
                        
                        <div class="col-md-3">
                            <label for="desde" class="control-label">Desde:</label>
                            <div class="form-group">
                                 <input type="date"class="btn btn-warning btn-xs form-control"  id="fecha_desde" name="fecha_desde" value="<?php echo date("Y-m-d");?>">

                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="hasta" class="control-label">Hasta:</label>
                            <div class="form-group">
                                <input type="date" class="btn btn-warning btn-xs form-control"  id="fecha_hasta" name="fecha_hasta" value="<?php echo date("Y-m-d");?>">
                        
                            </div>
                        </div>
                        
                        <div class="col-md-2" hidden>
                            <label for="tipo" class="control-label">Tipo:</label>
                            <div class="form-group">
                                <select name="opcion" id="opcion" class="btn btn-warning btn-xs form-control">
                                        <option value="1">VENTAS</option>
                                        
                                </select>
                            </div>
                        </div>
                        
                <!--------------------- parametro de buscador --------------------->
<!--                  <div class="input-group">
                      <span class="input-group-addon"> 
                        Buscar 
                      </span>           
                      <input id="filtrarproducto" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código del producto" onkeypress="validar(event,6)">
                  </div>-->
            <!--------------------- fin parametro de buscador --------------------->                        
                        
                        <div class="col-md-2">
                           <label for="desde" class="control-label"> Exportar: </label>
                           <div class="form-group">
              
                                <button onclick="generarexcel()" type="button" class="btn btn-facebook btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>
                                <!--<button  type="submit" class="btn btn-facebook btn-xs form-control" ><span class="fa fa-file-excel-o"> </span> Exportar a Excel</button>-->
      
                            </div>
                        </div>
                        
                    
                    <!--</form>-->
                        <div class="col-md-2">
                           <label for="desde" class="control-label"> Buscar: </label>
                           <div class="form-group">
              
                               <button  type="submit" class="btn btn-danger btn-xs form-control" onclick="mostrar_facturas()"><span class="fa fa-binoculars"> </span> Ver</button>
      
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-body table-responsive" id="tabla_factura" >

        <!------------ aqui va la tabla JS con las facturas ----------------------->


</div>
    
