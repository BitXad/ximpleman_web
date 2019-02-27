<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_producto.js'); ?>" type="text/javascript"></script>
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
<style type="text/css">
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
        font-size: 12px;
    }
</style>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="lacategoria" id="lacategoria" value='<?php echo json_encode($all_categoria); ?>' />
<input type="hidden" name="lapresentacion" id="lapresentacion" value='<?php echo json_encode($all_presentacion); ?>' />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($all_moneda);  ?>' />

<div class="row micontenedorep" style="display: none" id="cabeceraprint">
    <div id="cabizquierda">
        <?php
        echo $empresa[0]['empresa_nombre']."<br>";
        echo $empresa[0]['empresa_direccion']."<br>";
        echo $empresa[0]['empresa_telefono'];
        ?>
        </div>
        <div id="cabcentro">
            <div id="titulo">
                <u>PRODUCTOS</u><br><br>
                <!--<span style="font-size: 9pt">INGRESOS DIARIOS</span><br>-->
                <span class="lahora" id="fhimpresion"></span><br>
                <span style="font-size: 8pt;" id="busquedacategoria"></span>
                <!--<span style="font-size: 8pt;">PRECIOS EXPRESADOS EN MONEDA BOLIVIANA (Bs.)</span>-->
            </div>
        </div>
        <div id="cabderecha">
            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

        </div>
        
</div>
<br>
<div class="row no-print">
        <div class="col-md-9">


        <!--este es INICIO del BREADCRUMB buscador-->
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <!--<li><a href="<?php echo site_url('cliente')?>">Clientes</a></li>-->
                <li class="active"><b>Productos: </b></li>
                <input style="border-width: 0; background-color: #DEDEDE" id="encontrados" type="text"  size="5"  readonly="true">
            </ol>
        </div>
        <!--este es FIN del BREADCRUMB buscador-->
 
        <!--este es INICIO de input buscador-->
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="input-group">
                    <span class="input-group-addon"> Buscar </span>           
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código, código de barras, marca, industria" onkeypress="buscarproducto(event)" autocomplete="off">
                </div>
            </div>
            <div class="col-md-3">
                
                <div class="box-tools">
                    <select name="categoria_id" class="btn-primary btn-sm" id="categoria_id" onchange="tablaresultadosproducto(2)">
                        <option value="" disabled selected >-- BUSCAR POR CATEGORIAS --</option>
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
            <div class="col-md-2">
                
                <div class="box-tools">
                    <select name="estado_id" class="btn-primary btn-sm" id="estado_id" onchange="tablaresultadosproducto(2)">
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
            </div>
           <!-- <div class="col-md-3">
                
                <div class="box-tools">
                    <select name="estado_id" class="btn-primary btn-sm" id="estado_id">
                        <option value="">-- ESTADO --</option>
                        <?php 
                     /*   foreach($all_estado as $estado)
                        {
                                $selected = ($estado['estado_id'] == $producto['estado_id']) ? ' selected="selected"' : "";

                                echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                        } */
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
    <div class="col-md-3">
        
            <div class="box-tools">
        <center>            
            <a href="<?php echo site_url('producto/add'); ?>" class="btn btn-success btn-foursquarexs" title="Registrar nuevo Producto"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Registrar</small></a>
            <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="tablaresultadosproducto(3)" title="Mostrar todos los Productos" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
            <a onclick="imprimir_producto()" class="btn btn-info btn-foursquarexs"><font size="5" title="Imprimir Producto"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
            <!--<a href="" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>-->            
        </center>            
    </div>
    </div>
    <!---------------- FIN BOTONES --------->
</div>
    

<div class="row">
    <div class="col-md-12">
        
        <div class="box">
                 
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitablaimpresion" role="table">
               <!--<table role="table">-->
                    <thead role="rowgroup">
                        <tr role="row">
                            <th  role="columnheader" >#</th>
                            <th  role="columnheader" >Nombre</th>
                            <th  role="columnheader" >Categoria|<br>Presentación</th>
                            <th  role="columnheader" >Código|<br>Cód. Barra</th>
                            <th  role="columnheader" >Precio</th>
                            <th  role="columnheader" >Moneda</th>
                            <th  role="columnheader" class="no-print">Estado</th>
                            <th  role="columnheader" class="no-print"></th>
                    
                    </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados" role="rowgroup">


                    <?php
                   /* $cont = 0;
                          foreach($producto as $p){;
                                 $cont = $cont+1; ?>
                    <tr role="row">
						<td role="cell"><?php echo $cont ?></td>
                                                <td role="cell">
                                                    <div id="horizontal">
                                                        <div id="contieneimg">
                                                   <?php
                                                   //$mimagen = str_replace(".", "_thumb.", $p['producto_foto']);
                                        
//                                                   echo '<img src="'.site_url('/resources/images/productos/'."thumb_".$p['producto_foto']).'" class="img img-circle" width="50" height="50"/>'; ?>
                                                   
                                                                                                        <?php
                                                    $mimagen = "thumb_".$p['producto_foto'];
                                                    //echo '<img src="'.site_url('/resources/images/clientes/'.$mimagen).'" />';
                                                    if($p['producto_foto']){
                                                    ?>
                                                    <a class="btn  btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $p['producto_id']; ?>" style="padding: 0px;">
                                                        <?php
                                                        echo '<img src="'.site_url('/resources/images/productos/'.$mimagen).'" />';
                                                        ?>
                                                    </a>
                                                    <?php }
                                                    else{
                                                       echo '<img style src="'.site_url('/resources/images/productos/thumb_default.jpg').'" />'; 
                                                    }
                                                    ?>
                                                            
                                                    </div>
                                                   <div>
                                                       <b id="masgrande"><?php echo $p['producto_nombre']; ?></b><br>
                                        <?php echo $p['producto_unidad']; ?> | <?php echo $p['producto_marca']; ?> | <?php echo $p['producto_industria']; ?>
                                                    </div>
                                                  </div>
                                                </td>
						<td role="cell"><?php
                                                $escategoria="";
                                                if($p['categoria_id'] == null || $p['categoria_id'] == 0 || $p['categoria_id']-1 > count($all_categoria)){ 
                                                    $escategoria = "No definido";
                                                }else{
                                                    $escategoria = $all_categoria[$p['categoria_id']-1]['categoria_nombre'];
                                                }
                                                $espresentacion="";
                                                if($p['presentacion_id'] == null || $p['presentacion_id'] == 0 || $p['presentacion_id']-1 > count($all_presentacion)){ 
                                                    $espresentacion = "No definido";
                                                }else{
                                                    $espresentacion = $all_presentacion[$p['presentacion_id']-1]['presentacion_nombre'];
                                                }
                                                $esmoneda="";
                                                if($p['moneda_id'] == null || $p['moneda_id'] == 0 || $p['moneda_id']-1 > count($all_moneda)){ 
                                                    $esmoneda = "No definido";
                                                }else{
                                                    $esmoneda = $all_moneda[$p['moneda_id']-1]['moneda_descripcion'];
                                                }
                                                echo "<b>Cat.: </b>".$escategoria;  echo "<br><b>Pres.: </b>".$espresentacion; ?></td>
						<td><?php echo $p['producto_codigo']; echo "<br>".$p['producto_codigobarra']; ?></td>
						
						<td><?php echo "<b>Compra: </b>".$p['producto_costo']; echo "<br><b>Venta: </b>".$p['producto_precio']; ?></td>
						<td><?php echo "<b>Moneda: </b>".$esmoneda."<br>"; echo "<b>T. Cambio: </b>".$p['producto_tipocambio']; ?></td>
						<td><?php echo $p['producto_comision']; ?></td>
                                                <td style="background-color: #<?php echo $p['estado_color']; ?>"><?php echo $p['estado_descripcion']; ?></td>
						<td>
                                <a href="<?php echo site_url('producto/edit/'.$p['miprod_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                                <a href="<?php echo site_url('imagen_producto/catalogoprod/'.$p['miprod_id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-image"></span></a>
                                <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $cont; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                                    <div class="modal fade" id="myModal<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $cont; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b> <span class="fa fa-trash"></span></b>
                                               ¿Desea eliminar el Producto <b> <?php echo $p['producto_nombre']; ?></b> ?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('producto/remove/'.$p['miprod_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                    <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                    <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    
                    
                    <!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->
                                    <div class="modal fade" id="mostrarimagen<?php echo $p['producto_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $p['producto_id']; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <font size="3"><b><?php echo $p['producto_nombre']; ?></b></font>
                                          </div>
                                            <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <?php echo '<img style="max-height: 100%; max-width: 100%" src="'.site_url('/resources/images/productos/'.$p['producto_foto']).'" />'; ?>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                    <!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->                  

                    
                    <?php } */ ?>                                            
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
<?php
if($a == 1)
echo '<script type="text/javascript">
    alert("El Producto no puede ser ELIMINADO, \n porque tienen transacciones realizadas");
</script>';
?>