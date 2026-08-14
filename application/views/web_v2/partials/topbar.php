<div class="v2-topbar">
    <div class="v2-shell v2-topbar-inner">
        <a class="v2-brand" href="<?php echo site_url('website_v2/index/' . (int) $idioma_id); ?>">
            <span class="v2-brand-mark">X</span>
            <span>
                <strong><?php echo html_escape(!empty($pagina['pagina_nombre']) ? $pagina['pagina_nombre'] : 'Mercado'); ?></strong>
                <small><?php echo html_escape(!empty($sistema['sistema_eslogan']) ? $sistema['sistema_eslogan'] : 'Compra fácil, rápido y seguro'); ?></small>
            </span>
        </a>

        <div class="v2-top-actions">
            <?php if (!empty($pagina['pagina_telefono'])): ?>
                <a class="v2-top-link" href="tel:<?php echo html_escape($pagina['pagina_telefono']); ?>">☎ <?php echo html_escape($pagina['pagina_telefono']); ?></a>
            <?php endif; ?>

            <?php if (isset($_COOKIE['cliente_id'])): ?>
                <a class="v2-top-link" href="<?php echo site_url('website/miperfil/' . (int) $idioma_id); ?>">Mi perfil</a>
            <?php else: ?>
                <button class="v2-top-link v2-link-button" type="button" data-modal-open="login">Ingresar</button>
            <?php endif; ?>

            <button class="v2-cart-button" type="button" data-modal-open="cart" aria-label="Abrir carrito">
                <span aria-hidden="true">🛒</span>
                <span>Carrito</span>
                <b id="v2-cart-count"><?php echo (int) $carrito_cantidad; ?></b>
            </button>
        </div>
    </div>
</div>
