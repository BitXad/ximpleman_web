<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Asiento</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('asiento/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>Debe</th>
                        <th>Haber</th>
                        
                    </tr>
                    <?php //foreach($asiento as $a){
                    $total_venta = 45;
                    ?>
                    <tr> <!-- 100 % -->
                        <td>Caja <?php echo $total_venta*1; ?></td>
                        <td></td>
                    </tr>
                    <tr><!-- 30 % -->
                        <td>IT <?php echo $total_venta*0.3; ?></td>
                        <td></td>
                    </tr>
                    <tr> <!-- 87 % -->
                        <td></td>
                        <td>Venta <?php echo $total_venta*0.87; ?></td>
                    </tr>
                    <tr><!-- 13 % -->
                        <td></td>
                        <td>IVA <?php echo $total_venta*0.13; ?></td>
                    </tr>
                    <tr><!-- 30 % -->
                        <td></td>
                        <td>IT <?php echo $total_venta*0.3; ?></td>
                    </tr>
                    <tr><!-- total -->
                        <td>TOTAL: <?php echo $total_venta; ?></td>
                        <td>TOTAL: <?php echo $total_venta; ?></td>
                    </tr>
                    
                    <?php //} ?>
                </table>
            </div>
        </div>
    </div>
</div>
