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

include "include/header.php"; 
?>

   <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #0000ff;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>CADASTRAR NOVO</strong></h4>
          </div>          
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #0000ff;">
            <h5>Preencha o formulário com os dados do novo administrador e clique no botão "<strong>CADASTRAR</strong>"</h5>
          </div>
      </div>  

      <!-- Formulário CADASTRAR NOVO ADMINISTRADOR -->

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

      <form action="adm-add.php" method="post" name="formAdm" id="formAdm" onSubmit="return validaForm();">
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>NOME</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="nome_adm" type="text" id="nome_adm" size="45" value="" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>EMAIL</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="email_adm" type="text" id="email_adm" size="45" value="" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>SENHA</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="senha_adm" type="text" id="senha_adm" size="45" value="" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>              

      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;"> 
          <br>       
            <input type="button" name="button" id="button" class="btn btn-default" value="CANCELAR" onclick="window.history.back()"  style="color:#ff0000;background-color:#ccc;"  />
            <input type="submit" name="button" id="button"  class="btn" value="CADASTRAR" style="color:#fff;background-color:#0000ff;" />

          </div>          
      </div>  
      </form>
    </div>
     <?php
     include "include/footer.php"; 
     ?>
</body>
</html>
