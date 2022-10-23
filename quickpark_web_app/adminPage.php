<?php
session_start();

if ((isset($_SESSION['userislogged'])) && ($_SESSION['userislogged'] == true)) {
	header('Location: adminControlPanel.php');		//przekierowanie do panelu kontrolnego, jesli uzytkownik jest zalogowany
	exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Log In - QuickPark</title>
	<meta name="description" content="Intelligent shopping mall parking system" />

	<link rel="stylesheet" href="style_adminpage_grid.css" type="text/css" />
	<link rel="icon" href="img/parking_icon.jpg">
	<style>


	</style>
</head>

<body>

	<div id="container">

		<div id="logo">
			<img src="img/logo4.png" width="523" height="242" />
		</div>

		<div class = "HeaderText">
			To continue, you have to prove your identity!
		</div>

		
			<form action="loginNEW.php" method="post">
			<div id = "login">
				<div class = "SubHeaderText SubHeaderTextLogin">Login to Admin Panel:</div>
				<div class = "InputText">Enter Login:</div>
				<div class = "JustInput"><input type="text" name="login" placeholder="Your login"/></div>

				<div class = "InputText">Enter Password:</div>
				<div class = "JustInput"><input type="password" name="password" placeholder="Your password"/></div>
				<div class = "error">
				<?php
					if (isset($_SESSION['loggingerror'])) {
						echo "<br/>";								
						echo  $_SESSION['loggingerror'];					
					}
				?>
				</div>
				<button class="button buttonLogin"> Log In </button>
				
			</div>	
			</form>

			<div class = "SubHeaderText SubHeaderTextBack">Are you lost?</div>
			<form action="index.php">
				<div class = "formBack">
					<button class="button buttonBack"><</button> <div class = "InputText InputTextBack">Go back!</div>
			
				</div>
				<?php
					unset($_SESSION['loggingerror']);
				?>
			</form>
		
	</div>



</body>

</html>