<?php
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );
header( 'Location: https://www.holodroide.com/apps/videos/videos_coded/edir_macedo.mp4' );
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Vídeo | PSB</title>
</head>

<body>



<?php
/*
printf("<script>location.href='https://www.holodroide.com/apps/videos/videos_coded/edir_macedo.mp4'</script>");
*/
?>


<?php
/*
 #atribui para a váriavel $servidor o conteúdo da váriavel de ambiente $_SERVER["SERVER_NAME"], que por sua vez 
 #contém o endereço pelo qual o site foi acessado
 $servidor = &$_SERVER["SERVER_NAME"];
 
switch ($servidor) { #verifica a variavel $servidor

    case "cliente.holodroide.com.br": #se $servidor igual cliente.holodroide.com.br
     unset($servidor);  #apaga a variavel $servidor, para otimizar o uso de memória uma vez que ela não será mais usada
        header("location:https://www.holodroide.com/apps/videos/videos_coded/edir_macedo.mp4");  #e faz um redirect para https://www.holodroide.com/apps/videos/videos_coded/edir_macedo.mp4
                break;
 
    case "fornecedores.holodroide.com.br":
     unset($servidor);
        header("/fornecedores"); #redireciona para o diretorio fornecedores, dentro da raiz (/) do site
                break; 
 
    case "adm.holodroide.com.br":
     unset($servidor);
        header("location:../adm"); #direciona para a pasta adm, que esta um diretório abaixo (../) do atual
                break;
 
    case "diretoria.holodroide.com.br":
     unset($servidor);
        header("location:diretoria.html"); #direciona para o arquivo diretoria.html dentro do mesmo diretorio do arquivo atual
                break;
 
   default: #caso não seja nenhum dos endereços acima
        header("location:/"); #direciona para a raiz do site
		break;
}
*/
?>


</body>
</html>