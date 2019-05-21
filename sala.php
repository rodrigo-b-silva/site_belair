<?php
    include_once('./cabecalho.html');
?>

<div class="wrapper">
    <div class="wrapper-row row">

        <div class="container my-5">
            <div class="row">
                <div class="col-sm-6">
                    <form method="post" action="./game.php">
                        <div class="form-group">
                            <label for="ra">RA:</label>
                            <input type="text" class="form-control" id="ra" name="ra" required minlength="8" maxlength="8">
                        </div>
                        <div class="form-group">
                            <label for="chave">Chave secreta:</label>
                            <input type="text" class="form-control" id="chave" name="chave" required maxlength="4">
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary">Acessar</button>
                        <a href="./index.php" class="btn btn-lg btn-danger">Voltar</a>
                    </form>
                </div>
                <div class="col-sm-6">
                    <img src="./img/game.png" alt="" style="width: 100%;">
                </div>
            </div>        
        </div>
        
    
    </div>
</div>

<?php
    include_once('./rodape.html');
?>