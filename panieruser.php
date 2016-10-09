<?php

include("connecteur.php");
include("header.php");

	$sql="SELECT * FROM users WHERE id='".$_GET["id"]."'";
	$req=mysqli_query($link,$sql);
	$items=[];
	while($data=mysqli_fetch_assoc($req)){
	   array_push($items, $data);
	}
	$panier = unserialize($items[0]["panier"]);
	echo '<div class="produits">';
	if ($panier)
	{
		foreach ($panier as $key => $value) {
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
	}
	echo '</div>';