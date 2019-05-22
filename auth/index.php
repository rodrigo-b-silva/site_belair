<?php

session_start();

require "vendor/autoload.php";
require "config.php";

use GuzzleHttp\Client;
$user_name = '';

if(isset($_SESSION["token"])){
    $token = $_SESSION["token"];
    try{
        $api = $_SESSION["api"];
        if($api == "google"){
            
        } elseif($api == "facebook"){

        }
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Sistema de Autenticação</title>
</head>
<body>
    <div class="container">
        <?php if(!isset($_SESSION["token"])) { ?>
            <div class="row">
                <div class="col-md-4 mx-auto my-5">
                    <form class="form-signin">
                        <h1 class="h3 mb-3 font-weight-normal text-center">Autenticação</h1>
                        <div class="form-group">
                            <label for="inputEmail" class="sr-only">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Endereço de email" autofocus="">    
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Senha">
                        </div>
                        <div class="checkbox mb-3">
                        <label class="form-group">
                            <input type="checkbox" value="lembrar"> Lembrar
                        </label>
                    </div>
                        <button class="btn btn-lg btn-success btn-block" type="submit">Logar</button>
                    </form>
                    <a href="./OAuthRequest.php?api=facebook" class="btn btn-lg btn-primary btn-block mt-2">
                        <i class="fa fa-facebook-square mr-3" style="font-size:30px;"></i>Logar com Facebook
                    </a>
                    <a href="./OAuthRequest.php?api=google" class="btn btn-lg btn-danger btn-block mt-2">
                        <i class="fa fa-google mr-3" style="font-size:30px;"></i>Logar com Google
                    </a>
                </div>
            </div>
        <?php } else { ?>
            <p>Olá <?php $user_name ?></p>
            <a href="logout.php">Logout</a>
        <?php } ?>    
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>