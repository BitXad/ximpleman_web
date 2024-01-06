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
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<?php

$ancho_boton = $parametros["parametro_anchoboton"];
$alto_boton = $parametros["parametro_altoboton"];
$ancho_imagen = $parametros["parametro_anchoimagen"];
$alto_imagen = $parametros["parametro_altoimagen"];
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
                        
                        foreach($mesa as $m){ 
                            
                                    if(!is_null($m["mesa_descripcion"])){
                                    
                                                if($m["mesa_descripcion"]!="-"){
                                                    $descripcion =  $m["mesa_descripcion"];
                                                }else{ 
                                                    $descripcion = "";
                                                }
                                            
                                    }else{ $descripcion="";} ?>
                
                
                            <div class="col-md-2">
                              
                                
                                
                                <?php if($m["estado_id"]==1){ ?>
                                <button class="btn btn-default"  width="{$ancho_boton}px" height="{$alto_boton}px" style="font-size:<?= $tamanio_fuente?>;">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconolibre"]); ?>" width="{$ancho_imagen}px" height="{$alto_imagen}px"/>
                                    <br><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?>                                    
                                </button>
                                
                                <?php } ?>
                                
                                <?php if($m["estado_id"]==2){ ?>
                                <button class="btn btn-default"  width="{$ancho_boton}px" height="{$alto_boton}px" style="font-size:<?= $tamanio_fuente?>;">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconoocupada"]); ?>" width="{$ancho_imagen}px" height="{$alto_imagen}px"/>
                                    <br><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?>    
    
                                </button>
                                
                                <?php } ?>

                                
                                <?php if(!$m["estado_id"]==3){ ?>
                                <button class="btn btn-default"  width="{$ancho_boton}px" height="{$alto_boton}px" style="font-size:<?= $tamanio_fuente?>;">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconomantenimiento"]); ?>" width="{$ancho_imagen}px" height="{$alto_imagen}px"/>
                                    <br><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?>    
    
                                </button>
                                
                                <?php } ?>
                                
          
                                
                                <?php if(!$m["estado_id"]==37){ ?>
                                
                                <button class="btn btn-default"  width="{$ancho_boton}px" height="{$alto_boton}px" style="font-size:<?= $tamanio_fuente?>;">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconoreservada"]); ?>" width="{$ancho_imagen}px" height="{$alto_imagen}px"/>
                                    <br><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?>    
    
                                </button>
                                
                                <?php } ?>
                                
                            </div>
                
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
                    </center>
                </div>
                    
                <div class="box-body table-responsive">



                </div>
            </div>
        </div>     
    </div>
    
    </div>
    
</div>