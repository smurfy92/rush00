<?php
include("connecteur.php");
if ($_SESSION["user"]["admin"] != 1)
	header("Location:index.php");
if ($_POST["maj"])
{
	$sql="UPDATE users SET 
	admin = '".$_POST["admin"]."' 
	WHERE id='".$_POST["id"]."'";
	$req=mysqli_query($link,$sql);
	echo "maj";
}
if ($_POST["delete"])
{
	$sql = "DELETE FROM users WHERE id = '".$_POST["id"]."'";
	$req = mysqli_query($link,$sql);
}

include("header.php");
include("header-admin.php");

?>



 <div class="produits">

		<?php
		$sql="SELECT * FROM users";
		$req=mysqli_query($link,$sql);
		$users=[];
		while($data=mysqli_fetch_assoc($req)){
		   array_push($users, $data);
		}
		foreach ($users as $key => $value) {
			echo '
			<form class="item" action="users.php" method="post">
				<p>Login : '.$value["login"].'</p>
				<input type="hidden" name="img" value="'.$value["img"].'">
				<label>Admin: </label>';
				if ($value["admin"] == "1")
				{
					echo '
					<select name="admin">
						<option value="1" selected	>Oui</option> 
						<option value="0">Non</option>
					</select><br><br><br>';
				}
				else
				{
					echo '
					<select name="admin">
						<option value="0" selected>Non</option>
						<option value="1">Oui</option> 
					</select><br><br><br>';
				}
				echo '
				<input type="hidden" name="login" value="'.$value["login"].'">
				<input type="hidden" name="id" value="'.$value["id"].'">
				<input type="submit" name="maj" value="maj"><br><br>
				<input type="submit" name="delete" value="delete">
			</form>';
		}
		 ?>

	 </div>