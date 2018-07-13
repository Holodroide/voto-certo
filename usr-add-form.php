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

include "include/header.php"; 
?>

    <div class="container">
      <div class="row">
          <div class="col-md-12" style="text-align:left;margin:0 0 5px 20px; border-left:5px solid #0000ff;">
            <h4 style="margin-top: 5px; margin-bottom: 5px;"><strong>CADASTRAR NOVO USUÁRIO</strong></h4>
          </div>          
          <div class="col-md-12" style="text-align:left;margin:0 0 30px 20px; border-left:5px solid #0000ff;">
            <h5>Preencha o formulário com os dados do novo usuário e clique no botão "<strong>CADASTRAR</strong>"</h5>
          </div>
      </div> 

      <form action="usr-add.php" method="post"  name="form-user" id="form-cli">
      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>NOME</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="nome_usr" type="text" id="nome_usr" size="50" value="" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
          </div>          
      </div>  

      <div class="row">
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>EMAIL</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <input name="email_usr" type="text" id="email_usr" size="50" value="" style="padding-left:10px;border-radius:3px;border:solid 1px #000;">
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
          <div class="col-md-1" style="text-align:right;padding:5px;">        
            <strong>CLIENTE</strong>
          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;">        
            <select name="idcli">
              <option value="">SELECIONE O CLIENTE</option>
              
              <?php

              $PDO = db_connect();

              // SQL para selecionar os registros
              $sql = "SELECT * FROM tbl_cli ORDER BY nome_cli ASC";
               
               
              // seleciona os registros
              $stmt = $PDO->prepare($sql);
              $stmt->execute();
              while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):  

              echo '<option value="'. $user['id_cli'].'">'.$user['empresa_cli'].'</option>';

              endwhile;
              ?>
            </select>
          </div>          
      </div> 

      <div class="row">
          <div class="col-md-1" style="text-align:right;">        

          </div>
          <div class="col-md-11" style="text-align:left;padding:5px;"> 
          <br> 
            <input type="button" name="button" id="button" class="btn btn-default" value="CANCELAR" onclick="window.history.back()"  style="color:#ff0000;background-color:#ccc;" />                
            <input type="submit" name="button" id="button"  class="btn btn-success"  value="CADASTRAR" />
          </div>          
      </div>  
      </form>
    </div>
     <?php
     include "include/footer.php"; 
     ?>
</body>
</html>
