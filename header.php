<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pokemon store</title>
	<link href="styles.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="img/favicon.ico" />
</head>
<body>
<div class="name">
		<?php 
		if ($_SESSION["loggued_in"])
			echo "Bienvenue ".ucwords($_SESSION["loggued_in"]);

		 ?>

	</div>
<div class="top">
	<h1>42 Pokemon Store</h1>
	<div class="menu">

<?php 

echo '<a class ="menu_inside" href="index.php">Home</a>';	
	if ($_SESSION["loggued_in"])
	{
		echo '<a class ="menu_inside" href="account.php">Gerer mon compte</a><br>';
		echo '<a class ="menu_inside" href="logout.php">Se deconnecter</a><br>';

	}
	else
	{
		echo '<a class ="menu_inside" href="login.php">Se connecter</a><br>';
		echo '<a class ="menu_inside" href="create_account.php">Se creer un compte</a><br>';
	}
	echo '<a class ="menu_inside" href="panier.php">Mon panier</a><br>';
	if ($_SESSION["user"]["admin"] == 1)
		echo '<a class ="menu_inside" href="admin.php">Admin</a><br>';
 ?>
  </div>
  </div>