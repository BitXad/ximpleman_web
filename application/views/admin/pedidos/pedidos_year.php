<link href="<?php echo base_url('resources/css/formValidation.css')?>" rel="stylesheet">
<script src="<?php echo base_url('resources/js/formValidation.js');?>"></script>
<script src="<?php echo base_url('resources/js/formValidationBootstrap.js');?>"></script>

<link href="<?php echo site_url('resources/css/jquery.dataTables.min.css')?>" rel="stylesheet">
<script src="<?php echo site_url('resources/js/jquery.dataTables.min.js');?>"></script>

<style>
    .modal-dialog {
        width: 800px;
    }

    .modal-header {
        background-color: #337AB7;
        padding:16px 16px;
        color:#FFF;
        border-bottom:2px dashed #337AB7;
    }

   .success {
       background-color: #65dc2a !important;
       color: white;
    }


    .error {
        background-color: #dd4b39 !important;
        font-size: 14px;
        font-weight: bold;
        color: white;
    }

    .warning {
        background-color: #f4f4f4 !important;
    }

    .table tbody tr > td.info {
        background-color: #d9edf7 !important;
    }

    #table_pedidos tbody tr:hover {
        background-color: #10ebe3 !important;
    }

    .table-hover tbody tr:hover > td.error {
        background-color: #ebcccc !important;
    }

    .table-hover tbody tr:hover > td.warning {
        background-color: #faf2cc !important;
    }

    .table-hover tbody tr:hover > td.info {
        background-color: #a2c9c3 !important;
    }

</style>

<div class="box-header">
    <h3 class="box-title">Plan de Pedidos - <?php echo $year?></h3>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="xs tabls">
        <?php if($this->session->flashdata('msg')): ?>
            <p><?php echo $this->session->flashdata('msg'); ?></p>
        <?php endif; ?>
        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf" id="table_pedidos">
                <thead class="cf">
                <tr>
                    <th>nro.</th>
                    <th>proveedor</th>
                    <th>monto</th>
                    <th>fecha</th>
                    <th>resumen</th>
                    <th>estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $cont =1;
                foreach ($pedidos as $row){
                    $tr = '<tr class="success">';
                    if($row->pedidos_estado=='activo'){
                        $tr = '<tr class="success">';
                    }
                    if($cont%2==0){
                        $tr = '<tr class="warning" >';
                    }
                    if($cont%3==0){
                       $tr = '<tr class="error" >';
                    }

                    if($row->pedidos_estado=='activo'){
                        $label = 'success';
                    }else{
                        $label = 'danger';
                    }

                    echo $tr;

                    ?>
                    <td data-title="Nro"><?php echo $cont++?></td>
                    <td data-title="Proveedor">
                        <small ><?php echo $row->proveedor_nombre?></small>
                    </td>
                    <td data-title="Monto"><?php echo $row->pedidos_montototal?></td>
                    <td data-title="Fecha"><?php echo $row->pedidos_fecha?></td>
                    <td data-title="Resumen">
                        <p>
                            <?php echo substr($row->pedidos_resumen, 0, 15); ?>...
                        </p>
                    </td>
                    <td data-title="Estado"><h6><span class="label label-<?php echo $label?>"><?php echo $row->pedidos_estado ?></span></h6></td>
                    <td data-title="Opciones">
                        <a href="<?php echo site_url('admin/pedidos/detalle/'.$row->pedidos_id)?>" title="Detalle">
                            <i class="fa fa-paperclip"></i>
                        </a>/
                        <a href="<?php echo site_url('admin/pedidos/editar/'.$row->pedidos_id)?>" title="Editar">
                            <i class="fa fa-edit"></i>
                        </a>/
                        <a href="<?php echo site_url('admin/pedidos/borrar/'.$row->pedidos_id)?>" title="Borrar">
                            <i class="fa fa-trash-o" style="color: #0000eb;"></i>
                        </a>
                    </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>

        </div>

    </div>
        <hr>
        <ol class="breadcrumb">
            <li><i class="fa fa-calendar"></i>&nbsp;<a href="<?php echo site_url('admin/pedidos/info/'.date("Y"))?>"><?php echo date("Y"); ?></a></li>
        </ol>
    </div>
</div>

<script>
    $(document).ready(function() {


        $('#table_pedidos').dataTable( {
            "iDisplayLength": 15
        } );


    });

    $( "#hoy" ).click(function() {
        alert( "Boton hoy" );
    });


</script>

