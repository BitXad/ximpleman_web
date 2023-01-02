<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_productoexistmin.js'); ?>" type="text/javascript"></script>
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
<!--<style type="text/css">
    /*td img{
        width: 50px;
        height: 50px;
        margin-right: 5px; 
    }*/
    #contieneimg{
        width: 50px;
        height: 50px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masgrande{
        font-family: Arial;
        font-size: 12px;
    }
</style>-->

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="formaimagen" id="formaimagen" value="<?php  echo $parametro['parametro_formaimagen']; ?>" />

<!--<div class="row micontenedorep" style="display: block" id="cabeceraprint">
    
    <div id="cabizquierda">
        <?php
        echo $empresa[0]['empresa_nombre']."<br>";
        echo $empresa[0]['empresa_direccion']."<br>";
        echo $empresa[0]['empresa_telefono'];
        ?>
    </div>
    
    <div id="cabcentro">
            <div id="titulo">
                <u>PRODUCTOS CON EXISTENCIA MINIMA</u><br><br>
                <span style="font-size: 9pt">INGRESOS DIARIOS</span><br>
                <span class="lahora" id="fhimpresion"></span><br>
                <span style="font-size: 8pt;" id="busquedacategoria"></span>
                <span style="font-size: 8pt;">PRECIOS EXPRESADOS EN MONEDA BOLIVIANA (Bs.)</span>
            </div>
    </div>
    
    <div id="cabderecha">
            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

    </div>
        
</div>-->


<div class="row micontenedorep" style="display: block; margin-top: 0px; margin-bottom: 0px;" id="cabeceraprintx" >
    <table class="table" style="width: 100%; padding: 0;" >
        <tr>
            <td style="width: 25%; padding: 0; line-height:10px; text-align: center" >
                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
            </td>
            
            <td style="width: 50%; padding: 0; line-height: 10px;" > 
                <center>
                    <br><br>
                    <font size="3" face="arial" style="font-weight: bold"><span id="titcatalogox"></span>PRODUCTOS CON EXISTENCIA MINIMA</font> <br>
                    <font size="1" face="arial"><?php echo date("d/m/Y H:i:s"); ?></font> <br>
                </center>
            </td>
            
            <td style="width: 25%; padding: 0" >
                <center></center>
            </td>
        </tr>
    </table>
</div>

<br>
<div class="row no-print">
        <div class="col-md-12">


        <!--este es INICIO del BREADCRUMB buscador-->
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <!--<li><a href="<?php echo site_url('cliente')?>">Clientes</a></li>-->
                <li class="active"><b>Productos con Existencia Mínima: </b></li>
                <input style="border-width: 0; background-color: #DEDEDE" id="encontrados" type="text"  size="5"  readonly="true">
            </ol>
        </div>
        <!--este es FIN del BREADCRUMB buscador-->
 
        <!--este es INICIO de input buscador-->
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"> Buscar </span>           
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código, código de barras, marca, industria.." onkeypress="buscarproducto(event)" autocomplete="off">
                </div>
            </div>
            
            <div class="col-md-2">                
                <button class="btn btn-success btn-xs form-control" onclick="actualizar_inventario()"><span class="fa fa-cubes"></span> Inventario</button>
            </div>
            
            <div class="col-md-2">
                
                <div class="box-tools">
                    <select name="categoria_id" class="btn-primary btn-sm form-control" id="categoria_id" onchange="tablaresultadosproducto(2)">
                        <option value="" disabled selected >AGRUPAR POR CATEGORIAS</option>
                        <option value="0"> Todas Las Categorias </option>
                        <?php 
                        foreach($all_categoria as $categoria)
                        {
                            echo '<option value="'.$categoria['categoria_id'].'">'.$categoria['categoria_nombre'].'</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>
            
<!--            <div class="col-md-2">
                
                <div class="box-tools">
                    <select name="estado_id" class="btn-primary btn-sm form-control" id="estado_id" onchange="tablaresultadosproducto(2)">
                        <option value="" disabled selected >-- BUSCAR POR ESTADOS --</option>
                        <option value="0">Todos Los Estados</option>
                        <?php 
                        foreach($all_estado as $estado)
                        {
                            echo '<option value="'.$estado['estado_id'].'">'.$estado['estado_descripcion'].'</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>-->
        </div>
        <!--este es FIN de input buscador-->

        <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
        
        
    </div>
    <!---------------- BOTONES --------->
<!--    <div class="col-md-4">
        <div class="box-tools text-center">
            <a onclick="imprimir_producto()" class="btn btn-primary btn-foursquarexs"><font size="5" title="Imprimir Producto"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
        </div>
    </div>-->
    <!---------------- FIN BOTONES --------->
</div>
    

<div class="row">
    <div class="col-md-12">
        
        <div class="box">
                 
            <div class="box-body  table-responsive">
                
               <table class="table table-condensed" id="mitabla" role="table">
                    <thead role="rowgroup">

                        <tr role="row">
                            <th  role="columnheader" >#</th>
                            <th  role="columnheader" >PRODUCTO</th>
                            <th  role="columnheader" >CODIGO</th>
                            <th  role="columnheader" >SALDO</th>
                            <th  role="columnheader" >ULTIMO<br>COSTO</th>
                            <th  role="columnheader" >MND</th>
                            <th  role="columnheader" >CATEGORIA</th>
                            <th  role="columnheader" class="no-print" >PROVEEDOR</th>
                            <!--<th  role="columnheader" class="no-print">ESTADO</th>-->
                    
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados" role="rowgroup">
                                           
                    </tbody>
                </table>
                
            </div>
            <!-- pagination all... -->
        </div>
        
    </div>
</div>

<!------------------------ moda proveedores ------------------->
<!-- Button trigger modal -->
<div hidden>
    
<button type="button" class="btn btn-primary no-print" data-toggle="modal" data-target="#modalcompras" id="boton_compras" >
  HISTORIAL DE COMPRAS
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalcompras" tabindex="-1" role="dialog" aria-labelledby="modalcomprasLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <!--<h5 class="modal-title" id="modalcomprasLabel"><fa class="fa fa-cart-down"></fa> INGRESOS POR ARTICULO</h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <fa class="fa fa-search"></fa> <b>HISTORIAL DE COMPRAS</b> 
      </div>
      <div class="modal-body" id="tabla_historial">
<!--          <table class="table" id="mitabla">
              <tr>
                  <th style="padding-bottom: 0; padding-top: 0;">#</th>
                  <th style="padding-bottom: 0; padding-top: 0;">PROVEEDOR</th>
                  <th style="padding-bottom: 0; padding-top: 0;">FECHA COMPRA</th>
                  <th style="padding-bottom: 0; padding-top: 0;">CANT.</th>
                  <th style="padding-bottom: 0; padding-top: 0;">PREC.<br>COMPRA Bs</th>
              </tr>
              <tbody id="tablacompras">
                  
              </tbody>
          </table>
          -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<!------------------------ Fin Moda proveedores ------------------->
