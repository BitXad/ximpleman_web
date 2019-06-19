<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/credito.js'); ?>" type="text/javascript"></script>
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
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<div class="box-header">
                <h3 class="box-title">Deudas por Pagar</h3>
            <form action="<?php echo site_url('credito/repoDeudas'); ?>"  target="_blank" method="POST">
                <input type="hidden" name="usu" id="usu">
                <input type="hidden" name="feini" id="feini">
                <input type="hidden" name="fefin" id="fefin">
                <input type="hidden" name="esti" id="esti" value="8">
                <?php if($rol[44-1]['rolusuario_asignado'] == 1){ ?>
                <button class="btn btn-success btn-sm"><span class="fa fa-clipboard"></span> Reportes</button>   
                <?php } ?>
            </form>
             
                 <div class="panel panel-primary col-md-12"  >
                    <br>
                 <div class="col-md-4"  >
            
              
        
           <div class="row">
            Desde: <input type="date" class="btn btn-primary btn-sm " id="fecha_desde" name="fecha_desde" required="true" value="">
       
            Hasta: <input type="date" class="btn btn-primary btn-sm" id="fecha_hasta" name="fecha_hasta" required="true"  value="">
        </div> 
        
          
       </div> 
        <div class="col-md-4   ">
        <!--------------------- parametro de buscador --------------------->
                
               <input id="proveedor_id" type="text" style="width: 90%;"  class="form-control" placeholder="Ingrese el Proveedor">
                  
        <!--------------------- fin parametro de buscador --------------------->
    </div>
    <div class="col-md-2">
        <!--------------------- parametro de buscador --------------------->
                   Estado: <select  class="btn btn-primary "  id="estado_id" >
                        <option value="8">Pendiente</option>
                        <option value="9">Cancelado</option>
                   
                       
                    </select>
        <!--------------------- fin parametro de buscador --------------------->
    </div>
         <div class="col-md-2" style="padding-bottom: 20px;">
      
     <button class="btn btn-primary no-print" onclick="buscar_fecha_deuda()">
             
                <span class="fa fa-search"></span>   Busqueda  
             
          </button>
         
</div>
</div>
</div>

<div class="row">


       
        <div class="box">

            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
                                             
						<th>Proveedor</th>
                        <th>Compra</th>
						<th>Estado</th>
						<th>Monto</th>
						<th>Cuota Inicial</th>
						<th>Interes (%)</th>
						<th># Pagos</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Tipo</th>
						<th></th>
                        
                    </tr>
                    <tbody class="buscar" id="tabladeudas">
                    <?php $cont = 0;
                    $totalCreditos=0;
                    $totalCancelados=0;
                    $totalSaldos=0;
                          foreach($credito as $c){;
                                 $cont = $cont+1;
                                 $totalCreditos+=$c['credito_monto']; ?>
                    <tr>
						<td><?php echo $cont ?></td>
                                                
						<td><?php echo $c['proveedor_nombre']; ?></td>
                        <td style="text-align: center"><?php echo $c['compra_id']; ?></td>
						<td style="text-align: center"><?php echo $c['estado_descripcion']; ?></td>
						<td style="text-align: right"><?php echo $c['credito_monto']; ?></td>
						<td style="text-align: right"><?php echo $c['credito_cuotainicial']; ?></td>
						<td style="text-align: right"><?php echo $c['credito_interesmonto']; ?> (<?php echo $c['credito_interesproc']; ?>)</td>
                        <!--<td style="text-align: right;"><?php $cancelado=0; foreach($cuota as $k){ if($c['credito_id']==$k['credito_id']){ 
                        $cancelado+=$k['cuota_cancelado'];  }  } echo  number_format($cancelado, 2, ".", ",");  $totalCancelados+=$cancelado; ?></td>
                        <td style="text-align: right;"><?php $saldo=$c['credito_monto']-$cancelado; echo number_format($saldo, 2, ".", ","); $totalSaldos+=$saldo; ?></td>-->
						<td style="text-align: center"><?php echo $c['credito_numpagos']; ?></td>
                        <td style="text-align: center"><?php echo date('d/m/Y', strtotime($c['credito_fecha'])); ?></td>
                        <td style="text-align: center"><?php echo $c['credito_hora']; ?></td>
                        <td style="text-align: center"><?php echo $c['credito_tipo']; ?></td>
						<td>
                            <!--<a href="<?php echo site_url('credito/edit/'.$c['credito_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('credito/remove/'.$c['credito_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                            <a href="<?php echo site_url('cuotum/deudas/'.$c['credito_id']); ?>" target="_blank" class="btn btn-success btn-xs"><span class="fa fa-eye" title="VER CUOTAS"></span></a>
                            <a href="<?php echo site_url('cuotum/planDeuda/'.$c['credito_id']); ?>" target="_blank" class="btn btn-facebook btn-xs" title="PLAN DE PAGOS"><span class="fa fa-print"></span></a>

                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($totalCreditos, 2, ".", ","); ?></td>
                        <td></td>
                        <td></td>
                       
                        <td></td>
                    </tr>
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
