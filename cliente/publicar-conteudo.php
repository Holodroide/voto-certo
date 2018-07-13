<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 

// resgata os valores do formulário
$idcont = isset($_GET['idcont']) ? (int) $_GET['idcont'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;




		// Atualiza o BD, menos a senha
		$PDO = db_connect();
		$sql = "UPDATE tbl_conteudo_usr SET status_cont = :status WHERE id_cont = :idcont";
		$stmt = $PDO->prepare($sql);
			$stmt->bindParam(':status', $status);	
		$stmt->bindParam(':idcont', $idcont, PDO::PARAM_INT);


		if ($stmt->execute()){
		      echo "<script>
	          alert('Status atualizado com sucesso!');
	          window.history.back()
			  </script>";

	    exit;

		} else {

			    echo "Erro ao cadastrar";
			    print_r($stmt->errorInfo());

		}
