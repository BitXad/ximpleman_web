<?php if (!empty($categorias)): ?>
<section class="v2-category-section">
    <div class="v2-shell">
        <div class="v2-section-heading v2-heading-inline">
            <div>
                <span class="v2-eyebrow">Explora</span>
                <h2>Categorías</h2>
            </div>
            <a href="#productos">Ver catálogo</a>
        </div>
        <div class="v2-category-strip">
            <?php foreach (array_slice($categorias, 0, 10) as $cat): ?>
                <button class="v2-category-card" type="button" data-category-quick="<?php echo (int) $cat['categoria_id']; ?>">
                    <span class="v2-category-icon">
                        <?php if (!empty($cat['categoria_imagen'])): ?>
                            <img src="<?php echo base_url('resources/images/categorias/' . rawurlencode($cat['categoria_imagen'])); ?>" alt="">
                        <?php else: ?>
                            <?php echo html_escape(mb_strtoupper(mb_substr($cat['categoria_nombre'], 0, 1))); ?>
                        <?php endif; ?>
                    </span>
                    <strong><?php echo html_escape($cat['categoria_nombre']); ?></strong>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
