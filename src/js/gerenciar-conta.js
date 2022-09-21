const navegacao = document.querySelector('.navegacao')
const navegacaoMenu = document.querySelector('.navegacao-menu')
const menu = document.querySelector('.menu')
const menuButton = document.getElementById('menu-button')
const containerPesquisa = document.querySelector('.container-pesquisa')
const btnVoltar = document.querySelector('.btn-voltar')
const itens = document.querySelector('.itens')
const aparecePesquisa = document.querySelector('.aparece-pesquisa')
const perfil = document.querySelector('.perfil')
const perfilMenu = document.querySelector('.perfil-menu')

aparecePesquisa.addEventListener('click', function(){
    menu.classList.add('invisivel')
    itens.classList.add('invisivel')
    containerPesquisa.classList.add('ativado')
})

btnVoltar.addEventListener('click', function(){
    menu.classList.remove('invisivel')
    itens.classList.remove('invisivel')
    containerPesquisa.classList.remove('ativado')
})

menuButton.addEventListener('click', function(){
    menuButton.classList.toggle('ativado')

    if(menuButton.classList[1] == "ativado"){
        navegacao.style.opacity = "1"
        navegacao.style.visibility = "visible"
        navegacaoMenu.style.transform = "translateX(0)"
        document.body.style.overflowY = "hidden"
    }
    else{
        navegacao.style.opacity = "0"
        navegacao.style.visibility = "hidden"
        navegacaoMenu.style.transform = "translateX(-280px)"
        document.body.style.overflowY = "scroll"
    }
})

perfil.addEventListener('click', function(){
    perfilMenu.classList.toggle('ativado')

    if(perfilMenu.classList[1] == "ativado"){
        perfilMenu.style.opacity = "1"
        perfilMenu.style.visibility = "visible"
        perfilMenu.style.transform = "translateY(0)"
    }
    else{
        perfilMenu.style.opacity = "0"
        perfilMenu.style.visibility = "hidden"
        perfilMenu.style.transform = "translateY(-100px)"
    }
})