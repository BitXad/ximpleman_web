<script src="<?php echo base_url('resources/js/servicio_serview.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="reginftecnico" id="reginftecnico" value="<?php echo $reginftecnico; ?>" />
<input type="hidden" name="asignarinsumos" id="asignarinsumos" value="<?php echo $asignarinsumos; ?>" />
<input type="hidden" name="anulardetalle" id="anulardetalle" value="<?php echo $anulardetalle; ?>" />
<input type="hidden" name="eliminardetalle" id="eliminardetalle" value="<?php echo $eliminardetalle; ?>" />
<input type="hidden" name="cobrardetalle" id="cobrardetalle" value="<?php echo $cobrardetalle; ?>" />
<input type="hidden" name="pasaracreditodeta" id="pasaracreditodeta" value="<?php echo $pasaracreditodeta; ?>" />
<input type="hidden" name="estecliente" id="estecliente" value="<?php echo $cliente["cliente_nombre"]; ?>" />
<input type="hidden" name="tipousuario_id" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>" />

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
<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $("#cobro_detalle").change(function(){
                if($("#cobro_detalle").val() <= $("#este_saldo").val()){
                    $('#cobro_detalle').css('color', 'black');
                }else{
                    $('#cobro_detalle').css('color', 'red');
                    $('#cobro_detalle').focus();
                    alert("El monto a Cobrar no debe exceder los "+ $("#este_saldo").val());
                }
            });
        }(jQuery));
    
    });
    
</script>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box-header with-border">
    <input type="hidden" value="<?php echo $servicio['servicio_id']; ?>" id="esteservicio_id">
    <input type="hidden" value="<?php echo $all_parametro[0]['parametro_tipoimpresora']; ?>" id="tipoimpresora">
    <span hidden="true"><a id="printdetalleserv" target='_blank' ></a></span>
    
    <h3 class="box-title"><b>Detalle del Servicio N°: <?php echo $servicio['servicio_id'] ?></b></h3>
    <div class="container">
        <div class="panel panel-primary col-md-5">
            <h5>
                <b>Cliente: </b><?php if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0)){ echo "NO DEFINIDO";} else{ echo $cliente['cliente_nombre']; } ?><br>
                <b>Código Cliente: </b><?php if(is_null($cliente['cliente_codigo'])){ echo "NO DEFINIDO";} else{ echo $cliente['cliente_codigo']; } ?><br>
                <b>Fecha/Hora: </b><?php if(is_null($servicio['servicio_fecharecepcion'])){ echo "NO DEFINIDO";} else{ echo date('d/m/Y', strtotime($servicio['servicio_fecharecepcion'])); echo '|'.$servicio['servicio_horarecepcion']; } ?><br>
                <b>Registrado por: </b><?php if(is_null($usuario['usuario_id'])){ echo "NO DEFINIDO";} else{ echo $usuario['usuario_nombre']; } ?><br>
                <b>Tipo Servicio: </b><?php if(is_null($servicio['tiposerv_id'])){ echo "NO DEFINIDO";} else{ echo $tipo_servicio['tiposerv_descripcion'];
                                            if($servicio['tiposerv_id'] == 2){
                                              echo "<br><b>Dirección: </b>".$servicio['servicio_direccion'];
                                            } } ?>
            </h5>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
            <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese detalle, código..">
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
						<th></th>
                    </tr>
                    <tbody class="buscar" id="detalleservicio">
                    <?php /*
                         $i = 1;
                         $sumTotal = 0; $sumAcuenta = 0;
                         $sumSaldo = 0; $cont = 0;
                         foreach($detalle_serv as $d){
                             if($d['esteestado'] == 6){
                             $sumTotal = $sumTotal + $d['detalleserv_total'];
                             $sumAcuenta = $sumAcuenta + $d['detalleserv_acuenta'];
                             $sumSaldo = $sumSaldo + $d['detalleserv_saldo'];
                         }
                             $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?>

                                                    
                                                </td>
                                                <td id="horizontal"><?php 
                                                      echo '<font size="1">'.$d['detalleserv_descripcion'].'</font><br>';
                                                      if($d['procedencia_id']<>0){echo '<font size="1"><b>Proc.: </b>'.$d['procedencia_descripcion'].'</font><br>';}
                                                      if($d['tiempouso_id']<>0){echo '<font size="1"><b>T. uso.: </b>'.$d['tiempouso_descripcion'].'</font><br>';}
                                                      if($d['detalleserv_reclamo'] == "si"){$res = "Si";}else{$res = "No"; }
                                                      echo '<font size="1"><b>¿Recl.?: </b>'.$res.'</font><br>';
                                                      echo '<font size="1"><b>Tec.R.: </b>'.$d['responsable_nombres']." ".$d['responsable_apellidos'].'</font><br>';
                                                      echo '<font size="1"><b>Reg.: </b>'.$d['usuario_nombre'].'</font><br>';
                                                      echo '<font size="1"><b>Entrega: </b>'; echo date('d/m/Y', strtotime($d['detalleserv_fechaentrega'])) ; echo ' <b>Hrs.: </b>'.$d['detalleserv_horaentrega'].'</font>';
                                                    ?>
                                                </td>
                                                <td><?php echo $d['detalleserv_codigo']; ?></td>
                                                <td><?php if($d['catserv_id']<>0){echo $d['catserv_descripcion'];} if($d['subcatserv_id']<>0){ echo "/".$d['subcatserv_descripcion'];} ?></td>
                                                <td><?php if($d['cattrab_id']<>0){echo $d['cattrab_descripcion'];} ?></td>
						<td><?php if(isset($d['detalleserv_fechaterminado'])){ echo date('d/m/Y', strtotime($d['detalleserv_fechaterminado'])).' <br>'.date('H:i:s', strtotime($d['detalleserv_horaterminado']));}  ?></td>
                                                <td><?php if(isset($d['detalleserv_fechaentregado'])){ echo date('d/m/Y', strtotime($d['detalleserv_fechaentregado'])).' <br>'.date('H:i:s', strtotime($d['detalleserv_horaentregado']));}  ?></td>
						<td style="background-color: #<?php echo $d['estado_color']; ?>"><?php echo $d['estado_descripcion']; ?></td>
						<td id="horizontal"><?php echo '<font size="1"><b>Falla: </b>'.$d['detalleserv_falla'].'<br><b>Diagnostico: </b>'.$d['detalleserv_diagnostico'].'<br><b>Solucion: </b>'.$d['detalleserv_solucion'].'</font>'; ?></td>
						<td><?php echo '<font size="1"><b>Entrada: </b>'.$d['detalleserv_pesoentrada'].'</font><br>';
                                                          echo '<font size="1"><b>Salida: </b>'.$d['detalleserv_pesosalida'].'</font>'; ?></td>
						<td><?php echo $d['detalleserv_insumo']; ?></td>
						<td><?php echo $d['detalleserv_glosa']; ?></td>
						<td id="alinear"><?php echo number_format($d['detalleserv_total'],'2','.',',') ?></td>
						<td id="alinear"><?php echo number_format($d['detalleserv_acuenta'],'2','.',',') ?></td>
						<td id="alinear"><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></td>
                                                
                                                
						<td>
                <!-- ---------------------- INICIO modal para Registrar Diagnostico, Solucion, Terminado ----------------- -->
                                    <div class="modal fade" id="modaldst<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <label>Registrar datos a: <?php echo $d['detalleserv_codigo'];?></label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                            <?php
                                            echo form_open('detalle_serv/registrartec/'.$servicio['servicio_id'].'/'.$d['detalleserv_id']);
                                            ?>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           
                                           <div class="col-md-6">
						<label for="detalleserv_diagnostico" class="control-label"><span class="text-danger">*</span>Diagnostico</label>
						<div class="form-group">
							<input type="text" name="detalleserv_diagnostico" value="<?php echo $d['detalleserv_diagnostico']; ?>" class="form-control" id="detalleserv_diagnostico" required />
						</div>
					  </div>
                                          <div class="col-md-6">
						<label for="detalleserv_solucion" class="control-label"><span class="text-danger">*</span>Solución</label>
						<div class="form-group">
                                                    <input type="text" name="detalleserv_solucion" value="<?php echo $d['detalleserv_solucion'];?>" class="form-control" id="detalleserv_solucion" required />
						</div>
					  </div>
                                          <div class="col-md-6">
						<label for="detalleserv_pesosalida" class="control-label">Peso Salida(Gr.)</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="detalleserv_pesosalida" value="<?php echo $d['detalleserv_pesosalida']; ?>" class="form-control" id="detalleserv_pesosalida" />
						</div>
					  </div>
                                          <div class="col-md-6">
						<label for="detalleserv_glosa" class="control-label">Datos Adicionales</label>
						<div class="form-group">
                                                    <textarea rows="5" maxlength="350" name="detalleserv_glosa" class="form-control" id="detalleserv_glosa" ><?php if($d['detalleserv_glosa'] ==null){ echo "# de hojas impresas:"; }else{ echo $d['detalleserv_glosa']; } ?></textarea>
						</div>
					</div>
                                         <!--  <div class="col-md-6">
						<label for="estado_id" class="control-label">¿Terminado?</label>
						<div class="form-group">
                                                    <label><input type="checkbox" name="estado_id" value="6" id="estado_id" />Si</label>
						</div>
					    </div> -->
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
            <!-- ---------------------- FIN modal para Registrar Diagnostico, Solucion, Terminado ----------------- -->
                                                    
                                  <!------------------------ INICIO modal para confirmar Anulacion de un detalle------------------->
                                    <div class="modal fade" id="modalanulardet<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php //echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b><span class="fa fa-minus-circle"></span>¿</b>
                                               Desea Anular este detalle de Servicio con el codigo: <b> <?php echo $d['detalleserv_codigo']; ?>?</b>
                                            </h3>
                                               Al ANULAR este detalle de servicio, sus campos: Total, A cuenta y Saldo seran CERO.
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('servicio/anulardetalle/'.$servicio['servicio_id'].'/'.$d['detalleserv_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
            <!-------------------------------------------------- FIN modal para confirmar Anulacion de un detalle --------------------------------------->
            
            <!-- ---------------------- INICIO modal para Cobrar un detalle de un Servicio ----------------- -->
                                    <div class="modal fade" id="modalpagardetalle<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                              <label>Cobrar de: <?php echo $d['detalleserv_descripcion'].'; Codigo: '; echo $d['detalleserv_codigo']; ?></label>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            </div>
                                            <?php
                                            echo form_open('detalle_serv/registrarcobrodetalle/'.$servicio['servicio_id']);
                                            ?>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <label for="fecha_cobro" class="control-label">FECHA DE COBRO</label>
                                                        <?php
                                                        $fecha = date('Y-m-d');
                                                        $hora = date('H:i:s');
                                                        ?>

                                                        <input type="datetime-local" name="fecha_cobro" value="<?php echo $fecha."T".$hora; ?>" class="form-control" id="fecha_cobro" required />
                                               <div class="box-body">

                                           <table class="table-striped table-condensed" id="cobrototal">
                                               <tr>
                                                   <td>Total Bs.</td>
                                                   <td id="alinear"><?php echo number_format($d['detalleserv_total'],'2','.',',') ?></td>
                                               </tr>
                                               <tr>
                                                   <td>A cuenta Bs.</td>

                                                    <td id="alinear"><?php echo number_format($d['detalleserv_acuenta'],'2','.',',') ?></td>
                                               </tr>
                                               <tr style="font-size: 20px; ">
                                                   <td><b>Saldo a Cobrar Bs.</b></td>
                                                   <td id="alinear"><b><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></b></td>
                                               </tr>
                                           </table>
                                                   <input type="hidden" name="detalleserv_id" id="detalleserv_id" value="<?php echo $d['detalleserv_id']; ?>">
                                           </div>

                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                              <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-money"></i> Cobrar
                                              </button>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <i class="fa fa-times"></i> Cancelar</a>
                                          </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- ---------------------- FIN modal para Cobrar un detalle de un Servicio ----------------- -->
                                    
                                                <!-- ---------------------- INICIO modal para poner en CREDITO un detalle de un Servicio ----------------- -->
                                    <div class="modal fade" id="modalcreditodetalle<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                              <label>Se pondra en Credito el detalle: <?php echo $d['detalleserv_descripcion'].'; Codigo: '; echo $d['detalleserv_codigo']; ?></label>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            </div>
                                            <?php
                                            echo form_open('detalle_serv/registrarcreditodetalle');
                                            ?>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <div class="box-body">

                                           <table class="table-striped table-condensed" id="cobrototal">
                                               <tr>
                                                   <td>Total Bs.</td>
                                                   <td id="alinear"><?php echo number_format($d['detalleserv_total'],'2','.',',') ?></td>
                                               </tr>
                                               <tr>
                                                   <td>A cuenta Bs.</td>

                                                    <td id="alinear"><?php echo number_format($d['detalleserv_acuenta'],'2','.',',') ?></td>
                                               </tr>
                                               <tr>
                                                   <td><b>Saldo a Cobrar Bs.</b></td>
                                                   <td id="alinear"><b><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></b></td>
                                               </tr>
                                           </table>
                                                   <input type="hidden" name="servicio_id" id="servicio_id" value="<?php echo $servicio['servicio_id']; ?>">
                                                   <input type="hidden" name="detalleserv_id" id="detalleserv_id" value="<?php echo $d['detalleserv_id']; ?>">
                                           </div>

                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                              <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-money"></i> Poner en Credito
                                              </button>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <i class="fa fa-times"></i> Cancelar</a>
                                          </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- ---------------------- FIN modal para poner en CREDITO un detalle de un Servicio ----------------- -->

                                    <!------------------------ INICIO modal para confirmar eliminacion de un detalle ------------------->
                                    <div class="modal fade" id="modaleliminardet<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modaleliminarLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b><span class="fa fa-minus-circle"></span>¿</b>
                                               Desea Eliminar el detalle de Servicio con el codigo: <b> <?php echo $d['detalleserv_codigo']; ?>?</b>
                                            </h3>
                                               Al ELIMINAR este detalle de servicio, se perdera toda su información.
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('detalle_serv/removedet/'.$servicio['servicio_id'].'/'.$d['detalleserv_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-------------------------------------------------- FIN modal para confirmar eliminacion de un detalle --------------------------------------->
            
                                    <a class="btn btn-info btn-xs" href="<?php echo site_url('detalle_serv/modificarmidetalle/'.$servicio['servicio_id'].'/'.$d['detalleserv_id']);?>" title="modificar detalle serv.." ><span class="fa fa-pencil"></span><br></a>
                                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#modaldst<?php echo $i; ?>" title="reporte serv. tecnico" ><span class="fa fa-file-text"></span><br></a>
                                    <a class="btn btn-info btn-xs" href="<?php echo site_url('categoria_insumo/verinsumosasignar/'.$servicio['servicio_id'].'/'.$d['detalleserv_id']);?>" title="ver, asignar insumos"><span class="fa fa-file-text-o"></span><br></a>
                            <?php if($d['esteestado'] == 6){ ?>
                                    <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalpagardetalle<?php echo $i; ?>" title="cobrar detalle serv.."><span class="fa fa-money"></span><br></a>
                                    <a class="btn  btn-success btn-xs" data-toggle="modal" data-target="#modalcreditodetalle<?php echo $i; ?>" title="credito detalle serv.." ><span class="fa fa-credit-card"></span><br></a>
                            <?php } ?>
                                    <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalanulardet<?php echo $i; ?>" title="anula detalle serv.." ><span class="fa fa-minus-circle"></span><br></a>
                                    <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modaleliminardet<?php echo $i; ?>" title="eliminar detalle serv.." ><span class="fa fa-trash"></span><br></a>                            
                        </td>
                    </tr>
                    <?php $i++; } */ ?>
                </table>
                                
            </div>
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-body table-responsive table-condensed">
                <table class="table table-striped table-condensed" >
                    <tbody>
                        <!--<tr>
                            <th>Descripción</th>
                            <th>Totales</th>
                        </tr>-->
                        <tr>
                            <td>Total Final</td>
                            <td id="alinear"><span id="totalfinal"><?php echo number_format($servicio['servicio_total'],'2','.',','); ?></span></td>
                        </tr>
                        <tr>
                            <td>A cuenta</td>
                            <td id="alinear"><span id="totalacuenta"><?php echo number_format($servicio['servicio_acuenta'],'2','.',','); ?></span></td>
                        </tr>
                        <tr>
                            <th id="masgrande">Saldo</th>
                            <th id="masgrande" style="text-align: right;"><span id="totalsaldo"><?php echo number_format($servicio['servicio_saldo'],'2','.',','); ?></span></th>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    <div style="float: right">
    <center>
        <?php if($cobrarservicio == 1){ ?>
        <a class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important; " data-toggle="modal" data-target="#modalpagar" onclick="refrescarhora()" ><span class="fa fa-money fa-4x"></span><br>Cobrar Serv..</a>
        <?php }
        if($pasaracredito == 1){ ?>
        <a class="btn btn-sq-lg btn-primary" style="width: 120px !important; height: 120px !important; " data-toggle="modal" data-target="#modalcredito" ><span class="fa fa-credit-card fa-4x"></span><br>Pasar a Credito</a>
        <?php }
        if($anularservicio == 1){ ?>
        <a class="btn btn-sq-lg btn-warning" style="width: 120px !important; height: 120px !important; " data-toggle="modal" data-target="#modalanular" ><span class="fa fa-minus-circle fa-4x"></span><br>Anular Serv..</a>
        <?php } ?>
        <a href="<?php echo site_url('servicio/index'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>
    </center>
</div>
    <?php
    if($a==1)
    {?>
    <script type="text/javascript">
    alert('El Monto ingresado debe ser menor al Saldo');
    </script>
    <?php
    }elseif($a == 2){
    ?>
    <script type="text/javascript">
    alert('El estado Entregado se cambia cuando el saldo  es 0, verifique sus saldos');
    </script>
    <?php } ?>
</div>
<style type="text/css">
    cobrototal{ font-size: 25px;
        
    }
</style>

<!-- ---------------------- INICIO modal para todo el SERVICIO se vaya a CREDITO(solo todos sus detalles TERMINADOS) ----------------- -->
<div class="modal fade" id="modalcredito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
        <br><br>
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        <h3>Se pondra en credito todos los detalles de servicio terminado.</h3>
        </div>
        <?php
        //echo form_open('detalle_serv/registrarcreditototal/'.$servicio['servicio_id']);
        ?>
      <div class="modal-body">
       <!------------------------------------------------------------------->
       <div class="box-body">
               
       <table class="table-striped table-condensed" id="cobrototal">
           <tr>
               <td>Total Final Bs.</td>
               <td id="alinear"><span id="creditototal"><?php echo number_format($sumTotal,'2','.',',') ?></span></td>
           </tr>
           <tr>
               <td>A cuenta Bs.</td>
               
		<td id="alinear"><span id="creditoacuenta"><?php echo number_format($sumAcuenta,'2','.',',') ?></span></td>
           </tr>
           <tr style="font-size: 20px; ">
               <td><b>Saldo a Cobrar Bs.</b></td>
               <td id="alinear"><b><span id="creditosaldo"><?php echo number_format($sumSaldo,'2','.',',') ?></span></b></td>
           </tr>
       </table>
               <!--<input type="hidden" name="servicio_total" id="servicio_total" value="<?php //echo $servicio['servicio_total']; ?>">-->
       </div>
           
       <!------------------------------------------------------------------->
      </div>
      <div class="modal-footer aligncenter">
          <button onclick="creditototalservicio(<?php echo $servicio['servicio_id']; ?>)" class="btn btn-success" data-dismiss="modal">
                <i class="fa fa-money"></i> Poner en Credito
          </button>
          <a href="#" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times"></i> Cancelar</a>
      </div>
        <?php //echo form_close(); ?>
    </div>
  </div>
</div>
<!-- ---------------------- FIN modal para todo el SERVICIO se vaya a CREDITO(solo todos sus detalles TERMINADOS) ----------------- -->

<!-- ---------------------- INICIO modal para Cobrar todo el SERVICIO(solo todos sus detalles TERMINADOS) ----------------- -->
<div class="modal fade" id="modalpagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
        <br><br>
    <div class="modal-content">
        <div class="modal-header text-center"  style="font-size:12pt;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <label>ENTREGA DE SERVICIO</label>
            <br>N° <?php echo $servicio['servicio_id']; ?>
        </div>
        <?php
        //echo form_open('detalle_serv/registrarcobrototal/'.$servicio['servicio_id']);
        ?>
      <div class="modal-body">
       <!------------------------------------------------------------------->
       <div class='text-center text-bold'><span style='font-size: 12pt'><?php echo $cliente['cliente_nombre']; ?></span></div>
       <label for="fecha_cobro" class="control-label">Fecha de Cobro</label>
            <?php
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            ?>
       
        <input type="datetime-local" name="fecha_cobro" value="<?php echo $fecha."T".$hora; ?>" class="form-control" id="fecha_cobro" required />
        <!--<div class="col-md-12">-->
        <br>
        <label for="categoriaclie_porcdesc" class="control-label">Entregado a</label>
        <div class="form-group">
            <input type="text" name="detalleserv_entregadoa" value="<?php echo $cliente['cliente_nombre']; ?>" class="form-control" id="detalleserv_entregadoa" required onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
            <span class="text-danger"><?php echo form_error('detalleserv_entregadoa');?></span>
        </div>
        <!--</div>-->
        <div class="box-body">
               
       <table class="table-striped table-condensed" id="cobrototal">
           <tr>
               <td>Total Final Bs.</td>
               <td id="alinear"><span id="cobrartotal"><?php echo number_format($sumTotal,'2','.',',') ?></span></td>
           </tr>
           <tr>
               <td>A cuenta Bs.</td>
               
		<td id="alinear"><span id="cobraracuenta"><?php echo number_format($sumAcuenta,'2','.',',') ?></span></td>
           </tr>
           <tr style="font-size: 20px; ">
               <td><b>Saldo a Cobrar Bs.</b></td>
               <td id="alinear"><b><span id="cobrarsaldo"><?php echo number_format($sumSaldo,'2','.',',') ?></span></b></td>
           </tr>
       </table>
               <!--<input type="hidden" name="servicio_total" id="servicio_total" value="<?php //echo $servicio['servicio_total']; ?>">-->
       </div>
           
       <!------------------------------------------------------------------->
      </div>
      <div class="modal-footer aligncenter">
          <button onclick="cobrototalservicio(<?php echo $servicio['servicio_id']; ?>)" class="btn btn-success" data-dismiss="modal">
                <i class="fa fa-money"></i> Cobrar
          </button>
          <a href="#" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times"></i> Cancelar</a>
      </div>
        <?php //echo form_close(); ?>
    </div>
  </div>
</div>
<!-- ---------------------- FIN modal para Cobrar todo el SERVICIO(solo todos sus detalles TERMINADOS) ----------------- -->

<!------------------------ INICIO modal para confirmar Anulacion ------------------->
    <div class="modal fade" id="modalanular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php //echo $i; ?>">
      <div class="modal-dialog" role="document">
            <br><br>
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
          </div>
          <div class="modal-body">
           <!------------------------------------------------------------------->
           <h3><b> <span class="fa fa-minus-circle"></span>¿</b>
               Desea Anular todo el Servicio <b> (N°: <?php echo $servicio['servicio_id']; ?>)?</b>
           </h3>
           Al ANULAR este servicio, se anularan todos sus detalles(incluidos Total, A cuenta y Saldo seran CERO).
           <!------------------------------------------------------------------->
          </div>
          <div class="modal-footer aligncenter">
              <button onclick="anulartotalservicio(<?php echo $servicio['servicio_id']; ?>)" class="btn btn-success" data-dismiss="modal">
                 <i class="fa fa-check"></i>Si
              </button>
                      <!--<a href="<?php //echo site_url('servicio/anularserviciodet/'.$servicio['servicio_id']); ?>" class="btn btn-danger"><span class="fa fa-pencil"></span> Si </a>-->
                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
          </div>
        </div>
      </div>
    </div>
            <!------------------------ FIN modal para confirmar Anulacion ------------------->