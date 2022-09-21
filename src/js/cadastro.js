const revelarSenha = document.querySelectorAll('.revelar-senha')
const senha = document.getElementById('senha')
const repetirSenha = document.getElementById('repetir-senha')
const image = document.querySelectorAll('#imagem-senha')

revelarSenha[0].addEventListener('click', function(){
    if(senha.type == 'password'){
        senha.type = 'text'
        image[0].setAttribute('src', '../images/olho.png')
    }
    else{
        senha.type = 'password'
        image[0].setAttribute('src', '../images/olho-fechado.png')
    }
})

revelarSenha[1].addEventListener('click', function(){
    if(repetirSenha.type == 'password'){
        repetirSenha.type = 'text'
        image[1].setAttribute('src', '../images/olho.png')
    }
    else{
        repetirSenha.type = 'password'
        image[1].setAttribute('src', '../images/olho-fechado.png')
    }
})

function checarSenha(event){
    if(senha.value != repetirSenha.value){
        alert('O campo Senha e Repetir Senha não são iguais')
        event.preventDefault();
    }
}