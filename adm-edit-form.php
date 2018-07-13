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

// pega o ID da URL
$idadm = isset($_GET['idadm']) ? (int) $_GET['idadm'] : null;
 
// Validação simples. Confere se a variável tem algum valor
if (empty($idadm))
{
    echo "<script>
          alert('ID NÃO INFORMADO!');
          window.history.back()
      </script>";
    exit;    
}
 
// Conecta ao MySql
$PDO = db_connect();

// Pesquisa e seleciona os campos em tbl_adm pelo id_adm recebido do formulário.
$sql = "SELECT * FROM tbl_adm WHERE id_adm = :idadm";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idadm', $idadm, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// Se a query retornar vazio, exibe msg  e volta para página anterior
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
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5cb85c;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>ALTERAR CADASTRO</strong></h4>
          </div>          
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #5cb85c;">
            <h5 style="margin-top: 5px; margin-bottom: 5px;">Altere os dados desejados e clique no botão "<strong>ALTERAR</strong>"</h5>
          </div>
      </div> 

      <!-- Formulário alterar cadastro administrador -->

      <!-- ################## Valida campos formulário ################### -->
      <script language="JavaScript" >

        function validaForm(){
          
          if(document.formAdm.nome_adm.value == "")
          {
          alert( "Preencha campo NOME!" );
          document.formAdm.nome_adm.focus();
          return false;
          }

          if( document.formAdm.email_adm.value == "" || document.formAdm.email_adm.value.indexOf('@') == -1 || document.formAdm.email_adm.value.indexOf('.') == -1 )
          {
          alert( "Preencha campo E-MAIL corretamente!" );
          document.formAdm.email_adm.focus();
          return false;
          }
            
          return true;

        }
        
      </script>
      <!-- ################## Fim da validação ################### -->  

      <form action="adm-edit.php" method="post" name="formAdm" id="formAdm" onSubmit="return validaForm();">
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>ID</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <?php echo $idadm ?>
          </div>          
      </div>         
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>NOME</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="nome_adm" type="text" id="nome_adm" size="45" value="<?php echo $user['nome_adm'] ?>" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>EMAIL</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="email_adm" type="text" id="email_adm" size="45" value="<?php echo $user['email_adm'] ?>" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;"> 
            <br>
            <input type="hidden" name="idadm" value="<?php echo $idadm ?>">  
            <input type="button" name="button" id="button" class="btn btn-default" value="CANCELAR" onclick="window.history.back()" style="color:#ff0000;background-color:#ccc;" />
            <input type="submit" name="button" id="button"  class="btn btn-success" value="ALTERAR" />
          </div>          
      </div>  
      </form>
    </div> 
     <?php
     include "include/footer.php"; 
     ?>
  </body>
</html>