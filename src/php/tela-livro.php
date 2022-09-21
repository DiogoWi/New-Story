<?php
session_start();

$oCon = mysqli_connect('localhost', 'root', '', 'new story');
$cSQL = "SELECT * FROM livro WHERE livID = ".$_GET['id'];

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
    <script src="../js/tela-livro.js" defer></script>
    <link rel="shortcut icon" href="../images/ICONE.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset.css">
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
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>

    <header>
        <div class="menu">
            <button class="menu-button" id="menu-button">
                <div></div>
            </button>
            <img src="../images/logo.png" alt="logo do site" class="logo">
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
            <button class="perfil"></button>
            <div class="perfil-menu">
                <div class="foto-perfil">Foto de perfil</div>
                <h5>Olá, <?php echo $_SESSION['usrNome'] ?></h5>
                <hr>
                <a class="gerenciar" href="#">Gerenciar sua Conta</a>
                <a class="gerenciar" href="#">Gerenciar seus Livros</a>
                <a class="sair" href="logout.php">Sair</a>
            </div>
            <?php
            }
            ?>
        </div>
    </header>

    <section class="livro">
        <div class="container-livro">
            <div class="slider-livro">
                <div class="fotos">
                    <div>Foto</div>
                    <div>Foto</div>
                    <div>Foto</div>
                    <div>Foto</div>
                </div>

                <div class="foto-principal">
                    <button>
                        <img src="../images/seta-esquerda.png" alt="seta para a esquerda">
                    </button>

                    <Label>Foto</Label>

                    <button>
                        <img src="../images/seta-direita.png" alt="seta para a direita">
                    </button>
                </div>
            </div>

            <div class="dados-livro">
                <h1> <?php echo $vReg['livNome']; ?> </h1>
                <hr>
                <h2> <?php echo $vReg['livStatus']; ?> </h2>
                <h1>Sinopse</h1>
                <hr>
                <p class="sinopse"> <?php echo $vReg['livSinopse'] ?> </p>
                <label id="ver-mais">Ver mais</label>
                <button>Link de Compra</button>
            </div>
        </div>
        <hr>
        <div class="autor">
            <div class="foto-autor">Foto</div>

            <div class="descricao">
                <label>Nome do Autor</label>
                <p>Este livro foi escrito em...</p>
                <label>Ver mais</label>
            </div>
        </div>
        <hr style="border: 1px solid #872D48; background-color: #872D48">
    </section>

    <section class="comentario">
        <h1>Comentários (XX)</h1>

        <div class="escrever">
            <div class="perfil">Foto</div>
            <textarea rows="1" placeholder="Adicione um comentário..." id="comentario"></textarea>
        </div>

        <div class="container-comentarios">
            <div class="comentarios">
                <div class="foto-usuario">Foto</div>
                <div class="dados-usuario">
                    <label>Nome Usuário</label>
                    <p>Comentário bem legal.</p>
                </div>
                <div class="interacoes">
                    <button class="like">
                        <img src="../images/like-marcado.png" alt="imagem de um like">
                    </button>
                    <button class="comentar">
                        <img src="../images/comentario.png" alt="imagem de um balão de conversa">
                    </button>
                </div>
            </div>
            <div class="comentarios">
                <div class="foto-usuario">Foto</div>
                <div class="dados-usuario">
                    <label>Nome Usuário</label>
                    <p>Comentário bem legal.</p>
                </div>
                <div class="interacoes">
                    <button class="like">
                        <img src="../images/like.png" alt="imagem de um like">
                    </button>
                    <button class="comentar">
                        <img src="../images/comentario.png" alt="imagem de um balão de conversa">
                    </button>
                </div>
            </div>
            <div class="comentarios">
                <div class="foto-usuario">Foto</div>
                <div class="dados-usuario">
                    <label>Nome Usuário</label>
                    <p>Comentário bem legal.</p>
                </div>
                <div class="interacoes">
                    <button class="like">
                        <img src="../images/like.png" alt="imagem de um like">
                    </button>
                    <button class="comentar">
                        <img src="../images/comentario.png" alt="imagem de um balão de conversa">
                    </button>
                </div>
            </div>
        </div>
    </section>
</body>
</html>