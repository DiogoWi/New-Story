// Variáveis responsáveis pelo carrossel de imagem no início da página
const fotos = document.querySelector('.fotos')
const img = document.querySelectorAll('.container-fotos img')
const selecao = document.querySelectorAll('.selecao')
const setas = document.querySelectorAll('.seta')
// Variável responsável por carregar o conteúdo da barra de pesquisa
const resultadoPesquisa = document.getElementById('resultado-pesquisa')
// Variável do input barra de pesquisa
const barraDePesquisa = document.getElementById('barra-de-pesquisa')

// função responsável pelo carrossel de imagem no início da página
let idImg = 0

function carrossel(){
    idImg++

    if(idImg == 5){
        selecao[4].classList.toggle('selecionado')
        idImg = 0
    }
    else{
        selecao[idImg - 1].classList.toggle('selecionado')
    }

    selecao[idImg].classList.toggle('selecionado')

    fotos.style.transform = `translateX(${-idImg * 530}px)`
}

let intervaloCarrosel = setInterval(carrossel, 5000)

//função responsável por fazer a seta esquerda voltar a imagem do carrossel
setas[0].addEventListener('click', function(){
    idImg--

    if(idImg < 0){
        selecao[0].classList.toggle('selecionado')
        idImg = img.length - 1
    }
    else{
        selecao[idImg + 1].classList.toggle('selecionado')
    }

    selecao[idImg].classList.toggle('selecionado')

    fotos.style.transform = `translateX(${-idImg * 530}px)`

    clearInterval(intervaloCarrosel)
    intervaloCarrosel = setInterval(carrossel, 5000)
})

//função responsável por fazer a seta direita avançar a imagem do carrossel
setas[1].addEventListener('click', function(){
    idImg++

    if(idImg == 5){
        selecao[4].classList.toggle('selecionado')
        idImg = 0
    }
    else{
        selecao[idImg - 1].classList.toggle('selecionado')
    }

    selecao[idImg].classList.toggle('selecionado')

    fotos.style.transform = `translateX(${-idImg * 530}px)`

    clearInterval(intervaloCarrosel)
    intervaloCarrosel = setInterval(carrossel, 5000)
})

//função responsável pelo seletor de imagem do carrossel
function escolheImagem(imagem){
    idImg = imagem - 1

    selecao[0].classList.remove('selecionado')
    selecao[1].classList.remove('selecionado')
    selecao[2].classList.remove('selecionado')
    selecao[3].classList.remove('selecionado')
    selecao[4].classList.remove('selecionado')
    selecao[idImg].classList.add('selecionado')

    fotos.style.transform = `translateX(${-idImg * 530}px)`

    clearInterval(intervaloCarrosel)
    intervaloCarrosel = setInterval(carrossel, 5000)
}

// função responsável por exibir o campo de resultado
barraDePesquisa.addEventListener('focus', function(){
    if(barraDePesquisa.value != ""){
        resultadoPesquisa.style.display = "block"
    }
})

// função responsável por carregar o conteúdo da barra de pesquisa
async function carregarConteudo(valor){
    if(valor.length >= 1){
        const dados = await fetch('src/php/pesquisa.php?pesquisa=' + valor)
        const resposta = await dados.json()
        
        var html = "<ul>"
        
        if(resposta['erro']){
            html += "<li>" + resposta['menssagem'] + "</li>"
        }
        else{
            for(i = 0; i < resposta['dados'].length; i++){
                html += "<a href='src/php/resultado.php?pesquisa="+ resposta['dados'][i].nome +"'><li onclick='preencherCampo("+`"${resposta['dados'][i].nome}"`+")'>" + resposta['dados'][i].nome + "</li></a>"
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
        window.location.href = 'src/php/resultado.php?pesquisa=' + barraDePesquisa.value
    }
})