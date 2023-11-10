<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>"></script>
<!--sa<script src="<?php echo base_url('resources/js/zelect.js'); ?>"></script>-->


<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
     Styles for datatables 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
     JQuery include 
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
     Javascrips for datatables 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> -->

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

function mostrar_formapago(){
    
    var forma_id = document.getElementById('forma_pago').value;    
    var result = <?php echo json_encode($forma_pago); ?>;
    var html = "";
    
    var dato = result;
    var tam = dato.length;
    var mostrarimagen = "";
    var encontrado = 0;
    
    for(var i=0; i<tam ;i++)
    {
        if(forma_id == dato[i]["forma_id"]){
            imagen = dato[i]["forma_imagen"];
            
            if (imagen != null){
            
                mostrarimagen = "<?php echo base_url('resources/images/formapago/'); ?>";
                mostrarimagen += imagen;
                //alert(mostrarimagen);
                html += "<center>";
                html += "<img src='"+mostrarimagen+"' >";
                html += "</center>";
                $("#imagenqr").html(html);
                //$("#imagenqr").style = 'display:block';  
                
                document.getElementById('imagenqr').style.display = 'block';
                entontrado == 1;
            }
        }
    }    
    
    if (encontrado==0)
        document.getElementById('imagenqr').style.display = 'none';
    
    //alert(mostrarimagen);
////                <div class="col-md-12" style="display:none" id="imagenqr">
//               
//    $("#imagenqr").html(html);

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
    ///$('#codigo').focus();
      
  }    

  if (keyCode == 115) //f4
  {       
    ///$('#filtrar').focus();
  }

  if (keyCode == 118) //f7
  {       
   /// $('#nit').focus();
   /// $('#nit').select();
  }

  if (keyCode == 119) //f8
  {       
  ///  $('#boton_finalizar').click();
  }

  if (keyCode == 120) //f9
  {   
     /// alert("holaaaa");
      
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
    ///  $("#imprimir").click();
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
<div id="selector" hidden>
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
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro['moneda_id']; ?>" name="parametro_moneda_id"  hidden>
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro['moneda_descripcion']; ?>" name="parametro_moneda_descripcion"  hidden>
<input type="text" id="parametro_decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="parametro_decimales"  hidden>
<input type="text" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" name="tipousuario_id"  hidden>
<input type="text" id="preferencia_id" value="0" name="preferencia_id" hidden>
<input type="text" id="parametro_tamanioletras" value="<?php echo $parametro['parametro_tamanioletras']; ?>" name="parametro_tamanioletras"  hidden>
<input type="text" id="parametro_sininventario" value="<?php echo $parametro['parametro_sininventario']; ?>" name="parametro_sininventario"  hidden>
<input type="text" id="parametro_datosproducto" value="<?php echo $parametro['parametro_datosproducto']; ?>" name="parametro_datosproducto"  hidden>
<input type="text" id="parametro_cantidadsimple" value="<?php echo $parametro['parametro_cantidadsimple']; ?>" name="parametro_cantidadsimple"  hidden>
<input type="text" id="parametro_botonesproducto" value="<?php echo $parametro['parametro_botonesproducto']; ?>" name="parametro_botonesproducto"  hidden>
<input type="text" id="parametro_mostrarmoneda" value="<?php echo $parametro['parametro_mostrarmoneda']; ?>" name="parametro_mostrarmoneda"  hidden>
<input type="text" id="parametro_tablasencilla" value="<?php echo $parametro['parametro_tablasencilla']; ?>" name="parametro_tablasencilla"  hidden>
<input type="text" id="parametro_verificarconexion" value="<?php echo $parametro['parametro_verificarconexion']; ?>" name="parametro_verificarconexion"  hidden>
<input type="text" id="parametro_comprobante" value="<?php echo $parametro['parametro_comprobante']; ?>" name="parametro_comprobante"  hidden>
<input type="text" id="parametro_tamanioletrasboton" value="<?php echo $parametro['parametro_tamanioletrasboton']; ?>" name="parametro_tamanioletrasboton"  hidden>
<input type="text" id="factura_idcreditodebito" value="0" name="factura_idcreditodebito"  hidden>

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


<input type="text" id="parametro_imprimirfactura" value="<?php echo $parametro['parametro_imprimirfactura']; ?>" name="parametro_imprimirfactura"  hidden>
<input type="text" id="parametro_factura" value="<?php echo $parametro['parametro_factura']; ?>" name="parametro_factura"  hidden>
<input type="text" id="docsec_codigoclasificador" value="<?php echo $dosificacion[0]['docsec_codigoclasificador']; ?>" name="docsec_codigoclasificador" hidden>
<input type="text" id="dosificacion_documentosector" value="<?php echo $dosificacion[0]['dosificacion_documentosector']; ?>" name="dosificacion_documentosector" hidden>

<?php $decimales = $parametro['parametro_decimales']; ?>
<!--------------------- FIN CABECERA -------------------------->


<button class="btn btn-group btn-warning btn-xs" id="documento1" onclick="seleccionar_documento(1)" title=""><fa class="fa fa-cube"> </fa> </button>

<div hidden><input type="checkbox" class="form-check-input" id="codigoexcepcion" ><label class="btn btn-default btn-xs" for="codigoexcepcion">Código Excepción</label></div>
 <input type="checkbox" id="facturado" value="1" name="facturado" hidden>
 
 <a href="" data-toggle="modal" target="_blank" class="btn btn-default btn-xs" id="imprimir_comanda" title="Comanda" style=""><span class="fa fa-print"></span><b> Comanda</b></a> 

    <div class="box-header with-border">
                <h3 class="box-title">
                    <b>Formula de Producción</b>                                                     
                        
                </h3>
    </div>

<?php // echo form_open('formula/add'); ?>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-5">
						<label for="formula_nombre" class="control-label">Nombre</label>
						<div class="form-group">
							<input type="text" name="formula_nombre" value="<?php echo $this->input->post('formula_nombre'); ?>" class="form-control" id="formula_nombre" onKeyUp="this.value = this.value.toUpperCase();"/>
						</div>
					</div>
					<div class="col-md-2">
						<label for="formula_unidad" class="control-label">Unidad</label>
						<div class="form-group">
							<input type="text" name="formula_unidad" value="<?php echo $this->input->post('formula_unidad'); ?>" class="form-control" id="formula_unidad" onKeyUp="this.value = this.value.toUpperCase();"/>
						</div>
					</div>
                            
					<div class="col-md-1">
						<label for="formula_cantidad" class="control-label">Cantidad</label>
						<div class="form-group">
							<input type="text" name="formula_cantidad" value="<?php echo $this->input->post('formula_cantidad'); ?>" class="form-control" id="formula_cantidad" />
						</div>
					</div>
                                        <div class="col-md-1" hidden="">
						<label for="formula_costounidad" class="control-label">Costo Bs</label>
						<div class="form-group">
							<input type="text" name="formula_costounidad" value="<?php echo $this->input->post('formula_costounidad'); ?>" class="form-control" id="formula_costounidad" />
						</div>
					</div>
                            
					<div class="col-md-1">
						<label for="formula_preciounidad" class="control-label">Precio Bs</label>
						<div class="form-group">
							<input type="text" name="formula_preciounidad" value="<?php echo $this->input->post('formula_preciounidad'); ?>" class="form-control" id="formula_preciounidad" />
						</div>
					</div>
                            
					<div class="col-md-2">
			
                                            <label for="razon social" class="control-label" > Producto Final</label>

                                                <div class="form-group">
                                                    <input type="search" name="lista_productos" list="listaproductos" class="form-control" id="lista_productos" onkeypress="buscador_productos(event)"  onchange="mostrame()" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off" />
                                                    <datalist id="listaproductos" onclick="mostrame()">
                                                        
                                                    </datalist>

                                                </div>
					</div>
                            
				

				
<!--					<div class="col-md-2">
						<label for="formula_preciounidad" class="control-label" style="line-height: 0;"> 
                                                    <div class="form-group">
    							<input type="text" name="formula_preciounidad" value="<?php echo $this->input->post('formula_preciounidad'); ?>" class="form-control" id="formula_preciounidad" />
                                                            <?php 
                                                            if ($parametro["parametro_agruparitems"] == 1 )
                                                                    { $agrupar = "checked='true'";}
                                                              else {$agrupar = " ";}
                                                            ?>
                                                            <input type='checkbox' id='check_agrupar' value='1' <?php echo $agrupar; ?>> Agrupar
                                                    </div>
                                                
                                                </label>
                                                <button class="btn btn-block btn-warning"><fa class="fa fa-cogs"></fa> Insumos</button>
					</div -->
				</div>
			</div>
            
            
                        
            
            
            
      	</div>
    </div>
</div>


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
<!--    <center>-->
        
    <!--<span class="badge btn-danger" style="width: 300px;">-->
    
    
    
        <select class="bange btn-danger btn-xs" style="border-width: 0; width:110px;"  onchange="tablaresultados(2)" id="categoria_prod">
                <option value="0" >- CATEGORIAS -</option>
        <?php 
            foreach($categoria_producto as $categ){ 
                $selected = ($categ['categoria_id'] == $parametro['parametro_mostrarcategoria']) ? ' selected="selected"' : "";
                ?>
                
                <option value="<?php echo $categ['categoria_id']; ?>" <?php echo $selected; ?>><?php echo $categ['categoria_nombre']; ?></option>
        <?php
            }
        ?>
        </select>
        
        <select class="bange btn-danger btn-xs" style="border-width: 0; width:110px;"  onchange="tablaresultados(3)" id="subcategoria_prod">
                <option value="0" >- SUB CATEGORIAS -</option>
        
        </select>
        <span class="badge btn-facebook">
            <input style="border-width: 0; color: black;" id="encontrados" type="text"  size="3" value="0" readonly="true"> 
        
        </span>
    <!--</span>-->
       
<!-------------------------- BOTON AGRUPAR --------------------------------------->    
        <?php 
//            if ($parametro["parametro_agruparitems"] == 1 )
//                    { $agrupar = "checked='true'";}
//              else {$agrupar = " ";}
//        ?>
       <!--<button class="btn btn-primary btn-xs"><input type='checkbox' id='check_agrupar' class="btn btn-success btn-xs"  value='1' <?php echo $agrupar; ?>> Agrupar</button>--> 
        
<!-------------------------- FIN BOTON AGRUPAR --------------------------------------->    
       
       <button class="btn btn-success btn-xs" onclick="actualizar_inventario()"><span class="fa fa-cubes"></span> Inventario</button>
        <?php if($rolusuario[185-1]['rolusuario_asignado'] == 1){ ?>
        <button type="button" id="boton_modal_promocion" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalpromocion" >
            <fa class="fa fa-cube"></fa> Promociones
        </button>
        <?php } ?>
       
       
        <select class="btn btn-xs btn-warning" title="Buscar productos de acuerdo al parametro" id="select_buscador" onchange="$('#filtrar').focus();" <?php echo ($parametro["parametro_modulorestaurante"]==2)?"":"style='display:none' "; ?>">
            <option value="0">- DESCRIPCION -</option>
            <option value="1">PRINCIPIO ACTIVO</option>
            <option value="2">ACCION TERAPEUTICA</option>
            <option value="3">LINEA</option>
        </select>
<!--<span class="badge btn-primary">-->
        
        
        
        
        
        
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

                
    <!--</center>-->          
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
          
            <?php 
            if($rolusuario[15-1]['rolusuario_asignado'] == 1){ ?>
            <button onclick='costo_cero()' class='btn btn-danger btn-xs'><span class='fa fa-battery-0' title="Costo Cero"></span><b> - 0 -</b></button> 
            <?php }
            if($rolusuario[16-1]['rolusuario_asignado'] == 1){ ?>
            <button onclick='precio_costo()' class='btn btn-warning btn-xs'><span class='fa fa-money' title="Precio de costo"></span><b> Costo</b></button> 
            
            <?php } ?>
            
            
            <?php            
            if($rolusuario[21-1]['rolusuario_asignado'] == 1){ ?>
            <a href="<?php echo base_url('venta/ultimorecibo');?>" data-toggle="modal" target="_blank" class="btn btn-facebook btn-xs"  style="background-color: #761c19" id="imprimir"><span class="fa fa-print" title="Imprimir nota de entrega"></span><b> Recibo</b></a> 
            
            <?php } 
            ?>
            
            
            <?php if($rolusuario[14-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-success btn-xs"><span class="fa fa-cubes"></span><b> Finalizar</b></a> 
            <?php } ?>
            
            <span class='btn btn-facebook btn-xs' style="padding: 0;"> 
                
                        <?php 
                            if ($parametro["parametro_agruparitems"] == 1 )
                            { $agrupar = "checked='true'";}
                            else {$agrupar = " ";}
                        ?>
                <input type='checkbox' id='check_agrupar' value='1' <?php echo $agrupar; ?> style="padding: 0;" class="input-xs"><b> Agrupar </b>
            </span>

            </center>
            
            <!--<a href="<?php echo base_url('venta/ultimaventa');?>" data-toggle="modal" target="_blank" class="btn btn-primary btn-xs" id="imprimir"><span class="fa fa-print"></span><b> Plan de Pagos</b></a>--> 
            
            <!--------------- fin botones ---------------------->
            
            <!--------------------- fin parametro de buscador ---------------------> 
        
            </div>
            <div class="col-md-4" style="background-color: black; line-height: 15px;">
                <center>
                    
                <font size="3" style="color:white;" face="Arial"><b>Total Final <?php echo $parametro['moneda_descripcion']; ?></b></font>
                
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
          

            </div>
        </div>
        
        <!----------------------------------- BOTONES ---------------------------------->
        <?php 
        $ancho_boton = 120; 
        $alto_boton = 120; 
        
        ?>
        <div class="col-md-12" style="padding:0;">

            <center>
            <?php if($rolusuario[14-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" onclick="focus_efectivo()" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-money fa-4x"></i><br><br>Guardar Formula<br>
            </a>
            <?php } ?>

 

            <?php if($rolusuario[18-1]['rolusuario_asignado'] == 1){ ?>
            <a  href="<?php echo site_url('formula'); ?>" class="btn btn-sq-lg btn-danger" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-sign-out fa-4x"></i><br><br>
               Cerrar <br>
            </a>    
            <?php } ?>    
            </center>
            <br>
        </div>    
        <!----------------------------------- fin Botones ---------------------------------->
        <font face="Arial" size="1">
                   
        <span class="btn btn-danger btn-xs"> <b> MONEDA <?php echo $parametro["moneda_descripcion"]; ?> / T.C. Bs: <?php echo number_format($parametro["moneda_tc"],$decimales,".",","); ?></b></span>
        
        <b>            
        <!--<br>TECLAS DE ACCESO DIRECTO <br>-->
        </b>
        <p>
            
<!--        [F2] Busqueda por código de barras <br>
        [F4] Busqueda por parámetros<br>
        [F5] Actualizar página<br>        
        [F7] Registrar NIT<br>
        [F8] Finalizar venta<br>-->
        
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
                                    <h5 class="modal-title" id="myModalLabel"><b>GUARDAR FORMULA</b></h5>                                        
                                    </div>
                                        
                                    <div class="col-md-2" style="padding: 0;" hidden>
<!--                                        <h4 class="modal-title" id="myModalLabel"><b>FECHA DE ENTREGA</b></h4>
                                        <?php                                                     
                                            $fecha = date('Y-m-d'); 
                                            $hora = date('H:i:s');                                                                                         
                                        ?>
                                        
                                        <input type="datetime-local" id="fechahora_entrega" name="fechahora_entrega" value="<?php echo $fecha."T".$hora;?>" required>-->
                                        <h5 class="modal-title" id="myModalLabel"><b>FORMA DE PAGO</b></h5>                                        
                                        <select id="forma_pago"  name="forma_pago" class="btn btn-default btn-xs" onchange="mostrar_formapago()"  style="width: 120px;" >
                                            <?php
                                                foreach($forma_pago as $forma){ ?>
                                                    <option value="<?php echo $forma['forma_id']; ?>"><?php echo $forma['forma_nombre']; ?></option>                                                   
                                            <?php } ?>
                                                                                                    
                                         </select>
                                    </div>
                                    
                                    <div class="col-md-2" style="padding: 0;" hidden>
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
                 
        <div class="row">
            
            
            <div class="col-md-12">
            <!--<form action="<?php echo base_url('hotel/checkout/'.$pedido_id."/".$habitacion_id); ?>"  method="POST" class="form">-->
                <div class="box">

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
                        <td align="right" style="padding: 0"><b>Sub Total <?php echo $parametro['moneda_descripcion']; ?></b></td>
                        <td align="right" style="padding: 0">                
                            
                            <input class="btn btn-foursquarexs"  style="padding: 0" id="venta_subtotal" size="<?php echo $ancho_boton; ?>"  name="venta_subtotal" value="<?php echo number_format($subtotal,2,'.',','); ?>" readonly="true">
                        </td>

                </tr>

                <tr style="padding: 0">                      
                        <td style="padding: 0">Descuento <?php echo $parametro['moneda_descripcion']; ?></td>
                        <td align="right" style="padding: 0">
                            <input class="btn btn-info"  style="padding: 0" id="venta_descuento" name="venta_descuento" size="<?php echo $ancho_boton; ?>" value="<?php echo $descuento; ?>" onKeyUp="calculardesc()" onclick="seleccionar(4)" readonly="true">
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
           
           <!--************************************* fin datos credito ************************************************ --->
                 
            <button class="btn btn-lg btn-facebook btn-sm btn-block" id="boton_finalizar" data-dismiss="modal" onclick="guardar_formula()" style="display: block;">
                <h4>
                <span class="fa fa-save"></span>   Guardar Formula
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
                                <b>ADVERTENCIA: El inventario actual, remplazara algun inventario asignado previamente.</b>                                
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
                                    <div class="col-md-12" style="padding:0;" id="div_mensaje">
            
                                        <?php $estilo_mensaje = "font-family: Arial; line-height: 10pt; display: none; border-color:black; background: white; color: Green;"; ?>
                                        <span id="mensaje_enviado" class="btn btn-default btn-block" style="<?php echo $estilo_mensaje; ?>"><b style="font-family: Arial; font-size: 18pt;" ><img src="<?php echo base_url("resources/images/enviado.gif"); ?>" width="150px" height="100px"> FACTURA ENVIADA</b> </span>

                                        <?php $estilo_mensaje2 = "font-family: Arial; line-height: 10pt; display: none; border-color:black; background: white; color: Red;"; ?>
                                        <span id="mensaje_no_enviado" class="btn btn-default btn-block" style="<?php echo $estilo_mensaje2; ?>"><b style="font-family: Arial; font-size: 18pt;" ><img src="<?php echo base_url("resources/images/noenviado.gif"); ?>" width="100px" height="100px"> FACTURA NO ENVIADA</b><br><a href="<?php echo base_url("venta/rehacer_ultima_venta/"); ?>" type="button" class="btn btn-facebook" style='background-color: black;'><fa class="fa fa-recycle"></fa> Rehacer Factura</a><br><span id="mensaje_error" style="font-family: Arial; font-size: 9px;">Numero de identificacion tributaria invalido</span> </span>
                                        <br>

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
                                                //foreach($preferencia as $p)
                                                //{?>
                                                    <!--<button class="btn btn-xs btn-facebook" id="pref<?php echo $p["preferencia_id"]; ?>" name="<?php echo $p["preferencia_descripcion"]; ?>" style="background-color: #db0ead" onclick="agregar_preferencia(<?php echo $p["preferencia_id"]; ?>)"><i class="fa fa-cube"></i><?php echo $p["preferencia_descripcion"]; ?></button>-->
                                                    <!--<br>-->
                                                <?php //} 
                                                ?>
                                            </div>
                                            <input type="text" id="inputcaract" value="" class="form-control btn btn-xs btn-warning" onKeyUp="this.value = this.value.toUpperCase();">
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
                                                        <?php echo $parametro['moneda_descripcion']." ".number_format($prom["promocion_preciototal"],2,".",","); ?>
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