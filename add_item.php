<?php
include("connecteur.php");
if ($_SESSION["user"]["admin"] != 1)
	header("Location:index.php");

include("header.php");
include("header-admin.php");

if ($_POST["submit"] && $_POST["name"] && $_POST["value"] && $_POST["img"])
{

	$sql="SELECT * FROM categorie";
	$req=mysqli_query($link,$sql);
	$items=[];
	while($data=mysqli_fetch_assoc($req)){
	   array_push($items, $data);
	}
	$categories = "";
	foreach ($items as $key => $value)
	{
		if ($_POST[$value["name"]])
		{
			if ($categories != "")
				$categories = $categories.";".$value["name"];
			else
				$categories = $value["name"];
		}
	}

	$sql="INSERT INTO panier (name, value, img, categorie) VALUES ('".$_POST['name']."', '".$_POST['value']."', '".$_POST["img"]."', '".$categories."')";
	$req=mysqli_query($link,$sql);
}

?>

<div style="margin:0 auto;width:50%;">
<?php 
echo '
<form class="item" style="float:none; margin:0 auto;" action="add_item.php" method="post">
	<label>Img src: </label><input type="text" name="img" value="'.$value["img"].'"><br>
	<label>Price: </label><input type="text" name="value" value="'.$value["value"].'"><br>
	<label>Name: </label><input type="text" name="name" value="'.$value["name"].'"><br>
	';
	$sql="SELECT * FROM categorie";
	$req=mysqli_query($link,$sql);
	$items=[];
	while($data=mysqli_fetch_assoc($req)){
	   array_push($items, $data);
	}
	foreach ($items as $key => $value) {
		echo '<input type="checkbox" name="'.$value["name"].'" value="'.$value["name"].'">'.$value["name"].'<br>';
	}
	
	echo '
	<input type="hidden" name="id" value="'.$value["id"].'"><br>
	<input type="submit" name="submit" value="add">
</form>';
?>
</div>
