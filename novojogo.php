<?php
    include_once('./app.php');
    require_once("./config/configBD.php");

    try{
        $conexao = conn_mysql();
        $email = utf8_encode($_SESSION['email']);

        $sqlCategorias = "SELECT id, nome FROM categoria";

        $stmt = $conexao->prepare($sqlCategorias);

        $stmt->execute();

        $resultados = $stmt->fetchAll();

        $stmt = null;
        $conexao = null;
    
    } catch(PDOException $e){
        // caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
    } 

    function generateRandom(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
?>

<div class="content">
    <h2 class="content-title">Novo Jogo</h2>
    <div class="dashboard-content">
        <form class="form" method="POST" action="./jogos.php">
            <div class="form-group">
                <label for="">Titulo</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Escolher banco de questão</label>
                <select name="categoria" class="form-control" required>
                    <?php
                        foreach($resultados as $categoria){
                            echo '<option value="'.utf8_decode($categoria["id"]).'">'.
                                utf8_decode($categoria["nome"]).'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="chave" value="<?php echo generateRandom(); ?>" class="form-control" 
                    minlength="4" maxlength="4" required>
            </div>
            <button type="submit" class="newgame text-right" id="">Adicionar</button>
        </form>
    </div>
</div>

<?php
    include_once('./rodapeapp.php');
?>
