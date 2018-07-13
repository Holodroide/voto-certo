<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 
 
// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$idcli = $_SESSION['cli_id'];
 
// valida o ID
if (empty($id))
{
    echo "ID para alteração não definido";
    exit;
}
 
// busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT nome_usr, email_usr FROM tbl_usuario WHERE id_usr = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
 
$stmt->execute();
 
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// se o método fetch() não retornar um array, significa que o ID não corresponde a um usuário válido
if (!is_array($user))
{
    echo "Nenhum usuário encontrado";
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

      <title>HOLODROIDE - USUÁRIO ADMIN</title>        

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

     <div class="container" style="margin-bottom:200px;">
      <div class="row" style="margin:50px 0 50px 0;">
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">
            <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" width="300px" height="34px"><br />
            <h3>ALTERAR CADASTRO - USUÁRIO</h3>
          </div>
          <div class="col-md-12" style="text-align:center;">            
                <a href="index.php" class="btn btn-danger">HOME</a>                
                <a href="painel-user.php?idcli=<? echo $idcli ?>" class="btn btn-success" role="button">LISTAR USUÁRIOS</a> | 
                <a href="#" class="btn btn-success" role="button">INSERIR USUÁRIO</a> | 
                <a href="logout.php" class="btn btn-danger">LOGOUT</a>
          </div>  
      </div>

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
            <?php echo $_SESSION['cli_name']; ?><br>Altere os dados desejados.
          </div>
      </div> 

      <form action="edit-user.php"  method="post" name="form-user" id="form-user">
      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            NOME:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input name="nome_usr" type="text" id="nome_usr" size="65" value="<?php echo $user['nome_usr'] ?>">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            EMAIL:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input name="email_usr" type="text" id="email_usr" size="65" value="<?php echo $user['email_usr'] ?>">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-2" style="text-align:right;">        

          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;"> 
            <br/><br/>
            <input type="hidden" name="id" value="<?php echo $id ?>">       
            <input type="submit" name="button" id="button"  class="btn btn-success" value="ALTERAR" />
          </div>          
      </div>  
      </form>
    </div> 
 
    </body>
</html>