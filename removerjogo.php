<?php
    include_once('./app.php');
    require_once("./config/configBD.php");

    $conexao = conn_mysql();
    $email = utf8_encode($_SESSION['email']);
    $professorId = utf8_encode($_SESSION['professorid']);
    $jogoid = $_GET["id"];
?>

<div class="content">
    <h2 class="content-title">Remoção de jogo</h2>
    <div class="dashboard-content">

<?php

    $conexao = conn_mysql();

    try{

        //verifica se o jogo pertence ao professor
        $sqlJogoProfessor = "SELECT *FROM jogo j
                            JOIN professor p ON j.professorid = p.id
                            WHERE p.id = ? AND j.id = ?";
        $stmt = $conexao->prepare($sqlJogoProfessor);
        $stmt->execute(array($professorId, $jogoid));
        $resultados = $stmt->fetchAll();
        
        if(count($resultados) > 0){

            //Atualiza o status do jogo inserindo um no campo 'finalizado'
            $sqlRemoverIntegranteJogo = "DELETE FROM integrante_jogo
                                        WHERE jogoid = ?";
            $stmt = $conexao->prepare($sqlRemoverIntegranteJogo);
            $deleteIJ = $stmt->execute(array($jogoid));
            if($deleteIJ){

                $sqlRemoverJogo = "DELETE FROM jogo
                                    WHERE professorid = ? AND id = ?";
                $stmt = $conexao->prepare($sqlRemoverJogo);
                $deleteJogo = $stmt->execute(array($professorId, $jogoid));

                if($deleteJogo){
                    echo '<div class="starter-template">';
                    echo "\n<h3 class=\sub-header\>Jogo removido com sucesso!</h3>";
                    echo '<a href="./jogos.php">Voltar</a>';
                    echo '</div>';

                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show my-5">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo '<strong>Erro!</strong> Não foi possivel remover o jogo. Tente novamente mais tarde.</div>';
                    echo '<a href="./jogos.php">Voltar</a>';
                }
            
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show my-5">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo '<strong>Erro!</strong> Não foi possivel remover o jogo. Tente novamente mais tarde.</div>';
                echo '<a href="./jogos.php">Voltar</a>';
            }              

        } else {
            echo '<div class="starter-template">';
            echo "\n<h3 class=\sub-header\>Atenção: Você não tem permissão para remover este jogo</h3>";
            echo '<a href="./jogos.php">Voltar</a>';
            echo '</div>';
        }

    } catch(PDOException $e){
        // caso ocorra uma exceção, exibe na tela
        echo "Erro!: " . $e->getMessage() . "<br>";
        die();
    }

?>
  
    </div>
</div>

<?php
    include_once('./rodapeapp.php');
?>