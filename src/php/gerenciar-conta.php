<?php
session_start();

if(!isset($_SESSION['usrID'])){
    header('location: ../../index.php');
}

$oCon = mysqli_connect('localhost', 'root', '', 'new story');
if(isset($_SESSION['usrID'])){
    $cSQL = "SELECT * FROM usuario WHERE usrID = ".$_SESSION['usrID'];
                
    $oDados = mysqli_query($oCon, $cSQL);
    $vReg = mysqli_fetch_assoc($oDados);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="../js/nav-header.js" defer></script>
    <script src="../js/gerenciar-conta.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../images/ICONE.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/nav-header.css">
    <link rel="stylesheet" href="../css/gerenciar-conta.css">
    <title>New Story - Conta</title>
</head>
<body>
    <nav class="navegacao">
        <div class="navegacao-menu">
            <ul>
                <li>
                    <a href="../../index.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="../html/configuracao.html" target="_blank">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Configurações</span>
                    </a>
                </li>
                <li>
                    <a href="cadastro-livro-tela.php">
                        <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                        <span class="title">Cadastrar Livro</span>
                    </a>
                </li>
                <li>
                    <a href="favoritos-tela.php">
                        <span class="icon"><ion-icon name="heart-outline"></ion-icon></span>
                        <span class="title">Favoritos</span>
                    </a>
                </li>
                <li>
                    <a href="sobre.php">
                        <span class="icon"><ion-icon name="duplicate-outline"></ion-icon></span>
                        <span class="title">Sobre</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <header>
        <div class="menu">
            <button class="menu-button" id="menu-button">
                <div></div>
            </button>
            <a href="../../index.php">
                <img class="logo" src="../images/logo.png" alt="logo do site">
                <label>New Story</label>
            </a>
        </div>

        <div class="container-pesquisa">
            <button class="btn-voltar">
                <img src="../images/voltar.png" alt="seta voltar">
            </button>
            <div class="pesquisa">
                <img src="../images/lupa.png" alt="imagem de uma lupa">
                <input type="text" id="barra-de-pesquisa" placeholder="Pesquise seu livro" onkeyup="carregarConteudo(this.value)" />
                <span id="resultado-pesquisa"></span>
            </div>
        </div>

        <div class="itens">
            <button class="aparece-pesquisa">
                <img src="../images/lupa.png" alt="imagem de uma lupa">
            </button>
            
            <label>Olá, <?php echo $vReg['usrNome'] ?></label>
            <button class="perfil"><img src="../<?php echo $vReg['usrFoto'] ?>" alt="foto de perfil"></button>
            <div class="perfil-menu">
                <div class="foto-perfil"><img src="../<?php echo $vReg['usrFoto'] ?>" alt="foto de perfil"></div>
                <h5>Olá, <?php echo $vReg['usrNome'] ?></h5>
                <hr>
                <a class="gerenciar" href="perfil.php?usuario=<?php echo $_SESSION['usrID'] ?>">Minha Conta</a>
                <a class="sair" href="logout.php">Sair</a>
            </div>
        </div>
    </header>

    <main>
        <h2>Gerenciador de conta</h2>

        <div class="fotos">
            <div class="foto-container">
                <div class="foto">
                    <input type="file" name="fotoUsuario" id="fotoUsuarioInput" accept="image/*">
                    <img src="../<?php echo $vReg['usrFoto'] ?>" alt="foto do usuário" id="fotoUsuario">

                    <dialog id="modal">
                        <button type="button" id="fechar"><img src="../images/sinal-mais.png" alt="fechar"></button>
                        <div class="preview"></div>
                        <div>
                            <button type="button" id="escolherImagem">Escolher imagem</button>
                            <button type="button" id="usarImagem">Usar imagem</button>
                        </div>
                    </dialog>
                </div>
                <div>
                    <div>
                        <label>Trocar foto de perfil</label>
                        <span>A imagem precisa ser do tipo png ou jpeg</span>
                    </div>
                    <button type="button" id="buscarImagem">Buscar imagem</button>
                </div>
            </div>
            <div class="foto-container">
                <div class="capa">
                    <input type="file" name="fotoCapa" id="fotoCapaInput" accept="image/*">
                    <?php
                        if($vReg['usrCapa'] != ""){
                            echo "<img src='../".$vReg['usrCapa']."' alt='foto da capa' id='fotoCapa'>";
                        }
                        else{
                            echo "<img src='../".$vReg['usrCapa']."' alt='foto da capa' id='fotoCapa' style='visibility: hidden;'>";
                        }
                    ?>

                    <dialog id="modal">
                        <button type="button" id="fechar"><img src="../images/sinal-mais.png" alt="fechar"></button>
                        <div class="preview"></div>
                        <div>
                            <button type="button" id="escolherImagem">Escolher imagem</button>
                            <button type="button" id="usarImagem">Usar imagem</button>
                        </div>
                    </dialog>
                </div>
                <div>
                    <div>
                        <label>Trocar foto de capa</label>
                        <span>A imagem precisa ser do tipo png ou jpeg</span>
                    </div>
                    <button type="button" id="buscarImagem">Buscar imagem</button>
                </div>
            </div>
        </div>

        <h2>Informações pessoais</h2>

        <div class="informacoes">
            <div class="dados-usuario">
                <div class="dado">
                    <label>Usuário</label>
                    <hr>
                    <input type="text" id="nome" placeholder="Nome do Usuário" onkeyup="verifica()" value="<?php echo $vReg['usrNome'] ?>">
                </div>
                <div class="dado">
                    <label>Email</label>
                    <hr>
                    <input type="email" id="email" placeholder="emaildousuario@gmail.com" onkeyup="verifica()" value="<?php echo $vReg['usrEmail'] ?>">
                </div>
            </div>
            <div class="dados-usuario">
                <div class="dado">
                    <label>Biografia</label>
                    <hr>
                    <textarea id="biografia" placeholder="Biografia" onkeyup="verifica()"><?php echo $vReg['usrBiografia'] ?></textarea>
                </div>
            </div>
        </div>

        <h2>Trocar senha</h2>

        <div class="informacoes">
            <div class="dados-usuario">
                <div class="dado">
                    <label>Senha atual</label>
                    <hr>
                    <input type="password" placeholder="Insira sua senha atual" onkeyup="verifica()">
                </div>
                <div class="dado">
                    <label>Nova senha</label>
                    <hr>
                    <input type="password" id="senha" placeholder="Insira sua nova senha" onkeyup="verifica()">
                </div>
            </div>
        </div>

        <div class="salvar-alteracoes">
            <label>Algumas alterações não foram salvas!</label>
            <div class="botoes">
                <button type="button" id="redefinir">Redefinir</button>
                <button id="salvar-alteracoes">Salvar alterações</button>
            </div>
        </div>
    </main>
</body>
</html>