<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 
 
// resgata os valores do formulário
$name = isset($_POST['nome_cli']) ? $_POST['nome_cli'] : null;
$email = isset($_POST['email_cli']) ? $_POST['email_cli'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

$largura = 300; //300px
$altura = 300; //300px
$tamanho = 100000; //1Mb

$arquivo = $_FILES['imglogo_cli'];

//Define o diretório de destino do arquivo
define('DEST_DIR', __DIR__ . '/arquivos');


// se o [name] NÃO estiver vazio, é porque um arquivo foi enviado, então 
// será feita a atualização do arquiv de imagem deletando o anterior e subindo um novo.
if (isset($_FILES['imglogo_cli']) && !empty($_FILES['imglogo_cli']['name'])){

	// Conexão com BD
	$PDO = db_connect();

	// SQL para selecionar os registros
	$sql = "SELECT imglogo_cli FROM tbl_cliente WHERE id_cli = :id";
	 
	// seleciona os registros
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	//Se so select retornar $user vazio, alerta do erro e retorna para pág anterior.
	/*if (count($user) <= 0){
	    echo "<script>
	          alert('Erro: Nenhum cliente encontrado para esse id.');
	          window.history.back()
			  </script>";
	    exit;
	}*/

	// Verifica se o arquivo existe no diretório e deleta
	$filename = DEST_DIR . '/' . $user["imglogo_cli"];

	if (file_exists($filename)) {
		unlink(DEST_DIR . '/' . $user["imglogo_cli"]);
	}

	//Valida o tipo de imagem
	if(!preg_match('/^(image)\/(jpeg|png)$/', $arquivo['type'])){
		
		echo '<script>
		alert("Extensão inválida. Apenas arquivos jpeg e png são aceitos.");
		window.history.back()
		</script>';
		exit;
	}

	//Valida as dimensões do arquivo
	$dimensoes = getimagesize($arquivo['tmp_name']);
	if($dimensoes[0] > $largura || $dimensoes[1] > $altura){
		
		echo '<script>
		alert("Imagem fora das dimensões aceitas 280X180px");
		window.history.back()
		</script>';
		exit;
	}

	//Valida o tamanho do arquivo
	if($arquivo['size'] > $tamanho){
		
		echo '<script>
		alert("Imagem acima do peso permitido. Máximo: 1Mb.");
		window.history.back()
		</script>';
		exit;			

	}

	if (file_exists($filename)) {

		unlink(DEST_DIR . '/' . $user["imglogo_cli"]);

	} else {

		echo 'img não encontrada no dir...';

	}

	// Caso não ocorra nehum erro, gera nome único para o arquivo
	// Pega a extensão do arquivo
    $ext = explode('.', $arquivo['name']);
    $ext = end($ext);
 
    // Gera o novo nome
    $novoNome = uniqid() . '.' . $ext;

    if (!move_uploaded_file($arquivo['tmp_name'], DEST_DIR . '/' . $novoNome)){

        echo '<script type="text/javascript">
        alert("Erro no upload. O cadastro não foi feito.");
		window.history.back()
        </script>';
        exit;

    } else {

		// Atualiza o BD, menos a senha
		$PDO = db_connect();
		$sql = "UPDATE tbl_cliente SET nome_cli = :name, email_cli = :email, imglogo_cli = :img  WHERE id_cli = :id";
		$stmt = $PDO->prepare($sql);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':img', $novoNome);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		 
		if ($stmt->execute()){
		      echo "<script>
	          alert('Cadastro atualizado com sucesso!');
	          window.history.back()
			  </script>";
	    exit;
	  }
  }

} else {

	// Se não foi enviado nenhum arquivo, apenas atualiza info de cadastro no BD, menos a senha.
	$PDO = db_connect();
	$sql = "UPDATE tbl_cliente SET nome_cli = :name, email_cli = :email  WHERE id_cli = :id";
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
    
    }

}