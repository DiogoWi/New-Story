<?php
    session_start();

    $titulo = $_POST['txtTitulo'];
    $idUsuario = $_SESSION['usrID'];
    $genero = $_POST['txtGenero'];
    $status = $_POST['status'];
    $sinopse = $_POST['txtSinopse'];

    // tratamento do arquivo
    $pasta = "images/capas/";
    $extensao = strtolower(pathinfo($_FILES['capa']['name'])['extension']);
    if($_FILES['capa']['tmp_name'] != ''){
        $nomeArq = md5($titulo . '_' . date('Ymd')) . '.' . $extensao;
    }

    if($extensao != "jpg" && $extensao != "png"){
        die("Tipo de arquivo não aceito");
    }

    $caminho = $pasta . $nomeArq;
    $deu_certo = move_uploaded_file($_FILES['capa']['tmp_name'], '../' . $caminho);

    if(!$deu_certo){
        die("Não foi possível fazer o upload da capa");
    }

    // conexão com o banco
    $oCon = mysqli_connect('localhost', 'root', '', 'new story');
    $cSQL = "INSERT INTO livro (livNome, usrID, ctgID, livStatus, livCapa, livSinopse) VALUES ('$titulo', '$idUsuario', '$genero', '$status', '$caminho', '$sinopse')";

    if(mysqli_query($oCon, $cSQL)){
        header('location: ../../index.php');
    }
    else{
        echo "Não foi possível cadastrar o livro";
    }

    mysqli_close($oCon);
?>