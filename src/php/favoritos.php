<?php
    session_start();

    $favoritado = $_GET['favoritado'];
    $idUsuario = $_GET['idUsuario'];
    $idLivro = $_GET['idLivro'];

    $comprimento = strpos(strrev($_SERVER['HTTP_REFERER']), "/");
    $resultado = strrev(substr(strrev($_SERVER['HTTP_REFERER']), 0, $comprimento));
    if(strpos($resultado, "?")){
        $teste = strpos($resultado, "?");
        $resultado = substr($resultado, 0, $teste);
    }

    $oCon = mysqli_connect('localhost', 'root', '', 'new story');

    if($favoritado == "sim"){
        $cSQL = "DELETE FROM favoritos WHERE usrID = ".$idUsuario." AND livID = ".$idLivro;

        if(mysqli_query($oCon, $cSQL)){
            if($resultado == "tela-livro.php"){
                header("location: tela-livro.php?id=".$idLivro);
            }
            if($resultado == "favoritos-tela.php"){
                header("location: favoritos-tela.php");
            }
        }
        else{
            echo "Não foi possível retirar o favorito deste livro";
        }
    }
    if($favoritado == "nao"){
        $cSQL = "INSERT INTO favoritos (usrID, livID) VALUES ('$idUsuario', '$idLivro')";
    
        if(mysqli_query($oCon, $cSQL)){
            header("location: tela-livro.php?id=".$idLivro);
        }
        else{
            echo "Não foi possível favoritar este livro";
        }
    }

    mysqli_close($oCon);
?>