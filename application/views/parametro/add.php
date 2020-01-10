<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Parametros</h3>
            </div>
            <?php echo form_open('parametro/add'); ?>
            <div class="box-body" style="margin-top: 0px;margin-bottom: -20px; background: rgba(0, 0, 255, 0.3);"><u><b>CONFIGURACION</b></u><br>
                <div class="col-md-3">
                    <label for="parametro_numrecegr" class="control-label"> NUMERO EGRESO</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numrecegr" value="<?php echo ($this->input->post('parametro_numrecegr') ? $this->input->post('parametro_numrecegr') : 0); ?>" class="form-control" id="parametro_numrecegr" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_numrecing" class="control-label"> NUMERO INGRESO</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numrecing" value="<?php echo ($this->input->post('parametro_numrecing') ? $this->input->post('parametro_numrecing') : 0); ?>" class="form-control" id="parametro_numrecing" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_copiasfact" class="control-label"> NO. DE COPIAS FACTURA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_copiasfact" value="<?php echo ($this->input->post('parametro_copiasfact') ? $this->input->post('parametro_copiasfact') : 3); ?>" class="form-control" id="parametro_copiasfact" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_tipoimpresora" class="control-label"> TIPO DE IMPRESORA</label>
                    <div class="form-group">
                        <select  name="parametro_tipoimpresora"  class="form-control" id="parametro_tipoimpresora" >
                            <option value="FACTURADORA">FACTURADORA</option>
                            <option value="NORMAL">NORMAL</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_anchofactura" class="control-label">ANCHO FACTURA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_anchofactura" value="0" class="form-control" id="parametro_anchofactura" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_altofactura" class="control-label">ALTO FACTURA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_altofactura" value="0" class="form-control" id="parametro_altofactura" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_margenfactura" class="control-label">MARGEN FACTURA</label>
                    <div class="form-group">
                        <select  name="parametro_margenfactura" class="form-control" id="parametro_margenfactura" >
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_permisocredito" class="control-label">PERMISO CLIENTES</label>
                    <div class="form-group">
                        <select  name="parametro_permisocredito" class="form-control" id="parametro_permisocredito" >
                            <option value="1">TODOS</option>
                            <option value="2">INDIVIDUAL</option>
                        </select>
                    </div>
                </div>
            </div><hr>
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(0, 255, 0, 0.3);"><u><b>CREDITOS</b></u><br>
                <div class="col-md-2">
                    <label for="parametro_numcuotas" class="control-label"> NUMERO DE CUOTAS</label>
                    <div class="form-group">
                        <input type="number" name="parametro_numcuotas" value="0" class="form-control" id="parametro_numcuotas" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_montomax" class="control-label"> MONTO MAXIMO</label>
                    <div class="form-group">
                        <input type="number" step="any" name="parametro_montomax" value="0" class="form-control" id="parametro_montomax" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_diasgracia" class="control-label">DIAS DE GRACIA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_diasgracia" value="0" class="form-control" id="parametro_diasgracia" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_diapago" class="control-label"> DIA DE PAGO</label>
                    <div class="form-group">
                        <input  type="text" name="parametro_diapago" value="0" class="form-control" id="parametro_diapago" list="diapago" />
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
                        <input type="number" name="parametro_periododias" value="7" class="form-control" id="parametro_periododias" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_interes" class="control-label">INTERES PORC %</label>
                    <div class="form-group">
                        <input type="number" step="any" name="parametro_interes" value="0" class="form-control" id="parametro_interes" />
                    </div>
                </div>
            </div><hr>
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(255, 0, 0, 0.3);"><u><b>SERVICIOS</b></u><br>
                <div class="col-md-3">
                    <label for="parametro_diagnostico" class="control-label">DIAGNOSTICO</label>
                    <div class="form-group">
                        <input type="text" name="parametro_diagnostico" value="REVISION" class="form-control" id="parametro_diagnostico" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_solucion" class="control-label">SOLUCIÓN</label>
                    <div class="form-group">
                        <input type="text" name="parametro_solucion" value="REVISION" class="form-control" id="parametro_solucion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_diasentrega" class="control-label">DIAS DE ENTREGA</label>
                    <div class="form-group">
                        <input type="number" min="0" name="parametro_diasentrega" value="0" class="form-control" id="parametro_diasentrega"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_imagenreal" class="control-label"> RESOLUCIÓN DE IMAGEN</label>
                    <div class="form-group">
                        <select  name="parametro_imagenreal" class="form-control" id="parametro_imagenreal" >
                             <option value="1">SUBIR IMAGENES EN TAMAÑO REAL</option>
                            <option value="0">SUBIR IMAGENES COMPRIMIDOS</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_segservicio" class="control-label"> SEGUIMIENTO</label>
                    <div class="form-group">
                        <select  name="parametro_segservicio" class="form-control" id="parametro_segservicio" >
                             <option value="1">ACTIVAR SEGUIMIENTO</option>
                            <option value="0">DESACTIVAR SEGUIMIENTO</option>
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
                                    echo '<option value="'.$categoria_producto['categoria_id'].'">'.$categoria_producto['categoria_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_modoventas" class="control-label">MODO VENTAS</label>
                        <div class="form-group">
                            <select  name="parametro_modoventas" class="form-control" id="parametro_modoventas">
                                <option value="1">LISTA</option>
                                <option value="2">BOTONES</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_imprimircomanda" class="control-label">IMPRIMIR COMANDA</label>
                        <div class="form-group">
                            <select  name="parametro_imprimircomanda" class="form-control" id="parametro_imprimircomanda">
                                <option value="0">NO</option>
                                <option value="1">SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_modulorestaurante" class="control-label">MODULO</label>
                        <div class="form-group">
                            <select  name="parametro_modulorestaurante" class="form-control" id="parametro_modulorestaurante" >
                                <option value="0">NORMAL</option>
                                <option value="1">RESTAURANTE</option>
                                <option value="2">FARMACIA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_agruparitems" class="control-label">AGRUPAR ITEMS</label>
                        <div class="form-group">
                            <select  name="parametro_agruparitems" class="form-control" id="parametro_agruparitems">
                                <option value="0">NO</option>
                                <option value="1">SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_anchoboton" class="control-label">ANCHO BOTON</label>
                        <div class="form-group">
                            <input type="number" name="parametro_anchoboton" value="125" class="form-control" id="parametro_anchoboton" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_altoboton" class="control-label">ALTO BOTON</label>
                        <div class="form-group">
                            <input type="number" name="parametro_altoboton" value="180" class="form-control" id="parametro_altoboton"  />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_colorboton" class="control-label">COLOR BOTON</label>
                        <div class="select-style" >
                            <select name="parametro_colorboton" class="form-control" id="parametro_colorboton">
                                <option value="info" class="btn-info">INFO</option>
                                <option value="success" class="btn-success">SUCCES</option>
                                <option value="warning" class="btn-warning">WARNING</option>
                                <option value="facebook" class="btn-facebook">FACEBOOK</option>
                                <option value="danger" class="btn-danger">DANGER</option>
                                <option value="default" class="btn-default">DEFAULT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_anchoimagen" class="control-label">ANCHO IMAGEN</label>
                        <div class="form-group">
                            <input type="number" name="parametro_anchoimagen" value="123" class="form-control" id="parametro_anchoimagen"  />
                        </div>
                    </div>
                    <div class="col-md-2">
                    <label for="parametro_altoimagen" class="control-label">ALTO IMAGEN</label>
                        <div class="form-group">
                            <input type="number" name="parametro_altoimagen" value="140" class="form-control" id="parametro_altoimagen"  />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_formaimagen" class="control-label">FORMA IMAGEN</label>
                        <div class="form-group">
                            <select  name="parametro_formaimagen" class="form-control" id="parametro_formaimagen">
                                <option value="">RECTANGULAR</option>
                                <option value="circle">CIRCULAR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_diasvenc" class="control-label">DIAS DE VENCIMIENTO</label>
                        <div class="form-group">
                            <input type="number" min="0" name="parametro_diasvenc" value="15" class="form-control" id="parametro_diasvenc"  />
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