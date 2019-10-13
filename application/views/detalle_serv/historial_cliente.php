<!--<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/servicio_historialcliente.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!--<input type="hidden" name="esteservicio_id" id="esteservicio_id" value="<?php //echo $servicio['servicio_id']; ?>" />-->
<input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $cliente_id; ?>" />
<input type="hidden" name="all_categoria_trabajo" id="all_categoria_trabajo" value='<?php echo json_encode($all_categoria_trabajo); ?>' />
<input type="hidden" name="all_procedencia" id="all_procedencia" value='<?php echo json_encode($all_procedencia); ?>' />
<input type="hidden" name="all_tiempo_uso" id="all_tiempo_uso" value='<?php echo json_encode($all_tiempo_uso); ?>' />
<input type="hidden" name="all_categoria_servicio" id="all_categoria_servicio" value='<?php echo json_encode($all_categoria_servicio); ?>' />
<input type="hidden" name="all_subcategoria_servicio" id="all_subcategoria_servicio" value='<?php echo json_encode($all_subcategoria_servicio); ?>' />
<input type="hidden" name="all_responsable" id="all_responsable" value='<?php echo json_encode($all_responsable); ?>' />
<input type="hidden" name="parametro" id="parametro" value='<?php echo json_encode($parametro); ?>' />
<style type="text/css">
/*    #tamtex{ font-size: 0.1em; }*/
    #recepcion{ background-color: #FFFF33; font-size: small; }
    #entrega{ background-color: #00FF33; font-size: small; }
    #terminado{ background-color: #5C6BC0; font-size: small; }
    #entregado{ background-color: #31b0d5; font-size: small; }
    #alinear{ text-align: right; }
    #numeracion{ text-align: right; }
    #horizontal{ white-space: nowrap; }
    #masgrande{ font-size: 20px; }
    #estilo_div{
  background:#F0F5F0;
  border:solid 10px #F0F5F0;
  border-radius:15px; 
  /*box-shadow: 8px 8px 10px 0px #818181;*/
/*  height:100px;
  width:250px;*/
}
</style>
<!----------------------------- script buscador --------------------------------------->
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
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<script>
        $(document).ready(function() {


        });
        
        function fetch_select(id_cat){

                var parametros = {
                    catserv_id:id_cat
                };

                $.ajax({
                    data:  parametros,
                    url:   '<?php echo base_url('servicio/fetch_data')?>',
                    type:  'post',
                    
                    success:  function (response) {
                       
                    var results = JSON.parse(response);
                var subcat = "";
                $.each(results, function(index, value) {
                    
                     subcat = subcat+'<option value="'+value.subcatserv_id+'">'+
                            value.subcatserv_descripcion+
                            '</option>';

                });
                    subcat = "<select name='subcatserv_id' class='form-control' id='subcatserv_id' onchange='ponerdescripcion(this.value)'>"+
                            subcat+"</select>"
                    $('#subcatserv_id' ).replaceWith(''+subcat);
                    }
                    
                });
                }
                
function ponerdescripcion(catserv){
         //$('#catserv_id').val();
         $('#subcatserv_id').val();
         $('#detalleserv_descripcion').val($('#catserv_id option:selected').text()+' '+$('#subcatserv_id option:selected').text());
         $('#detalleserv_descripcion').focus();
         }
    </script>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box-header">
    <h3 class="box-title">Historial de: <b><?php if(isset($cliente)){ echo $cliente['cliente_nombre'];} ?></b></h3>

</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el producto, precio, código">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                 <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Detalle</th>
                        <th>Código</th>
                        <th>Categoria/<br>Subcategoria</th>
                        <th>Tipo<br>Trabajo</th>
                        <th>Finalizado</th>
                        <th>Entregado</th>
                        <th>Estado</th>
                        <th>Informe</th>
                        <th>Peso<br>(Gr.)</th>
                        <th>Insumo</th>
                        <th>Datos<br>Adicionales</th>
                        <th>Total</th>
                        <th>A. C.</th>
                        <th>Saldo</th>
						
                    </tr>
                    <tbody class="buscar" id="detallekardex">
                    <?php /*
                         $i = 1;
                         $total = 0; $acuenta = 0;
                         $saldo = 0; $cont = 0;
                         $band = true;
                         foreach($detalle_serv as $d){
                             $total = $total + $d['detalleserv_total'];
                             $acuenta = $acuenta + $d['detalleserv_acuenta'];
                             $saldo = $saldo + $d['detalleserv_saldo'];
                             $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?>
                        </td>
                        <td id="horizontal"> <?php 
                                  echo '<font size="1">'.$d['detalleserv_descripcion'].'</font><br>';
                                  echo '<font size="1"><b>Tec.: </b>'.$d['responsable_nombres'].'</font><br>';
                                  echo '<font size="1"><b>Reg.: </b>'.$d['usuario_nombre'].'</font><br>';
                                  echo '<font size="1"><b>Entrega: </b>'; echo date('d/m/Y', strtotime($d['detalleserv_fechaentrega'])) ; echo ' <b>Hrs.: </b>'.$d['detalleserv_horaentrega'].'</font>';
                            ?>
                        </td>
                        <td><?php if($band){ ?>
                            <a class="btn btn-success btn-foursquarexs" data-toggle="modal" data-target="#modaldetalle<?php echo $i; ?>" ><span class="fa fa-plus-circle"></span><br><small><?php echo $d['detalleserv_codigo']; ?></small></a>
                            <!-- ---------------------- Inicio modal para registrar Nuevo Detalle de Servicio con información ----------------- -->
    <div style="font-size: 10pt" class="modal fade" id="modaldetalle<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modaldetalleLabel">
      <div class="modal-dialog modal-lg" role="document">
            <br><br>
        <div class="modal-content">
            <div class="modal-header">
                <label>Producto:<?php echo $d['detalleserv_codigo']; ?> Registrar al Servicio N° <?php echo $servicio['servicio_id'] ?></label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <?php
            echo form_open('detalle_serv/nuevodetalle1/'.$servicio['servicio_id']);
            ?>
            <div class="modal-body">
            <!------------------------------------------------------------------->
                <div class="col-md-3    ">
                    <label for="detalleserv_reclamo" class="control-label">¿Reclamo?</label>
                        <div class="form-group">
                            <?php
                            if($d['detalleserv_reclamo']=="si")
                                $checked = "checked";
                            else $checked ="";
                            ?>
                            <input type="checkbox" name="detalleserv_reclamo" id="detalleserv_reclamo" value="si" <?php echo $checked; ?> />
                        </div>
                </div>
                <div class="col-md-3">
                    <label for="cattrab_id" class="control-label">Tipo de Trabajo</label>
                    <div class="form-group">
                        <select name="cattrab_id" class="form-control" id="cattrab_id">
                            <!--<option value="">- TIPO TRABAJO -</option>-->
                            <?php
                            foreach($all_categoria_trabajo as $cat_trabajo)
                            {
                                $selected = ($cat_trabajo['cattrab_id'] == $d['cattrab_id']) ? ' selected="selected"' : "";
                                echo '<option value="'.$cat_trabajo['cattrab_id'].'" '.$selected.'>'.$cat_trabajo['cattrab_descripcion'].'</option>';
                            } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="procedencia_id" class="control-label">Procedencia</label>
                    <div class="form-group">
                        <select name="procedencia_id" class="form-control" id="procedencia_id">
                            <!--<option value="">- PROCEDENCIA -</option>-->
                            <?php
                            foreach($all_procedencia as $procedencia)
                            {
                                $selected = ($procedencia['procedencia_id'] == $d['procedencia_id']) ? ' selected="selected"' : "";
                                echo '<option value="'.$procedencia['procedencia_id'].'" '.$selected.'>'.$procedencia['procedencia_descripcion'].'</option>';
                            } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="tiempouso_id" class="control-label">Tiempo de uso</label>
                    <div class="form-group">
                        <select name="tiempouso_id" class="form-control" id="tiempouso_id">
                            <!--<option value="">- TIEMPO DE USO -</option>-->
                            <?php
                            foreach($all_tiempo_uso as $tiempouso)
                            {
                                $selected = ($tiempouso['tiempouso_id'] == $d['tiempouso_id']) ? ' selected="selected"' : "";
                                echo '<option value="'.$tiempouso['tiempouso_id'].'" '.$selected.'>'.$tiempouso['tiempouso_descripcion'].'</option>';
                            } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="catserv_id" class="control-label">Categoria Producto</label>
                    <div class="form-group">
                        <select name="catserv_id" class="form-control" onchange="fetch_select(this.value);" id="catserv_id">
                            <!--<option value="">- CATEGORIA -</option>-->
                            <?php
                            foreach($all_categoria_servicio as $categoria_servicio)
                            {
                                $selected = ($categoria_servicio['catserv_id'] == $d['catserv_id'] ) ? ' selected="selected"' : "";
                                echo '<option value="'.$categoria_servicio['catserv_id'].'" '.$selected.'>'.$categoria_servicio['catserv_descripcion'].'</option>';
                            } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="subcatserv_id" class="control-label">Marca/Modelo</label>
                    <div class="form-group" id="new_select">
                        <select name="subcatserv_id" class="form-control" id="subcatserv_id" onchange="ponerdescripcion(this.value);">
                            <?php
                                foreach($all_subcategoria_servicio as $subcategoria_servicio)
                                {
                                    if($subcategoria_servicio['subcatserv_id'] == $d['subcatserv_id']){
                                        echo '<option value="'.$subcategoria_servicio['subcatserv_id'].'" selected="selected" >'.$subcategoria_servicio['subcatserv_descripcion'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
                    <div class="form-group">
                        <input type="text" name="detalleserv_descripcion" value="<?php echo $d['detalleserv_descripcion']; ?>" class="form-control" id="detalleserv_descripcion" required onKeyUp="this.value = this.value.toUpperCase();" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="detalleserv_falla" class="control-label"><span class="text-danger">*</span>Problema/Falla Segun Cliente</label>
                    <div class="form-group">
                        <input type="text" name="detalleserv_falla" value="<?php echo $d['detalleserv_falla']; ?>" class="form-control" id="detalleserv_falla" required onKeyUp="this.value = this.value.toUpperCase();" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="detalleserv_diagnostico" class="control-label">Diagnóstico</label>
                    <div class="form-group">
                        <input type="text" name="detalleserv_diagnostico" value="<?php if($d['detalleserv_diagnostico'] == null){ echo $parametro['parametro_diagnostico']; }else{ echo $d['detalleserv_diagnostico'];} ?>" class="form-control" id="detalleserv_diagnostico" onKeyUp="this.value = this.value.toUpperCase();" onclick="this.select();" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_solucion" class="control-label">Solución</label>
                    <div class="form-group">
                        <input type="text" name="detalleserv_solucion" value="<?php if($d['detalleserv_solucion'] == null){ echo $parametro['parametro_solucion']; }else{ echo $d['detalleserv_solucion'];} ?>" class="form-control" id="detalleserv_solucion" onKeyUp="this.value = this.value.toUpperCase();" onclick="this.select();" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_pesoentrada" class="control-label">Peso Entrada(Gr.)</label>
                    <div class="form-group">
                        <input type="number" step="any" min="0" name="detalleserv_pesoentrada" value="<?php echo number_format($d['detalleserv_pesoentrada'],'2','.',','); ?>" class="form-control" id="detalleserv_pesoentrada" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_glosa" class="control-label">Datos Adicionales</label>
                    <div class="form-group">
                        <input type="text" name="detalleserv_glosa" value="<?php echo $d['detalleserv_glosa']; ?>" class="form-control" id="detalleserv_glosa" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_total" class="control-label">Total</label>
                    <div class="form-group">
                        <input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_total" value="<?php echo number_format($d['detalleserv_total'],'2','.',','); ?>" class="form-control" id="detalleserv_total" onclick='this.select();' />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_acuenta" class="control-label">A cuenta</label>
                    <div class="form-group">
                        <input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_acuenta" value="<?php echo number_format($d['detalleserv_acuenta'],'2','.',','); ?>" class="form-control" id="detalleserv_acuenta" onclick='this.select();' />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_saldo" class="control-label">Saldo</label>
                    <div class="form-group">
                    <input style="background-color: #ffeebc;" type="number" step="any" min="0" name="detalleserv_saldo" value="<?php echo number_format($d['detalleserv_saldo'],'2','.',','); ?>" class="form-control" id="detalleserv_saldo" readonly onclick='this.select();' />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_fechaentrega" class="control-label">Fecha Entrega</label>
                    <div class="form-group">
                        <input type="date" name="detalleserv_fechaentrega" value="<?php $maniana = time()+(24*60*60); echo date('Y-m-d', $maniana); ?>" class="form-control" id="detalleserv_fechaentrega" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="detalleserv_horaentrega" class="control-label">Hora Entrega</label>
                    <div class="form-group">
                        <input type="time" name="detalleserv_horaentrega" value="<?php echo date('H:i'); ?>" class="form-control" id="detalleserv_horaentrega" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="responsable_id" class="control-label"><span class="text-danger">*</span>Tec. Responsable</label>
                    <div class="form-group">
                        <select name="responsable_id" class="form-control" id="responsable_id" required>
                            <!--<option value="">- RESPONSABLE -</option>-->
                            <?php 
                            foreach($all_responsable as $responsable)
                            {
                                $selected = ($responsable['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";
                                echo '<option value="'.$responsable['usuario_id'].'" '.$selected.'>'.$responsable['usuario_nombre'].'</option>';
                            } 
                            ?>
                        </select>
                    </div>
                </div>
                <!-- <input type="hidden" name="estado_id" value="5" class="form-control" id="estado_id" />
                <input type="hidden" name="usuario_id" value="<?php //echo $usuario_id ?>" class="form-control" id="usuario_id" /> -->
                <input type="hidden" name="servicio_id" value="<?php echo $servicio['servicio_id'] ?>" class="form-control" id="servicio_id" />
                <input type="hidden" name="detalleserv_codigo" value="<?php echo $d['detalleserv_codigo'] ?>" class="form-control" id="detalleserv_codigo" />
		
           <!------------------------------------------------------------------->
          </div>
          <div class="modal-footer aligncenter">
              <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
              </button>
<!--                                              <a href="<?php // echo site_url('cliente/add_new'); ?>" type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Guardar
              </a>-->
              <a href="#" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancelar</a>
          </div>
            <?php echo form_close(); ?>
        </div>
      </div>
    </div>
<!-- ---------------------- Fin modal para registrar Nuevo Detalle de Servicio con información ----------------- -->

                        <?php }else{ echo $d['detalleserv_codigo']; }?>
                        </td>
                        <td><?php echo $d['catserv_descripcion']; ?></td>
                        <td><?php if(isset($d['detalleserv_fechaterminado'])){ echo date('d/m/Y', strtotime($d['detalleserv_fechaterminado'])).' <br>'.date('H:i:s', strtotime($d['detalleserv_horaterminado']));}  ?></td>
                        <td><?php if(isset($d['detalleserv_fechaentregado'])){ echo date('d/m/Y', strtotime($d['detalleserv_fechaentregado'])).' <br>'.date('H:i:s', strtotime($d['detalleserv_horaentregado']));}  ?></td>
                        <td style="background-color: #<?php echo $d['estado_color']; ?>"><?php echo $d['estado_descripcion']; ?></td>
                        <td id="horizontal"><?php echo '<font size="1"><b>Falla: </b>'.$d['detalleserv_falla'].'<br><b>Diagnostico: </b>'.$d['detalleserv_diagnostico'].'<br><b>Solucion: </b>'.$d['detalleserv_solucion'].'</font>'; ?></td>
                        <td><?php echo $d['detalleserv_insumo']; ?></td>
                        <td><?php echo $d['detalleserv_glosa']; ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_total'],'2','.',',') ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_acuenta'],'2','.',',') ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></td>
                    </tr>
                    <?php $i++; $band = false; } */ ?>
                    </tbody>
                </table>
                            
            </div>
            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>                    
            </div>  
            <div style="float: right">
                <!--<a href="<?php //echo site_url('servicio'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>-->
                <a href="javascript:window.close();" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>
            </div>
        </div>
    </div>
</div>
