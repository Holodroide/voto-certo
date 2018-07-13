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
$idcli = isset($_GET['idcli']) ? (int) $_GET['idcli'] : null;
 
// Validação simples. Confere se a variável tem algum valor
if (empty($idcli))
{
  echo '<script type="text/javascript">
  alert("REGISTRO NÂO ENCONTRADO!");
  window.history.back()
  </script>';
  exit;
}
 
// Executa query para selecionar os registros em tbl_cli
$PDO = db_connect();
$sql = "SELECT * FROM tbl_cli WHERE id_cli = :idcli";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idcli', $idcli, PDO::PARAM_INT);
$stmt->execute();

// Define variável com array resultado da query 
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// Se o array gerado pela query for vazio, exibe msg e volta para página anterior
if (!is_array($user))
{
  echo '<script type="text/javascript">
        alert("NENHUM REGISTRO ENCONTRADO!");
        window.history.back()
      </script>';
  exit;
}

include "include/header.php"; 
?>

    <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #5cb85c;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>ALTERAR CADASTRO CLIENTE</strong></h4>
          </div>          
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #5cb85c;">
            <h5>Altere os dados dedesjados e clique no botão"<strong>ALTERAR</strong>"</h5>
          </div>
      </div> 

      <!-- formulário editaar cadastro cliente -->

      <!-- ################## Valida campos formulário ################### -->
      <script language="JavaScript" >

        function validaForm(){

          if(document.formCli.empresa_cli.value == "")
          {
          alert( "Preencha campo EMPRESA!" );
          document.formCli.empresa_cli.focus();
          return false;
          }
          
          if(document.formCli.nome_cli.value == "")
          {
          alert( "Preencha campo NOME!" );
          document.formCli.nome_cli.focus();
          return false;
          }

          if(document.formCli.email_cli.value == "" || document.formCli.email_cli.value.indexOf('@') == -1 || document.formCli.email_cli.value.indexOf('.') == -1 )
          {
          alert( "Preencha o campo E-MAIL corretamente!" );
          document.formCli.email_cli.focus();
          return false;
          }

          if (document.formCli.tipo_txt.checked == false &&
                document.formCli.tipo_img.checked == false &&
              document.formCli.tipo_vid.checked == false) {
          alert( "Escolha pelo menos um tipo de conteúdo!" );
          document.formCli.tipo_txt.focus();
          return false;
          }

          return true;

        }
        
      </script>
      <!-- ################## Fim da validação ################### --> 


      <form action="cli-edit.php"  enctype="multipart/form-data"  method="post" name="formCli" id="formCli" onSubmit="return validaForm();">
      <br><br>
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>EMPRESA</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="empresa_cli" type="text" id="empresa_cli" size="50" value="<?php echo $user['empresa_cli'] ?>" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>NOME</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="nome_cli" type="text" id="nome_cli" size="50" value="<?php echo $user['nome_cli'] ?>" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>EMAIL</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="email_cli" type="text" id="email_cli" size="50" value="<?php echo $user['email_cli'] ?>" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>CONTEÚDO</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">
         
          <?php
          
          if(!$user['tipo_txt']){ 
            echo '<input name="tipo_txt" type="checkbox" id="tipo_txt" value="txt">TXT<br>';
          }else{
            echo '<input name="tipo_txt" type="checkbox" id="tipo_txt" value="txt" checked> TEXTO<br>';
          }

          if(!$user['tipo_img']){ 
            echo '<input name="tipo_img" type="checkbox" id="tipo_img" value="img">IMG<br>';
          }else{
            echo '<input name="tipo_img" type="checkbox" id="tipo_img" value="img" checked> FOTO<br>';
          }

          if(!$user['tipo_vid']){ 
            echo '<input name="tipo_vid" type="checkbox" id="tipo_vid" value="vid">VID<br>';
          }else{
            echo '<input name="tipo_vid" type="checkbox" id="ttipo_vid" value="vid" checked> VÍDEO<br>';
          }
         
          ?>
          
          </div>          
      </div> 

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>LOGO</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input type="file" name="imglogo_cli"  size="50" style="border-radius:3px;border:solid 1px #000;">
            <br/><br/>
          </div> 
      </div> 

      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>        
          <div class="col-md-11" style="text-align:left;">
            <img src="http://holodroide.com/sistema/cliente/arquivos/<? echo $user['imglogo_cli'] ?>">
          </div>                      
      </div> 


      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;"> 
            <br/><br/>
            <input type="hidden" name="idcli" value="<?php echo $idcli ?>">       
            <input type="button" name="button" id="button" class="btn" value="CANCELAR" onclick="window.history.back()" style="color:#ff0000;background-color:#ccc;" />
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