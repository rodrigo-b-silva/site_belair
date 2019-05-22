<?php

//Declaração da URL de callback para a qual o Servidor de autorização
//deverá encaminhar o retorno com o código de autorização
$CALLBACK_URL = 'http//localhost/FirstApp_AuthFacebookGoogle/OAuthCallback.php';

//Configuração da API GOOGLE
$GOOGLE_API_AUTH_URL = 'https://accounts.google.com/o/oauth2/auth';
$GOOGLE_API_TOKEN_URL = 'https://accounts.google.com/o/oauth2/token';
$GOOGLE_API_RESOURCE_URL = 'https://www.googleapis.com/oauth2/v1/userinfo';
$GOOGLE_CLIENT_ID = 'COLOQUE AQUI SEU CLIENT_ID';
$GOOGLE_CLIENT_SECRET_KEY = 'COLOQUE AQUI SUA SECRET KEY';
$GOOGLE_SCOPE = 'https://www.googleapis.com/auth/plus.me';

//Configuração da API FACEBOOK
$FACEBOOK_API_AUTH_URL = 'https://www.facebook.com/v2.8/dialog/oauth';
$FACEBOOK_API_TOKEN_URL = 'https://graph.facebook.com/v2.8/oauth/access_token';
$FACEBOOK_API_RESOURCE_URL = 'https://www.facebook.com/v2.8/me';
$FACEBOOK_CLIENT_ID = 'COLOQUE AQUI SEU CLIENT_ID';
$FACEBOOK_CLIENT_SECRET_KEY = 'COLOQUE AQUI SUA SECRET KEY';
$FACEBOOK_SCOPE = 'public_profile, email';

?>