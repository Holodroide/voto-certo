<?php
session_start();

// Inclui conexão com BR MySql
// Confere se usuário  está logado (Administrador, Cliente ou Usuário)
// Faz o Hash de senha 
require_once 'include/init.php';

// Faz a validação da sessão do cliente e atribui TRUE ou FALSE na variável
// Se TRUE, exibe menu. Se FALSE, exibe formulário de login
require 'include/check.php';

header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

// pega o ID da URL
$idusr = isset($_GET['idusr']) ? (int) $_GET['idusr'] : null;
$idcli = isset($_GET['idcli']) ? (int) $_GET['idcli'] : null;
$nomeusr = isset($_GET['nomeusr']) ? $_GET['nomeusr'] : null;
$imglogo = isset($_GET['imglogo']) ? $_GET['imglogo'] : null;
$empresa = isset($_GET['empresa']) ? $_GET['empresa'] : null;
  
// valida o ID
if (empty($idusr))
{
    echo '<script type="text/javascript">
    alert("O ID NÃO FOI INFORMADO");
    window.history.back()
    </script>';

        exit;
}

// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS total FROM tbl_cnt_usr WHERE id_usr = $idusr AND id_cli = $idcli";
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();


// Sql query para selecionar os registros na tabela
$sql0 = "SELECT * FROM tbl_cli where id_cli = $idcli";
$stmt0 = $PDO->prepare($sql0);
$stmt0->execute();
$result0 = $stmt0->fetch(PDO::FETCH_ASSOC);

 
include "include/header.php"; 
?>

    <div class="container">
      <div class="row">

          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5bc0de;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>PUBLICAR CONTEÚDO USUÁRIO</strong></h4>
          </div> 
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5bc0de;">
              <strong>EMPRESA:</strong><img src="https://holodroide.com/sistema/cliente/arquivos/<? echo $result0['imglogo_cli']; ?>" style="height:40px;"> <?php echo strtoupper($result0['empresa_cli']) ?>
          </div>                   
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5bc0de;">
            <strong>USUÁRIO:</strong> <?php echo $nomeusr ?><br>
          </div>
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #5bc0de;">
            <strong>CONTEÚDOS PUBLICADOS:</strong> <?php echo $total ?>
          </div>          
      </div>  


      <?php  

      if ($total > 0){

        $sql2 = "SELECT * FROM tbl_cli  WHERE id_cli = $idcli"; 
        $stmt = $PDO->prepare($sql2);
        $stmt->execute();
        $user2 = $stmt->fetch(PDO::FETCH_ASSOC);
                    $nomecli = $user2['nome_cli'];

        if($user2['tipo_txt']){ 

          $sql1 = "SELECT * FROM tbl_cnt_usr  WHERE id_usr = $idusr AND id_cli = $idcli AND tipo_cnt = 'txt'  ORDER BY id_cnt DESC"; 
          $stmt = $PDO->prepare($sql1);
          $stmt->execute();

          ?>


            <div class="row" style="border-bottom:0px;margin-bottom:10px;background-color:#ccc;">
          <div class="col-md-12" style="text-align:center;">
                  <h3><strong>TEXTOS</strong></h3>
                </div>          
          </div>  

            <?php
            // Loop para exibir conteúdo tipo TXT
            while ($user1 = $stmt->fetch(PDO::FETCH_ASSOC)):  
            ?>

            <div class="row" style="border-bottom:1px dashed #000;padding:10px;">

                <div class="col-md-2" style="text-align:left;">

                  <?php
                    if ($user1['status_cnt'] == 'N') {
                  ?>

                      <a href="usr-pub-cnt.php?status=S&idcnt=<?php echo $user1['id_cnt'] ?>&idusr=<?php echo $user1['id_usr'] ?>&idcli=<?php echo $idcli ?>&tipocnt=<?php echo $user1['tipo_cnt'] ?>&textcnt=<?php echo$user1['text_cnt'] ?>" class="btn btn-success" style="width:150px;padding:5px;margin:2px;" role="button">PUBLICAR</a>               
                      <br><a href="usr-delete-cnt.php?idcnt=<?php echo $user1['id_cnt'] ?>&idusr=<?php echo $user1['id_usr'] ?>&idcli=<?php echo $idcli ?>&nomecli=<?php echo $nomecli ?>" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja remover?');"  style="width:150px;padding:5px;margin:2px;" role="button">DELETAR</a>                            
                    <?php
                    } else {
                     ?>
                      <a href="#" class="btn btn-primary" style="width:150px;padding:5px;margin:2px;" role="button" onclick="alertPub()">PUBLICADO</a>
                      <br><a href="#" class="btn btn-danger" style="width:150px;padding:5px;margin:2px;" role="button" onclick="alertNoDel()">DELETAR</a>                           
                   <?php
                    }
                  ?>  
                  
                </div> 

                <div class="col-md-2" style="text-align:left;">

                  <h5><? echo $user1['data_cnt'] ?></h5>

                </div>  
                   
                <div class="col-md-8" style="text-align:left;">

                  <h5><?php echo $user1['text_cnt']; ?></h5>
                      
                </div>

            </div>  
       
        <?php

          endwhile;
        }
        if($user2['tipo_img']){ 

          $sql1 = "SELECT * FROM tbl_cnt_usr  WHERE id_usr = $idusr AND id_cli = $idcli AND tipo_cnt = 'img'  ORDER BY id_cnt DESC"; 
          $stmt = $PDO->prepare($sql1);
          $stmt->execute();
        
        ?>
       
          <div class="row" style="border-bottom:0px;margin-bottom:10px;background-color:#ccc;">
          <div class="col-md-12" style="text-align:center;">
            <h3><strong>FOTOS</strong></h3>
          </div>          
      </div> 

          <?php
          // Loop para exibir conteúdo tipo TXT
          while ($user1 = $stmt->fetch(PDO::FETCH_ASSOC)):  
          ?>

          <div class="row" style="border-bottom:1px dashed #000;padding:10px;">

                <div class="col-md-2" style="text-align:left;">

                  <?php
                    if ($user1['status_cnt'] == 'N') {
                  ?>

                      <a href="usr-pub-cnt.php?status=S&idcnt=<?php echo $user1['id_cnt'] ?>&idusr=<?php echo $user1['id_usr'] ?>&idcli=<?php echo $idcli ?>&tipocnt=<?php echo $user1['tipo_cnt'] ?>&textcnt=<?php echo$user1['text_cnt'] ?>" class="btn btn-success" style="width:150px;padding:5px;margin:2px;" role="button">PUBLICAR</a>               
                      <br><a href="usr-delete-cnt.php?idcnt=<?php echo $user1['id_cnt'] ?>&idusr=<?php echo $user1['id_usr'] ?>&idcli=<?php echo $idcli ?>&nomecli=<?php echo $nomecli ?>" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja remover?');"  style="width:150px;padding:5px;margin:2px;" role="button">DELETAR</a>                            
                    <?php
                    } else {
                     ?>
                      <a href="#" class="btn btn-primary" style="width:150px;padding:5px;margin:2px;" role="button" onclick="alertPub()">PUBLICADO</a>
                      <br><a href="#" class="btn btn-danger" style="width:150px;padding:5px;margin:2px;" role="button" onclick="alertNoDel()">DELETAR</a>                           
                   <?php
                    }
                  ?>  
                  
                </div> 

              <div class="col-md-2" style="text-align:left;">
                <h5><? echo $user1['data_cnt'] ?></h5>
              </div>  
                 
              <div class="col-md-8" style="text-align:left;">

                <?php

                  echo '<img src="http://holodroide.com/sistema/uploaders/foto/fotos/'.$user1['text_cnt'].'" width="270px">';

                ?>
                    
              </div>

          </div>  

        <?php
          endwhile;
        }
        if($user2['tipo_vid']){ 

          $sql1 = "SELECT * FROM tbl_cnt_usr  WHERE id_usr = $idusr AND id_cli = $idcli AND tipo_cnt = 'vid'  ORDER BY id_cnt DESC"; 
          $stmt = $PDO->prepare($sql1);
          $stmt->execute();
          
        ?>

          <div class="row" style="border-bottom:0px;margin-bottom:10px;background-color:#ccc;">
              <div class="col-md-12" style="text-align:center;">
                <h3><strong>VÍDEOS</strong></h3>
              </div>          
          </div> 

          <?php
          // Loop para exibir conteúdo tipo TXT
          while ($user1 = $stmt->fetch(PDO::FETCH_ASSOC)):  
          ?>

          <div class="row" style="border-bottom:1px dashed #000;padding:10px;">

                <div class="col-md-2" style="text-align:left;">

                  <?php
                    if ($user1['status_cnt'] == 'N') {
                  ?>

                      <a href="usr-pub-cnt.php?status=S&idcnt=<?php echo $user1['id_cnt'] ?>&idusr=<?php echo $user1['id_usr'] ?>&idcli=<?php echo $idcli ?>&tipocnt=<?php echo $user1['tipo_cnt'] ?>&textcnt=<?php echo$user1['text_cnt'] ?>" class="btn btn-success" style="width:150px;padding:5px;margin:2px;" role="button">PUBLICAR</a>               
                      <br><a href="usr-delete-cnt.php?idcnt=<?php echo $user1['id_cnt'] ?>&idusr=<?php echo $user1['id_usr'] ?>&idcli=<?php echo $idcli ?>&nomecli=<?php echo $nomecli ?>" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja remover?');"  style="width:150px;padding:5px;margin:2px;" role="button">DELETAR</a>                            
                    <?php
                    } else {
                     ?>
                      <a href="#" class="btn btn-primary" style="width:150px;padding:5px;margin:2px;" role="button" onclick="alertPub()">PUBLICADO</a>
                      <br><a href="#" class="btn btn-danger" style="width:150px;padding:5px;margin:2px;" role="button" onclick="alertNoDel()">DELETAR</a>                           
                   <?php
                    }
                  ?>  
                  
                </div> 

              <div class="col-md-2" style="text-align:left;">
                <h5><? echo $user1['data_cnt'] ?></h5>
              </div>  
                 
              <div class="col-md-8" style="text-align:left;">

                <?php
                echo '<video width="270" controls="controls">';
                echo '<source src="https://holodroide.com/sistema/uploaders/video/converted_videos/'.$user1['text_cnt'].'" type="video/mp4">';
                echo '<object data="" width="270">';
                echo '<embed width="270" src="https://holodroide.com/sistema/uploaders/video/converted_videos/'.$user1['text_cnt'].'">';
                echo '</object>';
                ?>
                    
              </div>

          </div>  

        <?php
          endwhile;
        }
        }else{
        ?>
 
          <div class="row" style="border-bottom:1px dashed #000;padding:10px;background-color:#ccc;">
              <div class="col-md-12" style="text-align:center;">
              <h4>NENHUM CONTEÚDO REGISTRADO!</h4>
              </div>          
          </div>

          <div class="row" style="padding:10px;">
              <div class="col-md-12" style="text-align:center;">
                <input type="button" name="button" id="button" class="btn" style="background-color: #ddd;margin:2px;" value="VOLTAR" onclick="window.history.back()" />                               
              </div>          
          </div>            
 
      <?php } ?>

</div>
    </div>

  </body>
</html>
