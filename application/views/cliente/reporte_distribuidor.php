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
                <center>
                         
                             
                            
                         
                        
                    </center>
        </td>
    </tr>
     
    
    
</table>  <br> 
   
</div>
<br>  <input type="hidden" id="usu" name="">
Desde:<span id="fechade"><font size="1" face="Arial"></font></span>        
Hasta:<span id="fechaha"><font size="1" face="Arial"></font></span>   <br>     
Usuario:<span id="usuru"><font size="1" face="Arial"></font></span>  
<div class="row no-print">
    
    <div class="col-md-12">
    
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_desde" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_hasta" name="fecha_hasta" required="true">
        </div>
        <?php if($tipousuario_id == 1){ ?>
        <div class="col-md-2">
            Usuarios:             
            <select class="btn btn-primary btn-sm form-control" name="usuario_id" id="usuario_id" onchange="pasarnombre(this)" required>
                <option value="0">TODOS</option>
                <?php foreach($all_usuario as $usuario){?>
                <option value="<?php echo $usuario['usuario_id']; ?>" id="<?php echo $usuario['usuario_nombre']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <?php }else{ ?>
        <div class="col-md-2">
            Usuario:<br>
            <label class="btn btn-primary btn-block"><?php echo $usuario_nombre; ?></label>
            <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $usuario_id; ?>" />
        </div>
        <?php } ?>
        <div class="col-md-2">
            <br>
            <button class="btn btn-sm btn-soundcloud btn-sm btn-block"  type="submit" onclick="buscarventasdist()" style="height: 34px;">
                <span class="fa fa-search"></span> Buscar
          </button>
            <br>
        </div>
        <div class="col-md-2">
            <br>
            <button class="btn btn-info btn-foursquarexs btn-block"  type="submit" onclick="imprimir_reporte()" style="height: 34px;" title="Imprimir lista" >
                <span class="fa fa-print"></span> Imprimir
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
                <table class="table table-striped table-condensed" id="mitabladetimpresion">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Venta</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
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