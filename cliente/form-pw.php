<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 
 
// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
 
// valida o ID
if (empty($id))
{
    echo "ID para alteração não definido";
    exit;
}
 
// busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT dsc_nom_admin, dsc_email_admin, dsc_senha_admin FROM tbl_admin WHERE id_admin = :id";
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

      <title>Holodroide Login - ADMIN</title>        

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

     <div class="container" style="margin-bottom:200px;">
      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;">
              <h3>HOLODROIDE<br />PAINEL ADMINISTRAÇÃO<br />ALTERAR SENHA</h3>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
            <?php echo $_SESSION['user_name']; ?>, digite a nova senha.
          </div>
      </div>     

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
            <a href="painel.php" class="btn btn-primary" role="button">LISTAR</a> | 
            <a href="form-add.php" class="btn btn-primary" role="button">INSERIR</a> | 
            <a href="logout.php" class="btn btn-primary" role="button">LOGOUT</a>
          </div>
      </div>  


      <form action="newpw.php" method="post" name="form1" id="form1">
      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            NOME:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <?php echo $user['dsc_nom_admin'] ?>
          </div>          
      </div>          
      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            NOVA SENHA:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input name="dsc_senha_admin" type="text" id="dsc_senha_admin" size="65" value="">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-2" style="text-align:right;">        

          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;"> 
            <input type="hidden" name="id" value="<?php echo $id ?>">       
            <input type="submit" name="button" id="button"  class="btn btn-danger" value="ALTERAR SENHA" />
          </div>          
      </div>  
      </form>
    </div> 
 
    </body>
</html>