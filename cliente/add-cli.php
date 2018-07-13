<?php
 
require_once '../init.php';
 
// pega os dados do formuário
$name = isset($_POST['nome_cli']) ? $_POST['nome_cli'] : null;
$email = isset($_POST['email_cli']) ? $_POST['email_cli'] : null;
$senha = isset($_POST['senha_cli']) ? $_POST['senha_cli'] : null;

 
// validação (bem simples, só pra evitar dados vazios)
if (empty($name) || empty($email) || empty($senha))
{
		echo '<script type="text/javascript">
		alert("Volte e preencha todos os campos.");
		window.history.back()
        </script>';
        exit;
}

// cria o hash da senha
$passwordHash = make_hash($senha);

$largura = 300; //300px
$altura = 300; //300px
$tamanho = 100000; //1Mb

$arquivo = $_FILES['imglogo_cli'];

//Define o diretório de destino do arquivo
define('DEST_DIR', __DIR__ . '/arquivos');

	if (isset($_FILES['imglogo_cli']) && !empty($_FILES['imglogo_cli']['name'])){
	// se o "name" estiver vazio, é porque nenhum arquivo foi enviado
     
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

		//Caso não ocorra nehum erro, gera nome único para o arquivo
		// pega a extensão do arquivo
	    $ext = explode('.', $arquivo['name']);
	    $ext = end($ext);
	 
	    // gera o novo nome
	    $novoNome = uniqid() . '.' . $ext;

	    if (!move_uploaded_file($arquivo['tmp_name'], DEST_DIR . '/' . $novoNome)){

	        echo '<script type="text/javascript">
	        alert("Erro no upload. O cadastro não foi feito.");
			window.history.back()
	        </script>';
	        exit;

	    }else{

			//Insere todas as informações no BD
			$PDO = db_connect();
			$sql = "INSERT INTO tbl_cliente(nome_cli, email_cli, senha_cli, imglogo_cli) VALUES(:name, :email, :senha, :img)";
			$stmt = $PDO->prepare($sql);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':senha', $passwordHash);
			$stmt->bindParam(':img', $novoNome);
			 
			if ($stmt->execute()){

			    header('Location: painel-cli.php');

			}else{

			    echo "Erro ao cadastrar";
			    print_r($stmt->errorInfo());

			}
		}

	}else{

		echo '<script type="text/javascript">
		alert("Escolha um arquivo para upload.");
		window.history.back()
        </script>';
        exit;

	}
