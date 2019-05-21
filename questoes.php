<?php
    include_once('./app.php');
?>

<div class="content">
    <h2 class="content-title">Banco de Questões</h2>
    <div class="dashboard-content">
        <table class="table">
            <thead>
                <tr><td>ID</td><td>Categoria</td><td>Quantidade de questões</td></tr>
            </thead>
            <tbody>
                    <tr> <td>1</td><td>HTML Básico</td><td>34</td></tr>
                    <tr> <td>2</td><td>HTML Intermediário</td><td>29</td></tr>
                    <tr> <td>3</td><td>CSS Básico</td><td>65</td></tr>
                    <tr> <td>4</td><td>Javascript Báscio</td><td>45</td></tr>
                    <tr> <td>5</td><td>Bootstrap</td><td>20</td></tr>
                    <tr> <td>6</td><td>PHP Básico</td><td>33</td></tr>
                    <tr> <td>7</td><td>PHP Intermediário</td><td>27</td></tr>
            </tbody>
        </table>
        <div class="row">
            <div class="addgame text-right">+</div>
        </div>
    </div>
</div>

<?php
    include_once('./rodapeapp.php');
?>