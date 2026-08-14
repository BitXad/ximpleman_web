(function () {
    'use strict';

    var cfg = window.XIMPLEMAN_V2 || {};
    var qs = function (sel, root) { return (root || document).querySelector(sel); };
    var qsa = function (sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); };

    function post(url, data) {
        var body = new URLSearchParams();
        Object.keys(data || {}).forEach(function (key) { body.append(key, data[key]); });
        return fetch(url, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest'},
            body: body.toString(),
            credentials: 'same-origin'
        }).then(function (res) {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        });
    }

    function toast(message, type) {
        var el = qs('#v2-toast');
        if (!el) return;
        el.textContent = message;
        el.className = 'v2-toast is-visible' + (type === 'error' ? ' is-error' : '');
        clearTimeout(el._timer);
        el._timer = setTimeout(function () { el.classList.remove('is-visible'); }, 2600);
    }

    function initSlider() {
        var slider = qs('#v2-slider');
        if (!slider) return;
        var slides = qsa('.v2-slide', slider);
        var dots = qsa('.v2-slider-dots button', slider);
        if (slides.length < 2) return;
        var current = 0;
        var timer = null;
        var delay = parseInt(slider.getAttribute('data-autoplay'), 10) || 5500;

        function show(index) {
            current = (index + slides.length) % slides.length;
            slides.forEach(function (slide, i) {
                var active = i === current;
                slide.classList.toggle('is-active', active);
                slide.setAttribute('aria-hidden', active ? 'false' : 'true');
            });
            dots.forEach(function (dot, i) { dot.classList.toggle('is-active', i === current); });
        }
        function play() { stop(); timer = setInterval(function () { show(current + 1); }, delay); }
        function stop() { if (timer) clearInterval(timer); timer = null; }

        var prev = qs('.v2-slider-prev', slider);
        var next = qs('.v2-slider-next', slider);
        if (prev) prev.addEventListener('click', function () { show(current - 1); play(); });
        if (next) next.addEventListener('click', function () { show(current + 1); play(); });
        dots.forEach(function (dot) { dot.addEventListener('click', function () { show(parseInt(dot.dataset.slide, 10) || 0); play(); }); });
        slider.addEventListener('mouseenter', stop);
        slider.addEventListener('mouseleave', play);
        slider.addEventListener('focusin', stop);
        slider.addEventListener('focusout', play);
        play();
    }

    function initMenu() {
        var toggle = qs('.v2-menu-toggle');
        var menu = qs('#v2-main-menu');
        if (toggle && menu) {
            toggle.addEventListener('click', function () {
                var open = menu.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
        }
        qsa('.v2-sub-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () { btn.parentElement.classList.toggle('is-open'); });
        });
    }

    function openModal(name) {
        var modal = qs('#v2-modal-' + name);
        if (!modal) return;
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('v2-modal-open');
        if (name === 'cart') loadCart();
    }
    function closeModal(modal) {
        if (!modal) return;
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('v2-modal-open');
    }
    function initModals() {
        document.addEventListener('click', function (ev) {
            var opener = ev.target.closest('[data-modal-open]');
            if (opener) { ev.preventDefault(); openModal(opener.getAttribute('data-modal-open')); return; }
            var closer = ev.target.closest('[data-modal-close]');
            if (closer) { ev.preventDefault(); closeModal(closer.closest('.v2-modal')); }
        });
        document.addEventListener('keydown', function (ev) { if (ev.key === 'Escape') qsa('.v2-modal.is-open').forEach(closeModal); });
    }

    function setCartCount(value) {
        var el = qs('#v2-cart-count');
        if (el) el.textContent = Math.max(0, Math.round(parseFloat(value) || 0));
    }

    function loadCart() {
        var content = qs('#v2-cart-content');
        if (content) content.innerHTML = '<div class="v2-modal-loading">Cargando carrito…</div>';
        post(cfg.endpoints.carrito, {}).then(function (res) {
            if (content) content.innerHTML = res.html;
            setCartCount(res.cantidad);
            var total = qs('#v2-cart-total');
            if (total) total.textContent = 'Bs ' + Number(res.total || 0).toLocaleString('es-BO', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }).catch(function () {
            if (content) content.innerHTML = '<div class="v2-empty-state"><h3>No se pudo cargar el carrito</h3></div>';
        });
    }

    function initCart() {
        document.addEventListener('click', function (ev) {
            var add = ev.target.closest('[data-add-cart]');
            if (add) {
                ev.preventDefault();
                add.disabled = true;
                post(cfg.endpoints.agregarCarrito, {producto_id: add.dataset.addCart, cantidad: 1})
                    .then(function (res) { setCartCount(res.cantidad); toast(res.mensaje || 'Producto agregado.'); })
                    .catch(function () { toast('No se pudo agregar el producto.', 'error'); })
                    .finally(function () { add.disabled = false; });
                return;
            }
            var remove = ev.target.closest('[data-remove-cart]');
            if (remove) {
                ev.preventDefault();
                post(cfg.endpoints.quitarCarrito, {producto_id: remove.dataset.removeCart})
                    .then(loadCart)
                    .catch(function () { toast('No se pudo quitar el producto.', 'error'); });
            }
        });
    }

    function initCatalog() {
        var search = qs('#v2-search');
        var category = qs('#v2-category');
        var subcategory = qs('#v2-subcategory');
        var clear = qs('#v2-clear-filters');
        var grid = qs('#v2-product-grid');
        var label = qs('#v2-results-label');
        var loading = qs('#v2-loading');
        if (!search || !category || !grid) return;
        var debounce = null;

        function loadProducts() {
            if (loading) loading.hidden = false;
            grid.classList.add('is-loading');
            post(cfg.endpoints.productos, {
                q: search.value.trim(),
                categoria_id: category.value,
                subcategoria_id: subcategory ? subcategory.value : 0
            }).then(function (res) {
                grid.innerHTML = res.html;
                if (label) label.textContent = res.total + (res.total === 1 ? ' producto' : ' productos');
            }).catch(function () {
                toast('No se pudo actualizar el catálogo.', 'error');
            }).finally(function () {
                if (loading) loading.hidden = true;
                grid.classList.remove('is-loading');
            });
        }

        function loadSubcategories() {
            if (!subcategory) return Promise.resolve();
            subcategory.innerHTML = '<option value="0">Todas las subcategorías</option>';
            subcategory.disabled = true;
            if (!category.value || category.value === '0') return Promise.resolve();
            return post(cfg.endpoints.subcategorias, {categoria_id: category.value}).then(function (res) {
                (res.items || []).forEach(function (item) {
                    var opt = document.createElement('option');
                    opt.value = item.subcategoria_id;
                    opt.textContent = item.subcategoria_nombre;
                    subcategory.appendChild(opt);
                });
                subcategory.disabled = false;
            });
        }

        search.addEventListener('input', function () { clearTimeout(debounce); debounce = setTimeout(loadProducts, 320); });
        category.addEventListener('change', function () { loadSubcategories().then(loadProducts); });
        if (subcategory) subcategory.addEventListener('change', loadProducts);
        if (clear) clear.addEventListener('click', function () {
            search.value = '';
            category.value = '0';
            if (subcategory) { subcategory.innerHTML = '<option value="0">Todas las subcategorías</option>'; subcategory.disabled = true; }
            loadProducts();
        });

        qsa('[data-category-quick]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                category.value = btn.dataset.categoryQuick;
                loadSubcategories().then(loadProducts);
                var target = qs('#productos');
                if (target) target.scrollIntoView({behavior: 'smooth', block: 'start'});
            });
        });
    }

    function initLogin() {
        var form = qs('#v2-login-form');
        if (!form) return;
        var msg = qs('#v2-login-message');
        form.addEventListener('submit', function (ev) {
            ev.preventDefault();
            if (msg) msg.textContent = 'Verificando…';
            var body = new URLSearchParams(new FormData(form));
            fetch(cfg.endpoints.login, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest'},
                body: body.toString(),
                credentials: 'same-origin'
            }).then(function (res) {
                if (!res.ok) throw new Error('login');
                if (msg) msg.textContent = 'Sesión iniciada.';
                window.location.reload();
            }).catch(function () { if (msg) msg.textContent = 'Correo o contraseña incorrectos.'; });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initSlider();
        initMenu();
        initModals();
        initCart();
        initCatalog();
        initLogin();
    });
})();
