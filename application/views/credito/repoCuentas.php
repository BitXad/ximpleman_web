<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/credito.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).on("ready",inicio);
function inicio(){
        imprimir();     
}
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


    function imprimir()
        {
             window.print(); 
        }

</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<!--<div class="box-header">
               
                 <div class="col-md-12"  >
                 <div class="col-md-4"  >
            
            <br class="no-print">        
        <div class="row">
            Desde: <input type="date" class="btn btn-primary btn-sm " id="fecha_desde" name="fecha_desde" required="true" value="">
       
            Hasta: <input type="date" class="btn btn-primary btn-sm" id="fecha_hasta" name="fecha_hasta" required="true"  value="">
        </div> <br>
        
          
       </div> 
        <div class="col-md-4">--->
        <!--------------------- parametro de buscador --------------------->
                  <!----  <div class="input-group"> 
                    <input id="cliente_id" type="text" size="90" class="form-control" placeholder="Ingrese el cliente">
                  </div>--->
        <!--------------------- fin parametro de buscador --------------------->
   <!---- </div>
    <div class="col-md-2">--->
        <!--------------------- parametro de buscador
                  <select  class="btn btn-primary"  id="estado_id" style="width: 100%; border: none;" ">
                        <option value="8">Pendiente</option>
                        <option value="9">Cancelado</option>
                   
                       
                    </select> --------------------->
        <!--------------------- fin parametro de buscador
    </div>
         <div class="col-md-2">
      
     <button class="btn btn-sm btn-primary btn-sm btn-block no-print" onclick="buscar_fecha_deuda()">
                <h5>
                <span class="fa fa-search"></span>   Realizar  Busqueda  
                </h5>
          </button>
       <br class="no-print">   
</div>
</div>
</div> --------------------->
<div class="cuerpo">
                    <div class="columna_derecha">
                        <center> 
                        <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60">
                    </center>
                    </div>
                    <div class="columna_izquierda">
                       <center>  <font size="4"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                        <?php echo $empresa[0]['empresa_zona']; ?><br>
                        <?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <?php echo $empresa[0]['empresa_telefono']; ?>
                    </div> </center>
                    <div class="columna_central">
                        <center>      <h3 class="box-title"><u>DEUDAS POR COBRAR</u></h3>
                            <b>VENTAS AL CREDITO</b> <br>
                <?php echo date('d/m/Y H:i:s'); ?>
                </center>
                    </div>
</div>
 <a onclick="imprimir()" class="btn btn-success btn-sm no-print"><i class="fa fa-print"> Imprimir</i></a>
<div class="row">

       
        <div class="box">

            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    
                    <?php if ($agrupar==1) { ?>
                    <tr>
                        <th>Num.</th>                                             
                        <th>CLIENTE</th>
                        <th>TOTAL<br>CRED.</th>
                        <th>CANCELADO<br>a CTTA</th>
                        <th>SALDO<br>TOTAL</th>
                        <th>TELEFONO(s)</th>
                        
                        
                    </tr>
                    <tbody class="buscar" >
                    <?php 
                          $result = array();
                          $totalCancelados=0;
                          $totalCreditos=0;
                          $totalSaldos=0;
                          
                          foreach($credito as $t){
                            $totalCreditos+=$t['credito_monto'];
                            $cancelado=0; foreach($cuota as $k){ if($k['credito_id']==$t['credito_id']){
                            $cancelado+=$k['cuota_cancelado'];
                            }}
                            $repeat=false;

                            for($i=0;$i<count($result);$i++)
                            {

                                if($result[$i]['cliente_nombre']==$t['cliente_nombre'])
                                {
                                    $result[$i]['credito_monto']+=$t['credito_monto']; 
                                    $repeat=true;

                                    break;

                                } 
                            }
    if($repeat==false)
        $result[] = array('cliente_nombre' => $t['cliente_nombre'], 'credito_monto' => $t['credito_monto']
    , 'cliente_telefono' => $t['cliente_telefono'], 'cliente_celular' => $t['cliente_celular'], 'credito_cancelado' => $cancelado);
                       
                         } $cont = 0; foreach($result as $c){
                            $cont = $cont+1; ?>
                         <tr>
                        <td style="text-align: center;"><?php echo $cont; ?></td>                                                
                        <td style="text-align: left;"><?php echo $c['cliente_nombre']; ?></td>                                                
                        <td style="text-align: right;"><?php echo number_format($c['credito_monto'], 2, ".", ","); ?></td>
                        <td style="text-align: right;"><?php echo  number_format($c['credito_cancelado'], 2, ".", ",");  $totalCancelados+=$c['credito_cancelado']; ?></td>
                        
                        <td style="text-align: right;"><?php $saldo=$c['credito_monto']-$c['credito_cancelado']; echo number_format($saldo, 2, ".", ",");  ?></td>
                        <td style="text-align: center;"><?php echo $c['cliente_telefono']; ?><?php if($c['cliente_celular']!=NULL && $c['cliente_telefono']!=NULL){ ?> - <?php echo $c['cliente_celular'];} else { echo $c['cliente_celular']; } ?></td>
                        
                        
                    </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($totalCreditos, 2, ".", ","); ?></td>
                        <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($totalCancelados, 2, ".", ","); ?></td>
                        <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($totalCreditos-$totalCancelados, 2, ".", ","); ?></td>
                        <td></td>
                    </tr>
                    
                       
                    <?php }else{ ?>
                        <tr>
                        <th>Num.</th>                                             
                        <th>CLIENTE</th>
                        <th>VENTA</th>
                        <th>CREDITO</th>                        
                        <th>FECHA</th>                        
                        <th>TOTAL<br>CRED.</th>
                        <th>CANCELADO<br>a CTTA</th>
                        <th>SALDO<br>TOTAL</th>
                        <th>TELEFONO(s)</th>
                        <th>USUARIO</th>
                        
                    </tr>
                    <tbody class="buscar" >
                    <?php $cont = 0;
                        $totalCreditos=0;
                        $totalCancelados=0;
                        $totalSaldos=0;
                          foreach($credito as $c){;
                                 $cont = $cont+1;
                                 $saldo = 0;
                                 $totalCreditos+=$c['credito_monto'];
                        
                        
                        ?>
                    <tr>
						<td style="text-align: center;"><?php echo $cont ?></td>                                                
						<td ><?php echo $c['cliente_nombre']; ?></td>
                        <td style="text-align: center;"><?php echo $c['venta_id']; ?><?php echo $c['servicio_id']; ?></td>
                        <td style="text-align: center;"><?php echo $c['credito_id']; ?></td>				    
                        <td style="text-align: center;"><?php echo date('d/m/Y',strtotime($c['credito_fecha'])) ; ?> <?php echo $c['credito_hora']; ?></td>                   
                        <td style="text-align: right;"><?php echo number_format($c['credito_monto'], 2, ".", ","); ?></td>
                        <td style="text-align: right;"><?php $cancelado=0; foreach($cuota as $k){ if($c['credito_id']==$k['credito_id']){ 
                        $cancelado+=$k['cuota_cancelado'];  }  } echo  number_format($cancelado, 2, ".", ",");  $totalCancelados+=$cancelado; ?></td>
                        <td style="text-align: right;"><?php $saldo=$c['credito_monto']-$cancelado; echo number_format($saldo, 2, ".", ","); $totalSaldos+=$saldo; ?></td>
						<td style="text-align: center;"><?php echo $c['cliente_telefono']; ?><?php if($c['cliente_celular']!=NULL && $c['cliente_telefono']!=NULL){ ?> - <?php echo $c['cliente_celular'];} else { echo $c['cliente_celular']; } ?></td>
                        <td ><?php echo $c['usuario_nombre']; ?></td>
						
                    </tr>
                    <?php }  ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($totalCreditos, 2, ".", ","); ?></td>
                        <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($totalCancelados, 2, ".", ","); ?></td>
                        <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($totalSaldos, 2, ".", ","); ?></td>
                        <td></td>
                    </tr>
                <?php }  ?>
                </table>
                
            </div>
                          
        </div>
        <div>
            <center>
                <hr style="border-color: black; width: 20%; margin-bottom: 0;">
                RESPONSABLE<BR>
                FIRMA-SELLO
            </center>
        </div>
    </div>
</div>
