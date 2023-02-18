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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>
    <script src="../js/cadastro-livro-tela.js" defer></script>
    <script src="../js/nav-header.js" defer></script>
    <link rel="shortcut icon" href="../images/ICONE.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/nav-header.css">
    <link rel="stylesheet" href="../css/cadastro-livro-tela.css">
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
        <form class="dados-livro" action="cadastro-livro.php" method="post" enctype="multipart/form-data">
            <section class="fotos-livro">
                <div class="slider-livro">
                    <div class="fotos">
                        <div id="campo1" onclick="adicionarFoto('foto1')">
                            <input type="file" name="foto1" id="inputfoto1" accept="image/*">

                            <img src="../images/sinal-mais.png" id="imagefoto1" alt="adicionar foto">
                        </div>
                        <div id="campo2" onclick="adicionarFoto('foto2')">
                            <input type="file" name="foto2" id="inputfoto2" accept="image/*">

                            <img src="../images/sinal-mais.png" id="imagefoto2" alt="adicionar foto">
                        </div>
                        <div id="campo3" onclick="adicionarFoto('foto3')">
                            <input type="file" name="foto3" id="inputfoto3" accept="image/*">

                            <img src="../images/sinal-mais.png" id="imagefoto3" alt="adicionar foto">
                        </div>
                    </div>
        
                    <div class="foto-principal">
                        <input type="file" id="imagem-capa" name="capa" accept="image/*" required>
        
                        <img src="../images/add-imagem.png" id="capa" alt="adicionar capa">
                        <label>Resolução mínima recomendada: 525x700 px</label>
                    </div>
                </div>
            </section>
        
            <div class="dados">
                <div class="dividir">
                    <div class="dado">
                        <label>Título</label>
                        <hr>
                        <input type="text" placeholder="Título" name="txtTitulo" required>
                    </div>
                    <div class="dado">
                        <label>Gênero</label>
                        <hr>
                        <select name="txtGenero" required>
                            <option value="" selected>(selecione um gênero)</option>
                            <?php
                                $cSQL = "SELECT ctgID, ctgTipo FROM categoria ORDER BY ctgTipo";
                            
                                $oDados = mysqli_query($oCon, $cSQL);
    
                                while($vReg = mysqli_fetch_assoc($oDados)){
                                    echo '<option value="'.$vReg['ctgID'].'">'.$vReg['ctgTipo'].'</option>';
                                }
                                mysqli_free_result($oDados);
                                mysqli_close($oCon);
                            ?>
                        </select>
                    </div>
                    <div class="dado">
                        <label>Sinopse</label>
                        <hr>
                        <textarea placeholder="Sinopse" name="txtSinopse" required></textarea>
                    </div>
                    <div class="dado">
                        <label>Descrição</label>
                        <hr>
                        <textarea placeholder="Descrição" name="txtDescricao" required></textarea>
                    </div>
                </div>
                <div class="dado status-campo">
                    <label>Status</label>
                    <hr>
                    <div class="status">
                        <div class="desenvolvimento">
                            <input type="radio" id="radio1" name="status" value="Desenvolvimento" checked></input>
                            <label for="radio1">Em desenvolvimento</label>
                        </div>
                        <div class="finalizado">
                            <input type="radio" id="radio2" name="status" value="Finalizado"></input>
                            <label for="radio2">Finalizado</label>
                        </div>
                    </div>
                </div>
                <div class="dado link-campo">
                    <div class="a-venda">
                        <input type="checkbox" name="venda" id="checkbox">
                        <label for="checkbox">A venda</label>
                    </div>
                    <div class="link">
                        <label>Link de compra</label>
                        <hr>
                        <input type="url" placeholder="Cole o link de onde o livro possa ser comprado" name="link"></input>
                    </div>
                </div>
                <button>Publicar</button>
            </div>
        </form>
    </main>
</body>
</html>