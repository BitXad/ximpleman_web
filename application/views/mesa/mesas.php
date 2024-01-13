<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/mesa.js'); ?>" type="text/javascript"></script>

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
button{
  padding:0;
  border: 0;
}
</style>   
    

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<?php

$ancho_boton = $parametros["parametro_anchoboton"]."px";
$alto_boton = $parametros["parametro_altoboton"]."px";
$ancho_imagen = $parametros["parametro_anchoimagen"]."px";
$alto_imagen = $parametros["parametro_altoimagen"]."px";
$tamanio_fuente = $parametros["parametro_tamanioletrasboton"];


?>

<div class="box-header">
    <font size='4' face='Arial'><b>Registro de Mesas</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($mesa); ?></font>
<!--    <div class="box-tools no-print">
        <a href="<?php echo site_url('mesa/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Mesa</a> 
    </div>-->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <!--------------------- parametro de buscador --------------------->
            
                <select id="select_categoria" class="form-control">
                    
                    <option value="0">-- TODAS --</option>
                    <?php foreach ($categorias as $c){ ?>
                            <option value="<?php echo $c["categoriamesa_nombre"]; ?>"><?php echo $c["categoriamesa_nombre"]; ?></option>
                    <?php } ?>
                    
                </select>
            
            <!--------------------- fin parametro de buscador --------------------->
        </div>
        
        <div class="col-md-8">
            <!--------------------- parametro de buscador --------------------->
                      <div class="input-group"> <span class="input-group-addon">Buscar</span>
                        <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre de la mesa..">
                      </div>
                <!--------------------- fin parametro de buscador --------------------->
        </div>
</div>

    <div class="row">
        
    <div class="col-md-8">
        <div class="box">
            <div class="box-body table-responsive">
                    <?php
                        $cont = 0;
                        $descipcion = 0;
                        $estilo = "padding:0; border:0;";
                        
                        foreach($mesa as $m){
                            
                                    if(!is_null($m["mesa_descripcion"])){
                                    
                                            if($m["mesa_descripcion"]!="-"){
                                                $descripcion =  $m["mesa_descripcion"];
                                            }else{ 
                                                $descripcion = "";
                                            }
                                            
//                                    }else{ $descripcion="";} ?>
                
                
                            <!--<div class="col-md-2">-->
                              
                                
                                
                                <?php if($m["estado_id"]==38){ ?>
                                <button class="btn btn-default btn-sq-lg" style="width:<?= $ancho_boton ?>;  !important;  height:<?= $alto_boton ?>; font-size:<?= $tamanio_fuente?>; <?= $estilo ?>" onclick="modal_mesa(<?= $m["mesa_id"]; ?>)">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconolibre"]); ?>" width="<?= $ancho_imagen?>" height="<?= $alto_imagen ?>"/>
                                    <br><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?>                                    
                                </button>
                                
                                <?php } ?>
                                
                                <?php if($m["estado_id"]==39){ ?>
                                <button class="btn btn-default btn-sq-lg" style="width:<?= $ancho_boton ?>;  !important;  height:<?= $alto_boton ?>; font-size:<?= $tamanio_fuente?>;  <?= $estilo ?>" onclick="mostrar_pedido(<?= $m["mesa_id"]; ?>)">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconoocupada"]); ?>" width="<?= $ancho_imagen?>" height="<?= $alto_imagen ?>"/>
                                    <br><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?>    
    
                            <!--<label class="btn btn-xs btn-facebook"><?php echo "<b>".$m["mesa_nombre"]."</b>" ?></label>-->
                                </button>
                                
                                <?php } ?>
                                <?php if($m["estado_id"]==40){ ?>
                                
                                <button class="btn btn-default btn-sq-lg" style="width:<?= $ancho_boton ?>;  !important;  height:<?= $alto_boton ?>; font-size:<?= $tamanio_fuente?>;  <?= $estilo ?>" onclick="modal_mesa(<?= $m["mesa_id"]; ?>)">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconoreservada"]); ?>" width="<?= $ancho_imagen?>" height="<?= $alto_imagen ?>"/>
                                    <br><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?>    
    
                                </button>
                                
                                <?php } ?>

                                
                                <?php if($m["estado_id"]==41){ ?>
                                <button class="btn btn-default btn-sq-lg"  style="width:<?= $ancho_boton ?>;  !important;  height:<?= $alto_boton ?>; font-size:<?= $tamanio_fuente?>;  <?= $estilo ?>" onclick="modal_mesa(<?= $m["mesa_id"]; ?>)">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconomantenimiento"]); ?>" width="<?= $ancho_imagen?>" height="<?= $alto_imagen ?>"/>
                                    <br><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?>
    
                                </button>
                                
                                <?php } ?>
                                
          
                                
                                
                            <!--</div>-->
                
                    <?php  } ?>
                    <?php  } ?>

                                
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="box">
                
                <div class="box-header">
                    <center>
                        <b>DETALLE DE CONSUMO</b>
                        <b id="numero_pedido"></b>
                        
                    </center>
                </div>
                    
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-md-12" id="datos_pedido">
                        
                        
                        </div>
                    </div>


                </div>
            </div>
        </div>     
    </div>
    
    </div>
    
</div>

<!-- modal opciones -->
<!-- Button trigger modal -->
<div hidden="true">
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOpciones" id="boton_opciones">
        Opcion mesas
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalOpciones" tabindex="-1" role="dialog" aria-labelledby="modalOpcionesTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><b>OPCIONES</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        
                        <div class="col-md-6" hidden="">
                        <input type="text" id="mesa_id" value="0"/>
                    </div>
                        
                    <div class="col-md-6">
                            <label for="estado_id" class="control-label">Estado</label>
                            <div class="form-group">
                                    <select name="estado_id" class="form-control">
                                            <!--<option value="">- ESTADO -</option>-->
                                            <?php 
                                            foreach($all_estado as $estado)
                                            {
                                             
                                                
                                                    $selected = ($estado['estado_id'] == $cliente['estado_id']) ? ' selected="selected"' : "";
                                                    echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                                                
                                            } 
                                            ?>
                                    </select>
                            </div>
                    </div>

          
                    <div class="col-md-6">
                        <label for="usuario_clave" class="control-label">Contraseña</label>
                        <div class="form-group">
                            <input type="password" name="usuario_clave" value="" class="form-control" id="usuario_clave"  />
                                <span class="text-danger"><?php echo form_error('usuario_clave');?></span>
                        </div>
                    </div>
          
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="verificar_usuario()">Aceptar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
