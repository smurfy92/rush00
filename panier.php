<?php

include("connecteur.php");
include("header.php");

if ($_GET["clear"] == "true")
{
	$_SESSION["panier"] = [];
	$sql="UPDATE users SET panier = '' WHERE login='".$_SESSION["loggued_in"]."'";
	$req=mysqli_query($link,$sql);
}


if ($_SESSION["panier"])
{
	echo '<div class="menu">';
	echo '<a class="menu_inside" href="add.php?archive=true">Archiver le panier</a><br>';
	echo '<a class="menu_inside" href="panier.php?clear=true">Clear panier</a><br>';
	echo '</div>';
	echo '<div class="produits">';
	foreach($_SESSION["panier"] as $key => $value)
	{
		$total += $value["nombre"] * $value["value"];
		echo ' <form class="item" action="delete.php" method="post">
				<img src="'.$value["img"].'">
			 	<p>name : '.$value["name"].'</p>
			 	<p>value : '.$value["value"].'</p>
			 	<p>nombre : '.$value["nombre"].'</p>
			 	<p>categorie : </p>
			 	nombre a supprimer: 
			 	<input type="text" name="nombre" value="1"><br>
			 	<input type="hidden" name="name" value="'.$value["name"].'">
			 	<input type="hidden" name="id" value="'.$key.'">
			 	<input type="submit" name="delete" value="delete">
			 </form>';
	}
	echo '<div class="total">Total = '.$total.' BTC</div>';
	echo '</div>';
}
