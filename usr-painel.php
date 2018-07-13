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

// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS total FROM tbl_usr";
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// SQL para selecionar os registros
$sql = "SELECT * FROM tbl_usr inner join tbl_cli on tbl_usr.id_cli = tbl_cli.id_cli WHERE id_usr = usr_cli";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

include "include/header.php"; 
?>

    <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5bc0de;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>LISTAR USUÁRIOS</strong></h4>
          </div>        
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #5bc0de;">
            TOTAL DE USUÁRIOS CADASTRADOS: <strong><?php echo $total ?></strong>
          </div>
      </div>  

    <?php  
       if ($total > 0):
        // SQL para selecionar os registros
        $sql = "SELECT * FROM tbl_usr inner join tbl_cli on tbl_usr.id_cli = tbl_cli.id_cli WHERE tbl_cli.usr_cli != tbl_usr.id_usr ORDER BY nome_usr ASC ";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
       while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):  
      ?>

      <div class="row" style="border-top:1px dashed #000;padding:10px;">
          <div class="col-md-2" style="text-align:right;">
            <a href="usr-edit-form.php?idusr=<?php echo $user['id_usr'] ?>" class="btn btn-success" style="width:150px;margin:2px;" role="button">ALTERAR</a>
            <a href="usr-pw-form.php?idusr=<?php echo $user['id_usr'] ?>" class="btn btn-warning" style="width:150px;margin:2px;" role="button">ALTERAR SENHA</a>  
            <a href="usr-relatorio-conteudo.php?idusr=<?php echo $user['id_usr'] ?>&nomeusr=<?php echo $user['nome_usr'] ?>&idcli=<?php echo $user['id_cli'] ?>" class="btn btn-info" style="width:150px;margin:2px;" role="button">CONTEÚDO</a>              
            <a href="usr-delete.php?idusr=<?php echo $user['id_usr'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-danger" style="width:150px;margin:2px;" role="button">EXCLUIR</a>  
          </div>        
          <div class="col-md-10" style="text-align:left;">
            <strong>ID:</strong> <? echo $user['id_usr'] ?><br />
            <strong>NOME:</strong> <? echo $user['nome_usr'] ?><br />
            <strong>EMAIL:</strong> <? echo $user['email_usr'] ?><br />
            <strong>EMPRESA:</strong> <? echo $user['empresa_cli'] ?><br />  

            <br />
            <strong>REDIRECT</strong><br>
          <?php

            // Monta a url de redirect 
            $nome = $user['nome_usr'];     
            $nameNoSpc = retiraAcentos(utf8_decode($nome));
          
          // Condicionais para exibir apenas os redirect configurados para o cliente
          if($user['tipo_txt'] !== null){ 

            $NomeTxt = $nameNoSpc.'-txt-'.$user['redir_usr'];
            echo '<img src="image/ico-txt.png"> 
            <a href="https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'" target="_new" style="font-size:0.750em;"> 
            https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'</a><br>';

          }

          if($user['tipo_img'] !== null){ 
            $NomeTxt = $nameNoSpc.'-img-'.$user['redir_usr'];
            echo '<img src="image/ico-img.png"> 
            <a href="https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'" target="_new" style="font-size:0.750em;"> 
            https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'</a><br>';
          }

          if($user['tipo_vid'] !== null){ 
            $NomeTxt = $nameNoSpc.'-vid-'.$user['redir_usr'];
            echo '<img src="image/ico-vid.png"> 
            <a href="https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'" target="_new" style="font-size:0.750em;"> 
            https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'</a><br>';
          }
         
            ?>

                      
          </div>
        </div>
      <?php
       endwhile;
       else:
      ?>
 
      <div class="row" style="border-bottom:1px dashed #000;padding:10px;background-color:#ccc;">
          <div class="col-md-12" style="text-align:center;">
          <h4>NENHUM USUÁRIO REGISTRADO!</h4>
          </div>          
      </div>

      <div class="row" style="padding:10px;">
          <div class="col-md-12" style="text-align:center;">
            <input type="button" name="button" id="button" class="btn btn-info" value="VOLTAR" onclick="window.history.back()" />                               
          </div>          
      </div>   
 
      <?php endif; ?>

    </div>
     <?php
     include "include/footer.php"; 
     ?>
</body>
</html>
