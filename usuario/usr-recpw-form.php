<?php
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

session_start();

$acao = $_SESSION['acao'];
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
        
        
        
        
        
<!-- NO mouse right button (part 1) -->
<script language="JavaScript" type="text/JavaScript">
<!--
function disableselect(e){
return false
} 

function reEnable(){
return true
} 

//if IE4+
document.onselectstart=new Function ("return false") 

//if NS6
if (window.sidebar){
document.onmousedown=disableselect
document.onclick=reEnable
}
//-->
</script>

     </head>
 
    <body>
    

<!-- NO mouse right button (part 2) -->
<script language=JavaScript>
var message="";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
// --> 
</script>


         <div class="container">


            <div class="row">
                <div class="col-md-12" style="text-align:center;margin:50px 0 0 0;color:#ff0000;">
                    <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png?1222259157.415" width="200px" height="23px"><br />
                    <p><h6>RECUPERAR SENHA</h6></p> 
                </div>
            </div> 

<?php
if ($acao == ''){
?>
             
            <div class="row">
                <div class="col-md-12" style="text-align:center;;margin:0 0 10px 0;">
                    <p><h6>Digite o email cadastrado.</h6></p>                    
                </div>
            </div>

             <div class="row">
                <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
                    <form action="usr-recpw.php" method="post">
                        EMAIL
                        <br>
                        <input type="text" name="email" id="email" style="width:250px;">
             
                        <br><br>
             
                        <input type="submit" value="ENVIAR" class="btn btn-danger"  style="width:100%;max-width:250px;font-size:0.800em;">
                    </form>
                </div>
            </div>

<?php
}elseif ($acao == 'noreg'){
?>  
             <div class="row">
                <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
                  Não encontramos o email informado.<br>
                  Tente outra vez...<br><br>
                    <form action="usr-recpw.php" method="post">
                        EMAIL
                        <br>
                        <input type="text" name="email" id="email" style="width:250px;">
             
                        <br><br>
                       <input type="hidden"  name="acao" value="ok">
                        <input type="submit" value="ENVIAR" class="btn btn-danger"  style="width:100%;max-width:250px;font-size:0.800em;">
                    </form>
                </div>
            </div>
<?php
 $_SESSION['acao'] = '';
} elseif ($acao == 'ok'){
?>
             <div class="row">
                <div class="col-md-12" style="text-align:center;margin:0 0 30px 0;">
                  Enviamos um email com instruções para a recuperação da sua senha. Confira.<br><br>
                  <input type="button" name="button" id="button" class="btn btn-danger" value="CANCELAR" onclick="window.history.back()" /><br><br>
                </div>
            </div>
<?php
 $_SESSION['acao'] = '';
}elseif ($acao == 'vazio'){
?>  
             <div class="row">
                <div class="col-md-12" style="text-align:center;margin:0 0 50px 0;">
                  Por favor, informe um email.<br> <br>
                    <form action="usr-recpw.php" method="post">
                        EMAIL
                        <br>
                        <input type="text" name="email" id="email" style="width:250px;">
             
                        <br><br>
                       <input type="hidden"  name="acao" value="ok">
                        <input type="submit" value="ENVIAR" class="btn btn-danger"  style="width:100%;max-width:250px;font-size:0.800em;">
                    </form>
                </div>
            </div>

 <?php
 $_SESSION['acao'] = '';
 }
 ?>


<!-- Botão Cadastrar

          <div class="row">

              <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">            
                  Ainda não está cadastrado?<br>Cadastre-se agora!
              </div>  

              <div class="col-md-12" style="text-align:center;margin:0 0 30px 0;">            
                  <a href="usr-add-form.php" class="btn btn-danger" style="width:100%;max-width:250px;font-size:0.800em;">CADASTRAR</a>
              </div>                
          </div> 

 -->


                   
        </div>
 
    </body>
</html>