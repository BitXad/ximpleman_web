<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/cotizacion.js'); ?>" type="text/javascript"></script>
<script>
    function enviar_formulario(cotizacion_id){
      var base_url    = document.getElementById('base_url').value;
       document.fincotiza.submit(cotizacion_id);

      //setTimeout( window.open(base_url+'cotizacion/recibo/'+cotizacion_id),'_blank'); , 1000);
      // setInterval(alert("dsfdsafasd"),5000);
    }
</script>


<script>
function imprime(cotizacion_id){
  var base_url    = document.getElementById('base_url').value;
    window.open(base_url+'cotizacion/recibo/'+cotizacion_id,'_blank');
}
</script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#cotizar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar33 tr').show();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
        
        $(document).ready(function () {
            (function ($) {
                $('#filtrar2').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar2 tr').hide();
                    $('.buscar2 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });

    $(document).ready(function () {
            (function ($) {
                $('#filtrar3').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar3 tr').hide();
                    $('.buscar3 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });


        $(document).ready(function () {
            (function ($) {
                $('#filtrar4').click(function () {
                  $('.oscar4').removeClass('hidden');
                    var rex = new RegExp($(this).val(), 'i');
                    
                    $('.os1car4 tr').hide();
                    $('.oscar4 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });

  function myFunction() {
     
          
   alert("Debe agregar y guardar cambios en la cabecera");
      
      }

</script> 

<style type="text/css">
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] { -moz-appearance:textfield; }
</style> 
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<link href="<?php echo base_url('resources/css/tablacompras.css'); ?>" rel="stylesheet">

<?php $decimales = $parametro["parametro_decimales"]; ?>

<!-------------------------------------------------------->
 <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="<?php echo $cotizacion_id; ?>">
 <input type="hidden" name="decimales" id="decimales" value="<?php echo $decimales; ?>">
            <!--<div class="box-header with-border">-->
                <h5 class="box-title"><b>COTIZACION</b></h5>
            <!--</div>-->

<div class="row">
    <div class="col-md-12">
        
      <font size="1"><b>DATOS DEL CLIENTE</b></font>
        <div class="box" style="border-color:black;">
            <form action="<?php echo base_url('cotizacion/finalizar/'.$cotizacion_id); ?>" id="fincotiza" name="fincotiza" method="POST" class="form">
          

      		<div class="box-body">
          		<div class="row clearfix">
                            
                                        <div class="col-md-4">
						<label for="cotizacion_cliente" class="control-label">Cliente</label>
                                                <div class="form-group">
                                                    <input type="text" name="cotizacion_cliente" value="<?php echo ($this->input->post('cotizacion_cliente') ? $this->input->post('cotizacion_cliente') : $cotizacion['cotizacion_cliente']); ?>"  class="form-control" id="cotizacion_cliente" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                                </div>
                                        </div>
                                                
                                        <div class="col-md-2">
						<label for="cotizacion_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="cotizacion_fecha" value="<?php echo implode("/", array_reverse(explode("-", ($this->input->post('cotizacion_fecha') ? $this->input->post('cotizacion_fecha') : $cotizacion['cotizacion_fecha'])))); ?>" class="has-datepicker form-control" id="cotizacion_fecha" required/>
						</div>
					</div>
					<div class="col-md-2">
						<label for="cotizacion_validez" class="control-label">Validez</label>
						<div class="form-group">
							<input type="text" name="cotizacion_validez"  value="<?php echo ($this->input->post('cotizacion_validez') ? $this->input->post('cotizacion_validez') : $cotizacion['cotizacion_validez']); ?>" class="form-control" id="cotizacion_validez" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cotizacion_formapago" class="control-label">Forma Pago</label>
						<div class="form-group">
							<input type="text" name="cotizacion_formapago"  value="<?php echo ($this->input->post('cotizacion_formapago') ? $this->input->post('cotizacion_formapago') : $cotizacion['cotizacion_formapago']); ?>" class="form-control" id="cotizacion_formapago" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
                                
					<div class="col-md-2">
						<label for="cotizacion_tiempoentrega" class="control-label">Tiempo de Entrega</label>
						<div class="form-group">
							<input type="text" name="cotizacion_tiempoentrega"  value="<?php echo ($this->input->post('cotizacion_tiempoentrega') ? $this->input->post('cotizacion_tiempoentrega') : $cotizacion['cotizacion_tiempoentrega']); ?>" class="form-control" id="cotizacion_tiempoentrega" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
                                        <div class="col-md-3" >
                                         <label for="cotizacion_lugarentrega" class="control-label">Lugar de Entrega</label>
                                         <div class="form-group">
                                           <input type="text" id="cotizacion_lugarentrega" name="cotizacion_lugarentrega" value="<?php echo ($this->input->post('cotizacion_lugarentrega') ? $this->input->post('cotizacion_lugarentrega') : $cotizacion['cotizacion_lugarentrega']); ?>" class="form-control"  onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />

                                         </div>
                                       </div>
                                       <div class="col-md-3" >
                                         <label for="cotizacion_chequenombre" class="control-label">Cheque a Favor de </label>
                                         <div class="form-group">
                                           <input type="text" id="cotizacion_chequenombre" name="cotizacion_chequenombre" value="<?php echo ($this->input->post('cotizacion_chequenombre') ? $this->input->post('cotizacion_chequenombre') : $cotizacion['cotizacion_chequenombre']); ?>" class="form-control"  onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />

                                         </div>
          </div>
 <?php $cont = 0;
                          $subtotal = 0;
                          $descuento = 0;
                          $totalfinal = 0;
                          
                          foreach($detalle_cotizacion as $d){;
                                

                                 
                          $subtotal += $d['detallecot_subtotal'];
                          $descuento += $d['detallecot_descuento'];
                          $totalfinal += $d['detallecot_total'];
                         
                                 ?>
                                        
                        
                          <?php } ?> 
                  <div class="col-md-3"  >
                    <label for="cotizacion_total" class="control-label">Cotizacion Total</label>
                    <div class="form-group">
                        <input type="text" id="cotizacion_total" name="cotizacion_total" value="<?php echo number_format($totalfinal,$decimales,".",","); ?>" class="form-control"  />

                    </div>
                  </div>
         
                    <div class="col-md-3">
                     <label for="cotizacion_glosa" class="control-label">Glosa</label>
                     <div class="form-group">
                       <input type="text" name="cotizacion_glosa"  value="<?php echo ($this->input->post('cotizacion_glosa') ? $this->input->post('cotizacion_glosa') : $cotizacion['cotizacion_glosa']); ?>" class="form-control" id="cotizacion_glosa" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                     </div>
                   </div>
                                
                                
                </div>
         </div>
    
    </div>

                
                
            <div class="col-md-4" style="float: right;">
            <button   onclick="enviar_formulario(<?php echo $cotizacion_id; ?>)" class="btn btn-xs btn-default">
                <i class="fa fa-check"></i>Finalizar Cotizacion
              </button></form>
              <a href="<?php echo site_url('cotizacion/index'); ?>"><button type="button" class="btn btn-xs btn-default">
                <i class="fa fa-times"></i> Cancelar
              </button></a>
            </div>
          	</form>
          			     
</div>
</div>

  
<!---------------------------------------TABLA DE DETALLE cotizacion------------------------------------>
<div class="col-md-12">
   <div class="col-md-4" style="padding-left:0px;">
          
       <font size="1"><b>BUSCAR PRODUCTOS</b></font>
        <div class="box" style="border-color:black;">
    
                        
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="cotizar" type="text" class="form-control" autocomplete="off" placeholder="Ingresa el nombre de producto, código o descripción"  onkeypress="cotivalidar(event,4)">
      </div>
      <!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-primary">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text" value="0" readonly="true"> </span></span>

</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
                                
            
          
                <table class="table table-striped" id="mitabla">
                    
                     <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
            </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
            
      

<div class="col-md-8"> 
        <font size="1"><b>DETALLE DE PRODUCTOS</b></font>
        <div class="box" style="border-color:black;">
<div class="box">
            <!--<div class="box-body table-responsive">-->
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                            <th>Total</th>
                    </tr>
                    <tbody class="buscar2" id="detallecotiza">

                </table>
                
            </div>
    

					

        </div>

            		 
			
					

    </div>
                        
 <div class="col-md-12" align="right"> 
  <center>
            <a type="button" onclick="enviar_formulario(<?php echo $cotizacion_id; ?>)" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-money fa-4x"></i><br>
               Finalizar<br>Cotización<br>
            </a>

            
            <a  href="<?php echo site_url('cotizacion/index'); ?>" class="btn btn-sq-lg btn-default" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-sign-out fa-4x"></i><br><br>
               Cancelar<br>
            </a>    
              
            </center>
 </div>   
</div>

<!---------------------------------------FIN TABLA DE DETALLE VENTAAA------------------------------------>
</div>
<!---------------modal  producto--------------->
</div>
</div>
<!---------------------- fin modal productos --------------------------------------------------->

