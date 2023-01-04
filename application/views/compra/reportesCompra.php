<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/compra.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
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
       <div class="col-md-6 no-print" >
      <div  class="box-tools "  >
                          
                    <select  class="btn btn-primary btn-sm" style="border: none;" id="select_compra" onchange="reporte_compras()">
                        <option value="1">Compras de Hoy</option>
                        <option value="2">Compras de Ayer</option>
                        <option value="3">Compras de la semana</option>
                        <option value="4">Todas las Compras</option>
                        <option value="5">Compras por fecha</option>
                    </select>
            

      </div>
  
</div>
 <div class="col-md-6 no-print" >
    <a onclick="imprimir()" class="btn btn-success btn-sm"><i class="fa fa-print"> Imprimir</i></a>
    </div>
      <div class="container" id="categoria">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

              
</div>

      <form method="post" onclick="buscar_reporte_fecha()">
<div class="panel panel-primary col-md-12" id='buscador_oculto' style="display:none;border: none;padding: 0;">
    
             
      
            Desde: <input type="date" style=" width: 15%;  " class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_desde" name="fecha_desde" required="true">
        
            Hasta: <input type="date" style=" width: 15%;" class="btn btn-primary btn-sm form-control" value="<?php echo date('Y-m-d')?>" id="fecha_hasta" name="fecha_hasta" required="true">
        
        
       
            Tipo:             
            <select  class="btn btn-primary btn-sm form-control" style=" width: 25%; font-size: 11px;"  id="tipotrans_id" required="true">
                <?php foreach($tipo_transaccion as $es){?>
                    <option value="<?php echo $es['tipotrans_id']; ?>"><?php echo $es['tipotrans_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        

</form>
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
                        <th>CANT.</th>
                        <th>PRECIO<br>UNIT.(<?php echo $parametro[0]['moneda_descripcion']; ?>)</th>
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
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>    
                    <td></td>
                    <td align="right"><b>TOTAL</b></td> 
                    <td align="right"><b><?php echo number_format(0,'2','.',','); ?></b></td>
                    <td></td>    
                   
                    </tr>
                   </tbody>
                </table>
                
            </div>
                            
        </div>
        <center>
             <?php echo "---------------------------------"; ?><br>
                    Firma cajero.
        </center>
    </div>
</div>

<!-------------------- FIN CATEGORIAS--------------------------------->
                                
          
  

