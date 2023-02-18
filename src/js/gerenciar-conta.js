// Variável responsável por carregar o conteúdo da barra de pesquisa
const resultadoPesquisa = document.getElementById('resultado-pesquisa')
// Variável do input barra de pesquisa
const barraDePesquisa = document.getElementById('barra-de-pesquisa')
// Variáveis responsáveis por mudar a imagem da foto do usuário e da capa
const buscarImagem = document.querySelectorAll('#buscarImagem')
const escolherImagem = document.querySelectorAll('#escolherImagem')
const fotoUsuarioInput = document.getElementById('fotoUsuarioInput')
const fotoUsuario = document.getElementById('fotoUsuario')
const modal = document.querySelectorAll('#modal')
const modalFechar = document.querySelectorAll('#fechar')
const fotoCapaInput = document.getElementById('fotoCapaInput')
const fotoCapa = document.getElementById('fotoCapa')
// Variável responsável por exibir a barra para salvar as alterações
const salvarAlteracoes = document.querySelector('.salvar-alteracoes')
// Variável responsável por salvar as alterações
const buttonSalvarAlteracoes = document.getElementById('salvar-alteracoes')
// Variável responsável por redefinir os campos
const redefinir = document.getElementById('redefinir')
const fotoAnterior = fotoUsuario.src
const capaAnterior = fotoCapa.src
const nomeAnterior = document.querySelectorAll('.dado input')[0].value
const emailAnterior = document.querySelectorAll('.dado input')[1].value
const biografiaAnterior = document.getElementById('biografia').value
console.log(biografiaAnterior)

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

// função responsável por abrir o primeiro modal
buscarImagem[0].addEventListener('click', function(){
    modal[0].showModal()
    modal[0].style.margin = `-${modal[0].scrollHeight / 2}px 0 0 -${modal[0].scrollWidth / 2}px`
})

// função responsável por fechar o primeiro modal
modalFechar[0].addEventListener('click', function(){
    modal[0].close()
})

// função responsável por abrir o primeiro input file
escolherImagem[0].addEventListener('click', function(){
    fotoUsuarioInput.click()
})

const redimensionarFoto = new Croppie(document.querySelectorAll('.preview')[0], {
    enableOrientatio: true,
    enableExif: true,
    viewport: {
        width: 300,
        height: 300,
        type: 'circle',
    },
    boundary: {
        width: 500,
        height: 400,
    },
})

// função responsável por trocar a foto do usuário
fotoUsuarioInput.addEventListener('change', function(){
    if(fotoUsuarioInput.files.length <= 0){
        return
    }

    let leitor = new FileReader()

    leitor.onload = function(e){
        redimensionarFoto.bind({
            url: e.target.result
        })
    }

    leitor.readAsDataURL(fotoUsuarioInput.files[0])
})

// função responsável por cortar a imagem e por no perfil
document.querySelectorAll('#usarImagem')[0].addEventListener('click', function(){
    redimensionarFoto.result({
        type: 'canvas',
        size: 'viewport'
    }).then(function (img){
        modal[0].close()
        fotoUsuario.src = img
        salvarAlteracoes.style.opacity = "1"
        salvarAlteracoes.style.visibility = "visible"
        salvarAlteracoes.style.transform = "translateY(0)"
    })
})

// função responsável por abrir o segundo modal
buscarImagem[1].addEventListener('click', function(){
    modal[1].showModal()
    modal[1].style.margin = `-${modal[1].scrollHeight / 2}px 0 0 -${modal[1].scrollWidth / 2}px`
})

// função responsável por fechar o segundo modal
modalFechar[1].addEventListener('click', function(){
    modal[1].close()
})

// função responsável por abrir o segundo input file
escolherImagem[1].addEventListener('click', function(){
    fotoCapaInput.click()
})

const redimensionarCapa = new Croppie(document.querySelectorAll('.preview')[1], {
    enableOrientatio: true,
    enableExif: true,
    viewport: {
        width: 700,
        height: 230,
        type: 'square',
    },
    boundary: {
        width: 700,
        height: 490,
    },
})

// função responsável por trocar a foto de capa
fotoCapaInput.addEventListener('change', function(){
    if(fotoCapaInput.files.length <= 0){
        return
    }

    let leitor = new FileReader()

    leitor.onload = function(e){
        redimensionarCapa.bind({
            url: e.target.result
        })
    }

    leitor.readAsDataURL(fotoCapaInput.files[0])
})

// função responsável por cortar a imagem e por na capa
document.querySelectorAll('#usarImagem')[1].addEventListener('click', function(){
    redimensionarCapa.result({
        type: 'canvas',
        size: 'viewport'
    }).then(function (img){
        modal[1].close()
        fotoCapa.src = img
        if(fotoCapa.style.visibility == "hidden"){
            fotoCapa.style.visibility = "visible"
        }
        salvarAlteracoes.style.opacity = "1"
        salvarAlteracoes.style.visibility = "visible"
        salvarAlteracoes.style.transform = "translateY(0)"
    })
})

buttonSalvarAlteracoes.addEventListener('click', function(){
    $.ajax({
        url: "salvar-alteracoes.php",
        type: "POST",
        data: {
            "foto": document.getElementById('fotoUsuario').src,
            "capa": document.getElementById('fotoCapa').src,
            "nome": document.getElementById('nome').value,
            "email": document.getElementById('email').value,
            "biografia": document.getElementById('biografia').value,
        }
    })
    setTimeout(() => window.location.reload(true), 2000)
})

// função responsável por exibir o campo salvar alterações
function verifica(){
    salvarAlteracoes.style.opacity = "1"
    salvarAlteracoes.style.visibility = "visible"
    salvarAlteracoes.style.transform = "translateY(0)"
}

// função responsável por redefinir as alterações não salvas
redefinir.addEventListener('click', function(){
    fotoUsuario.src = fotoAnterior
    fotoUsuarioInput.type = ""
    fotoUsuarioInput.type = "file"
    fotoCapa.src = capaAnterior
    fotoCapaInput.type = ""
    fotoCapaInput.type = "file"
    document.querySelectorAll('.dado input')[0].value = nomeAnterior
    document.querySelectorAll('.dado input')[1].value = emailAnterior
    document.getElementById('biografia').value = biografiaAnterior
    document.querySelectorAll('.dado input')[2].value = ""
    document.querySelectorAll('.dado input')[3].value = ""
    salvarAlteracoes.style.opacity = "0"
    salvarAlteracoes.style.visibility = "hidden"
    salvarAlteracoes.style.transform = "translateY(80px)"
})