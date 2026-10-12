<?php
/*
 * Regla unica de impresion para reportes de Transporte.
 * Replica el comportamiento usado por Factura:
 *  - imprime automaticamente al renderizar;
 *  - si parametro_cerrarventanas == 1, cierra al volver de la vista previa;
 *  - cualquier otro valor mantiene abierta la ventana.
 */
$parametro_impresion = array();
if (isset($parametro) && is_array($parametro)) {
    $parametro_impresion = (isset($parametro[0]) && is_array($parametro[0])) ? $parametro[0] : $parametro;
}
$cerrar_ventana_impresion = isset($parametro_impresion['parametro_cerrarventanas'])
    && (int)$parametro_impresion['parametro_cerrarventanas'] === 1;
?>
<script type="text/javascript">
(function () {
    var impresionIniciada = false;

    function imprimirReporteTransporte() {
        if (impresionIniciada) return;
        impresionIniciada = true;

        window.print();

        <?php if ($cerrar_ventana_impresion) { ?>
        // Mismo criterio usado por la impresión de Factura:
        // dar tiempo a que el navegador procese la impresión antes de cerrar.
        setTimeout(function () {
            window.close();
        }, 2000);
        <?php } ?>
    }

    if (document.readyState === 'complete') {
        imprimirReporteTransporte();
    } else if (window.addEventListener) {
        window.addEventListener('load', imprimirReporteTransporte, false);
    } else {
        window.onload = imprimirReporteTransporte;
    }
})();
</script>
