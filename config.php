<?php
/*
 Description:  Cadastro admin holodroide app
 Author:       DIG marketing digital / Gian Gadotti
 Author URI:   http://diglink.com.br
 Version:      1.0.0
 License:      holodroide.com.br only. IMPORTANT!
 --------------------------
Include de conexão MySql/PDO
*/

/*############## Variáveis da conexão ################*/
$host = "localhost";
$dbname = "holodroi_admin";
$user = "holodroi_admin";
$pw = "vailogo4321";



/*############## Conexão MYSQL_CONNECT ################*/

try{
$pdo=new PDO("mysql:host=".$host.";dbname=".$dbname."",$user,$pw);
}catch(PDOException $e){
	echo $e->getMessage();
}

?>