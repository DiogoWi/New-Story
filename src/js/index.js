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

async function carregarConteudo(valor){
    if(valor.length >= 3){
        console.log("Pesquisar: " + valor)

        const dados = await fetch('../php/pesquisa.php?pesquisa=' + valor)
        const resposta = await dados.json()

        console.log(resposta)

        var html = "<ul>"

        if(resposta['erro']){
            html += "<li>" + resposta['menssagem'] + "</li>"
        }
        else{
            for(i = 0; i < resposta['dados'].length; i++){
                html += "<li>" + resposta['dados'][i].nome + "</li>"
            }
        }
        html += "</ul>"

        document.getElementById('resultado-pesquisa').innerHTML = html
    }
}