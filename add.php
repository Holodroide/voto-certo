<?php
 
require_once 'init.php';
 
// pega os dados do formuário
$name = isset($_POST['dsc_nom_admin']) ? $_POST['dsc_nom_admin'] : null;
$email = isset($_POST['dsc_email_admin']) ? $_POST['dsc_email_admin'] : null;
$senha = isset($_POST['dsc_senha_admin']) ? $_POST['dsc_senha_admin'] : null;

// testeando new commit
// outro teste
 
// validação (bem simples, só pra evitar dados vazios)
if (empty($name) || empty($email) || empty($senha))
{
    echo "Volte e preencha todos os campos";
    exit;
}

// cria o hash da senha
$passwordHash = make_hash($senha);
 
// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO tbl_admin(dsc_nom_admin, dsc_email_admin, dsc_senha_admin) VALUES(:name, :email, :senha)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $passwordHash);
 
if ($stmt->execute())
{
    header('Location: painel.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}