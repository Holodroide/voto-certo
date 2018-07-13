<?php
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );
?>

<!doctype html>
<html>
<head>



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


<!-- Custom fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="css/animate.min.css" rel="stylesheet" type="text/css">




<title>Texto Uploader</title>
<style type="text/css">
body {
	background-color: #F0F0F0;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>


<script type="text/javascript">
function limitTextareaLine(e) {
    if(e.keyCode == 5 && $(this).val().split("\n").length >= $(this).attr('rows')) { 
        return false;
    }
}
</script>


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


<div align="center">

<h3 class="bg-primary"><br>
Envio de Texto<br><br>

</h3>

<strong>Seu último texto enviado foi:</strong><br>


<?php

if($_POST['addition']){


$file_open = fopen("textos/texto.txt","w+"); //fopen("something.txt","a+"); to add the contents to file
fwrite($file_open, $_POST['addition']);
fclose($file_open);
}

// Open file for reading, and read the line
	$file_open = fopen("textos/texto.txt", "r");

	// Read text
	echo fgets($file_open);
	echo "<br>";
	echo fgets($file_open);
	echo "<br>";
	echo fgets($file_open);
	echo "<br>";
	echo fgets($file_open);
	echo "<br>";
	echo fgets($file_open);
	fclose($file_open);

?>

<br><br>


<strong>Escreva um novo texto abaixo</strong>
<form action="<?=$PHP_SELF?>" method="POST">
<textarea style="overflow:hidden" name="addition" cols='35' rows='5' maxlength="105" onkeydown="return limitLines(this, event)"></textarea>

<br>

<input type="submit" name="button" class="btn btn-primary" value='Enviar'>
</form>

</div>

<script type="text/javascript">
      var keynum, lines = 1;

      function limitLines(obj, e) {
        // IE
        if(window.event) {
          keynum = e.keyCode;
        // Netscape/Firefox/Opera
        } else if(e.which) {
          keynum = e.which;
        }

        if(keynum == 13) {
          if(lines == obj.rows) {
            return false;
          }else{
            lines++;
          }
        }
      }
</script>


</body>
</html>