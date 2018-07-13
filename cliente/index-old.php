<?php
session_start();
 
require '../init.php';
?>
<!doctype html>
<html>
    <head>

        <title>Holodroide - CLIENTES</title>        

        <meta charset="utf-8">

        <!-- ===================== Mobile Specific ============================= -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 
        <!-- ==================== BootStrap ====================== -->   
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>        
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

     </head>
 
    <body>
         <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;">
                    <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" width="300px" height="34px"><br />
                    <h3>LOGIN CLIENTE</h3>
                </div>
            </div>

            <?php if (isLoggedIn()): ?>  
                      
            <div class="row">
                <div class="col-md-12" style="text-align:center;;margin:30px 0 30px 0;">
                    <p>Olá, <?php echo $_SESSION['user_name']; ?>.</p>
                </div>
                <div class="col-md-12" style="text-align:center;">            
                    <a href="painel-cli.php" class="btn btn-danger" role="button">Painel</a> | <a href="logout.php" class="btn btn-danger">Sair</a>
                </div>                
            </div>

            <?php else: ?>

            <div class="row">
                <div class="col-md-12" style="text-align:center;;margin:30px 0 30px 0;">
                    <p>Olá, visitante.</p>
                </div>
                <div class="col-md-12" style="text-align:center;">            
                    <a href="form-login-cli.php" class="btn btn-danger">Login</a>
                </div>    
            </div>

            <?php endif; ?>

        </div>
 
    </body>
</html>