<?php
include ("settings.php");

$htmlString = "<html><body><table align=\"center\"><div id=\"messageArea\">";
$endString = "</div></table></body></html>";

$validAccount = "<p><h2><b>Thank you for validating your account.</b></h2></p>"
. "<p>Your account is now live. Please click <a href=\"" . $websiteurl . "\">here</a> to visit the $gamename website</p>";

$deleteAccount = "<p><h2><b>This account has now been deleted</b></h2></p>"
. "<p>All info relating to this account, including your email address has been removed from our system.<br>"
. "If you have any further concerns, please contact <a href=\"mailto:" . $contactemail . "\"> $contactperson on $contactemail </a></p>"
. "<p> $gamename customer support</p>";

$invalidAccount = "<p><h2><b>This account is not awaiting activation</b></h2></p>"
. "<p>If you are seeing this message then it means that someone has already activated this account or it means that this account "
. "has already been deleted<br>If you have not performed either action and believe this account might be active on your email "
. "address without your consent, please contact $contactperson so that we might investigate this matter for you.</p>"
. "<p>Alternatively, if you did create this account and still seeing this message, please log in at the $gamename website using "
. "the passpord you chose when you created this account. If you are not able to log in, please contact $contactperson for assistance</p>"
. "<p><a href=\"mailto:" . $contactemail . "\">Click here to contact $contactperson</a><br><h2><a href=\"" . $websiteurl . "\"> $websiteurl </a></h2></p>";

$mysqli = new mysqli($loginURL, $username, $password, $database);
if ($mysqli->connect_errno)
	die(9);

$email=$_GET['email'];
$activate=$_GET['activate'];

$query="SELECT * FROM activate WHERE email = '$email'";
$result=$mysqli->query($query);

$num = $result->num_rows;
if ($num == 0)
{
	echo $htmlString . $invalidAccount . $endString;
} else
{
	$row = $result->fetch_assoc();
	$UID = $row["UID"];

	$query="DELETE FROM activate WHERE UID='$UID'";
	mysqli_query($mysqli, $query);

	if ($activate == "1")
	{
		$query="UPDATE login SET status='2' WHERE UID='$UID'";
		mysqli_query($mysqli, $query);

		echo $htmlString . $validAccount . $endString;
	} else
	{
		$query="DELETE FROM account WHERE UID='$UID'";
		mysqli_query($mysqli, $query);

		$query="DELETE FROM login WHERE UID='$UID'";
		mysqli_query($mysqli, $query);

		echo $htmlString . $deleteAccount . $endString;
	}
}

$mysqli->close();
