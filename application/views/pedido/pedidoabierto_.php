<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/funciones_pedido.js'); ?>"></script>

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
        $(document).ready(function () {
            (function ($) {
                $('#filtrar3').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar3 tr').hide();
                    $('.buscar3 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });    
        $(document).ready(function () {
            (function ($) {
                $('#filtrar4').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar4 tr').hide();
                    $('.buscar4 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });    

function mostrar_ocultar(){
    var x = document.getElementById('tipo_transaccion').value;
    
    if (x=='2'){ //si la transaccion es a credito
        
        document.getElementById('creditooculto').style.display = 'block';
//        var hoy = new Date();
//        var dd = hoy.getDate();
//        var mm = hoy.getMonth()+1;
//        var yyyy = hoy.getFullYear();
//        
//        dd = addZero(dd);
//        mm = addZero(mm);

        }
    else{
            document.getElementById('creditooculto').style.display = 'none';}
}



function mostrar_buscadores(){
    document.getElementById('buscador1').style.display = 'block';
    document.getElementById('categoria').style.display = 'block';
    
    //document.getElementById('filtrar4').focus();

}
        
function cerrar_ventana(){
   //window.opener.location.reload();
   window.open('', '_self', '');
    window.close();
}
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
 <!--<link rel="stylesheet" type="text/css" href="estilos.css" />-->
<!-------------------------------------------------------->
<div id="selector" hidden="">
    <!--  Aqui inserta in input temporal que sirve para almacenar el factor de conversion del producto -->
    
</div>

<!--------------------- CABECERA -------------------------->

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $usuario_id; ?>" id="regusuario_id" hidden>

<?php if ($tipousuario_id != 1){ ?>
    <input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>
<?php } ?>

<input type="text" value='<?php echo json_encode($categoria_producto); ?>' id="categoria_producto" hidden>
<input type="text" value='<?php echo json_encode($preferencia); ?>' id="preferencias" hidden>
<input type="text" id="pedido_id" value="0" name="pedido_id"  hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision"  hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision"  hidden>
<input type="text" id="venta_tipocambio" value="1" name="venta_tipocambio"  hidden>
<!--<input type="text" id="usuariopedido_id" value="0" name="usuariopedido_id"  hidden>-->
<input type="text" id="detalleserv_id" value="0" name="detalleserv_id"  hidden>
<input type="text" id="parametro_modoventas" value="<?php echo $parametro[0]['parametro_modoventas']; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro[0]['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro[0]['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro[0]['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro[0]['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro[0]['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro[0]['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro[0]['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" name="parametro_moneda_descripcion"  hidden>
<input type="text" id="parametro_datosboton" value="<?php echo $parametro[0]['parametro_datosboton']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" name="parametro_moneda_id"  hidden>
<input type="text" id="parametro_diasvenc" value="<?php echo $parametro[0]['parametro_diasvenc']; ?>" name="parametro_diasvenc"  hidden>
<input type="hidden" id="modificar_precioventa" value="<?php echo $rolusuario[183-1]['rolusuario_asignado']; ?>" name="modificar_precioventa">
<input type="text" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" name="tipousuario_id"  hidden>
<input type="text" id="preferencia_id" value="0" name="preferencia_id" hidden>

<input type="text" id="rol_precioventa" value="<?php echo $rolusuario[160-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor" value="<?php echo $rolusuario[161-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor1" value="<?php echo $rolusuario[162-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor2" value="<?php echo $rolusuario[163-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor3" value="<?php echo $rolusuario[164-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor4" value="<?php echo $rolusuario[165-1]['rolusuario_asignado']; ?>" hidden>


<input type="text" value="<?php echo 0; ?>" id="pedido_latitud" hidden>
<input type="text" value="<?php echo 0; ?>" id="pedido_longitud" hidden>
<input type="text" id="moneda_tc" value="<?php echo $moneda['moneda_tc']; ?>" hidden>
<input type="text" id="moneda_descripcion" value="<?php echo $moneda['moneda_descripcion']; ?>" hidden>

<!--<img src="<?php echo base_url("resources/images/logo.png"); ?>" class="img img-thumbnail" >-->
<!-------------------- inicio collapse ---------------------->

<?php
    if($pedido_titulo == "Pedidos"){
        $labelboton = "Pedido";
    }elseif($pedido_titulo == "Preventas"){
        $labelboton = "Preventa";
    }else{
        $labelboton = "Reserva";
    }
?>
´
<div class="panel-group"  style="padding:0;" >
  <div class="panel panel-warning" style="padding:0;">
    <div class="panel-heading" style="padding:0;">
        
        
<!--------------------- cliente_id --------------------->
<div class="container" hidden>
    <input type="text" name="cliente_id" id="cliente_id" value="<?php echo $cliente[0]['cliente_id']; ?>" class="form-control" id="cliente_id" >
    <input type="text" name="cdi_codigoclasificador" id="cdi_codigoclasificador" value="<?php echo $cliente[0]['cdi_codigoclasificador']; ?>" class="form-control" id="cdi_codigoclasificador" >
</div>

<!--------------------- fin cliente_id --------------------->
        
        <div class="col-md-3" >
            <label for="nit" class="control-label">NIT</label>
            <div class="form-group">
                <input type="number" name="nit" class="form-control" id="nit" value="<?php echo $cliente[0]['cliente_nit']; ?>"  onkeypress="validar(event,1)" onclick="seleccionar(1)" />
            </div>
        </div>
        
        <div class="col-md-4">
            <label for="razon social" class="control-label">RAZON SOCIAL</label>
            <div class="form-group">
                
                <!--<input type="search" name="razon_social" list="listaclientes" class="form-control" id="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" onkeypress="validar(event,2)"  onclick="seleccionar(2)" onKeyUp="this.value = this.value.toUpperCase();"/>-->
                <input type="search" name="razon_social" list="listaclientes" class="form-control" id="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" onkeypress="validar(event,9)"  onchange="seleccionar_cliente()" onclick="seleccionar(2)" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off" />
                <datalist id="listaclientes">

                </datalist>
                
            </div>
        </div>

        
        <div class="col-md-2">
            <label for="telefono" class="control-label">TELEFONO</label>
            <div class="form-group">
                <input type="telefono" name="telefono" class="form-control" id="telefono"  onkeypress="validar(event,0)" onclick="seleccionar(3)" value="<?php echo $cliente[0]['cliente_telefono']; ?>"/>
            </div>
        </div>
        
        <div class="col-md-3">
            <label for="tipo" class="control-label">TIPO CLIENTE</label>           
            <div class="form-group">
                
                <select  class="form-control" id="tipocliente_id" name="tipocliente_id" onkeypress="validar(event,7)">
                    <option value="<?php echo $tipo_cliente[0]['tipocliente_id']; ?>"><?php echo $tipo_cliente[0]['tipocliente_descripcion']; ?></option>
                    <?php $contador = 0;
                            foreach($tipo_cliente as $tc){                          
                                if ($contador>0){?>                    
                                     <option value="<?php echo $tc['tipocliente_id'];?>"><?php echo $tc['tipocliente_descripcion'];?></option>
                    <?php       }
                                $contador++;
                            }?>
                </select>
              
            </div>
        </div>        
        
      <h4 class="panel-title">
        <?php if(sizeof($dosificacion)>0){ ?>
          <input type="checkbox" id="facturado" value="1" name="facturado">
        <?php } else{ ?>
          <input type="checkbox" id="facturado" value="1" name="facturado" hidden>
          <font color="red" size="2"> Dosificación no activada</font>
        <?php } ?>
        <a data-toggle="collapse" href="#collapse1">Más</a> /
        
                        
      </h4>

    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <ul class="list-group">
        <div class="container">
            
            <div class="col-md-3">
            <label for="nombre" class="control-label">CLIENTE</label>
            <div class="form-group">
                <input type="text" name="cliente_nombre" class="form-control" id="cliente_nombre" value="<?php echo $cliente[0]['cliente_nombre']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>

            <div class="col-md-3">
            <label for="cliente_ci" class="control-label">C.I.</label>
            <div class="form-group">
                <input type="text" name="cliente_ci" class="form-control" id="cliente_ci" value="<?php echo $cliente[0]['cliente_ci']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
        

            <div class="col-md-3">
            <label for="cliente_nombrenegocio" class="control-label">NEGOCIO</label>
            <div class="form-group">
                <input type="text" name="cliente_nombrenegocio" class="form-control" id="cliente_nombrenegocio" value="<?php echo $cliente[0]['cliente_nombrenegocio']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
        

            <div class="col-md-3">
            <label for="cliente_codigo" class="control-label">CÓDIGO</label>
            <div class="form-group">
                <input type="text" name="cliente_codigo" class="form-control" id="cliente_codigo" value="<?php echo $cliente[0]['cliente_codigo']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
            
            <div class="col-md-3">
            <label for="cliente_direccion" class="control-label">DIRECCIÓN</label>
            <div class="form-group">
                <input type="text" name="cliente_direccion" class="form-control" id="cliente_direccion" value="<?php echo $cliente[0]['cliente_direccion']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>
            
            <div class="col-md-3">
            <label for="cliente_departamento" class="control-label">DEPARTAMENTO</label>
            <div class="form-group">
                <input type="text" name="cliente_departamento" class="form-control" id="cliente_departamento" value="<?php echo $cliente[0]['cliente_departamento']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>
                    
            <div class="col-md-3">
            <label for="cliente_celular" class="control-label">CELULAR</label>
            <div class="form-group">
                <input type="text" name="cliente_celular" class="form-control" id="cliente_celular" value="<?php echo $cliente[0]['cliente_celular']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>

            <div class="col-md-3">
            <label for="zona_id" class="control-label">ZONA</label>
            <div class="form-group">
                <input type="text" name="zona_id" class="form-control" id="zona_id" value="<?php echo $cliente[0]['zona_id']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>
        
        </div>

    </div>
  </div>
</div>  



<center>
    <font size="3"><b><?php echo $pedido_titulo; ?></b></font>
     <!--<a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-xs" style="width: 90px;"><font size="3"><span class="fa fa-search"></span></font><small> Buscar Clie</small></a>-->
    <button onclick="focus_cliente()" id="boton_bsucar_clie" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-xs" style="width: 90px;"><font size="3"><span class="fa fa-search"></span></font><small> Buscar Clie</small></button>
    
     <!--<button class="btn btn-facebook btn-xs"><span class="fa fa-users"> </span>Buscar Cliente</button>-->
     <a href="<?php echo base_url("cliente/clientenuevo/0"); ?>" class="btn btn-info btn-xs" style="width: 90px;"><font size="3"><span class="fa fa-user" ></span></font> Nuevo</a>
     <button class="btn btn-facebook btn-xs" onclick="mostrar_buscadores()" title="Buscar productos"><font size="3"><span class="fa fa-binoculars" ></span></font></button>
</center>   

<div class="container">
    <div class="panel panel-primary">
        
        <table>
            <tr>
                <td style="width: 0.2cm;">
                    
                </td>
                <td>
                    <?php if(isset($cliente[0]['cliente_foto'])){ ?>
                        <img src="<?php echo base_url("resources/images/clientes/".$cliente[0]['cliente_foto']); ?>" width="70" height="80">
                    <?php }else{ ?>
                        <img src="<?php echo base_url("resources/images/clientes/thumb_foto.jpg"); ?>" width="70" height="80">
                    <?php } ?>
                    
                    <br><button class="btn btn-warning btn-xs" data-toggle="collapse" data-target="#informacioncliente">más inform.</button>
                </td>
                <td style="width: 0.2cm;">
                    
                </td>
                <td style="line-height: 10px;"> 
                    <font size="1" face="arial">
                        <b>CLIENTE: </b><?php echo $cliente[0]['cliente_nombre']; ?> <br>
                        <?php echo $cliente[0]['cliente_nombrenegocio']." ".$cliente[0]['cliente_celular']; ?> <br>                     
                        <b>CÓDIGO: </b><?php echo $cliente[0]['cliente_codigo']; ?> <br>
                        <b>DIRECCIÓN: </b><?php echo $cliente[0]['cliente_direccion']; ?> <br>
                        <b>ZONA: </b><?php echo $cliente[0]['zona_id']; ?> <br>                     
                        <b>TELF(S): </b><?php echo $cliente[0]['cliente_telefono']." ".$cliente[0]['cliente_celular']; ?> <br>                     
                    </font>
                    
                </td>
            </tr>
        </table>
        


<div id="informacioncliente" class="collapse">
    <div class="container">
    <div class="panel panel-primary col-md-10">
        
        <table>      
            <tr style="line-height: 10px;">
                <td style="width: 0.2cm" > 
                </td> 
        
                
                <td> 
                    <font size="1" face="arial">

                        <b>NIT: </b><?php echo $cliente[0]['cliente_nit']; ?> <br>                     
                        <b>RAZON SOCIAL: </b><?php echo $cliente[0]['cliente_razon']; ?> <br>                     
                        <b>DEPARTAMENTO: </b><?php echo $cliente[0]['cliente_departamento']; ?> <br>                     
                        <b>EMAIL: </b><?php echo $cliente[0]['cliente_email']; ?> <br>                     
                        <b>TIPO: </b><?php echo $cliente[0]['tipocliente_descripcion']; ?> <br>                     
                        <b>CATEGORIA: </b><?php echo $cliente[0]['categoriaclie_descripcion']; ?> <br>                     
                    
                    </font>
                        <?php if ($cliente[0]['cliente_id']>0){ ?>
                            <a href="<?php echo base_url("cliente/modificar_cliente/".$cliente[0]['cliente_id']); ?>" class="btn btn-primary btn-xs"><fa class="fa fa-pencil"> </fa> Modificar Cliente</a>
                        <?php } ?>
                        
                        <br>    
                        <br>
                </td>
            </tr>
            <tr>
             
                <td colspan="2">
                    <b>
                        RESPUESTAS CLIENTE
                    </b> 
                    <select class="btn btn-default btn-xs" id="tiporespuesta_id">
                        <option value="0"> REGISTRAR PEDIDO </option>
                        <?php foreach($tipo_respuesta as $t){ ?>
                                <option value="<?php echo $t["tiporespuesta_id"]; ?>"><?php echo $t["tiporespuesta_descripcion"]; ?></option>
                        <?php } ?>
                    </select>
                    <br><b>DETALLE</b><br>
                    <input type="text" id="recorrido_detalleresp" value="-" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);">
                    
                    <button onclick="registrar_recorrido()" class="btn btn-success btn-sm"><fa class="fa fa-floppy-o"> </fa> Registrar Respuesta </button>
                  
                        <br>
                        <br>
                </td>
            </tr>
                
        </table>
    </div>
    </div>


</div>

    </div>
</div>




<!-------------------- fin inicio collapse ---------------------->

<!--------------------- FIN CABERECA -------------------------->


<div class="row">
    <div class="col-md-6" >
        
        <div class="row" id="buscador1" style="display: none;">
            
            <!--------------------- parametro de buscador por codigo --------------------->

            <div class="col-md-4">
                  <div class="input-group">
                      <span class="input-group-addon"> 
                        <i class="fa fa-barcode"></i>
                      </span>           
                      <input type="text" name="codigo" id="codigo" class="form-control" placeholder="código" onkeyup="validar(event,3)">
                  </div>
            </div>      
           <!--------------------- fin buscador por codigo --------------------->
           

           <div class="col-md-8">
                
<!--            ------------------- parametro de buscador --------------------->
                       
                  <div class="input-group">
                      <span class="input-group-addon" onclick="ocultar_busqueda();"> 
                        Buscar 
                      </span>           
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código" onkeypress="validar(event,4)">
                      <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultados(1)" title="Buscar"><span class="fa fa-search"></span></div>
                  </div>
            
<!--            ------------------- fin parametro de buscador ------------------- -->
            
            </div>
            
        </div>
<!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria" style="padding:0; display: none;">
    <span class="badge btn-danger">
        <select lect class="bange btn-danger" style="border-width: 0; width:110px;"  onchange="tablaresultados(2)" id="categoria_prod">
            <option value="0" >- CATEGORIAS -</option>
            <?php 
                foreach($categoria_producto as $categ){ 
                    $selected = ($categ['categoria_id'] == $parametro[0]['parametro_mostrarcategoria']) ? ' selected="selected"' : "";
                    ?>
                    <option value="<?php echo $categ['categoria_id']; ?>" <?php echo $selected; ?>><?php echo $categ['categoria_nombre']; ?></option>
            <?php
                }
            ?>
        </select>
    </span>
    <span class="badge btn-danger">
        <select class="bange btn-danger" style="border-width: 0; width:120px;"  onchange="tablaresultados(3)" id="subcategoria_prod">
            <option value="0" >- SUB CATEGORIAS -</option>
        </select>
    </span>
    <span class="badge btn-facebook">
        <input style="border-width: 0; color: black;" id="encontrados" type="text"  size="3" value="0" readonly="true">
    </span>
    <button class="btn btn-success btn-xs" onclick="actualizar_inventario()"><span class="fa fa-cubes"></span> Inventario</button>
    <?php 
    if ($parametro[0]["parametro_agruparitems"] == 1 ){
        $agrupar = "checked='true'";
    }else {$agrupar = " ";}
    ?>
    <button class="btn btn-primary btn-xs"><input type='checkbox' id='check_agrupar' class="btn btn-success btn-xs"  value='1' <?php echo $agrupar; ?>> Agrupar</button>
    <span class="badge btn-default text-center">
        <!--------------------- inicio loader ------------------------->
        <div class="row" id='oculto'  style='display:none;'>
                <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
        </div>
        <!--------------------- fin inicio loader ------------------------->
    </span>
</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
        
        <div class="box">
            <div class="box-body  table-responsive" id="tablaresultados">

                <!------------------ aqui van los resultados de la busqueda --------------->
                
            </div>
               
        </div>
    </div>
    
    <div class="col-md-6" id="divventas1" style="display:none;">
        <center>            
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>">
        </center>
    </div>
        
    <div class="col-md-6" id="divventas0" style="display:block;">
        <div class="row" style="display: none;">
            
            <div class="col-md-8" style="padding:0;">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código">
                  </div>
            
            <center>
                
                
            <!--------------- botones ---------------------->
            <?php if($parametro[0]["parametro_modulorestaurante"]==0){ //1 es normal ?>
                <?php if($rolusuario[13-1]['rolusuario_asignado'] == 1){ ?>
                    <a href="#" data-toggle="modal" data-target="#modalpedidos" class="btn btn-facebook btn-xs"><span class="fa fa-cubes"></span><b> Pedidos</b></a> 
                <?php }
                } ?>
                    
            <?php if($parametro[0]["parametro_modulorestaurante"]==1){ //1 es modo restaurante?>            
                    <!--<a href="<?php echo base_url('venta/ultimacomanda');?>" data-toggle="modal" target="_blank" class="btn btn-facebook btn-xs" id="imprimir_comanda"><span class="fa fa-print"></span><b> Comanda</b></a>--> 
            <?php } ?>            
           
<!--            <button onclick='quitartodo()' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span><b> Vaciar</b></button> -->
            <?php if($rolusuario[14-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-success btn-xs"><span class="fa fa-cubes"></span><b> Finalizar</b></a> 
            <?php }
            if($rolusuario[15-1]['rolusuario_asignado'] == 1){ ?>
            <button onclick='costo_cero()' class='btn btn-danger btn-xs'><span class='fa fa-battery-0'></span><b> - 0 -</b></button> 
            <?php }
            if($rolusuario[16-1]['rolusuario_asignado'] == 1){ ?>
            <button onclick='precio_costo()' class='btn btn-warning btn-xs'><span class='fa fa-money'></span><b> costo</b></button> 
            <?php }
            if($rolusuario[17-1]['rolusuario_asignado'] == 1){ ?>
            <a href="<?php echo base_url('venta/ultimaventa');?>" data-toggle="modal" target="_blank" class="btn btn-primary btn-xs" id="imprimir"><span class="fa fa-print"></span><b> Imprimir</b></a> 
            <?php } ?>
            </center>
            <!--------------- fin botones ---------------------->
            
            <!--------------------- fin parametro de buscador ---------------------> 
        
        </div>
            
            <div class="col-md-4" style="background-color: black;">
                <center>
                    
                <font size="4" style="color:white">
                    
                
                <b>Total Final</b>
                <b><?php echo $parametro[0]["moneda_descripcion"]; ?> <input type="text" id="venta_subtotal" name="venta_subtotal" value="0.00" style="width: 150px; border-color: black; border-width: 0; background-color: black; text-align: center" readonly> </b>
                </font>
    
                </center>

                
            </div>
        </div>
        
        <div class="box">
           
            
            <div class="box-body table-condensed table-responsive">
                <div id="tablaproductos">
                    
                    <!--------------- RESULTADO TABLA DE PRODUCTOS---------------------------->
                    
                </div>
            </div>
                
        </div>
        
        <!----------------------------------- BOTONES ---------------------------------->
        <?php 
        $ancho_boton = 120; 
        $alto_boton = 120; 
        
        ?>
        <div class="col-md-12" style="padding:0;">

            <center>
            
                <a href="#" data-toggle="modal" onclick="focus_efectivo()" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-money fa-4x"></i><br><br>Finalizar <?php echo $labelboton; ?><br>
            </a>
            
                
<!--            <a href="#" data-toggle="modal" data-target="#modalinventario" class="btn btn-sq-lg btn-primary" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-truck fa-4x"></i><br><br>
               Asignar <br>
            </a>-->

            
                <button  onclick="cerrar_ventana()" class="btn btn-sq-lg btn-danger" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-sign-out fa-4x  "></i><br><br>
               Salir <br>
            </button>    
                
            </center>
            <br>
        </div>    
        <!----------------------------------- fin Botones ---------------------------------->

    </div>
    
</div>

<div class="col-md-6">
        
        
<!----------- tabla detalle cuenta ----------------------------------->
<!--        <div class="box-header">
            <h3 class="box-title">CUENTA: PEDIDO</h3>
        </div>        -->
        
<?php 
    $total_detalle = 0;
    $subtotal = $total_detalle;
    $descuento = 0;
    $totalfinal = $total_detalle;
?>
        
        <div class="row">
            <div class="col-md-12" id="detallecuenta">

        </div>
        </div>
        
    <!----------- fin tabla detalle cuenta ----------------------------------->
        
    </div>


<!----------------------Modal Cobrar--------------------------------------------------->
<!--<form action="<?php echo base_url('venta/finalizarventa'); ?>"  method="POST" class="form" name="finalizarventa">-->
<div class="modal fade" id="modalfinalizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                            
                        <div class="container">
                            
                                <center>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                    
                                    <div class="col-md-2" style="padding: 0;">
<!--                                        <h4 class="modal-title" id="myModalLabel"><b>FECHA DE ENTREGA</b></h4>
                                        <?php                                                     
                                            $fecha = date('Y-m-d'); 
                                            $hora = date('H:i:s');                                                                                         
                                        ?>
                                        
                                        <input type="datetime-local" id="fechahora_entrega" name="fechahora_entrega" value="<?php echo $fecha."T".$hora;?>" required>-->
                                        <!--<h5 class="modal-title" id="myModalLabel"><b>FORMA DE PAGO</b></h5>-->
                                        <div hidden>                                            
                                            <select id="forma_pago"  name="forma_pago" class="btn btn-default btn-xs" style="width: 120px;" >
                                                <?php
                                                    foreach($forma_pago as $forma){ ?>
                                                        <option value="<?php echo $forma['forma_id']; ?>"><?php echo $forma['forma_nombre']; ?></option>                                                   
                                                <?php } ?>

                                             </select>
                                        </div>
                                        
                                        <h5 class="modal-title" id="myModalLabel"><b>FECHA ENTREGA</b></h5>
                                        <?php 
                                            $ahora = time();
                                            $unDiaEnSegundos = 24 * 60 * 60;
                                            $manana = $ahora + $unDiaEnSegundos;
                                            $mananaLegible = date("Y-m-d", $manana);
                                            # ahoraLegible únicamente es para demostrar
                                            //$ahoraLegible = date("Y-m-d H:i:s", $ahora);
                                        ?>
                                        <input type="date" id="pedido_fechaentrega" name="pedido_fechaentrega" value="<?php echo $mananaLegible; ?>" class="btn btn-default btn-xs" style="width: 120px;">
                                    </div>
                                        
                                    <div class="col-md-2" style="padding: 0;">                                      
                                        <h5 class="modal-title" id="myModalLabel"><b>HORA ENTREGA</b></h5>
                                        <input type="time" id="pedido_horaentrega" name="pedido_horaentrega"  value="<?php echo date('H:i:s'); ?>" class="btn btn-default btn-xs" style="width: 120px;">
                                    </div>
                                    
                                    <div class="col-md-2" style="padding: 0;">
                                        <center>
                                            
                                        <h5 class="modal-title" id="myModalLabel"><b>TIPO TRANS</b></h5>                                        
                                        <select id="tipo_transaccion" name="tipo_transaccion" class="btn btn-default btn-xs"  onchange="mostrar_ocultar()"  style="width: 120px;">
                                            <?php
                                                foreach($tipo_transaccion as $tipo){ ?>
                                                    <option value="<?php echo $tipo['tipotrans_id']; ?>"><?php echo $tipo['tipotrans_nombre']; ?></option>                                                   
                                            <?php } ?>
 
                                         </select>
                                        </center>
                                    </div>
                                    
                                    <?php 
                                            $ocultar = "none";
                                        if ($parametro[0]["parametro_modulorestaurante"]==1){    
                                            $ocultar = "block";
                                            
                                    } ?>   
                                    <div class="col-md-2" style="padding: 0; display: <?php echo $ocultar; ?>">
                                        <h5 class="modal-title" id="myModalLabel"><b>SERVICIO</b></h5>                                        
                                        <select id="tiposerv_id" name="tiposerv_id" class="btn btn-default btn-xs"  style="width: 100px;">
                                                
                                            <?php
                                                foreach($tipo_servicio as $ts){ ?>
                                                    <option value="<?php echo $ts['tiposerv_id']; ?>"><?php echo $ts['tiposerv_descripcion']; ?></option>
                                            <?php } ?>
 
                                         </select>
                                        <select id="venta_numeromesa" name="venta_numeromesa" class="btn btn-default btn-xs">
                                                
                                                    <option value="0">MESA</option>
                                            <?php $mesas = 30;
                                                for($x = 1; $x<=$mesas; $x++ ){ ?>
                                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                            <?php } ?>
 
                                         </select>
                                        
                                    </div>
                                    
                                    
                                </div>                                    
                                                                                             
			</div>
			</div>
                            
			<div class="modal-body">
                            
<!----------- tabla detalle cuenta ----------------------------------->

                
<?php 
    $total_descuento = 0;
    
    $subtotal = $total_detalle - $total_descuento; 
    $efectivo = $subtotal;
    $cambio = 0.00;
    $ancho_boton = 10;
    ?>

            <div hidden="true">        
                            <input id="total_detalle" name="total_detalle" value="<?php echo $total_detalle; ?>">
                            <input id="total_descuento" name="total_descuento" value="<?php echo $total_descuento; ?>">
                            
            </div>
                 
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body table-responsive table-condensed">
                        <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" style="max-width: 7cm">
                            <tr>
                                <td  style="padding: 0" >Total <?php echo $parametro[0]["moneda_descripcion"]; ?> </td>
                                <td align="right">
                                    <input class="btn btn-danger btn-foursquarexs" style="padding: 0; background-color: black; font-size: 20px;" id="venta_total" size="<?php echo $ancho_boton; ?>"  name="venta_total" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                                </td>
                            </tr>
                            <tr style="padding: 0">
                                <td style="padding: 0">Descuento <?php echo $parametro[0]["moneda_descripcion"]; ?> </td>
                                <td align="right" style="padding: 0">
                                    <input class="btn btn-foursquarexs" style="padding: 0" id="venta_descuentoparc" size="<?php echo $ancho_boton; ?>"  name="venta_descuentoparc" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                                </td>
                            </tr>
                            <tr style="padding: 0">
                                <td align="right" style="padding: 0"><b>Sub Total <?php echo $parametro[0]["moneda_descripcion"]; ?> </b></td>
                                <td align="right" style="padding: 0">
                                    <input class="btn btn-foursquarexs"  style="padding: 0" id="venta_subtotal" size="<?php echo $ancho_boton; ?>"  name="venta_subtotal" value="<?php echo number_format($subtotal,2,'.',','); ?>" readonly="true">
                                </td>
                            </tr>
                            <tr style="padding: 0">                      
                                <td style="padding: 0">Descuento <?php echo $parametro[0]["moneda_descripcion"]; ?> </td>
                                <td align="right" style="padding: 0">
                                    <input class="btn btn-info"  style="padding: 0" id="venta_descuento" name="venta_descuento" size="<?php echo $ancho_boton; ?>" value="<?php echo $descuento; ?>" onKeyUp="calculardesc()" onclick="seleccionar(4)">
                                </td>
                            </tr>
                            <tr style="padding: 0">                      
                                <td style="padding: 0"><b>Total Final <?php echo $parametro[0]["moneda_descripcion"]; ?> </b></td>
                                <td align="right" style="padding: 0">
                                    <input class="btn btn-foursquarexs" style="font-size: 20; padding: 0;" id="venta_totalfinal" size="<?php echo $ancho_boton; ?>" name="venta_totalfinal" value="<?php echo $totalfinal; ?>" readonly="true">
                                </td>
                            </tr>
                            <tr style="padding: 0">                      
                                <td style="padding: 0">Efectivo <?php echo $parametro[0]["moneda_descripcion"]; ?> </td>
                                <td align="right" style="padding: 0">
                                    <input class="btn" style="padding:0; background-color:yellow; font-size:20px;" id="venta_efectivo" size="<?php echo $ancho_boton; ?>" name="venta_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularcambio(event)"  onclick="seleccionar(5)">
                                </td>
                            </tr>
                            <tr style="padding: 0">                      
                            <td style="padding: 0"><b>Cambio <?php echo $parametro[0]["moneda_descripcion"]; ?> </b></td>
                                <td align="right" style="padding: 0;">
                                    <input class="btn btn-danger  btn-foursquarexs" style="padding: 0; background-color: black; font-size: 20px;"  id="venta_cambio" size="<?php echo $ancho_boton; ?>" name="venta_cambio" value="<?php echo number_format($cambio,2,'.',','); ?>" readonly="true" required min="0">
                                </td>
                            </tr>
                        </table>
                        <div class="col-md-12">
                            NOTA: <input type="text" style="padding: 0;" id="venta_glosa" name="venta_glosa" value="" class="form-control  input-sm">           
                        </div>
                        <?php if($tipousuario_id == 1) { ?>
                        <div class="col-md-12">
                            Vendedor:                 
                            <select name="usuario_id" id="usuario_id" class="btn btn-default btn-xs" style="width: 120px;" >
                                <?php 
                                foreach($usuarios as $us){ 
                                    $selected = ($us['usuario_id'] == $usuario_id) ? ' selected="selected"' : "";
                                    ?>
                                    <option value="<?php echo $us["usuario_id"]; ?>" <?php echo $selected; ?>><?php echo $us["usuario_nombre"]; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="checkbox" name="esreserva" id="esreserva" onclick="mostrar_reserva()"> Reserva</label>
                        </div>
                        <?php }else{ ?>
                        <div class="col-md-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="checkbox" name="esreserva" id="esreserva" onclick="mostrar_reserva()"> Reserva</label>
                        </div>
                        <?php }?>
                        <!-- *************** Inicio para reservas *************** -->
                        <div class="col-md-12" id="mostrarreserva" style="background-color: #c9d2d6; display: none">
                            <div class="col-md-6">
                            <label for="ingreso_monto" class="control-label">La suma de</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="ingreso_monto" value="<?php echo $this->input->post('ingreso_monto'); ?>" class="form-control" id="ingreso_monto" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="ingreso_moneda" class="control-label">Moneda</label>
                            <div class="form-group">
                                <select name="ingreso_moneda" id="ingreso_moneda" class="form-control" required>
                                    <!--<option value="Bs">- Bs -</option>-->
                                    <?php 
                                    foreach($all_moneda as $moneda)
                                    {
                                      $selected = ($moneda['moneda_descripcion'] == $this->input->post('ingreso_moneda')) ? ' selected="selected"' : "";

                                      echo '<option value="'.$moneda['moneda_descripcion'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="select_forma_pago" class="control-label">Forma de pago</label>
                            <div class="form-group">
                                <select id="select_forma_pago" name="select_forma_pago" class="form-control" onchange="mostrar()" required>
                                    <?php 
                                    foreach($forma_pago as $forma)
                                    {
                                      $selected = ($forma['forma_nombre'] == $this->input->post('forma_pago')) ? ' selected="selected"' : "";

                                      echo '<option value="'.$forma['forma_id'].'" '.$selected.'>'.$forma['forma_nombre'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="ingreso_glosa" style="display:none">
                            <label for="ingreso_laglosa" class="control-label">Glosa</label>
                            <div class="form-group">
                                <input type="text" name="ingreso_laglosa" id="ingreso_laglosa" value="<?php echo $this->input->post('ingreso_glosa'); ?>" class="form-control" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
                            </div>
                        </div>
                        <div class="col-md-6" id="ingreso_banco" style="display:none">
                            <label for="banco_id" class="control-label">Banco</label>
                            <div class="form-group">
                                <select id="banco_id" name="banco_id" class="form-control" >
                                    <?php 
                                    foreach($all_banco as $banco)
                                    {
                                      $selected = ($banco['banco_id'] == $this->input->post('banco_id')) ? ' selected="selected"' : "";

                                      echo '<option value="'.$banco['banco_id'].'" '.$selected.'>'.$banco['banco_nombre']." (".$banco['banco_numcuenta'].')</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        </div>
                        <!-- *************** F i n  para reservas *************** -->
                    </div>
                </div>
           <!-- ************************************* datos credito ************************************************-->
                
            <div class="row" id='creditoocultox'  style='display:none;'>
                                    
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>Nº CUOTAS</b></h5>

                    <select name="cuotas"  class="form-control input-sm" id="cuotas">
                        <?php for($i=1;$i<=36;$i++){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> CUOTA (S)</option>
                        <?php } ?>
                    </select>                                      
                </div>

                
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>MODALIDAD</b></h5>
                    <select class="form-control input-sm" id="modalidad" name="modalidad">                       
                        <option value="MENSUAL">MENSUAL</option>
                        <option value="SEMANAL">SEMANAL</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>DIA PAGO</b></h5>
                    <select class="form-control input-sm" id="dia_pago" name="dia_pago">
                        
                    <?php for($dia=1; $dia<=31; $dia++){?>
                            <option value="<?php echo $dia; ?>"><?php echo $dia; ?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>INTERES</b></h5>
                    <input type="text"  class="form-control  input-sm" value="<?php echo 0.00; ?>" name="credito_interes" id="credito_interes">
                </div>

                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>CUOTA INIC. <?php echo $parametro[0]["moneda_descripcion"]; ?> </b></h5>
                    <input type="text" class="form-control  input-sm"  value="0.00"name="cuota_inicial" id="cuota_inicial" >
                </div>

<!--                <div class="col-md-3">
                    <h5 class="modal-title" id="myModalLabel"><b>CUOTA Bs</b></h5>
                    <input type="text" class="form-control"  value="0.00" style="background-color: gray" name="monto_cuota" id="monto_cuota"  width="20" onKeyUp="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')" readonly>
                </div>
                -->
                <?php  $fecha = date('Y-m-d'); ?>
                <div class="col-md-4">
                    
                    <h5 class="modal-title" id="myModalLabel"><b>FECHA INICIAL</b></h5>
                    <input type="date" class="form-control  input-sm"  value="<?php echo $fecha; ?>" name="fecha_inicio" id="fecha_inicio">
                    
                </div>
                
           </div>
           
           <!--************************************* fin datos credito ************************************************>           
                 
                
            <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>-->   
            
<!--            <button class="btn btn-lg btn-facebook btn-sm btn-block" onclick="finalizarventa()">
                <h4>
                <span class="fa fa-money"></span>   Finalizar Venta  
                </h4>
            </button>
                -->
            <button class="btn btn-lg btn-facebook btn-sm btn-block" id="boton_finalizar" data-dismiss="modal" onclick="finalizarpedido()" style="display: block;">
                <h4>
                <span class="fa fa-save"></span>   Finalizar <?php echo $labelboton; ?>
                </h4>
            </button>

            <button class="btn btn-lg btn-danger btn-sm btn-block" data-dismiss="modal">
                <h4>
                <span class="fa fa-close"></span>   Cancelar  
                </h4>
            </button>
    <!--</form>-->
        </div>
        </div>
<!-- </form>-->

        
<!----------- fin tabla detalle cuenta ----------------------------------->                           
                            
                            
			</div>
		</div>
	</div>
</div>

</div>
<!--</form>-->

<!----------------------Fin Modal Cobrar--------------------------------------------------->


<!----------------- modal pedidos---------------------------------------------->


<div class="modal fade" id="modalpedidos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar3" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción">
      </div>
                                
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
<!--                        <th>Sub <br>Total</th>-->
                        <th align="center">COD</th>
                        <th>Total</th>
                        <!--<th>Fecha<br>entrega</th>-->
                        <!--<th>Estado</th>-->
                           <!--<th> </th>-->
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($pedidos as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <!--<td><?php //echo $p['pedido_id']; ?></td>-->
                        <td style="white-space: nowrap"><font size="3"><b><?php echo $p['cliente_nombre']; ?></b></font> <br>
                        <?php echo $p['cliente_nombrenegocio']; ?><br>
                        <?php echo $p['pedido_fecha']; ?><br>
                        
                        </td>
                        <td align="center" bgcolor="<?php echo $p['estado_color']; ?>">
                            <a href="<?php echo base_url('pedido/pedidoabierto/'.$p['pedido_id']); ?>">
                            <font size="3"><b><?php echo "00".$p['pedido_id']; ?></b></font> <br>
                            <font size="1"><?php echo $p['estado_descripcion']; ?></font>
                            </a>
                            <?php echo "<b>".$p['pedido_fechaentrega']."</b> <br>".$p['pedido_horaentrega']; ?>
                        </td>
                         
                        
                        <td align="right" style="white-space: nowrap" ><?php echo "Sub Total: ".number_format($p['pedido_subtotal'],'2','.',','); ?><br>
                                          <?php echo "Desc.: ".number_format($p['pedido_descuento'],'2','.',','); ?><br>  
                                          <font size="3"><b><?php echo number_format($p['pedido_total'],'2','.',','); ?></b></font></td>
                        
<!--                        <td>
                            <?php echo "<b>".$p['pedido_fechaentrega']."</b> <br>".$p['pedido_horaentrega']; ?></td>-->

                        <td>
                            <a href="<?php echo site_url('pedido/pedidoabierto/'.$p['pedido_id']); ?>" class="btn btn-success btn-sm"><span class="fa fa-cubes" title="Ver detalle del pedido"></span></a>
                            <!--<a href="<?php echo site_url('pedido/pasaraventas/'.$p['pedido_id']); ?>" class="btn btn-warning btn-sm"><span class="fa fa-arrow-down" title="Añadir pedido a ventas"></span></a>-->
                            <button  class="btn btn-warning btn-sm" data-dismiss="modal" onclick="pasaraventas(<?php echo $p['pedido_id']; ?>,<?php echo $p['usuario_id']; ?>,<?php echo $p['cliente_id']; ?>)"><span class="fa fa-arrow-down" title="Cargar pedido a ventas"></span> </button>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
             
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
            
    <?php if($parametro[0]['parametro_mostrarcategoria']>0){ ?>
            <script type="text/javascript">   
               tablaresultados(2);
            </script>
     <?php       }
    ?>
<!---------------------- fin modal pedidos --------------------------------------------------->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<div id="modalespera">
    
</div>

-->
<!--<input type="search" name="xxx" list="listaclientes" id="xxx" value="" onchange="mensaje()"/>
<datalist id="listaclientes">
    <option value="1" label="jaguar">hola</option>
    <option value="2" label="lincer">como</option>
    <option value="3" label="gato">estas</option>
</datalist>-->


<!----------------- modal inventario ---------------------------------------------->

<div class="modal fade" id="modalinventario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>Asignar Inventario</b></h4>
                                <b>ADVERTENCIA: El inventario actual, remplazara algun invenario asignado previamente.</b>                                
                            </center>

                                
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        

                    
                        
                        <div class="box-body table-responsive">
                                        <div class="col-md-4">
						<label for="usuario_idx" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_idx" id="usuario_idx" class="form-control">
								<option value="0">- ASIGNAR USUARIO -</option>
								<?php 
								foreach($usuario as $usuario_prev)
								{
									$selected = ($usuario_prev['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario_prev['usuario_id'].'" '.$selected.'>'.$usuario_prev['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        
                                        <div class="col-md-4">
						<label for="asignacion_fecha" class="control-label">Fecha</label>
						<div class="form-group">
                                                    
                                                    <input type="date" name="asignacion_fecha" id="asignacion_fecha" value="<?php echo date('Y-m-d'); ?>" class="form-control">
								
						</div>
					</div>
                                        
                                        <div class="col-md-4" id='botones'  style='display:block;'>
						<label for="opciones" class="control-label">Opciones</label>
						<div class="form-group">
                                                    <center>
                                                        
                                                        <button class="btn btn-facebook" id="boton_asignar" onclick="asignar_inventario()"> <span class="fa fa-truck"></span> Asignar</button>

                                                        <button class="btn btn-danger" id="cerrar_modalasignar" data-dismiss="modal">

                                                            <span class="fa fa-close"></span>   Cancelar  

                                                        </button>
                                                    </center>
						</div>
					</div>
                            
                                        <!--------------------- inicio loader ------------------------->
                                        <div class="col-md-6" id='loaderinventario'  style='display:none;'>
                                            <center>
                                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                            </center>
                                        </div> 
                                        <!--------------------- fin inicio loader ------------------------->
                            
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>


<!----------------- fin modal inventario ---------------------------------------------->


<!--
            <a href="#" data-toggle="modal" data-target="#modalpreferencia" class="btn btn-xs btn-success" style="">
                <i class="fa fa-tasks"></i>
            </a>-->


<!----------------- modal preferencias ---------------------------------------------->

<div class="modal fade" id="modalpreferencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>PREFRENCIAS</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                            </center>

                            <input id="detalleven_id" value="0" hidden>
                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        

                        
                        
                        <div class="box-body table-responsive">
                                        <div class="col-md-6">
                                            <label for="usuario_idx" class="control-label">Preferencia de producto</label>
                                            <div class="form-group">
							
                                                <?php 
                                                foreach($preferencia as $p)
                                                {?>
                                                    <!--<input class="btn btn-xs btn-facebook" id="preferencia<?php echo $p["preferencia_descripcion"]; ?>"  value="<?php echo $p["preferencia_descripcion"]; ?>" style="background-color: #db0ead">-->
                                                    <button class="btn btn-xs btn-facebook" id="pref<?php echo $p["preferencia_id"]; ?>" name="<?php echo $p["preferencia_descripcion"]; ?>" style="background-color: #db0ead" onclick="agregar_preferencia(<?php echo $p["preferencia_id"]; ?>)"><i class="fa fa-cube"></i><?php echo $p["preferencia_descripcion"]; ?></button>
                                                    <br>
                                                <?php } 
                                                ?>
                                            </div>
                                            <input type="text" id="inputcaract" value="" class="form-control btn btn-xs btn-warning">
					</div>
                                        <div class="col-md-6" id='botones'  style='display:block;'>
						<label for="opciones" class="control-label">Opciones</label>
						<div class="form-group">
                                                        
                                                    <button class="btn btn-facebook" id="boton_asignar" onclick="guardar_preferencia()" data-dismiss="modal" >
                                                            <span class="fa fa-floppy-o"></span> Guadar
                                                    </button>
                                                    
                                                    <button class="btn btn-danger" id="cancelar_preferencia" onclick="cancelar_preferencia()" data-dismiss="modal" >
                                                        <span class="fa fa-close"></span>   Cancelar                                                          
                                                    </button>
						</div>
					</div>
                            
                                        <!--------------------- inicio loader ------------------------->
                                        <div class="col-md-6" id='loaderinventario'  style='display:none;'>
                                            <center>
                                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                            </center>
                                        </div> 
                                        <!--------------------- fin inicio loader ------------------------->
                            
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>


<!----------------- fin modal preferencias ---------------------------------------------->




<!--------------------------------- INICIO MODAL CLIENTES ------------------------------------>
<div class="modal fade" id="modalbuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="padding-bottom: 0;">
                            
                                <div class="row">

                                           <!--------------------- parametro de buscador por codigo --------------------->

                                           <div class="col-md-8">
                                                 <div class="input-group">
                                                     <span class="input-group-addon"> 
                                                       <i class="fa fa-binoculars"></i>
                                                     </span>           
                                                     <input type="text" name="filtrar4" id="filtrar4" class="form-control" placeholder="Ingrese el nombre, CI, codigo del cliente " onkeyup="validar(event,8)">
                                                     <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="buscar_clientes_pedido()" title="Buscar"><span class="fa fa-search"></span></div>
                                                 </div>
                                           </div>      
                                          <!--------------------- fin buscador por codigo --------------------->


                                           <div class="col-md-4">

                               <!--            ------------------- parametro de buscador --------------------->

                                                 <div class="input-group">
                                                     <span class="input-group-addon"> 
                                                      <i class="fa fa-user"></i>
                                                     </span>           
                                                     <select id="tipo" class="form-control">
                                                         <option value="1">Mis clientes</option>
                                                         <option value="2">Todos</option>
                                                     </select>
                                                 
                                                 </div>

                               <!--            ------------------- fin parametro de buscador ------------------- -->

                                           </div>

                                       </div>

                                
			</div>
			<div class="modal-body" style="padding-top:0;">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                        
                                <th style="padding:0;">#</th>
                                <th colspan="2"  style="padding:0;">Clientes</th>
                            </tr>
                            
                            <tbody class="buscar4" id="clientes_pedido">
                 

                            </tbody>
                        </table>
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                        <div class="footer">
                            <center>
                                
                                <button class="btn btn-danger" id="cancelar_preferencia" onclick="cancelar_preferencia()" data-dismiss="modal" >
                                    <span class="fa fa-close"></span>   Cerrar
                                </button>

                            </center>
                        </div>
			</div>
		</div>
	</div>
</div>
<!--------------------------------- FIN MODAL CLIENTES ------------------------------------>

                                   <div hidden>
    
<button type="button" id="boton_modal_ingreso" class="btn btn-primary" data-toggle="modal" data-target="#modalingreso" >
  Launch demo modal
</button>
</div>
<!----------------- modal preferencias ---------------------------------------------->

<div class="modal fade" id="modalingreso" tabindex="-1" role="dialog" aria-labelledby="modalingreso" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>INGRESO RAPIDO</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                            </center>
                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive">
                            <input type="text" id="ingresorapido_producto" value="-" class="form-control btn btn-xs btn-default" readonly>
                                        <div class="col-md-6">
                                            <label for="usuario_idx" class="control-label">Cantidad:</label>
                                            
                                            <input type="text" id="ingresorapido_producto_id" value="0.00" hidden />
                                            <input type="text" id="ingresorapido_cantidad" value="0.00" class="form-control btn btn-xs btn-warning" onkeyup="validar(event,11)" />
					</div>
                                        <div class="col-md-6" id='botones'  style='display:block;'>
						<label for="opciones" class="control-label">Opciones</label>
						<div class="form-group">
                                                        
                                                    <button class="btn btn-facebook" id="boton_ingreso_rapido" onclick="guardar_ingreso_rapido()" data-dismiss="modal" >
                                                            <span class="fa fa-floppy-o"></span> Registrar
                                                    </button>
                                                    
                                                    <button class="btn btn-danger" id="cancelar_preferencia" data-dismiss="modal" >
                                                        <span class="fa fa-close"></span>   Cancelar                                                          
                                                    </button>
						</div>
					</div>
                            
                                        <!--------------------- inicio loader ------------------------->
                                        <div class="col-md-6" id='loaderinventario'  style='display: none;'>
                                            <center>
                                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                            </center>
                                        </div> 
                                        <!--------------------- fin inicio loader ------------------------->
                            
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>


<!----------------- fin modal preferencias ---------------------------------------------->


<!----------------- modal promociones ---------------------------------------------->

<div class="modal fade" id="modalpromocion" tabindex="-1" role="dialog" aria-labelledby="modalpromocion" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
                    <div class="modal-header" >
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>COMBOS Y PROMOCIONES</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                                
                                <!--<input type="text" id="parametro" class="form-control btn-default" onkeyup="buscar(event)">-->
                            </center>
                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive">

                                        <!--------------------- inicio loader ------------------------->
                                        <div class="col-md-6" id='oculto'  style='display: none;'>
                                            <center>
                                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                            </center>
                                        </div> 
                                        <!--------------------- fin inicio loader ------------------------->
                                        <center>
                                            
                                        <?php 
                                        
                                            $alto_botonx = 150;
                                            $ancho_botonx = 100;
                                            foreach($promociones as $prom){ ?>
    <!--                                        <button > <fa class="fa fa-cube"></fa> 
                                                    <?php echo $prom["promocion_titulo"]; ?>
                                            </button>-->


    <button data-toggle="modal" class="btn btn-sq-lg btn-primary" style="width: <?php echo $ancho_botonx; ?>px !important; height: <?php echo $alto_botonx; ?>px !important;" title=" <?php echo $prom["promocion_titulo"]; ?>" onclick="ingresar_promocion(<?php echo $prom["promocion_id"]; ?>)">
                                                    <i class="fa fa-cubes fa-2x"></i><br><br>
                                                    <small>
                                                        <?php echo $prom["promocion_titulo"]; ?><br>
                                                        
                                                    </small>
                                                    <b>
                                                        <?php echo $parametro[0]['moneda_descripcion']." ".number_format($prom["promocion_preciototal"],2,".",","); ?>
                                                    </b>
                                                </button>

                                        <?php } ?>
<!--                                        <table class="table-responsive" id="mitabla">
                                            <tr>
                                                <th style="padding: 0">#</th>
                                                <th style="padding: 0">DESCRIPCIÓN</th>
                                                <th style="padding: 0">CODIGO</th>
                                                <th style="padding: 0">CANTIDAD</th>
                                                <th style="padding: 0">PRECIO</th>
                                                <th style="padding: 0"></th>                                                
                                            </tr>
                                            <tbody id="tablaresultados">
                                                -------- aqui van los resultados 
                                            </tbody>
                                            
                                        </table>-->
                                        </center>
                            </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>
<!----------------- fin modal promociones ---------------------------------------------->




<!----------------- modal clasificador ---------------------------------------------->

<div class="modal fade" id="modalclasificador" tabindex="-1" role="dialog" aria-labelledby="modalclasificador" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
                    <div class="modal-header" >
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>CLASIFICACION DE PRODUCTOS</b></h4>

                            </center>
                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive">

                                        <!--------------------- inicio loader ------------------------->
                                        <div class="col-md-6" id='oculto'  style='display: none;'>
                                            <center>
                                                <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                                            </center>
                                        </div> 
                                        <!--------------------- fin inicio loader ------------------------->
                                        <center>
                                           
                                        <div class="col-md-12">
                                            <table>
                                                <tr>
                                                    <td>
                                                        CLASIFICADOR
                                                    </td>
                                                    <td>
                                                        <div id="div_clasificador">
                                                            
                                                        </div>
                                                        
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-info btn-sm" id="boton_registrar_clasificacion" onclick="registrar_clasificador()" data-dismiss="modal"> <fa class="fa fa-floppy-o"></fa> </button>
                                                    </td>

                                                
                                                </tr>
                                            </table>
                                        </div>
                                            
                                        <div class="col-md-12">
                                            

                                            <button class="btn btn-danger btn-xs" id="cancelar_preferencia" data-dismiss="modal" >
                                                <span class="fa fa-close"></span>   Cerrar
                                            </button>
                                        </div> 

                                        </center>
                            </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
		</div>
	</div>
</div>
<!----------------- fin modal clasificador ---------------------------------------------->                 

<script>
    function mostrar(){
        var forma = document.getElementById('select_forma_pago').value;
        
        if(forma != 1){
            document.getElementById('ingreso_glosa').style.display = 'block';
            document.getElementById('ingreso_banco').style.display = 'block';
        }else{
            document.getElementById('ingreso_glosa').style.display = 'none';
            document.getElementById('ingreso_banco').style.display = 'none';
        }
    }
    function mostrar_reserva(){
        var es_check = $('#esreserva').is(':checked');
        if(es_check){
            document.getElementById('mostrarreserva').style.display = 'block';
        }else{
            document.getElementById('mostrarreserva').style.display = 'none';
        }
    }
</script>