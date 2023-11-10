<script rel="stylesheet" type="text/css" href="<?php echo base_url('resources/plugins/datatables/jquery.dataTables.css'); ?>">  </script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url('resources/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>

<?php //echo base_url('resources/plugins/datatables/jquery.dataTables.min.css'); ?>
<!--<br>-->
<?php //echo base_url('resources/plugins/datatables/jquery.dataTables.min.js'); ?>


<script src="<?php echo base_url('resources/js/responsable.js'); ?>" type="text/javascript"></script>
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
<script type="text/javascript">
    function buscarproveedor(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13){
            var base_url = document.getElementById('base_url').value;
            var filtro = document.getElementById('filtrar').value;
            location.href=base_url+"proveedor/buscarproveedor/"+filtro;
        }
    }
    
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<style type="text/css">
    
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
    
    div.dataTables_length {
    padding-left: 2em;
    }
    div.dataTables_length,
    div.dataTables_filter {
        padding-top: 0.55em;
    }
</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!--<link href="<?php echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<!-------------------------------------------------------->
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
                <u>PROVEEDORES</u><br><br>
                <!--<span style="font-size: 9pt">INGRESOS DIARIOS</span><br>-->
                <span class="lahora" id="fhimpresion"></span><br>
                <span style="font-size: 8pt;" id="busquedaavanzada"></span>
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
<div class="row">
        <div class="col-md-6">


        <!--este es INICIO del BREADCRUMB buscador-->
<!--        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/dashb')?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo site_url('cliente')?>">Clientes</a></li>
                <li class="active"><b>Proveedores: </b></li>
                <input style="border-width: 0; background-color: #DEDEDE" id="pillados" type="text"  size="5" value="-<?php echo $total ?>-" readonly="true">
            </ol>
        </div>-->
        <div class="box-header">
            <font size='4' face='Arial'><b>Proveedores</b></font>
            <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($proveedor); ?></font> 
        </div>

        <!--este es FIN del BREADCRUMB buscador-->
 
        <!--este es INICIO de input buscador-->
            <div class="col-md-12">
                
<!--            ------------------- parametro de buscador --------------------->
                       
                  <div class="input-group">
                      <span class="input-group-addon"  style="background-color: lightgray;"> 
                        Buscar 
                      </span>           
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código, serie" onkeypress="validar(event,4)">
                      <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultados(1)" title="Buscar"><span class="fa fa-search" aria-hidden="true"></span></div>
                  </div>
            
<!--            ------------------- fin parametro de buscador ------------------- -->
            
            </div>
            
        <!--este es FIN de input buscador-->

        <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
        
        
    </div>
    <!---------------- BOTONES --------->
    <div class="col-md-6">
        
            <div class="box-tools no-print">
        <center>            
            <a href="<?php echo site_url('proveedor/add'); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Registrar</small></a>
            <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="fechadecompra('and 1')" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
            <?php
            if($rol[113-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" onclick="imprimir_proveedor()" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
            <?php } ?>
            <!--<a href="" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>-->            
        </center>            
    </div>
    </div>
    <!---------------- FIN BOTONES --------->
</div>
<div class="row">
    <div class="col-md-12">
        
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed display" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Nit</br>
                            Razón</th>
                            <th>Estado</th>
                            <!--<th>Autorización</th>-->
                            <th class="no-print"></th>
                        </tr>                        
                    </thead>
                        
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($proveedor as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                            <td><?php echo $cont; ?></td>
                            <td><div id="horizontal">
                                    <div>
                                        <?php if($p['proveedor_foto']){
                                                    ?>
                                                    <a class="btn  btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $cont; ?>" style="padding: 0px;">
                                                        <?php
                                                        echo '<img src="'.site_url('/resources/images/proveedores/'.$p['proveedor_foto']).'" style="width:60px;height:60px; margin-right: 5px;" />';
                                                        ?>
                                                    </a>
                                                    <?php }
                                                    else{
                                                       echo '<img style src="'.site_url('/resources/images/usuarios/thumb_default.jpg').'" />'; 
                                                    }
                                                    ?>
                                                     <!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->
                                    <div class="modal fade" id="mostrarimagen<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $cont; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <font size="3"><b><?php echo $p['proveedor_nombre']; ?></b></font>
                                          </div>
                                            <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <?php echo '<img style="max-height: 100%; max-width: 100%" src="'.site_url('/resources/images/proveedores/'.$p['proveedor_foto']).'" />'; ?>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                    <!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->
                                    </div>
                                    <div><?php
                                        echo "<font size='3' face='Arial'><b>".$p['proveedor_nombre']."</b></font><sub> [".$p['proveedor_id']."]</sub><br>";
                                        echo "<b>CODIGO: </b>".$p['proveedor_codigo']."<br>";
                                        echo "<b>DIRECC.: </b>".$p['proveedor_direccion']."<br>";
                                        echo "<b>EMAIL: </b>".$p['proveedor_email'];
                                        ?>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $p['proveedor_contacto']; ?></br>
                            <b>TELEF.:</b> <?php echo $p['proveedor_telefono']."-".$p['proveedor_telefono2']; ?></td>
                            <td><?php echo $p['proveedor_nit']; ?></br>
                            <?php echo $p['proveedor_razon']; ?></td>
                            <td style="background-color: #<?php echo $p['estado_color']; ?>"><?php echo $p['estado_descripcion']; ?></td>

                            <!--<td><?php //echo $p['proveedor_autorizacion']; ?></td>-->
                            <td class="no-print">
                            <a href="<?php echo site_url('proveedor/edit/'.$p['proveedor_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php echo site_url('proveedor/remove/'.$p['proveedor_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                            </td>
                    </tr>
                    <?php } ?>
                    </tbody>
<!--                    <tfoot>
                        <tr>
                            <th>#</th>

                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Nit</br>
                            Razón</th>
                            <th>Estado</th>
                            <th>Autorización</th>
                            <th class="no-print"></th>
                        </tr> 
                    </tfoot>-->
                </table>
                                
            </div>
<!--            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>-->
        </div>
        <?php
            if($a =="1"){
                ?>
                <a href="<?php echo site_url('proveedor'); ?>" class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i> Atras</a>
            <?php
            }
            ?>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#mitabla').DataTable( {
        "pagingType": "full_numbers",
         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "todos"]]
    } );
} );
    
    
//    $(document).ready( function () {
//    $('#mitabla').DataTable({
//      "searching": false
////      "paging": true,
////      "lengthChange": false,
////      "searching": false,
////      "ordering": true,
////      "info": true,
////      "autoWidth": false
//    });
//} );
//  $(function () {
//    $("#mitabla").DataTable();
//    $('#example2').DataTable({
//      "paging": true,
//      "lengthChange": false,
//      "searching": false,
//      "ordering": true,
//      "info": true,
//      "autoWidth": false
//    });
//  });
</script>