<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Dosificación</h3>
            </div>
            <?php echo form_open('dosificacion/add'); ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="empresa_id" class="control-label"><span class="text-danger">*</span>Empresa</label>
                                <div class="form-group">
                                    <select name="empresa_id" class="form-control" required>
                                        <option value="">- EMPRESA -</option>
                                        <?php 
                                        foreach($all_empresa as $empresa)
                                        {
                                            $selected = ($empresa['empresa_id'] == $this->input->post('empresa_id')) ? ' selected="selected"' : "";
                                            echo '<option value="'.$empresa['empresa_id'].'" '.$selected.'>'.$empresa['empresa_nombre'].'</option>';
                                        } 
                                        ?>
                                        </select>
                                </div>
                        </div>
                        <div class="col-md-3">
                            <label for="dosificacion_nitemisor" class="control-label">Nit Emisor</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_nitemisor" value="<?php echo $this->input->post('dosificacion_nitemisor'); ?>" class="form-control" id="dosificacion_nitemisor" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="dosificacion_autorizacion" class="control-label">Autorización</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_autorizacion" value="<?php echo $this->input->post('dosificacion_autorizacion'); ?>" class="form-control" id="dosificacion_autorizacion" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_llave" class="control-label">Llave</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_llave" value="<?php echo $this->input->post('dosificacion_llave'); ?>" class="form-control" id="dosificacion_llave" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="dosificacion_numfact" class="control-label">Num. Factura</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_numfact" value="<?php echo $this->input->post('dosificacion_numfact'); ?>" class="form-control" id="dosificacion_numfact" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="dosificacion_fechalimite" class="control-label">Fecha Limite</label>
                            <div class="form-group">
                                <input type="date" name="dosificacion_fechalimite" value="<?php echo $this->input->post('dosificacion_fechalimite'); ?>" class="form-control" id="dosificacion_fechalimite" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_sucursal" class="control-label">Sucursal</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_sucursal" value="<?php echo $this->input->post('dosificacion_sucursal'); ?>" class="form-control" id="dosificacion_sucursal" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_sfc" class="control-label">Sfc</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_sfc" value="<?php echo $this->input->post('dosificacion_sfc'); ?>" class="form-control" id="dosificacion_sfc" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_actividad" class="control-label">Actividad</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_actividad" value="<?php echo $this->input->post('dosificacion_actividad'); ?>" class="form-control" id="dosificacion_actividad" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificasion_actividadsec" class="control-label">Actividad Secundaria</label>
                            <div class="form-group">
                                <input type="text" name="dosificasion_actividadsec" value="<?php echo $this->input->post('dosificasion_actividadsec'); ?>" class="form-control" id="dosificasion_actividadsec" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_leyenda1" class="control-label">Leyenda 1</label>
                            <div class="form-group">
                                <textarea rows="3" class="form-control" name="dosificacion_leyenda1" id="dosificacion_leyenda1"><?php echo $this->input->post('dosificacion_leyenda1'); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_leyenda2" class="control-label">Leyenda 2</label>
                            <div class="form-group">
                                <textarea rows="3" class="form-control" name="dosificacion_leyenda2" id="dosificacion_leyenda2"><?php echo $this->input->post('dosificacion_leyenda2'); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_leyenda3" class="control-label">Leyenda 3</label>
                            <div class="form-group">
                                <textarea rows="3" class="form-control" name="dosificacion_leyenda3" id="dosificacion_leyenda3"><?php echo $this->input->post('dosificacion_leyenda3'); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_leyenda4" class="control-label">Leyenda 4</label>
                            <div class="form-group">
                                <textarea rows="3" class="form-control" name="dosificacion_leyenda4" id="dosificacion_leyenda4"><?php echo $this->input->post('dosificacion_leyenda4'); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_leyenda5" class="control-label">Leyenda 5</label>
                            <div class="form-group">
                                <textarea rows="3" class="form-control" name="dosificacion_leyenda5" id="dosificacion_leyenda5"><?php echo $this->input->post('dosificacion_leyenda5'); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="docsec_codigoclasificador" class="control-label">Documento Sector</label>
                                <div class="form-group">
                                    <select name="docsec_codigoclasificador" class="form-control">
                                        <option value="">- Documento Sector -</option>
                                        <?php 
                                        foreach($all_documentosector as $docsector)
                                        {
                                            $selected = ($docsector['docsec_codigoclasificador'] == $this->input->post('docsec_codigoclasificador')) ? ' selected="selected"' : "";
                                            echo '<option value="'.$docsector['docsec_codigoclasificador'].'" '.$selected.'>'.$docsector['docsec_descripcion'].'</option>';
                                        } 
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <label for="dosificacion_tokendelegado" class="control-label">Token Delegado</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_tokendelegado" value="<?php echo ($this->input->post('dosificacion_tokendelegado') ? $this->input->post('dosificacion_tokendelegado') : ''); ?>" class="form-control" id="dosificacion_tokendelegado" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_ambiente" class="control-label">Ambiente</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_ambiente" value="<?php echo ($this->input->post('dosificacion_ambiente') ? $this->input->post('dosificacion_ambiente') : ''); ?>" class="form-control" id="dosificacion_ambiente" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_cuis" class="control-label">CUIS (Código Único de Inicio de Sistemas)</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_cuis" value="<?php echo ($this->input->post('dosificacion_cuis') ? $this->input->post('dosificacion_cuis') : ''); ?>" class="form-control" id="dosificacion_cuis" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_cufd" class="control-label">CUFD (Código Único de Facturación Diaria)</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_cufd" value="<?php echo ($this->input->post('dosificacion_cufd') ? $this->input->post('dosificacion_cufd') : ''); ?>" class="form-control" id="dosificacion_cufd" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_modalidad" class="control-label">Modalidad</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_modalidad" value="<?php echo ($this->input->post('dosificacion_modalidad') ? $this->input->post('dosificacion_modalidad') : ''); ?>" class="form-control" id="dosificacion_modalidad" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_codsistema" class="control-label">Cod. Sistema</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_codsistema" value="<?php echo ($this->input->post('dosificacion_codsistema') ? $this->input->post('dosificacion_codsistema') : ''); ?>" class="form-control" id="dosificacion_codsistema" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosificacion_puntoventa" class="control-label">Punto de Venta</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_puntoventa" value="<?php echo ($this->input->post('dosificacion_puntoventa') ? $this->input->post('dosificacion_puntoventa') : ''); ?>" class="form-control" id="dosificacion_puntoventa" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="dosificacion_sectoreconomico" class="control-label">Sector Economico</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_sectoreconomico" value="<?php echo ($this->input->post('dosificacion_sectoreconomico') ? $this->input->post('dosificacion_sectoreconomico') : ''); ?>" class="form-control" id="dosificacion_sectoreconomico" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="dosificacion_email" class="control-label">Correo Electrónico</label>
                            <div class="form-group">
                                <input type="email" name="dosificacion_email" value="<?php echo ($this->input->post('dosificacion_email') ? $this->input->post('dosificacion_email') : ''); ?>" class="form-control" id="dosificacion_email" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="dosificacion_cafc" class="control-label">CAFC</label>
                            <div class="form-group">
                                <input type="text" name="dosificacion_cafc" value="<?php echo ($this->input->post('dosificacion_cafc') ? $this->input->post('dosificacion_cafc') : ''); ?>" class="form-control" id="dosificacion_cafc" />
                            </div>
                        </div>
                    </div>
                </div>
          	<div class="box-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                    <a href="<?php echo site_url('dosificacion'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>