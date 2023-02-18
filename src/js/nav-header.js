// Variáveis responsáveis por ativar e desativar o menu
const menuButton = document.getElementById('menu-button')
const navegacaoMenu = document.querySelector('.navegacao-menu')
const navegacao = document.querySelector('.navegacao')
// Variáveis responsáveis por aparecer o ocultar a barra de pesquisa
const aparecePesquisa = document.querySelector('.aparece-pesquisa')
const btnVoltar = document.querySelector('.btn-voltar')
const containerPesquisa = document.querySelector('.container-pesquisa')
const itens = document.querySelector('.itens')
const menu = document.querySelector('.menu')
// Variáveis responsáveis por fazer o menu do perfil ser ativado e desativado
const perfil = document.querySelector('.perfil')
const perfilMenu = document.querySelector('.perfil-menu')

// função responsável por fazer o menu ser ativado e desativado
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
        if(document.documentElement.scrollHeight > 627){
            document.body.style.overflowY = "scroll"
        }
    }
})

// função responsável por fazer a barra de tarefas aparecer quando a barra estiver contraída
aparecePesquisa.addEventListener('click', function(){
    menu.classList.add('invisivel')
    itens.classList.add('invisivel')
    containerPesquisa.classList.add('ativado')
})

// função responsável por fazer a barra de tarefas voltar a ficar contraída
btnVoltar.addEventListener('click', function(){
    menu.classList.remove('invisivel')
    itens.classList.remove('invisivel')
    containerPesquisa.classList.remove('ativado')
})

//função responsável por fazer o menu do perfil ser ativado e desativado
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

// função responsável por fechar o menu pelo teclado
window.addEventListener('keydown', function(e){
    if(e.key === "Escape" && menuButton.classList[1] == "ativado"){
            menuButton.classList.toggle('ativado')
            navegacao.style.opacity = "0"
            navegacao.style.visibility = "hidden"
            navegacaoMenu.style.transform = "translateX(-280px)"
            if(document.documentElement.scrollHeight > 627){
                document.body.style.overflowY = "scroll"
            }
    }
})

navegacao.addEventListener('click', function(e){
    if(e.clientX > 280){
        menuButton.classList.toggle('ativado')
        navegacao.style.opacity = "0"
        navegacao.style.visibility = "hidden"
        navegacaoMenu.style.transform = "translateX(-280px)"
        if(document.documentElement.scrollHeight > 627){
            document.body.style.overflowY = "scroll"
        }
    }
})