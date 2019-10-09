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
    $('#filtrar').focus();
  }

  if (keyCode == 119) //f8
  {       
    $('#boton_finalizar').click();
  }

  if (keyCode == 120) //f9
  {       
    $('#imprimir').click();
  }

  if (keyCode == 121) //f10
  {       
    $('#nit').focus();
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

<!--------------------- CABECERA -------------------------->

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>
<input type="text" value='<?php echo json_encode($categoria_producto); ?>' id="categoria_producto" hidden>
<input type="text" id="pedido_id" value="0" name="pedido_id" hidden>
<input type="text" id="orden_id" value="0" name="orden_id" hidden>
<input type="text" id="usuarioprev_id" value="0" name="usuarioprev_id" hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision" hidden>
<input type="text" id="venta_tipocambio" value="1" name="venta_tipocambio" hidden>
<input type="text" id="usuariopedido_id" value="0" name="usuariopedido_id" hidden>
<input type="text" id="detalleserv_id" value="0" name="detalleserv_id"  hidden>
<input type="text" id="parametro_modoventas" value="<?php echo $parametro[0]['parametro_modoventas']; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro[0]['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro[0]['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro[0]['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro[0]['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro[0]['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro[0]['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro[0]['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>

<!--<img src="<?php echo base_url("resources/images/logo.png"); ?>" class="img img-thumbnail" >-->
<!-------------------- inicio collapse ---------------------->

<div class="panel-group"  style="padding:0;">
  <div class="panel panel-default" style="padding:0;">
    <div class="panel-heading" style="padding:0;">
        
        
<!--------------------- cliente_id --------------------->
<div class="container" hidden>
    <input type="text" name="cliente_id" value="<?php echo $cliente[0]['cliente_id']; ?>" class="form-control" id="cliente_id" >
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
        
        <a data-toggle="collapse" href="#collapse1">Más</a>
                        
      </h4>

    </div>
    <div id="collapse1" class="panel-collapse collapse">
<!--      <ul class="list-group">-->
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
        
        </div>
<!--        <li class="list-group-item">Two</li>
        <li class="list-group-item">Three</li>-->
      <!--</ul>-->
<!--      <div class="panel-footer">Footer</div>-->
    </div>
  </div>
</div>  
<!-------------------- fin inicio collapse ---------------------->


<div class="row">
    <div class="col-md-12">
                <!--<h3 class="box-title">LIBRO DE VENTAS</h3>-->
        <div class="box">

            <div class="box-header">
                
                <div class="col-md-12">
                    <table class="table-bordered" id="mitabla">
                        <tr>
                            
                            <th style="padding: 0">CANTIDAD</th>
                            <th style="padding: 0">DESCRIPCIÓN</th>
                            <th style="padding: 0">UNIDAD</th>
                            <th style="padding: 0">PRECIO<br>UNITARIO</th>
                            <th style="padding: 0">SUBTOTAL</th>
                        </tr>
                        <tr>
                            <td><center><input type="text"></center> </td>
                        </tr>
                        
                    </table>
                    
                    
                    
                </div>    
            </div>    
        </div>    
    </div>    
</div>    