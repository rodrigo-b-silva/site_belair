<?php

session_start();

require "vendor/autoload.php";
require "config.php";

use GuzzleHttp\Client;

if(isset($_REQUEST["api"])){
    //Obtem a identificação API esta sendo utilizada (Google / Facebook)
    $api = $_REQUEST["api"];

    if(isset($_GET["code"])){
        //Obtem o código de autorização devolvido pelo Servidor de Autorização
        $code = $_GET["code"];
    } else {
        header("Refresh: 5; url=/FirstApp_AuthFacebookGoogle");
        echo "OAuth code não informado";
        die;
    }

    //Faz a requisição de acordo com a API escolhida
    switch($api){
        case 'google':
            $client = new Client();
            $response = $client->request("POST", $GOOGLE_API_TOKEN_URL, [
                "verify" => false,
                "http_errors" => false,
                "form_params" => [
                    "code" => $code,
                    "client_id" => $GOOGLE_CLIENT_ID,
                    "client_secret" => $GOOGLE_CLIENT_SECRET_KEY,
                    "redirect_uri" => $CALLBACK_URL . "?api=google",
                    "grant_type" => "authorization_code"
                ]
            ]);
            break;
        case 'facebook':
            $client = new Client();
            $response = $client->request("POST", $FACEBOOK_API_TOKEN_URL, [
                "verify" => false,
                "http_errors" => false,
                "form_params" => [
                    "code" => $code,
                    "client_id" => $FACEBOOK_CLIENT_ID,
                    "client_secret" => $FACEBOOK_CLIENT_SECRET_KEY,
                    "redirect_uri" => $CALLBACK_URL . "?api=facebook",
                    "grant_type" => "authorization_code"
                ]
            ]);
            break;
        default:
            break;
    }

    //Obtem o token de acesso a partir do retorno do Servidor de Autorização e salva na sessão do usuário
    $data = json_decode($response->getBody());
    $_SESSION["token"] = $data->access_token;

    //Redireciona para a pagina inicial que irá obter os dados do usuário a partir do Servidor de Recursos
    header('Location: /FirstApp_AuthFacebookGoogle');

} else {
    header('Refresh: 5; url=/FirstApp_AuthFacebookGoogle');
    echo "API não informada";
}



?>