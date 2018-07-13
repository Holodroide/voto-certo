HOLODROIDE - APP

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Celke - ADM</title>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<meta name="google-signin-client_id" content="299120802998-evcs4l967da28bb128oki364hfuasjvd.apps.googleusercontent.com">
    </head>
    <body>
		HOLODROIDE - APP<br><br>

		Bem vindo <?php echo $_SESSION['userName']; ?>!<br><br>
		
		<a href="login.php" onclick="signOut();">Sair</a>
		<script>
		  function signOut() {
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
			  console.log('User signed out.');
			                window.location.href = 'index.php';
			});
		  }
		</script>
		
    </body>
</html>