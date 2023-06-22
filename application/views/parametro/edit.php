
<style type="text/css">
label {
  font-size: 8pt;
  font-family: Arial Narrow;
} 
    
input {
    
    height: 10px;        
    
}    
/*    
div {
    
    padding-left: 0px;
    padding-right: 0px;    
    
}    */
</style>

            <div class="box-header with-border">
              	<h4>Parametros</h4>
            </div>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <?php echo form_open_multipart('parametro/edit/'.$parametro['parametro_id']); ?>
            <div class="box-body" style="margin-top: 0px;margin-bottom: -20px; background: rgba(0, 0, 255, 0.3);"><u><b>CONFIGURACION</b></u><br>
                
                <div class="col-md-1">
                    <label for="parametro_numrecegr" class="control-label"> Nº REC. EGRESO</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numrecegr" value="<?php echo ($this->input->post('parametro_numrecegr') ? $this->input->post('parametro_numrecegr') : $parametro['parametro_numrecegr']); ?>" class="form-control" id="parametro_numrecegr" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_numrecing" class="control-label"> Nº REC. INGRESO</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numrecing" value="<?php echo ($this->input->post('parametro_numrecing') ? $this->input->post('parametro_numrecing') : $parametro['parametro_numrecing']); ?>" class="form-control" id="parametro_numrecing" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_numordenproduccion" class="control-label"> No. ORDEN PROD.</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numordenproduccion" value="<?php echo ($this->input->post('parametro_numordenproduccion') ? $this->input->post('parametro_numordenproduccion') : $parametro['parametro_numordenproduccion']); ?>" class="form-control" id="parametro_numordenproduccion" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_copiasfact" class="control-label"> Nº COPIAS(FACT.)</label>
                    <div class="form-group">
                        <input type="number" name="parametro_copiasfact" value="<?php echo ($this->input->post('parametro_copiasfact') ? $this->input->post('parametro_copiasfact') : $parametro['parametro_copiasfact']); ?>" class="form-control" id="parametro_copiasfact" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_tipoimpresora" class="control-label"> TIPO IMPRESORA</label>
                    <div class="form-group">
                        <select  name="parametro_tipoimpresora"  class="form-control" id="parametro_tipoimpresora" >
                            <option value="FACTURADORA">FACTURADORA</option>
                            <option value="NORMAL" <?php if($parametro['parametro_tipoimpresora']=='NORMAL'){ ?> selected <?php } ?> >CARTA/MEDIA CARTA</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_anchofactura" class="control-label">ANCHO FACT.(CM)</label>
                    <div class="form-group">
                        <input type="number" step="any" name="parametro_anchofactura" value="<?php echo ($this->input->post('parametro_anchofactura') ? $this->input->post('parametro_anchofactura') : number_format($parametro['parametro_anchofactura'], $parametro['parametro_decimales'], '.', ',')); ?>" class="form-control" id="parametro_anchofactura" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_altofactura" class="control-label">ALTO FACT.(CM)</label>
                    <div class="form-group">
                        <input type="number" step="any" name="parametro_altofactura" value="<?php echo ($this->input->post('parametro_altofactura') ? $this->input->post('parametro_altofactura') : number_format($parametro['parametro_altofactura'], $parametro['parametro_decimales'], '.', ',')); ?>" class="form-control" id="parametro_altofactura" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_margenfactura" class="control-label">MARGEN IZQ.(CM)</label>
                    <div class="form-group">
                        <input type="parametro_margenfactura" step="any" name="parametro_margenfactura" value="<?php echo ($this->input->post('parametro_margenfactura') ? $this->input->post('parametro_margenfactura') : number_format($parametro['parametro_margenfactura'], $parametro['parametro_decimales'], '.', ',')); ?>" class="form-control" id="parametro_margenfactura" />
                        
<!--                        <select  name="parametro_margenfactura" class="form-control" id="parametro_margenfactura" >
                            <option value="1">1</option>
                            <option value="2" <?php if($parametro['parametro_permisocredito']=='2'){ ?> selected <?php } ?> >2</option>
                        </select>-->
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_permisocredito" class="control-label">PERMISO CLIENTES (CREDITOS)</label>
                    <div class="form-group">
                        <select  name="parametro_permisocredito" class="form-control" id="parametro_permisocredito" >
                            <option value="1">TODOS</option>
                            <option value="2" <?php if($parametro['parametro_permisocredito']=='2'){ ?> selected <?php } ?> >INDIVIDUAL</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <label for="parametro_apikey" class="control-label">API KEY GOOGLE</label>
                    <div class="form-group">
                        <input type="text" name="parametro_apikey" value="<?php echo ($this->input->post('parametro_apikey') ? $this->input->post('parametro_apikey') : $parametro['parametro_apikey']); ?>" class="form-control" id="parametro_apikey" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_tituldoc" class="control-label">TITULO DOC. VENTA</label>
                    <div class="form-group">
                        <input type="text" name="parametro_tituldoc" value="<?php echo ($this->input->post('parametro_tituldoc') ? $this->input->post('parametro_tituldoc') : $parametro['parametro_tituldoc']); ?>" class="form-control" id="parametro_tituldoc" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="parametro_pedidotitulo" class="control-label"> TITULO DE PEDIDO</label>
                    <div class="form-group">
                        <select name="parametro_pedidotitulo" class="form-control" id="parametro_pedidotitulo">
                            <option value="Pedidos" <?php if($parametro['parametro_pedidotitulo']=="Pedidos"){ ?> selected <?php } ?>>Pedidos</option>
                            <option value="Preventas" <?php if($parametro['parametro_pedidotitulo']=="Preventas"){ ?> selected <?php } ?>>Preventas</option>
                            <option value="Reservas" <?php if($parametro['parametro_pedidotitulo']=="Reservas"){ ?> selected <?php } ?>>Reservas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_manejocaja" class="control-label"> APERTURA CAJA</label>
                    <div class="form-group">
                        <select name="parametro_manejocaja" class="form-control" id="parametro_manejocaja">
                            <option value="Si" <?php if($parametro['parametro_manejocaja']=="Si"){ ?> selected <?php } ?>>Si</option>
                            <option value="No" <?php if($parametro['parametro_manejocaja']=="No"){ ?> selected <?php } ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_tiposistema" class="control-label"> TIPO DE SISTEMA</label>
                    <div class="form-group">
                        <select name="parametro_tiposistema" class="form-control" id="parametro_tiposistema">
                            <option value="1" <?php if($parametro['parametro_tiposistema']=="1"){ ?> selected <?php } ?>>FACTURACION COMPUTARIZADO SFV</option>
                            <option value="2" <?php if($parametro['parametro_tiposistema']=="2"){ ?> selected <?php } ?>>FACTURACION COMPUTARIZADO EN LINEA</option>
                            <option value="3" <?php if($parametro['parametro_tiposistema']=="3"){ ?> selected <?php } ?>>FACTURACION ELECTRONICO EN LINEA</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-1">
                    <label for="parametro_tipoemision" class="control-label"> TIPO EMISION</label>
                    <div class="form-group">
                        <select name="parametro_tipoemision" class="form-control" id="parametro_tipoemision">
                            <option value="1" <?php if($parametro['parametro_tipoemision']=="1"){ ?> selected <?php } ?>>ONLINE</option>
                            <option value="2" <?php if($parametro['parametro_tipoemision']=="2"){ ?> selected <?php } ?>>OFFLINE</option>
                            <option value="3" <?php if($parametro['parametro_tipoemision']=="3"){ ?> selected <?php } ?>>MASIVA</option>
                        </select>
                    </div>
                </div>
            </div><hr>
            
            
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(0, 255, 0, 0.3);"><u><b>CREDITOS</b></u><br>
                <div class="col-md-1">
                    <label for="parametro_numcuotas" class="control-label"> Nº DE CUOTAS</label>
                    <div class="form-group">
                        <input type="number" name="parametro_numcuotas" value="<?php echo ($this->input->post('parametro_numcuotas') ? $this->input->post('parametro_numcuotas') : $parametro['parametro_numcuotas']); ?>" class="form-control" id="parametro_numcuotas" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_montomax" class="control-label"> MONTO MAXIMO</label>
                    <div class="form-group">
                        <input type="number" step="any" name="parametro_montomax" value="<?php echo ($this->input->post('parametro_montomax') ? $this->input->post('parametro_montomax') : $parametro['parametro_montomax']); ?>" class="form-control" id="parametro_montomax" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_diasgracia" class="control-label">DIAS DE GRACIA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_diasgracia" value="<?php echo ($this->input->post('parametro_diasgracia') ? $this->input->post('parametro_diasgracia') : $parametro['parametro_diasgracia']); ?>" class="form-control" id="parametro_diasgracia" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_diapago" class="control-label"> DIA DE PAGO</label>
                    <div class="form-group">
                        <input  type="text" name="parametro_diapago" value="<?php echo ($this->input->post('parametro_diapago') ? $this->input->post('parametro_diapago') : $parametro['parametro_diapago']); ?>" class="form-control" id="parametro_diapago" list="diapago" />
                        <datalist id="diapago">
                            <option value="1">LUNES</option>
                            <option value="2">MARTES</option>
                            <option value="3">MIERCOLES</option>
                            <option value="4">JUEVES</option>
                            <option value="5" >VIERNES</option>
                            <option value="6">SABADO</option>
                            <option value="7">DOMINGO</option>
                        </datalist>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_periododias" class="control-label">PERIODO DE PAGO (DIAS)</label>
                    <div class="form-group">
                        <input type="number" name="parametro_periododias" value="<?php echo ($this->input->post('parametro_periododias') ? $this->input->post('parametro_periododias') : $parametro['parametro_periododias']); ?>" class="form-control" id="parametro_periododias" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_interes" class="control-label">INTERES PORC %</label>
                    <div class="form-group">
                        <input type="number" step="any" name="parametro_interes" value="<?php echo ($this->input->post('parametro_interes') ? $this->input->post('parametro_interes') : $parametro['parametro_interes']); ?>" class="form-control" id="parametro_interes" />
                    </div>
                </div>
            </div><hr>
            
            
            
            
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(255, 0, 0, 0.3);"><u><b>SERVICIOS</b></u><br>
                <div class="col-md-2">
                    <label for="parametro_diagnostico" class="control-label">TEXTO DIAGNOSTICO</label>
                    <div class="form-group">
                        <input type="text" name="parametro_diagnostico" value="<?php echo ($this->input->post('parametro_diagnostico') ? $this->input->post('parametro_diagnostico') : $parametro['parametro_diagnostico']); ?>" class="form-control" id="parametro_diagnostico" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_solucion" class="control-label">TEXTO SOLUCIÓN</label>
                    <div class="form-group">
                        <input type="text" name="parametro_solucion" value="<?php echo ($this->input->post('parametro_solucion') ? $this->input->post('parametro_solucion') : $parametro['parametro_solucion']); ?>" class="form-control" id="parametro_solucion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="parametro_diasentrega" class="control-label">DIAS ENTREGA</label>
                    <div class="form-group">
                        <input type="number" min="0" name="parametro_diasentrega" value="<?php echo ($this->input->post('parametro_diasentrega') ? $this->input->post('parametro_diasentrega') : $parametro['parametro_diasentrega']); ?>" class="form-control" id="parametro_diasentrega"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_imagenreal" class="control-label"> SUBIR IMAGENES</label>
                    <div class="form-group">
                        <select  name="parametro_imagenreal" class="form-control" id="parametro_imagenreal" >
                             <option value="1">EN TAMAÑO REAL</option>
                            <option value="0" <?php if($parametro['parametro_imagenreal']==0){ ?> selected <?php } ?> >COMPRIMIDAS</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_segservicio" class="control-label"> DOMULO DE SEGUIMIENTO</label>
                    <div class="form-group">
                        <select  name="parametro_segservicio" class="form-control" id="parametro_segservicio" >
                             <option value="1">ACTIVAR SEGUIMIENTO</option>
                            <option value="0" <?php if($parametro['parametro_segservicio']==0){ ?> selected <?php } ?> >DESACTIVAR SEGUIMIENTO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_serviciofact" class="control-label"> DETALLE FACTURA (SERV.TEC.)</label>
                    <div class="form-group">
                        <select  name="parametro_serviciofact" class="form-control" id="parametro_serviciofact" >
                             <option value="1" <?php if($parametro['parametro_serviciofact']==1){ ?> selected <?php } ?>>SOLUCION</option>
                             <option value="2" <?php if($parametro['parametro_serviciofact']==2){ ?> selected <?php } ?>>DESCRIPCION</option>
                             <option value="3" <?php if($parametro['parametro_serviciofact']==3){ ?> selected <?php } ?>>SOLUCION Y DESCRIPCION</option>
                             <option value="4" <?php if($parametro['parametro_serviciofact']==4){ ?> selected <?php } ?>>DESCRIPCION Y SOLUCION</option>
                        </select>
                    </div>
                </div>
            </div><hr>
            
            
            
            
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(255, 255, 0, 0.3);"><u><b>VENTAS</b></u><br>
                <div class="row clearfix">
                    
                    <div class="col-md-2">
                        <label for="parametro_mostrarcategoria" class="control-label">MOSTRAR CATEGORIA</label>
                        <div class="form-group">
                            <select name="parametro_mostrarcategoria" class="form-control" required id="parametro_mostrarcategoria">
                                <option value="0">- CATEGORIA -</option>
                                <?php 
                                foreach($all_categoria_producto as $categoria_producto)
                                {
                                    $selected = ($categoria_producto['categoria_id'] == $parametro['parametro_mostrarcategoria']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$categoria_producto['categoria_id'].'" '.$selected.'>'.$categoria_producto['categoria_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="parametro_modoventas" class="control-label">BUSCADOR EN VENTAS</label>
                        <div class="form-group">
                            <select  name="parametro_modoventas" class="form-control" id="parametro_modoventas">
                                <option value="1" <?php if($parametro['parametro_modoventas']==1) echo 'selected'; ?> >LISTA</option>
                                <option value="2" <?php if($parametro['parametro_modoventas']==2) echo 'selected'; ?> >BOTONES</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_imprimircomanda" class="control-label">IMPRIMIR COMANDA</label>
                        <div class="form-group">
                            <select  name="parametro_imprimircomanda" class="form-control" id="parametro_imprimircomanda">
                                <option value="0" <?php if($parametro['parametro_imprimircomanda']==0) echo 'selected'; ?> >NO</option>
                                <option value="1" <?php if($parametro['parametro_imprimircomanda']==1) echo 'selected'; ?> >SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_modulorestaurante" class="control-label">COMPORTAMIENTO</label>
                        <div class="form-group">
                            <select  name="parametro_modulorestaurante" class="form-control" id="parametro_modulorestaurante" >
                                <option value="0" <?php if($parametro['parametro_modulorestaurante']==0) echo 'selected'; ?> >COMERCIAL</option>
                                <option value="1" <?php if($parametro['parametro_modulorestaurante']==1) echo 'selected'; ?> >RESTAURANTE</option>
                                <option value="2" <?php if($parametro['parametro_modulorestaurante']==2) echo 'selected'; ?> >FARMACIA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_agruparitems" class="control-label">AGRUPAR ITEMS (DET.)</label>
                        <div class="form-group">
                            <select  name="parametro_agruparitems" class="form-control" id="parametro_agruparitems">
                                <option value="0" <?php if($parametro['parametro_agruparitems']==0) echo 'selected'; ?> >NO</option>
                                <option value="1" <?php if($parametro['parametro_agruparitems']==1) echo 'selected'; ?> >SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_anchoboton" class="control-label">ANCHO BOTON</label>
                        <div class="form-group">
                            <input type="number" name="parametro_anchoboton" value="<?php echo ($this->input->post('parametro_anchoboton') ? $this->input->post('parametro_anchoboton') : $parametro['parametro_anchoboton']); ?>" class="form-control" id="parametro_anchoboton" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_altoboton" class="control-label">ALTO BOTON</label>
                        <div class="form-group">
                            <input type="number" name="parametro_altoboton" value="<?php echo ($this->input->post('parametro_altoboton') ? $this->input->post('parametro_altoboton') : $parametro['parametro_altoboton']); ?>" class="form-control" id="parametro_altoboton"  />
                        </div>
                    </div>
                    
                    
                    <div class="col-md-1">
                        <label for="parametro_colorboton" class="control-label">COLOR BOTON</label>
                        <div class="select-style" >
                            <select name="parametro_colorboton" class="form-control" id="parametro_colorboton">
                                <option value="info" class="btn-info" <?php if($parametro['parametro_colorboton']=='info') echo 'selected'; ?> >INFO</option>
                                <option value="success" class="btn-success" <?php if($parametro['parametro_colorboton']=='success') echo 'selected'; ?>  >SUCCES</option>
                                <option value="warning" class="btn-warning" <?php if($parametro['parametro_colorboton']=='warning') echo 'selected'; ?>  >WARNING</option>
                                <option value="facebook" class="btn-facebook" <?php if($parametro['parametro_colorboton']=='facebook') echo 'selected'; ?>  >FACEBOOK</option>
                                <option value="danger" class="btn-danger" <?php if($parametro['parametro_colorboton']=='danger') echo 'selected'; ?>  >DANGER</option>
                                <option value="default" class="btn-default" <?php if($parametro['parametro_colorboton']=='default') echo 'selected'; ?>  >DEFAULT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_anchoimagen" class="control-label">ANCHO IMAGEN</label>
                        <div class="form-group">
                            <input type="number" name="parametro_anchoimagen" value="<?php echo ($this->input->post('parametro_anchoimagen') ? $this->input->post('parametro_anchoimagen') : $parametro['parametro_anchoimagen']); ?>" class="form-control" id="parametro_anchoimagen"  />
                        </div>
                    </div>
                    <div class="col-md-1">
                    <label for="parametro_altoimagen" class="control-label">ALTO IMAGEN</label>
                        <div class="form-group">
                            <input type="number" name="parametro_altoimagen" value="<?php echo ($this->input->post('parametro_altoimagen') ? $this->input->post('parametro_altoimagen') : $parametro['parametro_altoimagen']); ?>" class="form-control" id="parametro_altoimagen"  />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_formaimagen" class="control-label">FORMA IMAGEN</label>
                        <div class="form-group">
                            <select  name="parametro_formaimagen" class="form-control" id="parametro_formaimagen">
                                <option value="" <?php if($parametro['parametro_formaimagen']=='') echo 'selected'; ?> >RECTANGULAR</option>
                                <option value="circle" <?php if($parametro['parametro_formaimagen']=='circle') echo 'selected'; ?> >CIRCULAR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_diasvenc" class="control-label">DIAS DE VENCIM.</label>
                        <div class="form-group">
                            <input type="number" min="0" name="parametro_diasvenc" value="<?php echo ($this->input->post('parametro_diasvenc') ? $this->input->post('parametro_diasvenc') : $parametro['parametro_diasvenc']); ?>" class="form-control" id="parametro_diasvenc"  />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_notaentrega" class="control-label">NOTA ENTREGA</label>
                        <div class="form-group">
                            <select  name="parametro_notaentrega" class="form-control" id="parametro_notaentrega">
                                <option value="1" <?php if($parametro['parametro_notaentrega']=='1') echo 'selected'; ?> >NOTA 1 (Boucher)</option>
                                <option value="2" <?php if($parametro['parametro_notaentrega']=='2') echo 'selected'; ?> >NOTA 2 (Carta)</option>
                                <option value="3" <?php if($parametro['parametro_notaentrega']=='3') echo 'selected'; ?> >NOTA 3 (Pre-Impresa)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="parametro_logomonitor" class="control-label">LOGO(p/ Monitor) (260x130)</label>
                        <div class="form-group">
                            <input type="file" name="parametro_logomonitor" value="<?php echo ($this->input->post('parametro_logomonitor') ? $this->input->post('parametro_logomonitor') : $parametro['parametro_logomonitor']); ?>" class="form-control" id="parametro_logomonitor" accept="image/png, image/jpeg, jpg, image/gif" />
                            <input type="hidden" name="parametro_logomonitor1" value="<?php echo ($this->input->post('parametro_logomonitor') ? $this->input->post('parametro_logomonitor') : $parametro['parametro_logomonitor']); ?>" class="form-control" id="parametro_logomonitor1" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="parametro_fondomonitor" class="control-label">IMAGEN FONDO(p/ Monitor) (1920x1078)</label>
                        <div class="form-group">
                            <input type="file" name="parametro_fondomonitor" value="<?php echo ($this->input->post('parametro_fondomonitor') ? $this->input->post('parametro_fondomonitor') : $parametro['parametro_fondomonitor']); ?>" class="form-control" id="parametro_fondomonitor" accept="image/png, image/jpeg, jpg, image/gif" />
                            <input type="hidden" name="parametro_fondomonitor1" value="<?php echo ($this->input->post('parametro_fondomonitor') ? $this->input->post('parametro_fondomonitor') : $parametro['parametro_fondomonitor']); ?>" class="form-control" id="parametro_fondomonitor1" />
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-md-2">
                        <label for="parametro_cantidadproductos" class="control-label">COMPORAMIENTO BOTON</label>
                        <div class="form-group">
                            <select  name="parametro_cantidadproductos" class="form-control" id="parametro_cantidadproductos">
                                <option value="1" <?php if($parametro['parametro_cantidadproductos']=='1') echo 'selected'; ?> >SELECCIONAR CANTIDAD DE PRODUCTOS</option>
                                <option value="2" <?php if($parametro['parametro_cantidadproductos']=='2') echo 'selected'; ?> >CARGAR UNO POR DEFECTO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_datosboton" class="control-label">DATOS BOTON</label>
                        <div class="form-group">
                            <select  name="parametro_datosboton" class="form-control" id="parametro_datosboton">
                                <option value="1" <?php if($parametro['parametro_datosboton']=='1') echo 'selected'; ?> >NOMBRE PRODUCTO Y PRECIO</option>
                                <option value="2" <?php if($parametro['parametro_datosboton']=='2') echo 'selected'; ?> >SOLO NOMBRE</option>
                                <option value="3" <?php if($parametro['parametro_datosboton']=='3') echo 'selected'; ?> >SOLO PRECIO</option>
                                <option value="4" <?php if($parametro['parametro_datosboton']=='4') echo 'selected'; ?> >NINGUNO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="moneda_id" class="control-label" title="Moneda pricipal del Sistema"><span class="text-danger">*</span>MONEDA</label>
                        <div class="form-group">
                            <select name="moneda_id" class="form-control" required id="moneda_id">
                                <!--<option value="0">- CATEGORIA -</option>-->
                                <?php 
                                foreach($all_moneda as $moneda)
                                {
                                    $selected = ($moneda['moneda_id'] == $parametro['moneda_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_mostrarmoneda" class="control-label" title="En nota de entrega, para mostrar/no mostrar la otra moneda"><span class="text-danger">*</span>BIMONETARIO</label>
                        <div class="form-group">
                            <select name="parametro_mostrarmoneda" class="form-control" required id="parametro_mostrarmoneda">
                                <option value="1" <?php if($parametro['parametro_mostrarmoneda']=='1') echo 'selected'; ?> >SI</option>
                                <option value="2" <?php if($parametro['parametro_mostrarmoneda']=='2') echo 'selected'; ?> >NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_factura" class="control-label"><span class="text-danger">*</span>EMITIR FACTURA</label>
                        <div class="form-group">
                            <select name="parametro_factura" class="form-control" required id="parametro_factura">
                                <option value="1" <?php if($parametro['parametro_factura']=='1') echo 'selected'; ?> >TODO FACTURADO</option>
                                <option value="2" <?php if($parametro['parametro_factura']=='2') echo 'selected'; ?> >FACTURA OPCIONAL TIPO 1</option>
                                <option value="4" <?php if($parametro['parametro_factura']=='4') echo 'selected'; ?> >FACTURA OPCIONAL TIPO 2</option>
                                <option value="3" <?php if($parametro['parametro_factura']=='3') echo 'selected'; ?> >SIN FACTURA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_codcatsubcat" class="control-label" title="En nota de Entrega, para mostrar en el detalle del producto"><span class="text-danger">*</span>MOSTRAR CODIGO EN RECIBOS</label>
                        <div class="form-group">
                            <select name="parametro_codcatsubcat" class="form-control" required id="parametro_codcatsubcat">
                                <option value="0" <?php if($parametro['parametro_codcatsubcat']=='0') echo 'selected'; ?> >NINGUNO</option>
                                <option value="1" <?php if($parametro['parametro_codcatsubcat']=='1') echo 'selected'; ?> >CODIGO</option>
                                <option value="2" <?php if($parametro['parametro_codcatsubcat']=='2') echo 'selected'; ?> >CATEGORIA, SUB CATEGORIA, CODIGO</option>
                                <option value="3" <?php if($parametro['parametro_codcatsubcat']=='3') echo 'selected'; ?> >CATEGORIA, SUB CATEGORIA</option>
                                <option value="4" <?php if($parametro['parametro_codcatsubcat']=='4') echo 'selected'; ?> >CATEGORIA, CODIGO</option>
                                <option value="5" <?php if($parametro['parametro_codcatsubcat']=='5') echo 'selected'; ?> >CATEGORIA</option>
                                <option value="6" <?php if($parametro['parametro_codcatsubcat']=='6') echo 'selected'; ?> >SUB CATEGORIA, CODIGO</option>
                                <option value="7" <?php if($parametro['parametro_codcatsubcat']=='7') echo 'selected'; ?> >SUB CATEGORIA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="parametro_imprimirticket" class="control-label" title="Imprime los detalles uno a uno(Tickets)"><span class="text-danger">*</span>IMPRESION DE TICKETES</label>
                        <div class="form-group">
                            <select name="parametro_imprimirticket" class="form-control" required id="parametro_imprimirticket">
                                <option value="0" <?php if($parametro['parametro_imprimirticket']=='0') echo 'selected'; ?> >NO IMIPRIMIR TICKETS</option>
                                <option value="1" <?php if($parametro['parametro_imprimirticket']=='1') echo 'selected'; ?> >IMPRIMIR TICKETS</option>
                            </select>
                        </div>
                    </div>
      
                    
                    
                    <div class="col-md-3">
                        <label for="parametro_rangoprecios" class="control-label" title="Rango de precios 1 .- toma del rango; 2.- no toma del rango"><span class="text-danger">*</span>RANGO DE PRECIOS</label>
                        <div class="form-group">
                            <select name="parametro_rangoprecios" class="form-control" required id="parametro_rangoprecios">
                                <option value="1" <?php if($parametro['parametro_rangoprecios']=='1') echo 'selected'; ?> >USAR RANGO DE PRECIOS</option>
                                <option value="2" <?php if($parametro['parametro_rangoprecios']=='2') echo 'selected'; ?> >INACTIVAR RANGO DE PRECIOS</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-1">
                        <label for="parametro_anchobuscador" class="control-label" title="ancho del buscador"><span class="text-danger">*</span>ANCHO BUSCADOR</label>
                        <div class="form-group">
                            <input type="number" min="0" name="parametro_anchobuscador" value="<?php echo ($this->input->post('parametro_anchobuscador') ? $this->input->post('parametro_anchobuscador') : $parametro['parametro_anchobuscador']); ?>" class="form-control" id="parametro_anchobuscador" required />
                        </div>
                    </div>
                    
                    <div class="col-md-1">
                        <label for="parametro_tamanioletrasboton" class="control-label" title="tamaño de letras del boton"><span class="text-danger">*</span>TAMAÑO LETRAS (BOTON)</label>
                        <div class="form-group">
                            <input type="number" min="0" name="parametro_tamanioletrasboton" value="<?php echo ($this->input->post('parametro_tamanioletrasboton') ? $this->input->post('parametro_tamanioletrasboton') : $parametro['parametro_tamanioletrasboton']); ?>" class="form-control" id="parametro_tamanioletrasboton" required />
                        </div>
                    </div>
                    
                    <div class="col-md-1">
                        <label for="parametro_tamanioletras" class="control-label" title="tamaño de letras del detalle"><span class="text-danger">*</span>TAMAÑO LETRAS (VENTAS)</label>
                        <div class="form-group">
                            <input type="number" min="0" name="parametro_tamanioletras" value="<?php echo ($this->input->post('parametro_tamanioletras') ? $this->input->post('parametro_tamanioletras') : $parametro['parametro_tamanioletras']); ?>" class="form-control" id="parametro_tamanioletras" required />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_buscadorcodigo" class="control-label">BUSCADOR DE CODIGO</label>
                        <div class="form-group">
                            <select name="parametro_buscadorcodigo" class="form-control" id="parametro_buscadorcodigo">
                                <option value="1" <?php if($parametro['parametro_buscadorcodigo']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_buscadorcodigo']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_buscadortexto" class="control-label">BUSCADOR DE TEXTO</label>
                        <div class="form-group">
                            <select name="parametro_buscadortexto" class="form-control" id="parametro_buscadortexto">
                                <option value="1" <?php if($parametro['parametro_buscadortexto']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_buscadortexto']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-1">
                        <label for="parametro_categoria" class="control-label">CATEGORIA EN VENTAS</label>
                        <div class="form-group">
                            <select name="parametro_categoria" class="form-control" id="parametro_categoria">
                                <option value="1" <?php if($parametro['parametro_categoria']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_categoria']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_subcategoria" class="control-label">SUBCATEGORIA EN VENTAS</label>
                        <div class="form-group">
                            <select name="parametro_subcategoria" class="form-control" id="parametro_subcategoria">
                                <option value="1" <?php if($parametro['parametro_subcategoria']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_subcategoria']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_botoninventario" class="control-label">BOTON INVENTARIO</label>
                        <div class="form-group">
                            <select name="parametro_botoninventario" class="form-control" id="parametro_botoninventario">
                                <option value="1" <?php if($parametro['parametro_botoninventario']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_botoninventario']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_promociones" class="control-label">COMBOS Y PROMOCIONES </label>
                        <div class="form-group">
                            <select name="parametro_promociones" class="form-control" id="parametro_promociones">
                                <option value="1" <?php if($parametro['parametro_promociones']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_promociones']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-md-1">
                        <label for="parametro_categoriabotones" class="control-label">CATEGORIA BOTONES</label>
                        <div class="form-group">
                            <select name="parametro_categoriabotones" class="form-control" id="parametro_categoriabotones">
                                <option value="1" <?php if($parametro['parametro_categoriabotones']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_categoriabotones']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_buscadordetalle" class="control-label">BUSCADOR DETALLE</label>
                        <div class="form-group">
                            <select name="parametro_buscadordetalle" class="form-control" id="parametro_buscadordetalle">
                                <option value="1" <?php if($parametro['parametro_buscadordetalle']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_buscadordetalle']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_herramientassuperior" class="control-label">HERRAM. SUPERIOR</label>
                        <div class="form-group">
                            <select name="parametro_herramientassuperior" class="form-control" id="parametro_herramientassuperior">
                                <option value="1" <?php if($parametro['parametro_herramientassuperior']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_herramientassuperior']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_herramientasinferior" class="control-label">HERRAMIENTAS INFERIOR</label>
                        <div class="form-group">
                            <select name="parametro_herramientasinferior" class="form-control" id="parametro_herramientasinferior">
                                <option value="1" <?php if($parametro['parametro_herramientasinferior']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_herramientasinferior']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_preciototal" class="control-label">PRECIO TOTAL EN VENTAS</label>
                        <div class="form-group">
                            <select name="parametro_preciototal" class="form-control" id="parametro_preciototal">
                                <option value="1" <?php if($parametro['parametro_preciototal']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_preciototal']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_asignarinventario" class="control-label">ASIGNAR INVENTARIO</label>
                        <div class="form-group">
                            <select name="parametro_asignarinventario" class="form-control" id="parametro_asignarinventario">
                                <option value="1" <?php if($parametro['parametro_asignarinventario']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_asignarinventario']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_finalizarventas" class="control-label">BOTON FINALIZAR VENTAS</label>
                        <div class="form-group">
                            <select name="parametro_finalizarventas" class="form-control" id="parametro_finalizarventas">
                                <option value="1" <?php if($parametro['parametro_finalizarventas']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_finalizarventas']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_resumenventas" class="control-label">BOTON RESUMEN VENTAS</label>
                        <div class="form-group">
                            <select name="parametro_resumenventas" class="form-control" id="parametro_resumenventas">
                                <option value="1" <?php if($parametro['parametro_resumenventas']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_resumenventas']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_cierrecaja" class="control-label">BOTON CIERRE DE CAJA</label>
                        <div class="form-group">
                            <select name="parametro_cierrecaja" class="form-control" id="parametro_cierrecaja">
                                <option value="1" <?php if($parametro['parametro_cierrecaja']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_cierrecaja']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_ventasdiarias" class="control-label">BOTON VENTAS DIARIAS</label>
                        <div class="form-group">
                            <select name="parametro_ventasdiarias" class="form-control" id="parametro_ventasdiarias">
                                <option value="1" <?php if($parametro['parametro_ventasdiarias']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_ventasdiarias']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_productossinhomologar" class="control-label">PRODUCTOS SIN HOMOLOGAR</label>
                        <div class="form-group">
                            <select name="parametro_productossinhomologar" class="form-control" id="parametro_productossinhomologar">
                                <option value="1" <?php if($parametro['parametro_productossinhomologar']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_productossinhomologar']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label for="parametro_teclasacceso" class="control-label">PANEL TECLAS DE ACCESO</label>
                        <div class="form-group">
                            <select name="parametro_teclasacceso" class="form-control" id="parametro_teclasacceso">
                                <option value="1" <?php if($parametro['parametro_teclasacceso']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_teclasacceso']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-1">
                        <label for="parametro_informacionbasica" class="control-label">INFORMACION BASICA VENTAS</label>
                        <div class="form-group">
                            <select name="parametro_informacionbasica" class="form-control" id="parametro_informacionbasica">
                                <option value="1" <?php if($parametro['parametro_informacionbasica']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_informacionbasica']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_panelventas" class="control-label">PANEL EFECTIVO SUPERIOR</label>
                        <div class="form-group">
                            <select name="parametro_panelventas" class="form-control" id="parametro_panelventas">
                                <option value="1" <?php if($parametro['parametro_panelventas']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_panelventas']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_inventariobuscador" class="control-label">INVENTARIO BUSCADOR</label>
                        <div class="form-group">
                            <select name="parametro_inventariobuscador" class="form-control" id="parametro_inventariobuscador">
                                <option value="1" <?php if($parametro['parametro_inventariobuscador']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_inventariobuscador']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_promocionesbuscador" class="control-label">PROMO. BUSCADOR</label>
                        <div class="form-group">
                            <select name="parametro_promocionesbuscador" class="form-control" id="parametro_promocionesbuscador">
                                <option value="1" <?php if($parametro['parametro_promocionesbuscador']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_promocionesbuscador']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_logoenfactura" class="control-label">LOGO EN FACTURA</label>
                        <div class="form-group">
                            <select name="parametro_logoenfactura" class="form-control" id="parametro_logoenfactura">
                                <option value="1" <?php if($parametro['parametro_logoenfactura']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_logoenfactura']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_sininventario" class="control-label">VENTAS SIN INVENTARIO</label>
                        <div class="form-group">
                            <select name="parametro_sininventario" class="form-control" id="parametro_sininventario">
                                <option value="1" <?php if($parametro['parametro_sininventario']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_sininventario']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="parametro_movimientodiario" class="control-label">MOVIMIENTO DIARIO</label>
                        <div class="form-group">
                            <select name="parametro_movimientodiario" class="form-control" id="parametro_movimientodiario">
                                <option value="1" <?php if($parametro['parametro_movimientodiario']=="1"){ ?> selected <?php } ?>>Si</option>
                                <option value="0" <?php if($parametro['parametro_movimientodiario']=="0"){ ?> selected <?php } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="parametro_imprimirfactura" class="control-label">IMPRIMIR FACTURA/RECIBO</label>
                        <div class="form-group">
                            <select name="parametro_imprimirfactura" class="form-control" id="parametro_imprimirfactura">
                                <option value="0" <?php if($parametro['parametro_imprimirfactura']=="0"){ ?> selected <?php } ?>>NINGUNO</option>
                                <option value="1" <?php if($parametro['parametro_imprimirfactura']=="1"){ ?> selected <?php } ?>>IMPRIMIR SOLO FACTURAS</option>
                                <option value="2" <?php if($parametro['parametro_imprimirfactura']=="2"){ ?> selected <?php } ?>>IMPRIMIR SOLO RECIBOS</option>
                                <option value="3" <?php if($parametro['parametro_imprimirfactura']=="3"){ ?> selected <?php } ?>>IMPRIMIR FACTURA Y RECIBO</option>
                                <option value="4" <?php if($parametro['parametro_imprimirfactura']=="4"){ ?> selected <?php } ?>>IMPRIMIR FACTURA O RECIBO</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2"> 
                        <label for="parametro_decimales" class="control-label" title="Cantidad de decimales"><span class="text-danger">*</span>CANTIDAD DECIMALES</label> 
                        <div class="form-group"> 
                            <input type="number" min="0" name="parametro_decimales" value="<?php echo ($this->input->post('parametro_decimales') ? $this->input->post('parametro_decimales') : $parametro['parametro_decimales']); ?>" class="form-control" id="parametro_decimales" required /> 
                        </div> 
                    </div> 
                    
                </div>
            </div><hr>
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(214, 114, 26, 0.3);"><u><b>CLIENTES</b></u><br>
                <div class="row clearfix">
                    <div class="col-md-1">
                        <label for="parametro_puntos" class="control-label">PUNTOS (Bs/PUNTO)</label>
                        <div class="form-group">
                            <input type="number" min="0" step="any" name="parametro_puntos" value="<?php echo ($this->input->post('parametro_puntos') ? $this->input->post('parametro_puntos') : number_format($parametro['parametro_puntos'], $parametro['parametro_decimales'], '.', ',')); ?>" class="form-control" id="parametro_puntos"  />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
                <a href="<?php echo site_url('parametro'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>