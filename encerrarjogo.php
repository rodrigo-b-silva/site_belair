<?php
    include_once('./app.php');
    require_once("./config/configBD.php");

    $conexao = conn_mysql();
    $email = utf8_encode($_SESSION['email']);
    $professorId = utf8_encode($_SESSION['professorid']);
    $jogoid = $_GET["id"];
?>

<div class="content">
    <h2 class="content-title">Finalização de jogo</h2>
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
            $sqlUpdateStatusJogo = "UPDATE jogo j SET finalizado = 1
                                    WHERE j.professorid = ? AND j.id = ?";
            $stmt = $conexao->prepare($sqlUpdateStatusJogo);
            $update = $stmt->execute(array($professorId, $jogoid));

            if($update){

                //obtem o RA do aluno que tirou a maior nota do jogo
                $sqlGanhador = "SELECT ij.RA, MAX(ij.pontuacao) 
                                FROM integrante_jogo ij
                                WHERE ij.jogoid = ?";
                $stmt = $conexao->prepare($sqlGanhador);
                $stmt->execute(array($jogoid));
                $resultados = $stmt->fetchAll();
                if(count($resultados) > 0){
                    $ra = $resultados[0]['RA'];

                    //atualiza o campo ganhador do jogo com o RA do aluno com a maior nota
                    $sqlGanhadorJogo = "UPDATE jogo j SET j.ganhador = ?
                                        WHERE j.id = ?";
                    $stmt = $conexao->prepare($sqlGanhadorJogo);
                    $updateGanhador = $stmt->execute(array($ra, $jogoid));
                   
                    if($updateGanhador){
                        echo '<div class="starter-template">';
                        echo "\n<h3 class=\sub-header\>Jogo finalizado com sucesso!</h3>";
                        echo '<a href="./jogos.php">Voltar</a>';
                        echo '</div>';
    
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show my-5">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo '<strong>Erro!</strong> Não foi possivel obter o ganhador do jogo. Tente novamente mais tarde.</div>';
                        echo '<a href="./jogos.php">Voltar</a>';
                    }

                }

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show my-5">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo '<strong>Erro!</strong> Não foi possivel finalizar o jogo. Tente novamente mais tarde.</div>';
                echo '<a href="./jogos.php">Voltar</a>';
            }

        } else {
            echo '<div class="starter-template">';
            echo "\n<h3 class=\sub-header\>Atenção: Você não tem permissão para finalizar este jogo</h3>";
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