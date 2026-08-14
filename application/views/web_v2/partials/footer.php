<footer class="v2-footer" id="contacto">
    <div class="v2-shell v2-footer-grid">
        <div>
            <div class="v2-footer-brand"><?php echo html_escape(!empty($pagina['pagina_nombre']) ? $pagina['pagina_nombre'] : 'Ximpleman'); ?></div>
            <p><?php echo html_escape(!empty($pagina['pagina_informacion']) ? $pagina['pagina_informacion'] : 'Catálogo y ventas en línea.'); ?></p>
        </div>
        <div>
            <h4>Contacto</h4>
            <?php if (!empty($pagina['pagina_telefono'])): ?><p>☎ <?php echo html_escape($pagina['pagina_telefono']); ?></p><?php endif; ?>
            <?php if (!empty($pagina['pagina_direccion'])): ?><p>⌖ <?php echo html_escape($pagina['pagina_direccion']); ?></p><?php endif; ?>
            <?php if (!empty($mapa['mapa_latitud']) && !empty($mapa['mapa_longitud'])): ?>
                <a target="_blank" rel="noopener" href="https://www.google.com/maps/dir/?api=1&amp;destination=<?php echo rawurlencode($mapa['mapa_latitud'] . ',' . $mapa['mapa_longitud']); ?>">Cómo llegar</a>
            <?php endif; ?>
        </div>
        <div>
            <h4>Redes sociales</h4>
            <div class="v2-socials">
                <?php foreach ($redes as $red): ?>
                    <a target="_blank" rel="noopener" href="<?php echo html_escape($red['redsocial_direccion']); ?>" title="<?php echo html_escape($red['redsocial_nombre']); ?>">
                        <?php echo html_escape(mb_strtoupper(mb_substr($red['redsocial_nombre'], 0, 1))); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="v2-shell v2-footer-bottom">
        <span>© <?php echo date('Y'); ?> <?php echo html_escape(!empty($sistema['sistema_nombre']) ? $sistema['sistema_nombre'] : 'Ximpleman'); ?></span>
        <span>Web V2 · CodeIgniter 3 · PHP 8</span>
    </div>
</footer>
