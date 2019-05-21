$(document).ready(function(){
    $('#adicionargame').on('click', function(e){
        e.preventDefault()
        swal("Parabéns!", "O jogo foi adicionado com sucesso!", "success");
    })

    $('#endgame').on('click', function(e){
        alert('usuario finalizou o game')
        let questions = document.querySelectorAll('[type=radio]');
        console.log(questions);
    }) 
});