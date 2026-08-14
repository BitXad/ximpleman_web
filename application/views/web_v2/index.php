<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="es">
<head>
    <?php $this->load->view('web_v2/partials/head'); ?>
</head>
<body>
    <?php $this->load->view('web_v2/partials/topbar'); ?>
    <?php $this->load->view('web_v2/partials/navbar'); ?>

    <main>
        <?php $this->load->view('web_v2/partials/slider'); ?>
        <?php $this->load->view('web_v2/partials/category_strip'); ?>
        <?php $this->load->view('web_v2/partials/catalog'); ?>
        <?php $this->load->view('web_v2/partials/sections'); ?>
    </main>

    <?php $this->load->view('web_v2/partials/footer'); ?>
    <?php $this->load->view('web_v2/partials/modals'); ?>

    <div id="v2-toast" class="v2-toast" role="status" aria-live="polite"></div>

    <script>
        window.XIMPLEMAN_V2 = <?php echo json_encode(array(
            'baseUrl' => base_url(),
            'idiomaId' => (int) $idioma_id,
            'endpoints' => array(
                'productos' => site_url('website_v2/productos_ajax'),
                'subcategorias' => site_url('website_v2/subcategorias_ajax'),
                'carrito' => site_url('website_v2/carrito_ajax'),
                'agregarCarrito' => site_url('website_v2/agregar_carrito_ajax'),
                'quitarCarrito' => site_url('website_v2/quitar_carrito_ajax'),
                'login' => site_url('website/sesioncliente')
            )
        )); ?>;
    </script>
    <script src="<?php echo base_url('resources/web_v2/js/website-v2.js'); ?>?v=2.0.0"></script>
</body>
</html>
