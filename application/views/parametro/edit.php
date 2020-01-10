<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Parametros</h3>
            </div>
            <?php echo form_open('parametro/edit/'.$parametro['parametro_id']); ?>
            <div class="box-body" style="margin-top: 0px;margin-bottom: -20px; background: rgba(0, 0, 255, 0.3);"><u><b>CONFIGURACION</b></u><br>
                <div class="col-md-3">
                    <label for="parametro_numrecegr" class="control-label"> NUMERO EGRESO</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numrecegr" value="<?php echo ($this->input->post('parametro_numrecegr') ? $this->input->post('parametro_numrecegr') : $parametro['parametro_numrecegr']); ?>" class="form-control" id="parametro_numrecegr" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_numrecing" class="control-label"> NUMERO INGRESO</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numrecing" value="<?php echo ($this->input->post('parametro_numrecing') ? $this->input->post('parametro_numrecing') : $parametro['parametro_numrecing']); ?>" class="form-control" id="parametro_numrecing" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_copiasfact" class="control-label"> NO. DE COPIAS FACTURA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_copiasfact" value="<?php echo ($this->input->post('parametro_copiasfact') ? $this->input->post('parametro_copiasfact') : $parametro['parametro_copiasfact']); ?>" class="form-control" id="parametro_copiasfact" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_tipoimpresora" class="control-label"> TIPO DE IMPRESORA</label>
                    <div class="form-group">
                        <select  name="parametro_tipoimpresora"  class="form-control" id="parametro_tipoimpresora" >
                            <option value="FACTURADORA">FACTURADORA</option>
                            <option value="NORMAL" <?php if($parametro['parametro_tipoimpresora']=='NORMAL'){ ?> selected <?php } ?> >NORMAL</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_anchofactura" class="control-label">ANCHO FACTURA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_anchofactura" value="<?php echo ($this->input->post('parametro_anchofactura') ? $this->input->post('parametro_anchofactura') : $parametro['parametro_anchofactura']); ?>" class="form-control" id="parametro_anchofactura" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_altofactura" class="control-label">ALTO FACTURA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_altofactura" value="<?php echo ($this->input->post('parametro_altofactura') ? $this->input->post('parametro_altofactura') : $parametro['parametro_altofactura']); ?>" class="form-control" id="parametro_altofactura" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_margenfactura" class="control-label">MARGEN FACTURA</label>
                    <div class="form-group">
                        <select  name="parametro_margenfactura" class="form-control" id="parametro_margenfactura" >
                            <option value="1">1</option>
                            <option value="2" <?php if($parametro['parametro_permisocredito']=='2'){ ?> selected <?php } ?> >2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_permisocredito" class="control-label">PERMISO CLIENTES</label>
                    <div class="form-group">
                        <select  name="parametro_permisocredito" class="form-control" id="parametro_permisocredito" >
                            <option value="1">TODOS</option>
                            <option value="2" <?php if($parametro['parametro_permisocredito']=='2'){ ?> selected <?php } ?> >INDIVIDUAL</option>
                        </select>
                    </div>
                </div>
            </div><hr>
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(0, 255, 0, 0.3);"><u><b>CREDITOS</b></u><br>
                <div class="col-md-2">
                    <label for="parametro_numcuotas" class="control-label"> NUMERO DE CUOTAS</label>
                    <div class="form-group">
                        <input type="number" name="parametro_numcuotas" value="<?php echo ($this->input->post('parametro_numcuotas') ? $this->input->post('parametro_numcuotas') : $parametro['parametro_numcuotas']); ?>" class="form-control" id="parametro_numcuotas" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_montomax" class="control-label"> MONTO MAXIMO</label>
                    <div class="form-group">
                        <input type="number" step="any" name="parametro_montomax" value="<?php echo ($this->input->post('parametro_montomax') ? $this->input->post('parametro_montomax') : $parametro['parametro_montomax']); ?>" class="form-control" id="parametro_montomax" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_diasgracia" class="control-label">DIAS DE GRACIA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_diasgracia" value="<?php echo ($this->input->post('parametro_diasgracia') ? $this->input->post('parametro_diasgracia') : $parametro['parametro_diasgracia']); ?>" class="form-control" id="parametro_diasgracia" />
                    </div>
                </div>
                <div class="col-md-2">
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
                <div class="col-md-2">
                    <label for="parametro_interes" class="control-label">INTERES PORC %</label>
                    <div class="form-group">
                        <input type="number" step="any" name="parametro_interes" value="<?php echo ($this->input->post('parametro_interes') ? $this->input->post('parametro_interes') : $parametro['parametro_interes']); ?>" class="form-control" id="parametro_interes" />
                    </div>
                </div>
            </div><hr>
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(255, 0, 0, 0.3);"><u><b>SERVICIOS</b></u><br>
                <div class="col-md-3">
                    <label for="parametro_diagnostico" class="control-label">DIAGNOSTICO</label>
                    <div class="form-group">
                        <input type="text" name="parametro_diagnostico" value="<?php echo ($this->input->post('parametro_diagnostico') ? $this->input->post('parametro_diagnostico') : $parametro['parametro_diagnostico']); ?>" class="form-control" id="parametro_diagnostico" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_solucion" class="control-label">SOLUCIÓN</label>
                    <div class="form-group">
                        <input type="text" name="parametro_solucion" value="<?php echo ($this->input->post('parametro_solucion') ? $this->input->post('parametro_solucion') : $parametro['parametro_solucion']); ?>" class="form-control" id="parametro_solucion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_diasentrega" class="control-label">DIAS DE ENTREGA</label>
                    <div class="form-group">
                        <input type="number" min="0" name="parametro_diasentrega" value="<?php echo ($this->input->post('parametro_diasentrega') ? $this->input->post('parametro_diasentrega') : $parametro['parametro_diasentrega']); ?>" class="form-control" id="parametro_diasentrega"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_imagenreal" class="control-label"> RESOLUCIÓN DE IMAGEN</label>
                    <div class="form-group">
                        <select  name="parametro_imagenreal" class="form-control" id="parametro_imagenreal" >
                             <option value="1">SUBIR IMAGENES EN TAMAÑO REAL</option>
                            <option value="0" <?php if($parametro['parametro_imagenreal']==0){ ?> selected <?php } ?> >SUBIR IMAGENES COMPRIMIDOS</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_segservicio" class="control-label"> SEGUIMIENTO</label>
                    <div class="form-group">
                        <select  name="parametro_segservicio" class="form-control" id="parametro_segservicio" >
                             <option value="1">ACTIVAR SEGUIMIENTO</option>
                            <option value="0" <?php if($parametro['parametro_segservicio']==0){ ?> selected <?php } ?> >DESACTIVAR SEGUIMIENTO</option>
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
                        <label for="parametro_modoventas" class="control-label">MODO VENTAS</label>
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
                        <label for="parametro_modulorestaurante" class="control-label">MODULO</label>
                        <div class="form-group">
                            <select  name="parametro_modulorestaurante" class="form-control" id="parametro_modulorestaurante" >
                                <option value="0" <?php if($parametro['parametro_modulorestaurante']==0) echo 'selected'; ?> >NORMAL</option>
                                <option value="1" <?php if($parametro['parametro_modulorestaurante']==1) echo 'selected'; ?> >RESTAURANTE</option>
                                <option value="2" <?php if($parametro['parametro_modulorestaurante']==2) echo 'selected'; ?> >FARMACIA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_agruparitems" class="control-label">AGRUPAR ITEMS</label>
                        <div class="form-group">
                            <select  name="parametro_agruparitems" class="form-control" id="parametro_agruparitems">
                                <option value="0" <?php if($parametro['parametro_agruparitems']==0) echo 'selected'; ?> >NO</option>
                                <option value="1" <?php if($parametro['parametro_agruparitems']==1) echo 'selected'; ?> >SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_anchoboton" class="control-label">ANCHO BOTON</label>
                        <div class="form-group">
                            <input type="number" name="parametro_anchoboton" value="<?php echo ($this->input->post('parametro_anchoboton') ? $this->input->post('parametro_anchoboton') : $parametro['parametro_anchoboton']); ?>" class="form-control" id="parametro_anchoboton" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_altoboton" class="control-label">ALTO BOTON</label>
                        <div class="form-group">
                            <input type="number" name="parametro_altoboton" value="<?php echo ($this->input->post('parametro_altoboton') ? $this->input->post('parametro_altoboton') : $parametro['parametro_altoboton']); ?>" class="form-control" id="parametro_altoboton"  />
                        </div>
                    </div>
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <label for="parametro_anchoimagen" class="control-label">ANCHO IMAGEN</label>
                        <div class="form-group">
                            <input type="number" name="parametro_anchoimagen" value="<?php echo ($this->input->post('parametro_anchoimagen') ? $this->input->post('parametro_anchoimagen') : $parametro['parametro_anchoimagen']); ?>" class="form-control" id="parametro_anchoimagen"  />
                        </div>
                    </div>
                    <div class="col-md-2">
                    <label for="parametro_altoimagen" class="control-label">ALTO IMAGEN</label>
                        <div class="form-group">
                            <input type="number" name="parametro_altoimagen" value="<?php echo ($this->input->post('parametro_altoimagen') ? $this->input->post('parametro_altoimagen') : $parametro['parametro_altoimagen']); ?>" class="form-control" id="parametro_altoimagen"  />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_formaimagen" class="control-label">FORMA IMAGEN</label>
                        <div class="form-group">
                            <select  name="parametro_formaimagen" class="form-control" id="parametro_formaimagen">
                                <option value="" <?php if($parametro['parametro_formaimagen']=='') echo 'selected'; ?> >RECTANGULAR</option>
                                <option value="circle" <?php if($parametro['parametro_formaimagen']=='circle') echo 'selected'; ?> >CIRCULAR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_diasvenc" class="control-label">DIAS DE VENCIMIENTO</label>
                        <div class="form-group">
                            <input type="number" min="0" name="parametro_diasvenc" value="<?php echo ($this->input->post('parametro_diasvenc') ? $this->input->post('parametro_diasvenc') : $parametro['parametro_diasvenc']); ?>" class="form-control" id="parametro_diasvenc"  />
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