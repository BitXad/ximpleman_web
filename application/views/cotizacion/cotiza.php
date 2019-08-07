<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/cotizacion.js'); ?>" type="text/javascript"></script>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
 <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="fecha_cotizacion" id="fecha_cotizacion" value="<?php echo $cotizacion['cotizacion_fecha']; ?>">
 <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="<?php echo $cotizacion_id; ?>">
 <link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
 
 <br>
<div id="fechacotizacion" style="text-align: right"></div>

<div style="text-align: left">
    <?php $mimagen = $empresa[0]['empresa_imagen'];
    echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" height="80px" width="25%"/>'; ?>
    <br><br>
    Señores:
    <br>
    <?php echo $cotizacion['cotizacion_cliente']; ?>
    <br>Presente.-
    <br>
</div>
<div style="text-align: center">
    <b>Ref.: COTIZACION</b>
</div>
<br>
<div style="text-align: justify">
    Mediante la presente me dirijo a su distinguida institución a tiempo de saludarle y desearle éxito
    en las funciones que desempeña.
</div>
<br>
<div style="text-align: justify">
    El motivo de la misma es cotizar el(los) siguiente(s) producto(s).
</div>

 
 <!--<div class="box" >-->
<!---------------------------------------TABLA DE DETALLE cotizacion------------------------------------>
<div class="col-md-12" style="padding: 0px;"> 
<div style="padding: 0px;">
    <div class="box-body table-responsive">
        <table class="table table-striped " id="mitabla">
            <tr>
                <th>CANTIDAD</th>
                <th>UNIDAD</th>
                <th>DESCRIPCION</th>
                <th>PROCEDENCIA</th>
                <th>PRECIO<br>UNITARIO</th>
                <th>DESCUENTO</th>
                <th>PRECIO<br>TOTAL</th>
            </tr>
            <tbody class="">
            <?php
                $cont = 0;
                $subtotal = 0;
                $descuento = 0;
                $totalfinal = 0;
                foreach($detalle_cotizacion as $d){;
                    $cont = $cont+1; 
                    $subtotal += $d['detallecot_subtotal'];
                    $descuento += $d['detallecot_descuento'];
                    $totalfinal += $d['detallecot_total'];
                ?>
            <tr>    
                <td  style="text-align: right;"> <?php echo $d['detallecot_cantidad']; ?></font>
                    <input id="detallecot_id"  name="detallecot_id" type="hidden" class="form-control" value="<?php echo $d['detallecot_id']; ?>">
                </td>
                <td style="text-align: center;"> <?php echo $d['producto_unidad']; ?> </td>
                <td style="text-align: left;"><b><?php echo $d['producto_nombre']; ?></b> /
                    Marca: <b><?php echo $d['producto_marca']; ?></b> / 
                    <!--Industria: <b><?php //echo $d['producto_industria']; ?></b>-->
                    <?php if($d['detallecot_caracteristica'] != ""){ echo " / ".$d['detallecot_caracteristica'];} ?>
                </td>
                <td class="text-center">
                    <?php echo $d['producto_industria']; ?>
                </td>

                <td  style="text-align: right;">
                    <!--<input id="cotizacion_id"  name="cotizacion_id" type="hidden" class="form-control" value="<?php echo $cotizacion_id; ?>">
                    <input id="detallecot_descripcion"  name="descripcion" type="hidden" class="form-control" value="<?php echo $d['producto_nombre'], $d['producto_marca'], $d['producto_industria'];  ?>">
                    <input id="producto_id"  name="producto_id" type="hidden" class="form-control" value="<?php echo $d['producto_id']; ?>">-->
                    <?php echo number_format($d['detallecot_precio'],2,".",","); ?>
                </td>  

                <td  style="text-align: right;">
                    <?php echo number_format($d['detallecot_descuento'], 2, ".", ","); ?>
                </td>

                <td  style="text-align: right;">
                    <span class="badge badge-success">
                         <b><?php echo number_format($d['detallecot_total'],2,".",","); ?></b></font> <br>                                        
                    </span>
                    <!--<button type="submit" class="btn btn-success hidden">
                        <i class="fa fa-check"></i>Finalizar<br>Cotizacion
                    </button>-->
                </td>
            </tr>
              <?php } ?>
                        
        
        <!--<form action="<?php //echo base_url('detalle_cotizacion/sacar/'.$d['detallecot_id']."/".$cotizacion_id); ?>"  method="POST" class="form"> 
                             <td>   
                                 <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </form></td>-->
                            
            </tbody>
            <tr>
                <td rowspan="2" colspan="3" class="text-center" style="font-size: 16pt">TOTAL</td>
                <td colspan="3" class="text-center">NUMERAL(Bs.)</td>
                <td class="text-right">
                    <span class="badge badge-success"><font size="3"><b><?php echo number_format($totalfinal,2,".",","); ?></b></font></span>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-center">MONTO LITERAL</td>
            </tr>
            <tr>
                <td colspan="7" class="text-center" style="font-size: 16pt">
                    <b><?php echo num_to_letras($totalfinal); ?></b>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center text-bold" style="font-size: 9pt">CONDICIONES DE TRABAJO</td>
                <td class="text-center text-bold" style="font-size: 9pt">RECIBI CONFORME</td>
                <td rowspan="4" colspan="4"></td>
            </tr>
            <tr>
                <td colspan="3"><br></td>
            </tr>
            <tr>
                <td colspan="3">FIRMA</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">NOMBRE</td>
                <!--<td class="text-center text-bold" style="font-size: 9pt">RECIBI CONFORME</td>-->
                <td rowspan="5" colspan="4" class="text-center">XXXXXXXX
                    <br>
                    REPRESENTANTE LEGAL</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">C.I.:</td>
            </tr>
            <tr>
                <td colspan="3">VALIDEZ DE LA OFERTA <?php echo $cotizacion['cotizacion_validez']; ?> CALENDARIO</td>
            </tr>
            <tr>
                <td colspan="3">TIEMPO DE ENTREGA <?php echo $cotizacion['cotizacion_tiempoentrega']; ?> CALENDARIO</td>
            </tr>
            <tr>
                <td colspan="3">LUGAR DE ENTREGA <?php echo ""; ?></td>
            </tr>
            <tr>
                <td colspan="7" class="text-center">TODOS LOS PRECIOS INCLUYEN IMPUESTOS DE LEY</td>
            </tr>
            <tr>
                <td colspan="7" class="text-center">FAVOR EMITIR EL CHEQUE A NOMBRE DE :xxx</td>
            </tr>
            <tr>
                <td>CONSULTAS</td>
                <td colspan="2" class="text-center">
                    TELEFONOS: <?php echo $empresa[0]['empresa_telefono']; ?>
                </td>
                <td colspan="4" class="text-center">
                    FAX: xxxx
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php echo $empresa[0]['empresa_departamento'].", ".$empresa[0]['empresa_direccion']; ?>
                </td>
                <td colspan="4" class="text-center">
                    e-mail:<?php echo $empresa[0]['empresa_email']; ?>
                </td>
            </tr>
        </table>
                    <!--<table class="table table-striped table-condensed" id="mitabla">
   <td>
                    	 <center>  
                    	 <b>LITERAL: <?php /*echo num_to_letras($totalfinal); ?></b></center>
                    	 <div class="col-md-12" style="text-align: right;">
                    	 <b>Toltal Desc. <span class="badge badge-success"><font size="3"><b><?php echo number_format($descuento,2,".",","); ?></b></font></span></b><br>
                    	 <b>TOTAL
                            	<span class="badge badge-success"><font size="3"><b><?php echo number_format($totalfinal,2,".",",");*/ ?></b></font></span>
                            
                        </div>    
                   </td>
                    
                    
                </table>-->
              
            </div>
    
<div class="col-md-12" style="text-align: right;">

    <font size="1"><?php echo date("d/m/Y   H:i:s"); ?></font>

</div>
					

        </div>

            		 <form action="<?php echo base_url('cotizacion/finalizar/'.$cotizacion_id); ?>"  method="POST" class="form">
            		 	<div class="row clearfix">

                           <div class="col-md-3" hidden>
						<label for="cotizacion_fecha" class="control-label"> Fecha</label>
						<div class="form-group">
							<input type="text" name="cotizacion_fecha" value="<?php echo implode("/", array_reverse(explode("-", ($this->input->post('cotizacion_fecha') ? $this->input->post('cotizacion_fecha') : $cotizacion['cotizacion_fecha'])))); ?>" class="has-datepicker form-control" id="cotizacion_fecha" />
						</div>
					</div>
					<div class="col-md-3" hidden>
						<label for="cotizacion_validez" class="control-label">Validez</label>
						<div class="form-group">
							<input type="text" name="cotizacion_validez"  value="<?php echo ($this->input->post('cotizacion_validez') ? $this->input->post('cotizacion_validez') : $cotizacion['cotizacion_validez']); ?>" class="form-control" id="cotizacion_validez" />
						</div>
					</div>
					<div class="col-md-3" hidden>
						<label for="cotizacion_formapago" class="control-label">Forma Pago</label>
						<div class="form-group">
							<input type="text" name="cotizacion_formapago"  value="<?php echo ($this->input->post('cotizacion_formapago') ? $this->input->post('cotizacion_formapago') : $cotizacion['cotizacion_formapago']); ?>" class="form-control" id="cotizacion_formapago" />
						</div>
					</div>
					<div class="col-md-3" hidden>
						<label for="cotizacion_tiempoentrega" class="control-label">Tiempo de Entrega</label>
						<div class="form-group">
							<input type="text" name="cotizacion_tiempoentrega"  value="<?php echo ($this->input->post('cotizacion_tiempoentrega') ? $this->input->post('cotizacion_tiempoentrega') : $cotizacion['cotizacion_tiempoentrega']); ?>" class="form-control" id="cotizacion_tiempoentrega" />
						</div>
					</div>
					<div class="col-md-6" hidden>
						<label for="cotizacion_total" class="control-label">Cotizacion Total</label>
						<div class="form-group">
							<input type="text" name="cotizacion_total" value="<?php echo $totalfinal; ?>" class="form-control" id="cotizacion_total" />
						</div>
					</div>
					 <div class="col-md-6">
						<label for="cotizacion_glosa" class="control-label">Nota: </label>
						<div class="form-group">
							<input type="text" name="cotizacion_glosa"  value="<?php echo ($this->input->post('cotizacion_glosa') ? $this->input->post('cotizacion_glosa') : $cotizacion['cotizacion_glosa']); ?>" class="form-control" id="cotizacion_glosa" />
						</div>
					</div>
					
       
            
    </div>
    <!--<center style="padding-top: 5%;">
              
                <?php /*echo "---------------------------------"; ?><br>
                <?php echo  $usuario['usuario_nombre'];*/ ?>    
               
 </center>-->
</div>

<!--</div>-->

 