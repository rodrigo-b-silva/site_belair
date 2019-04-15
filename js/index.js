$(document).ready(function(){
    const btn = document.querySelector('#adicionargame')
    btn.onclick = (e) => {
        e.preventDefault()
        swal("Parabéns!", "O jogo foi adicionado com sucesso!", "success");
    }
});