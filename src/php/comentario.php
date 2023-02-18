<?php
    session_start();

    $livroId = $_GET['livroId'];
    $usuarioId = $_SESSION['usrID'];
    $comentario = nl2br($_GET['comentario']);

    $oCon = mysqli_connect('localhost', 'root', '', 'new story');
    $cSQL = "INSERT INTO comentario (livID, usrID, cmtConteudo) VALUES ('$livroId', '$usuarioId', '$comentario')";

    mysqli_query($oCon, $cSQL);

    $cSQL = "SELECT * FROM comentario INNER JOIN usuario ON comentario.usrID = usuario.usrID WHERE livID = ".$livroId;
    $oDados = mysqli_query($oCon, $cSQL);

    if($vReg = mysqli_fetch_assoc($oDados)){
        $comentarios[] = [
            'usuarioFoto' => $vReg['usrFoto'],
            'usuarioNome' => $vReg['usrNome'],
            'comentario' => $vReg['cmtConteudo']
        ];

        while($vReg = mysqli_fetch_assoc($oDados)){
            $comentarios[] = [
                'usuarioFoto' => $vReg['usrFoto'],
                'usuarioNome' => $vReg['usrNome'],
                'comentario' => $vReg['cmtConteudo']
            ];
        }

        $retorna = ['comentarios' => $comentarios];
    }

    mysqli_close($oCon);

    echo json_encode($retorna);
?>