</script>
<style type="text/css">

    table{

        td{
            border:hidden;
            padding: 0px;
        }
    }
</style>

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="box-header">
    <font size='4' face='Arial'><b>Parametros</b></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('parametro/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Parametro</a> 
    </div>
</div>
<?php
foreach($all_parametros as $p)
{
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <font size='4' face='Arial'><b>Perfil <?php echo $p['parametro_id']; ?></b></font> 
                <a href="<?php echo site_url('parametro/edit/'.$p['parametro_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a>
                <a data-toggle="modal" data-target="#modaleliminar<?php echo $p['parametro_id']; ?>"  class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Eliminar</a>
                    <!------------------------ INICIO modal para cambiar PASSWORD ------------------->
                    <div class="modal fade" id="modaleliminar<?php echo $p['parametro_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalcambiarlabel<?php echo $p['parametro_id']; ?>">
                        <div class="modal-dialog" role="document">
                            <br><br>
                            <div class="modal-content">
                                <div class="modal-header text-center text-bold" style="font-size: 12pt">
                                    <label>ELIMINAR PERFIL <?php echo $p['parametro_id']; ?></label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                </div>
                                <?php
                                    echo form_open('parametro/remove/'.$p['parametro_id']);
                                ?>
                                <div class="modal-body" style="font-size: 10pt">
                                    <!------------------------------------------------------------------->
                                    <div class="col-md-12">
                                        <label for="nuevo_pass<?php echo $p['parametro_id'] ?>" class="control-label">Nota.-</label>
                                        <div class="form-group">
                                            Si elimina este perfil, tenga en cuenta que algunos usuarios quedarian sin perfil! y debera asignarle otro.
                                        </div>
                                    </div>
                                    <!------------------------------------------------------------------->
                                </div>
                                <div class="modal-footer aligncenter">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Aceptar
                                    </button>
                                    <!--<a href="<?php //echo site_url('usuario/nueva_clave/'.$u['usuario_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Cambiar </a>-->
                                    <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar </a>
                                </div>
                                <?php
                                echo form_close();
                                ?>
                            </div>
                        </div>
                    </div>
                    <!------------------------ FIN modal para cambiar PASSWORD ------------------->
            </div>
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla" style="text-align: center; font-size: 11px;color:black;">
                    <tr>
                        <th style="font-size: 12px;color:black;background: rgba(0, 0, 255, 0.3);" rowspan="4" ><u>CONFIGURACION</u></th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">Nº REC.<br>EGRESO</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">Nº REC.<br>INGRESO</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">Nº COPIAS<br>FACTURAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">TIPO IMPRESORA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">ANCHO FACTURA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">ALTO FACTURA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">MARGEN FACTURA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">PERMISO CLIENTES (CREDITOS)</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">API KEY</th>
                    </tr>
                    <tr>
                        <td><?php echo $p['parametro_numrecegr']; ?></td>
                        <td><?php echo $p['parametro_numrecing']; ?></td>
                        <td><?php echo $p['parametro_copiasfact']; ?></td>
                        <td><?php if($p['parametro_tipoimpresora'] =="NORMAL"){ echo "CARTA/MEDIA CARTA"; }else{echo $p['parametro_tipoimpresora'];} ?></td>
                        <td><?php echo number_format($p['parametro_anchofactura'], $p['parametro_decimales'], '.', ',') ; ?></td>
                        <td><?php echo number_format($p['parametro_altofactura'], $p['parametro_decimales'], '.', ',') ; ?></td>
                        <td><?php echo number_format($p['parametro_margenfactura'], $p['parametro_decimales'], '.', ',') ; ?></td>
                        <td><?php  if ($p['parametro_permisocredito']==1){ echo 'TODOS'; }else{ echo'INDIVIDUAL'; } ?></td>
                        <td><?php echo substr($p['parametro_apikey'],0,8).".."; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">TITULO DOC. VENTA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">No. ORDEN PROD.</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">TITULO PEDIDO</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">APERTURA/CIERRA<br>DE CAJA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">TIPO DE SISTEMA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">TIPO DE EMISION</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">REDIRECCIONAR USUARIO</th>
                    </tr>
                    <tr>
                        <td><?php echo $p['parametro_tituldoc']; ?></td>
                        <td><?php echo $p['parametro_numordenproduccion']; ?></td>
                        <td><?php echo $p['parametro_pedidotitulo']; ?></td>
                        <td><?php echo $p['parametro_manejocaja']; ?></td>
                        <td><?php echo $p['parametro_tiposistema']; ?></td>
                        <td><?php
                            if($p['parametro_tipoemision'] == 1){
                                echo 'ONLINE';
                            }else if($p['parametro_tipoemision'] == 2){
                                echo 'OFFLINE';
                            }else if($p['parametro_tipoemision'] == 3){
                                echo 'MASIVA';
                            }
                            ?>
                        </td>
                        <td><?php echo substr($p['parametro_redireccionusuario'],0,30).".."; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 12px;color:black; background: rgba(0, 255, 0, 0.3);" rowspan="2" ><u>CREDITOS</u></th>
                        <th style="font-size: 11px;color:black; background: rgba(0, 255, 0, 0.3);">No. CUOTAS</th>
                        <th style="font-size: 11px;color:black; background: rgba(0, 255, 0, 0.3);">MONTO MAXIMO DE PAGO</th>
                        <th style="font-size: 11px;color:black; background: rgba(0, 255, 0, 0.3);">DIAS DE GRACIA</th>
                        <th style="font-size: 11px;color:black; background: rgba(0, 255, 0, 0.3);">DIA DE PAGO</th>
                        <th style="font-size: 11px;color:black; background: rgba(0, 255, 0, 0.3);">PERIODO DE PAGO</th>
                        <th style="font-size: 11px;color:black; background: rgba(0, 255, 0, 0.3);">INTERES</th>
                    </tr>
                    <tr>
                        <td><?php echo $p['parametro_numcuotas']; ?></td>
                        <td><?php echo number_format($p['parametro_montomax'], $p['parametro_decimales'], '.', ',') ; ?> Bs.</td>
                        <td><?php echo $p['parametro_diasgracia']; ?></td>
                        <td>[<?php echo $p['parametro_diapago']; ?>]
                            <?php
                            $var= $p['parametro_diapago'];
                            switch($var) {

                            case 1: echo "LUNES";
                            break;
                            case 2: echo "MARTES";
                            break;
                            case 3: echo "MIERCOLES";
                            break;
                            case 4: echo "JUEVES";
                            break;
                            case 5: echo "VIERNES";
                            break;
                            case 6: echo "SABADO";
                            break;
                            case 7: echo "DOMINGO";
                            break;
                            }
                            ?>
                        </td>
                        <td><?php echo $p['parametro_periododias']; ?></td>
                        <td><?php echo $p['parametro_interes']; ?></td>
                       
                    </tr>
                   
                    <tr>
                        <th style="font-size: 12px;color:black;background: rgba(255, 0, 0, 0.3);" rowspan="2" ><u>SERVICIOS</u></th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">DIAGNOSTICO<br>(TEXTO POR DEFECTO)</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">SOLUCION<br>(TEXTO POR DEFECTO)</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">DIAS DE ENTREGA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">RESOLUCIÓN DE IMAGEN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">MODULO DE<br>SEGUIMIENTO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">DETALLE FACTURA (SERV.TEC.)</th>
                    </tr>
                    <tr>
                        <td><?php echo $p['parametro_diagnostico']; ?></td>
                        <td><?php echo $p['parametro_solucion']; ?></td>
                        <td><?php echo $p['parametro_diasentrega']; ?></td>
                        <td><?php if($p['parametro_imagenreal'] == 1){ echo "SUBIR IMAGENES EN TAMAÑO REAL"; }else{ echo "SUBIR IMAGENES COMPRIMIDOS"; } ?></td>
                        <td><?php if($p['parametro_segservicio'] == 1){ echo "ACTIVAR SEGUIMIENTO"; }else{ echo "DESACTIVAR SEGUIMIENTO"; } ?></td>
                        <td><?php if($p['parametro_serviciofact'] == 1){ echo "SOLUCION"; }
                                  elseif($p['parametro_serviciofact'] == 2){ echo "DESCRIPCION"; }
                                  elseif($p['parametro_serviciofact'] == 3){ echo "SOLUCION Y DESCRIPCION"; }
                                  elseif($p['parametro_serviciofact'] == 4){ echo "DESCRIPCION Y SOLUCION"; } ?>
                        </td>
                    </tr>
                    <tr>
                        <th style="font-size: 12px;color:black;background: rgba(255, 255, 0, 0.3);" rowspan="12" ><u>VENTAS</u></th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MOSTRAR CATEGORIA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">BUSCADOR EN VENTAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">IMPRIMIR COMANDA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ANCHO BOTON</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ALTO BOTON</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">COLOR BOTON</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ANCHO IMAGEN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ALTO IMAGEN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">FORMA IMAGEN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">COMPORTAMIENTO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">AGRUPAR ITEMS (DETALLE)</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">DIAS DE VENCIMIENTO</th>
                    </tr> 
                    <tr>
                        <td><?php foreach($all_categoria_producto as $categoria_producto)
                                {
                                if($categoria_producto['categoria_id']==$p['parametro_mostrarcategoria']){
                                    echo $categoria_producto['categoria_nombre'];
                                } } ?></td>
                        <td><?php  if ($p['parametro_modoventas']==1){ echo 'LISTA'; }else{ echo'BOTONES'; } ?></td>
                        <td><?php  if ($p['parametro_imprimircomanda']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php echo $p['parametro_anchoboton']; ?></td>
                        <td><?php echo $p['parametro_altoboton']; ?></td>
                        <td><?php echo $p['parametro_colorboton']; ?></td>
                        <td><?php echo $p['parametro_anchoimagen']; ?></td>
                        <td><?php echo $p['parametro_altoimagen']; ?></td>
                        <td><?php  if ($p['parametro_formaimagen']==''){ echo 'RECTANGULAR'; }else{ echo'CIRCULAR'; } ?></td>
                        <td><?php  if ($p['parametro_modulorestaurante']==0){
                                       echo 'COMERCIAL';
                                   }elseif($p['parametro_modulorestaurante']==1){
                                       echo'RESTAURANTE';
                                   }else{ echo'FARMACIA';} ?></td>
                        <td><?php  if ($p['parametro_agruparitems']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php echo $p['parametro_diasvenc']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">NOTA DE ENTREGA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">LOGO MONITOR</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">IMAGEN FONDO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">COMPORAMIENTO BOTON</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">DATOS DE BOTON</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MONEDA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MOSTRAR MONEDA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">FACTURA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MOSTRAR CODIGO EN RECIBOS</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">IMPRESION DE TICKETES</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">CANTIDAD DECIMALES</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">RANGO DE PRECIOS</th>
                    </tr>
                    <tr>
                        <td><?php
                            if($p['parametro_notaentrega'] == 3){
                                echo 'NOTA 3 (Pre-impresa)';
                            }else if($p['parametro_notaentrega'] == 2){
                                echo 'NOTA 2 (Carta)';
                            }else{
                                echo 'NOTA 1 (Boucher)';
                            }
                            ?>
                        </td>
                        <td><?php
                            if($p['parametro_logomonitor'] == "" || $p['parametro_logomonitor'] == null){
                                $logomonitor = "default.png";
                            }else{
                                $logomonitor  = "thumb_".$p['parametro_logomonitor'];
                            }
                            ?>
                            <img src="<?php echo base_url("resources/images/logo/".$logomonitor); ?>" width="25" height="25">
                        </td>
                        <td><?php
                            if($p['parametro_fondomonitor'] == "" || $p['parametro_fondomonitor'] == null){
                                $fondomonitor = "fondo_vistadetalleventa.jpeg";
                            }else{
                                $fondomonitor = "thumb_".$p['parametro_fondomonitor'];
                            }
                            ?>
                            <img src="<?php echo base_url("resources/images/monitor/".$fondomonitor); ?>" width="25" height="25">
                        </td>
                        <td><?php
                            if($p['parametro_cantidadproductos'] == 1){
                                echo 'ESPECIFICAR CANT. DE PRODUCTOS';
                            }else if($p['parametro_cantidadproductos'] == 2){
                                echo 'CARGAR UNO POR DEFECTO';
                            }
                            ?>
                        </td>
                        <td><?php
                            if($p['parametro_datosboton'] == 1){
                                echo 'NOMBRE PRODUCTO Y PRECIO';
                            }else if($p['parametro_datosboton'] == 2){
                                echo 'SOLO NOMBRE';
                            }else if($p['parametro_datosboton'] == 3){
                                echo 'SOLO PRECIO';
                            }else if($p['parametro_datosboton'] == 4){
                                echo 'NINGUNO';
                            }
                            ?>
                        </td>
                        <td><?php
                            echo $p['moneda_descripcion'];
                            ?>
                        </td>
                        <td><?php
                            if($p['parametro_mostrarmoneda'] == 1){
                                echo 'MOSTRAR';
                            }else if($p['parametro_mostrarmoneda'] == 2){
                                echo 'NO MOSTRAR';
                            }
                            ?>
                        </td>
                        <td><?php
                            if($p['parametro_factura'] == 1){
                                echo 'TODO FACTURADO';
                            }else if($p['parametro_factura'] == 2){
                                echo 'FACTURA OPCIONAL';
                            }else if($p['parametro_factura'] == 3){
                                echo 'SIN FACTURA';
                            }
                            ?>
                        </td>
                        <td><?php
                            if($p['parametro_codcatsubcat'] == 0 || $p['parametro_codcatsubcat'] == "" || $p['parametro_codcatsubcat'] == null){
                                echo 'NINGUNO';
                            }else if($p['parametro_codcatsubcat'] == 1){
                                echo 'CODIGO';
                            }else if($p['parametro_codcatsubcat'] == 2){
                                echo 'CATEGORIA, SUB CATEGORIA, CODIGO';
                            }else if($p['parametro_codcatsubcat'] == 3){
                                echo 'CATEGORIA, SUB CATEGORIA';
                            }else if($p['parametro_codcatsubcat'] == 4){
                                echo 'CATEGORIA, CODIGO';
                            }else if($p['parametro_codcatsubcat'] == 5){
                                echo 'CATEGORIA';
                            }else if($p['parametro_codcatsubcat'] == 6){
                                echo 'SUB CATEGORIA, CODIGO';
                            }else if($p['parametro_codcatsubcat'] == 7){
                                echo 'SUB CATEGORIA';
                            }
                            ?>
                        </td>
                        <td><?php
                            if($p['parametro_imprimirticket'] == 0){
                                echo 'NO IMPRIMIR TICKETS';
                            }else if($p['parametro_imprimirticket'] == 1){
                                echo 'IMPRIMIR TICKETS';
                            }
                            ?>
                        </td>
                        <td><?php
                            if($p['parametro_decimales'] > 0){
                                echo $p['parametro_decimales'];
                            }else{
                                echo '0';
                            }
                            ?>
                        </td>
                        <td><?php
                            if($p['parametro_rangoprecios'] == 1){
                                echo 'USAR RANGO DE PRECIOS';
                            }else if($p['parametro_rangoprecios'] == 2){
                                echo 'INACTIVAR RANGO DE PRECIOS';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ANCHO BUSCADOR</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">TAM. TEXTO BOTON</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">TAM. TEXTO DET. PRODUCTOS</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">BUSCADOR POR CODIGO</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">BUSCADOR DE TEXTO</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">CATEGORIA</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">SUBCATEGORIA</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">BOTON INVENTARIO</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">PROMOCIONES</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">CATEGORIA BOTONES</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">BUSCADOR DETALLE</th>
                         <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">HERRAM. SUPERIOR</th>
                    </tr>
                    <tr>
                        <td><?php echo $p['parametro_anchobuscador']; ?> </td>
                        <td><?php echo $p['parametro_tamanioletrasboton']; ?> </td>
                        <td><?php echo $p['parametro_tamanioletras']; ?> </td>
                        <td><?php  if ($p['parametro_buscadorcodigo']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_buscadortexto']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_categoria']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_subcategoria']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_botoninventario']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_promociones']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_categoriabotones']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_buscadordetalle']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_herramientassuperior']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">HERRAMIENTA INFERIOR</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">PRECIO TOTAL</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ASIGNAR INVENTARIO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">FINALIZAR VENTAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">RESUMEN VENTAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">CIERRE DE CAJA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">VENTAS DIARIAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">P. SIN HOMOLOGA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">TECLAS DE ACCESO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">INFORMACION BASICA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">PANEL VENTAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">INVENTARIO BUSCADOR</th>
                    </tr>
                    <tr>
                        <td><?php  if ($p['parametro_herramientasinferior']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_preciototal']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_asignarinventario']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_finalizarventas']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_resumenventas']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_cierrecaja']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_ventasdiarias']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_productossinhomologar']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_teclasacceso']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_informacionbasica']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_panelventas']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_inventariobuscador']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">PROM. BUSCADOR</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">LOGO EN FACTURA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">LOGO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ESLOGAN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">SIN INVENTARIO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MOVIMIENTO DIARIO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">IMPRIMIR FACTURA/RECIBO </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ORDEN </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">DOCUMENTO LISTA </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">TAM. TEXTO CATEGORIA </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">COLOR BOTON </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">DATOS PRODUCTO </th>
                    </tr>
                    <tr>
                        <td><?php  if ($p['parametro_promocionesbuscador']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_logoenfactura']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_mostrarlogo']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_mostrareslogan']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_sininventario']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php  if ($p['parametro_movimientodiario']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php
                            if ($p['parametro_imprimirfactura']==0){
                                echo 'NINGUNO';
                            }else if ($p['parametro_imprimirfactura']==1){
                                echo 'IMPRIMIR SOLO FACTURAS';
                            }else if ($p['parametro_imprimirfactura']==2){
                                echo 'IMPRIMIR SOLO RECIBOS';
                            }else if ($p['parametro_imprimirfactura']==3){
                                echo 'IMPRIMIR FACTURA Y RECIBO';
                            }else if ($p['parametro_imprimirfactura']==4){
                                echo 'IMPRIMIR FACTURA O RECIBO';
                            }
                            ?>
                        </td>
                        <td><?php  if ($p['parametro_orden']==1){ echo 'ASCENDENTE'; }else{ echo'DESCENDENTE'; } ?></td>
                        <td><?php  if ($p['parametro_documentoslista']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                        <td><?php  echo $p['parametro_tamaniotextocategoria']; ?></td>
                        <td><?php  echo $p['parametro_colorbotoncategoria']; ?></td>
                        <td><?php  if ($p['parametro_datosproducto']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">CANTIDAD SIMPLE </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">BOTONES CONTROL </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">BOTONES PRODUCTO </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ORDEN DETALLE </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">TABLA SENCILLA </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">REDIRECCIONAMIENTO </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">TIPO COMPROB. </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">VERIF. CONEXION </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">Nº VENTA </th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">CONTAR VENTAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">CONTAR VENTAS MES</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MOTRAR NUMERO</th>
                    </tr>
                    <tr>
                        <td><?php  if ($p['parametro_cantidadsimple']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                        <td><?php  if ($p['parametro_botonescontrol']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                        <td><?php  if ($p['parametro_botonesproducto']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                        <td><?php  if ($p['parametro_ordendetalle']==1){ echo 'ASCENDENTE'; }else{ echo 'DESCENDENTE'; } ?></td>
                        <td><?php  if ($p['parametro_tablasencilla']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                        <td><?php  echo $p['parametro_redireccionusuario']; ?></td>
                        <td>
                            <?php  if ($p['parametro_comprobante']==1){ echo 'RECIBO';} 
                                    if ($p['parametro_comprobante']==2){ echo 'FACTURA TRC'; }
                            ?>
                        </td>
                        <td><?php  if ($p['parametro_verificarconexion']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                        <td><?php  echo $p['parametro_numeroventa']; ?></td>
                        <td><?php  if ($p['parametro_contarventas']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                        <td><?php  if ($p['parametro_contarventasmes']==0){ echo 'NO'; }else{ echo 'SI'; } ?></td>
                        <td><?php  
                                    if ($p['parametro_mostrarnumero']==0){ echo 'NINGUNO'; }
                                    if ($p['parametro_mostrarnumero']==1){ echo 'NUMERO DE VENTA'; }
                                    if ($p['parametro_mostrarnumero']==2){ echo 'NUMERO DE TRANSACCION'; }
                                    if ($p['parametro_mostrarnumero']==3){ echo 'NUMERO DE FACTURA'; }
                                    if ($p['parametro_mostrarnumero']==4){ echo 'NUMERO DE TRANS. MENSUAL'; }
                                    
                                    ?>
                        
                        </td>
                    </tr>
                    <tr>
                        <th style="font-size: 12px;color:black;background: rgba(214, 114, 26, 0.3);" rowspan="2" ><u>CLIENTES</u></th>
                        <th style="font-size: 11px;color:black;background: rgba(214, 114, 26, 0.3);">PUNTOS (Bs/PUNTO)</th>
                    </tr>
                    <tr>
                        <td><?php echo number_format($p['parametro_puntos'], $p['parametro_decimales'], '.', ','); ?></td>
                    </tr>
                </table>
                           
            </div>
        </div>
    </div>
</div>
<?php
} ?>