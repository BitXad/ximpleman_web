<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/ordentrabajo.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#orden_cli').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });

        function imprimir()
        {
           $("#cabeceraprint").css("display", "");
             window.print(); 
        }

</script>  
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="usuario_id" id="usuario_id" value="0">
<!-------------------------------------------------------->
<div class="row micontenedorep" style="display: none" id="cabeceraprint">
    <table class="table" style="width: 100%; padding: 0;" >
    <tr>
        <td style="width: 25%; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 35%; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>ORDEN DE TRABAJO</b></font> <br>
                
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 20%; padding: 0" >
                <center>
                         
                             
                            
                         
                        
                    </center>
        </td>
    </tr>
     
    
    
</table>       
        
</div>
<div class="row">
    <div class="col-md-12">
<div class="row">
  <div class="col-md-6">


        <!--este es INICIO del BREADCRUMB buscador-->
        <div class="box-header">
                <font size='4' face='Arial'><b>Orden Trabajo</b></font>
                <br><font size='2' face='Arial' id="pillados">Registros Encontrados: 
        </div>
        <!--este es FIN del BREADCRUMB buscador-->
 
        <!--este es INICIO de input buscador-->
        <div class="col-md-8 no-print">
            <div class="input-group">
                      <span class="input-group-addon"> 
                        Buscar 
                      </span>           
                <input id="orden_cli" type="text" class="form-control" placeholder="Ingresa el nombre de cliente" onkeypress="buscar_porcliente(event)" >
            </div></div>
            <div class="col-md-4 no-print">
                
                <select  class="btn btn-primary btn-sm"  id="select_fecha" onchange="busqueda_ot()">
                    <option value="1">O.T. de Hoy</option>
                    <option value="2">O.T. de Ayer</option>
                    <option value="3">O.T. de la semana</option>
                    <option value="5">O.T. por fecha</option>
                </select>
                
            </div>
            
        <!--este es FIN de input buscador-->

        <!-- **** INICIO de BUSCADOR select y productos encontrados *** -->
         <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <!-- **** FIN de BUSCADOR select y productos encontrados *** -->
      </div>
     <div class="col-md-6 no-print">
        
    <div class="box-tools">
        <center>    
            <a href="<?php echo site_url('orden_trabajo/nuevo'); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-cart-plus"></span></font><br><small>Registrar OT</small></a>
            
            <button data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs" onclick="fechaorden('and 1')" ><font size="5"><span class="fa fa-search"></span></font><br><small>Ver Todos</small></button>
            
            <a href="#" onclick="imprimir()" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
             
        </center>            
    </div>
    </div>   
        
    </div>
    <div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='font-family: Arial; display:none; padding-bottom: 10px;'>
                <br>
                <center>            
                    <div class="col-md-4">
                        Desde: <input type="date" class="btn btn-primary btn-sm form-control" style=" width: 80%;"  id="fecha_desde" name="fecha_desde" value="<?php echo date('Y-m-d') ?>" required="true">
                    </div>
                    <div class="col-md-4">
                        Hasta: <input type="date" class="btn btn-primary btn-sm form-control" style=" width: 80%; "  id="fecha_hasta" name="fecha_hasta" value="<?php echo date('Y-m-d') ?>" required="true">
                    </div>

                   
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-sm form-control" face='Arial' tyle='font-family: Arial;' onclick="buscar_por_fecha()"><span class="fa fa-search"></span> Buscar</button>
                        
                    </div>
                    <br>


                </center>    
                <br>    
            </div>
            <div class="col-md-12">
        <div class="box">
          
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
						<th>#</th>
            <th>Cliente</th>
            <th>No.</th>
			<th>Fecha</th>
			<th>Fecha de Entrega</th>
			<th>Total Bs.</th>
            <th>A Cuenta Bs.</th>
            <th>Saldo Bs.</th>
            <th>Usuario</th>
            <th>Seg.</th>
            <th class="no-print"></th>
						
                    </tr>
                    <tbody class="buscar" id="fechadeorden">
                  
                   
                  
                </table>
                                
            </div>
        </div>
    </div>
</div>
