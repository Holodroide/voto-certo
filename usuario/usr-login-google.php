<?php
 
// inclui o arquivo de inicialização
require 'include/init.php';
 
// resgata variáveis do formulário
$nome = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_STRING);
 
$PDO = db_connect();
 
$sql = "SELECT * FROM tbl_usr WHERE email_usr = :email";
$stmt = $PDO->prepare($sql);
 $stmt->bindParam(':email', $email);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0)
{
      //Insere todas as informações no BD
      $sql = "INSERT INTO tbl_usr (id_cli, nome_usr, email_usr) VALUES(:cliId, :name, :email)";
      $stmt = $PDO->prepare($sql);
      $stmt->bindParam(':cliId', $cliente);     
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
       
      if ($stmt->execute()){

         
      $sql = "SELECT * FROM tbl_usr WHERE email_usr = :email";
      $stmt = $PDO->prepare($sql);
       $stmt->bindParam(':email', $email);
      $stmt->execute();
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // pega o primeiro usuário
      $user = $users[0];

      session_start();
      $_SESSION['usr_logged'] = true;
      $_SESSION['usr_id'] = $user['id_usr'];
      $_SESSION['usr_name'] = $user['nome_usr'];
      $_SESSION['id_cli'] = $user['id_cli']; 

  $resultado = 'index.php';
  echo $resultado;

      }else{

          echo "Erro ao cadastrar";
          print_r($stmt->errorInfo());
          exit;

      }
}
 
// pega o primeiro usuário
$user = $users[0];

session_start();
	$_SESSION['usr_logged'] = true;
	$_SESSION['usr_id'] = $user['id_usr'];
	$_SESSION['usr_name'] = $user['nome_usr'];
  $_SESSION['id_cli'] = $user['id_cli'];  

header('Location: index.php');
