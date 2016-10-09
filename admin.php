<?php
include("connecteur.php");
if ($_SESSION["user"]["admin"] != 1)
	header("Location:index.php");

include("header.php");
include("header-admin.php");

?>
<div class="produits">

		<?php
		$sql="SELECT * FROM panier";
		$req=mysqli_query($link,$sql);
		$items=[];
		while($data=mysqli_fetch_assoc($req)){
		   array_push($items, $data);
		}
		$sql="SELECT * FROM categorie";
		$req=mysqli_query($link,$sql);
		$categories=[];
		while($data=mysqli_fetch_assoc($req)){
		   array_push($categories, $data);
		}
		foreach ($items as $key => $value) {
			$categorieitem = explode(";", $value["categorie"]);
			echo ' <form class="item" action="item.php" method="post">
				<img src="'.$value["img"].'"><br>
			 	<label>Img src: </label><input type="text" name="img" value="'.$value["img"].'"><br>
			 	<label>Value: </label><input type="text" name="value" value="'.$value["value"].'"><br>
			 	<label>Name: </label><input type="text" name="name" value="'.$value["name"].'"><br>';
			 	foreach ($categories as $key => $value2) {
			 		if (in_array($value2["name"], $categorieitem))
		 				echo '<input type="checkbox" name="'.$value2["name"].'" value="'.$value2["name"].'" checked>'.$value2["name"].'<br>';
			 		else
	 					echo '<input type="checkbox" name="'.$value2["name"].'" value="'.$value2["name"].'">'.$value2["name"].'<br>';
				}
			 	echo '
			 	<input type="hidden" name="id" value="'.$value["id"].'"><br>
			 	<input type="submit" name="maj" value="Mettre a jour"><br>
			 	<input type="submit" name="delete" value="delete">
			 </form>';
		}
		 ?>

	 </div>