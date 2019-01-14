<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title"><b>Resultados de la Búsqueda</b></h3><br>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese detalle, codigo..">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
						<th>Detalle</th>
						<th>Codigo</th>
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
						<th>Acuenta</th>
						<th>Saldo</th>
						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
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
						<td><?php if($d['catserv_id']<>0){echo $d['catserv_descripcion'].'/';} if($d['subcatserv_id']<>0){$d['subcatserv_descripcion'];} ?></td>
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
						<label for="detalleserv_insumo" class="control-label">Datos Adicionales</label>
						<div class="form-group">
							<input type="text" name="detalleserv_insumo" value="<?php echo $d['detalleserv_insumo']; ?>" class="form-control" id="detalleserv_insumo" />
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
                                                      <a href="<?php echo site_url('servicio/anulardetalle/'.$servicio['servicio_id'].'/'.$d['detalleserv_id']); ?>" class="btn btn-danger"><span class="fa fa-pencil"></span> Si </a>
                                                      <a href="#" class="btn btn-success" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
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
                                               <tr>
                                                   <td><b>Saldo a Cobrar Bs.</b></td>
                                                   <td id="alinear"><b><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></b></td>
                                               </tr>
                                               <tr style="font-size: 20px; ">
                                                   <td><b>Cobrar Bs.:</b></td>
                                                   <td><input type="number" step="any" min="0" value="<?php echo $d['detalleserv_saldo']; ?>" name="cobro_detalle" id="cobro_detalle" /></td>
                                               </tr>
                                           </table>
                                                   <input type="hidden" name="detalleserv_total" id="detalleserv_total" value="<?php echo $d['detalleserv_total']; ?>">
                                                   <input type="hidden" name="detalleserv_saldo" id="detalleserv_saldo" value="<?php echo $d['detalleserv_saldo']; ?>">
                                                   <input type="hidden" name="detalleserv_acuenta" id="detalleserv_acuenta" value="<?php echo $d['detalleserv_acuenta']; ?>">
                                                   <input type="hidden" name="detalleserv_id" id="detalleserv_id" value="<?php echo $d['detalleserv_id']; ?>">
                                           </div>

                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                              <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-money"></i> Cobrar
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
                                    <!-- ---------------------- FIN modal para Cobrar un detalle de un Servicio ----------------- -->

                            <a class="btn btn-info btn-xs" href="<?php echo site_url('servicio/serview/'.$d['servicio_id']);?>" ><span class="fa fa-eye"></span><br></a>
                            
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
            <div style="float: right">
                <center>

                    <a href="<?php echo site_url('servicio/index'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>
                </center>
            </div>
            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>                    
            </div>
            
        </div>
    </div>
</div>


     