<?php
    include_once('./cabecalho.html');
?>

<div class="container">

    <div class="template-login">
        
        <form class="form-signin" role="form" method="post" action="./verificaLogin.php">
            <h3 class="form-signin-heading text-center">BelAir - Login</h3>
            <input type="text" class="form-control" placeholder="Login" name="email" 
                required autofocus>
            <input type="password" class="form-control" placeholder="Senha" name="senha" required>
            
            
            <input type="checkbox"  name="lembrarLogin" value="loginAutomatico">
            <label>Permanecer conectado</label>
            
            <button class="btn btn-lg btn-info btn-block" type="submit">Entrar</button>
            
            <a href="./auth/OAuthRequest.php?api=facebook" class="btn btn-lg btn-primary btn-block mt-2">
                <i class="fab fa-facebook-square mr-3" style="font-size:30px;"></i>Logar com Facebook
            </a>
            <a href="./auth/OAuthRequest.php?api=google" class="btn btn-lg btn-danger btn-block mt-2">
                <i class="fab fa-google mr-3" style="font-size:30px;"></i>Logar com Google
            </a>
    
            <br>
            <hr>
            <br>
            
            <button class="btn btn-lg btn-success btn-block" type="button" 
                onclick="javascript:window.location.href='./cadastroUsuario.php'">Cadastrar-se</button>
        </form>

    </div>

</div><!-- /.container -->



<?php
    include_once('./rodape.html');
?>