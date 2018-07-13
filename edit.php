<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 
 
// resgata os valores do formulário
$name = isset($_POST['dsc_nom_admin']) ? $_POST['dsc_nom_admin'] : null;
$email = isset($_POST['dsc_email_admin']) ? $_POST['dsc_email_admin'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
 
// validação (bem simples, mais uma vez)
if (empty($name) || empty($email))
{
    echo "Volte e preencha todos os campos";
    exit;
}
 
// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE tbl_admin SET dsc_nom_admin = :name, dsc_email_admin = :email  WHERE id_admin = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($stmt->execute())
{
    header('Location: painel.php');
}
else
{
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}