<?php
    session_start();

    if(!isset($_SESSION['usrID'])){
        header('location: ../../index.php');
    }

    $oCon = mysqli_connect('localhost', 'root', '', 'new story');

    $cSQL = "SELECT * FROM usuario WHERE usrID = ".$_SESSION['usrID'];
                    
    $oDados = mysqli_query($oCon, $cSQL);
    $vReg = mysqli_fetch_assoc($oDados);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>
    <script src="../js/favoritos-tela.js" defer></script>
    <script src="../js/nav-header.js" defer></script>
    <link rel="shortcut icon" href="../images/ICONE.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/nav-header.css">
    <link rel="stylesheet" href="../css/favoritos-tela.css">
    <title>Favoritos</title>
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
                        <span class="icon"><ion-icon name="information-circle-outline"></ion-icon></span>
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
        <div class="favoritos">
            <?php
            $cSQL = "SELECT livro.livID, livro.livCapa, livro.livNome, usuario.usrNome FROM favoritos INNER JOIN livro ON favoritos.livID = livro.livID INNER JOIN usuario ON livro.usrID = usuario.usrID WHERE favoritos.usrID = ".$_SESSION['usrID'];
                    
            $oDados = mysqli_query($oCon, $cSQL);

            if($vReg = mysqli_fetch_assoc($oDados)){
                echo "<div class='favorito'>".
                "   <a href='tela-livro.php?id=".$vReg['livID']."'>".
                "       <div class='livro'>".
                "           <img src='../".$vReg['livCapa']."' alt='capa do livro'>".
                "       </div>".
                "   </a>".
                "   <div class='informacoes'>".
                "       <div>".
                "           <h2>".$vReg['livNome']."</h2>".
                "           <label>".$vReg['usrNome']."</label>".
                "       </div>".
                "       <a href='favoritos.php?favoritado=sim&idUsuario=".$_SESSION['usrID']."&idLivro=".$vReg['livID']."'><button><img src='../images/favorito-cheio.png' alt='favorito'></button></a>".
                "   </div>".
                "</div>";

                while($vReg = mysqli_fetch_assoc($oDados)){
                    echo "<div class='favorito'>".
                    "   <a href='tela-livro.php?id=".$vReg['livID']."'>".
                    "       <div class='livro'>".
                    "           <img src='../".$vReg['livCapa']."' alt='capa do livro'>".
                    "       </div>".
                    "   </a>".
                    "   <div class='informacoes'>".
                    "       <div>".
                    "           <h2>".$vReg['livNome']."</h2>".
                    "           <label>".$vReg['usrNome']."</label>".
                    "       </div>".
                    "       <a href='favoritos.php?favoritado=sim&idUsuario=".$_SESSION['usrID']."&idLivro=".$vReg['livID']."'><button><img src='../images/favorito-cheio.png' alt='favorito'></button></a>".
                    "   </div>".
                    "</div>";
                }
            }
            else{
                echo "<div class='mascote'>".
                "   <img src='../images/mascote.png' alt='mascote'>".
                "   <label>Diacho... não encontrei nada</label>".
                "</div>";
            }
            ?>
        </div>
    </main>
</body>
</html>