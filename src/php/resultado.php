<?php
    session_start();

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
    <script src="../js/nav-header.js" defer></script>
    <script src="../js/resultado.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>
    <link rel="shortcut icon" href="../images/ICONE.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/nav-header.css">
    <link rel="stylesheet" href="../css/resultado.css">
    <title>New Story</title>
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
                <?php
                if(isset($_SESSION['usrID'])){
                ?>
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
                <?php
                }
                ?>
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
                <input type="text" id="barra-de-pesquisa" placeholder="Pesquise seu livro" value="<?php echo $_GET['pesquisa']; ?>" onkeyup="carregarConteudo(this.value)" />
                <span id="resultado-pesquisa"></span>
            </div>
        </div>

        <div class="itens">
            <button class="aparece-pesquisa">
                <img src="../images/lupa.png" alt="imagem de uma lupa">
            </button>

            <?php
            if(!isset($_SESSION['usrID'])){
            ?>
            <ul>
                <a href="../html/login.html"><li>Login</li></a>
                <a href="../html/cadastro.html"><li>Cadastro</li></a>
            </ul>
            <?php
            }
            else{
            ?>
            <button class="perfil"><img src="../<?php echo $vReg['usrFoto'] ?>" alt="foto de perfil"></button>
            <div class="perfil-menu">
                <div class="foto-perfil"><img src="../<?php echo $vReg['usrFoto'] ?>" alt="foto de perfil"></div>
                <h5>Olá, <?php echo $vReg['usrNome'] ?></h5>
                <hr>
                <a class="gerenciar" href="perfil.php?usuario=<?php echo $_SESSION['usrID'] ?>">Minha Conta</a>
                <a class="sair" href="logout.php">Sair</a>
            </div>
            <?php
            }

            $cSQL = "SELECT livID, livCapa FROM livro WHERE livNome LIKE '%".$_GET['pesquisa']."%';";

            $oDados = mysqli_query($oCon, $cSQL);
            ?>
        </div>
    </header>

    <main>
        <h2>Resultados para <?php echo $_GET['pesquisa']; ?></h2>

        <section class="livros">
            <?php
                if($vReg = mysqli_fetch_assoc($oDados)){
                    echo "<div class='livro'>".
                    "  <div><img src='../".$vReg['livCapa']."' alt='capa do livro'></div>".
                    "  <a href='tela-livro.php?id=".$vReg['livID']."'><button>Ver mais</button></a>".
                    "</div>";

                    while($vReg = mysqli_fetch_assoc($oDados)){
                        echo "<div class='livro'>".
                        "  <div><img src='../".$vReg['livCapa']."' alt='capa do livro'></div>".
                        "  <a href='tela-livro.php?id=".$vReg['livID']."'><button>Ver mais</button></a>".
                        "</div>";
                    }
                }
                else{
                    echo "<div class='mascote'>".
                    "   <img src='../images/mascote.png' alt='mascote'>".
                    "   <label>Diacho... não encontrei nada</label>".
                    "</div>";
                }

                mysqli_free_result($oDados);
    
                mysqli_close($oCon);
            ?>
        </section>
    </main>
</body>
</html>