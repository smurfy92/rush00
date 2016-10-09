<?php
include("connecteur.php");

if ($_GET["archive"] == "true")
{
	$sql="UPDATE users SET panier = '".serialize($_SESSION["panier"])."' WHERE login='".$_SESSION["loggued_in"]."'";
	$req=mysqli_query($link,$sql);
	header("Location: panier.php");
}
if ($_POST["id"] && $_POST["submit"] == "OK" && $_POST["nombre"])
{
	if ($_SESSION["panier"])
	{
			if ($_SESSION["panier"][$_POST["id"]]["nombre"])
			{
				$_SESSION["panier"][$_POST["id"]]["nombre"] = $_SESSION["panier"][$_POST["id"]]["nombre"] + $_POST["nombre"];
				$ok = 1;
			}
	}
	if ($ok != 1)
	{
		$item["value"] = $_POST["value"];
		$item["img"] = $_POST["img"];
		$item["nombre"] = $_POST["nombre"];
		$item["name"] = $_POST["name"];
		$_SESSION["panier"][$_POST["id"]]  = $item;
	}
}
header("Location: index.php");

 ?>