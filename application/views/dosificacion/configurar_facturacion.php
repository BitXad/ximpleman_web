<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_producto.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/JsBarcode.all.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php /*echo base_url('resources/plugins/datatables/dataTables.bootstrap.css'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap.min.css');*/ ?>">-->
  <!-- Ionicons -->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
  
<!-- jQuery 2.2.3 -->
<!--<script src="<?php //echo base_url('resources/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>-->
<!-- Bootstrap 3.3.6 -->

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
    /*td img{
        width: 50px;
        height: 50px;
        margin-right: 5px; 
    }*/
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
    #masgrande{
        font-size: 12px;
    }
</style>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
----------------------------------------------------
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="parametro_modulorestaurante" id="parametro_modulorestaurante" value="<?php echo $parametro['parametro_modulorestaurante']; ?>" />
<input type="hidden" name="formaimagen" id="formaimagen" value="<?php  echo $parametro['parametro_formaimagen']; ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php  echo $tipousuario_id; ?>" />
<input type="hidden" name="resproducto" id="resproducto" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
<input type="hidden" name="esesteproducto" id="esesteproducto" />  usado en el modal para numero de imgs. para codigo barra 
<input type="hidden" name="esestecodigobarra" id="esestecodigobarra" />  usado en el modal para numero de imgs. para codigo barra 
<input type="hidden" name="eselnombreproducto" id="eselnombreproducto" />  valor dado cuando mostramo el modal para codigo barra 
<input type="hidden" name="empresa_logo" id="empresa_logo" value="<?php echo $empresa[0]['empresa_imagen']; ?>" />  valor dado cuando mostramo el modal para codigo barra 
<input type="hidden" name="lapresentacion" id="lapresentacion" value='<?php /*echo json_encode($all_presentacion); ?>' />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($all_moneda); */ ?>' /> 
<input type="hidden" name="conencabezado" id="conencabezado" value="1" />-->
<!--<input type="hidden" name="parametro_decimales" id="parametro_decimales" value="<?php echo $parametro['parametro_decimales']; ?>" />-->

<input type="text" value='<?php echo json_encode($empresa); ?>' id="datos_empresa" hidden>

<div class="row micontenedorep" style="display: none" id="cabeceraprint" >
    <table class="table" style="width: 100%; padding: 0;" >
        <tr>
            <td style="width: 25%; padding: 0; line-height:10px; text-align: center" >
                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
            </td>
            <td style="width: 35%; padding: 0" > 
                <center>
                    <br><br>
                    <font size="3" face="arial"><b><span id="titcatalogo"></span>PRODUCTOS</b></font> <br>
                    <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>
                </center>
            </td>
            <td style="width: 20%; padding: 0" >
                <center></center>
            </td>
        </tr>
    </table>
</div>
<br>
<div class="row no-print">
    <div class="col-md-4">
        <div class="box-header" style="padding-left: 0px">
            <font size='4' face='Arial'><b>Configurar Facturación</b></font>
            <br><font size='2' face='Arial' id="encontrados"></font> 
        </div>

    </div>

    
    
    <!---------------- FIN BOTONES --------->
    <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
     <div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
    <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
</div>
    <div class="col-md-12">
        <div class="box-tools" style="display: flex">
            <center>
                
                <a style="width: 70px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('empresa/edit/1'); ?>" class="btn btn-info btn-foursquarexs" title="Modificar Empresa" target="_blank"><font size="5"><span class="fa fa-building"></span></font><br><small>Empresa</small></a>
                <a style="width: 70px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('dosificacion/edit/1'); ?>" class="btn btn-success btn-foursquarexs" title="Modificar Dosificacion" target="_blank"><font size="5"><span class="fa fa-archive"></span></font><br><small>Dosificacion</small></a>
                <a style="width: 70px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('token'); ?>" target="_blank" class="btn btn-github btn-foursquarexs" title="Homologar productos" ><font size="5"><span class="fa fa-barcode"></span></font><br><small>Token</small></a>
                <a style="width: 70px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('punto_venta'); ?>" target="_blank" class="btn btn-tumblr btn-foursquarexs" title="Homologar productos" ><font size="5"><span class="fa fa-cart-arrow-down"></span></font><br><small>Punto Venta</small></a>
                <a style="width: 70px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('parametro/edit/1'); ?>" class="btn btn-danger btn-foursquarexs" title="Modificar Parametros" target="_blank"><font size="5"><span class="fa fa-list"></span></font><br><small>Parámetros</small></a>
                <a style="width: 70px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('sincronizacion'); ?>" target="_blank" class="btn btn-facebook btn-foursquarexs" title="Sincronizar catálogos" ><font size="5"><span class="fa fa-briefcase"></span></font><br><small>Sincronizar</small></a>
                <a style="width: 70px; margin-right: 1px; margin-top: 1px" href="<?php echo site_url('sincronizacion/show_sincronizacion/6'); ?>" target="_blank" class="btn btn-warning btn-foursquarexs" title="Homologar productos" ><font size="5"><span class="fa fa-chain"></span></font><br><small>Homologar</small></a>
                

            </center>

            
        </div>
        
        
        
    </div>