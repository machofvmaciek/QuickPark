<?php
	session_start();
	if(!(isset($_SESSION['TicketCheckOK']))){
		header('Location: biletomat.php');
	}
	else{
		unset($_SESSION['TicketCheckOK']);
		if(isset($_POST['confirm'])){
			//echo "hej";
			header('Location: test.php');
		}
	}
	
?>
<!DOCTYPE HTML>
<html lang="eng">
<head>
	<meta charset="utf-8" />
	<title>Tickets - QuickPark</title>
	<meta name="description" content="Intelligent shopping mall parking system" />
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	
	<link rel="stylesheet" href="style_ticketcheck.css" type="text/css"/>
	<link rel="icon" href="img/parking_icon.jpg">

	
</head>

<body>
	<div id="container">
	
		<div id="logo">
			<center> <img src = "img/logo4.png" width="261" height="121"/> </center>
		</div>
		
		
		<div class="navigation">
			
			<ul>
				<li><a href="index.php" style="text-decoration:none">Homepage</a></li>
				<li><a href="biletomat.php" style="text-decoration:none">Ticket shop</a></li>
				<li><a href="customerMap.php" style="text-decoration:none">Parking map</a></li>
				<li><a href="terms.php" style="text-decoration:none">Terms of use</a></li>
			</ul>
			
		</div>
		
		<div class="content">
			<div class = "HeaderText">Check your ticket parameters:</div>
			
			<div class = "InputText InputTextEmail">Email adress: </div>
			<div class = "ValueText ValueTextEmail"> <?php echo $_SESSION['email']; ?>	</div>
			
			<div class = "InputText InputTextPlaceNumber">Parking lot number: </div>
			<div class = "ValueText ValueTextPlaceNumber"> <?php echo $_SESSION['placeid']; ?>	</div>
			
			<div class = "InputText InputTextRegplate">Registration plates: </div>
			<div class = "ValueText ValueTextRegplate"> <?php echo $_SESSION['regplate']; ?> </div>

			<div class = "InputText InputTextTickettime">Ticket time: </div>
			<div class = "ValueText ValueTextTickettime"> <?php echo $_SESSION['tickettime']; ?> </div>
			
			<form method = "post">
				<button class="button buttonSubmit grid_column_span_2" name="confirm">Confirm</button>
			</form>
			<?php
					if(isset($_POST['confirm'])){
					require_once "db_connection.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
					try{
						$connection = new mysqli($host, $db_user, $db_password, $db_name);		//ustanowienie polaczenia z baza danych
						if($connection->connect_errno != 0){						//przypadek, gdy nie udalo sie poalczyc z baza
							throw new Exception(mysqli_connect_errno());
						}
						else{
							//zapisanie tresci kwerendy wpisania ticketu do bazy
							if($connection -> query("INSERT INTO tickets VALUES(NULL, '{$_SESSION['placeid']}', '{$_SESSION['regplate']}', NULL, now() + INTERVAL '{$_SESSION['tickettime']}' HOUR)")){
								unset($_SESSION['placeid']);
								unset($_SESSION['regplate']);
								unset($_SESSION['tickettime']);
								header('Location:  index.php');
								//jesli udalo sie polaczenie, wysylamy klientowi maila z jego biletem
								$topic = "QuickPark ticket";
								$ticketexpiration = new DateTime();		//utworzenie obiektu klasy DateTime, przechow. obec. date i czas
								$ticketexpiration -> modify('+'.$_SESSION['tickettime'].'hours');	//dodanie czasu kupna biletu
								$ticketexpstring = $ticketexpiration -> format('Y-m-d H:i:s');		//DateTime to string
								$message = "You bought a ticket\nPlace number: ".$_SESSION['placeid']."\nRegistration plates of the car: ".$_SESSION['regplate']."Ticket expires at: ".$ticketexpstring."\nThank you for using QuickPark";
								if(!mail($_SESSION['email'], $topic, $message)){
									throw new Exception("Failed to send a message");	//nie dziala, TODO: zrobic czytanie bledow wysylania
								}
								else{
									header('Location: TicketBoughtThx.php');
								}
							}
							else{
							throw new Exception($connection -> error);
							}
						}
						$connection -> close();
					}
					catch(Exception $e){
						echo '<div class = "error">Server error, we apologize for inconvenience</div>';
						echo '<br/> devinfo:'.$e;
					}
					
					}
			?>
			<div class = "SubHeaderText SubHeaderTextChanges">Ticket needs changes?</div>
			<label>
				<a href = "biletomat.php"><button class="button buttonBack" name="confirm">Go back!</button></a>
			</label>
		
			
		</div>
		
		<div class = "footer">
			<span style="font-weight: 700;">QuickPark.com &copy; 2021</span>
		</div>
	
	</div>
		
	


</body>


</html>
