<?php
session_start();
 
require_once '../init.php';
 
require '../check.php'; 
 
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
$sql = "SELECT nome_cli, email_cli, senha_cli, imglogo_cli FROM tbl_cliente WHERE id_cli = :id";
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

      <title>HOLODROIDE - CLIENTE ADMIN</title>        

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
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;color:#ECB71B;">
            <img src="https://holodroide.com.br/wp-content/uploads/2018/02/cropped-logo_white.png" width="300px" height="34px"><br />
            <h3>PAINEL CLIENTES - ALTERAR</h3>
          </div>
          <div class="col-md-12" style="text-align:center;">            
              <a href="../index.php" class="btn btn-danger" role="button">HOME</a> | <a href="../logout.php" class="btn btn-danger">LOGOUT</a>
          </div>  
      </div>

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 20px 0;">
            <?php echo $_SESSION['user_name']; ?>, altere os dados desejados.
          </div>
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">
            <h4>MENU</h4>
          </div>        
          <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
            <a href="painel-cli.php" class="btn btn-warning" role="button">LISTAR</a> | 
            <a href="form-add-cli.php" class="btn btn-warning" role="button">INSERIR</a>
          </div>
      </div> 

      <form action="edit-cli.php" method="post" name="form1" id="form1">
      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            NOME:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input name="nome_cli" type="text" id="nome_cli" size="65" value="<?php echo $user['nome_cli'] ?>">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            EMAIL:
          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;">        
            <input name="email_cli" type="text" id="email_cli" size="65" value="<?php echo $user['email_cli'] ?>">
          </div>          
      </div>  


      <div class="row">
          <div class="col-md-2" style="text-align:right;padding:5px;">        
            IMAGEM LOGO:
          </div>
          <div class="col-md-6" style="text-align:left;padding:5px;">        
            <input type="file" name="imglogo_cli">
          </div> 
          <div class="col-md-4" style="text-align:left;">
            <img src="http://holodroide.com/sistema/clientes/arquivos/<? echo $user['imglogo_cli'] ?>">
          </div>                      
      </div> 


      <div class="row">
          <div class="col-md-2" style="text-align:right;">        

          </div>
          <div class="col-md-10" style="text-align:left;padding:5px;"> 
            <input type="hidden" name="id" value="<?php echo $id ?>">       
            <input type="submit" name="button" id="button"  class="btn btn-warning" value="ALTERAR" />
          </div>          
      </div>  
      </form>
    </div> 
 
    </body>
</html>