<?php
 
// inclui o arquivo de inicialização
require 'init.php';
 
// resgata variáveis do formulário
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
 
if (empty($email) || empty($password))
{
    echo "Informe email e senha";
    exit;
}
 
// cria o hash da senha
$passwordHash = make_hash($password);
 
$PDO = db_connect();
 
$sql = "SELECT id_cli, nome_cli FROM tbl_cli WHERE email_cli = :email AND senha_cli = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $passwordHash);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
if (count($users) <= 0)
{
    echo "<script>
          alert('Email ou senha incorretos!');
          window.history.back()
		  </script>";
    exit;
}
 
// pega o primeiro usuário
$user = $users[0];
 
session_start();
	$_SESSION['logged_in'] = true;
	$_SESSION['cli_id'] = $user['id_cli'];
	$_SESSION['cli_name'] = $user['nome_cli'];
 
header('Location: index.php');