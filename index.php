<?php
    include_once('./cabecalho.html');
?>

<head>
    <link rel="stylesheet" href="./css/cover.css">
</head>

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-5">
        <div class="inner">
            <h3 class="masthead-brand">BelAir</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link" href="./login.php">Login</a>
            </nav>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h1 class="cover-heading">Gamifique suas aulas</h1>
        <p class="lead">BelAir é um sistema para aplicação de jogos online para motivar sua turma e tornar suas aulas mais interessantes.</p>
        <div class="row">
            <div class="col-md-8">
               <h3 class="cover-heading">Área administrativa do professor.</h3>
                <p class="lead">Tenha acesso a um sistema exclusivo para gerenciar suas atividades. Cadastre questões, categorias e aplique jogos para sua turma de onde e quando quiser.</p>
            </div>
            <div class="col-md-3">
                <img src="./img/dashprofessor.png" alt="Sistema do professor" style="width: 100%;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <img src="./img/ludo.png" alt="Sistema do aluno" style="width: 80%;">
            </div>
            <div class="col-md-8">
               <h3 class="cover-heading">Está pronto para a jogativa?</h3>
                <p class="lead">Com o BelAir, o aluno disfrutará de um ambiente gamificado onde pode se divertir com seus colegas de turma, ao mesmo tempo em que aprende e revisa conceiros aprendidos em aula.</p>
            </div>
        </div>
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>2019 Bel Air Softwares. Todos os direitos reservados &copy;</p>
        </div>
    </footer>
</div>

<?php
    include_once('./rodape.html');
?>