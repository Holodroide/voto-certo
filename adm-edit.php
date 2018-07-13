<?php
session_start();

// Inclui conexão com BR MySql
// Confere se usuário  está logado (Administrador, Cliente ou Usuário)
// Fas o Hash de senha 
require_once 'include/init.php';

// Faz a validação da sessão do cliente e atribui TRUE ou FALSE na variável
// Se TRUE, exibe menu. Se FALSE, exibe formulário de login
require 'include/check.php';
 
// Recebe os dados do formulário e define as variáveis
$name = isset($_POST['nome_adm']) ? $_POST['nome_adm'] : null;
$email = isset($_POST['email_adm']) ? $_POST['email_adm'] : null;
$idadm = isset($_POST['idadm']) ? $_POST['idadm'] : null;

// Conecta ao MySql
$PDO = db_connect();

// ################## Valida campos formulário ################### 
// Confere se os campos foram preenchidos
if (empty($name) || empty($email))
{
    echo "<script>
          alert('VOLTE E PREENCHA TODOS OS CAMPOS!');
          window.history.back()
		  </script>";
    exit;
}

// Pesquisa se email do formulário existe em tbl_adm
$sql = "SELECT * FROM tbl_adm WHERE email_adm = :email AND id_adm != :idadm";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':idadm', $idadm);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// Se o email já existir em tbl_adm, exibe mensagem
if (is_array($user))
{
    echo "<script>
          alert('Já existe um administrador cadastrado com esse email!');
          window.history.back()
      </script>";
    exit;
}

// Pesquisa se nome do formulário existe em tbl_adm
$sql = "SELECT * FROM tbl_adm WHERE nome_adm = :nome AND id_adm != :idadm";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $name);
$stmt->bindParam(':idadm', $idadm);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// Se o nome já existir em tbl_adm, exibe mensagem
if (is_array($user))
{
    echo "<script>
          alert('Já existe um administrador cadastrado com esse nome!');
          window.history.back()
      </script>";
    exit;
}

// ######################## Fim da validação ##############################


 
// Executa query para atualizar a tabela tbl_adm
$sql = "UPDATE tbl_adm SET nome_adm = :name, email_adm = :email  WHERE id_adm = :idadm";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':idadm', $idadm, PDO::PARAM_INT);

// Se a query for executada, redireciona para o painel admin  
if ($stmt->execute())
{
    header('Location: adm-painel.php');
}

// Se a query não for executada, exibe alerta com msg de erro e volta para página anterior
else
{
    echo "<script>
          alert('ERRO: ".print_r($stmt->errorInfo())."');
          window.history.back()
		  </script>";
    exit;
}