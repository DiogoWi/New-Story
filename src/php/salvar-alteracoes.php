<?php
    session_start();

    $nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    $biografia = filter_input(INPUT_POST, 'biografia', FILTER_DEFAULT);

    // tratamento do arquivo
    // foto usuário

    $pastaFoto = "images/fotosUsuario/";
    $pastaCapa = "images/capaUsuario/";

    $foto = filter_input(INPUT_POST, 'foto', FILTER_DEFAULT);
    $fotoInvertido = strrev($foto);
    $resultadoCompleto = strrev(substr($fotoInvertido, 0, strpos($fotoInvertido, "/")));
    $resultadoExtensao = strrev(substr(strrev($resultadoCompleto), 0, strpos(strrev($resultadoCompleto), ".")));

    if($resultadoExtensao != "png"){
        // Separa as informações da imagem base64 pela ","
        list(, $foto) = explode(',', $foto);

        $foto = base64_decode($foto);
        $nomeFoto = md5($_SESSION['usrNome'] . '_' . date('Ymd')) . '.png';
        $caminhoFoto = $pastaFoto . $nomeFoto;

        file_put_contents('../images/fotosUsuario/' . $nomeFoto, $foto);
    }
    else{
        $caminhoFoto = $pastaFoto . $resultadoCompleto;
    }

    // foto capa
    $capa = filter_input(INPUT_POST, 'capa', FILTER_DEFAULT);
    $capaInvertido = strrev($capa);
    $resultadoCompleto = strrev(substr($capaInvertido, 0, strpos($capaInvertido, "/")));
    $resultadoExtensao = strrev(substr(strrev($resultadoCompleto), 0, strpos(strrev($resultadoCompleto), ".")));

    if($resultadoCompleto != ""){
        if($resultadoExtensao != "png"){
            // Separa as informações da imagem base64 pela ","
            list(, $capa) = explode(',', $capa);
    
            $capa = base64_decode($capa);
            $nomeCapa = md5($_SESSION['usrNome'] . '*' . date('Ymd')) . '.png';
            $caminhoCapa = $pastaCapa . $nomeCapa;
    
            file_put_contents('../images/capaUsuario/' . $nomeCapa, $capa);
        }
        else{
            $caminhoCapa = $pastaCapa . $resultadoCompleto;
        }
    }
    else{
        $caminhoCapa = "";
    }

    // conexão com o banco
    $oCon = mysqli_connect('localhost', 'root', '', 'new story');
    $cSQL = "UPDATE usuario SET usrNome = '$nome', usrEmail = '$email', usrBiografia = '$biografia', usrFoto = '$caminhoFoto', usrCapa = '$caminhoCapa' WHERE usrID = " . $_SESSION['usrID'];

    mysqli_query($oCon, $cSQL);

    mysqli_close($oCon);
?>