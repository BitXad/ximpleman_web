// Conección con app - api de facebook
window.fbAsyncInit = function() {
    FB.init({
        appId      : '711005146491995',     //<=== Cambiar por el appID del cliente
        cookie     : true,                     // Enable cookies to allow the server to access the session.
        xfbml      : true,                     // Parse social plugins on this webpage.
        version    : 'v8.0'                     // Use this Graph API version for this call.
    });
};

function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.  
        FB.api('/me', function(response) {
            // sesionFacebook(response.name,response.id);
            tieneCuenta(response.name,response.id);
        });
    } else {                                 // Not logged into your webpage or we are unable to tell.
        document.getElementById('status').innerHTML = 'Please log ' + 'into this webpage.';
    }
}

function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
        statusChangeCallback(response);
    });
}
// Registrar con facebook