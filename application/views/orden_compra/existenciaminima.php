<script src="<?php echo base_url('resources/js/existencia_minima.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
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
<!--<link href="<?php //echo base_url('resources/css/servicio_reportedia.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="formaimagen" id="formaimagen" value="<?php  echo $parametro['parametro_formaimagen']; ?>" />

<div class="row micontenedorep" style="display: block; margin-top: 0px; margin-bottom: 0px;" id="cabeceraprintx" >
    <table class="table" style="width: 100%; padding: 0;" >
        <tr>
            <td style="width: 25%; padding: 0; line-height:10px; text-align: center" >
                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
            </td>
            
            <td style="width: 50%; padding: 0; line-height: 10px;" > 
                <center>
                    <br><br>
                    <font size="3" face="arial" style="font-weight: bold"><span id="titcatalogox"></span>PRODUCTOS CON EXISTENCIA MINIMA</font> <br>
                    <font size="1" face="arial"><?php echo date("d/m/Y H:i:s"); ?></font> <br>
                </center>
            </td>
            
            <td style="width: 25%; padding: 0" >
                <center></center>
            </td>
        </tr>
    </table>
</div>
<br>
<div class="row no-print">
    <div class="col-md-5">
        <div class="box-header" style="padding-left: 0px">
            <font size='4' face='Arial'><b>Productos</b></font>
            <br><font size='2' face='Arial'>Registros Encontrados: <span id="encontrados">0</span></font> 
        </div>
        <div class="input-group">
            <span class="input-group-addon"> Buscar </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código, código de barras, marca, industria.." onkeypress="buscarproducto(event)" autocomplete="off">
            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultadosproducto(2)" title="Buscar"><span class="fa fa-search"></span></div>
            <!--<div style="border-color: #d58512; background: #e08e0b !important; color: white" class="btn btn-warning input-group-addon" onclick="tablaresultadosproducto(3)" title="Mostrar todos los productos"><span class="fa fa-globe"></span></div>-->
        </div>
    </div>
    <div class="row col-md-12" id='loader'  style='display:none; text-align: center'>
        <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="box">
                 
            <div class="box-body  table-responsive">
                
               <table class="table table-condensed" id="mitabla" role="table">
                    <thead role="rowgroup">

                        <tr role="row">
                            <th  role="columnheader" >#</th>
                            <th  role="columnheader" >PRODUCTO</th>
                            <th  role="columnheader" >CODIGO</th>
                            <th  role="columnheader" >ULTIMO<br>COSTO</th>
                            <th  role="columnheader" >PRECIO<br>VENTA</th>
                            <th  role="columnheader" >EXISTENCIA</th>
                            <!--<th  role="columnheader" >MND</th>-->
                            <!--<th  role="columnheader" >CATEGORIA</th>-->
                            <th  role="columnheader" class="no-print" >PROVEEDOR</th>
                            <!--<th  role="columnheader" class="no-print">ESTADO</th>-->
                    
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados" role="rowgroup">
                                           
                    </tbody>
                </table>
                
            </div>
            <!-- pagination all... -->
        </div>
        
    </div>
</div>
<!------------------------ INICIO modal proveedores ------------------->
<div class="modal fade" id="modalproveedor" tabindex="-1" role="dialog" aria-labelledby="modalproveedorlabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold" style="font-size: 12pt">PROVEEDORES</span>
            </div>
            <div class="modal-body" id="tabla_historial">
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal proveedores ------------------->

<!------------------------ INICIO modal proveedores ------------------->
<div class="modal fade" id="modalultimopedido" tabindex="-1" role="dialog" aria-labelledby="modalultimopedidolabel">
    <div class="modal-dialog modal-lg" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold" style="font-size: 12pt">ULTIMO PEDIDO</span>
            </div>
            <div class="modal-body" id="tabla_ultimopedido">
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal proveedores ------------------->
