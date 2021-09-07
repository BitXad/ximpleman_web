<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/inventario.js'); ?>"></script>

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

</script>   

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">

<!-------------------------------------------------------->
<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>INVENTARIO POR SUCURSAL</b></font> <br>
                <!--<font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0" >
<!--                ______________________________                
                   
                                
                <div id="datos_recorrido">
                    
                </div>
                
                ______________________________-->
        </td>
    </tr>
     
    
    
</table>

<div class="box-header no-print">
        <?php echo form_open('sucursales'); ?>
            <div class="col-lg-4">
            <center>

            <h5 class="box-title" style="font-family: Arial; font-size: 12pt;">        
                CÓDIGO <input type="text" class="btn btn-default btn-xs" id="producto_codigo" name="producto_codigo" style="width: 100px;">
                <button class="btn btn-danger btn-xs" id="boton_buscarproducto"><fa class="fa fa-binoculars"></fa> Buscar</button></h5>
            
            </center>
            </div>
        <?php echo form_close(); ?>
            
    <div class="col-lg-8">
        <center>
            
        <div class="box-tools no-print">

            <!--<button class="btn btn-success btn-sm" onclick="actualizar_inventario()" type="button"><span class="fa fa-cubes"></span> Actualizar</button>-->
            <?php if($rolusuario[27-1]['rolusuario_asignado'] == 1){ ?>
            <!--<button class="btn btn-primary btn-sm" onclick="tabla_inventario()" type="button"><span class="fa fa-list"></span> Mostrar todo</button>-->

            <!--<button class="btn btn-info btn-sm" onclick="tabla_inventario_existencia()" type="button"><span class="fa fa-list-ol" title="Ver Produtos con Existencia"></span> Con Existencia</button>-->
            <?php } if($rolusuario[28-1]['rolusuario_asignado'] == 1){ ?>
            <!--<button class="btn btn-facebook btn-sm" onclick="mostrar_duplicados()" type="button"><span class="fa fa-copy"></span> Prod. Duplicados</button>-->

            <?php } ?>

            <button type="button" class="btn btn-facebook btn-sm" data-toggle="modal" onclick="actualizar_inventarios()"><span class="fa fa-cubes"></span> Actualizar Inventarios</button>

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><span class="fa fa-binoculars"></span> Buscar Producto</button>
        </div>
        </center>
        
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
<!--                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar3" type="text" class="form-control" placeholder="Ingrese nombre">
                  </div>-->
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <?php if(isset($inventario)){ ?>
                <font style="font-family: Arial; font-size: 10pt; ">
                    
                    <b>PRODUCTO:</b> <?php echo $inventario[0]["producto_nombre"]; ?>
                    <b>CÓDIGO BARRA:</b> <?php echo $inventario[0]["producto_codigobarra"]; ?>
                </font>
                
                <?php   } ?>
                
                
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>Sucursal</th>
                        <th>Producto</th>
                        <th>Codigo</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th class="no-print"></th>
                    </tr>
                    <tbody class="buscarj">
                    
                                <?php
                                
                                if(isset($inventario)){
                                    
                                    
                                $total = 0;    
                                $cantidad = 0;    
                                foreach($inventario as $suc0){
                                    if($suc0!=null){
                                    
                                    
                                    $total += $suc0["existencia"] * $suc0["producto_precio"];
                                    $cantidad += $suc0["existencia"]; 
                                    
                                ?>
                                <tr>

                                    <td style="line-height: 8px;">
                                        <font style="font-family: Arial; font-weight: bold; font-size: 12pt;">
                                            <b>
                                            <?php echo $suc0["empresa_nombre"]; ?><br>    
                                            </b>
                                        </font>
                                        <small>
                                        <?php echo $suc0["empresa_direccion"]; ?>
                                        </small>
                                        
                                    </td>
                                    <td><?php echo $suc0["producto_nombre"]; ?></td>
                                    <td><?php echo $suc0["producto_codigo"]; ?></td>
                                    <td style="text-align: right"><?php echo number_format($suc0["producto_costo"],2,".",","); ?></td>
                                    <td style="text-align: right"><?php echo number_format($suc0["producto_precio"],2,".",","); ?></td>
                                    <td style="text-align: center; font-family: Arial; font-weight: bold; font-size: 12pt;">
                                        <b>
                                            <?php echo number_format($suc0["existencia"],2,".",","); ?>
                                        </b>
                                    </td>
                                    <td style="text-align: center"><?php echo number_format($suc0["existencia"] * $suc0["producto_precio"],2,".",","); ?></td>
                                    <td>
                                        <button class="btn btn-xs btn-info"><fa class="fa fa-arrow-right"> </fa></button>
                                    
                                    </td>
                                </tr> 

                                    <?php } } ?>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th style="text-align: center; font-family: Arial; font-weight: bold; font-size: 12pt;">
                                        <b>
                                            <?php echo number_format($cantidad,2,".",","); ?>
                                        </b>
                                    </th>
                                    
                                    <th><?php echo number_format($total,2,".",",");; ?></th>
                                    <th></th>
                                </tr>
                                
                                
                                
                                
                                <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    






<!-- Button trigger modal -->
<!--<div class="row">
<div class="panel panel-info">
    

    <div class="col-md-8">
        Producto <input type="text" class="form-control" id="codigo" value="7751851005999">
        Producto <input type="hidden" class="form-control" id="producto" value="PRODUCTO X">
    </div>
</div>
</div>-->

<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Buscar Productos
</button>-->



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><b>BUSCAR PRODUCTO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                          <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código"   onkeypress="validar(event,2)" >
                          </div>
      </div>
      <div class="modal-body">
       
        <!---------------------- BUSCADOR DE PRODUCTOS ----------------------------------->  
        <div class="row">
            <div class="col-md-12">
                    <!--------------------- parametro de buscador --------------------->
                    <!--------------------- fin parametro de buscador ---------------------> 
                    <div class="box">

                               <!--------------------- inicio loader ------------------------->
                            <div class="row" id='loader'  style='display:none;'>
                                <center>
                                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                </center>
                            </div> 
                            <!--------------------- fin inicio loader ------------------------->

                        <div class="box-body  table-responsive" >

                            <div id="tabla_inventario">

                            <!-------------------- aqui se muestra la tabla de productos del inventario--------------------->

                            </div>
                        </div>
                    </div>
        </div>
        </div>  
          
        <!---------------------- BUSCADOR DE PRODUCTOS ----------------------------------->  
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
