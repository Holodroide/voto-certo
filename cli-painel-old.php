<?php
session_start();
 
require_once 'init.php';
 
require 'check.php';

// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS total FROM tbl_cliente";
 
// SQL para selecionar os registros
$sql = "SELECT id_cli, nome_cli, email_cli, senha_cli, imglogo_cli, tipo_txt, tipo_img, tipo_vid FROM tbl_cliente ORDER BY nome_cli ASC";
 
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


      <script>

var tipoCont ='vid';            

/*function contTeste(tipo) {
var tipoCont = tipo;

alert("Clicou!");
}*/
      </script>




  </head>

  <body>

     <div class="container" style="margin-bottom:200px;">
      <div class="row" style="margin:50px 0 50px 0;">
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">
            <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" width="300px" height="34px"><br />
            <h3>LISTAR CLIENTES</h3>
          </div>
          <div class="col-md-12" style="text-align:center;"> 
              <a href="index.php" class="btn btn-danger" role="button">HOME</a> |                      
              <a href="#" class="btn" role="button">LISTAR</a> | 
              <a href="form-add-cli.php" class="btn btn-warning" role="button">INSERIR</a> | 
              <a href="logout.php" class="btn btn-danger">LOGOUT</a>             
          </div>  
      </div>

      <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
            Olá, <?php echo $_SESSION['admin_name']; ?>!<br />
            <strong>Total de clientes cadastrados: <?php echo $total ?></strong>
          </div>
      
      </div>  


      <?php  
       if ($total > 0):
       while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):  
      ?>

      <div class="row" style="border-bottom:1px dashed #000;padding:10px;">


          <div class="col-md-2" style="text-align:right;">
            <a href="form-edit-cli.php?id=<?php echo $user['id_cli'] ?>" class="btn btn-warning" style="width:150px;margin:5px;" role="button">ALTERAR</a>
            <a href="delete-cli.php?id=<?php echo $user['id_cli'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-warning" style="width:150px;margin:5px;" role="button">EXCLUIR</a>  
            <a href="form-pw-cli.php?id=<?php echo $user['id_cli'] ?>" class="btn btn-warning" style="width:150px;margin:5px;" role="button">ALTERAR SENHA</a>  
            <a href="relatorio-conteudo-cli.php?id=<?php echo $user['id_cli'] ?>&nome=<?php echo $user['nome_cli'] ?>" class="btn btn-warning" style="width:150px;margin:5px;" role="button">CONTEÚDO</a>                          

            <!-- a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $user['id_cli'] ?>" style="width:150px;margin:5px;" role="button">URL TXT</a>

            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $user['id_cli'] ?>" style="width:150px;margin:5px;" role="button">URL IMG</a>            

            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $user['id_cli'] ?>" style="width:150px;margin:5px;" role="button">URL VID</a -->                                    


          <?php
          $id = $user['id_cli'];
         // $sql_count = "SELECT tipo_cont FROM tbl_conteudo_usr WHERE id_cli = $id";

          // conta o toal de registros
        //  $stmt_count = $PDO->prepare($sql_count);
        //  $stmt_count->execute();
       //   $result = $stmt_count->fetchColumn();

          if($user['tipo_txt'] !== null){ 
            echo '<script language="JavaScript">';
            echo 'var x = 0';
            echo 'function contTeste() {';
            echo 'var tipoCont = x';
                        echo 'alert(tipoCont);';
            echo '}';
            echo '</script>';             
            echo '<a href="#" onclick="x=txt;contTeste();" class="btn btn-warning" data-toggle="modal" data-target="#myModal'.$id.'" style="width:150px;margin:5px;" role="button">URL TXT</a>';

          }

          if($user['tipo_img'] !== null){ 
            echo '<script language="JavaScript">';
            echo 'var x = 0';
            echo 'function contTeste() {';
            echo 'var tipoCont = x';
                                    echo 'alert(tipoCont);';
            echo '}';
            echo '</script>';             
            echo '<a href="#" onclick="x=txt;contTeste();"class="btn btn-warning" data-toggle="modal" data-target="#myModal'.$id.'" style="width:150px;margin:5px;" role="button">URL IMG</a>';           
          }

          if($user['tipo_vid'] !== null){ 
            $vid = 'vid';
//echo '<a href="#" onclick="contTeste('.$vid.');" class="btn btn-warning" style="width:150px;margin:5px;" role="button">URL VID</a>';
            echo '<a href="#" onclick="x=txt;contTeste();" class="btn btn-warning" data-toggle="modal" data-target="#myModal'.$id.'" style="width:150px;margin:5px;" role="button">URL VID</a>';
          }
         
          ?>



          </div>  


        

          <div class="col-md-6" style="text-align:left;">
            <strong>ID:</strong> <? echo $user['id_cli'] ?><br />
            <strong>CLIENTE:</strong> <? echo $user['nome_cli'] ?><br />
            <strong>EMAIL:</strong> <? echo $user['email_cli'] ?><br />
          </div>
          <div class="col-md-4" style="text-align:left;">
            <strong>ARQUIVO LOGO:</strong> <? echo $user['imglogo_cli'] ?><br />
            <img src="http://holodroide.com/sistema/arquivos/<? echo $user['imglogo_cli'] ?>">
          </div> 
      </div>  

      <div class="row">   
        <!-- Modal -->
        <div id="myModal<?php echo $user['id_cli'] ?>" class="modal fade" role="dialog">
          <div class="modal-dialog  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">HOLODROIDE - <?php echo $user['nome_cli'] ?></h4>
              </div>
              <div class="modal-body">
                <div  style="background-image: url('image/fundo-app.png');width:860px;height:535px;padding:0;margin:0 auto;">
                  <div style="width:300px;height:300px; float:right;background-color:#000;position:relative;top:50px;right:73px;">
                    <div style="position: relative;top: 50%;transform: translateY(-50%);">
                      <?php

               
                      $id_teste = $user['id_cli'];
                     // $tipoCont = "<script>document.write(tipoCont)</script>";
                                            $tipo = 'vid';

                      // SQL para selecionar os registros
                      $sqlCont = "SELECT id_cont, id_cli, text_cont, tipo_cont FROM tbl_conteudo_usr WHERE id_cli = $id_teste AND tipo_cont = $tipo ORDER BY id_cont DESC LIMIT 1";
                       
                      // seleciona os registros
                      $stmtCont = $PDO->prepare($sqlCont);
                      $stmtCont->execute();

                      $userCont = $stmtCont->fetch(PDO::FETCH_ASSOC);


                      $conteudo = $userCont['text_cont'];
                      if(!empty($conteudo)){ 

                            if ($userCont['tipo_cont'] == 'txt'){

                              echo $userCont['text_cont'];

                            }elseif ($userCont['tipo_cont'] == 'img'){

                              echo '<img src="http://holodroide.com/sistema/uploaders/foto/'.$userCont['text_cont'].'" width="300px">';

                            }else{

                              echo '<video width="300" controls="controls" >';
                              echo '<source src="'.$userCont['text_cont'].'" type="video/mp4">';
                              echo '<object data="" width="300">';
                              echo '<embed width="300" src="'.$userCont['text_cont'].'">';
                              echo '</object>';

                            }
                          }
                      ?>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <b>URL PARA VuMark:</b> <?php echo $userCont['text_cont']; ?>//Tipo:  <?php echo $tipo; ?>
                </div>
              </div>
            </div>
        </div> 
      </div>          
    </div>

    <!-- ############## FIM MODAL ############ -->  

      <?php
       endwhile;
       else:
      ?>
       <div class="row">
          <div class="col-md-12" style="text-align:left;">
            <p>Nenhum administrador registrado.</p>
          </div>
      </div>  
 
      <?php endif; ?>

    </div>


</body>
</html>
