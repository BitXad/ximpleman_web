<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/reporteventa1.js'); ?>" type="text/javascript"></script>
 
    
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

        function imprimir()
        {
             window.print(); 
        }
</script>   

<style type="text/css">
 @page { 
        size: landscape;
    }
     
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<div class="cuerpo">
                    <div class="columna_derecha">
                        <center> 
                        <img src="<?php echo base_url('resources/images/empresas/'.$empresa[0]["empresa_imagen"].''); ?>"  style="width:80px;height:80px">
                    </center>
                    </div>
                    <div class="columna_izquierda">
                       <center>  <font size="4"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                        <?php echo $empresa[0]['empresa_zona']; ?><br>
                        <?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <?php echo $empresa[0]['empresa_telefono']; ?>
                    </div> </center>
                    <div class="columna_central">
                        <center>      <h3 class="box-title"><u>VENTAS</u></h3>
                <?php echo date('d/m/Y H:i:s'); ?><br>
                <b>VENTAS REALIZADAS</b>
                </center>
                    </div>
</div>
<div class="row" >
    
      
<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' >
     <div class="col-md-4 no-print" >                     
      Cliente:
        <input id="cliente_id" type="text" class="form-control" placeholder="Ingresa el nombre del cliente, nit o razon social"  onkeypress="ventacliente(event)">
      
   
    </div>  
   
             
        <div class="col-md-3">
            Desde: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
        </div> 
        <div class="col-md-3">
            Hasta: <input type="date" value="<?php echo date('Y-m-d') ?>" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
        </div>
        <div class="col-md-1" hidden>
            TIPO: <select id="tipo_transaccion" name="tipo_transaccion" class="btn btn-primary btn-sm form-control"  >
                <option value="0">-TODOS-</option>
                                       
 
                                         </select>
        </div>
        <div class="col-md-2 no-print">
            <br>
            <button class="btn btn-facebook btn-sm" onclick="reportes()"><i class="fa fa-search"> Buscar</i></button>
            <a onclick="imprimir()" class="btn btn-success btn-sm"><i class="fa fa-print"> Imprimir</i></a>
        </div>
        
  
   

                              
           <div id="tablas" style="visibility: block">  
          <div class="col-md-6 no-print" id="tablareproducto" hidden></div>
          <div class="col-md-6 no-print" id="tablarecliente"></div>
          <div class="col-md-6 no-print" id="tablareproveedor"></div>
           <input id="producto" type="hidden" class="form-control" >
           <input id="cliente" type="hidden" class="form-control" > 
           <input id="proveedor" type="hidden" class="form-control" > 
       </div>
            
</div>
         <span id="desde"></span>
         <span id="hasta"></span>
       <div id="labusqueda">
              
           </div> 
        
     
</div>
<div class="row no-print" id='loader'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >        
                        </center>
                    </div>

        <div class="box" style="padding: 0;">
            
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla" >
                    <tr>
                        <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Venta</th>
                        <th>Monto</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                    </tr>
                       
                    <tbody class="buscar" id="simple">
                    </tbody>
                </table>
                
            </div>
                        
        </div>
        <center>
            <ul style="margin-bottom: -5px;margin-top: 35px;" >--------------------------------</ul>
                     <ul style="margin-bottom: -5px;">RESPONSABLE</ul><ul>FIRMA - SELLO</ul>
        </center>
    </div>
</div>

<!-------------------- FIN CATEGORIAS--------------------------------->
                                
          
  

