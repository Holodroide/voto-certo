<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 
 
// resgata os valores do formulário
$password = isset($_POST['senha_usr']) ? $_POST['senha_usr'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
 
// validação (bem simples, mais uma vez)
if (empty($password))
{
    echo "Volte e digite a nova senha.";
    exit;
}

// cria o hash da senha
$passwordHash = make_hash($password);
 
// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE tbl_usuario SET senha_usr = :senha  WHERE id_usr = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':senha', $passwordHash);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($stmt->execute())
{
    header('Location: painel-user.php');
}
else
{
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}