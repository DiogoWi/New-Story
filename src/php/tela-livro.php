<?php
session_start();

$oCon = mysqli_connect('localhost', 'root', '', 'new story');
if(isset($_SESSION['usrID'])){
    $cSQL = "SELECT usrFoto FROM usuario WHERE usrID = ".$_SESSION['usrID'];
                
    $oDados = mysqli_query($oCon, $cSQL);
    $fotoUsuario = mysqli_fetch_assoc($oDados);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>
    <script src="../js/nav-header.js" defer></script>
    <script src="../js/tela-livro.js" defer></script>
    <link rel="shortcut icon" href="../images/ICONE.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/nav-header.css">
    <link rel="stylesheet" href="../css/tela-livro.css">
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
                <input type="text" id="barra-de-pesquisa" placeholder="Pesquise seu livro" onkeyup="carregarConteudo(this.value)" />
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
            <button class="perfil"><img src="../<?php echo $fotoUsuario['usrFoto'] ?>" alt="foto de perfil"></button>
            <div class="perfil-menu">
                <div class="foto-perfil"><img src="../<?php echo $fotoUsuario['usrFoto'] ?>" alt="foto de perfil"></div>
                <h5>Olá, <?php echo $_SESSION['usrNome'] ?></h5>
                <hr>
                <a class="gerenciar" href="perfil.php?usuario=<?php echo $_SESSION['usrID'] ?>">Minha Conta</a>
                <a class="sair" href="logout.php">Sair</a>
            </div>
            <?php
            }
            ?>
        </div>
    </header>

    <?php
        $cSQL = "SELECT * FROM livro INNER JOIN usuario ON livro.usrID = usuario.usrID WHERE livID = ".$_GET['id'];

        $oDados = mysqli_query($oCon, $cSQL);
        $vReg = mysqli_fetch_assoc($oDados);
    ?>

    <main>
        <section class="livro">
            <div class="container-livro">
                <div class="slider-livro">
                    <div class="fotos">
                        <div onclick="trocarFoto('foto1')">
                            <img src="../<?php echo $vReg['livCapa'] ?>" id="imagefoto1" alt="foto 1">
                        </div>
                        <?php
                        if($vReg['livFoto1'] != ""){
                        ?>
                        <div onclick="trocarFoto('foto2')">
                            <img src="../<?php echo $vReg['livFoto1'] ?>" id="imagefoto2" alt="foto 2">
                        </div>
                        <?php
                        }
                        if($vReg['livFoto2'] != ""){
                        ?>
                        <div onclick="trocarFoto('foto3')">
                            <img src="../<?php echo $vReg['livFoto2'] ?>" id="imagefoto3" alt="foto 3">
                        </div>
                        <?php
                        }
                        if($vReg['livFoto3'] != ""){
                        ?>
                        <div onclick="trocarFoto('foto4')">
                            <img src="../<?php echo $vReg['livFoto3'] ?>" id="imagefoto4" alt="foto 4">
                        </div>
                        <?php
                        }
                        ?>
                    </div>
    
                    <div class="foto-principal">
                        <img src="../<?php echo $vReg['livCapa'] ?>" id="imagePrincipal" alt="foto exibida">
                    </div>
                </div>
    
                <div>
                    <div class="dados-livro">
                        <h1> <?php echo $vReg['livNome']; ?> </h1>
                        <hr>
                        <h2>
                            <?php
                                if($vReg['livStatus'] == "A venda"){
                                    echo "Finalizado";
                                }
                                else{
                                    echo $vReg['livStatus']; 
                                }
                            ?>
                        </h2>
                        <h1>Sinopse</h1>
                        <hr>
                        <p class="sinopse"><?php echo $vReg['livSinopse'] ?></p>
                        <label id="ver-mais" class="invisivel">Ver mais</label>
                        <?php
                        if($vReg['livStatus'] == "A venda"){
                            echo "<a href='".$vReg['livLinkCompra']."'><button>Link de Compra</button></a>";
                        }
                        ?>
                    </div>

                    <?php
                        if(isset($_SESSION['usrID'])){
                            $cSQL = "SELECT usrID, livID FROM favoritos WHERE usrID = ".$_SESSION['usrID']." AND livID = ".$vReg['livID'];

                            $oDados = mysqli_query($oCon, $cSQL);
                            $Livro = mysqli_fetch_assoc($oDados);

                            if($Livro){
                                echo "<a href='favoritos.php?favoritado=sim&idUsuario=".$_SESSION['usrID']."&idLivro=".$vReg['livID']."'><button class='favorito'><img src='../images/favorito-cheio.png' alt='botão de favorito'></button></a>";
                            }
                            else{
                                echo "<a href='favoritos.php?favoritado=nao&idUsuario=".$_SESSION['usrID']."&idLivro=".$vReg['livID']."'><button class='favorito'><img src='../images/favorito.png' alt='botão de favorito'></button></a>";
                            }
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div class="autor">
                <div class="foto-autor"><a href="perfil.php?usuario=<?php echo $vReg['usrID'] ?>"><img src="../<?php echo $vReg['usrFoto'] ?>" alt="foto de perfil do autor do livro"></a></div>
    
                <div class="descricao">
                    <label><?php echo $vReg['usrNome'] ?></label>
                    <p id="descricao"><?php echo $vReg['livSobre'] ?></p>
                    <label id="ver-mais" class="invisivel">Ver mais</label>
                </div>
            </div>
            <hr style="border: 1px solid #872D48; background-color: #872D48">
        </section>
    
        <section class="comentario">
            <h1>Comentários (<span id="numeroComentario"><?php $cSQL = "SELECT COUNT(*) FROM comentario WHERE livID = ".$_GET['id'];
                                   $oDados = mysqli_query($oCon, $cSQL);
                                   $comentarios = mysqli_fetch_assoc($oDados);
                                   echo $comentarios['COUNT(*)'];
                            ?></span>)</h1>
    
            <div class="escrever">
                <div class="perfil"><img src="../<?php
                                                    if(isset($_SESSION['usrID'])){
                                                        echo $fotoUsuario['usrFoto'];
                                                    }
                                                    else{
                                                        echo "images/sem-usuario.png";
                                                    }
                                                 ?>" alt="foto de perfil"></div>
                <div>
                    <textarea class="<?php
                                        if(!isset($_SESSION['usrID'])){
                                            echo "sem-conta";
                                        }
                                     ?>" 
                    rows="1" placeholder="Adicione um comentário..." id="comentario" name="comentario" required></textarea>
                    <div class="botoes">
                        <button onclick="comentar('comentar', <?php echo $vReg['livID'] ?>)">Comentar</button>
                        <button onclick="comentar('cancelar')">Cancelar</button>
                    </div>
                </div>
            </div>
    
            <div class="container-comentarios">
                <?php
                    $cSQL = "SELECT * FROM comentario INNER JOIN usuario ON comentario.usrID = usuario.usrID WHERE livID = ".$_GET['id'];

                    $oDados = mysqli_query($oCon, $cSQL);

                    while($vReg = mysqli_fetch_assoc($oDados)){
                        echo "<div class='comentarios'>".
                        "   <div class='foto-usuario'><img src='../".$vReg['usrFoto']."' alt='foto de perfil'></div>".
                        "   <div class='dados-usuario'>".
                        "       <label>".$vReg['usrNome']."</label>".
                        "       <p>".$vReg['cmtConteudo']."</p>".
                        "   </div>".
                        "</div>";
                    }

                    mysqli_free_result($oDados);
    
                    mysqli_close($oCon);
                ?>
            </div>
        </section>
    </main>
</body>
</html>