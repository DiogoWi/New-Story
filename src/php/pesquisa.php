<?php
    session_start();

    $oCon = mysqli_connect('localhost', 'root', '', 'new story');

    $pesquisa = filter_input(INPUT_GET, 'pesquisa', FILTER_SANITIZE_STRING);

    if(!empty($pesquisa)){
        $cSQL = "SELECT livID, livNome FROM livro WHERE livNome LIKE '%".$pesquisa."%' LIMIT 10;";
        $oDados = mysqli_query($oCon, $cSQL);
        
        if($vReg = mysqli_fetch_assoc($oDados)){
            $dados[] = [
                'id' => $vReg['livID'],
                'nome' => $vReg['livNome']
            ];

            while($vReg = mysqli_fetch_assoc($oDados)){
                $dados[] = [
                    'id' => $vReg['livID'],
                    'nome' => $vReg['livNome']
                ];
            }

            $retorna = ['erro' => false, 'dados' => $dados];
        }
        else{
            $retorna = ['erro' => true, 'menssagem' => "Erro: Nenhuma pesquisa encontrada!"];
        }
    }
    else{
        $retorna = ['erro' => true, 'menssagem' => "Erro: Nenhuma pesquisa encontrada!"];
    }

    echo json_encode($retorna);
?>