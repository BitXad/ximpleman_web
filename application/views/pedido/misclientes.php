<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/pedido_diario.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(document).on("ready",inicio);
    function inicio(){
        //alert("jejeje");
        misclientes();
    }
    
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

<div class="box-body col-md-6" style="padding: 0">
    <center>
        <h3 class="box-title" style="font-family: Arial; margin: 0;" >Mis Clientes</h3>
    </center>
</div>


<div class="box-body col-md-6"  style="padding:0">
<div class="row clearfix" style="padding:0">
                    
    <?php if($tipousuario_id == 1){ ?>
    <div class="col-md-3"  style="padding:3px; margin-bottom: 0; margin-top: 0;">
        <div class="form-group" style="padding: 0;  margin-bottom: 0; margin-top: 0;">

            <select class="btn btn-warning btn-sm form-control" id="select_usuarios" onchange="misclientes()">
                    <option value="0"><?php echo "TODOS"; ?></option>
                   
            <?php foreach($usuario as $u){ 
                    $selected = ($u['usuario_id'] == $usuario_id)?"selected":"";
                ?>
                    <option value="<?php echo $u['usuario_id']; ?>" <?php echo $selected; ?>><?php echo $u['usuario_nombre']?></option>
            <?php } ?>
            </select>
            
        </div>
    </div>
    <?php } else{?>
    <div hidden="true">
        
            <input class="btn btn-warning btn-sm form-control" id="select_usuarios" value="<?php echo $usuario_id; ?>">
    </div>
    
    <?php } ?>
    
    <?php $dia = date('w'); 
    ?>
    
    <div class="col-md-6"  style="padding:3px">
        <div class="form-group" style="margin-bottom: 0;">
            <center>
                
                <select id="dia_visita" class="btn btn-info btn-sm" style="width: 100px;" onchange="misclientes()">
                    <option value="1" <?php echo ($dia==1)?"selected":""; ?>>LUNES</option>
                    <option value="2" <?php echo ($dia==2)?"selected":""; ?>>MARTES</option>
                    <option value="3" <?php echo ($dia==3)?"selected":""; ?>>MIERCOLES</option>
                    <option value="4" <?php echo ($dia==4)?"selected":""; ?>>JUEVES</option>
                    <option value="5" <?php echo ($dia==5)?"selected":""; ?>>VIERNES</option>
                    <option value="6" <?php echo ($dia==6)?"selected":""; ?>>SABADO</option>
                    <option value="7" <?php echo ($dia==0)?"selected":""; ?>>DOMINGO</option>
                    <option value="0" >TODOS</option>
                    
                </select>
                
                
                <a href="<?php echo site_url('pedido'); ?>" class="btn btn-success btn-sm " target="_blank" style="width: 100px;"><span class="fa fa-cart-arrow-down"></span> <?php echo $pedido_titulo; ?></a>
                <button target="_blank" class="btn btn-facebook btn-sm" style="width: 100px;" onclick="mapa_clientes()"><span class="fa fa-map"></span> Mapa</button>                
            </center>
        </div>
    </div>
    
    
    
</div>
</div>
<!---------------------------------- panel oculto para busqueda--------------------------------------------------------->
<?php
    $date = date('Y-m-d');
?>

<!------------------------------------------------------------------------------------------->


<div class="row">
    <div class="col-md-12" style=" margin-bottom: 0; margin-top: 0;">
                

        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group" style=" margin-bottom: 0; margin-top: 0;"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el cliente, pedido, dirección">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
        
        
            <!--------------------- inicio loader ------------------------->
            <div class="row" id='loader'  style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                </center>
            </div> 
            <!--------------------- fin inicio loader ------------------------->

            
            <div class="box-body table-responsive" style="padding: 0;">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th style="padding: 0;">#</th>
                        <th style="padding: 0;">Cliente/Direccion/Teléfono</th>
                        <th style="padding: 0;">Ord</th>
                        <th style="padding: 0;"> </th>
                        <th style="padding: 0;"> </th>
                    </tr>
                    <tbody class="buscar" id="tabla_clientes">

                        <!-- Aqui de acomoda la tabla de pedidos -->
                    
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
</body>

<!--<fa class="fa fa-cart-arrow-down"></fa>-->

<div hidden="true">
    
<button type="button" id="boton_modal_cliente" class="btn btn-primary" data-toggle="modal" data-target="#modalcliente" >
  Launch demo modal
</button>
    
</div>
<!----------------- modal preferencias ---------------------------------------------->

<div class="modal fade" id="modalcliente" tabindex="-1" role="dialog" aria-labelledby="modalcliente" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="padding: 0; background-color: #46b8da">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel" style="font-family: Arial;"><b><fa class="fa fa-user"></fa> CLIENTE</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                            </center>
                            
                    </div>
                    <div class="modal-body" style="padding: 0;">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive" id="tabla_datos">

                        </div>
                        
                        <!----------------------FIN TABLA--------------------------------------------------->

                    </div>
                    <div class="modal-footer" style="padding: 0;">
                        
                        <div class="col-md-6" id='botones'>
                                <div class="form-group">
                                    <center>
                                        
                                        <button class="btn btn-success btn-sm" id="boton_generar_pedido" onclick="generar_pedido()"  data-dismiss="modal">
                                            <span class="fa fa-cart-arrow-down"></span> <?php echo $pedido_titulo; ?>
                                        </button>                                   
                                        
                                        <button class="btn btn-danger btn-sm" id="boton_cerrar" data-dismiss="modal" >
                                            <span class="fa fa-close"></span>   Cerrar
                                        </button>                                        
                                    </center>                                        
                                </div>
                        </div>
                        
                    </div>
		</div>
	</div>
</div>


<!----------------- fin modal preferencias ---------------------------------------------->

    <div class="col-md-6"  style="padding:0px">
        <div class="form-group" style="margin-bottom: 0; padding: 0;">
            <center>
                <!--<a href="<?php // echo site_url('pedido/misclientes'); ?>" class="btn btn-facebook btn-sm " target="_blank" style="width: 80px; background-color: purple;"><span class="fa fa-user-circle-o"></span> Clientes</a>-->
                <a href="<?php echo site_url('pedido/pedidoabierto/0'); ?>" class="btn btn-success btn-sm " target="_blank" style="width: 100px;"><span class="fa fa-cart-arrow-down"></span> <span class="fa fa-user-plus"></span> <?php echo $pedido_titulo; ?></a>
                <a href="<?php echo site_url('recorrido'); ?>" class="btn btn-info btn-sm" style="width: 100px;"><span class="fa fa-pie-chart"></span> Estadistica</a>
                <!--<a href="<?php // echo site_url('pedido/mapa_entregas'); ?>" target="_blank" class="btn btn-facebook btn-sm" style="width: 80px;"><span class="fa fa-map"></span> Mapa</a>-->                
            </center>
        </div>
    </div>
