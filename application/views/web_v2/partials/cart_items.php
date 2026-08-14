<?php if (empty($items)): ?>
    <div class="v2-empty-state v2-empty-cart"><div>🛒</div><h3>Tu carrito está vacío</h3><p>Agrega productos desde el catálogo.</p></div>
<?php else: ?>
    <?php foreach ($items as $item): ?>
        <div class="v2-cart-item">
            <div class="v2-cart-thumb">
                <?php if (!empty($item['producto_foto'])): ?><img src="<?php echo base_url('resources/images/productos/' . rawurlencode($item['producto_foto'])); ?>" alt=""><?php else: ?><span>—</span><?php endif; ?>
            </div>
            <div class="v2-cart-data">
                <strong><?php echo html_escape($item['producto_nombre']); ?></strong>
                <small><?php echo number_format((float) $item['carrito_cantidad'], 2, ',', '.'); ?> × Bs <?php echo number_format((float) $item['carrito_precio'], 2, ',', '.'); ?></small>
            </div>
            <div class="v2-cart-price">Bs <?php echo number_format((float) $item['carrito_total'], 2, ',', '.'); ?></div>
            <button class="v2-cart-remove" type="button" data-remove-cart="<?php echo (int) $item['producto_id']; ?>" aria-label="Quitar producto">×</button>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
