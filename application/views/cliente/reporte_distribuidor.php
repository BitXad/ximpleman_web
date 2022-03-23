<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/reporte_distribuidor.js'); ?>" type="text/javascript"></script>
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
    
</style>
<style>
    .labj {
        border-bottom: 1.5px solid black; border-right: 0px; border-top: 0px;
    }
    @media print {
        
        .pintado {
            background-color: rgba(169,175,232) !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
        .boxtabla {
            background-color: rgba(169,175,232) !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
    }

</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabladetalleimpresion.css'); ?>" rel="stylesheet">

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" />
<!-------------------------------------------------------->
<div class="text-center esbold no-print" style="font-size: 12pt">
    REPORTE DE ENTREGAS
</div>
<div class="row cabeceraprint" style="display: none" id="contenedortitulo">
    <table class="table" style="width: 100%; padding: 0;" >
        <tr>
            <td style="width: 25%; padding: 0; line-height:10px;" >
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

            <td style="width: 35%; padding: 0" > 
                <center>

                    <br><br>
                    <font size="3" face="arial"><b>REPORTE DE ENTREGAS</b></font> <br>

                    <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

                </center>
            </td>
            <td style="width: 20%; padding: 0" >
                <center></center>
            </td>
        </tr>
    </table>
</div>

Desde:<span id="fechade"><font size="1" face="Arial"></font></span>        
Hasta:<span id="fechaha"><font size="1" face="Arial"></font></span>   <br>     
Distribuidor:<span id="usuru"><font size="1" face="Arial"></font> <?php echo $usuario_nombre; ?></span>  
<div class="row no-print">
    
    <div class="col-md-12">
        <?php echo form_open_multipart('pedido/mapa_paraentregas/', array('target'=>'_blank')); ?>
        
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_desde" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_hasta" name="fecha_hasta" required="true">
        </div>
        
        <?php if($tipousuario_id == 1){ ?>
        <div class="col-md-2">
            Distribuidor:             
            <select class="btn btn-primary btn-sm form-control" name="usuariodist_id" id="usuariodist_id" onchange="pasarnombre(this)" required>
                <!--<option value="0">TODOS</option>-->
                <?php foreach($all_usuario as $usuario){
                    $selected = ($usuario['usuario_id'] == $usuario_id) ? ' selected="selected"' : "";
                ?>
                <option value="<?php echo $usuario['usuario_id']; ?>" <?php echo $selected; ?>><?php echo $usuario['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <?php }else{ ?>
        <div class="col-md-2">
            Distribuidor:<br>
            <label class="btn btn-primary btn-block"><?php echo $usuario_nombre; ?></label>
            <input type="hidden" id="usuariodist_id" name="usuariodist_id" value="<?php echo $usuario_id; ?>">
        </div>
        <!--<div class="col-md-2">
            Usuario:<br>
            <label class="btn btn-primary btn-block"><?php /*echo $usuario_nombre; ?></label>
            <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $usuario_id;*/ ?>" />
        </div>-->
        <?php } ?>
        <div class="col-md-2">
            Usuarios:             
            <select class="btn btn-primary btn-sm form-control" name="usuario_id" id="usuario_id" onchange="pasarnombre(this)" required>
                <option value="0">TODOS</option>
                <?php foreach($all_usuario as $usuario){?>
                <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-1">
            <br>
            <!--<a href="<?php //echo base_url("pedido/mapa_paraentregas"); ?>" class="btn btn-facebook btn-foursquarexs btn-block"  style="height: 34px;" title="Mapa" target="_BLOCK" >-->
            <button type="submit" class="btn btn-facebook btn-foursquarexs btn-block"  style="height: 34px;" title="Mapa" target="_BLOCK" >
                <span class="fa fa-map"></span> Mapa        
            </button>
            <br>
        </div>
        
        <?php echo form_close(); ?>
        
        <div class="col-md-1">
            <br>
            <button class="btn btn-sm btn-soundcloud btn-sm btn-block" onclick="buscarventasdist()" style="height: 34px;">
                <span class="fa fa-search"></span> Buscar
          </button>
            <br>
        </div>
        
        <div class="col-md-1">
            <br>
            <button class="btn btn-info btn-foursquarexs btn-block" onclick="imprimir_reporte()" style="height: 34px;" title="Imprimir lista" >
                <span class="fa fa-print"></span> Imprimir
            </button>
            <br>
        </div>
        
        <!--</div>-->
        <!-- *********** INICIO de BUSCADOR select y productos encontrados ****** -->
        
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
        
    </div>
    
</div>
<!---- ?php echo form_close(); ? ---->    
<!-------------------------------------------------------------------------------->
<div class="row" id='loader'  style='display:block; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>
<div class="row">
    <div class="col-md-12">
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->

        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabladetimpresion">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th class="no-print">   </th>
                        <th class="no-print">Venta</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th class="no-print">Estado</th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row cabeceraprint" style="display: none" id="contenedortitulo">
    <div id="cabizquierda">
        
    </div>
    <div id="cabcentro">
        <br>
        --------------------------------<br>
        Encargado
    </div>
    <div id="cabderecha">
        
    </div>
</div>



<?php
/*if($a == 1)
echo '<script type="text/javascript">
    alert("El Cliente NO puede ser ELIMINADO, \n porque tiene transacciones realizadas");
</script>'; */
?>