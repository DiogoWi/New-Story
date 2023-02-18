const revelarSenha = document.querySelectorAll('.revelar-senha')
const txtUsuario = document.getElementById('txtUsuario')
const txtEmail = document.getElementById('txtEmail')
const senha = document.getElementById('senha')
const repetirSenha = document.getElementById('repetir-senha')
const image = document.querySelectorAll('#imagem-senha')
const btnCadastro = document.querySelector('.btn-cadastro')

// função responsável por transformar o input do tipo senha para o tipo texto e vice-versa
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

// função responsável por transformar o input do tipo senha para o tipo texto e vice-versa
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

// função responsável por verificar se o campo senha e repetir senha são iguais
function checarSenha(event){
    if(senha.value != repetirSenha.value){
        alert('O campo Senha e Repetir Senha não são iguais')
        event.preventDefault();
    }
}

let count = 0

btnCadastro.addEventListener('click', function(){
    if(txtUsuario.value != "" && txtEmail.value != "" && senha.value != "" && repetirSenha.value != ""){
        txtUsuario.value == ""
        txtEmail.value == ""
        senha.value == ""
        repetirSenha.value == ""

        if(count >= 1){
            btnCadastro.disabled = true
        }

        count += 1
    }
})