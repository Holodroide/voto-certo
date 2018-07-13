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
 
// valida o ID
if (empty($idusr))
{
    echo "ID para alteração não definido";
    exit;
}
 
// busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT nome_usr, email_usr, id_cli FROM tbl_usr WHERE id_usr = :idusr";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idusr', $idusr, PDO::PARAM_INT);
 
$stmt->execute();
 
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$idcli = $user['id_cli'];
 
// se o método fetch() não retornar um array, significa que o ID não corresponde a um usuário válido
if (!is_array($user))
{
    echo "Nenhum usuário encontrado";
    exit;
}

include "include/header.php"; 
?>
    <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5cb85c;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>ALTERAR CADASTRO USUÁRIO</strong></h4>
          </div>          
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #5cb85c;">
            <h5>Altere os dados desejados em clique no botão "<strong>ALTERAR</strong>"</h5>
          </div>
      </div> 

      <form action="usr-edit.php"  method="post" name="form-user" id="form-user">
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>NOME</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="nome_usr" type="text" id="nome_usr" size="50" value="<?php echo $user['nome_usr'] ?>" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>EMAIL</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="email_usr" type="text" id="email_usr" size="50" value="<?php echo $user['email_usr'] ?>" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>CLIENTE</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        

              <?php

              $PDO = db_connect();

              // SQL para selecionar os registros
              $sql = "SELECT * FROM tbl_cli WHERE id_cli = $idcli";
              $stmt = $PDO->prepare($sql);
              $stmt->execute();
              $user = $stmt->fetch(PDO::FETCH_ASSOC);

              echo $user['nome_cli'];

              ?>
              <p style="font-size:0.800em;"><br>
              Obs: O cliente associado ao usuário não pode ser trocado, pois<br>
              todo o conteúdo do usuário está relacionado ao cliente. A única opção<br>
              é deletar e criar um novo usuário.</p>
          </div>          
      </div>        

      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;"> 
            <br/><br/>
            <input type="hidden" name="idusr" value="<?php echo $idusr ?>">       
            <input type="button" name="button" id="button" class="btn btn-default" value="CANCELAR" onclick="window.history.back()" style="color:#ff0000;background-color:#ccc;" />           
            <input type="submit" name="button" id="button"  class="btn btn-success"  value="ALTERAR" />
          </div>          
      </div>  
      </form>
    </div> 
      <?php
     include "include/footer.php"; 
     ?>
    </body>
</html>