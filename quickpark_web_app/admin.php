<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>quickpark</title>
	<link rel="stylesheet" href="styl.css" type="text/css" />
</head>

<body>
	<?php
		//echo "Hej";
		echo '<img src = "logo.png" width="500" height="216" class="centre" />';
		
	?>
	<header><p>Witaj w systemie QuickPark - inteligentny parking</p></header>
	<form action="biletomat.php">
		<input type="submit" value="Zakup biletu" />
		<br> <br/>
	</form>

	
	<form action="mapa.php">
		<input type="submit" value="Mapa parkingu" />
		<br> <br/>
	</form>
	
	<form action="admin.php">
		<input type="submit" value="Panel administracyjny" />
		<br> <br/>
	</form>


</body>

</html>
