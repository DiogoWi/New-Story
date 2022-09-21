<?php
session_start();

if(!isset($_SESSION['usrID'])){
    header('location: ../../index.php');
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
    <script src="../js/cadastro-livro-tela.js" defer></script>
    <link rel="shortcut icon" href="../images/ICONE.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset.css">
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
                    <a href="#">
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
                    <a href="#">
                        <span class="icon"><ion-icon name="heart-outline"></ion-icon></span>
                        <span class="title">Favoritos</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="duplicate-outline"></ion-icon></span>
                        <span class="title">Autores seguidos</span>
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
            <img class="logo" src="../images/logo.png" alt="logo do site">
            <label>New Story</label>
        </div>

        <div class="container-pesquisa">
            <button class="btn-voltar">
                <img src="../images/voltar.png" alt="seta voltar">
            </button>
            <div class="pesquisa">
                <img src="../images/lupa.png" alt="imagem de uma lupa">
                <input type="text" placeholder="Pesquise seu livro, autor ou gênero">
            </div>
        </div>

        <div class="itens">
            <button class="aparece-pesquisa">
                <img src="../images/lupa.png" alt="imagem de uma lupa">
            </button>

            <button class="perfil"></button>
            <div class="perfil-menu">
                <div class="foto-perfil">Foto de perfil</div>
                <h5>Olá, <?php echo $_SESSION['usrNome'] ?></h5>
                <hr>
                <a class="gerenciar" href="#">Gerenciar sua Conta</a>
                <a class="gerenciar" href="#">Gerenciar seus Livros</a>
                <a class="sair" href="logout.php">Sair</a>
            </div>
        </div>
    </header>

    <main>
        <form class="dados-livro" action="cadastro-livro.php" method="post" enctype="multipart/form-data">
            <section class="fotos-livro">
                <div class="slider-livro">
                    <div class="fotos">
                        <div>Foto</div>
                        <div>Foto</div>
                        <div>Foto</div>
                        <div>Foto</div>
                    </div>
        
                    <div class="foto-principal">
                        <input type="file" id="imagem-capa" name="capa" accept="image/*">
        
                        <img src="../images/add-imagem.png" id="capa" alt="adicionar capa">
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
                        <select name="txtGenero">
                            <option value="" selected>(selecione um gênero)</option>
                            <?php
                                $oCon = mysqli_connect('localhost', 'root', '', 'new story');
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
                    <label>Link de compra</label>
                    <hr>
                    <input type="url" placeholder="Cole o link de onde o livro possa ser comprado"></input>
                </div>
                <button>Publicar</button>
            </div>
        </form>
    </main>
</body>
</html>