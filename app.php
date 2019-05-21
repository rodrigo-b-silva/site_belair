<?php
    require_once("./authSession.php");
    include_once('./cabecalho.html');
?>

<div class="wrapper">
    <div class="wrapper-row row">
        <div class="col-sm-3 sidebar">
            <div class="logo">
                <a href="">
                    <span>Bel Air</span>
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="./dashboard.php" data-nav><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                    <li><a href="./jogos.php" data-nav><i class="fas fa-chess-knight"></i>Meus Jogos</a></li>
                    <li><a href="./questoes.php" data-nav><i class="fas fa-database"></i>Banco de Questões</a></li>
                    <li><a href="./faq.php" data-nav><i class="fas fa-comment-dots"></i>FAQ</a></li>
                    <li><a href="./sobre.php" data-nav><i class="fas fa-exclamation-circle"></i>Sobre</a></li>
                    <li><a href="./logout.php" data-nav><i class="fas fa-sign-out-alt"></i>Sair</a></li>
                </ul>
            </nav>
        </div>
        <main class="col-sm-9">
