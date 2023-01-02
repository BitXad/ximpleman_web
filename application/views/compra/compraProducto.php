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
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" />
<input type="hidden" name="lamoneda_id" id="lamoneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" />
<input type="hidden" name="lamoneda" id="lamoneda" value='<?php echo json_encode($lamoneda); ?>' />
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
                        <center>      <h3 class="box-title"><u>COMPRAS</u></h3>
                <?php echo date('d-m-Y H:i:s'); ?>
                </center>
                    </div>
</div>
<div class="row" >
    
    <div class="col-md-12" style="padding: 0;">
       <!----  <div class="col-md-6">
<div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="comprar" type="text" class="form-control" placeholder="Ingresa el nombre de proveedor" onkeypress="validacompra(event,4)" >
      </div></div>
      <div class="container" id="categoria">----->
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

             <!----   <span class="badge btn-primary">Productos encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="encontrados" type="text" value="0" readonly="true"> </span></span>

</div>----->
      <!-------------------- CATEGORIAS------------------------------------->
  

      
<div class="panel panel-primary col-md-12" id='buscador_oculto' ">
    
             
      
            Desde: <input type="date" style=" width: 15%;  " class="btn btn-primary btn-sm form-control"  id="fecha_desde" name="fecha_desde" >
        
            Hasta: <input type="date" style=" width: 15%;" class="btn btn-primary btn-sm form-control"  id="fecha_hasta" name="fecha_hasta" >
        
         
       
                                
      <div class="input-group no-print"> <span class="input-group-addon">Buscar Producto</span>
        <input id="comprar" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción"  onkeypress="compraproducto(event,4)">
      </div>
      <!-------------------- CATEGORIAS------------------------------------->
<div class="container no-print" id="categoria">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->
<div class="col-md-6 no-print" >
                <span class="badge btn-primary">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text" value="0" readonly="true"> </span></span> </div>
 <div class="col-md-6 no-print" >
    <a onclick="imprimir()" class="btn btn-success btn-sm"><i class="fa fa-print"> Imprimir</i></a>
    </div> 
</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
                              
            
          
                <table class="table table-striped no-print" id="mitabla">
                    
                    <tr>
                        <th>N</th>
                        <th>ID</th>
                        <th>Producto</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar" id="tablareproducto">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
        </div>
        
       
        
     
</div>

<div class="container no-print" id="categoria" style="padding: 0;">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

               

</div>
        <div class="box" style="padding: 0;">
            
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla" >
                    <tr>
                        <th>Nro.</th>
                        <th>PRODUCTO</th>
                        <th>CODIGO</th>
                        <th>COMPRA</th>
                        <th>TIPO</th>
                        <th>UNIDAD</th>
                        <th>FECHA</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO UNIT.(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                        <th>TOTAL<br>(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
                        <th>TOTAL<br>(<?php
                                            if($parametro[0]["moneda_id"] == 1){
                                                echo $lamoneda[1]['moneda_descripcion'];
                                            }else{
                                                echo $lamoneda[0]['moneda_descripcion'];
                                            }
                                        ?>)
                        </th>
                        <th>CAJERO</th>
                    </tr>
                    <tbody class="buscar" id="reportefechadecompra">
                    
                    

                    <tr>
                  
                      
                   
                    </tr>
                    <?php ?></tbody>
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
        <center>
             <?php echo "---------------------------------"; ?><br>
                    Firma cajero.
        </center>
    </div>
</div>

<!-------------------- FIN CATEGORIAS--------------------------------->
                                
          
  

