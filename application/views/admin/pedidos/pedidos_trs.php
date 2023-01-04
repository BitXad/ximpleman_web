<?php
$cont =1;
$hoy = new DateTime();
$cade_hoy =  $hoy->format('Y-m-d');

$datetime_manana = new DateTime($cade_hoy);
$datetime_manana->modify('+1 day');
$tomorrow = $datetime_manana->format('Y-m-d');


foreach ($pedidos as $row){
    $tr = '<tr class="warning">';
    if($row->pedidos_fecha==$tomorrow){
        $tr = '<tr class="success">';
    }

    if($row->pedidos_fecha==$cade_hoy){
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