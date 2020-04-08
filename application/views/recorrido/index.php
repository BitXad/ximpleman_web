<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/recorrido.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script>
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
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #contieneimg img{
        width: 45px;
        height: 45px;
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
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">

<div class="container table-responsive" style="padding:0;" >
    
<table class="table" style="width: 20cm; padding: 0; font-family: Arial" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height: 10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0; line-height: 10px;" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>REPORTE DE RECORRIDO</b></font> <br>
                <!--<font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0; line-height: 12px; font-family:arial; font-size: 12px; " >
                ______________________________                
                <br><br>
                                
                <div id="datos_recorrido">
                    
                </div>
                
                ______________________________
        </td>
    </tr>
     
</table>
</div>


<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" />
<!--<div class="box-header text-center">
    <h2 class="box-title"><b>REPORTE DE RECORRIDO</b></h2>
</div>-->
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
                <u>CLIENTES</u><br><br>
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
    
    <div class="col-md-8">
    
        <div class="col-md-3">
            Desde: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_desde" name="fecha_desde" required="true">
        </div>
        <div class="col-md-3">
            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_hasta" name="fecha_hasta" required="true">
        </div>
        <?php if($tipousuario_id == 1){ ?>
        <div class="col-md-3">
            Usuarios:             
            <select class="btn btn-primary btn-sm form-control" name="usuario_id" id="usuario_id" required>
                <option value="0">TODOS</option>
                <?php foreach($all_usuario as $usuario){?>
                <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <?php }else{ ?>
        <div class="col-md-3">
            Usuario:<br>
            <label class="btn btn-primary btn-block"><?php echo $usuario_nombre; ?></label>
            <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $usuario_id; ?>" />
        </div>
        <?php } ?>
        <div class="col-md-3">
            <br>
            <button class="btn btn-sm btn-soundcloud btn-sm btn-block"  type="submit" onclick="recorrido_dist()" style="height: 34px;">
                <span class="fa fa-search"></span> Buscar
          </button>
            <br>
        </div>
          
        <!--</div>-->
        <!-- *********** INICIO de BUSCADOR select y productos encontrados ****** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
        
        
    </div>
    
</div>
    
<!-------------------------------------------------------------------------------->

<div class="row">
    <div class="col-md-12">
        
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->

        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Negocio</th>
                        <th>Pedido</th>
                        <th>Respuesta Cliente</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Monto</th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">

    
    <div class="col-md-6 no-print">
        <div  class="row" >

            <div class="box box-primary">
                <div class="box-header">
                </div>

                <div class="box-body" id="div_grafica_pie">
                </div>

                        <div class="box-footer">
                        </div>
            </div>



        </div>
    </div>
    
    <div class="col-md-6 ">
        <div class="col-md" id="reportes">
        </div>


            <!----------------------------------- BOTONES ---------------------------------->
            <?php 
            $ancho_boton = 100; 
            $alto_boton = 120; 

            ?>
            <div class="col-md-12 no-print" style="padding:0;">

                <center>

                <a href="#" data-toggle="modal" onclick="window.onload = window.print();" data-target="#modalfinalizar" class="btn btn-sq-lg btn-facebook" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                    <i class="fa fa-print fa-4x"></i><br><br>Imprimir <br>
                </a>

                <a  href="<?php echo site_url('pedido'); ?>" class="btn btn-sq-lg btn-danger" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                    <i class="fa fa-sign-out fa-4x"></i><br><br>
                   Salir <br>
                </a>    

                </center>
                <br>
            </div>    
            <!----------------------------------- fin Botones ---------------------------------->

        
        
    </div>    
</div>

<?php
/*if($a == 1)
echo '<script type="text/javascript">
    alert("El Cliente NO puede ser ELIMINADO, \n porque tiene transacciones realizadas");
</script>'; */
?>