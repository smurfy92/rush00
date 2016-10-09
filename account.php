<?php

include ("connecteur.php");
$sql="SELECT * FROM users";
$req=mysqli_query($link,$sql);
$users=[];
while($data=mysqli_fetch_assoc($req)){
   array_push($users, $data);
}
if ($_POST["delete"])
{
	$sql = "DELETE FROM users WHERE login = '".$_SESSION['loggued_in']."'";
	$req = mysqli_query($link,$sql);
	header("Location: logout.php");
}
if ($_POST["oldpw"] && $_POST["newpw"])
{
	$error = 1;
	if (!$users)
		$users = [];
	foreach($users as $key => $value)
	{
		if (hash("whirlpool", $_POST["oldpw"]) == $value["mdp"])
		{
			$sql="UPDATE users SET mdp = '".hash("whirlpool", $_POST['newpw'])."' WHERE login='".$_SESSION["loggued_in"]."'";
			$req=mysqli_query($link,$sql);
			$success = 1;
			header("Location: index.php");
		}
	}
}

 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Account</title>
</head>
<body>
	<?php
	include("header.php");
	if ($error)
		echo "ancien mot de passe invalide";
	 ?>
	<form action="account.php"  class="form" method="post">
		<label>Old pwd: </label><input type="text" name="oldpw"><br>
		<label>New pwd: </label><input type="text" name="newpw"><br>
		<input type="submit" name="submit" value="OK"><br>
		<input type="submit" name="delete" value="DELETE"><br>
	</form>
</body>
</html>