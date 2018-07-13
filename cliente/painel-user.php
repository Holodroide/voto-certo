<?php
session_start();
 
require_once 'init.php';
 
require 'check.php';
// pega o ID da URL
//$idcli = isset($_GET['idcli']) ? (int) $_GET['idcli'] : null;
$idcli = $_SESSION['cli_id'];
// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS total FROM tbl_usuario  WHERE id_cli = $idcli";
 
// SQL para selecionar os registros
//$sql = "SELECT id_usr, nome_usr, email_usr, senha_usr FROM tbl_usuario ORDER BY nome_usr ASC";


$sql = "SELECT * FROM tbl_usuario  WHERE id_cli = $idcli";

 
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();
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

  <body>

     <div class="container" style="margin-bottom:200px;">
      <div class="row" style="margin:50px 0 50px 0;">
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">
            <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" width="300px" height="34px"><br />
            <h3>LISTAR USUÁRIOS</h3>
          </div>
          <div class="col-md-12" style="text-align:center;">            
                <a href="index.php" class="btn btn-danger">HOME</a>                
                <a href="painel-user.php?idcli=<? echo $idcli ?>" class="btn" role="button">LISTAR USUÁRIOS</a> | 
                <a href="form-add-user.php?idcli=<? echo $idcli ?>" class="btn btn-success" role="button">INSERIR USUÁRIO</a> | 
                <a href="logout.php" class="btn btn-danger">LOGOUT</a>
          </div>  
      </div>

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
            <?php echo $_SESSION['cli_name']; ?><br />
            <strong>Total de usuários cadastrados: <?php echo $total ?></strong>
          </div>
      </div>  


      <?php  
       if ($total > 0):
       while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):  
      ?>

      <div class="row" style="border-bottom:1px dashed #000;padding:10px;">
          <div class="col-md-2" style="text-align:right;">
            <a href="form-edit-user.php?id=<?php echo $user['id_usr'] ?>" class="btn btn-success" style="width:150px;margin:5px;" role="button">ALTERAR</a>
            <a href="delete-user.php?id=<?php echo $user['id_usr'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-success" style="width:150px;margin:5px;" role="button">EXCLUIR</a>  
            <a href="form-pw-user.php?id=<?php echo $user['id_usr'] ?>" class="btn btn-success" style="width:150px;margin:5px;" role="button">ALTERAR SENHA</a>  
            <a href="relatorio-conteudo.php?id=<?php echo $user['id_usr'] ?>&nome=<?php echo $user['nome_usr'] ?>" class="btn btn-success" style="width:150px;margin:5px;" role="button">CONTEÚDO</a>              
          </div>        
          <div class="col-md-10" style="text-align:left;">
            <strong>ID:</strong> <? echo $user['id_usr'] ?><br />
            <strong>NOME:</strong> <? echo $user['nome_usr'] ?><br />
            <strong>EMAIL:</strong> <? echo $user['email_usr'] ?><br />
            <strong>CLIENTE:</strong> <? echo $_SESSION['cli_name'] ?><br />            
          </div>
      </div>  

      <?php
       endwhile;
       else:
      ?>
 
       <div class="row">
          <div class="col-md-12" style="text-align:left;">
            <p>Nenhum usuário registrado.</p>
          </div>
      </div>  
 
      <?php endif; ?>

    </div>

</body>
</html>
