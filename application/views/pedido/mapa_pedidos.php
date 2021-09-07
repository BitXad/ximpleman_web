<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/mapa_pedidos.js'); ?>" type="text/javascript"></script>
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
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<!--<input type="hidden" id="esrol" name="esrol" value="<?php /*echo $esrol; ?>"> -->
<input type="hidden" id="esrolconsolidar" name="esrolconsolidar" value="<?php echo $esrolconsolidar; ?>">

<input id="usuario_id" name="usuario_id" value="<?php echo $usuario_id; ?>" hidden>
<input id="pedido_id" name="pedido_id" value="0" hidden>
<!--<input id="usuarios" name="usuarios" value='<?php //echo json_encode($usuarios); ?>' hidden >-->
<input id='tipo_transaccion' name='tipo_transaccion' value='<?php echo json_encode($tipo_transaccion); ?>' hidden>
<!--<input id='tipo_venta' name='tipo_venta' value='<?php */ //echo json_encode($tipo_venta); ?>' hidden>-->

<!--<div class="box-header">
<div class="row clearfix">-->
<div class="box-header text-bolds">
    <h4><b>MAPA DE PEDIDOS</b></h4>
</div>
<!--<div class="box-body col-md-6" style="padding: 0">
    <center>
        <h3 class="box-title" style="font-family: Arial; margin: 0;" >Pedidos Realizados</h3>
    </center>
</div>-->
    
<div class="col-md-2">
    Desde: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
</div> 
<div class="col-md-2">
    Hasta: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
</div>
<div class="col-md-3">
    Vendedor/Prevendedor:
    <select id="usuario_prevendedor" name="usuario_prevendedor" class="btn btn-primary btn-sm form-control"  >
        <option value="0">-TODOS-</option>
        <?php
            foreach($all_usuario as $usuario){ ?>
                <option value="<?php echo $usuario['usuario_id']; ?>"><?php echo $usuario['usuario_nombre']; ?></option>                                                   
        <?php } ?>
     </select>
</div>
<div class="col-md-2">
    &nbsp; <a class="btn btn-facebook btn-sm form-control"  id="buscar" name="buscar" onclick="pedidos_realizados()" ><span class="fa fa-search"></span> Buscar</a>
</div>
<!--<div class="col-md-6">
    &nbsp;
    <div class="input-group" > <span class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el cliente">
    </div>
</div>-->
<div class="col-md-12">
        <!--------------------- inicio loader ------------------------->
        <div class="row" id='loader'  style='display:none;'>
            <center>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
            </center>
        </div> 
        <!--------------------- fin inicio loader ------------------------->
</div>
<div class="col-md-7">
    <h5>Pedidos encontrados: <b><span id="num_pedidos">0</span></b></h5>
</div>

    <style>
      #map{
        width: 100%; 
        height: 600px;
      }
    </style>
 
      <div class="container">
          
          <div class="col col-md-12 table-responsive">
              <table class="table">
              <tr> 
                      <td> 
                       
                        <div id="map"></div> <!-- mapa --> 
                         
                        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $parametros['parametro_apikey']; ?>"></script> 
                        <script>       
                            
                        </script> 
     
                    </td>
                  </tr> 
              </table> 
     
        </div> 
           
    </div> 
    <center> 
        <a href="<?php echo base_url("pedido"); ?>" class="btn btn-danger btn-xs"><fa class="fa fa-times"> </fa> Cerrar</a    > 
    </center> 

