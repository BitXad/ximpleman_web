<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <!-- <div> -->
                <figure id="gif_loader" style="display: none;">
                    <img  style="margin-left: 50%; margin-right: auto;" width="20px" height="20px" src="<?= site_url("resources/images/loader.gif") ?>" alt="Gif de carga" style="margin: auto;">
                </figure>    
            <!-- </div> -->
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Dosificación</h3>
            </div>
            
            
            <?php echo form_open_multipart('dosificacion/edit/'.$dosificacion['dosificacion_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-3">
                        <label for="empresa_id" class="control-label">Empresa</label>
                        <div class="form-group">
                            <select name="empresa_id" class="form-control">
                                <option value="">select empresa</option>
                                <?php 
                                    foreach($all_empresa as $empresa)
                                    {
                                        $selected = ($empresa['empresa_id'] == $dosificacion['empresa_id']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$empresa['empresa_id'].'" '.$selected.'>'.$empresa['empresa_nombre'].'</option>';
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--<div class="col-md-3">
                        <label for="dosificacion_fechahora" class="control-label">Fecha, Hora</label>
                        <?php
                        /*$fechayhora = ($this->input->post('dosificacion_fechahora') ? $this->input->post('dosificacion_fechahora') : $dosificacion['dosificacion_fechahora']);
                        $fecha = date("Y-m-d", strtotime($fechayhora));
                        $hora = date("H:i:s", strtotime($fechayhora)); */
                        ?>
                        <div class="form-group">
                            <input type="datetime-local" name="dosificacion_fechahora" value="<?php //echo $fecha."T".$hora; ?>" class="form-control" id="dosificacion_fechahora" />
                        </div>
                    </div>-->
                    <div class="col-md-3">
                        <label for="dosificacion_nitemisor" class="control-label">Nit Emisor</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_nitemisor" value="<?php echo ($this->input->post('dosificacion_nitemisor') ? $this->input->post('dosificacion_nitemisor') : $dosificacion['dosificacion_nitemisor']); ?>" class="form-control" id="dosificacion_nitemisor" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_autorizacion" class="control-label">Autorización</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_autorizacion" value="<?php echo ($this->input->post('dosificacion_autorizacion') ? $this->input->post('dosificacion_autorizacion') : $dosificacion['dosificacion_autorizacion']); ?>" class="form-control" id="dosificacion_autorizacion" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_llave" class="control-label">Llave</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_llave" value="<?php echo ($this->input->post('dosificacion_llave') ? $this->input->post('dosificacion_llave') : $dosificacion['dosificacion_llave']); ?>" class="form-control" id="dosificacion_llave" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_numfact" class="control-label">Num. Factura</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_numfact" value="<?php echo ($this->input->post('dosificacion_numfact') ? $this->input->post('dosificacion_numfact') : $dosificacion['dosificacion_numfact']); ?>" class="form-control" id="dosificacion_numfact" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_fechalimite" class="control-label">Fecha Limite</label>
                        <div class="form-group">
                            <input type="date" name="dosificacion_fechalimite" value="<?php echo ($this->input->post('dosificacion_fechalimite') ? $this->input->post('dosificacion_fechalimite') : $dosificacion['dosificacion_fechalimite']); ?>" class="form-control" id="dosificacion_fechalimite" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_sucursal" class="control-label">Sucursal (0 Casa Matriz)</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_sucursal" value="<?php echo ($this->input->post('dosificacion_sucursal') ? $this->input->post('dosificacion_sucursal') : $dosificacion['dosificacion_sucursal']); ?>" class="form-control" id="dosificacion_sucursal" />
                            <!--<select class="form-control" name="dosificacion_sucursal" id="dosificacion_sucursal">
                                <option value="0" <?php /*= ($dosificacion['dosificacion_sucursal']==0)?'selected':'' ?>>CASA MATRIZ</option>
                                <option value="1" <?= ($dosificacion['dosificacion_sucursal']==1)?'selected':'' ?>>SUCURSAL 1</option>
                                <option value="2" <?= ($dosificacion['dosificacion_sucursal']==2)?'selected':'' ?>>SUCURSAL 2</option>
                                <option value="3" <?= ($dosificacion['dosificacion_sucursal']==3)?'selected':'' ?>>SUCURSAL 3</option>
                                <option value="4" <?= ($dosificacion['dosificacion_sucursal']==4)?'selected':'' ?>>SUCURSAL 4</option>
                                <option value="5" <?= ($dosificacion['dosificacion_sucursal']==5)?'selected':'' */ ?>>SUCURSAL 5</option>
                            </select>-->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_sfc" class="control-label">Sfc</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_sfc" value="<?php echo ($this->input->post('dosificacion_sfc') ? $this->input->post('dosificacion_sfc') : $dosificacion['dosificacion_sfc']); ?>" class="form-control" id="dosificacion_sfc" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_actividad" class="control-label">Actividad</label>
                        <div class="form-group">
                            <select name="dosificacion_actividad" id="dosificacion_actividad" class="form-control" onChange="set_actividad(1),get_leyendas()">
                                <?php
                                    $actividad_select = "";
                                    foreach($actividades as $actividad){
                                        $selected = "";
                                        if($dosificacion['dosificacion_actividad'] == $actividad['actividad_codigocaeb']){
                                            $selected = "selected";
                                            $actividad_select = $actividad['actividad_codigocaeb'];
                                        }
                                        echo "<option value='{$actividad['actividad_codigocaeb']}' $selected>{$actividad['actividad_codigocaeb']} - {$actividad['actividad_descripcion']}</option>";
                                    }
                                ?>
                            </select>
                            <input type="hidden" name="actividad_1" id="actividad_1" value="<?= $actividad_select ?>" class="form-control" />
                            <!-- <input type="text" name="dosificacion_actividad" value="<?php echo ($this->input->post('dosificacion_actividad') ? $this->input->post('dosificacion_actividad') : $dosificacion['dosificacion_actividad']); ?>" class="form-control" id="dosificacion_actividad" /> -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificasion_actividadsec" class="control-label">Actividad Secundaria</label>
                        <div class="form-group">
                            <select name="dosificasion_actividadsec" id="dosificasion_actividadsec" class="form-control" onChange="set_actividad(2),get_leyendas()">
                                <?php
                                    $actividad_select2 = "";
                                    foreach($actividades as $actividad){
                                        $selected = "";
                                        if($dosificacion['dosificasion_actividadsec'] == $actividad['actividad_codigocaeb']){
                                            $selected = "selected";
                                            $actividad_select2 = $actividad['actividad_codigocaeb'];    
                                        }
                                        echo "<option value='{$actividad['actividad_codigocaeb']}' $selected>{$actividad['actividad_codigocaeb']} - {$actividad['actividad_descripcion']}</option>";
                                    }
                                ?>
                            </select>
                            <input type="hidden" name="actividad_2" id="actividad_2" value="<?= $actividad_select2 ?>" class="form-control" />
                            <!-- <input type="text" name="dosificasion_actividadsec" value="<?php echo ($this->input->post('dosificasion_actividadsec') ? $this->input->post('dosificasion_actividadsec') : $dosificacion['dosificasion_actividadsec']); ?>" class="form-control" id="dosificasion_actividadsec" /> -->
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_numerotransmes" class="control-label">Num. Trans. Mensual</label>
                        <div class="form-group">
                            <input type="text" id="dosificacion_numerotransmes" name="dosificacion_numerotransmes" value="<?php echo ($this->input->post('dosificacion_numerotransmes') ? $this->input->post('dosificacion_numerotransmes') : $dosificacion['dosificacion_numerotransmes']); ?>" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_mesactual" class="control-label">Men Actual</label>
                        <div class="form-group">
                            <input type="text" id="dosificacion_mesactual" name="dosificacion_mesactual" value="<?php echo ($this->input->post('dosificacion_mesactual') ? $this->input->post('dosificacion_mesactual') : $dosificacion['dosificacion_mesactual']); ?>" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_leyenda1" class="control-label">Leyenda1</label>
                        <div class="form-group">
                            <input type="text" id="dosificacion_leyenda1" name="dosificacion_leyenda1" value="<?php echo ($this->input->post('dosificacion_leyenda1') ? $this->input->post('dosificacion_leyenda1') : $dosificacion['dosificacion_leyenda1']); ?>" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_leyenda2" class="control-label">Leyenda2</label>
                        <div class="form-group">
                            <input type="hidden" id="dosificacion_leyenda2_select" name="dosificacion_leyenda2_select" value="<?php echo ($this->input->post('dosificacion_leyenda2') ? $this->input->post('dosificacion_leyenda2') : $dosificacion['dosificacion_leyenda2']); ?>" class="form-control"/>
                            <select name="dosificacion_leyenda2" id="dosificacion_leyenda2" class="form-control" size='1'></select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_leyenda3" class="control-label">Leyenda3</label>
                        <div class="form-group">
                            <input type="text" id="dosificacion_leyenda3" name="dosificacion_leyenda3" value="<?php echo ($this->input->post('dosificacion_leyenda3') ? $this->input->post('dosificacion_leyenda3') : $dosificacion['dosificacion_leyenda3']); ?>" class="form-control"/>
                            <!--<select name="dosificacion_leyenda3" id="dosificacion_leyenda3" class="form-control" size='1'></select>-->
                            <!--<input name="dosificacion_leyenda3" id="dosificacion_leyenda3" class="form-control" size='1'/>-->
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_leyenda4" class="control-label">Leyenda4</label>
                        <div class="form-group">
                            <input type="text" id="dosificacion_leyenda4" name="dosificacion_leyenda4" value="<?php echo ($this->input->post('dosificacion_leyenda4') ? $this->input->post('dosificacion_leyenda4') : $dosificacion['dosificacion_leyenda4']); ?>" class="form-control"/>
<!--                            <input type="hidden" id="dosificacion_leyenda4_select" name="dosificacion_leyenda4_select" value="<?php echo ($this->input->post('dosificacion_leyenda4') ? $this->input->post('dosificacion_leyenda4') : $dosificacion['dosificacion_leyenda4']); ?>" class="form-control"/>
                            <select name="dosificacion_leyenda4" id="dosificacion_leyenda4" class="form-control" size='1'></select>-->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_leyenda5" class="control-label">Leyenda5</label>
                        <div class="form-group">
                            <input type="text" id="dosificacion_leyenda5" name="dosificacion_leyenda5" value="<?php echo ($this->input->post('dosificacion_leyenda5') ? $this->input->post('dosificacion_leyenda5') : $dosificacion['dosificacion_leyenda5']); ?>" class="form-control"/>
<!--                            <input type="hidden" id="dosificacion_leyenda5_select" name="dosificacion_leyenda5_select" value="<?php echo ($this->input->post('dosificacion_leyenda5') ? $this->input->post('dosificacion_leyenda5') : $dosificacion['dosificacion_leyenda5']); ?>" class="form-control"/>
                            <select name="dosificacion_leyenda5" id="dosificacion_leyenda5" class="form-control" size='1'></select>-->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="tipofac_codigo" class="control-label">Tipo Factura </label>
                        <div class="form-group">
                            <select name="tipofac_codigo" id="tipofac_codigo" class="form-control">
                                <option value="">- Tipo Factura/Documento Ajuste -</option>
                                <?php 
                                    foreach($all_tipoFact as $tipoFact)
                                    {
                                        $selected = ($tipoFact['tipofac_codigo'] == $dosificacion['tipofac_codigo']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$tipoFact['tipofac_codigo'].'" '.$selected.'>'.$tipoFact['tipofac_codigo'].' - '.$tipoFact['tipofac_descripcion'].'</option>';
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="docsec_codigoclasificador" class="control-label">Documento Sector</label>
                        <div class="form-group">
                            <select name="docsec_codigoclasificador" id="docsec_codigoclasificador" class="form-control" onchange="mensaje_alerta()">
                                <option value="">- Documento Sector -</option>
                                <?php 
                                    foreach($all_documentosector as $docsector)
                                    {
                                        $selected = ($docsector['docsec_codigoclasificador'] == $dosificacion['docsec_codigoclasificador']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$docsector['docsec_codigoclasificador'].'" '.$selected.'>'.$docsector['docsec_codigoclasificador']."-".$docsector['docsec_descripcion'].'</option>';
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_tokendelegado" class="control-label">Token Delegado</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_tokendelegado" value="<?php echo ($this->input->post('dosificacion_tokendelegado') ? $this->input->post('dosificacion_tokendelegado') : $dosificacion['dosificacion_tokendelegado']); ?>" class="form-control" id="dosificacion_tokendelegado" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_ambiente" class="control-label">Ambiente (1 Produccion/2 Pruebas)</label>
                        <div class="form-group">
                            <!--<input type="text" name="dosificacion_ambiente" value="<?php echo ($this->input->post('dosificacion_ambiente') ? $this->input->post('dosificacion_ambiente') : $dosificacion['dosificacion_ambiente']); ?>" class="form-control" id="dosificacion_ambiente" />-->
                            
                            
                            <select name="dosificacion_ambiente" id="dosificacion_ambiente" class="form-control"">
                                <option value="0">- Ambiente -</option>
                                <option value="1" <?= ($dosificacion['dosificacion_ambiente']==1)?"selected":"";  ?> >PRODUCCION</option>
                                <option value="2" <?= ($dosificacion['dosificacion_ambiente']==2)?"selected":"";  ?> >PRUEBAS</option>                     
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_cuis" class="control-label">CUIS (Código Único de Inicio de Sistemas)</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_cuis" value="<?php echo ($this->input->post('dosificacion_cuis') ? $this->input->post('dosificacion_cuis') : $dosificacion['dosificacion_cuis']); ?>" class="form-control" id="dosificacion_cuis" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_cufd" class="control-label">CUFD (Código Único de Facturación Diaria)</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_cufd" value="<?php echo ($this->input->post('dosificacion_cufd') ? $this->input->post('dosificacion_cufd') : $dosificacion['dosificacion_cufd']); ?>" class="form-control" id="dosificacion_cufd" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_modalidad" class="control-label">Modalidad (1-Electronica E.L /2-Computarizada E.L.)</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_modalidad" value="<?php echo ($this->input->post('dosificacion_modalidad') ? $this->input->post('dosificacion_modalidad') : $dosificacion['dosificacion_modalidad']); ?>" class="form-control" id="dosificacion_modalidad" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_codsistema" class="control-label">Cod. Sistema</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_codsistema" value="<?php echo ($this->input->post('dosificacion_codsistema') ? $this->input->post('dosificacion_codsistema') : $dosificacion['dosificacion_codsistema']); ?>" class="form-control" id="dosificacion_codsistema" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_puntoventa" class="control-label">Punto de Venta</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_puntoventa" value="<?php echo ($this->input->post('dosificacion_puntoventa') ? $this->input->post('dosificacion_puntoventa') : $dosificacion['dosificacion_puntoventa']); ?>" class="form-control" id="dosificacion_puntoventa" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_sectoreconomico" class="control-label">Sector Economico</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_sectoreconomico" value="<?php echo ($this->input->post('dosificacion_sectoreconomico') ? $this->input->post('dosificacion_sectoreconomico') : $dosificacion['dosificacion_sectoreconomico']); ?>" class="form-control" id="dosificacion_sectoreconomico" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_email" class="control-label">Correo Electrónico</label>
                        <div class="form-group">
                            <input type="email" name="dosificacion_email" value="<?php echo ($this->input->post('dosificacion_email') ? $this->input->post('dosificacion_email') : $dosificacion['dosificacion_email']); ?>" class="form-control" id="dosificacion_email" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_cafc" class="control-label">CAFC</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_cafc" value="<?php echo ($this->input->post('dosificacion_cafc') ? $this->input->post('dosificacion_cafc') : $dosificacion['dosificacion_cafc']); ?>" class="form-control" id="dosificacion_cafc" />
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="estado_id" class="control-label">Estado</label>
                        <div class="form-group">
                            <select name="estado_id" class="form-control">
                                <?php 
                                foreach($all_estado as $estado)
                                {
                                    $selected = ($estado['estado_id'] == $dosificacion['estado_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3">
                        <label for="dosificacion_sincronizacion" class="control-label">Sincronizacion</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_sincronizacion" value="<?php echo ($this->input->post('dosificacion_sincronizacion') ? $this->input->post('dosificacion_sincronizacion') : $dosificacion['dosificacion_sincronizacion']); ?>" class="form-control" id="dosificacion_sincronizacion" />
                        </div>
                    </div>                                                            
                    
                    <div class="col-md-3">
                        <label for="dosificacion_recepcioncompras" class="control-label">Recepcion Compras</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_recepcioncompras" value="<?php echo ($this->input->post('dosificacion_recepcioncompras') ? $this->input->post('dosificacion_recepcioncompras') : $dosificacion['dosificacion_recepcioncompras']); ?>" class="form-control" id="dosificacion_recepcioncompras" />
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_operaciones" class="control-label">Operaciones</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_operaciones" value="<?php echo ($this->input->post('dosificacion_operaciones') ? $this->input->post('dosificacion_operaciones') : $dosificacion['dosificacion_operaciones']); ?>" class="form-control" id="dosificacion_operaciones" />
                        </div>
                    </div>                    
                    
                    <div class="col-md-3">
                        <label for="dosificacion_obtencioncodigos" class="control-label">Obtencion Códigos</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_obtencioncodigos" value="<?php echo ($this->input->post('dosificacion_obtencioncodigos') ? $this->input->post('dosificacion_obtencioncodigos') : $dosificacion['dosificacion_obtencioncodigos']); ?>" class="form-control" id="dosificacion_obtencioncodigos" />
                        </div>
                    </div>                    
                    
                    <div class="col-md-3">
                        <label for="dosificacion_notacredito" class="control-label">Nota de Conciliacion/Credito-Debito</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_notacredito" value="<?php echo ($this->input->post('dosificacion_notacredito') ? $this->input->post('dosificacion_notacredito') : $dosificacion['dosificacion_notacredito']); ?>" class="form-control" id="dosificacion_notacredito" />
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3">
                        <label for="dosificacion_factura" class="control-label">Factura</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_factura" value="<?php echo ($this->input->post('dosificacion_factura') ? $this->input->post('dosificacion_factura') : $dosificacion['dosificacion_factura']); ?>" class="form-control" id="dosificacion_factura" />
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3">
                            <label for="dosificacion_facturaservicios" class="control-label">Factura Servicios</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_facturaservicios" value="<?php echo ($this->input->post('dosificacion_facturaservicios') ? $this->input->post('dosificacion_facturaservicios') : $dosificacion['dosificacion_facturaservicios']); ?>" class="form-control" id="dosificacion_facturaservicios" />
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-md-3">
                        <label for="dosificacion_facturaglp" class="control-label">Factura Comercializacion GN/GLP/PREV/HOSP-CLIN/HOT/EDUC</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_facturaglp" value="<?php echo ($this->input->post('dosificacion_facturaglp') ? $this->input->post('dosificacion_facturaglp') : $dosificacion['dosificacion_facturaglp']); ?>" class="form-control" id="dosificacion_facturaglp" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_glpelectronica" class="control-label">Factura Comercializacion Electronica GN/GLP/PREV/HOSP-CLIN/HOT/EDUC</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_glpelectronica" value="<?php echo ($this->input->post('dosificacion_glpelectronica') ? $this->input->post('dosificacion_glpelectronica') : $dosificacion['dosificacion_glpelectronica']); ?>" class="form-control" id="dosificacion_glpelectronica" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_telecomunicaciones" class="control-label">Factura Telecomunicaciones</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_telecomunicaciones" value="<?php echo ($this->input->post('dosificacion_telecomunicaciones') ? $this->input->post('dosificacion_telecomunicaciones') : $dosificacion['dosificacion_telecomunicaciones']); ?>" class="form-control" id="dosificacion_telecomunicaciones" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dosificacion_entidadesfinancieras" class="control-label">Factura Entidades Financieras</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_entidadesfinancieras" value="<?php echo ($this->input->post('dosificacion_entidadesfinancieras') ? $this->input->post('dosificacion_entidadesfinancieras') : $dosificacion['dosificacion_entidadesfinancieras']); ?>" class="form-control" id="dosificacion_entidadesfinancieras" />
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_ruta" class="control-label">Ruta QR</label>
                        <div class="form-group">
                            <input type="text" name="dosificacion_ruta" value="<?php echo ($this->input->post('dosificacion_ruta') ? $this->input->post('dosificacion_ruta') : $dosificacion['dosificacion_ruta']); ?>" class="form-control" id="dosificacion_ruta" />
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3">
                            <label for="dosificacion_contenedorp12" class="control-label">Certificado Contenedor p12</label>
                            <div class="form-group">
                                <input style="text-align: left !important" type="file" name="dosificacion_contenedorp12" value="<?php echo ($this->input->post('dosificacion_contenedorp12') ? $this->input->post('dosificacion_contenedorp12') : $dosificacion['dosificacion_contenedorp12']); ?>" class=" btn btn-success btn-sm form-control" id="dosificacion_contenedorp12" accept=".p12" />
                                    <input type="hidden" name="dosificacion_contenedorp121" value="<?php echo ($this->input->post('dosificacion_contenedorp12') ? $this->input->post('dosificacion_contenedorp12') : $dosificacion['dosificacion_contenedorp12']); ?>" class="form-control" id="dosificacion_contenedorp121" />
                            </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dosificacion_clavep12" class="control-label">Clave p12</label>
                        <div class="form-group">
                            <input type="password" name="dosificacion_clavep12" value="<?php echo ($this->input->post('dosificacion_clavep12') ? $this->input->post('dosificacion_clavep12') : $dosificacion['dosificacion_clavep12']); ?>" class="form-control" id="dosificacion_clavep12" />
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="cambiar_endpoints" class="control-label">Ambiente (1 Produccion/2 Pruebas)</label>
                        <div class="form-group">
                            
                            <select name="cambiar_endpoints" id="cambiar_endpoints" class="form-control"">
                                <option value="0">- No Cambiar -</option>
                                <option value="1">CAMBIAR A PRODUCCION</option>
                                <option value="2">CAMBIAR A PRUEBAS</option>                     
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
		        </button>
                <a href="<?php echo site_url('dosificacion'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar
                </a>
            </div>				
        <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    window.onload = ()=>{
        get_leyendas();
    }
    
    function mostrar_loader(){
        $('#gif_loader').css('display','block');
    }

    function sincronizar_datos(){
        let base_url = $('#base_url').val();
        let controlador = `${base_url}dosificacion/sincronizarCodigosYCatalogos`;

        $.ajax({
            url: controlador,
            type: 'POST',
            async: false,
            success: (respuesta )=>{
                let res = respuesta;
                if (res == "ok") {
                    $("#gif_loader").css('display','none')
                    alert("SINCRONIZACION EXITOSA")
                    // location.reload();
                }else{
                    $("#gif_loader").css('display','none')
                    alert("NO SE PUDO COMPLETAR LA SINCRONIZACION CON IMPUESTOS");
                }
            },
            error:()=>{
                alert("algo salio mal");
            }
        });
    }

    function get_leyendas(){
        let base_url = $('#base_url').val();
        let actividadPrincipal = $('#actividad_1').val();
        let actividadSecundaria = $('#actividad_2').val();
        let controlador = `${base_url}dosificacion/get_leyendas_por_actividad`;
        $.ajax({
            url: controlador,
            type: 'POST',
            data: {
                actividadPrincipal : actividadPrincipal,
                actividadSecundaria : actividadSecundaria
            },
            success: (respuesta) => {
                let leyendas = JSON.parse(respuesta);

//                let dosificacion_leyenda1_select = $('#dosificacion_leyenda1_select').val();
                let dosificacion_leyenda2_select = $('#dosificacion_leyenda2_select').val();
//                let dosificacion_leyenda3_select = $('#dosificacion_leyenda3_select').val();
//                let dosificacion_leyenda4_select = $('#dosificacion_leyenda4_select').val();
//                let dosificacion_leyenda5_select = $('#dosificacion_leyenda5_select').val();
                
//                let htmlLeyenda1 = getHtmlLeyenda(leyendas, dosificacion_leyenda1_select);
                let htmlLeyenda2 = getHtmlLeyenda(leyendas, dosificacion_leyenda2_select);
//                let htmlLeyenda3 = getHtmlLeyenda(leyendas, dosificacion_leyenda3_select);
//                let htmlLeyenda4 = getHtmlLeyenda(leyendas, dosificacion_leyenda4_select);
//                let htmlLeyenda5 = getHtmlLeyenda(leyendas, dosificacion_leyenda5_select);

//                $("#dosificacion_leyenda1").html(htmlLeyenda1); 
                $("#dosificacion_leyenda2").html(htmlLeyenda2); 
//                $("#dosificacion_leyenda3").html(htmlLeyenda3); 
//                $("#dosificacion_leyenda4").html(htmlLeyenda4); 
//                $("#dosificacion_leyenda5").html(htmlLeyenda5); 
            },
            error: () => {
                alert('Error: no se obtuvieron las leyendas de esas actividades')
            }
        });
    }

    function getHtmlLeyenda(leyendas, dosificacion_leyenda_select){
        let html = `<option value="">NINGUNA</option>`;
        let selected  = "";
        // console.log(dosificacion_leyenda_select)
        leyendas.map( leyenda => {
            selected = leyenda.leyenda_descripcion == dosificacion_leyenda_select ? "selected" : "";
            html += `<option value="${leyenda.leyenda_descripcion}" ${selected}>${leyenda.leyenda_codigoactividad} ${leyenda.leyenda_descripcion}</option>`
        });

        return html;
    }

    function set_actividad(actividad){
        let input_actividad;
        let select_actividad;
        if(actividad === 1){
            input_actividad = 'actividad_1';
            select_actividad = 'dosificacion_actividad';
        }else{
            input_actividad = 'actividad_2';
            select_actividad = 'dosificasion_actividadsec';
        }
        let set_actividad = $(`#${select_actividad}`).val();
        $(`#${input_actividad}`).val(set_actividad);
    }
    
    function mensaje_alerta(){
        
        let documento_sector = document.getElementById("docsec_codigoclasificador").value;
        //alert(documento_sector);
        if (documento_sector==8||documento_sector==6){
            alert("ADVERTENCIA: Este documento es SIN DERECHO A CREDITO FISCAL.\nDebe modificar el Tipo Factura/Documento Ajuste a TIPO 2");
            document.getElementById("tipofac_codigo").style = "background: yellow;";
            document.getElementById("tipofac_codigo").value = 2;
            $("#tipofac_codigo").focus();
        }
        if (documento_sector==24){
            alert("ADVERTENCIA: Este documento es DE AJUSTE.\nDebe modificar el Tipo Factura/Documento Ajuste a TIPO 3");
            document.getElementById("tipofac_codigo").style = "background: yellow;";
            document.getElementById("tipofac_codigo").value = 3;
            $("#tipofac_codigo").focus();
        }        
            
        if (documento_sector!=6 && documento_sector!=8 && documento_sector!=24){
            
            alert("ADVERTENCIA: Este documento es CON DERECHO A CREDITO FISCAL.\nDebe modificar el Tipo Factura/Documento Ajuste a TIPO 1");
            document.getElementById("tipofac_codigo").style = "background: yellow;";           
            document.getElementById("tipofac_codigo").value = 1;
            $("#tipofac_codigo").focus();
            
        }
        
    }
    
</script>

