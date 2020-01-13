<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <font size='4' face='Arial'><b>Parametros</b></font>
                <a href="<?php echo site_url('parametro/edit/1'); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a>
            </div>
            <div class="box-body table-responsive" >
                
              
                <table class="table table-striped table-condensed" id="mitabla" style="text-align: center; font-size: 11px;color:black;">
                    <?php foreach($parametros as $p){ ?>
                    
                          
                            
                    
                    <tr>
                        <th style="font-size: 12px;color:black;background: rgba(0, 0, 255, 0.3);" rowspan="2" ><u>CONFIGURACION</u></th>
						<th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">No. EGRESO</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">No. INGRESO</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">No.COPIAS FACTURAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">TIPO DE IMPRESORA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">ANCHO FACTURA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">ALTO FACTURA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">MARGEN FACTURA</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);">PERMISO CLIENTES</th>
                    </tr>
                    <tr>
                        <td><?php echo $p['parametro_numrecegr']; ?></td>
                        <td><?php echo $p['parametro_numrecing']; ?></td>
                        <td><?php echo $p['parametro_copiasfact']; ?></td>
                        <td><?php echo $p['parametro_tipoimpresora']; ?></td>
                        <td><?php echo $p['parametro_anchofactura']; ?></td>
                        <td><?php echo $p['parametro_altofactura']; ?></td>
                        <td><?php echo $p['parametro_margenfactura']; ?></td>
                        <!--<th style="font-size: 11px;color:black;">TITULO DOC.</th>
                        <td><?php echo $p['parametro_tituldoc']; ?></td>-->
                        <td><?php  if ($p['parametro_permisocredito']==1){ echo 'TODOS'; }else{ echo'INDIVIDUAL'; } ?></td>
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
                        <td><?php echo $p['parametro_montomax']; ?> Bs.</td>
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
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">DIAGNOSTICO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">SOLUCION</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">DIAS DE ENTREGA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">RESOLUCIÓN DE IMAGEN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 0, 0, 0.3);">SEGUIMIENTO</th>
                    </tr>
                    <tr>
                        <td><?php echo $p['parametro_diagnostico']; ?></td>
                        <td><?php echo $p['parametro_solucion']; ?></td>
                        <td><?php echo $p['parametro_diasentrega']; ?></td>
                        <td><?php if($p['parametro_imagenreal'] == 1){ echo "SUBIR IMAGENES EN TAMAÑO REAL"; }else{ echo "SUBIR IMAGENES COMPRIMIDOS"; } ?></td>
                        <td><?php if($p['parametro_segservicio'] == 1){ echo "ACTIVAR SEGUIMIENTO"; }else{ echo "DESACTIVAR SEGUIMIENTO"; } ?></td>
                    </tr>
                        
                    <tr>
                        <th style="font-size: 12px;color:black;background: rgba(255, 255, 0, 0.3);" rowspan="2" ><u>VENTAS</u></th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MOSTRAR CATEGORIA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MODO VENTAS</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">IMPRIMIR COMANDA</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ANCHO BOTON</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ALTO BOTON</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">COLOR BOTON</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ANCHO IMAGEN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">ALTO IMAGEN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">FORMA IMAGEN</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">MODULO</th>
                        <th style="font-size: 11px;color:black;background: rgba(255, 255, 0, 0.3);">AGRUPAR ITEMS</th>
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
                                       echo 'NORMAL';
                                   }elseif($p['parametro_modulorestaurante']==1){
                                       echo'RESTAURANTE';
                                   }else{ echo'FARMACIA';} ?></td>
                        <td><?php  if ($p['parametro_agruparitems']==0){ echo 'NO'; }else{ echo'SI'; } ?></td>
                        <td><?php echo $p['parametro_diasvenc']; ?></td>
                    </tr>
                   
                    
                  
                    <?php } ?>
                </table>
                           
            </div>
        </div>
    </div>
</div>
