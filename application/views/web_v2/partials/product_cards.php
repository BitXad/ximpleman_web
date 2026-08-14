<?php if (empty($productos)): ?>
    <div class="v2-empty-state">
        <div>⌕</div>
        <h3>No encontramos productos</h3>
        <p>Prueba con otro nombre, código o categoría.</p>
    </div>
<?php else: ?>
    <?php foreach ($productos as $p): ?>
        <article class="v2-product-card">
            <a class="v2-product-image" href="<?php echo site_url('website/single/1/' . (int) $p['producto_id']); ?>">
                <?php if (!empty($p['producto_foto'])): ?>
                    <img loading="lazy" src="<?php echo base_url('resources/images/productos/' . rawurlencode($p['producto_foto'])); ?>" alt="<?php echo html_escape($p['producto_nombre']); ?>">
                <?php else: ?>
                    <div class="v2-no-image">Sin imagen</div>
                <?php endif; ?>
            </a>
            <div class="v2-product-body">
                <div class="v2-product-tags">
                    <?php if (!empty($p['categoria_nombre'])): ?><span><?php echo html_escape($p['categoria_nombre']); ?></span><?php endif; ?>
                    <?php if (!empty($p['producto_codigo'])): ?><small>#<?php echo html_escape($p['producto_codigo']); ?></small><?php endif; ?>
                </div>
                <h3><a href="<?php echo site_url('website/single/1/' . (int) $p['producto_id']); ?>"><?php echo html_escape($p['producto_nombre']); ?></a></h3>
                <?php if (!empty($p['producto_marca'])): ?><p class="v2-product-brand"><?php echo html_escape($p['producto_marca']); ?></p><?php endif; ?>
                <div class="v2-product-footer">
                    <div class="v2-price"><small>Bs</small> <?php echo number_format((float) $p['producto_precio'], 2, ',', '.'); ?></div>
                    <button class="v2-add-cart" type="button" data-add-cart="<?php echo (int) $p['producto_id']; ?>" aria-label="Agregar <?php echo html_escape($p['producto_nombre']); ?> al carrito">+</button>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
<?php endif; ?>
