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
$sql_count = "SELECT COUNT(*) AS total FROM tbl_conteudo_usr WHERE id_cli = $id";
 
// SQL para selecionar os registros
$sql = "SELECT * FROM tbl_usuario inner join tbl_conteudo_usr on tbl_usuario.id_usr = tbl_conteudo_usr.id_usr WHERE tbl_usuario.id_cli = $id AND tbl_conteudo_usr.id_cli = $id ORDER BY tbl_conteudo_usr.data_cont DESC";

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
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">
            <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" width="300px" height="34px"><br />
            <h3>APROVAÇÃO DE CONTEÚDO - CLIENTE</h3>
          </div>
          <div class="col-md-12" style="text-align:center;"> 
              <a href="index.php" class="btn btn-danger" role="button">HOME</a> |            
              <a href="painel-cli.php" class="btn btn-warning" role="button">LISTAR</a> | 
              <a href="form-add-cli.php" class="btn btn-warning" role="button">INSERIR</a> |   
              <a href="logout.php" class="btn btn-danger">LOGOUT</a>
          </div>  
      </div>

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 20px 0;">
            Olá, <?php echo $_SESSION['admin_name']; ?>!<br />
            <strong>Total de registros para <?php echo $_GET['nome']; ?>: <?php echo $total ?></strong>
          </div>

      </div>  

      <div class="row" style="border-bottom:1px dashed #000;padding:10px;">
          <div class="col-md-2" style="text-align:left;">
            <strong>DATA</strong>
          </div>  
          <div class="col-md-2" style="text-align:left;">
            <strong>USUÁRIO</strong>
          </div>                    
          <div class="col-md-6" style="text-align:left;">
            <strong>CONTEÚDO</strong>
          </div>
          <div class="col-md-2" style="text-align:left;">
            <strong>STATUS</strong>
          </div>          
      </div>  

      <?php  
       if ($total > 0):
       while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):  
      ?>

      <div class="row" style="border-bottom:1px dashed #000;padding:10px;">
          <div class="col-md-2" style="text-align:left;">
            <? echo $user['data_cont'] ?>
          </div>  
          <div class="col-md-2" style="text-align:left;">
            <? echo $user['nome_usr'] ?><br />
            <? echo $user['email_usr'] ?>
          </div>                
          <div class="col-md-6" style="text-align:left;">

                <?php
                if ($user['tipo_cont'] == 'txt'){

                  echo $user['text_cont'];

                }elseif ($user['tipo_cont'] == 'img'){

                  echo '<img src="http://holodroide.com/sistema/uploaders/foto/'.$user['text_cont'].'" width="270px">';

                }else{

                echo '<video width="270" controls="controls">';
                echo '<source src="'.$user['text_cont'].'" type="video/mp4">';
                echo '<object data="" width="270">';
                echo '<embed width="270" src="'.$user['text_cont'].'">';
                echo '</object>';

                }
                ?>
                
          </div>
          <div class="col-md-2" style="text-align:left;">
            <?php
              if ($user['status_cont'] == 'N') {
                echo '<a href="#" class="btn btn-success" role="button">PUBLICAR</a>';
              } else {
                  echo '<a href="#" class="btn btn-warning" role="button">REMOVER</a>';
              }
            ?>  
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
