<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/mesa.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php echo base_url('resources/js/funciones_pedido.js'); ?>"></script>-->
<link href="<?php // echo base_url('resources/css/mitablaventassimple.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablagris.css'); ?>" rel="stylesheet">

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
        $(document).ready(function () {
            (function ($) {
                $('#filtrar3').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar3 tr').hide();
                    $('.buscar3 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });    
        $(document).ready(function () {
            (function ($) {
                $('#filtrar4').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar4 tr').hide();
                    $('.buscar4 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });    

function mostrar_ocultar(){
    var x = document.getElementById('tipo_transaccion').value;
    
    if (x=='2'){ //si la transaccion es a credito
        
        document.getElementById('creditooculto').style.display = 'block';
//        var hoy = new Date();
//        var dd = hoy.getDate();
//        var mm = hoy.getMonth()+1;
//        var yyyy = hoy.getFullYear();
//        
//        dd = addZero(dd);
//        mm = addZero(mm);

        }
    else{
            document.getElementById('creditooculto').style.display = 'none';}
}



function mostrar_buscadores(){
    document.getElementById('buscador1').style.display = 'block';
    document.getElementById('categoria').style.display = 'block';
    
    //document.getElementById('filtrar4').focus();

}
        
function cerrar_ventana(){
   //window.opener.location.reload();
   window.open('', '_self', '');
    window.close();
}
</script>   




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
/*button{
  padding:0;
  border: 5px solid black;
}*/

@font-face {
  font-family: "Edwardian"; /* El nombre que le das a la fuente */
  src: url(<?php  echo base_url("resources/fonts/edwardian.ttf"); ?>); /* La ruta del archivo de la fuente */
}

/* Aplica la fuente Edwardian al botón */
titulo {
  font-family: "Edwardian"; /* El nombre de la fuente que definiste */
}

</style>   

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>

<?php if ($tipousuario_id != 1){ ?>
    <input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>
<?php } ?>

<input type="text" value='<?php echo json_encode($categoria_producto); ?>' id="categoria_producto" hidden>
<input type="text" value='<?php echo json_encode($preferencia); ?>' id="preferencias" hidden>

<input type="text" id="venta_comision" value="0" name="venta_comision"  hidden>
<input type="text" id="venta_tipocambio" value="1" name="venta_tipocambio"  hidden>

<input type="text" id="detalleserv_id" value="0" name="detalleserv_id"  hidden>
<input type="text" id="parametro_modoventas" value="<?php echo $parametro['parametro_modoventas']; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>
<!--<input type="text" id="parametro_moneda_id" value="<?php echo $parametro['moneda_id']; ?>" name="parametro_datosboton"  hidden>-->
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro['moneda_descripcion']; ?>" name="parametro_moneda_descripcion"  hidden>
<input type="text" id="parametro_datosboton" value="<?php echo $parametro['parametro_datosboton']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro['moneda_id']; ?>" name="parametro_moneda_id"  hidden>
<input type="text" id="parametro_diasvenc" value="<?php echo $parametro['parametro_diasvenc']; ?>" name="parametro_diasvenc"  hidden>
<input type="hidden" id="modificar_precioventa" value="<?php echo $rolusuario[183-1]['rolusuario_asignado']; ?>" name="modificar_precioventa">
<input type="text" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" name="tipousuario_id"  hidden>
<input type="text" id="preferencia_id" value="0" name="preferencia_id" hidden>
<input type="text" id="cliente_id" name="cliente_id" value="<?php echo $cliente[0]['cliente_id']; ?>" hidden>
<input type="text" id="cdi_codigoclasificador" name="cdi_codigoclasificador" value="<?php echo $cliente[0]['cdi_codigoclasificador']; ?>" hidden>
<input type="text" id="nit" name="nit" value="<?php echo $cliente[0]['cliente_nit']; ?>" hidden>
<input type="text" id="razon_social" name="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" hidden>
<input type="text" id="telefono" name="telefono" value="<?php echo $cliente[0]['cliente_telefono']; ?>" hidden>
<input type="text" id="tipocliente_id" name="tipocliente_id" value="<?php echo $cliente[0]['tipocliente_id']; ?>" hidden>
<input type="text" id="cliente_nombre" name="cliente_nombre" value="<?php echo $cliente[0]['cliente_nombre']; ?>" hidden>
<input type="text" id="cliente_ci" name="cliente_ci" value="<?php echo $cliente[0]['cliente_ci']; ?>" hidden>
<input type="text" id="cliente_nombrenegocio" name="cliente_nombrenegocio" value="<?php echo $cliente[0]['cliente_nombrenegocio']; ?>" hidden>
<input type="text" id="cliente_codigo" name="cliente_codigo" value="<?php echo $cliente[0]['cliente_codigo']; ?>" hidden>
<input type="text" id="cliente_direccion" name="cliente_direccion" value="<?php echo $cliente[0]['cliente_direccion']; ?>" hidden>
<input type="text" id="cliente_departamento" name="cliente_departamento" value="<?php echo $cliente[0]['cliente_departamento']; ?>" hidden>
<input type="text" id="cliente_celular" name="cliente_celular" value="<?php echo $cliente[0]['cliente_celular']; ?>" hidden>
<input type="text" id="zona_id" name="zona_id" value="<?php echo $cliente[0]['zona_id']; ?>" hidden>
<input type="text" id="cliente_complementoci" name="cliente_complementoci" value="<?php echo $cliente[0]['cliente_complementoci']; ?>" hidden>
<input type="text" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales"  hidden>
<?php
if($cliente[0]['cliente_id'] >0){
?>
<input type="text" id="codigoexcepcion" name="codigoexcepcion" value="<?php echo $cliente[0]['cliente_excepcion']; ?>" hidden>
<?php
}else{
?>
<input type="text" id="codigoexcepcion" name="codigoexcepcion" value="" hidden>  
<?php
}
//var_dump($rolusuario);
//echo $rolusuario;
?>
<input type="text" id="email" name="email" value="<?php echo $cliente[0]['cliente_email']; ?>" hidden>

<input type="text" id="rol_precioventa" value="<?php echo $rolusuario[160-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor" value="<?php echo $rolusuario[161-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor1" value="<?php echo $rolusuario[162-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor2" value="<?php echo $rolusuario[163-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor3" value="<?php echo $rolusuario[164-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor4" value="<?php echo $rolusuario[165-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_modificardetalle" value="<?php echo $rolusuario[20-1]['rolusuario_asignado']; ?>" hidden>

<input type="text" id="rol_productos" value="<?php echo $rolusuario[198-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_comandas" value="<?php echo $rolusuario[199-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_cambiomesa" value="<?php echo $rolusuario[200-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_facturar" value="<?php echo $rolusuario[201-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_modificaritem" value="<?php echo $rolusuario[202-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_eliminaritem" value="<?php echo $rolusuario[203-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_eliminarmesa" value="<?php echo $rolusuario[204-1]['rolusuario_asignado']; ?>" hidden>

<input type="text" value="<?php echo 0; ?>" id="pedido_latitud" hidden>
<input type="text" value="<?php echo 0; ?>" id="pedido_longitud" hidden>
<input type="text" id="moneda_tc" value="<?php echo $moneda['moneda_tc']; ?>" hidden>
<input type="text" id="moneda_descripcion" value="<?php echo $moneda['moneda_descripcion']; ?>" hidden>


<input type="text" id="pedido_id" value="0" hidden>
<input type="text" id="mesa_id" value="0" hidden>
<input type="text" id="ultimamesa_id" value="0" hidden>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<?php

$ancho_boton = $parametro["parametro_anchoboton"]."px";
$alto_boton = $parametro["parametro_altoboton"]."px";
$ancho_imagen = $parametro["parametro_anchoimagen"]."px";
$alto_imagen = $parametro["parametro_altoimagen"]."px";
$tamanio_fuente = $parametro["parametro_tamanioletrasboton"]."px";
$espacio_mesas = 7; //de 1 - 12 Maximo... 13 ya no funciona


?>

<div class="box-header" style="background: black; color: white; padding: 0px;">
    <center>        
        <?php $cad = $empresa[0]["empresa_nombre"]; ?>
        <titulo style="font-size: 40px;"><?php echo strtolower($cad); ?></titulo>
    </center>
</div>
    
<!--
<div class="box-header">
    <center>
        <font size='4' face='Arial'><b><?php echo $empresa[0]["empresa_nombre"]; ?></b></font>
        <br><font size='2' face='Arial'>Mesas: <?php echo sizeof($mesa); ?></font>
        <div class="box-tools no-print">
            <a href="<?php echo site_url('mesa/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Mesa</a> 
        </div>
        
    </center>
    <div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            ------------------- parametro de buscador -------------------
            
                <select id="select_categoria" class="form-control">
                    
                    <option value="0">-- TODAS --</option>
                    <?php foreach ($categorias as $c){ ?>
                            <option value="<?php echo $c["categoriamesa_nombre"]; ?>"><?php echo $c["categoriamesa_nombre"]; ?></option>
                    <?php } ?>
                    
                </select>
            
            ------------------- fin parametro de buscador -------------------
        </div>
        
        <div class="col-md-8">
            ------------------- parametro de buscador -------------------
                      <div class="input-group"> <span class="input-group-addon">Buscar</span>
                        <input id="filtrarmesa" type="text" class="form-control" placeholder="Ingrese nombre de la mesa..">
                      </div>
                ------------------- fin parametro de buscador -------------------
        </div>
    </div>
    </div>
    
</div>-->

       
            
    <div class="container-fluid" style="height: 100%; background-image: url(<?php echo base_url("resources/images/sistema/fondo.jpg"); ?>); background-repeat: no-repeat;background-size: cover; ">
        
    <div class="col-md-<?=$espacio_mesas; ?>" style="height: 100%; background-color: rgba(255, 0, 0, 0);">
        <div class="row" style="height: 100%; background-color: rgba(255, 0, 0, 0);">
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
                            
                                <button class="btn btn-default btn-sq-lg" style="border-bottom: #002166 dashed 2px; width:<?= $ancho_boton ?>;  !important;  height:<?= $alto_boton ?>; font-size:<?= $tamanio_fuente?>;  <?= $estilo ?>; background-color: rgba(255, 0, 0, 0);" onclick="modal_mesa(<?= $m["mesa_id"]; ?>)" id="mesa<?= $m["mesa_id"]?>">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconolibre"]); ?>" width="<?= $ancho_imagen?>" height="<?= $alto_imagen ?>" id="imagen<?=$m["mesa_id"] ?>" />
                                    <!---- <br><span class="btn btn-success btn-xs" id="span<?=$m["mesa_id"] ?>"><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?></span ----->
                                    <br>
            
                                </button>
                            
                            
                                <?php } ?>
                                
                                <?php if($m["estado_id"]==39){ ?>
                                <button class="btn btn-default btn-sq-lg" style="width:<?= $ancho_boton ?>;  !important;  height:<?= $alto_boton ?>; font-size:<?= $tamanio_fuente?>;  <?= $estilo ?>; background-color: rgba(255, 0, 0, 0);" onclick="mostrar_pedido(<?= $m["mesa_id"]; ?>)" id="mesa<?= $m["mesa_id"]?>">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconoocupada"]); ?>" width="<?= $ancho_imagen?>" height="<?= $alto_imagen ?>"  id="imagen<?=$m["mesa_id"] ?>" />
                                    <!---- <br><span class="btn btn-danger btn-xs" id="span<?=$m["mesa_id"] ?>"><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?></span ----->
                                    <br>
            
                                </button>
                                
                                <?php } ?>
                                <?php if($m["estado_id"]==40){ ?>
                                
                                <button class="btn btn-default btn-sq-lg" style="width:<?= $ancho_boton ?>;  !important;  height:<?= $alto_boton ?>; font-size:<?= $tamanio_fuente?>;  <?= $estilo ?>; background-color: rgba(255, 0, 0, 0);" onclick="modal_mesa(<?= $m["mesa_id"]; ?>)">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconoreservada"]); ?>" width="<?= $ancho_imagen?>" height="<?= $alto_imagen ?>" id="imagen<?=$m["mesa_id"] ?>" />
                                    <!---- <br><span class="btn btn-default btn-xs" id="span<?=$m["mesa_id"] ?>"><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?></span ----->
                                    <br>
                                </button>
                                
                                <?php } ?>

                                
                                <?php if($m["estado_id"]==41){ ?>
                                <button class="btn btn-default btn-sq-lg"  style="width:<?= $ancho_boton ?>;  !important;  height:<?= $alto_boton ?>; font-size:<?= $tamanio_fuente?>;  <?= $estilo ?>; background-color: rgba(255, 0, 0, 0);" onclick="modal_mesa(<?= $m["mesa_id"]; ?>)">
                                    
                                    <img src="<?php echo base_url("resources/images/mesas/".$m["mesa_iconomantenimiento"]); ?>" width="<?= $ancho_imagen?>" height="<?= $alto_imagen ?>" id="imagen<?=$m["mesa_id"] ?>" />
                                    <!---- <br><span class="btn btn-github btn-xs" id="span<?=$m["mesa_id"] ?>"><?php echo "<b>".$m["mesa_nombre"]."</b>"; echo ($descripcion=="")?"":"<br>{$descripcion}"; ?></span ----->
                                    <br>
                                </button>
                                
                                <?php } ?>
                                
          
                                
                                
                            <!--</div>-->
                
                    <?php  } ?>
                    <?php  } ?>

                                
            </div>
        </div>
    </div>

        <!--<!-- Boton de muestra con imagen de fondo y texto al centro -->
    <!-----------    
        <button class="btn btn-facebook btn-xs" style="background: url(<?php echo base_url("resources/images/mesas/libre.png") ?>) center/cover; background-size:<?= $ancho_imagen ?> <?= $alto_imagen ?>; position: absolute; display: inline-block; background-color: rgba(255, 0, 0, 0);  width:<?= $ancho_imagen ?>; height:<?= $alto_imagen ?>; border: none;" >

        <b style="font-size: 15px;">105</b><br>
        <b style="font-size: 6x;">10 Pers.</b>

        </button>
    ---------->
    
    <div class="col-md-<?php echo (12 - $espacio_mesas); ?>" style="background-color: rgba(255, 0, 0, 0);">
        <div class="col-md-12" style="background-color: rgba(255, 0, 0, 0);">
            <div class="row" style="background-color: rgba(255, 0, 0, 0);">
                
                    
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12" id="datos_pedido">
                        
                        
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12" id="detalle_pedido">
                        
                        
                        </div>
                    </div>


                </div>
            </div>
        </div>     
    </div>
    
    </div>




<!-- modal opciones -->
<!-- Button trigger modal -->
<div hidden>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOpciones" id="boton_opciones">
        Opcion mesas
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalOpciones" tabindex="-1" role="dialog" aria-labelledby="modalOpcionesTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: lightgray;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <h5 class="modal-title" id="exampleModalLongTitle"><b>OCUPAR MESA</b></h5>
      </div>
      <div class="modal-body">
        <div class="row">
        
                        <div class="col-md-6" hidden="">
                        <input type="text" id="mesa_id" value="0"/>
                    </div>
                        
                    <div class="col-md-6" hidden>
                            <label for="estado_id" class="control-label">Estado</label>
                            <div class="form-group">
                                    <select name="estado_id" class="form-control">
                                            <option value="">- ESTADO -</option>
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

          
                    <div class="col-md-6" hidden>
                        <label for="usuario_clave" class="control-label">Contraseña</label>
                        <div class="form-group">
                            <input type="password" name="usuario_clave" value="" class="form-control" id="usuario_clave"  />
                                <span class="text-danger"><?php echo form_error('usuario_clave');?></span>
                        </div>
                    </div>
          
                    <div class="col-md-12">
                        <label for="usuario_clave" class="control-label">ADVERTENCIA</label>
                        <div class="form-group">
<!--                            <input type="password" name="usuario_clave" value="" class="form-control" id="usuario_clave"  />-->
                            <span class="text-warning"><b><fa class="fa fa-warning"> </fa></b></span>
                            <span class="text-danger"><b>Esta a punto de cambiar el estado a OCUPADO, ¿desea continuar?</b></span>
                        </div>
                    </div>
          
        </div>
      </div>
      <div class="modal-footer">
          <!--<button type="button" class="btn btn-primary" onclick="verificar_usuario()" data-dismiss="modal"><fa class="fa fa-floppy-o"></fa> Aceptar</button>-->
          <button type="button" class="btn btn-primary" onclick="registrar_operacion()" data-dismiss="modal"><fa class="fa fa-floppy-o"></fa> Aceptar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal cambio cantidad -->
<div hidden>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalmodificar" id="boton_modificar">
        Opcion mesas
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalmodificar" tabindex="-1" role="dialog" aria-labelledby="modalmodificar-titulo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        
      <div class="modal-header" style="background: lightgray;">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <h5 class="modal-title" id="exampleModalLongTitle"><b>MODIFICAR</b></h5>
          
      </div>
        
      <div class="modal-body">
          
        <div class="row">
        
                        
                    <input type="hidden" name="detalleped_id" value="" class="form-control" id="detalleped_id"  />
          
<!--                    <div class="col-md-6">
                        <label for="usuario_clave" class="control-label">Producto</label>
                        <div class="form-group">
                            <input type="text" name="usuario_clave" value="" class="form-control" id="usuario_clave"  />
                                <span class="text-danger"><?php echo form_error('usuario_clave');?></span>
                        </div>
                    </div>-->
          
                    <div class="col-md-3">
                        <label for="detalleped_cantidad" class="control-label">Cantidad</label>
                        <div class="form-group">
                            <input type="number" name="detalleped_cantidad" value="" class="form-control" id="detalleped_cantidad"  />
                                
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="detalleped_precio" class="control-label">Precio</label>
                        <div class="form-group">
                            <input type="number" name="detalleped_precio" value="" class="form-control" id="detalleped_precio"  />
                                
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="detalleped_botones" class="control-label">Opciones</label>
                        <div class="form-group">

                            <button type="button" class="btn btn-primary" onclick="modificar_detalle()" data-dismiss="modal"><fa class="fa fa-floppy-o"></fa> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
                                
                        </div>
                    </div>
          
        </div>
      </div>
<!--      <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="modificar_detalle()" data-dismiss="modal"><fa class="fa fa-floppy-o"></fa> Modificar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
      </div>-->
    </div>
  </div>
</div>

<!-- Modal buscador de productos -->
<div hidden>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalproductos" id="boton_productos">
        Buscar productos
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalproductos" tabindex="-1" role="dialog" aria-labelledby="modalproductos-titulo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        
      <div class="modal-header" style="background: lightgray;">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <h5 class="modal-title" id="exampleModalLongTitle"><b>PRODUCTOS</b></h5>
          
      </div>
        
      <div class="modal-body">
          
        <div class="row">
            <div class="col-md-12" >

                <div class="row" id="buscador1"">

                    <!--------------------- parametro de buscador por codigo --------------------->

                    <div class="col-md-4">
                          <div class="input-group">
                              <span class="input-group-addon"> 
                                <i class="fa fa-barcode"></i>
                              </span>           
                              <input type="text" name="codigo" id="codigo" class="form-control" placeholder="código" onkeyup="validar(event,3)">
                          </div>
                    </div>      
                   <!--------------------- fin buscador por codigo --------------------->


                   <div class="col-md-8">

        <!--            ------------------- parametro de buscador --------------------->

                          <div class="input-group">
                              <span class="input-group-addon" onclick="ocultar_busqueda();"> 
                                Buscar 
                              </span>           
                              <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código" onkeypress="validar(event,4)" autocomplete="off">
                              <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultados(1)" title="Buscar"><span class="fa fa-search"></span></div>
                          </div>

        <!--            ------------------- fin parametro de buscador ------------------- -->

                    </div>

                </div>
        <!-------------------- CATEGORIAS------------------------------------->
        <div class="container" id="categoria" style="padding:0;">
            <span class="badge btn-danger">
                <select lect class="bange btn-danger" style="border-width: 0; width:110px;"  onchange="tablaresultados(2)" id="categoria_prod">
                    <option value="0" >- CATEGORIAS -</option>
                    <?php 
                        foreach($categoria_producto as $categ){ 
                            $selected = ($categ['categoria_id'] == $parametro['parametro_mostrarcategoria']) ? ' selected="selected"' : "";
                            ?>
                            <option value="<?php echo $categ['categoria_id']; ?>" <?php echo $selected; ?>><?php echo $categ['categoria_nombre']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </span>
            <span class="badge btn-danger">
                <select class="bange btn-danger" style="border-width: 0; width:120px;"  onchange="tablaresultados(3)" id="subcategoria_prod">
                    <option value="0" >- SUB CATEGORIAS -</option>
                </select>
            </span>
            <span class="badge btn-facebook">
                <input style="border-width: 0; color: black;" id="encontrados" type="text"  size="3" value="0" readonly="true">
            </span>
            <button class="btn btn-success btn-xs" onclick="actualizar_inventario()"><span class="fa fa-cubes"></span> Inventario</button>
            <?php 
            if ($parametro["parametro_agruparitems"] == 1 ){
                $agrupar = "checked='true'";
            }else {$agrupar = " ";}
            ?>
            <!--<button class="btn btn-primary btn-xs"><input type='checkbox' id='check_agrupar' class="btn btn-success btn-xs"  value='1' <?php echo $agrupar; ?>> Agrupar</button>-->
            <button class="btn btn-primary btn-xs" id="mostrar_todo" onclick="tablaresultados(4)"><fa class="fa fa-cubes"></fa> Mostrar Todo</button>
            <span class="badge btn-default text-center">
                <!--------------------- inicio loader ------------------------->
                <div class="row" id='oculto'  style='display:none;'>
                        <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
                </div>
                <!--------------------- fin inicio loader ------------------------->
            </span>
        </div>
        <!-------------------- FIN CATEGORIAS--------------------------------->

                <div class="box">
                    
                    <div class="box-body  table-responsive scrollable-div" id="tablaresultados" >  
                        <!------------------ aqui van los resultados de la busqueda --------------->

                    </div>

                </div>
    </div>
          
        </div>
      </div>
<!--      <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="modificar_detalle()" data-dismiss="modal"><fa class="fa fa-floppy-o"></fa> Modificar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
      </div>-->
    </div>
  </div>
</div>




<!--- **************************************************** -><!-- comment -->


<!-- Modal cambio cantidad -->
<div hidden>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcambiomesa" id="boton_modificar">
        cambio de mesa
    </button>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalcambiomesa" tabindex="-1" role="dialog" aria-labelledby="modalmodificar-titulo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        
      <div class="modal-header" style="background: lightgray;">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <h5 class="modal-title" id="exampleModalLongTitle"><b>CAMBIAR MESA</b></h5>
          
      </div>
        
      <div class="modal-body">
          
        <div class="row">
        
                        
                    <input type="hidden" name="detalleped_id" value="" class="form-control" id="detalleped_id"  />
          

          
                    <div class="col-md-6">
                        <label for="detalleped_cantidad" class="control-label">Mesa Disponoble</label>
                        <div class="
                             form-group">
                                    <select id="select_mesadisponible" class="form-control">

                                        <option value="0">-- NINGUNA --</option>
                                        <?php foreach ($mesadisponible as $md){ ?>
                                                <option value="<?php echo $md["mesa_id"]; ?>"><?php echo $md["mesa_nombre"]; ?></option>
                                        <?php } ?>

                                    </select>
                                
                        </div>
                    </div>
<!--
                    <div class="col-md-3">
                        <label for="detalleped_precio" class="control-label">Precio</label>
                        <div class="form-group">
                            <input type="number" name="detalleped_precio" value="" class="form-control" id="detalleped_precio"  />
                                
                        </div>
                    </div>-->

                    <div class="col-md-6">
                        <label for="detalleped_botones" class="control-label">Opciones</label>
                        <div class="form-group">

                            <button type="button" class="btn btn-primary" onclick="cambiar_mesa()" data-dismiss="modal"><fa class="fa fa-floppy-o"></fa> Cambiar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
                                
                        </div>
                    </div>
          
        </div>
      </div>
<!--      <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="modificar_detalle()" data-dismiss="modal"><fa class="fa fa-floppy-o"></fa> Modificar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cancelar</button>
      </div>-->
    </div>
  </div>
</div>


<!--  <style>
    /* Estilo para el botón */
    .boton-con-imagen {
      position: relative;
      display: inline-block;
      padding: 10px 20px; /* Ajusta según sea necesario */
      background: url('<?php echo base_url("resources/images/mesas/libre.png"); ?>') center/cover; /* Especifica la ruta de tu imagen y el estilo de fondo */
      color: #fff; /* Color del texto */
      font-size: 16px; /* Tamaño de fuente del texto */
      text-align: center;
      border: none;
      cursor: pointer;
    }

    /* Estilo para el texto del botón */
    .texto-boton {
      position: relative;
      z-index: 2; /* Coloca el texto sobre la imagen */
    }
  </style>
</head>
<body>

   Botón con imagen y texto 
  <button class="boton-con-imagen">
    <span class="texto-boton">Texto del botón</span>
  </button>

</body>-->