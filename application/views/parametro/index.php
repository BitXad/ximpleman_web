<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Parametros</h3>
            	
            </div>
            <div class="box-body">
                <table class="table table-striped" id="mitabla" style="width: 50%; text-align: center; font-size: 13px;" align="center">
                    <?php foreach($parametros as $p){ ?>
                    <tr>
                        <th style="font-size: 13px;">Editar</th>
                        <td>
                            <a href="<?php echo site_url('parametro/edit/'.$p['parametro_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a> 
                            
                        </td>
                    </tr>
                    <tr>
						<th style="font-size: 13px;">No. EGRESO</th>
                        <td><?php echo $p['parametro_numrecegr']; ?></td>
                    </tr>
                    <tr>
						<th style="font-size: 13px;">No. INGRESO</th>
                        <td><?php echo $p['parametro_numrecing']; ?></td>
                    </tr>
                    <tr>
						<th style="font-size: 13px;">No.COPIAS FACTURAS</th>
                        <td><?php echo $p['parametro_copiasfact']; ?></td>
                    </tr>
                    <tr>
						<th style="font-size: 13px;">TIPO DE IMPRESORA</th>
                        <td><?php echo $p['parametro_tipoimpresora']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 13px;">No. CUOTAS</th>
                        <td><?php echo $p['parametro_numcuotas']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 13px;">MONTO MAXIMO DE PAGO</th>
                        <td><?php echo $p['parametro_montomax']; ?> Bs.</td>
                    </tr>
                    <tr>
                        <th style="font-size: 13px;">DIAS DE GRACIA</th>
                        <td><?php echo $p['parametro_diasgracia']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 13px;">DIA DE PAGO</th>
                        <td><?php echo $p['parametro_diapago']; ?>
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
                        <th style="font-size: 13px;">PERIODO DE PAGO</th>
                        <td><?php echo $p['parametro_periododias']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 13px;">INTERES</th>
                        <td><?php echo $p['parametro_interes']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 13px;">TITULO DOC.</th>
                        <td><?php echo $p['parametro_tituldoc']; ?></td>
                    </tr>
                   
                    
                  
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
