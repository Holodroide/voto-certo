<?php
	require_once ("conexaoapp.php");
	
	$senha = md5('102030');
	
	$insere = mysql_query("INSERT INTO usuarios(login, senha, status) VALUES('fabrica', '$senha', '1')");
	
	if($insere) echo 'Cadastro realizado com sucesso';
	else echo 'Erro ao cadastrar';
?>