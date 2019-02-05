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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="lacategoria" id="lacategoria" value='<?php echo json_encode($all_categoria); ?>' />
<input type="hidden" name="lapresentacion" id="lapresentacion" value='<?php echo json_encode($all_presentacion); ?>' />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($all_moneda);  ?>' />

    <div class="box-header">
                <h3 class="box-title">Productos</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('producto/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
    </div>

<div class="row">
    <div class="col-md-12">
        
        <!--este es INICIO de input buscador-->
        <div class="input-group">
            <span class="input-group-addon"> 
                Buscar 
            </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código, código de barras" onkeypress="buscarproducto(event)">
        </div>
        <!--este es FIN de input buscador-->
        <div class="container" id="categoria">
                <span class="badge btn-danger">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
        <div class="box">
           
            
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
               <!--<table role="table">-->
                    <thead role="rowgroup">
                        <tr role="row">
                            <th  role="columnheader" >N°</th>
                            <th  role="columnheader" >Nombre</th>
                            <th  role="columnheader" >Categoria|<br>Presentación</th>
                            <th  role="columnheader" >Código|<br>Cód. Barra</th>
                            <th  role="columnheader" >Precio</th>
                            <th  role="columnheader" >Moneda</th>
                            <th  role="columnheader" >Comision</th>
                            <th  role="columnheader" >Estado</th>
                            <th  role="columnheader" >Operaciones</th>
                    
                    </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados" role="rowgroup">


                    <?php
                    /*
                    $cont = 0;
                          foreach($producto as $p){;
                                 $cont = $cont+1; ?>
                    <tr role="row">
						<td role="cell"><?php echo $cont ?></td>
                                                <td role="cell">
                                                    <div id="horizontal">
                                                        <div id="contieneimg">
                                                   <?php
                                                   //$mimagen = str_replace(".", "_thumb.", $p['producto_foto']);
                                        
                                                   echo '<img src="'.site_url('/resources/images/productos/'."thumb_".$p['producto_foto']).'" class="img img-circle" width="50" height="50"/>'; ?>
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
    alert("El Producto no se puede Eliminar \n porque pertenece a alguna transacción");
</script>';
?>