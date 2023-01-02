<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones_prestamo.js'); ?>" type="text/javascript"></script>

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

<body onload="buscar_pedidos();">


<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="hidden" id="esrol" name="esrol" value="<?php echo $esrol; ?>">
<input type="hidden" id="esrolconsolidar" name="esrolconsolidar" value="<?php echo $esrolconsolidar; ?>">
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />

<input id="usuario_id" name="usuario_id" value="<?php echo $usuario_id; ?>" hidden>
<input id="pedido_id" name="pedido_id" value="0" hidden>
<!--<input id="usuarios" name="usuarios" value='<?php echo json_encode($usuarios); ?>' hidden >-->
<input id='tipo_transaccion' name='tipo_transaccion' value='<?php echo json_encode($tipo_transaccion); ?>' hidden>

<table class="table" style="width: 20cm; padding: 0;" >
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
                <font size="3" face="arial"><b>INVENTARIO DE ENVASES</b></font> <br>
                <!--<font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0" >


        </td>
    </tr>     
    
</table>


<div class="container no-print">
    <center>
        
<!--        <div class="col-md-2">
            Tipo: 
            <select class="btn btn-success form-control" id="tipo_prestamo">
                <option value="1">PRESTAMOS</option>
                <option value="2">DEVOLUCIONES</option>
            </select>
        </div>
        
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
        <?php }else{ ?>
        <input type="text" id="select_usuario" id="select_usuario" value="<?php echo $usuario_id; ?>" hidden=""/>
        <?php } ?>
        
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>-->
        
        <div class="col-md-2">

            <br>
            <button class="btn btn-sm btn-facebook btn-sm btn-block form-control"   onclick="inventario_envases()">
                
                <span class="fa fa-list"></span><b> Mostrar Todo</b>
                
            </button>
            
        </div>        
        
    </center>    
   
</div>
<br>


<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el cliente, fecha, total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th rowspan="2">N</th>
                        <th rowspan="2">Producto</th>
                        <th rowspan="2">Envase</th>
                        <th rowspan="2">Cantidad<br>Envases</th>
<!--                        <th  rowspan="2"align="center">Cantidad<br>Envases</th>
                        <th rowspan="2">Prestados</th>
                        <th rowspan="2">Devueltos</th>
                        <th rowspan="2">Existencia</th>
                        <th rowspan="2">Vendedor</th>-->
                        <th colspan="3">Inventario</th>
                        
                        <th rowspan="2">Total<br>(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                        <th rowspan="2">Total<br>(<?php
                                        if($parametro[0]["moneda_id"] == 1){
                                            echo $lamoneda[1]['moneda_descripcion'];
                                        }else{
                                            echo $lamoneda[0]['moneda_descripcion'];
                                        }
                                    ?>)
                        </th>
                    </tr>
                    <tr>                       
                        <th>Costo (<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                        <th>Prestados</th>
                        <th>Saldo</th>
                        
                    </tr>
                                       
                    <tbody class="buscar" id="tabla_inventario">

                        <!-- Aqui de acomoda la tabla de pedidos -->
                        
                    </tbody>
                </table>
                                
            </div>
            
            
<!--            
            <div class="box-body table-responsive" id="tabla_resumen">

                                
            </div>-->

            
            

        </div>
    </div>
</div>
</body>


<!-- Button trigger modal -->
<div hidden="">
    <button type="button" class="btn btn-primary" id="boton_modal" data-toggle="modal" data-target="#modal_devolucion">
      Devolución
    </button>    
</div>

