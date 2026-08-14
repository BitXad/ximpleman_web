<?php if (!empty($secciones)): ?>
<section class="v2-content-sections">
    <div class="v2-shell v2-section-cards">
        <?php foreach (array_slice($secciones, 0, 3) as $seccion): ?>
            <article class="v2-info-card">
                <span class="v2-info-number"><?php echo str_pad((int) $seccion['seccion_tipo'], 2, '0', STR_PAD_LEFT); ?></span>
                <h3><?php echo html_escape($seccion['seccion_titulo']); ?></h3>
                <?php if (!empty($seccion['seccion_descripcion'])): ?><p><strong><?php echo html_escape($seccion['seccion_descripcion']); ?></strong></p><?php endif; ?>
                <?php if (!empty($seccion['seccion_texto'])): ?><div><?php echo nl2br(html_escape($seccion['seccion_texto'])); ?></div><?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>
