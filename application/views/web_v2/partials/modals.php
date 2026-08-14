<div class="v2-modal" id="v2-modal-cart" aria-hidden="true">
    <div class="v2-modal-backdrop" data-modal-close></div>
    <div class="v2-modal-panel v2-cart-panel" role="dialog" aria-modal="true" aria-labelledby="v2-cart-title">
        <div class="v2-modal-header">
            <div><span class="v2-eyebrow">Tu compra</span><h2 id="v2-cart-title">Carrito</h2></div>
            <button type="button" class="v2-modal-close" data-modal-close aria-label="Cerrar">×</button>
        </div>
        <div id="v2-cart-content" class="v2-cart-content"><div class="v2-modal-loading">Cargando carrito…</div></div>
        <div class="v2-cart-summary">
            <div><span>Total</span><strong id="v2-cart-total">Bs 0,00</strong></div>
            <a class="v2-btn v2-btn-primary v2-btn-block" href="<?php echo site_url('website/micarrito/' . (int) $idioma_id); ?>">Continuar compra</a>
        </div>
    </div>
</div>

<div class="v2-modal" id="v2-modal-login" aria-hidden="true">
    <div class="v2-modal-backdrop" data-modal-close></div>
    <div class="v2-modal-panel v2-login-panel" role="dialog" aria-modal="true" aria-labelledby="v2-login-title">
        <div class="v2-modal-header">
            <div><span class="v2-eyebrow">Bienvenido</span><h2 id="v2-login-title">Iniciar sesión</h2></div>
            <button type="button" class="v2-modal-close" data-modal-close aria-label="Cerrar">×</button>
        </div>
        <form id="v2-login-form" class="v2-login-form">
            <label>Correo electrónico<input type="email" name="login" required autocomplete="username"></label>
            <label>Contraseña<input type="password" name="clave" required autocomplete="current-password"></label>
            <input type="hidden" name="ipe" value="<?php echo html_escape($cliente_key); ?>">
            <button class="v2-btn v2-btn-primary v2-btn-block" type="submit">Ingresar</button>
            <p class="v2-form-message" id="v2-login-message"></p>
        </form>
    </div>
</div>
