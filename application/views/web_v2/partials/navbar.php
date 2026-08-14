<?php
if (!function_exists('v2_menu_url')) {
    function v2_menu_url($enlace) {
        $enlace = trim((string) $enlace);
        if ($enlace === '' || $enlace === '#') return '#';
        if (preg_match('~^(https?:)?//~i', $enlace)) return $enlace;
        return base_url(ltrim($enlace, '/'));
    }
}
?>
<nav class="v2-nav" aria-label="Navegación principal">
    <div class="v2-shell v2-nav-inner">
        <button class="v2-menu-toggle" type="button" aria-expanded="false" aria-controls="v2-main-menu">
            <span></span><span></span><span></span><b>Menú</b>
        </button>

        <ul class="v2-main-menu" id="v2-main-menu">
            <li><a href="<?php echo site_url('website_v2/index/' . (int) $idioma_id); ?>">Inicio</a></li>
            <?php foreach ($menu as $principal): ?>
                <?php $hasMenus = !empty($principal['menus']); ?>
                <li class="<?php echo $hasMenus ? 'has-children' : ''; ?>">
                    <a href="<?php echo html_escape(v2_menu_url($principal['menup_enlace'])); ?>">
                        <?php echo html_escape($principal['menup_nombre']); ?>
                    </a>
                    <?php if ($hasMenus): ?>
                        <button class="v2-sub-toggle" type="button" aria-label="Abrir submenú">⌄</button>
                        <ul class="v2-dropdown">
                            <?php foreach ($principal['menus'] as $item): ?>
                                <li class="<?php echo !empty($item['submenus']) ? 'has-children' : ''; ?>">
                                    <a href="<?php echo html_escape(v2_menu_url($item['menu_enlace'])); ?>">
                                        <?php echo html_escape($item['menu_nombre']); ?>
                                    </a>
                                    <?php if (!empty($item['submenus'])): ?>
                                        <ul class="v2-dropdown v2-dropdown-nested">
                                            <?php foreach ($item['submenus'] as $sub): ?>
                                                <li><a href="<?php echo html_escape(v2_menu_url($sub['submenu_enlace'])); ?>"><?php echo html_escape($sub['submenu_nombre']); ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            <li><a href="#productos">Productos</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
    </div>
</nav>
