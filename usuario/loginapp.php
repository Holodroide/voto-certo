<?php
	require_once ("conexaoapp.php");
	
	$login = mysql_real_escape_string($_GET['login']);
	$senha = mysql_real_escape_string($_GET['senha']);
	$senha = md5($senha);
	
	$sql = mysql_query("SELECT * FROM usuarios WHERE login = '$login' = '$senha'");
	
	if($sql){
		$dados = mysql_num_rows($sql);
		if($dados == 1){
			echo '1';		//retorno = 1, usuario pode logar
		}else{
			echo '0';
		}
	}
	
	mysql_close($conn);
?>