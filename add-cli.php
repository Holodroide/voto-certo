<?php
 
require_once 'init.php';
 
// pega os dados do formuário
$name = isset($_POST['nome_cli']) ? $_POST['nome_cli'] : null;
$email = isset($_POST['email_cli']) ? $_POST['email_cli'] : null;
$senha = isset($_POST['senha_cli']) ? $_POST['senha_cli'] : null;
$tipo_txt = isset($_POST['tipo_txt']) ? $_POST['tipo_txt'] : null;
$tipo_img = isset($_POST['tipo_img']) ? $_POST['tipo_img'] : null;
$tipo_vid = isset($_POST['tipo_vid']) ? $_POST['tipo_vid'] : null;
 
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


			 
			$redirCli = uniqid().'.php';
			$nameNoSpc   =   retiraAcentos(utf8_decode($name));
			$NomeTxt = $nameNoSpc.'-txt-'.$redirCli;
			$NomeImg = $nameNoSpc.'-img-'.$redirCli;
			$NomeVid = $nameNoSpc.'-vid-'.$redirCli;
			
			$text = "";

			$file = fopen('arquivos/'.$NomeTxt, 'a');
			fwrite($file, $text);
			fclose($file);

			$file = fopen('arquivos/'.$NomeImg, 'a');
			fwrite($file, $text);
			fclose($file);

			$file = fopen('arquivos/'.$NomeVid, 'a');
			fwrite($file, $text);
			fclose($file);


			//Insere todas as informações no BD
			$PDO = db_connect();
			$sql = "INSERT INTO tbl_cliente(nome_cli, email_cli, senha_cli, imglogo_cli, tipo_txt, tipo_img, tipo_vid, redir_cli) VALUES(:name, :email, :senha, :img, :tipotxt, :tipoimg, :tipovid, :redircli)";
			$stmt = $PDO->prepare($sql);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':senha', $passwordHash);
			$stmt->bindParam(':img', $novoNome);
			$stmt->bindParam(':tipotxt', $tipo_txt);			
			$stmt->bindParam(':tipoimg', $tipo_img);			
			$stmt->bindParam(':tipovid', $tipo_vid);		
			$stmt->bindParam(':redircli', $redirCli);		
			 
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
