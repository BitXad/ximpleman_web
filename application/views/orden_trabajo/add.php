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
            <div class="col-md-3">
            <label for="nit" class="control-label">NIT</label>
            <div class="form-group">
              <input type="text" name="nit" value="" class="form-control" id="nit" onkeypress="cotivalidar(event,1)" />
            </div>
          </div>      
            <div class="col-md-3">
            <label for="razon_social" class="control-label">Cliente</label>
            <div class="form-group">
              <input type="text" name="razon_social" value=""  class="form-control" id="razon_social" />
            </div>  
            </div>
             
             
           
            <div class="col-md-3">
            <label for="telefono" class="control-label">Telefono</label>
            <div class="form-group">
              <input type="text" name="telefono" value="" class="form-control" id="telefono" />
            </div>
          </div>
						<div class="col-md-3">
            <label for="orden_numero" class="control-label">No.Orden</label>
            <div class="form-group">
              <input type="text" name="orden_numero" value="" class="form-control" id="orden_numero" required/>
            </div>
          </div>
           
          
<div class="col-md-3">
</div>
<div class="col-md-3"></div>
<div class="col-md-3"></div>
				
                  
         
							<div class="col-md-3">
           
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-check"></i> Finalizar OT
              </button>
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Finalizar OT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row clearfix">
        <?php echo form_open('orden_trabajo/add'); ?>
        <div class="col-md-4">
            <label for="total" class="control-label">Total</label>
            <div class="form-group">
              <input type="number" name="total" readonly value="" class="form-control" id="total" required/>
            </div>
          </div>
          <input type="hidden" name="cliente_id" value=""  class="form-control" id="cliente_id" />
          <input type="hidden" name="numero" value=""  class="form-control" id="numero" />
          
           
          <div class="col-md-4">
            <label for="cuenta" class="control-label">A cuenta</label>
            <div class="form-group">
              <input type="number" name="cuenta" value="" onkeyup='saldar()' class="form-control" id="cuenta" required/>
            </div>
          </div>
          <div class="col-md-4">
            <label for="saldo" class="control-label">Saldo</label>
            <div class="form-group">
              <input type="number" name="saldo" readonly value="" class="form-control" id="saldo" required/>
            </div>
          </div>
          <div class="col-md-4">
            <label for="orden_trabajo_fecha" class="control-label">Fecha Entrega</label>
            <div class="form-group">
              <input type="date" name="orden_trabajo_fecha" value="" class="form-control" id="orden_fecha" required/>
            </div>
          </div>
          <div class="col-md-8">
            <label for="nota" class="control-label">Nota</label>
            <div class="form-group">
              <input type="text" name="nota" value="" class="form-control" id="nota" required/>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Finalizar OT
              </button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times"></i> Cancelar
              </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>