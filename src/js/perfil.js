// Variável responsável por carregar o conteúdo da barra de pesquisa
const resultadoPesquisa = document.getElementById('resultado-pesquisa')
// Variável do input barra de pesquisa
const barraDePesquisa = document.getElementById('barra-de-pesquisa')

// função responsável por exibir o campo de resultado
barraDePesquisa.addEventListener('focus', function(){
    if(barraDePesquisa.value != ""){
        resultadoPesquisa.style.display = "block"
    }
})

// função responsável por carregar o conteúdo da barra de pesquisa
async function carregarConteudo(valor){
    if(valor.length >= 1){
        const dados = await fetch('pesquisa.php?pesquisa=' + valor)
        const resposta = await dados.json()
        
        var html = "<ul>"
        
        if(resposta['erro']){
            html += "<li>" + resposta['menssagem'] + "</li>"
        }
        else{
            for(i = 0; i < resposta['dados'].length; i++){
                html += "<a href='resultado.php?pesquisa="+ resposta['dados'][i].nome +"'><li onclick='preencherCampo("+`"${resposta['dados'][i].nome}"`+")'>" + resposta['dados'][i].nome + "</li></a>"
            }
        }
        html += "</ul>"
        
        resultadoPesquisa.style.display = "block"
        resultadoPesquisa.innerHTML = html
    }
    else{
        resultadoPesquisa.style.display = "none"
    }
}

// função responsável por preencher o campo de pesquisa
function preencherCampo(nome){
    barraDePesquisa.value = nome
    resultadoPesquisa.style.display = "none"
}

// função responsável por ocultar o campo de resultado
barraDePesquisa.addEventListener('blur', function(){
    setTimeout(() => resultadoPesquisa.style.display = "none", 100)
})

// função responsável por apertar a tecla enter e enviar para a tela resultado
barraDePesquisa.addEventListener('keypress', function(e){
    if(e.key === "Enter" && barraDePesquisa.value != ""){
        window.location.href = 'resultado.php?pesquisa=' + barraDePesquisa.value
    }
})