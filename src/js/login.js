const revelarSenha = document.querySelector('.revelar-senha')
const senha = document.getElementById('senha')
const image = document.getElementById('imagem-senha')

// função responsável por transformar o input do tipo senha para o tipo texto e vice-versa
revelarSenha.addEventListener('click', function(){
    if(senha.type == 'password'){
        senha.type = 'text'
        image.setAttribute('src', '../images/olho.png')
    }
    else{
        senha.type = 'password'
        image.setAttribute('src', '../images/olho-fechado.png')
    }
})