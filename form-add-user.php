<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

      <title>Holodroide - USUÁRIO</title>        

      <meta charset="utf-8">

      <!-- ===================== Mobile Specific ============================= -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <!-- ==================== BootStrap ====================== -->   
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>        
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </head>

<body>

     <div class="container" style="margin-bottom:200px;">
      <div class="row" style="margin:50px 0 50px 0;">
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;color:#ECB71B;">
            <img src="https://holodroide.com.br/wp-content/uploads/2018/02/cropped-logo_white.png" width="300px" height="34px"><br />
            <h3>PAINEL USUÁRIO - INSERIR</h3>
          </div>
          <div class="col-md-12" style="text-align:center;">            
              <a href="index.php" class="btn btn-danger" role="button">HOME</a> | <a href="logout.php" class="btn btn-danger">LOGOUT</a>
          </div>  
      </div>

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 20px 0;">
            <?php echo $_SESSION['user_name']; ?>, digite os dados do novo cliente.
          </div>
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">
            <h4>MENU</h4>
          </div>        
          <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
                <a href="painel-user.php" class="btn btn-success" role="button">LISTAR</a> | 
                <a href="form-add-user.php" class="btn btn-success" role="button">INSERIR</a>  
          </div>
      </div> 

      <form action="add-user.php" method="post"  name="form-user" id="form-cli">
      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            NOME:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input name="nome_usr" type="text" id="nome_usr" size="65" value="">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            EMAIL:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input name="email_usr" type="text" id="email_usr" size="65" value="">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            SENHA:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input name="senha_usr" type="text" id="senha_usr" size="65" value="">
          </div>          
      </div>  
      
      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            CLIENTE:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <select name="cliente">
              <option value="">SELECIONE O CLIENTE</option>
              
              <?php

              $PDO = db_connect();

              // SQL para selecionar os registros
              $sql = "SELECT * FROM tbl_cliente ORDER BY nome_cli ASC";
               
               
              // seleciona os registros
              $stmt = $PDO->prepare($sql);
              $stmt->execute();
              while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):  

              echo '<option value="'. $user['id_cli'].'">'.$user['nome_cli'].'</option>';

              endwhile;
              ?>
            </select>
          </div>          
      </div> 

      <div class="row">
          <div class="col-md-2" style="text-align:right;">        

          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input type="submit" name="button" id="button"  class="btn btn-success" value="CADASTRAR" />
          </div>          
      </div>  
      </form>
    </div>

</body>
</html>
