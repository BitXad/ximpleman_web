<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/compra.js'); ?>" type="text/javascript"></script>
 
   
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#comprar').keyup(function () {
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
</script>   

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<div class="box-header">
                <h3 class="box-title">Compras Completadas</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('compra/reportes'); ?>" class="btn btn-warning btn-sm"><span class="fa fa-print"></span>Reportes Compra</a> 
                    <a href="<?php echo site_url('compra/crearcompra'); ?>" class="btn btn-success btn-sm">+ Añadir Compra</a>
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
         <div class="col-md-6">
<div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="comprar" type="text" class="form-control" placeholder="Ingresa el nombre de proveedor" onkeypress="validacompra(event,4)" >
      </div></div>
      <div class="container" id="categoria">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-primary">Productos encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="encontrados" type="text" value="0" readonly="true"> </span></span>

</div>
      <!-------------------- CATEGORIAS------------------------------------->
       <div class="col-md-6">
      <div  class="box-tools" >
                          
                    <select  class="btn btn-primary btn-sm" id="select_compra" onchange="buscar_compras()">
                        <option value="1">Compras de Hoy</option>
                        <option value="2">Compras de Ayer</option>
                        <option value="3">Compras de la semana</option>
                        <option value="4">Todas las Compras</option>
                        <option value="5">Compras por fecha</option>
                    </select>
            

      </div></div>

      <form method="post" onclick="buscar_por_fecha()">
<div class="panel panel-primary col-md-12" id='buscador_oculto' style='display:none;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true">
        </div>
        
        <div class="col-md-4">
            Tipo:       <br>      
             <select  class="btn btn-primary btn-sm form-control" style=" width: 45%; font-size: 11px;"  id="tipotrans_id" required="true">
                <?php foreach($tipo_transaccion as $es){?>
                    <option value="<?php echo $es['tipotrans_id']; ?>"><?php echo $es['tipotrans_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
      
        
    </center>    
    <br>    
</div>
</form>
<div class="container" id="categoria">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-primary">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="pillados" type="text" value="0" readonly="true"> </span></span>

</div>
        <div class="box">
            
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                                          <th>N</th>
                        <th>Proveedor</th>
<!--                        <th>Sub <br>Total</th>
                        <th>Desc.</th>-->
                        <th>Total</th>
                        <th>Fecha<br>Hora</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar" id="compraproveedor">
                    <tbody class="buscar" id="fechadecompra">
                    
                    
                            

                    <tr>
                    <td></td>    
                    <td align="right"><b>TOTAL</b></td> 
                    <td align="right"><font size="4"><b><?php echo number_format(0,'2','.',','); ?></b></font></td>
                    <td></td>    
                    <td></td>
                    <td></td>
                    </tr>
                    <?php ?></tbody>
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>

<!-------------------- FIN CATEGORIAS--------------------------------->
                                
          
  


<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                 <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese la fecha, total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
              <h4 class="box-title"> Compras sin Proveedor asignado</h4>
        <div class="box">
          
                <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>Num.</th>
                        <th>Id</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Glosa</th>
                        <th>Estado</th>
                        <th> </th>
                    </tr>
                    <tbody class="buscar2">
                    <?php $cont = 0;
                    $bandera = 0;
                          foreach($comprasn as $psn){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $psn['compra_id']; ?></td>
                        <td><?php echo $psn['proveedor_id']; ?></td>
                        <td><?php echo $psn['compra_fecha']; ?></td>
                        <td><?php echo $psn['compra_subtotal']; ?></td>
                        <td><?php echo $psn['compra_descuento']; ?></td>  
                        <td><?php echo $psn['compra_total']; ?></td>
                        <td><?php echo $psn['compra_glosa']; ?></td>
                        <td><?php echo $psn['estado_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('compra/edit/'.$psn['compra_id'].'/'.$bandera); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                            <a href="<?php echo site_url('compra/edito/'.$psn['compra_id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-asterisk"></span></a>  
                            <a href="<?php echo site_url('compra/remove/'.$psn['compra_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?></tbody>
                </table>
                                
            </div>
<!--            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
            </div>-->
        </div>
    </div>
</div>
