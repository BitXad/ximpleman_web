<script src="<?php echo base_url('resources/js/ultimo_pedido.js'); ?>" type="text/javascript"></script>
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
                            <th  role="columnheader" >PRODUCTO/ UNIDAD</th>
                            <th  role="columnheader" >CODIGO</th>
                            <th  role="columnheader" >ULTIMO<br>COSTO</th>
                            <th  role="columnheader" >PRECIO<br>VENTA</th>
                            <th  role="columnheader" >EXISTENCIA</th>
                            <th  role="columnheader" >CANTIDAD</th>
                            <th  role="columnheader" >TOTAL</th>
                            <th  role="columnheader" ></th>
                            <!--<th  role="columnheader" >MND</th>-->
                            <!--<th  role="columnheader" >CATEGORIA</th>-->
                            <th  role="columnheader" class="no-print" >PROVEEDOR</th>
                            <!--<th  role="columnheader" class="no-print">ESTADO</th>-->
                    
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tabla_ultimopedido" role="rowgroup">
                                           
                    </tbody>
                </table>
                
            </div>
            <!-- pagination all... -->
        </div>
        
    </div>
</div>

