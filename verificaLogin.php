<?php

if(!empty($_POST["email"]) AND !empty($_POST["senha"])){

    require_once("./config/configBD.php");

    $email = utf8_encode(htmlspecialchars($_POST["email"]));
    $senha = utf8_encode(htmlspecialchars($_POST["senha"]));

    try{
        
        $conexao = conn_mysql();

        $sqlLogin = "SELECT id, email FROM professor WHERE email=? AND senha=?";
    
        $stmt = $conexao->prepare($sqlLogin);

        $stmt->execute(array($email, $senha));

        $resultados = $stmt->fetchAll();

        $stmt = null;
        $conexao = null;

        if(count($resultados) != 1){
            header("Location:./erroLogin.php");
            die();
        } else {
            session_start();

            $_SESSION['auth'] = true;
            $_SESSION['email'] = $resultados[0]['email'];
            $_SESSION['professorid'] = $resultados[0]['id'];

            header("Location: ./dashboard.php");
		    die();
        }        
        
    } catch(PDOException $e){
        // caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
    }    
    

} else {
    header("Location:./erroLogin.php");
    die();
}



?>