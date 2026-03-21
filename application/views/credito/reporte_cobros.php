<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/credito.js'); ?>" type="text/javascript"></script>

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

<!--<body onload="buscar_pedidos();">-->
<body>


<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<!--<input type="hidden" id="esrol" name="esrol" value="<?php echo $esrol; ?>">
<input type="hidden" id="esrolconsolidar" name="esrolconsolidar" value="<?php echo $esrolconsolidar; ?>">-->

<input id="parametro_decimales" name="parametro_decimales" value="<?php echo $parametro["parametro_decimales"]; ?>" hidden>
<input id="usuario_id" name="usuario_id" value="<?php echo $usuario_id; ?>" hidden>
<input id="pedido_id" name="pedido_id" value="0" hidden>
<!--<input id="usuarios" name="usuarios" value='<?php echo json_encode($usuarios); ?>' hidden >-->
<input id='tipo_transaccion' name='tipo_transaccion' value='<?php echo json_encode($tipo_transaccion); ?>' hidden>

<table class="table" style="width: 19cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
            <center>
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>REPORTE DE COBROS</b></font> <br>
                <!--<font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0" >


        </td>
    </tr>     
    
</table>

        <div class="col-md-12" id="datos_reporte" style="line-height:10px;">

        </div>

<div class="container no-print">
    <center>            


        
        <?php if ($tipousuario_id == 1){ ?>
        <div class="col-md-2">
            Usuario(s):
            <select  class="btn btn-primary btn-sm form-control" id="select_usuario">
                    <option value="0">-- TODOS --</option>
                <?php foreach($usuario as $us){?>
                    <option value="<?php echo $us['usuario_id']; ?>"><?php echo $us['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
            
        </div>
        
        <div class="col-md-2">
            Tipo(s):
            <select  class="btn btn-info btn-sm form-control" id="select_estado">
                <?php foreach($estados as $es){?>
                    <option value="<?php echo $es['estado_id']; ?>" <?php echo ($es['estado_id']==9)?"selected":""; ?>><?php echo $es['estado_descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>
        

        <?php }else{ ?>
        <input type="text" id="select_usuario" id="select_usuario" value="<?php echo $usuario_id; ?>" hidden=""/>
        <?php } ?>
        
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>
        
        <div class="col-md-2">

            <br>
            <button class="btn btn-sm btn-facebook btn-sm btn-block form-control"   onclick="buscar_cobros()">
                <!--<h4>-->
                <span class="fa fa-search"></span><b> Buscar</b>
                <!--</h4>-->
            </button>
            
        </div>        
        <div class="col-md-2">

            <br>
            <button class="btn btn-sm btn-success btn-sm btn-block form-control"   onclick="imprimir();">
                <!--<h4>-->
                <span class="fa fa-print"></span><b> Imprimir</b>
                <!--</h4>-->
            </button>
            
        </div>        
        
    </center>    
   
</div>
<br>


<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
<!--                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el cliente, fecha, total">
                  </div>-->
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla" style="font-size: 10px;">
                    <tr>
                        <th>N</th>
                        <th>Cliente</th>
                        <th align="center">Credito</th>
                        <th align="center">Venta</th>
                        <th>Cuota</th>
                        <th>Capital</th>
                        <th>Int.</th>
                        <th>Desc.</th>
                        <th>Monto<br>Cuota Bs</th>
                        <th>Mora<br>Dias</th>
                        <th>Fecha<br>Limite</th>
                        <th>Monto<br>Cancelado Bs</th>
                        <th>Fecha/hora<br>Pago</th>                        
                        <th>Estado</th>
                        <th>Responsable</th>

                    </tr>
                    <tbody class="buscar" id="tabla_pagos">

                        <!-- Aqui de acomoda la tabla de pedidos -->
                     
                        </tr>
                    </tbody>
                </table>
                                
            </div>

        </div>
    </div>
</div>
</body>

<style>
@media print {
    @page {
        size: A4 landscape;
        margin: 10mm;
    }

    body {
        width: 100%;
    }

    .container {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
}
</style>


<script>
function imprimir()
        {
            window.print(); 
        }
</script>