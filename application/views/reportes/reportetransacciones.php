<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/reporte_ventapagrupado.js'); ?>" type="text/javascript"></script>


<style type="text/css">
/* @page { 
        size: landscape;
    }*/
     
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>">
<input type="hidden" name="resproducto" id="resproducto" />
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="decimales" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" />
<input type="hidden" name="caja_id" id="caja_id" value="<?php echo $caja["caja_id"]; ?>" />

<?php 

    $fuente = "Arial"; 
    $tamanio_letra = "12px"; //Texto en general
    $tamanio_letra2 = "11px"; //Reporte de transacciones
    $tamanio_letra3 = "9px"; //Reporte de transacciones

?>


<div class="row no-print" id='loader'  style='display:none;'>
    <center>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
    </center>
</div>


<!------------------------------------------------------------------>
<!------------------------------------------------------------------>
<!------------------------------------------------------------------>
<?php $factura = [0=>0]; ?>
<?php $detalle_factura = [0=>0]; 
    $decimales = 2;
?>

<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
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

<style type="text/css">


p {
    font-family: <?= $fuente  ?>;
    font-size: 10pt;
    line-height: 100%;   /*esta es la propiedad para el interlineado*/
    color: #000;
    padding: 10px;
}

div {
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
margin-left: 0px;
margin: 0px;
}


table{
width : 10cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;
border-spacing : 0 0;
border-collapse : collapse;
font-family: <?= $fuente  ?>;
font-size: <?= $tamanio_letra3  ?>;; /*tamaño contenido de tabla*/

}

td#comentario {
vertical-align : bottom;
border-spacing : 0;
}
div#content {
background : #ddd;
font-size : <?= $tamanio_letra3  ?>;
margin : 0 0 0 0;
padding : 0 0px 0 0px;
/*border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;*/
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->

<?php //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
?>

<div class="container no-print" hidden>  
    <div class="box-tools" style="font-family: <?= $fuente  ?>;" <?php echo ($tipousuario_id == 1)?"":"hidden"; ?>>
                <div class=" col-md-11">
                    <!-- panel panel-primary -->
                    <!--<div class="panel panel-primary col-md-8" id='buscador_oculto' > style='display:none; padding-top: 10px;'> -->
                    <div class="col-md-2">
                        Usuario:
                        <?php if($tipousuario_id == 1){ ?>
                        <select  class="btn btn-primary btn-sm form-control" id="buscarusuario_id" required>
                            <option value="0"> TODOS </option>
                            <?php foreach($all_usuario as $usuario){?>
                            <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                            <?php } ?>
                        </select>
                        <?php }else{ ?>
                        <select  class="btn btn-primary btn-sm form-control" id="buscarusuario_id" required>
                            <?php
                            $ischequed = "";
                            foreach($all_usuario as $usuario){
                                if($usuario_id == $usuario['usuario_id']){
                                    $ischequed = "selected";
                            ?>
                            <option <?php echo $ischequed; ?> value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                            <?php }    
                                } ?>
                        </select>
                        <?php } ?>
                    </div>
                        <div class="col-md-2">
                            Desde: <input type="date" value="<?php echo date('Y-m-d')?>" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
                        </div>
                        <div class="col-md-2">
                            Hasta: <input type="date" value="<?php echo date('Y-m-d')?>" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true">
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-sm btn-warning btn-sm btn-block"  type="submit" onclick="buscar_por_fecha()" style="height: 34px;" id="boton_buscar">
                                <span class="fa fa-search"></span> Buscar
                          </button>
                            <br>
                        </div>
<!--                        <div class="col-md-2">
                            <br>
                            <span class="badge btn-primary" style="height: 34px; padding-top: 5px;">Ing. Egr. encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="resingegr" type="text" value="0" readonly="true"> </span></span>
                        </div>-->
                        <div class="col-md-3">
                            <br>
                            <a id="imprimirestedetalle" class="btn btn-sq-lg btn-success" onclick="imprimirdetalle()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
                        </div>
                </div>

        </div>

    </div>




<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">
    
    
<table class="table" style="width: <?php echo $ancho?>" >
    <tr>
<!--        <td style="padding: 0; width: 0cm">-->
        <td style="padding: 0;" colspan="5">
                
            <center style="line-height: 10px">
                               
                    
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="2" face="<?= $fuente  ?>"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="<?= $fuente  ?>"><?php echo $empresa[0]['empresa_eslogan']; ?></font><br>
                
                    <br><font size="3" face="arial"><b>REPORTE Nº 00<?php echo $caja["caja_id"]; ?><br><small>TRANSFERENCIAS / QR</small></b></font>
            </center>        
        </td>        
    </tr>               
                <!-- style="border-top: dashed 1px #000; border-bottom: dashed 1px #000;" -->
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <!--<table style="width:<?php echo $ancho?>" >-->
    <tr>
        <!--<td style="font-family: arial; font-size: 8pt; padding: 0; align:right; border-top: dashed 1px #000; border-bottom: dashed 1px #000;" colspan="1"></td>-->
        <td style="font-family: <?= $fuente  ?>; font-size: 8pt; padding: 0; border-top: dashed 1px #000; border-bottom: dashed 1px #000; line-height: 12px;" colspan="5">
            <!--<br>-->
            <b>PUNTO DE VENTA:</b> <?php echo $punto_venta["puntoventa_nombre"]; ?><br>
            <b>CAJERO:</b> <?php echo $usuario_caja["usuario_nombre"]; ?>
           <br><b>FECHA INICIO:</b> 
                    <?php
                    if (isset($caja)) {
                        $fechaApertura = DateTime::createFromFormat('Y-m-d', $caja["caja_fechaapertura"]);
                        echo $fechaApertura ? $fechaApertura->format('d/m/Y') : $caja["caja_fechaapertura"];
                        echo " " . $caja["caja_horaapertura"];
                    } else {
                        echo "SIN APERTURA DE CAJA";
                    }
                    ?>

                    <br><b>FECHA FIN:</b> 
                    <?php
                    if (isset($caja)) {
                        if ($caja["caja_fechacierre"] != null) {
                            $fechaCierre = DateTime::createFromFormat('Y-m-d', $caja["caja_fechacierre"]);
                            echo $fechaCierre ? $fechaCierre->format('d/m/Y') : $caja["caja_fechacierre"];
                            echo " " . $caja["caja_horacierre"];
                        } else {
                            echo "CAJA NO CERRADA";
                        }
                    } else {
                        echo date("d/m/Y H:i:s");
                    }
                    ?>
            <!--<br>-->
            <br>
        </td>
    </tr>
    
    
    <tr   style="border-top-style: dashed 1px #000;   font-size: 8pt; padding: 0;">
        <td colspan="5" style="padding: 0; line-height: 12px; border-top: dashed 1px #000; border-bottom: dashed 1px #000;">
            <br><b>TRANSACCIONES REALIZADAS</b>
            <small> 
                <?php if(isset($caja)){ echo nl2br($caja["caja_transrealizadas"]);} ?>
            </small>
        </td>
    </tr>
    
    <tr   style="border-top-style: dashed 1px #000;   font-size: 8pt; padding: 0;">
        <td colspan="5" style="padding: 0; line-height: 12px; border-top: dashed 1px #000; border-bottom: dashed 1px #000;">
            <br><b>TRANSACCIONES REGISTRADAS</b><br>
            <small> 
                <?php if(isset($caja)){ echo nl2br($caja["caja_transregistradas"]);} ?>
            </small>
        </td>
    </tr>
    
    <tr   style="font-size: 10pt; padding: 0;">
        <td colspan="5" style="padding: 0; text-align: center; line-height: 12px; border-top: dashed 1px #000; ">
            <small>Declaro veracidad de la información de este documento, y la total responsabilidad de las operaciones realizadas.</small>
            <br><br><br><br><br>
            <?php if(isset($caja)){ echo $caja["usuario_nombre"];} ?><br>CAJERO(A)
        </td>

<!--        <td style="padding: 0;  line-height: 12px;" colspan="4">
               USUARIO: <b></b> / TRANS: 

         </td>-->
    </tr>
                <!--</table>-->
      
    



    
    
</table>

</td>    
</tr>    
</table>

                    
                
            

<div class="col-md-12 no-print">
    <center>
        <button type="button" class="btn btn-facebook btn-sm" data-toggle="modal" onclick="$(document).ready(function(){window.onload = window.print();});"><i class="fa fa-print"> </i> Imprimir</button>        
        <!--<a href="<?php echo base_url("admin/dashb"); ?>" class="btn btn-info btn-sm" data-toggle="modal" ><i class="fa fa-calculator"> </i> Cerra caja</a>-->        
        <button type="button" class="btn btn-facebook btn-sm" style="background: #000;" data-toggle="modal" data-target="#modalcaja"><i class="fa fa-recycle"> </i> Corregir Caja</button>        
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="window.close();"><i class="fa fa-times"> </i> Cerrar</button>        
    </center>
</div>    
    




<!--------------------- modal apertura de caja ---------------->

<div id="modalcaja" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c0ef">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><fa class="fa fa-money"></fa><b> CORREGIR CAJA</b></h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12 text-bold">
          <span class="text-danger" id="elmensaje"></span>
        </div>
        <div class="col-md-6">
            <center><label for="monto_caja" class="control-label"><fa class="fa fa-warning"></fa> ADVERTENCIA</label><br>Esta a punto de ejecutar la correccion de caja. ¿Desea continuar?</center>
            <b>Monto inicial en caja Bs</b>
            <div class="form-group">
                <input type="number" name="monto_caja" id="monto_caja" value="0.00" class="form-control" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus="true"/>
            </div>
        </div>  

        <div class="col-md-6">
<!--            <label for="producto_marca" class="control-label"><p>Monto Registrado en Caja Bs</p></label>
            <div class="form-group">
                <input type="text" name="producto_marca" value="S/N" class="form-control" id="producto_marca" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>-->
            <button class="btn btn-warning btn-block" onclick="corregir_caja()"><fa class="fa fa-money"></fa> Corregir Caja</button>
            <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>

<!--------------------- modal transacciones QR ---------------->

<div id="modaltransacciones" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c0ef">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><fa class="fa fa-money"></fa><b> REPORTE TRANSACCIONES</b></h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12 text-bold">
          <span class="text-danger" id="elmensaje"></span>
        </div>
        <div class="col-md-6">
            <center><label for="monto_caja" class="control-label"><fa class="fa fa-warning"></fa> INSTRUCCIONES</label><br>Pegar en el campo de abajo el registro de transacciones Bancarias / QR
            <div class="form-group">
                <textarea type="texarea" name="transacciones" id="transacciones" value="" style="height: 200px;" class="form-control" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus="true">TRANSACCIONES QR</textarea>
            </div>
        </div>  

        <div class="col-md-6">
<!--            <label for="producto_marca" class="control-label"><p>Monto Registrado en Caja Bs</p></label>
            <div class="form-group">
                <input type="text" name="producto_marca" value="S/N" class="form-control" id="producto_marca" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>-->
            <button class="btn btn-warning btn-block" onclick="guardar_transacciones()"><fa class="fa fa-floppy-o"></fa> Guardar y Generar Reporte</button>
            <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>
<!--------------------- FIN modal transacciones QR ---------------->

<script type="text/javascript">

function corregir_caja()
{
    var base_url   = document.getElementById('base_url').value; 
    var monto_caja = document.getElementById('monto_caja').value; 
    var controlador = base_url+"caja/corregir_caja";

    if(monto_caja==""){monto_caja=0;}
    
    
    $.ajax({url:controlador,
        type:"POST",
        data:{monto_caja:monto_caja},
        success: function(response){
            var registros =  JSON.parse(response);
            
            if(registros!=''){
                
                $("#modalcaja").modal('hide');
                window.location.href = base_url+"caja/cierre_caja/"+registros["caja_id"];
                
            }
        },
        error:function (response){
            alert("ocurrio un error ");
        }
    });
}

function guardar_transacciones()
{
    var base_url   = document.getElementById('base_url').value; 
    var transacciones = document.getElementById('transacciones').value; 
    var caja_id = document.getElementById('caja_id').value; 
    var controlador = base_url+"caja/guardar_transacciones";

    if(monto_caja==""){monto_caja=0;}
    
    
    $.ajax({url:controlador,
        type:"POST",
        data:{transacciones:transacciones, caja_id:caja_id},
        success: function(response){
            var registros =  JSON.parse(response);
            
            if(registros){
                
                $("#modalcaja").modal('hide');
                window.location.href = base_url+"reportes/reporte_transacciones/"+registros;
                
            }
        },
        error:function (response){
            alert("ocurrio un error ");
        }
    });
}

</script>

