<?php
 
require_once 'init.php';
 
// pega os dados do formuário
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : null;
$name = isset($_POST['nome_usr']) ? $_POST['nome_usr'] : null;
$email = isset($_POST['email_usr']) ? $_POST['email_usr'] : null;
$senha = isset($_POST['senha_usr']) ? $_POST['senha_usr'] : null;

// validação (bem simples, só pra evitar dados vazios)
if (empty($name) || empty($email) || empty($senha) || empty($cliente)) {
		echo '<script type="text/javascript">
		alert("Volte e preencha todos os campos.");
		window.history.back()
        </script>';
        exit;
}

// cria o hash da senha
$passwordHash = make_hash($senha);

			//Insere todas as informações no BD
			$PDO = db_connect();
			$sql = "INSERT INTO tbl_usuario (id_cli, nome_usr, email_usr, senha_usr) VALUES(:cliId, :name, :email, :senha)";
			$stmt = $PDO->prepare($sql);
			$stmt->bindParam(':cliId', $cliente);			
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':senha', $passwordHash);
			 
			if ($stmt->execute()){

			    header('Location: painel-user.php?idcli=15');

			}else{

			    echo "Erro ao cadastrar";
			    print_r($stmt->errorInfo());

			}
