<?php
session_start();
 
require_once '../../usuario/init.php';
require '../../usuario/check.php'; 

header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

// pega os dados do formuário
$id  = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$dataCont = date('d/m/Y H:i:s');
//$userTxt = isset($_POST['addition']) ? $_POST['addition'] : null;
$tipoCont = isset($_POST['tipo_cont']) ? $_POST['tipo_cont'] : null;
$status = 'N'; 

// Pega o nome do arquivo do logo do cliente no BD
$idCliente = $_SESSION['id_cliente'];

// if (isset($_FILES['file']) && !empty($_FILES['file']['name'])){
// se o "name" estiver vazio, é porque nenhum arquivo foi enviado

$name = ''; $type = ''; $size = ''; $error = '';

function compress_image($source_url, $destination_url, $quality) {

  $info = getimagesize($source_url);

  if ($info['mime'] == 'image/jpeg')

    $image = imagecreatefromjpeg($source_url);
 
    if (!$image){
  		$image= imagecreatefromstring(file_get_contents($source_url));
		}

  elseif ($info['mime'] == 'image/gif')
    $image = imagecreatefromgif($source_url);

  elseif ($info['mime'] == 'image/png')
    $image = imagecreatefrompng($source_url);

    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
  }

  if ($_POST) {

    if ($_FILES["file"]["error"] > 0) {
    $error = $_FILES["file"]["error"];

  } else if (($_FILES["file"]["type"] == "image/gif") ||
            ($_FILES["file"]["type"] == "image/jpeg") ||
		        ($_FILES["file"]["type"] == "image/jpg") ||
	        	($_FILES["file"]["type"] == "image/JPG") ||
            ($_FILES["file"]["type"] == "image/png") ||
            ($_FILES["file"]["type"] == "image/pjpeg")) {

      $url = 'fotos/foto.jpg';
      $filename = compress_image($_FILES["file"]["tmp_name"], $url, 100);

    } else {

      $error = "Imagens ou fotos devem ser do tipo jpg, gif ou png";

    }
  }
//}


?>

<html>
    <head>
      <title></title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
      <!-- ===================== Mobile Specific ============================= -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <!-- ==================== BootStrap ====================== -->   
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>        
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

      <!-- Custom fonts -->
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="css/ionicons.min.css" rel="stylesheet" type="text/css">
      <link href="css/animate.min.css" rel="stylesheet" type="text/css">

      <style type="text/css">
        body {
        	background-color: #fff;
        	margin-left: 0px;
        	margin-top: 0px;
        	margin-right: 0px;
        	margin-bottom: 0px;
        }
      </style>


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
          <div class="col-md-12" style="text-align:center;margin:20px 0 20px 0;">
              <div style="max-width:200px;margin:0 auto;">
                  <img src="http://holodroide.com/sistema/arquivos/<?php echo $user['imglogo_cli'] ?>" style="width:100%;"> 
              </div>                   
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 30px 0;">
            <!-- a href="../../usuario/listar-conteudo.php?id=<?php echo $id; ?>" class="btn btn-success" role="button" style="width:100%;max-width:270px;">LISTAR CONTEÚDO</a><br><br -->
            <strong>ENVIAR IMAGEM</strong>
          </div>
        </div> 

        <div class="row">
            <div class="col-md-12" style="text-align:center;;margin:0 0 30px 0;">
                <p><?php echo $_SESSION['user_name']; ?>...<br>Escolha uma imagem e clique em ENVIAR. </p>
            </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="text-align:center;margin:0 0 10px 0;">
            <div class="error">

              <?php


 echo $info.'<br>';
 echo $info['mime'].'<br>';
$image1 = imagecreatefromjpeg($source_url);
 echo $image1.'<br>';
      $image2 = imagecreatefromstring(file_get_contents($source_url));
    echo $image2.'<br>';

      $image3 = imagecreatefromgif($source_url);
echo $image3.'<br>';
  
    $image4 = imagecreatefrompng($source_url);
echo $image4.'<br>';
    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
    echo $destination_url.'<br>';
  

  if ($_POST) {

    if ($_FILES["file"]["error"] > 0) {
    $error = $_FILES["file"]["error"];
echo $error.'<br>';
  } else if (($_FILES["file"]["type"] == "image/gif") ||
            ($_FILES["file"]["type"] == "image/jpeg") ||
            ($_FILES["file"]["type"] == "image/jpg") ||
            ($_FILES["file"]["type"] == "image/JPG") ||
            ($_FILES["file"]["type"] == "image/png") ||
            ($_FILES["file"]["type"] == "image/pjpeg")) {

      $url = 'fotos/foto.jpg';
      $filename = compress_image($_FILES["file"]["tmp_name"], $url, 100);

echo $filename.'<br>';
    } else {

      $error = "Imagens ou fotos devem ser do tipo jpg, gif ou png";














                if($_POST){
                  if ($error) {
                   echo $error.'<br>'; 
                  }
                }
              ?>

            </div>
            <div align="center">

              <form action="" name="img_compress" id="img_compress" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="file"/ accept="image/*" capture="camera" style="width:100%;max-width:270px;"/>
                <br><br>
                <input type="hidden" name="tipo_cont" id="tipo_cont" value="img">
                <input type="submit" name="submit" id="submit" value='ENVIAR' class="btn btn-primary" style="width:100%;max-width:270px;"/>
              </form>

            </div>

          </div>
        </div> 

        <div class="row">
            <div class="col-md-12" style="text-align:center;margin:30px 0 0 0;">            
                <a href="../../usuario/index.php" class="btn btn-danger" style="width:100%;max-width:270px;font-size:0.800em;">HOME</a>
            </div>                
        </div>          

        <div class="row">
            <div class="col-md-12" style="text-align:center;margin:10px 0 0 0;">            
                <a href="../../usuario/logout.php" class="btn btn-danger" style="width:100%;max-width:270px;font-size:0.800em;">LOGOUT</a>
            </div>                
        </div>


        <div class="row">
            <div class="col-md-12" style="text-align:center;margin:50px 0 50px 0;">
                <div style="max-width:250px;margin:0 auto;">
                    <img src="https://www.holodroide.com/images/logo_holodroide_sistema.png" style="width:100%;"><br /><br />

                </div>
                <h6>© 2018 | TODOS OS DIREITOS RESERVADOS</h6>
            </div>
        </div>     

    </div> 



  </body>
</html>