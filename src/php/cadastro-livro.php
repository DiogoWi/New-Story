<?php
    session_start();

    $titulo = $_POST['txtTitulo'];
    $idUsuario = $_SESSION['usrID'];
    $genero = $_POST['txtGenero'];
    $status = $_POST['status'];
    $sinopse = nl2br($_POST['txtSinopse']);
    $descricao = nl2br($_POST['txtDescricao']);
    $link = $_POST['link'];

    if(isset($_POST['venda'])){
        $status = "A venda";
    }

    // tratamento do arquivo
    // capa
    $pasta = "images/capas/";
    $extensaoCapa = strtolower(pathinfo($_FILES['capa']['name'])['extension']);

    if($_FILES['capa']['tmp_name'] != ''){
        $nomeArq = md5($titulo . '_' . date('Ymd')) . '.' . $extensaoCapa;
    }

    if($extensaoCapa != "jpg" && $extensaoCapa != "png"){
        die("Tipo de arquivo não aceito");
    }

    $caminhoCapa = $pasta . $nomeArq;
    $deu_certo = move_uploaded_file($_FILES['capa']['tmp_name'], '../' . $caminhoCapa);

    if(!$deu_certo){
        die("Não foi possível fazer o upload da capa");
    }

    // Foto 1
    if(isset(pathinfo($_FILES['foto1']['name'])['extension'])){
        $extensaoFoto1 = strtolower(pathinfo($_FILES['foto1']['name'])['extension']);

        if($_FILES['foto1']['tmp_name'] != ''){
            $nomeArq = md5($titulo . '*' . date('Ymd')) . '.' . $extensaoFoto1;
        }

        if($extensaoFoto1 != "jpg" && $extensaoFoto1 != "png"){
            die("Tipo de arquivo não aceito");
        }

        $caminhoFoto1 = $pasta . $nomeArq;
        $deu_certo = move_uploaded_file($_FILES['foto1']['tmp_name'], '../' . $caminhoFoto1);

        if(!$deu_certo){
            die("Não foi possível fazer o upload da foto 1");
        }
    }
    else{
        $caminhoFoto1 = "";
    }

    // Foto 2
    if(isset(pathinfo($_FILES['foto2']['name'])['extension'])){
        $extensaoFoto2 = strtolower(pathinfo($_FILES['foto2']['name'])['extension']);

        if($_FILES['foto2']['tmp_name'] != ''){
            $nomeArq = md5($titulo . '-' . date('Ymd')) . '.' . $extensaoFoto2;
        }

        if($extensaoFoto2 != "jpg" && $extensaoFoto2 != "png"){
            die("Tipo de arquivo não aceito");
        }

        $caminhoFoto2 = $pasta . $nomeArq;
        $deu_certo = move_uploaded_file($_FILES['foto2']['tmp_name'], '../' . $caminhoFoto2);

        if(!$deu_certo){
            die("Não foi possível fazer o upload da foto 2");
        }
    }
    else{
        $caminhoFoto2 = "";
    }

    // Foto 3
    if(isset(pathinfo($_FILES['foto3']['name'])['extension'])){
        $extensaoFoto3 = strtolower(pathinfo($_FILES['foto3']['name'])['extension']);

        if($_FILES['foto3']['tmp_name'] != ''){
            $nomeArq = md5($titulo . '!' . date('Ymd')) . '.' . $extensaoFoto3;
        }

        if($extensaoFoto3 != "jpg" && $extensaoFoto3 != "png"){
            die("Tipo de arquivo não aceito");
        }

        $caminhoFoto3 = $pasta . $nomeArq;
        $deu_certo = move_uploaded_file($_FILES['foto3']['tmp_name'], '../' . $caminhoFoto3);

        if(!$deu_certo){
            die("Não foi possível fazer o upload da foto 3");
        }
    }
    else{
        $caminhoFoto3 = "";
    }

    // conexão com o banco
    $oCon = mysqli_connect('localhost', 'root', '', 'new story');
    $cSQL = "INSERT INTO livro (livNome, usrID, ctgID, livStatus, livCapa, livFoto1, livFoto2, livFoto3, livSinopse, livSobre, livLinkCompra) VALUES ('$titulo', '$idUsuario', '$genero', '$status', '$caminhoCapa', '$caminhoFoto1', '$caminhoFoto2', '$caminhoFoto3', '$sinopse', '$descricao', '$link')";

    if(mysqli_query($oCon, $cSQL)){
        header('location: ../../index.php');
    }
    else{
        echo "Não foi possível cadastrar o livro";
    }

    mysqli_close($oCon);
?>