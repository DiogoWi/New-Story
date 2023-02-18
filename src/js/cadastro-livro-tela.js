// Variáveis reponsáveis por exibir e ocutar o campo link
const inputDesen = document.getElementById('radio1')
const inputFinali = document.getElementById('radio2')
const linkCampo = document.querySelector('.link-campo')
const aVendaCampo = document.querySelector('.a-venda #checkbox')
const link = document.querySelector('.link')
// Variáveis responsáveis por exibir a capa escolhida
const campoCapa = document.querySelector('.foto-principal')
const capa = document.getElementById('capa')
const labelCapa = document.querySelector('.foto-principal label')
const arquivo = document.getElementById('imagem-capa')
const campo1 = document.getElementById('campo1')
const campo2 = document.getElementById('campo2')
const campo3 = document.getElementById('campo3')
// Variáveis das fotos
const inputFoto1 = document.getElementById('inputfoto1')
const inputFoto2 = document.getElementById('inputfoto2')
const inputFoto3 = document.getElementById('inputfoto3')
const imageFoto1 = document.getElementById('imagefoto1')
const imageFoto2 = document.getElementById('imagefoto2')
const imageFoto3 = document.getElementById('imagefoto3')
// Variável responsável por carregar o conteúdo da barra de pesquisa
const resultadoPesquisa = document.getElementById('resultado-pesquisa')
// Variável do input barra de pesquisa
const barraDePesquisa = document.getElementById('barra-de-pesquisa')

// função responsável por ocultar o campo de link para o usuário
inputDesen.addEventListener('click', function(){
    linkCampo.style.display = "none"
    link.style.display = "none"
    aVendaCampo.checked = false
})

// função responsável por mostrar o campo de link para o usuário
inputFinali.addEventListener('click', function(){
    linkCampo.style.display = "block"
})

aVendaCampo.addEventListener('click', function(){
    if(aVendaCampo.checked){
        link.style.display = "block"
    }
    else{
        link.style.display = "none"
    }
})

// função responsável por executar o input do tipo file
campoCapa.addEventListener('click', function(){
    arquivo.click()
})

// função responsável por mostrar para o usuário qual capa ele está escolhendo
arquivo.addEventListener('change', function(){
    if(arquivo.files.length <= 0){
        return
    }

    let leitor = new FileReader()

    leitor.onload = function(){
        labelCapa.style.display = "none"
        capa.style.width = "initial"
        capa.style.maxHeight = "100%"
        capa.style.maxWidth = "100%"
        capa.src = leitor.result
    }

    leitor.readAsDataURL(arquivo.files[0])
    
    campo1.style.display = "flex"
})

// funções responsáveis por exibir as outras fotos do usúario
function adicionarFoto(foto){
    if(foto == "foto1"){
        inputFoto1.click()
    }
    if(foto == "foto2"){
        inputFoto2.click()
    }
    if(foto == "foto3"){
        inputFoto3.click()
    }
}

inputFoto1.addEventListener('change', function(){
    if(inputFoto1.files.length <= 0){
        return
    }

    let leitor = new FileReader()

    leitor.onload = function(){
        imageFoto1.style.maxHeight = "100%"
        imageFoto1.style.maxWidth = "100%"
        imageFoto1.src = leitor.result
    }

    leitor.readAsDataURL(inputFoto1.files[0])

    campo2.style.display = "flex"
})

inputFoto2.addEventListener('change', function(){
    if(inputFoto2.files.length <= 0){
        return
    }

    let leitor = new FileReader()

    leitor.onload = function(){
        imageFoto2.style.maxHeight = "100%"
        imageFoto2.style.maxWidth = "100%"
        imageFoto2.src = leitor.result
    }

    leitor.readAsDataURL(inputFoto2.files[0])

    campo3.style.display = "flex"
})

inputFoto3.addEventListener('change', function(){
    if(inputFoto3.files.length <= 0){
        return
    }

    let leitor = new FileReader()

    leitor.onload = function(){
        imageFoto3.style.maxHeight = "100%"
        imageFoto3.style.maxWidth = "100%"
        imageFoto3.src = leitor.result
    }

    leitor.readAsDataURL(inputFoto3.files[0])
})

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