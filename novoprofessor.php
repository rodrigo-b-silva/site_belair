<?php
    include_once('./cabecalho.html');
    require_once("./config/configBD.php");
    $conexao = conn_mysql();

    if(!empty($_POST["nome"]) AND !empty($_POST["email"]) AND !empty($_POST["senha"])
        AND !empty($_POST["universidade"]) AND !empty($_POST["curso"])){

            $nome = htmlspecialchars($_POST["nome"]);
            $email = htmlspecialchars($_POST["email"]);
            $senha = htmlspecialchars($_POST["senha"]);
            $universidade = htmlspecialchars($_POST["universidade"]);
            $curso = htmlspecialchars($_POST["curso"]);

        try{

        
            $sql = "INSERT INTO professor (id,nome,email,senha,universidade,curso) 
                    VALUES(null,'$nome','$email','$senha','$universidade','$curso')";
            
            $stmt = $conexao->prepare($sql);
            $inserir = $stmt->execute();

            if($inserir){
                echo '<div class="alert alert-success alert-dismissible fade show my-5">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo '<strong>Sucesso!</strong> Cadastro realizado com sucesso!</div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show my-5">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo '<strong>Erro!</strong> Não foi realizar o cadastro. Tente novamente.</div>';
            }
        } catch(PDOException $e){
            // caso ocorra uma exceção, exibe na tela
            echo "Erro!: " . $e->getMessage() . "<br>";
            die();
        }  
    }
    
?>
<div class="container">

    <div class="template-cadastro">
        
        <h3 class="form-signin-heading text-center txt-verde-escuro">Cadastro professor</h3>
        <form class="form-signin" role="form" method="post" action="./novoprofessor.php">
            <input type="text" class="form-control" placeholder="Digite o seu nome" name="nome" maxlength="50"
                required autofocus><br>
            <input type="email" class="form-control" placeholder="Email" name="email" maxlength="50"required><br>
            <input type="password" class="form-control" placeholder="Senha de 6 dígitos" name="senha" maxlength="6" required><br>
            <input type="text" class="form-control" placeholder="Universidade" name="universidade" maxlength="50" required ><br>
            <input type="text" class="form-control" placeholder="Curso" name="curso" maxlength="30" required ><br><br>
            <button class="btn btn-lg btn-info btn-block" type="submit">Cadastrar</button>
            <hr>
            <button class="btn btn-lg btn-success btn-block" type="button" 
                onclick="javascript:window.location.href='./login.php'">Fazer login</button>
        </form>
    </div>
</div><!-- /.container -->

<?php 
    include_once('./rodape.html');
?>