<?php
//session_cache_expire(525600);
session_start();
$_SESSION['acao'] = '';

require 'include/init.php';

header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

$idusr  = isset($_SESSION['usr_id']) ? $_SESSION['usr_id'] : null;

// Abre a conexão com MySql
$PDO = db_connect();
?>

<!doctype html>
<html>
    <head>

        <title>HOLODROIDE USUÁRIO</title>        

        <meta charset="utf-8">

        <!-- ===================== Mobile Specific ============================= -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 
        <!-- ==================== BootStrap ====================== -->   
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
        <!-- Custom CSS -->
    <link href="../css/holodroide.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">
    
    <!-- Custom fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="../css/animate.min.css" rel="stylesheet" type="text/css">


    <!-- Google Login -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="452252680400-gthidau6jcudso5ahgp37ktjg2hb3slg.apps.googleusercontent.com">


    <script>

      function onSignIn(googleUser) {


       var profile = googleUser.getBasicProfile();
        var userID = profile.getId(); 
        var userName = profile.getName(); 
        var userPicture = profile.getImageUrl(); 
        var userEmail = profile.getEmail();        
        var userToken = googleUser.getAuthResponse().id_token; 
        
        document.getElementById('msg').innerHTML = userEmail;

        if(userEmail !== ''){
          var dados = {
            userID:userID,
            userName:userName,
            userPicture:userPicture,
            userEmail:userEmail
          };
          $.post('valida.php', dados, function(retorna){
            if(retorna === '"erro"'){
              var msg = "Usuário não encontrado com esse e-mail";
              document.getElementById('msg').innerHTML = retorna;
            }else{
                window.location.href = retorna;
            }
            
          });
        }else{
          var msg = "Usuário não encontrado!";
          document.getElementById('msg').innerHTML = msg;
        }
    }
    </script>
    <style type="text/css">
      #customBtn {
        display: inline-block;
        background: white;
        color: #444;
        width: 270px;
        border-radius: 5px;
        border: thin solid #888;
        box-shadow: 1px 1px 1px grey;
        white-space: nowrap;
      }
      #customBtn:hover {
        cursor: pointer;
      }
      span.label {
        font-family: arial;
        font-weight: normal;
        color:#888;
        font-size: 0.600em;
      }
      span.icon {
        background: url('https://developers.google.com/identity/sign-in/g-normal.png') transparent 5px 50% no-repeat;
        display: inline-block;
        vertical-align: middle;
        width: 30px;
        height: 30px;
      }
      span.buttonText {
        display: inline-block;
        vertical-align: middle;
        /*padding-left: 42px;
        padding-right: 42px;*/
        font-size: 14px;
        font-weight: bold;
        /* Use the Roboto font that is loaded in the <head> */
        font-family: 'Roboto', sans-serif;
        }
      </style>

      <!-- Balão de dica para os botões do menu -->
      <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
      });
      </script>

    </head>
 
    <body>
         <div class="container">


            <?php
            if (UsrIsLoggedIn()):

            $idcli = $_SESSION['id_cli'];

             
            // SQL - seleciona o logotipo e tipo de conteúdo do cliente associado ao usuário
            $sql = "SELECT imglogo_cli, tipo_txt, tipo_img, tipo_vid FROM tbl_cli WHERE id_cli = $idcli";
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC)
            ?>  
                      
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:0px 0 10px 0;">
                    <div style="max-width:120px;margin:0 auto;">
                        <img src="http://holodroide.com/sistema/cliente/arquivos/<? echo $user['imglogo_cli'] ?>" style="width:100%;"> 
                    </div>                   
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="text-align:center;;margin:0 0 10px 0;">
                    <p><h6>Olá, <?php echo $_SESSION['usr_name']; ?>!</h6></p>                    
                </div>
            </div>

          <div class="row">
          <?php
          
          if($user['tipo_txt']){ 
            echo '<div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">              
                  <a href="../uploaders/texto/form_texto.php" class="btn btn-success" role="button" style="width:100%;max-width:250px;">ENVIAR TEXTO</a>                  
                  </div>';
          }

          if($user['tipo_img']){ 
            echo '<div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">                    
                  <a href="../uploaders/foto/form_foto.php" class="btn btn-success" role="button" style="width:100%;max-width:250px;">ENVIAR IMAGEM</a> 
                  </div>';
          }

          if($user['tipo_vid']){ 
            echo '<div class="col-md-12" style="text-align:center;margin:0 0 30px 0;">                    
                  <a href="../uploaders/video/index.php" class="btn btn-success" role="button" style="width:100%;max-width:250px;">ENVIAR VÍDEO</a> 
                  </div>';
          }
          ?>

          </div>  

          <?php
          // SQL - seleciona o último conteúdo enviado
          $sqlcnt = "SELECT id_cnt, id_cli, text_cnt, tipo_cnt FROM tbl_cnt_usr WHERE id_usr = $idusr ORDER BY id_cnt DESC LIMIT 1";
          $stmtcnt = $PDO->prepare($sqlcnt);
          $stmtcnt->execute();
          $usrcnt = $stmtcnt->fetch(PDO::FETCH_ASSOC);

          $conteudo = $usrcnt['text_cnt'];

          if(!empty($conteudo)){ 
          ?>

            <div class="col-md-12" style="text-align:center;margin:0 0 30px 0;">

              <h6>Veja abaixo o seu último conteúdo enviado</h6>

              <div style="max-width:250px; border:dashed 1px #ccc;margin:0 auto;">

                <?php
                if ($usrcnt['tipo_cnt'] == 'txt'){

                  echo $usrcnt['text_cnt'];

                }elseif ($usrcnt['tipo_cnt'] == 'img'){

                  echo '<img src="https://holodroide.com/sistema/uploaders/foto/fotos/'.$usrcnt['text_cnt'].'" width="250px"';

                }else{

                  echo '<video width="250" controls="controls" autoplay="false">';
                  echo '<source src="https://holodroide.com/sistema/uploaders/video/converted_videos/'.$usrcnt['text_cnt'].'" type="video/mp4">';
                  echo '<object data="" width="250">';
                  echo '<embed width="250" src="https://holodroide.com/sistema/uploaders/video/converted_videos/'.$usrcnt['text_cnt'].'">';
                  echo '</object>';

                }
                ?>

              </div>
            </div>

          <?php
          } 
          ?>

          <P>&nbsp;</P>

          <div class="row">
              <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">            
                  <a href="usr-logout.php" class="btn btn-danger" style="width:100%;max-width:250px;font-size:0.800em;">LOGOUT</a>
              </div>                
          </div>


            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;">
                    <div style="max-width:200px;margin:0 auto;">
                        <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" style="width:100%;"><br /><br />

                    </div>
                    <h6>© 2018 | Todos os direitos reservados</h6>
                </div>
            </div>         
 
            <?php else: ?>

            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;color:#ff0000;">
                    <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png?1222259157.415" width="200px" height="23px"><br />
                </div>
            </div>            

             <div class="row">
                <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
                    <form action="usr-login.php" method="post">
                        EMAIL
                        <br>
                        <input type="text" name="email" id="email" style="width:250px;">
             
                        <br><br>
             
                        SENHA
                        <br>
                        <input type="password" name="password" id="password" style="width:250px; background-color: #fff;">
             
                        <br><br>
             
                        <input type="submit" value="ENTRAR" class="btn btn-danger"  style="width:100%;max-width:250px;font-size:0.800em;">
                    </form>
                    <a href="usr-recpw-form.php" style="font-size:0.550em">ESQUECI A SENHA</a>
                    <br>

                    <!-- Botões Socials Início  -->
                    <a href="#" style="width:100%;max-width:250px;" class="btn azm-social azm-btn azm-facebook"><i class="fa fa-facebook"></i> Entrar com Facebook</a>
                    <br>
                    <a href="#" style="width:100%;max-width:250px;" class="btn azm-social azm-btn azm-google-plus"><i class="fa fa-google"></i> Entrar com Google &nbsp;&nbsp;</a>

        <!-- div class="row">
          <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;">
            <span class="g-signin2" data-onsuccess="onSignIn"  data-width="270" data-height="80" data-longtitle="true">
          </span>
          </div>
        </div -->

        <div class="row">
          <div class="col-md-12" style="text-align:center;margin:5px 0 5px 0;">
            <div id="gSignInWrapper">
              <span class="g-signin2" data-onsuccess="onSignIn"  data-width="270px" id="customBtn"></span>
            </div>
                <p id='msg'></p>
          </div>
        </div>


                    
                    <!-- Botões Socials Fim  -->

                </div>
            </div>

          <div class="row">

              <div class="col-md-12" style="text-align:center;margin:30px 0 0 0;">            
                  Ainda não está cadastrado?<br>Clique no botão abaixo e cadastre-se agora!
              </div>  

              <div class="col-md-12" style="text-align:center;margin:30px 0 0 0;">            
                  <a href="usr-add-form.php" class="btn btn-danger" style="width:100%;max-width:250px;font-size:0.800em;">CADASTRAR</a>
              </div>                
          </div> 

          <div class="row">
              <div class="col-md-12" style="text-align:center;margin:30px 0 0 0;">            
                  <a href="usr-recpw-form.php" class="btn btn-danger" style="width:100%;max-width:250px;font-size:0.800em;">RECUPERAR SENHA</a>
              </div>                
          </div>                      

            <?php endif; ?>


        </div>
 
    </body>
</html>