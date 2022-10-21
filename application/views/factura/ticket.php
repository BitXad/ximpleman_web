<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print(); 
        //window.close();
    });
</script>
<?php
    $tamanio_fuente = "10pt";
    $ancho = $parametro[0]["parametro_anchofactura"]."cm";
    $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>

<table id="print_ticket" style="width:<?php echo $ancho?>">
    <tr style="border-top-style: dashed; border-top-width: 1px;">
        <td class="text-center text-bold" colspan="2" style="font-size: 12pt; padding-right: 0; padding-left: 0; padding-top: 5px;">
            <?php
            echo $descripcion;
            ?>
        </td>
    </tr>
    <tr>
        <td style="font-size: <?= $tamanio_fuente; ?>; padding: 0; width: 15%" >
            <?php
            echo "Num.  ";
            ?>
        </td>
        <td class="text-left" style="font-size: <?= $tamanio_fuente; ?>; padding: 0; width: 75%">
            <?php
            echo ": &nbsp;".$factura[0]['factura_id'];
            ?>
        </td>
    </tr>
    <tr>
        <td style="font-size: <?= $tamanio_fuente; ?>; padding: 0">
            <?php
            echo "Fecha ";
            ?>
        </td>
        <td class="text-left" style="font-size: <?= $tamanio_fuente; ?>; padding: 0">
            <?php $fecha = new DateTime($factura[0]['factura_fechaventa']); 
                $fecha_d_m_a = $fecha->format('d/m/Y');
                echo ": &nbsp;".$fecha_d_m_a." ".$factura[0]['factura_hora'];
            ?>
        </td>
    </tr>
    <tr>
        <td class="text-center" colspan="2" style="font-size: <?= $tamanio_fuente; ?>; padding: 0;">
            <?php
            echo "TICKET : ".$venta[0]['venta_numeroventa'];
            ?>
        </td>
    </tr>
</table>