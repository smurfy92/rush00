<?php
include("connecteur.php");
if ($_SESSION["user"]["admin"] != 1)
	header("Location:index.php");

include("header.php");
include("header-admin.php");

if ($_POST["submit"] == "add" && $_POST["name"])
{
	$sql="SELECT * FROM categorie";
	$req=mysqli_query($link,$sql);
	$categories=[];
	while($data=mysqli_fetch_assoc($req))
		array_push($categories, $data);
	foreach ($categories as $key => $value)
	{
		if ($value["name"] == $_POST["name"])
		{
			$error = 1;
			break; 
		}
	}
	if ($error != 1)
	{
		$sql="INSERT INTO categorie (name) VALUES ('".$_POST['name']."')";
			$req=mysqli_query($link,$sql);
	}
}

?>

<div style="margin:0 auto;width:50%;">
<?php 
echo '
<form class="item" style="float:none; margin:0 auto;" action="add_categorie.php" method="post">
	<label>Name: </label><input type="text" name="name"><br>
	<input type="submit" name="submit" value="add">
</form>';
?>
</div>
