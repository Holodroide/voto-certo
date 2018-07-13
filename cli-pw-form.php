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
$idcli = isset($_GET['idcli']) ? (int) $_GET['idcli'] : null;
 
// validação (bem simples, mais uma vez)
if (empty($idcli))
{
    echo "<script>
          alert('EEEEIIIITA!...\n CADÊ O ID PARA PROCURAR? ALGO DEU ERRADO...');
          window.history.back()
          </script>";
    exit;
}
 
// Conecta ao BD MySql
$PDO = db_connect();

// Executa query para buscar os dados do usuário do administrador
$sql = "SELECT * FROM tbl_cli WHERE id_cli = :idcli";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idcli', $idcli, PDO::PARAM_INT);
$stmt->execute();

// Define variável com o array  resultado da query
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// Se retornar o array vazio, exibe mensagem de erros e volta para a página anterior
if (!is_array($user))
{
    echo "<script>
          alert('EI, CABEÇA DE VENTO...\n VOLTE E DIGITE A NOVA SENHA!');
          window.history.back()
          </script>";
    exit;
}

include "include/header.php"; 
?>

    <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #f0ad4e;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>ALTERAR SENHA CLIENTE</strong></h4>
          </div>          
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #f0ad4e;">
            <h4>Digite a nova senha para o cliente e clique no botão "<strong>ALTERAR SENHA</strong>"</h4>

          </div>
      </div> 

      <br>
      <form action="cli-pw-new.php" method="post" name="cli-new-pw" id="cli-new-pw">
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>EMPRESA</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <?php echo $user['empresa_cli'] ?>
          </div>          
      </div>          
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>NOME</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <?php echo $user['nome_cli'] ?>
          </div>          
      </div>          
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>SENHA</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="senha_cli" type="text" id="senha_cli" size="50" value="" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;"> 
            <br>
            <input type="hidden" name="idcli" value="<?php echo $idcli ?>"> 
            <input type="button" name="button" id="button" class="btn" value="CANCELAR" onclick="window.history.back()"  style="color:#ff0000;background-color:#ccc;"/>                  
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