<?php
include("connecteur.php");

if ($_GET["clear"] == "true")
{
	unset($_SESSION["panier"]);
}
if ($_POST["delete"] && $_POST["nombre"] && $_POST["id"])
{
	if ($_SESSION["panier"][$_POST["id"]])
	{
		if ($_POST["nombre"] >= $_SESSION["panier"][$_POST["id"]]["nombre"])
		{
			unset($_SESSION["panier"][$_POST["id"]]);
		}
		else
		{
			$_SESSION["panier"][$_POST["id"]]["nombre"] = $_SESSION["panier"][$_POST["id"]]["nombre"] - $_POST["nombre"];
		}
	}
}
header("Location: panier.php");