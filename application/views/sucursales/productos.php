<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/inventario.js'); ?>"></script>

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
        $(document).ready(function () {
            (function ($) {
                $('#filtrar2').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar2 tr').hide();
                    $('.buscar2 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });   

</script>   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
    <!-- Styles for datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <!-- JQuery include -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
    <!-- Javascrips for datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>    
    <!-- Now make the SmartGrid work with datatables 
         'sg-table' is the id of the main table in SmartGrid -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sg-table').DataTable();
        });
    </script> 




<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden />
<input type="hidden" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales" />
<?php
$decimales = $parametro['parametro_decimales'];
?>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">

<!-------------------------------------------------------->
<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
                
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
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>INVENTARIO POR PRODUCTO</b></font> <br>
                <!--<font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>-->
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0" >
<!--                ______________________________                
                   
                                
                <div id="datos_recorrido">
                    
                </div>
                
                ______________________________-->
        </td>
    </tr>
     
    
    
</table>

<div class="box-header no-print">
    
        <?php echo form_open('sucursales'); ?>
    
            <div class="col-lg-4">
            <center>

            <h5 class="box-title" style="font-family: Arial; font-size: 12pt;">        
                <select class="btn btn-success btn-sm" id="select_almacen">
                        <?php   
                            foreach($almacenes as $almacen){ ?>
                             
                                    <option value="<?php echo $almacen["almacen_basedatos"]; ?>"><?php echo $almacen["almacen_nombre"] ?></option>

                            <?php } ?>
                            
                </select>
                <button class="btn btn-danger btn-sm" id="boton_buscarproducto"><fa class="fa fa-binoculars"></fa> Buscar</button>
            </h5>

            </center>
            </div>
    
        <?php echo form_close(); ?>
            
    <div class="col-lg-8">
        <center>
            
        <div class="box-tools no-print">

            <!--<button class="btn btn-success btn-sm" onclick="actualizar_inventario()" type="button"><span class="fa fa-cubes"></span> Actualizar</button>-->
            <?php if($rolusuario[27-1]['rolusuario_asignado'] == 1){ ?>
            <!--<button class="btn btn-primary btn-sm" onclick="tabla_inventario()" type="button"><span class="fa fa-list"></span> Mostrar todo</button>-->

            <!--<button class="btn btn-info btn-sm" onclick="tabla_inventario_existencia()" type="button"><span class="fa fa-list-ol" title="Ver Produtos con Existencia"></span> Con Existencia</button>-->
            <?php } if($rolusuario[28-1]['rolusuario_asignado'] == 1){ ?>
            <!--<button class="btn btn-facebook btn-sm" onclick="mostrar_duplicados()" type="button"><span class="fa fa-copy"></span> Prod. Duplicados</button>-->

            <?php } ?>

            <button type="button" class="btn btn-vimeo btn-sm" data-toggle="modal" onclick="comparar_productos()"><span class="fa fa-cubes" title="Comparar lista de productos"></span> Comparar productos</button>
            
            <button type="button" class="btn btn-facebook btn-sm" data-toggle="modal" onclick="actualizar_inventarios()"><span class="fa fa-cubes" title="Actualiza los inventarios de las SUCURSALES/ALMACENES"></span> Actualizar Inventarios</button>

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><span class="fa fa-binoculars"></span> Buscar Producto</button>
        </div>
        </center>
        
    </div>
</div>

<div class="row" id='loaderindex'  style='display:none;'>
                    <center>
                        <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                    </center>
                </div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
<!--                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar3" type="text" class="form-control" placeholder="Ingrese nombre">
                  </div>-->
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <?php
                if(isset($inventario)){ ?>
                    <?php
                    if(sizeof($inventario) >0 ){ ?>
                    <font style="font-family: Arial; font-size: 10pt; ">

                        <b>PRODUCTO:</b> <?php echo $inventario[0]["producto_nombre"]; ?>
                        <b>CÓDIGO BARRA:</b> <?php echo $inventario[0]["producto_codigobarra"]; ?>
                    </font>
                    <?php
                    }else{
                        echo "<span class='text-bold text-red'>Producto Inexistente!!</span>";
                    }
                } ?>
                
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <!--<th>Sucursal</th>-->
                        <th>Producto</th>
                        <th>Codigo</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <?php
                        $totalalmacen = sizeof($almacenes);
                        for($i=0 ; $i<sizeof($almacenes); $i++){
                            echo "<th>".$almacenes[$i]['almacen_nombre']."</th>";
                        }
                        ?>
                        <th>Existencia</th>
                        <th>Total</th>
                        <th class="no-print"></th>
                    </tr>
                    <tbody class="buscarj">
                        <?php
                        if(isset($inventario)){
                            if(sizeof($inventario) >0 ){
                                    
                                $total = 0;    
                                $cantidad = 0;
                                $existencia = 0;
                                foreach($inventario as $suc0){
                                    if($suc0!=null){
                                    
                                    
                                    $total += $suc0["existencia"] * $suc0["producto_precio"];
                                    //$cantidad += $suc0["existencia"]; 
                                    
                                ?>
                                <tr>
                                    <td><?php echo $suc0["producto_nombre"]; ?></td>
                                    <td><?php echo $suc0["producto_codigo"]; ?></td>
                                    <td style="text-align: right"><?php echo number_format($suc0["producto_costo"],2,".",","); ?></td>
                                    <td style="text-align: right"><?php echo number_format($suc0["producto_precio"],2,".",","); ?></td>
                                    <?php
                                    if(1 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc1"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                    $lacantidad = 0;
                                    if ($suc0["suc1"] == "" && $suc0["suc1"] == null){
                                            echo $lacantidad;
                                    }else{
                                        $partes = explode(".",$suc0["suc1"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc1"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                    }
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(2 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc2"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                    $lacantidad = 0;
                                    if ($suc0["suc2"] == "" && $suc0["suc2"] == null){
                                            echo $lacantidad;
                                    }else{
                                        $partes = explode(".",$suc0["suc2"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc2"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                            
                                    }
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(3 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc3"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                        $partes = explode(".",$suc0["suc3"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc3"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(4 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc4"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                        $partes = explode(".",$suc0["suc4"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc4"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(5 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc5"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                        $partes = explode(".",$suc0["suc5"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc5"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(6 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc6"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                        $partes = explode(".",$suc0["suc6"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc6"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(7 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc7"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                        $partes = explode(".",$suc0["suc7"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc7"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(8 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc8"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                        $partes = explode(".",$suc0["suc8"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc8"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(9 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc9"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                        $partes = explode(".",$suc0["suc9"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc9"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    ?>
                                    <?php
                                    if(10 <= $totalalmacen){
                                        $fondocolor = '';
                                        if($suc0["suc10"] <= 0){
                                            $fondocolor = 'background-color: #FF8989;';
                                        }
                                    ?>
                                    <td class='text-right' style="padding:0; <?php echo $fondocolor; ?>">
                                    <?php
                                        $partes = explode(".",$suc0["suc10"]);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = $partes[0];
                                            }else{ 
                                                $lacantidad = number_format($suc0["suc10"],$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = $partes[0];
                                        }
                                            echo $lacantidad;
                                        ?>
                                    </td>
                                        <?php
                                        $cantidad += $lacantidad;
                                        $existencia += $lacantidad;
                                    }
                                    
                                    /* **** inico para mostrar total parcial! **** */
                                    $partes = explode(".",$existencia);
                                    if(isset($partes[1])){
                                        if ($partes[1] == 0) { 
                                            $laexistencia = number_format($partes[0],0,'.',',');
                                        }else{ 
                                            $laexistencia = number_format($existencia,$decimales,'.',','); 
                                        }
                                    }else{
                                        $laexistencia = number_format($existencia,0,'.',','); 
                                    }
                                    
                                    ?>
                                    <td style="text-align: center; font-family: Arial; font-weight: bold; font-size: 12pt;"><?php echo $laexistencia; ?></td>
                                    <td style="text-align: center; font-family: Arial; font-weight: bold; font-size: 12pt;"><?php echo number_format($existencia * $suc0["producto_costo"],2,".",","); ?></td>
                                    <td>
                                        <button class="btn btn-xs btn-info"><fa class="fa fa-arrow-right"> </fa></button>
                                    </td>
                                </tr> 
                                <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <?php
                                    for($i=0 ; $i<sizeof($almacenes); $i++){
                                        echo "<th></th>";
                                    }
                                    ?>
                                    <th style="text-align: center; font-family: Arial; font-weight: bold; font-size: 12pt;">
                                        <?php
                                        $partes = explode(".",$cantidad);
                                        if(isset($partes[1])){
                                            if ($partes[1] == 0) { 
                                                $lacantidad = number_format($partes[0],0,'.',',');
                                            }else{ 
                                                $lacantidad = number_format($cantidad,$decimales,'.',','); 
                                            }
                                        }else{
                                            $lacantidad = number_format($cantidad,0,'.',','); 
                                        }
                                        
                                        echo $lacantidad;
                                        ?>
                                    </th>
                                    
                                    <th style="text-align: center; font-family: Arial; font-weight: bold; font-size: 12pt;">
                                        <?php echo number_format($cantidad*$suc0["producto_costo"],2,".",","); ?>
                                    </th>
                                    <th></th>
                                </tr>
                                
                                
                                
                                
                                <?php
                                }
                                
                                        }
                                
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLongTitle"><b>BUSCAR PRODUCTO</b></h5>
            <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código"   onkeypress="validar(event,2)" >
            </div>
      </div>
      <div class="modal-body">
       
        <!---------------------- BUSCADOR DE PRODUCTOS ----------------------------------->  
        <div class="row">
            <div class="col-md-12">
                    <!--------------------- parametro de buscador --------------------->
                    <!--------------------- fin parametro de buscador ---------------------> 
                    <div class="box">

                               <!--------------------- inicio loader ------------------------->
                            <div class="row" id='loader'  style='display:none;'>
                                <center>
                                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                </center>
                            </div> 
                            <!--------------------- fin inicio loader ------------------------->

                        <div class="box-body  table-responsive" >

                            <div id="tabla_inventario">

                            <!-------------------- aqui se muestra la tabla de productos del inventario--------------------->

                            </div>
                        </div>
                    </div>
        </div>
        </div>  
          
        <!---------------------- BUSCADOR DE PRODUCTOS ----------------------------------->  
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>


<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL OPERACIONES ----------------------------------->
<!------------------------------------------------------------------------------->


<div >
    <button type="button" id="boton_guardarventa" class="btn btn-default" data-toggle="modal" data-target="#modalguardarventa" >
      OPERACIONES CON SUCURSALES
    </button>
    
</div>

<div class="modal fade" id="modalguardarventa" tabindex="-1" role="dialog" aria-labelledby="modalguardarventa" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">OPERACIONES CON SUCURSALES</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-content">
			<div class="modal-header">
                            

                            <!--<h4 class="modal-title" id="myModalLabel"><b>PEDIDOS/PREVENTAS</b></h4>-->
                                
                            <div class="input-group"> <span class="input-group-addon">Producto</span>
                                <input id="nombre_venta" type="text" class="form-control" placeholder="Producto, Codigo de barras, Codigo de Producto" onKeyUp="this.value = this.value.toUpperCase();">
                            </div>
                                
			</div>

                        <div class="box-body table-responsive">

                                    <div class="col-md-6">
                                            <label for="sucursal_id" class="control-label"><span class="text-danger">*</span>Sucursal/Depósito</label>
						<div class="form-group">
                                                        <select class="btn btn-default form-control" id="select_almacen">
								<option value="0">- SUCURSAL/DEPOSITO -</option>
                                                                <?php   
                                                                    foreach($almacenes as $almacen){ ?>

                                                                            <option value="<?php echo $almacen["almacen_basedatos"]; ?>"><?php echo $almacen["almacen_nombre"] ?></option>

                                                                    <?php } ?>

                                                        </select>
						</div>
                                    </div>
                            
                                    <div class="col-md-6">
                                            <label for="operacion" class="control-label"><span class="text-danger">*</span>Operación</label>
						<div class="form-group">
							<select name="operacion" id="operacion" class="form-control" required>
								<option value="0">- OPERACION -</option>
								<option value="1">Comparar productos</option>
								<option value="2">Actualizar Productos (ID)</option>
								<option value="2">Actualizar Productos (COD. BARRA)</option>
								<option value="2">Eliminar y cargar Productos</option>
                                                                
							</select>
						</div>
                                    </div>

                            

             
                        </div>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-success"  data-dismiss="modal"  onclick="actualizar_productos()"><fa class="fa fa-floppy-o"></fa> Procesar</button>
                            <button type="button" class="btn btn-danger" id="boton_cerrar_ventatemporal" data-dismiss="modal""><fa class="fa fa-times"></fa> Cancelar</button>
                        </div>
            
		</div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL OPERACIONES ----------------------------------->
<!------------------------------------------------------------------------------->

