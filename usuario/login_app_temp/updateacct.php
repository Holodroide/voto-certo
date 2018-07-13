<?php
include("settings.php");

$mysqli = new mysqli($loginURL, $username, $password, $database);
if ($mysqli->connect_errno)
	die(9);

$user = mysqli_real_escape_string($mysqli,strip_tags($_POST['username']));
$passw = strip_tags($_POST['passw']);
$cleanpw = mysqli_real_escape_string($mysqli, crypt( md5($passw), md5($user) ) );
$intent=$_POST['intent'];

$query="SELECT * FROM login WHERE username = '$user' AND passw = '$cleanpw'";
$result=$mysqli->query($query);
$num = $result->num_rows;

if ($num != 1)
{
	$mysqli->close();
	echo "2";
	die(2);
}

$row = $result->fetch_assoc();
$UID = $row["UID"];

$query = "SELECT * FROM account WHERE UID = '$UID'";
$result = mysqli_query($mysqli, $query);
$num = $result->num_rows;
	
if ($num == 0)
{
	$mysqli->close();
	echo "2";
	die(2);
}

switch ($intent)
{
	//retrieve personal data. Username and password not included
	case 0:
	case 50:
	{
		$row = $result->fetch_assoc();
		$name		= $row["name"];
		$surname	= $row["surname"];
		$addr1		= $row["addr1"];
		$addr2		= $row["addr2"];
		$city		= $row["city"];
		$stat		= $row["state"];
		$zipp		= $row["zip"];
		$country	= $row["country"];
		$email		= $row["email"];
		$paypal		= $row["paypal"];

		if ($intent == 50)
		{
			$VARS =   "username="	. $user
					. "&passw=" 	. $passw 
					. "&name=" 		. $name 
					. "&surname=" 	. $surname 
					. "&addr1=" 	. $addr1 
					. "&addr2=" 	. $addr2 
					. "&city=" 		. $city 
					. "&state=" 	. $stat 
					. "&zip=" 		. $zipp 
					. "&country=" 	. $country 
					. "&email=" 	. $email 
					. "&paypal=" 	. $paypal 
					. "&pageState=" . 50;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $phpurl . "/UpdateAccount.php");
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $VARS);
			curl_exec($ch);
			curl_close($ch);
		}
		else
			echo "$name|$surname| $addr1| $city| $addr2| $stat| $zipp| $country| $email| $paypal";
	}
	break;
			
	//update personal data
	case 1:
	case 51:
	{
		$name		= mysqli_real_escape_string($mysqli, strip_tags($_POST['name']));
		$surname	= mysqli_real_escape_string($mysqli, strip_tags($_POST['surname']));
		$addr1		= mysqli_real_escape_string($mysqli, strip_tags($_POST['addr1']));
		$addr2		= mysqli_real_escape_string($mysqli, strip_tags($_POST['addr2']));
		$city		= mysqli_real_escape_string($mysqli, strip_tags($_POST['city']));
		$stat		= mysqli_real_escape_string($mysqli, strip_tags($_POST['state']));
		$zipp		= mysqli_real_escape_string($mysqli, strip_tags($_POST['zip']));
		$country	= mysqli_real_escape_string($mysqli, strip_tags($_POST['country']));
		$email		= mysqli_real_escape_string($mysqli, strip_tags($_POST['email']));
		$paypal		= mysqli_real_escape_string($mysqli, strip_tags($_POST['paypal']));

		$query="UPDATE account SET name='$name', surname='$surname', addr1='$addr1', addr2='$addr2', "
		. "city='$city', state='$stat', zip='$zipp', country='$country', email='$email' ,paypal='$paypal' "
		. "WHERE UID='$UID'";
		mysqli_query($mysqli, $query);

		if ($intent == 51)
		{
			echo "<html><body>Account details successfully updated<br><a href=\"$phpurl/UpdateAccount.php\">Back</a></body></html>";
		}
		else
			echo "0";
	}
}

$mysqli->close();
