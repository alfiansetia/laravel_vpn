<div id="g_id_onload" data-client_id="{{ env('GOOGLE_CLIENT_ID') }}" data-login_uri="{{ route('auth.onetap') }}"
    data-_token="{{ csrf_token() }}" data-auto_prompt="true">
</div>
<div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with"
    data-shape="rectangular" data-logo_alignment="left">
</div>
