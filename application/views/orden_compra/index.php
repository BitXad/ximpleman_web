<script src="<?php echo base_url('resources/js/orden_compra.js'); ?>" type="text/javascript"></script>
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

<?php $decimales = $parametro["parametro_decimales"]; ?>
<input type="text" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales" hidden>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<input type="text" value='<?php echo json_encode($empresa); ?>' id="datos_empresa" hidden>

<div class="box-header" style="padding-left: 0px">
    <font size='4' face='Arial'><b>Ordenes de Compra</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <span id="encontrados">0</span></font>
</div>
<div class="row no-print">
    <div class="col-md-5">
        <div class="input-group">
            <span class="input-group-addon"> Buscar </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el num. compra, proveedor.." onkeypress="buscar_ordencompra(event)" autocomplete="off">
            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultadosordencompra(2)" title="Buscar"><span class="fa fa-search"></span></div>
            <div style="border-color: #d58512; background: #e08e0b !important; color: white" class="btn btn-warning input-group-addon" onclick="tablaresultadosordencompra(3)" title="Mostrar todas las ordenes de pedido"><span class="fa fa-globe"></span></div>
        </div>
    </div>
    
    <div class="col-md-4 text-right">
        <div class="box-tools" style="display: flex">
            <a style=" margin-right: 1px; margin-top: 1px" href="<?php echo site_url('orden_compra/nueva_ordencompra'); ?>" class="btn btn-success btn-foursquarexs" title="Añadir nueva orden de compra"><span class="fa fa-cart-plus"></span><small> Nueva Orden de Compra</small></a>
            
            
        </div>
    </div>
    
    
     <div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
    <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
</div>
    

<div class="row">
    <div class="col-md-12">
        
        <div class="box">
                 
            <div class="box-body  table-responsive">
               <table class="table table-condensed" id="mitabla" role="table">
               <!--<table role="table">-->
                    <thead>
                        <tr role="row">
                            <th >#</th>
                            <th>Responsable</th>
                            <th>Orden No.</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Fecha Entrega</th>
                            <th>Proveedor</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados"></tbody>
                </table>
            </div>             
        </div>
    </div>
</div>
<?php
/*if($a == 1)
echo '<script type="text/javascript">
    alert("El Producto no puede ser ELIMINADO, \n porque tienen transacciones realizadas");
</script>';
*/
?>

<!------------------------ INICIO modal para confirmar ejecutar orden compra ------------------->
<div class="modal fade" id="modal_ejecutarordencompra" tabindex="-1" role="dialog" aria-labelledby="modal_ejecutarordencompralabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">EJECUTAR ORDEN DE COMPRA</span><br>
                <span class="text-bold">No. <span id="laordencompra_id"></span></span>
            </div>
            <div class="modal-body">
                <span>
                    Esta seguro de ejecutar esta orden de compra?
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="ejecutarordencompra()"><span class="fa fa-check"></span> Ejecutar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar ejecutar orden compra ------------------->
<!------------------------ INICIO modal para confirmar anunlar orden compra ------------------->
<div class="modal fade" id="modal_anularordencompra" tabindex="-1" role="dialog" aria-labelledby="modal_anularordencompralabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">ANULAR ORDEN DE COMPRA</span><br>
                <span class="text-bold">No. <span id="anularordencompra_id"></span></span>
            </div>
            <div class="modal-body">
                <span>
                    Esta seguro de anular esta orden de compra?
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="anularordencompra()"><span class="fa fa-minus-circle"></span> Anular</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anular orden compra ------------------->
