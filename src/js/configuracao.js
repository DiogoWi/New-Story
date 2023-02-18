// Vareiáveis responsáveis por ocultar e exibir a barra de pesquisa
const menu = document.querySelector('.menu')
const containerPesquisa = document.querySelector('.container-pesquisa')
const btnVoltar = document.querySelector('.btn-voltar')
const itens = document.querySelector('.itens')
const aparecePesquisa = document.querySelector('.aparece-pesquisa')
// Vareiável responsável por mostrar a opção selecionada
const opcoes = document.querySelectorAll('.opcao')

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

function mudarOpcao(selecionado){
    for(i = 1; i <= opcoes.length; i++){
        opcoes[i - 1].classList.remove('ativado')
    }
    selecionado.classList.add('ativado')
}