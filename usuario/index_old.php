<?php
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );
?>

<?php
session_start();
 
require 'init.php';
$id  = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;



// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS total FROM tbl_conteudo_usr WHERE id_usr = $id";
 
// SQL para selecionar os registros
$sql_cli = "SELECT * FROM tbl_conteudo_usr WHERE id_usr= $id ORDER BY data_cont ASC";
 
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// seleciona os registros
$stmt_cli = $PDO->prepare($sql_cli);
$stmt_cli->execute();
//$usrName = $stmt->fetch(PDO::FETCH_ASSOC)



?>
<!doctype html>
<html>
    <head>

        <title>Holodroide Login - USUÁRIO</title>        

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
         <div class="container">

            <?php

            if (isLoggedIn()):

            $idCliente = $_SESSION['id_cliente'];

            // abre a conexão
            $PDO = db_connect();
             
             
            // SQL para selecionar os registros
            $sql = "SELECT imglogo_cli FROM tbl_cliente WHERE id_cli = $idCliente";
             
            // seleciona os registros
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC)

            ?>  
                      
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:30px 0 30px 0;">
                    <div style="max-width:200px;margin:0 auto;">
                        <img src="http://holodroide.com/sistema/arquivos/<? echo $user['imglogo_cli'] ?>" style="width:100%;"> 
                    </div>                   
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="text-align:center;;margin:0 0 30px 0;">
                    <p>Olá, <?php echo $_SESSION['user_name']; ?>.</p>
                    <p>O que você gostaria de fazer?</p>                    
                </div>
            </div>


          <div class="row">
            <div class="col-md-12" style="text-align:center;margin:0 0 30px 0;">
              <a href="listar-conteudo.php?id=<?php echo $id; ?>" class="btn btn-success" role="button" style="width:100%;max-width:270px;">LISTAR CONTEÚDO</a><br><br>
              <a href="../uploaders/texto/uploader_texto.php" class="btn btn-success" role="button" style="width:100%;max-width:270px;">INSERIR TEXTO</a>                  
            </div>
          </div>  



      <?php  
       if ($total > 0):
       while ($cli = $stmt_cli->fetch(PDO::FETCH_ASSOC)):  
      ?>

      <div class="row" style="">
          <div class="col-md-12" style="text-align:left; font-size:0.800em;">
          <div style="max-width:270px;margin:0 auto; border-bottom:1px dashed #000;padding:10px;">
            <strong>DATA: <? echo $cli['data_cont'] ?> | PUBLICADO: <? echo $cli['status_cont'] ?></strong><br />
            <? echo $cli['text_cont'] ?>
          </div>
          </div>
      </div>  

     

      <?php
       endwhile;
       ?>

          <div class="row">
              <div class="col-md-12" style="text-align:center;margin:30px 0 0 0;">            
                  <button type="button" class="btn" style="width:100%;max-width:270px;">HOME</button>
              </div>                
          </div>          

          <div class="row">
              <div class="col-md-12" style="text-align:center;margin:10px 0 0 0;font-size:0.800em;">            
                  <a href="logout.php" class="btn btn-danger" style="width:100%;max-width:270px;font-size:0.800em;">LOGOUT</a>
              </div>                
          </div>          


            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;">
                    <div style="max-width:250px;margin:0 auto;">
                        <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" style="width:100%;"><br /><br />

                    </div>
                    <h6>© 2018 | TODOS OS DIREITOS RESERVADOS</h6>
                </div>
            </div>          
       <?php
       else:
      ?>
 
       <div class="row">
          <div class="col-md-12" style="text-align:left;">
            <p>Você ainda não tem nenhym conteúdo publicado!</p>
          </div>
      </div> 

          <div class="row">
              <div class="col-md-12" style="text-align:center;margin:30px 0 0 0;">            
                  <a href="logout.php" class="btn btn-danger" style="width:100%;max-width:270px;font-size:0.800em;">LOGOUT</a>
              </div>                
          </div>


            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;">
                    <div style="max-width:250px;margin:0 auto;">
                        <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" style="width:100%;"><br /><br />

                    </div>
                    <h6>© 2018 | TODOS OS DIREITOS RESERVADOS</h6>
                </div>
            </div>         
 
      <?php endif; ?>


            <?php else: ?>

            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;color:#ff0000;">
                    <img src="https://holodroide.com/images/logo_holodroide_sistema.png" width="300px" height="34px"><br />
                </div>
            </div>            

             <div class="row">
                <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
                    <form action="login.php" method="post">
                        EMAIL
                        <br>
                        <input type="text" name="email" id="email" style="width:270px;">
             
                        <br><br>
             
                        SENHA
                        <br>
                        <input type="password" name="password" id="password" style="width:270px; background-color: #fff;">
             
                        <br><br>
             
                        <input type="submit" value="ENTRAR" class="btn btn-danger"  style="width:100%;max-width:270px;font-size:0.800em;">
                    </form>
                </div>
            </div>

          <div class="row">

              <div class="col-md-12" style="text-align:center;margin:30px 0 0 0;">            
                  Ainda não está cadastrado? Clique no botão abaixo e cadastre-se agora!
              </div>  

              <div class="col-md-12" style="text-align:center;margin:30px 0 0 0;">            
                  <a href="form-add-user.php" class="btn btn-danger" style="width:100%;max-width:270px;font-size:0.800em;">CADASTRAR</a>
              </div>                
          </div>            

            <?php endif; ?>


        </div>
 
    </body>
</html>