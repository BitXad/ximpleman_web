<section class="v2-catalog" id="productos">
    <div class="v2-shell">
        <div class="v2-section-heading">
            <span class="v2-eyebrow">Catálogo</span>
            <h2>Nuestros productos</h2>
            <p>Busca por nombre, código, marca, categoría o subcategoría.</p>
        </div>

        <div class="v2-filter-panel">
            <label class="v2-search-field">
                <span>⌕</span>
                <input id="v2-search" type="search" placeholder="Buscar un producto..." autocomplete="off">
            </label>
            <select id="v2-category">
                <option value="0">Todas las categorías</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?php echo (int) $cat['categoria_id']; ?>"><?php echo html_escape($cat['categoria_nombre']); ?></option>
                <?php endforeach; ?>
            </select>
            <select id="v2-subcategory" disabled>
                <option value="0">Todas las subcategorías</option>
            </select>
            <button id="v2-clear-filters" class="v2-btn v2-btn-light" type="button">Limpiar</button>
        </div>

        <div class="v2-catalog-meta">
            <span id="v2-results-label"><?php echo count($productos); ?> productos</span>
            <span id="v2-loading" class="v2-loading" hidden>Cargando…</span>
        </div>

        <div class="v2-product-grid" id="v2-product-grid">
            <?php $this->load->view('web_v2/partials/product_cards', array('productos' => $productos)); ?>
        </div>
    </div>
</section>
