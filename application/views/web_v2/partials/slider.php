<section class="v2-hero" aria-label="Promociones destacadas">
    <?php if (!empty($slides)): ?>
        <div class="v2-slider" id="v2-slider" data-autoplay="5500">
            <div class="v2-slider-track">
                <?php foreach ($slides as $index => $slide): ?>
                    <article class="v2-slide <?php echo $index === 0 ? 'is-active' : ''; ?>" aria-hidden="<?php echo $index === 0 ? 'false' : 'true'; ?>">
                        <img src="<?php echo base_url('resources/web/images/sliders/' . rawurlencode($slide['slide_imagen'])); ?>" alt="<?php echo html_escape($slide['slide_titulo']); ?>">
                        <div class="v2-slide-overlay"></div>
                        <div class="v2-shell v2-slide-content">
                            <?php if (!empty($slide['slide_titulo'])): ?><span class="v2-eyebrow"><?php echo html_escape($slide['slide_titulo']); ?></span><?php endif; ?>
                            <?php if (!empty($slide['slide_leyenda1'])): ?><h1><?php echo html_escape($slide['slide_leyenda1']); ?></h1><?php endif; ?>
                            <?php if (!empty($slide['slide_leyenda2'])): ?><p><?php echo html_escape($slide['slide_leyenda2']); ?></p><?php endif; ?>
                            <?php if (!empty($slide['slide_enlace'])): ?>
                                <a class="v2-btn v2-btn-primary" href="<?php echo html_escape(v2_menu_url($slide['slide_enlace'])); ?>">Ver más</a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if (count($slides) > 1): ?>
                <button class="v2-slider-arrow v2-slider-prev" type="button" aria-label="Anterior">‹</button>
                <button class="v2-slider-arrow v2-slider-next" type="button" aria-label="Siguiente">›</button>
                <div class="v2-slider-dots" aria-label="Seleccionar diapositiva">
                    <?php foreach ($slides as $index => $slide): ?>
                        <button type="button" class="<?php echo $index === 0 ? 'is-active' : ''; ?>" data-slide="<?php echo $index; ?>" aria-label="Ir a diapositiva <?php echo $index + 1; ?>"></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="v2-hero-empty">
            <div class="v2-shell">
                <span class="v2-eyebrow">Ximpleman Web V2</span>
                <h1><?php echo html_escape(!empty($pagina['pagina_nombre']) ? $pagina['pagina_nombre'] : 'Bienvenido'); ?></h1>
                <p><?php echo html_escape(!empty($pagina['pagina_informacion']) ? $pagina['pagina_informacion'] : 'Tu catálogo, pedidos y servicios en un solo lugar.'); ?></p>
            </div>
        </div>
    <?php endif; ?>
</section>
