<!doctype html>
<html>
    <head>

        <title>Holodroide - CLIENTE</title>        

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
                <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;color:#ff0000;">
                    <img src="https://holodroide.com.br/wp-content/uploads/2018/02/cropped-logo_white.png" width="300px" height="34px"><br />
                    <h3>LOGIN CLIENTE</h3>
                </div>
            </div>
 
             <div class="row">
                <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;">
                    <form action="login-cli.php" method="post">
                        <label for="email">Email: </label>
                        <br>
                        <input type="text" name="email" id="email">
             
                        <br><br>
             
                        <label for="password">Senha: </label>
                        <br>
                        <input type="password" name="password" id="password">
             
                        <br><br>
             
                        <input type="submit" value="Entrar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>        
 
    </body>
</html>