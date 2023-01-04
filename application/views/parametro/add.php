<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Parametros</h3>
            </div>
            <?php echo form_open_multipart('parametro/add'); ?>
            <div class="box-body" style="margin-top: 0px;margin-bottom: -20px; background: rgba(0, 0, 255, 0.3);"><u><b>CONFIGURACION</b></u><br>
                <div class="col-md-2">
                    <label for="parametro_numrecegr" class="control-label"> NUMERO EGRESO</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numrecegr" value="<?php echo ($this->input->post('parametro_numrecegr') ? $this->input->post('parametro_numrecegr') : 0); ?>" class="form-control" id="parametro_numrecegr" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_numrecing" class="control-label"> NUMERO INGRESO</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numrecing" value="<?php echo ($this->input->post('parametro_numrecing') ? $this->input->post('parametro_numrecing') : 0); ?>" class="form-control" id="parametro_numrecing" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_copiasfact" class="control-label"> NO. DE COPIAS FACTURA</label>
                    <div class="form-group">
                        <input type="number" name="parametro_copiasfact" value="<?php echo ($this->input->post('parametro_copiasfact') ? $this->input->post('parametro_copiasfact') : 3); ?>" class="form-control" id="parametro_copiasfact" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_tipoimpresora" class="control-label"> TIPO DE IMPRESORA</label>
                    <div class="form-group">
                        <select  name="parametro_tipoimpresora"  class="form-control" id="parametro_tipoimpresora" >
                            <option value="FACTURADORA">FACTURADORA</option>
                            <option value="NORMAL">NORMAL</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_anchofactura" class="control-label">ANCHO FACTURA (CM)</label>
                    <div class="form-group">
                        <input type="number" name="parametro_anchofactura" value="0" class="form-control" id="parametro_anchofactura" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_altofactura" class="control-label">ALTO FACTURA (CM)</label>
                    <div class="form-group">
                        <input type="number" name="parametro_altofactura" value="0" class="form-control" id="parametro_altofactura" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_margenfactura" class="control-label">MARGEN IZQ. FACTURA (CM)</label>
                    <div class="form-group">
                        <input type="text" name="parametro_margenfactura" value="<?php echo ($this->input->post('parametro_margenfactura') ? $this->input->post('parametro_margenfactura') : ''); ?>" class="form-control" id="parametro_margenfactura" />
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
                <div class="col-md-7">
                    <label for="parametro_apikey" class="control-label">API KEY</label>
                    <div class="form-group">
                        <input type="text" name="parametro_apikey" value="<?php echo ($this->input->post('parametro_apikey') ? $this->input->post('parametro_apikey') : ""); ?>" class="form-control" id="parametro_apikey" />
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="parametro_tituldoc" class="control-label">TITULO DOC.</label>
                    <div class="form-group">
                        <input type="text" name="parametro_tituldoc" value="<?php echo ($this->input->post('parametro_tituldoc') ? $this->input->post('parametro_tituldoc') : ''); ?>" class="form-control" id="parametro_tituldoc" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_numordenproduccion" class="control-label"> NUMERO PRODUCCION</label>
                    <div class="form-group">
                        <input type="text" readonly name="parametro_numordenproduccion" value="<?php echo ($this->input->post('parametro_numordenproduccion') ? $this->input->post('parametro_numordenproduccion') : 0); ?>" class="form-control" id="parametro_numordenproduccion" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_pedidotitulo" class="control-label"> TITULO DE PEDIDO</label>
                    <div class="form-group">
                        <select  name="parametro_pedidotitulo" class="form-control" id="parametro_pedidotitulo" >
                            <option value="Pedidos">Pedidos</option>
                            <option value="Preventas">Preventas</option>
                            <option value="Reservas">Reservas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_manejocaja" class="control-label"> ADMINISTRAR CAJA</label>
                    <div class="form-group">
                        <select  name="parametro_manejocaja" class="form-control" id="parametro_manejocaja" >
                            <option value="Si">Si</option>
                            <option value=No">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="parametro_tiposistema" class="control-label"> TIPO DE SISTEMA</label>
                    <div class="form-group">
                        <select name="parametro_tiposistema" class="form-control" id="parametro_tiposistema">
                            <option value="1" >SISTEMA DE FACTURACION COMPUTARIZADO</option>
                            <option value="2" >SISTEMA DE FACTURACION COMPUTARIZADO EN LINEA</option>
                            <option value="3" >SISTEMA DE FACTURACION ELECTRONICO EN LINEA</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="parametro_tipoemision" class="control-label"> TIPO EMISION</label>
                    <div class="form-group">
                        <select name="parametro_tipoemision" class="form-control" id="parametro_tipoemision">
                            <option value="1" >ONLINE</option>
                            <option value="2" >OFFLINE</option>
                            <option value="3" >MASIVA</option>
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
                    <label for="parametro_imagenreal" class="control-label"> SUBIR IMAGENES</label>
                    <div class="form-group">
                        <select  name="parametro_imagenreal" class="form-control" id="parametro_imagenreal" >
                             <option value="1">EN TAMAÑO REAL</option>
                            <option value="0">COMPRIMIDAS</option>
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
                <div class="col-md-3">
                    <label for="parametro_serviciofact" class="control-label"> DETALLE FACTURA</label>
                    <div class="form-group">
                        <select  name="parametro_serviciofact" class="form-control" id="parametro_serviciofact" >
                            <option value="1">SOLUCION</option>
                            <option value="2">DESCRIPCION</option>
                            <option value="3">SOLUCION Y DESCRIPCION</option>
                            <option value="4">DESCRIPCION Y SOLUCION</option>
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
                    <div class="col-md-2">
                        <label for="parametro_notaentrega" class="control-label">NOTA DE ENTREGA</label>
                        <div class="form-group">
                            <select  name="parametro_notaentrega" class="form-control" id="parametro_notaentrega">
                                <option value="1">NOTA DE ENTREGA N° 1</option>
                                <option value="2">NOTA DE ENTREGA N° 2</option>
                                <option value="3">NOTA DE ENTREGA N° 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="parametro_logomonitor" class="control-label">LOGO(p/ Monitor) (260x130)</label>
                        <div class="form-group">
                            <input type="file" name="parametro_logomonitor" value="<?php echo ($this->input->post('parametro_logomonitor') ? $this->input->post('parametro_logomonitor') : ''); ?>" class="form-control" id="parametro_logomonitor" accept="image/png, image/jpeg, jpg, image/gif" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="parametro_fondomonitor" class="control-label">IMAGEN FONDO(p/ Monitor) (1920x1078)</label>
                        <div class="form-group">
                            <input type="file" name="parametro_fondomonitor" value="<?php echo ($this->input->post('parametro_fondomonitor') ? $this->input->post('parametro_fondomonitor') : ''); ?>" class="form-control" id="parametro_fondomonitor" accept="image/png, image/jpeg, jpg, image/gif" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_cantidadproductos" class="control-label">PASE A DETALLE</label>
                        <div class="form-group">
                            <select  name="parametro_cantidadproductos" class="form-control" id="parametro_cantidadproductos">
                                <option value="1">SELECCIONAR CANTIDAD DE PRODUCTOS</option>
                                <option value="2">CARGAR UNO POR DEFECTO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_datosboton" class="control-label">DATOS BOTON</label>
                        <div class="form-group">
                            <select  name="parametro_datosboton" class="form-control" id="parametro_datosboton">
                                <option value="1">NOMBRE PRODUCTO Y PRECIO</option>
                                <option value="2">SOLO NOMBRE</option>
                                <option value="3">SOLO PRECIO</option>
                                <option value="4">NINGUNO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="moneda_id" class="control-label" title="Moneda pricipal del Sistema"><span class="text-danger">*</span>MONEDA</label>
                        <div class="form-group">
                            <select name="moneda_id" class="form-control" required id="moneda_id">
                                <!--<option value="0">- CATEGORIA -</option>-->
                                <?php 
                                foreach($all_moneda as $moneda)
                                {
                                    echo '<option value="'.$moneda['moneda_id'].'">'.$moneda['moneda_descripcion'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_mostrarmoneda" class="control-label" title="En nota de entrega, para mostrar/no mostrar la otra moneda"><span class="text-danger">*</span>MOSTRAR MONEDA</label>
                        <div class="form-group">
                            <select name="parametro_mostrarmoneda" class="form-control" required id="parametro_mostrarmoneda">
                                <option value="1">MOSTRAR</option>
                                <option value="2">NO MOSTRAR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="parametro_factura" class="control-label"><span class="text-danger">*</span>FACTURA</label>
                        <div class="form-group">
                            <select name="parametro_factura" class="form-control" required id="parametro_factura">
                                <option value="1">TODO FACTURADO</option>
                                <option value="2">FACTURA OPCIONAL</option>
                                <option value="3">SIN FACTURA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="parametro_codcatsubcat" class="control-label" title="En nota de Entrega, para mostrar en el detalle del producto"><span class="text-danger">*</span>CODIGO/CATEGORIA/SUB-CAT.</label>
                        <div class="form-group">
                            <select name="parametro_codcatsubcat" class="form-control" required id="parametro_codcatsubcat">
                                <option value="0">NINGUNO</option>
                                <option value="1">CODIGO</option>
                                <option value="2">CATEGORIA, SUB CATEGORIA, CODIGO</option>
                                <option value="3">CATEGORIA, SUB CATEGORIA</option>
                                <option value="4">CATEGORIA, CODIGO</option>
                                <option value="5">CATEGORIA</option>
                                <option value="6">SUB CATEGORIA, CODIGO</option>
                                <option value="7">SUB CATEGORIA</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div><hr>
            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(214, 114, 26, 0.3);"><u><b>CLIENTES</b></u><br>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label for="parametro_puntos" class="control-label">PUNTOS</label>
                        <div class="form-group">
                            <input type="number" min="0" step="any" name="parametro_puntos" value="0" class="form-control" id="parametro_puntos" />
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