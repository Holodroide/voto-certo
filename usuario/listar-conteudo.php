<?php
session_start();
 
require_once 'init.php';
 
require 'check.php';

// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$nome = isset($_GET['nome']) ? $_GET['nome'] : null;
 
// valida o ID
if (empty($id))
{
    echo "ID para alteração não definido";
    exit;
}

// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS total FROM tbl_conteudo_usr WHERE id_usr = $id";
 
// SQL para selecionar os registros
$sql = "SELECT * FROM tbl_conteudo_usr WHERE id_usr= $id ORDER BY data_cont ASC";
 
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();
//$usrName = $stmt->fetch(PDO::FETCH_ASSOC)
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
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;color:#ECB71B;">
            <img src="https://holodroide.com.br/wp-content/uploads/2018/02/cropped-logo_white.png" width="300px" height="34px"><br />
            <h3>PAINEL USUÁRIO - LISTAR</h3>
          </div>
          <div class="col-md-12" style="text-align:center;">            
              <a href="index.php" class="btn btn-danger" role="button">HOME</a> | <a href="logout.php" class="btn btn-danger">LOGOUT</a>
          </div>  
      </div>

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 20px 0;">
            Olá, <?php echo $_SESSION['user_name']; ?>!<br />
            <strong>Até agora você enviou <?php echo $total ?> textos.</strong>
          </div>
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">
            <h4>MENU</h4>
          </div>        
          <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
                <a href="painel-user.php" class="btn btn-success" role="button">LISTAR</a> | 
                <a href="form-add-user.php" class="btn btn-success" role="button">INSERIR</a>  
          </div>
      </div>  


      <?php  
       if ($total > 0):
       while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):  
      ?>

      <div class="row" style="">
          <div class="col-md-12" style="text-align:left; font-size:0.800em;">
          <div style="max-width:270px;margin:0 auto; border-bottom:1px dashed #000;padding:10px;">
            <strong>DATA: <? echo $user['data_cont'] ?> | PUBLICADO: <? echo $user['status_cont'] ?></strong><br />
            <? echo $user['text_cont'] ?>
          </div>
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
