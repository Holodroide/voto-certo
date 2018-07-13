<?php
include("settings.php");

$mysqli = new mysqli($loginURL, $username, $password, $database);
if ($mysqli->connect_errno)
	die(9);

$user = mysqli_real_escape_string($mysqli, strip_tags($_POST['username']));
$passw = strip_tags($_POST['passw']);
$cleanpw = mysqli_real_escape_string($mysqli,  crypt( md5($passw), md5($user) ) );

$query="SELECT * FROM login WHERE username = '$user' AND passw = '$cleanpw'";
$result = $mysqli->query($query);

$num = $result->num_rows;
$mysqli->close();
$returncode = 0;

if ($num == 0)
	$returncode = 2;
else
{
	$row = $result->fetch_assoc();
	$status=$row["status"];
	if ($status == 1)
		$returncode = 1;
	if ($status == 0)
		$returncode = 6;

	if ($returncode == 0)
	{
		//add code to update access time if required...
	}

}

echo "$returncode";
