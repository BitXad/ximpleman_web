// Facebook Login - flujo seguro (el token se valida también en el servidor)
window.fbAsyncInit = function() {
    var cfg = window.XIMPLEMAN_SOCIAL || {};
    if (!cfg.facebookAppId) {
        console.warn('Facebook Login: falta facebook_app_id en application/config/social_login.php');
        return;
    }
    FB.init({appId: cfg.facebookAppId, cookie: true, xfbml: true, version: 'v26.0'});
};

function socialLoginMessage(text, type) {
    var el = document.getElementById('social_login_message');
    if (!el) return;
    el.className = 'social-login-message' + (type ? ' ' + type : '');
    el.textContent = text || '';
}

function loginFacebookSeguro() {
    if (typeof FB === 'undefined') {
        socialLoginMessage('Facebook todavía no está disponible. Intenta nuevamente.', 'error');
        return;
    }
    socialLoginMessage('Conectando con Facebook...', '');
    FB.login(function(response) {
        if (!response.authResponse || !response.authResponse.accessToken) {
            socialLoginMessage('No se completó el acceso con Facebook.', 'error');
            return;
        }
        var ipe = document.getElementById('miip') ? document.getElementById('miip').value : '';
        var baseUrl = document.getElementById('base_url').value;
        $.ajax({
            url: baseUrl + 'website/social_login_facebook',
            type: 'POST',
            dataType: 'json',
            data: {access_token: response.authResponse.accessToken, ipe: ipe},
            success: function(r) {
                if (r && r.ok) {
                    socialLoginMessage('Acceso correcto. Redirigiendo...', 'success');
                    window.location.href = baseUrl + 'website/miperfil/' + ((window.XIMPLEMAN_SOCIAL || {}).idiomaId || 1);
                } else {
                    socialLoginMessage((r && r.message) ? r.message : 'No se pudo iniciar sesión con Facebook.', 'error');
                }
            },
            error: function(xhr) {
                var msg = 'No se pudo iniciar sesión con Facebook.';
                if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                socialLoginMessage(msg, 'error');
            }
        });
    }, {scope: 'public_profile,email'});
}

// Compatibilidad con el antiguo botón/plugin si alguna vista todavía lo usa.
function checkLoginState() { loginFacebookSeguro(); }
