<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/cuota.js'); ?>" type="text/javascript"></script>

<script src="http://code.jquery.com/jquery-1.0.4.js"></script>

<style type="text/css">
   
.btn:focus, .btn:active:focus, .btn.active:focus {
    outline: 0 none;
}
 
.btn-ale {
    background:  #16a085;
    color:  #ffffff;
}
 
.btn-ale:hover, .btn-ale:focus, .btn-ale:active, .btn-ale.active, .open > .dropdown-toggle.btn-ale {
    background: #45b39d;
    color:  #ffffff;
}
 
.btn-ale:active, .btn-ale.active {
    background:  #ffffff;
    box-shadow:  #ffffff;
}
</style>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<div class="box-header">
    <center>
        <h3 class="box-title" style="font-family: Arial"><b>PLAN DE PAGOS</b></h3>
    </center>
</div>

<table class="table" style="width: 100%; padding: 0; " >
    <tr >
        <td style="width: 25%; padding: 0; line-height:13px;" >
            <font size="2" face="Arial"><b>CLIENTE: </b><?php echo $credito[0]['cliente_nombre']; ?><br>    
                <b>C.I.: </b><?php echo $credito[0]['cliente_ci']; ?><br>
                <?php if ($credito[0]['venta_id']!=0){ echo '<b>VENTA Nro.: </b>'. $credito[0]['venta_id'];}else { echo '<b>SERVICIO Nro.: </b>'.$credito[0]['servicio_id']; } ?><br>
                <b>CREDITO Nro.: </b><?php echo $credito[0]['credito_id']; ?>
                
            </font>
        </td>
        
        <td style="width: 25%; padding: 0; line-height:13px;" > 
        <font size="2" face="Arial">
          <b>FECHA CRÉDITO: </b><?php echo date('d/m/Y',strtotime($credito[0]['credito_fecha'])); ?>  <?php echo $credito[0]['credito_hora']; ?><br>
          <b>FECHA LIMITE: </b><?php echo date('d/m/Y',strtotime($credito[0]['credito_fechalimite'])); ?><br>
          <b>MONTO CRED. <?= $moneda['moneda_descripcion'] ?>: </b><?php echo $credito[0]['credito_monto']; ?><br>
          <b>CUOTAS: </b><?php echo $credito[0]['credito_numpagos']; ?> <b> INTERES: </b><?php echo $credito[0]['credito_interesproc']; ?> %
        </font>
        </td>
</tr>
</table>
<div class="row">
    <div class="col-md-12">
    
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                      <tr>
                                                <th>#</th>
                        
                        <th>Num.<br>Cuota</th>
                        <th>Capital<br><?= $moneda['moneda_descripcion'] ?></th>
                        <th>Interes<br><?= $moneda['moneda_descripcion'] ?></th>
                        <th>Mora<br>Dias</th>
                        <th>Multa<br><?= $moneda['moneda_descripcion'] ?></th>
                        <th>Subtotal<br><?= $moneda['moneda_descripcion'] ?></th>
                        <th>Desc.<br><?= $moneda['moneda_descripcion'] ?></th>
                        <th>Total<br><?= $moneda['moneda_descripcion'] ?></th>
                        <th>Fecha<br>Limite</th>
                        <th>Cancelado<br><?= $moneda['moneda_descripcion'] ?></th>
                        <th>Forma<br>de pago</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Num.<br>recibo</th>
                        <th>Saldo<br><?= $moneda['moneda_descripcion'] ?></th>
                        <th>Glosa</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $i = 1; 
                    $total = 0;
                      $cancelados = 0;
                    $cont = 0;
                    $bandera=0;
                          foreach($cuota as $c){;
                                 $cont = $cont+1;
                                 $subtotal = $c['cuota_total'];
                                 $subcancelados = $c['cuota_cancelado'];
                                 $total = $subtotal + $total;
                                 $cancelados = $subcancelados + $cancelados;
                                 
                                 ?>
                  <tr style="background-color: <?php echo $c['estado_color'];?>" >


<script>
$(document).ready(function(){
  
  function restar(){
    
    var uno, dos, tres, operacion;
  
      uno = $("#cuota_total<?php echo $c['cuota_id']; ?>");
      dos = $("#cuota_cancelado<?php echo $c['cuota_id']; ?>");
      tres = $("#cuota_saldo<?php echo $c['cuota_id']; ?>");
      
      operacion = parseFloat(uno.val()) - parseFloat(dos.val());
      tres.val(Number(operacion).toFixed(2));
    
  }
  
  $("#cuota_total<?php echo $c['cuota_id']; ?>").keyup(function(){
      
      var dos;
      dos = $("#cuota_cancelado<?php echo $c['cuota_id']; ?>").val();
      
      if(dos != ""){
        restar()
      }
      
  });
  
  $("#cuota_cancelado<?php echo $c['cuota_id']; ?>").keyup(function(){
      
      var uno;
      uno = $("#cuota_total<?php echo $c['cuota_id']; ?>").val();
      
      if(uno != ""){
        restar()
      }
      
  });
})
</script>
                    <?php 
                        $color ="";
                        if ($c['estado_id']==9){
                            $color = " style='background-color: gray'";
                          }
                    
                    ?>    
                    
                        <td <?php echo $color; ?>><?php echo $cont ?></td>
                                            
                      <td <?php echo $color; ?>>Cuota <?php echo $c['cuota_numcuota']; ?></td>
                      <td align="right" <?php echo $color; ?>><?php echo number_format($c['cuota_capital'], 2, ".", ","); ?></td>
                      <td align="right" <?php echo $color; ?>><?php echo number_format($c['cuota_interes'], 2, ".", ","); ?></td>
                      <td align="right" <?php echo $color; ?>><?php echo number_format($c['cuota_moradias'], 2, ".", ","); ?></td>
                      <td align="right" <?php echo $color; ?>><?php echo number_format($c['cuota_multa'], 2, ".", ","); ?></td>
                      <td align="right" <?php echo $color; ?>><?php echo number_format($c['cuota_subtotal'], 2, ".", ","); ?></td>
                      <td align="right" <?php echo $color; ?>><?php echo number_format($c['cuota_descuento'], 2, ".", ","); ?></td>
                      <td align="right" <?php echo $color; ?> style="background:silver"><b><?php echo number_format($c['cuota_total'], 2, ".", ","); ?></b></td>
                      <td <?php echo $color; ?>><?php echo date('d/m/Y',strtotime($c['cuota_fechalimite'])); ?></td>
                      <td align="right" <?php echo $color; ?>><b><?php echo number_format($c['cuota_cancelado'], 2, ".", ","); ?></b></td>
                      <td align="center" <?php echo $color; ?>><?php echo(($c['forma_nombre'] == null) ? "": $c['forma_nombre']) ?></td>
                      <?php if($c['cuota_fecha']=='0000-00-00' || $c['cuota_fecha']==null) { ?>
                      <td <?php echo $color; ?>></td> 
                      <td <?php echo $color; ?>></td>
                      <?php } else { ?>
                      <td <?php echo $color; ?>><?php echo date('d/m/Y',strtotime($c['cuota_fecha'])); ?></td>
                      <td <?php echo $color; ?>><?php echo $c['cuota_hora']; ?></td>
                       <?php } ?>
                      <td <?php echo $color; ?>><?php echo $c['cuota_numercibo']; ?></td>
                      <td align="right" <?php echo $color; ?>><b><?php echo number_format($c['cuota_saldo'], 2, ".", ","); ?></b></td>
                      <td <?php echo $color; ?>><?php echo $c['cuota_glosa']; ?></td>
                      <td <?php echo $color; ?>><?php echo $c['estado_descripcion']; ?></td>
                      <td <?php echo $color; ?>><?php echo $c['usuario_nombre']; ?></td>
                      <td <?php echo $color; ?>> 
                        <?php if ($c['factura_id']>0) { ?>
                            <a href="<?php echo site_url('factura/imprimir_factura_id/'.$c['factura_id'].'/2'); ?>" target="_blank" title="IMPRIMIR FACTURA" class="btn btn-warning btn-xs"><span class="fa fa-list"></span></a>

                        <?php  } if ($c['estado_id']==8) { ?>
                        <?php
                        if ($bandera==0) {
                                  if($rol[49-1]['rolusuario_asignado'] == 1){
                                ?>
                            <a href="#" data-toggle="modal" title="COBRAR" data-target="#pagar<?php echo $i; ?>" class="btn btn-success btn-xs"><span class="fa fa-dollar"></span></a>
                            <?php }
                                  $bandera = 1;} ?>
                            <a href="<?php echo site_url("cuotum/notacobro/".$c['cuota_id']."/".$c['credito_id']); ?>" target="_blank" title="NOTA DE COBRO" class="btn btn-facebook btn-xs"><span class="fa fa-print"></span></a>
                             <?php if($rol[51-1]['rolusuario_asignado'] == 1){ ?>
                                <a href="<?php echo site_url('cuotum/editar/'.$c['cuota_id']); ?>" title="EDITAR" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                            <?php }
                            if($rol[52-1]['rolusuario_asignado'] == 1){ ?>
                            <a class="btn btn-danger btn-xs" data-toggle="modal" title="ELIMINAR" data-target="#myModal<?php echo $i; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
                            <?php } ?>
                            
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b> <span class="fa fa-trash"></span></b>
                                               ¿Desea eliminar la cuota <b> <?php echo $c['cuota_numcuota']; ?></b>?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('cuotum/remover/'.$c['cuota_id'].'/'.$c['credito_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                          <?php } else { ?>
                            <button onclick="confirm_reset(<?= $c['cuota_id'] ?>, <?= $c['credito_id'] ?>, <?= $c['cuota_numcuota'] ?>)"  title="REESTABLECER" class="btn btn-info btn-xs"><span class="fa fa-undo"></span></button>
                            <?php if ($cuota[0]['venta_id']>0) { ?>
                            <a onclick="mostrar_modal(<?php echo $c['cuota_id']; ?>)" class="btn btn-success btn-xs"><span title="RECIBO" class="fa fa-print"></span></a>
                            <a href="<?php echo site_url("cuotum/comprobantecuentas/".$c['cuota_id']."/".$c['credito_id']); ?>" target="_blank" title="RECIBO DIVIDIDO" class="btn btn-facebook btn-xs"><span class="fa fa-print"></span></a>
                           <?php } else { ?>
                             <a href="<?php echo site_url('cuotum/recibocuentaserv/'.$c['cuota_id']); ?>" target="_blank" class="btn btn-success btn-xs"><span class="fa fa-print"></span></a>
                             <a href="<?php echo site_url("cuotum/comprobantecuentaserv/".$c['cuota_id']."/".$c['credito_id']); ?>" target="_blank" class="btn btn-facebook btn-xs"><span class="fa fa-print"></span></a>
                             <?php } ?>
                        </td>  
                       <?php } ?>
                        <!---------------------------------MODAL DE PAGAR------------------------->

  <div class="modal fade" id="pagar<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                     <font face="Arial" size="3"><b>COBRAR CUOTA Nº: <?php echo $c['cuota_numcuota']; ?></b></font><br>
              </div>
              <div class="modal-body" align="center">
                <form action="<?php echo base_url('cuotum/cobrar/'.$c['cuota_id']); ?>"  method="POST" class="form" name="finpagar<?php echo $c['cuota_id']; ?>" id="finpagar<?php echo $c['cuota_id']; ?>">

                   
                <font face="Arial" size="5">
                    
                    <b> <span class="" >Monto <?= $moneda['moneda_descripcion'] ?>: 
                    <?php echo number_format($c['cuota_total'],2,".",","); ?></span>
                    </b>
                </font><br>
                
              <input type="checkbox" name="factura" id="factura" onclick="facturar(<?php echo $c['cuota_id']; ?>)"> Emitir Factura
               
            </div>
          <div class="col-md-12">
            <input type="hidden" name="cuota_id" value="<?php echo $c['cuota_id']; ?>" class="form-control" id="cuota_id" />
            <input type="hidden" name="estado_id" value="9" class="form-control" id="estado_id" />
                    <div class="col-md-3">
                        <label for="cuota_cancelado" class="control-label">Cobrar <?= $moneda['moneda_descripcion'] ?></label>
                        <div class="form-group">
                         
                            <input type="number" step="any" name="cuota_cancelado" value="<?php echo $c['cuota_total']; ?>" class="form-control" id="cuota_cancelado<?php echo $c['cuota_id']; ?>" max="<?php echo $c['cuota_total']; ?>" />
                            <input type="hidden"  name="cuota_total" value="<?php echo $c['cuota_total']; ?>" class="form-control" id="cuota_total<?php echo $c['cuota_id']; ?>" />
                            <input type="hidden"  name="credito_id" value="<?php echo $c['credito_id']; ?>" class="form-control" id="credito_id" />
                            <input type="hidden"  name="ventita" value="<?php echo $c['venta_id']; ?>" class="form-control" id="ventita" />
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="cuota_saldo" class="control-label">Saldo <?= $moneda['moneda_descripcion'] ?></label>
                        <div class="form-group">
                            <input type="hidden"  name="cuota_interes" value="<?php echo $c['cuota_interes']; ?>" class="form-control" id="cuota_interes" />
                            <input type="hidden"  name="credito_interesproc" value="<?php echo $c['credito_interesproc']; ?>" class="form-control" id="credito_interesproc" />
                            <input type="hidden"  name="credito_tipointeres" value="<?php echo $c['credito_tipointeres']; ?>" class="form-control" id="credito_tipointeres" />
                            <input type="text" name="cuota_capital" value="0" class="form-control" id="cuota_saldo<?php echo $c['cuota_id']; ?>" style="background-color: #C5C5C5" readonly/>
                            <input type="hidden" name="cuota_numcuota" value="<?php echo $c['cuota_numcuota']; ?>" class="form-control" id="cuota_numcuota" />
                             <input type="hidden" name="cuota_fechalimite" value="<?php echo $c['cuota_fechalimite']; ?>" class="form-control" id="cuota_fechalimite" />
                             <input type="hidden" name="cuota_fecha" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="cuota_fecha" />
                             <input type="hidden" name="cuota_hora" value="<?php echo date('H:i:s'); ?>" class="form-control" id="cuota_hora" />
                             <input type="hidden" name="cuota_saldo" value="<?php echo $c['cuota_saldo']; ?>" class="form-control" id="cuota_saldo"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="forma_pago" class="control-label">Forma de pago</label>
                        <div class="form-group">
                            <select id="select_forma_pago<?= $c['cuota_id'] ?>" name="forma_pago" class="form-control" onchange="mostrar('select_forma_pago<?= $c['cuota_id'] ?>', 'cuota_forma_glosa<?= $c['cuota_id'] ?>')">
                                <?php foreach($all_forma_pago as $forma){
                                  $selected = ($forma['forma_nombre'] == $this->input->post('forma_pago')) ? ' selected="selected"' : "";

                                  echo '<option value="'.$forma['forma_id'].'" '.$selected.'>'.$forma['forma_nombre'].'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="cuota_forma_glosa<?= $c['cuota_id'] ?>" style="display:none">
                        <label for="cuota_forma_glosa" class="control-label">Glosa Forma de pago</label>
                        <div class="form-group">
                            <input type="text" name="cuota_forma_glosa" value="<?php echo $this->input->post('cuota_forma_glosa'); ?>" class="form-control" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
                        </div>
                    </div>
                    <hr class="col-md-12">
          <div class="col-md-6">
                        <label for="cuota_numercibo" class="control-label">Recibo Num.</label>
                        <div class="form-group">
                            <input type="text" name="cuota_numercibo" value="" class="form-control" id="cuota_numercibo" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="cuota_glosa" class="control-label">Glosa</label>
                        <div class="form-group">
                            <input type="text" name="cuota_glosa" value="" class="form-control" id="cuota_glosa" />
                        </div>
                    </div>
                    
                    <div id="clinit<?php echo $c['cuota_id']; ?>" style="display: none">
                      <div class="col-md-6">
                        <label for="cuota_nit" class="control-label">Nit</label>
                        <div class="form-group">
                       <input type="text" name="cuota_nit" id="cuota_nit<?php echo $c['cuota_id']; ?>" value="<?php echo $credito[0]['cliente_nit']; ?>" class="form-control"  />
                     </div></div>
                     <div class="col-md-6">
                      <label for="cuota_razon" class="control-label">Razon Social</label>
                        <div class="form-group">
                          <input type="text"  name="cuota_razon" id="cuota_razon<?php echo $c['cuota_id']; ?>" value="<?php echo $credito[0]['cliente_razon']; ?>" class="form-control" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"  />
                        </div>
                    </div>
                    </div>
            
                    <div class="col-md-12" id="detallec<?php echo $c['cuota_id']; ?>">
                    
                    </div>
                </div>
              <div class="modal-footer" align="right">

            <button class="btn btn-lg btn-success"  type="button"  onclick="enviar_formulario(<?php echo $c['cuota_id']; ?>)">
                <h4>
                <span class="fa fa-money"></span>   Cobrar  
                </h4>
            </button> 
            </form>
            <button class="btn btn-lg btn-danger" data-dismiss="modal">
                <h4>
                <span class="fa fa-close"></span>   Cancelar  
                </h4>
            </button>
                         
        </div>

            </div>
          </div>
        </div>
        <!---------------------------------FIN MODAL DE PAGAR------------------------->
                    </tr>
                   <?php  $i++;  } ?>
                   <tr>
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td> 
                    <td></td> 
                    <!--<th align="right"><b><?php echo number_format($total,'2','.',','); ?></b></th>-->
                    <td></td>    
                    <th align="right"><b><?php echo number_format($cancelados,'2','.',','); ?></b></th>   
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>
                    <td></td>
                    </tr>
                </table>               
            </div>
            
        </div>
        <a href="../../credito/indexCuenta"><button type="button" class="btn btn-danger">
                <i class="fa fa-arrow-left"></i> Atras
              </button></a>
    </div>
</div>


<script type="text/javascript">
    function mostrar(select_form, div_form){
      // console.log("si llega")
      var forma = document.getElementById(select_form).value;
      console.log(forma)
      if(forma != 1){
        document.getElementById(div_form).style.display = 'block';
      }else{
        document.getElementById(div_form).style.display = 'none';        
      }       
    }

    function confirm_reset(cuota_id,credito_id,cuota_numcuota){
      let base_url = $('#base_url').val();
      let mensaje = `¿Estas seguro de reestablecer está cuota?`
      if(confirm(mensaje)){
        window.location.href = `${base_url}cuotum/pendiente1/${cuota_id}/${credito_id}/${cuota_numcuota}`;
      }
    }
</script>

<!------------------------ INICIO modal para confirmar eliminación ------------------->
<div class="modal fade" id="modalconfirmar" tabindex="-1" role="dialog" aria-labelledby="modalconfirmarLabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content text-center">
            <div class="modal-header">
                <span class="text-bold" style="font-size: 12pt">Forma de Impresión</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <!------------------------------------------------------------------->
                <label>
                    <input type="hidden" name="lacuota_id" id="lacuota_id" />
                    <input type="checkbox" name="eldetalle" id="eldetalle" checked />
                    Imprimir con el detalle de la venta.
                </label>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center">
                <a onclick="mostrarcomprobante()" class="btn btn-success"><span class="fa fa-print"></span> Imprimir </a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar </a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para confirmar eliminación ------------------->