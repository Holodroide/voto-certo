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
    echo '<script type="text/javascript">
    alert("SÉRIO?! MESMO?!\nONDE ESTÁ O ID, MAN?!!! ");
    window.history.back()
        </script>';

        exit;
}
 
// busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT nome_usr, senha_usr FROM tbl_usr WHERE id_usr = :idusr";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idusr', $idusr, PDO::PARAM_INT);
 
$stmt->execute();
 
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
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
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #f0ad4e;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>ALTERAR SENHA USUÁRIO</strong></h4>
          </div>          
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #f0ad4e;">
            <h5>Informe a nova senha e clique no botão "<strong>LTERAR SENHA</strong>"</h5>
          </div>
      </div> 


      <form action="usr-pw-new.php" method="post" name="form1" id="form1">
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
           <strong>NOME</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <?php echo $user['nome_usr'] ?>
          </div>          
      </div>          
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>SENHA</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="senha_usr" type="text" id="senha_usr" size="50" value="" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;"> 
            <br>
            <input type="hidden" name="idusr" value="<?php echo $idusr ?>">   
            <input type="button" name="button" id="button" class="btn btn-default" value="CANCELAR" onclick="window.history.back()" style="color:#ff0000;background-color:#ccc;" />                             
            <input type="submit" name="button" id="button"  class="btn btn-warning" value="ALTERAR SENHA" />
          </div>          
      </div>  
      </form>
    </div> 
      <?php
     include "include/footer.php"; 
     ?>
    </body>
</html>