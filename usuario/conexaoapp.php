<?php
	$conn = mysql_connect('localhost', 'root', '') or die('Erro ao conectar no MySQL');
	$banco = mysql_select_db('loginsystem') or die('Erro ao selecionar Banco de Dados');
?>