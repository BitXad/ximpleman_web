<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones_servicio.js'); ?>" type="text/javascript"></script>
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
    #masg{
        font-size: 12px;
    }
    td div div{
        
    }
</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="eltipo_cliente" id="eltipo_cliente" value='<?php echo json_encode($all_tipo_cliente); ?>' />
<input type="hidden" name="lacategoria_cliente" id="lacategoria_cliente" value='<?php echo json_encode($all_categoria_cliente); ?>' />
<input type="hidden" name="lacategoria_clientezona" id="lacategoria_clientezona" value='<?php echo json_encode($all_categoria_clientezona);  ?>' />
<input type="hidden" name="elusuario" id="elusuario" value='<?php echo json_encode($all_usuario);  ?>' />
<!-------------------------------------------------------->
<div class="box-header">
                <h3 class="box-title">Cliente</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('cliente/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        
        <!--este es INICIO de input buscador-->
            <div class="input-group">
                      <span class="input-group-addon"> 
                        Buscar 
                      </span>           
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, ci, nit" onkeypress="validar2(event,1)">
            </div>
        <!--este es FIN de input buscador-->
        <!-- *********** INICIO de BUSCADOR select y productos encontrados ****** -->
        <div class="container" id="categoria">
            <span class="badge btn-danger">Clientes encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
        </div>
<!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Negocio</th>
                        <th>Dirección</th>
                        <th>Coordenadas</th>
                        <th>Email</th>
                        <th>Aniversario</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th>Prevendedor</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php $i = 1;
                    $cont = 0;
                          foreach($cliente as $c){;
                                  $cont = $cont+1;
                    ?>
                    <tr>
						<td><?php echo $cont ?></td>
                                                <td><div id="horizontal">
                                                <div id="contieneimg">
                                                    <?php
                                                    $mimagen = "thumb_".$c['cliente_foto'];
                                                    echo '<img src="'.site_url('/resources/images/clientes/'.$mimagen).'" />';
                                                    ?>
                                                    </div>
                                                    <div>
                                                        <?php echo "<b id='masg'>".$c['cliente_nombre']."</b><br>";
                                                              echo "<b>Codigo: </b>".$c['cliente_codigo']."<br>";
                                                              echo "<b>C.I.: </b>".$c['cliente_ci']."<br>";
                                                              echo "<b>Tel.: </b>".$c['cliente_telefono']."-".$c['cliente_celular'];
                                                        ?>
                                                    </div>
                                                 </div>
                                                </td>
                                                <td>
                                                    <div style="white-space: nowrap;"><?php echo $c['cliente_nombrenegocio']."<br>"; ?></div>
                                                    <div><?php
                                                           echo "<b>Nit: </b>".$c['cliente_nit']."<br>";
                                                           echo "<b>Razon: </b>".$c['cliente_razon']."<br>";
                                                           $escategoria_clientezona = "";
                                                            if($c['categoriacliezona_id'] == null || $c['categoriacliezona_id'] == 0 || $c['categoriacliezona_id']-1 > count($all_categoria_clientezona)){ 
                                                                $escategoria_clientezona = "No definido";
                                                            }else{
                                                                $escategoria_clientezona = $all_categoria_clientezona[$c['categoriacliezona_id']-1]['categoriacliezona_descripcion'];
                                                            }
                                                           echo "<b>Zona: </b>".$escategoria_clientezona;
                                                    ?>
                                                    </div>
                                                </td>
						<td><?php echo $c['cliente_direccion']; ?></td>
                                                <td><?php echo "<b>Lat.: </b>".$c['cliente_latitud']."<br>";
                                                          echo "<b>Lon.: </b>".$c['cliente_longitud'];
                                                    ?>
                                                </td>
						<td><?php echo $c['cliente_email']; ?></td>
						<td><?php echo $c['cliente_aniversario']; ?></td>
						<?php
                                                $estipo_cliente = "";
                                                if($c['tipocliente_id'] == null || $c['tipocliente_id'] == 0 || $c['tipocliente_id']-1 > count($all_tipo_cliente)){ 
                                                    $estipo_cliente = "No definido";
                                                }else{
                                                    $estipo_cliente = $all_tipo_cliente[$c['tipocliente_id']-1]['tipocliente_descripcion'];
                                                }
                                                $escategoria_cliente = "";
                                                if($c['categoriaclie_id'] == null || $c['categoriaclie_id'] == 0 || $c['categoriaclie_id']-1 > count($all_categoria_cliente)){ 
                                                    $escategoria_cliente = "No definido";
                                                }else{
                                                    $escategoria_cliente = $all_categoria_cliente[$c['categoriaclie_id']-1]['categoriaclie_descripcion'];
                                                }
                                                $esusuario = "";
                                                if($c['usuario_id'] == null || $c['usuario_id'] == 0 || $c['usuario_id']-1 > count($all_usuario)){ 
                                                    $esusuario = "No definido";
                                                }else{
                                                    $esusuario = $all_usuario[$c['usuario_id']-1]['usuario_nombre'];
                                                }
                                                ?>
						<td><?php echo $estipo_cliente; ?></td>
						<td><?php echo $escategoria_cliente; ?></td>
						<td><?php echo $esusuario; ?></td>
                                                <td style="background-color: #<?php echo $c['estado_color']; ?>"><?php echo $c['estado_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('cliente/edit/'.$c['cliente_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
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
                                               ¿Desea eliminar al Cliente <b> <?php echo $c['cliente_nombre']; ?></b> ?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('cliente/remove/'.$c['cliente_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                    <!------------------------ FIN modal para confirmar eliminación ------------------->
                    </td>
                    </tr>
                   
                    <?php } ?>
                </table>
                <?php if($err==2){ ?>
                <script>alert("La imagen es demasiado grande ")</script>
                <?php } ?>
                <?php if($err==1){ ?>
                <script>alert("No se puede subir una imagen con ese formato ")</script>
                <?php } ?>
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
    alert("El Cliente no se puede Eliminar \n porque pertenece a alguna transacción");
</script>';
?>