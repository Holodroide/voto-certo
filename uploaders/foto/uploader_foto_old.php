<?php
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );
?>

<?php
$name = ''; $type = ''; $size = ''; $error = '';
   function compress_image($source_url, $destination_url, $quality) {

      $info = getimagesize($source_url);

          if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);
		  if (!$image)
			{
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
        }
            else if (($_FILES["file"]["type"] == "image/gif") ||
            ($_FILES["file"]["type"] == "image/jpeg") ||
			($_FILES["file"]["type"] == "image/jpg") ||
			($_FILES["file"]["type"] == "image/JPG") ||
            ($_FILES["file"]["type"] == "image/png") ||
            ($_FILES["file"]["type"] == "image/pjpeg")) {

            $url = 'fotos/foto.jpg';
            $filename = compress_image($_FILES["file"]["tmp_name"], $url, 100);
        }else {
            $error = "Imagens ou fotos devem ser do tipo jpg, gif ou png";
        }
        }
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
	background-color: #F0F0F0;
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



        <div class="error">
            <?php
                if($_POST){
                  if ($error) {
            ?>
          <label class="error"><?php echo $error; ?></label>
            <?php
            }
         }
       ?>
       </div>


<div align="center">

               <h3 class="bg-primary"><br>
Envio de Foto<br><br>
</h3>


<br>


  <form action="" name="img_compress" id="img_compress" method="post" enctype="multipart/form-data">

                                   <input type="file" name="file" id="file"/ accept="image/*" capture="camera" />
                                   
                                   <br><br>


                               <input type="submit" name="submit" id="submit" value='Enviar' class="btn btn-primary"/>

  </form>
</div>

     </body>
</html>