<?php
session_start();

// Inclui conexão com BR MySql
// Confere se usuário  está logado (Administrador, Cliente ou Usuário)
// Fas o Hash de senha 
require_once 'include/init.php';

// Faz a validação da sessão do cliente e atribui TRUE ou FALSE na variável
// Se TRUE, exibe menu. Se FALSE, exibe formulário de login
require 'include/check.php';

header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );

$idcli = isset($_GET['idcli']) ? $_GET['idcli'] : null;


// Abre a conexão
$PDO = db_connect();
 
// Uso da função COUNT do SQL para contar o total de registros
$sql_count = "SELECT COUNT(*) AS total FROM tbl_cli";
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();

// Define variável com array gerado pela query
$total = $stmt_count->fetchColumn();
 
// Sql query para selecionar os registros na tabela
$sql = "SELECT id_cli, empresa_cli, nome_cli, email_cli, senha_cli, imglogo_cli, tipo_txt, tipo_img, tipo_vid, redir_cli, usr_cli FROM tbl_cli ORDER BY nome_cli ASC";
$stmt1 = $PDO->prepare($sql);
$stmt1->execute();

include "include/header.php"; 
?>

    <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5bc0de;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>LISTAR CLIENTES</strong></h4>
          </div>        
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #5bc0de;">
            TOTAL DE CLIENTES CADASTRADOS: <strong><?php echo $total ?></strong>
          </div>
      </div>  
      <br><br>
      <?php
       // Se a variável $total for maior que 0  
       if ($total > 0):
       // Loop para os registros da query com array $user 
       while ($user = $stmt1->fetch(PDO::FETCH_ASSOC)):  
      ?>


      <div class="row" style="border-top:1px dashed #000;padding:10px;">
         
          <!-- Menu lateral / Botões -->
          <div class="col-md-2" style="text-align:center;">
            <img src="http://holodroide.com/sistema/cliente/arquivos/<? echo $user['imglogo_cli'] ?>" width="100"><br><br>
            <a href="cli-edit-form.php?idcli=<?php echo $user['id_cli'] ?>" class="btn btn-success" style="width:150px;margin:2px;" role="button">ALTERAR</a>
            <a href="cli-pw-form.php?idcli=<?php echo $user['id_cli'] ?>" class="btn btn-warning" style="width:150px;margin:2px;" role="button">ALTERAR SENHA</a> 
            <a href="cli-usr-painel.php?idcli=<?php echo $user['id_cli'] ?>" class="btn btn-info" style="width:150px;margin:2px;" role="button">LISTAR USUÁRIOS</a> 
            <a href="cli-delete.php?idcli=<?php echo $user['id_cli'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-danger" style="width:150px;margin:2px;" role="button">EXCLUIR</a>              
            
            <!-- <a href="cli-relatorio-conteudo.php?idcli=<?php echo $user['id_cli'] ?>&nomecli=<?php echo $user['nome_cli'] ?>" class="btn btn-info" style="width:150px;margin:5px;" role="button">CONTEÚDO</a> -->                          
          </div>  

      
          <!-- Informações do cliente -->
          <div class="col-md-10" style="text-align:left;">
            
            <strong>ID:</strong> <? echo $user['id_cli'] ?><br />
            <strong>EMPRESA:</strong> <? echo $user['empresa_cli'] ?><br />            
            <strong>USUÁRIO:</strong> <? echo $user['nome_cli'] ?><br />
            <strong>EMAIL:</strong> <? echo $user['email_cli'] ?><br />
            <strong>ARQUIVO LOGO:</strong> <? echo $user['imglogo_cli'] ?>
            <br /><br>
            <strong>REDIRECT</strong><br>

          <?php
          $sql1 = "SELECT * FROM tbl_usr WHERE id_usr = :usrcli";
          $stmt = $PDO->prepare($sql1);
          $stmt->bindParam(':usrcli', $user['usr_cli'], PDO::PARAM_INT);
          $stmt->execute();          
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // Monta a url de redirect 
            $nome = $result['nome_usr'];     
            $nameNoSpc = retiraAcentos(utf8_decode($nome));

          
          // Condicionais para exibir apenas os redirect configurados para o cliente
          if($user['tipo_txt'] !== null){ 

            $NomeTxt = $nameNoSpc.'-txt-'.$result['redir_usr'];
            echo '<img src="image/ico-txt.png"> 
            <a href="https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'" target="_new" style="font-size:0.750em;"> 
            https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'</a><br>';
          }

          if($user['tipo_img'] !== null){ 
            $NomeTxt = $nameNoSpc.'-img-'.$result['redir_usr'];
            echo '<img src="image/ico-img.png"> 
            <a href="https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'" target="_new" style="font-size:0.750em;"> 
            https://www.holodroide.com/sistema/uploaders/redirect/'.$NomeTxt.'</a><br>';
          }

          if($user['tipo_vid'] !== null){ 
            $NomeTxt = $nameNoSpc.'-vid-'.$result['redir_usr'];
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
       <div class="row">
          <div class="col-md-12" style="text-align:left;">
            <p>Nenhum administrador registrado.</p>
          </div>
      </div>  
 
      <?php endif; ?>

    </div>
     <?php
     include "include/footer.php"; 
     ?>

</body>
</html>
