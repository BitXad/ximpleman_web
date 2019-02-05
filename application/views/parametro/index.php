<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Parametros</h3>
            	
            </div>
            <div class="box-body" >
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                <table class="table table-striped table-condensed" id="mitabla" style="text-align: center; font-size: 11px;">
                    <?php foreach($parametros as $p){ ?>
                    <tr>
                        <th style="font-size: 11px;"></th>
                        <td>
                            <a href="<?php echo site_url('parametro/edit/'.$p['parametro_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a> 
                            
                        </td>
                    </tr>
                    <tr>
						<th style="font-size: 11px;">No. EGRESO</th>
                        <td><?php echo $p['parametro_numrecegr']; ?></td>
                    </tr>
                    <tr>
						<th style="font-size: 11px;">No. INGRESO</th>
                        <td><?php echo $p['parametro_numrecing']; ?></td>
                    </tr>
                    <tr>
						<th style="font-size: 11px;">No.COPIAS FACTURAS</th>
                        <td><?php echo $p['parametro_copiasfact']; ?></td>
                    </tr>
                    <tr>
						<th style="font-size: 11px;">TIPO DE IMPRESORA</th>
                        <td><?php echo $p['parametro_tipoimpresora']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;">No. CUOTAS</th>
                        <td><?php echo $p['parametro_numcuotas']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;">MONTO MAXIMO DE PAGO</th>
                        <td><?php echo $p['parametro_montomax']; ?> Bs.</td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;">DIAS DE GRACIA</th>
                        <td><?php echo $p['parametro_diasgracia']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;">DIA DE PAGO</th>
                        <td>[<?php echo $p['parametro_diapago']; ?>]
                            <?php
$var= $p['parametro_diapago'];
switch($var) {

case 1: echo "LUNES";
break;
case 2: echo "MARTES";
break;
case 3: echo "MIERCOLES";
break;
case 4: echo "JUEVES";
break;
case 5: echo "VIERNES";
break;
case 6: echo "SABADO";
break;
case 7: echo "DOMINGO";
break;
}
?>
                        </td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;">PERIODO DE PAGO</th>
                        <td><?php echo $p['parametro_periododias']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;">INTERES</th>
                        <td><?php echo $p['parametro_interes']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;">TITULO DOC.</th>
                        <td><?php echo $p['parametro_tituldoc']; ?></td>
                    </tr>
                   
                    
                  
                    <?php } ?>
                </table>
              </div>                  
            </div>
        </div>
    </div>
</div>
