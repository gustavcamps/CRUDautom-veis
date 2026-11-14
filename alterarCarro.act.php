<?php
@session_start();
require_once('connect.php');
$msg = "";
$erros = [];
extract($_FILES);
$destino = $_POST['destino'];
if($foto['size']>0){
    if($destino == ''){
        $diretorio = "imgsCarros/".md5(time()).".jpg";
    }
    move_uploaded_file($foto['tmp_name'],$destino);
}



//resgatando os valores
$modelo = $_POST['modelo'];
$montadora = $_POST['montadora'];
$anoFabricacao = $_POST['anoFabricacao'];
$anoModelo = $_POST['anoModelo'];
$cor = $_POST['cor'];
$motorizacao = $_POST['motorizacao'];
$codigo = $_POST['codigo'];
$destino = $_POST['destino'];

//verificando se existem campos vazios
foreach ($_POST as $campo => $valor) {
    if ($valor == '' || $valor == null) {
        $erros[] = "<p>" . ucfirst($campo) . " não pode ser vazio</p>";
    }
}
$anoModelo = filter_var($anoModelo, FILTER_VALIDATE_INT);
if (!$anoModelo) {
    $erros[] = "<p>Ano Modelo inválido</p>";
}
$anoFabricacao = filter_var($anoFabricacao, FILTER_VALIDATE_INT);
if (!$anoFabricacao) {
    $erros[] = "<p>Ano Fabricação inválido</p>";
}

if (!empty($erros)) {
    foreach ($erros as $erro) {
        $msg .= "<p class='erro'>$erro</p>";
    }
}else{
    try{
        $pdo = new PDO($dsn,$user,$pass,$options);
        $query = "Update tb_carros set 
            modelo= :modelo,
            montadora= :montadora,
            ano_fabricacao = :anoFabricacao,
            ano_modelo = :anoModelo,
            cor = :cor,
            motorizacao = :motorizacao,
            foto = :destino
            where codigo = :codigo";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':modelo'           => $modelo,
            ':montadora'        => $montadora,
            ':anoFabricacao'     => $anoFabricacao,
            ':anoModelo'        => $anoModelo,
            ':motorizacao'      => $motorizacao,
            ':cor'              => $cor,
            ':codigo'           => $codigo,
            ':destino'             => $destino,
        ]);
        $msg .= "<p>Alterações gravadas!</p>";

    }catch(PDOException $e){
        $msg .= "Erro encontrado: ".$e->getMessage();
    }
}
$_SESSION['mensagem'] = $msg;
header("location:alterarCarro.php?registro=$codigo");


