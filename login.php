<?php

include("connecteur.php");

$sql="SELECT * FROM users";
$req=mysqli_query($link,$sql);
$users=[];
while($data=mysqli_fetch_assoc($req)){
   array_push($users, $data);
}
foreach ($users as $key => $value) {
	if ($value["login"] == $_POST["login"] && $value["mdp"] == hash("whirlpool", $_POST["mdp"]))
	{
		$tmp = unserialize($value["panier"]);
		if ($_SESSION["panier"])
		{
			if (!$tmp)
				$tmp = [];
			foreach($tmp as $key2 => $value2)
			{
				if ($_SESSION["panier"][$key2])
				{
					$_SESSION["panier"][$key2]["nombre"] = $_SESSION["panier"][$key2]["nombre"] + $value2["nombre"];
				}
				else
				{
					unset($value2['id']);
					$_SESSION["panier"][$key2] = $value2;
				}
			}
		}
		else
			$_SESSION["panier"] = $tmp;
		$_SESSION["user"] = $value;
		$_SESSION["loggued_in"] = $_POST["login"];
		header("Location: index.php");
	}
}
echo '
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login</title>
</head>
<body>
	';
	include("header.php");
	echo'
	<form class="form" action="login.php" method="post">
		<label>Login: </label><input type="text" name="login"><br>
		<label>Mot de passe: </label><input type="text" name="mdp"><br>
		<input type="submit" name="submit" value=OK>
	</form>
</body>
</html>
';

?>