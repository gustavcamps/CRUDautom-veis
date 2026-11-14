<?php
    //extrair do dados do formulário
    extract($_POST);
    extract($_FILES);
    //iniciar sessão
    @session_start();
    //banco de dados
    require('connect.php');
    //criar nome para o arquivo
    $diretorio = "imgsCarros/".md5(time()).".jpg";
    //mover o arquivo
    move_uploaded_file($foto['tmp_name'],$diretorio);
    $msg = "";
    $erros = [];
    if(empty($modelo)){
        $erros[] = "<p>O campo modelo é obrigatório</p>";
    }
    if(empty($montadora)){
        $erros[] = "<p>O campo montadora é obrigatório</p>";
    }
    $anoFabricacaoValidado = filter_var($anoFabricacao, FILTER_VALIDATE_INT);
    if(!$anoFabricacaoValidado){
        $erros[] = "<p>O ano de fabricação é obrigatório</p>";
    }
    $anoModeloValidado = filter_var($anoModelo, FILTER_VALIDATE_INT);
    if(!$anoModeloValidado){
        $erros[] = "<p>O ano de fabricação é obrigatório</p>";
    }
    if(empty($cor)){
        $erros[] = "<p>O campo cor é obrigatório</p>";
    }
    if(empty($motorizacao)){
        $erros[] = "<p>O campo motorização é obrigatório</p>";
    }
    if(!empty($erros)){
        foreach($erros as $erro){
            $msg .= "<p>$erro</p>";
        }
    }else{
        //novo pdo
        try{
            $pdo  = new PDO($dsn,$user,$pass,$options);
            $query = "Insert into tb_carros (modelo,montadora,ano_fabricacao,ano_modelo,motorizacao,foto,cor) VALUES (:modelo,:montadora,:ano_fabricacao,:ano_modelo,:motorizacao,:diretorio,:cor)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':modelo'           => $modelo,
                ':montadora'        => $montadora,
                ':ano_fabricacao'   => $anoFabricacaoValidado,
                ':ano_modelo'       => $anoModeloValidado,
                ':motorizacao'      => $motorizacao,
                ':diretorio'        => $diretorio,
                ':cor'              => $cor
            ]);

            $msg = "<p class=sucesso>Veículo cadastrado com sucesso!</p>";
        }catch(PDOException $e){
            $msg .= $e->getMessage();
        }
    }
    $_SESSION['mensagem'] = $msg;
    header("location:addCarro.php");

