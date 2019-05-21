<?php
    include_once('./cabecalho.html');
    require_once("./config/configBD.php");
?>

<div class="wrapper">
    <div class="wrapper-row row">
        <div class="container my-5">

<?php

    $conexao = conn_mysql();

    if(!empty($_POST["ra"]) AND !empty($_POST["chave"])){

        $ra = htmlspecialchars($_POST["ra"]);
        $chave = htmlspecialchars($_POST["chave"]);

        try{
        
            //Verifica se existe um jogo com esta chave
            $sqlJogo = "SELECT *FROM jogo j WHERE chave = ? AND j.finalizado = 0";
            $stmt = $conexao->prepare($sqlJogo);
            $stmt->execute(array($chave));
            $resultados = $stmt->fetchAll();

            if(count($resultados) > 0){

                //verifica se o respectivo RA ja respondeu as questões deste jogo
                $sqlIntegranteExist = "SELECT *FROM integrante_jogo ij 
                                        JOIN jogo j ON ij.jogoid = j.id
                                        WHERE j.chave = ? 
                                        AND ij.RA = ?";
                $stmt = $conexao->prepare($sqlIntegranteExist);
                $stmt->execute(array($chave, $ra));
                $resultados = $stmt->fetchAll();
                if(count($resultados) > 0){

                    echo '<div class="starter-template">';
                    echo "\n<h3 class=\sub-header\>Atenção: Você já respondeu as questões deste jogo.</h3>";
                    echo '<a href="./index.php">Voltar</a>';
                    echo '</div>';
                    
                } else {

                    //resgata questões correspondente a chave informada do jogo
                    $sqlQuestoes = "SELECT j.titulo, q.enunciado, q.id as questaoid, q.alternativa1, q.alternativa2, q.alternativa3, q.alternativa4, q.correta FROM jogo j 
                                    JOIN categoria c ON j.categoriaid = c.id 
                                    JOIN questao q ON c.id = q.categoria
                                    WHERE j.chave = ? AND j.finalizado = 0";

                    $stmt = $conexao->prepare($sqlQuestoes);
                    $stmt->execute(array($chave));
                    $resultados = $stmt->fetchAll();

                    if(count($resultados) > 0){

                        echo '<form action="./resultado.php" method="POST">';

                        $i = 1;
                        foreach($resultados as $questao){
                            $qID = utf8_decode($questao["questaoid"]);
                            echo '<div class="card my-3">';
                            echo '<div class="card-header">';
                            echo "<h3>".utf8_decode($questao["enunciado"])."</h3>";
                            echo "</div>";
                            echo '<ul class = "list-group">';
                            
                            echo '<li class = "list-group-item">';
                            echo '<div class="radio">';
                            echo '<input type="radio" name="q'.$questao["questaoid"].'" value="1" id="q'.$i.'alt1" required/>';
                            echo '<label class="ml-3" for="q'.$i.'alt1">'.utf8_decode($questao["alternativa1"]).'</label>';
                            echo '</div>';
                            echo '</li>';

                            echo '<li class = "list-group-item">';
                            echo '<div class="radio">';
                            echo '<input type="radio" name="q'.$questao["questaoid"].'" value="2" id="q'.$i.'alt2" required/>';
                            echo '<label class="ml-3" for="q'.$i.'alt2">'.utf8_decode($questao["alternativa2"]).'</label>';
                            echo '</div>';
                            echo '</li>';

                            echo '<li class = "list-group-item">';
                            echo '<div class="radio">';
                            echo '<input type="radio" name="q'.$questao["questaoid"].'" value="3" id="q'.$i.'alt3" required/>';
                            echo '<label class="ml-3" for="q'.$i.'alt3">'.utf8_decode($questao["alternativa3"]).'</label>';
                            echo '</div>';
                            echo '</li>';

                            echo '<li class = "list-group-item">';
                            echo '<div class="radio">';
                            echo '<input type="radio" name="q'.$questao["questaoid"].'" value="4" id="q'.$i.'alt4" required/>';
                            echo '<label class="ml-3" for="q'.$i.'alt4">'.utf8_decode($questao["alternativa4"]).'</label>';
                            echo '</div>';
                            echo '</li>';
                            
                            echo '</ul></div>';

                            $i++;
                        }

                        echo '<input type="hidden" name="qtd" value="'.($i - 1).'">';
                        echo '<input type="hidden" name="chave" value="'.$chave.'">';
                        echo '<input type="hidden" name="ra" value="'.$ra.'">';
                        echo '<button type="submit" class="btn btn-lg btn-primary my-5" id="endgame">Finalizar</button>';
                        echo '</form>';

                    } else{
                        echo '<div class="starter-template">';
                        echo "\n<h3 class=\sub-header\>Não há questões cadastras para este jogo.</h3>";
                        echo '<a href="./sala.php">Voltar</a>';
                        echo '</div>';
                    }

                    $stmt = null;
                    $conexao = null;

                }

            } else{
                echo '<div class="starter-template">';
                echo "\n<h3 class=\sub-header\>Não existe jogo com esta chave. Tente novamente</h3>";
                echo '<a href="./sala.php">Voltar</a>';
                echo '</div>';
            }

        } catch(PDOException $e){
            // caso ocorra uma exceção, exibe na tela
            echo "Erro!: " . $e->getMessage() . "<br>";
            die();
        } 

    } else {
        echo "<h1>Erro: Ausencia de dados</h1>";
        echo '<a href="./index.php">Voltar</a>';
    }

?>

        </div>
    </div>
</div>

<?php
    include_once('./rodape.html');
?>