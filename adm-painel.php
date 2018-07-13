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
header( 'Pragma: no-cache' );

// Abre a conexão com MySql
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS total FROM tbl_adm";
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// Executa query para selecionar os registros
$sql = "SELECT id_adm, nome_adm, email_adm, senha_adm FROM tbl_adm ORDER BY nome_adm ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();

include "include/header.php"; 
?>

    <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5bc0de;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>LISTAR ADMINISTRADORES</strong></h4>
          </div>        
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #5bc0de;">
            <h5 style="margin-top: 5px; margin-bottom: 5px;">Total de administradores cadastrados: <strong><?php echo $total ?></strong></h5>
          </div>
      </div>  

      <?php  
       // Se a variável $total for maior que 0 (ou seja, NÃO vazio), executa o loop com array $user
       if ($total > 0):
       while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):  
      ?>

      <div class="row" style="border-bottom:1px dashed #000;padding:10px;">
         
          <div class="col-md-2" style="text-align:right;">
            <a href="adm-edit-form.php?idadm=<?php echo $user['id_adm'] ?>" class="btn btn-success" style="width:150px;margin:2px;" role="button">ALTERAR</a>
            <a href="adm-pw-form.php?idadm=<?php echo $user['id_adm'] ?>" class="btn btn-warning" style="width:150px;margin:5px;" role="button">ALTERAR SENHA</a>  
            <a href="adm-delete.php?idadm=<?php echo $user['id_adm'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-danger" style="width:150px;margin:5px;" role="button">EXCLUIR</a>  
            
          </div>        
          <div class="col-md-10" style="text-align:left;">
            <strong>ID:</strong> <? echo $user['id_adm'] ?><br />
            <strong>NOME:</strong> <? echo $user['nome_adm'] ?><br />
            <strong>EMAIL:</strong> <? echo $user['email_adm'] ?><br />
          </div>
      </div>  

      <?php
       endwhile;

       // Se $ total for vazio, exibe mensagem.
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
