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

 
// Recebe os dados do formulário e define as variáveis
$idadm = isset($_GET['idadm']) ? (int) $_GET['idadm'] : null;
 
// Validação simples. Confere se a variável tem algum valor
if (empty($idadm))
{
    echo "ID para alteração não definido";
    exit;
}
 
// Executa query para buscar os dados do usuário do administrador
$PDO = db_connect();
$sql = "SELECT * FROM tbl_adm WHERE id_adm = :idadm";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idadm', $idadm, PDO::PARAM_INT);
$stmt->execute();

// Define variável com o array  resultado da query
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// Se a query for executada, redireciona para o painel admin  
if (!is_array($user))
{
    echo "<script>
          alert('NENHUM REGISTRO ENCONTRADO PARA ESSE ID!');
          window.history.back()
      </script>";
    exit;
}

include "include/header.php"; 
?>

  <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #f0ad4e;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>ALTERAR SENHA</strong></h4>
          </div>          
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #f0ad4e;">
            <h5>Digite a nova senha e clique no botão "<strong>ALTERAR SENHA</strong>"</h5>
          </div>
      </div> 


      <!-- ################## Valida campos formulário ################### -->
      <script language="JavaScript" >

        function validaForm(){
          
          if (document.formAdm.senha_adm.value == "" || document.formAdm.senha_adm.value.length < 6)
          {
          alert( "Preencha o campo SENHA com no mínimo 6 caracteres!" );
          document.formAdm.senha_adm.focus();
          return false;
          }
            
          return true;

        }
        
      </script>
      <!-- ################## Fim da validação ################### -->   

      <form action="adm-pw-new.php" method="post" name="formAdm" id="formAdm" onSubmit="return validaForm();">
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>ID</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <?php echo $user['id_adm'] ?>
          </div>          
      </div>          
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>NOME</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <?php echo $user['nome_adm'] ?>
          </div>          
      </div>          
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>SENHA</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="senha_adm" type="text" id="senha_adm" size="40" value="" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;"> 
            <br>
            <input type="hidden" name="idadm" value="<?php echo $idadm ?>"> 
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