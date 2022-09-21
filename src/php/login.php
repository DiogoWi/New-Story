<?php
    session_start();

    $oCon = mysqli_connect('localhost', 'root', '', 'new story');
    $cSQL = "SELECT usrID, usrNome, usrEmail FROM usuario" .
            " WHERE usrEmail = '" . $_POST['txtEmail'] . "'" .
            " AND usrSenha = MD5('" . $_POST['txtSenha'] . "');";

    $oDados = mysqli_query($oCon, $cSQL);

    if($vReg = mysqli_fetch_assoc($oDados)){
        $_SESSION['usrID'] = $vReg['usrID'];
        $_SESSION['usrNome'] = $vReg['usrNome'];
        $_SESSION['usrEmail'] = $vReg['usrEmail'];
        header('location: ../../index.php');
    }
    else{
        echo 'este login não existe';
    }

    mysqli_free_result($oDados);
    
    mysqli_close($oCon);
?>