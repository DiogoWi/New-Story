<?php
    session_start();

    $usuario = $_POST['txtUsuario'];
    $email = $_POST['txtEmail'];
    $senha = $_POST['txtSenha'];

    $oCon = mysqli_connect('localhost', 'root', '', 'new story');
    $cSQL = "INSERT INTO usuario (usrNome, usrEmail, usrSenha) VALUES ('$usuario', '$email', MD5('$senha'))";

    if(mysqli_query($oCon, $cSQL)){
        $_SESSION['usrID'] = mysqli_insert_id($oCon);
        $_SESSION['usrNome'] = $usuario;
        $_SESSION['usrEmail'] = $email;
    }
    mysqli_close($oCon);

    header('location: ../../index.php');
?>