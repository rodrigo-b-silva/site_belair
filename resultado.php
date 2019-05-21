<?php
    include_once('./cabecalho.html');
    require_once("./config/configBD.php");
?>

<div class="wrapper">
    <div class="wrapper-row row">
        <div class="container my-5">

<?php

    $conexao = conn_mysql();

    if(empty($_POST["qtd"]) || $_POST["qtd"] < '1'){
        echo '<div class="starter-template">';
        echo "\n<h3 class=\sub-header\>Erro: não foi possivel coletar os resultados.</h3>";
        echo '<a href="./index.php">Voltar</a>';
        echo '</div>';

    } else {

        try{

            $qtd = $_POST["qtd"];
            $chave = $_POST["chave"];
            $ra = $_POST["ra"];
            $jogoid;

            //resgata questões correspondente a chave informada do jogo
            $sqlQuestoes = "SELECT j.id as jogoid, j.titulo, q.enunciado, q.id as questaoId, q.alternativa1, q.alternativa2, q.alternativa3, q.alternativa4, q.correta FROM jogo j 
                            JOIN categoria c ON j.categoriaid = c.id 
                            JOIN questao q ON c.id = q.categoria
                            WHERE j.chave = ? AND j.finalizado = 0";

            $stmt = $conexao->prepare($sqlQuestoes);
            $stmt->execute(array($chave));
            $resultados = $stmt->fetchAll();

            //Coleta as alternativas corretas das questões
            $i = 1;
            $corretas = array();
            foreach($resultados as $questao){
                $qID = utf8_decode($questao["questaoId"]);
                $corretas['q'.$qID] = utf8_decode($questao["correta"]);
                $i++;
                $jogoid = $questao["jogoid"];
            }
            
            $pontuacao = 0;
            foreach ($_POST as $key => $value){
                if($key != 'chave' AND $key != 'qtd' AND $key != 'ra'){
                    
                    $correct = $corretas[$key];
                    $answer = $value;

                    if($correct == $answer){
                        $pontuacao++;
                    }
                }
            }

            $sqlIntegrante = "INSERT INTO integrante_jogo (jogoid, RA, pontuacao)
                              VALUES (?, ?, ?)";
            
            $stmt = $conexao->prepare($sqlIntegrante);

            $inserir = $stmt->execute(array($jogoid, $ra, $pontuacao));

            if($inserir){
                echo '<div class="starter-template">';
                echo "\n<h3 class=\sub-header\>Sua pontuação no jogo foi:</h3>";
                echo '<h1 class="display-2">' . $pontuacao . '</h1>';
                echo '<a href="./index.php">Voltar</a>';
                echo '</div>';        
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show my-5">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo '<strong>Erro!</strong> falha ao responder o questionário</div>';
            }

        } catch(PDOException $e){
            // caso ocorra uma exceção, exibe na tela
            echo "Erro!: " . $e->getMessage() . "<br>";
            die();
        }
    }

?>

        </div>
    </div>
</div>