<?php
    include_once('./app.php');
    require_once("./config/configBD.php");

    $conexao = conn_mysql();
    $email = utf8_encode($_SESSION['email']);
    $professorId = utf8_encode($_SESSION['professorid']);

    if(!empty($_POST["titulo"]) AND !empty($_POST["categoria"]) AND !empty($_POST["chave"])){

        $newGameTitulo = htmlspecialchars($_POST["titulo"]);
        $newGameCategoria = htmlspecialchars($_POST["categoria"]);
        $newGameChave = htmlspecialchars($_POST["chave"]);

        try{
            $currentDate = date('Y-m-d', time());
            
            $sqlNewGame = "INSERT INTO jogo(id, titulo, categoriaid, professorid, datajogo, ganhador, chave, finalizado) 
            VALUES(null, ?, ?, ?, ?, null, ?, 0);";

            $stmt = $conexao->prepare($sqlNewGame);

            $inserir = $stmt->execute(array($newGameTitulo, $newGameCategoria, $professorId, $currentDate, $newGameChave));

            if($inserir){
                echo '<div class="alert alert-success alert-dismissible fade show my-5">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo '<strong>Sucesso!</strong> Jogo criado, informe a chave secreta aos aluno: '. $newGameChave .'</div>';

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show my-5">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo '<strong>Erro!</strong> Não foi possivel criar o jogo. Tente novamente.</div>';
            }

        } catch(PDOException $e){
            // caso ocorra uma exceção, exibe na tela
            echo "Erro!: " . $e->getMessage() . "<br>";
            die();
        }        

    }

?>

<div class="content">
    <h2 class="content-title">Meus Jogos</h2>
    <div class="dashboard-content">

<?php

    try{

        $sqlJogos = "SELECT j.id AS jogoid, j.titulo, j.datajogo, j.ganhador, a.nome, j.finalizado FROM jogo j
                    JOIN professor p ON p.id = j.professorid
                    LEFT JOIN aluno a ON a.RA = j.ganhador
                    WHERE p.email = ?";

        $stmt = $conexao->prepare($sqlJogos);

        $stmt->execute(array($email));

        $resultados = $stmt->fetchAll();

        $stmt = null;
        $conexao = null;

        if(count($resultados) > 0){
            echo '<table class="table">';
            echo '<thead><tr><td>Titulo</td><td>Data</td><td>Ganhador</td><td>Ações</td></tr></thead>';
            echo '<tbody>';
            foreach($resultados as $jogo){
                echo "<tr><td>".utf8_decode($jogo["titulo"])."</td>";
                echo "<td>".utf8_decode($jogo["datajogo"])."</td>";

                if( $jogo["nome"] == ''){
                    echo "<td> - </td>";
                } else {
                    echo "<td>".utf8_decode($jogo["nome"])."</td>";
                }

                echo '<td><a href="./jogodetalhe.php?id='.htmlspecialchars($jogo["jogoid"]).'">
                    <i class="fas fa-file-alt" title="detalhes"></i>';

                    if($jogo["finalizado"] != '1'){
                    echo '<a href="./encerrarjogo.php?id='.htmlspecialchars($jogo["jogoid"]).'">
                        <i class="fas fa-ban" title="encerrar"></i></td></tr>'; 
                    }

                    if($jogo["finalizado"] == '1'){
                        echo '<a href="./removerjogo.php?id='.htmlspecialchars($jogo["jogoid"]).'">
                            <i class="fas fa-trash" title="remover"></i></td></tr>'; 
                    }
            }
            echo '</tbody></table>';
        } else{
			echo '<div class="starter-template">';
			echo "\n<h3 class=\sub-header\>Nenhum jogo encontrado.</h3>";
			echo '</div>';
		}

    } catch(PDOException $e){
        // caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
    } 

?>

        <div class="row">
            <a href="novojogo.php" class="addgame-link">
                <div class="addgame text-right">+</div>
            </a>
        </div>
    </div>
</div>

<?php
    include_once('./rodapeapp.php');
?>