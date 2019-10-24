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
    <div class="col-md-6 no-print">
               <font size='4' face='Arial'><b>Cuentas por Cobrar</b></font>
               <br><font size='2' face='Arial' id="pillados">Registros Econtrados: <?php echo sizeof($credito) ?></font>
        </div>
        <div class="col-md-6 no-print">
            <form action="<?php echo site_url('credito/repoCuentas'); ?>"  target="_blank" method="POST">
                <input type="hidden" name="usu" id="usu">
                <input type="hidden" name="feini" id="feini">
                <input type="hidden" name="fefin" id="fefin">
                <input type="hidden" name="esti" id="esti" value="">
                 <input type="hidden" name="vendedor" id="vendedor" value="">
              <?php if($rol[50-1]['rolusuario_asignado'] == 1){ ?>
              <button class="btn btn-success btn-foursquarexs" style="float: right;"><font size="5"><span class="fa fa-clipboard"></span></font><br><small>Reportes</small></button>
          
              <?php } ?>
            </form>
        </div>
                 <div class="panel panel-primary col-md-12">
                    <br>
                     <div class="col-md-2" style="padding-left: -30px;"  >
            <label for="fecha_desde" class="control-label">Desde</label>
              <input type="date" class="form-control btn btn-primary btn-sm " id="fecha_desde" name="fecha_desde" required="true" value="">
        </div>
            <div class="col-md-2" style="padding-left: -30px;"  >
                <label for="fecha_desde" class="control-label">Hasta</label>
           <input type="date" class="form-control btn btn-primary btn-sm" id="fecha_hasta" name="fecha_hasta" required="true"  value="">
    
       </div> 
        <div class="col-md-3   ">
        <!--------------------- parametro de buscador --------------------->
                <label for="fecha_desde" class="control-label">Cliente</label>
               <input id="cliente_id" type="text" style="width: 100%;"  class="form-control" placeholder="Ingrese el Cliente">
                  
        <!--------------------- fin parametro de buscador --------------------->
    </div>
      <div class="col-md-2">
        <label for="estado_id" class="control-label">Estado</label>
        <!--------------------- parametro de buscador --------------------->
                    <select  class="form-control btn btn-primary"  id="estado_id" >
                        
                        <option value="8">Pendiente</option>
                        <option value="9">Cancelado</option>
                        <option value="">Todos</option>
                       
                    </select>
        <!--------------------- fin parametro de buscador --------------------->
    </div>
    <div class="col-md-2" style="padding-left: 0px;">
                        

                <label for="usuario_id" class="control-label">Usuario</label>                     
                           <select  name="usuario_id" id="usuario_id"  class="form-control btn btn-primary btn-sm "  >
                                <option value="">-TODOS-</option>
                                <?php 
                                foreach($all_usuario as $usuario)
                                {
                                    $selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

                                    echo '<option  value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
                                } 
                                ?>
                            </select>

  
    </div>
         <div class="col-md-1" style="padding-bottom: 20px;padding-top: 5px;">
       <br>
     <button class="btn btn-primary no-print" onclick="buscar_fecha_cuenta()">
           
                <span class="fa fa-search"></span>   Busqueda  
             
          </button>
  
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
             
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">

            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
                                             
						<th>Cliente</th>
                        <th>Transaccion</th>
						<th>Estado</th>
						<th>Monto</th>
						<th>Cuota Inicial</th>
						<th>Interes (%)</th>
						<th># Pagos</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Usuario</th>
						<th></th>
                    </tr>
                    <tbody class="buscar" id="tablacuentas">
                    <?php $cont = 0;
                    $totalCreditos=0;
                    $totalCancelados=0;
                    $totalSaldos=0;
                          foreach($credito as $c){;
                                 $cont = $cont+1;
                                  $totalCreditos+=$c['credito_monto']; ?>
                    <tr>
						<td><?php echo $cont ?></td>
                        <?php if ($c['servicio_id']!=0) { ?>                       
						<td><?php echo $c['perro']; ?></td>
                        <td style="text-align: center">Servicio: <?php echo $c['servicio_id']; ?></td>
                        <?php } else { ?>
                        <td><?php echo $c['cliente_nombre']; ?></td>
                        <td style="text-align: center">Venta: <?php echo $c['venta_id']; ?></td>    
                        <?php } ?>
						<td style="text-align: center"><?php echo $c['estado_descripcion']; ?></td>
                        <td style="text-align: right"><?php echo $c['credito_monto']; ?></td>
                        <td style="text-align: right"><?php echo $c['credito_cuotainicial']; ?></td>
                        <td style="text-align: right"><?php echo $c['credito_interesmonto']; ?> (<?php echo $c['credito_interesproc']; ?>)</td>
                       <!-- <td style="text-align: right;"><?php $cancelado=0; foreach($cuota as $k){ if($c['credito_id']==$k['credito_id']){ 
                        $cancelado+=$k['cuota_cancelado'];  }  } echo  number_format($cancelado, 2, ".", ",");  $totalCancelados+=$cancelado; ?></td>
                        <td style="text-align: right;"><?php  $saldo=$c['credito_monto']-$cancelado; echo number_format($saldo, 2, ".", ","); $totalSaldos+=$saldo; ?></td>-->
                        <td style="text-align: center"><?php echo $c['credito_numpagos']; ?></td>
                        <td style="text-align: center"><?php echo date('d/m/Y', strtotime($c['credito_fecha'])); ?></td>
                        <td style="text-align: center"><?php echo $c['credito_hora']; ?></td>
                        <td style="text-align: center"><?php echo $c['usuario_nombre']; ?></td>
						<td>
                            <!--<a href="<?php echo site_url('credito/edit/'.$c['credito_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('credito/remove/'.$c['credito_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                            <?php if ($c['servicio_id']!=0) { ?>
                                <a href="<?php echo site_url('cuotum/cuenta_serv/'.$c['credito_id']); ?>" target="_blank" class="btn btn-success btn-xs"><span class="fa fa-eye" title="VER CUOTAS"></span></a>
                                <a href="<?php echo site_url('cuotum/planCuentaServ/'.$c['credito_id']); ?>" target="_blank" class="btn btn-facebook btn-xs" title="PLAN DE PAGOS"><span class="fa fa-print"></span></a>
                            <?php } else { ?>
                            <a href="<?php echo site_url('cuotum/cuentas/'.$c['credito_id']); ?>" target="_blank" class="btn btn-success btn-xs"><span class="fa fa-eye" title="VER CUOTAS"></span></a>
                            <a href="<?php echo site_url('cuotum/planCuenta/'.$c['credito_id']); ?>" target="_blank" class="btn btn-facebook btn-xs" title="PLAN DE PAGOS"><span class="fa fa-print"></span></a>
                            <?php } ?>
                            
                            

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
