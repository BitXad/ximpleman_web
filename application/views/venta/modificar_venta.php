<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>"></script>

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

function mostrar_ocultar(){
    var x = document.getElementById('tipo_transaccion').value;
    
    if (x=='2'){ //si la transaccion es a credito
        
        document.getElementById('creditooculto').style.display = 'block';

        }
    else{
        document.getElementById('creditooculto').style.display = 'none';}
}


function compruebaTecla (e) {
var keyCode = document.all ? e.which : e.keyCode;
 
 
//  if (keyCode == 39)
//alert("flecha derecha")
//  else if (keyCode == 40)
//
//MarcaCheck ();
//  else if (keyCode == 38)
//alert("flecha arriba")
//  else if (keyCode == 37)
//alert("flecha izquierda")
//  return true;

//  if (keyCode == 112) //f1
//  { alert("Tecla F1"); }    

  if (keyCode == 113) //f2
  { //alert("Tecla F2"); 
    $('#codigo').focus();
      
  }    

  if (keyCode == 115) //f4
  {       
    $('#filtrar').focus();
  }

  if (keyCode == 118) //f7
  {       
    $('#nit').focus();
    $('#nit').select();
  }

  if (keyCode == 119) //f8
  {       
    $('#boton_finalizar').click();
  }

  if (keyCode == 120) //f9
  {   
      alert("holaaaa");
      
    //$('#imprimir').click();
  }

  //if (keyCode == 121) //f10
  //{       
    //$('#nit').focus();
    //$('#nit').select();
    
  //}
  
    e = e || event;
  if(e.altKey && String.fromCharCode(e.keyCode) == 'C')
  {
      $("#imprimir").click();
  } 
  
}
 
 
function MarcaCheck () {
elemento = document.getElementById('obj'); 
    if (elemento.type == "checkbox") 
    { 
    elemento.checked = true
    } 
}
 
 
window.onkeydown = compruebaTecla;
        
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

<!------------------------------------------------------------->

                <script type="text/javascript">
                    function esMobilx(){
    
                    var isMobile = {
                        Android: function() {
                            return navigator.userAgent.match(/Android/i);
                        },
                        BlackBerry: function() {
                            return navigator.userAgent.match(/BlackBerry/i);
                        },
                        iOS: function() {
                            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                        },
                        Opera: function() {
                            return navigator.userAgent.match(/Opera Mini/i);
                        },
                        Windows: function() {
                            return navigator.userAgent.match(/IEMobile/i);
                        },
                        any: function() {
                            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                        }
                    };    

                    return isMobile.any()

                }
                var esmovil = "0";
                if(esMobilx()){
                    //document.write("<h1 style='line-height: 0px;'><fa class='fa fa-money'></fa> </h1>");
                    esmovil = "1";
                }
                    
                </script>
                
 

<!--------------------- CABECERA -------------------------->

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>
<input type="text" value='<?php echo json_encode($categoria_producto); ?>' id="categoria_producto" hidden>
<input type="text" value='<?php echo json_encode($preferencia); ?>' id="preferencias" hidden>
<input type="text" id="pedido_id" value="0" name="pedido_id" hidden>
<input type="text" id="orden_id" value="0" name="orden_id" hidden>
<input type="text" id="usuarioprev_id" value="0" name="usuarioprev_id" hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision" hidden>
<input type="text" id="venta_tipocambio" value="1" name="venta_tipocambio" hidden>
<input type="text" id="usuariopedido_id" value="0" name="usuariopedido_id" hidden>
<input type="text" id="detalleserv_id" value="0" name="detalleserv_id"  hidden>
<input type="text" id="parametro_modoventas" value="<?php echo $parametro['parametro_modoventas']; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>
<input type="text" id="parametro_imprimircomanda" value="<?php echo $parametro['parametro_imprimircomanda']; ?>" name="parametro_imprimircomanda"  hidden>
<input type="text" id="parametro_diasvenc" value="<?php echo $parametro['parametro_diasvenc']; ?>" name="parametro_diasvenc"  hidden>
<input type="text" id="parametro_cantidadproductos" value="<?php echo $parametro['parametro_cantidadproductos']; ?>" name="parametro_cantidadproductos"  hidden>
<input type="text" id="parametro_datosboton" value="<?php echo $parametro['parametro_datosboton']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" name="tipousuario_id"  hidden>
<input type="text" id="preferencia_id" value="0" name="preferencia_id" hidden>
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro['moneda_id']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro['moneda_descripcion']; ?>" name="parametro_datosboton"  hidden>


<input type="text" id="rol_precioventa" value="<?php echo $rolusuario[160-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor" value="<?php echo $rolusuario[161-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor1" value="<?php echo $rolusuario[162-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor2" value="<?php echo $rolusuario[163-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor3" value="<?php echo $rolusuario[164-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor4" value="<?php echo $rolusuario[165-1]['rolusuario_asignado']; ?>" hidden>

<input type="text" id="tipocliente_porcdesc" value="0" hidden>
<input type="text" id="tipocliente_montodesc" value="0" hidden>

<input type="text" id="moneda_tc" value="<?php echo $moneda['moneda_tc']; ?>" hidden>
<input type="text" id="moneda_descripcion" value="<?php echo $moneda['moneda_descripcion']; ?>" hidden>

<input type="text" id="venta_id" value="<?php echo $venta[0]['venta_id']; ?>" hidden>
<input type="text" id="credito_id" value="<?php if(isset($credito['credito_id'])){if($credito['credito_id']>0){ echo $credito['credito_id'];}else{ echo 0;} }else{ echo 0;}?>" hidden>

<!--<img src="<?php echo base_url("resources/images/logo.png"); ?>" class="img img-thumbnail" >-->

<?php $atributos = " btn btn-warning btn-sm";  //atributos para los inputs del clientes?>
<?php $estilos_facturacion = " style='color: black; background: #1221; text-align: left; font-size: 18px; font-family: Arial;'"; //estilo para los inputs de facturacion?>
<?php $estilos = " style='background: white; color: black; text-align: left;  font-family: Arial;'"; //estilo para los inputs del cliente?>
<?php $estilo_div = " style='padding:2; padding-left:1px; margin:0; line-height:15px;' "; ?>
<!-------------------- inicio collapse ---------------------->


  <div class="panel-group" <?php echo $estilo_div; ?>>
    <div class="panel panel-default" <?php echo $estilo_div; ?>>
      <div class="panel-heading" <?php echo $estilo_div; ?>>
      

<!--------------------- cliente_id --------------------->
<div class="container" hidden>
    <input type="text" name="cliente_id" value="<?php echo $cliente[0]['cliente_id']; ?>" class="form-control" id="cliente_id" >
</div>

<!--------------------- fin cliente_id --------------------->

        <div class="col-md-3" <?= $estilo_div ?>>
            <label for="tipo_doc_identidad" class="control-label" style="margin-bottom: 0;">TIPO DOCUMENTO IDENTIDAD</label>
            <div class="form-group" <?= $estilo_div ?>>
                
                <select class="form-control <?php echo $atributos; ?>" name="tipo_doc_identidad" id="tipo_doc_identidad" <?= $estilos_facturacion ?>>
                    <?php 
                        foreach ($docs_identidad as $di){  
                            
                            $selected = $di['cdi_codigoclasificador'] == $cliente[0]['cdi_codigoclasificador'] ? "selected" : "" ;// por defecto que esté seleccionado NIT                           
                       
                         ?>                    
                        <option value="<?= $di['cdi_codigoclasificador'] ?>" <?= $selected ?>><?= $di['cdi_descripcion'] ?></option>
                    <?php } ?>
                </select>
                
            </div>
        </div>
        
        <div class="col-md-2" <?php echo $estilo_div; ?>>
            <label for="nit" class="control-label" style="margin-bottom: 0;">NUMERO DE DOCUMENTO</label>
            <div class="form-group"  <?php echo $estilo_div; ?>>
                <input type="number" name="nit" class="form-control  <?php echo $atributos; ?>" <?php echo $estilos_facturacion; ?> id="nit" value="<?php echo $cliente[0]['cliente_nit']; ?>"  onkeypress="validar(event,1)" onclick="seleccionar(1)" />
            </div>
        </div>
        
        <div class="col-md-3"  <?php echo $estilo_div; ?>>
            <label for="razon social" class="control-label" style="margin-bottom: 0;">RAZON SOCIAL</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                
                <!--<input type="search" name="razon_social" list="listaclientes" class="form-control" id="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" onkeypress="validar(event,2)"  onclick="seleccionar(2)" onKeyUp="this.value = this.value.toUpperCase();"/>-->
                <input type="search" name="razon_social" list="listaclientes" class="form-control <?php echo $atributos; ?>" <?php echo $estilos_facturacion; ?> id="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" onkeypress="validar(event,9)"  onchange="seleccionar_cliente()" onclick="seleccionar(2)" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off" />
                <datalist id="listaclientes">

                </datalist>
                
            </div>
        </div>
<?php
    $es_movil = "0";
    $es_movil = "<script>document.write(esmovil);</script>";         

?>   

<?php //if($es_movil == 0){ ?> 

        <div class="col-md-2" <?php echo $estilo_div; ?>>
        <label for="cliente_celular" class="control-label" style="margin-bottom: 0;">CELULAR</label>
        <div class="form-group" <?php echo $estilo_div; ?>>
            <input type="text" name="cliente_celular" class="form-control <?php echo $atributos; ?>" <?php echo $estilos_facturacion; ?> id="cliente_celular" onkeypress="validar(event,0)" onclick="seleccionar(3)" value="<?php echo $cliente[0]['cliente_celular']; ?>" onKeyUp="this.value = this.value.toUpperCase();"/>
        </div>
        </div>

        
        <div class="col-md-2" <?php echo $estilo_div; ?>>
            <label for="tipo" class="control-label" style="margin-bottom: 0;">TIPO CLIENTE</label>           
            <div class="form-group" <?php echo $estilo_div; ?>>
                
                <select  class="form-control <?php echo $atributos; ?>" <?php echo $estilos_facturacion; ?> id="tipocliente_id" name="tipocliente_id" onchange="validar(event,7)">
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

<!---------------------- collapse ----------------------------->
 
        <h4 class="panel-title">
          <?php if(sizeof($dosificacion)>0){ ?>
            <input type="checkbox" id="facturado" value="1" name="facturado" hidden>
          <?php } else{ ?>
            <input type="checkbox" id="facturado" value="1" name="facturado" hidden>
            <font color="red" size="2"> Dosificación no activada</font>
          <?php } ?> 
          <a data-toggle="collapse" href="#collapse1" style="padding: 0;" class="btn btn-default btn-sm"> 
            Más información</a>
            
            
            
        </h4>

      </div>
    <div id="collapse1" class="panel-collapse collapse">
<!---------------------- contenido collapse ----------------------------->
        
          
      
            
            

            <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="nombre" class="control-label" style="margin-bottom: 0;">CLIENTE</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_nombre" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_nombre" value="<?php echo $cliente[0]['cliente_nombre']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>

            <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="cliente_ci" class="control-label" style="margin-bottom: 0;">C.I.</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_ci" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_ci" value="<?php echo $cliente[0]['cliente_ci']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
        

            <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="cliente_nombrenegocio" class="control-label" style="margin-bottom: 0;">NEGOCIO</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_nombrenegocio" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_nombrenegocio" value="<?php echo $cliente[0]['cliente_nombrenegocio']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
        

            <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="cliente_codigo" class="control-label" style="margin-bottom: 0;">CÓDIGO</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_codigo" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_codigo" value="<?php echo $cliente[0]['cliente_codigo']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
            
            <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="cliente_direccion" class="control-label" style="margin-bottom: 0;">DIRECCIÓN</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_direccion" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_direccion" value="<?php echo $cliente[0]['cliente_direccion']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>
            
            <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="cliente_departamento" class="control-label" style="margin-bottom: 0;">DEPARTAMENTO</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_departamento" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_departamento" value="<?php echo $cliente[0]['cliente_departamento']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>
                    
            <div class="col-md-3" <?php echo $estilo_div; ?>>
                <label for="telefono" class="control-label" style="margin-bottom: 0;">TELEFONO</label>
                <div class="form-group" <?php echo $estilo_div; ?>>
                    <input type="telefono" name="telefono" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="telefono"  value="<?php echo $cliente[0]['cliente_telefono']; ?>"/>
                </div>
            </div>


            <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="zona_id" class="control-label" style="margin-bottom: 0;">ZONA</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                        <select name="zona_id" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="zona_id">
                            <option value="0">- ZONAS -</option>
                            <?php 
                            foreach($zonas as $categoria_clientezona)
                            {
                                    $selected = ($categoria_clientezona['zona_id'] == $cliente[0]['zona_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$categoria_clientezona['zona_id'].'" '.$selected.'>'.$categoria_clientezona['zona_nombre'].'</option>';
                            } 
                            ?>
                        </select>
                <!--<input type="text" name="cliente_zona" class="form-control" id="cliente_celular" value="<?php echo $cliente[0]['zona_nombre']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>-->
            </div>
            
            <div class="col-md-2" <?php echo $estilo_div; ?>>
                <label for="email" class="control-label" style="margin-bottom: 0;">CORREO ELECTRONICO</label>
                <div class="form-group" <?php echo $estilo_div; ?>>
                    <input type="email" name="email" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="email"  value="<?php echo ($cliente[0]['cliente_email']==null)? $empresa_email : $cliente[0]['cliente_email'];  ; ?>" onclick="this.select()" onkeypress="validar(event,13)"/>
                </div>
            </div>
            
            </div>
            
            <div class="col-md-14" >
                <br>
                <small>
                    <b>
                        * Información complementaria del cliente                   
                    </b>
                </small>
            </div>
    
<!--        
        </div>

    </div>-->

<!--  </div>
</div>  -->
<!-------------------- fin inicio collapse ---------------------->
</div>
    </div>
        
      
  </div>

<!-------------------- fin inicio collapse ---------------------->

<!--------------------- FIN CABERECA -------------------------->
<br>

<div class="row">
    <div class="col-md-6" >
        
        <div class="row">
            
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
                  </div>
            
<!--            ------------------- fin parametro de buscador ------------------- -->
            
            </div>
            
        </div>
<!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria" style="padding:0;">
    
    <span class="badge btn-danger" style="width: 170px;">
    
    
    
        <select class="bange btn-danger" style="border-width: 0; width:100px;"  onchange="tablaresultados(2)" id="categoria_prod">
                <option value="0" >Todas las Categorias</option>
        <?php 
            foreach($categoria_producto as $categ){ 
                $selected = ($categ['categoria_id'] == $parametro['parametro_mostrarcategoria']) ? ' selected="selected"' : "";
                ?>
                
                <option value="<?php echo $categ['categoria_id']; ?>" <?php echo $selected; ?>><?php echo $categ['categoria_nombre']; ?></option>
        <?php
            }
        ?>
    </select>
        <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="3" value="0" readonly="true"> </span>
    </span>
        <button class="btn btn-success btn-xs" onclick="actualizar_inventario()"><span class="fa fa-cubes"></span> Inventario</button>
       <?php 
            if ($parametro["parametro_agruparitems"] == 1 )
                    { $agrupar = "checked='true'";}
              else {$agrupar = " ";}
        ?>
        
    <!--<span class="badge btn-primary">-->
        
        
        
        <button class="btn btn-primary btn-xs"><input type='checkbox' id='check_agrupar' class="btn btn-success btn-xs"  value='1' <?php echo $agrupar; ?>> Agrupar</button>
        
        
    <!--</span>-->
        <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <!--<span class="badge btn-danger">Encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="3" value="0" readonly="true"> </span></span>-->
                <span class="badge btn-default">

                    <!--------------------- inicio loader ------------------------->
                    <div class="row" id='oculto'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
                        </center>
                    </div> 
                    
                    <div class="row" id='loader'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
                        </center>
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
        <div class="row">
            
            <div class="col-md-8" style="padding:0;">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código">
                  </div>
            
            <center>
                
                
            <!--------------- botones ---------------------->
            <?php if($parametro["parametro_modulorestaurante"]==0){ //1 es normal ?>
                <?php if($rolusuario[13-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" class="btn btn-facebook btn-xs" title="Pedidos Pendientes"  disabled="true"><span class="fa fa-cubes"></span><b> Pedidos</b></a> 
            <a href="#" data-toggle="modal" class="btn btn-facebook btn-xs" style="background-color: black" title="Ordenes de Trabajo"  disabled="true"><span class="fa fa-book"></span><b> OT's</b></a> 
                <?php }
                } ?>
                    
            <?php if($parametro["parametro_modulorestaurante"]==1){ //1 es modo restaurante?>            
                    <a href="#" data-toggle="modal" target="_blank" class="btn btn-facebook btn-xs" id="imprimir_comanda" title="Comanda"  disabled="true"><span class="fa fa-print"></span><b> Comanda</b></a> 
            <?php } ?>            
           
<!--            <button onclick='quitartodo()' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span><b> Vaciar</b></button> -->
            
      
            
            
            <?php            
            if($rolusuario[17-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" target="_blank" class="btn btn-facebook btn-xs"  style="background-color: #761c19" id="imprimir"  disabled="true"><span class="fa fa-print" title="Imprimir nota de entrega"></span><b> Recibo</b></a> 
            
            <?php } 
            ?>
            
            <?php            
            if($rolusuario[17-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" target="_blank" class="btn btn-warning btn-xs" id="imprimir_factura" disabled="true"><span class="fa fa-list-alt" title="Imprimir factura"></span><b> Factura</b></a> 
            
            <?php } 
            ?>
            

            
            
            <?php if($rolusuario[14-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-success btn-xs"><span class="fa fa-cubes"></span><b> Finalizar</b></a> 
            <?php } ?>

            </center>
            
            
            <!--------------- fin botones ---------------------->
            
            <!--------------------- fin parametro de buscador ---------------------> 
        
            </div>
            <div class="col-md-4" style="background-color: black; line-height: 15px;">
                <center>
                    
                <font size="3" style="color:white;" face="Arial"><b>Total Final <?php echo $parametro["moneda_descripcion"]; ?></b></font>
                
                <font size="6" style="color:white;" face="Arial"><b>
                    <input type="text" id="venta_subtotal" name="venta_subtotal" values="0.00" style="width: 180px; border-color: black; border-width: 0; background-color: black; text-align: center; padding:0;" readonly> </b>                
                </b></font>
    
                </center>

                
            </div>
        </div>
        
        <div class="box">
           
            
            <div class="box-body table-condensed table-responsive">
                <div id="tablaproductos">
                    
                    <!--------------- RESULTADO TABLA DE PRODUCTOS---------------------------->
                    
                </div>
          
                        <?php 
            if($rolusuario[15-1]['rolusuario_asignado'] == 1){ ?>
            <button onclick='costo_cero()' class='btn btn-danger btn-xs'><span class='fa fa-battery-0' title="Costo Cero"></span><b> - 0 -</b></button> 
            <?php }
            if($rolusuario[16-1]['rolusuario_asignado'] == 1){ ?>
            <button onclick='precio_costo()' class='btn btn-warning btn-xs'><span class='fa fa-money' title="Precio de costo"></span><b> Costo</b></button> 
            
            <?php } ?>
            
            <?php
            if($rolusuario[17-1]['rolusuario_asignado'] == 1){ ?>
            
            <a href="#" data-toggle="modal" target="_blank" class="btn btn-facebook btn-xs"  style="background-color: purple"  id="garantias" disabled="true"><span class="fa fa-lock" title="Imprimir garantias"></span><b> Garantias</b></a>
            
            <?php } ?>      
            
            <!--<a href="<?php echo base_url('venta/ultimagarantia');?>" data-toggle="modal" target="_blank" class="btn btn-facebook btn-xs"  style="background-color: purple"  id="garantias"><span class="fa fa-lock" title="Imprimir garantias"></span><b> Garantias</b></a>-->
            <select  id="select_imprimir_factura" style="font-weight: bold" class='btn btn-warning btn-xs' title="Imprimir factura" disabled="true">
                <option value="0">Imprimir</option>
                <option value="1">Factura</option>
                <option value="2">Copia</option>
            </select>
            
            </div>
        </div>
        
        <!----------------------------------- BOTONES ---------------------------------->
        <?php 
        $ancho_boton = 100; 
        $alto_boton = 120; 
        
        ?>
        <div class="col-md-12" style="padding:0;">

            <center>
            <?php if($rolusuario[14-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" onclick="focus_efectivo(), mostrar('forma_pago','glosa_banco')" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-money fa-4x"></i><br><br>Finalizar <br>
            </a>
            <?php } ?>

<!--            <a href="#" data-toggle="modal" data-target="#modalinventario" class="btn btn-sq-lg btn-primary" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-truck fa-4x"></i><br><br>
               Asignar <br>
            </a>-->

            <?php if($rolusuario[18-1]['rolusuario_asignado'] == 1){ ?>
<!--                <a  href="<?php echo site_url('venta'); ?>" class="btn btn-sq-lg btn-danger" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-sign-out fa-4x"></i><br><br>
               Salir <br>
            </a>    -->
                <button  onclick="cerrar_ventas()" class="btn btn-sq-lg btn-danger" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-sign-out fa-4x"></i><br><br>
               Salir <br>
            </button>    
            <?php } ?>    
            </center>
            <br>
        </div>    
        <!----------------------------------- fin Botones ---------------------------------->
        <font face="Arial" size="1">
        <b>
            
        TECLAS DE ACCESO DIRECTO <br>
        </b>
        <p>
            
        [F2] Busqueda por código de barras <br>
        [F4] Busqueda por parámetros<br>
        [F5] Actualizar página<br>        
        [F7] Registrar NIT<br>
        [F8] Finalizar venta<br>
        
        </p>
        </font>
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
                                        <h5 class="modal-title" id="myModalLabel"><b>FORMA DE PAGO</b></h5>                                        
                                        <select id="forma_pago" id="forma_pago" name="forma_pago" class="btn btn-default btn-xs" onchange="mostrar_formapago(), mostrar('forma_pago','glosa_banco')"  style="width: 120px;" >
                                            <?php
                                                foreach($forma_pago as $forma){ ?>
                                                    <option value="<?php echo $forma['forma_id']; ?>"><?php echo $forma['forma_nombre']; ?></option>                                                   
                                            <?php } ?>
                                                                                                    
                                         </select>
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
                                    <div class="col-md-12" style="display: block;"></div>
                                    <div class="col-md-6" id="glosa_banco" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label for="glosa_compra">Numero Tarjeta</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="venta_detalletransaccion" value="0" onkeyup="ofuscar_tarjeta()">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="banco">Banco</label>
                                                <div class="form-group">
                                                    <select name="banco" id="banco" class="form-control">
                                                        <?php foreach($bancos as $banco){ 
                                                            extract($banco);
                                                            $selected = ($banco_id == $compra['banco_id']) ? ' selected="selected"' : "";
                                                            echo "<option value='$banco_id' $selected>$banco_nombre ($banco_numcuenta)</option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                            $ocultar = "none";
                                        if ($parametro["parametro_modulorestaurante"]==1){    
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
                                                
                                                    <option value="0">- MESAS -</option>
                                            <?php 
                                            
                                                foreach($mesas as $mesa ){ ?>
                                                    <option value="<?php echo $mesa["mesa_id"]; ?>"><?php echo $mesa["mesa_nombre"]; ?></option>
                                            
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
        
        <!-------------------------------------------------------------------->
        <!----------------- DATOS FACTURA CAFC ----------------------------------->
        <div class="row" id="div_cafc" style="display:none">
            
            
            <div class="col-md-3">
                <h5 class="modal-title" id="myModalLabel"><b>FECHA</b></h5>                                        
                <input type="date" id="fecha_cafc" class="btn btn-default btn-xs" style="width: 120px;" value="<?= date("Y-m-d"); ?>"/>
            </div>
            
            
            <div class="col-md-3">
                <h5 class="modal-title" id="myModalLabel"><b>HORA</b></h5>                                        
                <input type="time" id="hora_cafc" class="btn btn-default btn-xs" style="width: 120px;" value="<?= date("Y-m-d"); ?>"/>
            </div>
            
            
            <div class="col-md-3">
                <h5 class="modal-title" id="myModalLabel"><b>NRO.FACT.</b></h5>
                <input type="number" id="numfact_cafc" class="btn btn-default btn-xs" style="width: 120px;"/>
            </div>
            
            <div class="col-md-3">
                <h5 class="modal-title" id="myModalLabel"><b>COD. CAFC</b></h5>
                <input type="text" id="codigo_cafc" class="btn btn-default btn-xs" style="width: 120px;" value="<?php echo $dosificacion[0]["dosificacion_cafc"]; ?>"/>
            </div>
            
            
        </div>
                    
        <!-------------------------------------------------------------------->
        
        <div class="row">
            
            
            <div class="col-md-12">
            <!--<form action="<?php echo base_url('hotel/checkout/'.$pedido_id."/".$habitacion_id); ?>"  method="POST" class="form">-->
                <div class="box" style="margin-bottom: 2px">

            <div class="box-body table-responsive table-condensed">
            <!--<form method="post" name="descuento">-->                
            
            
            
            <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" style="max-width: 7cm">
                
                <tr>
                        <td  style="padding: 0" >Total <?php echo $parametro['moneda_descripcion']; ?></td>
                        <td align="right">
                            <input class="btn btn-danger btn-foursquarexs" style="padding: 0; background-color: black; font-size: 20px;" id="venta_total" size="<?php echo $ancho_boton; ?>"  name="venta_total" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                        </td>
                    
                    
                </tr>   
                
                <tr style="padding: 0">
                        <td style="padding: 0">Descuento <?php echo $parametro['moneda_descripcion']; ?></td>
                        <td align="right" style="padding: 0">
                            <input class="btn btn-foursquarexs" style="padding: 0" id="venta_descuentoparc" size="<?php echo $ancho_boton; ?>"  name="venta_descuentoparc" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                        </td>
                    
                </tr>

                <tr style="padding: 0">
                        <td style="padding: 0">Total ICE</td>
                        <td align="right" style="padding: 0">
                            <input class="btn" style="padding:0;" id="venta_ice" size="<?php echo $ancho_boton; ?>" name="venta_ice" value="<?php echo "0.00"; ?>"  onKeyUp="calcularcambio(event)"  >
                        </td>
                </tr>
                

                        
                <tr style="padding: 0">
                        <td align="right" style="padding: 0"><b>Sub Total <?php echo $parametro['moneda_descripcion']; ?></b></td>
                        <td align="right" style="padding: 0">                
                            
                            <input class="btn btn-foursquarexs"  style="padding: 0" id="venta_subtotal" size="<?php echo $ancho_boton; ?>"  name="venta_subtotal" value="<?php echo number_format($subtotal,2,'.',','); ?>" readonly="true">
                        </td>

                </tr>
                <tr style="padding: 0">                      
                        <td style="padding: 0">Descuento <?php echo $parametro['moneda_descripcion']; ?></td>
                        <td align="right" style="padding: 0">
                            <input class="btn btn-info"  style="padding: 0" id="venta_descuento" name="venta_descuento" size="<?php echo $ancho_boton; ?>" value="<?php echo $descuento; ?>" onKeyUp="calculardesc()" onclick="seleccionar(4)">
                            <select id="tipo_descuento" onchange="calculardesc()">
                                <option value="1"><?php echo $parametro['moneda_descripcion']; ?></option>
                                <option value="2">%</option>
                                
                            </select>
                        </td>
                </tr>

                <tr style="padding: 0">                      
                        <td style="padding: 0"><b>Total Final <?php echo $parametro['moneda_descripcion']; ?></b></td>
                        <td align="right" style="padding: 0">

                              <input class="btn btn-foursquarexs" style="font-size: 20px; padding: 0;" id="venta_totalfinal" size="<?php echo $ancho_boton; ?>" name="venta_totalfinal" value="<?php echo $totalfinal; ?>" readonly="true">

                        </td>
                </tr>


                <tr style="padding: 0">
                        <td style="padding: 0"><b>Tarjeta  Gift</b></td>
                        <td align="right" style="padding: 0">
                            <input class="btn" style="padding:0; background-color:orange; font-size:20px;" id="venta_giftcard" size="<?php echo $ancho_boton; ?>" name="venta_giftcard" value="<?php echo 0.00; ?>"  onKeyUp="calcularcambio(event)"  onclick="seleccionar(6)">
                        </td>
                </tr>

                <tr style="padding: 0">                      
                        <td style="padding: 0">Efectivo <?php echo $parametro['moneda_descripcion']; ?></td>
                        <td align="right" style="padding: 0">
                            <input class="btn" style="padding:0; background-color:yellow; font-size:20px;" id="venta_efectivo" size="<?php echo $ancho_boton; ?>" name="venta_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularcambio(event)"  onclick="seleccionar(5)">
                        </td>
                </tr>
                
                <tr style="padding: 0">                      
                    <td style="padding: 0"><b>Cambio <?php echo $parametro['moneda_descripcion']; ?></b></td>
                        <td align="right" style="padding: 0;">
                            <input class="btn btn-danger  btn-foursquarexs" style="padding: 0; background-color: black; font-size: 20px;"  id="venta_cambio" size="<?php echo $ancho_boton; ?>" name="venta_cambio" value="<?php echo number_format($cambio,2,'.',','); ?>" readonly="true" required min="0">
                        </td>
                </tr>
                
                
                
                
            </table>
            
            

          
            <div class="col-md-12">
                NOTA: <input type="text" style="padding: 0;" id="venta_glosa" name="venta_glosa" value="" class="form-control  input-sm">           
                
                <div class="col-md-12" style="display:none" id="imagenqr">
                    <center>
                        <img src="<?php echo base_url("resources/images/formapago/miqr.jpg") ?>">                        
                    </center>                    
                </div>
            
            </div>
           
        </div>
           
        </div>
                
                
                           
           <!-- ************************************* datos credito ************************************************-->
                
            <div class="row" id='creditooculto'  style='display:none;'>
                <div class="col-md-12">
                    <label style="margin-bottom: 0px">
                        <input type="checkbox" name="metodofrances" id="metodofrances"> Metodo Frances
                    </label>
                </div>
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
                    <h5 class="modal-title" id="myModalLabel"><b>CUOTA INIC. <?php echo $parametro['moneda_descripcion']; ?></b></h5>
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
            <!--<button class="btn btn-lg btn-facebook btn-sm btn-block" id="boton_finalizar" data-dismiss="modal" onclick="finalizarventa()" style="display: block;">-->
            <button class="btn btn-lg btn-facebook btn-sm btn-block" id="boton_finalizar" data-dismiss="modal" onclick="finalizarventa_sin()" style="display: block;">
                <h4>
                <span class="fa fa-save"></span>   Finalizar Venta  
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
                            <h4 class="modal-title" id="myModalLabel"><b>PEDIDOS/PREVENTAS</b></h4>
                                
                            <div class="input-group"> <span class="input-group-addon">Buscar</span>
                              <input id="filtrar3" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción">
                            </div>
                                
			</div>
			<div class="modal-body table-responsive">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                            <table class="table table-striped table-condensed" id="mitabla">
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th align="center">COD</th>
                                    <th>Total</th>
                                </tr>

                                <tbody class="buscar3" id="pedidos_pendientes">




                                </tbody>
                            </table>
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
            
    <?php if($parametro['parametro_mostrarcategoria']>0){ ?>
            <script type="text/javascript">   
               tablaresultados(2);
            </script>
     <?php       }
    ?>
<!---------------------- fin modal pedidos --------------------------------------------------->


<!----------------- modal ordenes---------------------------------------------->


<div class="modal fade" id="modalordenes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                            <h4 class="modal-title" id="myModalLabel"><b>ORDENES DE TRABAJO</b></h4>
                                
                            <div class="input-group"> <span class="input-group-addon">Buscar</span>
                              <input id="filtrar4" type="text" class="form-control" placeholder="Ingresa el nombre del cliente/ Numero de orden">
                            </div>
                                
			</div>
			<div class="modal-body table-responsive">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                            <table class="table table-striped table-condensed" id="mitabla">
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th align="center">O.T.</th>
                                    <th>Total</th>
                                </tr>

                                <tbody class="buscar3" id="ordenes_pendientes">




                                </tbody>
                            </table>
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
            
<!---------------------- fin modal ordenes --------------------------------------------------->

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
                                <h4 class="modal-title" id="myModalLabel"><b>PREFERENCIAS</b></h4>
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
<!-- --------------- fin modal clasificador ---------------------------------------------->
<!-- --------------- INICIO modal Advertencia ---------------------------------->
<div id="modal_mensajeadvertencia" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #CC660E">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"><fa class="fa fa-frown-o"></fa><b> ADVERTENCIA</b></h2>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
            <label for="monto_caja" class="control-label">
                <h2 class="modal-title">
                    <fa class="btn btn-warning fa fa-exclamation-triangle fa-2x"> </fa><b><span id="mensajeadvertencia"></span></b>
                </h2>
            </label>
        </div>  
        <div class="col-md-4">
            <!--<button class="btn btn-warning btn-block" onclick="codigo_excepcion()"><fa class="fa fa-arrow-right"></fa> Continuar</button>-->
            <button class="btn btn-info btn-block" data-dismiss="modal" onclick="excepcion_nit()" id="boton_advertencia"><fa class="fa fa-save"></fa> Aceptar</button>
            <button class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelar_excepcion_nit()"><fa class="fa fa-times"></fa> Cancelar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- --------------- F I N  modal Advertencia ---------------------------------->

<!------------------------ INICIO modal para cambiar el tipo de emision de facturas ------------------->
<div class="modal fade" id="modal_tipoemision" tabindex="-1" role="dialog" aria-labelledby="modal_tipoemisionlabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">CAMBIAR TIPO DE EMISION DE FACTURA</span>
            </div>
            
            <div class="row" id='loader_emision' style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
                </center>
            </div> 
            <div class="modal-body">
                <span>
                    <div class="col-md-6">
                        <label for="elparametro_tipoemision" class="control-label">Tipo de Emisión</label>
                        <div class="form-group">
                            <select name="elparametro_tipoemision" class="form-control" id="elparametro_tipoemision" required>
                                <option value="1" <?php if($parametro['parametro_tipoemision']=="1"){ ?> selected <?php } ?>>ONLINE</option>
                                <option value="2" <?php if($parametro['parametro_tipoemision']=="2"){ ?> selected <?php } ?>>OFFLINE</option>
                                <option value="3" <?php if($parametro['parametro_tipoemision']=="3"){ ?> selected <?php } ?>>MASIVA</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="dosificacion_nitemisor" class="control-label">Eventos</label>
                        <div class="form-group">

                            <select id="select_eventos" class="form-control">

                                <?php  foreach ($eventos_significativos as $evento) {?>

                                    <option value="<?= $evento['ces_codigoclasificador']; ?>"><?= $evento['ces_descripcion']; ?></option>

                                <?php } ?>

                            </select>

                        </div>
                    </div>
                    
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button class="btn btn-success" onclick="cambiar_tipoemision()" id="boton_tipoemision"><span class="fa fa-check"></span> Cambiar</button>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para cambiar el tipo de emision de facturas ------------------->




<!------------------------ envio de paquete de facturas ------------------->
<div hidden>
    <button type="button" id="boton_modal_paquetes" class="btn btn-primary" data-toggle="modal" data-target="#modal_enviopaquetes" >
      ENVIO PAQUETES
    </button>
    
</div>

<div class="modal fade" id="modal_enviopaquetes" tabindex="-1" role="dialog" aria-labelledby="modal_enviopaqueteslabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">ENVIANDO FACTURAS GENERADAS FUERA DE LINEA</span>
            </div>
            
            <div class="modal-body">
                <span>
                    <div class="col-md-6">
                        <label for="elparametro_tipoemision" class="control-label">Enviando archivos</label>
                        <img src="<?php echo base_url("resources/images/enviando.gif"); ?>" width="100" height="80" >
                        <div class="form-group">
<!--                            <select name="elparametro_tipoemision" class="form-control" id="elparametro_tipoemision" required>
                                <option value="1" <?php if($parametro['parametro_tipoemision']=="1"){ ?> selected <?php } ?>>ONLINE</option>
                                <option value="2" <?php if($parametro['parametro_tipoemision']=="2"){ ?> selected <?php } ?>>OFFLINE</option>
                                <option value="3" <?php if($parametro['parametro_tipoemision']=="3"){ ?> selected <?php } ?>>MASIVA</option>
                            </select>-->
                            
                            
                        </div>
                    </div>
                    
<!--                    <div class="col-md-6">
                        <label for="dosificacion_nitemisor" class="control-label">Eventos</label>
                        <div class="form-group">

                            <select id="select_eventos" class="form-control">

                                <?php  foreach ($eventos_significativos as $evento) {?>

                                    <option value="<?= $evento['ces_codigoclasificador']; ?>"><?= $evento['ces_descripcion']; ?></option>

                                <?php } ?>

                            </select>

                        </div>
                    </div>-->
                    
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <!--<a class="btn btn-success" onclick="cambiar_tipoemision()"><span class="fa fa-check"></span> Cambiar</a>-->
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para cambiar el tipo de emision de facturas ------------------->


<!--<script src="<?php echo base_url('resources/js/verificar_conexion.js'); ?>"></script>-->
<style type="text/css">
    .online, .offline{
      display: inline-block;
      padding: 0.5rem;
      border-radius: 5px;
      margin: 1rem;
    }

    .online{
      border: 3px solid green;
      color: green;
    }

    .offline{
      border: 3px solid red;
      color: red;
    }
</style>

<!--<p id="status" class="online">online</p>-->

<!--<button class="btn btn-info btn-xs" onclick="verificar_conexion()"><fa class="fa fa-cloud"></fa> verificar conexion</button>-->


<script type="text/javascript"> 
    /*
        function verificar_conexion(){
            


            if (navigator.onLine){ //Si existe conexion 
                //verficar si hay conexion a impuestos

                        var base_url = document.getElementById('base_url').value;
                        var controlador = base_url+'dosificacion/verificarcomunicacion';
                        $.ajax({url:controlador,
                                type:"POST",
                                data:{},
                                success:function(respuesta){
                                    
                                    let registros = JSON.stringify()(respuesta);
                                    alert(registros);
                                    
//                                    if(registros.return.transaccion == true){ //Si hay servicio de impuestos nacionales
//                                        
//                                        let codigo = registros.RespuestaComunicacion.mensajesList.codigo;
//                                        let descripcion = registros.RespuestaComunicacion.mensajesList.descripcion;
//                                        alert(codigo+" "+descripcion);
//                                        
//                                    }else{
//                                        registros.faultcode;
//                                    }

                                },
                                error:function(respuesta){
                                    alert("Error: Conexión fallida. Vuelva a intentar...!");
                                }
                            }); 

                    
                $("#elparametro_tipoemision").val(2);
            }else{
                $("#elparametro_tipoemision").val(1);
                
            }
        }
        setInterval("verificar_conexion()",3000);
      */  
</script>


<!------------------------------------------------------------------------------->
<!----------------------- EMISION DE PAQUETES ----------------------------------->
<!------------------------------------------------------------------------------->
<div hidden>
    <button type="button" id="boton_modalpaquetes" class="btn btn-primary" data-toggle="modal" data-target="#modalpaquetes" >
      ENVIO PAQUETES
    </button>
    
</div>

<div class="modal fade" id="modalpaquetes" tabindex="-1" role="dialog" aria-labelledby="modalpaquetes" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">SOLICITUD SERVICIO RECEPCION PAQUETE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="row" id='loader2'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    <label for="codigo_evento" class="control-label"><span class="text-danger">*</span>Código Evento</label>
<!--                    <div class="form-group">
                        <input type="text" name="codigo_evento" class="form-control" id="codigo_evento" />
                    </div>
-->                    
                    <select name="codigo_evento" class="form-control" id="codigo_evento" onchange="preparar_parametros()">
                        <option value="0">- SELECCIONAR EVENTO -</option>
                        <?php 
                            foreach($eventos as $evento){ ?>
                                <option value="<?php echo $evento['registroeventos_codigo']; ?>">    
                                    <?php echo $evento['registroeventos_codigo']." [".$evento['registroeventos_puntodeventa']."] ".$evento['registroeventos_detalle']." ".$evento['registroeventos_inicio']; ?>
                                </option>
                        <?php    } ?>
                            
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Nombre Archivo</label>
                    <div class="form-group">
                        <input type="text" name="nombre_archivo" value="compra_venta00.tar.gz" class="form-control" id="nombre_archivo" />
                    </div>
                </div>
<!--                <div class="col-md-4">
                    <label for="cant_fact" class="control-label"><span class="text-danger">*</span>Cantidad Facturas</label>
                    <div class="form-group">
                        <input type="number" name="cant_fact" value="1" class="form-control" id="cant_fact" />
                    </div>
                </div>-->
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="envio_paquetes()"><fa class="fa fa-floppy-o"></fa> Envio de Paquetes</button>
                <button type="button" class="btn btn-danger" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>
                
<!--<button type="button" class="btn btn-success" onclick="finalizarventa_sin()"><fa class="fa fa-floppy-o"></fa> Envio de Paquetes</button>-->