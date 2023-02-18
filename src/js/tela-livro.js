// Variáveis resopnsáveis por exibir mais texto
const verMais = document.querySelectorAll('#ver-mais')
const sinopse = document.querySelector('.sinopse')
const descricao = document.getElementById('descricao')
// Variável responsável pelo comentário
const comentario = document.getElementById('comentario')
const containerComentarios = document.querySelector('.container-comentarios')
const botoes = document.querySelector('.botoes')
const textarea = document.querySelector('.escrever textarea')
const numeroComentario = document.getElementById('numeroComentario')
// Variáveis responsáveis pelas fotos do livro
const imagePrincipal = document.getElementById('imagePrincipal')
const imagefoto1 = document.getElementById('imagefoto1')
const imagefoto2 = document.getElementById('imagefoto2')
const imagefoto3 = document.getElementById('imagefoto3')
const imagefoto4 = document.getElementById('imagefoto4')
// Variável responsável por carregar o conteúdo da barra de pesquisa
const resultadoPesquisa = document.getElementById('resultado-pesquisa')
// Variável do input barra de pesquisa
const barraDePesquisa = document.getElementById('barra-de-pesquisa')


// função responsável por trocar as fotos dos livros
function trocarFoto(foto){
    if(foto == "foto1"){
        imagePrincipal.src = imagefoto1.src
    }
    if(foto == "foto2"){
        imagePrincipal.src = imagefoto2.src
    }
    if(foto == "foto3"){
        imagePrincipal.src = imagefoto3.src
    }
    if(foto == "foto4"){
        imagePrincipal.src = imagefoto4.src
    }
}

// função responsável por aumentar a area de texto da sinopse
verMais[0].addEventListener('click', function(){
    sinopse.classList.toggle('expandido')

    if(sinopse.classList[1] == "expandido"){
        sinopse.style.height = "363px"
        sinopse.style.overflowY = "auto"
        sinopse.style.webkitBoxOrient = "initial"
        verMais[0].innerText = "Ver menos"
    }
    else{
        sinopse.scrollTop = 0
        sinopse.style.height = "187px"
        sinopse.style.overflowY = "hidden"
        sinopse.style.webkitBoxOrient = "vertical"
        verMais[0].innerText = "Ver mais"
    }
})

// função responsável por aumentar a area de texto da descrição
verMais[1].addEventListener('click', function(){
    descricao.classList.toggle('expandido')

    if(descricao.classList == "expandido"){
        descricao.style.height = `${descricao.scrollHeight + 3}px`
        descricao.style.overflowY = "auto"
        descricao.style.webkitBoxOrient = "initial"
        verMais[1].innerText = "Ver menos"
    }
    else{
        descricao.scrollTop = 0
        descricao.style.height = "103px"
        descricao.style.overflowY = "hidden"
        descricao.style.webkitBoxOrient = "vertical"
        verMais[1].innerText = "Ver mais"
    }
})

// funções que serão executadas quando carregar a tela
window.addEventListener('load', function(){
    // responsável por exibir o ver mais
    if(sinopse.scrollHeight > sinopse.offsetHeight){
        verMais[0].classList.remove('invisivel')
    }
    if(descricao.scrollHeight > descricao.offsetHeight){
        verMais[1].classList.remove('invisivel')
    }

    // responsável por bloquear o comentário se não ouver conta
    if(textarea.classList == "sem-conta"){
        textarea.disabled = true
    }
})

// função responsável por aumentar o textarea do comentário
comentario.addEventListener('input', function(){
    if(comentario.scrollHeight > comentario.offsetHeight){
        comentario.style.height = `${comentario.scrollHeight + 2}px`
    }
    if(comentario.value == ""){
        comentario.style.height = "31px"
    }
})

// funções responsáveis por exibir e ocultar os botoes do comentário
comentario.addEventListener('focus', function(){
    botoes.style.display = "flex"
})

// função responsável por registrar o comentario no banco de dados
async function comentar(valor, livroId){
    if(valor == "comentar"){
        if(comentario.value != ""){
            const comentarios = await fetch('comentario.php?livroId=' + livroId + '&comentario=' + comentario.value.replace(/(\r\n|\n|\r)/g, "<br />"))
            const lista = await comentarios.json()
    
            let html = ""
            
            for(i = 0; i < lista['comentarios'].length; i++){
                html += `<div class='comentarios'>
                            <div class='foto-usuario'><img src='../${lista['comentarios'][i].usuarioFoto}' alt='foto de perfil'></div>
                            <div class='dados-usuario'>
                                <label>${lista['comentarios'][i].usuarioNome}</label>
                                <p>${lista['comentarios'][i].comentario}</p>
                            </div>
                        </div>`
            }
            
            comentario.value = ""
            botoes.style.display = "none"
            comentario.style.height = "31px"
            containerComentarios.innerHTML = html
            nComentario = parseInt(numeroComentario.innerHTML)
            nComentario += 1
            numeroComentario.innerHTML = nComentario
        }
        else{
            alert("Campo comentário vazio!")
        }
    }
    else{
        botoes.style.display = "none"
    }
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