<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
<!----------------------------- script buscador --------------------------------------->
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
<div class="box-header">
    <font size='4' face='Arial'><b>C&oacute;digos de Productos y Servicios</b></font>
    <div class="box-tools no-print">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
        </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CODIGO ACTIVIDAD</th>
                            <th>CODIGO PRODUCTO</th>
                            <th>DESCRIPCION PRODUCTO</th>
                            <th>NANDINA</th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php 
                        $i=1;
                        foreach ($datos as $sincronizacion) {?>
                            <tr>
                                <td><?= $i ?></td>
                                <td style="text-align: center;"><?php 
                                        echo $sincronizacion['prodserv_codigoactividad']; 
                                        
                                        if($sincronizacion['prodserv_codigoactividad']==$dosificacion["dosificacion_actividad"])
                                                    echo "<small style='color:red;'><br>PRINCIPAL<small>";
                                        else
                                                    echo "<small style='color:blue;'><br>SECUNDARIA<small>";
                                        
                                    ?>                                
                                </td>
                                <td style="text-align: center;"><?= $sincronizacion['prodserv_codigoproducto']; ?></td>
                                <td><?= $sincronizacion['prodserv_descripcion'] ?></td>
                                <td><?= $sincronizacion['prodserv_nandina'] ?></td>
                                <td><button class="btn btn-info btn-xs" onclick="cargar_datos(<?= $sincronizacion['prodserv_codigoactividad'] ?>,<?= $sincronizacion['prodserv_codigoproducto'] ?>)"><fa class="fa fa-bomb"> </fa> Homologar</button></td>
                            </tr>
                        <?php
                            $i++; 
                        }
                    ?>
                    </tbody>
                </table>                                
            </div>
            <a href="<?= site_url('sincronizacion/') ?>" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>


<div>
    <button type="button" id="boton_modalhomologacion" class="btn btn-primary" data-toggle="modal" data-target="#modalpaquetes" >
      ENVIO PAQUETES
    </button>
    
</div>

<div class="modal fade" id="modalpaquetes" tabindex="-1" role="dialog" aria-labelledby="modalpaquetes" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">HOMOLOGACIÓN DE PRODUCTOS</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="row" id='loader2'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    <label for="codigo_evento" class="control-label"><span class="text-danger">*</span>Código Evento</label>
<!--                    <div class="form-group">
                        <input type="text" name="codigo_evento" class="form-control" id="codigo_evento" />
                    </div>
-->                    
                    <select name="categoria_id" class="form-control" id="categoria_id">
                        <option value="00">- SELECCIONAR CATEGORIA -</option>
                        <option value="0">- APLICAR A TODAS LAS CATEGORIAS -</option>
                        <?php 
                            foreach($categorias as $categoria){ ?>
                                <option value="<?php echo $categoria['categoria_id']; ?>">    
                                    <?php echo $categoria['categoria_nombre']; ?>
                                </option>
                        <?php    } ?>
                            
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Codigo Actividad</label>
                    <div class="form-group">
                        <input type="text" name="codigo_actividad" value="00" class="form-control" id="codigo_actividad" readonly/>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Codigo Producto</label>
                    <div class="form-group">
                        <input type="text" name="codigo_producto" value="00" class="form-control" id="codigo_producto" readonly/>
                    </div>
                </div>
                
                    <div class="col-md-4">
                        <label for="producto_unidad" class="control-label">* Unidad</label>
                        <div class="form-group">
                            <select name="producto_unidad" id="producto_unidad" class="form-control">
                                <option value="">- UNIDAD -</option>
                                <?php 
                                foreach($unidades as $unidad)
                                {
                                    //$selected = ($unidad['unidad_id'] == $producto['producto_unidad']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$unidad['unidad_id'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
<!--                <div class="col-md-4">
                    <label for="cant_fact" class="control-label"><span class="text-danger">*</span>Cantidad Facturas</label>
                    <div class="form-group">
                        <input type="number" name="cant_fact" value="1" class="form-control" id="cant_fact" />
                    </div>
                </div>-->
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="homologar_categoria()"><fa class="fa fa-floppy-o"></fa> Actualizar Codigo</button>
                <button type="button" class="btn btn-danger" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>
                
<!--<button type="button" class="btn btn-success" onclick="finalizarventa_sin()"><fa class="fa fa-floppy-o"></fa> Envio de Paquetes</button>-->