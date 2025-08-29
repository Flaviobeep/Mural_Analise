<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Moderar pedidos</title>
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<div id="main">
<div id="geral">
<div id="header">
    <h1>Mural de pedidos</h1>
</div>

<?php
include "conexao.php"

if(isset($_POST['atualiza'])){
    $idatualiza = intval($_POST['id']);
    $nome       = mysqli_real_escape_string($conexao, $_POST['nome']);
    $e-mail      = mysqli_real_escape_string($conexao, $_POST['e-mail']);
    $mensagem        = mysqli_real_escape_string($conexao, $_POST['mensagem']);

    $sql = "UPDATE recados SET nome='$nome', e-mail='$e-mail', mensagem='$mensagem' WHERE id=$idatualiza";
    mysqli_query($conexao, $sql) or die("Erro ao atualizar: " . mysqli_error($conexao));
    header("Location: moderar.php");
    exit;

    if(isset($_GET['acao']) && $_GET['acao'] == 'excluir'){
        $id = intval($_GET['id']);
        mysqli_query($conexao, "DELETE FROM recados WHERE id=$id") or die("Erro ao deletar: " . mysqli_error($conexao));
        header("Location: moderar.php");
        exit;
    }

    $editar_id = isset($_GET['acao']) && $_GET['acao'] == 'editar' ? intval($_GET['id']) : 0;
$recado_editar = null;
if($editar_id){
    $res = mysqli_query($conexao, "SELECT * FROM recados WHERE id=$editar_id");
    $recado_editar = mysqli_fetch_assoc($res);
}
}