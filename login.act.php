<?php
//extrair do dados do formulário
extract($_POST);
//iniciar sessão
@session_start();
//banco de dados
require('connect.php');
//variáveis de mensagens de erro
$msg = "";
$erros = [];
$destino = "location:login.php";

//VERIFICAR SE O EMAIL está no banco de dados
$pdo = new PDO($dsn, $user, $pass, $options);
$query = "Select * from tb_usuarios where email = :email";
$stmt = $pdo->prepare($query);
$stmt->execute([':email' => $email]);
$linhas = $stmt->rowCount();
$buscaEmail = $stmt->fetch();
if ($linhas == 1) {
    $senha = $_POST['senha1'];
    if (password_verify($senha, $buscaEmail['senha'])) {
        //senha correta, iniciar a sessão
        $_SESSION['login']  = true;
        $_SESSION['nome']   = $buscaEmail['nome'];
        $_SESSION['email']  = $buscaEmail['email'];
        $_SESSION['foto']   = $buscaEmail['foto'];
        $destino = "location:listarCarros.php";
    } else {
        //senha está incorreta
        $erros[] = "<p>Senha incorreta</p>";
    }
} else {
    $erros[] = "<p>Email não encontrado!</p>";
}
foreach ($erros as $erro) {
    $msg .= "<p>$erro</p>";
}
$_SESSION['mensagem'] = $msg;
header($destino);
