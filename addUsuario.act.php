<?php
    //extrair do dados do formulário
    extract($_POST);
    extract($_FILES);
    //iniciar sessão
    @session_start();
    //banco de dados
    require('connect.php');

    $msg = "";
    $erros = [];

    //VERIFICAR SE O EMAIL JÁ FOI UTILIZADO
    $pdo = new PDO($dsn,$user,$pass,$options);
    $query = "Select email from tb_usuarios where email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':email' => $email]);
    $buscaEmail = $stmt->fetchColumn();
    if($buscaEmail != false){
        $erros[] = "<p>Email já utilizado!</p>";
    }






    //criar nome para o arquivo
    $diretorio = "imgsUsuarios/".md5(time()).".jpg";
    //mover o arquivo
    move_uploaded_file($foto['tmp_name'],$diretorio);
    
    if(empty($nome)){
        $erros[] = "<p>O campo nome é obrigatório</p>";
    }
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if(empty($email) || $email == null){
        $erros[] = "<p>O campo email é obrigatório</p>";
    }
    if(empty($senha1)){
        $erros[] = "<p>O campo senha é obrigatório</p>";
    }
    if(empty($senha2)){
        $erros[] = "<p>A verificação da senha é campo obrigatório</p>";
    }
    if($senha1 != $senha2){
        $erros[] = "<p>As senhas não conferem!</p>";
    }
    


    if(!empty($erros)){
        foreach($erros as $erro){
            $msg .= "<p>$erro</p>";
        }
    }else{
        //novo pdo
        try{
            //hash da senha
            $senha1 = password_hash($senha1, PASSWORD_DEFAULT);
            $pdo  = new PDO($dsn,$user,$pass,$options);
            $query = "Insert into tb_usuarios (nome,email,senha,foto) VALUES                (:nome,:email,:senha,:destino)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':nome'         => $nome,
                ':email'        => $email,
                ':senha'        => $senha1,
                ':destino'      => $diretorio
            ]);

            $msg = "<p class=sucesso>Usuário cadastrado com sucesso!</p>";
        }catch(PDOException $e){
            $msg .= $e->getMessage();
        }
    }
    $_SESSION['mensagem'] = $msg;
    header("location:addUsuario.php");

