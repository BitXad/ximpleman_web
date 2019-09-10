<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/ordentrabajo.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#cotizar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
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
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
 <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $usuario_id; ?>">

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info" >
            <div class="box-header with-border">
              	<h3 class="box-title">Orden de Trabajo</h3>
            </div>
            
          

      		<div class="box-body">
          		<div class="row clearfix">
                <div class="col-md-12">
            <div class="col-md-6">
            <label for="orden_trabajo_cliente" class="control-label">Cliente</label>
            <div class="form-group">
              <input type="text" name="orden_trabajo_cliente" value=""  class="form-control" id="orden_trabajo_cliente" />
            </div>  
            </div>
						<div class="col-md-3">
            <label for="orden_trabajo_fecha" class="control-label">No.Orden</label>
            <div class="form-group">
              <input type="text" name="orden_trabajo_fecha" value="" class="form-control" id="orden_fecha" required/>
            </div>
          </div>
            <div class="col-md-3">
						<label for="orden_trabajo_fecha" class="control-label">Fecha Entrega</label>
						<div class="form-group">
							<input type="date" name="orden_trabajo_fecha" value="" class="form-control" id="orden_fecha" required/>
						</div>
					</div>
					
<!-- <?php $cont = 0;
                          $subtotal = 0;
                          $descuento = 0;
                          $totalfinal = 0;
                          
                          foreach($detalle_orden_trabajo as $d){;
                                

                                 
                          $subtotal += $d['detalleorden_subtotal'];
                          $descuento += $d['detalleorden_descuento'];
                          $totalfinal += $d['detalleorden_total'];
                         
                                 ?>
                                        
                        
                          <?php } ?> -->
                  
         
							<div class="col-md-4">
            <button  type="submit"  class="btn btn-success">
                <i class="fa fa-check"></i>Finalizar orden_trabajo
              </button></form>
              <a href="javascript:history.back()"><button type="button" class="btn btn-danger">
                <i class="fa fa-times"></i> Cancelar
              </button></a>
            </div>
          	
          			     
          </div>
         </div>
    
</div>
<!---------------------------------------TABLA DE DETALLE orden_trabajo------------------------------------>
<div class="col-md-12">
   <div class="col-md-4" style="padding-left:0px;">
                        
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
                    <tbody class="buscar3" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
            
      

<div class="col-md-8"> 
<div class="box">
             <h4 class="modal-title" id="myModalLabel">Detalle OT</h4>
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cant.</th>
                            <th>Precio</th>
                            <th>Ancho</th>
                            <th>Largo</th>
                            <th>M2</th>
                            <th>Total</th>
                    </tr>
                    <tbody class="buscar2" id="detalleordeniza">
                   
                                            
                      
        </div>
            
        
     
                            
                    </tr>
                   

                    
                </table>
                
            </div>
    

					

        </div>

            		 
			
					

    </div>
</div>

<!---------------------------------------FIN TABLA DE DETALLE VENTAAA------------------------------------>
</div>
<!---------------modal  producto--------------->
</div>

<!---------------------- fin modal productos --------------------------------------------------->

