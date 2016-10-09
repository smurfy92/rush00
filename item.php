<?php 
include("connecteur.php");

if ($_POST["delete"])
{
	$sql = "DELETE FROM panier WHERE id = '".$_POST["id"]."'";
	$req = mysqli_query($link,$sql);
}
if ($_POST["maj"])
{
	$sql="SELECT * FROM categorie";
	$req=mysqli_query($link,$sql);
	$categories=[];
	while($data=mysqli_fetch_assoc($req))
		array_push($categories, $data);
	$categorie = "";
	foreach ($categories as $key => $value)
	{
		if ($_POST[$value["name"]])
		{
			if ($categorie != "")
				$categorie = $categorie.";".$value["name"];
			else
				$categorie = $value["name"];
		}
	}
	$sql="UPDATE panier SET 
	name = '".$_POST["name"]."' ,
	value = '".$_POST["value"]."' ,
	img = '".$_POST["img"]."' ,
	categorie = '".$categorie."' 
	WHERE id='".$_POST["id"]."'";
	$req=mysqli_query($link,$sql);
}
header("Location:admin.php");


?>