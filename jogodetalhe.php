<?php
    include_once('./app.php');
    require_once("./config/configBD.php");

    $conexao = conn_mysql();
    $email = utf8_encode($_SESSION['email']);
    $professorId = utf8_encode($_SESSION['professorid']);
    $jogoid = $_GET["id"];
?>

<div class="content">
    <h2 class="content-title">Detalhes do jogo</h2>
    <div class="dashboard-content">

<?php

    $conexao = conn_mysql();

    try{

        //verifica se o jogo pertence ao professor
        $sqlJogoProfessor = "SELECT j.titulo, c.nome, q.id FROM jogo j 
                            JOIN professor p ON j.professorid = p.id JOIN categoria c ON c.id = j.categoriaid 
                            JOIN questao q ON q.categoria = c.id 
                            WHERE p.id = ? AND j.id = ?";
        $stmt = $conexao->prepare($sqlJogoProfessor);
        $stmt->execute(array($professorId, $jogoid));
        $resultadosJogo = $stmt->fetchAll();
        
        if(count($resultadosJogo) > 0){

            $qtdQuestao = 0;
            foreach($resultadosJogo as $questao){
                $qtdQuestao++;
            }
            $qtdQuestao -= 1;

            $sqlIntegranteJogo = "SELECT * FROM integrante_jogo 
                                WHERE jogoid = ?
                                ORDER BY pontuacao DESC";
            $stmt = $conexao->prepare($sqlIntegranteJogo);
            $stmt->execute(array($jogoid));
            $resultadosIntegrante = $stmt->fetchAll();

            $ganhador;
            $ganhadorNota = -1;
            $totalMaiorMedia = 0;
            $totalIntegrante = 0;
            $tbody = '';

            foreach($resultadosIntegrante as $integrante){
                $totalIntegrante++;
                
                if($integrante["pontuacao"] >= ($qtdQuestao/2)){
                    $totalMaiorMedia++;
                }

                if($integrante["pontuacao"] > $ganhadorNota){
                    $ganhadorNota = $integrante["pontuacao"];
                    $ganhador = $integrante["RA"];
                }

                $tbody .= '<tr><td>'.$integrante["RA"].'</td><td>'.$integrante["pontuacao"].'</td></tr>';
            }

            ?>
            
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 p-3 boxdash">
                        <div class="bg-success p-3 box-detail">
                            <i class="p-3 fas fa-users"></i>
                            <span class="dashnumber"><?php echo $totalIntegrante-1; ?></span><br>
                            <span>INTEGRANTES NO JOGO</span>
                        </div>
                    </div>
                    <div class="col-sm-4 p-3 boxdash">
                        <div class="bg-warning p-3 box-detail">
                            <i class="p-3 far fa-file-alt"></i>
                            <span class="dashnumber"><?php echo $qtdQuestao; ?></span><br>
                            <span>QUESTÕES NO JOGO</span>
                        </div>
                    </div>
                    <div class="col-sm-4 p-3 boxdash">
                        <div class="bg-danger p-3 box-detail">
                            <i class="p-3 fas fa-trash"></i>
                            <span class="dashnumber"><?php echo $totalMaiorMedia-1; ?></span><br>
                            <span>ACERTARAM MAIS DA METADE</span>
                        </div>
                    </div>
                </div>

                <h2 class="txt-verde-dark mt-3">Titulo: <?php echo $resultadosJogo[0]['titulo']; ?></h2>
                <h2 class="txt-verde-dark">Categoria: <?php echo $resultadosJogo[0]['nome']; ?></h2>

                <div class="row mt-5">
                    <div class="col-sm-5">
                        <h4 class="txt-verde-dark">Vencedor: <span class="vencedor"><?php echo $ganhador; ?></span></h4>
                        <img src="./img/vencedor.png" alt="vencedor" class="img-vencedor">
                    </div>
                    <div class="col-sm-7">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-verde-dark text-light"><td>Integrante</td><td>Pontuação</td></tr>
                            </thead>
                            <tbody>
                                <?php echo $tbody; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            
            <?php

        } else {
            echo '<div class="starter-template">';
            echo "\n<h3 class=\sub-header\>Atenção: Você não tem permissão para visualizar este jogo</h3>";
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