<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 

// resgata os valores do formulário
$name = isset($_POST['nome_usr']) ? $_POST['nome_usr'] : null;
$email = isset($_POST['email_usr']) ? $_POST['email_usr'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

// validação (bem simples, só pra evitar dados vazios)
if (empty($name) || empty($email)) {
		echo '<script type="text/javascript">
		alert("Volte e preencha todos os campos.");
		window.history.back()
        </script>';

        exit;
}


		// Atualiza o BD, menos a senha
		$PDO = db_connect();
		$sql = "UPDATE tbl_usuario SET nome_usr = :name, email_usr = :email   WHERE id_usr = :id";
		$stmt = $PDO->prepare($sql);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);


		if ($stmt->execute()){
		      echo "<script>
	          alert('Cadastro atualizado com sucesso!');
	          window.history.back()
			  </script>";

	    exit;

		} else {

			    echo "Erro ao cadastrar";
			    print_r($stmt->errorInfo());

		}
