<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/egresos.js'); ?>" type="text/javascript"></script>
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
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
            <div class="box-header">
                <h3 class="box-title">EGRESOS</h3>
                <div class="box-tools">
                  <a href="<?php echo site_url('egreso/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                    
                </div>
                    
                </div>
        
           <div class="row">
        <div class="col-md-12">
       <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
          </div>
      <div class="col-md-6">
      <div  class="box-tools" >
                          
                    <select  class="btn btn-primary btn-sm" id="select_compra" onchange="buscar_egresos()">
                        <option value="0">Elija Fechas</option>
                        <option value="1">Egresos de Hoy</option>
                        <option value="2">Egresos de Ayer</option>
                        <option value="3">Egresos de la semana</option>                                               
                                                                 
                        <option value="5">Egresos por Fecha</option>
                    </select>
            

      </div>
    </div>

     
<div class="panel panel-primary col-md-12" id='buscador_oculto' style='display:none;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true">
        </div>
        
      
        
        <div class="col-md-3">
            <?php if($rol[63-1]['rolusuario_asignado'] == 1){ ?>
            <button class="btn btn-sm btn-primary btn-sm btn-block"  onclick="buscar_por_fechas()">
                <h4>
                <span class="fa fa-search"></span>   Buscar egresos  
                </h4>
            </button>
            <?php } ?>
            <br>
        </div>
        
    </center>    
    <br>    
</div>

</div>  

  <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">     
                        <tr>
							<th>#</th>
                            <th>NOMBRE</th>
                            <th># RECIBO</th>
                            <th>FECHA</th>
                            <th>CONCEPTO</th>
                            <th>MONTO</th>
                            <th>MONEDA</th>
                            <th>USUARIO</th>
                            <th></th>
                            
                        </tr>
                           <tbody class="buscar" id="fechadeegreso">
                       
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>