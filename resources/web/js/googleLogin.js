// Google Identity Services
(function(){
    function msg(t, type){ if (typeof socialLoginMessage === 'function') socialLoginMessage(t, type); }
    function initGoogle(){
        var cfg=window.XIMPLEMAN_SOCIAL||{};
        var holder=document.getElementById('google_login_button');
        if(!holder) return;
        if(!cfg.googleClientId){ holder.innerHTML='<div style="font-size:12px;color:#999;text-align:center">Configura Google Login</div>'; return; }
        if(!(window.google&&google.accounts&&google.accounts.id)){ setTimeout(initGoogle,250); return; }
        google.accounts.id.initialize({client_id:cfg.googleClientId,callback:handleGoogleCredential});
        google.accounts.id.renderButton(holder,{type:'standard',theme:'outline',size:'large',text:'continue_with',shape:'rectangular',logo_alignment:'left',width:260});
    }
    window.handleGoogleCredential=function(response){
        if(!response||!response.credential){ msg('No se recibió la credencial de Google.','error'); return; }
        msg('Validando acceso con Google...','');
        var ipe=document.getElementById('miip')?document.getElementById('miip').value:'';
        var baseUrl=document.getElementById('base_url').value;
        $.ajax({url:baseUrl+'website/social_login_google',type:'POST',dataType:'json',data:{credential:response.credential,ipe:ipe},success:function(r){
            if(r&&r.ok){ msg('Acceso correcto. Redirigiendo...','success'); window.location.href=baseUrl+'website/miperfil/'+((window.XIMPLEMAN_SOCIAL||{}).idiomaId||1); }
            else msg((r&&r.message)?r.message:'No se pudo iniciar sesión con Google.','error');
        },error:function(xhr){ var m='No se pudo iniciar sesión con Google.'; if(xhr.responseJSON&&xhr.responseJSON.message)m=xhr.responseJSON.message; msg(m,'error'); }});
    };
    if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',initGoogle); else initGoogle();
})();
