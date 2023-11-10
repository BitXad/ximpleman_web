
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/offline.js'); ?>"></script>
<!--<script src="<?php //echo base_url('resources/js/tipo_emision.js'); ?>"></script>-->



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

    if (x=='4'){ //si la transaccion es traspaso
        
            document.getElementById('div_sucursales').style.display = 'block';
            document.getElementById('facturado').checked = false;
       
        }
    else{
        document.getElementById('div_sucursales').style.display = 'none';}
    
    

}

function mostrar_formapago(){
    
    var forma_id = document.getElementById('forma_pago').value;    
    var result = <?php echo json_encode($forma_pago); ?>;
    var html = "";
    
    var dato = result;
    var tam = dato.length;
    var mostrarimagen = "";
    var encontrado = 0;
    
    if(forma_id==2 || forma_id==10 || forma_id==16 || forma_id==17 || forma_id==18 || forma_id==19 || forma_id==20 || forma_id==39 || forma_id==40 || forma_id==41 || forma_id==42 || forma_id==43 || forma_id==82 || forma_id==83 || forma_id==84 || forma_id==85 || forma_id==86 || forma_id==87 || forma_id==88 || forma_id==89 || forma_id==134 || forma_id==135 || forma_id==136 || forma_id==137 || forma_id==138 || forma_id==139 || forma_id==140 || forma_id==141 || forma_id==142 || forma_id==143 || forma_id==144 || forma_id==145 || forma_id==146 || forma_id==147 || forma_id==148 || forma_id==149 || forma_id==150 || forma_id==151 || forma_id==152 || forma_id==153 || forma_id==154 || forma_id==155 || forma_id==156 || forma_id==157 || forma_id==158 || forma_id==159 || forma_id==160 || forma_id==161 || forma_id==162 || forma_id==163 || forma_id==164 || forma_id==165 || forma_id==166 || forma_id==167 || forma_id==168 || forma_id==169 || forma_id==170 || forma_id==171 || forma_id==172 || forma_id==173 || forma_id==174 || forma_id==175 || forma_id==176 || forma_id==177 || forma_id==297){
        $("#venta_detalletransaccion").val("1234000000005678");
    }
    else{
        $("#venta_detalletransaccion").val("0");        
    }
    
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
//                html += "</center>";
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
    $('#glosay').click();
      
      
    //$('#imprimir').click();
  }

  if (keyCode == 121) //f9
  {   
      //$("#boton_modal_paquetes").click();
      $("#boton_simulador").click();
      
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
        
    function verificarComunicacion(){
        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'dosificacion/verificarcomunicacion';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    let registros = JSON.parse(respuesta);
                    alert(JSON.stringify(registros));
                },
                error:function(respuesta){
                    alert("Error: Conexión fallida. Vuelva a intentar...!");
                }
        });
    }
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventassimple.css'); ?>" rel="stylesheet">

 <!--<link rel="stylesheet" type="text/css" href="estilos.css" />-->
<!-------------------------------------------------------->
<div id="selector" hidden>
    <!--  Aqui inserta in input temporal que sirve para almacenar el factor de conversion del producto -->
    
</div>

<style type="text/css">
.scrollable-div {
   height: 500px; /* Ajusta la altura según tus necesidades */
   overflow-y: auto; /* Habilita el scroll vertical */
   /* Agrega otros estilos según sea necesario */
} 
    
    
</style>
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
<input type="text" id="parametro_imprimirticket" value="<?php echo $parametro['parametro_imprimirticket']; ?>" name="parametro_imprimirticket" hidden>
<input type="text" id="parametro_imprimircomanda" value="<?php echo $parametro['parametro_imprimircomanda']; ?>" name="parametro_imprimircomanda"  hidden>
<input type="text" id="parametro_diasvenc" value="<?php echo $parametro['parametro_diasvenc']; ?>" name="parametro_diasvenc"  hidden>
<input type="text" id="parametro_cantidadproductos" value="<?php echo $parametro['parametro_cantidadproductos']; ?>" name="parametro_cantidadproductos"  hidden>
<input type="text" id="parametro_datosboton" value="<?php echo $parametro['parametro_datosboton']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro['moneda_id']; ?>" name="parametro_moneda_id"  hidden>
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro['moneda_descripcion']; ?>" name="parametro_moneda_descripcion"  hidden>
<input type="text" id="parametro_factura" value="<?php echo $parametro['parametro_factura']; ?>" name="parametro_factura"  hidden>
<input type="text" id="parametro_tiposistema" value="<?php echo $parametro['parametro_tiposistema']; ?>" name="parametro_tiposistema"  hidden>
<input type="text" id="parametro_tipoemision" value="<?php echo $parametro['parametro_tipoemision']; ?>" name="parametro_tipoemision"  hidden>
<input type="text" id="elparametro_id" value="<?php echo $parametro['parametro_id']; ?>" name="elparametro_id"  hidden>
<input type="text" id="parametro_decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="parametro_decimales"  hidden>
<input type="text" id="parametro_puntos" value="<?php echo $parametro['parametro_puntos']; ?>" name="parametro_puntos"  hidden>
<input type="text" id="parametro_imprimirfactura" value="<?php echo $parametro['parametro_imprimirfactura']; ?>" name="parametro_imprimirfactura"  hidden>
<input type="text" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" name="tipousuario_id"  hidden>
<input type="text" id="preferencia_id" value="0" name="preferencia_id" hidden>
<input type="text" id="dosificacion_modalidad" value="<?php echo $dosificacion[0]['dosificacion_modalidad']; ?>" name="dosificacion_modalidad"  hidden>
<input type="text" id="docsec_codigoclasificador" value="<?php echo $dosificacion[0]['docsec_codigoclasificador']; ?>" name="docsec_codigoclasificador" hidden>
<input type="text" id="dosificacion_documentosector" value="<?php echo $dosificacion[0]['dosificacion_documentosector']; ?>" name="dosificacion_documentosector" hidden>

<input type="text" id="rol_precioventa" value="<?php echo $rolusuario[160-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor" value="<?php echo $rolusuario[161-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor1" value="<?php echo $rolusuario[162-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor2" value="<?php echo $rolusuario[163-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor3" value="<?php echo $rolusuario[164-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor4" value="<?php echo $rolusuario[165-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_modificardetalle" value="<?php echo $rolusuario[20-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="punto_venta" value="<?php echo $puntoventa_codigo; ?>" hidden>

<input type="text" id="tipocliente_porcdesc" value="0" hidden>
<input type="text" id="tipocliente_montodesc" value="0" hidden>
<input type="text" id="moneda_tc" value="<?php echo $moneda['moneda_tc']; ?>" hidden>
<input type="text" id="moneda_descripcion" value="<?php echo $moneda['moneda_descripcion']; ?>" hidden>
<input type="text" id="cliente_valido" value="1" hidden>
<input type="text" id="credito_id" value="0" name="credito_id" hidden>

<input type="text" id="parametro_anchobuscador" value="<?php echo $parametro['parametro_anchobuscador']; ?>" name="parametro_anchobuscador"  hidden>
<input type="text" id="parametro_tamanioletrasboton" value="<?php echo $parametro['parametro_tamanioletrasboton']; ?>" name="parametro_tamanioletrasboton"  hidden>
<input type="text" id="parametro_tamanioletras" value="<?php echo $parametro['parametro_tamanioletras']; ?>" name="parametro_tamanioletras"  hidden>
<input type="text" id="parametro_sininventario" value="<?php echo $parametro['parametro_sininventario']; ?>" name="parametro_sininventario"  hidden>
<input type="text" id="parametro_datosproducto" value="<?php echo $parametro['parametro_datosproducto']; ?>" name="parametro_datosproducto"  hidden>
<input type="text" id="parametro_cantidadsimple" value="<?php echo $parametro['parametro_cantidadsimple']; ?>" name="parametro_cantidadsimple"  hidden>
<input type="text" id="parametro_botonesproducto" value="<?php echo $parametro['parametro_botonesproducto']; ?>" name="parametro_botonesproducto"  hidden>
<input type="text" id="parametro_mostrarmoneda" value="<?php echo $parametro['parametro_mostrarmoneda']; ?>" name="parametro_mostrarmoneda"  hidden>
<input type="text" id="parametro_tablasencilla" value="<?php echo $parametro['parametro_tablasencilla']; ?>" name="parametro_tablasencilla"  hidden>
<input type="text" id="parametro_verificarconexion" value="<?php echo $parametro['parametro_verificarconexion']; ?>" name="parametro_verificarconexion"  hidden>
<input type="text" id="parametro_comprobante" value="<?php echo $parametro['parametro_comprobante']; ?>" name="parametro_comprobante"  hidden>
<input type="text" id="factura_idcreditodebito" value="0" name="factura_idcreditodebito"  hidden>
<input type="text" id="boton_presionado" value="0" hidden>

<!--<img src="<?php echo base_url("resources/images/logo.png"); ?>" class="img img-thumbnail" >-->

<?php $atributos = " btn btn-default btn-sm";  //atributos para los inputs del clientes?>
<?php $estilos_facturacion = " style='color: black; background: #1221; text-align: left; font-size: 18px; font-family: Arial;'"; //estilo para los inputs de facturacion?>
<?php $estilos = " style='background: white; color: black; text-align: left;  font-family: Arial;'"; //estilo para los inputs del cliente?>
<?php $estilo_div = " style='padding:2; padding-left:1px; margin:0; line-height:12px;' "; ?>
<!-------------------- inicio collapse ---------------------->

<div class="panel-group" <?php echo $estilo_div; ?>>
    
    <font size="1"><b>DATOS DEL CLIENTE</b> 
    <div <?php echo ($dosificacion[0]['docsec_codigoclasificador'] != 12)? "hidden" : "";  ?>>
        
        * PLACA <input type="text" width="100px" class="btn btn-warning btn-xs" id="datos_placa" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off" onkeypress="buscar_placa(event);" style="font-size: 12px;">    
        * EMBASE <input type="text" width="100px" class="btn btn-warning btn-xs" id="datos_embase" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off" style="font-size: 12px;" value="-">        
        * PAIS <select type="text" width="100px" class="btn btn-warning btn-xs" id="datos_codigopais" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off" style="font-size: 12px;">
                    <option value="0">-NINGUNO-</option>
                    <?php foreach ($paises as $p){ ?>
                                <option value="<?php echo $p["pais_id"] ?>"><?php echo $p["pais_descripcion"]; ?></option>
                            
                    <?php } ?>
                    
               </select>
        * COD. AUTORZ. SC <input type="text" width="100px" class="btn btn-warning btn-xs" id="datos_autorizacionsc" value="FGGR4577RT4G" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off" style="font-size: 12px;">
    </div>
      
    </font>
      
        <div class="box" style="border-color:black;">
            <div class="box-body">
      
      
    <div class="panel panel-default" <?php echo $estilo_div; ?> >
      <div class="panel-heading" <?php echo $estilo_div; ?>>
      

<!--------------------- cliente_id --------------------->
<div class="container" hidden>
    <input type="text" name="cliente_id" value="<?php echo $cliente[0]['cliente_id']; ?>" class="form-control" id="cliente_id" >
</div>

<!--------------------- fin cliente_id --------------------->

        <div class="col-md-2" <?= $estilo_div ?> <?= ($parametro['parametro_documentoslista']!=1)?"":"hidden" ?>>
            <label for="tipo_doc_identidad" class="control-label" style="margin-bottom: 0; font-size: 12px; color: gray; font-weight: normal">TIPO DOCUMENTO IDENTIDAD</label>
            <br>
            <?php
                
                $tam = sizeof($docs_identidad);
               foreach ($docs_identidad as $di){?> 
                   
            <button class="btn btn-group <?= ($di['cdi_id']==$cliente[0]['cdi_codigoclasificador'])?"btn-warning":"btn-default"; ?>  btn-xs" id="documento<?php echo $di['cdi_id']; ?>" onclick="seleccionar_documento(<?php echo $di['cdi_id']; ?>)" title="<?php echo $di['cdi_descripcion']; ?>"><fa class="fa fa-cube"> </fa><br> <?php echo substr($di['cdi_descripcion'],0,5); ?><br></button>
               <?php    
                    //if($tam<=2){ ?>
            
                        <!--<button class="btn btn-group <?= ($di['cdi_id']==$cliente[0]['cdi_codigoclasificador'])?"btn-warning":"btn-default"; ?>  btn-xs" id="documento<?php echo $di['cdi_id']; ?>" onclick="seleccionar_documento(<?php echo $di['cdi_id']; ?>)"><fa class="fa fa-cube"> </fa> <?php echo $di['cdi_descripcion']; ?></button>-->                   

                    <?php //}else{?>
                        
                        <!--<button class="btn btn-group <?= ($di['cdi_id']==$cliente[0]['cdi_codigoclasificador'])?"btn-warning":"btn-default"; ?>  btn-xs" id="documento<?php echo $di['cdi_id']; ?>" onclick="seleccionar_documento(<?php echo $di['cdi_id']; ?>)" title="<?php echo $di['cdi_descripcion']; ?>"><fa class="fa fa-cube"> </fa> <?php echo substr($di['cdi_descripcion'],0,5); ?></button>-->

                    <?php       //}
               }?>
            
            
            
            
        </div>
        <div class="col-md-2" <?= $estilo_div ?> <?= ($parametro['parametro_documentoslista']==1)?"":"hidden" ?>>
            <label for="tipo_doc_identidad" class="control-label" style="margin-bottom: 0; font-size: 12px; color: gray; font-weight: normal">TIPO DOCUMENTO IDENTIDAD</label>
            <div class="form-group" <?= $estilo_div ?>>
                <select class="form-control <?php echo $atributos; ?>" name="tipo_doc_identidad" id="tipo_doc_identidad" <?= $estilos_facturacion ?> onchange="seleccion_documento()">
                    <?php 
                        $select = $cliente[0]['cdi_codigoclasificador'];
                        
                        if(isset($cliente[0]['cliente_codidentidad'])) $select = $cliente[0]['cliente_codidentidad'];
                        
                        foreach ($docs_identidad as $di){
                            
                            if($dosificacion[0]['docsec_codigoclasificador'] == 23){
                                
                                if($di['cdi_codigoclasificador'] == 5){
                                    ?>
                                    <option value="<?= $di['cdi_codigoclasificador'] ?>" selected><?= $di['cdi_descripcion'] ?></option>
                                    <?php
                                    break;
                                }
                                
                            }else{
                                
                                $selected = $di['cdi_codigoclasificador'] == $select ? "selected" : "" ;// por defecto que esté seleccionado NIT
                        ?>                    
                        <option value="<?= $di['cdi_codigoclasificador'] ?>" <?= $selected ?>><?= $di['cdi_descripcion'] ?></option>
                    <?php
                            }
                    }?>
                </select>
            </div>
        </div>

        <?php
        $sololectura = "";
        if($dosificacion[0]['docsec_codigoclasificador'] == 23){ $sololectura = "readonly"; } ?>
        <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="nit" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray; font-weight: normal;">NUMERO DE DOCUMENTO</label>
            <div class="input-group"  <?php echo $estilo_div; ?>>
              
                <?php if($parametro['parametro_comprobante']==2){ //si es factura trch en vez de recibo ?>
                    
                        <div style="border-color: #be2626; background: #be2626 !important; color: white" class="btn btn-danger input-group-addon" onclick="cliente_sinnombre()" title=""><span class="fa fa-user-md" aria-hidden="true" id="span_cliente_sinnombre"></span></div>
                                
                <?php } ?>
                <input type="<?= ($parametro["parametro_tiposistema"]==1)?"number":"text"; ?>" name="nit" class="form-control  <?php echo $atributos; ?>" <?php echo $estilos_facturacion; ?> id="nit" value="<?php echo $cliente[0]['cliente_nit']; ?>"  onkeypress="validar(event,1)" onclick="seleccionar(1)" onKeyUp="this.value = this.value.toUpperCase();" <?php echo $sololectura?> />
                <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="validar(13,1)" title="Buscar por número de documento"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente"></span></div>
            
            </div>
        </div>
        
        <div class="col-md-3"  <?php echo $estilo_div; ?> >
            
            <label for="razon social" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray; font-weight: normal;">RAZON SOCIAL</label>
            <div class="input-group" <?php echo $estilo_div; ?>>
                
                <input type="search" name="razon_social" list="listaclientes" class="form-control <?php echo $atributos; ?>" <?php //echo $estilos_facturacion; ?> " style="color: black; background: gray; text-align: left; font-size: 18px; font-family: Arial;" id="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" onkeypress="validar(event,9)"  onchange="seleccionar_cliente()" onclick="seleccionar(2)" onKeyUp="this.value = this.value.toUpperCase();" autocomplete="off" readonly />
                <datalist id="listaclientes"></datalist>
                <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="validar(13,9)" title="Buscar por número de documento"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente"></span></div>
                
            </div>
            
        </div>
<?php
    $es_movil = "0";
    $es_movil = "<script>document.write(esmovil);</script>";         

?>   

<?php //if($es_movil == 0){ ?> 

        <div class="col-md-2" <?php echo $estilo_div; ?>>
        <label for="cliente_celular" class="control-label" style="margin-bottom: 0;  font-size: 10px; color: gray;  font-weight: normal;">CELULAR</label>
        <div class="form-group" <?php echo $estilo_div; ?>>
            <input type="text" name="cliente_celular" class="form-control <?php echo $atributos; ?>" <?php echo $estilos_facturacion; ?> id="cliente_celular" onkeypress="validar(event,12)" onclick="seleccionar(3)" value="<?php echo $cliente[0]['cliente_celular']; ?>" onKeyUp="this.value = this.value.toUpperCase();"/>
        </div>
        
        </div>

        <div class="col-md-2" <?php echo $estilo_div; ?>>
            <label for="email" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">CORREO ELECTRONICO</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="email" name="email" class="form-control <?php echo $atributos; ?>" <?php echo $estilos_facturacion; ?> id="email"  value="<?php echo ($cliente[0]['cliente_email']==null)? $empresa_email : $cliente[0]['cliente_email']; ?>" onclick="this.select()" onkeypress="validar(event,13)"/>
            </div>
        </div>
        
        <?php 
            if($parametro["parametro_panelventas"]==1){ 
                
                if($parametro["parametro_documentoslista"]==1){?>

                        <div class="col-md-2" <?php echo $estilo_div; ?> <?= ($parametro['parametro_documentoslista']==1)?"":"hidden" ?>>
                            <label for="glosay" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">SERVICIO</label>
                            <div class="form-group" <?php echo $estilo_div; ?>>
                                <select id="tiposerv_id" name="tiposerv_id" class="form-control btn btn-info btn-xs">

                                    <?php
                                        foreach($tipo_servicio as $ts){ ?>
                                            <option value="<?php echo $ts['tiposerv_id']; ?>"><?php echo $ts['tiposerv_descripcion']; ?></option>
                                    <?php } ?>

                                 </select>
                            </div>
                        </div>

                <?php }else{ ?>

                        <div class="col-md-2" <?php echo $estilo_div; ?>>
                            <label for="glosay" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">SERVICIO</label>
                            <div class="form-group" <?php echo $estilo_div; ?>>
                                    <?php
                                        foreach($tipo_servicio as $ts){ ?>
                                            <button class="btn btn-group <?= ($ts['tiposerv_id']==1)?"btn-warning":"btn-default"; ?>  btn-xs" id="servicio<?php echo $ts['tiposerv_id']; ?>" onclick="seleccionar_servicio(<?php echo $ts['tiposerv_id']; ?>)"><fa class="fa fa-cube"> </fa> <?php echo $ts['tiposerv_descripcion']; ?></button>

                                    <?php } ?>

                            </div>
                        </div>
                <?php } ?>

        <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="glosay" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">PREFERENCIAS</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="glosay" class="form-control <?php echo $atributos; ?>" style="color: black; background:white; text-align: left; font-size: 18px; font-family: Arial; " id="glosay"  value="" onclick="this.select()" onkeyup="transcribir_glosa(event); this.value = this.value.toUpperCase();"/>
            </div>
        </div>

        <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="totaly" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">TOTAL</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="totaly" class="form-control <?php echo $atributos; ?>"  style="color: black; background: #000000; text-align: left; font-size: 18px; font-family: Arial; color: white" id="totaly"  value="0.00" onclick="this.select()" readonly/>
            </div>
        </div>

        <div class="col-md-2" <?php echo $estilo_div; ?>>
            <label for="cobradoy" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">COBRADO</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cobradoy" class="form-control <?php echo $atributos; ?>" style="color: black; background:white ; text-align: left; font-size: 18px; font-family: Arial; " id="cobradoy"  value="0.00" onclick="this.select()" onkeyup="transcribir()"/>
            </div>
        </div>

        <div class="col-md-2" <?php echo $estilo_div; ?>>
            <label for="cambioy" class="control-label" style="margin-bottom: 0; font-size: 10px; color: gray;  font-weight: normal;">CAMBIO</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cambioy" class="form-control <?php echo $atributos; ?>" style="color: black; background: #be2626; text-align: left; font-size: 18px; font-family: Arial; color: white" id="cambioy"  value="0.00" onclick="this.select()"/>
            </div>
        </div>
        
        <?php } // fin $parametro["parametro_tiposistema"]==1 ?>
        
<!--            <div class="input-group"  <?php echo $estilo_div; ?>>
                <div class="btn btn-success input-group-addon" onclick="validar(13,1)" title="Buscar por número de documento"><span class="fa fa-floppy-o" aria-hidden="true" id="span_buscar_cliente"></span></div>
                <div class="btn btn-primary input-group-addon" onclick="validar(13,1)" title="Buscar por número de documento"><span class="fa fa-battery-0" aria-hidden="true" id="span_buscar_cliente"></span></div>
                <div class="btn btn-danger input-group-addon" onclick="validar(13,1)" title="Buscar por número de documento"><span class="fa fa-cubes" aria-hidden="true" id="span_buscar_cliente"></span></div>
                <div class="btn btn-warning input-group-addon" onclick="validar(13,1)" title="Buscar por número de documento"><span class="fa fa-download" aria-hidden="true" id="span_buscar_cliente"></span></div>
                <div class="btn btn-facebook input-group-addon" onclick="validar(13,1)" title="Buscar por número de documento"><span class="fa fa-search" aria-hidden="true" id="span_buscar_cliente"></span></div>
            
            </div>-->


<!---------------------- collapse ----------------------------->
        <h4 class="panel-title">
            <!--<div class="col-md-12">-->
            <?php
            if(sizeof($dosificacion)>0){
                if($parametro['parametro_factura'] == 1){ // todo facturado
                    $eschecked = "checked disabled";
                }elseif($parametro['parametro_factura'] == 2){ // factura opcional tipo 1
                    $eschecked = "";
                }elseif($parametro['parametro_factura'] == 3){ // sin factura
                    $eschecked = "hidden";
                }elseif($parametro['parametro_factura'] == 4){ // factura opcional tipo 2
                    $eschecked = "checked";
                }
            ?>
            <input type="checkbox" id="facturado" value="1" name="facturado" <?php echo $eschecked; ?>>
          <?php } else{ ?>
            <input type="checkbox" id="facturado" value="1" name="facturado" hidden>
            <font color="red" size="2"> Dosificación no activada</font>
          <?php } ?> 
          <a data-toggle="collapse" href="#collapse1" style="padding: 0;" class="btn btn-default btn-sm"> 
            Más información</a>
            
            
            <?php 
            if ($parametro["parametro_agruparitems"] == 1 )
                    { $agrupar = "checked='true'";}
              else {$agrupar = " ";}
            ?>
            <input type='checkbox' id='check_agrupar' value='1' <?php echo $agrupar; ?>> <label class="btn btn-default btn-xs" for="check_agrupar"> Agrupar</label> 
            <input type="checkbox" class="form-check-input" id="busqueda_serie"><label class="btn btn-default btn-xs" for="busqueda_serie">Búsqueda por serie</label>
            <?php if($parametro["parametro_tiposistema"] != 1){ ?>
                    <?php
                    if($parametro["parametro_tipoemision"] == 1){?>
                
                        <a class="btn btn-danger btn-xs" onclick="modal_cambiartipoemision()" title="Tipo de Emisión" >
                        <span id="eltipo_emision" style="color: white;">EN LINEA</span>
                        </a>
                    <?php
                    }elseif($parametro["parametro_tipoemision"] == 2){ ?>
                        <a class="btn btn-default btn-xs" onclick="modal_cambiartipoemision()" title="Tipo de Emisión" style="background: grey">
                        <span id="eltipo_emision" style="color: white;">FUERA DE LINEA</span>
                        </a>        
                
                       
                    <?php
                    }if($parametro["parametro_tipoemision"] == 3){ ?>
                        
                        <a class="btn btn-warning btn-xs" onclick="modal_cambiartipoemision()" title="Tipo de Emisión">
                        <span id="eltipo_emision" style="color: white;">masiva</span>
                        </a>        
                        
                    <?php }
                    ?>
            <div hidden>                
                <input type="checkbox" class="form-check-input" id="codigoexcepcion" <?= ($cliente[0]['cliente_excepcion']==1)?"checked":"";  //($parametro["parametro_tipoemision"]>1)?"checked":"";?> ><label class="btn btn-default btn-xs" for="codigoexcepcion">Código Excepción</label>
            </div>
            
                <?php }else{ ?>
            <div hidden><input type="checkbox" class="form-check-input" id="codigoexcepcion" ><label class="btn btn-default btn-xs" for="codigoexcepcion">Código Excepción</label></div>
                <?php
                }  ?>
            
            <?php if ($parametro["parametro_tiposistema"]!=1){
                ?>
                
                <select class="btn btn-default btn-xs" id="evento_contingencia" onchange="cargar_contingencia()" >
                    <option value="0">- SIN CONTINGENCIA -</option>
                        <?php 
                                foreach($eventos as $evento){ ?>
                    <option value="<?= $evento["registroeventos_codigo"]; ?>"><?= $evento["registroeventos_fecha"]." ".substr($evento["registroeventos_detalle"],0,30)."..."; ?></option>
                        <?php } ?>

                </select>
            <a href="<?php echo base_url("eventos_significativos"); ?>" class="btn btn-default btn-xs" title="Registrar evento significativo"><fa class="fa fa-floppy-o"> </fa> </a>
            
    
            <button type="button" id="boton_modalpaquetes" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalpaquetes" >
                <fa class="fa fa-cubes"></fa>
            </button>
        
            <?php if($dosificacion[0]['docsec_codigoclasificador'] == 13){ ?>
            
                <button type="button" id="boton_modaldatosservicio" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modaldatosservicios" >
                    <fa class="fa fa-database"></fa>
                </button>
            <?php } ?><!-- comment -->
            
            <?php 
                }else{ ?>
                           
                    <input type="hidden" id="evento_contingencia" value="0" />

            <?php    }  ?>

            
            
         
        </h4>
     
        <div class="row" id='loader_documento' style='display:none;'>
            <center>
                <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
            </center>
        </div> 
    </div>
      
    <div id="collapse1" class="panel-collapse collapse">
        <!---------------------- contenido collapse ----------------------------->
        <div class="col-md-3" <?php echo $estilo_div; ?>>
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
        
        <div class="col-md-3" <?php echo $estilo_div; ?>>
            <label for="nombre" class="control-label" style="margin-bottom: 0;">CLIENTE</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_nombre" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_nombre" value="<?php echo $cliente[0]['cliente_nombre']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
        </div>
        <div class="col-md-2" <?php echo $estilo_div; ?>>
            <label for="cliente_ci" class="control-label" style="margin-bottom: 0;">C.I.</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_ci" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_ci" value="<?php echo $cliente[0]['cliente_ci']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
        </div>
        <div class="col-md-1" <?php echo $estilo_div; ?>>
            <label for="cliente_complementoci" class="control-label" style="margin-bottom: 0;">Compl. C.I.</label>
            <div class="form-group" <?php echo $estilo_div; ?>>
                <input type="text" name="cliente_complementoci" class="form-control <?php echo $atributos; ?>" <?php echo $estilos; ?> id="cliente_complementoci" value="<?php echo $cliente[0]['cliente_complementoci']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
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
        <div class="col-md-3" <?php echo $estilo_div; ?> hidden="">
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
    </div>
        
      
  </div>

<!-------------------- fin inicio collapse ---------------------->

<!--------------------- FIN CABERECA -------------------------->

<div class="row">
    
    
    <div class="col-md-<?php echo $parametro['parametro_anchobuscador']; ?>">
        
        
        <!------------------------- PARA NOTAS DE DEBITO CREDITO --------------->
        <font size="1"><b><?php if ($dosificacion[0]['docsec_codigoclasificador']!=24){ echo  "BUSCADOR DE PRODUCTOS"; }else{ echo "BUSCAR FACTURA"; } ?></b></font> 
        
            <?php if($dosificacion[0]['docsec_codigoclasificador']==24){ ?>
        
                <button type="button" id="boton_buscarfactura" class="btn btn-facebook btn-xs" data-toggle="modal" data-target="#modalbuscarfactura"><span class="fa fa-binoculars"></span> Buscar Factura</button>
             
            <?php } ?>
        <!------------------------- FIN PARA NOTAS DE DEBITO CREDITO --------------->
        
            <button class="btn btn-success btn-xs" onclick="actualizar_inventario()" style="<?php echo ($parametro["parametro_botoninventario"]!=1)?"":"display:none" ?>"><span class="fa fa-cubes"></span> Inventario</button>
           
            <button type="button" id="boton_modal_promocion" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalpromocion" style="<?php echo ($parametro["parametro_promociones"]!=1)?"":"display:none" ?>" >
                <fa class="fa fa-cube"></fa> Promociones
            </button>

           <select class="btn btn-xs btn-warning" title="Buscar productos de acuerdo al parametro" id="select_buscador" onchange="$('#filtrar').focus();" <?php echo ($parametro["parametro_modulorestaurante"]==2)?"":"style='display:none' "; ?>">
               <option value="0">- DESCRIPCION -</option>
               <option value="1">PRINCIPIO ACTIVO</option>
               <option value="2">ACCION TERAPEUTICA</option>
               <option value="3">LINEA</option>
           </select>
        
        <div class="box" style="border-color:black;">
            <div class="box-body"  <?= ($dosificacion[0]['docsec_codigoclasificador']==24)?"hidden":""; ?>>

        <div class="row">
            
            <!--------------------- parametro de buscador por codigo --------------------->

            <div class="col-md-5" <?php echo ($parametro["parametro_buscadorcodigo"]!=1)?"hidden":"" ?>>
                  <div class="input-group">
                      <span class="input-group-addon" style="background-color: lightgray;"> 
                        <i class="fa fa-barcode"></i>
                      </span>           
                      <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Código, serie" onkeyup="validar(event,3)" autocomplete="off">
                      <div style="border-color: #008d4c; background: #008D4C !important; color: white;" class="btn btn-success input-group-addon" onclick="validar(13,3)" title="Buscar"><span class="fa fa-search" aria-hidden="true"></span></div>
                  </div>
            </div>      
            
           <!--------------------- fin buscador por codigo --------------------->
           

            <div class="col-md-7" <?php echo ($parametro["parametro_buscadortexto"]!=1)?"hidden":"" ?>>
                
<!--            ------------------- parametro de buscador --------------------->
                       
                  <div class="input-group">
                      <span class="input-group-addon" onclick="ocultar_busqueda();"  style="background-color: lightgray;"> 
                        Buscar 
                      </span>           
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código, serie" onkeypress="validar(event,4)">
                      <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultados(1)" title="Buscar"><span class="fa fa-search" aria-hidden="true"></span></div>
                  </div>
            
<!--            ------------------- fin parametro de buscador ------------------- -->
            
            </div>
           
           

            
        </div>
<!-------------------- CATEGORIAS------------------------------------->
    <?php $opciones = 0; ?>
    <div class="container" id="categoria" style="padding:0;">
    <!--    <center>-->

        <!--<span class="badge btn-default" style="width: 300px;">-->

        <!--<div class="col-md-12" >-->
        
        
            
        <!--</div>-->

        <!--<div class="col-md-6" hidden>-->

     
        
            <select class="bange btn-default btn-xs" style="border-width: 0; width:110px;"  onchange="tablaresultados(2)" id="categoria_prod"  <?php echo ($parametro["parametro_categoria"]!=1)?"hidden":"" ?>>
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

        
            <select class="bange btn-default btn-xs" style="border-width: 0; width:110px;"  onchange="tablaresultados(3)" id="subcategoria_prod"  <?php echo ($parametro["parametro_subcategoria"]!=1)?"hidden":"" ?>>
                    <option value="0" >- SUB CATEGORIAS -</option>

            </select>
        
        
            <select class="bange btn-default btn-xs" style="border-width: 0; width:110px;"  onchange="tablaresultados(4)" id="marca_producto"  <?php echo ($parametro["parametro_categoria"]!=1)?"hidden":"" ?>> 
                    <option value="0" >- MARCAS -</option>
                    <?php
                        foreach($marcas as $marca){ ?>

                            <option value="<?php echo $marca["marca_nombre"]; ?>" ><?php echo $marca["marca_nombre"]; ?></option>


                    <?php } ?>

            </select>
        

        
            <span class="badge btn-default" style="<?php echo ($parametro["parametro_categoria"]!=1)?"display:none":"" ?>">
                <input style="border-width: 0; color: black;" id="encontrados" type="text"  size="3" value="0" readonly="true"> 

            </span>

           <button class="btn btn-warning btn-xs" onclick="actualizar_marcas()" style="<?php echo ($parametro["parametro_botoninventario"]!=1)?"display:none":"" ?>"><span class="fa fa-recycle"></span> Marcas</button>
           <button class="btn btn-success btn-xs" onclick="actualizar_inventario()" style="<?php echo ($parametro["parametro_botoninventario"]!=1)?"display:none":"" ?>"><span class="fa fa-cubes"></span> Inventario</button>
           
            <?php if($rolusuario[185-1]['rolusuario_asignado'] == 1){ ?>
            <button type="button" id="boton_modal_promocion" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalpromocion" style="<?php echo ($parametro["parametro_promociones"]!=1)?"display:none":"" ?>" >
                <fa class="fa fa-cube"></fa> Promociones
            </button>
            <?php } ?>
           

           
            <?php if($parametro["parametro_categoriabotones"]==1){ ?>
           
                <input type="hidden" id="categoria_prod" value="<?php echo  $parametro['parametro_mostrarcategoria']; ?>">

                 <!--<div class="col-md-6">-->
                 <div class="btn-group" role="group" aria-label="Menu">
                     <?php 

                     foreach($categoria_producto as $categ){ 
                         $selected = ($categ['categoria_id'] == $parametro['parametro_mostrarcategoria']) ? ' selected="selected"' : "";
                         ?>

                     <button type="button" class="btn btn-<?= $parametro['parametro_colorbotoncategoria']; ?> btn-lg" style="padding-top:5px; padding-bottom: 5px; font-size: <?= $parametro['parametro_tamaniotextocategoria']."px"; ?>;" onclick="seleccionar_categoria(<?php echo $categ['categoria_id']; ?>)"><?php echo $categ['categoria_nombre']; ?></button>

                     <?php } ?>

                 </div>
                 
            <?php } ?>
            <!--</div>-->
      
            

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



<!--        </div>-->
    </div>

<!-------------------- FIN CATEGORIAS--------------------------------->
        
        <div class="box"  style="border-color: black;">
            <div class="box-body  table-responsive scrollable-div" id="tablaresultados" >

                <!------------------ aqui van los resultados de la busqueda --------------->
                
            </div>
               
        </div>


            </div> <!-------- FIN BOX-BODY---------->
            
        
        
        
            <!-------- INICIO BOX-BODY DOC SECTOR 24---------->
            <div class="box-body"  <?= ($dosificacion[0]['docsec_codigoclasificador']!=24)?"hidden":""; ?>>
                <div id="tabla_factura">
                    
                </div>
                
            </div> <!-------- FIN BOX-BODY---------->
            <!-------- FIN BOX-BODY DOC SECTOR 24---------->
            
            
            
            
            
            
            
        </div> <!-------- FIN BOX---------->
        
       <div class="col-md-12">
        
    <?php if ($parametro['parametro_factura']!=3){ ?>
        
        <div class="box" <?php echo ($parametro["parametro_productossinhomologar"]!=1)?"hidden":"" ?>>
            <font size="1"><b>PRODUCTOS SIN HOMOLOGAR</b></font>
        <div class="box" style="border-color:black;">
            <div class="box-body">        
        
       
        <div class="col-md-12" style="padding:0;" id="div_mensaje">
                 
        </div>
            
                <?php $estilo_tabla = "style='padding:0;'"; ?>
        <div class="col-md-12" style="padding:0; font-family: Arial;">
            <table id="mitabla">
                <tr <?php echo $estilo_tabla; ?>>
                    <th <?php echo $estilo_tabla; ?>>#</th>
                    <th <?php echo $estilo_tabla; ?>>DESCRIPCION</th>
                    <th <?php echo $estilo_tabla; ?>>CODIGO</th>
                    <th <?php echo $estilo_tabla; ?>>PRECIO</th>
                    <th <?php echo $estilo_tabla; ?>>UNID.</th>
                    <th <?php echo $estilo_tabla; ?>>COD.</th>
                    <th <?php echo $estilo_tabla; ?>>ESTADO</th>                    
                </tr>
                <?php $i = 0;
                    
                    foreach($productos_homologados as $ph){ ?>
                    <tr <?php echo $estilo_tabla; ?>>                    
                        <td <?php echo $estilo_tabla; ?>><?php echo ++$i; ?></td>
                        <td <?php echo $estilo_tabla; ?>><?php echo $ph["producto_nombre"]."<sub>[".$ph["producto_id"]."]</sub>"; ?></td>
                        <td <?php echo $estilo_tabla; ?>><?php echo $ph["producto_codigo"]; ?></td>
                        <td style="padding:0; text-align: right;"><?php echo number_format($ph["producto_precio"],2,".",","); ?></td>
                        <td <?php echo $estilo_tabla; ?>><center><?php echo $ph["producto_codigounidadsin"]; ?>
                            
                            <?php if(! $ph["producto_codigounidadsin"]>0){ ?>
                            <span class="btn btn-xs btn-danger" title="La unidad/codigo unidad, no fueron correctamente asignados..!!" ><fa class="fa fa-chain-broken"></fa></span>
                            <?php } ?>
                                
                           </center>
                        </td>
                        
                        <td <?php echo $estilo_tabla; ?>><center><?php echo $ph["producto_codigosin"]; ?>
                            
                            <?php if(! $ph["producto_codigosin"]>0){ ?>
                            <span class="btn btn-xs btn-danger" title="El codigo Producto SIN, no fue correctamente asignado..!!"><fa class="fa fa-chain-broken"></fa></span>
                            <?php } ?>
                           </center>
                        </td>
                        
                        <td <?php echo $estilo_tabla; ?>>
                            <center>
                                <a href="<?php echo base_url("producto/edit/".$ph["producto_id"]); ?>" class="btn btn-info btn-xs" target="_BLANK"><fa class="fa fa-pen"> </fa> Modificar</a>                            
                            </center>
                        </td>
                        
                    </tr>
                <?php } ?>
            </table>
            
        </div>    
        </div>
            
        </div>
        </div>
       
        <?php } ?>     
        
    </div>
        
    </div>
    
    
    <div class="col-md-<?php echo (12 - $parametro['parametro_anchobuscador']); ?>" id="divventas1" style="display:none;">
        <center>            
            <button class="btn btn-default" type="button" disabled style="background: grey; color: white;">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Procesando las facturas; por favor espere!..
            </button>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>">
        </center>
    </div>
    
    <div class="col-md-<?php echo (12 - $parametro['parametro_anchobuscador']); ?>" id="divventas0" style="display:block;">
        <font size="1"><b>DETALLE DE <?php echo strtoupper($sistema["sistema_moduloventas"]); ?> </b></font>
        <div class="box" style="border-color:black;">
            <div class="box-body">
        <div class="row">
            
            <div class="col-md-8" style="padding:5;">
            <!--------------------- parametro de buscador --------------------->
                <?php  if ($parametro["parametro_buscadordetalle"]==1){ ?>

                            <div class="input-group">
                              <span class="input-group-addon"  style="background-color: lightgray;">Buscar</span>
                              <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código">
                            </div>
                <?php } //fin ($parametro["parametro_buscadordetalle"]==1) ?>
            <center>
                
                
            <!--------------- botones ---------------------->
            <?php if($parametro["parametro_modulorestaurante"]==0){ //1 es normal ?>
                <?php if($rolusuario[13-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" data-target="#modalpedidos" class="btn btn-default btn-xs" onclick="pedidos_pendientes()" title="Pedidos Pendientes" style="<?php echo ($parametro["parametro_herramientassuperior"]!=1)?"display:none":"" ?>"><span class="fa fa-cubes"></span><b> Pedidos</b></a> 
            <a href="#" data-toggle="modal" data-target="#modalordenes" class="btn btn-default btn-xs" onclick="ordenes_pendientes()" title="Ordenes de Trabajo" style="<?php echo ($parametro["parametro_herramientassuperior"]!=1)?"display:none":"" ?>"><span class="fa fa-book"></span><b> OT's</b></a> 
                <?php }
                } ?>
                    
            <?php if($parametro["parametro_modulorestaurante"]==1){ //1 es modo restaurante?>            
                    <a href="<?php echo base_url('venta/ultimacomanda');?>" data-toggle="modal" target="_blank" class="btn btn-default btn-xs" id="imprimir_comanda" title="Comanda" style="<?php echo ($parametro["parametro_herramientassuperior"]!=1)?"display:none":"" ?>"><span class="fa fa-print"></span><b> Comanda</b></a> 
            <?php } ?>            
           
<!--            <button onclick='quitartodo()' class='btn btn-default btn-xs'><span class='fa fa-trash'></span><b> Vaciar</b></button> -->
            
      
            
            
            <?php            
            if($rolusuario[21-1]['rolusuario_asignado'] == 1){ ?>
            <a href="<?php echo base_url('venta/ultimorecibo');?>" data-toggle="modal" target="_blank" class="btn btn-default btn-xs"  id="imprimir"  style="<?php echo ($parametro["parametro_herramientassuperior"]!=1)?"display:none":"" ?>"><span class="fa fa-print" title="Imprimir nota de entrega"></span><b> Recibo</b></a> 
            
            <?php } 
            ?>
            
            <?php            
            if($rolusuario[17-1]['rolusuario_asignado'] == 1){
                $nomostrar = "";
                if($tipousuario_id != 1){
                    $nomostrar = "style='display: none'";
                }
                ?>
            <a href="<?php echo base_url('venta/ultimaventa/1');?>" <?php //echo $nomostrar; ?> data-toggle="modal" target="_blank" class="btn btn-default btn-xs" id="imprimir_factura" title="Imprimir factura"  style="<?php echo ($parametro["parametro_herramientassuperior"]!=1)?"display:none":"" ?>"><span class="fa fa-list-alt"></span><b> Factura</b></a> 
            <a href="<?php echo base_url('venta/ultimaventapdf');?>" data-toggle="modal" target="_blank" class="btn btn-default btn-xs" id="imprimir_factura" title="Imprimir factura en PDF"  style="<?php echo ($parametro["parametro_herramientassuperior"]!=1)?"display:none":"" ?>"><span class="fa fa-file-pdf"></span> <b>PDF</b></a>
            
            <?php } 
            ?>

            <?php if($rolusuario[14-1]['rolusuario_asignado'] == 1){ ?>
            <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-success btn-xs"  style="<?php echo ($parametro["parametro_herramientassuperior"]!=1)?"display:none":"" ?>"><span class="fa fa-cubes"></span><b> Finalizar</b></a> 
            <?php } ?>

            </center>
            
            <!--<a href="<?php echo base_url('venta/ultimaventa');?>" data-toggle="modal" target="_blank" class="btn btn-default btn-xs" id="imprimir"><span class="fa fa-print"></span><b> Plan de Pagos</b></a>--> 
            
            <!--------------- fin botones ---------------------->
            
            <!--------------------- fin parametro de buscador ---------------------> 
        
            </div>
            
            <div class="col-md-4" style="background-color: black; line-height: 15px;" <?php echo ($parametro["parametro_preciototal"]!=1)?"hidden":"" ?>>
                <center>
                    
                <font size="3" style="color:white;" face="Arial"><b>Total Final <?php echo $parametro['moneda_descripcion']; ?></b></font>
                
                <font size="6" style="color:white;" face="Arial"><b>
                    <input type="text" id="venta_subtotal" name="venta_subtotal" values="0.00" style="width: 180px; border-color: black; border-width: 0; background-color: black; text-align: center; padding:0;" readonly> </b>                
                </b></font>
    
                </center>

                
            </div>
        </div>
        
        <div class="box" style="border-color: black;">
           
            
            <div class="box-body table-condensed table-responsive">
                <div id="tablaproductos">
                    
                    <!--------------- RESULTADO TABLA DE PRODUCTOS---------------------------->
                    
                </div>
                
                <!-------------------- BOTONES INFERIORES ------------------------------------------->
                <div <?php echo ($parametro["parametro_herramientasinferior"]!=1)?"hidden":"" ?>>
                

                                    <?php 
                        if($rolusuario[15-1]['rolusuario_asignado'] == 1){ ?>
                        <button onclick='costo_cero()' class='btn btn-default btn-xs'><span class='fa fa-battery-0' title="Costo Cero"></span><b> - 0 -</b></button> 
                        <?php }
                        if($rolusuario[16-1]['rolusuario_asignado'] == 1){ ?>
                        <button onclick='precio_costo()' class='btn btn-default btn-xs'><span class='fa fa-money' title="Precio de costo"></span><b> Costo</b></button> 

                        <?php } ?>

                        <?php
                        if($rolusuario[184-1]['rolusuario_asignado'] == 1){ ?>

                        <a href="<?php echo base_url('venta/ultimagarantia');?>" data-toggle="modal" target="_blank" class="btn btn-default btn-xs"  id="garantias"><span class="fa fa-lock" title="Imprimir garantias"></span><b> Garantias</b></a>

                        <?php } ?>      

                        <!--<a href="<?php //echo base_url('venta/ultimagarantia');?>" data-toggle="modal" target="_blank" class="btn btn-default btn-xs"  style="background-color: purple"  id="garantias"><span class="fa fa-lock" title="Imprimir garantias"></span><b> Garantias</b></a>-->
                        <?php
                        if($rolusuario[17-1]['rolusuario_asignado'] == 1){
                            $nomostrar = "";
                            if($tipousuario_id != 1){
                                $nomostrar = "display: none";
                            }
                            ?>
                        <select   id="select_imprimir_factura" style="font-weight: bold; <?php echo $nomostrar?>" onclick="imprimir_factura()" class='btn btn-default btn-xs' title="Imprimir factura">
                            <option value="0">Imprimir</option>
                            <option value="1">Factura</option>
                            <option value="2">Copia</option>
                        </select>
                        <?php
                        }
                        if($parametro['parametro_tiposistema'] != 1){
                        ?>
                        <button onclick='solicitudCufd(<?php echo $puntoventa_codigo; ?>);' class='btn btn-default btn-xs'><span class='fa fa-download' title="Actualizar Codigo Unico de Facturacion Diaria CUFD"></span><b> CUFD</b></button> 
                        <button class="btn btn-default btn-xs" onclick="verificarComunicacion()"><fa class="fa fa-chain"></fa> Verificar Conexión</button>
                        <?php } ?>
                        
<!--                        <button onclick='finalizarventa();' class='btn btn-default btn-xs' id="pruebas"><span class='fa fa-download' title="Finalizar"></span><b> Finalizar <?php echo $sistema["sistema_moduloventas"]; ?></b></button> -->
                        <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalguardarventa"  title="Guardar terporalmente una venta"><span class='fa fa-floppy-o'></span><b> Guardar <?php echo $sistema["sistema_moduloventas"]; ?></b></button> 
                        <?php
                        $nomostrar = "";
                            if($tipousuario_id != 1){
                                $nomostrar = "display: none";
                            }
                            
//                        if(sizeof($dosificacion)>0 && $parametro['parametro_factura'] != 3){
//                        ?>
<!--                            <a class="btn btn-sq-lg btn-default btn-xs" href="//<?php echo site_url('factura'); ?>" style="padding-left: 2px; <?php echo $nomostrar; ?>">
                                <fa class="fa fa-times"> </fa>
                                Anular Factura
                            </a>-->
                        <?php   
//                        }
//                        ?>

            </div>
                <!-------------------- FIN BOTONES INFERIORES ------------------------------------------->
            </div>
          
        </div>
        
        <!----------------------------------- BOTONES ---------------------------------->

        <?php if(isset($ventas_guardadas)){ ?>
                        <font size="1"><b>VENTAS GUARDADAS</b></font>
                <div class="box" style="border-color:black;">
                    <div class="box-body">        

                <div class="col-md-12" style="padding:0;" id="div_ventas_guardadas">
                    <?php
                        foreach($ventas_guardadas as$vg){ ?>
                    
                            <button class="btn btn-warning btn-xs" onclick="cargar_venta('<?php echo $vg["codigo_venta"]; ?>')" title="<?php echo $vg["codigo_venta"]." ".$vg["nombre_venta"] ?>"><fa class="fa fa-cart-arrow-down"></fa> <?php echo "<br>".number_format($vg["totalbs"],2,".",",")."<br>"; ?></button>
                    
                    <?php } ?>

                </div>

        <?php } ?>
        
        
        <font size="1"><b>OPCIONES</b></font>
        <div class="box" style="border-color:black;">
            <div class="box-body">        
        
        <?php 
        $ancho_boton = 80; 
        $alto_boton = 120; 
        
        ?>
        <div class="col-md-12" style="padding:0;" id="div_mensaje">
            
            <?php $estilo_mensaje = "font-family: Arial; line-height: 10pt; display: none; border-color:black; background: white; color: Green;"; ?>
            <span id="mensaje_enviado" class="btn btn-default btn-block" style="<?php echo $estilo_mensaje; ?>"><b style="font-family: Arial; font-size: 18pt;" ><img src="<?php echo base_url("resources/images/enviado.gif"); ?>" width="150px" height="100px"> FACTURA ENVIADA</b> </span>
                            
            <?php $estilo_mensaje2 = "font-family: Arial; line-height: 10pt; display: none; border-color:black; background: white; color: Red;"; ?>
            <span id="mensaje_no_enviado" class="btn btn-default btn-block" style="<?php echo $estilo_mensaje2; ?>"><b style="font-family: Arial; font-size: 18pt;" ><img src="<?php echo base_url("resources/images/noenviado.gif"); ?>" width="100px" height="100px"> FACTURA NO ENVIADA</b><br><a href="<?php echo base_url("venta/rehacer_ultima_venta/"); ?>" type="button" class="btn btn-facebook" style='background-color: black;'><fa class="fa fa-recycle"></fa> Rehacer Factura</a><br><span id="mensaje_error" style="font-family: Arial; font-size: 9px;">Numero de identificacion tributaria invalido</span> </span>
            <br>

        </div>
            
        <div class="col-md-12" style="padding:0; font-family: Arial;">

            <center>
            <?php if($rolusuario[14-1]['rolusuario_asignado'] == 1){ ?>
<!--            <a href="#" data-toggle="modal" onclick="focus_efectivo(),mostrar('forma_pago','glosa_banco')" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;" id="boton_finaventa">
                <i class="fa fa-money fa-4x"></i><br><br>Finalizar Venta <br>
            </a>-->

            <button href="#" data-toggle="modal" onclick="focus_efectivo(),mostrar('forma_pago','glosa_banco')" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important; <?php echo ($parametro["parametro_finalizarventas"]!=1)?'display:none':'' ?>" id="boton_finventa">
                <i class="fa fa-money fa-4x"></i><br><br>Finalizar<br><?php echo $sistema["sistema_moduloventas"]; ?> <br>
            </button>
            <?php } ?>

            <?php if(isset($rolusuario[196-1]['rolusuario_asignado']) && $rolusuario[196-1]['rolusuario_asignado'] == 1){ ?>
                
<!--            <a href="#" data-toggle="modal" data-target="#modalinventario" class="btn btn-sq-lg btn-default" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;">
                <i class="fa fa-truck fa-4x"></i><br><br>
               Asignar <br>
            </a>-->
            <a href="#" data-toggle="modal" data-target="#modalinventario" class="btn btn-sq-lg btn-default" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important; <?php echo ($parametro["parametro_asignarinventario"]!=1)?"display:none":"" ?>">
                <i class="fa fa-truck fa-4x"></i>
                <br><br>Asigar<br>Inventario
            </a>

            <?php } ?>
            <?php //if(isset($rolusuario[196-1]['rolusuario_asignado']) && $rolusuario[196-1]['rolusuario_asignado'] == 1){ ?>
                <a href="<?php echo site_url('reportes/reportecaja'); ?>" class="btn btn-sq-lg btn-default" target="_blank" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;<?php echo ($parametro["parametro_resumenventas"]!=1)?"display:none":"" ?>">
                    <i class="fa fa-list-alt fa-4x"></i><br><br>
                   Resumen<br><?php echo $sistema["sistema_moduloventas"]; ?> <br>
                </a>
            <?php //} ?>
            <?php //if(isset($rolusuario[196-1]['rolusuario_asignado']) && $rolusuario[196-1]['rolusuario_asignado'] == 1){ ?>
                <a href="<?php echo site_url('admin/dashb'); ?>" class="btn btn-sq-lg btn-default" target="_blank" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;<?php echo ($parametro["parametro_cierrecaja"]!=1)?"display:none":"" ?>">
                <i class="fa fa-calculator fa-4x"></i><br><br>
               Cierre<br>de Caja <br>
            </a>
            <?php //} ?>                

            <a  href="<?php echo site_url('reportes/movimientodiario');?>" class="btn btn-sq-lg btn-default" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;<?php echo ($parametro["parametro_movimientodiario"]!=1)?"display:none":"" ?>">
                <i class="fa fa-file-text-o fa-4x"></i><br><br>
                Movimiento <br> Diario <br>
            </a>    

            <?php if($rolusuario[18-1]['rolusuario_asignado'] == 1){ ?>
            <a  href="<?php echo site_url('venta'); ?>" class="btn btn-sq-lg btn-danger" style="width: <?php echo $ancho_boton; ?>px !important; height: <?php echo $alto_boton; ?>px !important;<?php echo ($parametro["parametro_ventasdiarias"]!=1)?"display:none":"" ?>">
                <i class="fa fa-list-ul fa-4x"></i><br><br>
                <?php echo $sistema["sistema_moduloventas"]; ?> <br> del Dia <br>
            </a>    
            <?php } ?>    
                

            </center>
           
        </div>
                
        </div>    
        </div>    
                
                
        <!----------------------------------- fin Botones ---------------------------------->

        
            </div> <!-------- FIN BOX-BODY---------->
        </div> <!-------- FIN BOX---------->
        
    </div>
    
    
            
            <font face="Arial" size="1">
            <div class="col-md-6" <?php echo ($parametro["parametro_teclasacceso"]!=1)?"hidden":"" ?>>

                <b>TECLAS DE ACCESO DIRECTO</b>
                <div class="box" style="border-color:black;">
                    <div class="box-body">
                    <b>
                    </b>
                    <p>
                        <button class="btn btn-default btn-xs"><b>F2</b></button> Busqueda por código de barras <br>
                        <button class="btn btn-default btn-xs"><b>F4</b></button> Busqueda por parámetros<br>
                        <button class="btn btn-default btn-xs"><b>F5</b></button> Actualizar página<br>        
                        <button class="btn btn-default btn-xs"><b>F7</b></button> Registrar NIT<br>
                        <button class="btn btn-default btn-xs"><b>F8</b></button> Finalizar <?php echo $sistema["sistema_moduloventas"]; ?> <br>
                        <button class="btn btn-default btn-xs"><b>F9</b></button> Registrar Glosa <br>
                    </p>
                        <div >            
                            <button  onclick='simular_evento()' id="boton_simulador" class='btn btn-default btn-xs'><span class='fa fa-money' title="simular evento" ></span><b> Simulacion</b></button> 
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-6" <?php echo ($parametro["parametro_informacionbasica"]!=1)?"hidden":"" ?>>
                
                <b>INFORMACIÓN BASICA</b>
                <div class="box" style="border-color:black;">
                    <div class="box-body">



                    <?php if( $parametro['parametro_tiposistema']!= 1){ ?>


                    <!--<button class="btn btn-info btn-xs" style="text-align: Left; " >-->
                        <b>PUNTO DE VENTA:</b> <?php echo $puntoventa_codigo; ?>
                        <br><b>MONEDA:</b> <?php echo $parametro["moneda_descripcion"]; ?> / T.C. Bs: <?php echo number_format($parametro["moneda_tc"],2,".",","); ?>
                        <br><b>DOC:</b> <?php echo $dosificacion[0]['docsec_codigoclasificador']." - ".$dosificacion[0]["dosificacion_documentosector"]; ?>
                        <br><b>CUFD VIGENCIA:</b> <?php 

                            if (isset($cufd[0])){

                                $fecha = new DateTime($cufd[0]["cufd_fechavigencia"]); 
                                $fecha_d_m_a = $fecha->format('d/m/Y H:i:s');                                        
                                echo $fecha_d_m_a;

                        }else{ echo " NO EXISTE CUFD";} ?>
                    <!--</button>-->

                    <?php } ?>
                    </div>
                </div>
            </div>
            
        </font>
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
                                    
                                    <div class="col-md-2" style="padding: 0; display: none;" id="div_sucursales">
                                        <center>
                                            
                                        <h5 class="modal-title" id="myModalLabel"><b>SUCURSALES</b></h5>                                        
                
                                            <?php $mostrar_almacenes = true;
                                                if($mostrar_almacenes){?>

                                                <select class="btn btn-default btn-xs" id="select_almacen">
                                                    <?php   
                                                        foreach($almacenes as $almacen){ ?>

                                                                <option value="<?php echo $almacen["almacen_basedatos"]; ?>"><?php echo $almacen["almacen_nombre"] ?></option>

                                                        <?php } ?>

                                                </select>


                                            <?php } ?>
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
                                        <span>
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
                                        
                                    </span>
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
                <input type="time" id="hora_cafc" class="btn btn-default btn-xs" style="width: 120px;" value="<?= "00:00"; ?>"/>
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
            
            <!-- =====================================================-->
            <!-- METODO PARA GENERAR VARIAS FACTURAS PREVALORADA EN LINEA/FACTURAS EN MASA PARA CERTIFICAR ->
            <!-- =====================================================-->
            
            <?php 
                $prev_ocultar = "";
                $prev_mostrar = "none";
                if( $dosificacion[0]["docsec_codigoclasificador"] == 23){ //23 prevalorada (original)
                    $prev_ocultar = "none";
                    $prev_mostrar = "";
                }
            ?> 
            
            <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" style="max-width: 7cm">
                
                <tr>
                        <td  style="padding: 0" >Total <?php echo $parametro['moneda_descripcion']; ?></td>
                        <td align="right">
                            <input class="btn btn-default btn-foursquarexs" style="padding: 0; background-color: black; font-size: 20px; color:white;" id="venta_total" size="<?php echo $ancho_boton; ?>"  name="venta_total" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                        </td>
                    
                    
                </tr>   
                
                <tr style="padding: 0">
                        <td style="padding: 0">Descuento <?php echo $parametro['moneda_descripcion']; ?></td>
                        <td align="right" style="padding: 0">
                            <input class="btn btn-foursquarexs" style="padding: 0" id="venta_descuentoparc" size="<?php echo $ancho_boton; ?>"  name="venta_descuentoparc" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                        </td>
                    
                </tr>
                <tr style="padding: 0; display: <?php echo $prev_ocultar; ?>">
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
                <tr style="padding: 0; display: <?php echo $prev_ocultar; ?>">                      
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

                <?php 
                    $ocultar = "none";
                    if($dosificacion[0]['docsec_codigoclasificador']!=2 && $dosificacion[0]['docsec_codigoclasificador']!=39 && 
                       $dosificacion[0]['docsec_codigoclasificador']!=12 && 
                       $dosificacion[0]['docsec_codigoclasificador']!=51)
                             { $ocultar = "contents"; }?>
                
                <tr style="padding: 0; display: <?php echo $ocultar; ?>">
                        <td style="padding: 0"><b>Tarjeta/Gift/Otros</b></td>
                        <td align="right" style="padding: 0">
                            <input class="btn" style="padding:0; background-color:orange; font-size:20px;" id="venta_giftcard" size="<?php echo $ancho_boton; ?>" name="venta_giftcard" value="<?php echo 0.00; ?>"  onKeyUp="calcularcambio(event)"  onclick="seleccionar(6)">
                        </td>
                </tr>
       
                
                <tr style="padding: 0">                      
                        <td style="padding: 0">Efectivo <?php echo $parametro['moneda_descripcion']; ?></td>
                        <td align="right" style="padding: 0">
                            <input class="btn" style="padding:0; background-color:yellow; font-size:20px;" id="venta_efectivo" size="<?php echo $ancho_boton; ?>" name="venta_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularcambio(event)"  onclick="seleccionar(5)" autocomplete="off">
                        </td>
                </tr>
                
                <tr style="padding: 0">                      
                    <td style="padding: 0"><b>Cambio <?php echo $parametro['moneda_descripcion']; ?></b></td>
                        <td align="right" style="padding: 0;">
                            <input class="btn btn-default  btn-foursquarexs" style="padding: 0; background-color: black; font-size: 20px;  color:white;"  id="venta_cambio" size="<?php echo $ancho_boton; ?>" name="venta_cambio" value="<?php echo number_format($cambio,2,'.',','); ?>" readonly="true" required min="0">
                        </td>
                </tr>
                <tr style="padding: 0; display: <?php echo $prev_mostrar; ?>">                      
                    <td style="padding: 0"><b>Cantidad de Facturas</b></td>
                        <td align="right" style="padding: 0;">
                            <input class="btn btn-default  btn-foursquarexs" style="padding: 0; background-color: #e08e0b; font-size: 20px;"  id="cantidad_facturas" size="<?php echo $ancho_boton; ?>" name="cantidad_facturas" value="1" required min="0" onclick="this.select();">
                        </td>
                </tr>
                
                
            </table>
            
            

          
            <div class="col-md-12">
                <input type="checkbox" style="padding: 0;" id="mandar_enuno" value="1" name="mandar_enuno" checked disabled >
                
               <?php if ($dosificacion[0]['docsec_codigoclasificador']==2){ ?>
                    <b>PERIODO:</b>
               <?php }else{ ?>
                    <b>NOTA:</b>
               <?php }?>
                
                <input type="text" style="padding: 0; font-size: 10pt;" id="venta_glosa" name="venta_glosa" value="" class="form-control  input-sm" onKeyUp="this.value = this.value.toUpperCase();">           
                
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
                        <?php for($i=1;$i<=120;$i++){ ?>
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
                    <h5 class="modal-title" id="myModalLabel"><b>INTERES (%)</b></h5>
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
                 
                
            <!--<button class="btn btn-lg btn-default btn-block" type="submit">Login</button>-->   
            
<!--            <button class="btn btn-lg btn-default btn-sm btn-block" onclick="finalizarventa()">
                <h4>
                <span class="fa fa-money"></span>   Finalizar Venta  
                </h4>
            </button>
            -->
            <!--<button class="btn btn-lg btn-default btn-sm btn-block" id="boton_finalizar" data-dismiss="modal" onclick="finalizarventa()" style="display: block;">-->
            <button class="btn btn-lg btn-success btn-sm btn-block" id="boton_finalizar" data-dismiss="modal" onclick="finalizarventa_sin()" style="display: block;">
                <h4>
                <span class="fa fa-save"></span>   Finalizar <?php echo $sistema["sistema_moduloventas"]; ?>   
                </h4>
            </button>

            <button class="btn btn-lg btn-danger btn-sm btn-block" data-dismiss="modal" id="cancelar_venta">
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
                                    <th></th>
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

<!-- <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

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
                    <div class="modal-header"  style="background-color: lightgray;" >
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>ASIGNAR INVENTARIO</b></h4>
                            </center>

                                
                    </div>
                                <b>ADVERTENCIA: El inventario actual, remplazara algun inventario asignado previamente.</b>                                
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
                                                        
                                                        <button class="btn btn-success" id="boton_asignar" onclick="asignar_inventario()"> <span class="fa fa-truck"></span> Asignar</button>

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
                                                //foreach($preferencia as $p)
                                                //{?>
                                                    <!--<button class="btn btn-xs btn-default" id="pref<?php echo $p["preferencia_id"]; ?>" name="<?php echo $p["preferencia_descripcion"]; ?>" style="background-color: #db0ead" onclick="agregar_preferencia(<?php echo $p["preferencia_id"]; ?>)"><i class="fa fa-cube"></i><?php echo $p["preferencia_descripcion"]; ?></button>-->
                                                    <!--<br>-->
                                                <?php //} 
                                                ?>
                                            </div>
                                            <input type="text" id="inputcaract" value="" class="form-control btn btn-xs btn-default" onKeyUp="this.value = this.value.toUpperCase();">
					</div>
                                        <div class="col-md-6" id='botones'  style='display:block;'>
						<label for="opciones" class="control-label">Opciones</label>
						<div class="form-group">
                                                        
                                                    <button class="btn btn-default" id="boton_asignar" onclick="guardar_preferencia()" data-dismiss="modal" >
                                                            <span class="fa fa-floppy-o"></span> Guadar
                                                    </button>
                                                    
                                                    <button class="btn btn-default" id="cancelar_preferencia" onclick="cancelar_preferencia()" data-dismiss="modal" >
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
    
<button type="button" id="boton_modal_ingreso" class="btn btn-default" data-toggle="modal" data-target="#modalingreso" >
  Launch demo modal
</button>
</div>
<!----------------- modal preferencias ---------------------------------------------->

<div class="modal fade" id="modalingreso" tabindex="-1" role="dialog" aria-labelledby="modalingreso" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: gray; color: white; ">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><fa class="fa fa-"></fa> <b>INGRESO RAPIDO</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                            </center>
                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive">
                            <input type="text" id="ingresorapido_producto" style="font-size: 12px;" value="-" class="form-control btn btn-xs btn-default" readonly>
                                        <div class="col-md-6">
                                            <label for="usuario_idx" class="control-label">Cantidad:</label>
                                            
                                            <input type="text" id="ingresorapido_producto_id" value="0.00" hidden />
                                            <input type="text" style="font-size: 14px;" id="ingresorapido_cantidad" value="0.00" class="form-control btn btn-xs btn-default" onkeyup="validar(event,11)" />
					</div>
                                        <div class="col-md-6" id='botones'  style='display:block;'>
						<label for="opciones" class="control-label">Opciones</label>
						<div class="form-group">
                                                        
                                                    <button class="btn btn-success" id="boton_ingreso_rapido" onclick="guardar_ingreso_rapido()" data-dismiss="modal" >
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

<!----------------- Inicio registrar precio de venta ---------------------------------------------->
<div hidden>
    
<button type="button" id="boton_modal_actualizarprecio" class="btn btn-default" data-toggle="modal" data-target="#modal_actualizarprecio" >
  Launch demo modal
</button>
</div>
<!----------------- Actualizar precio de venta ---------------------------------------------->

<div class="modal fade" id="modal_actualizarprecio" tabindex="-1" role="dialog" aria-labelledby="modalactualizaprecio" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>ACTUALIZAR PRECIOS</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                            </center>
                            
                    </div>
                    <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        
                        <div class="box-body table-responsive">
                            
       
                                            
                                        <input type="text" id="modificarprecios_producto" value="nombre producto" class="form-control btn btn-xs btn-default" readonly>
                                        
                                        <div class="col-md-3">
                                            <label for="usuario_idx" class="control-label">Precio Costo:</label>
                                            
                                            <input type="text" id="modificarprecios_producto_id" value="0.00" hidden />
                                                <input type="text" id="modificarprecios_producto_costo" value="0.00" class="form-control btn btn-xs btn-default" onkeyup="validar(event,11)"  style="font-size: 10pt;"/>
					</div>
                            
                                        <div class="col-md-3">
                                            <label for="usuario_idx" class="control-label">Precio <?php echo $sistema["sistema_moduloventas"]; ?> :</label>                                            
                                            <input type="text" id="modificarprecios_producto_precio" value="0.00" class="form-control btn btn-xs btn-default" onkeyup="validar(event,11)"  style="font-size: 10pt;"/>
					</div>
                            
                                        <div class="col-md-6" id='botones'  style='display:block;'>
						<label for="opciones" class="control-label">Opciones</label>
						<div class="form-group">
                                                        
                                                    <button class="btn btn-success" id="boton_actualizar_precio" onclick="actualizar_precio()" data-dismiss="modal" >
                                                            <span class="fa fa-floppy-o"></span> Registrar
                                                    </button>
                                                    
                                                    <button class="btn btn-danger" id="boton_cancelar_precio" data-dismiss="modal" >
                                                        <span class="fa fa-close"></span>   Cancelar                                                          
                                                    </button>
						</div>
					</div>
                                        
                                        <div class="col-md-12">
                                             <input  type="checkbox"  id="actualizarpreciossucursales" name="actualizarpreciossucursales" value="1" checked="true" checked>Actualizar precios de las sucursales 
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


<!----------------- fin modal precio de venta---------------------------------------------->


<!----------------- modal promociones ---------------------------------------------->

<div class="modal fade" id="modalpromocion" tabindex="-1" role="dialog" aria-labelledby="modalpromocion" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
                    <div class="modal-header" style="background-color: lightgray;" >
                            
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


    <button data-toggle="modal" class="btn btn-sq-lg btn-default" style="width: <?php echo $ancho_botonx; ?>px !important; height: <?php echo $alto_botonx; ?>px !important;" title=" <?php echo $prom["promocion_titulo"]; ?>" onclick="ingresar_promocion(<?php echo $prom["promocion_id"]; ?>)">
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
                                                        <button class="btn btn-default btn-sm" id="boton_registrar_clasificacion" onclick="registrar_clasificador()" data-dismiss="modal"> <fa class="fa fa-floppy-o"></fa> </button>
                                                    </td>

                                                
                                                </tr>
                                            </table>
                                        </div>
                                            
                                        <div class="col-md-12">
                                            

                                            <button class="btn btn-default btn-xs" id="cancelar_preferencia" data-dismiss="modal" >
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
                    <fa class="btn btn-default fa fa-exclamation-triangle fa-2x"> </fa><b><span id="mensajeadvertencia"></span></b>
                </h2>
            </label>
        </div>  
          
        <div class="col-md-4">
            <!--<button class="btn btn-default btn-block" onclick="codigo_excepcion()"><fa class="fa fa-arrow-right"></fa> Continuar</button>-->
            <button class="btn btn-success btn-block" data-dismiss="modal" onclick="excepcion_nit()" id="boton_advertencia" style="line-height: 10px;"><fa class="fa fa-save"></fa> <b>FORZAR FACTURA</b><br><small>CON COD. DE EXCEPCIÓN</small></button>
            <button class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelar_excepcion_nit()"  style="line-height: 10px;"><fa class="fa fa-times"></fa> <b>CORREGIR NIT</b><br><small>CAMBIAR TIPO DOC.</small></button>
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
            <div class="modal-header text-center" style="background-color: lightgrey;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">CAMBIAR TIPO DE EMISION DE FACTURA</span>
            </div>
            
            <div class="row" id='loader_emision' style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
                </center>
            </div> 
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-7">
                    
                    
                        <span>
                            <div class="col-md-12">
                                <label for="elparametro_tipoemision" class="control-label">Tipo de Emisión</label>
                                <div class="form-group">
                                    <select name="elparametro_tipoemision" class="form-control" id="elparametro_tipoemision" required>
                                        <option value="1" <?php if($parametro['parametro_tipoemision']=="1"){ ?> selected <?php } ?>>EN LINEA</option>
                                        <option value="2" <?php if($parametro['parametro_tipoemision']=="2"){ ?> selected <?php } ?>>FUERA DE LINEA</option>
                                        <option value="3" <?php if($parametro['parametro_tipoemision']=="3"){ ?> selected <?php } ?>>MASIVA</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
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
                    <div class="col-md-5">
                            <font size="1">OPCIONES</font>
                            <div class="box" style="border-color: black;">
                                <div class="box-body">
                                    <font size="1">
                                        <br><input type="checkbox" checked="1" id="opcion1"> Generar un nuevo CUFD para el envio
                                        <br><input type="checkbox" checked="1" id="opcion2"> Actualizar el registro del evento
                                        <br><input type="checkbox" checked="1" id="opcion3"> Generar el paquete (archivo .TAR.GZ)
                                        <br><input type="checkbox" checked="1" id="opcion4"> Enviar el paquete
                                        <br><input type="checkbox" checked="1" id="opcion5"> Actualizar las facturas no enviadas
                                    </font>

                                </div>
                            </div>
                    </div>
                    
                </div>
                
                
            </div>
            <div class="modal-footer" style="text-align: center">
                <button class="btn btn-success" onclick="cambiar_tipoemision()" id="boton_tipoemision"><span class="fa fa-check"></span> Cambiar</button>
                <a class="btn btn-default" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para cambiar el tipo de emision de facturas ------------------->




<!------------------------ envio de paquete de facturas ------------------->
<div hidden>
    <button type="button" id="boton_modal_paquetes" class="btn btn-default" data-toggle="modal" data-target="#modal_enviopaquetes" >
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
                <a class="btn btn-default" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
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

<!--<button class="btn btn-default btn-xs" onclick="verificar_conexion()"><fa class="fa fa-cloud"></fa> Verificar Conexion</button>-->


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
     
    function imprimir(){
        
     var ComandoExe;
        ComandoExe= new ActiveXObject("WScript.Shell");
        ComandoExe.Run('c:\impresor\impresora.exe') 
    }
   
//alert("No dispone del programa necesario para la acción")}
</script>


<!------------------------------------------------------------------------------->
<!----------------------- EMISION DE PAQUETES ----------------------------------->
<!------------------------------------------------------------------------------->
<div hidden>
    <button type="button" id="boton_modalpaquetes" class="btn btn-default" data-toggle="modal" data-target="#modalpaquetes" >
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
                <div class="row" id="loader3" style="display:none; text-align: center">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    <label for="codigo_evento" class="control-label"><span class="text-danger">*</span>Código Evento</label>  
                    <!--<select name="codigo_evento" class="form-control" id="codigo_evento" onchange="preparar_parametros()">-->
                    <select name="codigo_evento" class="form-control" id="codigo_evento">
                        <option value="0">- SELECCIONAR EVENTO -</option>
                        <?php 
                            foreach($eventos as $evento){ ?>
                                <option value="<?php echo $evento['registroeventos_codigo']; ?>">    
                                    <?php echo $evento['registroeventos_codigo']." [".$evento['registroeventos_puntodeventa']."] ".$evento['registroeventos_detalle']." ".$evento['registroeventos_inicio']; ?>
                                </option>
                        <?php    } ?>
                            
                    </select>
                </div>
                <br>
                <br>
                <!--<div class="col-md-12">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Nombre Archivo</label>
                    <div class="form-group">
                        <input type="text" name="nombre_archivo" value="compra_venta00.tar.gz" class="form-control" id="nombre_archivo" />
                    </div>
                </div>-->
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="envio_paquetes()"><fa class="fa fa-floppy-o"></fa> Enviar Paquete</button>
                <button type="button" class="btn btn-default" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>


<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL CANTIDAD ----------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_modalcantidad" class="btn btn-default" data-toggle="modal" data-target="#modalcantidad" >
      CANTIDAD PRODUCTOS
    </button>
    
</div>

<div class="modal fade" id="modalcantidad" tabindex="-1" role="dialog" aria-labelledby="modalcantidad" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">CANTIDAD DE PRODUCTOS</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="loader3" style="display:none; text-align: center">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12" style="line-height: 8px;">
                    <label for="codigo_evento" class="control-label" id="producto_id">1</label><br>
                    <label for="codigo_evento" class="control-label" id="producto_nombre">HUB/SWICH TP-LINK 8-PUERTOS & 10/100 MBPS TL-SF1008D</label><br>
                    <label for="codigo_evento" class="control-label" id="producto_datos" style="font-size: 10px;">23434/TP-LINK/PIEZA/4654646546</label>  
                    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>
                    
                </div>
                <br>
                <br>

            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="envio_paquetes()"><fa class="fa fa-floppy-o"></fa> Enviar Paquete</button>
                <button type="button" class="btn btn-default" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL CANTIDAD ----------------------------------->
<!------------------------------------------------------------------------------->


<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL DATOS FACTURA ----------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_modalcantidad" class="btn btn-default" data-toggle="modal" data-target="#modaldatosservicios" >
      CANTIDAD PRODUCTOS
    </button>
    
</div>

<div class="modal fade" id="modaldatosservicios" tabindex="-1" role="dialog" aria-labelledby="modaldatosservicios" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">DATOS SERVICIOS</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="loader3" style="display:none; text-align: center">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                
                <div class="col-md-12" style="line-height: 8px;">
                    
					<div class="col-md-6">
						<label for="datos_consumoperiodo" class="control-label">Consumo</label>
						<div class="form-group">
							<input type="text" name="datos_consumoperiodo" value="<?php echo ""; ?>" class="form-control" id="datos_consumoperiodo" />
						</div>
					</div>
                    
					<div class="col-md-6">
						<label for="datos_beneficiario1886" class="control-label">Beneficiario1886</label>
						<div class="form-group">
							<input type="text" name="datosbeneficiario1886" value="<?php echo ""; ?>" class="form-control" id="datos_beneficiario1886" />
						</div>
					</div>        
                    
					<div class="col-md-3">
						<label for="datos_periodofacturado" class="control-label">Periodo</label>
						<div class="form-group">
							<input type="text" name="datos_mes" value="<?php echo ""; ?>" class="form-control" id="datos_mes" />
						</div>
					</div>
                    
					<div class="col-md-3">
						<label for="datos_periodofacturado" class="control-label">Año</label>
						<div class="form-group">
							<input type="text" name="datos_anio" value="<?php echo ""; ?>" class="form-control" id="datos_anio" />
						</div>
					</div>
                    
					<div class="col-md-6">
						<label for="datos_medidor" class="control-label">Datos Medidor</label>
						<div class="form-group">
							<input type="text" name="datos_medidor" value="<?php echo ""; ?>" class="form-control" id="datos_medidor" />
						</div>
					</div>
                    
					<div class="col-md-9">
						<label for="datos_ajustesujetosiva" class="control-label">Ajuste sujeto a iva</label>
						<div class="form-group">
							<!--<input type="memo" name="datos_ajustesujetosiva" value="<?php echo ""; ?>" class="form-control" id="datos_ajustesujetosiva" />-->
                                                    <textarea name="datos_ajustesujetosiva" class="form-control" id="datos_ajustesujetosiva" >
Ajustes sujetos a IVA
Cobro por reconexion 10.00</textarea>
						</div>
					</div>                   
                    
					<div class="col-md-3">
						<label for="datos_sujetoivasubtotal" class="control-label">Sub total Bs</label>
						<div class="form-group">
                                                    
							<input type="text" name="datos_sujetoivasubtotal" value="<?php echo "0.00"; ?>" class="form-control" id="datos_sujetoivasubtotal" />
						</div>
					</div>                    

					<div class="col-md-9">
						<label for="datos_aseourbano" class="control-label">Tasa aseo urbano</label>
						<div class="form-group">
							<textarea name="datos_aseourbano" class="form-control" id="datos_aseourbano" >Tasa Aseo Urbano </textarea>
						</div>
					</div>                   
                    
					<div class="col-md-3">
						<label for="datos_aseosubtotal" class="control-label">Sub total Bs</label>
						<div class="form-group">
							<input type="text" name="datos_aseosubtotal" value="<?php echo "0.00"; ?>" class="form-control" id="datos_aseosubtotal" />
						</div>
					</div>            
                    
					<div class="col-md-9">
						<label for="datos_tasaalumbrado" class="control-label">Tasa alumbrado publico</label>
						<div class="form-group">
                                                    <textarea type="text" name="datos_tasaalumbrado" class="form-control" id="datos_tasaalumbrado">Tasa de aseo</textarea>
						</div>
					</div>                   
                    
					<div class="col-md-3">
						<label for="datos_alumbradosubtotal" class="control-label">Sub total Bs</label>
						<div class="form-group">
							<input type="text" name="datos_alumbradosubtotal" value="<?php echo "0.00"; ?>" class="form-control" id="datos_alumbradosubtotal" />
						</div>
					</div>                    
                    
					<div class="col-md-9">                                                                                              
						<label for="datos_otrastasas" class="control-label">Otras tasas</label>
						<div class="form-group">
                                                    <textarea name="datos_otrastasas" class="form-control" id="datos_otrastasas">Oras tasas</textarea>
						</div>
					</div>                   
                    
					<div class="col-md-3">
						<label for="datos_tasassubtotal" class="control-label">Sub total Bs</label>
						<div class="form-group">
							<input type="text" name="datos_tasassubtotal" value="<?php echo "0.00"; ?>" class="form-control" id="datos_tasassubtotal" />
						</div>
					</div>                      
                    
                                        <div class="col-md-9">
						<label for="datos_otrospagos" class="control-label">Otros pagos</label>
						<div class="form-group">
                                                    <textarea name="datos_otrospagos" class="form-control" id="datos_otrospagos">
Otros Pagos (pago de cuotas etc)
Pago cuota coperativa 7.00</textarea>

						</div>
					</div>                   
                    
					<div class="col-md-3">
						<label for="datos_pagossubtotal" class="control-label">Sub total Bs</label>
						<div class="form-group">
							<input type="text" name="datos_pagossubtotal" value="<?php echo "0.00"; ?>" class="form-control" id="datos_pagossubtotal" />
						</div>
					</div>  
		                    
                </div>
                <br>
                <br>

            </div>
            
            <div class="modal-footer" style="text-align: center">
                <!--<button type="button" class="btn btn-success" onclick="envio_paquetes()"><fa class="fa fa-floppy-o"></fa> Enviar Paquete</button>-->
                <button type="button" class="btn btn-default" id="boton_cerrar_recepcion" data-dismiss="modal" ><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL DATOS FACTURA ----------------------------------->
<!------------------------------------------------------------------------------->


<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL BUSCAR FACTURA ----------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_buscarfactura" class="btn btn-default" data-toggle="modal" data-target="#modalbuscarfactura" >
      CANTIDAD PRODUCTOS
    </button>
    
</div>

<div class="modal fade" id="modalbuscarfactura" tabindex="-1" role="dialog" aria-labelledby="modalbuscarfactura" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">BUSCAR FACTURA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                            <!--<h4 class="modal-title" id="myModalLabel"><b>PEDIDOS/PREVENTAS</b></h4>-->
                                
                            <div class="input-group"> <span class="input-group-addon">Buscar</span>
                                <input id="parametro_facturabuscar" type="text" class="form-control" placeholder="Ingresa la razón social o número de factura" onkeypress="buscar_factura(event)" onKeyUp="this.value = this.value.toUpperCase();">
                            </div>
                                
			</div>
			<div class="modal-body table-responsive">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                            <table class="table table-striped table-condensed" id="mitabla">
                                <tr>
                                    <th>#</th>
                                    <th>NIT</th>
                                    <th>RAZON SOC.</th>
                                    <th align="center">FECHA FAC.</th>
                                    <th>NRO FACT.</th>
                                    <th>TOTAL</th>
                                    <th>CUF</th>
                                    <th></th>
                                </tr>

                                <tbody class="buscar3" id="facturas_encontradas">




                                </tbody>
                            </table>
             
                        </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
        
        
<!--        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">BUSCAR FACTURA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="loader3" style="display:none; text-align: center">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12" style="line-height: 8px;">
                    <label for="codigo_evento" class="control-label" id="producto_id">1</label><br>
                    <label for="codigo_evento" class="control-label" id="producto_nombre">HUB/SWICH TP-LINK 8-PUERTOS & 10/100 MBPS TL-SF1008D</label><br>
                    <label for="codigo_evento" class="control-label" id="producto_datos" style="font-size: 10px;">23434/TP-LINK/PIEZA/4654646546</label>  
                    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>
                    
                </div>
                <br>
                <br>

            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="envio_paquetes()"><fa class="fa fa-floppy-o"></fa> Enviar Paquete</button>
                <button type="button" class="btn btn-default" id="boton_cerrar_recepcion" data-dismiss="modal" onclick="location.reload();"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>-->
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL BUSCAR FACTURA ----------------------------------->
<!------------------------------------------------------------------------------->

<!--<script type="text/javascript">
     $("#span_buscar_cliente").click();                    
</script>

<input type='text' id='input1'>
<script>
    // Espera a que el documento esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén el primer input y el segundo input por su identificador
        var input1 = document.getElementById("input1");
        var input2 = document.getElementById("input2");

        // Agrega un evento de escucha al primer input para capturar cambios
        input1.addEventListener("input", function() {
            // Copia el valor del primer input al segundo input
            input2.value = input1.value;
            
        });
    });
</script>-->
<!--
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

<script>
$(document).ready(function() {
    
    $('#razon_social').on('input', function() {
        var dato = $(this).val(); // 'NIT: '+$('#nit').val()+', RAZON SOC.: '+$(this).val();

        $.ajax({
            url: '<?= base_url("venta/guardarDatoCliente"); ?>',
            type: 'POST',
            data: { dato: dato },
            success: function() {
                console.log('Dato guardado en sesión');
            },
            error: function() {
                console.log('Error al guardar el dato en sesión');
            }
        });
    });
});
</script>



<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL GUARDAR VENTA ----------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_guardarventa" class="btn btn-default" data-toggle="modal" data-target="#modalguardarventa" >
      GUARDAR VENTA
    </button>
    
</div>

<div class="modal fade" id="modalguardarventa" tabindex="-1" role="dialog" aria-labelledby="modalguardarventa" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">GUARDAR VENTA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-content">
			<div class="modal-header">
                            

                            <!--<h4 class="modal-title" id="myModalLabel"><b>PEDIDOS/PREVENTAS</b></h4>-->
                                
                            <div class="input-group"> <span class="input-group-addon">Nombre</span>
                                <input id="nombre_venta" type="text" class="form-control" placeholder="Nombre, para guardar la venta temporal" onKeyUp="this.value = this.value.toUpperCase();">
                            </div>
                                
			</div>

                        <div class="box-body table-responsive">
                                <center style="font-size: 16px; font-weight: bold;">
                                    <fa class="fa fa-cart-arrow-down"></fa> 
                                    ADVERTENCIA                                
                                    <fa class="fa fa-clock-o"></fa> 
                                </center>
                                <br>
                                <center>
                                Esta a punto de guardar la venta actual de forma temporal.
                                <br>¿Desea continuar?
                                </center>
             
                        </div>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-success"  data-dismiss="modal"  onclick="guardar_venta_temporal()"><fa class="fa fa-floppy-o"></fa> Guardar Venta</button>
                            <button type="button" class="btn btn-default" id="boton_cerrar_ventatemporal" data-dismiss="modal""><fa class="fa fa-times"></fa> Cerrar</button>
                        </div>
            
		</div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL GUARDAR VENTA ----------------------------------->
<!------------------------------------------------------------------------------->


<!------------------------------------------------------------------------------->
<!----------------------- INICIO MODAL ACTUALIZAR PRODUCTOS ----------------------------------->
<!------------------------------------------------------------------------------->


<div hidden>
    <button type="button" id="boton_guardarventa" class="btn btn-default" data-toggle="modal" data-target="#modalsucursales" >
      Generar Codigos
    </button>
    
</div>

<div class="modal fade" id="modalsucursales" tabindex="-1" role="dialog" aria-labelledby="modalsucursales" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">SUCURSALES: ACTUALIZAR LISTAS DE PRODUCTOS</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-content" style="font-family: Arial">

                        <div class="box-body">
                            
                                        <input class="form-control" type="hidden" value="0" id="miproducto_id" name="miproducto_id" onchange="verificar_producto()" ><!-- producto_id -->
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                   <input id="miproducto_nombre" class="form-control" style="border: none; font-size: 16px; text-align: center; font-weight: bold;">
                                                </div>
                                        </div>
<!--                            <div class="row">
                                
                                

                                        
                                
                                        <div class="col-md-5">
                                                <label for="sucursal_objetivo" class="control-label">SUCURSAL OBJETIVO</label>
                                                <div class="form-group">
                                                    <select class="form-control" id="sucursal_traspaso" name="sucursal_traspaso">
                                                            
                                                        <option value="0">- TODOS -</option>
                                                    <?php 
                                                        foreach($almacenes as $almacen){?>
                                                            
                                                            <option value="<?php echo $almacen["almacen_id"]; ?>"><?php echo $almacen["almacen_nombre"]; ?></option>
                                                        
                                                    <?php } ?>
                                                        

                                                    </select>
                                                </div>
                                        </div>

                                
                                        <div class="col-md-5">
                                                <label for="codigo_columnas" class="control-label">OPERACIÓN</label>
                                                <div class="form-group">
                                                    <select class="form-control" id="operacion_traspaso">
                                                        <option value="1">VERIFICAR PRODUCTO</option>
                                                        <option value="2">REGISTRAR PRODUCTO</option>
                                                        <option value="3">ACTUALIZAR DATOS DEL PRODUCTO</option>
                                                        <option value="4">COMPARAR LISTA DE PRODUCTOS</option>
                                                    </select>
                                                </div>
                                        </div>

                                        <div class="col-md-1">
                                                <label for="codigo_columnas" class="control-label"></label>
                                                <button type="button" class="btn btn-info"  onclick="remplazar_productos()" id="boton_proceder"><fa class="fa fa-cubes"></fa><br>Actualizar</button>
                                                
                                        </div>
                                
                            </div>-->
                            <div class="row col-md-12" id='loader2'  style='display:none; text-align: center'>
                               <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                           </div>
                            <div id="tabla_resultadossuc">
                            </div>
             
                           
                        </div>

                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-success"  onclick="verificar_producto()" id="boton_proceder"><fa class="fa fa-chain"></fa> Actualizar</button>
                            <button type="button" class="btn btn-danger" id="boton_cerrar_ventatemporal" data-dismiss="modal""><fa class="fa fa-times"></fa> Cerrar</button>
                        </div>
            
		</div>
    </div>
</div>

<!------------------------------------------------------------------------------->
<!----------------------- FIN MODAL GUARDAR VENTA ----------------------------------->
<!------------------------------------------------------------------------------->





<?php
//$archivoExe = 'C:\siaac\siaac.exe';
//$output = '';
//$returnValue = '';
//
//exec($archivoExe, $output, $returnValue);
//
//if ($returnValue === 0) {
//    echo "El archivo se ejecutó correctamente.";
//} else {
//    echo "Se produjo un error al ejecutar el archivo.";
//}
?>