<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'belair';

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
    die("Conexão falhou" . $conn->connect_error);
} else {
    echo "Conexão realizada com sucesso";
}


?>